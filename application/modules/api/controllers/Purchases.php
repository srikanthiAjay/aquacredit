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
		 $status=$_POST['optradio'];
		 if(count($status)>0){
		 	$params['status']=$status;
		 }else{
		 	$params['status']=["P","C","PM","BC"];
		 }
		}else{
		 $params['status']=["CE"];
		}


		$params['branch_id']=$branch_id;
		$params['adminid']=$adminid;

		$draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$limit = intval($this->input->post("length"));

		## Custom Field value					
		$reportRange=$_POST['reportrange'];
		$params['reportRange']=$reportRange;
		
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

			if(in_array($value['status'],['P','C','PM'])){
				$pbr="PBR".$value['id'];
			}else{
				$pbr="<a >PBR".$value['id'];
				$pbr='<a href="javascript:void(0);" onclick="Purchase.viewProducts('.$value['id'].','.$value['company_id'].');">PBR'.$value['id'].'</a>';
			}

			$purchase_list[]=[
				$pbr,
				date('d-M-Y',strtotime($value['created_on'])),
				$value['brand_name'],
				//"₹ ".$this->IND_money_format($value['total_price']),
				$status,
				'<a href="javascript:void(0);" tabindex="0" role="button" data-toggle="popover" id="req_'.$value['id'].'" data-brand="'.$value['brand_name'].'" data-pbr="PBR'.$value['id'].'" data-status="'.$status.'"><i class="fa fa-ellipsis-v act_icns" onclick="Purchase.purchaseact('.$value['id'].','.$value['company_id'].');"></i></a>'
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
		if($this->session->userdata('adminrole')=='SA'){
			$branch_id=trim($_POST['branch_id']);
		}else{
			$branch_id=$this->session->userdata('branch_id');
		}
		
		$adminid=$this->session->userdata('adminid');
		$brand_id=trim($_POST['brand_id']);
		$response=[];
		$params=[];
		//print_r($_POST);
		//Check with brand
		//Case 2

		/*if(!empty($_POST['ap_id'])){
			$brand=$this->Purchases_model->checkBranchBrand($branch_id,$_POST['ap_id'],$brand_id);
		}else{
			$brand=$this->Purchases_model->checkBrand($brand_id);
		}*/
		
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
				   	 	 $total_price=($_POST['userproducts'][$i]['qty']*$_POST['userproducts'][$i]['purchase_amt']);
				   	 	 $bpd_id=$_POST['userproducts'][$i]['bpd_id'];
				   		 $purchase_details=[
				   	 						'quantity'=>$_POST['userproducts'][$i]['qty'],
				   	 						'price'=>$_POST['userproducts'][$i]['price'],
				   	 						'total_price'=>$total_price
				   	 					   ];
				   	 	 $this->Purchases_model->updateBPDeatils($bpd_id,$purchase_details);
				   	 	 $update_pids[]=$_POST['userproducts'][$i]['pid'];
				   	 }else{
				   	 	$total_price=($_POST['userproducts'][$i]['qty']*$_POST['userproducts'][$i]['purchase_amt']);
				   	 	//Add New Product
			   			$purchase_details=[
			   	 						'bp_id'=>$bp_id,
			   	 						'branch_id'=>$params['branch_id'],
			   	 						'ap_id'=>$params['ap_id'],
			   	 						'product_id'=>$_POST['userproducts'][$i]['pid'],
			   	 						'quantity'=>$_POST['userproducts'][$i]['qty'],
			   	 						'price'=>$_POST['userproducts'][$i]['purchase_amt'],
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
		   		$admin_upd_status=$this->updateAdminP($params);
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
		   			//$total_price=($_POST['userproducts'][$i]['qty']*$_POST['userproducts'][$i]['pmrp']);
		   			$total_price=($_POST['userproducts'][$i]['qty']*$_POST['userproducts'][$i]['purchase_amt']);
		   			$overall_tot_price=$overall_tot_price+$total_price;

		   			$purchase_details[]=[
		   	 						'bp_id'=>$bp_id,
		   	 						'branch_id'=>$branch_id,
		   	 						'ap_id'=>$ap_id,
		   	 						'product_id'=>$_POST['userproducts'][$i]['pid'],
		   	 						'quantity'=>$_POST['userproducts'][$i]['qty'],
		   	 						'price'=>$_POST['userproducts'][$i]['purchase_amt'],
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
		   	 						'price'=>$_POST['userproducts'][$i]['purchase_amt'],
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
		   	 $total_price=($_POST['userproducts'][$i]['qty']*$_POST['userproducts'][$i]['purchase_amt']);
		   	 $overall_tot_price=$overall_tot_price+$total_price;
		   	 $ad_purchase_details[]=[
		   	 						'ap_id'=>$ap_id,
		   	 						'product_id'=>$_POST['userproducts'][$i]['pid'],
		   	 						'quantity'=>$_POST['userproducts'][$i]['qty'],
		   	 						'price'=>$_POST['userproducts'][$i]['purchase_amt'],
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
		   			//$total_price=($_POST['userproducts'][$i]['qty']*$_POST['userproducts'][$i]['pmrp']);
		   			$total_price=($_POST['userproducts'][$i]['qty']*$_POST['userproducts'][$i]['purchase_amt']);
		   			$purchase_details[]=[
		   	 						'bp_id'=>$bp_id,
		   	 						'branch_id'=>$branch_id,
		   	 						'ap_id'=>$ap_id,
		   	 						'product_id'=>$_POST['userproducts'][$i]['pid'],
		   	 						'quantity'=>$_POST['userproducts'][$i]['qty'],
		   	 						'price'=>$_POST['userproducts'][$i]['purchase_amt'],
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

	//Delete request
	public function delrequest(){
		$branch_id=$this->session->userdata('branch_id');
		$adminid=$this->session->userdata('adminid');
		$params['branch_id']=$branch_id;
		$params['bp_id']=$_POST['bp_id'];
		$params['ap_id']=$_POST['ap_id'];
		$delprod=$_POST['delprod'];
		$response=$update_pids=[];
		//branch_purchase,branch_purchase_details
		//admin_purchase,admin_purchase_details
		$all_prod_removed=false;
		if(!empty($delprod['bpd_id'])){
			$params['pid']=$delprod['pid'];
			$params['bpd_id']=$delprod['bpd_id'];

			//Branch
			$bprod=$this->Purchases_model->getBranchProductDetails($params);

			//Admin
			$aprod=$this->Purchases_model->getAPDProduct($params['pid'],$params['ap_id']);
			$new_branch_ids=[];
			$branch_ids=explode(",",$aprod['branch_ids']);

			if(count($branch_ids)>1){
				//Reset amount
				$branchpinfo=$this->Purchases_model->branchPurchaseInfo($params);
				$remaing_bal=$branchpinfo['total_price']-$bprod['total_price'];
				$purchase=['total_price'=>$remaing_bal];
				$this->Purchases_model->updateBP($params['bp_id'],$purchase);

				//Delete
				$this->Purchases_model->delProduct($delprod['bpd_id']);
				for($i=0;$i<count($branch_ids);$i++){
					if($branch_id!=$branch_ids[$i]){
						$new_branch_ids[]=$branch_ids[$i];
					}
				}

				$new_branchids_str=implode(",",$new_branch_ids);

				$chek_branch_r=$this->Purchases_model->checkBranch($params['pid'],$params['branch_id']);
				//Update APD Details
				$adp_quantity=($chek_branch_r['quantity']-$bprod['quantity']);
				$adp_total_price=($chek_branch_r['total_price']-$bprod['total_price']);

				$adp_details=['branch_ids'=>trim($new_branchids_str,","),'quantity'=>$adp_quantity,'total_price'=>$adp_total_price];
   				$status=$this->Purchases_model->updateAPDeatils($chek_branch_r['apd_id'],$adp_details);

				//$update_pids[]=$params['pid'];
				//$params['update_pids']=$update_pids;
				//$this->updateAdminPD($params);
			}else{
				//Reset amount
				$branchpinfo=$this->Purchases_model->branchPurchaseInfo($params);
				$remaing_bal=$branchpinfo['total_price']-$bprod['total_price'];
				$purchase=['total_price'=>$remaing_bal];
				$this->Purchases_model->updateBP($params['bp_id'],$purchase);
				
				//Delete Product from admin product details
				//Delete
				$this->Purchases_model->delProduct($delprod['bpd_id']);
				$this->Purchases_model->delProductFromAPD($params);
			}

			$branch_prod_cnt=$this->Purchases_model->getBranchProductDetailsCnt($params['bp_id']);
			if($branch_prod_cnt==0){
				$apdetails=$this->Purchases_model->purchaseInfo($params);
				$ap_branch_ids=explode(",",$apdetails['branch_ids']);
				$ap_bp_ids=explode(",",$apdetails['bp_ids']);

				$new_ap_branch_ids=$new_ap_bp_ids=[];
				for($j=0;$j<count($ap_branch_ids);$j++){
					if($branch_id!=$ap_branch_ids[$j]){
						$new_ap_branch_ids[]=$ap_branch_ids[$j];
					}
				}

				for($k=0;$k<count($ap_bp_ids);$k++){
					if($params['bp_id']!=$ap_bp_ids[$k]){
						$new_ap_bp_ids[]=$ap_branch_ids[$k];
					}
				}

				//Update Admin Purchase
				$upd_admin_purchase=['branch_ids'=>implode(",",$new_ap_branch_ids),'bp_ids'=>implode(",",$new_ap_bp_ids)];
				$this->Purchases_model->updateAdminPurchase($params['ap_id'],$upd_admin_purchase);

				//branch_ids,bp_ids
				$all_prod_removed=$this->Purchases_model->delBranchPID($params['bp_id']);
			}

			//Check Admin Purchase
			$all_prod=$this->Purchases_model->getAdminPD($params['ap_id']);
			if(count($all_prod)>0){
				$admin_upd_status=$this->updateAdminP($params);
			}else{
				//Del Admin Purchase
				$this->Purchases_model->delAP($params['ap_id']);
			}

			
			
			$response['branch_reset']=true;
		}else{
			$response['branch_reset']=false;
		}

		$response['all_prod_removed']=$all_prod_removed;
		echo json_encode($response);
	}

	//Delete branch request
	public function deletebranchreq(){
		$branch_id=$this->session->userdata('branch_id');
		$adminid=$this->session->userdata('adminid');
		$params['branch_id']=$branch_id;
		$params['bp_id']=$_POST['bp_id'];
		$params['brand_id']=$_POST['brand_id'];

		$branch_info=$this->Purchases_model->getBranchPurchaseInfo($params);
		$params['ap_id']=$branch_info['ap_id'];
		$branch_prod=$this->Purchases_model->getBranchPurchaseDetails($params);

		$all_prod_removed=false;
		for($i=0;$i<count($branch_prod);$i++){
			$params['pid']="";
			$params['bpd_id']="";

			$params['pid']=$branch_prod[$i]['pid'];
			$params['bpd_id']=$branch_prod[$i]['bpd_id'];

			//Admin
			$aprod=$this->Purchases_model->getAPDProduct($params['pid'],$params['ap_id']);
			$new_branch_ids=[];
			$branch_ids=explode(",",$aprod['branch_ids']);

			//Delete
			$this->Purchases_model->delProduct($branch_prod[$i]['bpd_id']);

			if(count($branch_ids)>1){
				for($j=0;$j<count($branch_ids);$j++){
					if($branch_id!=$branch_ids[$j]){
						$new_branch_ids[]=$branch_ids[$j];
					}
				}
				$new_branchids_str=implode(",",$new_branch_ids);

				$chek_branch_r=$this->Purchases_model->checkBranch($params['pid'],$params['branch_id']);
				//Update APD Details
				$adp_quantity=($chek_branch_r['quantity']-$branch_prod[$i]['quantity']);
				$adp_total_price=($chek_branch_r['total_price']-$branch_prod[$i]['total_price']);

				$adp_details=['branch_ids'=>trim($new_branchids_str,","),'quantity'=>$adp_quantity,'total_price'=>$adp_total_price];
   				$status=$this->Purchases_model->updateAPDeatils($chek_branch_r['apd_id'],$adp_details);
			}else{
				//Delete Product from admin product details
				$this->Purchases_model->delProductFromAPD($params);
			}


		}

		$branch_prod_cnt=$this->Purchases_model->getBranchProductDetailsCnt($params['bp_id']);
		if($branch_prod_cnt==0){
			$apdetails=$this->Purchases_model->purchaseInfo($params);
			$ap_branch_ids=explode(",",$apdetails['branch_ids']);
			$ap_bp_ids=explode(",",$apdetails['bp_ids']);

			$new_ap_branch_ids=$new_ap_bp_ids=[];
			for($k=0;$k<count($ap_branch_ids);$k++){
				if($branch_id!=$ap_branch_ids[$k]){
					$new_ap_branch_ids[]=$ap_branch_ids[$k];
				}
			}

			for($l=0;$l<count($ap_bp_ids);$l++){
				if($params['bp_id']!=$ap_bp_ids[$l]){
					$new_ap_bp_ids[]=$ap_branch_ids[$l];
				}
			}

			//Update Admin Purchase
			$upd_admin_purchase=['branch_ids'=>implode(",",$new_ap_branch_ids),'bp_ids'=>implode(",",$new_ap_bp_ids)];
			$this->Purchases_model->updateAdminPurchase($params['ap_id'],$upd_admin_purchase);

			//branch_ids,bp_ids
			$all_prod_removed=$this->Purchases_model->delBranchPID($params['bp_id']);
		}

		//Check Admin Purchase
		$all_prod=$this->Purchases_model->getAdminPD($params['ap_id']);
		if(count($all_prod)>0){
			$admin_upd_status=$this->updateAdminP($params);
		}else{
			//Del Admin Purchase
			$this->Purchases_model->delAP($params['ap_id']);
		}

		$response['branch_req_removed']=$all_prod_removed;
		echo json_encode($response);
	}

	//Delete Admin Request
	public function deleteadminreq(){
		$branch_id=$this->session->userdata('branch_id');
		$adminid=$this->session->userdata('adminid');
		$params['branch_id']=$branch_id;
		$params['ap_id']=$_POST['ap_id'];
		$params['brand_id']=$_POST['brand_id'];

		$delreq=false;
		//Del Admin Purchase
		$bpreq=$this->Purchases_model->delBranchPurchaseRequest($params['ap_id']);
		if($bpreq){
			$bpreqd=$this->Purchases_model->delBranchPurchaseRequestDetails($params['ap_id']);
			if($bpreqd){
				$apreqd=$this->Purchases_model->delAdminPurchaseDetails($params['ap_id']);
				if($apreqd){
					$apreq=$this->Purchases_model->delAP($params['ap_id']);
					$delreq=$apreq;
				}
			}
		}

		if($delreq){
			$response['delreq']=$delreq;
			$response['error']=false;
			$response['message']='Success';
		}else{
			$response['delreq']=$delreq;
			$response['error']=true;
			$response['message']='Fail';
		}
		
		echo $response;
	}

	//Get request products
	public function getreq_products(){
		$branch_id=$this->session->userdata('branch_id');
		$adminid=$this->session->userdata('adminid');
		$params['brand_id']=$_POST['brand_id'];
		$params['bp_id']=$_POST['bp_id'];

		//Get Branch Wallet Info
		$wallet_info=$this->Purchases_model->getBranchWalletInfo($branch_id);
		$wallet_amt=$wallet_info['avail_amount'];

		$branch_info=$this->Purchases_model->getBranchDetails($branch_id);
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
			$response['wallet_info']=$wallet_info;
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

	//Get request products
	public function getpbrreq_products(){
		$branch_id=$this->session->userdata('branch_id');
		$adminid=$this->session->userdata('adminid');
		$params['brand_id']=$_POST['brand_id'];
		$params['bp_id']=$_POST['bp_id'];
		$bpurchase_info=$this->Purchases_model->getBranchPurchaseInfo($params);
		$bpurchase_details=$this->Purchases_model->getBranchPurchaseDetails($params);
		
		$response=[];
		if(count($bpurchase_details)>0){
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
		if($bpsummary['bpcnt']>0){
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
		
		if($apsummary['apcnt']>0){
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
		$adminid=$this->session->userdata('adminid');
		$branch_id=$this->session->userdata('branch_id');
		$brand_id=$_POST['brand_id'];
		$ap_id=$_POST['ap_id'];
		$bp_id=$_POST['bpid'];

		$params['branch_id']=$branch_id;
    	$params['unloading_charges']=$_POST['unloading_charges'];
    	$params['transport_charges']=$_POST['transport_charges'];
    	$params['ap_id']=$_POST['ap_id'];
    	$params['bp_id']=$_POST['bpid'];
    	$params['brand_id']=$_POST['brand_id'];
    	$userproducts=json_decode($_POST['userproducts']);
    	$_POST['bp_id']=$params['bp_id'];

    	//Invoice
    	$upload_dir = FCPATH.'assets'. DIRECTORY_SEPARATOR . 'invoice'. DIRECTORY_SEPARATOR;
    	$file_name=$_FILES["invoice_file"]['name'];
    	$tempPath = $_FILES["invoice_file"]['tmp_name'];
    	$time=date('d_m_Y_h_m_i');
    	$ext=pathinfo($file_name,PATHINFO_EXTENSION);
    	$invoice_file="invoice_".$params['bp_id']."_".$time.".".$ext;
    	$uploadPath = $upload_dir . $invoice_file;

    	//Get Branch Wallet Info
		$wallet_info=$this->Purchases_model->getBranchWalletInfo($branch_id);
		$wallet_amt=$wallet_info['avail_amount'];

    	$bpurchase_info=$this->Purchases_model->getBranchPurchaseInfo($params);
		$bpurchase_details=$this->Purchases_model->getBranchPurchaseDetails($params);
		$branch_info=$this->Purchases_model->getBranchDetails($params['branch_id']);
		$response=[];
    	$cnt=0;

    	//$params['transport_charges']=43000;
    	$branch_pay=false;
    	$admin_pay_req=0;
    	$response['wallet_bal']=$wallet_amt;
    	$upl_trsp=($params['unloading_charges']+$params['transport_charges']);

    	//$upl_trsp=43000;
    	if($wallet_amt>=$upl_trsp){
    		//Wallets
			//unloading charges
			$bwallet_amt=$wallet_amt;
			$rem_bwallet_amt=($bwallet_amt-$params['unloading_charges']);

    		//Pay By branch
    		$response['admin_pay']=false;
    		$branch_pay=true;
    	}else{
    		//Pay By admin
    		if($_POST['pay_by']=='admin'){
    		 $admin_pay_req=1;
    		 $response['admin_pay']=false;
	    	 $branch_pay=true;
    		}else{
    		 $response['admin_pay']=true;
    		 $branch_pay=false;
    		}
    		
    	}

    	if($branch_pay){

			//Case 3
	   		//Update
	   		if(!empty($_POST['bp_id'])){
	   			$ap_id=trim($_POST['ap_id']);
		   		$bp_id=trim($_POST['bp_id']);

		   		//Branch Details Update
			   $overall_tot_price=0;
			   $update_pids=$new_pids=[];

				for($i=0;$i<count($userproducts);$i++){
			   		 //print_r($_POST['userproducts'][$i]);
				   	 if(!empty($userproducts[$i]->bpd_id)){
				   	 	 $total_price=($userproducts[$i]->qty*$userproducts[$i]->price);
				   	 	 $bpd_id=$userproducts[$i]->bpd_id;
				   		 $purchase_details=[
				   	 						'quantity'=>$userproducts[$i]->qty,
				   	 						'price'=>$userproducts[$i]->price,
				   	 						'total_price'=>$total_price
				   	 					   ];
				   	 	 $this->Purchases_model->updateBPDeatils($bpd_id,$purchase_details);
				   	 	 $update_pids[]=$userproducts[$i]->pid;
				   	 }else{
				   	 	$total_price=($userproducts[$i]->qty*$userproducts[$i]->price);
				   	 	//Add New Product
			   			$purchase_details=[
			   	 						'bp_id'=>$bp_id,
			   	 						'branch_id'=>$params['branch_id'],
			   	 						'ap_id'=>$params['ap_id'],
			   	 						'product_id'=>$userproducts[$i]->pid,
			   	 						'quantity'=>$userproducts[$i]->qty,
			   	 						'price'=>$userproducts[$i]->price,
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
	   			$admin_upd_status=$this->updateAdminP($params);
	   		}
			

    		//Wallets
			//unloading charges
			$bwallet_amt=$wallet_amt;
			$rem_bwallet_amt=($bwallet_amt-$params['unloading_charges']);

			//Update Transaction (unloading charges)
			$utrans=[
				'user_id'=>$branch_id,
				'user_type'=>'U',
				'trans_type'=>'PURCHASE',
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
    		 //Need add cash book

    		//Add in wallet
			$uwallet=[
					  'tr_id'=>$unloading_tid,
					  'trtype'=>'OTH',
					  'uid'=>$branch_id,
					  'utype'=>'U',
					  'amount'=>$params['unloading_charges'],
					  'payment_type'=>'CH',
					  'entry_status'=>'OUT'
					];
			$this->Purchases_model->addInWallet($uwallet);

			if($admin_pay_req==0){
				//transport charges
				$rem_bwallet_amt=($rem_bwallet_amt-$params['transport_charges']);

				//Update Transaction (transport charges)
				$ttrans=[
					'user_id'=>$branch_id,
					'user_type'=>'U',
					'trans_type'=>'PURCHASE',
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

				//Need to add cash book

				//Add in wallet
				$twallet=[
						  'tr_id'=>$transport_tid,
						  'trtype'=>'OTH',
						  'uid'=>$branch_id,
						  'utype'=>'U',
						  'amount'=>$params['transport_charges'],
						  'payment_type'=>'CH',
						  'entry_status'=>'OUT'
						];
				$this->Purchases_model->addInWallet($twallet);
			}

			//Update Branch Amount
			$branch_amt=['avail_amount'=>$rem_bwallet_amt];
			$this->Purchases_model->updateBranchAmount($branch_id,$branch_amt);

			//Confirm Branch
			$cnf=['status'=>'CE','unloading_charges'=>$params['unloading_charges'],'transport_charges'=>$params['transport_charges'],'upload_invoice'=>$invoice_file,'tr_charges_paidby'=>($admin_pay_req==0)?'A':'SA','admin_pay_req'=>$admin_pay_req];
			$confirm_status=$this->Purchases_model->updateBPConfirm($params['ap_id'],$branch_id,$cnf);

			$response['confirm_status']=$confirm_status;
			if($confirm_status){
				//Tables - branch_inventory,transactions,wallets,branch,branch_purchase
				if(move_uploaded_file($tempPath,$uploadPath)){
					$bpurchase_details=$this->Purchases_model->getBranchPurchaseDetails($params);
					//Branch Inventory
					for($i=0;$i<count($bpurchase_details);$i++){
						$pid=$bpurchase_details[$i]['pid'];

						//Check Branch Product
					  	$check_product=$this->Purchases_model->checkBranchProduct($pid,$branch_id);
					  	$qty=0;

					  	//Update product mrp and purchase amount from products
					  	$prod_details=$this->Purchases_model->getProductDetails($pid);
					  	//$product
					  	if(!empty($check_product['bin_id'])){
					  		//Update Product
					  		$qty=(intval($check_product['qty'])+intval($bpurchase_details[$i]['quantity']));
					  		/*$upd_prod=['pmrp'=>$bpurchase_details[$i]['price'],'purchase_amt'=>$bpurchase_details[$i]['purchase_amt'],'qty'=>$qty,'percentage'=>$bpurchase_details[$i]['percentage']];*/
					  		$upd_prod=['pmrp'=>$prod_details['pmrp'],'purchase_amt'=>$prod_details['purchase_amt'],'qty'=>$qty,'percentage'=>$prod_details['percentage']];
					  		$where_cond=["pid"=>$pid,"branch_id"=>$branch_id];
					  		$upd_result=$this->Purchases_model->updateProductInInventory($upd_prod,$where_cond);
					  		if($upd_result){
					  			$cnt++;
					  		}
					  	}else{
					  		//Add Product
					  		/*$add_prod=['branch_id'=>$branch_id,'pid'=>$pid,'pmrp'=>$bpurchase_details[$i]['price'],'purchase_amt'=>$bpurchase_details[$i]['purchase_amt'],'qty'=>$bpurchase_details[$i]['quantity'],'percentage'=>$bpurchase_details[$i]['percentage']];*/
					  		$add_prod=['branch_id'=>$branch_id,'pid'=>$pid,'pmrp'=>$prod_details['pmrp'],'purchase_amt'=>$prod_details['purchase_amt'],'qty'=>$bpurchase_details[$i]['quantity'],'percentage'=>$prod_details['percentage']];
					  		$add_result=$this->Purchases_model->addProductInInventory($add_prod);
					  		if($add_result>0){
					  			$cnt++;
					  		}
					  	}
					}
				}

				//Admin Purchase
				$admin_purchase=$this->Purchases_model->purchaseInfo($params);
				$branch_ids=explode(",", $admin_purchase['branch_ids']);
				$check_all_bcnf=$this->Purchases_model->checkAllBConfirmation($params['ap_id'],$branch_ids);
				if(count($check_all_bcnf)==count($branch_ids) && $admin_pay_req==0){
					$upd_purchase=['status'=>'CE'];
		 			$upd_status=$this->Purchases_model->updateAP($params['ap_id'],$upd_purchase);

		 			//Payment
		 			//$payment_info=$this->Purchases_model->purchaseInfo($params);

		 			//Company Goods
		 			$apd_result=$this->Purchases_model->getAdminPD($params['ap_id']);
					$overall_tot_price=0;

					foreach($apd_result as $key=>$value){
						$overall_tot_price=($overall_tot_price+$value['total_price']);
					}

					$description='Total amount paid '.$overall_tot_price.' on '.date('Y-m-d H:i');
					//Company
					$company=[
							'user_id'=>$params['brand_id'],
							'user_type'=>'',
							'trans_type'=>'PURCHASE',
							'trans'=>'GOODS',
							'trans_id'=>$params['ap_id'],
							'trans_code'=>'TR'.$params['ap_id'],
							'amount_type'=>'IN',
							'amount'=>$overall_tot_price,
							'total_amount'=>$overall_tot_price,
							'due'=>0,
							'extra_amt'=>0,
							'description'=>$description
						 ];
					$ctid=$this->Purchases_model->doPurchaseTransaction($company);
					//Company end

					//Need to add cash book

					//Update Company Goods Transaction ID
					$ctid_update=['ctid'=>$ctid];
					$this->Purchases_model->updateAdminPurchase($params['ap_id'],$ctid_update);

				}
			}

			echo json_encode($response);
    	}else{
    		echo json_encode($response);
    	}

	}
	
	//Admin Start
	public function goodsconfirm(){
		$branch_id=$_POST['branch_id'];
		$adminid=$this->session->userdata('adminid');
		$params['branch_id']=$branch_id;
    	$params['unloading_charges']=(int)$_POST['unloading_charges'];
    	$params['transport_charges']=(int)$_POST['transport_charges'];
    	$params['ap_id']=$_POST['ap_id'];
    	$params['bp_id']=$_POST['bpid'];
    	$params['brand_id']=$_POST['brand_id'];

    	$bpurchase_info=$this->Purchases_model->getBranchPurchaseInfo($params);
		$bpurchase_details=$this->Purchases_model->getBranchPurchaseDetails($params);
		$branch_info=$this->Purchases_model->getBranchDetails($params['branch_id']);

		//Invoice
    	$upload_dir = FCPATH.'assets'. DIRECTORY_SEPARATOR . 'invoice'. DIRECTORY_SEPARATOR;
    	$file_name=$_FILES["invoice_file"]['name'];
    	$tempPath = $_FILES["invoice_file"]['tmp_name'];
    	$time=date('d_m_Y_h_m_i');
    	$ext=pathinfo($file_name,PATHINFO_EXTENSION);
    	$invoice_file="invoice_".$params['bp_id']."_".$time.".".$ext;
    	$uploadPath = $upload_dir . $invoice_file;
    	//move_uploaded_file($tempPath,$uploadPath);
    	
		//print_r($bpurchase_details);
    	$response=[];
    	$cnt=0;

    	
    	//$params['transport_charges']=43000;
    	$branch_pay=false;
    	$upl_trsp=($params['unloading_charges']+$params['transport_charges']);
    	if($branch_info["amount"]>=$params['transport_charges']){
    		//Wallets
			//unloading charges
			$bwallet_amt=$branch_info['amount'];
			$rem_bwallet_amt=($bwallet_amt-$params['unloading_charges']);

    		//Pay By branch
    		$response['admin_pay']=false;
    		$branch_pay=true;
    		$dtid=0;
    	}else{
    		//print_r($_POST);

    		//Pay By admin
    		if($_POST['pay_by']=='admin'){
	    		if($_POST['act_types']=='bank'){
	    			$driver=[
	    					 'dname'=>$_POST['dname'],
	    					 'dacc'=>$_POST['dacc'],
	    					 'difsc'=>$_POST['difsc'],
	    					 'admin_acc'=>$_POST['dadminacc'],
	    					 'drefno'=>$_POST['drefno']
	    					];
	    		}else{
	    			$driver=[
	    					 'dmobile'=>$_POST['dmobile'],
	    					 'dnote'=>$_POST['dnote']
	    					];
	    		}

	    		$driver['pay_date']=date('Y-m-d',strtotime($_POST['ddate']));
	    		$driver['transport_charges']=$_POST['transport_charges'];
	    		$driver['bp_id']=$_POST['bpid'];
	    		
	    		$response['admin_pay']=false;
	    		$branch_pay=true;
	    		$dtid=$this->Purchases_model->addDriverDetails($driver);
    		}else{
    			$response['admin_pay']=true;
    			$branch_pay=false;
    		}    		
    	}

    	if($branch_pay){
    		//Update Transaction (unloading charges)
			$utrans=[
				'user_id'=>$branch_id,
				'user_type'=>'U',
				'trans_type'=>'PURCHASE',
				'trans'=>'UNLOADING',
				'trans_id'=>$params['ap_id'],
				'trans_code'=>'TR'.$params['ap_id'],
				'amount_type'=>'OUT',
				'amount'=>$params['unloading_charges'],
				'total_amount'=>$params['unloading_charges'],
				'due'=>0,
				'extra_amt'=>0,
				'atd_id'=>0,
				'description'=>'Unloading charges paid by '.$branch_info['branch_name']
			 ];

			$unloading_tid=$this->Purchases_model->doPurchaseTransaction($utrans);

			//Add in wallet
			$uwallet=[
					  'tr_id'=>$unloading_tid,
					  'trtype'=>'PU',
					  'uid'=>$branch_id,
					  'utype'=>'U',
					  'amount'=>$params['unloading_charges'],
					  'payment_type'=>'CH',
					  'entry_status'=>'OUT'
					];
			$this->Purchases_model->addInWallet($uwallet);

			
			if($dtid>0){
    			$description='Transport charges paid by ADMIN';
    		}else{
    			$description='Transport charges paid by '.$branch_info['branch_name'];
    		}

    		//Update Transaction (transport charges)
			$ttrans=[
				'user_id'=>$branch_id,
				'user_type'=>'U',
				'trans_type'=>'PURCHASE',
				'trans'=>'TRANSPORT',
				'trans_id'=>$params['ap_id'],
				'trans_code'=>'TR'.$params['ap_id'],
				'amount_type'=>'OUT',
				'amount'=>$params['transport_charges'],
				'total_amount'=>$params['transport_charges'],
				'due'=>0,
				'extra_amt'=>0,
				'atd_id'=>$dtid,
				'description'=>$description
			 ];

			$transport_tid=$this->Purchases_model->doPurchaseTransaction($ttrans);

			//Add in wallet
			if($dtid==0){
				//transport charges
				$rem_bwallet_amt=($rem_bwallet_amt-$params['transport_charges']);

				$twallet=[
						  'tr_id'=>$transport_tid,
						  'trtype'=>'PU',
						  'uid'=>$branch_id,
						  'utype'=>'U',
						  'amount'=>$params['transport_charges'],
						  'payment_type'=>'CH',
						  'entry_status'=>'OUT'
						];
				$this->Purchases_model->addInWallet($twallet);
			}

			//Update Branch Amount
			$branch_amt=['avail_amount'=>$rem_bwallet_amt];
			$this->Purchases_model->updateBranchAmount($branch_id,$branch_amt);

			//Confirm Branch
			$cnf=['status'=>'CE','unloading_charges'=>$params['unloading_charges'],'transport_charges'=>$params['transport_charges'],'upload_invoice'=>$invoice_file,'tr_charges_paidby'=>($dtid>0)?'SA':'A'];
			$confirm_status=$this->Purchases_model->updateBPConfirm($params['ap_id'],$branch_id,$cnf);
			$response['confirm_status']=$confirm_status;


			if($confirm_status){
				//Admin Purchase
				$admin_purchase=$this->Purchases_model->purchaseInfo($params);
				$branch_ids=explode(",", $admin_purchase['branch_ids']);
				$check_all_bcnf=$this->Purchases_model->checkAllBConfirmation($params['ap_id'],$branch_ids);
				if(count($check_all_bcnf)==count($branch_ids)){
					$upd_purchase=['status'=>'CE'];
		 			$upd_status=$this->Purchases_model->updateAP($params['ap_id'],$upd_purchase);

		 			//Payment
		 			//$payment_info=$this->Purchases_model->purchaseInfo($params);

		 			//Company Goods
		 			$apd_result=$this->Purchases_model->getAdminPD($params['ap_id']);
					$overall_tot_price=0;

					foreach($apd_result as $key=>$value){
						$overall_tot_price=($overall_tot_price+$value['total_price']);
					}

					$description='Total amount paid '.$overall_tot_price.' on '.date('Y-m-d H:i');
					//Company
					$company=[
							'user_id'=>$params['brand_id'],
							'user_type'=>'',
							'trans_type'=>'PURCHASE',
							'trans'=>'GOODS',
							'trans_id'=>$params['ap_id'],
							'trans_code'=>'TR'.$params['ap_id'],
							'amount_type'=>'IN',
							'amount'=>$overall_tot_price,
							'total_amount'=>$overall_tot_price,
							'due'=>0,
							'extra_amt'=>0,
							'description'=>$description
						 ];
					$ctid=$this->Purchases_model->doPurchaseTransaction($company);
					//Company end

					//Update Company Goods Transaction ID
					$ctid_update=['ctid'=>$ctid];
					$this->Purchases_model->updateAdminPurchase($params['ap_id'],$ctid_update);

				}
			}

			//Tables - branch_inventory,transactions,wallets,branch,branch_purchase
			if(move_uploaded_file($tempPath,$uploadPath)){
				//Branch Inventory
				for($i=0;$i<count($bpurchase_details);$i++){
					$pid=$bpurchase_details[$i]['pid'];

					//Check Branch Product
			  		$check_product=$this->Purchases_model->checkBranchProduct($pid,$branch_id);
			  		$qty=0;

			  		if(!empty($check_product['bin_id'])){
				  		//Update Product
				  		$qty=(intval($check_product['qty'])+intval($bpurchase_details[$i]['quantity']));
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

			echo json_encode($response);
    	}else{
    		echo json_encode($response);
    	}
    	
    	exit;
    	/*//Tables - branch_inventory,transactions,wallets,branch,branch_purchase
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
				'trans_type'=>'PURCHASE',
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

		echo json_encode($response);*/
	}

	public function paytransportcharges(){
		$branch_id=$_POST['branch_id'];
		$adminid=$this->session->userdata('adminid');
		$params['branch_id']=$branch_id;
    	$params['transport_charges']=(int)$_POST['transport_charges'];
    	$params['ap_id']=$_POST['ap_id'];
    	$params['bp_id']=$_POST['bpid'];
    	$params['brand_id']=$_POST['brand_id'];

    	$bpurchase_info=$this->Purchases_model->getBranchPurchaseInfo($params);
		$bpurchase_details=$this->Purchases_model->getBranchPurchaseDetails($params);
		$branch_info=$this->Purchases_model->getBranchDetails($params['branch_id']);

		if($_POST['pay_by']=='admin'){
    		if($_POST['act_types']=='bank'){
    			$driver=[
    					 'dname'=>$_POST['dname'],
    					 'dacc'=>$_POST['dacc'],
    					 'difsc'=>$_POST['difsc'],
    					 'admin_acc'=>$_POST['dadminacc'],
    					 'drefno'=>$_POST['drefno']
    					];
    		}else{
    			$driver=[
    					 'dmobile'=>$_POST['dmobile'],
    					 'dnote'=>$_POST['dnote']
    					];
    		}

    		$driver['pay_date']=date('Y-m-d',strtotime($_POST['ddate']));
    		$driver['transport_charges']=$_POST['transport_charges'];
    		$driver['bp_id']=$_POST['bpid'];
    		
    		$response['admin_pay']=false;
    		$branch_pay=true;
    		$dtid=$this->Purchases_model->addDriverDetails($driver);
		}

		if($dtid>0){
			$description='Transport charges paid by ADMIN';
		}else{
			$description='Transport charges paid by '.$branch_info['branch_name'];
		}

		//Update Transaction (transport charges)
		$ttrans=[
			'user_id'=>$branch_id,
			'user_type'=>'U',
			'trans_type'=>'PURCHASE',
			'trans'=>'TRANSPORT',
			'trans_id'=>$params['ap_id'],
			'trans_code'=>'TR'.$params['ap_id'],
			'amount_type'=>'OUT',
			'amount'=>$params['transport_charges'],
			'total_amount'=>$params['transport_charges'],
			'due'=>0,
			'extra_amt'=>0,
			'atd_id'=>$dtid,
			'description'=>$description
		 ];

		 $transport_tid=$this->Purchases_model->doPurchaseTransaction($ttrans);

		//Admin Purchase
		$admin_purchase=$this->Purchases_model->purchaseInfo($params);
		$branch_ids=explode(",", $admin_purchase['branch_ids']);
		$check_all_bcnf=$this->Purchases_model->checkAllBConfirmation($params['ap_id'],$branch_ids);
		if(count($check_all_bcnf)==count($branch_ids)){
			$upd_purchase=['status'=>'CE'];
 			$upd_status=$this->Purchases_model->updateAP($params['ap_id'],$upd_purchase);

 			//Payment
 			//$payment_info=$this->Purchases_model->purchaseInfo($params);

 			//Company Goods
 			$apd_result=$this->Purchases_model->getAdminPD($params['ap_id']);
			$overall_tot_price=0;

			foreach($apd_result as $key=>$value){
				$overall_tot_price=($overall_tot_price+$value['total_price']);
			}

			$description='Total amount paid '.$overall_tot_price.' on '.date('Y-m-d H:i');
			//Company
			$company=[
					'user_id'=>$params['brand_id'],
					'user_type'=>'',
					'trans_type'=>'PURCHASE',
					'trans'=>'GOODS',
					'trans_id'=>$params['ap_id'],
					'trans_code'=>'TR'.$params['ap_id'],
					'amount_type'=>'IN',
					'amount'=>$overall_tot_price,
					'total_amount'=>$overall_tot_price,
					'due'=>0,
					'extra_amt'=>0,
					'description'=>$description
				 ];
			$ctid=$this->Purchases_model->doPurchaseTransaction($company);
			//Company end

			//Update Company Goods Transaction ID
			$ctid_update=['ctid'=>$ctid];
			$this->Purchases_model->updateAdminPurchase($params['ap_id'],$ctid_update);

		}

		$response=[];
		if($transport_tid>0){
			$update_pay_req=['admin_pay_req'=>0];
			$this->Purchases_model->updateBP($params['bp_id'],$update_pay_req);
			$response['confirm_status']=true;
		}else{
			$response['confirm_status']=false;
		}

		echo json_encode($response);
	}

	public function purchaselist(){
		$branch_id=$this->session->userdata('branch_id');
		$adminid=$this->session->userdata('adminid');
		$hid_tabval=intval($this->input->post("hid_tabval"));

		if($hid_tabval==0){
		 $status=$_POST['optradio'];
		 if(count($status)>0){
		 	$params['status']=(count($status)>0)?$status:[];
		 }else{
		 	$params['status']=["P","C","PM","BC"];
		 }
		}else{
		 $params['status']=["CE"];
		}

		$params['branch_id']=$branch_id;
		$params['adminid']=$adminid;

		$draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$limit = intval($this->input->post("length"));

		## Custom Field value					
		$reportRange=$_POST['reportrange'];
		$params['reportRange']=$reportRange;


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
			}else if($value['status']=='PM'){
				$status='Payment';
			}else{
				$status='Completed';
			}

			if(in_array($value['status'],['P','C','PM'])){
				$pbr="PBR".$value['id'];
			}else{
				$pbr="PBR".$value['id'];
				/*$pbr="<a >PBR".$value['id'];
				$pbr='<a href="javascript:void(0);" onclick="Purchase.viewProducts('.$value['id'].','.$value['company_id'].');">PBR'.$value['id'].'</a>';*/
			}

			$purchase_list[]=[
				$pbr,
				date('d-M-Y',strtotime($value['created_on'])),
				$value['brand_name'],
				"₹ ".$this->IND_money_format($value['total_price']),
				$status,
				'<a href="javascript:void(0);" tabindex="0" role="button" data-toggle="popover" id="req_'.$value['id'].'" data-brand="'.$value['brand_name'].'" data-pbr="PBR'.$value['id'].'" data-status="'.$status.'"><i class="fa fa-ellipsis-v act_icns" onclick="Purchase.purchaseact('.$value['id'].','.$value['company_id'].');"></i></a>'
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
		if($purchase_info['status']=='PM'){
		  if($purchase_info['payment_type']=='BK'){
		  	$purchase_info['ptype']='BANK';
		  	//Get Admin Bank Acc
		  	$ad_bank=$this->Purchases_model->getAdminBankInfo($purchase_info['bank_id']);
		  	$purchase_info['admin_acc']=$ad_bank['account_no'];
		  	$purchase_info['admin_acc_name']=$ad_bank['bank_name'];

		  	//Get Brand Bank Acc
		  	$co_bank=$this->Purchases_model->getBrandBankInfo($purchase_info['company_bankid']);
		  	$purchase_info['co_acc']=$co_bank['account_no'];
		  	$purchase_info['co_acc_name']=$co_bank['bank_name'];
		  }else if($purchase_info['payment_type']=='CH'){
		  	$purchase_info['ptype']='CASH';

		  }else if($purchase_info['payment_type']=='CC'){
		  	$purchase_info['ptype']='CREDIT';
		  }

		  //Trasaction Details
		  $purchase_info['trasaction_info']=$this->Purchases_model->getTransactionInfo($purchase_info['tid']);
		}

		$purchase_info['payment_date']=date('Y-m-d',strtotime($purchase_info['payment_date']));
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
			
			//Branch Wallet Info
			$branch['branch_wallet']=$this->Purchases_model->getBranchWalletInfo($bparams['branch_id']);

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

		if($params['act_types']=="bank" || $params['act_types']=="cash"){
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

		/*//Company
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
		//Company end*/

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

	public function adminUpdateBranchProd(){
		$mbranch_id=$this->session->userdata('branch_id');
		$adminid=$this->session->userdata('adminid');
		$brand_id=$this->input->post("brand_id");
		$branch_id=$this->input->post("branch_id");
		$ap_id=$this->input->post("ap_id");
		$bp_id=$this->input->post("bp_id");
		$selected_prod=$this->input->post("selected_prod");
		//print_r($selected_prod);

	   $params['branch_id']=$branch_id;
	   $params['ap_id']=$ap_id;
	   $params['bp_id']=$bp_id;

	   //Branch Details Update
	   $overall_tot_price=0;
	   $update_pids=$new_pids=[];

	   for($i=0;$i<count($selected_prod);$i++){
	   	  if(!empty($selected_prod[$i]['bpd_id'])){
			$total_price=($selected_prod[$i]['qty']*$selected_prod[$i]['price']);
	   	 	$bpd_id=$selected_prod[$i]['bpd_id'];

	 		$purchase_details=[
   	 						'quantity'=>$selected_prod[$i]['qty'],
   	 						'price'=>$selected_prod[$i]['price'],
   	 						'total_price'=>$total_price
   	 					   ];
	   	 	$this->Purchases_model->updateBPDeatils($bpd_id,$purchase_details);
	   	 	$update_pids[]=$selected_prod[$i]['pid'];
	   	  }else{
	   	  	$total_price=($selected_prod[$i]['qty']*$selected_prod[$i]['price']);
  			//Add New Product
   			$purchase_details=[
   	 						'bp_id'=>$bp_id,
   	 						'branch_id'=>$params['branch_id'],
   	 						'ap_id'=>$params['ap_id'],
   	 						'product_id'=>$selected_prod[$i]['pid'],
   	 						'quantity'=>$selected_prod[$i]['qty'],
   	 						'price'=>$selected_prod[$i]['price'],
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
		$admin_upd_status=$this->updateAdminP($params);
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

   		echo json_encode($response);
	}

	//Admin Delete Branch Product
	public function adminDelBranchProd(){
		$mbranch_id=$this->session->userdata('branch_id');
		$adminid=$this->session->userdata('adminid');
		$branch_id=$this->input->post("branch_id");
		$params['brand_id']=$this->input->post("brand_id");
		$params['branch_id']=$this->input->post("branch_id");
		$params['ap_id']=$this->input->post("ap_id");
		$params['bp_id']=$this->input->post("bp_id");
		$params['pid']=$this->input->post("pid");
		$params['bpd_id']=$this->input->post("bpd_id");
		$response=$update_pids=[];

		$all_prod_removed=false;
		if(!empty($params['bpd_id'])){
			//Branch
			$bprod=$this->Purchases_model->getBranchProductDetails($params);

			//Admin
			$aprod=$this->Purchases_model->getAPDProduct($params['pid'],$params['ap_id']);
			$new_branch_ids=[];
			$branch_ids=explode(",",$aprod['branch_ids']);

			if(count($branch_ids)>1){
				$response['status']='if';
				//Reset amount
				$branchpinfo=$this->Purchases_model->branchPurchaseInfo($params);
				$remaing_bal=$branchpinfo['total_price']-$bprod['total_price'];
				$purchase=['total_price'=>$remaing_bal];
				$this->Purchases_model->updateBP($params['bp_id'],$purchase);
				//Delete
				$this->Purchases_model->delProduct($params['bpd_id']);
				for($i=0;$i<count($branch_ids);$i++){
					if($branch_id!=$branch_ids[$i]){
						$new_branch_ids[]=$branch_ids[$i];
					}
				}

				$new_branchids_str=implode(",",$new_branch_ids);

				$chek_branch_r=$this->Purchases_model->checkBranch($params['pid'],$params['branch_id']);
				//Update APD Details
				$adp_quantity=($chek_branch_r['quantity']-$bprod['quantity']);
				$adp_total_price=($chek_branch_r['total_price']-$bprod['total_price']);

				$adp_details=['branch_ids'=>trim($new_branchids_str,","),'quantity'=>$adp_quantity,'total_price'=>$adp_total_price];
   				$status=$this->Purchases_model->updateAPDeatils($chek_branch_r['apd_id'],$adp_details);
			}else{
				//Delete Product from admin product details
				//Delete
				$this->Purchases_model->delProduct($params['bpd_id']);
				$this->Purchases_model->delProductFromAPD($params);

				$response['status']='else';
			}

			$branch_prod_cnt=$this->Purchases_model->getBranchProductDetailsCnt($params['bp_id']);
			if($branch_prod_cnt==0){
				$apdetails=$this->Purchases_model->purchaseInfo($params);
				$ap_branch_ids=explode(",",$apdetails['branch_ids']);
				$ap_bp_ids=explode(",",$apdetails['bp_ids']);

				$new_ap_branch_ids=$new_ap_bp_ids=[];
				for($j=0;$j<count($ap_branch_ids);$j++){
					if($branch_id!=$ap_branch_ids[$j]){
						$new_ap_branch_ids[]=$ap_branch_ids[$j];
					}
				}

				for($k=0;$k<count($ap_bp_ids);$k++){
					if($params['bp_id']!=$ap_bp_ids[$k]){
						$new_ap_bp_ids[]=$ap_branch_ids[$k];
					}
				}

				//Update Admin Purchase
				$upd_admin_purchase=['branch_ids'=>implode(",",$new_ap_branch_ids),'bp_ids'=>implode(",",$new_ap_bp_ids)];
				$this->Purchases_model->updateAdminPurchase($params['ap_id'],$upd_admin_purchase);

				//branch_ids,bp_ids
				$all_prod_removed=$this->Purchases_model->delBranchPID($params['bp_id']);
			}

			//Check Admin Purchase
			$all_prod=$this->Purchases_model->getAdminPD($params['ap_id']);
			if(count($all_prod)>0){
				$admin_upd_status=$this->updateAdminP($params);
			}else{
				//Del Admin Purchase
				$this->Purchases_model->delAP($params['ap_id']);
			}

			$response['branch_reset']=true;
		}else{
			$response['branch_reset']=false;
		}

	    $response['all_prod_removed']=$all_prod_removed;
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
