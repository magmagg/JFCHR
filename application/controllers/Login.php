<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
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
          if($this->session->userdata('logged_in'))
          {
               redirect('user/dashboard1');
          }
          else if ($this->session->userdata('admin_logged_in'))
          {
              redirect('Admin');
          }
          else
          {
          //If no session, redirect to login page
             redirect('login/doLogin', 'refresh');
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
               $this->load->view('login_view');
          }
          else
          {
               //validation succeeds
               if ($this->input->post('btn_login') == "Login")
               {
                    //check if username and password is correct
                    $usr_result = $this->login_model->get_user($username, $password);
                    $admin_result = $this->login_model->get_admin($username, $password);
                    if ($usr_result) //active user record is present
                    {
                         $sessiondata = array();
                         foreach($usr_result as $row)
                         {
                              if($row ->user_active == 0)
                              {
                                   $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Account not yet active!</div>');
                                   redirect('login/doLogin');
                              }
                              else if($row ->user_isquitclaim == 1)
                              {

                        					$company = substr( $row->user_sbu, 0, strrpos( $row->user_sbu, '-' ) );
                                   $sessiondata = array(
                                   'employeeID' => $row->user_employeeID,
                                   'username' =>$row->user_username,
                                   'SBU' =>  $row ->user_sbu,
                                   'positiontitle' =>  $row ->user_positiontitle,
                                   'rank' => $row ->user_rank,
                                   'dateofhire' =>  $row ->user_date_of_hire,
                                   'Location' =>  $row ->user_location,
                                   'fullname' => $row->user_firstname . " " . $row->user_middlename . " " . $row->user_lastname,
                                   'fname'=>$row->user_firstname,
                                   'mname'=>$row->user_middlename,
                                   'lname'=>$row->user_lastname,
                                   'email' => $row->user_email,
                                   'company'=>$company,
                                   'isquitclaim'=>1,
                                   'loginuser' => TRUE
                                    );

                                   $this->session->set_userdata('logged_in', $sessiondata);
                                   redirect('Quitclaim');

                              }
                              else
                              {
                                $company = substr( $row->user_sbu, 0, strrpos( $row->user_sbu, '-' ) );
                              $sessiondata = array(
                              'employeeID' => $row->user_employeeID,
                              'username' =>$row->user_username,
                              'SBU' =>  $row ->user_sbu,
                              'positiontitle' =>  $row ->user_positiontitle,
                              'rank' => $row ->user_rank,
                              'dateofhire' =>  $row ->user_date_of_hire,
                              'Location' =>  $row ->user_location,
                              'fullname' => $row->user_firstname . " " . $row->user_middlename . " " . $row->user_lastname,
                              'fname'=>$row->user_firstname,
                              'mname'=>$row->user_middlename,
                              'lname'=>$row->user_lastname,
                              'email' => $row->user_email,
                              'company'=>$company,
                              'isquitclaim'=>0,
                              'loginuser' => TRUE
                                                  );
                         }
                         $this->session->set_userdata('logged_in', $sessiondata);
                         redirect("User/dashboard1");
                    }

                    }
                    else
                    {
                         $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Invalid username and password!</div>');
                         redirect('login/doLogin');
                    }
               }
               else
               {
                    redirect('login/doLogin');
               }
          }
     }
}?>
