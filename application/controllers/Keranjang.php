<?php 
class Keranjang extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model("Book_model", "book");
        $this->load->model("Transaction_model", "transaction");
    }

    public function index(){
        if($this->session->userdata('user_id')){
            $data["page"] = "pages/fill";
            $data["baskets"] = $this->book->findBasket();
            $data["payments"] = $this->transaction->payments();
            $data["kurir"] = $this->transaction->kurir();
            $this->load->view("templates/main", $data);
        }else{
            $this->session->set_userdata("redirect", current_url());
            redirect(base_url('login'));
        }
    }

    public function checkout(){
        if($this->session->userdata('user_id')){
            if(countBasket() > 0 && $this->input->post("kurir_id") && $this->input->post("payment_id") && $this->input->post("address")){
                $total = 0;
                $baskets = $this->book->findBasket();
                foreach($baskets as $i => $book){
                    $total += $book['total'];
                }
                $order = $this->transaction->order(
                    $this->session->userdata('user_id'),
                    $this->input->post("kurir_id"),
                    $this->input->post("payment_id"),
                    $this->input->post("address"),
                    $total
                );
                if($order){
                    foreach($baskets as $i => $book){
                        $this->transaction->orderDetail(
                            $order,
                            $book['book_id'],
                            $book['qty'],
                            $book['book_price']
                        );
                    }
                    clearBasket();
                    redirect(base_url('profile/orders/'.$order.'?order=buy'));
                }else{
                    redirect(base_url('keranjang'));
                }
            }else{
                redirect(base_url('keranjang'));
            }
        }else{
            $this->session->set_userdata("redirect", current_url());
            redirect(base_url('login'));
        }
    }

}


?>