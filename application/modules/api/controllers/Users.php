<?php defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(E_ALL | E_STRICT);
//include($_SERVER['DOCUMENT_ROOT'].'/aquadeals/application/third_party/ImageTool.php');
class Users extends CI_Controller 
{
	function __construct()
	{	
		parent::__construct();
		
		$this->load->library('session');		
		$this->load->model('api/Admin_model');		
		$this->load->model('api/Users_model');
		$this->load->model('api/Transaction_model');
		$this->load->model('api/Sales_model');
		$this->load->model('api/Loans_model');
		$this->load->model('api/Trades_model');	
		$this->load->model('api/Withdrawal_model');		
		$this->load->model('api/Cash_model');
		$this->load->helper('form');
		$this->load->helper('captcha');
		$this->load->helper('url');
		$this->load->library('upload');
		
		setlocale(LC_MONETARY, 'en_IN');		
		
		header('Access-Control-Allow-Origin: *');	
		
	}

	//Index function
	public function index($uid = "")
	{		
		echo $response = $this->Users_model->getUsersdata($uid);
	}
	
	public function searchusers()
	{
		$all = "";
		$search = $_POST['search'];
		if(isset($_POST["allusers"]) && $_POST["allusers"] != ""){ $all = 1;}
		//$search = $_GET['term'];
		echo $response = $this->Users_model->getSearchUsers(urldecode($search),$all);		
		exit;
	}
	public function checkmobile_exists()
	{
		/* $url = base_url().'index.php/api/checkuser/'.$_POST["mobnum"];
		$response = $this->Curl_model->curlget($url);		
		$final_res = json_decode($response,true);
		if($final_res != "" ){	echo 1; }else{ echo 0;} */
		exit;
	}
	
	public function checkmobile_exists_tool_tip()
	{
		$mobnum=trim($_POST["mobnum"]);
		$res=$this->Users_model->checkMobile($mobnum);		
		if($res == 1 ){	echo 'false'; }else{ echo 'true';}
		exit;
	}
	
	public function get_users()
	{
		$draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$limit = intval($this->input->post("length"));
	  
		$order = $_POST['order'][0]['column']; // Column index
		$columnName = $_POST['columns'][$order]['data']; // Column name
		$dir = $_POST['order'][0]['dir']; // asc or desc
		$searchValue = $_POST['search']['value']; // Search value
		
		## Custom Field value
		$searchByUtype = $_POST['type_opt'];
		
		## Search 	
		
		$users =  $this->Users_model->posts_search($limit,$start,$searchValue,$searchByUtype,$order,$dir);		
		$data = [];
		if(count($users)>0)
		{
			foreach($users as $r) {
			  
			  if($r["utype"]=="fs"){ $utype = "Single";}else if($r["utype"]=="fm"){ $utype = "Partner"; }
			  if($r["utype"]=="d"){ $utype = "Dealer";}else if($r["utype"]=="nf"){ $utype = "Non-Farmer"; }
			  
			   $data[] = array(
					//$r["usercode"],
					//$utype,
					'<a href="'.base_url().'admin/users/details" title="">'.$r["uname"].'</a>',
					//$r["uemail"],
					$r["mobile"],
					'<ul class="action_list"> 
					  <li> <a href="'.base_url().'admin/users/edit/'.$r["usercode"].'" class="btn btn-info btn-sm" title=""> Edit </a> </li>
					  <li> &nbsp; </li>
					  <li> <a href="#" title="" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_user"> Delete </a> </li>
					</ul>'
			   );
			}
		}

		$result = array(
			"draw" => $draw,
			"start" => $start,
			"length" => $limit,
			"recordsTotal" => count($users),
			"recordsFiltered" => count($users),
			"data" => $data
		);
		echo json_encode($result);
		exit();
	}
		
	/* public function adduser()
	{	
		//print_r($_POST); print_r($_FILES);exit;
		//Array ( [aadhar_upload] => Array ( [name] => AD_logo.png [type] => image/png [tmp_name] => C:\xampp\tmp\phpD399.tmp [error] => 0 [size] => 62871 )
		$utype = $_POST["utype"];		
		$usercode = strtoupper($this->input->post("utype")).strtotime("now");
		$upload_dir = FCPATH.'assets'. DIRECTORY_SEPARATOR . 'upload_docs'. DIRECTORY_SEPARATOR . $usercode;
		mkdir($upload_dir, 0777, true);	

		$brands = $bm1 = $bm2 = $bm1 = "";
		$bank_count = 0; $crop_count = 0; $partner_count = 0;	
		
		if(isset($_POST["fname"]) && $_POST["fname"][0] != "")	$bank_count = count($_POST["fname"]);
		if(isset($_POST["crop_loc"]) && $_POST["crop_loc"][0] != "") $crop_count = count($_POST["crop_loc"]);
		if(isset($_POST["pname"])) $partner_count = count($_POST["pname"]);
		
		if(isset($_POST["aadhar"])){ $aadhar = $_POST["aadhar"]; }else{ $aadhar = "";}				
						
		$adminid = $this->session->userdata("adminid");
		//$usercode = strtoupper($this->input->post("utype")).strtotime("now");		
		
		$m1 = $_POST["hidm1"]; $m2 = $_POST["hidm2"]; $m3 = $_POST["hidm3"];
		if($m1 != "" || $m2 != "" || $m3 != "")
		{ 
			if($m1 != ""){ $bm1 = "m1:".$m1; } 
			if($m2 != ""){ $bm2 = "#m2:".$m2; } 
			if($m3 != ""){ $bm3 = "#m3:".$m3; }
			$brands = $bm1.$bm2.$bm3;
		}
		if($brands != ""){ $brands_yn = "Yes";}else{ $brands_yn = "No"; }
		if(isset($_POST["firm_name"])){ $firm_name = $_POST["firm_name"]; }else{ $firm_name = "";}
		if(isset($_POST["gst"])){ $gst = $_POST["gst"]; }else{ $gst = "";}
		if(isset($_POST["turnchk"])){ $turnchk = $_POST["turnchk"]; }else{ $turnchk = 0;}
		if(isset($_POST["turnchk"])){ $upload_doc = $_POST["upload_doc"]; }else{ $upload_doc = "";}
		if(isset($_POST["hid_mob_".$utype])){ $alert_mobile = $_POST["hid_mob_".$utype]; }else{ $alert_mobile = "";}
		if(isset($_POST["hid_mail_".$utype])){ $alert_email = $_POST["hid_mail_".$utype]; }else{ $alert_email = "";}
		if(isset($_POST["feed"])){ $feed = $_POST["feed"]; }else{ $feed = "";}
		if(isset($_POST["rate_of_int"])){ $roi = $_POST["rate_of_int"]; }else{ $roi = "";}
		
		if(isset($_POST["med1"])){ $med1 = $_POST["med1"]; }else{ $med1 = 0;}
		if(isset($_POST["med2"])){ $med2 = $_POST["med2"]; }else{ $med2 = 0;}
		if(isset($_POST["med3"])){ $med3 = $_POST["med3"]; }else{ $med3 = 0;}
		if(isset($_POST["os_opt"])){ $os_type = $_POST["os_opt"]; }else{ $os_type = "";}
		
		$url = base_url().'index.php/api/users';
		$posts = array('utype' => $_POST["utype"],
					'usercode' => $usercode,					
					'createdby' => $adminid,					
					'uname' => $_POST["uname"],					
					'uemail' => $_POST["email_id"],
					'firm_name' => $firm_name,
					'guarantor' => $_POST["guaran"],
					'mobile' => $_POST["mob_numb"],
					'alert_mobile' => $alert_mobile,
					'alert_email' => $alert_email,
					'notify_alert' => $turnchk,
					'address' => $_POST["uaddr"],
					'aadhar' => $aadhar,
					'pan' => $_POST["pan"],
					'gst' => $gst,
					'feed_per' => $feed,
					'med1_per' => $med1,
					'med2_per' => $med2,
					'med3_per' => $med3,
					'roi' => $roi,
					'brands_yn' => $brands_yn,
					'doc_type' => $upload_doc,
					'receive_date' => $_POST["recdate"],
					'return_date' => $_POST["retdate"],
					'doc_remarks' => $_POST["doc_rem"],
					'os_type' => $os_type,
					'os_amt' => $_POST["os_amt"],
					'os_remark' => $_POST["os_rem"]
					);		
			
		$response = $this->Curl_model->curlinsert($url,$posts);
		$final_res = json_decode($response,true);
		if($final_res["status"] == "success")
		{
			$res_aadhar = $res_pan = $res_cheque = $res_gst = $res_partner = $res_promissory = $res_gp = $res_stamp = "";
			$file_exists = 0;
			if(isset($_FILES))
			{				
				if(isset($_FILES["aadhar_upload"])){ 
					$aadhar_files = $this->uploadImage($_FILES["aadhar_upload"],$usercode);
					$res_aadhar = implode(",",$aadhar_files);
					$file_exists = 1;
				}		
				if(isset($_FILES["pan_upload"])){ 
					$pan_files = $this->uploadImage($_FILES["pan_upload"],$usercode); 
					$res_pan = implode(",",$pan_files);
					$file_exists = 1;
				}		
				if(isset($_FILES["check_upload"])){ 
					$cheque_files = $this->uploadImage($_FILES["check_upload"],$usercode);
					$res_cheque = implode(",",$cheque_files);
					$file_exists = 1;
				}
				if(isset($_FILES["gst_upload"])){ 
					$gst_files = $this->uploadImage($_FILES["gst_upload"],$usercode);
					$res_gst = implode(",",$gst_files);
					$file_exists = 1;
				}
				if(isset($_FILES["partner_s"])){ 
					$partner_files = $this->uploadImage($_FILES["partner_s"],$usercode);
					$res_partner = implode(",",$partner_files);
					$file_exists = 1;
				}
				if(isset($_FILES["promissory"])){ 
					$promissory_files = $this->uploadImage($_FILES["promissory"],$usercode);
					$res_promissory = implode(",",$promissory_files);
					$file_exists = 1;
				}
				if(isset($_FILES["gp_doc"])){ 
					$gp_files = $this->uploadImage($_FILES["gp_doc"],$usercode);
					$res_gp = implode(",",$gp_files);
					$file_exists = 1;
				}
				if(isset($_FILES["stamp"])){ 
					$stamp_files = $this->uploadImage($_FILES["stamp"],$usercode);
					$res_stamp = implode(",",$stamp_files);
					$file_exists = 1;
				}
				if($file_exists == 1)
				{
					$doc_url = base_url().'index.php/api/documents';
					$doc_post = array('usercode' => $usercode, 'aadhar' => $res_aadhar, 'pan' => $res_pan, 'cheque' => $res_cheque, 'gst' => $res_gst, 'partner' => $res_partner, 'promissory' => $res_promissory, 'gp' => $res_gp, 'stamp' => $res_stamp);
					$doc_res = $this->Curl_model->curlinsert($doc_url,$doc_post);
				}
				
			}
			if($partner_count > 0)
			{
				$pname = $_POST["pname"];
				$paadhar = $_POST["paadhar"];
				$pmobile = $_POST["pmobile"];
				$partner_url = base_url().'index.php/api/partners';
				
				for($p = 0; $p < $partner_count; $p++)
				{
					$partner_post = array('usercode' => $usercode, 'pname' => $pname[$p], 'paadhar' => $paadhar[$p], 'pmobile' => $pmobile[$p]);
					$partner_res = $this->Curl_model->curlinsert($partner_url,$partner_post);
				}
				
			}
			if($brands != "")
			{
				$brand_url = base_url().'index.php/api/brands';
				$brands_post = array('usercode' => $usercode, 'brands' => $brands);
				$brand_res = $this->Curl_model->curlinsert($brand_url,$brands_post);
			}
			if($bank_count > 0)
			{
				$holder = $_POST["fname"];
				$bank_ac = $_POST["ac_number"];
				$bank_name = $_POST["bc_name"];
				$bank_ifsc = $_POST["ifsc"];
				$branch_name = $_POST["branch_name"];				
				$bank_url = base_url().'index.php/api/banks';
				
				for($b = 0; $b < $bank_count; $b++)
				{
					$bank_post = array('usercode' => $usercode, 'holder_name' => $holder[$b], 'ac_number' => $bank_ac[$b], 'bank_name' => $bank_name[$b], 'bank_ifsc' => $bank_ifsc[$b], 'branch_name' => $branch_name[$b] );
					$bank_res = $this->Curl_model->curlinsert($bank_url,$bank_post);
				}
			}
				
			if($crop_count > 0)
			{
				$crop_loc = $_POST["crop_loc"];
				$crop_type = $_POST["crop_type"];
				$crop_acres = $_POST["acres"];
				$crop_url = base_url().'index.php/api/crops';
				
				for($c = 0; $c < $crop_count; $c++)
				{
					$crop_post = array('usercode' => $usercode, 'crop_loc' => $crop_loc[$c], 'crop_type' => $crop_type[$c], 'crop_acres' => $crop_acres[$c]);
					$crop_res = $this->Curl_model->curlinsert($crop_url,$crop_post);
				}
			}
			
		}
		echo $response;
	} */
	
