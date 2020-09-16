<?php

/**
 * SMS Library
 *
 * All the SMS configured and sending form here
 *
 * @category   SMS
 * @author     Rama Krishna <ramakrishna_nyros@yahoo.com>,Sankar<sankar_nyros@yahoo.com>,Phani<phani_nyros@yahoo.com>,Chandra Sekhar<chandrasekhar_nyros@yahoo.com>
 * @copyright  2016 Nyros Technologies
 * @version    1
 * @link       http://www.aquadeals.com
 */

class SMS
{

	
	//OTP message
	public function otpSMS($otp, $mobile,$type)
	{
		$smscontent = $this->getValue('ad_messages','message','action','otp');
       	        $smscontent = str_replace("&otp&",$otp,$smscontent);
		$smscontent = urlencode($smscontent);
		$res = $this->send($smscontent,$mobile,$type);
		return $res;
	}
    
    
    	//Owner profile complete alert
	public function owner_reg_cmplt_proAlert($name,$mobile)
	{
		$name = ucfirst($name);
		$smscontent = "Dear $name, please complete your profile information at AquaDeals Partner App.";
		$smscontent = urlencode($smscontent);
		$res = $this->send($smscontent,$mobile,1);
		return $res;
	}    
       
       //manufacturer profile complete alert
	public function manuf_reg_cmplt_proAlert($name,$mobile)
	{
		$name = ucfirst($name);
		$smscontent = "Dear $name, please complete your profile information at AquaDeals Partner App.";
		$smscontent = urlencode($smscontent);
		$res = $this->send($smscontent,$mobile,1);
		return $res;
	}    
       
	
	//User successful registration message
	public function user_reg_suc_sms($name, $email, $password, $mobile)
	{
		$CI = & get_instance();
		$name = ucfirst($name);
		$helpline_qry= $CI->db->query("SELECT value FROM `ad_settings` WHERE `key`='aquadeals_helpline'");
		$ad_helpline = $helpline_qry->row('value');
        	$smscontent = $this->getValue('ad_messages','message','action','userRegistration');
        	$smscontent = str_replace("&name&",$name,$smscontent);
        	$smscontent = str_replace("&email&",$mobile,$smscontent);
        	$smscontent = str_replace("&password&",$password,$smscontent);
        	$smscontent = str_replace("&aquadealHelpline&",$ad_helpline,$smscontent);
        	$smscontent = urlencode($smscontent);
		$res = $this->send($smscontent,$mobile,0);
		return $res;	
	}
	
	

	//Owner successful registration message
	public function owner_reg_suc_sms($name, $email, $password, $mobile)
	{     
		$CI = & get_instance();
		$name = ucfirst($name);
		$shelpline_qry= $CI->db->query("SELECT value FROM `ad_settings` WHERE `key`='aquadeals_seller_helpline'");
		$sad_helpline = $shelpline_qry->row('value');
		$smscontent = $this->getValue('ad_messages','message','action','ownerRegistration');
		$smscontent = str_replace("&name&",$name,$smscontent);
		$smscontent = str_replace("&mobile&",$mobile,$smscontent);
        	$smscontent = str_replace("&password&",$password,$smscontent);
        	$smscontent = str_replace("&aquadealHelpline&",$sad_helpline,$smscontent);
		$smscontent = urlencode($smscontent);
		$res = $this->send($smscontent,$mobile,1);
		return $res;	
	}
	//Owner successful registration message
	public function manuf_reg_suc_sms($name, $email, $password, $mobile)
	{     
		$name = ucfirst($name);
		$shelpline_qry= $CI->db->query("SELECT value FROM `ad_settings` WHERE `key`='aquadeals_seller_helpline'");
		$sad_helpline = $shelpline_qry->row('value');
		$smscontent = $this->getValue('ad_messages','message','action','manuf_reg');
		
		$smscontent = str_replace("&name&",$name,$smscontent);
		$smscontent = str_replace("&email&",$mobile,$smscontent);
        	$smscontent = str_replace("&password&",$password,$smscontent);
        	$smscontent = str_replace("&aquadealHelpline&",$sad_helpline,$smscontent);
		$smscontent = urlencode($smscontent);
		$res = $this->send($smscontent,$mobile,1);
		return $res;		
	}
	
	
	//Owner/User created at admin successful message
	public function manuf_create_suc_sms($name, $email, $pwd, $mobile)
	{     
		$CI = & get_instance();
		$name = ucfirst($name);
		$shelpline_qry= $CI->db->query("SELECT value FROM `ad_settings` WHERE `key`='aquadeals_seller_helpline'");
		$sad_helpline = $shelpline_qry->row('value');
		$smscontent = $this->getValue('ad_messages','message','action','Manufacturer Registration');
		$smscontent = str_replace("&name&",$name,$smscontent);
		$smscontent = str_replace("&email&",$email,$smscontent);
		$smscontent = str_replace("&password&",$pwd,$smscontent);
		$smscontent = str_replace("&aquadealHelpline&",$sad_helpline,$smscontent);
		$smscontent = urlencode($smscontent);
		$res = $this->send($smscontent,$mobile,1);
		return $res;	
	}
	
	
	//Manufacturer created at admin 
	public function users_create_suc_sms($name, $email, $pwd, $app, $mobile)
	{     
		$CI = & get_instance();
		$name = ucfirst($name);
		$smscontent = $this->getValue('ad_messages','message','action','usersRegistrationAtAdmin');
		if($app=="Aquadeals"){$app1="AquaDeals App";}
		if($app!="Aquadeals"){$app1="AquaDeals Partner App";}
		$smscontent = str_replace("&username&",$name,$smscontent);
		$smscontent = str_replace("&app&",$app1,$smscontent);
		$smscontent = str_replace("&email&",$email,$smscontent);
		$smscontent = str_replace("&pwd&",$pwd,$smscontent);
		$smscontent = urlencode($smscontent);
		$res = $this->send($smscontent,$mobile,1);
		return $res;	
	}
	
	
	//New admin operator created at admin
	public function NewAdminUserCreation($email, $pwd, $name, $mobile)
	{     
		$smscontent = $this->getValue('ad_messages','message','action','NewAdminUserCreation');
		$smscontent = str_replace("&username&",$name,$smscontent);
		$smscontent = str_replace("&email&",$email,$smscontent);
		$smscontent = str_replace("&pwd&",$pwd,$smscontent);
		$smscontent = urlencode($smscontent);
		$res = $this->send($smscontent,$mobile,0);
		return $res;	
	}
	
	//Owner approval message
	public function seller_reg_appr_sms($name, $mobile)
	{     
		$CI = & get_instance();
		$helpline_qry= $CI->db->query("SELECT value FROM `ad_settings` WHERE `key`='aquadeals_seller_helpline'");
		$ad_helpline = $helpline_qry->row('value');
		$smscontent = $this->getValue('ad_messages','message','action','ownerApprove');
		$smscontent = str_replace("&name&",$name,$smscontent);
		$smscontent = str_replace("&aquadealHelpline&",$ad_helpline,$smscontent);
		$smscontent = urlencode($smscontent);
		$res = $this->send($smscontent,$mobile,1);
		return $res;	
	}
	
	//Owner approval message
	public function manuf_reg_appr_sms($name, $mobile)
	{     
		$CI = & get_instance();
		$helpline_qry= $CI->db->query("SELECT value FROM `ad_settings` WHERE `key`='aquadeals_seller_helpline'");
		$ad_helpline = $helpline_qry->row('value');
		$smscontent = $this->getValue('ad_messages','message','action','ManufacturerApprove');
		$smscontent = str_replace("&name&",$name,$smscontent);
		$smscontent = str_replace("&aquadealHelpline&",$ad_helpline,$smscontent);
		$smscontent = urlencode($smscontent);
		$res = $this->send($smscontent,$mobile,1);
		return $res;	
	}
	
	
	//Owner rejected message
	public function seller_reject($name, $mobile, $reason)
	{  
		$CI = & get_instance();
		$helpline_qry= $CI->db->query("SELECT value FROM `ad_settings` WHERE `key`='aquadeals_seller_helpline'");
		$ad_helpline = $helpline_qry->row('value');
		$smscontent = $this->getValue('ad_messages','message','action','ownerReject');
		$smscontent = str_replace("&name&",$name,$smscontent);
		$smscontent = str_replace("&reason&",$reason,$smscontent);
		$smscontent = str_replace("&aquadealHelpline&",$ad_helpline,$smscontent);
		$smscontent = urlencode($smscontent);
		$res = $this->send($smscontent,$mobile,1);
		
		return $res;	
	}

//Manufacturer rejected message
	public function manuf_reject($name, $mobile, $reason)
	{  
		$CI = & get_instance();
		$helpline_qry= $CI->db->query("SELECT value FROM `ad_settings` WHERE `key`='aquadeals_seller_helpline'");
		$ad_helpline = $helpline_qry->row('value');
		$smscontent = $this->getValue('ad_messages','message','action','Manufacturer Reject');
		$smscontent = str_replace("&name&",$name,$smscontent);
		$smscontent = str_replace("&reason&",$reason,$smscontent);
		$smscontent = str_replace("&aquadealHelpline&",$ad_helpline,$smscontent);
		$smscontent = urlencode($smscontent);
		$res = $this->send($smscontent,$mobile,1);
		return $res;	
	}

	

	//Owner approval message
	public function owner_approve_sms($name, $mobile)
	{
		$CI = & get_instance();
		$helpline_qry= $CI->db->query("SELECT value FROM `ad_settings` WHERE `key`='aquadeals_seller_helpline'");
		$ad_helpline = $helpline_qry->row('value');
		$smscontent = $this->getValue('ad_messages','message','action','ownerApprove');
		$smscontent = str_replace("&name&",$name,$smscontent);
		$smscontent = str_replace("&aquadealHelpline&",$ad_helpline,$smscontent);
		$smscontent = urlencode($smscontent);
		$res = $this->send($smscontent,$mobile,1);
		return $res;
	}
	
