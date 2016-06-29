<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_admin');
		$this->load->model('Model_user');
		$this->load->view('AdminV/headerA');
	}

	function index()
	{
		if($this->session->userdata('admin_logged_in'))
		{
			$session_data = $this->session->userdata('admin_logged_in');
			$data['adminuser'] = $session_data['adminuser'];
	    	$data['adminpass'] = $session_data['adminpass'];
	    	////$this->load->view('AdminV/headerA');
	  	$this->load->view('AdminV/home_viewADMIN', $data);
		}
		else
   		{
    		 //If no session, redirect to login page
  		   redirect('login', 'refresh');
  		}
	}

	function view_users()
	{
		if($this->session->userdata('admin_logged_in'))
		{
			$data['users'] = $this->Model_admin->get_users();
			////$this->load->view('AdminV/headerA');
			$this->load->view('AdminV/activate_user_modal');
			$this->load->view('AdminV/deactivate_user_modal');
			$this->load->view('AdminV/quitclaim_modal_sure');
			$this->load->view('AdminV/view_usersA', $data);
		}
		else
   		{
    		 //If no session, redirect to login page
  		   redirect('login', 'refresh');
  		}
	}

	function view_add_users()
	{
		if($this->session->userdata('admin_logged_in'))
		{
			////$this->load->view('AdminV/headerA');
			$this->load->view('AdminV/add_usersA');
		}
		else
   		{
    		 //If no session, redirect to login page
  		   redirect('login', 'refresh');
  		}
	}

	function import_users()
	{

		if($this->session->userdata('admin_logged_in'))
		{



			$data['error'] = '';    //initialize image upload error array to empty

	        $config['upload_path'] = './csv/';
	        $config['allowed_types'] = 'csv';
	        $config['max_size'] = '1000';

	        $this->load->library('upload', $config);
	        $this->upload->initialize($config);


	        // If upload failed, display error
	        if (!$this->upload->do_upload()) {
	            $data['error'] = $this->upload->display_errors();

	            $this->load->view('AdminV/import_users', $data);
	        } else {
	            $file_data = $this->upload->data();
	            $file_path =  './csv/'.$file_data['file_name'];

	            if ($this->csvimport->get_array($file_path)) {
	                $csv_array = $this->csvimport->get_array($file_path);
	                foreach ($csv_array as $row) {
	                    $insert_data = array(
	                        'user_username'=>$row['user_username'],
	                        'user_password'=>$row['user_password'],
	                        'user_employeeID'=>$row['user_employeeID'],
	                        'user_lastname'=>$row['user_lastname'],
	                        'user_firstname'=>$row['user_firstname'],
	                        'user_middlename'=>$row['user_middlename'],
	                        'user_sbu'=>$row['user_sbu'],
	                        'user_positiontitle'=>$row['user_positiontitle'],
	                        'user_rank'=>$row['user_rank'],
	                        'user_date_of_hire'=>$row['user_date_of_hire'],
	                        'user_date_of_separation'=>$row['user_date_of_separation'],
	                        'user_location'=>$row['user_location'],
	                        'user_email'=>$row['user_email'],
	                        'user_active'=>$row['user_active'],
	                        'user_isquitclaim'=>$row['user_isquitclaim'],
	                        'user_company'=>$row['user_company'],
	                    );
	                    $this->Model_admin->importUser($insert_data);
	                }
	                $this->session->set_flashdata('csv', '<div class="alert alert-success text-center">Users imported successfully!</div>');
	                redirect(base_url().'admin/import_users');
	            } else
	                $data['error'] = "Error occured";
					$this->load->view('AdminV/import_users',$data);
	            }

		}
		else
   		{
    		 //If no session, redirect to login page
  		   redirect('login', 'refresh');
  		}
	}



	function add_users()
	{
		if($this->session->userdata('admin_logged_in'))
		{
			$this->load->library('form_validation');
			$myform = array(array('field' => 'fname',
								  'label' => 'fname',
								  'rules' => 'required|trim'
								  ),
							array('field' => 'mname',
								  'label' => 'mname',
								  'rules' => 'required|trim'
								  ),
							array('field' => 'lname',
								  'label' => 'lname',
								  'rules' => 'required|trim'
								  ),
							array('field' => 'eid',
								  'label' => 'eid',
								  'rules' => 'required|trim'
								  ),
							array('field' => 'sbu',
								  'label' => 'sbu',
								  'rules' => 'required|trim'
								  ),
							array('field' => 'positiontitle',
								  'label' => 'positiontitle',
								  'rules' => 'required|trim'
								  ),
							array('field' => 'rank',
								  'label' => 'rank',
								  'rules' => 'required|trim'
								  ),
							array('field' => 'location',
								  'label' => 'location',
								  'rules' => 'required|trim'
								  ),
							array('field' => 'email',
								  'label' => 'email',
								  'rules' => 'required|valid_email|callback_check_email_duplicate'
								  ),
							array('field' => 'username',
								  'label' => 'username',
								  'rules' => 'required|trim|min_length[5]|max_length[15]|callback_check_username_duplicate'
								  ),
							array('field' => 'password',
								  'label' => 'password',
								  'rules' => 'required|trim|min_length[5]|max_length[50]'
								  ),
							array('field' => 'Cpassword',
								  'label' => 'Cpassword',
								  'rules' => 'required|trim|matches[password]'
								  ),

						    );
			$this->form_validation->set_rules($myform);
			//$this->form_validation->set_message('required', 'This field is required');
			//$this->form_validation->set_message('matches', 'The passwords do not match');
			if($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Please check for errors.</div>');
				//$this->load->view('AdminV/headerA');
				$this->load->view('AdminV/add_usersA');
			}

			else
			{
				$now = time();
				$timeupdated = unix_to_human($now);
				$user = array
					(
					 'user_username'=>$this->input->post('username'),
					 'user_password'=>$this->input->post('password'),
					 'user_employeeID'=>$this->input->post('eid'),
					 'user_lastname'=>$this->input->post('lname'),
					 'user_firstname'=>$this->input->post('fname'),
					 'user_middlename'=>$this->input->post('mname'),
					 'user_sbu'=>$this->input->post('sbu'),
					 'user_positiontitle'=>$this->input->post('positiontitle'),
					 'user_rank'=>$this->input->post('rank'),
					 'user_date_of_hire'=>$timeupdated,
					 'user_location'=>$this->input->post('location'),
					 'user_email'=>$this->input->post('email'),
					 'user_active'=>1
					);
				$this->Model_admin->add_users($user);
				$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">User successfully added!!</div>');
				//$this->load->view('AdminV/headerA');
				$this->load->view('AdminV/add_usersA');
			}
		}
		else
   		{
    		 //If no session, redirect to login page
  		   redirect('login', 'refresh');
  		}
	}

	function check_username_duplicate($username)
	{
		$username = $this->input->post("username");
		$usr_result = $this->Model_admin->get_duplicate_user($username);
		if($usr_result)
		{
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Please check for errors.</div>');
			$this->form_validation->set_message('check_username_duplicate', 'Username already in use.');
			return false;
		}
		else
		{
			return true;
		}
	}

	function check_email_duplicate($email)
	{
		$email = $this->input->post("email");
		$email_result = $this->Model_admin->get_duplicate_email($email);
		if($email_result)
		{
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Please check for errors.</div>');
			$this->form_validation->set_message('check_email_duplicate', 'Email already in use.');
			return false;
		}
		else
		{
			return true;
		}
	}

	function activate_user()
	{
		if($this->session->userdata('admin_logged_in'))
		{
			$postid = $this->uri->segment(3);
			$data['post'] = $this->Model_admin->activate_user($postid);
			redirect(base_url()."admin/view_users");
			//NEED BASE URL
		}
	}

	function deactivate_user()
	{
		$postid = $this->uri->segment(3);
		$data['post'] = $this->Model_admin->deactivate_user($postid);
		redirect(base_url()."admin/view_users");
		//NEED BASE URL
	}

	function edit_user()
	{
		if($this->session->userdata('admin_logged_in'))
		{
				$postid = $this->uri->segment(3);
				$data['userdata'] = $this->Model_admin->get_one_user($postid);
				$data['sbus'] = $this->Model_admin->get_sbus_new();
				$data['positions'] = $this->Model_admin->get_positions();
				$data['ranks'] = $this->Model_admin->get_ranks_new();
				//$this->load->view('AdminV/headerA');
				$this->load->view('AdminV/edit_one_userA', $data);
			}
		else
	   	{
	    	 //If no session, redirect to login page
	  	   redirect('login', 'refresh');
	  	}
	}

	function edit_policy()
	{
		if($this->session->userdata('admin_logged_in'))
		{
			$postID = $this->uri->segment(3);
			$edit['returnid'] = $this->uri->segment(4);
			$edit['policy'] = $this->Model_admin->get_policy_data($postID);
			if($_POST)
			{
				$returnid = $this->input->post('returnid');
				$now = time();
				$timeupdated = unix_to_human($now);
				$data = array('policy_title'=>$_POST['title'],
							  'policy_content'=>$_POST['content'],
							  'policy_footer'=>$_POST['footer'],
							  'policy_timeupdated'=>$timeupdated,
							  'policy_header'=>$_POST['header']
							 );
				$policyID = $_POST['policyID'];


				$this->Model_admin->update_policy_data($data, $policyID);
				$this->session->set_flashdata('update', '<div class="alert alert-success text-center">Successfully updated!</div>');
				redirect(base_url()."admin/make_new_policies_edit_category/".$returnid);
			}
			else
			{
				$this->load->view('AdminV/edit_policy_pageA', $edit);
			}
		}
		else
	   	{
	    	 //If no session, redirect to login page
	  	   redirect('login', 'refresh');
	  	}

	}


	function view_one_policy()
	{
		if($this->session->userdata('admin_logged_in'))
		{
			$policyID = $this->uri->segment(3);
			$policypage['policy'] = $this->Model_admin->get_one_policy($policyID);
			//$this->load->view('header');
			$this->load->view('AdminV/policy_pageA', $policypage);
		}
		else
   		{
    		 //If no session, redirect to login page
  		   redirect('login', 'refresh');
  		}
	}

	function make_announcement()
	{
		if($this->session->userdata('admin_logged_in'))
		{
			if($_POST)
			{

				$now = time();
				$timeposted = unix_to_human($now);

				$data = array('a_title'=>$_POST['title'],
							  'a_content'=>$_POST['content'],
							  'a_timeposted'=>$timeposted,
							 );

				$this->Model_admin->insert_announcement($data);

				$a_id = $this->Model_admin->get_last_announcement_id();

				$data['users'] = $this->Model_admin->get_users();

				foreach($data['users'] as $usr)
				{
					$datavisible['visible_member_id'] = $usr->user_employeeID;
					$datavisible['a_id'] = $a_id;//1
					$this->Model_admin->insert_announcement_transact($datavisible);
				}

				$now = time();
				$timeposted = unix_to_human($now);
				foreach($data['users'] as $usr)
				{
					$data = array('notif_receiver_id'=>$usr->user_employeeID,
								  'notif_event_id_fk'=>1,
								  'notif_timestamp'=>$timeposted,
								  'notif_sender'=>0,
								  'notif_link_id'=>$a_id);
					$this->Model_admin->insert_notif($data);
				}

				$this->session->set_flashdata('update', '<div class="alert alert-success text-center">Announcement sent!</div>');
				redirect(base_url()."admin/view_edit_announcement");
			}
			else
			{
				//$this->load->view('AdminV/headerA');
				$this->load->view('AdminV/make_announcementA');
			}
		}

		else
	   	{
	    	 //If no session, redirect to login page
	  	   redirect('login', 'refresh');
	  	}
	}

	function view_edit_announcement()
	{
		if($this->session->userdata('admin_logged_in'))
		{
				$data['announcements'] = $this->Model_admin->get_announcements();
				//$this->load->view('AdminV/headerA');
				$this->load->view('AdminV/delete_announcement_modal');
				$this->load->view('AdminV/edit_announcementA',	$data);
		}

		else
	   	{
	    	 //If no session, redirect to login page
	  	   redirect('login', 'refresh');
	  	}
	}

	function edit_announcement()
	{
		if($this->session->userdata('admin_logged_in'))
		{
			$postID = $this->uri->segment(3);
			$edit['announce'] = $this->Model_admin->get_one_announcement($postID);
			if($_POST)
			{
				$now = time();
				$timeupdated = unix_to_human($now);
				$data = array('a_content'=>$_POST['content'],
							  'a_title'=>$_POST['title'],
							  'a_timeposted'=>$timeupdated
							 );
				$postID = $_POST['postid'];
				$this->Model_admin->update_announcement_data($data, $postID);
				$this->session->set_flashdata('update', '<div class="alert alert-success text-center">Successfully updated!</div>');
				redirect(base_url()."admin/view_edit_announcement/");
			}
			else
			{
				$this->load->view('AdminV/edit_announcement_page', $edit);
			}
			//$data['post'] = $this->Model_admin->deactivate_user($postid);
			//redirect(base_url()."admin/view_users");
			//NEED BASE URL
		}
		else
	   	{
	    	 //If no session, redirect to login page
	  	   redirect('login', 'refresh');
	  	}

	}

	function delete_announcement()
	{
		$postid = $this->uri->segment(3);
		$this->Model_admin->delete_announcement_model($postid);
		$this->session->set_flashdata('deletedannounce', '<div class="alert alert-success text-center">Announcement deleted!.</div>');
		redirect(base_url()."admin/view_edit_announcement");
	}

	function view_forms_view()
	{
		if($this->session->userdata('admin_logged_in'))
		{
			$data['documents'] = $this->Model_admin->get_documents();
			$data['companies'] = $this->Model_admin->get_companies();
			$newcompanies = [];
			$uniquecompanies = [];
			foreach($data['companies'] as $d)
			{
				$company = substr( $d->user_sbu, 0, strrpos( $d->user_sbu, '-' ) );
				$newcompanies[] = $company;
			}
			$data['uniquecompanies'] = array_unique($newcompanies);
			$data['error'] = ' ';
			//$this->load->view('AdminV/headerA');
			$this->load->view('AdminV/update_document_modal', $data);
			$this->load->view('AdminV/archive_document_modal');
			$this->load->view('AdminV/delete_document_modal');
			$this->load->view('AdminV/deactivate_document_modal');
			$this->load->view('AdminV/activate_document_modal');
			$this->load->view('AdminV/view_forms', $data);

		}

		else
	   	{
	    	 //If no session, redirect to login page
	  	   redirect('login', 'refresh');
	  	}
	}

	function view_forms_upload()
	{
		if($this->session->userdata('admin_logged_in'))
		{
			$data['error'] = ' ';
			$data['companies'] = $this->Model_admin->get_companies();
			$newcompanies = [];
			$uniquecompanies = [];
			foreach($data['companies'] as $d)
			{
				$company = substr( $d->user_sbu, 0, strrpos( $d->user_sbu, '-' ) );
				$newcompanies[] = $company;
			}
			$data['uniquecompanies'] = array_unique($newcompanies);
			$this->load->view('AdminV/upload_forms_view',  $data);
		}
		else
	   	{
	    	 //If no session, redirect to login page
	  	   redirect('login', 'refresh');
	  	}

	}

	function view_archive_view()
	{
		$data['documents'] = $this->Model_admin->get_documents();
			$this->load->view('AdminV/update_document_modal', array('error' => ' '));
			$this->load->view('AdminV/archive_document_modal');
			$this->load->view('AdminV/delete_document_modal');
			$this->load->view('AdminV/deactivate_document_modal');
			$this->load->view('AdminV/activate_document_modal');
		$this->load->view('AdminV/view_archive', $data);
	}

	function deactivate_document()
	{
		$postid = $this->uri->segment(3);
		$data['post'] = $this->Model_admin->deactivate_document($postid);
		redirect(base_url()."admin/view_forms_view");
	}

	function activate_document()
	{
		$postid = $this->uri->segment(3);
		$data['post'] = $this->Model_admin->activate_document($postid);
		redirect(base_url()."admin/view_forms_view");
	}

	function download_document()
	{
		$docuname = $this->uri->segment(3);
		$name = 'G:/xampp/htdocs/JFCHR/uploads/'. $docuname;
		force_download($name, NULL);
	}

	function do_upload_benefits_summary()
	{
        	if($this->session->userdata('admin_logged_in'))
			{
									$radio = $this->input->post('datesensitive');

									if($radio == "No")
									{
										$config['upload_path']          = './uploads/';
										$config['allowed_types']        = 'doc|docx';

										$this->upload->initialize($config);

										if ($this->upload->do_upload('userfile'))
										{
												$docsuccess = array('upload_doc' => $this->upload->data());
										}

										foreach($docsuccess as $d)
										{
											$raw_name = $d['raw_name'];
											$file_name = $d['file_name'];
											$fullpath = $d['full_path'];
											$filepathonly = $d['file_path'];
										}

                		$rank = $this->input->post("rank");
										$sbu = $this->input->post('sbu');
										$field = $this->input->post('field');
										$pdfpath = $filepathonly.$raw_name.'.pdf';


										$data = array('benefit_path'=>$fullpath,
																	'benefit_rank'=>$rank,
																	'benefit_sbu'=>$sbu,
																	'benefit_field'=>$field);

										$this->Model_admin->insert_benefit_docu($data);

										$word = new COM("Word.Application") or die ("Could not initialise Object.");
										// set it to 1 to see the MS Word window (the actual opening of the document)
										$word->Visible = 0;
										// recommend to set to 0, disables alerts like "Do you want MS Word to be the default .. etc"
										$word->DisplayAlerts = 0;
										// open the word 2007-2013 document
										$word->Documents->Open($fullpath);
										// save it as word 2003
										$word->ActiveDocument->SaveAs('newdocument.doc');
										// convert word 2007-2013 to PDF
										$word->ActiveDocument->ExportAsFixedFormat($pdfpath, 17, false, 0, 0, 0, 0, 7, true, true, 2, true, true, false);
										// quit the Word process
										$word->Quit(false);
										// clean up
										unset($word);
										unlink('E:\Documents\\'.'newdocument.doc');


										redirect(base_url().'admin/benefits_summary_files');

                }
								else
								{
									$config['upload_path']          = './uploads/';
									$config['allowed_types']        = 'doc|docx';

									$this->upload->initialize($config);

									if ($this->upload->do_upload('userfile'))
									{
											$docsuccess = array('upload_doc' => $this->upload->data());
									}

									if ($this->upload->do_upload('afterfile'))
									{
											$aftersuccess = array('upload_after' => $this->upload->data());
									}

									foreach($docsuccess as $d)
									{
										$raw_name = $d['raw_name'];
										$file_name = $d['file_name'];
										$fullpath = $d['full_path'];
										$filepathonly = $d['file_path'];
									}

									foreach($aftersuccess as $d)
									{
										$raw_name_after = $d['raw_name'];
										$file_name_after = $d['file_name'];
										$fullpath_after = $d['full_path'];
										$filepathonly_after = $d['file_path'];
									}

									$rank = $this->input->post("rank");
									$sbu = $this->input->post('sbu');

									$pdfpath = $filepathonly.$raw_name.'.pdf';
									$pdfpath_after = $filepathonly_after.$raw_name_after.'.pdf';


									$field = $this->input->post('field');

									$data = array('benefit_path'=>$fullpath,
																'benefit_rank'=>$rank,
																'benefit_isdatesensitive'=>1,
																'benefit_beforedate'=>$this->input->post('datebefore'),
																'benefit_afterpath'=>$fullpath_after,
																'benefit_sbu'=>$sbu,
																'benefit_field'=>$field);

									$this->Model_admin->insert_benefit_docu($data);

									$word = new COM("Word.Application") or die ("Could not initialise Object.");
									// set it to 1 to see the MS Word window (the actual opening of the document)
									$word->Visible = 0;
									// recommend to set to 0, disables alerts like "Do you want MS Word to be the default .. etc"
									$word->DisplayAlerts = 0;
									// open the word 2007-2013 document
									$word->Documents->Open($fullpath);
									// save it as word 2003
									$word->ActiveDocument->SaveAs('newdocument.doc');
									// convert word 2007-2013 to PDF
									$word->ActiveDocument->ExportAsFixedFormat($pdfpath, 17, false, 0, 0, 0, 0, 7, true, true, 2, true, true, false);
									// quit the Word process
									$word->Quit(false);
									// clean up
									unset($word);
									unlink('E:\Documents\\'.'newdocument.doc');

									$word = new COM("Word.Application") or die ("Could not initialise Object.");
									// set it to 1 to see the MS Word window (the actual opening of the document)
									$word->Visible = 0;
									// recommend to set to 0, disables alerts like "Do you want MS Word to be the default .. etc"
									$word->DisplayAlerts = 0;
									// open the word 2007-2013 document
									$word->Documents->Open($fullpath_after);
									// save it as word 2003
									$word->ActiveDocument->SaveAs('newdocument.doc');
									// convert word 2007-2013 to PDF
									$word->ActiveDocument->ExportAsFixedFormat($pdfpath_after, 17, false, 0, 0, 0, 0, 7, true, true, 2, true, true, false);
									// quit the Word process
									$word->Quit(false);
									// clean up
									unset($word);
									unlink('E:\Documents\\'.'newdocument.doc');


									redirect(base_url().'admin/benefits_summary_files');

								}
            }
         else
   		{
	    	 //If no session, redirect to login page
	  	   redirect('login', 'refresh');
	  	}
}

	 function do_upload()
  {
        	if($this->session->userdata('admin_logged_in'))
			{
                $config['upload_path']          = './uploads/';
                $config['allowed_types']        = '*';

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ( ! $this->upload->do_upload('userfile'))
                {
                        $error = array('error' => $this->upload->display_errors());
                        //$this->load->view('AdminV/headerA');
                        $this->load->view('AdminV/upload_forms_view', $error);
                }
                else
                {
                		$documentname = $this->input->post("docuname");
                		$documentcategory = $this->input->post('docucateg');
										$documentcompany = $this->input->post('company');
                   		$now = time();
						$timeupdated = unix_to_human($now);

						$success = array('upload_data' => $this->upload->data());
                		$file_name = $this->upload->file_name;

										foreach($this->input->post('company') as $company)
										{
											$data = array(
															'document_title'=>$documentname,
															'document_category'=>$documentcategory,
															'document_path'=>$success['upload_data']['full_path'],
															'document_timestamp'=>$timeupdated,
															'document_filename'=>$file_name,
															'document_active'=>1,
															'document_isarchived'=>0,
															'document_version' => '1.0',
															'document_oldtitle'=>'N/A',
															'document_oldversion'=>'N/A',
															'document_company'=>$company
										 );

										$this->Model_admin->insert_document($data);

										$id = $this->Model_admin->get_insert_id();

										$data['users'] = $this->Model_admin->get_users();

										$now = time();
										$timeposted = unix_to_human($now);
										foreach($data['users'] as $usr)
										{
										$data = array('notif_receiver_id'=>$usr->user_employeeID,
												'notif_event_id_fk'=>3,
												'notif_timestamp'=>$timeposted,
												'notif_sender'=>0,
												'notif_link_id'=>$id);
										$this->Model_admin->insert_notif($data);
										}
										}


												redirect(base_url().'admin/view_forms_view');
                }
            }
         else
   		{
	    	 //If no session, redirect to login page
	  	   redirect('login', 'refresh');
	  	}
}

     function do_update_document()
        {
        	if($this->session->userdata('admin_logged_in'))
			{
                $config['upload_path']          = './uploads/';
                $config['allowed_types']        = 'doc|docx';

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ( ! $this->upload->do_upload('userfile'))
                {
                        $error = array('error' => $this->upload->display_errors());
                        //$this->load->view('AdminV/headerA');
                        $this->load->view('AdminV/view_forms', $error);
                }
                else
                {
                		$postid = $_POST['documentid'];
                		$documentname = $this->input->post("docuname");
                		$documentcategory = $this->input->post('docucateg');
										$company = $this->input->post('company');
                   		$now = time();
						$timeupdated = unix_to_human($now);
						$success = array('upload_data' => $this->upload->data());
                		$file_name = $this->upload->file_name;

                		$data['document'] = $this->Model_admin->get_one_document($postid);
                		foreach($data['document'] as $d)
                		{
                			$current_version = $d->document_version;
                			$oldtitle = $d->document_title;
                		}
						$add_version = 0.1;
						$added_version = $current_version + $add_version;
						$final_version = number_format($added_version, 1, '.' ,'');



                		$data = array(
                					  'document_title'=>$documentname,
                					  'document_category'=>$documentcategory,
                					  'document_path'=>$success['upload_data']['full_path'],
													  'document_timestamp'=>$timeupdated,
													  'document_filename'=>$file_name,
													  'document_active'=>1,
													  'document_isarchived'=>0,
													  'document_version' => $final_version,
													  'document_oldtitle'=>$oldtitle,
													  'document_oldversion'=>$current_version,
														'document_company'=>$company
									 );

						$this->Model_admin->insert_document($data);
						$this->Model_admin->document_archive($postid);


                        //$this->load->view('AdminV/headerA');
                        $this->session->set_flashdata('updated', '<div class="alert alert-success text-center">Document successfully updated!</div>');
                        redirect(base_url().'Admin/view_forms_view');
                }
            }
         else
   		{
	    	 //If no session, redirect to login page
	  	   redirect('login', 'refresh');
	  	}
    }


    function view_policies()
    {
    	if($this->session->userdata('admin_logged_in'))
		{
			$data['policies'] = $this->Model_admin->get_policies();
			$this->load->view('AdminV/delete_policy_modal');
			$this->load->view('AdminV/view_policies_viewA', $data);
		}


		else
   		{
	    	 //If no session, redirect to login page
	  	   redirect('login', 'refresh');
	  	}
    }

		function make_new_policies_edit_category()
		{
			if($this->session->userdata('admin_logged_in'))
			{
				$policycategid = $this->uri->segment(3);
				$data['policies'] = $this->Model_admin->get_policy_datas($policycategid);
				$data['policycategid'] = $policycategid;
				$this->load->view('AdminV/delete_policy_modal');
				$this->load->view('AdminV/view_policies_viewA', $data);
			}


		else
			{
				 //If no session, redirect to login page
				 redirect('login', 'refresh');
			}
		}

		function make_new_policies()
		{
			if($this->session->userdata('admin_logged_in'))
			{
				$data['companies'] = $this->Model_admin->get_companies();
				$newcompanies = [];
				$uniquecompanies = [];
				foreach($data['companies'] as $d)
				{
					$company = substr( $d->user_sbu, 0, strrpos( $d->user_sbu, '-' ) );
					$newcompanies[] = $company;
				}
				$data['uniquecompanies'] = array_unique($newcompanies);
				$this->session->set_flashdata('nocompanies', '<div class="alert alert-danger text-center">No companies</div>');
				$this->load->view('AdminV/make_new_policies_companies',$data);
			}

			else
		   {
		   	redirect('login', 'refresh');
		  	}
	  }

		function view_one_company_policies()
		{
			if($this->session->userdata('admin_logged_in'))
			{
				$company = $this->uri->segment(3);

								$new = str_replace("%20"," ",$company);
				$data['categories'] = $this->Model_admin->get_company_categories($new);
				$this->session->set_flashdata('nocompanies', '<div class="alert alert-danger text-center">There are no categories.</div>');
				$this->load->view('AdminV/make_new_policies_companies_category_view',$data);
			}

			else
		   {
		   	redirect('login', 'refresh');
		  	}
		}


				function edit_categ_new()
				{
					if($this->session->userdata('admin_logged_in'))
				{
					$company = $this->uri->segment(3);
					$category = $this->input->post('categ');
					$newcategory = $this->input->post('newcateg');
					$action = $this->input->post('action');


					if($action == 'Edit')
					{
						$this->Model_admin->update_category($category,$newcategory);
					    $this->session->set_flashdata('posted', '<div class="alert alert-success text-center">Category edited!</div>');
					} else if($action == 'Delete')
					{
						$this->Model_admin->delete_category($category);
						$this->Model_admin->delete_subcategs($category);
					    $this->session->set_flashdata('posted', '<div class="alert alert-danger text-center">Category deleted</div>');
					}

					redirect(base_url()."admin/make_one_policies_company/".$company);
				}

				else
					{
						 //If no session, redirect to login page
						 redirect('login', 'refresh');
					}
				}


		function make_one_policies_company()
		{
			if($this->session->userdata('admin_logged_in'))
			{
				$companyname = $this->uri->segment(3);

				$new = str_replace("%20"," ",$companyname);
				$data['category'] = $this->Model_admin->get_company_categories($new);
				$data['companyname'] = $companyname;
				$this->session->set_flashdata('nocategory', '<div class="alert alert-danger text-center">No available categories.</div>');
				$this->load->view('AdminV/make_one_policies_company_view',$data);
			}

			else
		   {
		   	redirect('login', 'refresh');
		  	}
		}

    function make_new_policy()
    {
    	if($this->session->userdata('admin_logged_in'))
		{
			if($_POST)
			{
				$cc = $this->input->post('cc');
				$now = time();
				$time = unix_to_human($now);
				$data = array('policy_title'=>$_POST['title'],
										  'policy_content'=>$_POST['content'],
										  'policy_footer'=>$_POST['footer'],
										  'policy_timeupdated'=>$time,
										  'policy_dateposted'=>$time,
										  'policy_header'=>$_POST['header'],
										  'policy_category_fk'=>$_POST['categ']
							 );


				$this->Model_admin->insert_new_policy($data);

				$id = $this->Model_admin->get_insert_id();

				$data['users'] = $this->Model_admin->get_users();

				$this->session->set_flashdata('posted', '<div class="alert alert-success text-center">Successfully posted</div>');
				redirect(base_url()."admin/make_one_policies_company/".$cc);
			}
			else
			{

			}
		}

		else
	   	{
	    	 //If no session, redirect to login page
	  	   redirect('login', 'refresh');
	  	}
    }

    function make_new_category()
    {
    	if($this->session->userdata('admin_logged_in'))
		{
			$company = $this->uri->segment(3);
    	$category = $_POST['category'];
			$new = str_replace("%20"," ",$company);
    	$data = array('policy_category'=>$category,
										'policy_category_company'=>$new);
			$this->Model_admin->insert_new_category($data);
			$this->session->set_flashdata('posted', '<div class="alert alert-success text-center">Successfully created new category!</div>');
			redirect(base_url()."admin/make_one_policies_company/".$company);
		}

		else
	   	{
	    	 //If no session, redirect to login page
	  	   redirect('login', 'refresh');
	  	}
    }

    function delete_policy()
	{
		if($this->session->userdata('admin_logged_in'))
		{
			$postid = $this->uri->segment(3);
			$data['post'] = $this->Model_admin->delete_policy($postid);
			$this->session->set_flashdata('posted', '<div class="alert alert-danger text-center">Policy deleted!</div>');
			redirect(base_url()."admin/view_policies/");
		}

		else
	   	{
	    	 //If no session, redirect to login page
	  	   redirect('login', 'refresh');
	  	}
	}

	function delete_document()
	{
		if($this->session->userdata('admin_logged_in'))
		{
				$postid = $this->uri->segment(3);
				$this->Model_admin->delete_document_posted($postid);
				/*
				$data['document'] = $this->Model_admin->get_one_document($postid);
				foreach($data['document'] as $d)
				{
					$filepath = $d->document_path;
					unlink($filepath);
				}
				*/
				$this->session->set_flashdata('deleted', '<div class="alert alert-danger text-center">Document deleted!</div>');
				redirect(base_url()."admin/view_forms_view/");
			}

		else
	   	{
	    	 //If no session, redirect to login page
	  	   redirect('login', 'refresh');
	  	}
	}

	function archive_document()
	{
		if($this->session->userdata('admin_logged_in'))
		{
				$postid = $this->uri->segment(3);
				$this->Model_admin->document_archive($postid);
				$this->session->set_flashdata('deleted', '<div class="alert alert-success text-center">Document moved to archives!</div>');
				redirect(base_url()."admin/view_forms_view/");
			}

		else
	   	{
	    	 //If no session, redirect to login page
	  	   redirect('login', 'refresh');
	  	}
	}

