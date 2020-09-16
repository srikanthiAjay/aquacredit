<table cellspacing="0" cellpadding="2" border="0" style="width: 100%; font-family: arial; border: 1px solid #ddd; padding:10px 20px;">
    <tr>
        <td colspan="3" style="text-align: left; font-size: 9px;">
            &nbsp; &nbsp; <img src="<?php echo base_url();?>assets/images/logo.png" class="logo" style="width:100px;">
           
        </td>
        <td colspan="3" style=""> <br />
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
    <tr style="">
        <td colspan="3" style="padding-right: 10px; border-right: 1px solid #ddd; border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; width: 50%; font-size: 9px;">
            <b> Details of Receiver | Billed to:</b>
        </td>
        <td colspan="3" style="padding-left: 10px; border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; width: 50%; font-size: 9px;">
            <b>Details of Consignee | Shipped to:</b>
        </td>
    </tr>
   
          
           
                <tr>
                    <td style="padding-top:0px; border-right: 1px solid #ddd;" colspan="3">

                        <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                            <tr> 
                                <td style="font-size: 9px; "><?php echo $sale->b_name;?>                                  
                                </td>
                                </tr>                     
                        <tr> 
                                <td style="font-size: 9px;"><b style="font-size: 9px">Address:</b> <?php echo $sale->b_address.", ";  echo $sale->b_mobile.", "; echo $sale->b_state.", "; echo $sale->b_pincode;?> 
                        </td>
                                </tr>
                       <tr> 
                        <td style="font-size: 9px;"><b style="font-size: 9px">GST: </b>  <?php echo $sale->b_gst; ?>

                        </td>
                            </tr>
                        </table>
                
                    </td>
                    <td colspan="3">
                        <table border="0" cellpadding="0" cellspacing="0" style="padding:0px; width: 100%;">
                            <tr> 
                                <td style="padding-left:5px; padding-right:5px; font-size: 9px"><?php echo $sale->s_name;?> 
                        </td>
                                </tr>
                       <tr> 
                        <td style="font-size: 9px;"><b style="font-size: 9px">Address:</b> <?php echo $sale->s_address.", ";  
                                echo $sale->s_mobile.", "; echo $sale->s_state.", "; 
                                echo $sale->s_pincode; ?> 
                                </td>
                                </tr>
                       <tr> 
                        <td style="font-size: 9px;"><b style="font-size: 9px">Transport: </b> <?php echo $sale->vehicle_number; ?>
                    </td>
                            </tr>
                        </table>
                    </td>
                </tr>
         
      <tr> 
        <td colspan="0" style="border-top: 1px solid #ddd; font-size: 9px; width: 95px;"> Product Name </td>
        <td colspan="0" style="border-top: 1px solid #ddd; font-size: 9px; border-left: 1px solid #ccc;"> HSN </td>
        <td colspan="0" style="border-top: 1px solid #ddd; font-size: 9px; width: 35px; border-left: 1px solid #ccc;"> Qty </td>
        <td colspan="0" style="border-top: 1px solid #ddd; font-size: 9px; border-left: 1px solid #ccc;"> Value </td>
        <td colspan="0" style="border-top: 1px solid #ddd; font-size: 9px; border-left: 1px solid #ccc;"> Tax </td>
        <td colspan="0" style="border-top: 1px solid #ddd; font-size: 9px; border-left: 1px solid #ccc;"> Total </td>
      </tr>

        
            <!--     <tr>
                    <td style="text-align: left; padding: 2px 5px; border-left: 1px solid #ccc; border-right: 1px solid #ccc; border-top: 1px solid #ccc;">Product Name</td>
                    <td style="text-align: center; padding: 2px 5px; width: 80px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; background: #f8f8f8;">HSN</td>
                    <td style="text-align: center; padding: 2px 5px; width: 20px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; background: #f8f8f8;">Qty</td>
                    <td style="text-align: right; padding: 2px 5px; width: 60px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; background: #f8f8f8;">Value </td>
                    <td style="text-align: right; padding: 2px 5px; width:50px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; background: #f8f8f8;">Tax </td>
                    <td style="text-align: right; padding: 2px 5px; width: 100px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; background: #f8f8f8;">Total</td>
                </tr> -->
                <?php
                    
                    $i=1;
                    $total_cgst = 0;
                    $total_igst = 0;
                    $applied_discount = 0;
                    $total_sale_amount = 0;
                    $count = count($details);
                        foreach ($details as $item) {
                        
                            $product = $this->db->select('per_item,weightage,qty,tax')->get_where("products",["pid"=>$item->id])->row();
                            $packing = $this->db->get_where("packing_types", ['id' => $product->per_item])->row(); echo //$this->db->last_query(); exit;
                            $units = $this->db->get_where("units", ['id' => $product->weightage])->row();
                            $tax = $item->tax;
                            $before_tax = (100*$item->total_price)/(100+$tax);       
                            ?>

                            <tr> 
                             <td colspan="0" style="border-top: 1px solid #ddd; font-size: 9px;"> <?php echo $item->pname;?> </td>
        <td colspan="0" style="border-top: 1px solid #ddd; border-left: 1px solid #ccc; font-size: 9px;"> <?php echo $item->hsncode;?> </td>
        <td colspan="0" style="border-top: 1px solid #ddd; border-left: 1px solid #ccc; font-size: 9px;"> <?php echo $item->quantity;?> </td>
        <td colspan="0" style="border-top: 1px solid #ddd; border-left: 1px solid #ccc; font-size: 9px;"> <?php echo number_format($before_tax * $item->quantity,2); ?> </td>
        <td colspan="0" style="border-top: 1px solid #ddd; border-left: 1px solid #ccc; font-size: 9px;"> <?php echo $tax;?>% </td>
        <td colspan="0" style="border-top: 1px solid #ddd; border-left: 1px solid #ccc; font-size: 9px;"> <?php  echo number_format($item->total_price,2);?> </td>
                            </tr>
              <!--   <tr>
                    <td style="border-right: 1px solid #ccc; padding: 2px 5px; border-left: 1px solid #ccc;  border-top: 1px solid #ccc;"></td>
                    <td style="text-align: center; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 80px;"></td>
                    <td style="text-align: center; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 20px;"></td>
                    <td style="text-align: right; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 60px"></td>
                    <td style="text-align: right; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width:50px"></td>
                    <td style="text-align: right; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 100px;"></td>
                </tr> -->
                <?php 
                $total_igst += $igst*$item->qty;
                }
                $fill_rows = 9 - $count;
                for ($j=0; $j<$fill_rows; $j++) {
                    ?>   
                  <tr> 
        <td colspan="0" style="border-top: 1px solid #ddd"> </td>
        <td colspan="0" style="border-top: 1px solid #ddd; border-left: 1px solid #ccc;">  </td>
        <td colspan="0" style="border-top: 1px solid #ddd; border-left: 1px solid #ccc;">  </td>
        <td colspan="0" style="border-top: 1px solid #ddd; border-left: 1px solid #ccc;">  </td>
        <td colspan="0" style="border-top: 1px solid #ddd; border-left: 1px solid #ccc;">  </td>
        <td colspan="0" style="border-top: 1px solid #ddd; border-left: 1px solid #ccc;">  </td>
      </tr>
                <?php 
                }?>
                
                <?php if($sale->total_discount > 0){?>
                <tr>
                    <td colspan="5" style="border-right: 1px solid #ddd; font-size: 9px; padding: 2px 5px; text-align: right; color: green; font-size: 9px; border-top: 1px solid #ddd; border-bottom: 1px solid #ddd;">Promotional Offers </td>
                    <td style=" font-size: 9px; color: green; padding: 2px 5px; text-align: right; border-bottom: 1px solid #ddd;  border-top: 1px solid #ddd;"><?php echo number_format($sale->total_discount,2);?></td>
                </tr>
                <?php }?>
                <tr>

                    <td colspan="5" style="font-size:9px; border-top: 1px solid #ddd; padding: 2px 5px; border-bottom: 1px solid #ddd; text-align: right;   border-left: 1px solid #ddd;">CGST </td>
                    <td style="font-size:9px; border-top: 1px solid #ddd; border-left: 1px solid #ddd; padding: 2px 5px; border-bottom: 1px solid #ccc; text-align: right;"><?php echo number_format($total_igst/2,2);?></td>
                </tr>
                <tr>
                    <td colspan="5" style=" padding: 2px 5px;  font-size: 9px; text-align: right; border-left: 1px solid #ddd;">SGST </td>
                    <td style="border-right: 1px solid #ddd; border-left: 1px solid #ddd;  font-size: 9px;  text-align: right;  "><?php echo number_format($total_igst/2,2);?></td>
                </tr>
                <tr>
                    <td colspan="5" style="padding: 5px 5px; text-align: right; border-bottom: 1px solid #ddd; border-top: 1px solid #ddd; font-size: 9px;"><b>Total Amount</b></td>
                    <td style="border-right: 1px solid #ddd; padding: 5px 5px; text-align: right; border-bottom: 1px solid #ccc;  border-top: 1px solid #ddd;  font-size: 9px;"><b><?php echo number_format($sale->total_saleprice,2);?></b></td>
                </tr>
                <tr> <td colspan="5" style="padding: 2px;"> &nbsp; </td> </tr>
                <tr>
                    <td colspan="3" style="text-align: left; font-size: 7px;  padding: 2px 5px; border-top: 1px solid #ddd;">Above invoice inclusive of aqua cash redemption </td>
                    <td colspan="2" style=" padding: 2px 5px; text-align: right;  border-left: 1px solid #ddd; border-top: 1px solid #ddd; font-size: 9px;" valign="middle">Loading Charges </td>
                    <td style="padding: 2px 5px; text-align: right; font-size: 9px; border-left: 1px solid #ddd; border-top: 1px solid #ddd;"><?php echo number_format($sale->load_charge,2);?></td>
                </tr>

                <tr>
                    <td colspan="3" style="text-align: left; font-size: 7px; padding: 2px 5px; border-top: 1px solid #ddd;">This is computer generated Invoice, no signature is required </td>
                    <td colspan="2" style="padding: 2px 5px; text-align: right;   border-left: 1px solid #ddd; border-top: 1px solid #ddd; font-size: 9px;" valign="middle">Transport Charges </td>
                    <td style="border-left: 1px solid #ddd; font-size: 9px; padding: 2px 5px; text-align: right;   border-top: 1px solid #ddd;"><?php echo number_format($sale->transport_charge,2);?></td>
                </tr>
                <?php $grand_total =   $sale->total_saleprice +  $sale->transport_charge +$sale->load_charge; ?>
                <tr>
                    <td colspan="3" style="border-top: 1px solid #ddd;"> </td>
                    <td colspan="2" style="font-size: 9px; border-top: 1px solid #ddd; padding-top: 10px; padding-bottom: 10px; text-align: right;"><b>Grand Total </b></td>
                    <td style="font-size: 9px; border-top: 1px solid #ddd; padding-top: 10px; padding-bottom: 10px; text-align: right;"><b><?php echo number_format($grand_total,2);?></b></td>
                </tr>

           
</table>
