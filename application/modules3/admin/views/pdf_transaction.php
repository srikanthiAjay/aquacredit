<table style="border: 1px solid #ccc; font-family: arial; font-size: 9px; text-align: left;" width="100%" border="0" cellpadding="5" cellspacing="0"> 	
    <tr>
        <td colspan="3" style="background: #ddd;"><h1 style="color: #373c4f;font-weight: bold;;font-size: 12px; margin: 0px; padding: 0px;"> <?php echo $user["user_name"];?> / <small><?php echo $crop->crop_location;?>	</small> / <small> #<?php echo $user["user_code"];?> </small> </h1> </td>
        </tr>
        <tr> 
            <td colspan="1" style="padding: 10px; background: #ddd; padding-left: 20px; border-bottom: 1px solid #ddd"> 
                <!-- 	<h1 style="color: #373c4f;font-weight: bold;;font-size: 16px; margin-top: 0px; margin-bottom: 5px;"> 	</h1> -->
            Mobile: <b><?php echo $user["mobile"];?></b>
                        
                </td>
                <td colspan="2" style="padding: 10px; background: #ddd; padding-right: 20px; text-align: right; border-bottom: 1px solid #ddd"> 
                <?php $last = count($transactions); ?>
                <span style="color: red"><?php echo date("d-M-Y",strtotime($transactions[0]["created_on"]));?>to <?php echo date("d-M-Y",strtotime($transactions[$last-1]["created_on"]));?></span>
                
                </td>
        </tr>
        <tr> 
                <th style="padding-top: 10px; padding-bottom: 10px; padding-left: 15px; padding-left: 15px; border-bottom: 1px solid #ddd"> Date </th>
                <th style="padding-top: 10px; padding-bottom: 10px; padding-left: 15px; padding-left: 15px; border-bottom: 1px solid #ddd"> Detail </th>
                <!-- <th style="padding: 10px; border-bottom: 1px solid #ddd"> Crop Location </th>
                <th style="padding: 10px; text-align: right; border-bottom: 1px solid #ddd"> In </th> -->
                <th style="padding-top: 10px; padding-bottom: 10px; padding-left: 15px; padding-left: 15px; text-align: right; border-bottom: 1px solid #ddd; padding-right: 20px;"> Amount </th>
        </tr>
        <?php foreach($transactions as $value) {
            $trans = ($value['trans'] != null) ? "(".$value['trans'].")" : "";
            $amt = ($value["amount_type"] == "OUT") ? "-".$value['amount'] : "+".$value['amount'];
            ($value["amount_type"] == "OUT") ? $amount -=$value['amount'] : $amount +=$value["amount"] ;
            ?>           
        <tr> 
            <td style="padding-top: 10px; padding-bottom: 10px; padding-left: 15px; padding-left: 15px; padding-right: 10px;">  <?php echo date("d-M-Y",strtotime($value["created_on"]));?> </td>
            <td style="padding-top: 10px; padding-bottom: 10px; padding-left: 15px; padding-left: 15px;"> <?php echo $value["trans_type"].' '.$trans.' - '.$value["trans_code"];?>  </td>
            <!-- <td style="padding-top: 10px; padding-left: 10px; padding-right: 10px;"> <?php echo $value["mobile"];?>Kakinada </td> -->
            <!-- <td style="padding-top: 10px; padding-left: 10px; padding-right: 10px; text-align: right;"> </td> -->
            <td style="padding-top: 10px; padding-bottom: 10px; padding-left: 15px; padding-left: 15px; text-align: right;"> <?php echo $amt;?> </td>
        </tr>
        <?php }?>
        
        <!-- <tr> 
            <td style="padding-top: 10px; padding-left: 20px; padding-right: 10px;">  02-Feb-2020  </td>
            <td style="padding-top: 10px; padding-left: 10px; padding-right: 10px;"> Loan - LN123456  </td>
            <td style="padding-top: 10px; padding-left: 10px; padding-right: 10px;"> All Crops </td>
            <td style="padding-top: 10px; padding-left: 10px; padding-right: 10px; text-align: right;"> +200</td>
            <td style="padding-top: 10px; padding-left: 10px; padding-right: 20px; text-align: right;"> </td>
        </tr>
        <tr> 
            <td style="padding-top: 10px; padding-bottom: 10px; padding-left: 20px; padding-right: 10px;">  02-Feb-2020  </td>
            <td style="padding-top: 10px; padding-bottom: 10px; padding-left: 10px; padding-right: 10px;"> Loan - LN123456  </td>
            <td style="padding-top: 10px; padding-bottom: 10px; padding-left: 10px; padding-right: 10px;"> All Crops </td>
            <td style="padding-top: 10px; padding-bottom: 10px; padding-left: 10px; padding-right: 10px; text-align: right;"> </td>
            <td style="padding-top: 10px; padding-bottom: 10px; padding-left: 10px; padding-right: 20px; text-align: right;"> -20 </td>
        </tr> -->
        <tr> 
            <td style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding-top: 10px; padding-bottom: 10px; padding-left: 15px; padding-left: 15px;"> </td> 
            <!-- <td style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding-top: 10px; padding-bottom: 10px;"> </td> -->
            <td style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding-top: 10px; padding-bottom: 10px; padding-left: 15px; padding-left: 15px;"><b>Total</b> </td>
            <!-- <td style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding-top: 10px; padding-left: 10px; padding-right: 10px; padding-bottom: 10px; text-align: right;"> <b>+200</b> </td> -->
            <td style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding-top: 10px; padding-bottom: 10px; padding-left: 15px; padding-left: 15px; text-align: right;"> <b><?php echo $amount;?> </b> </td>
        </tr>
        <tr> 
            <td > </td>
            <td style="padding-top: 10px; padding-bottom: 10px; padding-left: 15px; padding-left: 15px;"><b>Balance</b> </td>
            <td style="padding-top: 10px; padding-bottom: 10px; padding-left: 15px; padding-left: 15px; text-align: right;"><b><?php echo $crop->transaction_balance;?></b> </td>
            <!-- <td style="padding-top: 10px; padding-left: 10px; padding-right: 20px; text-align: right;">  </td> -->
        </tr>
        <!-- <tr>  
            <td > </td>
            <td style="padding-top: 10px; padding-bottom: 10px; padding-left: 10px; padding-right: 10px;"><b>Previous Balance </b>  </td>
            <td style="padding-top: 10px; padding-bottom: 10px; padding-left: 10px; text-align: right; padding-right: 10px;"><b> +100 </b> </td>
            <td style="padding-top: 10px; padding-bottom: 10px; padding-left: 10px; text-align: right; padding-right: 20px;">  </td>
        </tr> -->

        <tr>  
            <td  style="border-top: 1px solid #ddd;"> </td>
            <td style="padding-top: 10px; padding-bottom: 10px; border-top: 1px solid #ddd; padding-left: 10px; padding-right: 10px;"><b>Grand Total </b>  </td>
            <td style="border-top: 1px solid #ddd; padding-left: 10px; padding-right: 10px; text-align: right;"> <b> <?php echo $amount+$crop->transaction_balance;?> </b> </td>
            <!-- <td style="padding-top: 10px; border-top: 1px solid #ddd; padding-left: 10px; text-align: right; padding-right: 20px;"> <b>  </b> </td> -->
        </tr>
</table>
