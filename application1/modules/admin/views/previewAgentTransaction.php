<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
	<table style="border: 1px solid #ccc; font-family: arial; font-size: 12px; text-align: left;" width="595" border="0" cellpadding="0" cellspacing="0"> 	
		<tr>
			<td colspan="3" style="background: #ddd; padding: 10px 10px 0px 20px;"> <h1 style="color: #373c4f;font-weight: bold;;font-size: 16px; margin: 0px;">  <?php echo $trader["full_name"];?> / <small><?php echo $trader["firm_name"];?> 	</small> / <small> #<?php echo $trader["trader_code"];?> </small> </h1> </td>
		 </tr>
			<tr> 
				<td colspan="1" style="padding: 10px; background: #ddd; padding-left: 20px; border-bottom: 1px solid #ddd"> 
					<!-- 	<h1 style="color: #373c4f;font-weight: bold;;font-size: 16px; margin-top: 0px; margin-bottom: 5px;"> 	</h1> -->
				Mobile: <b><?php echo $trader["mobile_no"];?></b>
						 
				 </td>
				 <td colspan="2" style="padding: 10px; background: #ddd; padding-right: 20px; text-align: right; border-bottom: 1px solid #ddd"> 
                    <?php $last = count($transactions); ?>
                    <span style="color: red"><?php echo date("d-M-Y",strtotime($transactions[0]["created_on"]));?>to <?php echo date("d-M-Y",strtotime($transactions[$last-1]["created_on"]));?></span>
                
				 	
				 </td>
			</tr>
			<tr> 
					<th style="padding: 10px; padding-left: 20px; border-bottom: 1px solid #ddd"> Date </th>
					<th style="padding: 10px; border-bottom: 1px solid #ddd"> Detail </th>
					<!-- <th style="padding: 10px; border-bottom: 1px solid #ddd"> Crop Location </th>
					<th style="padding: 10px; text-align: right; border-bottom: 1px solid #ddd"> In </th> -->
					<th style="padding: 10px; text-align: right; border-bottom: 1px solid #ddd; padding-right: 20px;"> Out </th>
			</tr>
			<?php foreach($transactions as $value) {
            $trans = ($value['trans'] != null) ? "(".$value['trans'].")" : "";
            $amt = ($value["amount_type"] == "OUT") ? "-".$value['amount'] : "+".$value['amount'];
            ($value["amount_type"] == "OUT") ? $amount -=$value['amount'] : $amount +=$value["amount"] ;
            ?>           
                <tr> 
                    <td style="padding-top: 10px; padding-left: 20px; padding-right: 10px;">  <?php echo date("d-M-Y",strtotime($value["created_on"]));?> </td>
                    <td style="padding-top: 10px; padding-left: 10px; padding-right: 10px;"> <?php echo $value["trans_type"].' '.$trans.' - '.$value["trans_code"];?>  </td>
                    <!-- <td style="padding-top: 10px; padding-left: 10px; padding-right: 10px;"> <?php echo $value["mobile"];?>Kakinada </td> -->
                    <!-- <td style="padding-top: 10px; padding-left: 10px; padding-right: 10px; text-align: right;"> </td> -->
                    <td style="padding-top: 10px; padding-left: 10px; padding-right: 20px; text-align: right;"> <?php echo $amt;?> </td>
                </tr>
        <?php }?>

			<tr> 
				<td style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding-top: 10px; padding-bottom: 10px;"> </td>
				<td style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding-top: 10px; padding-left: 10px; padding-right: 10px; padding-bottom: 10px;"> <b>Total</b> </td>
				<td style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding-top: 10px; padding-left: 10px; padding-right: 10px; padding-bottom: 10px; text-align: right;"> <b><?php echo $amount;?></b> </td>
			</tr>
			<tr> 
				<td> </td>
				<td style="padding-top: 10px; padding-left: 10px; padding-right: 10px;padding-bottom: 10px;"> <b>Balance</b> </td>
				<td style="padding-top: 10px; padding-left: 10px; padding-right: 10px; text-align: right;padding-bottom: 10px;"> <b><?php echo $trader["balance"];?></b> </td>
			</tr>
			<tr>  
				<td style="border-top: 1px solid #ddd;"> </td>
				<td style="padding-top: 10px; padding-bottom: 10px; border-top: 1px solid #ddd; padding-left: 10px; padding-right: 10px;">  <b> Grand Total </b>  </td>
				<td style="border-top: 1px solid #ddd; padding-left: 10px; padding-right: 10px; text-align: right;"> <b> <?php echo $amount+$crop->transaction_balance + $trader["balance"];?> </b> </td>
			</tr>
    </table>
    <a href="javascript:void(0);" id="print_transaction"  title="" class="btn ed_usr btn-primary fr"> Print </a>
</body>
<script src="<?php echo base_url();?>assets/js/jquery-1.10.2.js"></script>
<script type="text/javascript">

var url = '<?php echo base_url() ?>';
$(document).ready(function() {
    $(document).on("click", "#print_transaction",function(){
		console.log('print');
		trader_id = "<?php echo $trader["td_id"];?>";

		window.location.href = "<?php echo base_url('api/traders/printAgentTrans');?>/"+trader_id;
	});
});
</script>
</html>