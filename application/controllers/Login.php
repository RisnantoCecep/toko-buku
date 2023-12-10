<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Login extends CI_Controller {

	public function index()
	{
        $data["page"] = "pages/login";
        $this->load->view('templates/main', $data);
    }

    public function acc(){
        $redirect = $this->session->userdata("redirect");
        if($this->input->post("email") && $this->input->post("password")){
            $this->load->model("Users_model", "users");
            $login = $this->users->login($this->input->post("email"), $this->input->post("password"));
            if($login){
                $this->session->set_userdata($login);
                redirect($redirect ?? base_url('profile'));
            }else{
                $error = ["warning" => "Email dan password yang Anda masukan tidak tepat!"];
                $this->session->set_flashdata($error);
                redirect(base_url('login'));
            }
        }else{
            $this->session->set_flashdata("warning", "Silahkan masukan email dan kata sandi terlebih dahulu!");
            redirect(base_url('login'));
        }
    }

    public function forget(){
        if($this->input->post("otp") && $this->session->userdata("forget_email") && $this->session->userdata("forget_otp")){
            if($this->input->post("otp") == $this->session->userdata("forget_otp")){
                $this->load->model("Users_model", "users");
                $user = $this->users->profileByEmail($this->session->userdata("forget_email"));
                if($user){
                    $this->session->set_userdata($user);
                    redirect($redirect ?? base_url('profile/password'));
                }else{
                    $data["msg"] = "Kegagalan, silahkan coba kembali";
                }
            }else{
                $data["msg"] = "Kode OTP yang anda masukan salah!";
            }
        }elseif($this->input->post("email")){
            $email = $this->input->post("email");
            $otp = rand(100000, 999999);
            $content = "<p>Kode OTP anda adalah <b>$otp</b>, rahasiakan kode OTP anda dan jangan berikan kode OTP ini ke siapapun termasuk tim Budaya Literasi</p>";
            try {
                if (!class_exists('PHPMailer\PHPMailer\Exception')){
                    require APPPATH.'libraries/phpmailer/src/Exception.php';
                    require APPPATH.'libraries/phpmailer/src/PHPMailer.php';
                    require APPPATH.'libraries/phpmailer/src/SMTP.php';
                }
                $mail = new PHPMailer();
                $mail->isSMTP();
                $mail->Host = 'mail.trisnawan.my.id';
                $mail->SMTPAuth = true;
                $mail->Username = "budayaliterasi@trisnawan.my.id";
                $mail->Password = "budayaliterasi";
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;
                $mail->setFrom("budayaliterasi@trisnawan.my.id", "Budaya Literasi");
                
                $mail->addAddress($email);
                $mail->Subject = "Kode OTP Lupa Kata Sandi";
                $mail->isHTML(true);
                $mail->Body = $content;
                if($mail->send()){
                    $data["email"] = $email;
                    $this->session->set_userdata(["forget_email"=>$email, "forget_otp"=>$otp]);
                }else{
                    $data["msg"] = "Gagal mengirimkan OTP, silahkan coba kembali";
                }
            } catch (Exception $e){
                $data["msg"] = "Gagal mengirimkan OTP, silahkan coba kembali";
            }
        }

        if($this->session->userdata("forget_email")){
            $data["email"] = $this->session->userdata("forget_email");
        }

        $data["page"] = "pages/forget";
        $this->load->view('templates/main', $data);
    }
}
