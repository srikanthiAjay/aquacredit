<?php defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);

class Reports extends CI_Controller 
{
	function __construct()
	{	
        parent::__construct();
        $this->load->library('session');				
		setlocale(LC_MONETARY, 'en_IN');		
		
		header('Access-Control-Allow-Origin: *');
    }

	//Index function
	public function index()
	{
		$data["page_title"] = "Reports";		
		$this->load->view('admin/reports',$data);
	} 		
}

?>