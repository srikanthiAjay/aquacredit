<?php

/**
* PUSH Notification Library
*
* All the  push notification messages configured here
*
* @category   PUSH Notification
* @author     CHANDRASEKHAR <ramakrishna_nyros@yahoo.com>,Sankar<sankar_nyros@yahoo.com>,Chandra Sekhar<chandrasekhar_nyros@yahoo.com>
* @copyright  2016 Nyros Technologies
* @version    1
* @link       http://www.aquadeals.com
*/

class WEB_PUSH
{
	function __construct()
	{
		//$base_url = '';
	}
	
	
	//Sending web push when order delivered
	function deliverOrder($bid,$type)
	{
		$CI = & get_instance();
 		$device_ids = array();
    	$qry = $CI->db->query("select web_device_id from ad_admin_users where web_device_id!=''");
    	foreach($qry->result() as $row)
    	{
    		array_push($device_ids,$row->web_device_id);
    	}
		if($type==1)
		{
			$order_id = $this->getValue('ad_feed_bookings','booking_id','id',$bid);
			$dlvr_by = $this->getValue('ad_feed_bookings','delivered_by','id',$bid);
			$dlvr_id = $this->getValue('ad_feed_bookings','delivered_id','id',$bid);
			$url = base_url().'admin/product_book_details/'.$bid;
		}
		else
		{
			$order_id = $this->getValue('ad_bookings','booking_id','id',$bid);
			$dlvr_by = $this->getValue('ad_bookings','delivered_by','id',$bid);
			$dlvr_id = $this->getValue('ad_bookings','delivered_id','id',$bid);
			$url = base_url().'admin/book-details/'.$bid;
		}
		if($dlvr_by==0)
		{
			$dlvrd_by = "Seller(".$this->getValue('ad_sellers','seller_name','id',$dlvr_id).", ".$this->getValue('ad_sellers','mobile','id',$dlvr_id).")";
		}
		else if($dlvr_by==1)
		{
			$dlvrd_by = "Access person(".$this->getValue('ad_access_sellers','name','id',$dlvr_id).", ".$this->getValue('ad_sellers','mobile','id',$dlvr_id).")";
		}
		else
		{
			$dlvrd_by = "Admin(".$this->getValue('ad_admin_users','name','id',$dlvr_id).", ".$this->getValue('ad_admin_users','mobile','id',$dlvr_id).")";
		}
		$title = 'Order Delivered';
		$desc = "Order #$order_id is Delivered by $dlvrd_by. For more details goto order deatils page.";
	 	$this->sendWebPush($device_ids,$title,$desc,$url);
	}
	
	//Sending web push when order shipped
	function shipOrder($bid,$type)
	{
		$CI = & get_instance();
 		$device_ids = array();
    	$qry = $CI->db->query("select web_device_id from ad_admin_users where web_device_id!=''");
    	foreach($qry->result() as $row)
    	{
    		array_push($device_ids,$row->web_device_id);
    	}
		if($type==1)
		{
			$order_id = $this->getValue('ad_feed_bookings','booking_id','id',$bid);
			$shp_by = $this->getValue('ad_feed_bookings','shipped_by','id',$bid);
			$shp_id = $this->getValue('ad_feed_bookings','shipped_id','id',$bid);
			$url = base_url().'admin/product_book_details/'.$bid;
		}
		else
		{
			$order_id = $this->getValue('ad_bookings','booking_id','id',$bid);
			$shp_by = $this->getValue('ad_bookings','shipped_by','id',$bid);
			$shp_id = $this->getValue('ad_bookings','shipped_id','id',$bid);
			$url = base_url().'admin/book-details/'.$bid;
		}
		if($shp_by==0)
		{
			$shpd_by = "Seller(".$this->getValue('ad_sellers','seller_name','id',$shp_id).", ".$this->getValue('ad_sellers','mobile','id',$shp_id).")";
		}
		else if($shp_by==1)
		{
			$shpd_by = "Access person(".$this->getValue('ad_access_sellers','name','id',$shp_id).", ".$this->getValue('ad_sellers','mobile','id',$shp_id).")";
		}
		else
		{
			$shpd_by = "Admin(".$this->getValue('ad_admin_users','name','id',$shp_id).", ".$this->getValue('ad_admin_users','mobile','id',$shp_id).")";
		}
		$title = 'Order Shipping Started';
		$desc = "Order Shipping is started by $shpd_by for the Order #$order_id. For More details goto order deatils page.";
	 	$this->sendWebPush($device_ids,$title,$desc,$url);
	}
	