	public function crop_print()
	{
		$data["page_title"] = "Print Details";				
		$adminid = $this->session->userdata("adminid");
		$this->load->view('admin/crop_print',$data);
	}
	public function uploadImage($imgfile,$usercode)
	{
		$files_count = count($imgfile["name"]);
		$res_files = [];
		for($i=0; $i< $files_count; $i++){
			
			$upload_dir = FCPATH.'assets'. DIRECTORY_SEPARATOR . 'upload_docs'. DIRECTORY_SEPARATOR . $usercode;
			$imgname = explode('.',$imgfile['name'][$i]);			
			$ext = $imgname[count($imgname) - 1];
			$time =microtime(true);
			$micro_time=sprintf("%06d",($time - floor($time)) * 1000000);
			$date=new DateTime( date('Y-m-d H:i:s.'.$micro_time,$time) );

			$newname = $date->format("YmdHisu").'.'.$ext;
			$path = $newname;			
			$tempPath = $imgfile['tmp_name'][$i];
			$uploadPath = $upload_dir . DIRECTORY_SEPARATOR . $newname;

			if(move_uploaded_file($tempPath, $uploadPath )){
				$res_files[$i] = $newname;
			}
		}
		return $res_files;
		exit;		
	}

	public function getdayscount()
	{
		$fd = date('d-m-Y',strtotime($_POST['fromdate']));
		$td = date('d-m-Y',strtotime($_POST['todate']));

		$diff = strtotime($fd) - strtotime($td); 
		echo abs(round($diff / 86400)); 

		/* $fromdate = $fd;
		$todate = $td;

		$date1 = date($fromdate);
		$date2= date($todate);
		$month = (int)date('m',strtotime($date1));
		$month2 = date('m',strtotime($date2));

		$extra= array(1,0,1,0,1,0,1,1,0,1,0,1);
		$count=0;
		for($i=$month;$i<$month2;$i++)
		{
			if($extra[$i-1]==1) { $count++;}
		}
		$diff = ((strtotime($date2) - strtotime($date1))/(60*60*24))-$count;
		$val = (int)(($diff)/30); 
		echo $diff; */
	}
	public function updatefinaldata()
	{
		$params["user_id"] = $_POST["user_id"];
		if(isset($_POST["crop_id"]))
			$params["crop_id"] = $_POST["crop_id"]; 
		$grand_total = $_POST["gval"];
		//get loans of user and crop id
		if(isset($_POST["iinterest"]))
		{
			//loan records exists
			foreach($_POST["iinterest"] as $loan_id => $intreset)
			{
				//update loan activity
				$loan_data = array(
					"end_date" =>$_POST["enddate"][$loan_id],
					"rate_of_interest" =>$intreset,
					"rate_of_value" =>$_POST["interestamtval"][$loan_id]
				);
				$this->Loans_model->updateActivity($loan_id,$loan_data);
				//update loan as settled
				$loan_set = array(
					"settled" =>'1'
				);
				$this->Loans_model->updateLoan($loan_id,$loan_set);
			}
			//insert intreset transaction
			$interest_trans = array('trans_type' => 'LOAN',
							'trans' => 'Interest',
							'user_id' => $params["user_id"],
							'crop_id' => $params["crop_id"],
							'amount' => $_POST['interestval'],
							'amount_type' => 'OUT',
							'created_on' => date('Y-m-d'),
							'created_by' => $this->session->userdata('adminid'),
			);
			$tansaction = $this->Transaction_model->insert($interest_trans);
			$grand_total -= $_POST['interestval'];
		}

		//get sales of user and crop id
		if(isset($_POST['branddiscount']))
		{
			
			$sale_ids = $this->Transaction_model->getsaleids($params); 
			//echo $this->db->last_query();
			$ids = explode(",",$sale_ids);
			foreach($ids as $id)
			{
				//echo "s";
				$sale_discount = 0;
				$get_sale_details = $this->Sales_model->getsale_details($id);
				//echo $this->db->last_query();
				foreach($get_sale_details as $detail)
				{
					//echo "r";
					if($_POST['branddiscount'][$detail->cat_id][$detail->brandid] == 0)
					{
						//echo "i";
						if($_POST['proDiscount'][$detail->cat_id][$detail->brandid][$detail->inventory_id] == 0)
						{
							$pro_discount = 0;
							$pro_disc_val = 0;
						}
						else
						{
							$pro_discount = $_POST['proDiscount'][$detail->cat_id][$detail->brandid][$detail->inventory_id];
							$pro_disc_val = $_POST['proDiscountVal'][$detail->cat_id][$detail->brandid][$detail->inventory_id];
						}
					}
					else
					{
						//echo "k";
						$pro_discount = $_POST['branddiscount'][$detail->cat_id][$detail->brandid];
						//$pro_disc_val = $_POST['discountvalue'][$detail->cat_id][$detail->brandid];
						$pro_disc_val = $_POST['proMRPTotal'][$detail->cat_id][$detail->brandid][$detail->inventory_id] * $pro_discount/100;
					}
					//cecho "a";
					$sale_discount += $pro_disc_val;
					$disc_data =array(
						"discount" => $pro_discount,
						"total_discount" => $pro_disc_val,
					);
					$this->Sales_model->updateSaleActivity($detail->id,$disc_data);
					//echo $this->db->last_query();
				}
				//echo "n";
				$sale_disc =array(
					"total_discount" => $_POST["gdiscount"],
					"settled" => '1',
				);
				$this->Sales_model->updateSale($id,$sale_disc);
			}

			//insert intreset transaction
			$interest_trans = array('trans_type' => 'SALE',
							'trans' => 'DISCOUNT',
							'user_id' => $params['user_id'],
							'crop_id' => $params['crop_id'],
							'amount' => $_POST['gdiscount'],
							'amount_type' => 'IN',
							'created_on' => date('Y-m-d'),
							'created_by' => $this->session->userdata('adminid'),
			);
			$act_res1 = $this->Transaction_model->insert($interest_trans);
			$count = count($_POST["branddiscount"]);
			if($count > 0)
			{
				foreach($_POST["branddiscount"] as $cid => $brands)
				{
					foreach($brands as $bid => $brand)
					{
						foreach($_POST["proDiscount"][$cid][$bid] as $pid => $product_disocunt)
						{
							$check_dummy = $this->db->query("SELECT id FROM dummy_account_sale WHERE brand_id='".$bid."' AND product_id='".$pid."' AND user_id='".$_POST["user_id"]."' AND crop_id='".$_POST["crop_id"]."'");
		
							$exists = $check_dummy->num_rows();
							
							$data = array(
								"category_id" 		=>	$cid,
								"brand_id" 			=>	$bid,
								"brand_discount" 	=>	$_POST["branddiscount"][$cid][$bid],
								"product_id" 		=>	$pid,
								"product_discount"	=>	$_POST["proDiscount"][$cid][$bid][$pid],
								"user_id"			=>	$_POST["user_id"],
								"crop_id"			=>	$_POST["crop_id"]
							);
							if($exists)
							{
								$act_res = $this->Transaction_model->updateaccountActivity($data,$_POST['user_id'],$_POST['crop_id'],$cid,$bid,$pid);
							}
							else
							{
								$act_res = $this->Transaction_model->insertaccountActivity($data);
							}
						
						}
					}
				}
			}
			$grand_total += $_POST["gdiscount"];

		}

		$amount_type = ($grand_total > 0) ? "Gain" : "Loss";
		
		$this->Transaction_model->settleReceipts($params); //settle receipts
		$this->Transaction_model->settleTrades($params); //settle trades
		$this->Transaction_model->settleReturns($params); //settle returns
		$this->Transaction_model->settleWithdraws($params); //settle withdraws
		$rand = substr(md5(microtime()),rand(0,26),5);
		$settle_data = array('settled_date' => date('Y-m-d'),
						'settled_code' => 'crop'.$rand,
						'user_id' => $params['user_id'],
						'crop_id' => $params['crop_id'],
						'balance_amount' => $grand_total,
						'amount_type' => $amount_type,
						'note' => '',

						'location' => (isset($_POST["crop_location_val"])) ? $_POST["crop_location_val"] : "",
						'harvest_wt' => (isset($_POST["harvesttonsval"])) ? $_POST["harvesttonsval"] : "",
						'feed_wt' => (isset($_POST["feed_wt"])) ? $_POST["feed_wt"] : "",
						'fcr' => (isset($_POST["fcr"])) ? $_POST["fcr"] : "",
						'fcr_status' => (isset($_POST["fcr_status"])) ? $_POST["fcr_status"] : "",
						'total_loan_amount' => (isset($_POST["total_loan_amount"])) ? $_POST["total_loan_amount"] : "",
						'loan_amount' => (isset($_POST["loan_amount"])) ? $_POST["loan_amount"] : "",
						'loan_interest' => (isset($_POST["loan_interest"])) ? $_POST["loan_interest"] : "",
						'harvest_amount' => (isset($_POST["harvest_amount"])) ? $_POST["harvest_amount"] : "",
						'harvest_type' => (isset($_POST["harvest_type"])) ? $_POST["harvest_type"] : "",
						'lab_fee' => (isset($_POST["lab_fee"])) ? $_POST["lab_fee"] : "",
						'expenses' => (isset($_POST["expenses_val"])) ? $_POST["expenses_val"] : "",
						'transport' => (isset($_POST["transport"])) ? $_POST["transport"] : "",
						'loading' => (isset($_POST["loading"])) ? $_POST["loading"] : "",
						'receipts' => (isset($_POST["receipts"])) ? $_POST["receipts"] : "",
						'returns' => (isset($_POST["returns"])) ? $_POST["returns"] : "",

						'created_on' => date('Y-m-d')
		);

		echo $this->Transaction_model->settleTransactions($params,$settle_data); //settle withdraws
		exit;
		//saledataupdate

		// if($_POST['salestep']==1)
		// {
		// 	/*update discount to sales table*/
		// 	$queryss1 = $this->db->query("select * from dummy_account_sale where settled_status=0 and userid='".$_POST['userid']."' and cropid='".$_POST['crop_id']."'");
		// 	$dat1ss1 = $queryss1->result_array();
		// 	foreach($dat1ss1 as $daass1)
		// 	{			
		// 		$exx = explode('&',$daass1['product_saleids']);
		// 		for($ii=0;$ii<count($exx);$ii++)
		// 		{
		// 			/*echo "update sale_details set discount='".$daass1['product_discount']."' where s_id='".$exx[$ii]."' and brandid='".$daass1['brand_id']."'  and product_id='".$daass1['product_id']."'";*/
		// 			$a12 = array('discount' =>$daass1['product_discount']);
		// 			$act_resdd2 = $this->Transaction_model->Updatesalediscount($a12,$exx[$ii],$daass1['brand_id'],$daass1['product_id']);

		// 			/*update*/
		// 			$a121 = array('settled_status' =>1);
		// 			$act_resdd2 = $this->Transaction_model->Updatesettledstatus($a121,$daass1['brand_id'],$daass1['product_id']);

		// 		}
		// 	}
		// 	/*update discount to sales table*/
		// }
			
		
		// if($_POST['loanstep']==1)
		// {
		// 	/*update roi to loans table*/
		// 	$queryss = $this->db->query("select * from transactions where trans_type='LOAN' and user_id='".$_POST['userid']."' and crop_id='".$_POST['crop_id']."' and status=0 ");
		// 	$dat1ss = $queryss->result_array();
		// 	foreach($dat1ss as $daass)
		// 	{
		// 		$llla = $this->db->query("select *from transactions where trans_id='".$daass['trans_id']."' ");
		// 		$lla = $llla->row_array();

		// 		$a1 = array('rate_of_interest' => $lla['interestval'],
		// 					'rate_of_value' => $lla['interest_amount'],
		// 					'start_date' => date('Y-m-d',strtotime($lla['loan_startdate'])),
		// 					'end_date' => date('Y-m-d',strtotime($lla['loan_enddate']))
		// 		);
		// 		$act_res2 = $this->Transaction_model->Updateinterest($a1,$daass['trans_id']);

		// 		$a12 = array('settled' => 1);
		// 		$act_res1 = $this->Transaction_model->Updatesetstatus($a12,$daass['trans_id']);
		// 	}
		// 	/*update roi to loans table*/
		// }

		// $lll = $this->db->query("select *from transaction_settled order by id desc limit 0,1 ");
		// $ll = $lll->row_array();
		// $bbb = $ll['id']+1;

		// $gt = $_POST['gval'];
		// if($_POST['gval']>0)
		// {
		// 	$bal = $_POST['gval']-$_POST['interestval'];
		// 	$fbal = $bal+$_POST['gdiscount'];
		// }
		// else
		// {
		// 	$bal = $_POST['gval']+$_POST['interestval'];
		// 	$fbal = $bal-$_POST['gdiscount'];
		// }
		
		// if($fbal>0)
		// {
		// 	$ftype = 'Gain';
		// }
		// else
		// {
		// 	$ftype = 'Loss';
		// }

		// $activity_posts = array('settled_date' => date('Y-m-d'),
		// 				'settled_code' => '2020_crop_'.$bbb,
		// 				'user_id' => $_POST['userid'],
		// 				'crop_id' => $_POST['crop_id'],
		// 				'balance_amount' => $fbal,
		// 				'amount_type' => $ftype,
		// 				'note' => '',
		// 				'created_on' => date('Y-m-d')
		// );
		// $act_res = $this->Transaction_model->insertfinalact($activity_posts);
		// $fid = $act_res;

		// if($_POST['salestep']==1)
		// {
		// 	//discount record insert
		// 	$querybu = $this->db->query("select *from users where user_id='".$_POST['userid']."' ");
		// 	$dataau = $querybu->row_array();

		// 	$activity_posts1 = array('trans_type' => 'SALE',
		// 					'trans' => 'Discount',
		// 					'user_id' => $_POST['userid'],
		// 					'user_type' => $dataau['user_type'],
		// 					'crop_id' => $_POST['crop_id'],
		// 					'amount' => $_POST['gdiscount'],
		// 					'amount_type' => 'IN',
		// 					'status' => 1,
		// 					'settled_id' => $fid,
		// 					'created_on' => date('Y-m-d'),
		// 					'created_by' => 1,
		// 					'updated_on' => date('Y-m-d'),
		// 					'updated_by' => 1
		// 	);
		// 	$act_res1 = $this->Transaction_model->insert($activity_posts1);
		// }

		// if($_POST['loanstep']==1)
		// {
		// 	$activity_posts1 = array('trans_type' => 'LOAN',
		// 					'trans' => 'Interest',
		// 					'user_id' => $_POST['userid'],
		// 					'user_type' => $dataau['user_type'],
		// 					'crop_id' => $_POST['crop_id'],
		// 					'amount' => $_POST['interestval'],
		// 					'amount_type' => 'OUT',
		// 					'status' => 1,
		// 					'settled_id' => $fid,
		// 					'created_on' => date('Y-m-d'),
		// 					'created_by' => 1,
		// 					'updated_on' => date('Y-m-d'),
		// 					'updated_by' => 1
		// 	);
		// 	$act_res1 = $this->Transaction_model->insert($activity_posts1);
		// }
		
		// //interest recored insert

		// /*update records*/
		// $activity_posts2 = array('settled_id' => $fid,
		// 				'status' => 1
		// );
		// $act_res2 = $this->Transaction_model->Updatesettleaccount($activity_posts2,$_POST['userid'],$_POST['crop_id'],$_POST['loanstep'],$_POST['salestep']);
		// echo json_encode($act_res2);
	}
	public function settled_pdf($settled_id)
	{
		//exit;
		//pdf generation
		//echo $settled_id = $_POST["settled_id"];

		$this->db->select('*');
		$this->db->where("id",$settled_id);
		$settled_data = $this->db->get("transaction_settled")->row();
		$data["settled_data"] = $settled_data;

		$this->db->select("*");
		$this->db->where("user_id",$settled_data->user_id);
		$user = $this->db->get("users")->row();
		$data["user"] = $user;

		$this->db->select('*');
		$this->db->where("settled_id",$settled_id);
		$transactions = $this->db->get('transactions')->result();
		$data["transactions"]=$transactions;

		$params = array("settled_id"=>$settled_id);
		$sale_ids = $this->Transaction_model->getsaleids($params);

		$this->db->select('s.id,s.quantity as sale_qty,p.pname,p.qty as weight,u.unit_name');
		$this->db->join("products p","p.pid = s.product_id",'left');
		$this->db->join("categories c","c.cat_id = p.cat_id",'left');
		$this->db->join("units u","u.id = p.weightage",'left');
		$this->db->where_in('s_id',$sale_ids,false);
		$this->db->where('c.cat_id','1');
		$feed_products = $this->db->get("sale_details s")->result();
		$data["feed_products"] = $feed_products;

		$this->db->select('SUM(total_price) AS total_mrp, SUM(total_discount) AS total_discount, c.cat_name');
		$this->db->join("products p","p.pid = s.product_id",'left');
		$this->db->join("categories c","c.cat_id = p.cat_id",'left');
		$this->db->where_in('s_id',$sale_ids,false);
		$this->db->group_by('c.cat_id','1');
		$cat_discount = $this->db->get("sale_details s")->result();
		$data["cat_discount"] = $cat_discount;
		
		$html=$this->load->view('admin/pdf_print',$data,true); 
		$time = time();
		$pdfFilePath = $_SERVER['DOCUMENT_ROOT']."/credit_new/assets/pdf/transactions/settlement_".date('m-d-Y_hia').".pdf";	

        $this->load->library('Pdf');
		$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
		$pdf->SetTitle('AquaDeals Invoice');

		$pdf->SetMargins(5, '', 5);
		$pdf->SetHeaderMargin(30);
		$pdf->SetTopMargin(20);
		$pdf->setFooterMargin(20);
		$pdf->SetAutoPageBreak(true,30);
		$pdf->SetAuthor('Author');
		$pdf->SetDisplayMode('real', 'default');
		$pdf->AddPage('P', 'A4');
		$pdf->writeHTML($html, true, false, true, false, '');

		$pdf->SetAlpha(0.7);
		$pdf->Image( base_url().'assets/images/not_paid.png', 10, 90, 70, 50, '', '', 'C', false, 72, 'C', false, false, 0);
		
		$pdf->lastPage();
		ob_end_clean();
		$pdf->Output($pdfFilePath, 'FD');
	}
	
