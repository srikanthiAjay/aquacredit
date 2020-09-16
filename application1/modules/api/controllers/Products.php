<?php defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Products extends CI_Controller 
{
	function __construct()
	{		
		parent::__construct();
		
		$this->load->library('session');		
		$this->load->model('api/Admin_model');
		$this->load->model('api/Products_model');
		$this->load->model('api/Brands_model');
		
		setlocale(LC_MONETARY, 'en_IN');		
		
		header('Access-Control-Allow-Origin: *');
	}

	//Index function
	public function index($pid = "")
	{
		echo $response = $this->Products_model->getProductsdata($pid);
	}
	
	public function searchproducts()
	{
		
		$search = $_POST['search'];		
		//$search = $_GET['term'];
		echo $response = $this->Products_model->getSearchProducts(urldecode($search));		
		exit;
	}
	
	public function getproducts()
	{
			
		$draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$limit = intval($this->input->post("length"));
	  
		//$def_search = $_POST['search']['value'];
		$order = $_POST['order'][0]['column']; // Column index
		$columnName = $_POST['columns'][$order]['data']; // Column name
		$dir = $_POST['order'][0]['dir']; // asc or desc
		$searchValue = $_POST['search']['value']; // Search value
		
		//$searchByCat = $searchBySubcat = array();
		## Custom Field value
		$searchByBrand = $_POST['brands'];
		$searchByCat = $_POST['category'];
		$searchByPublish = $_POST['publish'];		
		
		## Search 	
		
		$listing =  $this->Products_model->products_search($limit,$start,$searchValue,$searchByBrand,$searchByCat,$searchByPublish,$order,$dir); 

		$total_count = $listing['count'];
		$products = $listing['data'];
		
		$data = [];
		if(count($products)>0)
		{
			foreach($products as $r) {
				
				$brand_id = $r["brand_id"];
				/* $url = base_url().'index.php/api/allbrands/'.$brand_id;
				$brand = $this->Curl_model->curl_api($url,"GET",[]);		
				$brand_res = json_decode($brand,true); */
				$brand_res = json_decode($this->Brands_model->getBrandsdata($brand_id),true);
				$brand_name = $brand_res["data"]["brand_name"];
				$status = ($r["status"]) ? "Published" : "Unpublished" ;
				$pmrp = IND_money_format($r["pmrp"]);
				$purchase_amt = IND_money_format($r["purchase_amt"]);
		
			   $data[] = array(					
					$r["pname"],
					$brand_name,
					$r["cat_name"],
					'₹'.$pmrp,
					'₹'.$purchase_amt,
					$r["percentage"].'%',
					$status,
					'<i class="fa fa-ellipsis-v act_icns" id="'.$r['pid'].'" data-toggle="popover" data-placement="left" tabindex="0" data-trigger="focus" aria-hidden="true" style="width:30px;" data-content=""></i>'
			   );
			}
		}

		$result = array(
			"draw" => $draw,
			"start" => $start,
			"length" => $limit,
			"recordsTotal" => $total_count,
			//"recordsFiltered" => $products[0]["tot_rec"],
			"recordsFiltered" => $total_count,
			"data" => $data,
			);
		echo json_encode($result);
		exit();
	}
	public function getProductsByBrand()
	{
		$sbcat = [];
		$bid = $_POST["bid"];
		$products = $this->Products_model->getProductsByBrand($bid);
		echo json_encode($products,true);
	}
	public function add()
	{
		$posts = array('pname' => urldecode($_POST["prod_name"]),
			'hsn' => $_POST["hsn"],
			'tax' => $_POST["tax"],
			'cat_id' => $_POST["cat"],
			'subcat_id' => $_POST["subcat"],
			'brand_id' => $_POST["brand"],
			'pmrp' => $_POST["mrp"],
			'purchase_amt' => $_POST["p_amt"],
			'percentage' => $_POST["mrp_perc"],
			'qty' => $_POST["qty"],
			'weightage' => $_POST["qty_weight"],
			'per_item' => $_POST["qty_opt"],
			'status' => $_POST["pub"]			
			);
			
		$response = $this->Products_model->insert($posts);
		echo $response;
		
	}
	
	public function checkproductname_by_qty_weight()
	{
		$final_res = json_decode($this->Products_model->checkproductname_by_qty_weight($_POST),true);
		
		if($final_res["status"] == "exists"){	echo 1; }else{ echo 0;}
		exit;
	}
	
	public function getbrandsbysubcat($subcat_id)
	{		
		$subcat_res = $this->Products_model->getBrandsBySubCategory($subcat_id);
		echo  json_encode($subcat_res,true);
	}
			
	public function update()
	{
		$product_id = $_POST["hid_prod_id"];
		$posts = array('pname' => urldecode($_POST["prod_name"]),
			'hsn' => $_POST["hsn"],
			'tax' => $_POST["tax"],
			'cat_id' => $_POST["cat"],
			'subcat_id' => $_POST["subcat"],
			'brand_id' => $_POST["brand"],
			'pmrp' => $_POST["mrp"],
			'purchase_amt' => $_POST["p_amt"],
			'percentage' => $_POST["mrp_perc"],
			'qty' => $_POST["qty"],
			'weightage' => $_POST["qty_weight"],
			'per_item' => $_POST["qty_opt"],
			'status' => $_POST["pub"],			
			'updated_on' => date('Y-m-d H:i:s')			
			);
		echo $response = $this->Products_model->updateProduct($product_id,$posts);
	}
	
	public function delete()
	{
		$pid = $_POST["pid"];
		echo $response = $this->Products_model->deleteProduct($pid);
	}
	
}

?>
