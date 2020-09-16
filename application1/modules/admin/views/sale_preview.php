<?php
 /**
 * Sale Invoice Preview Before Placing order
 *
 * @category   Sale
 * @author     Srikanthi <srikanthi.mdw@gmail.com>
 * @copyright  2020-21 The MDW Pvt Ltd
 * @version    1.0
 * @link      
 * @since      File available since Release 1
 * @deprecated 
 */
?>

<div class="pop_blk_prive">
<table cellspacing="0" cellpadding="0" border="0" style="width: 100%; font-family: arial; border-top: 1px solid #ccc; padding:10px 20px;">
    <tr>
        <td style="padding-right: 10px; padding-top: 10px; padding-bottom: 10px; width: 50%;">
            <p style="font-size: 13px; margin: 0px; padding: 0px;"> <b> Details of Receiver | Billed to:</b> </p>
        </td>
        <td style="padding-left: 10px; padding-top: 10px; padding-bottom: 10px; width: 50%;">
            <p style="font-size: 13px; margin: 0px; padding: 0px;"> <b>Details of Consignee | Shipped to:</b> </p>
        </td>
    </tr>
    <tr> <td colspan="2"> <table cellspacing="0" cellpadding="0" border="0" style="width: 100%;">
    <tr>
        <td style="padding:5px 10px; margin-top: 10px; border: 1px solid #000;">
            <p style="font-size: 13px; padding: 0px; margin: 0px 0px 5px 0px;"> <?php echo $this->input->post('b_name');?> </p>
            <p style="font-size: 13px; padding: 0px; margin: 0px 0px 5px 0px;"> <b>Address:</b> <?php echo $this->input->post('b_address').", ";  echo $this->input->post('b_mobile').", "; echo $this->input->post('b_state').", "; echo $this->input->post('b_pincode');?> </p>
            <p style="font-size: 13px; padding: 0px; margin: 0px 0px 5px 0px;"> <b> GST: </b>  <?php echo $this->input->post('b_gst'); ?></p>
        </td>
        <td style="width: 20px;"> </td>
        <td style="padding:5px 10px; margin-top: 10px; border: 1px solid #000;">
            <p style="font-size: 13px; padding: 0px; margin: 0px 0px 5px 0px;"> <?php echo $this->input->post('s_name');?> </p>
            <p style="font-size: 13px; padding: 0px; margin: 0px 0px 5px 0px;"> <b>Address:</b> <?php echo $this->input->post('s_address').", ";  
                    echo $this->input->post('s_state').", "; echo $this->input->post('s_mobile').", "; 
                    echo $this->input->post('s_pincode'); ?> </p>
            <p style="font-size: 13px; padding: 0px; margin: 0px 0px 5px 0px;"> <b> Transport: </b> <?php echo ($this->input->post('transport_type') == "user") ? "User Vehicle" : "SSA Vehicle"; ?></p>
        </td>
    </tr>
</table>

