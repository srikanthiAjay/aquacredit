<?php require_once 'header.php' ; ?>
<link href="<?php echo base_url();?>assets/css/user.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>assets/js/common.js" type="javascript"></script>
<?php require_once 'sidebar.php' ; ?>		
<div class="right_blk"> 
	<div class="top_ttl_blk"> <span class="back_btn">
		<a href="user_list.html" title=""><img src="<?php echo base_url();?>assets/images/back.png" alt="" title=""> </a></span> <span> Create Users </span>
	</div>

	<div class="padding_30">
		<ul class="usrs_blk"> 
			<li class="far_act" id="far_icn"> <img src="<?php echo base_url();?>assets/images/f_1.png"><span>Farmer</span> </li>
			<li id="dl_icn"> <img src="<?php echo base_url();?>assets/images/f_2.png"><span>Dealer / Sub-Dealer</span></li>
			<li id="non_va_icn"> <img src="<?php echo base_url();?>assets/images/f_3.png"><span>Non-Farmer</span></li>
			<li id="bulk_upload" class="fr"><img width="57" src="<?php echo base_url();?>assets/images/upload.png"><span>Bulk Upload</span><input type="file"></li>
		</ul>
	  
		<div class="card_view bg_gry">
			<div class="form-group" id="flsh_msg"></div>
		<!-- Non-Farmer Section -->
			<form id="non_frm" name="non_frm" method="post" enctype="multipart/form-data" >
				<div class="row"> 
					<div class="col-md-12 lft_blk"> 
						<div class="pad_20">
							<div class="hdg_bk"> User Details (Non-Farmer) </div>
							
							<div class="row">
								<div class="col-md-4"> 
									<div class="form-group">
										<label for="name">Name</label>
										<input type="text" class="form-control" id="uname" name="uname" placeholder="Name">   
									</div>
								</div>

								<div class="col-md-4"> 
									<div class="form-group">
										<label for="name">Guarantor(C/O)</label>
										<input type="text" class="form-control" id="guaran" name="guaran" placeholder="Guarantor(C/O)">   
									</div>
								</div>

								<div class="col-md-4"> 
									<div class="form-group">
										<label for="name">Mobile</label>
										<input type="text" class="form-control allownumericwithoutdecimal" id="mob_numb" name="mob_numb" placeholder="Mobile Number" value="">   
									</div>
								</div>
								
								<div class="col-md-4"> 
									<div class="form-group">
										<label for="name">Email Id</label>
										<input type="email" class="form-control" id="email_id" name="email_id" placeholder="Email Id">  
									</div>
								</div>

								<div class="col-md-4"> 
									<div class="form-group">
										<label for="name">Address</label>
										<textarea   class="form-control" id="uaddr" name="uaddr" rows="2" placeholder="Address"></textarea> 
									</div>
								</div>

								<!--   <div class="col-md-4"> 
									<div class="form-group">
										<label for="name">Address</label>
										<input type="text" class="form-control" id="loc" name="loc" placeholder="Address">   
									</div>
								</div> -->

							</div>

							<div class="hdg_bk"> Alerts </div>
							<div class="clr"> </div>
							<p class="alert_txt"> Do you want to receive alerts :  </p>
							
							<div class="alerts_confirm fl">
								<div class="alert_check"> <input type="checkbox" id="turnchk" name="turnchk" value="1" checked /> 
								<div class="trun_txt"> Turn on </div>
								</div>
							</div>
							<div class="clr"> </div>

							<div class="aler_lnks">
								<div class="row">
									<div class="col-md-4"> 
										<div class="form-group new_blk">
											<label for="name">Mobile</label>
											<div class="new_blk_add"> <img src="<?php echo base_url();?>assets/images/add.png" alt="" title=""> </div>
											<input type="text" class="form-control allownumericwithoutdecimal" id="mob_numb_new" name="mob_numb_new" placeholder="Mobile Number" value="" disabled />
											<ul class="new_mob_em_blk new_p"> </ul>
											<input type="hidden" id="hid_mob_nf" name="hid_mob_nf" class="multvals_nf" />
										</div>
									</div>

									<div class="col-md-4"> 
										<div class="form-group new_blk">
											<label for="name">Email Id</label>
											<div class="new_blk_add new_m"> <img src="<?php echo base_url();?>assets/images/add.png" alt="" title=""> </div>
											<input type="email" class="form-control" id="email_id_new" name="email_id_new" placeholder="Email Id" disabled />  
											<ul class="new_mob_em_blk new_m"> </ul> 
											<input type="hidden" id="hid_mail_nf" name="hid_mail_nf" class="multvals_nf" />
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
										<label for="name">Aadhar </label>
										<input type="text" class="form-control" id="aadhar" name="aadhar" placeholder="Aadhar">   
									</div>
								</div>

								<div class="col-md-4"> 
									<div class="form-group">
										<label for="name">PAN</label>
										<input type="text" class="form-control" id="pan" name="pan" placeholder="PAN">   
									</div>
								</div>

								<div class="col-md-4"> 
									<div class="form-group">
										<label for="name">GST </label>
										<input type="text" class="form-control" id="gst" name="gst" placeholder="GST">   
									</div>
								</div>

							</div>
						</div>
					</div>
					<div class="col-md-12"> 
						<div class="pad_20 bg_w">				 

							<div class="hdg_bk">Bank Details(1) <a href="javascript:void(0)" title="" class="fr ad_bnk"> + Add Bank </a> </div>

							<div class="bank_list"> 
								<div class="bank_list_pos">
									<div class="bank_dtl_blk">
										<div class="row"> 
											<div class="col-md-6"> 
												<div class="form-group">
													<label for="name">Person Full Name</label>
													<input type="text" class="form-control" id="fname" name="fname[]" placeholder="Person Full Name">   
												</div>
											</div>

											<div class="col-md-6"> 
												<div class="form-group">
													<label for="name">Account Number</label>
													<input type="text" class="form-control allownumericwithoutdecimal" id="ac_number" name="ac_number[]" placeholder="Account Number">   
												</div>
											</div>
											
											<div class="col-md-6"> 
												<div class="form-group">
													<label for="name">Bank Name</label>
													<input type="text" class="form-control" id="bc_name" name="bc_name[]" placeholder="Bank Name">   
												</div>
											</div>

											<div class="col-md-6"> 
												<div class="form-group">
													<label for="name">IFSC</label>
													<input type="text" class="form-control" id="ifsc" name="ifsc[]" placeholder="IFSC">   
												</div>
											</div>

											<div class="col-md-6"> 
												<div class="form-group">
													<label for="name">Branch Name</label>
													<input type="text" class="form-control" id="branch_name" name="branch_name[]" placeholder="branch Name">   
												</div>
											</div>
											
										</div>
									</div>
								</div>
							</div>

							<div class="hdg_bk">Default Discounts </div>

							<div class="row"> 
								<div class="col-md-4"> 
									<div class="form-group">
										<label for="name">Rate Of Interest</label>
										<input type="text " class="form-control" id="rate_of_int" name="rate_of_int" placeholder="Rate Of Interest"> 
									</div>
								</div>
							</div>

							<div class="hdg_bk">Documents upload </div>

							<div class="doc_up_lode"> 
								<div class="row"> 
									<div class="col-md-4"> 
										<div class="form-group">
											<label> Select Document Type </label>
											<select id="docs_upld4" name="docs_upld4" multiple="multiple">
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
										<div class="form-group">
											<label> Documents Received Date </label>
											<input type="date" id="recdate" name="recdate" placeholder="Documents Received Date" class="form-control" /> 
										</div>
									</div>
									
									<div class="col-md-4"> 
										<div class="form-group">
											<label> Documents Return Date </label>
											<input type="date" id="retdate" name="retdate" placeholder="Documents Return Date" class="form-control" /> 
										</div>
									</div>

									<!--   <div class="col-md-4"> 
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
											<label for="rem">Remarks</label>
											<textarea class="form-control" id="doc_rem" name="doc_rem" rows="3" placeholder="Remarks"></textarea> 
										</div>
									</div>
								</div>
							</div>

							<div class="hdg_bk" id="os_opt" name="os_opt">Outstanding Amount 
								<select class="pos_neg"> 
									<option value="p"> + Additional Balance </option> 
									<option value="n"> - Negative Balance </option> 
								</select>
							</div>
							
							<div class="row">

								<div class="col-md-4"> 
									<div class="form-group">
										<label> Outstanding Amount </label>
										<input type="text" placeholder="Outstanding Amount" id="os_amt" name="os_amt" class="form-control allownumericwithoutdecimal"> 
									</div>
								</div>

								<div class="col-md-4"> 
									<div class="form-group">
										<label for="rem">Remarks</label>
										<textarea class="form-control" id="os_rem" name="os_rem" rows="3" placeholder="Remarks"></textarea> 
									</div>
								</div>

							</div>
							<div class="form-group"> <button type="submit" class="btn btn-primary sub_btn" onclick="frmsbmt('nf');">Submit</button> </div>
						</div>
					</div>
				</div>
				<br/>
			</form>
		<!-- Non-Farmer Section End -->
			
		<!-- Dealer Section -->	  
			<form id="dealer" name="dealer" method="post" enctype="multipart/form-data" >
			
				<div class="row"> 
					<div class="col-md-12 lft_blk"> 
						<div class="pad_20">
							<div class="hdg_bk"> User Details (Dealer) </div>

							<div class="row">

								<div class="col-md-4"> 
									<div class="form-group">
										<label for="name">Firm Name</label>
										<input type="text" class="form-control" id="firm_name" name="firm_name" placeholder="Firm Name">   
									</div>
								</div>

								<div class="col-md-4"> 
									<div class="form-group">
										<label for="name">Owner Name</label>
										<input type="text" class="form-control" id="uname" name="uname" placeholder="Owner Name">   
									</div>
								</div>

								<div class="col-md-4"> 
									<div class="form-group">
										<label for="name">Guarantor(C/O)</label>
										<input type="text" class="form-control" id="guaran" name="guaran" placeholder="Guarantor(C/O)">   
									</div>
								</div>

								<div class="col-md-4"> 
									<div class="form-group">
										<label for="name">Mobile</label>
										<input type="text" class="form-control allownumericwithoutdecimal" id="mob_numb" name="mob_numb" placeholder="Mobile Number" value=""> 
									</div>
								</div>

								<div class="col-md-4"> 
									<div class="form-group">
										<label for="name">Email Id</label>
										<input type="email" class="form-control" id="email_id" name="email_id" placeholder="Email Id">
									</div>
								</div>
								
								<div class="col-md-4"> 
									<div class="form-group">
										<label for="name">Address</label>
										<textarea class="form-control" id="uaddr" name="uaddr" rows="2" placeholder="Address"></textarea>
									</div>
								</div>
								
							</div>
							<div class="hdg_bk"> Alerts </div>
							<div class="clr"></div>
							<p class="alert_txt"> Do you want to receive alerts :  </p>
							
							<div class="alerts_confirm fl">
								<div class="alert_check"> <input type="checkbox" id="turnchk" name="turnchk" value="1" checked /> 
								<div class="trun_txt"> Turn on </div>
								</div>
							</div>
							<div class="clr"></div>

							<div class="aler_lnks">
								<div class="row">
									<div class="col-md-4"> 
										<div class="form-group new_blk">
											<label for="name">Mobile</label>
											<div class="new_blk_add">
												<img src="<?php echo base_url();?>assets/images/add.png" alt="" title="">
											</div>
											<input type="text" class="form-control allownumericwithoutdecimal" id="mob_numb_new" name="mob_numb_new" placeholder="Mobile Number" value="" disabled />
											<ul class="new_mob_em_blk new_p"> </ul>
											<input type="hidden" id="hid_mob_d" name="hid_mob_d" class="multvals_d" />
										</div>
									</div>

									<div class="col-md-4"> 
										<div class="form-group new_blk">
											<label for="name">Email Id</label>
											<div class="new_blk_add new_m">
												<img src="<?php echo base_url();?>assets/images/add.png" alt="" title="">
											</div>
											<input type="email" class="form-control" id="email_id_new" name="email_id_new" placeholder="Email Id" disabled />  
											<ul class="new_mob_em_blk new_m"> </ul>
											<input type="hidden" id="hid_mail_d" name="hid_mail_d" class="multvals_d" />
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
										<label for="name">Aadhar </label>
										<input type="text" class="form-control allownumericwithoutdecimal" id="aadhar" name="aadhar" placeholder="Aadhar">   
									</div>
								</div>

								<div class="col-md-4"> 
									<div class="form-group">
										<label for="name">PAN </label>
										<input type="text" class="form-control" id="pan" name="pan" placeholder="PAN">   
									</div>
								</div>

								<div class="col-md-4"> 
									<div class="form-group">
										<label for="name">GST </label>
										<input type="text" class="form-control" id="gst" name="gst" placeholder="GST">   
									</div>
								</div>

							</div>
						</div>
					</div>
					<div class="col-md-12"> 
						<div class="pad_20 bg_w">

						<div class="hdg_bk">Bank Details(1) <a href="javascript:void(0)" title="" class="fr ad_bnk"> + Add Bank </a> </div>

						<div class="bank_list"> 
							<div class="bank_list_pos">
								<div class="bank_dtl_blk">
									<div class="row"> 

										<div class="col-md-6"> 
											<div class="form-group">
												<label for="name">Person Full Name</label>
												<input type="text" class="form-control" id="fname" name="fname[]" placeholder="Person Full Name">
											</div>
										</div>

										<div class="col-md-6"> 
											<div class="form-group">
												<label for="name">Account Number</label>
												<input type="text" class="form-control allownumericwithoutdecimal" id="ac_number" name="ac_number[]" placeholder="Account Number">
											</div>
										</div>

										<div class="col-md-6"> 
											<div class="form-group">
												<label for="name">Bank Name</label>
												<input type="text" class="form-control" id="bc_name" name="bc_name[]" placeholder="Bank Name">   
											</div>
										</div>

										<div class="col-md-6"> 
											<div class="form-group">
												<label for="name">IFSC</label>
												<input type="text" class="form-control" id="ifsc" name="ifsc[]" placeholder="IFSC">   
											</div>
										</div>
									
										<div class="col-md-6"> 
											<div class="form-group">
												<label for="name">Branch Name</label>
												<input type="text" class="form-control" id="branch_name" name="branch_name[]" placeholder="Branch Name">
											</div>
										</div>
										
									</div>
								</div>
							</div>
						</div>

						<div class="hdg_bk">Default Discounts </div>
						<div class="row">
							<div class="col-md-4"> 
							<div class="form-group">
							<label for="name">Feed(%)</label>
							<input type="text" class="form-control" id="feed" placeholder="Feed">   
							</div>
							</div>

							<div class="col-md-4"> 
								<div class="form-group">
									<label for="name">Medicines1 (%)<span class="deflt"> Default </span> 
									<a href="javascript:void(0)" title="" class="fr change_med" onclick="changemed('d1');"> Change </a>
									</label>
									<input type="text" class="form-control" id="med1" name="med1" placeholder="Medicines1" />
									<input type="hidden"  id="hidd1" name="hidd1" />
								</div>
							</div>

							<div class="col-md-4"> 
								<div class="form-group">
									<label for="name">Medicines2 (%)<span class="deflt"> Default </span> 
									<a href="javascript:void(0)" title="" class="fr change_med" onclick="changemed('d2');"> Change </a></label>
									<input type="text" class="form-control" id="med2" name="med2" placeholder="Medicines2" />
									<input type="hidden"  id="hidd2" name="hidd2" />									
								</div>
							</div>

							<div class="col-md-4"> 
								<div class="form-group">
									<label for="name">Medicines3 (%)<span class="deflt"> Default </span> 
									<a href="javascript:void(0)" title="" class="fr change_med" onclick="changemed('d3');"> Change </a></label>
									<input type="text" class="form-control" id="med3" name="med3" placeholder="Medicines3" />
									<input type="hidden"  id="hidd3" name="hidd3" />									
								</div>
							</div>
							
						</div> 

						<div class="hdg_bk">Documents upload </div>

						<div class="doc_up_lode"> 
							<div class="row"> 
								<div class="col-md-4"> 
									<div class="form-group">
										<label> Select Document Type </label>
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
									</div>
								</div>
								
								<div class="col-md-4"> 
									<div class="form-group">
										<label> Documents Received Date </label>
										<input type="date" id="recdate" name="recdate" placeholder="Documents Received Date" class="form-control"> 
									</div>
								</div>
								
								<div class="col-md-4"> 
									<div class="form-group">
										<label> Documents Return Date </label>
										<input type="date" id="retdate" name="retdate" placeholder="Documents Return Date" class="form-control"> 
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
								<label for="rem">Remarks</label>
								<textarea class="form-control" id="doc_rem" name="doc_rem" rows="3" placeholder="Remarks"></textarea> 
								</div>
								</div>
							</div>
						</div>

						<div class="hdg_bk">Outstanding Amount
						<select class="pos_neg" id="os_opt" name="os_opt"> 
								<option value="p"> + Additional Balance </option> 
								<option value="n"> - Negative Balance </option> 
							</select>
						</div>
						<div class="row">

							<div class="col-md-4"> 
							<div class="form-group">
							<label> Outstanding Amount </label>
							<input type="text" placeholder="Outstanding Amount" id="os_amt" name="os_amt" class="form-control allownumericwithoutdecimal"> 
							</div>
							</div>

							<div class="col-md-4"> 
							<div class="form-group">
							<label for="rem">Remarks</label>
							<textarea class="form-control" id="os_rem" name="os_rem" rows="3" placeholder="Remarks"></textarea> 
							</div>
							</div>

						</div>

						<div class="form-group"> <button type="submit" class="btn btn-primary sub_btn" onclick="frmsbmt('d');">Submit</button></div>
						</div>
					</div>
				</div>
				<br/>
			</form>
		<!-- Dealer Section End -->
		
		<!-- Farmer Section -->
			<div id="former">
				<div class="pad_20">
					<div class="hdg_bk"> Farmer Details

						<ul class="frmr_type"> 
							<li class="slc_far"> 
								<div class="form-check">
									<label class="form-check-label" for="sing_far">
									<input type="radio" class="form-check-input" id="sing_far" name="optradio" value="sing_far" checked> Single
									</label>
								</div>
							</li>

							<li> 
								<div class="form-check">
									<label class="form-check-label" for="par_far">
									<input type="radio" class="form-check-input" id="par_far" name="optradio" value="par_far"> Partnership
									</label>
								</div>
							</li>
						</ul>

					</div>
				</div>

				<!-- Multiple Farmer Start -->
				<form id="multiple" name="multiple" method="post" enctype="multipart/form-data" >
				
					<div class="row"> 
						<div class="col-md-12 lft_blk"> 
							<div class="pad_20">

								<div class="row">
								
									<div class="col-md-4"> 
										<div class="form-group">
											<label for="name">Firm Name</label>
											<input type="text" class="form-control" id="firm_name" name="firm_name" placeholder="Firm Name">   
										</div>
									</div>

									<div class="col-md-4"> 
										<div class="form-group">
											<label for="name">Owner Name</label>
											<input type="text" class="form-control" id="uname" name="uname" placeholder="Owner Name">
										</div>
									</div>

									<div class="col-md-4"> 
										<div class="form-group">
											<label for="name">Guarantor(C/O)</label>
											<input type="text" class="form-control" id="guaran" name="guaran" placeholder="Guarantor(C/O)">   
										</div>
									</div>

									<div class="col-md-4"> 
										<div class="form-group">
											<label for="name">Mobile</label>
											<input type="text" class="form-control allownumericwithoutdecimal" id="mob_numb" name="mob_numb" placeholder="Mobile Number" value="">   
										</div>
									</div>
									
									<div class="col-md-4"> 
										<div class="form-group">
											<label for="name">Email Id</label>
											<input type="email" class="form-control" id="email_id" name="email_id" placeholder="Email Id">  
										</div>
									</div>
									
									<div class="col-md-4"> 
										<div class="form-group">
											<label for="name">Address</label>
											<textarea   class="form-control" id="uaddr" name="uaddr" placeholder="Address" rows="2"></textarea> 
										</div>
									</div>

								</div>

								<div class="hdg_bk"> Alerts </div>
								<div class="clr"></div>
								<p class="alert_txt"> Do you want to receive alerts :  </p>
								<div class="alerts_confirm fl">
									<div class="alert_check"> <input type="checkbox" id="turnchk" name="turnchk" value="1" checked /> 
										<div class="trun_txt"> Turn on </div>
									</div>
								</div>
								<div class="clr"></div>

								<div class="aler_lnks">
									<div class="row">
										<div class="col-md-4"> 
											<div class="form-group new_blk">
												<label for="name">Mobile</label>
												<div class="new_blk_add"> <img src="<?php echo base_url();?>assets/images/add.png" alt="" title=""> </div>
												<input type="text" class="form-control allownumericwithoutdecimal" id="mob_numb_new" name="mob_numb_new" placeholder="Mobile Number" value="" disabled />
												<ul class="new_mob_em_blk new_p"> </ul>
												<input type="hidden" id="hid_mob_fm" name="hid_mob_fm" class="multvals_fm" />
											</div>
										</div>
										
										<div class="col-md-4"> 
											<div class="form-group new_blk">
												<label for="name">Email Id</label>
												<div class="new_blk_add new_m"> <img src="<?php echo base_url();?>assets/images/add.png" alt="" title=""> </div>
												<input type="email" class="form-control" id="email_id_new" name="email_id_new" placeholder="Email Id" disabled />  
												<ul class="new_mob_em_blk new_m"> </ul>
												<input type="hidden" id="hid_mail_fm" name="hid_mail_fm" class="multvals_fm" />
											</div>
										</div>										
									</div>
								</div>
								<div class="dft_mob_blk new_p">
									<div style="color: red; font-size: 14px;"> Please Fill Above Email and Phone Number </div>
								</div>

								<div class="hdg_bk">Accounts Information </div>

								<div class="row"> 
									<!-- <div class="col-md-4"> 
										<div class="form-group">
											<label for="name">Aadhar 
											</label>  
											<input type="text" class="form-control" id="pan" placeholder="Aadhar"> 
										</div>
									</div> -->

									<div class="col-md-4"> 
										<div class="form-group">
											<label for="name">PAN</label>
											<input type="text" class="form-control" id="pan" name="pan" placeholder="PAN">   
										</div>
									</div>

									<div class="col-md-4"> 
										<div class="form-group">
											<label for="name">GST</label>
											<input type="text" class="form-control" id="gst" name="gst" placeholder="GST">   
										</div>
									</div>
								</div>

								<div class="hdg_bk"> Partner details 
									<a href="javascript:void(0)" title="" class="fr ad_part"> + Add Partner </a>
								</div>
								<div class="new_part_lst">
									<div class="row"> 
										<div class="col-md-4"> 
											<div class="form-group">
												<label >Partner Name</label>  
												<input type="text" class="form-control" id="pname" name="pname[]" placeholder="Partner Name"> 
											</div>
										</div>

										<div class="col-md-4"> 
											<div class="form-group">
												<label for="name">Aadhar</label>
												<input type="text" class="form-control allownumericwithoutdecimal" id="paadhar" name="paadhar[]" placeholder="Aadhar">
											</div>
										</div>

										<div class="col-md-4"> 
											<div class="form-group">
												<label for="name">Phone Number </label>
												<input type="text" class="form-control allownumericwithoutdecimal" id="pmobile" name="pmobile[]" style="width: calc(100% - 40px);" placeholder="Phone Number">   
											</div>
										</div>
										
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12"> 
							<div class="pad_20 bg_w">

								<div class="hdg_bk">Bank Details(1) <a href="javascript:void(0)" title="" class="fr ad_bnk"> + Add Bank </a> </div>

								<div class="bank_list"> 
									<div class="bank_list_pos">
										<div class="bank_dtl_blk">
											<div class="row"> 

												<div class="col-md-6"> 
													<div class="form-group">
														<label for="name">Person Full Name</label>
														<input type="text" class="form-control" id="fname" name="fname[]" placeholder="Person Full Name">   
													</div>
												</div>

												<div class="col-md-6"> 
													<div class="form-group">
														<label for="name">Account Number</label>
														<input type="text" class="form-control allownumericwithoutdecimal" id="ac_number" name="ac_number[]" placeholder="Account Number">   
													</div>
												</div>

												<div class="col-md-6"> 
													<div class="form-group">
														<label for="name">Bank Name</label>
														<input type="text" class="form-control" id="bc_name" name="bc_name[]" placeholder="Bank Name">   
													</div>
												</div>

												<div class="col-md-6"> 
													<div class="form-group">
														<label for="name">IFSC</label>
														<input type="text" class="form-control" id="ifsc" name="ifsc[]" placeholder="IFSC">   
													</div>
												</div>

												<div class="col-md-6"> 
													<div class="form-group">
														<label for="name">Branch Name</label>
														<input type="text" class="form-control" id="branch_name" name="branch_name[]" placeholder="Branch Name">   
													</div>
												</div>
												
											</div>
										</div>
									</div>
								</div>

								<div class="hdg_bk">Crop Details (1) <a href="javascript:void(0)" title="" class="fr ad_crp"> + Add Crop </a></div>
								
								<div class="crp_list"> 
									<div class="crp_list_pos">
										<div class="crp_dtl_blk">
											<div class="row">
												<div class="col-md-6"> 
													<div class="form-group">
														<label for="name">Crop Location</label>
														<input type="text" class="form-control" id="crop_loc" name="crop_loc[]" placeholder="Crop Location">   
													</div>
												</div>

												<div class="col-md-6"> 
													<div class="form-group">
														<label for="name">Crop type</label>
														<input type="text" class="form-control" id="crop_type" name="crop_type[]" placeholder="Crop type">   
													</div>
												</div>

												<div class="col-md-6"> 
													<div class="form-group">
														<label for="name">Number of Acres</label>
														<input type="text" class="form-control allownumericwithoutdecimal" id="acres" name="acres[]" placeholder="Acres"> 
													</div>
												</div>
												
											</div>
										</div>
									</div>
								</div>

								<div class="hdg_bk">Default Discounts </div>
								
								<div class="row">
									<div class="col-md-4"> 
										<div class="form-group">
											<label for="name">Feed(%)</label>
											<input type="text" class="form-control" id="feed" name="feed" placeholder="Feed">   
										</div>
									</div>

									<div class="col-md-4"> 
										<div class="form-group">
											<label for="name">Medicines1 (%)<span class="deflt"> Default </span> 
											<a href="javascript:void(0)" title="" class="fr change_med" onclick="changemed('fs1');"> Change </a>
											</label>
											<input type="text" class="form-control" id="med1" name="med1" placeholder="Medicines1">
											<input type="hidden"  id="hidfs1" name="hidfs1" />											
										</div>
									</div>

									<div class="col-md-4"> 
										<div class="form-group">
											<label for="name">Medicines2 (%)<span class="deflt"> Default </span> 
											<a href="javascript:void(0)" title="" class="fr change_med" onclick="changemed('fs2');"> Change </a></label>
											<input type="text" class="form-control" id="med2" name="med2" placeholder="Medicines2"> 
											<input type="hidden"  id="hidfs2" name="hidfs2" />
										</div>
									</div>

									<div class="col-md-4"> 
										<div class="form-group">
											<label for="name">Medicines3 (%)<span class="deflt"> Default </span> 
											<a href="javascript:void(0)" title="" class="fr change_med" onclick="changemed('fs3');"> Change </a></label>
											<input type="text" class="form-control" id="med3" name="med3" placeholder="Medicines3">
											<input type="hidden"  id="hidfs3" name="hidfs3" />
										</div>
									</div>

									<div class="col-md-4"> 
										<div class="form-group">
										<label for="name">Rate of intrest</label>
										<input type="text" class="form-control" id="rate_of_int" name="rate_of_int" placeholder="Rate of intrest"> 
										</div>
									</div>

								</div> 

								<div class="hdg_bk">Documents upload </div>

								<div class="doc_up_lode"> 
									<div class="row"> 
										<div class="col-md-4"> 
											<div class="form-group">
												<label> Select Document Type </label>
												<select id="docs_upld2" name="docs_upld2" multiple="multiple">
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
											<div class="form-group">
												<label> Documents Received Date </label>
												
												<input type="date" id="recdate" name="recdate" placeholder="Documents Received Date" class="form-control"> 
											</div>
										</div>
										<div class="col-md-4"> 
											<div class="form-group">
												<label> Documents Return Date </label>
												<input type="date" id="retdate" name="retdate" placeholder="Documents Return Date" class="form-control"> 
											</div>
										</div>
										<!--     <div class="col-md-4"> 
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
												<label for="rem">Remarks</label>
												<textarea class="form-control" id="doc_rem" name="doc_rem" rows="3" placeholder="Remarks"></textarea> 
											</div>
										</div>
									</div>
								</div>

								<div class="hdg_bk">Outstanding Amount
									<select class="pos_neg" id="os_opt" name="os_opt" > 
										<option value="p"> + Additional Balance </option> 
										<option value="n"> - Negative Balance </option> 
									</select>
								</div>
								<div class="row">

									<div class="col-md-4"> 
										<div class="form-group">
											<label> Outstanding Amount </label>
											<input type="text" placeholder="Outstanding Amount" id="os_amt" name="os_amt" class="form-control allownumericwithoutdecimal"> 
										</div>
									</div>

									<div class="col-md-4"> 
										<div class="form-group">
											<label for="rem">Remarks</label>
											<textarea class="form-control" id="os_rem" name="os_rem" rows="3" placeholder="Remarks"></textarea> 
										</div>
									</div>

								</div>
								
								<div class="form-group"> <button type="submit" class="btn btn-primary sub_btn" onclick="frmsbmt('fm');">Submit</button></div>
							</div>
						</div>
					</div>
					<br/>
				</form>
				<!-- Multiple Farmer End -->

				<!-- single Farmer Start -->
				<form action="javascript:void(0)" id="single" name="single" method="post" enctype="multipart/form-data" >
				
					<div class="row"> 
						<div class="col-md-12 lft_blk"> 
							<div class="pad_20">
								<div class="row">

									<div class="col-md-4"> 
										<div class="form-group">
											<label for="name">Name</label>
											<input type="text" class="form-control" id="uname" name="uname" placeholder="Name">   
										</div>
									</div>

									<div class="col-md-4"> 
										<div class="form-group">
											<label for="name">Guarantor(C/O)</label>
											<input type="text" class="form-control" id="guaran" name="guaran" placeholder="Guarantor(C/O)">   
										</div>
									</div>

									<div class="col-md-4"> 
										<div class="form-group">
											<label for="name">Mobile</label>
											<input type="text" class="form-control allownumericwithoutdecimal" id="mob_numb" name="mob_numb" placeholder="Mobile Number" value="">   
										</div>
									</div>

									<div class="col-md-4"> 
										<div class="form-group">
											<label for="name">Email Id</label>
											<input type="email" class="form-control" id="email_id" name="email_id" placeholder="Email Id">
										</div>
									</div>
									
									<!--  <div class="col-md-4"> 
										<div class="form-group">
											<label for="name">Address</label>
											<input type="text" class="form-control" id="name" placeholder="Address">   
										</div>
									</div> -->
									
									<div class="col-md-4">
										<div class="form-group">
											<label for="exampleFormControlTextarea1">Address</label>
											<textarea class="form-control" id="uaddr" name="uaddr" rows="2" placeholder="Address"></textarea>
										</div>
									</div>
									
									<!-- <div class="col-md-4"> 
										<div class="form-group">
											<label for="name">Rate Of Intrest </label>
											<input type="text" class="form-control" id="rt_int" placeholder="Rate Of Intrest">   
										</div>
									</div> -->

								</div>
								
								<div class="hdg_bk"> Alerts </div>
							
								<div class="clr"></div>
								
								<p class="alert_txt"> Do you want to receive alerts :  </p>
								
								<div class="alerts_confirm fl">
									<div class="alert_check"> <input type="checkbox" id="turnchk" name="turnchk" value="1" checked > 
										<div class="trun_txt"> Turn on </div>
									</div>
								</div>
								
								<div class="clr"> </div>

								<div class="aler_lnks">
									<div class="row">
										<div class="col-md-4"> 
											<div class="form-group new_blk">
												<label for="name">Mobile</label>
												<div class="new_blk_add"> <img src="<?php echo base_url();?>assets/images/add.png" alt="" title=""> </div>
												<input type="text" class="form-control allownumericwithoutdecimal" id="mob_numb_new" name="mob_numb_new" placeholder="Mobile Number" value="" disabled />
												<ul class="new_mob_em_blk new_p"> </ul> 
												<input type="hidden" id="hid_mob_fs" name="hid_mob_fs" class="multvals_fs" />
											</div>
										</div>
										
										<div class="col-md-4"> 
											<div class="form-group new_blk">
												<label for="name">Email Id</label>
												<div class="new_blk_add new_m"> <img src="<?php echo base_url();?>assets/images/add.png" alt="" title=""> </div>
												<input type="email" class="form-control" id="email_id_new" name="email_id_new" placeholder="Email Id" disabled />  
												<ul class="new_mob_em_blk new_m"> </ul> 
												<input type="hidden" id="hid_mail_fs" name="hid_mail_fs" class="multvals_fs" />	
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
											<label for="name">Aadhar</label>  
											<input type="text" class="form-control allownumericwithoutdecimal" id="aadhar" name="aadhar" placeholder="Aadhar" /> 
										</div>
									</div>

									<div class="col-md-4"> 
										<div class="form-group">
											<label for="name">PAN</label>
											<input type="text" class="form-control" id="pan" name="pan" placeholder="PAN" />   
										</div>
									</div>

									<!-- <div class="col-md-4"> 
										<div class="form-group">
											<label for="name">GST</label>
											<input type="text" class="form-control" id="user_loc" placeholder="GST">   
										</div>
									</div> -->

								</div>
							</div>
						</div>
						
						<div class="col-md-12"> 
							<div class="pad_20 bg_w">

								<div class="hdg_bk">Bank Details(1) <a href="javascript:void(0)" title="" class="fr ad_bnk"> + Add Bank </a></div>

								<div class="bank_list"> 
									<div class="bank_list_pos">
										<div class="bank_dtl_blk">
											<div class="row"> 

												<div class="col-md-6"> 
													<div class="form-group">
														<label for="name">Person Full Name</label>
														<input type="text" class="form-control" id="fname" name="fname[]" placeholder="Person Full Name" />   
													</div>
												</div>

												<div class="col-md-6"> 
													<div class="form-group">
														<label for="name">Account Number</label>
														<input type="text" class="form-control allownumericwithoutdecimal" id="ac_number" name="ac_number[]" placeholder="Account Number" />   
													</div>
												</div>

												<div class="col-md-6"> 
													<div class="form-group">
														<label for="name">Bank Name</label>
														<input type="text" class="form-control" id="bc_name" name="bc_name[]" placeholder="Bank Name" />  
													</div>
												</div>

												<div class="col-md-6"> 
													<div class="form-group">
														<label for="name">IFSC</label>
														<input type="text" class="form-control" id="ifsc" name="ifsc[]" placeholder="IFSC" />
													</div>
												</div>

												<div class="col-md-6"> 
													<div class="form-group">
														<label for="name">Branch Name</label>
														<input type="text" class="form-control" id="branch_name" name="branch_name[]" placeholder="Branch Name" />   
													</div>
												</div>
												
											</div>
										</div>
									</div>
								</div>

								<div class="hdg_bk">Crop Details (1) <a href="javascript:void(0)" title="" class="fr ad_crp"> + Add Crop </a></div>
							
								<div class="crp_list"> 
									<div class="crp_list_pos">
										<div class="crp_dtl_blk">
											<div class="row">
											
												<div class="col-md-6"> 
													<div class="form-group">
														<label for="name">Crop Location</label>
														<input type="text" class="form-control" id="crop_loc" name="crop_loc[]" placeholder="Crop Location">   
													</div>
												</div>

												<div class="col-md-6"> 
													<div class="form-group">
														<label for="name">Crop type</label>
														<input type="text" class="form-control" id="crop_type" name="crop_type[]" placeholder="Crop type">
													</div>
												</div>

												<div class="col-md-6"> 
													<div class="form-group">
														<label for="name">Number of Acres</label>
														<input type="text" class="form-control" id="acres" name="acres[]" placeholder="Acres">   
													</div>
												</div>
												
											</div>
										</div>
									</div>
								</div>

								<div class="hdg_bk">Default Discounts </div>
								
								<div class="row">
								
									<div class="col-md-4"> 
										<div class="form-group">
											<label for="name">Feed(%)</label>
											<input type="text" class="form-control" id="feed" name="feed" placeholder="Feed">   
										</div>
									</div>

									<div class="col-md-4"> 
										<div class="form-group">
											<label for="name">Medicines1 (%)<span class="deflt"> Default </span> 
											<a href="javascript:void(0)" title="" class="fr change_med" onclick="changemed('fm1');"> Change </a>
											</label>
											<input type="text" class="form-control" id="med1" name="med1" placeholder="Medicines1">
											<input type="hidden" id="hidfm1" name="hidfm1" >
										</div>
									</div>

									<div class="col-md-4"> 
										<div class="form-group">
											<label for="name">Medicines2 (%)<span class="deflt"> Default </span> 
											<a href="javascript:void(0)" title="" class="fr change_med" onclick="changemed('fm2');"> Change </a></label>
											<input type="text" class="form-control" id="med2" name="med2" placeholder="Medicines2">
											<input type="hidden" id="hidfm2" name="hidfm2" >
										</div>
									</div>

									<div class="col-md-4"> 
										<div class="form-group">
											<label for="name">Medicines3 (%)<span class="deflt"> Default </span> 
											<a href="javascript:void(0)" title="" class="fr change_med" onclick="changemed('fm3');"> Change </a></label>
											<input type="text" class="form-control" id="med3" name="med3" placeholder="Medicines3">
											<input type="hidden" id="hidfm3" name="hidfm3" >
										</div>
									</div>

									<div class="col-md-4"> 
										<div class="form-group">
											<label for="name">Rate of intrest</label>
											<input type="text" class="form-control" id="rate_of_int" name="rate_of_int" placeholder="Rate of intrest">
										</div>
									</div>
									
								</div> 

								<div class="hdg_bk">Documents upload </div>

								<div class="doc_up_lode"> 
									<div class="row"> 
										<div class="col-md-4"> 
											<div class="form-group">
												<label> Select Document Type </label>
												<select id="docs_upld3" name="docs_upld3" multiple="multiple">
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
											<div class="form-group">
												<label> Documents Received Date </label>
												<input placeholder="Documents Received Date" type="date"  id="recdate" name="recdate" class="form-control">
											</div>
										</div>
										<div class="col-md-4"> 
											<div class="form-group">
												<label> Documents Return Date </label>
												<input type="date" id="retdate" name="retdate" placeholder="Documents Return Date" class="form-control"> 
											</div>
										</div>
										<!--  <div class="col-md-4"> 
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
												<label for="rem">Remarks</label>
												<textarea class="form-control" id="doc_rem" name="doc_rem" rows="3" placeholder="Remarks"></textarea> 
											</div>
										</div>
									</div>
								</div>

								<div class="hdg_bk">Outstanding Amount
									<select class="pos_neg" id="os_opt" name="os_opt"> 
										<option value="p" selected > + Additional Balance </option> 
										<option value="n"> - Negative Balance </option> 
									</select>
								</div>
								
								<div class="row">

									<div class="col-md-4"> 
										<div class="form-group">
											<label> Outstanding Amount </label>
											<input type="text" id="os_amt" name="os_amt" placeholder="Outstanding Amount" class="form-control allownumericwithoutdecimal"> 
										</div>
									</div>

									<div class="col-md-4"> 
										<div class="form-group">
											<label for="rem">Remarks</label>
											<textarea class="form-control" id="os_rem" name="os_rem" rows="3" placeholder="Remarks"></textarea> 
										</div>
									</div>

								</div>

								<div class="form-group"> <button class="btn btn-primary sub_btn" onclick="frmsbmt('fs');" >Submit</button></div>
							
							</div>
						</div>
					</div>
					<br/>
				</form>
				<!-- Singel Farmer End -->
			</div>
		<!-- Farmer Section End -->
			<input type="hidden" id="hid_type" name="hid_type" value="fs" />
			<input type="hidden" id="hid_cnfsbmt" name="hid_cnfsbmt" value="0" />
			<input type="hidden" id="hid_medval" name="hid_medval" value="" />
			
			<!-- for medicines -->
			<input type="hidden" id="hidm1" name="hidm1" value="" />
			<input type="hidden" id="hidm2" name="hidm2" value="" />
			<input type="hidden" id="hidm3" name="hidm3" value="" />
		</div>
	</div>
