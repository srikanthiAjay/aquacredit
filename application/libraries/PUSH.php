<?php

/**
 * PUSH Notification Library
 *
 * All the  push notification messages configured here
 *
 * @category   PUSH Notification
 * @author     Rama Krishna <ramakrishna_nyros@yahoo.com>,Sankar<sankar_nyros@yahoo.com>,Chandra Sekhar<chandrasekhar_nyros@yahoo.com>
 * @copyright  2016 Nyros Technologies
 * @version    1
 * @link       http://www.aquadeals.com
 */

class PUSH
{

	function __construct()
	{
	    	//define( 'API_ACCESS_KEY', 'AIzaSyBd0yTZz6N1vIXhH6eKDi6xPZTS3FuonGg' );	
	    	$gf = new Globalfuns();
            $key  = $gf->getValue('ad_settings','value','key','gcm');  
                
	    	define( 'API_ACCESS_KEY', $key );	
	}
	 
        //Owner approval
        public function seller_apprv($id)
        {
                $CI = & get_instance();
                $query = $CI->db->query("SELECT contact_person,type,device_id from ad_sellers where id = $id");
                $name = $query->row('contact_person');
                $device[] = $query->row('device_id');
                $title = 'Account Approved';
                $type = $query->row('type');
                $message = "Your registration with AquaDeals partner app is approved.";
                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`) VALUES ($id,2,'".$message."','Account Approved',0,'home')");
                $push_id =  $CI->db->insert_id();
                $target = array('activity'=>'home','id'=> 0,'type'=>$type,'url'=>'','xid'=>'','push_id'=>$push_id);
                $res = $this->pushNotificationTarget('Account Approved',$message,$target,$device);
                return $res;
        }
	
        //manufacturer approval
        public function manuf_apprv($id)
        {
                $CI = & get_instance();
                $query = $CI->db->query("SELECT seller_name,type,device_id from ad_sellers where id = $id");
                $name = $query->row('seller_name');
                $device[] = $query->row('device_id');
                $title = 'Account Approved';
                $type = $query->row('type');
                $message = "Your registration with AquaDeals partner app is approved.";
               $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`) VALUES ($id,2,'".$message."','Account Approved',0,'home')");
               $push_id =  $CI->db->insert_id();
                 $target = array('activity'=>'home','id'=> 0,'type'=>$type,'url'=>'','xid'=>'','push_id'=>$push_id);
                $res = $this->pushNotificationTarget('Account Approved',$message,$target,$device);
                return $res;
        }

	
	
        // Notify user, owner when booking is cancelled
        public function BookingCancellation($bookedId, $actUser)
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
                $userdevice[] = $this->getValue('ad_users','device_id','id',$user_id);

                //Manuf Details
                $ownername = $this->getValue('ad_sellers','contact_person','id',$vendor_id);
                $type = $this->getValue('ad_sellers','type','id',$vendor_id);
                $ownerdevice[] = $this->getValue('ad_sellers','device_id','id',$vendor_id);

                //Notify to user
                 $content = "Your Order  ($booking_id,$specie,$quantity) status changed to cancelled.";
                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,'web_url') VALUES ($user_id,1,'".$content."','Order Cancellation','".$bookedId."','bookings','/order_details/0/$bookedId')");
                $push_id =  $CI->db->insert_id();
                $target = array('activity'=>'bookings','id'=>$booking_id,'url'=>'','xid'=>'' ,'push_id'=>$push_id);
                if($actUser != 'user')
                {
                        $res = $this->pushNotificationTarget('Order cancelled',$content,$target,$userdevice);
                }
                
                //Notify to owner
                 $Ocontent = "Order $booking_id status changed to cancelled.";
                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`) VALUES ($vendor_id,2,'".$Ocontent."','Order Cancellation','".$bookedId."','bookings')");
                $push_id =  $CI->db->insert_id();
                if($actUser != 'owner')
                {
                        $target1 = array('activity'=>'bookings','id'=>$bookedId,'type'=>$type,'url'=>'','xid'=>'' ,'push_id'=>$push_id);
                        $res = $this->pushNotificationTarget('Order cancelled',$Ocontent,$target1,$ownerdevice);
                }


                //Notify to Supervisor
                $squery = $CI->db->query("SELECT * from ad_access_sellers where seller_id = $vendor_id and role=1");
                if($squery->num_rows() > 0)
                {
                		if($actUser != 'supervisor')
                		{
		                    foreach($squery->result() as $row)
		                    {
		                            $sdevice = array();
		                            $sdevice[] = $row->device_id;
		                            $Scontent = "Order $booking_id status changed to cancelled.";
		                            $target1 = array('activity'=>'abookings','id'=>$bookedId,'type'=>$type,'url'=>'','xid'=>'','push_id'=>0);
		                            $res = $this->pushNotificationTarget('Order cancelled',$Scontent,$target1,$sdevice);
		                    }
		                }
                }

                //Notify to Access
                $assignto = $this->getValue('ad_bookings','assigned_to','id',$bookedId);
                if($assignto!=0)
                {
                		if($actUser != 'access')
                		{
		                    //Access person details
		                    $adevice = array();
		                    $assignid = $this->getValue('ad_bookings','assigned_id','id',$bookedId);
		                    $aname = $this->getValue('ad_access_sellers','name','id',$assignid);
		                    $adevice[] = $this->getValue('ad_access_sellers','device_id','id',$assignid);

		                    //Notify to Access person
		                    $Acontent = "Order $booking_id status changed to cancelled.";
		                    $target1 = array('activity'=>'abookings','id'=>$bookedId,'type'=>$type,'url'=>'','xid'=>'','push_id'=>0);
		                    $res = $this->pushNotificationTarget('Order cancelled',$Acontent,$target1,$adevice);
		               }
                }	
                return $res;

        }
        
    
        //Notify user to rate hatchery after booking completed
        public function rating_notify($device_id,$name,$seller_name,$specie,$booking_id,$user_id)
        {
                $content = $this->getValue('ad_messages','message','action','sellerRatingNotification');
                $content = str_replace("&name&",$name,$content);
                $content = str_replace("&seller&",$seller_name,$content);
                $content = str_replace("&speice&",$specie,$content);
                $content = str_replace("&bookingId&",$booking_id,$content);

                $device[] = $device_id;

                if($specie!='')
                {
                        $bookedId = $this->getValue('ad_bookings','id','booking_id',$booking_id);
                        $CI = & get_instance();
                        $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`web_url`) VALUES ($user_id,1,'".$content."','Rating Notification','".$booking_id."','bookings','/order_details/0/$bookedId')");
                         $push_id =  $CI->db->insert_id();	
                        $target = array('activity'=>'bookings','id'=>$bookedId,'url'=>'','xid'=>'','push_id'=>$push_id);
                        $res = $this->pushNotificationTarget('Rate Your Order',$content,$target,$device);
                }
                else
                {
                        $bookedId = $this->getValue('ad_feed_bookings','id','booking_id',$booking_id);
                        $CI = & get_instance();
                        $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`web_url`) VALUES ($user_id,1,'".$content."','Rating Notification','".$bookedId."','pbookings','/order_details/1/$bookedId')");	
                         $push_id =  $CI->db->insert_id();
                        $target = array('activity'=>'pbookings','id'=>$bookedId,'url'=>'','xid'=>'','push_id'=>$push_id);
                        $res = $this->pushNotificationTarget('Rate Your Order',$content,$target,$device);
                }	

                return $res;
        }
	
	
        //Notify users when aquacash is reached minimum balance
        public function aquacashLow($devices,$content)
        {	
                $target = array('activity'=>'aquacash','id'=>0,'url'=>'','xid'=>'','push_id'=>0);
                $res = $this->pushNotificationTarget('Aquacash Low',$content,$target,$devices);
        }
	
	
        //Notify users when email not verified
        public function verifyEmail($devices,$content)
        {	
                $target = array('activity'=>'profile','id'=>0,'url'=>'','xid'=>'');
                $res = $this->pushNotificationTarget('Verify Email',$content,$target,$devices);
        }
	
        //Notify owners when profile is not completed
        public function CompleteProfile($devices,$content)
        {	
                $target = array('activity'=>'profile','id'=>0,'url'=>'','xid'=>'','push_id'=>0);
                $res = $this->pushNotificationTarget('Complete Profile Information',$content,$target,$devices);
        }
	
        //Notify owners when Deal qty is low via cron
        public function dealLowQtyAlert($devices,$content)
        {	
                $target = array('activity'=>'profile','id'=>0,'url'=>'','xid'=>'','push_id'=>0);
                $res = $this->pushNotificationTarget('Deal Reached Minimum Qty',$content,$target,$devices);
        }
        
	
	//Notify user and owner when booking pickup date changed.
	public function changePickupDate($bookedId)
	{
		$CI = & get_instance();
	        $query = $CI->db->query("SELECT booking_id,user_id,seller_id,delivery_date from ad_bookings where id = $bookedId");
	      	$user_id =  $query->row('user_id');
	      	$vendor_id =  $query->row('seller_id');
	      	$booking_id =  $query->row('booking_id');
	      	$date = date('d-m-Y',strtotime($query->row('delivery_date')));
		
	
	      	$username = $this->getValue('ad_users','name','id',$user_id);
	      	$userdevice[] = $this->getValue('ad_users','device_id','id',$user_id);
		
		$ownername = $this->getValue('ad_sellers','contact_person','id',$vendor_id);
		$type = $this->getValue('ad_sellers','type','id',$vendor_id);
	      	$ownerdevice[] = $this->getValue('ad_sellers','device_id','id',$vendor_id);
		
		
		$content = $this->getValue('ad_messages','message','action','change Pickup Date');
		$oContent = $content; 
	
		$content = str_replace("&name&",$username,$content);
		$content = str_replace("&book_id&",$booking_id,$content);
		$content = str_replace("&date&",$date,$content);
		
		
		$target = array('activity'=>'bookings','id'=>$booking_id,'url'=>'','xid'=>'');
                $res = $this->pushNotificationTarget('Pickup date changed',$content,$target,$userdevice);
      	        
		
		//$res = $this->pushNotification('Pickup date changed',$content,$userdevice);
		$CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`) VALUES ($user_id,1,'".$content."','Change Pickup Date','".$booking_id."','bookings')");
		
		$oContent = str_replace("&name&",$username,$oContent);
		$oContent = str_replace("&book_id&",$booking_id,$oContent);
		$oContent = str_replace("&date&",$date,$oContent);
	        $target1 = array('activity'=>'bookings','id'=>$bookedId,'type'=>$type,'url'=>'','xid'=>'');
		$res = $this->pushNotificationTarget('Pickup date changed',$content,$target1,$ownerdevice);
		//$res = $this->pushNotification('Pickup date changed',$content,$ownerdevice);
                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`) VALUES ($vendor_id,2,'".$content."','Change Pickup Date')");
		
	}
	//Notify to user on booking pick-up date change request by owner.
	public function changeDate_req_to_user($bookedId)
	{
		$CI = & get_instance();
		$query = $CI->db->query("SELECT booking_id,user_id,seller_id,delivery_date from ad_bookings where id = $bookedId");
	    $user_id =  $query->row('user_id');
	    $booking_id =  $query->row('booking_id');
		$vendor_id =  $query->row('seller_id');
	      	//$date = date('d-m-Y',strtotime($query->row('delivery_date')));

      	        $username = $this->getValue('ad_users','name','id',$user_id);
      	        $userdevice[] = $this->getValue('ad_users','device_id','id',$user_id);
		$hatcharyname = $this->getValue('ad_sellers','seller_name','id',$vendor_id);
		$content = $this->getValue('ad_messages','message','action','Pickup date change request to user');
		$oContent = $content; 
	
		$content = str_replace("&name&",$username,$content);
		$content = str_replace("&book_id&",$booking_id,$content);
		$content = str_replace("&hatchary&",$hatcharyname,$content);
		
		$target = array('activity'=>'notificaions','id'=>$bookedId,'type'=>0,'url'=>'','xid'=>'');
		$res = $this->pushNotificationTarget('Pickup date change request',$content,$target,$userdevice);
		
		//$res = $this->pushNotification('Pickup date change request',$content,$userdevice);
		$CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`) VALUES ($user_id,1,'".$content."','Pickup date change request','".$bookedId."','notifications')");
	}
	
	//Notify to user on booking pick-up date change request by owner.
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
		$userdevice[] = $this->getValue('ad_sellers','device_id','id',$vendor_id);
		$smscontent = $this->getValue('ad_messages','message','action','Pickup date change request to owner');
		$oContent = $smscontent; 
		
		$smscontent = str_replace("&name&",$oname,$smscontent);
		$smscontent = str_replace("&book_id&",$booking_id,$smscontent);
		$smscontent = str_replace("&userName&",$username,$smscontent);
		//$smscontent = urlencode($smscontent);
		//$res = $this->send($smscontent,$usermobile);

		$CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`) VALUES ($user_id,1,'".$smscontent."','Pickup date change request',$bookedId,'notification')");
		$target = array('activity'=>'notifications','id'=>$bookedId,'type'=>0,'url'=>'','xid'=>'');
		$res = $this->pushNotificationTarget('Pickup date change request',$smscontent,$target,$userdevice);
		
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
	    	$userdevice[] = $this->getValue('ad_users','device_id','id',$user_id);
		$hatcharyname = $this->getValue('ad_sellers','seller_name','id',$vendor_id);
		$smscontent = $this->getValue('ad_messages','message','action','Pickup date change request reject by owner');
		$oContent = $smscontent; 
		
		$smscontent = str_replace("&name&",$username,$smscontent);
		$smscontent = str_replace("&book_id&",$booking_id,$smscontent);
		$smscontent = str_replace("&hatchary&",$hatcharyname,$smscontent);
		//$smscontent = urlencode($smscontent);
		$CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`) VALUES ($user_id,1,'".$smscontent."','Pickup date change request rejected','".$booking_id."','notifications')");
		$target = array('activity'=>'notificaions','id'=>$booking_id,'type'=>0,'url'=>'','xid'=>'');
		$res = $this->pushNotificationTarget('Pickup date change request rejected',$smscontent,$target,$userdevice);
		
		//$res = $this->pushNotificationTarget('Pickup date change request rejected',$smscontent,$userdevice);
		
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
	    	//$usermobile = $this->getValue('ad_sellers','mobile','id',$vendor_id);
	    	$userdevice[] = $this->getValue('ad_sellers','device_id','id',$vendor_id);
		$userName = $this->getValue('ad_users','name','id',$user_id);
		$smscontent = $this->getValue('ad_messages','message','action','Pickup date change request reject by user');
		//$oContent = $smscontent; 
		
		$smscontent = str_replace("&name&",$username,$smscontent);
		$smscontent = str_replace("&book_id&",$booking_id,$smscontent);
		$smscontent = str_replace("&userName&",$userName,$smscontent);
		//$smscontent = urlencode($smscontent);
		
		$target = array('activity'=>'bookings','id'=>$bookedId,'type'=>0,'url'=>'','xid'=>'','push_id'=>0);
		$res = $this->pushNotificationTarget('Pickup date change request rejected',$smscontent,$target,$userdevice);
		
		//$res = $this->pushNotification('Pickup date change request rejected',$smscontent,$userdevice);
		$CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`) VALUES ($vendor_id,2,'".$smscontent."','Pickup date change request rejected','".$bookedId."','bookings')");
	}
	
	public function ReferralCash($user_id, $referral_id, $amount)
        {
        //Get reffered by user details
                $CI = & get_instance();
                $query = $CI->db->query("SELECT name,device_id from ad_users where referral_code = '$referral_id'");

                $ref_name = $query->row('name');
                $device[] = $query->row('device_id');

                $amount = '₹'.$amount;

                $installed_username =  $this->getValue('ad_users','name','id',$user_id);
                $content = "You got $amount aquacash on usage of your referral code by your friend $installed_username.";
                
                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`web_url`) VALUES ($user_id,1,'".$content."','Referral Cash Added',0,'aquacash','/myaquacash')");	
                 $push_id =  $CI->db->insert_id();	
                $target = array('activity'=>'aquacash','id'=>0,'url'=>'','xid'=>'' ,'push_id'=>$push_id);
                $res = $this->pushNotificationTarget('Referral Cash Added',$content,$target,$device);
        }
	
	
	//Custom Pushnotifications
        public function customPush($device,$content,$user_id,$type,$title)
        {
			
			$content1 = str_replace("'", "\'", $content);
			$CI = & get_instance();		
			$CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`) VALUES ($user_id,$type,'".$content1."','Custom Message',0,'home')");	
	                $push_id =  $CI->db->insert_id();
	                $target = array('activity'=>'home','id'=>0,'type'=>$type,'url'=>'','xid'=>'' ,'push_id'=>$push_id);
			$res = $this->pushNotificationTarget($title,$content,$target,$device);
			return $res;
        }
	
        //Custom Pushnotifications
        public function deal_info($device,$content,$user_id,$type,$title,$did)
        {

                $CI = & get_instance();
                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`) VALUES ($user_id,$type,'".$content."','".$title."',$did,'deal details')");
                $push_id =  $CI->db->insert_id();	
                $target = array('activity'=>'deal details','id'=>$did,'url'=>'','xid'=>'','push_id'=>$push_id);
                $res = $this->pushNotificationTarget($title,$content,$target,$device);
        }
        
        //Aquacash push notificaions
        public function sendAquacash_add($name,$devices,$amt,$uid)
        {
                $CI = & get_instance();
                $content = " Rs $amt AquaCash credited to your account."; 
                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`web_url`) VALUES ($uid,1,'".$content."','Aquacash Credited',0,'aquacash','/myaquacash')");	
                $push_id =  $CI->db->insert_id();
                $target = array('activity'=>'aquacash','id'=>0,'url'=>'','xid'=>'','push_id'=>$push_id);
                $res = $this->pushNotificationTarget('Aquacash Credited',$content,$target,$devices);
        }
        
        //sending notification when deal is promoted
        function deal_promo($type,$dealid,$start,$end)
        {
                $CI = & get_instance();
                
              
                if($type==0)  //Promoted seed deal
                {

                        $deal_exe = $CI->db->query("SELECT ad_vendor_deals.deal_id,ad_vendor_deals.seller_id,ad_vendor_deals.price, ad_vendor_deals.discount_price, ad_vendor_deals.available_qty, ad_sellers.contact_person, ad_sellers.device_id,ad_species.type FROM `ad_vendor_deals` INNER JOIN ad_sellers on ad_sellers.id = ad_vendor_deals.seller_id INNER JOIN ad_species on ad_species.id = ad_vendor_deals.species_id WHERE ad_vendor_deals.id  = $dealid");

                        $username =  $deal_exe->row('name');
                        $ownerdevice[] = $deal_exe->row('device_id');
                        $price = $deal_exe->row('price');
                        $discount = $deal_exe->row('discount_price');
                        $specie = $deal_exe->row('type');
                        $qty = $deal_exe->row('available_qty');
                        $deal = $deal_exe->row('deal_id');
                        $owner_id = $deal_exe->row('seller_id');
                        if($discount == 0)
                        {
                                $rate = $price;
                        }
                        else
                        {
                                $rate = $discount;
                        }
                        if($deal_exe->row('device_id') != '')
                        {
                                $helpline_qry= $CI->db->query("SELECT value FROM `ad_settings` WHERE `key`='aquadeals_seller_helpline'");
                                $ad_helpline = $helpline_qry->row('value');
                                $pushcontent  = "Your deal $deal is promoted.  S:$specie, Qty:$qty, Seed Rate:$rate.";
                                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`) VALUES ($owner_id,2,'".$pushcontent."','Deal Created','$dealid','deals')");
                                 $push_id =  $CI->db->insert_id();
                                 $target = array('activity'=>'deals','id'=>$dealid,'type'=>0,'url'=>'','xid'=>'','push_id'=>$push_id);
                                $res = $this->pushNotificationTarget('Deal promoted',$pushcontent,$target,$ownerdevice);
                        }
                }
                //Promoted product deal
                if($type==1)
                {

                        $deal_exe = $CI->db->query("SELECT ad_manuf_deals.*,manfactures.contact_person AS manf_name,manfactures.device_id, types.deal_type AS dtype, catagories.category_name AS cat_name,products.title as pname FROM  `ad_manuf_deals`  JOIN ad_sellers AS manfactures ON manfactures.id = ad_manuf_deals.seller_id JOIN ad_manuf_products AS products ON products.id = ad_manuf_deals.product_id JOIN ad_deal_categories AS catagories ON catagories.id = products.category_id JOIN ad_deal_types AS types ON types.id = products.deal_type_id WHERE ad_manuf_deals.id = $dealid");

                        $manfname =  $deal_exe->row('manf_name');
                        $manuf_id = $deal_exe->row('seller_id');
                        $pro_name =  $deal_exe->row('pname');
                        $manfdevice[] = $deal_exe->row('device_id');
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
                        $pushcontent  = "Your product deal $deal is promoted. Product:$pro_name with MRP:$price and deal price $discount.";
                       $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`) VALUES ($manuf_id,2,'".$pushcontent."','Deal Promoted','$dealid','deals')");
                       $push_id =  $CI->db->insert_id();
                         $target = array('activity'=>'deals','id'=>$dealid,'type'=>0,'url'=>'','xid'=>'','push_id'=>$push_id);
                        $res = $this->pushNotificationTarget('Deal Created',$pushcontent,$target,$manfdevice);
                }
        }
        
   	//Send notification to user and owner whwn booking is made by user    
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

                //User Details
                $username = ucfirst($this->getValue('ad_users','name','id',$user_id));
                $specie = ucfirst($this->getValue('ad_species','type','id',$species_id));
                $usermobile = ucfirst($this->getValue('ad_users','mobile','id',$user_id));
                $user_addr = $this->getValue('ad_users','city','id',$user_id);
                $userdevice[] = $this->getValue('ad_users','device_id','id',$user_id);

                //Seller details
                $ownername = ucfirst($this->getValue('ad_sellers','contact_person','id',$vendor_id));
                $ownermobile = $this->getValue('ad_sellers','mobile','id',$vendor_id);
                $ownerlocation = ucfirst($this->getValue('ad_sellers','location','id',$vendor_id));
                $seller_name = ucfirst($this->getValue('ad_sellers','seller_name','id',$vendor_id));

                //Customor Details
                $helpline_qry= $CI->db->query("SELECT value FROM `ad_settings` WHERE `key`='aquadeals_helpline'");
                $ad_helpline = $helpline_qry->row('value');
                $shelpline_qry= $CI->db->query("SELECT value FROM `ad_settings` WHERE `key`='aquadeals_seller_helpline'");
                $sad_helpline = $shelpline_qry->row('value');

                //Send push notification to user    
                $pushcontent = "Congratulations! You placed an order $booking_id.";
                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`web_url`) VALUES ($user_id,1,'".$pushcontent."','Order Placed','".$booking_id."','bookings','/order_details/0/$bookedId')");
                $push_id =  $CI->db->insert_id();
                $target = array('activity'=>'bookings','id'=>$booking_id,'url'=>'','xid'=>'' ,'push_id'=>$push_id);
                $res = $this->pushNotificationTarget('Order Placed',$pushcontent,$target,$userdevice);
                //Send push notification to owner
                $ownerdevice[] = $this->getValue('ad_sellers','device_id','id',$vendor_id);
                $Opushcontent = "Congratulations! You received an order $booking_id.";
                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`) VALUES ($vendor_id,2,'".$Opushcontent."','Order Placed','".$bookedId."','bookings')");
                $push_id1 =  $CI->db->insert_id();
                $target1 = array('activity'=>'bookings','id'=>$bookedId,'type'=>0,'url'=>'','xid'=>'' ,'push_id'=>$push_id1);
                $res = $this->pushNotificationTarget('Order Placed',$Opushcontent,$target1,$ownerdevice);
                return $res;

                //Send sms to supervisor
                $squery = $CI->db->query("SELECT * from ad_access_sellers where seller_id = $vendor_id and role=1");
                
                if($squery->num_rows() > 0)
                {
                        foreach($squery->result() as $row)
                        {
                               
                                $sdevice[] = array();
                                $sdevice = $row->device_id;
                                $supervisor = "You received an order $booking_id.";
                                 
                                $target1 = array('activity'=>'abookings','id'=>$bookedId,'type'=>0,'url'=>'','xid'=>'');
                                $res = $this->pushNotificationTarget('Order Placed',$supervisor,$target1,$sdevice);
                        }
                }
	
	}
	
	
	public function productDealBookConfiramtion($bookedId)
	{
	    		$CI = & get_instance();
                $query = $CI->db->query("SELECT * from ad_feed_bookings where id = $bookedId");
                //Booking details
                $bookData = $query->row();
                $user_id =  $bookData->user_id;
                $manuf_id =  $bookData->seller_id;
                $booking_id =  $bookData->booking_id;
                $deal_type_id =  $bookData->deal_type_id;
                $deal_id = $bookData->deal_id;
                $category_id =  $bookData->category_id;
                $quantity =  $bookData->quantity;
                
                $pro_id = $this->getValue('ad_manuf_deals','product_id','id',$deal_id);
                $proname = $this->getValue('ad_manuf_products','title','id',$pro_id);

                
                $deal_type = ucfirst($this->getValue('ad_deal_types','deal_type','id',$deal_type_id));
                $cat = ucfirst($this->getValue('ad_deal_categories','category_name','id',$category_id));
                $category = $deal_type.'('.$cat.')';

                //User details
                $username = ucfirst($this->getValue('ad_users','name','id',$user_id));
                $usermobile = ucfirst($this->getValue('ad_users','mobile','id',$user_id));
                $user_addr = $this->getValue('ad_users','city','id',$user_id);
                $userdevice[] = $this->getValue('ad_users','device_id','id',$user_id);

                //Manuf details
                $manufcontact = ucfirst($this->getValue('ad_sellers','contact_person','id',$manuf_id));
                $manufmobile = $this->getValue('ad_sellers','mobile','id',$manuf_id);
                $manuf_name = ucfirst($this->getValue('ad_sellers','seller_name','id',$manuf_id));
                $notify_deals = $this->getValue('ad_sellers','notify_deals','id',$manuf_id);
                //Customr care details
                $helpline_qry= $CI->db->query("SELECT value FROM `ad_settings` WHERE `key`='aquadeals_helpline'");
                $ad_helpline = $helpline_qry->row('value');
                $shelpline_qry= $CI->db->query("SELECT value FROM `ad_settings` WHERE `key`='aquadeals_seller_helpline'");
                $sad_helpline = $shelpline_qry->row('value');

                //Send push to user    
                $pushcontent = "Congratulations! You placed an order $booking_id.";
                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`web_url`) VALUES ($user_id,1,'".$pushcontent."','Order Placed','".$bookedId."','pbookings','/order_details/1/$bookedId')");
                $push_id =  $CI->db->insert_id();
                $target = array('activity'=>'pbookings','id'=>$bookedId,'url'=>'','xid'=>'','push_id'=>$push_id);
                $res = $this->pushNotificationTarget('Order Placed',$pushcontent,$target,$userdevice);
                //Send push to Manufacturer
                $manfdevice[] = $this->getValue('ad_sellers','device_id','id',$manuf_id);
                $Mpushcontent = "Congratulations! You received an order $booking_id.";
                if($notify_deals ==1)
                {
                    $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`) VALUES ($manuf_id,2,'".$Mpushcontent."','Order Placed','".$bookedId."','bookings')");
                    $push_id1 =  $CI->db->insert_id();
                    $target1 = array('activity'=>'bookings','id'=>$bookedId,'type'=>1,'url'=>'','xid'=>'' ,'push_id'=>$push_id1);               
                    $res = $this->pushNotificationTarget('Order Placed',$Mpushcontent,$target1,$manfdevice);
                }
                //Send sms to supervis
                $squery = $CI->db->query("SELECT * from ad_access_sellers where seller_id = $manuf_id and role=1");
                
                if($squery->num_rows() > 0)
                {
                        foreach($squery->result() as $row)
                        {
                                $sdevice = array();
                                $sdevice[] = $row->device_id;
                                $target1 = array('activity'=>'abookings','id'=>$bookedId,'type'=>1,'url'=>'','xid'=>'');
                                $supervisor = "You received an order $booking_id.";
                                $res = $this->pushNotificationTarget('Order Placed',$supervisor,$target1,$sdevice);
                        }
                }
		
		
	}
	
	
	// Notify user when booking is cancelled
	public function FeedBookingCancellation($bookedId,$actUser)
	{
			$CI = & get_instance();
	    	$query = $CI->db->query("SELECT booking_id,user_id,seller_id,deal_type_id,category_id,quantity from ad_feed_bookings where id = $bookedId");
	      	
	      	//Booking details
	      	$user_id =  $query->row('user_id');
	      	$manuf_id =  $query->row('seller_id');
	      	$booking_id =  $query->row('booking_id');
	      	$deal_type_id =  $query->row('deal_type_id');
	      	$cat_id =  $query->row('category_id');
	      	$quantity =  $query->row('quantity');
			$dtype = ucfirst($this->getValue('ad_deal_types','deal_type','id',$deal_type_id));
			$category = ucfirst($this->getValue('ad_deal_categories','category_name','id',$cat_id));
		
			//User details
	      	$username = $this->getValue('ad_users','name','id',$user_id);
	      	$userdevice[] = $this->getValue('ad_users','device_id','id',$user_id);
		
			//Seller Details
			$manfname = $this->getValue('ad_sellers','contact_person','id',$manuf_id);
	      	$manfdevice[] = $this->getValue('ad_sellers','device_id','id',$manuf_id);
		
                //Send push to user    
                $pushcontent = "Your order $booking_id status changed to cancelled.";
                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`web_url`) VALUES ($user_id,1,'".$pushcontent."','Order Cancellation','".$bookedId."','pbookings','/order_details/1/$bookedId')");
                $push_id =  $CI->db->insert_id();
                $target = array('activity'=>'pbookings','id'=>$bookedId,'url'=>'','xid'=>'' ,'push_id'=>$push_id);
                if($actUser != 'user')
                {
                        $res = $this->pushNotificationTarget('Order Cancelled',$pushcontent,$target,$userdevice);
                }
			//Send push to seller
                        $Mpushcontent =  "Order $booking_id status changed to cancelled.";
                        $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`) VALUES ($manuf_id,2,'".$Mpushcontent."','Order Cancellation','".$bookedId."','bookings')");
                        $push_id1 =  $CI->db->insert_id();
                        if($actUser != 'owner')
                        {
                                $target = array('activity'=>'pbookings','id'=>$bookedId,'type'=>1,'url'=>'','xid'=>'','push_id'=>$push_id);
                                $res = $this->pushNotificationTarget('Order Cancelled',$Mpushcontent,$target,$manfdevice);
                        }
			//Send push to supervisor
			$squery = $CI->db->query("SELECT * from ad_access_sellers where seller_id = $manuf_id and role=1");
			if($squery->num_rows() > 0)
			{
				if($actUser != 'supervisor')
				{
				    foreach($squery->result() as $row)
				    {
				            $sdevice = array();
				            $sdevice[] = $row->device_id;
				                    
		                    $Spushcontent = "Order $booking_id status changed to cancelled.";
		                    $target = array('activity'=>'pbookings','id'=>$bookedId,'type'=>1,'url'=>'','xid'=>'','push_id'=>0);
		                    $res = $this->pushNotificationTarget('Deal Cancelled',$Spushcontent,$target,$sdevice);
				    }
				}
			}
			
			//Send push to access person
			$assignto = $this->getValue('ad_feed_bookings','assigned_to','id',$bookedId);
			if($assignto!=0)
			{
					if($actUser != 'access')
					{
			    		//Access person details
	                    $assignid = $this->getValue('ad_feed_bookings','assigned_id','id',$bookedId);
	                    $aname = $this->getValue('ad_access_sellers','name','id',$assignid);
	                    $adevice[] = $this->getValue('ad_access_sellers','device_id','id',$assignid);
	                    
	                    //Notify to Access person
	                    $Apushcontent = "Order $booking_id status changed to cancelled.";
	                    $target = array('activity'=>'pbookings','id'=>$bookedId,'type'=>1,'url'=>'','xid'=>'','push_id'=>0);
	                    $res = $this->pushNotificationTarget('Order Cancelled',$Apushcontent,$target,$adevice);
	                }   
			}
			return 1;
	}
	
	
	public function saveProduct($manuf_id,$title,$type,$cat,$mrp,$pro_id)
	{
	        $CI = & get_instance();
	      	$manf_query = $CI->db->query("SELECT contact_person,device_id from ad_sellers where id = $manuf_id");
	      	$manuf_name =  $manf_query->row('contact_person');
			$manfdevice[] = $manf_query->row('device_id');
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
                        $pushcontent = "New product ($title) is created under Product Type : $dtype, $cate  with MRP : $mrp.";
                        $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`) VALUES ($manuf_id,3,'".$pushcontent."','Product Created')");
                        $push_id =  $CI->db->insert_id();
                        $target = array('activity'=>'products','id'=>$pro_id,'url'=>'','xid'=>'' ,'push_id'=>$push_id);
                        $res = $this->pushNotificationTarget('Product Created',$pushcontent,$target,$manfdevice);
		
	}
	
	
	public function productDelete($id)
	{
	    $CI = & get_instance();
	        
	    $pro_exe = $CI->db->query("SELECT seller_id,title,deal_type_id,category_id from ad_manuf_products where id = $id");
	    $manuf_id =  $pro_exe->row('seller_id');
		$title = $pro_exe->row('title');
		$deal_type_id = $pro_exe->row('deal_type_id');
		$category_id = $pro_exe->row('category_id');
		
		$manf_query = $CI->db->query("SELECT contact_person,device_id from ad_sellers where id = $manuf_id");
	    $manuf_name =  $manf_query->row('contact_person');
		$manufdevice[] = $manf_query->row('device_id');
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
		$pushcontent = "Your product $title is deleted.";
		$CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`) VALUES ($manuf_id,3,'".$pushcontent."','Product Deleted')");
		$push_id =  $CI->db->insert_id();
		$target = array('activity'=>'home','id'=>0,'url'=>'','xid'=>'','push_id'=>$push_id);
		$res = $this->pushNotificationTarget('Product Deleted',$pushcontent,$target,$manufdevice);
		return 'success';
		
		
	}
	

	function proDealCreated($dealId)
	{
		
		$CI = & get_instance();
	      	$deal_exe = $CI->db->query("SELECT ad_manuf_deals.*,manfactures.contact_person AS manf_name,manfactures.device_id, types.deal_type AS dtype, catagories.category_name AS cat_name,products.title as pname FROM  `ad_manuf_deals`  JOIN ad_sellers AS manfactures ON manfactures.id = ad_manuf_deals.seller_id JOIN ad_manuf_products AS products ON products.id = ad_manuf_deals.product_id JOIN ad_deal_categories AS catagories ON catagories.id = products.category_id JOIN ad_deal_types AS types ON types.id = products.deal_type_id WHERE ad_manuf_deals.id = $dealId");
		
		$manfname =  $deal_exe->row('manf_name');
		$manuf_id = $deal_exe->row('seller_id');
		$pro_name =  $deal_exe->row('pname');
		$manfdevice[] = $deal_exe->row('device_id');
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
		
		$helpline_qry= $CI->db->query("SELECT value FROM `ad_settings` WHERE `key`='aquadeals_seller_helpline'");
		$ad_helpline = $helpline_qry->row('value');
		if($discount!=0)
		{
		$dealp = "and Deal price: Rs.".$discount;
		}
		
		$pushcontent  = "Your product deal is created on Product: $pro_name with MRP: Rs.$price $dealp.";
		$CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`) VALUES ($manuf_id,2,'".$pushcontent."','Deal Created',$dealId,'deals')");
		$push_id =  $CI->db->insert_id();
		$target = array('activity'=>'deals','id'=>$dealId,'type'=>1,'url'=>'','xid'=>'' ,'push_id'=>$push_id);
		$res = $this->pushNotificationTarget('Deal Created',$pushcontent,$target,$manfdevice);
		
	}
	
	
	
	
	
	//sending message when user is inactivated
	public function inact_user($device, $name, $app,$uid)
	{
		
		//Get reffered by user details
		$CI = & get_instance();
		$Opushcontent = "Your AquaDeals $app account is inactivated temporarily.";
		
		$res = $this->pushNotification('User Inactivated',$Opushcontent,$device);
		if($app=="user"){$type=1;}
		if($app=="owner"){$type=2;}
		$CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`web_url`) VALUES ($uid,$type,'".$Opushcontent."','User Inactivated',0,'home','')");	
			
	}
	function pending_cart_alert($details)
    {
        foreach($details as $row)
        {
            $device = array();
            if(isset($row['device_id'])&& $row['device_id']!='')
            {
                $device[] = array();
                $title = 'Pending checkout';
                $target = array('activity'=>'cart','id'=>$row['count'],'type'=>0,'url'=>'','xid'=>'','push_id'=>0);
                $device[] = $row['device_id'];
                $this->pushNotificationTarget($title,$row['message'],$target,$device);
                
                $row['device_id'] = '';
            }
            sleep(1);
        }
        return 'success';
    }
    function ref_and_earn_notity($details)
    {
        $CI = & get_instance();
        $qry = $CI->db->query("SELECT value FROM ad_promotional_offers WHERE event_id=2");
        $amt = $qry->row('value');
        foreach($details as $row)
        {
            $device = array();
            if(isset($row['device_id'])&& $row['device_id']!='')
            {
                $device[] = array();
                $title = 'Refer & Earn Rs.'.$amt;
                $target = array('activity'=>'refer','id'=>0,'type'=>0,'url'=>'','xid'=>'','push_id'=>0);
                $device[] = $row['device_id'];
                $this->pushNotificationTarget($title,$row['message'],$target,$device);
                
                $row['device_id'] = '';
            }
            sleep(1);
        }
        return 'success';
    }
    function ref_and_earn_more_notity($details)
	{
		foreach($details as $row)
		{
			$device = array();
			if(isset($row['device_id'])&& $row['device_id']!='')
			{
				$device[] = array();
				$title = 'Earn more AquaCash';
				$target = array('activity'=>'refer','id'=>0,'type'=>0,'url'=>'','xid'=>'','push_id'=>0);
				$device[] = $row['device_id'];
				$this->pushNotificationTarget($title,$row['message'],$target,$device);
				
				$row['device_id'] = '';
			}
			sleep(1);
		}
		return 'success';
	}
	// Notify user, owner when booking is completed
	public function BookingComplted($bookedId,$actUser)
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
	      	$userdevice[] = $this->getValue('ad_users','device_id','id',$user_id);
	      	
	      	//Manuf details
			$ownername = $this->getValue('ad_sellers','contact_person','id',$vendor_id);
	      	$ownerdevice[] = $this->getValue('ad_sellers','device_id','id',$vendor_id);
	      	
			//Send notification to user    
                        $pushcontent = "Order $booking_id status changed to  completed.";
                        $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`web_url`) VALUES ($user_id,1,'".$pushcontent."','Order Completed','".$booking_id."','bookings','/order_details/0/$bookedId')");
                        $push_id =  $CI->db->insert_id();
                        $target = array('activity'=>'bookings','id'=>$booking_id,'url'=>'','xid'=>'','push_id'=>$push_id);
                        $res = $this->pushNotificationTarget('Order Completed',$pushcontent,$target,$userdevice);
			//Send notification to owner
                        $Opushcontent = "Order $booking_id status changed to completed.";
                        $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`) VALUES ($user_id,2,'".$pushcontent."','Order Completed','".$bookedId."','bookings')");
                        $push_id1 =  $CI->db->insert_id();
                        if($actUser != 'owner')
                        {
                                $target1 = array('activity'=>'bookings','id'=>$bookedId,'type'=>0,'url'=>'','xid'=>'','push_id'=>$push_id1);
                                $res = $this->pushNotificationTarget('Order Completed',$Opushcontent,$target1,$ownerdevice);
                        }
			//Send notification to supervisor
			$squery = $CI->db->query("SELECT * from ad_access_sellers where seller_id = $vendor_id and role=1");
			if($squery->num_rows() > 0)
			{
					if($actUser != 'supervisor')
					{
						foreach($squery->result() as $row)
					    {
                                                $sdevice = array();
                                                $sdevice[] = $row->device_id;
                                                $target1 = array('activity'=>'abookings','id'=>$bookedId,'type'=>0,'url'=>'','xid'=>'','push_id'=>0);
                                                $Spushcontent = "Order $booking_id status changed to completed.";
                                                $res = $this->pushNotificationTarget('Order Completed',$Spushcontent,$target1,$sdevice);
						}
					}
			}
		
			//Send notificaion to access person
			$assignto = $this->getValue('ad_bookings','assigned_to','id',$bookedId);
			if($assignto!=0)
			{
			        //Access person details
                    $assignid = $this->getValue('ad_bookings','assigned_id','id',$bookedId);
                    $aname = $this->getValue('ad_access_sellers','name','id',$assignid);
                    $adevice[] = $this->getValue('ad_access_sellers','device_id','id',$assignid);
                    
                    //Notify to Access person
                    $Apushcontent = "Order $booking_id status changed to completed.";
                    $target1 = array('activity'=>'abookings','id'=>$bookedId,'type'=>0,'xid'=>'','push_id'=>0);
                    $res = $this->pushNotificationTarget('Order Completed',$Apushcontent,$target1,$adevice);
			}
		
			return 1;
		
		}
	
	
	// Notify user, manufacturer when product booking is completed
	public function ProductBookingComplted($bookedId,$actUser)
	{
		
			$CI = & get_instance();
	    	$query = $CI->db->query("SELECT booking_id,user_id,seller_id,deal_type_id,quantity from ad_feed_bookings where id = $bookedId");
	    	
	    	//Booking details
	      	$user_id =  $query->row('user_id');
	      	$manuf_id =  $query->row('seller_id');
	      	$booking_id =  $query->row('booking_id');
	      	$dealtype_id =  $query->row('deal_type_id');
	      	$quantity =  $query->row('quantity');
			$dealtype = $this->getValue('ad_deal_types','deal_type','id',$dealtype_id);
		
			//User details
			$username = $this->getValue('ad_users','name','id',$user_id);
	      	$userdevice[] = $this->getValue('ad_users','device_id','id',$user_id);
	      	
	      	//Seller details
	      	$manfname = $this->getValue('ad_sellers','contact_person','id',$manuf_id);
	      	$manfdevice[] = $mdevice = $this->getValue('ad_sellers','device_id','id',$manuf_id);
	      	
			//Send sms to user    
                        $pushcontent = "Order $booking_id status changed to completed.";
                        $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`web_url`) VALUES ($user_id,1,'".$pushcontent."','Order Completed','".$bookedId."','pbookings','/order_details/1/$bookedId')");
                        $push_id =  $CI->db->insert_id();
                        $target = array('activity'=>'pbookings','id'=>$bookedId,'url'=>'','xid'=>'' ,'push_id'=>$push_id);
                        $res = $this->pushNotificationTarget('Order Completed',$pushcontent,$target,$userdevice);
		
			//Send push to seller
			if($mdevice != '')
			{
				$Opushcontent = "Order $booking_id status changed to completed.";
				
				$CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`) VALUES ($manuf_id,2,'".$Opushcontent."','Order Completed','".$bookedId."','bookings')");
				$push_id1 =  $CI->db->insert_id();
				if($actUser != 'owner')
				{
					$target1 = array('activity'=>'bookings','id'=>$bookedId,'type'=>1,'url'=>'','xid'=>'','push_id'=>$push_id1);
					$res = $this->pushNotificationTarget('Order Completed',$Opushcontent,$target1,$manfdevice);
				}
			}
		
			
			
			
			//Send sms to supervisor
			$squery = $CI->db->query("SELECT * from ad_access_sellers where seller_id = $manuf_id and role=1");
			if($squery->num_rows() > 0)
			{
				if($actUser != 'supervisor')
				{
				    foreach($squery->result() as $row)
				    {
		                    $sdevice = array();
		                    $sdevice[] = $row->device_id;
		                    
		                    $Spushcontent = "Order $booking_id status changed to completed.";
		                    $target1 = array('activity'=>'abookings','id'=>$bookedId,'type'=>1,'url'=>'','xid'=>'','push_id'=>0);
		                    $res = $this->pushNotificationTarget('Order Completed',$Spushcontent,$target1,$sdevice);
				    }
				}
			}
		
			
			
			//Send sms to Access person
			$assignto = $this->getValue('ad_feed_bookings','assigned_to','id',$bookedId);
			if($assignto!=0)
			{
                        //Access person details
                        $assignid = $this->getValue('ad_feed_bookings','assigned_id','id',$bookedId);
                        $aname = $this->getValue('ad_access_sellers','name','id',$assignid);
                        $adevice[] = $this->getValue('ad_access_sellers','device_id','id',$assignid);
                        
                        //Sms to access person
                        $Apushcontent = "Order $booking_id status changed to completed.";
                        $target1 = array('activity'=>'abookings','id'=>$bookedId,'type'=>1,'url'=>'','xid'=>'','push_id'=>0);
                        $res = $this->pushNotificationTarget('Order Completed',$Apushcontent,$target1,$adevice);
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
                $userdevice[] = $this->getValue('ad_users','device_id','id',$user_id);
                $pushcontent = "Congratulations! You got ₹ $prebook cashback on your order $booking_id. ";
                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`web_url`) VALUES ($user_id,1,'".$pushcontent."','Cashback on your online order','/myaquacash')");
                $push_id =  $CI->db->insert_id();
                $target = array('activity'=>'aquacash','id'=>0,'url'=>'','xid'=>'','push_id'=>$push_id);
                $res = $this->pushNotificationTarget('Cashback Received',$pushcontent,$target,$userdevice);
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
	      	$userdevice[] = $this->getValue('ad_users','device_id','id',$user_id);
		
		$pushcontent = "Congratulations! You got ₹ $prebook cashback on your order $booking_id. ";
		$CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`web_url`) VALUES ($user_id,1,'".$pushcontent."','Purchase cashback','/myaquacash')");
		$push_id =  $CI->db->insert_id();
		$target = array('activity'=>'aquacash','id'=>0,'url'=>'','xid'=>'','push_id'=>$push_id);
		$res = $this->pushNotificationTarget('Cashback Received',$pushcontent,$target,$userdevice);
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
                $userdevice[] = $this->getValue('ad_users','device_id','id',$user_id);
                $pushcontent = "Congratulations! You got ₹ $prebook cashback on your order $booking_id. ";
                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`web_url`) VALUES ($user_id,1,'".$pushcontent."','Cashback on your online order','/myaquacash')");
                $push_id =  $CI->db->insert_id();
                $target = array('activity'=>'aquacash','id'=>0,'url'=>'','xid'=>'' ,'push_id'=>$push_id);
                $res = $this->pushNotificationTarget('Cashback Received',$pushcontent,$target,$userdevice);
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
	      	$userdevice[] = $this->getValue('ad_users','device_id','id',$user_id);
		
		$pushcontent = "Congratulations! You got ₹ $prebook cashback on your order $booking_id. ";
		$CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`web_url`) VALUES ($user_id,1,'".$pushcontent."','Purchase cashback','/myaquacash')");
		$push_id =  $CI->db->insert_id();
		$target = array('activity'=>'aquacash','id'=>0,'url'=>'','xid'=>'' ,'push_id'=>$push_id);
		$res = $this->pushNotificationTarget('Cashback Received',$pushcontent,$target,$userdevice);
		return $res;
		
	}
	
	
	public function ProductCancelCashback($amt,$book_id,$user_id)
	{
			$CI = & get_instance();
			$query = $CI->db->query("SELECT booking_id,user_id,pre_booking_amount from ad_feed_bookings where id = $book_id");
	    	$booking_id =  $query->row('booking_id');
	    
	    	//Send sms to user    
                $username = $this->getValue('ad_users','name','id',$user_id);
                $userdevice[] = $this->getValue('ad_users','device_id','id',$user_id);
                $pushcontent = "You got ₹ $amt as cashback on cancelling your order $booking_id. ";
                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`web_url`) VALUES ($user_id,1,'".$pushcontent."','Order Cashback',0,'aquacash','/myaquacash')");
                $push_id =  $CI->db->insert_id();
                $target = array('activity'=>'aquacash','id'=>0,'url'=>'','xid'=>'','push_id'=>$push_id);
                $res = $this->pushNotificationTarget('Cashback Received',$pushcontent,$target,$userdevice);
                return $res;
		
	}
	
	function dealComplete($dealId)
	{
			$CI = & get_instance();
	      	
	      	$deal_exe = $CI->db->query("SELECT ad_vendor_deals.seller_id, ad_sellers.contact_person,ad_sellers.device_id,ad_species.type FROM `ad_vendor_deals` INNER JOIN ad_sellers on ad_sellers.id = ad_vendor_deals.seller_id INNER JOIN ad_species on ad_species.id = ad_vendor_deals.species_id WHERE ad_vendor_deals.id  = $dealId");
		
			$username =  $deal_exe->row('name');
			$ownerdevice[] = $deal_exe->row('device_id');
			$specie = $deal_exe->row('type');
			$owner_id = $deal_exe->row('seller_id');
		
			if($deal_exe->row('device_id') != '')
			{
                                $pushcontent  = "Your deal(Specie : $specie) is completed.";
                                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`) VALUES ($owner_id,2,'".$pushcontent."','Deal Completed','$dealId','deals')");
                                $push_id =  $CI->db->insert_id();
                                $target = array('activity'=>'deals','id'=>$dealId,'type'=>0,'url'=>'','xid'=>'' ,'push_id'=>$push_id);
                                $res = $this->pushNotificationTarget('Deal Completed',$pushcontent,$target,$ownerdevice);
			}
	}
	
	//send notification to manufacturer when deal booking completed
	function feedDealComplete($dealId)
	{
			$CI = & get_instance();
	      	$deal_exe = $CI->db->query("SELECT ad_manuf_deals.seller_id, ad_sellers.contact_person, ad_sellers.mobile, ad_deal_types.deal_type, ad_deal_categories.category_name FROM  `ad_manuf_deals`  INNER JOIN ad_sellers ON ad_sellers.id = ad_manuf_deals.seller_id INNER JOIN ad_manuf_products ON ad_manuf_products.id = ad_manuf_deals.product_id INNER JOIN ad_deal_types ON ad_deal_types.id = ad_manuf_products.deal_type_id INNER JOIN ad_deal_categories ON ad_deal_categories.id = ad_manuf_products.category_id
WHERE ad_manuf_deals.id = $dealId");
                $manfname =  $deal_exe->row('contact_person');
                $device_id[] = $deal_exe->row('device_id');
                $dtype = $deal_exe->row('deal_type');
                $cat = $deal_exe->row('category_name');
                $pushcontent  = "Your deal(Type : $dtype,$cat) is completed.";
                $owner_id = $deal_exe->row('seller_id');
                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`) VALUES ($owner_id,2,'".$pushcontent."','Deal Completed','$dealId','deals')");
                $push_id =  $CI->db->insert_id();
                $target = array('activity'=>'deals','id'=>$dealId,'type'=>1,'url'=>'','xid'=>'' ,'push_id'=>$push_id);
                $res = $this->pushNotificationTarget('Deal Completed',$pushcontent,$target,$device_id);
	}
	
	
	function dealMinQty($dealId)
	{
		$CI = & get_instance();
	    $deal_exe = $CI->db->query("SELECT ad_vendor_deals.seller_id, ad_sellers.contact_person,ad_sellers.device_id,ad_species.type FROM `ad_vendor_deals` INNER JOIN ad_sellers on ad_sellers.id = ad_vendor_deals.seller_id INNER JOIN ad_species on ad_species.id = ad_vendor_deals.species_id WHERE ad_vendor_deals.id  = $dealId");
		
		$username =  $deal_exe->row('name');
		$ownerdevice[] = $deal_exe->row('device_id');
		$specie = $deal_exe->row('type');
		$owner_id = $deal_exe->row('seller_id');
		
		if($deal_exe->row('device_id') != '')
		{
                        $pushcontent  = "Your deal(Specie : $specie) reached minimum quantity. Please refill your deal.";
                        $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`) VALUES ($owner_id,2,'".$pushcontent."','Deal Reached Minimum Qty','$dealId','deals')");
                        $push_id =  $CI->db->insert_id();
                        $target = array('activity'=>'deals','id'=>$dealId,'type'=>0,'url'=>'','xid'=>'','push_id'=>$push_id);
                        $res = $this->pushNotificationTarget('Deal Reached Minimum Qty',$pushcontent,$target,$ownerdevice);
		}
	}
	    
    //Sending sms when seed deal is deleted
	public function seed_deal_delete($id)
	{
	        $CI = & get_instance();
	    	$query = $CI->db->query("SELECT `deal_id`,`seller_id`,`species_id` FROM `ad_vendor_deals` WHERE id =$id");
    		$hatch_id =  $query->row('seller_id');
    		$deal_id =  $query->row('deal_id');
    		$species_id =  $query->row('species_id');
    		//get data
	        $ven_name = $this->getValue('ad_sellers','contact_person','id',$hatch_id);
	        $ownerdevice[] = $this->getValue('ad_sellers','device_id','id',$hatch_id);
	        $specie = $this->getValue('ad_species','type','id',$species_id);
	        //sending sms
	        $pushcontent = "Your deal($deal_id, $specie ) is deleted.";
		$CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`) VALUES ($hatch_id,2,'".$pushcontent."','Deal Deleted','0','dashboard')");
		$push_id =  $CI->db->insert_id();
		$target = array('activity'=>'dashboard','id'=>0,'type'=>0,'url'=>'','xid'=>'' ,'push_id'=>$push_id);
	        $res = $this->pushNotificationTarget('Deal Deleted',$pushcontent,$target,$ownerdevice);
	}
	//Sending sms when seed deal is deleted
	public function product_deal_delete($id)
	{
	        $CI = & get_instance();
	       
	        $query = $CI->db->query("SELECT `seller_id`,`product_id`,`mrp` FROM `ad_manuf_deals` WHERE id = $id");
    		$manuf_id =  $query->row('seller_id');
    		$pro_id =  $query->row('product_id');
    		$mrp =  $query->row('mrp');
    		
    		//get data
    		$helpline_qry= $CI->db->query("SELECT value FROM `ad_settings` WHERE `key`='aquadeals_seller_helpline'");
	        $ad_helpline = $helpline_qry->row('value');
	        $manuf_name = $this->getValue('ad_sellers','contact_person','id',$manuf_id);
	        $ownerdevice[] = $this->getValue('ad_sellers','device_id','id',$manuf_id);
	        $title = $this->getValue('ad_manuf_products','title','id',$pro_id);
	        
	        //sending push			
                $pushcontent = "Your deal($title) is deleted.";
                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`) VALUES ($manuf_id,2,'".$pushcontent."','Deal Deleted','0','dashboard')");
                $push_id =  $CI->db->insert_id();
                $target = array('activity'=>'dashboard','id'=>0,'type'=>1,'url'=>'','xid'=>'' ,'push_id'=>$push_id);
                $res = $this->pushNotificationTarget('Deal Deleted',$pushcontent,$target,$ownerdevice);
	}
        
        
    function dealCreated($dealId)
	{
		
		$CI = & get_instance();
	    $deal_exe = $CI->db->query("SELECT ad_vendor_deals.deal_id,ad_vendor_deals.seller_id,ad_vendor_deals.price, ad_vendor_deals.discount_price, ad_vendor_deals.available_qty, ad_sellers.contact_person, ad_sellers.device_id,ad_species.type FROM `ad_vendor_deals` INNER JOIN ad_sellers on ad_sellers.id = ad_vendor_deals.seller_id INNER JOIN ad_species on ad_species.id = ad_vendor_deals.species_id WHERE ad_vendor_deals.id  = $dealId");
		
		$username =  $deal_exe->row('name');
		$ownerdevice[] = $deal_exe->row('device_id');
		$price = $deal_exe->row('price');
		$discount = $deal_exe->row('discount_price');
		$specie = $deal_exe->row('type');
		$qty = $deal_exe->row('available_qty');
		$deal = $deal_exe->row('deal_id');
		$owner_id = $deal_exe->row('seller_id');
		
		
		if($discount == 0)
		{
			$rate = $price;
		}
		else
		{
			$rate = $discount;
		}
		
		if($deal_exe->row('device_id') != '')
		{
			$pushcontent  = "Your deal ($deal) is created.";	
			$CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`) VALUES ($owner_id,2,'".$pushcontent."','Deal Created','$dealId','deals')");
			$push_id =  $CI->db->insert_id();
			$target = array('activity'=>'deals','id'=>$dealId,'type'=>0,'url'=>'','xid'=>'' ,'push_id'=>$push_id);
			$res = $this->pushNotificationTarget('Deal Created',$pushcontent,$target,$ownerdevice);
		}
	
	}
	
	
	//Aquacash low while booking deal
	function aquacashLow_Booking($userId)
	{
			$CI = & get_instance();
	      	$user_query = $CI->db->query("SELECT name,device_id from ad_users where id = $userId");
	      	$username =  $user_query->row('name');
			$userdevice[] = $user_query->row('device_id');
		
			if($user_query->row('device_id') != '')
			{
                                $amt_exe = $CI->db->query("SELECT aqua_cash FROM ad_users WHERE id = $userId");
                                $amt = $amt_exe->row('aqua_cash');
                                $pushcontent  = "Your Aquacash ( ₹ $amt) is low. Refer your friends or rate your orders to earn Aquacash.";
                                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`web_url`) VALUES ($userId,1,'".$pushcontent."','AquaCash Low',0,'aquacash','/myaquacash')");
                                $push_id =  $CI->db->insert_id();
                                $target = array('activity'=>'aquacash','id'=>0,'url'=>'','xid'=>'','push_id'=>$push_id);
                                $res = $this->pushNotificationTarget('AquaCash Low',$pushcontent,$target,$userdevice);
			
			}
	}
	
	
	function aquaCashNotification($uid,$amt,$type)
	{
		if($type == 'direct')
		{
			$pushcontent = "You have received  ₹ ".$amt." aquacash for registering with AquaDeals. Use AquaCash to order your deals.";
		}
		else if($type == 'reffered')
		{
			$pushcontent = "You have received ₹ ".$amt." aquacash for registering with AquaDeals. Use AquaCash to order your deals.";
		}
		
                $CI = & get_instance();
                $user_query = $CI->db->query("SELECT device_id from ad_users where id = $uid");
                $userdevice[] = $user_query->row('device_id');
                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`web_url`) VALUES ($uid,1,'".$pushcontent."','Congratulations',0,'aquacash','/myaquacash')");
                $push_id =  $CI->db->insert_id();
                $target = array('activity'=>'aquacash','id'=>0,'url'=>'','xid'=>'','push_id'=>$push_id);
                $res = $this->pushNotificationTarget('Congratulations !',$pushcontent,$target,$userdevice);
		
	}
	
	
	function inform2Owner($id,$device_id,$name,$amt,$type,$user_type)
	{
		if($type == 'debit')
		{       
		        $title="Amount debited";
			$message = $this->getValue('ad_messages','message','action','debit_owner_amount');
			$act = 'netpayable';
		}
		if($type == 'credit')
		{
			$title="Amount credited";
			$message = $this->getValue('ad_messages','message','action','credit_amount_to_owner');
			$act = 'netreceivable';
		}

		$message = str_replace("&owner&",$name,$message);
		$message = str_replace("&amt&",$amt,$message);
		
		
		$ownerdevice[] = $device_id;
		$CI = & get_instance();	
		$CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`) VALUES ($id,$user_type,'".$pushcontent."','$title',0,'dashboard')");
		 $push_id =  $CI->db->insert_id();
                $target = array('activity'=>$act,'id'=>0,'type'=>1,'url'=>'','xid'=>'','push_id'=>$push_id);
		$res = $this->pushNotificationTarget($title,$message,$target,$ownerdevice);
		
		
		
	}
	
	function user_inc_alert($details)
	{
		$CI = & get_instance();
		foreach($details as $row)
		{
			$device = array();
			if(isset($row['device_id'])&& $row['device_id']!='')
			{
				$title = 'Complete Your Profile Information';
				$target = array('activity'=>'profile','id'=>0,'url'=>'','xid'=>'','push_id'=>0);
				$device[] = $row['device_id'];
				$this->pushNotificationTarget($title,$row['message'],$target,$device);
				$device[] = '';
				$row['device_id'] = '';
			}
		}
		return 'success';
	}
	
	function seller_inc_alert($details)
	{
		$CI = & get_instance();
		foreach($details as $row)
		{
			$device = array();
			if(isset($row['device_id']) && $row['device_id']!='')
			{
				$title = 'Complete Your Profile Information';
				$target = array('activity'=>'profile','id'=>0,'type'=>$row['type'],'url'=>'','xid'=>'','push_id'=>0);
				$device[] = $row['device_id'];
				$this->pushNotificationTarget($title,$row['message'],$target,$device);
				$device[] = '';
				$row['device_id'] = '';
				
		
 			}
		}
		
		return 'success';
	}
	
	function user_nop_alert($details)
	{
		$CI = & get_instance();
		foreach($details as $row)
		{
			$device = array();
			if(isset($row['device_id'])&& $row['device_id']!='')
			{
				$title = 'Upload Your Profile Picture';
				$target = array('activity'=>'profile','id'=>0,'url'=>'','xid'=>'','push_id'=>'0');
				$device[] = $row['device_id'];
				$this->pushNotificationTarget($title,$row['message'],$target,$device);
				$device[] = '';
				$row['device_id'] = '';
			}
		}
		return 'success';
	}
	
	function seller_nop_alert($details)
	{
		$CI = & get_instance();
		foreach($details as $row)
		{
			$device = array();
			if(isset($row['device_id'])&& $row['device_id']!='')
			{
				if($row['type'] == 0)
				{
				$s = 'Hatchery';
				}
				else
				{
				$s = 'Outlet';
				}
				$title = 'Upload Your '.$s.' Image';
				$target = array('activity'=>'profile','id'=>0,'type'=>$row['type'],'url'=>'','xid'=>'','push_id'=>0);
				$device[] = $row['device_id'];
				$this->pushNotificationTarget($title,$row['message'],$target,$device);
				$device[] = '';
				$row['device_id'] = '';
			}
		}
		return 'success';
	}
	
	function seller_nod_alert($details)
	{
		foreach($details as $row)
		{
			$device = array();
			if(isset($row['device_id'])&& $row['device_id']!='')
			{
				$title = 'Create Deal';
				$target = array('activity'=>'create deal','id'=>0,'type'=>$row['type'],'url'=>'','xid'=>'','push_id'=>0);
				$device[] = $row['device_id'];
				$this->pushNotificationTarget($title,$row['message'],$target,$device);
				$device[] = '';
				$row['device_id'] = '';
			}

		}
		return 'success';
	}
	

	function dexp_tmrw_alert($details)
	{
		foreach($details as $row)
		{
			$device = array();
			if(isset($row['device_id'])&& $row['device_id']!='')
			{
				$device[] = array();
				$title = 'Deal Comes To End';
				$target = array('activity'=>'deals','id'=>$row['did'],'type'=>0,'url'=>'','xid'=>'','push_id'=>0);
				$device[] = $row['device_id'];
				$this->pushNotificationTarget($title,$row['comesToEnd_msg'],$target,$device);
				
				$row['device_id'] = '';
			}
			sleep(1);
		}
		return 'success';
	}
	
	function dexp_today_alert($details)
	{
		foreach($details as $row)
		{
			$device = array();
			if(isset($row['device_id'])&& $row['device_id']!='')
			{
				$title = 'Deal Ends Today';
				$target = array('activity'=>'deals','id'=>$row['did'],'type'=>0,'url'=>'','xid'=>'','push_id'=>0);
				$device[] = $row['device_id'];
				$this->pushNotificationTarget($title,$row['comesToEnd_2day_msg'],$target,$device);
				$device[] = '';
				$row['device_id'] = '';
			}
		}
		return 'success';
	}
	
	function dexp_alert($details)
	{
		foreach($details as $row)
		{
			$device = array();
			if(isset($row['device_id'])&& $row['device_id']!='')
			{
				$title = 'Deal Expired';
				$target = array('activity'=>'deals','id'=>$row['did'],'type'=>0,'url'=>'','xid'=>'','push_id'=>0);
				$device[] = $row['device_id'];
				$this->pushNotificationTarget($title,$row['d_exp_msg'],$target,$device);
				$device[] = '';
				$row['device_id'] = '';
			}
		}
		return 'success';
	}
	
	function customUserPush($devices,$text,$title,$target,$target_sub,$img,$ids)
	{
	          $text1 = str_replace("'", "\'", $text);
	          $title1 = str_replace("'", "\'", $title);
	         $CI = & get_instance();
                if($target==1)//Home page
                {
                        $activity ='home' ;
                        $action_id=0;
                        foreach($ids as $id)
                        {
                                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`web_url`) VALUES ($id,1,'".$text1."','".$title1."',$action_id,'".$activity."','')");
                                $id='';
                                $push_id =  $CI->db->insert_id();
                                $target = array('activity'=>'home','id'=>0,'url'=>$img,'xid'=>'' ,'push_id'=>$push_id);
                               
                        }
                         $res = $this->pushNotificationTarget($title,$text,$target,$devices);
                }
                if($target==2)//Seed deal detials page
                {
                        $owner_id = $this->getValue('ad_vendor_deals','seller_id','id',$target_sub);
                        $activity = 'deals';
                        $action_id=$target_sub;
                         if($species_id==1)
                        {
                                $species = "Vannamei";
                        }
                        else  if($species_id==1)
                        {
                                $species = "Tiger";
                        }
                        else
                        {
                                $species = "nauplii";
                        }
                        foreach($ids as $id)
                        {
                                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`web_url`) VALUES ($id,1,'".$text1."','".$title1."',$action_id,'".$activity."','/sdetails/$species/$action_id')");
                                $id='';
                                $push_id =  $CI->db->insert_id();
                                $target = array('activity'=>'deals','id'=>$target_sub,'xid'=>$owner_id,'url'=>$img ,'push_id'=>$push_id);
                                
                        }
                        $res = $this->pushNotificationTarget($title,$text,$target,$devices);
                }
                if($target==3)//product deal details page
                {
                        $product_id = $this->getValue('ad_manuf_deals','product_id','id',$target_sub);
                        $title = $this->getValue('ad_manuf_products','title','id',$product_id);
                        $deal_type_id = $this->getValue('ad_manuf_products','deal_type_id','id',$product_id);
                        $category_id = $this->getValue('ad_manuf_products','category_id','id',$product_id);
                        $dtype_name = $gf->getValue('ad_deal_types','deal_type','id',$deal_type_id);
                        $cat_name1 = $gf->getValue('ad_deal_categories','category_name','id',$category_id);
                        $product= strtolower(str_replace(array('  ', ' '), '-', preg_replace('/[^a-zA-Z0-9 s]/', '', trim($title)))); 
                        $dtype= strtolower(str_replace(array('  ', ' '), '-', preg_replace('/[^a-zA-Z0-9 s]/', '', trim($dtype_name)))); 
                        $cat= strtolower(str_replace(array('  ', ' '), '-', preg_replace('/[^a-zA-Z0-9 s]/', '', trim($cat_name1)))); 
                        $activity ='pdeals' ;
                        $action_id=$target_sub;
                        foreach($ids as $id)
                        {
                                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`web_url`) VALUES ($id,1,'".$text1."','".$title1."',$action_id,'".$activity."','/pdetails/$dtype/$cat/$product/$target_sub/$product_id')");
                                $id='';
                                $push_id =  $CI->db->insert_id();
                                $target = array('activity'=>'pdeals','id'=>$target_sub,'xid'=>$product_id,'url'=>$img ,'push_id'=>$push_id);
                                
                        }
                        $res = $this->pushNotificationTarget($title,$text,$target,$devices);

                }
                if($target==4)//Seed order details
                {
                        $product_id = $this->getValue('ad_bookings','booking_id','id',$target_sub);
                        $activity ='bookings' ;
                        $action_id=$target_sub;
                        foreach($ids as $id)
                        {
                                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`) VALUES ($id,1,'".$text1."','".$title1."',$action_id,'".$activity."')");
                                $id='';
                                $push_id =  $CI->db->insert_id();
                                $target = array('activity'=>'bookings','id'=>$product_id,'url'=>$img,'xid'=>'' ,'push_id'=>$push_id);
                                
                        }
                        $res = $this->pushNotificationTarget($title,$text,$target,$devices);
                }
                if($target==5)//Product order details
                {
                        $activity ='pbookings' ;
                        $action_id=$target_sub;
                        foreach($ids as $id)
                        {
                                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`) VALUES ($id,1,'".$text1."','".$title1."',$action_id,'".$activity."')");
                                $id='';
                                $push_id =  $CI->db->insert_id();
                                $target = array('activity'=>'pbookings','id'=>$target_sub,'url'=>$img,'xid'=>'' ,'push_id'=>$push_id);
                                
                        }
                        $res = $this->pushNotificationTarget($title,$text,$target,$devices);
                }
                if($target==6)//Offers details
                {
                        $activity ='offers' ;
                        $action_id=$target_sub;
                        foreach($ids as $id)
                        {
                                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`) VALUES ($id,1,'".$text1."','".$title1."',$action_id,'".$activity."')");
                                $id='';
                                $push_id =  $CI->db->insert_id();
                                $target = array('activity'=>'offers','id'=>$target_sub,'url'=>$img,'xid'=>'' ,'push_id'=>$push_id);
                                
                        }
                        $res = $this->pushNotificationTarget($title,$text,$target,$devices);
                }
                if($target==7)//Profile page
                {
                        $activity ='profile' ;
                        $action_id=$target;
                        foreach($ids as $id)
                        {
                                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`web_url`) VALUES ($id,1,'".$text1."','".$title1."',$action_id,'".$activity."','/profile')");
                                $id='';
                                $push_id =  $CI->db->insert_id();
                                $target = array('activity'=>'profile','id'=>0,'url'=>$img,'xid'=>'','push_id'=>$push_id);
                                
                        }
                        $res = $this->pushNotificationTarget($title,$text,$target,$devices);
                }
	       return $res;
	      
	}  
        
	/*********************Global finctions********************/

	//Get db values
	function getValue($table,$field,$action,$value)
	{ 
	    	$CI = & get_instance();
	      	$query = $CI->db->query("SELECT ".$field." FROM ".$table." WHERE ".$action." ='".$value."'");
	      	return $query->row($field);
	}

    //Send PUSH to mobile
    function pushNotification($title,$message,$devices)
	{
		// API access key from Google API's Console
		

		$target = array('activity'=>'bookingshome','id'=>0,'url'=>'','xid'=>'','push_id'=>'');
		$msg = array("title"=>$title,"message" => $message,"tickerText" => $target,"notId"=>rand());
		
			
		$fields = array("registration_ids"=>$devices,"data"=> $msg);

		$headers = array('Authorization: key=' . API_ACCESS_KEY,'Content-Type: application/json');
			
		$ch = curl_init();
		curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
		$result = curl_exec($ch);
		// print_r($result);
		// exit;
		curl_close( $ch );
		
		
	}
	
	
	//Send PUSH to mobile
    function pushNotificationTarget($title,$message,$target, $devices)
	{
		
		$msg = array("title"=>$title,"message" => $message,"tickerText" => $target,"notId"=>rand());
		$fields = array("registration_ids"=>$devices,"data"=> $msg);

		$headers = array('Authorization: key=' . API_ACCESS_KEY,'Content-Type: application/json');
			
		$ch = curl_init();
		curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
		$result = curl_exec($ch);
		curl_close( $ch );
		
		$res = json_decode($result);
		return json_encode(array("success"=>$res->success,"fail"=>$res->failure));
	}
	

	//Send PUSH to mobile
    function pushNotificationWithRvalues($title,$message,$devices,$offer_id)
	{

		$target = array('activity'=>'offers','id'=>$offer_id,'url'=>'','xid'=>'','push_id'=>'');
		$msg = array("title"=>$title,"message" => $message,"tickerText" => $target,"notId"=>rand());
			
		$fields = array("registration_ids" =>$devices,"data"=> $msg);

		$headers = array('Authorization: key=' . API_ACCESS_KEY,'Content-Type: application/json');
			
		$ch = curl_init();
		curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send');
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
		$result = curl_exec($ch);
		curl_close( $ch );
		//$data = json_decode($result, true); 
		// array('success'=>$data['success'],'failure'=>$data['failure'])
		return $result;
	
	}

	function promoSts($device,$msg,$type,$did)
	{
		
		$title = 'Promotion Expired';
		$target = array('activity'=>'deals','id'=>$did,'type'=>$type,'url'=>'','xid'=>'','push_id'=>0);
		$this->pushNotificationTarget($title,$msg,$target,$device);	
	}
	
	//function to send notification when user provided rating
	function sendnotif_rate_aquacash($type,$msg,$device,$booking_id,$rlid)
	{
                $CI = & get_instance();
                $title = 'Aquacash Added';
                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`web_url`) VALUES ($rlid,1,'".$msg."','$title',0,'aquacash','/myaquacash')");
                $push_id =  $CI->db->insert_id();
                $target = array('activity'=>'aquacash','id'=>0,'url'=>'','xid'=>'','push_id'=>$push_id);
                $this->pushNotificationTarget($title,$msg,$target,$device);
	}
	
	
	//02-12-2016 chandu start
	//send push when booking is assigned
	public function assignbooking($bid,$aid,$type)
	{
            $access_name = $this->getValue('ad_access_sellers','name','id',$aid);
	        $device[] = $this->getValue('ad_access_sellers','device_id','id',$aid);
	        if($type==0)
	        {
	                $book_id = $this->getValue('ad_bookings','booking_id','id',$bid);
	        }
	        else
	        {
	                $book_id = $this->getValue('ad_feed_bookings','booking_id','id',$bid);
	        }
	
	        $push = $this->getValue('ad_messages','message','action','book_assign');
	        $push = str_replace("&access_person&",$access_name,$push);
	        $push = str_replace("&book_id&",$book_id,$push);
	        $title = 'New order is assigned';
	        $target = array('activity'=>'abookings','id'=>$bid,'type'=>$type,'url'=>'','xid'=>'','push_id'=>0);
	        $this->pushNotificationTarget($title,$push,$target,$device);
	}
	
	//Send push to user about aquacash
	public function notifyuseraboutac($rlid,$rdid,$cash)
	{
	        $CI = & get_instance();
	        $referal_name = $this->getValue('ad_users','name','id',$rlid);
	        $device[] = $this->getValue('ad_users','device_id','id',$rlid);
	        $referred_name = $this->getValue('ad_users','name','id',$rdid);
	        $msg = "Dear ".$referal_name.", your friend ".$referred_name." is successfully registred with AquaDeals. You will get ₹".$cash." aquacash after his first order completed successfully.";
	         $title = 'Aquacash';
	        $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`web_url`) VALUES ($id,1,'".$msg."','$title',0,'aquacash','/myaquacash')");
	        $push_id =  $CI->db->insert_id();
	        $target = array('activity'=>'aquacash','id'=>0,'url'=>'','xid'=>'' ,'push_id'=>$push_id);
	        $this->pushNotificationTarget($title,$msg,$target,$device);
	}
	
	public function aquaCashNotification_referred($rlid,$rdid,$cash)
	{
	        $CI = & get_instance();
	        //referal user details
	        $referal_name = $this->getValue('ad_users','name','id',$rlid);
	        $device1[] = $this->getValue('ad_users','device_id','id',$rlid);
	        
	        //referred user details
	        $referred_name = $this->getValue('ad_users','name','id',$rdid);
	        $device2[]= $this->getValue('ad_users','device_id','id',$rdid);
	        
	        //message to refered user
	        $msg1 = "Dear ".$referal_name.", your friend ".$referred_name." is successfully completed his first order.  ₹".$cash." aquacash is added to your account please login into the app to check.";
                
            //message to referal user	       
	        $msg2 = "Dear ".$referred_name.", your friend ".$referal_name." got  ₹".$cash." aquacash from AquaDeals. Login now and refer friends to claim your Aquacash.";
	        
	        $title = 'Aquacash';
                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`web_url`) VALUES ($rlid,1,'".$msg1."','$title',0,'aquacash','/myaquacash')");
                $push_id =  $CI->db->insert_id();
                $target = array('activity'=>'aquacash','id'=>0,'url'=>'','xid'=>'','push_id'=>$push_id);
                $this->pushNotificationTarget($title,$msg1,$target,$device1);
            
                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`web_url`) VALUES ($rdid,1,'".$msg2."','$title',0,'home'/myaquacash)");
                $push_id1 =  $CI->db->insert_id();
                $target = array('activity'=>'aquacash','id'=>0,'url'=>'','xid'=>'','push_id'=>$push_id1);
                $this->pushNotificationTarget($title,$msg2,$target,$device2);
	}
	
	//Sending push to users,owners access persons when booking status is changed
	function sendBookingnotify($bid,$sts,$type,$actUser)
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
                        $activity = "bookings";
                        $aactivity = "abookings";
                        $uactivity = "bookings";
                        if($sts=="process")
                        {
                                $msg = "Order $book_id status changed to confirmed.";
                                $status = "Order Confirmed";
                        }
                        if($sts=="shipping")
                        {
                                $msg = "Order $book_id status changed to shipping.";
                                $status = "Order Shipping Started";
                        }
                        if($sts=="deliver")
                        {
                                $msg = "Order $book_id status changed to delivered.";
                                $status = "Order Delivered";
                        }
                        
                        
                        //Notify to user
                        $userdevice[] = $this->getValue('ad_users','device_id','id',$user_id);
                        $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`web_url`) VALUES ($user_id,1,'".$msg."','".$status."','".$book_id."','".$uactivity."','/order_details/0/$bid')");
                        $push_id =  $CI->db->insert_id();
                        $target = array('activity'=>$activity,'id'=>$book_id,'url'=>'','xid'=>'' ,'push_id'=>$push_id);
                        $res = $this->pushNotificationTarget($status,$msg,$target,$userdevice);
						
			         //Notify to owner
					$notify_deals = $this->getValue('ad_sellers','notify_deals','id',$seller_id);
                    if($notify_deals == 1)
                    {
                        $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`) VALUES ($seller_id,2,'".$msg."','".$status."',$bid,'$activity')");
                        $push_id1 =  $CI->db->insert_id();
                        if($actUser != 'owner')
                        {
                        $manfdevice[] = $this->getValue('ad_sellers','device_id','id',$seller_id);
                        $target1 = array('activity'=>$activity,'id'=>$bid,'type'=>$type,'url'=>'','xid'=>'' ,'push_id'=>$push_id1);
                        $res = $this->pushNotificationTarget($status,$msg,$target1,$manfdevice);
                        }
                    }
		
						//Notify to Supervisor
						$squery = $CI->db->query("SELECT * from ad_access_sellers where seller_id = $seller_id and role=1");
						if($squery->num_rows() > 0)
						{
								foreach($squery->result() as $row)
								{
										$sdevice = array();
										$sdevice[] = $row->device_id;
										$target1 = array('activity'=>$aactivity,'id'=>$bid,'type'=>$type,'url'=>'','xid'=>'','push_id'=>0);
								        $res = $this->pushNotificationTarget($status,$msg,$target1,$sdevice);
								}
						}
		
		
						//Notify to Access
						if($assignto!=0)
						{
							if($actUser != 'access')
							{
								$adevice = array();
								$adevice[] = $this->getValue('ad_access_sellers','device_id','id',$assignid);
								//Notify to Access person
								$target1 = array('activity'=>$aactivity,'id'=>$bid,'type'=>$type,'url'=>'','xid'=>'','push_id'=>0);
								$res = $this->pushNotificationTarget($status,$msg,$target1,$adevice);
							}
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
                        $activity = "bookings";
                        $aactivity = "abookings";
                        $uactivity = "pbookings";
                        if($sts=="process")
                        {
                                $msg = "Order $book_id status changed to confirmed.";
                                $status = "Order Confirmed";
                        }
                        if($sts=="shipping")
                        {
                                $msg = "Order $book_id status changed to shipping.";
                                $status = "Order Shipping Started";
                        }
                        if($sts=="deliver")
                        {
                                $msg = "Order $book_id status changed to delivered.";
                                $status = "Order Delivered";
                        }
                        
                        
                        //Notify to user
                        $userdevice[] = $this->getValue('ad_users','device_id','id',$user_id);
                        $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`web_url`) VALUES ($user_id,1,'".$msg."','".$status."','".$bid."','".$uactivity."','/order_details/1/$bid')");
                        $push_id =  $CI->db->insert_id();
                        $target = array('activity'=>$uactivity,'id'=>$bid,'url'=>'','xid'=>'','push_id'=>$push_id);
                        $res = $this->pushNotificationTarget($status,$msg,$target,$userdevice);
						//Notify to owner
                        $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`) VALUES ($seller_id,2,'".$msg."','".$status."',$bid,'$activity')");
                        $push_id1 =  $CI->db->insert_id();
                        if($actUser != 'owner')
                        {
                        $manfdevice[] = $this->getValue('ad_sellers','device_id','id',$seller_id);
                        $target1 = array('activity'=>$activity,'id'=>$bid,'type'=>$type,'url'=>'','xid'=>'','push_id'=>$push_id);
                        $res = $this->pushNotificationTarget($status,$msg,$target1,$manfdevice);
                        }
							
						//Notify to Supervisor
						
						if($actUser != 'supervisor')
						{
							$squery = $CI->db->query("SELECT * from ad_access_sellers where seller_id = $seller_id and role=1");
							if($squery->num_rows() > 0)
							{
									foreach($squery->result() as $row)
									{
											$sdevice = array();
											$sdevice[] = $row->device_id;
											$target1 = array('activity'=>$activity,'id'=>$bid,'type'=>$type,'url'=>'','xid'=>'','push_id'=>0);
										    $res = $this->pushNotificationTarget($status,$msg,$target1,$sdevice);
									}
							}
						}
						
						//Notify to Access
						if($assignto!=0)
						{
							if($actUser != 'access')
							{
								$adevice = array();
								$adevice[] = $this->getValue('ad_access_sellers','device_id','id',$assignid);
								//Notify to Access person
								$target1 = array('activity'=>$activity,'id'=>$bid,'type'=>$type,'url'=>'','xid'=>'','push_id'=>0);
								$res = $this->pushNotificationTarget($status,$msg,$target1,$adevice);
							}
						}
                        
                       
                }     
		}
	
	
	        //Send push to user about aquacash
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
	        $device[] = $this->getValue('ad_users','device_id','id',$user_id );
	        $username = $this->getValue('ad_users','name','id',$user_id );
	        $msg = "Dear ".$username.", Rs".$amt." AquaCash used has been refunded.";
	         $title = 'Aquacash';
	        
	        $title = "AquaCash Back";
	        $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`web_url` VALUES ($user_id,1,'".$msg."','$title',0,'aquacash','/myaquacash')");
	        $push_id =  $CI->db->insert_id();
	        $target = array('activity'=>'aquacash','id'=>0,'url'=>'','xid'=>'' ,'push_id'=>$push_id);
	        $this->pushNotificationTarget($title,$msg,$target,$device);
	}
	
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
                        $activity = "bookings";
                        
                        $msg = "Order(".$book_id.") is revised. Total amount changed from ₹ $from to ₹ $to.";
                        $status = "Order Revised";
                        
                        
                        //Notify to user
                        $userdevice[] = $this->getValue('ad_users','device_id','id',$user_id);
                        $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`) VALUES ($user_id,1,'".$msg."','".$status."','".$book_id."','".$activity."')");
                        $push_id =  $CI->db->insert_id();
                        $target = array('activity'=>$activity,'id'=>$book_id,'push_id'=>$push_id);
                        $res = $this->pushNotificationTarget($status,$msg,$target,$userdevice);
	
						//Notify to owner
                        $manfdevice[] = $this->getValue('ad_sellers','device_id','id',$seller_id);
                        $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`) VALUES ($seller_id,2,'".$msg."','".$status."',$bid,'$activity')");
                        $push_id1 =  $CI->db->insert_id();
                        $target1 = array('activity'=>$activity,'id'=>$bid,'type'=>$type ,'push_id'=>$push_id);
                        $res = $this->pushNotificationTarget($status,$msg,$target1,$manfdevice);
		
						//Notify to Supervisor
						$squery = $CI->db->query("SELECT * from ad_access_sellers where seller_id = $seller_id and role=1");
						if($squery->num_rows() > 0)
						{
								foreach($squery->result() as $row)
								{
										$sdevice = array();
										$sdevice[] = $row->device_id;
										$target1 = array('activity'=>$activity,'id'=>$bid,'type'=>$type ,'push_id'=>0);
								        $res = $this->pushNotificationTarget($status,$msg,$target1,$sdevice);
								}
						}
		
		
						//Notify to Access
						if($assignto!=0)
						{
								$adevice = array();
								$adevice[] = $this->getValue('ad_access_sellers','device_id','id',$assignid);
								//Notify to Access person
								$target1 = array('activity'=>$activity,'id'=>$bid,'type'=>$type ,'push_id'=>0);
								$res = $this->pushNotificationTarget($status,$msg,$target1,$adevice);
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
                        $activity = "pbookings";
                        
                        $msg = "Order(".$book_id.") is revised. Total amount changed from ₹ $from to ₹ $to.";
                        $status = "Order Revised";
                        
                        
                        
                        //Notify to user
                        $userdevice[] = $this->getValue('ad_users','device_id','id',$user_id);
                        $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`) VALUES ($user_id,1,'".$msg."','".$status."','".$bid."','".$activity."')");
                        $push_id =  $CI->db->insert_id();
                        $target = array('activity'=>$activity,'id'=>$bid,'push_id'=>$push_id);
                        $res = $this->pushNotificationTarget($status,$msg,$target,$userdevice);
						//Notify to owner
                        $manfdevice[] = $this->getValue('ad_sellers','device_id','id',$seller_id);
                        $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`) VALUES ($seller_id,2,'".$msg."','".$status."',$bid,'$activity')");
                        $push_id1 =  $CI->db->insert_id();
                        $target1 = array('activity'=>$activity,'id'=>$bid,'type'=>$type,'push_id'=>$push_id1);
                        $res = $this->pushNotificationTarget($status,$msg,$target1,$manfdevice);
						//Notify to Supervisor
						$squery = $CI->db->query("SELECT * from ad_access_sellers where seller_id = $seller_id and role=1");
						if($squery->num_rows() > 0)
						{
								foreach($squery->result() as $row)
								{
										$sdevice = array();
										$sdevice[] = $row->device_id;
										$target1 = array('activity'=>$activity,'id'=>$bid,'type'=>$type,'push_id'=>0);
								        $res = $this->pushNotificationTarget($status,$msg,$target1,$sdevice);
								}
						}
		
						//Notify to Access
						if($assignto!=0)
						{
								$adevice = array();
								$adevice[] = $this->getValue('ad_access_sellers','device_id','id',$assignid);
								//Notify to Access person
								$target1 = array('activity'=>$activity,'id'=>$bid,'type'=>$type,'push_id'=>0);
								$res = $this->pushNotificationTarget($status,$msg,$target1,$adevice);
						}
                        
                       
                }
	}
		//Share coupon details
	function shareCoupon($devices,$msg,$title,$ids,$cid,$img)
	{
	      $CI = & get_instance();
	      $target = array('activity'=>'coupon_details','id'=>$cid,'type'=>'','url'=>$img,'xid'=>'','push_id'=>0);
	      $res  = $this->pushNotificationTarget($title,$msg,$target,$devices);
	       foreach($ids as $id)
	       {
	       $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`web_url`) VALUES ($id,1,'".$msg."','".$title."',$cid,'coupon_details','/coupon/details/$cid')");
	       $id='';
	       }
	       return $res;
	}

	
	/*********************Global finctions********************/
} ?>

