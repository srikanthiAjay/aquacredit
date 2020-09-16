<?php defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
//include($_SERVER['DOCUMENT_ROOT'].'/aquadeals/application/third_party/ImageTool.php');
class Trades extends CI_Controller 
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
		$data["page_title"] = "Trades";				
		$adminid = $this->session->userdata("adminid");
		$this->load->view('admin/trades',$data);
	}
	
}
?>