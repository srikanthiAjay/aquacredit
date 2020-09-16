<table class="" style="width: 100%; margin: 0px auto; font-size: 9px; font-family: arial;" border="0" cellpadding="0"
    cellspacing="0">
    <tr>
        <td colspan="3" width="195"
            style="text-align: left; font-size: 9px; background-color: #fff;  border-left: 0px solid #000;">
            &nbsp; &nbsp; <img src="<?php echo base_url();?>assets/images/logo.png" class="logo" style="width:100px;">
           
        </td>
        <td colspan="4" width="196"
            style="border-right: 0px solid #000; background-color: #fff;"> <br />
            <br />
            <table class="" style="width: 100%; border:none; margin: 0px auto; font-size: 9px; text-align: right; font-family: arial;"
                border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td style="width: 80px;display: inline-block; border-right: none;"> Invoice No</td>
                    <td> : <?php echo $sale->sale_id;?> </td>
                </tr>
                <tr>
                    <td style="width: 80px; border:none; display: inline-block;"> Invoice Date </td>
                    <td> : <?php echo date('d-M-Y',strtotime($sale->created_date));?> </td>
                </tr>
                <tr>
                    <td style="width: 80px; border:none; display: inline-block;"> Order Id </td>
                    <td> : <?php echo $sale->sale_id;?> </td>
                </tr>
            </table>
        </td>
    </tr>

    <tr> 
  <td colspan="2" style="text-align: left; font-size: 7px; background-color: #fff;  border-bottom: 0px solid #afafaf; border-left: 0px solid #000;">
               &nbsp; &nbsp; &nbsp; &nbsp;GST No : 37AALCM3939L1ZT <br/>
        </td>
        <td colspan="5" style="border-bottom: 0px solid #afafaf; text-align: right; font-size: 8px; border-right: 0px solid #000; background-color: #fff;">
TAX invoice/Bill of Supply/Cash Memo (Duplicate for Transporter) &nbsp; &nbsp; &nbsp; &nbsp; <br/>
        </td>
    </tr>

