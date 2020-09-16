<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
	 * Author:Ramakrishna
*/
error_reporting(1);
//ini_set('memory_limit', '100M');

class Loans_model extends CI_Model 
{
	function __construct()
	{
		parent::__construct();
       	$this->load->library('session');
       	$this->load->database();
	}
	
	function getLoansdata($lid = "")
	{		
		if(!empty($lid)){

            $data = $this->db->get_where("loan_details", ['loan_id' => $lid])->row_array();
        }else{
			
            $data = $this->db->get("loan_details")->result();

        }
		
		return json_encode(array('status'=>'success','data' => $data));
	}
	
	function getLoanDetails($lid)
	{
		//$this->db->from('loan_details');
		$this->db->select('loan_details.*,users.user_id,users.user_name,users.user_code,users.user_type,user_crop_details.crop_location,loan_activity.la_id,loan_activity.admin_bank,loan_activity.loan_type,loan_activity.start_date,loan_activity.end_date,loan_activity.rate_of_interest,loan_activity.narration,loan_activity.ref_no,accounts.id as admin_bank_id,accounts.account_name as admin_bank_name,accounts.account_number as admin_bank_number, user_bank_accounts.bank_name as user_bank,user_bank_accounts.account_no as user_acc_no, ac_loan_types.loan_type as loan_type_name');
		$this->db->join('loan_activity', 'loan_activity.loan_id = loan_details.loan_id','left');
		$this->db->join('accounts', 'accounts.id = loan_activity.admin_bank','left');		
		$this->db->join('ac_loan_types', 'ac_loan_types.loan_type_id = loan_activity.loan_type','left');
		$this->db->join('users', 'users.user_id = loan_details.user_id','left');
		$this->db->join('user_crop_details', 'user_crop_details.cd_id = loan_details.crop_id','left');
		$this->db->join('user_bank_accounts', 'user_bank_accounts.acc_id = loan_details.user_bank_id','left');		
		$query = $this->db->get_where("loan_details", ['loan_details.loan_id' => $lid])->row_array();
		//echo $this->db->last_query();exit;
		return(json_encode(array('status'=>'success','data'=>$query)));
	}
	
	function getLoanTypes($lid = "")
	{
		
		if(!empty($lid)){

            $data = $this->db->get_where("ac_loan_types", ['loan_type_id' => $lid])->row_array();
        }else{

            $data = $this->db->get("ac_loan_types")->result();

        }
		
		return json_encode(array('status'=>'success','data' => $data));
		
	}

	function getLoanTypeByLoan($lid = "")
	{
		$this->db->select('t.loan_type,l.loan_amt,c.crop_location');
		$this->db->join('ac_loan_types t','t.loan_type_id = l.loan_type');
		$this->db->join('user_crop_details c','c.cd_id = l.crop_id');
		$this->db->where("l.loan_id",$lid);
		$query = $this->db->get('loan_details l');
		return json_encode($query->row());
	} 

	function getTotalLoansOfUser($user_id = "", $crop_id = "")
	{
		$this->db->select_sum('loan_amt');
		$this->db->from('loan_details');
		if($user_id != "")
			$this->db->where("user_id",$user_id);
		if($crop_id != "")
			$this->db->where("crop_id",$crop_id);
		$this->db->where("status",'1');
		$query = $this->db->get();
		return $query->row()->loan_amt;
	}
	
