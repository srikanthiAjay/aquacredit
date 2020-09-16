<?php require_once 'header.php' ; ?>
<link href="<?php echo base_url();?>assets/css/payments.css" type="text/css" rel="stylesheet">
<script src='https://kit.fontawesome.com/a076d05399.js'></script> 
<?php require_once 'sidebar.php' ; ?>		
<link href="<?php echo base_url();?>assets/css/snackbar.css" type="text/css" rel="stylesheet">
<style>
/*.res_tbl table{ min-width: 0px !important;} */
.note_txt {
    width: 100%;
    height: 60px;
    font-weight: 13px;
    padding: 10px;
    box-sizing: border-box;
    border: 1px solid #ced4da;
    border-radius: 5px;
    outline: none;
}
.tooltip{
	opacity:0.7 !important;
	z-index:99999;
}
</style>
<div class="right_blk"> 
	<div class="top_ttl_blk"> <span> Receipts </span></div>
	<div class="trd_cr_r">
	<!-- create loan -->
		<div class="row loan_top">
			<div class="col-md-10">
				<div class="loan_create card_view">
					<div class="crt_blk"> 
						<div class="create_loan_module show_blk">
							<div id="snackbar" class=""></div>
							<div id="snackbar_succ" class=""></div>
							<form action="javascript:void(0);" id="receipt_frm" name="receipt_frm" method="post" >
 							<div class="row">
								<div class="col-md-5 bnk_sel">
									<ul class="assign_type">    
										<li class="act_type ban_trns lnk_typ">
											<img src="http://3.7.44.132/aquacredit/assets/images/bank_tansfer.png">
											<input type="radio" name="trans_type" value="bank" checked />
											<span> Bank </span>
										</li>
										<li class="cash_trns lnk_typ"> 
											<img src="http://3.7.44.132/aquacredit/assets/images/cash_icn.png">
											<input type="radio" name="trans_type" value="cash" />
											<span> Cash </span>
										</li>
									</ul>
									<input type="hidden" name="selected_type" id="selected_type" value="BANK">
								</div>
								<div class="col-md-2 trn_type"> 
									<input type="checkbox" />
									<a href="javascript:void(0);" title="" class="show_grn"> <img src="http://3.7.44.132/aquacredit/assets/images/grn_ar.png" alt="" title=""> </a>
									<a href="javascript:void(0);" title="" class="show_rd"> <img src="http://3.7.44.132/aquacredit/assets/images/rd_ar.png" alt="" title=""> </a>
								</div>
								<div class="col-md-5 usr_radio"> 
									<ul class="assign_type">  
										<li class="act_type usr_icn lnk_typ">      
											<img src="http://3.7.44.132/aquacredit/assets/images/users_icn.png">
											<input type="radio" name="user_type" value="user" checked />
											<span> Users </span>
										</li>
										<li class="lnk_typ trd_icn"> 
											<img src="http://3.7.44.132/aquacredit/assets/images/traders.png">
											<input type="radio" name="user_type" value="trader" />
											<span> Traders </span>
										</li>
										<!-- <li class="lnk_typ brd_icn">
											<img src="http://3.7.44.132/aquacredit/assets/images/bank_tansfer.png">
											<input type="radio" name="act_types">
											<span> Brands </span>
										</li> -->
									</ul>
								</div>
							</div>

							<div class="row">
								<div class="col-md-5 adm_selt">
									<ul>
										<li class="date_with">
											<div class="cre_inp">
												<div class="sm_blk"> Receipt Date </div>
												<input type="text" class="form-control mykey" id="receipt_date" name="receipt_date" placeholder="" data-original-title="" readonly title="">
											</div>
										</li>
										<li class="bank_with" id="bank_block">
											<div class="check_wt_serc us_bn_ls"> 
												<div class="show_va"> Select Bank </div>
												<div class="selectVal admin_bank_val">  Select Bank </div>
												<ul class="check_list admin_bank mykey"> 
													<li id="admin_bank_li"> 
														<div class="form-check">
															<input class="form-check-input mykey" type="radio" name="admin_bank" id="admbnk" value=""/>									
														</div>
													</li>
												</ul>
											</div>
										</li>

										<li class="date_with"> 
											<div class="cre_inp mykey">
												<div class="sm_blk"> Ref. no </div>
												<input type="text" id="ref_no" name="ref_no" class="form-control" data-original-title="" title="">
											</div>
										</li>
										<li class="not_li bank_with note_blk"> 
											<textarea style="display: inline-block;" placeholder="Note" class="note_txt mykey" name="rece_note" id="rece_note"></textarea>
										</li>
									</ul>
								</div> 
								<div class="col-md-2 cnt_amn_blk">
									<ul>
										<li class="create_li amnt">
											<div class="cre_inp">
												<div class="sm_blk"> Amount </div>
												<input type="text" id="receipt_amt_commas" name="receipt_amt_commas" class="form-control noalpha mykey" onkeyup="amount_with_commas('add');" />
												
												<input type="hidden" id="receipt_amt" name="receipt_amt" class="form-control allownumericwithdecimal" value="">
												<div class="amon_text"></div>
											</div>
										</li>
									</ul>
								</div>   
								<div class="col-md-5 usr_selt">
									<ul class="create_ul ">     
										<li class="create_li">
											<div class="cre_inp">
												<div class="sm_blk uname_val"> User Name / Mobile </div>
												<input type="text" class="form-control mykey" id="skey" name="skey" autocomplete="off" />
												<input type="hidden" class="form-control" id="selectuser_id" name="selectuser_id" />
												<input type="hidden" class="form-control" id="select_usercode" name="select_usercode" />
												<input type="hidden" class="form-control" id="select_usertype" name="select_usertype" />
												<input type="hidden" class="form-control" id="select_guest" name="select_guest" />
											</div>
											<label id="skey-error" class="error" for="skey"></label>
										</li>

										<li class="create_li slc_usr sel_loc">
											<div class="check_wt_serc "> 
												<div class="show_va">Crop location</div>
												<div class="selectVal cval">  Crop location </div>
												<ul class="check_list crop_opt mykey"> 
													<li id="crop_opt_li">
														<div class="form-check">
														  <input class="form-check-input" type="radio" name="crop_opt" id="crop_opt" />
														  <label class="form-check-label" for="crp"></label>
														</div>
													</li>
												</ul>
											</div>
										</li>
										<li class="create_li guest_block"> 
											<div class="cre_inp inp_ss">
												<div class="sm_blk"> Mobile </div>
												<input type="text" id="guest_mob" name="guest_mob" class="form-control" disabled />
											</div>
										</li>
										<li style="float: right; padding-right: 0px; padding-left: 5px;"> <button type="submit" class="btn btn-primary rec_sen_btn"> Receive Now  </button> </li>
									</ul>
								</div>              
							</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-2 cl_md_2">
				<div class="card_view actvty">
					<h1 class="create_hdg"> Analytics </h1>
					<ul class="lns_sub_blk"> 
						<li class="anlat_user" data-toggle="popover" data-placement="left" tabindex="0" data-trigger="focus" aria-hidden="true"> 
							<span>Total User Receipts </span> 
							<span class="anl_value tot_user_amt"> ₹0 </span>
						</li>
						<li class="anlat_trader" data-toggle="popover" data-placement="left" tabindex="0" data-trigger="focus" aria-hidden="true"> 
							<span>Total Trader Receipts </span> 
							<span class="anl_value tot_trader_amt"> ₹0  </span>
						</li>
					</ul>
				</div> 
			</div>
		</div>

		<div class="laon_tbl tp_loan_tbl"> 
            <div class="">                
                <div class="res_tbl">
					<div class="dateEle" ></div>
					<table id="loan_lst_tbl_pend" class="table table-striped table-bordered" style="width:100%">
						<thead>    
							<tr>
								<th class="id_td"> Id </th>
								<th class="app_date"> Date 
									<span class="pull-right" id="reportrange">
										<i class="fa fa-filter"  aria-hidden="true" style="font-size: 9px;"></i> 
										<span></span>
									</span>
									<input type="hidden" id="date_val" name="date_val" />
								</th>
								<th class=""> Name </th>
								<th class="usr_type_txt" > User Type 
									<span class="sts_pp">
											<i class="fa fa-filter" aria-hidden="true" style="font-size: 9px;"></i>   
										</span>
										<div class="sts_fil_blk rad_btns"> 
											
												<label class="form-check-label radio_blk checkd" for="utype_all">
												<input class="form-check-input" type="radio" name="user_type_opt" value="" id="utype_all" checked />
												All</label>
										
											
												<label class="form-check-label radio_blk utypes" for="utype_f">
												<input class="form-check-input" type="radio" name="user_type_opt" value="farmer" id="utype_f">
												Farmer</label>
										
										
												<label class="form-check-label radio_blk utypes" for="utype_nf">
												<input class="form-check-input" type="radio" name="user_type_opt" value="non_farmer" id="utype_nf">
												Non Farmer</label>
										
										
												<label class="form-check-label radio_blk utypes" for="utype_d">
												<input class="form-check-input" type="radio" name="user_type_opt" value="dealer" id="utype_d">
												Dealer/Sub-Dealer</label>

												<label class="form-check-label radio_blk utypes" for="utype_g">
												<input class="form-check-input" type="radio" name="user_type_opt" value="guest" id="utype_g">
												Guest</label>										
											
												<label class="form-check-label radio_blk ttypes" for="ttype_a">
												<input class="form-check-input" type="radio" name="user_type_opt" value="agent" id="ttype_a">
												Agent</label>
										
											
												<label class="form-check-label radio_blk ttypes" for="ttype_e">
												<input class="form-check-input" type="radio" name="user_type_opt" value="exporter" id="ttype_e">
												Exporter</label>
											
										</div>
								</th>							
								<th class="loan_amnt"> Amount </th>
								<th class="pmnt_blk txt_cnt" > Transfer Type 
									<span class="sts_pp">
										<i class="fa fa-filter" aria-hidden="true" style="font-size: 9px;"></i>   
									</span>
									<div class="sts_fil_blk rad_btns"> 
											<label class="form-check-label radio_blk checkd" for="tarns_all">
											<input class="form-check-input" type="radio" name="trans_opt" value="" id="tarns_all" checked />
											All</label>
										
											<label class="form-check-label radio_blk" for="tarns_bank">
											<input class="form-check-input" type="radio" name="trans_opt" value="bank" id="tarns_bank">
											Bank</label>
										
											<label class="form-check-label radio_blk" for="tarns_cash">
											<input class="form-check-input" type="radio" name="trans_opt" value="cash" id="tarns_cash">
											Cash</label>
										
									</div>
								</th>
								<th class="pmnt_blk txt_cnt"> Payment Type 
									<!-- <span class="sts_pp">
										<i class="fa fa-filter" aria-hidden="true" style="font-size: 9px;"></i>   
									</span>
									<div class="sts_fil_blk">        
										<div class="trd_lst">
											<div class="form-check">
												<input class="form-check-input" type="checkbox" name="optradio" value="" id="sta1">
												<label class="form-check-label" for="sta1">
												Completed
												</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="checkbox" name="optradio" value="" id="sta2">
												<label class="form-check-label" for="sta2">
												Pending
												</label>
											</div>
										</div>
									</div> -->
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
 
