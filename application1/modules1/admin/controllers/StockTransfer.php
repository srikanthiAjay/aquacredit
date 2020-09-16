<?php error_reporting(0);

defined('BASEPATH') OR exit('No direct script access allowed');

//include($_SERVER['DOCUMENT_ROOT'].'/aquadeals/application/third_party/ImageTool.php');
class StockTransfer extends CI_Controller 
{
	function __construct()
	{	
		
		parent::__construct();
		
		$this->load->library('session');		
		$this->load->helper('form');
		$this->load->helper('captcha');
		$this->load->helper('url');
		
		setlocale(LC_MONETARY, 'en_IN');		
		
		header('Access-Control-Allow-Origin: *');
		
		if($this->session->userdata('adminid') == "")   // && $this->session->userdata("adminrole") == 5
		{ 
			redirect('admin');
			
		}
	}

	//Index function
	public function index()
	{		
		$data["page_title"] = "Stock Exchange";		
		$this->load->view('admin/stocktransfer',$data);
	} 	

}

?>
