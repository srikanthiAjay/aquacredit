<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
	 * Author:Ramakrishna
*/
error_reporting(1);
//ini_set('memory_limit', '100M');

class Receipts_model extends CI_Model 
{
	function __construct()
	{
		parent::__construct();
       	$this->load->library('session');
       	$this->load->database();
	}
	
	function getReceiptDetails($rc_id)
	{
		/* $this->db->select('*');
		$query = $this->db->get_where("receipts", ['rc_id' => $rc_id])->row_array(); */
		$this->db->select('receipts.*,users.user_name,users.user_code,users.mobile,users.user_type,users.typeofuser,user_crop_details.cd_id,user_crop_details.crop_location,ac_banks.bank_name,ac_banks.account_no,traders.td_id,traders.trader_type,traders.contact_person,traders.full_name');
		$this->db->join('ac_banks', 'ac_banks.bank_id = receipts.admin_bank_id','left');
		$this->db->join('users', 'users.user_id = receipts.from_user_id','left');
		$this->db->join('user_crop_details', 'user_crop_details.cd_id = receipts.from_crop_id','left');
		$this->db->join('traders', 'traders.td_id = receipts.from_user_id','left');
		$query = $this->db->get_where("receipts", ['receipts.rc_id' => $rc_id])->row_array();
		return(json_encode(array('status'=>'success','data'=>$query)));
	}
	
	function receiptsAnalytics()
	{
		$response = array();
		$query = $this->db->query("SELECT SUM(IF(transfer_from_type LIKE 'user',transfer_amount,0)) as tot_user_amt,SUM(IF(transfer_from_type LIKE 'trader',transfer_amount,0)) as tot_trader_amt,SUM(IF(u.user_type LIKE 'FARMER' AND typeofuser LIKE '0',transfer_amount,0)) as farmer_sum,SUM(IF(u.user_type LIKE 'NON_FARMER' AND typeofuser LIKE '0',transfer_amount,0)) as nonfarmer_sum,SUM(IF(u.user_type LIKE 'DEALER' AND typeofuser LIKE '0',transfer_amount,0)) as dealer_sum,SUM(IF(typeofuser LIKE '1',transfer_amount,0)) as guest_sum,SUM(IF(trader_type LIKE 'Agent',transfer_amount,0)) as agent_sum,SUM(IF(trader_type LIKE 'Exporter',transfer_amount,0)) as exporter_sum FROM receipts r LEFT JOIN users u ON r.from_user_id = u.user_id LEFT JOIN traders t ON t.td_id = r.from_user_id Where r.deleted = 0");
		//echo $this->db->last_query();
        if($query->num_rows()>0)
        {
            $data = $query->row_array(); 
			$response = json_decode(json_encode($data),true);	
        }
		return $response;
	}
	
	function receipts_search($limit,$start,$tabval,$search,$reportRange,$trans,$utype_opt,$col,$dir)    
    {
		//print_r($trader);exit; 
		$response = array();
		$where = " deleted = 0";	
		if($tabval == 0){ $where .= " AND transfer_from_type LIKE 'user'";}
		else if($tabval == 1){ $where .= " AND transfer_from_type LIKE 'trader'";}
		
		if($search != ""){ $where .= " AND (rc_id LIKE '%".$search."%' OR user_name LIKE '%".$search."%' OR transfer_amount LIKE '%".$search."%' OR contact_person LIKE '%".$search."%' OR full_name LIKE '%".$search."%')"; }
		
		if($utype_opt == "farmer")
		{
			$where .= " AND users.user_type LIKE 'FARMER' ";
		}else if($utype_opt == "non_farmer")
		{
			$where .= " AND users.user_type LIKE 'NON_FARMER' ";
		}else if($utype_opt == "dealer")
		{
			$where .= " AND users.user_type LIKE 'DEALER' ";
		}else if($utype_opt == "agent")
		{
			$where .= " AND traders.trader_type LIKE 'Agent' ";
		}else if($utype_opt == "exporter")
		{
			$where .= " AND traders.trader_type LIKE 'Exporter' ";
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
				$where .= " AND CAST(receipt_date as DATE) LIKE '$from_date'";
			}else{

				$where .= " AND (CAST(receipt_date as DATE) BETWEEN '$from_date' AND '$to_date')";
			}
		}
		if($trans != "")
		{
			$where .= " AND transfer_type LIKE '$trans'";
		}
		$query = $this->db->query("SELECT *,(select count(rc_id) from receipts where $where) as tot_filter_rec,users.user_name,users.user_type,users.typeofuser,traders.contact_person,traders.full_name FROM receipts LEFT JOIN users ON users.user_id = receipts.from_user_id LEFT JOIN traders ON traders.td_id = receipts.from_user_id where $where Order by rc_id desc,receipt_date desc limit $start,$limit");
		//echo $this->db->last_query();exit;
        if($query->num_rows()>0)
        {
            $data = $query->result(); 
			$response = json_decode(json_encode($data),true);
			
        }
		return $response;
		
    }
	
	/* // Check Trader name
	function check_trader_name($tname)
	{
		$query = $this->db->get_where("traders", ['full_name' => urldecode($tname)])->row_array();
		if($query)
		{
			return json_encode(array('status'=>'exists'));
		}else{
			return json_encode(array('status'=>'notexists'));
		}	
	}	 */
	/* // Check Firm name
	function check_firm_name($fname)
	{
		$query = $this->db->get_where("traders", ['firm_name' => urldecode($fname)])->row_array();
		if($query)
		{
			return json_encode(array('status'=>'exists'));
		}else{
			return json_encode(array('status'=>'notexists'));
		}	
	} */

	// Insert Receipts
	function insert($posts)
	{
		$data = $this->db->insert('receipts',$posts);
		
		if($data)
		{
			$insert_id = $this->db->insert_id();
			return json_encode(array('status' => 'success','insert_id' => $insert_id));
		}else{
			return json_encode(array('status' => 'fail'));
		}
	}
	
	// Receipt Update	
	function updateReceipt($rc_id,$posts)
	{
		$query = $this->db->update('receipts', $posts, array('rc_id'=>$rc_id));;
		if($query)
		{
			return json_encode(array('status'=>'success'));
		}else{
			return json_encode(array('status'=>'fail'));
		}		
	}
	
	public function deleteReceipt($rc_id)
	{

		$response = $this->db->delete('receipts', array('rc_id'=>$rc_id));
		if($response)
		{
			return json_encode(array("status"=>"success"));
		}else{
			return json_encode(array("status"=>"fail"));
		}	
		
	}

}//Main function ends here
?>