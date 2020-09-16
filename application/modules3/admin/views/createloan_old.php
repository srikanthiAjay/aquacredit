<?php require_once 'header.php' ; ?>
<link href="<?php echo base_url();?>assets/css/loan.css" type="text/css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/css/swiper.min.css" type="text/css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/fstdropdown.css">
<script src='https://kit.fontawesome.com/a076d05399.js'></script> 
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<style>
.select2-container .select2-selection--single{
    height:34px !important;
}
.select2-container--default .select2-selection--single{
         border: 1px solid #ccc !important;
	 border-radius: .25rem;
}
</style>
<?php require_once 'sidebar.php' ; ?>		
<div class="right_blk">
	<div class="top_ttl_blk"> <span class="padin_t_5"> Loans </span></div>

	<div class="trd_cr_r">
		<!-- create loan -->
		<div class="row loan_top">
			<div class="col-md-8">
				<div class="loan_create card_view">
					<div class="crt_blk"> 
						<div class="bnk_icn"> 
							<i class="fa fa-university show_blk" aria-hidden="true"></i>
							<i class="fa fa-times" aria-hidden="true"></i> 
						</div>
						<div class="bnk_ll_blk"> 
							<h2 class="create_hdg"> Accounts  </h2>
							<div class="swiper-container">
								<div class="swiper-wrapper">
									<div class="swiper-slide">

										<ul class="bank_lst_blk">
										</ul>
									</div>
									
								</div>
								<div class="swiper-pagination"></div>
							</div>
						</div>
						<div class="create_loan_module show_blk">
							<h2 class="create_hdg"> Loan Request </h2>
							<form id="loanfrm" name="loanfrm" action="javascript:void(0);" method="post">
								<ul class="assign_type"> 
									<li class="act_type lnk_typ ban_trns"> 
										<img src="http://3.7.44.132/aquacredit/assets/images/bank_tansfer.png">
										<input type="radio" name="act_types" value="bank" checked>
										<span> Bank Transfer </span>
									</li>
									<li class="cash_trns lnk_typ"> 
										<img src="http://3.7.44.132/aquacredit/assets/images/cash_icn.png">
										<input type="radio" name="act_types" value="cash">
										<span> Cash </span>
									</li>

								</ul>
								
								<div class="ove_auto">
									<div class="trd_cr">
										<ul class="create_ul">
		 
											<li class="create_li">
												<div class="cre_inp">
													<div class="sm_blk"> User Name / Mobile </div>
													<input type="text" class="form-control" id="skey" name="skey" autocomplete="off" />
													<input type="hidden" class="form-control" id="selectuser_id" name="selectuser_id" />
													<input type="hidden" class="form-control" id="select_usercode" name="select_usercode" />
												</div>
												<label id="skey-error" class="error" for="skey"></label>
											</li>
											<li class="create_li slc_usr sel_loc">
												<div class="check_wt_serc"> 
													<div class="show_va">Crop location</div>
													<div class="selectVal cval">  Crop location </div>
													<ul class="check_list"> 
														<li id="crop_opt_li">
															<div class="form-check">
															  <input class="form-check-input" type="radio" name="crop_opt" id="crp" required />
															  <label class="form-check-label" for="crp"></label>
															</div>
														</li>
													</ul>												
												</div>
												<label id="crop_opt-error" class="error" for="crop_opt"></label>
											</li>
											<li class="create_li amnt">
												<div class="cre_inp">
													<div class="sm_blk"> Amount </div>
													<input type="text" id="loan_amt_commas" name="loan_amt_commas" class="form-control noalpha" onkeyup="amount_with_commas('add');">						
													<input type="hidden" id="loan_amt" name="loan_amt" class="form-control allownumericwithdecimal" value="">		
													<span class="amon_text"> </span>
												</div>
												<label id="loan_amt_commas-error" class="error" for="loan_amt_commas"></label>
											</li>
											<li class="create_li lon_typ">
												<div class="check_wt_serc"> 
													<div class="show_va"> Select User Bank </div>
													<div class="selectVal bval">  Select User Bank </div>
													<ul class="check_list"> 
														<li id="bank_opt_li">
															<div class="form-check">
															  <input class="form-check-input" type="radio" name="bank_opt" id="tps_l" required />
															  <label class="form-check-label" for="tps_l" /></label>
															</div>
														</li>
													</ul>												
												</div>
												<label id="bank_opt-error" class="error" for="bank_opt"></label>
											</li>
											<li class="crTbtn"> 
												<button class="btn btn-primary"> Loan Request </button> 
											</li>

										</ul>

									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card_view actvty">    
					<h1 class="create_hdg"> Analytics </h1>  
					<ul class="lns_sub_blk"> 
						<li class="anlat_bb" data-toggle="popover" data-placement="left" tabindex="0" data-trigger="focus" aria-hidden="true" onclick="typeindividual('tamt');"> 
							<span class="tot_loans">Loans(0) </span> 
							<span class="anl_value tot_amt"> ₹0 </span>
						</li>
						<li class="anlat_bb" data-toggle="popover" data-placement="left" tabindex="0" data-trigger="focus" aria-hidden="true" onclick="typeindividual('pamt');"> 
							<span>Pending Amount </span> 
							<span class="anl_value pending_amt"> ₹0  </span>
						</li>
						<li class="anlat_bb" data-toggle="popover" data-placement="left" tabindex="0" data-trigger="focus" aria-hidden="true" onclick="typeindividual('ramt');"> 
							<span>Received Amount</span> 
							<span class="anl_value recevied_amt"> ₹0  </span>
						</li>
						<li class="anlat_bb" data-toggle="popover" data-placement="left" tabindex="0" data-trigger="focus" aria-hidden="true" onclick="typeindividual('acount');"> 
							<span>Approved</span> 
							<span class="anl_value approved_count"> 0 </span>  
						</li>
						<li class="anlat_bb" data-toggle="popover" data-placement="left" tabindex="0" data-trigger="focus" aria-hidden="true" onclick="typeindividual('rcount');"> 
							<span>Rejected</span>
							<span class="anl_value rejected_count"> 0 </span>   
						</li>
						<li class="anlat_bb" data-toggle="popover" data-placement="left" tabindex="0" data-trigger="focus" aria-hidden="true" onclick="typeindividual('pcount');"> <span>Pending</span>
							<span class="anl_value pending_count"> 0 </span>   
						</li>
					</ul>
				</div> 
			</div>
		</div>

			<div class="laon_tbl tp_loan_tbl"> 
                <div class="">                
					<div class="res_tbl">
						<table id="loan_lst_tbl_pend" class="table table-striped table-bordered" style="width:100%">
							<thead>    
								<tr>
									<th class="tbl_check" data-toggle="popover" data-placement="right" tabindex="0" data-trigger="focus" aria-hidden="true"> <input type="checkbox" onclick="stopPropagation(event);"> </th>
									<th class="id_td"> Loan Id </th>
									<th class="app_date"> Date 
										<span class="sts_pp">
											<i class="fa fa-filter" aria-hidden="true" style="font-size: 9px;"></i>   
										</span>
										<div class="sts_fil_blk">
											<div class="form-check">
												<input class="form-check-input" type="radio" name="month_opt" value="" id="all" checked />
												<label class="form-check-label" for="this_mnt">All</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="radio" name="month_opt" value="m" id="this_mnt" />
												<label class="form-check-label" for="this_mnt">This Month</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="radio" name="month_opt" value="1m" id="last_mont">
												<label class="form-check-label" for="last_mont">Last Month</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="radio" name="month_opt" value="3m" id="last_3mont">
												<label class="form-check-label" for="last_3mont">Last 3 Months</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="radio" name="month_opt" value="6m" id="last_6mon">
												<label class="form-check-label" for="last_6mon">Last 6 Months</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="radio" name="month_opt" value="1y" id="one_year">
												<label class="form-check-label" for="one_year">1 Year</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="radio" name="month_opt" value="custom" id="choos_date">
												<label class="form-check-label" for="choos_date">Choose Date</label>
											</div>
											<div class="form-group cdate" style="display:none;">
												<input type="text" id="from_date" name="from_date" class="form-control" placeholder="From date" />
												<input type="text" id="to_date" name="to_date" class="form-control" placeholder="To date" />
												<button class="btn btn-primary" id="custom_date">Search</button>
											</div>
											
										</div>
									</th>
									<th> User Name </th>
									<th class="crp_loc"> Crop Location </th>
									<th > Transfer Type 
										<span class="sts_pp">
											<i class="fa fa-filter" aria-hidden="true" style="font-size: 9px;"></i>   
										</span>
										<div class="sts_fil_blk"> 
											<div class="form-check">
												<input class="form-check-input" type="radio" name="trans_opt" value="" id="tarns_bank" checked />
												<label class="form-check-label" for="tarns_bank">All</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="radio" name="trans_opt" value="bank" id="tarns_bank">
												<label class="form-check-label" for="tarns_bank">Bank</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="radio" name="trans_opt" value="cash" id="tarns_cash">
												<label class="form-check-label" for="tarns_cash">Cash</label>
											</div>
										</div>
									</th>
									<th class="loan_type_td"> Loan Type
										<span class="sts_pp">
											<i class="fa fa-filter" aria-hidden="true" style="font-size: 9px;"></i>   
										</span>
										<div class="sts_fil_blk"> 
											<div class="form-check">
												<input class="form-check-input" type="radio" name="loan_opt" value="" id="croploan" checked />
												<label class="form-check-label" for="croploan">All</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="radio" name="loan_opt" value="1" id="croploan">
												<label class="form-check-label" for="croploan">Crop Loan</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="radio" name="loan_opt" value="2" id="harvest">
												<label class="form-check-label" for="harvest">Harvest Advance</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="radio" name="loan_opt" value="3" id="ploan">
												<label class="form-check-label" for="ploan">Personal Loan</label>
											</div>
										</div>
									</th>
									<th class="loan_amnt"> Loan Amount </th>
									<th class="stat_blk txt_cnt"> Status 
										<span class="sts_pp">
											<i class="fa fa-filter" aria-hidden="true" style="font-size: 9px;"></i>   
										</span>
										<div class="sts_fil_blk">        
											<div class="trd_lst">
												<div class="form-check">
													<input class="form-check-input" type="checkbox" name="status_opt" value="1" id="sta1">
													<label class="form-check-label" for="sta1">Completed</label>
												</div>
												<div class="form-check">
													<input class="form-check-input" type="checkbox" name="status_opt" value="2" id="sta2">
													<label class="form-check-label" for="sta2">Rejected</label>
												</div>
											</div>
										</div>
									</th>
								<th class="act_ms"> Action </th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End loan -->
  
