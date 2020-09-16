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
		$this->load->model('api/Loans_model');
		$this->load->model('api/Sales_model');
		$this->load->model('api/Trades_model');
		$this->load->model('api/Transaction_model');
		$this->load->helper('form');
		$this->load->helper('captcha');
		$this->load->helper('url');
		$this->load->library('upload');
		
		setlocale(LC_MONETARY, 'en_IN');		
		
		header('Access-Control-Allow-Origin: *');
		
		if($this->session->userdata('adminid') == "")
		{ 
			redirect('admin/login');			
		}
	}

	//Index function
	public function index()
	{		

		$data["page_title"] = "Users";				
		$adminid = $this->session->userdata("adminid");
		$data['usersummary']=$this->Users_model->getUserSummary();
		$this->load->view('admin/users',$data);
	}	
	
	public function details($uid = null)
	{
		$data["page_title"] = "User Details";				
		$adminid = $this->session->userdata("adminid");
		$data['user'] = $this->Users_model->getUser($uid);
		//total loans
		$data['totalLoan'] = $this->Loans_model->getTotalLoansOfUser($uid);
		//total orders
		$data['totalOrders'] = $this->Sales_model->getTotalSaleByUser($uid);
		//total harvets
		$data["totalHarvest"] = $this->Trades_model->getTotalTradeByUser($uid);
		//total acres
		$data["totalAcres"] = $this->Users_model->getUserTotalCrop($uid);
		$this->load->view('admin/userdetails',$data);
	}

	public function getAnalytics()
	{
		$data['cropLoan'] = $this->Loans_model->getTotalLoansOfUser($this->input->post("user_id"),$this->input->post("crop_id"));
		//total orders
		$data['cropOrders'] = $this->Sales_model->getTotalSaleByUser($this->input->post("user_id"),$this->input->post("crop_id"));
		//total harvets
		$data["cropHarvest"] = $this->Trades_model->getTotalTradeByUser($this->input->post("user_id"),$this->input->post("crop_id"));
		//total acres
		$data["cropAcres"] = $this->Users_model->getUserTotalCrop($this->input->post("user_id"),$this->input->post("crop_id"));

		echo json_encode($data);
	}
	
	public function details1()
	{
		$data["page_title"] = "User Details";				
		$adminid = $this->session->userdata("adminid");
		$this->load->view('admin/userdetails_b',$data);
	}
	
	public function create()
	{
		$data["page_title"] = "Create User";				
		$adminid = $this->session->userdata("adminid");
		$this->load->view('admin/createuser',$data);
	}
	

	public function edit($user_id)
	{	
		$data["page_title"] = "Edit User";
		//Brands
		$data["brands"]=$this->Users_model->getBrands();
		//User and Info
		$data["user"]=$this->Users_model->getUser($user_id);

		//Medicines
		if($data["user"]["user_type"]=='FARMER' || $data["user"]["user_type"]=='DEALER'){
			//Default Default Medicines
			$med_res=$this->getDefaultMedicineBrands();
			$data["med1"]=$data["user"]["medicines1_brands"];
			$data["med2"]=$data["user"]["medicines2_brands"];
			$data["med3"]=$data["user"]["medicines3_brands"];
			$data["med4"]=$data["user"]["medicines4_brands"];
			$data["med5"]=$data["user"]["medicines5_brands"];
			$data["med6"]=$data["user"]["medicines6_brands"];

			$user_medicines="";
			$med_cnt=0;
			$med_ids=[];
			for($i=1;$i<=6;$i++){
				if(!empty($data["med".$i])){
					if(in_array($i,[1,2,3])){
						$user_medicines.=$data["med".$i].",";
					}
				}

				if($data["user"]["medicines".$i]>0){
					$med_cnt++;
					$med_ids[]=$i;
				}
			}
			$user_med=rtrim($user_medicines,",");
			$data["allmed"]=$user_med;
			$data["allmed_arr"]=explode(",",$user_med);
			$data["med_cnt"]=$med_cnt;
			$data["med_ids"]=implode(",",$med_ids);
		}
		
		//Bank Acc
		$bank_acc=$this->Users_model->getUserBankAcc($user_id);
		$bcnt=(count($bank_acc)>0)?count($bank_acc):0;
		$bc_ids="";
		if($bcnt>0){
			$bc_ids=$this->getIDS($bcnt);
		}

		$data["bank_acc"]=$bank_acc;
		$data["bcnt"]=($bcnt>0)?$bcnt:0;
		$data["bc_ids"]=$bc_ids;

		//Crops
		if($data["user"]["user_type"]=='FARMER'){
			$crops=$this->Users_model->getUserCrops($user_id);
			$ccnt=(count($crops)>0)?count($crops):0;
			$cc_ids="";
			if($ccnt>0){
				$cc_ids=$this->getIDS($ccnt);
			}

			$data["crops"]=$crops;
			$data["ccnt"]=($ccnt>0)?$ccnt:0;
			$data["cc_ids"]=$cc_ids;

			//Partners
			$partners=$this->Users_model->getUserParteners($user_id);
			$pcnt=(count($partners)>0)?count($partners):0;
			$pids="";
			if($pcnt>0){
				$pids=$this->getIDS($pcnt);
			}
			$data["partners"]=$partners;
			$data["pcnt"]=($pcnt>0)?$pcnt:0;
			$data["pids"]=$pids;
		}

		//Alerts
		$alerts=$this->Users_model->getUserAlerts($user_id);
		$alert_m=$alert_e=$alert_mids=$alert_eids=$amobiles=$emails=[];
		for($a=0;$a<count($alerts);$a++){
			if($alerts[$a]['contact_type']=='M'){
				$alert_m[]=$alerts[$a]['contact'];
				$alert_mids[]=$alerts[$a]['uc_id'];
				$amobiles[]=['uc_id'=>$alerts[$a]['uc_id'],'contact'=>$alerts[$a]['contact']];
			}else if($alerts[$a]['contact_type']=='E'){
				$alert_e[]=$alerts[$a]['contact'];
				$alert_eids[]=$alerts[$a]['uc_id'];
				$emobiles[]=['uc_id'=>$alerts[$a]['uc_id'],'contact'=>$alerts[$a]['contact']];
			}
		}
		$data["alerts"]=$alerts;
		$data["amobiles"]=$amobiles;
		$data["emobiles"]=$emobiles;
		$data["alert_m"]=$alert_m;
		$data["alert_mids"]=$alert_mids;
		$data["alert_e"]=$alert_e;
		$data["alert_eids"]=$alert_eids;


		//User uploads
		$data["upload_docs"]=$this->Users_model->getUserUploads($user_id);
		$this->load->view('admin/edituser',$data);
	}

	public function getIDS($cnt){
		$ids=[];
		for($i=1;$i<=$cnt;$i++){
			$ids[]=$i;
		}

		return implode(",",$ids);
	}

	//Check Mobile Exist
	public function checkmobile_exists()
	{
		$mobnum=trim($_POST["mobnum"]);
		$res=$this->Users_model->checkMobile($mobnum);
		echo $res;
	}

	//Update Mobile
	public function updatemobile()
	{
		$mobnum=trim($_POST["mobnum"]);
		$user_id=trim($_POST["user_id"]);
		$res=$this->Users_model->updateMobile($mobnum,$user_id);
		echo $res;
	}

	public function getDefaultMedicineBrands(){
		$med1=$med2=$med3=$allmed=[];
		$comman_med=[1,2,3];
		$medicines=$this->Users_model->getDefaultMedicineBrands($comman_med);
		if(count($medicines)>0){
			foreach ($medicines as $value) {
				if($value['medicine_type']==1){
					$med1[]=$value['brand_id'];
				}

				if($value['medicine_type']==2){
					$med2[]=$value['brand_id'];
				}

				if($value['medicine_type']==3){
					$med3[]=$value['brand_id'];
				}

				$allmed[]=$value['brand_id'];
			}
			
		}

		$res['med1']=(count($med1)>0)?implode(",", $med1):"";
		$res['med2']=(count($med2)>0)?implode(",", $med2):"";
		$res['med3']=(count($med3)>0)?implode(",", $med3):"";
		$res['allmed']=(count($allmed)>0)?implode(",", $allmed):"";
		$res['allmed_arr']=(count($allmed)>0)?$allmed:[];
		return $res;
	}
	//Create Farmer
	public function createfarmer()
	{
		$data["page_title"] = "Create User";				
		$adminid = $this->session->userdata("adminid");
		//Brands
		$data["brands"]=$this->Users_model->getBrands();
		//Default Default Medicines
		$med_res=$this->getDefaultMedicineBrands();
		$data["med1"]=$med_res["med1"];
		$data["med2"]=$med_res["med2"];
		$data["med3"]=$med_res["med3"];
		$data["allmed"]=$med_res["allmed"];
		$data["allmed_arr"]=$med_res["allmed_arr"];
		$this->load->view('admin/user/farmer',$data);
	}

	//Create Dealer
	public function createdealer()
	{
		$data["page_title"] = "Create User";				
		$adminid = $this->session->userdata("adminid");
		//Brands
		$data["brands"]=$this->Users_model->getBrands();
		//Default Default Medicines
		$med_res=$this->getDefaultMedicineBrands();
		$data["med1"]=$med_res["med1"];
		$data["med2"]=$med_res["med2"];
		$data["med3"]=$med_res["med3"];
		$data["allmed"]=$med_res["allmed"];
		$data["allmed_arr"]=$med_res["allmed_arr"];
		$this->load->view('admin/user/dealer',$data);
	}

	//Create Non Farmer
	public function createnonfarmer()
	{
		$data["page_title"] = "Create User";				
		$adminid = $this->session->userdata("adminid");
		$this->load->view('admin/user/non-farmer',$data);
	}

	//Add User
	public function createUser(){
		$action=$_POST['action'];		
		//Users
		$user=[
				'firm_name'=>(!empty($_POST['firm_name']))?trim(ucwords($_POST['firm_name'])):"",
				'user_name'=>(!empty($_POST['user_name']))?trim(ucwords($_POST['user_name'])):"",
				'owner_name'=>(!empty($_POST['owner_name']))?trim(ucwords($_POST['owner_name'])):"",
				'mobile'=>(!empty($_POST['mobile']))?trim($_POST['mobile']):"",
				'email'=>(!empty($_POST['email']))?trim($_POST['email']):"",
				'user_type'=>strtoupper($action),
				'guarantor'=>(!empty($_POST['guarantor']))?trim(ucwords($_POST['guarantor'])):"",
				'doj'=>date('Y-m-d H:i:s')
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
		if($action=='farmer' || $action=='dealer'){
			$mindex=1;
			for($m=0;$m<count($_POST['medicines']);$m++){
				$add_info['medicines'.$mindex]=(!empty($_POST['medicines'][$m]))?trim($_POST['medicines'][$m]):0;
				$add_info['medicines'.$mindex.'_brands']=(!empty($_POST['hidm'.$mindex]))?trim($_POST['hidm'.$mindex]):0;
				$mindex++;
			}
		}
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
		if(count($_POST['fname'])>0 && empty($_POST['bank_skip'])){
			for($b=0;$b<count($_POST['fname']);$b++){
				$user_bank_accounts[]=['user_id'=>$user_id,
										'full_name'=>(!empty($_POST['fname'][$b]))?trim(ucwords($_POST['fname'][$b])):"",
									   'account_no'=>(!empty($_POST['ac_number'][$b]))?trim($_POST['ac_number'][$b]):"",
									   'bank_name'=>(!empty($_POST['bc_name'][$b]))?trim($_POST['bc_name'][$b]):"",
									   'ifsc'=>(!empty($_POST['ifsc'][$b]))?trim($_POST['ifsc'][$b]):"",
									   'branch_name'=>(!empty($_POST['branch_name'][$b]))?trim(ucwords($_POST['branch_name'][$b])):"",
									   'created_on'=>date('Y-m-d H:i:s')];
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
		$this->Users_model->updateUserCode($user_id,['user_code'=>$utype_code,'partnership'=>$partnership]);
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

	//Update User
	public function updateUser(){
		//print_r($_POST);
		$user_id=$_POST['user_id'];
		$action=$_POST['action'];

		//Users
		$user=[
				'firm_name'=>(!empty($_POST['firm_name']))?trim(ucwords($_POST['firm_name'])):"",
				'user_name'=>(!empty($_POST['user_name']))?trim(ucwords($_POST['user_name'])):"",
				'owner_name'=>(!empty($_POST['owner_name']))?trim(ucwords($_POST['owner_name'])):"",
				'mobile'=>(!empty($_POST['mobile']))?trim($_POST['mobile']):"",
				'email'=>(!empty($_POST['email']))?trim($_POST['email']):"",
				'guarantor'=>(!empty($_POST['guarantor']))?trim(ucwords($_POST['guarantor'])):""
			  ];
		$this->Users_model->updateUserDetails($user_id,$user);

		//User additional info
		$add_info=[
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
					'medicines1'=>(!empty($_POST['medicines'][0]))?trim($_POST['medicines'][0]):0,
					'medicines1_brands'=>(!empty($_POST['hidm1']))?trim($_POST['hidm1']):"",
					'medicines2'=>(!empty($_POST['medicines'][1]))?trim($_POST['medicines'][1]):0,
					'medicines2_brands'=>(!empty($_POST['hidm2']))?trim($_POST['hidm2']):"",
					'medicines3'=>(!empty($_POST['medicines'][2]))?trim($_POST['medicines'][2]):0,
					'medicines3_brands'=>(!empty($_POST['hidm3']))?trim($_POST['hidm3']):"",
					'medicines4'=>(!empty($_POST['medicines'][3]))?trim($_POST['medicines'][3]):0,
					'medicines4_brands'=>(!empty($_POST['hidm4']))?trim($_POST['hidm4']):"",
					'medicines5'=>(!empty($_POST['medicines'][4]))?trim($_POST['medicines'][4]):0,
					'medicines5_brands'=>(!empty($_POST['hidm5']))?trim($_POST['hidm5']):"",
					'medicines6'=>(!empty($_POST['medicines'][5]))?trim($_POST['medicines'][5]):0,
					'medicines6_brands'=>(!empty($_POST['hidm6']))?trim($_POST['hidm6']):"",
				  ];
		$this->Users_model->updateUserAdditionalInfo($user_id,$add_info);
		
		//Bank Acc
		if(count($_POST['fname'])>0 && empty($_POST['bank_skip'])){
			for($b=0;$b<count($_POST['fname']);$b++){
				//Existed
				if(!empty($_POST['bids'][$b])){
						$acc_id=trim($_POST['bids'][$b]);
						$update_account=['full_name'=>(!empty($_POST['fname'][$b]))?trim(ucwords($_POST['fname'][$b])):"",
									   'account_no'=>(!empty($_POST['ac_number'][$b]))?trim($_POST['ac_number'][$b]):"",
									   'bank_name'=>(!empty($_POST['bc_name'][$b]))?trim($_POST['bc_name'][$b]):"",
									   'ifsc'=>(!empty($_POST['ifsc'][$b]))?trim($_POST['ifsc'][$b]):"",
									   'branch_name'=>(!empty($_POST['branch_name'][$b]))?trim(ucwords($_POST['branch_name'][$b])):""];
						$this->Users_model->updateBankDetails($acc_id,$update_account);
				}else{
				 //New Accounts
				 $user_bank_accounts[]=['user_id'=>$user_id,
										'full_name'=>(!empty($_POST['fname'][$b]))?trim(ucwords($_POST['fname'][$b])):"",
									   'account_no'=>(!empty($_POST['ac_number'][$b]))?trim($_POST['ac_number'][$b]):"",
									   'bank_name'=>(!empty($_POST['bc_name'][$b]))?trim($_POST['bc_name'][$b]):"",
									   'ifsc'=>(!empty($_POST['ifsc'][$b]))?trim($_POST['ifsc'][$b]):"",
									   'branch_name'=>(!empty($_POST['branch_name'][$b]))?trim(ucwords($_POST['branch_name'][$b])):"",
									   'created_on'=>date('Y-m-d H:i:s')];	
				}
				
			}

			if(count($user_bank_accounts)>0){
				$this->Users_model->addBankDetails($user_bank_accounts);
			}
			
		}

		if($action=='farmer'){
			//user_crop_details
			if(count($_POST['crop_loc'])>0 && empty($_POST['crop_skip'])){
				for($c=0;$c<count($_POST['crop_loc']);$c++){
					if(!empty($_POST['cids'][$c])){
					//Existed
					$cd_id=trim($_POST['cids'][$c]);
					$update_crop_details=[
						'crop_location'			=>(!empty($_POST['crop_loc'][$c]))?trim($_POST['crop_loc'][$c]):"",
						'crop_type'				=>(!empty($_POST['crop_type'][$c]))?trim($_POST['crop_type'][$c]):"",
						'transaction_balance'	=>(!empty($_POST['transaction_balance'][$c]))?trim($_POST['transaction_balance'][$c]):"",
						'no_of_acres'			=>(!empty($_POST['acres'][$c]))?trim($_POST['acres'][$c]):""];
					$this->Users_model->updateCropDetails($cd_id,$update_crop_details);
					
					$data = array(
						"amount"		=>	(!empty($_POST['transaction_balance'][$c]))?trim($_POST['transaction_balance'][$c]):"0",
						"description"	=>	"open balance updated",
						"status"		=>	"0",
						"updated_by"	=>	$this->session->userdata('adminid'),
					);
					$this->Transaction_model->update($data,array('trans_type' => 'OPEN BALANCE', 'trans_id' => $cd_id));
					
					}else{
					 	//New Accounts
					 	$user_crop_details[]=['user_id'=>$user_id,
										   'crop_location'		=>(!empty($_POST['crop_loc'][$c]))?trim(ucwords($_POST['crop_loc'][$c])):"",
										   'crop_type'			=>(!empty($_POST['crop_type'][$c]))?trim(ucwords($_POST['crop_type'][$c])):"",
										   'no_of_acres'		=>(!empty($_POST['acres'][$c]))?trim($_POST['acres'][$c]):"",
										   'transaction_balance'=>(!empty($_POST['transaction_balance'][$c]))?trim($_POST['transaction_balance'][$c]):"",
										   'created_on'			=>date('Y-m-d H:i:s')];
					}
					
				}

				if(count($user_crop_details)>0){
					$this->Users_model->addCropDetails($user_crop_details);
				}
			}
		}
		if(($action=='non_farmer' || $action=='dealer') && !empty($_POST['open_balance'])){
			$data = array(
				"amount"		=>	(!empty($_POST['open_balance']))?trim($_POST['open_balance']):"0",
				"description"	=>	"open balance updated",
				"status"		=>	"0",
				"updated_by"	=>	$this->session->userdata('adminid'),
			);
			$this->Transaction_model->update($data,array('trans_type' => 'OPEN BALANCE', 'user_id' => $user_id, 'user_type' => $action));
			//echo $this->db->last_query(); exit;
		}

		//Parter Details
		if($_POST['partnership']==1){
			for($p=0;$p<count($_POST['pname']);$p++){

				if(!empty($_POST['pids'][$p])){
					//Existed
					$pid=trim($_POST['pids'][$p]);
					$partner_details=['partner_name'=>(!empty($_POST['pname'][$p]))?trim($_POST['pname'][$p]):"",
									   'aadhar_no'=>(!empty($_POST['paadhar'][$p]))?trim($_POST['paadhar'][$p]):"",
									   'mobile_no'=>(!empty($_POST['pmobile'][$p]))?trim($_POST['pmobile'][$p]):""];
					$this->Users_model->updatePartnerDetails($pid,$partner_details);
				}else{
					$user_parter_details[]=['user_id'=>$user_id,
									   'partner_name'=>(!empty($_POST['pname'][$p]))?trim(ucwords($_POST['pname'][$p])):"",
									   'aadhar_no'=>(!empty($_POST['paadhar'][$p]))?trim($_POST['paadhar'][$p]):"",
									   'mobile_no'=>(!empty($_POST['pmobile'][$p]))?trim($_POST['pmobile'][$p]):"",
									   'created_on'=>date('Y-m-d H:i:s')];
				}
				
			}

			if(count($user_parter_details)>0){
				$this->Users_model->addPartnerDetails($user_parter_details);
			}
		}

		//Alert
		if(!empty($_POST['notify_alert'])){
			//Mobiles
			for($m=0;$m<count($_POST['alert_mids']);$m++){
				if(empty($_POST['alert_mids'][$m])){
					$alert_me[]=['user_id'=>$user_id,'contact_type'=>'M','contact'=>trim($_POST['alert_m'][$m])];
				}
			}

			//Emails
			for($e=0;$e<count($_POST['alert_eids']);$e++){
				if(empty($_POST['alert_mids'][$e])){
					$alert_me[]=['user_id'=>$user_id,'contact_type'=>'E','contact'=>trim($_POST['alert_e'][$e])];
				}
			}

			if(count($alert_me)>0){
				$this->Users_model->addAlerts($alert_me);
			}
		}

		$user=$this->Users_model->getUser($user_id);
		$utype_code=$user['user_code'];
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

	//Delete Element
	public function delelement(){
		if($_POST['action']=='bank'){
			$res=$this->Users_model->delBankAcc($_POST['ele_id']);
		}else if($_POST['action']=='crop'){
			$res=$this->Users_model->delCrop($_POST['ele_id']);
		}else if($_POST['action']=='partner'){
			$res=$this->Users_model->delPartner($_POST['ele_id']);
		}else if($_POST['action']=='alerts'){
			$res=$this->Users_model->delAlert($_POST['ele_id']);
		}else if($_POST['action']=='user'){
			$res=$this->Users_model->updateUserDetails($_POST['ele_id'],['status'=>0]);
		}else if($_POST['action']=='deldoc'){
			$res=$this->Users_model->delDocument($_POST['ele_id']);
			$path_to_file = '/assets/upload_docs/'.$_POST['user_code'].'/'.$_POST['doc_file'];
			if($res){
				@unlink($path_to_file);
			}
		}

		if($res){
			$response['result']=true;
		}else{
			$response['result']=false;
		}
		echo json_encode($response);
	}
	//Get Users
	public function getusers(){
		$draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$limit = intval($this->input->post("length"));

		$params['order']=$_POST['order'][0]['column']; // Column index
		$params['columnName']=$_POST['columns'][$order]['data']; // Column name
		$params['dir']=$_POST['order'][0]['dir']; // asc or desc
		$params['searchValue']=$_POST['search']['value']; // Search value

		//Custom Field value
		/* $_POST['partnership']=0;
		if($_POST['type_opt']=='PARTNER'){
		  $_POST['type_opt']='FARMER';
		  $_POST['partnership']=1;
		} */

		//$params['searchByUtype']=$_POST['type_opt'];
		//$params['partnership']=$_POST['partnership'];
		$params['searchByUtype'] = $_POST['utype_opt'];

		$total=$this->Users_model->getUserCount($params);
		$users=$this->Users_model->getUsers($limit,$start,$params);
		$user_list=[];
		foreach($users as $key=>$value){
			if($value['user_type']=='DEALER' || $value['partnership']==1){
			  $user_name=$value['owner_name'];
			}else{
			  $user_name=$value['user_name'];
			}
			$user_type = ($value['typeofuser']) ? "GUEST" : $value['user_type'];
			$user_list[]=[
							$value['user_code'],
							'<a href="'.base_url().'admin/users/details/'.$value['user_id'].'" title="">'.$user_name.'</a>',
							$value['mobile'],
							$user_type,
							'<i class="fa fa-ellipsis-v act_icns" id="'.$value['user_id'].'" data-toggle="popover" data-placement="left" tabindex="0" data-trigger="focus" aria-hidden="true" style="width:30px;" data-content=""></i>'
						 ];
		}

		$response=[];
		$response["draw"]=$draw;
		$response["start"]=$start;
		$response["length"]=$limit;
		$response["recordsTotal"]=$total;
		$response["recordsFiltered"]=$total;
		$response["data"]=$user_list;
		echo json_encode($response);
	}

	public function uploadImage($imgfile,$usercode,$user_id,$doc_type)
	{
		$files_count =count($imgfile["name"]);
		$res_files = [];
		for($i=0; $i< $files_count; $i++){
			
			$upload_dir = FCPATH.'assets'. DIRECTORY_SEPARATOR . 'upload_docs'. DIRECTORY_SEPARATOR . $usercode;
			$imgname = explode('.',$imgfile['name'][$i]);			
			$ext = $imgname[count($imgname) - 1];
			$time =microtime(true);
			$micro_time=sprintf("%06d",($time - floor($time)) * 1000000);
			$date=new DateTime( date('Y-m-d H:i:s.'.$micro_time,$time) );

			$doc_title=$date->format("YmdHisu");
			$newname = $doc_title.'.'.$ext;
			$path = $newname;			
			$tempPath = $imgfile['tmp_name'][$i];
			$uploadPath = $upload_dir . DIRECTORY_SEPARATOR . $newname;

			if(move_uploaded_file($tempPath, $uploadPath )){
				$res_files[$i]=['user_id'=>$user_id,'doc_type'=>$doc_type,'doc_title'=>$doc_title,'doc_file_type'=>$ext,'doc_file'=>$newname];
			}
		}
		return $res_files;
	}
}
?>