	//Sending web push when order shipped
	function cancelOrder($bid,$type)
	{
		$CI = & get_instance();
 		$device_ids = array();
    	$qry = $CI->db->query("select web_device_id from ad_admin_users where web_device_id!=''");
    	foreach($qry->result() as $row)
    	{
    		array_push($device_ids,$row->web_device_id);
    	}
		if($type==1)
		{
			$order_id = $this->getValue('ad_feed_bookings','booking_id','id',$bid);
			$can_by = $this->getValue('ad_feed_bookings','cancelled_by','id',$bid);
			$can_id = $this->getValue('ad_feed_bookings','cancelled_by_id','id',$bid);
			$url = base_url().'admin/product_book_details/'.$bid;
		}
		else
		{
			$order_id = $this->getValue('ad_bookings','booking_id','id',$bid);
			$can_by = $this->getValue('ad_bookings','cancelled_by','id',$bid);
			$can_id = $this->getValue('ad_bookings','cancelled_by_id','id',$bid);
			$url = base_url().'admin/book-details/'.$bid;
		}
		if($can_by==0)
		{
			$shpd_by = "User(".$this->getValue('ad_users','name','id',$can_id).", ".$this->getValue('ad_users','mobile','id',$can_id).")";
		}
		if($can_by==2)
		{
			$cncld_by = "Seller(".$this->getValue('ad_sellers','seller_name','id',$can_id).", ".$this->getValue('ad_sellers','mobile','id',$can_id).")";
		}
		else if($can_by==3)
		{
			$cncld_by = "Access person(".$this->getValue('ad_access_sellers','name','id',$can_id).", ".$this->getValue('ad_sellers','mobile','id',$can_id).")";
		}
		else
		{
			$cncld_by = "Admin(".$this->getValue('ad_admin_users','name','id',$can_id).", ".$this->getValue('ad_admin_users','mobile','id',$can_id).")";
		}
		$title = 'Order Cancelled';
		$desc = "Order #$order_id is cancelled by $cncld_by. For more details goto order deatils page";
	 	$this->sendWebPush($device_ids,$title,$desc,$url);
	}
	
	
 	//Sending push notification when order placed
	function processOrder($bid,$type)
	{
		$CI = & get_instance();
 		$device_ids = array();
    	$qry = $CI->db->query("select web_device_id from ad_admin_users where web_device_id!=''");
    	foreach($qry->result() as $row)
    	{
    		array_push($device_ids,$row->web_device_id);
    	}
		if($type==1)
		{
			$order_id = $this->getValue('ad_feed_bookings','booking_id','id',$bid);
			$pro_by = $this->getValue('ad_feed_bookings','processing_by','id',$bid);
			$pro_id = $this->getValue('ad_feed_bookings','processing_id','id',$bid);
			$url = base_url().'admin/product_book_details/'.$bid;
		}
		else
		{
			$order_id = $this->getValue('ad_bookings','booking_id','id',$bid);
			$pro_by = $this->getValue('ad_bookings','processing_by','id',$bid);
			$pro_id = $this->getValue('ad_bookings','processing_id','id',$bid);
			$url = base_url().'admin/book-details/'.$bid;
		}
		if($pro_by==0)
		{
			$procd_by = "Seller(".$this->getValue('ad_sellers','seller_name','id',$pro_id).", ".$this->getValue('ad_sellers','mobile','id',$pro_id).")";
		}
		else if($pro_by==1)
		{
			$procd_by = "Access person(".$this->getValue('ad_access_sellers','name','id',$pro_id).", ".$this->getValue('ad_sellers','mobile','id',$pro_id).")";
		}
		else
		{
			$procd_by = "Admin(".$this->getValue('ad_admin_users','name','id',$pro_id).", ".$this->getValue('ad_admin_users','mobile','id',$pro_id).")";
		}
		$title = 'Order Placed';
		$desc = "Order #$order_id is processed by $procd_by. For more details goto order deatils page";
	 	$this->sendWebPush($device_ids,$title,$desc,$url);
 	}
 	