<div class="modal" id="delete_loan">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<h1> Are You Sure ! </h1>
				<p> You want Remove This Loan ? </p>
			</div>
			<div class="modal_footer">
				<button type="button" class="btn btn-primary del_yes" data-dismiss="modal" >Yes</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
			</div>
		</div>
	</div>
</div>

<div id="rej_loan" role="dialog" class="modal fade"> 
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="pp_clss" data-dismiss="modal"> <i class="fa fa-times" aria-hidden="true"></i> </div>
			<h1 class="man_btm_15"> Reason For Reject </h1>
			<div class="cre_inp">
				<div class="sm_blk"> Reject Reason </div>
				<input type="text" class="form-control" placeholder="">
			</div>
			<button class="btn btn-primary"> Reject </button>
		</div>
	</div>
</div>

<div id="apr_loans" role="dialog" class="modal fade"> 

	<div class="modal-dialog">
		<div class="modal-content">
			<div class="pp_clss" data-dismiss="modal"> <i class="fa fa-times" aria-hidden="true"></i> </div>
			<h1 class="mar_Btm_20"> Bulk Approval </h1>

			<div class="blk_up_blk">
				<div class="blk_rt_blk">
					<div class="bnk_dl_pp">
						<div class="check_wt_serc us_bn_ls"> 
							<div class="show_va"> Select Admin Bank </div>
							<div class="selectVal">  Select Admin Bank </div>
							
						</div>
					</div>
				</div>
				<ul class="lns_sub_blk">
					<li class="anlat_bb"> 
						<span class="anl_value sel_users_num">0</span>
						<span> No.of users selected </span>                
					</li>
					<li class="anlat_bb"> 
						<span class="anl_value tot_pend_amt"> ₹0 </span>
						<span>Total loan amount </span>
					</li>        
				</ul>
				<div class="pp_note"> 
					<textarea rows="4" placeholder="Add Note"></textarea>
				</div>
				<div class="pop_footer">
					<div class="ad_nt blue_text"> Add Note </div>
					<button type="button" class="btn btn-primary" data-dismiss="modal">Approve All</button>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="apr_loan" role="dialog" class="modal fade"> 
	<div class="modal-dialog">
		<div class="modal-content ui-front">
			<div class="pp_clss" data-dismiss="modal"> <i class="fa fa-times" aria-hidden="true"></i> </div>
			<h1> Loan Approve <i class="fa fa-edit edt_bl_lnk" aria-hidden="true"></i> </h1>
			<form id="loanfrm_edit" name="loanfrm_edit" action="javascript:void(0);" method="post">
			<div class="po_Rel">
			
				<ul class="assign_type"> 
					<div class="ds_as_type show_blk"></div>   
					<li class="act_type ban_trns_edit lnk_typ">      
						<img src="http://3.7.44.132/aquacredit/assets/images/bank_tansfer.png">
						<input type="radio" name="act_types_edit" value="bank" checked />
						<span> Bank Transfer </span>
					</li>
					<li class="cash_trns_edit lnk_typ"> 
						<img src="http://3.7.44.132/aquacredit/assets/images/cash_icn.png">
						<input type="radio" name="act_types_edit" value="cash" />
						<span> Cash </span>
					</li>

				</ul>
			</div>
			<div class="app_pop_tbl disb_sel"> 
				<div class="row_blk"> 
					 <div class="row_left"> 
						<div class="cre_inp inp_ss inpt_fnt_blk">
							<div class="sm_blk"> User Name / Mobile </div>
							<input type="text" class="form-control" id="skey_edit" name="skey_edit" Placeholder="User Name / Mobile" />
							<input type="hidden" class="form-control" id="selectuser_id_edit" name="selectuser_id_edit" value="" />
							<input type="hidden" class="form-control" id="select_usercode_edit" name="select_usercode_edit" value="" />
						</div>
						<label id="skey_edit-error" class="error" for="skey_edit"></label>
					</div>
					<div class="row_right sel_loc_edit"> 
						<div class="check_wt_serc val_seld"> 
							<div class="show_va"> Crop location </div>
							<div class="selectVal crop_val"> Crop location </div>
							<ul class="check_list">					
								<li id="crop_opt_li_edit"> 
									<div class="form-check">
										<input class="form-check-input" type="radio" name="crop_opt_edit" id="cp1" />
									</div>
								</li>
							</ul>							
						</div>
						<label id="crop_opt_edit-error" class="error" for="crop_opt_edit"></label>
					</div>
				</div>

				<div class="row_blk"> 
					<div class="row_left us_bn_ls lon_typ_edit"> 
						<div class="check_wt_serc val_seld"> 
							<div class="show_va"> Select User Bank </div>
							<div class="selectVal bank_val"> Select User Bank </div>
							<ul class="check_list"> 
								<li id="bank_opt_li_edit"> 
									<div class="form-check">
										<input class="form-check-input" type="radio" name="bank_opt_edit" id="bnsk1" />							
									</div>
								</li>
							</ul>							
						</div>
						<label id="bank_opt_edit-error" class="error" for="bank_opt_edit"></label>
					</div>
					<div class="row_right"> 
						<div class="cre_inp inp_ss inpt_fnt_blk">
							<div class="sm_blk"> Loan Amount </div>
							<input type="text"  id="loan_amt_commas_edit" name="loan_amt_commas_edit"  class="form-control noalpha" value="" onkeyup="amount_with_commas('edit');">
							<input type="hidden"  id="loan_amt_edit" name="loan_amt_edit" maxlength="8" class="form-control allownumericwithdecimal" value="">
							<span class="amon_text_edit" id="myDIV" style="display:none;">  </span> 
						</div>
						<label id="loan_amt_commas_edit-error" class="error" for="loan_amt_commas_edit"></label>
					</div>
				</div>
			</div>
			<!-- <div class="text-right"><button type="submit" class="btn btn-primary updt_btn">Update</button><hr/></div>
			</form>
			
			<form id="loanfrm_cnf" name="loanfrm_cnf" action="javascript:void(0);" method="post"> -->
			<div class="row_blk"> 
				<div class="row_left adm_bn_ls"> 
					<div class="check_wt_serc"> 
						<div class="show_va"> Select Admin Bank </div>
						<div class="selectVal admin_bank_val"> Select Admin Bank </div>
						<ul class="check_list" id="admin_bank_ul">
							<li id="admin_bank_li"> 
								<div class="form-check">
									<input class="form-check-input" type="radio" name="admin_bank" id="admin_bank" value="">									
								</div>
							</li>
						</ul>							
					</div>
					<label id="admin_bank-error" class="error" for="admin_bank"></label>
				</div>
				<div class="row_right"> 
					<div class="check_wt_serc us_bn_ls"> 
						<div class="show_va"> Loan Type</div>
						<div class="selectVal loan_type_val"></div>
						<ul class="check_list"> 
							<li id="loan_type_li"> 
								<div class="form-check">
									<input class="form-check-input" type="radio" name="loan_type" id="loan_type" value="">									
								</div>								
							</li>
						</ul>
					</div>
					<label id="loan_type-error" class="error" for="loan_type"></label>
				</div>
			</div>

			<div class="row_blk"> 
				<div class="row_left form-group"> 
					<div class="cre_inp">					
						<div class="sm_blk"> Start Date </div>						
						<input type="text" class="form-control datepicker" id="start_date" name="start_date" />					
					</div>
					<label id="start_date-error" class="error" for="start_date"></label>
				</div>
				<div class="row_right form-group"> 
					<div class="cre_inp">
						<div class="sm_blk"> End Date </div>						
						<input type="text" class="form-control" id="end_date" name="end_date" />						
					</div>
					<label id="end_date-error" class="error" for="end_date"></label>
				</div>
			</div>    
			<div class="row_blk"> 
				<div class="row_left form-group"> 
					<div class="cre_inp">
						<div class="sm_blk"> ROI </div>						
						<input type="text" class="form-control allownumericwithdecimal" id="roi" name="roi"  min="0" max="100" value="">						
					</div>
					<label id="roi-error" class="error" for="roi"></label>
				</div>
				<div class="row_right form-group"> 
					<div class="cre_inp">
						<div class="sm_blk"> Reference Number </div>						
						<input type="text" class="form-control" id="ref_no" name="ref_no" value="">		
					</div>
					<label id="ref_no-error" class="error" for="ref_no"></label>
				</div>
			</div>

			<div class="pp_note"> 
				<textarea rows="4" id="rema_narr" name="rema_narr" placeholder="Add Note"></textarea>
			</div>
			<div class="ad_nt blue_text"> Add Note </div>
			<div class="pop_footer">
				
				<button type="button" class="btn btn-success approv_btn" >Confirm Loan</button>
				<button type="button" class="btn btn-danger rej_btn" data-dismiss="modal">Reject</button>
				<button type="submit" class="btn btn-primary updt_btn" >Update</button>
				
				<input type="hidden" id="hid_lid" name="hid_lid" />
				<input type="hidden" id="hid_crop_id" name="hid_crop_id" value="" />
				<input type="hidden" id="hid_bank_id" name="hid_bank_id" value="" />
				<input type="hidden" id="hid_tabval" name="hid_tabval" value="0" />			
				<input type="hidden" id="hid_appove" name="hid_appove" value="0" />			
				<input type="hidden" id="hid_acivity_id" name="hid_acivity_id" value="0" />			
				<input type="hidden" id="hid_chkbal" name="hid_chkbal" value="0" />			
				<input type="hidden" id="hid_user_type" name="hid_user_type" value="" />			
			</div>
			</form>
			
		</div>
	</div>
