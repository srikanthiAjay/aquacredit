<?php defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(E_ALL | E_STRICT);
//include($_SERVER['DOCUMENT_ROOT'].'/aquadeals/application/third_party/ImageTool.php');
class Users extends CI_Controller 
{
	function __construct()
	{	
		parent::__construct();
		
		$this->load->library('session');		
		$this->load->model('api/Admin_model');
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
		$data["page_title"] = "Users";				
		$adminid = $this->session->userdata("adminid");
		$this->load->view('admin/users',$data);
	}	
	
	public function details()
	{
		$data["page_title"] = "User Details";				
		$adminid = $this->session->userdata("adminid");
		$this->load->view('admin/userdetails',$data);
	}
	
	public function create()
	{
		$data["page_title"] = "Create User";				
		$adminid = $this->session->userdata("adminid");
		$this->load->view('admin/createuser',$data);
	}
	
	public function edit($usercode)
	{		
		$data["page_title"] = "Edit User";			
		$this->load->view('admin/edituser',$data);
		
	}
}
?>