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

		$fromdate = $fd;
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
		echo $diff;
	}
	public function updatefinaldata()
	{
		

		if($_POST['salestep']==1)
		{
			/*update discount to sales table*/
			$queryss1 = $this->db->query("select * from dummy_account_sale where settled_status=0 and userid='".$_POST['userid']."' and cropid='".$_POST['crop_id']."'  and settled_status=0");
			$dat1ss1 = $queryss1->result_array();
			foreach($dat1ss1 as $daass1)
			{			
				$exx = explode('&',$daass1['product_saleids']);
				for($ii=0;$ii<count($exx);$ii++)
				{
					/*echo "update sale_details set discount='".$daass1['product_discount']."' where s_id='".$exx[$ii]."' and brandid='".$daass1['brand_id']."'  and product_id='".$daass1['product_id']."'";*/
					$a12 = array('discount' =>$daass1['product_discount']);
					$act_resdd2 = $this->Transaction_model->Updatesalediscount($a12,$exx[$ii],$daass1['brand_id'],$daass1['product_id']);

					/*update*/
					$a121 = array('settled_status' =>1);
					$act_resdd2 = $this->Transaction_model->Updatesettledstatus($a121,$daass1['brand_id'],$daass1['product_id']);

				}
			}
			/*update discount to sales table*/
		}
			
		
		if($_POST['loanstep']==1)
		{
			/*update roi to loans table*/
			$queryss = $this->db->query("select * from transactions where trans_type='LOAN' and user_id='".$_POST['userid']."' and crop_id='".$_POST['crop_id']."' and status=0 ");
			$dat1ss = $queryss->result_array();
			foreach($dat1ss as $daass)
			{
				$llla = $this->db->query("select *from transactions where trans_id='".$daass['trans_id']."' ");
				$lla = $llla->row_array();

				$a1 = array('rate_of_interest' => $lla['interestval'],
							'rate_of_value' => $lla['interest_amount'],
							'start_date' => date('Y-m-d',strtotime($lla['loan_startdate'])),
							'end_date' => date('Y-m-d',strtotime($lla['loan_enddate']))
				);
				$act_res2 = $this->Transaction_model->Updateinterest($a1,$daass['trans_id']);

				$a12 = array('settled' => 1);
				$act_res1 = $this->Transaction_model->Updatesetstatus($a12,$daass['trans_id']);
			}
			/*update roi to loans table*/
		}

		$lll = $this->db->query("select *from transaction_settled order by id desc limit 0,1 ");
		$ll = $lll->row_array();
		$bbb = $ll['id']+1;

		$gt = $_POST['gval'];
		if($_POST['gval']>0)
		{
			$bal = $_POST['gval']-$_POST['interestval'];
			$fbal = $bal+$_POST['gdiscount'];
		}
		else
		{
			$bal = $_POST['gval']+$_POST['interestval'];
			$fbal = $bal-$_POST['gdiscount'];
		}
		
		if($fbal>0)
		{
			$ftype = 'Gain';
		}
		else
		{
			$ftype = 'Loss';
		}

		$activity_posts = array('settled_date' => date('Y-m-d'),
						'settled_code' => '2020_crop_'.$bbb,
						'user_id' => $_POST['userid'],
						'crop_id' => $_POST['crop_id'],
						'balance_amount' => $fbal,
						'amount_type' => $ftype,
						'note' => '',
						'created_on' => date('Y-m-d')
		);
		$act_res = $this->Transaction_model->insertfinalact($activity_posts);
		$fid = $act_res;

		if($_POST['salestep']==1)
		{
			//discount record insert
			$querybu = $this->db->query("select *from users where user_id='".$_POST['userid']."' ");
			$dataau = $querybu->row_array();

			$activity_posts1 = array('trans_type' => 'SALE',
							'trans' => 'Discount',
							'user_id' => $_POST['userid'],
							'user_type' => $dataau['user_type'],
							'crop_id' => $_POST['crop_id'],
							'amount' => $_POST['gdiscount'],
							'amount_type' => 'IN',
							'status' => 1,
							'settled_id' => $fid,
							'created_on' => date('Y-m-d'),
							'created_by' => 1,
							'updated_on' => date('Y-m-d'),
							'updated_by' => 1
			);
			$act_res1 = $this->Transaction_model->insert($activity_posts1);
		}

		if($_POST['loanstep']==1)
		{
			$activity_posts1 = array('trans_type' => 'LOAN',
							'trans' => 'Interest',
							'user_id' => $_POST['userid'],
							'user_type' => $dataau['user_type'],
							'crop_id' => $_POST['crop_id'],
							'amount' => $_POST['interestval'],
							'amount_type' => 'OUT',
							'status' => 1,
							'settled_id' => $fid,
							'created_on' => date('Y-m-d'),
							'created_by' => 1,
							'updated_on' => date('Y-m-d'),
							'updated_by' => 1
			);
			$act_res1 = $this->Transaction_model->insert($activity_posts1);
		}
		
		//interest recored insert

		/*update records*/
		$activity_posts2 = array('settled_id' => $fid,
						'status' => 1
		);
		$act_res2 = $this->Transaction_model->Updatesettleaccount($activity_posts2,$_POST['userid'],$_POST['crop_id'],$_POST['loanstep'],$_POST['salestep']);
		echo json_encode($act_res2);
	}
	public function purchaseamountval()
	{
		$queryb = $this->db->query("select *from products where brand_id='".$_POST['bid']."' and pid='".$_POST['pid']."' ");
		$dataa = $queryb->row_array();

		echo $dataa['purchase_amt'];
	}
	public function purchaseamountvalbrand()
	{
		$queryb = $this->db->query("select MIN(purchase_amt) as purchase_amt from products where brand_id='".$_POST['bid']."'  ");
		$dataa = $queryb->row_array();

		echo $dataa['purchase_amt'];
	}
	public function saledataupdate()
	{
		//print_r($_POST);
		for($i=0;$i<count($_POST['brandid']);$i++)
		{
			//echo $_POST['prodid'][$i].',,,,,'.$_POST['categoryid'][$i].',,,,'.$_POST['brandid'][$i].',,,'.$_POST['branddiscount'][$i];

			if(!empty($_POST['prodid'][$i]) && !empty($_POST['categoryid'][$i]) && !empty($_POST['brandid'][$i]) && !empty($_POST['branddiscount'][$i]) )
			{
				if($_POST['prodid'][$i]!='' && $_POST['prodid'][$i]!=0)
				{
					$queryb = $this->db->query("select *from dummy_account_sale where category_id='".$_POST['categoryid'][$i]."' and 	brand_id='".$_POST['brandid'][$i]."' and userid='".$_POST['auserid']."' and cropid='".$_POST['acropid']."' and product_id='".$_POST['prodid'][$i]."' and settled_status=0");
				}
				else
				{
					$queryb = $this->db->query("select *from dummy_account_sale where category_id='".$_POST['categoryid'][$i]."' and 	brand_id='".$_POST['brandid'][$i]."' and userid='".$_POST['auserid']."' and cropid='".$_POST['acropid']."' and settled_status=0");
				}
				
				
				$dataa = $queryb->num_rows();
				if($dataa>0)
				{	
					$activity_posts = array('product_id' => $_POST['prodid'][$i],
						'category_id' => $_POST['categoryid'][$i],
						'brand_id' => $_POST['brandid'][$i],
						'brand_discount' => $_POST['branddiscount'][$i],
						'brand_total' => $_POST['brandtotamtval'][$i],
						'brand_acttotal' => $_POST['brandtotamtvalact'][$i],
						'product_discount' => $_POST['pro_discount'][$i],
						'product_total' => $_POST['pro_totval'][$i],
						'product_acttotal' => $_POST['pro_totvalact'][$i],
						'settled_status'=>0,
						'userid'=> $_POST['auserid'],
						'cropid'=> $_POST['acropid'],
						'product_saleids'=> $_POST['prosids'][$i],
						'brand_saleids'=> $_POST['prosids'][$i]
					);
					$act_res = $this->Transaction_model->updateaccountActivity($activity_posts,$_POST['auserid'],$_POST['acropid'],$_POST['brandid'][$i],$_POST['categoryid'][$i],$_POST['prodid'][$i]);
				}
				else
				{
					$activity_posts = array('product_id' => $_POST['prodid'][$i],
						'category_id' => $_POST['categoryid'][$i],
						'brand_id' => $_POST['brandid'][$i],
						'brand_discount' => $_POST['branddiscount'][$i],
						'brand_total' => $_POST['brandtotamtvalact'][$i],
						'brand_acttotal' => $_POST['brandtotamtvalact'][$i],
						'product_discount' => $_POST['pro_discount'][$i],
						'product_total' => $_POST['pro_totvalact'][$i],
						'product_acttotal' => $_POST['pro_totvalact'][$i],
						'settled_status'=>0,
						'userid'=> $_POST['userid'],
						'cropid'=> $_POST['acropid'],
						'product_saleids'=> $_POST['prosids'][$i],
						'brand_saleids'=> $_POST['prosids'][$i]
					);
					$act_res = $this->Transaction_model->insertaccountActivity($activity_posts);
				}
			}

		}
		echo json_encode($act_res);
	}
	public function loandataupdate()
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
	}
	public function getproductsfeed()
	{

				$this->db->select('transactions.*, sale.id,sale.branchid as brnchid,sale_details.product_id,sale_details.brandid as brandid,products.cat_id,categories.cat_id as categoryid,categories.cat_name, sum(`transactions`.`amount`) as `totamt`');
				$this->db->join('sale', 'sale.id = transactions.trans_id','left');
				$this->db->join('sale_details', 'sale_details.s_id = sale.id','left');
				$this->db->join('products', 'products.pid = sale_details.product_id','left');
				$this->db->join('categories', 'categories.cat_id = products.cat_id','left');
				$query = $this->db->get_where("transactions", ['transactions.trans_type' => 'SALE','transactions.user_id'=>$_POST['userid'],'transactions.crop_id'=>$_POST['crop_id'],'products.cat_id'=>1,'transactions.status'=>0]);
				$dat1 = $query->result_array(); 
				
				foreach($dat1 as $daa)
				{
					$queryb = $this->db->query("select *from products where pid='".$daa['product_id']."' ");
					$dataa = $queryb->row_array();

					$data[] = array("product_name"=>$dataa['pname'],'totprice'=>$daa['total_saleprice'],'product_id'=>$daa['product_id']);
				}

				echo json_encode($data);

	}
	public function getproductsdata()
	{
				$this->db->select('transactions.*, sale.id,sale.id as sid,sale.branchid as brnchid,sale_details.product_id,sale_details.mrp,sale_details.quantity,sale_details.brandid as brandid,products.cat_id,categories.cat_id as categoryid,categories.cat_name');
				$this->db->join('sale', 'sale.id = transactions.trans_id','left');
				$this->db->join('sale_details', 'sale_details.s_id = sale.id','left');
				$this->db->join('products', 'products.pid = sale_details.product_id','left');
				$this->db->join('categories', 'categories.cat_id = products.cat_id','left');
				/*$query = $this->db->get_where("transactions", ['transactions.trans_type' => 'SALE','transactions.user_id'=>$_POST['userid'],'transactions.crop_id'=>$_POST['crop_id'],'products.cat_id'=>$_POST['category'],'sale_details.brandid'=>$_POST['branchid'],'transactions.status'=>0]);*/
				$this->db->group_by('product_id');
				$query = $this->db->get_where("transactions", ['transactions.trans_type' => 'SALE','transactions.user_id'=>$_POST['userid'],'transactions.crop_id'=>$_POST['crop_id'],'products.cat_id'=>$_POST['category'],'sale_details.brandid'=>$_POST['branchid'],'transactions.status'=>0]);
				$dat1 = $query->result_array();

				//echo $this->db->last_query();
				foreach($dat1 as $daa)
				{
					$queryb = $this->db->query("select *from products where pid='".$daa['product_id']."' ");
					$dataa = $queryb->row_array();
					$qq = $dataa['pmrp'];

					/*data*/
					$qqa = $this->db->query("select *from transactions where trans_type='SALE' and user_id='".$_POST['userid']."' and crop_id='".$_POST['crop_id']."' and status=0 group by trans_id");
					$dat1a = $qqa->result_array();
					$totsub = 0;
					foreach($dat1a as $daaa1)
					{
						
						$querybn = $this->db->query("select *from sale_details where s_id='".$daaa1['trans_id']."' and product_id='".$daa['product_id']."' ");
						$dataan = $querybn->row_array();
						
						$totsub+= $dataan['quantity']*$dataan['mrp'];
					}

					/*data*/

					/*get saleids*/
					$this->db->select('transactions.*, sale.id,sale.branchid as brnchid,sale_details.product_id,sale_details.brandid as brandid,products.cat_id,categories.cat_id as categoryid,categories.cat_name');
					$this->db->join('sale', 'sale.id = transactions.trans_id','left');
					$this->db->join('sale_details', 'sale_details.s_id = sale.id','left');
					$this->db->join('products', 'products.pid = sale_details.product_id','left');
					$this->db->join('categories', 'categories.cat_id = products.cat_id','left');
					$querys1 = $this->db->get_where("transactions", ['transactions.trans_type' => 'SALE','transactions.trans' => 'GOODS','transactions.user_id'=>$_POST['userid'],'transactions.crop_id'=>$_POST['crop_id'],'products.cat_id'=>$daa['categoryid'],'transactions.status'=>0,'sale_details.brandid'=>$daa['brandid'],'sale_details.product_id'=>$daa['product_id']]);
					$dats1 = $querys1->result_array(); 
					$ids = '';
					//echo $this->db->last_query();
					foreach($dats1 as $daa1)
					{
						$ids = $daa1['trans_id'].'&&';
					}
					$sids = substr($ids,0,-1);

					/*get saleids*/
					
					
					$querybn1 = $this->db->query("select *from dummy_account_sale where userid='".$_POST['userid']."' and cropid='".$_POST['crop_id']."' and category_id='".$_POST['category']."' and brand_id='".$_POST['branchid']."' and product_id='".$daa['product_id']."' and settled_status=0");
						$dataan1 = $querybn1->row_array();

					//print_r($dataan1);

					$data[] = array("product_name"=>$dataa['pname'],'totprice'=>$totsub,'quantity'=>$daa['sqty'],'product_id'=>$daa['product_id'],'prodiscount'=>$dataan1['product_discount'],'sids'=>$sids,'proamount'=>$qq);
				}

				echo json_encode($data);

	}
	public function getfinaldata()
	{
		$params['user_id'] = $_POST['userid'];
		$params['crop_id'] = $_POST['crop_id'];

		$query = $this->db->query("select sum(amount) as transamount from transactions where trans='TRANSPORT' and user_id='".$_POST['userid']."' and crop_id='".$_POST['crop_id']."' ");
		$transport = $query->row_array();

		$query1 = $this->db->query("select sum(amount) as labamount from transactions where trans='LAB FEE' and user_id='".$_POST['userid']."' and crop_id='".$_POST['crop_id']."' ");
		$lab = $query1->row_array();

		$query2 = $this->db->query("select sum(amount) as receiptamount from transactions where trans_type='RECEIPT' and user_id='".$_POST['userid']."' and crop_id='".$_POST['crop_id']."' ");
		$receipt = $query2->row_array();

		$query3 = $this->db->query("select sum(amount) as harvestamount from transactions where trans='HARVEST' and user_id='".$_POST['userid']."' and crop_id='".$_POST['crop_id']."' ");
		$harvest = $query3->row_array();


		$query4 = $this->db->query("select sum(farmer_fweight) as harvestwght from trade where tradetype=0 and userid='".$_POST['userid']."' and location='".$_POST['crop_id']."' ");
		$trade = $query4->row_array();


		$this->db->select('transactions.*, sale.id,sale.branchid as brnchid,sale_details.product_id,sale_details.quantity,sale_details.brandid as brandid,products.cat_id,categories.cat_id as categoryid,categories.cat_name, sum(`sale_details`.`quantity`) as `totqty`');
		$this->db->join('sale', 'sale.id = transactions.trans_id','left');
		$this->db->join('sale_details', 'sale_details.s_id = sale.id','left');
		$this->db->join('products', 'products.pid = sale_details.product_id','left');
		$this->db->join('categories', 'categories.cat_id = products.cat_id','left');
		$this->db->group_by('brandid');
		$query6 = $this->db->get_where("transactions", ['transactions.trans_type' => 'SALE','transactions.user_id'=>$_POST['userid'],'transactions.crop_id'=>$_POST['crop_id'],'products.cat_id'=>1]);
		$feedusage = $query6->row_array(); 

		//echo $this->db->last_query();

		/*convert kgs to tons*/
		$tton = $trade['harvestwght']/1000;
       
       $fusage = $feedusage['totqty'];
		
		/*convert kgs to tons*/

		$data[] = array("transport"=>$transport['transamount'],'lab'=>$lab['labamount'],'receipt'=>$receipt['receiptamount'],'returnamount'=>0,'harvest'=>$harvest['harvestamount'],'tradetons'=>$tton,'feedusage'=>$fusage);
        
		echo json_encode($data);

	}
	public function getfeedproducts()
	{
		$this->db->select('transactions.*, sale.id as saleid,sale.branchid as brnchid,sale_details.product_id,sale_details.quantity,sale_details.s_id,sale_details.brandid as brandid,products.cat_id,products.qty,categories.cat_id as categoryid,categories.cat_name, `sale_details`.`quantity`');
		$this->db->join('sale', 'sale.id = transactions.trans_id','left');
		$this->db->join('sale_details', 'sale_details.s_id = sale.id','left');
		$this->db->join('products', 'products.pid = sale_details.product_id','left');
		$this->db->join('categories', 'categories.cat_id = products.cat_id','left');
		$this->db->group_by('product_id');
		$query6 = $this->db->get_where("transactions", ['transactions.trans_type' => 'SALE','transactions.user_id'=>$_POST['userid'],'transactions.crop_id'=>$_POST['crop_id'],'products.cat_id'=>1]);
		$dat1 = $query6->result_array(); 
				//echo $this->db->last_query();
		foreach($dat1 as $daa)
		{
				$queryb = $this->db->query("select *from products where pid='".$daa['product_id']."' ");
				$dataa = $queryb->row_array();

				$queryu = $this->db->query("select *from units where id='".$dataa['weightage']."' ");
				$units = $queryu->row_array();

				$queryu = $this->db->query("select *from packing_types where id='".$dataa['per_item']."' ");
				$packing_types = $queryu->row_array();

				$query1 = $this->db->query("select sum(quantity) as squantity from sale_details where s_id='".$daa['saleid']."' ");
				$qun = $query1->row_array();

				$feedd = $dataa['qty']*$qun['squantity'];

				$data[] = array("product_name"=>$dataa['pname'],'totprice'=>$daa['total_saleprice'],'product_id'=>$daa['product_id'],'units'=>$units['unit_name'],'packing_types'=>$packing_types['packing_type'],'qty'=>$dataa['qty'],'quantity'=>$qun['squantity'],'feedweight'=>$feedd);
		}

		echo json_encode($data);

	}
	public function getsalesdata()
	{
		$params['user_id'] = $_POST['userid'];
		$params['crop_id'] = $_POST['crop_id'];

		$records=$this->Transaction_model->getRecordssale($params);
		
		$ids = '';
		$recordids=$this->Transaction_model->getsaleids($params);
		foreach($recordids as $valueids)
		{
			$ids .= $valueids['trans_id'].',';
		}
		$subs = substr($ids, 0,-1);

		$data = array();
		$amount = 0;
		if($records)
		{
			foreach($records as $value)
			{
				$this->db->select('transactions.*, sale.id,sale.branchid as brnchid,sale_details.product_id,sale_details.brandid as brandid,products.cat_id,categories.cat_id as categoryid,categories.cat_name, sum(`sale_details`.`total_price`) as `totamt`,sum(`sale_details`.`quantity`) as `sqty`');
				$this->db->join('sale', 'sale.id = transactions.trans_id','left');
				$this->db->join('sale_details', 'sale_details.s_id = sale.id','left');
				$this->db->join('products', 'products.pid = sale_details.product_id','left');
				$this->db->join('categories', 'categories.cat_id = products.cat_id','left');
				$this->db->group_by('brandid');
				$query = $this->db->get_where("transactions", ['transactions.trans_type' => 'SALE','transactions.trans' => 'GOODS','transactions.user_id'=>$params['user_id'],'transactions.crop_id'=>$params['crop_id'],'products.cat_id'=>$value['categoryid'],'transactions.status'=>0]);
				
				//echo $this->db->last_query();
				$dat1 = $query->result_array(); 
				$branchid = '';
				$branchname = '';
				$bbid = '';
				$bamount = '';
				$sum = 0;
				$bds = '';
				$sidss = ''; 

				foreach($dat1 as $daa)
				{
					$queryb = $this->db->query("select *from brands where brand_id='".$daa['brandid']."' ");
					$dataa = $queryb->row_array();

					$querybv = $this->db->query("select *from dummy_account_sale where userid='".$params['user_id']."' and cropid='".$params['crop_id']."' and category_id='".$value['categoryid']."' and brand_id='".$daa['brandid']."' and settled_status=0");
					$dataav = $querybv->row_array();

					/*get saleids*/
					$this->db->select('transactions.*, sale.id,sale.branchid as brnchid,sale_details.product_id,sale_details.brandid as brandid,products.cat_id,categories.cat_id as categoryid,categories.cat_name');
					$this->db->join('sale', 'sale.id = transactions.trans_id','left');
					$this->db->join('sale_details', 'sale_details.s_id = sale.id','left');
					$this->db->join('products', 'products.pid = sale_details.product_id','left');
					$this->db->join('categories', 'categories.cat_id = products.cat_id','left');
					$querys1 = $this->db->get_where("transactions", ['transactions.trans_type' => 'SALE','transactions.trans' => 'GOODS','transactions.user_id'=>$params['user_id'],'transactions.crop_id'=>$params['crop_id'],'products.cat_id'=>$value['categoryid'],'transactions.status'=>0,'sale_details.brandid'=>$daa['brandid']]);
					$dats1 = $querys1->result_array(); 
					$ids = '';
					foreach($dats1 as $daa1)
					{
						$ids = $daa1['trans_id'].'&&';
					}
					$sids = substr($ids,0,-1);

					/*get saleids*/

					$bbid++;
					$bamount .= $daa['totamt'].',';
					$branchid .= $daa['brandid'].',';
					$branchname .= $dataa['brand_name'].',';
					$sum+= $daa['totamt'];
					$bds .= $dataav['brand_discount'].',';
					$sidss .= $sids.',';
				}
				$bid = substr($branchid,0,-1);
				$bname = substr($branchname,0,-1);
				$bdss = substr($bds,0,-1);
				$siddss = substr($sidss,0,-1);

				$tdata = $this->db->query("select *from transactions where user_id='".$_POST['user_id']."' and crop_id='".$_POST['crop_id']."' order by id asc ");
				$tdates = $tdata->row_array();
				$bdate = date('d-M-Y',strtotime($tdates['created_on']));

				$data[] = array("category"=>$value['categoryid'],'categoryname'=>$value['cat_name'],'branchid'=>$bid,'branchname'=>$bname,'bcount'=>$bbid,'totamount'=>$bamount,'totalamount'=>$sum,'bdiscount'=>$bdss,'billdate'=>$bdate,'sids'=>$siddss);
			}
		}
		
		//return json_encode($data);
		$response=[];
		echo json_encode($data);

	}
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
			foreach($tansactions as $key=>$value)
			{
				$ldata = $this->db->query("select *from loan_activity where loan_id='68' ");
				$ltds = $ldata->row_array();

				

				if($value['loan_startdate']!='' && $value['loan_enddate']!='')
				{
					$sdate = date('d-M-Y',strtotime($value['loan_startdate']));
					$edate = date('d-M-Y',strtotime($value['loan_enddate']));
					
				}
				else if($ltds['start_date']!='' && $ltds['end_date']!='')
				{
					$sdate = date('d-M-Y',strtotime($ltds['start_date']));
					$edate = date('d-M-Y',strtotime($ltds['end_date']));
					
				}
				else
				{
					$sdate = date('d-M-Y',strtotime($value["created_on"]));
					$edate = date('d-M-Y');
					
				}

				if($value['interestval']!='' && $value['interestval']!=null && $value['interestval']!=0)
				{
					
					$roi = $value['interestval'];
				}
				else if($ltds['rate_of_interest']!='' )
				{
					
					$roi = $ltds['rate_of_interest'];
				}
				else
				{
					$roi = '';
				}
						


				$diff = strtotime(date('d-M-Y')) - strtotime($value["created_on"]);
				$dateDiff = abs(round($diff / 86400));

				$date_diff = abs(strtotime(date('d-M-Y')) - strtotime($value["created_on"]));
				
				$years = floor($date_diff / (365*60*60*24));
				$months = floor(($date_diff - $years * 365*60*60*24) / (30*60*60*24)); 

				$tdata = $this->db->query("select *from transactions where user_id='".$params['user_id']."' and crop_id='".$_POST['crop_id']."' order by id asc ");
				$tdates = $tdata->row_array();
				$bdate = date('d-M-Y',strtotime($tdates['created_on'])).' to '.date('d-M-Y');

				$data[] = array("trans_id"=>$value['trans_id'],"trans_code"=>$value['trans_code'],"amount"=>$value['amount'],"croploan"=>'Crop Loan',"startdate"=>$sdate,"enddate"=>$edate,'days'=>$dateDiff,'months'=>$months,'interestval'=>$roi,'interest_amount'=>$value['interest_amount'],'total_amount'=>$value['total_amount'],'id'=>$value['id'],'billdate'=>$bdate);

			}
		}
		//return json_encode($data);
		$response=[];
		
		/*$response["recordsTotal"]=$total_count;
		$response["recordsFiltered"]=$total_count;
		
		$response["total_trans_amount"] = $amount;
		$response["open_balance"] = $open_balance;*/
		//$response["data"]=$data;
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
					$amt = '<span class="txt_red">'."₹".number_format($value['amount'],2).'<div class="arr_blk"> <img src="http://3.7.44.132/aquacredit/assets/images/rd_c_ar.png"> </div></span>';
				}  
				else 
				{
					$amount +=$value["amount"];
					$amt = '<span class="grn_clr">'."₹".number_format($value['amount'],2).'<div class="arr_blk"> <img src="http://3.7.44.132/aquacredit/assets/images/grn_c_ar.png"> </div></span>';
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
		$data["open_balance"] = $this->Users_model->open_balance($user_id,$crop_id);
		//$data["crop"] = $crop;
		//echo "<pre>"; print_r($data); echo "</pre>"; exit;
		$html=$this->load->view('admin/pdf_transaction',$data,true); 
		//exit;
		$time = time();
		$pdfFilePath = $_SERVER['DOCUMENT_ROOT']."/aquacredit/assets/pdf/transactions/trans_".date('m-d-Y_hia').".pdf";	

        $this->load->library('Pdf');
		$pdf = new Pdf('P', 'mm', 'A5', true, 'UTF-8', false);
		$pdf->SetTitle('AquaDeals Invoice');

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
}
?>