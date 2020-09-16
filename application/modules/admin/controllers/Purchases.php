<?php defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Purchases extends CI_Controller 
{
	function __construct()
	{		
		parent::__construct();
		
		//$this->load->library('session');		
		$this->load->model('api/Admin_model');
		$this->load->model('api/Purchases_model');
		$this->load->helper('form');
		$this->load->helper('captcha');
		$this->load->helper('url');
		setlocale(LC_MONETARY, 'en_IN');		
		header('Access-Control-Allow-Origin: *');
		
		if($this->session->userdata('adminid') == "")
		{ 
			redirect('admin');
			
		}
	}

	//Index function
	public function index()
	{	
		if($this->session->userdata('adminrole')=='SA'){
			$data["page_title"] = "Purchases";	
			$data["branch_id"]=$this->session->userdata('branch_id');
			$data["role"]=$this->session->userdata('adminrole');
			$data["branch"]=$this->Purchases_model->getBranchDetails($data["branch_id"]);
			$data["all_branches"]=$this->Purchases_model->getAllBranches();
			$data["brands"]=$this->Purchases_model->getBrands();	
			$this->load->view('admin/admin_purchases',$data);
		}else{
			redirect('admin/purchases/branch_purchase');
		}
		
	}

	//Branch Purchase
	public function branch_purchase()
	{	
		if($this->session->userdata('adminrole')=='A'){
			$data["page_title"]="Purchases";
			$data["branch_id"]=$this->session->userdata('branch_id');
			$data["role"]=$this->session->userdata('adminrole');
			$data["branch"]=$this->Purchases_model->getBranchDetails($data["branch_id"]);
			$data["brands"]=$this->Purchases_model->getBrands();
			$this->load->view('admin/branch_purchases',$data);
		}else{
			redirect('admin/purchases');
		}
		
	}
	
}

?>