function edit_current_quitclaim()
{
	if($this->session->userdata('admin_logged_in'))
	{
				$data['users'] = $this->Model_admin->get_quitclaim_active();
				$this->session->set_flashdata('noquitclaim', '<div class="alert alert-danger text-center">No Quitclaim active</div>');
				$this->load->view('AdminV/edit_current_quitclaim', $data);
			}

	else
		{
			 //If no session, redirect to login page
			 redirect('login', 'refresh');
		}
}


function do_generate_quitclaim_report()
{
	$eid = $this->uri->segment(3);
	$count = 0;
	$done = 0;
	$data['quitclaim'] = $this->Model_admin->get_tblQuitClaim_user($eid);
	$data['users'] = $this->Model_admin->get_users();

	foreach($data['quitclaim'] as $q)
	{
		$count++;
	}
	require_once APPPATH.'/libraries/PHPWord/src/PhpWord/Autoloader.php';

	\PhpOffice\PhpWord\Autoloader::register();

	// Creating the new document...
	$phpWord = new \PhpOffice\PhpWord\PhpWord();

	/* Note: any element you append to a document must reside inside of a Section. */

	// Adding an empty Section to the document...
	$section = $phpWord->addSection();

	$section->addText('This document is generated by the admin for quitclaim.');

	$section->addText('');




	foreach($data['quitclaim'] as $q)
	{
		$approved;
		$timeapproved;
		$count = 0;
		$id = $q->quitclaim_id;
		$quitclaimername = $q->quitclaim_sender;
		$data['details'] = $this->Model_admin->get_quitclaim_happenings($id);

		$tableStyle = array(
    'borderColor' => '006699',
    'borderSize' => 6,
    'cellMargin' => 50
);


$firstRowStyle = array('bgColor' => '66BBFF');
$phpWord->addTableStyle('myTable', $tableStyle, $firstRowStyle);


		$section->addText("Quitclaim report for:".$quitclaimername);

		$header = array('size' => 16, 'bold' => true);
		$table = $section->addTable('myTable');
		$table->addRow();
		$table->addCell(800)->addText(htmlspecialchars("#"));
		$table->addCell(1750)->addText(htmlspecialchars("Approver"));
		$table->addCell(800)->addText(htmlspecialchars("Approved?"));
		$table->addCell(1750)->addText(htmlspecialchars("Position"));
		$table->addCell(1750)->addText(htmlspecialchars("Time approved"));


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

				$table->addRow();
			$count++;
			$table->addCell(800)->addText(htmlspecialchars("{$count}"));
			$table->addCell(1750)->addText(htmlspecialchars("{$name}"));
			$table->addCell(800)->addText(htmlspecialchars("{$approved}"));
			$table->addCell(1750)->addText(htmlspecialchars("{$position}"));
			$table->addCell(1750)->addText(htmlspecialchars("{$timeapproved}"));
		}
		$section->addText('');
		$section->addText('');
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
	$path = APPPATH.'quitclaimreports\\'.$rand.'QuitClaimReport.docx';
	$filename = $rand.'QuitClaimReport.docx';
	$objWriter->save($path);

	$data = array('report_qc_path'=>$path,
								'report_qc_filename'=>$filename,
								'report_qc_timestamp'=>$timeupdated,
								'report_qc_eid'=>$eid);
	$this->Model_admin->insert_quitclaim_report($data);
			$this->session->set_flashdata('success', '<div class="alert alert-success text-center">Success!</div>');
	redirect(base_url().'admin/edit_quitclaim/'.$eid);
}

