<?php defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('display_errors', 0);
class Profile extends CI_Controller 
{
	function __construct()
	{		
		parent::__construct();
		
		$this->load->library('session');		
		$this->load->model('api/Admin_model');
		
		setlocale(LC_MONETARY, 'en_IN');		
		
		header('Access-Control-Allow-Origin: *');
		
	}
	public function index()
	{					
		$adminid = $this->session->userdata("adminid");
		echo $response = $this->Admin_model->getPofiledata($adminid);
		
	}
	
	public function profileupdate()
	{
		$adminid = $this->session->userdata("adminid");
		$url = base_url().'index.php/api/admins/'.$adminid;
		$posts = array('name' => $this->input->post('name'),
			  'mobile' => $this->input->post('mobile'),
			  //'email' => $this->input->post('email')
			);
		echo $response = $this->Admin_model->updateProfile($adminid,$posts);
	}
	
	public function passwordupdate()
	{
		$adminid = $this->session->userdata("adminid");
		
		$curpswd = $this->input->post('curpswd');
		$newpswd = $this->input->post('newpswd');
		$cnfpswd = $this->input->post('cnfpswd');	
		
		$userdata = json_decode($this->Admin_model->getPofiledata($adminid),true);
					
		if(md5($curpswd) != $userdata["data"]["password"])
		{
			$response = array("status" => "curpswdfail");
			echo json_encode($response,true);
			
		}else if($userdata["data"]["password"] == md5($newpswd)){
			
			$response = array("status" => "pswdexists");
			echo json_encode($response,true);
		}
		else
		{	
			$posts = array("password" => md5($newpswd));
			echo $response = $this->Admin_model->updateProfile($adminid,$posts);			
		}			
	}
}
?>