<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('encrypt');
        $this->load->model('Login_Model');
    }
    function index(){
        $this->load->view('login');
    }
    function validation(){
        $validator=array('messages'=>array());
        $this->form_validation->set_error_delimiters('<p style="font-weight:bold"class="text-danger">','</p>');
        $this->form_validation->set_rules('user_name', 'Username', 'required|trim');
        $this->form_validation->set_rules('user_password', 'Password', 'required');
        if($this->form_validation->run()){
               $result=$this->Login_Model->can_login($this->input->post('user_name'),$this->input->post('user_password'));
               if($result == '')
               {
                $validator['success']=true;
                $validator['redirect_url']= base_url() ."Private_area";
                $validator['messages']="successfily Added";
                echo json_encode($validator);
               }
               else
               {
                $validator['success']=false;
                echo json_encode($validator);
               }
               
              }
              else
              {
               
                foreach($_POST as $key => $value){
                    $validator['messages'][$key]=form_error($key);
                }
                echo json_encode($validator);
               
              }
             

        
    }
}

?>