function edit_quitclaim()
{
	if($this->session->userdata('admin_logged_in'))
	{
				$employeeID = $this->uri->segment(3);
				$data['employeeID'] = $employeeID;
				$data['id'] = $this->Model_admin->get_quitclaim_id($employeeID);
				foreach($data['id'] as $i)
				{
					$quitclaim_id = $i->quitclaim_id;
				}
				$data['users'] = $this->Model_admin->get_users();

		    $data['quitclaim'] = $this->Model_admin->get_quitclaim_progress_for_approval($quitclaim_id);
				$data['reports'] = $this->Model_admin->get_generated_reports($employeeID);
				$this->load->view('AdminV/update_hierarchy__quitclaim_view1', $data);
				$this->load->view('AdminV/edit_quitclaim', $data);
			}

	else
		{
			 //If no session, redirect to login page
			 redirect('login', 'refresh');
		}
}

function do_update_hierarchy_quitclaim_one_user()
{
	if($this->session->userdata('admin_logged_in'))
	{
			$back = $_POST['senderid'];
			$oldapprover = $_POST['updatingid1'];
			$newapprover = $_POST['approver'];
			$dcsID = $_POST['updatingdcsid'];
			$this->Model_admin->update_hierarchy_quitclaim_one_user($oldapprover,$newapprover,$dcsID);

			$this->session->set_flashdata('swapped', '<div class="alert alert-success text-center">Approver updated!.</div>');
			redirect(base_url()."Admin/edit_quitclaim/".$back);
		}

	else
		{
			 //If no session, redirect to login page
			 redirect('login', 'refresh');
		}
}


	function view_quitclaim_workflow()
	{
		if($this->session->userdata('admin_logged_in'))
		{
					$data['quitclaim'] = $this->Model_admin->get_quitclaim_header();
					$data['quitclaimtitles'] = $this->Model_admin->get_quitclaim_titles();
					$data['users'] = $this->Model_admin->get_titles();



					$this->load->view('AdminV/add_hierarchy_modal_quitclaim',$data);
					$this->load->view('AdminV/swap_hierarchy_modal_quitclaim',$data);
					$this->load->view('AdminV/delete_hierarchy_modal_quitclaim');
					$this->load->view('AdminV/update_hierarchy__quitclaim_view', $data);
					$this->load->view('AdminV/view_quitclaim_workflow_page', $data);
				}

		else
	   	{
	    	 //If no session, redirect to login page
	  	   redirect('login', 'refresh');
	  	}
	}



	function do_add_new_approver_quitclaim()
	{
		if($this->session->userdata('admin_logged_in'))
		{
				$approver = $_POST['approver'];
				$data = array('quitclaim_approvers_position'=>$approver);
				$this->Model_admin->add_new_approver_quitclaim($data);
				$this->session->set_flashdata('swapped', '<div class="alert alert-success text-center">Approver added!.</div>');
				redirect(base_url()."Admin/view_quitclaim_workflow/");
		}

		else
	   	{
	    	 //If no session, redirect to login page
	  	   redirect('login', 'refresh');
	  	}
	}

	function create_new_quitclaim_workflow()
	{
		if($this->session->userdata('admin_logged_in'))
		{
			$data['users'] = $this->Model_admin->get_titles();
			$data['error'] = ' ';
			$data['alldepttitles'] = $this->Model_admin->get_departments_titles();
			$this->load->view('AdminV/create_workflow_page',  $data);
		}
		else
	   	{
	    	 //If no session, redirect to login page
	  	   redirect('login', 'refresh');
	  	}
	}

	function do_create_new_workflow()
	{
		if($this->session->userdata('admin_logged_in'))
		{
			$SBU = $this->input->post('department');
			foreach($_POST['approvers'] as $approve)
			{
				$dataapprover['quitclaim_approvers_position'] = $approve;
				$dataapprover['quitclaim_approvers_sbu'] = $SBU;

				$this->Model_admin->insert_new_quitclaim_approvers($dataapprover);
			}

			$this->session->set_flashdata('workflow', '<div class="alert alert-success text-center">Workflow created!!.</div>');
			redirect(base_url().'admin');

		}
		else
	   	{
	    	 //If no session, redirect to login page
	  	   redirect('login', 'refresh');
	  	}
	}

	function deactivate_quitclaim()
	{
		if($this->session->userdata('admin_logged_in'))
		{
			$senderid = $this->uri->segment(3);

			$data['tblQuitClaim'] = $this->Model_admin->get_tblQuitClaim_user($senderid);

			foreach($data['tblQuitClaim'] as $t)
			{
				$tblQuitClaimPK = $t->quitclaim_id;
			}

			$this->Model_admin->delete_from_tblQuitClaim($tblQuitClaimPK);
			$this->Model_admin->delete_from_tblQuitClaimA($tblQuitClaimPK);
			$this->Model_admin->delete_from_tblQuitClaimCM($tblQuitClaimPK);
			$this->Model_admin->delete_from_tblQuitClaimDocuments($tblQuitClaimPK);
			$this->Model_admin->delete_from_tblQuitClaimSign($tblQuitClaimPK);
			$this->Model_admin->delete_from_tblQuitClaimTR($tblQuitClaimPK);
			$this->Model_admin->delete_from_tblQuitClaimScripts($tblQuitClaimPK);
			$this->Model_admin->delete_from_tblQuitClaimReports($senderid);


			$this->Model_admin->set_no_quitclaim($senderid);
			$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">QuitClaim deactivated!</div>');
			redirect('Admin/view_users');


		}
		{
			 //If no session, redirect to login page
			 redirect('login', 'refresh');
		}
	}


	function activate_quitclaim()
    {
    	if($this->session->userdata('admin_logged_in'))
		{
			$employeeID = $this->uri->segment(3);

			$data['approvers_position'] = $this->Model_admin->get_quitclaim_approvers($employeeID);
			if(empty($data['approvers_position']))
			{
							$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">No defined workflow yet!!</div>');
							redirect('Admin/view_users');

			}
			else
			{


				$data['name'] = $this->Model_admin->get_fullname($employeeID);
				foreach($data['name'] as $d)
				{
					$fullname = $d->user_firstname.$d->user_middlename.$d->user_lastname;
					$usr['fullname'] = $d->user_firstname.' '.$d->user_middlename.' '.$d->user_lastname;
					$fullname = str_replace(".","",$fullname);
					$usr['fullname'] = str_replace(".","",$usr['fullname']);
				}
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
			fopen('G:\xampp\htdocs\JFCHR\\'.$fullname.$employeeID.'.txt', "w");
			$this->Model_user->insert_quitclaim($data);
			$last_quitclaim_id = $this->Model_user->get_last_quitclaim_id();

			//GetApprovers
			$data['approvers_position'] = $this->Model_admin->get_quitclaim_approvers($employeeID);
/*
			$setapprovers = array();

			foreach($data['approvers_position'] as $a)
			{
				$position = $a->quitclaim_approvers_position;

				$data['id_of_person_in_position'] = $this->Model_user->get_approver_id($position,$SBU);
				foreach($data['id_of_person_in_position'] as $pos)
				{
					$setapprovers[] = $pos->user_employeeID;
				}
			}

			foreach($setapprovers as $key => $SA)
			{
				if($SA == $employeeID)
				{
					unset($setapprovers[$key]);
				}
			}

			var_dump($setapprovers);
			*/


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

									redirect('Admin/view_users');
								}
	}

	    else
		{
    		 //If no session, redirect to login page
  		   redirect('login', 'refresh');

    }
	}


    function view_hotlines()
	{
		if($this->session->userdata('admin_logged_in'))
		{
			$data['hotlines'] = $this->Model_admin->get_hotlines();
			$this->load->view('AdminV/hotlines_editing_modal');
			$this->load->view('ADMINV/hotline_delete_modal');
			$this->load->view('AdminV/hotlines_view',$data);
		}
		else
		{
    		 //If no session, redirect to login page
  		   redirect('login', 'refresh');
  		}
	}


	function manage_hotlines()
	{
		if($this->session->userdata('admin_logged_in'))
		{
			$this->load->view('AdminV/hotlines_view_manage');
		}
		else
		{
    		 //If no session, redirect to login page
  		   redirect('login', 'refresh');
  		}
	}

	function do_submit_hotline()
	{
		if($this->session->userdata('admin_logged_in'))
		{
			$data = array('hotline_name'=>$_POST['hotname'],
						  'hotline_number'=>$_POST['hotnum']);
			 $this->Model_admin->insert_hotline($data);

			 $id = $this->Model_admin->get_insert_id();

			 $data['users'] = $this->Model_admin->get_users();

	 		$now = time();
	 		$timeposted = unix_to_human($now);
	 		foreach($data['users'] as $usr)
	 		{
	 			$data = array('notif_receiver_id'=>$usr->user_employeeID,
	 							'notif_event_id_fk'=>5,
	 							'notif_timestamp'=>$timeposted,
	 							'notif_sender'=>0,
	 							'notif_link_id'=>$id);
	 			$this->Model_admin->insert_notif($data);
			}
			 redirect('admin/view_hotlines');

		}
		else
		{
    		 //If no session, redirect to login page
  		   redirect('login', 'refresh');
  		}
	}

	function do_upate_hotline()
	{
		if($this->session->userdata('admin_logged_in'))
		{
			$id = $_POST['hotlineid'];
			$data = array('hotline_name'=>$_POST['hotlinename'],
						  'hotline_number'=>$_POST['hotline']);
			 $this->Model_admin->update_hotline($data,$id);
			 redirect('admin/view_hotlines');

		}
		else
		{
    		 //If no session, redirect to login page
  		   redirect('login', 'refresh');
  		}
	}

	function do_delete_hotline()
	{
		if($this->session->userdata('admin_logged_in'))
		{
			$id = $this->uri->segment(3);
			 $this->Model_admin->delete_hotline($id);
			 redirect('admin/view_hotlines');

		}
		else
		{
    		 //If no session, redirect to login page
  		   redirect('login', 'refresh');
  		}
	}

	function generate_scripts()
	{
		$data['chat'] = $this->Model_admin->get_quitclaim_comments_for_generation($id);

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
				$fontStyle = new \PhpOffice\PhpWord\Style\Font();
				$fontStyle->setBold(true);
				$fontStyle->setSize(13);
				$myTextElement = $section->addText($c->user_lastname.' on '.$c->qc_timestamp);
				$myTextElement->setFontStyle($fontStyle);
			}

			$now = time();
				$timeupdated = unix_to_human($now);
				$fontStyle = new \PhpOffice\PhpWord\Style\Font();
				$fontStyle->setBold(true);
				$fontStyle->setSize(13);
				$fontStyle->setColor('Red');
				$myTextElement = $section->addText('Generated on:'.$timeupdated);
				$myTextElement->setFontStyle($fontStyle);

				// Saving the document as OOXML file...
				$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
				$path = APPPATH.'createdwordfile/'.$lname.$qc_id.$rand.'Scripts.docx';
				$objWriter->save($path);
				$rawname = $qc_id.$rand.'Scripts.docx';
				$rawnamenoextension = $qc_id.$rand.'Scripts';

				$FILEPATH = APPPATH.'createdwordfile/';


		}
	}


	function view_users_values()
	{
		if($this->session->userdata('admin_logged_in'))
		{
			$data['users'] = $this->Model_admin->get_users();
			$this->load->view('AdminV/view_user_for_values', $data);
		}
		else
   		{
    		 //If no session, redirect to login page
  		   redirect('login', 'refresh');
  		}
	}

	function upload_benefits_summary()
	{
		if($this->session->userdata('admin_logged_in'))
		{
			$data['error'] = ' ';
			$data['ranks'] = $this->Model_admin->get_ranks();
			$data['sbus'] = $this->Model_admin->get_sbus();
			$this->load->view('AdminV/upload_benefits_summary',$data);
		}
		else
			{
				 //If no session, redirect to login page
				 redirect('login', 'refresh');
			}
	}

	function do_delete_benefit_summary()
	{
		if($this->session->userdata('admin_logged_in'))
		{
			$id = $this->uri->segment(3);
			$data['details'] = $this->Model_admin->get_docu_benefit($id);
			foreach($data['details'] as $d)
			{
				$fullpath = $d->benefit_path;
			}
			unlink($fullpath);
			$this->Model_admin->delete_benefit_docu($id);
			redirect('admin/benefits_summary_files');
		}
		else
			{
				 //If no session, redirect to login page
				 redirect('login', 'refresh');
			}
	}

	function benefits_summary_files()
	{
		if($this->session->userdata('admin_logged_in'))
		{
			$data['docu'] = $this->Model_admin->get_benefits_docu();
			$this->load->view('AdminV/benefit_delete_modal');

						$this->session->set_flashdata('nodocu', '<div class="alert alert-danger text-center">No Documents available</div>');
			$this->load->view('AdminV/benefits_documents',$data);
		}
		else
			{
				 //If no session, redirect to login page
				 redirect('login', 'refresh');
			}
	}


		function edit_user_one()
		{
			if($this->session->userdata('admin_logged_in'))
			{

				$data = array('user_email'=>$this->input->post('email'),
											'user_username'=>$this->input->post('username'),
											'user_password'=>$this->input->post('password'),
											'user_sbu'=>$this->input->post('SBU'),
											'user_positiontitle'=>$this->input->post('ptitle'),
											'user_rank'=>$this->input->post('rank'),
	                    'user_isfield'=>$this->input->post('field'));
				$this->Model_admin->update_user_details($this->input->post('userid'),$data);
				redirect('Admin/view_users/');
			}
			else
				{
					 //If no session, redirect to login page
					 redirect('login', 'refresh');
				}
		}

	function view_one_user_value()
	{
		if($this->session->userdata('admin_logged_in'))
		{
			$id = $this->uri->segment(3);
			$data['values'] = $this->Model_admin->get_one_user_value($id);

			$this->session->set_flashdata('novalues', '<div class="alert alert-danger text-center">No values available for this user.</div>');
			$this->load->view('AdminV/update_values_modal');
			$this->load->view('AdminV/view_one_user_values', $data);
		}
		else
   		{
    		 //If no session, redirect to login page
  		   redirect('login', 'refresh');
  		}
	}

	function do_update_value()
	{
		if($this->session->userdata('admin_logged_in'))
		{
			$id = $_POST['values_id'];
			$userid = $_POST['value_owner_id'];

			$data = array('values_value'=>$_POST['values_value']);
			 $this->Model_admin->update_value($data,$id);

			$this->session->set_flashdata('value', '<div class="alert alert-success text-center">Value updated.</div>');
			 redirect('admin/view_one_user_value/'.$userid);
		}
		else
		{
    		 //If no session, redirect to login page
  		   redirect('login', 'refresh');
  		}
	}

	function view_quitclaim_chat_generation()
	{
		if($this->session->userdata('admin_logged_in'))
		{
			$data['users'] = $this->Model_admin->get_users_who_is_quitclaim();
			$this->load->view('AdminV/view_chat_generation', $data);
		}
		else
   		{
    		 //If no session, redirect to login page
  		   redirect('login', 'refresh');
  		}
	}

	function view_one_user_chatbox()
	{
		if($this->session->userdata('admin_logged_in'))
		{
			$id = $this->uri->segment(3);
			$data['id'] = $id;
			$data['comments'] = $this->Model_admin->get_quitclaim_comments($id);
			$data['users'] = $this->Model_user->get_users();

			$data['scripts'] = $this->Model_admin->get_generated_scripts($id);
			$this->load->view('AdminV/view_chat_generation_one', $data);
		}
		else
   		{
    		 //If no session, redirect to login page
  		   redirect('login', 'refresh');
  		}
	}

	function download_script()
	{
		$docuname=  $this->uri->segment(3);
		$name = APPPATH.'createdwordfile\\'.$docuname;
		force_download($name,NULL);
		echo $docuname;
		echo'<br>';
		echo $name;
		echo 'potangina';
	}

	function do_generate_script()
	{
		require_once(APPPATH . 'libraries/jSignature_Tools_Base30.php');
		$imgStr = $_POST['signature'];
		$id = $_POST['id'];

	$split = "";
	list($type, $split) = explode(";", $imgStr);

	// removes the raw encoded image data
	list($encType, $split) = explode(",", $split);

	$converter = new jSignature_Tools_Base30();

	// $split now just contains "HEhda1ZDGAD_EDFddjeAD"
	$raw = $converter->Base64ToNative($split);

 	// Create a image
    $im = imagecreatetruecolor(800, 200);

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
		$bits = 1;
		$rand = bin2hex(openssl_random_pseudo_bytes($bits));
    $filename =APPPATH . 'signatures\\'.$rand.'signature.png'; // Make folder path is writeable
    imagepng($im,$filename); // Removing $filename will output to browser instead of saving

    // start an output buffer to write the raw image data to
    ob_start();
       imagepng($im);
       $out = ob_get_contents();
    ob_end_clean();

    // clean up the image resource handle
    imagedestroy($im);


		//SO MAYT SIGNATURE NA
		$data['chat'] = $this->Model_admin->get_quitclaim_comments_for_generation($id);

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
				$fontStyle = new \PhpOffice\PhpWord\Style\Font();
				$fontStyle->setBold(true);
				$fontStyle->setSize(13);
				$myTextElement = $section->addText($c->user_lastname.' on '.$c->qc_timestamp);
				$myTextElement->setFontStyle($fontStyle);

				$section->addText("        -".$c->qc_comment);
				$qc_id = $c->qc_user_quitclaim_id;
			}

			$now = time();
				$timeupdated = unix_to_human($now);
				$fontStyle = new \PhpOffice\PhpWord\Style\Font();
				$fontStyle->setBold(true);
				$fontStyle->setSize(13);
				$fontStyle->setColor('Red');
				$myTextElement = $section->addText('Generated on:'.$timeupdated);
				$myTextElement->setFontStyle($fontStyle);


			// Saving the document as OOXML file...
			$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
			$path = APPPATH.'createdwordfile/'.$qc_id.$rand.'Scripts.docx';
			$objWriter->save($path);
			$rawname = $qc_id.$rand.'Scripts.docx';
			$rawnamenoextension = $qc_id.$rand.'Scripts';

			$FILEPATH = APPPATH.'createdwordfile/';

			include_once APPPATH.'libraries/PHPWord/samples/Sample_Header.php';

			// Read contents

			$phpWord = \PhpOffice\PhpWord\IOFactory::load($FILEPATH.$rawname);

			$sections = $phpWord->getSections();
			$section = $sections[0]; // le document ne contient qu'une section
			$arrays = $section->getElements();
			$section->addImage($filename);
			// Save file
			write($phpWord, basename(__FILE__, '.php'), $writers,$id);
	}
}

