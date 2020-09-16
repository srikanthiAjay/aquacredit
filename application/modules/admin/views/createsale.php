<?php require_once 'header.php' ; ?>
<link href="<?php echo base_url();?>assets/css/createsale.css" type="text/css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/css/createbrand.css" type="text/css" rel="stylesheet">
<?php require_once 'sidebar.php' ; ?>
<link href="<?php echo base_url();?>assets/css/all.css" type="text/css" rel="stylesheet">
<style>
#invoice_preview_modal .modal-dialog {max-width: 100%; overflow: auto; margin: 0px auto; padding: 10px; box-sizing: border-box;}
#invoice_preview_modal .panel-body {overflow: auto;}
#snackbar {
  visibility: hidden;
  min-width: 300px;
  margin-left: -150px;
  background-color: red;
  color: #fff;
  text-align: center;
  border-radius: 2px;
  padding: 10px;
  position: absolute;
  z-index: 1;
  left: 50%;
  top: 5px;
  font-size: 17px;
}
#snackbar.show {
  visibility: visible;
  -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
  animation: fadein 0.5s, fadeout 0.5s 2.5s;
}
.sbt_btn {margin-left: 20px; margin-bottom: 10px; font-size: 13px;}

#snackbar1 {
  visibility: hidden;
  min-width: 300px;
  margin-left: -150px;
  background-color: red;
  color: #fff;
  text-align: center;
  border-radius: 2px;
  padding: 10px;
  position: absolute;
  z-index: 1;
  left: 50%;
  top: 5px;
  font-size: 17px;
}
#snackbar1.show {
  visibility: visible;
  -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
  animation: fadein 0.5s, fadeout 0.5s 2.5s;
}
@-webkit-keyframes fadein {
  from {top: 0; opacity: 0;} 
  to {top: 5px; opacity: 1;}
}

@keyframes fadein {
  from {top: 0; opacity: 0;}
  to {top: 5px; opacity: 1;}
}
.ui-autocomplete{
	position: absolute;
}
.per_dtls {padding: 20px 20px 0px 20px; border-bottom: 10px solid #f0f1f5;}		
</style>
<div class="right_blk">
	
	<div class="top_ttl_blk"> 
		<!-- <span class="back_btn"><a href="<?php echo base_url();?>admin/sales" title=""><img src="<?php echo base_url();?>assets/images/back.png" alt="" title=""> </a></span> --> <span> <?php echo $page_title;?></span>
		<a href="<?php echo base_url();?>admin/sales" title="" class="fr btn btn-primary"> Show all sales  </a>
		<div id="snackbar" class=""></div>
	</div>
	<form id="salefrm" name="salefrm" action="javascript:void(0);" method="post">
	<div class="sale_rt">

		<h2 class="create_hdg"> Transport Details </h2>
		<ul class="create_ul"> 

										<li class="create_li slc_usr">
												<div class="check_wt_serc"> 
													<div class="show_va">Select  Transport</div>
													<div class="selectVal">  Transport Type<span style="color: red">*</span> </div>
													<ul class="check_list mykey" id="trn1"> 
														<li id="transport_opt_li">
															<div class="form-check">
															  <input class="form-check-input" type="radio" name="transport_type" id="trns1" value="ssa">
															  <label class="form-check-label" for="trns1">
															  	SSA Vehicle
															  </label>
															</div>
														</li>
														<li id="transport_opt_li">
															<div class="form-check">
															  <input class="form-check-input" type="radio" name="transport_type" id="trns2" value="user">
															  <label class="form-check-label" for="trns2">
															 	User Vehicle
															  </label>
															</div>
														</li>
													</ul>												
												</div>
												</li>

												<li class="create_li">
													<div class="cre_inp">
													  <div class="sm_blk"><span style="color: red">*</span> Driver Name </div>
													    <input type="text" class="form-control mykey" placeholder="" data-original-title="" title="" name="driver_name" id="driver_name" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)" value="test">
													 </div>
													</li>
													 <li class="create_li ">
													 	<div class="cre_inp">
													  <div class="sm_blk"> <span style="color: red">*</span> Driver Mobile </div>
													    <input type="text" onkeypress="return onlyNumberKey(event)" maxlength="10" class="form-control mykey" placeholder="" data-original-title="" title="" name="driver_mobile" id="driver_mobile" value="9874563215">
													</div>
													 </li>
													  <li class="create_li ">
													 	<div class="cre_inp">
													  <div class="sm_blk"> <span style="color: red">*</span> Vehicle Number </div>
													    <input type="text" class="form-control mykey" placeholder="" data-original-title="" title="" name="vehicle_number" id="vehicle_number" value="5345345345">
													</div>
													 </li>
		</ul>

		<h2 class="create_hdg">  Shipping Address </h2>
		<ul class="create_ul"> 
			<li class="create_li ">
			 	<div class="cre_inp">
			  		<div class="sm_blk"> <span style="color: red">*</span> Name</div>
			    	<input type="text" class="form-control mykey" placeholder="" data-original-title="" title="" name="s_name" id="s_name" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)" value="test">
				</div>
			</li>
	 		<li class="create_li ">
	 			<div class="cre_inp">
	  				<div class="sm_blk"> <span style="color: red">*</span> Mobile</div>
	    			<input type="text" onkeypress="return onlyNumberKey(event)" maxlength="10" class="form-control mykey" placeholder="" data-original-title="" title="" name="s_mobile" id="s_mobile" value="9874563215">
				</div>
	 		</li>
			 <li class="create_li ">
			 	<div class="cre_inp">
			  		<div class="sm_blk"> <span style="color: red">*</span> Address</div>
			    	<input type="text" class="form-control mykey" placeholder="" data-original-title="" title="" name="s_address" id="s_address" value="Kakinada">
				</div>
			 </li>
			<li class="create_li ">
			 	<div class="cre_inp">
			  		<div class="sm_blk"> <span style="color: red">*</span> State</div>
			    	<input type="text" class="form-control mykey" placeholder="" data-original-title="" title="" name="s_state" id="s_state" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)" value="AP">
				</div>
			 </li>

			<li class="create_li ">
			 	<div class="cre_inp">
			  		<div class="sm_blk"> <span style="color: red">*</span> Pin code</div>
			    	<input type="text" class="form-control mykey" onkeypress="return onlyNumberKey(event)" placeholder="" data-original-title="" title="" name="s_pincode" id="s_pincode" maxlength="6" value="533002">
				</div>
			 </li>

		</ul>
		<div class="checkbox">
  			<label class="chek_bx"><input type="checkbox" value="" name="billadd" id="billadd" > Billing and shipping address are same </label><input type="hidden" value="" name="addresstype" id="addresstype" >
		</div>
		<div class="bil_add">
			<h2 class="create_hdg"> Billing Address </h2>
			<ul class="create_ul"> 
					<li class="create_li ">
					 	<div class="cre_inp">
					  <div class="sm_blk"> <span style="color: red">*</span> Name</div>
					    <input type="text" class="form-control mykey" placeholder="" data-original-title="" title="" name="b_name" id="b_name" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)" value="Kakinada">
					</div>
					</li>
					<li class="create_li ">
					 	<div class="cre_inp">
					  <div class="sm_blk"> <span style="color: red">*</span> Mobile</div>
					    <input type="text" onkeypress="return onlyNumberKey(event)" class="form-control mykey" placeholder="" data-original-title="" title="" name="b_mobile" id="b_mobile" value="9632587415">
					</div>
					</li>

					<li class="create_li ">
					 	<div class="cre_inp">
					  <div class="sm_blk"> <span style="color: red">*</span> Address</div>
					    <input type="text" class="form-control mykey" placeholder="" data-original-title="" title="" name="b_address" id="b_address" value="Kakinada">
					</div>
					</li>

					<li class="create_li ">
					 	<div class="cre_inp">
					  <div class="sm_blk"> <span style="color: red">*</span> State</div>
					    <input type="text" class="form-control mykey" placeholder="" data-original-title="" title="" name="b_state" id="b_state" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)" value="AP">
					</div>
					</li>

					<li class="create_li ">
					 	<div class="cre_inp">
					  <div class="sm_blk"> <span style="color: red">*</span> Pin code</div>
					    <input type="text" onkeypress="return onlyNumberKey(event)" class="form-control mykey" placeholder="" data-original-title="" title="" name="b_pincode" id="b_pincode"  maxlength="6" value="5332255">
					</div>
					</li>

					<li class="create_li ">
					 	<div class="cre_inp">
					  <div class="sm_blk"> <span style="color: red">*</span>GST</div>
					    <input type="text" class="form-control mykey" placeholder="" data-original-title="" title="" name="b_gst" id="b_gst" value="3453453">
					</div>
		 			</li>

			</ul>
		</div>
	</div>
	<div class="sle_cr_r"> 
		<!-- <h2 class="create_hdg"> Loan Request </h2> -->

		<ul class="assign_type" id="saletype">  

			<li class="act_type lnk_typ crd_sale" onclick="return ttype('credit');"> 
				<img src="http://3.7.44.132/aquacredit/assets/images/credit_icn.png">
				<input type="radio" name="sale_types" value="credit" checked  >
				<span> Credit Sale </span>
			</li>
			<li class="cash_sale lnk_typ" onclick="return ttype('cash');"> 
				<img src="http://3.7.44.132/aquacredit/assets/images/cash_icn.png">
				<input type="radio" name="sale_types" value="cash"  >
				<span> Cash Sale </span>
			</li>
		
				<li style="display: none;" id="guestlink"> <a class="purc_btn cr_st_usr" href="javascript:void(0)">Create Guest User</a> </li>
			

		</ul>

		<ul class="create_ul"> 
					<li class="create_li slc_usr">
						<div class="check_wt_serc wth_225_sel" id="branchlist"> 
							<div class="show_va"> <span style="color: red">*</span> Select  Branch</div>
							<div class="selectVal">  <span style="color: red">*</span> Select  Branch </div>
							<ul class="check_list mykey" id="brn_l"> 
								<li id="crop_opt_li">
									<div class="form-check">
										<input class="form-check-input" type="radio" name="branchval" id="branch" value="">
										<label class="form-check-label" for="branch">
															 	Select Branch
										</label>
									</div>
								</li>
							</ul>												
						</div>
					</li>
					<li class="create_li">
						<div class="cre_inp">
						  <div class="sm_blk"> <span style="color: red">*</span>User Name/Mobile </div>
						    <input type="text" class="form-control mykey" placeholder="" data-original-title="" title="" name="ukey" id="ukey">
						    <input type="hidden" class="form-control" placeholder=""  name="userid" id="userid">
						    <input type="hidden" class="form-control" placeholder=""  name="usertype" id="usertype">
						  </div>
						 <div class="err_msg" style="display: none;"> User Not Found </div>
					</li>
					<!-- crop locatiom -->
					<li class="create_li slc_usr" id="cropdis" >
						<div class="check_wt_serc wth_225_sel" id="branchlist"> 
							<div class="show_va"> <span style="color: red">*</span> Crop location</div>
							<div class="selectVal crop_type_val"> <span style="color: red">*</span> Crop location </div>
							<ul class="check_list mykey" id="crop_1"> 
                            <li id="crops_opt_li">
                              <div class="form-check">
                                <input class="form-check-input mykey" type="radio" name="crop_opt" id="crop_opt" >
                                <label class="form-check-label" >
                                Crop Location
                                </label>
                              </div>
                            </li>
                          </ul>    												
						</div>
					</li>
					<!-- crop location -->
					<li class="create_li " style="display: none;" id="guestmobile">
					 	<div class="cre_inp">
					  		 <div class="sm_blk"> <span style="color: red">*</span> Mobile </div>
					    	<input type="text" onkeypress="return onlyNumberKey(event)" maxlength="10" class="form-control mykey" placeholder="" data-original-title="" title="" name="mobile" id="mobile"> 
					    	
						</div>
					</li>
					
		</ul>
	<div class="add_more">
		<a href="javascript:void(0);" onclick="addmorerows();" >Add More</a>
		<input type="hidden" id="provalidation" value="0">
	</div>
		<div class="res_tbl">

			<table class="sa_lst" cellpadding="0" cellspacing="" border="0">
				<thead>
				<tr> 
					<th> Product Name </th>
					<th class="qty txt_cnt"> Qty </th>
					<th class="mrp txt_rt"> MRP </th>
					<th class="disc txt_rt" id="prodiscdisplaytd"> Discount </th>
					<th class="ttl_prc txt_rt"> Total Price </th>
					<th class="dele_th_td"> Delete </th>
				</tr>
				</thead><input type="hidden" id="rowval" value="0">
				<tbody id="invoiceItem">
					
					<!-- <tr id="rowNums0"> 
						<td> <input type="hidden" class="mykey" name="proid[]" id="proid0" value="0">
							 <input type="text" autocomplete="off" class="mykey" placeholder="Product Name" name="proname[]" id="proname0" > </td>
						<td class="qty txt_cnt"> <input type="text" class="mykey" placeholder="0" onkeypress="return onlyNumberKey(event)" name="proqty[]" id="proqty0"> </td>
						<td class="mrp txt_rt"> <input type="text" class="mykey" placeholder="0" name="promrp[]" id="promrp0" readonly><input type="hidden" class="mykey" placeholder="0" name="promrpval[]" id="promrpval0" > </td>
						<td class="disc txt_rt"> <input type="text" onkeypress="return onlyNumberKey(event)" class="mykey disckey" placeholder="0" name="prodisc[]" id="prodisc0" readonly> </td>
						<td class="ttl_prc txt_rt"> <input type="text" class="mykey" placeholder="0" name="protot[]" id="protot0" readonly>
						<input type="hidden" placeholder="0" name="prototval[]" id="prototval0" >
						 </td>
						 <td class="dele_th_td"><i class="fa fa-trash" onclick="removerow(0)" style="color:red"></i></td>
					</tr> -->

				</tbody>
				<tfoot>
					<tr>
						<td colspan="4" class="txt_rt"> <b> Total Amount </b> </td>
						<td class="txt_rt ttl_prc" colspan="2"> <b id="totamt"> 0 </b> 
						<input type="hidden" placeholder="0" name="totamtval" id="totamtval" >
						<input type="hidden" placeholder="0" name="totdiscount" id="totdiscount" >
						</td>
					</tr>
				</tfoot>
			</table>
				
			<table class="sa_lst mar_sale_ttl" cellpadding="0" cellspacing="" border="0">
					<tr>
						<td class="txt_rt"> Loading Charges </td>
						<td class="txt_rt ttl_prc"> <input type="text" onkeypress="return onlyNumberKey(event)" value="0" name="load_charge" id="load_charge"> </td>
					</tr>
					<tr>
						<td class="txt_rt"> Transport Charges </td>
						<td class="txt_rt ttl_prc"> <input type="text" onkeypress="return onlyNumberKey(event)" value="0" name="transport_charge" id="transport_charge"> </td>
					</tr>
					<tr>
						<td class="txt_rt"> <b> Grand Total </b> </td>
						<td class="txt_rt ttl_prc"> <b id="gtotamt"> 0 </b> 
						<input type="hidden" placeholder="0" name="gtotamtval" id="gtotamtval" >
						</td>
					</tr>
			</table>
		</div>
		<div id="discash" style="display: none;">
			<h2 class="create_hdg"> <span class="ttl">Amount received</span>
				<span class="create_li">
					<div class="cre_inp">
				  		<div class="sm_blk"> Received Amount </div>
				    	<input type="text" class="form-control" placeholder="" data-original-title="" title="" name="received_amount" id="received_amount" onkeypress="return validateFloatKeyPress(this,event);">
			 		</div>
				</span> 
			</h2>
			<div id="disamt" style="display: none;">
				<ul class="assign_type"> 
					<li class="act_type lnk_typ ban_trns" onclick="return getbanks('bank');"> 
						<img src="http://3.7.44.132/aquacredit/assets/images/bank_tansfer.png">
						<input type="radio" name="paymenttype" value="bank" checked >
						<span> Bank Transfer </span>
					</li>
					<li class="cash_trns lnk_typ" onclick="return getbanks('cash');"> 
						<img src="http://3.7.44.132/aquacredit/assets/images/cash_icn.png">
						<input type="radio" name="paymenttype" value="cash" >
						<span> Cash </span>
					</li>
				</ul>
				<ul class="trans_inf bnk_tr"> 
					<li class="create_li date">
						<div class="cre_inp">
							<div class="sm_blk"> Date </div>
						    <input type="text" class="form-control mykey" placeholder="" data-original-title="" title="" name="payment_date" id="payment_date" onkeydown="return false;" value="<?php echo date('d-M-Y'); ?>">
						</div>
					</li>
					<li class="admin_bank_li" > 
				 		<div class="check_wt_serc wth_225_sel" id="bankslist"> 
				            <div class="show_va" id="bnkval" > Select Bank </div>
				            <div class="selectVal" id="bnkval1" > <span style="color: red">*</span> Select Bank </div>
							<ul class="check_list mykey" id="bnkl"> 
							    <li id="bank_opt_li"> 
								    <div class="form-check">
								  		<input class="form-check-input" type="radio" name="bankid" id="bnk" value="Bank 1">
										<label class="form-check-label" for="bnk">
											Select Bank
										</label>
									</div>
								</li>
							</ul>
						</div>
				 	</li>
					<li class="create_li">
					<div class="cre_inp">
					  <div class="sm_blk"> Reference Number </div>
					    <input type="text" class="form-control mykey"  placeholder="" data-original-title="" title="" name="bank_reference" id="bank_reference">
					 </div>
					</li>
				</ul>
			</div>
		</div>
		<div class="show_note">
		<p></p>
			<div class="note_add"> <a href="#" title=""> <!-- Note --> </a> </div> 
				<textarea placeholder="Note" name="note"></textarea>
			</div>
			<div class="po_ftr">
				<!-- <button class="btn fr sb_btn btn-primary" data-toggle="modal" data-target="#view_order"> Create Order </button> -->
				<button class="btn fr sb_btn btn-primary" type="submit"> Create Order </button>
			</div>
		</div>
	</div>
