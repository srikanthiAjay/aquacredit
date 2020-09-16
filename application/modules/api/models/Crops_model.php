<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
	 * Author:Ramakrishna
*/
error_reporting(0);
ini_set('memory_limit', '100M');

class Crops_model extends CI_Model 
{
	function __construct()
	{
		parent::__construct();
       	$this->load->library('session');
       	$this->load->database();
	}
	
	function getCropsdata($id = "")
	{
		if(!empty($id)){
			$data = $this->db->get_where("user_crop_details", ['cd_id' => $id])->row_array();
		}else{
			$data = $this->db->get("user_crop_details")->result();
		}
		return json_encode(array('status'=>'success','data' => $data));
	}
	function getUserCropsdata($uid = "")
	{
		if(!empty($uid)){
			$data = $this->db->get_where("user_crop_details", ['user_id' => $uid])->result();
			//echo $this->db->last_query();exit;
		}else{
			$data = $this->db->get("user_crop_details")->result();
		}
		return json_encode(array('status'=>'success','data' => $data));
	}
	
	//Crop Types
	function getCropTypes()
	{		
		//$data = $this->db->get("crop_types")->result();
		$data = $this->db->get_where("crop_types", ['status' => 1])->result();
		return json_encode(array('status'=>'success','data' => $data));
	}
}
?>