function insert_script()
{
	$this->load->helper('array');
	$data = $this->session->flashdata('data');
	$this->Model_admin->insert_generated_scripts($data);
	$id =  element('scripts_quitclaim_id', $data);
	$this->session->set_flashdata('success', '<div class="alert alert-success text-center">Chat generated successfully</div>');

	redirect(base_url().'admin/view_one_user_chatbox/'.$id);
}

function view_all_benefits()
{
	if($this->session->userdata('admin_logged_in'))
	{
		$data['users'] = $this->Model_admin->get_users();
		$data['benefits'] = $this->Model_admin->get_all_benefits();
		$this->load->view('AdminV/view_all_benefits', $data);
	}
	else
		{
			 //If no session, redirect to login page
			 redirect('login', 'refresh');
		}
}

function view_one_benefit_enrolment()
{
	if($this->session->userdata('admin_logged_in'))
	{
		$postid = $this->uri->segment(3);
		$data['users'] = $this->Model_admin->get_users();
		$data['benefits'] = $this->Model_admin->get_one_benefit($postid);
		$this->load->view('AdminV/delete_benefit_field');
		$this->load->view('AdminV/update_benefit_field');
		$this->load->view('AdminV/add_benefit_field');
		$this->load->view('AdminV/view_one_benefit_enrolment', $data);
	}
	else
		{
			 //If no session, redirect to login page
			 redirect('login', 'refresh');
		}
}