</form>

<div class="modal fade" id="view_order" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
  	 <div class="modal-content">
  	 	 <div class="modal-body">
  	 	 	<div class="pp_clss" data-dismiss="modal"> <i class="fa fa-times" aria-hidden="true"></i> </div>
  	 	 	<h2 class="create_hdg"> Order View </h2>
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
  
 
    <p style="font-size: 13px; padding: 0px; margin: 0px 0px 5px 0px;"> Sample Name </p>
    <p style="font-size: 13px; padding: 0px; margin: 0px 0px 5px 0px;"> <b>Address:</b> Sample Address, 9876543210, Andhrapradedsh, 533001 </p>
   <p style="font-size: 13px; padding: 0px; margin: 0px 0px 5px 0px;"> <b> GST: </b>  </p>

</td>
<td style="width: 20px;"> </td>
<td style="padding:5px 10px; margin-top: 10px; border: 1px solid #000;"> 
 

    <p style="font-size: 13px; padding: 0px; margin: 0px 0px 5px 0px;"> Sample Name </p>
    <p style="font-size: 13px; padding: 0px; margin: 0px 0px 5px 0px;"> <b>Address:</b> Sample Address, 9876543210, Andhrapradedsh, 533001 </p>
   <p style="font-size: 13px; padding: 0px; margin: 0px 0px 5px 0px;"> <b> Transport: </b> </p>

</td>
</tr>
</table>
</td>
</tr>
<tr>
<td colspan="2">
<table style="width:100%; margin-top: 10px; font-size: 13px;" cellpadding="5" cellspacing="0" border="0">
  <tr>
    <th style="text-align: left; padding: 2px 5px; border-left: 1px solid #ccc; border-right: 1px solid #ccc; border-top: 1px solid #ccc; background: #f8f8f8;">Product Name</th>
    <th style="text-align: center; padding: 2px 5px; width: 80px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; background: #f8f8f8;">HSN</th> 
    <th style="text-align: center; padding: 2px 5px; width: 60px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; background: #f8f8f8;">Qty</th> 
    <th style="text-align: right; padding: 2px 5px; width: 80px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; background: #f8f8f8;">Value </th>
    <th style="text-align: right; padding: 2px 5px; width:60px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; background: #f8f8f8;">Tax </th> 
    <th style="text-align: right; padding: 2px 5px; width: 100px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; background: #f8f8f8;">Total</th>
  </tr>
  <tr>
    <td style="border-right: 1px solid #ccc; padding: 2px 5px; border-left: 1px solid #ccc;  border-top: 1px solid #ccc;">Product Name -2</td>
    <td style="text-align: center; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 80px;">&nbsp;</td> 
    <td style="text-align: center; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 60px;">10</td> 
    <td style="text-align: right; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 80px">2,000</td>
    <td style="text-align: right; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width:60px">20%</td> 
    <td style="text-align: right; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 100px;">1,800</td>
  </tr> 
  <tr>
    <td style="border-right: 1px solid #ccc; padding: 2px 5px; border-left: 1px solid #ccc;  border-top: 1px solid #ccc;">Product Name -3</td>
    <td style="text-align: center; padding:2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 80px;">&nbsp;</td> 
    <td style="text-align: center; padding:2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 60px;">10</td> 
    <td style="text-align: right; padding:2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 80px">2,000</td>
    <td style="text-align: right; padding:2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width:60px">20%</td> 
    <td style="text-align: right; padding:2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 100px;">1,800</td>
  </tr> 
  <tr>
    <td style="border-right: 1px solid #ccc; padding: 2px 5px; border-left: 1px solid #ccc;  border-top: 1px solid #ccc;">Product Name -4</td>
    <td style="text-align: center; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 80px;">&nbsp;</td> 
    <td style="text-align: center; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 60px;">10</td> 
    <td style="text-align: right; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 80px">2,000</td>
    <td style="text-align: right; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width:60px">20%</td> 
    <td style="text-align: right; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 100px;">1,800</td>
  </tr> 
    <tr>
    <td style="border-right: 1px solid #ccc; padding: 2px 5px; border-left: 1px solid #ccc; border-top: 1px solid #ccc;  ">Product Name -5</td>
    <td style="text-align: center; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 80px;">&nbsp;</td> 
    <td style="text-align: center; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 60px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; ">10</td> 
    <td style="text-align: right; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc;  width: 80px">2,000</td>
    <td style="text-align: right; padding: 2px 5px;  border-right: 1px solid #ccc; border-top: 1px solid #ccc; width:60px border-bottom: 1px solid #ccc;">20%</td> 
    <td style="text-align: right; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 100px;">1,800</td>
  </tr> 
    <tr>
    <td style="border-right: 1px solid #ccc; padding: 2px 5px; border-left: 1px solid #ccc; border-top: 1px solid #ccc;  ">Product Name -5</td>
    <td style="text-align: center; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 80px;">&nbsp;</td> 
    <td style="text-align: center; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 60px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; ">10</td> 
    <td style="text-align: right; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc;  width: 80px">2,000</td>
    <td style="text-align: right; padding: 2px 5px;  border-right: 1px solid #ccc; border-top: 1px solid #ccc; width:60px border-bottom: 1px solid #ccc;">20%</td> 
    <td style="text-align: right; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 100px;">1,800</td>
  </tr> 
    <tr>
    <td style="border-right: 1px solid #ccc; padding: 2px 5px; border-left: 1px solid #ccc; border-top: 1px solid #ccc;  ">Product Name -5</td>
    <td style="text-align: center; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 80px;">&nbsp;</td> 
    <td style="text-align: center; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 60px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; ">10</td> 
    <td style="text-align: right; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc;  width: 80px">2,000</td>
    <td style="text-align: right; padding: 2px 5px;  border-right: 1px solid #ccc; border-top: 1px solid #ccc; width:60px border-bottom: 1px solid #ccc;">20%</td> 
    <td style="text-align: right; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 100px;">1,800</td>
  </tr> 
   <tr>
    <td style="border-right: 1px solid #ccc; padding: 2px 5px; border-left: 1px solid #ccc; border-top: 1px solid #ccc;  ">Product Name -5</td>
    <td style="text-align: center; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 80px;">&nbsp;</td> 
    <td style="text-align: center; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 60px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; ">10</td> 
    <td style="text-align: right; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc;  width: 80px">2,000</td>
    <td style="text-align: right; padding: 2px 5px;  border-right: 1px solid #ccc; border-top: 1px solid #ccc; width:60px border-bottom: 1px solid #ccc;">20%</td> 
    <td style="text-align: right; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 100px;">1,800</td>
  </tr>  
    <tr>
    <td style="border-right: 1px solid #ccc; padding: 2px 5px; border-left: 1px solid #ccc; border-top: 1px solid #ccc;  ">Product Name -5</td>
    <td style="text-align: center; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 80px;">&nbsp;</td> 
    <td style="text-align: center; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 60px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; ">10</td> 
    <td style="text-align: right; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc;  width: 80px">2,000</td>
    <td style="text-align: right; padding: 2px 5px;  border-right: 1px solid #ccc; border-top: 1px solid #ccc; width:60px border-bottom: 1px solid #ccc;">20%</td> 
    <td style="text-align: right; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 100px;">1,800</td>
  </tr> 
   <tr>
    <td style="border-right: 1px solid #ccc; padding: 2px 5px; border-left: 1px solid #ccc; border-top: 1px solid #ccc;  ">Product Name -5</td>
    <td style="text-align: center; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 80px;">&nbsp;</td> 
    <td style="text-align: center; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 60px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; ">10</td> 
    <td style="text-align: right; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc;  width: 80px">2,000</td>
    <td style="text-align: right; padding: 2px 5px;  border-right: 1px solid #ccc; border-top: 1px solid #ccc; width:60px border-bottom: 1px solid #ccc;">20%</td> 
    <td style="text-align: right; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 100px;">1,800</td>
  </tr> 
  <tr>
    <td style="border-right: 1px solid #ccc; padding: 2px 5px; border-left: 1px solid #ccc; border-top: 1px solid #ccc; border-bottom: 1px solid #ccc;  ">Product Name -5</td>
    <td style="text-align: center; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc;  border-bottom: 1px solid #ccc;width: 80px;">&nbsp;</td> 
    <td style="text-align: center; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 60px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; border-bottom: 1px solid #ccc;">10</td> 
    <td style="text-align: right; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; border-bottom: 1px solid #ccc; width: 80px">2,000</td>
    <td style="text-align: right; padding: 2px 5px; border-bottom: 1px solid #ccc; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width:60px border-bottom: 1px solid #ccc;">20%</td> 
    <td style="text-align: right; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 100px; border-bottom: 1px solid #ccc;">1,800</td>
  </tr> 
    <tr> 
    <td colspan="5" style="border-right: 1px solid #ccc; padding: 2px 5px; text-align: right; color: green;  border-left: 1px solid #ccc; border-bottom: 1px solid #ccc;">Promotional Offers </td>
    <td style="border-right: 1px solid #ccc; color: green; padding: 2px 5px; text-align: right;   border-bottom: 1px solid #ccc;">-0.00</td>
  </tr>
   <tr> 

    <td colspan="5" style="border-right: 1px solid #ccc; padding: 2px 5px; border-bottom: 1px solid #ccc; text-align: right;   border-left: 1px solid #ccc;">CGST </td>
    <td style="border-right: 1px solid #ccc; padding: 2px 5px; border-top: 1px solid #ccc; border-bottom: 1px solid #ccc; text-align: right;   border-top: 0px solid #ccc;">1000</td>
  </tr>
  <tr> 
      
    <td colspan="5" style="border-right: 1px solid #ccc;  padding: 2px 5px; text-align: right;   border-left: 1px solid #ccc;">SGST </td>
    <td style="border-right: 1px solid #ccc;  text-align: right;  ">1000</td>
  </tr>

  <tr> 
    <td colspan="5" style="border-right: 1px solid #ccc; padding: 5px 5px; text-align: right; border-bottom: 1px solid #ccc;  border-left: 1px solid #ccc; border-top: 1px solid #ccc;"><b>Total Amount</b></td>
    <td style="border-right: 1px solid #ccc; padding: 5px 5px; text-align: right; border-bottom: 1px solid #ccc;  border-top: 1px solid #ccc;"><b>20,000</b></td>
  </tr>
