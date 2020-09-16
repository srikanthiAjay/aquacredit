<?php defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Branch extends CI_Controller 
{
	function __construct()
	{		
		parent::__construct();
		
		$this->load->library('session');		
		$this->load->model('api/Admin_model');		
		$this->load->model('api/Branch_model');
		
		setlocale(LC_MONETARY, 'en_IN');		
		
		header('Access-Control-Allow-Origin: *');
	}

	//Index function
	public function index($id = "")
	{
		echo $response = $this->Branch_model->getBranchdata($id);
	}
	public function byuser()
	{
		$uid = $this->session->userdata('adminid');
		echo $response = $this->Branch_model->cashbalance_by_userid($uid);
	}
	public function getByAdminBranch()
	{
		$admin_id = $this->session->userdata('adminid');
		$branch_data = json_decode($this->Branch_model->cashbalance_by_userid($admin_id),true);		
		$branch_id = $branch_data["data"]["branch_id"];
				
		echo $response = $this->Branch_model->getByAdminBranch($branch_id);
	}
}
?>