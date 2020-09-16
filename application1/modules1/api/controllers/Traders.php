<?php defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Traders extends CI_Controller 
{
	function __construct()
	{	
		parent::__construct();
		
		$this->load->library('session');		
		$this->load->model('api/Admin_model');	
		$this->load->model('api/Traders_model');
		
		
		setlocale(LC_MONETARY, 'en_IN');		
		
		header('Access-Control-Allow-Origin: *');
	}

	//Index function
	public function index($tid = "")
	{		
		//echo $response = $this->Traders_model->getTradersdata($tid);
	}
	
	public function traderdetails($tdid)
	{
		echo $response = $this->Traders_model->getTraderDetails($tdid);
	}
	
	public function get_traders()
	{
		//echo "<pre>";print_r($_POST);exit;
		
		$draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$limit = intval($this->input->post("length"));	  
		
		$order = $_POST['order'][0]['column']; // Column index
		$columnName = $_POST['columns'][$order]['data']; // Column name
		$dir = $_POST['order'][0]['dir']; // asc or desc
		$searchValue = $_POST['search']['value']; // Search value
		
		## Custom Field value			
		$searchByMonth = $_POST['month_opt'];		
		$searchByTrader = $_POST['trader_opt'];		
		
		## Search	         
	       
		$traders =  $this->Traders_model->traders_search($limit,$start,$searchValue,$searchByMonth,$searchByTrader,$order,$dir);      
		
		$data = [];
		
		if(count($traders)>0)
		{
			foreach($traders as $r) {

				if($r["trader_type"] == "Agent"){ $tname = $r["full_name"];}
				else if($r["trader_type"] == "Exporter"){ $tname = $r["firm_name"]." ( ".$r["contact_person"]." )";}
			
			   $data[] = array(					
					$r["trader_code"],
					date("d-M-Y",strtotime($r["created_on"])),
					'<a href="'.base_url().'admin/traders/statement" title="">'.$tname.'</a> ',
					$r["mobile_no"],
					$r["trader_type"],
					$r["balance"],
					'<i class="fa fa-ellipsis-v act_icn" data-toggle="popover" data-placement="left" tabindex="0" data-trigger="focus" title="Actions" aria-hidden="true" onclick="edit_trader('.$r["td_id"].');"></i>'
			   );
			}
		}
		

		$result = array(
			"draw" => $draw,
			"start" => $start,
			"length" => $limit,
			"recordsTotal" => count($traders),
			"recordsFiltered" => (count($traders)>0)?$traders[0]["tot_filter_rec"]:0,
			"data" => $data,
			"agent_count" => $traders[0]["agent_count"],
			"exporter_count" => $traders[0]["exporter_count"]
		);		
		//print_r($result);exit;
		echo json_encode($result);
		exit();
	}
	
	public function checktradername()
	{		
		$final_res = json_decode($this->Traders_model->check_trader_name($_POST["trader_name"]),true);
		if($final_res["status"] == "exists" ){	echo 1; }else{ echo 0;}
		exit;
	}
	public function checkfirmname()
	{		
		$final_res = json_decode($this->Traders_model->check_firm_name($_POST["firm_name"]),true);
		if($final_res["status"] == "exists" ){	echo 1; }else{ echo 0;}
		exit;
	}

	// Add Traders
	public function add()
	{		
		
		//print_r($_POST);exit;
				
		if($_POST["trader_type"] == "Agent")
		{ 
			$firm_name = ""; $contact_name = ""; $trader_name = $_POST["tname"]; 
			$pan = $_POST["tpan"]; $gst = ""; $trader_code = "A".strtotime("now");
		}
		else if($_POST["trader_type"] == "Exporter")
		{ 
			$firm_name = $_POST["firm_name"]; $contact_name = $_POST["tname"]; 
			$trader_name = ""; $pan = ""; $gst = $_POST["tgst"]; $trader_code = "E".strtotime("now");
		}
		
		$posts = array('trader_type' => $_POST["trader_type"],
			'trader_code' => $trader_code,
			'firm_name' => $firm_name,
			'contact_person' => $contact_name,
			'full_name' => $trader_name,
			'mobile_no' => $_POST["tmobile"],
			'location' => $_POST["tlocation"],
			'aadhar_no' => $_POST["taadhar"],
			'pan_no' => $pan,
			'gst' => $gst,
			'balance' => $_POST["tbal"],
			'balance_type' => $_POST["bl_ch"],
			'payment_terms' => $_POST["pterm"],
			'status' => 1			
			);		
		$response = $this->Traders_model->insert($posts);
		$final_res = json_decode($response,true);
		echo $response;
		
	}	
		
	public function update()
	{
		
		$trader_id = $_POST["hid_td_id"];
		if($_POST["trader_type"] == "Agent")
		{ 
			$firm_name = ""; $contact_name = ""; $trader_name = $_POST["tname"]; 
			 $gst = ""; $aadhar = $_POST["taadhar"];
		}
		else if($_POST["trader_type"] == "Exporter")
		{ 
			$firm_name = $_POST["firm_name"]; $contact_name = $_POST["tname"]; 
			$trader_name = ""; $gst = $_POST["tgst"]; $aadhar = "";
		}
		
		$posts = array('trader_type' => $_POST["trader_type"],
			'firm_name' => $firm_name,
			'contact_person' => $contact_name,
			'full_name' => $trader_name,
			'mobile_no' => $_POST["tmobile"],
			'location' => $_POST["tlocation"],
			'aadhar_no' => $aadhar,
			'pan_no' => $_POST["tpan"],
			'gst' => $gst,
			'balance' => $_POST["tbal"],
			'balance_type' => $_POST["bl_ch"],
			'payment_terms' => $_POST["pterm"],
			'updated_on' => date('Y-m-d H:i:s')		
			);	
		echo $response = $this->Traders_model->updateTrader($trader_id,$posts);
	}

	public function delete()
	{
		$tdid = $_POST["tdid"];		
		echo $response = $this->Traders_model->deleteTrader($tdid);
		
	}
}
?>