	public function purchaseamountval()
	{
		$queryb = $this->db->query("select *from products where brand_id='".$_POST['bid']."' and pid='".$_POST['pid']."' ");
		$dataa = $queryb->row_array();

		echo $dataa['purchase_amt'];
	}
	public function purchaseamountvalbrand()
	{
		$queryb = $this->db->query("select MIN(purchase_amt) as purchase_amt from products where brand_id='".$_POST['bid']."' and cat_id='".$_POST['bid']."' ");
		$dataa = $queryb->row_array();

		echo $dataa['purchase_amt'];
	}
	public function saledataupdate()
	{
		$count = count($_POST["branddiscount"]);
		if($count > 0)
		{
			foreach($_POST["branddiscount"] as $cid => $brands)
			{
				foreach($brands as $bid => $brand)
				{
					foreach($_POST["proDiscount"][$cid][$bid] as $pid => $product_disocunt)
					{
						$check_dummy = $this->db->query("SELECT id FROM dummy_account_sale WHERE brand_id='".$bid."' AND product_id='".$pid."' AND user_id='".$_POST["user_id"]."' AND crop_id='".$_POST["crop_id"]."'");
	
						$exists = $check_dummy->num_rows();
						
						$data = array(
							"category_id" 		=>	$cid,
							"brand_id" 			=>	$bid,
							"brand_discount" 	=>	$_POST["branddiscount"][$cid][$bid],
							"product_id" 		=>	$pid,
							"product_discount"	=>	$_POST["proDiscount"][$cid][$bid][$pid],
							"user_id"			=>	$_POST["user_id"],
							"crop_id"			=>	$_POST["crop_id"]
						);
						if($exists)
						{
							$act_res = $this->Transaction_model->updateaccountActivity($data,$_POST['user_id'],$_POST['crop_id'],$cid,$bid,$pid);
						}
						else
						{
							$act_res = $this->Transaction_model->insertaccountActivity($data);
						}
					
					}
				}
			}
		}
		echo json_encode($act_res);
	}
	/* public function loandataupdate()
	{
		for($i=0;$i<=count($_POST['trans_id']);$i++)
		{
			if(!empty($_POST['interestamtval'][$i]) && !empty($_POST['totamtval'][$i]) && !empty($_POST['iinterest'][$i]))
			{
				$activity_posts = array('interestval' => $_POST['iinterest'][$i],
					'interest_amount' => $_POST['interestamtval'][$i],
					'total_amount' => $_POST['totamtval'][$i],
					'loan_startdate' => date('Y-m-d',strtotime($_POST['startdate'][$i])),
					'loan_enddate' => date('Y-m-d',strtotime($_POST['enddate'][$i]))
				);
				
				$trade_act_id = $_POST["trans_id"][$i];
				$act_res = $this->Transaction_model->updateloanActivity($trade_act_id,$activity_posts);
			}
		}
		echo json_encode($act_res);
	} */
	public function getloandata()
	{
		$params['user_id'] = $_POST['userid'];
		$params['crop_id'] = $_POST['crop_id'];

		$records=$this->Transaction_model->getRecordsloan($params);
		$total_count = $records['count'];
		$tansactions = $records['data'];
		$data = array();
		$amount = 0;
		if($total_count)
		{
			foreach($tansactions as $value)
			{
				$ldata = $this->db->query("select start_date,end_date,rate_of_interest,loan_type from loan_activity where loan_id='".$value["trans_id"]."'");
				$ltds = $ldata->row_array();				

				$sdate = ($ltds['start_date']!='') ? date('d-M-Y',strtotime($ltds['start_date'])) : date('d-M-Y',strtotime($value["created_on"]));

				$edate = ($ltds['end_date']!='') ? date('d-M-Y',strtotime($ltds['end_date'])) : date('d-M-Y');
				$roi = ($ltds['rate_of_interest']!='') ? $ltds['rate_of_interest'] : "";
			
				$diff = strtotime(date('d-M-Y')) - strtotime($value["created_on"]);
				$dateDiff = abs(round($diff / 86400));

				$date_diff = abs(strtotime(date('d-M-Y')) - strtotime($value["created_on"]));
				
				$years = floor($date_diff / (365*60*60*24));
				$months = floor(($date_diff - $years * 365*60*60*24) / (30*60*60*24)); 

				$tdata = $this->db->query("select created_on from transactions where user_id='".$params['user_id']."' and crop_id='".$_POST['crop_id']."' order by id asc ");
				$tdates = $tdata->row_array();
				$bdate = date('d-M-Y',strtotime($tdates['created_on'])).' to '.date('d-M-Y');

				$crop_type = $this->db->query("select loan_type from ac_loan_types where loan_type_id = '".$ltds["loan_type"]."'");
				$crop_data = $crop_type->row_array();

				$data[] = array("trans_id"=>$value['trans_id'],"trans_code"=>$value['trans_code'],"amount"=>$value['amount'],"croploan"=>$crop_data["loan_type"],"startdate"=>$sdate,"enddate"=>$edate,'days'=>$dateDiff,'months'=>$months,'interestval'=>$roi,'interest_amount'=>$value['interest_amount'],'total_amount'=>$value['total_amount'],'id'=>$value['id'],'billdate'=>$bdate);

			}
		}
		$response=[];
		echo json_encode($data);
	}
	public function getsalesdata()
	{
		$params['user_id'] = $_POST['userid'];
		if($_POST['crop_id'] != '')
		{
			$params['crop_id'] = $_POST['crop_id'];
		}

		//get sale ids		
		$ids = $this->Transaction_model->getsaleids($params);
		
		$this->db->select("t.trans_id, s.id,p.cat_id,c.cat_name, s.brandid, b.brand_name, s.product_id,p.pname,p.qty,p.weightage, s.inventory_id,i.pmrp as p_mrp,i.percentage as p_disc, s.quantity as p_qty");
		$this->db->join("sale_details s","s.s_id = t.trans_id",'left');
		$this->db->join("brands b","b.brand_id = s.brandid",'left');
		$this->db->join("products p","p.pid = s.product_id",'left');
		$this->db->join("branch_inventory i","i.bin_id = s.inventory_id",'left');
		$this->db->join("categories c","c.cat_id = p.cat_id",'left');
		$this->db->where("t.user_id",$params['user_id']);
		$this->db->where("t.crop_id",$params['crop_id']);	
		$this->db->where("t.status",'0');	
		$this->db->where("t.trans_type",'SALE');
		$this->db->where("t.trans",'GOODS');

		$records = $this->db->get("transactions t")->result();
		//echo $this->db->last_query(); exit;
		$brands = array();
		$categories =array();
		foreach($records as $row)
		{
			$categories[$row->cat_id] = $row->cat_name;
			$brands[$row->cat_id][$row->brandid]['name'] = $row->brand_name;

			if(array_search($row->inventory_id, array_column($products[$row->cat_id][$row->brandid][$row->inventory_id], 'id')) !== false) {
				$products[$row->cat_id][$row->brandid][$row->inventory_id]['total_mrp'] = $row->p_mrp * $row->p_qty;
				$products[$row->cat_id][$row->brandid][$row->inventory_id]['sale_qty'] = $row->p_qty;
			}
			else {
				$products[$row->cat_id][$row->brandid][$row->inventory_id]['total_mrp'] += ($row->p_mrp * $row->p_qty);
				$products[$row->cat_id][$row->brandid][$row->inventory_id]['sale_qty'] += $row->p_qty;
			}

			$select_units = $this->db->query("select unit_name from units where id='".$row->weightage."' ");
			$units = $select_units->row();
			$products[$row->cat_id][$row->brandid][$row->inventory_id]['id'] = $row->product_id;
			$products[$row->cat_id][$row->brandid][$row->inventory_id]['name'] = $row->pname;
			$products[$row->cat_id][$row->brandid][$row->inventory_id]['mrp'] = $row->p_mrp ;
			
			$products[$row->cat_id][$row->brandid][$row->inventory_id]['transaction'] = $row->p_disc;

			
			$products[$row->cat_id][$row->brandid][$row->inventory_id]['weight'] = $row->qty;
			$products[$row->cat_id][$row->brandid][$row->inventory_id]['units'] = $units->unit_name;

			$this->db->select("SUM(s.quantity) as total_qty,SUM(mrp*quantity) as brand_mrp,MIN(i.percentage) as brand_disc_limit");
			$this->db->join("branch_inventory i","i.bin_id = s.inventory_id",'left');
			$this->db->join("products p","p.pid = s.product_id",'left');
			$this->db->where_in('s.s_id',$ids,FALSE);
			$this->db->where('s.brandid',$row->brandid);
			$this->db->where('p.cat_id',$row->cat_id);
			$this->db->group_by('s.brandid');
			$pdetails = $this->db->get("sale_details s")->row();
			//echo $this->db->last_query(); 
			$brands[$row->cat_id][$row->brandid]['sum_mrp'] = $pdetails->brand_mrp;		
			$brands[$row->cat_id][$row->brandid]['brand_disc_limit'] = $pdetails->brand_disc_limit;		
			$brands[$row->cat_id][$row->brandid]['total_qty'] = $pdetails->total_qty;	
		}

		$harvest_details = $this->Transaction_model->getUserHarvetDetails($params);
		//print_r($harvest_details); exit;
		$harvet_amount = $harvest_details->h_amount;
		$harvet_weight = $harvest_details->h_weight;
		$harvest_wt_tons = $harvet_weight/1000;

		$data = array("categories"=>$categories,'brands'=>$brands,'products'=>$products,'harvest'=>$harvet_amount,'tradetons'=>$harvest_wt_tons);
		
		echo json_encode($data);

	}
	public function getfinaldata()
	{
		$params['user_id'] = $_POST['userid'];
		if($_POST['crop_id'] != '')
		{
			$params['crop_id'] = $_POST['crop_id'];
			$crop_details = $this->Users_model->getCropLocation($params['crop_id']);
			$crop_location= $crop_details->crop_location;
			$crop_type = $crop_details->crop_type;
		}	

		$lab = $this->Transaction_model->getUserLabAmount($params);
		$expenses = $this->Transaction_model->getUserExpenses($params);
		$loading = $this->Transaction_model->getUserLoadingAmount($params);
		$transport = $this->Transaction_model->getUserTransportAmount($params);
		$receipts = $this->Transaction_model->getUserReceiptsAmount($params);
		$returns = $this->Transaction_model->getUserReturnAmount($params);	
		/*convert kgs to tons*/

		$data[] = array("transport"=>$transport,'lab'=>$lab,'expenses'=>$expenses,'loading'=>$loading,'receipt'=>$receipts,'returnamount'=>$returns,"crop_location"=>$crop_location,"crop_type"=>$crop_type);
		echo json_encode($data);
	}
	