 	//Sending push notification when order placed
	function placeOrder($bid,$type)
	{
		$CI = & get_instance();
 		$device_ids = array();
    	$qry = $CI->db->query("select web_device_id from ad_admin_users where web_device_id!=''");
    	foreach($qry->result() as $row)
    	{
    		array_push($device_ids,$row->web_device_id);
    	}
		if($type==1)
		{
			$order_id = $this->getValue('ad_feed_bookings','booking_id','id',$bid);
			$uid = $this->getValue('ad_feed_bookings','user_id','id',$bid);
			$url = base_url().'admin/product_book_details/'.$bid;
		}
		else
		{
			$order_id = $this->getValue('ad_bookings','booking_id','id',$bid);
			$uid = $this->getValue('ad_bookings','user_id','id',$bid);
			$url = base_url().'admin/book-details/'.$bid;
		}
		$uname = $this->getValue('ad_users','name','id',$uid);
		$umbl = $this->getValue('ad_users','mobile','id',$uid);
		$title = 'Order Placed';
		$desc = "New Order came from user(".$uname.",".$umbl.") with order id #$order_id. For more details goto order deatils page.";
	 	$this->sendWebPush($device_ids,$title,$desc,$url);
 	}
 	
 	//Sending push notification when user requested for ad assist
	function adAssist($uid,$pid,$slot)
	{
		$CI = & get_instance();
 		$device_ids = array();
    	$qry = $CI->db->query("select web_device_id from ad_admin_users where web_device_id!=''");
    	foreach($qry->result() as $row)
    	{
    		array_push($device_ids,$row->web_device_id);
    	}
		$uname = $this->getValue('ad_users','name','id',$uid);
		$umbl = $this->getValue('ad_users','mobile','id',$uid);
		$product = $this->getValue('ad_manuf_products','title','id',$pid);
		$bid = $this->getValue('ad_manuf_products','brand_id','id',$pid);
		$brand = $this->getValue('ad_brands','brand_name','id',$bid);
		$url = base_url().'home';
		$title = 'New Lead';
		$desc = "New ad assist lead came from the user(".$uname.",".$umbl.") for the product $product(Brand : $brand).";
	 	$this->sendWebPush($device_ids,$title,$desc,$url);
 	}
 	
