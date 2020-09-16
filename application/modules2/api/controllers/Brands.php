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
			   $data[] = array(	
					'CMP'.$r['brand_id'],
					'<a href="'.base_url().'admin/brands/statement" title="">'.$r["brand_name"].'</a> ',
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

	public function delete()
	{
		$bid = $_POST["bid"];		
		echo $response = $this->Brands_model->deleteBrand($bid);
		
	}
}
?>