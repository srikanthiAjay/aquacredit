<?php defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Crops extends CI_Controller 
{
	function __construct()
	{		
		parent::__construct();
		
		$this->load->library('session');		
		$this->load->model('api/Admin_model');		
		$this->load->model('api/Crops_model');
		
		setlocale(LC_MONETARY, 'en_IN');		
		
		header('Access-Control-Allow-Origin: *');
	}

	//Index function
	public function index($id = "")
	{
		echo $response = $this->Crops_model->getCropsdata($id);
	}
}
?>