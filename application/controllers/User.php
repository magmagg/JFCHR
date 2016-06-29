<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_user');
		$session_data = $this->session->userdata('logged_in');
		$datas['fname'] = $session_data['fname'];
		$datas['lname'] = $session_data['lname'];
		$userid = $session_data['employeeID'];
		$datas['company'] = $session_data['company'];
		$datas['SBU'] = $session_data['SBU'];
		$quitclaim['data'] = $this->Model_user->get_quitclaim_active();
		foreach($quitclaim['data'] as $d)
		{
			if($d->user_isquitclaim == 1)
			{
				$this->session->set_flashdata('quitclaim', '<div class="alert alert-danger text-center">Quitclaim active</div>');
				redirect('Quitclaim');
			}
		}
	//	$datas['messages'] = $this->Model_user->get_three_messages();
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
		$this->load->view('header', $datas);

	}

	function dashboard1()
	{
		$this->load->view('home_view_employee');
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
						redirect(base_url().'Userquitclaim/view_one_quitclaim/'.$id);
		}
	}


	function all_policy_categories()
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$datas['company'] = $session_data['company'];
				$data['categories'] = $this->Model_user->get_policy_category($datas['company']);
				$this->load->view('all_policy_categories',$data);
		}
		else
			{
				 //If no session, redirect to login page
				 redirect('login', 'refresh');
			}
	}

	function view_all_policy_sub_categories()
	{
		if($this->session->userdata('logged_in'))
		{
			$policycategid = $this->uri->segment(3);
			$data['policies'] = $this->Model_user->get_policy_data($policycategid);
			$this->load->view('view_all_policy_sub_categories',$data);
		}
		else
			{
				 //If no session, redirect to login page
				 redirect('login', 'refresh');
			}
	}

	function index()
	{
		if($this->session->userdata('logged_in'))
		{
			$with_announcements = $this->Model_user->get_announcements();
			if($with_announcements)
			{
				$data['announcements'] = $this->Model_user->get_announcements();
				$this->load->view('announcement_view',	$data);
			}
			else
			{
				$this->session->set_flashdata('noannounce', '<div class="alert alert-danger text-center">No announcements available.</div>');
				$this->load->view('announcement_view');
			}
		}
		else
   		{
    		 //If no session, redirect to login page
  		   redirect('login', 'refresh');
  		}
	}

	function view_one_announcement()
	{
		if($this->session->userdata('logged_in'))
		{
			$id = $this->uri->segment(3);
			$data['announcement'] = $this->Model_user->get_one_announcement($id);
			$this->load->view('view_one_announcement_page', $data);
		}
		else
   		{
    		 //If no session, redirect to login page
  		   redirect('login', 'refresh');
  		}
	}

	function dashboard()
	{
		if($this->session->userdata('logged_in'))
		{
		$session_data = $this->session->userdata('logged_in');
		$data['employeeID'] = $session_data['employeeID'];
		$data['username'] = $session_data['username'];
    	$data['SBU'] = $session_data['SBU'];
    	$data['positiontitle'] = $session_data['positiontitle'];
    	$data['rank'] = $session_data['rank'];
    	$data['dateofhire'] = $session_data['dateofhire'];
    	$data['location'] = $session_data['Location'];
    	$data['fullname'] = $session_data['fullname'];
 		$data['fname'] = $session_data['fname'];
 		$data['lname'] = $session_data['lname'];
 		$data['mname'] = $session_data['mname'];
    	$data['email'] = $session_data['email'];
    	$this->load->view('home_view', $data);
    	}
    	else
   		{
    		 //If no session, redirect to login page
  		   redirect('login', 'refresh');
  		}
	}

	function announcements()
	{
		if($this->session->userdata('logged_in'))
		{
			$with_announcements = $this->Model_user->get_announcements();
			if($with_announcements)
			{
				$data['announcements'] = $this->Model_user->get_announcements();
				$this->load->view('announcement_view',	$data);
			}
			else
			{
				$this->session->set_flashdata('noannounce', '<div class="alert alert-danger text-center">No announcements available.</div>');
				$this->load->view('announcement_view');
			}
		}
		else
   		{
    		 //If no session, redirect to login page
  		   redirect('login', 'refresh');
  		}
	}

	function view_policy()
	{
		if($this->session->userdata('logged_in'))
		{
			$policyID = $this->uri->segment(3);
			$policypage['policy'] = $this->Model_user->get_policy($policyID);
			$this->load->view('policy_page', $policypage);
		}
		else
   		{
    		 //If no session, redirect to login page
  		   redirect('login', 'refresh');
  		}
	}

	function view_messages()
	{
		if($this->session->userdata('logged_in'))
		{
			$data['users'] = $this->Model_user->get_users();
			$data['messages'] = $this->Model_user->get_messages();
			$data['sentmessages'] = $this->Model_user->get_sent_messages();
			$this->load->view('messages_view', $data);
		}
		else
   		{
    		 //If no session, redirect to login page
  		   redirect('login', 'refresh');
  		}

	}

     function send_message()
     {
     	if($this->session->userdata('logged_in'))
		{
     		$session_data = $this->session->userdata('logged_in');
               $usr['userid'] = $session_data['employeeID'];
               $usr['fname'] = $session_data['fname'];
               $usr['lname'] = $session_data['lname'];
     		$now = time();
			$timeposted = unix_to_human($now);

				$data = array('message'=>$_POST['message'],
											'message_timestamp'=>$timeposted
										);



			$this->Model_user->insert_message($data);
			$message_id = $this->Model_user->get_last_message_id();

			foreach($_POST['receivers'] as $rcvr)
			{
				$datareceive['people_sender_id'] = $usr['userid'];
				$datareceive['people_receiver_id'] = $rcvr;
				$datareceive['people_message_fk'] = $message_id;
				$this->Model_user->insert_message_to_user($datareceive);

				$transact_id = $this->Model_user->get_last_message_id();

				$data = array('messages1_fk'=>$message_id,
											'receivers_fk'=>$transact_id);
				$this->Model_user->insert_transaction($data);
			}


			$this->session->set_flashdata('message_sent', '<div class="alert alert-success text-center">Message sent!</div>');
			redirect(base_url()."user/view_messages");
		}
		else
		{
    		 //If no session, redirect to login page
  		   redirect('login', 'refresh');
  		}
     }

     function view_forms()
     {
     	if($this->session->userdata('logged_in'))
			{
				$session_data = $this->session->userdata('logged_in');
				$company = $session_data['company'];
				$data['documents'] = $this->Model_user->get_documents($company);
				$this->load->view('view_forms', $data);
	    }
		else
		{
    		 //If no session, redirect to login page
  		   redirect('login', 'refresh');
  		}
     }

     function view_archives()
     {
     	if($this->session->userdata('logged_in'))
		{
	     	$data['documents'] = $this->Model_user->get_documents();
	     	$this->load->view('view_archives', $data);
	     }
	     else
		 {
    		 //If no session, redirect to login page
  		   redirect('login', 'refresh');
  		 }
     }

     function download_document()
	 {
		$docuname = $this->uri->segment(3);
		$name = 'G:\xampp\htdocs\JFCHR\uploads' . '\\' . $docuname;
		force_download($name, NULL);
	}


	function view_benefits_enrollment()
    {
    	if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$rank = $session_data['rank'];
			$sbu = $session_data['SBU'];
			$data['dateofhire'] = $session_data['dateofhire'];

			$data['docu'] = $this->Model_user->get_benefit($rank,$sbu);
	    	$this->load->view('benefits_enrollment_view',$data);
	    }
	    else
		{
    		 //If no session, redirect to login page
  		   redirect('login', 'refresh');
  		}
    }

    function view_quitclaim()
	{
		if($this->session->userdata('logged_in'))
		{
			$this->load->view('QuitClaim/quitclaim_modal_sure');
				$this->load->view('QuitClaim/quitclaim_modal_sure1');
			$this->load->view('QuitClaim/quitclaim_view');
		}
		else
	   	{
	    	 //If no session, redirect to login page
	  	   redirect('login', 'refresh');
	  	}
	}


    function view1_quitclaim_to_be_approved()
	{
		if($this->session->userdata('logged_in'))
		{
			$data['quitclaim'] = $this->Model_user->get_all_quitclaim_where_user_is();
			$this->load->view('QuitClaim/quitclaim_tobeapproved',  $data);
		}
		else
	   	{
	    	 //If no session, redirect to login page
	  	   redirect('login', 'refresh');
	  	}
	}

	function view_one_quitclaim()
	{
		if($this->session->userdata('logged_in'))
		{
			$quitclaim_id = $this->uri->segment(3);
			$data['quitclaim'] = $this->Model_user->get_quitclaim_progress_for_approval($quitclaim_id);
			$this->load->view('QuitClaim/view_one_quitclaim_approval_page', $data);
		}
		else
   		{
    		 //If no session, redirect to login page
  		   redirect('login', 'refresh');
  		}
	}
