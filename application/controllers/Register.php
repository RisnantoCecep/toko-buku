<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	public function index(){
        $data["page"] = "pages/register";
        $this->load->view('templates/main', $data);         
    }

    public function registrasi(){
        $redirect = $this->session->userdata("redirect");
        // form_validation
        if($this->input->post('name') && $this->input->post('email') && $this->input->post('phone') && $this->input->post('password1') && $this->input->post('password2'))
        {
            if($this->input->post('password1') == $this->input->post('password2')) {
                $this->load->model("Users_model", "users");
                $regist = $this->users->register($this->input->post('name'), $this->input->post('email'), $this->input->post('phone'), $this->input->post('password1'));
                if($regist){
                    $this->session->set_userdata($regist);
                    redirect($redirect ?? base_url('profile'));
                }else{
                    $this->session->set_flashdata("warning", "Email yang Anda gunakan sudah terdaftar!");
                    redirect(base_url('register'));
                }
            }else{
                $this->session->set_flashdata("warning", "Konfirmasi kata sandi harus sama, silahkan coba kembali.");
                redirect(base_url('register'));
            }

        }else{
            $this->session->set_flashdata("warning", "Silahkan masukan nama, email, nomor telepon, dan kata sandi terlebih dahulu!");
            redirect(base_url('register'));
        }
    }
}

?>