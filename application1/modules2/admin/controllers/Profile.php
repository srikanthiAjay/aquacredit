<?php defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('display_errors', 0);
//include($_SERVER['DOCUMENT_ROOT'].'/aquadeals/application/third_party/ImageTool.php');
class Profile extends CI_Controller 
{
	function __construct()
	{		
		parent::__construct();
		
		$this->load->library('session');		
		$this->load->model('api/Admin_model');	
		$this->load->helper('form');
		$this->load->helper('captcha');
		$this->load->helper('url');
		
		setlocale(LC_MONETARY, 'en_IN');		
		
		header('Access-Control-Allow-Origin: *');
		if($this->session->userdata('adminid') == "")
		{ 
			redirect('admin/login');			
		}
	}
	public function index()
	{		
		$data["page_title"] = "Profile";				
		$adminid = $this->session->userdata("adminid");		
		$this->load->view('admin/profile',$data);
	}
	/* public function logout()
	{
		$this->session->sess_destroy();
		redirect('/admin');
	} */
	public function check_last_url()
	{
		
		$this->db->where('id', $this->session->userdata('adminid'));
		$q = $this->db->get('admin_users');
		$url = $q->row();
		if($url->prev_url!="") {
			redirect($url->prev_url);
		}
		else
		{ 
			redirect('admin/profile');
			
		}
	}
	public function logout()
	{
		//$update = $this->db->update('prev_url')
		$last_url = ($this->input->get('last_url')) ? $this->input->get('last_url') : '';
		$this->db->set('prev_url', $last_url);
		$this->db->where('id', $this->session->userdata('adminid'));
		$this->db->update('admin_users');

		$this->session->sess_destroy();
		//$url = ($this->input->get('last_url')) ? '/admin?last_url='.$this->input->get('last_url') : '/admin';
		$url = '/admin';
		redirect($url);
	}
}
?>