/*
		function process_quitclaim()
		{
			if($this->session->userdata('logged_in'))
			{
				if($this->input->post('btn_dcs') == "Approve")
				{
					$bits = 2;
					$rand = bin2hex(openssl_random_pseudo_bytes($bits));

					$target_dir = APPPATH . 'signatures\\';
					$target_file = $target_dir . $rand.'signature.png';
					$uploadOk = 1;
					$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
					// Check if image file is a actual image or fake image
					if(isset($_POST["btn_dcs"]))
					{
					    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
					    if($check !== false)
							{
					        echo "File is an image - " . $check["mime"] . ".";
					        $uploadOk = 1;
					    }
							else
							{
					        echo "File is not an image.";
					        $uploadOk = 0;
					    }
					}
					// Check if file already exists
					if (file_exists($target_file))
					{
					    echo "Sorry, file already exists.";
					    $uploadOk = 1;
					}
					// Check file size
					if ($_FILES["fileToUpload"]["size"] > 500000)
					{
					    echo "Sorry, your file is too large.";
					    $uploadOk = 0;
					}
					// Allow certain file formats
					if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
					&& $imageFileType != "gif" )
					{
					    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
					    $uploadOk = 0;
					}
					// Check if $uploadOk is set to 0 by an error
					if ($uploadOk == 0)
					{

											require_once(APPPATH . 'libraries/jSignature_Tools_Base30.php');
											$imgStr = $_POST['signature'];

										$split = "";
										list($type, $split) = explode(";", $imgStr);

										// removes the raw encoded image data
										list($encType, $split) = explode(",", $split);

										$converter = new jSignature_Tools_Base30();

										// $split now just contains "HEhda1ZDGAD_EDFddjeAD"
										$raw = $converter->Base64ToNative($split);

										// Create a image
											$im = imagecreatetruecolor(300, 150);

											// Save transparency for PNG
											imagesavealpha($im, true);

											// Fill background with transparency
											$trans_colour = imagecolorallocatealpha($im, 255, 255, 255, 127);
											imagefill($im, 0, 0, $trans_colour);

											// Set pen thickness
											imagesetthickness($im, 5);

											// Set pen color to blue
											$black = imagecolorallocate($im, 0, 0, 0);

											// Loop through array pairs from each signature word
											for ($i = 0; $i < count($raw); $i++)
											{
													// Loop through each pair in a word
													for ($j = 0; $j < count($raw[$i]['x']); $j++)
													{
															// Make sure we are not on the last coordinate in the array
															if ( ! isset($raw[$i]['x'][$j]) or ! isset($raw[$i]['x'][$j+1])) break;
															// Draw the line for the coordinate pair
															imageline($im, $raw[$i]['x'][$j], $raw[$i]['y'][$j], $raw[$i]['x'][$j+1], $raw[$i]['y'][$j+1], $black);
													}
											}
											$bits = 2;
											$rand = bin2hex(openssl_random_pseudo_bytes($bits));
											$mysignature =APPPATH . 'signatures\\'.$rand.'signature.png'; // Make folder path is writeable
											imagepng($im,$mysignature); // Removing $filename will output to browser instead of saving

											// start an output buffer to write the raw image data to
											ob_start();
												 imagepng($im);
												 $out = ob_get_contents();
											ob_end_clean();

											// clean up the image resource handle
											imagedestroy($im);
					}
					else
					{
					    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))
							{
					        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
					    }
							else
							{
					        echo "Sorry, there was an error uploading your file.";
					    }
					}

					include_once APPPATH.'libraries/PHPWord/samples/header_quitclaim.php';

					$signpath = APPPATH . 'signatures\\'.$rand.'signature.png';

					// Read contents
					$session_data = $this->session->userdata('logged_in');
		      $lname = $session_data['lname'];
					$file = $this->input->post('file');
					$filename = $lname.$this->input->post('filename');
					$quitclaimdocumentid = $this->input->post('quitclaimdocumentid');

					$data = array('signature_path'=>$signpath,
											  'signature_quitclaim_pk_fk'=>$quitclaimdocumentid,
											  'signature_lastname'=>$lname);
					$this->Model_user->insert_signature($data);


					$postid = $this->uri->segment(3);
		    	$now = time();
					$timeposted = unix_to_human($now);
					$quitclaimidfk = $this->input->post('quitclaimidfk');
					$quitclaimidtable = $this->input->post('quitclaimidtable');

					$this->Model_user->accept_quitclaim($postid,$timeposted);



					$data['maxhierarchy'] = $this->Model_user->get_max_hierarchy($postid);
					foreach($data['maxhierarchy'] as $d)
					{
						$maxhierarchy = $d->hierarchy;
					}

					$yes_last_approver = $this->Model_user->check_if_last_approver($postid, $maxhierarchy);

					$this->Model_user->tag_approved($quitclaimidtable);

					$tagall = 0;
					$quitclaim_id_fk = 0;
					$quitclaim_all_approving = 0;
					$data['currenthierarchy'] = $this->Model_user->get_hierarchy($quitclaimidtable);
					foreach($data['currenthierarchy'] as $d)
					{
						$quitclaim_all_approving = $d->quitclaim_all_approving;
						$quitclaim_id_fk = $d->quitclaim_id_fk;
						if($d->quitclaim_hierarchy == 2)
						{
							$tagall = 1;
						}
						else
						{
							$tagall = 0;
						}
					}

					if($yes_last_approver)
					{
						$data['sign'] = $this->Model_user->get_signatures($quitclaimdocumentid);
						$phpWord = \PhpOffice\PhpWord\IOFactory::load($file);

						$sections = $phpWord->getSections();
						$section = $sections[0]; // le document ne contient qu'une section
						$arrays = $section->getElements();
						foreach($data['sign'] as $s)
						{
							$section->addText('');
							$section->addImage($s->signature_path);
							$section->addText('Signed by '.$s->signature_lastname);
						}


						write($phpWord, basename(__FILE__, '.php'), $writers,$filename,$quitclaimdocumentid);



						$word = new COM("Word.Application") or die ("Could not initialise Object.");
									// set it to 1 to see the MS Word window (the actual opening of the document)
									$word->Visible = 0;
									// recommend to set to 0, disables alerts like "Do you want MS Word to be the default .. etc"
									$word->DisplayAlerts = 0;
									// open the word 2007-2013 document
									$word->Documents->Open(APPPATH . "quitclaimdocuments\signeddocuments\\$filename");
									// save it as word 2003
									$filename = str_replace('.docx','.pdf',$filename);
									$word->ActiveDocument->SaveAs('newdocument.doc');
									// convert word 2007-2013 to PDF
									$word->ActiveDocument->ExportAsFixedFormat(APPPATH . "quitclaimdocuments\signeddocuments\\$filename", 17, false, 0, 0, 0, 0, 7, true, true, 2, true, true, false);
									// quit the Word process
									$word->Quit(false);
									// clean up
									unset($word);


									$data = array(
										'quitclaim_document_path'=>APPPATH . "quitclaimdocuments\signeddocuments\\$filename",
										'quitclaim_document_filename'=>$filename);


										$this->Model_user->update_quitclaim_document($data,$quitclaimdocumentid);
										$doneid = $this->input->post('senderid');
										$data1 = array('done_employeeID'=>$doneid,
																	 'done_timestamp'=>$timeposted);
										$this->Model_user->insert_done_employee($data1);

					}
					else
					{
										$quitclaimidtable++;
										if($tagall == 0)
										{
											if($quitclaim_all_approving == 1)
											{
												//Don'tTag
											}
											else
											{
												$this->Model_user->tag_next_approver($quitclaimidtable);
											}

										}
										else if($tagall == 1)
										{
											$this->Model_user->tag_all_approvers($quitclaim_id_fk);

											$this->Model_user->remove_tag($quitclaim_id_fk);
											$this->Model_user->remove_tag_two($quitclaim_id_fk);
										}

					}



					$this->session->set_flashdata('accepted', '<div class="alert alert-success text-center">Document Approved!</div>');
					redirect(base_url()."user/view1_quitclaim_to_be_approved");



				}

				else if($this->input->post('btn_dcs') == "Reject")
				{
					$postid = $this->uri->segment(3);
		    		$now = time();
					$timeposted = unix_to_human($now);
					$data['dcs'] = $this->Model_user->get_rejector_quitclaim($postid,$timeposted);
					$this->session->set_flashdata('accepted', '<div class="alert alert-danger text-center">Document Rejected!</div>');
					redirect(base_url()."user/view1_quitclaim_to_be_approved");
					}
				}

			else
	   		{
	    		 //If no session, redirect to login page
	  		   redirect('login', 'refresh');
	  		}
		}
		*/


			function process_quitclaim()
			{
				if($this->session->userdata('logged_in'))
				{
					if($this->input->post('btn_dcs') == "Approve")
					{
						$bits = 2;
						$rand = bin2hex(openssl_random_pseudo_bytes($bits));

						$target_dir = APPPATH . 'signatures\\';
						$target_file = $target_dir . $rand.'signature.png';
						$uploadOk = 1;
						$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
						// Check if image file is a actual image or fake image
						if(isset($_POST["btn_dcs"]))
						{
						    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
						    if($check !== false)
								{
						        echo "File is an image - " . $check["mime"] . ".";
						        $uploadOk = 1;
						    }
								else
								{
						        echo "File is not an image.";
						        $uploadOk = 0;
						    }
						}
						// Check if file already exists
						if (file_exists($target_file))
						{
						    echo "Sorry, file already exists.";
						    $uploadOk = 1;
						}
						// Check file size
						if ($_FILES["fileToUpload"]["size"] > 500000)
						{
						    echo "Sorry, your file is too large.";
						    $uploadOk = 0;
						}
						// Allow certain file formats
						if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
						&& $imageFileType != "gif" )
						{
						    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
						    $uploadOk = 0;
						}
						// Check if $uploadOk is set to 0 by an error
						if ($uploadOk == 0)
						{

												require_once(APPPATH . 'libraries/jSignature_Tools_Base30.php');
												$imgStr = $_POST['signature'];

											$split = "";
											list($type, $split) = explode(";", $imgStr);

											// removes the raw encoded image data
											list($encType, $split) = explode(",", $split);

											$converter = new jSignature_Tools_Base30();

											// $split now just contains "HEhda1ZDGAD_EDFddjeAD"
											$raw = $converter->Base64ToNative($split);

											// Create a image
												$im = imagecreatetruecolor(300, 150);

												// Save transparency for PNG
												imagesavealpha($im, true);

												// Fill background with transparency
												$trans_colour = imagecolorallocatealpha($im, 255, 255, 255, 127);
												imagefill($im, 0, 0, $trans_colour);

												// Set pen thickness
												imagesetthickness($im, 5);

												// Set pen color to blue
												$black = imagecolorallocate($im, 0, 0, 0);

												// Loop through array pairs from each signature word
												for ($i = 0; $i < count($raw); $i++)
												{
														// Loop through each pair in a word
														for ($j = 0; $j < count($raw[$i]['x']); $j++)
														{
																// Make sure we are not on the last coordinate in the array
																if ( ! isset($raw[$i]['x'][$j]) or ! isset($raw[$i]['x'][$j+1])) break;
																// Draw the line for the coordinate pair
																imageline($im, $raw[$i]['x'][$j], $raw[$i]['y'][$j], $raw[$i]['x'][$j+1], $raw[$i]['y'][$j+1], $black);
														}
												}
												$bits = 2;
												$rand = bin2hex(openssl_random_pseudo_bytes($bits));
												$mysignature =APPPATH . 'signatures\\'.$rand.'signature.png'; // Make folder path is writeable
												imagepng($im,$mysignature); // Removing $filename will output to browser instead of saving

												// start an output buffer to write the raw image data to
												ob_start();
													 imagepng($im);
													 $out = ob_get_contents();
												ob_end_clean();

												// clean up the image resource handle
												imagedestroy($im);
						}
						else
						{
						    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))
								{
						        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
						    }
								else
								{
						        echo "Sorry, there was an error uploading your file.";
						    }
						}

						include_once APPPATH.'libraries/PHPWord/samples/header_quitclaim.php';

						$signpath = APPPATH . 'signatures\\'.$rand.'signature.png';

						// Read contents
						$session_data = $this->session->userdata('logged_in');
			      $lname = $session_data['lname'];
						$eidsign = $session_data['employeeID'];
						$file = $this->input->post('file');
						$filename = $this->input->post('filename');
						$quitclaimdocumentid = $this->input->post('quitclaimdocumentid');

						$data = array('signature_path'=>$signpath,
												  'signature_quitclaim_pk_fk'=>$quitclaimdocumentid,
												  'signature_lastname'=>$lname,
													'signature_eid'=>$eidsign);
						$this->Model_user->insert_signature($data);


						$postid = $this->uri->segment(3);
			    	$now = time();
						$timeposted = unix_to_human($now);
						$quitclaimidfk = $this->input->post('quitclaimidfk');
						$quitclaimidtable = $this->input->post('quitclaimidtable');

						$this->Model_user->accept_quitclaim($postid,$timeposted);



						$data['maxhierarchy'] = $this->Model_user->get_max_hierarchy($postid);
						foreach($data['maxhierarchy'] as $d)
						{
							$maxhierarchy = $d->hierarchy;
						}

						$yes_last_approver = $this->Model_user->check_if_last_approver($postid, $maxhierarchy);

						$this->Model_user->tag_approved($quitclaimidtable);

						$tagall = 0;
						$quitclaim_id_fk = 0;
						$quitclaim_all_approving = 0;
						$data['currenthierarchy'] = $this->Model_user->get_hierarchy($quitclaimidtable);
						foreach($data['currenthierarchy'] as $d)
						{
							$quitclaim_all_approving = $d->quitclaim_all_approving;
							$quitclaim_id_fk = $d->quitclaim_id_fk;
							if($d->quitclaim_hierarchy == 2)
							{
								$tagall = 1;
							}
							else
							{
								$tagall = 0;
							}
						}

						if($yes_last_approver)
						{
							/*
							$data['sign'] = $this->Model_user->get_signatures($quitclaimdocumentid);
							$phpWord = \PhpOffice\PhpWord\IOFactory::load($file);

							$sections = $phpWord->getSections();
							$section = $sections[0]; // le document ne contient qu'une section
							$arrays = $section->getElements();
							foreach($data['sign'] as $s)
							{
								$section->addText('');
								$section->addImage($s->signature_path);
								$section->addText('Signed by '.$s->signature_lastname);
							}


							write($phpWord, basename(__FILE__, '.php'), $writers,$filename,$quitclaimdocumentid);
							*/

							$data['currentquitclaim'] = $this->Model_user->get_id_quitclaimer($quitclaim_id_fk);

							foreach($data['currentquitclaim'] as $q)
							{
								$fullname = $q->quitclaim_sender;
								$eid = $q->quitclaim_senderid;
							}

							$data['userdetails'] = $this->Model_user->get_one_userdetails($eid);

							foreach($data['userdetails'] as $u)
							{
								$position = $u->user_positiontitle;
								$sbu = $u->user_sbu;
								$doh = $u->user_date_of_hire;
							}


							require_once APPPATH.'/libraries/PHPWord/src/PhpWord/Autoloader.php';

							\PhpOffice\PhpWord\Autoloader::register();

							// Creating the new document...
							$phpWord = new \PhpOffice\PhpWord\PhpWord();

							/* Note: any element you append to a document must reside inside of a Section. */

							// Adding an empty Section to the document...
							$section = $phpWord->addSection(array('pageSizeW' =>11906,'pageSizeH'=>20160,'marginLeft'=>720,'marginRight'=>720,'marginBottom'=>720,'marginTop'=>720));

							// Saving the document as OOXML file...

							$phpWord->addFontStyle('rStyle', array('name' => 'Calibri','bold' => true,'allCaps' => true));
							$phpWord->addParagraphStyle('pStyle', array('align' => 'center', 'spaceAfter' => 300));
							$phpWord->addParagraphStyle('rightp', array('align' => 'right'));
							$section->addText(htmlspecialchars($sbu), 'rStyle', 'pStyle');
							$section->addText(htmlspecialchars('EMPLOYEE CLEARANCE AND QUIT CLAIM'), 'rStyle', 'pStyle');

							$section->addTextBreak(1);
							$styleTable = array('borderSize' => 6, 'borderColor' => '000000', 'cellMargin' => 80);
							$fontStyle = array('name' => 'Calibri','bold' => true,'size' => 10);
							$fontStyle1 = array('name' => 'Calibri','size' => 10);
							$paragraphStyle = array('align' => 'center');
							$paragraphStyle1 = array('align' => 'right');
							$phpWord->addTableStyle('My table', $styleTable);
							$table = $section->addTable('My table');
							$phpWord->addFontStyle('smallFont', array('name' => 'Calibri','size' => 10));
							$table->addRow();
							$table->addCell(11500)->addText(htmlspecialchars('PART I - To be accomplished by EMPLOYEE. (Pls. read below process before you route this clearance form)'), $fontStyle,$paragraphStyle);
							$table->addRow();

							$HRMOCELL9 = $table->addCell(11500);
							$HRMOCELLRUN9 = $HRMOCELL9->addTextRun();
							$HRMOCELLRUN9->addText('Name of Employee:'.$fullname,$fontStyle1,$paragraphStyle);
							$HRMOCELLRUN9->addTextBreak();
							$HRMOCELLRUN9->addText('Employee Number:'.$eid,$fontStyle1,$paragraphStyle);
							$HRMOCELLRUN9->addTextBreak();
							$HRMOCELLRUN9->addText('Position:'.$position,$fontStyle1,$paragraphStyle);
							$HRMOCELLRUN9->addTextBreak();
							$HRMOCELLRUN9->addText('Division/Store Assignment: _______________________________',$fontStyle1,$paragraphStyle);
							$HRMOCELLRUN9->addTextBreak();
							$HRMOCELLRUN9->addText('Date Hired:'.$doh,$fontStyle1,$paragraphStyle);
							$HRMOCELLRUN9->addTextBreak();
							$HRMOCELLRUN9->addText('Date of Resignation/Separation:'.$doh,$fontStyle1,$paragraphStyle);
							$HRMOCELLRUN9->addTextBreak();
							$HRMOCELLRUN9->addText('Address:______________________________________________________________',$fontStyle1,$paragraphStyle);
							$HRMOCELLRUN9->addTextBreak();
							$HRMOCELLRUN9->addText('Employment Status     (    ) Regular                (    ) Probationary:',$fontStyle1,$paragraphStyle);

							$HRMOCELLRUN9->addTextBreak();
							$HRMOCELLRUN9->addText('Contact Phone # __________________',$fontStyle1,$paragraphStyle);
							$HRMOCELLRUN9->addTextBreak();
							$HRMOCELLRUN9->addTextBreak();
							$HRMOCELLRUN9->addText(htmlspecialchars('In connection with the cessation of my employment effective end of business hour of __________________________, 20________, I hereby certify that I have received in full all remuneration and benefits due me under the law.  I hereby declare also that I have no claim of whatsoever nature against my employer. For all legal contents and purposes, I  hereby  forever  release and discharge (SBU NAME) ____________________________________________ from any liability or responsibility arising out of and in connection with  my  employment  the same having  been  fully  compensated, settled and paid to me and to my satisfaction.	'),'smallFont');
							$HRMOCELLRUN9->addTextBreak();
							$HRMOCELLRUN9->addTextBreak();
							$HRMOCELLRUN9->addText(htmlspecialchars('_____________________________________'),'smallFont',$paragraphStyle1);
													$HRMOCELLRUN9->addTextBreak();
							$HRMOCELLRUN9->addText(htmlspecialchars('Signature of Employee/DateSigned'),$fontStyle,$paragraphStyle1);


							$section->addTextBreak(1);
							$styleTable = array('borderSize' => 6, 'borderColor' => '000000', 'cellMargin' => 80);
							$fontStyle = array('name' => 'Calibri','bold' => true,'size' => 10);
							$paragraphStyle = array('align' => 'center');
							$phpWord->addTableStyle('My table1', $styleTable);
							$table = $section->addTable('My table1');$table->addRow();
							$table->addCell(11500)->addText(htmlspecialchars('PART II - Instructions on Processing of Employee Clearance and Quit Claim (For probationary & regular employees)'), $fontStyle,$paragraphStyle);


							$section->addTextBreak(1);
							$phpWord->addFontStyle('rStyle1', array('name' => 'Calibri'));
							$phpWord->addFontStyle('rStyle2', array('name' => 'Calibri','bold'=> true));
							$phpWord->addParagraphStyle('pStyle1', array('align' => 'left', 'spaceAfter' => 300));
							$section->addText(htmlspecialchars('I. Employee or authorized representative (with authorization letter) must personally accomplish & route the clearance certificate to each clearing officer or department following the sequence written on the form (recommended but not a must).'), 'rStyle1', 'pStyle1');
							$section->addText(htmlspecialchars('II. Below are the standard items that must be returned/settled by employee to respective clearing officers.  The list only serves as a guide.  There are some other items that may be required by the clearing officer.'), 'rStyle1', 'pStyle1');
							$section->addText(htmlspecialchars('For a more efficient processing, employee may inquire in advance from departments concerned regarding items that he/she has to settle or return."	'), 'rStyle1', 'pStyle1');



							$section->addTextBreak(1);
							$styleTable = array('borderSize' => 6, 'borderColor' => '000000', 'cellMargin' => 80);
							$fontStyle = array('name' => 'Calibri','bold' => true,'size' => 10);
							$fontStyle1 = array('name' => 'Calibri','size' => 10);
							$paragraphStyle = array('align' => 'center','spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0));
							$paragraphStyle1 = array('align' => 'left','spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0));
							$phpWord->addTableStyle('CO', $styleTable);
							$table = $section->addTable('CO');
							$table->addRow();
							$table->addCell(720)->addText(htmlspecialchars(' '));
							$table->addCell(2000)->addText(htmlspecialchars('Clearing Offices'),$fontStyle,$paragraphStyle);
							$table->addCell(8000)->addText(htmlspecialchars('Employee must be cleared of the following or as instructed by the clearing officers'),$fontStyle,$paragraphStyle);


							$table->addRow();
							$table->addCell(720)->addText(htmlspecialchars('1'));
							$table->addCell(2000)->addText(htmlspecialchars('Immediate Superior
						(Main Office, Store Operations)
						'),$fontStyle1,$paragraphStyle1);

							$cell1 = $table->addCell(8000);
							$textrun1 = $cell1->addTextRun();
							$textrun1->addText(htmlspecialchars('Reports, pending tasks for turn over, laptop, records, files, manuals, & other items that may be required by immediate superior from the employee including vale/cash advances and revolving fund'),$fontStyle1,$paragraphStyle);
							$textrun1->addTextBreak();
							$textrun1->addTextBreak();
							$textrun1->addText(htmlspecialchars('NOTE:  Revolving Fund must be returned to company.  If Employee is not able to return the fund, the Immediate Superior must take note of the accountability on this clearance form'),$fontStyle1,$paragraphStyle);

							$table->addRow();
							$table->addCell(720)->addText(htmlspecialchars('2'));
							$table->addCell(2000)->addText(htmlspecialchars('SBU HR/RBU HR/Zenith HRAD (for all employees)	'),$fontStyle1,$paragraphStyle1);
							$table->addCell(8000)->addText(htmlspecialchars(' '));

							$table->addRow();
							$table->addCell(720)->addText(htmlspecialchars(' '));
							$HRMOCELL = $table->addCell(2000);
							$HRMOCELLRUN = $HRMOCELL->addTextRun();
							$HRMOCELLRUN->addText('6.a HR MO (for Main Office employees)',$fontStyle1,$paragraphStyle);
							$HRMOCELLRUN->addTextBreak();
							$HRMOCELLRUN->addTextBreak();
							$HRMOCELLRUN->addText('HR-RBU (for Store Operation employees)',$fontStyle1,$paragraphStyle);
							$HRMOCELL1 = $table->addCell(8000);
							$HRMOCELLRUN1 = $HRMOCELL1->addTextRun();
							$HRMOCELLRUN1->addText('Exit Interview ',$fontStyle1,$paragraphStyle);
							$HRMOCELLRUN1->addTextBreak();
							$HRMOCELLRUN1->addTextBreak();
							$HRMOCELLRUN1->addText('Company ID (for Store employees), OCOC Handbook; Exit Interview',$fontStyle1,$paragraphStyle);

							$table->addRow();
							$table->addCell(720)->addText(htmlspecialchars(' '));
							$table->addCell(2000)->addText(htmlspecialchars('6.b HR L&D (for Main Office employees & Operation employees under FSM'),$fontStyle1,$paragraphStyle1);
							$table->addCell(8000)->addText(htmlspecialchars('Training Cost; Manuals/Modules'));

							$table->addRow();
							$table->addCell(720)->addText(htmlspecialchars('3'));
							$HRMOCELL2 = $table->addCell(2000);
							$HRMOCELLRUN2 = $HRMOCELL2->addTextRun();
							$HRMOCELLRUN2->addText('Treasury Department, 5/F Jollibee Plaza (for Main Office employees)',$fontStyle1,$paragraphStyle);
							$HRMOCELLRUN2->addTextBreak();
							$HRMOCELLRUN2->addTextBreak();
							$HRMOCELLRUN2->addText('Cash and Banking, 7/F Jollibee Center  (for JWS Employees Only)',$fontStyle1,$paragraphStyle);
							$HRMOCELL3 = $table->addCell(8000);
							$HRMOCELLRUN3 = $HRMOCELL3->addTextRun();
							$HRMOCELLRUN3->addText('Travel funds, Revolving Fund, petty cash, cash advances',$fontStyle1,$paragraphStyle);
							$HRMOCELLRUN3->addTextBreak();
							$HRMOCELLRUN3->addTextBreak();
							$HRMOCELLRUN3->addText('Returned travel fund, revolving fund, petty cash or cash advances must be supported with an Official Receipt',$fontStyle1,$paragraphStyle);



							$table->addRow();
							$table->addCell(720)->addText(htmlspecialchars('4'));
							$table->addCell(2000)->addText(htmlspecialchars('Information Management'),$fontStyle1,$paragraphStyle1);
							$table->addCell(8000)->addText(htmlspecialchars('Laptop; company-issued cellphone; deactivation of e-mail address; and all related access, roles assigned to the resigning employees, e.g., username, password, ESS/MSS, SWS/PMP, etc. '));

							$table->addRow();
							$table->addCell(720)->addText(htmlspecialchars('5'));
							$table->addCell(2000)->addText(htmlspecialchars('Corporate Insurance'),$fontStyle1,$paragraphStyle1);
							$table->addCell(8000)->addText(htmlspecialchars('Car Insurance -  Comprehensive, CTPL, ETPL'));

							$table->addRow();
							$table->addCell(720)->addText(htmlspecialchars('6'));
							$table->addCell(2000)->addText(htmlspecialchars('Jollibee or Red Ribbon Cooperative (for all employees)'),$fontStyle1,$paragraphStyle1);
							$table->addCell(8000)->addText(htmlspecialchars('All employees whether probationary or regular, member or non member must present his/her clearance form to Coop Officer	'));

							$table->addRow();
							$table->addCell(720)->addText(htmlspecialchars('7'));
							$table->addCell(2000)->addText(htmlspecialchars('Workplace Services'),$fontStyle1,$paragraphStyle1);
							$HRMOCELL4 = $table->addCell(8000);
							$HRMOCELLRUN4 = $HRMOCELL4->addTextRun();
							$HRMOCELLRUN4->addText('For Car Plan Holders:  Receipt of car availed thru the car plan',$fontStyle1,$paragraphStyle);
							$HRMOCELLRUN4->addTextBreak();
							$HRMOCELLRUN4->addText('Employee to surrender the car availed through the car plan benefit on the last day of employee even if employee intends to buy the unit.',$fontStyle1,$paragraphStyle);
							$HRMOCELLRUN4->addTextBreak();
							$HRMOCELLRUN4->addText('Cellphone Charges (Personal Calls/Excess limits on Billings)',$fontStyle1,$paragraphStyle);
							$HRMOCELLRUN4->addTextBreak();
							$HRMOCELLRUN4->addText('Company ID; Prox card for deactivation from Timekeeping System (for Main Office employees)',$fontStyle1,$paragraphStyle);
							$HRMOCELLRUN4->addTextBreak();
							$HRMOCELLRUN4->addText('Office supplies (non-consumables/Asset Accountabilities)	',$fontStyle1,$paragraphStyle);

							$table->addRow();
							$table->addCell(720)->addText(htmlspecialchars('8'));
							$table->addCell(2000)->addText(htmlspecialchars('Employee Services, 5/F Jollibee Center'),$fontStyle1,$paragraphStyle1);
							$table->addCell(8000)->addText(htmlspecialchars(' '));

							$table->addRow();
							$table->addCell(720)->addText(htmlspecialchars(' '));
							$table->addCell(2000)->addText(htmlspecialchars('8.a.  Benefits Administration'),$fontStyle1,$paragraphStyle1);
							$table->addCell(8000)->addText(htmlspecialchars('HMO ID of employee and dependents; govt  loans and benefits; settlement of Car Plan balances.	'),$fontStyle1,$paragraphStyle1);

							$table->addRow();
							$table->addCell(720)->addText(htmlspecialchars(' '));
							$table->addCell(2000)->addText(htmlspecialchars('8.b.  Salary Administration'),$fontStyle1,$paragraphStyle1);
							$table->addCell(8000)->addText(htmlspecialchars('Employee records (leaves); computation of Retirement Pay Benefit (if applicable)'),$fontStyle1,$paragraphStyle1);

							$table->addRow();
							$table->addCell(720)->addText(htmlspecialchars(' '));
							$table->addCell(2000)->addText(htmlspecialchars('8.c.  Payroll'),$fontStyle1,$paragraphStyle1);
							$HRMOCELL5 = $table->addCell(8000);
							$HRMOCELLRUN5 = $HRMOCELL5->addTextRun();
							$HRMOCELLRUN5->addText('Computation of employee  Quit Claim (Amount due TO/(FROM) Employee); Release of Payslip; Form 2316',$fontStyle1,$paragraphStyle);
							$HRMOCELLRUN5->addTextBreak();
							$HRMOCELLRUN5->addText('Records of Loan Balances, Unliquidated Cash Advance, Unreturned Travel Fund or Unreturned Revolving Fund as of date of resignation/separation must be deducted from Quit Claim.',$fontStyle,$paragraphStyle);

							$section->addTextBreak(1);
							$phpWord->addFontStyle('rStyle1', array('name' => 'Calibri',));
							$phpWord->addParagraphStyle('pStyle1', array('align' => 'left', 'spaceAfter' => 300));
							$section->addText(htmlspecialchars('III. After all the clearing officers have signed (#\'s 1 to 7) , employee will submit the form to ES-Benefits Administration.'), 'rStyle1', 'pStyle1');
							$section->addText(htmlspecialchars('IV. Payment of the quit claim pay is released thru employee\'s payroll account.  For non-standard cases, quit claim pay may be released thru check payment.'), 'rStyle1', 'pStyle1');
							$section->addText(htmlspecialchars('V.  In case employee still has pending loans &/or accountabilities after computing  “the amount due to/(from) employee”,  ES-Payroll informs the employee (or the authorized representative) and his/her immediate superior.  Employee will be required to settle all accountabilities from the company for him/her to be issued the Clearance Certificate.	'), 'rStyle1', 'pStyle1');
							$section->addText(htmlspecialchars('VI. No employee shall be issued Certificate of Employment until he/she has completely processed his/her Clearance/Quit Claim.'), 'rStyle2', 'pStyle1');


							$section->addTextBreak(1);
							$styleTable = array('borderSize' => 6, 'borderColor' => '000000', 'cellMargin' => 80);
							$fontStyle = array('name' => 'Calibri','bold' => true,'size' => 10);
							$paragraphStyle = array('align' => 'center');
							$phpWord->addTableStyle('My table9', $styleTable);
							$table = $section->addTable('My table9');
							$table->addRow();
							$table->addCell(11500)->addText(htmlspecialchars('PART III - TO BE ACCOMPLISHED BY CLEARING OFFICERS'), $fontStyle,$paragraphStyle);
							$table->addRow();
							$table->addCell(11500)->addText(htmlspecialchars('Note to Clearing Officers:  By signing on this form, you are hereby certifying that the above-named employee has been cleared of all money, records, equipment, tools, supplies and/or any other accountabilities with (SBU NAME) ___________________________________________  as of the date indicated below.  Please use additional sheet if necessary'), $fontStyle1,'pStyle1');



							$data['quitclaim'] = $this->Model_user->get_tblQuitClaim_user($eid);
							$data['users'] = $this->Model_user->get_users();

							foreach($data['quitclaim'] as $q)
							{
								$count++;
							}
	$images = array();
	$countingimage = 0;
							foreach($data['quitclaim'] as $q)
							{
								$approved;
								$timeapproved;
								$count = 0;
								$id = $q->quitclaim_id;
								$quitclaimername = $q->quitclaim_sender;
								$data['details'] = $this->Model_user->get_quitclaim_happenings($id);

						$section->addTextBreak(1);
						$styleTable = array('borderSize' => 6, 'borderColor' => '000000', 'cellMargin' => 80);
						$fontStyle = array('name' => 'Calibri','bold' => true,'size' => 10);
						$fontStyle1 = array('name' => 'Calibri','size' => 10);
						$paragraphStyle = array('align' => 'center','spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0));
						$paragraphStyle1 = array('align' => 'left','spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0));
						$phpWord->addTableStyle('NEW', $styleTable);
						$table = $section->addTable('NEW');
						$table->addRow();
						$table->addCell(720)->addText(htmlspecialchars(' '));
						$table->addCell(2500)->addText(htmlspecialchars('Clearing Offices'),$fontStyle,$paragraphStyle);
						$table->addCell(2500)->addText(htmlspecialchars('Name of clearing officer'),$fontStyle,$paragraphStyle);
						$table->addCell(2500)->addText(htmlspecialchars('Signature of clearing officer'),$fontStyle,$paragraphStyle);
						$table->addCell(2500)->addText(htmlspecialchars('Date Cleared'),$fontStyle,$paragraphStyle);


						$data['sign'] = $this->Model_user->get_signatures($quitclaimdocumentid);
						$this->load->library('image_lib');
						foreach($data['sign'] as $s)
						{
							$config['image_library'] = 'gd2';
					    $config['source_image'] = $s->signature_path;
					    $config['width']     = 185;
					    $config['height']   = 300;

					    $this->image_lib->initialize($config);
					    $this->image_lib->resize();
							$this->image_lib->clear();
						}


								foreach($data['details'] as $d)
								{
									foreach($data['users'] as $u)
									{
											if($d->quitclaim_approvers_emp_id == $u->user_employeeID)
											{
												$name = $u->user_firstname . ' ' . $u->user_lastname;
												$position = $u->user_positiontitle;
											}

									}
									if($d->quitclaim_isapproved == 0)
									{
										$approved = 'No';
										$timeapproved = 'N/A';
									}
									else
									{
										$approved = 'Yes';
										$timeapproved = $d->quitclaim_timeapproved;
									}
									if($d->quitclaim_comment == NULL)
									{
										$comment = 'N/A';
									}
									else
									{
										$comment = $d->quitclaim_comment;
									}

									foreach($data['users'] as $u)
									{
										foreach($data['sign'] as $s)
										{
											if($s->signature_eid == $u->user_employeeID)
											{
												$images[] = $s->signature_path;

											}
										}
									}


									$table->addRow();
									$count++;
									$table->addCell(720)->addText(htmlspecialchars("{$count}"));
									$table->addCell(2500)->addText(htmlspecialchars("{$position}"));
									$table->addCell(2500)->addText(htmlspecialchars("{$name}"));
									$table->addCell(2500)->addImage($images[$countingimage]);
									$table->addCell(2500)->addText(htmlspecialchars("{$timeapproved}"));
									$countingimage++;
								}
							}



							$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
							$path = APPPATH.'quitclaimdocuments\signeddocuments\\'.$filename;
							$objWriter->save($path);

							$this->insert_updated_quitclaim_document($filename,$quitclaimdocumentid);



							$word = new COM("Word.Application") or die ("Could not initialise Object.");
										// set it to 1 to see the MS Word window (the actual opening of the document)
										$word->Visible = 0;
										// recommend to set to 0, disables alerts like "Do you want MS Word to be the default .. etc"
										$word->DisplayAlerts = 0;
										// open the word 2007-2013 document
										$word->Documents->Open(APPPATH . "quitclaimdocuments\signeddocuments\\$filename");
										// save it as word 2003
										$filename = str_replace('.docx','.pdf',$filename);
										$word->ActiveDocument->SaveAs('newdocument.doc');
										// convert word 2007-2013 to PDF
										$word->ActiveDocument->ExportAsFixedFormat(APPPATH . "quitclaimdocuments\signeddocuments\\$filename", 17, false, 0, 0, 0, 0, 7, true, true, 2, true, true, false);
										// quit the Word process
										$word->Quit(false);
										// clean up
										unset($word);


										$data = array(
											'quitclaim_document_path'=>APPPATH . "quitclaimdocuments\signeddocuments\\$filename",
											'quitclaim_document_filename'=>$filename);


											$this->Model_user->update_quitclaim_document($data,$quitclaimdocumentid);
											$doneid = $this->input->post('senderid');
											$data1 = array('done_employeeID'=>$doneid,
																		 'done_timestamp'=>$timeposted);
											$this->Model_user->insert_done_employee($data1);

						}
						else
						{
											$quitclaimidtable++;
											if($tagall == 0)
											{
												if($quitclaim_all_approving == 1)
												{
													//Don'tTag
												}
												else
												{
													$this->Model_user->tag_next_approver($quitclaimidtable);
												}

											}
											else if($tagall == 1)
											{
												$this->Model_user->tag_all_approvers($quitclaim_id_fk);

												$this->Model_user->remove_tag($quitclaim_id_fk);
												$this->Model_user->remove_tag_two($quitclaim_id_fk);
											}

						}



						$this->session->set_flashdata('accepted', '<div class="alert alert-success text-center">Document Approved!</div>');
						redirect(base_url()."user/view1_quitclaim_to_be_approved");



					}

					else if($this->input->post('btn_dcs') == "Reject")
					{
						$postid = $this->uri->segment(3);
			    		$now = time();
						$timeposted = unix_to_human($now);
						$data['dcs'] = $this->Model_user->get_rejector_quitclaim($postid,$timeposted);
						$this->session->set_flashdata('accepted', '<div class="alert alert-danger text-center">Document Rejected!</div>');
						redirect(base_url()."user/view1_quitclaim_to_be_approved");
						}
					}

				else
		   		{
		    		 //If no session, redirect to login page
		  		   redirect('login', 'refresh');
		  		}
			}
	function insert_updated_quitclaim_document($filename,$quitclaimdocumentid)
	{
		$path = APPPATH . "quitclaimdocuments\signeddocuments\\";
	$data = array(
		'quitclaim_document_path'=>$path,
		'quitclaim_document_filename'=>$filename);


		$this->Model_user->update_quitclaim_document($data,$quitclaimdocumentid);
	}

		function check_quitclaim_password()
		{
			if($this->session->userdata('logged_in'))
			{
				$password = $this->input->post('pword');
				$email = $this->input->post('email');
				$session_data = $this->session->userdata('logged_in');
				$employeeID = $session_data['employeeID'];
				$data['details'] = $this->Model_user->get_one_user($employeeID);

				foreach($data['details'] as $d)
				{
					if($password == $d->user_password)
					{
						$this->Model_user->change_email($email,$employeeID);
						$this->activate_quitclaim();
					}
					else
					{
						$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Wrong password!</div>');
						redirect(base_url().'user/view_quitclaim');
					}
				}
			}
			else
	   		{
	    		 //If no session, redirect to login page
	  		   redirect('login', 'refresh');
	  		}
		}
				function activate_quitclaim()
			    {
			    	if($this->session->userdata('logged_in'))
					{
						$session_data = $this->session->userdata('logged_in');
			      $employeeID = $session_data['employeeID'];



						$usr['fullname'] = $session_data['fullname'];
						$data['approvers_position'] = $this->Model_user->get_quitclaim_approvers($employeeID);
						if(empty($data['approvers_position']))
						{
										$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">No defined workflow yet!!</div>');
										redirect('Admin/view_users');

						}
						else
						{

						$this->Model_user->quitclaim_activate($employeeID);


						//InsertIntotblQuitClaim
					  $now = time();
						$timeposted = unix_to_human($now);

						$user['fullname'] = str_replace(' ','',$usr['fullname']);

						$data = array('quitclaim_sender'=>$usr['fullname'],
									  'quitclaim_senderid'=>$employeeID,
									  'quitclaim_timestamp'=>$timeposted,
										'quitclaim_file_chat'=>$user['fullname'].$employeeID.'.txt'
									 );
									 		 	fopen('G:\xampp\htdocs\JFCHR\\'.$user['fullname'].$employeeID.'.txt', "w");
						$this->Model_user->insert_quitclaim($data);
						$last_quitclaim_id = $this->Model_user->get_last_quitclaim_id();

						$data['approvers_position'] = $this->Model_user->get_quitclaim_approvers($employeeID);

						//NowInsertTheApprovers
						$hierarchy = 3;
						$postnumber = 0;

							$count = 1;
							foreach($data['approvers_position'] as $d)
							{
								$dataapprover['quitclaim_isapproved'] = 0;
								$dataapprover['quitclaim_hierarchy'] = $hierarchy;
								$dataapprover['quitclaim_approvers_emp_id'] = $d->quitclaim_approvers_position;
								$dataapprover['quitclaim_id_fk'] = $last_quitclaim_id;
									$dataapprover['quitclaim_reversehierarchy'] = 0;


								$this->Model_user->insert_quitclaim_approvers($dataapprover);

								$last_approver_id = $this->Model_user->get_last_quitclaim_approver_id();

								$transaction = array('quitclaim_id' =>$last_quitclaim_id,
													 'quitclaim_approvers_table_id'=>$last_approver_id);

								$this->Model_user->insert_quitclaim_transaction($transaction);
								$hierarchy++;


							$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">User quitclaim activated</div>');


						}

					//CREATE Document

							require_once APPPATH.'/libraries/PHPWord/src/PhpWord/Autoloader.php';

							\PhpOffice\PhpWord\Autoloader::register();

							// Creating the new document...
							$phpWord = new \PhpOffice\PhpWord\PhpWord();

							/* Note: any element you append to a document must reside inside of a Section. */

							// Adding an empty Section to the document...
							$section = $phpWord->addSection();

							$section->addText("This document is generated for the quitclaim of Mr/Ms ".$usr['fullname']);

							$usr['fullname'] = str_replace(' ','',$usr['fullname']);

							// Saving the document as OOXML file...
							$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
							$path = APPPATH.'quitclaimdocuments\\'.$usr['fullname'].$employeeID.'QuitClaim.docx';
							$objWriter->save($path);
							$rawname = $usr['fullname'].$employeeID.'QuitClaim.docx';
							$rawnamenoextension = $usr['fullname'].$employeeID.'QuitClaim';

							$FILEPATH = APPPATH.'quitclaimdocuments\\';

							$now = time();
							$timeupdated = unix_to_human($now);

										$data = array('quitclaim_document_path'=>$FILEPATH,
																	'quitclaim_owner_id'=>$employeeID,
																	'quitclaim_timestamp'=>$timeupdated,
																	'quitclaim_document_filename'=>$rawname,
																	'quitclaim_pk_fk'=>$last_quitclaim_id);;
										$this->Model_user->insert_quitclaim_document($data);

												redirect('Quitclaim');
											}
				}

				    else
					{
			    		 //If no session, redirect to login page
			  		   redirect('login', 'refresh');

			    }
				}


    function view_dcs()
	{
		if($this->session->userdata('logged_in'))
		{
			$data['users'] = $this->Model_user->get_users();
			$data['error'] = ' ';
			$this->load->view('/view_dcs_submit',  $data);
		}
		else
	   	{
	    	 //If no session, redirect to login page
	  	   redirect('login', 'refresh');
	  	}
	}

	function do_submit_dcs()
	{
		if($this->session->userdata('logged_in'))
		{
			$config['upload_path']          = './dcsdocs/';
            $config['allowed_types']        = 'doc|docx';

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

           	if ( ! $this->upload->do_upload('userfile'))
                {
                        $error = array('error' => $this->upload->display_errors());
                        //$this->load->view('AdminV/headerA');
                        $error = $this->upload->display_errors();
                        $this->session->set_flashdata('error', $error);
                        redirect('user/view_dcs');
                        //$this->load->view('view_dcs_submit', $error);
                }
                else
                {
                	$session_data = $this->session->userdata('logged_in');
               		$usr['userid'] = $session_data['employeeID'];
               		$usr['fullname'] = $session_data['fullname'];

		     		$now = time();
					$timeposted = unix_to_human($now);
					$success = array('upload_data' => $this->upload->data());
                	$file_name = $this->upload->file_name;


					$data = array('dcs_sender'=>$usr['fullname'],
								  'dcs_senderid'=>$usr['userid'],
								  'dcs_title'=>$_POST['dcstitle'],
								  'dcs_sendercomment'=>$_POST['dcscomment'],
								  'dcs_docufilename'=>$file_name,
								  'dcs_documentpath'=>$success['upload_data']['full_path'],
								  'dcs_timestamp'=>$timeposted,

								 );



					$this->Model_user->insert_dcs($data);
					$last_dcs_id = $this->Model_user->get_last_dcs_id();

					$hierarchy = 1;
					$postnumber = 0;
					foreach($_POST['approvers'] as $approve)
					{
						$dataapprover['dcs_approver_id'] = $approve;
						$dataapprover['dcs_isapproved'] = 0;
						$dataapprover['dcs_hierarchy'] = $hierarchy;
						$dataapprover['dcs_id'] = $last_dcs_id;
						$dataapprover['dcs_reversehierarchy'] = 0;
						$dataapprover['dcs_isrejected'] = 1;

						$this->Model_user->insert_dcs_approvers($dataapprover);
						$last_approver_id = $this->Model_user->get_last_approver_id();

						$transaction = array('dcs_id' =>$last_dcs_id,
											 'dcsapprovers_id'=>$last_approver_id);
						$this->Model_user->insert_dcs_transaction($transaction);
						$hierarchy +=1;
						$postnumber = $last_approver_id;
					}

					$reverse = 1;

					foreach($_POST['approvers'] as $approver)
					{

						$this->Model_user->update_reverse_hierarchy($reverse, $last_dcs_id, $postnumber);
						$reverse += 1;
						$postnumber -= 1;

					}

					$this->session->set_flashdata('dcs_sent', '<div class="alert alert-success text-center">Document sent!</div>');
					redirect(base_url()."user/view_dcs");
		          }

		}
		else
		{
    		 //If no session, redirect to login page
  		   redirect('login', 'refresh');
  		}
	}

	function view1_dcs_progress()
	{
		if($this->session->userdata('logged_in'))
		{

			$with_dcs = $this->Model_user->get_one_dcs();
			if($with_dcs)
			{
				$data['details'] = $this->Model_user->get_one_dcs();
				$this->load->view('view_dcs_progress',  $data);
			}
			else
			{
				$this->session->set_flashdata('nodcs', '<div class="alert alert-danger text-center">No submitted documents.</div>');
				//$this->load->view('header');
				$this->load->view('view_dcs_progress');
			}


		}
		else
	   	{
	    	 //If no session, redirect to login page
	  	   redirect('login', 'refresh');
	  	}
	}

	function view2_dcs_requests()
	{
		if($this->session->userdata('logged_in'))
		{
			$if_approver = $this->Model_user->get_all_dcs_where_user_is();
			if($if_approver)
			{
				$data['dcs'] = $this->Model_user->get_all_dcs_where_user_is();
				$this->load->view('view_dcs_requests',  $data);
			}


			else
			{
				$this->session->set_flashdata('nodocuments', '<div class="alert alert-danger text-center">No documents to be approved.</div>');
				$this->load->view('view_dcs_requests_none');
			}


		}
		else
	   	{
	    	 //If no session, redirect to login page
	  	   redirect('login', 'refresh');
	  	}
	}

	function view_one_dcs_approval_page()
	{
		if($this->session->userdata('logged_in'))
		{
			$dcs_id = $this->uri->segment(3);
			$data['dcs'] = $this->Model_user->get_dcs_progress($dcs_id);
			$data['dcsid1'] = $dcs_id;
			$this->load->view('view_one_dcs_approval_page', $data);
		}
		else
   		{
    		 //If no session, redirect to login page
  		   redirect('login', 'refresh');
  		}
	}

	function view_one_dcs()
	{
		if($this->session->userdata('logged_in'))
		{
			$dcs_id = $this->uri->segment(3);
			$data['dcs'] = $this->Model_user->get_dcs_progress($dcs_id);
			$data['users'] = $this->Model_user->get_users();
			//$this->load->view('header');
			$this->load->view('view_one_dcs_progress', $data);
		}
		else
   		{
    		 //If no session, redirect to login page
  		   redirect('login', 'refresh');
  		}
	}



	function process_dcs_document()
	{
		if($this->session->userdata('logged_in'))
		{
			$now = time();
			$timeposted = unix_to_human($now);
			if($this->input->post('btn_dcs') == "Approve")
			{

				if (!empty($_POST['comment']))
				{
	    			$postid = $this->uri->segment(3);
	    			$comment = $_POST['comment'];
					$this->Model_user->accept_dcs($postid,$comment,$timeposted);
				}
				else
				{
				    $postid = $this->uri->segment(3);
	    			$comment = $_POST['comment'];
					$data['dcs'] = $this->Model_user->accept_dcs_no_comment($postid,$timeposted);
				}

			$id = $_POST['usedid'];
			$data['maxhierarchy'] = $this->Model_user->get_max_hierarchy($id);
			foreach($data['maxhierarchy'] as $d)
			{
				$maxhierarchy = $d->hierarchy;
			}

			$yes_last_approver = $this->Model_user->check_if_last_approver($id, $maxhierarchy);

			if($yes_last_approver)
			{
				$bits = 3;
                $controlnumber = bin2hex(openssl_random_pseudo_bytes($bits));


				$data['dcs'] = $this->Model_user->get_dcs_document_data($id);
				foreach($data['dcs'] as $d)
				{
					$sender = $d->dcs_sender;
					$filename = $d->dcs_docufilename;
					$filepath = $d->dcs_documentpath;
					$title = $d->dcs_title;
				}

				$data = array('dcs_document_title'=>$title,
							  'dcs_document_timestamp'=>$timeposted,
							  'dcs_document_filename'=>$filename,
							  'dcs_document_path'=>$filepath,
							  'dcs_control_number'=>$controlnumber,
							  'dcs_sender_name'=>$sender,
							  'dcs_id_fk'=>$id);
				$this->Model_user->insert_dcs_approved_document($data);
			}
			else
			{
				echo 'No';
			}
			$this->session->set_flashdata('accepted', '<div class="alert alert-success text-center">Document Approved!</div>');
			redirect(base_url()."user/view2_dcs_requests");
			}



			else if($this->input->post('btn_dcs') == "Reject")
			{
				$postid = $this->uri->segment(3);
				$comment = $_POST['comment'];
	    			$now = time();
					$timeposted = unix_to_human($now);
				$data['dcs'] = $this->Model_user->get_rejector_dcs($postid, $comment,$timeposted);
				$this->session->set_flashdata('accepted', '<div class="alert alert-danger text-center">Document Rejected!</div>');
				redirect(base_url()."user/view2_dcs_requests");
				}
			}
		else
   		{
    		 //If no session, redirect to login page
  		   redirect('login', 'refresh');
  		}
	}



	function do_update_hierarchy()
	{
			$newapprover = $_POST['approver'];
			$dcsid = $_POST['dcsid'];
			$currentapprover = $_POST['approverid'];
			$this->Model_user->update_hierarchy($currentapprover,$newapprover, $dcsid);
			redirect(base_url()."user/view_one_dcs/".$dcsid);
	}

	function download_dcs_document()
	 {
		$docuname = $this->uri->segment(3);
		$name = 'G:\xampp\htdocs\Thesis\dcsdocs' . '\\' . $docuname;
		force_download($name, NULL);
	}

	function delete_hierarchy()
	{
		$postid = $this->uri->segment(3);
		$dcsid = $this->uri->segment(4);
		$data['post'] = $this->Model_user->delete_from_hierarchy($postid, $dcsid);
		$this->update_deleted_hierarchy($dcsid);
	}

	function do_swap_hierarchy()
	{
		$dcsid = $_POST['dcsid'];
		$currentapprover = $_POST['approverid'];
		$newapprover = $_POST['approver'];
		$data['approver1'] = $this->Model_user->get_swap($currentapprover);
		foreach($data['approver1'] as $d)
		{
			$approver_id1 = $d->dcs_approver_id;
		}

		$data['approver2'] = $this->Model_user->get_swap($newapprover);
		foreach($data['approver2'] as $d)
		{
			$approver_id2 = $d->dcs_approver_id;
		}



		$this->Model_user->swap_hierarchy($currentapprover, $approver_id2);
		$this->Model_user->swap_hierarchy($newapprover, $approver_id1);

		$this->session->set_flashdata('swapped', '<div class="alert alert-success text-center">Approver swapped!.</div>');
		redirect(base_url()."user/view_one_dcs/".$dcsid);




	}

	function update_deleted_hierarchy($dcsid)
	{
		$data['count'] = $this->Model_user->get_remaining_hierarchy($dcsid);
		$numberofrows = 0;
		foreach($data['count'] as $d)
		{
			$numberofrows+=1;
		}
		$maxrows = $numberofrows;						//3
		$minrows = $numberofrows - $numberofrows + 1;	//1
		foreach($data['count'] as $d)
		{
			$dcsapprovers_id = $d->dcsapprovers_id;
			$this->Model_user->update_dcs_hierarchy_column($dcsapprovers_id, $minrows);
			$this->Model_user->update_dcs_revhierarchy_column($dcsapprovers_id, $maxrows);
			$maxrows -=1;
			$minrows +=1;
		}
		$this->session->set_flashdata('deleteapprover', '<div class="alert alert-danger text-center">Approver deleted!.</div>');
		redirect(base_url()."user/view_one_dcs/".$dcsid);;

	}

	function view_hotlines()
{
	if($this->session->userdata('logged_in'))
	{
		$data['hotlines'] = $this->Model_user->get_hotlines();
		$this->load->view('hotlines_view',$data);
	}
	else
	{
			 //If no session, redirect to login page
			 redirect('login', 'refresh');
		}
}



    public function logout()
	{
		session_destroy();
		redirect('login','refresh');
	}
}
