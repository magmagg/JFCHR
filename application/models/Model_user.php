<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class Model_user extends CI_Model
{
     /*
	function get_announcements()
     {
          $session_data = $this->session->userdata('logged_in');
          $data['userid'] = $session_data['employeeID'];
          $this ->db-> select('*');
          $this ->db-> from('tblAnnounce');
          $this->db-> join('tblAnnounceUserTransact', 'tblAnnounce.a_id=tblAnnounceUserTransact.a_id');
          $this->db-> where('visible_member_id', $data['userid']);
          $query = $this->db->get();
          return $query->result();
     }
     */

     function get_id_quitclaimer($id)
{
  $this->db->select('quitclaim_sender,quitclaim_senderid');
  $this->db->from('tblQuitClaim');
  $this->db->where('quitclaim_id',$id);
  $query = $this->db->get();
  return $query->result();
}

function get_quitclaim_final($id)
{
  $this->db->select('*');
  $this->db->from('tblQuitClaimDocuments');
  $this->db->where('quitclaim_owner_id',$id);
  $query = $this->db->get();
  return $query->result();
}

function get_tblQuitClaim_user($senderid)
{
  $this->db->select('*');
  $this->db->from('tblQuitClaim');
  $this->db->where('quitclaim_senderid',$senderid);
  $query = $this->db->get();

  return $query->result();
}

function get_quitclaim_happenings($id)
{
  $this->db->select('*');
  $this->db->from('tblQuitClaimA');
  $this->db->where('quitclaim_id_fk',$id);
  $query = $this->db->get();
  return $query->result();
}

function get_one_userdetails($id)
{
  $this ->db-> select('*');
  $this ->db-> from('tblUsers1');
  $this->db->where('user_employeeID',$id);
  $query = $this->db->get();
  return $query->result();
}


     function get_quitclaim_comments_for_generation($id)
     {
          $this->db->select('tblQuitClaimCM.*, tblUsers1.user_lastname');
          $this->db->from('tblQuitClaimCM');
          $this->db->join('tblUsers1','tblQuitClaimCm.qc_sender_id = tblUsers1.user_employeeID');
          $this->db->where('qc_user_quitclaim_id',$id);
          $this->db->order_by('qc_timestamp', 'ASC');
          $query = $this->db->get();
          return $query->result();
     }

     function change_email($email,$employeeID)
     {
          $data = array('user_email'=>$email);
          $this->db->where('user_employeeID',$employeeID);
          $this->db->update('tblUsers1',$data);
     }

     function insert_generated_scripts($data)
{
     $this->db->insert('tblQuitClaimScripts',$data);
}

     function get_one_user($id)
     {
       $this ->db-> select('user_password');
       $this ->db-> from('tblUsers1');
       $this->db->where('user_employeeID',$id);
       $query = $this->db->get();
       return $query->result();
     }

     function post_quitclaim_comment($data)
     {
       $this->db->insert('tblQuitClaimCM',$data);
     }

     function get_announcements()
     {
          $this ->db-> select('*');
          $this ->db-> from('tblAnnounce');
          $this->db->order_by('a_timeposted', 'DESC');
          $query = $this->db->get();
          return $query->result();
     }

     function get_one_announcement($id)
     {
          $this ->db-> select('*');
          $this ->db-> from('tblAnnounce');
          $this ->db-> where('a_id',$id);
          $query = $this->db->get();
          return $query->result();
     }


        function get_policies($company)
        {
             $this->db->select('tblPolicy.*, tblPolicyCateg.*');
             $this->db->from('tblPolicy');
             $this->db->join('tblPolicyCateg','tblPolicy.policy_category_fk = tblPolicyCateg.policy_category_id');
             $this->db->where('policy_category_company',$company);
             $query = $this->db->get();
             return $query->result();
        }

        function get_policy_category($company)
        {
             $this->db->select('*');
             $this->db->from('tblPolicyCateg');
             $this->db->where('policy_category_company',$company);
             $query = $this->db->get();
             return $query->result();
        }

        function get_policy_data($postid)
        {
             $this->db->select('*');
             $this->db->from('tblPolicy');
             $this->db->where('policy_category_fk', $postid);
             $query = $this->db->get();
             return $query->result();
        }

        function get_user_notifications($userid)
    {
         $this->db->select('tblNotifications.*,tblNotifEvent.*');
         $this->db->from('tblNotifications');
         $this->db->join('tblNotifEvent',"tblNotifications.notif_event_id_fk = tblNotifEvent.event_id");
         $this->db->where('notif_receiver_id',$userid);
         $this->db->order_by('notif_timestamp','DESC');
         $query = $this->db->get();
         return $query->result();
    }

     function get_policy($policyID)
     {
          $this->db->select('*');
          $this->db->from('tblPolicy');
          $this->db->where('policy_id', $policyID);
          $query = $this->db->get();
          return $query->result();
     }

     function get_messages()
     {
          $session_data = $this->session->userdata('logged_in');
          $data['receiver_id'] = $session_data['employeeID'];
          $this ->db-> select('tblMessages1.*,tblMessagesReceivers.*,tblMtransact.*');
          $this ->db-> from('tblMtransact');
          $this->db-> join('tblMessages1', 'tblMessages1.message_id = tblMtransact.messages1_fk');
          $this->db-> join('tblMessagesReceivers', 'tblMessagesReceivers.people_id = tblMtransact.receivers_fk');
          $this->db-> where('people_receiver_id', $data['receiver_id']);
          $query = $this->db->get();
          return $query->result_array();
     }


     function get_three_messages()
     {
          $session_data = $this->session->userdata('logged_in');
          $data['receiver_id'] = $session_data['employeeID'];
          $this ->db-> select('*');
          $this ->db-> from('tblMessages');
          $this->db-> join('tblMessageTransact', 'tblMessages.message_id = tblMessageTransact.message_id');
          $this->db-> where('receiver_id', $data['receiver_id']);
          $this->db->limit(3,0);
          $query = $this->db->get();
          return $query->result();
     }

     function get_sent_messages()
     {
       $session_data = $this->session->userdata('logged_in');
       $data['receiver_id'] = $session_data['employeeID'];
       $this ->db-> select('tblMessages1.*,tblMessagesReceivers.*,tblMtransact.*');
       $this ->db-> from('tblMtransact');
       $this->db-> join('tblMessages1', 'tblMessages1.message_id = tblMtransact.messages1_fk');
       $this->db-> join('tblMessagesReceivers', 'tblMessagesReceivers.people_id = tblMtransact.receivers_fk');
       $this->db-> where('people_sender_id', $data['receiver_id']);
       $query = $this->db->get();
       return $query->result_array();
     }

     function insert_message($data)
     {
          $this->db->insert('tblMessages1', $data);
     }

     function insert_sent_message($datasent)
     {
          $this->db->insert('tblMessagesSent', $datasent);
     }

     function insert_message_to_user($data)
     {
          $this->db->insert('tblMessagesReceivers', $data);
     }

     function insert_transaction($data)
     {
       $this->db->insert('tblMtransact',$data);
     }

     function get_last_message_id()
     {
          return $this->db->insert_id();
     }

     function get_users()
     {
          $query = $this->db->get('tblUsers1');
          return $query->result();
     }

     function get_documents($company)
     {

       $this->db->select('*');
       $this->db->from('tblDocuments');
       $this->db->where('document_company',$company);
       $query = $this->db->get();
       return $query->result();
     }


     function get_last_dcs_id()
     {
          return $this->db->insert_id();
     }

     function get_last_approver_id()
     {
          return $this->db->insert_id();
     }

     function insert_dcs_approvers($dataapprover)
     {
          $this->db->insert('tblDCSApprovers', $dataapprover);
     }

     function insert_dcs_transaction($transaction)
     {
          $this->db->insert('tblDCStransact', $transaction);
     }

   /*  function get_dcs()
     {
          $session_data = $this->session->userdata('logged_in');
          $usr['userid'] = $session_data['employeeID'];
          $this->db->select('tblDCS.*,tblDCStransact.*,tblUsers1.user_firstname,tblusers1.user_middlename,tblUsers1.user_lastname');
          $this->db->from('tblDCS');
          $this->db->join('tblDCStransact', 'tblDCS.dcs_id = tblDCStransact.dcs_id');
          $this->db->join('tblUsers1', 'tblDCStransact.dcs_approver_id = tblUsers1.user_employeeID');
          $this->db->where('dcs_senderid', $usr['userid']);
          $query = $this->db->get();
          return $query->result();
     }
     */

     function get_dcs_document_data($id)
     {
          $this->db->select('*');
          $this->db->from('tblDCS');
          $this->db->where('dcs_id',$id);
          $query = $this->db->get();
          return $query->result();
     }

     function get_one_dcs()
     {
          $session_data = $this->session->userdata('logged_in');
          $usr['userid'] = $session_data['employeeID'];
          $this->db->select('*');
          $this->db->from('tblDCS');
          $this->db->where('dcs_senderid', $usr['userid']);
          $query = $this->db->get();
          return $query->result();
     }

     function get_dcs_progress($dcs_id)
     {
          $session_data = $this->session->userdata('logged_in');
          $employeeID = $session_data['employeeID'];
          $this->db->select('tblDCS.*,tblDCSApprovers.*,tblDCStransact.*,tblUsers1.user_lastname,tblusers1.user_positiontitle');
          $this->db->from('tblDCStransact');
          $this->db->join('tblDCS', 'tblDCS.dcs_id = tblDCStransact.dcs_id');
          $this->db->join('tblDCSApprovers', 'tblDCSApprovers.dcsapprovers_id = tblDCStransact.dcsapprovers_id');
          $this->db->join('tblUsers1', 'tblDCSApprovers.dcs_approver_id = tblUsers1.user_employeeID');
          $this->db->where('tblDCS.dcs_id', $dcs_id);
          $this->db->order_by('dcs_hierarchy', 'ASC');
          $query = $this->db->get();
          return $query->result();
     }

     function get_swap($data)
     {
          $this->db->select('*');
          $this->db->from('tblDCSApprovers');
          $this->db->where('dcsapprovers_id',$data);
          $query = $this->db->get();
          return $query->result();
     }

     function swap_hierarchy($dcsapprovers_id, $dcs_approver_id)
     {
          $data = array('dcs_approver_id'=>$dcs_approver_id);
          $this->db->where('dcsapprovers_id',$dcsapprovers_id);
          $this->db->update('tblDCSApprovers',$data);
     }


     function get_minimum_approver()
     {
          $session_data = $this->session->userdata('logged_in');
          $employeeID = $session_data['employeeID'];
          $this->db->select('MIN(dcs_approver_id) AS dcs_approver_id,dcs_hierarchy');
          $this->db->from('tblDCSApprovers');
          $this->db->where('dcs_isapproved', 0);
          $this->db->group_by('dcs_hierarchy');
          $query = $this->db->get();

          if ($query->num_rows() > 0)
          {
           $row = $query->first_row('array');
           $lowestid = $row['dcs_approver_id'];
          }

          if($lowestid == $employeeID)
          {
               return $query->result();
          }
          else
          {
               return false;
          }
     }

     function get_all_dcs_where_user_is()
     {
          $session_data = $this->session->userdata('logged_in');
          $usr['userid'] = $session_data['employeeID'];
          $this->db->select('tblDCS.*,tblDCSApprovers.*,tblDCStransact.*,tblUsers1.user_lastname');
          $this->db->from('tblDCStransact');
          $this->db->join('tblDCS', 'tblDCS.dcs_id = tblDCStransact.dcs_id');
          $this->db->join('tblDCSApprovers', 'tblDCSApprovers.dcsapprovers_id = tblDCStransact.dcsapprovers_id');
          $this->db->join('tblUsers1', 'tblDCSApprovers.dcs_approver_id = tblUsers1.user_employeeID');
          $this->db->where('dcs_approver_id', $usr['userid']);
          $query = $this->db->get();
          return $query->result();
     }

     function get_dcs_approve_by_user($approverid)
     {
          $this->db->select('tblDCS.*,tblDCSApprovers.*,tblDCStransact.*,tblUsers1.user_lastname');
          $this->db->from('tblDCStransact');
          $this->db->join('tblDCS', 'tblDCS.dcs_id = tblDCStransact.dcs_id');
          $this->db->join('tblDCSApprovers', 'tblDCSApprovers.dcsapprovers_id = tblDCStransact.dcsapprovers_id');
          $this->db->join('tblUsers1', 'tblDCSApprovers.dcs_approver_id = tblUsers1.user_employeeID');
          $this->db->where('dcs_approver_id', $approverid );
          $query = $this->db->get();
          return $query->result();
     }

     function accept_dcs($postid,$comment,$timeposted)
     {
          $session_data = $this->session->userdata('logged_in');
          $data['userid'] = $session_data['employeeID'];
          $datas = array('dcs_isapproved'=>1,
                         'dcs_comment'=>$comment,
                         'dcs_timeapproved'=>$timeposted);
          $this->db->where('dcs_approver_id',$data['userid']);
          $this->db->where('dcs_id',$postid);
          $this->db->update('tblDCSApprovers',$datas);
     }

      function accept_dcs_no_comment($postid, $timeposted)
     {
          $session_data = $this->session->userdata('logged_in');
          $data['userid'] = $session_data['employeeID'];
          $datas = array('dcs_isapproved'=>1,
                         'dcs_timeapproved'=>$timeposted);
          $this->db->where('dcs_approver_id',$data['userid']);
          $this->db->where('dcs_id',$postid);
          $this->db->update('tblDCSApprovers',$datas);
     }



     function get_rejector_dcs($postid,$comment,$timeposted)
     {
          $session_data = $this->session->userdata('logged_in');
          $data['userid'] = $session_data['employeeID'];
          $datas = array('dcs_isapproved'=>2,
                         'dcs_comment'=>$comment,
                         'dcs_isrejected'=>1,
                         'dcs_timeapproved'=>$timeposted);
          $this->db->where('dcs_id',$postid);
          $this->db->where('dcs_approver_id',$data['userid']);
          $this->db->update('tblDCSApprovers',$datas);
     }

     function update_reverse_hierarchy($hierarchy, $last_dcs_id,$postnumber)
     {
          $data = array('dcs_reversehierarchy'=>$hierarchy);

          $this->db->where('dcs_id', $last_dcs_id);
          $this->db->where('dcsapprovers_id', $postnumber);
          $this->db->update('tblDCSApprovers', $data);
     }

     function update_hierarchy($currentapprover,$newapprover, $dcsid)
     {
          $data = array('dcs_approver_id'=>$newapprover);
         $this->db->where('dcs_approver_id', $currentapprover);
         $this->db->where('dcs_id', $dcsid);
         $this->db->update('tblDCSApprovers',$data);
     }

     function delete_from_hierarchy($postid, $dcsid)
     {
          $this->db->where('dcs_id', $dcsid);
          $this->db->delete('tblDCSApprovers',(array('dcs_approver_id' => $postid)));
     }

     function update_dcs_hierarchy_column($dcsapprovers_id, $minrows)
     {
          $this->db->where('dcsapprovers_id', $dcsapprovers_id);
          $this->db->update('tblDCSApprovers', (array('dcs_hierarchy'=>$minrows)));
     }

     function update_dcs_revhierarchy_column($dcsapprovers_id, $maxrows)
     {
          $this->db->where('dcsapprovers_id', $dcsapprovers_id);
          $this->db->update('tblDCSApprovers', (array('dcs_reversehierarchy'=>$maxrows)));
     }

     function get_remaining_hierarchy($dcsid)
     {
          $this->db->select('*');
          $this->db->from('tblDCSApprovers');
          $this->db->where('dcs_id', $dcsid);
          $query = $this->db->get();
          return $query->result();
     }

     function get_max_hierarchy($id)
{
     $this->db->select("MAX(quitclaim_hierarchy) AS hierarchy");
     $this->db->from('tblQuitCLaimA');
     $this->db->where('quitclaim_id_fk', $id);
     $query = $this->db->get();
     return $query->result();
}

function check_if_last_approver($dcsid, $maxhierarchy)
{
     $session_data = $this->session->userdata('logged_in');
     $userid = $session_data['employeeID'];
     $this->db->select('*');
     $this->db->from('tblQuitClaimA');
     $this->db->where('quitclaim_approvers_emp_id', $userid);
     $this->db->where('quitclaim_hierarchy', $maxhierarchy);
     $this->db->where('quitclaim_id_fk', $dcsid);
     $query = $this->db->get();
     return $query->result();
}

function tag_approved($quitclaimid)
{
  $datas = array('quitclaim_reversehierarchy'=>0);
  $this->db->where('quitclaim_approvers_table_id',$quitclaimid);
  $this->db->update('tblQuitClaimA',$datas);
}

function get_hierarchy($id)
{
  $this->db->select('quitclaim_hierarchy,quitclaim_id_fk,quitclaim_all_approving');
  $this->db->from('tblQuitClaimA');
  $this->db->where('quitclaim_approvers_table_id', $id);
  $query = $this->db->get();
  return $query->result();
}


     function get_signatures($id)
     {
       $this->db->select('*');
       $this->db->from('tblQuitClaimSign');
       $this->db->where('signature_quitclaim_pk_fk',$id);
       $query = $this->db->get();
       return $query->result();
     }

     function update_quitclaim_document($data,$id)
{
  $this->db->where('quitclaim_document_id',$id);
  $this->db->update('tblQuitClaimDocuments',$data);
}


     function get_quitclaim_document($id)
     {
       $this->db->select('*');
       $this->db->from('tblQuitClaimDocuments');
       $this->db->where('quitclaim_pk_fk',$id);
       $query = $this->db->get();
       return $query->result();
     }

     function insert_done_employee($data)
     {
       $this->db->insert('tblDoneUsers',$data);
     }


     function tag_next_approver($quitclaimid)
     {
       $datas = array('quitclaim_reversehierarchy'=>1);
       $this->db->where('quitclaim_approvers_table_id',$quitclaimid);
       $this->db->update('tblQuitClaimA',$datas);
     }

     function tag_all_approvers($id)
     {
       $datas = array('quitclaim_reversehierarchy'=>1,
                      'quitclaim_all_approving'=>1);
       $this->db->where('quitclaim_id_fk',$id);
       $this->db->update('tblQuitClaimA',$datas);
     }

     function remove_tag($id)
     {
       $datas = array('quitclaim_reversehierarchy'=>0);
       $this->db->where('quitclaim_id_fk',$id);
       $this->db->where('quitclaim_hierarchy',1);
       $this->db->update('tblQuitClaimA',$datas);
     }

     function remove_tag_two($id)
     {
       $datas = array('quitclaim_reversehierarchy'=>0);
       $this->db->where('quitclaim_id_fk',$id);
       $this->db->where('quitclaim_hierarchy',2);
       $this->db->update('tblQuitClaimA',$datas);
     }


     function insert_dcs_approved_document($data)
     {
          $this->db->insert('tblDCSDocuments', $data);
     }

     function get_quitclaim_active()
     {
          $session_data = $this->session->userdata('logged_in');
          $data['userid'] = $session_data['employeeID'];
          $this->db->select('user_isquitclaim');
          $this->db->from('tblUsers1');
          $this->db->where('user_employeeID', $data['userid']);
          $query = $this->db->get();
          return $query->result();
     }

     function quitclaim_activate($employeeID)
     {
          $data = array('user_isquitclaim'=>1);
          $this->db->where('user_employeeID',$employeeID);
          $this->db->update('tblUsers1',$data);
     }

     function insert_quitclaim($data)
     {
          $this->db->insert('tblQuitClaim', $data);
     }

     function get_quitclaim_approvers($data)
     {
          $this->db->select('*');
          $this->db->from('tblQuitClaimApprovers');
          $this->db->where('quitclaim_approvers_eid',$data);
          $query = $this->db->get();

          return $query->result();
     }


     function accept_quitclaim($postid,$timeposted)
     {
          $session_data = $this->session->userdata('logged_in');
          $data['userid'] = $session_data['employeeID'];
          $datas = array('quitclaim_isapproved'=>1,
                         'quitclaim_timeapproved'=>$timeposted);
          $this->db->where('quitclaim_approvers_emp_id',$data['userid']);
          $this->db->where('quitclaim_id_fk',$postid);
          $this->db->update('tblQuitClaimA',$datas);
     }


     function get_rejector_quitclaim($postid,$timeposted)
     {
          $session_data = $this->session->userdata('logged_in');
          $data['userid'] = $session_data['employeeID'];
          $datas = array('quitclaim_isapproved'=>2,
                         'quitclaim_isrejected'=>1,
                         'quitclaim_timeapproved'=>$timeposted);
          $this->db->where('quitclaim_id_fk',$postid);
          $this->db->where('quitclaim_approvers_emp_id',$data['userid']);
          $this->db->update('tblQuitClaimA',$datas);
     }

     function get_approver_id($position, $SBU)
     {
          $this ->db-> select('user_employeeID');
          $this ->db-> from('tblUsers1');
          $this->db->where('user_sbu',$SBU);
          $this->db->where('user_positiontitle', $position);
          $query = $this->db->get();

          return $query->result();
     }

     function insert_quitclaim_approvers($dataapprover)
     {
          $this->db->insert('tblQuitClaimA', $dataapprover);
     }

     function get_last_quitclaim_id()
     {
          return $this->db->insert_id();
     }

     function get_last_quitclaim_approver_id()
     {
          return $this->db->insert_id();
     }

     function insert_quitclaim_transaction($transaction)
     {
          $this->db->insert('tblQuitClaimTR', $transaction);
     }

     function update_reverse_hierarchy_quitclaim($hierarchy, $last_quitclaim_id,$postnumber)
     {
          $data = array('quitclaim_reversehierarchy'=>$hierarchy);

          $this->db->where('quitclaim_id_fk', $last_quitclaim_id);
          $this->db->where('quitclaim_approvers_table_id', $postnumber);
          $this->db->update('tblQuitClaimA', $data);
     }

     function get_quitclaim_progress()
     {
          $session_data = $this->session->userdata('logged_in');
          $employeeID = $session_data['employeeID'];
          $this->db->select('tblQuitClaim.*,tblQuitClaimA.*,tblQuitClaimTR.*,tblUsers1.user_lastname,tblusers1.user_positiontitle');
          $this->db->from('tblQuitClaimTR');
          $this->db->join('tblQuitClaim', 'tblQuitClaim.quitclaim_id = tblQuitClaimTR.quitclaim_id');
          $this->db->join('tblQuitClaimA', 'tblQuitClaimA.quitclaim_approvers_table_id = tblQuitClaimTR.quitclaim_approvers_table_id');
          $this->db->join('tblUsers1', 'tblQuitClaimA.quitclaim_approvers_emp_id = tblUsers1.user_employeeID');
          $this->db->where('tblQuitClaim.quitclaim_senderid', $employeeID);
          $this->db->order_by('quitclaim_hierarchy', 'ASC');
          $query = $this->db->get();
          return $query->result();
     }

     function get_quitclaim_progress_for_approval($quitclaim_id)
     {
          $this->db->select('tblQuitClaim.*,tblQuitClaimA.*,tblQuitClaimTR.*,tblUsers1.*,tblQuitClaimDocuments.*');
          $this->db->from('tblQuitClaimTR');
          $this->db->join('tblQuitClaim', 'tblQuitClaim.quitclaim_id = tblQuitClaimTR.quitclaim_id');
          $this->db->join('tblQuitClaimA', 'tblQuitClaimA.quitclaim_approvers_table_id = tblQuitClaimTR.quitclaim_approvers_table_id');
          $this->db->join('tblUsers1', 'tblQuitClaimA.quitclaim_approvers_emp_id = tblUsers1.user_employeeID');
          $this->db->join('tblQuitClaimDocuments', 'tblQuitClaimDocuments.quitclaim_pk_fk = tblQuitClaimTR.quitclaim_id');
          $this->db->where('tblQuitClaim.quitclaim_id', $quitclaim_id);
          $this->db->order_by('quitclaim_hierarchy', 'ASC');
          $query = $this->db->get();
          return $query->result();
     }


     function get_all_quitclaim_where_user_is()
     {
          $session_data = $this->session->userdata('logged_in');
          $employeeID = $session_data['employeeID'];
          $this->db->select('tblQuitClaim.*,tblQuitClaimA.*,tblQuitClaimTR.*,tblUsers1.user_lastname');
          $this->db->from('tblQuitClaimTR');
          $this->db->join('tblQuitClaim', 'tblQuitClaim.quitclaim_id = tblQuitClaimTR.quitclaim_id');
          $this->db->join('tblQuitClaimA', 'tblQuitClaimA.quitclaim_approvers_table_id = tblQuitClaimTR.quitclaim_approvers_table_id');
          $this->db->join('tblUsers1', 'tblQuitClaimA.quitclaim_approvers_emp_id = tblUsers1.user_employeeID');
          $this->db->where('tblQuitClaimA.quitclaim_approvers_emp_id', $employeeID);
          $this->db->order_by('quitclaim_hierarchy', 'ASC');
          $query = $this->db->get();
          return $query->result();
     }

     function get_hotlines()
{
     $this->db->select('*');
     $this->db->from('tblHotlines');
     $query = $this->db->get();
     return $query->result();
}

function get_if_included_approver($id)
{
  $this->db->select('*');
  $this->db->from('tblQuitClaimA');
  $this->db->where('quitclaim_approvers_emp_id',$id);
  $query = $this->db->get();

  return $query->result();
}

function insert_quitclaim_document($data)
{
  $this->db->insert('tblQuitClaimDocuments',$data);
}

function get_quitclaim_comments($id)
{
     $this->db->select('*');
     $this->db->from('tblQuitClaimCM');
     $this->db->where('qc_user_quitclaim_id', $id);
     $query = $this->db->get();
     return $query->result();
}

function get_generated_scripts($id)
{
      $this->db->select('*');
     $this->db->from('tblQuitClaimScripts');
     $this->db->where('scripts_employeeID',$id);
     $this->db->order_by('scripts_timestamp', 'DESC');
     $query = $this->db->get();
     return $query->result();
}

function insert_signature($data)
{
  $this->db->insert('tblQuitClaimSign',$data);
}

function get_benefit($rank,$sbu)
{
  $this->db->select('*');
  $this->db->from('tblBenefitsDocu');
  $this->db->where('benefit_rank', $rank);
  $this->db->where('benefit_sbu', $sbu);
  $query = $this->db->get();
  return $query->result();
}

function get_if_with_ishr($id)
{
  $this->db->select('quitclaim_hierarchy');
  $this->db->from('tblQuitClaimA');
  $this->db->where('quitclaim_id_fk', $id);
  $query = $this->db->get();
  return $query->result();
}

function get_titles()
{
     $this->db->select('user_firstname,user_lastname,user_employeeID,user_positiontitle');
     $this->db->distinct();
     $this->db->from('tblUsers1');
     $query = $this->db->get();
     return $query->result();
}

function insert_approver($data)
{
  $this->db->insert('tblQuitClaimA',$data);
}


     function get_last_id()
     {
          return $this->db->insert_id();
     }

function insert_transaction_qc($data)
{
  $this->db->insert('tblQuitClaimTR',$data);
}




     /* JOIN TBLDCS AND TBLDCS TRANSACT WITH APPROVER NAMES
     select tblDCS.*,tblDCStransact.*,tblUsers1.user_firstname,tblUsers1.user_middlename,tblUsers1.user_lastname from tblDCS join tblDCStransact ON tblDCS.dcs_id = tblDCStransact.dcs_id join tblUsers1 on tblDCStransact.dcs_approver_id = tblUsers1.user_employeeID;
     */

}
