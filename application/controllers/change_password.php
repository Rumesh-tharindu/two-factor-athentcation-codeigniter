<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Change_password extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->Model('ChangePassModel');
    }
    public function index(){
        $this->load->view('change_password');
    }

    public function change_pass(){

      $validator=array('message'=>array());
      
      $config=array(
             array(
                 'field' =>'current_pass',
                 'label' =>'Change Password',
                 'rules' => 'trim|required'
             ),
             array(
                'field' =>'new_pass',
                'label' =>'New Password',
                'rules' => 'trim|required'
            ),
            array(
                'field' =>'confirm_pass',
                'label' =>'Confirm Password',
                'rules' => 'trim|required'
            )
      );
      $this->form_validation->set_rules($config);
      $this->form_validation->set_error_delimiters('<p class="text-danger" style="font-weight:600">','</p>');

      if($this->form_validation->run()){

        $current_pass=$this->input->post('current_pass');
        $new_pass=$this->input->post('new_pass');
        $confirm_pass=$this->input->post('confirm_pass');
        $session_id=$this->session->userdata('id');
        if($new_pass== $confirm_pass){
           
         $result= $this->ChangePassModel->fetch_pass($session_id,$current_pass);
         if($result==false){
            $this->session->set_flashdata('message','current password is incorrect');
            $this->load->view('change_password');
         }
         else{
            $result= $this->ChangePassModel->change_pass($session_id,$new_pass);
            if($result==true){
                echo '<div>you have successfully change the password 
                        <a href="'. base_url().'/login"> try login</a>
                </div>';
            }
            
         }
           
        }
        else{
            $this->session->set_flashdata('message','confirm password is incorrect');
            $this->load->view('change_password');
        }
        
      }
      else{
         $this->load->view('change_password');
      }





       
    }
}

?>