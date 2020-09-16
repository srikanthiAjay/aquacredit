<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
	 * Author:Ramakrishna
*/
error_reporting(0);
ini_set('memory_limit', '100M');

class Categories_model extends CI_Model 
{
	function __construct()
	{
		parent::__construct();
       	$this->load->library('session');
       	$this->load->database();
	}
	
	function getCategories($id = "")
	{
		if(!empty($id)){
			 
			$data = $this->db->get_where("categories", ['cat_id' => $id])->row_array();
		}else
		{
			$data = $this->db->get_where("categories", ['level' => 1])->result();
		}
		return json_encode(array('status'=>'success','data' => $data));
		
		/* if($query->num_rows() >0)
        {
			return json_encode(array('status'=>'success','data' => $query->row_array()));
		}else{
			return json_encode(array('status'=>'error','data' => array()));
		} */
	}
	
	// Check Category name
	function check_category_name($catname)
	{
		$query = $this->db->get_where("categories", ['cat_name' => urldecode($catname)])->row_array();
	
		if($query)
		{
			return json_encode(array('status'=>'exists'));
		}else{
			return json_encode(array('status'=>'notexists'));
		}	
	}
	
	function insert($posts)
	{
		$data = $this->db->insert('categories',$posts);
		
		if($data)
		{
			$insert_id = $this->db->insert_id();
			return json_encode(array('status' => 'success','insert_id' => $insert_id));
		}else{
			return json_encode(array('status' => 'fail'));
		}
	}

	function categoryWiseCount()
	{
		//echo "srikanthi"; exit;
		$this->db->select("c.cat_id,c.cat_name,COUNT(b.brand_id) as brands");
		$this->db->from("categories c");
		$this->db->join("brands b","FIND_IN_SET(c.cat_id,b.brand_cat)");
		$this->db->where("c.level",'1');
		$this->db->where("c.status",'1');
		$this->db->group_by("c.cat_id");
		$query = $this->db->get();
		$data = $query->result(); 
		return $data;
	}

}//Main function ends here
?>