</div>

<script type="text/javascript">
var url = '<?php echo base_url()?>';

$(".allownumericwithoutdecimal").on("keypress keyup blur",function (event) {    
     $(this).val($(this).val().replace(/[^\d].+/, ""));
      if ((event.which < 48 || event.which > 57)) {
          event.preventDefault();
      }
});

function changemed(mval)
{
	$("#hid_medval").val(mval);
	//alert(mval);
	var lastChar = mval[mval.length -1];
	var	hidmedval = $("#hidm"+lastChar).val();
	var	newhidmedval = "";
	$("#medsection").html("-"+lastChar);
	
	var allboxes = $(".al_brands input:checkbox").map(function(){
		  return $(this).val();
		}).get();
	
	var allchecks = $(".al_brands input:checkbox:checked").map(function(){
	  return $(this).val();
	}).get();
	
	var	newhidmedval = $("#hidm"+lastChar).val();
	
	var names_arr = newhidmedval.split(',');
	
	$.each(names_arr, function( index, value ) {
	  //alert( index + ": " + value );
	  //$('#'+value).fadeIn('slow');
	  $('#'+value).show();
	});
	
	difference = allchecks.filter(a => !names_arr.includes(a));
	console.log(difference);
	$.each(difference, function( index, value ) {
	  //alert( index + ": " + value );
	  //$('#'+value).fadeOut('slow');
	  $('#'+value).hide();
	});
}

