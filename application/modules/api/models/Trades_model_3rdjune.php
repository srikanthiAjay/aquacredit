<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
	 * Author:Ramakrishna
*/
error_reporting(1);
//ini_set('memory_limit', '100M');

class Trades_model extends CI_Model 
{
	function __construct()
	{
		parent::__construct();
       	$this->load->library('session');
       	$this->load->database();
	}
	
	function gettradername($bid="")
	{
		$data = $this->db->get_where("traders", ['td_id' => $bid])->row_array();
		return json_encode(array('status'=>'success','data' => $data));	
	}

	function getusername($bid="")
	{
		$data = $this->db->get_where("users", ['user_id' => $bid])->row_array();
		return json_encode(array('status'=>'success','data' => $data));	
	}

	function getTradeDetails($lid)
	{
		//$this->db->from('loan_details');
		$this->db->select('trade.*,users.user_name,traders.firm_name,user_crop_details.crop_location');
		$this->db->join('users', 'users.user_id = trade.userid','left');
		$this->db->join('traders', 'traders.td_id = trade.trader_id','left');
		$this->db->join('user_crop_details', 'user_crop_details.cd_id = trade.location','left');
		$query = $this->db->get_where("trade", ['trade.id' => $lid])->row_array();		
		return(json_encode(array('status'=>'success','data'=>$query)));
	}
	
	function getTradesdata($bid = "")
	{
		
			$this->db->where("firm_name LIKE '%$bid%' ");
			$data = $this->db->get('traders')->result();
            
       		
		return json_encode(array('status'=>'success','data' => $data));
		
	}
	function tradeAnalytics()
	{
		$response = array();
		$query = $this->db->query("SELECT *,(select count(id) from trade) as tot_rec,(select SUM(gtotal) from trade where status = '1') as tot_amt,(select SUM(final_count) from trade where status = '1') as tot_count FROM trade");
		//echo $this->db->last_query();
        if($query->num_rows()>0)
        {
            $data = $query->row_array(); 
			$response = json_decode(json_encode($data),true);	
        }
		return $response;
	}

	function getUsersdata($bid = "")
	{
		
			$this->db->where("user_name LIKE '%$bid%' ");
			$data = $this->db->get('users')->result();
           
       		
		return json_encode(array('status'=>'success','data' => $data));
		
	}

	function trades_search($limit,$start,$def_search,$search,$col,$dir)    
    {
		if($col == 0){ $col = "id";}
		/*$where = " status LIKE $publish ";
		if($brand != "")
		{
			$where .= " AND brand_id = $brand";
		}
		if($products != "")
		{
			
			$pvals = implode(",",$products);
			$where .= " AND pid IN ($pvals)";
		}*/
		
		$response = array();
		$query = $this->db->query("SELECT * FROM trade  Order by $col $dir limit $start,$limit"); 
		//echo $this->db->last_query();exit;
        if($query->num_rows()>0)
        {
            $data = $query->result(); 
			$response = json_decode(json_encode($data),true);
        }
         return $response;		
	}
	
	
	
	// Insert brand
	function insert($posts)
	{
		$data = $this->db->insert('trade',$posts);
		
		if($data)
		{
			$insert_id = $this->db->insert_id();
			return json_encode(array('status' => 'success','insert_id' => $insert_id));
		}else{
			return json_encode(array('status' => 'fail'));
		}
	}
	
	// Brand Update	
	function updateTrade($bid,$posts)
	{
		$query = $this->db->update('trade', $posts, array('id'=>$bid));;
		if($query)
		{
			return json_encode(array('status'=>'success'));
		}else{
			return json_encode(array('status'=>'fail'));
		}		
	}
	
	
	
	
	
	
	
	public function deleteTrade($bid)
	{
		$response = $this->db->delete('trade', array('id'=>$bid));
		if($response)
		{
			return json_encode(array("status"=>"success"));
		}else{
			return json_encode(array("status"=>"fail"));
		}	
		
	}
	

}//Main function ends here
?>