	public function unsettled_trans()
	{
		$draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$limit = intval($this->input->post("length"));

		$select = $this->db->select('transaction_balance')->where('user_id',$this->input->post('user_id'))->where('cd_id',$this->input->post('crop_id'))->get('user_crop_details');
		$result = $select->row();
		//$open_balance = $this->Users_model->open_balance($this->input->post('user_id'),$this->input->post('crop_id'));
		$open_balance = $result->transaction_balance;

		$params['order']=$_POST['order'][0]['column']; // Column index
		$params['columnName']=$_POST['columns'][$order]['data']; // Column name
		$params['dir']=$_POST['order'][0]['dir']; // asc or desc
		$params['searchValue']=$_POST['search']['value']; // Search value


		$params['user_id'] = $_POST['user_id'];
		$params['crop_id'] = $_POST['crop_id'];
		$params['settled'] = ($_POST['settled']) ? str_replace('status_', '', $_POST['settled']): '0' ;

		$records=$this->Transaction_model->getRecords($limit,$start,$params);

		$sqa = $this->db->query("select *from transactions where trans_type IN ('LOAN','SALE') and user_id='".$this->input->post('user_id')."' and crop_id='".$this->input->post('crop_id')."' and status=0 ");
		$datrecordtotal = $sqa->num_rows();

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
					$amt = '<span class="txt_red"><span class="arr_blk">'."₹".number_format($value['amount'],2).'<img src="http://3.7.44.132/aquacredit/assets/images/rd_c_ar.png"> </span></span>';
				}  
				else 
				{
					$amount +=$value["amount"];
					$amt = '<span class="grn_clr"><span class="arr_blk">'."₹".number_format($value['amount'],2).'<img src="http://3.7.44.132/aquacredit/assets/images/grn_c_ar.png"> </span></span>';
				}