<tr> <td colspan="5" style="padding: 2px;"> &nbsp; </td> </tr>

 

  <tr> 
         <td colspan="3" style="text-align: left;  padding: 2px 5px; border-left: 1px solid #ccc; border-top: 1px solid #ccc;"> <p style="margin: 0px; padding: 0px; font-size: 11px;"> Above invoice inclusive of aqua cash redemption </p> </td>
    <td colspan="2" style="border-right: 1px solid #ccc; padding: 2px 5px; text-align: right;   border-left: 1px solid #ccc; border-top: 1px solid #ccc;">Loading Charges </td>
    <td style="border-right: 1px solid #ccc; padding: 2px 5px; text-align: right;   border-top: 1px solid #ccc;">500</td>
  </tr>

  <tr> 
      <td colspan="3" style="text-align: left; padding: 2px 5px; border-left: 1px solid #ccc;border-top: 1px solid #ccc; border-bottom: 1px solid #ccc; "> <p style="margin: 0px; padding: 0px; font-size: 11px;"> This is computer generated Invoice, no signature is required </p>  </td>
    <td colspan="2" style="border-right: 1px solid #ccc; padding: 2px 5px; border-bottom: 1px solid #ccc; text-align: right;   border-left: 1px solid #ccc; border-top: 1px solid #ccc;">Transport Charges </td>
    <td style="border-right: 1px solid #ccc; padding: 2px 5px; border-bottom: 1px solid #ccc; text-align: right;   border-top: 1px solid #ccc;">1000</td>
  </tr>
 

  <tr> 
      <td colspan="3"> </td>
    <td colspan="2" style="font-size: 14px; padding-top: 10px; padding-bottom: 10px; text-align: right;"><b>Grand Total </b></td>
    <td style="font-size: 14px; padding-top: 10px; padding-bottom: 10px; text-align: right;"><b>21,500</b></td>
  </tr>
  <tr> 
      <td colspan="3" style="border-top: 1px solid #ccc; padding-top: 10px;">   </td>
      <td colspan="3" style="border-top: 1px solid #ccc; padding-top: 10px; text-align: right;"> <button class="btn btn-primary"> Submit </button>  </td>
  </tr>
</table>
</td>
</tr>
</table>
  	 	 </div>
  	 </div>
  </div>
</div>
<div id="invoice_preview_modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:1000px;">
        <div class="modal-content">
            <section class="panel panel-featured panel-featured-danger">
            	
                <header class="panel-heading">
                    <h2 class="panel-title">Order View</h2>
                </header>
                <div class="">
                  <div class="panel-body" id="invoice_body">
                      
                  </div>
                 </div>
                <footer class="panel-footer text-right">  
                	<input type="hidden" value='' id="user_id" /> 
                	<button class="btn btn-default" data-dismiss="modal" id="reset_seller">Cancel</button>
                    <button class="btn btn-primary test_inact" id="confirmOrder">Place Order & Print</button>
                </footer>
           
            </section>
        </div>
    </div>
</div>
<div id="create_module" role="dialog" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="pp_clss" data-dismiss="modal"> <i class="fa fa-times" aria-hidden="true"></i> </div>
				
				<div id="snackbar1" class=""></div>
				<div class="">
					<div class="card_view"> 
						
						<form action="javascript:void(0);" data-toggle="validator" id="add_brand" class="ad_frm" name="add_brand" method="post" >
							<div class="ord_comp_bl">
							<div class="per_dtls">
								<h2 class="create_hdg" style="padding:10px 20px 15px 0px;"> Guest Details</h2>
							<div class="row">
								<div class="col-md-5"> 
									<div class="form-group">
									<span class="border-lable-flt">								
										<input type="text" class="form-control" id="guest_name" name="guest_name"  placeholder=" " data-toggle="tooltip" keypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)" />
										<label for="guest_name" class="control-label required">User Name</label>
									</span>
									</div> 
								</div>
								<div class="col-md-3"> 
									<div class="form-group">
									<span class="border-lable-flt">								
										<input type="text" class="form-control" id="guest_mobile" name="guest_mobile"  placeholder=" " data-toggle="tooltip" onkeypress="return onlyNumberKey(event)" maxlength="10" />
										<label for="guest_mobile" class="control-label required">Mobile</label>
									</span>
									</div> 
								</div>
								<div class="col-md-4"> 
									<div class="form-group">
									<span class="border-lable-flt">								
										<input type="text" class="form-control" id="guest_email" name="guest_email"  placeholder=" " data-toggle="tooltip" />
										<label for="guest_email" class="control-label ">Email</label>
									</span>
									</div> 
								</div>
							</div>
						</div>
							<div class="cat_blk_nn">
										<div class="hdg_bk">Bank Details (<span id="bd_cnt">1</span>) <a href="javascript:void(0)" title="" class="fr ad_bnk"> + Add Bank </a>  </div>

										<div class="bank_list blck_div" id="bank_cnt" data-bank-cnt="1" data-bank-ids="1"> 
											<div class="bank_list_pos">
												<div class="bank_dtl_blk" data-bank-id="bank_acc_1" data-bid="1">
													<div class="row" style="margin-top:25px;"> 
														<div class="col-md-12"> 
															<div class="form-group">
																<span class="border-lable-flt">
																	<!-- label for="name">Account Holder Name</label> -->
																	<input type="text" class="form-control fulnameclass" id="fname_1" name="holder_name[]" placeholder=" " onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)" />
																	<label for="fname_1" class="control-label required">Person Fullname</label>
																</span>
															</div>
														</div>

														<div class="col-md-6"> 
															<div class="form-group">
																<span class="border-lable-flt">
																	<input type="text" class="form-control noalpha acclass" id="ac_number_1" name="acc_no[]" placeholder=" " onkeypress="return onlyNumberKey(event)" />
																	<label for="ac_number_1" class="control-label required">Account Number</label>
																</span>	
															</div>
														</div>

														<div class="col-md-6"> 
															<div class="form-group">
																<span class="border-lable-flt">
																	<input type="text" class="form-control bname bankclass" id="bank_name" name="bank_name[]" placeholder=" " onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)"/>
																	<label for="bank_name" class="control-label required">Bank Name</label>
																</span>
															</div>
														</div>

														<div class="col-md-6"> 
															<div class="form-group">
																<span class="border-lable-flt">
																	<input type="text" class="form-control ifscclass" id="ifsc_1" name="ifsc_code[]" placeholder=" " />
																	<label for="ifsc_1" class="control-label required">IFSC Code</label>
																</span>
															</div>
														</div>

														<div class="col-md-6"> 
															<div class="form-group">
																<span class="border-lable-flt">
																	<input type="text" class="form-control branchclass" id="branch_name_1" name="branch_name[]" placeholder=" " onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)" />
																	<label for="branch_name_1" class="control-label required">Branch Name</label>
																</span>
															</div>
														</div>
														
													</div>
												</div>
											</div>
										</div>
							</div>
							<div class="cat_blk_nn">
								<div class="hdg_bk">Crop Details  (<span id="cd_cnt">1</span>)<a href="javascript:void(0)" title="" class="fr ad_crp"> + Add Crop </a> </div>
								
								<div class="crp_list" id="crop_cnt" data-crop-cnt="1" data-crop-ids="1"> 
									<div class="crp_list_pos">
										<div class="crp_dtl_blk" data-crop-id="crop_details_1" data-cid="1">
											<div class="row" style="margin-top:25px;">
												<div class="col-md-6"> 
													<div class="form-group">
														<span class="border-lable-flt">
														<input type="text" class="form-control cropclass" id="crop_loc_1" name="crop_loc[]" placeholder=" "  onkeypress="return blockSpecialChar(event)" >
														<label  class="control-label required" for="crop_loc_1">Crop Location</label>   
													</span>
													</div>
												</div>

												<div class="col-md-6"> 
													<div class="form-group">
														<span class="border-lable-flt">
														<input type="text" class="form-control" id="crop_type_1" name="crop_type[]" placeholder=" "  onkeypress="return blockSpecialChar(event)" >
														<label  class="control-label " for="crop_type_1">Crop Type</label> 
														</span>   
													</div>
												</div>

												<div class="col-md-6"> 
													<div class="form-group">
														<span class="border-lable-flt">
														<input type="text" class="form-control" id="acres_1" name="acres[]" placeholder=" " onkeypress="return allowNumerORDecimal(event,this)" >
														<label  class="control-label " for="acres_1">Acres</label>  
													</span>
													</div>
												</div>

												<div class="col-md-6"> 
													<div class="form-group">
														<span class="border-lable-flt">
														<input type="text" class="form-control" id="transaction_balance_1" name="transaction_balance[]" placeholder=" " onkeypress="return allowNumerORDecimal(event,this)" maxlength="16">
														<label class="control-label " for="transaction_balance_1">Open Balance</label>  
														</span>
													</div>
												</div>
												
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
							<div class="row">
								<div class="col-md-12">
									<button type="submit" class="btn btn-primary sbt_btn" style="float: right; margin-right: 20px; margin-top: 10px;">Submit</button>

								</div>
							</div>
								</form>
					</div>
				</div>
		</div>
	</div>
