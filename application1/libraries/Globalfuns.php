<?php

class Globalfuns
{
	
	function getValue($table,$field,$action,$value)
    { 
    	//echo "SELECT ".$field." FROM ".$table." WHERE `".$action."` ='".$value."'";exit;
    	$CI = & get_instance();
    	$query = $CI->db->query("SELECT ".$field." FROM ".$table." WHERE `".$action."` ='".$value."'");
      	return $query->row($field);
    }
    function getAggValue($table,$aggfun,$action,$value)
    {
    
    	$CI = & get_instance();
    	$query = $CI->db->query("SELECT ".$aggfun." as res FROM ".$table." WHERE `".$action."` ='".$value."'");
      	return $query->row('res');
    }
    
    
    function getLanguage($table,$field,$action,$value)
    {
    	if($field == '')
    	{
    		$field = 'en';
    	}
    	$CI = & get_instance();
    	$query = $CI->db->query("SELECT `".$field."` FROM ".$table." WHERE `".$action."` ='".$value."'");
      	$lang = $query->row($field);
      	
      	if($lang == '')
      	{
      		$query = $CI->db->query("SELECT en FROM ".$table." WHERE `".$action."`='".$value."'");
      		$lang = $query->row('en');
      	}
      	
      	return str_replace("\n",'',$lang);;
      	
    }
    
      function getbrandsCount($value)
    {
    	$CI = & get_instance();
    	$count = 0;
    	$deals = $CI->db->query("select distinct(GROUP_CONCAT(product_id)) as dids from ad_manuf_deals where seller_id=".$value);
    	if($deals->num_rows() > 0)
    	{
    	$pids = $deals->row('dids');
    	$pids = trim($pids,',');
    	if($pids!='')
    	{
    	$brands = $CI->db->query("select distinct(brand_id)as bids from ad_manuf_products where id in (".$pids.")");
    	return $brands->num_rows();
    	}
    	else
    	{
    	return 0;
    	}
    	}
    	else
    	{
    	return 0;
    	}
        
}

   function getsellersCount($value)
    {
            	$CI = & get_instance();
            	$count = 0;
            	$deals = $CI->db->query("select distinct(GROUP_CONCAT(id)) as dids from ad_manuf_deals where product_id=".$value);
            	if($deals->num_rows() > 0)
            	{
                    	$dids = $deals->row('dids');
                    	if($dids!='')
                    	{
                            	$brands = $CI->db->query("select distinct(seller_id)as sids from ad_manuf_deals where id in (".$dids.")");
                            	return $brands->num_rows();
                    	}
                    	else
                    	{
                    	        return 0;
                    	}
            	}
            	else
            	{
            	        return 0;
            	}
        
}

function pubCouponCount($coupon)
{
    $CI = & get_instance();   
    $bcount = $CI->db->query("SELECT * FROM `ad_feed_bookings` WHERE id!='' and (find_in_set('$coupon',REPLACE(`applied_coupons`, '|', ','))) <> 0");
    $sbcount = $CI->db->query("SELECT * FROM `ad_bookings` WHERE id!='' and (find_in_set('$coupon',REPLACE(`applied_coupons`, '|', ','))) <> 0");
     return  $bcount->num_rows()+$sbcount->num_rows(); 
}
function priCouponCount($coupon)
{
        $CI = & get_instance();    
        $bcount = $CI->db->query("SELECT * FROM `ad_feed_bookings` WHERE coupon_code='$coupon'");
        $sbcount = $CI->db->query("SELECT * FROM `ad_bookings` WHERE coupon_code='$coupon'");
     return  $bcount->num_rows()+$sbcount->num_rows(); 
}
function pubCouponuserCount($coupon)
{
    $CI = & get_instance();   
    $bcount = $CI->db->query("SELECT * FROM `ad_feed_bookings` WHERE id!='' and (find_in_set('$coupon',REPLACE(`applied_coupons`, '|', ','))) <> 0 group by user_id");
    $sbcount = $CI->db->query("SELECT * FROM `ad_bookings` WHERE id!='' and (find_in_set('$coupon',REPLACE(`applied_coupons`, '|', ','))) <> 0 group by user_id");
     return  $bcount->num_rows()+$sbcount->num_rows(); 
}
function priCouponuserCount($coupon)
{
        $CI = & get_instance();    
        $bcount = $CI->db->query("SELECT * FROM `ad_feed_bookings` WHERE coupon_code='$coupon' group by user_id");
        $sbcount = $CI->db->query("SELECT * FROM `ad_bookings` WHERE coupon_code='$coupon' group by user_id");
        return  $bcount->num_rows()+$sbcount->num_rows(); 
}

function getaccessBookings($id,$type)
{
        
        $CI = & get_instance();    
        if($type==0)
        {
        $count = $CI->db->query("select * from ad_bookings where `assigned_id` = $id");
        }
        else
        {
        $count = $CI->db->query("select * from ad_feed_bookings where `assigned_id` = $id");
        }
        return $count->num_rows();
}

function getaccessProcessBookings($id,$type)
{
        
        $CI = & get_instance();    
        if($type==0)
        {
        $count = $CI->db->query("select * from ad_bookings where `assigned_id` = $id and status!=2 && status!=6 && status!=3");
        }
        else
        {
        $count = $CI->db->query("select * from ad_feed_bookings where `assigned_id` = $id and status!=2 && status!=6 && status!=3");
        }
        return $count->num_rows();
}

function getTime($date)
                {
                        $time='';
                        $start_date = new DateTime();
                        $since_start = $start_date->diff(new DateTime($date));
                        if($since_start->days!=0 || $since_start->h !=0 ||  $since_start->i !=0)
                        {
                        if($since_start->days !=0)
                        {
                        if($since_start->days<=3)
                        {
                                if($since_start->days==1)
                                {
                                $time = $since_start->days. 'day ago';
                                }
                                else
                                {
                                $time = $since_start->days. 'days ago';
                                }
                        }
                        else
                        {
                        $time = date('d-m-Y h:i a',strtotime($date));
                        }

                        }
                        else if($since_start->h !=0)
                        {
                        if($since_start->h==1)
                        {
                        $time = $since_start->h. 'hour ago';
                        }
                        else
                        {
                        $time = $since_start->h. 'hours ago';
                        }

                        }
                        else if($since_start->i !=0)
                        {
                        if($since_start->i ==1 )
                        {
                        $time = $since_start->i. 'minute ago';
                        }
                        else
                        {
                        $time = $since_start->i. 'minutes ago';
                        }
                        }
                        }
                        return $time;
        }

}

?>
