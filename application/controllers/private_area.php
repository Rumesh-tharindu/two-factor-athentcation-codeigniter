<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Private_area extends CI_Controller {
 public function __construct()
 {
  parent::__construct();
  if(!$this->session->userdata('name'))
  {
   redirect('login');
  }
 }

 function index()
 {
  echo '<br /><br /><br /><h1 align="center">Welcome User</h1>';
  echo '<p align="center"><a href="'.base_url().'private_area/logout">Logout</a></p>';
  echo $this->session->userdata('name');
  
  echo '<a href="'.base_url().'change_password">change password</a>';
 }

 function logout()
 {
  $data = $this->session->all_userdata();
  foreach($data as $row => $rows_value)
  {
   $this->session->unset_userdata($row);
  }
  redirect('login');
 }
}