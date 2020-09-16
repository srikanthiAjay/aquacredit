<?php defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(1);
//include($_SERVER['DOCUMENT_ROOT'].'/aquadeals/application/third_party/ImageTool.php');
class Companies extends CI_Controller 
{
	function __construct()
	{	
		parent::__construct();
		
		$this->load->library('session');		
		$this->load->model('api/Admin_model');	
		$this->load->model('api/Brands_model');
		$this->load->model('api/Categories_model');		
		$this->load->model('api/Subcategories_model');		
		$this->load->helper('form');
		$this->load->helper('captcha');
		$this->load->helper('url');
		$this->load->library('upload');
		
		setlocale(LC_MONETARY, 'en_IN');		
		
		header('Access-Control-Allow-Origin: *');
		
		if($this->session->userdata('adminid') == "")
		{ 
			redirect('admin/login');			
		}
	}

	//Index function
	public function index()
	{		
		$data["page_title"] = "Companies";
		$data["categories"] = $this->Categories_model->categoryWiseCount();
		$this->load->view('admin/brands',$data);
	}	
	
	public function view($bid)
	{
		$data["page_title"] = "Company";
		$data["bid"] = $bid;		
		$this->load->view('admin/editbrand',$data);
	}
		
	public function create()
	{
		$data["page_title"] = "Create Company";
		$this->load->view('admin/createbrand',$data);
	}
	
	public function statement()
	{
		$data["page_title"] = "Company Statement";
		$this->load->view('admin/brand_statement',$data);
	}

	public function edit($bid)
	{
		$data["page_title"] = "Edit Company";				
		$data["bid"] = $bid;		
		$this->load->view('admin/editbrand',$data);
	}	
		
}
?>