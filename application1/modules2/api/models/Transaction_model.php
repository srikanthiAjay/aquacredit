<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * Author:Srikanthi
*/
class Transaction_model extends CI_Model 
{
    function __construct()
	{
		parent::__construct();
       	$this->load->library('session');
       	$this->load->database();
    }
    
    function insert($posts)
	{
		$data = $this->db->insert('transactions',$posts);
	}

	function update($posts,$where)
	{
		$this->db->where($where);
		$data = $this->db->update('transactions',$posts);
	}
	
	function getRecords($limit = null,$start = null,$params)
	{
		$this->db->select('*');
		$this->db->from('transactions');
		if(!empty($params['searchValue'])){
			$this->db->or_like(['trans_code'=>$params['searchValue']]);
		}

		if(isset($params['settled'])){		
			$this->db->where('status',$params['settled']);		
		}
		
		if(!empty($params['user_id'])){			
			$this->db->where('user_id',$params['user_id']);		
		}

		if(!empty($params['crop_id'])){			
			$this->db->where('crop_id',$params['crop_id']);		
		}

		$filtered_count = $this->db->count_all_results('', false);

		$this->db->limit($limit,$start);
		$query=$this->db->get();
		//echo $str = $this->db->last_query();exit;
		//print_r($str);
		$data=[];
		if($query->num_rows()>0)
        {
        	$data=$query->result_array();
        }

		$data_array = array('count' => $filtered_count, 'data' => $data);
		return $data_array;
		exit;
	}
	function updateloanActivity($laid,$posts)
	{
		$data = $this->db->update('transactions', $posts, array('id'=>$laid));
		
		if($data)
		{
			return json_encode(array('status'=>'success'));
		}else{
			return json_encode(array('status'=>'fail'));
		}
	}	
	function getRecordsloan($params)
	{
		$this->db->select('*');
		$this->db->from('transactions');
		$this->db->where('trans_type','LOAN');	

		if(!empty($params['user_id'])){			
			$this->db->where('user_id',$params['user_id']);		
		}

		if(!empty($params['crop_id'])){			
			$this->db->where('crop_id',$params['crop_id']);		
		}

		$filtered_count = $this->db->count_all_results('', false);

		$this->db->limit($limit,$start);
		$query=$this->db->get();
		//$str = $this->db->last_query();		
		//print_r($str);
		$data=[];
		if($query->num_rows()>0)
        {
        	$data=$query->result_array();
        }

		$data_array = array('count' => $filtered_count, 'data' => $data);
		return $data_array;
		exit;
	}

	function getSettledRecords($limit, $start, $params)
	{
		$this->db->select('*');
		$this->db->from('transaction_settled');
		if(!empty($params['searchValue'])){
			$this->db->or_like(['settled_code'=>$params['searchValue']]);
		}
		
		if(!empty($params['user_id'])){			
			$this->db->where('user_id',$params['user_id']);		
		}

		if(!empty($params['crop_id'])){			
			$this->db->where('crop_id',$params['crop_id']);		
		}

		$filtered_count = $this->db->count_all_results('', false);

		$this->db->limit($limit,$start);
		$query=$this->db->get();
		//echo $str = $this->db->last_query();exit;
		//print_r($str);
		$data=[];
		if($query->num_rows()>0)
        {
        	$data=$query->result_array();
        }

		$data_array = array('count' => $filtered_count, 'data' => $data);
		return $data_array;
		exit;
	}

	function getSettledDetails($settled_id)
	{
		$this->db->select('*');
		$this->db->from('transactions');
		$this->db->where('settled_id',$settled_id);	
		$filtered_count = $this->db->count_all_results('', false);

		$this->db->limit($limit,$start);
		//echo $this->db->last_query();exit;
		$query=$this->db->get();
		$data=[];
		if($query->num_rows()>0)
        {
        	$data=$query->result_array();
        }
		$data_array = array('count' => $filtered_count, 'data' => $data);
		return $data_array;
	}

	function getAgentRecords($limit = null,$start = null,$params)
	{
		$this->db->select('*');
		$this->db->from('transactions');
		if(!empty($params['searchValue'])){
			$this->db->or_like(['trans_code'=>$params['searchValue']]);
		}

		if(!empty($params['trans_type'])){
			$this->db->where(['trans_type'=>$params['trans_type']]);
		}

		if(!empty($params['month_opt'])){
			$month = $params['month_opt'];
			if($month == "m"){
				$this->db->where('MONTH(created_on) = MONTH(CURRENT_DATE()) AND YEAR(created_on) = YEAR(CURRENT_DATE())');
			}else if($month == "1m")
			{
				$this->db->where('created_on >= last_day(now()) + interval 1 day - interval 1 month');
			}else if($month == "3m")
			{
				$this->db->where('created_on >= last_day(now()) + interval 1 day - interval 3 month');
			}else if($month == "6m")
			{
				$this->db->where('created_on >= last_day(now()) + interval 1 day - interval 6 month');
			}else if($month == "1y")
			{
				$this->db->where('created_on`c < DATE_SUB(NOW(),INTERVAL 1 YEAR)');
			}
			else if($month == "custom")
			{
				$from_date = date('Y-m-d',strtotime($fromdate));
				$to_date = date('Y-m-d',strtotime($todate));
				$where .= " AND (CAST(sale.created_date as DATE) BETWEEN '$from_date' AND '$to_date')";
			}
		}
		
		if(!empty($params['trader_id'])){			
			$this->db->where('user_id',$params['trader_id']);		
			$this->db->where('user_type','Agent');	
			$this->db->where_or('user_type','Exporter');	
		}

		

		$filtered_count = $this->db->count_all_results('', false);

		$this->db->limit($limit,$start);
		$query=$this->db->get();
		//echo $str = $this->db->last_query();exit;
		//print_r($str);
		$data=[];
		if($query->num_rows()>0)
        {
        	$data=$query->result_array();
        }

		$data_array = array('count' => $filtered_count, 'data' => $data);
		return $data_array;
		exit;
	}
}