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
	
	function getBanksdata($id = "")
	{
		if(!empty($id)){
			$data = $this->db->get_where("ac_banks", ['bank_id' => $id])->row_array();
			//echo $this->db->last_query();exit;
		}else{
			$data = $this->db->get("ac_banks")->result();
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
		
		$data = $this->db->get_where("ac_banks", ['bank_id' => $post["bank_id"]])->row_array();
		//echo $this->db->last_query();exit;		
		return json_encode(array('status'=>'success','data' => $data));
	}
}
?>