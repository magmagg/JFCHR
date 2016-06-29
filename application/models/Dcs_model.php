<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dcs_Model extends CI_Model
{
     function __construct()
     {
          // Call the Model constructor
          parent::__construct();
     }

     function get_available_submissions()
     {
     	$this->db->select('*');
     	$this->db->from('tblCustomDCS');
     	$query = $this->db->get();
     	return $query->result();
     }

     function get_one_submissions($dcsid)
     {
          $this->db->select('*');
          $this->db->from('tblCustomDCS');
          $this->db->where('custom_dcs_id', $dcsid);
          $query = $this->db->get();
          return $query->result();
     }

     function join_customdcs_tables()
     {
          $this->db->select('tblCustomDCStr.*,tblCustomDCS.*,tblCustomDCSA.*');
          $this->db->from('tblCustomDCStr');
          $this->db->join('tblCustomDCS', 'tblCustomDCS.custom_dcs_id = tblCustomDCStr.custom_dcs_id');
          $this->db->join('tblCustomDCSA', 'tblCustomDCSA.custom_approvers_id = tblCustomDCStr.custom_approvers_id');
          $query = $this->db->get();
          return $query->result();
     }

     function get_approvers_titles($dcs_post_id)
     {
          $this->db->select('tblCustomDCS.custom_dcs_id,tblCustomDCSA.custom_approvers_position');
          $this->db->from('tblCustomDCS');
          $this->db->join('tblCustomDCSA', 'tblCustomDCS.custom_dcs_id = tblCustomDCSA.custom_dcs_id_fk');
          $this->db->where('custom_dcs_id', $dcs_post_id);
          $query = $this->db->get();
          return $query->result();
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

     function get_titles()
     {
          $this->db->select('user_positiontitle');
          $this->db->distinct();
          $this->db->from('tblUsers1');
          $query = $this->db->get();
          return $query->result();
     }

     function insert_new_workflow_title($data)
     {
          $this->db->insert('tblCustomDCS', $data);
     }

     function get_last_workflow_id()
     {
          return $this->db->insert_id();
     }

     function insert_new_workflow_approvers($data)
     {
          $this->db->insert('tblCustomDCSA', $data);
     }

     function get_last_approver_id()
     {
          return $this->db->insert_id();
     }

     function insert_new_workflow_transaction($data)
     {
          $this->db->insert('tblCustomDCStr', $data);
     }

     function get_one_workflow($workflowID)
     {
          $this->db->select('tblCustomDCStr.*,tblCustomDCS.*,tblCustomDCSA.*');
          $this->db->from('tblCustomDCStr');
          $this->db->join('tblCustomDCS', 'tblCustomDCS.custom_dcs_id = tblCustomDCStr.custom_dcs_id');
          $this->db->join('tblCustomDCSA', 'tblCustomDCSA.custom_approvers_id = tblCustomDCStr.custom_approvers_id');
          $this->db->where('tblCustomDCS.custom_dcs_id', $workflowID);
          $query = $this->db->get();
          return $query->result();
     }

     function update_hierarchy($currentapprover,$newapprover, $dcsid)
     {
          $data = array('custom_approvers_position'=>$newapprover);
         $this->db->where('custom_approvers_id', $currentapprover);
         $this->db->where('custom_dcs_id_fk', $dcsid);
         $this->db->update('tblCustomDCSA',$data);
     }

     function delete_from_hierarchy($postid, $dcsid)
     {
          $this->db->where('custom_dcs_id_fk', $dcsid);
          $this->db->delete('tblCustomDCSA',(array('custom_approvers_id' => $postid)));
          $this->delete_from_transaction($postid, $dcsid);
     }

      function delete_from_transaction($postid, $dcsid)
     {
          $this->db->where('custom_dcs_id', $dcsid);
          $this->db->delete('tblCustomDCStr',(array('custom_approvers_id' => $postid)));
     }

     function get_swap($data)
     {
          $this->db->select('*');
          $this->db->from('tblCustomDCSA');
          $this->db->where('custom_approvers_id',$data);
          $query = $this->db->get();
          return $query->result();
     }

     function swap_hierarchy($custom_approvers_id, $custom_approvers_position)
     {
          $data = array('custom_approvers_position'=>$custom_approvers_position);
          $this->db->where('custom_approvers_id',$custom_approvers_id);   
          $this->db->update('tblCustomDCSA',$data);   
     }

     function get_sbus()
     {
          $this->db->select('user_sbu');
          $this->db->distinct();
          $this->db->from('tblUsers1');
          $query = $this->db->get();
          return $query->result();
     }

     function get_all_approved_document()
     {
          $this->db->select('*');
          $this->db->from('tblDCSDocuments');
          $query = $this->db->get();
          return $query->result();
     }

     function get_one_dcs_approved_document($id)
     {
          $this->db->select('*');
          $this->db->from('tblDCS');
          $this->db->join('tblDCSDocuments','tblDCS.dcs_id = tblDCSDocuments.dcs_id_fk');
          $this->db->where('tblDCS.dcs_id',$id);
          $query = $this->db->get();
          return $query->result();
     }



 }
