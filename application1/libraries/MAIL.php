
<?php
setlocale(LC_MONETARY, 'en_IN'); 
/**
 * MAIL Library
 *
 * All the Emails configured and sending form here
 *
 * @category   Email
 * @author Sankar<sankar_nyros@yahoo.com>,Phani<phani_nyros@yahoo.com>,Chandu<chandrasekhar_nyros@yahoo.com>
 * @copyright  2016-2017 Nyros Technologies
 * @version    1
 * @link       http://www.aquadeals.in
 */
//require $_SERVER['DOCUMENT_ROOT'].'/admin/application/third_party/sendgrid-php-master/vendor/autoload.php';
require $_SERVER['DOCUMENT_ROOT'].'aquadeals_new/application/third_party/sendgrid-php-master/vendor/autoload.php';
/****************************************************************/
                                                                
//       Use flag 1 for send mail to user, 2 for seller         
                                                            
/****************************************************************/
class MAIL
{
    
    //Welcome mail for users
    public function welcome_user($name,$email)
    {
                if($email!='')
                {
                $to = $email;
                $subject = "Hi ".ucfirst($name)." - Welcome to the AquaDeals";
                $CI = & get_instance();//Get global functions
                $helpline_qry= $CI->db->query("SELECT value FROM `ad_settings` WHERE `key`='aquadeals_helpline'");
        $ad_helpline = $helpline_qry->row('value');
                $mailcontent='
                <html>
                <head>
                        <meta charset="utf-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1">
                        <title>AquaDeals</title>
                        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" /> 
                        <style type="text/css">
                        .tot_pag{width: 40%;margin: 10px auto;}
                        .foter{overflow: hidden;width: 43%;margin: 10px auto;}
                        .nxt_stp li{width: 50%;margin-top: 10px;}
                        .nxt_stp li img{margin-right: 20px;margin-top: 10px;}
                        @media (max-width: 667px) {
                        .nxt_stp li{width: 100%;margin-top: 15px;}
                        .tot_pag{width: 80%;}
                        .foter{width: 83%;}
                        }
                        </style>
                </head>

                <body style="background: #eeeeee;font-family: arial;">
                        <div style="width: 100%;text-align: center;margin: 30px 0;"> <a href="#"> 
                        <img src="http://aqua.deals/admin/assets/email_imgs/logo.png" /> </a> </div>
                        <div class="tot_pag" style="border-radius: 5px;background: #f15a25;padding: 20px;">
                        <h1 style="font-size: 16px;color: #fff;text-align: left;">Welcome to AquaDeals!</h1>
                        <p style="font-size: 14px;color: #fff;text-align: left;font-weight: normal;margin-top: 15px;">Here are a few quick tips to get you started
                        with AquaDeals.</p>
                        <ul style="list-style: none;overflow: hidden;padding: 0;margin: 0;" class="nxt_stp">
                        <li style="float: left;">
                        <img src="http://aqua.deals/admin/assets/email_imgs/mail_icon.png" style="float: left;" />
                        <p style="font-size: 14px;color: #fff;text-align: left;font-weight: normal;">Verify Email</p>
                        </li>
                        <li style="float: left;">
                        <img src="http://aqua.deals/admin/assets/email_imgs/search_icon.png" style="float: left;" />
                        <p style="font-size: 14px;color: #fff;text-align: left;font-weight: normal;">Search deals</p>
                        </li>
                        <li style="float: left;">
                        <img src="http://aqua.deals/admin/assets/email_imgs/book_deal.png" style="float: left;" />
                        <p style="font-size: 14px;color: #fff;text-align: left;font-weight: normal;">Book deals</p>
                        </li>
                        <li style="float: left;">
                        <img src="http://aqua.deals/admin/assets/email_imgs/aqua_cash.png" style="float: left;" />
                        <p style="font-size: 14px;color: #fff;text-align: left;font-weight: normal;">Earn Aquacash</p>
                        </li>
                        </ul>

                        <div style="clear: both">&nbsp;</div>
                        </div>
                        <div class="foter">
                        <h6 style="font-size: 13px;color: #666; float: right;margin: 0 0 30px 0;padding: 0;">Thank you for signing up! with AquaDeals Call '.$ad_helpline.' for help</h6>
                        <div style="clear: both;"></div>
                        <div style="float: left;">
                        <h6 style="font-size: 15px;color: #333;margin: 0;">Download AquaDeals</h6>
                        <a href="https://play.google.com/store/apps/details?id=com.aquadeals.user" style="margin-top: 15px;display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/android_icon.png" /> </a>
                        </div>
                        <div style="float: right;">
                        <h6 style="font-size: 15px;color: #333;margin: 0;">Follow Us</h6>
                        <ul style="list-style: none;text-align: center;margin: 15px 0 0 0;padding: 0;">
                        <li style="float: left;"><a href="https://www.facebook.com/aquadealsstore/" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/fb_icon.png" /> </a></li>
                        <li style="float: right;"><a href="https://twitter.com/aquadealsstore" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/twitter_icon.png" /> </a></li>
                        </ul>
                        </div>
                        </div>
                </body>
                </html>';
                $res = $this->send($to,$subject,$mailcontent,1);
                return $res;
            }
            else
            {
                    return 1;
            }
    }

    //Welcome mail for owner
    public function welcome_manufacturer($name,$email)
    {
        if($email!='')
        {
        $to = $email;
        $subject = "Hi ".ucfirst($name)." - Welcome to the AquaDeals";
         $CI = & get_instance();//Get global functions
$shelpline_qry= $CI->db->query("SELECT value FROM `ad_settings` WHERE `key`='aquadeals_seller_helpline'");
$sad_helpline = $shelpline_qry->row('value');
        
        $mailcontent='<html>
                <head>
                        <meta charset="utf-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1">
                        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" /> 
                        <title>AquaDeals</title>
                        <style type="text/css">
                        .tot_pag{width: 40%;margin: 10px auto;}
                        .foter{overflow: hidden;width: 43%;margin: 10px auto;}
                        .nxt_stp li{width: 50%;margin-top: 10px;}
                        .nxt_stp li img{margin-right: 20px;margin-top: 10px;}
                        @media (max-width: 667px) {
                        .nxt_stp li{width: 100%;margin-top: 15px;}
                        .tot_pag{width: 80%;}
                        .foter{width: 83%;}
                        }
                        </style>
                </head>

                <body style="background: #eeeeee;font-family: arial;">
                        <div style="width: 100%;text-align: center;margin: 30px 0;"> <a href="#"> 
                        <img src="http://aqua.deals/admin/assets/email_imgs/slogo.png" /> </a> </div>
                        <div class="tot_pag" style="border-radius: 5px;background: #019cdf;padding: 20px;">
                        <h1 style="font-size: 16px;color: #fff;text-align: left;">Welcome to AquaDeals Partner App!</h1>
                        <p style="font-size: 14px;color: #fff;text-align: left;font-weight: normal;margin-top: 15px;">Here are a few quick tips to get you started
                        with AquaDeals.</p>
                        <ul style="list-style: none;overflow: hidden;padding: 0;margin: 0;" class="nxt_stp">
                        <li style="float: left;">
                        <img src="http://aqua.deals/admin/assets/email_imgs/mail_icon.png" style="float: left;" />
                        <p style="font-size: 14px;color: #fff;text-align: left;font-weight: normal;">Verify Email</p>
                        </li>
                        <li style="float: left;">
                        <img src="http://aqua.deals/admin/assets/email_imgs/search_icon.png" style="float: left;" />
                        <p style="font-size: 14px;color: #fff;text-align: left;font-weight: normal;">Create Deals</p>
                        </li>
                        <li style="float: left;">
                        <img src="http://aqua.deals/admin/assets/email_imgs/book_deal.png" style="float: left;" />
                        <p style="font-size: 14px;color: #fff;text-align: left;font-weight: normal;">Get Orders</p>
                        </li>
                        <li style="float: left;">
                        <img src="http://aqua.deals/admin/assets/email_imgs/aqua_cash.png" style="float: left;" />
                        <p style="font-size: 14px;color: #fff;text-align: left;font-weight: normal;">Earn Money</p>
                        </li>
                        </ul>

                        <div style="clear: both">&nbsp;</div>
                        </div>
                        <div class="foter">
                       <h6 style="font-size: 13px;color: #666; float: right;margin: 0 0 30px 0;padding: 0;">Thank you for signing up! with AquaDeals. Call '.$sad_helpline.' for help</h6>
                        <div style="clear: both;"></div>
                        <div style="float: left;">
                       <h6 style="font-size: 15px;color: #333;margin: 0;">Download AquaDeals</h6>
                        <a href="https://play.google.com/store/apps/details?id=com.aquadeals.user" style="margin-top: 15px;display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/android_icon.png" /> </a>
                        </div>
                        <div style="float: right;">
                        <h6 style="font-size: 15px;color: #333;margin: 0;">Follow Us</h6>
                        <ul style="list-style: none;text-align: center;margin: 15px 0 0 0;padding: 0;">
                        <li style="float: left;"><a href="https://www.facebook.com/aquadealsstore/" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/fb_icon.png" /> </a></li>
                        <li style="float: right;"><a href="https://twitter.com/aquadealsstore" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/twitter_icon.png" /> </a></li>
                        </ul>
                        </div>
                        </div>
                </body>
                </html>';
        $res = $this->send($to,$subject,$mailcontent,2);
        return $res;
             }
            else
            {
                    return 1;
            }
    }
    //Welcome mail for owner
    public function welcome_owner($name,$email)
    {
        $to = $email;
        $subject = "Hi ".ucfirst($name)." - Welcome to the AquaDeals";
         $CI = & get_instance();//Get global functions
$shelpline_qry= $CI->db->query("SELECT value FROM `ad_settings` WHERE `key`='aquadeals_seller_helpline'");
$sad_helpline = $shelpline_qry->row('value');
        $mailcontent='<html>
                <head>
                        <meta charset="utf-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1">
                        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" /> 
                        <title>AquaDeals</title>
                        <style type="text/css">
                        .tot_pag{width: 40%;margin: 10px auto;}
                        .foter{overflow: hidden;width: 43%;margin: 10px auto;}
                        .nxt_stp li{width: 50%;margin-top: 10px;}
                        .nxt_stp li img{margin-right: 20px;margin-top: 10px;}
                        @media (max-width: 667px) {
                        .nxt_stp li{width: 100%;margin-top: 15px;}
                        .tot_pag{width: 80%;}
                        .foter{width: 83%;}
                        }
                        </style>
                </head>

                <body style="background: #eeeeee;font-family: arial;">
                        <div style="width: 100%;text-align: center;margin: 30px 0;"> <a href="#"> 
                        <img src="http://aqua.deals/admin/assets/email_imgs/slogo.png" /> </a> </div>
                        <div class="tot_pag" style="border-radius: 5px;background: #019cdf;padding: 20px;">
                        <h1 style="font-size: 16px;color: #fff;text-align: left;">Welcome to AquaDeals Partner App!</h1>
                        <p style="font-size: 14px;color: #fff;text-align: left;font-weight: normal;margin-top: 15px;">Here are a few quick tips to get you started
                        with AquaDeals.</p>
                        <ul style="list-style: none;overflow: hidden;padding: 0;margin: 0;" class="nxt_stp">
                        <li style="float: left;">
                        <img src="http://aqua.deals/admin/assets/email_imgs/mail_icon.png" style="float: left;" />
                        <p style="font-size: 14px;color: #fff;text-align: left;font-weight: normal;">Verify Email</p>
                        </li>
                        <li style="float: left;">
                        <img src="http://aqua.deals/admin/assets/email_imgs/search_icon.png" style="float: left;" />
                        <p style="font-size: 14px;color: #fff;text-align: left;font-weight: normal;">Create Deals</p>
                        </li>
                        <li style="float: left;">
                        <img src="http://aqua.deals/admin/assets/email_imgs/book_deal.png" style="float: left;" />
                        <p style="font-size: 14px;color: #fff;text-align: left;font-weight: normal;">Get Orders</p>
                        </li>
                        <li style="float: left;">
                        <img src="http://aqua.deals/admin/assets/email_imgs/aqua_cash.png" style="float: left;" />
                        <p style="font-size: 14px;color: #fff;text-align: left;font-weight: normal;">Earn Money</p>
                        </li>
                        </ul>

                        <div style="clear: both">&nbsp;</div>
                        </div>
                        <div class="foter">
                         <h6 style="font-size: 13px;color: #666; float: right;margin: 0 0 30px 0;padding: 0;">Thank you for signing up! with AquaDeals. Call '.$sad_helpline.' for help</h6>
                        <div style="clear: both;"></div>
                        <div style="float: left;">
                        <h6 style="font-size: 15px;color: #333;margin: 0;">Download AquaDeals</h6>
                        <a href="https://play.google.com/store/apps/details?id=com.aquadeals.user" style="margin-top: 15px;display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/android_icon.png" /> </a>
                        </div>
                        <div style="float: right;">
                        <h6 style="font-size: 15px;color: #333;margin: 0;">Follow Us</h6>
                        <ul style="list-style: none;text-align: center;margin: 15px 0 0 0;padding: 0;">
                        <li style="float: left;"><a href="https://www.facebook.com/aquadealsstore/" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/fb_icon.png" /> </a></li>
                        <li style="float: right;"><a href="https://twitter.com/aquadealsstore" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/twitter_icon.png" /> </a></li>
                        </ul>
                        </div>
                        </div>
                </body>
                </html>';
        $res = $this->send($to,$subject,$mailcontent,2);
        return $res;
    
    }
    
    //Credentials mail
    public function user_credentials($name,$password,$app,$email,$mobile)
    {
        if($email!='')
        {
        $to = $email;
        $subject = "Registration Information";
        if($app =="Aquadeals Seller")
        {
                $mailcontent = $this->getValue('ad_mails','content','action','Seller Credentials');
                $color_code ='#019cdf';
                $logo = 'slogo.png';
                $thanku = "Thank You for registering with AquaDeals Partner App.";
        }
        if($app =="Aquadeals")
        {
                $mailcontent = $this->getValue('ad_mails','content','action','User Credentials');
                $color_code ='#f15a25';
                $logo = 'logo.png';
                $thanku = "Thank You for registering with AquaDeals App.";
        }
        
        $mailcontent='<html>
                <head>
                        <meta charset="utf-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1">
                        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" /> 
                        <title>AquaDeals</title>
                        <style type="text/css">
                        .tot_pag{width: 40%;margin: 10px auto;}
                        .foter{overflow: hidden;width: 43%;margin: 10px auto;}
                        .nxt_stp li{width: 50%;margin-top: 10px;}
                        .nxt_stp li img{margin-right: 20px;margin-top: 10px;}
                        @media (max-width: 667px) {
                        .nxt_stp li{width: 100%;margin-top: 15px;}
                        .tot_pag{width: 80%;}
                        .foter{width: 83%;}
                        }
                        </style>
                </head>

                <body style="background: #eeeeee;font-family: arial;">
                        <div style="width: 100%;text-align: center;margin: 30px 0;"> <a href="#"> 
                        <img src="http://aqua.deals/admin/assets/email_imgs/'.$logo.'" /> </a> </div>
                        <div class="tot_pag" style="border-radius: 5px;background: '.$color_code.';padding: 20px;">
                        <h1 style="font-size: 16px;color: #fff;text-align: left;">Dear '.ucfirst($name).',</h1>
                        <p style="font-size: 14px;color: #fff;text-align: left;font-weight: normal;margin-top: 15px;">'.$thanku.'</p>
                        <p style="font-size: 14px;color: #fff;text-align: left;font-weight: normal;margin-top: 15px;">Following are the login details :</p>
                        <p style="font-size: 14px;color: #fff;text-align: left;font-weight: normal;margin-top: 15px;">Mobile : '.$mobile.'</p>
                        <p style="font-size: 14px;color: #fff;text-align: left;font-weight: normal;margin-top: 15px;">Password   : '.$password.'</p>
                        <div style="clear: both">&nbsp;</div>
                        </div>
                        <div class="foter">
                        <h6 style="font-size: 13px;color: #666; float: right;margin: 0 0 30px 0;padding: 0;">Thank you for signing up! with AquaDeals </h6>
                        <div style="clear: both;"></div>
                        <div style="float: left;">
                      <h6 style="font-size: 15px;color: #333;margin: 0;">Download AquaDeals</h6>
                        <a href="https://play.google.com/store/apps/details?id=com.aquadeals.user" style="margin-top: 15px;display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/android_icon.png" /> </a>
                        </div>
                        <div style="float: right;">
                        <h6 style="font-size: 15px;color: #333;margin: 0;">Follow Us</h6>
                        <ul style="list-style: none;text-align: center;margin: 15px 0 0 0;padding: 0;">
                        <li style="float: left;"><a href="https://www.facebook.com/aquadealsstore/" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/fb_icon.png" /> </a></li>
                        <li style="float: right;"><a href="https://twitter.com/aquadealsstore" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/twitter_icon.png" /> </a></li>
                        </ul>
                        </div>
                        </div>
                </body>
                </html>';
        //echo $mailcontent;exit;
        $res = $this->send($to,$subject,$mailcontent,1);
        return $res;
         }
            else
            {
                    return 1;
            }
        
    }
    

    //User verification mail
    public function user_reg_verif_mail($name,$email,$token)
    {
        if($email!='')
        {
        $to = $email;
        $subject = "Verify your email address";
        $CI = & get_instance();//Get global functions
$helpline_qry= $CI->db->query("SELECT value FROM `ad_settings` WHERE `key`='aquadeals_helpline'");
        $ad_helpline = $helpline_qry->row('value');
        $mailcontent='<html>
                <head>
                        <meta charset="utf-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1">
                        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" /> 
                        <title>AquaDeals</title>
                        <style type="text/css">
                        .tot_pag{width: 40%;margin: 10px auto;}
                        .foter{overflow: hidden;width: 43%;margin: 10px auto;}
                        .nxt_stp li{width: 50%;margin-top: 10px;}
                        .nxt_stp li img{margin-right: 20px;margin-top: 10px;}
                        @media (max-width: 667px) {
                        .nxt_stp li{width: 100%;margin-top: 15px;}
                        .tot_pag{width: 80%;}
                        .foter{width: 83%;}
                        }
                        </style>
                </head>

                        <body style="background: #eeeeee;font-family: arial;">
                        <div style="width: 100%;text-align: center;margin: 30px 0;"> <a href="#"> 
                        <img src="http://aqua.deals/admin/assets/email_imgs/logo.png" /> </a> </div>
                        <div class="tot_pag" style="border-radius: 5px;background: #f15a25;padding: 20px;">
                        <h1 style="font-size: 16px;color: #fff;text-align: left;">Welcome to AquaDeals!</h1>
                        <a href="http://aqua.deals/admin/1.0/user/activate/'.$token.'" style="font-size: 14px;color: #fff;text-align: left;font-weight: normal;margin-top: 15px;">Please click here to confirm your email address</a>
                        <p style="font-size: 14px;color: #fff;text-align: left;font-weight: normal;margin-top: 15px;">Discover great offers, deals and save your money.</p>
                       

                        <div style="clear: both">&nbsp;</div>
                        </div>
                        <div class="foter">
                        <h6 style="font-size: 13px;color: #666; float: right;margin: 0 0 30px 0;padding: 0;">Thank you for signing up! with AquaDeals. Call '.$ad_helpline.' for help. </h6>
                        <div style="clear: both;"></div>
                        <div style="float: left;">
                        <h6 style="font-size: 15px;color: #333;margin: 0;">Download AquaDeals</h6>
                        <a href="https://play.google.com/store/apps/details?id=com.aquadeals.user" style="margin-top: 15px;display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/android_icon.png" /> </a>
                        </div>
                        <div style="float: right;">
                        <h6 style="font-size: 15px;color: #333;margin: 0;">Follow Us</h6>
                        <ul style="list-style: none;text-align: center;margin: 15px 0 0 0;padding: 0;">
                        <li style="float: left;"><a href="https://www.facebook.com/aquadealsstore/" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/fb_icon.png" /> </a></li>
                        <li style="float: right;"><a href="https://twitter.com/aquadealsstore" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/twitter_icon.png" /> </a></li>
                        </ul>
                        </div>
                        </div>
                </body>
                </html>';
        $res = $this->send($to,$subject,$mailcontent,1);
        return $res;
         }
            else
            {
                    return 1;
            }
    }

    //Owner verification mail
    public function seller_reg_verif_mail($name,$email,$token)
    {
        if($email!='')
        {
        $to = $email;
        $subject = "Verify your email address";
         $CI = & get_instance();//Get global functions
                $shelpline_qry= $CI->db->query("SELECT value FROM `ad_settings` WHERE `key`='aquadeals_seller_helpline'");
                $sad_helpline = $shelpline_qry->row('value');
        $mailcontent='<html>
                <head>
                        <meta charset="utf-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1">
                        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" /> 
                        <title>AquaDeals</title>
                        <style type="text/css">
                        .tot_pag{width: 40%;margin: 10px auto;}
                        .foter{overflow: hidden;width: 43%;margin: 10px auto;}
                        .nxt_stp li{width: 50%;margin-top: 10px;}
                        .nxt_stp li img{margin-right: 20px;margin-top: 10px;}
                        @media (max-width: 667px) {
                        .nxt_stp li{width: 100%;margin-top: 15px;}
                        .tot_pag{width: 80%;}
                        .foter{width: 83%;}
                        }
                        </style>
                </head>

                        <body style="background: #eeeeee;font-family: arial;">
                        <div style="width: 100%;text-align: center;margin: 30px 0;"> <a href="#"> 
                        <img src="http://aqua.deals/admin/assets/email_imgs/slogo.png" /> </a> </div>
                        <div class="tot_pag" style="border-radius: 5px;background: #019cdf;padding: 20px;">
                        <h1 style="font-size: 16px;color: #fff;text-align: left;">Welcome to AquaDeals Partner App!</h1>
                        <p style="font-size: 14px;color: #fff;text-align: left;font-weight: normal;margin-top: 15px;">Please verify your email to approve your AquaDeals Partner  account.</p>
                        <a href="http://aqua.deals/admin/1.0/seller/activate/'.$token.'" style="font-size: 14px;color: #fff;text-align: left;font-weight: normal;margin-top: 15px;">Please click here to confirm your email address</a>
                        <div style="clear: both">&nbsp;</div>
                        </div>
                        <div class="foter">
                        <h6 style="font-size: 13px;color: #666; float: right;margin: 0 0 30px 0;padding: 0;">Thank you for signing up! with AquaDeals. Call '.$sad_helpline.' for help. </h6>
                        <div style="clear: both;"></div>
                        <div style="float: left;">
                        <h6 style="font-size: 15px;color: #333;margin: 0;">Download AquaDeals</h6>
                        <a href="https://play.google.com/store/apps/details?id=com.aquadeals.user" style="margin-top: 15px;display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/android_icon.png" /> </a>
                        </div>
                        <div style="float: right;">
                        <h6 style="font-size: 15px;color: #333;margin: 0;">Follow Us</h6>
                        <ul style="list-style: none;text-align: center;margin: 15px 0 0 0;padding: 0;">
                        <li style="float: left;"><a href="https://www.facebook.com/aquadealsstore/" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/fb_icon.png" /> </a></li>
                        <li style="float: right;"><a href="https://twitter.com/aquadealsstore" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/twitter_icon.png" /> </a></li>
                        </ul>
                        </div>
                        </div>
                </body>
                </html>';
        $res = $this->send($to,$subject,$mailcontent,2);
        return $res;
         }
            else
            {
                    return 1;
            }
    }

    //Manufacturer verification mail
    public function manuf_reg_verif_mail($name,$email,$token)
    {
        if($email!='')
        {
        $to = $email;
        $subject = "Verify your email address";
        $CI = & get_instance();//Get global functions
        $shelpline_qry= $CI->db->query("SELECT value FROM `ad_settings` WHERE `key`='aquadeals_seller_helpline'");
        $sad_helpline = $shelpline_qry->row('value');
        $mailcontent='<html>
                <head>
                        <meta charset="utf-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1">
                        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" /> 
                        <title>AquaDeals</title>
                        <style type="text/css">
                        .tot_pag{width: 40%;margin: 10px auto;}
                        .foter{overflow: hidden;width: 43%;margin: 10px auto;}
                        .nxt_stp li{width: 50%;margin-top: 10px;}
                        .nxt_stp li img{margin-right: 20px;margin-top: 10px;}
                        @media (max-width: 667px) {
                        .nxt_stp li{width: 100%;margin-top: 15px;}
                        .tot_pag{width: 80%;}
                        .foter{width: 83%;}
                        }
                        </style>
                </head>

                        <body style="background: #eeeeee;font-family: arial;">
                        <div style="width: 100%;text-align: center;margin: 30px 0;"> <a href="#"> 
                        <img src="http://aqua.deals/admin/assets/email_imgs/slogo.png" /> </a> </div>
                        <div class="tot_pag" style="border-radius: 5px;background: #019cdf;padding: 20px;">
                        <h1 style="font-size: 16px;color: #fff;text-align: left;">Welcome to AquaDeals Partner App!</h1>
                        <p style="font-size: 14px;color: #fff;text-align: left;font-weight: normal;margin-top: 15px;">Please verify your email to approve your AquaDeals Partner  account.</p>
                        <a href="http://aqua.deals/admin/1.0/seller/activate/'.$token.'" style="font-size: 14px;color: #fff;text-align: left;font-weight: normal;margin-top: 15px;">Please click here to confirm your email address</a>
                        <div style="clear: both">&nbsp;</div>
                        </div>
                        <div class="foter">
                        <h6 style="font-size: 13px;color: #666; float: right;margin: 0 0 30px 0;padding: 0;">Thank you for signing up! with AquaDeals. Call '.$sad_helpline.' for help. </h6>
                        <div style="clear: both;"></div>
                        <div style="float: left;">
                       <h6 style="font-size: 15px;color: #333;margin: 0;">Download AquaDeals</h6>
                        <a href="https://play.google.com/store/apps/details?id=com.aquadeals.user" style="margin-top: 15px;display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/android_icon.png" /> </a>
                        </div>
                        <div style="float: right;">
                        <h6 style="font-size: 15px;color: #333;margin: 0;">Follow Us</h6>
                        <ul style="list-style: none;text-align: center;margin: 15px 0 0 0;padding: 0;">
                        <li style="float: left;"><a href="https://www.facebook.com/aquadealsstore/" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/fb_icon.png" /> </a></li>
                        <li style="float: right;"><a href="https://twitter.com/aquadealsstore" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/twitter_icon.png" /> </a></li>
                        </ul>
                        </div>
                        </div>
                </body>
                </html>';
        
        $res = $this->send($to,$subject,$mailcontent,2);
        return $res;
         }
            else
            {
                    return 1;
            }
    }
    