<div class="modal" id="delete_user">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<h1> Are You Sure ! </h1>
				<p> You want Remove This Receipt ? </p>
			</div>
			<div class="modal_footer">
				<button type="button" class="btn btn-primary del_yes" data-dismiss="modal">Yes</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
			</div>
		</div>
	</div>
</div>

<!-- Submit Confirmation -->
<div class="modal" id="cnf_rec">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<h1> Are You Sure ! </h1>
				<p> We can't change later, You want to Proceed ? </p>
			</div>
			<div class="modal_footer">
				<button type="button" class="btn btn-primary cnf_yes" data-dismiss="modal">Yes</button>
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

<div id="apr_loan" role="dialog" class="modal fade"> 
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="pp_clss" data-dismiss="modal"> <i class="fa fa-times" aria-hidden="true"></i> </div>
			<h1> Receipts <span id="edit_id"></span><!-- <i class="fa fa-edit edt_bl_lnk" aria-hidden="true"></i> --></h1>
			<form id="receiptfrm_edit" name="receiptfrm_edit" action="javascript:void(0);" method="post">
				<div class="po_Rel">
					<div class="row">
						<div class="col-md-4 bnk_sel">
							<ul class="assign_type"> 
								<div class="ds_as_type show_blk"></div>   
								<li class="act_type ban_trns_edit lnk_typ">      
									<img src="http://3.7.44.132/aquacredit/assets/images/bank_tansfer.png">
									<input type="radio" name="trans_type_edit" value="bank" />
									<!-- <span> Bank Transfer </span> -->
								</li>
								<li class="cash_trns_edit lnk_typ"> 
								  <img src="http://3.7.44.132/aquacredit/assets/images/cash_icn.png">
								  <input type="radio" name="trans_type_edit" value="cash" />
								  <!-- <span> Cash </span> -->
								</li>

							</ul>
						</div>
						<div class="col-md-3 trn_type"> 
							<a href="#" title=""> <img src="http://3.7.44.132/aquacredit/assets/images/grn_ar.png" alt="" title=""> </a>
							<!-- <a href="#" title=""> <img src="http://3.7.44.132/aquacredit/assets/images/rd_ar.png" alt="" title=""> </a> -->
						</div>
						<div class="col-md-5 us_tpy"> 
							<ul class="assign_type"> 
								<div class="ds_as_type show_blk"></div>   
								<li class="usr_icn_edit lnk_typ">
									<img src="http://3.7.44.132/aquacredit/assets/images/users_icn.png">
									<input type="radio" name="user_type_edit" value="user" />
									<!-- <span> Bank Transfer </span> -->
								</li>
								<li class="trd_icn_edit lnk_typ"> 
									<img src="http://3.7.44.132/aquacredit/assets/images/traders_large.png">
									<input type="radio" name="user_type_edit" value="trader" />
									<!-- <span> Cash </span> -->
								</li>
							</ul>
						</div>
					</div>            
				</div>
				<div class="app_pop_tbl disb_sel"> 
					<div class="row_blk" style="margin-top: 20px;">		
						<div class="row_left"> 
							<div class="cre_inp inp_ss">
								<div class="sm_blk"> Receipt Date </div>
								<input type="text" id="receipt_date_edit" name="receipt_date_edit" class="form-control" value="" />
							</div>
						</div>
						<div class="row_right"> 
							<div class="cre_inp inp_ss inpt_fnt_blk">
								<div class="sm_blk uname_val_edit"> User Name </div>
								<input type="text" class="form-control" id="skey_edit" name="skey_edit"  />
								<input type="hidden" class="form-control" id="selectuser_id_edit" name="selectuser_id_edit" value="" />
								<input type="hidden" class="form-control" id="select_usercode_edit" name="select_usercode_edit" value="" />
							</div>
							<label id="skey_edit-error" class="error" for="skey_edit"></label>
						</div>  
						<div class="row_blk"> 
							<div class="row_left guest_block_edit"> 
								<div class="cre_inp inp_ss">
									<div class="sm_blk"> Mobile </div>
									<input type="text" id="guest_mob_edit" name="guest_mob_edit" class="form-control" disabled />
								</div>
							</div>
							<div class="row_left sel_loc_edit"> 
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
		
							<div class="row_right"> 
								<div class="cre_inp inp_ss inpt_fnt_blk">
									<div class="sm_blk"> Transfer Amount </div>
									<input type="text"  id="receipt_amt_commas_edit" name="receipt_amt_commas_edit"  class="form-control noalpha" value="" onkeyup="amount_with_commas('edit');">
									<input type="hidden"  id="receipt_amt_edit" name="receipt_amt_edit" class="form-control allownumericwithdecimal" value="">
									<span class="amon_text_edit" id="myDIV" style="display:none;">  </span> 
								</div>
								<label id="loan_amt_commas_edit-error" class="error" for="loan_amt_commas_edit"></label>
							</div>
						</div>
					</div>
					<div class="row_blk"> 					
						<div class="row_left"> 
							<div class="cre_inp inp_ss inpt_fnt_blk">
								<div class="sm_blk"> Admin Account </div>
								<input type="text"  id="admin_bank_edit" name="admin_bank_edit"  class="form-control noalpha" value="">
							</div>
							<!-- <div class="check_wt_serc val_seld">								
								<div class="show_va"> Select Admin Bank </div>
								<div class="selectVal admin_bank_val_edit"> Select Admin Bank </div>
								<ul class="check_list" id="admin_bank_ul">
									<li id="admin_bank_li_edit"> 
										<div class="form-check">
											<input class="form-check-input" type="radio" name="admin_bank_edit" id="admin_bank_edit" value="">									
										</div>
									</li>
								</ul>							
							</div>
							<label id="admin_bank_edit-error" class="error" for="admin_bank_edit"></label> -->
						</div>

						<div class="row_right"> 
							<div class="cre_inp inp_ss">
								<div class="sm_blk"> Reference Number </div>
								<input type="text" id="ref_no_edit" name="ref_no_edit" class="form-control" value="" />
							</div>
						</div>
					</div>
					<div class="pop_footer">
						<div class="note_blk sh_nt"> 
							<textarea id="rece_note_edit" name="rece_note_edit" class="note_txt" disabled ></textarea>
						</div>
						<!-- <button type="button" class="btn btn-success approv_btn" data-dismiss="modal">Pay Now</button> 
						<button type="submit" class="btn btn-primary updt_btn" data-dismiss="modal">Update</button>
						 -->
						 <input type="hidden" id="hid_rc_id" name="hid_rc_id" value="" />
						 <input type="hidden" id="hid_tabval" name="hid_tabval" value="0" />
						 <input type="hidden" id="hid_crop_id" name="hid_crop_id" value="" />
					</div> 
				</div>
			</form>
		</div>
	</div>
