<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class LoginA extends CI_Controller
{

     public function __construct()
     {
          parent::__construct();
          $this->load->library('form_validation');
          //load the login model
          $this->load->model('login_model');
     }

     public function index()
     {
          if ($this->session->userdata('admin_logged_in'))
          {
              redirect('Admin');
          }
          else if($this->session->userdata('logged_in'))
          {
               redirect('user');
          }
          else
          {
          //If no session, redirect to login page
             redirect('loginA/doLogin', 'refresh');
          }
     }

     public function doLogin()
     {
          //get the posted values
          $username = $this->input->post("username");
          $password = $this->input->post("password");

          //set validations
          $this->form_validation->set_rules("username", "Username", "trim|required");
          $this->form_validation->set_rules("password", "Password", "trim|required");

          if ($this->form_validation->run() == FALSE)
          {
               //validation fails
               $this->load->view('AdminV/login_viewA');
          }
          else
          {
               //validation succeeds
               if ($this->input->post('btn_login') == "Login")
               {
                    //check if username and password is correct
                    $admin_result = $this->login_model->get_admin($username, $password);
                    if ($admin_result)
                    {
                         $sessiondata = array();
                         foreach($admin_result as $row)
                         {
                             $sessiondata = array(
                              'adminuser' => $row ->adminuser,
                              'adminpass' =>  $row ->adminpass,
                              'loginuser' => TRUE
                         ); 
                         }
                         
                         $this->session->set_userdata('admin_logged_in', $sessiondata);
                         redirect("Admin");
                    }
                    else
                    {
                         $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Invalid username and password!</div>');
                         redirect('loginA/doLogin');
                    }
               }
               else
               {
                    redirect('loginA/doLogin');
               }
          }
     }
}?>