 	//Sending push notification when user requested for best price
	function bestPriceLead($uid,$did,$type)
	{
		$CI = & get_instance();
 		$device_ids = array();
    	$qry = $CI->db->query("select web_device_id from ad_admin_users where web_device_id!=''");
    	foreach($qry->result() as $row)
    	{
    		array_push($device_ids,$row->web_device_id);
    	}
		$uname = $this->getValue('ad_users','name','id',$uid);
		$umbl = $this->getValue('ad_users','mobile','id',$uid);
		if($type==1)
		{
		$pid = $this->getValue('ad_manuf_deals','product_id','id',$did);
		$deal_id = $this->getValue('ad_manuf_deals','deal_id','id',$did);
		$sid = $this->getValue('ad_manuf_deals','seller_id','id',$did);
		$product = $this->getValue('ad_manuf_products','title','id',$pid);
		$bid = $this->getValue('ad_manuf_products','brand_id','id',$pid);
		$brand = $this->getValue('ad_brands','brand_name','id',$bid);
		$details = "Product : $product,Brand : $brand";
		$url = base_url()."home/admin/best_leads/$sid";
		}
		else
		{
		$spe_id = $this->getValue('ad_vendor_deals','species_id','id',$did);
		$dtype_id = $this->getValue('ad_vendor_deals','deal_type_id','id',$did);
		$sid = $this->getValue('ad_vendor_deals','seller_id','id',$did);
		$deal_id = $this->getValue('ad_vendor_deals','deal_id','id',$did);
		if($dtype_id == 8)
		{
			$details = "Nauplii";
		}
		else
		{
			if($spe_id==1)
			{
				$seed = 'Vannamei';
			}
			else
			{
				$seed = 'Tiger';
			}
			$details = "Seed ,".$seed;
			$url = base_url()."home/admin/best_leads_seed/$sid";
		}
		}
		
		$title = 'New Lead';
		//$desc = "User(".$uname.",".$umbl.") is requested for best price for the deal $deal_id($details).";
		$desc = "New best price lead came from the user(".$uname.",".$umbl.") for the deal $deal_id($details).";
	 	$this->sendWebPush($device_ids,$title,$desc,$url);
 	}
 	
 	//Sending push notification when user requested for become a partner
	function becomePartner($uname,$mobile,$stype)
	{
		$CI = & get_instance();
 		$device_ids = array();
    	$qry = $CI->db->query("select web_device_id from ad_admin_users where web_device_id!='' and status=1");
    	foreach($qry->result() as $row)
    	{
    		array_push($device_ids,$row->web_device_id);
    	}
		$uname = $uname;
		$umbl = $mobile;
		$url = base_url().'admin/seller_leads';
		$title = 'New Lead';
		//1-Seed,2-Feed & health care,3-machinery
		if($stype==1)
		{
			$sell_type = " To sell Seed.";
		}
		else if($stype==2)
		{
			$sell_type = " To sell Feed & Health Care products.";
		}
		else if($stype==3)
		{
			$sell_type = " To sell Machinery products.";
		}
		else
		{
			$sell_type = "";
		}
		$desc = "New lead came from Mr.$uname,$umbl to became a partner with AquaDeals.$sell_type";
	 	$this->sendWebPush($device_ids,$title,$desc,$url);
 	}
 	
 	//Sending push notification when user create new quick buy
	function quickBuy($uid,$type,$did)
	{
		$CI = & get_instance();
 		$device_ids = array();
    	$qry = $CI->db->query("select web_device_id from ad_admin_users where web_device_id!=''");
    	foreach($qry->result() as $row)
    	{
    		array_push($device_ids,$row->web_device_id);
    	}
		$uname = $this->getValue('ad_users','name','id',$uid);
		$umbl = $this->getValue('ad_users','mobile','id',$uid);
		if($type==1)
		{
			$pid = $this->getValue('ad_manuf_deals','product_id','id',$did);
			$deal_id = $this->getValue('ad_manuf_deals','deal_id','id',$did);
			$sid = $this->getValue('ad_manuf_deals','seller_id','id',$did);
			$product = $this->getValue('ad_manuf_products','title','id',$pid);
			$bid = $this->getValue('ad_manuf_products','brand_id','id',$pid);
			$brand = $this->getValue('ad_brands','brand_name','id',$bid);
			$details = "Product : $product,Brand : $brand";
			$url = base_url()."home/admin/best_leads/$sid";
		}
		else
		{
			$spe_id = $this->getValue('ad_vendor_deals','species_id','id',$did);
			$dtype_id = $this->getValue('ad_vendor_deals','deal_type_id','id',$did);
			$sid = $this->getValue('ad_vendor_deals','seller_id','id',$did);
			$deal_id = $this->getValue('ad_vendor_deals','deal_id','id',$did);
			if($dtype_id == 8)
			{
				$details = "Nauplii";
			}
			else
			{
				if($spe_id==1)
				{
					$seed = 'Vannamei';
				}
				else
				{
					$seed = 'Tiger';
				}
				$details = "Seed ,".$seed;
				$url = base_url()."home/admin/quickBuy_leads/$sid";
			}
		}
		
		$title = 'New Lead';
		$desc = "User(".$uname.",".$umbl.") is created new quick buy cart the deal $deal_id($details).";
		$this->sendWebPush($device_ids,$title,$desc,$url);
 	}
 	
 	
 	//Sending push notification when user requested for become a partner
	function sellerRegistred($name,$mobile)
	{
		$CI = & get_instance();
 		$device_ids = array();
    	$qry = $CI->db->query("select web_device_id from ad_admin_users where web_device_id!=''");
    	foreach($qry->result() as $row)
    	{
    		array_push($device_ids,$row->web_device_id);
    	}
		
		$url = base_url().'admin/seller-notifications';
		$title = 'Partner Registration';
		$desc = "New partner($name, $mobile) is registered with AquaDeals admin approval is pending for him.";
	 	$this->sendWebPush($device_ids,$title,$desc,$url);
 	}
 	