</div>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/swiper.min.js" type="javascript"></script>
<script src="<?php echo base_url();?>assets/js/fstdropdown.js"></script>
<script type="text/javascript">
//https://makitweb.com/jquery-ui-autocomplete-with-php-and-ajax/
//https://datatables.net/examples/api/multi_filter.html
var url = '<?php echo base_url()?>';
</script>
<script src="<?php echo base_url();?>assets/js/loan_main.js"></script>
<div id="popover-content" style="display: none">
	<div class="custom-popover">
		<ul class="list-group">
			<li class="list-group-item edt">Edit</li>
			<li class="list-group-item del">Delete</li>
		</ul>
	</div>
</div>

<div id="popover-tbl" style="display: none">
	<div class="custom-popover">
		<ul class="list-group">
			<li class="list-group-item appr_all">Approve All</li>
		</ul>
	</div>
</div>
  
<div id="popover-contents" style="display: none">
	<div class="custom-popover">
		<ul class="list-group">
			<li class="list-group-item edt green_txt">Edit</li>
			<!--    <li class="list-group-item reject_loan">Reject</li> -->
			<li class="list-group-item  reject_loan del">Delete</li>
		</ul>
	</div>
</div>
<div id="popover-ana" style="display: none">
	<div class="custom-popover">
		<ul class="list-group loan_type_pop">			
		</ul>
	</div>
</div>
<?php require_once 'footer.php' ; ?>