<!-- Farmer Section -->
<div id="former_div">
 <!-- Multiple Farmer Start -->
 <form id="farmer" name="farmer" method="post" enctype="multipart/form-data" >	
	<div class="pad_20">
		<div class="hdg_bk"> <span id="act_text">View</span> Farmer <span id="success_msg" style="color:green;"></span>
			<a href="javascript:void(0);" title="" class="btn btn-primary fr" id="editID" onclick="changeForm('Edit');"> Edit User </a>
			<a href="javascript:void(0);" title="" class="btn btn-danger fr" id="cancelID" style="display: none;" onclick="changeForm('Cancel');"> Cancel </a>
		</div>
	</div>
		<div class="row"> 
			<div class="col-md-12 lft_blk"> 
				<div class="pad_20">
					<div class="row">
						<?php if($user['user_type']=='FARMER' && $user['partnership']==0){?>
						<div class="col-md-4 single_r"> 
							<div class="form-group">
								<label for="name">Name</label>
								<input type="text" class="form-control input_disable" id="user_name" name="user_name" placeholder="Name" value="<?php echo $user['user_name'];?>">   
							</div>
						</div>
						<?php }?>
						<?php if($user['user_type']=='FARMER' && $user['partnership']==1){?>
						<div class="col-md-4"> 
							<div class="form-group">
								<label for="name">Firm Name</label>
								<input type="text" class="form-control input_disable" id="firm_name" name="firm_name" placeholder="Firm Name" value="<?php echo $user['firm_name'];?>">   
							</div>
						</div>

						<div class="col-md-4"> 
							<div class="form-group">
								<label for="name">Owner Name</label>
								<input type="text" class="form-control input_disable" id="owner_name" name="owner_name" placeholder="Owner Name" value="<?php echo $user['owner_name'];?>">
							</div>
						</div>
						<?php }?>
						<div class="col-md-4"> 
							<div class="form-group">
								<label for="name">Guarantor(C/O)</label>
								<input type="text" class="form-control input_disable" id="guarantor" name="guarantor" placeholder="Guarantor(C/O)" value="<?php echo $user['guarantor'];?>">   
							</div>
						</div>

						<div class="col-md-4"> 
							<div class="form-group">
								<label for="name">Mobile</label>
								<input type="text" class="form-control allownumericwithoutdecimal input_disable" id="mobile" name="mobile" placeholder="Mobile Number" value="<?php echo $user['mobile'];?>" onkeyup="checkMobileEditMode();" maxlength="10" />
								<label id="mobile-error" class="error" for="mobile" style="display: block;"></label>   
							</div>
						</div>
						
						<div class="col-md-4"> 
							<div class="form-group">
								<label for="name">Email Id</label>
								<input type="email" class="form-control input_disable" id="email" name="email" placeholder="Email Id" value="<?php echo $user['email'];?>">  
							</div>
						</div>
						
						<div class="col-md-4"> 
							<div class="form-group">
								<label for="name">Address</label>
								<textarea   class="form-control input_disable" id="address" name="address" placeholder="Address" rows="2"><?php echo $user['address'];?></textarea> 
							</div>
						</div>

					</div>

					<div class="hdg_bk"> Alerts </div>
					<div class="clr"></div>
					<p class="alert_txt hide_action_btn"> Do you want to receive alerts :  </p>
					<div class="alerts_confirm fl hide_action_btn">
						<div class="alert_check"> <input type="checkbox" id="notify_alert" name="notify_alert" value="1" checked /> 
							<div class="trun_txt"> Turn on </div>
						</div>
					</div>
					<div class="clr"></div>

					<div class="aler_lnks">
						<div class="row">
							<div class="col-md-4"> 
								<div class="form-group new_blk">
									<label for="name">Mobile</label>
									<div class="new_blk_add hide_action_btn"> <img src="<?php echo base_url();?>assets/images/add.png" alt="" title=""> </div>
									<input type="text" class="form-control allownumericwithoutdecimal input_disable" id="mob_numb_new" name="mob_numb_new" placeholder="Mobile Number" value="" <?php if(count($amobiles)==0){echo 'disabled';}?> />
									<ul class="new_mob_em_blk new_p">
										<?php
										if(count($amobiles)>0){
											foreach($amobiles as $key=>$value) {
													if($key==0){
														?>
															<li class="new_cont defa_c"><?php echo $value['contact'];?>,
															<input type="hidden" name="alert_mids[]" value="<?php echo $value['uc_id'];?>">
															<input type="hidden" name="alert_m[]" value="<?php echo $value['contact'];?>">
															</li>
														<?php
													}else{
														?>
															<li class="new_cont" id="m<?php echo $value['uc_id'];?>">
																<?php echo $value['contact'];?>
																<span class="cls_itm mob_ext hide_action_btn" onclick="removeElementAlert('m<?php echo $value['uc_id'];?>','<?php echo $value['uc_id'];?>','<?php echo $value['contact'];?>','alerts');">
																<img src="<?php echo base_url();?>assets/images/close_btn.png"></span>
															<input type="hidden" name="alert_mids[]" value="<?php echo $value['uc_id'];?>">
															<input type="hidden" name="alert_m[]" value="<?php echo $value['contact'];?>">
															</li>
														<?php
													}	
											}
										}
										?>
									</ul>
									<input type="hidden" id="hid_mob" name="hid_mob" class="multvals" value="<?php echo implode(",", $alert_m);?>" />
								</div>
							</div>

							<div class="col-md-4"> 
								<div class="form-group new_blk">
									<label for="name">Email Id</label>
									<div class="new_blk_add new_m hide_action_btn"> <img src="<?php echo base_url();?>assets/images/add.png" alt="" title=""> </div>
									<input type="email" class="form-control input_disable" id="email_id_new" name="email_id_new" placeholder="Email Id"  <?php if(count($emobiles)==0){echo 'disabled';}?>/>  
									<ul class="new_mob_em_blk new_m">
										<?php
										if(count($emobiles)>0){
											foreach($emobiles as $key=>$value) {
													if($key==0){
														?>
															<li class="new_cont defa_c"><?php echo $value['contact'];?>,
															<input type="hidden" name="alert_eids[]" value="<?php echo $value['uc_id'];?>">
															<input type="hidden" name="alert_e[]" value="<?php echo $value['contact'];?>">
															</li>
														<?php
													}else{
														?>
															<li class="new_cont" id="e<?php echo $value['uc_id'];?>">
																<?php echo $value['contact'];?>
																<span class="cls_itm mob_ext hide_action_btn" onclick="removeElementAlert('e<?php echo $value['uc_id'];?>','<?php echo $value['uc_id'];?>','<?php echo $value['contact'];?>','alerts');">
																<img src="<?php echo base_url();?>assets/images/close_btn.png"></span>
															<input type="hidden" name="alert_eids[]" value="<?php echo $value['uc_id'];?>">
															<input type="hidden" name="alert_e[]" value="<?php echo $value['contact'];?>">
															</li>
														<?php
													}
											}
										}
										?>
									</ul> 
									<input type="hidden" id="hid_mail" name="hid_mail" class="multvals" value="<?php echo implode(",", $alert_e);?>" />
								</div>
							</div>
						</div>
					</div>
					<div class="dft_mob_blk new_p">
						<div style="color: red; font-size: 14px;"> Please Fill Above Email and Phone Number </div>
					</div>

					<div class="hdg_bk">Accounts Information </div>

					<div class="row">
					    <?php if($user['user_type']=='FARMER' && $user['partnership']==0){?> 
						<div class="col-md-4 single_r"> 
							<div class="form-group">
								<label for="name">Aadhar </label>
								<input type="text" class="form-control allownumericwithoutdecimal input_disable" id="aadhar_no" name="aadhar_no" placeholder="Aadhar" maxlength="12" value="<?php echo $user['aadhar_no'];?>">   
							</div>
						</div>
						<?php }?>
						<div class="col-md-4"> 
							<div class="form-group">
								<label for="name">PAN</label>
								<input type="text" class="form-control input_disable" id="pan_no" name="pan_no" placeholder="PAN" maxlength="10" value="<?php echo $user['pan_no'];?>">   
							</div>
						</div>
						<?php if($user['user_type']=='FARMER' && $user['partnership']==1){?>
						<div class="col-md-4"> 
							<div class="form-group">
								<label for="name">GST</label>
								<input type="text" class="form-control input_disable" id="gst" name="gst" placeholder="GST" value="<?php echo $user['gst'];?>">   
							</div>
						</div>
						<?php }?>
					</div>
				 <?php if($user['user_type']=='FARMER' && $user['partnership']==1){?>
					<div class="hdg_bk"> Partner details <span class="hide_action_btn">Skip <input type="checkbox" id="partner_skip" name="partner_skip" value="1"/></span>
						<a href="javascript:void(0)" title="" class="fr ad_part hide_action_btn"> + Add Partner </a>
					</div>
					<?php 
						if($pcnt>1){
						?>
						<div class="new_part_lst" id="partner_cnt" data-partner-cnt="<?php echo $pcnt;?>" data-partner-ids="<?php echo $pids;?>">
							<?php 
								$pacc_id=1;
								for($p=0;$p<count($partners);$p++){
									$pacc_id=$pacc_id+$b;
								 ?>
								 <div class="row dtl_par" id="partner_acc_<?php echo $pacc_id;?>" data-bank-id="partner_acc_<?php echo $pacc_id;?>" data-pid="<?php echo $pacc_id;?>"> 
									<div class="col-md-4"> 
										<div class="form-group">
											<label >Partner Name</label>  
											<input type="text" class="form-control input_disable" id="pname_<?php echo $pacc_id;?>" name="pname[]" placeholder="Partner Name" value="<?php echo $partners[$p]['partner_name'];?>">
											<label id="pname_<?php echo $pacc_id;?>-error" class="error" for="pname_<?php echo $pacc_id;?>"></label>   
										</div>
									</div>

									<div class="col-md-4"> 
										<div class="form-group">
											<label for="name">Aadhar</label>
											<input type="text" class="form-control allownumericwithoutdecimal input_disable" id="paadhar_<?php echo $pacc_id;?>" name="paadhar[]" placeholder="Aadhar" value="<?php echo $partners[$p]['aadhar_no'];?>">
											<label id="paadhar_<?php echo $pacc_id;?>-error" class="error" for="paadhar_<?php echo $pacc_id;?>"></label> 
										</div>
									</div>

									<div class="col-md-4"> 
										<div class="form-group">
											<label for="name">Phone Number </label>
											<input type="text" class="form-control allownumericwithoutdecimal input_disable" id="pmobile_<?php echo $pacc_id;?>" name="pmobile[]" style="width: calc(100% - 40px);float:left;" placeholder="Phone Number" value="<?php echo $partners[$p]['mobile_no'];?>">
											<label id="pmobile_<?php echo $pacc_id;?>-error" class="error" for="pmobile_<?php echo $pacc_id;?>"></label>
											<?php
												if($p>0){
												  ?>
												  <span class="cl_part hide_action_btn" maxlength="10" onclick="removeElement(<?php echo $pacc_id;?>,'<?php echo $partners[$p]['pd_id'];?>','<?php echo $partners[$p]['partner_name'];?>','partner');"><img src="<?php echo base_url();?>/assets/images/close_btn.png" width="17"></span>
												  <?php
												}
											?>
										</div>
									</div>
									<input type="hidden" name="pids[]" value="<?php echo $partners[$p]['pd_id'];?>"/>
								</div>
								 <?php
								}
							?>
						</div>
						<?php 	
						}else{
							?>
							<div class="new_part_lst" id="partner_cnt" data-partner-cnt="1" data-partner-ids="1">
								<div class="row dtl_par" data-bank-id="partner_acc_1" data-pid="1"> 
									<div class="col-md-4"> 
										<div class="form-group">
											<label >Partner Name</label>  
											<input type="text" class="form-control input_disable" id="pname_1" name="pname[]" placeholder="Partner Name" value="<?php echo $partners[0]['partner_name'];?>">
											<label id="pname_1-error" class="error" for="pname_1"></label>   
										</div>
									</div>

									<div class="col-md-4"> 
										<div class="form-group">
											<label for="name">Aadhar</label>
											<input type="text" class="form-control allownumericwithoutdecimal input_disable" id="paadhar_1" name="paadhar[]" placeholder="Aadhar" value="<?php echo $partners[0]['aadhar_no'];?>">
											<label id="paadhar_1-error" class="error" for="paadhar_1"></label> 
										</div>
									</div>

									<div class="col-md-4"> 
										<div class="form-group">
											<label for="name">Phone Number </label>
											<input type="text" class="form-control allownumericwithoutdecimal input_disable" id="pmobile_1" name="pmobile[]" style="width: calc(100% - 40px);" placeholder="Phone Number" value="<?php echo $partners[0]['mobile_no'];?>">
											<label id="pmobile_1-error" class="error" for="pmobile_1"></label>    
										</div>
									</div>
									<input type="hidden" name="pids[]" value="<?php echo $partners[0]['pd_id'];?>"/>
								</div>
							</div>
							<?php
						}
					?>
					<?php }?>
				</div>
			</div>
			<div class="col-md-12"> 
				<div class="pad_20 bg_w" id="bank_block">
					<div class="hdg_bk">Bank Details(<span id="bd_cnt"><?php echo $bcnt;?></span>) <span class="hide_action_btn">Skip <input type="checkbox" id="bank_skip" name="bank_skip" value="1"/></span><a href="javascript:void(0)" title="" class="fr ad_bnk hide_action_btn"> + Add Bank </a> </div>
					<?php 
						if($bcnt>1){
						?>
						<div class="bank_list" id="bank_cnt" data-bank-cnt="<?php echo $bcnt;?>" data-bank-ids="<?php echo $bc_ids;?>">
							<div class="bank_list_pos">
							<?php
								$bacc_id=1;
								for($b=0;$b<count($bank_acc);$b++){
									$bacc_id=$bacc_id+$b;
									?>
								<div class="bank_dtl_blk" id="bank_acc_<?php echo $bacc_id;?>" data-bank-id="bank_acc_<?php echo $bacc_id;?>" data-bid="<?php echo $bacc_id;?>">
									<?php
										if($b>0){
										  ?>
										  <span class="remove_conf hide_action_btn" onclick="removeElement(<?php echo $bacc_id;?>,'<?php echo $bank_acc[$b]['acc_id'];?>','<?php echo $bank_acc[$b]['account_no'];?>','bank');"> <img src="<?php echo base_url();?>/assets/images/close_btn.png" alt="" title="" /></span>
										  <?php
										}
									?>
									<div class="row"> 
										<div class="col-md-6"> 
											<div class="form-group">
												<label for="name">Person Full Name</label>
												<input type="text" class="form-control input_disable" id="fname_<?php echo $bacc_id;?>" name="fname[]" placeholder="Person Full Name" value="<?php echo $bank_acc[$b]['full_name'];?>">
												<label id="fname_<?php echo $bacc_id;?>-error" class="error" for="fname_<?php echo $bacc_id;?>"></label>   
											</div>
										</div>

										<div class="col-md-6"> 
											<div class="form-group">
												<label for="name">Account Number</label>
												<input type="text" class="form-control allownumericwithoutdecimal input_disable" id="ac_number_<?php echo $bacc_id;?>" name="ac_number[]" placeholder="Account Number" value="<?php echo $bank_acc[$b]['account_no'];?>">
												<label id="ac_number_<?php echo $bacc_id;?>-error" class="error" for="ac_number_<?php echo $bacc_id;?>"></label>   
											</div>
										</div>

										<div class="col-md-6"> 
											<div class="form-group">
												<label for="name">Bank Name</label>
												<input type="text" class="form-control input_disable" id="bc_name_<?php echo $bacc_id;?>" name="bc_name[]" placeholder="Bank Name" value="<?php echo $bank_acc[$b]['bank_name'];?>">
												<label id="bc_name_<?php echo $bacc_id;?>-error" class="error" for="bc_name_<?php echo $bacc_id;?>"></label>   
											</div>
										</div>

										<div class="col-md-6"> 
											<div class="form-group">
												<label for="name">IFSC</label>
												<input type="text" class="form-control input_disable" id="ifsc_<?php echo $bacc_id;?>" name="ifsc[]" placeholder="IFSC" value="<?php echo $bank_acc[$b]['ifsc'];?>">
												<label id="ifsc_<?php echo $bacc_id;?>-error" class="error" for="ifsc_<?php echo $bacc_id;?>"></label>   
											</div>
										</div>

										<div class="col-md-6"> 
											<div class="form-group">
												<label for="name">Branch Name</label>
												<input type="text" class="form-control input_disable" id="branch_name_<?php echo $bacc_id;?>" name="branch_name[]" placeholder="Branch Name" value="<?php echo $bank_acc[$b]['branch_name'];?>">   
											</div>
										</div>
										
									</div>
									<input type="hidden" name="bids[]" value="<?php echo $bank_acc[$b]['acc_id'];?>"/>
								</div>	
									<?php
								}	
							?>
							 </div>
							</div>
							<?php
						}else{
						 ?>
						<div class="bank_list" id="bank_cnt" data-bank-cnt="1" data-bank-ids="1"> 
							<div class="bank_list_pos">
								<div class="bank_dtl_blk" data-bank-id="bank_acc_1" data-bid="1">
									<div class="row"> 
										<div class="col-md-6"> 
											<div class="form-group">
												<label for="name">Person Full Name</label>
												<input type="text" class="form-control input_disable" id="fname_1" name="fname[]" placeholder="Person Full Name" value="<?php echo $bank_acc[0]['full_name'];?>">
												<label id="fname_1-error" class="error" for="fname_1"></label>   
											</div>
										</div>

										<div class="col-md-6"> 
											<div class="form-group">
												<label for="name">Account Number</label>
												<input type="text" class="form-control allownumericwithoutdecimal input_disable" id="ac_number_1" name="ac_number[]" placeholder="Account Number" value="<?php echo $bank_acc[0]['account_no'];?>">
												<label id="ac_number_1-error" class="error" for="ac_number_1"></label>   
											</div>
										</div>

										<div class="col-md-6"> 
											<div class="form-group">
												<label for="name">Bank Name</label>
												<input type="text" class="form-control input_disable" id="bc_name_1" name="bc_name[]" placeholder="Bank Name" value="<?php echo $bank_acc[0]['bank_name'];?>">
												<label id="bc_name_1-error" class="error" for="bc_name_1"></label>   
											</div>
										</div>

										<div class="col-md-6"> 
											<div class="form-group">
												<label for="name">IFSC</label>
												<input type="text" class="form-control input_disable" id="ifsc_1" name="ifsc[]" placeholder="IFSC" value="<?php echo $bank_acc[0]['ifsc'];?>">
												<label id="ifsc_1-error" class="error" for="ifsc_1"></label>   
											</div>
										</div>

										<div class="col-md-6"> 
											<div class="form-group">
												<label for="name">Branch Name</label>
												<input type="text" class="form-control input_disable" id="branch_name_1" name="branch_name[]" placeholder="Branch Name" value="<?php echo $bank_acc[0]['branch_name'];?>">   
											</div>
										</div>
									</div>
									<input type="hidden" name="bids[]" value="<?php echo $bank_acc[0]['acc_id'];?>"/>
								</div>
							</div>
						</div>
						 <?php 
						}
					?>
					<div class="hdg_bk">Crop Details (<span id="cd_cnt"><?php echo $ccnt;?></span>) <span class="hide_action_btn">Skip <input type="checkbox" id="crop_skip" name="crop_skip" value="1"/></span><a href="javascript:void(0)" title="" class="fr ad_crp hide_action_btn"> + Add Crop </a></div>
					<?php 
						if($ccnt>1){
							?>
							<div class="crp_list" id="crop_cnt" data-crop-cnt="<?php echo $ccnt;?>" data-crop-ids="<?php echo $cc_ids;?>">
							<div class="crp_list_pos" style="width: 1680px;">
							<?php
							$cc_id=1;
							for($c=0;$c<count($crops);$c++){
								$cc_id=$cc_id+$c;
								?>
								<div class="crp_dtl_blk" id="crop_details_<?php echo $cc_id;?>" data-crop-id="crop_details_<?php echo $cc_id;?>" data-cid="<?php echo $cc_id;?>">
									<?php
										if($c>0){
										  ?>
										  <span class="crp_conf hide_action_btn" onclick="removeElement(<?php echo $cc_id;?>,'<?php echo $crops[$c]['cd_id'];?>','<?php echo $crops[$c]['crop_type'];?>','crop')"> <img src="<?php echo base_url();?>/assets/images/close_btn.png" alt="" title="" /></span>
										  <?php
										}
									?>
									<div class="row">
										<div class="col-md-6"> 
											<div class="form-group">
												<label for="name">Crop Location</label>
												<input type="text" class="form-control input_disable" id="crop_loc_<?php echo $cc_id;?>" name="crop_loc[]" placeholder="Crop Location" value="<?php echo $crops[$c]['crop_location'];?>">
												<label id="crop_loc_<?php echo $cc_id;?>-error" class="error" for="crop_loc_<?php echo $cc_id;?>"></label>   
											</div>
										</div>

										<div class="col-md-6"> 
											<div class="form-group">
												<label for="name">Crop type</label>
												<input type="text" class="form-control input_disable" id="crop_type_<?php echo $cc_id;?>" name="crop_type[]" placeholder="Crop type" value="<?php echo $crops[$c]['crop_type'];?>">
												<label id="crop_type_<?php echo $cc_id;?>-error" class="error" for="crop_type_<?php echo $cc_id;?>"></label>    
											</div>
										</div>

										<div class="col-md-6"> 
											<div class="form-group">
												<label for="name">Number of Acres</label>
												<input type="text" class="form-control input_disable" id="acres_<?php echo $cc_id;?>" name="acres[]" placeholder="Acres" onkeypress="return allowNumerORDecimal(event,this)" value="<?php echo $crops[$c]['no_of_acres'];?>">
												<label id="acres_<?php echo $cc_id;?>-error" class="error" for="acres_<?php echo $cc_id;?>"></label>  
											</div>
										</div>
										
									</div>
									<input type="hidden" name="cids[]" value="<?php echo $crops[$c]['cd_id'];?>"/>
								</div>
								<?php
							}
							?>
							 </div>
							</div>
							<?php
						}else{
						?>
						<div class="crp_list" id="crop_cnt" data-crop-cnt="1" data-crop-ids="1"> 
							<div class="crp_list_pos">
								<div class="crp_dtl_blk" data-crop-id="crop_details_1" data-cid="1">
									<div class="row">
										<div class="col-md-6"> 
											<div class="form-group">
												<label for="name">Crop Location</label>
												<input type="text" class="form-control input_disable" id="crop_loc_1" name="crop_loc[]" placeholder="Crop Location" value="<?php echo $crops[0]['crop_location'];?>">
												<label id="crop_loc_1-error" class="error" for="crop_loc_1"></label>   
											</div>
										</div>

										<div class="col-md-6"> 
											<div class="form-group">
												<label for="name">Crop type</label>
												<input type="text" class="form-control input_disable" id="crop_type_1" name="crop_type[]" placeholder="Crop type" value="<?php echo $crops[0]['crop_type'];?>">
												<label id="crop_type_1-error" class="error" for="crop_type_1"></label>    
											</div>
										</div>

										<div class="col-md-6"> 
											<div class="form-group">
												<label for="name">Number of Acres</label>
												<input type="text" class="form-control input_disable" id="acres_1" name="acres[]" placeholder="Acres" onkeypress="return allowNumerORDecimal(event,this)" value="<?php echo $crops[0]['no_of_acres'];?>">
												<label id="acres_1-error" class="error" for="acres_1"></label>  
											</div>
										</div>
										
									</div>
									<input type="hidden" name="cids[]" value="<?php echo $crops[0]['cd_id'];?>"/>
								</div>
							</div>
						</div>
						<?php
						}
					?>
					

					<div class="hdg_bk">Default Discounts <a href="javascript:void(0)" title="" class="fr ad_med hide_action_btn"> + Add Medicines </a></div>
					<div class="row" id="med_block" data-med-cnt="<?php echo $med_cnt;?>" data-med-ids="<?php echo $med_ids;?>">
						<div class="col-md-4"> 
							<div class="form-group">
								<label for="name">Feed(%)</label>
								<input type="text" class="form-control input_disable" id="feed" name="feed" placeholder="Feed" onkeypress="return allowNumerORDecimal(event,this)" value="<?php echo $user['feed'];?>">   
							</div>
						</div>

						<div class="col-md-4 med_details" id="mdiv_1" data-med-id="med_details_1" data-mid="1"> 
							<div class="form-group">
								<label for="name">Medicines1 (%)<span class="deflt"> Default </span> 
								<a href="javascript:void(0)" title="" class="fr change_med hide_action_btn" onclick="changemed('fm1');"> Change </a>
								</label>
								<input type="text" class="form-control input_disable" id="medicines1" name="medicines[]" placeholder="Medicines1" onkeypress="return allowNumerORDecimal(event,this)" value="<?php echo $user['medicines1'];?>">
								<input type="hidden"  id="hidfm1" name="hidfm1" value="<?php echo $user['medicines1_brands'];?>" />
								<input type="hidden" id="hidm1" name="hidm1" value="<?php echo $user['medicines1_brands'];?>" />
							</div>
						</div>

						<div class="col-md-4 med_details" id="mdiv_2" data-med-id="med_details_2" data-mid="2"> 
							<div class="form-group">
								<label for="name">Medicines2 (%)<span class="deflt"> Default </span> 
								<a href="javascript:void(0)" title="" class="fr change_med hide_action_btn" onclick="changemed('fm2');"> Change </a></label>
								<input type="text" class="form-control input_disable" id="medicines2" name="medicines[]" placeholder="Medicines2" onkeypress="return allowNumerORDecimal(event,this)" value="<?php echo $user['medicines2'];?>"> 
								<input type="hidden"  id="hidfm2" name="hidfm2" value="<?php echo $user['medicines2_brands'];?>" />
								<input type="hidden" id="hidm2" name="hidm2" value="<?php echo $user['medicines2_brands'];?>" />
							</div>
						</div>

						<div class="col-md-4 med_details" id="mdiv_3" data-med-id="med_details_3" data-mid="3"> 
							<div class="form-group">
								<label for="name">Medicines3 (%)<span class="deflt"> Default </span> 
								<a href="javascript:void(0)" title="" class="fr change_med hide_action_btn" onclick="changemed('fm3');"> Change </a></label>
								<input type="text" class="form-control input_disable" id="medicines3" name="medicines[]" placeholder="Medicines3" onkeypress="return allowNumerORDecimal(event,this)" value="<?php echo $user['medicines3'];?>">
								<input type="hidden"  id="hidfm3" name="hidfm3" value="<?php echo $user['medicines3_brands'];?>"/>
								<input type="hidden" id="hidm3" name="hidm3" value="<?php echo $user['medicines3_brands'];?>"/>
							</div>
						</div>
						<?php 
							if($user['medicines4']>0){
								?>
								<div class="col-md-4 med_details" id="mdiv_4" data-med-id="med_details_4" data-mid="4"> 
									<div class="form-group">
										<label for="name">Medicines4 (%)<span class="deflt"> Default </span> 
										<a href="javascript:void(0)" title="" class="fr change_med hide_action_btn" onclick="changemed('fm4');"> Change </a><span class="med_remove hide_action_btn" onclick="removeMed('4')"> <img src="<?php echo base_url();?>/assets/images/close_btn.png" alt="" title="" /> </span></label>
										<input type="text" class="form-control input_disable" id="medicines4" name="medicines[]" placeholder="Medicines4" onkeypress="return allowNumerORDecimal(event,this)" value="<?php echo $user['medicines4'];?>">
										<input type="hidden"  id="hidfm4" name="hidfm4" value="<?php echo $user['medicines4_brands'];?>"/>
										<input type="hidden" id="hidm4" name="hidm4" value="<?php echo $user['medicines4_brands'];?>"/>
									</div>
								</div>
								<?php
							}

							if($user['medicines5']>0){
								?>
								<div class="col-md-4 med_details" id="mdiv_5" data-med-id="med_details_5" data-mid="5"> 
									<div class="form-group">
										<label for="name">Medicines5 (%)<span class="deflt"> Default </span> 
										<a href="javascript:void(0)" title="" class="fr change_med hide_action_btn" onclick="changemed('fm5');"> Change </a><span class="med_remove hide_action_btn" onclick="removeMed('5')"> <img src="<?php echo base_url();?>/assets/images/close_btn.png" alt="" title="" /> </span></label>
										<input type="text" class="form-control input_disable" id="medicines5" name="medicines[]" placeholder="Medicines5" onkeypress="return allowNumerORDecimal(event,this)" value="<?php echo $user['medicines5'];?>">
										<input type="hidden"  id="hidfm5" name="hidfm5" value="<?php echo $user['medicines5_brands'];?>"/>
										<input type="hidden" id="hidm5" name="hidm5" value="<?php echo $user['medicines5_brands'];?>"/>
									</div>
								</div>
								<?php
							}

							if($user['medicines6']>0){
								?>
								<div class="col-md-4 med_details" id="mdiv_6" data-med-id="med_details_6" data-mid="6"> 
									<div class="form-group">
										<label for="name">Medicines6 (%)<span class="deflt"> Default </span> 
										<a href="javascript:void(0)" title="" class="fr change_med hide_action_btn" onclick="changemed('fm6');"> Change </a><span class="med_remove hide_action_btn" onclick="removeMed('6')"> <img src="<?php echo base_url();?>/assets/images/close_btn.png" alt="" title="" /> </span></label>
										<input type="text" class="form-control input_disable" id="medicines6" name="medicines[]" placeholder="Medicines6" onkeypress="return allowNumerORDecimal(event,this)" value="<?php echo $user['medicines6'];?>">
										<input type="hidden"  id="hidfm6" name="hidfm6" value="<?php echo $user['medicines6_brands'];?>"/>
										<input type="hidden" id="hidm6" name="hidm6" value="<?php echo $user['medicines6_brands'];?>"/>
									</div>
								</div>
								<?php
							}
						?>
						<div class="col-md-4 roi"> 
							<div class="form-group">
							<label for="name">Rate of intrest</label>
							<input type="text" class="form-control input_disable" id="roi" name="roi" placeholder="Rate of intrest" onkeypress="return allowNumerORDecimal(event,this)" value="<?php echo $user['roi'];?>"/> 
							</div>
						</div>
					</div>
					
					<div class="hdg_bk">Documents upload </div>
					<div class="doc_up_lode"> 
						<div class="row"> 
							<div class="col-md-4"> 
								<div class="form-group">
									<label> Select Document Type </label>
									<select id="docs_upld2" name="docs_upld2" multiple="multiple" class="input_disable">
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
							<?php
							$doc_received_date=($user['doc_received_date']=='0000-00-00 00:00:00')?'':date('Y-m-d',strtotime($user['doc_received_date'])); 
							$doc_return_date=($user['doc_return_date']=='0000-00-00 00:00:00')?'':date('Y-m-d',strtotime($user['doc_return_date']));
							?>
							<div class="col-md-4"> 
								<div class="form-group">
									<label> Documents Received Date </label>
									<input type="date" id="recdate" name="recdate" placeholder="Documents Received Date" class="form-control input_disable" value="<?php echo $doc_received_date;?>"> 
								</div>
							</div>
							<div class="col-md-4"> 
								<div class="form-group">
									<label> Documents Return Date </label>
									<input type="date" id="retdate" name="retdate" placeholder="Documents Return Date" class="form-control input_disable" value="<?php echo $doc_return_date;?>"> 
								</div>
							</div>
						</div>
						<div class="row slct_docs"></div>
						<div class="row">
							<div class="col-md-4"> 
								<div class="form-group">
									<label for="rem">Remarks</label>
									<textarea class="form-control input_disable" id="doc_rem" name="doc_rem" rows="3" placeholder="Remarks"><?php echo $user['doc_rem'];?></textarea> 
								</div>
							</div>
						</div>
						
					</div>
					<div class="hdg_bk">Uploaded Documents </div>
					<div class="doc_up_lode">
						<div class="row">
							<table class="table table-bordered">
							  <thead>
							    <tr>
							      <th scope="col">Doc Type</th>
							      <th scope="col">File</th>
							      <th scope="col">Action</th>
							    </tr>
							  </thead>
							  <tbody>
								<?php
									if(count($upload_docs)>0){
										for($u=0;$u<count($upload_docs);$u++){
											$doc=['doc_id'=>$upload_docs[$u]['doc_id'],
												  'doc_type'=>$upload_docs[$u]['doc_type'],
												  'doc_file'=>$upload_docs[$u]['doc_file'],
												  'user_code'=>$user['user_code'],
												  'image'=>base_url().'assets/upload_docs/'.$user['user_code'].'/'.$upload_docs[$u]['doc_file']
												];
											$doc_json=json_encode($doc);
										 ?>
										 <tr id="doc_<?php echo $upload_docs[$u]['doc_id'];?>" data-resource='<?php echo $doc_json;?>'>
										 	<td><?php echo $upload_docs[$u]['doc_type'];?></td>
										 	<td><img src="<?php echo base_url().'assets/upload_docs/'.$user['user_code'].'/'.$upload_docs[$u]['doc_file'];?>" alt="" class="img-thumbnail" width="100px" height="100px"/></td>
										 	<td>
												<ul class="action_list hide_action_btn"> 
												  <li>
												  	<a href="javascript:void(0);" class="btn btn-primary btn-sm" title="" onclick="viewDoc('<?php echo $upload_docs[$u]['doc_id'];?>')"><i class="fa fa-eye" aria-hidden="true"></i> View </a> 
												  </li>
												  <li>&nbsp;</li>
												  <li>
												  	<a href="javascript:void();" title="" class="btn btn-danger btn-sm " data-toggle="modal" data-target="#delete_doc" onclick="delDoc('<?php echo $upload_docs[$u]['doc_id'];?>');"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete </a> 
												  </li>
												</ul>
										 	</td>
										 </tr>
										 <?php	
										}
									}else{
										echo '<tr><td colspan="3">No Documents Found!</td></tr>';
									}
								?>
							  </tbody>
							</table>
							
						</div>
					</div>

					<div class="hdg_bk">Outstanding Amount
						<select class="pos_neg input_disable" id="os_type" name="os_type" > 
							<option value="p" <?php if($user['os_type']=='p'){echo 'selected="selected"';}?>> + Additional Balance </option> 
							<option value="n" <?php if($user['os_type']=='n'){echo 'selected="selected"';}?>> - Negative Balance </option> 
						</select>
					</div>
					<div class="row">

						<div class="col-md-4"> 
							<div class="form-group">
								<label> Outstanding Amount </label>
								<input type="text" placeholder="Outstanding Amount" id="os_amt" name="os_amt" class="form-control input_disable" onkeypress="return allowNumerORDecimal(event,this)" value="<?php echo $user['os_amt'];?>"> 
							</div>
						</div>

						<div class="col-md-4"> 
							<div class="form-group">
								<label for="rem">Remarks</label>
								<textarea class="form-control input_disable" id="os_rem" name="os_rem" rows="3" placeholder="Remarks"><?php echo $user['os_remark'];?></textarea> 
							</div>
						</div>

					</div>
					
					<div class="form-group hide_action_btn"> <button type="submit" class="btn btn-primary sub_btn" onclick="return validateFarmer();" id="sub_btn">Submit <span id="loader"></span></button>&nbsp;&nbsp;<span id="sub_btn_msg"></span></div>
				</div>
			</div>
		</div>
		<br/>
		<input type="hidden" id="action" name="action" value="farmer"/>
		<input type="hidden" id="actiontype" name="actiontype" value="edit"/>
		<input type="hidden" id="user_id" name="user_id" value="<?php echo $user['user_id'];?>"/>
		<input type="hidden" id="partnership" name="partnership" value="<?php echo $user['partnership'];?>"/>
		<input type="hidden" id="hid_type" name="hid_type" value="fs" />
		<input type="hidden" id="hid_cnfsbmt" name="hid_cnfsbmt" value="0" />
		<input type="hidden" id="hid_medval" name="hid_medval" value="" />
		<!-- for medicines -->
		<input type="hidden" id="mobexists" name="mobexists" value="0" />
		<input type="hidden" id="allmed" name="allmed" value="<?php echo $allmed;?>" />
	</form>
<!-- Multiple Farmer End -->