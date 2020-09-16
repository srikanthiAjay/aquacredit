<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
	 * Author:Ramakrishna
*/
error_reporting(1);
//ini_set('memory_limit', '100M');

class Stocktransfer_model extends CI_Model 
{
	function __construct()
	{
		parent::__construct();
       	$this->load->library('session');
       	$this->load->database();
	}
	
	function getStockTransferDetails($stk_trans_id)
	{
		$admin_id = $this->session->userdata('adminid');
		$branch_data = json_decode($this->Branch_model->cashbalance_by_userid($admin_id),true);	
		$branch_id = $branch_data["data"]["branch_id"];			
		
		$this->db->select('sr.*,sp.product_id,sp.prod_qty,(SELECT branch_name FROM branch WHERE branch_id = sr.source_branch) AS src_branch,(SELECT branch_name FROM branch WHERE branch_id = sr.destination_branch) AS dst_branch');
		$this->db->join('stock_transfer_products sp', 'sp.stk_trans_id = sr.stk_trans_id','left');
		$query = $this->db->get_where("stock_transfer_request sr", ['sr.stk_trans_id' => $stk_trans_id])->row_array();
		//echo $this->db->last_query();exit;
		$this->db->select('sp.*,p.pname');
		$this->db->join('products p', 'p.pid = sp.product_id','left');
		$prod_query = $this->db->get_where("stock_transfer_products sp", ['sp.stk_trans_id' => $stk_trans_id])->result();		
		return(json_encode(array('status'=>'success','data'=>$query,'products'=>$prod_query,'branch_id'=>$branch_id)));
	}
	
	function getSearchBranchProducts($skey,$bid)
	{
		$this->db->select('products.pid,products.pname,branch_inventory.qty');
		$this->db->join('products', 'products.pid = branch_inventory.pid','left');
		$this->db->where("(pname LIKE '%$skey%') AND branch_id = $bid AND branch_inventory.qty > 0");
		$query = $this->db->get('branch_inventory')->result();
		//echo $this->db->last_query();exit;
		$response = json_decode(json_encode($query), true);
		foreach($response as $row)
		{			
			$data[] = array("pid"=>$row['pid'],"value"=>$row['pname'],"label"=>$row['pname'],'qty'=>$row['qty']);
		}
		
		return json_encode($data);
	}
	function getBranchProductQty($post)
	{
		$bid = $post["branch_id"]; $pid = $post["pid"];			
        $data = $this->db->get_where("branch_inventory", ['branch_id'=>$bid,'pid' => $pid])->row_array();
		//echo $this->db->last_query();exit;
		return json_encode(array('status'=>'success','data' => $data));	
	}	
	
	function StockTransferAnalytics($branch_id)
	{
		$admin_role = $this->session->userdata('adminrole');
		$where = "deleted = '0'";
		if($admin_role != "SA"){
			$where .= " AND (source_branch = $branch_id OR destination_branch = $branch_id)";
		}
		$response = array();
		$query = $this->db->query("SELECT COUNT(IF(status LIKE '0',1,NULL)) as tot_pending,COUNT(IF(status LIKE '1',1,NULL)) as tot_completed FROM stock_transfer_request Where $where ");
		//echo $this->db->last_query();
        if($query->num_rows()>0)
        {
            $data = $query->row_array(); 
			$response = json_decode(json_encode($data),true);	
        }
		return $response;
	}
	
