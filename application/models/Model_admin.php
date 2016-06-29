<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class Model_admin extends CI_Model
{
public function get_users()
{
     $query = $this->db->get('tblUsers1');
     return $query->result();
}

function get_quitclaim()
{
  $query = $this->db->get('tblQuitClaim');
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

function update_category($id,$newcategory)
{
  $data = array('policy_category'=>$newcategory);
  $this->db->where('policy_category_id', $id);
  $this->db->update('tblPolicyCateg',$data);
}


function delete_category($id)
{
      $this->db->delete('tblPolicyCateg', (array('policy_category_id' => $id)));
}

function delete_subcategs($id)
{
        $this->db->delete('tblPolicy', (array('policy_category_fk' => $id)));
}

function get_fullname($id)
{
  $this->db->select('user_firstname,user_middlename,user_lastname');
  $this->db->from('tblUsers1');
  $this->db->where('user_employeeID',$id);
  $query = $this->db->get();

  return $query->result();
}


function get_generated_reports($id)
{
  $this->db->select('*');
  $this->db->from('tblQuitClaimReports');
  $this->db->order_by('report_qc_timestamp','DESC');
  $this->db->where('report_qc_eid',$id);
  $query = $this->db->get();
  return $query->result();
}

function get_quitclaim_active()
{
     $this->db->select('*');
     $this->db->from('tblUsers1');
     $this->db->where('user_isquitclaim', 1);
     $query = $this->db->get();
     return $query->result();
}

function get_quitclaim_with_workflow()
{
  $this->db->select('quitclaim_approvers_eid');
  $this->db->from('tblQuitClaimApprovers');
  $this->db->distinct();
  $query = $this->db->get();
  return $query->result();
}

function update_hierarchy_quitclaim_one_user($oldapprover,$approver,$dcsID)
{
  $data = array('quitclaim_approvers_emp_id'=>$approver);
  $this->db->where('quitclaim_approvers_emp_id', $oldapprover);
  $this->db->where('quitclaim_id_fk', $dcsID);
  $this->db->update('tblQuitClaimA',$data);
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

function get_quitclaim_id($id)
{
  $this->db->select('quitclaim_id');
  $this->db->from('tblQuitClaim');
  $this->db->where('quitclaim_senderid',$id);
  $query = $this->db->get();
  return $query->result();
}

function delete_from_tblQuitClaimReports($eid)
{
    $this->db->delete('tblQuitClaimReports', (array('report_qc_eid' => $eid)));
}

function delete_from_tblQuitClaim($tblQuitClaimPK)
{
  $this->db->delete('tblQuitClaim', (array('quitclaim_id' => $tblQuitClaimPK)));
}

function delete_from_tblQuitClaimA($tblQuitClaimPK)
{
  $this->db->delete('tblQuitClaimA', (array('quitclaim_id_fk' => $tblQuitClaimPK)));
}
function delete_from_tblQuitClaimCM($tblQuitClaimPK)
{
  $this->db->delete('tblQuitClaimCM', (array('qc_user_quitclaim_id' => $tblQuitClaimPK)));
}
function delete_from_tblQuitClaimDocuments($tblQuitClaimPK)
{
  $this->db->delete('tblQuitClaimDocuments', (array('quitclaim_pk_fk' => $tblQuitClaimPK)));
}
function delete_from_tblQuitClaimSign($tblQuitClaimPK)
{
  $this->db->delete('tblQuitClaimSign', (array('signature_quitclaim_pk_fk' => $tblQuitClaimPK)));
}
function delete_from_tblQuitClaimTR($tblQuitClaimPK)
{
  $this->db->delete('tblQuitClaimTR', (array('quitclaim_id' => $tblQuitClaimPK)));
}
function delete_from_tblQuitClaimScripts($tblQuitClaimPK)
{
  $this->db->delete('tblQuitClaimScripts', (array('scripts_quitclaim_id' => $tblQuitClaimPK)));
}
function set_no_quitclaim($senderid)
{
  $data = array('user_isquitclaim'=>NULL);
  $this->db->where('user_employeeID', $senderid);
  $this->db->update('tblUsers1',$data);
}

function insert_quitclaim_report($data)
{
  $this->db->insert('tblQuitClaimReports',$data);
}

function insert_new_quitclaim_approvers($data)
{
    $this->db->insert('tblQuitClaimApprovers',$data);
}

function get_quitclaim_approvers($data)
{
     $this->db->select('*');
     $this->db->from('tblQuitClaimApprovers');
     $this->db->where('quitclaim_approvers_eid',$data);
     $query = $this->db->get();

     return $query->result();
}



function get_requesting_benefits()
{
  $this->db->select('tblBenefits.*,tblBenefitsSubmission.*');
  $this->db->from('tblBenefits');
 // $this->db->join('tblBenefitsFields','tblBenefits.benefit_id = tblBenefitsFields.tblBenefits_pk_fk');
  $this->db->join('tblBenefitsSubmission','tblBenefits.benefit_id = tblBenefitsSubmission.tblBenefits_pk_fk');
  $this->db->where('benefit_approver_id','1');
  $query = $this->db->get();
  return $query->result();
}

function get_benefits_submission_details($id)
{
  $this->db->select('*');
  $this->db->from('tblBenefitsSubmission');
  $this->db->where('benefit_submission_id',$id);
  $query = $this->db->get();
  return $query->result();
}

function insert_notif($data)
{
  $this->db->insert('tblNotifications',$data);
}

function get_insert_id()
{
  return $this->db->insert_id();
}



function get_done_users()
{
  $query = $this->db->get('tblDoneUsers');
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

public function get_users_who_is_quitclaim()
{
     $this->db->select('tblusers1.*,tblQuitClaim.*');
     $this->db->from('tblUsers1');
     $this->db->join('tblQuitClaim','tblUsers1.user_employeeID = tblQuitClaim.quitclaim_senderid');
     $this->db->where('user_isquitclaim','1');
     $query = $this->db->get();
     return $query->result();
}

function get_duplicate_user($usr)
{
     $this ->db-> select('*');
     $this ->db-> from('tblUsers1');
     $this->db->where('user_username', $usr);
     $query = $this->db->get();
     return $query->result();
}

function get_duplicate_email($email)
{
     $this ->db->select('*');
     $this ->db->from('tblUsers1');
     $this->db->where('user_email', $email);
     $query = $this->db->get();
     return $query->result();
}

function activate_user($postid)
{
     $data = array('user_active'=>1);
     $this->db->where('user_employeeID', $postid);
     $this->db->update('tblUsers1',$data);
}

function deactivate_user($postid)
{
     $data = array('user_active'=>0);
     $this->db->where('user_employeeID', $postid);
     $this->db->update('tblUsers1',$data);
}

function get_sbus_new()
{
  $this->db->select('*');
  $this->db->from('tblSBU');
  $query = $this->db->get();
  return $query->result();
}


     function get_positions()
{
  $this->db->select('*');
   $this->db->from('tblPosition');
   $query = $this->db->get();
   return $query->result();
}

function get_ranks_new()
{
  $this->db->select('*');
   $this->db->from('tblRank');
   $query = $this->db->get();
   return $query->result();
}

function get_one_user($postid)
{
     $this->db->select('*');
     $this->db->from('tblUsers1');
     $this->db->where('user_employeeID', $postid);
     $query = $this->db->get();
     return $query->result();
}

function update_one_user($data, $id)
{
     $this->db->where('user_employeeID', $id);
     $this->db->update('tblUsers1', $data);
}

public function add_users($user)
{
     $this->db->insert('tblUsers1',$user);
}

function get_policies()
{
     $this->db->select('*');
     $this->db->from('tblPolicy');
     $query = $this->db->get();
     return $query->result();
}

function get_policy_data($postid)
{
     $this->db->select('*');
     $this->db->from('tblPolicy');
     $this->db->where('policy_id', $postid);
     $query = $this->db->get();
     return $query->result();
}

function get_policy_datas($postid)
{
     $this->db->select('*');
     $this->db->from('tblPolicy');
     $this->db->where('policy_category_fk', $postid);
     $query = $this->db->get();
     return $query->result();
}

function update_policy_data($data, $policyID)
{
     $this->db->where('policy_id', $policyID);
     $this->db->update('tblPolicy',$data);
}

function get_announcements()
{
     $this->db->select('*');
     $this->db->from('tblAnnounce');
     $query = $this->db->get();
     return $query->result();
}

function get_one_announcement($postid)
{
     $this->db->select('*');
     $this->db->from('tblAnnounce');
     $this->db->where('a_id', $postid);
     $query = $this->db->get();
     return $query->result();
}


function update_announcement_data($data, $postid)
{
     $this->db->where('a_id', $postid);
     $this->db->update('tblAnnounce', $data);
}

function insert_announcement($data)
{
    $this->db->insert('tblAnnounce', $data);
}

function insert_announcement_transact($datavisible)
{
    $this->db->insert('tblAnnounceUserTransact', $datavisible);
}

function delete_announcement_model($postid)
{
     $this->db->delete('tblAnnounce', (array('a_id' => $postid)));
}

function get_last_announcement_id()
{
     return $this->db->insert_id();
}

function insert_document($data)
{
     $this->db->insert('tblDocuments', $data);
}

function get_documents()
{
     $query = $this->db->get('tblDocuments');
     return $query->result();
}

function get_one_document($postID)
{
     $this->db->select('*');
     $this->db->from('tblDocuments');
     $this->db->where('document_id', $postID);
     $query = $this->db->get();
     return $query->result();
}

function deactivate_document($postid)
{
     $data = array('document_active'=>0);
     $this->db->where('document_id', $postid);
     $this->db->update('tblDocuments',$data);
}

function activate_document($postid)
{
     $data = array('document_active'=>1);
     $this->db->where('document_id', $postid);
     $this->db->update('tblDocuments',$data);
}

function get_one_policy($policyID)
{
     $this->db->select('*');
     $this->db->from('tblPolicy');
     $this->db->where('policy_id', $policyID);
     $query = $this->db->get();
     return $query->result();
}

 function insert_new_policy($data)
{
     $this->db->insert('tblPolicy', $data);
}

function insert_new_category($data)
{
     $this->db->insert('tblPolicyCateg', $data);
}

function delete_policy($postid)
{
     $this->db->delete('tblPolicy',(array('policy_id' => $postid)));
}

function delete_document_posted($postid)
{
     $this->db->delete('tblDocuments',(array('document_id' => $postid)));
}

function document_archive($postid)
{
     $data = array('document_isarchived'=>1,
                   'document_active'=>0);
     $this->db->where('document_id', $postid);
     $this->db->update('tblDocuments',$data);
}

function get_policy_categories()
{
     $this->db->select('*');
     $this->db->from('tblPolicyCateg');
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

function insert_hotline($data)
{
     $this->db->insert('tblHotlines',$data);
}

function update_hotline($data,$id)
{
     $this->db->where('hotline_id',$id);
     $this->db->update('tblHotlines',$data);
}

function delete_hotline($id)
{
    $this->db->delete('tblHotlines', (array('hotline_id' => $id)));
}

function get_quitclaim_header()
{
     $this->db->select('*');
     $this->db->from('tblQuitClaimTitle');
     $query = $this->db->get();
     return $query->result();
}

function get_quitclaim_titles()
{
     $this->db->select('*');
     $this->db->from('tblQuitClaimApprovers');
     $query = $this->db->get();
     return $query->result();
}

function get_quitclaim_approvers_table($id)
{
     $this->db->select('*');
     $this->db->from('tblQuitClaimApprovers');
     $this->db->where('quitclaim_approvers_eid',$id);
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

function get_departments_titles()
{
  $this->db->select('user_sbu,user_positiontitle');
  $this->db->from('tblUsers1');
  $query = $this->db->get();
  return $query->result();
}

function get_sbus()
{
  $this->db->select('user_sbu');
  $this->db->from('tblUsers1');
  $this->db->distinct();
  $query = $this->db->get();
  return $query->result();
}

function insert_value($data)
{
  $this->db->insert('tblValues',$data);
}

function update_value_accept($finalvalue,$senderid,$title)
{
  $data = array('values_value'=>$finalvalue);
  $this->db->where('value_owner_id',$senderid);
  $this->db->where('value_type',$title);
  $this->db->update('tblValues',$data);
}

function get_value_of_benefit($title,$senderid)
{
  $this->db->select('*');
  $this->db->from('tblValues');
  $this->db->where('value_type',$title);
  $this->db->where('value_owner_id',$senderid);
  $query = $this->db->get();
  return $query->result();
}

function get_benefits_defined()
{
  $this->db->select('*');
  $this->db->from('tblBenefitsDefined');
  $query = $this->db->get();
  return $query->result();
}

function update_hierarchy_quitclaim($currentapprover,$newapprover)
{
     $data = array('quitclaim_approvers_position'=>$newapprover);
    $this->db->where('quitclaim_approvers_id', $currentapprover);
    $this->db->update('tblQuitClaimApprovers',$data);
}

function delete_from_hierarchy_quitclaim($postid)
{
     $this->db->delete('tblQuitClaimApprovers', (array('quitclaim_approvers_id' => $postid)));
}

function get_swap($data)
{
     $this->db->select('*');
     $this->db->from('tblQuitClaimApprovers');
     $this->db->where('quitclaim_approvers_id',$data);
     $query = $this->db->get();
     return $query->result();
}

function swap_hierarchy($quitclaim_approvers_id, $quitclaim_approvers_position)
{
     $data = array('quitclaim_approvers_position'=>$quitclaim_approvers_position);
     $this->db->where('quitclaim_approvers_id',$quitclaim_approvers_id);
     $this->db->update('tblQuitClaimApprovers',$data);
}

function add_new_approver_quitclaim($data)
{
     $this->db->insert('tblQuitClaimApprovers',$data);
}

function edit_quitclaim_workflow_add_modal_model($data)
{
       $this->db->insert('tblQuitClaimApprovers',$data);
}

function importUser($data)
{
     $this->db->insert('tblUsers1',$data);
}

function import_workflow($data)
{
  $this->db->insert('tblQuitClaimApprovers',$data);
}

function get_quitclaim_comments_for_generation($id)
{
     $this->db->select('tblQuitClaimCM.*, tblUsers1.user_lastname ');
     $this->db->from('tblQuitClaimCM');
     $this->db->join('tblUsers1','tblQuitClaimCm.qc_sender_id = tblUsers1.user_employeeID');
     $this->db->where('qc_user_quitclaim_id',$id);
     $this->db->order_by('qc_timestamp', 'ASC');
     $query = $this->db->get();
     return $query->result();
}

function get_one_user_value($id)
{
     $this->db->select('*');
     $this->db->from('tblValues');
     $this->db->where('value_owner_id',$id);
     $query = $this->db->get();
     return $query->result();
}

function update_value($data,$id)
{
     $this->db->where('values_id',$id);
     $this->db->update('tblValues',$data);
}

function get_quitclaim_comments($id)
{
     $this->db->select('*');
     $this->db->from('tblQuitClaimCM');
     $this->db->where('qc_user_quitclaim_id', $id);
     $query = $this->db->get();
     return $query->result();
}

function insert_generated_scripts($data)
{
     $this->db->insert('tblQuitClaimScripts',$data);
}

function get_generated_scripts($id)
{
      $this->db->select('*');
     $this->db->from('tblQuitClaimScripts');
     $this->db->where('scripts_quitclaim_id',$id);
     $this->db->order_by('scripts_timestamp', 'DESC');
     $query = $this->db->get();
     return $query->result();
}

function get_all_benefits()
{
  $query = $this->db->get('tblBenefits');
  return $query->result();
}

function get_one_benefit($id)
{
  $this->db->select('tblBenefits.*,tblBenefitsFields.*');
  $this->db->from('tblBenefits');
  $this->db->join('tblBenefitsFields','tblBenefits.benefit_id = tblBenefitsFields.tblBenefits_pk_fk');
  $this->db->where('benefit_id',$id);
  $query = $this->db->get();
  return $query->result();
}

function update_benefit_field($id,$newfield)
{
  $data = array('benefit_field'=>$newfield);
  $this->db->where('benefits_approver_id',$id);
  $this->db->update('tblBenefitsFields',$data);
}

function delete_benefit_field($id)
{
   $this->db->delete('tblBenefitsFields', (array('benefits_approver_id' => $id)));
}

function add_benefit_field($data)
{
  $this->db->insert('tblBenefitsFields',$data);
}

function insert_benefit($data)
{
  $this->db->insert('tblBenefits',$data);
}

function get_last_benefit_id()
{
  return $this->db->insert_id();
}

function insert_benefit_fields($data)
{
  $this->db->insert('tblBenefitsFields',$data);
}

function get_companies()
{
  $this->db->select('user_sbu');
  $this->db->distinct();
  $this->db->from('tblUsers1');
  $query = $this->db->get();
  return $query->result();
}

function get_ranks()
{
  $this->db->select('user_rank,user_sbu');
  $this->db->distinct();
  $this->db->from('tblUsers1');
  $query = $this->db->get();
  return $query->result();
}

function insert_benefit_docu($data)
{
  $this->db->insert('tblBenefitsDocu',$data);
}

function get_docu_benefit($id)
{
  $this->db->select('*');
  $this->db->from('tblBenefitsDocu');
  $this->db->where('benefit_id',$id);
  $query = $this->db->get();
  return $query->result();
}

function delete_benefit_docu($id)
{
    $this->db->delete('tblBenefitsDocu', (array('benefit_id' => $id)));
}

function get_company_categories($companyname)
{
  $this->db->select('*');
  $this->db->from('tblPolicyCateg');
  $this->db->where('policy_category_company',$companyname);
  $query = $this->db->get();
  return $query->result();
}

function update_user_details($id,$data)
{
  $this->db->where('user_employeeID', $id);
  $this->db->update('tblUsers1',$data);
}

function get_benefits_docu()
{
  $this->db->select('*');
  $this->db->from('tblBenefitsDocu');
  $query = $this->db->get();
  return $query->result();
}

function get_users_name_only()
{
  $this->db->select('user_firstname,user_lastname,user_employeeID');
  $this->db->from('tblUsers1');
  $query = $this->db->get();
  return $query->result();
}

function insert_sbu($data)
{
  $this->db->insert('tblSBU',$data);
}

function insert_rank($data)
{
  $this->db->insert('tblRank',$data);
}

function update_sbu($data,$id)
{
    $this->db->where('sbu_id',$id);
    $this->db->update('tblSBU',$data);
}

function delete_sbu($id)
  {
      $this->db->where('sbu_id',$id);
       $this->db->delete('tblSBU');
  }

  function update_position($data,$id)
{
    $this->db->where('position_id',$id);
    $this->db->update('tblPosition',$data);
}

function update_rank($data,$id)
{
  $this->db->where('rank_id',$id);
  $this->db->update('tblRank',$data);
}


     function insert_position($data)
     {
       $this->db->insert('tblPosition',$data);
     }


     function delete_position($id)
     {
         $this->db->where('position_id',$id);
          $this->db->delete('tblPosition');
     }

     function delete_rank($id)
     {
       $this->db->where('rank_id',$id);
        $this->db->delete('tblRank');
     }





}