function changemed_old(mval)
{
	$("#hid_medval").val(mval);
	//alert(mval);
	var	hidmedval = $("#hid"+mval).val();
	var	newhidmedval = "";
	
	var allboxes = $(".al_brands input:checkbox").map(function(){
		  return $(this).val();
		}).get();
	
	var allchecks = $(".al_brands input:checkbox:checked").map(function(){
	  return $(this).val();
	}).get();
	console.log(allchecks);
	var	newhidmedval = $("#hid"+mval).val();	
	
	//console.log(hidmedval);
	var names_arr = newhidmedval.split(',');
	console.log(names_arr);
	
	$.each(names_arr, function( index, value ) {
	  //alert( index + ": " + value );
	  //$('#'+value).fadeIn('slow');
	  $('#'+value).show();
	});
	
	difference = allchecks.filter(a => !names_arr.includes(a));
	//console.log(difference);
	$.each(difference, function( index, value ) {
	  //alert( index + ": " + value );
	  //$('#'+value).fadeOut('slow');
	  $('#'+value).hide();
	});
}



$('#docs_upld, #docs_upld2').on('change',function() {
  
	if($(this).val() == 'Aadhar'){
	  
	}else if($(this).val() == 'Pan'){
	 $('.slct_docs').append(pan.join("\n"));
	}else if($(this).val() == 'Check'){
	 $('.slct_docs').append(check.join("\n"));
	}
			  
});    