				$sllla = $this->db->query("select *from sale where id='".$value['trans_id']."' ");
				$slla = $sllla->row_array();

					if($slla['saletype']==0)
					{
						$transi = 'SCD'.$value['trans_id'];
					}
					else
					{
						$transi = 'SCH'.$value['trans_id'];
					}

				$trans = ($value['trans'] != null) ? "(".$value['trans'].")" : "";
				$data[]=[
								date("d-M-Y",strtotime($value['created_on'])),
								'<a href="javascript:void(0);" class="expand_details" title="">'. $value["trans_type"].' '.$trans.' - '.$transi.'</a>',
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
		$response["total_record"]=$datrecordtotal;
		$response["data"]=$data;
		$response["total_trans_amount"] = $amount;
		$response["open_balance"] = $open_balance;
		echo json_encode($response);
	}

	public function settled_trans()
	{
		
		$draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$limit = intval($this->input->post("length"));

		$params['order']=$_POST['order'][0]['column']; // Column index
		$params['columnName']=$_POST['columns'][$order]['data']; // Column name
		$params['dir']=$_POST['order'][0]['dir']; // asc or desc
		$params['searchValue']=$_POST['search']['value']; // Search value


		$params['user_id'] = $_POST['user_id'];
		$params['crop_id'] = $_POST['crop_id'];
		$params['settled'] = '0' ;
		//echo $params['settled']; exit;
		$records=$this->Transaction_model->getSettledRecords($limit,$start,$params);
		$total_count = $records['count'];
		$tansactions = $records['data'];
		$data = [];
		//$amount = 0;
		if($total_count)
		{
			foreach($tansactions as $key=>$value){
				if($value["balance_amount"] < 0) 
				{
					
					$amt = '<span class="txt_red">Loss('."₹".number_format($value['balance_amount'],2).')</span>';
				}  
				else 
				{
					
					$amt = '<span class="grn_clr">Profit('."₹".number_format($value['balance_amount'],2).')</span>';
				}
				$trans = ($value['trans'] != null) ? "(".$value['trans'].")" : "";
				$data[]=[
					'<span class="material-icons expand_details" id="hide_details" style="display:none;">remove</span>
					<span class="material-icons expand_details" id="show_details">add</span>
					',
					date("d-M-Y",strtotime($value['settled_date'])),
					'<a href="javascript:void(0);" class="expand_details">'.$value["settled_code"].'</a>',
					$amt,
					'<span class="material-icons">system_update_alt</span>',
					$value['id'],
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
		//$response["total_trans_amount"] = $amount;
		echo json_encode($response);
	}

	public function getSettledDetails($settled_id)
	{
		$records=$this->Transaction_model->getSettledDetails($settled_id);
		
		$total_count = $records['count'];
		$tansactions = $records['data'];
		
		//echo "<pre>"; print_r($tansactions); echo "</pre>"; exit;
		$data = [];
		$tr_html = '';
		//$amount = 0;
		if($total_count)
		{
			$tr_html .= "<table class='trans_detail'><tr><td></td><td>Date</td><td>Detail</td><td>Amount</td></tr>";
			foreach($tansactions as $key=>$value){
				//echo $value["trans_type"]; exit;
				if($value["trans_type"]=="LOAN")
				{
					$trans = ($value['trans'] != null) ? "(".$value['trans'].")" : "";
					$tr_html .= "<tr><td></td><td>".date("d-M-Y",strtotime($value['created_on']))."</td><td>".$value["trans_type"].' '.$trans.' - '.$value["trans_code"]."</td><td>"."₹".number_format($value["amount"],2)."</td></tr>";
					$loan_records = $this->Loans_model->getLoanTypeByLoan($value["trans_id"]);
					$loan = json_decode(($loan_records), true);
					//print_r($loan_records); exit;
					//foreach($loan_records as $loan)
					//{ 
					//	print_r($loan);
						$tr_html .= "<tr class='detal_row'><td></td><td class='date'> &nbsp; </td>".
						"<td colspan='2'>".
							"<table>".
								"<tr>".
									"<th> Crop Location </th>".
									"<th> Loan Type </th>".
									"<th> Loan Amount </th>".
									"<th>  </th>".
									"<th>  </th>".
								"</tr>".
								"<tr>".
									"<td> ".$loan["crop_location"]."  </td>".
									"<td> ".$loan["loan_type"]." </td>".
									"<td> "."₹".number_format($loan["loan_amt"],3)." </td>".
									"<td>  </td>".
									"<td>  </td>".
								"</tr>".
								"</table>".
								"</td>".
								"<td class='hide_blk'> </td>".
								"<td class='hide_blk'> </td>".
								"<td class='hide_blk'> </td>".
								"</tr>";
					//}
				}
				else if($value["trans_type"]=="RECEIPT")
				{ 
					$tr_html .= "<tr><td></td><td>".date("d-M-Y",strtotime($value['created_on']))."</td><td>".$value["trans_type"].' '.$trans.' - '.$value["trans_code"]."</td><td>"."₹".number_format($value["amount"],2)."</td></tr>";
					$tr_html .= "<tr class='detal_row'><td></td><td class='date'> &nbsp; </td>".
						"<td colspan='2'>".
							"<table>".
								"<tr>".
									"<th> Transfer Type </th>".
									"<th> Amount </th>".
									"<th> </th>".
									"<th>  </th>".
									"<th>  </th>".
								"</tr>".
								"<tr>".
									"<td> ".$value["trans"]."  </td>".
									"<td> "."₹".number_format($value["amount"],3)." </td>".
									"<td>  </td>".
									"<td>  </td>".
									"<td>  </td>".
								"</tr>".
								"</table>".
								"</td>".
								"<td class='hide_blk'> </td>".
								"<td class='hide_blk'> </td>".
								"<td class='hide_blk'> </td>".
								"</tr>";
				}
				else if($value["trans_type"]=="SALE" && $value["trans"]=="GOODS")
				{
					$tr_html .= "<tr><td></td><td>".date("d-M-Y",strtotime($value['created_on']))."</td><td>".$value["trans_type"].' '.$trans.' - '.$value["trans_code"]."</td><td>"."₹".number_format($value["amount"],2)."</td></tr>";
					$sale_records = $this->Sales_model->getSaleItemDetails($value["trans_id"]);
					$sales = json_decode(($sale_records), true);
					
						$tr_html .= "<tr class='detal_row'><td></td><td class='date'> &nbsp; </td>".
						"<td colspan='2'>".
							"<table>".
								"<tr>".
									"<th> Product Name </th>".
									"<th> Qty </th>".
									"<th> MRP</th>".
									"<th> Discount </th>".
									"<th>  Total Price</th>".
								"</tr>";
							foreach($sales["data"] as $sale){
								//print_r($sale); exit;
								$tr_html .= "<tr>".
									"<td> ".$sale["pname"]."  </td>".
									"<td> ".$sale["quantity"]." </td>".
									"<td> "."₹".number_format($sale["mrp"],3)." </td>".
									"<td>  ".$sale["discount"]."  </td>".
									"<td>  "."₹".number_format($sale["total_price"],3)."  </td>".
								"</tr>";
							}
							$tr_html .="</table>".
								"</td>".
								"<td class='hide_blk'> </td>".
								"<td class='hide_blk'> </td>".
								"<td class='hide_blk'> </td>".
								"</tr>";
					
					//print_r($sale_records); exit;
				}
				else if($value["trans_type"]=="TRADE" && $value["trans"]=="ITEM")
				{
					$tr_html .= "<tr><td></td><td>".date("d-M-Y",strtotime($value['created_on']))."</td><td>".$value["trans_type"].' '.$trans.' - '.$value["trans_code"]."</td><td>"."₹".number_format($value["amount"],2)."</td></tr>";
					$trade_records = $this->Trades_model->getTradeactualDetails($value["trans_id"]);
					$trades = json_decode(($trade_records), true);
					
						$tr_html .= "<tr class='detal_row'><td></td><td class='date'> &nbsp; </td>".
						"<td colspan='2'>".
							"<table>".
								"<tr>".
									"<th> Date </th>".
									"<th> Count </th>".
									"<th> Price</th>".
									"<th> Weight </th>".
									"<th> Total Price</th>".
								"</tr>";
							foreach($trades["data"] as $trade){
								//print_r($sale); exit;
								$tr_html .= "<tr>".
									"<td> ".$trade["trade_date"]."  </td>".
									"<td> ".$trade["count"]." </td>".
									"<td> "."₹".number_format($trade["farmer_price"],3)." </td>".
									"<td>  ".$trade["farmer_weight"]."  </td>".
									"<td>  "."₹".number_format($trade["farmer_amount"],3)."  </td>".
								"</tr>";
							}
							$tr_html .="</table>".
								"</td>".
								"<td class='hide_blk'> </td>".
								"<td class='hide_blk'> </td>".
								"<td class='hide_blk'> </td>".
								"</tr>";
					
					//print_r($sale_records); exit;
				}
			}
			$tr_html .= "</table>";
		}
		echo json_encode($tr_html);
		//echo $;
	}

	public function printTrans($user_id,$crop_id,$settled)
	{
		$params["user_id"] =  $user_id;
		$params["crop_id"] =  $crop_id;
		$params["settled"] =  $settled;
		
		$transactions = $this->Transaction_model->getRecords('','',$params);
		$data["transactions"] = $transactions["data"];
		$data['user'] = $this->Users_model->getUser($user_id);
		$data["crop"] = $this->db->select("crop_location")->where("cd_id",$crop_id)->get("user_crop_details")->row();
		//$data["open_balance"] = $this->Users_model->open_balance($user_id,$crop_id);
		//$data["crop"] = $crop;
		//echo "<pre>"; print_r($data); echo "</pre>"; exit;
		$html=$this->load->view('admin/pdf_transaction',$data,true); 
		//exit;
		$time = time();
		$pdfFilePath = $_SERVER['DOCUMENT_ROOT']."/credit_new/assets/pdf/transactions/trans_".date('m-d-Y_his').".pdf";	

        $this->load->library('Pdf');
		$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
		$pdf->SetTitle('AquaDeals Invoice');

		$pdf->SetMargins(5, '', 5);
		$pdf->SetHeaderMargin(30);
		$pdf->SetTopMargin(20);
		$pdf->setFooterMargin(20);
		$pdf->SetAutoPageBreak(true,30);
		$pdf->SetAuthor('Author');
		$pdf->SetDisplayMode('real', 'default');
		$pdf->AddPage('P', 'A4');
		$pdf->writeHTML($html, true, false, true, false, '');

		$pdf->SetAlpha(0.7);
		$pdf->Image( base_url().'assets/images/not_paid.png', 10, 90, 70, 50, '', '', 'C', false, 72, 'C', false, false, 0);
		
		$pdf->lastPage();
		ob_end_clean();
		$pdf->Output($pdfFilePath, 'FD');
		exit;
	}

	public function printPDF()
	{	
		$data ='';
		$html=$this->load->view('admin/pdf_print',$data,true); 
		//exit;
		$time = time();
		$pdfFilePath = $_SERVER['DOCUMENT_ROOT']."/aquacredit/assets/pdf/transactions/user_".date('m-d-Y_hia').".pdf";	

        $this->load->library('Pdf');
		$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
		$pdf->SetTitle('AquaDeals Invoice');

		$pdf->SetMargins(5, '', 5);
		$pdf->SetHeaderMargin(30);
		$pdf->SetTopMargin(20);
		$pdf->setFooterMargin(20);
		$pdf->SetAutoPageBreak(true,30);
		$pdf->SetAuthor('Author');
		$pdf->SetDisplayMode('real', 'default');
		$pdf->AddPage('P', 'A4');
		$pdf->writeHTML($html, true, false, true, false, '');

		$pdf->SetAlpha(0.7);
		$pdf->Image( base_url().'assets/images/not_paid.png', 10, 90, 70, 50, '', '', 'C', false, 72, 'C', false, false, 0);
		
		$pdf->lastPage();
		ob_end_clean();
		$pdf->Output($pdfFilePath, 'FD');
		exit;
	}

	public function checkmobile($user_id = null)
	{
		if($_POST["user_id"])
			$user_id = $_POST["user_id"];
		$mobile = $_POST["mobile"];
		$this->db->select('user_id');
		$this->db->where('mobile',$mobile);
		$this->db->where('status','1');
		if($user_id != "")	
			$this->db->where('user_id !=',$user_id);
		$count = $this->db->get('users')->num_rows();
		echo ($count) ? 'false' : 'true';
		exit;
	}
	
	// by venu
	public function withdrawals()
	{
		//print_r($_POST);exit;
		$act_type = strtoupper($_POST["act_types"]." "."TRANSFER");
		if($_POST["act_types"] == 'bank')
		{
			$posts = array('trans_type' => $_POST["act_types"],
					'user_id' => $_POST['uid'],
					'source_crop' => $_POST['src_crop'],
					'user_bank' => $_POST['user_bank'],
					'admin_bank' => $_POST['admin_bank'],
					'withdrawal_amount' => $_POST['drawal_amt'],
					'note' => $_POST['drawal_note']
				);				
		}else if($_POST["act_types"] == 'cash')
		{
			$posts = array('trans_type' => $_POST["act_types"],
					'user_id' => $_POST['uid'],
					'source_crop' => $_POST['src_crop'],
					'admin_bank' => $_POST['admin_cash'],
					'withdrawal_amount' => $_POST['drawal_amt'],
					'note' => $_POST['drawal_note']
				);
		}else if($_POST["act_types"] == 'crop')
		{
			$posts = array('trans_type' => $_POST["act_types"],
					'user_id' => $_POST['uid'],
					'source_crop' => $_POST['src_crop'],
					'desti_crop' => $_POST['user_crop'],
					'withdrawal_amount' => $_POST['drawal_amt'],
					'note' => $_POST['drawal_note']
				);
		}
		else if($_POST["act_types"] == 'user')
		{
			$posts = array('trans_type' => $_POST["act_types"],
					'user_id' => $_POST['uid'],
					'to_user' => $_POST['selectuser_id'],
					'source_crop' => $_POST['src_crop'],
					'desti_crop' => $_POST['user_crop'],
					'withdrawal_amount' => $_POST['drawal_amt'],
					'note' => $_POST['drawal_note']
				);
		}
		$add_drawal= $this->Withdrawal_model->insert($posts);
		$drawal_final = json_decode($add_drawal,true);
		if($drawal_final["status"] == "success")
		{
			// If trans_type as bank or cash
			if($_POST["act_types"]=="bank" || $_POST["act_types"]=="cash")
			{
				if($_POST["act_types"]=="bank")
				{
					$acc_id = $_POST["admin_bank"];
					$upd_account = json_decode($this->Cash_model->updateAdminAccount($_POST["admin_bank"],$_POST["drawal_amt"]));
					$account_amount = $upd_account->avl_bal;
				}
				else if($_POST["act_types"]=="cash")
				{
					$acc_id = $_POST["admin_cash"];
					$upd_account = json_decode($this->Cash_model->updateAdminAccount($_POST["admin_cash"],$_POST["drawal_amt"]));
					$account_amount = $upd_account->avl_bal;
				}
				$cash = array(
						"trans_type" 	=> "Withdrawal",
						"trans_id"		=> $drawal_final["insert_id"],
						"amount"		=>	$_POST["drawal_amt"],
						"amount_type"	=>	"OUT",
						"account_type"	=>	$_POST["act_types"],
						"account_id"	=> $acc_id,
						"avl_bal"		=> $account_amount,
						"admin_id"	=>	$this->session->userdata('adminid'),
					);
				$this->Cash_model->insert($cash);	
				
				$trans_data = array(
					"trans_type" 	=> "WITHDRAWAL",
					"trans"			=> $act_type,
					"trans_id"		=> $drawal_final["insert_id"],
					"trans_code"	=> 'WD'.$drawal_final["insert_id"],
					"user_id"		=>  $_POST['uid'],					
					"crop_id"		=> 	$_POST["src_crop"],
					"amount"		=>	$_POST["drawal_amt"],
					"amount_type"	=>	"OUT",
					"description"	=>	$_POST['drawal_note'],
					"status"		=>	"0",
					"created_by"	=>	$this->session->userdata('adminid'),
				);
				$this->Transaction_model->insert($trans_data);
			}else if($_POST["act_types"]=="crop" || $_POST["act_types"]=="user")
			{
				$trans_data = array(
					"trans_type" 	=> "WITHDRAWAL",
					"trans"			=> $act_type,
					"trans_id"		=> $drawal_final["insert_id"],
					"trans_code"	=> 'WD'.$drawal_final["insert_id"],
					"user_id"		=>  $_POST['uid'],					
					"crop_id"		=> 	$_POST["src_crop"],
					"amount"		=>	$_POST["drawal_amt"],
					"amount_type"	=>	"OUT",
					"description"	=>	$_POST['drawal_note'],
					"status"		=>	"0",
					"created_by"	=>	$this->session->userdata('adminid'),
				);
				$this->Transaction_model->insert($trans_data);
				if($_POST["act_types"]=="crop")
				{
					$trans_data = array(
						"trans_type" 	=> "WITHDRAWAL",
						"trans"			=> $act_type,
						"trans_id"		=> $drawal_final["insert_id"],
						"trans_code"	=> 'WD'.$drawal_final["insert_id"],
						"user_id"		=>  $_POST['uid'],					
						"crop_id"		=> 	$_POST["user_crop"],
						"amount"		=>	$_POST["drawal_amt"],
						"amount_type"	=>	"IN",
						"description"	=>	$_POST['drawal_note'],
						"status"		=>	"0",
						"created_by"	=>	$this->session->userdata('adminid'),
					);
					$this->Transaction_model->insert($trans_data);
				}
				else if($_POST["act_types"]=="user")
				{
					if($_POST["select_usertype"] == "FARMER" && $_POST["select_guest"] == 0){ $crop = $_POST["user_crop"];}else{ $crop = "";}
					$trans_data = array(
						"trans_type" 	=> "WITHDRAWAL",
						"trans"			=> $act_type,
						"trans_id"		=> $drawal_final["insert_id"],
						"trans_code"	=> 'WD'.$drawal_final["insert_id"],
						"user_id"		=>  $_POST['selectuser_id'],					
						"crop_id"		=> 	$crop,
						"amount"		=>	$_POST["drawal_amt"],
						"amount_type"	=>	"IN",
						"description"	=>	$_POST['drawal_note'],
						"status"		=>	"0",
						"created_by"	=>	$this->session->userdata('adminid'),
					);
					$this->Transaction_model->insert($trans_data);
				}
			}
			
		}
		/* else{
			echo json_encode(array('status' => 'fail'));
		} */
		echo $add_drawal;
	}
	public function searchusers_farmers()
	{
		$all = "";
		$search = $_POST['search'];	$all = '';
		//$search = $_GET['term'];
		echo $response = $this->Withdrawal_model->getSearchUsers(urldecode($search),$all);		
		exit;
	}
	public function getWithdrawalDetails($wid)
	{
		echo $response = $this->Withdrawal_model->getWithdrawalDetails($wid);
	}
	
	//14-sep-2020 by venu
	public function check_accno_for_tooltip()
	{		
		$final_res = json_decode($this->Users_model->check_brand_accno($_POST["acc_no"]),true);
		if($final_res["status"] == "exists" ){	echo 'false'; }else{ echo 'true';}
		exit;
	}
	//Add User
	public function createUser(){
		
		$action=$_POST['action']; $kyc_flag = 0;
		//echo $_POST['fname'][0]; exit;
		//print_r($_POST);exit;
		if(!empty($_POST['fname'][0]) && !empty($_POST['ac_number'][0]) && !empty($_POST['bc_name'][0]) && !empty($_POST['ifsc'][$b]) && !empty($_POST['branch_name'][0])){ $bank_flag = 1; }else{ $bank_flag = 0; }
		if($_POST['optradio']=='sing_far' || $_POST['optradio']=='par_far'){ 
			if(!empty(trim($_POST['aadhar_no'])) && !empty(trim($_POST['pan_no']))){ $kyc_flag = 1;}
		}
		//Users
		$user=[
				'firm_name'=>(!empty($_POST['firm_name']))?trim(ucwords($_POST['firm_name'])):"",
				'user_name'=>(!empty($_POST['user_name']))?trim(ucwords($_POST['user_name'])):"",
				'owner_name'=>(!empty($_POST['owner_name']))?trim(ucwords($_POST['owner_name'])):"",
				'mobile'=>(!empty($_POST['mobile']))?trim($_POST['mobile']):"",
				'email'=>(!empty($_POST['email']))?trim($_POST['email']):"",
				'user_type'=>strtoupper($action),
				'guarantor'=>(!empty($_POST['guarantor']))?trim(ucwords($_POST['guarantor'])):"",
				'doj'=>date('Y-m-d H:i:s'),
				'kyc_flag'=>$kyc_flag,
				'bank_flag'=>$bank_flag
			  ];
		$user_id=$this->Users_model->addUser($user);

		//user_additional_info
		//$user_id=18;
		$year=date('Y');
		$user_id_str=($user_id>0 && $user_id<10)?'0'.$user_id.$year:$user_id.$year;
		$add_info=[
					'user_id'=>$user_id,
					'aadhar_no'=>(!empty($_POST['aadhar_no']))?trim($_POST['aadhar_no']):"",
					'pan_no'=>(!empty($_POST['pan_no']))?trim($_POST['pan_no']):"",
					'gst'=>(!empty($_POST['gst']))?trim($_POST['gst']):"",
					'notify_alert'=>(!empty($_POST['notify_alert']))?trim($_POST['notify_alert']):"",
					'feed'=>(!empty($_POST['feed']))?trim($_POST['feed']):"",
					'roi'=>(!empty($_POST['roi']))?trim($_POST['roi']):"",
					'doc_rem'=>(!empty($_POST['doc_rem']))?trim($_POST['doc_rem']):"",
					'doc_received_date'=>(!empty($_POST['recdate']))?trim($_POST['recdate']):"0000:00:00 00:00",
					'doc_return_date'=>(!empty($_POST['retdate']))?trim($_POST['retdate']):"0000:00:00 00:00",
					'credit_limit'=>(!empty($_POST['credit_limit']))?trim($_POST['credit_limit']):"",
					'open_balance'=>(!empty($_POST['open_balance']))?trim($_POST['open_balance']):"",
				  ];

		//Medicines
		/* if($action=='farmer' || $action=='dealer'){
			$mindex=1;
			for($m=0;$m<count($_POST['medicines']);$m++){
				$add_info['medicines'.$mindex]=(!empty($_POST['medicines'][$m]))?trim($_POST['medicines'][$m]):0;
				$add_info['medicines'.$mindex.'_brands']=(!empty($_POST['hidm'.$mindex]))?trim($_POST['hidm'.$mindex]):0;
				$mindex++;
			}
		} */
		$user_info_id=$this->Users_model->addUserInfo($add_info);
		
		//open balance transaction for dealers and non farmers
		if(($action=='non_farmer' || $action=='dealer') && !empty($_POST['open_balance'])){
			$data = array(
				"trans_type" 	=> "OPEN BALANCE",
				"trans" 		=> "USER",
				"trans_id"		=> $user_id,
				"trans_code"	=> 'OP'.$user_id,
				"user_id"		=>  $user_id,
				"user_type"		=>	$action,
				"crop_id"		=> 	$insert_id,
				"amount"		=>	(!empty($_POST['open_balance']))?trim($_POST['open_balance']):"0",
				"amount_type"	=>	"IN",
				"description"	=>	"Open balance",
				"status"		=>	"0",
				"created_by"	=>	$this->session->userdata('adminid'),
			);
			$this->Transaction_model->insert($data);
		}

		//Alert
		if(!empty($_POST['notify_alert'])){
			if(!empty($_POST['mobile']) && !empty($_POST['email'])){	
				$mobile_arr=explode($_POST['hid_mob'], ",");
				$alert_me=[];
				if(count($mobile_arr)>1){
					for($i=0;$i<count($mobile_arr);$i++){
						if(!empty($mobile_arr[$i])){
							$alert_me[]=['user_id'=>$user_id,'contact_type'=>'M','contact'=>trim($mobile_arr[$i])];
						}
					}
				}else{
					$alert_me[]=['user_id'=>$user_id,'contact_type'=>'M','contact'=>trim($_POST['hid_mob'])];
				}

				$email_arr=explode($_POST['hid_mail'], ",");
				if(count($email_arr)>1){
					for($j=0;$j<count($email_arr);$j++){
						if(!empty($email_arr[$j])){
							$alert_me[]=['user_id'=>$user_id,'contact_type'=>'E','contact'=>trim($email_arr[$j])];
						}
					}
				}else{
					$alert_me[]=['user_id'=>$user_id,'contact_type'=>'E','contact'=>trim($_POST['hid_mail'])];
				}
				$this->Users_model->addAlerts($alert_me);
			}
		}

		//user_bank_accounts
		//if(count($_POST['fname'])>0 && empty($_POST['bank_skip'])){
		//if(count($_POST['fname'])>0){
		if(!empty($_POST['fname'][0])){
		
			for($b=0;$b<count($_POST['fname']);$b++){
				if(!empty($_POST['fname'][$b]) && !empty($_POST['ac_number'][$b]) && !empty($_POST['bc_name'][$b]) && !empty($_POST['ifsc'][$b]) && !empty($_POST['branch_name'][$b])){	
					$user_bank_accounts[]=['user_id'=>$user_id,
										'full_name'=>(!empty($_POST['fname'][$b]))?trim(ucwords($_POST['fname'][$b])):"",
									   'account_no'=>(!empty($_POST['ac_number'][$b]))?trim($_POST['ac_number'][$b]):"",
									   'bank_name'=>(!empty($_POST['bc_name'][$b]))?trim($_POST['bc_name'][$b]):"",
									   'ifsc'=>(!empty($_POST['ifsc'][$b]))?trim($_POST['ifsc'][$b]):"",
									   'branch_name'=>(!empty($_POST['branch_name'][$b]))?trim(ucwords($_POST['branch_name'][$b])):"",
									   'created_on'=>date('Y-m-d H:i:s')];
				}
			}
			$this->Users_model->addBankDetails($user_bank_accounts);
		}

		if($action=='farmer'){
			//user_crop_details
			if(count($_POST['crop_loc'])>0 && empty($_POST['crop_skip'])){
				for($c=0;$c<count($_POST['crop_loc']);$c++){
					$user_crop_details[]=[
						'user_id'		=>$user_id,
						'crop_location'	=>(!empty($_POST['crop_loc'][$c]))?trim(ucwords($_POST['crop_loc'][$c])):"",
						'crop_type'		=>(!empty($_POST['crop_type'][$c]))?trim(ucwords($_POST['crop_type'][$c])):"",
						'no_of_acres'	=>(!empty($_POST['acres'][$c]))?trim($_POST['acres'][$c]):"",
						'transaction_balance'	=>(!empty($_POST['transaction_balance'][$c]))?trim($_POST['transaction_balance'][$c]):"",
						'created_on'	=>date('Y-m-d H:i:s')];
				}

				$this->Users_model->addCropDetails($user_crop_details);
				$insert_id = $this->db->insert_id();
				$crop_count = count($_POST['crop_loc']);
				for($c=0;$c<$crop_count;$c++){
					//insert transaction
					$data = array(
						"trans_type" 	=> "OPEN BALANCE",
						"trans" 		=> "USER",
						"trans_id"		=> $insert_id,
						"trans_code"	=> 'OP'.$insert_id,
						"user_id"		=>  $user_id,
						"user_type"		=>	'farmer',
						"crop_id"		=> 	$insert_id,
						"amount"		=>	(!empty($_POST['transaction_balance'][$c]))?trim($_POST['transaction_balance'][$c]):"0",
						"amount_type"	=>	"IN",
						"description"	=>	"Open balance",
						"status"		=>	"0",
						"created_by"	=>	$this->session->userdata('adminid'),
					);
					$this->Transaction_model->insert($data);
					$insert_id++;
				}
			}
		}

		$partnership=0; 
		switch($action) {
			case "farmer":
				$utype_code=($_POST['optradio']=='sing_far')?'FS'.$user_id_str:'FP'.$user_id_str;
				//Parter Details
				if($_POST['optradio']=='par_far'){
					for($p=0;$p<count($_POST['pname']);$p++){
						
						if(!empty($_POST['pname'][$p]) && !empty($_POST['paadhar'][$p]) && !empty($_POST['pmobile'][$p])){ $partner_flag = 1;}else{ $partner_flag = 0;} 
						$user_parter_details[]=['user_id'=>$user_id,
											   'partner_name'=>(!empty($_POST['pname'][$p]))?trim(ucwords($_POST['pname'][$p])):"",
											   'aadhar_no'=>(!empty($_POST['paadhar'][$p]))?trim($_POST['paadhar'][$p]):"",
											   'mobile_no'=>(!empty($_POST['pmobile'][$p]))?trim($_POST['pmobile'][$p]):"",
											   'created_on'=>date('Y-m-d H:i:s')];
					}
					$this->Users_model->addPartnerDetails($user_parter_details);
					$partnership=1;
				}
			break;
			case "dealer":
				$utype_code='D'.$user_id_str;
			break;
			default:
				$utype_code='NF'.$user_id_str;
			break;
		}

		//Update User Code
		$this->Users_model->updateUserCode($user_id,['user_code'=>$utype_code,'partnership'=>$partnership,'partner_flag'=>$partner_flag]);
		$upload_dir=FCPATH.'assets'.DIRECTORY_SEPARATOR.'upload_docs'.DIRECTORY_SEPARATOR.$utype_code;
		mkdir($upload_dir, 0777, true);

		//uploades
		if(isset($_FILES))
		{
			if(isset($_FILES["aadhar_upload"])){ 
				$aadhar_files=$this->uploadImage($_FILES["aadhar_upload"],$utype_code,$user_id,'AADHAR');
				$this->Users_model->uploadDoc($aadhar_files);
			}

			if(isset($_FILES["pan_upload"])){ 
				$pan_files=$this->uploadImage($_FILES["pan_upload"],$utype_code,$user_id,'PAN');
				$this->Users_model->uploadDoc($pan_files); 
			}

			if(isset($_FILES["check_upload"])){ 
				$cheque_files = $this->uploadImage($_FILES["check_upload"],$utype_code,$user_id,'CHEQUE');
				$this->Users_model->uploadDoc($cheque_files);
			}

			if(isset($_FILES["gst_upload"])){ 
				$gst_files = $this->uploadImage($_FILES["gst_upload"],$utype_code,$user_id,'GST');
				$this->Users_model->uploadDoc($gst_files);
			}

			if(isset($_FILES["partner_s"])){ 
				$partner_files = $this->uploadImage($_FILES["partner_s"],$utype_code,$user_id,'PARTNER');
				$this->Users_model->uploadDoc($partner_files);
			}

			if(isset($_FILES["promissory"])){ 
				$promissory_files = $this->uploadImage($_FILES["promissory"],$utype_code,$user_id,'PROMISSORY');
				$this->Users_model->uploadDoc($promissory_files);
			}

			if(isset($_FILES["gp_doc"])){ 
				$gp_files = $this->uploadImage($_FILES["gp_doc"],$utype_code,$user_id,'GP');
				$this->Users_model->uploadDoc($gp_files);
			}

			if(isset($_FILES["stamp"])){ 
				$stamp_files = $this->uploadImage($_FILES["stamp"],$utype_code,$user_id,'STAMP');
				$this->Users_model->uploadDoc($stamp_files);
			}
		}

		//echo '<pre>';
		//print_r($add_info);
		//print_r($user_bank_accounts);
		//print_r($user_crop_details);
		//print_r($user_parter_details);
		if($user_id>0){
			$response['user_id']=$user_id;
			$response['error']=false;
			$response['message']='Success';
		}else{
			$response['user_id']='';
			$response['error']=true;
			$response['message']='Fail';
		}
		echo json_encode($response);
	}
}
?>