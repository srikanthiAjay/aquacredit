<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
	 * Author:Ramakrishna
*/
error_reporting(0);
//ini_set('memory_limit', '100M');

class Users_model extends CI_Model 
{
	function __construct()
	{
		parent::__construct();
	}

	function getUsersdata($uid = "")
	{
		
		if(!empty($bid)){

            $data = $this->db->get_where("users", ['id' => $uid])->row_array();
        }else{

            $data = $this->db->get("users")->result();

        }
		
		return json_encode(array('status'=>'success','data' => $data));
		
	}

	function posts_search($limit,$start,$search,$utype,$col,$dir)    
    {		
		$response = array();
        $query = $this->db
                ->like('utype',$utype)
                //->or_like('utype',$search)                
                /* ->limit($limit,$start)
                ->order_by($col,$dir) */
                ->get('users');        
		//echo $this->db->last_query();exit;
        if($query->num_rows()>0)
        {
            $data = $query->result(); 
			$response = json_decode(json_encode($data),true);
			/* $response = $this->response($data, REST_Controller::HTTP_OK);
			return $response . PHP_EOL; */
        }
         return $response;
    }
	
	// Insert Product
	function insert($posts)
	{
		$data = $this->db->insert('users',$posts);
		
		if($data)
		{
			$insert_id = $this->db->insert_id();
			return json_encode(array('status' => 'success','insert_id' => $insert_id));
		}else{
			return json_encode(array('status' => 'fail'));
		}
	}

	// Product Update
	function updateUser($id,$posts)
	{
		$query = $this->db->update('users', $posts, array('id'=>$id));;
		if($query)
		{
			return json_encode(array('status'=>'success'));
		}else{
			return json_encode(array('status'=>'fail'));
		}		
	}
	
	public function deleteUser($id)
	{
		$response = $this->db->delete('users', array('id'=>$id));
		if($response)
		{
			return json_encode(array("status"=>"success"));
		}else{
			return json_encode(array("status"=>"fail"));
		}
	}

	//Users
	public function getUsers($limit,$start,$params){
		$this->db->select('user_id,firm_name,user_name,owner_name,mobile,user_code,user_type,partnership');
		$this->db->from('users');
		if(!empty($params['searchValue'])){
			$this->db->or_like(['firm_name'=>$params['searchValue'],'user_name'=>$params['searchValue'],'owner_name'=>$params['searchValue'],'mobile'=>$params['searchValue']]);
		}

		if(!empty($params['searchByUtype'])){
			$this->db->where(['user_type'=>$params['searchByUtype'],'partnership'=>$params['partnership']]);
		}

		$this->db->where(['status'=>1]);
		$this->db->limit($limit,$start);
		$query=$this->db->get();
		//$str = $this->db->last_query();
		//print_r($str);
		$data=[];
		if($query->num_rows()>0)
        {
        	$data=$query->result_array();
        }

        return $data;
	}

	//User Count
	public function getUserCount($params){
		$this->db->select('user_id,firm_name,user_name,owner_name,mobile,user_code,user_type,partnership');
		$this->db->from('users');
		if(!empty($params['searchValue'])){
			$this->db->like(['firm_name'=>$params['searchValue'],'user_name'=>$params['searchValue'],'owner_name'=>$params['searchValue'],'mobile'=>$params['searchValue']]);
		}

		if(!empty($params['searchByUtype'])){
			$this->db->where(['user_type'=>$params['searchByUtype'],'partnership'=>$params['partnership']]);
		}

		$this->db->where(['status'=>1]);
		$query=$this->db->get();
        return ($query->num_rows()>0)?$query->num_rows():0;
	}

	//Users Summary
	public function getUserSummary(){
		$this->db->select("SUM(IF(user_type='DEALER',1,0)) as delears,SUM(IF(user_type='NON_FARMER',1,0)) as nonfarmers,SUM(IF(user_type='FARMER' AND partnership=0,1,0)) as farmers,SUM(IF(user_type='FARMER' AND partnership=1,1,0)) as farmerswithpartnership,COUNT(user_id) as total_users");
		$this->db->from('users');
		return $this->db->get()->row_array();
	}
	
	//User and Info
	public function getUser($user_id){
		$this->db->select('*');
		$this->db->from('users as u');
		$this->db->join('user_additional_info as info', 'u.user_id = info.user_id');
		$this->db->where('u.user_id',$user_id);
		return $this->db->get()->row_array();

	}
	//Add User
	public function addUser($params){
		$this->db->insert('users',$params);
        return $this->db->insert_id();
	}

	//Add User Info
	public function addUserInfo($params){
		$this->db->insert('user_additional_info',$params);
        return $this->db->insert_id();
	}

	//Add User Contacts
	public function addAlerts($params){
		$this->db->insert_batch('user_additional_contacts',$params);
	}

	//Add Partner Details
	public function addPartnerDetails($params){
		$this->db->insert_batch('user_partner_details',$params);
	}

	//Add Bank Details
	public function addBankDetails($params){
		$this->db->insert_batch('user_bank_accounts',$params);
	}

	//Add Crop Details
	public function addCropDetails($params){
		$this->db->insert_batch('user_crop_details',$params);
	}

	//Upload Documents
	public function uploadDoc($params){
		$this->db->insert_batch('user_uploaded_documents',$params);
	}