function do_update_benefit_field()
{
	if($this->session->userdata('admin_logged_in'))
	{
		$id = $this->input->post('updatingid');
		$newfield = $this->input->post('field');
		$this->Model_admin->update_benefit_field($id,$newfield);
		$benefitid = $this->input->post('benefitid');
		$this->session->set_flashdata('success', '<div class="alert alert-success text-center">Field updated successfully!</div>');
		redirect(base_url().'admin/view_one_benefit_enrolment/'.$benefitid);
	}
	else
		{
			 //If no session, redirect to login page
			 redirect('login', 'refresh');
		}
}

function delete_benefit_field()
{
	if($this->session->userdata('admin_logged_in'))
{
	$id = $this->uri->segment(3);
	$benefitid = $this->uri->segment(4);
	$this->Model_admin->delete_benefit_field($id);
	$this->session->set_flashdata('success', '<div class="alert alert-success text-center">Field deleted successfully!</div>');
	redirect(base_url().'admin/view_one_benefit_enrolment/'.$benefitid);
}
else
	{
		 //If no session, redirect to login page
		 redirect('login', 'refresh');
	}
}

function add_new_benefit_field()
{
	if($this->session->userdata('admin_logged_in'))
	{
		$field = $this->input->post('Field');
		$benefits_pk_fk = $this->input->post('benefitpkfk');
		$data = array('benefit_field'=>$field,
									'tblBenefits_pk_fk'=>$benefits_pk_fk);
		$this->Model_admin->add_benefit_field($data);
		$this->session->set_flashdata('success', '<div class="alert alert-success text-center">Field added successfully!</div>');
		$benefitid = $this->input->post('benefitid');
		redirect(base_url().'admin/view_one_benefit_enrolment/'.$benefitid);
	}
	else
		{
			 //If no session, redirect to login page
			 redirect('login', 'refresh');
		}
}