	//Owner reject message
	public function owner_reject_sms($name, $mobile)
	{
		$CI = & get_instance();
		$helpline_qry= $CI->db->query("SELECT value FROM `ad_settings` WHERE `key`='aquadeals_seller_helpline'");
		$ad_helpline = $helpline_qry->row('value');
		$smscontent = $this->getValue('ad_messages','message','action','ownerReject');
                $smscontent = str_replace("&name&",$name,$smscontent);
                $smscontent = str_replace("&aquadealHelpline&",$ad_helpline,$smscontent);
                $smscontent = urlencode($smscontent);
		$res = $this->send($smscontent,$mobile,1);
		return $res;
	}
	
	
	//send message when aquacash is added to user
	public function sendAquacash_add($name,$mobile,$amt)
	{
	        $smscontent = $this->getValue('ad_messages','message','action','aquacash_add');
                $smscontent = str_replace("&name&",ucfirst($name),$smscontent);
                $smscontent = " Rs $amt AquaCash credited to your account.";
                $smscontent = urlencode($smscontent);
                $res = $this->send($smscontent,$mobile,0);
		return $res;
	}
	
	
	//Send custom messages to users
	public function sendCustomMsg($text, $mobile,$type)
	{
		$smscontent = urlencode($text);
		$res = $this->send($smscontent,$mobile,$type);
		return $res;
	}
	
	
	public function rating_notify($mobile,$name,$seller_name,$specie,$booking_id)
	{
		$smscontent = $this->getValue('ad_messages','message','action','sellerRatingNotification');
		$smscontent = str_replace("&name&",$name,$smscontent);
		$smscontent = str_replace("&seller&",$seller_name,$smscontent);
		$smscontent = str_replace("&speice&",$specie,$smscontent);
		$smscontent = str_replace("&bookingId&",$booking_id,$smscontent);
		$smscontent = urlencode($smscontent);
		$res = $this->send($smscontent,$mobile,0);
		return $res;
	}
	
	
	public function dealBookConfiramtion($bookedId)
	{
	    	$CI = & get_instance();
	    	
	    	$query = $CI->db->query("SELECT * from ad_bookings where id = $bookedId");
	    	//Booking details
	      	$bookData = $query->row();
	      	$user_id =  $bookData->user_id;
	      	$vendor_id =  $bookData->seller_id;
	      	$booking_id =  $bookData->booking_id;
	      	$species_id =  $bookData->species_id;
	      	$quantity =  $bookData->quantity;
	    	$pickupDate =  date('d-m-Y', strtotime($bookData->delivery_date));
	    	$pl_size = $bookData->pl_size;
	    	$salinity = $bookData->salinity;
	    	$specie = ucfirst($this->getValue('ad_species','type','id',$species_id));
	    	
	    	//Owner details
	    	$ownername = ucfirst($this->getValue('ad_sellers','contact_person','id',$vendor_id));
	      	$ownermobile = $this->getValue('ad_sellers','mobile','id',$vendor_id);
	      	$organization = ucfirst($this->getValue('ad_sellers','seller_name','id',$vendor_id));
		
		//User details
		$username = ucfirst($this->getValue('ad_users','name','id',$user_id));
	      	$usermobile = $this->getValue('ad_users','mobile','id',$user_id);
		$user_addr = $this->getValue('ad_users','city','id',$user_id);
		
		//Customer care details
		$helpline_qry= $CI->db->query("SELECT value FROM `ad_settings` WHERE `key`='aquadeals_helpline'");
		$ad_helpline = $helpline_qry->row('value');
		$shelpline_qry= $CI->db->query("SELECT value FROM `ad_settings` WHERE `key`='aquadeals_seller_helpline'");
		$sad_helpline = $shelpline_qry->row('value');
		
		//Send sms to user    
		$smscontent = $this->getValue('ad_messages','message','action','Deal booking - User');
		$smscontent = str_replace("&name&",$username,$smscontent);
		$smscontent = str_replace("&book_id&",$booking_id,$smscontent);
		$smscontent = str_replace("&specie&",$specie,$smscontent);
		$smscontent = str_replace("&quantity&",$quantity,$smscontent);
		$smscontent = str_replace("&pickupDate&",$pickupDate,$smscontent);
		$smscontent = str_replace("&hatcheryname&",$organization,$smscontent);
		$smscontent = str_replace("&hatcheryContact&",$ownermobile,$smscontent);
		$smscontent = str_replace("&aquadealHelpline&",$ad_helpline,$smscontent);
		$smscontent = urlencode($smscontent);
		$res = $this->send($smscontent,$usermobile,0);
		
		
		//Send sms to owner
                $Osmscontent = $this->getValue('ad_messages','message','action','Deal booking - Owner');
		$Osmscontent = str_replace("&name&",$ownername,$Osmscontent);
		$Osmscontent = str_replace("&specie&",$specie,$Osmscontent);
		$Osmscontent = str_replace("&username&",$username,$Osmscontent);
		$Osmscontent = str_replace("&book_id&",$booking_id,$Osmscontent);
		$Osmscontent = str_replace("&quantity&",$quantity,$Osmscontent);
		$Osmscontent = str_replace("&pickupDate&",$pickupDate,$Osmscontent);
		$Osmscontent = str_replace("&plsize&",$pl_size,$Osmscontent);
		$Osmscontent = str_replace("&salinity&",$salinity,$Osmscontent);
		$Osmscontent = str_replace("&usermobile&",$usermobile,$Osmscontent);
		$Osmscontent = str_replace("&aquadealHelpline&",$sad_helpline,$Osmscontent);
		$Osmscontent = str_replace("&useraddress&",$user_addr,$Osmscontent);
		$Osmscontent = urlencode($Osmscontent);
		$res = $this->send($Osmscontent,$ownermobile,1);
		
		$squery = $CI->db->query("SELECT * from ad_access_sellers where seller_id = $vendor_id and status=1 and role=1");
		
		if($squery->num_rows() > 0)
		{
		        foreach($squery->result() as $row)
		        {
		                $supervisor = $this->getValue('ad_messages','message','action','Deal booking - Supervisor');
		                $supervisor = str_replace("&name&",$row->name,$supervisor);
		                $supervisor = str_replace("&specie&",$specie,$supervisor);
		                $supervisor = str_replace("&username&",$username,$supervisor);
		                $supervisor = str_replace("&book_id&",$booking_id,$supervisor);
		                $supervisor = str_replace("&quantity&",$quantity,$supervisor);
		                $supervisor = str_replace("&pickupDate&",$pickupDate,$supervisor);
		                $supervisor = str_replace("&plsize&",$pl_size,$supervisor);
		                $supervisor = str_replace("&salinity&",$salinity,$supervisor);
		                $supervisor = str_replace("&usermobile&",$usermobile,$supervisor);
		                $supervisor = str_replace("&aquadealHelpline&",$sad_helpline,$supervisor);
		                $supervisor = str_replace("&useraddress&",$user_addr,$supervisor);
		                $supervisor = urlencode($supervisor);
		                $res = $this->send($supervisor,$row->mobile,1);
		        }
		}
		
		//Send sms to supervisor
		
		return $res;
	}
	
	
	public function productDealBookConfiramtion($bookedId)
	{
	    	$CI = & get_instance();

                $query = $CI->db->query("SELECT * from ad_feed_bookings where id = $bookedId");
                //Deal details
                $bookData = $query->row();
                $user_id =  $bookData->user_id;
                $manuf_id =  $bookData->seller_id;
                $booking_id =  $bookData->booking_id;
                $deal_type_id =  $bookData->deal_type_id;
                $category_id =  $bookData->category_id;
                $quantity =  $bookData->quantity;
                 $dealid =  $bookData->deal_id;
                $pid =  $this->getValue('ad_manuf_deals','product_id','id',$dealid);
               
                $deal_type = ucfirst($this->getValue('ad_deal_types','deal_type','id',$deal_type_id));
                $product = ucfirst($this->getValue('ad_manuf_products','title','id',$pid));
                $cat = ucfirst($this->getValue('ad_deal_categories','category_name','id',$category_id));
                $category = $deal_type.'('.$cat.')';

                //User Details
                $username = ucfirst($this->getValue('ad_users','name','id',$user_id));
                $usermobile = $this->getValue('ad_users','mobile','id',$user_id);
                $user_addr = $this->getValue('ad_users','city','id',$user_id);

                //Manufacturer details
                $manufcontact = ucfirst($this->getValue('ad_sellers','contact_person','id',$manuf_id));
                $manufmobile = $this->getValue('ad_sellers','mobile','id',$manuf_id);
                $manuf_name = ucfirst($this->getValue('ad_sellers','seller_name','id',$manuf_id));
                $notify_deals = $this->getValue('ad_sellers','notify_deals','id',$manuf_id);

                //Cusomor care
                $helpline_qry= $CI->db->query("SELECT value FROM `ad_settings` WHERE `key`='aquadeals_helpline'");
                $ad_helpline = $helpline_qry->row('value');
                $shelpline_qry= $CI->db->query("SELECT value FROM `ad_settings` WHERE `key`='aquadeals_seller_helpline'");
                $sad_helpline = $shelpline_qry->row('value');
                $pro_id = $this->getValue('ad_manuf_deals','product_id','id',$dealid);
                $proname = $this->getValue('ad_manuf_products','title','id',$pro_id);

                //Send sms to user    
                $smscontent = $this->getValue('ad_messages','message','action','Product Deal booking - User');
                $smscontent = str_replace("&name&",$username,$smscontent);
                $smscontent = str_replace("&book_id&",$booking_id,$smscontent);
                $smscontent = str_replace("&category&",$product,$smscontent);
                $smscontent = str_replace("&quantity&",$quantity,$smscontent);
                $smscontent = str_replace("&manuf_mobile&",$manufmobile,$smscontent);
                $smscontent = str_replace("&aquadealHelpline&",$ad_helpline,$smscontent);
                $smscontent = urlencode($smscontent);
                $res = $this->send($smscontent,$usermobile,0);

                //Send sms to owner
                $Osmscontent = $this->getValue('ad_messages','message','action','Product Deal booking - Manufacturer');
                $Osmscontent = str_replace("&name&",$manufcontact,$Osmscontent);
                $Osmscontent = str_replace("&category&",$product,$Osmscontent);
                $Osmscontent = str_replace("&username&",$username,$Osmscontent);
                $Osmscontent = str_replace("&book_id&",$booking_id,$Osmscontent);
                $Osmscontent = str_replace("&quantity&",$quantity,$Osmscontent);
                $Osmscontent = str_replace("&usermobile&",$usermobile,$Osmscontent);
                $Osmscontent = str_replace("&aquadealHelpline&",$sad_helpline,$Osmscontent);
                $Osmscontent = str_replace("&useraddress&",$user_addr,$Osmscontent);
                $Osmscontent = urlencode($Osmscontent);
                if($notify_deals ==1)
                {
                	$res = $this->send($Osmscontent,$manufmobile,1);
                }
                

                //Send sms to supervis
                $squery = $CI->db->query("SELECT * from ad_access_sellers where seller_id = $manuf_id and status=1 and  role=1");
                
                if($squery->num_rows() > 0)
                {
                        foreach($squery->result() as $row)
                        {
                                $supervisor = $this->getValue('ad_messages','message','action','Product Deal booking - Supervisor');
                                $supervisor = str_replace("&name&",$row->name,$supervisor);
                                $supervisor = str_replace("&category&",$product,$supervisor);
                                $supervisor = str_replace("&username&",$username,$supervisor);
                                $supervisor = str_replace("&book_id&",$booking_id,$supervisor);
                                $supervisor = str_replace("&quantity&",$quantity,$supervisor);
                                $supervisor = str_replace("&usermobile&",$usermobile,$supervisor);
                                $supervisor = str_replace("&aquadealHelpline&",$sad_helpline,$supervisor);
                                $supervisor = str_replace("&useraddress&",$user_addr,$supervisor);
                                $supervisor = urlencode($supervisor);
                                $res = $this->send($supervisor,$row->mobile,1);
                        }
                }
                return $res;
	}
	
	
	// Notify user, owner when booking is cancelled
	public function BookingCancellation($bookedId)
	{
		$CI = & get_instance();
	    	$query = $CI->db->query("SELECT booking_id,user_id,seller_id,species_id,quantity,cancel_reason from ad_bookings where id = $bookedId");
	    	//Booking details
	      	$user_id =  $query->row('user_id');
	      	$vendor_id =  $query->row('seller_id');
	      	$booking_id =  $query->row('booking_id');
	      	$species_id =  $query->row('species_id');
	      	$quantity =  $query->row('quantity');
		$specie = $this->getValue('ad_species','type','id',$species_id);
		$creason='';
                if(is_numeric($query->row('cancel_reason')))
                {
                        $creason = $this->getValue('ad_cancel_reasons','reason','id',$query->row('cancel_reason'));
                }
                else 
                { 
                        if($query->row('cancel_reason')!='')
                        {
                                $creason = ucfirst($query->row('cancel_reason'));
                        }
                        else 
                        { 
                                $creason = "N/A";
                        }
                }
		//User Details
	      	$username = $this->getValue('ad_users','name','id',$user_id);
	      	$usermobile = $this->getValue('ad_users','mobile','id',$user_id);
		
		//Seller Details
		$ownername = $this->getValue('ad_sellers','contact_person','id',$vendor_id);
	      	$ownermobile = $this->getValue('ad_sellers','mobile','id',$vendor_id);
	      	$helpline_qry= $CI->db->query("SELECT value FROM `ad_settings` WHERE `key`='aquadeals_helpline'");
                $ad_helpline = $helpline_qry->row('value');
                $shelpline_qry= $CI->db->query("SELECT value FROM `ad_settings` WHERE `key`='aquadeals_seller_helpline'");
                $sad_helpline = $shelpline_qry->row('value');
	      	//Send sms to user    
		$smscontent = $this->getValue('ad_messages','message','action','Booking cancelled - User');
		$smscontent = str_replace("&name&",$username,$smscontent);
		$smscontent = str_replace("&book_id&",$booking_id,$smscontent);
		$smscontent = str_replace("&specie&",$specie,$smscontent);
		$smscontent = str_replace("&quantity&",$quantity,$smscontent);
		$smscontent = str_replace("&reason&",$creason,$smscontent);
		$smscontent = str_replace("&aquadealHelpline&",$ad_helpline,$smscontent);
		$smscontent = urlencode($smscontent);
		$res = $this->send($smscontent,$usermobile,0);
		
		//Send sms to owner
		$Osmscontent = $this->getValue('ad_messages','message','action','Booking cancelled - Owner');
		$Osmscontent = str_replace("&name&",$ownername,$Osmscontent);
		$Osmscontent = str_replace("&book_id&",$booking_id,$Osmscontent);
		$Osmscontent = str_replace("&quantity&",$quantity,$Osmscontent);
		$Osmscontent = str_replace("&specie&",$specie,$Osmscontent);
		$Osmscontent = str_replace("&username&",$username,$Osmscontent);
		$Osmscontent = str_replace("&reason&",$creason,$Osmscontent);
		$Osmscontent = str_replace("&aquadealHelpline&",$sad_helpline,$Osmscontent);
		$Osmscontent = urlencode($Osmscontent);
		$res = $this->send($Osmscontent,$ownermobile,1);
		
		//Send sms to supervisor
		$squery = $CI->db->query("SELECT * from ad_access_sellers where seller_id = $vendor_id and status=1 and  role=1");
		if($squery->num_rows() > 0)
		{
		        foreach($squery->result() as $row)
		        {
		                $Ssmscontent = $this->getValue('ad_messages','message','action','Booking cancelled - Supervisor');
                                $Ssmscontent = str_replace("&name&",$row->name,$Ssmscontent);
                                $Ssmscontent = str_replace("&book_id&",$booking_id,$Ssmscontent);
                                $Ssmscontent = str_replace("&quantity&",$quantity,$Ssmscontent);
                                $Ssmscontent = str_replace("&specie&",$specie,$Ssmscontent);
                                $Ssmscontent = str_replace("&username&",$username,$Ssmscontent);
                                $Ssmscontent = str_replace("&reason&",$creason,$Ssmscontent);
                                $Ssmscontent = str_replace("&aquadealHelpline&",$sad_helpline,$Ssmscontent);
                                $Ssmscontent = urlencode($Osmscontent);
                                $res = $this->send($Ssmscontent,$row->mobile,1);
		        }
		}
		
		//Send sms to access person
		$assignto = $this->getValue('ad_bookings','assigned_to','id',$bookedId);
		if($assignto!=0)
		{
                        //Access person details
                        $assignid = $this->getValue('ad_bookings','assigned_id','id',$bookedId);
                        $aname = $this->getValue('ad_access_sellers','name','id',$assignid);
                        $amobile = $this->getValue('ad_access_sellers','mobile','id',$assignid);
                        
                        //Sms to access person
                        $Asmscontent = $this->getValue('ad_messages','message','action','Booking cancelled - Access');
                        $Asmscontent = str_replace("&name&",$ownername,$Asmscontent);
                        $Asmscontent = str_replace("&book_id&",$booking_id,$Asmscontent);
                        $Asmscontent = str_replace("&quantity&",$quantity,$Asmscontent);
                        $Asmscontent = str_replace("&specie&",$specie,$Asmscontent);
                        $Asmscontent = str_replace("&username&",$username,$Asmscontent);
                        $Asmscontent = str_replace("&reason&",$creason,$Asmscontent);
                        $Asmscontent = str_replace("&aquadealHelpline&",$sad_helpline,$Asmscontent);
                        $Asmscontent = urlencode($Asmscontent);
                        $res = $this->send($Asmscontent,$amobile,1);
		}
		return 1;
		
		
	}
	
