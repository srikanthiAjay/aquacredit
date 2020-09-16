<?php error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');
//include($_SERVER['DOCUMENT_ROOT'].'/aquadeals/application/third_party/ImageTool.php');
class Traders extends CI_Controller 
{
	function __construct()
	{			
		parent::__construct();
		
		$this->load->library('session');				
		$this->load->helper('form');
		$this->load->helper('captcha');
		$this->load->helper('url');
		$this->load->model("api/Traders_model");
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
		$data["page_title"] = "Traders";		
		$this->load->view('admin/traders',$data);
	} 	
	
	public function create()
	{
		$data["page_title"] = "Trader Create";
		$this->load->view('admin/createtrader',$data);
	}

	public function statement($trader_id)
	{
		$data["page_title"] = "Trader Statement";
		$trader = $this->Traders_model->getTraderDetails($trader_id);
		$trader = json_decode(($trader), true);
		if($trader["status"]=="success")
		{
			$data["trader"] = $trader["data"];
		}
		$data['trade_profit'] = $this->Traders_model->getAnalytics($trader_id);
		$data['soldCounts'] = $this->Traders_model->getHighSoldCounts($trader_id);
		$this->load->view('admin/trader_statement',$data);
	}
	
	public function details()
	{		
		$data["page_title"] = "Trader Details";
		$this->load->view('admin/trader_details',$data);
	}
	public function trader_print()
	{
		$data["page_title"] = "Print Details";				
		$adminid = $this->session->userdata("adminid");
		$this->load->view('admin/trader_print',$data);
	}
	
}

?>
