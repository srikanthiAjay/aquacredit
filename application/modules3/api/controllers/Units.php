<?php defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Units extends CI_Controller 
{
	function __construct()
	{		
		parent::__construct();
		
		$this->load->library('session');		
		$this->load->model('api/Admin_model');		
		$this->load->model('api/Units_model');
		
		setlocale(LC_MONETARY, 'en_IN');		
		
		header('Access-Control-Allow-Origin: *');
		
	}

	//Index function
	public function index($uid = "")
	{
		echo $response = $this->Units_model->getUnitsdata($uid);
	}
}

?>
