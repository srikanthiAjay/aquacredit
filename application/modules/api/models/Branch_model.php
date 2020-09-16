<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
	 * Author:Ramakrishna
*/
error_reporting(0);
ini_set('memory_limit', '100M');

class Branch_model extends CI_Model 
{
	function __construct()
	{
		parent::__construct();
       	$this->load->library('session');
       	$this->load->database();
	}
	
	function getBranchdata($id = "")
	{
		if(!empty($id)){
			$data = $this->db->get_where("branch", ['branch_id' => $id])->row_array();
			//echo $this->db->last_query();exit;
		}else{
			$data = $this->db->get("branch")->result();
		}
		return json_encode(array('status'=>'success','data' => $data));
	}
	function cashbalance_by_userid($uid)
	{		
		$this->db->select('branch.*');
		$this->db->join('branch', 'branch.branch_id = admin_users.branch_id','left');
		$data = $this->db->get_where("admin_users", ['admin_users.id' => $uid])->row_array();
		//echo $this->db->last_query();exit;
		return json_encode(array('status'=>'success','data' => $data));
	}
	function getByAdminBranch($branch_id)
	{
		/* $bquery = $this->db->query("SELECT parent FROM branch Where branch_id = $branch_id");
		$bdata = json_decode(json_encode($bquery->row_array()),true);
		$parent = $bdata["parent"];
		$response = array();
		if($parent > 0)
		{
			$query = $this->db->query("SELECT * FROM branch Where branch_id = $parent OR parent = $parent");	
		}else{
			$query = $this->db->query("SELECT * FROM branch Where branch_id = $branch_id OR parent = $branch_id");
		}	 */		
		$query = $this->db->query("SELECT * FROM branch Where 1");	
		//echo $this->db->last_query();
        if($query->num_rows()>0)
        {
            $data = $query->result(); 
			$response = json_decode(json_encode($data),true);	
        }
		return json_encode(array('status'=>'success','data' => $response,'branch_id' => $branch_id,'admin_role' => $this->session->userdata("adminrole")));
	}
}
?>