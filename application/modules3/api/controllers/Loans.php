 <?php defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Loans extends CI_Controller 
{
	function __construct()
	{	
		parent::__construct();
		
		$this->load->library('session');
		//$this->load->helper('currency_helper');
		$this->load->model('api/Admin_model');	
		$this->load->model('api/Loans_model');
		$this->load->model('api/Crops_model');
		$this->load->model('api/Users_model');
		$this->load->model('api/Branch_model');
		$this->load->model('api/Banks_model');
		$this->load->model('api/Transaction_model');
		$this->load->model('api/Cash_model');
		
		setlocale(LC_MONETARY, 'en_IN');		
		
		header('Access-Control-Allow-Origin: *');
	}

	//Index function
	public function index($lid = "")
	{		
		echo $response = $this->Loans_model->getLoansdata($lid);
	}
	
	public function loandetails($lid)
	{
		echo $response = $this->Loans_model->getLoanDetails($lid);
	}

	public function getLoanTypeByLoan($lid = "")
	{		
		echo $response = $this->Loans_model->getLoanTypeByLoan($lid);
	}

	/* public function IND_money_format($number){    	
        $decimal = (string)($number - floor($number));
        $money = floor($number);
        $length = strlen($money);
        $delimiter = '';
        $money = strrev($money);
 
        for($i=0;$i<$length;$i++){
            if(( $i==3 || ($i>3 && ($i-1)%2==0) )&& $i!=$length){
                $delimiter .=',';
            }
            $delimiter .=$money[$i];
        }
 
        $result = strrev($delimiter);
        $decimal = preg_replace("/0\./i", ".", $decimal);
        $decimal = substr($decimal, 0, 3);
 
        if( $decimal != '0'){
            $result = $result.$decimal;
        }
 
        return $result;
    } */
	public function getloans()
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
		$searchByTransType = $_POST['trans_opt'];		
		$searchByLoan = $_POST['loan_opt'];		
		$searchByStatus = $_POST['status_opt'];		
		$reportRange = $_POST['reportrange'];		
		$fromDate = $_POST['from_date'];		
		$toDate = $_POST['to_date'];		
		$tabval = $_POST['tabval'];		
		
		$allcounts = $this -> Loans_model->loansAnalytics();
		
		//print_r($allcounts);exit;
		
		## Search       month_opt
		$loans =  $this->Loans_model->loans_search($limit,$start,$tabval,$searchValue,$searchByMonth,$fromDate,$toDate,$reportRange,$searchByLoan,$searchByTransType,$searchByStatus,$columnName,$dir);	       
        
		//
		//print_r($brands);exit;
		$data = [];
		if(count($loans)>0)
		{
			foreach($loans as $r) {
				
				$loan_amt = IND_money_format($r["loan_amt"]);
				
				if($r["status"] == 0){ $status = 'Pending'; }				
				else if($r["status"] == 1){ $status = '<i class="fa fa-check stat_com" aria-hidden="true"></i>'; }
				else if($r["status"] == 2){ $status = '<i class="fa fa-times red_clr" aria-hidden="true"></i>';}
				
				if($r["status"] == 1 || $r["status"] == 2){ $approve_date = date("d-M-Y",strtotime($r["loan_status_date"])); }
				else{ $approve_date = "N/A"; }
				
				if($r["transfer_type"] == "bank"){ $transfer_type = '<img src="'.base_url().'assets/images/bank_tansfer.png" width="25">';}
				else if($r["transfer_type"] == "cash"){ $transfer_type = '<img src="'.base_url().'assets/images/cash_icn.png" width="25">';}
				
				$user = json_decode($this->Users_model->getUsersdata($r["user_id"]),true);
				$user_name = $user["data"]["user_name"];
				$user_id = $user["data"]["user_id"];

				$user_credit = $this->Users_model->getUserdata($r["user_id"],"credit_limit");
				if($user_credit == "0.00" || $user_credit == null)
				{
					$aval_credit = "NA";
				}
				else
				{
					$approved_loans = $this->Loans_model->getTotalLoansOfUser($r["user_id"]);
					$aval_credit = $user_credit - $approved_loans;
					$aval_credit = IND_money_format($aval_credit);

				}
				
				$crop = json_decode($this->Crops_model->getCropsdata($r["crop_id"]),true);
				$crop_name = $crop["data"]["crop_location"];
				$crop_acres = $crop["data"]["no_of_acres"]." Acres";
				if($crop_name == ""){ $crop_name = "N/A"; $crop_acres = "";} 
				
				if($r["loan_type"] == 0){ $loan_type_name = "N/A"; }
				else{
					$loan_type = json_decode($this->Loans_model->getLoanTypes($r["loan_type"]),true);
					$loan_type_name = $loan_type["data"]["loan_type"];
				}
				
				
			   $data[] = array(	'<input type="checkbox" onclick="stopPropagation(event)">',				
					'<a class="vw" href="javascript:void(0);" onclick="loan_upd('.$r["loan_id"].','.$r["status"].');"> LN'.$r["loan_id"].' </a>',
					$approve_date,
					'<a href="'.base_url().'admin/users/details/'.$user_id.'" target="_blank" title="" >'.$user_name.'</a>
						<ul class="usr_sub_dtl"> 
                    <li>Available Credit: '.$aval_credit.' </li>
                    <li> | </li>
                    <li>Feed & Medicine Usage: 1000 </li>
                    <li> | </li>
                    <li>Harvest Given: 10,000 </li>
                     </ul>',
					'<span class="loc_td">'.$crop_name.'</span> <span class="acrs_td">'.$crop_acres.'</span>',
					$transfer_type,
					$loan_type_name,
					'₹'.$loan_amt,
					$status,
					'<i class="fa fa-ellipsis-v act_icns" data-toggle="popover" data-placement="left" tabindex="0" data-trigger="focus" aria-hidden="true" data-original-title="" title="" onclick="edit_loan('.$r["loan_id"].','.$r["status"].');"></i>'
			   );
			}
		}

		$result = array(
			"draw" => $draw,
			"start" => $start,
			"length" => $limit,
			"recordsTotal" => count($loans),
			"recordsFiltered" => ($loans[0]["tot_filter_rec"]!="")?$loans[0]["tot_filter_rec"]:0,
			//"recordsFiltered" => count($loans),
			"data" => $data,
			"pending" => ($allcounts["pending"]==null)? 0 : $allcounts["pending"],
			"approved" => ($allcounts["approved"]==null)? 0 : $allcounts["approved"],
			"rejected" => ($allcounts["rejected"]==null)? 0 : $allcounts["rejected"],
			"drafts" => ($allcounts["drafts"]==null)? 0 : $allcounts["drafts"],
			"approved_amt" => ($allcounts["approved_amt"]==null)? 0 : $allcounts["approved_amt"],
			"rej_amt" => ($allcounts["rej_amt"]==null)? 0 : $allcounts["rej_amt"],
			"pending_amt" => ($allcounts["pending_amt"]==null)? 0 : $allcounts["pending_amt"],
			"draft_amt" => ($allcounts["draft_amt"]==null)? 0 : $allcounts["draft_amt"]
		);	
		//print_r($result);exit;
		echo json_encode($result);
		exit();
	}	
	
	// Add Loan
	public function add()
	{
		$admin_id = $this->session->userdata('adminid');
		$res_userbank_details = "";
		if($_POST["act_types"] == "bank"){ 
			$brc = "B";
			$user_bank = $_POST["bank_opt"];
			$user_bank_details = json_decode($this->Banks_model->getUserBanksdata($user_bank),true);
			$res_userbank_details = $user_bank_details["data"]["full_name"].", ".$user_bank_details["data"]["account_no"].", ".$user_bank_details["data"]["bank_name"].", ".$user_bank_details["data"]["ifsc"].$user_bank_details["data"]["branch_name"];
		}else if($_POST["act_types"] == "cash"){ $brc = "C"; $user_bank = "";}
		
		$loancode = strtoupper("LN".$brc).strtotime("now");
		$posts = array('admin_id' =>$admin_id,
			'loan_code' =>$loancode,
			'user_id' =>$_POST["selectuser_id"],
			'usercode' => $_POST["select_usercode"],
			'crop_id' => $_POST["crop_opt"],
			'loan_amt' => $_POST["loan_amt"],
			'user_bank_id' => $user_bank,
			'user_bank_details' => $res_userbank_details,
			'transfer_type' => $_POST["act_types"]
			);		
		$response = $this->Loans_model->insert($posts);
		$final_res = json_decode($response,true);
		echo $response;
		
	}
	
	/* public function cat_subcat_add()
	{		
		if($_POST["hid_frm"] == "c"){ 
			
			$posts = array('cat_name' => urldecode($_POST["cat_name"]),
			'cat_desc' => urldecode($_POST["cat_desc"]),
			'level' => 1,
			'status' => 1
			);
		}
		else if($_POST["hid_frm"] == "sc"){ 
			
			$posts = array('cat_name' => urldecode($_POST["subcat_name"]),
			'subcat_desc' => urldecode($_POST["subcat_desc"]),
			'parent_id' => $_POST["catopt"],
			'level' => 2,
			'status' => 1
			);
		}
		echo $response = $this->Categories_model->insert($posts);
	}
	
	public function checkcategory()
	{		
		$final_res = json_decode($this->Categories_model->check_category_name($_POST["catname"]),true);
		if($final_res["status"] == "exists" ){	echo 1; }else{ echo 0;}
		exit;
	}
	
	public function checkbrandname()
	{		
		$final_res = json_decode($this->Brands_model->check_brand_name($_POST["brand_name"]),true);
		if($final_res["status"] == "exists" ){	echo 1; }else{ echo 0;}
		exit;
	} */

	public function update_above()
	{
		$loan_id = $_POST["hid_lid"]; 
		if($_POST["act_types_edit"]=="bank")
			{
				$user_bank = $_POST["bank_opt_edit"];
				$user_bank_details = json_decode($this->Banks_model->getUserBankById($user_bank),true);
				
				$res_userbank_details = $user_bank_details["data"]["full_name"].", ".$user_bank_details["data"]["account_no"].", ".$user_bank_details["data"]["bank_name"].", ".$user_bank_details["data"]["ifsc"].", ".$user_bank_details["data"]["branch_name"];			
				
			} else if($_POST["act_types_edit"]=="cash")
			{
				$user_bank = "";
			}
		
			$posts = array('user_id' =>$_POST["selectuser_id_edit"],
				'usercode' => urldecode($_POST["select_usercode_edit"]),
				'crop_id' => $_POST["crop_opt_edit"],
				'loan_amt' => $_POST["loan_amt_edit"],
				'user_bank_id' => $user_bank,
				'user_bank_details' => $res_userbank_details,
				'transfer_type' => $_POST["act_types_edit"],
				//'loan_remarks' => $_POST["rema_narr"],
				'updated_on' => date('Y-m-d H:i:s')
				);	
				//print_r($posts); exit;
				//echo $loan_id; exit;
			$response = $this->Loans_model->updateLoan($loan_id,$posts);	
			//echo $this->db->last_query(); exit;
			echo $response;	
	}
	
		
	public function update()
	{
		//echo $_POST["act_types_edit"];
		//print_r($_POST);
		//echo $start_date = date('Y-m-d',strtotime($_POST['start_date']));exit;
		$loan_id = $_POST["hid_lid"];
		$res_userbank_details = "";
		
			$posts = array('loan_remarks' => $_POST["rema_narr"],
				'updated_on' => date('Y-m-d H:i:s')
				);	
			$response = $this->Loans_model->updateLoan($loan_id,$posts);
			$res_bank_details = $start_date = $end_date = "";
			
			if($_POST['start_date'] != ""){ $start_date = date('Y-m-d',strtotime($_POST['start_date']));
			if($start_date == "1970-01-01"){ $start_date = "";} }
			if($_POST['end_date'] != ""){ $end_date = date('Y-m-d',strtotime($_POST['end_date'])); 
			if($end_date == "1970-01-01"){ $end_date = "";} }
						
			if($_POST["act_types_edit"]=="bank")
			{					
				$admin_bank = $_POST["admin_bank"];
				$admin_bank_details = json_decode($this->Banks_model->getBanksdata($admin_bank),true);
				
				$res_bank_details = $admin_bank_details["data"]["account_name"].", ".$admin_bank_details["data"]["account_number"].", ".$admin_bank_details["data"]["ifsc_code"];				
				
			}else if($_POST["act_types_edit"]=="cash")
			{					
				$admin_bank = $_POST["admin_cash"];
				$admin_bank_details = json_decode($this->Banks_model->getBanksdata($admin_bank),true);

				$res_bank_details = $admin_bank_details["data"]["account_name"];		
			}
				
			$activity_posts = array('loan_id' => $loan_id,
			'start_date' => $start_date,
			'end_date' => $end_date,
			'admin_bank' => $admin_bank,
			'admin_bank_details' => $res_bank_details,
			'loan_type' => $_POST["loan_type"],
			'rate_of_interest' => $_POST["roi"],
			'withdrawal_amt' => $_POST["loan_amt_edit"],
			'narration' => $_POST["rema_narr"],
			'ref_no' => $_POST["ref_no"]		
			);
			
			if($_POST["hid_acivity_id"] > 0)
			{
				$loan_act_id = $_POST["hid_acivity_id"];
				$activity_posts["updated_on"] = date('Y-m-d H:i:s');
				$act_res = $this->Loans_model->updateLoanActivity($loan_act_id,$activity_posts);
				
			}else if($_POST["hid_acivity_id"] == 0)
			{
				$act_res = $this->Loans_model->insertLoanActivity($loan_id,$activity_posts);
				//$act_final = json_decode($act_res,true);
			}
			
			if($_POST["hid_appove"] == 1)
			{	
				//check for credit limit before approving
				$user_credit = $this->Users_model->getUserdata($_POST["selectuser_id_edit"],"credit_limit");
				if($user_credit != null)
				{
					$approved_loans = $this->Loans_model->getTotalLoansOfUser($_POST["selectuser_id_edit"]);
					 $aval_credit = $user_credit - $approved_loans;
					if($aval_credit <= 0)
					{
						echo json_encode(array('status' => 'false', 'message' => 'Credit Limit Exceded'));
						exit;
					}
					$request_loan = $_POST["loan_amt_edit"];
					if($aval_credit < $request_loan)
					{
						echo json_encode(array('status' => 'false', 'message' => 'Insufficent Credit'));
						exit;
					}
				}		
				
				$posts = array('status' => '1', 'loan_type' => $_POST["loan_type"],'loan_status_date' => date('Y-m-d H:i:s'),'updated_on' => date('Y-m-d H:i:s'));
				$response = $this->Loans_model->updateLoan($loan_id,$posts);
				$res = json_decode($response,true);
				if($res["status"] == "success")
				{
					if($_POST["act_types_edit"]=="bank")
					{
						$upd_account = json_decode($this->Loans_model->updateAdminAccount($_POST["admin_bank"],$_POST["loan_amt_edit"]));
						$account_amount = $upd_account->avl_bal;
					}
					else if($_POST["act_types_edit"]=="cash")
					{
						$upd_account = json_decode($this->Loans_model->updateAdminAccount($_POST["admin_cash"],$_POST["loan_amt_edit"]));
						$account_amount = $upd_account->avl_bal;
					}
					//insert transaction
					$data = array(
						"trans_type" 	=> "Loan",
						"trans_id"		=> $loan_id,
						"trans_code"	=> 'LN'.$_POST["hid_lid"],
						"user_id"		=>  $_POST["selectuser_id_edit"],
						"user_type"		=>	$_POST["hid_user_type"],
						"crop_id"		=> 	$_POST["hid_crop_id"],
						"amount"		=>	$_POST["loan_amt_edit"],
						"amount_type"	=>	"OUT",
						"description"	=>	"Loan Approved",
						"status"		=>	"0",
						"created_by"	=>	$this->session->userdata('adminid'),
					);
					$this->Transaction_model->insert($data);

					//cashflow
					$cash = array(
						"trans_type" 	=> "Loan",
						"trans_id"		=> $loan_id,
						"amount"		=>	$_POST["loan_amt_edit"],
						"amount_type"	=>	"OUT",
						"account_type"	=>	$_POST["act_types_edit"],
						"account_id"	=> $admin_bank,
						"avl_bal"		=> $account_amount,
						"admin_id"	=>	$this->session->userdata('adminid'),
					);
					$this->Cash_model->insert($cash);					
				}
			}
		
		echo $response;		
	}
	
	public function approve()
	{
		print_r($_POST);exit;
		$loan_id = $_POST["hid_lid"];
		
		$activity_posts = array('loan_id' => $loan_id,
			'start_date' => $_POST["start_date"],
			'end_date' => $_POST["end_date"],
			'admin_bank' => $_POST["admin_bank"],
			'loan_type' => $_POST["loan_type"],
			'rate_of_interest' => $_POST["roi"],
			'ref_no' => $_POST["ref_no"],			
			'narration' => $_POST["rema_narr"]			
			);
		$act_res = $this->Loans_model->insertLoanActivity($loan_id,$activity_posts);
		$act_final = json_decode($act_res,true);
		
		if($act_final["status"] == "success")
		{
			$posts = array('status' => '1', 'loan_type' => $_POST["loan_type"],'loan_status_date' => date('Y-m-d H:i:s'),'updated_on' => date('Y-m-d H:i:s'));
			echo $response = $this->Loans_model->updateLoan($loan_id,$posts);
			
		}else{
			echo json_encode(array('status' => 'fail'));
		}
	}
	
	public function reject()
	{
		//print_r($_POST);exit;
		$loan_id = $_POST["lid"];
		$posts = array('status' => '2','loan_status_date' => date('Y-m-d H:i:s'));		
			
		echo $response = $this->Loans_model->updateLoan($loan_id,$posts);
	}

	public function delete()
	{
		$bid = $_POST["lid"];		
		echo $response = $this->Loans_model->deleteLoan($bid);
		
	}
}
?>