$('.new_blk_add').click(function(){
	
	var value = $(this).siblings('.form-control').val();	
	
	var hidtype = $("#hid_type").val();
	
		
	var new_cont = ['<li class="new_cont"> ',
		  value,
		   '<span class="cls_itm">', 
		  '<img src="../../assets/images/close_btn.png" /> </span>',
	'</li>'
	];
	if($(this).siblings('.form-control').val() != '') {
		
		var exists = false;
		//var multi_val = $("#hid_mob_"+hidtype).val();
		
		var hidval = $(this).siblings('.multvals_'+hidtype).val().trim();		
		
		$.map(hidval.split(','), function(elementOfArray, indexInArray) {
			 if (elementOfArray == value) {		   
			   exists = true;
			 }
		});	
		
		//alert(exists);
		
		if(!exists)
		{
			$(this).siblings('.new_mob_em_blk').append(new_cont.join("\n"));
			if(hidval != ""){
				$(this).siblings('.multvals_'+hidtype).val(hidval+','+value);
			}else{
				$(this).siblings('.multvals_'+hidtype).val(value);
			}
		}		
	}
	$(this).siblings('.form-control').val('');
	
	$('.cls_itm').click(function(){
		
		var remval = $(this).parent().text().trim();		
		var hidval = $(this).parent().parent().siblings('.multvals_'+hidtype).val().trim();		
		var arry = hidval.split(',');
		
		r = $.grep(arry, function(rval) {
			
			  return rval != remval;			  
		});
		
		$(this).parent().parent().siblings('.multvals_'+hidtype).val(r.toString());
		$(this).parent().remove();
	});
});    

