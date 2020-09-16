<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
	 * Author:Ramakrishna
*/
error_reporting(1);
//ini_set('memory_limit', '100M');

class Brands_model extends CI_Model 
{
	function __construct()
	{
		parent::__construct();
       	$this->load->library('session');
       	$this->load->database();
	}

	function brands()
	{
		$this->db->select('brand_id,brand_name');
		$this->db->from('brands');
		$query = $this->db->get();
		return $data = $query->result();
		//return json_encode(array('status'=>'success','data' => $data));
	}
	
	function brands_search($limit,$start,$search,$cats,$subcats,$publish,$col,$dir)    
    {
		$this->db->select("brand_id,brand_name,contact_person,contact_mobile,contact_email,brand_cat,brand_subcat,medicine_type,case when status=1 then 'Published' else 'Unpublished' end as status");
		$this->db->from('brands');

		if($cats)
		{
			foreach($cats as $cat)
				$this->db->or_where('find_in_set("'.$cat.'", brand_cat) <> 0');
		}
		if($publish)
		{
			$this->db->where_in('status',$publish);
		}
		if($search)
		{
			$this->db->like('brand_name',$search);
			$this->db->or_like('contact_person',$search);
			$this->db->or_like('brand_id',$search,'after');
		}

		$filtered_count = $this->db->count_all_results('', false);

		$this->db->limit($limit,$start);
		$query=$this->db->get();
		//$str = $this->db->last_query();
		//print_r($str);
		$data=[];
		if($query->num_rows()>0)
        {
        	$data=$query->result_array();
        }

		$data_array = array('count' => $filtered_count, 'data' => $data);
		return $data_array;
		exit;
		
    }
	
	function getBrandsdata($bid = "")
	{
		
		if(!empty($bid)){

            //$data = $this->db->get_where("brands", ['brand_id' => $bid])->row_array();
			$this->db->select('brands.*,brand_bank_accounts.acc_id,brand_bank_accounts.account_no,brand_bank_accounts.full_name,brand_bank_accounts.bank_name,brand_bank_accounts.ifsc,brand_bank_accounts.branch_name');
			$this->db->join('brand_bank_accounts', 'brand_bank_accounts.brand_id = brands.brand_id','left');
			$data = $this->db->get_where("brands", ['brands.brand_id' => $bid])->row_array();
        }else{

            $data = $this->db->get("brands")->result();

        }
		return json_encode(array('status'=>'success','data' => $data));
		
	}
	
	// Check Brand name
	function check_brand_name($bname)
	{
		$query = $this->db->get_where("brands", ['brand_name' => urldecode($bname)])->row_array();
		if($query)
		{
			return json_encode(array('status'=>'exists'));
		}else{
			return json_encode(array('status'=>'notexists'));
		}	
	}	
	// Insert brand
	function insert($posts)
	{
		$data = $this->db->insert('brands',$posts);
		
		if($data)
		{
			$insert_id = $this->db->insert_id();
			return json_encode(array('status' => 'success','insert_id' => $insert_id));
		}else{
			return json_encode(array('status' => 'fail'));
		}
	}
	function brand_account_insert($posts)
	{
		$data = $this->db->insert('brand_bank_accounts',$posts);
		
		if($data)
		{
			$insert_id = $this->db->insert_id();
			return json_encode(array('status' => 'success','insert_id' => $insert_id));
		}else{
			return json_encode(array('status' => 'fail'));
		}
	}
	
	// Brand Update	
	function updateBrand($bid,$posts)
	{
		$query = $this->db->update('brands', $posts, array('brand_id'=>$bid));;
		if($query)
		{
			return json_encode(array('status'=>'success'));
		}else{
			return json_encode(array('status'=>'fail'));
		}		
	}
	// Brand Bank Account Update	
	function brand_account_update($acc_id,$posts)
	{
		$query = $this->db->update('brand_bank_accounts', $posts, array('acc_id'=>$acc_id));
		if($query)
		{
			return json_encode(array('status'=>'success'));
		}else{
			return json_encode(array('status'=>'fail'));
		}		
	}
	
	function posts_search($limit,$start,$search,$utype,$col,$dir)    
    {		
		$response = array();
        $query = $this
                ->db
                ->like('utype',$utype)
                //->or_like('utype',$search)                
                /* ->limit($limit,$start)
                ->order_by($col,$dir) */
                ->get('users');        
		//echo $this->db->last_query();exit;
        if($query->num_rows()>0)
        {
            $data = $query->result(); 
			$response = json_decode(json_encode($data),true);
			/* $response = $this->response($data, REST_Controller::HTTP_OK);
			return $response . PHP_EOL; */
        }
         return $response;
    }
	
	function getBrandsByCategory($cat)
	{
		$query = $this->db->query("SELECT count(brand_id) FROM `brands` WHERE FIND_IN_SET($cat,brand_cat) > 0");
		return $query->num_rows();        
	}
	function getProductsByBrand($bid)
	{
		$response = array();
		$query = $this->db->query("SELECT * FROM `products` WHERE brand_id = $bid");
		//echo $this->db->last_query();exit;
		if($query->num_rows()>0)
        {
            $data = $query->result(); 
			$response = json_decode(json_encode($data),true);
        }
		return $response;   
	}
	
	function getBrandsBySubCategory($subcat_id)
	{
		$response = array();
		$query = $this->db->query("SELECT * FROM `brands` WHERE FIND_IN_SET($subcat_id,brand_subcat) > 0");
		if($query->num_rows()>0)
        {
            $data = $query->result(); 
			$response = json_decode(json_encode($data),true);
        }
         return $response;     
	}
	
	function products_search($limit,$start,$def_search,$search,$brand,$products,$publish,$col,$dir)    
    {
		if($col == 0){ $col = "pid";}
		$where = " status LIKE $publish ";
		if($brand != "")
		{
			$where .= " AND brand_id = $brand";
		}
		if($products != "")
		{
			
			$pvals = implode(",",$products);
			$where .= " AND pid IN ($pvals)";
		}
		
		$response = array();
		$query = $this->db->query("SELECT *,(SELECT count(*) FROM products where $where) as tot_rec FROM products where $where Order by $col $dir limit $start,$limit"); 
		//echo $this->db->last_query();exit;
        if($query->num_rows()>0)
        {
            $data = $query->result(); 
			$response = json_decode(json_encode($data),true);
        }
         return $response;		
	}
	
	function checkproductname_by_qty_weight($post)
	{
		$pname = urldecode($post["prod_name"]); $brand = $post["brand"]; 
		$qty = $post["qty"]; $units = $post["units"];
		$where = " pname LIKE '$pname' AND brand_id = $brand AND qty LIKE '$qty' AND weightage LIKE '$units' ";
		
		$response = array();
		$query = $this->db->query("SELECT * FROM products where $where "); 
		//echo $this->db->last_query();exit;
        if($query->num_rows()>0)
        {
            $data = $query->result(); 
			$response = json_decode(json_encode($data),true);
        }
        return $response;
	}
	    
	
	
	public function getSubcatsByBrand($catid,$values)
	{
		$response = array();
		$query = $this->db->query("SELECT cat_name FROM categories where parent_id = $catid AND cat_id IN ($values)");
		if($query->num_rows()>0)
        {
            $data = $query->result(); 
			$response = json_decode(json_encode($data),true);
        }
		return $response;
	}
	
	public function deleteBrand($bid)
	{

		$response = $this->db->delete('brands', array('brand_id'=>$bid));
		if($response)
		{
			return json_encode(array("status"=>"success"));
		}else{
			return json_encode(array("status"=>"fail"));
		}	
		
	}
	

}//Main function ends here
?>