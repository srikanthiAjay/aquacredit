<?php defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Brands extends CI_Controller 
{
	function __construct()
	{	
		parent::__construct();
		
		$this->load->library('session');		
		$this->load->model('api/Admin_model');	
		$this->load->model('api/Brands_model');
		$this->load->model('api/Categories_model');		
		$this->load->model('api/Subcategories_model');
		$this->load->model('api/Transaction_model');
		
		setlocale(LC_MONETARY, 'en_IN');		
		
		header('Access-Control-Allow-Origin: *');
	}

	//Index function
	public function index($bid = "")
	{		
		echo $response = $this->Brands_model->getBrandsdata($bid);
	}
	
	public function allcats()
	{
		echo $allcats = $this->Categories_model->getCategories();
		
	}	
	public function getbrands()
	{
		//print_r($_POST);exit;
		
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
		$searchByCat = $_POST['category'];
		$searchBySubcat = $_POST['fil2'];
		$searchByPublish = $_POST['publish'];		
		
		## Search	         
	       
		$listing =  $this->Brands_model->brands_search($limit,$start,$searchValue,$searchByCat,$searchBySubcat,$searchByPublish,$order,$dir);	
		
		$total_count = $listing['count'];
		$brands = $listing['data'];
		$data = [];
		if(count($brands)>0)
		{
			foreach($brands as $r) {

					$cats = explode(",",$r["brand_cat"]);				
					$cat_names = "";
										
					foreach($cats as $c)
					{
						
						$cat_res = $this->Categories_model->getCategories($c);
						$final_res = json_decode($cat_res,true);
						
						$subcat_names = "";
						$related_subcats = $this->Brands_model->getSubcatsByBrand($c,$r["brand_subcat"]);
						foreach($related_subcats as $sc)
						{
							$subcat_names .= '<li> '.$sc["cat_name"].' </li>';
						}
		
						//$cat_names[] = $final_res["data"]["cat_name"];
						$cat_names .= ' <span class="show_cat">'.$final_res["data"]["cat_name"].'
						<div class="category_blk" style="z-index: 999 !important;">
							<ul>'.
								$subcat_names .'
							</ul>
						</div>
						</span>';
					}
					//exit;
				$brand_id = $r["brand_id"];
			   $data[] = array(	
					'CMP'.$r['brand_id'],
					'<a href="'.base_url().'admin/companies/statement/'.$brand_id.'" title="">'.$r["brand_name"].'</a> ',
					$cat_names,
					$r['status'],
					'<i class="fa fa-ellipsis-v act_icns" id="'.$r['brand_id'].'" data-toggle="popover" data-placement="left" tabindex="0" data-trigger="focus" aria-hidden="true" style="width:30px;" data-content=""></i>'
			   );
			}
		}

		$result = array(
			"draw" => $draw,
			"start" => $start,
			"length" => $limit,
			"recordsTotal" => $total_count,
			"recordsFiltered" => $total_count,
			//"recordsFiltered" => count($brands),
			"data" => $data,
			/* "feed_count" => $brands[0]["feed_count"],
			"med_count" => $brands[0]["med_count"],
			"mach_count" => $brands[0]["mach_count"],
			"tot_rec" => $brands[0]["tot_rec"] */
		);		
		//print_r($result);exit;
		echo json_encode($result);
		exit();
	}	
	public function getSubCat()
	{
		$sbcat = [];
		if($_POST["catid"]!="")
		{
			foreach($_POST["catid"] as $catid)
			{				
				$scdata_res = json_decode($this->Subcategories_model->getSubCategories($catid),true);
				foreach($scdata_res["data"] as $subcat){
					$sbcat[] = array("parent_id" => $subcat["parent_id"],"subcat_id" => $subcat["cat_id"],"subcat_name" => $subcat["cat_name"]);
				}
			}
		}
		echo json_encode($sbcat,true);
	}

	// Add Brand
	public function add()
	{		
		$cats = $subcats = "";
		if(isset($_POST["med"])){ $med_val = $_POST["med"];}else{ $med_val = 0; }
		if(count($_POST["sub_cati"])>0){ 
			
			foreach($_POST["sub_cati"] as $sc)
			{
				$expl_cat_subcat = explode("-",$sc);
				$cat_arry [] = $expl_cat_subcat[0];  
				$subcats_arry []= $expl_cat_subcat[1];
			}
			$cats = implode(",",array_unique($cat_arry));
			$subcats = implode(",",array_unique($subcats_arry));
		}
		$posts = array('brand_name' => urldecode($_POST["brand_name"]),
			'contact_person' => urldecode($_POST["contact_person"]),
			'contact_mobile' => $_POST["p_mobile"],
			'contact_email' => $_POST["p_email"],
			'contact_loc' => $_POST["p_loc"],
			'turnover_disc' => $_POST["turn_disc"],
			'open_balance' => $_POST["tbal"],
			'brand_cat' => $cats,
			'brand_subcat' => $subcats,
			'medicine_type' => $med_val,
			'status' => $_POST["pub"]			
			);		
		$response = $this->Brands_model->insert($posts);
		$final_res = json_decode($response,true);
		if($final_res["status"] == "success")
		{
			$insert_id = $final_res["insert_id"];
			
			if(isset($_POST["tbal"]) && $_POST["tbal"]!=0)
			{
				$open_balance = str_replace("-","",$_POST["tbal"]);
				if($_POST["tbal"] > 0){ $bal_type = "IN";}else{ $bal_type = "OUT";}
				$data = array(
					"trans_type" 	=> "OPEN BALANCE",
					"trans"			=> "COMPANY",
					"trans_id"		=> $insert_id,
					"trans_code"	=> 'CMP'.$insert_id,
					"user_id"		=>  $insert_id,
					"amount"		=>	$open_balance,
					"amount_type"	=>	$bal_type,
					"description"	=>	"Company Opening Balance",
					"status"		=>	"0",
					"created_by"	=>	$this->session->userdata('adminid'),
				);
				$this->Transaction_model->insert($data);
			}
			
			$brand_acc_posts = array('brand_id' => $insert_id,
			'full_name' => urldecode(ucwords($_POST["holder_name"])),
			'account_no' => $_POST["acc_no"],
			'bank_name' => $_POST["bank_name"],
			'ifsc' => $_POST["ifsc_code"],
			'branch_name' => ucwords($_POST["branch_name"]),	
			'status' => '1',		
			'created_on' => date('Y-m-d H:i:s')		
			);	
			$brand_acc = $this->Brands_model->brand_account_insert($brand_acc_posts);
		}
		echo $response;
		
	}
	
	public function cat_subcat_add()
	{		
		if($_POST["hid_frm"] == "c"){ 
			
			$posts = array('cat_name' => urldecode($_POST["cat_name"]),
			'cat_desc' => urldecode($_POST["cat_desc"]),
			'level' => 1,
			'status' => 1
			);
		}
		else if($_POST["hid_frm"] == "sc"){ 
			
			$posts = array('cat_name' => urldecode($_POST["subcat_name"]),
			'subcat_desc' => urldecode($_POST["subcat_desc"]),
			'parent_id' => $_POST["catopt"],
			'level' => 2,
			'status' => 1
			);
		}
		echo $response = $this->Categories_model->insert($posts);
	}
	
	public function checkcategory()
	{		
		$final_res = json_decode($this->Categories_model->check_category_name($_POST["catname"]),true);
		if($final_res["status"] == "exists" ){	echo 1; }else{ echo 0;}
		exit;
	}
	
	public function checkbrandname()
	{		
		$final_res = json_decode($this->Brands_model->check_brand_name($_POST["brand_name"]),true);
		if($final_res["status"] == "exists" ){	echo 1; }else{ echo 0;}
		exit;
	}
	
		
	public function update()
	{
		$cats = $subcats = "";
		if(count($_POST["sub_cati"])>0){ 
			
			foreach($_POST["sub_cati"] as $sc)
			{
				$expl_cat_subcat = explode("-",$sc);
				$cat_arry [] = $expl_cat_subcat[0];  
				$subcats_arry []= $expl_cat_subcat[1];
			}
			$cats = implode(",",array_unique($cat_arry));
			$subcats = implode(",",array_unique($subcats_arry));
		}
		$brand_id = $_POST["hid_bid"];
		$posts = array('brand_name' => urldecode($_POST["brand_name"]),
			'contact_person' => urldecode($_POST["contact_person"]),
			'contact_mobile' => $_POST["p_mobile"],
			'contact_email' => $_POST["p_email"],
			'contact_loc' => $_POST["p_loc"],
			'turnover_disc' => $_POST["turn_disc"],
			'brand_cat' => $cats,
			'brand_subcat' => $subcats,
			'medicine_type' => $_POST["med"],
			'status' => $_POST["pub"],
			'updated_on' => date('Y-m-d H:i:s')
			);		
		$response = $this->Brands_model->updateBrand($brand_id,$posts);
		if($_POST["hid_acc_id"] != "")
		{
			$brand_acc_posts = array('full_name' => urldecode($_POST["holder_name"]),
			'account_no' => $_POST["acc_no"],
			'bank_name' => $_POST["bank_name"],
			'ifsc' => $_POST["ifsc_code"],
			'branch_name' => $_POST["branch_name"]	
			);	
			$brand_acc = $this->Brands_model->brand_account_update($_POST["hid_acc_id"],$brand_acc_posts);
		}
		echo $response;
	}
	
	function in_array_r($needle, $haystack, $strict = false) {
		foreach ($haystack as $item) {
			if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && $this->in_array_r($needle, $item, $strict))) {
				return true;
			}
		}

		return false;
	}
	//Statement
	public function transactions()
	{
		$draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$limit = intval($this->input->post("length"));

		$params['order']=$_POST['order'][0]['column']; // Column index
		$params['columnName']=$_POST['columns'][$order]['data']; // Column name
		$params['dir']=$_POST['order'][0]['dir']; // asc or desc
		$params['searchValue']=$_POST['search']['value']; // Search value

		$params['company_id'] = $this->input->post('company_id');
		$params["trans_type"] = ($this->input->post('trans_type')) ? $this->input->post('trans_type') : "";
		$params["month_opt"] = ($this->input->post('month_opt')) ? $this->input->post('month_opt') : "";
		$params["reportRange"] = $_POST['reportrange'];

		$allcounts = $this->Brands_model->companyAnalytics($this->input->post('company_id'));

		$balance = $this->Brands_model->getOpenBanlace($this->input->post('company_id'),'amount,amount_type');
		$balance = json_decode($balance,true);
		$open_balance = $balance["data"]['amount'];
		$balance_type = $balance["data"]['amount_type'];
		
		$records=$this->Transaction_model->getPurchaseRecords($limit,$start,$params);
		$total_count = $records['count'];
		$tansactions = $records['data'];
		
		$open_bal_exist = $this->in_array_r("OPEN BALANCE", $records['data']) ? '1' : '0';
				
		$opening_date = date("Y-m-d",strtotime($records['data'][$total_count-1]["created_on"]));
		$balance_new = $this->Brands_model->getOpenBanlace_new($this->input->post('company_id'),$opening_date." 00:00:00",$params);
		//$balance_new = json_decode($balance_new,true);
		$bal_total_count = $balance_new['count'];
		$open_balance= 0;$op_amount = 0;
		if($bal_total_count > 0)
		{
			foreach($balance_new["data"] as $key=>$value){
				if($value["amount_type"] == "OUT") 
				{
					$op_amount -=$value['amount'];				
				}  
				else 
				{	$op_amount +=$value["amount"];
					
				}
			}
		}
		//$open_balance_new = str_replace("-","",$balance_new["data"][0]['result']);
		$open_balance_new = $op_amount;
		$open_balance = $op_amount;		
		
		$data = [];
		$amount = 0;
		if($total_count)
		{
			foreach($tansactions as $key=>$value){
				if($value["amount_type"] == "OUT") 
				{
					$amount -=$value['amount'];
					$amt = '<span class="txt_red">'.number_format($value['amount'],2).'<span class="arr_blk"> <img src="http://3.7.44.132/aquacredit/assets/images/rd_c_ar.png"> </span></span>';
				}  
				else 
				{
					$amount +=$value["amount"];
					$amt = '<span class="grn_clr">'.number_format($value['amount'],2).'<span class="arr_blk"> <img src="http://3.7.44.132/aquacredit/assets/images/grn_c_ar.png"> </span></span>';
				}
				$trans = ($value['trans'] != null) ? "(".$value['trans'].")" : "";
				$data[]=[
								date("d-M-Y",strtotime($value['created_on'])),
								'<a href="javascript:void(0);" class="expand_details" title="">'. $value["trans_type"].' '.$trans.' - '.$value["trans_code"].'</a>',
								$amt,
								$value["trans_type"],
								$value['trans'],
								$value['trans_id'],
								$value["amount"]

							];
			}
		}

		$response=[];
		$response["draw"]=$draw;
		$response["start"]=$start;
		$response["length"]=$limit;
		$response["recordsTotal"]=$total_count;
		$response["recordsFiltered"]=$total_count;
		$response["data"]=$data;
		$response["purchased_amt"]=($allcounts["purchased_amt"]==null)? 0 : $allcounts["purchased_amt"];
		$response["goods_amt"]=($allcounts["goods_amt"]==null)? 0 : $allcounts["goods_amt"];
		$response["total_trans_amount"] = $amount;
		$response["open_balance"] = $open_balance;
		$response["op_exists"] = $open_bal_exist;
		$response["open_balance_new"] = $open_balance_new;
		$response["open_balance_date"] = date("d-M-Y",strtotime($opening_date));
		$response["balance_type"] = $balance_type;
		echo json_encode($response);
	}
	public function adminpurchasedetails($ap_id)
	{
		echo $data = $this->Brands_model->getAdminPurchaseProducts($ap_id);
		
	}
	public function delete()
	{
		$bid = $_POST["bid"];		
		echo $response = $this->Brands_model->deleteBrand($bid);
		
	}
}
?>