$(document).ready(function(){
	
	$.validator.addMethod("aadhar_regexp", function(value, element)
    {
       return this.optional(element) || /^\d{4}\s\d{4}\s\d{4}$/.test(value.toUpperCase());
    }, "Invalid Aadhar Number");
	
	$.validator.addMethod("pan_regexp", function(value, element)
    {
        //return this.optional(element) || /^[A-Z]{5}\d{4}[A-Z]{1}$/.test(value);
        return this.optional(element) || /([A-Z]){5}([0-9]){4}([A-Z]){1}$/.test(value.toUpperCase());
    }, "Invalid Pan Number");
	
	
	/* $('#recdate').datepicker({
		format: "yy-mm-dd",
		startDate: new Date('2019-12-5'),
		endDate: new Date('2020-7-12')
	  }); */
	/* $('#recdate').datepicker({
		format: "dd/mm/yyyy",
	  }); */
	$('#docs_upld1').multiselect();
	$('#docs_upld2').multiselect();
	$('#docs_upld3').multiselect();
	$('#docs_upld4').multiselect();
	
	var aadar = ['<div class="col-md-4 aad_blk"> ',
				'<div class="form-group">',
				'<label> Upload Your Aadhar</label>',
				'<input type="file" id="aadhar_upload" name="aadhar_upload[]" required multiple />',
				'</div>',
				'</div>'
			];
	var pan = ['<div class="col-md-4 pan_blk"> ',
				'<div class="form-group">',
				'<label> Upload Your PAN</label>',
				'<input type="file" id="pan_upload" name="pan_upload[]" required multiple />',
				'</div>',
				'</div>'
			];

	var check = ['<div class="col-md-4 check_blk"> ',
				'<div class="form-group">',
				'<label> Upload Your Cheque</label>',
				'<input type="file" id="check_upload" name="check_upload[]" required multiple />',
				'</div>',
				'</div>'
			];

	var gst = ['<div class="col-md-4 gst"> ',
				'<div class="form-group">',
				'<label> Upload Your GST</label>',
				'<input type="file" id="gst_upload" name="gst_upload[]" required multiple />',
				'</div>',
				'</div>'
			];
	var partner_s  = ['<div class="col-md-4 partner_s"> ',
				'<div class="form-group">',
				'<label> Upload Your Partnership deed</label>',
				'<input type="file" id="partner_s" name="partner_s[]" required multiple />',
				'</div>',
				'</div>'
			];
			
	var promissory  = ['<div class="col-md-4 promissory"> ',
				'<div class="form-group">',
				'<label> Upload Your Promissory note</label>',
				'<input type="file" id="promissory" name="promissory[]" required multiple />',
				'</div>',
				'</div>'
			];
				
	var gp_doc  = ['<div class="col-md-4 check_blk gp_doc"> ',
				'<div class="form-group">',
				'<label> Upload Your GP document</label>',
				'<input type="file" id="gp_doc" name="gp_doc[]" required multiple />',
				'</div>',
				'</div>'
			];
	var stamp  = ['<div class="col-md-4 stamp"> ',
				'<div class="form-group">',
				'<label> Upload Your Stamp document </label>',
				'<input type="file" id="stamp" name="stamp[]" required multiple />',
				'</div>',
				'</div>'
			];
	$('.aadhar1, .aa_up').click(function(){
		
		if($(this).find('input').is(":checked")){
		   $(this).parent().parent().parent().parent().parent().parent().parent().parent().siblings('.slct_docs').append(aadar.join("\n"));
		}
		else if($(this).find('input').is(":not(:checked)")){
			$('.aad_blk').remove();
		}
		
	});

	$('.gst1').click(function(){
		if($(this).find('input').is(":checked")){
		   // alert('65');
		   $(this).parent().parent().parent().parent().parent().parent().parent().parent().siblings('.slct_docs').append(gst.join("\n"));
		}
		else if($(this).find('input').is(":not(:checked)")){
		 
			$('.gst').remove();
		}        
	});

	$('.promissory1').click(function(){
		if($(this).find('input').is(":checked")){
		   $(this).parent().parent().parent().parent().parent().parent().parent().parent().siblings('.slct_docs').append(promissory.join("\n"));
		}
		else if($(this).find('input').is(":not(:checked)")){
			$('.promissory').remove();
		}        
	});

	$('.gp1').click(function(){
		if($(this).find('input').is(":checked")){
		   $(this).parent().parent().parent().parent().parent().parent().parent().parent().siblings('.slct_docs').append(gp_doc.join("\n"));
		}
		else if($(this).find('input').is(":not(:checked)")){
			$('.gp_doc').remove();
		}        
	});

	$('.stamp1').click(function(){
		if($(this).find('input').is(":checked")){
		   $(this).parent().parent().parent().parent().parent().parent().parent().parent().siblings('.slct_docs').append(stamp.join("\n"));
		}
		else if($(this).find('input').is(":not(:checked)")){
			$('.stamp').remove();
		}        
	});

	 $('.partnerdeed1').click(function(){
		if($(this).find('input').is(":checked")){
		   $(this).parent().parent().parent().parent().parent().parent().parent().parent().siblings('.slct_docs').append(partner_s.join("\n"));
		}
		else if($(this).find('input').is(":not(:checked)")){
			$('.partner_s').remove();
		}        
	});

	$('.pan1, .pan_up').click(function(){
		if($(this).find('input').is(":checked")){
		   $(this).parent().parent().parent().parent().parent().parent().parent().parent().siblings('.slct_docs').append(pan.join("\n"));
		}
		else if($(this).find('input').is(":not(:checked)")){
			$('.pan_blk').remove();
		}        
	});

	$('.cheque1, .chc_up').click(function(){
		if($(this).find('input').is(":checked")){
		   $(this).parent().parent().parent().parent().parent().parent().parent().parent().siblings('.slct_docs').append(check.join("\n"));
		}
		else if($(this).find('input').is(":not(:checked)")){
			$('.check_blk').remove();
		}        
	});
	
	$('.medsub').click(function(){
	
		
		sval= $("#medsection").html();
		var lastChar = sval[sval.length -1];
		if($("#hidm"+lastChar).val() == ""){
			
			//$('.side_popup').addClass('opn_slide');
			$('#flsh_msg_med').html(' <div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Please select atleast one brand!</div>');
		}else{
			$('.alpha_blk').hide();
			$('.side_popup').removeClass('opn_slide');
			$('#flsh_msg_med').html('');
		}
	});

	var part = [

			  '<div class="row dtl_par">', 
				  '<div class="col-md-4">', 
					'<div class="form-group">',
					   '<label >Partner Name </label>',  
					   '<input type="text" id="pname" name="pname[]" class="form-control" placeholder="Partner Name">',
				  '</div>',
				  '</div>',
				  '<div class="col-md-4">', 
					'<div class="form-group">',
					   '<label for="name">Aadhar</label>',
					'<input type="text" id="paadhar" name="paadhar[]" class="form-control allownumericwithoutdecimal" placeholder="Aadhar"> ',  
				 '</div>',
				  '</div>',

				  '<div class="col-md-4">', 
				   '<div class="form-group">',
					   '<label for="name">Phone Number </label>',
					'<input type="text" class="form-control" id="pmobile" name="pmobile[]" placeholder="Phone Number" style="width: calc(100% - 40px); float:left;"> <span class="cl_part"><img src="../../assets/images/close_btn.png" width="17"/></span>',   
				  '</div>',
				  '</div>',
			  '</div>'
			  ];
	$('.ad_part').click(function(){

	  $(this).parent().siblings('.new_part_lst').append(part.join("\n"));
	  $('.cl_part').click(function(){
		$(this).parent().parent().parent('.dtl_par').remove();
	  })
			  
	});

	$('.frmr_type .form-check').click(function(){

		if($(this).find('input').val() == 'sing_far' ){
			$('#multiple').hide();
			 $('#single').show();
			 $('#par_far').parent().parent().parent().removeClass('slc_far');
			 $('#sing_far').parent().parent().parent().addClass('slc_far');
			 $('#hid_type').val('fs');
			
		} else {
		  $('#multiple').show();
			 $('#single').hide();
			$('#sing_far').parent().parent().parent().removeClass('slc_far');
			 $('#par_far').parent().parent().parent().addClass('slc_far');
			 $('#hid_type').val('fm');
		}
	});

	$( "#mob_numb, #email_id" ).focusout(function() {

		var hidtype = $("#hid_type").val();
		var hidmob = $('#hid_mob_'+hidtype).val().trim().split(',');
		var hidmail= $('#hid_mail_'+hidtype).val().trim().split(',');
		
		var email = $(this).parent().parent().parent().find('#email_id').val();
		var phone = $(this).parent().parent().parent().find('#mob_numb').val();
		
		if(email && phone != ''){

			$('.dft_mob_blk').empty();
			$('.aler_lnks').removeAttr('style');
			var new_email = ['<li class="new_cont defa_c"> ',
							  email, ',',
						'</li>'
					  ];
			var new_phone = ['<li class="new_cont defa_c"> ',
							  phone, ',',
						'</li>'
					  ];
			/* $(this).parent().parent().parent().siblings('.aler_lnks').find('.new_mob_em_blk.new_m').append(new_email.join("\n"));			$(this).parent().parent().parent().siblings('.aler_lnks').find('.new_mob_em_blk.new_p').append(new_phone.join("\n")); */
					
			if(hidmob.length > 1)
			{
				$(this).parent().parent().parent().siblings('.aler_lnks').find('.new_mob_em_blk.new_m li.defa_c').html(new_email.join("\n"));
			}else{
				$(this).parent().parent().parent().siblings('.aler_lnks').find('.new_mob_em_blk.new_m').html(new_email.join("\n"));
			}
			if(hidmail.length > 1)
			{
				$(this).parent().parent().parent().siblings('.aler_lnks').find('.new_mob_em_blk.new_p li.defa_c').html(new_phone.join("\n"));
			}else{
				$(this).parent().parent().parent().siblings('.aler_lnks').find('.new_mob_em_blk.new_p').html(new_phone.join("\n"));
			}
			
			$(this).parent().parent().parent().siblings('.aler_lnks').find('.form-control').removeAttr('disabled', 'true');
			
			hidmob[0] = phone; hidmail[0] = email;
			$('#hid_mob_'+hidtype).val(hidmob.join());
			$('#hid_mail_'+hidtype).val(hidmail.join());
			
			
		}else {
			
			$(this).parent().parent().parent().siblings('.aler_lnks').find('.form-control').prop("disabled", true);
			$('.dft_mob_blk').empty();  

			$(this).parent().parent().parent().siblings('.aler_lnks').find('.new_mob_em_blk.new_m li').remove();
			$(this).parent().parent().parent().siblings('.aler_lnks').find('.new_mob_em_blk.new_p li').remove();

			$('.aler_lnks').removeAttr('style');
			var empt_txt = [ '<div style="color: red; font-size: 14px;"> Please Fill Above Email and Phone Number </div>']
			$(this).parent().parent().parent().siblings('.dft_mob_blk').append(empt_txt.join("\n"));
		}  
	});

	$('.alert_check').click(function(){
		
	  $(this).toggleClass('check_ale');
	  
		if($(this).find('input').is(":not(:checked)")){
			
			$(this).find('input').val(0);
			
			$(this).parent().siblings('.aler_lnks').hide();            
			$(this).children('.trun_txt').text("Turn Off");		 
			$(this).parent().siblings('.dft_mob_blk').text('Your alerts are turned off');               
		}
		else if($(this).find('input').is(":checked")){
			
			$(this).find('input').val(1);
			
		  $(this).parent().siblings('.aler_lnks').show();
		  $(this).children('.trun_txt').text("Turn On");
		  $(this).parent().siblings('.dft_mob_blk').empty();
		} 
		
	});

	$('.change_med').click(function(){		
	
		$('#flsh_msg_med').html('');		
		$('.alpha_blk').show();
		$('.side_popup').addClass('opn_slide');

		$('.alpha_blk, .cls_pp_sd').click(function(){
			 $('.alpha_blk').hide();
			$('.side_popup').removeClass('opn_slide');
		});
	});

	$('.prod_bl').click(function(){
		if($(this).find('input').is(":checked")){
		   $(this).addClass('slc_prdt');
		}
		else if($(this).find('input').is(":not(:checked)")){
			$(this).removeClass('slc_prdt');
		}        
	});
	
	/* $('.sub_btn').click(function(){
		$('.alpha_blk2, .full_wth_popup').show();
		$('.edt_user').click(function(){
			$('.alpha_blk2, .full_wth_popup').hide();
		});
	}); */
	
	/* $('.edt_user').click(function(e){
		
		e.preventDefault();
		$('.alpha_blk2, .full_wth_popup').hide();
	}); */
	
	$('.edt_user').click(function(){					
						
		$('.alpha_blk2, .full_wth_popup').hide();
		
	});
	
	$('#cnf_sbmt').click(function(){
		
		var formval = $("#hid_type").val(); var myForm = upload_doctype = "";
		
		if(formval == "fs"){ myForm = document.getElementById('single'); upload_doctype = $("#docs_upld3").val(); }
		else if(formval == "fm"){ myForm = document.getElementById('multiple'); upload_doctype = $("#docs_upld2").val(); }
		else if(formval == "d"){ myForm = document.getElementById('dealer'); upload_doctype = $("#docs_upld1").val(); }
		else if(formval == "nf"){ myForm = document.getElementById('non_frm'); upload_doctype = $("#docs_upld4").val(); }	
		
		var hidm1 = $("#hidm1").val(); var hidm2 = $("#hidm2").val(); var hidm3 = $("#hidm3").val();
					
		formData = new FormData(myForm);
		formData.append('hidm1', hidm1);
		formData.append('hidm2', hidm2);
		formData.append('hidm3', hidm3);
		formData.append('utype', formval);
		formData.append('upload_doc', upload_doctype);

		$('.alpha_blk2, .full_wth_popup').hide();
		cnfsbmt = 1;	
		if(cnfsbmt == 1){
			
			$.ajax({
				url: url+"admin/users/adduser",
				data: formData,
				type:'POST',
				contentType: false,
				processData: false,
				enctype: 'multipart/form-data',
				datatype:'json',
				success : function(response)
				{
					//alert(response);
					res= JSON.parse(response);
					//window.test = res;
					if(res.status == 'error')
					{
						$("#hid_cnfsbmt").val(0);
						//$('#flsh_msg').html(' <div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> '+res.message+'</div>');
						new PNotify({
							title: 'Error',
							text: 'Something went wrong, try again!',
							type: 'failure',
							shadow: true
						});
					}
					else
					{
						$("#hid_cnfsbmt").val(0);
						//window.location = url+"admin/users";
						//$('#flsh_msg').html(' <div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> User created successfully!</div>');
						setTimeout(function(){
							location = url+"admin/users/create"
						  },5000);
						new PNotify({
						  title: 'Success',
						  text: 'User created successfully!',
						  type: 'success',
						  shadow: true
						});								
						$("#single")[0].reset();
					}
				}
			});
			return false;
		}
	});

});
//Form submit with validation	
			
