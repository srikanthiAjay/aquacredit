<?php $this->load->view('admin/header');?>
<link href="<?php echo base_url();?>assets/css/user.css" type="text/css" rel="stylesheet">
<?php $this->load->view('admin/sidebar');?>
<link href="<?php echo base_url();?>assets/css/all.css" type="text/css" rel="stylesheet">
<div class="right_blk">
	<div class="top_ttl_blk"> <span class="back_btn">
		<!-- <a href="<?php echo base_url();?>admin/users/" title=""><img src="<?php echo base_url();?>assets/images/back.png" alt="" title=""> </a> --></span> <span> Create Users </span>
	</div>
	<div class="padding_30">
		<ul class="usrs_blk"> 
			<li id="far_icn"><a href="<?php echo base_url();?>admin/users/createfarmer"> <img src="<?php echo base_url();?>assets/images/farmer.png"><span>Farmer</span> </a></li>
			<li class="far_act deal_sub_del"  id="dl_icn"><a href="<?php echo base_url();?>admin/users/createdealer"> <img src="<?php echo base_url();?>assets/images/dealer.png"><span>Dealer</span></a></li>
			<li id="non_va_icn"><a href="<?php echo base_url();?>admin/users/createnonfarmer"> <img src="<?php echo base_url();?>assets/images/non_farmer.png"><span>Non-Farmer</span></a></li>
			<li id="bulk_upload" class="fr"><img src="<?php echo base_url();?>assets/images/upload.png"><span>Bulk Upload</span><input type="file"></li>
		</ul>
		<div class="card_view bg_gry">
			<div class="form-group" id="flsh_msg"></div>
			<!-- Dealer Section -->	  
			<form id="dealerform" name="dealerform" method="post" enctype="multipart/form-data" >
				<div class="row"> 
					<div class="col-md-12 lft_blk"> 
						<div class="pad_20">
							<div class="hdg_bk"> User Details (Dealer) <span id="success_msg" style="color:green;"></span></div>

							<div class="row">

								<div class="col-md-4"> 
									<div class="form-group">
										<span class="border-lable-flt">											
											<input type="text" class="form-control" id="firm_name" name="firm_name" placeholder=" " />
											<label for="firm_name">Firm Name</label>
										</span>
									</div>
								</div>

								<div class="col-md-4 partner_r"> 
									<div class="form-group">
										<span class="border-lable-flt">											
											<input type="text" class="form-control" id="owner_name" name="owner_name" placeholder=" " />
											<label for="owner_name">Owner Name</label>
										</span>
									</div>
								</div>

								<div class="col-md-4"> 
									<div class="form-group">
										<span class="border-lable-flt">										
											<input type="text" class="form-control" id="guarantor" name="guarantor" placeholder=" " />
											<label for="guarantor">Guarantor(C/O)</label>
										</span>
									</div>
								</div>

								<div class="col-md-4"> 
									<div class="form-group">
										<span class="border-lable-flt">											
											<input type="text" class="form-control allownumericwithoutdecimal" id="mobile" name="mobile" placeholder=" " value="" onkeyup="checkmobile();" maxlength="10" />
											<label for="mobile">Mobile</label>
										</span> 
									</div>
								</div>

								<div class="col-md-4"> 
									<div class="form-group">
										<span class="border-lable-flt">										
											<input type="email" class="form-control" id="email" name="email" placeholder=" ">
											<label for="email">Email Id</label>
										</span>
									</div>
								</div>
								
								<div class="col-md-4"> 
									<div class="form-group">
										<span class="border-lable-flt">											
											<textarea   class="form-control" id="address" name="address" placeholder=" " rows="2"></textarea> 
										<label for="address">Address</label>
									</div>
								</div>
								
							</div>
							<div class="hdg_bk"> Alerts </div>
							<div class="clr"></div>
							<p class="alert_txt"> Do you want to receive alerts :  </p>
							
							<div class="alerts_confirm fl">
								<div class="alert_check"> <input type="checkbox" id="notify_alert" name="notify_alert" value="1" checked /> 
								<div class="trun_txt"> Turn on </div>
								</div>
							</div>
							<div class="clr"></div>

							<div class="aler_lnks">
								<div class="row">
									<div class="col-md-4"> 
										<div class="form-group new_blk">
											<span class="border-lable-flt">										
												<div class="new_blk_add"> <img src="<?php echo base_url();?>assets/images/add.png" alt="" title=""> </div>
												<input type="text" class="form-control allownumericwithoutdecimal" id="mob_numb_new" name="mob_numb_new" placeholder=" " value="" disabled />
												<label for="mob_numb_new">Mobile Number</label>
												<ul class="new_mob_em_blk new_p"> </ul>
												<input type="hidden" id="hid_mob" name="hid_mob" class="multvals" />
											</span>
										</div>
									</div>

									<div class="col-md-4"> 
										<div class="form-group new_blk">
											<span class="border-lable-flt">										
												<div class="new_blk_add new_m"> <img src="<?php echo base_url();?>assets/images/add.png" alt="" title=""> </div>
												<input type="email" class="form-control" id="email_id_new" name="email_id_new" placeholder=" " disabled />  
												<label for="email_id_new">Email Id</label>
												<ul class="new_mob_em_blk new_m"> </ul> 
												<input type="hidden" id="hid_mail" name="hid_mail" class="multvals" />
											</span>
										</div>
									</div>
								</div>
							</div>
							<div class="dft_mob_blk new_p">
								<div style="color: red; font-size: 14px;"> Please Fill Above Email and Phone Number </div> 
							</div>

							<div class="hdg_bk">Accounts Information </div>
							<div class="row"> 
								<div class="col-md-4"> 
									<div class="form-group">
										<span class="border-lable-flt">											
											<input type="text" class="form-control allownumericwithoutdecimal" id="aadhar_no" name="aadhar_no" placeholder=" " maxlength="12" />
											<label for="aadhar_no">Aadhar </label>
										</span>
									</div>
								</div>

								<div class="col-md-4"> 
									<div class="form-group">
										<span class="border-lable-flt">											
											<input type="text" class="form-control" id="pan_no" name="pan_no" placeholder=" " maxlength="10" />
											<label for="pan_no">PAN</label>
										</span>
									</div>
								</div>

								<div class="col-md-4"> 
									<div class="form-group">
										<span class="border-lable-flt">											
											<input type="text" class="form-control" id="gst" name="gst" placeholder=" " />
											<label for="gst">GST</label>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12"> 
					  <div class="pad_20 bg_w">

						<div class="hdg_bk">Bank Details(<span id="bd_cnt">1</span>) <span>Skip <input type="checkbox" id="bank_skip" name="bank_skip" value="1"/></span><a href="javascript:void(0)" title="" class="fr ad_bnk"> + Add Bank </a> </div>

						<div class="bank_list" id="bank_cnt" data-bank-cnt="1" data-bank-ids="1"> 
							<div class="bank_list_pos">
								<div class="bank_dtl_blk" data-bank-id="bank_acc_1" data-bid="1">
									<div class="row"> 
										<div class="col-md-6"> 
											<div class="form-group">
												<span class="border-lable-flt">									
													<input type="text" class="form-control" id="fname_1" name="fname[]" placeholder=" " />
													<label for="fname_1">Person Full Name</label>
												</span>
											</div>
										</div>

										<div class="col-md-6"> 
											<div class="form-group">
												<span class="border-lable-flt">									
													<input type="text" class="form-control allownumericwithoutdecimal" id="ac_number_1" name="ac_number[]" placeholder=" " />
													<label for="ac_number_1">Account Number</label>
												</span>
											</div>
										</div>

										<div class="col-md-6"> 
											<div class="form-group">
												<span class="border-lable-flt">									
													<input type="text" class="form-control" id="bc_name_1" name="bc_name[]" placeholder=" " />
													<label for="name">Bank Name</label>
												</span>
											</div>
										</div>

										<div class="col-md-6"> 
											<div class="form-group">
												<span class="border-lable-flt">								
													<input type="text" class="form-control" id="ifsc_1" name="ifsc[]" placeholder=" " />
													<label for="ifsc_1">IFSC</label>
												</span>
											</div>
										</div>

										<div class="col-md-6"> 
											<div class="form-group">
												<span class="border-lable-flt">									
													<input type="text" class="form-control" id="branch_name_1" name="branch_name[]" placeholder=" " /> 
													<label for="branch_name_1">Branch Name</label>
												</span>
											</div>
										</div>
										
									</div>
								</div>
							</div>
						</div>

						<div class="hdg_bk">Default Discounts <a href="javascript:void(0)" title="" class="fr ad_med"> + Add Medicines </a></div>
								<div class="row" id="med_block" data-med-cnt="3" data-med-ids="1">
									<div class="col-md-4"> 
										<div class="form-group">
											<span class="deflt">&nbsp;</span>
											<span class="border-lable-flt">										
												<input type="text" class="form-control" id="feed" name="feed" placeholder=" " onkeypress="return allowNumerORDecimal(event,this)" /> 
												<label for="feed">Feed(%)</label>
											</span>
										</div>
									</div>

									<div class="col-md-4 med_details" id="mdiv_1" data-med-id="med_details_1" data-mid="1"> 
										<div class="form-group">
											<span class="deflt">&nbsp;</span> 
											<a href="javascript:void(0)" title="" class="fr change_med" onclick="changemed('fm1');"> Change </a>
											<span class="border-lable-flt">	
												<input type="text" class="form-control" id="medicines1" name="medicines[]" placeholder="Medicines1" onkeypress="return allowNumerORDecimal(event,this)" />
												<label for="medicines1">Medicines1 (%) Default</label>
												<input type="hidden"  id="hidfm1" name="hidfm1" value="<?php echo $med1;?>" />
												<input type="hidden" id="hidm1" name="hidm1" value="<?php echo $med1;?>" />
											</span>
										</div>
									</div>

									<div class="col-md-4 med_details" id="mdiv_2" data-med-id="med_details_2" data-mid="2"> 
										<div class="form-group">
											<span class="deflt">&nbsp;</span> 
											<a href="javascript:void(0)" title="" class="fr change_med" onclick="changemed('fm2');"> Change </a>
											<span class="border-lable-flt">
												<input type="text" class="form-control" id="medicines2" name="medicines[]" placeholder=" " onkeypress="return allowNumerORDecimal(event,this)" /> 
												<label for="medicines2">Medicines2 (%) Default</label>
												<input type="hidden"  id="hidfm2" name="hidfm2" value="<?php echo $med2;?>" />
												<input type="hidden" id="hidm2" name="hidm2" value="<?php echo $med2;?>" />
											</span>
										</div>
									</div>

									<div class="col-md-4 med_details" id="mdiv_3" data-med-id="med_details_3" data-mid="3"> 
										<div class="form-group">
											<span class="deflt">&nbsp;</span> 
											<a href="javascript:void(0)" title="" class="fr change_med" onclick="changemed('fm3');"> Change </a>
											<span class="border-lable-flt">	
												<input type="text" class="form-control" id="medicines3" name="medicines[]" placeholder=" " onkeypress="return allowNumerORDecimal(event,this)" />
												<label for="medicines3">Medicines3 (%) Default</label>
												<input type="hidden"  id="hidfm3" name="hidfm3" value="<?php echo $med3;?>" />
												<input type="hidden" id="hidm3" name="hidm3" value="<?php echo $med3;?>" />
											</span>
										</div>
									</div>

									<div class="col-md-4 roi"> 
										<div class="form-group">
											<span class="deflt">&nbsp;</span>
											<span class="border-lable-flt">										
												<input type="text" class="form-control" id="roi" name="roi" placeholder=" " onkeypress="return allowNumerORDecimal(event,this)" /> 
												<label for="roi">Rate of intrest</label>
											</span>
										</div>
									</div>
								</div>

						<div class="hdg_bk">Documents upload </div>

						<div class="doc_up_lode"> 
							<div class="row"> 
								<div class="col-md-4"> 
									<label class="form-group border-lable-flt">
										<select id="docs_upld1" name="docs_upld1" multiple="multiple">
											<option value="aadhar">Aadhar</option>
											<option value="pan">PAN</option>
											<option value="gst">GST</option>
											<option value="cheque">Cheque</option>
											<option value="promissory">Promissory Note</option>
											<option value="gp">GP Document</option>
											<option value="stamp">Stamp Document</option>
											<option value="partnerdeed">Partnership Deed</option>
										</select>
										<span> Select Document Type </span>
									</label>
								</div>
								
								<div class="col-md-4"> 
									<div class="form-group">
										<span class="border-lable-flt">
											<input type="date" id="recdate" name="recdate" placeholder=" " class="form-control" /> 
											<label for="recdate"> Documents Received Date </label>
										</span>
									</div>
								</div>
								
								<div class="col-md-4"> 
									<div class="form-group">
										<span class="border-lable-flt">											
											<input type="date" id="retdate" name="retdate" placeholder=" " class="form-control" />
											<label for="retdate"> Documents Return Date </label>
										</span>
									</div>
								</div>

								<!--    <div class="col-md-4"> 
									<div class="form-group">
										<label for="rem">Remarks</label>
										<textarea class="form-control" id="rem" rows="3" placeholder="Remarks"></textarea> 
									</div>
								</div> -->
								
							</div>

							<div class="row slct_docs"></div>
							<div class="row">
								<div class="col-md-4"> 
									<div class="form-group">
										<span class="border-lable-flt">											
											<textarea class="form-control" id="doc_rem" name="doc_rem" rows="3" placeholder=" "></textarea>
											<label for="doc_rem">Remarks</label>
										</span>
									</div>
								</div>
							</div>
						</div>

						<div class="hdg_bk">Amounts
							<!-- <select class="pos_neg" id="os_opt" name="os_opt"> 
								<option value="p"> + Additional Balance </option> 
								<option value="n"> - Negative Balance </option> 
							</select> -->
						</div>
						<div class="row">

							<div class="col-md-4"> 
								<div class="form-group">
									<span class="border-lable-flt">										
										<input type="text" placeholder=" " id="credit_limit" name="credit_limit" class="form-control allownumericwithoutdecimal" /> 
										<label for="credit_limit"> Credit Limit </label>
									</span>
								</div>
							</div>

							<div class="col-md-4"> 
								<div class="form-group">
									<span class="border-lable-flt">										
										<input type="text" placeholder=" " id="open_balance" name="open_balance" class="form-control allownumericwithoutdecimal" /> 
										<label for="open_balance"> Open Balance </label>
									</span>
								</div>
							</div>

							<!-- <div class="col-md-4"> 
							<div class="form-group">
							<label for="rem">Remarks</label>
							<textarea class="form-control" id="os_rem" name="os_rem" rows="3" placeholder="Remarks"></textarea> 
							</div>
							</div> -->

						</div>

						<div class="form-group"> <button type="submit" class="btn btn-primary sub_btn" onclick="return validateDealer();" id="sub_btn">Submit <span id="loader"></span></button>&nbsp;&nbsp;<span id="sub_btn_msg"></span></div>
						</div>
					</div>
				</div>
				<br/>
				<input type="hidden" id="action" name="action" value="dealer"/>
				<input type="hidden" id="actiontype" name="actiontype" value="add"/>
				<input type="hidden" id="hid_type" name="hid_type" value="fs" />
				<input type="hidden" id="hid_cnfsbmt" name="hid_cnfsbmt" value="0" />
				<input type="hidden" id="hid_medval" name="hid_medval" value="" />
				<!-- for medicines -->
				<input type="hidden" id="mobexists" name="mobexists" value="0" />
				<input type="hidden" id="allmed" name="allmed" value="<?php echo $allmed;?>" />
			</form>

		<!-- Dealer Section End -->
		</div>
	</div>
</div>
<?php $this->load->view('admin/user/brands',$data);?>
<script type="text/javascript">
	var url = '<?php echo base_url()?>';
	var loader_fa='<i class="fa fa-circle-o-notch fa-spin" style="font-size:15px"></i>';
</script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/new_common.js" type="javascript"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/views/dealer.js" type="javascript"></script>
<?php $this->load->view('admin/footer');?>