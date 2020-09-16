<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
	 * Author:Ramakrishna
*/
error_reporting(1);
//ini_set('memory_limit', '100M');

class Returns_model extends CI_Model 
{
	function __construct()
	{
		parent::__construct();
       	$this->load->library('session');
       	$this->load->database();
	}
	function get_Returns_Details($rid)
	{
		$this->db->select('return_type');
		$query = $this->db->get_where("returns", ['rtn_id' => $rid])->row_array();
		$response = json_decode(json_encode($query), true);
		//return(json_encode(array('status'=>'success','data'=>$query)));
		if($response["return_type"] == "company")
		{
			$this->db->select('r.*,b.branch_name,br.brand_name as user_name');
			$this->db->join('return_products rp', 'rp.rtn_id = r.rtn_id','left');
			$this->db->join('branch b', 'b.branch_id = r.branch_id','left');
			$this->db->join('brands br', 'br.brand_id = r.user_id','left');
			$query = $this->db->get_where("returns r", ['r.rtn_id' => $rid])->row_array();
		}else{
		
			$this->db->select('r.*,b.branch_name,u.user_name,u.user_type,u.firm_name,u.owner_name,u.mobile,u.typeofuser,uc.crop_location');
			$this->db->join('return_products rp', 'rp.rtn_id = r.rtn_id','left');
			$this->db->join('branch b', 'b.branch_id = r.branch_id','left');
			$this->db->join('users u', 'u.user_id = r.user_id','left');
			$this->db->join('user_crop_details uc', 'uc.cd_id = r.crop_id','left');
			$query = $this->db->get_where("returns r", ['r.rtn_id' => $rid])->row_array();
		}
				
		return(json_encode(array('status'=>'success','data'=>$query)));
	}
	function getReturnsActualDetails($rid)
	{
		$this->db->select('rp.*,p.pname');
		$this->db->join('products p', 'p.pid = rp.product_id','left');
		$query = $this->db->get_where("return_products rp", ['rp.rtn_id' => $rid])->result();
				
		return(json_encode(array('status'=>'success','data'=>$query)));
	}
	function returnsAnalytics()
	{
		$response = array();
		$query = $this->db->query("SELECT SUM(IF(return_type LIKE 'farmer',return_amount,0)) as tot_farmer_amt,SUM(IF(return_type LIKE 'company',return_amount,0)) as tot_company_amt FROM returns r LEFT JOIN users u ON r.user_id = u.user_id  ");
		//echo $this->db->last_query();
        if($query->num_rows()>0)
        {
            $data = $query->row_array(); 
			$response = json_decode(json_encode($data),true);	
        }
		return $response;
	}
	function getRecentProducts($post)
	{
		if($post["rtn_type"] == "f"){ $where = " Where r.return_type = 'farmer'"; }
		else if($post["rtn_type"] == "c"){ $where = " Where r.return_type = 'company'"; }	
		
		$data = array();
		$query = $this->db->query("SELECT rp.return_qty,DATE_FORMAT(rp.created_on,'%d-%b-%Y') as return_date,p.pname FROM returns r LEFT JOIN return_products rp ON rp.rtn_id = r.rtn_id LEFT JOIN products p ON rp.product_id = p.pid $where Order By rp.created_on desc");
		//echo $this->db->last_query();
        if($query->num_rows()>0)
        {
            $data = $query->result(); 
				
        }	
		return json_encode(array('status'=>'success','data' => $data));	
	}
	function returns_search($limit,$start,$tabval,$search,$utype,$reportRange,$col,$dir)    
    {
		//print_r("test".$utype);exit; 
		$response = array();
		$where = " deleted = 0";
		
		if($utype != ""){ 
			
			//$impl_utype = implode(",",$utype);
			$impl_utype = "'" . implode( "','", $utype) . "'";			
			$where .=" AND user_type IN ($impl_utype)"; 
			
			if (in_array("GUEST", $utype))
			{
				//$this->db->or_where('user_type', 'FARMER');
				//$this->db->where('typeofuser','1');
				
				$where .=" OR typeofuser = 1";
			}else{
				
				$where .=" AND typeofuser = 0";
			}
		}		
		
		if($tabval == 0){ $where .= " AND return_type LIKE 'farmer'"; }
		elseif($tabval == 1){ $where .= " AND return_type LIKE 'company'"; }
		
		if($search != ""){ $where .= " AND (rtn_id LIKE '%".$search."%' OR user_name LIKE '%".$search."%' OR return_amount LIKE '%".$search."%' )"; }
		
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
		
		if($tabval == 0){
			$query = $this->db->query("SELECT returns.*,(select count(rtn_id) from returns where $where) as tot_filter_rec,users.user_name,users.firm_name,users.owner_name,users.user_type,users.typeofuser FROM returns LEFT JOIN users ON users.user_id = returns.user_id where $where Order by rtn_id desc,created_on desc limit $start,$limit");
		}else{
			$query = $this->db->query("SELECT returns.*,(select count(rtn_id) from returns where $where) as tot_filter_rec,brands.brand_name as user_name FROM returns LEFT JOIN brands ON brands.brand_id = returns.user_id where $where Order by rtn_id desc,returns.created_on desc limit $start,$limit");
		}
		//echo $this->db->last_query();exit;
        if($query->num_rows()>0)
        {
            $data = $query->result(); 
			$response = json_decode(json_encode($data),true);
			
        }
		return $response;
		
    }
	