var hidtype = hidfrm = hidm1 = hidm2 = hidm3 = multi_mobiles = multi_emails = upload_doctype = "";
var pname = paadhar = pmobile = [];
var postdata = "";	
var bank_fname = bank_acnum = bank_bcname = bank_ifsc = bank_branch = [];
var crop_loc = crop_type = crop_acres = [];	
var thisform = "";

function frmsbmt(formval){
		
	if(formval == "fs"){ thisform = "#single";}else if(formval == "fm"){ thisform = "#multiple"; }
	else if(formval == "d"){ thisform = "#dealer"; }else if(formval == "nf"){ thisform = "#non_frm"; }
		
	$(thisform).click(function() {		

		hidtype = $("#hid_type").val();
		 
		var clikedForm = $(this);
		
		//alert($("#single").find("[name='uname']").val());

		var uname = clikedForm.find("[name='uname']").val();
		var firm_name = clikedForm.find("[name='firm_name']").val();
		var guaran = clikedForm.find("[name='guaran']").val();
		var mobile = clikedForm.find("[name='mob_numb']").val();
		var email_id = clikedForm.find("[name='email_id']").val();		
		var uaddr = clikedForm.find("[name='uaddr']").val();
		
		var aadhar = clikedForm.find("[name='aadhar']").val();
		var pan = clikedForm.find("[name='pan']").val();
		var gst = clikedForm.find("[name='gst']").val();
		
		var feed = clikedForm.find("[name='feed']").val();
		var med1 = clikedForm.find("[name='med1']").val();
		var med2 = clikedForm.find("[name='med2']").val();
		var med3 = clikedForm.find("[name='med3']").val();
		var roi = clikedForm.find("[name='rate_of_int']").val();
		
		var os_type = clikedForm.find("[name='os_opt']").val();
		var os_amt = clikedForm.find("[name='os_amt']").val();
		var os_rem = clikedForm.find("[name='os_rem']").val();
		
		//if brands select
		hidm1 = $("#hidm1").val();
		hidm2 = $("#hidm2").val();
		hidm3 = $("#hidm3").val();
		
		//Documents			
		
		var turnchk = clikedForm.find("[name='turnchk']").val();
		if(turnchk == 1){
			multi_mobiles = $("#hid_mob_"+hidtype).val();
			multi_emails = $("#hid_mail_"+hidtype).val();
		}else{
			/* multi_mobiles = $("#hid_mob_"+hidtype).val('');
			multi_emails = $("#hid_mail_"+hidtype).val(''); */			
			multi_mobiles = '';
			multi_emails = '';
		}
		
		pname = clikedForm.find("[id='pname']").map(function(){return $(this).val();}).get();
		paadhar = clikedForm.find("[id='paadhar']").map(function(){return $(this).val();}).get();
		pmobile = clikedForm.find("[id='pmobile']").map(function(){return $(this).val();}).get();
		
		// Bank and Crop Details
		
		bank_fname = clikedForm.find("[id='fname']").map(function(){return $(this).val();}).get();
		bank_acnum = clikedForm.find("[id='ac_number']").map(function(){return $(this).val();}).get();
		bank_bcname = clikedForm.find("[id='bc_name']").map(function(){return $(this).val();}).get();
		bank_ifsc = clikedForm.find("[id='ifsc']").map(function(){return $(this).val();}).get();
		bank_branch = clikedForm.find("[id='branch_name']").map(function(){return $(this).val();}).get();			
		
		crop_loc = clikedForm.find("[id='crop_loc']").map(function(){return $(this).val();}).get();
		crop_type = clikedForm.find("[id='crop_type']").map(function(){return $(this).val();}).get();
		crop_acres = clikedForm.find("[id='acres']").map(function(){return $(this).val();}).get();				
		
		if(hidtype == 'nf'){			
			
			hidfrm = "#non_frm";
			upload_doctype = $("#docs_upld4").val();
			$('.head_title').html('User Details (Non-Farmer)');
			$('.vaadhar_block').show(); $('.vpan_block').show(); $('.vgst_block').show();
			$('.vpartner_block').hide(); $('.view_partners_labels').hide(); $('.view_partners').hide();
		}
		else if(hidtype == 'd'){
			
			hidfrm = "#dealer";
			upload_doctype = $("#docs_upld1").val();
			$('.head_title').html('User Details (Dealer)');
			$('.vaadhar_block').show(); $('.vpan_block').show(); $('.vgst_block').show();
			$('.vpartner_block').hide(); $('.view_partners_labels').hide(); $('.view_partners').hide();
		}
		else if(hidtype == 'fs'){ 
		
			hidfrm = "#single";
			upload_doctype = $("#docs_upld3").val();
			$('.head_title').html('User Details (Farmer - Single)');
			$('.vaadhar_block').show(); $('.vpan_block').show(); $('.vgst_block').hide();
			$('.vpartner_block').hide(); $('.view_partners_labels').hide(); $('.view_partners').hide();
			
		}else if(hidtype == 'fm'){ 
		
			hidfrm = "#multiple";
			upload_doctype = $("#docs_upld2").val();
			$('.head_title').html('User Details (Farmer - Multiple)');
			$('.vaadhar_block').hide(); $('.vpan_block').show(); $('.vgst_block').show();
			$('.vpartner_block').show(); $('.view_partners_labels').show(); $('.view_partners').show();
		}

		var receive_dt = clikedForm.find("[name='recdate']").val();
		var return_dt = clikedForm.find("[name='retdate']").val();		
		var doc_rem = clikedForm.find("[name='doc_rem']").val();		
		
		//postdata = {utype:hidtype, uname:uname, email_id:email_id, firm_name:firm_name, guaran:guaran, mobile:mobile, notifychk:turnchk, alert_mobile:multi_mobiles, alert_email:multi_emails, uaddr:uaddr, aadhar:aadhar, pan:pan, gst:gst, pname: pname, paadhar:paadhar, pmobile:pmobile, fname:bank_fname, bank_acnum:bank_acnum, bank_name:bank_bcname, bank_ifsc:bank_ifsc, bank_branch:bank_branch, crop_loc:crop_loc, crop_type:crop_type, crop_acres:crop_acres, feed:feed, med1:med1, med2:med2, med3:med3, roi:roi, upload_doc:upload_doctype, receive_dt:receive_dt, return_dt:return_dt, doc_rem:doc_rem, os_type: os_type, os_amt:os_amt, os_rem:os_rem, hidm1:hidm1, hidm2:hidm2, hidm3:hidm3};	
		
		// view data in popup before submit
		
		if(turnchk == 1){ var alerchk = "Yes"; $(".view_alerts").show();}else{ var alerchk = "No"; $(".view_alerts").hide();}
		if(os_type == 'p'){ var vosamt = "+"+os_amt;}else{ var vosamt = "-"+os_amt;}
		$("#vuname").text(uname); $("#vgname").text(guaran); $("#vmobile").text(mobile); $("#vemailid").text(email_id);
		$("#vaddr").text(uaddr); $("#valert").text(alerchk); $("#valertmob").text(multi_mobiles); $("#valertmail").text(multi_emails); $("#vaadhar").text(aadhar); $("#vpan").text(pan); $("#vfeed").text(feed); $("#vmed1").text(med1); $("#vmed2").text(med2); $("#vmed3").text(med3); $("#vroi").text(roi); $("#vrcdate").text(receive_dt); $("#vrtdate").text(return_dt); $("#vdocrem").text(doc_rem);$(".vosamt").text(vosamt); $("#vosrem").text(os_rem);$("#vgst").text(gst);
		var bankcount = cropcount = partnercount = false;
		if(bank_fname[0] == ""){ $("#bankcount").text('(0)');}else{ $("#bankcount").text('('+bank_fname.length+')');bankcount = true; }
		if(crop_loc[0] == ""){ $("#cropcount").text('(0)');}else{ $("#cropcount").text('('+crop_loc.length+')'); cropcount = true; }
		if(pname[0] == ""){ $("#partnercount").text('(0)');}else{ $("#partnercount").text('('+pname.length+')'); partnercount = true; }
		var bankstr = cropstr = partnerstr = vdocs = "";
		var upldocs = [];
		if(bankcount == true){ 
			for(b = 0; b < bank_fname.length; b++)
			{
				bankstr += '<div class="col-md-3"><div class="form-group"><span id="vperson">'+bank_fname[b]+'</span></div></div><div class="col-md-3"><div class="form-group"><span id="vacnum">'+bank_acnum[b]+'</span></div></div><div class="col-md-2"><div class="form-group"><span id="vbname">'+bank_bcname[b]+'</span></div></div><div class="col-md-2"><div class="form-group"><span id="vifsc">'+bank_ifsc[b]+'</span></div></div><div class="col-md-2"><div class="form-group"><span id="vbranch">'+bank_branch[b]+'</span></div></div>';
			}
			$(".view_banks").html(bankstr);
		}else{
			$(".view_banks").html('');
		}
		//console.log(upload_doctype);
		if(upload_doctype != null)
		{
			for(d =0; d < upload_doctype.length; d++){
				
				vdocs +='<li> '+upload_doctype[d]+' - <span class="grn_clr">Uploaded </span></li>';
			}			
			$("#vdocs").html(vdocs);
		}else{
			vdocs ='<li><span style="color:red;">No documents uploaded </span></li>';
			$("#vdocs").html(vdocs);
		}
			
		if(cropcount == true){
			for(c = 0; c < crop_loc.length; c++)
			{
				cropstr += '<div class="col-md-4"><div class="form-group"><span id="vcroploc">'+crop_loc[c]+'</span></div></div><div class="col-md-4"><div class="form-group"><span id="vcroptype">'+crop_type[c]+'</span></div></div><div class="col-md-4"><div class="form-group"><span id="vacres">'+crop_acres[c]+'</span></div></div>';
			}
			$(".view_crops").html(cropstr);
		}else{
			$(".view_crops").html('');
		}
		
		if(partnercount == true){
			for(p = 0; p < pname.length; p++)
			{
				partnerstr += '<div class="col-md-4"><div class="form-group"><span id="vcroploc">'+pname[p]+'</span></div></div><div class="col-md-4"><div class="form-group"><span id="vcroptype">'+paadhar[p]+'</span></div></div><div class="col-md-4"><div class="form-group"><span id="vacres">'+pmobile[p]+'</span></div></div>';
			}
			$(".view_partners").html(partnerstr);
		}else{
			$(".view_partners").html('');
		}
		// End view Data
	});	

	
	$(thisform).submit(function(e) {
		e.preventDefault();
	}).validate({
		rules:{
			
			firm_name:
			{
				required: true,
				minlength: 3
			},				
			uname:{
				required:true,
				minlength:3
			},				
			mob_numb:{
				required:true,
				number:true,
				minlength:10,
				maxlength:10
			},
			aadhar:{
				number:true,
				number:"Please eneter 12 digits Aadhar number",
				minlength:12,
				maxlength:12,
				//aadhar_regexp:true
			},
			pan:{
				minlength:10,
				maxlength:10,
				pan_regexp:true
			},
			"pname[]":{
				required:true,
				minlength:3
			},
			"paadhar[]":{
				required:true,
				number:true,
				minlength:12,
				maxlength:12
			},
			"pmobile[]":{
				required:true,
				minlength:10,
				maxlength:10
			},					
			mob_numb_new:{
				//required:true,
				number:true,
				minlength:10,
				maxlength:10
			},			
			
			/* email:{
			  required: true,
			  email_regexp:true,
			 
			} */
		},
		messages: {
			firm_name:
			{
				required: "Please enter firm name",
				minlength: "Minimum length at least 3 characters",
			},
			uname:
			{
				required: "Please enter name",
				minlength: "Minimum length at least 3 characters",
			},				
			mob_numb:
			{
				required: "Please enter mobile number"
			},
			"pname[]":{
				required:"Please enter partner name",
				minlength:3
			},
			"paadhar[]":{
				required:"Please enter aadhar number",
				number:"Please eneter 12 digits Aadhar number",
				minlength:12,
				maxlength:12
			},
			"pmobile[]":{
				required:"Please enter contact number",
				minlength:10,
				maxlength:10
			},		
			
			/* email:{
			  required:'Please enter email',
			  regex:'Please enter valid email',
			} */

		},
		submitHandler: function(form) 
		{			
			var cnfsbmt = 0;			
			$('.alpha_blk2, .full_wth_popup').show();			
		}
		
	});
}

