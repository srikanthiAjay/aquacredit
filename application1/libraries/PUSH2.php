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

class PUSH2
{

        function __construct()
        {
                $gf = new Globalfuns();
                $key  = $gf->getValue('ad_settings','value','key','gcm');  
                 define( 'API_ACCESS_KEY', 'AIzaSyBfjs2dLz1d_VpEAjUULyK3bxwugQ4goK0' );
                //define( 'API_ACCESS_KEY', 'AIzaSyBd0yTZz6N1vIXhH6eKDi6xPZTS3FuonGg' );  
                $base_url = '';
        }
        
        //Owner approval
        public function seller_apprv($id)
        {
                $CI = & get_instance();
                $query = $CI->db->query("SELECT contact_person,seller_name,type,device_id from ad_sellers where id = $id");
                $name = $query->row('contact_person');
                $sname = $query->row('seller_name');
                $device[] = $query->row('device_id');
                $title = 'Account Approved';
                $type = $query->row('type');
                $message = "Dear $sname, your Partner accout is approved";
                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`) VALUES ($id,2,'".$message."','Account Approved',0,'home')");
                $push_id =  $CI->db->insert_id();
                $target = array('activity'=>'home','id'=> 0,'type'=>$type,'url'=>'','xid'=>'','push_id'=>$push_id,'activity_class'=>'com.aquadeals.partner.HomeDashboard','pid'=>'','did'=>'','type'=>'');
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
                $message = "Dear $name, your Partner accout is approved";
                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`) VALUES ($id,2,'".$message."','Account Approved',0,'home')");
                $push_id =  $CI->db->insert_id();
                $target = array('activity'=>'home','id'=> 0,'type'=>$type,'url'=>'','xid'=>'','push_id'=>$push_id,'activity_class'=>'com.aquadeals.partner.HomeDashboard','pid'=>'','did'=>'','type'=>'');
                $res = $this->pushNotificationTarget('Account Approved',$message,$target,$device);
                return $res;
        }



        // Notify user, owner when booking is cancelled
        public function BookingCancellation($bookedId, $actUser,$check_id)
        {
                $CI = & get_instance();
                $role = $actUser;
                $query = $CI->db->query("SELECT booking_id,user_id,seller_id,species_id,assigned_id,quantity from ad_bookings where id = $bookedId");

                //Booking details
                $user_id =  $query->row('user_id');
                $vendor_id =  $query->row('seller_id');
                $booking_id =  $query->row('booking_id');
                $assignedid =  $query->row('assigned_id');
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
                $content = "Dear $username, Order $booking_id is cancelled.";
                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`,`web_url`) VALUES ($user_id,1,'".$content."','Order Cancellation','".$bookedId."','bookings','com.aquadeals.user.SeedBookingDetails','$booking_id',0,'/order_details/0/$bookedId')");
                $push_id =  $CI->db->insert_id();
                $target = array('activity'=>'bookings','id'=>$booking_id,'url'=>'','xid'=>'' ,'push_id'=>$push_id,'activity_class'=>'com.aquadeals.user.SeedBookingDetails','pid'=>$booking_id,'did'=>'','type'=>'');
                if($actUser != 'user')
                {
                        $res = $this->pushNotificationTarget('Order cancelled',$content,$target,$userdevice);
                }

                //Notify to owner
                
                $Ocontent = "Dear $ownername, Order $booking_id is cancelled.";
                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`) VALUES ($vendor_id,2,'".$Ocontent."','Order Cancellation','".$bookedId."','bookings')");
                $push_id =  $CI->db->insert_id();
                if($actUser != 'partner')
                {
                        $target1 = array('activity'=>'bookings','id'=>$bookedId,'type'=>$type,'url'=>'','xid'=>'' ,'push_id'=>$push_id,'activity_class'=>'com.aquadeals.partner.Singlebookingviewhat','did'=>$bookedId);
                        $res = $this->pushNotificationTarget('Order cancelled',$Ocontent,$target1,$ownerdevice);
                }


                //Notify to Supervisor
                $squery = $CI->db->query("SELECT * from ad_access_sellers where seller_id = $vendor_id and (role=1 or role=2) and device_id!=''");
                if($squery->num_rows() > 0)
                {

                        foreach($squery->result() as $row)
                        {
                                $sdevice = array();

                                $Scontent = "Dear $row->name, Order $booking_id is cancelled.";
                                if($row->role==1 && $row->id!=$check_id)
                                {
                                        $target1 = array('activity'=>'abookings','id'=>$bookedId,'type'=>$type,'url'=>'','xid'=>'','push_id'=>0,'activity_class'=>'com.aquadeals.partner.SingleAccessItemhat','did'=>$bookedId);
                                        $sdevice[] = $row->device_id;
                                        $res = $this->pushNotificationTarget('Order cancelled',$Scontent,$target1,$sdevice);
                                }
                                if($row->role==2 && $row->id!=$check_id)
                                {
                                        $target1 = array('activity'=>'bookings','id'=>$bookedId,'type'=>$type,'url'=>'','xid'=>'','push_id'=>0,'activity_class'=>'com.aquadeals.partner.Singlebookingviewhat','did'=>$bookedId);
                                        $sdevice[] = $row->device_id;
                                        $res = $this->pushNotificationTarget('Order cancelled',$Scontent,$target1,$sdevice);
                                }
                                if($row->role==2)
                                {
                                        $target1 = array('activity'=>'bookings','id'=>$bookedId,'type'=>$type,'url'=>'','xid'=>'','push_id'=>0,'activity_class'=>'com.aquadeals.partner.Singlebookingviewhat','did'=>$bookedId);
                                }

                        }

                }

                //Notify to Access
                $assignto = $this->getValue('ad_bookings','assigned_to','id',$bookedId);
                $assignid = $this->getValue('ad_bookings','assigned_id','id',$bookedId);
                $assign_role = $this->getValue('ad_access_sellers','role','id',$assignid);
                if($assignto!=0)
                {
                        if($actUser != 'access' &&  $assign_role==0)
                        {
                                //Access person details
                                $adevice = array();
                                $assignid = $this->getValue('ad_bookings','assigned_id','id',$bookedId);
                                $aname = $this->getValue('ad_access_sellers','name','id',$assignid);
                                $adevice[] = $this->getValue('ad_access_sellers','device_id','id',$assignid);

                                //Notify to Access person
                                if($this->getValue('ad_access_sellers','device_id','id',$assignid)!='')
                                {
                                        $Acontent = "Dear $aname, Order $booking_id is cancelled.";
                                        $target1 = array('activity'=>'abookings','id'=>$bookedId,'type'=>$type,'url'=>'','xid'=>'','push_id'=>0,'activity_class'=>'com.aquadeals.partner.SingleAccessItemhat','did'=>$bookedID);
                                        $res = $this->pushNotificationTarget('Order cancelled',$Acontent,$target1,$adevice);
                                }
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
                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`,`web_url`) VALUES ($user_id,1,'".$content."','Rating Notification','".$booking_id."','bookings','com.aquadeals.user.SeedBookingDetails','$booking_id',0,'/order_details/0/$bookedId')");
                $push_id =  $CI->db->insert_id();       
                $target = array('activity'=>'bookings','id'=>$booking_id,'url'=>'','xid'=>'','push_id'=>$push_id,'activity_class'=>'com.aquadeals.user.SeedBookingDetails','pid'=>$booking_id,'did'=>'','type'=>'');
                $res = $this->pushNotificationTarget('Rate Your Order',$content,$target,$device);
        }
        else
        {
                $bookedId = $this->getValue('ad_feed_bookings','id','booking_id',$booking_id);
                $CI = & get_instance();
                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`,`web_url`) VALUES ($user_id,1,'".$content."','Rating Notification','".$bookedId."','pbookings','com.aquadeals.user.ProductBookingDetails','$bookedId',0,'$base_url/order_details/1/$bookedId')");     
                $push_id =  $CI->db->insert_id();
                $target = array('activity'=>'pbookings','id'=>$bookedId,'url'=>'','xid'=>'','push_id'=>$push_id,'activity_class'=>'com.aquadeals.user.ProductBookingDetails','pid'=>$bookedId,'did'=>'','type'=>'');
                $res = $this->pushNotificationTarget('Rate Your Order',$content,$target,$device);
        }       
        return $res;
        }


        //Notify users when aquacash is reached minimum balance
        public function aquacashLow($devices,$content)
        {       
                $target = array('activity'=>'aquacash','id'=>0,'url'=>'','xid'=>'','push_id'=>0,'activity_class'=>'com.aquadeals.user.AquaCashListActivity','pid'=>'0','did'=>'0','type'=>'');
                $res = $this->pushNotificationTarget('Aquacash Low',$content,$target,$devices);
        }


        //Notify users when email not verified
        public function verifyEmail($devices,$content)
        {       
                $target = array('activity'=>'profile','id'=>0,'url'=>'','xid'=>'','activity_class'=>'com.aquadeals.user.ProfileActivity','pid'=>0,'did'=>0,'type'=>'');
                //$res = $this->pushNotificationTarget('Verify Email',$content,$target,$devices);
        }

        //Notify owners when profile is not completed
        public function CompleteProfile($devices,$content)
        {       
                $target = array('activity'=>'profile','id'=>0,'url'=>'','xid'=>'','push_id'=>0,'activity_class'=>'com.aquadeals.user.ProfileActivity','pid'=>0,'did'=>0,'type'=>'');
                //$res = $this->pushNotificationTarget('Complete Profile Information',$content,$target,$devices);
        }

        //Notify owners when Deal qty is low via cron
        public function dealLowQtyAlert($devices,$content)
        {       
                $target = array('activity'=>'profile','id'=>0,'url'=>'','xid'=>'','push_id'=>0,'activity_class'=>'com.aquadeals.user.ProfileActivity','pid'=>0,'did'=>0,'type'=>'');
                //$res = $this->pushNotificationTarget('Deal Reached Minimum Qty',$content,$target,$devices);
        }

        public function book_rem_paid($book_id,$seller_id,$paid_amt,$type)
        {
                $smscontent = $this->getValue('ad_messages','message','action','rem_amt_msg');
                $smscontent = str_replace("&amt&",$paid_amt,$smscontent);
                $smscontent = str_replace("&book_id&",$book_id,$smscontent);
                $smscontent = urlencode($smscontent);
                $device_id = $this->getValue('ad_sellers','device_id','id',$seller_id);
                if($type == 0)
                {
                        $bid = $this->getValue('ad_bookings','id','booking_id',$book_id); 
                        $assigned_id = $this->getValue('ad_bookings','assigned_id','booking_id',$book_id); 
                        $act_class='com.aquadeals.partner.Singlebookingviewhat';
                        $ass_act_class='com.aquadeals.partner.SingleAccessItemhat';

                }
                else
                {
                        $bid = $this->getValue('ad_feed_bookings','id','booking_id',$book_id);
                        $assigned_id = $this->getValue('ad_feed_bookings','assigned_id','booking_id',$book_id); 
                         $act_class='com.aquadeals.partner.Singlebookingview';
                         $ass_act_class='com.aquadeals.partner.SingleAccessItem';

                }

                if($device_id !='')
                {
                        $device[] = $device_id;
                        $target = array('activity'=>'bookings','id'=>$bid,'url'=>'','xid'=>'','push_id'=>0,'activity_class'=>$act_class,'did'=>$bid);
                        $res = $this->pushNotificationTarget('Remaining amount paid',$smscontent,$target,$device);
                        if($assigned_id !=0)
                        {
                                $dev_id = $this->getValue('ad_access_sellers','device_id','id',$assigned_id);
                                if($dev_id!='')
                                {
                                        $adevice[] = $dev_id; 
                                        $target = array('activity'=>'abookings','id'=>$bid,'url'=>'','xid'=>'','push_id'=>0,'activity_class'=>$ass_act_class,'did'=>$bid);
                                        $res = $this->pushNotificationTarget('Remaining amount paid',$smscontent,$target,$device);
                                }
                        }
                        return $res;
                }

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
                $content = "Dear $ref_name, you earned $amount AquaCash for the referral code used by your friend $installed_username.";
                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`,`web_url`) VALUES ($user_id,1,'".$content."','Referral Cash Added',0,'aquacash','com.aquadeals.user.AquaCashListActivity',0,0,'/myaquacash')");       
                $push_id =  $CI->db->insert_id();       
                $target = array('activity'=>'aquacash','id'=>0,'url'=>'','xid'=>'' ,'push_id'=>$push_id,'activity_class'=>'com.aquadeals.user.AquaCashListActivity','pid'=>0,'did'=>0,'type'=>'');
                $res = $this->pushNotificationTarget('Referral Cash Added',$content,$target,$device);
        }


        //Custom Pushnotifications to sellers
        public function customPush($device,$content,$user_id,$type,$title,$target,$img)
        {
                $content1 = str_replace("'", "\'", $content);
                $CI = & get_instance();
                if($target==1)//Home screen
                {
                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`) VALUES ($user_id,$type,'".$content1."','Custom Message',0,'home','com.aquadeals.partner.HomeDashboard',0,0)");     
                $push_id =  $CI->db->insert_id();
                $target = array('activity'=>'home','id'=>0,'type'=>$type,'url'=>$img,'xid'=>'' ,'push_id'=>$push_id,'activity_class'=>'com.aquadeals.partner.HomeDashboard','pid'=>0,'did'=>0);
                
                }
                if($target==2)//Deals screen
                {
                    $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`) VALUES ($user_id,$type,'".$content1."','Custom Message',0,'home','com.aquadeals.partner.MydealslistTabs',0,0)");     
                $push_id =  $CI->db->insert_id();
                $target = array('activity'=>'home','id'=>0,'type'=>$type,'url'=>$img,'xid'=>'' ,'push_id'=>$push_id,'activity_class'=>'com.aquadeals.partner.MydealslistTabs','pid'=>0,'did'=>0,'type'=>'');
                }
                if($target==3)//Bookings screen
                {
                    $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`) VALUES ($user_id,$type,'".$content1."','Custom Message',0,'home','com.aquadeals.partner.BookingsTabs',0,0)");     
                    $push_id =  $CI->db->insert_id();
                    $target = array('activity'=>'home','id'=>0,'type'=>$type,'url'=>$img,'xid'=>'' ,'push_id'=>$push_id,'activity_class'=>'com.aquadeals.partner.BookingsTabs','pid'=>0,'did'=>0,'type'=>'');
                }
                if($target==4)//Profile screen
                {
                        $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`) VALUES ($user_id,$type,'".$content1."','Custom Message',0,'home','com.aquadeals.partner.Profile',0,0)");     
                $push_id =  $CI->db->insert_id();
                
                
                $target = array('activity'=>'home','id'=>0,'type'=>$type,'url'=>$img,'xid'=>'' ,'push_id'=>$push_id,'activity_class'=>'com.aquadeals.partner.Profile','pid'=>0,'did'=>0,'type'=>'');
                }
                if($target==5)//Version update
                {
                        $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`) VALUES ($user_id,$type,'".$content1."','Custom Message',0,'home','0',0,0)");     
                $push_id =  $CI->db->insert_id();
                $target = array('activity'=>'home','id'=>0,'type'=>$type,'url'=>$img,'xid'=>'' ,'push_id'=>$push_id,'activity_class'=>'0','pid'=>0,'did'=>0,'type'=>'');
                }
                if($target==6)//Leads screen
                {
                        $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`) VALUES ($user_id,$type,'".$content1."','Custom Message',0,'home','com.aquadeals.partner.LeadsTabsActivity',0,0)");     
                $push_id =  $CI->db->insert_id();
                $target = array('activity'=>'home','id'=>0,'type'=>$type,'url'=>$img,'xid'=>'' ,'push_id'=>$push_id,'activity_class'=>'com.aquadeals.partner.LeadsTabsActivity','pid'=>0,'did'=>0,'type'=>'');
                }
                $res = $this->pushNotificationTarget($title,$content,$target,$device);
              
                return $res;      
        }

        //Custom Pushnotifications
        public function deal_info($device,$content,$user_id,$type,$title,$did)
        {
                $CI = & get_instance();
                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`) VALUES ($user_id,$type,'".$content."','".$title."',$did,'deal details','',0,$did)");
                $push_id =  $CI->db->insert_id();       
                $target = array('activity'=>'deal details','id'=>$did,'url'=>'','xid'=>'','push_id'=>$push_id,'activity_class'=>'','pid'=>'','did'=>'','type'=>'');
                $res = $this->pushNotificationTarget($title,$content,$target,$device);
        }

        //Aquacash push notificaions
        public function sendAquacash_add($name,$devices,$amt,$uid)
        {
                $CI = & get_instance();
                $content = " Dear $name, Rs $amt is credited to your AquaCash account. Book a best deal now"; 
                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`,`web_url`) VALUES ($uid,1,'".$content."','Aquacash Credited',0,'aquacash','com.aquadeals.user.AquaCashListActivity',0,0,'/myaquacash')");     
                $push_id =  $CI->db->insert_id();
                $target = array('activity'=>'aquacash','id'=>0,'url'=>'','xid'=>'','push_id'=>$push_id,'activity_class'=>'com.aquadeals.user.AquaCashListActivity','pid'=>0,'did'=>0,'type'=>'');
                $res = $this->pushNotificationTarget('Aquacash Added',$content,$target,$devices);
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
                                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`) VALUES ($owner_id,2,'".$pushcontent."','Deal Created','$dealid','deals','com.aquadeals.partner.SingleListItemhat',0,$dealid)");
                                $push_id =  $CI->db->insert_id();
                                $target = array('activity'=>'deals','id'=>$dealid,'type'=>0,'url'=>'','xid'=>'','push_id'=>$push_id,'activity_class'=>'com.aquadeals.partner.SingleListItemhat','did'=>$dealid);
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
                        $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`) VALUES ($manuf_id,2,'".$pushcontent."','Deal Promoted','$dealid','deals','com.aquadeals.partner.SingleListItem',0,$dealid)");
                        $push_id =  $CI->db->insert_id();
                        $target = array('activity'=>'deals','id'=>$dealid,'type'=>0,'url'=>'','xid'=>'','push_id'=>$push_id,'activity_class'=>'com.aquadeals.partner.SingleListItem','did'=>$dealid);
                        $res = $this->pushNotificationTarget('Deal Created',$pushcontent,$target,$manfdevice);
                }
        }

        //Send notification to user and owner whwn booking is made by user    
        public function dealBookConfiramtion($bookedId,$utype)
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
                if($utype!='user')
                {   
                        $pushcontent = "Dear $username, Congratulations! You placed an order $booking_id with AquaDeals.";
                        $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`,`web_url`) VALUES ($user_id,1,'".$pushcontent."','Order Placed','".$booking_id."','bookings','com.aquadeals.user.SeedBookingDetails','$booking_id',0,'/order_details/0/$bookedId')");
                        $push_id =  $CI->db->insert_id();
                        $target = array('activity'=>'bookings','id'=>$booking_id,'url'=>'','xid'=>'' ,'push_id'=>$push_id,'activity_class'=>'com.aquadeals.user.SeedBookingDetails','pid'=>$booking_id,'did'=>0,'type'=>'');
                        $res = $this->pushNotificationTarget('Order Placed',$pushcontent,$target,$userdevice);
                }
                //Send push notification to owner
                if($this->getValue('ad_sellers','device_id','id',$vendor_id)!='')
                {
                $ownerdevice[] = $this->getValue('ad_sellers','device_id','id',$vendor_id);
                $Opushcontent = "Dear $ownername, Congratulations! You received an order $booking_id.";
                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`) VALUES ($vendor_id,2,'".$Opushcontent."','Order Placed','".$bookedId."','bookings','com.aquadeals.partner.Singlebookingviewhat','$bookedId',0)");
                $push_id1 =  $CI->db->insert_id();
                $target1 = array('activity'=>'bookings','id'=>$bookedId,'type'=>0,'url'=>'','xid'=>'' ,'push_id'=>$push_id1,'activity_class'=>'com.aquadeals.partner.Singlebookingviewhat','did'=>$bookedId);
                $res = $this->pushNotificationTarget('Order Placed',$Opushcontent,$target1,$ownerdevice);
                }
                //Send sms to supervisor
                $squery = $CI->db->query("SELECT * from ad_access_sellers where seller_id = $vendor_id and (role=1 or role=2) and device_id!=''");

                if($squery->num_rows() > 0)
                {
                        foreach($squery->result() as $row)
                        {
                            $sdevice = array();
                            $sdevice[] = $row->device_id;
                            $supervisor = "Dear $row->name, Congratulations! You received an order $booking_id.";
                            if($row->role==1)
                            {
                                    $target1 = array('activity'=>'abookings','id'=>$bookedId,'type'=>0,'url'=>'','xid'=>'','activity_class'=>'com.aquadeals.partner.SingleAccessItemhat','did'=>$bookedId);
                            }
                            if($row->role==2)
                            {
                                    $target1 = array('activity'=>'bookings','id'=>$bookedId,'type'=>0,'url'=>'','xid'=>'','activity_class'=>'com.aquadeals.partner.Singlebookingviewhat','did'=>$bookedId);
                                    $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`) VALUES ($row->id,4,'".$supervisor."','Order Placed','".$bookedId."','bookings','com.aquadeals.partner.Singlebookingviewhat','$bookedId',0)");
                            }

                                $res = $this->pushNotificationTarget('Order Placed',$supervisor,$target1,$sdevice);
                        }
                }
                 return $res;

        }


        public function productDealBookConfiramtion($bookedId,$utype)
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
                if($utype!='user')    
                {
                        $pushcontent = "Dear $username, Congratulations! You placed an order $booking_id with AquaDeals";
                        $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`,`web_url`) VALUES ($user_id,1,'".$pushcontent."','Order Placed','".$bookedId."','pbookings','com.aquadeals.user.ProductBookingDetails','$bookedId',0,'/order_details/1/$bookedId')");
                        $push_id =  $CI->db->insert_id();
                        $target = array('activity'=>'pbookings','id'=>$bookedId,'url'=>'','xid'=>'','push_id'=>$push_id,'activity_class'=>'com.aquadeals.user.ProductBookingDetails','pid'=>$bookedId,'did'=>0,'type'=>'');
                        $res = $this->pushNotificationTarget('Order Placed',$pushcontent,$target,$userdevice);
                }
                //Send push to Manufacturer
                $manfdevice[] = $this->getValue('ad_sellers','device_id','id',$manuf_id);
                $Mpushcontent = "Dear $manufcontact, Congratulations! You received an order $booking_id.";
                if($notify_deals ==1)
                {
                        $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`) VALUES ($manuf_id,2,'".$Mpushcontent."','Order Placed','".$bookedId."','bookings','com.aquadeals.partner.Singlebookingview','$bookedId',0)");
                        $push_id1 =  $CI->db->insert_id();
                        $target1 = array('activity'=>'bookings','id'=>$bookedId,'type'=>1,'url'=>'','xid'=>'' ,'push_id'=>$push_id1,'activity_class'=>'com.aquadeals.partner.Singlebookingview','did'=>$bookedId);               
                        $res = $this->pushNotificationTarget('Order Placed',$Mpushcontent,$target1,$manfdevice);
                }
                //Send sms to supervis
                $squery = $CI->db->query("SELECT * from ad_access_sellers where seller_id = $manuf_id and (role=1 or role=2) and device_id!=''");

                if($squery->num_rows() > 0)
                {
                        foreach($squery->result() as $row)
                        {
                                $sdevice = array();
                                $sdevice[] = $row->device_id;
                                $supervisor = "Dear $row->name, Congratulations! You received an order $booking_id.";
                                if($row->role==1)
                                {
                                        $target1 = array('activity'=>'abookings','id'=>$bookedId,'type'=>1,'url'=>'','xid'=>'','activity_class'=>'com.aquadeals.partner.SingleAccessItem','did'=>$bookedId);
                                }
                                if($row->role==2)
                                {
                                        $target1 = array('activity'=>'bookings','id'=>$bookedId,'type'=>1,'url'=>'','xid'=>'','activity_class'=>'com.aquadeals.partner.Singlebookingview','did'=>$bookedId);
                                        $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`) VALUES ($row->id,4,'".$supervisor."','Order Placed','".$bookedId."','bookings','com.aquadeals.partner.Singlebookingview','$bookedId',0)");
                                }
                                
                                $res = $this->pushNotificationTarget('Order Placed',$supervisor,$target1,$sdevice);
                        }
                }
        }


        // Notify user when booking is cancelled
        public function FeedBookingCancellation($bookedId,$actUser,$check_id)
        {
                
                $CI = & get_instance();
                $query = $CI->db->query("SELECT booking_id,user_id,seller_id,deal_type_id,category_id,assigned_id,quantity from ad_feed_bookings where id = $bookedId");

                //Booking details
                $user_id =  $query->row('user_id');
                $manuf_id =  $query->row('seller_id');
                $booking_id =  $query->row('booking_id');
                $assignedid =  $query->row('assigned_id');
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
                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`,`web_url`) VALUES ($user_id,1,'".$pushcontent."','Order Cancellation','".$bookedId."','pbookings','com.aquadeals.user.ProductBookingDetails','$bookedId',0,'/order_details/1/$bookedId')");
                $push_id =  $CI->db->insert_id();
                $target = array('activity'=>'pbookings','id'=>$bookedId,'url'=>'','xid'=>'' ,'push_id'=>$push_id,'activity_class'=>'com.aquadeals.user.ProductBookingDetails','pid'=>$bookedId,'did'=>0,'type'=>'');
                if($actUser != 'user')
                {
                        $res = $this->pushNotificationTarget('Order Cancelled',$pushcontent,$target,$userdevice);
                }
                //Send push to seller
                $Mpushcontent =  "Order $booking_id status changed to cancelled.";
                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`) VALUES ($manuf_id,2,'".$Mpushcontent."','Order Cancellation','".$bookedId."','bookings','com.aquadeals.partner.Singlebookingview','$bookedId',0)");
                $push_id1 =  $CI->db->insert_id();
                if($actUser!='partner')
                {
                        $target = array('activity'=>'bookings','id'=>$bookedId,'type'=>1,'url'=>'','xid'=>'','push_id'=>$push_id,'activity_class'=>'com.aquadeals.partner.Singlebookingview','pid'=>$bookedId);
                        $res = $this->pushNotificationTarget('Order Cancelled',$Mpushcontent,$target,$manfdevice);
                }
                //Send push to supervisor
                $squery = $CI->db->query("SELECT * from ad_access_sellers where seller_id = $manuf_id and (role=1 or role=2) and device_id!=''");
                if($squery->num_rows() > 0)
                {
                        foreach($squery->result() as $row)
                        {
                                $sdevice = array();
                                $Spushcontent = "Order $booking_id status changed to cancelled.";
                                if($row->role==1 && $row->id!=$check_id)
                                {
                                        $target = array('activity'=>'abookings','id'=>$bookedId,'type'=>1,'url'=>'','xid'=>'','push_id'=>0,'activity_class'=>'com.aquadeals.partner.SingleAccessItem','did'=>$bookedId);
                                        $sdevice[] = $row->device_id;
                                        $res = $this->pushNotificationTarget('Deal Cancelled',$Spushcontent,$target,$sdevice);
                                }
                                if($row->role==2 && $row->id!=$check_id)
                                {
                                        $target = array('activity'=>'bookings','id'=>$bookedId,'type'=>1,'url'=>'','xid'=>'','push_id'=>0,'activity_class'=>'com.aquadeals.partner.Singlebookingview','did'=>$bookedId);
                                        $sdevice[] = $row->device_id;
                                        $res = $this->pushNotificationTarget('Deal Cancelled',$Spushcontent,$target,$sdevice);
                                }
                                if($row->role==2)
                                {
                                        $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`) VALUES ($row->id,4,'".$Spushcontent."','Order Cancellation','".$bookedId."','bookings','com.aquadeals.partner.Singlebookingview','$bookedId',0)");
                                }

                        }

                }

                //Send push to access person
                $assignto = $this->getValue('ad_feed_bookings','assigned_to','id',$bookedId);
                $assignid = $this->getValue('ad_feed_bookings','assigned_id','id',$bookedId);
                $assign_role = $this->getValue('ad_access_sellers','role','id',$assignid);
                if($assignto!=0)
                {
                        if($actUser != 'access' && $assign_role==0)
                        {
                                //Access person details
                                $assignid = $this->getValue('ad_feed_bookings','assigned_id','id',$bookedId);
                                $aname = $this->getValue('ad_access_sellers','name','id',$assignid);
                                $adevice[] = $this->getValue('ad_access_sellers','device_id','id',$assignid);

                                //Notify to Access person
                                if($this->getValue('ad_access_sellers','device_id','id',$assignid)!='')
                                {
                                $Apushcontent = "Order $booking_id status changed to cancelled.";
                                $target = array('activity'=>'abookings','id'=>$bookedId,'type'=>1,'url'=>'','xid'=>'','push_id'=>0,'activity_class'=>'com.aquadeals.partner.SingleAccessItem','did'=>$bookedId);
                                $res = $this->pushNotificationTarget('Order Cancelled',$Apushcontent,$target,$adevice);
                                }
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
                //$res = $this->pushNotificationTarget('Product Created',$pushcontent,$target,$manfdevice);
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
                //$res = $this->pushNotificationTarget('Product Deleted',$pushcontent,$target,$manufdevice);
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
                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`) VALUES ($manuf_id,2,'".$pushcontent."','Deal Created',$dealId,'deals','com.aquadeals.partner.Login.SingleListItem','$dealId',0)");
                $push_id =  $CI->db->insert_id();
                $target = array('activity'=>'deals','id'=>$dealId,'type'=>1,'url'=>'','xid'=>'' ,'push_id'=>$push_id,'activity_class'=>'com.aquadeals.partner.Login.SingleListItem','pid'=>$dealId,'did'=>0,'type'=>'');
                //$res = $this->pushNotificationTarget('Deal Created',$pushcontent,$target,$manfdevice);

        }





        //sending message when user is inactivated
        public function inact_user($device, $name, $app,$uid)
        {
                 //Get reffered by user details
                $CI = & get_instance();
                $Opushcontent = "Dear $name, your AquaDeals account is suspended temporarily.";

                $res = $this->pushNotification('User Inactivated',$Opushcontent,$device);
                if($app=="user"){$type=1;$act_cls='';}
                if($app=="owner"){$type=2;$act_cls='';}
                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`) VALUES ($uid,$type,'".$Opushcontent."','User Inactivated',0,'home')");    

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
                        $target = array('activity'=>'cart','id'=>$row['count'],'type'=>0,'url'=>'','xid'=>'','push_id'=>0,'activity_class'=>'com.aquadeals.user.CartListActivity','pid'=>$row['count'],'did'=>0,'type'=>'');
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
                                $target = array('activity'=>'refer','id'=>0,'type'=>0,'url'=>'','xid'=>'','push_id'=>0,'activity_class'=>'com.aquadeals.user.RefferEarnActivity','pid'=>0,'did'=>0,'type'=>'');
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
                        $target = array('activity'=>'refer','id'=>0,'type'=>0,'url'=>'','xid'=>'','push_id'=>0,'activity_class'=>'com.aquadeals.user.RefferEarnActivity','pid'=>0,'did'=>0,'type'=>'');
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
                $query = $CI->db->query("SELECT booking_id,user_id,seller_id,species_id,assigned_id,quantity from ad_bookings where id = $bookedId");

                //Booking details
                $user_id =  $query->row('user_id');
                $vendor_id =  $query->row('seller_id');
                $assignedid =  $query->row('assigned_id');
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
                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`,`web_url`) VALUES ($user_id,1,'".$pushcontent."','Order Completed','".$booking_id."','bookings','com.aquadeals.user.SeedBookingDetails','$bookedId',0,'/order_details/0/$bookedId')");
                $push_id =  $CI->db->insert_id();
                $target = array('activity'=>'bookings','id'=>$booking_id,'url'=>'','xid'=>'','push_id'=>$push_id,'activity_class'=>'com.aquadeals.user.SeedBookingDetails','pid'=>$booking_id,'did'=>0,'type'=>'');
                $res = $this->pushNotificationTarget('Order Completed',$pushcontent,$target,$userdevice);
                //Send notification to owner
                $Opushcontent = "Order $booking_id status changed to completed.";
                $push_id1 =  $CI->db->insert_id();
                if($actUser != 'owner')
                {
                        $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`) VALUES ($user_id,2,'".$pushcontent."','Order Completed','".$bookedId."','bookings','com.aquadeals.partner.Singlebookingviewhat','$bookedId',0)");
                        $target1 = array('activity'=>'bookings','id'=>$bookedId,'type'=>0,'url'=>'','xid'=>'','push_id'=>$push_id1,'activity_class'=>'com.aquadeals.partner.Singlebookingviewhat','did'=>$bookedId);
                        $res = $this->pushNotificationTarget('Order Completed',$Opushcontent,$target1,$ownerdevice);
                }
                //Send notification to supervisor
                $squery = $CI->db->query("SELECT * from ad_access_sellers where seller_id = $vendor_id and (role=1 or role=2)");
                if($squery->num_rows() > 0)
                {
                        foreach($squery->result() as $row)
                        {
                                $sdevice = array();
                                if($row->role==1 && $row->id!=$assignedid)
                                {
                                        $target1 = array('activity'=>'abookings','id'=>$bookedId,'type'=>0,'url'=>'','xid'=>'','push_id'=>0,'activity_class'=>'com.aquadeals.partner.SingleAccessItemhat','did'=>$bookedId);
                                        $sdevice[] = $row->device_id;
                                        $Spushcontent = "Order $booking_id status changed to completed.";
                                        $res = $this->pushNotificationTarget('Order Completed',$Spushcontent,$target1,$sdevice);
                                }
                                if($row->role==2 && $row->id!=$assignedid)
                                {
                                        $target1 = array('activity'=>'bookings','id'=>$bookedId,'type'=>0,'url'=>'','xid'=>'','push_id'=>0,'activity_class'=>'com.aquadeals.partner.Singlebookingviewhat','did'=>$bookedId);
                                        $sdevice[] = $row->device_id;
                                        $Spushcontent = "Order $booking_id status changed to completed.";
                                        $res = $this->pushNotificationTarget('Order Completed',$Spushcontent,$target1,$sdevice);
                                }
                                if($row->role==2)
                                {
                                        $target1 = array('activity'=>'bookings','id'=>$bookedId,'type'=>0,'url'=>'','xid'=>'','push_id'=>0,'activity_class'=>'com.aquadeals.partner.Singlebookingviewhat','did'=>$bookedId);
                                        $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`) VALUES ($row->id,4,'".$Spushcontent."','Order Completed','".$bookedId."','bookings','com.aquadeals.partner.Singlebookingviewhat','$bookedId',0)");
                                }
                        }
                }

                //Send notificaion to access person
                $assignto = $this->getValue('ad_bookings','assigned_to','id',$bookedId);
                $assignid = $this->getValue('ad_bookings','assigned_id','id',$bookedId);
                $assign_role = $this->getValue('ad_access_sellers','role','id',$assignid);
                if($assignto!=0 && $assign_role==0)
                {
                        //Access person details
                        $assignid = $this->getValue('ad_bookings','assigned_id','id',$bookedId);
                        $aname = $this->getValue('ad_access_sellers','name','id',$assignid);
                        $adevice[] = $this->getValue('ad_access_sellers','device_id','id',$assignid);

                        //Notify to Access person
                        $Apushcontent = "Order $booking_id status changed to completed.";
                        $target1 = array('activity'=>'abookings','id'=>$bookedId,'type'=>0,'xid'=>'','push_id'=>0,'activity_class'=>'com.aquadeals.partner.SingleAccessItemhat','did'=>$bookedId);
                        $res = $this->pushNotificationTarget('Order Completed',$Apushcontent,$target1,$adevice);
                }
                return 1;
        }


        // Notify user, manufacturer when product booking is completed
        public function ProductBookingComplted($bookedId,$actUser)
        {
                $CI = & get_instance();
                $query = $CI->db->query("SELECT booking_id,user_id,seller_id,deal_type_id,assigned_id,quantity from ad_feed_bookings where id = $bookedId");

                //Booking details
                $user_id =  $query->row('user_id');
                $manuf_id =  $query->row('seller_id');
                $assignedid =  $query->row('assigned_id');
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
                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`,`web_url`) VALUES ($user_id,1,'".$pushcontent."','Order Completed','".$bookedId."','pbookings','com.aquadeals.user.ProductBookingDetails','$bookedId',0,'/order_details/1/$bookedId')");
                $push_id =  $CI->db->insert_id();
                $target = array('activity'=>'pbookings','id'=>$bookedId,'url'=>'','xid'=>'' ,'push_id'=>$push_id,'activity_class'=>'com.aquadeals.user.ProductBookingDetails','pid'=>$bookedId,'did'=>0,'type'=>'');
                $res = $this->pushNotificationTarget('Order Completed',$pushcontent,$target,$userdevice);

                //Send push to seller
                if($mdevice != '')
                {
                        $Opushcontent = "Order $booking_id status changed to completed.";
                        $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`) VALUES ($manuf_id,2,'".$Opushcontent."','Order Completed','".$bookedId."','bookings','com.aquadeals.partner.Singlebookingview','$bookedId',0)");
                        $push_id1 =  $CI->db->insert_id();
                        if($actUser != 'owner')
                        {
                                $target1 = array('activity'=>'bookings','id'=>$bookedId,'type'=>1,'url'=>'','xid'=>'','push_id'=>$push_id1,'activity_class'=>'com.aquadeals.partner.Singlebookingview','did'=>$bookedId);
                                $res = $this->pushNotificationTarget('Order Completed',$Opushcontent,$target1,$manfdevice);
                        }
                }
                //Send sms to supervisor
                $squery = $CI->db->query("SELECT * from ad_access_sellers where seller_id = $manuf_id and (role=1 or role=2)");
                if($squery->num_rows() > 0)
                {
                        foreach($squery->result() as $row)
                        {
                                $sdevice = array();
                                $Spushcontent = "Order $booking_id status changed to completed.";
                                if($row->role==1 && $row->id!=$assignedid)
                                {
                                        $target1 = array('activity'=>'abookings','id'=>$bookedId,'type'=>1,'url'=>'','xid'=>'','push_id'=>0,'activity_class'=>'com.aquadeals.partner.SingleAccessItem','did'=>$bookedId);
                                        $sdevice[] = $row->device_id;
                                        $res = $this->pushNotificationTarget('Order Completed',$Spushcontent,$target1,$sdevice);
                                }
                                if($row->role==2 && $row->id!=$assignedid)
                                {
                                        $target1 = array('activity'=>'bookings','id'=>$bookedId,'type'=>1,'url'=>'','xid'=>'','push_id'=>0,'activity_class'=>'com.aquadeals.partner.Singlebookingview','pid'=>$bookedId);
                                        $sdevice[] = $row->device_id;
                                        $res = $this->pushNotificationTarget('Order Completed',$Spushcontent,$target1,$sdevice);
                                }
                                if($row->role==2)
                                {
                                        $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`) VALUES ($row->id,4,'".$Spushcontent."','Order Completed','".$bookedId."','bookings','com.aquadeals.partner.Singlebookingview','$bookedId',0)");
                                }
                        }
                }

                //Send sms to Access person
                $assignto = $this->getValue('ad_feed_bookings','assigned_to','id',$bookedId);
                $assignid = $this->getValue('ad_feed_bookings','assigned_id','id',$bookedId);
                $assign_role = $this->getValue('ad_access_sellers','role','id',$assignid);
                if($assignto!=0 && $assign_role==0)
                {
                        //Access person details
                        $assignid = $this->getValue('ad_feed_bookings','assigned_id','id',$bookedId);
                        $aname = $this->getValue('ad_access_sellers','name','id',$assignid);
                        $adevice[] = $this->getValue('ad_access_sellers','device_id','id',$assignid);

                        //Sms to access person
                        $Apushcontent = "Order $booking_id status changed to completed.";
                        $target1 = array('activity'=>'abookings','id'=>$bookedId,'type'=>1,'url'=>'','xid'=>'','push_id'=>0,'activity_class'=>'com.aquadeals.partner.SingleAccessItem','did'=>$bookedId);
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
                $pushcontent = "Dear $username, Congratulations! You earned ₹ $prebook Cashback on your Order $booking_id.";
                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`activity_class`,`pid`,`did`,`web_url`) VALUES ($user_id,1,'".$pushcontent."','Cashback Received','com.aquadeals.user.AquaCashListActivity',0,0,'/myaquacash')");
                $push_id =  $CI->db->insert_id();
                $target = array('activity'=>'aquacash','id'=>0,'url'=>'','xid'=>'','push_id'=>$push_id,'activity_class'=>'com.aquadeals.user.AquaCashListActivity','pid'=>0,'did'=>0,'type'=>'');
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
                $pushcontent = "Dear $username, Congratulations! You earned ₹ $prebook Cashback on your Order $booking_id.";
                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`activity_class`,`pid`,`did`,`web_url`) VALUES ($user_id,1,'".$pushcontent."','Cashback Received','com.aquadeals.user.AquaCashListActivity',0,0,'/myaquacash')");
                $push_id =  $CI->db->insert_id();
                $target = array('activity'=>'aquacash','id'=>0,'url'=>'','xid'=>'','push_id'=>$push_id,'activity_class'=>'com.aquadeals.user.AquaCashListActivity','pid'=>0,'did'=>0,'type'=>'');
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
                $pushcontent = "Dear $username, Congratulations! You earned ₹ $prebook Cashback on your Order $booking_id.";
                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`activity_class`,`pid`,`did`,`web_url`) VALUES ($user_id,1,'".$pushcontent."','Cashback Received','com.aquadeals.user.AquaCashListActivity',0,0,'/myaquacash')");
                $push_id =  $CI->db->insert_id();
                $target = array('activity'=>'aquacash','id'=>0,'url'=>'','xid'=>'' ,'push_id'=>$push_id,'activity_class'=>'com.aquadeals.user.AquaCashListActivity','pid'=>0,'did'=>0,'type'=>'');
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

                $pushcontent = "Dear $username, Congratulations! You earned ₹ $prebook Cashback on your Order $booking_id.";
                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`activity_class`,`pid`,`did`,`web_url`) VALUES ($user_id,1,'".$pushcontent."','Cashback Received','com.aquadeals.user.AquaCashListActivity',0,0,'/myaquacash')");
                $push_id =  $CI->db->insert_id();
                $target = array('activity'=>'aquacash','id'=>0,'url'=>'','xid'=>'' ,'push_id'=>$push_id,'activity_class'=>'com.aquadeals.user.AquaCashListActivity','pid'=>0,'did'=>0,'type'=>'');
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
                $pushcontent = "Dear $username, Your AquaCash account is credited back to your account";
                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`,`web_url`) VALUES ($user_id,1,'".$pushcontent."','Order Cashback',0,'aquacash','com.aquadeals.user.AquaCashListActivity',0,0,'/myaquacash')");
                $push_id =  $CI->db->insert_id();
                $target = array('activity'=>'aquacash','id'=>0,'url'=>'','xid'=>'','push_id'=>$push_id,'activity_class'=>'com.aquadeals.user.AquaCashListActivity','pid'=>0,'did'=>0,'type'=>'');
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
                        $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`) VALUES ($owner_id,2,'".$pushcontent."','Deal Completed','$dealId','deals','com.aquadeals.partner.SingleListItemhat',0,$dealId)");
                        $push_id =  $CI->db->insert_id();
                        $target = array('activity'=>'deals','id'=>$dealId,'type'=>0,'url'=>'','xid'=>'' ,'push_id'=>$push_id,'activity_class'=>'com.aquadeals.partner.SingleListItemhat','did'=>$dealId);
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
                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`) VALUES ($owner_id,2,'".$pushcontent."','Deal Completed','$dealId','deals','com.aquadeals.partner.SingleListItem',0,$dealId)");
                $push_id =  $CI->db->insert_id();
                $target = array('activity'=>'deals','id'=>$dealId,'type'=>1,'url'=>'','xid'=>'' ,'push_id'=>$push_id,'activity_class'=>'com.aquadeals.partner.SingleListItem','did'=>$dealId);
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
                        $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`) VALUES ($owner_id,2,'".$pushcontent."','Deal Reached Minimum Qty','$dealId','deals','com.aquadeals.partner.SingleListItemhat',0,$dealId)");
                        $push_id =  $CI->db->insert_id();
                        $target = array('activity'=>'deals','id'=>$dealId,'type'=>0,'url'=>'','xid'=>'','push_id'=>$push_id,'activity_class'=>'com.aquadeals.partner.SingleListItemhat','pid'=>'','did'=>$dealId,'type'=>'0');
                        //$res = $this->pushNotificationTarget('Deal Reached Minimum Qty',$pushcontent,$target,$ownerdevice);
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
                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`) VALUES ($hatch_id,2,'".$pushcontent."','Deal Deleted','0','dashboard','com.aquadeals.partner.SingleListItemhat',0,0)");
                $push_id =  $CI->db->insert_id();
                $target = array('activity'=>'dashboard','id'=>0,'type'=>0,'url'=>'','xid'=>'' ,'push_id'=>$push_id,'activity_class'=>'com.aquadeals.partner.SingleListItemhat','did'=>$id);
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
        $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`) VALUES ($manuf_id,2,'".$pushcontent."','Deal Deleted','0','dashboard','com.aquadeals.partner.SingleListItemhat',0,0)");
        $push_id =  $CI->db->insert_id();
        $target = array('activity'=>'dashboard','id'=>0,'type'=>1,'url'=>'','xid'=>'' ,'push_id'=>$push_id,'activity_class'=>'com.aquadeals.partner.SingleListItem','did'=>'');
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
                        $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`) VALUES ($owner_id,2,'".$pushcontent."','Deal Created','$dealId','deals','com.aquadeals.partner.SingleListItemhat',0,$dealId)");
                        $push_id =  $CI->db->insert_id();
                        $target = array('activity'=>'deals','id'=>$dealId,'type'=>0,'url'=>'','xid'=>'' ,'push_id'=>$push_id,'activity_class'=>'com.aquadeals.partner.SingleListItemhat','pid'=>'','did'=>$dealId,'type'=>'');
                        //$res = $this->pushNotificationTarget('Deal Created',$pushcontent,$target,$ownerdevice);
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
                        $pushcontent  = "Dear $username, your AquaCash balance is low. Refer your friends and earn more AquaCash.";
                        $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`,`web_url`) VALUES ($userId,1,'".$pushcontent."','AquaCash Low',0,'aquacash','com.aquadeals.user.AquaCashListActivity',0,0,'/myaquacash')");
                        $push_id =  $CI->db->insert_id();
                        $target = array('activity'=>'aquacash','id'=>0,'url'=>'','xid'=>'','push_id'=>$push_id,'activity_class'=>'com.aquadeals.user.AquaCashListActivity','pid'=>0,'did'=>0,'type'=>'');
                        $res = $this->pushNotificationTarget('AquaCash Low',$pushcontent,$target,$userdevice);

                }
        }


        function aquaCashNotification($uid,$amt,$type)
        {
                $CI = & get_instance();
                $user_query = $CI->db->query("SELECT device_id,name from ad_users where id = $uid");
                $userdevice[] = $user_query->row('device_id');
                $name = $user_query->row('name');
                if($type == 'direct')
                {
                        $pushcontent = "Dear $name, you earned ₹ ".$amt." AquaCash for registering with AquaDeals. Use AquaCash to shop now";
                        
                }
                else if($type == 'reffered')
                {
                        $pushcontent  = "Dear $name, you earned ₹ ".$amt." AquaCash for registering with AquaDeals. Use AquaCash to shop now";
                }
                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`,`web_url`) VALUES ($uid,1,'".$pushcontent."','Congratulations',0,'aquacash','com.aquadeals.user.AquaCashListActivity',0,0,'/myaquacash')");
                $push_id =  $CI->db->insert_id();
                $target = array('activity'=>'aquacash','id'=>0,'url'=>'','xid'=>'','push_id'=>$push_id,'activity_class'=>'com.aquadeals.user.AquaCashListActivity','pid'=>0,'did'=>0,'type'=>'');
                $res = $this->pushNotificationTarget('Congratulations !',$pushcontent,$target,$userdevice);

        }


        function inform2Owner($id,$device_id,$name,$amt,$type,$user_type,$bid)
        {
                if($type == 'Debit')
                {       
                        $title="Amount debited";
                        $message = $this->getValue('ad_messages','message','action','debit_owner_amount');
                        $act = 'netpayable';
                        $act_class = 'com.aquadeals.partner.Netpayable';
                }
                if($type == 'Credit')
                {
                        $title="Amount credited";
                        $message = $this->getValue('ad_messages','message','action','credit_amount_to_owner');
                        $act = 'netreceivable';
                        $act_class = 'com.aquadeals.partner.Netrceivable';
                }

                $message = str_replace("&owner&",$name,$message);
                $message = str_replace("&amt&",$amt,$message);
                $message = str_replace("&orderid&",$bid,$message);

                $ownerdevice[] = $device_id;
                $CI = & get_instance(); 
                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`) VALUES ($id,$user_type,'".$message."','$title',0,'dashboard','$act_class')");
                $push_id =  $CI->db->insert_id();
                $target = array('activity'=>$act,'id'=>0,'type'=>1,'url'=>'','xid'=>'','push_id'=>$push_id,'activity_class'=>$act_class,'pid'=>'','did'=>'','type'=>'');
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
                                $target = array('activity'=>'profile','id'=>0,'url'=>'','xid'=>'','push_id'=>0,'activity_class'=>'com.aquadeals.user.ProfileActivity','pid'=>'','did'=>'','type'=>'');
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
                                $target = array('activity'=>'profile','id'=>0,'type'=>$row['type'],'url'=>'','xid'=>'','push_id'=>0,'activity_class'=>'com.aquadeals.partner.HomeDashboard','did'=>'');
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
                                $target = array('activity'=>'profile','id'=>0,'url'=>'','xid'=>'','push_id'=>'0','activity_class'=>'com.aquadeals.user.ProfileActivity','pid'=>'','did'=>'','type'=>'');
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
                                $target = array('activity'=>'profile','id'=>0,'type'=>$row['type'],'url'=>'','xid'=>'','push_id'=>0,'activity_class'=>'com.aquadeals.partner.HomeDashboard','pid'=>'','did'=>'','type'=>'');
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
                                $title = 'You are missing business';
                                $target = array('activity'=>'create deal','id'=>0,'type'=>$row['type'],'url'=>'','xid'=>'','push_id'=>0,'activity_class'=>'com.aquadeals.partner.HomeDashboard','pid'=>'','did'=>'','type'=>'');
                                $device[] = $row['device_id'];
                                $this->pushNotificationTarget($title,$row['message'],$target,$device);
                                $device[] = '';
                                $row['device_id'] = '';
                        }
                }
                //return 'success';
        }


        function dexp_tmrw_alert($details)
        {
                foreach($details as $row)
                {
                        $device = array();
                        if(isset($row['device_id'])&& $row['device_id']!='')
                        {
                                $device[] = array();
                                $title = 'Deal Expiry Notice';
                                $target = array('activity'=>'deals','id'=>$row['did'],'type'=>0,'url'=>'','xid'=>'','push_id'=>0,'activity_class'=>'com.aquadeals.partner.SingleListItemhat','did'=>$row['did']);
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
                                $title = 'Deal Expiry Notice';
                                $target = array('activity'=>'deals','id'=>$row['did'],'type'=>0,'url'=>'','xid'=>'','push_id'=>0,'activity_class'=>'com.aquadeals.partner.SingleListItemhat','did'=>$row['did']);
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
                                $title = 'Deal Expiry Notice';
                                $target = array('activity'=>'deals','id'=>$row['did'],'type'=>0,'url'=>'','xid'=>'','push_id'=>0,'activity_class'=>'com.aquadeals.partner.SingleListItemhat','did'=>$row['did']);
                                $device[] = $row['device_id'];
                                $this->pushNotificationTarget($title,$row['d_exp_msg'],$target,$device);
                                $device[] = '';
                                $row['device_id'] = '';
                        }
                }
                return 'success';
        }

        function customUserPush($devices,$text,$title,$target,$target_sub,$target_sub_sub,$img,$ids,$brand_details)
        {
                $text1 = $text;
                $title1 = $title;
                $CI = & get_instance();
                $gf = new Globalfuns();
                if($target==1)//Home page
                {
                        $activity ='home' ;
                        $action_id=0;
                        foreach($ids as $id)
                        {
                                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`,`web_url`) VALUES ($id,1,'".$text1."','".$title1."',$action_id,'".$activity."','com.aquadeals.user.HomePageAfterLogin',0,0,'')");
                                $id='';
                                $push_id =  $CI->db->insert_id();
                                $target = array('activity'=>'home','id'=>0,'url'=>$img,'xid'=>'' ,'push_id'=>$push_id,'activity_class'=>'com.aquadeals.user.HomePageAfterLogin','pid'=>0,'did'=>0,'type'=>'');
                        }
                        $res = $this->pushNotificationTarget($title,$text,$target,$devices);
                }
                if($target==2)//Seed deal detials page
                {
                        $owner_id = $this->getValue('ad_vendor_deals','seller_id','id',$target_sub);
                        $species_id = $this->getValue('ad_vendor_deals','species_id','id',$target_sub);
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
                        $activity = 'deals';
                        $action_id=$target_sub;
                        foreach($ids as $id)
                        {
                                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`,`web_url`) VALUES ($id,1,'".$text1."','".$title1."',$action_id,'".$activity."','com.aquadeals.user.SeedDetailsActivity','$target_sub',$owner_id,'/sdetails/$species/$action_id')");
                                $id='';
                                $push_id =  $CI->db->insert_id();
                                $target = array('activity'=>'deals','id'=>$target_sub,'xid'=>$owner_id,'url'=>$img ,'push_id'=>$push_id,'activity_class'=>'com.aquadeals.user.SeedDetailsActivity','pid'=>$target_sub,'did'=>$owner_id,'type'=>'');
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
                                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`,`web_url`) VALUES ($id,1,'".$text1."','".$title1."',$action_id,'".$activity."','com.aquadeals.user.ProductDetailsActivity','$product_id',$target_sub,'/pdetails/$dtype/$cat/$product/$target_sub/$product_id')");
                                $id='';
                                $push_id =  $CI->db->insert_id();
                                $target = array('activity'=>'pdeals','id'=>$target_sub,'xid'=>$product_id,'url'=>$img ,'push_id'=>$push_id,'activity_class'=>'com.aquadeals.user.ProductDetailsActivity','pid'=>$product_id,'did'=>$target_sub,'type'=>'');
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
                                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`,`web_url`) VALUES ($id,1,'".$text1."','".$title1."',$action_id,'".$activity."','com.aquadeals.user.SeedBookingDetails','$action_id',0,'')");
                                $id='';
                                $push_id =  $CI->db->insert_id();
                                $target = array('activity'=>'bookings','id'=>$product_id,'url'=>$img,'xid'=>'' ,'push_id'=>$push_id,'activity_class'=>'com.aquadeals.user.SeedBookingDetails','pid'=>$action_id,'did'=>0,'type'=>'');
                        }
                        $res = $this->pushNotificationTarget($title,$text,$target,$devices);
                }
                if($target==5)//Product order details
                {
                        $activity ='pbookings' ;
                        $action_id=$target_sub;
                        foreach($ids as $id)
                        {
                                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`) VALUES ($id,1,'".$text1."','".$title1."',$action_id,'".$activity."','com.aquadeals.user.ProductBookingDetails','$action_id',0)");
                                $id='';
                                $push_id =  $CI->db->insert_id();
                                $target = array('activity'=>'pbookings','id'=>$target_sub,'url'=>$img,'xid'=>'' ,'push_id'=>$push_id,'activity_class'=>'com.aquadeals.user.ProductBookingDetails','pid'=>$action_id,'did'=>0,'type'=>'');
                        }
                        $res = $this->pushNotificationTarget($title,$text,$target,$devices);
                }
                if($target==6)//Offers details
                {
                        $activity ='offers' ;
                        $action_id=$target_sub;
                        foreach($ids as $id)
                        {
                                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`,`web_url`) VALUES ($id,1,'".$text1."','".$title1."',$action_id,'".$activity."','com.aquadeals.user.OfferDetailsActivity','$action_id',0,'/offer/$action_id/details')");
                                $id='';
                                $push_id =  $CI->db->insert_id();
                                $target = array('activity'=>'offers','id'=>$target_sub,'url'=>$img,'xid'=>'' ,'push_id'=>$push_id,'activity_class'=>'com.aquadeals.user.OfferDetailsActivity','pid'=>$action_id,'did'=>0,'type'=>'');
                        }
                        $res = $this->pushNotificationTarget($title,$text,$target,$devices);
                }
                if($target==7)//Profile page
                {
                        $activity ='profile' ;
                        $action_id=$target;
                        foreach($ids as $id)
                        {
                                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`,`web_url`) VALUES ($id,1,'".$text1."','".$title1."',$action_id,'".$activity."','com.aquadeals.user.ProfileActivity','$action_id',0,'/profile')");
                                $id='';
                                $push_id =  $CI->db->insert_id();
                                $target = array('activity'=>'profile','id'=>0,'url'=>$img,'xid'=>'','push_id'=>$push_id,'activity_class'=>'com.aquadeals.user.ProfileActivity','pid'=>$action_id,'did'=>0,'type'=>'');
                         }
                        $res = $this->pushNotificationTarget($title,$text,$target,$devices);
                }
                if($target==8)//Brands page
                {
									if($brand_details==1)
									{
										$act_cls = 'com.aquadeals.user.BrandDetailsActivity';
									}
									else
									{
										$act_cls = 'com.aquadeals.user.ProductBrandListActivity';
									}
									$lang = '';
									$activity ='brands' ;
									$action_id=$target;
									$dtype_id = $this->getValue('ad_brand_types','type_id','brand_id',$target_sub);
									$dtype_name = $gf->getValue('ad_deal_types','deal_type','id',$dtype_id);
									$dtype= strtolower(str_replace(array('  ', ' '), '-', preg_replace('/[^a-zA-Z0-9 s]/', '', trim($dtype_name)))); 
									$brnd = $gf->getValue('ad_brands','brand_name','id',$target_sub);
									$brand= strtolower(str_replace(array('  ', ' '), '-', preg_replace('/[^a-zA-Z0-9 s]/', '', trim($brnd )))); 
									foreach($ids as $id)
									{
									$CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`type`,`pid`,`did`,`web_url`) VALUES ($id,1,'".$text1."','".$title1."',$action_id,'".$activity."','$act_cls','brand','$target_sub',$dtype_id,'/pdeals/$dtype/$brand/$target_sub/brand/ $dtype_id')");
									$lang = $gf->getValue("ad_users","language","id",$id);
									$id='';
									$push_id =  $CI->db->insert_id();
									}
									$title = $gf->getLanguage("ad_brand_title_lang",$lang,"brand_id",$target_sub);
									$target = array('activity'=>'profile','id'=>0,'url'=>$img,'xid'=>'','push_id'=>$push_id,'activity_class'=>$act_cls,'pid'=>$target_sub,'title'=>$title,'did'=>$dtype_id,'type'=>'brand'); 
									$res = $this->pushNotificationTarget($title,$text,$target,$devices);
                }
        if($target==9)//Deal types page
        {
                if($target_sub!=0)
                {
                        $deal_type = $this->getValue('ad_deal_types','type','id',$target_sub);
                if($target_sub ==8)
                {
                    $deal_type = 8;
                }
                        if($target_sub_sub!=0)
                        {
                                $action_id = $target_sub_sub;
                                if($deal_type==1)
                                {
                        $activity = 'com.aquadeals.user.SeedDealListActivity';  
                        $lang = '';                                                                                     
                        foreach($ids as $id)
                                        {                                                
                                        $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`,`web_url`) VALUES ($id,1,'".$text1."','".$title1."',$action_id,'".$activity."','com.aquadeals.user.SeedDealListActivity','$action_id',1,'/seed')");
                            $lang = $gf->getValue("ad_users","language","id",$id);
                                        $id='';
                                        $push_id =  $CI->db->insert_id();
                                        }
                        $title = $gf->getLanguage("ad_category_title_lang",$lang,"cat_id",$target_sub_sub);
                                        $target = array('activity'=>'profile','id'=>0,'title'=>$title,'url'=>$img,'xid'=>'','push_id'=>$push_id,'activity_class'=>'com.aquadeals.user.SeedDealListActivity','pid'=>$target_sub_sub,'did'=>1,'type'=>''); 
                                }
                                if($deal_type==2)
                                {
                        $activity = 'com.aquadeals.user.ProductBrandListActivity'; 
                        $lang = '';
                                        foreach($ids as $id)
                                        { 
                                        $dtype_name = $gf->getValue('ad_deal_types','deal_type','id',$target_sub);
                                        $dtype= strtolower(str_replace(array('  ', ' '), '-', preg_replace('/[^a-zA-Z0-9 s]/', '', trim($dtype_name)))); 
                                        $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`,`web_url`) VALUES ($id,1,'".$text1."','".$title1."',$action_id,'".$activity."','com.aquadeals.user.ProductBrandListActivity','$target_sub_sub',$target_sub,'/pdeals/$dtype/all/$target_sub')");
                            $lang = $gf->getValue("ad_users","language","id",$id);
                                        $id='';
                                        $push_id =  $CI->db->insert_id();
                                        }
                        $title = $gf->getLanguage("ad_category_title_lang",$lang,"cat_id",$target_sub_sub);
                                        $target = array('activity'=>'profile','id'=>0,'url'=>$img,'xid'=>'','title'=>$title,'push_id'=>$push_id,'activity_class'=>'com.aquadeals.user.ProductBrandListActivity','pid'=>$target_sub_sub,'did'=>$target_sub,'type'=>'Pcategory'); 
                                }
                        }
                        if($target_sub_sub==0)
                        {
                            $action_id =    $target_sub_sub;                                                                                
                            if($deal_type==1)
                            {
                                $activity = 'com.aquadeals.user.SeedDealListActivity';
                                $lang='';
                                foreach($ids as $id)
                                {                                                
                                    $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`,`web_url`) VALUES ($id,1,'".$text1."','".$title1."',$action_id,'".$activity."','com.aquadeals.user.SeedDealListActivity','$action_id',1,'/seed')");
                                    $lang = $gf->getValue("ad_users","language","id",$id);
                                    $id='';
                                    $push_id =  $CI->db->insert_id();
                                }

                                $title = $gf->getLanguage("ad_dealtype_lang",$lang,"deal_type_id",$deal_type);
                                $target = array('activity'=>'profile','id'=>0,'url'=>$img,'title'=>$title,'xid'=>'','push_id'=>$push_id,'activity_class'=>'com.aquadeals.user.SeedDealListActivity','pid'=>0,'did'=>1,'type'=>''); 
                            }
                            if($deal_type==8)
                            {
                                $activity = 'com.aquadeals.user.SeedDealListActivity';
                                $lang='';
                                foreach($ids as $id)
                                {                                                
                                    $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`,`web_url`) VALUES ($id,1,'".$text1."','".$title1."',$action_id,'".$activity."','com.aquadeals.user.SeedDealListActivity','$action_id',$deal_type,'/nauplii')");
                                    $lang = $gf->getValue("ad_users","language","id",$id);
                                    $id='';
                                    $push_id =  $CI->db->insert_id();
                                }
                                $title = $gf->getLanguage("ad_dealtype_lang",$lang,"deal_type_id",$deal_type);
                                $target = array('activity'=>'profile','id'=>0,'url'=>$img,'title'=>$title,'xid'=>'','push_id'=>$push_id,'activity_class'=>'com.aquadeals.user.SeedDealListActivity','pid'=>0,'did'=>8,'type'=>''); 
                            }
                            if($deal_type==2)
                            {
                                $activity = 'com.aquadeals.user.BrandCategoryActivity'; 
                                $lang='';
                                foreach($ids as $id)
                                {                                                
                                    
                                    $dtype_name = $gf->getValue('ad_deal_types','deal_type','id',$target_sub);
                                    $dtype= strtolower(str_replace(array('  ', ' '), '-', preg_replace('/[^a-zA-Z0-9 s]/', '', trim($dtype_name)))); 
                                    $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`,`web_url`) VALUES ($id,1,'".$text1."','".$title1."',$action_id,'".$activity."','com.aquadeals.user.BrandCategoryActivity','$target_sub',0,'/pdeals/$dtype/all/$target_sub')");
                                    $lang = $gf->getValue("ad_users","language","id",$id);
                                    $id='';
                                    $push_id =  $CI->db->insert_id();
                                }
                                $title = $gf->getLanguage("ad_dealtype_lang",$lang,"deal_type_id",$target_sub);
                                $target = array('activity'=>'profile','id'=>0,'url'=>$img,'xid'=>'','title'=>$title,'push_id'=>$push_id,'activity_class'=>'com.aquadeals.user.BrandCategoryActivity','pid'=>$target_sub,'did'=>0,'type'=>''); 
                            }
                        }
                }
                $res = $this->pushNotificationTarget($title,$text,$target,$devices);
        }
                
                if($target==10)//version update
                {
                    $activity ='version' ;
                    $action_id=$target;
                    foreach($ids as $id)
                    {
                        $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`,`web_url`) VALUES ($id,1,'".$text1."','".$title1."',$action_id,'".$activity."','versionUpdate','$action_id',0,'https://play.google.com/store/apps/details?id=com.aquadeals.user&hl=en')");
                        $id='';
                        $push_id =  $CI->db->insert_id();
                        $target = array('activity'=>'update','id'=>0,'url'=>$img,'xid'=>'','push_id'=>$push_id,'activity_class'=>'update','pid'=>$action_id,'did'=>0,'type'=>'');
                     }
                    
                    $res = $this->pushNotificationTarget($title,$text,$target,$devices);
                }
                if($target == 11)
                {
					$lang = '';
                    $for_type = $gf->getValue("ad_deal_offer_types","for_type","id",$target_sub);
                    $action_id=$target_sub;
                    if($for_type==6)
                    {
                        $activity ='partner' ;
                        $target_sub = $gf->getValue("ad_deal_offer_types","related_id","id",$target_sub);
                        $name = $gf->getValue("ad_deal_offer_types","type","id",$target_sub);
                    }
                    else
                    {
                        $activity ='store' ;
                        $target_sub =$target_sub;
                        $name = $gf->getValue("ad_deal_offer_types","type","id",$target_sub);
                    }
					
					$sname = strtolower(str_replace(array('  ', ' '), '-', preg_replace('/[^a-zA-Z0-9 s]/', '', trim($name)))); 
					
					foreach($ids as $id)
					{
					$CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`type`,`pid`,`did`,`web_url`) VALUES ($id,1,'".$text1."','".$title1."',$action_id,'".$activity."','com.aquadeals.user.ProductBrandListActivity','store','$target_sub',0,'/stores/$name/$target_sub')");
					$lang = $gf->getValue("ad_users","language","id",$id);
					$id='';
					$push_id =  $CI->db->insert_id();
					}
					$title = $gf->getLanguage("ad_deal_offer_types",$lang,"id",$target_sub);
					$target = array('activity'=>'profile','id'=>0,'url'=>$img,'xid'=>'','push_id'=>$push_id,'activity_class'=>'com.aquadeals.user.ProductBrandListActivity','pid'=>$target_sub,'title'=>$title,'did'=>'','type'=>$activity); 
					$res = $this->pushNotificationTarget($title,$text,$target,$devices);
                }
                if($target==12)//Ad Asssits
                {
					$lang = '';
					$activity ='home' ;
					$action_id=0;

					foreach($ids as $id)
					{
					$CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`type`,`pid`,`did`,`web_url`) VALUES ($id,1,'".$text1."','".$title1."',$action_id,'".$activity."','com.aquadeals.user.ProductBrandListActivity','ad_assist','0',0,'')");
					$lang = $gf->getValue("ad_users","language","id",$id);
					$id='';
					$push_id =  $CI->db->insert_id();
					}
					//$title = $gf->getLanguage("ad_deal_offer_types",$lang,"id",$target_sub);
					$target = array('activity'=>'home','id'=>0,'url'=>$img,'xid'=>'','push_id'=>$push_id,'activity_class'=>'com.aquadeals.user.ProductBrandListActivity','pid'=>0,'title'=>$title,'did'=>'','type'=>'ad_assist'); 
					$res = $this->pushNotificationTarget($title,$text,$target,$devices);
                }
                if($target==13)//caa approved
                {
					$lang = '';
					$activity ='home' ;
					$action_id=0;

					foreach($ids as $id)
					{
					$CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`type`,`pid`,`did`,`web_url`) VALUES ($id,1,'".$text1."','".$title1."',$action_id,'".$activity."','com.aquadeals.user.ProductBrandListActivity','caa_approved',0,0,'/ad-banners/caa-approved')");
					$lang = $gf->getValue("ad_users","language","id",$id);
					$id='';
					$push_id =  $CI->db->insert_id();
					}
					//$title = $gf->getLanguage("ad_deal_offer_types",$lang,"id",$target_sub);
					$target = array('activity'=>'home','id'=>0,'url'=>$img,'xid'=>'','push_id'=>$push_id,'activity_class'=>'com.aquadeals.user.ProductBrandListActivity','pid'=>0,'title'=>$title,'did'=>'','type'=>'caa_approved'); 
					$res = $this->pushNotificationTarget($title,$text,$target,$devices);
                }
                if($target==14)//Ad Guarantee
                {
					$lang = '';
					$activity ='home' ;
					$action_id=$target_sub;

					foreach($ids as $id)
					{
					$CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`type`,`pid`,`did`,`web_url`) VALUES ($id,1,'".$text1."','".$title1."',0,'".$activity."','com.aquadeals.user.ProductBrandListActivity','ad_guarantee',0,0,'/ad-banners/ad-guarantee')");
					$lang = $gf->getValue("ad_users","language","id",$id);
					$id='';
					$push_id =  $CI->db->insert_id();
					}
					//$title = $gf->getLanguage("ad_deal_offer_types",$lang,"id",$target_sub);
					$target = array('activity'=>'home','id'=>0,'url'=>$img,'xid'=>'','push_id'=>$push_id,'activity_class'=>'com.aquadeals.user.ProductBrandListActivity','pid'=>0,'title'=>$title,'did'=>'','type'=>'ad_guarantee'); 
					$res = $this->pushNotificationTarget($title,$text,$target,$devices);
                }
                if($target==15)//Whish List
                {
					$lang = '';
					$activity ='home' ;
					$action_id=$target_sub;
					foreach($ids as $id)
					{
					$CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`type`,`pid`,`did`,`web_url`) VALUES ($id,1,'".$text1."','".$title1."',0,'".$activity."','com.aquadeals.user.WishListActivity','store',0,0,'/wishlist')");
					$lang = $gf->getValue("ad_users","language","id",$id);
					$id='';
					$push_id =  $CI->db->insert_id();
					}
					//$title = $gf->getLanguage("ad_deal_offer_types",$lang,"id",$target_sub);
					$target = array('activity'=>'home','id'=>0,'url'=>$img,'xid'=>'','push_id'=>$push_id,'activity_class'=>'com.aquadeals.user.WishListActivity','pid'=>0,'title'=>$title,'did'=>'','type'=>''); 
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
$res = json_decode($result);
return json_encode(array("success"=>$res->success,"fail"=>$res->failure));

}


//Send PUSH to mobile
function pushNotificationTarget($title,$message,$target, $devices)
{
    // print_r($devices);
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
    curl_close($ch);
    $res = json_decode($result);
    // print_r($result);
    // exit;
    return json_encode(array("success"=>$res->success,"fail"=>$res->failure));
    //define( 'API_ACCESS_KEY', 'AIzaSyCGwQgvVt4OqNhqyBoSshcqPWH3fswUxxo' );
//     $registrationIds = 'fsRY_owqFSc:APA91bHsSpbXQIvYH3ESunY1GmiLnZKlms6HbnNeLiSp41e34Pg7bB5huMGqDFm4ctdldTlye7PT9DT54aHomDfGfmgZzISjR1F5yueZnJxtibyVrbeuCk0KwdvTHX5jsJ8LVSSo2xWr';
//     #prep the bundle
//      $msg = array
//           (
// 		'body' 	=> 'Body  Of Notification',
// 		'title'	=> 'Title Of Notification',
//              	'icon'	=> 'myicon',/*Default Icon*/
//               	'sound' => 'mySound'/*Default sound*/
//           );
// 	$fields = array
// 			(
// 				'to'		=> $registrationIds,
// 				'notification'	=> $msg
// 			);
	
	
// 	$headers = array
// 			(
// 				'Authorization: key=' . API_ACCESS_KEY,
// 				'Content-Type: application/json'
// 			);
// #Send Reponse To FireBase Server	
// 		$ch = curl_init();
// 		curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
// 		curl_setopt( $ch,CURLOPT_POST, true );
// 		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
// 		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
// 		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
// 		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
// 		$result = curl_exec($ch );
// 		print_r($result);
// 		exit;
// 		curl_close( $ch );
// #Echo Result Of FireBase Server

// echo $result;exit;
}


//Send PUSH to mobile
function pushNotificationWithRvalues($title,$message,$devices,$offer_id)
{

          $target = array('activity'=>'offers','id'=>$offer_id,'url'=>'','xid'=>'' ,'push_id'=>'','activity_class'=>'com.aquadeals.user.OfferDetailsActivity','pid'=>$offer_id,'did'=>'','type'=>'');
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
        $data = json_decode($result, true); 
        $res = json_decode($result);
        return json_encode(array("success"=>$res->success,"fail"=>$res->failure));
}

        function promoSts($device,$msg,$type,$did)
        {
                $title = 'Promotion Expired';
                if($type==1)
                {
                        $act_class = 'com.aquadeals.partner.SingleListItemhat';
                }
                else
                {
                        $act_class = 'com.aquadeals.partner.SingleListItem';
                }
                $target = array('activity'=>'deals','id'=>$did,'type'=>$type,'url'=>'','xid'=>'','push_id'=>0,'activity_class'=>$act_class,'did'=>$did);
                $this->pushNotificationTarget($title,$msg,$target,$device);     
        }

        //function to send notification when user provided rating
        function sendnotif_rate_aquacash($type,$msg,$device,$booking_id,$rlid)
        {
                $CI = & get_instance();
                $title = 'Aquacash Added';
                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`,`web_url`) VALUES ($rlid,1,'".$msg."','$title',0,'aquacash','com.aquadeals.user.AquaCashListActivity',0,0,'/myaquacash')");
                $push_id =  $CI->db->insert_id();
                $target = array('activity'=>'aquacash','id'=>0,'url'=>'','xid'=>'','push_id'=>$push_id,'activity_class'=>'com.aquadeals.user.AquaCashListActivity','pid'=>0,'did'=>0,'type'=>'');
                $this->pushNotificationTarget($title,$msg,$target,$device);
        }


