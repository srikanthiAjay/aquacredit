 <?php defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Loans extends CI_Controller 
{
	function __construct()
	{	
		parent::__construct();
		
		$this->load->library('session');		
		$this->load->model('api/Admin_model');	
		$this->load->model('api/Loans_model');
		$this->load->model('api/Crops_model');
		$this->load->model('api/Users_model');
		
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
	public function IND_money_format($number){    	
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
    }
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
		$searchByStatus = $_POST['status_opt'];		
		$tabval = $_POST['tabval'];
		

		$allcounts = $this -> Loans_model->loansAnalytics();
		
		//print_r($allcounts);exit;
		
		## Search       month_opt
		$loans =  $this->Loans_model->loans_search($limit,$start,$tabval,$searchValue,$searchByMonth,$searchByStatus,$columnName,$dir);	       
        
		//
		//print_r($brands);exit;
		$data = [];
		if(count($loans)>0)
		{
			foreach($loans as $r) {
				
				/* $loan_amt = '100000';
				setlocale(LC_MONETARY, 'en_IN');
				$loan_amt = @money_format('%!i', $r["loan_amt"]); */
				$loan_amt = $this->IND_money_format($r["loan_amt"]);
				
				if($r["status"] == 0){ $status = 'Pending'; }				
				else if($r["status"] == 1){ $status = '<i class="fa fa-check stat_com" aria-hidden="true"></i>'; }
				else if($r["status"] == 2){ $status = '<i class="fa fa-times red_clr" aria-hidden="true"></i>';}
				
				if($r["status"] == 1){ $approve_date = date("d-M-Y",strtotime($r["loan_status_date"])); }
				else{ $approve_date = "N/A"; }
				
				if($r["transfer_type"] == "bank"){ $transfer_type = '<img src="'.base_url().'assets/images/bank_tansfer.png" width="25">';}
				else if($r["transfer_type"] == "cash"){ $transfer_type = '<img src="'.base_url().'assets/images/cash_icn.png" width="25">';}
				
				$user = json_decode($this->Users_model->getUsersdata($r["user_id"]),true);
				$user_name = $user["data"]["uname"];
				
				$crop = json_decode($this->Crops_model->getCropsdata($r["crop_id"]),true);
				$crop_name = $crop["data"]["crop_loc"];
				$crop_acres = $crop["data"]["crop_acres"];
				
				if($r["loan_type"] == 0){ $loan_type_name = "N/A"; }
				else{
					$loan_type = json_decode($this->Loans_model->getLoanTypes($r["loan_type"]),true);
					$loan_type_name = $loan_type["data"]["loan_type"];
				}
				
				
			   $data[] = array(	'<input type="checkbox">',				
					'<a class="edt" href="#" onclick="loan_upd('.$r["loan_id"].');"> '.$r["loan_code"].' </a>',
					$approve_date,
					'<a href="#" title="" >'.$user_name.'</a>
						<ul class="usr_sub_dtl"> 
                    <li>Available Credit: ₹ 10,0000 </li>
                    <li> | </li>
                    <li>Feed & Medicine Usage: 1000 </li>
                    <li> | </li>
                    <li>Harvest Given: 10,000 </li>
                     </ul>',
					'<span class="loc_td">'.$crop_name.'</span> <span class="acrs_td">'.$crop_acres.' Acres</span>',
					$transfer_type,
					$loan_type_name,
					$loan_amt,
					$status,
					'<i class="fa fa-ellipsis-v act_icns" data-toggle="popover" data-placement="left" tabindex="0" data-trigger="focus" aria-hidden="true" data-original-title="" title="" onclick="edit_loan('.$r["loan_id"].');"></i>'
			   );
			}
		}

		$result = array(
			"draw" => $draw,
			"start" => $start,
			"length" => $limit,
			"recordsTotal" => count($loans),
			//"recordsFiltered" => $loans[0]["tot_filter_rec"],
			"recordsFiltered" => count($loans),
			"data" => $data,
			"tot_rec" => ($allcounts["tot_rec"]==null)? 0 : $allcounts["tot_rec"],
			"pending" => ($allcounts["pending"]==null)? 0 : $allcounts["pending"],
			"approved" => ($allcounts["approved"]==null)? 0 : $allcounts["approved"],
			"rejected" => ($allcounts["rejected"]==null)? 0 : $allcounts["rejected"],
			"pending_amt" => ($allcounts["pending_amt"]==null)? 0 : $allcounts["pending_amt"]
		);		
		//print_r($result);exit;
		echo json_encode($result);
		exit();
	}	
	
	// Add Loan
	public function add()
	{
		if($_POST["act_types"] == "bank"){ $brc = "B";}else if($_POST["act_types"] == "cash"){ $brc = "C"; }
		$loancode = strtoupper("LN".$brc).strtotime("now");
		$posts = array('loan_code' =>$loancode,
			'user_id' =>$_POST["selectuser_id"],
			'usercode' => $_POST["select_usercode"],
			'crop_id' => $_POST["crop_opt"],
			'loan_amt' => $_POST["loan_amt"],
			'user_bank_id' => $_POST["bank_opt"],
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
	
		
	public function update()
	{
		//print_r($_POST);exit;
		$loan_id = $_POST["hid_lid"];
		$posts = array('user_id' =>$_POST["selectuser_id_edit"],
			'usercode' => urldecode($_POST["select_usercode_edit"]),
			'crop_id' => $_POST["crop_opt_edit"],
			'loan_amt' => $_POST["loan_amt_edit"],
			'user_bank_id' => $_POST["bank_opt_edit"],
			'transfer_type' => $_POST["act_types_edit"],
			'updated_on' => date('Y-m-d H:i:s')
			);
		
		
		if($_POST["admin_bank"] != "" || $_POST["loan_type"] != "" || $_POST["start_date"] != "" || $_POST["end_date"] != "" || $_POST["roi"] != "" || $_POST["ref_no"] != ""){
			
			$activity_posts = array('loan_id' => $loan_id,
			'start_date' => $_POST["start_date"],
			'end_date' => $_POST["end_date"],
			'admin_bank' => $_POST["admin_bank"],
			'loan_type' => $_POST["loan_type"],
			'rate_of_interest' => $_POST["roi"],
			'ref_no' => $_POST["ref_no"],			
			'narration' => $_POST["rema_narr"]			
			);
			
			if($_POST["hid_acivity_id"] == 0)
			{
				$act_res = $this->Loans_model->insertLoanActivity($loan_id,$activity_posts);
				//$act_final = json_decode($act_res,true);
			}else if($_POST["hid_acivity_id"] > 0)
			{
				$loan_act_id = $_POST["hid_acivity_id"];
				$activity_posts["updated_on"] = date('Y-m-d H:i:s');
				$act_res = $this->Loans_model->updateLoanActivity($loan_act_id,$activity_posts);
			}
			
		}
		
		if($_POST["hid_appove"] == 1)
		{
			$posts = array('status' => '1', 'loan_type' => $_POST["loan_type"],'loan_status_date' => date('Y-m-d H:i:s'),'updated_on' => date('Y-m-d H:i:s'));
			echo $response = $this->Loans_model->updateLoan($loan_id,$posts);
			
		}
		
		echo $response = $this->Loans_model->updateLoan($loan_id,$posts);	
		
	}
	
	public function approve()
	{
		//print_r($_POST);exit;
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
		$posts = array('status' => '2');		
			
		echo $response = $this->Loans_model->updateLoan($loan_id,$posts);
	}

	public function delete()
	{
		$bid = $_POST["bid"];		
		echo $response = $this->Loans_model->deleteLoan($bid);
		
	}
}
?>