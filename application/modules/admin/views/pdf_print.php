<!DOCTYPE html>
<html>
<head>
<title>User Settlement</title>
</head>
<body style="padding: 0px; margin: 0px; font-family: arial;">
<?php $rupee = '<span style="float: right;"><img style="width:7px;" src="'.base_url().'/assets/images/rupee.png"></span>'; ?>
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
                        <div style="width: 175px; display: inline-block; position: relative;height: 95px;    text-align: center;"> 
                        <?php if($settled_data->harvest_wt > $settled_data->feed_wt){?>
                            <img style="display: inline-block;" src="http://3.7.44.132/aquacredit/assets/images/grt_rto" alt="" title=""> 
                        <?php }?>
                        <?php if($settled_data->harvest_wt < $settled_data->feed_wt){?>
                            <img style="display: inline-block;" src="http://3.7.44.132/aquacredit/assets/images/lss_rto" alt="" title=""> 
                        <?php }?>
                        <?php if($settled_data->harvest_wt == $settled_data->feed_wt){?>
                            <img style="display: inline-block;" src="http://3.7.44.132/aquacredit/assets/images/eql_rto" alt="" title=""> 
                        <?php }?>
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
                    <?php 
                    $bags = 0;
                    foreach($feed_products as $product){?>
                    <tr> 
                        <td style="text-align: left; border-bottom: 1px solid #ccc;">  <?php echo $product->pname." ".$product->weight." ".$product->unit_name;?> </td>
                        <td style="border-left: 1px solid #ccc; border-bottom: 1px solid #ccc; text-align: center;">  <?php echo $product->sale_qty;?> </td>
                    </tr>
                    <?php 
                    $bags +=$product->sale_qty;
                    }?>
                    <tr> 
                        <td style="text-align: left; border-bottom: 1px solid #ccc;">  <b>Total Bags</b> </td>
                        <td style="border-left: 1px solid #ccc; border-bottom: 1px solid #ccc; text-align: center;">  <b><?php echo $bags;?></b> </td>
                    </tr>
                </table>
             </td>
        </tr>
    </table>
    <br/><br/>
        <table cellpadding="5" cellspacing="0" border="0" style="width: 100%;">
            <tr> 
                <?php if($settled_data->total_loan_amount > 0)
                {?>
                    <td colspan="2" style="font-size: 10px; border-top: 1px solid #ccc; border-left: 1px solid #ccc; text-align: center; border-right: 1px solid #ccc;"> <br/>Loan Amount <div style="font-size: 12px; text-align: center;padding-top: 0px;padding-bottom: 0px; margin: 0px;"> 
                    
                    <img style='width:10px;' src ='http://3.7.44.132/aquacredit/assets/images/rupee.png' title='rupee'>

                    <?php echo $rupee.$settled_data->total_loan_amount;?> </div> </td>
                    <?php
                }?>
                <?php if($settled_data->harvest_amount > 0)
                {?>
                    <td colspan="2" style="font-size: 10px; border-top: 1px solid #ccc; text-align: center; border-right: 1px solid #ccc;"> <br/>Harvest <div style="font-size: 12px; text-align: center;padding-top: 0px;padding-bottom: 0px; margin: 0px;"> <?php echo $rupee.$settled_data->harvest_amount;?> </div> </td>
                    <?php
                }?>
                <!--  <td colspan="2" style="font-size: 10px; border-top: 1px solid #ccc; text-align: center; border-right: 1px solid #ccc;"> <br/>Loan Amount <div style="font-size: 12px; text-align: center;padding-top: 0px;padding-bottom: 0px; margin: 0px;"> ₹1,200.00 </div></td> -->
            </tr>
            <tr> 
                <?php if($settled_data->total_loan_amount > 0)
                {?>
                    <td style="font-size: 9px; border-top: 1px solid #ccc; text-align: center; border-right: 1px solid #ccc; border-left: 1px solid #ccc; border-bottom: 1px solid #ccc;">  Total Amount <div style="font-size: 11px;">  <?php echo $rupee.$settled_data->loan_amount;?> </div> </td>
                    <td style="font-size: 10px; border-top: 1px solid #ccc; border-bottom: 1px solid #ccc; text-align: center; border-right: 1px solid #ccc;"> Total Interest <div style="font-size: 11px;">  <?php echo $rupee.$settled_data->loan_interest;?> </div> </td>
                    <?php
                }?>
                <?php if($settled_data->harvest_amount > 0)
                {?>
                    <td style="font-size: 9px; border-top: 1px solid #ccc; border-bottom: 1px solid #ccc; text-align: center; border-right: 1px solid #ccc;">  Type <div style="font-size: 11px;">  <?php echo $settled_data->harvest_type;?> </div> </td>
                    <td style="font-size: 9px; border-top: 1px solid #ccc; border-bottom: 1px solid #ccc; text-align: center; border-right: 1px solid #ccc;"> Total Tons <div style="font-size: 11px;">  <?php echo $settled_data->harvest_wt;?> </div> </td>
                    <?php
                }?>
                <!-- <td style="font-size: 9px; border-top: 1px solid #ccc; border-bottom: 1px solid #ccc; text-align: center; border-right: 1px solid #ccc;">  Total Amount <div style="font-size: 11px;">  1,200.00 </div> </td>
                <td style="font-size: 9px; border-bottom: 1px solid #ccc; border-top: 1px solid #ccc; text-align: center; border-right: 1px solid #ccc;"> Total Interest <div style="font-size: 11px;">  0.00 </div> </td> -->
            </tr>
            
        </table>
        <br/><br/>
        <table style="width: 100%; border: 1px solid #ccc;" cellpadding="5" cellspacing="0" border="0">
            <?php if($settled_data->lab_fee > 0){?>
            <tr> <td style="font-size: 10px;"> Lab Fee </td> <td colspan="3" style="font-size: 10px; text-align: right;">  <?php echo $rupee.$settled_data->lab_fee;?> </td> </tr>
            <?php }?>
            <?php if($settled_data->expenses > 0){?>
            <tr> <td style="font-size: 10px;"> Expenses </td> <td colspan="3" style="font-size: 10px; text-align: right;">  <?php echo $rupee.$settled_data->expenses;?> </td> </tr>
            <?php }?>

            <?php if($settled_data->transport > 0){?>
            <tr> <td style="font-size: 10px;"> Transport </td> <td colspan="3" style="font-size: 10px; text-align: right;">  <?php echo $rupee.$settled_data->transport;?> </td> </tr>
            <?php }?>

            <?php if($settled_data->loading > 0){?>
            <tr> <td style="font-size: 10px;"> Loading </td> <td colspan="3" style="font-size: 10px; text-align: right;">  <?php echo $rupee.$settled_data->loading;?> </td> </tr>
            <?php }?>

            <?php if($settled_data->receipts > 0){?>
            <tr> <td style="font-size: 10px;"> Receipts </td> <td colspan="3" style="font-size: 10px; text-align: right;">  <?php echo $rupee.$settled_data->receipts;?> </td> </tr>
            <?php }?>

            <?php if($settled_data->returns > 0){?>
            <tr> <td style="font-size: 10px;"> Returns </td> <td colspan="3" style="font-size: 10px; text-align: right;">  <?php echo $rupee.$settled_data->returns;?> </td> </tr>
            <?php }?>

        </table>
        <br/><br/>
        <table cellspacing="0" cellpadding="5" border="0" style="width: 100%; border: 1px solid #ccc;">
            <tr> 
                <td colspan="2" style="font-size: 10px;"> <b>Date</b> </td> 
                <td colspan="2" style="font-size: 10px;"> <b>Detail</b> </td> 
                <td colspan="2" style="text-align: right; font-size: 10px;"> <b>Amount </b> </td> 
            </tr>
            <?php foreach($transactions as $trans)
            {?>
            <tr> 
                <td colspan="2" style="font-size: 10px; border-top: 1px solid #ccc;">  <?php echo date("d-M-Y",strtotime($trans->created_on));?>  </td>
                <td colspan="2" style="font-size: 10px; border-top: 1px solid #ccc;">  <a href="#" style="color: #000; text-decoration: none; font-size: 10px;" title="">  <?php echo $trans->trans_type;?> (<?php echo $trans->trans;?>) - <?php echo $trans->trans_code;?>  </a> </td>
                <td colspan="2" style="text-align: right; font-size: 10px; border-top: 1px solid #ccc;">   
              
                <?php echo $rupee.$trans->amount;?> <span style="float: right;"> 
                    <?php $arrow = ($trans->amount_type =="OUT") ? "rd_c_ar.png" : "grn_c_ar.png";?>
                    <img style="width:10px;" src="<?php echo base_url(); ?>/assets/images/<?php echo $arrow;?>">
                    </span> </td> 
            </tr>
            <?php
            }?>
            <tr> 
                <td colspan="2" style="font-size: 10px; border-top: 1px solid #ccc;"></td> 
                <td colspan="2" style="text-align: right; font-size: 10px; border-top: 1px solid #ccc;"> <b>Total</b> </td> 
                
                <td colspan="2" style="text-align: right; font-size: 10px; border-top: 1px solid #ccc;"><b> <?php echo $rupee.$settled_data->balance_amount;?></b>
                <?php $arrow = ($settled_data->amount_type =="Loss") ? "rd_c_ar.png" : "grn_c_ar.png";?>
                <span style="float:right"> <img style="width:10px;" src="<?php echo base_url(); ?>/assets/images/<?php echo $arrow;?>"></span></td> 
            </tr>
            
    </table>
    <br/><br/>
</body>
</html>