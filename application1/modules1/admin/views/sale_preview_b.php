<?php
 /**
 * Sale Invoice Preview Before Placing order
 *
 * Billing Address
 *
 * @category   Sale
 * @author     Srikanthi <srikanthi.mdw@gmail.com>
 * @copyright  2020-21 The MDW Pvt Ltd
 * @version    2.0
 * @link      
 * @since      File available since Release 1
 * @deprecated 
 */
//echo "<pre>"; print_r($_POST); echo "</pre>"; //exit;
?>
<style type="text/css">
    table {min-width: auto!important;}
    table th{width: auto;font-size:12px;}
    table td{font-size:12px;color: #777;}
</style>
<div style="width: 950px">
<table class="" style="width: 100%; margin: 0px auto; font-size: 12px; font-family: arial;" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td colspan="3" width=""
            style="text-align: left; font-size: 9px; border-top: 1px solid #afafaf; background-color: #fff;  border-left: 1px solid #afafaf;">
            &nbsp; &nbsp; <img src="<?php echo base_url();?>assets/images/logo.png" class="logo" style="width:150px; margin-top: 10px; margin-bottom: 5px;">
            
        </td>
        <td colspan="4" width="" style="border-top: 1px solid #afafaf; padding-right: 16px; border-right: 1px solid #afafaf; background-color: #fff;">
        
            <table class="" style="width: 100%; border:none; text-align: right; margin: 0px auto; font-size: 12px; font-family: arial;"
                border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td style="padding: 3px 0px; display: inline-block; border-right: none;"> Invoice No</td>
                    <td> : </td>
                    <td>  Preview Order </td>
                </tr>
                <tr>
                    <td style="padding: 3px 0px; border:none; display: inline-block;"> Invoice Date </td>
                     <td> : </td>
                    <td style="width: 90px;"> <?php echo date('d-M-Y');?> </td>
                </tr>
                <tr>
                    <td style="padding: 3px 0px; border:none; display: inline-block;"> Order Id </td>
                    <td> : </td>
                    <td>  </td>
                </tr>
            
            </table>
        </td>
    </tr>

    <tr> 
        <td colspan="3" width="" style="text-align: left; font-size: 9px; background-color: #fff; padding-bottom: 8px;  border-bottom: 1px solid #afafaf; border-left: 1px solid #afafaf;">
               <small style="margin-bottom: 5px; font-size: 10px;">&nbsp; &nbsp; &nbsp;  &nbsp;GST No : 37AALCM3939L1ZT</small>
        </td>
        <td colspan="4" width="" style="border-bottom: 1px solid #afafaf; padding-bottom: 8px; text-align: right; padding-right: 16px; border-right: 1px solid #afafaf; background-color: #fff;">
                TAX invoice/Bill of Supply/Cash Memo (Duplicate for Transporter)
        </td>
    </tr>

    <tr>
        <td colspan="3" width=""
            style="font-size: 12px; background-color: #fff; border-bottom: 1px solid #afafaf; line-height: 20px; text-align: center; border-left: 1px solid #afafaf; border-right: 1px solid #afafaf;">
            Details of Receiver | Billed to:
        </td>

        <td colspan="4" width=""
            style="font-size: 12px; background-color: #fff; border-bottom: 1px solid #afafaf; border-right: 1px solid #afafaf; line-height: 20px; text-align: center;">
            Details of Consignee | Shipped to:
        </td>
    </tr>
    <tr>

        <td colspan="3" width=""
            style="font-size: 12px; background-color: #fff; border-bottom: 1px solid #afafaf; padding: 10px; line-height: 12px; border-left: 1px solid #afafaf; border-right: 1px solid #afafaf;">
            <table class="" style="width: 100%; border:none; margin: 0px auto; font-size: 12px; font-family: arial;"
                border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td><?php echo $this->input->post('b_name');?></td>
                </tr>
                <tr>
                    <td style="text-align: left;">
                    <?php echo $this->input->post('b_pincode').", ";  
                    echo $this->input->post('b_address').", "; 
                    echo $this->input->post('b_state'); ?>
                    </td>
                </tr>
                <tr>
                    <td><?php echo $this->input->post('b_mobile'); ?></td>
                </tr>
                <tr>
                    <td>GSTIN:<?php echo $this->input->post('b_gst'); ?>  </td>
                </tr>

            </table>

        </td>

        <td colspan="4" width=""
            style="font-size: 8px; background-color: #fff; padding: 10px; border-right: 1px solid #afafaf; border-bottom: 1px solid #afafaf; line-height: 12px;">
            <table class="" width=""
                style="width: 100%; border:none; margin: 0px auto; font-size: 12px; font-family: arial;" border="0"
                cellpadding="0" cellspacing="0">
                <tr>
                    <td><?php echo $this->input->post('s_name');?></td>
                </tr>
                <tr>
                    <td><?php echo $this->input->post('s_pincode').", ";  
                    echo $this->input->post('s_address').", "; 
                    echo $this->input->post('s_state'); ?> </td>
                </tr>

                <tr>
                    <td style="text-transform: capitalize;"><?php echo $this->input->post('s_mobile');?></td>
                </tr>
                <tr>
                    <td>Transport: <?php echo ($this->input->post('transport_type') == "user") ? "User Vehicle" : "SSA Vehicle"; ?></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td width=""
            style="width: 67px; text-align: center; line-height: 20px; border-top: 1px solid #afafaf; background-color: #fbd4c6; border-left: 1px solid #afafaf; border-right: 1px solid #afafaf; border-bottom: 1px solid #afafaf;">
            # </td>
        <td width=""
            style="border-right: 1px solid #afafaf;text-align: center;line-height: 20px; border-top: 1px solid #afafaf; background-color: #fbd4c6; width: 328px; border-bottom: 1px solid #afafaf;">
            Item </td>
        <td
            style="border-right: 1px solid #afafaf; text-align: center; line-height: 20px; border-top: 1px solid #afafaf; width: 138px; background-color: #fbd4c6; border-bottom: 1px solid #afafaf;">
            HSN </td>
        <td
            style="border-right: 1px solid #afafaf; line-height: 20px; text-align: center; border-top: 1px solid #afafaf; background-color: #fbd4c6; border-bottom: 1px solid #afafaf; text-align: center; width: 63px;">
            Qty </td>
        <td width="63"
            style="border-right: 1px solid #afafaf; text-align: right; text-align: center; line-height: 20px; width: 155px; border-top: 1px solid #afafaf; background-color: #fbd4c6; border-bottom: 1px solid #afafaf;">
            Value &nbsp; </td>
        <td
            style="border-right: 1px solid #afafaf; text-align: center; width: 63px; line-height: 20px; border-top: 1px solid #afafaf; background-color: #fbd4c6; border-bottom: 1px solid #afafaf;">
            Tax &nbsp; </td>
        <td
            style=" border-bottom: 1px solid #afafaf;  border-right: 1px solid #afafaf;  border-top: 1px solid #afafaf; width: 135px; line-height: 20px; background-color: #fbd4c6; text-align: center;">
            Total &nbsp;</td>
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
        <td
            style="text-align: center; border-bottom: 1px solid #afafaf; background-color: #fff; border-right: 1px solid #afafaf; border-left: 1px solid #afafaf;">
            <br /><?php echo $i++;?> </td>
        <td style="border-right: 1px solid #afafaf; border-bottom: 1px solid #afafaf; width: 120px;"> <br /> &nbsp;
            <?php echo $item->pname." - ".$item->qty." ".$units->unit_name.'/'.$packing->packing_type ;?></td>
        <td style="border-right: 1px solid #afafaf; text-align: center; width: 50px; border-bottom: 1px solid #afafaf; ">
            <br /> <?php echo $item->hsn;?> </td>
        <td style="border-right: 1px solid #afafaf; border-bottom: 1px solid #afafaf;text-align: center; width: 30px;">
            <br /> &nbsp; <?php echo $this->input->post('proqty')[$key];?> </td>

        <td style="border-right: 1px solid #afafaf; text-align: right; border-bottom: 1px solid #afafaf; ">
            <br /> <?php echo '₹ '.$before_tax*$this->input->post('proqty')[$key]; ?> &nbsp; </td>
        <td style="border-right: 1px solid #afafaf; text-align: right; border-bottom: 1px solid #afafaf; "> <br />
            <?php if($tax== NULL) echo "NULL"; else echo $tax."%";?> &nbsp; </td>
        <td style="border-bottom: 1px solid #afafaf; border-right: 1px solid #afafaf; background-color: #fff; width: 63px; text-align: right;">
            <br /> <?php  echo '₹ '.$this->input->post('protot')[$key];?>
            &nbsp; </td>
    </tr>
    <?php
		/* if ($location_type == 1) {
			$total_cgst += $igst/2*$item->qty;
		}
		else
		{
			$total_igst += $igst*$item->qty;
		}
		$TotalDiscount += $applied_discount_val*$item->qty;
		$TotalDealPrice += $item->deal_price * $item->qty; */
	} 
    
   
    $fill_rows = 14 - 10;
    for ($j=0; $j<$fill_rows; $j++) {
        ?>
        <tr>
            <td
                style="text-align: center; border-bottom: 1px solid #afafaf; background-color: #fff; border-right: 1px solid #afafaf; border-left: 1px solid #afafaf;">
                <br /> </td>
            <td style="border-right: 1px solid #afafaf; border-bottom: 1px solid #afafaf; width: 120px;"> <br /> &nbsp;
            </td>
            <td style="border-right: 1px solid #afafaf; width: 50px; border-bottom: 1px solid #afafaf; "> <br /> </td>
            <td style="border-right: 1px solid #afafaf; border-bottom: 1px solid #afafaf;text-align: center; width: 30px;">
                <br /> </td>

            <td style="border-right: 1px solid #afafaf;border-bottom: 1px solid #afafaf; "> <br /> </td>
            <td style="border-right: 1px solid #afafaf; border-bottom: 1px solid #afafaf; "> <br /> </td>
            <td
                style="border-bottom: 1px solid #afafaf; border-right: 1px solid #afafaf; background-color: #fff; width: 63px; text-align: right;">
                <br />
                &nbsp; </td>
        </tr>
    <?php
    }?>

   
    <tr>
        <td colspan="3" style="background-color: #fff; text-align: left; padding-left: 0px; padding-bottom: 10px; border-bottom: 1px solid #afafaf;">
            <table border="0" cellpadding="1" style="width: 100%; text-align: left; font-size: 13px; margin: 0px auto" cellspacing="2">
                <tr>
                    <td>Above invoice inclusive of aqua cash redemption </td>
                </tr>
                <tr>
                    <td>This is computer generated Invoice, no signature is required </td>
                </tr>
            </table>
        </td>
        <td colspan="4" style="background-color: #fff; padding: 10px 0px; border-bottom:1px solid #afafaf;">
         
            <table border="0" cellpadding="0" style="width: 100%; font-size: 13px;" cellspacing="0">
            <?php if($TotalDiscount >0){?>
                <tr>
                    <td style="text-align: right; color: green"> Promotional Offers </td>
                    <td style="text-align: right; text-align: right; color: green"> -
					<?php echo '₹ '.$TotalDiscount;?> &nbsp;&nbsp; </td>
                </tr>
            <?php }?>
                
                <?php
       			 if ($location_type == 1) { ?>
                <tr>
                    <td style="text-align: right; "> CGST </td>
                    <td style="text-align: right;">  <?php echo '₹ '.money_format('%!i', $total_cgst);?> &nbsp;&nbsp; </td>
                </tr>
                <tr>
                    <td style="text-align: right;"> SGST </td>
                    <td style="text-align: right; text-align: right;">  <?php echo '₹ '.money_format('%!i', $total_cgst);?>
                        &nbsp;&nbsp; </td>
                </tr>
                <?php
				}
				else{	?>
                <tr>
                    <td style="text-align: right;"> IGST <br /> </td>
                    <td style="text-align: right;">  <?php echo '₹ '.$total_igst;?> &nbsp;&nbsp; </td>
                </tr>
                <?php
                }
                ?>
                <tr>
                    <td style=" line-height: 25px; text-align: right;">
                       <strong> Grand Total </strong></td>
                    <td style=" line-height: 25px;  text-align: right;"><strong>
					<?php echo '₹ '.$this->input->post("gtotamtval");?> &nbsp;</strong> </td>
                </tr>
            </table>

        </td>
    </tr>

    <tr>
        <td colspan="7" style="line-height: 25px; text-align: center; padding-top: 10px; font-size: 14px;"> <b>www.aquadeals.in, 96527 83399. &nbsp;&nbsp;&nbsp; <span style="position: relative; top: -2px;">|</span> &nbsp;&nbsp; <b>&nbsp;A unit of Miledeep works Pvt. Ltd.</b> </b> </td>
    </tr>

</table>
</div>
<?php exit;?>