 	//Sending push notification when banner ad expires
	function expireBannerAd($title,$desc,$aid)
	{
		$CI = & get_instance();
 		$device_ids = array();
    	$qry = $CI->db->query("select web_device_id from ad_admin_users where web_device_id!=''");
    	foreach($qry->result() as $row)
    	{
    		array_push($device_ids,$row->web_device_id);
    	}
		$url = base_url()."ad-details/$aid";
		//echo $url;exit;
		$this->sendWebPush($device_ids,$title,$desc,$url);
 	}
 	
 	//Sending push notification when paid deal promotion made
	function promoDeal($title,$desc,$aid)
	{
		$CI = & get_instance();
 		$device_ids = array();
    	$qry = $CI->db->query("select web_device_id from ad_admin_users where web_device_id!=''");
    	foreach($qry->result() as $row)
    	{
    		array_push($device_ids,$row->web_device_id);
    	}
		$url = base_url()."admin/promo_deal_details/$aid";
		//echo $url;exit;
		$this->sendWebPush($device_ids,$title,$desc,$url);
 	}
 	
 	//Sending push notification to admin when user creates cart
 	//Sending push notification when user create new quick buy
	function addToCart($uid,$type,$did)
	{
		$CI = & get_instance();
 		$device_ids = array();
    	$qry = $CI->db->query("select web_device_id from ad_admin_users where web_device_id!=''");
    	foreach($qry->result() as $row)
    	{
    		array_push($device_ids,$row->web_device_id);
    	}
		$uname = $this->getValue('ad_users','name','id',$uid);
		$umbl = $this->getValue('ad_users','mobile','id',$uid);
		if($type==1)
		{
			$pid = $this->getValue('ad_manuf_deals','product_id','id',$did);
			$deal_id = $this->getValue('ad_manuf_deals','deal_id','id',$did);
			$sid = $this->getValue('ad_manuf_deals','seller_id','id',$did);
			$product = $this->getValue('ad_manuf_products','title','id',$pid);
			$bid = $this->getValue('ad_manuf_products','brand_id','id',$pid);
			$brand = $this->getValue('ad_brands','brand_name','id',$bid);
			$details = "Product : $product,Brand : $brand";
			$url = base_url()."admin/fcart/$uid";
		}
		else
		{
			$spe_id = $this->getValue('ad_vendor_deals','species_id','id',$did);
			$dtype_id = $this->getValue('ad_vendor_deals','deal_type_id','id',$did);
			$sid = $this->getValue('ad_vendor_deals','seller_id','id',$did);
			$deal_id = $this->getValue('ad_vendor_deals','deal_id','id',$did);
			if($dtype_id == 8)
			{
				$details = "Nauplii";
			}
			else
			{
				if($spe_id==1)
				{
					$seed = 'Vannamei';
				}
				else
				{
					$seed = 'Tiger';
				}
				$details = "Seed ,".$seed;
				$url = base_url()."admin/scart/$uid";
			}
		}
		
		$title = 'New Lead';
		$desc = "User(".$uname.",".$umbl.") is added new deal : $deal_id($details) to his cart please follow him.";
		$this->sendWebPush($device_ids,$title,$desc,$url);
 	}
 	//Sending push notification to admin when user clicks on quick buy
 	//Testing code
 	function testAdminPush()
 	{
 		$CI = & get_instance();
 		$device_ids = array();
    	$qry = $CI->db->query("select web_device_id from ad_admin_users where web_device_id!=''");
    	foreach($qry->result() as $row)
    	{
    		array_push($device_ids,$row->web_device_id);
    	}
    	//print_r($device_ids);exit;
 		$this->sendWebPush($device_ids,'Test','Testing admin push','http://203.193.173.78/aquadeals_new/admin/product_book_details/435');
 	}
	
