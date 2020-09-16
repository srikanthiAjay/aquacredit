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
		$this->load->model('api/Transaction_model');
		
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
		$reportRange = $_POST['reportrange'];		
		
		## Search	         
	       
		$traders =  $this->Traders_model->traders_search($limit,$start,$searchValue,$searchByMonth,$searchByTrader,$order,$dir,$reportRange);      
		
		$data = [];
		
		if(count($traders)>0)
		{
			foreach($traders as $r) {

				if($r["trader_type"] == "Agent"){ $tname = $r["full_name"];}
				else if($r["trader_type"] == "Exporter"){ $tname = $r["firm_name"]." ( ".$r["contact_person"]." )";}
				$balance = number_format($r["balance"],2);
			   $data[] = array(					
					//$r["trader_code"],
					'TDR'.$r["td_id"],
					date("d-M-Y",strtotime($r["created_on"])),
					'<a href="'.base_url().'admin/traders/statement/'.$r["td_id"].'" title="">'.$tname.'</a> ',
					$r["mobile_no"],
					$r["trader_type"],
					'₹'.$balance,
					'<i class="fa fa-ellipsis-v act_icn" id="'.$r['td_id'].'" data-toggle="popover" data-placement="left" tabindex="0" data-trigger="focus"  aria-hidden="true"></i>'
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

	public function transactions()
	{
		$draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$limit = intval($this->input->post("length"));

		$params['order']=$_POST['order'][0]['column']; // Column index
		$params['columnName']=$_POST['columns'][$order]['data']; // Column name
		$params['dir']=$_POST['order'][0]['dir']; // asc or desc
		$params['searchValue']=$_POST['search']['value']; // Search value

		$params['trader_id'] = $this->input->post('trader_id');
		$params["trans_type"] = ($this->input->post('trans_type')) ? $this->input->post('trans_type') : "";
		$params["month_opt"] = ($this->input->post('month_opt')) ? $this->input->post('month_opt') : "";
		$params["reportRange"] = $_POST['reportrange'];	

		$balance = $this->Traders_model->getTraderDetails($this->input->post('trader_id'),'balance,balance_type');
		$balance = json_decode($balance,true);
		$open_balance = $balance["data"]['balance'];
		$records=$this->Transaction_model->getAgentRecords($limit,$start,$params);
		$total_count = $records['count'];
		$tansactions = $records['data'];
		$data = [];
		$amount = 0;
		if($total_count)
		{
			foreach($tansactions as $key=>$value){
				if($value["amount_type"] == "OUT") 
				{
					$amount -=$value['amount'];
					$amt = '<span class="txt_red">'.number_format($value['amount'],2).'<span class="arr_blk"> <img src="http://3.7.44.132/aquacredit/assets/images/rd_c_ar.png"> </span></span>';
				}  
				else 
				{
					$amount +=$value["amount"];
					$amt = '<span class="grn_clr">'.number_format($value['amount'],2).'<span class="arr_blk"> <img src="http://3.7.44.132/aquacredit/assets/images/grn_c_ar.png"> </span></span>';
				}
				$trans = ($value['trans'] != null) ? "(".$value['trans'].")" : "";
				$data[]=[
								date("d-M-Y",strtotime($value['created_on'])),
								'<a href="javascript:void(0);" class="expand_details" title="">'. $value["trans_type"].' '.$trans.' - '.$value["trans_code"].'</a>',
								$amt,
								$value["trans_type"],
								$value['trans'],
								$value['trans_id'],
								$value["amount"]

							];
			}
		}

		$response=[];
		$response["draw"]=$draw;
		$response["start"]=$start;
		$response["length"]=$limit;
		$response["recordsTotal"]=$total_count;
		$response["recordsFiltered"]=$total_count;
		$response["data"]=$data;
		$response["total_trans_amount"] = $amount;
		$response["open_balance"] = $open_balance;
		echo json_encode($response);
	}
	
	public function previewAgentTransaction($trader_id)
	{
		$params["trader_id"] =  $trader_id;
		
		$transactions = $this->Transaction_model->getAgentRecords('','',$params);
		$data["transactions"] = $transactions["data"];
		$trader = $this->Traders_model->getTraderDetails($trader_id);
		$trader = json_decode($trader,true);
		$data['trader'] = $trader["data"];
		$html=$this->load->view('admin/previewAgentTransaction',$data); 
	}

	public function printAgentTrans($trader_id)
	{
		$params["trader_id"] =  $trader_id;
		
		$transactions = $this->Transaction_model->getAgentRecords('','',$params);
		$data["transactions"] = $transactions["data"];
		$trader = $this->Traders_model->getTraderDetails($trader_id);
		$trader = json_decode($trader,true);
		$data['trader'] = $trader["data"];
		$html=$this->load->view('admin/pdfAgentTrans',$data,true); 
		//exit;
		$time = time();
		$pdfFilePath = $_SERVER['DOCUMENT_ROOT']."/aquacredit/assets/pdf/transactions/trans_".date('m-d-Y_hia').".pdf";	

        $this->load->library('Pdf');
		$pdf = new Pdf('P', 'mm', 'A5', true, 'UTF-8', false);
		$pdf->SetTitle('Aquacredit Agent Transactions');

		$pdf->SetMargins(5, '', 5);
		$pdf->SetHeaderMargin(30);
		$pdf->SetTopMargin(20);
		$pdf->setFooterMargin(20);
		$pdf->SetAutoPageBreak(true,30);
		$pdf->SetAuthor('Author');
		$pdf->SetDisplayMode('real', 'default');
		$pdf->AddPage('P', 'A5');
		$pdf->writeHTML($html, true, false, true, false, '');

		$pdf->SetAlpha(0.7);
		$pdf->Image( base_url().'assets/images/not_paid.png', 10, 90, 70, 50, '', '', 'C', false, 72, 'C', false, false, 0);
		
		$pdf->lastPage();
		ob_end_clean();
		$pdf->Output($pdfFilePath, 'FD');
		exit;
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
		if($_POST["trader_type"] == "Agent")
		{ 
			$firm_name = ""; $contact_name = ""; $trader_name = $_POST["tname"]; 
			$pan = $_POST["tpan"]; $gst = ""; $trader_code = "A".strtotime("now");
		}
		else if($_POST["trader_type"] == "Exporter")
		{ 
			$firm_name = $_POST["firm_name"]; $contact_name = $_POST["tname"]; 
			$trader_name = ""; $pan = $_POST["tpan"]; $gst = $_POST["tgst"]; $trader_code = "E".strtotime("now");
		}
		
		$posts = array('trader_type' => $_POST["trader_type"],
			'trader_code' => $trader_code,
			'firm_name' => ucwords($firm_name),
			'contact_person' => ucwords($contact_name),
			'full_name' => ucwords($trader_name),
			'mobile_no' => $_POST["tmobile"],
			'location' => $_POST["tlocation"],
			'aadhar_no' => $_POST["taadhar"],
			'pan_no' => $pan,
			'gst' => $gst,
			'balance' => $_POST["tbal"],
			'balance_type' => "Positive", //$_POST["bl_ch"],
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
			'firm_name' => ucwords($firm_name),
			'contact_person' => ucwords($contact_name),
			'full_name' => ucwords($trader_name),
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

	public function checkmobile($trader_id = null)
	{
		if($_POST["trader_id"])
			$trader_id = $_POST["trader_id"];
		$tmobile = $_POST["tmobile"];
		$this->db->select('td_id');
		$this->db->where('mobile_no',$tmobile);
		if($trader_id != "")	
			$this->db->where('td_id !=',$trader_id);
		$count = $this->db->get('traders')->num_rows();
		if($count)
		{			
			echo 'false';
		}
		else
		{
			echo 'true';
		}
		exit;
	}

	public function checkTrader($trader_id = null)
	{
		/* if($_POST["trader_type"] != "Agent")
		{
			echo 'true'; exit;
		} */
		if($_POST["trader_id"])
			$trader_id = $_POST["trader_id"];
		$tname = $_POST["tname"];
		$this->db->select('td_id');
		
		if($_POST["trader_type"] == "Agent")
		{
			$this->db->where('full_name',$tname);
		}
		else
		{
			$this->db->where('contact_person',$tname);
		}
		$this->db->where('trader_type',$_POST["trader_type"]);
		if($trader_id != "")	
			$this->db->where('td_id !=',$trader_id);
		$count = $this->db->get('traders')->num_rows();
		echo ($count) ? 'false' : 'true'; exit;
	}

	public function checkFirm($trader_id = null)
	{
		if($_POST["trader_id"])
			$trader_id = $_POST["trader_id"];
		$firm_name = $_POST["firm_name"];
		$this->db->select('td_id');
		
		if($_POST["trader_type"] == "Exporter")
		{
			$this->db->where('firm_name',$firm_name);
		}

		$this->db->where('trader_type',$_POST["trader_type"]);
		if($trader_id != "")	
			$this->db->where('td_id !=',$trader_id);
		$count = $this->db->get('traders')->num_rows();
		echo ($count) ? 'false' : 'true'; exit;
	}

	public function checkPAN($trader_id = null)
	{
		if($_POST["trader_id"])
			$trader_id = $_POST["trader_id"];
		$tpan = $_POST["tpan"];
		$this->db->select('td_id');
		$this->db->where('pan_no',$tpan);
		if($trader_id != "")	
			$this->db->where('td_id !=',$trader_id);
		$count = $this->db->get('traders')->num_rows();
		echo ($count) ? 'false' : 'true'; exit;
	}

	public function checkAadhar($trader_id = null)
	{
		if($_POST["trader_id"])
			$trader_id = $_POST["trader_id"];
		$taadhar = $_POST["taadhar"];
		$this->db->select('td_id');
		$this->db->where('aadhar_no',$taadhar);
		if($trader_id != "")	
			$this->db->where('td_id !=',$trader_id);
		$count = $this->db->get('traders')->num_rows();
		echo ($count) ? 'false' : 'true'; exit;
	}

	public function checkGST($trader_id = null)
	{
		if($_POST["trader_id"])
			$trader_id = $_POST["trader_id"];
		$tgst = $_POST["tgst"];
		$this->db->select('td_id');
		$this->db->where('gst',$tgst);
		if($trader_id != "")	
			$this->db->where('td_id !=',$trader_id);
		$count = $this->db->get('traders')->num_rows();
		echo ($count) ? 'false' : 'true';exit;		
	}
}
?>