// Form Submit Start


// Form submit end

function barndcheck_old(bval)
{
	//console.log(bval);
	var difference = [];
	var mval = $("#hid_medval").val();
	var	hidmedval = $("#hid"+mval).val();
	var cnf = document.getElementById("brand"+bval);
	if( cnf.checked ==  true){		
		
		//$('#autoUpdate').fadeIn('slow');
		//$('#'+bval).fadeOut('slow');
		if(hidmedval == "") $("#hid"+mval).val(bval);
		else $("#hid"+mval).val(hidmedval +','+bval);	
	}
	
	//var final_arr = $.merge([], oldArray);
	
	
	/* if(mval == "m1")
	{
		//eval('var ' + k + i + '= ' + i + ';'); 
		var  m1Ids = $(".al_brands input:checkbox:checked").map(function(){
		  return $(this).val();
		}).get();
		console.log(m1Ids);
	} */
	
}
function barndcheck(bval)
{
	//console.log(bval);
	$('#flsh_msg_med').html('');
	var difference = [];
	var mval = $("#hid_medval").val();
	var lastChar = mval[mval.length -1];
	//alert(lastChar);
	$("#hid"+mval).val($("#hidm"+lastChar).val());
	var	hidmedval = $("#hid"+mval).val();
	
	var cnf = document.getElementById("brand"+bval);
	if( cnf.checked ==  true){
		if(hidmedval == "") $("#hid"+mval).val(bval);
		else $("#hid"+mval).val(hidmedval +','+bval);
		$("#hidm"+lastChar).val($("#hid"+mval).val());
	}else{
		
		var arry = $("#hidm"+lastChar).val().split(',');
			y = $.grep(arry, function(value) {
			  return value != bval;
		});	
		//alert(y);
		$("#hid"+mval).val(y.toString());
		$("#hidm"+lastChar).val(y.toString());
	}		
}
function myFunction() {
  // Declare variables
  var input, filter, ul, li, a, i, txtValue;
  input = document.getElementById('ato_serc');
  filter = input.value.toUpperCase();
  ul = document.getElementById("myUL");
  li = ul.getElementsByTagName('li');

  // Loop through all list items, and hide those who don't match the search query
  for (i = 0; i < li.length; i++) {
    //a = li[i].getElementsByTagName("a")[0];
    a = li[i].getElementsByTagName("div")[0];
    txtValue = a.textContent || a.innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      li[i].style.display = "";
    } else {
      li[i].style.display = "none";
    }
  }
}
</script>

