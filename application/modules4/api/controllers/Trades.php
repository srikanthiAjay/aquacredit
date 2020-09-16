<?php defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Trades extends CI_Controller 
{
	function __construct()
	{	
		parent::__construct();
		
		$this->load->library('session');		
		$this->load->model('api/Admin_model');	
		$this->load->model('api/Trades_model');
		$this->load->model('api/Transaction_model');
		$this->load->model('api/Cash_model');
		
		setlocale(LC_MONETARY, 'en_IN');		
		
		header('Access-Control-Allow-Origin: *');
	}

	//Index function
	public function index()
	{	
		$val = $this->input->post("txt");	
		echo $response = $this->Trades_model->getTradesdata($val);
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
		echo $response = $this->Trades_model->getSearchUsers(urldecode($search),$ttype);		
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
		$this->db->where('trader_id',$_POST["traderid"]);
		$this->db->where('userid',$_POST["userid"]);
		if($_POST["trade_type"]=='guest')
			$this->db->where('location',$_POST["location"]);
		else
			$this->db->where('location',$_POST["crop_opt"]);
		$this->db->where('status',0);
		$num_rows = $this->db->count_all_results('trade');
		if($num_rows)
		{
			echo json_encode(array('status'=>'fail','msg'=>'Trade with this combination exists'));
			exit;
		}

		if($_POST["trade_type"]=='guest' && $_POST["userid"]=="")
		{
			$typ = '1';
			//create user
			$posts = array(
				'firm_name' => $this->input->post("ukey"),
				'user_name' => $this->input->post("ukey"),
				'mobile' => $this->input->post("mobile"),
				'user_code' => rand(),
				'doj' => date('Y-m-d H:i:s'),
				'typeofuser' => 1			
				);
				
			$response = json_decode($this->Trades_model->userinsert($posts));
			$_POST["userid"] = $response->insert_id;			
		}
		else
		{
			$typ = '0';
		}
		$location = ($_POST["trade_type"]=='guest') ? $_POST["location"] : $_POST["crop_opt"];
		$posts = array('tid' => rand(),
			'trader_id' => $_POST["traderid"],
			'tradetype' => $typ,
			'userid' => $_POST["userid"],
			'location' => $location,
			'exp_count' => $_POST["exp_count"],
			'exp_weight_kgs' => $_POST["exp_weight_kgs"],
			'exp_farmer_price' => $_POST["exp_farmer_price"],
			'exp_company_price' => $_POST["exp_company_price"],
			'note' => $_POST["note"],
			'trade_date' => date('Y-m-d',strtotime($_POST["trade_date"])),
			'created_date' => date('Y-m-d H:i:s'),
			'modified_date' => date('Y-m-d H:i:s'),
			'guest_mobile' => $_POST["mobile"],
			'status' => 0			
			);
			
		$response = $this->Trades_model->insert($posts);
		echo $response;
		
	}

	public function expected_update()
	{
		//print_r($_POST); exit;
		$trade_id = $_POST["trade_id"];
		$posts = array(
			'trader_id' => $_POST["traderid_edit"],
			'trade_date' => date('Y-m-d',strtotime($_POST["trade_date_edit"])),
			'userid' => $_POST["userid_edit"],
			'location' => $_POST["crop_opt_edit"],
			'exp_count' => $_POST["exp_count_edit"],
			'exp_weight_kgs' => $_POST["exp_weight_kgs_edit"],
			'exp_farmer_price' => $_POST["exp_farmer_price_edit"],
			'exp_company_price' => $_POST["exp_company_price_edit"],
			'note' => $_POST["note_edit"],
		);
			
		$response = $this->Trades_model->updateTrade($trade_id,$posts);
		echo $response;
	}

	public function update()
	{
		$trade_id = $_POST["trade_id"];
		
		$fcount = 0;
		for($i=0;$i<count($_POST['tdate']);$i++)
		{
			$fcount += $_POST['tcount'][$i];
			//if(!empty($_POST['tdate'][$i]) && !empty($_POST['tcount'][$i]) && !empty($_POST['tcprice'][$i]) && !empty($_POST['tcweight'][$i]) && !empty($_POST['tfprice'][$i]) && !empty($_POST['tfweight'][$i]))
			if(!empty($_POST['tdate'][$i]) || !empty($_POST['tcount'][$i]) || !empty($_POST['tcprice'][$i]) || !empty($_POST['tcweight'][$i]) || !empty($_POST['tfprice'][$i]) || !empty($_POST['tfweight'][$i]))
			{
				$activity_posts = array('trade_id' => $trade_id,
					'trade_date' => date('Y-m-d',strtotime($_POST['tdate'][$i])),
					'count' => $_POST['tcount'][$i],
					'company_price' => $_POST['tcprice'][$i],
					'company_weight' => $_POST['tcweight'][$i],
					'company_amount' => $_POST["tcamountval"][$i],
					'farmer_price' => $_POST["tfprice"][$i],
					'farmer_weight' => $_POST["tfweight"][$i],
					'farmer_amount' => $_POST["tfamountval"][$i]
				);
				
				if($_POST['hid_acivity_id'][$i]==0)
				{
					$act_res = $this->Trades_model->insertTradeActivity($trade_id,$activity_posts);
				}
				else if($_POST["hid_acivity_id"][$i] > 0)
				{
					$trade_act_id = $_POST["hid_acivity_id"][$i];
					$act_res = $this->Trades_model->updateTradeActivity($trade_act_id,$activity_posts);
				}
			}
		}

		/*update trade*/
		$posts = array(
			'gtotal' => $_POST["gtotalval"],
			'company_fprice' => $_POST["camountval"],
			'farmer_fprice' => $_POST["famountval"],
			'labfee_framer' => $_POST["labfee"],
			'expenses_farmer' => $_POST["expenses"],
			//'trade_date' => date('Y-m-d',strtotime($_POST["trade_date_edit"])),
			'modified_date' => date('Y-m-d H:i:s'),
			'company_fweight' => $_POST["cweightval"],
			'farmer_fweight' => $_POST["fweightval"],
			'final_count' => $fcount,
			'status' => $_POST["status"]			
		);
			
		$response = $this->Trades_model->updateTrade($trade_id,$posts);
		/*update trade*/

		if($this->input->post("status"))
		{
			//insert user transaction
			$data = array(
				"trans_type" 	=> "TRADE", //
				"trans"			=> "HARVEST",
				"trans_id"		=> $trade_id,//
				"trans_code"	=> 'TR'.$trade_id,//
				"user_id"		=>  $this->input->post("userid_edit"),//
				//"user_type"	=>	$this->input->post("userid"),
				"crop_id"		=> 	$this->input->post("crop_opt_edit"),//
				"amount"		=>	$this->input->post("famountval"),//
				"amount_type"	=>	"IN",//
				"description"	=>	"Trade From Farmer",//
				"status"		=>	"0",//
				"created_by"	=>	$this->session->userdata('adminid'),//
			);
			$this->Transaction_model->insert($data);

			//Expenses
			if($this->input->post("expenses") != '0')
			{
				$data = array(
					"trans_type" 	=> "TRADE", //
					"trans"			=> "EXPENSES",
					"trans_id"		=> $trade_id,//
					"trans_code"	=> 'TR'.$trade_id,//
					"user_id"		=>  $this->input->post("userid_edit"),//
					//"user_type"	=>	$this->input->post("userid"),
					"crop_id"		=> 	$this->input->post("crop_opt_edit"),//
					"amount"		=>	$this->input->post("expenses"),//
					"amount_type"	=>	"OUT",//
					"description"	=>	"Trade Expenses",//
					"status"		=>	"0",//
					"created_by"	=>	$this->session->userdata('adminid'),//
				);
				$this->Transaction_model->insert($data);

				//cashflow
				$upd_account = json_decode($this->Cash_model->updateAdminAccount($_POST["admin_bank"],$this->input->post("expenses")));
				$account_amount = $upd_account->avl_bal;

				$cash = array(
					"trans_type" 	=> "TRADE EXPENSES",
					"trans_id"		=> $trade_id,
					"amount"		=> $this->input->post("expenses"),
					"amount_type"	=> "OUT",
					"account_type"	=>	'',
					"account_id"	=> $this->input->post("admin_bank"),
					"avl_bal"		=> $account_amount,
					"admin_id"	=>	$this->session->userdata('adminid'),
				);
				$this->Cash_model->insert($cash);	
			}
			//Lab Fee
			if($this->input->post("labfee") != '0')
			{				
				$data = array(
					"trans_type" 	=> "TRADE", //
					"trans"			=> "LAB FEE",
					"trans_id"		=> $trade_id,//
					"trans_code"	=> 'TR'.$trade_id,//
					"user_id"		=>  $this->input->post("userid_edit"),//
					//"user_type"	=>	$this->input->post("userid"),
					"crop_id"		=> 	$this->input->post("crop_opt_edit"),//
					"amount"		=>	$this->input->post("labfee"),//
					"amount_type"	=>	"OUT",//
					"description"	=>	"Trade Lab Fee",//
					"status"		=>	"0",//
					"created_by"	=>	$this->session->userdata('adminid'),//
				);
				$this->Transaction_model->insert($data);

				//cashflow
				$upd_account = json_decode($this->Cash_model->updateAdminAccount($_POST["admin_bank"],$this->input->post("labfee")));
				$account_amount = $upd_account->avl_bal;

				$cash = array(
					"trans_type" 	=> "TRADE LAB FEE",
					"trans_id"		=> $trade_id,
					"amount"		=> $this->input->post("labfee"),
					"amount_type"	=> "OUT",
					"account_type"	=>	'',
					"account_id"	=> $this->input->post("admin_bank"),
					"avl_bal"		=> $account_amount,
					"admin_id"	=>	$this->session->userdata('adminid'),
				);
				$this->Cash_model->insert($cash);
			}
			
			//insert trader transaction
			$data = array(
				"trans_type" 	=> "TRADE", 
				"trans"			=> "HARVEST",
				"trans_id"		=> $trade_id,
				"trans_code"	=> 'TR'.$trade_id,
				"user_id"		=>  $this->input->post("traderid_edit"),
				"user_type"		=>	"Agent",
				"crop_id"		=> 	'0',
				"amount"		=>	$this->input->post("camountval"),
				"amount_type"	=>	"OUT",
				"description"	=>	"Trade To Trader",
				"status"		=>	"0",
				"created_by"	=>	$this->session->userdata('adminid'),
			);
			$this->Transaction_model->insert($data);
		}
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
			
		$response = $this->Trades_model->userinsert($posts);
		echo $response;
	}
	public function gettrades()
	{
		$draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$limit = intval($this->input->post("length"));
	  
		$def_search = $_POST['search']['value'];
		$order = $_POST['order'][0]['column']; // Column index
		$columnName = $_POST['columns'][$order]['data']; // Column name
		$dir = $_POST['order'][0]['dir']; // asc or desc
		$searchValue = $_POST['search']['value']; // Search value
		
		//$searchByCat = $searchBySubcat = array();
		## Custom Field value
		/*$searchByBrand = $_POST['fil1'];
		$searchByProduct = $_POST['fil2'];
		$searchByPublish = $_POST['fil3'];*/

		$searchByMonth = $_POST['month_opt'];		
		$searchByuser = $_POST['userval'];		
		$searchBytrader = $_POST['traderval'];		
		$searchByStatus = $_POST['status_opt'];
		$from_date = $_POST['from_date'];
		$to_date = $_POST['to_date'];	
		$reportRange = $_POST['reportrange'];		
				
		
		## Search 	
		$allcounts = $this ->Trades_model->tradeAnalytics();

		$result =  $this->Trades_model->trades_search($limit,$start,$def_search,$searchValue,$order,$dir,$searchValue,$searchByMonth,$searchByuser,$searchBytrader,$searchByStatus,$from_date,$to_date,$reportRange); 
		
		$totalRecords = $result["total"];
		$products = $result["data"];
		$data = [];
		if(count($products)>0)
		{
			
			foreach($products as $r) {
				
				/*$brand_id = $r["brand_id"];*/
				/* $url = base_url().'index.php/api/allbrands/'.$brand_id;
				$brand = $this->Curl_model->curl_api($url,"GET",[]);		
				$brand_res = json_decode($brand,true); */
				$brand_res = json_decode($this->Trades_model->gettradername($r['trader_id']),true);
				if($brand_res['data']['trader_type']=='Agent')
				{
					$brand_name = '<a href="'.base_url().'admin/traders/statement/'.$r['trader_id'].'" >'.$brand_res['data']['full_name'].'</a>';
				}
				else
				{
					$tt = $brand_res['data']['firm_name'].' ( '.$brand_res['data']['contact_person'].' )';
					$brand_name = '<a href="'.base_url().'admin/traders/statement/'.$r['trader_id'].'" >'.$tt.'</a>';	
				}
				

				$brand_res1 = json_decode($this->Trades_model->getusername($r['userid']),true);
				$brand_name1 = '<a href="'.base_url().'admin/users/details/'.$r['userid'].'" >'.$brand_res1['data']['user_name'].'</a>';

				if($r['status']==1)
				{
					$status = '<i class="fa fa-check stat_com" aria-hidden="true"></i>';
					$class = 'act_icn1';
				}
				else
				{
					$status = '<i class="fa fa-hourglass-end stat_pen" aria-hidden="true"></i>';
					$class = 'act_icn';
				}
				if (strlen($r['note']) > 70)
				{
					$note = substr($r['note'], 0, 68) . '...';
					$note1 = '<div id="popover-note'.$r["id"].'" class="popover-note" style="display: none">
								<div class="custom-popover">
									<p>'.$r['note'].'</p>
								</div>
							</div>';
					$note = $note1."<span class='note_pop' data-toggle='popover' data-placement='top' tabindex='0' id='note_pop_".$r['id']."' data-trigger='focus' data-toggle='popover'  aria-hidden='true' >".$note."</span>";
				}
					
				else
					$note = $r['note'];

				$dd = date('d-M-Y',strtotime($r['trade_date']));
				$tshowid = '<a href="javascript:void(0);" onclick="clickactionview('.$r["id"].');" >TR'.$r["id"].'</a>';		
			   $data[] = array(					
					$tshowid,
					$dd,
					$brand_name,
					$brand_name1,
					$note,
					//$status,
					'<i class="fa fa-ellipsis-v '.$class.'" data-toggle="popover" data-placement="left" tabindex="0" data-trigger="focus" data-toggle="popover" id=""  aria-hidden="true" onclick="clickaction('.$r["id"].');"></i>'
			   );
			}
		}

		$result = array(
			"draw" => $draw,
			"start" => $start,
			"length" => $limit,
			"recordsTotal" => ($totalRecords==null) ? 0 : $totalRecords,
			"recordsFiltered" => ($totalRecords == null) ? 0 : $totalRecords,
			"tot_rec" => ($allcounts["tot_rec"]==null)? 0 : $allcounts["tot_rec"],
			"tot_draft" => ($allcounts["tot_draft"]==null)? 0 : $allcounts["tot_draft"],
			"tot_count" => ($allcounts["tot_count"]==null)? 0 : $allcounts["tot_count"],
			"tot_amt" => ($allcounts["tot_amt"]==null)? 0 : $allcounts["tot_amt"],
			"data" => $data,
			);
		echo json_encode($result);
		exit();
	}
	public function delete()
	{
		$bid = $_POST["tid"];		
		echo $response = $this->Trades_model->deleteTrade($bid);
		
	}
	public function tradesdelete()
	{
		$bid = $_POST["tid"];
		$tid = 	$_POST["tradeid"];	
		echo $response = $this->Trades_model->deleteTradeactual($bid,$tid);
		
	}
	public function tradedetails($lid)
	{
		echo $response = $this->Trades_model->getTradeDetails($lid);
	}
	public function getPendingAmount()
	{
		echo $response = $this->Trades_model->getPendingAmount();
	}
}
?>