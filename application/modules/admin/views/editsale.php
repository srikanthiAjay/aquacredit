<?php require_once 'header.php' ; ?>
<link href="<?php echo base_url();?>assets/css/createsale.css" type="text/css" rel="stylesheet">
<?php require_once 'sidebar.php' ; ?>
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
@-webkit-keyframes fadein {
  from {top: 0; opacity: 0;} 
  to {top: 5px; opacity: 1;}
}

@keyframes fadein {
  from {top: 0; opacity: 0;}
  to {top: 5px; opacity: 1;}
}	

</style>
<div class="right_blk">
	
	<div class="top_ttl_blk"> 
		<!-- <span class="back_btn"><a href="<?php echo base_url();?>admin/sales" title=""><img src="<?php echo base_url();?>assets/images/back.png" alt="" title=""> </a></span> --> <span> <?php echo $page_title;?> </span> (<span id="saleordid"></span>)
		<a href="<?php echo base_url();?>admin/sales" title="" class="fr btn btn-primary"> Show all sales  </a>
		<div id="snackbar" class=""></div>
	</div>
	<form id="salefrm" name="salefrm" action="javascript:void(0);" method="post">
	<div class="sale_rt">

		<h2 class="create_hdg"> Transport Details </h2>
		<ul class="create_ul"> 
		<input type="hidden" name="saleid" id="saleid" value="<?php echo $pid; ?>" >
										<li class="create_li slc_usr">
												<div class="check_wt_serc"> 
													<div class="show_va">Select  Transport</div>
													<div class="selectVal tranval_type">  Transport Type <span style="color: red">*</span> </div>
													<ul class="check_list mykey" id="trn1"> 
														<li id="transport_opt_li">
															<div class="form-check">
															  <input class="form-check-input" type="radio" name="transport_type" id="brn1" value="ssa">
															  <label class="form-check-label" for="trns2">
															  	SSA Vehicle
															  </label>
															</div>
													
															<div class="form-check">
															  <input class="form-check-input" type="radio" name="transport_type" id="brn2" value="user">
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
													    <input type="text" class="form-control mykey" placeholder="" data-original-title="" title="" name="driver_name" id="driver_name" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)">
													 </div>
													</li>
													 <li class="create_li ">
													 	<div class="cre_inp">
													  <div class="sm_blk"><span style="color: red">*</span> Driver Mobile </div>
													    <input type="text" onkeypress="return onlyNumberKey(event)" maxlength="10" class="form-control mykey" placeholder="" data-original-title="" title="" name="driver_mobile" id="driver_mobile">
													</div>
													 </li>
													  <li class="create_li ">
													 	<div class="cre_inp">
													  <div class="sm_blk"><span style="color: red">*</span> Vehicle Number </div>
													    <input type="text" class="form-control mykey" placeholder="" data-original-title="" title="" name="vehicle_number" id="vehicle_number">
													</div>
													 </li>

		</ul>

		<h2 class="create_hdg"> Shipping Address </h2>
		<ul class="create_ul"> 
			<li class="create_li ">
			 	<div class="cre_inp">
			  		<div class="sm_blk"><span style="color: red">*</span> Name</div>
			    	<input type="text" class="form-control mykey" placeholder="" data-original-title="" title="" name="s_name" id="s_name" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)">
				</div>
			</li>
	 		<li class="create_li ">
	 			<div class="cre_inp">
	  				<div class="sm_blk"><span style="color: red">*</span> Mobile</div>
	    			<input type="text" onkeypress="return onlyNumberKey(event)" maxlength="10" class="form-control mykey" placeholder="" data-original-title="" title="" name="s_mobile" id="s_mobile">
				</div>
	 		</li>
			 <li class="create_li ">
			 	<div class="cre_inp">
			  		<div class="sm_blk"><span style="color: red">*</span> Address</div>
			    	<input type="text" class="form-control mykey" placeholder="" data-original-title="" title="" name="s_address" id="s_address">
				</div>
			 </li>
			<li class="create_li ">
			 	<div class="cre_inp">
			  		<div class="sm_blk"><span style="color: red">*</span> State</div>
			    	<input type="text" class="form-control mykey" placeholder="" data-original-title="" title="" name="s_state" id="s_state" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)">
				</div>
			 </li>

			<li class="create_li ">
			 	<div class="cre_inp">
			  		<div class="sm_blk"><span style="color: red">*</span> Pin code</div>
			    	<input type="text" class="form-control mykey" placeholder="" data-original-title="" title="" name="s_pincode" id="s_pincode"  maxlength="6">
				</div>
			 </li>

		</ul>
		<div class="checkbox">
  			<label><input type="checkbox" value="" name="billadd" id="billadd"> Billing and shipping address are same</label>
  			<input type="hidden" value="" name="addresstype" id="addresstype" >
		</div>
		<div class="bil_add">
			<h2 class="create_hdg"> Billing Address </h2>
			<ul class="create_ul"> 
					<li class="create_li ">
					 	<div class="cre_inp">
					  <div class="sm_blk"><span style="color: red">*</span> Name</div>
					    <input type="text" class="form-control mykey" placeholder="" data-original-title="" title="" name="b_name" id="b_name" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)">
					</div>
					</li>
					<li class="create_li ">
					 	<div class="cre_inp">
					  <div class="sm_blk"><span style="color: red">*</span> Mobile</div>
					    <input type="text" onkeypress="return onlyNumberKey(event)" class="form-control mykey" placeholder="" data-original-title="" title="" name="b_mobile" id="b_mobile">
					</div>
					</li>

					<li class="create_li ">
					 	<div class="cre_inp">
					  <div class="sm_blk"><span style="color: red">*</span> Address</div>
					    <input type="text" class="form-control mykey" placeholder="" data-original-title="" title="" name="b_address" id="b_address" >
					</div>
					</li>

					<li class="create_li ">
					 	<div class="cre_inp">
					  <div class="sm_blk"><span style="color: red">*</span> State</div>
					    <input type="text" class="form-control mykey" placeholder="" data-original-title="" title="" name="b_state" id="b_state" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)">
					</div>
					</li>

					<li class="create_li ">
					 	<div class="cre_inp">
					  <div class="sm_blk"><span style="color: red">*</span> Pin code</div>
					    <input type="text" onkeypress="return onlyNumberKey(event)" class="form-control mykey" placeholder="" data-original-title="" title="" name="b_pincode" id="b_pincode"  maxlength="6">
					</div>
					</li>

					<li class="create_li ">
					 	<div class="cre_inp">
					  <div class="sm_blk"><span style="color: red">*</span> GST</div>
					    <input type="text" class="form-control mykey" placeholder="" data-original-title="" title="" name="b_gst" id="b_gst">
					</div>
		 			</li>

			</ul>
		</div>
	</div>
	<div class="sle_cr_r"> 
		<!-- <h2 class="create_hdg"> Loan Request </h2> -->

		<ul class="assign_type" id="saletype">  

			<!-- <li class="act_type lnk_typ crd_sale" onclick="return ttype('credit');"> 
				<img src="http://3.7.44.132/aquacredit/assets/images/credit_icn.png">
				<input type="radio" name="sale_types" id="sale1" value="credit" >
				<span> Credit Sale </span>
			</li>
			<li class="cash_sale lnk_typ" onclick="return ttype('cash');"> 
				<img src="http://3.7.44.132/aquacredit/assets/images/cash_icn.png">
				<input type="radio" name="sale_types" id="sale2" value="cash"  >
				<span> Cash Sale </span>
			</li>-->
			<li class="act_type  crd_sale" > 
				<img src="http://3.7.44.132/aquacredit/assets/images/credit_icn.png">
				<input type="radio" name="sale_types" id="sale1" value="credit" >
				<span> Credit Sale </span>
			</li>
			<li class="cash_sale " > 
				<img src="http://3.7.44.132/aquacredit/assets/images/cash_icn.png">
				<input type="radio" name="sale_types" id="sale2" value="cash"  >
				<span> Cash Sale </span>
			</li>
		</ul>

		<ul class="create_ul"> 
					<li class="create_li slc_usr">
						<div class="check_wt_serc" id="branchlist"> 
							<div class="show_va"><span style="color: red">*</span> Select  Branch</div>
							<div class="selectVal crop_type_val" >  Select  Branch </div>
							<input class="form-check-input" type="hidden" name="branchval" id="branch" value="">
							<!-- <ul class="check_list mykey" id="brn_l"> 
								<li id="crop_opt_li">
									<div class="form-check">
										<input class="form-check-input" type="radio" name="branchval" id="branch" value="">
										<label class="form-check-label" for="branch">
															 	Select Branch
										</label>
									</div>
								</li>
							</ul>	 -->											
						</div>
					</li>
					<li class="create_li">
					<div class="cre_inp">
					  <div class="sm_blk"><span style="color: red">*</span> User Name/Mobile </div>
					    <input type="text" class="form-control mykey" placeholder="" data-original-title="" title="" name="ukey" id="ukey" readonly>
					    <input type="hidden" class="form-control" placeholder=""  name="userid" id="userid">
					    <input type="hidden" class="form-control" placeholder=""  name="usertype" id="usertype">
					 </div>
					 <div class="err_msg" style="display: none;"> User Not Found </div>
					</li>
					<li class="create_li slc_usr" id="cropdis" style="display: none;">
						<div class="check_wt_serc wth_225_sel" id="branchlist"> 
							<div class="show_va">Crop location</div>
							<div class="selectVal crop_type_val1"><span style="color: red">*</span> Crop location </div>
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
					<li class="create_li" style="display: none;" id="guestmobile">
					 	<div class="cre_inp">
					  		<div class="sm_blk"><span style="color: red">*</span> Mobile </div>
					    	<input type="text" onkeypress="return onlyNumberKey(event)" maxlength="10" class="form-control mykey" placeholder="" data-original-title="" title="" name="mobile" id="mobile" readonly>
						</div>
					</li>
		</ul>
		<div class="add_more">
			<a href="javascript:void(0);" onclick="addmorerows();">Add More</a>
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
					<th style="color: red"> Delete </th>
				</tr>
				</thead>
				<input type="hidden" id="rowval" value="0">
				<tbody id="invoiceItem">
				<input type="hidden" name="rcntval" id="rcntval" >
					<!-- <tr id="rowNums0"> 
						<td> <input type="hidden" class="mykey" placeholder="Product Name" name="proid[]" id="proid0" >
							 <input type="text" class="mykey" placeholder="Product Name" name="proname[]" id="proname0" > </td>
						<td class="qty txt_cnt"> <input type="text" class="mykey" placeholder="0" onkeypress="return onlyNumberKey(event)" name="proqty[]" id="proqty0"> </td>
						<td class="mrp txt_rt"> <input type="text" class="mykey" placeholder="0" name="promrp[]" id="promrp0" readonly><input type="hidden" class="mykey" placeholder="0" name="promrpval[]" id="promrpval0" > </td>
						<td class="disc txt_rt"> <input type="text" class="mykey" placeholder="0" name="prodisc[]" id="prodisc0"> </td>
						<td class="ttl_prc txt_rt"> <input type="text" class="mykey" placeholder="0" name="protot[]" id="protot0" readonly>
						<input type="hidden" placeholder="0" name="prototval[]" id="prototval0" >
						 </td>
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
						<td class="txt_rt ttl_prc"> <input type="text" onkeypress="return onlyNumberKey(event)" value="0" name="load_charge" id="load_charge" readonly> </td>
					</tr>
					<tr>
						<td class="txt_rt"> Transport Charges </td>
						<td class="txt_rt ttl_prc"> <input type="text" onkeypress="return onlyNumberKey(event)" value="0" name="transport_charge" id="transport_charge" readonly> </td>
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

				    	<input type="text"  name="received_amountval" id="received_amountval" >
			 		</div>
				</span> 
				<span> <a class="pay_rec" data-toggle="modal" href="#" data-target="#myModal">Payment Transactions List</a> </span>
			</h2>
			
			
			<!-- popup start -->
			
			  <div class="modal fade" id="myModal" role="dialog">
			    <div class="modal-dialog">
			    
			      <!-- Modal content-->
			      <div class="modal-content">
			        <div class="modal-body">
			        	<!--   <button type="button" class="close" data-dismiss="modal">&times;</button> -->
			        	  <div class="pp_clss" data-dismiss="modal"> <i class="fa fa-times" aria-hidden="true"></i> </div>
			        	<h2 class="create_hdg" style="margin-bottom: 15px;"> Transaction History </h2>
			        	<div class="ord_comp_bl">
			        	<table class="actl_tbl table" cellspacing="0" cellpadding="0" border="0">
			            <thead>
			              <tr>  <th> Date </th>   
			              <th>Type</th>  
			                <th> Bank</th>
			                <th> Account Number </th>
			                <th> IFSC Code </th>
			                
			                <th> Amount </th>
			               <th> Reference Number </th>
			              </tr>
			            </thead>
			            <tbody id="transactionlist">
			            </tbody>
			          </table>
			      </div>
			        </div>
			      
			         <!--  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
			        
			      </div>
			      
			    </div>
			  </div>
			<!-- popup end -->
			<p id="textcash"> </p>
			<div id="disamt" style="display: none;">
				<ul class="assign_type"> 
					<li class="act_type lnk_typ ban_trns" onclick="return getbanks('bank');"> 
						<img src="http://3.7.44.132/aquacredit/assets/images/bank_tansfer.png">
						<input type="radio" name="paymenttype" value="bank" checked id="pay1">
						<span> Bank Transfer </span>
					</li>
					<li class="cash_trns lnk_typ" onclick="return getbanks('cash');"> 
						<img src="http://3.7.44.132/aquacredit/assets/images/cash_icn.png">
						<input type="radio" name="paymenttype" value="cash" id="pay2">
						<span> Cash </span>
					</li>
					<li class="txt_csh"> 
						
					</li>
				</ul>
				<style type="text/css">
					.txt_csh {
	border: none!important;
    width: auto!important;
    text-align: left!important;
    padding-top: 16px;
					}
					.ord_comp_bl  {height: 350px;}
					.pay_rec { font-size: 13px; text-decoration: underline; padding-top: 18px; display: inline-block; }
				#disamt {margin-bottom: 15px;}
				#myModal table {border-left: 1px solid #e6e9ec; border-bottom: 1px solid #e6e9ec; border-right: 1px solid #e6e9ec; margin-bottom: 0px;}
				#myModal table td, #myModal table th {border-color: #e6e9ec; height: 32px; padding: 5px 10px!important; }
				</style>
				<ul class="trans_inf bnk_tr"> 
					<li class="create_li date">
						<div class="cre_inp">
							<div class="sm_blk"> Date </div>
						    <input type="text" class="form-control mykey" placeholder="" data-original-title="" title="" name="payment_date" id="payment_date" onkeydown="return false;" value="<?php echo date('d-M-Y'); ?>">
						</div>
					</li>
					<li class="admin_bank_li" > 
				 		<div class="check_wt_serc" id="bankslist"> 
				            <div class="show_va" d="bnkval"> Select Account </div>
				            <div class="selectVal bankval_chk" id="bnkval1">  Select Account </div>
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
			<p id="textcredit"></p>
			<div class="note_add"> <a href="#" title=""> Note </a> </div> 
				<textarea placeholder="Note" name="note" id="note"></textarea>
			</div>
			<div class="po_ftr">
				<!-- <button class="btn fr sb_btn btn-primary" data-toggle="modal" data-target="#view_order"> Create Order </button> -->
				<button class="btn fr sb_btn btn-primary" type="submit"> Update Order </button>
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
    <td colspan="2" style="font-size: 16px; padding-top: 10px; padding-bottom: 10px; text-align: right;"><b>Grand Total </b></td>
    <td style="font-size: 16px; padding-top: 10px; padding-bottom: 10px; text-align: right;"><b>21,500</b></td>
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
<script type="text/javascript">
var url = '<?php echo base_url()?>';
getbanks('bank');
getsale();
function getbranches(bid)
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
            		if(bid == crop.branch_id)
                    { 
                       sel = "checked"; 
                       $(".crop_type_val").text(crop.branch_name); 
                    }
                    else
                    { 
                      sel = "";
                    }

            opt += '<div class="form-check"><input class="form-check-input" type="radio" name="branchval" id="branch'+index+'" value="'+crop.	branch_id+'" '+sel+' /><label class="form-check-label" for="branch'+index+'">'+crop.branch_name+'</label></div>';
          });
        }
       
        $("#crop_opt_li").html(opt);
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
	var branch = $("#branch").val();
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

