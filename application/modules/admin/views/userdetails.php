<?php require_once 'header.php';?>
<link href="<?php echo base_url(); ?>assets/css/user_detials.css" type="text/css" rel="stylesheet">
<script src='https://kit.fontawesome.com/a076d05399.js'></script> 
<?php require_once 'sidebar.php';?>   

<div class="right_blk">
	<div class="top_ttl_blk"> 
		<span> <b><?php echo $user["user_name"]; ?> </b> Transactions - #<?php echo $user["user_code"]; ?> </span>         
    	<a href="javascript:void(0);" id="print_transaction"  title="" class="btn ed_usr btn-primary fr"> Print </a>
  	</div>

	<div class="sale_rt">
		<div class="det_view">
			<input type="checkbox"> 
			<p> Detailed View</p>
			<div class="swith_blk"> 
			<!-- <span> No </span> -->
			</div>
		</div>
  		<div class="dvder"> </div>
		<ul class="crd_aval_cr"> 
			<li> <div class="li_lft_blk"> Credit Limit </div> <div class="li_rt_blk"> <?php echo '₹' . number_format($user["credit_limit"], 2); ?> </div> </li>
			<li> <div class="li_lft_blk"> Available Credit </div> <div class="li_rt_blk"> <?php echo '₹' . number_format($available_credit, 2); ?> </div> </li>
		</ul>
  		<div class="dvder"> </div>
		<div class="main_anal">
			<h2 class="create_hdg"> Analytics - <span id="crop_count"></span> </h2>
			<ul class="anl_tcs">
				<li class="bor_lf_none"> 
					<div class="top_in_op crop_top">
						<p>Loan </p> 
						<h1> <?php echo '₹' . number_format($totalLoan, 2); ?> </h1>
					</div>
				</li>
				<li class="bor_lf_none"> 
					<div class="top_in_op crop_top">
						<p>Orders </p> 
						<h1> <?php echo '₹' . number_format($totalOrders, 2); ?> </h1>
					</div>
				</li>
				<li class="bor_lf_none"> 
					<div class="top_in_op crop_top">
						<p>Harvest </p> 
						<h1> ₹<?php echo number_format($totalHarvest, 2); ?> </h1>
					</div>
				</li>
				<li class="bor_lf_none"> 
					<div class="top_in_op crop_top">
						<p>Acres </p> 
						<h1> <?php echo number_format($totalAcres, 2); ?> </h1>
					</div>
				</li>  
			</ul>     
		</div>
		<div class="rt_btm">
			<button id="setacnt" class="btn btn-primary stl_trn_his" data-toggle="modal" data-target="#settl_amnt" onclick="getlloandata();" >Settle Account </button>
			<button class="btn btn-primary stl_trn_his gtot_withdrawal" data-toggle="modal" data-target="#bal_wthdr">Balance Withdrawal </button>
		</div>
	</div>

	<div class="modal fade" id="bal_wthdr" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content ">
				<div class="pp_clss" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></div>
				<div class="bal_wth_pp">
					<form action="javascript:void(0);" id="wth_drw_frm" name="wth_drw_frm" method="post">
						<div class="pop_hdr"> <h1 class="create_hdg"> Balance Withdrawal </h1> </div>
						<div class="top_in_op crop_top">
							<p> Available Balance </p> 
							<h1 class="bal_draw"> ₹0 </h1>
						</div>
						<div class="po_Rel">      
							<ul class="assign_type">   
								<li class="lnk_typ act_type" id="ban_trns">      
									<img src="http://3.7.44.132/aquacredit/assets/images/bank_tansfer.png" class="mCS_img_loaded">
									<input type="radio" name="act_types" value="bank" checked="">
									<span> Bank Transfer </span>
								</li>
								<li class="lnk_typ" id="cash_trns"> 
									<img src="http://3.7.44.132/aquacredit/assets/images/cash_icn.png" class="mCS_img_loaded">
									<input type="radio" name="act_types" value="cash">
									<span> Cash </span>
								</li>
								<li class="lnk_typ" id="crop_trns"> 
									<img src="http://3.7.44.132/aquacredit/assets/images/share_crop.png" class="mCS_img_loaded">
									<input type="radio" name="act_types" value="crop">
									<span> Crop Transfer </span>
								</li>
								<li class="lnk_typ" id="user_trns"> 
									<img src="http://3.7.44.132/aquacredit/assets/images/users_icn.png" class="mCS_img_loaded">
									<input type="radio" name="act_types" value="user">
									<span> User Transfer </span>
								</li>
							</ul>

							<div class="bnk_trnk_blk"> 
								<ul class="trans_inf bnk_tr"> 
									<li class="create_li date">
										<div class="cre_inp inp_ss">
											<div class="sm_blk"> Date </div>
											<input type="text" class="form-control mykey" placeholder="" data-original-title="" id="drawal_date" title="">
										</div>
									</li>
									
									<li id="cash_block">
										<div class="check_wt_serc"> 
											<div class="show_va"> Select Cash Account</div>
											<div class="selectVal admin_cash_val"> Select Cash Account </div>
											<ul class="check_list admin_cash mykey" >
												<li id="admin_cash_li"> 
												</li>
											</ul>							
										</div>
									</li>

									<li id="bank_block">
										<div class="check_wt_serc"> 
											<div class="show_va"> Select Admin Bank </div>
											<div class="selectVal admin_bank_val"> Select Admin Bank </div>
											<ul class="check_list admin_bank mykey" >
												<li id="admin_bank_li"> 
												</li>
											</ul>							
										</div>
									</li>

									<li id="user_block">
										<div class="check_wt_serc"> 
											<div class="show_va"> Select User Bank </div>
											<div class="selectVal bank_val"> Select User Bank </div>
											<ul class="check_list user_bank mykey">
												<li id="user_bank_li"> 
												</li>
											</ul>
										</div>
									</li>
									<li class="create_li" id="src_user">
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
									<li id="crop_block">
										<div class="check_wt_serc "> 
											<div class="show_va">Crop location</div>
											<div class="selectVal cval">  Crop location </div>
											<ul class="check_list user_crop mykey"> 
												<li id="user_crop_li">
												</li>
											</ul>
										</div>
									</li>
									<li class="create_li">
										<div class="cre_inp">
											<div class="sm_blk"> Withdrawal Amount </div>
																				
											<input type="text" id="drawal_amt_commas" name="drawal_amt_commas" class="form-control noalpha mykey" onkeyup="amount_with_commas();" />
														
											<input type="hidden" id="drawal_amt" name="drawal_amt" class="form-control allownumericwithdecimal" value="">
											<div class="amon_text" style="display:none;"></div>
										</div>
									</li>
								</ul>
							</div>
							<div class="wth_pop_not"> 
								<textarea id="drawal_note" name="drawal_note" placeholder="Note"></textarea>
							</div>
							<div class="pop_footer"> 
								<button type="submit" class="btn btn-primary wth_drw_btn">Withdraw</button>
								<input type="hidden" id="hid_gtot" name="hid_gtot" value="" />
								<input type="hidden" id="hid_chkbal" name="hid_chkbal" value="0" />
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="settl_amnt" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content ">
				<div class="pp_clss" data-dismiss="modal"> <i class="fa fa-times" aria-hidden="true"></i> </div>
				<div class="pop_hdr"> 
					<h1 class="create_hdg"> Bill Settelement </h1>
					<p id="billdate">  </p>
					<div class="pop_stp_tbs"> 
						<div class="bdr_blue"></div>
						<div class="tbs_div fst_step act_tb"> <span id="poptextshow1">1</span>
							<div class="tb_hdg"> Loans </div> 
						</div>
						<div class="tbs_div sec_step"> <span id="poptextshow2">2</span> 
							<div class="tb_hdg"> Sales </div> 
						</div>
						<div class="tbs_div thrd_step"> <span id="poptextshow3">3</span>
							<div class="tb_hdg"> Billing </div>
						</div>
					</div>        
				</div>
				<input type="hidden" id="loanstepshow" name="loanstepshow" value="0">
				<input type="hidden" id="salestepshow" name="salestepshow" value="0">
				<div class="tab_cnt_blk">
					<div class="loans_tb"> 
						<div class="rt_tbl_sale"> 
							<div class="rt_blk_in">
								<div class="analtic_blk"> 
									<p class="anl_sml_txt"> Final Loan Amount </p>
									<h1 class="anl_lrg_txt" id="finalamount"> ₹0 </h1>
									<ul> 
										<li> 
											<span class="anl_sml_txt">Total Amount</span> 
											<span class="li_amnt_an"> <b id="totalamount">₹0</b> <input type="hidden" name="totalamountval" id="totalamountval"></span>
										</li>
										<li> 
											<span class="anl_sml_txt">Total Interest</span> 
											<span class="li_amnt_an blue_txt"> <b id="totalinterest">₹0</b> <input type="hidden" name="totalinterestval" id="totalinterestval"></span>
										</li>
									</ul>
								</div>             
							</div>
						</div>
						<div class="lft_tbl_sale">
							<div class="res_tbl"> 
								<form id="loanfrm" name="loanfrm" action="javascript:void(0);" method="post">
									<input type="hidden" name="rowcount" id="rowcount">
									<table class="table">
										<thead> <tr> 
											<th width="120"> Start Date </th>
											<th width="120"> End Date </th>
											<th width="32"> Days </th>
											<th width="120"> Type </th>
											<th class="txt_rt" width="120"> Loan Amount </th>
											<th width="32" style="width: 32px; max-width: 32px;" class="txt_cnt"> ROI </th>
											<th class="txt_rt" width="120"> Interest </th>
											<th class="txt_rt" width="200"> Total </th>
										</tr> </thead>
										<tbody id="loandata">

										</tbody>
									</table>
								</form>
							</div>
						</div>
					</div>

					<div class="sale_tb" style="display: none">
						<div class="rt_tbl_sale">
							<div class="rt_blk_in"> 
								<div class="analtic_blk"> 
									<p class="anl_sml_txt"> Final Amount </p>
									<h1 class="anl_lrg_txt grandfinalamount" id="grandfinalamount"> ₹0 </h1>
									<div id="summaryrecord">
										
									</div>
									<ul class="ttl_blk_ul"> 
										<li class="prd_typ"> 
											<span class="anl_sml_txt prd_typ">Total Amount</span> 
											<span class="li_amnt_an">   <b class="grandtotal_amount">₹0</b><input type="hidden" id="grandtotal_amountval" name="grandtotal_amountval" >    </span>
										</li>
										<li class="pad_l_none"> 
											<span class="anl_sml_txt">Total Discount</span> 
											<span class="li_amnt_an blue_txt">   <b class="granddiscount_amount">₹0</b><input type="hidden" id="granddiscount_amountval" name="granddiscount_amountval" >   </span>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="lft_tbl_sale">   
							<form id="salefrm" name="salefrm" action="javascript:void(0);" method="post">           
								<table border="0" cellpadding="0" cellspacing="0" id="saledataload">
									
								</table>    
							</form>
						</div>  
					</div>

					<div class="billing_tb" style="display: none;"> 
						<form id="final_frm" name="final_frm">
							<span id="final_print">
								<div class="top_bill_tb">
									<div class="bil_tp_lft top_in_op"> 
										<h1 style="font-size:16px;color: #007bff;font-weight: normal;margin: 0px;"><?php echo $user["user_name"]; ?> - #<?php echo $user["user_code"]; ?> </h1>
										<p> <?php echo $user["mobile"]; ?> </p>
									</div>
									<div class="bil_tp_rt"> 
										<ul> 
											<li class="top_in_op bdr_non"> 
												<p> Location </p>
												<h1 id="crop_location"> <?php echo $crop_location;?> </h1>
												<input type="hidden" id="crop_location_val" name="crop_location_val" value="">
											</li>
											<li class="top_in_op"> 
												<p> Billing Date </p>
												<h1> <?php echo date('d-M-Y'); ?> </h1>
											</li>
										</ul>
									</div>
								</div>

								<div class="row">
									<div class="col-md-6" id="feedharvestsymbol"> 
										<div class="rat_blk"> 
											<div class="rto_tons"> 
												Harvest<input type="hidden" name="harvesttonsval" id="harvesttonsval" >
												<div class="rto_val" id="harvesttons"> 0 tons </div>
											</div>
											<div class="ratio_icon grt_rto"> <!-- lss_rto eql_rto  -->
												<div class="mdl_bar"> </div>
												<div class="tp_bar"> </div>
												<div class="btm_bar"> </div>
												<div class="crlcl_blk"> </div>
												<div class="bal_bar"> </div>
												<div class="sing_bag"> 
													<img src="http://3.7.44.132/aquacredit/assets/images/icon_singl_rat" alt="" title="">
												</div>
												<div class="mult_bag"> <img src="http://3.7.44.132/aquacredit/assets/images/icon_mult_rat" alt="" title=""> </div>
												<div class="mult_bag2"> <img src="http://3.7.44.132/aquacredit/assets/images/icon_mult_rat" alt="" title=""> </div>
												<div class="rto_txt"> FCR: <span class="blue_txt" id="ratio_display">0:0</span> </div>
												<input type="hidden" id="fcr" name="fcr">
												<input type="hidden" id="fcr_status" name="fcr_status">
												<div class="sts_rto" id="feed_status">   </div>
											</div>
											<div class="rto_tons"> 
												Feed Usage
												<div class="rto_val" id="feedusage"> 0 tons 
													<input type="hidden" id="feed_wt" name="feed_wt" value ="">
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-6" id="feedtable"> 
										<table border="none" class="prods_ls_blk">
											<thead>
												<tr> 
												<th> Feeds </th>
												<th class="no_bgs"> No.of.bags </th>
												</tr>
											</thead>
											<tbody id="feeddata">

											</tbody>												
											<tfoot>
												<tr> 
												<td> <b> Total Bags </b> </td>
												<td class="no_bgs"> <b id="tfeedbad"> 0 </b> </td>
												</tr>
											</tfoot>
										</table>
									</div>
								</div>

								<div class="row card_list">
									<div class="col-md-9"> 
										<div class="row" class="summary"> 
											<div class="col-md-4" id="loanhide"> 
												<div class="analtic_blk"> 
													<p class="anl_sml_txt"> Loan Amount </p>
													<h1 class="anl_lrg_txt" id="floanamount"> ₹0 </h1>
													<input type="hidden" name="total_loan_amount" id="total_loan_amount">
													<ul> 
														<li> 
															<span class="anl_sml_txt">Total Amount</span> 
															<span class="li_amnt_an" id="tloanamount"> ₹0 </span>
															<input type="hidden" name="loan_amount" id="loan_amount">
														</li>
														<li> 
															<span class="anl_sml_txt">Total Interest</span> 
															<span class="li_amnt_an" id="tinterestamount"> ₹0 </span>
															<input type="hidden" name="loan_interest" id="loan_interest">
														</li>
													</ul>
												</div>
											</div>
							
											<div class="col-md-4" id="harvesthide" >
												<div class="analtic_blk">
													<p class="anl_sml_txt"> Harvest </p>
													<h1 class="anl_lrg_txt" id="harvestamount" > ₹0 </h1>
													<input type="hidden" name="harvest_amount" id="harvest_amount">
													<ul>
														<li>
															<span class="anl_sml_txt">Type</span>
															<span class="li_amnt_an" id="crop_type"> </span>
															<input type="hidden" name="harvest_type" id="harvest_type">
														</li>
														<li>
															<span class="anl_sml_txt">Total Tons</span>
															<span class="li_amnt_an" id="harvestweight" name="harvestweight"> 0</span>
														</li>
													</ul>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-3"> 
										<div class="ext_pop_chrs">
										<ul>
											<li id="flabhide"><span class="fl"> Lab Fee </span> <span class="fr" id="flabfee"> ₹0 </span> 
												<input type="hidden" name="lab_fee" id="lab_fee">
											</li>
											<li id="exphide"><span class="fl"> Expenses </span> <span class="fr" id="expenses"> ₹0 </span> 
												<input type="hidden" name="expenses_val" id="expenses_val">
											</li>
											<li id="ftransporthide" ><span class="fl"> Transport </span> <span class="fr" id="ftransport"> ₹0 </span> 
												<input type="hidden" name="transport" id="transport">
											</li>
											<li id="floadinghide" ><span class="fl"> Loading </span> <span class="fr" id="floading"> ₹0 </span> 
												<input type="hidden" name="loading" id="loading">
											</li>
											<li id="receipthide"><span class="fl"> Receipts </span> <span class="fr" id="freceipts"> ₹0 </span> 
												<input type="hidden" name="receipts" id="receipts">
											</li>
											<li id="returnhide"><span class="fl"> Return </span> <span class="fr" id="fretrun"> ₹0 </span> 
												<input type="hidden" name="returns" id="returns">
											</li>
										</ul>               
									</div>              
								</div>
				
								<div class="list_all_vew"> 
									<table border="0" cellpadding="0" cellspacing="0" id="usr_lst_tbl1" class="usr_lst_tbl" width="100%">
										<thead>
										<tr>
										<th class="date"> Date </th>
										<th> Details </th>
										<th class="txt_rt">  Amount  </th>
										</tr>
										</thead>
									</table>
									<table style="width:100%" cellpadding="100" cellspacing="100">
										<tr>
											<td class="opic_non date"> &nbsp;   </td>
											<td class="txt_rt"> Total <input type="text" id="sum_total"></td>
											<td class="txt_rt in_td tr_amount" id="in_td1"></td>

										</tr>
										<tr>
											<td class="opic_non date"> &nbsp;  </td>
											<td class="txt_rt type"> Opening Balance</td>
											<td class="txt_rt tr_amount" class="open_bal" id="open_bal1"> +0 </td>
										</tr>
									
										<tr>
											<td class="opic_non date"> &nbsp;  </td>
											<td class="txt_rt"><b id="grd_ttl">Grand Total </b> </td>
											<td class="txt_rt grand_total tr_amount" id="grand_total1" > <b>+0</b> </td>
										</tr>
									</table>
								</div>
							</span>
						</form>	
						<a href="javascript:void(0);" onclick="printDiv()"  title="" class="btn ed_usr btn-primary fr"> Print </a>
					</div>
				</div> 
			</div>
			<div class="footer_pp"> 
				<button class="btn btn-primary"  id="confirmOrder" > Next </button>
				<button class="btn btn-primary"  id="saleOrder" > Next </button>
				<button class="btn btn-primary"  id="finalOrder" > Submit </button>
				<input type="hidden" name="grand_totalval" id="grand_totalval"> </div>
			</div>
		</div>
	</div>

  	<div class="sle_cr_r"> 
		<div class="card_view cp_anl"> 
			<ul class="trd_anl"> 
				<li class="bor_lf_none"> 
					<div class="top_in_op crop_top">
						<p> Loan </p> 
						<h1 id="cropLoan">  </h1>
					</div>
				</li>
				<li class=""> 
					<div class="top_in_op crop_top">
						<p> Orders </p> 
						<h1 id="cropOrder">  </h1>
					</div>
				</li>
				<li class=""> 
					<div class="top_in_op crop_top">
						<p> Harvest </p> 
						<h1 id="cropHarvest"> </h1>
					</div>
				</li>
				<li class=""> 
					<div class="top_in_op crop_top">
						<p> Acres </p> 
						<h1 id="cropAcre">  </h1>
					</div>
				</li>
				<li class="fr slc_usr">      
					<div class="check_wt_serc val_seld"> 
						<div class="show_va">Selected Crop</div>
						<div class="selectVal cropValue"></div>
						<ul class="check_list"> 
							<li id="crop_opt_li">
							
							</li>
						</ul>                       
					</div>
				</li>
        	</ul>
         	<input type="hidden" value="" id="crop_id">
		</div>        
		<div class="urs_dt"> 
			<div class=""> 
				<div class="res_tbl">
				
				<ul class="tabs_tbl"><li class="act_tab drft_cl" id="status_0"> <span>Unsettled</span> </li><li class="comp_cl" id="status_1"> <span>Settled </span> </li></ul> 

					<table id="usr_lst_tbl" class="table table-striped table-bordered usr_lst_tbl" style="width:100%">
						<thead id="unsettled_header">
							<tr>
								<th width="20%" class="date">  Date
									<span class="pull-right" id="reportrange">
										<i class="fa fa-filter"  aria-hidden="true" style="font-size: 9px;"></i> 
										<span></span>
									</span>	
									<input type="hidden" id="date_val" name="date_val" />
								</th>
								<th class=""> Detail
									<span class="sts_pp">
										<i class="fa fa-filter" aria-hidden="true" style="font-size: 9px;"></i>
									</span>
									<div class="sts_fil_blk rad_btns">
										<label class="form-check-label radio_blk checkd" for="All">
											<input class="form-check-input" type="radio" name="trans_type" value="" id="All">
											All
										</label>
										<label class="form-check-label radio_blk" for="PURCHASE">
											<input class="form-check-input" type="radio" name="trans_type" value="PURCHASE" id="PURCHASE">
											PURCHASE
										</label>

										<label class="form-check-label radio_blk" for="RETURN">
											<input class="form-check-input" type="radio" name="trans_type" value="RETURN" id="RETURN">
											RETURN
										</label>
									</div>
								</th>
								<th width="40%" class="txt_rt out_td"> Amount </th>
							</tr>
						</thead>
						<thead id="settled_header" style="display:none">
						</thead>
						<tbody></tbody>
                    </table>
					<table id="settled" class="table table-striped table-bordered usr_lst_tbl" style="width:100%: display:none;">
						<thead></thead>
						<tbody></tbody>
                    </table>
				</div>
				<div id="table_footer" class="table_footer"  style="width:100%;padding: 10px 0;">
					<table style="width:100%">
						<tr>
						<td class="opic_non date"> &nbsp;   </td>
						<td class="txt_rt"> Total </td>
						<td class="txt_rt in_td tr_amount" id="in_td"></td>

						</tr>
						<tr>
						<td class="opic_non date"> &nbsp;  </td>
						<td class="txt_rt type"> Opening Balance</td>
						<td class="txt_rt tr_amount" class="open_bal" id="open_bal"> +0 </td>
						</tr>
						<!-- <tr>
						<td class="opic_non date"> &nbsp;  </td>
						<td class="txt_rt type"> <b>Previous Balance <span class="grn_clr"></span></b> </td>
						<td class="grn_clr txt_rt"> <b>+100</b> </td>
						</tr>-->
						<tr>
						<td class="opic_non date"> &nbsp;  </td>
						<td class="txt_rt"><b id="grd_ttl">Grand Total </b> </td>
						<td class="txt_rt grand_total tr_amount" id="grand_total"> <b>+0</b> </td>
						</tr>
					</table>
				</div>
			</div>
		</div>
  	</div>
</div>

<script type="text/javascript">
	var url = '<?php echo base_url() ?>';
	var user_id = "<?php echo $user["user_id"]; ?>";
</script>
<script src="<?php echo base_url(); ?>assets/js/userdetails.js"></script>
<script src='<?php echo base_url(); ?>assets/js/withdrawals.js'></script>
<?php require_once 'footer.php';?>