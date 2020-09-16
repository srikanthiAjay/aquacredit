<?php defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Receipts extends CI_Controller 
{
	function __construct()
	{	
		parent::__construct();
		
		$this->load->library('session');		
		$this->load->model('api/Admin_model');	
		$this->load->model('api/Cash_model');
		$this->load->model('api/Users_model');	
		$this->load->model('api/Loans_model');	
		$this->load->model('api/Traders_model');	
		$this->load->model('api/Branch_model');	
		$this->load->model('api/Banks_model');	
		$this->load->model('api/Receipts_model');	
		$this->load->model('api/Transaction_model');		
		
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
		echo $response = $this->Receipts_model->getReceiptDetails($rc_id);
	}
	
	public function get_receipts()
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
		$searchByTransType = $_POST['trans_opt'];
		$reportRange = $_POST['reportrange'];
		$tabval = $_POST['tabval'];
		$utype_opt = $_POST['utype_opt'];
		
		## Search	

		$allcounts = $this->Receipts_model->receiptsAnalytics();
	       
		$receipts =  $this->Receipts_model->receipts_search($limit,$start,$tabval,$searchValue,$reportRange,$searchByTransType,$utype_opt,$order,$dir);      
		
		$data = [];
		
		if(count($receipts)>0)
		{
			foreach($receipts as $r) {
				
				$guest = "";
				//$transfer_amt = $this->IND_money_format($r["transfer_amount"]);
				$transfer_amt = IND_money_format($r["transfer_amount"]);
				if($r["transfer_from_type"] == "user")
				{
					$user = json_decode($this->Users_model->getUsersdata($r["from_user_id"]),true);
					$user_name = $user["data"]["user_name"];
					$user_type = $user["data"]["user_type"];
					if($user["data"]["user_type"] == "FARMER"){						
						$img_path = 'http://3.7.44.132/aquacredit/assets/images/f_1.png';				
					}else if($user["data"]["user_type"] == "NON_FARMER")
					{
						$img_path = 'http://3.7.44.132/aquacredit/assets/images/f_3.png';
						$user_type = str_replace("_"," ",$user["data"]["user_type"]);
					}else if($user["data"]["user_type"] == "DEALER")
					{
						$user_name = $user["data"]['owner_name'];
						$img_path = 'http://3.7.44.132/aquacredit/assets/images/f_2.png';				
					}
					$url = base_url().'admin/users/details/';
					
				}else if($r["transfer_from_type"] == "trader"){
					
					$trader = json_decode($this->Traders_model->getTraderDetails($r["from_user_id"]),true);
					if($trader["data"]["trader_type"] == "Agent")
					{
						$user_name = $trader["data"]["full_name"];
					}else if($trader["data"]["trader_type"] == "Exporter"){
						$user_name = $trader["data"]["contact_person"];
					}
					$img_path = 'http://3.7.44.132/aquacredit/assets/images/traders_large.png';
					$user_type = strtoupper($trader["data"]["trader_type"]);
					$url = base_url().'admin/traders/statement/';
				}
				if($r["typeofuser"] == "1")
				{
					$user_type = "GUEST";
				}
				if($r["transfer_type"] == "bank"){ $transfer_type = '<img src="'.base_url().'assets/images/bank_tansfer.png" width="25">';}
				else if($r["transfer_type"] == "cash"){ $transfer_type = '<img src="'.base_url().'assets/images/cash_icn.png" width="25">';}
			
				$data[] = array(					
					'<a class="vw" href="javascript:void(0);" onclick="edit_receipt('.$r["rc_id"].');"> RCP'.$r["rc_id"].' </a>',
					date("d-M-Y",strtotime($r["receipt_date"])),
					//'<img src="'.$img_path.'" width="20" alt="" title="" /> <a href="#" title="" >'.$user_name.'</a> ',
					'<a href="'.$url.$r["from_user_id"].'" title="" target="_blank" >'.$user_name.'</a> ',
					$user_type,
					'₹'.$transfer_amt,
					$transfer_type,					
					'<img src="'.base_url().'/assets/images/grn_ar.png" width="20" alt="" title="">',
					'<i class="fa fa-ellipsis-v act_icn" data-id = "'.$r["rc_id"].'" data-toggle="popover" data-placement="left" tabindex="0" data-trigger="focus" aria-hidden="true"></i>'
				);
			}
		}
		

		$result = array(
			"draw" => $draw,
			"start" => $start,
			"length" => $limit,
			"recordsTotal" => count($receipts),
			"recordsFiltered" => (count($receipts)>0)?$receipts[0]["tot_filter_rec"]:0,
			"data" => $data,
			"tot_user_amt" => ($allcounts["tot_user_amt"]==null)? 0 : $allcounts["tot_user_amt"],
			"tot_trader_amt" => ($allcounts["tot_trader_amt"]==null)? 0 : $allcounts["tot_trader_amt"],
			"farmer_amt" => ($allcounts["farmer_sum"]==null)? 0 : $allcounts["farmer_sum"],
			"non_farmer_amt" => ($allcounts["nonfarmer_sum"]==null)? 0 : $allcounts["nonfarmer_sum"],
			"dealer_amt" => ($allcounts["dealer_sum"]==null)? 0 : $allcounts["dealer_sum"],
			"guest_amt" => ($allcounts["guest_sum"]==null)? 0 : $allcounts["guest_sum"],
			"agent_amt" => ($allcounts["agent_sum"]==null)? 0 : $allcounts["agent_sum"],
			"exporter_amt" => ($allcounts["exporter_sum"]==null)? 0 : $allcounts["exporter_sum"]
		);		
		//print_r($result);exit;
		echo json_encode($result);
		exit();
	}
	
	/* public function checktradername()
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
	} */

	// Add Traders
	public function add()
	{
		//print_r($_POST);exit;
		$crop_id = "";
		// Admin bank details
		$admin_bank = "";
		$res_bank_details = "";
		/* if($_POST["trans_type"] == "bank")
		{ */
			$admin_bank = $_POST["admin_bank"];
			$admin_bank_details = json_decode($this->Banks_model->getCashAccounts($admin_bank),true);					
			$res_bank_details = $admin_bank_details["data"]["bank_name"].", ".$admin_bank_details["data"]["account_no"].", ".$admin_bank_details["data"]["bank_ifsc"];
		/* } */
		
		if($_POST["select_usertype"] == "FARMER"){ $crop_id = $_POST["crop_opt"];}
		
		$posts = array('transfer_type' => $_POST["trans_type"],
			'receipt_date' => date('Y-m-d',strtotime($_POST['receipt_date'])),
			'admin_bank_id' => $admin_bank,
			'admin_bank_details' => $res_bank_details,
			'transfer_amount' => $_POST["receipt_amt"],
			'transfer_from_type' => $_POST["user_type"],
			'from_user_id' => $_POST["selectuser_id"],
			'from_crop_id' => $crop_id,
			'reference_no' => $_POST["ref_no"],
			'receipt_note' => $_POST["rece_note"]			
			);		
		$response = $this->Receipts_model->insert($posts);
		$final_res = json_decode($response,true);
		if($final_res["status"] == "success")
		{
				$this->db->set('avail_amount', 'avail_amount + '.$_POST["receipt_amt"].'',false);
				$this->db->set('updated_on', date('Y-m-d H:i:s'));
				$this->db->where('id', $admin_bank);
				$query = $this->db->update('accounts');

				/*echo $this->db->last_query();
				exit;*/
				if($query)
				{
					/*insert cashbook*/
					$admin_bank_details = json_decode($this->Banks_model->getCashAccounts($admin_bank),true);

					$cash = array(
						"trans_type" 	=> "Receipt",
						"trans_id"		=> $final_res["insert_id"],
						"amount"		=>	$_POST["receipt_amt"],
						"amount_type"	=>	"IN",
						"account_type"	=>	$_POST["trans_type"],
						"account_id"	=> $admin_bank,
						"avl_bal"		=> $admin_bank_details["data"]["avail_amount"],
						"admin_id"	=>	$this->session->userdata('adminid'),
					);
					$this->Cash_model->insert($cash);
					/*insert cashbook*/
				}
				
			/* }else if($_POST["trans_type"] == "cash")
			{			
				$admin_id = $this->session->userdata('adminid');
				$branch_data = json_decode($this->Branch_model->cashbalance_by_userid($admin_id),true);
				
				$branch_id = $branch_data["data"]["branch_id"];
				$final_amt = $branch_data["data"]["amount"] + $_POST["receipt_amt"];
				$upd_cash = $this->Loans_model->updateAdminCashAmount($branch_id,$final_amt);
			} */
			//insert transaction
			$data = array(
				"trans_type" 	=> "RECEIPT", 
				"trans"			=> $_POST["trans_type"],
				"trans_id"		=> $final_res["insert_id"],
				"trans_code"	=> 'RC'.$final_res["insert_id"],
				"user_id"		=>  $_POST["selectuser_id"],
				"user_type"		=>	$_POST["select_usertype"],
				"crop_id"		=> 	$_POST["crop_opt"],
				"amount"		=>	$_POST["receipt_amt"],
				"amount_type"	=>	"IN",
				"description"	=>	"Recevied",
				"status"		=>	"0",
				"created_by"	=>	$this->session->userdata('adminid'),
			);
			$this->Transaction_model->insert($data);			
		}
		echo $response;
		
	}	
		
	/* public function update()
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
	} */

	public function delete()
	{
		$rc_id = $_POST["rc_id"];
		
		$receipts = $this->Receipts_model->getReceiptDetails($rc_id);
		$final_res = json_decode($receipts,true);
	
		if($final_res["status"] == "success")
		{
			$transfer_type = $final_res["data"]["transfer_type"];
			if($transfer_type=="bank")
			{
				$upd_account = json_decode($this->Cash_model->updateAdminAccount($final_res["data"]["admin_bank_id"],$final_res["data"]["transfer_amount"]));
				$account_amount = $upd_account->avl_bal;
			}
			else if($transfer_type=="cash")
			{
				$upd_account = json_decode($this->Cash_model->updateAdminAccount($final_res["data"]["admin_bank_id"],$final_res["data"]["transfer_amount"]));
				$account_amount = $upd_account->avl_bal;
			}

			//update in transactions
			$array = [
				'deleted'   => '1',
				'deleted_on'  => date('Y-m-d'),
				'deleted_by' => $this->session->userdata('adminid')
			];
			$this->db->set($array);
			$this->db->where('trans_type', "RECEIPT");
			$this->db->where('trans_id', $rc_id);
			$this->db->update('transactions');
		}
		
		$posts = array('deleted' => 1);	
		echo $response = $this->Receipts_model->updateReceipt($rc_id,$posts);
		
		//echo $response = $this->Receipts_model->deleteReceipt($rc_id);
		
	}
}
?>