function hidecolor()
{
	$('.mykey').parent().css("border", "");

	$("[id^='proid']").each(function() {
        var id = $(this).attr('id');
        id = id.replace("proid", '');
        

        var prodata = $('#proid'+id).val();
        
        if(prodata!='' && prodata!=0)
		{
			$('#proid'+id).val('');
			$('#proname'+id).val('');
			$('#proqty'+id).val('');
			$('#promrpval'+id).val('');
			$('#promrp'+id).val('');
			$('#protot'+id).val('');
			$('#prodisc'+id).val('');
			$('#purchase_amt'+id).val('');
			$('#inventoryid'+id).val('');
			('#inventoryqty'+id).val('');
		}     
		calculateTotal();   
    });
}
function ttype(val)
{
	if(val=='cash')
	{
		$('input[name="sale_types"][value="cash"]').prop('checked', true);
		$("#discash").show();
		$('#ukey').val('');
		$('#mobile').val('');
		$('#userid').val('');
		$('#cropdis').hide();
		$('#guestmobile').show();
		$('.disckey').prop('readonly', false);
		$(".crop_type_val1").text('Crop location');
	}
	else
	{
		$('input[name="sale_types"][value="credit"]').prop('checked', true);
		$("#discash").hide();
		$('#ukey').val('');
		$('#mobile').val('');
		$('#userid').val('');
		$('#cropdis').show();
		$('#guestmobile').hide();
		$('.disckey').prop('readonly', true);
	}
}
function gettransport(val)
{
	
	if(val == 'ssa')
    { 
        sel1 = "checked"; 
        $(".tranval_type").text('SA Vehicle'); 
    }
    else
    {
    	sel1 = ""; 
    }
                    

    if(val == 'user')
    { 
        sel = "checked"; 
        $(".tranval_type").text('User Vehicle'); 
    }
    else
    {
    	sel = "";
    }
                    

	var opt = '<div class="form-check"><input class="form-check-input" type="radio" name="transport_type" id="trns1" value="ssa" '+sel1+'><label class="form-check-label" for="trns1">SA Vehicle</label></div><div class="form-check"><input class="form-check-input" type="radio" name="transport_type" id="trns2" value="user" '+sel+' ><label class="form-check-label" for="trns2">User Vehicle</label></div>';

	$("#transport_opt_li").html(opt);

}
function getusercrops(user_id,selval)
{
  var aeval = hidcrop = "";
 
  $.ajax({    
    url: url+"api/UserCrops/index/"+user_id,
    data: {},
    type:'POST',    
    datatype:'json',
    success : function(response){
      
      //alert(JSON.stringify(response));
      res= JSON.parse(response);        
      //alert(res.data.length);
      
      //var usercode = $('#select_usercode'+aeval).val();
      var user_id = $('#userid').val();
      var sel = "";
      if(user_id != "")
      {
        //var opt = '<option value="">-- Select Crop --</option>';
        var opt = "";
        if(res.data.length > 0)
        {

          $.each(res.data, function(index, crop) {
            
            if(crop.cd_id == selval){ 
            	sel = "checked"; 
            	 $(".crop_type_val1").text(crop.crop_location); 

            }else{ 
            	sel = "";
            }
            
            opt += '<div class="form-check"><input class="form-check-input" type="radio"  name="crop_opt'+aeval+'" id="crp'+index+aeval+'" value="'+crop.cd_id+'" '+sel+' /><label class="form-check-label" for="crp'+index+aeval+'">'+crop.crop_location+'</label></div>';
          });
        }
      }else{
        //var opt = '<option value="">-- Select user first --</option>';
        var opt = '';
      }
      $("#crops_opt_li").html(opt);
      //$("#crop_opt"+aeval).select2('refresh');
      //document.getElementById("crop_opt"+aeval).fstdropdown.rebind();
    }
  });
}
function getsale()
	{
		// Get Brand
		var pid = <?php echo $pid; ?>;
		
		$.ajax({		
			url: url+"api/sales/getsalesdetails/"+pid,
			data: {},
			type:'POST',		
			datatype:'json',
			success : function(response2){
				
				res= JSON.parse(response2);				
				
				if(res.data != "")
				{
					$('.cre_inp').addClass('inp_ss');
					$("#saleid").val(res.data.id);
					
					/*if(res.data.saletype==0)
					{
						$("#sale1").val(res.data.saletype);
						$("#sale1").prop( "checked", true );
					}
					else
					{ 
						$("#sale2").val(res.data.saletype);
						$("#sale2").prop( "checked", true );
					}*/
					
					$("#ukey").val(res.data.user_name);	
					$("#userid").val(res.data.userid);					
					$("#mobile").val(res.data.mobile);					
					$("#note").val(res.data.note);	
					/*if(res.data.saletype==1)
					{
						$('input[name="sale_types"][value="cash"]').prop('checked', true);
						$("#discash").show();
					}
					else
					{
						$('input[name="sale_types"][value="credit"]').prop('checked', true);
						$("#discash").hide();
					}*/
					if(res.data.addresstype==1)
					{
						$("#addresstype").val(1);
						$('#billadd').prop('checked', true);
					}
					else
					{
						$("#addresstype").val(0);
						$('#billadd').prop('checked', false);
					}
					if(res.data.saletype==0)
					{
						$('#cropdis').show();
						$('#guestmobile').hide();
						var bcsh = 'credit';
						var ord = 'SCD'+pid;
					}
					else
					{
						$('#cropdis').hide();
						$('#guestmobile').show();
						var bcsh = 'cash';
						var ord = 'SCH'+pid;
					}
					$("#saleordid").html(ord);

					$('input[name="sale_types"][value="'+bcsh+'"]').prop('checked', true);
					//alert(res.data.saletype);
					if(res.data.saletype == 0)
					{
						$('.crd_sale').addClass('act_type');
						$('.cash_sale').removeClass('act_type');
						$("#discash").hide();
						$('.disckey').prop('readonly', true);

						$('#textcredit').show();
				        $('#textcash').html('Remaining amount balance amount');
				        $('#textcash').hide();

					}
					else if(res.data.saletype == 1)
					{
						$('.crd_sale').removeClass('act_type');
						$('.cash_sale').addClass('act_type');
						$("#discash").show();
						$('.disckey').prop('readonly', false);

						/*text display*/
						if( parseInt(res.data.grandtotal) > parseInt(res.data.received_amount))
    					{
    						$('#textcredit').hide();
	        				$('#textcash').html(' Due amount : '+res.data.balance_receivedamount+'</br> Paid amount : '+res.data.received_amount);
	        				$('#textcash').show();
    					}
    					else
    					{
    						$('#textcredit').hide();
    						if(res.data.balance_receivedamount!=0)
    						{
    							$('#textcash').html('<b class="blue_text">'+res.data.balance_receivedamount+'</b> Balance amount  </br> Total Paid Amount : <b class="blue_text">'+res.data.received_amount+ '</b>');
    						}
    						else
    						{
    							$('#textcash').html(' Total Paid Amount : '+res.data.received_amount);
    						}
	        				
	        				$('#textcash').show();
    					}
						/*text display*/
					}
					
					//$("#received_amount").val(res.data.received_amount);
					
					if(res.data.received_amount!='' && res.data.received_amount!=0)
					{
						$("#disamt").hide();
					}
					else
					{
						$("#disamt").hide();
					}

					if(res.data.payment_date!='1970-01-01')
					{
						var a=$.datepicker.formatDate( "dd-M-yy", new Date(res.data.payment_date));
          				//$("#payment_date").val(a);
					}
					
					$("#received_amountval").val(res.data.received_amount);
					//$("#bank_reference").val(res.data.bank_reference);
					$("#driver_name").val(res.data.driver_name);	
					$("#driver_mobile").val(res.data.driver_mobile);	
					$("#vehicle_number").val(res.data.vehicle_number);

					$("#s_name").val(res.data.s_name);	
					$("#s_mobile").val(res.data.s_mobile);					
					$("#s_address").val(res.data.s_address);				
					$("#s_state").val(res.data.s_state);					
					$("#s_pincode").val(res.data.s_pincode);

					$("#b_name").val(res.data.b_name);
					$("#b_mobile").val(res.data.b_mobile);
					$("#b_address").val(res.data.b_address);				
					$("#b_state").val(res.data.b_state);					
					$("#b_pincode").val(res.data.b_pincode);
					$("#b_gst").val(res.data.b_gst);	

					$("#totamt").html(currency_format(res.data.total_saleprice,2));
					//$("#totamt").html(addCommas(res.data.total_saleprice));
					$("#totamtval").val(res.data.total_saleprice);
					//$("#gtotamt").html(addCommas(res.data.grandtotal));
					$("#gtotamt").html(currency_format(res.data.grandtotal,2));
					$("#gtotamtval").val(res.data.grandtotal);	

					$("#load_charge").val(res.data.load_charge);
					$("#transport_charge").val(res.data.transport_charge);	

					var branchid = res.data.branchid;
					var bankid = res.data.bankid;
					var transport_type = res.data.transport_type;
					$('#branch').val(branchid);
					getusercrops(res.data.userid,res.data.crop_id);
					getbranches(branchid);
					//getbanks(bankid);
					gettransport(transport_type);

				}				
			}
		});
		
		/*edit product details*/
					
		            $.ajax({
		            	url: url+"api/sales/getsaleactualdetails/"+pid,
			            data: {},
			            type:'POST',    
			            datatype:'json',
			            success : function(response1){

			              res1 = JSON.parse(response1);
			              //alert(JSON.stringify(res1.data));
			              htmlRows = "";
			              
			              $('#rowval').val(res1.data.length);
			              if(res1.data.length>0)
			              {
			                $('#rcntval').val(res1.data.length);
			                $.each(res1.data, function(index, trades) {
			                	
			                  var tcamtt = trades.mrp;
			                  //var tfamtt = addCommas(trades.total_price);
			                  var tfamtt = currency_format(trades.total_price,2);
			                  
			                  if(trades.discount!=0 && trades.discount!=0.00)
			                  {
			                  	var pdiscount = trades.discount;
			                  }
			                  else
			                  {
			                  	var pdiscount = 0;
			                  }
			                  //alert(res.data.saletype);
			                    /*var saletype = $("input[name='sale_types']:checked").val();
			                    if(saletype==1)
								{
								    var sel = ''; 
								   
								}
								else
								{
								    var sel = 'readonly';
								   
								}*/
							  var sel ='';

			                  htmlRows = '<tr id="rowNums'+trades.id+'"><td> <input type="hidden" class="mykey" placeholder="Product Name" name="proid[]" id="proid'+trades.id+'" value="'+trades.product_id+'" ><input type="hidden" name="inventoryid[]" id="inventoryid'+trades.id+'" value="'+trades.inventoryid+'"><input type="hidden" name="inventoryqty[]" id="inventoryqty'+trades.id+'" value="'+trades.inventoryqty+'"><input type="hidden" name="preqty[]" id="preqty'+trades.id+'" value="'+trades.quantity+'"><input type="text" class="mykey" placeholder="Product Name" autocomplete="off"  name="proname[]" id="proname'+trades.id+'" value="'+trades.pname+'"><input class="mykey" type="hidden" name="purchase_amt[]" id="purchase_amt'+trades.id+'" value="'+trades.purchase_amt+'"> </td><td class="qty txt_cnt"> <input type="text" class="mykey" placeholder="0" onkeypress="return onlyNumberKey(event)" name="proqty[]" id="proqty'+trades.id+'" value="'+trades.quantity+'"> </td><td class="mrp txt_rt"> <input type="text" class="mykey" placeholder="0" name="promrp[]" id="promrp'+trades.id+'" readonly value="'+tcamtt+'"><input type="hidden" class="mykey" placeholder="0" name="promrpval[]" id="promrpval'+trades.id+'" value="'+trades.mrp+'"> </td><td class="disc txt_rt prodiscdisplay"> <input type="text" class="mykey disckey" onkeypress="return validateFloatKeyPress(this,event);" maxlength="4" placeholder="0" name="prodisc[]" id="prodisc'+trades.id+'" value="'+pdiscount+'" '+sel+' > </td><td class="ttl_prc txt_rt"> <input type="text" class="mykey" placeholder="0" name="protot[]" id="protot'+trades.id+'" readonly value="'+tfamtt+'"><input type="hidden" placeholder="0" name="prototval[]" id="prototval'+trades.id+'" value="'+trades.total_price+'"><input type="hidden" class="form-control noalpha mykey" placeholder="" readonly name="hid_acivity_id[]" id="hid_acivity_id_'+trades.id+'" value="'+trades.id+'"></td><td class="dele_th_td" > <i class="fa fa-trash" onclick="removerow('+trades.id+','+pid+')" style="color:red"></i> </td></tr>';

			                  $('#invoiceItem').append(htmlRows);
			                  var saletype = $("input[name='sale_types']:checked").val();
			                  //alert(saletype);
			                    if(saletype=='cash')
								{
								    $('.prodiscdisplay').show();
	    							$('#prodiscdisplaytd').show();
								}
								else
								{
								   
								    $('.prodiscdisplay').hide();
	    							$('#prodiscdisplaytd').hide();
								}
			                  
			                   /* if(res.data.status==1)
			          			{
			          				$(".mykey").prop("disabled", true);
			          			}
			          			else
			          			{
			          				$(".mykey").prop("disabled", false);
			          			}*/

			                });
			                /*htmlRows = '<tr id="rowNums0" ><td><input type="hidden" placeholder="Product Name" name="proid[]" id="proid0" value="0"><input class="mykey" type="text" placeholder="Product Name" name="proname[]" id="proname0" autocomplete="off" > </td><td class="qty txt_cnt"> <input type="text" class="mykey" placeholder="0" onkeypress="return onlyNumberKey(event)" name="proqty[]" id="proqty0"></td><td class="mrp txt_rt"> <input type="text" class="mykey" readonly placeholder="0" name="promrp[]" id="promrp0"><input type="hidden" placeholder="0" name="promrpval[]" id="promrpval0"> </td><td class="disc txt_rt"> <input type="text" class="mykey disckey" placeholder="0" name="prodisc[]" onkeypress="return onlyNumberKey(event)" id="prodisc0"> </td><td class="ttl_prc txt_rt"> <input type="text" placeholder="0" readonly name="protot[]" id="protot0"><input type="hidden" placeholder="0" name="prototval[]" id="prototval0"><input type="hidden" class="form-control noalpha mykey" placeholder="" readonly name="hid_acivity_id[]" id="hid_acivity_id_0" value="0"></td><td > <i class="fa fa-trash" onclick="removerow(0,0)" style="color:red"></i> </td></tr>';
			          
			                    $('#invoiceItem').append(htmlRows);*/
			                    /*if(res.data.status==1)
			          			{
			          				$(".mykey").prop("disabled", true);
			          			}
			          			else
			          			{
			          				$(".mykey").prop("disabled", false);
			          			}*/

			              }
			              else
			              {

			                  htmlRows = '<tr id="rowNums0" ><td><input type="hidden" placeholder="Product Name" name="proid[]" id="proid0" value="0"><input type="hidden" name="inventoryid[]" id="inventoryid0" value="0"><input type="hidden" name="inventoryqty[]" id="inventoryqty0" value="0"><input type="hidden" name="preqty[]" id="preqty0" value="0"><input class="mykey" type="text" placeholder="Product Name" name="proname[]" id="proname0" autocomplete="off" ><input class="mykey" type="hidden" name="purchase_amt[]" id="purchase_amt0" > </td><td class="qty txt_cnt"> <input type="text" class="mykey" placeholder="0" onkeypress="return onlyNumberKey(event)" name="proqty[]" id="proqty0"></td><td class="mrp txt_rt"> <input type="text" class="mykey" readonly placeholder="0" name="promrp[]" id="promrp0"><input type="hidden" placeholder="0" name="promrpval[]" id="promrpval0"> </td><td class="disc txt_rt prodiscdisplay"> <input type="text" class="mykey disckey" placeholder="0" name="prodisc[]" onkeypress="return validateFloatKeyPress(this,event);" maxlength="4" id="prodisc0"> </td><td class="ttl_prc txt_rt"> <input type="text" placeholder="0" readonly name="protot[]" id="protot0"><input type="hidden" placeholder="0" name="prototval[]" id="prototval0"><input type="hidden" class="form-control noalpha mykey" placeholder="" readonly name="hid_acivity_id[]" id="hid_acivity_id_0" value="0"></td><td class="dele_th_td"> <i class="fa fa-trash" onclick="removerow(0,0)" style="color:red"></i> </td></tr>';
			        
			                  $('#invoiceItem').append(htmlRows);
			                   var saletype = $("input[name='sale_types']:checked").val();
			                  if(saletype==1)
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
			              }


			             
			              
			            }

		            });
		/*edit product details*/
		 //calculateTotal();
		/*get transaction details*/
				$.ajax({
		            	url: url+"api/sales/gettransdetails/"+pid,
			            data: {},
			            type:'POST',    
			            datatype:'json',
			            success : function(response1_t){

			              res1_t = JSON.parse(response1_t);
			              
			              htmlRows = "";
			             
			              if(res1_t.data.length>0)
			              {
			              
			                $.each(res1_t.data, function(index, transaction) {

			                	var aa = $.datepicker.formatDate( "dd-M-yy", new Date(transaction.transaction_date));

			                	if(transaction.bank_ifsc!='' && transaction.bank_ifsc!=null)
			                	{
			                		var bifsc = transaction.bank_ifsc;
			                		var acntype = 'Bank';
			                		var acnt = transaction.account_no; 
			                	}
			                	else
			                	{
			                		var bifsc = '--';
			                		var acntype = 'Cash';
			                		var acnt = '--';
			                	}
			                	
			                  htmlRows = '<tr ><td>'+aa+'</td><td>'+acntype+'</td><td>'+transaction.bank_name+'</td><td>'+acnt+'</td><td>'+bifsc+'</td><td>'+transaction.amount+'</td><td>'+transaction.reference_number+'</td></tr>';

			                  $('#transactionlist').append(htmlRows);

			                  
			               
			                });
			              
			              }
			              

			            }
		        });
		/*get transaction details*/
	}
