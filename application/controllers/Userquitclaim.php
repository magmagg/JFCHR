<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Userquitclaim extends CI_Controller
{
  public function __construct()
	{
    parent::__construct();
    $this->load->model('Model_user');
    $session_data = $this->session->userdata('logged_in');
    $datas['lname'] = $session_data['lname'];
    $userid = $session_data['employeeID'];
    $datas['company'] = $session_data['company'];
    $datas['fname'] = $session_data['fname'];
    $datas['SBU'] = $session_data['SBU'];
  //	$datas['company'] = $session_data['company'];
    $quitclaim['data'] = $this->Model_user->get_quitclaim_active();
    foreach($quitclaim['data'] as $d)
    {
      if($d->user_isquitclaim == 1)
      {
        $this->session->set_flashdata('quitclaim', '<div class="alert alert-danger text-center">Quitclaim active</div>');

      }
    }
    $datas['policies'] = $this->Model_user->get_policies($datas['company']);
    $datas['policycateg'] = $this->Model_user->get_policy_category($datas['company']);
    $datas['notif'] = $this->Model_user->get_user_notifications($userid);

    $counter = 0;
    if($datas['notif'])
    {
      $counter = 0;
      foreach($datas['notif'] as $n)
      {
        if($n->notif_isread == 0)
        {
          $counter++;
        }
        else
        {

        }
      }
    }
    else
    {

    }
    $datas['count'] = $counter;
$quitclaim_id = $this->uri->segment(3);
    $data['quitclaim'] = $this->Model_user->get_quitclaim_progress_for_approval($quitclaim_id);
    foreach($data['quitclaim'] as $q)
    {
      $datas['quitclaimID'] = $q->quitclaim_id;
      $datas['file'] = $q->quitclaim_file_chat;
    }

    $session_data = $this->session->userdata('logged_in');
		$datas['employeeID'] = $session_data['employeeID'];
    $datas['lname'] = $session_data['lname'];
    $this->load->view('quitclaim_header',$datas);
  }

  function download_final_quitclaim_docu()
  {
    $docuname = $this->uri->segment(3);
    $name = 'G:\xampp\htdocs\JFCHR\application\quitclaimdocuments\signeddocuments\\'. $docuname;
    force_download($name, NULL);
  }


  	function view_one_quitclaim()
  	{
  		if($this->session->userdata('logged_in'))
  		{
  			$session_data = $this->session->userdata('logged_in');
  			$employeeID = $session_data['employeeID'];
  			$quitclaim_id = $this->uri->segment(3);
  			$data['quitclaim'] = $this->Model_user->get_quitclaim_progress_for_approval($quitclaim_id);
  			$data['comments'] = $this->Model_user->get_quitclaim_comments($quitclaim_id);
  			$data['scripts'] = $this->Model_user->get_generated_scripts($employeeID);
  			$data['employeeid'] = $employeeID;

  			$data['users'] = $this->Model_user->get_users();
  			$this->load->view('QuitClaim/view_one_quitclaim_approval_page', $data);
  		}
  		else
  			{
  				 //If no session, redirect to login page
  				 redirect('login', 'refresh');
  			}
  	}

function insert_to_database()
{
  $nickname = htmlentities(strip_tags($_POST['nickname']), ENT_QUOTES);
  $message = htmlentities(strip_tags($_POST['message']), ENT_QUOTES);
  $quitclaimID = $_POST['quitclaimID'];
  $plainmessage = $message;

              $ci =& get_instance();
  $now = time();
  $timeposted = unix_to_human($now);
  $data = array('qc_sender_id'=>$nickname,
               'qc_user_quitclaim_id'=>$quitclaimID,
               'qc_comment'=>$plainmessage,
               'qc_timestamp'=>$timeposted);

  $this->Model_user->post_quitclaim_comment($data);
  console.log('pota');
}
}
