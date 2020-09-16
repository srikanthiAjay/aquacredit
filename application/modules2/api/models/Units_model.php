<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
	 * Author:Ramakrishna
*/
error_reporting(0);
ini_set('memory_limit', '100M');

class Units_model extends CI_Model 
{
	function __construct()
	{
		parent::__construct();
       	$this->load->library('session');
       	$this->load->database();
	}
	
	function getUnitsdata($uid = "")
	{
		if(!empty($uid)){
			 
			$data = $this->db->get_where("units", ['id' => $uid])->row_array();
		}else{
			$data = $this->db->get("units")->result();
		}
		return json_encode(array('status'=>'success','data' => $data));
	}
}
?>