<table style="width:100%; margin-top: 10px; font-size: 13px;" cellpadding="5" cellspacing="0" border="0">
    <tr>
        <th style="text-align: left; padding: 2px 5px; border-left: 1px solid #ccc; border-right: 1px solid #ccc; border-top: 1px solid #ccc; background: #f8f8f8;">Product Name</th>
        <th style="text-align: center; padding: 2px 5px; width: 80px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; background: #f8f8f8;">HSN</th>
        <th style="text-align: center; padding: 2px 5px; width: 60px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; background: #f8f8f8;">Qty</th>
        <th style="text-align: right; padding: 2px 5px; width: 80px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; background: #f8f8f8;">Value </th>
        <th style="text-align: right; padding: 2px 5px; width:60px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; background: #f8f8f8;">Tax </th>
        <th style="text-align: right; padding: 2px 5px; width: 100px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; background: #f8f8f8;">Total</th>
    </tr>
    <?php
 
	$i=1;
	$total_cgst = 0;
	$total_igst = 0;
	$TotalDiscount = 0;
	$Total = 0;
    $TotalDealPrice = 0; 
    //$products = $this->input->post('proname');

    $this->db->select('pid,pname,hsn,pmrp,brand_id,per_item,weightage,qty,tax');
    $this->db->where_in("pid",$this->input->post('proid'));
    
    $products = $this->db->get('products')->result();
    //echo $this->db->last_query(); exit;
    $count = count($this->input->post("promrpval"));
    foreach ($products as $key => $item){  
        $packing = $this->db->get_where("packing_types", ['id' => $item->per_item])->row(); echo //$this->db->last_query(); exit;
        $units = $this->db->get_where("units", ['id' => $item->weightage])->row();
        $tax = $item->tax;
        $before_tax = (100*$this->input->post("promrpval")[$key])/(100+$tax);

        $itemPrice = $this->input->post("promrpval")[$key] * $this->input->post("proqty")[$key];
        $Total += $itemPrice;

        $itemDisPrice = $this->input->post("prototval")[$key];
        $TotalDealPrice += $itemDisPrice;
        $TotalDiscount = $Total - $TotalDealPrice;
        $taxValue =  $itemDisPrice * $tax / 100;
        $total_igst += $taxValue;
        ?>
    <tr>
        <td style="border-right: 1px solid #ccc; padding: 2px 5px; border-left: 1px solid #ccc;  border-top: 1px solid #ccc;"><?php echo $item->pname." - ".$item->qty." ".$units->unit_name.'/'.$packing->packing_type ;?></td>
        <td style="text-align: center; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 80px;"><?php echo $item->hsn;?></td>
        <td style="text-align: center; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 60px;"><?php echo $this->input->post('proqty')[$key];?></td>
        <td style="text-align: right; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 80px"><?php echo '₹ '.number_format($before_tax*$this->input->post('proqty')[$key],2); ?></td>
        <td style="text-align: right; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width:60px"><?php if($tax== NULL) echo "NULL"; else echo $tax."%";?></td>
        <td style="text-align: right; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 100px;"><?php  echo '₹ '.$this->input->post('protot')[$key];?></td>
    </tr>
    <?php 
    }

    $fill_rows = 14 - $count;
    for ($j=0; $j<$fill_rows; $j++) {
        ?>   
    <tr>
        <td style="border-right: 1px solid #ccc; padding: 2px 5px; border-left: 1px solid #ccc; border-top: 1px solid #ccc; border-bottom: 1px solid #ccc;  ">&nbsp;</td>
        <td style="text-align: center; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc;  border-bottom: 1px solid #ccc;width: 80px;">&nbsp;</td>
        <td style="text-align: center; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 60px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; border-bottom: 1px solid #ccc;">&nbsp;</td>
        <td style="text-align: right; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; border-bottom: 1px solid #ccc; width: 80px">&nbsp;</td>
        <td style="text-align: right; padding: 2px 5px; border-bottom: 1px solid #ccc; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width:60px border-bottom: 1px solid #ccc;">&nbsp;</td>
        <td style="text-align: right; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 100px; border-bottom: 1px solid #ccc;">&nbsp;</td>
    </tr>
    <?php 
    }?>
    <?php if($TotalDiscount >0){?>
    <tr>
        <td colspan="5" style="border-right: 1px solid #ccc; padding: 2px 5px; text-align: right; color: green;  border-left: 1px solid #ccc; border-bottom: 1px solid #ccc;">Promotional Offers </td>
        <td style="border-right: 1px solid #ccc; color: green; padding: 2px 5px; text-align: right;   border-bottom: 1px solid #ccc;"><?php echo '₹ '.number_format($TotalDiscount,2);?></td>
    </tr>
    <?php }?>
    <tr>

        <td colspan="5" style="border-right: 1px solid #ccc; padding: 2px 5px; border-bottom: 1px solid #ccc; text-align: right;   border-left: 1px solid #ccc;">CGST </td>
        <td style="border-right: 1px solid #ccc; padding: 2px 5px; border-top: 1px solid #ccc; border-bottom: 1px solid #ccc; text-align: right;   border-top: 0px solid #ccc;"><?php echo number_format($total_igst/2,2);?></td>
    </tr>
    <tr>

        <td colspan="5" style="border-right: 1px solid #ccc;  padding: 2px 5px; text-align: right;   border-left: 1px solid #ccc;">SGST </td>
        <td style="border-right: 1px solid #ccc;  text-align: right;  "><?php echo number_format($total_igst/2,2);?></td>
    </tr>

    <tr>
        <td colspan="5" style="border-right: 1px solid #ccc; padding: 5px 5px; text-align: right; border-bottom: 1px solid #ccc;  border-left: 1px solid #ccc; border-top: 1px solid #ccc;"><b>Total Amount</b></td>
        <td style="border-right: 1px solid #ccc; padding: 5px 5px; text-align: right; border-bottom: 1px solid #ccc;  border-top: 1px solid #ccc;"><b><?php echo '₹ '.number_format($this->input->post("totamtval"),2);?></b></td>
    </tr>
    <tr> <td colspan="5" style="padding: 2px;"> &nbsp; </td> </tr>
    <tr>
        <td colspan="3" style="text-align: left;  padding: 2px 5px; border-left: 1px solid #ccc; border-top: 1px solid #ccc;"> <p style="margin: 0px; padding: 0px; font-size: 11px;"> Above invoice inclusive of aqua cash redemption </p> </td>
        <td colspan="2" style="border-right: 1px solid #ccc; padding: 2px 5px; text-align: right;   border-left: 1px solid #ccc; border-top: 1px solid #ccc;">Loading Charges </td>
        <td style="border-right: 1px solid #ccc; padding: 2px 5px; text-align: right;   border-top: 1px solid #ccc;"><?php echo '₹ '.number_format($this->input->post("load_charge"),2);?></td>
    </tr>

    <tr>
        <td colspan="3" style="text-align: left; padding: 2px 5px; border-left: 1px solid #ccc;border-top: 1px solid #ccc; border-bottom: 1px solid #ccc; "> <p style="margin: 0px; padding: 0px; font-size: 11px;"> This is computer generated Invoice, no signature is required </p>  </td>
        <td colspan="2" style="border-right: 1px solid #ccc; padding: 2px 5px; border-bottom: 1px solid #ccc; text-align: right;   border-left: 1px solid #ccc; border-top: 1px solid #ccc;">Transport Charges </td>
        <td style="border-right: 1px solid #ccc; padding: 2px 5px; border-bottom: 1px solid #ccc; text-align: right;   border-top: 1px solid #ccc;"><?php echo '₹ '.number_format($this->input->post("transport_charge"),2);?></td>
    </tr>


    <tr>
        <td colspan="3"> </td>
        <td colspan="2" style="font-size: 16px; padding-top: 10px; padding-bottom: 10px; text-align: right;"><b>Grand Total </b></td>
        <td style="font-size: 16px; padding-top: 10px; padding-bottom: 10px; text-align: right;"><b><?php echo '₹ '.number_format($this->input->post("gtotamtval"),2);?></b></td>
    </tr>
    <!-- <tr>
        <td colspan="3" style="border-top: 1px solid #ccc; padding-top: 10px;">   </td>
        <td colspan="3" style="border-top: 1px solid #ccc; padding-top: 10px; text-align: right;"> <button class="btn btn-primary"> Submit </button>  </td>
    </tr> -->
</table>
    </div>


