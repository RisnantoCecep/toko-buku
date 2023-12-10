<?php 
class Admin extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("Book_model", "book");
        $this->load->model("Transaction_model", "transaction");
    }

    public function index(){
        if($this->session->userdata('user_flag') == 'admin'){
            $data['title'] = 'Dashboard Admin';
            $data['page'] = 'admin/dashboard';
            $data['book_count'] = $this->book->countBuku();
            $data['transaction_count'] = $this->transaction->count();
            $data['payment_count'] = $this->transaction->paymentCount();
            $data['coorier_count'] = $this->transaction->coorierCount();
            $data['orders'] = $this->transaction->findOrder(null, null, null, true);
        }else{
            $data['page'] = 'admin/forbidden';
        }
        $this->load->view('templates/main', $data);
    }

    public function books(){
        if($this->session->userdata('user_flag') == 'admin'){
            $rows = $this->book->countBuku($this->input->get('category'), $this->input->get('search'));
            $config = stylePagination(current_url(), $rows, 10);
            $start = $this->input->get("pages");
            $this->pagination->initialize($config);

            $data['title'] = 'Data Buku';
            $data['page'] = 'admin/book_list';
            $data['categories'] = $this->book->categories();
            $data['order'] = $start;
            $data['books'] = $this->book->find(10, $start, $this->input->get('category'), $this->input->get('search'));
        }else{
            $data['page'] = 'admin/forbidden';
        }
        $this->load->view('templates/main', $data);
    }

    public function book_editor($slug=null){
        if($this->session->userdata('user_flag') == 'admin'){
            $data['title'] = ($slug) ? 'Edit Data Buku' : 'Tambah Buku';
            $data['page'] = 'admin/book_editor';
            $data['categories'] = $this->book->categories();
            $data['book'] = ($slug) ? $this->book->get($slug) : null;
        }else{
            $data['page'] = 'admin/forbidden';
        }
        $this->load->view('templates/main', $data);
    }

    public function book_save(){
        if($this->session->userdata('user_flag') == 'admin'){
            $bookEdit = ($this->input->post('id')) ? $this->book->get($this->input->post('id')) : null;
            if(($bookEdit || isset($_FILES['image'])) && $this->input->post('title') && $this->input->post('category') && $this->input->post('price') && $this->input->post('desc')){
                
                $imageFile = null;
                $dirUpload = "assets/img/books/";
                if(isset($_FILES['image']['tmp_name'])){
                    $namaSementara = $_FILES['image']['tmp_name'];
                    $extension = explode('.', $_FILES['image']['name']);
                    $extension = strtolower(end($extension));

                    if(in_array($extension, ['png', 'jpg', 'jpeg'])){
                        $imageFile = uniqid('', true).'.'.$extension;
                        $terupload = move_uploaded_file($namaSementara, $dirUpload.$imageFile);
                        if(!$terupload){
                            $imageFile = null;
                            log_message('error', 'File gagal di upload!');
                        }
                    }
                }
                
                $save = $this->book->saveBuku(
                    $this->input->post('id'),
                    $this->input->post('category'),
                    $this->input->post('title'),
                    $imageFile,
                    $this->input->post('stok'),
                    $this->input->post('price'),
                    $this->input->post('desc')
                );
                if($save){
                    if(isset($bookEdit['image_path']) && $imageFile){
                        unlink($dirUpload.$bookEdit['image_path']);
                    }
                }
                redirect(base_url('admin/books'));
            }else{
                redirect(base_url('admin/book_editor'));
            }
        }else{
            redirect(base_url('login'));
        }
    }

    public function book_delete($slug){
        if($this->session->userdata('user_flag') == 'admin'){
            $dirUpload = "assets/img/books/";
            $book = $this->book->get($slug);
            if($book){
                if($this->book->deleteBuku($book['book_id'])){
                    if(@$book['image_path']){
                        unlink($dirUpload.$book['image_path']);
                    }
                    $this->session->set_flashdata("success", "Buku berhasil di hapus");
                }else{
                    $this->session->set_flashdata("warning", "Buku gagal di hapus, silahkan coba kembali");
                }
            }else{
                $this->session->set_flashdata("warning", "Buku gagal di hapus, silahkan coba kembali");
            }
            redirect(base_url('admin/books'));
        }else{
            redirect(base_url('login'));
        }
    }

    public function transactions($id=null){
        if($this->session->userdata('user_flag') == 'admin'){
            if($id){
                if($this->input->post('status')){
                    $acc = $this->transaction->updateOrder($id, $this->input->post('status'));
                    if($acc){
                        $this->session->set_flashdata("success", "Transaksi berhasil di update ke ".$this->input->post('status'));
                    }else{
                        $this->session->set_flashdata("warning", "Transaksi gagal di update!");
                    }
                }
                $data['title'] = 'Detail Transaksi';
                $data['page'] = 'admin/transaction_detail';
                $data['order'] = $this->transaction->getOrder($id);
            }else{
                $rows = $this->transaction->count();
                $config = stylePagination(current_url(), $rows, 10);
                $start = $this->input->get("pages");
                $this->pagination->initialize($config);

                $data['title'] = 'Data Transaksi';
                $data['page'] = 'admin/transaction_list';
                $data['order'] = $start;
                $data['orders'] = $this->transaction->findOrder(null, 10, $start);
            }
        }else{
            $data['page'] = 'admin/forbidden';
        }
        $this->load->view('templates/main', $data);
    }

    public function payments(){
        if($this->session->userdata('user_flag') == 'admin'){
            $data['title'] = 'Data Pembayaran';
            $data['page'] = 'admin/payment_list';
            $data['data'] = $this->transaction->payments();
        }else{
            $data['page'] = 'admin/forbidden';
        }
        $this->load->view('templates/main', $data);
    }

    public function payment_save(){
        if($this->session->userdata('user_flag') == 'admin'){
            if($this->input->post("bank") && $this->input->post("an") && $this->input->post("rekening")){
                $acc = $this->transaction->paymentSave($this->input->post("id"), $this->input->post("bank"), $this->input->post("an"), $this->input->post("rekening"));
                if($acc){
                    $this->session->set_flashdata("success", "Pembayaran berhasil disimpan");
                }else{
                    $this->session->set_flashdata("warning", "Gagal menyimpan data pembayaran");
                }
            }else{
                $this->session->set_flashdata("warning", "Gagal menyimpan data pembayaran");
            }
        }else{
            $this->session->set_flashdata("warning", "Gagal menyimpan data pembayaran");
        }
        redirect(base_url('admin/payments'));
    }

    public function payment_delete(){
        if($this->session->userdata('user_flag') == 'admin'){
            if($this->input->get("id")){
                $acc = $this->transaction->paymentDelete($this->input->get("id"));
                if($acc){
                    $this->session->set_flashdata("success", "Pembayaran berhasil dihapus");
                }else{
                    $this->session->set_flashdata("warning", "Gagal menghapus data pembayaran");
                }
            }else{
                $this->session->set_flashdata("warning", "Gagal menghapus data pembayaran");
            }
        }else{
            $this->session->set_flashdata("warning", "Gagal menghapus data pembayaran");
        }
        redirect(base_url('admin/payments'));
    }

    public function cooriers(){
        if($this->session->userdata('user_flag') == 'admin'){
            $data['title'] = 'Data Kurir';
            $data['page'] = 'admin/coorier_list';
            $data['data'] = $this->transaction->kurir();
        }else{
            $data['page'] = 'admin/forbidden';
        }
        $this->load->view('templates/main', $data);
    }

    public function coorier_save(){
        if($this->session->userdata('user_flag') == 'admin'){
            if($this->input->post("name") && $this->input->post("price")){
                $acc = $this->transaction->kurirSave($this->input->post("id"), $this->input->post("name"), $this->input->post("price"));
                if($acc){
                    $this->session->set_flashdata("success", "Kurir berhasil disimpan");
                }else{
                    $this->session->set_flashdata("warning", "Gagal menyimpan data kurir");
                }
            }else{
                $this->session->set_flashdata("warning", "Gagal menyimpan data kurir");
            }
        }else{
            $this->session->set_flashdata("warning", "Gagal menyimpan data kurir");
        }
        redirect(base_url('admin/cooriers'));
    }

    public function coorier_delete(){
        if($this->session->userdata('user_flag') == 'admin'){
            if($this->input->get("id")){
                $acc = $this->transaction->kurirDelete($this->input->get("id"));
                if($acc){
                    $this->session->set_flashdata("success", "Kurir berhasil dihapus");
                }else{
                    $this->session->set_flashdata("warning", "Gagal menghapus data kurir");
                }
            }else{
                $this->session->set_flashdata("warning", "Gagal menghapus data kurir");
            }
        }else{
            $this->session->set_flashdata("warning", "Gagal menghapus data kurir");
        }
        redirect(base_url('admin/cooriers'));
    }

}
?>