    //Owner profile complete alert mail
    public function owner_reg_cmplt_proAlert($name,$email,$token)
    {
        if($email!='')
        {
        $to = $email;
        $subject = "Hi $name - Complete your profile";
        $CI = & get_instance();//Get global functions
$shelpline_qry= $CI->db->query("SELECT value FROM `ad_settings` WHERE `key`='aquadeals_seller_helpline'");
$sad_helpline = $shelpline_qry->row('value');
        $mailcontent='<html>
                <head>
                        <meta charset="utf-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1">
                        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" /> 
                        <title>AquaDeals</title>
                        <style type="text/css">
                        .tot_pag{width: 40%;margin: 10px auto;}
                        .foter{overflow: hidden;width: 43%;margin: 10px auto;}
                        .nxt_stp li{width: 50%;margin-top: 10px;}
                        .nxt_stp li img{margin-right: 20px;margin-top: 10px;}
                        @media (max-width: 667px) {
                        .nxt_stp li{width: 100%;margin-top: 15px;}
                        .tot_pag{width: 80%;}
                        .foter{width: 83%;}
                        }
                        </style>
                </head>

                        <body style="background: #eeeeee;font-family: arial;">
                        <div style="width: 100%;text-align: center;margin: 30px 0;"> <a href="#"> 
                        <img src="http://aqua.deals/admin/assets/email_imgs/slogo.png" /> </a> </div>
                        <div class="tot_pag" style="border-radius: 5px;background: #019cdf;padding: 20px;">
                        <h1 style="font-size: 16px;color: #fff;text-align: left;">Dear '.ucfirst($name).'</h1>
                        
                        <p style="font-size: 14px;color: #fff;text-align: left;font-weight: normal;margin-top: 15px;">Please login into your AquaDeals Partner App and complete your profile information.</p>
                       

                        <div style="clear: both">&nbsp;</div>
                        </div>
                        <div class="foter">
                        <h6 style="font-size: 13px;color: #666; float: right;margin: 0 0 30px 0;padding: 0;">Thank you for signing up! with AquaDeals. Call '.$sad_helpline.' for help. </h6>
                        <div style="clear: both;"></div>
                        <div style="float: left;">
                        <h6 style="font-size: 15px;color: #333;margin: 0;">Download AquaDeals</h6>
                        <a href="https://play.google.com/store/apps/details?id=com.aquadeals.user" style="margin-top: 15px;display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/android_icon.png" /> </a>
                        </div>
                        <div style="float: right;">
                        <h6 style="font-size: 15px;color: #333;margin: 0;">Follow Us</h6>
                        <ul style="list-style: none;text-align: center;margin: 15px 0 0 0;padding: 0;">
                        <li style="float: left;"><a href="https://www.facebook.com/aquadealsstore/" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/fb_icon.png" /> </a></li>
                        <li style="float: right;"><a href="https://twitter.com/aquadealsstore" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/twitter_icon.png" /> </a></li>
                        </ul>
                        </div>
                        </div>
                </body>
                </html>';
        $res = $this->send($to,$subject,$mailcontent,2);
        return $res;
         }
            else
            {
                    return 1;
            }
    }
    //manufacturer profile complete alert mail
    public function manuf_reg_cmplt_proAlert($name,$email,$token)
    {
        if($email!='')
        {
        $to = $email;
        $subject = "Hi $name - Complete your profile";
        $CI = & get_instance();//Get global functions
$shelpline_qry= $CI->db->query("SELECT value FROM `ad_settings` WHERE `key`='aquadeals_seller_helpline'");
$sad_helpline = $shelpline_qry->row('value');
        $mailcontent='<html>
                <head>
                        <meta charset="utf-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1">
                        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" /> 
                        <title>AquaDeals</title>
                        <style type="text/css">
                        .tot_pag{width: 40%;margin: 10px auto;}
                        .foter{overflow: hidden;width: 43%;margin: 10px auto;}
                        .nxt_stp li{width: 50%;margin-top: 10px;}
                        .nxt_stp li img{margin-right: 20px;margin-top: 10px;}
                        @media (max-width: 667px) {
                        .nxt_stp li{width: 100%;margin-top: 15px;}
                        .tot_pag{width: 80%;}
                        .foter{width: 83%;}
                        }
                        </style>
                </head>

                        <body style="background: #eeeeee;font-family: arial;">
                        <div style="width: 100%;text-align: center;margin: 30px 0;"> <a href="#"> 
                        <img src="http://aqua.deals/admin/assets/email_imgs/slogo.png" /> </a> </div>
                        <div class="tot_pag" style="border-radius: 5px;background: #019cdf;padding: 20px;">
                        <h1 style="font-size: 16px;color: #fff;text-align: left;">Dear '.ucfirst($name).'</h1>
                        
                        <p style="font-size: 14px;color: #fff;text-align: left;font-weight: normal;margin-top: 15px;">Please login into your AquaDeals Partner App and complete your profile information.</p>
                       

                        <div style="clear: both">&nbsp;</div>
                        </div>
                        <div class="foter">
                        <h6 style="font-size: 13px;color: #666; float: right;margin: 0 0 30px 0;padding: 0;">Thank you for signing up! with AquaDeals. Call '.$sad_helpline.' for help. </h6>
                        <div style="clear: both;"></div>
                        <div style="float: left;">
                       <h6 style="font-size: 15px;color: #333;margin: 0;">Download AquaDeals</h6>
                        <a href="https://play.google.com/store/apps/details?id=com.aquadeals.user" style="margin-top: 15px;display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/android_icon.png" /> </a>
                        </div>
                        <div style="float: right;">
                        <h6 style="font-size: 15px;color: #333;margin: 0;">Follow Us</h6>
                        <ul style="list-style: none;text-align: center;margin: 15px 0 0 0;padding: 0;">
                        <li style="float: left;"><a href="https://www.facebook.com/aquadealsstore/" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/fb_icon.png" /> </a></li>
                        <li style="float: right;"><a href="https://twitter.com/aquadealsstore" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/twitter_icon.png" /> </a></li>
                        </ul>
                        </div>
                        </div>
                </body>
                </html>';
        $res = $this->send($to,$subject,$mailcontent,2);
        return $res;
         }
            else
            {
                    return 1;
            }
    }
    //Owner email verification alert mail
    public function seller_reg_verif_alertMail($name,$email,$token)
    {
        if($email!='')
        {
        $to = $email;
        $subject = "Hi $name - Verify your email";
        
        $mailcontent='<html>
                <head>
                        <meta charset="utf-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1">
                        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" /> 
                        <title>AquaDeals</title>
                        <style type="text/css">
                        .tot_pag{width: 40%;margin: 10px auto;}
                        .foter{overflow: hidden;width: 43%;margin: 10px auto;}
                        .nxt_stp li{width: 50%;margin-top: 10px;}
                        .nxt_stp li img{margin-right: 20px;margin-top: 10px;}
                        @media (max-width: 667px) {
                        .nxt_stp li{width: 100%;margin-top: 15px;}
                        .tot_pag{width: 80%;}
                        .foter{width: 83%;}
                        }
                        </style>
                </head>

                        <body style="background: #eeeeee;font-family: arial;">
                        <div style="width: 100%;text-align: center;margin: 30px 0;"> <a href="#"> 
                        <img src="http://aqua.deals/admin/assets/email_imgs/slogo.png" /> </a> </div>
                        <div class="tot_pag" style="border-radius: 5px;background: #019cdf;padding: 20px;">
                        <h1 style="font-size: 16px;color: #fff;text-align: left;">Welcome to AquaDeals Partner App!</h1>
                         <p style="font-size: 14px;color: #fff;text-align: left;font-weight: normal;margin-top: 15px;">Please verify your email to approve your AquaDeals Partner  account.</p>
                        <a href="http://aqua.deals/admin/1.0/seller/activate/'.$token.'" style="font-size: 14px;color: #fff;text-align: left;font-weight: normal;margin-top: 15px;">Please click here to confirm your email address</a>
                       
                       

                        <div style="clear: both">&nbsp;</div>
                        </div>
                        <div class="foter">
                        <h6 style="font-size: 13px;color: #666; float: right;margin: 0 0 30px 0;padding: 0;">Thank you for signing up! with AquaDeals </h6>
                        <div style="clear: both;"></div>
                        <div style="float: left;">
                        <h6 style="font-size: 15px;color: #333;margin: 0;">Download AquaDeals</h6>
                        <a href="https://play.google.com/store/apps/details?id=com.aquadeals.user" style="margin-top: 15px;display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/android_icon.png" /> </a>
                        </div>
                        <div style="float: right;">
                        <h6 style="font-size: 15px;color: #333;margin: 0;">Follow Us</h6>
                        <ul style="list-style: none;text-align: center;margin: 15px 0 0 0;padding: 0;">
                        <li style="float: left;"><a href="https://www.facebook.com/aquadealsstore/" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/fb_icon.png" /> </a></li>
                        <li style="float: right;"><a href="https://twitter.com/aquadealsstore" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/twitter_icon.png" /> </a></li>
                        </ul>
                        </div>
                        </div>
                </body>
                </html>';
        
        $res = $this->send($to,$subject,$mailcontent,2);
        return $res;
         }
            else
            {
                    return 1;
            }
    }
    //Manufacturer email verification alert mail
    public function manuf_reg_verif_alertMail($name,$email,$token)
    {
        $to = $email;
        $subject = "Hi $name - Verify your email";
        
        $mailcontent = $this->getValue('ad_mails','content','action','Manufacturer Email Verification Alert');
        $mailcontent = str_replace("&amp;token&amp;",$token,$mailcontent);
        //echo $mailcontent;exit;
        $res = $this->send($to,$subject,$mailcontent,2);
        return $res;
    }
    //owner approval email
    public function seller_appr($name,$email,$oname)
    {
        if($email!='')
        {
        $to = $email;
        $subject = "Account approved";
        $CI = & get_instance();//Get global functions
$shelpline_qry= $CI->db->query("SELECT value FROM `ad_settings` WHERE `key`='aquadeals_seller_helpline'");
$sad_helpline = $shelpline_qry->row('value');
        $mailcontent='<html>
                <head>
                        <meta charset="utf-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1">
                        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" /> 
                        <title>AquaDeals</title>
                        <style type="text/css">
                        .tot_pag{width: 40%;margin: 10px auto;}
                        .foter{overflow: hidden;width: 43%;margin: 10px auto;}
                        .nxt_stp li{width: 50%;margin-top: 10px;}
                        .nxt_stp li img{margin-right: 20px;margin-top: 10px;}
                        @media (max-width: 667px) {
                        .nxt_stp li{width: 100%;margin-top: 15px;}
                        .tot_pag{width: 80%;}
                        .foter{width: 83%;}
                        }
                        </style>
                </head>

                        <body style="background: #eeeeee;font-family: arial;">
                        <div style="width: 100%;text-align: center;margin: 30px 0;"> <a href="#"> 
                        <img src="http://aqua.deals/admin/assets/email_imgs/slogo.png" /> </a> </div>
                        <div class="tot_pag" style="border-radius: 5px;background: #019cdf;padding: 20px;">
                        <h1 style="font-size: 16px;color: #fff;text-align: left;">Dear '.$name.',</h1>
                        <p style="font-size: 14px;color: #fff;text-align: left;font-weight: normal;margin-top: 15px;">Congratulations! </p>
                         <p style="font-size: 14px;color: #fff;text-align: left;font-weight: normal;margin-top: 15px;">Your <b>'.$oname.'</b> account is approved.</p>
                       <p style="font-size: 14px;color: #fff;text-align: left;font-weight: normal;margin-top: 15px;">Now you can start posting your deals.</p>
                        <div style="clear: both">&nbsp;</div>
                        </div>
                        <div class="foter">
                       <h6 style="font-size: 13px;color: #666; float: right;margin: 0 0 30px 0;padding: 0;">Thank you for signing up! with AquaDeals. Call '.$sad_helpline.' for help. </h6>
                        <div style="clear: both;"></div>
                        <div style="float: left;">
                        <h6 style="font-size: 15px;color: #333;margin: 0;">Download AquaDeals</h6>
                        <a href="https://play.google.com/store/apps/details?id=com.aquadeals.user" style="margin-top: 15px;display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/android_icon.png" /> </a>
                        </div>
                        <div style="float: right;">
                        <h6 style="font-size: 15px;color: #333;margin: 0;">Follow Us</h6>
                        <ul style="list-style: none;text-align: center;margin: 15px 0 0 0;padding: 0;">
                        <li style="float: left;"><a href="https://www.facebook.com/aquadealsstore/" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/fb_icon.png" /> </a></li>
                        <li style="float: right;"><a href="https://twitter.com/aquadealsstore" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/twitter_icon.png" /> </a></li>
                        </ul>
                        </div>
                        </div>
                </body>
                </html>';
        $res = $this->send($to,$subject,$mailcontent,2);
        return $res;
         }
            else
            {
                    return 1;
            }
    }
    
        //send email when aquacash is added to user
    public function sendAquacash_add($name,$email,$amt)
    {
            if($email!='')
            {
            $to = $email;
        $subject = "Hi $name - Aquacash Credited";
        $CI = & get_instance();//Get global functions
                $helpline_qry= $CI->db->query("SELECT value FROM `ad_settings` WHERE `key`='aquadeals_helpline'");
        $ad_helpline = $helpline_qry->row('value');
        $msg = "Rs ".$amt." AquaCash credited to your account.";
        $mailcontent='<html>
                <head>
                        <meta charset="utf-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1">
                        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" /> 
                        <title>AquaDeals</title>
                        <style type="text/css">
                        .tot_pag{width: 40%;margin: 10px auto;}
                        .foter{overflow: hidden;width: 43%;margin: 10px auto;}
                        .nxt_stp li{width: 50%;margin-top: 10px;}
                        .nxt_stp li img{margin-right: 20px;margin-top: 10px;}
                        @media (max-width: 667px) {
                        .nxt_stp li{width: 100%;margin-top: 15px;}
                        .tot_pag{width: 80%;}
                        .foter{width: 83%;}
                        }
                        </style>
                </head>

                <body style="background: #eeeeee;font-family: arial;">
                        <div style="width: 100%;text-align: center;margin: 30px 0;"> <a href="#"> 
                        <img src="http://aqua.deals/admin/assets/email_imgs/logo.png" /> </a> </div>
                        <div class="tot_pag" style="border-radius: 5px;background:#f15a25;padding: 20px;">
                        <h1 style="font-size: 16px;color: #fff;text-align: left;">Dear '.ucfirst($name).',</h1>
                        <p style="font-size: 14px;color: #fff;text-align: left;font-weight: normal;margin-top: 15px;">'.$msg.'</p>
                        <div style="clear: both">&nbsp;</div>
                        </div>
                        <div class="foter">
                         <h6 style="font-size: 13px;color: #666; float: right;margin: 0 0 30px 0;padding: 0;">Thank you for signing up! with AquaDeals. Call '.$ad_helpline.' for help. </h6>
                        <div style="clear: both;"></div>
                        <div style="float: left;">
                        <h6 style="font-size: 15px;color: #333;margin: 0;">Download AquaDeals</h6>
                        <a href="https://play.google.com/store/apps/details?id=com.aquadeals.user" style="margin-top: 15px;display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/android_icon.png" /> </a>
                        </div>
                        <div style="float: right;">
                        <h6 style="font-size: 15px;color: #333;margin: 0;">Follow Us</h6>
                        <ul style="list-style: none;text-align: center;margin: 15px 0 0 0;padding: 0;">
                        <li style="float: left;"><a href="https://www.facebook.com/aquadealsstore/" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/fb_icon.png" /> </a></li>
                        <li style="float: right;"><a href="https://twitter.com/aquadealsstore" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/twitter_icon.png" /> </a></li>
                        </ul>
                        </div>
                        </div>
                </body>
                </html>';
        $res = $this->send($to,$subject,$mailcontent,1);
        return $res;
         }
            else
            {
                    return 1;
            }
    }
    
    
    //owner reject email
    public function seller_reject($name,$email,$reason,$oname)
    {
        if($email!='')
        {
        $to = $email;
        $subject = "Account rejected";
        if($oname!='')
        {
        $oname=$oname;
        }
        else
        {
        $oname="AquaDeals Partner Account";
        }
        $CI = & get_instance();//Get global functions
                $shelpline_qry= $CI->db->query("SELECT value FROM `ad_settings` WHERE `key`='aquadeals_seller_helpline'");
                $sad_helpline = $shelpline_qry->row('value');
        $mailcontent='<html>
                <head>
                        <meta charset="utf-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1">
                        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" /> 
                        <title>AquaDeals</title>
                        <style type="text/css">
                        .tot_pag{width: 40%;margin: 10px auto;}
                        .foter{overflow: hidden;width: 43%;margin: 10px auto;}
                        .nxt_stp li{width: 50%;margin-top: 10px;}
                        .nxt_stp li img{margin-right: 20px;margin-top: 10px;}
                        @media (max-width: 667px) {
                        .nxt_stp li{width: 100%;margin-top: 15px;}
                        .tot_pag{width: 80%;}
                        .foter{width: 83%;}
                        }
                        </style>
                </head>

                        <body style="background: #eeeeee;font-family: arial;">
                        <div style="width: 100%;text-align: center;margin: 30px 0;"> <a href="#"> 
                        <img src="http://aqua.deals/admin/assets/email_imgs/slogo.png" /> </a> </div>
                        <div class="tot_pag" style="border-radius: 5px;background: #019cdf;padding: 20px;">
                        <h1 style="font-size: 16px;color: #fff;text-align: left;">Dear '.$name.',</h1>
                        <p style="font-size: 14px;color: #fff;text-align: left;font-weight: normal;margin-top: 15px;">Your '.$oname.'  is Rejected.

</p>
                         <p style="font-size: 14px;color: #fff;text-align: left;font-weight: normal;margin-top: 15px;"><b>Reason:</b>'.ucfirst($reason).'</p>
                        <div style="clear: both">&nbsp;</div>
                        </div>
                        <div class="foter">
                       <h6 style="font-size: 13px;color: #666; float: right;margin: 0 0 30px 0;padding: 0;">Stay connected to grab the best deals!. Call '.$sad_helpline.' for help. </h6>
                        <div style="float: left;">
                        <h6 style="font-size: 15px;color: #333;margin: 0;">Download AquaDeals</h6>
                        <a href="https://play.google.com/store/apps/details?id=com.aquadeals.user" style="margin-top: 15px;display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/android_icon.png" /> </a>
                        </div>
                        <div style="float: right;">
                        <h6 style="font-size: 15px;color: #333;margin: 0;">Follow Us</h6>
                        <ul style="list-style: none;text-align: center;margin: 15px 0 0 0;padding: 0;">
                        <li style="float: left;"><a href="https://www.facebook.com/aquadealsstore/" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/fb_icon.png" /> </a></li>
                        <li style="float: right;"><a href="https://twitter.com/aquadealsstore" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/twitter_icon.png" /> </a></li>
                        </ul>
                        </div>
                        </div>
                </body>
                </html>';
        $res = $this->send($to,$subject,$mailcontent,2);
        return $res;
         }
            else
            {
                    return 1;
            }
    }
        
        //Manufacturer reject email
    public function manuf_reject($name,$email,$reason,$mname)
    {
        if($email!='')
        {
        $to = $email;
        $subject = "Account rejected";
        if($mname!='')
        {
        $mname = $mname;
        }
        else
        {
        $mname = "AquaDeals Seller Account";
        }
        $CI = & get_instance();//Get global functions
                $shelpline_qry= $CI->db->query("SELECT value FROM `ad_settings` WHERE `key`='aquadeals_seller_helpline'");
                $sad_helpline = $shelpline_qry->row('value');
        $mailcontent='<html>
                <head>
                        <meta charset="utf-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1">
                        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" /> 
                        <title>AquaDeals</title>
                        <style type="text/css">
                        .tot_pag{width: 40%;margin: 10px auto;}
                        .foter{overflow: hidden;width: 43%;margin: 10px auto;}
                        .nxt_stp li{width: 50%;margin-top: 10px;}
                        .nxt_stp li img{margin-right: 20px;margin-top: 10px;}
                        @media (max-width: 667px) {
                        .nxt_stp li{width: 100%;margin-top: 15px;}
                        .tot_pag{width: 80%;}
                        .foter{width: 83%;}
                        }
                        </style>
                </head>

                        <body style="background: #eeeeee;font-family: arial;">
                        <div style="width: 100%;text-align: center;margin: 30px 0;"> <a href="#"> 
                        <img src="http://aqua.deals/admin/assets/email_imgs/slogo.png" /> </a> </div>
                        <div class="tot_pag" style="border-radius: 5px;background: #019cdf;padding: 20px;">
                        <h1 style="font-size: 16px;color: #fff;text-align: left;">Dear '.$name.',</h1>
                        <p style="font-size: 14px;color: #fff;text-align: left;font-weight: normal;margin-top: 15px;">Your '.$mname.' account is Rejected.

</p>
                         <p style="font-size: 14px;color: #fff;text-align: left;font-weight: normal;margin-top: 15px;"><b>Reason:</b>'.ucfirst($reason).'</p>
                        <div style="clear: both">&nbsp;</div>
                        </div>
                        <div class="foter">
                        <h6 style="font-size: 13px;color: #666; float: right;margin: 0 0 30px 0;padding: 0;">Stay connected to grab the best deals!. Call '.$sad_helpline.' for help. </h6>
                        <div style="clear: both;"></div>
                        <div style="float: left;">
                        <h6 style="font-size: 15px;color: #333;margin: 0;">Download AquaDeals</h6>
                        <a href="https://play.google.com/store/apps/details?id=com.aquadeals.user" style="margin-top: 15px;display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/android_icon.png" /> </a>
                        </div>
                        <div style="float: right;">
                        <h6 style="font-size: 15px;color: #333;margin: 0;">Follow Us</h6>
                        <ul style="list-style: none;text-align: center;margin: 15px 0 0 0;padding: 0;">
                        <li style="float: left;"><a href="https://www.facebook.com/aquadealsstore/" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/fb_icon.png" /> </a></li>
                        <li style="float: right;"><a href="https://twitter.com/aquadealsstore" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/twitter_icon.png" /> </a></li>
                        </ul>
                        </div>
                        </div>
                </body>
                </html>';
        
        $res = $this->send($to,$subject,$mailcontent,2);
        return $res;
         }
            else
            {
                    return 1;
            }
    }
        
        //Send custom emails to the users
        public function sendcustomMail($text,$email,$name,$title)
        {
                if($email!='')
                {
                $to = $email;
        $subject = "Hi $name - ".$title;
        $mailcontent = $text;
        $mailcontent='<html>
                <head>
                        <meta charset="utf-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1">
                        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" /> 
                        <title>AquaDeals</title>
                        <style type="text/css">
                        .tot_pag{width: 40%;margin: 10px auto;}
                        .foter{overflow: hidden;width: 43%;margin: 10px auto;}
                        .nxt_stp li{width: 50%;margin-top: 10px;}
                        .nxt_stp li img{margin-right: 20px;margin-top: 10px;}
                        @media (max-width: 667px) {
                        .nxt_stp li{width: 100%;margin-top: 15px;}
                        .tot_pag{width: 80%;}
                        .foter{width: 83%;}
                        }
                        </style>
                </head>

                        <body style="background: #eeeeee;font-family: arial;">
                        <div style="width: 100%;text-align: center;margin: 30px 0;"> <a href="#"> 
                        <img src="http://aqua.deals/admin/assets/email_imgs/logo.png" /> </a> </div>
                        <div class="tot_pag" style="border-radius: 5px;background: #f15a25;padding: 20px;">
                        <h1 style="font-size: 16px;color: #fff;text-align: left;">Dear '.$name.',</h1>
                        <p style="font-size: 14px;color: #fff;text-align: left;font-weight: normal;margin-top: 15px;">'.ucfirst($text).'</p>
                       
                        <div style="clear: both">&nbsp;</div>
                        </div>
                        <div class="foter">
                        <h6 style="font-size: 13px;color: #666; float: right;margin: 0 0 30px 0;padding: 0;">Thank you for signing up! with AquaDeals. </h6>
                        <div style="clear: both;"></div>
                        <div style="float: left;">
                        <h6 style="font-size: 15px;color: #333;margin: 0;">Download AquaDeals</h6>
                        <a href="https://play.google.com/store/apps/details?id=com.aquadeals.user" style="margin-top: 15px;display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/android_icon.png" /> </a>
                        </div>
                        <div style="float: right;">
                        <h6 style="font-size: 15px;color: #333;margin: 0;">Follow Us</h6>
                        <ul style="list-style: none;text-align: center;margin: 15px 0 0 0;padding: 0;">
                        <li style="float: left;"><a href="https://www.facebook.com/aquadealsstore/" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/fb_icon.png" /> </a></li>
                        <li style="float: right;"><a href="https://twitter.com/aquadealsstore" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/twitter_icon.png" /> </a></li>
                        </ul>
                        </div>
                        </div>
                </body>
                </html>';
        $res = $this->send($to,$subject,$mailcontent,1);
         }
            else
            {
                    return 1;
            }
        }
    
    //Aquacash low
    function aquacashLow($userId)
    {
        //echo "SELECT name,email from ad_users where id = $userId";exit;
        $CI = & get_instance();
            $user_query = $CI->db->query("SELECT name,email from ad_users where id = $userId");
            $username =  $user_query->row('name');
        $email = $user_query->row('email');
        //echo $email;exit;
        $amt_exe = $CI->db->query("SELECT aqua_cash FROM ad_users WHERE id = $userId");
        $amt = '&#8377; '.$amt_exe->row('aqua_cash');
        
        $mailcontent='<html>
                <head>
                        <meta charset="utf-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1">
                        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" /> 
                        <title>AquaDeals</title>
                        <style type="text/css">
                        .tot_pag{width: 40%;margin: 10px auto;}
                        .foter{overflow: hidden;width: 43%;margin: 10px auto;}
                        .nxt_stp li{width: 50%;margin-top: 10px;}
                        .nxt_stp li img{margin-right: 20px;margin-top: 10px;}
                        @media (max-width: 667px) {
                        .nxt_stp li{width: 100%;margin-top: 15px;}
                        .tot_pag{width: 80%;}
                        .foter{width: 83%;}
                        }
                        </style>
                </head>

                        <body style="background: #eeeeee;font-family: arial;">
                        <div style="width: 100%;text-align: center;margin: 30px 0;"> <a href="#"> 
                        <img src="http://aqua.deals/admin/assets/email_imgs/logo.png" /> </a> </div>
                        <div class="tot_pag" style="border-radius: 5px;background: #f15a25;padding: 20px;">
                        <h1 style="font-size: 16px;color: #fff;text-align: left;">Dear '.$username.',</h1>
                        <p style="font-size: 14px;color: #fff;text-align: left;font-weight: normal;margin-top: 15px;">Your AquaCash is low. Your current Aquacash balance is  '.$amt.'.</p>
                        <p style="font-size: 14px;color: #fff;text-align: left;font-weight: normal;margin-top: 15px;"><b>
                        Refer your friends and earn AquaCash.
                        </b></p>
                        <div style="clear: both">&nbsp;</div>
                        </div>
                        <div class="foter">
                        <h6 style="font-size: 13px;color: #666; float: right;margin: 0 0 30px 0;padding: 0;">Thank you for signing up! with AquaDeals. </h6>
                        <div style="clear: both;"></div>
                        <div style="float: left;">
                        <h6 style="font-size: 15px;color: #333;margin: 0;">Download AquaDeals</h6>
                        <a href="https://play.google.com/store/apps/details?id=com.aquadeals.user" style="margin-top: 15px;display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/android_icon.png" /> </a>
                        </div>
                        <div style="float: right;">
                        <h6 style="font-size: 15px;color: #333;margin: 0;">Follow Us</h6>
                        <ul style="list-style: none;text-align: center;margin: 15px 0 0 0;padding: 0;">
                        <li style="float: left;"><a href="https://www.facebook.com/aquadealsstore/" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/fb_icon.png" /> </a></li>
                        <li style="float: right;"><a href="https://twitter.com/aquadealsstore" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/twitter_icon.png" /> </a></li>
                        </ul>
                        </div>
                        </div>
                </body>
                </html>';
        $user_email_flag = $this->getValue('ad_users','email_flag','id',$userId);
        if($user_email_flag==1)
        {
            $res = $this->send($email,'Aquacash Low',$mailcontent,1);
            return $res;
        }
        
        
        
    }
    
    
    
    function dealComplete($dealId)
    {
        $CI = & get_instance();
            $deal_exe = $CI->db->query("SELECT ad_vendor_deals.deal_id,ad_vendor_deals.seller_id,ad_vendor_deals.price,ad_vendor_deals.discount_price,ad_vendor_deals.start_date,ad_vendor_deals.created_on,ad_vendor_deals.end_date, ad_sellers.contact_person, ad_sellers.email, ad_species.type FROM `ad_vendor_deals` INNER JOIN ad_sellers on ad_sellers.id = ad_vendor_deals.seller_id INNER JOIN ad_species on ad_species.id = ad_vendor_deals.species_id WHERE ad_vendor_deals.id  = $dealId");
        
        $username =  ucfirst($deal_exe->row('name'));
        $email = $deal_exe->row('email');
        $specie = $deal_exe->row('type');
        $deal_id = $deal_exe->row('deal_id');
        $sdate= $deal_exe->row('start_date');
        $edate = $deal_exe->row('end_date');
        $cdate = $deal_exe->row('created_on');
        $srate = $deal_exe->row('price');
        $drate = $deal_exe->row('discount_price');
        
        //send email
        $mailcontent = $this->getValue('ad_mails','content','action','Deal Completed');
        $mailcontent = str_replace("&amp;username&amp;",$username,$mailcontent);
        $mailcontent = str_replace("&amp;dealid&amp;",$deal_id,$mailcontent);
        $mailcontent = str_replace("&amp;specie&amp;",$specie,$mailcontent);
        $mailcontent = str_replace("&amp;srate&amp;",$srate,$mailcontent);
        $mailcontent = str_replace("&amp;drate&amp;",$drate,$mailcontent);
        $mailcontent = str_replace("&amp;edate&amp;",$edate,$mailcontent);
        $mailcontent = str_replace("&amp;sdate&amp;",$sdate,$mailcontent);
        $mailcontent = str_replace("&amp;cdate&amp;",$cdate,$mailcontent);
        
        $subject  = 'Deal Completed'; 
        if($email!='')
        {
        $res = $this->send($email,$subject,$mailcontent,2);
        return $res;
         }
            else
            {
                    return 1;
            }
        
    }

