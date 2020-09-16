<?php defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Sales extends CI_Controller 
{
	function __construct()
	{		
		parent::__construct();
		
		$this->load->library('session');		
		$this->load->model('api/Admin_model');	
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
		$data["page_title"] = "Sales";		
		$this->load->view('admin/sales',$data);
	}

	public function create()
	{		
		$data["page_title"] = "Create Sale";		
		$this->load->view('admin/createsale',$data);
	}
	public function edit($pid)
	{		
		$data["page_title"] = "Edit Sale";	
		$data["pid"] = $pid;	
		$this->load->view('admin/editsale',$data);
	}
	public function view($pid)
	{		
		$data["page_title"] = "View Sale";	
		$data["pid"] = $pid;	
		$this->load->view('admin/viewsale',$data);
	}
}

?>