	//Send push to admin users
	//Sending push notification when paid deal promotion made
	function AssignLead($tc_id,$assign_id)
	{
		$CI = & get_instance();
 		$device_ids = array();
    	$qry = $CI->db->query("select web_device_id from ad_admin_users where id=$tc_id");
    	foreach($qry->result() as $row)
    	{
    		$device_id = $row->web_device_id;
    		array_push($device_ids,$row->web_device_id);
    	}
		$url = base_url()."admin/telecallerLeads";
		//echo $url;exit;
		$title = 'New Lead Assigned';
		$aname = $this->getValue('ad_admin_users','name','id',$assign_id);
		$tname = $this->getValue('ad_admin_users','name','id',$tc_id);
		$desc = "Hi $tname $aname assigned some new leads to you please follow those.";
		$res = $this->sendWebPush($device_ids,$title,$desc,$url);
		
 	}
 	
	//Send webpush Global function
    function sendWebPush($device_id,$title,$desc,$url)
    {
    	$content1 = array("en" =>$desc);
   		$fields = array(
		        'app_id' => "42c2f182-5eda-4d93-8b14-f7b6c936ec94",
		        'include_player_ids' => $device_id,
		        'headings'=> array('en' => $title),
		        'url' => $url,
		        'contents' => $content1,
		    );
	    $fields = json_encode($fields);
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
	    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8','Authorization: Basic NzU0NjA4ZGEtZGJhYy00OTc3LTllMGUtNGVjOGMyZTkzZjlk'));
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	    curl_setopt($ch, CURLOPT_HEADER, FALSE);
	    curl_setopt($ch, CURLOPT_POST, TRUE);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	    $response = curl_exec($ch);
	    print_r($response);exit;
	    curl_close($ch); 
    }  
    
    //Get name from DB
    //Get db values
	function getValue($table,$field,$action,$value)
	{ 
		$CI = & get_instance();
		$query = $CI->db->query("SELECT ".$field." FROM ".$table." WHERE ".$action." ='".$value."'");
		return $query->row($field);
	}
	
	function convertLead($old,$new,$res,$leadId)
	{
		$CI = & get_instance();
 		$device_ids = array();
    	$qry = $CI->db->query("select web_device_id from ad_admin_users where id=$old");
    	foreach($qry->result() as $row)
    	{
    		$device_id = $row->web_device_id;
    		array_push($device_ids,$row->web_device_id);
    	}
		$url = base_url()."admin/view_lead/$leadId";
		//echo $url;exit;
		$title = 'Lead converted';
		$old_name = $this->getValue('ad_admin_users','name','id',$old);
		$new_name = $this->getValue('ad_admin_users','name','id',$new);
		$desc = "Hi $old_name your lead converted by $new_name Reason:$res.";
		$res = $this->sendWebPush($device_ids,$title,$desc,$url);
		
 	}
 
}