        //sending notification when deal is promoted
        function deal_promo($type,$dealid,$start,$end)
        {
                //Promoted seed deal
                if($type==0)
                {
                        $CI = & get_instance();
                        $deal_exe = $CI->db->query("SELECT ad_vendor_deals.deal_id,ad_vendor_deals.seller_id,ad_vendor_deals.price, ad_vendor_deals.discount_price, ad_vendor_deals.available_qty, ad_sellers.contact_person, ad_sellers.mobile,ad_species.type FROM `ad_vendor_deals` INNER JOIN ad_sellers on ad_sellers.id = ad_vendor_deals.seller_id INNER JOIN ad_species on ad_species.id = ad_vendor_deals.species_id WHERE ad_vendor_deals.id  = $dealid");

                        $username =  $deal_exe->row('name');
                        $usermobile = $deal_exe->row('mobile');
                        $price =  number_format($deal_exe->row('price'),2);
                        $discount = number_format($deal_exe->row('discount_price'),2);
                        $specie = $deal_exe->row('type');
                        $qty = $deal_exe->row('available_qty');
                        $deal = $deal_exe->row('deal_id');


                        $helpline_qry= $CI->db->query("SELECT value FROM `ad_settings` WHERE `key`='aquadeals_seller_helpline'");
                        $ad_helpline = $helpline_qry->row('value');


                        $smscontent  = "Dear ".ucfirst($username).", Your Deal ID:$deal is promoted. S:$specie,  Seed Rate:$price,Deal Rate:$discount, Call Aquadeals $ad_helpline for help.";

                        $smscontent = urlencode($smscontent);
                        $res = $this->send($smscontent,$usermobile,1);	
                }
                //Promoted product deal
                if($type==1)
                {
                        $CI = & get_instance();
                        $deal_exe = $CI->db->query("SELECT ad_manuf_deals.*,manfactures.contact_person AS manf_name,manfactures.mobile AS phone, types.deal_type AS dtype, catagories.category_name AS cat_name,products.title as pname FROM  `ad_manuf_deals`  JOIN ad_sellers AS manfactures ON manfactures.id = ad_manuf_deals.seller_id JOIN ad_manuf_products AS products ON products.id = ad_manuf_deals.product_id JOIN ad_deal_categories AS catagories ON catagories.id = products.category_id JOIN ad_deal_types AS types ON types.id = products.deal_type_id WHERE ad_manuf_deals.id = $dealid");

                        $manfname =  $deal_exe->row('manf_name');
                        $pro_name =  $deal_exe->row('pname');
                        $manfmobile = $deal_exe->row('phone');
                        $price = $deal_exe->row('mrp');
                        $discount = $deal_exe->row('deal_price');
                        $dtype = $deal_exe->row('dtype');
                        $cat = $deal_exe->row('cat_name');
                        $deal = $deal_exe->row('deal_id');
                        if($discount == 0)
                        {
                                $rate = $price;
                        }
                        else
                        {
                                $rate = $discount;
                        }

                        $helpline_qry= $CI->db->query("SELECT value FROM `ad_settings` WHERE `key`='aquadeals_seller_helpline'");
                        $ad_helpline = $helpline_qry->row('value');


                        $smscontent  = "Dear $manfname, your product deal Deal ID:$deal is promoted. Product:$pro_name with MRP:$price and deal price $discount. Call Aquadeals $ad_helpline for help.";
                        $smscontent = urlencode($smscontent);
                        $res = $this->send($smscontent,$manfmobile,1);
                }
        }
	
