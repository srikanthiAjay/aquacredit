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
	function insertfinalact($posts)
	{
		$data = $this->db->insert('transaction_settled',$posts);
		$insert_id = $this->db->insert_id();

   		return  $insert_id;

	}
	function update($posts,$where)
	{
		$this->db->where($where);
		$data = $this->db->update('transactions',$posts);
	}
	function Updatesettledstatus($posts,$bid,$pid)
	{
		$data = $this->db->update('dummy_account_sale',$posts, array('brand_id'=>$bid,'product_id'=>$pid));
        
		if($data)
		{
			return json_encode(array('status'=>'success'));
		}else{
			return json_encode(array('status'=>'fail'));
		}
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
	function insertaccountActivity($posts)
	{
		$data = $this->db->insert('dummy_account_sale',$posts);
		if($data)
		{
			return json_encode(array('status'=>'success'));
		}else{
			return json_encode(array('status'=>'fail'));
		}
	}
	function Updateinterest($posts,$aid)
	{
		$data = $this->db->update('loan_activity',$posts, array('loan_id'=>$aid));
        
		if($data)
		{
			return json_encode(array('status'=>'success'));
		}else{
			return json_encode(array('status'=>'fail'));
		}
	}
	function Updatesetstatus($posts,$aid)
	{
		$data = $this->db->update('loan_details',$posts, array('loan_id'=>$aid));
        
		if($data)
		{
			return json_encode(array('status'=>'success'));
		}else{
			return json_encode(array('status'=>'fail'));
		}
	}
	function Updatesettleaccount($posts,$auserid,$acropid,$salestep,$loanstep)
	{
		if($salestep==1)
		{
			$data = $this->db->update('transactions',$posts, array('user_id'=>$auserid,'crop_id'=>$acropid,'trans_type'=>'SALE','status'=>0));
		}
		if($loanstep==1)
		{
			$data = $this->db->update('transactions',$posts, array('user_id'=>$auserid,'crop_id'=>$acropid,'trans_type'=>'LOAN','status'=>0));
		}
	}
	function updateaccountActivity($posts,$auserid,$acropid,$brandid,$categoryid,$prodid)
	{
		if($prodid!='' && $prodid!=0)
		{
			$data = $this->db->update('dummy_account_sale',$posts, array('userid'=>$auserid,'cropid'=>$acropid,'category_id'=>$categoryid,'brand_id'=>$brandid));
		}
		else
		{
			$data = $this->db->update('dummy_account_sale',$posts, array('userid'=>$auserid,'cropid'=>$acropid,'category_id'=>$categoryid,'brand_id'=>$brandid,'product_id'=>$prodid));
		}
		
		if($data)
		{
			return json_encode(array('status'=>'success'));
		}else{
			return json_encode(array('status'=>'fail'));
		}
	}
	function Updatesalediscount($posts,$sid,$bid,$pid)
	{
		$data = $this->db->update('sale_details',$posts, array('s_id'=>$sid,'brandid'=>$bid,'product_id'=>$pid));

		if($data)
		{
			return json_encode(array('status'=>'success'));
		}else{
			return json_encode(array('status'=>'fail'));
		}

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
		$this->db->where('status',0);	

		if(!empty($params['user_id'])){			
			$this->db->where('user_id',$params['user_id']);		
		}

		if(!empty($params['crop_id'])){			
			$this->db->where('crop_id',$params['crop_id']);		
		}

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
	function getRecordssale($params)
	{
		$this->db->select('transactions.*, sale.id,sale.branchid as brnchid,sale_details.product_id,sale_details.brandid,products.cat_id,categories.cat_id as categoryid,categories.cat_name');
		$this->db->join('sale', 'sale.id = transactions.trans_id','left');
		$this->db->join('sale_details', 'sale_details.s_id = sale.id','left');
		$this->db->join('products', 'products.pid = sale_details.product_id','left');
		$this->db->join('categories', 'categories.cat_id = products.cat_id','left');
		$this->db->group_by('categoryid');
		$query = $this->db->get_where("transactions", ['transactions.trans_type' => 'SALE','transactions.trans' => 'GOODS','transactions.user_id'=>$params['user_id'],'transactions.crop_id'=>$params['crop_id'],'transactions.status'=>0]);
	
		$data=[];
		if($query->num_rows()>0)
        {
        	$data = $query->result(); 
			$response = json_decode(json_encode($data),true);
        }

		return $response;	
	}
	function getsaleids($params)
	{
		$this->db->select('transactions.*, sale.id,sale.branchid as brnchid,sale_details.product_id,sale_details.brandid,products.cat_id,categories.cat_id as categoryid,categories.cat_name');
		$this->db->join('sale', 'sale.id = transactions.trans_id','left');
		$this->db->join('sale_details', 'sale_details.s_id = sale.id','left');
		$this->db->join('products', 'products.pid = sale_details.product_id','left');
		$this->db->join('categories', 'categories.cat_id = products.cat_id','left');
		$this->db->group_by('trans_id');
		$query = $this->db->get_where("transactions", ['transactions.trans_type' => 'SALE','transactions.trans' => 'GOODS','transactions.user_id'=>$params['user_id'],'transactions.crop_id'=>$params['crop_id'],'transactions.status'=>0]);
		
		$data=[];
		if($query->num_rows()>0)
        {
        	$data = $query->result(); 
			$response = json_decode(json_encode($data),true);
        }

		return $response;	
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
		$this->db->order_by('id','DESC');
		//$this->db->limit($limit,$start);
		
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
		$this->db->order_by('id','DESC');
		//$this->db->limit($limit,$start);
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

		if($params["reportRange"] != "" && $params["reportRange"] != "Till Date")
		{
			$dateExplode = explode("-",$params["reportRange"]);
			$fromDate = str_replace("/"," ",$dateExplode[0]);		
			$toDate = str_replace("/"," ",$dateExplode[1]);

			$from_date = date('Y-m-d',strtotime($fromDate));
			$to_date = date('Y-m-d',strtotime($toDate));
			if($from_date == $to_date)
			{
				$this->db->where("CAST(created_on as DATE) LIKE '$from_date'");
			}else{
				$this->db->where("CAST(created_on as DATE) BETWEEN '$from_date' AND '$to_date'");
			}
		}
		
		if(!empty($params['trader_id'])){			
			$this->db->where('user_id',$params['trader_id']);	
			$this->db->where_in('user_type', ['Agent','Exporter']);	
		}		

		$filtered_count = $this->db->count_all_results('', false);
		$this->db->order_by('id','DESC');
		//$this->db->limit($limit,$start);
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
	function getPurchaseRecords($limit = null,$start = null,$params)
	{
		$this->db->select('t.*,ap.company_id');
		$this->db->join('admin_purchase ap', 'ap.ap_id = t.trans_id','left');
		//$this->db->join('admin_purchase ap', 'ap.company_id = t.user_id','left');
		$this->db->join('returns r', 'r.rtn_id = t.trans_id','left');
		$this->db->from('transactions t');
		if(!empty($params['searchValue'])){
			$this->db->or_like(['t.trans_code'=>$params['searchValue']]);
		}

		if(!empty($params['trans_type'])){
			$this->db->where(['t.trans_type'=>$params['trans_type']]);
		}

		if($params["reportRange"] != "" && $params["reportRange"] != "Till Date")
		{
			$dateExplode = explode("-",$params["reportRange"]);
			$fromDate = str_replace("/"," ",$dateExplode[0]);		
			$toDate = str_replace("/"," ",$dateExplode[1]);

			$from_date = date('Y-m-d',strtotime($fromDate));
			$to_date = date('Y-m-d',strtotime($toDate));
			if($from_date == $to_date)
			{
				$this->db->where("CAST(t.created_on as DATE) LIKE '$from_date'");
			}else{
				$this->db->where("CAST(t.created_on as DATE) BETWEEN '$from_date' AND '$to_date'");
			}
		}
		
		/* if(!empty($params['company_id'])){	
			$comp_id = $params['company_id'];
			$whr = "((`ap`.`company_id` = $comp_id) OR (r.user_id = $comp_id AND r.return_type = 'company'))";
			$this->db->where($whr);
		} */
		
		if(!empty($params['company_id'])){	
			$comp_id = $params['company_id'];
			$whr = "((t.trans_type LIKE 'PURCHASE' AND  ap.company_id = $comp_id) OR (t.trans LIKE 'PURCHASE' AND r.user_id = $comp_id) OR (t.trans_type LIKE 'OPEN BALANCE' AND t.trans_id = $comp_id ))";
			$this->db->where($whr);
		}
		
		$this->db->where_in('t.trans_type', ['PURCHASE','RETURN','OPEN BALANCE']);		
		$this->db->where_in('t.trans', ['AMOUNT','GOODS','PURCHASE','COMPANY']);	
		
		/* $this->db->where_in('t.trans_type', ['PURCHASE','RETURN']);		
		$this->db->where_in('t.trans', ['AMOUNT','GOODS','PURCHASE']);	 */
		
		$filtered_count = $this->db->count_all_results('', false);
		//$this->db->order_by('id','DESC');
		$this->db->order_by('created_on','DESC');
		//$this->db->limit($limit,$start);
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