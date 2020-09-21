<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * Author:Srikanthi
*/
class Cash_model extends CI_Model 
{
    function __construct()
	{
		parent::__construct();
       	$this->load->library('session');
       	$this->load->database();
    }
    
    function insert($posts)
	{
		$data = $this->db->insert('cash_book',$posts);
	}
	
	function update($posts,$where)
	{
		$this->db->where($where);
		$data = $this->db->update('cash_book',$posts);
	}
	
	function getRecords($limit = null,$start = null,$params)
	{
		$this->db->select('*');
		$this->db->from('cash_book');
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

		$this->db->where('amount !=','0');	

		$this->db->order_by('id','DESC');
		$filtered_count = $this->db->count_all_results('', false);
		
		//$this->db->limit($limit,$start);
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

	function updateAdminAccount($account_id,$dedu_amt,$action = null)
	{
		if($action == "credit")
		{
			$this->db->set('avail_amount', 'avail_amount + '.$dedu_amt.'',false);
		}
		else
		{
			$this->db->set('avail_amount', 'avail_amount - '.$dedu_amt.'',false);
		}
		
		$this->db->set('updated_on', date('Y-m-d H:i:s'));
		$this->db->where('id', $account_id);
		$query = $this->db->update('accounts');
		//echo $this->db->last_query();exit;
		if($query)
		{
			$avl_bal = $this->db->select('avail_amount')->where('id', $account_id)->get("accounts")->row();
			$amount = $avl_bal->avail_amount;
			return json_encode(array('status'=>'success','avl_bal'=> $amount));
		}else{
			return json_encode(array('status'=>'fail'));
		}	
	}

	function cashAnalytics()
	{
		$response = array();
		$query = $this->db->query("SELECT *,(select SUM(amount) from cash_book where account_type = 'bank') as bankamount,(select SUM(amount) from cash_book where account_type = 'cash') as cashamount,(select SUM(amount) from cash_book ) as totamount FROM cash_book");
		//echo $this->db->last_query();
        if($query->num_rows()>0)
        {
            $data = $query->row_array(); 
			$response = json_decode(json_encode($data),true);	
        }
		return $response;
	}
	function totalrecords($limit,$start,$def_search,$search,$col,$dir,$searchValue,$searchcash_type_opt,$searchcash_type,$fromdate,$todate,$reportRange)
	{

		if($col == 0){ $col = "id";}

		if($search != ""){ $where .= " AND (trans_type LIKE '%".$search."%' )"; }

		
		if($searchcash_type_opt!='')
		{
			$where .= " AND trans_type='".$searchcash_type_opt."' ";
		}
		if($searchcash_type!='')
		{
			$where .= " AND account_type='".$searchcash_type."' ";
		}

		if($reportRange != "" && $reportRange != "Till Date")
		{
			$dateExplode = explode("to",$reportRange);
			$fromDate = str_replace("-"," ",$dateExplode[0]);		
			$toDate = str_replace("-"," ",$dateExplode[1]);

			$from_date = date('Y-m-d',strtotime($fromDate));
			$to_date = date('Y-m-d',strtotime($toDate));
			if($from_date == $to_date)
			{
				$where .= " AND CAST(created_on as DATE) LIKE '$from_date'";
			}else{

				$where .= " AND (CAST(created_on as DATE) BETWEEN '".$from_date."%' AND '".$to_date."%' )";
			}
		}


		
		$orderby = 'order by id desc';
		$response = array();

		//$query = $this->db->query("SELECT * FROM trade where 1=1 $where Order by $col $dir limit $start,$limit");
		
		$query = $this->db->query("SELECT *from cash_book where 1=1 $where $orderby ");
		
		//echo $this->db->last_query();exit;
        if($query->num_rows()>0)
        {
            $data = $query->result(); 
			$response = json_decode(json_encode($data),true);
        }
         return $response;		
	
	}

	function cash_search($limit,$start,$def_search,$search,$col,$dir,$searchValue,$searchcash_type_opt,$searchcash_type,$fromdate,$todate,$reportRange)    
    {
		if($col == 0){ $col = "id";}

		if($search != ""){ $where .= " AND (trans_type LIKE '%".$search."%' )"; }

		
		if($searchcash_type_opt!='')
		{
			$where .= " AND trans_type='".$searchcash_type_opt."' ";
		}
		if($searchcash_type!='')
		{
			$where .= " AND account_type='".$searchcash_type."' ";
		}

		if($reportRange != "" && $reportRange != "Till Date")
		{
			$dateExplode = explode("to",$reportRange);
			$fromDate = str_replace("-"," ",$dateExplode[0]);		
			$toDate = str_replace("-"," ",$dateExplode[1]);

			$from_date = date('Y-m-d',strtotime($fromDate));
			$to_date = date('Y-m-d',strtotime($toDate));
			if($from_date == $to_date)
			{
				$where .= " AND CAST(created_on as DATE) LIKE '$from_date'";
			}else{

				$where .= " AND (CAST(created_on as DATE) BETWEEN '".$from_date."%' AND '".$to_date."%' )";
			}
		}

		
		$orderby = 'order by id desc';
		$response = array();

		//$query = $this->db->query("SELECT * FROM trade where 1=1 $where Order by $col $dir limit $start,$limit");
		
		$query = $this->db->query("SELECT *from cash_book where 1=1 $where $orderby limit $start,$limit");
		
		//echo $this->db->last_query();exit;
        if($query->num_rows()>0)
        {
            $data = $query->result(); 
			$response = json_decode(json_encode($data),true);
        }
         return $response;		
	}
}