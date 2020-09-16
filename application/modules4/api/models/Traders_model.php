<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
	 * Author:Ramakrishna
*/
error_reporting(1);
//ini_set('memory_limit', '100M');

class Traders_model extends CI_Model 
{
	function __construct()
	{
		parent::__construct();
       	$this->load->library('session');
       	$this->load->database();
	}
	
	function getTraderDetails($tdid,$columns = null)
	{
		if(isset($columns))
		{
			$this->db->select($columns);
		}
		else
		{
			$this->db->select('*');
		}
		
		$query = $this->db->get_where("traders", ['td_id' => $tdid])->row_array();		
		return(json_encode(array('status'=>'success','data'=>$query)));
	}

	function getAnalytics($trader_id)
	{
		$this->db->select('(SUM(d.company_amount) - SUM(d.farmer_amount)) as profit, SUM(d.company_weight) as weight');
		$this->db->join('trade_actual_details d', 'd.trade_id = t.id');
		$this->db->where('t.status', '1');
		$this->db->where('t.trader_id', $trader_id);
		$result = $this->db->get('trade t')->row();
		//$result = $query->profit;
		return $result;

	}

	function getHighSoldCounts($trader_id)
	{
		$this->db->select('d.count, COUNT(d.count) as c');
		$this->db->join('trade t', 't.id = d.trade_id');
		$this->db->where('t.status', '1');
		$this->db->where('t.trader_id', $trader_id);
		$this->db->group_by('d.count');
		$this->db->order_by('c', 'desc');
		$this->db->limit(3);
		$result = $this->db->get('trade_actual_details  d')->result();
		return $result;
	}
	
	function traders_search($limit,$start,$search,$month,$trader,$col,$dir,$reportRange)    
    {
		//print_r($trader);exit; 
		$agent_count = $exporter_count = 0;
		
		$where = " status = 1";							
		$response = array();
		/* if($month != "")
		{
			if($month == "m"){
				$where .= " AND (MONTH(created_on) = MONTH(CURRENT_DATE()) AND YEAR(created_on) = YEAR(CURRENT_DATE())) ";
			}else if($month == "1m")
			{
				$where .= " AND (created_on >= last_day(now()) + interval 1 day - interval 1 month) ";
			}else if($month == "3m")
			{
				$where .= " AND (created_on >= last_day(now()) + interval 1 day - interval 3 month) ";
			}else if($month == "6m")
			{
				$where .= " AND (created_on >= last_day(now()) + interval 1 day - interval 6 month) ";
			}else if($month == "1y")
			{
				$where .= " AND (created_on < DATE_SUB(NOW(),INTERVAL 1 YEAR)) ";
			}
		} */

		if(!empty($search))
		{
			$where1 = " AND (firm_name like '%$search%' OR contact_person like '%$search%' OR full_name like '%$search%' OR mobile_no like '$search%') ";
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
				$where .= " AND CAST(created_on as DATE) LIKE '$from_date'";
			}else{

				$where .= " AND (CAST(created_on as DATE) BETWEEN '$from_date' AND '$to_date')";
			}
		}
		
		if(count($trader) == 1){ $where .= " AND trader_type IN ('$trader[0]')"; }
		else if(count($trader)>1){ $where .= " AND trader_type IN ('$trader[0]','$trader[1]')";	}
		
		$query = $this->db->query("SELECT *,(SELECT count(*) FROM traders) as tot_rec,(SELECT count(*) FROM traders where $where) as tot_filter_rec,(SELECT count(td_id) FROM `traders` WHERE $where AND trader_type LIKE 'Agent') as agent_count,(SELECT count(td_id) FROM `traders` WHERE $where AND trader_type LIKE 'Exporter') as exporter_count FROM traders where $where $where1 Order by created_on desc limit $start,$limit");
		//echo $this->db->last_query();exit;
        if($query->num_rows()>0)
        {
            $data = $query->result(); 
			$response = json_decode(json_encode($data),true);			
        }
		return $response;
		
    }
	
	// Check Trader name
	function check_trader_name($tname)
	{
		$query = $this->db->get_where("traders", ['full_name' => urldecode($tname)])->row_array();
		if($query)
		{
			return json_encode(array('status'=>'exists'));
		}else{
			return json_encode(array('status'=>'notexists'));
		}	
	}	
	// Check Firm name
	function check_firm_name($fname)
	{
		$query = $this->db->get_where("traders", ['firm_name' => urldecode($fname)])->row_array();
		if($query)
		{
			return json_encode(array('status'=>'exists'));
		}else{
			return json_encode(array('status'=>'notexists'));
		}	
	}

	// Insert Trader
	function insert($posts)
	{
		$data = $this->db->insert('traders',$posts);
		
		if($data)
		{
			$insert_id = $this->db->insert_id();
			return json_encode(array('status' => 'success','insert_id' => $insert_id));
		}else{
			return json_encode(array('status' => 'fail'));
		}
	}
	
	// Trader Update	
	function updateTrader($tdid,$posts)
	{
		$query = $this->db->update('traders', $posts, array('td_id'=>$tdid));;
		if($query)
		{
			return json_encode(array('status'=>'success'));
		}else{
			return json_encode(array('status'=>'fail'));
		}		
	}
	
	public function deleteTrader($tdid)
	{

		$response = $this->db->delete('traders', array('td_id'=>$tdid));
		if($response)
		{
			return json_encode(array("status"=>"success"));
		}else{
			return json_encode(array("status"=>"fail"));
		}	
		
	}

}//Main function ends here
?>