<table style="border: 1px solid #ccc; font-family: arial; font-size: 9px; text-align: left;" width="100%" border="0" cellpadding="5" cellspacing="0"> 	
    <tr>
        <td colspan="3" style="background: #ddd;"><h1 style="color: #373c4f;font-weight: bold;;font-size: 12px; margin: 0px; padding: 0px;"><?php echo $trader["full_name"];?> / <small><?php echo $trader["firm_name"];?> TDR<?php echo $trader["td_id"];?> </small> </h1> </td>
        </tr>
        <tr> 
            <td colspan="1" style="padding: 10px; background: #ddd; padding-left: 20px; border-bottom: 1px solid #ddd">Mobile: <b><?php echo  $trader["mobile_no"];?></b>
                        
                </td>
                <td colspan="2" style="padding: 10px; background: #ddd; padding-right: 20px; text-align: right; border-bottom: 1px solid #ddd"> 
                <?php $last = count($transactions); ?>
                <span style="color: red"><?php echo date("d-M-Y",strtotime($transactions[0]["created_on"]));?> to <?php echo date("d-M-Y",strtotime($transactions[$last-1]["created_on"]));?></span>
                
                </td>
        </tr>
        <tr> 
                <th style="padding-top: 10px; padding-bottom: 10px; padding-left: 15px; padding-left: 15px; border-bottom: 1px solid #ddd">Date </th>
                <th style="padding-top: 10px; padding-bottom: 10px; padding-left: 15px; padding-left: 15px; border-bottom: 1px solid #ddd">Detail </th>
                <th style="padding-top: 10px; padding-bottom: 10px; padding-left: 15px; padding-left: 15px; text-align: right; border-bottom: 1px solid #ddd; padding-right: 20px;">Amount </th>
        </tr>
        <?php foreach($transactions as $value) {
            $trans = ($value['trans'] != null) ? "(".$value['trans'].")" : "";
            $amt = ($value["amount_type"] == "OUT") ? "-".$value['amount'] : "+".$value['amount'];
            ($value["amount_type"] == "OUT") ? $amount -=$value['amount'] : $amount +=$value["amount"] ;
            ?>           
        <tr> 
            <td style="padding-top: 10px; padding-bottom: 10px; padding-left: 15px; padding-left: 15px; padding-right: 10px;"><?php echo date("d-M-Y",strtotime($value["created_on"]));?> </td>
            <td style="padding-top: 10px; padding-bottom: 10px; padding-left: 15px; padding-left: 15px;"><?php echo $value["trans_type"].' '.$trans.' - '.$value["trans_code"];?>  </td>
            <td style="padding-top: 10px; padding-bottom: 10px; padding-left: 15px; padding-left: 15px; text-align: right;"><?php echo number_format($amt,2);?> </td>
        </tr>
        <?php }?>
        <tr> 
            <td style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding-top: 10px; padding-bottom: 10px; padding-left: 15px; padding-left: 15px;"> </td> 
            <td style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding-top: 10px; padding-bottom: 10px; padding-left: 15px; padding-left: 15px;"><b>Total</b> </td>
            <td style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding-top: 10px; padding-bottom: 10px; padding-left: 15px; padding-left: 15px; text-align: right;"> <b><?php echo number_format($amount,2);?> </b> </td>
        </tr>
        <tr> 
            <td > </td>
            <td style="padding-top: 10px; padding-bottom: 10px; padding-left: 15px; padding-left: 15px;"><b>Balance</b> </td>
            <td style="padding-top: 10px; padding-bottom: 10px; padding-left: 15px; padding-left: 15px; text-align: right;"><b><?php echo number_format($trader["balance"],2);?></b> </td>
        </tr>
        <tr>  
            <td  style="border-top: 1px solid #ddd;"> </td>
            <td style="padding-top: 10px; padding-bottom: 10px; border-top: 1px solid #ddd; padding-left: 10px; padding-right: 10px;"><b>Grand Total </b>  </td>
            <td style="border-top: 1px solid #ddd; padding-left: 10px; padding-right: 10px; text-align: right;"> <b> 
            <?php $grand_total = $amount+$crop->transaction_balance + $trader["balance"];?>
            <?php echo number_format($grand_total,2);?> </b> </td>
        </tr>
</table>