    //
    //Sending email when user inactivated
    function inact_user($email,$name,$app)
    {
        $CI = & get_instance();
            $mailcontent = $this->getValue('ad_mails','content','action','Inactive - User');
        $mailcontent = str_replace("&amp;username&amp;",$name,$mailcontent);
        $mailcontent = str_replace("&amp;app&amp;",$app,$mailcontent);
        $subject  = 'Account Inactivated'; 
        $helpline_qry= $CI->db->query("SELECT value FROM `ad_settings` WHERE `key`='aquadeals_helpline'");
        $ad_helpline = $helpline_qry->row('value');
        $mailcontent='<html>
                <head>
                        <meta charset="utf-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1">
                        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" /> 
                        <title>AquaDeals</title>
                        <style type="text/css">
                        .tot_pag{width: 40%;margin: 10px auto;}
                        .foter{overflow: hidden;width: 43%;margin: 10px auto;}
                        .nxt_stp li{width: 50%;margin-top: 10px;}
                        .nxt_stp li img{margin-right: 20px;margin-top: 10px;}
                        @media (max-width: 667px) {
                        .nxt_stp li{width: 100%;margin-top: 15px;}
                        .tot_pag{width: 80%;}
                        .foter{width: 83%;}
                        }
                        </style>
                </head>

                        <body style="background: #eeeeee;font-family: arial;">
                        <div style="width: 100%;text-align: center;margin: 30px 0;"> <a href="#"> 
                        <img src="http://aqua.deals/admin/assets/email_imgs/logo.png" /> </a> </div>
                        <div class="tot_pag" style="border-radius: 5px;background: #f15a25;padding: 20px;">
                        <h1 style="font-size: 16px;color: #fff;text-align: left;">Dear '.ucfirst($name).',</h1>
                        <p style="font-size: 14px;color: #fff;text-align: left;font-weight: normal;margin-top: 15px;">Your AquaCash is low. Your current Aquacash balance is  '.$amt.'.</p>
                        <p style="font-size: 14px;color: #fff;text-align: left;font-weight: normal;margin-top: 15px;"><b>
                        Your Account in Aquadeals App is  Inactivated by the AquaDeals.
                        </b></p>
                        <div style="clear: both">&nbsp;</div>
                        </div>
                        <div class="foter">
                        <h6 style="font-size: 13px;color: #666; float: right;margin: 0 0 30px 0;padding: 0;">For more details contact our customer support at '.$ad_helpline.'. </h6>
                        <div style="clear: both;"></div>
                        <div style="float: left;">
                        <h6 style="font-size: 15px;color: #333;margin: 0;">Download AquaDeals</h6>
                        <a href="https://play.google.com/store/apps/details?id=com.aquadeals.user" style="margin-top: 15px;display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/android_icon.png" /> </a>
                        </div>
                        <div style="float: right;">
                        <h6 style="font-size: 15px;color: #333;margin: 0;">Follow Us</h6>
                        <ul style="list-style: none;text-align: center;margin: 15px 0 0 0;padding: 0;">
                        <li style="float: left;"><a href="https://www.facebook.com/aquadealsstore/" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/fb_icon.png" /> </a></li>
                        <li style="float: right;"><a href="https://twitter.com/aquadealsstore" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/twitter_icon.png" /> </a></li>
                        </ul>
                        </div>
                        </div>
                </body>
                </html>';
                if($email!='')
                {
        $res = $this->send($email,$subject,$mailcontent,1);
        return $res;
         }
            else
            {
                    return 1;
            }
        
    }
    function dealCreated($dealId)
    {
        
        //echo $deal
        $CI = & get_instance();
        $deal_exe = $CI->db->query("SELECT ad_vendor_deals.*,ad_vendor_deal_options.*,ad_species.type as specie,vendors.contact_person as vname,vendors.email as email from ad_vendor_deals 
        INNER JOIN ad_vendor_deal_options on ad_vendor_deal_options.id = ad_vendor_deals.options_id 
        INNER JOIN ad_species on ad_species.id = ad_vendor_deals.species_id 
        JOIN ad_sellers as vendors on vendors.id = ad_vendor_deals.seller_id
        WHERE ad_vendor_deals.id  = $dealId AND vendors.email_flag=1");
        
        $deal = $deal_exe->result();
        if($deal_exe->num_rows()>0)
        {
            $username = $deal[0]->vname;
            $email = $deal[0]->email;
            //echo $email;exit;
            if($deal[0]->discount_price == 0)
            {
                $price = $deal[0]->price;
            }
            else
            {
                $price = $deal[0]->discount_price;
            }

            $price =  number_format($deal[0]->price,2);
            $discount = number_format($deal[0]->discount_price,2);
            $specie = $deal[0]->specie;
            $qty = $deal[0]->available_qty;
            $deal_id = $deal[0]->deal_id;
            $start = $deal[0]->start_date;
            $end = $deal[0]->end_date;
            $prebook_days = $deal[0]->pre_booking_days;
            $shipment = $deal[0]->free_shipment;
            $credit = $deal[0]->credit_facility;
            $discount1 = $deal[0]->discount_price;
            $shelpline_qry= $CI->db->query("SELECT value FROM `ad_settings` WHERE `key`='aquadeals_seller_helpline'");
                        $sad_helpline = $shelpline_qry->row('value');
$mailcontent='<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" /> 
<title>AquaDeals</title>
<style>
html, body, ul, li, img, span, p, h1, h2, h3, h4, h5, h6{padding: 0;margin: 0;}
img{max-width: 100%;}
.clr{clear:both;}
.book_dtl_one, .book_dtl_two, .book_dtl_three, .book_dtl_four{float: left;width: 25%;border-right: 1px solid #c5c5c5; padding: 20px 0px 20px 70px;}
.status_txt{background: url(images/cancel_icon.png) no-repeat;padding-bottom: 10px;padding-left: 40px;padding-top: 6px;}
.tot_pag{width: 80%;}
.foter{overflow: hidden;width: 80%;margin: 30px auto;}
.thnks_blk{width: 100%;}
/* responsive */

/*1599 to 1440 */
@media (max-width: 1599px) {}
/*1439 to 1360 */
@media (max-width: 1439px) {}
/*1359 to 1280 */
@media (max-width: 1359px) {}
/*1279 to 1152 */
@media (max-width: 1279px) {
.book_dtl{padding: 20px 30px;}
}
/*1151 to 1024 */
@media (max-width: 1151px) {}
/*1023 to 970 */
@media (max-width: 1023px) {
.book_dtl{padding: 20px 20px;}
}
/*969 to 800 */
@media (max-width: 969px) {
.book_dtl_one, .book_dtl_two, .book_dtl_three, .book_dtl_four{float: left;width: 50%;border-right: 1px solid #c5c5c5!important;
border-top:1px solid #c5c5c5!important;}
.book_dtl_one{border-top: none!important;}
.book_dtl_two{border-right: none!important;border-top: none!important;}
.book_dtl_four{border-right: none!important;}
}
/*799 to 768 */
@media (max-width: 799px) {}
/*767 to 736 */
@media (max-width: 767px) {}
/*735 to 667 */
@media (max-width: 667px) {}
/*666 to 600 */
@media (max-width: 666px) {}
/*599 to 568 */
@media (max-width: 599px) {
.tot_pag{width: 90%;}
.foter{width: 90%;}
.thnks_blk_emty{display: none;}
.thnks_blk{width: 100%;}
}
/*567 to 480  */
@media (max-width: 567px) {}
/*479 to 414  */
@media (max-width: 479px) {
.book_dtl_one, .book_dtl_two, .book_dtl_three, .book_dtl_four{width: 100%;border-top: none!important;border-right: none!important;border-bottom: 1px solid #c5c5c5!important;}
.book_dtl_four{border-top: none!important;border-right: none!important;border-bottom: none!important;}
}
/*413 to 375*/
@media (max-width: 413px) {}
/*374 to 320*/
@media (max-width: 374px) {}
</style>
</head>

<body style="background: #eeeeee;font-family: arial;">
<div class="tot_pag" style="border-radius: 5px;background: #fff;margin: 30px auto;padding: 20px;">
<div style="width: 100%;text-align: center;margin: 30px 0;"> <a href="#"> <img src="http://aqua.deals/admin/assets/email_imgs/slogo.png" /> </a> </div>
<h1 style="font-size: 15px;color: #333;text-align: left;">Dear '.$username.',</h1>
<div style="margin: 15px 0;overflow: hidden;padding: 20px 0;">
<h2 class="status_txt" style="font-size: 14px; color: #d2322d;float: left;">
Congratulations! Your deal created successfully.</h2>
</div>

<div style="position: relative;margin: 30px 0;">

<div style="position: absolute;left: 0;right: 0;top: -25px;text-align: center;z-index: 999;width: -moz-fit-content;
width: -webkit-fit-content;margin: 0 auto">
    <h1 style="font-size: 18px;color: #333;background: #fff;padding: 10px 15px;">Deal Details</h1>
    </div>
    <div style="border-top: 2px solid #303030;position: absolute;bottom: 0;width: 100%;"></div>
</div>
<div style="clear: both">&nbsp;</div>
<table border="0" cellpadding="0" cellspacing="0" style="width: 100%; background: #f6f6f6;padding: 20px;margin-top: 20px;">
    <tbody>
        <tr>
            <td>
                <table border="0" cellpadding="0" cellspacing="0" style="margin: 0px auto;" class="book_dtl_one">
                    <tbody>
                        <tr>
                            <td rowspan="2" style="width:28px;padding-right:80px"> <img style="position: relative;top: -5px;padding-right: 15px;" src="http://aqua.deals/admin/assets/email_imgs/booking_id_icon.png" /> </td>
                            <td style="font-size: 14px;font-weight: bold; color: #666;">Deal Id</td>
                        </tr>
                        <tr><td style="font-size: 15px;font-weight: normal; color: #333;">'.$deal_id.'</td></tr>
                    </tbody>
                </table>
    
                <table border="0" cellpadding="0" cellspacing="0" style="margin: 0px auto;" class="book_dtl_two">
                    <tbody>
                        <tr>
                            <td rowspan="2" style="width:28px;padding-right:80px"> <img style="position: relative;top: -5px;padding-right: 15px;" src="http://aqua.deals/admin/assets/email_imgs/booking_date_icon.png" /> </td>
                            <td style="font-size: 14px;font-weight: bold; color: #666;">Start Date</td>
                        </tr>
                        <tr><td style="font-size: 15px;font-weight: normal; color: #333;">'.$start.'</td></tr>
                    </tbody>
                </table>
    
                <table border="0" cellpadding="0" cellspacing="0" style="margin: 0px auto;" class="book_dtl_three">
                    <tbody>
                        <tr>
                            <td rowspan="2" style="width:28px;padding-right:80px"> <img style="position: relative;top: -5px;padding-right: 15px;" src="http://aqua.deals/admin/assets/email_imgs/booking_date_icon.png"  /> </td>
                            <td style="font-size: 14px;font-weight: bold; color: #666;">End Date</td>
                        </tr>
                        <tr><td style="font-size: 15px;font-weight: normal; color: #333;">'.$end.'</td></tr>
                    </tbody>
                </table>

                <table border="0" cellpadding="0" cellspacing="0" style="margin: 0px auto;border:none;" class="book_dtl_four">
                    <tbody>';
                    if($discount1 > 0)
                    {
                        $mailcontent.='<tr>
                            <td rowspan="2"> <img style="position: relative;top: -5px;padding-right: 15px;" src="http://aqua.deals/admin/assets/email_imgs/payment_icon.png" /> </td>
                            <td style="font-size: 14px;font-weight: bold; color: #666;">Deal Price</td>
                        </tr>
                        <tr><td style="font-size: 15px;font-weight: normal; color: #333;">&#8377; '.$discount.'</td></tr>';
                        }
                        else
                        {
                                $mailcontent.='<tr>
                            <td rowspan="2" style="width:28px;padding-right:80px"> <img style="position: relative;top: -5px;padding-right: 15px;" src="http://aqua.deals/admin/assets/email_imgs/payment_icon.png" /> </td>
                            <td style="font-size: 14px;font-weight: bold; color: #666;">Price</td>
                        </tr>
                        <tr><td style="font-size: 15px;font-weight: normal; color: #333;">&#8377; '.$price.'</td></tr>';
                        }
                    $mailcontent.='</tbody>
                </table>
            </td>

        </tr>
    </tbody>
</table>
<div style="clear: both">&nbsp;</div>
<table border="0" cellpadding="0" cellspacing="0" style="width: 100%; margin-top: 15px;text-align: left;">
    
    <tbody>
            <tr>
            <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">Specie</td>
            <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.ucfirst($specie).'</td>
        </tr>
        
         <tr>
            <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">Quantity</td>
            <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.$qty.'</td>
        </tr>';
        if($discount1 > 0)
                    {
                                                $mailcontent.='<tr>
                                                <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">Price</td>
                                                <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.$price.'</td>
                                                </tr>';
                    }
        if($prebook_days > 0)
        {
        $mailcontent.='<tr>
            <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">Prebooking Days</td>
            <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.$prebook_days.'</td>
        </tr>';
        }
        if($shipment==1){$shipment_msg="Available";} else{$shipment_msg=" Not Available";}
        if($credit==1){$credit_msg="Available";} else{$credit_msg=" Not Available";}
        $mailcontent.='<tr>
            <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">Free Shipment</td>
            <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.$shipment_msg.'</td>
        </tr>
        
        <tr>
            <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">Credit Facility</td>
            <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.$credit_msg.'</td>
        </tr>
    </tbody>
</table>

<div style="clear: both">&nbsp;</div>
<div style="position: relative;margin: 30px 0;">
<div style="position: absolute;left: 0;right: 0;top: -25px;text-align: center;z-index: 999;width: -moz-fit-content;
width: -webkit-fit-content;margin: 0 auto">
    
    </div>
    <div style="border-top: 2px solid #303030;position: absolute;bottom: 0;width: 100%;"></div>
</div>
<div style="clear: both">&nbsp;</div>

<table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
    <tbody>
        <tr>
            <td class="thnks_blk"><p style="font-size: 14px;color: #666; text-align: left;margin-top: 25px;font-weight: normal;">Contact AquaDeals Customer care'.$sad_helpline .'for help</p></td>
        </tr>
    </tbody>
</table>
<div style="clear: both">&nbsp;</div>
</div>
<div class="foter">
    <div style="float: left;">
        <h6 style="font-size: 15px;color: #333;margin: 0;">Download AquaDeals</h6>
                        <a href="https://play.google.com/store/apps/details?id=com.aquadeals.user" style="margin-top: 15px;display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/android_icon.png" /> </a>
                        </div>
                        <div style="float: right;">
                        <h6 style="font-size: 15px;color: #333;margin: 0;">Follow Us</h6>
                        <ul style="list-style: none;text-align: center;margin: 15px 0 0 0;padding: 0;">
                        <li style="float: left;"><a href="https://www.facebook.com/aquadealsstore/" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/fb_icon.png" /> </a></li>
                        <li style="float: right;"><a href="https://twitter.com/aquadealsstore" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/twitter_icon.png" /> </a></li>
                        </ul>
        
    </div>
</div>
</body>
</html>';
            //echo $mailcontent;exit;
            //echo $mailcontent;
            $subject  = 'Deal Created'; 
            if($email!='')
            {
            $res = $this->send($email,$subject,$mailcontent,2);
            return $res;
             }
                    else
                    {
                            return 1;
                    }
        }
        
        
    }
    
    //Credentials mail
    public function manf_credentials($name,$password,$app,$email)
    {
        if($email!='')
        {
        $to = $email;
        $subject = "Registration Information";
        $CI = & get_instance();//Get global functions
$shelpline_qry= $CI->db->query("SELECT value FROM `ad_settings` WHERE `key`='aquadeals_seller_helpline'");
$sad_helpline = $shelpline_qry->row('value');
        $mailcontent='<html>
                <head>
                        <meta charset="utf-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1">
                        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" /> 
                        <title>AquaDeals</title>
                        <style type="text/css">
                        .tot_pag{width: 40%;margin: 10px auto;}
                        .foter{overflow: hidden;width: 43%;margin: 10px auto;}
                        .nxt_stp li{width: 50%;margin-top: 10px;}
                        .nxt_stp li img{margin-right: 20px;margin-top: 10px;}
                        @media (max-width: 667px) {
                        .nxt_stp li{width: 100%;margin-top: 15px;}
                        .tot_pag{width: 80%;}
                        .foter{width: 83%;}
                        }
                        </style>
                </head>

                <body style="background: #eeeeee;font-family: arial;">
                        <div style="width: 100%;text-align: center;margin: 30px 0;"> <a href="#"> 
                        <img src="http://aqua.deals/admin/assets/email_imgs/slogo.png" /> </a> </div>
                        <div class="tot_pag" style="border-radius: 5px;background:#019cdf;padding: 20px;">
                        <h1 style="font-size: 16px;color: #fff;text-align: left;">Dear '.ucfirst($name).',</h1>
                        <p style="font-size: 14px;color: #fff;text-align: left;font-weight: normal;margin-top: 15px;">Thank You for registering with AquaDeals Seller App.</p>
                        <p style="font-size: 14px;color: #fff;text-align: left;font-weight: normal;margin-top: 15px;">Following are the login details :</p>
                        <p style="font-size: 14px;color: #fff;text-align: left;font-weight: normal;margin-top: 15px;">Mobile : '.$mobile.'</p>
                        <p style="font-size: 14px;color: #fff;text-align: left;font-weight: normal;margin-top: 15px;">Password   : '.$password.'</p>
                        <div style="clear: both">&nbsp;</div>
                        </div>
                        <div class="foter">
                        <h6 style="font-size: 13px;color: #666; float: right;margin: 0 0 30px 0;padding: 0;">Thank you for signing up! with AquaDeals. Call '.$sad_helpline.' for help. </h6>
                        <div style="clear: both;"></div>
                        <div style="float: left;">
                        <h6 style="font-size: 15px;color: #333;margin: 0;">Download AquaDeals</h6>
                        <a href="https://play.google.com/store/apps/details?id=com.aquadeals.user" style="margin-top: 15px;display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/android_icon.png" /> </a>
                        </div>
                        <div style="float: right;">
                        <h6 style="font-size: 15px;color: #333;margin: 0;">Follow Us</h6>
                        <ul style="list-style: none;text-align: center;margin: 15px 0 0 0;padding: 0;">
                        <li style="float: left;"><a href="https://www.facebook.com/aquadealsstore/" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/fb_icon.png" /> </a></li>
                        <li style="float: right;"><a href="https://twitter.com/aquadealsstore" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/twitter_icon.png" /> </a></li>
                        </ul>
                        </div>
                        </div>
                </body>
                </html>';
        
        $res = $this->send($to,$subject,$mailcontent,2);
        return $res;
         }
            else
            {
                    return 1;
            }
        
    }

    //product deal created 
    function product_dealCreated($dealId)
    {
        
        //echo $deal
        $CI = & get_instance();
        $deal_exe = $CI->db->query("SELECT ad_manuf_deals.deal_id,ad_manuf_deals.mrp as aprice,ad_manuf_deals.deal_price as dprice,dtypes.deal_type as dtype,products.title as pro_name,sellers.location as city,sellers.seller_name as mname,sellers.contact_person as cperson,sellers.email as email,catagories.category_name as cat_name,ad_manuf_deals.free_shipment,ad_manuf_deals.credit_facility FROM `ad_manuf_deals` Join ad_manuf_products as products on products.id=ad_manuf_deals.product_id JOIN ad_sellers as sellers on sellers.id = ad_manuf_deals.seller_id Join ad_deal_types as dtypes on dtypes.id = products.deal_type_id JOIN ad_deal_categories as catagories on catagories.id = products.category_id
where  ad_manuf_deals.id= $dealId and sellers.email_flag=1");
        
        $deal = $deal_exe->result();
        if($deal_exe->num_rows()>0)
        {
            $username = $deal[0]->cperson;
            $email = $deal[0]->email;
            $tot_amt = $deal[0]->aprice;
            $aprice = str_replace('.00','',money_format('%!i', $tot_amt));
            $tot_amt1 = $deal[0]->dprice;
            $dprice = str_replace('.00','',money_format('%!i', $tot_amt1));
            $type = $deal[0]->dtype;
            $title=$deal[0]->pro_name;
            $category=$deal[0]->cat_name;
            $deal_id=$deal[0]->deal_id;
                        $credit = $deal[0]->credit_facility;
                        $shipment = $deal[0]->free_shipment;
                        $prebook_days  = 0;
            $discount = $deal[0]->dprice;
                        $shelpline_qry= $CI->db->query("SELECT value FROM `ad_settings` WHERE `key`='aquadeals_seller_helpline'");
                        $sad_helpline = $shelpline_qry->row('value');
                        
$mailcontent='<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" /> 
<title>AquaDeals</title>
<style>
html, body, ul, li, img, span, p, h1, h2, h3, h4, h5, h6{padding: 0;margin: 0;}
img{max-width: 100%;}
.clr{clear:both;}
.book_dtl_one, .book_dtl_two, .book_dtl_three, .book_dtl_four{float: left;width: 25%;border-right: 1px solid #c5c5c5; padding: 20px 0px 20px 70px;}
.status_txt{background: url(images/cancel_icon.png) no-repeat;padding-bottom: 10px;padding-left: 40px;padding-top: 6px;}
.tot_pag{width: 80%;}
.foter{overflow: hidden;width: 80%;margin: 30px auto;}
.thnks_blk{width: 100%;}
/* responsive */

/*1599 to 1440 */
@media (max-width: 1599px) {}
/*1439 to 1360 */
@media (max-width: 1439px) {}
/*1359 to 1280 */
@media (max-width: 1359px) {}
/*1279 to 1152 */
@media (max-width: 1279px) {
.book_dtl{padding: 20px 30px;}
}
/*1151 to 1024 */
@media (max-width: 1151px) {}
/*1023 to 970 */
@media (max-width: 1023px) {
.book_dtl{padding: 20px 20px;}
}
/*969 to 800 */
@media (max-width: 969px) {
.book_dtl_one, .book_dtl_two, .book_dtl_three, .book_dtl_four{float: left;width: 50%;border-right: 1px solid #c5c5c5!important;
border-top:1px solid #c5c5c5!important;}
.book_dtl_one{border-top: none!important;}
.book_dtl_two{border-right: none!important;border-top: none!important;}
.book_dtl_four{border-right: none!important;}
}
/*799 to 768 */
@media (max-width: 799px) {}
/*767 to 736 */
@media (max-width: 767px) {}
/*735 to 667 */
@media (max-width: 667px) {}
/*666 to 600 */
@media (max-width: 666px) {}
/*599 to 568 */
@media (max-width: 599px) {
.tot_pag{width: 90%;}
.foter{width: 90%;}
.thnks_blk_emty{display: none;}
.thnks_blk{width: 100%;}
}
/*567 to 480  */
@media (max-width: 567px) {}
/*479 to 414  */
@media (max-width: 479px) {
.book_dtl_one, .book_dtl_two, .book_dtl_three, .book_dtl_four{width: 100%;border-top: none!important;border-right: none!important;border-bottom: 1px solid #c5c5c5!important;}
.book_dtl_four{border-top: none!important;border-right: none!important;border-bottom: none!important;}
}
/*413 to 375*/
@media (max-width: 413px) {}
/*374 to 320*/
@media (max-width: 374px) {}
</style>
</head>

<body style="background: #eeeeee;font-family: arial;">
<div class="tot_pag" style="border-radius: 5px;background: #fff;margin: 30px auto;padding: 20px;">
<div style="width: 100%;text-align: center;margin: 30px 0;"> <a href="#"> <img src="http://aqua.deals/admin/assets/email_imgs/slogo.png" /> </a> </div>
<h1 style="font-size: 15px;color: #333;text-align: left;">Dear '.$username.',</h1>
<div style="margin: 15px 0;overflow: hidden;padding: 20px 0;">
<h2 class="status_txt" style="font-size: 14px; color: #d2322d;float: left;">
Congratulations! Your deal created successfully.</h2>
</div>

<div style="position: relative;margin: 30px 0;">

<div style="position: absolute;left: 0;right: 0;top: -25px;text-align: center;z-index: 999;width: -moz-fit-content;
width: -webkit-fit-content;margin: 0 auto">
    <h1 style="font-size: 18px;color: #333;background: #fff;padding: 10px 15px;">Deal Details</h1>
    </div>
    <div style="border-top: 2px solid #303030;position: absolute;bottom: 0;width: 100%;"></div>
</div>
<div style="clear: both">&nbsp;</div>

<div style="clear: both">&nbsp;</div>
<table border="0" cellpadding="0" cellspacing="0" style="width: 100%; margin-top: 15px;text-align: left;">
    
    <tbody>
            <tr>
            <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">Product Name</td>
            <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.ucfirst($title).'</td>
        </tr>';
        if($discount > 0)
            {
                                $mailcontent.=' <tr>
                                <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">Deal Price</td>
                                <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.$dprice.'</td>
                                </tr>

                                <tr>
                                <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">Mrp</td>
                                <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.$aprice.'</td>
                                </tr>';
            }
            else
            {
             $mailcontent.=' <tr>
                                <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">Mrp</td>
                                <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.$aprice.'</td>
                                </tr>';
            }
        if($prebook_days > 0)
        {
        $mailcontent.='<tr>
            <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">Prebooking Days</td>
            <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">&#8377; 1400</td>
        </tr>';
        }
        if($shipment==1){$shipment_msg="Available";} else{$shipment_msg=" Not Available";}
        if($credit==1){$credit_msg="Available";} else{$credit_msg=" Not Available";}
        $mailcontent.='
        <tr>
            <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">Deal Type</td>
            <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.$type.'</td>
        </tr>
        <tr>
            <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">Category</td>
            <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.$category.'</td>
        </tr>
        <tr>
            <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">Free Shipment</td>
            <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.$shipment_msg.'</td>
        </tr>
        
        <tr>
            <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">Credit Facility</td>
            <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.$credit_msg.'</td>
        </tr>
    </tbody>
</table>

<div style="clear: both">&nbsp;</div>
<div style="position: relative;margin: 30px 0;">
<div style="position: absolute;left: 0;right: 0;top: -25px;text-align: center;z-index: 999;width: -moz-fit-content;
width: -webkit-fit-content;margin: 0 auto">
    
    </div>
    <div style="border-top: 2px solid #303030;position: absolute;bottom: 0;width: 100%;"></div>
</div>
<div style="clear: both">&nbsp;</div>

<table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
    <tbody>
        <tr>
            <td class="thnks_blk"><p style="font-size: 14px;color: #666; text-align: left;margin-top: 25px;font-weight: normal;">Contact AquaDeals Customer care '.$sad_helpline.' for help</p></td>
        </tr>
    </tbody>
</table>
<div style="clear: both">&nbsp;</div>
</div>
<div class="foter">
    <div style="float: left;">
        <h6 style="font-size: 15px;color: #333;margin: 0;">Download AquaDeals</h6>
                        <a href="https://play.google.com/store/apps/details?id=com.aquadeals.user" style="margin-top: 15px;display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/android_icon.png" /> </a>
                        </div>
                        <div style="float: right;">
                        <h6 style="font-size: 15px;color: #333;margin: 0;">Follow Us</h6>
                        <ul style="list-style: none;text-align: center;margin: 15px 0 0 0;padding: 0;">
                        <li style="float: left;"><a href="https://www.facebook.com/aquadealsstore/" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/fb_icon.png" /> </a></li>
                        <li style="float: right;"><a href="https://twitter.com/aquadealsstore" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/twitter_icon.png" /> </a></li>
                        </ul>
        
    </div>
</div>
</body>
</html>';
                        
                        //echo $mailcontent;exit;
            $subject  = 'Deal Created for Your Product'; 
            if($email!='')
            {
            $res = $this->send($email,$subject,$mailcontent,2);
            return $res;
             }
                    else
                    {
                            return 1;
                    }
        }
        //print_r($res);
        
        
    }
    
    
    
    //Sending sms when seed deal is deleted
    public function seed_deal_delete($id)
    {
            $CI = & get_instance();
            $deal_exe = $CI->db->query("SELECT ad_vendor_deals.*,ad_vendor_deal_options.*,ad_species.type as specie,vendors.contact_person as vname,vendors.email as email from ad_vendor_deals 
INNER JOIN ad_vendor_deal_options on ad_vendor_deal_options.id = ad_vendor_deals.options_id 
INNER JOIN ad_species on ad_species.id = ad_vendor_deals.species_id 
JOIN ad_sellers as vendors on vendors.id = ad_vendor_deals.seller_id
WHERE ad_vendor_deals.id  = $id and vendors.email_flag=1");
        
        $deal = $deal_exe->result();
        if($deal_exe->num_rows()>0)
        {
            $username = $deal[0]->vname;
            $email = $deal[0]->email;
            //echo $email;exit;
            if($deal[0]->discount_price == 0)
            {
                $price = $deal[0]->price;
            }
            else
            {
                $price = $deal[0]->discount_price;
            }
            $specie = $deal[0]->specie;
            $qty = $deal[0]->available_qty;
            $deal_id = $deal[0]->deal_id;
            $start = $deal[0]->start_date;
            $end = $deal[0]->end_date;
            $prebook_days = $deal[0]->pre_booking_days;
            $shipment = $deal[0]->free_shipment;
            $credit = $deal[0]->credit_facility;
            $discount = $deal[0]->discount_price;
            $shelpline_qry= $CI->db->query("SELECT value FROM `ad_settings` WHERE `key`='aquadeals_seller_helpline'");
                        $sad_helpline = $shelpline_qry->row('value');
$mailcontent='<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" /> 
<title>AquaDeals</title>
<style>
html, body, ul, li, img, span, p, h1, h2, h3, h4, h5, h6{padding: 0;margin: 0;}
img{max-width: 100%;}
.clr{clear:both;}
.book_dtl_one, .book_dtl_two, .book_dtl_three, .book_dtl_four{float: left;width: 25%;border-right: 1px solid #c5c5c5; padding: 20px 0px 20px 70px;}
.status_txt{background: url(images/cancel_icon.png) no-repeat;padding-bottom: 10px;padding-left: 40px;padding-top: 6px;}
.tot_pag{width: 80%;}
.foter{overflow: hidden;width: 80%;margin: 30px auto;}
.thnks_blk{width: 100%;}
/* responsive */

/*1599 to 1440 */
@media (max-width: 1599px) {}
/*1439 to 1360 */
@media (max-width: 1439px) {}
/*1359 to 1280 */
@media (max-width: 1359px) {}
/*1279 to 1152 */
@media (max-width: 1279px) {
.book_dtl{padding: 20px 30px;}
}
/*1151 to 1024 */
@media (max-width: 1151px) {}
/*1023 to 970 */
@media (max-width: 1023px) {
.book_dtl{padding: 20px 20px;}
}
/*969 to 800 */
@media (max-width: 969px) {
.book_dtl_one, .book_dtl_two, .book_dtl_three, .book_dtl_four{float: left;width: 50%;border-right: 1px solid #c5c5c5!important;
border-top:1px solid #c5c5c5!important;}
.book_dtl_one{border-top: none!important;}
.book_dtl_two{border-right: none!important;border-top: none!important;}
.book_dtl_four{border-right: none!important;}
}
/*799 to 768 */
@media (max-width: 799px) {}
/*767 to 736 */
@media (max-width: 767px) {}
/*735 to 667 */
@media (max-width: 667px) {}
/*666 to 600 */
@media (max-width: 666px) {}
/*599 to 568 */
@media (max-width: 599px) {
.tot_pag{width: 90%;}
.foter{width: 90%;}
.thnks_blk_emty{display: none;}
.thnks_blk{width: 100%;}
}
/*567 to 480  */
@media (max-width: 567px) {}
/*479 to 414  */
@media (max-width: 479px) {
.book_dtl_one, .book_dtl_two, .book_dtl_three, .book_dtl_four{width: 100%;border-top: none!important;border-right: none!important;border-bottom: 1px solid #c5c5c5!important;}
.book_dtl_four{border-top: none!important;border-right: none!important;border-bottom: none!important;}
}
/*413 to 375*/
@media (max-width: 413px) {}
/*374 to 320*/
@media (max-width: 374px) {}
</style>
</head>

<body style="background: #eeeeee;font-family: arial;">
<div class="tot_pag" style="border-radius: 5px;background: #fff;margin: 30px auto;padding: 20px;">
<div style="width: 100%;text-align: center;margin: 30px 0;"> <a href="#"> <img src="http://aqua.deals/admin/assets/email_imgs/slogo.png" /> </a> </div>
<h1 style="font-size: 15px;color: #333;text-align: left;">Dear '.$username.',</h1>
<div style="margin: 15px 0;overflow: hidden;padding: 20px 0;">
<h2 class="status_txt" style="font-size: 14px; color: #d2322d;float: left;">
Your deal '.$deal_id.' is deleted successfully.</h2>
</div>

<div style="position: relative;margin: 30px 0;">

<div style="position: absolute;left: 0;right: 0;top: -25px;text-align: center;z-index: 999;width: -moz-fit-content;
width: -webkit-fit-content;margin: 0 auto">
    <h1 style="font-size: 18px;color: #333;background: #fff;padding: 10px 15px;">Deal Details</h1>
    </div>
    <div style="border-top: 2px solid #303030;position: absolute;bottom: 0;width: 100%;"></div>
</div>
<div style="clear: both">&nbsp;</div>
<table border="0" cellpadding="0" cellspacing="0" style="width: 100%; background: #f6f6f6;padding: 20px;margin-top: 20px;">
    <tbody>
        <tr>
            <td>
                <table border="0" cellpadding="0" cellspacing="0" style="margin: 0px auto;" class="book_dtl_one">
                    <tbody>
                        <tr>
                            <td rowspan="2" style="width:28px;padding-right:80px"> <img style="position: relative;top: -5px;padding-right: 15px;" src="http://aqua.deals/admin/assets/email_imgs/booking_id_icon.png" /> </td>
                            <td style="font-size: 14px;font-weight: bold; color: #666;">Deal Id</td>
                        </tr>
                        <tr><td style="font-size: 15px;font-weight: normal; color: #333;">'.$deal_id.'</td></tr>
                    </tbody>
                </table>
    
                <table border="0" cellpadding="0" cellspacing="0" style="margin: 0px auto;" class="book_dtl_two">
                    <tbody>
                        <tr>
                            <td rowspan="2" style="width:28px;padding-right:80px"> <img style="position: relative;top: -5px;padding-right: 15px;" src="http://aqua.deals/admin/assets/email_imgs/booking_date_icon.png" /> </td>
                            <td style="font-size: 14px;font-weight: bold; color: #666;">Start Date</td>
                        </tr>
                        <tr><td style="font-size: 15px;font-weight: normal; color: #333;">'.$start.'</td></tr>
                    </tbody>
                </table>
    
                <table border="0" cellpadding="0" cellspacing="0" style="margin: 0px auto;" class="book_dtl_three">
                    <tbody>
                        <tr>
                            <td rowspan="2" style="width:28px;padding-right:80px"> <img style="position: relative;top: -5px;padding-right: 15px;" src="http://aqua.deals/admin/assets/email_imgs/booking_date_icon.png"  /> </td>
                            <td style="font-size: 14px;font-weight: bold; color: #666;">End Date</td>
                        </tr>
                        <tr><td style="font-size: 15px;font-weight: normal; color: #333;">'.$end.'</td></tr>
                    </tbody>
                </table>

                <table border="0" cellpadding="0" cellspacing="0" style="margin: 0px auto;border:none;" class="book_dtl_four">
                    <tbody>';
                    if($discount > 0)
                    {
                        $mailcontent.='<tr>
                            <td rowspan="2" style="width:28px;padding-right:80px"> <img style="position: relative;top: -5px;padding-right: 15px;" src="http://aqua.deals/admin/assets/email_imgs/payment_icon.png" /> </td>
                            <td style="font-size: 14px;font-weight: bold; color: #666;">Deal Price</td>
                        </tr>
                        <tr><td style="font-size: 15px;font-weight: normal; color: #333;">&#8377; '.$discount.'</td></tr>';
                        }
                        else
                        {
                                $mailcontent.='<tr>
                            <td rowspan="2" style="width:28px;padding-right:80px"> <img style="position: relative;top: -5px;padding-right: 15px;" src="http://aqua.deals/admin/assets/email_imgs/payment_icon.png" /> </td>
                            <td style="font-size: 14px;font-weight: bold; color: #666;">Price</td>
                        </tr>
                        <tr><td style="font-size: 15px;font-weight: normal; color: #333;">&#8377; '.$price.'</td></tr>';
                        }
                    $mailcontent.='</tbody>
                </table>
            </td>

        </tr>
    </tbody>
</table>
<div style="clear: both">&nbsp;</div>
<table border="0" cellpadding="0" cellspacing="0" style="width: 100%; margin-top: 15px;text-align: left;">
    
    <tbody>
            <tr>
            <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">Specie</td>
            <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.ucfirst($specie).'</td>
        </tr>
        
         <tr>
            <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">Quantity</td>
            <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.$qty.'</td>
        </tr>';
        if($discount > 0)
                    {
                                                $mailcontent.='<tr>
                                                <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">Price</td>
                                                <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.$price.'</td>
                                                </tr>';
                    }
        if($prebook_days > 0)
        {
        $mailcontent.='<tr>
            <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">Prebooking Days</td>
            <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.$prebook_days.'</td>
        </tr>';
        }
        if($shipment==1){$shipment_msg="Available";} else{$shipment_msg=" Not Available";}
        if($credit==1){$credit_msg="Available";} else{$credit_msg=" Not Available";}
        $mailcontent.='<tr>
            <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">Free Shipment</td>
            <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.$shipment_msg.'</td>
        </tr>
        
        <tr>
            <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">Credit Facility</td>
            <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.$credit_msg.'</td>
        </tr>
    </tbody>
</table>

<div style="clear: both">&nbsp;</div>
<div style="position: relative;margin: 30px 0;">
<div style="position: absolute;left: 0;right: 0;top: -25px;text-align: center;z-index: 999;width: -moz-fit-content;
width: -webkit-fit-content;margin: 0 auto">
    
    </div>
    <div style="border-top: 2px solid #303030;position: absolute;bottom: 0;width: 100%;"></div>
</div>
<div style="clear: both">&nbsp;</div>

<table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
    <tbody>
        <tr>
            <td class="thnks_blk"><p style="font-size: 14px;color: #666; text-align: left;margin-top: 25px;font-weight: normal;">Contact AquaDeals Customer care '.$sad_helpline.' for help</p></td>
        </tr>
    </tbody>
</table>
<div style="clear: both">&nbsp;</div>
</div>
<div class="foter">
    <div style="float: left;">
        <h6 style="font-size: 15px;color: #333;margin: 0;">Download AquaDeals</h6>
                        <a href="https://play.google.com/store/apps/details?id=com.aquadeals.user" style="margin-top: 15px;display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/android_icon.png" /> </a>
                        </div>
                        <div style="float: right;">
                        <h6 style="font-size: 15px;color: #333;margin: 0;">Follow Us</h6>
                        <ul style="list-style: none;text-align: center;margin: 15px 0 0 0;padding: 0;">
                        <li style="float: left;"><a href="https://www.facebook.com/aquadealsstore/" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/fb_icon.png" /> </a></li>
                        <li style="float: right;"><a href="https://twitter.com/aquadealsstore" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/twitter_icon.png" /> </a></li>
                        </ul>
        
    </div>
</div>
</body>
</html>';
            $subject = "Deal deleted";
            if($email!='')
            {
            $res = $this->send($email,$subject,$mailcontent,2);
             }
                    else
                    {
                            return 1;
                    }
        }
        //return $res;
    }
    //Sending sms when product deal is deleted
    public function product_deal_delete($id)
    {
            $CI = & get_instance();
            
        $deal_exe = $CI->db->query("SELECT ad_manuf_deals.deal_id,ad_manuf_deals.mrp as aprice,ad_manuf_deals.deal_price as dprice,dtypes.deal_type as dtype,products.title as pro_name,manufactures.location as city,manufactures.seller_name as mname,manufactures.contact_person as cperson,manufactures.email as email,catagories.category_name as cat_name,ad_manuf_deals.credit_facility,ad_manuf_deals.free_shipment FROM `ad_manuf_deals` left Join ad_manuf_products as products on products.id=ad_manuf_deals.product_id left JOIN ad_sellers as manufactures on manufactures.id = ad_manuf_deals.seller_id left Join ad_deal_types as dtypes on dtypes.id = products.deal_type_id left JOIN ad_deal_categories as catagories on catagories.id = products.category_id 
where  ad_manuf_deals.id= $id and manufactures.email_flag=1");
        
        $deal = $deal_exe->result();
        if($deal_exe->num_rows()>0)
        {
            $username = $deal[0]->mname;
            $email = $deal[0]->email;
            $tot_amt = $deal[0]->aprice;
            $aprice = str_replace('.00','',money_format('%!i', $tot_amt));
            $tot_amt1 = $deal[0]->dprice;
            $dprice = str_replace('.00','',money_format('%!i', $tot_amt1));
            $discount = $deal[0]->dprice;
            $type = $deal[0]->dtype;
            $title=$deal[0]->pro_name;
            $deal_id=$deal[0]->deal_id;
            $category=$deal[0]->cat_name;
            $credit = $deal[0]->credit_facility;
                        $shipment = $deal[0]->free_shipment;
                        $discount = $deal[0]->dprice;
            $shelpline_qry= $CI->db->query("SELECT value FROM `ad_settings` WHERE `key`='aquadeals_seller_helpline'");
                        $sad_helpline = $shelpline_qry->row('value');
                        
                        
$mailcontent='<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" /> 
<title>AquaDeals</title>
<style>
html, body, ul, li, img, span, p, h1, h2, h3, h4, h5, h6{padding: 0;margin: 0;}
img{max-width: 100%;}
.clr{clear:both;}
.book_dtl_one, .book_dtl_two, .book_dtl_three, .book_dtl_four{float: left;width: 25%;border-right: 1px solid #c5c5c5; padding: 20px 0px 20px 70px;}
.status_txt{background: url(images/cancel_icon.png) no-repeat;padding-bottom: 10px;padding-left: 40px;padding-top: 6px;}
.tot_pag{width: 80%;}
.foter{overflow: hidden;width: 80%;margin: 30px auto;}
.thnks_blk{width: 100%;}
/* responsive */

/*1599 to 1440 */
@media (max-width: 1599px) {}
/*1439 to 1360 */
@media (max-width: 1439px) {}
/*1359 to 1280 */
@media (max-width: 1359px) {}
/*1279 to 1152 */
@media (max-width: 1279px) {
.book_dtl{padding: 20px 30px;}
}
/*1151 to 1024 */
@media (max-width: 1151px) {}
/*1023 to 970 */
@media (max-width: 1023px) {
.book_dtl{padding: 20px 20px;}
}
/*969 to 800 */
@media (max-width: 969px) {
.book_dtl_one, .book_dtl_two, .book_dtl_three, .book_dtl_four{float: left;width: 50%;border-right: 1px solid #c5c5c5!important;
border-top:1px solid #c5c5c5!important;}
.book_dtl_one{border-top: none!important;}
.book_dtl_two{border-right: none!important;border-top: none!important;}
.book_dtl_four{border-right: none!important;}
}
/*799 to 768 */
@media (max-width: 799px) {}
/*767 to 736 */
@media (max-width: 767px) {}
/*735 to 667 */
@media (max-width: 667px) {}
/*666 to 600 */
@media (max-width: 666px) {}
/*599 to 568 */
@media (max-width: 599px) {
.tot_pag{width: 90%;}
.foter{width: 90%;}
.thnks_blk_emty{display: none;}
.thnks_blk{width: 100%;}
}
/*567 to 480  */
@media (max-width: 567px) {}
/*479 to 414  */
@media (max-width: 479px) {
.book_dtl_one, .book_dtl_two, .book_dtl_three, .book_dtl_four{width: 100%;border-top: none!important;border-right: none!important;border-bottom: 1px solid #c5c5c5!important;}
.book_dtl_four{border-top: none!important;border-right: none!important;border-bottom: none!important;}
}
/*413 to 375*/
@media (max-width: 413px) {}
/*374 to 320*/
@media (max-width: 374px) {}
</style>
</head>

<body style="background: #eeeeee;font-family: arial;">
<div class="tot_pag" style="border-radius: 5px;background: #fff;margin: 30px auto;padding: 20px;">
<div style="width: 100%;text-align: center;margin: 30px 0;"> <a href="#"> <img src="http://aqua.deals/admin/assets/email_imgs/slogo.png" /> </a> </div>
<h1 style="font-size: 15px;color: #333;text-align: left;">Dear '.$username.',</h1>
<div style="margin: 15px 0;overflow: hidden;padding: 20px 0;">
<h2 class="status_txt" style="font-size: 14px; color: #d2322d;float: left;">
Your deal '.$deal_id.' is deleted successfully.</h2>
</div>

<div style="position: relative;margin: 30px 0;">

<div style="position: absolute;left: 0;right: 0;top: -25px;text-align: center;z-index: 999;width: -moz-fit-content;
width: -webkit-fit-content;margin: 0 auto">
    <h1 style="font-size: 18px;color: #333;background: #fff;padding: 10px 15px;">Deal Details</h1>
    </div>
    <div style="border-top: 2px solid #303030;position: absolute;bottom: 0;width: 100%;"></div>
</div>
<div style="clear: both">&nbsp;</div>

<div style="clear: both">&nbsp;</div>
<table border="0" cellpadding="0" cellspacing="0" style="width: 100%; margin-top: 15px;text-align: left;">
    
    <tbody>
            <tr>
            <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">Product Name</td>
            <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.ucfirst($title).'</td>
        </tr>';
        if($discount > 0)
            {
                                $mailcontent.=' <tr>
                                <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">Deal Price</td>
                                <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.$dprice.'</td>
                                </tr>

                                <tr>
                                <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">Mrp</td>
                                <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.$aprice.'</td>
                                </tr>';
            }
            else
            {
             $mailcontent.=' <tr>
                                <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">Mrp</td>
                                <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.$aprice.'</td>
                                </tr>';
            }
        
        if($shipment==1){$shipment_msg="Available";} else{$shipment_msg=" Not Available";}
        if($credit==1){$credit_msg="Available";} else{$credit_msg=" Not Available";}
        $mailcontent.='
        <tr>
            <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">Deal Type</td>
            <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.$type.'</td>
        </tr>
        <tr>
            <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">Category</td>
            <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.$category.'</td>
        </tr>
        <tr>
            <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">Free Shipment</td>
            <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.$shipment_msg.'</td>
        </tr>
        
        <tr>
            <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">Credit Facility</td>
            <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.$credit_msg.'</td>
        </tr>
    </tbody>
</table>

<div style="clear: both">&nbsp;</div>
<div style="position: relative;margin: 30px 0;">
<div style="position: absolute;left: 0;right: 0;top: -25px;text-align: center;z-index: 999;width: -moz-fit-content;
width: -webkit-fit-content;margin: 0 auto">
    
    </div>
    <div style="border-top: 2px solid #303030;position: absolute;bottom: 0;width: 100%;"></div>
</div>
<div style="clear: both">&nbsp;</div>

<table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
    <tbody>
        <tr>
            <td class="thnks_blk"><p style="font-size: 14px;color: #666; text-align: left;margin-top: 25px;font-weight: normal;">Contact AquaDeals Customer care '.$sad_helpline.' for help</p></td>
        </tr>
    </tbody>
</table>
<div style="clear: both">&nbsp;</div>
</div>
<div class="foter">
    <div style="float: left;">
        <h6 style="font-size: 15px;color: #333;margin: 0;">Download AquaDeals</h6>
                        <a href="https://play.google.com/store/apps/details?id=com.aquadeals.user" style="margin-top: 15px;display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/android_icon.png" /> </a>
                        </div>
                        <div style="float: right;">
                        <h6 style="font-size: 15px;color: #333;margin: 0;">Follow Us</h6>
                        <ul style="list-style: none;text-align: center;margin: 15px 0 0 0;padding: 0;">
                        <li style="float: left;"><a href="https://www.facebook.com/aquadealsstore/" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/fb_icon.png" /> </a></li>
                        <li style="float: right;"><a href="https://twitter.com/aquadealsstore" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/twitter_icon.png" /> </a></li>
                        </ul>
        
    </div>
</div>
</body>
</html>';
            $subject = "Deal deleted";
            if($email!='')
            {
                    $res = $this->send($email,$subject,$mailcontent,2);
                    return $res;
             }
                    else
                    {
                            return 1;
                    }
        }
    }
    //manufacturer approval email
    public function manuf_appr($name,$email,$mname)
    {
        if($email!='')
        {
        $to = $email;
        $subject = "Account approved";
        $CI = & get_instance();//Get global functions
$shelpline_qry= $CI->db->query("SELECT value FROM `ad_settings` WHERE `key`='aquadeals_seller_helpline'");
$sad_helpline = $shelpline_qry->row('value');
        $mailcontent='<html>
                <head>
                        <meta charset="utf-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1">
                        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" /> 
                        <title>AquaDeals</title>
                        <style type="text/css">
                        .tot_pag{width: 40%;margin: 10px auto;}
                        .foter{overflow: hidden;width: 43%;margin: 10px auto;}
                        .nxt_stp li{width: 50%;margin-top: 10px;}
                        .nxt_stp li img{margin-right: 20px;margin-top: 10px;}
                        @media (max-width: 667px) {
                        .nxt_stp li{width: 100%;margin-top: 15px;}
                        .tot_pag{width: 80%;}
                        .foter{width: 83%;}
                        }
                        </style>
                </head>

                        <body style="background: #eeeeee;font-family: arial;">
                        <div style="width: 100%;text-align: center;margin: 30px 0;"> <a href="#"> 
                        <img src="http://aqua.deals/admin/assets/email_imgs/slogo.png" /> </a> </div>
                        <div class="tot_pag" style="border-radius: 5px;background: #019cdf;padding: 20px;">
                        <h1 style="font-size: 16px;color: #fff;text-align: left;">Dear '.$name.',</h1>
                        <p style="font-size: 14px;color: #fff;text-align: left;font-weight: normal;margin-top: 15px;">Congratulations! </p>
                         <p style="font-size: 14px;color: #fff;text-align: left;font-weight: normal;margin-top: 15px;">Your <b>'.$mname.'</b> account is approved.</p>
                       <p style="font-size: 14px;color: #fff;text-align: left;font-weight: normal;margin-top: 15px;">Now you can start posting your deals.</p>
                        <div style="clear: both">&nbsp;</div>
                        </div>
                        <div class="foter">
                        <h6 style="font-size: 13px;color: #666; float: right;margin: 0 0 30px 0;padding: 0;">Thank you for signing up! with AquaDeals. Call '.$sad_helpline.' for help. </h6>
                        <div style="clear: both;"></div>
                        <div style="float: left;">
                        <h6 style="font-size: 15px;color: #333;margin: 0;">Download AquaDeals</h6>
                        <a href="https://play.google.com/store/apps/details?id=com.aquadeals.user" style="margin-top: 15px;display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/android_icon.png" /> </a>
                        </div>
                        <div style="float: right;">
                        <h6 style="font-size: 15px;color: #333;margin: 0;">Follow Us</h6>
                        <ul style="list-style: none;text-align: center;margin: 15px 0 0 0;padding: 0;">
                        <li style="float: left;"><a href="https://www.facebook.com/aquadealsstore/" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/fb_icon.png" /> </a></li>
                        <li style="float: right;"><a href="https://twitter.com/aquadealsstore" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/twitter_icon.png" /> </a></li>
                        </ul>
                        </div>
                        </div>
                </body>
                </html>';
        
        $res = $this->send($to,$subject,$mailcontent,2);
        return $res;
         }
            else
            {
                    return 1;
            }
    }
    
    
    
    /*********************Global functions start********************/

    //Get db values
    function getValue($table,$field,$action,$value)
        { 
            
                    $CI = & get_instance();
                    $query = $CI->db->query("SELECT ".$field." FROM ".$table." WHERE ".$action." ='".$value."'");
                    return $query->row($field);
            
        }
        
        //Get db values
    function getcanValue($table,$field,$action,$value,$value2)
        { 
            
                    $CI = & get_instance();
                    $query = $CI->db->query("SELECT ".$field." FROM ".$table." WHERE ".$action." ='".$value."' and booking_type=$value2");
                    return $query->row($field);
            
        }
        //get pcr value
        function getPcr($str)
        {
         if($str=='')
         {
                return "N/A";
         }
         else
         {
                $CI = & get_instance();
                $query = $CI->db->query("SELECT * FROM `ad_pcr_test_diseases` WHERE id IN(".$str.")");
                foreach($query->result() as $row)
                {
                        $arry[]=$row->tests;
                }
                $comma_separated = implode(",", $arry);
                return $comma_separated;
                    
         }
        }
        //Get db values
    function getdealOptions($table,$field,$action,$value)
        { 
            if( $value==0 || $value==null || $value=='')
            {
                    return "N/A";
            }
            else if(!is_numeric($value))
                {
                        return $value;
                }
            else
            {
                    $CI = & get_instance();
                    $query = $CI->db->query("SELECT ".$field." FROM ".$table." WHERE ".$action." ='".$value."'");
                    return $query->row($field);
            }
        }
        
    function test()
    {
        $this->send('sankar.nyros@gmail.com','Hai','Test',1);
    }    
    
    //sending notification when deal is promoted
        function deal_promo($type,$dealid,$start1,$end1)
        {
                $CI = & get_instance();
                //Promoted seed deal
                if($type==0)
                {
                        $deal_exe = $CI->db->query("SELECT ad_vendor_deals.*,ad_vendor_deal_options.*,ad_species.type as specie,vendors.contact_person as vname,vendors.email as email,vendors.email_flag from ad_vendor_deals 
                        INNER JOIN ad_vendor_deal_options on ad_vendor_deal_options.id = ad_vendor_deals.options_id 
                        INNER JOIN ad_species on ad_species.id = ad_vendor_deals.species_id 
                        JOIN ad_sellers as vendors on vendors.id = ad_vendor_deals.seller_id
                        WHERE ad_vendor_deals.id  = $dealid");

                        $deal = $deal_exe->result();

                        $username = $deal[0]->vname;
                        $email = $deal[0]->email;
                        $email_flag = $deal[0]->email_flag;
                        //echo $email;exit;
                        if($deal[0]->discount_price == 0)
                        {
                                $price = $deal[0]->price;
                        }
                        else
                        {
                                $price = $deal[0]->discount_price;
                        }

                        $price =  number_format($deal[0]->price,2);
                        $discount = number_format($deal[0]->discount_price,2);
                        $specie = $deal[0]->specie;
                        $qty = $deal[0]->available_qty;
                        $deal_id = $deal[0]->deal_id;
                        $start = $deal[0]->start_date;
                        $end = $deal[0]->end_date;
                        $prebook_days = $deal[0]->pre_booking_days;

                        $mailcontent = $this->getValue('ad_mails','content','action','Seed Deal Promo Created');
                        $mailcontent = str_replace("&amp;username&amp;",$username,$mailcontent);
                        $mailcontent = str_replace("&amp;dealid&amp;",$deal_id,$mailcontent);
                        $mailcontent = str_replace("&amp;specie&amp;",$specie,$mailcontent);
                        $mailcontent = str_replace("&amp;rate&amp;",$price,$mailcontent);
                        $mailcontent = str_replace("&amp;drate&amp;",$discount,$mailcontent);
                        $mailcontent = str_replace("&amp;qty&amp;",$qty,$mailcontent);
                        $mailcontent = str_replace("&amp;sdate&amp;",$start,$mailcontent);
                        $mailcontent = str_replace("&amp;edate&amp;",$end,$mailcontent);
                        $mailcontent = str_replace("&amp;days&amp;",$prebook_days,$mailcontent);
                        $mailcontent = str_replace("&amp;end_date&amp;",$end1,$mailcontent);
                        $mailcontent = str_replace("&amp;start_date&amp;",$start1,$mailcontent);

                       
                }
                //Promoted product deal
                if($type==1)
                {
                        //echo $deal
                        $deal_exe = $CI->db->query("SELECT ad_manuf_deals.mrp as aprice,ad_manuf_deals.deal_price as dprice,dtypes.deal_type as dtype,products.title as pro_name,sellers.location as city,sellers.seller_name as mname,sellers.contact_person as cperson,sellers.email_flag,sellers.email as email,catagories.category_name as cat_name FROM `ad_manuf_deals` Join ad_manuf_products as products on products.id=ad_manuf_deals.product_id JOIN ad_sellers as sellers on sellers.id = ad_manuf_deals.seller_id Join ad_deal_types as dtypes on dtypes.id = products.deal_type_id JOIN ad_deal_categories as catagories on catagories.id = products.category_id
                        where  ad_manuf_deals.id= $dealid");

                        $deal = $deal_exe->result();
                        $username = $deal[0]->cperson;
                        $email = $deal[0]->email;
                        $email_flag = $deal[0]->email_flag;
                        $tot_amt = $deal[0]->aprice;
                        $aprice = str_replace('.00','',money_format('%!i', $tot_amt));
                        $tot_amt1 = $deal[0]->dprice;
                        $dprice = str_replace('.00','',money_format('%!i', $tot_amt1));
                        $type = $deal[0]->dtype;
                        $title=$deal[0]->pro_name;
                        $category=$deal[0]->cat_name;

                        $mailcontent = $this->getValue('ad_mails','content','action','Product Deal Promo Created');
                        $mailcontent = str_replace("&amp;username&amp;",$username,$mailcontent);
                        $mailcontent = str_replace("&amp;title&amp;",$title,$mailcontent);
                        $mailcontent = str_replace("&amp;aprice&amp;",$aprice,$mailcontent);
                        $mailcontent = str_replace("&amp;dprice&amp;",$dprice,$mailcontent);
                        $mailcontent = str_replace("&amp;type&amp;",$type,$mailcontent);
                        $mailcontent = str_replace("&amp;category&amp;",$category,$mailcontent);
                        $mailcontent = str_replace("&amp;end_date&amp;",$end1,$mailcontent);
                        $mailcontent = str_replace("&amp;start_date&amp;",$start1,$mailcontent);
                }
                $subject  = 'Deal promored'; 
                if($email_flag==1)
                {
                    $res = $this->send($email,$subject,$mailcontent,2);
                                    return $res;
                }
                
        }
   // function
        
        
       function testingMails($con)
    {
           $CI = & get_instance();
            $mail = $CI->db->query("SELECT * FROM `ad_mails` WHERE action='".$con."'");
            foreach($mail->result() as $row)
            {
            
             $omailcontent = $row->content;
             $res1 = $this->send("chandu4it@gmail.com",'subject',$omailcontent,0);
            $res1 = $this->send("chandrasekhar_nyros@yahoo.com",'subject',$omailcontent,0);
            echo $row->action;
            
            }
            
    }
    
    
        //Sending message when product is saved
    public function saveProduct($manuf_id,$title,$type,$cat,$mrp)
    {
            /*$CI = & get_instance();
            $user_query = $CI->db->query("SELECT contact_person,mobile,email from ad_sellers where id = $manuf_id and email_flag=1");
            if($user_query->num_rows()>0)
            {
                $manuf_name =  $user_query->row('contact_person');
                $manuf_mobile = $user_query->row('mobile');
                $manuf_email = $user_query->row('email');
                $dtype = $this->getValue('ad_deal_types','deal_type','id',$type);
                $mrp1 = str_replace('.00','',money_format('%!i', $mrp));
                if($cat!=0)
                {
                        $category = $this->getValue('ad_deal_categories','category_name','id',$cat);
                        $cate=$category;
                }
                else
                {
                        $cate='';
                }
                
                //send email
                $to = $manuf_email;
                $Omailcontent = $this->getValue('ad_mails','content','action','Product Created');
                $Omailcontent = str_replace("&amp;username&amp;",$manuf_name,$Omailcontent);
                $Omailcontent = str_replace("&amp;title&amp;",$title,$Omailcontent);
                $Omailcontent = str_replace("&amp;type&amp;",$dtype,$Omailcontent);
                $Omailcontent = str_replace("&amp;category&amp;",$cate,$Omailcontent);
                $Omailcontent = str_replace("&amp;mrp&amp;",$mrp1,$Omailcontent);
                $subject = "Product Created Successfully";
                $res = $this->send($to,$subject,$Omailcontent,2);
            }*/
        
    }
    //Product delete mail
    
    public function productDelete($id)
    {
        /*$CI = & get_instance();        
        $pro_exe = $CI->db->query("SELECT seller_id,title,deal_type_id,category_id,mrp from ad_manuf_products where id = $id");
        $manuf_id =  $pro_exe->row('seller_id');
        $title = $pro_exe->row('title');
        $mrp = $pro_exe->row('mrp');
        $mrp = str_replace('.00','',money_format('%!i', $mrp));
        $deal_type_id = $pro_exe->row('deal_type_id');
        $category_id = $pro_exe->row('category_id');
        
        $user_query = $CI->db->query("SELECT contact_person,email from ad_sellers where id = $manuf_id");
        $manuf_name =  $user_query->row('contact_person');
        $manuf_email = $user_query->row('email');
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
        
        $helpline_qry= $CI->db->query("SELECT value FROM `ad_settings` WHERE `key`='aquadeals_helpline'");
        $ad_helpline = $helpline_qry->row('value');
        
        $smscontent = "Dear $manuf_name, Your Product $title, Type: $dtype, $cate has been deleted. Call Aquadeals $ad_helpline for help.";
        //send email
        $to = $manuf_email;
        $Omailcontent = $this->getValue('ad_mails','content','action','Product Deleted');
        $Omailcontent = str_replace("&amp;username&amp;",$manuf_name,$Omailcontent);
        $Omailcontent = str_replace("&amp;title&amp;",$title,$Omailcontent);
        $Omailcontent = str_replace("&amp;type&amp;",$dtype,$Omailcontent);
        $Omailcontent = str_replace("&amp;category&amp;",$cate,$Omailcontent);
        $Omailcontent = str_replace("&amp;mrp&amp;",$mrp,$Omailcontent);
        //$Omailcontent = str_replace("&amp;helpline&amp;",$ad_helpline,$Omailcontent);
        $subject = "Product Deleted ";
        $res = $this->send($to,$subject,$Omailcontent,2);*/
    }
    
    
    
    /*******************************************************Email for CRON Scedulers start*************************************************/
    //Incomplete profile alert to user
    public function user_inc_alert($data)
    {
            foreach($data as $user)
            {
              if(isset($user['email']))
                    {
                    $to = $user['email'];
                    $CI = & get_instance();//Get global functions
$helpline_qry= $CI->db->query("SELECT value FROM `ad_settings` WHERE `key`='aquadeals_helpline'");
        $ad_helpline = $helpline_qry->row('value');
                $subject = "Incomplete profile information alert";
                $mailcontent='<html>
                <head>
                        <meta charset="utf-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1">
                        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" /> 
                        <title>AquaDeals</title>
                        <style type="text/css">
                        .tot_pag{width: 40%;margin: 10px auto;}
                        .foter{overflow: hidden;width: 43%;margin: 10px auto;}
                        .nxt_stp li{width: 50%;margin-top: 10px;}
                        .nxt_stp li img{margin-right: 20px;margin-top: 10px;}
                        @media (max-width: 667px) {
                        .nxt_stp li{width: 100%;margin-top: 15px;}
                        .tot_pag{width: 80%;}
                        .foter{width: 83%;}
                        }
                        </style>
                </head>

                        <body style="background: #eeeeee;font-family: arial;">
                        <div style="width: 100%;text-align: center;margin: 30px 0;"> <a href="#"> 
                        <img src="http://aqua.deals/admin/assets/email_imgs/logo.png" /> </a> </div>
                        <div class="tot_pag" style="border-radius: 5px;background: #f15a25;padding: 20px;">
                        <h1 style="font-size: 16px;color: #fff;text-align: left;">Dear '.ucfirst($user['name']).',</h1>
                        <p style="font-size: 14px;color: #fff;text-align: left;font-weight: normal;margin-top: 15px;">Congratulations! </p>
                       
                       <p style="font-size: 14px;color: #fff;text-align: left;font-weight: normal;margin-top: 15px;">Please login into your AquaDeals App and complete your profile
information..</p>
                        <div style="clear: both">&nbsp;</div>
                        </div>
                        <div class="foter">
                       <h6 style="font-size: 13px;color: #666; float: right;margin: 0 0 30px 0;padding: 0;">Thank you for signing up! with AquaDeals. Call '.$ad_helpline.' for help. </h6>
                        <div style="clear: both;"></div>
                        <div style="float: left;">
                        <h6 style="font-size: 15px;color: #333;margin: 0;">Download AquaDeals</h6>
                        <a href="https://play.google.com/store/apps/details?id=com.aquadeals.user" style="margin-top: 15px;display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/android_icon.png" /> </a>
                        </div>
                        <div style="float: right;">
                        <h6 style="font-size: 15px;color: #333;margin: 0;">Follow Us</h6>
                        <ul style="list-style: none;text-align: center;margin: 15px 0 0 0;padding: 0;">
                        <li style="float: left;"><a href="https://www.facebook.com/aquadealsstore/" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/fb_icon.png" /> </a></li>
                        <li style="float: right;"><a href="https://twitter.com/aquadealsstore" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/twitter_icon.png" /> </a></li>
                        </ul>
                        </div>
                        </div>
                </body>
                </html>';
                $res = $this->send($to,$subject,$mailcontent,1);
                }
        }
      
    }
    
    //Incomplete profile alert to seller
    public function seller_inc_alert($data)
    {
            foreach($data as $seller)
            {
                    if(isset($seller['email']))
                    {
                    $to = $seller['email'];
                    $CI = & get_instance();//Get global functions
$shelpline_qry= $CI->db->query("SELECT value FROM `ad_settings` WHERE `key`='aquadeals_seller_helpline'");
$sad_helpline = $shelpline_qry->row('value');
                $subject = "Incomplete profile information alert";
                $mailcontent='<html>
                <head>
                        <meta charset="utf-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1">
                        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" /> 
                        <title>AquaDeals</title>
                        <style type="text/css">
                        .tot_pag{width: 40%;margin: 10px auto;}
                        .foter{overflow: hidden;width: 43%;margin: 10px auto;}
                        .nxt_stp li{width: 50%;margin-top: 10px;}
                        .nxt_stp li img{margin-right: 20px;margin-top: 10px;}
                        @media (max-width: 667px) {
                        .nxt_stp li{width: 100%;margin-top: 15px;}
                        .tot_pag{width: 80%;}
                        .foter{width: 83%;}
                        }
                        </style>
                </head>

                        <body style="background: #eeeeee;font-family: arial;">
                        <div style="width: 100%;text-align: center;margin: 30px 0;"> <a href="#"> 
                        <img src="http://aqua.deals/admin/assets/email_imgs/slogo.png" /> </a> </div>
                        <div class="tot_pag" style="border-radius: 5px;background: #019cdf;padding: 20px;">
                        <h1 style="font-size: 16px;color: #fff;text-align: left;">Dear '.ucfirst($seller['name']).',</h1>
                      <p style="font-size: 14px;color: #fff;text-align: left;font-weight: normal;margin-top: 15px;">Please login into your AquaDeals Partner App and complete your profile
information..</p>
                        <div style="clear: both">&nbsp;</div>
                        </div>
                        <div class="foter">
                        <h6 style="font-size: 13px;color: #666; float: right;margin: 0 0 30px 0;padding: 0;">Thank you for signing up! with AquaDeals. Call '.$sad_helpline.' for help. </h6>
                        <div style="clear: both;"></div>
                        <div style="float: left;">
                        <h6 style="font-size: 15px;color: #333;margin: 0;">Download AquaDeals</h6>
                        <a href="https://play.google.com/store/apps/details?id=com.aquadeals.user" style="margin-top: 15px;display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/android_icon.png" /> </a>
                        </div>
                        <div style="float: right;">
                        <h6 style="font-size: 15px;color: #333;margin: 0;">Follow Us</h6>
                        <ul style="list-style: none;text-align: center;margin: 15px 0 0 0;padding: 0;">
                        <li style="float: left;"><a href="https://www.facebook.com/aquadealsstore/" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/fb_icon.png" /> </a></li>
                        <li style="float: right;"><a href="https://twitter.com/aquadealsstore" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/twitter_icon.png" /> </a></li>
                        </ul>
                        </div>
                        </div>
                </body>
                </html>';
                $res = $this->send($to,$subject,$mailcontent,2);
                }
        }
    } 

    
    //Incomplete profile pic alert to user
    public function user_nop_alert($data)
    {
            foreach($data as $user)
            {
                     if(isset($user['email']))
                    {
                    $to = $user['email'];
                $subject = "Upload profile picture alert";
                $mailcontent='<html>
                        <head>
                        <meta charset="utf-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1">
                        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" /> 
                        <title>AquaDeals</title>
                        <style type="text/css">
                        .tot_pag{width: 40%;margin: 10px auto;}
                        .foter{overflow: hidden;width: 43%;margin: 10px auto;}
                        .nxt_stp li{width: 50%;margin-top: 10px;}
                        .nxt_stp li img{margin-right: 20px;margin-top: 10px;}
                        @media (max-width: 667px) {
                        .nxt_stp li{width: 100%;margin-top: 15px;}
                        .tot_pag{width: 80%;}
                        .foter{width: 83%;}
                        }
                        </style>
                </head>

                        <body style="background: #eeeeee;font-family: arial;">
                        <div style="width: 100%;text-align: center;margin: 30px 0;"> <a href="#"> 
                        <img src="http://aqua.deals/admin/assets/email_imgs/logo.png" /> </a> </div>
                        <div class="tot_pag" style="border-radius: 5px;background: #f15a25;padding: 20px;">
                        <h1 style="font-size: 16px;color: #fff;text-align: left;">Dear '.ucfirst($user['name']).',</h1>
                       <p style="font-size: 14px;color: #fff;text-align: left;font-weight: normal;margin-top: 15px;">Please login into your AquaDeals App and upload your profile picture.</p>
                        <div style="clear: both">&nbsp;</div>
                        </div>
                        <div class="foter">
                        <h6 style="font-size: 13px;color: #666; float: right;margin: 0 0 30px 0;padding: 0;">Thank you for signing up! with AquaDeals </h6>
                        <div style="clear: both;"></div>
                        <div style="float: left;">
                        <h6 style="font-size: 15px;color: #333;margin: 0;">Download AquaDeals</h6>
                        <a href="https://play.google.com/store/apps/details?id=com.aquadeals.user" style="margin-top: 15px;display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/android_icon.png" /> </a>
                        </div>
                        <div style="float: right;">
                        <h6 style="font-size: 15px;color: #333;margin: 0;">Follow Us</h6>
                        <ul style="list-style: none;text-align: center;margin: 15px 0 0 0;padding: 0;">
                        <li style="float: left;"><a href="https://www.facebook.com/aquadealsstore/" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/fb_icon.png" /> </a></li>
                        <li style="float: right;"><a href="https://twitter.com/aquadealsstore" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/twitter_icon.png" /> </a></li>
                        </ul>
                        </div>
                        </div>
                </body>
                </html>';
                $res = $this->send($to,$subject,$mailcontent,1);
                }
        }
    } 
    //Incomplete profile pic alert to Seller
    public function seller_nop_alert($data)
    {
            foreach($data as $seller)
            {
                     if(isset($seller['email']))
                    {
                    $to = $seller['email'];
                $subject = "Upload profile picture alert";
                $mailcontent='<html>
                        <head>
                        <meta charset="utf-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1">
                        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" /> 
                        <title>AquaDeals</title>
                        <style type="text/css">
                        .tot_pag{width: 40%;margin: 10px auto;}
                        .foter{overflow: hidden;width: 43%;margin: 10px auto;}
                        .nxt_stp li{width: 50%;margin-top: 10px;}
                        .nxt_stp li img{margin-right: 20px;margin-top: 10px;}
                        @media (max-width: 667px) {
                        .nxt_stp li{width: 100%;margin-top: 15px;}
                        .tot_pag{width: 80%;}
                        .foter{width: 83%;}
                        }
                        </style>
                </head>

                        <body style="background: #eeeeee;font-family: arial;">
                        <div style="width: 100%;text-align: center;margin: 30px 0;"> <a href="#"> 
                        <img src="http://aqua.deals/admin/assets/email_imgs/slogo.png" /> </a> </div>
                        <div class="tot_pag" style="border-radius: 5px;background: #019cdf;padding: 20px;">
                        <h1 style="font-size: 16px;color: #fff;text-align: left;">Dear '.ucfirst($seller['name']).',</h1>
                       <p style="font-size: 14px;color: #fff;text-align: left;font-weight: normal;margin-top: 15px;">
                                Please login into your AquaDeals Partner App and upload your hatchery images.
                       </p>
                        <div style="clear: both">&nbsp;</div>
                        </div>
                        <div class="foter">
                        <h6 style="font-size: 13px;color: #666; float: right;margin: 0 0 30px 0;padding: 0;">Thank you for signing up! with AquaDeals </h6>
                        <div style="clear: both;"></div>
                        <div style="float: left;">
                        <h6 style="font-size: 15px;color: #333;margin: 0;">Download AquaDeals</h6>
                        <a href="https://play.google.com/store/apps/details?id=com.aquadeals.user" style="margin-top: 15px;display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/android_icon.png" /> </a>
                        </div>
                        <div style="float: right;">
                        <h6 style="font-size: 15px;color: #333;margin: 0;">Follow Us</h6>
                        <ul style="list-style: none;text-align: center;margin: 15px 0 0 0;padding: 0;">
                        <li style="float: left;"><a href="https://www.facebook.com/aquadealsstore/" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/fb_icon.png" /> </a></li>
                        <li style="float: right;"><a href="https://twitter.com/aquadealsstore" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/twitter_icon.png" /> </a></li>
                        </ul>
                        </div>
                        </div>
                </body>
                </html>';
                $res = $this->send($to,$subject,$mailcontent,2);
                }
        }
    } 
    
    
    
    
    //No deal creation for seller
    public function seller_nod_alert($data)
    {
            foreach($data as $seller)
            {
                    if(isset($seller['email']))
                    {
                        $to = $seller['email'];
                        $subject = "Please post your deals";
                        $mailcontent='<html>
                                                <head>
                                                <meta charset="utf-8">
                                                <meta name="viewport" content="width=device-width, initial-scale=1">
                                                <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" /> 
                                                <title>AquaDeals</title>
                                                <style type="text/css">
                                                .tot_pag{width: 40%;margin: 10px auto;}
                                                .foter{overflow: hidden;width: 43%;margin: 10px auto;}
                                                .nxt_stp li{width: 50%;margin-top: 10px;}
                                                .nxt_stp li img{margin-right: 20px;margin-top: 10px;}
                                                @media (max-width: 667px) {
                                                .nxt_stp li{width: 100%;margin-top: 15px;}
                                                .tot_pag{width: 80%;}
                                                .foter{width: 83%;}
                                                }
                                                </style>
                                        </head>

                                                <body style="background: #eeeeee;font-family: arial;">
                                                <div style="width: 100%;text-align: center;margin: 30px 0;"> <a href="#"> 
                                                <img src="http://aqua.deals/admin/assets/email_imgs/slogo.png" /> </a> </div>
                                                <div class="tot_pag" style="border-radius: 5px;background: #019cdf;padding: 20px;">
                                                <h1 style="font-size: 16px;color: #fff;text-align: left;">Dear '.ucfirst($seller['name']).',</h1>
                                               <p style="font-size: 14px;color: #fff;text-align: left;font-weight: normal;margin-top: 15px;">
                                                       Please login into your AquaDeals Partner App and post your deals.
                                               </p>
                                                <div style="clear: both">&nbsp;</div>
                                                </div>
                                                <div class="foter">
                                                <h6 style="font-size: 13px;color: #666; float: right;margin: 0 0 30px 0;padding: 0;">Thank you for signing up! with AquaDeals </h6>
                                                <div style="clear: both;"></div>
                                                <div style="float: left;">
                                                <h6 style="font-size: 15px;color: #333;margin: 0;">Download AquaDeals</h6>
                        <a href="https://play.google.com/store/apps/details?id=com.aquadeals.user" style="margin-top: 15px;display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/android_icon.png" /> </a>
                        </div>
                        <div style="float: right;">
                        <h6 style="font-size: 15px;color: #333;margin: 0;">Follow Us</h6>
                        <ul style="list-style: none;text-align: center;margin: 15px 0 0 0;padding: 0;">
                        <li style="float: left;"><a href="https://www.facebook.com/aquadealsstore/" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/fb_icon.png" /> </a></li>
                        <li style="float: right;"><a href="https://twitter.com/aquadealsstore" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/twitter_icon.png" /> </a></li>
                        </ul>
                                                </div>
                                                </div>
                                        </body>
                                        </html>';
                        $res = $this->send($to,$subject,$mailcontent,2);
                    }
            }
    } 
    
    
    //Deal expire today
    public function dexp_tmrw_alert($dids)
    {
            foreach($dids as $did)
            {
            $CI = & get_instance();
            $deal_exe = $CI->db->query("SELECT ad_vendor_deals.deal_id,ad_vendor_deals.free_shipment,ad_vendor_deals.credit_facility,ad_vendor_deals.seller_id,ad_vendor_deals.price,ad_vendor_deals.discount_price,ad_vendor_deals.start_date,ad_vendor_deals.created_on,ad_vendor_deals.end_date, ad_sellers.contact_person, ad_sellers.email, ad_species.type FROM `ad_vendor_deals` INNER JOIN ad_sellers on ad_sellers.id = ad_vendor_deals.seller_id INNER JOIN ad_species on ad_species.id = ad_vendor_deals.species_id WHERE ad_vendor_deals.id  = ".$did['did']);
        
        $username =  ucfirst($deal_exe->row('name'));
        $email = $deal_exe->row('email');
        $specie = $deal_exe->row('type');
        $deal_id = $deal_exe->row('deal_id');
        $sdate= $deal_exe->row('start_date');
        $edate = $deal_exe->row('end_date');
        $cdate = $deal_exe->row('created_on');
        $srate = $deal_exe->row('price');
        $drate = $deal_exe->row('discount_price');
        $discount = $deal_exe->row('discount_price');
        $shipment = $deal_exe->row('free_shipment');
        $credit = $deal_exe->row('credit_facility');
        $shelpline_qry= $CI->db->query("SELECT value FROM `ad_settings` WHERE `key`='aquadeals_seller_helpline'");
$sad_helpline = $shelpline_qry->row('value');
        //send email
        $mailcontent='<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" /> 
<title>AquaDeals</title>
<style>
html, body, ul, li, img, span, p, h1, h2, h3, h4, h5, h6{padding: 0;margin: 0;}
img{max-width: 100%;}
.clr{clear:both;}
.book_dtl_one, .book_dtl_two, .book_dtl_three, .book_dtl_four{float: left;width: 25%;border-right: 1px solid #c5c5c5; padding: 20px 0px 20px 70px;}
.status_txt{background: url(images/cancel_icon.png) no-repeat;padding-bottom: 10px;padding-left: 40px;padding-top: 6px;}
.tot_pag{width: 80%;}
.foter{overflow: hidden;width: 80%;margin: 30px auto;}
.thnks_blk{width: 100%;}
/* responsive */

/*1599 to 1440 */
@media (max-width: 1599px) {}
/*1439 to 1360 */
@media (max-width: 1439px) {}
/*1359 to 1280 */
@media (max-width: 1359px) {}
/*1279 to 1152 */
@media (max-width: 1279px) {
.book_dtl{padding: 20px 30px;}
}
/*1151 to 1024 */
@media (max-width: 1151px) {}
/*1023 to 970 */
@media (max-width: 1023px) {
.book_dtl{padding: 20px 20px;}
}
/*969 to 800 */
@media (max-width: 969px) {
.book_dtl_one, .book_dtl_two, .book_dtl_three, .book_dtl_four{float: left;width: 50%;border-right: 1px solid #c5c5c5!important;
border-top:1px solid #c5c5c5!important;}
.book_dtl_one{border-top: none!important;}
.book_dtl_two{border-right: none!important;border-top: none!important;}
.book_dtl_four{border-right: none!important;}
}
/*799 to 768 */
@media (max-width: 799px) {}
/*767 to 736 */
@media (max-width: 767px) {}
/*735 to 667 */
@media (max-width: 667px) {}
/*666 to 600 */
@media (max-width: 666px) {}
/*599 to 568 */
@media (max-width: 599px) {
.tot_pag{width: 90%;}
.foter{width: 90%;}
.thnks_blk_emty{display: none;}
.thnks_blk{width: 100%;}
}
/*567 to 480  */
@media (max-width: 567px) {}
/*479 to 414  */
@media (max-width: 479px) {
.book_dtl_one, .book_dtl_two, .book_dtl_three, .book_dtl_four{width: 100%;border-top: none!important;border-right: none!important;border-bottom: 1px solid #c5c5c5!important;}
.book_dtl_four{border-top: none!important;border-right: none!important;border-bottom: none!important;}
}
/*413 to 375*/
@media (max-width: 413px) {}
/*374 to 320*/
@media (max-width: 374px) {}
</style>
</head>

<body style="background: #eeeeee;font-family: arial;">
<div class="tot_pag" style="border-radius: 5px;background: #fff;margin: 30px auto;padding: 20px;">
<div style="width: 100%;text-align: center;margin: 30px 0;"> <a href="#"> <img src="http://aqua.deals/admin/assets/email_imgs/slogo.png" /> </a> </div>
<h1 style="font-size: 15px;color: #333;text-align: left;">Dear '.$username.',</h1>
<div style="margin: 15px 0;overflow: hidden;padding: 20px 0;">
<h2 class="status_txt" style="font-size: 14px; color: #d2322d;float: left;">
Your deal '.$deal_id.' is going to expire to tomorrow.</h2>
</div>

<div style="position: relative;margin: 30px 0;">

<div style="position: absolute;left: 0;right: 0;top: -25px;text-align: center;z-index: 999;width: -moz-fit-content;
width: -webkit-fit-content;margin: 0 auto">
    <h1 style="font-size: 18px;color: #333;background: #fff;padding: 10px 15px;">Deal Details</h1>
    </div>
    <div style="border-top: 2px solid #303030;position: absolute;bottom: 0;width: 100%;"></div>
</div>
<div style="clear: both">&nbsp;</div>
<table border="0" cellpadding="0" cellspacing="0" style="width: 100%; background: #f6f6f6;padding: 20px;margin-top: 20px;">
    <tbody>
        <tr>
            <td>
                <table border="0" cellpadding="0" cellspacing="0" style="margin: 0px auto;" class="book_dtl_one">
                    <tbody>
                        <tr>
                            <td rowspan="2" style="width:28px;padding-right:80px"> <img style="position: relative;top: -5px;padding-right: 15px;" src="http://aqua.deals/admin/assets/email_imgs/booking_id_icon.png" /> </td>
                            <td style="font-size: 14px;font-weight: bold; color: #666;">Deal Id</td>
                        </tr>
                        <tr><td style="font-size: 15px;font-weight: normal; color: #333;">'.$deal_id.'</td></tr>
                    </tbody>
                </table>
    
                <table border="0" cellpadding="0" cellspacing="0" style="margin: 0px auto;" class="book_dtl_two">
                    <tbody>
                        <tr>
                            <td rowspan="2" style="width:28px;padding-right:80px"> <img style="position: relative;top: -5px;padding-right: 15px;" src="http://aqua.deals/admin/assets/email_imgs/booking_date_icon.png" /> </td>
                            <td style="font-size: 14px;font-weight: bold; color: #666;">Start Date</td>
                        </tr>
                        <tr><td style="font-size: 15px;font-weight: normal; color: #333;">'.$sdate.'</td></tr>
                    </tbody>
                </table>
    
                <table border="0" cellpadding="0" cellspacing="0" style="margin: 0px auto;" class="book_dtl_three">
                    <tbody>
                        <tr>
                            <td rowspan="2" style="width:28px;padding-right:80px"> <img style="position: relative;top: -5px;padding-right: 15px;" src="http://aqua.deals/admin/assets/email_imgs/booking_date_icon.png"  /> </td>
                            <td style="font-size: 14px;font-weight: bold; color: #666;">End Date</td>
                        </tr>
                        <tr><td style="font-size: 15px;font-weight: normal; color: #333;">'.$edate.'</td></tr>
                    </tbody>
                </table>

                <table border="0" cellpadding="0" cellspacing="0" style="margin: 0px auto;border:none;" class="book_dtl_four">
                    <tbody>';
                    if($drate > 0)
                    {
                        $mailcontent.='<tr>
                            <td rowspan="2" style="width:28px;padding-right:80px"> <img style="position: relative;top: -5px;padding-right: 15px;" src="http://aqua.deals/admin/assets/email_imgs/payment_icon.png" /> </td>
                            <td style="font-size: 14px;font-weight: bold; color: #666;">Deal Price</td>
                        </tr>
                        <tr><td style="font-size: 15px;font-weight: normal; color: #333;">&#8377; '.$drate.'</td></tr>';
                        }
                        else
                        {
                                $mailcontent.='<tr>
                            <td rowspan="2" style="width:28px;padding-right:80px"> <img style="position: relative;top: -5px;padding-right: 15px;" src="http://aqua.deals/admin/assets/email_imgs/payment_icon.png" /> </td>
                            <td style="font-size: 14px;font-weight: bold; color: #666;">Price</td>
                        </tr>
                        <tr><td style="font-size: 15px;font-weight: normal; color: #333;">&#8377; '.$srate.'</td></tr>';
                        }
                    $mailcontent.='</tbody>
                </table>
            </td>

        </tr>
    </tbody>
</table>
<div style="clear: both">&nbsp;</div>
<table border="0" cellpadding="0" cellspacing="0" style="width: 100%; margin-top: 15px;text-align: left;">
    
    <tbody>
            <tr>
            <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">Specie</td>
            <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.ucfirst($specie).'</td>
        </tr>
        
         <tr>
            <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">Quantity</td>
            <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.$qty.'</td>
        </tr>';
        if($discount > 0)
                    {
                                                $mailcontent.='<tr>
                                                <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">Price</td>
                                                <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.$srate.'</td>
                                                </tr>';
                    }
        
        if($shipment==1){$shipment_msg="Available";} else{$shipment_msg=" Not Available";}
        if($credit==1){$credit_msg="Available";} else{$credit_msg=" Not Available";}
        $mailcontent.='<tr>
            <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">Free Shipment</td>
            <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.$shipment_msg.'</td>
        </tr>
        
        <tr>
            <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">Credit Facility</td>
            <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.$credit_msg.'</td>
        </tr>
    </tbody>
</table>

<div style="clear: both">&nbsp;</div>
<div style="position: relative;margin: 30px 0;">
<div style="position: absolute;left: 0;right: 0;top: -25px;text-align: center;z-index: 999;width: -moz-fit-content;
width: -webkit-fit-content;margin: 0 auto">
    
    </div>
    <div style="border-top: 2px solid #303030;position: absolute;bottom: 0;width: 100%;"></div>
</div>
<div style="clear: both">&nbsp;</div>

<table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
    <tbody>
        <tr>
            <td class="thnks_blk"><p style="font-size: 14px;color: #666; text-align: left;margin-top: 25px;font-weight: normal;">Contact AquaDeals Customer care '.$sad_helpline.' for help</p></td>
        </tr>
    </tbody>
</table>
<div style="clear: both">&nbsp;</div>
</div>
<div class="foter">
    <div style="float: left;">
        <h6 style="font-size: 15px;color: #333;margin: 0;">Download AquaDeals</h6>
                        <a href="https://play.google.com/store/apps/details?id=com.aquadeals.user" style="margin-top: 15px;display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/android_icon.png" /> </a>
                        </div>
                        <div style="float: right;">
                        <h6 style="font-size: 15px;color: #333;margin: 0;">Follow Us</h6>
                        <ul style="list-style: none;text-align: center;margin: 15px 0 0 0;padding: 0;">
                        <li style="float: left;"><a href="https://www.facebook.com/aquadealsstore/" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/fb_icon.png" /> </a></li>
                        <li style="float: right;"><a href="https://twitter.com/aquadealsstore" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/twitter_icon.png" /> </a></li>
                        </ul>
        
    </div>
</div>
</body>
</html>';
        
        $subject  = 'Deal expire alert'; 
        
        $res = $this->send($email,$subject,$mailcontent,2);
        return $res;
            
            }
    } 
    //Deal expire tommarow
    public function dexp_today_alert($dids)
    {
             foreach($dids as $did)
            {
            $CI = & get_instance();
            $deal_exe = $CI->db->query("SELECT ad_vendor_deals.deal_id,ad_vendor_deals.free_shipment,ad_vendor_deals.credit_facility,ad_vendor_deals.seller_id,ad_vendor_deals.price,ad_vendor_deals.discount_price,ad_vendor_deals.start_date,ad_vendor_deals.created_on,ad_vendor_deals.end_date, ad_sellers.contact_person, ad_sellers.email, ad_species.type FROM `ad_vendor_deals` INNER JOIN ad_sellers on ad_sellers.id = ad_vendor_deals.seller_id INNER JOIN ad_species on ad_species.id = ad_vendor_deals.species_id WHERE ad_vendor_deals.id  =".$did['did']);
        
        $username =  ucfirst($deal_exe->row('name'));
        $email = $deal_exe->row('email');
        $specie = $deal_exe->row('type');
        $deal_id = $deal_exe->row('deal_id');
        $sdate= $deal_exe->row('start_date');
        $edate = $deal_exe->row('end_date');
        $cdate = $deal_exe->row('created_on');
        $srate = $deal_exe->row('price');
        $drate = $deal_exe->row('discount_price');
        $discount = $deal_exe->row('discount_price');
        $shipment = $deal_exe->row('free_shipment');
        $credit = $deal_exe->row('credit_facility');
        $shelpline_qry= $CI->db->query("SELECT value FROM `ad_settings` WHERE `key`='aquadeals_seller_helpline'");
                $sad_helpline = $shelpline_qry->row('value');
        //send email
        $mailcontent='<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" /> 
<title>AquaDeals</title>
<style>
html, body, ul, li, img, span, p, h1, h2, h3, h4, h5, h6{padding: 0;margin: 0;}
img{max-width: 100%;}
.clr{clear:both;}
.book_dtl_one, .book_dtl_two, .book_dtl_three, .book_dtl_four{float: left;width: 25%;border-right: 1px solid #c5c5c5; padding: 20px 0px 20px 70px;}
.status_txt{background: url(images/cancel_icon.png) no-repeat;padding-bottom: 10px;padding-left: 40px;padding-top: 6px;}
.tot_pag{width: 80%;}
.foter{overflow: hidden;width: 80%;margin: 30px auto;}
.thnks_blk{width: 100%;}
/* responsive */

/*1599 to 1440 */
@media (max-width: 1599px) {}
/*1439 to 1360 */
@media (max-width: 1439px) {}
/*1359 to 1280 */
@media (max-width: 1359px) {}
/*1279 to 1152 */
@media (max-width: 1279px) {
.book_dtl{padding: 20px 30px;}
}
/*1151 to 1024 */
@media (max-width: 1151px) {}
/*1023 to 970 */
@media (max-width: 1023px) {
.book_dtl{padding: 20px 20px;}
}
/*969 to 800 */
@media (max-width: 969px) {
.book_dtl_one, .book_dtl_two, .book_dtl_three, .book_dtl_four{float: left;width: 50%;border-right: 1px solid #c5c5c5!important;
border-top:1px solid #c5c5c5!important;}
.book_dtl_one{border-top: none!important;}
.book_dtl_two{border-right: none!important;border-top: none!important;}
.book_dtl_four{border-right: none!important;}
}
/*799 to 768 */
@media (max-width: 799px) {}
/*767 to 736 */
@media (max-width: 767px) {}
/*735 to 667 */
@media (max-width: 667px) {}
/*666 to 600 */
@media (max-width: 666px) {}
/*599 to 568 */
@media (max-width: 599px) {
.tot_pag{width: 90%;}
.foter{width: 90%;}
.thnks_blk_emty{display: none;}
.thnks_blk{width: 100%;}
}
/*567 to 480  */
@media (max-width: 567px) {}
/*479 to 414  */
@media (max-width: 479px) {
.book_dtl_one, .book_dtl_two, .book_dtl_three, .book_dtl_four{width: 100%;border-top: none!important;border-right: none!important;border-bottom: 1px solid #c5c5c5!important;}
.book_dtl_four{border-top: none!important;border-right: none!important;border-bottom: none!important;}
}
/*413 to 375*/
@media (max-width: 413px) {}
/*374 to 320*/
@media (max-width: 374px) {}
</style>
</head>

<body style="background: #eeeeee;font-family: arial;">
<div class="tot_pag" style="border-radius: 5px;background: #fff;margin: 30px auto;padding: 20px;">
<div style="width: 100%;text-align: center;margin: 30px 0;"> <a href="#"> <img src="http://aqua.deals/admin/assets/email_imgs/slogo.png" /> </a> </div>
<h1 style="font-size: 15px;color: #333;text-align: left;">Dear '.$username.',</h1>
<div style="margin: 15px 0;overflow: hidden;padding: 20px 0;">
<h2 class="status_txt" style="font-size: 14px; color: #d2322d;float: left;">
Your deal '.$deal_id.' is going to expire today.</h2>
</div>

<div style="position: relative;margin: 30px 0;">

<div style="position: absolute;left: 0;right: 0;top: -25px;text-align: center;z-index: 999;width: -moz-fit-content;
width: -webkit-fit-content;margin: 0 auto">
    <h1 style="font-size: 18px;color: #333;background: #fff;padding: 10px 15px;">Deal Details</h1>
    </div>
    <div style="border-top: 2px solid #303030;position: absolute;bottom: 0;width: 100%;"></div>
</div>
<div style="clear: both">&nbsp;</div>
<table border="0" cellpadding="0" cellspacing="0" style="width: 100%; background: #f6f6f6;padding: 20px;margin-top: 20px;">
    <tbody>
        <tr>
            <td>
                <table border="0" cellpadding="0" cellspacing="0" style="margin: 0px auto;" class="book_dtl_one">
                    <tbody>
                        <tr>
                            <td rowspan="2" style="width:28px;padding-right:80px"> <img style="position: relative;top: -5px;padding-right: 15px;" src="http://aqua.deals/admin/assets/email_imgs/booking_id_icon.png" /> </td>
                            <td style="font-size: 14px;font-weight: bold; color: #666;">Deal Id</td>
                        </tr>
                        <tr><td style="font-size: 15px;font-weight: normal; color: #333;">'.$deal_id.'</td></tr>
                    </tbody>
                </table>
    
                <table border="0" cellpadding="0" cellspacing="0" style="margin: 0px auto;" class="book_dtl_two">
                    <tbody>
                        <tr>
                            <td rowspan="2" style="width:28px;padding-right:80px"> <img style="position: relative;top: -5px;padding-right: 15px;" src="http://aqua.deals/admin/assets/email_imgs/booking_date_icon.png" /> </td>
                            <td style="font-size: 14px;font-weight: bold; color: #666;">Start Date</td>
                        </tr>
                        <tr><td style="font-size: 15px;font-weight: normal; color: #333;">'.$sdate.'</td></tr>
                    </tbody>
                </table>
    
                <table border="0" cellpadding="0" cellspacing="0" style="margin: 0px auto;" class="book_dtl_three">
                    <tbody>
                        <tr>
                            <td rowspan="2" style="width:28px;padding-right:80px"> <img style="position: relative;top: -5px;padding-right: 15px;" src="http://aqua.deals/admin/assets/email_imgs/booking_date_icon.png"  /> </td>
                            <td style="font-size: 14px;font-weight: bold; color: #666;">End Date</td>
                        </tr>
                        <tr><td style="font-size: 15px;font-weight: normal; color: #333;">'.$edate.'</td></tr>
                    </tbody>
                </table>

                <table border="0" cellpadding="0" cellspacing="0" style="margin: 0px auto;border:none;" class="book_dtl_four">
                    <tbody>';
                    if($drate > 0)
                    {
                        $mailcontent.='<tr>
                            <td rowspan="2" style="width:28px;padding-right:80px"> <img style="position: relative;top: -5px;padding-right: 15px;" src="http://aqua.deals/admin/assets/email_imgs/payment_icon.png" /> </td>
                            <td style="font-size: 14px;font-weight: bold; color: #666;">Deal Price</td>
                        </tr>
                        <tr><td style="font-size: 15px;font-weight: normal; color: #333;">&#8377; '.$drate.'</td></tr>';
                        }
                        else
                        {
                                $mailcontent.='<tr>
                            <td rowspan="2" style="width:28px;padding-right:80px"> <img style="position: relative;top: -5px;padding-right: 15px;" src="http://aqua.deals/admin/assets/email_imgs/payment_icon.png" /> </td>
                            <td style="font-size: 14px;font-weight: bold; color: #666;">Price</td>
                        </tr>
                        <tr><td style="font-size: 15px;font-weight: normal; color: #333;">&#8377; '.$srate.'</td></tr>';
                        }
                    $mailcontent.='</tbody>
                </table>
            </td>

        </tr>
    </tbody>
</table>
<div style="clear: both">&nbsp;</div>
<table border="0" cellpadding="0" cellspacing="0" style="width: 100%; margin-top: 15px;text-align: left;">
    
    <tbody>
            <tr>
            <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">Specie</td>
            <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.ucfirst($specie).'</td>
        </tr>
        
         <tr>
            <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">Quantity</td>
            <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.$qty.'</td>
        </tr>';
        if($discount > 0)
                    {
                                                $mailcontent.='<tr>
                                                <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">Price</td>
                                                <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.$srate.'</td>
                                                </tr>';
                    }
        
        if($shipment==1){$shipment_msg="Available";} else{$shipment_msg=" Not Available";}
        if($credit==1){$credit_msg="Available";} else{$credit_msg=" Not Available";}
        $mailcontent.='<tr>
            <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">Free Shipment</td>
            <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.$shipment_msg.'</td>
        </tr>
        
        <tr>
            <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">Credit Facility</td>
            <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.$credit_msg.'</td>
        </tr>
    </tbody>
</table>

<div style="clear: both">&nbsp;</div>
<div style="position: relative;margin: 30px 0;">
<div style="position: absolute;left: 0;right: 0;top: -25px;text-align: center;z-index: 999;width: -moz-fit-content;
width: -webkit-fit-content;margin: 0 auto">
    
    </div>
    <div style="border-top: 2px solid #303030;position: absolute;bottom: 0;width: 100%;"></div>
</div>
<div style="clear: both">&nbsp;</div>

<table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
    <tbody>
        <tr>
            <td class="thnks_blk"><p style="font-size: 14px;color: #666; text-align: left;margin-top: 25px;font-weight: normal;">Contact AquaDeals Customer care '.$sad_helpline.' for help</p></td>
        </tr>
    </tbody>
</table>
<div style="clear: both">&nbsp;</div>
</div>
<div class="foter">
    <div style="float: left;">
        <h6 style="font-size: 15px;color: #333;margin: 0;">Download AquaDeals</h6>
                        <a href="https://play.google.com/store/apps/details?id=com.aquadeals.user" style="margin-top: 15px;display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/android_icon.png" /> </a>
                        </div>
                        <div style="float: right;">
                        <h6 style="font-size: 15px;color: #333;margin: 0;">Follow Us</h6>
                        <ul style="list-style: none;text-align: center;margin: 15px 0 0 0;padding: 0;">
                        <li style="float: left;"><a href="https://www.facebook.com/aquadealsstore/" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/fb_icon.png" /> </a></li>
                        <li style="float: right;"><a href="https://twitter.com/aquadealsstore" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/twitter_icon.png" /> </a></li>
                        </ul>
        
    </div>
</div>
</body>
</html>';
        
        $subject  = 'Deal expire alert'; 
        
        $res = $this->send($email,$subject,$mailcontent,2);
        return $res;
            
            }
    } 
    //Deal expired
    public function dexp_alert($dids)
    {
             foreach($dids as $did)
            {

            $CI = & get_instance();
            $deal_exe = $CI->db->query("SELECT ad_vendor_deals.deal_id,ad_vendor_deals.free_shipment,ad_vendor_deals.credit_facility,ad_vendor_deals.seller_id,ad_vendor_deals.price,ad_vendor_deals.discount_price,ad_vendor_deals.start_date,ad_vendor_deals.created_on,ad_vendor_deals.end_date, ad_sellers.contact_person, ad_sellers.email, ad_species.type FROM `ad_vendor_deals` INNER JOIN ad_sellers on ad_sellers.id = ad_vendor_deals.seller_id INNER JOIN ad_species on ad_species.id = ad_vendor_deals.species_id WHERE ad_vendor_deals.id  = ".$did['did']);
        
        $username =  ucfirst($deal_exe->row('name'));
        $email = $deal_exe->row('email');
        $specie = $deal_exe->row('type');
        $deal_id = $deal_exe->row('deal_id');
        $sdate= $deal_exe->row('start_date');
        $edate = $deal_exe->row('end_date');
        $cdate = $deal_exe->row('created_on');
        $srate = $deal_exe->row('price');
        $drate = $discount = $deal_exe->row('discount_price');
        $shipment = $deal_exe->row('free_shipment');
        $credit = $deal_exe->row('credit_facility');
        $shelpline_qry= $CI->db->query("SELECT value FROM `ad_settings` WHERE `key`='aquadeals_seller_helpline'");
$sad_helpline = $shelpline_qry->row('value');
        //send email
        $mailcontent='<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" /> 
<title>AquaDeals</title>
<style>
html, body, ul, li, img, span, p, h1, h2, h3, h4, h5, h6{padding: 0;margin: 0;}
img{max-width: 100%;}
.clr{clear:both;}
.book_dtl_one, .book_dtl_two, .book_dtl_three, .book_dtl_four{float: left;width: 25%;border-right: 1px solid #c5c5c5; padding: 20px 0px 20px 70px;}
.status_txt{background: url(images/cancel_icon.png) no-repeat;padding-bottom: 10px;padding-left: 40px;padding-top: 6px;}
.tot_pag{width: 80%;}
.foter{overflow: hidden;width: 80%;margin: 30px auto;}
.thnks_blk{width: 100%;}
/* responsive */

/*1599 to 1440 */
@media (max-width: 1599px) {}
/*1439 to 1360 */
@media (max-width: 1439px) {}
/*1359 to 1280 */
@media (max-width: 1359px) {}
/*1279 to 1152 */
@media (max-width: 1279px) {
.book_dtl{padding: 20px 30px;}
}
/*1151 to 1024 */
@media (max-width: 1151px) {}
/*1023 to 970 */
@media (max-width: 1023px) {
.book_dtl{padding: 20px 20px;}
}
/*969 to 800 */
@media (max-width: 969px) {
.book_dtl_one, .book_dtl_two, .book_dtl_three, .book_dtl_four{float: left;width: 50%;border-right: 1px solid #c5c5c5!important;
border-top:1px solid #c5c5c5!important;}
.book_dtl_one{border-top: none!important;}
.book_dtl_two{border-right: none!important;border-top: none!important;}
.book_dtl_four{border-right: none!important;}
}
/*799 to 768 */
@media (max-width: 799px) {}
/*767 to 736 */
@media (max-width: 767px) {}
/*735 to 667 */
@media (max-width: 667px) {}
/*666 to 600 */
@media (max-width: 666px) {}
/*599 to 568 */
@media (max-width: 599px) {
.tot_pag{width: 90%;}
.foter{width: 90%;}
.thnks_blk_emty{display: none;}
.thnks_blk{width: 100%;}
}
/*567 to 480  */
@media (max-width: 567px) {}
/*479 to 414  */
@media (max-width: 479px) {
.book_dtl_one, .book_dtl_two, .book_dtl_three, .book_dtl_four{width: 100%;border-top: none!important;border-right: none!important;border-bottom: 1px solid #c5c5c5!important;}
.book_dtl_four{border-top: none!important;border-right: none!important;border-bottom: none!important;}
}
/*413 to 375*/
@media (max-width: 413px) {}
/*374 to 320*/
@media (max-width: 374px) {}
</style>
</head>

<body style="background: #eeeeee;font-family: arial;">
<div class="tot_pag" style="border-radius: 5px;background: #fff;margin: 30px auto;padding: 20px;">
<div style="width: 100%;text-align: center;margin: 30px 0;"> <a href="#"> <img src="http://aqua.deals/admin/assets/email_imgs/slogo.png" /> </a> </div>
<h1 style="font-size: 15px;color: #333;text-align: left;">Dear '.$username.',</h1>
<div style="margin: 15px 0;overflow: hidden;padding: 20px 0;">
<h2 class="status_txt" style="font-size: 14px; color: #d2322d;float: left;">
Your deal '.$deal_id.' is expired.</h2>
</div>

<div style="position: relative;margin: 30px 0;">

<div style="position: absolute;left: 0;right: 0;top: -25px;text-align: center;z-index: 999;width: -moz-fit-content;
width: -webkit-fit-content;margin: 0 auto">
    <h1 style="font-size: 18px;color: #333;background: #fff;padding: 10px 15px;">Deal Details</h1>
    </div>
    <div style="border-top: 2px solid #303030;position: absolute;bottom: 0;width: 100%;"></div>
</div>
<div style="clear: both">&nbsp;</div>
<table border="0" cellpadding="0" cellspacing="0" style="width: 100%; background: #f6f6f6;padding: 20px;margin-top: 20px;">
    <tbody>
        <tr>
            <td>
                <table border="0" cellpadding="0" cellspacing="0" style="margin: 0px auto;" class="book_dtl_one">
                    <tbody>
                        <tr>
                            <td rowspan="2" style="width:28px;padding-right:80px"> <img style="position: relative;top: -5px;padding-right: 15px;" src="http://aqua.deals/admin/assets/email_imgs/booking_id_icon.png" /> </td>
                            <td style="font-size: 14px;font-weight: bold; color: #666;">Deal Id</td>
                        </tr>
                        <tr><td style="font-size: 15px;font-weight: normal; color: #333;">'.$deal_id.'</td></tr>
                    </tbody>
                </table>
    
                <table border="0" cellpadding="0" cellspacing="0" style="margin: 0px auto;" class="book_dtl_two">
                    <tbody>
                        <tr>
                            <td rowspan="2" style="width:28px;padding-right:80px"> <img style="position: relative;top: -5px;padding-right: 15px;" src="http://aqua.deals/admin/assets/email_imgs/booking_date_icon.png" /> </td>
                            <td style="font-size: 14px;font-weight: bold; color: #666;">Start Date</td>
                        </tr>
                        <tr><td style="font-size: 15px;font-weight: normal; color: #333;">'.$sdate.'</td></tr>
                    </tbody>
                </table>
    
                <table border="0" cellpadding="0" cellspacing="0" style="margin: 0px auto;" class="book_dtl_three">
                    <tbody>
                        <tr>
                            <td rowspan="2" style="width:28px;padding-right:80px"> <img style="position: relative;top: -5px;padding-right: 15px;" src="http://aqua.deals/admin/assets/email_imgs/booking_date_icon.png"  /> </td>
                            <td style="font-size: 14px;font-weight: bold; color: #666;">End Date</td>
                        </tr>
                        <tr><td style="font-size: 15px;font-weight: normal; color: #333;">'.$edate.'</td></tr>
                    </tbody>
                </table>

                <table border="0" cellpadding="0" cellspacing="0" style="margin: 0px auto;border:none;" class="book_dtl_four">
                    <tbody>';
                    if($drate > 0)
                    {
                        $mailcontent.='<tr>
                            <td rowspan="2" style="width:28px;padding-right:80px"> <img style="position: relative;top: -5px;padding-right: 15px;" src="http://aqua.deals/admin/assets/email_imgs/payment_icon.png" /> </td>
                            <td style="font-size: 14px;font-weight: bold; color: #666;">Deal Price</td>
                        </tr>
                        <tr><td style="font-size: 15px;font-weight: normal; color: #333;">&#8377; '.$drate.'</td></tr>';
                        }
                        else
                        {
                                $mailcontent.='<tr>
                            <td rowspan="2" style="width:28px;padding-right:80px"> <img style="position: relative;top: -5px;padding-right: 15px;" src="http://aqua.deals/admin/assets/email_imgs/payment_icon.png" /> </td>
                            <td style="font-size: 14px;font-weight: bold; color: #666;">Price</td>
                        </tr>
                        <tr><td style="font-size: 15px;font-weight: normal; color: #333;">&#8377; '.$srate.'</td></tr>';
                        }
                    $mailcontent.='</tbody>
                </table>
            </td>

        </tr>
    </tbody>
</table>
<div style="clear: both">&nbsp;</div>
<table border="0" cellpadding="0" cellspacing="0" style="width: 100%; margin-top: 15px;text-align: left;">
    
    <tbody>
            <tr>
            <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">Specie</td>
            <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.ucfirst($specie).'</td>
        </tr>
        
         <tr>
            <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">Quantity</td>
            <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.$qty.'</td>
        </tr>';
        if($discount > 0)
                    {
                                                $mailcontent.='<tr>
                                                <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">Price</td>
                                                <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.$srate.'</td>
                                                </tr>';
                    }
        
        if($shipment==1){$shipment_msg="Available";} else{$shipment_msg=" Not Available";}
        if($credit==1){$credit_msg="Available";} else{$credit_msg=" Not Available";}
        $mailcontent.='<tr>
            <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">Free Shipment</td>
            <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.$shipment_msg.'</td>
        </tr>
        
        <tr>
            <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">Credit Facility</td>
            <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.$credit_msg.'</td>
        </tr>
    </tbody>
</table>

<div style="clear: both">&nbsp;</div>
<div style="position: relative;margin: 30px 0;">
<div style="position: absolute;left: 0;right: 0;top: -25px;text-align: center;z-index: 999;width: -moz-fit-content;
width: -webkit-fit-content;margin: 0 auto">
    
    </div>
    <div style="border-top: 2px solid #303030;position: absolute;bottom: 0;width: 100%;"></div>
</div>
<div style="clear: both">&nbsp;</div>

<table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
    <tbody>
        <tr>
            <td class="thnks_blk"><p style="font-size: 14px;color: #666; text-align: left;margin-top: 25px;font-weight: normal;">Contact AquaDeals Customer care '.$sad_helpline.' for help.</p></td>
        </tr>
    </tbody>
</table>
<div style="clear: both">&nbsp;</div>
</div>
<div class="foter">
    <div style="float: left;">
        <h6 style="font-size: 15px;color: #333;margin: 0;">Download AquaDeals</h6>
                        <a href="https://play.google.com/store/apps/details?id=com.aquadeals.user" style="margin-top: 15px;display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/android_icon.png" /> </a>
                        </div>
                        <div style="float: right;">
                        <h6 style="font-size: 15px;color: #333;margin: 0;">Follow Us</h6>
                        <ul style="list-style: none;text-align: center;margin: 15px 0 0 0;padding: 0;">
                        <li style="float: left;"><a href="https://www.facebook.com/aquadealsstore/" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/fb_icon.png" /> </a></li>
                        <li style="float: right;"><a href="https://twitter.com/aquadealsstore" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/twitter_icon.png" /> </a></li>
                        </ul>
        
    </div>
</div>
</body>
</html>';
        
        $subject  = 'Deal expire alert'; 
        
        $res = $this->send($email,$subject,$mailcontent,2);
        return $res;
            
            }
    } 
    
    /************************************ Emails related to Seed Bookings start here ************************************************/
    
    //Notify User and partner when booking is placed status = 0
    public function dealBookConfiramtion($bookedId)
    {
                 $this->getSeedBookingContent($bookedId,"Order &oid& Placed");
                return 1;
    }
    
    // Notify user, partner when booking is completed status = 2
    public function BookingComplted($bookedId)
    {
        $this->getSeedBookingContent($bookedId,"Order &oid& Completed");
                return 1;
    }
    
    // Notify user, partner when booking is cancelled status = 3
    public function BookingCancellation($bookedId)
    {
            $this->getSeedBookingContent($bookedId,"Order &oid& Cancelled");
                return 1;
    }
    
    // Notify user, partner when booking is Processing status = 1
    public function BookingProcessing($bookedId)
    {
            $this->getSeedBookingContent($bookedId,"Order &oid& Confirmed");
                return 1;
    }
    
    // Notify user, partner when booking is Shipping status = 5
    public function BookingShipping($bookedId)
    {
            $this->getSeedBookingContent($bookedId,"Order &oid& Shipment Started");
                return 1;
    }
    
    // Notify user, partner when booking is Delivered status = 6
    public function BookingDelivered($bookedId)
    {
            $this->getSeedBookingContent($bookedId,"Order &oid& Delivered");
                return 1;
    }
    
    /************************************ Emails related to Seed Bookings end here ************************************************/
    
    
    /************************************ Emails related to Feed Bookings start here ************************************************/
        //Notify user and partner when booking is placed status = 0
        public function productDealBookConfiramtion($bookedId)
        {
                $this->getFeedBookingContent($bookedId,"Order &oid& Placed");
                return 1;
        }
        
        // Notify user, partner when product booking is completed status = 2
        public function ProductBookingComplted($bookedId)
        {
                $this->getFeedBookingContent($bookedId,"Order &oid& Completed");
                return 1;
        }
        
        // Notify user, owner when product booking is cancelled
        public function FeedBookingCancellation($bookedId)
        {
                $this->getFeedBookingContent($bookedId,"Order &oid& Cancelled");
                return 1;
        }
    
    // Notify user, owner when product booking is processing
        public function FeedBookingProcessing($bookedId)
        {
                $this->getFeedBookingContent($bookedId,"Order &oid& Confirmed");
                return 1;
        }
    
    // Notify user, owner when product booking shipment is started
        public function FeedBookingShipment($bookedId)
        {
                $this->getFeedBookingContent($bookedId,"Order &oid& Shipment Started");
                return 1;
        }
        
        // Notify user, owner when product booking is delivered
        public function FeedBookingDeliver($bookedId)
        {
                $this->getFeedBookingContent($bookedId,"Order &oid& Delivered");
                return 1;
        }
        
    //Email content realted to feed bookings 
    function getFeedBookingContent($bookedId,$bstatus)
    {
            $CI = & get_instance();
                $query = $CI->db->query("SELECT * from ad_feed_bookings where id = $bookedId");
                $book_id = $query->row('booking_id');
                $bstatus = str_replace('&oid&',"#$book_id",$bstatus);
                //Send email to user
        $userEmail = $this->userBookingContent($bookedId,1);
        $user_email_flag = $this->getValue('ad_users','email_flag','id',$query->row('user_id'));
                if($user_email_flag==1)
                {
                        $res = $this->send($this->getValue('ad_users','email','id',$query->row('user_id')),$bstatus,$userEmail,1,3);
                }
                if($user_email_flag==0)
                {
                        $res = $this->send('help.aquadeals@gmail.com',$bstatus,$userEmail,1);
                }
        //Send email to partner
        $partnerEmail = $this->sellerBookingContent($bookedId,1);
        $notify_deals = $this->getValue('ad_sellers','notify_deals','id',$query->row('seller_id'));
        $sel_email_flag = $this->getValue('ad_sellers','email_flag','id',$query->row('seller_id'));
                if($sel_email_flag==1 && $notify_deals == 1)
                {
                        $res1 = $this->send($this->getValue('ad_sellers','email','id',$query->row('seller_id')),$bstatus,$partnerEmail,2,3);
                }
               if($sel_email_flag==0)
                {
                        $res1 = $this->send('partner.aquadeals@gmail.com',$bstatus,$partnerEmail,2);
                }
    }
    
    //Email content realted to feed bookings 
    function getSeedBookingContent($bookedId,$bstatus)
    {
            $CI = & get_instance();
                $query = $CI->db->query("SELECT * from ad_bookings where id = $bookedId");
                $book_id = $query->row('booking_id');
                $bstatus = str_replace('&oid&',"#$book_id",$bstatus);
                //Send email to user
        $userEmail = $this->userBookingContent($bookedId,0);
        $user_email_flag = $this->getValue('ad_users','email_flag','id',$query->row('user_id'));
               if($user_email_flag==1)
                {
                        $res = $this->send($this->getValue('ad_users','email','id',$query->row('user_id')),$bstatus,$userEmail,1,3);
                }
                if($user_email_flag==0)
                {
                        $res = $this->send('help.aquadeals@gmail.com',$bstatus,$userEmail,1);
                }
        //Send email to partner
        $partnerEmail = $this->sellerBookingContent($bookedId,0);
        $sel_email_flag = $this->getValue('ad_sellers','email_flag','id',$query->row('seller_id'));
                if($sel_email_flag==1)
                {
                        $res1 = $this->send($this->getValue('ad_sellers','email','id',$query->row('seller_id')),$bstatus,$partnerEmail,2,3);
                }
               if($sel_email_flag==0)
                {
                        $res1 = $this->send('partner.aquadeals@gmail.com',$bstatus,$partnerEmail,2);
                }
    }
    
    function userBookingContent($bookingId,$book_type)
    {
                $ttl_paid='';
                $img_url = "http://aqua.deals/admin/assets/email_imgs";
                $CI = & get_instance();//Get global functions
                $helpline_qry= $CI->db->query("SELECT value FROM `ad_settings` WHERE `key`='aquadeals_helpline'");
                                $ad_helpline = $helpline_qry->row('value');
                //getting Booking data
                if($book_type==1)
                {
                    $query = $CI->db->query("SELECT * from ad_feed_bookings where id = $bookingId");
                    $pay_at = "Pay At Outlet";
                }
                else
                {
                     $query = $CI->db->query("SELECT * from ad_bookings where id = $bookingId");
                     $pay_at = "Pay At Hatchery";
                } 
                //Id's related to user seller deal product etc
                $user_id =  $query->row('user_id');
                $manuf_id =  $query->row('seller_id');
                $booking_id =  $query->row('booking_id');
                $status =  $query->row('status');
                $cart = $query->row('is_cart');
                $mode = $query->row('mode');
                $complt_prc_id = $query->row('feedback_id');
                //User Details
                $username = $this->getValue('ad_users','name','id',$user_id);
                $useremail = $this->getValue('ad_users','email','id',$user_id);
                //manuf data
                $manfname = $this->getValue('ad_sellers','seller_name','id',$manuf_id);
                $manfemail = $this->getValue('ad_sellers','email','id',$manuf_id);
                $manfmobile = $this->getValue('ad_sellers','mobile','id',$manuf_id);
                $cperson = $this->getValue('ad_sellers','contact_person','id',$manuf_id);
                $hatchadd  = $this->getValue('ad_sellers','address','id',$manuf_id);
                $hatchlocation = $this->getValue('ad_sellers','location','id',$manuf_id);
                $h = explode(', ', $hatchlocation);
                $hcount = count($h);
                if($hcount < 3)
                {
                        if($hcount >= 2)
                        {
                                $hloc1= $h[0].",";
                                $hloc2 = $h[1].".";
                                $hloc3 = '';
                        }
                        if($hcount < 2)
                        {
                                $hloc1= $h[0].".";
                                $hloc2 ='';
                                $hloc3 = '';
                        }
                }
                else
                {
                        $hloc1= $h[0].",";
                        $hloc2= $h[1].",";
                        $hloc3 = $h[2].".";
                }
                //Booking details to integrate
                if($mode==1)
                {
                        $trans_type='Offline';
                }
                if($mode==2)
                {
                        $trans_type='Online';
                }
                if($mode==3)
                {
                        $trans_type='Online';
                }
                if($mode==0)
                {
                        $trans_type='Offline';
                }
                
                 //Cancelation details
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
                if($book_type==1)
                {
                        $cby = $this->getValue('ad_feed_bookings','cancelled_by','id',$bookingId);
                        $rem_amt = $query->row('amount_pay_manufacturer');
                }
                else
                {
                        $cby = $this->getValue('ad_bookings','cancelled_by','id',$bookingId);
                        $rem_amt = $query->row('amount_pay_hatchery');
                }
                if($cby==1)
                {
                        $user_cancelby = "AquaDeals";
                        
                }
                if($cby==2)
                {
                        $user_cancelby = ucfirst($manfname)."[ Seller ]";
                        
                }
                 if($cby==0)
                {
                        $user_cancelby = ucfirst($username)."[ Self ]";
                        
                }
                if($cby==3)
                {
                        $user_cancelby = $this->getValue('ad_access_sellers','name','id',$query->row('cancelled_by_id'))."[ Access Person ]";
                        
                }
                //Integrating into emails start here//
                if($status==0)//placed
                {
                        $status_msg = "Thank you for your order. Your order is sent to our Partner for confirmation.";
                        $status_img =  "placed.png";
                        $status_color = "#0088cc";
                        $grand_ttl_msg = "Grand Total";
                }
                if($status==1)//processing
                {
                        $status_msg = "Your order ".$booking_id." is confirmed now. We will notify you once your order ships";
                        $status_img =  "process.png";
                        $status_color = "#f15a25";
                        $grand_ttl_msg = "Grand Total";
                }
                if($status==2)//completed
                {
                        $status_msg = "Your order ".$booking_id." is completed successfully. Share your experience on this order through your rating";
                        $status_img =  "complete.png";
                        $status_color = "#289f07";
                        $complt_prc = $this->getValue('ad_booking_feedback','reason','id',$complt_prc_id);
                        $grand_ttl_msg = "Grand Total(".$complt_prc.")";
                }
                if($status==3)//Cancelled
                {
                        $status_msg = "Your order  is cancelled";
                        $status_img =  "cancel.png";
                        $status_color = "#d2322d";
                        $grand_ttl_msg = "Grand Total";
                }
                if($status==4)//Assigned
                {
                        $status_msg = "";
                        $status_img =  "";
                        $status_color = "";
                        $grand_ttl_msg = "Grand Total";
                }
                if($status==5)//Shipped
                {
                        $status_msg = "We thought you'd like to know that our Partner has dispatched your item(s). Your order is on the way.";
                        $status_img =  "ship.png";
                        $status_color = "#2f4f4f";
                        $grand_ttl_msg = "Grand Total";
                }
                if($status==6)//Delivered
                {
                        $status_msg = "Your order  is delivered successfully.";
                        $status_img =  "deliver.png";
                        $status_color = "#6495ed";
                        $grand_ttl_msg = "Grand Total";
                }
$UserEmailContent='
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width" />

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" /> 
<title>AquaDeals</title>
<style>

ul, li, img, span, p, h1, h2, h3, h4, h5, h6{padding: 0;margin: 0;}
img{max-width: 100%;}
.clr{clear:both;}
.book_dtl_one, .book_dtl_two, .book_dtl_three, .book_dtl_four{float: left;width: 25%;border-right: 1px solid #c5c5c5; padding: 20px 10px 20px 10px;}
.status_txt{background: url('.$img_url.'/'.$status_img.') no-repeat;padding-bottom: 10px;padding-left: 40px;padding-top: 6px;}
.tot_pag{width: 80%;}
.foter{overflow: hidden;width: 80%;margin: 30px auto;}
.thnks_blk_emty {width: 100%;}
.pro_dtls tr td{border-top: 1px dotted #b2b2b2;}
.pro_dtls_empt td{border-top: none!important;}
/* responsive */

/*1599 to 1440 */
@media (max-width: 1599px) {}
/*1439 to 1360 */
@media (max-width: 1439px) {}
/*1359 to 1280 */
@media (max-width: 1359px) {}
/*1279 to 1152 */
@media (max-width: 1279px) {
.book_dtl{padding: 20px 30px;}
}
/*1151 to 1024 */
@media (max-width: 1151px) {}
/*1023 to 970 */
@media (max-width: 1023px) {
.book_dtl{padding: 20px 20px;}
}
/*969 to 800 */
@media (max-width: 969px) {
.book_dtl_one, .book_dtl_two, .book_dtl_three, .book_dtl_four{float: left;width: 50%;border-right: 1px solid #c5c5c5!important;
border-top:1px solid #c5c5c5!important;}
.book_dtl_one{border-top: none!important;}
.book_dtl_two{border-right: none!important;border-top: none!important;}
.book_dtl_four{border-right: none!important;}
}
/*799 to 768 */
@media (max-width: 799px) {}
/*767 to 736 */
@media (max-width: 767px) {}
/*735 to 667 */
@media (max-width: 667px) {}
/*666 to 600 */
@media (max-width: 666px) {}
/*599 to 568 */
@media (max-width: 599px) {
.tot_pag{width: 90%;}
.foter{width: 90%;}
.thnks_blk_emty {display: none;}
.thnks_blk {width: 100%;}
}
/*567 to 480  */
@media (max-width: 567px) {}
/*479 to 414  */
@media (max-width: 479px) {
.book_dtl_one, .book_dtl_two, .book_dtl_three, .book_dtl_four{width: 100%;border-top: none!important;border-right: none!important;border-bottom: 1px solid #c5c5c5!important;}
.book_dtl_four{border-top: none!important;border-right: none!important;border-bottom: none!important;}
}
/*413 to 375*/
@media (max-width: 413px) {}
/*374 to 320*/
@media (max-width: 374px) {}

</style>
</head>

<body style="background: #eeeeee;font-family: arial;">
<div class="tot_pag" style="border-radius: 5px;background: #fff;margin: 30px auto;padding: 20px;">
<div style="width: 100%;text-align: center;margin: 30px 0;"> <a href="#"> <img src="'.$img_url .'/logo.png" /> </a> </div>
<h1 style="font-size: 15px;color: #333;text-align: left;">Dear '.$username.',</h1>
<div style="margin: 15px 0;overflow: hidden;padding: 20px 0;">
<h2 class="status_txt" style="font-size: 14px; color: '.$status_color.';float: left;">
'.$status_msg.'</h2>
</div>

<div style="position: relative;margin: 30px 0;">

<div style="position: absolute;left: 0;right: 0;top: -25px;text-align: center;z-index: 999;width: -moz-fit-content;
width: -webkit-fit-content;margin: 0 auto">
    <h1 style="font-size: 18px;color: #333;background: #fff;padding: 10px 15px;">Order Details</h1>
    </div>
    <div style="border-top: 2px solid #303030;position: absolute;bottom: 0;width: 100%;"></div>
</div>
<div style="clear: both">&nbsp;</div>
<table border="0" cellpadding="0" cellspacing="0" style="width: 100%; background: #f6f6f6;padding: 20px;margin-top: 20px;">
    <tbody>
        <tr>
            <td>
                <table border="0" cellpadding="0" cellspacing="0" style="margin: 0px auto;" class="book_dtl_one">
                    <tbody>
                        <tr>
                            <td rowspan="2" style="width:28px;padding-right:80px"> <img style="position: relative;top: -5px;padding-right: 15px;" src="'.$img_url.'/booking_id_icon.png" /> </td>
                            <td style="font-size: 14px;font-weight: bold; color: #666;">Order Id</td>
                        </tr>
                        <tr><td style="font-size: 15px;font-weight: normal; color: #333;">'.$query->row('booking_id').'</td></tr>
                    </tbody>
                </table>
    
                <table border="0" cellpadding="0" cellspacing="0" style="margin: 0px auto;" class="book_dtl_two">
                    <tbody>
                        <tr>
                            <td rowspan="2" style="width:28px;padding-right:80px"> <img style="position: relative;top: -5px;padding-right: 15px;" src="'.$img_url.'/booking_date_icon.png" /> </td>
                            <td style="font-size: 14px;font-weight: bold; color: #666;">Ordered Date</td>
                        </tr>
                        <tr><td style="font-size: 15px;font-weight: normal; color: #333;">'.date('d-m-Y',strtotime($query->row('created_on'))).'</td></tr>
                    </tbody>
                </table>
    
                <table border="0" cellpadding="0" cellspacing="0" style="margin: 0px auto;" class="book_dtl_three">
                    <tbody>
                        <tr>
                            <td rowspan="2" style="width:28px;padding-right:80px"> <img style="position: relative;top: -5px;padding-right: 15px;" src="'.$img_url.'/payment_mode_icon.png" /> </td>
                            <td style="font-size: 14px;font-weight: bold; color: #666;">Payment Mode</td>
                        </tr>
                        <tr><td style="font-size: 15px;font-weight: normal; color: #333;">'.$trans_type.'</td></tr>
                    </tbody>
                </table>';
                                if($mode!=3)
                                {
                $UserEmailContent.='<table border="0" cellpadding="0" cellspacing="0" style="margin: 0px auto;border:none;" class="book_dtl_four">
                    <tbody>
                        <tr>
                            <td rowspan="2" style="width:28px;padding-right:80px"> <img style="position: relative;top: -5px;padding-right: 15px;" src="'.$img_url.'/payment_icon.png" /> </td>
                            <td style="font-size: 14px;font-weight: bold; color: #666;">'.$pay_at.'</td>
                        </tr>';
                        if($book_type==1)
                        {
                        
                        $UserEmailContent.='<tr><td style="font-size: 15px;font-weight: normal; color: #333;">&#8377; '.str_replace('.00','',money_format('%!i', $query->row('amount_pay_manufacturer'))).'</td></tr>';
                        }
                        else
                        {
                        
                        $UserEmailContent.='<tr><td style="font-size: 15px;font-weight: normal; color: #333;">&#8377; '.str_replace('.00','',money_format('%!i', $query->row('amount_pay_hatchery'))).'</td></tr>';
                        }
                    $UserEmailContent.='</tbody>
                </table>';
                }
                                else
                                {
                                if($book_type==1)
                                {
                                        if($query->row('amount_pay_manufacturer')!=0)
                                        {
                                                $UserEmailContent.='<table border="0" cellpadding="0" cellspacing="0" style="margin: 0px auto;border:none;" class="book_dtl_four">
                                                <tbody>
                                                <tr>
                                                <td rowspan="2" style="width:28px;padding-right:80px"> <img style="position: relative;top: -5px;padding-right: 15px;" src="'.$img_url.'/payment_icon.png" /> </td>
                                                <td style="font-size: 14px;font-weight: bold; color: #666;">'.$pay_at.'</td>
                                                </tr>
                                                <tr><td style="font-size: 15px;font-weight: normal; color: #333;">&#8377; '.str_replace('.00','',money_format('%!i', $query->row('amount_pay_manufacturer'))).'</td></tr>
                                                </tbody>
                                                </table>';
                                        }
                                        else
                                        {
                                                $UserEmailContent.='<table border="0" cellpadding="0" cellspacing="0" style="margin: 0px auto;border:none;" class="book_dtl_four">
                                                <tbody>
                                                <tr>
                                                <td rowspan="2" style="width:28px;padding-right:80px"> <img style="position: relative;top: -5px;padding-right: 15px;" src="'.$img_url.'/payment_icon.png" /> </td>
                                                <td style="font-size: 14px;font-weight: bold; color: #666;">'.$pay_at.'</td>
                                                </tr>
                                                <tr><td style="font-size: 15px;font-weight: normal; color: #333;">Total Amount Paid</td></tr>
                                                </tbody>
                                                </table>';
                                        }
                                }
                                else
                                {
                                if($query->row('amount_pay_hatchery')!=0)
                                {
                                $UserEmailContent.='<table border="0" cellpadding="0" cellspacing="0" style="margin: 0px auto;border:none;" class="book_dtl_four">
                                                <tbody>
                                                <tr>
                                                <td rowspan="2" style="width:28px;padding-right:80px"> <img style="position: relative;top: -5px;padding-right: 15px;" src="'.$img_url.'/payment_icon.png" /> </td>
                                                <td style="font-size: 14px;font-weight: bold; color: #666;">'.$pay_at.'</td>
                                                </tr>
                                                <tr><td style="font-size: 15px;font-weight: normal; color: #333;">&#8377; '.str_replace('.00','',money_format('%!i', $query->row('amount_pay_hatchery'))).'</td></tr>
                                                </tbody>
                                                </table>';
                                }
                                else
                                {
                                $UserEmailContent.='<table border="0" cellpadding="0" cellspacing="0" style="margin: 0px auto;border:none;" class="book_dtl_four">
                                <tbody>
                                <tr>
                                <td rowspan="2" style="width:28px;padding-right:80px"> <img style="position: relative;top: -5px;padding-right: 15px;" src="'.$img_url.'/payment_icon.png" /> </td>
                                <td style="font-size: 14px;font-weight: bold; color: #666;">'.$pay_at.'</td>
                                </tr>
                                <tr><td style="font-size: 15px;font-weight: normal; color: #333;">Total Amount Paid</td></tr>
                                </tbody>
                                </table>';
                                }
                                }


                                }
            $UserEmailContent.='</td>

        </tr>
    </tbody>
</table>
<div style="clear: both">&nbsp;</div>
<table border="0" cellpadding="0" cellspacing="0" style="width: 100%; margin-top: 15px;text-align: left;" >
    <thead>';
    if($book_type==1)
    {
        $UserEmailContent.='<tr>
            <td style="font-size: 14px; color: #666;font-weight: normal;">Product Name</td>
            <td style="font-size: 14px; color: #666;font-weight: normal;">Quantity</td>';
            if($status==0)
            {
            $UserEmailContent.='<td style="font-size: 14px; color: #666;font-weight: normal;text-align:left;">Price</td>';
            }
        $UserEmailContent.='</tr>';
    }
    else
    {
        $UserEmailContent.='<tr>
            <td style="font-size: 14px; color: #666;font-weight: normal;">Species</td>
            <td style="font-size: 14px; color: #666;font-weight: normal;">Quantity</td>';
            if($status==0)
            {
            $UserEmailContent.='<td style="font-size: 14px; color: #666;font-weight: normal;text-align:left;">Price</td>';
            }
        $UserEmailContent.='</tr>';
    }
    $UserEmailContent.='</thead>
    <tbody class="pro_dtls">
    <tr class="pro_dtls_empt"><td colspan="3">&nbsp;</td></tr>';
            if($cart==0){
            
                    if($book_type==1)
                    {
                            $pro_id = $this->getValue('ad_manuf_deals','product_id','id',$query->row('deal_id'));
                        $product = $this->getValue('ad_manuf_products','title','id',$pro_id);
                        $qty = $query->row('quantity');
                        $units_id =  $this->getValue('ad_manuf_products','units_id','id',$pro_id);
                                $packing_id =  $this->getValue('ad_manuf_products','packing_size_id','id',$pro_id);
                                $pqty =  $this->getValue('ad_manuf_products','quantity','id',$pro_id);
                                $packs = $this->getValue('ad_packging_types','packging_type','id',$packing_id);
                                $units = $this->getValue('ad_units','unit_name','id',$units_id);
                                if($packs!="N/A")
                                {
                                $totqty = $pqty."".$units." ".$packs." x ".$qty." quantity";
                                }
                                else
                                {
                                $totqty = $pqty."".$units." x ".$qty." quantity";
                                }
                                $prebook_amt = $query->row('pre_booking_amount');
                                
                        if($query->row('deal_price')!=0)
                        {
                        $ac_apply = $qty*($query->row('mrp')-$query->row('deal_price'));
                        $amt1 = $qty*$query->row('mrp');
                        $amt = $amt1-$ac_apply;
                        }
                        else
                        {
                        $ac_apply = 'N/A';
                        $amt = $qty*$query->row('mrp');
                        $amt1 = $qty*$query->row('mrp');
                        }
                        if($mode==1)
                        {
                                $grnd_ttl = $query->row('amount_pay_manufacturer');
                        }
                        if($query->row('pre_booking_amount')!=0 && $mode==2 )
                        {
                                $grnd_ttl = $query->row('amount_pay_manufacturer');
                        }
                        if($mode==3)
                        {
                                if($query->row('amount_pay_manufacturer')==0)
                                {
                                        $grnd_ttl = $query->row('total_online_payment');
                                        $ttl_paid = "[ Total Paid ]";
                                }
                                else
                                {
                                        $grnd_ttl = $query->row('amount_pay_manufacturer');
                                }
                        }
                        //end
                        $pay_at_hatch_out = $query->row('amount_pay_manufacturer');
                }
                else
                {
                        $species_id = $this->getValue('ad_vendor_deals','species_id','id',$query->row('deal_id'));
                        $product = $this->getValue('ad_species','type','id',$species_id);
                        $totqty = $query->row('quantity');
                        $prebook_amt = $query->row('prebook_amt');
                        
                        if($query->row('discount_price')!=0)
                        {
                        $ac_apply = $totqty*($query->row('price')-$query->row('discount_price'));
                        $amt1 = $totqty*$query->row('price');
                        $amt= $amt1-$ac_apply;
                        }
                        else
                        {
                        $ac_apply ='N/A';
                        $amt = $totqty*$query->row('price');
                        $amt1 = $totqty*$query->row('price');
                        }
                        if($mode==1)
                        {
                                $grnd_ttl = $query->row('amount_pay_hatchery');
                        }
                        if($query->row('prebook_amt')!=0 && $mode==2 )
                        {
                                $grnd_ttl = $query->row('amount_pay_hatchery');
                        }
                        if($mode==3)
                        {
                                if($query->row('amount_pay_hatchery')==0)
                                {
                                        $grnd_ttl = $query->row('total_online_payment');
                                        $ttl_paid = "[ Total Paid ]";
                                }
                                else
                                {
                                        $grnd_ttl = $query->row('amount_pay_hatchery');
                                }
                        }
                        //end
                        $pay_at_hatch_out = $query->row('amount_pay_hatchery');
                        
                }
        $UserEmailContent.='<tr>
            <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.ucfirst($product).'</td>
            <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.$totqty.' </td>';
            if($status==0)
            {
            $UserEmailContent.='<td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;text-align:left;">&#8377; '.str_replace('.00','',money_format('%!i', $amt1)).' </td>';
            }
        $UserEmailContent.='</tr>';
        if($status==0)
        {
        $UserEmailContent.='<tr>
            <td colspan="1" style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;"></td>
            <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">Total</td>
            <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;text-align:left;">&#8377; '.str_replace('.00','',money_format('%!i', $amt1)).' </td>
        </tr>';
        if($query->row('aqua_cash') > 0)
        {
        $UserEmailContent.='<tr>
            <td colspan="1" style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;"></td>
            <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">AquaCash Applied</td>
            <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;text-align:left;">(-) &#8377; '.str_replace('.00','',money_format('%!i', $query->row('aqua_cash'))).'</td>
        </tr>';
        }
        if(($query->row('applied_coupons')!='' || $query->row('coupon_code')!=''))
        {
        $UserEmailContent.='<tr>
            <td colspan="1" style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;"></td>
            <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;"><b>Coupons Applied</b></td>
            <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;text-align:left;"></td>
        </tr>';
        if($query->row('coupon_code')!='')
        {
        
        $UserEmailContent.='<tr>
            <td colspan="1" style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;"></td>
            <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.$query->row('coupon_code').'</td>
            <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;text-align:left;">(-) &#8377; '.str_replace('.00','',money_format('%!i', $query->row('coupon_amount'))).'</td>
        </tr>';
        }
        if($query->row('applied_coupons')!='')
        {
        $applied_coupons = explode(',', $query->row('applied_coupons'));
        foreach($applied_coupons as $apl_copons)
        {
        $d = explode('|',$apl_copons);
                $apl_copon =  $d[0];
                $cpn_amt = $d[1];
                $UserEmailContent.='<tr>
            <td colspan="1" style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;"></td>
            <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.$apl_copon.'</td>
            <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;text-align:left;">(-) &#8377; '.str_replace('.00','',money_format('%!i', $cpn_amt)).'</td>
        </tr>';
        }
    }
        }
        if($prebook_amt!=0)
        {
        $UserEmailContent.='<tr>
            <td colspan="1" style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;"></td>
            <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">Prebook Amount</td>
            <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;text-align:left;">(-) &#8377; '.str_replace('.00','',money_format('%!i', $prebook_amt)).'</td>
        </tr>';
        }
        if($mode==3  && $pay_at_hatch_out!=0)
                {
                        $UserEmailContent.='<tr>
                        <td colspan="1" style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;"></td>
                        <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">Amount Paid At Online</td>
                        <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;text-align:left;">
                        (-) &#8377; '.str_replace('.00','',money_format('%!i', $query->row('total_online_payment'))).'</td>
                        </tr>';   
                }
        $UserEmailContent.='<tr>
            <td colspan="1" style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;"></td>
            <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.$grand_ttl_msg.'</td>
            <td style="font-size: 18px; color: #333;font-weight: bold;padding: 10px 0px;border-top: 1px dotted #b2b2b2;text-align:left;">&#8377; '.str_replace('.00','',money_format('%!i', $grnd_ttl)).''.$ttl_paid.'</td>
        </tr>';
        }
        }
        else
        {
        
        $qry = $CI->db->query("SELECT * FROM `ad_cart_bookings` WHERE booking_id = '".$booking_id."'"); 
        $total = '';
        $ac_apply = '';
        
        foreach($qry->result() as $prow)
        {
                if($book_type==1)
                {
                        $pro_id = $this->getValue('ad_manuf_deals','product_id','id',$prow->deal_id);
                        $product = $this->getValue('ad_manuf_products','title','id',$pro_id);
                        $qty = $prow->quantity;
                        $units_id =  $this->getValue('ad_manuf_products','units_id','id',$pro_id);
                                $packing_id =  $this->getValue('ad_manuf_products','packing_size_id','id',$pro_id);
                                $pqty =  $this->getValue('ad_manuf_products','quantity','id',$pro_id);
                                $packs = $this->getValue('ad_packging_types','packging_type','id',$packing_id);
                                $units = $this->getValue('ad_units','unit_name','id',$units_id);
                                if($packs!="N/A")
                                {
                                $totqty = $pqty."".$units." ".$packs." x ".$qty." quantity";
                                }
                                else
                                {
                                $totqty = $pqty."".$units." x ".$qty." quantity";
                                }
                               
                        if($prow->deal_price!=0)
                        {
                                        $ac_apply1 = $qty*($prow->mrp-$prow->deal_price);
                                        $ac_apply2 = $qty*($prow->mrp-$prow->deal_price);
                                        $amt1 = $qty*$prow->mrp;
                                        $amt = $amt1-$ac_apply2;
                                }
                        else
                        {
                                $ac_apply1 ='N/A';
                                $ac_apply2 =0;
                                        $amt = $qty*$prow->mrp;
                                        $amt1 = $qty*$prow->mrp;
                        }
                        $total = $total+$amt1;
                        $ac_apply = $ac_apply+$ac_apply2;
                $UserEmailContent.='<tr>
                    <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.ucfirst($product).'</td>
                    <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.$totqty.'</td>';
                    if($status==0)
                    {
                    $UserEmailContent.='<td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;text-align:left">&#8377; '.str_replace('.00','',money_format('%!i', $amt1)).'</td>';
                    }
                        $UserEmailContent.='</tr>';
                        
                }
                else
                {
                        $species_id = $this->getValue('ad_vendor_deals','species_id','id',$prow->deal_id);
                        $product = $this->getValue('ad_species','type','id',$species_id);
                        $qty = $prow->quantity;
                                if($prow->deal_price!=0)
                                {
                                $ac_apply1 = $qty*($prow->mrp-$prow->deal_price);
                                $ac_apply2 = $qty*($prow->mrp-$prow->deal_price);
                                $amt1 = $qty*$prow->mrp;
                                $amt= $amt1-$ac_apply2;
                                }
                                else
                                {
                                $ac_apply1 ='N/A';
                                $ac_apply2 =0;
                                $amt = $totqty*$prow->price;
                                $amt1 = $totqty*$prow->price;
                                }
                        $total = $total+$amt1;
                        $ac_apply = $ac_apply+$ac_apply2;
                $UserEmailContent.='<tr>
                    <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.ucfirst($product).'</td>
                    <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.$qty.'</td>';
                    if($status==0)
                    {
                   $UserEmailContent.='<td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;text-align:left;">&#8377; '.str_replace('.00','',money_format('%!i', $amt1)).'</td>';
                   }
                        $UserEmailContent.='</tr>';
                }
        }
        if($book_type==1)
        {
                        $prebook_amt = $query->row('pre_booking_amount');
                                 if($mode==1)
                        {
                                $grnd_ttl = $query->row('amount_pay_manufacturer');
                        }
                        if($query->row('pre_booking_amount')!=0 && $mode==2 )
                        {
                                $grnd_ttl = $query->row('amount_pay_manufacturer');
                        }
                        if($mode==3)
                        {
                                if($query->row('amount_pay_manufacturer')==0)
                                {
                                        $grnd_ttl = $query->row('total_online_payment');
                                        $ttl_paid = "[ Total Paid ]";
                                }
                                else
                                {
                                        $grnd_ttl = $query->row('amount_pay_manufacturer');
                                }
                        }
                        $pay_at_hatch_out = $query->row('amount_pay_manufacturer');
        }
        else
        {
                 $prebook_amt = $query->row('prebook_amt');
                 if($mode==1)
                        {
                                $grnd_ttl = $query->row('amount_pay_hatchery');
                        }
                        if($query->row('prebook_amt')!=0 && $mode==2 )
                        {
                                $grnd_ttl = $query->row('amount_pay_hatchery');
                        }
                        if($mode==3)
                        {
                                if($query->row('amount_pay_hatchery')==0)
                                {
                                        $grnd_ttl = $query->row('total_online_payment');
                                        $ttl_paid = "[ Total Paid ]";
                                }
                                else
                                {
                                        $grnd_ttl = $query->row('amount_pay_hatchery');
                                }
                        }
                        $pay_at_hatch_out = $query->row('amount_pay_hatchery');
                        
        }
        
                if($status==0)
                {
        $UserEmailContent.='<tr>
            <td colspan="1" style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;"></td>
            <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">Total</td>
            <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;text-align:left;">&#8377; '.str_replace('.00','',money_format('%!i', $total)).'</td>
        </tr>';
        if($query->row('aqua_cash') > 0 )
        {
        $UserEmailContent.='<tr>
            <td colspan="1" style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;"></td>
            <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">Aquacash Applied</td>
            <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;text-align:left;">(-) &#8377; '.str_replace('.00','',money_format('%!i', $query->row('aqua_cash'))).'</td>
        </tr>';
        }
        if(($query->row('coupon_code')!='' || $query->row('applied_coupons')!=''))
        {
        $UserEmailContent.='<tr>
            <td colspan="1" style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;"></td>
            <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;"><b>Coupons Applied</b></td>
            <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;text-align:left;"></td>
        </tr>';
        if($query->row('coupon_code')!='')
        {
        
        $UserEmailContent.='<tr>
            <td colspan="1" style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;"></td>
            <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.$query->row('coupon_code').'</td>
            <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;text-align:left;">(-) &#8377; '.str_replace('.00','',money_format('%!i', $query->row('coupon_amount'))).'</td>
        </tr>';
        }
        $applied_coupons = explode(',', $query->row('applied_coupons'));
        foreach($applied_coupons as $apl_copons)
        {
        $d = explode('|',$apl_copons);
                $apl_copon =  $d[0];
                $cpn_amt = $d[1];
                $UserEmailContent.='<tr>
            <td colspan="1" style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;"></td>
            <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.$apl_copon.'</td>
            <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;text-align:left;">(-) &#8377; '.str_replace('.00','',money_format('%!i', $cpn_amt)).'</td>
        </tr>';
        }
        }
        if($prebook_amt!=0)
        {
        $UserEmailContent.='<tr>
            <td colspan="1" style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;"></td>
            <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">Prebook Amount</td>
            <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;text-align:left;">(-) &#8377; '.str_replace('.00','',money_format('%!i', $prebook_amt)).'</td>
        </tr>';
        }
        if($mode==3  && $pay_at_hatch_out!=0)
                {
                        $UserEmailContent.='<tr>
                        <td colspan="1" style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;"></td>
                        <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">Amount Paid At Online</td>
                        <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;text-align:left;">
                        (-) &#8377; '.str_replace('.00','',money_format('%!i', $query->row('total_online_payment'))).'</td>
                        </tr>';   
                }
        $UserEmailContent.='<tr>
            <td colspan="1" style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;"></td>
            <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.$grand_ttl_msg.'</td>
            <td style="font-size: 18px; color: #333;font-weight: bold;padding: 10px 0px;border-top: 1px dotted #b2b2b2;text-align:left;">&#8377; '.str_replace('.00','',money_format('%!i', $grnd_ttl)).''.$ttl_paid.' </td>
        </tr>';
        }
        }
                if($status==3)
                {
                $UserEmailContent.='<tr>
            <td colspan="1" style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;"></td>
            <td style="font-size: 14px; color: #d2322d;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">Reason for cancellation</td>
            <td style="font-size: 14px; color: #d2322d;font-weight: ;padding: 10px 0px;border-top: 1px dotted #b2b2b2;text-align:left;">'.ucfirst($creason).'</td>
        </tr>
        <tr>
            <td colspan="1" style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;"></td>
            <td style="font-size: 14px; color: #d2322d;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">Cancelled by</td>
            <td style="font-size: 14px; color: #d2322d;font-weight: ;padding: 10px 0px;border-top: 1px dotted #b2b2b2;font-style: italic;text-align:left;">'.ucfirst($user_cancelby).'</td>
        </tr>';
        }
    $UserEmailContent.='</tbody>
</table>';
        if($status!=2 && $status!=6 && $status!=3 && $query->row('rem_amt_flag')==0)
        {
        if($book_type==1)
        {
        $UserEmailContent.='<p style="font-size: 15px; color: #d8822d;font-style: italic;margin-top:10px;margin-bottom:-15px;text-align:left;">To pay  &#8377; '. str_replace('.00','',money_format('%!i', $rem_amt)).', go to Order details page and click "Pay now".</p>';
}       
else
{
        $UserEmailContent.='<p style="font-size: 15px; color: #d8822d;font-style: italic;margin-top:10px;margin-bottom:-15px;text-align:left;">To pay  &#8377; '. str_replace('.00','',money_format('%!i', $rem_amt)).', go to Order details page and click "Pay now".</p>';
}

        }
$UserEmailContent.='<ul style="list-style: none;text-align: center;margin: 50px 0 30px;padding: 20px 0;overflow: hidden;">';
        if($status!=2 && $status!=6 && $status!=3 && $query->row('rem_amt_flag')==0)
        {
        
    $UserEmailContent.='<li style="display: inline-block;"><a href="http://www.aqua.deals" style="background: #fff;border-radius: 3px;padding: 10px 20px;color: #333;text-decoration: none;border: 1px solid #ccc;font-size: 13px;">Pay Now</a></li>';
    }
    $UserEmailContent.='<li style="display: inline-block;margin-left: 10px;"><a href="http://www.aqua.deals" style="background: #f15a25;border-radius: 3px;padding: 10px 20px;color: #fff;text-decoration: none;box-shadow: 0px 0px 3px -1px #000;font-size: 13px;">More Details</a></li>
</ul>';

$UserEmailContent.='
<div style="clear: both">&nbsp;</div>
</div>
<div class="foter">
    <div style="float: left;">
        <h6 style="font-size: 15px;color: #333;margin: 0;">Download AquaDeals</h6>
                        <a href="https://play.google.com/store/apps/details?id=com.aquadeals.user" style="margin-top: 15px;display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/android_icon.png" /> </a>
                        </div>
                        <div style="float: right;">
                        <h6 style="font-size: 15px;color: #333;margin: 0;">Follow Us</h6>
                        <ul style="list-style: none;text-align: center;margin: 15px 0 0 0;padding: 0;">
                        <li style="float: left;"><a href="https://www.facebook.com/aquadealsstore/" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/fb_icon.png" /> </a></li>
                        <li style="float: right;"><a href="https://twitter.com/aquadealsstore" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/twitter_icon.png" /> </a></li>
                        </ul>
        
    </div>
</div>
</body>
</html>';
//Integrating to emails end here//
//echo  $UserEmailContent;
return $UserEmailContent;
    }
    
    
    function sellerBookingContent($bookingId,$book_type)
    {
             
               $ttl_paid='';
               $img_url = "http://aqua.deals/admin/assets/email_imgs";
                $CI = & get_instance();//Get global functions
                //getting Booking data
                if($book_type==1)
                {
                        $query = $CI->db->query("SELECT * from ad_feed_bookings where id = $bookingId");
                        $pay_at = "Pay At Outlet";
                }
                else
                {
                        $query = $CI->db->query("SELECT * from ad_bookings where id = $bookingId");
                        $pay_at = "Pay At Hatchery";
                } 
                //Id's related to user seller deal product etc
                $user_id =  $query->row('user_id');
                $seller_id =  $query->row('seller_id');
                $booking_id =  $query->row('booking_id');
                $status =  $query->row('status');
                $cart = $query->row('is_cart');
                $mode = $query->row('mode');
                $complt_prc_id = $query->row('feedback_id');
                //User Details
               $username = $this->getValue('ad_users','name','id',$user_id);
                $usermail = $this->getValue('ad_users','email','id',$user_id);
                $usermobile = $this->getValue('ad_users','mobile','id',$user_id);
                $useradd  = $this->getValue('ad_users','address1','id',$user_id);
                $userlocation = $this->getValue('ad_users','city','id',$user_id);
                $u = explode(', ', $userlocation);
                $ucount = count($u);
                //echo $s[0];
                if($ucount < 3)
                {
                        if($ucount >= 2)
                        {
                        $uloc1= $u[0].",";
                        $uloc2 = $u[1].".";
                        $uloc3 = '';
                        }
                        if($ucount < 2)
                        {
                                $uloc1= $u[0].".";
                                $uloc2 ='';
                                $uloc3 = '';
                        }
                }
                else
                {
                        $uloc1= $u[0].",";
                        $uloc2= $u[1].",";
                        $uloc3 = $u[2].".";
                }
                //manuf data
                $manfname = $this->getValue('ad_sellers','seller_name','id',$seller_id);
                $manfemail = $this->getValue('ad_sellers','email','id',$seller_id);
                //Booking details to integrate
                if($mode==1)
                {
                        $trans_type='Offline';
                }
                if($mode==2)
                {
                        $trans_type='Online';
                }
                if($mode==3)
                {
                        $trans_type='Online';
                }
                if($mode==0)
                {
                        $trans_type='Offline';
                }
                
                 //Cancelation details
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
                if($book_type==1)
                {
                        $cby = $this->getValue('ad_feed_bookings','cancelled_by','id',$bookingId);
                        $rem_amt = $query->row('amount_pay_manufacturer');
                }
                else
                {
                        $cby = $this->getValue('ad_bookings','cancelled_by','id',$bookingId);
                        $rem_amt = $query->row('amount_pay_hatchery');
                }
                if($cby==1)
                {
                        $user_cancelby = "AquaDeals";
                        
                }
                if($cby==2)
                {
                        $user_cancelby = ucfirst($manfname)."[ Self ]";
                        
                }
                 if($cby==0)
                {
                        $user_cancelby = ucfirst($username)."[ User ]";
                        
                }
                if($cby==3)
                {
                        $user_cancelby = $this->getValue('ad_access_sellers','name','id',$query->row('cancelled_by_id'))."[ Access Person ]";
                        
                }
                //Integrating into emails start here//
                if($status==0)//placed
                {
                        $status_msg = "Congratulations! You have received an order. Login AquaDeals Partner app to process it.";
                        $status_img =  "placed.png";
                        $status_color = "#0088cc";
                        $next_step='Confirm Order';
                        $grand_ttl_msg = "Grand Total";
                }
                if($status==1)//processing
                {
                        $status_msg = "You confirmed the order ";
                        $status_img =  "process.png";
                        $status_color = "#f15a25";
                        $next_step='Start Shipment';
                        $grand_ttl_msg = "Grand Total";
                }
                if($status==2)//completed
                {
                        $status_msg = "Your order is marked as complete";
                        $status_img =  "complete.png";
                        $status_color = "#289f07";
                        $next_step='More Details';
                        $complt_prc = $this->getValue('ad_booking_feedback','reason','id',$complt_prc_id);
                        $grand_ttl_msg = "Grand Total(".$complt_prc.")";
                }
                if($status==3)//Cancelled
                {
                        $status_msg = "Your order is cancelled";
                        $status_img =  "cancel.png";
                        $status_color = "#d2322d";
                        $next_step='More Details';
                        $grand_ttl_msg = "Grand Total";
                }
                if($status==4)//Assigned
                {
                        $status_msg = "";
                        $status_img =  "";
                        $status_color = "";
                }
                if($status==5)//Shipped
                {
                         $status_msg = "Order #".$booking_id." status has been changed to : Shipped";
                        $status_img =  "ship.png";
                        $status_color = "#2f4f4f";
                        $next_step='Deliver The Order';
                        $grand_ttl_msg = "Grand Total";
                }
                if($status==6)//Delivered
                {
                        $status_msg = "Order  is  delivered successfully.";
                        $status_img =  "deliver.png";
                        $status_color = "#6495ed";
                        $next_step='Complete Order';
                        $grand_ttl_msg = "Grand Total";
                }
$UserEmailContent='
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width" />
<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" /> 
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>AquaDeals</title>
<style>

ul, li, img, span, p, h1, h2, h3, h4, h5, h6{padding: 0;margin: 0;}
img{max-width: 100%;}
.clr{clear:both;}
.book_dtl_one, .book_dtl_two, .book_dtl_three, .book_dtl_four{float: left;width: 25%;border-right: 1px solid #c5c5c5; padding: 20px 10px 20px 10px;}
.status_txt{background: url('.$img_url.'/'.$status_img.') no-repeat;padding-bottom: 10px;padding-left: 40px;padding-top: 6px;}
.tot_pag{width: 80%;}
.foter{overflow: hidden;width: 80%;margin: 30px auto;}
.thnks_blk {width: 50%;}
.thnks_blk_emty {width: 100%;}
.pro_dtls tr td{border-top: 1px dotted #b2b2b2;}
.pro_dtls_empt td{border-top: none!important;}
/* responsive */

/*1599 to 1440 */
@media (max-width: 1599px) {}
/*1439 to 1360 */
@media (max-width: 1439px) {}
/*1359 to 1280 */
@media (max-width: 1359px) {}
/*1279 to 1152 */
@media (max-width: 1279px) {
.book_dtl{padding: 20px 30px;}
}
/*1151 to 1024 */
@media (max-width: 1151px) {}
/*1023 to 970 */
@media (max-width: 1023px) {
.book_dtl{padding: 20px 20px;}
}
/*969 to 800 */
@media (max-width: 969px) {
.book_dtl_one, .book_dtl_two, .book_dtl_three, .book_dtl_four{float: left;width: 50%;border-right: 1px solid #c5c5c5!important;
border-top:1px solid #c5c5c5!important;}
.book_dtl_one{border-top: none!important;}
.book_dtl_two{border-right: none!important;border-top: none!important;}
.book_dtl_four{border-right: none!important;}
}
/*799 to 768 */
@media (max-width: 799px) {}
/*767 to 736 */
@media (max-width: 767px) {}
/*735 to 667 */
@media (max-width: 667px) {}
/*666 to 600 */
@media (max-width: 666px) {}
/*599 to 568 */
@media (max-width: 599px) {
.tot_pag{width: 90%;}
.foter{width: 90%;}
.thnks_blk_emty {display: none;}
.thnks_blk {width: 100%;}
}
/*567 to 480  */
@media (max-width: 567px) {}
/*479 to 414  */
@media (max-width: 479px) {
.book_dtl_one, .book_dtl_two, .book_dtl_three, .book_dtl_four{width: 100%;border-top: none!important;border-right: none!important;border-bottom: 1px solid #c5c5c5!important;}
.book_dtl_four{border-top: none!important;border-right: none!important;border-bottom: none!important;}
}
/*413 to 375*/
@media (max-width: 413px) {}
/*374 to 320*/
@media (max-width: 374px) {}

</style>
</head>

<body style="background: #eeeeee;font-family: arial;">
<div class="tot_pag" style="border-radius: 5px;background: #fff;margin: 30px auto;padding: 20px;">
<div style="width: 100%;text-align: center;margin: 30px 0;"> <a href="#"> <img src="'.$img_url .'/slogo.png" /> </a> </div>
<h1 style="font-size: 15px;color: #333;text-align: left;">Dear '.$manfname.',</h1>
<div style="margin: 15px 0;overflow: hidden;padding: 20px 0;">
<h2 class="status_txt" style="font-size: 13px; color: '.$status_color.';float: left;">
'.$status_msg.'</h2>
</div>

<div style="position: relative;margin: 30px 0;">

<div style="position: absolute;left: 0;right: 0;top: -25px;text-align: center;z-index: 999;width: -moz-fit-content;
width: -webkit-fit-content;margin: 0 auto">
    <h1 style="font-size: 18px;color: #333;background: #fff;padding: 10px 15px;">Order Details</h1>
    </div>
    <div style="border-top: 2px solid #303030;position: absolute;bottom: 0;width: 100%;"></div>
</div>
<div style="clear: both">&nbsp;</div>
<table border="0" cellpadding="0" cellspacing="0" style="width: 100%; background: #f6f6f6;padding: 20px;margin-top: 20px;">
    <tbody>
        <tr>
            <td>
                <table border="0" cellpadding="0" cellspacing="0" style="margin: 0px auto;" class="book_dtl_one">
                    <tbody>
                        <tr>
                            <td rowspan="2" style="width:28px;padding-right:80px"> <img style="position: relative;top: -5px;padding-right: 15px;" src="'.$img_url.'/booking_id_icon.png" /> </td>
                            <td style="font-size: 14px;font-weight: bold; color: #666;">Order Id</td>
                        </tr>
                        <tr><td style="font-size: 15px;font-weight: normal; color: #333;">'.$query->row('booking_id').'</td></tr>
                    </tbody>
                </table>
    
                <table border="0" cellpadding="0" cellspacing="0" style="margin: 0px auto;" class="book_dtl_two">
                    <tbody>
                        <tr>
                            <td rowspan="2" style="width:28px;padding-right:80px"> <img style="position: relative;top: -5px;padding-right: 15px;" src="'.$img_url.'/booking_date_icon.png" /> </td>
                            <td style="font-size: 14px;font-weight: bold; color: #666;">Ordered Date</td>
                        </tr>
                        <tr><td style="font-size: 15px;font-weight: normal; color: #333;">'.date('d-m-Y',strtotime($query->row('created_on'))).'</td></tr>
                    </tbody>
                </table>
    
                <table border="0" cellpadding="0" cellspacing="0" style="margin: 0px auto;" class="book_dtl_three">
                    <tbody>
                        <tr>
                            <td rowspan="2" style="width:28px;padding-right:80px"> <img style="position: relative;top: -5px;padding-right: 15px;" src="'.$img_url.'/payment_mode_icon.png" /> </td>
                            <td style="font-size: 14px;font-weight: bold; color: #666;">Payment Mode</td>
                        </tr>
                        <tr><td style="font-size: 15px;font-weight: normal; color: #333;">'.$trans_type.'</td></tr>
                    </tbody>
                </table>';
                                if($mode!=3)
                                {
                $UserEmailContent.='<table border="0" cellpadding="0" cellspacing="0" style="margin: 0px auto;border:none;" class="book_dtl_four">
                    <tbody>
                        <tr>
                            <td rowspan="2" style="width:28px;padding-right:80px"> <img style="position: relative;top: -5px;padding-right: 15px;" src="'.$img_url.'/payment_icon.png" /> </td>
                            <td style="font-size: 14px;font-weight: bold; color: #666;">'.$pay_at.'</td>
                        </tr>';
                        if($book_type==1)
                        {
                        $UserEmailContent.='<tr><td style="font-size: 15px;font-weight: normal; color: #333;">&#8377; '.str_replace('.00','',money_format('%!i', $query->row('amount_pay_manufacturer'))).'</td></tr>';
                        }
                        else
                        {
                        $UserEmailContent.='<tr><td style="font-size: 15px;font-weight: normal; color: #333;">&#8377; '.str_replace('.00','',money_format('%!i', $query->row('amount_pay_hatchery'))).'</td></tr>';
                        }
                    $UserEmailContent.='</tbody>
                </table>';
                }
                else
                {
                        if($book_type==1)
                                {
                                        if($query->row('amount_pay_manufacturer')!=0)
                                        {
                                                $UserEmailContent.='<table border="0" cellpadding="0" cellspacing="0" style="margin: 0px auto;border:none;" class="book_dtl_four">
                                                <tbody>
                                                <tr>
                                                <td rowspan="2" style="width:28px;padding-right:80px"> <img style="position: relative;top: -5px;padding-right: 15px;" src="'.$img_url.'/payment_icon.png" /> </td>
                                                <td style="font-size: 14px;font-weight: bold; color: #666;">'.$pay_at.'</td>
                                                </tr>
                                                <tr><td style="font-size: 15px;font-weight: normal; color: #333;">&#8377; '.str_replace('.00','',money_format('%!i', $query->row('amount_pay_manufacturer'))).'</td></tr>
                                                </tbody>
                                                </table>';
                                        }
                                        else
                                        {
                                                $UserEmailContent.='<table border="0" cellpadding="0" cellspacing="0" style="margin: 0px auto;border:none;" class="book_dtl_four">
                                                <tbody>
                                                <tr>
                                                <td rowspan="2" style="width:28px;padding-right:80px"> <img style="position: relative;top: -5px;padding-right: 15px;" src="'.$img_url.'/payment_icon.png" /> </td>
                                                <td style="font-size: 14px;font-weight: bold; color: #666;">'.$pay_at.'</td>
                                                </tr>
                                                <tr><td style="font-size: 15px;font-weight: normal; color: #333;">Total Amount Paid</td></tr>
                                                </tbody>
                                                </table>';
                                        }
                                }
                                else
                                {
                                if($query->row('amount_pay_hatchery')!=0)
                                {
                                $UserEmailContent.='<table border="0" cellpadding="0" cellspacing="0" style="margin: 0px auto;border:none;" class="book_dtl_four">
                                                <tbody>
                                                <tr>
                                                <td rowspan="2" style="width:28px;padding-right:80px"> <img style="position: relative;top: -5px;padding-right: 15px;" src="'.$img_url.'/payment_icon.png" /> </td>
                                                <td style="font-size: 14px;font-weight: bold; color: #666;">'.$pay_at.'</td>
                                                </tr>
                                               <tr><td style="font-size: 15px;font-weight: normal; color: #333;">&#8377; '.str_replace('.00','',money_format('%!i', $query->row('amount_pay_hatchery'))).'</td></tr>
                                                </tbody>
                                                </table>';
                                }
                                else
                                {
                                $UserEmailContent.='<table border="0" cellpadding="0" cellspacing="0" style="margin: 0px auto;border:none;" class="book_dtl_four">
                                <tbody>
                                <tr>
                                <td rowspan="2" style="width:28px;padding-right:80px"> <img style="position: relative;top: -5px;padding-right: 15px;" src="'.$img_url.'/payment_icon.png" /> </td>
                                <td style="font-size: 14px;font-weight: bold; color: #666;">'.$pay_at.'</td>
                                </tr>
                                <tr><td style="font-size: 15px;font-weight: normal; color: #333;">Total Amount Paid</td></tr>
                                </tbody>
                                </table>';
                                }
                                }
                }
            $UserEmailContent.='</td>

        </tr>
    </tbody>
</table>
<div style="clear: both">&nbsp;</div>
<table border="0" cellpadding="0" cellspacing="0" style="width: 100%; margin-top: 15px;text-align: left;" >
    <thead>';
    if($book_type==1)
    {
        $UserEmailContent.='<tr>
            <td style="font-size: 14px; color: #666;font-weight: normal;">Product Name</td>
            <td style="font-size: 14px; color: #666;font-weight: normal;">Quantity</td>';
            if($status==0)
            {
                    $UserEmailContent.='<td style="font-size: 14px; color: #666;font-weight: normal;">Price</td>';
            }
        $UserEmailContent.='</tr>';
    }
    else
    {
        $UserEmailContent.='<tr>
            <td style="font-size: 14px; color: #666;font-weight: normal;">Species</td>
            <td style="font-size: 14px; color: #666;font-weight: normal;">Quantity</td>';
            if($status==0)
            {
                    $UserEmailContent.='<td style="font-size: 14px; color: #666;font-weight: normal;">Price</td>';
            }
        $UserEmailContent.='</tr>';
    }
    $UserEmailContent.='</thead>
    <tbody class="pro_dtls">
    <tr class="pro_dtls_empt"><td colspan="3">&nbsp;</td></tr>';
            if($cart==0){
            
                    if($book_type==1)
                    {
                            $pro_id = $this->getValue('ad_manuf_deals','product_id','id',$query->row('deal_id'));
                        $product = $this->getValue('ad_manuf_products','title','id',$pro_id);
                        $qty = $query->row('quantity');
                        $units_id =  $this->getValue('ad_manuf_products','units_id','id',$pro_id);
                                $packing_id =  $this->getValue('ad_manuf_products','packing_size_id','id',$pro_id);
                                $pqty =  $this->getValue('ad_manuf_products','quantity','id',$pro_id);
                                $packs = $this->getValue('ad_packging_types','packging_type','id',$packing_id);
                                $units = $this->getValue('ad_units','unit_name','id',$units_id);
                                if($packs!="N/A")
                                {
                                $totqty = $pqty."".$units." ".$packs." x ".$qty." quantity";
                                }
                                else
                                {
                                $totqty = $pqty."".$units." x ".$qty." quantity";
                                }
                                $prebook_amt = $query->row('pre_booking_amount');
                                //calculations
                                if($query->row('deal_price')!=0)
                                {
                                $ac_apply = $qty*($query->row('mrp')-$query->row('deal_price'));
                                $amt1 = $qty*$query->row('mrp');
                                $amt = $amt1-$ac_apply;
                                }
                                else
                                {
                                $ac_apply = 'N/A';
                                $amt = $qty*$query->row('mrp');
                                $amt1 = $qty*$query->row('mrp');
                                }
                        if($mode==1)
                        {
                                $grnd_ttl = $query->row('amount_pay_manufacturer');
                        }
                        if($query->row('pre_booking_amount')!=0 && $mode==2 )
                        {
                                $grnd_ttl = $query->row('amount_pay_manufacturer');
                        }
                        if($mode==3)
                        {
                                if($query->row('amount_pay_manufacturer')==0)
                                {
                                        $grnd_ttl = $query->row('total_online_payment');
                                        $ttl_paid = "[ Total Paid ]";
                                }
                                else
                                {
                                        $grnd_ttl = $query->row('amount_pay_manufacturer');
                                }
                        }
                        //end
                        $pay_at_hatch_out = $query->row('amount_pay_manufacturer');
                }
                else
                {
                        $species_id = $this->getValue('ad_vendor_deals','species_id','id',$query->row('deal_id'));
                        $product = $this->getValue('ad_species','type','id',$species_id);
                        $totqty = $query->row('quantity');
                        $prebook_amt = $query->row('prebook_amt');
                          //calculations
                                if($query->row('discount_price')!=0)
                                {
                                $ac_apply = $totqty*($query->row('price')-$query->row('discount_price'));
                                $amt1 = $totqty*$query->row('price');
                                $amt= $ac_apply-$amt1;
                                }
                                else
                                {
                                $ac_apply ='N/A';
                                $amt = $totqty*$query->row('price');
                                $amt1 = $totqty*$query->row('price');
                                }
                        
                        if($mode==1)
                        {
                                $grnd_ttl = $query->row('amount_pay_hatchery');
                        }
                        if($query->row('prebook_amt')!=0 && $mode==2 )
                        {
                                $grnd_ttl = $query->row('amount_pay_hatchery');
                        }
                        if($mode==3)
                        {
                                if($query->row('amount_pay_hatchery')==0)
                                {
                                        $grnd_ttl = $query->row('total_online_payment');
                                        $ttl_paid = "[ Total Paid ]";
                                }
                                else
                                {
                                        $grnd_ttl = $query->row('amount_pay_hatchery');
                                }
                        }
                        //end
                        $pay_at_hatch_out = $query->row('amount_pay_hatchery');
                }
        $UserEmailContent.='<tr>
            <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.ucfirst($product).'</td>
            <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.$totqty.' </td>';
            if($status==0)
            {
            $UserEmailContent.='<td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;text-align:left;">&#8377; '.str_replace('.00','',money_format('%!i', $amt1)).' </td>';
            }
            
        $UserEmailContent.='</tr>';
        if($status==0)
        {
        $UserEmailContent.='<tr>
            <td colspan="1" style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;"></td>
            <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">Total</td>
            <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;text-align:left;">&#8377; '.str_replace('.00','',money_format('%!i', $amt1)).' </td>
        </tr>';
        if($query->row('aqua_cash') > 0)
        {
        $UserEmailContent.='<tr>
            <td colspan="1" style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;"></td>
            <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">AquaCash Applied</td>
            <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;text-align:left;">(-) &#8377; '.str_replace('.00','',money_format('%!i', $query->row('aqua_cash'))).'</td>
        </tr>';
        }
        if(($query->row('applied_coupons')!='' || $query->row('coupon_code')!=''))
        {
        $UserEmailContent.='<tr>
            <td colspan="1" style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;"></td>
            <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;"><b>Coupons Applied</b></td>
            <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;text-align:left;"></td>
        </tr>';
        if($query->row('coupon_code')!='')
        {
        
        $UserEmailContent.='<tr>
            <td colspan="1" style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;"></td>
            <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.$query->row('coupon_code').'</td>
            <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;text-align:left;">(-) &#8377; '.str_replace('.00','',money_format('%!i', $query->row('coupon_amount'))).'</td>
        </tr>';
        }
        if($query->row('applied_coupons')!='')
{
        $applied_coupons = explode(',', $query->row('applied_coupons'));
        foreach($applied_coupons as $apl_copons)
        {
        $d = explode('|',$apl_copons);
                $apl_copon =  $d[0];
                $cpn_amt = $d[1];
                $UserEmailContent.='<tr>
            <td colspan="1" style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;"></td>
            <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.$apl_copon.'</td>
            <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;text-align:left;">(-) &#8377; '.str_replace('.00','',money_format('%!i', $cpn_amt)).'</td>
        </tr>';
        }
}
        }
        if($prebook_amt!=0)
        {
        $UserEmailContent.='<tr>
            <td colspan="1" style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;"></td>
            <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">Prebook Amount</td>
            <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;text-align:left;">(-) &#8377; '.str_replace('.00','',money_format('%!i', $prebook_amt)).'</td>
        </tr>';
        }
        if($mode==3  && $pay_at_hatch_out!=0)
                {
                        $UserEmailContent.='<tr>
                        <td colspan="1" style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;"></td>
                        <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">Amount Paid At Online</td>
                        <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;text-align:left;">
                        (-) &#8377; '.str_replace('.00','',money_format('%!i', $query->row('total_online_payment'))).'</td>
                        </tr>';   
                }
        $UserEmailContent.='<tr>
            <td colspan="1" style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;"></td>
            <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.$grand_ttl_msg.'</td>
            <td style="font-size: 18px; color: #333;font-weight: bold;padding: 10px 0px;border-top: 1px dotted #b2b2b2;text-align:left;">&#8377; '.str_replace('.00','',money_format('%!i', $grnd_ttl)).''.$ttl_paid.'</td>
        </tr>';
        }
        }
        else
        {
        $qry = $CI->db->query("SELECT * FROM `ad_cart_bookings` WHERE booking_id = '".$booking_id."'"); 
        $total = '';
        $ac_apply = '';
        
        foreach($qry->result() as $prow)
        {
                if($book_type==1)
                {
                        $pro_id = $this->getValue('ad_manuf_deals','product_id','id',$prow->deal_id);
                        $product = $this->getValue('ad_manuf_products','title','id',$pro_id);
                        $qty = $prow->quantity;
                        $units_id =  $this->getValue('ad_manuf_products','units_id','id',$pro_id);
                                $packing_id =  $this->getValue('ad_manuf_products','packing_size_id','id',$pro_id);
                                $pqty =  $this->getValue('ad_manuf_products','quantity','id',$pro_id);
                                $packs = $this->getValue('ad_packging_types','packging_type','id',$packing_id);
                                $units = $this->getValue('ad_units','unit_name','id',$units_id);
                                if($packs!="N/A")
                                {
                                $totqty = $pqty."".$units." ".$packs." x ".$qty." quantity";
                                }
                                else
                                {
                                $totqty = $pqty."".$units." x ".$qty." quantity";
                                }
                               
                        if($prow->deal_price!=0)
                        {
                                        $ac_apply1 = $qty*($prow->mrp-$prow->deal_price);
                                        $ac_apply2 = $qty*($prow->mrp-$prow->deal_price);
                                        $amt1 = $qty*$prow->mrp;
                                        $amt = $amt1-$ac_apply;
                                }
                        else
                        {
                                $ac_apply1 ='N/A';
                                $ac_apply2 =0;
                                        $amt = $qty*$prow->mrp;
                                        $amt1 = $qty*$prow->mrp;
                        }
                        $total = $total+$amt1;
                        $ac_apply = $ac_apply+$ac_apply2;
                $UserEmailContent.='<tr>
                    <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.ucfirst($product).'</td>
                    <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.$totqty.'</td>';
                   if($status==0)
                   {
                   $UserEmailContent.=' <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;text-align:left">&#8377; '.str_replace('.00','',money_format('%!i', $amt1)).'</td>';
                   }
                        $UserEmailContent.='</tr>';
                        
                }
                else
                {
                        $species_id = $this->getValue('ad_vendor_deals','species_id','id',$prow->deal_id);
                        $product = $this->getValue('ad_species','type','id',$species_id);
                        $qty = $prow->quantity;
                                if($prow->deal_price!=0)
                                {
                                $ac_apply1 = $qty*($prow->mrp-$prow->deal_price);
                                $ac_apply2 = $qty*($prow->mrp-$prow->deal_price);
                                $amt1 = $qty*$prow->mrp;
                                $amt= $ac_apply-$amt1;
                                }
                                else
                                {
                                $ac_apply1 ='N/A';
                                $ac_apply2 =0;
                                $amt = $totqty*$prow->mrp;
                                $amt1 = $totqty*$prow->mrp;
                                }
                        $total = $total+$amt1;
                        $ac_apply = $ac_apply+$ac_apply2;
                $UserEmailContent.='<tr>
                    <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.ucfirst($product).'</td>
                    <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.$qty.'</td>';
                    if($status==0)
                    {
                    $UserEmailContent.='<td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;text-align:left;">&#8377; '.str_replace('.00','',money_format('%!i', $amt1)).'</td>';
                    }
                        $UserEmailContent.='</tr>';
                }
        }
        if($book_type==1)
        {
                        $prebook_amt = $query->row('pre_booking_amount');
                                 if($mode==1)
                        {
                                $grnd_ttl = $query->row('amount_pay_manufacturer');
                        }
                        if($query->row('pre_booking_amount')!=0 && $mode==2 )
                        {
                                $grnd_ttl = $query->row('amount_pay_manufacturer');
                        }
                        if($mode==3)
                        {
                                if($query->row('amount_pay_manufacturer')==0)
                                {
                                        $grnd_ttl = $query->row('total_online_payment');
                                        $ttl_paid = "[ Total Paid ]";
                                }
                                else
                                {
                                        $grnd_ttl = $query->row('amount_pay_manufacturer');
                                }
                        }
                        $pay_at_hatch_out = $query->row('amount_pay_manufacturer');
        }
        else
        {
                 $prebook_amt = $query->row('prebook_amt');
                 if($mode==1)
                        {
                                $grnd_ttl = $query->row('amount_pay_hatchery');
                        }
                        if($query->row('prebook_amt')!=0 && $mode==2 )
                        {
                                $grnd_ttl = $query->row('amount_pay_hatchery');
                        }
                        if($mode==3)
                        {
                                if($query->row('amount_pay_hatchery')==0)
                                {
                                        $grnd_ttl = $query->row('total_online_payment');
                                        $ttl_paid = "[ Total Paid ]";
                                }
                                else
                                {
                                        $grnd_ttl = $query->row('amount_pay_hatchery');
                                }
                        }
                        $pay_at_hatch_out = $query->row('amount_pay_hatchery');
                        
        }
        
                if($status==0)
                {
        $UserEmailContent.='<tr>
            <td colspan="" style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;"></td>
            <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">Total</td>
            <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;text-align:left;">&#8377; '.str_replace('.00','',money_format('%!i', $total)).'</td>
        </tr>';
        if($query->row('aqua_cash') > 0)
        {
        $UserEmailContent.='<tr>
            <td colspan="" style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;"></td>
            <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">Aquacash Applied</td>
            <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;text-align:left;">(-) &#8377; '.str_replace('.00','',money_format('%!i', $query->row('aqua_cash'))).'</td>
        </tr>';
        }
        if(($query->row('coupon_code')!='' || $query->row('applied_coupons')!=''))
        {
        $UserEmailContent.='<tr>
            <td colspan="" style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;"></td>
            <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;"><b>Coupons Applied</b></td>
            <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;text-align:left;"></td>
        </tr>';
        if($query->row('coupon_code')!='')
        {
        
        $UserEmailContent.='<tr>
            <td colspan="2" style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;"></td>
            <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.$query->row('coupon_code').'</td>
            <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;text-align:left;">(-) &#8377; '.str_replace('.00','',money_format('%!i', $query->row('coupon_amount'))).'</td>
        </tr>';
        }
        $applied_coupons = explode(',', $query->row('applied_coupons'));
        foreach($applied_coupons as $apl_copons)
        {
                $d = explode('|',$apl_copons);
                $apl_copon =  $d[0];
                $cpn_amt = $d[1];
                $UserEmailContent.='<tr>
            <td colspan="" style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;"></td>
            <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.$apl_copon.'</td>
            <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;text-align:left;">(-) &#8377; '.str_replace('.00','',money_format('%!i', $cpn_amt)).'</td>
        </tr>';
        }
        }
        if($prebook_amt!=0)
        {
        $UserEmailContent.='<tr>
            <td colspan="" style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;"></td>
            <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">Prebook Amount</td>
            <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;text-align:left;">(-) &#8377; '.str_replace('.00','',money_format('%!i', $cpn_amt)).'</td>
        </tr>';
        }
        if($mode==3  && $pay_at_hatch_out!=0)
                {
                        $UserEmailContent.='<tr>
                        <td colspan="2" style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;"></td>
                        <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">Amount Paid At Online</td>
                        <td style="font-size: 15px; color: #333;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;text-align:left;">
                        (-) &#8377; '.str_replace('.00','',money_format('%!i', $query->row('total_online_payment'))).'</td>
                        </tr>';   
                }
        $UserEmailContent.='<tr>
            <td colspan="" style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;"></td>
            <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.$grand_ttl_msg.'</td>
            <td style="font-size: 18px; color: #333;font-weight: bold;padding: 10px 0px;border-top: 1px dotted #b2b2b2;text-align:left;">&#8377; '.str_replace('.00','',money_format('%!i', $grnd_ttl)).''.$ttl_paid.' </td>
        </tr>';
        }
        }
                if($status==3)
                {
                $UserEmailContent.='<tr>
            <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;"></td>
            <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">Reason for cancellation</td>
            <td style="font-size: 17px; color: #d2322d;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.ucfirst($creason).'</td>
        </tr>
        <tr>
            <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;"></td>
            <td style="font-size: 14px; color: #666;font-weight: normal;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">Cancelled by</td>
            <td style="font-size: 17px; color: #d2322d;padding: 10px 0px;border-top: 1px dotted #b2b2b2;">'.ucfirst($user_cancelby).'</td>
        </tr>';
        }
    $UserEmailContent.='</tbody>
</table>';
       

$UserEmailContent.='
<div style="clear: both">&nbsp;</div>
</div>
<div class="foter">
    <div style="float: left;">
        <h6 style="font-size: 15px;color: #333;margin: 0;">Download AquaDeals</h6>
                        <a href="https://play.google.com/store/apps/details?id=com.aquadeals.user" style="margin-top: 15px;display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/android_icon.png" /> </a>
                        </div>
                        <div style="float: right;">
                        <h6 style="font-size: 15px;color: #333;margin: 0;">Follow Us</h6>
                        <ul style="list-style: none;text-align: center;margin: 15px 0 0 0;padding: 0;">
                        <li style="float: left;"><a href="https://www.facebook.com/aquadealsstore/" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/fb_icon.png" /> </a></li>
                        <li style="float: right;"><a href="https://twitter.com/aquadealsstore" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/twitter_icon.png" /> </a></li>
                        </ul>
        
    </div>
</div>
</body>
</html>';
//echo $UserEmailContent;exit;
return $UserEmailContent;
    }
    
    function GetTextEmails()
    {
    
    }
    //Share coupon details
    function shareCoupon($email,$sub,$msg,$name)
    {
            $to = $email;
            $subject = $sub;
        $mailcontent='<html>
                <head>
                        <meta charset="utf-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1">
                        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" /> 
                        <title>AquaDeals</title>
                        <style type="text/css">
                        .tot_pag{width: 40%;margin: 10px auto;}
                        .foter{overflow: hidden;width: 43%;margin: 10px auto;}
                        .nxt_stp li{width: 50%;margin-top: 10px;}
                        .nxt_stp li img{margin-right: 20px;margin-top: 10px;}
                        @media (max-width: 667px) {
                        .nxt_stp li{width: 100%;margin-top: 15px;}
                        .tot_pag{width: 80%;}
                        .foter{width: 83%;}
                        }
                        </style>
                </head>

                <body style="background: #eeeeee;font-family: arial;">
                        <div style="width: 100%;text-align: center;margin: 30px 0;"> <a href="#"> 
                        <img src="http://aqua.deals/admin/assets/email_imgs/logo.png" /> </a> </div>
                        <div class="tot_pag" style="border-radius: 5px;background:#f15a25;padding: 20px;">
                        <h1 style="font-size: 16px;color: #fff;text-align: left;">Dear '.ucfirst($name).',</h1>
                        <p style="font-size: 14px;color: #fff;text-align: left;font-weight: normal;margin-top: 15px;">'.$msg.'</p>
                        <div style="clear: both">&nbsp;</div>
                        </div>
                        <div class="foter">
                        <h6 style="font-size: 13px;color: #666; float: right;margin: 0 0 30px 0;padding: 0;">Thank you for signing up! with AquaDeals </h6>
                        <div style="clear: both;"></div>
                        <div style="float: left;">
                        <h6 style="font-size: 15px;color: #333;margin: 0;">Download AquaDeals</h6>
                        <a href="http://www.tinyurl.com/aquadotdeals" style="margin-top: 15px;display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/android_icon.png" /> </a>
                        </div>
                        <div style="float: right;">
                        <h6 style="font-size: 15px;color: #333;margin: 0;">Download AquaDeals</h6>
                        <a href="https://play.google.com/store/apps/details?id=com.aquadeals.user" style="margin-top: 15px;display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/android_icon.png" /> </a>
                        </div>
                        <div style="float: right;">
                        <h6 style="font-size: 15px;color: #333;margin: 0;">Follow Us</h6>
                        <ul style="list-style: none;text-align: center;margin: 15px 0 0 0;padding: 0;">
                        <li style="float: left;"><a href="https://www.facebook.com/aquadealsstore/" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/fb_icon.png" /> </a></li>
                        <li style="float: right;"><a href="https://twitter.com/aquadealsstore" style="display: block;"> <img src="http://aqua.deals/admin/assets/email_imgs/twitter_icon.png" /> </a></li>
                        </ul>
                        </div>
                        </div>
                </body>
                </html>';
                $res = $this->send($to,$subject,$mailcontent,1);
        return $res;
    }
    /************************************ Emails related to Feed Bookings end here ************************************************/
    
    
/************************************************************************************************************************************/
    //Main function to send email
    function send($to,$subject,$message,$type, $cc = null)
    {
                
                //$to='chandu4it@gmail.com';
                $CI = & get_instance();
                
                //'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'
                $gf = new Globalfuns();
                $key  = $gf->getValue('ad_settings','value','key','sendgrid');  
                
                if($cc==1)
                {
                    $cc = 'help.aquadeals@gmail.com';
                }
                  if($cc==2)
                {
                    $cc = 'partner.aquadeals@gmail.com';
                }
                  if($cc==3)
                {
                    $cc = 'chandu4it@gmail.com';
                }
                //$sendgrid = new SendGrid('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');  
                $sendgrid = new SendGrid($key);
                if($to != '')
                {
                        $options = array(
                                                        'turn_off_ssl_verification' => false,
                                                        'protocol' => 'https',
                                                        'host' => 'api.sendgrid.com',
                                                        'endpoint' => '/api/mail.send.json',
                                                        'port' => null,
                                                        'url' => null,
                                                        'raise_exceptions' => false
                                                        );
                        $email = new SendGrid\Email();
                        $email
                        ->addTo($to)
                        ->addCc($cc)
                        ->setFrom('donotreply@aqua.deals', 'AquaDeals')
                        ->setSubject($subject)
                        ->setHtml($message);
                        $res=$sendgrid->send($email,$options);
                }

                return 1;
    }
/************************************************************************************************************************************/
}


?>
