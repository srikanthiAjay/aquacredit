<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
	 * Author:Ramakrishna
*/
error_reporting(0);
//ini_set('memory_limit', '100M');

class Products_model extends CI_Model 
{
	function __construct()
	{
		parent::__construct();
       	$this->load->library('session');
       	$this->load->database();
	}
	
	function getSearchProducts($skey)
	{
		$this->db->select('*');		
		$this->db->where("(pname LIKE '%$skey%')");		
		$query = $this->db->get('products')->result();
		//echo $this->db->last_query();exit;
		$response = json_decode(json_encode($query), true);
		foreach($response as $row)
		{			
			$data[] = array("pid"=>$row['pid'],"value"=>$row['pname'],"label"=>$row['pname']);
		}
		
		return json_encode($data);
	}
	
	function products_search($limit,$start,$search,$brand,$category,$publish,$col,$dir)    
    {
		$this->db->select("p.pid,p.pname,p.cat_id,c.cat_name,p.brand_id,p.pmrp,p.purchase_amt,p.percentage,p.status");
		$this->db->from('products p');
		$this->db->join('categories c', 'c.cat_id= p.cat_id');
		$this->db->join('brands b', 'b.brand_id= p.brand_id');
		if($brand)
		{
			$this->db->where_in('p.brand_id',$brand);
		}
		if($category)
		{
			$this->db->where_in('p.cat_id',$category);
		}
		if($publish)
		{
			$this->db->where_in('p.status',$publish);
		}
		if($search)
		{
			$this->db->like('p.pname',$search);
			$this->db->or_like('p.hsn',$search);
			$this->db->or_like('b.brand_name',$search);
		}
		$filtered_count = $this->db->count_all_results('', false);
		$this->db->order_by('p.created_on','desc');
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
	//exit;
	function getProductsdata($pid = "")
	{		
		if(!empty($pid))
		{	
			$this->db->select("p.*,b.brand_name");
			$this->db->join('brands b', 'b.brand_id= p.brand_id');
            $data = $this->db->get_where("products p", ['p.pid' => $pid])->row_array();
			
        }else{

            $data = $this->db->get("products")->result();
        }		
		return json_encode(array('status'=>'success','data' => $data));		
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
	
	function getProductsByBrand($bid)
	{
		$response = array();
		$query = $this->db->query("SELECT * FROM `products` WHERE brand_id = $bid");
		if($query->num_rows()>0)
        {
            $data = $query->result(); 
			$response = json_decode(json_encode($data),true);
        }
		return $response;   
	}
	
	// Check Product name
	function check_product_name($pname)
	{
		$query = $this->db->get_where("products", ['pname' => urldecode($pname)])->row_array();
	
		if($query)
		{
			return json_encode(array('status'=>'exists'));
		}else{
			return json_encode(array('status'=>'notexists'));
		}
	}
	function checkproductname_by_qty_weight($post)
	{
		$pname = urldecode($post["prod_name"]); $brand = $post["brand"]; 
		$qty = $post["qty"]; $units = $post["units"];
		$where = " pname LIKE '$pname' AND brand_id = $brand AND qty LIKE '$qty' AND weightage LIKE '$units' ";
		//echo "SELECT * FROM products where $where ";exit;
		$query = $this->db->query("SELECT * FROM products where $where ");		
		$response = $query->row_array();		
		if($response)
		{			
			return json_encode(array('status'=>'exists'));
		}else{
			
			return json_encode(array('status'=>'notexists'));
		}
	}
	
	// Insert Product
	function insert($posts)
	{
		$data = $this->db->insert('products',$posts);
		
		if($data)
		{
			$insert_id = $this->db->insert_id();
			return json_encode(array('status' => 'success','insert_id' => $insert_id));
		}else{
			return json_encode(array('status' => 'fail'));
		}
	}

	// Product Update
	
	function updateProduct($pid,$posts)
	{
		$query = $this->db->update('products', $posts, array('pid'=>$pid));;
		if($query)
		{
			return json_encode(array('status'=>'success'));
		}else{
			return json_encode(array('status'=>'fail'));
		}		
	}
	
	public function deleteProduct($pid)
	{
		$response = $this->db->delete('products', array('pid'=>$pid));
		if($response)
		{
			return json_encode(array("status"=>"success"));
		}else{
			return json_encode(array("status"=>"fail"));
		}
	}
	

}//Main function ends here
?>