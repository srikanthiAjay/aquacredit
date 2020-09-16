<?php defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);

class Receipts extends CI_Controller 
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
	}

	//Index function
	public function index()
	{
		$data["page_title"] = "Receipts";		
		$this->load->view('admin/receipts',$data);
	} 	
	
}

?>
