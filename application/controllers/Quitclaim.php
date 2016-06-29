<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Quitclaim extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_user');

		$session_data = $this->session->userdata('logged_in');
		$data['employeeID'] = $session_data['employeeID'];
		$data['fname'] = $session_data['fname'];
		$data['lname'] = $session_data['lname'];
		$data['SBU'] = $session_data['SBU'];
		$data['quitclaim'] = $this->Model_user->get_quitclaim_progress();
		foreach($data['quitclaim'] as $q)
		{
			$data['quitclaimID'] = $q->quitclaim_id;
			$data['file'] = $q->quitclaim_file_chat;
		}
		$this->load->view('QuitClaim/header_quitclaim',$data);
	}

	function download_generated_report()
	{
		$docuname = $this->uri->segment(3);
		$name = 'G:\xampp\htdocs\JFCHR\application\createdwordfile\\'. $docuname;
		force_download($name, NULL);
	}

	function index()
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
      $employeeID = $session_data['employeeID'];

			$data['quitclaim'] = $this->Model_user->get_quitclaim_progress();
			foreach($data['quitclaim'] as $q)
			{
				$id = $q->quitclaim_id;
				$file = $q->quitclaim_file_chat;
			}
			$data['users'] = $this->Model_user->get_users();
			$data['comments'] = $this->Model_user->get_quitclaim_comments($id);
			$data['scripts'] = $this->Model_user->get_generated_scripts($employeeID);
			$data['noishr'] = $this->Model_user->get_if_with_ishr($id);
			$data['quitclaimid'] = $id;
			$count = 0;
			foreach($data['quitclaim'] as $q)
			{
				$postid = $q->quitclaim_id;
				if($q->quitclaim_isapproved == 1)
				{

					$count++;
				}
			}
			$data['maxhierarchy'] = $this->Model_user->get_max_hierarchy($postid);
			foreach($data['maxhierarchy'] as $d)
			{
				$maxhierarchy = $d->hierarchy;
			}
			if($maxhierarchy == $count)
			{
				$data['document'] = $this->Model_user->get_quitclaim_document($postid);
			}

			$data['noishrflag'] = 0;
			$checkarray = array();

			foreach($data['noishr'] as $d)
			{
				$checkarray[] = $d->quitclaim_hierarchy;
			}
			if(in_array("1",$checkarray))
			{
				//DoNothing
			}
			else
			{
				$data['noishrflag'] = 1;
			}


			$this->load->view('QuitClaim/index_quitclaim',$data);
		}
		else
   		{
  		   redirect('login', 'refresh');
  		}
	}

	function submit_comment()
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
            $employeeID = $session_data['employeeID'];

            $now = time();
			$timeposted = unix_to_human($now);

            $quitclaimid = $_POST['quitclaimid'];
            $comment = $_POST['comment'];

            $data = array('qc_sender_id'=>$employeeID,
            			  'qc_user_quitclaim_id'=>$quitclaimid,
            			  'qc_comment'=>$comment,
            			  'qc_timestamp'=>$timeposted);

			$this->Model_user->post_quitclaim_comment($data);
			redirect('quitclaim');
		}
		else
   		{
  		   redirect('login', 'refresh');
  		}
	}

	function submit_ishr()
	{
		if($this->session->userdata('logged_in'))
		{
			$quitclaimid = $this->input->post('quitclaimid');
			$is = $this->input->post('is');
			$hr = $this->input->post('hr');

			$data = array('quitclaim_isapproved'=>0,
										'quitclaim_hierarchy'=>1,
										'quitclaim_reversehierarchy'=>1,
										'quitclaim_approvers_emp_id'=>$is,
										'quitclaim_timeapproved'=>'N/A',
										'quitclaim_id_fk'=>$quitclaimid);
			$this->Model_user->insert_approver($data);
			$id = $this->Model_user->get_last_id();
			$data = array('quitclaim_id'=>$quitclaimid,
										'quitclaim_approvers_table_id'=>$id);
			$this->Model_user->insert_transaction_qc($data);




			$data = array('quitclaim_isapproved'=>0,
										'quitclaim_hierarchy'=>2,
										'quitclaim_reversehierarchy'=>0,
										'quitclaim_approvers_emp_id'=>$hr,
										'quitclaim_timeapproved'=>'N/A',
										'quitclaim_id_fk'=>$quitclaimid);
			$this->Model_user->insert_approver($data);
			$id = $this->Model_user->get_last_id();
			$data = array('quitclaim_id'=>$quitclaimid,
										'quitclaim_approvers_table_id'=>$id);
			$this->Model_user->insert_transaction_qc($data);

								$this->session->set_flashdata('success', '<div class="alert alert-success text-center">Success!</div>');
			redirect('quitclaim');
		}
		else
			{
				 redirect('login', 'refresh');
			}
	}

	function generate_scripts()
	{
		$session_data = $this->session->userdata('logged_in');
		$lname = $session_data['lname'];
		$id = $this->uri->segment(3);
		$data['chat'] = $this->Model_user->get_quitclaim_comments_for_generation($id);
		$lname = str_replace(' ', '_', $lname);

		var_dump($data['chat']);

		if($data['chat'])
		{
			require_once APPPATH.'/libraries/PHPWord/src/PhpWord/Autoloader.php';

			\PhpOffice\PhpWord\Autoloader::register();

			// Creating the new document...
			$phpWord = new \PhpOffice\PhpWord\PhpWord();

			/* Note: any element you append to a document must reside inside of a Section. */

			// Adding an empty Section to the document...
			$section = $phpWord->addSection();



			foreach($data['chat'] as $c)
			{
				//print_r($data['chat']);
				$qc_id = $c->qc_user_quitclaim_id;
				$fontStyle = new \PhpOffice\PhpWord\Style\Font();
				$fontStyle->setBold(true);
				$fontStyle->setSize(13);
				$myTextElement = $section->addText($c->user_lastname.' on '.$c->qc_timestamp);
				$myTextElement->setFontStyle($fontStyle);
				$section->addText("        -".$c->qc_comment);

			}

			$now = time();
				$timeupdated = unix_to_human($now);
				$fontStyle = new \PhpOffice\PhpWord\Style\Font();
				$fontStyle->setBold(true);
				$fontStyle->setSize(13);
				$fontStyle->setColor('Red');
				$myTextElement = $section->addText('Generated on:'.$timeupdated);
				$myTextElement->setFontStyle($fontStyle);

				$bits = 2;
				$rand = bin2hex(openssl_random_pseudo_bytes($bits));

			// Saving the document as OOXML file...
			$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
			$path = APPPATH.'createdwordfile/'.$lname.$qc_id.$rand.'Scripts.docx';
			$objWriter->save($path);
			$rawname = $lname.$qc_id.$rand.'Scripts.docx';
			$rawnamenoextension = $lname.$qc_id.$rand.'Scripts';

			$FILEPATH = APPPATH.'createdwordfile/';

			\PhpOffice\PhpWord\Settings::setPdfRendererPath(APPPATH.'libraries/tcpdf');
			\PhpOffice\PhpWord\Settings::setPdfRendererName('TCPDF');


			$phpWord = new \PhpOffice\PhpWord\PhpWord();

			//Open template and save it as docx
			$document = $phpWord->loadTemplate($FILEPATH.$rawname);
			$document->saveAs('temp.docx');

			//Load temp file
			$phpWord = \PhpOffice\PhpWord\IOFactory::load('temp.docx');

			//Save it
			$xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord , 'PDF');
			$pdfpath = $FILEPATH.$rawnamenoextension.'.pdf';
			$xmlWriter->save($pdfpath);





           // var_dump($data['chat']);

			$session_data = $this->session->userdata('logged_in');
            $employeeID = $session_data['employeeID'];
            $data = array('scripts_path'=>$FILEPATH,
            	'scripts_employeeID'=>$employeeID,
            	'scripts_timestamp'=>$timeupdated,
            	'scripts_raw_name'=>$rawnamenoextension.'.pdf',
							'scripts_quitclaim_id'=>$id);;
            $this->Model_user->insert_generated_scripts($data);
            redirect(base_url().'quitclaim');
		}
	}

	function download_script()
	{
		$docuname=  $this->uri->segment(3);
		$name = APPPATH.'createdwordfile/'.$docuname;
		force_download($name,NULL);
	}

	function download_document()
	 {
		$docuname = $this->uri->segment(3);
		$name = 'G:/xampp/htdocs/JFCHR/uploads/'. $docuname;
		force_download($name, NULL);
	}

	function download_final_quitclaim_docu()
	{
		$ownerid = $this->uri->segment(3);
		$data['docu'] = $this->Model_user->get_quitclaim_final($ownerid);
		foreach($data['docu'] as $d)
		{
			$name = $d->quitclaim_document_path;
		}
		force_download($name, NULL);
	}





	function logout()
	{
		session_destroy();
		redirect('login');
	}
}
