<?php $this->load->view('admin/header');?>
<link href="<?php echo base_url();?>assets/css/user.css" type="text/css" rel="stylesheet">
<?php $this->load->view('admin/sidebar');?>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/snackbar.css" >
<link href="<?php echo base_url();?>assets/css/all.css" type="text/css" rel="stylesheet">
<style>.bname ~ .btn-group .multiselect-container {width: 210px!important; padding-bottom: 15px;}</style>
<div class="right_blk">
	<div class="top_ttl_blk"> <span class="back_btn">
		<!-- <a href="<?php echo base_url();?>admin/users/" title=""><img src="<?php echo base_url();?>assets/images/back.png" alt="" title=""> </a> --></span> <span> Create Users </span>
		<div id="snackbar" style="z-index:999999;"></div>
	</div>
	<div class="padding_30">
		<ul class="usrs_blk"> 
			<li class="far_act" id="far_icn"><a href="<?php echo base_url();?>admin/users/createfarmer"> <img src="<?php echo base_url();?>assets/images/farmer.png"><span>Farmer</span></a></li>
			<li class="deal_sub_del" id="dl_icn"><a href="<?php echo base_url();?>admin/users/createdealer"> <img src="<?php echo base_url();?>assets/images/dealer.png"><span>Dealer</span></a></li>
			<li id="non_va_icn"><a href="<?php echo base_url();?>admin/users/createnonfarmer"> <img src="<?php echo base_url();?>assets/images/non_farmer.png"><span>Non-Farmer</span></a></li>
			<li id="bulk_upload" class="fr"><img src="<?php echo base_url();?>assets/images/upload.png"><span>Bulk Upload</span><input type="file"></li>
		</ul>
		<div class="card_view bg_gry" id="basic">
			<div class="form-group" id="flsh_msg"></div>
		 <!-- Farmer Section -->
			<div id="former_div">			
			 <!-- Multiple Farmer Start -->
			 <form id="farmer" name="farmer" method="post" enctype="multipart/form-data" >	
				<div class="pad_20">
					<div class="hdg_bk"> Farmer Details <span id="success_msg" style="color:green;"></span>
						<ul class="frmr_type"> 
							<li class="slc_far"> 
								<div class="form-check">
									<label class="form-check-label" for="sing_far">
									<input type="radio" class="form-check-input" id="sing_far" name="optradio" value="sing_far" onclick="getFarmerType('sing_far');" checked> Single
									</label>
								</div>
							</li>

							<li> 
								<div class="form-check">
									<label class="form-check-label" for="par_far">
									<input type="radio" class="form-check-input" id="par_far" name="optradio" value="par_far" onclick="getFarmerType('par_far');"> Partnership
									</label>
								</div>
							</li>
						</ul>

					</div>
				</div>
					<div class="row"> 
						<div class="col-md-12 lft_blk"> 
							<div class="pad_20">
								<div class="row">
									<div class="col-md-4 single_r"> 
										<div class="form-group border-lable-flt">									
											<input type="text" class="form-control alphaonly" id="user_name" name="user_name" placeholder=" " />
											<label for="user_name" class="control-label required">Name</label>		
										</div>
									</div>
									<div class="col-md-4 partner_r"> 
										<div class="form-group border-lable-flt">									
											<input type="text" class="form-control alphaonly" id="firm_name" name="firm_name" placeholder="Firm Name">
											<label for="firm_name" class="control-label required">Firm Name</label>
										</div>
									</div>

									<div class="col-md-4 partner_r"> 
										<div class="form-group border-lable-flt">									
											<input type="text" class="form-control alphaonly" id="owner_name" name="owner_name" placeholder=" " />
											<label for="owner_name" class="control-label required">Owner Name</label>
										</div>
									</div>

									<div class="col-md-4"> 
										<div class="form-group border-lable-flt">								
											<input type="text" class="form-control alphaonly" id="guarantor" name="guarantor" placeholder=" " />
											<label for="guarantor">Guarantor(C/O)</label>								
										</div>
									</div>

									<div class="col-md-4"> 
										<div class="form-group border-lable-flt">
											<input type="text" class="form-control allownumericwithoutdecimal" id="mobile" name="mobile" placeholder=" " value="" onkeyup="checkmobile();" maxlength="10" />
											<label for="mobile" class="control-label required">Mobile</label>
										</div>
									</div>
									
									<div class="col-md-4"> 
										<div class="form-group border-lable-flt">
											<input type="email" class="form-control" id="email" name="email" placeholder=" " />
											<label for="email">Email</label>
										</div>
									</div>
									
									<div class="col-md-4"> 
										<div class="form-group border-lable-flt">
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
											<div class="form-group new_blk border-lable-flt">							
													<div class="new_blk_add"> <img src="<?php echo base_url();?>assets/images/add.png" alt="" title=""> </div>
													<input type="text" class="form-control allownumericwithoutdecimal" id="mob_numb_new" name="mob_numb_new" placeholder=" " value="" maxlength="10" disabled />
													<label for="mob_numb_new">Mobile</label>
													<ul class="new_mob_em_blk new_p"> </ul>
													<input type="hidden" id="hid_mob" name="hid_mob" class="multvals" />
											</div>
										</div>

										<div class="col-md-4"> 
											<div class="form-group new_blk border-lable-flt">
													<div class="new_blk_add new_m"> <img src="<?php echo base_url();?>assets/images/add.png" alt="" title=""> </div>			
													<input type="email" class="form-control" id="email_id_new" name="email_id_new" placeholder="Email Id" disabled />  
													<label for="email_id_new">Email</label>
													<ul class="new_mob_em_blk new_m"> </ul> 
													<input type="hidden" id="hid_mail" name="hid_mail" class="multvals" />												
											</div>
										</div>
									</div>
								</div>
								<div class="dft_mob_blk new_p">
									<div style="color: red; font-size: 14px;"> Please Fill Above Email and Phone Number </div>
								</div>

								<div class="hdg_bk">Accounts Information </div>

								<div class="row"> 
									<div class="col-md-4 single_r"> 
										<div class="form-group border-lable-flt">
											<input type="text" class="form-control allownumericwithoutdecimal" id="aadhar_no" name="aadhar_no" placeholder=" " maxlength="12">
											<label for="aadhar_no">Aadhar </label>
										</div>
									</div>

									<div class="col-md-4"> 
										<div class="form-group border-lable-flt">
											<input type="text" class="form-control" id="pan_no" name="pan_no" placeholder=" " maxlength="10" />
											<label for="pan_no">PAN</label>
										</div>
									</div>

									<div class="col-md-4 partner_r"> 
										<div class="form-group border-lable-flt">
											<input type="text" class="form-control" id="gst" name="gst" placeholder=" " />   
											<label for="gst">GST</label>
										</div>
									</div>
								</div>

								<div class="hdg_bk partner_r"> Partner details <span>Skip <input type="checkbox" id="partner_skip" name="partner_skip" value="1"/></span>
									<a href="javascript:void(0)" title="" class="fr ad_part"> + Add Partner </a>
								</div>
								<div class="new_part_lst partner_r" id="partner_cnt" data-partner-cnt="1" data-partner-ids="1">
									<div class="row dtl_par" data-bank-id="partner_acc_1" data-pid="1"> 
										<div class="col-md-4"> 
											<div class="form-group border-lable-flt">
												<input type="text" class="form-control" id="pname_1" name="pname[]" placeholder=" ">
												<label for="pname_1">Partner Name</label>
											</div>
										</div>

										<div class="col-md-4"> 
											<div class="form-group border-lable-flt">
												<input type="text" class="form-control allownumericwithoutdecimal" id="paadhar_1" name="paadhar[]" placeholder=" " maxlength="12">
												<label for="paadhar_1">Aadhar</label>
											</div>
										</div>

										<div class="col-md-4"> 
											<div class="form-group border-lable-flt">
												<input type="text" class="form-control allownumericwithoutdecimal" id="pmobile_1" name="pmobile[]" style="width: calc(100% - 40px);" placeholder=" " maxlength="10" >
												<label for="pmobile_1">Phone Number </label>
											</div>
										</div>
										
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12"> 
							<div class="pad_20 bg_w" id="bank_block">

								<div class="hdg_bk">Bank Details(<span id="bd_cnt">1</span>) <a href="javascript:void(0)" title="" class="fr ad_bnk"> + Add Bank </a> </div>
								
								<div class="bank_list" id="bank_cnt" data-bank-cnt="1" data-bank-ids="1"> 
									<div class="bank_list_pos">
										<div class="bank_dtl_blk" data-bank-id="bank_acc_1" data-bid="1">
											<div class="row"> 
												<div class="col-md-12"> 
													<div class="form-group border-lable-flt">
														<input type="text" class="form-control" id="fname_1" name="fname[]" placeholder=" " />
														<label for="fname_1">Person Full Name</label>
													</div>
												</div>

												<div class="col-md-6"> 
													<div class="form-group border-lable-flt">
														<input type="text" class="form-control allownumericwithoutdecimal" id="ac_number_1" name="ac_number[]" placeholder=" " />
														<label for="ac_number_1">Account Number</label>
													</div>
												</div>

												<div class="col-md-6"> 
													<div class="form-group">
														<select id="bc_name_1" name="bc_name[]" class="bname" placeholder="Select Bank" >
														</select>														
													</div>
												</div>

												<div class="col-md-6"> 
													<div class="form-group border-lable-flt">
														<input type="text" class="form-control" id="ifsc_1" name="ifsc[]" placeholder=" " />
														<label for="ifsc_1">IFSC</label>
													</div>
												</div>

												<div class="col-md-6"> 
													<div class="form-group border-lable-flt">
														<input type="text" class="form-control" id="branch_name_1" name="branch_name[]" placeholder=" " />
														<label for="branch_name_1">Branch Name</label>
													</div>
												</div>
												
											</div>
										</div>
									</div>
								</div>

								<div class="hdg_bk">Crop Details (<span id="cd_cnt">1</span>) <a href="javascript:void(0)" title="" class="fr ad_crp"> + Add Crop </a></div>
								
								<div class="crp_list" id="crop_cnt" data-crop-cnt="1" data-crop-ids="1"> 
									<div class="crp_list_pos">
										<div class="crp_dtl_blk" data-crop-id="crop_details_1" data-cid="1">
											<div class="row">
												<div class="col-md-6"> 
													<div class="form-group border-lable-flt">						
														<input type="text" class="form-control" id="crop_loc_1" name="crop_loc[]" placeholder=" " />
														<label for="crop_loc_1" class="control-label required">Crop Location</label>
													</div>
												</div>

												<div class="col-md-6"> 
													<div class="form-group">
														<!-- <input type="text" class="form-control" id="crop_type_1" name="crop_type[]" placeholder=" " />
														<label for="crop_type_1">Crop type</label> -->
														<select id="crop_type_1" name="crop_type[]" class="ctype" placeholder="Select Crop" >
														</select>
													</div>
												</div>

												<div class="col-md-6"> 
													<div class="form-group border-lable-flt">
														<input type="text" class="form-control" id="acres_1" name="acres[]" placeholder=" " onkeypress="return allowNumerORDecimal(event,this)">
														<label for="acres_1" class="control-label required">Number of Acres</label>
													</div>
												</div>
												<div class="col-md-6"> 
													<div class="form-group border-lable-flt">
														<input type="text" class="form-control" id="transaction_balance_1" name="transaction_balance[]" placeholder=" " onkeypress="return allowNumerORDecimal(event,this)">
														<label for="transaction_balance_1" class="control-label required">Open Balance</label>
													</div>
												</div>
												
											</div>
										</div>
									</div>
								</div>

								<!-- <div class="hdg_bk">Default Discounts <a href="javascript:void(0)" title="" class="fr ad_med"> + Add Medicines </a></div>
								<div class="row" id="med_block" data-med-cnt="3" data-med-ids="1">
									<div class="col-md-4"> 
										<div class="form-group">
											<span class="deflt">&nbsp;</span>
											<span class="border-lable-flt">								
												<input type="text" class="form-control" id="feed" name="feed" placeholder=" " onkeypress="return allowNumerORDecimal(event,this)" />  
												<label for="name">Feed(%)</label>
											</span>
										</div>
									</div>

									<div class="col-md-4 med_details" id="mdiv_1" data-med-id="med_details_1" data-mid="1"> 
										<div class="form-group">
											<span class="deflt">&nbsp;</span> 
												<a href="javascript:void(0)" title="" class="fr change_med" onclick="changemed('fm1');"> Change </a>
												
											<span class="border-lable-flt">									
												<input type="text" class="form-control" id="medicines1" name="medicines[]" placeholder=" " onkeypress="return allowNumerORDecimal(event,this)" />
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
												<input type="hidden"  id="hidfm3" name="hidfm3" value="<?php echo $med3;?>"/>
												<input type="hidden" id="hidm3" name="hidm3" value="<?php echo $med3;?>"/>
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
								</div> -->
								
								<div class="hdg_bk">Documents upload </div>
								<div class="doc_up_lode"> 
									<div class="row"> 
										<div class="col-md-4"> 
											<div class="form-group">									
												<select id="docs_upld2" name="docs_upld2" multiple="multiple" class="form-control">
													<option value="aadhar">Aadhar</option>
													<option value="pan">PAN</option>
													<option value="gst">GST</option>
													<option value="cheque">Cheque</option>
													<option value="promissory">Promissory Note</option>
													<option value="gp">GP Document</option>
													<option value="stamp">Stamp Document</option>
													<option value="partnerdeed">Partnership Deed</option>
												</select>
											</div>
										</div>
										<div class="col-md-4"> 
											<div class="form-group border-lable-flt">
												<input type="text" id="recdate" name="recdate" placeholder=" " class="form-control" readonly />
												<label for="recdate"> Documents Received Date </label>
											</div>
										</div>
										<div class="col-md-4"> 
											<div class="form-group border-lable-flt">
												<input type="text" id="retdate" name="retdate" placeholder=" " class="form-control" readonly /> 
												<label for="retdate"> Documents Return Date </label>
											</div>
										</div>
									</div>
									
									<div class="row slct_docs"></div>
									<div class="row">
										<div class="col-md-4"> 
											<div class="form-group border-lable-flt">
												<textarea class="form-control" id="doc_rem" name="doc_rem" rows="3" placeholder=" "></textarea>
												<label for="rem">Remarks</label>
											</div>
										</div>
									</div>
								</div>

								<div class="hdg_bk">Credit
									<!-- <select class="pos_neg" id="os_type" name="os_type" > 
										<option value="p"> + Additional Balance </option> 
										<option value="n"> - Negative Balance </option> 
									</select> -->
								</div>
								<div class="row">

									<div class="col-md-4"> 
										<div class="form-group border-lable-flt">
											<input type="text" placeholder=" " id="credit_limit" name="credit_limit" class="form-control" onkeypress="return allowNumerORDecimal(event,this)" />
											<label for="credit_limit"> Credit Limit </label>
										</div>
									</div>

									<!-- <div class="col-md-4"> 
										<div class="form-group">
											<label> Open Balance </label>
											<input type="text" placeholder="" id="open_balance" name="open_balance" class="form-control" onkeypress="return allowNumerORDecimal(event,this)"> 
										</div>
									</div> -->

								</div>
								
								<div class="form-group"> <button type="submit" class="btn btn-primary sub_btn" onclick="return validateFarmer();" id="sub_btn">Submit <span id="loader"></span></button>&nbsp;&nbsp;<span id="sub_btn_msg"></span></div>
							</div>
						</div>
					</div>
					<br/>
					<input type="hidden" id="action" name="action" value="farmer"/>
					<input type="hidden" id="actiontype" name="actiontype" value="add"/>
					<input type="hidden" id="hid_type" name="hid_type" value="fs" />
					<input type="hidden" id="hid_cnfsbmt" name="hid_cnfsbmt" value="0" />
					<input type="hidden" id="hid_medval" name="hid_medval" value="" />
					<!-- for medicines -->
					<input type="hidden" id="mobexists" name="mobexists" value="0" />
					<input type="hidden" id="allmed" name="allmed" value="<?php echo $allmed;?>" />
				</form>
			<!-- Multiple Farmer End -->
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('admin/user/brands',$data);?>
<script type="text/javascript">
	var url = '<?php echo base_url()?>';
	var loader_fa='<i class="fa fa-circle-o-notch fa-spin" style="font-size:15px"></i>';
</script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/new_common1.js" type="javascript"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/views/farmer_new.js" type="javascript"></script>
<?php $this->load->view('admin/footer');?>