	// Notify user, manufacturer when booking is cancelled
	public function FeedBookingCancellation($bookedId)
	{
		$CI = & get_instance();
	    	$query = $CI->db->query("SELECT deal_id,booking_id,user_id,seller_id,deal_type_id,category_id,quantity,cancel_reason from ad_feed_bookings where id = $bookedId");
	    	
	    	//Booking details
	      	$user_id =  $query->row('user_id');
	      	
	      	$manuf_id =  $query->row('seller_id');
	      	$booking_id =  $query->row('booking_id');
	      	$deal_type_id =  $query->row('deal_type_id');
	      	$cat_id =  $query->row('category_id');
	      	$quantity =  $query->row('quantity');
	      	$pid = $this->getValue('ad_manuf_deals','product_id','id',$query->row('deal_id'));
	      	$product = $this->getValue('ad_manuf_products','title','id',$pid);
		$dtype = ucfirst($this->getValue('ad_deal_types','deal_type','id',$deal_type_id));
		$category = ucfirst($this->getValue('ad_deal_categories','category_name','id',$cat_id));
		$creason='';
                if(is_numeric($query->row('cancel_reason')))
                {
                        $creason = $this->getValue('ad_cancel_reasons','reason','id',$query->row('cancel_reason'));
                }
                else 
                { 
                        if($query->row('cancel_reason')!='')
                        {
                                $creason = ucfirst($query->row('cancel_reason'));
                        }
                        else 
                        { 
                                $creason = "N/A";
                        }
                }
		//User Details
	      	$username = $this->getValue('ad_users','name','id',$user_id);
	        $usermobile = $this->getValue('ad_users','mobile','id',$user_id);
	        
		//Manuf details
		$manfname = $this->getValue('ad_sellers','contact_person','id',$manuf_id);
	      	$manfmobile = $this->getValue('ad_sellers','mobile','id',$manuf_id);
	      	$helpline_qry= $CI->db->query("SELECT value FROM `ad_settings` WHERE `key`='aquadeals_helpline'");
                $ad_helpline = $helpline_qry->row('value');
                $shelpline_qry= $CI->db->query("SELECT value FROM `ad_settings` WHERE `key`='aquadeals_seller_helpline'");
                $sad_helpline = $shelpline_qry->row('value');
		//Send sms to user    
		$smscontent = $this->getValue('ad_messages','message','action','Product Booking cancelled');
		$smscontent = str_replace("&name&",$username,$smscontent);
		$smscontent = str_replace("&book_id&",$booking_id,$smscontent);
		$smscontent = str_replace("&dtype&",$product,$smscontent);
		$smscontent = str_replace("&cat&",$category,$smscontent);
		$smscontent = str_replace("&quantity&",$quantity,$smscontent);
		$smscontent = str_replace("&reason&",$creason,$smscontent);
		$smscontent = str_replace("&aquadealHelpline&",$ad_helpline,$smscontent);
		
		$smscontent = urlencode($smscontent);
		$res = $this->send($smscontent,$usermobile,0);
		
		//Send sms to owner
		$Osmscontent = $this->getValue('ad_messages','message','action','Product Booking cancelled');
		$Osmscontent = str_replace("&name&",$manfname,$Osmscontent);
		$Osmscontent = str_replace("&book_id&",$booking_id,$Osmscontent);
		$Osmscontent = str_replace("&dtype&",$product,$Osmscontent);
		$Osmscontent = str_replace("&cat&",$category,$Osmscontent);
		$Osmscontent = str_replace("&quantity&",$quantity,$Osmscontent);
		$Osmscontent = str_replace("&reason&",$creason,$Osmscontent);
		$Osmscontent = str_replace("&aquadealHelpline&",$sad_helpline,$Osmscontent);
		$Osmscontent = urlencode($Osmscontent);
	        $res = $this->send($Osmscontent,$manfmobile,1);
		
		//Send sms to supervisor
		$squery = $CI->db->query("SELECT * from ad_access_sellers where seller_id = $manuf_id and status=1 and  role=1");
		if($squery->num_rows() > 0)
		{
		        foreach($squery->result() as $row)
		        {
                                $Ssmscontent = $this->getValue('ad_messages','message','action','Product Booking cancelled');
                                $Ssmscontent = str_replace("&name&",$row->name,$Ssmscontent);
                                $Ssmscontent = str_replace("&book_id&",$booking_id,$Ssmscontent);
                                $Ssmscontent = str_replace("&dtype&",$product,$Ssmscontent);
                                $Ssmscontent = str_replace("&cat&",$category,$Ssmscontent);
                                $Ssmscontent = str_replace("&quantity&",$quantity,$Ssmscontent);
                                $Ssmscontent = str_replace("&reason&",$creason,$Ssmscontent);
		                        $Ssmscontent = str_replace("&aquadealHelpline&",$sad_helpline,$Ssmscontent);
                                $Ssmscontent = urlencode($Ssmscontent);
                                $res = $this->send($Ssmscontent,$row->mobile,1);
		        }
		}
		
		//Send sms to access person
		$assignto = $this->getValue('ad_feed_bookings','assigned_to','id',$bookedId);
		if($assignto!=0)
		{
                        //Access person details
                        $assignid = $this->getValue('ad_feed_bookings','assigned_id','id',$bookedId);
                        $aname = $this->getValue('ad_access_sellers','name','id',$assignid);
                        $amobile = $this->getValue('ad_access_sellers','mobile','id',$assignid);
                        
                        //Sms to access person
                        $Asmscontent = $this->getValue('ad_messages','message','action','Product Booking cancelled');
                        $Asmscontent = str_replace("&name&",$aname,$Asmscontent);
                        $Asmscontent = str_replace("&book_id&",$booking_id,$Asmscontent);
                        $Asmscontent = str_replace("&dtype&",$product,$Asmscontent);
                        $Asmscontent = str_replace("&cat&",$category,$Asmscontent);
                        $Asmscontent = str_replace("&quantity&",$quantity,$Asmscontent);
                         $Asmscontent = str_replace("&reason&",$creason,$Asmscontent);
                        $Asmscontent = str_replace("&aquadealHelpline&",$sad_helpline,$Asmscontent);
                        $Asmscontent = urlencode($Asmscontent);
                        $res = $this->send($Asmscontent,$amobile,1);
		}
		return $res;
		
	}
	
	
	
	// Notify user, owner when booking is completed
	public function BookingComplted($bookedId)
	{
		$CI = & get_instance();
	    	$query = $CI->db->query("SELECT booking_id,user_id,seller_id,species_id,quantity from ad_bookings where id = $bookedId");
	    	
	    	//Booking details
	      	$user_id =  $query->row('user_id');
	      	$vendor_id =  $query->row('seller_id');
	      	$booking_id =  $query->row('booking_id');
	      	$species_id =  $query->row('species_id');
	      	$quantity =  $query->row('quantity');
		$specie = $this->getValue('ad_species','type','id',$species_id);
		
		//User details
		$username = $this->getValue('ad_users','name','id',$user_id);
                $usermobile = $this->getValue('ad_users','mobile','id',$user_id);
                
                //Owner Details
                $ownername = $this->getValue('ad_sellers','contact_person','id',$vendor_id);
                $ownermobile = $this->getValue('ad_sellers','mobile','id',$vendor_id);
                
		//Send sms to user    
		$smscontent = $this->getValue('ad_messages','message','action','Booking completed - User');
		$smscontent = str_replace("&name&",$username,$smscontent);
		$smscontent = str_replace("&book_id&",$booking_id,$smscontent);
		$smscontent = str_replace("&specie&",$specie,$smscontent);
		$smscontent = str_replace("&quantity&",$quantity,$smscontent);
		$smscontent = urlencode($smscontent);
		$res = $this->send($smscontent,$usermobile,0);
		
		
		//Send sms to owner
		$Osmscontent = $this->getValue('ad_messages','message','action','Booking completed - Owner');
		$Osmscontent = str_replace("&name&",$ownername,$Osmscontent);
		$Osmscontent = str_replace("&book_id&",$booking_id,$Osmscontent);
		$Osmscontent = str_replace("&quantity&",$quantity,$Osmscontent);
		$Osmscontent = str_replace("&specie&",$specie,$Osmscontent);
		$Osmscontent = str_replace("&username&",$username,$Osmscontent);
		$Osmscontent = urlencode($Osmscontent);
		$res = $this->send($Osmscontent,$ownermobile,1);
		
		//Send sms to supervisor
		$squery = $CI->db->query("SELECT * from ad_access_sellers where seller_id = $vendor_id and status=1 and  role=1");
		if($squery->num_rows() > 0)
		{
		        foreach($squery->result() as $row)
		        {
                                $Ssmscontent = $this->getValue('ad_messages','message','action','Booking completed - Owner');
                                $Ssmscontent = str_replace("&name&",$row->name,$Ssmscontent);
                                $Ssmscontent = str_replace("&book_id&",$booking_id,$Ssmscontent);
                                $Ssmscontent = str_replace("&quantity&",$quantity,$Ssmscontent);
                                $Ssmscontent = str_replace("&specie&",$specie,$Ssmscontent);
                                $Ssmscontent = str_replace("&username&",$username,$Ssmscontent);
                                $Ssmscontent = urlencode($Ssmscontent);
                                $res = $this->send($Ssmscontent,$row->mobile,1);
		        }
		}
		//Send sms to Access person
		$assignto = $this->getValue('ad_bookings','assigned_to','id',$bookedId);
		if($assignto!=0)
		{
                        //Access person details
                        $assignid = $this->getValue('ad_bookings','assigned_id','id',$bookedId);
                        $aname = $this->getValue('ad_access_sellers','name','id',$assignid);
                        $amobile = $this->getValue('ad_access_sellers','mobile','id',$assignid);
                        
                        //Sms to access person
                        $Asmscontent = $this->getValue('ad_messages','message','action','Booking completed - Owner');
                        $Asmscontent = str_replace("&name&",$aname,$Asmscontent);
                        $Asmscontent = str_replace("&book_id&",$booking_id,$Asmscontent);
                        $Asmscontent = str_replace("&quantity&",$quantity,$Asmscontent);
                        $Asmscontent = str_replace("&specie&",$specie,$Asmscontent);
                        $Asmscontent = str_replace("&username&",$username,$Asmscontent);
                        $Asmscontent = urlencode($Asmscontent);
                        $res = $this->send($Asmscontent,$amobile,1);
		}
		return 1;
		
	}
	
	
	