function make_new_benefit()
{
	if($this->session->userdata('admin_logged_in'))
	{
		$data['users'] = $this->Model_admin->get_users();

		$data['alldepttitles'] = $this->Model_admin->get_departments_titles();
		$data['defined'] = $this->Model_admin->get_benefits_defined();
		$this->load->view('AdminV/make_new_benefit',$data);
	}
	else
		{
			 //If no session, redirect to login page
			 redirect('login', 'refresh');
		}
}

function benefits_to_approve()
{
	if($this->session->userdata('admin_logged_in'))
	{
		$data['enrolment'] = $this->Model_admin->get_requesting_benefits();
		$data['users'] = $this->Model_admin->get_users();
		$this->load->view('AdminV/benefits_to_approve_view',$data);
	}
	else
	{
		 //If no session, redirect to login page
		 redirect('login', 'refresh');
	}
}

function download_benefit()
{
	$docuname = $this->uri->segment(3);
	$name = 'G:\xampp\htdocs\JFCHR\application\benefitsenrolment\\'. $docuname;
	force_download($name, NULL);
}

function process_benefits()
{
	if($this->session->userdata('admin_logged_in'))
	{
		//SET SUBMISSION AS IS APPROVED

		$benefitsubmissionid = $this->input->post('benefitsubmissionid');

		$value = $this->input->post('value');
		$senderid = $this->input->post('senderid');
		$title = $this->input->post('title');
		$wantedvalue = $this->input->post('wantedvalue');
		$finalvalue = $value-$wantedvalue;


		if($this->input->post('btn_dcs') == "Approve")
	{
		$this->Model_admin->update_value_accept($finalvalue,$senderid,$title);

		$this->Model_user->accept_benefit($benefitsubmissionid);
		$this->session->set_flashdata('process', '<div class="alert alert-success text-center">Approved!</div>');
	}
	else if($this->input->post('btn_dcs') == "Reject")
	{
		//Do something
		$this->session->set_flashdata('process', '<div class="alert alert-danger text-center">Rejected!</div>');
	}

	redirect(base_url().'admin/benefits_to_approve');



	}
	else
	{
		 //If no session, redirect to login page
		 redirect('login', 'refresh');
	}
}

