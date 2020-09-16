<?php error_reporting(0);

defined('BASEPATH') OR exit('No direct script access allowed');

//include($_SERVER['DOCUMENT_ROOT'].'/aquadeals/application/third_party/ImageTool.php');
class Admin extends CI_Controller 
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
	}

	//Index function
	public function index()
	{		
		$data["page_title"] = "Login";
		$config = array(
                'img_url' => base_url() . 'image_for_captcha/',
                'img_path' => 'image_for_captcha/',
                'img_height' => 45,
                'word_length' => 5,
                'img_width' => 150,
                'font_size' => 12
            );
		$captcha = create_captcha($config);
		$this->session->unset_userdata('valuecaptchaCode');
		$this->session->set_userdata('valuecaptchaCode', $captcha['word']);
		$data['captchaImg'] = $captcha['image'];
		$this->load->view('admin/login',$data);
	} 
	
	// User authentication
	public function userAuth()
	{		
		$this->Admin_model->authenticate($_POST['email'], $_POST['password'],$_POST['captcha']);
		
	}
	
	public function dashboard()
	{
		if($this->session->userdata('adminid') == "")   // && $this->session->userdata("adminrole") == 5
		{ 
			redirect('admin');
			
		}
		$data["page_title"] = "Dashboard";
		$this->load->view('admin/dashboard',$data);
	}	
	
	
	public function uploadImage() { 


	  $config['upload_path']   = 'assets/profile_images/'; 

	  $config['allowed_types'] = 'gif|jpg|png'; 

	  $config['max_size']      = 1024;

	  $this->load->library('upload', $config);


	  if ( ! $this->upload->do_upload('image')) {

		 $error = array('error' => $this->upload->display_errors()); 

		 //$this->load->view('admin/profile', $error); 
		 print_r($error);

	  }else { 

		 print_r('Image Uploaded Successfully.');

		 exit;

		} 

   }

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('/admin');
	}

}

?>
