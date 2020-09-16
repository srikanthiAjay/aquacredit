<?php defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(E_ALL | E_STRICT);
//include($_SERVER['DOCUMENT_ROOT'].'/aquadeals/application/third_party/ImageTool.php');
class Purchases extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->library('session');
		$this->load->model('api/Admin_model');
		$this->load->model('api/Users_model');
		$this->load->model('api/Purchases_model');
		$this->load->helper('form');
		$this->load->helper('captcha');
		$this->load->helper('url');
		$this->load->library('upload');
		setlocale(LC_MONETARY, 'en_IN');
		header('Access-Control-Allow-Origin: *');

	}

	//Index function
	public function index()
	{
		//print_r($_POST);
		$brand_id=$_POST['brand_id'];
		$topproducts=$this->Purchases_model->getTopProducst($brand_id);
		if(count($topproducts)>0){
			$response['topproducts']=$topproducts;
			$response['error']=false;
			$response['message']="Success";
		}else{
			$response['topproducts']=[];
			$response['error']=true;
			$response['message']="Fail";
		}

		echo json_encode($response);
	}

	//Search Product
	public function searchproduct(){
		//print_r($_POST);
		$keyword=trim($_POST['keyword']);
		$pids=$_POST['userselectedpdis'];
		$brand_id=$_POST['brand_id'];
		$products=$this->Purchases_model->searchProduct($keyword,$brand_id,$pids);
		$sproducts=[];
		foreach($products as $key=>$value) {
			$pvalue=$value;
			$pvalue['qty']=1;
			$pvalue['price']=$value['pmrp'];
			$sproducts[]=[
							'id'=>$value['pid'],
							'label'=>$value['pname'],
							'value'=>$value['pname'],
							'pinfo'=>$pvalue
						 ];
		}

		if(count($sproducts)>0){
			$response['products']=$sproducts;
			$response['error']=false;
			$response['message']="Success";
		}else{
			$response['products']=[];
			$response['error']=true;
			$response['message']="Fail";
		}

		echo json_encode($response);
	}

	//Branch Purchase list
	public function branchplist(){
		$branch_id=$this->session->userdata('branch_id');
		$adminid=$this->session->userdata('adminid');
		$hid_tabval=intval($this->input->post("hid_tabval"));

		if($hid_tabval==0){
		 $params['status']=["P","C","PM","BC"];
		}else{
		 $params['status']=["CE"];
		}

		$params['branch_id']=$branch_id;
		$params['adminid']=$adminid;

		$draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$limit = intval($this->input->post("length"));

		$params['order']=$_POST['order'][0]['column']; // Column index
		$params['columnName']=$_POST['columns'][$order]['data']; // Column name
		$params['dir']=$_POST['order'][0]['dir']; // asc or desc
		$params['searchValue']=$_POST['search']['value']; // Search value

		//print_r($_POST);
		$total=$this->Purchases_model->getPurchaseCount($params);
		//bp_id,uid,branch_id,company_id,total_price,created_on,unloading_charges,transport_charges,upload_invoice
		$purchases=$this->Purchases_model->getPurchase($limit,$start,$params);
		//print_r($purchases);
		$purchase_list=[];
		foreach($purchases as $key=>$value){
			if($value['status']=='P'){
				$status='Pending';
			}else if($value['status']=='C'){
				$status='Approved';
			}else if($value['status']=='PM'){
				$status='Payment';
			}else if($value['status']=='CE'){
				$status='Completed';
			}

			$purchase_list[]=[
				$value['id'],
				date('d-M-Y',strtotime($value['created_on'])),
				$value['brand_name'],
				"₹ ".$this->IND_money_format($value['total_price']),
				$status,
				'<i class="fa fa-ellipsis-v act_icns" data-toggle="popover" data-placement="left" tabindex="0" data-trigger="focus" data-toggle="popover" aria-hidden="true" onclick="Purchase.purchaseact('.$value['id'].','.$value['company_id'].');"></i>'
			];
		}
		$response=[];
		$response["draw"]=$draw;
		$response["start"]=$start;
		$response["length"]=$limit;
		$response["recordsTotal"]=$total;
		$response["recordsFiltered"]=$total;
		$response["data"]=$purchase_list;
		echo json_encode($response);
	}

	//Save Branch Request
	public function saverequest(){
		$branch_id=$this->session->userdata('branch_id');
		$adminid=$this->session->userdata('adminid');
		$brand_id=trim($_POST['brand_id']);
		$response=[];
		$params=[];
		//print_r($_POST);
		//Check with brand
		//Case 2
		$brand=$this->Purchases_model->checkBrand($brand_id);
		if(!empty($brand['ap_id'])){

		   //Case 3
		   //Update
		   if(!empty($_POST['bp_id'])){
			   $ap_id=trim($_POST['ap_id']);
			   $bp_id=trim($_POST['bp_id']);
			   $params['branch_id']=$branch_id;
			   $params['ap_id']=$ap_id;
			   $params['bp_id']=$bp_id;

			   //Branch Details Update
			   $overall_tot_price=0;
			   $update_pids=$new_pids=[];
			   for($i=0;$i<count($_POST['userproducts']);$i++){
			   		 //print_r($_POST['userproducts'][$i]);
				   	 if(!empty($_POST['userproducts'][$i]['bpd_id'])){
				   	 	 $total_price=($_POST['userproducts'][$i]['qty']*$_POST['userproducts'][$i]['price']);
				   	 	 $bpd_id=$_POST['userproducts'][$i]['bpd_id'];
				   		 $purchase_details=[
				   	 						'quantity'=>$_POST['userproducts'][$i]['qty'],
				   	 						'price'=>$_POST['userproducts'][$i]['price'],
				   	 						'total_price'=>$total_price
				   	 					   ];
				   	 	 $this->Purchases_model->updateBPDeatils($bpd_id,$purchase_details);
				   	 	 $update_pids[]=$_POST['userproducts'][$i]['pid'];
				   	 }else{
				   	 	$total_price=($_POST['userproducts'][$i]['qty']*$_POST['userproducts'][$i]['price']);
				   	 	//Add New Product
			   			$purchase_details=[
			   	 						'bp_id'=>$bp_id,
			   	 						'branch_id'=>$params['branch_id'],
			   	 						'ap_id'=>$params['ap_id'],
			   	 						'product_id'=>$_POST['userproducts'][$i]['pid'],
			   	 						'quantity'=>$_POST['userproducts'][$i]['qty'],
			   	 						'price'=>$_POST['userproducts'][$i]['price'],
			   	 						'total_price'=>$total_price,
			   	 						'discount'=>0
			   	 					   ];
			   	 		$this->Purchases_model->addBranchPD($purchase_details);
			   	 		$new_pids[]=$purchase_details;
				   	 }

				   	 $overall_tot_price=$overall_tot_price+$total_price;

				}

		   	 	//Overall Branch Update
				$branch_purchase=[
		   						  'total_price'=>$overall_tot_price
		   						 ];
		   		$this->Purchases_model->updateBP($bp_id,$branch_purchase);

			 	//Add New Products in Admin Purchase Details
		   		if(count($new_pids)>0){
		   			$adp_details=[];
		   			foreach($new_pids as $key=>$value){
		   				$total_price=($value['quantity']*$value['price']);
		   				//Check Product Id Exist In Admin Purchase Details
		   				$check=['ap_id'=>$ap_id,'product_id'=>$value['product_id']];
		   				$check_r=$this->Purchases_model->checkProductInAPD($check);
		   				if(empty($check_r['product_id'])){
		   					//Insert
			   	 			$adp_details[]=[
			   	 						'ap_id'=>$ap_id,
			   	 						'product_id'=>$value['product_id'],
			   	 						'quantity'=>$value['quantity'],
			   	 						'price'=>$value['price'],
			   	 						'total_price'=>$total_price,
			   	 						'discount'=>0,
			   	 						'branch_ids'=>$branch_id
			   	 					   ];
		   				}

		   				$update_pids[]=$value['product_id'];
		   			}

	   				if(count($adp_details)>0){
	   					$this->Purchases_model->addAdminPurchaseDetails($adp_details);
	   				}
		   		}

		   		//Update Admin Purchase Details
		   		$params['update_pids']=$update_pids;
		   		$upd_cnt=$this->updateAdminPD($params);

		   		//Update Admin Purchase
		   		$admin_upd_status=$this->updateAdminP($params);;
		   		if($admin_upd_status){
			   	   $response['ap_id']=$ap_id;
			   	   $response['update_staus']=true;
				   $response['error']=false;
				   $response['message']='Success';
		   		}else{
		   		   $response['ap_id']=$ap_id;
			   	   $response['update_staus']=false;
				   $response['error']=true;
				   $response['message']='Fail';
		   		}
		   }else{
		   	   //Case 4
		   	   //Insert New Products
		   	   $ap_id=$brand['ap_id'];
			   $params['branch_id']=$branch_id;
			   $params['ap_id']=$ap_id;

		   		$branch_purchase=[
		   						  'uid'=>$adminid,
		   						  'branch_id'=>$branch_id,
		   						  'company_id'=>$brand_id,
		   						  'total_price'=>0,
		   						  'total_discount'=>0,
		   						  'status'=>'P',
		   						  'ap_id'=>$ap_id
		   						 ];
		   		$bp_id=$this->Purchases_model->addBranchPurchase($branch_purchase);
		   		$params['bp_id']=$bp_id;

		   		$overall_tot_price=0;
		   		$update_pids=[];
		   		for($i=0;$i<count($_POST['userproducts']);$i++){
		   			$total_price=($_POST['userproducts'][$i]['qty']*$_POST['userproducts'][$i]['pmrp']);
		   			$overall_tot_price=$overall_tot_price+$total_price;

		   			$purchase_details[]=[
		   	 						'bp_id'=>$bp_id,
		   	 						'branch_id'=>$branch_id,
		   	 						'ap_id'=>$ap_id,
		   	 						'product_id'=>$_POST['userproducts'][$i]['pid'],
		   	 						'quantity'=>$_POST['userproducts'][$i]['qty'],
		   	 						'price'=>$_POST['userproducts'][$i]['pmrp'],
		   	 						'total_price'=>$total_price,
		   	 						'discount'=>0
		   	 					   ];

		   	 		//Add In Admin Purchase Details
	   	 			//Check Product Id Exist In Admin Purchase Details
	   				$check=['ap_id'=>$ap_id,'product_id'=>$_POST['userproducts'][$i]['pid']];
	   				$check_r=$this->Purchases_model->checkProductInAPD($check);
	   				if(empty($check_r['product_id'])){
	   					//Insert
		   	 			$adp_details[]=[
		   	 						'ap_id'=>$ap_id,
		   	 						'product_id'=>$_POST['userproducts'][$i]['pid'],
		   	 						'quantity'=>$_POST['userproducts'][$i]['qty'],
		   	 						'price'=>$_POST['userproducts'][$i]['pmrp'],
		   	 						'total_price'=>$total_price,
		   	 						'discount'=>0,
		   	 						'branch_ids'=>$branch_id
		   	 					   ];
	   				}

		   	 		$update_pids[]=$_POST['userproducts'][$i]['pid'];
		   		}

		   		//Add Branch Purchase Details
		   		$this->Purchases_model->addBranchPurchaseDetails($purchase_details);

		   		//Update Branch Purchase
		   		$branch_purchase=[
		   						  'total_price'=>$overall_tot_price
		   						 ];
		   		$upd_status=$this->Purchases_model->updateBP($bp_id,$branch_purchase);

		   		//Add Admin Purchase Details
	   			if(count($adp_details)>0){
   					$this->Purchases_model->addAdminPurchaseDetails($adp_details);
   				}

		   		//Update Admin Purchase Details
		   		$params['update_pids']=$update_pids;
		   		$upd_cnt=$this->updateAdminPD($params);

		   		//Update Admin Purchase
		   		$admin_upd_status=$this->updateAdminP($params);;
		   		if($admin_upd_status){
			   	   $response['ap_id']=$ap_id;
			   	   $response['update_staus']=true;
				   $response['error']=false;
				   $response['message']='Success';
		   		}else{
		   		   $response['ap_id']=$ap_id;
			   	   $response['update_staus']=false;
				   $response['error']=true;
				   $response['message']='Fail';
		   		}
		   }

		}else{
		   //Case 1

		   //Insert
			//df_admin_purchase
		   //orderid,company_id,total_price,total_discount,branch_ids,bp_ids,status,created_on,modified_on
		   $purchase=[
		   				 'orderid'=>"ORD".strtotime("now"),
		   				 'company_id'=>$brand_id,
		   				 'total_price'=>0,
		   				 'total_discount'=>0,
		   				 'branch_ids'=>$branch_id,
		   				 'bp_ids'=>'',
		   				 'status'=>'P'
						 ];
		   $ap_id=$this->Purchases_model->addAdminPurchase($purchase);
		   //df_admin_purchase_details
		   //ap_id,product_id,quantity,price,total_price,discount,branch_ids
		   $overall_tot_price=0;
		   $bp_ids=[];
		   for($i=0;$i<count($_POST['userproducts']);$i++){
		   	 $bp_ids[]=$_POST['userproducts'][$i]['pid'];
		   	 $total_price=($_POST['userproducts'][$i]['qty']*$_POST['userproducts'][$i]['pmrp']);
		   	 $overall_tot_price=$overall_tot_price+$total_price;
		   	 $ad_purchase_details[]=[
		   	 						'ap_id'=>$ap_id,
		   	 						'product_id'=>$_POST['userproducts'][$i]['pid'],
		   	 						'quantity'=>$_POST['userproducts'][$i]['qty'],
		   	 						'price'=>$_POST['userproducts'][$i]['pmrp'],
		   	 						'total_price'=>$total_price,
		   	 						'discount'=>0,
		   	 						'branch_ids'=>$branch_id
		   	 					   ];
		   }

		   $this->Purchases_model->addAdminPurchaseDetails($ad_purchase_details);

		   //Update overall price,product ids
		   $update_params=[
		   					'total_price'=>$overall_tot_price,
		   					'bp_ids'=>implode(",",$bp_ids)
		   				  ];
		   $this->Purchases_model->updateAdminPurchase($ap_id,$update_params);

		   if($ap_id>0){
		   	   //df_branch_purchase
		   	   //uid,branch_id,company_id,total_price,total_discount,status,ap_id
		   		$branch_purchase=[
		   						  'uid'=>$adminid,
		   						  'branch_id'=>$branch_id,
		   						  'company_id'=>$brand_id,
		   						  'total_price'=>$overall_tot_price,
		   						  'total_discount'=>0,
		   						  'status'=>'P',
		   						  'ap_id'=>$ap_id
		   						 ];
		   		$bp_id=$this->Purchases_model->addBranchPurchase($branch_purchase);
		   		//df_branch_purchase_details
		   	   //bp_id,product_id,quantity,price,total_price
		   		for($i=0;$i<count($_POST['userproducts']);$i++){
		   			$total_price=($_POST['userproducts'][$i]['qty']*$_POST['userproducts'][$i]['pmrp']);
		   			$purchase_details[]=[
		   	 						'bp_id'=>$bp_id,
		   	 						'branch_id'=>$branch_id,
		   	 						'ap_id'=>$ap_id,
		   	 						'product_id'=>$_POST['userproducts'][$i]['pid'],
		   	 						'quantity'=>$_POST['userproducts'][$i]['qty'],
		   	 						'price'=>$_POST['userproducts'][$i]['pmrp'],
		   	 						'total_price'=>$total_price,
		   	 						'discount'=>0
		   	 					   ];
		   		}

		   	    $this->Purchases_model->addBranchPurchaseDetails($purchase_details);
			   $response['ap_id']=$ap_id;
			   $response['error']=false;
			   $response['message']='Success';
		   }else{
			   $response['ap_id']='';
			   $response['error']=true;
			   $response['message']='Fail';
		   }

		}

		echo json_encode($response);
	}

	//Update Admin Purchase
	public function updateAdminP($params){
		$apd_result=$this->Purchases_model->getAdminPD($params['ap_id']);
		$overall_tot_price=0;
		//product_id,quantity,total_price,branch_ids
		//branch_ids,bp_ids
		$bp_ids=[];
		$branch_ids="";
		foreach($apd_result as $key=>$value){
			$bp_ids[]=$value['product_id'];
			$branch_ids.=",".$value['branch_ids'];
			$overall_tot_price=($overall_tot_price+$value['total_price']);
		}

		$branch_ids_arr=array_unique(explode(",",trim($branch_ids,",")));
		$apd_update=['bp_ids'=>implode(",",$bp_ids),'branch_ids'=>implode(",",$branch_ids_arr),'total_price'=>$overall_tot_price];
		$apd_update_status=$this->Purchases_model->updateAP($params['ap_id'],$apd_update);
		return $apd_update_status;
	}

	//Update Admin Purchase Details
	public function updateAdminPD($params){
		$branch_id=$params['branch_id'];
		$ap_id=$params['ap_id'];
		//Check Branch ID Exist with product
		$upd_status_cnt=0;
		foreach($params['update_pids'] as $pid){
			$chek_branch_r=$this->Purchases_model->checkBranch($pid,$branch_id);
			if(empty($chek_branch_r['apd_id'])){
				$apd_product=$this->Purchases_model->getAPDProduct($pid,$ap_id);
				$branch_ids_str=$apd_product['branch_ids'];
				$branch_ids_str.=",".$branch_id;

				//Update APD Details
				$adp_details=['branch_ids'=>trim($branch_ids_str,",")];
   				$status=$this->Purchases_model->updateAPDeatils($apd_product['apd_id'],$adp_details);
			}
			$upd_status_cnt++;
		}


		if($upd_status_cnt>0){
			$admin_pd=$this->Purchases_model->getAdminPurchaseDetails($params['ap_id'],$params['update_pids']);
			$updcnt=0;
	   		foreach($admin_pd as $key=>$value) {
	   			$pid=$value['product_id'];
	   			$apd_id=$value['apd_id'];
	   			$branch_ids=explode(",",$value['branch_ids']);

	   			$tot_qty=0;
	   			$total_pri=0;
	   			foreach($branch_ids as $key=>$value) {
	   				$bp_params=['branch_id'=>$value,'ap_id'=>$params['ap_id'],'product_id'=>$pid];
	   				$bp_info=$this->Purchases_model->getBPDetails($bp_params);
	   				//print_r($bp_info);
	   				$tot_qty=$tot_qty+$bp_info['quantity'];
	   				$total_pri=$total_pri+$bp_info['total_price'];

	   				$apd_params=['quantity'=>$tot_qty,'total_price'=>$total_pri];
	   				$status=$this->Purchases_model->updateAPDeatils($apd_id,$apd_params);
	   				if($status){
	   					$updcnt++;
	   				}
	   			}
	   		}

	   		return $updcnt;
		}
	}

	//Update request
	public function updaterequest(){
		print_r($_POST);

	}

	//Get request products
	public function getreq_products(){
		$branch_id=$this->session->userdata('branch_id');
		$adminid=$this->session->userdata('adminid');
		$params['brand_id']=$_POST['brand_id'];
		$params['bp_id']=$_POST['bp_id'];

		$branch_info=$this->Purchases_model->getBranchDetails($branch_id);
		$wallet_amt=$branch_info['amount'];
		$bpurchase_info=$this->Purchases_model->getBranchPurchaseInfo($params);
		$bpurchase_details=$this->Purchases_model->getBranchPurchaseDetails($params);
		$is_disabled=false;
		$upd_invoice_chrg=false;
		/*if(in_array($bpurchase_info['status'],['C','PM','BC','CE'])){
			$is_disabled=true;
			$upd_invoice_chrg=true;
		}*/

		if($bpurchase_info['status']=='C'){
			$is_disabled=true;
			$upd_invoice_chrg=false;
		}else if($bpurchase_info['status']=='PM'){
			$is_disabled=false;
			$upd_invoice_chrg=true;
		}else if($bpurchase_info['status']=='BC' || $bpurchase_info['status']=='CE'){
			$is_disabled=false;
			$upd_invoice_chrg=false;
		}

		$response=[];
		if(count($bpurchase_details)>0){
			$response['wallet_amt']=$wallet_amt;
			$response['is_disabled']=$is_disabled;
			$response['upd_invoice_chrg']=$upd_invoice_chrg;
			$response['bpurchase_info']=$bpurchase_info;
			$response['bpurchase_details']=$bpurchase_details;
			$response['error']=false;
			$response['message']='Success';
		}else{
			$response['error']=true;
			$response['message']='Fail';
		}

		echo json_encode($response);
	}

	//Branch Purchase Summary
	public function bpSummary(){
		$params['branch_id']=$this->session->userdata('branch_id');
		$params['adminid']=$this->session->userdata('adminid');
		$bpsummary=$this->Purchases_model->bpSummary($params);
		if(count($bpsummary)>0){
			$response['summary']=$bpsummary;
			$response['error']=false;
			$response['message']='Success';
		}else{
			$response['summary']=[
								  'pending'=>0,
								  'approved'=>0,
								  'paid'=>0,
								  'branch_confirm'=>0,
								  'completed'=>0,
								  'total_purchase'=>0
								 ];
			$response['error']=true;
			$response['message']='Fail';
		}

		echo json_encode($response);
	}

	//Admin Summary
	public function apSummary(){
		$params['branch_id']=$this->session->userdata('branch_id');
		$params['adminid']=$this->session->userdata('adminid');
		$apsummary=$this->Purchases_model->apSummary($params);
		if(count($apsummary)>0){
			$response['summary']=$apsummary;
			$response['error']=false;
			$response['message']='Success';
		}else{
			$response['summary']=[
								  'pending'=>0,
								  'approved'=>0,
								  'paid'=>0,
								  'admin_confirm'=>0,
								  'completed'=>0,
								  'total_purchase'=>0
								 ];
			$response['error']=true;
			$response['message']='Fail';
		}

		echo json_encode($response);
	}

	//Branch Confirm
	public function confirmbranch(){
		$branch_id=$this->session->userdata('branch_id');
		$adminid=$this->session->userdata('adminid');
		$params['branch_id']=$branch_id;
    	$params['unloading_charges']=$_POST['unloading_charges'];
    	$params['transport_charges']=$_POST['transport_charges'];
    	$params['ap_id']=$_POST['ap_id'];
    	$params['bp_id']=$_POST['bpid'];
    	$params['brand_id']=$_POST['brand_id'];

    	//Invoice
    	$upload_dir = FCPATH.'assets'. DIRECTORY_SEPARATOR . 'invoices'. DIRECTORY_SEPARATOR;
    	$file_name=$_FILES["invoice_file"]['name'];
    	$tempPath = $_FILES["invoice_file"]['tmp_name'];
    	$time=date('d_m_Y_h_m_i');
    	$ext=pathinfo($file_name,PATHINFO_EXTENSION);
    	$invoice_file="invoice_".$params['bp_id']."_".$time.".".$ext;
    	$uploadPath = $upload_dir . $invoice_file;

    	$bpurchase_info=$this->Purchases_model->getBranchPurchaseInfo($params);
		$bpurchase_details=$this->Purchases_model->getBranchPurchaseDetails($params);
		$branch_info=$this->Purchases_model->getBranchDetails($params['branch_id']);

		//print_r($bpurchase_details);
    	$response=[];
    	$cnt=0;

    	//Tables - branch_inventory,transactions,wallets,branch,branch_purchase

		if(move_uploaded_file($tempPath,$uploadPath)){
    		  //Branch Inventory
			  for($i=0;$i<count($bpurchase_details);$i++){
			  	//print_r($bpurchase_details[$i]);
			  	$pid=$bpurchase_details[$i]['pid'];

			  	//Check Branch Product
			  	$check_product=$this->Purchases_model->checkBranchProduct($pid,$branch_id);
			  	$qty=0;
			  	if(!empty($check_product['bin_id'])){
			  		//Update Product
			  		$qty=($check_product['qty']+$bpurchase_details[$i]['quantity']);
			  		$upd_prod=['pmrp'=>$bpurchase_details[$i]['price'],'purchase_amt'=>$bpurchase_details[$i]['purchase_amt'],'qty'=>$qty,'percentage'=>$bpurchase_details[$i]['percentage']];
			  		$where_cond=["pid"=>$pid,"branch_id"=>$branch_id];
			  		$upd_result=$this->Purchases_model->updateProductInInventory($upd_prod,$where_cond);
			  		if($upd_result){
			  			$cnt++;
			  		}
			  	}else{
			  		//Add Product
			  		$add_prod=['branch_id'=>$branch_id,'pid'=>$pid,'pmrp'=>$bpurchase_details[$i]['price'],'purchase_amt'=>$bpurchase_details[$i]['purchase_amt'],'qty'=>$bpurchase_details[$i]['quantity'],'percentage'=>$bpurchase_details[$i]['percentage']];
			  		$add_result=$this->Purchases_model->addProductInInventory($add_prod);
			  		if($add_result>0){
			  			$cnt++;
			  		}
			  	}

			  }	
		}


		if($cnt>0){
			//Wallets
			//unloading charges
			$bwallet_amt=$branch_info['amount'];
			$rem_bwallet_amt=($bwallet_amt-$params['unloading_charges']);

			//Update Transaction (unloading charges)
			$utrans=[
				'user_id'=>$adminid,
				'user_type'=>'U',
				'trans_type'=>'OTHER',
				'trans'=>'UNLOADING',
				'trans_id'=>$params['ap_id'],
				'trans_code'=>'TR'.$params['ap_id'],
				'amount_type'=>'OUT',
				'amount'=>$params['unloading_charges'],
				'total_amount'=>$params['unloading_charges'],
				'due'=>0,
				'extra_amt'=>0,
				'description'=>'Unloading charges paid by '.$branch_info['branch_name']
			 ];

			$unloading_tid=$this->Purchases_model->doPurchaseTransaction($utrans);

			//Add in wallet
			$uwallet=[
					  'tr_id'=>$unloading_tid,
					  'trtype'=>'OTH',
					  'uid'=>$adminid,
					  'utype'=>'U',
					  'amount'=>$params['unloading_charges'],
					  'payment_type'=>'CH',
					  'entry_status'=>'OUT'
					];
			$this->Purchases_model->addInWallet($uwallet);

			//transport charges
			$rem_bwallet_amt=($rem_bwallet_amt-$params['transport_charges']);

			//Update Transaction (transport charges)
			$ttrans=[
				'user_id'=>$adminid,
				'user_type'=>'U',
				'trans_type'=>'OTHER',
				'trans'=>'TRANSPORT',
				'trans_id'=>$params['ap_id'],
				'trans_code'=>'TR'.$params['ap_id'],
				'amount_type'=>'OUT',
				'amount'=>$params['unloading_charges'],
				'total_amount'=>$params['transport_charges'],
				'due'=>0,
				'extra_amt'=>0,
				'description'=>'Transport charges paid by '.$branch_info['branch_name']
			 ];

			$transport_tid=$this->Purchases_model->doPurchaseTransaction($ttrans);

			//Add in wallet
			$twallet=[
					  'tr_id'=>$transport_tid,
					  'trtype'=>'OTH',
					  'uid'=>$adminid,
					  'utype'=>'U',
					  'amount'=>$params['transport_charges'],
					  'payment_type'=>'CH',
					  'entry_status'=>'OUT'
					];
			$this->Purchases_model->addInWallet($twallet);

			//Update Branch Amount
			$branch_amt=['amount'=>$rem_bwallet_amt];
			$this->Purchases_model->updateBranchAmount($branch_id,$branch_amt);

			//Confirm Branch
			$cnf=['status'=>'CE','unloading_charges'=>$params['unloading_charges'],'transport_charges'=>$params['transport_charges'],'upload_invoice'=>$invoice_file,'tr_charges_paidby'=>'A'];
			$confirm_status=$this->Purchases_model->updateBPConfirm($params['ap_id'],$branch_id,$cnf);

			$response['confirm_status']=$confirm_status;
			if($confirm_status){
				//Admin Purchase
				$admin_purchase=$this->Purchases_model->purchaseInfo($params['ap_id']);
				$branch_ids=explode(",", $admin_purchase['branch_ids']);
				$check_all_bcnf=$this->Purchases_model->checkAllBConfirmation($params['ap_id'],$branch_ids);
				if(count($check_all_bcnf)>0){
					$upd_purchase=['status'=>'CE'];
		 			$upd_status=$this->Purchases_model->updateAP($params['ap_id'],$upd_purchase);
				}
			}

		}else{
			$response['confirm_status']=false;
		}

		echo json_encode($response);
	}
	
	//Admin Start
	public function purchaselist(){
		$branch_id=$this->session->userdata('branch_id');
		$adminid=$this->session->userdata('adminid');
		$hid_tabval=intval($this->input->post("hid_tabval"));

		if($hid_tabval==0){
		 $params['status']=["P","C","PM","BC"];
		}else{
		 $params['status']=["CE"];
		}

		$params['branch_id']=$branch_id;
		$params['adminid']=$adminid;

		$draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$limit = intval($this->input->post("length"));

		$params['order']=$_POST['order'][0]['column']; // Column index
		$params['columnName']=$_POST['columns'][$order]['data']; // Column name
		$params['dir']=$_POST['order'][0]['dir']; // asc or desc
		$params['searchValue']=$_POST['search']['value']; // Search value

		//print_r($_POST);
		$total=$this->Purchases_model->getAdminPurchaseCount($params);
		//bp_id,uid,branch_id,company_id,total_price,created_on,unloading_charges,transport_charges,upload_invoice
		$purchases=$this->Purchases_model->getAdminPurchase($limit,$start,$params);
		//print_r($purchases);
		$purchase_list=[];
		foreach($purchases as $key=>$value){
			if($value['status']=='P'){
				$status='Pending';
			}else if($value['status']=='C'){
				$status='Approved';
			}else if($value['status']=='PE'){
				$status='Payment';
			}else{
				$status='Completed';
			}

			$purchase_list[]=[
				$value['id'],
				date('d-M-Y',strtotime($value['created_on'])),
				$value['brand_name'],
				"₹ ".$this->IND_money_format($value['total_price']),
				$status,
				'<i class="fa fa-ellipsis-v act_icns" data-toggle="popover" data-placement="left" tabindex="0" data-trigger="focus" data-toggle="popover" aria-hidden="true" onclick="Purchase.purchaseact('.$value['id'].','.$value['company_id'].');"></i>'
			];
		}
		$response=[];
		$response["draw"]=$draw;
		$response["start"]=$start;
		$response["length"]=$limit;
		$response["recordsTotal"]=$total;
		$response["recordsFiltered"]=$total;
		$response["data"]=$purchase_list;
		echo json_encode($response);
	}

	//Edit Request
	public function editrequest(){
		$branch_id=$this->session->userdata('branch_id');
		$adminid=$this->session->userdata('adminid');
		$params['brand_id']=intval($this->input->post("brand_id"));
		$params['ap_id']=intval($this->input->post("ap_id"));
		$response=[];

		//Brand Info
		$brand_info=$this->Purchases_model->brandInfo($params);
		$response['brand_info']=$brand_info;

		//Brand Products
		$purchase_info=$this->Purchases_model->purchaseInfo($params);
		$response['purchase_info']=$purchase_info;

		$products=$this->Purchases_model->getAdminPDList($params['ap_id']);
		$response['products']=$products;

		//Branch Products
		$branch_ids=explode(",", $purchase_info['branch_ids']);
		$bp_ids=explode(",", $purchase_info['bp_ids']);
		$branches=[];
		for($i=0;$i<count($branch_ids);$i++){
			$bparams=[];
			$bparams['branch_id']=$branch_ids[$i];
			$bparams['ap_id']=$params['ap_id'];
			$branch=$this->Purchases_model->getBranchDetails($branch_ids[$i]);
			$bpurchase_info=$this->Purchases_model->branchPurchaseInfo($bparams);
			$branch['purchase_info']=$bpurchase_info;
			$bproducts=$this->Purchases_model->getBranchProducts($bparams);
			$bpids=[];
			for($b=0;$b<count($bproducts);$b++){
				$bproducts[$b]['is_checked']=true;
				//echo $bproducts[$b]['product_id'];
				$bpids[]=$bproducts[$b]['pid'];
			}
			$branch['products']=$bproducts;

			//Remaing Products
			$extra_products=$this->Purchases_model->getProducts($params['brand_id'],$bpids);
			for($e=0;$e<count($extra_products);$e++){
				$extra_products[$e]['is_checked']=false;
				$extra_products[$e]['quantity']=1;
			}
			$branch['extra_products']=$extra_products;

			$branches[]=$branch;
		}
		$response['branches']=$branches;

		//Admin & Company acc
		$response['adminacc']=$this->Purchases_model->getAdminAcc();
		$response['coacc']=$this->Purchases_model->getBranchAcc($params);
		echo json_encode($response);
	}

	//Confirm Request
	public function confirmrequest(){
		$branch_id=$this->session->userdata('branch_id');
		$adminid=$this->session->userdata('adminid');
		$params['brand_id']=intval($this->input->post("brand_id"));
		$params['ap_id']=intval($this->input->post("ap_id"));
		$response=[];

		$apd_update=['status'=>'C'];
		$apd_update_status=$this->Purchases_model->updateAP($params['ap_id'],$apd_update);

		$purchase_info=$this->Purchases_model->purchaseInfo($params);
		$branch_ids=explode(",", $purchase_info['branch_ids']);
		for($i=0;$i<count($branch_ids);$i++){
			$bid=$branch_ids[$i];
			$ap_id=$params['ap_id'];
			$branch_purchase=['status'=>'C'];
   			$this->Purchases_model->updateBPConfirm($ap_id,$bid,$branch_purchase);
		}

		$response['update_status']=$apd_update_status;
		$response['error']=false;
		$response['message']='Success';
		echo json_encode($response);
	}

	public function dopayment(){
		$adminid=$this->session->userdata('adminid');
		$params['act_types']=$this->input->post("act_types");
		$params['tot_pcamt']=intval(str_replace(",","",$this->input->post("tot_pcamt")));
		$params['paydate']=$this->input->post("paydate");
		$adminacc=trim($this->input->post("adminacc"));
		$coacc=trim($this->input->post("coacc"));
		$params['refno']=$this->input->post("refno");
		$params['tot_amt']=$this->input->post("tot_amt");
		$params['brand_id']=$this->input->post("brand_id");
		$params['ap_id']=$this->input->post("ap_id");
		$params['act_types']=$this->input->post("act_types");

		$purchase_info=$this->Purchases_model->purchaseInfo($params);
		$pay_amt=$extra_amt=$due_amt=0;
		$description='';
		if($purchase_info['total_price']==$params['tot_pcamt']){
			$pay_amt=$params['tot_pcamt'];
			$due_amt=0;
			$description='Total amount paid '.$pay_amt.' on '.date('Y-m-d H:i');
		}else if($purchase_info['total_price']>$params['tot_pcamt']){
			$pay_amt=$params['tot_pcamt'];
			$due_amt=($purchase_info['total_price']-$params['tot_pcamt']);
			$description='Due amount '.$due_amt.' on '.date('Y-m-d H:i');
		}else if($params['tot_pcamt']>$purchase_info['total_price']){
			$pay_amt=$params['tot_pcamt'];
			$extra_amt=($params['tot_pcamt']-$purchase_info['total_price']);
			$due_amt=0;
			$description='Extra amount paid '.$extra_amt;
		}else{
			$pay_amt=0;
			$due_amt=$params['tot_pcamt'];
			$description='Due amount '.$params['tot_pcamt'].' on '.date('Y-m-d H:i');
		}

		//print_r($params);
		//transaction
		//transaction_settled

		//trans_type,total_amount,user_id,user_type,amount_type,created_on
		//PURCHASE,35000,1,SA,OUT,15-07-2020,admin_acc,company_id,co_acc,due,paytype,ap_id,description

		$trans=[];
		//ADMIN
		$trans=[
				'user_id'=>$adminid,
				'user_type'=>'SA',
				'trans_type'=>'PURCHASE',
				'trans'=>'GOADS',
				'trans_id'=>$params['ap_id'],
				'trans_code'=>'TR'.$params['ap_id'],
				'amount_type'=>'OUT',
				'amount'=>$pay_amt,
				'total_amount'=>$purchase_info['total_price'],
				'due'=>$due_amt,
				'extra_amt'=>$extra_amt,
				'description'=>$description
			 ];

		if($params['act_types']=="bank"){
			$act_types='BK';
		}else if($params['act_types']=="cash"){
			$act_types='CH';
		}else{
			$act_types='CC';
		}

		$tid=$this->Purchases_model->doPurchaseTransaction($trans);
		//ADMIN End

		//Company
		$company=[
				'user_id'=>$params['brand_id'],
				'user_type'=>'',
				'trans_type'=>'SALE',
				'trans'=>'GOADS',
				'trans_id'=>$params['ap_id'],
				'trans_code'=>'TR'.$params['ap_id'],
				'amount_type'=>'IN',
				'amount'=>$pay_amt,
				'total_amount'=>$purchase_info['total_price'],
				'due'=>$due_amt,
				'extra_amt'=>$extra_amt,
				'description'=>$description
			 ];
		$this->Purchases_model->doPurchaseTransaction($company);
		//Company end

		//Payment update in admin purchase
		//status,payment_type,payment_date,company_bankid,tid,note
		$upd_purchase=['status'=>'PM',
					 'payment_type'=>$act_types,
					 'payment_date'=>($adminacc>0)?date('Y-m-d',strtotime($params['paydate'])):date('Y-m-d'),
					 'bank_id'=>($adminacc>0)?$adminacc:0,
					 'company_bankid'=>($coacc>0)?$coacc:0,
					 'refno'=>($adminacc>0)?$params['refno']:0,
					 'tid'=>$tid];
		 $upd_status=$this->Purchases_model->updateAP($params['ap_id'],$upd_purchase);

		 //Branch Payment
		 $upd_bpurchase=['status'=>'PM'];
		 $this->Purchases_model->updateAdminPayment($params['ap_id'],$upd_bpurchase);

		 if($tid>0){
		 	$response['is_payment_done']=true;
			$response['error']=false;
			$response['message']='Success';
		 }else{
		 	$response['is_payment_done']=false;
			$response['error']=true;
			$response['message']='Fail';
		 }

		 echo json_encode($response);
	}
	//Admin End

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

	//Generate Password
    public function generatePassword($length=16,$level=2){
       list($usec, $sec) = explode(' ', microtime());
       srand((float) $sec + ((float) $usec * 100000));
       $validchars[1] = "0123456789abcdfghjkmnpqrstvwxyz";
       $validchars[2] = "0123456789abcdfghjkmnpqrstvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
       $validchars[3] = "0123456789_!@#$%&*()-=+/abcdfghjkmnpqrstvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_!@#$%&*()-=+/";
       $validchars[4] = "0123456789abcdfghjkmnpqrstvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%*";
       $validchars[5] = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
       //$validchars[6] = "0123456789";
       $validchars[6] = "123456789";
       $password  = "";
       $counter   = 0;
       while ($counter < $length) {
         $actChar = substr($validchars[$level], rand(0, strlen($validchars[$level])-1), 1);
         if (!strstr($password, $actChar)) {
            $password .= $actChar;
            $counter++;
         }
       }
       return $password;
    }
}
?>
