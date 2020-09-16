<?php defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Test extends CI_Controller 
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
		$data["page_title"] = "Loans";		
		$this->load->view('admin/createloan_old',$data);
	}
	public function animated()
	{
		$data["page_title"] = "Animated";		
		$this->load->view('admin/animated',$data);
	}
}

?>
