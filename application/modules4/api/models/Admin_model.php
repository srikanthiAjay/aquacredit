<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
	 * Author:Ramakrishna
*/
error_reporting(0);
ini_set('memory_limit', '100M');

class Admin_model extends CI_Model 
{
	function __construct()
	{
		parent::__construct();
       	$this->load->library('session');
       	$this->load->database();
	}

	function checkEmail()
	{
		$email =$_POST["email"];
		$query = $this->db->get_where('admin_users', array(
            'email' => $email,
        ));

        echo $count = $query->num_rows();
	}
	
	function authenticate($email, $pwrd, $captcha_insert)
	{
		//$captcha_insert = $this->input->post('captcha');
		$contain_sess_captcha = $this->session->userdata('valuecaptchaCode');
	//	if ($captcha_insert === $contain_sess_captcha) {
			//echo 'Success';
			$query = $this->db->query("SELECT * FROM admin_users WHERE  email=".$this->db->escape($email)." and  password=".$this->db->escape(md5($pwrd))."");
			$result = $query->result();
			if($query->num_rows() > 0) 
			{
				if($result[0]->status == 1)
				{
					//$this->load->library("session");
					$this->session->set_userdata("adminname",$result[0]->name);
					$this->session->set_userdata("adminid",$result[0]->id);
					$this->session->set_userdata("adminrole",$result[0]->role);
					$this->session->set_userdata("branch_id",$result[0]->branch_id);
					
					// redirect('/home');
					echo json_encode(array("status"=>"success",'role'=>$result[0]->role));
				}
				else
				{
				 //    			$this->session->set_flashdata('flsh_msg',' <div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> You are not active user.Please contact super admin</div>');
								// redirect(base_url().'/admin');
					echo json_encode(array("status"=>"error",'message'=>' You are not active user.Please contact super admin'));
				}
			
			} 
			else 
			{
				// redirect('/admin');
				// $this->session->set_flashdata('flsh_msg',' <div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> The username or password you entered is incorrect</div>');
				// 		redirect(base_url().'/admin');
				echo json_encode(array("status"=>"error",'message'=>' The username or password you entered is incorrect'));
			}
		/* } else {
			
			//echo 'Failure';
			echo json_encode(array("status"=>"error",'message'=>' Enter Valid Captcha'));
		} */		
    }
	
	function getPofiledata($adminid)
	{
		$query = $this->db->query("SELECT * FROM admin_users WHERE id = $adminid");
		if($query->num_rows() >0)
        {
			return json_encode(array('status'=>'success','data' => $query->row_array()));
		}else{
			return json_encode(array('status'=>'error','data' => array()));
		}
	}
	
	function updateProfile($adminid,$posts)
	{
		$query = $this->db->update('admin_users', $posts, array('id'=>$adminid));;
		if($query)
		{
			return json_encode(array('status'=>'success'));
		}else{
			return json_encode(array('status'=>'fail'));
		}
	}

}//Main function ends here
?>