	// Notify user, manufacturer when product booking is completed
	public function ProductBookingComplted($bookedId)
	{
		$CI = & get_instance();
	    	$query = $CI->db->query("SELECT booking_id,user_id,deal_id,seller_id,deal_type_id,quantity from ad_feed_bookings where id = $bookedId");
	    	
	    	//Booking details
	      	$user_id =  $query->row('user_id');
	      
	      	$manuf_id =  $query->row('seller_id');
	      	$booking_id =  $query->row('booking_id');
	      	$dealtype_id =  $query->row('deal_type_id');
	      	$quantity =  $query->row('quantity');
		$dealtype = $this->getValue('ad_deal_types','deal_type','id',$dealtype_id);
		$pid =  $this->getValue('ad_manuf_deals','product_id','id',$query->row('deal_id'));
		$product = $this->getValue('ad_manuf_products','title','id',$pid);
		//User details
		$username = $this->getValue('ad_users','name','id',$user_id);
	      	$usermobile = $this->getValue('ad_users','mobile','id',$user_id);
	      	
	      	//manuf details
	      	$manfname = $this->getValue('ad_sellers','contact_person','id',$manuf_id);
	      	$manfmobile = $this->getValue('ad_sellers','mobile','id',$manuf_id);
	      	
		//Send sms to user    
	      	$smscontent = $this->getValue('ad_messages','message','action','Product Booking completed');
		$smscontent = str_replace("&name&",$username,$smscontent);
		$smscontent = str_replace("&book_id&",$booking_id,$smscontent);
		$smscontent = str_replace("&dealtype&",$product,$smscontent);
		$smscontent = str_replace("&quantity&",$quantity,$smscontent);
		$smscontent = urlencode($smscontent);
		$res = $this->send($smscontent,$usermobile,0);
		
		
		//Send sms to manufacturer
		$Osmscontent = $this->getValue('ad_messages','message','action','Product Booking completed');
		$Osmscontent = str_replace("&name&",$manfname,$Osmscontent);
		$Osmscontent = str_replace("&book_id&",$booking_id,$Osmscontent);
		$Osmscontent = str_replace("&quantity&",$quantity,$Osmscontent);
		$Osmscontent = str_replace("&dealtype&",$product,$Osmscontent);
		$Osmscontent = str_replace("&username&",$manfname,$Osmscontent);
		$Osmscontent = urlencode($Osmscontent);
		$res = $this->send($Osmscontent,$manfmobile,1);
		
		//Send sms to supervisor
		$squery = $CI->db->query("SELECT * from ad_access_sellers where seller_id = $manuf_id and status=1 and  role=1");
		if($squery->num_rows() > 0)
		{
		        foreach($squery->result() as $row)
		        {
                                $Ssmscontent = $this->getValue('ad_messages','message','action','Product Booking completed');
                                $Ssmscontent = str_replace("&name&",$row->name,$Ssmscontent);
                                $Ssmscontent = str_replace("&book_id&",$booking_id,$Ssmscontent);
                                $Ssmscontent = str_replace("&quantity&",$quantity,$Ssmscontent);
                                $Ssmscontent = str_replace("&dealtype&",$product,$Ssmscontent);
                                $Ssmscontent = str_replace("&username&",$manfname,$Ssmscontent);
                                $Ssmscontent = urlencode($Osmscontent);
                                $res = $this->send($Ssmscontent,$row->mobile,1);
		        }
		}
		//Send sms to Access person
		$assignto = $this->getValue('ad_feed_bookings','assigned_to','id',$bookedId);
		if($assignto!=0)
		{
                        //Access person details
                        $assignid = $this->getValue('ad_feed_bookings','assigned_id','id',$bookedId);
                        $aname = $this->getValue('ad_access_sellers','name','id',$assignid);
                        $amobile = $this->getValue('ad_access_sellers','mobile','id',$assignid);
                        
                        //Sms to access person
                        $Asmscontent = $this->getValue('ad_messages','message','action','Product Booking completed');
                        $Asmscontent = str_replace("&name&",$row->name,$Asmscontent);
                        $Asmscontent = str_replace("&book_id&",$booking_id,$Asmscontent);
                        $Asmscontent = str_replace("&quantity&",$quantity,$Asmscontent);
                        $Asmscontent = str_replace("&dealtype&",$product,$Asmscontent);
                        $Asmscontent = str_replace("&username&",$manfname,$Asmscontent);
                        $Asmscontent = urlencode($Asmscontent);
                        $res = $this->send($Ssmscontent,$row->mobile,1);
		}
		
		
		return 1;
		
	}
	
	
	public function BookingCashback($bookedId)
	{
		$CI = & get_instance();
	    	$query = $CI->db->query("SELECT booking_id,user_id,prebook_amt,full_aquacash_back_amount from ad_bookings where id = $bookedId");
	      	$user_id =  $query->row('user_id');
	      	$prebook =  $query->row('full_aquacash_back_amount');
	      	$booking_id =  $query->row('booking_id');
		
		
		//Send sms to user    
	      	$username = $this->getValue('ad_users','name','id',$user_id);
	      	$usermobile = $this->getValue('ad_users','mobile','id',$user_id);
		
		$smscontent = "Dear $username, congratulations! You got ₹ $prebook cashback on your order $booking_id. ";
		
		$smscontent = urlencode($smscontent);
		$res = $this->send($smscontent,$usermobile,0);
		
		return $res;
		
	}
	public function PurchaseCashback($bookedId)
	{
		$CI = & get_instance();
	    	$query = $CI->db->query("SELECT booking_id,user_id,prebook_amt,purchase_and_earn_ofr_value from ad_bookings where id = $bookedId");
	      	$user_id =  $query->row('user_id');
	      	$prebook =  $query->row('purchase_and_earn_ofr_value');
	      	$booking_id =  $query->row('booking_id');
		
		
		//Send sms to user    
	      	$username = $this->getValue('ad_users','name','id',$user_id);
	      	$usermobile = $this->getValue('ad_users','mobile','id',$user_id);
		
		$smscontent = "Dear $username, congratulations! You got ₹ $prebook cashback on your order $booking_id. ";
		
		$smscontent = urlencode($smscontent);
		$res = $this->send($smscontent,$usermobile,0);
		
		return $res;
		
	}
	
	
	public function ProductBookingCashback($bookedId)
	{
		$CI = & get_instance();
	    	$query = $CI->db->query("SELECT booking_id,user_id,pre_booking_amount,full_aquacash_back_amount from ad_feed_bookings where id = $bookedId");
	      	$user_id =  $query->row('user_id');
	      	$prebook =  $query->row('full_aquacash_back_amount');
	      	$booking_id =  $query->row('booking_id');
		
		
		//Send sms to user    
	      	$username = $this->getValue('ad_users','name','id',$user_id);
	      	$usermobile = $this->getValue('ad_users','mobile','id',$user_id);
		
		$smscontent = "Dear $username, congratulations! You got ₹ $prebook cashback on your order $booking_id. ";
		
		$smscontent = urlencode($smscontent);
		$res = $this->send($smscontent,$usermobile,0);
		
		return $res;
		
	}
	public function ProductPurchaseCashback($bookedId)
	{
		$CI = & get_instance();
	    	$query = $CI->db->query("SELECT booking_id,user_id,pre_booking_amount,purchase_and_earn_ofr_value from ad_feed_bookings where id = $bookedId");
	      	$user_id =  $query->row('user_id');
	      	$prebook =  $query->row('purchase_and_earn_ofr_value');
	      	$booking_id =  $query->row('booking_id');
		
		
		//Send sms to user    
	      	$username = $this->getValue('ad_users','name','id',$user_id);
	      	$usermobile = $this->getValue('ad_users','mobile','id',$user_id);
		
		$smscontent = "Dear $username, congratulations! You got ₹ $prebook cashback on your order $booking_id. ";
		
		$smscontent = urlencode($smscontent);
		$res = $this->send($smscontent,$usermobile,0);
		
		return $res;
		
	}
	
	public function ProductCancelCashback($amt,$book_id,$user_id)
	{
		//echo "hai";exit; 
		$CI = & get_instance();
	    	//Send sms to user   
	    	$query = $CI->db->query("SELECT booking_id,user_id,pre_booking_amount from ad_feed_bookings where id = $book_id");
	    	$booking_id =  $query->row('booking_id'); 
	      	$username = $this->getValue('ad_users','name','id',$user_id);
	      	$usermobile = $this->getValue('ad_users','mobile','id',$user_id);
		$smscontent = "Dear $username,  you got ₹ $amt as cashback on cancelling your order $booking_id. ";
		$smscontent = urlencode($smscontent);
		$res = $this->send($smscontent,$usermobile,0);
		
		return $res;
		
	}
	
	//Send message to user and owner when booking pickup date changed.
	public function changePickupDate($bookedId)
	{
		$CI = & get_instance();
		$query = $CI->db->query("SELECT booking_id,user_id,seller_id,delivery_date from ad_bookings where id = $bookedId");
	      	$user_id =  $query->row('user_id');
	      	$vendor_id =  $query->row('seller_id');
	      	$booking_id =  $query->row('booking_id');
	      	$date = date('d-m-Y',strtotime($query->row('delivery_date')));
		
		
		//Send sms to user    
	      	$username = $this->getValue('ad_users','name','id',$user_id);
	      	$usermobile = $this->getValue('ad_users','mobile','id',$user_id);
		
		$ownername = $this->getValue('ad_sellers','contact_person','id',$vendor_id);
	      	$ownermobile = $this->getValue('ad_sellers','mobile','id',$vendor_id);
		
		
		$smscontent = $this->getValue('ad_messages','message','action','change Pickup Date');
		$oContent = $smscontent; 
		
		$smscontent = str_replace("&name&",$username,$smscontent);
		$smscontent = str_replace("&book_id&",$booking_id,$smscontent);
		$smscontent = str_replace("&date&",$date,$smscontent);
		
		$smscontent = urlencode($smscontent);
		$res = $this->send($smscontent,$usermobile);
		
		$oContent = str_replace("&name&",$ownername,$oContent);
		$oContent = str_replace("&book_id&",$booking_id,$oContent);
		$oContent = str_replace("&date&",$date,$oContent);
		
		$oContent = urlencode($oContent);
		$res = $this->send($oContent,$ownermobile);
		
	}
	//Send message to user on booking pick-up date change request by owner.
	public function changeDate_req_to_user($bookedId)
	{
		$CI = & get_instance();
		$query = $CI->db->query("SELECT booking_id,user_id,seller_id,delivery_date from ad_bookings where id = $bookedId");
	    $user_id =  $query->row('user_id');
	    $booking_id =  $query->row('booking_id');
	    $vendor_id =  $query->row('seller_id');
	    //$date = date('d-m-Y',strtotime($query->row('delivery_date')));
		
		//Send sms to user    
	    $username = $this->getValue('ad_users','name','id',$user_id);
	    $usermobile = $this->getValue('ad_users','mobile','id',$user_id);
		$hatcharyname = $this->getValue('ad_sellers','seller_name','id',$vendor_id);
		$smscontent = $this->getValue('ad_messages','message','action','Pickup date change request to user');
		$oContent = $smscontent; 
		
		$smscontent = str_replace("&name&",$username,$smscontent);
		$smscontent = str_replace("&book_id&",$booking_id,$smscontent);
		$smscontent = str_replace("&hatchary&",$hatcharyname,$smscontent);
		$smscontent = urlencode($smscontent);
		$res = $this->send($smscontent,$usermobile);
		
	}
	
	
	//Send message to owner on booking pick-up date change request by user.
	public function changeDate_req_to_owner($bookedId)
	{
		$CI = & get_instance();
		$query = $CI->db->query("SELECT booking_id,user_id,seller_id,delivery_date from ad_bookings where id = $bookedId");
	    $user_id =  $query->row('user_id');
	    $vendor_id =  $query->row('seller_id');
	    $booking_id =  $query->row('booking_id');
		//$date = date('d-m-Y',strtotime($query->row('delivery_date')));
		
		//Send sms to user    
	    $oname = $this->getValue('ad_sellers','contact_person','id',$vendor_id);
	    $omobile = $this->getValue('ad_sellers','mobile','id',$vendor_id);
		$username = $this->getValue('ad_users','name','id',$user_id);
		$smscontent = $this->getValue('ad_messages','message','action','Pickup date change request to owner');
		$oContent = $smscontent; 
		
		$smscontent = str_replace("&name&",$oname,$smscontent);
		$smscontent = str_replace("&book_id&",$booking_id,$smscontent);
		$smscontent = str_replace("&userName&",$username,$smscontent);
		$smscontent = urlencode($smscontent);
		$res = $this->send($smscontent,$omobile);
		
	}
	
	
	//edit booking pick-update cancellation message by owner
	public function changePickupDate_reject_owner($id)
	{
		$CI = & get_instance();
		$sql = $CI->db->query("SELECT `book_id` FROM `ad_editdate_request` WHERE id=$id");
		$bookedId = $sql->row('book_id');
		$query = $CI->db->query("SELECT booking_id,user_id,seller_id,delivery_date from ad_bookings where id = $bookedId");
	    	$user_id =  $query->row('user_id');
	    	$vendor_id =  $query->row('seller_id');
	    	$booking_id =  $query->row('booking_id');
	    
	    	//Send sms to user    
	    	$username = $this->getValue('ad_users','name','id',$user_id);
	    	$usermobile = $this->getValue('ad_users','mobile','id',$user_id);
		$hatcharyname = $this->getValue('ad_sellers','seller_name','id',$vendor_id);
		$smscontent = $this->getValue('ad_messages','message','action','Pickup date change request reject by owner');
		$oContent = $smscontent; 
		
		$smscontent = str_replace("&name&",$username,$smscontent);
		$smscontent = str_replace("&book_id&",$booking_id,$smscontent);
		$smscontent = str_replace("&hatchary&",$hatcharyname,$smscontent);
		$smscontent = urlencode($smscontent);
		$res = $this->send($smscontent,$usermobile);
	}
	
	
	//edit booking pick-update cancellation message by user
	public function changePickupDate_reject_user($id)
	{
		$CI = & get_instance();
		$sql = $CI->db->query("SELECT `book_id` FROM `ad_editdate_request` WHERE id=$id");
		$bookedId = $sql->row('book_id');
		$query = $CI->db->query("SELECT booking_id,user_id,seller_id,delivery_date from ad_bookings where id = $bookedId");
	    	$vendor_id =  $query->row('seller_id');
	    	$user_id =  $query->row('user_id');
	    	$booking_id =  $query->row('booking_id');
	    
	    	//Send sms to user    
	    	$username = $this->getValue('ad_sellers','contact_person','id',$vendor_id);
	    	$usermobile = $this->getValue('ad_sellers','mobile','id',$vendor_id);
		$userName = $this->getValue('ad_users','name','id',$user_id);
		$smscontent = $this->getValue('ad_messages','message','action','Pickup date change request reject by user');
		//$oContent = $smscontent; 
		
		$smscontent = str_replace("&name&",$username,$smscontent);
		$smscontent = str_replace("&book_id&",$booking_id,$smscontent);
		$smscontent = str_replace("&userName&",$userName,$smscontent);
		$smscontent = urlencode($smscontent);
		$res = $this->send($smscontent,$usermobile);
	}
	
