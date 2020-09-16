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
		$branch_id = "";
		$admin_id = $this->session->userdata('adminid');
		$branch_data = json_decode($this->Branch_model->cashbalance_by_userid($admin_id),true);	
		if(count($branch_data["data"]) > 0){
			$branch_id = $branch_data["data"]["branch_id"];			
		}
		
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

		$allcounts = $this->Stocktransfer_model->StockTransferAnalytics($branch_id);
	       
		$stock_trans =  $this->Stocktransfer_model->stock_transfer_search($limit,$start,$branch_id,$searchValue,$searchByStatus,$reportRange,$order,$dir);      
		
		$data = [];

		if(count($stock_trans)>0)
		{
			foreach($stock_trans as $r) {				
				
				$src_branch = json_decode($this->Branch_model->getBranchdata($r["source_branch"]),true);
				$src_bname = $src_branch["data"]["branch_name"];	
				$dst_branch = json_decode($this->Branch_model->getBranchdata($r["destination_branch"]),true);
				$dst_bname = $dst_branch["data"]["branch_name"];
					
				if($r["status"]== 0){ $status = "Pending"; $new_class = "act_icn";}
				else if($r["status"]== 1){ $status = "Completed"; $new_class = "vw_icn"; }
			
				$data[] = array(					
					'<a class="vw" href="javascript:void(0);" onclick="edit_stock_trans('.$r["stk_trans_id"].','.$r["status"].');"> STK'.$r["stk_trans_id"].' </a>',
					date("d-M-Y",strtotime($r["updated_on"])),					
					$src_bname,
					$dst_bname,
					$status,					
					'<i class="fa fa-ellipsis-v '.$new_class.'" data-toggle="popover" data-placement="left" tabindex="0" data-trigger="focus" aria-hidden="true" onclick="edit_stock_trans('.$r["stk_trans_id"].','.$r["status"].');"></i>'
				);
				$n++;
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
		$admin_id = $this->session->userdata('adminid');
		/* $branch_data = json_decode($this->Branch_model->cashbalance_by_userid($admin_id),true);	
		$branch_id = $branch_data["data"]["branch_id"]; */
		$branch_id = $_POST["src_branch"];
		$posts = array('creator_id' => $admin_id,
			'source_branch' => $_POST["src_branch"],
			'destination_branch' => $_POST["dst_branch"],
			'transport_charge' => $_POST["hid_trans_chrg"],
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
				
				$final_qty = $_POST["qty"][$p];
				$this->Stocktransfer_model->updProdcutInventoryQty($branch_id,$_POST["hid_prod"][$p],$final_qty,'n');
			}
		}
		echo $response;
	}
	public function update()
	{		
		//print_r($_POST);exit;
		$admin_id = $this->session->userdata('adminid');
		$stk_trans_id = $_POST["hid_stk_trans_id"];
		$stock_trans = $this->Stocktransfer_model->getStockTransferDetails($stk_trans_id);
		$res_trans = json_decode($stock_trans,true);
		$tot_prev_amt = $res_trans["data"]["transport_charge"]+$res_trans["data"]["loading_charge"];
		$upd_tot_amt = $_POST["hid_trans_chrg"]+$_POST["hid_loading_chrg"];
		
		$branch_id = $_POST["src_branch"];
		$prev_branch_id = $res_trans["data"]["source_branch"];
		
		if($_POST["role"] == "SA")
		{
			$posts = array('source_branch' => $_POST["src_branch"],
				'destination_branch' => $_POST["dst_branch"],
				'transport_charge' => $_POST["hid_trans_chrg"],
				'loading_charge' => $_POST["hid_loading_chrg"],
				'desti_trans_charge' => $_POST["desti_trans_chrg"],
				'unload_charge' => $_POST["hid_unload_chrg"],
				'updater_id' => $admin_id
			);
		}else{
			$posts = array('source_branch' => $_POST["src_branch"],
				'destination_branch' => $_POST["dst_branch"],
				'transport_charge' => $_POST["hid_trans_chrg"],
				'loading_charge' => $_POST["hid_loading_chrg"],
				'updater_id' => $admin_id
			);
		}
		$response = $this->Stocktransfer_model->updateStockTransfer($stk_trans_id,$posts);
		$final_res = json_decode($response,true);
		if($final_res["status"] == "success")
		{
			/* $admin_id = $this->session->userdata('adminid');
			$branch_data = json_decode($this->Branch_model->cashbalance_by_userid($admin_id),true);	
			$branch_id = $branch_data["data"]["branch_id"]; */
			
			if($tot_prev_amt != $upd_tot_amt)
			{				
				//$branch_data["data"]["amount"];
				if($tot_prev_amt > $upd_tot_amt)
				{
					$upd_amt = $tot_prev_amt - $upd_tot_amt; $p_n = "p";
					//$final_amt = $branch_data["data"]["amount"] + $upd_amt;
					
				}else if($tot_prev_amt < $upd_tot_amt){
					
					$upd_amt = $upd_tot_amt - $tot_prev_amt; $p_n = "n";
					//$final_amt = $branch_data["data"]["amount"] - $upd_amt;
				}		
				//$upd_cash = $this->Loans_model->updateAdminCashAmount($branch_id,$final_amt);
				$upd_cash = $this->Stocktransfer_model->updateBranchCashAmount($branch_id,$upd_amt,$p_n);
			}
			
			//Check with previous prod to del
			$prev_pids = explode(",",$_POST["hid_prev_pid"]);
			$upd_pids = $_POST["hid_prod"];
			$prev_qty = explode(",",$_POST["hid_prev_qty"]);
			$upd_qty = $_POST["qty"];
			
			//foreach($prev_pids as $pid)
			for($p=0;$p<count($prev_pids);$p++)
			{
				//If source branch not change
				if($branch_id == $prev_branch_id)
				{
					$position = array_search($prev_pids[$p],$upd_pids,true);
					if($position >= 0)
					{					
						$pqty = $prev_qty[$p]; $uqty = $upd_qty[$position];
						
						if($pqty != $uqty)
						{						
							$prev_post = array('prod_qty' => $upd_qty[$position]);
							$upd_prev_prod = $this->Stocktransfer_model->updateTransProd($stk_trans_id,$prev_pids[$p],$prev_post);						
							
							if($pqty > $uqty)
							{ 
								$final_qty = $pqty - $uqty;
								$this->Stocktransfer_model->updProdcutInventoryQty($branch_id,$prev_pids[$p],$final_qty,'p');
							}
							else if($pqty < $uqty)
							{	
								$final_qty = $uqty - $pqty;
								$this->Stocktransfer_model->updProdcutInventoryQty($branch_id,$prev_pids[$p],$final_qty,'n');
								
							}
						}
					}
					else
					{
						//Delete product not existing on update
						$del_prev_prod = $this->Stocktransfer_model->deleteTransProd($stk_trans_id,$prev_pids[$p]);
						$final_qty = $prev_qty[$p];
						$this->Stocktransfer_model->updProdcutInventoryQty($branch_id,$prev_pids[$p],$final_qty,'p');				
					}
					
				}else if($branch_id != $prev_branch_id)
				{
					//Delete product not existing on update
						$del_prev_prod = $this->Stocktransfer_model->deleteTransProd($stk_trans_id,$prev_pids[$p]);
						$final_qty = $prev_qty[$p];
						$this->Stocktransfer_model->updProdcutInventoryQty($branch_id,$prev_pids[$p],$final_qty,'p');
				}
				
			}
			
			// for new product insert
			for($up=0;$up<count($upd_pids);$up++)			
			{
				if($branch_id == $prev_branch_id)
				{
					if(!in_array($upd_pids[$up], $prev_pids))
					{					
						$stock_posts = array('stk_trans_id' => $stk_trans_id,
						'product_id' => $upd_pids[$up],
						'prod_qty' => $upd_qty[$up]
						);
						$prod_res = $this->Stocktransfer_model->insert_transfer_product($stock_posts);
						
						$final_qty = $upd_qty[$up];
						$this->Stocktransfer_model->updProdcutInventoryQty($branch_id,$upd_pids[$up],$final_qty,'n');
					}
				}else if($branch_id != $prev_branch_id)
				{
					$stock_posts = array('stk_trans_id' => $stk_trans_id,
						'product_id' => $upd_pids[$up],
						'prod_qty' => $upd_qty[$up]
						);
					$prod_res = $this->Stocktransfer_model->insert_transfer_product($stock_posts);
					
					$final_qty = $upd_qty[$up];
					$this->Stocktransfer_model->updProdcutInventoryQty($branch_id,$upd_pids[$up],$final_qty,'n');
				}
			}
			
			if($_POST["role"] =="SA" && $_POST["sa_action"] == "receive")
			{
				$this->receive();
			}
			
		}
		
		echo $response;
	}
	
	public function receive()
	{
		//print_r($_POST);exit;
		$admin_id = $this->session->userdata('adminid');
		$prev_pids = explode(",",$_POST["hid_prev_pid"]);		
		$prev_qty = explode(",",$_POST["hid_prev_qty"]);
		$branch_id = $_POST["hid_dstid"];
			
		$stk_trans_id = $_POST["hid_stk_trans_id"];
		$upd_tot_amt = $_POST["desti_trans_chrg"]+$_POST["hid_unload_chrg"];
		$posts = array('desti_trans_charge' => $_POST["desti_trans_chrg"],
			'unload_charge' => $_POST["hid_unload_chrg"],
			'status' => '1',
			'receiver_id' => $admin_id
			);
		$response = $this->Stocktransfer_model->updateStockTransfer($stk_trans_id,$posts);
		$final_res = json_decode($response,true);
		if($final_res["status"] == "success")
		{
			/* $admin_id = $this->session->userdata('adminid');
			$branch_data = json_decode($this->Branch_model->cashbalance_by_userid($admin_id),true);	
			$branch_id = $branch_data["data"]["branch_id"];
			$final_amt = $branch_data["data"]["amount"] - $upd_tot_amt;
			$upd_cash = $this->Loans_model->updateAdminCashAmount($branch_id,$final_amt); */
			
			$upd_cash = $this->Stocktransfer_model->updateBranchCashAmount($branch_id,$upd_tot_amt,"n");
			
			for($p=0; $p<count($prev_pids); $p++)
			{
				$inven_post = array("branch_id" => $branch_id, "pid" => $prev_pids[$p]);			
				$chk_pro_inventory = json_decode($this->Stocktransfer_model->getBranchProductQty($inven_post),true);
				
				if(count($chk_pro_inventory["data"])>0)
				{
					$final_qty = $prev_qty[$p];
					$this->Stocktransfer_model->updProdcutInventoryQty($branch_id,$prev_pids[$p],$final_qty,'n');
					
				}else{
					
					$inven_post = array("branch_id" => $branch_id, "pid" => $prev_pids[$p], "qty" => $prev_qty[$p]);		
					$this->Stocktransfer_model->insertProductInventoryQty($inven_post);
				}
			}
		}
		echo $response;
	}
	public function delete()
	{
		$stk_trans_id = $_POST["stk_trans_id"];
		
		$stock_trans = $this->Stocktransfer_model->getStockTransferDetails($stk_trans_id);
		$final_res = json_decode($stock_trans,true);
	
		if($final_res["status"] == "success")
		{
			foreach($final_res["products"] as $prod)
			{
				//echo $prod["source_branch"]." => ".$prod["product_id"]." => ".$prod["prod_qty"];
				$del_prev_prod = $this->Stocktransfer_model->deleteTransProd($stk_trans_id,$prod["product_id"]);
				$branch_id = $prod["source_branch"];
				$this->Stocktransfer_model->updProdcutInventoryQty($branch_id,$prod["product_id"],$prod["prod_qty"],'p');
			}
		}
		$posts = array('deleted' => 1);	
		//echo $response = $this->Stocktransfer_model->updateStockTransfer($stk_trans_id,$posts);		
		echo $response = $this->Stocktransfer_model->deleteStockTransfer($stk_trans_id);
		
	}
}
?>