</div>
<script type="text/javascript">
var url = '<?php echo base_url()?>';
$('.cre_inp').addClass('inp_ss');
getbranches();
getbanks('bank');
function getbranches()
{ 
  $.ajax({    
    url: url+"api/sales/getbranches",
    data: {},
    type:'POST',    
    datatype:'json',
    success : function(response){
      
      res= JSON.parse(response);        
      
        var opt = "";
        if(res.data.length > 0)
        {
            $.each(res.data, function(index, crop) {
            opt += '<div class="form-check"><input class="form-check-input" onclick="hidecolor('+crop.branch_id+',1);" type="radio" name="branchval" id="branch'+index+'" value="'+crop.branch_id+'" /><label class="form-check-label" for="branch'+index+'">'+crop.branch_name+'</label></div>';
          });
        }
       
        $("#crop_opt_li").html(opt);
    }
  });
}
function validateFloatKeyPress(el, evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode;
    var number = el.value.split('.');
    if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    //just one dot
    if (number.length > 1 && charCode == 46) {
        return false;
    }
    //get the carat position
    var caratPos = getSelectionStart(el);
    var dotPos = el.value.indexOf(".");
    if (caratPos > dotPos && dotPos > -1 && (number[1].length > 1)) {
        return false;
    }
    return true;
}
function hidecolor(val,btype)
{
	$('.mykey').parent().css("border", "");

	$("[id^='proid']").each(function() {
        var id = $(this).attr('id');
        id = id.replace("proid", '');
        

        var prodata = $('#proid'+id).val();
        if(prodata!='' && prodata!=0 && btype!=0)
		{
			$('#proid'+id).val('');
			$('#proname'+id).val('');
			$('#proqty'+id).val('');
			$('#promrpval'+id).val('');
			$('#promrp'+id).val('');
			$('#protot'+id).val('');
			$('#prodisc'+id).val('');
			$('#purchase_amt'+id).val('');
		}     
		calculateTotal();   
    });

}
function getusercrops(user_id,addoredit)
{
  var aeval = hidcrop = "";
  if(addoredit == "edit"){ aeval = "_edit"; hidcrop = $("#hid_crop_id").val();}
  $.ajax({    
    url: url+"api/UserCrops/index/"+user_id,
    data: {},
    type:'POST',    
    datatype:'json',
    success : function(response){
      
      //alert(response);
      res= JSON.parse(response);        
      //alert(res.data.length);
      
      //var usercode = $('#select_usercode'+aeval).val();
      var user_id = $('#userid'+aeval).val();
      var sel = "";
      if(user_id != "")
      {

        //var opt = '<option value="">-- Select Crop --</option>';
        var opt = "";
        if(res.data.length > 0)
        {

          $.each(res.data, function(index, crop) {
            
            if(crop.cd_id == hidcrop){ sel = "checked"; }else{ sel = "";}
            
            opt += '<div class="form-check"><input class="form-check-input" onclick="hidecolor('+crop.cd_id+',0);" type="radio" name="crop_opt'+aeval+'" id="crp'+index+aeval+'" value="'+crop.cd_id+'" '+sel+' /><label class="form-check-label" for="crp'+index+aeval+'">'+crop.crop_location+'</label></div>';
          });
        }
      }else{
        //var opt = '<option value="">-- Select user first --</option>';
        var opt = '';
      }
      $("#crops_opt_li"+aeval).html(opt);
      //$("#crop_opt"+aeval).select2('refresh');
      //document.getElementById("crop_opt"+aeval).fstdropdown.rebind();
    }
  });
}
function getbanks(bval)
{ 
	if(bval=='cash')
	{
		$('#bnkval').text('Select Cash');
		$('#bnkval1').text('Select Cash');
		$('input[name="paymenttype"][value="cash"]').prop('checked', true);
	}
	else
	{
		$('#bnkval').text('Select Bank');
		$('#bnkval1').text('Select Bank');
		$('input[name="paymenttype"][value="bank"]').prop('checked', true);
	}
	var branch = $("input[name='branchval']:checked").val();
	var mainsale_type = $("input[name='sale_types']:checked").val(); 

  	$.ajax({    
    url: url+"api/Banks/getdata1",
    data: {seltype:bval,branch:branch,mainsaletype:mainsale_type},
    type:'POST',    
    datatype:'json',
    success : function(response){
      
      res= JSON.parse(response);        
      
        var opt = "";
        if(res.data.length > 0)
        {
            $.each(res.data, function(index, bank) {
            	var bimg = '';
            		if (bank.account_name == "SBI") { bank_icn = 'sib_icn.png'; } else if (bank.account_name == "HDFC") { bank_icn = 'hdfc_icn.png'; } else if (bank.account_name == "ICICI") { bank_icn = 'icici_icn.png'; }else{ bank_icn = 'cash_account.png'; }

            	   if(bank.account_type=='BANK')
					{
						var amountval = bank.account_number;
					}
					else
					{
						var amountval = bank.account_name;
					}

				opt += '<div class="form-check"><input class="form-check-input" type="radio" name="bankid" id="bnk'+bank.id+'" value="'+bank.id+'"><label class="form-check-label" for="bnk'+bank.id+'"><div class="bank_logo"><img src="http://3.7.44.132/aquacredit/assets/images/' + bank_icn + '" alt="" title=""></div><div class="bank_mny"><div class="bank_bal"> ₹ '+addCommas(bank.avail_amount)+'</div><div class="accont_numb">'+amountval+'</div></div></label></div>';
          });
        }
       
        $("#bank_opt_li").html(opt);
    }
  });
}
function ttype(val)
{
	if(val=='cash')
	{
		$('#guestmobile').hide();
        $('#cropdis').show();
		$('input[name="sale_types"][value="cash"]').prop('checked', true);
		$("#discash").show();
		$('#ukey').val('');
		$('#mobile').val('');
		$('#userid').val('');
		$('.disckey').prop('readonly', false);
		$('#crop_type_val').text('Crop location');
		$("#crops_opt_li").html('');
		$('.prodiscdisplay').show();
	    $('#prodiscdisplaytd').show();
	    $('#guestlink').show();
	}
	else
	{
		$('#guestmobile').hide();
     	$('#cropdis').show();
		$('input[name="sale_types"][value="credit"]').prop('checked', true);
		$("#discash").hide();
		$('#ukey').val('');
		$('#mobile').val('');
		$('#userid').val('');
		$('.disckey').prop('readonly', true);
		$(".crop_type_val").text('Crop location');
		$("#crops_opt_li").html('');
		$('.prodiscdisplay').hide();
	    $('#prodiscdisplaytd').hide();
	    $('#guestlink').hide();
	}
}

var url = '<?php echo base_url()?>';
$(document).ready(function(){

	var rr = 4;
	$('#rowval').val(5);
	var rowNum = 0;
	

	for(var ii=0;ii<=rr;ii++)
	{
		var sale_type = $("input[name='sale_types']:checked").val();
		rowNum ++;
		if(sale_type=='cash')
	    {
	     	var sel = ''; 
	     	$('.prodiscdisplay').show();
	     	$('#prodiscdisplaytd').show();
	     	
	    }
	    else
	    {
	     	var sel = 'readonly';
	     	$('.prodiscdisplay').hide();
	     	$('#prodiscdisplaytd').hide();
	    }
	    
	    htmlRows = '<tr id="rowNums'+rowNum+'" ><td><input type="hidden" placeholder="Product Name" name="proid[]" id="proid'+rowNum+'" value="0" ><input type="hidden" name="inventoryid[]" id="inventoryid'+rowNum+'" value="0"><input type="hidden" name="inventoryqty[]" id="inventoryqty'+rowNum+'" value="0"><input class="mykey" type="text" placeholder="Product Name" autocomplete="off" name="proname[]" id="proname'+rowNum+'" ><input class="mykey" type="hidden" name="purchase_amt[]" id="purchase_amt'+rowNum+'" > </td><td class="qty txt_cnt"> <input type="text" class="mykey" placeholder="0" onkeypress="return onlyNumberKey(event)" name="proqty[]" id="proqty'+rowNum+'"></td><td class="mrp txt_rt"> <input type="text" class="mykey" readonly placeholder="0" name="promrp[]" id="promrp'+rowNum+'"><input type="hidden" placeholder="0" name="promrpval[]" id="promrpval'+rowNum+'"> </td><td class="disc txt_rt prodiscdisplay"  > <input type="text" class="mykey disckey noalpha" placeholder="0" name="prodisc[]" id="prodisc'+rowNum+'" maxlength="4" onkeypress="return validateFloatKeyPress(this,event);" autocomplete="off" '+sel+' > </td><td class="ttl_prc txt_rt"> <input type="text" placeholder="0" readonly name="protot[]" id="protot'+rowNum+'"><input type="hidden" placeholder="0" name="prototval[]" id="prototval'+rowNum+'" > </td><td class="dele_th_td"><i class="fa fa-trash" onclick="removerow('+rowNum+')" style="color:red" ></i></td></tr>';

	    $('#invoiceItem').append(htmlRows);
	    var saletype = $("input[name='sale_types']:checked").val();
    	if(saletype=='cash')
    	{
	     	$('.disckey').prop('readonly', true);
	     	$('.prodiscdisplay').show();
	     	$('#prodiscdisplaytd').show();
	    }
	    else{
	    	$('.disckey').prop('readonly', true);
	    	$('.prodiscdisplay').hide();
	     	$('#prodiscdisplaytd').hide();
	    } 	
	    
	    
	}

	var dateToday = new Date();	
	  $("#payment_date").datepicker({
	    dateFormat: 'dd-M-yy',
	    changeMonth: true,
	    changeYear: true,
	    maxDate: 0
	  });

	$('.lnk_typ.ban_trns').click(function(){
        $(this).addClass('act_type');
        $('.blk_disb').removeClass('blk_no_dis');
        $(this).siblings('.cash_trns, .lnk_typ').removeClass('act_type');
        // $('.blk_disb').addClass('blk_no_dis');
        $(this).parent().siblings('.ove_auto').find('.lon_typ').removeClass('hide_blk_anim');
    });
    $('.lnk_typ.cash_trns').click(function(){
        $(this).addClass('act_type');
        $('.blk_disb').removeClass('blk_no_dis');
        // $('.blk_disb').addClass('blk_no_dis');
        $(this).siblings('.ban_trns, .lnk_typ').removeClass('act_type');
        $(this).parent().siblings('.ove_auto').find('.lon_typ').addClass('hide_blk_anim');
    });
    $('.lnk_typ.crd_sale').click(function(){
        $(this).addClass('act_type');
        $('.blk_disb').removeClass('blk_no_dis');
        $(this).siblings('.cash_trns, .lnk_typ').removeClass('act_type');
        // $('.blk_disb').addClass('blk_no_dis');
        $(this).parent().siblings('.ove_auto').find('.lon_typ').removeClass('hide_blk_anim');
    });
    $('.lnk_typ.cash_sale').click(function(){
        $(this).addClass('act_type');
        $('.blk_disb').removeClass('blk_no_dis');
        // $('.blk_disb').addClass('blk_no_dis');
        $(this).siblings('.ban_trns, .lnk_typ').removeClass('act_type');
        $(this).parent().siblings('.ove_auto').find('.lon_typ').addClass('hide_blk_anim');
    });

    
    $('#billadd').click(function(){
    	
    		if($(this).prop("checked") == true){
    			$("#addresstype").val(1);
                var s_name = $("#s_name").val();
			    var s_mobile = $("#s_mobile").val();
			    var s_address = $("#s_address").val();
			    var s_state = $("#s_state").val();
			    var s_pincode = $("#s_pincode").val();

			    if(s_name == ""){ err = 1; err_msg = "Please enter name!"; tagid = "#s_name";
			        return form_validation(err,err_msg,tagid);}
			    if(s_mobile == ""){ err = 1; err_msg = "Please enter mobile!"; tagid = "#s_mobile";
			        return form_validation(err,err_msg,tagid);}
			    if(s_address == ""){ err = 1; err_msg = "Please enter address!"; tagid = "#s_address";
			        return form_validation(err,err_msg,tagid);} 
			    if(s_state == ""){ err = 1; err_msg = "Please enter state!"; tagid = "#s_state";
			        return form_validation(err,err_msg,tagid);}
			    if(s_pincode == ""){ err = 1; err_msg = "Please enter pincode!"; tagid = "#s_pincode";
			        return form_validation(err,err_msg,tagid);}

			    $("#b_name").val(s_name);
			    $("#b_mobile").val(s_mobile);
			    $("#b_address").val(s_address);
			    $("#b_state").val(s_state);
			    $("#b_pincode").val(s_pincode);	    

            }
            else if($(this).prop("checked") == false){
            	$("#addresstype").val(0);
                $("#b_name").val('');
			    $("#b_mobile").val('');
			    $("#b_address").val('');
			    $("#b_state").val('');
			    $("#b_pincode").val('');	
            }
    });

    /*$('#mobile').blur(function(){
	    var user_id = $("#userid").val().trim();
	    var ukey = $("#ukey").val().trim();
	    var mobile = $("#mobile").val().trim();
	    if(user_id == "")
	    {
	      if(ukey!='' && mobile!='')
	      {
	          $.ajax({    
	                url: url+"api/sales/insertguest",
	                data: {ukey:ukey,mobile:mobile},
	                type:'POST',    
	                datatype:'json',
	                success : function(response1){
	                    rescp1 = JSON.parse(response1);        
	                    if(rescp1.status=='success')
	                    {
		                    $("#userid").val(rescp1.insert_id);
		                    var err_msg= 'Guest user added successfully';
		                    $("#snackbar").text(err_msg);
		                    $("#snackbar").addClass("show");
		                    setTimeout(function(){ $("#snackbar").removeClass("show"); }, 3000);
	                    }
	                }
	          });
	      }
	    }
    });*/ 

$('#ukey').blur(function(){
    //var usercode = $(this).val();   
    //var usercode = $("#select_usercode").val().trim();
    var user_id = $("#userid").val().trim();
    //alert(user_id);
    if(user_id != "")
    {
      getusercrops(user_id,'add');
     
    }else{
      var opt = '<option value="">-- Select Crop --</option>';
      $("#crop_opt").html(opt); $("#crop_opt").val('');   
       $(".crop_type_val").text('Crop location');
      //document.getElementById("crop_opt").fstdropdown.rebind();
      //document.getElementById("bank_opt").fstdropdown.rebind();
      
    }     
});

});