	public function ReferralCash($user_id, $referral_id, $amount)
	{
		//Get reffered by user details
		$CI = & get_instance();
		$query = $CI->db->query("SELECT name,mobile from ad_users where referral_code = '$referral_id'");
	      	
	      	$ref_name = $query->row('name');
	      	$ref_mobile = $query->row('mobile');
	      	
	      	
	      	
	      	$installed_username =  $this->getValue('ad_users','name','id',$user_id);
	      	
	      	$smscontent = $this->getValue('ad_messages','message','action','Aquacash Referral');
	      	$smscontent = str_replace("&name&",$username,$ref_name);
		$smscontent = str_replace("&amount&",$amount,$smscontent);
		$smscontent = str_replace("&username&",$installed_username,$smscontent);
		
		$smscontent = urlencode($smscontent);
		$res = $this->send($smscontent,$ref_mobile,0);	
	}
	
	
	function dealComplete($dealId)
	{
		$CI = & get_instance();
	    $deal_exe = $CI->db->query("SELECT ad_vendor_deals.seller_id, ad_sellers.contact_person,ad_sellers.mobile,ad_species.type FROM `ad_vendor_deals` INNER JOIN ad_sellers on ad_sellers.id = ad_vendor_deals.seller_id INNER JOIN ad_species on ad_species.id = ad_vendor_deals.species_id WHERE ad_vendor_deals.id  = $dealId");
		
		$username =  $deal_exe->row('name');
		$usermobile = $deal_exe->row('mobile');
		$specie = $deal_exe->row('type');
		
		$smscontent  = "Dear $username, your deal(Specie : $specie) is completed.";
		$smscontent = urlencode($smscontent);
		$res = $this->send($smscontent,$usermobile,1);	
	}
	
	
	function feedDealComplete($dealId)
	{
		$CI = & get_instance();
	      	$deal_exe = $CI->db->query("SELECT ad_manuf_deals.seller_id,ad_manuf_products.title, ad_sellers.contact_person, ad_sellers.mobile, ad_deal_types.deal_type, ad_deal_categories.category_name FROM  `ad_manuf_deals`  INNER JOIN ad_sellers ON ad_sellers.id = ad_manuf_deals.seller_id INNER JOIN ad_manuf_products ON ad_manuf_products.id = ad_manuf_deals.product_id INNER JOIN ad_deal_types ON ad_deal_types.id = ad_manuf_products.deal_type_id INNER JOIN ad_deal_categories ON ad_deal_categories.id = ad_manuf_products.category_id
				WHERE ad_manuf_deals.id = $dealId");
		
		$manfname =  $deal_exe->row('contact_person');
		$manfmobile = $deal_exe->row('mobile');
		$dtype = $deal_exe->row('deal_type');
		$cat = $deal_exe->row('category_name');
		$title = $deal_exe->row('title');
		
		$smscontent  = "Dear $manfname, your deal(Product : $title) is completed.";
		$smscontent = urlencode($smscontent);
		$res = $this->send($smscontent,$manfmobile,1);	
	}
	
	
	function dealMinQty($dealId)
	{
		$CI = & get_instance();
	    $deal_exe = $CI->db->query("SELECT ad_vendor_deals.seller_id, ad_sellers.contact_person,ad_sellers.mobile,ad_species.type FROM `ad_vendor_deals` INNER JOIN ad_sellers on ad_sellers.id = ad_vendor_deals.seller_id INNER JOIN ad_species on ad_species.id = ad_vendor_deals.species_id WHERE ad_vendor_deals.id  = $dealId");
		
		$username =  $deal_exe->row('name');
		$usermobile = $deal_exe->row('mobile');
		$specie = $deal_exe->row('type');
		
		$smscontent  = "Dear $username, your deal(Specie : $specie) reached minimum quantity. Please refill your deal.";
		$smscontent = urlencode($smscontent);
		$res = $this->send($smscontent,$usermobile,1);	
	}
	
	function dealCreated($dealId)
	{
		
		$CI = & get_instance();
	      	$deal_exe = $CI->db->query("SELECT ad_vendor_deals.deal_id,ad_vendor_deals.seller_id,ad_vendor_deals.price, ad_vendor_deals.discount_price, ad_vendor_deals.available_qty, ad_sellers.contact_person as name, ad_sellers.mobile,ad_species.type FROM `ad_vendor_deals` INNER JOIN ad_sellers on ad_sellers.id = ad_vendor_deals.seller_id INNER JOIN ad_species on ad_species.id = ad_vendor_deals.species_id WHERE ad_vendor_deals.id  = $dealId");
		
		$username =  $deal_exe->row('name');
		$usermobile = $deal_exe->row('mobile');
		$price =  number_format($deal_exe->row('price'),2);
		$discount = number_format($deal_exe->row('discount_price'),2);
		$specie = $deal_exe->row('type');
		$qty = $deal_exe->row('available_qty');
		$deal = $deal_exe->row('deal_id');
		
		$dealp='';
		$helpline_qry= $CI->db->query("SELECT value FROM `ad_settings` WHERE `key`='aquadeals_seller_helpline'");
		$ad_helpline = $helpline_qry->row('value');
		if($discount > 0)
		{
		        $dealp = "Deal Rate: $discount";
		}
		else
		{
		        $dealp='';
		}
		$smscontent  = "Dear ".ucfirst($username).", your deal is created. Deal ID: $deal , S: $specie,  Seed Rate: $price, $dealp , Call Aquadeals $ad_helpline for help.";
		
		$smscontent = urlencode($smscontent);
		$res = $this->send($smscontent,$usermobile,1);	
	}
	
	
	function proDealCreated($dealId)
	{
		
		$CI = & get_instance();
	      	$deal_exe = $CI->db->query("SELECT ad_manuf_deals.*,manfactures.contact_person AS manf_name,manfactures.mobile AS phone, types.deal_type AS dtype, catagories.category_name AS cat_name,products.title as pname FROM  `ad_manuf_deals`  JOIN ad_sellers AS manfactures ON manfactures.id = ad_manuf_deals.seller_id JOIN ad_manuf_products AS products ON products.id = ad_manuf_deals.product_id JOIN ad_deal_categories AS catagories ON catagories.id = products.category_id JOIN ad_deal_types AS types ON types.id = products.deal_type_id WHERE ad_manuf_deals.id = $dealId");
		
		$manfname =  $deal_exe->row('manf_name');
		$pro_name =  $deal_exe->row('pname');
		$manfmobile = $deal_exe->row('phone');
		$price = $deal_exe->row('mrp');
		$discount = $deal_exe->row('deal_price');
		$dtype = $deal_exe->row('dtype');
		$cat = $deal_exe->row('cat_name');
		
		if($discount == 0)
		{
			$rate = $price;
		}
		else
		{
			$rate = $discount;
		}
		$dealp='';
		if($discount!=0)
		{
		$dealp = "and Deal price: Rs.".$discount;
		}
		$helpline_qry= $CI->db->query("SELECT value FROM `ad_settings` WHERE `key`='aquadeals_seller_helpline'");
		$ad_helpline = $helpline_qry->row('value');
		
		
		$smscontent  = "Dear $manfname, your product deal is created on Product: $pro_name with MRP: Rs.$price $dealp. Call Aquadeals $ad_helpline for help.";
		$smscontent = urlencode($smscontent);
		$res = $this->send($smscontent,$manfmobile,1);	
	}
	
	
	
	//Aquacash low while booking deal
	function aquacashLow_Booking($userId)
	{
		$CI = & get_instance();
	      	$user_query = $CI->db->query("SELECT name,mobile from ad_users where id = $userId");
	      	$username =  $user_query->row('name');
		$usermobile = $user_query->row('mobile');
		
		$amt_exe = $CI->db->query("SELECT aqua_cash FROM ad_users WHERE id = $userId");
		$amt = $amt_exe->row('aqua_cash');
		
		
		$smscontent  = "Dear $username, your Aquacash ( ₹ $amt) is low. Refer your friends to earn Aquacash.";
		$smscontent = urlencode($smscontent);
		$res = $this->send($smscontent,$usermobile,0);
	}
	
	// Sending sms to user when account is inactivated
	public function inact_user($mobile,$name,$app)
	{
		$CI = & get_instance();
	    $smscontent = $this->getValue('ad_messages','message','action','In_activate_user');
		
		$helpline_qry= $CI->db->query("SELECT value FROM `ad_settings` WHERE `key`='aquadeals_helpline'");
		$ad_helpline = $helpline_qry->row('value');
		
		$smscontent = str_replace("&name&",$name,$smscontent);
		$smscontent = str_replace("&appname&",$app,$smscontent);
		$smscontent = str_replace("&aquadealHelpline&",$ad_helpline,$smscontent);
		
		$smscontent = urlencode($smscontent);
		//echo $smscontent;exit;
		$res = $this->send($smscontent,$mobile,0);
		return $res;
		//print_r ($res);
		
	}
	
	//Sending message when product is saved
	public function saveProduct($manuf_id,$title,$type,$cat,$mrp)
	{
	        $CI = & get_instance();
	      	$user_query = $CI->db->query("SELECT contact_person,mobile from ad_sellers where id = $manuf_id");
	      	$manuf_name =  $user_query->row('contact_person');
		$manuf_mobile = $user_query->row('mobile');
		$dtype = $this->getValue('ad_deal_types','deal_type','id',$type);
		if($cat!=0)
		{
		        $category = $this->getValue('ad_deal_categories','category_name','id',$cat);
		        $cate="Category : $category";
		}
		else
		{
		        $cate='';
		}
		$helpline_qry= $CI->db->query("SELECT value FROM `ad_settings` WHERE `key`='aquadeals_seller_helpline'");
		$ad_helpline = $helpline_qry->row('value');
		$smscontent = "Dear $manuf_name, New Product ' $title ' is created under Product Type : $dtype, $cate  with MRP : ₹ $mrp. Call Aquadeals $ad_helpline for help.";
		$smscontent = urlencode($smscontent);
		$res = $this->send($smscontent,$manuf_mobile,1);
	}
	
	
	
	public function productDelete($id)
	{
	    $CI = & get_instance();        
	    $pro_exe = $CI->db->query("SELECT seller_id,title,deal_type_id,category_id from ad_manuf_products where id = $id");
	    $manuf_id =  $pro_exe->row('seller_id');
		$title = $pro_exe->row('title');
		$deal_type_id = $pro_exe->row('deal_type_id');
		$category_id = $pro_exe->row('category_id');
		
	    $user_query = $CI->db->query("SELECT contact_person,mobile from ad_sellers where id = $manuf_id");
	    $manuf_name =  $user_query->row('contact_person');
		$manuf_mobile = $user_query->row('mobile');
		$dtype = $this->getValue('ad_deal_types','deal_type','id',$deal_type_id);
		if($category_id!=0)
		{
		    $category = $this->getValue('ad_deal_categories','category_name','id',$category_id);
		    $cate="Category : $category";
		}
		else
		{
		    $cate='';
		}
		
		$helpline_qry= $CI->db->query("SELECT value FROM `ad_settings` WHERE `key`='aquadeals_seller_helpline'");
		$ad_helpline = $helpline_qry->row('value');
		
		$smscontent = "Dear $manuf_name, Your Product $title, Type: $dtype, $cate is deleted. Call Aquadeals $ad_helpline for help.";
		$smscontent = urlencode($smscontent);
		$res = $this->send($smscontent,$manuf_mobile,1);
		return 'success';
	}

	function user_inc_alert($details)
	{
		$CI = & get_instance();
		foreach($details as $row)
		{
			if(isset($row['mobile']))
			{
				$this->send(urlencode($row['message']),$row['mobile'],0);
			}
		}
		return 'success';
	}
	function user_nop_alert($details)
	{
		$CI = & get_instance();
		foreach($details as $row)
		{
			if(isset($row['mobile']))
			{
				$this->send(urlencode($row['message']),$row['mobile'],0);
			}
		}
		return 'success';
	}
	
	function seller_inc_alert($details)
	{
		$CI = & get_instance();
		foreach($details as $row)
		{
			if(isset($row['mobile']))
			{
				$this->send(urlencode($row['message']),$row['mobile'],1);
			}
		}
		return 'success';
	}
	
	
	
	function seller_nop_alert($details)
	{
		$CI = & get_instance();
		foreach($details as $row)
		{
			if(isset($row['mobile']))
			{
				$this->send(urlencode($row['message']),$row['mobile'],1);
			}
		}
		return 'success';
	}	
	
	function seller_nod_alert($details)
	{
		foreach($details as $row)
		{
			if(isset($row['mobile']))
			{
				$this->send(urlencode($row['message']),$row['mobile'],1);
			}
		}
		return 'success';
	}
	
	function dexp_tmrw_alert($details)
	{
		foreach($details as $row)
		{
			if(isset($row['mobile']))
			{
				$this->send(urlencode($row['comesToEnd_msg']),$row['mobile'],1);
			}
		}
		return 'success';
	}
	function dexp_today_alert($details)
	{
		foreach($details as $row)
		{
			if(isset($row['mobile']))
			{
				$this->send(urlencode($row['comesToEnd_2day_msg']),$row['mobile'],1);
			}
		}
		return 'success';
	}
	function dexp_alert($details)
	{
		foreach($details as $row)
		{
			if(isset($row['mobile']))
			{
				$this->send(urlencode($row['d_exp_msg']),$row['mobile'],1);
			}
		}
		return 'success';
	}
	
	
	function verifiedEmail($msg,$mobile)
	{
		$smsContent = urlencode($msg);
		$this->send($smsContent,$mobile);
	
	}
	
		
	/*********************Global finctions********************/

	//Get db values
	function getValue($table,$field,$action,$value)
	{ 
	    	//echo "SELECT ".$field." FROM ".$table." WHERE ".$action." ='".$value."'";exit;
	    	$CI = & get_instance();
	      	$query = $CI->db->query("SELECT ".$field." FROM ".$table." WHERE ".$action." ='".$value."'");
	      	return $query->row($field);
	}


	//Send SMS
    	function send($smscontent,$mobile,$type)
	{
		$CI = & get_instance();
		if($type==0)
		{
		        $CI->db->select('*');
	            	$CI->db->from('ad_sms_config');
	            	$CI->db->where('id', 1 );
	            	$query = $CI->db->get();
	    	}
	    	if($type==1)
		{
		        $CI->db->select('*');
	            	$CI->db->from('ad_sms_config');
	            	$CI->db->where('id', 2 );
	            	$query = $CI->db->get();
	    	}
		$row = $query->row_array();
		//Create API URL
		$fullapiurl="http://sms.scubedigi.com/api.php?username=".$row['sms_uname']."&password=".$row['sms_pwd']."&to=".$mobile."&from=".$row['sms_sndrid']."&message=".$smscontent.""; 
		
		//Call API
		$ch = curl_init($fullapiurl);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch); 
		curl_close($ch);
		return $result;
	}