</div>

<div id="popover-content" style="display: none">
	<div class="custom-popover">
		<input type="hidden" id="r_id">
		<ul class="list-group">
			<li class="list-group-item edt">View</li>
			<li class="list-group-item del">Delete</li>
		</ul>
	</div>
</div>

<!--   <div id="popover-tbl" style="display: none">
  <div class="custom-popover">
  <ul class="list-group">
    <li class="list-group-item appr_all">Approve All</li>
  </ul>
</div>
</div> -->

<div id="popover-contents" style="display: none">
	<div class="custom-popover">
		<ul class="list-group">
			<li class="list-group-item edt green_txt">Edit</li>
			<li class="list-group-item  reject_loan del">Delete</li>
		</ul>
	</div>
</div>

<div id="popover-ana_usr" style="display: none">
	<div class="custom-popover">
		<ul class="list-group">
			<li class="list-group-item">Farmers
			  <span class="blue_text f_amt"> ₹0 </span></li>
			<li class="list-group-item">Dealers
			  <span class="blue_text dl_amt"> ₹0 </span></li>
			<li class="list-group-item">Non-Farmers
			  <span class="blue_text nf_amt"> ₹0 </span></li>
			<li class="list-group-item">Guest Sales
			  <span class="blue_text g_amt"> ₹0 </span></li>
		</ul>
	</div>
</div>

<div id="popover-ana_trd" style="display: none">
	<div class="custom-popover">
		<ul class="list-group">
			<li class="list-group-item">Agents <br/>
			  <span class="blue_text ag_amt"> ₹0 </span></li>
			<li class="list-group-item">Exporters <br/>
			  <span class="blue_text exp_amt"> ₹0 </span></li>
		</ul>
	</div>
</div>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/swiper.min.js" type="javascript"></script>
<script type="text/javascript">
var url = '<?php echo base_url()?>';
</script>
<script src="<?php echo base_url();?>assets/js/receipts.js"></script>
<?php require_once 'footer.php' ; ?>