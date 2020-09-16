<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
	 * Author:Ramakrishna
*/
error_reporting(1);
//ini_set('memory_limit', '100M');

class Sales_model extends CI_Model 
{
	function __construct()
	{
		parent::__construct();
       	$this->load->library('session');
       	$this->load->database();
	}
	
	function getbranches()
	{
		$data = $this->db->get_where("branch")->result();
		return json_encode(array('status'=>'success','data' => $data));	
	}
	function gettransdetails($lid)
	{
		$data = $this->db->get_where("payment_transactions", ['sale_id' => $lid])->result();
		return(json_encode(array('status'=>'success','data'=>$data)));
	}
	function getbanks()
	{
		$data = $this->db->get_where("ac_banks")->result();

		return json_encode(array('status'=>'success','data' => $data));	
	}
	function getbranchname($bid="")
	{
		$data = $this->db->get_where("branch", ['branch_id' => $bid])->row_array();
		return json_encode(array('status'=>'success','data' => $data));	
	}
	function getusername($bid="")
	{
		$data = $this->db->get_where("users", ['user_id' => $bid])->row_array();
		return json_encode(array('status'=>'success','data' => $data));	
	}
	function bankamount_update($posts,$lid)
	{
		$query = $this->db->update('ac_banks', $posts, array('bank_id'=>$lid));
		if($query)
		{
			return json_encode(array('status'=>'success'));
		}else{
			return json_encode(array('status'=>'fail'));
		}
	}
	function updateSale($lid,$posts)
	{
		$query = $this->db->update('sale', $posts, array('id'=>$lid));
		if($query)
		{
			return json_encode(array('status'=>'success','saleid'=>$lid));
		}else{
			return json_encode(array('status'=>'fail'));
		}		
	}
	function paymenttran_insert($posts)
	{
		$data = $this->db->insert('payment_transactions',$posts);
		
		if($data)
		{
			$insert_id = $this->db->insert_id();
			return json_encode(array('status' => 'success','insert_id' => $insert_id));
		}else{
			return json_encode(array('status' => 'fail'));
		}	
	}
	function insertsale($lid,$posts)
	{
		$data = $this->db->insert('sale_details',$posts);
		
		if($data)
		{
			$insert_id = $this->db->insert_id();
			return json_encode(array('status' => 'success','insert_id' => $insert_id));
		}else{
			return json_encode(array('status' => 'fail'));
		}	
	}
	function updateSaleActivity($laid,$posts)
	{
		$data = $this->db->update('sale_details', $posts, array('id'=>$laid));
		
		if($data)
		{
			return json_encode(array('status'=>'success'));
		}else{
			return json_encode(array('status'=>'fail'));
		}
	}

	function getSalesDetails($lid)
	{
		//$this->db->from('loan_details');
		$this->db->select('sale.*,users.user_name,branch.branch_name');
		$this->db->join('users', 'users.user_id = sale.userid','left');
		$this->db->join('branch', 'branch.branch_id = sale.branchid','left');
		$query = $this->db->get_where("sale", ['sale.id' => $lid])->row_array();
				
		return(json_encode(array('status'=>'success','data'=>$query)));
	}
	
	function getSaleItemDetails($sale_id)
	{
		$this->db->select('s.id,s.quantity,s.mrp,s.discount,s.total_price,p.pname');
		$this->db->join('products p', 'p.pid = s.product_id','left');
		$query = $this->db->get_where("sale_details s", ['s.s_id' => $sale_id])->result();
		//echo $this->db->last_query();
		return(json_encode(array('status'=>'success','data'=>$query)));
	}

	function getSalesActualDetails($lid)
	{
		$this->db->select('sale_details.*,products.pname');
		$this->db->join('products', 'products.pid = sale_details.product_id','left');
		$query = $this->db->get_where("sale_details", ['sale_details.s_id' => $lid])->result();
				
		return(json_encode(array('status'=>'success','data'=>$query)));
	}
	
