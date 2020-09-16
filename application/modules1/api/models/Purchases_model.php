<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
	 * Author:Basha
*/
error_reporting(0);
//ini_set('memory_limit', '100M');

class Purchases_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	//Branch Details
	public function getBranchDetails($branch_id){
		$this->db->select('branch_id,branch_name,location,person_name,mobile_no,email,parent,amount');
		$this->db->from('branch');
		$this->db->where('branch_id',$branch_id);
		return $this->db->get()->row_array();
	}

	//Brands
	public function getBrands(){
		$this->db->select('brand_id,brand_name,contact_person,contact_mobile,contact_email,contact_loc,turnover_disc,brand_cat,brand_subcat,medicine_type,status');
		$this->db->from('brands');
		$this->db->where(['status'=>1]);
		return $this->db->get()->result_array();
	}

	//Top Products
	public function getTopProducst($bid){
		//Here need to get top saled products
		$this->db->select('pid,pname,cat_id,subcat_id,brand_id,pmrp,purchase_amt,qty,status');
		$this->db->from('products');
		$this->db->where(['brand_id'=>$bid,'status'=>1]);
		$this->db->limit(5,0);
		return $this->db->get()->result_array();
	}

	//Search Products
	public function searchProduct($keyword,$bid,$pids){
		$this->db->select('pid as id,pid,pname,cat_id,subcat_id,brand_id,pmrp,purchase_amt,qty,status');
		$this->db->from('products');
		$this->db->like('pname',$keyword);
		$this->db->where(['brand_id'=>$bid,'status'=>1]);
		$this->db->where_not_in('pid',$pids);
		return $this->db->get()->result_array();
	}

	//Check Brand
	public function checkBrand($bid){
		//company_id
		$this->db->select('ap_id,company_id,status');
		$this->db->from('admin_purchase');
		$this->db->where(['company_id'=>$bid,'status'=>'P']);
		return $this->db->get()->row_array();
	}

	//Draft Admin Purchase
	public function addAdminPurchase($params){
		$this->db->insert('admin_purchase',$params);
        return $this->db->insert_id();
	}

	//Draft Admin Purchase Details
	public function addAdminPurchaseDetails($params){
		$this->db->insert_batch('admin_purchase_details',$params);
	}

	public function updateAdminPurchase($ap_id,$params)
    {
        $this->db->where('ap_id',$ap_id);
        return $this->db->update('admin_purchase',$params);
    }

    //Draft Branch Purchase
	public function addBranchPurchase($params){
		$this->db->insert('branch_purchase',$params);
        return $this->db->insert_id();
	}

	//Draft Branch Purchase Details
	public function addBranchPurchaseDetails($params){
		$this->db->insert_batch('branch_purchase_details',$params);
	}

	//Purchase
	public function getPurchase($limit,$start,$params){
		$this->db->select('bp.bp_id as id,bp.uid,bp.branch_id,bp.company_id,bp.total_price,bp.created_on,bp.unloading_charges,bp.transport_charges,bp.upload_invoice,b.brand_name,bp.status');
		$this->db->from('branch_purchase as bp');
		$this->db->join('brands as b', 'bp.company_id = b.brand_id');
		if(!empty($params['searchValue'])){
			$this->db->like(['b.brand_name'=>$params['searchValue']]);
		}

		/*if(!empty($params['searchByUtype'])){
			$this->db->where(['user_type'=>$params['searchByUtype'],'partnership'=>$params['partnership']]);
		}*/

		//$this->db->where(['bp.status'=>'P']);
		$this->db->where(['bp.branch_id'=>$params['branch_id']]);
		$this->db->where_in('bp.status',$params['status']);
		$this->db->limit($limit,$start);
		$query=$this->db->get();
		// $str = $this->db->last_query();
		// print_r($str);
		$data=[];
		if($query->num_rows()>0)
        {
        	$data=$query->result_array();
        }

        return $data;
	}

	//Purchase Count
	public function getPurchaseCount($params){
		$this->db->select('bp.bp_id');
		$this->db->from('branch_purchase as bp');
		$this->db->join('brands as b','bp.company_id=b.brand_id');
		if(!empty($params['searchValue'])){
			$this->db->like(['b.brand_name'=>$params['searchValue']]);
		}

		/*if(!empty($params['searchByUtype'])){
			$this->db->where(['user_type'=>$params['searchByUtype'],'partnership'=>$params['partnership']]);
		}*/

		$this->db->where(['bp.branch_id'=>$params['branch_id']]);
		$this->db->where_in('bp.status',$params['status']);
		$query=$this->db->get();
        return ($query->num_rows()>0)?$query->num_rows():0;
	}

	//Branch Purchase Info
	public function getBranchPurchaseInfo($params){
		$this->db->select('*');
		$this->db->from('branch_purchase');
		$this->db->where(['company_id'=>$params['brand_id'],'bp_id'=>$params['bp_id']]);
		return $this->db->get()->row_array();
	}

	//Branch Product Info
	public function getBranchProductDetails($params){
		$this->db->select('*');
		$this->db->from('branch_purchase_details');
		$this->db->where(['branch_id'=>$params['branch_id'],'ap_id'=>$params['ap_id'],'product_id'=>$params['pid']]);
		return $this->db->get()->row_array();
	}

	//Branch Purchase Details
	public function getBranchPurchaseDetails($params){
		$this->db->select('bpd.bpd_id,bpd.bp_id,bpd.product_id as pid,bpd.quantity,bpd.price,bpd.total_price,p.pname,p.purchase_amt,p.percentage');
		$this->db->from('branch_purchase_details as bpd');
		$this->db->join('products as p', 'bpd.product_id=p.pid');
		$this->db->where(['bpd.bp_id'=>$params['bp_id']]);
		return $this->db->get()->result_array();
	}

	//Update Branch Purchase Details
	public function updateBPDeatils($bpd_id,$purchase_details){
		$this->db->where('bpd_id',$bpd_id);
        $this->db->update('branch_purchase_details',$purchase_details);
  		// $str = $this->db->last_query();
		// print_r($str);
	    $report = array();
		$report['error'] =$this->db->error();
		if($report!= 0){
			return true;
		}else{
			return false;
		}
	}

	//Update Branch Purchase
	public function updateBP($bp_id,$purchase){
		$this->db->where('bp_id',$bp_id);
        $this->db->update('branch_purchase',$purchase);
	    $report = array();
		$report['error'] =$this->db->error();
		if($report!= 0){
			return true;
		}else{
			return false;
		}
	}

	//Add Purchase Details
	public function addBranchPD($pd){
		$this->db->insert('branch_purchase_details',$pd);
        return $this->db->insert_id();
	}

	//Admin Purchase Details
	public function getAdminPurchaseDetails($ap_id,$pids){
		$this->db->select('*');
		$this->db->from('admin_purchase_details');
		$this->db->where(['ap_id'=>$ap_id]);
		$this->db->where_in('product_id',$pids);
		return $this->db->get()->result_array();
	}

	//Branch single product purchase details
	public function getBPDetails($params){
		$this->db->select('bpd.bpd_id,bpd.bp_id,bpd.product_id as pid,bpd.quantity,bpd.price,bpd.total_price');
		$this->db->from('branch_purchase_details as bpd');
		$this->db->where(['bpd.branch_id'=>$params['branch_id'],'bpd.ap_id'=>$params['ap_id'],'bpd.product_id'=>$params['product_id']]);
		return $this->db->get()->row_array();
	}

	//Update Admin Pruchase Details
	public function updateAPDeatils($apd_id,$purchase_details){
		$this->db->where('apd_id',$apd_id);
        $this->db->update('admin_purchase_details',$purchase_details);
	    $report = array();
		$report['error'] =$this->db->error();
		if($report!= 0){
			return true;
		}else{
			return false;
		}
	}

	//Check Product In APD
	public function checkProductInAPD($params)
	{
		$this->db->select('*');
		$this->db->from('admin_purchase_details');
		$this->db->where(['ap_id'=>$params['ap_id'],'product_id'=>$params['product_id']]);
		return $this->db->get()->row_array();
	}

	//Admin Purchase Details
	public function getAdminPD($ap_id){
		$this->db->select('*');
		$this->db->from('admin_purchase_details');
		$this->db->where(['ap_id'=>$ap_id]);
		return $this->db->get()->result_array();
	}

	//Update Admin Purchase
	public function updateAP($ap_id,$apd_update){
		$this->db->where('ap_id',$ap_id);
        $this->db->update('admin_purchase',$apd_update);
	    $report = array();
		$report['error']=$this->db->error();
		if($report!= 0){
			return true;
		}else{
			return false;
		}
	}

	//Check Branch
	public function checkBranch($pid,$branch_id){
		$result=$this->db->query("select * from admin_purchase_details WHERE product_id=".$pid." AND find_in_set(".$branch_id.",branch_ids)");
		return $result->row_array();
	}

	//Get Admin Purchase Details
	public function getAPDProduct($pid,$ap_id){
		$this->db->select('*');
		$this->db->from('admin_purchase_details');
		$this->db->where(['ap_id'=>$ap_id,'product_id'=>$pid]);
		return $this->db->get()->row_array();
	}

	//Branch Summary
	public function bpSummary($params){
		$this->db->select("SUM(IF(status='P',1,0)) as pending,SUM(IF(status='C',1,0)) as approved,SUM(IF(status='PM',1,0)) as paid,SUM(IF(status='BC',1,0)) as branch_confirm,SUM(IF(status='CE',1,0)) as completed,round(SUM(total_price),0) as total_purchase");
		$this->db->from('branch_purchase');
		$this->db->where(['branch_id'=>$params['branch_id']]);
		return $this->db->get()->row_array();
	}

	//Admin Summary
	public function apSummary($params){
		$this->db->select("SUM(IF(status='P',1,0)) as pending,SUM(IF(status='C',1,0)) as approved,SUM(IF(status='PM',1,0)) as paid,SUM(IF(status='BC',1,0)) as admin_confirm,SUM(IF(status='CE',1,0)) as completed,round(SUM(total_price),0) as total_purchase");
		$this->db->from('admin_purchase');
		//$this->db->where(['ap_id'=>$params['ap_id']]);
		return $this->db->get()->row_array();
	}

	//Check Product in inventory
	public function checkBranchProduct($pid,$branch_id){
		$this->db->select('bin_id,qty');
		$this->db->from('branch_inventory');
		$this->db->where(['branch_id'=>$branch_id,'pid'=>$pid]);
		return $this->db->get()->row_array();
	}


	//Add product in inventory
	public function addProductInInventory($params){
		$this->db->insert('branch_inventory',$params);
    	return $this->db->insert_id();
	}

	//Add wallet
	public function addInWallet($params){
		$this->db->insert('wallets',$params);
    	return $this->db->insert_id();
	}

	//Update Branch Amount
	public function updateBranchAmount($branch_id,$params){
		$this->db->where(['branch_id'=>$branch_id]);
    	$this->db->update('branch',$params);
	  	$report = array();
		$report['error'] =$this->db->error();
		if($report!= 0){
			return true;
		}else{
			return false;
		}
	}

	//Update Product
	public function updateProductInInventory($upd_prod,$where_cond){
		$this->db->where($where_cond);
    	$this->db->update('branch_inventory',$upd_prod);
	  	$report = array();
		$report['error'] =$this->db->error();
		if($report!= 0){
			return true;
		}else{
			return false;
		}
	}

	//All Branch Confirmation
	public function checkAllBConfirmation($ap_id,$branch_ids){
		$this->db->select('*');
		$this->db->from('branch_purchase');
		$this->db->where(['ap_id'=>$ap_id,'status'=>'CE']);
		$this->db->where_in('branch_id',$branch_ids);
		return $this->db->get()->result_array();
	}

	//Admin Start
	//Admin Purchase
	public function getAdminPurchase($limit,$start,$params){
		$this->db->select('ap.ap_id as id,ap.orderid,ap.company_id,ap.total_price,ap.quantity,ap.branch_ids,ap.bp_ids,ap.payment_type,ap.payment_date,ap.bank_id,ap.company_bankid,ap.tid,ap.note,ap.created_on,b.brand_name,ap.status');
		$this->db->from('admin_purchase as ap');
		$this->db->join('brands as b', 'ap.company_id = b.brand_id');
		if(!empty($params['searchValue'])){
			$this->db->like(['b.brand_name'=>$params['searchValue']]);
		}

		/*if(!empty($params['searchByUtype'])){
			$this->db->where(['user_type'=>$params['searchByUtype'],'partnership'=>$params['partnership']]);
		}*/

		//$this->db->where(['bp.status'=>'P']);
		$this->db->where_in('ap.status',$params['status']);
		$this->db->limit($limit,$start);
		$query=$this->db->get();
		// $str = $this->db->last_query();
		// print_r($str);
		$data=[];
		if($query->num_rows()>0)
        {
        	$data=$query->result_array();
        }

        return $data;
	}

	//Admin Purchase Count
	public function getAdminPurchaseCount($params){
		$this->db->select('ap.ap_id');
		$this->db->from('admin_purchase as ap');
		$this->db->join('brands as b','ap.company_id=b.brand_id');
		if(!empty($params['searchValue'])){
			$this->db->like(['b.brand_name'=>$params['searchValue']]);
		}

		/*if(!empty($params['searchByUtype'])){
			$this->db->where(['user_type'=>$params['searchByUtype'],'partnership'=>$params['partnership']]);
		}*/
		$this->db->where_in('ap.status',$params['status']);
		$query=$this->db->get();
        return ($query->num_rows()>0)?$query->num_rows():0;
	}

	//Brand Info
	public function brandInfo($params){
		$this->db->select('brand_id,brand_name,contact_person,contact_mobile,contact_email,contact_loc,turnover_disc,brand_cat,brand_subcat,medicine_type,status');
		$this->db->from('brands');
		$this->db->where(['brand_id'=>$params['brand_id']]);
		return $this->db->get()->row_array();
	}

	//Admin Purchase Info
	public function purchaseInfo($params){
		$this->db->select('*');
		$this->db->from('admin_purchase');
		$this->db->where(['ap_id'=>$params['ap_id']]);
		return $this->db->get()->row_array();
	}

	//Admin Product List
	public function getAdminPDList($ap_id){
		$this->db->select('apd.*,p.pname');
		$this->db->from('admin_purchase_details as apd');
		$this->db->join('products as p', 'apd.product_id=p.pid');
		$this->db->where(['ap_id'=>$ap_id]);
		return $this->db->get()->result_array();
	}

	//Branch Purchase Details based on admin purchase id
	public function getBranchProducts($params){
		$this->db->select('bpd.bpd_id,bpd.bp_id,bpd.product_id as pid,bpd.quantity,bpd.price,bpd.total_price,bpd.ap_id,p.pname');
		$this->db->from('branch_purchase_details as bpd');
		$this->db->join('products as p', 'bpd.product_id=p.pid');
		$this->db->where(['bpd.branch_id'=>$params['branch_id'],'bpd.ap_id'=>$params['ap_id']]);
		return $this->db->get()->result_array();
	}

	public function getProducts($bid,$pids){
		//Here need to get top saled products
		$this->db->select('pid,pname,cat_id,subcat_id,brand_id,pmrp,purchase_amt,qty,status');
		$this->db->from('products');
		$this->db->where(['brand_id'=>$bid,'status'=>1]);
		$this->db->where_not_in('pid',$pids);
		return $this->db->get()->result_array();
	}

	//Branch Purchase Confirm
	public function updateBPConfirm($ap_id,$bid,$purchase){
		$this->db->where(['ap_id'=>$ap_id,'branch_id'=>$bid]);
        $this->db->update('branch_purchase',$purchase);
	    $report = array();
		$report['error'] =$this->db->error();
		if($report!= 0){
			return true;
		}else{
			return false;
		}
	}

	//Acounts
	public function getAdminAcc(){
		$this->db->select('bank_id,bank_name,account_no,bank_ifsc,avail_amount');
		$this->db->from('ac_banks');
		return $this->db->get()->result_array();
	}

	//Branch Accounts
	public function getBranchAcc($params){
		$this->db->select('acc_id,brand_id,full_name,account_no,bank_name,ifsc,branch_name');
		$this->db->from('brand_bank_accounts');
		$this->db->where(['brand_id'=>$params['brand_id'],'status'=>1]);
		return $this->db->get()->result_array();
	}

	public function branchPurchaseInfo($params){
		$this->db->select('*');
		$this->db->from('branch_purchase');
		$this->db->where(['branch_id'=>$params['branch_id'],'ap_id'=>$params['ap_id']]);
		return $this->db->get()->row_array();
	}

	//transactions
	public function doPurchaseTransaction($params){
		$this->db->insert('transactions',$params);
    return $this->db->insert_id();
	}

	//Branch Purchase Confirm
	public function updateAdminPayment($ap_id,$params){
		$this->db->where(['ap_id'=>$ap_id]);
    $this->db->update('branch_purchase',$params);
	  $report = array();
		$report['error'] =$this->db->error();
		if($report!= 0){
			return true;
		}else{
			return false;
		}
	}
	//Admin End

}//Main function ends here
?>
