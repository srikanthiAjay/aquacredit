<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
	 * Author:Ramakrishna
*/
error_reporting(0);
ini_set('memory_limit', '100M');

class Withdrawal_model extends CI_Model 
{
	function __construct()
	{
		parent::__construct();
       	$this->load->library('session');
       	$this->load->database();
	}

	function insert($posts)
	{
		$data = $this->db->insert('withdrawals',$posts);
		
		if($data)
		{
			$insert_id = $this->db->insert_id();
			return json_encode(array('status' => 'success','insert_id' => $insert_id));
		}else{
			return json_encode(array('status' => 'fail'));
		}
	}
	function getWithdrawalDetails($wid)
	{
				$this->db->select('w.*,ub.account_no,ub.bank_name,(select crop_location from user_crop_details where cd_id = w.source_crop) as src_crop,(select crop_location from user_crop_details where cd_id = w.desti_crop) as dst_crop,(select user_name from users where user_id = w.user_id) as src_user,(select user_name from users where user_id = w.to_user) as dst_user');
		$this->db->join('user_bank_accounts ub', 'ub.acc_id = w.user_bank','left');
		//$this->db->join('user_crop_details uc', 'uc.cd_id = w.desti_crop','left');
		//$this->db->join('users u', 'u.user_id = w.to_user','left');
		$query = $this->db->get_where("withdrawals w", ['w.wid' => $wid])->result();
		//echo $this->db->last_query();
		return(json_encode(array('status'=>'success','data'=>$query)));
	}
	function getSearchUsers($skey, $all = "")
	{
		$this->db->select('user_id,user_type,user_code,user_name,owner_name,mobile,typeofuser');
		if($all != ""){
			$this->db->where("(user_name LIKE '%$skey%' OR owner_name LIKE '%$skey%' OR mobile LIKE '%$skey%')");
		}else{
			
				$this->db->where("user_type IN ('FARMER') AND (user_name LIKE '%$skey%' OR mobile LIKE '%$skey%') AND typeofuser = '0'");			
		}
		$query = $this->db->get('users')->result();
		//echo $this->db->last_query();exit;
		$response = json_decode(json_encode($query), true);
		foreach($response as $row)
		{
			if($row["user_type"] == "FARMER"){
				$username = $row['user_name'];
				$img_path = 'http://3.7.44.132/aquacredit/assets/images/f_1.png';				
			}else if($row["user_type"] == "NON_FARMER")
			{
				$username = $row['user_name'];
				$img_path = 'http://3.7.44.132/aquacredit/assets/images/f_3.png';				
			}else if($row["user_type"] == "DEALER")
			{
				$username = $row['owner_name'];
				$img_path = 'http://3.7.44.132/aquacredit/assets/images/f_2.png';				
			}
			$data[] = array("user_id"=>$row['user_id'],"value"=>$username,"label"=>$username,"usercode"=>$row['user_code'],"user_type"=>$row["user_type"],"img"=>$img_path,"guest"=>$row['typeofuser'],"guest_mobile" => $row['mobile']);
		}
		
		return json_encode($data);
	}
}
?>