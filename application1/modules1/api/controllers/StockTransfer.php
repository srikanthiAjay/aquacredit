<?php defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class StockTransfer extends CI_Controller 
{
	function __construct()
	{	
		parent::__construct();
		
		$this->load->library('session');		
		$this->load->model('api/Admin_model');	
		//$this->load->model('api/StockTransfer_model');		
		
		setlocale(LC_MONETARY, 'en_IN');		
		
		header('Access-Control-Allow-Origin: *');
	}

	//Index function
	public function index($tid = "")
	{		
		//echo $response = $this->Traders_model->getTradersdata($tid);
	}
	
	public function receipt_details($rc_id)
	{
		//echo $response = $this->Receipts_model->getReceiptDetails($rc_id);
	}
	
	// Add Traders
	public function add()
	{
		print_r($_POST);exit;
		
	}
}
?>