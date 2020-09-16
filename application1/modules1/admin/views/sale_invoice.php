<table cellspacing="0" cellpadding="0" border="0" style="width: 100%; font-family: arial; border-top: 1px solid #ccc; padding:10px 20px;">
    <tr>
        <td style="text-align: left; font-size: 9px; background-color: #fff;  border-left: 0px solid #000;">
            &nbsp; &nbsp; <img src="<?php echo base_url();?>assets/images/logo.png" class="logo" style="width:100px;">
           
        </td>
        <td style="border-right: 0px solid #000; background-color: #fff;"> <br />
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
        <td style="padding-right: 10px; padding-top: 10px; padding-bottom: 10px; width: 50%;">
            <p style="font-size: 9px; margin: 0px; padding: 0px;"> <b> Details of Receiver | Billed to:</b> </p>
        </td>
        <td style="padding-left: 10px; padding-top: 10px; padding-bottom: 10px; width: 50%;">
            <p style="font-size: 9px; margin: 0px; padding: 0px;"> <b>Details of Consignee | Shipped to:</b> </p>
        </td>
    </tr>
    <tr> 
        <td colspan="2"> 
            <table cellspacing="0" cellpadding="0" border="0" style="width: 100%;">
                <tr>
                    <td style="padding:5px 10px; margin-top: 10px; border: 1px solid #000;">
                        <p style="font-size: 13px; padding: 0px; margin: 0px 0px 5px 0px;"> <?php echo $sale->b_name;?> </p>
                        <p style="font-size: 13px; padding: 0px; margin: 0px 0px 5px 0px;"> <b>Address:</b> <?php echo $sale->b_address.", ";  echo $sale->b_mobile.", "; echo $sale->b_state.", "; echo $sale->b_pincode;?> </p>
                        <p style="font-size: 13px; padding: 0px; margin: 0px 0px 5px 0px;"> <b> GST: </b>  <?php echo $sale->b_gst; ?></p>
                    </td>
                    <td style="width: 20px;"> </td>
                    <td style="padding:5px 10px; margin-top: 10px; border: 1px solid #000;">
                        <p style="font-size: 13px; padding: 0px; margin: 0px 0px 5px 0px;"> <?php echo $sale->s_name;?> </p>
                        <p style="font-size: 13px; padding: 0px; margin: 0px 0px 5px 0px;"> <b>Address:</b> <?php echo $sale->s_address.", ";  
                                echo $sale->s_mobile.", "; echo $sale->s_state.", "; 
                                echo $sale->s_pincode; ?> </p>
                        <p style="font-size: 13px; padding: 0px; margin: 0px 0px 5px 0px;"> <b> Transport: </b> <?php echo $sale->vehicle_number; ?></p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <table style="width:100%; margin-top: 10px; font-size: 9px;" cellpadding="5" cellspacing="0" border="0">
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
                    $applied_discount = 0;
                    $total_sale_amount = 0;
                        foreach ($details as $item) {
                        
                            $product = $this->db->select('per_item,weightage,qty,tax')->get_where("products",["pid"=>$item->id])->row();
                            $packing = $this->db->get_where("packing_types", ['id' => $product->per_item])->row(); echo //$this->db->last_query(); exit;
                            $units = $this->db->get_where("units", ['id' => $product->weightage])->row();
                            $tax = $product->tax;
                            $before_tax = (100*$item->total_price)/(100+$tax);       
                            ?>
                <tr>
                    <td style="border-right: 1px solid #ccc; padding: 2px 5px; border-left: 1px solid #ccc;  border-top: 1px solid #ccc;"><?php echo $item->pname;?></td>
                    <td style="text-align: center; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 80px;"><?php echo $item->hsncode;?></td>
                    <td style="text-align: center; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 60px;"><?php echo $item->quantity;?></td>
                    <td style="text-align: right; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 80px"><?php //echo '₹ '.number_format($before_tax*$this->input->post('proqty')[$key],2); ?></td>
                    <td style="text-align: right; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width:60px"><?php echo $tax;?>%</td>
                    <td style="text-align: right; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 100px;"><?php  echo number_format($item->total_price,2);?></td>
                </tr>
                <?php 
                $total_igst += $igst*$item->qty;
                }
                $fill_rows = 14 - 5;
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
                
                <?php if($sale->total_discount > 0){?>
                <tr>
                    <td colspan="5" style="border-right: 1px solid #ccc; padding: 2px 5px; text-align: right; color: green;  border-left: 1px solid #ccc; border-bottom: 1px solid #ccc;">Promotional Offers </td>
                    <td style="border-right: 1px solid #ccc; color: green; padding: 2px 5px; text-align: right;   border-bottom: 1px solid #ccc;"><?php echo '₹ '.number_format($sale->total_discount,2);?></td>
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
                    <td style="border-right: 1px solid #ccc; padding: 5px 5px; text-align: right; border-bottom: 1px solid #ccc;  border-top: 1px solid #ccc;"><b><?php echo number_format($sale->total_saleprice,2);?></b></td>
                </tr>
                <tr> <td colspan="5" style="padding: 2px;"> &nbsp; </td> </tr>



                <tr>
                    <td colspan="3" style="text-align: left;  padding: 2px 5px; border-left: 1px solid #ccc; border-top: 1px solid #ccc;"> <p style="margin: 0px; padding: 0px; font-size: 11px;"> Above invoice inclusive of aqua cash redemption </p> </td>
                    <td colspan="2" style="border-right: 1px solid #ccc; padding: 2px 5px; text-align: right;   border-left: 1px solid #ccc; border-top: 1px solid #ccc;">Loading Charges </td>
                    <td style="border-right: 1px solid #ccc; padding: 2px 5px; text-align: right;   border-top: 1px solid #ccc;"><?php echo number_format($sale->load_charge,2);?></td>
                </tr>

                <tr>
                    <td colspan="3" style="text-align: left; padding: 2px 5px; border-left: 1px solid #ccc;border-top: 1px solid #ccc; border-bottom: 1px solid #ccc; "> <p style="margin: 0px; padding: 0px; font-size: 11px;"> This is computer generated Invoice, no signature is required </p>  </td>
                    <td colspan="2" style="border-right: 1px solid #ccc; padding: 2px 5px; border-bottom: 1px solid #ccc; text-align: right;   border-left: 1px solid #ccc; border-top: 1px solid #ccc;">Transport Charges </td>
                    <td style="border-right: 1px solid #ccc; padding: 2px 5px; border-bottom: 1px solid #ccc; text-align: right;   border-top: 1px solid #ccc;"><?php echo number_format($sale->transport_charge,2);?></td>
                </tr>
                <?php $grand_total =   $sale->total_saleprice +  $sale->transport_charge +$sale->load_charge; ?>
                <tr>
                    <td colspan="3"> </td>
                    <td colspan="2" style="font-size: 16px; padding-top: 10px; padding-bottom: 10px; text-align: right;"><b>Grand Total </b></td>
                    <td style="font-size: 16px; padding-top: 10px; padding-bottom: 10px; text-align: right;"><b><?php echo number_format($sale->grand_total,2);?></b></td>
                </tr>
                <tr>
                    <td colspan="3" style="border-top: 1px solid #ccc; padding-top: 10px;">   </td>
                    <td colspan="3" style="border-top: 1px solid #ccc; padding-top: 10px; text-align: right;"> <button class="btn btn-primary"> Submit </button>  </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
