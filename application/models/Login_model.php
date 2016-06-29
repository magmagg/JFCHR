<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model
{
     function __construct()
     {
          // Call the Model constructor
          parent::__construct();
     }

     //get the username & password from tbl_usrs
     function get_user($usr, $pwd)
     {
          $this ->db-> select('*');
          $this ->db-> from('tblUsers1');
          $this->db->where('user_username', $usr);
          $this->db->where('user_password', $pwd);
         // $this->db->where('user_active', 1);
          $query = $this->db->get();
          return $query->result();
     }

     function get_admin($usr, $pwd)
     {
          $this ->db-> select('*');
          $this ->db-> from('tblAdmin');
          $this->db->where('adminuser', $usr);
          $this->db->where('adminpass', $pwd);
          $query = $this->db->get();
          return $query->result();
     }
}?>