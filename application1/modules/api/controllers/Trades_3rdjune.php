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
	
	
	public function add()
	{
		$posts = array('tid' => rand(),
			'trader_id' => $_POST["traderid"],
			'userid' => $_POST["userid"],
			'location' => $_POST["crop_opt"],
			'exp_count' => $_POST["exp_count"],
			'exp_weight_kgs' => $_POST["exp_weight_kgs"],
			'exp_farmer_price' => $_POST["exp_farmer_price"],
			'exp_company_price' => $_POST["exp_company_price"],
			'note' => $_POST["note"],
			'trade_date' => $_POST["trade_date"],
			'created_date' => date('Y-m-d H:i:s'),
			'modified_date' => date('Y-m-d H:i:s'),
			'status' => 0			
			);
			
		$response = $this->Trades_model->insert($posts);
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
		
		## Search 	
		$allcounts = $this ->Trades_model->tradeAnalytics();

		$products =  $this->Trades_model->trades_search($limit,$start,$def_search,$searchValue,$order,$dir); 
		
		$data = [];
		if(count($products)>0)
		{
			
			foreach($products as $r) {
				
				/*$brand_id = $r["brand_id"];*/
				/* $url = base_url().'index.php/api/allbrands/'.$brand_id;
				$brand = $this->Curl_model->curl_api($url,"GET",[]);		
				$brand_res = json_decode($brand,true); */
				$brand_res = json_decode($this->Trades_model->gettradername($r['trader_id']),true);
				
				$brand_res['data']['firm_name'];
				$brand_name = '<a href="javascript:void(0);">'.$brand_res['data']['firm_name'].'</a>';

				$brand_res1 = json_decode($this->Trades_model->getusername($r['userid']),true);
				$brand_name1 = '<a href="javascript:void(0);">'.$brand_res1['data']['user_name'].'</a>';

				if($r['status']==1)
				{
					$status = '<i class="fa fa-check" aria-hidden="true"></i>';
				}
				else
				{
					$status = '<i class="fa fa-hourglass-end" aria-hidden="true"></i>';
				}
				$dd = date('d-M-Y',strtotime($r['trade_date']));
						
			   $data[] = array(					
					$r["tid"],
					$dd,
					$brand_name,
					$brand_name1,
					$status,
					'<i class="fa fa-ellipsis-v act_icn" data-toggle="popover" data-placement="left" tabindex="0" data-trigger="focus" data-toggle="popover" title="Actions" aria-hidden="true" onclick="clickaction('.$r["id"].');"></i>'
			   );
			}
		}

		$result = array(
			"draw" => $draw,
			"start" => $start,
			"length" => $limit,
			"recordsTotal" => count($products),
			"recordsFiltered" => count($products),
			"tot_rec" => ($allcounts["tot_rec"]==null)? 0 : $allcounts["tot_rec"],
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
	public function tradedetails($lid)
	{
		echo $response = $this->Trades_model->getTradeDetails($lid);
	}
}
?>