//02-12-2016 chandu start
        //send push when booking is assigned
        public function assignbooking($bid,$aid,$type)
        {
                $CI = & get_instance();
                $access_name = $this->getValue('ad_access_sellers','name','id',$aid);
                $device[] = $this->getValue('ad_access_sellers','device_id','id',$aid);
                $role = $this->getValue('ad_access_sellers','role','id',$aid);
                if($type==0)
                {
                        $book_id = $this->getValue('ad_bookings','booking_id','id',$bid);
                        $act_class='com.aquadeals.partner.Singlebookingviewhat';
                        $ass_act_class='com.aquadeals.partner.SingleAccessItemhat';
                }
                else
                {
                        $book_id = $this->getValue('ad_feed_bookings','booking_id','id',$bid);
                         $act_class='com.aquadeals.partner.Singlebookingview';
                        $ass_act_class='com.aquadeals.partner.SingleAccessItem';
                }
                $push = "Dear $access_name, new order $book_id is assigned to you";
                $title = 'New order is assigned';
                if($role==2)
                {
                        $target = array('activity'=>'bookings','id'=>$bid,'type'=>$type,'url'=>'','xid'=>'','push_id'=>0,'activity_class'=>$act_class,'did'=>$bid);
                }
                else
                {
                        $target = array('activity'=>'abookings','id'=>$bid,'type'=>$type,'url'=>'','xid'=>'','push_id'=>0,'activity_class'=>$ass_act_class,'did'=>$bid);
                }
                $this->pushNotificationTarget($title,$push,$target,$device);
                if($role==2)
                {
                        $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`) VALUES ($aid,4,'".$push."','$title',$bid,'bookings','$act_class',0,$bid)");
                }
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
                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`,`web_url`) VALUES ($id,1,'".$msg."','$title',0,'aquacash','com.aquadeals.user.AquaCashListActivity',0,0,'/myaquacash')");
                $push_id =  $CI->db->insert_id();
                $target = array('activity'=>'aquacash','id'=>0,'url'=>'','xid'=>'' ,'push_id'=>$push_id,'activity_class'=>'com.aquadeals.user.AquaCashListActivity','pid'=>0,'did'=>0,'type'=>'');
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
                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`,`web_url`) VALUES ($rlid,1,'".$msg1."','$title',0,'aquacash','aquacash','com.aquadeals.user.AquaCashListActivity',0,0,'/myaquacash')");
                $push_id =  $CI->db->insert_id();
                $target = array('activity'=>'aquacash','id'=>0,'url'=>'','xid'=>'','push_id'=>$push_id,'activity_class'=>'com.aquadeals.user.AquaCashListActivity','pid'=>0,'did'=>0,'type'=>'');
                $this->pushNotificationTarget($title,$msg1,$target,$device1);

                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`,`web_url`) VALUES ($rdid,1,'".$msg2."','$title',0,'aquacash','aquacash','com.aquadeals.user.AquaCashListActivity',0,0,'/myaquacash')");
                $push_id1 =  $CI->db->insert_id();
                $target = array('activity'=>'aquacash','id'=>0,'url'=>'','xid'=>'','push_id'=>$push_id1,'activity_class'=>'com.aquadeals.user.AquaCashListActivity','pid'=>0,'did'=>0,'type'=>'');
                $this->pushNotificationTarget($title,$msg2,$target,$device2);
        }

        //Sending push to users,owners access persons when booking status is changed
        function sendBookingnotify($bid,$sts,$type,$role_type,$check_id)
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
                        $assign_role = $this->getValue('ad_access_sellers','role','id',$assignid);
                        $uname = $this->getValue('ad_users','name','id',$user_id);
                        $pname = $this->getValue('ad_sellers','seller_name','id',$seller_id);
                        $activity = "bookings";
                        $aactivity = "abookings";
                        $uactivity = "bookings";
                        $aname='';
                        $msg='';
                        $msg1=$msg2=$msg3='';
                        if($sts=="process")
                        {
                                $msg = "Your order $book_id processed now.";
                                $status = "Order Processed";
                        }
                        if($sts=="shipping")
                        {
                                $msg1 = " Dear $uname, Shipment started for Order $book_id";
                                $msg2 = " Dear $pname, Shipment started for Order $book_id";
                                $msg3 = " Dear aname, Shipment started for Order $book_id";
                                $status = "Order Shipping Started";
                        }
                        if($sts=="deliver")
                        {
                                $msg1 = "Dear $uname, Order $book_id is delivered.";
                                $msg2 = "Dear $pname, Order $book_id is delivered.";
                                $msg3 = "Dear aname, Order $book_id is delivered.";
                                $status = "Order Delivered";
                        }
                        //Notify to user
                        $userdevice[] = $this->getValue('ad_users','device_id','id',$user_id);
                        $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`,`web_url`) VALUES ($user_id,1,'".$msg1."','".$status."','".$book_id."','".$uactivity."','com.aquadeals.user.SeedBookingDetails','$book_id',0,'/order_details/0/$bid')");
                        $push_id =  $CI->db->insert_id();
                        $target = array('activity'=>$activity,'id'=>$book_id,'url'=>'','xid'=>'' ,'push_id'=>$push_id,'activity_class'=>'com.aquadeals.user.SeedBookingDetails','pid'=>$book_id,'did'=>0,'type'=>'');
                        $res = $this->pushNotificationTarget($status,$msg1,$target,$userdevice);
                        
                        //Notify to owner
                        $notify_deals = $this->getValue('ad_sellers','notify_deals','id',$seller_id);
                        if($notify_deals == 1)
                        {
                                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`) VALUES ($seller_id,2,'".$msg2."','".$status."',$bid,'$activity','com.aquadeals.partner.Singlebookingviewhat',0,$bid)");
                                $push_id1 =  $CI->db->insert_id();
                                if($role_type!='partner')
                                {
                                        $manfdevice[] = $this->getValue('ad_sellers','device_id','id',$seller_id);
                                        $target1 = array('activity'=>$activity,'id'=>$bid,'type'=>$type,'url'=>'','xid'=>'' ,'push_id'=>$push_id1,'activity_class'=>'com.aquadeals.partner.Singlebookingviewhat','did'=>$bid);
                                        $res = $this->pushNotificationTarget($status,$msg2,$target1,$manfdevice);
                                }
                        }
                        //Notify to Supervisor
                        $squery = $CI->db->query("SELECT * from ad_access_sellers where seller_id = $seller_id and (role=1 or role=2) and device_id!=''");
                        if($squery->num_rows() > 0)
                        {
                                foreach($squery->result() as $row)
                                {
                                        $sdevice = array();
                                        $msg = str_replace("aname",$row->name,$msg3);
                                        if($row->role==1 && $row->id!=$check_id)
                                        {
                                                $target1 = array('activity'=>$aactivity,'id'=>$bid,'type'=>$type,'url'=>'','xid'=>'','push_id'=>0,'activity_class'=>'com.aquadeals.partner.SingleAccessItemhat','did'=>$bid);
                                                $sdevice[] = $row->device_id;
                                                $res = $this->pushNotificationTarget($status,$msg,$target1,$sdevice);
                                        }
                                        if($row->role==2 && $row->id!=$check_id)
                                        {
                                                $target1 = array('activity'=>$activity,'id'=>$bid,'type'=>$type,'url'=>'','xid'=>'','push_id'=>0,'activity_class'=>'com.aquadeals.partner.Singlebookingviewhat','pid'=>$bid);
                                                $sdevice[] = $row->device_id;
                                                $res = $this->pushNotificationTarget($status,$msg,$target1,$sdevice);
                                        }
                                        if($row->role==2)
                                        {
                                                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`) VALUES ($row->id,4,'".$msg."','".$status."',$bid,'$activity','com.aquadeals.partner.Singlebookingviewhat',0,$bid)");
                                        }
                                }
                        }
                        //Notify to Access
                        if($assignto!=0)
                        {
                                if($role_type!='normal' && $assign_role==0)
                                {
                                        $adevice = array();
                                        $adevice[] = $this->getValue('ad_access_sellers','device_id','id',$assignid);
                                        $aname = $this->getValue('ad_access_sellers','name','id',$assignid);
                                        $msg = str_replace("aname",$aname,$msg3);
                                        //Notify to Access person
                                        if($this->getValue('ad_access_sellers','device_id','id',$assignid)!='')
                                        {
                                        $target1 = array('activity'=>$aactivity,'id'=>$bid,'type'=>$type,'url'=>'','xid'=>'','push_id'=>0,'activity_class'=>'com.aquadeals.partner.SingleAccessItemhat','did'=>$bid);
                                        $res = $this->pushNotificationTarget($status,$msg,$target1,$adevice);
                                        }
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
                        $assign_role = $this->getValue('ad_access_sellers','role','id',$assignid);
                        $uname = $this->getValue('ad_users','name','id',$user_id);
                        $pname = $this->getValue('ad_sellers','seller_name','id',$seller_id);
                        $activity = "bookings";
                        $aactivity = "abookings";
                        $uactivity = "pbookings";
                         $aname='';
                        $msg='';
                        $msg1=$msg2=$msg3='';
                        if($sts=="process")
                        {
                                $msg = "Your order $book_id processed now.";
                                $status = "Order Processed";
                        }
                        if($sts=="shipping")
                        {
                                $msg1 = " Dear $uname, Shipment started for Order $book_id";
                                $msg2 = " Dear $pname, Shipment started for Order $book_id";
                                $msg3 = " Dear aname, Shipment started for Order $book_id";
                                $status = "Order Shipping Started";
                        }
                        if($sts=="deliver")
                        {
                                $msg1 = "Dear $uname, Order $book_id is delivered.";
                                $msg2 = "Dear $pname, Order $book_id is delivered.";
                                $msg3 = "Dear aname, Order $book_id is delivered.";
                                $status = "Order Delivered";
                        }
                        //Notify to user
                        $userdevice[] = $this->getValue('ad_users','device_id','id',$user_id);
                        $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`,`web_url`) VALUES ($user_id,1,'".$msg1."','".$status."','".$bid."','".$uactivity."','com.aquadeals.user.ProductBookingDetails',0,0,'/order_details/1/$bid')");
                        $push_id =  $CI->db->insert_id();
                        $target = array('activity'=>$uactivity,'id'=>$bid,'url'=>'','xid'=>'','push_id'=>$push_id,'activity_class'=>'com.aquadeals.user.ProductBookingDetails','pid'=>$bid,'did'=>0,'type'=>'');
                        $res = $this->pushNotificationTarget($status,$msg1,$target,$userdevice);
                        
                        //Notify to owner
                        $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`) VALUES ($seller_id,2,'".$msg2."','".$status."',$bid,'$activity','om.aquadeals.partner.Singlebookingview',0,$bid)");
                        $push_id1 =  $CI->db->insert_id();
                        if($role_type != 'partner')
                        {
                                $manfdevice[] = $this->getValue('ad_sellers','device_id','id',$seller_id);
                                $target1 = array('activity'=>$activity,'id'=>$bid,'type'=>$type,'url'=>'','xid'=>'','push_id'=>$push_id,'activity_class'=>'om.aquadeals.partner.Singlebookingview','did'=>$bid);
                                $res = $this->pushNotificationTarget($status,$msg2,$target1,$manfdevice);
                        }
                        //Notify to Supervisor
                        $squery = $CI->db->query("SELECT * from ad_access_sellers where seller_id = $seller_id and (role=1 or role=2) and device_id!=''");
                        if($squery->num_rows() > 0)
                        {
                        foreach($squery->result() as $row)
                        {
                                $sdevice = array();
                                $msg = str_replace("aname",$row->name,$msg3);
                                if($row->role==1 && $row->id!=$user_id)
                                {
                                        $sdevice[] = $row->device_id;
                                        $target1 = array('activity'=>$aactivity,'id'=>$bid,'type'=>$type,'url'=>'','xid'=>'','push_id'=>0,'activity_class'=>'com.aquadeals.partner.SingleAccessItem','did'=>$bid);
                                        $res = $this->pushNotificationTarget($status,$msg,$target1,$sdevice);
                                }
                                if($row->role==2 && $row->id!=$user_id)
                                {
                                        $sdevice[] = $row->device_id;
                                        $target1 = array('activity'=>$activity,'id'=>$bid,'type'=>$type,'url'=>'','xid'=>'','push_id'=>0,'activity_class'=>'com.aquadeals.partner.Singlebookingview','did'=>$bid);
                                        $res = $this->pushNotificationTarget($status,$msg,$target1,$sdevice);
                                }
                                if($row->role==2)
                                {
                                        $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`) VALUES ($row->id,4,'".$msg."','".$status."',$bid,'$activity','com.aquadeals.partner.Singlebookingview',0,$bid)");
                                }
                        }
                        }
                        //Notify to Access
                        if($assignto!=0)
                        {
                                if($role_type != 'normal' && $assign_role==0)
                                {
                                        $adevice = array();
                                        $adevice[] = $this->getValue('ad_access_sellers','device_id','id',$assignid);
                                        $aname = $this->getValue('ad_access_sellers','name','id',$assignid);
                                        $msg = str_replace("aname",$aname,$msg3);
                                        //Notify to Access person
                                        if($this->getValue('ad_access_sellers','device_id','id',$assignid)!='')
                                        {
                                                $target1 = array('activity'=>$aactivity,'id'=>$bid,'type'=>$type,'url'=>'','xid'=>'','push_id'=>0,'activity_class'=>'com.aquadeals.partner.SingleAccessItem','did'=>$bid);
                                                $res = $this->pushNotificationTarget($status,$msg,$target1,$adevice);
                                        }
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
                $msg = "Dear $username, Your AquaCash account is credited back to your account";
                $title = 'Aquacash';

                $title = "AquaCash Back";
                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`,`web_url`) VALUES ($user_id,1,'".$msg."','$title',0,'aquacash','com.aquadeals.user.AquaCashListActivity',0,0,'/myaquacash')");
                $push_id =  $CI->db->insert_id();
                $target = array('activity'=>'aquacash','id'=>0,'url'=>'','xid'=>'' ,'push_id'=>$push_id,'activity_class'=>'com.aquadeals.user.AquaCashListActivity','pid'=>0,'did'=>0,'type'=>'');
                $this->pushNotificationTarget($title,$msg,$target,$device);
        }
		
		function revisionOrder($bid,$from,$to,$type)
        {
        	return 1;
        }
        /*function revisionOrder($bid,$from,$to,$type)
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

                        $msg = "Order(".$book_id.") is revised. Total amount changed from ₹ $from to ₹ $to.";
                        $status = "Order Revised";


                        //Notify to user
                        $userdevice[] = $this->getValue('ad_users','device_id','id',$user_id);
                        //print_r($userdevice);exit;
                        $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`) VALUES ($user_id,1,'".$msg."','".$status."','".$book_id."','".$activity."','com.aquadeals.user.SeedBookingDetails','$book_id',0)");
                        $push_id =  $CI->db->insert_id();
                        $target = array('activity'=>$activity,'id'=>$book_id,'url'=>'','xid'=>'' ,'push_id'=>$push_id,'activity_class'=>'com.aquadeals.user.SeedBookingDetails','pid'=>$book_id,'did'=>0,'type'=>'');
                        $res = $this->pushNotificationTarget($status,$msg,$target,$userdevice);
                        //Notify to owner
                        $manfdevice[] = $this->getValue('ad_sellers','device_id','id',$seller_id);
                        $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`) VALUES ($seller_id,2,'".$msg."','".$status."',$bid,'$activity','',0,0)");
                        $push_id1 =  $CI->db->insert_id();
                        $target1 = array('activity'=>$activity,'id'=>$bid,'type'=>$type ,'push_id'=>$push_id,'activity_class'=>'','pid'=>'','did'=>'','type'=>'');
                        $res = $this->pushNotificationTarget($status,$msg,$target1,$manfdevice);

                        //Notify to Supervisor
                        $squery = $CI->db->query("SELECT * from ad_access_sellers where seller_id = $seller_id and (role=1 or role=2)");
                        if($squery->num_rows() > 0)
                        {
                        foreach($squery->result() as $row)
                        {
                        $sdevice = array();
                        $sdevice[] = $row->device_id;
                        if($row->role==1)
                        {
                        $target1 = array('activity'=>$aactivity,'id'=>$bid,'type'=>$type ,'push_id'=>0,'activity_class'=>'','pid'=>'','did'=>'','type'=>'');
                        }
                        if($row->role==2)
                        {
                        $target1 = array('activity'=>$activity,'id'=>$bid,'type'=>$type ,'push_id'=>0,'activity_class'=>'','pid'=>'','did'=>'','type'=>'');
                        $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`) VALUES ($row->id,4,'".$msg."','".$status."',$bid,'$activity','',0,0)");
                        }

                        $res = $this->pushNotificationTarget($status,$msg,$target1,$sdevice);
                        }
                        }


                        //Notify to Access
                        if($assignto!=0)
                        {
                        $adevice = array();
                        $adevice[] = $this->getValue('ad_access_sellers','device_id','id',$assignid);
                        //Notify to Access person
                        $target1 = array('activity'=>$aactivity,'id'=>$bid,'type'=>$type ,'push_id'=>0,'activity_class'=>'','pid'=>'','did'=>'','type'=>'');
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
                        $activity = "bookings";
                        $aactivity = "abookings";

                        $msg = "Order(".$book_id.") is revised. Total amount changed from ₹ $from to ₹ $to.";
                        $status = "Order Revised";



                        //Notify to user
                        $userdevice[] = $this->getValue('ad_users','device_id','id',$user_id);
                        $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`) VALUES ($user_id,1,'".$msg."','".$status."','".$bid."','".$activity."','com.aquadeals.user.ProductBookingDetails','$bid',0)");
                        $push_id =  $CI->db->insert_id();
                        $target = array('activity'=>$activity,'id'=>$bid,'url'=>'','xid'=>'' ,'push_id'=>$push_id,'activity_class'=>'com.aquadeals.user.ProductBookingDetails','pid'=>$bid,'did'=>0,'type'=>'');
                        $res = $this->pushNotificationTarget($status,$msg,$target,$userdevice);
                          //Notify to owner
                        $manfdevice[] = $this->getValue('ad_sellers','device_id','id',$seller_id);
                        $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`) VALUES ($seller_id,2,'".$msg."','".$status."',$bid,'$activity','',0,0)");
                        $push_id1 =  $CI->db->insert_id();
                        $target1 = array('activity'=>$activity,'id'=>$bid,'type'=>$type,'push_id'=>$push_id1,'activity_class'=>'','pid'=>'','did'=>'','type'=>'');
                        $res = $this->pushNotificationTarget($status,$msg,$target1,$manfdevice);
                        //Notify to Supervisor
                        $squery = $CI->db->query("SELECT * from ad_access_sellers where seller_id = $seller_id and (role=1 or role=2)");
                        if($squery->num_rows() > 0)
                        {
                        foreach($squery->result() as $row)
                        {
                        $sdevice = array();
                        $sdevice[] = $row->device_id;
                        if($row->role==1)
                        {
                        $target1 = array('activity'=>$aactivity,'id'=>$bid,'type'=>$type,'push_id'=>0,'activity_class'=>'','pid'=>'','did'=>'','type'=>'');
                        }
                        if($row->role==2)
                        {
                        $target1 = array('activity'=>$activity,'id'=>$bid,'type'=>$type,'push_id'=>0,'activity_class'=>'','pid'=>'','did'=>'','type'=>'');
                        $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`) VALUES ($row->id,4,'".$msg."','".$status."',$bid,'$activity','',0,0)");
                        }

                        $res = $this->pushNotificationTarget($status,$msg,$target1,$sdevice);
                        }
                        }

                        //Notify to Access
                        if($assignto!=0)
                        {
                        $adevice = array();
                        $adevice[] = $this->getValue('ad_access_sellers','device_id','id',$assignid);
                        //Notify to Access person
                        $target1 = array('activity'=>$aactivity,'id'=>$bid,'type'=>$type,'push_id'=>0,'activity_class'=>'','pid'=>'','did'=>'','type'=>'');
                        $res = $this->pushNotificationTarget($status,$msg,$target1,$adevice);
                        }
                }
        }*/

//Share coupon details
		function shareCoupon($devices,$msg,$title,$ids,$cid,$img)
		{
				$CI = & get_instance();
				$target = array('activity'=>'coupon_details','id'=>$cid,'type'=>'','url'=>$img,'xid'=>'','push_id'=>0,'activity_class'=>'com.aquadeals.user.CouponDetailsPage','pid'=>$cid,'did'=>0,'type'=>'');
				$res  = $this->pushNotificationTarget($title,$msg,$target,$devices);
				foreach($ids as $id)
				{
				        $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`,`web_url`) VALUES ($id,1,'".$msg."','".$title."',$cid,'coupon_details','com.aquadeals.user.CouponDetailsPage','$cid',0,'/coupon/details/$cid')");
				        $id='';
				}
				return $res;
		}

        function confirmOrder($bid,$sts,$type,$opt)
        {
                //Push content 
                $actUser='';
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
                $assign_role = $this->getValue('ad_access_sellers','role','id',$assignid);
                $activity = "bookings";
                $aactivity = "abookings";
                $uactivity = "bookings";
                if($opt==1)
                {
                        $msg = "Order $book_id confirmed by the customer.";
                        $status = "Order Confirmed";
                }
                else
                {
                         $msg = "Order $book_id rejected by the customer.";
                        $status = "Order rejected";
                }
                //Notify to owner
                $notify_deals = $this->getValue('ad_sellers','notify_deals','id',$seller_id);
                if($notify_deals == 1)
                {
                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,did) VALUES ($seller_id,2,'".$msg."','".$status."',$bid,'$activity','com.aquadeals.partner.Singlebookingviewhat',$bid)");
                $push_id1 =  $CI->db->insert_id();
                if($actUser != 'owner')
                {
                $manfdevice[] = $this->getValue('ad_sellers','device_id','id',$seller_id);
                $target1 = array('activity'=>$activity,'id'=>$bid,'type'=>$type,'url'=>'','xid'=>'' ,'push_id'=>$push_id1,'activity_class'=>'com.aquadeals.partner.Singlebookingviewhat','did'=>$bid);
                $res = $this->pushNotificationTarget($status,$msg,$target1,$manfdevice);
                }
                }

                //Notify to Supervisor
                $squery = $CI->db->query("SELECT * from ad_access_sellers where seller_id = $seller_id and (role=1 or role=2)");
                if($squery->num_rows() > 0)
                {
                foreach($squery->result() as $row)
                {
                $sdevice = array();

                if($row->role==1 && $row->id!=$assignid)
                {
                $target1 = array('activity'=>$aactivity,'id'=>$bid,'type'=>$type,'url'=>'','xid'=>'','push_id'=>0,'activity_class'=>'com.aquadeals.partner.SingleAccessItemhat','did'=>$bid);
                $sdevice[] = $row->device_id;
                $res = $this->pushNotificationTarget($status,$msg,$target1,$sdevice);
                }
                if($row->role==2 && $row->id!=$assignid)
                {
                $target1 = array('activity'=>$activity,'id'=>$bid,'type'=>$type,'url'=>'','xid'=>'','push_id'=>0,'activity_class'=>'com.aquadeals.partner.Singlebookingviewhat','did'=>$bid);
                $sdevice[] = $row->device_id;
                $res = $this->pushNotificationTarget($status,$msg,$target1,$sdevice);

                }
                if($row->role==2)
                {
                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,did) VALUES ($row->id,4,'".$msg."','".$status."','$bid','$activity','com.aquadeals.partner.Singlebookingviewhat',$bid)");
                }

                }
                }

                //Notify to Access
                if($assignto!=0)
                {
                        if($actUser != 'access' && $assign_role==0)
                        {
                                $adevice = array();
                                $adevice[] = $this->getValue('ad_access_sellers','device_id','id',$assignid);
                                //Notify to Access person
                                $target1 = array('activity'=>$aactivity,'id'=>$bid,'type'=>$type,'url'=>'','xid'=>'','push_id'=>0,'activity_class'=>'com.aquadeals.partner.SingleAccessItemhat','did'=>$bid);
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
                $assign_role = $this->getValue('ad_access_sellers','role','id',$assignid);
                $activity = "bookings";
                $aactivity = "abookings";
                $uactivity = "pbookings";
                 if($opt==1)
                {
                        $msg = "Order $book_id confirmed by the customer.";
                        $status = "Order Confirmed";
                }
                else
                {
                         $msg = "Order $book_id rejected by the customer.";
                        $status = "Order rejected";
                }


                //Notify to user
                $push_id1 =  $CI->db->insert_id();
                if($actUser != 'owner')
                {
                $manfdevice[] = $this->getValue('ad_sellers','device_id','id',$seller_id);
                $target1 = array('activity'=>$activity,'id'=>$bid,'type'=>$type,'url'=>'','xid'=>'','push_id'=>$push_id1,'activity_class'=>'com.aquadeals.partner.Singlebookingview','did'=>$bid);
                $res = $this->pushNotificationTarget($status,$msg,$target1,$manfdevice);
                }

                //Notify to Supervisor


                $squery = $CI->db->query("SELECT * from ad_access_sellers where seller_id = $seller_id and (role=1 or role=2)");
                if($squery->num_rows() > 0)
                {
                foreach($squery->result() as $row)
                {
                    $sdevice = array();
                    if($row->role==1 && $row->id!=$assignid)
                    {
                        $sdevice[] = $row->device_id;
                        $target1 = array('activity'=>$aactivity,'id'=>$bid,'type'=>$type,'url'=>'','xid'=>'','push_id'=>0,'activity_class'=>'com.aquadeals.partner.SingleAccessItem','did'=>$bid);
                        $res = $this->pushNotificationTarget($status,$msg,$target1,$sdevice);
                    }
                    if($row->role==2 && $row->id!=$assignid)
                    {
                        $sdevice[] = $row->device_id;
                        $target1 = array('activity'=>$activity,'id'=>$bid,'type'=>$type,'url'=>'','xid'=>'','push_id'=>0,'activity_class'=>'com.aquadeals.partner.Singlebookingview','did'=>$bid);
                        $res = $this->pushNotificationTarget($status,$msg,$target1,$sdevice);

                    }
                    if($row->role==2)
                    {
                        $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`) VALUES ($row->id,4,'".$msg."','".$status."','$bid','$activity')");
                    }

                }
                }


                //Notify to Access
                if($assignto!=0)
                {
                if($actUser != 'access' && $assign_role==0)
                {
                $adevice = array();
                $adevice[] = $this->getValue('ad_access_sellers','device_id','id',$assignid);
                //Notify to Access person
                $target1 = array('activity'=>$aactivity,'id'=>$bid,'type'=>$type,'url'=>'','xid'=>'','push_id'=>0,'activity_class'=>'com.aquadeals.partner.SingleAccessItem','did'=>$bid);
                $res = $this->pushNotificationTarget($status,$msg,$target1,$adevice);
                }
                }
                }     
        }
        
         public function sentLeadnotification($id,$did,$lid)
        {
                $CI = & get_instance();
                $query = $CI->db->query("SELECT contact_person,type,device_id from ad_sellers where id = $id");
                $type = $query->row('type');
                if($type==1)
                {
                        $pid = $this->getValue('ad_manuf_deals','product_id','id',$did);
                        $pname = $this->getValue('ad_manuf_products','title','id',$pid);
                        $act_class = 'com.aquadeals.partner.LeadDetailspage';
                        
                }
                else
                {
                        $dtype_id = $this->getValue('ad_vendor_deals','deal_type_id','id',$did);
                        if($dtype_id==1)
                        {
                                $pid = $this->getValue('ad_vendor_deals','species_id','id',$did);
                                $pname = $this->getValue('ad_deal_categories','category_name','id',$pid);
                        }
                        else
                        {
                                $pname = 'Nauplii';
                        }
                        $act_class = 'com.aquadeals.partner.LeadDetailspagehat';
                }
                $name = $query->row('contact_person');
                $device[] = $query->row('device_id');
                $title = 'Request for best price';
                
                //$message = "Dear $name you got new best price request for $pname";
                $message = "Dear $name, you got a new best price request for $pname. Respond to user by Logging in Partner app.";
                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`did`) VALUES ($id,2,'".$message."','Request for best price',$did,'leads','$act_class',$did)");
                $push_id =  $CI->db->insert_id();
                $target = array('activity'=>'leads','id'=> $lid,'type'=>$type,'url'=>'','xid'=>'','push_id'=>$push_id,'activity_class'=>$act_class,'did'=>$lid);
                $res = $this->pushNotificationTarget($title,$message,$target,$device);
                return $res;
        }
        
        //Share coupon details
        function leadnotify_to_user($lid)
        {
            $CI = & get_instance();
            $qry = $CI->db->query("select * from  ad_bestprice_leads where id = $lid");
            $type = $qry->row('deal_type');
            $user_id = $qry->row('user_id');
            $owner_id = $qry->row('seller_id');
            $did = $qry->row('deal_id');
            $cpn = $qry->row('coupon');
            $amt = $qry->row('new_total');
            $expire = $qry->row('coupon_expire_on');
            $req_qty = $qry->row('req_qty');
            $devices[] = $this->getValue('ad_users','device_id','id',$user_id);
                                                            $uname = $this->getValue('ad_users','name','id',$user_id);
            if($expire==1)
            {
                $expire = $expire." day";
            }
            else
            {
                $expire = $expire." days";
            }
            $title = 'Response for best price';
            if($type==1)
            {
                $pid = $this->getValue('ad_manuf_deals','product_id','id',$did);
                $pname = $this->getValue('ad_manuf_products','title','id',$pid);
                
                $product_id = $this->getValue('ad_manuf_deals','product_id','id',$did);
                $title = $this->getValue('ad_manuf_products','title','id',$product_id);
                $deal_type_id = $this->getValue('ad_manuf_products','deal_type_id','id',$product_id);
                $category_id = $this->getValue('ad_manuf_products','category_id','id',$product_id);
                $dtype_name = $this->getValue('ad_deal_types','deal_type','id',$deal_type_id);
                $cat_name1 = $this->getValue('ad_deal_categories','category_name','id',$category_id);
                $product= strtolower(str_replace(array('  ', ' '), '-', preg_replace('/[^a-zA-Z0-9 s]/', '', trim($title)))); 
                $dtype= strtolower(str_replace(array('  ', ' '), '-', preg_replace('/[^a-zA-Z0-9 s]/', '', trim($dtype_name)))); 
                $cat= strtolower(str_replace(array('  ', ' '), '-', preg_replace('/[^a-zA-Z0-9 s]/', '', trim($cat_name1)))); 
                $target_sub = '';
                //$msg = 'Best price on'.$pname.'  '.$req_qty.'. New order total '.$amt.'.  Use coupon '.$cpn.' to avail this discount while you shop. Valid for '.$expire;
                $msg = 'Hi '.$uname.', here is the response from our partner on your Best Price  request for '.$pname.'(QTY '.$req_qty.') : Rs. '.$amt.'/-.  Apply the coupon '.$cpn.' in your cart to avail the discount. Valid for '.$expire.' only.';

                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`,`web_url`) VALUES ($user_id,1,'".$msg."','".$title."',$did,'pdeal','com.aquadeals.user.ProductDetailsActivity','$pid',$did,'/pdetails/$dtype/$cat/$product/$target_sub/$product_id')");
                $push_id =  $CI->db->insert_id();
                $target = array('activity'=>'pdeals','id'=>$did,'xid'=>$pid,'url'=>'' ,'push_id'=>$push_id,'activity_class'=>'com.aquadeals.user.ProductDetailsActivity','pid'=>$pid,'did'=>$did,'type'=>'');
                $res  = $this->pushNotificationTarget($title,$msg,$target,$devices);
                return $res;
            }
            else
            {
                $dtype_id = $this->getValue('ad_vendor_deals','deal_type_id','id',$did);
                if($dtype_id==1)
                {
                        $pid = $this->getValue('ad_vendor_deals','species_id','id',$did);
                        $pname = $this->getValue('ad_deal_categories','category_name','id',$pid);
                }
                else
                {
                        $pname = 'Nauplii';
                }
                //$msg = 'Request Best price on '.$pname.' for QTY:  '.$req_qty.' is Rs. '.$amt.'.  You can get this discount by applying '.$cpn.'  valid for '.$expire;
                $msg = 'Hi '.$uname.', here is the response from our partner on your Best Price  request for '.$pname.'(QTY '.$req_qty.') : Rs. '.$amt.'/-.  Apply the coupon '.$cpn.' in your cart to avail the discount. Valid for '.$expire.' only.';
                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`,`web_url`) VALUES ($user_id,1,'".$msg."','".$title."',$did,'deals','com.aquadeals.user.SeedDetailsActivity','$did',$owner_id,'/sdetails/$pname/$did')");
                $push_id =  $CI->db->insert_id();
                $target = array('activity'=>'deals','id'=>$did,'xid'=>$owner_id,'url'=>'' ,'push_id'=>$push_id,'activity_class'=>'com.aquadeals.user.SeedDetailsActivity','pid'=>$did,'did'=>$owner_id,'type'=>'');
                $res  = $this->pushNotificationTarget($title,$msg,$target,$devices);
                return $res;
            }
                
        }
        function lead_reject_notify_to_user($lid)
        {
            $gf = new Globalfuns();
            $CI = & get_instance();
            $qry = $CI->db->query("select * from  ad_bestprice_leads where id = $lid");
            $type = $qry->row('deal_type');
            $user_id = $qry->row('user_id');
            $owner_id = $qry->row('seller_id');
            $did = $qry->row('deal_id');
            $devices[] = $this->getValue('ad_users','device_id','id',$user_id);
            $uname = $this->getValue('ad_users','name','id',$user_id);
            $title = 'Response for best price';
            $helpline_qry= $CI->db->query("SELECT value FROM `ad_settings` WHERE `key`='aquadeals_helpline'");
            $ad_helpline = $helpline_qry->row('value');
            if($type==1)
            {
                $pid = $this->getValue('ad_manuf_deals','product_id','id',$did);
                $pname = $this->getValue('ad_manuf_products','title','id',$pid);
                
                $product_id = $this->getValue('ad_manuf_deals','product_id','id',$did);
                $title = $this->getValue('ad_manuf_products','title','id',$product_id);
                $deal_type_id = $this->getValue('ad_manuf_products','deal_type_id','id',$product_id);
                $category_id = $this->getValue('ad_manuf_products','category_id','id',$product_id);
                $dtype_name = $gf->getValue('ad_deal_types','deal_type','id',$deal_type_id);
                $cat_name1 = $gf->getValue('ad_deal_categories','category_name','id',$category_id);
                $product= strtolower(str_replace(array('  ', ' '), '-', preg_replace('/[^a-zA-Z0-9 s]/', '', trim($title)))); 
                $dtype= strtolower(str_replace(array('  ', ' '), '-', preg_replace('/[^a-zA-Z0-9 s]/', '', trim($dtype_name)))); 
                $cat= strtolower(str_replace(array('  ', ' '), '-', preg_replace('/[^a-zA-Z0-9 s]/', '', trim($cat_name1)))); 
                
                $msg = 'Sorry! your request for Best Price on '.$pname.' is declined by our partner. Call '.$ad_helpline.' for help.';
                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`) VALUES ($user_id,1,'".$msg."','".$title."',$did,'pdeal','com.aquadeals.user.ProductDetailsActivity','$pid',$did,'/pdetails/$dtype/$cat/$product/$target_sub/$product_id')");
                $push_id =  $CI->db->insert_id();
                $target = array('activity'=>'pdeals','id'=>$did,'xid'=>$pid,'url'=>'' ,'push_id'=>$push_id,'activity_class'=>'com.aquadeals.user.ProductDetailsActivity','pid'=>$pid,'did'=>$did,'type'=>'');
                $res  = $this->pushNotificationTarget($title,$msg,$target,$devices);
                return $res;
            }
            else
            {
                $dtype_id = $this->getValue('ad_vendor_deals','deal_type_id','id',$did);
                if($dtype_id==1)
                {
                        $pid = $this->getValue('ad_vendor_deals','species_id','id',$did);
                        $pname = $this->getValue('ad_deal_categories','category_name','id',$pid);
                }
                else
                {
                        $pname = 'Nauplii';
                }
                //$msg = 'Request Best price on '.$pname.' for QTY:  '.$req_qty.' is Rs. '.$amt.'.  You can get this discount by applying '.$cpn.'  valid for '.$expire;
                $msg = 'Sorry! your request for Best Price on '.$pname.' is declined by our partner. Call '.$ad_helpline.' for help.';
                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`,`web_url`) VALUES ($user_id,1,'".$msg."','".$title."',$did,'deals','com.aquadeals.user.SeedDetailsActivity','$did',$owner_id,'/sdetails/$pname/$did')");
                $push_id =  $CI->db->insert_id();
                $target = array('activity'=>'deals','id'=>$did,'xid'=>$owner_id,'url'=>'' ,'push_id'=>$push_id,'activity_class'=>'com.aquadeals.user.SeedDetailsActivity','pid'=>$did,'did'=>$owner_id,'type'=>'');
                $res  = $this->pushNotificationTarget($title,$msg,$target,$devices);
                return $res;
            }
                
        }

        function ofr_of_the_day($details)
        {
            $CI = & get_instance();
            $title = $details['title'];
            $product_id = $details['product_id'];
            $deal_id = $details['deal_id'];
            $message = $details['message'];
            $type = $details['type'];
            $res = 0;
            $get_users = $CI->db->query("SELECT device_id,id FROM ad_users WHERE status=1 and device_id!='' and mobile!=''");

            if($type == 1)
            {
                foreach ($get_users->result() as $user) 
                {
                    $devices='';
                    $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`) VALUES ($user->id,1,'".$message."','".$title."','".$deal_id."','pdeals','com.aquadeals.user.ProductDetailsActivity','".$product_id."',$deal_id)");
                    $push_id =  $CI->db->insert_id();
                    $target = array('activity'=>'pdeals','id'=>$details['deal_id'],'url'=>$details['image'],'xid'=>$details['product_id'],'push_id'=>$push_id,'activity_class'=>'com.aquadeals.user.ProductDetailsActivity','pid'=>$details['product_id'],'did'=>$details['deal_id'],'type'=>'');
                    $devices[0] = $user->device_id;
                    $res = $this->pushNotificationTarget($details['title'],$details['message'],$target, $devices);    
                }   
            }
            else
            {
                $owner_id = $this->getValue('ad_vendor_deals','seller_id','id',$deal_id);
                foreach ($get_users->result() as $user) 
                {
                    $devices='';
                    $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`) VALUES ($user->id,1,'".$message."','".$title."',$deal_id,'deals','com.aquadeals.user.SeedDetailsActivity','$deal_id',$owner_id)");
                    $push_id =  $CI->db->insert_id();
                    $target = array('activity'=>'deals','id'=>$deal_id,'xid'=>$owner_id,'url'=>'' ,'push_id'=>$push_id,'activity_class'=>'com.aquadeals.user.SeedDetailsActivity','pid'=>$deal_id,'did'=>$owner_id,'type'=>'');
                    $devices[0] = $user->device_id;
                    $res  = $this->pushNotificationTarget($details['title'],$details['message'],$target,$devices); 
                }
            }         
        }

        function promo_advrt_notif_push($details)
        {
            $CI = & get_instance();
            $title = $details['title'];
            $message = $details['message'];
            $res = 0;
            $get_users = $CI->db->query("SELECT device_id,id FROM ad_users WHERE status=1 and device_id!='' and mobile!=''");
            //$get_users = $CI->db->query("SELECT device_id,id FROM ad_users WHERE id IN(712,4208)");
            foreach ($get_users->result() as $user) 
            {
                $devices='';
                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`activity`,`activity_class`,`action`,`web_url`) VALUES ($user->id,1,'".$message."','".$title."','com.aquadeals.user.PromotionalOffersList','Promotional Offers','/offerszone')");
                $push_id =  $CI->db->insert_id();
                $target = array('activity'=>'pdeals','id'=>0,'url'=>'','xid'=>0,'push_id'=>$push_id,'activity_class'=>'com.aquadeals.user.PromotionalOffersList','pid'=>0,'did'=>0,'type'=>'');
                $devices[0] = $user->device_id;
                $res = $this->pushNotificationTarget($details['title'],$details['message'],$target, $devices);    
            }    
        }

        function req_bst_price_notif($details)
        {
            $CI = & get_instance();
            $gf = new Globalfuns();
            foreach($details as $row)
            {
                $devices='';
                $act_class='';
                $get_device_id = $CI->db->query("SELECT device_id,type FROM ad_sellers WHERE id=".$row['seller_id']);
                $device_id = $get_device_id->row('device_id');
                $type = $get_device_id->row('type');
                if($device_id!='')
                {
                    if($row['lead_id']!=0)
                        $activity = 'leads';
                    else
                        $activity = 'leads_list';
                        
                        if($type==1)
                        {
                        	$act_class='com.aquadeals.partner.LeadsTabsActivity';
                        }
                        else
                        {
                        	$act_class='com.aquadeals.partner.LeadsTabsActivity';
                        }
                    $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`did`) VALUES (".$row['seller_id'].",2,'".$row['dec']."','Request for best price',".$row['lead_id'].",'$activity ','$act_class','".$row['lead_id']."')");
                    $push_id =  $CI->db->insert_id();
                    $target = array('activity'=>$activity,'id'=> $row['lead_id'],'type'=>$row['type'],'url'=>'','xid'=>'','push_id'=>$push_id,'activity_class'=>$act_class,'did'=>$row['lead_id']);
                    $devices[0] = $device_id;
                    $res = $this->pushNotificationTarget($row['title'],$row['dec'],$target,$devices);
                }
            }
        }

        function ver_update_notif()
        {
            $CI = & get_instance();
            $res = 0;
            $get_max_version = $CI->db->query("SELECT MAX(version_code) AS max_version FROM `ad_users`");
            $max_version = $get_max_version->row('max_version');
            $get_users = $CI->db->query("SELECT device_id,id,version_code FROM ad_users WHERE status=1 and device_id!='' and mobile!='' and version_code < '".$max_version."'");
            $title = 'Latest version '.$max_version.' released';
            $message = 'Your app is outdated. Download the latest app from playstore';
            foreach ($get_users->result() as $user) 
            {
                $devices='';
                $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`,`web_url`) VALUES ($user->id,1,'".$message."','".$title."',10,'version','update',10,0,'https://play.google.com/store/apps/details?id=com.aquadeals.user&hl=en')");
                $push_id =  $CI->db->insert_id();
                $target = array('activity'=>'update','id'=>0,'url'=>'','xid'=>'','push_id'=>$push_id,'activity_class'=>'update','pid'=>10,'did'=>0,'type'=>'');
                $devices[0] = $user->device_id;
                $res = $this->pushNotificationTarget($title,$message,$target, $devices);    
            }            
        }
        
        //Sending push to users when shipment link 
        function sendshipment_link($bid,$pay_link,$type)
        {
                //Push content 
                $CI = & get_instance();
                $status = "Shipping Charges";
                if($type==0)
                {
                        $book_id = $this->getValue('ad_bookings','booking_id','id',$bid);
                        $user_id = $this->getValue('ad_bookings','user_id','id',$bid);
                        $ship_charge = $this->getValue('ad_bookings','shipment_charge','id',$bid);
                        $user_id = $this->getValue('ad_bookings','user_id','id',$bid);
                        $uname = $this->getValue('ad_users','name','id',$user_id);
                        $uactivity = "bookings";
                        $msg1 = "Dear ".ucfirst($uname).", Your order $book_id is processed. You need to pay Rs.".$ship_charge." for shipping charges."; 
                        //Notify to user
                        $userdevice[] = $this->getValue('ad_users','device_id','id',$user_id);
                        $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`,`web_url`) VALUES ($user_id,1,'".$msg1."','".$status."','".$book_id."','".$uactivity."','com.aquadeals.user.SeedBookingDetails','$book_id',0,'$pay_link')");
                        $push_id =  $CI->db->insert_id();
                        $target = array('activity'=>$uactivity,'id'=>$book_id,'url'=>'','xid'=>'' ,'push_id'=>$push_id,'activity_class'=>'com.aquadeals.user.SeedBookingDetails','pid'=>$book_id,'did'=>0,'type'=>'');
                        $res = $this->pushNotificationTarget($status,$msg1,$target,$userdevice);
                }
                else
                {
                        $book_id = $this->getValue('ad_feed_bookings','booking_id','id',$bid);
                        $user_id = $this->getValue('ad_feed_bookings','user_id','id',$bid);
                        $ship_charge = $this->getValue('ad_feed_bookings','shipment_charge','id',$bid);
                        $user_id = $this->getValue('ad_feed_bookings','user_id','id',$bid);
                        $uname = $this->getValue('ad_users','name','id',$user_id);
                        $uactivity = "bookings";
                        $msg1 = "Dear ".ucfirst($uname).", Your order $book_id is processed. You need to pay Rs.".$ship_charge." for shipping charges."; 
                        //Notify to user
                        $userdevice[] = $this->getValue('ad_users','device_id','id',$user_id);
                        $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`,`web_url`) VALUES ($user_id,1,'".$msg1."','".$status."','".$bid."','".$uactivity."','com.aquadeals.user.ProductBookingDetails',0,0,'$pay_link')");
                        $push_id =  $CI->db->insert_id();
                        $target = array('activity'=>$uactivity,'id'=>$bid,'url'=>'','xid'=>'','push_id'=>$push_id,'activity_class'=>'com.aquadeals.user.ProductBookingDetails','pid'=>$bid,'did'=>0,'type'=>'');
                        $res = $this->pushNotificationTarget($status,$msg1,$target,$userdevice);
                }     
        }
        
        
        //27-10-2017  convert order sms start
        function convertOrder($bid,$type)
        {
                //Push content 
                    $CI = & get_instance();
                    $helpline_qry= $CI->db->query("SELECT value FROM `ad_settings` WHERE `key`='aquadeals_seller_helpline'");
                    $ad_helpline = $helpline_qry->row('value');
                    if($type==0)
                    {
                        $book_id = $this->getValue('ad_bookings','booking_id','id',$bid);
                        $res_id = $this->getValue('ad_bookings','cancel_reason','id',$bid);
                        $old_id = $this->getValue('ad_bookings','old_seller_id','id',$bid);
                        $new_id = $this->getValue('ad_bookings','seller_id','id',$bid);
                        
                    }
                    else
                    {
                        $book_id = $this->getValue('ad_feed_bookings','booking_id','id',$bid);
                        $ship_charge = $this->getValue('ad_feed_bookings','shipment_charge','id',$bid);
                        $res_id = $this->getValue('ad_bookings','cancel_reason','id',$bid);
                        $old_id = $this->getValue('ad_feed_bookings','old_seller_id','id',$bid);
                        $new_id = $this->getValue('ad_feed_bookings','seller_id','id',$bid);
                    }
                    
                    //Seller details
                    $old_seller_device[] = $this->getValue('ad_sellers','device_id','id',$old_id);
                    $new_seller_device[] = $this->getValue('ad_sellers','device_id','id',$new_id);
                    $old_seller = $this->getValue('ad_sellers','seller_name','id',$old_id);
                    $new_seller = $this->getValue('ad_sellers','seller_name','id',$new_id);
                    $cancel_res = $this->getValue('ad_cancel_reasons','reason','id',$res_id);
                    
                    $n_book_id = $book_id;
                    $book_id = $book_id.'(X)';
                    $get_count = $CI->db->query("SELECT * FROM ad_feed_bookings WHERE booking_id LIKE '%$n_book_id%'");
                    if($get_count->num_rows() >1)
                    {
                        $c = $get_count->num_rows();
                        $book_id = $n_book_id.'('.$c.'X)';
                    }
                    //sms contenet to send
                    $old_seller_msg = "Dear ".$old_seller.", your Order ".$book_id." is cancelled. Reason: Due to unavailability of partner.Call $ad_helpline for help";
                     $old_seller_sms = $old_seller_msg;
                     
                    $new_seller_msg = "Dear ".$new_seller.", Congratulations! You received an Order ".$n_book_id." Login AquaDeals Partner app for more details. Call $ad_helpline for help";
                    $new_seller_sms  = $new_seller_msg;
                    
                    //Seller mobile numbers
                    
                    if($type==0)
                    {
                            //Old seller msg
                            $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`,`web_url`) VALUES ($old_id,2,'".$old_seller_sms."','Order Cancellation','".$bid."','bookings','com.aquadeals.partner.Singlebookingviewhat','$bid',0,'')");
                        $push_id1 =  $CI->db->insert_id();
                        $old_target = array('activity'=>'bookings','id'=>$bid,'url'=>'','xid'=>'' ,'push_id'=>$push_id1,'activity_class'=>'com.aquadeals.partner.Singlebookingviewhat','pid'=>$bid,'did'=>'','type'=>'');
                        
                        //new seller msg
                            $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`,`web_url`) VALUES ($old_id,2,'".$new_seller_sms."','Order Cancellation','".$bid."','bookings','com.aquadeals.partner.Singlebookingviewhat','$bid',0,'')");
                        $push_id2 =  $CI->db->insert_id();
                        $new_target = array('activity'=>'bookings','id'=>$bid,'url'=>'','xid'=>'' ,'push_id'=>$push_id2,'activity_class'=>'com.aquadeals.partner.Singlebookingviewhat','pid'=>$bid,'did'=>'','type'=>'');
                        
                }
                else
                {
                       //Old seller msg
                       $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`,`web_url`) VALUES ($old_id,1,'".$old_seller_sms."','Order Cancellation','".$bid."','bookings','com.aquadeals.partner.Singlebookingview','$bid',0,'')");
                $push_id1 =  $CI->db->insert_id();
                $old_target = array('activity'=>'bookings','id'=>$bid,'url'=>'','xid'=>'' ,'push_id'=>$push_id1,'activity_class'=>'com.aquadeals.partner.Singlebookingview','pid'=>$bid,'did'=>'','type'=>''); 
                
                //New seller msg
                       $CI->db->query("INSERT INTO `ad_push_log`( `user_id`, `user_type`, `content`,`action`,`action_id`,`activity`,`activity_class`,`pid`,`did`,`web_url`) VALUES ($old_id,1,'".$new_seller_sms."','Order Placed','".$bid."','bookings','com.aquadeals.partner.Singlebookingview','$bid',0,'')");
                $push_id2 =  $CI->db->insert_id();
                $new_target = array('activity'=>'bookings','id'=>$bid,'url'=>'','xid'=>'' ,'push_id'=>$push_id2,'activity_class'=>'com.aquadeals.partner.Singlebookingview','pid'=>$bid,'did'=>'','type'=>''); 
                }
                
                    $this->pushNotificationTarget('Order cancelled',$old_seller_sms,$old_target,$old_seller_device); 
                    $this->pushNotificationTarget('New order placed',$new_seller_sms,$new_target,$new_seller_device); 
        }
        
         //manufacturer approval
        public function sendBrandPush($bid,$device_ids,$text,$title)
        {
                $target = array('activity'=>'home','id'=> 0,'type'=>1,'url'=>'','xid'=>'','push_id'=>0,'activity_class'=>'com.aquadeals.user.BrandDetailsActivity','pid'=>'94','did'=>'','type'=>'');
                $res = $this->pushNotificationTarget($title,$text,$target,$device_ids);
                return $res;
        }
 
        //27-10-2017 convert order sms end
/*********************Global finctions********************/
} ?>