	function aquaCashNotification($uid,$amt,$type)
	{
		if($type == 'direct')
		{
			$smscontent = $this->getValue('ad_messages','message','action','direct_reg_msg');
		
		}
		else if($type == 'reffered')
		{
			$smscontent = $this->getValue('ad_messages','message','action','ref_reg_msg');
		}
	        $smscontent = str_replace("&amt&",$amt,$smscontent);
		$smscontent = urlencode($smscontent);

		$CI = & get_instance();
	    	$query = $CI->db->query("SELECT mobile from ad_users where id=".$uid);
	    	$mobile = $query->row('mobile');
		$res = $this->send($smscontent,$mobile,0);
	}

	function inform2Owner($mobile,$name,$amt,$type)
	{
		$smscontent='';
		if($type == 'Debit')
		{
			$smscontent = $this->getValue('ad_messages','message','action','debit_owner_amount');
		}
		if($type == 'Credit')
		{
			$smscontent = $this->getValue('ad_messages','message','action','credit_amount_to_owner');
		}

		$smscontent = str_replace("&owner&",$name,$smscontent);
		$smscontent = str_replace("&amt&",$amt,$smscontent);
		$smscontent = str_replace("&orderid&",$bid,$smscontent);
		$smscontent = urlencode($smscontent);

		$res = $this->send($smscontent,$mobile,1);
		//$res = $this->send($smscontent,$mobile);

	}
	
	//OTP message
	public function changeSMS($mobile,$action,$changed,$name)
	{
		if($action=="mobile")
		{
		$smscontent = "Dear ".$name.",  your mobile number changed to ".$changed.". Please verify now.";
		}
		if($action=="email")
		{
		$smscontent = "Dear ".$name.", your email  id changed to ".$changed.". Please verify now.";
       	        }
       	        $smscontent = urlencode($smscontent);
		$res = $this->send($smscontent,$mobile);
		return $res;
	}
	
	//Sending sms when seed deal is deleted
	public function seed_deal_delete($id)
	{
	        $CI = & get_instance();
	    	$query = $CI->db->query("SELECT `deal_id`,`seller_id`,`species_id` FROM `ad_vendor_deals` WHERE id = $id");
    		$hatch_id =  $query->row('seller_id');
    		$deal_id =  $query->row('deal_id');
    		$species_id =  $query->row('species_id');
    		//get data
    		$helpline_qry= $CI->db->query("SELECT value FROM `ad_settings` WHERE `key`='aquadeals_seller_helpline'");
		$ad_helpline = $helpline_qry->row('value');
	        $ven_name = $this->getValue('ad_sellers','contact_person','id',$hatch_id);
	        $ven_mobile = $this->getValue('ad_sellers','mobile','id',$hatch_id);
	        $specie = $this->getValue('ad_species','type','id',$species_id);
	        //sending sms
	        $smscontent = $this->getValue('ad_messages','message','action','Seed Deal Delete');
		$smscontent = str_replace("&name&",$ven_name,$smscontent);
		$smscontent = str_replace("&deal_id&",$deal_id,$smscontent);
		$smscontent = str_replace("&specie&",$specie,$smscontent);
		$smscontent = str_replace("&ad_helpline&",$ad_helpline,$smscontent);
		
		$smscontent = urlencode($smscontent);
		$res = $this->send($smscontent,$ven_mobile,1);
	}
	
	public function product_deal_delete($id)
	{
	       $CI = & get_instance();
	       $query = $CI->db->query("SELECT `seller_id`,`product_id`,`mrp` FROM `ad_manuf_deals` WHERE id = $id");
    		$manuf_id =  $query->row('seller_id');
    		$pro_id =  $query->row('product_id');
    		$mrp =  $query->row('mrp');
    		//get data
	        $manuf_name = $this->getValue('ad_sellers','contact_person','id',$manuf_id);
	        $mobile = $this->getValue('ad_sellers','mobile','id',$manuf_id);
	        $title = $this->getValue('ad_manuf_products','title','id',$pro_id);
	         $helpline_qry= $CI->db->query("SELECT value FROM `ad_settings` WHERE `key`='aquadeals_seller_helpline'");
		$ad_helpline = $helpline_qry->row('value');
	        //sending sms
	        $pushcontent = $this->getValue('ad_messages','message','action','Product Deal Delete');
		$pushcontent = str_replace("&name&",$manuf_name,$pushcontent);
		$pushcontent = str_replace("&title&",$title,$pushcontent);
		$pushcontent = str_replace("&mrp&",$mrp,$pushcontent);
		$pushcontent = str_replace("&ad_helpline&",$ad_helpline,$pushcontent);
		$smscontent = urlencode($pushcontent);
		$res = $this->send($smscontent,$mobile,1);
	}
	
	//Send notification to hatcery when signup, profile images, email verifications are not completed.	
	public function notifySeller($msg,$mobile)
	{
		$smscontent = urlencode($msg);
		$res = $this->send($smscontent,$mobile,1);
		return $res;
	}    
	
	public function promoSts($mobile,$msg)
	{
		$smscontent = urlencode($msg);
		$res = $this->send($smscontent,$mobile,1);
		return $res;
	}   
	//Notifications to manufacturer
        public function notifyManufacturer($msg,$mobile)
	{
		$smscontent = urlencode($msg);
		$res = $this->send($smscontent,$mobile,1);
		if($res!='')
		{
		return 1;
		}
		else
		{
		return 0;
		}
	}    	

          //Send notification when rating provided
        public function sendnotif_rate_aquacash($msg,$mobile)
	{
		$smscontent = urlencode($msg);
		$res = $this->send($smscontent,$mobile,1);
		return $res;
	}    
	
	//02-12-2016 chandu start
	//send sms when booking is assigned
	public function assignbooking($bid,$aid,$type)
	{
	$access_name = $this->getValue('ad_access_sellers','name','id',$aid);
	$mobile = $this->getValue('ad_access_sellers','mobile','id',$aid);
	if($type==0)
	{
	        $book_id = $this->getValue('ad_bookings','booking_id','id',$bid);
	}
	else
	{
	        $book_id = $this->getValue('ad_feed_bookings','booking_id','id',$bid);
	}
	
	$sms = $this->getValue('ad_messages','message','action','book_assign');
	$sms = str_replace("&access_person&",$access_name,$sms);
	$sms = str_replace("&book_id&",$book_id,$sms);
	$smscontent = urlencode($sms);
	$res = $this->send($smscontent,$mobile,1);
	}
	