$(document).on('blur', "[id^=received_amount]", function() {
	var proqty = $('#received_amount').val();
	if(proqty!='')
	{
		$('#disamt').show();
	}
	else
	{
		$('#disamt').hide();
	}
});

$(document).on('blur', "[id^=proname]", function() {
		var id = $(this).attr('id');
    	id = id.replace("proname", '');
    	
    	var vd = $('#proname'+id).val();
    	var proqty = $('#proqty'+id).val();
    	var promrp = $('#promrp'+id).val();
    	var prodisc = $('#prodisc'+id).val();
    	var protot = $('#protot'+id).val();
    	
    	if(vd=='' )
    	{
    		//$('#rowNums'+id).remove();
    	}

});




$(document).on('blur', "[id^=proname]", function() {
		var id = $(this).attr('id');
    	id = id.replace("proname", '');
});
/*$(document).on('blur', "[id^=proqty]", function() {
		var id = $(this).attr('id');
    	id = id.replace("proqty", '');
    	
    	var qty = $('#proqty'+id).val();
		var mrp = $('#promrpval'+id).val();
		$('#promrp'+id).val(mrp);
		var ft = qty*mrp;
		$('#protot'+id).val(ft);

});*/
$(document).on('keyup', "[id^=received_amount]", function() {
	var gt = $('#gtotamtval').val();
	var rcmt = $('#received_amount').val();

		if(gt=='' || gt==0)
        {
        	$('#received_amount').val('');
          if(gt=='' || gt==0){ err = 1; err_msg = "Please add products!"; tagid = "#proid0"; 
          return form_validation(err,err_msg,tagid); }
          return false;
        }
        if(parseInt(rcmt)>parseInt(gt))
        {
          $('#received_amount').val('');
          if(parseInt(rcmt)>parseInt(gt)){ err = 1; err_msg = "Received amount is less than grand total!"; tagid = "#received_amount"; 
          return form_validation(err,err_msg,tagid); }
          return false;
        }

});
$(document).on('blur', "[id^=prodisc]", function() {
    calculateTotal();
}); 
$(document).on('blur', "[id^=proqty]", function() {

		var id = $(this).attr('id');
    	id = id.replace("proqty", '');

    	var proqty = $('#proqty'+id).val();
    	var inventoryqty = $('#inventoryqty'+id).val();

    	if(proqty>inventoryqty)
    	{
    		$('#proqty'+id).val(inventoryqty);
    		calculateTotal();
    		err = 1; err_msg = "Available quantity is "+inventoryqty; tagid = "#proqty"; 
          	return form_validation(err,err_msg,tagid); 
          	return false;
    	}
    	else
    	{
    		calculateTotal();
    	}

    
}); 
$(document).on('blur', "[id^=load_charge]", function() {
    calculateTotal();
}); 
$(document).on('blur', "[id^=transport_charge]", function() {
    calculateTotal();
}); 

$(document).on('keypress', "[id^=proname]", function() {
    var id = $(this).attr('id');
    id = id.replace("proname", '');
    
    var branch = $("input[name='branchval']:checked").val();
    var proids = $("input[name='proid[]']").map(function(){return $(this).val();}).get();

    if(branch==undefined || branch=='')
    {
    	err = 1; err_msg = "Please select branch"; tagid = "#brn_l";
        return form_validation(err,err_msg,tagid);
    }
    else
    {
    	$('.mykey').parent().css("border", "");
	    $('#proid'+id).val(0);
	    $('#promrpval'+id).val(0);
	    $('#promrp'+id).val(0);
	    $('#proqty'+id).val(0);
	    $('#protot'+id).val(0);
	    $('#prototval'+id).val(0);

	    calculateTotal();
        
	    $( "#proname"+id ).autocomplete({
	    	source: function( request, response ) {
			
		    $.ajax({
		    url: url+"api/sales/search_products",
		    type: 'post',
		    dataType: "json",
		    data: {
		     search: request.term,branch:branch,proid:proids
		    },
	    	success: function( data ) { 

		    if(data == null)
		    {
		        var err_msg= 'Product not available';
				$("#snackbar").text(err_msg);
				$("#snackbar").addClass("show");
				setTimeout(function(){ $("#snackbar").removeClass("show"); }, 3000);
		    }
	    
	      	response( $.map( data, function( result ) {  

		    return {  
			      label: result.label,
			      value: result.value,
			      imgsrc: result.img,   
			      pro_id: result.pid,
			      promrp : result.pmrp,
			      packing: result.packing,
			      units: result.units,
			      purchase_amt: result.purchase_amt,
			      inventoryid: result.inventoryid,
			      inventoryqty: result.inventoryqty,
			      protag: result.protag,
			      procount: result.procount
		    }  
	      }));  

	    }  
	     });
	    },
	    select: function (event, ui) {
	     // Set selection

	     	$('#proname'+id).val(ui.item.label); 
	     	$('#proid'+id).val(ui.item.pro_id);
	     	$('#promrpval'+id).val(ui.item.promrp);
	     	$('#promrp'+id).val(addCommas(ui.item.promrp));
	     	$('#proqty'+id).val(1);
	     	$('#purchase_amt'+id).val(ui.item.purchase_amt);
	     	$('#inventoryid'+id).val(ui.item.inventoryid);
	     	$('#inventoryqty'+id).val(ui.item.inventoryqty);

	     	/*$('#protot'+id).val(addCommas(ui.item.promrp));
	     	$('#prototval'+id).val(ui.item.promrp);

	     	$('#totamt').html(addCommas(ui.item.promrp));
	     	$('#totamtval').val(ui.item.promrp);

	     	$('#gtotamt').html(addCommas(ui.item.promrp));
	     	$('#gtotamtval').val(ui.item.promrp);*/
	     	calculateTotal();

            /* var rvvv = $('#rowval').val();
			var rowNum = rvvv;
	     	rowNum ++;
	     	var rrv = rowNum;
	     
	     	
	     	if($('#proid'+rrv).val()!='')
	     	{
	     		$('#rowval').val(rrv);

	     	htmlRows = '<tr id="rowNums'+rowNum+'" ><td><input type="hidden" placeholder="Product Name" name="proid[]" id="proid'+rowNum+'" value="0"><input class="mykey" type="text" placeholder="Product Name" name="proname[]" id="proname'+rowNum+'" > </td><td class="qty txt_cnt"> <input type="text" class="mykey" placeholder="0" onkeypress="return onlyNumberKey(event)" name="proqty[]" id="proqty'+rowNum+'"></td><td class="mrp txt_rt"> <input type="text" class="mykey" readonly placeholder="0" name="promrp[]" id="promrp'+rowNum+'"><input type="hidden" placeholder="0" name="promrpval[]" id="promrpval'+rowNum+'"> </td><td class="disc txt_rt"> <input type="text" class="mykey" placeholder="0" name="prodisc[]" id="prodisc'+rowNum+'"> </td><td class="ttl_prc txt_rt"> <input type="text" placeholder="0" readonly name="protot[]" id="protot'+rowNum+'"><input type="hidden" placeholder="0" name="prototval[]" id="prototval'+rowNum+'" > </td><td ><i class="fa fa-trash" onclick="removerow('+rowNum+')" style="color:red" ></i></td></tr>';

	     	$('#invoiceItem').append(htmlRows);
	     } */
	     	
	    }
	    
	    }).data( "ui-autocomplete" )._renderItem = function( ul, item ) { 

	     	if(item.protag=='New'){ var ptag = 'style="color:white;background:green;border-radius:5px"'; }else{ var ptag = 'style="color:white;background:red;border-radius:5px"'; }

	     	if(item.procount>1)
	     	{
	     		var ptags = " <span "+ptag+">"+item.protag+"</span>";
	     	}
	     	else
	     	{
	     		var ptags = '';
	     	}
	    	
	            return $( "<li></li>" )  

	               .data( "item.autocomplete", item )  

	               .append( "<a>" + item.label+ " "+item.units+"/"+item.packing+""+ptags+" - "+item.promrp+"</a>" )  

	               .appendTo( ul );
	             
	   };
    }
    
});