	function getSearchUsers($skey,$ttype,$branch)
	{	
		if($ttype == "farmer")
		{
			$sub = '';
			/* if($ttype=='company')
			{
				$sub = "AND user_type='DEALER'";
			} */
			
			$this->db->select('user_id,user_type,user_code,user_name,mobile,firm_name,owner_name,typeofuser');
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
					$data[] = array("user_id"=>$row['user_id'],"value"=>$username,"label"=>$username,"usercode"=>$row['user_code'],"user_type"=>$row["user_type"],"img"=>$img_path,"mobile"=>$row['mobile'],"guest"=>$row["typeofuser"]);
				}
				else if($row["user_type"] == "DEALER")
				{
					$img_path = 'http://3.7.44.132/aquacredit/assets/images/f_2.png';
					$data[] = array("user_id"=>$row['user_id'],"value"=>$username,"label"=>$username,"usercode"=>$row['user_code'],"user_type"=>$row["user_type"],"img"=>$img_path,"mobile"=>$row['mobile'],"guest"=>$row["typeofuser"]);
				}
				/*}*/
				
			}
		}else{
			
			$this->db->select('b.*');
			//$this->db->where("(brand_name LIKE '%$skey%' OR contact_person LIKE '%$skey%' OR contact_mobile LIKE '%$skey%') and contact_email LIKE '%$skey%' $sub  ");
			$this->db->where("b.brand_name LIKE '%$skey%' AND bi.branch_id = $branch ");			
			$this->db->join('products p', 'bi.pid = p.pid','left');
			$this->db->join('brands b', 'b.brand_id = p.brand_id','left');			
			$query = $this->db->get('branch_inventory bi')->result();
			//echo $this->db->last_query();exit;
			$response = json_decode(json_encode($query), true);
			
			foreach($response as $row)
			{	
				$brandname = $row['brand_name'];
				$data[] = array("user_id"=>$row['brand_id'],"value"=>$brandname,"label"=>$brandname,"usercode"=>'',"user_type"=>'',"img"=>'',"mobile"=>$row['contact_mobile'],"guest"=>0);
			}
		}
		
		return json_encode($data);
	}
	function getSearchSaleProducts($skey,$branch,$proids,$userid,$crop_id,$rtn_type)
	{
		if($rtn_type == "farmer")
		{
			$pid = implode(',',$proids); $where = "";
			
			if($crop_id == '' || $crop_id == null){ $cropid = 0;}else{ $cropid = $crop_id;}
			//$qu = $this->db->query("select *from branch_inventory where branch_id='".$branch."' and  pid NOT IN ($pid) ")->result();
			$this->db->select('sd.discount,Group_CONCAT(s.id) as sids,s.branchid,t.user_id,t.crop_id,sd.*,SUM(sd.quantity) as tot_qty,SUM(sd.return_quantity) as rtn_qty, (SUM(sd.quantity)-SUM(sd.return_quantity)) as remain_qty,SUM(sd.total_price) as qty_tot_price,p.pname,p.per_item,p.weightage');
			$this->db->join('sale s', 's.id = sd.s_id','left');
			$this->db->join('transactions t', 't.trans_id = s.id','left');	
			$this->db->join('products p', 'p.pid = sd.product_id','left');	
			//$this->db->group_by(array("sd.product_id", "sd.mrp"));
			$this->db->group_by(array("sd.product_id"));
			
			if($pid!='')
			{
				//$where = ' AND sd.product_id NOT IN ("'.$pid.'")';
				$this->db->where_not_in('sd.product_id', $proids);
			}
			$this->db->where('sd.quantity<>', 'sd.return_quantity', false);
			//$query = $this->db->get_where("sale_details sd", ['t.status' => 0,'t.trans'=>'GOODS','t.user_id'=>$userid,'t.crop_id'=>$cropid,'s.branchid'=>$branch])->result();
			$query = $this->db->get_where("sale_details sd", ['t.status' => 0,'t.trans'=>'GOODS','t.user_id'=>$userid,'t.crop_id'=>$cropid])->result();
			
		}else{
			
			$pid = implode(',',$proids); 
			
			$this->db->select('bi.*,p.pname,p.per_item,p.weightage');
			$this->db->join('products p', 'p.pid = bi.pid','left');
			if($pid!='')
			{
				$this->db->where_not_in('bi.pid', $proids);
			}
			$query = $this->db->get_where("branch_inventory bi", ['bi.branch_id' => $branch,'p.brand_id'=>$userid])->result();
		}
		
		//echo $this->db->last_query();exit;
		$response = json_decode(json_encode($query), true);
	
			foreach($response as $row)
			{
					$packing = $this->db->get_where("packing_types", ['id' => $row['per_item']])->row_array();
					$units = $this->db->get_where("units", ['id' => $row['weightage']])->row_array();
					
					if($rtn_type == "farmer")
					{
						$img_path = 'http://3.7.44.132/aquacredit/assets/images/f_1.png';

						$data[] = array("sids"=>$row['sids'],"pid"=>$row['product_id'],"value"=>$row['pname'],"label"=>$row['pname'],"img"=>$img_path,"pqty"=>$row['remain_qty'],"pmrp"=>$row['mrp'],"tot_price"=>$row['qty_tot_price'],"packing"=>$packing['packing_type'],"units"=>$units['unit_name'],"discount"=>$row["discount"]);
					}else{
						
						$img_path = 'http://3.7.44.132/aquacredit/assets/images/f_2.png';

						$data[] = array("sids"=>'',"pid"=>$row['pid'],"value"=>$row['pname'],"label"=>$row['pname'],"img"=>$img_path,"pqty"=>$row['qty'],"pmrp"=>$row['purchase_amt'],"tot_price"=>($row['qty']*$row['purchase_amt']),"packing"=>$packing['packing_type'],"units"=>$units['unit_name'],"discount"=>0);
					}
			}
			return json_encode($data);
	}
	// Insert Returns
	function insert($posts)
	{
		$data = $this->db->insert('returns',$posts);
		
		if($data)
		{
			$insert_id = $this->db->insert_id();
			return json_encode(array('status' => 'success','insert_id' => $insert_id));
		}else{
			return json_encode(array('status' => 'fail'));
		}
	}
	function insert_return_product($posts)
	{
		$data = $this->db->insert('return_products',$posts);
		
		if($data)
		{
			$insert_id = $this->db->insert_id();
			return json_encode(array('status' => 'success','insert_id' => $insert_id));
		}else{
			return json_encode(array('status' => 'fail'));
		}
	}
	
	function getSalesDetails($sid,$pid)
	{
		$this->db->select('(quantity-return_quantity) as remain_qty');
		$data = $this->db->get_where("sale_details", ['s_id' => $sid,'product_id'=>$pid])->row_array();
		//echo $this->db->last_query();exit;
		return(json_encode(array('status'=>'success','data'=>$data)));
	}
	function updateSaleReturnQty($sid,$pid,$rtn_qty)
	{
		$this->db->set('return_quantity', 'return_quantity + '.$rtn_qty.'',false);
		$this->db->where(array('s_id'=>$sid, 'product_id'=>$pid));
		$query = $this->db->update('sale_details');
		//echo $this->db->last_query();exit;
		if($query)
		{
			return json_encode(array('status'=>'success'));
		}else{
			return json_encode(array('status'=>'fail'));
		}

	}
	
	function updateSale($sid,$posts)
	{
		$query = $this->db->update('sale', $posts, array('id'=>$sid));
		if($query)
		{
			return json_encode(array('status'=>'success','saleid'=>$sid));
		}else{
			return json_encode(array('status'=>'fail'));
		}		
	}
	
	function getAvailProductQty($post)
	{
		//print_r($post);exit;
		$rtn_type = $post["rtn_type"];
		$branch = $post["branch_id"]; $userid = $post["user_id"];
		$crop_id = $post["crop_id"]; $pid = $post["pid"];
		
		if($rtn_type == "farmer")
		{
		
			if($crop_id == '' || $crop_id == null){ $cropid = 0;}else{ $cropid = $crop_id;}
			
			$this->db->select('SUM(sd.quantity) as tot_qty, SUM(sd.return_quantity) as rtn_qty, (SUM(sd.quantity)-SUM(sd.return_quantity)) as qty');
			$this->db->join('sale s', 's.id = sd.s_id','left');
			$this->db->join('transactions t', 't.trans_id = s.id','left');	
			$this->db->join('products p', 'p.pid = sd.product_id','left');	
			//$this->db->group_by(array("sd.product_id", "sd.mrp"));
			$this->db->group_by(array("sd.product_id"));	
			
			$this->db->where('sd.quantity<>', 'sd.return_quantity', false);
			$data = $this->db->get_where("sale_details sd", ['t.status' => 0,'t.trans'=>'GOODS','t.user_id'=>$userid,'t.crop_id'=>$cropid,'s.branchid'=>$branch,'sd.product_id'=>$pid])->row_array();
		}else{
			$this->db->select('*');
			$data = $this->db->get_where("branch_inventory", ['branch_id' => $branch,'pid'=>$pid])->row_array();
		}
		
		//echo $this->db->last_query();exit;
		return json_encode(array('status'=>'success','data' => $data));	
	}	
	
	public function deleteReturnProduct($rpid,$rid)
	{
		$tt = $this->db->query("select *from return_products where rtn_pro_id='".$rpid."' ")->row_array();
	
		$this->db->select('returns.*');
		$query1 = $this->db->get_where("returns", ['returns.rtn_id' => $rid])->row_array();	
		

		 $gtotal = $query1['return_amount']-$tt['total_price'];		 
		 
				$posts = array(
					'return_amount' => $gtotal,
					
				);
			$queryd = $this->db->update('returns', $posts, array('rtn_id'=>$rid));

		if($queryd)
		{	
			$response = $this->db->delete('return_products', array('rtn_pro_id'=>$rpid));
			if($response)
			{
				$amt = $tt['total_price'];
				$this->db->set('amount', 'amount - '.$amt.'',false);
				$this->db->where(array('trans'=>'RETURN', 'trans_id'=>$rid));
				$query = $this->db->update('transactions');

				return(json_encode(array('status'=>'success','data'=>$query)));

			}else{
				return json_encode(array("status"=>"fail"));
			}
		}
	}
	
	public function deleteReturns($rid,$bid,$cid)
	{
		$del_rtn = $this->db->delete('returns', array('rtn_id'=>$rid));
		if($del_rtn){ $del_rtn_pro = $this->db->delete('return_products', array('rtn_id'=>$rid)); }
		if($del_rtn_pro){ $trans = $this->db->delete('transactions', array('trans_id'=>$rid)); }
		if($trans){	return(json_encode(array('status'=>'success')));}
		else{ return json_encode(array("status"=>"fail"));	}
	}
	
	public function update_returns($rtn_id,$posts)
	{
		$query = $this->db->update('returns', $posts, array('rtn_id'=>$rtn_id));
		if($query)
		{
			return json_encode(array('status'=>'success'));
		}else{
			return json_encode(array('status'=>'fail'));
		}		
	}
	public function update_return_product($rtn_pro_id,$posts)
	{
		$query = $this->db->update('return_products', $posts, array('rtn_pro_id'=>$rtn_pro_id));
		if($query)
		{
			return json_encode(array('status'=>'success'));
		}else{
			return json_encode(array('status'=>'fail'));
		}		
	}
	
	//exit;
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