	function getTradesdata($bid = "")
	{	
		if($bid!='')
		{
			$this->db->where("firm_name LIKE '%$bid%' ");
		}
		
		$data = $this->db->get('traders')->result();
       		
		return json_encode(array('status'=>'success','data' => $data));
		
	}
	function saleAnalytics()
	{
		$response = array();
		$query = $this->db->query("SELECT *,(select SUM(grandtotal) from sale where status = '0' and saletype=0) as creditsale,(select SUM(grandtotal) from sale where status = '0' and saletype=1) as cashsale FROM trade");
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
		$sub = '';
		if($bid!='')
		{
			$sub = "AND user_name LIKE '%".$bid."%' ";
		}

		$this->db->where("user_type='FARMER' $sub ");
		$data = $this->db->get('users')->result();
       		
		return json_encode(array('status'=>'success','data' => $data));
		
	}
	function getSearchProducts($skey,$branch,$proids)
	{
		$pid = implode(',',$proids);
		/*if($pid!='')
		{
			 $s = 'and  pid NOT IN ("'.$pid.'")';
		}*/
		$qu = $this->db->query("select *from branch_inventory where branch_id='".$branch."' and  pid NOT IN ($pid) ")->result();
		//echo $this->db->last_query();
		$res = json_decode(json_encode($qu), true);
		$rw = '';
		
		foreach($res as $r)
		{
			$rw .= $r['pid'].','; 
		}
		$rww = substr($rw,0,-1);


			$this->db->select('pid,pname,pmrp,brand_id,per_item,weightage');
			$this->db->where("pname LIKE '%$skey%' and pid IN($rww) ");

			$query = $this->db->get('products')->result();
			$response = json_decode(json_encode($query), true);
			foreach($response as $row)
			{
					$packing = $this->db->get_where("packing_types", ['id' => $row['per_item']])->row_array();
					$units = $this->db->get_where("units", ['id' => $row['weightage']])->row_array();

					$img_path = 'http://3.7.44.132/aquacredit/assets/images/f_1.png';

					$data[] = array("pid"=>$row['pid'],"value"=>$row['pname'],"label"=>$row['pname'],"brand_id"=>$row["brand_id"],"img"=>$img_path,"pmrp"=>$row['pmrp'],"packing"=>$packing['packing_type'],"units"=>$units['unit_name']);
			}
			return json_encode($data);
	}
	function getSearchUsers($skey,$ttype)
	{
		$sub = '';
		if($ttype=='cash')
		{
			$sub = 'AND typeofuser=1';
		}
		else
		{
			$sub = 'AND typeofuser=0';
		}
		$this->db->select('user_id,user_type,user_code,user_name,mobile,firm_name');
		$this->db->where("(user_name LIKE '%$skey%' OR firm_name LIKE '%$skey%' OR mobile LIKE '%$skey%') and user_type!='NON_FARMER' $sub  ");

		$query = $this->db->get('users')->result();
		//echo $this->db->last_query();exit;
		$response = json_decode(json_encode($query), true);
		foreach($response as $row)
		{
			if($row["user_type"] == "DEALER")
			{
				$username = $row["firm_name"].' '.$row["owner_name"];
			}
			else
			{
				$username = $row["user_name"];
			}

			if($username!='' && $row["user_type"] == "FARMER")
			{
				$img_path = 'http://3.7.44.132/aquacredit/assets/images/f_1.png';
				$data[] = array("user_id"=>$row['user_id'],"value"=>$username,"label"=>$username,"usercode"=>$row['user_code'],"user_type"=>$row["user_type"],"img"=>$img_path,"mobile"=>$row['mobile']);
			}
			else if($row["user_type"] == "DEALER")
			{
				$img_path = 'http://3.7.44.132/aquacredit/assets/images/f_3.png';
				$data[] = array("user_id"=>$row['user_id'],"value"=>$username,"label"=>$username,"usercode"=>$row['user_code'],"user_type"=>$row["user_type"],"img"=>$img_path,"mobile"=>$row['mobile']);
			}
			/*}*/
			
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

				$data[] = array("user_id"=>$row['td_id'],"value"=>$tra,"label"=>$tra,"usercode"=>$row['trader_code'],"img"=>$img_path);
		}
		
		return json_encode($data);
	}

	function getTotalSaleByUser($user_id = null, $crop_id = "")
	{
		$this->db->select_sum('total_saleprice');
		$this->db->from('sale');
		if($user_id != "")
			$this->db->where("userid",$user_id);
		if($crop_id != "")
			$this->db->where("crop_id",$crop_id);
		$this->db->where("status",'0');
		$query = $this->db->get();
		return $query->row()->total_saleprice;
	}