<!--     <tr>
        <td colspan="7"
            style="border-bottom: 0px solid #afafaf; border-top: 0px solid #afafaf; border-right: 0px solid #000; border-left: 0px solid #000; font-size: 9px; line-height: 20px; text-align: center; background-color: #fff">
            TAX invoice/Bill of Supply/Cash Memo (Duplicate for Transporter)</td>
    </tr> -->
    <tr>
        <td colspan="3" width="195"
            style="font-size: 9px; background-color: #fff; border-bottom: 0px solid #afafaf; line-height: 20px; text-align: center; border-left: 0px solid #000; border-right: 0px solid #afafaf;">
            Details of Receiver | Billed to:
        </td>

        <td colspan="4" width="196"
            style="font-size: 9px; background-color: #fff; border-bottom: 0px solid #afafaf; border-right: 0px solid #000; line-height: 20px; text-align: center;">
            Details of Consignee | Shipped to:
        </td>
    </tr>
    <tr>

        <td colspan="3" width="195"
            style="font-size: 8px; background-color: #fff; border-bottom: 0px solid #afafaf; line-height: 12px; border-left: 0px solid #000; border-right: 0px solid #afafaf;">
            <table class="" style="width: 100%; border:none; margin: 0px auto; font-size: 8px; font-family: arial;"
                border="0" cellpadding="0" cellspacing="0">                
                <tr>
                    <td><?php echo $sale->b_name;?> </td>
                </tr>
                <tr>
                    <td style="text-align: left;"><?php echo $sale->b_address.","; ?>
                        <?php echo $sale->b_state; ?>,
                        <?php echo $sale->b_pincode; ?>
                    </td>
                </tr>
                <tr>
                    <td><?php echo $sale->b_mobile;?> </td>
                </tr>
                <tr>
                    <td>GSTIN: <?php echo $sale->b_gst;?> </td>
                </tr>
                   

            </table>

        </td>

        <td colspan="4" width="196"
            style="font-size: 8px; background-color: #fff; border-right: 0px solid #000; border-bottom: 0px solid #afafaf; line-height: 12px;">
            <table class="" width="200"
                style="width: 100%; border:none; margin: 0px auto; font-size: 8px; font-family: arial;" border="0"
                cellpadding="0" cellspacing="0">
                <tr>
                    <td><?php echo $sale->s_name; ?> </td>
                </tr>
                <tr>
                    <td><?php echo $sale->s_address; ?>,
                        <?php echo $sale->s_state; ?>,
                        <?php echo $sale->s_pincode; ?> </td>
                </tr>

                <tr>
                    <td style="text-transform: capitalize;"><?php echo $sale->s_mobile;?> </td>
                </tr>
                <tr>
                    <td>Transport: <?php echo $sale->vehicle_number;?> </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td width="25"
            style="width: 25px; text-align: center; line-height: 20px; border-top: 0px solid #afafaf; background-color: #fbd4c6; border-left: 0px solid #000; border-right: 0px solid #afafaf; border-bottom: 0px solid #6b6b6b;">
            # </td>
        <td width="120" style="border-right: 0px solid #afafaf;line-height: 20px; text-align: center; border-top: 0px solid #afafaf; background-color: #fbd4c6; width: 120px; border-bottom: 0px solid #afafaf;">
            Item </td>
        <td style="border-right: 0px solid #afafaf; text-align: center; line-height: 20px; border-top: 0px solid #afafaf; width: 50px; background-color: #fbd4c6; border-bottom: 0px solid #afafaf;">
            HSN </td>
        <td style="border-right: 0px solid #afafaf; line-height: 20px; border-top: 0px solid #afafaf; background-color: #fbd4c6; border-bottom: 0px solid #afafaf; text-align: center; width: 30px;">
            Qty </td>
        <td width="73" style="border-right: 0px solid #afafaf; text-align: center; line-height: 20px; border-top: 0px solid #afafaf; background-color: #fbd4c6; border-bottom: 0px solid #afafaf;">
            Value &nbsp; </td>
        <td style="border-right: 0px solid #afafaf; text-align: center; width: 30px; line-height: 20px; border-top: 0px solid #afafaf; background-color: #fbd4c6; border-bottom: 0px solid #afafaf;">
            Tax &nbsp; </td>
        <td style=" border-bottom: 0px solid #afafaf;  border-right: 0px solid #000;  border-top: 0px solid #afafaf; width: 63px; line-height: 20px; background-color: #fbd4c6; text-align: center;">
            Total &nbsp;</td>
    </tr>
    <?php
 
 $i=1;
 $total_cgst = 0;
 $total_igst = 0;
 $applied_discount = 0;
 $total_sale_amount = 0;
    foreach ($details as $item) {
       
        $product = $this->db->select('per_item,weightage,qty,tax')->get_where("products",["pid"=>$item->id])->row();
        $packing = $this->db->get_where("packing_types", ['id' => $product->per_item])->row(); echo //$this->db->last_query(); exit;
        $units = $this->db->get_where("units", ['id' => $product->weightage])->row();
        $tax = $product->tax;
        $before_tax = (100*$item->total_price)/(100+$tax);       
        /*if($item->cart_discount != 0)
        {
            //$product_discount = $item->deal_price - ($item->mrp * $item->cart_discount)/100;
            if($discount_type == '2')
            {
                $after_discount = $item->deal_price - ($item->cart_discount/$item->qty);
            }
            else
            {
                $after_discount = $item->mrp - ( ($item->mrp * $item->cart_discount)/100);
            }
            $after_discount_before_tax = (100*$after_discount)/(100+$tax);
            $igst = $after_discount - $after_discount_before_tax;
            $discount = $item->deal_price - $after_discount;
            $applied_discount += $item->discount_value;
        }
        else
        {
            $after_discount = $item->deal_price;
            $before_tax = (100*$item->deal_price)/(100+$tax);
            $igst = $item->deal_price - $before_tax;
        }
        $total_sale_amount += $after_discount*$item->qty; */
        ?>

        <tr>
            <td
                style="width: 25px; text-align: center; border-bottom: 0px solid #afafaf; background-color: #fff; border-right: 0px solid #afafaf; border-left: 0px solid #000;">
                <br /><?php echo $i++;?> </td>
            <td style="border-right: 0px solid #afafaf; border-bottom: 0px solid #afafaf; width: 120px;">&nbsp; <?php echo $item->pname;?> <?php //echo $item->pqty .' '.$item->unit." ";?> &nbsp;&nbsp;</td>
            <td style="border-right: 0px solid #afafaf; text-align: center; width: 50px; border-bottom: 0px solid #afafaf; ">
                <?php echo $item->hsncode;?> </td>
            <td style="border-right: 0px solid #afafaf; border-bottom: 0px solid #afafaf;text-align: center; width: 30px;">
                &nbsp; <?php echo $item->quantity;?> </td>

            <td width="73" style="border-right: 0px solid #afafaf; text-align: right; border-bottom: 0px solid #afafaf; ">
                <br /> <?php //echo number_format(($before_tax*$item->qty),2);?> &nbsp; </td>
            <td style="border-right: 0px solid #afafaf; text-align: right; border-bottom: 0px solid #afafaf; "> <br />
                <?php echo $tax;?> % &nbsp; </td>
            <td
                style="border-bottom: 0px solid #afafaf; border-right: 0px solid #000; background-color: #fff; width: 63px; text-align: right;">
                <br /> <?php echo number_format($item->total_price,2);?>
                &nbsp; </td>
        </tr>
        <?php
		/* if ($location_type == 1) {
			$total_cgst += $igst/2*$item->qty;
		}
		else
		{
			$total_igst += $igst*$item->qty;
        } */
        $total_igst += $igst*$item->qty;
    } 
    
    $extra = 15-10;
    for ($j=0; $j<$extra; $j++) {
        ?>
        <tr>
            <td
                style="width: 25px; text-align: center; border-bottom: 0px solid #afafaf; background-color: #fff; border-right: 0px solid #afafaf; border-left: 0px solid #000;">
                <br /> </td>
            <td style="border-right: 0px solid #afafaf; border-bottom: 0px solid #afafaf; width: 120px;"> <br /> &nbsp;
            </td>
            <td style="border-right: 0px solid #afafaf; width: 50px; border-bottom: 0px solid #afafaf; "> <br /> </td>
            <td style="border-right: 0px solid #afafaf; border-bottom: 0px solid #afafaf;text-align: center; width: 30px;">
                <br /> </td>

            <td width="73" style="border-right: 0px solid #afafaf;border-bottom: 0px solid #afafaf; "> <br /> </td>
            <td style="border-right: 0px solid #afafaf; border-bottom: 0px solid #afafaf; "> <br /> </td>
            <td
                style="border-bottom: 0px solid #afafaf; border-right: 0px solid #000; background-color: #fff; width: 63px; text-align: right;">
                <br />
                &nbsp; </td>
        </tr>

    <?php
    }?>    
  
    <tr>
        <td colspan="3"
            style="background-color: #fff; text-align: left; padding-left: 20px; border-bottom: 0px solid #000;">
            <br /> <br />
            <?php if($sale->total_discount > 0)
            {?>
                <br/><br/>
                <?php
            }?>  

            <table border="0" cellpadding="1" style="width: 100%; text-align: left; font-size: 7px; margin: 0px auto"
                cellspacing="2">
                <tr>
                    <td>Above invoice inclusive of aqua cash redemption </td>
                </tr>
                <tr>
                    <td>This is computer generated Invoice, no signature is required </td>
                </tr>
            </table>


        </td>
        <td colspan="4" style="background-color: #fff; ">
            <br /> <br />
            <table border="0" cellpadding="0" style="width: 100%;" cellspacing="0">
            <?php if($sale->total_discount > 0)
            {?>
                <tr>
                    <td style="text-align: right; color: green"> Promotional Offers </td>
                    <td style="text-align: right; text-align: right; color: green"> -
                        <?php echo number_format($sale->total_discount, 2);
                        //echo number_format($applied_discount, 2);                         
                        ?> &nbsp;&nbsp; </td>
                </tr>
                <?php
            }?>    
               <!--  <tr>
                    <td style="text-align: right;"> Shipping Charges </td>
                    <td style="text-align: right; text-align: right;"> + 0 &nbsp;&nbsp; </td>
                </tr> -->
                <?php
       			/*  if ($location_type == 1) { ?>
                <tr>
                    <td style="text-align: right; "> CGST </td>
                    <td style="text-align: right;">  <?php echo number_format($total_cgst,2);?> &nbsp;&nbsp; </td>
                </tr>
                <tr>
                    <td style="text-align: right;"> SGST </td>
                    <td style="text-align: right; text-align: right;">  <?php echo number_format($total_cgst,2);?>
                        &nbsp;&nbsp; </td>
                </tr>
                <?php
				}
				else{ */	?>
                <tr>
                    <td style="text-align: right;"> IGST </td>
                    <td style="text-align: right;">  <?php //echo number_format($total_igst,2);?> &nbsp;&nbsp; </td>
                </tr>
                <?php
                /* }
                if($sale->shipment_charge > 0 && $sale->to_pay_flag !="1"){?>
                <tr>
                    <td style="text-align: right;"> Shipping Charges </td>
                    <td style="text-align: right; text-align: right;"> + <?php echo number_format($sale->shipment_charge,2);?> &nbsp;&nbsp; </td>
                    <?php $total_sale_amount = $total_sale_amount + $sale->shipment_charge; ?>
                </tr>
                <?php } */?>
                <tr>
                    <td style=" line-height: 20px; border-bottom: 0px solid #000; text-align: right;">
                        Grand Total </td>
                    <td style=" line-height: 20px;  border-bottom: 0px solid #000; text-align: right;">
                    <?php echo number_format($sale->total_saleprice,2);?> &nbsp; </td>
                </tr>
            </table>

        </td>
    </tr>

 <tr>
        <td colspan="7" style=" text-align: center; font-size: 9px;"> <br/> <br/> <b>www.aquadeals.in, 96527 83399. &nbsp;&nbsp;&nbsp; <span style="position: relative; top: -2px;">|</span> &nbsp;&nbsp; <b>&nbsp;A unit of Miledeep works Pvt. Ltd.</b> </b> </td>
    </tr>

</table>
<?php //exit;?>