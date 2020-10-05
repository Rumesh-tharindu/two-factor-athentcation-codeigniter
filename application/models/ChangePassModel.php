<?php
class ChangePassModel extends CI_Model{

    public function fetch_pass($id,$current_pass){
       $this->db->where('id',$id);
       $query=$this->db->get('codeigniter_register');
      if($query->num_rows()>0){
         foreach($query->result() as $row){
             $stored_pass=$this->encrypt->decode($row->password);
             if($current_pass==$stored_pass){
                 return true;
             }
             else{
                 return false;
             }
         }
      }
    }

    public function change_pass($id,$new_pass){
        
        $this->db->where('id',$id);
        $new_pass=$this->encrypt->encode($new_pass);
        $query=$this->db->update('codeigniter_register',array('password'=>$new_pass));
        if($query==1){
            return true;
        }
        else{
            return false;
        }
        
    }
}
?>