<?php defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Sales extends CI_Controller 
{
	function __construct()
	{	
		parent::__construct();
		
		$this->load->library('session');		
		$this->load->model('api/Admin_model');	
		$this->load->model('api/Sales_model');
		$this->load->model('api/Transaction_model');
		
		
		setlocale(LC_MONETARY, 'en_IN');		
		
		header('Access-Control-Allow-Origin: *');
	}

	//Index function
	public function index()
	{	
		$val = $this->input->post("txt");	
		echo $response = $this->Trades_model->getTradesdata($val);
	}
	public function getbranches()
	{	
		echo $response = $this->Sales_model->getbranches();
	}
	public function gettransdetails($sid)
	{
		echo $response = $this->Sales_model->gettransdetails($sid);
	}
	public function getbanks()
	{	
		echo $response = $this->Sales_model->getbanks();
	}
	public function users()
	{	
		$val = $this->input->post("txt");	
		echo $response = $this->Trades_model->getUsersdata($val);
	}
	public function traders()
	{	
		$val = $this->input->post("txt");	
		echo $response = $this->Trades_model->getTradesdata($val);
	}
	public function searchusers()
	{
		$search = $_POST['search'];
		$ttype = $_POST['ttype'];
		echo $response = $this->Sales_model->getSearchUsers(urldecode($search),$ttype);		
		exit;
	}
	public function search_products()
	{
		$search = $_POST['search'];
		$branch = $_POST['branch'];
		$proid = $_POST['proid'];

		echo $response = $this->Sales_model->getSearchProducts(urldecode($search),$branch,$proid);		
		exit;
	}

	public function searchtrader()
	{
		$search = $_POST['search'];
		echo $response = $this->Trades_model->getSearchTrader(urldecode($search));		
		exit;
	}
	
	public function add()
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
					
				$respo = $this->Sales_model->userinsert($posts);
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
		$response = $this->Sales_model->insert($posts);
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

						$response = $this->Sales_model->paymenttran_insert($pay_tran);
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

						$response = $this->Sales_model->paymenttran_insert($pay_tran);
						/*payment transactions*/
					}
					else if($_POST['received_amount']=='')
					{
						$balancetype = 'negative';
						$bal_receive = $_POST['gtotamtval'];
					}
					
					$rbala = array('balance_receivedamount'=>$bal_receive,'balance_type'=>$balancetype);
					$response1 = $this->Sales_model->updateSale($saleid,$rbala);
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
				
				$act_res = $this->Sales_model->insertsale($saleid,$activity_posts);
				
			}
		}

		//insert transaction
		if($_POST["sale_types"]=='cash')
		{
			$data = array(
				"trans_type" 	=> "SALE", 
				"trans"			=> "GOODS",
				"trans_id"		=> $saleid,
				"trans_code"	=> 'SCH'.$saleid,
				"user_id"		=>  $this->input->post("userid"),
				//"user_type"		=>	$this->input->post("userid"),
				"crop_id"		=> 	'0',
				"amount"		=>	$this->input->post("totamtval"),
				"amount_type"	=>	"OUT",
				"description"	=>	"Cash Sale Goods Sent",
				"status"		=>	"0",
				"created_by"	=>	$this->session->userdata('adminid'),
			);
			$this->Transaction_model->insert($data);

			$data = array(
				"trans_type" 	=> "SALE", 
				"trans"			=> "AMOUNT",
				"trans_id"		=> $saleid,
				"trans_code"	=> 'SCH'.$saleid,
				"user_id"		=>  $this->input->post("userid"),
				//"user_type"		=>	$this->input->post("userid"),
				"crop_id"		=> 	'0',
				"amount"		=>	$this->input->post("totamtval"),
				"amount_type"	=>	"IN",
				"description"	=>	"Sale amount received",
				"status"		=>	"0",
				"created_by"	=>	$this->session->userdata('adminid'),
			);
			$this->Transaction_model->insert($data);

			
		}
		else
		{
			$data = array(
				"trans_type" 	=> "SALE", 
				"trans"			=> "GOODS",
				"trans_id"		=> $saleid,
				"trans_code"	=> 'SCH'.$saleid,
				"user_id"		=>  $this->input->post("userid"),
				//"user_type"		=>	$this->input->post("userid"),
				"crop_id"		=> 	$this->input->post("crop_opt"),
				"amount"		=>	$this->input->post("totamtval"),
				"amount_type"	=>	"OUT",
				"description"	=>	"Credit Sale Goods Sent",
				"status"		=>	"0",
				"created_by"	=>	$this->session->userdata('adminid'),
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

	public function update()
	{
		$saleid = $_POST["saleid"];
		
		$fcount = 0;
		for($i=0;$i<count($_POST['proid']);$i++)
		{
			$fcount += $_POST['proqty'][$i];

			$this->db->select('products.*');
			$prds = $this->db->get_where("products", ['pid' => $_POST['proid'][$i]])->row_array();

			if(!empty($_POST['proid'][$i]) && !empty($_POST['proqty'][$i]) && !empty($_POST['promrp'][$i]) && !empty($_POST['protot'][$i]) )
			{
				if($_POST['brandid'][$i]=='')
				{
					$_POST['brandid'][$i] = 0;
				}
				$activity_posts = array(
					's_id' =>  $saleid,
					'product_id' => $_POST['proid'][$i],
					'brandid' => $_POST['brandid'][$i],
					'quantity' => $_POST['proqty'][$i],
					'discount' => $_POST['prodisc'][$i],
					'total_price' => $_POST["prototval"][$i],
					'tax'=> $prds['tax'],
					'hsncode'=> $prds['hsn'],
					'mrp' => $_POST["promrpval"][$i]
				);

				
				if($_POST['hid_acivity_id'][$i]==0)
				{
					$act_res = $this->Sales_model->insertsale($saleid,$activity_posts);
				}
				else if($_POST["hid_acivity_id"][$i] > 0)
				{
					$trade_act_id = $_POST["hid_acivity_id"][$i];
					$act_res = $this->Sales_model->updateSaleActivity($trade_act_id,$activity_posts);
				}
			}
		}

		/*update sale*/
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
					
				$respo = $this->Sales_model->userinsert($posts);
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

		$this->db->select('sale.*');
		$query2 = $this->db->get_where("sale", ['sale.id' => $saleid])->row_array();

		$ramt = $_POST['received_amount']+$_POST['received_amountval'];
		$edl = $query2['editlimit']+1;

		$query1 = $this->db->get_where("ac_banks", ['bank_id' => $_POST['bankid']])->row_array();
		/*Payment transaction details*/
		if($_POST["sale_types"]=='cash')
		{
			$fbal_receive = $_POST['received_amountval']+$_POST['received_amount'];
			
			if($_POST['received_amount']!='')
			{
				if($fbal_receive == $_POST['gtotamtval'])
				{
					$balancetype = 'positive';
					$bal_receive = 0;

					$pay_tran = array('sale_id' => $saleid,
									  'bank_name' => $query1['bank_name'],
									  'account_no' => $query1['account_no'],
									  'bank_ifsc' => $query1['bank_ifsc'],
									  'reference_number'=>$_POST['bank_reference'],
									  'amount'=> $_POST['received_amount'],
									  'transaction_date'=> date('Y-m-d h:i:s'));

					$response = $this->Sales_model->paymenttran_insert($pay_tran);
				}
				else if($_POST['gtotamtval'] > $fbal_receive)
				{
					$balancetype = 'negative';
					$bal_receive = $_POST['gtotamtval']-$fbal_receive;

					$pay_tran = array('sale_id' => $saleid,
									  'bank_name' => $query1['bank_name'],
									  'account_no' => $query1['account_no'],
									  'bank_ifsc' => $query1['bank_ifsc'],
									  'reference_number'=>$_POST['bank_reference'],
									  'amount'=> $_POST['received_amount'],
									  'transaction_date'=> date('Y-m-d h:i:s'));

					$response = $this->Sales_model->paymenttran_insert($pay_tran);
				}
				else if($_POST['gtotamtval'] < $fbal_receive)
				{
					$balancetype = 'positive';
					$bal_receive = $fbal_receive - $_POST['gtotamtval'];

					$pay_tran = array('sale_id' => $saleid,
									  'bank_name' => $query1['bank_name'],
									  'account_no' => $query1['account_no'],
									  'bank_ifsc' => $query1['bank_ifsc'],
									  'reference_number'=>$_POST['bank_reference'],
									  'amount'=> $_POST['received_amount'],
									  'transaction_date'=> date('Y-m-d h:i:s'));

					$response = $this->Sales_model->paymenttran_insert($pay_tran);
				}
				$rbala = array('balance_receivedamount'=>$bal_receive,'balance_type'=>$balancetype);
				$response1 = $this->Sales_model->updateSale($saleid,$rbala);
			}
			else
			{
				if($_POST['gtotamtval']>$_POST['received_amountval'])
				{
					$balancetype = 'negative';
					$bbr = $_POST['gtotamtval']-$_POST['received_amountval'];
				}
				else
				{
					$balancetype = 'positive';
					$bbr = $_POST['received_amountval']-$_POST['gtotamtval'];
				}
				
				$rbala = array('balance_receivedamount'=>$bbr,'balance_type'=>$balancetype);
				$response1 = $this->Sales_model->updateSale($saleid,$rbala);
			}
		}
		/*Update payment details*/	
		$posts = array(
			'saletype' => $typ,
			'editlimit'=>$edl,
			'userid' => $respo,
			'branchid' => $_POST["branchval"],
			'total_saleprice' => $_POST["totamtval"],
			'load_charge' => $_POST["load_charge"],
			'transport_charge' => $_POST["transport_charge"],
			'note' => $_POST["note"],
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
			'crop_id'=>$_POST['crop_opt'],
			'addresstype'=>$_POST['addresstype'],
			'received_amount'=>$ramt,
			'bank_reference'=>$_POST['bank_reference']
			);
			
		$response = $this->Sales_model->updateSale($saleid,$posts);
		/*update trade*/
		//update transactions
		if($_POST["sale_types"]=='cash')
		{
			$data = array(
				"amount"		=>	$this->input->post("totamtval"),
				//"amount_type"	=>	"OUT",//
				"description"	=>	"Cash Sale Goods Sent updated",
				"status"		=>	"0",
				"updated_by"	=>	$this->session->userdata('adminid'),
			);
			$this->Transaction_model->update($data,array('trans_type' => 'SALE', 'trans' => 'GOODS', 'trans_id' => $saleid));

			$data = array(
				"amount"		=>	$ramt,
				//"amount_type"	=>	"IN",//
				"description"	=>	"Sale amount received updated",
				"status"		=>	"0",
				"updated_by"	=>	$this->session->userdata('adminid'),
			);
			$this->Transaction_model->update($data,array('trans_type' => 'SALE', 'trans' => 'AMOUNT', 'trans_id' => $saleid));

			
		}
		else
		{
			$data = array(
				"amount"		=>	$this->input->post("totamtval"),
				"amount_type"	=>	"OUT",
				"description"	=>	"Credit Sale Goods Sent updated",
				"status"		=>	"0",
				"updated_by"	=>	$this->session->userdata('adminid'),
			);
			$this->Transaction_model->update($data,array('trans_type' => 'SALE', 'trans' => 'GOODS', 'trans_id' => $saleid));
		}
		
		$data = array(
			//"trans_type" 	=> "SALE", //
			//"trans"			=> "LOADING",
			//"trans_id"		=> $saleid,//
			//"trans_code"	=> 'SCH'.$saleid,//
			//"user_id"		=>  $this->input->post("userid"),//
			//"user_type"		=>	$this->input->post("userid"),
			//"crop_id"		=> 	($this->input->post("crop_opt")) ? $this->input->post("crop_opt") : '0',//
			"amount"		=>	$this->input->post("load_charge"),//
			//"amount_type"	=>	"OUT",//
			"description"	=>	"Loading Charges updated",//
			"status"		=>	"0",//
			"updated_by"	=>	$this->session->userdata('adminid'),//
		);
		$this->Transaction_model->update($data,array('trans_type' => 'SALE', 'trans' => 'LOADING', 'trans_id' => $saleid));

		$data = array(
			//"trans_type" 	=> "SALE", //
			//"trans"			=> "TRANSPORT",
			//"trans_id"		=> $saleid,//
			//"trans_code"	=> 'SCH'.$saleid,//
			//"user_id"		=>  $this->input->post("userid"),//
			//"user_type"		=>	$this->input->post("userid"),
			//"crop_id"		=> 	($this->input->post("crop_opt")) ? $this->input->post("crop_opt") : '0',//
			"amount"		=>	$this->input->post("transport_charge"),//
			//"amount_type"	=>	"OUT",//
			"description"	=>	"Transport Charges updated",//
			"status"		=>	"0",//
			"updated_by"	=>	$this->session->userdata('adminid'),//
		);
		$this->Transaction_model->update($data,array('trans_type' => 'SALE', 'trans' => 'TRANSPORT', 'trans_id' => $saleid));

		echo $response;
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
			
		$response = $this->Sales_model->userinsert($posts);
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
		$allcounts = $this ->Sales_model->saleAnalytics();

		$products =  $this->Sales_model->sales_search($limit,$start,$def_search,$searchValue,$order,$dir,$searchValue,$searchByMonth,$searchByStatus,$from_date,$to_date,$saletype); 
		
		$data = [];
		if(count($products)>0)
		{
			
			foreach($products as $r) {
				
				/*$brand_id = $r["brand_id"];*/
				/* $url = base_url().'index.php/api/allbrands/'.$brand_id;
				$brand = $this->Curl_model->curl_api($url,"GET",[]);		
				$brand_res = json_decode($brand,true); */
				$brand_res = json_decode($this->Sales_model->getbranchname($r['branchid']),true);
				$brand_name = '<a href="javascript:void(0)" >'.$brand_res['data']['branch_name'].'</a>';
				if($r['editlimit']>3)
				{
					$est = 1;
				}
				else
				{
					$est = 0;
				}
				

				$brand_res1 = json_decode($this->Sales_model->getusername($r['userid']),true);
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
		echo $response = $this->Sales_model->deleteSale($bid,$activity_posts);
		
	}
	public function getsalesdetails($lid)
	{
		echo $response = $this->Sales_model->getSalesDetails($lid);		
	}
	public function getSaleItemDetails($sale_id)
	{
		echo $response = $this->Sales_model->getSaleItemDetails($sale_id);	
	}

	public function getsaleactualdetails($lid)
	{
		echo $response = $this->Sales_model->getSalesActualDetails($lid);
		
	}
	public function salesdelete()
	{
		$bid = $_POST["tid"];
		$sid = $_POST["saleid"];
		echo $response = $this->Sales_model->deleteSaleactual($bid,$sid);
		
	}
	public function invoice_preview(){
		//echo "<pre>"; print_r($_POST); echo "</pre>"; exit;
		$this->load->view('admin/sale_preview');
	}

	public function sale_invoice($id=null)
	{
		//echo $id; exit;
		$sale = json_decode($this->Sales_model->getSalesDetails($id));
		$data["sale"] = $sale->data;
		$details = json_decode($this->Sales_model->getSalesActualDetails($id));
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