	//Update user code
	public function updateUserCode($user_id,$params)
    {
        $this->db->where('user_id',$user_id);
        return $this->db->update('users',$params);
    }

    //Check mobile exist or not
    public function checkMobile($mobile){
    	$data=$this->db->get_where("users", ['mobile'=>$mobile])->row_array();
    	//print_r($data);
    	return (!empty($data['user_id']))?1:0;
    }

    //Check mobile exist or not
    public function updatemobile($mobile,$user_id){
    	$data=$this->db->get_where("users",['mobile'=>$mobile,'user_id<>'=>$user_id])->row_array();
    	//print_r($data);
    	return (!empty($data['user_id']))?1:0;
    }

    //Default Medicine brands
    public function getDefaultMedicineBrands($med){
    	$this->db->select('brand_id,medicine_type');
		$this->db->from('brands');
		$this->db->where_in('medicine_type',$med);
		return $this->db->get()->result_array();
    }

    //Brands
    public function getBrands(){
    	$this->db->select('brand_id,brand_name,medicine_type,status');
		$this->db->from('brands');
		$this->db->where('status',1);
		return $this->db->get()->result_array();
    }

    //Get User Bank Accounts
    public function getUserBankAcc($user_id){
    	$this->db->select('acc_id,full_name,account_no,bank_name,ifsc,branch_name');
		$this->db->from('user_bank_accounts');
		$this->db->where('user_id',$user_id);
		return $this->db->get()->result_array();
    }

    //Get User Crops
    public function getUserCrops($user_id){
    	$this->db->select('cd_id,crop_location,crop_type,no_of_acres');
		$this->db->from('user_crop_details');
		$this->db->where('user_id',$user_id);
		return $this->db->get()->result_array();
    }
    
    //Get User partner
    public function getUserParteners($user_id){
    	$this->db->select('pd_id,partner_name,aadhar_no,mobile_no');
		$this->db->from('user_partner_details');
		$this->db->where('user_id',$user_id);
		return $this->db->get()->result_array();

    }

    //User Contacts
    public function getUserAlerts($user_id){
    	$this->db->select('uc_id,contact_type,contact');
		$this->db->from('user_additional_contacts');
		$this->db->where('user_id',$user_id);
		return $this->db->get()->result_array();
    }
    
    //User Uploads
    public function getUserUploads($user_id){
    	$this->db->select('*');
		$this->db->from('user_uploaded_documents');
		$this->db->where('user_id',$user_id);
		return $this->db->get()->result_array();
    }

    //Update User
	public function updateUserDetails($user_id,$params)
    {
        $this->db->where('user_id',$user_id);
        $this->db->update('users',$params);
	    $report = array();
		$report['error'] =$this->db->error();
		if($report!= 0){
			return true;
		}else{
			return false;
		}
    }

    //Update Additional Information
    public function updateUserAdditionalInfo($user_id,$params)
    {
        $this->db->where('user_id',$user_id);
        $this->db->update('user_additional_info',$params);
	    $report = array();
		$report['error'] =$this->db->error();
		if($report!= 0){
			return true;
		}else{
			return false;
		}
    }

    //Update Bank Details
    public function updateBankDetails($acc_id,$params){
    	$this->db->where('acc_id',$acc_id);
        $this->db->update('user_bank_accounts',$params);
	    $report = array();
		$report['error'] =$this->db->error();
		if($report!= 0){
			return true;
		}else{
			return false;
		}
    }

    //Update Crop Details
    public function updateCropDetails($cd_id,$params){
    	$this->db->where('cd_id',$cd_id);
        $this->db->update('user_crop_details',$params);
	    $report = array();
		$report['error'] =$this->db->error();
		if($report!= 0){
			return true;
		}else{
			return false;
		}
    }

    //Update Partner Details
    public function updatePartnerDetails($pd_id,$params){
    	$this->db->where('pd_id',$pd_id);
        $this->db->update('user_partner_details',$params);
	    $report = array();
		$report['error'] =$this->db->error();
		if($report!= 0){
			return true;
		}else{
			return false;
		}
    }

	public function delBankAcc($acc_id){
		$this->db->where('acc_id', $acc_id);
		$this->db->delete('user_bank_accounts');
		$report = array();
		$report['error'] = $this->db->error();
		if($report!= 0){
			return true;
		}else{
			return false;
		}
	}

	public function delCrop($cd_id){
		$this->db->where('cd_id', $cd_id);
		$this->db->delete('user_crop_details');
		$report = array();
		$report['error'] = $this->db->error();
		if($report!= 0){
			return true;
		}else{
			return false;
		}
	}

	public function delPartner($pd_id){
		$this->db->where('pd_id', $pd_id);
		$this->db->delete('user_partner_details');
		$report = array();
		$report['error'] = $this->db->error();
		if($report!= 0){
			return true;
		}else{
			return false;
		}
	}

	public function delAlert($uc_id){
		$this->db->where('uc_id', $uc_id);
		$this->db->delete('user_additional_contacts');
		$report = array();
		$report['error'] = $this->db->error();
		if($report!= 0){
			return true;
		}else{
			return false;
		}
	}

	public function delDocument($doc_id){
		$this->db->where('doc_id', $doc_id);
		$this->db->delete('user_uploaded_documents');
		$report = array();
		$report['error'] = $this->db->error();
		if($report!= 0){
			return true;
		}else{
			return false;
		}
	}

}//Main function ends here
?>