function view_one_benefit_to_approve()
{
		if($this->session->userdata('admin_logged_in'))
		{
			$id = $this->uri->segment(3);
			$data['details'] = $this->Model_admin->get_benefits_submission_details($id);

			foreach($data['details'] as $d)
			{
				$pkfk = $d->tblBenefits_pk_fk;
			}

			$data['enrolment'] = $this->Model_admin->get_one_benefit($pkfk);
			$data['users'] = $this->Model_admin->get_users();
			foreach($data['details'] as $d)
			{
				foreach($data['users'] as $u)
				{
					if($d->benefit_sender_id == $u->user_employeeID)
					{
						$data['username'] = $u->user_firstname . ' ' . $u->user_lastname;
					}
				}
			}

			$this->load->view('AdminV/benefits_to_approve_view_one',$data);
		}
		else
		{
			 //If no session, redirect to login page
			 redirect('login', 'refresh');
		}
}

function do_create_new_benefit()
{
	if($this->session->userdata('admin_logged_in'))
	{
		$title = $this->input->post('title');
		$description = $this->input->post('description');
		$value = $this->input->post('value');
		$approverid = $this->input->post('approver');
		$sbu = $this->input->post('department');

		$data = array('benefit_title'=>$title,
									'benefit_description'=>$description,
									'benefit_value'=>$value,
									'benefit_approver_id'=>$approverid,
									'benefits_sbu'=>$sbu);
		$this->Model_admin->insert_benefit($data);
		$lastid = $this->Model_admin->get_last_benefit_id();



				$data['users'] = $this->Model_admin->get_users();



				if($sbu == 'ALL')
				{
					foreach($data['users'] as $u)
					{
						$datavalue = array('values_value'=>$value,
																		'value_owner_id'=>$u->user_employeeID,
																		'value_type'=>$title);
						$this->Model_admin->insert_value($datavalue);
					}
				}
				else
				{
					foreach($data['users'] as $u)
					{
						if($sbu == $u->user_sbu)
						{
							$datavalue = array('values_value'=>$value,
																			'value_owner_id'=>$u->user_employeeID,
																			'value_type'=>$title);
							$this->Model_user->insert_value($datavalue);
						}
						else
						{}
					}
				}

		foreach($this->input->post('defined') as $defined)
		{
			$data1['benefit_field'] = $defined;
			$data1['tblBenefits_pk_fk'] = $lastid;

			$this->Model_admin->insert_benefit_fields($data1);
		}

		foreach($this->input->post('mytext') as $field)
		{
			if($field == "")
			{}
				else
				{

				$data1['benefit_field'] = $field;
				$data1['tblBenefits_pk_fk'] = $lastid;

				$this->Model_admin->insert_benefit_fields($data1);
				}
		}

		$data['users'] = $this->Model_admin->get_users();

		$now = time();
		$timeposted = unix_to_human($now);
		foreach($data['users'] as $usr)
		{
			$data = array('notif_receiver_id'=>$usr->user_employeeID,
							'notif_event_id_fk'=>4,
							'notif_timestamp'=>$timeposted,
							'notif_sender'=>0,
							'notif_link_id'=>$lastid);
			$this->Model_admin->insert_notif($data);
		}

		$this->session->set_flashdata('success', '<div class="alert alert-success text-center">Success!</div>');
		redirect(base_url().'admin/view_all_benefits');

	}
	else
		{
			 //If no session, redirect to login page
			 redirect('login', 'refresh');
		}
}

function view_quitclaim_reports_generation()
{
	if($this->session->userdata('admin_logged_in'))
	{
		$data['reports'] = $this->Model_admin->get_generated_reports();
		$this->load->view('AdminV/quitclaim_reports_generation',$data);
	}
	else
		{
			 //If no session, redirect to login page
			 redirect('login', 'refresh');
		}
}

