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
}
?>