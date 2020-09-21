<!DOCTYPE html>
<html>
<head>
<title>User Settlement</title>
</head>
<body style="padding: 0px; margin: 0px; font-family: arial;">
    <br/>
    <table cellpadding="5" cellspacing="0" border="0" style="width: 100%; border: 1px solid #ccc;">
        <td> 
            <div style="font-size: 12px;font-weight: normal; line-height: normal; margin: 0px; padding: 0px;"> <?php echo $user->user_name;?> - #<?php echo $user->user_code;?> 
            <div style="font-size: 11px; margin: 0px; line-height: normal; padding-top: 0px;"> <?php echo $user->mobile;?>   </div>
             </div> </td>
             <td style="text-align: right;">
                <table cellpadding="0" cellspacing="0" border="0" style="float: right; text-align: left;">
                <tbody><tr> 
                    <td style="padding-right: 20px"> 
                        <div style="font-size: 11px;  margin-bottom: 0px!important;text-align: left; margin: 0px; padding: 0px; line-height: normal; text-align: center;">  Location  
                        <div style="font-size: 12px; padding: 0px; font-weight: normal;margin: 0px; margin-bottom:0px; line-height: normal; text-align: center;"> <?php echo $settled_data->location;?> 
                </div>
                </div>
                    </td>
                    <td style="border-left: 1px solid #e9e6e5; padding-left: 20px;"> 
                        <div style="font-size: 11px; margin: 0px; padding: 0px; margin-bottom: 0px!important;text-align: left; line-height: normal; text-align: center;">  Billing Date  
                        <div style="font-size: 12px; font-weight: normal;margin: 0px; margin-bottom:0px; padding: 0px; line-height: normal; text-align: center;"> <?php echo date("d-M-Y",strtotime($settled_data->settled_date));?> 
                </div>
                </div>
                    </td>
                </tr>
            </tbody></table>
             </td>
    </table>
    <br/><br/>
    <table cellpadding="0" cellspacing="0" border="0" style="width: 100%;">
        <tr> 
            <td style="text-align: center; width: 50%; border: 1px solid #ccc;" align="center"> 
                <br/>
                <br/>
                <?php if($settled_data->harvest_wt > 0){?>
                <table border="0" cellpadding="0" align="center" cellspacing="0" style="width: 100%; text-align: center; margin: 0px auto">
                <tbody><tr> <td style="text-align: center;"> 
                    <div style="padding: 0px 0px; position: relative; top: -40px; font-size: 10px; display: inline-block; text-align: center;"> Harvest  
                        <div style="margin: 0px; padding: 0px; font-size: 12px;position: relative;top: 0px;   width: 100%;display: block;"> <?php echo $settled_data->harvest_wt;?> </div>
                    </div> </td> 
                    <td style="text-align: center;"> 
                        <div style="width: 175px; display: inline-block; position: relative;height: 95px;    text-align: center;"> <img style="display: inline-block;" src="http://3.7.44.132/aquacredit/assets/images/grt_rto" alt="" title=""> 
                                <div style="width: 100%; text-align: center; font-size: 12px;  margin-top: 10px;">  FCR: <span style=""> <?php echo $settled_data->fcr;?>  </span> 
                                     <div style="text-align: center; width: 100%;"> <?php echo $settled_data->fcr_status;?> </div>
                                </div>

                            </div>
                    </td>
                    <td style="text-align: center;"> <div style="padding: 0px 0px; position: relative; top: -40px; font-size: 10px; display: inline-block; text-align: center;"> Feed Usage 
                        <div style="margin: 0px; padding: 0px; font-size: 12px;position: relative;top: 0px;   width: 100%;display: block;"> <?php echo $settled_data->feed_wt;?> </div>
                    </div> </td>
                </tr>
                </tbody></table>
                <?php }?>
           
            </td>
            <td style="width: 50%; text-align: center; border-top: 1px solid #ccc; border-right: 1px solid #ccc; border-bottom: 1px solid #ccc; vertical-align: top;"> 
                <table cellspacing="0" cellpadding="5" border="0" style="width: 100%; border-left: 1px solid #ccc; font-size: 10px;">
                    <tr> 
                        <td style="text-align: left; border-bottom: 1px solid #ccc;"> <b> Feeds </b> </td>
                        <td style="border-left: 1px solid #ccc; text-align: center; border-bottom: 1px solid #ccc;"> <b> No.of.bags </b> </td>
                    </tr>
                    <tr> 
                        <td style="text-align: left; border-bottom: 1px solid #ccc;">  Feeds </td>
                        <td style="border-left: 1px solid #ccc; border-bottom: 1px solid #ccc; text-align: center;">  2 </td>
                    </tr>
                    <tr> 
                        <td style="text-align: left; border-bottom: 1px solid #ccc;">  Feeds </td>
                        <td style="border-left: 1px solid #ccc; border-bottom: 1px solid #ccc; text-align: center;">  2 </td>
                    </tr>
                    <tr> 
                        <td style="text-align: left; border-bottom: 1px solid #ccc;">  Feeds </td>
                        <td style="border-left: 1px solid #ccc; border-bottom: 1px solid #ccc; text-align: center;">  2 </td>
                    </tr>
                    <tr> 
                        <td style="text-align: left; border-bottom: 1px solid #ccc;">  <b>Total Bags</b> </td>
                        <td style="border-left: 1px solid #ccc; border-bottom: 1px solid #ccc; text-align: center;">  <b>2</b> </td>
                    </tr>
                </table>
             </td>
        </tr>
    </table>
    <br/><br/>
        <table cellpadding="5" cellspacing="0" border="0" style="width: 100%;" id="loanss">
            <tr> 
                <td colspan="2" style="font-size: 10px; border-top: 1px solid #ccc; border-left: 1px solid #ccc; text-align: center; border-right: 1px solid #ccc;"> <br/>Loan Amount <div style="font-size: 12px; text-align: center;padding-top: 0px;padding-bottom: 0px; margin: 0px;"> ₹1,200.00 </div> </td>
            </tr>
            <tr> 
                <td style="font-size: 9px; border-top: 1px solid #ccc; text-align: center; border-right: 1px solid #ccc; border-left: 1px solid #ccc; border-bottom: 1px solid #ccc;">  Total Amount <div style="font-size: 11px;"> &#8377; 1,200.00 </div> </td>
                <td style="font-size: 10px; border-top: 1px solid #ccc; border-bottom: 1px solid #ccc; text-align: center; border-right: 1px solid #ccc;"> Total Interest <div style="font-size: 11px;"> &#8377; 0.00 </div> </td>
            </tr>
        </table>
        <table cellpadding="5" cellspacing="0" border="0" style="width: 100%;">
            <tr> 
               
                <td colspan="2" style="font-size: 10px; border-top: 1px solid #ccc; text-align: center; border-right: 1px solid #ccc;"> <br/>Harvest <div style="font-size: 12px; text-align: center;padding-top: 0px;padding-bottom: 0px; margin: 0px;"> 1,200.00 </div> </td>
              
            </tr>
            <tr> 
               
                <td style="font-size: 9px; border-top: 1px solid #ccc; border-bottom: 1px solid #ccc; text-align: center; border-right: 1px solid #ccc;">  Type <div style="font-size: 11px;"> &#8377; Prawn </div> </td>
                <td style="font-size: 9px; border-top: 1px solid #ccc; border-bottom: 1px solid #ccc; text-align: center; border-right: 1px solid #ccc;"> Total Tons <div style="font-size: 11px;"> &#8377; 0.01 </div> </td>
               
            </tr>
        </table>
        <table cellpadding="5" cellspacing="0" border="0" style="width: 100%;">
            <tr> 
                
                <td colspan="2" style="font-size: 10px; border-top: 1px solid #ccc; text-align: center; border-right: 1px solid #ccc;"> <br/>Loan Amount <div style="font-size: 12px; text-align: center;padding-top: 0px;padding-bottom: 0px; margin: 0px;"> ₹1,200.00 </div></td>
            </tr>
            <tr> 
               
                <td style="font-size: 9px; border-top: 1px solid #ccc; border-bottom: 1px solid #ccc; text-align: center; border-right: 1px solid #ccc;">  Total Amount <div style="font-size: 11px;"> &#8377; 1,200.00 </div> </td>
                <td style="font-size: 9px; border-bottom: 1px solid #ccc; border-top: 1px solid #ccc; text-align: center; border-right: 1px solid #ccc;"> Total Interest <div style="font-size: 11px;"> &#8377; 0.00 </div> </td>
            </tr>
        </table>

        <br/><br/>
        <table style="width: 100%; border: 1px solid #ccc;" cellpadding="5" cellspacing="0" border="0">
            <tr> <td style="font-size: 10px;"> Lab Fee </td> <td colspan="3" style="font-size: 10px; text-align: right;"> &#8377; 90.00 </td> </tr>
            <tr> <td style="font-size: 10px;"> Expenses </td> <td colspan="3" style="font-size: 10px; text-align: right;"> &#8377; 90.00 </td> </tr>
        </table>
        <br/><br/>
        <table cellspacing="0" cellpadding="5" border="0" style="width: 100%; border: 1px solid #ccc;">
            <tr> 
                <td colspan="2" style="font-size: 10px;"> <b>Date</b> </td> 
                <td colspan="2" style="font-size: 10px;"> <b>Detail</b> </td> 
                <td colspan="2" style="text-align: right; font-size: 10px;"> <b>Amount </b> </td> 
            </tr>
            <tr> 
                <td colspan="2" style="font-size: 10px; border-top: 1px solid #ccc;">  16-Sep-2020 </td>
                <td colspan="2" style="font-size: 10px; border-top: 1px solid #ccc;">  <a href="#" style="color: #000; text-decoration: none; font-size: 10px;" title="">  TRADE (LAB FEE) - SCD2  </a> </td>
                <td colspan="2" style="text-align: right; font-size: 10px; border-top: 1px solid #ccc;">  &#8377; 90.00 <span style="float: right;"> <img src="http://3.7.44.132/aquacredit/assets/images/rd_c_ar.png"> </span> </td> 
            </tr>
            <tr> 
                <td colspan="2" style="font-size: 10px; border-top: 1px solid #ccc;">  16-Sep-2020 </td>
                <td colspan="2" style="font-size: 10px; border-top: 1px solid #ccc;">  <a href="#" style="color: #000; text-decoration: none; font-size: 10px;" title="">  TRADE (LAB FEE) - SCD2  </a> </td>
                <td colspan="2" style="text-align: right; border-top: 1px solid #ccc; font-size: 10px;">  &#8377; 90.00 <span style="float: right;"> <img src="http://3.7.44.132/aquacredit/assets/images/rd_c_ar.png"> </span> </td> 
            </tr>
            <tr> 
                <td colspan="2" style="font-size: 10px; border-top: 1px solid #ccc;">  16-Sep-2020 </td>
                <td colspan="2" style="font-size: 10px; border-top: 1px solid #ccc;">  <a href="#" style="color: #000; text-decoration: none; font-size: 10px;" title="">  TRADE (LAB FEE) - SCD2  </a> </td>
                <td colspan="2" style="text-align: right; border-top: 1px solid #ccc; font-size: 10px;">  &#8377; 90.00 <span style="float: right;"> <img src="http://3.7.44.132/aquacredit/assets/images/rd_c_ar.png"> </span> </td> 
            </tr>
    </table>
    <br/><br/>
    <table cellspacing="0" cellpadding="5" border="0" style="width: 100%; border: 1px solid #ccc;">
        <tr> 
            <td> &nbsp; </td>
            <td style="text-align: right; font-size: 10px;"> Total </td>
            <td style="text-align: right; font-size: 10px;"> ₹1,940.00 </td>
        </tr>
        
        <tr> 
            <td style="border-top: 1px solid #ccc;"> &nbsp; </td>
            <td style="text-align: right; border-top: 1px solid #ccc; font-size: 10px;"> Opening Balance </td>
            <td style="text-align: right; border-top: 1px solid #ccc; font-size: 10px;"> ₹0.00 </td>
        </tr>

        <tr> 
            <td style="border-top: 1px solid #ccc;"> &nbsp; </td>
            <td style="text-align: right; border-top: 1px solid #ccc; font-size: 10px;"> <b> Payable Amount  </b> </td>
            <td style="text-align: right; border-top: 1px solid #ccc; font-size: 10px;"> <b> ₹1,940.00 </b> </td>
        </tr>
    </table>
</body>
</html>