	function sales_search($limit,$start,$def_search,$search,$col,$dir,$searchValue,$month,$status,$fromdate,$todate,$saletype)    
    {
		if($col == 0){ $col = "id";}

		if($search != ""){ $where .= " AND (sale_id LIKE '%".$search."%' OR grandtotal LIKE '%".$search."%' OR branch.branch_name LIKE '%".$search."%' OR users.user_name LIKE '%".$search."%')"; }

		if($status != ""){
			
			//$str_status = implode(",",$status);$where .= " AND status IN ($str_status)";
			if(count($status) == 1){ $where .= " AND sale.status IN ('$status[0]')"; }
			else if(count($status)>1){
				$where .= " AND sale.status IN ('$status[0]','$status[1]')";
			}
			
		}
		if($saletype!='')
		{
			$where .= " AND sale.saletype='".$saletype."' ";
		}
		else
		{
			$where .= " AND sale.saletype='1' ";
		}

		if($month != "")
		{
			/*if($status == ""){
				$where .= " AND trade.status <> '2'";				
			}*/
			if($month == "m"){
				//This month
				$where .= " AND (MONTH(sale.created_date) = MONTH(CURRENT_DATE()) AND YEAR(sale.created_date) = YEAR(CURRENT_DATE())) ";
			}else if($month == "1m")
			{
				$where .= " AND (sale.created_date >= last_day(now()) + interval 1 day - interval 1 month) ";
			}else if($month == "3m")
			{
				$where .= " AND (sale.created_date >= last_day(now()) + interval 1 day - interval 3 month) ";
			}else if($month == "6m")
			{
				$where .= " AND (sale.created_date >= last_day(now()) + interval 1 day - interval 6 month) ";
			}else if($month == "1y")
			{
				$where .= " AND (sale.created_date < DATE_SUB(NOW(),INTERVAL 1 YEAR)) ";
			}
			else if($month == "custom")
			{
				$from_date = date('Y-m-d',strtotime($fromdate));
				$to_date = date('Y-m-d',strtotime($todate));
				$where .= " AND (CAST(sale.created_date as DATE) BETWEEN '$from_date' AND '$to_date')";
			}
		}

		
		$orderby = 'order by id desc';
		$response = array();

		//$query = $this->db->query("SELECT * FROM trade where 1=1 $where Order by $col $dir limit $start,$limit");
		
		$query = $this->db->query("SELECT sale.*,users.user_name,branch.branch_name FROM sale LEFT JOIN users ON users.user_id = sale.userid LEFT JOIN branch ON branch.branch_id = sale.branchid where 1=1 $where $orderby limit $start,$limit");
		
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
		$data = $this->db->insert('sale',$posts);
		
		if($data)
		{
			$insert_id = $this->db->insert_id();
			return $insert_id;
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
			/*return json_encode(array('status' => 'success','insert_id' => $insert_id));*/
			return $insert_id;
		}else{
			return json_encode(array('status' => 'fail'));
		}
	}
	public function deleteSaleactual($bid,$lid)
	{
		$tt = $this->db->query("select *from sale_details where id='".$bid."' ")->row_array();
	
		$this->db->select('sale.*');
		$query1 = $this->db->get_where("sale", ['sale.id' => $lid])->row_array();	
		

		 $gtotal = $query1['grandtotal']-$tt['total_price'];
		 $total_saleprice = $query1['total_saleprice']-$tt['total_price'];
		 
				$posts = array(
					'grandtotal' => $gtotal,
					'total_saleprice' => $total_saleprice	
				);
			$queryd = $this->db->update('sale', $posts, array('id'=>$lid));

		if($queryd)
		{	
			$response = $this->db->delete('sale_details', array('id'=>$bid));
			if($response)
			{
				/*$this->db->select('trade.*,users.user_name,traders.firm_name,user_crop_details.crop_location');
				$this->db->join('users', 'users.user_id = trade.userid','left');
				$this->db->join('traders', 'traders.td_id = trade.trader_id','left');
				$this->db->join('user_crop_details', 'user_crop_details.cd_id = trade.location','left');
				$query = $this->db->get_where("trade", ['trade.id' => $lid])->row_array();	*/

				return(json_encode(array('status'=>'success','data'=>$query)));

			}else{
				return json_encode(array("status"=>"fail"));
			}
		}
	}
	
	public function deleteSale($bid,$posts)
	{
		$query = $this->db->update('sale', $posts, array('id'=>$bid));
		if($query)
		{
			return json_encode(array('status'=>'success'));
		}else{
			return json_encode(array('status'=>'fail'));
		}		
	}
	function getTradeactualDetails($uid = "")
	{
		$data = $this->db->get_where("trade_actual_details", ['trade_id' => $uid])->result();
		return json_encode(array('status'=>'success','data' => $data));
	}

}//Main function ends here
?>