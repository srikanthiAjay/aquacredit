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

	// all bank accounts
	function getBanksdata($id = "")
	{
		$this->db->where("account_type","BANK");
		if(!empty($id)){
			$data = $this->db->get_where("accounts", ['id' => $id])->row_array();
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

	//user bank details
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

	//user bank details
	function getUserBankById($bid)
	{
		$data = $this->db->get_where("user_bank_accounts", ['acc_id' => $bid])->row_array();
		//echo $this->db->last_query();exit;		
		return json_encode(array('status'=>'success','data' => $data));
	}

	// single bank acccount
	function getAccountBal($post)
	{
		$data = $this->db->get_where("accounts", ['id' => $post["bank_id"]])->row_array();
		return json_encode(array('status'=>'success','data' => $data));
	}

	
}
?>