	function getLoanTypesCounts($ltype)
	{
		if($ltype == "a_amt" || $ltype == "r_amt" || $ltype == "p_amt" || $ltype == "d_amt"){
			$this->db->select('ac.loan_type,sum(l.loan_amt) as counts');
		if($ltype == "a_amt"){ 				
			$this->db->where('status','1');
			$this->db->where('l.loan_type !=','0');				
		}
		else if($ltype == "r_amt")
		{				
			$this->db->where('status','2');	
			$this->db->where('l.loan_type !=','0');					
		}
		else if($ltype == "p_amt")
		{				
			$this->db->where('status','1');
			$this->db->where('settled','0');				
		}
		else if($ltype == "d_amt")
		{				
			$this->db->where('status','0');				
		}
		
		$this->db->join('ac_loan_types ac','ac.loan_type_id=l.loan_type');
		$this->db->group_by('l.loan_type'); 
		$counts = $this->db->get_where("loan_details l")->result();	
		return json_encode(array('status'=>'success','data' => $counts));
		 exit;
	}else if($ltype == "pcount" || $ltype == "acount" || $ltype == "rcount"){
		
		$this->db->select('ac_loan_types.loan_type,count(loan_details.loan_id) as counts,status');
		$this->db->group_by(array('loan_activity.loan_type','loan_details.status')); 
	}
		
		$this->db->join('loan_activity', 'ac_loan_types.loan_type_id = loan_activity.loan_type','left');
		$this->db->join('loan_details', 'loan_activity.loan_id = loan_details.loan_id','left');
		//$this->db->group_by('loan_type_id'); 
		$this->db->order_by('loan_type_id'); 
		$counts = $this->db->get_where("ac_loan_types")->result();		
		/* if($ltype == "tamt"){
			$counts = $this->db->get_where("ac_loan_types")->result();
		}else if($ltype == "pamt" || $ltype == "ramt" || $ltype == "pcount"){
			$counts = $this->db->get_where("ac_loan_types",['status' => '0'])->result();
		}else if($ltype == "acount"){
			$counts = $this->db->get_where("ac_loan_types",['status' => '1'])->result();
		}else if($ltype == "rcount"){
			$counts = $this->db->get_where("ac_loan_types",['status' => '2'])->result();
		} */
				
		//echo $this->db->last_query();
		return json_encode(array('status'=>'success','data' => $counts));
	}
	function loansAnalytics()
	{
		$response = array();
		$query = $this->db->query(	
			"SELECT *,
				(select count(loan_id) from loan_details) as tot_rec,
				(select count(loan_id) from loan_details where status = '1' and settled = '0') as pending,
				(select count(loan_id) from loan_details where status = '1') as approved,
				(select count(loan_id) from loan_details where status = '2') as rejected,
				(select count(loan_id) from loan_details where status = '0') as drafts,
				(select SUM(loan_amt) from loan_details where status = '1') as approved_amt,
				(select SUM(loan_amt) from loan_details where status = '2') as rej_amt,
				(select SUM(loan_amt) from loan_details where status = '1' and settled = '0') as pending_amt ,
				(select SUM(loan_amt) from loan_details where status = '0') as draft_amt
			FROM loan_details");
		//echo $this->db->last_query();
        if($query->num_rows()>0)
        {
            $data = $query->row_array(); 
			$response = json_decode(json_encode($data),true);	
        }
		return $response;
	}
	function loans_search($limit,$start,$tabval,$search,$month,$fromdate,$todate,$reportRange,$loan,$trans,$status,$col,$dir)    
    {
		//print_r($customdate);exit; 
		//SELECT * FROM `brands` WHERE FIND_IN_SET('6',brand_subcat) > 0
		
		if($tabval == 0){ $where = " loan_details.status = '$tabval'";}
		else if($tabval == 1){ $where = " loan_details.status <> '0'";}
		
		if($search != ""){ $where .= " AND (loan_id LIKE '%".$search."%' OR user_name LIKE '%".$search."%' OR loan_amt LIKE '%".$search."%' OR crop_location LIKE '%".$search."%')"; }
		
		if($status != ""){			
			//$str_status = implode(",",$status);$where .= " AND status IN ($str_status)";
			if(count($status) == 1){ $where .= " AND loan_details.status IN ('$status[0]')"; }
			else if(count($status)>1){
				$where .= " AND loan_details.status IN ('$status[0]','$status[1]')";
			}			
		}
		
		if($reportRange != "" && $reportRange != "Till Date")
		{
			$dateExplode = explode("-",$reportRange);
			$fromDate = str_replace("/"," ",$dateExplode[0]);		
			$toDate = str_replace("/"," ",$dateExplode[1]);

			$from_date = date('Y-m-d',strtotime($fromDate));
			$to_date = date('Y-m-d',strtotime($toDate));
			if($from_date == $to_date)
			{
				$where .= " AND CAST(loan_status_date as DATE) LIKE '$from_date'";
			}else{

				$where .= " AND (CAST(loan_status_date as DATE) BETWEEN '$from_date' AND '$to_date')";
			}
		}
			 
		
		/* if($month != "")
		{
			if($status == ""){
				$where .= " AND loan_details.status <> '2'";				
			}
			
			if($month == "m"){
				//This month
				$where .= " AND (MONTH(loan_status_date) = MONTH(CURRENT_DATE()) AND YEAR(loan_status_date) = YEAR(CURRENT_DATE())) ";
			}else if($month == "1m")
			{
				$where .= " AND (loan_status_date >= last_day(now()) + interval 1 day - interval 1 month) ";
			}else if($month == "3m")
			{
				$where .= " AND (loan_status_date >= last_day(now()) + interval 1 day - interval 3 month) ";
			}else if($month == "6m")
			{
				$where .= " AND (loan_status_date >= last_day(now()) + interval 1 day - interval 6 month) ";
			}else if($month == "1y")
			{
				$where .= " AND (loan_status_date < DATE_SUB(NOW(),INTERVAL 1 YEAR)) ";
			}else if($month == "custom")
			{
				$from_date = date('Y-m-d',strtotime($fromdate));
				$to_date = date('Y-m-d',strtotime($todate));
				//$where .= " AND loan_status_date LIKE '%".$custom_date."%'";
				$where .= " AND (CAST(loan_status_date as DATE) BETWEEN '$from_date' AND '$to_date')";
			}
		} */
		
		if($loan != "")
		{
			$where .= " AND loan_type = $loan";
		}
		if($trans != "")
		{
			$where .= " AND transfer_type LIKE '$trans'";
		}
		
		if($tabval == 0){ $orderby = "Order by loan_id desc";}else{ $orderby = "Order by loan_status_date desc";}
						
		$response = array();
		
		//$query = $this->db->query("SELECT * FROM loan_details where $where Order by $col $dir limit $start,$limit");		
		
		//$query = $this->db->query("SELECT *,(select count(loan_id) from loan_details where $where) as tot_filter_rec FROM loan_details where $where $orderby limit $start,$limit");
		
		$query = $this->db->query("SELECT loan_details.*,users.user_name,user_crop_details.crop_location,(select count(loan_id) from loan_details where $where) as tot_filter_rec FROM loan_details LEFT JOIN users ON users.user_id = loan_details.user_id LEFT JOIN user_crop_details ON user_crop_details.cd_id = loan_details.crop_id where $where $orderby limit $start,$limit");
		//echo $this->db->last_query();exit;
        if($query->num_rows()>0)
        {
            $data = $query->result(); 
			$response = json_decode(json_encode($data),true);	
        }
		return $response;
		
    }
	
	// Check Brand name
	/* function check_brand_name($bname)
	{
		$query = $this->db->get_where("brands", ['brand_name' => urldecode($bname)])->row_array();
		if($query)
		{
			return json_encode(array('status'=>'exists'));
		}else{
			return json_encode(array('status'=>'notexists'));
		}	
	}	 */
	// Insert brand
	function insert($posts)
	{
		$data = $this->db->insert('loan_details',$posts);
		
		if($data)
		{
			$insert_id = $this->db->insert_id();
			return json_encode(array('status' => 'success','insert_id' => $insert_id));
		}else{
			return json_encode(array('status' => 'fail'));
		}
	}
	
	// Brand Update	
	function updateLoan($lid,$posts)
	{
		$query = $this->db->update('loan_details', $posts, array('loan_id'=>$lid));
		if($query)
		{
			return json_encode(array('status'=>'success'));
		}else{
			return json_encode(array('status'=>'fail'));
		}		
	}

	
	/* function updateAdminBankAmount($bank_id,$dedu_amt)
	{
		$this->db->set('avail_amount', 'avail_amount - '.$dedu_amt.'',false);
		$this->db->set('updated_on', date('Y-m-d H:i:s'));
		$this->db->where('bank_id', $bank_id);
		$query = $this->db->update('ac_banks');
		//echo $this->db->last_query();exit;
		if($query)
		{
			return json_encode(array('status'=>'success'));
		}else{
			return json_encode(array('status'=>'fail'));
		}		
	} */
	function updateAdminCashAmount($branch_id,$final_amt)
	{
		$this->db->set('amount', $final_amt,false);
		$this->db->set('updated_on', date('Y-m-d H:i:s'));
		$this->db->where('branch_id', $branch_id);
		$query = $this->db->update('branch');
		//echo $this->db->last_query();exit;
		if($query)
		{
			return json_encode(array('status'=>'success'));
		}else{
			return json_encode(array('status'=>'fail'));
		}		
	}
	function insertLoanActivity($lid,$posts)
	{
		$data = $this->db->insert('loan_activity',$posts);
		
		if($data)
		{
			$insert_id = $this->db->insert_id();
			return json_encode(array('status' => 'success','insert_id' => $insert_id));
		}else{
			return json_encode(array('status' => 'fail'));
		}	
	}
	function updateLoanActivity($laid,$posts)
	{
		$data = $this->db->update('loan_activity', $posts, array('la_id'=>$laid));
		
		if($data)
		{
			return json_encode(array('status'=>'success'));
		}else{
			return json_encode(array('status'=>'fail'));
		}
	}	
	function updateActivity($loan_id,$posts)
	{
		$data = $this->db->update('loan_activity', $posts, array('loan_id'=>$loan_id));
		
		if($data)
		{
			return json_encode(array('status'=>'success'));
		}else{
			return json_encode(array('status'=>'fail'));
		}
	}	
	public function deleteLoan($lid)
	{

		$response = $this->db->delete('loan_details', array('loan_id'=>$lid));
		if($response)
		{
			$res = $this->db->delete('loan_activity', array('loan_id'=>$lid));
			return json_encode(array("status"=>"success"));
		}else{
			return json_encode(array("status"=>"fail"));
		}	
		
	}
	

}//Main function ends here
?>