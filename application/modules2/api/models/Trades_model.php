<?php defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(1);
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

	function updateTrade($lid,$posts)
	{
		$query = $this->db->update('trade', $posts, array('id'=>$lid));
		if($query)
		{
			return json_encode(array('status'=>'success'));
		}else{
			return json_encode(array('status'=>'fail'));
		}		
	}
	function insertTradeActivity($lid,$posts)
	{
		$data = $this->db->insert('trade_actual_details',$posts);
		
		if($data)
		{
			$insert_id = $this->db->insert_id();
			return json_encode(array('status' => 'success','insert_id' => $insert_id));
		}else{
			return json_encode(array('status' => 'fail'));
		}	
	}
	function updateTradeActivity($laid,$posts)
	{
		$data = $this->db->update('trade_actual_details', $posts, array('id'=>$laid));
		
		if($data)
		{
			return json_encode(array('status'=>'success'));
		}else{
			return json_encode(array('status'=>'fail'));
		}
	}

	function getTradeDetails($lid)
	{
		//$this->db->from('loan_details');
		$this->db->select('trade.*,users.user_name,traders.trader_type,traders.full_name,traders.contact_person,traders.firm_name,user_crop_details.crop_location');
		$this->db->join('users', 'users.user_id = trade.userid','left');
		$this->db->join('traders', 'traders.td_id = trade.trader_id','left');
		$this->db->join('user_crop_details', 'user_crop_details.cd_id = trade.location','left');
		$query = $this->db->get_where("trade", ['trade.id' => $lid])->row_array();		
		return(json_encode(array('status'=>'success','data'=>$query)));
	}
	
	function getTradesdata($bid = "")
	{	
		$this->db->select("*");
		$this->db->from('trade');
		$this->db->join("traders","traders.td_id = trade.trader_id");
		
		if($bid!='')
		{
			$this->db->where("traders.firm_name LIKE '%$bid%' ");
			$this->db->or_where("traders.full_name LIKE '%$bid%' ");
			$this->db->or_where("traders.mobile_no LIKE '$bid%' ");
		}
		if($this->input->post("status")!="")
			$this->db->where("trade.status",$this->input->post("status"));
		
		$this->db->group_by('trade.trader_id');
		$data = $this->db->get()->result();
       	//echo $this->db->last_query(); exit;
		return json_encode(array('status'=>'success','data' => $data));
	}
	
	function getTotalTradeByUser($user_id = null,$crop_id = null)
	{
		$this->db->select_sum('gtotal');
		$this->db->from('trade');
		if($user_id != "")
			$this->db->where("userid",$user_id);
		if($crop_id != "")
			$this->db->where("location",$crop_id);
		$this->db->where("status",'1'); // completed
		$query = $this->db->get();
		return $query->row()->gtotal;
	}
	function tradeAnalytics()
	{
		$response = array();
		$query = $this->db->query("SELECT *,(select count(id) from trade where status = '1') as tot_rec,(select count(id) from trade where status = '0') as tot_draft,(select SUM(company_fprice) from trade where status = '1') as tot_amt,(select SUM(company_fweight) from trade where status = '1') as tot_count FROM trade");
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
		$this->db->select("*");
		$this->db->from('trade');
		$this->db->join("users","users.user_id = trade.userid");

		$this->db->where("user_type='FARMER'");
		if($bid!='')
		{
			$this->db->where("users.user_name LIKE '%$bid%' ");
			$this->db->or_where("users.mobile LIKE '$bid%' ");
		}
		if($this->input->post("status")!="")
			$this->db->where("trade.status",$this->input->post("status"));
		
		$this->db->group_by('trade.trader_id');
		$data = $this->db->get()->result();
       		
		return json_encode(array('status'=>'success','data' => $data));
	}

	function getSearchUsers($skey,$ttype)
	{
		$sub = '';
		if($ttype=='guest')
		{
			$sub = 'AND typeofuser=1';
		}
		else
		{
			$sub = 'AND typeofuser=0';
		}
		$this->db->select('user_id,user_type,user_code,user_name,mobile');
		$this->db->where("(user_name LIKE '%$skey%' OR mobile LIKE '%$skey%') $sub  ");

		$query = $this->db->get('users')->result();
		//echo $this->db->last_query();exit;
		$response = json_decode(json_encode($query), true);
		foreach($response as $row)
		{
			if($row["user_type"] == "FARMER"){

				$img_path = 'http://3.7.44.132/aquacredit/assets/images/f_1.png';

				$data[] = array("user_id"=>$row['user_id'],"value"=>$row['user_name'],"label"=>$row['user_name'],"usercode"=>$row['user_code'],"user_type"=>$row["user_type"],"img"=>$img_path,"mobile"=>$row['mobile']);
				
			}
			
		}
		
		return json_encode($data);
	}

	function getSearchTrader($skey)
	{
		$this->db->select('td_id,trader_code,firm_name,full_name,mobile_no,trader_type,contact_person');
		$this->db->where("full_name LIKE '%$skey%' OR mobile_no LIKE '%$skey%' OR firm_name LIKE '%$skey%' ");
		$query = $this->db->get('traders')->result();
		//echo $this->db->last_query();exit;
		$response = json_decode(json_encode($query), true);
		foreach($response as $row)
		{
				$img_path = 'http://3.7.44.132/aquacredit/assets/images/f_1.png';
				if($row['trader_type']=='Agent')
				{
					$tra = $row['full_name'];
				}
				else
				{
					$tra = $row['firm_name'].' ( '.$row['contact_person'].' )';
				}

				$data[] = array("user_id"=>$row['td_id'],"value"=>$tra,"label"=>$tra,"usercode"=>$row['trader_code'],"img"=>$img_path,"user_type"=>$row['trader_type']);
		}
		
		return json_encode($data);
	}

	function trades_search($limit,$start,$def_search,$search,$col,$dir,$searchValue,$month,$user,$trader,$status,$fromdate,$todate,$reportRange)    
    {
		if($col == 0){ $col = "id";}

		if($search != ""){ $where .= " AND (id LIKE '%".$search."%' OR traders.firm_name LIKE '%".$search."%' OR traders.contact_person LIKE '%".$search."%' OR traders.full_name LIKE '%".$search."%' OR users.user_name LIKE '%".$search."%')"; }

		if($status != ""){
			
			//$str_status = implode(",",$status);$where .= " AND status IN ($str_status)";
			if(count($status) == 1){ 
				$where .= " AND trade.status IN ('$status[0]')"; 
				$orderby = 'order by modified_date desc';
			}
			else if(count($status)>1){
				$where .= " AND trade.status IN ('$status[0]','$status[1]')";
				$orderby = 'order by id desc';
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
				$where .= " AND CAST(trade.trade_date as DATE) LIKE '$from_date'";
			}else{

				$where .= " AND (CAST(trade.trade_date as DATE) BETWEEN '$from_date' AND '$to_date')";
			}
		}

		if($user)
		{
			$where .= " AND userid IN (" . implode(',', array_map('intval', $user)) . ")";
		}
		if($trader)
		{
			$where .= " AND trader_id IN (" . implode(',', array_map('intval', $trader)) . ")";
		}
		
		$response = array();

		$query1 = $this->db->query("SELECT trade.*,users.user_name,traders.firm_name,traders.full_name,traders.contact_person FROM trade LEFT JOIN users ON users.user_id = trade.userid LEFT JOIN traders ON traders.td_id = trade.trader_id where 1=1 $where $orderby");
		$total_records = $query1->num_rows();
		
		$query = $this->db->query("SELECT trade.*,users.user_name,traders.firm_name,traders.full_name,traders.contact_person FROM trade LEFT JOIN users ON users.user_id = trade.userid LEFT JOIN traders ON traders.td_id = trade.trader_id where 1=1 $where $orderby limit $start,$limit");
		
		//echo $this->db->last_query();exit;
        if($query->num_rows()>0)
        {
			$data = $query->result(); 
			$response = json_decode(json_encode(array('total' => $total_records,'data' => $data)),true);
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

	function userinsert($posts)
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
	public function deleteTradeactual($bid,$lid)
	{
		$tt = $this->db->query("select *from trade_actual_details where id='".$bid."' ")->row_array();
	
		
		$this->db->select('trade.*');
		$query1 = $this->db->get_where("trade", ['trade.id' => $lid])->row_array();	

		

		 $gtotal = $query1['gtotal']-$tt['company_amount'];
		 $company_fprice = $query1['company_fprice']-$tt['company_amount'];
		 $farmer_fprice = $query1['farmer_fprice']-$tt['farmer_amount'];
		 $company_fweight = $query1['company_fweight']-$tt['company_weight'];
		 $farmer_fweight = $query1['farmer_fweight']-$tt['farmer_weight'];
		 $final_count = $query1['final_count']-$tt['count'];

				$posts = array(
					'gtotal' => $gtotal,
					'company_fprice' => $company_fprice,
					'farmer_fprice' => $farmer_fprice,
					'company_fweight' => $company_fweight,
					'farmer_fweight' => $farmer_fweight,
					'final_count' => $final_count			
				);
			$queryd = $this->db->update('trade', $posts, array('id'=>$lid));

		if($queryd)
		{	
			$response = $this->db->delete('trade_actual_details', array('id'=>$bid));
			if($response)
			{
				$this->db->select('trade.*,users.user_name,traders.firm_name,user_crop_details.crop_location');
				$this->db->join('users', 'users.user_id = trade.userid','left');
				$this->db->join('traders', 'traders.td_id = trade.trader_id','left');
				$this->db->join('user_crop_details', 'user_crop_details.cd_id = trade.location','left');
				$query = $this->db->get_where("trade", ['trade.id' => $lid])->row_array();	

				return(json_encode(array('status'=>'success','data'=>$query)));

			}else{
				return json_encode(array("status"=>"fail"));
			}
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
	function getTradeactualDetails($trade_id = "")
	{
		$data = $this->db->select('DATE_FORMAT(trade_date, "%d-%b-%Y") as trade_date,id,count,farmer_price,farmer_weight,farmer_amount,company_price,company_weight,company_amount')->get_where("trade_actual_details", ['trade_id' => $trade_id])->result();
		return json_encode(array('status'=>'success','data' => $data));
	}

	function getPendingAmount()
	{
		$pendingAmount = 0;
		//select traders
		$traders = $this->db->select('td_id')
								->where('status','1')
								->get('traders')->result();
		foreach($traders as $trader)
		{
			$this->db->select_sum('company_fprice')->where("status",'1')->where("trader_id",$trader->td_id);				 
			$selectTrade = $this->db->get("trade")->row();
			$trade_amount = $selectTrade->company_fprice;

			$this->db->select_sum('transfer_amount')->where("transfer_from_type",'trader')->where("from_user_id",$trader->td_id);				 
			$selectReciept = $this->db->get("receipts")->row();
			$receipt_amount = $selectReciept->transfer_amount;

			$pending = $trade_amount - $receipt_amount;
			if($pending > 0)
			{
				/* echo "-------------<br>";
				echo $trader->td_id."<br>";
				echo "Trader :".$trade_amount."<br>";
				echo "Receipt :".$receipt_amount."<br>";
				echo $pending."<br>"; */
				$pendingAmount	+=$pending;
			}				
		}
		echo $pendingAmount;
	}

}//Main function ends here
?>