	//Send sms to user about aquacash
	public function notifyuseraboutac($rlid,$rdid,$cash)
	{
	        $referal_name = $this->getValue('ad_users','name','id',$rlid);
	        $mobile = $this->getValue('ad_users','mobile','id',$rlid);
	        $referred_name = $this->getValue('ad_users','name','id',$rdid);
	        
	        $sms = "Dear ".$referal_name.",  your friend ".$referred_name." is successfully registred with AquaDeals. You will get ₹ ".$cash." AquaCash after his first order completed successfully.";
       $smscontent = urlencode($sms);
	$res = $this->send($smscontent ,$mobile,0);
	}
	
	//Send sms to user about referal aquacash
	public function aquaCashNotification_referred($rlid,$rdid,$cash)
	{
	        //referal user details
	        $referal_name = $this->getValue('ad_users','name','id',$rlid);
	        $mobile1 = $this->getValue('ad_users','mobile','id',$rlid);
	        
	        //referred user details
	        $referred_name = $this->getValue('ad_users','name','id',$rdid);
	        $mobile2= $this->getValue('ad_users','mobile','id',$rdid);
	        
	        //message to refered user
	        $msg1 = "Dear ".$referal_name.", your friend ".$referred_name." is successfully completed his first order. ₹".$cash." AquaCash is added to your account please login into the app to check.";
                
                //message to referal user	       
	         $msg2 = "Dear ".$referred_name.", your friend ".$referal_name." got  ₹".$cash." AquaCash from AquaDeals. Login now and refer friends to claim your Aquacash.";
	         
                $smscontent1 = urlencode($msg1);
	        $this->send($smscontent1,$mobile1,0);
	        
	        $smscontent2 = urlencode($msg2);
	        $this->send($smscontent2,$mobile2,0);
	}
	
	//Sending sms to users,owners access persons when booking status is changed
	function sendBookingnotify($bid,$sts,$type)
	{
               //Push content 
               $CI = & get_instance();
               if($type==0)
               {
                        $book_id = $this->getValue('ad_bookings','booking_id','id',$bid);
                        $sid = $this->getValue('ad_bookings','species_id','id',$bid);
                        $specie = $this->getValue('ad_species','type','id',$sid);
                        $user_id = $this->getValue('ad_bookings','user_id','id',$bid);
                        $seller_id = $this->getValue('ad_bookings','seller_id','id',$bid);
                        $assignto = $this->getValue('ad_bookings','assigned_to','id',$bid);
                        $assignid = $this->getValue('ad_bookings','assigned_id','id',$bid);
                        $dname = $this->getValue("ad_bookings","driver_name","id",$bid);
                        $dmobile = $this->getValue("ad_bookings","driver_mobile","id",$bid);
                        $activity = "bookings";
                        if($sts=="process")
                        {
                                $msg = "Your order $book_id status changed to confirmed.";
                                $user_msg = "Your order(".$book_id.", ".$specie.") status changed to  confirmed.";
                                $status = "Order Confirmed";
                        }
                        if($sts=="shipping")
                        {
                                $msg = "Shipping is started on your order $book_id.";
                                if($dname!='')
                                {
                                        $user_msg = "Shipping is started on your order $book_id. Please contact ".ucfirst($dname)." ".$dmobile." for more update.";
                                }
                                else
                                {
                                        $user_msg = "Shipping is started on your order $book_id.";
                                }
                                $status = "Order Shipping Started";
                        }
                        if($sts=="deliver")
                        {
                                $msg = "Your order $book_id status changed to delivered.";
                                $user_msg = "Your order $book_id status changed to delivered.";
                                $status = "Order Delivered";
                        }
                }
                else
                {
                       $book_id = $this->getValue('ad_feed_bookings','booking_id','id',$bid);
                       $deal_id = $this->getValue('ad_feed_bookings','deal_id','id',$bid);
                        $pid = $this->getValue('ad_manuf_deals','product_id','id',$deal_id);
                        $product = $this->getValue('ad_manuf_products','title','id',$pid);
                        $user_id = $this->getValue('ad_feed_bookings','user_id','id',$bid);
                        $seller_id = $this->getValue('ad_feed_bookings','seller_id','id',$bid);
                        $assignto = $this->getValue('ad_feed_bookings','assigned_to','id',$bid);
                        $assignid = $this->getValue('ad_feed_bookings','assigned_id','id',$bid);
                        $dname = $this->getValue("ad_feed_bookings","driver_name","id",$bid);
                        $dmobile = $this->getValue("ad_feed_bookings","driver_mobile","id",$bid);
                        $activity = "pbookings";
                        if($sts=="process")
                        {
                                $msg = "Your order $book_id status changed to confirmed.";
                                $user_msg = "Your order $book_id status change to confirmed.";
                                $status = "Order Confirmed";
                        }
                        if($sts=="shipping")
                        {
                                $msg = "Shipping is started on your order $book_id.";
                                 if($dname!='')
                                {
                                        $user_msg = "Shipping is started on your order $book_id. Please contact ".ucfirst($dname)." ".$dmobile." for more update.";
                                }
                                else
                                {
                                        $user_msg = "Shipping is started on your order $book_id.";
                                }
                                $status = "Order Shipping Started";
                        }
                        if($sts=="deliver")
                        {
                            $msg = "Your order $book_id status changed to delivered.";
                                $user_msg = "Your order $book_id status changed to delivered.";
                                $status = "Order Delivered";
                        }
                }
                //Send sms to user    
                $usermobile = $this->getValue('ad_users','mobile','id',$user_id);
		$smscontent = urlencode($user_msg);
		$res = $this->send($smscontent,$usermobile,1);
		
		//Send sms to owner
		$manfmobile = $this->getValue('ad_sellers','mobile','id',$seller_id);
		$Osmscontent = urlencode($msg);
		$notify_deals = $this->getValue('ad_sellers','notify_deals','id',$seller_id);
		if($notify_deals == 1)
		{
			 $res = $this->send($Osmscontent,$manfmobile,1);
		}
	   
		
		//Send sms to supervisor
		$squery = $CI->db->query("SELECT * from ad_access_sellers where seller_id = $seller_id and status=1 and  role=1");
		if($squery->num_rows() > 0)
		{
		    foreach($squery->result() as $row)
		    {
                $Ssmscontent = urlencode($msg);
                $res = $this->send($Ssmscontent,$row->mobile,1);
		    }
		}
		
		//Send sms to access person
		
		if($assignto!=0)
		{
                        //Access person details
                        $amobile = $this->getValue('ad_access_sellers','mobile','id',$assignid);
                        
                        //Sms to access person
                        $Asmscontent = urlencode($msg);
                        $res = $this->send($Asmscontent,$amobile,1);
		}
                }
                
                public function aquacash_back_cancel($type,$bid)
	{
	        $CI = & get_instance();
	        if($type==1)
	        {
	                $user_id = $this->getValue('ad_feed_bookings','user_id','id',$bid);
	                $book_id = $this->getValue('ad_feed_bookings','booking_id','id',$bid);
	                $amt = $this->getValue('ad_feed_bookings','aqua_cash','id',$bid);
	        }
	        else
	        {
	                $user_id = $this->getValue('ad_bookings','user_id','id',$bid);
	                $book_id = $this->getValue('ad_bookings','booking_id','id',$bid);
	                $amt = $this->getValue('ad_bookings','aqua_cash','id',$bid);
	        }
	        $mobile = $this->getValue('ad_users','mobile','id',$user_id );
	        $username = $this->getValue('ad_users','name','id',$user_id );
	        $msg = "Dear ".$username.", Rs ".$amt." AquaCash used has been refunded.";
	         
	         $msg = urlencode($msg);
                $res = $this->send($msg,$mobile,0);
	        
	}
	
	//Sending sms to users,owners access persons when booking status is changed
	function revisionOrder($bid,$from,$to,$type)
	{
               //Push content 
               $CI = & get_instance();
               if($type==0)
               {
                        $book_id = $this->getValue('ad_bookings','booking_id','id',$bid);
                        $sid = $this->getValue('ad_bookings','species_id','id',$bid);
                        $specie = $this->getValue('ad_species','type','id',$sid);
                        $user_id = $this->getValue('ad_bookings','user_id','id',$bid);
                        $seller_id = $this->getValue('ad_bookings','seller_id','id',$bid);
                        $assignto = $this->getValue('ad_bookings','assigned_to','id',$bid);
                        $assignid = $this->getValue('ad_bookings','assigned_id','id',$bid);
                        
                        $msg = "Your order(".$book_id.") is revised. Total amount changed from ₹ $from to ₹ $to.";
                        $status = "Order Revised";
                }
                else
                {
                        $book_id = $this->getValue('ad_feed_bookings','booking_id','id',$bid);
                        $deal_id = $this->getValue('ad_feed_bookings','deal_id','id',$bid);
                        $pid = $this->getValue('ad_manuf_deals','product_id','id',$deal_id);
                        $product = $this->getValue('ad_manuf_products','title','id',$pid);
                        $user_id = $this->getValue('ad_feed_bookings','user_id','id',$bid);
                        $seller_id = $this->getValue('ad_feed_bookings','seller_id','id',$bid);
                        $assignto = $this->getValue('ad_feed_bookings','assigned_to','id',$bid);
                        $assignid = $this->getValue('ad_feed_bookings','assigned_id','id',$bid);
                        
                        $msg = "Your order(".$book_id.") is revised. Total amount changed from ₹ $from to ₹ $to.";
                        $status = "Order Revised";
                      
                }
                
                //Send sms to user    
                $usermobile = $this->getValue('ad_users','mobile','id',$user_id);
				$smscontent = urlencode($msg);
				$res = $this->send($smscontent,$usermobile,0);
		
				//Send sms to owner
				$manfmobile = $this->getValue('ad_sellers','mobile','id',$seller_id);
				$Osmscontent = urlencode($msg);
	        	$res = $this->send($Osmscontent,$manfmobile,1);
		
				//Send sms to supervisor
				$squery = $CI->db->query("SELECT * from ad_access_sellers where seller_id = $seller_id and status=1 and  role=1");
				if($squery->num_rows() > 0)
				{
						foreach($squery->result() as $row)
						{
			                    $Ssmscontent = urlencode($msg);
			                    $res = $this->send($Ssmscontent,$row->mobile,1);
						}
				}
		
				//Send sms to access person
		
				if($assignto!=0)
				{
		                //Access person details
		                $amobile = $this->getValue('ad_access_sellers','mobile','id',$assignid);
		                
		                //Sms to access person
		                $Asmscontent = urlencode($msg);
		                $res = $this->send($Asmscontent,$amobile,1);
				}
    }
	
	
                //Send sms to user about aquacash
	public function shareToken($sms,$mobile)
	{
                $smscontent = urlencode($sms);
                $res = $this->send($smscontent ,$mobile,1);
	}
	
	//Share coupon details
	function shareCoupon($sms,$mobile)
	{
	        $smscontent = urlencode($sms);
                $res = $this->send($smscontent ,$mobile,0);
	}
	
	function Ad_info($details)
	{
		$CI = & get_instance();
		foreach($details as $row)
		{
			if(isset($row['mobile']))
			{
				$this->send(urlencode($row['message']),$row['mobile'],0);
			}
		}
		return 'success';
	}
        //02-12-2016 chandu end
	/*********************Global finctions********************/
} ?>

