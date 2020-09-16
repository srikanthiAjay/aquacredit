<?php defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class StockTransfer extends CI_Controller 
{
	function __construct()
	{	
		parent::__construct();
		
		$this->load->library('session');		
		$this->load->model('api/Admin_model');	
		$this->load->model('api/Branch_model');	
		$this->load->model('api/Stocktransfer_model');		
		$this->load->model('api/Loans_model');		
		
		setlocale(LC_MONETARY, 'en_IN');		
		
		header('Access-Control-Allow-Origin: *');
	}

	//Index function
	public function index($tid = "")
	{		
		//echo $response = $this->Traders_model->getTradersdata($tid);
	}
	
	public function stock_transfer_details($stk_trans_id)
	{
		echo $response = $this->Stocktransfer_model->getStockTransferDetails($stk_trans_id);
	}
	
	public function searchBranchproducts()
	{
		
		$search = $_POST['search'];
		$bid = $_POST['bid'];
		//$search = $_GET['term'];
		echo $response = $this->Stocktransfer_model->getSearchBranchProducts(urldecode($search),$bid);		
		exit;
	}
	
	public function get_stock_transfer()
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
		$searchByStatus = $_POST['status_opt'];
		$reportRange = $_POST['reportrange'];		
				
		## Search	

		$allcounts = $this->Stocktransfer_model->StockTransferAnalytics();
	       
		$stock_trans =  $this->Stocktransfer_model->stock_transfer_search($limit,$start,$searchValue,$searchByStatus,$reportRange,$order,$dir);      
		
		$data = [];

		if(count($stock_trans)>0)
		{
			foreach($stock_trans as $r) {				
				
				$src_branch = json_decode($this->Branch_model->getBranchdata($r["source_branch"]),true);
				$src_bname = $src_branch["data"]["branch_name"];	
				$dst_branch = json_decode($this->Branch_model->getBranchdata($r["destination_branch"]),true);
				$dst_bname = $dst_branch["data"]["branch_name"];
					
				if($r["status"]== 0){ $status = "Pending"; }else if($r["status"]== 1){ $status = "Completed"; }
			
				$data[] = array(					
					'<a class="vw" href="javascript:void(0);" onclick="edit_stock_trans('.$r["stk_trans_id"].');"> STK'.$r["stk_trans_id"].' </a>',
					date("d-M-Y",strtotime($r["updated_on"])),					
					$src_bname,
					$dst_bname,
					$status,					
					'<i class="fa fa-ellipsis-v act_icn" data-toggle="popover" data-placement="left" tabindex="0" data-trigger="focus" aria-hidden="true" onclick="edit_stock_trans('.$r["stk_trans_id"].');"></i>'
				);
			}
		}

		$result = array(
			"draw" => $draw,
			"start" => $start,
			"length" => $limit,
			"recordsTotal" => count($stock_trans),
			"recordsFiltered" => (count($stock_trans)>0)?$stock_trans[0]["tot_filter_rec"]:0,
			"data" => $data,
			"tot_pending" => ($allcounts["tot_pending"]==null)? 0 : $allcounts["tot_pending"],
			"tot_completed" => ($allcounts["tot_completed"]==null)? 0 : $allcounts["tot_completed"]
		);		
		//print_r($result);exit;
		echo json_encode($result);
		exit();
	}
	
	public function checkProductQty()
	{
		echo $response = $this->Stocktransfer_model->getBranchProductQty($_POST);
	}
	
	// Add StockTransfer
	public function add()
	{
		//print_r($_POST);exit;
		$posts = array('source_branch' => $_POST["src_branch"],
			'destination_branch' => $_POST["dst_branch"],
			'transport_charge' => $_POST["hid_trans_chrg"],
			'upload_charge' => $_POST["hid_upload_chrg"],
			'loading_charge' => $_POST["hid_loading_chrg"]		
			);
		$response = $this->Stocktransfer_model->insert($posts);
		$final_res = json_decode($response,true);
		if($final_res["status"] == "success")
		{
			$insert_id = $final_res["insert_id"];
			
			for($p = 0;$p < count($_POST["prod"]);$p++)
			{
				$stock_posts = array('stk_trans_id' => $insert_id,
				'product_id' => $_POST["hid_prod"][$p],
				'prod_qty' => $_POST["qty"][$p]
				);
				$res = $this->Stocktransfer_model->insert_transfer_product($stock_posts);
			}
		}
		echo $response;
	}
	public function update()
	{
		print_r($_POST);exit;	
		$stk_trans_id = $_POST["hid_stk_trans_id"];
		$stock_trans = $this->Stocktransfer_model->getStockTransferDetails($stk_trans_id);
		$res_trans = json_decode($stock_trans,true);
		$tot_prev_amt = $res_trans["data"]["transport_charge"]+$res_trans["data"]["loading_charge"];
		$upd_tot_amt = $_POST["hid_trans_chrg"]+$_POST["hid_loading_chrg"];
		
		$posts = array('source_branch' => $_POST["src_branch"],
			'destination_branch' => $_POST["dst_branch"],
			'transport_charge' => $_POST["hid_trans_chrg"],
			'upload_charge' => $_POST["hid_upload_chrg"],
			'loading_charge' => $_POST["hid_loading_chrg"]		
			);
		$response = $this->Stocktransfer_model->updateStockTransfer($stk_trans_id,$posts);
		$final_res = json_decode($response,true);
		if($final_res["status"] == "success")
		{
			if($tot_prev_amt != $upd_tot_amt)
			{
				$admin_id = $this->session->userdata('adminid');
				$branch_data = json_decode($this->Branch_model->cashbalance_by_userid($admin_id),true);	
				$branch_id = $branch_data["data"]["branch_id"];
				//$branch_data["data"]["amount"];
				if($tot_prev_amt > $upd_tot_amt)
				{
					$final_amt = $branch_data["data"]["amount"] + ($tot_prev_amt - $upd_tot_amt);
					
				}else if($tot_prev_amt < $upd_tot_amt){
					
					$final_amt = $branch_data["data"]["amount"] - ($upd_tot_amt - $tot_prev_amt);
				}		
				$upd_cash = $this->Loans_model->updateAdminCashAmount($branch_id,$final_amt);
			}
			
			//Check with previous prod to del
			$prev_pids = explode(",",$_POST["hid_prev_pid"]);
			$upd_pids = $_POST["hid_prod"];
			foreach($prev_pids as $pid)
			{
				if(in_array($pid, $upd_pids))
				{
					//echo "Match found";
				}
				else
				{
					
					//echo "Match not found";
				}
			}
			
		}
		
		echo $response;
	}
}
?>