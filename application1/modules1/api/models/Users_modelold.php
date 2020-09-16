<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
	 * Author:Ramakrishna
*/
error_reporting(0);
//ini_set('memory_limit', '100M');

class Users_modelold extends CI_Model 
{
	function __construct()
	{
		parent::__construct();
       	$this->load->library('session');
       	$this->load->database();
	}
	function getUsersdata($uid = "")
	{
		
		if(!empty($uid)){

            $data = $this->db->get_where("users", ['id' => $uid])->row_array();
        }else{

            $data = $this->db->get("users")->result();

        }
		
		return json_encode(array('status'=>'success','data' => $data));
		
	}
	
	function getSearchUsers($skey)
	{
		$this->db->select('id,utype,usercode,uname,mobile');
		$this->db->where("uname LIKE '%$skey%' OR mobile LIKE '%$skey%'");
		$query = $this->db->get('users')->result();
		//echo $this->db->last_query();exit;
		$response = json_decode(json_encode($query), true);
		foreach($response as $row)
		{
			$data[] = array("value"=>$row['id'],"label"=>$row['uname'],"usercode"=>$row['usercode']);
		}
		
		return json_encode($data);
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
	
	// Insert Product
	function insert($posts)
	{
		$data = $this->db->insert('users',$posts);
		
		if($data)
		{
			$insert_id = $this->db->insert_id();
			return json_encode(array('status' => 'success','insert_id' => $insert_id));
		}else{
			return json_encode(array('status' => 'fail'));
		}
	}

	// Product Update
	
	function updateUser($id,$posts)
	{
		$query = $this->db->update('users', $posts, array('id'=>$id));;
		if($query)
		{
			return json_encode(array('status'=>'success'));
		}else{
			return json_encode(array('status'=>'fail'));
		}		
	}
	
	public function deleteUser($id)
	{
		$response = $this->db->delete('users', array('id'=>$id));
		if($response)
		{
			return json_encode(array("status"=>"success"));
		}else{
			return json_encode(array("status"=>"fail"));
		}
	}
	

}//Main function ends here
?>