var url = '<?php echo base_url()?>';
$(document).ready(function(){

	var dateToday = new Date();
	  $("#payment_date").datepicker({
	    dateFormat: 'dd-M-yy',
	    changeMonth: true,
	    changeYear: true,
	    /*minDate: dateToday,*/
	    numberOfMonths: 1,
	    maxDate : 0
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
    if(user_id != "")
    {
      getusercrops(user_id,'add');
     
    }else{
      var opt = '<option value="">-- Select Crop --</option>';
      $("#crop_opt").html(opt); $("#crop_opt").val('');   
       $(".crop_type_val1").text('Crop location');
      //document.getElementById("crop_opt").fstdropdown.rebind();
      //document.getElementById("bank_opt").fstdropdown.rebind();
      
    }     
});

});

$(document).on('keyup', "[id^=received_amount]", function() {
	var gtotamtval = $('#gtotamtval').val();
	var rmval = $('#received_amountval').val();
	var rcmt = $('#received_amount').val();
	var rr = parseFloat(rmval)+parseFloat(rcmt);
	
	
	

	if(parseFloat(rmval)>=parseFloat(gtotamtval))
	{
		$('#received_amount').val('');
		$('#disamt').hide();
		err = 1; err_msg = "Total amount paid "; tagid = "";
        return form_validation(err,err_msg,tagid);
	}
	else
	{
		$('#disamt').show();
	}

	if(parseFloat(rr)>parseFloat(gtotamtval))
    {
          $('#received_amount').val('');
          $('#disamt').hide();
          if(parseFloat(rr)>parseFloat(gtotamtval)){ err = 1; err_msg = "Received amount is less than grand total!"; tagid = "#received_amount"; 
          return form_validation(err,err_msg,tagid); }
          return false;
    }
	else
	{
		$('#disamt').show();
	}

	if(rcmt=='')
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

/*$(document).on('blur', "[id^=proqty]", function() {
		var id = $(this).attr('id');
    	id = id.replace("proqty", '');
    	
    	var qty = $('#proqty'+id).val();
		var mrp = $('#promrpval'+id).val();
		$('#promrp'+id).val(mrp);
		var ft = qty*mrp;
		$('#protot'+id).val(ft);

});*/

$(document).on('blur', "[id^=prodisc]", function() {
    calculateTotal();
}); 
$(document).on('blur', "[id^=proqty]", function() {
    	var id = $(this).attr('id');
    	id = id.replace("proqty", '');

    	var proqty = $('#proqty'+id).val();
    	var inventoryqty = $('#inventoryqty'+id).val();
    	var preqty = $('#preqty'+id).val();

    	if(proqty>inventoryqty)
    	{
    		
    		
    		if(inventoryqty==0)
    		{
    			$('#proqty'+id).val(preqty);
    			calculateTotal();
    			err = 1; err_msg = "Quantity is not available "; tagid = "#proqty"; 
          		return form_validation(err,err_msg,tagid); 
          		return false;
    		}
    		else
    		{
    			$('#proqty'+id).val(inventoryqty);
    			calculateTotal();
    			err = 1; err_msg = "Available quantity is "+inventoryqty; tagid = "#proqty"; 
          		return form_validation(err,err_msg,tagid); 
          		return false;
    		}

    		
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

    var branch = $("#branch").val();
    var proids = $("input[name='proid[]']").map(function(){return $(this).val();}).get();

    if(branch==undefined || branch=='')
    {
    	err = 1; err_msg = "Please select branch"; tagid = "#brn_l";
        return form_validation(err,err_msg,tagid);
    }
    else
    {
	    $('#proid'+id).val(0);
	    $('#promrpval'+id).val(0);
	    $('#promrp'+id).val(0);
	    $('#proqty'+id).val(0);
	    $('#preqty'+id).val(0);
	    $('#inventoryqty'+id).val(0);
	    $('#inventoryid'+id).val(0);
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
			      units : result.units,
			      purchase_amt : result.purchase_amt,
			      inventoryid: result.inventoryid,
			      inventoryqty: result.inventoryqty,
			      protag: result.protag
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

	     	calculateTotal();

	     	var rvvv = $('#rowval').val();
			var rowNum = rvvv;
	     	rowNum ++;
	     	var rrv = rowNum;
	     
	     	
	     	if($('#proid'+rrv).val()!='')
	     	{
	     		$('#rowval').val(rrv);

	     	htmlRows = '<tr id="rowNums'+rowNum+'" ><td><input type="hidden" placeholder="Product Name" name="proid[]" id="proid'+rowNum+'" value="0"><input type="hidden" name="inventoryid[]" id="inventoryid'+rowNum+'" value="0"><input type="hidden" name="inventoryqty[]" id="inventoryqty'+rowNum+'" value="0"><input type="hidden" name="preqty[]" id="preqty'+rowNum+'" value="0"><input class="mykey" type="text" placeholder="Product Name" name="proname[]" id="proname'+rowNum+'" ><input class="mykey" type="hidden" name="purchase_amt[]" id="purchase_amt'+rowNum+'" > </td><td class="qty txt_cnt"> <input type="text" class="mykey" placeholder="0" onkeypress="return onlyNumberKey(event)" name="proqty[]" id="proqty'+rowNum+'"></td><td class="mrp txt_rt"> <input type="text" class="mykey" readonly placeholder="0" name="promrp[]" id="promrp'+rowNum+'"><input type="hidden" placeholder="0" name="promrpval[]" id="promrpval'+rowNum+'"> </td><td class="disc txt_rt prodiscdisplay"> <input type="text" class="mykey disckey" placeholder="0" name="prodisc[]" id="prodisc'+rowNum+'"> </td><td class="ttl_prc txt_rt" onkeypress="return validateFloatKeyPress(this,event);" maxlength="4" > <input type="text" placeholder="0" readonly name="protot[]" id="protot'+rowNum+'"><input type="hidden" placeholder="0" name="prototval[]" id="prototval'+rowNum+'" > <input type="hidden" class="form-control noalpha mykey" placeholder="" readonly name="hid_acivity_id[]" id="hid_acivity_id_0" value="0"></td><td class="dele_th_td"> <i class="fa fa-trash" onclick="removerow('+rowNum+',0)" style="color:red"></i> </td></tr>';

	     	$('#invoiceItem').append(htmlRows);

	     	var sale_type = $("input[name='sale_types']:checked").val();
	     	if(sale_type=='cash')
	    	{
		     	$('.prodiscdisplay').show();
		    	$('#prodiscdisplaytd').show();
		    }
		    else{
		    	$('.prodiscdisplay').hide();
		    	$('#prodiscdisplaytd').hide();
		    } 	
	     }
	     	
	    }
	    
	    }).data( "ui-autocomplete" )._renderItem = function( ul, item ) { 
	     	
	    	if(item.protag=='New'){ var ptag = 'style="color:white;background:green;border-radius:5px"'; }else{ var ptag = 'style="color:white;background:red;border-radius:5px"'; }

	           return $( "<li></li>" )  

	               .data( "item.autocomplete", item )  

	                .append( "<a>" + item.label+ " "+item.units+"/"+item.packing+" <span "+ptag+">"+item.protag+"</span> - "+item.promrp+"</a>" )  

	               .appendTo( ul );  


	             
	   };
    }
    
});