function download_generated_report()
{
	$docuname = $this->uri->segment(3);
	$name = 'G:\xampp\htdocs\JFCHR\application\quitclaimreports\\'. $docuname;
	force_download($name, NULL);
}


	function load_quitclaim_workflow()
	{

		if($this->session->userdata('admin_logged_in'))
		{



			$data['error'] = '';    //initialize image upload error array to empty

	        $config['upload_path'] = './csv/';
	        $config['allowed_types'] = 'csv';
	        $config['max_size'] = '1000';

	        $this->load->library('upload', $config);
	        $this->upload->initialize($config);


	        // If upload failed, display error
	        if (!$this->upload->do_upload()) {
	            $data['error'] = $this->upload->display_errors();

	            $this->load->view('AdminV/load_quitclaim_workflow', $data);
	        } else {
	            $file_data = $this->upload->data();
	            $file_path =  './csv/'.$file_data['file_name'];

	            if ($this->csvimport->get_array($file_path)) {
	                $csv_array = $this->csvimport->get_array($file_path);
	                foreach ($csv_array as $row) {
	                    $insert_data = array(
	                        'quitclaim_approvers_position'=>$row['quitclaim_approvers_position'],
	                        'quitclaim_approvers_eid'=>$row['quitclaim_approvers_eid'],
	                    );
											$redirect = $row['quitclaim_approvers_eid'];
	                    $this->Model_admin->import_workflow($insert_data);
	                }
	                $this->session->set_flashdata('csv', '<div class="alert alert-success text-center">Workflow loaded!</div>');
	                redirect(base_url().'admin/edit_quitclaim_workflow/'.$redirect);
	            } else
	                $data['error'] = "Error occured";
					$this->load->view('AdminV/load_quitclaim_workflow',$data);
	            }

		}
		else
   		{
    		 //If no session, redirect to login page
  		   redirect('login', 'refresh');
  		}
	}

	function view_quitclaim_workflow_new()
	{
		if($this->session->userdata('admin_logged_in'))
		{
					$data['users'] = $this->Model_admin->get_quitclaim_with_workflow();
					$data['usernames'] = $this->Model_admin->get_users();
					$this->session->set_flashdata('noquitclaim', '<div class="alert alert-danger text-center">No Quitclaim active</div>');
					$this->load->view('AdminV/view_quitclaim_workflow_new', $data);
				}

		else
			{
				 //If no session, redirect to login page
				 redirect('login', 'refresh');
			}
	}


		function edit_quitclaim_workflow()
		{
			if($this->session->userdata('admin_logged_in'))
			{
				$id = $this->uri->segment(3);
						$data['quitclaim'] = $this->Model_admin->get_quitclaim_header();
						$data['quitclaimtitles'] = $this->Model_admin->get_quitclaim_approvers_table($id);
						$data['users'] = $this->Model_admin->get_titles();
						$data['usernames'] = $this->Model_admin->get_users_name_only();
						$data['employeeid'] = $id;



						$this->load->view('AdminV/edit_quitclaim_workflow_add_modal',$data);
						$this->load->view('AdminV/swap_hierarchy_modal_quitclaim',$data);
						$this->load->view('AdminV/delete_hierarchy_modal_quitclaim');
						$this->load->view('AdminV/update_hierarchy__quitclaim_view', $data);
						$this->load->view('AdminV/edit_quitclaim_workflow', $data);
					}

			else
		   	{
		    	 //If no session, redirect to login page
		  	   redirect('login', 'refresh');
		  	}
		}

		function edit_quitclaim_workflow_add_modal()
		{
			if($this->session->userdata('admin_logged_in'))
			{
					$approverid =	$this->input->post('approver');
					$employeeid = $this->input->post('employeeID');
					$data = array('quitclaim_approvers_position'=>$approverid,
												'quitclaim_approvers_eid'=>$employeeid);
					$this->Model_admin->edit_quitclaim_workflow_add_modal_model($data);
					$this->session->set_flashdata('swapped', '<div class="alert alert-success text-center">Approver added!.</div>');
					redirect(base_url()."Admin/edit_quitclaim_workflow/".$employeeid);
			}

			else
				{
					 //If no session, redirect to login page
					 redirect('login', 'refresh');
				}
		}

		function do_swap_hierarchy_quitclaim()
		{
			if($this->session->userdata('admin_logged_in'))
			{
				$employeeid = $this->input->post('employeeid');
					$currentapprover = $_POST['approverid'];
					$newapprover = $_POST['approver'];
					$data['approver1'] = $this->Model_admin->get_swap($currentapprover);

					foreach($data['approver1'] as $d)
					{
						$approver_id1 = $d->quitclaim_approvers_position;
					}

					$data['approver2'] = $this->Model_admin->get_swap($newapprover);
					foreach($data['approver2'] as $d)
					{
						$approver_id2 = $d->quitclaim_approvers_position;
					}


					$this->Model_admin->swap_hierarchy($currentapprover, $approver_id2);
					$this->Model_admin->swap_hierarchy($newapprover, $approver_id1);

					$this->session->set_flashdata('swapped', '<div class="alert alert-success text-center">Approver swapped!.</div>');
					redirect(base_url()."Admin/edit_quitclaim_workflow/".$employeeid);
			}

			else
				{
					 //If no session, redirect to login page
					 redirect('login', 'refresh');
				}
		}

		function delete_hierarchy_quitclaim()
		{
			if($this->session->userdata('admin_logged_in'))
			{
				$employeeid = $this->uri->segment(4);
					$postid = $this->uri->segment(3);
					$this->Model_admin->delete_from_hierarchy_quitclaim($postid);

					$this->session->set_flashdata('swapped', '<div class="alert alert-danger text-center">Approver deleted!.</div>');
					redirect(base_url()."Admin/edit_quitclaim_workflow/".$employeeid);
				}

			else
				{
					 //If no session, redirect to login page
					 redirect('login', 'refresh');
				}
		}


			function do_update_hierarchy_quitclaim()
			{
				if($this->session->userdata('admin_logged_in'))
				{
					$employeeid = $this->input->post('employeeid');
						$newapprover = $_POST['approver'];
						$currentapprover = $_POST['approverid'];
						$this->Model_admin->update_hierarchy_quitclaim($currentapprover,$newapprover);

						$this->session->set_flashdata('swapped', '<div class="alert alert-success text-center">Approver updated!.</div>');
						redirect(base_url()."Admin/edit_quitclaim_workflow/".$employeeid);
					}

				else
			   	{
			    	 //If no session, redirect to login page
			  	   redirect('login', 'refresh');
			  	}
			}

			function manage_sbus()
						{
							if($this->session->userdata('admin_logged_in'))
							{
								$data['sbu'] = $this->Model_admin->get_sbus_new();
								$this->load->view('AdminV/delete_sbu_modal');
								$this->load->view('AdminV/add_sbu_modal');
								$this->load->view('AdminV/update_sbu_modal');
								$this->load->view('AdminV/manage_sbus', $data);
							}
							else
					   		{
					    		 //If no session, redirect to login page
					  		   redirect('login', 'refresh');
					  		}
						}

			function do_add_new_sbu()
			{
				if($this->session->userdata('admin_logged_in'))
				{
					$newsbu = $this->input->post('newsbu');
					$data = array('sbu'=>$newsbu);
					$this->Model_admin->insert_sbu($data);
					$this->session->set_flashdata('workflow', '<div class="alert alert-success text-center">New SBU added!</div>');
					redirect(base_url().'Admin/manage_sbus');
				}
				else
					{
						 //If no session, redirect to login page
						 redirect('login', 'refresh');
					}
			}

			function do_update_sbu()
			{
				if($this->session->userdata('admin_logged_in'))
				{
					$sbuid = $this->input->post('updatingid');
					$newsbu = $this->input->post('newsbu');
					$data = array('sbu'=>$newsbu);
					$this->Model_admin->update_sbu($data,$sbuid);
					$this->session->set_flashdata('workflow', '<div class="alert alert-success text-center">SBU updated!.</div>');
					redirect(base_url().'Admin/manage_sbus');
				}
				else
					{
						 //If no session, redirect to login page
						 redirect('login', 'refresh');
					}
			}

			function delete_sbu()
			{
				if($this->session->userdata('admin_logged_in'))
				{
					$sbuid = $this->uri->segment(3);
					$this->Model_admin->delete_sbu($sbuid);
					$this->session->set_flashdata('workflow', '<div class="alert alert-danger text-center">SBU Deleted!</div>');
					redirect(base_url().'Admin/manage_sbus');
				}
				else
					{
						 //If no session, redirect to login page
						 redirect('login', 'refresh');
					}
			}


			function do_update_position()
			{
				if($this->session->userdata('admin_logged_in'))
				{
					$posid = $this->input->post('updatingid');
					$newpos = $this->input->post('newpos');
					$data = array('position'=>$newpos);
					$this->Model_admin->update_position($data,$posid);
						$this->session->set_flashdata('workflow', '<div class="alert alert-success text-center">Position Updated!</div>');
							redirect(base_url().'Admin/manage_positions');
				}
				else
					{
						 //If no session, redirect to login page
						 redirect('login', 'refresh');
					}
			}

			function do_add_new_position()
			{
				if($this->session->userdata('admin_logged_in'))
				{
					$newpos = $this->input->post('newpos');
					$data = array('position'=>$newpos);
					$this->Model_admin->insert_position($data);
						$this->session->set_flashdata('workflow', '<div class="alert alert-success text-center">New position added!</div>');
						redirect(base_url().'Admin/manage_positions');
				}
				else
					{
						 //If no session, redirect to login page
						 redirect('login', 'refresh');
					}
			}

			function delete_position()
			{
				if($this->session->userdata('admin_logged_in'))
				{
					$positionid = $this->uri->segment(3);
					$this->Model_admin->delete_position($positionid);
						$this->session->set_flashdata('workflow', '<div class="alert alert-danger text-center">Position deleted!</div>');
							redirect(base_url().'Admin/manage_positions');
				}
				else
					{
						 //If no session, redirect to login page
						 redirect('login', 'refresh');
					}
			}

			function manage_positions()
			{
				if($this->session->userdata('admin_logged_in'))
				{
					$data['position'] = $this->Model_admin->get_positions();
					$this->load->view('AdminV/delete_position_modal');
					$this->load->view('AdminV/add_position_modal');
					$this->load->view('AdminV/update_position_modal');
					$this->load->view('AdminV/manage_position', $data);
				}
				else
					{
						 //If no session, redirect to login page
						 redirect('login', 'refresh');
					}
			}


			function do_update_rank()
			{
				if($this->session->userdata('admin_logged_in'))
				{
					$posid = $this->input->post('updatingid');
					$newpos = $this->input->post('newpos');
					$data = array('rank'=>$newpos);
					$this->Model_admin->update_rank($data,$posid);
						$this->session->set_flashdata('workflow', '<div class="alert alert-success text-center">Rank Updated!</div>');
							redirect(base_url().'Admin/manage_ranks');
				}
				else
					{
						 //If no session, redirect to login page
						 redirect('login', 'refresh');
					}
			}

			function do_add_new_rank()
			{
				if($this->session->userdata('admin_logged_in'))
				{
					$newpos = $this->input->post('newrank');
					$data = array('rank'=>$newpos);
					$this->Model_admin->insert_rank($data);
						$this->session->set_flashdata('workflow', '<div class="alert alert-success text-center">New rank added!</div>');
						redirect(base_url().'Admin/manage_ranks');
				}
				else
					{
						 //If no session, redirect to login page
						 redirect('login', 'refresh');
					}
			}

			function delete_rank()
			{
				if($this->session->userdata('admin_logged_in'))
				{
					$positionid = $this->uri->segment(3);
					$this->Model_admin->delete_rank($positionid);
						$this->session->set_flashdata('workflow', '<div class="alert alert-danger text-center">Rank deleted!</div>');
							redirect(base_url().'Admin/manage_ranks');
				}
				else
					{
						 //If no session, redirect to login page
						 redirect('login', 'refresh');
					}
			}

			function manage_ranks()
			{
				if($this->session->userdata('admin_logged_in'))
				{
					$data['rank'] = $this->Model_admin->get_ranks_new();
					$this->load->view('AdminV/delete_rank_modal');
					$this->load->view('AdminV/add_rank_modal');
					$this->load->view('AdminV/update_rank_modal');
					$this->load->view('AdminV/manage_rank', $data);
				}
				else
					{
						 //If no session, redirect to login page
						 redirect('login', 'refresh');
					}
			}



	function logout()
	{
		session_destroy();
		redirect('login','refresh');
	}



	function contactMe()
	{
	$email = 'lorenzomagno2005@gmail.com'; //$_POST EMAILADD
	$subject= 'Hello';  //$_POST SUBJECT
	$msg = 'This is a sample message from CI';


	$this->email->set_newline("\r\n");
	$this->email->from('hahaha@gmail.com', 'Lorenzo Way!');
	$this->email->to($email);
	$this->email->cc('info@gmail.com');
	$this->email->subject($subject);
	$this->email->message($msg);

	if($this->email->send())
	{
		echo "sent";
	}
	else
	{
		echo "Email not sent";
	}

	}

}
