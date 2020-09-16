<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
	 * Author:Ramakrishna
*/
error_reporting(0);
ini_set('memory_limit', '100M');

class Subcategories_model extends CI_Model 
{
	function __construct()
	{
		parent::__construct();
       	$this->load->library('session');
       	$this->load->database();
	}
	
	function getSubCategories($id = "")
	{
		if(!empty($id)){
            
            $data = $this->db->get_where("categories", ['level' => 2,'parent_id' => $id])->result();
			
        }else{

			$data = $this->db->get_where("categories", ['level' => 2])->result();
        }  
		return json_encode(array('status'=>'success','data' => $data));
	}

}//Main function ends here
?>