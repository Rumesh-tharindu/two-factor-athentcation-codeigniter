<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller{

        public function __construct(){
        parent::__construct();

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
         $this->load->library('encrypt');
         $this->load->model('Register_Model');
        
    }
    
    public function index(){
        $this->load->view('register');
    }
    function validation()
 {
  $this->form_validation->set_rules('user_name', 'Name', 'required|trim|is_unique[codeigniter_register.name]');
  $this->form_validation->set_rules('user_email', 'Email Address', 'required|trim|valid_email|is_unique[codeigniter_register.email]');
  $this->form_validation->set_rules('user_password', 'Password', 'required');
  if($this->form_validation->run())
  {
      $verification_key=md5(rand());
      $encrypted_password=$this->encrypt->encode($this->input->post('user_password'));
      $data=array(
        'name'  => $this->input->post('user_name'),
        'email'  => $this->input->post('user_email'),
        'password' => $encrypted_password,
        'verification_key' => $verification_key
      );
      $id=$this->Register_Model->insert_data($data);
      if($id>0){
        $subject="Please verify email for login";
        $message = "
        <p>Hi ".$this->input->post('user_name')."</p>
        <p>This is email verification mail from Codeigniter Login Register system. For complete registration process and login into system. First you want to verify you email by click this <a href='".base_url()."register/verify_email/".$verification_key."'>link</a>.</p>
        <p>Once you click this link your email will be verified and you can login into system.</p>
        <p>Thanks,</p>
        <h3>Your Login Credintial</h3>
        <P>your username is :  ".$this->input->post('user_name')."</p>
        <P>your password is :  ".$this->input->post('user_password')."</p>
        

        ";
        $config=array(
          'protocol'=>'smtp',
          'smtp_host'=>'ssl://smtp.gmail.com',
          'smtp_port' => 465,
          'smtp_user'  => 'tharindurumesh20@gmail.com',
          'smtp_pass'  => 'my$077nethmi',
          'mailtype'  => 'html',
          'charset'    => 'utf-8',
          'wordwrap'   => TRUE
        );
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('tharindurumesh20@gmail.com');
        $this->email->to($this->input->post('user_email'));
        $this->email->subject($subject);
        $this->email->message($message);
        if ($this->email->send())
        {
            echo "Email was successfully sent.";
        }
        else {  
            show_error($this->email->print_debugger());
        }
      }
     
  }
  else{
      $this->index();
  }
}
function verify_email(){
  if($this->uri->segment(3)){
    $verification_key=$this->uri->segment(3);
   if($this->Register_Model->verify_email($verification_key)){
    $data['message'] = '<h1 align="center">Your Email has been successfully verified, now you can login from <a href="'.base_url().'login">here</a></h1>';
   }
   else{
    $data['message'] = '<h1 align="center">Invalid Link</h1>';
   }
  }
  $this->load->view('email_verification', $data);
}
}

?>