<?php 
class Home extends CI_Controller {

    public function index(){
        $data["page"] = "pages/home";
        $data["books"] = $this->book->find(24);
        $this->load->view("templates/main", $data);
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect(base_url('login'));
    }

}
?>