$("#salefrm").submit(function(e) {  

	var sallen = $(':radio[name="sale_types"]:checked').length;
	var bralen = $(':radio[name="branchval"]:checked').length;
	var saletype = $("input[name='sale_types']:checked").val();
	var branchval = $("input[name='branchval']:checked").val();
    
    var ukey = $("#ukey").val();
    var userid = $("#userid").val();   
    var proname0 = $("#proname5").val();
    var proqty0 = $("#proqty5").val();

    var tralen = $(':radio[name="transport_type"]:checked').length;
    var driver_name = $("#driver_name").val();
    var driver_mobile = $("#driver_mobile").val();
    var vehicle_number = $("#vehicle_number").val();
    var s_name = $("#s_name").val();
    var s_mobile = $("#s_mobile").val();
    var s_address = $("#s_address").val();
    var s_state = $("#s_state").val();
    var s_pincode = $("#s_pincode").val();
    var b_name = $("#b_name").val();
    var b_mobile = $("#b_mobile").val();
    var b_address = $("#b_address").val();
    var b_state = $("#b_state").val();
    var b_pincode = $("#b_pincode").val();
    var b_gst = $("#b_gst").val();
        
    
  	if(sallen == 0 ){ err = 1; err_msg = "Please select sale type!"; tagid = "#saletype";
              return form_validation(err,err_msg,tagid);}
    if(bralen == 0 ){ err = 1; err_msg = "Please select branch!"; tagid = "#brn_l";
              return form_validation(err,err_msg,tagid);}  

   	if(ukey == ""){ err = 1; err_msg = "Please User Name/Mobile!"; tagid = "#ukey";
        return form_validation(err,err_msg,tagid);} 
    if(saletype == "cash")
    {     
     	/* var mobile = $("#mobile").val();  
      	if(mobile == ""){ err = 1; err_msg = "Please enter mobile!"; tagid = "#mobile";
        return form_validation(err,err_msg,tagid);} */  
        if(userid == ""){ err = 1; err_msg = "User is not registered!"; tagid = "#ukey";
        return form_validation(err,err_msg,tagid);}
        var usertype = $("#usertype").val();

        var len = $(':radio[name="crop_opt"]:checked').length;
        if(len == 0 ){ err = 1; err_msg = "Please select crop location!"; tagid = "#crop_1";
        return form_validation(err,err_msg,tagid);}  
    } 
    if(saletype == "credit")
    {  
    	if(userid == ""){ err = 1; err_msg = "User is not registered!"; tagid = "#ukey";
        return form_validation(err,err_msg,tagid);}
        var usertype = $("#usertype").val();

        if(usertype=='FARMER')
        {
        	var len = $(':radio[name="crop_opt"]:checked').length;
        	if(len == 0 ){ err = 1; err_msg = "Please select crop location!"; tagid = "#crop_1";
        	return form_validation(err,err_msg,tagid);}
        }
    }     
        

    /*if(proname0 == ""){ err = 1; err_msg = "Please select product!"; tagid = "#proname0";
        return form_validation(err,err_msg,tagid);}
    if(proqty0 == 0){ err = 1; err_msg = "Please enter quantity!"; tagid = "#proqty0";
        return form_validation(err,err_msg,tagid);}*/
    var values = $("input[name='proname[]']").map(function() { return $(this).val(); }).get();
    var newArray = values.filter(function(v) { return v !== '' });  

    if (newArray.length == 0) {
            err = 1;
            return form_validation(err, "Must have at least one product!", "");
    }

    if(saletype == "cash")
    {     
      var received_amount = $("#received_amount").val();  
      if(received_amount!='')
      {
      		 var payment_date = $("#payment_date").val();
      		 var bblen = $(':radio[name="bankid"]:checked').length;
      		 var bank_reference = $("#bank_reference").val();

      		if(payment_date == ""){ err = 1; err_msg = "Please select date!"; tagid = "#payment_date";
        	return form_validation(err,err_msg,tagid);}
        	if(bblen == 0){ err = 1; err_msg = "Please select bank!"; tagid = "#bnkl";
        	return form_validation(err,err_msg,tagid);}
        	if(bank_reference == ""){ err = 1; err_msg = "Please enter reference number!"; tagid = "#bank_reference";
        	return form_validation(err,err_msg,tagid);}
      }
    }    

    if(tralen == 0 ){ err = 1; err_msg = "Please select tranport type!"; tagid = "#trn1";
              return form_validation(err,err_msg,tagid);}

    if(driver_name == ""){ err = 1; err_msg = "Please enter driver name!"; tagid = "#driver_name";
        return form_validation(err,err_msg,tagid);}
    if(driver_mobile == ""){ err = 1; err_msg = "Please enter driver mobile!"; tagid = "#driver_mobile";
        return form_validation(err,err_msg,tagid);}
    if(vehicle_number == ""){ err = 1; err_msg = "Please enter vehicle number!"; tagid = "#vehicle_number";
        return form_validation(err,err_msg,tagid);}

    if(s_name == ""){ err = 1; err_msg = "Please enter name!"; tagid = "#s_name";
        return form_validation(err,err_msg,tagid);}
    if(s_mobile == ""){ err = 1; err_msg = "Please enter mobile!"; tagid = "#s_mobile";
        return form_validation(err,err_msg,tagid);}
    if(s_address == ""){ err = 1; err_msg = "Please enter address!"; tagid = "#s_address";
        return form_validation(err,err_msg,tagid);} 
    if(s_state == ""){ err = 1; err_msg = "Please enter state!"; tagid = "#s_state";
        return form_validation(err,err_msg,tagid);}
    if(s_pincode == ""){ err = 1; err_msg = "Please enter pincode!"; tagid = "#s_pincode";
        return form_validation(err,err_msg,tagid);}

    if(b_name == ""){ err = 1; err_msg = "Please enter name!"; tagid = "#b_name";
        return form_validation(err,err_msg,tagid);}
    if(b_mobile == ""){ err = 1; err_msg = "Please enter mobile!"; tagid = "#b_mobile";
        return form_validation(err,err_msg,tagid);}
    if(b_address == ""){ err = 1; err_msg = "Please enter address!"; tagid = "#b_address";
        return form_validation(err,err_msg,tagid);} 
    if(b_state == ""){ err = 1; err_msg = "Please enter state!"; tagid = "#b_state";
        return form_validation(err,err_msg,tagid);}
    if(b_pincode == ""){ err = 1; err_msg = "Please enter pincode!"; tagid = "#b_pincode";
        return form_validation(err,err_msg,tagid);}
    if(b_gst == ""){ err = 1; err_msg = "Please enter gst!"; tagid = "#b_gst";
        return form_validation(err,err_msg,tagid);}

                  
  /* print_preview */
  $('#invoice_body').load("<?php echo base_url('api/sales/invoice_preview')?>", $("form").serializeArray(),function(){
    $(".pop_blk_prive").mCustomScrollbar({
        theme:"minimal",
        mouseWheelPixels: 35,
        scrollInertia:250,
    });
  });
  
	$("#invoice_preview_modal").modal('show');

	/* ------- */
});

$("#confirmOrder").on("click",function(){
      /*form submit*/
    formData = new FormData(salefrm);    
        
          $.ajax({
            url: url+"api/sales/add",
            data: formData,
            type:'POST',
            contentType: false,
            processData: false,
            enctype: 'multipart/form-data',
            datatype:'json',
            success : function(response)
            {           
              res= JSON.parse(response);
              if(res.status == 'success')
              { 
                new PNotify({
                  title: 'Success',
                  text: "Order created successfully!",
                  type: 'success',
                  shadow: true
                });
                
                window.location.href = "<?php echo base_url('api/sales/sale_invoice');?>/"+res.insert_id;
                  setTimeout(function() {
                    location.reload();
                  }, 2000);  
                              
              }
              else{
                new PNotify({
                  title: 'Error',
                  text: 'Something went wrong, try again!',
                  type: 'failure',
                  shadow: true
                });
              }         
            }
     }); 
    /*form submit*/
  });

