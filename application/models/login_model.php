<?php
class Login_Model extends CI_Model{

    function can_login($name, $password){
        $this->db->where('name', $name);
        $query = $this->db->get('codeigniter_register');
        if($query->num_rows() > 0)
  {
    foreach($query->result() as $row){
        if($row->is_email_verified == 'yes'){
            $store_password = $this->encrypt->decode($row->password);
            if($password == $store_password)
            {
              $userdata=array(
                 'id' =>$row->id,
                 'name'=>$row->name,
              );
             $this->session->set_userdata($userdata);
            }
            else
            {
             return 'Wrong Password';
            }
        }
        else{
            return 'First verified your email address';
        }
    }
  }
  else{
    return 'Wrong Email Address';
  }
    }
}
?>