<div class="alpha_blk"> </div>
<div class="side_popup"> 
	<div class="padding_30">
		<div id="flsh_msg_med"></div>
		<form class="products_slcs tab-content" action="javascript:void(0);" method="post">
			<div class="hdg_bk">All Brands </div>
			<div class="auto_search"> 
				<div class="form-group">
					<input type="text" class="form-control" id="ato_serc" placeholder="Search Brands" onkeyup="myFunction();" />   
				</div>
			</div>
		<ul class="al_brands" id="myUL">
			<?php for($i=0;$i<20;$i++){ ?>
			<li id="<?php echo $i+1;?>" rel="Brand <?php echo $i+1;?>"> 
				<div class="form-check" >
					<input type="checkbox" class="form-check-input" id="brand<?php echo $i+1;?>" id="brand" name="brand[]" value="<?php echo $i+1;?>" onchange="barndcheck('<?php echo $i+1;?>');">
					<label class="form-check-label" for="brand<?php echo $i+1;?>">Brand <?php echo $i+1;?></label>
				</div>
			</li>
			<?php } ?>
		</ul>
		
		 <div class="pop_ftr"> <button class="btn btn-primary medsub" > Assign to Medicines<span id="medsection"></span></button>
		 <button type="button" class="btn btn-danger cls_pp_sd"> Close </button> </div> 
		</form>
	</div>
</div>


<!-- user privew -->
<div class="alpha_blk2"></div>
<div class="full_wth_popup padding_30"> 
	<div class="hdg_bk head_title"> User Details (Farmer - Single)</div>
	<div class="row">

		<div class="col-md-4 view_uname"> 
			<div class="form-group">
				<label for="vuname">Name</label>
				<span id="vuname">Sample Name</span> 
			</div>
		</div>

		<div class="col-md-4 view_gname"> 
			<div class="form-group">
				<label for="vgname" >Guarantor(C/O)</label>
				<span id="vgname"></span>
			</div>
		</div>

		<div class="col-md-4 view_mobile"> 
			<div class="form-group">
				<label for="vmobile" >Mobile</label>
				<span id="vmobile"></span>   
			</div>
		</div> 	  

		<div class="col-md-4 view_emailid"> 
			<div class="form-group">
				<label for="vemailid">Email Id</label>
				<span id="vemailid"></span> 
			</div>
		</div>
		
		<div class="col-md-4 view_addr"> 
			<div class="form-group">
				<label for="vaddr">Address</label>
				<span id="vaddr"></span>
			</div>
		</div>
	</div>
	<div class="hdg_bk">Alerts </div>
	<p> Do you want to receive alerts : <b class="grn_clr"> <span id="valert"></span> </b> </p>
	<div class="row view_alerts"> 
		<div class="col-md-6"> 
			<div class="form-group">
			   <label for="valertmob">Phone Number</label>  
			   <span id="valertmob"></span>
			</div>
		</div>

		<div class="col-md-6"> 
			<div class="form-group">
			   <label for="valertmail">Email</label>  
			   <span id="valertmail"></span>
			</div>
		</div>
	</div>
	
	<div class="hdg_bk partner_block">Partner Details <span id="partnercount">(1)</span></div>
	<div class="row view_partners_labels"> 
		<div class="col-md-4"> 
			<div class="form-group">
				<label for="vpartner">Partner Name</label>
			</div>	
		</div>
		<div class="col-md-4"> 
			<div class="form-group">
				<label for="vpaadhar">Aadhar </label>
			</div>
		</div>
		<div class="col-md-4"> 
			<div class="form-group">
				<label for="vpmobile">Phone Number </label>
			</div>
		</div>
	</div>
	<div class="row view_partners"></div>
	
	<div class="hdg_bk">Accounts Information </div>
	<div class="row view_accounts"> 
		<div class="col-md-4 vaadhar_block"> 
			<div class="form-group">
				<label for="vaadhar">Aadhar</label>  
				<span id="vaadhar"></span>
			</div>
		</div>
		<div class="col-md-4 vpan_block"> 
			<div class="form-group">
				<label for="vpan">PAN </label>
				<span id="vpan"></span>
			</div>
		</div>
		<div class="col-md-4 vgst_block"> 
			<div class="form-group">
				<label for="vgst">GST </label>
				<span id="vgst"></span>
			</div>
		</div>
	</div>
  
	<div class="hdg_bk">Bank Details <span id="bankcount">(1)</span> </div>
	<div class="row"> 
		<div class="col-md-3"> 
			<div class="form-group">
				<label for="vperson">Person Name </label>				
			</div>
		</div>

		<div class="col-md-3"> 
			<div class="form-group">
			   <label for="vacnum">Account Number</label>			
			</div>
		</div>
	  
		<div class="col-md-2"> 
			<div class="form-group">
				<label for="vbname">Bank Name</label>				
			</div>
		</div>

		<div class="col-md-2"> 
			<div class="form-group">
			   <label for="vifsc">IFSC</label>			
			</div>
		</div>

		<div class="col-md-2"> 
			<div class="form-group">
				<label for="vbranch">Branch Name</label>				
			</div>			
		</div>
		
	</div>
	<div class="row view_banks"></div>

	<div class="hdg_bk">Crop Details <span id="cropcount">(1)</span> </div>

	<div class="row"> 
		<div class="col-md-4"> 
			<div class="form-group">
				<label for="vcroploc">Crop Location</label>
			</div>
		</div>

		<div class="col-md-4"> 
			<div class="form-group">
				<label for="vcroptype">Crop Type</label>
			</div>
		</div>

		<div class="col-md-4"> 
			<div class="form-group">
				<label for="vacres">Number Of Acres</label>
			</div>
		</div>
	</div>
	<div class="row view_crops"></div>

	<div class="hdg_bk">Defalst Discount </div>
	<div class="row view_discounts">
		<div class="col-md-4"> 
			<div class="form-group">
				<label for="vfeed">Feed(%)</label>
				<span id="vfeed"></span>%
		  </div>
		</div>

		<div class="col-md-4"> 
			<div class="form-group">
			   <label for="vmed1">Medicines1 (%)</label>
				<span id="vmed1"></span>% - Default
			</div>
		</div>
		
		<div class="col-md-4"> 
			<div class="form-group">
				<label for="vmed2">Medicines2 (%)</label>
				<span id="vmed2"></span>% - Default
		  </div>
		</div>
		
		<div class="col-md-4"> 
			<div class="form-group">
			   <label for="vmed3">Medicines3 (%)</label>
			<span id="vmed3"></span>% - Default
			</div>
		</div>

		<div class="col-md-4"> 
			<div class="form-group">
			   <label for="vroi">Rate Of Intrest</label>
				<span id="vroi"></span>%
			</div>
		</div>
	</div>

	<div class="hdg_bk">Document Upload </div>
	<div class="row view_docs"> 
		<div class="col-md-4">  
		  <ul id="vdocs"> 
			
		  </ul>
		</div>

		<div class="col-md-4"> 
			<div class="form-group">
			   <label for="vrcdate">Documents Received Date</label>
				<span id="vrcdate">10-Apr-2020</span>
		  </div>
		</div>

		<div class="col-md-4"> 
			<div class="form-group">
			   <label for="vrtdate">Documents Return Date</label>
				<span id="vrtdate">15-Apr-2021</span>
		  </div>
		</div>

		<div class="col-md-12">
		  <div class="form-group">
			   <label for="vdocrem">Remarks</label>
				<p id="vdocrem"></p>
		  </div>
		</div>

		<div class="hdg_bk">Out Standing Amount <span class="rd_clr vosamt"> -20,000  </span> </div>
		<div class="row"> 
			<div class="col-md-12">
			  <div class="form-group"> 
					<label for="vosrem">Remarks</label>
					<p id="vosrem"></p>
			  </div>
			</div>
		</div>
	</div>

	<div class="ftr_pop"> 
		<button type="button" class="btn btn-info edt_user">Edit</button>
		<button type="button" class="btn btn-primary" id="cnf_sbmt" >Submit</button>
	</div>
</div>

<?php require_once 'footer.php' ; ?>