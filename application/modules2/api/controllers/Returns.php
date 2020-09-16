<?php defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Returns extends CI_Controller 
{
	function __construct()
	{	
		parent::__construct();
		
		$this->load->library('session');		
		$this->load->model('api/Admin_model');	
		$this->load->model('api/Returns_model');
		$this->load->model('api/Transaction_model');
		$this->load->model('api/Users_model');
		$this->load->model('api/Branch_model');
		$this->load->model('api/Stocktransfer_model');
		
		
		setlocale(LC_MONETARY, 'en_IN');		
		
		header('Access-Control-Allow-Origin: *');
	}

	//Index function
	
	public function getreturndetails($rid)
	{
		echo $response = $this->Returns_model->get_Returns_Details($rid);		
		exit;
	}
	public function getreturnactualdetails($rid)
	{
		echo $response = $this->Returns_model->getReturnsActualDetails($rid);
		
	}
	public function searchusers()
	{
		$search = $_POST['search'];
		$ttype = $_POST['ttype'];
		$branch = $_POST['branch'];
		echo $response = $this->Returns_model->getSearchUsers(urldecode($search),$ttype,$branch);		
		exit;
	}
	public function search_sale_products()
	{
		$search = $_POST['search'];
		$branch = $_POST['branch'];
		$proid = $_POST['proid'];
		$userid = $_POST['userid'];
		$cropid = $_POST['crop_id'];
		$return_type = $_POST['rtn_type'];

		echo $response = $this->Returns_model->getSearchSaleProducts(urldecode($search),$branch,$proid,$userid,$cropid,$return_type);		
		exit;
	}
	public function getRecentProducts()
	{
		echo $response = $this->Returns_model->getRecentProducts($_POST);
		exit;
	}
	public function get_returns()
	{
		//echo "<pre>";print_r($_POST);exit;
		
		$draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$limit = intval($this->input->post("length"));	  
		
		$order = $_POST['order'][0]['column']; // Column index
		$columnName = $_POST['columns'][$order]['data']; // Column name
		$dir = $_POST['order'][0]['dir']; // asc or desc
		$searchValue = $_POST['search']['value']; // Search value
		
		## Custom Field value		
		$reportRange = $_POST['reportrange'];
		$tabval = $_POST['tabval'];
		$searchByUtype = $_POST['utype_opt'];
		
		## Search	

		$allcounts = $this->Returns_model->returnsAnalytics();
	       
		$returns =  $this->Returns_model->returns_search($limit,$start,$tabval,$searchValue,$searchByUtype,$reportRange,$order,$dir);      
		
		$data = [];
		
		if(count($returns)>0)
		{
			foreach($returns as $r) {
				
				$guest = "";
				
				$return_amt = IND_money_format($r["return_amount"]);
				
				if($r["typeofuser"] == "1")
				{
					$guest = " (Guest)";
				}
				
				$user = json_decode($this->Users_model->getUsersdata($r["user_id"]),true);
				
				if($tabval == 0){ $user_name = $user["data"]["user_name"]; $user_detail_link = base_url().'admin/users/details/'.$r['user_id'];}
				else if($tabval == 1){ $user_name = $r["user_name"]; $user_detail_link = '#';}
				
				$branch = json_decode($this->Branch_model->getBranchdata($r["branch_id"]),true);
				$branch_name = $branch["data"]["branch_name"];	
				
				$user_type = ($r['typeofuser']) ? "GUEST" : $r['user_type'];
				$rtn_id = $r["rtn_id"]; $branch_id = $r["branch_id"];  $crop = $r["crop_id"];
				$data[] = array(					
					'<a class="vw" href="javascript:void(0);" onclick="edit_returns('.$rtn_id.','.$branch_id.','.$crop.');"> RTN'.$rtn_id.' </a>',
					date("d-M-Y",strtotime($r["created_on"])),
					'<a href="'.$user_detail_link.'" title="" >'.$user_name.'</a> ',
					$user_type,
					$branch_name,
					'₹'.$return_amt,
					'<i class="fa fa-ellipsis-v act_icn" data-toggle="popover" data-placement="left" tabindex="0" data-trigger="focus" aria-hidden="true" onclick="edit_returns('.$rtn_id.','.$branch_id.','.$crop.');"></i>'
				);
			}
		}
		

		$result = array(
			"draw" => $draw,
			"start" => $start,
			"length" => $limit,
			"recordsTotal" => count($returns),
			"recordsFiltered" => (count($returns)>0)?$returns[0]["tot_filter_rec"]:0,
			"data" => $data,
			"tot_farmer_amt" => ($allcounts["tot_farmer_amt"]==null)? 0 : $allcounts["tot_farmer_amt"],
			"tot_company_amt" => ($allcounts["tot_company_amt"]==null)? 0 : $allcounts["tot_company_amt"]
		);		
		//print_r($result);exit;
		echo json_encode($result);
		exit();
	}
	public function add()
	{
		//print_r($_POST); exit;
		
		$return_type = $_POST["rtn_types"];
		if($return_type == "farmer"){ $note = $_POST["rece_note"]; }else{ $note = $_POST["rece_note1"];}
		$posts = array('return_type' => $_POST["rtn_types"],
			'branch_id' => $_POST["branchval"],
			'user_id' => $_POST["userid"],
			'crop_id' => $_POST["crop_opt"],
			'return_amount' => $_POST["gtotamtval"],
			'loading_charge' => $_POST["load_charge"],
			'transport_charge' => $_POST["transport_charge"],
			'note' => $note
			);
		$response = $this->Returns_model->insert($posts);
		$final_res = json_decode($response,true);
		if($final_res["status"] == "success")
		{
			$insert_id = $final_res["insert_id"];
			
			if($_POST["rtn_types"] == "farmer")
			{
				$trns = "SALES";
				for($p = 0;$p < count($_POST["proid"]);$p++)
				{
					$return_posts = array('rtn_id' => $insert_id,
					'product_id' => $_POST["proid"][$p],
					'return_qty' => $_POST["proqty"][$p],
					'prod_mrp' => $_POST["promrp"][$p],
					'discount' => $_POST["prodisc"][$p],
					'total_price' => $_POST["prototval"][$p],
					'sale_ids' => $_POST["sids"][$p]
					);
					$ins_rtn = $this->Returns_model->insert_return_product($return_posts);
					$res_rtn = json_decode($ins_rtn,true);
					$retrun_qty = $_POST["proqty"][$p];
					if($res_rtn["status"] == "success")
					{					
						$each_sid = explode(",",$_POST["sids"][$p]);
						foreach($each_sid as $sid)
						{
							$sd_qry = json_decode($this->Returns_model->getSalesDetails($sid,$_POST["proid"][$p]),true);
							if($sd_qry["data"]["remain_qty"] >= $retrun_qty)
							{
								$this->Returns_model->updateSaleReturnQty($sid,$_POST["proid"][$p],$retrun_qty);
								break;
							}
							else{
								$retrun_qty = $retrun_qty - $sd_qry["data"]["remain_qty"];
								$this->Returns_model->updateSaleReturnQty($sid,$_POST["proid"][$p],$sd_qry["data"]["remain_qty"]);
							}
						}
						
						$inven_post = array("branch_id" => $_POST["branchval"], "pid" => $_POST["proid"][$p]);		
						$chk_pro_inventory = json_decode($this->Stocktransfer_model->getBranchProductQty($inven_post),true);
						
						if(count($chk_pro_inventory["data"])>0)
						{
							$final_qty = $_POST["proqty"][$p];
							$this->Stocktransfer_model->updProdcutInventoryQty($_POST["branchval"],$_POST["proid"][$p],$final_qty,'p');
							
						}else{
							
							$inven_post = array("branch_id" => $_POST["branchval"], "pid" => $_POST["proid"][$p], "qty" => $_POST["proqty"][$p]);		
							$this->Stocktransfer_model->insertProductInventoryQty($inven_post);
						}
					}				
				}		
			
			}else if($_POST["rtn_types"] == "company")
			{
				$trns = "PURCHASE";
				for($p = 0;$p < count($_POST["proid"]);$p++)
				{
					$return_posts = array('rtn_id' => $insert_id,
					'product_id' => $_POST["proid"][$p],
					'return_qty' => $_POST["proqty"][$p],
					'prod_mrp' => $_POST["promrp"][$p],
					'discount' => $_POST["prodisc"][$p],
					'total_price' => $_POST["prototval"][$p]					
					);
					$ins_rtn = $this->Returns_model->insert_return_product($return_posts);
					$res_rtn = json_decode($ins_rtn,true);
					$final_qty = $_POST["proqty"][$p];
					$this->Stocktransfer_model->updProdcutInventoryQty($_POST["branchval"],$_POST["proid"][$p],$final_qty,'n');
				}
			}
			$trans_data = array(
				"trans_type" 	=> "RETURN",
				"trans"			=> $trns,
				"trans_id"		=> $insert_id,
				"trans_code"	=> 'RTN'.$insert_id,
				"user_id"		=>  $_POST["userid"],					
				"crop_id"		=> 	$_POST["crop_opt"],
				"amount"		=>	$_POST["gtotamtval"],
				"amount_type"	=>	"IN",
				"description"	=>	$note,
				"status"		=>	"0",
				"created_by"	=>	$this->session->userdata('adminid'),
			);
			$this->Transaction_model->insert($trans_data);
			
		}
		echo $response;
	}
	
	
	public function update()
	{
		//print_r($_POST);exit;
		$returnid = $_POST["returnid"];
		$return_type = $_POST["rtn_types"];
		if($return_type == "farmer"){ $note = $_POST["rece_note"]; }else{ $note = $_POST["rece_note1"];}
		$posts = array('return_amount' => $_POST["gtotamtval"],
			'loading_charge' => $_POST["load_charge"],
			'transport_charge' => $_POST["transport_charge"],
			'note' => $note
			);
		$response = $this->Returns_model->update_returns($returnid,$posts);
		
		$fcount = 0;
		if($_POST["rtn_types"] == "farmer")
		{
			$trns = "SALES";
			for($i=0;$i<count($_POST['proid']);$i++)
			{
				$fcount += $_POST['proqty'][$i];

				/* $this->db->select('products.*');
				$prds = $this->db->get_where("products", ['pid' => $_POST['proid'][$i]])->row_array(); */

				if(!empty($_POST['proid'][$i]) && !empty($_POST['proqty'][$i]) && !empty($_POST['promrp'][$i]) && !empty($_POST['protot'][$i]) )
				{
					
					$activity_posts = array(
						'rtn_id' => $returnid,
						'product_id' => $_POST['proid'][$i],
						'return_qty' => $_POST['proqty'][$i],
						'discount' => $_POST['prodisc'][$i],
						'total_price' => $_POST["prototval"][$i],
						'prod_mrp' => $_POST["promrpval"][$i],
						'sale_ids' => $_POST["sids"][$i]
					);

					
					if($_POST['hid_acivity_id'][$i]==0)
					{					
						$ins_rtn = $this->Returns_model->insert_return_product($activity_posts);
						$res_rtn = json_decode($ins_rtn,true);
						$retrun_qty = $_POST["proqty"][$p];
						if($res_rtn["status"] == "success")
						{					
							$each_sid = explode(",",$_POST["sids"][$i]);
							foreach($each_sid as $sid)
							{
								$sd_qry = json_decode($this->Returns_model->getSalesDetails($sid,$_POST["proid"][$i]),true);
								if($sd_qry["data"]["remain_qty"] >= $retrun_qty)
								{
									$this->Returns_model->updateSaleReturnQty($sid,$_POST["proid"][$i],$retrun_qty);
									break;
								}
								else{
									$retrun_qty = $retrun_qty - $sd_qry["data"]["remain_qty"];
									$this->Returns_model->updateSaleReturnQty($sid,$_POST["proid"][$i],$sd_qry["data"]["remain_qty"]);
								}
							}
							
							$inven_post = array("branch_id" => $_POST["hid_branch"], "pid" => $_POST["proid"][$i]);		
							$chk_pro_inventory = json_decode($this->Stocktransfer_model->getBranchProductQty($inven_post),true);
							
							if(count($chk_pro_inventory["data"])>0)
							{
								$final_qty = $_POST["proqty"][$i];
								$this->Stocktransfer_model->updProdcutInventoryQty($_POST["hid_branch"],$_POST["proid"][$i],$final_qty,'p');
								
							}else{
								
								$inven_post = array("branch_id" => $_POST["hid_branch"], "pid" => $_POST["proid"][$i], "qty" => $_POST["proqty"][$i]);		
								$this->Stocktransfer_model->insertProductInventoryQty($inven_post);
							}
						}
						
					}
					else if($_POST["hid_acivity_id"][$i] > 0)
					{
						$rtn_pro_id = $_POST["hid_acivity_id"][$i];
						$prev_qty = $_POST["hid_proqty"][$i];
						$cur_qty = $_POST["proqty"][$i];
						
						if($prev_qty != $cur_qty)
						{
							$act_res = $this->Returns_model->update_return_product($rtn_pro_id,$activity_posts);
						
							if($prev_qty > $cur_qty)
							{
								$final_qty = $prev_qty - $cur_qty;
								$this->Stocktransfer_model->updProdcutInventoryQty($_POST["hid_branch"],$_POST["proid"][$i],$final_qty,'p');
							}else{
								
								$final_qty = $cur_qty - $prev_qty;
								$this->Stocktransfer_model->updProdcutInventoryQty($_POST["hid_branch"],$_POST["proid"][$i],$final_qty,'n');
							}
						}
					}					
				}
			}	
		
		}else if($_POST["rtn_types"] == "company")
		{
			$trns = "PURCHASE";
			for($i=0;$i<count($_POST['proid']);$i++)
			{
				$activity_posts = array(
					'rtn_id' => $returnid,
					'product_id' => $_POST['proid'][$i],
					'return_qty' => $_POST['proqty'][$i],
					'discount' => $_POST['prodisc'][$i],
					'total_price' => $_POST["prototval"][$i],
					'prod_mrp' => $_POST["promrpval"][$i]
				);
				if($_POST['hid_acivity_id'][$i]==0)
				{					
					$ins_rtn = $this->Returns_model->insert_return_product($activity_posts);
					$res_rtn = json_decode($ins_rtn,true);
					$retrun_qty = $_POST["proqty"][$p];
					if($res_rtn["status"] == "success")
					{
						$final_qty = $_POST["proqty"][$i];
						$this->Stocktransfer_model->updProdcutInventoryQty($_POST["hid_branch"],$_POST["proid"][$i],$final_qty,'n');
					}
				}else if($_POST["hid_acivity_id"][$i] > 0)
				{
					$rtn_pro_id = $_POST["hid_acivity_id"][$i];
					$prev_qty = $_POST["hid_proqty"][$i];
					$cur_qty = $_POST["proqty"][$i];
					
					if($prev_qty != $cur_qty)
					{
						$act_res = $this->Returns_model->update_return_product($rtn_pro_id,$activity_posts);
					
						if($prev_qty > $cur_qty)
						{
							$final_qty = $prev_qty - $cur_qty;
							$this->Stocktransfer_model->updProdcutInventoryQty($_POST["hid_branch"],$_POST["proid"][$i],$final_qty,'p');
						}else{
							
							$final_qty = $cur_qty - $prev_qty;
							$this->Stocktransfer_model->updProdcutInventoryQty($_POST["hid_branch"],$_POST["proid"][$i],$final_qty,'n');
						}
					}
				}
			}
		}	
		
		$data = array(
				"amount"		=>	$_POST["gtotamtval"],
				"description"	=>	$note,
				"status"		=>	"0",
				"updated_by"	=>	$this->session->userdata('adminid'),
			);
			$this->Transaction_model->update($data,array('trans_type' => 'RETURN', 'trans' => $trns, 'trans_id' => $returnid));

		echo $response;
	}
	public function checkProductAvailQty()
	{
		//print_r($_POST);exit;
		echo $response = $this->Returns_model->getAvailProductQty($_POST);
	}	
	public function returnProductdelete()
	{
		$rtn_type = $_POST["rtn_type"]; $rpid = $_POST["rpid"];	$rid = $_POST["rid"];
		$bid = $_POST["bid"];	$pid = $_POST["pid"]; $final_qty = $_POST["fqty"];
		if($rtn_type == "farmer"){ $this->Stocktransfer_model->updProdcutInventoryQty($bid,$pid,$final_qty,'n'); }
		else if($rtn_type == "company"){ $this->Stocktransfer_model->updProdcutInventoryQty($bid,$pid,$final_qty,'p'); }
		echo $response = $this->Returns_model->deleteReturnProduct($rpid,$rid);
		
	}
	public function returns_delete()
	{
		$rid = $_POST["rid"]; $bid = $_POST["bid"];	$cid = $_POST["cid"];	
		$rtn_type = $_POST["tabval"];
		$chk_return_prod = json_decode($this->Returns_model->getReturnsActualDetails($rid),true);
		if(count($chk_return_prod["data"])>0)
		{
			foreach($chk_return_prod["data"] as $rp)
			{
				$inven_post = array("branch_id" => $bid, "pid" => $rp["product_id"]);	
				$chk_pro_inventory = json_decode($this->Stocktransfer_model->getBranchProductQty($inven_post),true);
			
				if(count($chk_pro_inventory["data"])>0)
				{
					$final_qty = $rp["return_qty"];
					if($rtn_type == 0)
					{
						$this->Stocktransfer_model->updProdcutInventoryQty($bid,$rp["product_id"],$final_qty,'n');
					}else if($rtn_type == 1)
					{
						$this->Stocktransfer_model->updProdcutInventoryQty($bid,$rp["product_id"],$final_qty,'p');
					}
					
				}
			}
		}	
						
		//echo $response = $this->Returns_model->deleteReturns($rid,$bid,$cid);
		$trans_posts = array("deleted_by"	=>	$this->session->userdata('adminid'),'deleted' => 1);
		$this->Transaction_model->update($trans_posts,array('trans_id' => $rid));
		$posts = array('deleted' => 1);	
		echo $response = $this->Returns_model->update_returns($rid,$posts);
	}
	
	//exit;
	public function add1()
	{
		if($_POST["sale_types"]=='cash')
		{
			$typ = '1';
			$utype = '1';

			if($_POST['userid']=='')
			{
				$posts = array(
					'firm_name' => $_POST["ukey"],
					'user_name' => $_POST["ukey"],
					'mobile' => $_POST["mobile"],
					'user_code' => rand(),
					'doj' => date('Y-m-d H:i:s'),
					'typeofuser' => 1			
				);
					
				$respo = $this->Returns_model->userinsert($posts);
			}
			else
			{
				$respo = $_POST["userid"];
			}
		}
		else
		{
			$typ = '0';
			$utype = '0';
			$respo = $_POST["userid"];
		}

		$query1 = $this->db->get_where("ac_banks", ['bank_id' => $_POST['bankid']])->row_array();

		$posts = array('sale_id' => 'SAL'.rand(),
			'saletype' => $typ,
			'userid' => $respo,
			'branchid' => $_POST["branchval"],
			'total_saleprice' => $_POST["totamtval"],
			'load_charge' => $_POST["load_charge"],
			'transport_charge' => $_POST["transport_charge"],
			'note' => $_POST["note"],
			'created_date' => date('Y-m-d H:i:s'),
			'modified_date' => date('Y-m-d H:i:s'),
			'mobile' => $_POST["mobile"],
			'transport_type' => $_POST["transport_type"],
			'driver_name' => $_POST["driver_name"],
			'driver_mobile' => $_POST["driver_mobile"],
			'vehicle_number' => $_POST["vehicle_number"],
			's_name' => $_POST["s_name"],
			's_mobile' => $_POST["s_mobile"],
			's_address' => $_POST["s_address"],
			's_state' => $_POST["s_state"],
			's_pincode' => $_POST["s_pincode"],
			'b_name' => $_POST["b_name"],
			'b_mobile' => $_POST["b_mobile"],
			'b_address' => $_POST["b_address"],
			'b_state' => $_POST["b_state"],
			'b_pincode' => $_POST["b_pincode"],
			'b_gst' => $_POST["b_gst"],
			'grandtotal' => $_POST['gtotamtval'],
			'total_discount' => $_POST['totdiscount'],
			'bankid' => $_POST['bankid'],
			'bank_name'=>$query1['bank_name'],
			'account_no'=>$query1['account_no'],
			'bank_ifsc'=>$query1['bank_ifsc'],
			'paymenttype' => $_POST['paymenttype'],
			'payment_date' => date('Y-m-d',strtotime($_POST["payment_date"])),
			'usertype' => $utype,
			'addresstype'=>$_POST['addresstype'],
			'received_amount'=>$_POST['received_amount'],
			'bank_reference'=>$_POST['bank_reference'],
			'crop_id'=>$_POST['crop_opt'],
			'status' => 0,
			'addresstype' => 0			
			);
		$response = $this->Returns_model->insert($posts);
		$saleid = $response;

		if($saleid)
		{
			if($_POST["sale_types"]=='cash')
			{
					$bal_receive = 0;
					if($_POST['received_amount']==$_POST['gtotamtval'])
					{
						/*payment transactions*/
						$balancetype = 'positive';
						$pay_tran = array('sale_id' => $saleid,
									    'bank_name' => $query1['bank_name'],
									    'account_no' => $query1['account_no'],
									    'bank_ifsc' => $query1['bank_ifsc'],
										'amount'=> $_POST['received_amount'],
										'reference_number'=>$_POST['bank_reference'],
										'transaction_date'=> date('Y-m-d h:i:s'));

						$response = $this->Returns_model->paymenttran_insert($pay_tran);
						/*payment transactions*/
					}
					else if($_POST['received_amount']==0)
					{
						$balancetype = 'negative';
						$bal_receive = $_POST['gtotamtval'];
					}
					else if($_POST['received_amount'] < $_POST['gtotamtval'])
					{
						$bal_receive = $_POST['gtotamtval']-$_POST['received_amount'];
						$balancetype = 'negative';

						/*payment transactions*/
						$pay_tran = array('sale_id' => $saleid,
									    'bank_name' => $query1['bank_name'],
									    'account_no' => $query1['account_no'],
									    'bank_ifsc' => $query1['bank_ifsc'],
										'amount'=> $_POST['received_amount'],
										'reference_number'=>$_POST['bank_reference'],
										'transaction_date'=> date('Y-m-d h:i:s'));

						$response = $this->Returns_model->paymenttran_insert($pay_tran);
						/*payment transactions*/
					}
					else if($_POST['received_amount']=='')
					{
						$balancetype = 'negative';
						$bal_receive = $_POST['gtotamtval'];
					}
					
					$rbala = array('balance_receivedamount'=>$bal_receive,'balance_type'=>$balancetype);
					$response1 = $this->Returns_model->updateSale($saleid,$rbala);
					/*echo $this->last_query();
					exit;*/
			}
		}

		$fcount = 0;
		for($i=0;$i<count($_POST['proid']);$i++)
		{
			$fcount += $_POST['proqty'][$i];

			$this->db->select('products.*');
			$prds = $this->db->get_where("products", ['pid' => $_POST['proid'][$i]])->row_array();

			if(!empty($_POST['proid'][$i]) && !empty($_POST['proname'][$i]) && !empty($_POST['proqty'][$i]) && !empty($_POST['promrp'][$i]) &&  !empty($_POST['protot'][$i]))
			{
				$activity_posts = array('s_id' => $saleid,
					'product_id' => $_POST['proid'][$i],
					'quantity' => $_POST['proqty'][$i],
					'mrp' => $_POST['promrpval'][$i],
					'saleprice' => $_POST["promrpval"][$i],
					'purchaseprice' => $_POST["promrpval"][$i],
					'discount' => $_POST["prodisc"][$i],
					'tax'=> $prds['tax'],
					'hsncode'=> $prds['hsn'],
					'total_price' => $_POST["prototval"][$i]
				);
				
				$act_res = $this->Returns_model->insertsale($saleid,$activity_posts);
				
			}
		}

		//insert transaction
		if($_POST["sale_types"]=='cash')
		{
			$data = array(
				"trans_type" 	=> "SALE", //
				"trans"			=> "GOODS",
				"trans_id"		=> $saleid,//
				"trans_code"	=> 'SCH'.$saleid,//
				"user_id"		=>  $this->input->post("userid"),//
				//"user_type"		=>	$this->input->post("userid"),
				"crop_id"		=> 	'0',//
				"amount"		=>	$this->input->post("totamtval"),//
				"amount_type"	=>	"OUT",//
				"description"	=>	"Cash Sale Goods Sent",//
				"status"		=>	"0",//
				"created_by"	=>	$this->session->userdata('adminid'),//
			);
			$this->Transaction_model->insert($data);

			$data = array(
				"trans_type" 	=> "SALE", //
				"trans"			=> "AMOUNT",
				"trans_id"		=> $saleid,//
				"trans_code"	=> 'SCH'.$saleid,//
				"user_id"		=>  $this->input->post("userid"),//
				//"user_type"		=>	$this->input->post("userid"),
				"crop_id"		=> 	'0',//
				"amount"		=>	$this->input->post("totamtval"),//
				"amount_type"	=>	"IN",//
				"description"	=>	"Sale amount received",//
				"status"		=>	"0",//
				"created_by"	=>	$this->session->userdata('adminid'),//
			);
			$this->Transaction_model->insert($data);

			
		}
		else
		{
			$data = array(
				"trans_type" 	=> "SALE", //
				"trans"			=> "GOODS",
				"trans_id"		=> $saleid,//
				"trans_code"	=> 'SCH'.$saleid,//
				"user_id"		=>  $this->input->post("userid"),//
				//"user_type"		=>	$this->input->post("userid"),
				"crop_id"		=> 	$this->input->post("crop_opt"),//
				"amount"		=>	$this->input->post("totamtval"),//
				"amount_type"	=>	"OUT",//
				"description"	=>	"Credit Sale Goods Sent",//
				"status"		=>	"0",//
				"created_by"	=>	$this->session->userdata('adminid'),//
			);
			$this->Transaction_model->insert($data);
		}
		
		$data = array(
			"trans_type" 	=> "SALE", //
			"trans"			=> "LOADING",
			"trans_id"		=> $saleid,//
			"trans_code"	=> 'SCH'.$saleid,//
			"user_id"		=>  $this->input->post("userid"),//
			//"user_type"		=>	$this->input->post("userid"),
			"crop_id"		=> 	($this->input->post("crop_opt")) ? $this->input->post("crop_opt") : '0',//
			"amount"		=>	$this->input->post("load_charge"),//
			"amount_type"	=>	"OUT",//
			"description"	=>	"Loading Charges",//
			"status"		=>	"0",//
			"created_by"	=>	$this->session->userdata('adminid'),//
		);
		$this->Transaction_model->insert($data);

		$data = array(
			"trans_type" 	=> "SALE", //
			"trans"			=> "TRANSPORT",
			"trans_id"		=> $saleid,//
			"trans_code"	=> 'SCH'.$saleid,//
			"user_id"		=>  $this->input->post("userid"),//
			//"user_type"		=>	$this->input->post("userid"),
			"crop_id"		=> 	($this->input->post("crop_opt")) ? $this->input->post("crop_opt") : '0',//
			"amount"		=>	$this->input->post("transport_charge"),//
			"amount_type"	=>	"OUT",//
			"description"	=>	"Transport Charges",//
			"status"		=>	"0",//
			"created_by"	=>	$this->session->userdata('adminid'),//
		);
		$this->Transaction_model->insert($data);
		
		echo json_encode(array('status' => 'success','insert_id' => $saleid));
		
	}

	
	public function tradeactualdetails($tid)
	{
		echo $response = $this->Trades_model->getTradeactualDetails($tid);

	}
	public function insertguest()
	{
		$posts = array(
			'firm_name' => $this->input->post("ukey"),
			'user_name' => $this->input->post("ukey"),
			'mobile' => $this->input->post("mobile"),
			'user_code' => rand(),
			'doj' => date('Y-m-d H:i:s'),
			'typeofuser' => 1			
			);
			
		$response = $this->Returns_model->userinsert($posts);
		echo $response;
	}
	public function IND_money_format($number){    	
        $decimal = (string)($number - floor($number));
        $money = floor($number);
        $length = strlen($money);
        $delimiter = '';
        $money = strrev($money);
 
        for($i=0;$i<$length;$i++){
            if(( $i==3 || ($i>3 && ($i-1)%2==0) )&& $i!=$length){
                $delimiter .=',';
            }
            $delimiter .=$money[$i];
        }
 
        $result = strrev($delimiter);
        $decimal = preg_replace("/0\./i", ".", $decimal);
        $decimal = substr($decimal, 0, 3);
 
        if( $decimal != '0'){
            $result = $result.$decimal;
        }
         return $result;
 	}
	public function getsales()
	{
		$draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$limit = intval($this->input->post("length"));
	  
		$def_search = $_POST['search']['value'];
		$order = $_POST['order'][0]['column']; // Column index
		$columnName = $_POST['columns'][$order]['data']; // Column name
		$dir = $_POST['order'][0]['dir']; // asc or desc
		$searchValue = $_POST['search']['value']; // Search value
		
		

		$searchByMonth = $_POST['month_opt'];		
		$searchByStatus = $_POST['status_opt'];
		$saletype = $_POST['saletype'];
		$from_date = $_POST['from_date'];
		$to_date = $_POST['to_date'];		
				
		
		## Search 	
		$allcounts = $this ->Returns_model->saleAnalytics();

		$products =  $this->Returns_model->sales_search($limit,$start,$def_search,$searchValue,$order,$dir,$searchValue,$searchByMonth,$searchByStatus,$from_date,$to_date,$saletype); 
		
		$data = [];
		if(count($products)>0)
		{
			
			foreach($products as $r) {
				
				/*$brand_id = $r["brand_id"];*/
				/* $url = base_url().'index.php/api/allbrands/'.$brand_id;
				$brand = $this->Curl_model->curl_api($url,"GET",[]);		
				$brand_res = json_decode($brand,true); */
				$brand_res = json_decode($this->Returns_model->getbranchname($r['branchid']),true);
				$brand_name = '<a href="javascript:void(0)" >'.$brand_res['data']['branch_name'].'</a>';
				if($r['editlimit']>3)
				{
					$est = 1;
				}
				else
				{
					$est = 0;
				}
				

				$brand_res1 = json_decode($this->Returns_model->getusername($r['userid']),true);
				$brand_name1 = '<a href="'.base_url().'admin/users/details/'.$r['userid'].'" >'.$brand_res1['data']['user_name'].'</a>';

				if($r['status']==1)
				{
					$status = 'Cancel';
					$acts = 	'<i class="fa fa-ellipsis-v act_icns" data-toggle="popover" data-placement="left" tabindex="0" data-trigger="focus" data-toggle="popover"  aria-hidden="true" onclick="clickaction('.$r["id"].','.$r['status'].','.$est.');"></i>';
				}
				else
				{
					$status = 'Completed';
					$acts = 	'<i class="fa fa-ellipsis-v act_icn" data-toggle="popover" data-placement="left" tabindex="0" data-trigger="focus" data-toggle="popover"  aria-hidden="true" onclick="clickaction('.$r["id"].','.$r['status'].','.$est.');"></i>';
				}
				
				$g_amt = '₹'.$this->IND_money_format($r["grandtotal"]);
				$dd = date('d-M-Y',strtotime($r['created_date']));

				if($r["saletype"]==1)
				{
					$ids = 'SCH'.$r["id"];
				}
				else
				{
					$ids = 'SCD'.$r["id"];
				}

				$tshowid = '<a href="javascript:void(0);"  class="view" >'.$ids.'</a>';	

			    $data[] = array(					
					$tshowid,
					$dd,
					$brand_name1,
					$brand_name,
					$status,
					$g_amt,
					$acts
					/*'<i class="fa fa-ellipsis-v act_icn" data-toggle="popover" data-placement="left" tabindex="0" data-trigger="focus" data-toggle="popover"  aria-hidden="true" onclick="clickaction('.$r["id"].','.$r['status'].');"></i>'*/
					/*'<i class="fa fa-ellipsis-v act_icns" data-toggle="popover" data-placement="left" tabindex="0" data-trigger="focus" data-toggle="popover" aria-hidden="true"></i>'*/
			   );
			}
		}

		$result = array(
			"draw" => $draw,
			"start" => $start,
			"length" => $limit,
			"recordsTotal" => count($products),
			"recordsFiltered" => count($products),
			"creditsale" => ($allcounts["creditsale"]==null)? 0 : $allcounts["creditsale"],
			"cashsale" => ($allcounts["cashsale"]==null)? 0 : $allcounts["cashsale"],
			"data" => $data,
			);
		echo json_encode($result);
		exit();
	}
	public function ordercancel()
	{
		$activity_posts = array('status' => 1);
		$bid = $_POST["tid"];		
		echo $response = $this->Returns_model->deleteSale($bid,$activity_posts);
		
	}
	public function getsalesdetails($lid)
	{
		echo $response = $this->Returns_model->getSalesDetails($lid);		
	}
	public function getSaleItemDetails($sale_id)
	{
		echo $response = $this->Returns_model->getSaleItemDetails($sale_id);	
	}

	public function getsaleactualdetails($lid)
	{
		echo $response = $this->Returns_model->getSalesActualDetails($lid);
		
	}
	public function salesdelete()
	{
		$bid = $_POST["tid"];
		$sid = $_POST["saleid"];
		echo $response = $this->Returns_model->deleteSaleactual($bid,$sid);
		
	}
	public function invoice_preview(){
		//echo "<pre>"; print_r($_POST); echo "</pre>"; exit;
		$this->load->view('admin/sale_preview');
	}

	public function sale_invoice($id=null)
	{
		//echo $id; exit;
		$sale = json_decode($this->Returns_model->getSalesDetails($id));
		$data["sale"] = $sale->data;
		$details = json_decode($this->Returns_model->getSalesActualDetails($id));
		$data["details"] = $details->data;
		//echo "<pre>"; print_r($data); echo "</pre>"; exit;
		$html=$this->load->view('sale_invoice',$data,true); 
		$pdfFilePath = $_SERVER['DOCUMENT_ROOT']."/aquacredit/assets/invoice/invoice_".$id.".pdf";	

        $this->load->library('Pdf');
		$pdf = new Pdf('P', 'mm', 'A5', true, 'UTF-8', false);
		$pdf->SetTitle('ADCredit Invoice');

		$pdf->SetMargins(5, '', 5);
		$pdf->SetHeaderMargin(30);
		$pdf->SetTopMargin(20);
		$pdf->setFooterMargin(20);
		$pdf->SetAutoPageBreak(true,30);
		$pdf->SetAuthor('Author');
		$pdf->SetDisplayMode('real', 'default');
		$pdf->AddPage('P', 'A5');
		$pdf->writeHTML($html, true, false, true, false, '');

		$pdf->SetAlpha(0.7);
		$pdf->Image( base_url().'assets/images/not_paid.png', 10, 90, 70, 50, '', '', 'C', false, 72, 'C', false, false, 0);
		
		$pdf->lastPage();
		ob_end_clean();
		$pdf->Output($pdfFilePath, 'FD');
	}
	
}
?>