$( function() {
	$( "#ukey" ).autocomplete({
    source: function( request, response ) {
      $('#userid').val('');
     
      $('#mobile').val('');
      $("#mobile").prop( "readonly", false );
      var sale_type = $("input[name='sale_types']:checked").val();
     // Fetch data
     $('.err_msg').hide();
     $.ajax({
    url: url+"api/sales/searchusers",
    type: 'post',
    dataType: "json",
    data: {
     search: request.term,ttype:sale_type
    },
    success: function( data ) { 
    	$('.cre_inp').addClass('inp_ss');
    /*if(sale_type=='credit')
    {*/
    	//alert(data);
      if(data == null)
      {
        //$("#ukey").val('');
        $('.err_msg').show();
        $(".crop_type_val").text('Crop location');
        $("#crops_opt_li").html('');

      }
    /*}*/ 
    
      response( $.map( data, function( result ) {  

      return {  
      label: result.label,
      value: result.value,
      imgsrc: result.img,   
      user_id: result.user_id,
      mobile:result.mobile,
      user_type: result.user_type
      }  

      }));  
  	 
    }  
     });
    },
    select: function (event, ui) {
    	 $(".crop_type_val").text('Crop location');
     // Set selection
      if(ui.item.user_type == "DEALER"){ $("#cropdis").hide();}else{ $("#cropdis").show(); }

	    var sale_type = $("input[name='sale_types']:checked").val();
	    /*if(sale_type=='cash')
	    {
	     	$("#cropdis").hide();
	     	$('#guestmobile').show();
	    }
	    else
	    {
	     	$("#cropdis").show();
	     	$('#guestmobile').hide();
	    }*/
     
        $('#mobile').val(ui.item.mobile);
        $("#mobile").prop( "readonly", true );

     $('#ukey').val(ui.item.label); // display the selected text
     $('#userid').val(ui.item.user_id); // save selected id to input
     $('#usertype').val(ui.item.user_type);
     //return false;
    }
    
   }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {  
		//alert(JSON.stringify(item));
           return $( "<li></li>" )  

               .data( "item.autocomplete", item )  

               .append( "<a>" + "<img style='width:25px;height:25px' src='" + item.imgsrc + "' /> " + item.label+ "</a>" )  

               .appendTo( ul );  

  };
});
function form_validation(err,err_msg,tagid)
{
	
  $('.mykey').parent().css("border", "");
  /* $(".err_msg").text(err_msg);
      
  $("#danger-alert").fadeTo(2000, 500).slideUp(1000, function(){
    $("#danger-alert").slideUp(1000);
  }); */
  $("#snackbar").text(err_msg);
  $("#snackbar").addClass("show");
  /* var x = document.getElementById("snackbar");
  x.className = "show";
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 5000); */
  setTimeout(function(){ $("#snackbar").removeClass("show"); }, 3000);
  $(tagid).parent().css("border", "1px solid red");
  //$("#tname").css("border", "1px solid red");
  $(tagid).focus();
  return false;
}
function form_validation1(err,err_msg,tagid)
{
	
  $('.mykey').parent().css("border", "");
  /* $(".err_msg").text(err_msg);
      
  $("#danger-alert").fadeTo(2000, 500).slideUp(1000, function(){
    $("#danger-alert").slideUp(1000);
  }); */
  $("#snackbar1").text(err_msg);
  $("#snackbar1").addClass("show");
  /* var x = document.getElementById("snackbar");
  x.className = "show";
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 5000); */
  setTimeout(function(){ $("#snackbar1").removeClass("show"); }, 3000);
  //$(tagid).parent().css("border", "1px solid red");
  $(tagid).css("border", "1px solid red");
  //$("#tname").css("border", "1px solid red");
  //$(tagid).focus();
  return false;
}
function addCommas(x) {
  x=x.toString();
  var lastThree = x.substring(x.length-3);
  var otherNumbers = x.substring(0,x.length-3);
  if(otherNumbers != '')
  lastThree = ',' + lastThree;
  //var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
  var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/, ",") + lastThree;

  return res;
}
function calculateTotal() {
    var qty = 0;
    var totamt = 0;
    var grandTotal = 0;
    $('.cre_inp').addClass('inp_ss');
    var ddisc =0;

    $("[id^='proqty']").each(function() {
        var id = $(this).attr('id');
        id = id.replace("proqty", '');
        var proqty = $("#proqty" + id).val();
        var promrpval = $('#promrpval' + id).val();
        var prodisc = $('#prodisc' + id).val();
        var purchaseamt = $('#purchase_amt' + id).val();
       //alert(prodisc);
        $('#promrp' + id).val(promrpval);

        var total = proqty * promrpval;
        
        var ds = prodisc/100;
        var dsc = ds*total;
        var tot1 = total-dsc;
        var ppamt = purchaseamt * proqty;
       
        if(tot1!=0)
        {
	        if ((parseFloat(tot1) < parseFloat(ppamt)) && prodisc!='') {
	        	
	            alert('Discount should be lessthan purchase amount, purchase amount is ' + ppamt);

	            $('#prodisc' + id).val('');
	            var tot1 = promrpval * proqty;

	            $('#protot' + id).val(tot1);
	        	$('#prototval' + id).val(tot1);
	        	
	        	//return false;
	        }
	        else
	        {
	        	var ftot = tot1.toFixed(2);
	        
	        	$('#protot' + id).val(ftot);
	        	$('#prototval' + id).val(tot1);
	        	var tot1 = total-dsc;
	        }
	    }       
        grandTotal += tot1;
        ddisc += prodisc; 

    });
    var loadc = $('#load_charge').val();
    var transportc = $('#transport_charge').val();
    
    if(loadc!='' && loadc!=NaN )
    {
      
    }
    else
    {
      loadc = 0;
    }

    if(transportc!='' && transportc!=NaN )
    { 
      
    }
    else
    {
      transportc = 0;
    }
   //alert(ddisc);

    var GrandTot = parseFloat(grandTotal) + parseFloat(loadc) + parseFloat(transportc);
   // $('#totamt').html(addCommas(grandTotal));
   // $('#gtotamt').html(addCommas(GrandTot));   
   if(grandTotal!=0)
   {
   		$('#totamt').html(grandTotal.toFixed(2));
	    $('#gtotamt').html(GrandTot.toFixed(2));
	    $('#totdiscount').val(ddisc);
	    $('#totamtval').val(grandTotal);
	    $('#gtotamtval').val(GrandTot);

	    var saletype = $("input[name='sale_types']:checked").val();
	    if(saletype=='cash')
	    {
	    	$('#received_amount').val(GrandTot.toFixed(2));
	    	$('#disamt').show();
	    	$('#textcredit').show();
	    	$('#textcredit').html(GrandTot.toFixed(2)+' will be added to user credit');
	    	$('#textcash').hide();
	    }else
	    {
	    	$('#textcash').show();
	    	$('#disamt').show();
	    	$('#textcash').html('Remaining amount will be added to user credit amount');
	    	$('#textcredit').hide();
	    }
   }    
}
function onlyNumberKey(evt) { 
          
        // Only ASCII charactar in that range allowed 
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode 
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) 
            return false; 
        return true; 
}
function removerow(id)
{
	var rr = $('#rowval').val();
	if(rr!=0)
	{
		rr --;
		$('#rowval').val(rr);
		$('#rowNums'+id).remove();
		calculateTotal();
	}
	else if(rr==0)
	{
		$('#proname'+id).val('');
		$('#proqty'+id).val('');
		$('#promrpval'+id).val('');
		$('#promrp'+id).html('');
		$('#prodisc'+id).val('');
		calculateTotal();
		$('#rowval').val(rr);
		$('#rowNums'+id).remove();

		htmlRows = '<tr id="rowNums0" ><td><input type="hidden" placeholder="Product Name" name="proid[]" id="proid0" value="0"><input type="hidden" name="inventoryid[]" id="inventoryid0" value="0"><input type="hidden" name="inventoryqty[]" id="inventoryqty0" value="0"><input class="mykey" type="text" placeholder="Product Name" name="proname[]" id="proname0" autocomplete="off" ><input class="mykey" type="hidden" name="purchase_amt[]" id="purchase_amt0" ></td><td class="qty txt_cnt"> <input type="text" class="mykey" placeholder="0" onkeypress="return onlyNumberKey(event)" name="proqty[]" id="proqty0"></td><td class="mrp txt_rt"> <input type="text" class="mykey" readonly placeholder="0" name="promrp[]" id="promrp0"><input type="hidden" placeholder="0" name="promrpval[]" id="promrpval0"> </td><td class="disc txt_rt prodiscdisplay" > <input type="text" class="mykey disckey noalpha" placeholder="0" name="prodisc[]" onkeypress="return validateFloatKeyPress(this,event);" id="prodisc0" maxlength="4" autocomplete="off"> </td><td class="ttl_prc txt_rt"> <input type="text" placeholder="0" readonly name="protot[]" id="protot0"><input type="hidden" placeholder="0" name="prototval[]" id="prototval0"><input type="hidden" class="form-control noalpha mykey" placeholder="" readonly name="hid_acivity_id[]" id="hid_acivity_id_0" value="0"></td><td class="dele_th_td"> <i class="fa fa-trash" onclick="removerow(0,0)" style="color:red"></i> </td></tr>';
			        
		$('#invoiceItem').append(htmlRows);
		
	}
}
function addmorerows()
{
	var sale_type = $("input[name='sale_types']:checked").val();

	
	var rr = $('#rowval').val();
	var rowNum = rr;
   
	rowNum ++;

	if(sale_type=='cash')
	{
	    var sel = ''; 
	    
	}
	else
	{
	    var sel = 'readonly';
	    $('.prodiscdisplay').hide();
	    $('#prodiscdisplaytd').hide();
	    
	}
	
	     	
	htmlRows = '<tr id="rowNums'+rowNum+'" ><td><input type="hidden" placeholder="Product Name" name="proid[]" id="proid'+rowNum+'" value="0" ><input type="hidden" name="inventoryid[]" id="inventoryid'+rowNum+'" value="0"><input type="hidden" name="inventoryqty[]" id="inventoryqty'+rowNum+'" value="0"><input class="mykey" type="text" placeholder="Product Name" autocomplete="off" name="proname[]" id="proname'+rowNum+'" ><input class="mykey" type="hidden" name="purchase_amt[]" id="purchase_amt'+rowNum+'" > </td><td class="qty txt_cnt"> <input type="text" class="mykey" placeholder="0" onkeypress="return onlyNumberKey(event)" name="proqty[]" id="proqty'+rowNum+'"></td><td class="mrp txt_rt"> <input type="text" class="mykey" readonly placeholder="0" name="promrp[]" id="promrp'+rowNum+'"><input type="hidden" placeholder="0" name="promrpval[]" id="promrpval'+rowNum+'"> </td><td class="disc txt_rt prodiscdisplay" > <input type="text" class="mykey disckey noalpha" placeholder="0" name="prodisc[]" id="prodisc'+rowNum+'" onkeypress="return validateFloatKeyPress(this,event);" '+sel+' autocomplete="off" maxlength="4" > </td><td class="ttl_prc txt_rt"> <input type="text" placeholder="0" readonly name="protot[]" id="protot'+rowNum+'"><input type="hidden" placeholder="0" name="prototval[]" id="prototval'+rowNum+'" > </td><td class="dele_th_td"><i class="fa fa-trash" onclick="removerow('+rowNum+')" style="color:red" ></i></td></tr>';

		var last_id = $('#invoiceItem tr:last-child td:first-child').find('input').attr("id");
	    var rrv = rowNum;
	    
	    if (last_id == undefined) { last_id = 0; } else { last_id = last_id.replace("proid", '');  }
	    last_id++;
	    
		$('#rowval').val(last_id);

	    //alert(last_id);
	    $('#invoiceItem').append(htmlRows);


	    var saletype = $("input[name='sale_types']:checked").val();
    	if(saletype=='cash')
    	{
	     	$('.disckey').prop('readonly', true);
	     	$('.prodiscdisplay').show();
	    	$('#prodiscdisplaytd').show();
	    }
	    else{
	    	$('.disckey').prop('readonly', true);
	    	$('.prodiscdisplay').hide();
	    	$('#prodiscdisplaytd').hide();
	    } 	
	    
}
function alphaOnly(event) {
  return (event.charCode > 64 && 
	event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)
}
function getSelectionStart(o) {
    if (o.createTextRange) {
        var r = document.selection.createRange().duplicate()
        r.moveEnd('character', o.value.length)
        if (r.text == '') return o.value.length
        return o.value.lastIndexOf(r.text)
    } else return o.selectionStart
}
function branchdata(val)
{
	alert(val);
}
$(document).on("click", ".purc_btn", function() {
		$('#create_module').modal();
});
$('.ad_bnk').unbind().click(function(event){
		
		var err = 0;
		$("#add_brand input[type='text'], .bname").each(function(){			
				
        	if($(this).val() == '' && $(this).attr("id") != "undefined"){
        		
        		var this_id = $(this).attr("id");
        		
				var split_id = this_id.split("_");
        		
        		if(split_id[0] == "fname" || split_id[0] == "ac" || split_id[0] == "bc" || split_id[0] == "ifsc" || split_id[0] == "branch")
        		{
					
        			err = 1; tagid = "#"+this_id;
					//$("#"+this_id).css("border", "");
        			//$(this).css("border", "1px solid red");
        			if(split_id[0] == "fname"){	err_msg = "Please enter account holder name!"; }
					if(split_id[0] == "ac"){ err_msg = "Please enter account number!"; }
					if(split_id[0] == "bc"){ err_msg = "Please select bank name!"; }
					if(split_id[0] == "ifsc"){ err_msg = "Please enter ifsc code!"; }
					if(split_id[0] == "branch"){ err_msg = "Please enter branch name!"; }
					return form_validation1(err,err_msg,tagid);
        		}			
        						
        	}
        });
		
		if(err == 0){
			var bank_cnt=$("#bank_cnt").attr("data-bank-cnt");
			var extra_id=(parseInt(bank_cnt)+1);			
			
			//BankNames('bc_name_'+extra_id);
			
			var html = ['<div class="bank_dtl_blk" data-bank-id="bank_acc_'+extra_id+'" data-bid="'+extra_id+'"> <span class="remove" onclick="removeBankAcc('+extra_id+')"> <img src="'+url+'/assets/images/close_btn.png" alt="" title="" /> </span> <div class="row" style="margin-top:25px;">', 
			 '<div class="col-md-12">', 
		   '<div class="form-group">',
			'<span class="border-lable-flt">',
			'<input type="text" class="form-control" id="fname_'+extra_id+'" name="holder_name[]" placeholder=" " onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)" />',
			'<label for="fname_'+extra_id+'" class="control-label required">Account Holder Name</label></span>',   
		  '</div>',
		  '</div>',
		  '<div class="col-md-6">', 
		   '<div class="form-group">',
			'<span class="border-lable-flt">',
			'<input type="text" class="form-control allownumericwithoutdecimal" id="ac_number_'+extra_id+'" name="acc_no[]" placeholder=" " onkeypress="return onlyNumberKey(event)" />',
			'<label for="ac_number_'+extra_id+'" class="control-label required">Account Number</label></span>',   
		  '</div>',
		  '</div>',
			 '<div class="col-md-6">',
				'<div class="form-group">',
					'<span class="border-lable-flt">',
					'<input type="text" class="form-control bname" id="bank_name_'+extra_id+'" name="bank_name[]" placeholder=" " onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)"/>',
					'<label for="bank_name_'+extra_id+'" class="control-label required">Bank Name</label></span>',
				'</div>',
			'</div>',
		  '<div class="col-md-6">', 
			'<div class="form-group">',
			   '<span class="border-lable-flt">',
			'<input type="text" class="form-control" id="ifsc_'+extra_id+'" name="ifsc_code[]" placeholder=" " />',
			'<label for="ifsc_'+extra_id+'" class="control-label required">IFSC Code</label></span>',   
		  '</div>',
		  '</div>',
		  
		   '<div class="col-md-6">', 
			'<div class="form-group">',
			   '<span class="border-lable-flt">',
		   '<input type="text" class="form-control" id="branch_name_'+extra_id+'" name="branch_name[]" placeholder=" " onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)"/>',
			'<label for="branch_name_'+extra_id+'" class="control-label required" >Branch Name</label></span>',
		  '</div>',
		  '</div></div> </div>'];
			$(this).parent('.hdg_bk').siblings('.bank_list').find('.bank_list_pos').append(html.join("\n"));
			var k = $(this).parent('.hdg_bk').siblings('.bank_list').find('.bank_list_pos').children('.bank_dtl_blk').length;
			var wth = $('.bank_dtl_blk').width()+32;
			var s = k*20;
			$(this).parent('.hdg_bk').siblings('.bank_list').find('.bank_list_pos').css('width', k*wth+s);
		}
		
		

		$('.remove').unbind().click(function(){
			var k = $(this).parent().parent().children('.bank_dtl_blk').length;
			var wth = $('.bank_dtl_blk').width() + 32;
			var s = k * 20;
			  if(k == 2){
				$('.bank_list_pos').css('width', k * wth + s - 300);
			  } else {
				$('.bank_list_pos').css('width', k * wth + s);
			  }			
		
				$(this).parent('.bank_dtl_blk').remove();
				// var wths = $('.bank_list_pos').width();
				$('.bank_list_pos').stop();
		});

		$(".allownumericwithoutdecimal").on("keypress keyup blur",function (event) {    
		     $(this).val($(this).val().replace(/[^\d].+/, ""));
		      if ((event.which < 48 || event.which > 57)) {
		          event.preventDefault();
		      }
		});

		$("#bank_cnt").attr("data-bank-cnt",extra_id);
		$("#bd_cnt").text(extra_id);

		var ids=[];
		$('.bank_dtl_blk').each(function () {
		    //console.log($(this).attr('data-bank-id'));
		    ids.push($(this).attr('data-bid'));
		});
		if(ids.length>0){
			$("#bank_cnt").attr("data-bank-ids",ids.join(","));
		}
		
	});
