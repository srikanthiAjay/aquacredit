<?php defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
//include($_SERVER['DOCUMENT_ROOT'].'/aquadeals/application/third_party/ImageTool.php');
class Products extends CI_Controller 
{
	function __construct()
	{		
		parent::__construct();
		
		$this->load->library('session');		
		$this->load->model('api/Admin_model');		
		$this->load->model('api/Products_model');
		$this->load->model('api/Categories_model');
		$this->load->model('api/Brands_model');
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
		$data["page_title"] = "Products";	
		$data["categories"] = $this->Categories_model->categoryWiseCount();	
		$data["brands"] = $this->Brands_model->brands();	
		$this->load->view('admin/products',$data);
	}
	
	public function create()
	{
		$data["page_title"] = "Create Product";
		$this->load->view('admin/createproduct',$data);
	}	
	
	public function view($pid)
	{
		$data["page_title"] = "View Product";
		$data["pid"] = $pid;		
		$this->load->view('admin/editproduct',$data);
	}	
	
	public function edit($pid)
	{		
		$data["page_title"] = "Edit Product";
		$data["pid"] = $pid;		
		$this->load->view('admin/editproduct',$data);
	}	
	
}

?>
