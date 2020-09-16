<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
	 * Author:Ramakrishna
*/
error_reporting(0);
ini_set('memory_limit', '100M');

class Banks_model extends CI_Model 
{
	function __construct()
	{
		parent::__construct();
       	$this->load->library('session');
       	$this->load->database();
	}
// Loan module Accounts display ==  bank and cash
function getCashAccounts($id = "", $account_type="") 
{
	if(!empty($id)){
		$data = $this->db->get_where("accounts", ['id' => $id])->row_array();
	}else{
		if($this->session->userdata('adminrole')!="SA")
		{
			$this->db->group_start();
			$this->db->where("branch_id",null);
			$this->db->or_where("branch_id",$this->session->userdata('branch_id'));
			$this->db->group_end();
		}
		if(!empty($account_type))
			$this->db->where("account_type",$account_type);
		$data = $this->db->get("accounts")->result();
	}
	return json_encode(array('status'=>'success','data' => $data));
}
function getCashAccountsbranch($id = "", $account_type="", $branch="", $mbranch)
{
	if(!empty($id)){
		$data = $this->db->get_where("accounts", ['id' => $id])->row_array();
	}else{
		if(!empty($branch) && $mbranch=='cash' && $account_type=='cash')
		{
			$this->db->where("branch_id",$branch);
		}
			
		if(!empty($account_type))
		{
			$this->db->where("account_type",$account_type);
		}
		$data = $this->db->get("accounts")->result();
		//echo $this->db->last_query();

	}
	return json_encode(array('status'=>'success','data' => $data));	
}

function getAccounts($id = "", $seltype = "")
	{
		
			$this->db->where("account_type",$seltype);
			if($this->session->userdata('adminrole')!="SA")
			{
				$this->db->where("branch_id",null);
				$this->db->or_where("branch_id",$this->session->userdata('branch_id'));
			}
			$response = $this->db->get("accounts")->result_array();
			foreach($response as $row)
			{
				$llla = $this->db->query("select *from branch where branch_id='".$row['branch_id']."' ");
				$lla = $llla->row_array();

				$data[] = array("id"=>$row['id'],"account_type"=>$row['account_type'],"account_name"=>$row['account_name'],"account_number"=>$row['account_number'],"ifsc_code"=>$row["ifsc_code"],"avail_amount"=>$row['avail_amount'],"created_on"=>$row['created_on'],"updated_on" => $row['updated_on'],'branch_name'=>$lla['branch_name']);
			}
		
		return json_encode(array('status'=>'success','data' => $data));
	}

	// all bank accounts
	function getBanksdata($id = "")
	{
		$this->db->where("account_type","BANK");
		if(!empty($id)){
			$data = $this->db->get_where("accounts", ['id' => $id])->row_array();
			//echo $this->db->last_query();exit;
		}else{
			$data = $this->db->get("accounts")->result();
		}
		return json_encode(array('status'=>'success','data' => $data));
	}

	function getBanksdataall($id = "")
	{
		
		if(!empty($id)){
			$data = $this->db->get_where("accounts", ['id' => $id])->row_array();
			//echo $this->db->last_query();exit;
		}else{
			$data = $this->db->get("accounts")->result();
		}
		return json_encode(array('status'=>'success','data' => $data));
	}

	function getBanksdataallbranch($id = "")
	{
		
		if(!empty($id)){
			$data = $this->db->get_where("accounts", ['branch_id' => $id])->row_array();
			//echo $this->db->last_query();exit;
		}else{
			$data = $this->db->get("accounts")->result();
		}
		return json_encode(array('status'=>'success','data' => $data));
	}

	//all cash accounts
	function getCashdata($id = "")
	{
		$this->db->where("account_type","CASH");
		if($this->session->userdata('adminrole')!="SA")
		{
			$this->db->where("branch_id",$this->session->userdata('branch_id'));
		}
		if(!empty($id)){
			$data = $this->db->get_where("accounts", ['id' => $id])->row_array();
			//echo $this->db->last_query();exit;
		}else{
			$data = $this->db->get("accounts")->result();
		}
		return json_encode(array('status'=>'success','data' => $data));
	}

	function getUserBanksdata($uid = "")
	{
		if(!empty($uid)){
			$data = $this->db->get_where("user_bank_accounts", ['user_id' => $uid])->result();
			//echo $this->db->last_query();exit;
		}else{
			$data = $this->db->get("user_bank_accounts")->result();
		}
		return json_encode(array('status'=>'success','data' => $data));
	}
	
	function getUserBankById($bid)
	{
		$data = $this->db->get_where("user_bank_accounts", ['acc_id' => $bid])->row_array();
		//echo $this->db->last_query();exit;		
		return json_encode(array('status'=>'success','data' => $data));
	}

	function getAccountBal($post)
	{
		$data = $this->db->get_where("accounts", ['id' => $post["bank_id"]])->row_array();
		return json_encode(array('status'=>'success','data' => $data));
	}
	function getBankNames()
	{		
		$data = $this->db->get("bank_names")->result();
		return json_encode(array('status'=>'success','data' => $data));
	}
}
?>