$("#salefrm").submit(function(e) {  



	var sallen = $(':radio[name="sale_types"]:checked').length;
	var bralen = $(':radio[name="branchval"]:checked').length;
	var saletype = $("input[name='sale_types']:checked").val();
	var branchval = $("#branch").val();
    
    var ukey = $("#ukey").val();
    var userid = $("#userid").val();   
    var proname0 = $("#proname0").val();
    var proqty0 = $("#proqty0").val();

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
    /*if(bralen == 0 ){ err = 1; err_msg = "Please select branch!"; tagid = "#brn_l";
              return form_validation(err,err_msg,tagid);}  */ 
    
    if(ukey == ""){ err = 1; err_msg = "Please User Name/Mobile!"; tagid = "#ukey";
        return form_validation(err,err_msg,tagid);}  
                     
    if(saletype == "cash")
    {     
      var mobile = $("#mobile").val();  
      if(mobile == ""){ err = 1; err_msg = "Please enter mobile!"; tagid = "#mobile";
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
   var plength = $('input[name="proname[]"]').length;
   

    var values = $("input[name='proname[]']").map(function() { return $(this).val(); }).get();
    var newArray = values.filter(function(v) { return v !== '' });  

    if (newArray.length == 0) {
            err = 1;
            return form_validation(err, "Must have at least one product!", "");
    }

        //alert(plength);
		/*return false;*/


    /*if(proname0 == 0){ err = 1; err_msg = "Must have at least one product!"; tagid = "#proname0";
        return form_validation(err,err_msg,tagid);}*/
    /*if(proqty0 == 0){ err = 1; err_msg = "Please enter quantity!"; tagid = "#proqty0";
        return form_validation(err,err_msg,tagid);}*/

     if(saletype == "cash")
    {     
      var received_amount = $("#received_amount").val();  
      if(received_amount!='')
      {
      		 var payment_date = $("#payment_date").val();
      		 var bblen = $(':radio[name="bankid"]:checked').length;
      		 var bank_reference = $("#bank_reference").val();

      		if(payment_date == ""){ err = 1; err_msg = "Please select payment  date!"; tagid = "#payment_date";
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
                  

    /*form submit*/
    $('#invoice_body').load("<?php echo base_url('api/sales/invoice_preview')?>", $("form").serializeArray(),function(){
	    $(".pop_blk_prive").mCustomScrollbar({
	        theme:"minimal",
	        mouseWheelPixels: 35,
	        scrollInertia:250,
	    });
    });    
        
    $("#invoice_preview_modal").modal('show');    
    /*form submit*/
  });
$("#confirmOrder").on("click",function(){
    formData = new FormData(salefrm);
    $.ajax({
            url: url+"api/sales/update",
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
                  text: "Order updated successfully!",
                  type: 'success',
                  shadow: true
                });
                
                //
                window.location.href = "<?php echo base_url('api/sales/sale_invoice');?>/"+res.saleid;
                  setTimeout(function() {
                   location.replace(url+'admin/sales');
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
    	
    if(sale_type=='credit')
    {
      if(data == null)
      {
        //$("#ukey").val('');
        $('.err_msg').show();
      }
    } 
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
     // Set selection
     if(ui.item.user_type == "DEALER"){ $("#cropdis").hide();}else{ $("#cropdis").show(); }

     var sale_type = $("input[name='sale_types']:checked").val();
     if(sale_type=='cash')
     {
     	$("#cropdis").hide();
     	$('#guestmobile').show();
     }
     else
     {
     	$("#cropdis").show();
     	$('#guestmobile').hide();
     }

        $('#mobile').val(ui.item.mobile);
        $("#mobile").prop( "readonly", true );

     $('#ukey').val(ui.item.label); // display the selected text
     $('#userid').val(ui.item.user_id); // save selected id to input
     $('#usertype').val(ui.item.user_type); // save selected id to input

     //return false;
    }
    
   }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {  

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
        	//alert(prodisc);
        	//alert(tot1);
        	//alert(purchaseamt);

	        if ((parseFloat(tot1) < parseFloat(ppamt)) && prodisc!='' && prodisc!=0) {
	        	
	            alert('Discount should be lessthan purchase amount, purchase amount is ' + ppamt);
	            $('#prodisc' + id).val('');
	            var tot1 = promrpval*proqty;
	            var ftot = currency_format(tot1,2);
	            $('#protot' + id).val(ftot);
	        	$('#prototval' + id).val(tot1);
	        	
	        	//return false;
	        }
	        else
	        {
	        	
	        	var ftot = currency_format(tot1,2);
        		/*$('#protot' + id).val(addCommas(ftot));*/
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

    var GrandTot = parseFloat(grandTotal) + parseInt(loadc) + parseInt(transportc);
    //$('#totamt').html(addCommas(grandTotal));
    //$('#gtotamt').html(addCommas(GrandTot));
    if(grandTotal!=0)
   {
    $('#totamt').html(currency_format(grandTotal,2));
    $('#gtotamt').html(currency_format(GrandTot,2));
    $('#totdiscount').val(ddisc);
    $('#totamtval').val(grandTotal);
    $('#gtotamtval').val(GrandTot);

    var saletype = $("input[name='sale_types']:checked").val();
    if(saletype=='cash')
    {
    	var rcv = $('#received_amountval').val();

    	if(parseFloat(GrandTot)>parseFloat(rcv))
    	{
    		var rcvf = parseFloat(GrandTot)-parseFloat(rcv);
    		$('#textcash').html(' Due amount : '+currency_format(rcvf,2)+'</br> Paid amount : '+rcv);
    	}
    	else
    	{
    		var rcvf = parseFloat(rcv)-parseFloat(GrandTot);
    		if(rcvf!=0)
    		{
    			$('#textcash').html(currency_format(rcvf,2) +' Balance amount  </br> Total Paid Amount : '+rcv);
    		}   
    		else
    		{
    			$('#textcash').html('Total Paid Amount : '+rcv);
    		} 		
    	}
    	
    	$('#textcredit').hide();
    	
    	$('#textcash').show();
    	//$('#disamt').show();
    }else
    {
    	$('#disamt').hide();
    	$('#textcredit').show();
    	$('#textcash').html('Remaining amount will be added to user credit amount');
    	$('#textcash').hide();
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
function removerow(id,sid)
{
	
	var thid = $('#hid_acivity_id_' + id).val();
	
	if(thid!='' && thid!=0 && thid!=undefined)
	{
		if (confirm('Are you sure you want to remove')) {
	        $.ajax({    
	            url: url+"api/sales/salesdelete",
	            data: {tid:thid,saleid:sid},
	            type:'POST',    
	            datatype:'json',
	            success : function(responseff){
	            	calculateTotal();
	            }
	        });
	        var rr = $('#rowval').val();
	        if(rr!=0)
			{
				rr --;
	        	$('#rowval').val(rr);
	        	$('#rowNums'+id).remove();


	        }
			else if(rr==0)
			{
				$('#proname'+id).val('');
				$('#proqty'+id).val('');
				$('#promrpval'+id).val('');
				$('#promrp'+id).html('');
				$('#prodisc'+id).val('');
				$('#preqty'+id).val('');
	    		$('#inventoryqty'+id).val('');
	    		$('#inventoryid'+id).val('');
				calculateTotal();

				htmlRows = '<tr id="rowNums0" ><td><input type="hidden" placeholder="Product Name" name="proid[]" id="proid0" value="0"><input type="hidden" name="inventoryid[]" id="inventoryid0" value="0"><input type="hidden" name="inventoryqty[]" id="inventoryqty0" value="0"><input type="hidden" name="preqty[]" id="preqty0" value="0"><input class="mykey" type="text" placeholder="Product Name" name="proname[]" id="proname0" autocomplete="off" ><input class="mykey" type="hidden" name="purchase_amt[]" id="purchase_amt0" > </td><td class="qty txt_cnt"> </td><td class="qty txt_cnt"> <input type="text" class="mykey" placeholder="0" onkeypress="return onlyNumberKey(event)" name="proqty[]" id="proqty0"></td><td class="mrp txt_rt"> <input type="text" class="mykey" readonly placeholder="0" name="promrp[]" id="promrp0"><input type="hidden" placeholder="0" name="promrpval[]" id="promrpval0"> </td><td class="disc txt_rt prodiscdisplay"> <input type="text" class="mykey disckey" placeholder="0" name="prodisc[]"  id="prodisc0" onkeypress="return validateFloatKeyPress(this,event);" maxlength="4"> </td><td class="ttl_prc txt_rt"> <input type="text" placeholder="0" readonly name="protot[]" id="protot0"><input type="hidden" placeholder="0" name="prototval[]" id="prototval0"><input type="hidden" class="form-control noalpha mykey" placeholder="" readonly name="hid_acivity_id[]" id="hid_acivity_id_0" value="0"></td><td class="dele_th_td"> <i class="fa fa-trash" onclick="removerow(0,0)" style="color:red"></i> </td></tr>';
			        
			    $('#invoiceItem').append(htmlRows);

			    //rr --;
				$('#rowval').val(rr);
				$('#rowNums'+id).remove();

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
    	} 
	}
	else
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
			$('#preqty'+id).val('');
	    	$('#inventoryqty'+id).val('');
	    	$('#inventoryid'+id).val('');
			calculateTotal();
			$('#rowval').val(rr);
			$('#rowNums'+id).remove();

			htmlRows = '<tr id="rowNums0" ><td><input type="hidden" placeholder="Product Name" name="proid[]" id="proid0" value="0"><input type="hidden" name="inventoryid[]" id="inventoryid0" value="0"><input type="hidden" name="inventoryqty[]" id="inventoryqty0" value="0"><input type="hidden" name="preqty[]" id="preqty0" value="0"><input class="mykey" type="text" placeholder="Product Name" name="proname[]" id="proname0" autocomplete="off" ><input class="mykey" type="hidden" name="purchase_amt[]" id="purchase_amt0" > </td><td class="qty txt_cnt"> <input type="text" class="mykey" placeholder="0" onkeypress="return onlyNumberKey(event)" name="proqty[]" id="proqty0"></td><td class="mrp txt_rt"> <input type="text" class="mykey" readonly placeholder="0" name="promrp[]" id="promrp0"><input type="hidden" placeholder="0" name="promrpval[]" id="promrpval0"> </td><td class="disc txt_rt prodiscdisplay"> <input type="text" class="mykey disckey" placeholder="0" name="prodisc[]" onkeypress="return validateFloatKeyPress(this,event);" maxlength="4" id="prodisc0"> </td><td class="ttl_prc txt_rt"> <input type="text" placeholder="0" readonly name="protot[]" id="protot0"><input type="hidden" placeholder="0" name="prototval[]" id="prototval0"><input type="hidden" class="form-control noalpha mykey" placeholder="" readonly name="hid_acivity_id[]" id="hid_acivity_id_0" value="0"></td><td class="dele_th_td"> <i class="fa fa-trash" onclick="removerow(0,0)" style="color:red"></i> </td></tr>';
			        
			$('#invoiceItem').append(htmlRows);
			
			//rr --;
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
	}
	
	
}
function addmorerows()
{
	var sale_type = $("input[name='sale_types']:checked").val();

	if(sale_type=='cash')
	{
	    var sel = ''; 
	}
	else
	{
	    var sel = 'readonly';
	}

	var rr = $('#rowval').val();
	
			var rowNum = rr;
	     	rowNum ++;
	     	var rrv = rowNum;
	     	$('#rowval').val(rrv);
	     	
	     	htmlRows = '<tr id="rowNums'+rowNum+'" ><td><input type="hidden" placeholder="Product Name" name="proid[]" id="proid'+rowNum+'" value="0" ><input type="hidden" name="inventoryid[]" id="inventoryid'+rowNum+'" value="0"><input type="hidden" name="inventoryqty[]" id="inventoryqty'+rowNum+'" value="0"><input type="hidden" name="preqty[]" id="preqty'+rowNum+'" value="0"><input class="mykey" type="text" placeholder="Product Name" name="proname[]" id="proname'+rowNum+'" ><input class="mykey" type="hidden" name="purchase_amt[]" id="purchase_amt'+rowNum+'" > </td><td class="qty txt_cnt"> <input type="text" class="mykey" placeholder="0" onkeypress="return onlyNumberKey(event)" name="proqty[]" id="proqty'+rowNum+'"></td><td class="mrp txt_rt"> <input type="text" class="mykey" readonly placeholder="0" name="promrp[]" id="promrp'+rowNum+'"><input type="hidden" placeholder="0" name="promrpval[]" id="promrpval'+rowNum+'"> </td><td class="disc txt_rt prodiscdisplay"> <input type="text" class="mykey" placeholder="0" name="prodisc[]" id="prodisc'+rowNum+'" onkeypress="return validateFloatKeyPress(this,event);" maxlength="4"> </td><td class="ttl_prc txt_rt"> <input type="text" placeholder="0" readonly name="protot[]" id="protot'+rowNum+'"><input type="hidden" placeholder="0" name="prototval[]" id="prototval'+rowNum+'" > </td><td class="dele_th_td"><i class="fa fa-trash" onclick="removerow('+rowNum+')" style="color:red" ></i></td></tr>';

	     	$('#invoiceItem').append(htmlRows);

	     						if(sale_type=='cash')
								{
								    $('.prodiscdisplay').show();
	    							$('#prodiscdisplaytd').show();
								}
								else
								{
								    $('.prodiscdisplay').hide();
	    							$('#prodiscdisplaytd').hide();
								}
}
function viewpopup()
{
	$('#edt_user_id').show();
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
</script>
<?php require_once 'footer.php' ; ?>