	function stock_transfer_search($limit,$start,$branch_id,$search,$status,$reportRange,$col,$dir)    
    {
		$response = array();
		
		$admin_role = $this->session->userdata('adminrole');
		$where = " deleted = '0'";
		if(count($status) == 1){ $where .= " AND status IN ('$status[0]')"; }
		else if(count($status)>1){ $where .= " AND status IN ('$status[0]','$status[1]')";	}
		/* if($search != ""){ $where .= " AND (rc_id LIKE '%".$search."%' OR user_name LIKE '%".$search."%' OR transfer_amount LIKE '%".$search."%' OR contact_person LIKE '%".$search."%' OR full_name LIKE '%".$search."%')"; } */	
		
		if($reportRange != "" && $reportRange != "Till Date")
		{
			$dateExplode = explode("-",$reportRange);
			$fromDate = str_replace("/"," ",$dateExplode[0]);		
			$toDate = str_replace("/"," ",$dateExplode[1]);

			$from_date = date('Y-m-d',strtotime($fromDate));
			$to_date = date('Y-m-d',strtotime($toDate));
			if($from_date == $to_date)
			{
				$where .= " AND CAST(updated_on as DATE) LIKE '$from_date'";
				
			}else{

				$where .= " AND (CAST(updated_on as DATE) BETWEEN '$from_date' AND '$to_date')";
			}
		}
		
		if($admin_role != "SA"){ $where .= " AND (source_branch = $branch_id OR destination_branch = $branch_id)"; }
		$query = $this->db->query("SELECT *,(select count(stk_trans_id) from stock_transfer_request where $where) as tot_filter_rec FROM stock_transfer_request where $where Order by stk_trans_id desc,updated_on desc limit $start,$limit");
		//echo $this->db->last_query();exit;
        if($query->num_rows()>0)
        {
            $data = $query->result(); 
			$response = json_decode(json_encode($data),true);
			
        }
		return $response;
		
    }
	// Insert Stock Transfer
	function insert($posts)
	{
		$data = $this->db->insert('stock_transfer_request',$posts);
		
		if($data)
		{
			$insert_id = $this->db->insert_id();
			return json_encode(array('status' => 'success','insert_id' => $insert_id));
		}else{
			return json_encode(array('status' => 'fail'));
		}
	}
	function insertProductInventoryQty($posts)
	{
		$data = $this->db->insert('branch_inventory',$posts);
		
		if($data)
		{
			$insert_id = $this->db->insert_id();
			return json_encode(array('status' => 'success','insert_id' => $insert_id));
		}else{
			return json_encode(array('status' => 'fail'));
		}
	}
	function insert_transfer_product($posts)
	{
		$data = $this->db->insert('stock_transfer_products',$posts);
		
		if($data)
		{
			$insert_id = $this->db->insert_id();
			return json_encode(array('status' => 'success','insert_id' => $insert_id));
		}else{
			return json_encode(array('status' => 'fail'));
		}
	}
	
	// Stock Transfer Update	
	function updateStockTransfer($stk_trans_id,$posts)
	{
		$query = $this->db->update('stock_transfer_request', $posts, array('stk_trans_id'=>$stk_trans_id));;
		if($query)
		{
			return json_encode(array('status'=>'success'));
		}else{
			return json_encode(array('status'=>'fail'));
		}		
	}
	
	//Update exisiting products by stock transfer idate
	function updateTransProd($stk_trans_id,$pid,$posts)
	{
		$query = $this->db->update('stock_transfer_products', $posts, array('stk_trans_id'=>$stk_trans_id, 'product_id' => $pid));
		//echo $this->db->last_query();exit;
		if($query)
		{
			return json_encode(array('status'=>'success'));
		}else{
			return json_encode(array('status'=>'fail'));
		}		
	}
	
	function updProdcutInventoryQty($branch_id,$pid,$qty,$p_n)
	{
		if($p_n == "p"){ $this->db->set('qty', 'qty + '.$qty.'',false); }
		else if($p_n == "n"){ $this->db->set('qty', 'qty - '.$qty.'',false); }
		$this->db->where('branch_id', $branch_id);
		$this->db->where('pid', $pid);
		$query = $this->db->update('branch_inventory');
		//echo $this->db->last_query();exit;
		if($query)
		{
			return json_encode(array('status'=>'success'));
		}else{
			return json_encode(array('status'=>'fail'));
		}		
	}
	function updateBranchCashAmount($branch_id,$upd_amt,$p_n)
	{
		if($p_n == "p"){ $this->db->set('amount', 'amount + '.$upd_amt.'',false); }
		else if($p_n == "n"){ $this->db->set('amount', 'amount - '.$upd_amt.'',false); }
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
	
	public function deleteTransProd($stk_trans_id,$pid)
	{
		$response = $this->db->delete('stock_transfer_products', array('stk_trans_id'=>$stk_trans_id, 'product_id' => $pid));

		if($response)
		{
			return json_encode(array("status"=>"success"));
		}else{
			return json_encode(array("status"=>"fail"));
		}	
		
	}
	
	public function deleteStockTransfer($stk_trans_id)
	{

		$response = $this->db->delete('stock_transfer_request', array('stk_trans_id'=>$stk_trans_id));
		if($response)
		{
			return json_encode(array("status"=>"success"));
		}else{
			return json_encode(array("status"=>"fail"));
		}	
		
	}

}//Main function ends here
?>