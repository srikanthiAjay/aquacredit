<?php defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Returns extends CI_Controller 
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
		$data["page_title"] = "Returns";		
		$this->load->view('admin/returns',$data);
	}

	public function create()
	{		
		$data["page_title"] = "Create Returns";		
		$this->load->view('admin/createreturn',$data);
	}
	public function edit($rid)
	{		
		$data["page_title"] = "Edit Returns";
		$data["rid"] = $rid;		
		$this->load->view('admin/editreturns',$data);
	}
	public function view($rid)
	{		
		$data["page_title"] = "View Returns";
		$data["rid"] = $rid;		
		$this->load->view('admin/viewreturns',$data);
	}
}

?>