$('.ad_crp').unbind().click(function() {

        var crop_cnt = $("#crop_cnt").attr("data-crop-cnt");
        var crop_extra_id = (parseInt(crop_cnt) + 1);
        var html = ['<div class="crp_dtl_blk" data-crop-id="crop_details_' + crop_extra_id + '" data-cid="' + crop_extra_id + '"> <span class="crp_remove" onclick="removeCrop(' + crop_extra_id + ')" > <img src="' + url + '/assets/images/close_btn.png" alt="" title="" /> </span> <div class="row" style="margin-top:25px;" >',
            '<div class="col-md-6">',
            '<div class="form-group">',
            '<span class="border-lable-flt">',
            '<input type="text" class="form-control" id="crop_loc_' + crop_extra_id + '" name="crop_loc[]" placeholder=" " onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)"/>',
            '<label  class="control-label required" for="crop_loc_' + crop_extra_id + '">Crop Location</label></span>',
            '</div>',
            '</div>',
            '<div class="col-md-6">',
            '<div class="form-group">',
            '<span class="border-lable-flt">',
            '<input type="text" class="form-control" id="crop_type_' + crop_extra_id + '" name="crop_type[]" placeholder=" " onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)"/>',
            '<label  class="control-label " for="crop_type_' + crop_extra_id + '">Crop Type</label></span>',
            '</div>',
            '</div>',
            '<div class="col-md-6">',
            '<div class="form-group">',
            '<span class="border-lable-flt">',
            '<input type="text" class="form-control" id="acres_' + crop_extra_id + '" name="acres[]" placeholder=" " onkeypress="return allowNumerORDecimal(event,this)"/>',
            '<label  class="control-label " for="acres_' + crop_extra_id + '">Number of Acress</label></span>',
            '</div>',
            '</div>',
            '<div class="col-md-6">',
            '<div class="form-group">',
            '<span class="border-lable-flt">',
            '<input type="text" class="form-control" id="transaction_balance_' + crop_extra_id + '" name="transaction_balance[]" placeholder=" " onkeypress="return allowNumerORDecimal(event,this)" maxlength="16"/>',
            '<label  class="control-label " for="transaction_balance_' + crop_extra_id + '">Open Balance</label></span>',
            '</div>',
            '</div>',
            '</div>'
        ];
        //$('.crp_list_pos').append(html.join("\n"));
        $(this).parent('.hdg_bk').siblings('.crp_list').find('.crp_list_pos').append(html.join("\n"));
        var k = $(this).parent('.hdg_bk').siblings('.crp_list').find('.crp_list_pos').children('.crp_dtl_blk').length;
        var wth = $('.crp_dtl_blk').width() + 32;
        var s = k * 20;
        //$('.crp_list_pos').css('width', k*wth+s);
        $(this).parent('.hdg_bk').siblings('.crp_list').find('.crp_list_pos').css('width', k * wth + s);

        $('.crp_remove').unbind().click(function() {

            //var k = $('.crp_dtl_blk').length;
            var k = $(this).parent().parent().children('.crp_dtl_blk').length;
            var wth = $('.crp_dtl_blk').width() + 32;
            var s = k * 20;
            //$('.crp_list_pos').css('width', k*wth+s);
            if (k == 2) {
                $('.crp_list_pos').css('width', k * wth + s - 300);
            } else {
                $('.crp_list_pos').css('width', k * wth + s);
            }
            $(this).parent('.crp_dtl_blk').remove();
            
            
        });

        $(".allownumericwithoutdecimal").on("keypress keyup blur", function(event) {
            $(this).val($(this).val().replace(/[^\d].+/, ""));
            if ((event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });
       
        $("#crop_cnt").attr("data-crop-cnt", crop_extra_id);
        $("#cd_cnt").text(crop_extra_id);

        var ids = [];
        $('.crp_dtl_blk').each(function() {
            ids.push($(this).attr('data-cid'));
        });
        if (ids.length > 0) {
            $("#crop_cnt").attr("data-crop-ids", ids.join(","));
        }
    });

/*validation*/
$("#add_brand").submit(function(e) {			
			e.preventDefault();			
		}).validate({	
			//onkeyup: true,
			rules:{				
				guest_name:
				{
					required: true					
				},				
				guest_mobile:{
					required:true,
					number:true,
					minlength:10,
					remote: {
						url: url + "api/Sales/checkguestmobile_for_tooltip",
						type: "post",
						data: {
							brand_mobile: function() {
								return $('#add_brand :input[name="guest_mobile"]').val();
							}
						}
					}
				},				
				guest_email:{
				  email:true
				},
				"holder_name[]":{
					required: true,
					lettersonly: true
				},
				"acc_no[]":{
					required: true,
					number: true,
					minlength: 9,
					maxlength: 16,
					remote: {
						url: url + "api/Sales/check_accno_for_tooltip",
						type: "post",
						data: {
							acc_no: function() {
								return $('#add_brand :input[name="acc_no[]"]').val();
							}
						}
					}
				},
				"bank_name[]":{
					required: true
				},
				"ifsc_code[]":{
					required: true,
					alphanumericnospace: true
				},
				"branch_name[]":{
					required: true,
					alphanumeric: true
				},
				"crop_loc[]":{
					required: true
				},
			},
			messages: {
				guest_name:
				{
					required: "Enter Username"
				},
				guest_mobile:
				{
					required: "Enter Mobile",
					remote: "Mobile already exists!"
				},
				guest_email:{
				  required:'Enter email address',
				  email: 'Enter valid email address'
				},
				"holder_name[]":{
					required: "Enter account holder name"					
				},
				"acc_no[]":{
					required: "Enter account number",
					remote: "Account numbers already exists!"
				},
				"bank_name[]":{
					required: "Select bank name"
				},
				"ifsc_code[]":{
					required: "Enter ifsc code"
				},
				"branch_name[]":{
					required: "Enter branch name"
				},
				"crop_loc[]":{
					required: "Enter crop location"
				}
			},
			showErrors: function(errorMap, errorList) {			
				// Clean up any tooltips for valid elements
				$.each(this.validElements(), function(index, element) {
					var $element = $(element);
					var parent = $element.parent().attr('class');
					console.log($element);
					if (parent == "border-lable-flt") {

						$(element).data("title", "").removeClass("error").tooltip("dispose");
						$(element).css("border", "");
						$(".custom-select").css("border", "");
					} else {
						$element.parent().children(".btn-group").find(".multiselect").data("title", "").removeClass("error").tooltip("dispose");
						$(element).parent().children(".btn-group").find(".multiselect").css("border", "");
						$(".custom-select").css("border", "");
					}
				});
            $.each(errorList, function(index, error) {
                var $element = $(error.element);
				//$('.main_cnt_blk').mCustomScrollbar({ setTop : 0});
				
                console.log(error.element.name);
                if (error.element.name == "cati[]" || error.element.name == "sub_cati[]"  || error.element.name == "med") {
                    console.log($("#" + error.element.id).closest(".border-lable-flt"));
					$element.tooltip("dispose").data("title", error.message).data("placement", "top").addClass("error").tooltip();
                    $(".custom-select").css("border", "1px solid red");
                    $("#" + error.element.id).parent().children(".btn-group").find(".multiselect").css("border", "1px solid red");
                } else {
					$('.mCSB_container').css("top",0);					
                   $element.tooltip("dispose").data("title", error.message).data("placement", "top").addClass("error").tooltip();
                    

                    $("#" + error.element.id).css("border", "1px solid red");
					$(".custom-select").css("border", "");
                }
				
				/* $('#'+error.element.id).tooltip({
				   title : $('#'+error.element.id).data('title')
				}); */
            });
			 
        },
		submitHandler: function(form) 
		{
			var err = 0;			
	
			if(err == 0)
			{
				formData = new FormData(form);		
			
				$.ajax({
					url: url+"api/Sales/addguestuser",
					data: formData,
					type:'POST',
					contentType: false,
					processData: false,
					enctype: 'multipart/form-data',
					datatype:'json',
					success : function(response)
					{						
						res= JSON.parse(response);
						
						if(res.status == 'success')
						{	
							new PNotify({
								title: 'Success',
								text: "Created successfully!",
								type: 'success',
								shadow: true
							});
							$('#create_module').modal('hide');
							$('#guest_name').val('');
							$('#guest_mobile').val('');
							$('#guest_email').val('');
							$('#fname_1').val('');
							$('#ac_number_1').val('');
							$('#bank_name').val('');
							$('#ifsc_1').val('');
							$('#bank_name').val('');
							$('#branch_name_1').val('');
							$('#crop_loc_1').val('');
							$('#crop_type_1').val('');
							$('#acres_1').val('');
							$('#transaction_balance_1').val('');
							//$(".custom-select").removeClass("error");
							//setInterval('location.reload()', 5000);
							/*setTimeout(function(){
								window.location.href = url+'admin/companies';
							 }, 5000);*/
														
						}
						else{
							new PNotify({
								title: 'Error',
								text: 'Something went wrong, try again!',
								type: 'failure',
								shadow: true
							});
						}					
					}
				});	
			}					
		}
		
	});	
/*validation*/
function removeCrop(crop_id)
{
        var crop_cnt = $("#crop_cnt").attr("data-crop-cnt");
        var new_crop_cnt = (parseInt(crop_cnt) - 1);
        $("#crop_cnt").attr("data-crop-cnt", new_crop_cnt);
        $("#cd_cnt").text(new_crop_cnt);

        var rids = [];
        var crop_ids = $("#crop_cnt").attr("data-crop-ids").split(',');
        for (var i = 0; i < crop_ids.length; i++) {
            if (crop_id != crop_ids[i]) {
                rids.push(crop_ids[i]);
            }
        }
        $("#crop_cnt").attr("data-crop-ids", rids.join(","));
}
function allowNumerORDecimal(evt, element)
{
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57) && !(charCode == 46 || charCode == 8))
            return false;
        else {
            var len = $(element).val().length;
            var index = $(element).val().indexOf('.');
            if (index > 0 && charCode == 46) {
                return false;
            }
            if (index > 0) {
                var CharAfterdot = (len + 1) - index;
                if (CharAfterdot > 3) {
                    return false;
                }
            }

        }
        return true;
}
$(document).on("click", function(event){
   //alert(event.target.className);
    if(event.target.className=='fa fa-times')
    {
    	$('#create_module').modal('hide');
    	
    }
    if(event.target.className=='purc_btn cr_st_usr')
    {
    	$("#guest_name").css("border", "");
    	$("#guest_mobile").css("border", "");
    	$("#guest_email").css("border", "");
    	
    	$(".cropclass").css("border", "");
    	$(".branchclass").css("border", "");
    	$(".ifscclass").css("border", "");
    	$(".bankclass").css("border", "");
    	$(".acclass").css("border", "");
    	$(".fulnameclass").css("border", "");


    						$('#guest_name').val('');
							$('#guest_mobile').val('');
							$('#guest_email').val('');
							$('#fname_1').val('');
							$('#ac_number_1').val('');
							$('#bank_name').val('');
							$('#ifsc_1').val('');
							$('#bank_name').val('');
							$('#branch_name_1').val('');
							$('#crop_loc_1').val('');
							$('#crop_type_1').val('');
							$('#acres_1').val('');
							$('#transaction_balance_1').val('');

    }
    


});
function blockSpecialChar(e) {
            var k = e.keyCode;
            return ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8   || (k >= 48 && k <= 57));

        }
</script>
<!-- <script type="text/javascript" src="<?php echo base_url();?>assets/js/new_common.js" type="javascript"></script> -->
<?php require_once 'footer.php' ; ?>