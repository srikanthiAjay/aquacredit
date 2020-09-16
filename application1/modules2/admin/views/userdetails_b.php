<?php require_once 'header.php';?>
<link href="<?php echo base_url(); ?>assets/css/user_detials.css" type="text/css" rel="stylesheet">
<script src='https://kit.fontawesome.com/a076d05399.js'></script>
<?php require_once 'sidebar.php';?>
<div class="right_blk">
	<div class="top_ttl_blk">
		<!-- <span class="back_btn"> <a href="<?php echo base_url(); ?>admin/users" title=""><img src="<?php echo base_url(); ?>assets/images/back.png" alt="" title=""> </a></span>  -->
		<span> <b>Prudhvi PS</b> Transactions - #AU000001 </span>
		<a href="<?php echo base_url(); ?>admin/users/crop_print" target="_blank" title="" class="btn ed_usr btn-primary fr"> Print </a>
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
			<li> <div class="li_lft_blk"> Credit Limit </div> <div class="li_rt_blk"> ₹10,00000 </div> </li>
			<li> <div class="li_lft_blk"> Available Credit </div> <div class="li_rt_blk"> ₹10,00000 </div> </li>
		</ul>
   		<div class="dvder"> </div>
		<div class="main_anal">
			<h2 class="create_hdg"> Analytics - <span>All crops(4)</span> </h2>
			<ul class="anl_tcs">
				<li class="bor_lf_none">
					<div class="top_in_op crop_top">
						<p>Loan </p>
						<h1> ₹10,00,00 </h1>
					</div>
				</li>
				<li class="bor_lf_none">
					<div class="top_in_op crop_top">
						<p>Orders </p>
						<h1> ₹10,00,00 </h1>
					</div>
				</li>
				<li class="bor_lf_none">
					<div class="top_in_op crop_top">
						<p>Harvest </p>
						<h1> ₹10,00,00 </h1>
					</div>
				</li>
				<li class="bor_lf_none">
					<div class="top_in_op crop_top">
						<p>Acres </p>
						<h1> 10 </h1>
					</div>
				</li>
			</ul>
		</div>
		<div class="rt_btm">
			<button class="btn btn-primary stl_trn_his" data-toggle="modal" data-target="#settl_amnt">Settle Account </button>
			<button class="btn btn-primary stl_trn_his" data-toggle="modal" data-target="#bal_wthdr">Balance Withdrawal </button>
		</div>
	</div>

	<div class="modal fade" id="bal_wthdr" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content ">
				<div class="pp_clss" data-dismiss="modal"> <i class="fa fa-times" aria-hidden="true"></i> </div>
				<div class="bal_wth_pp">
					<div class="pop_hdr"> <h1 class="create_hdg"> Balance Withdrawal </h1> </div>
						<div class="top_in_op crop_top">
							<p> Available Balance </p>
							<h1> ₹10,00,00 </h1>
						</div>
						<div class="po_Rel">
						<ul class="assign_type">
							<li class="ban_trns_edit lnk_typ act_type">
								<img src="http://3.7.44.132/aquacredit/assets/images/bank_tansfer.png" class="mCS_img_loaded">
								<input type="radio" name="act_types_edit" value="cash" checked="">
								<span> Bank Transfer </span>
							</li>
							<li class="cash_trns_edit lnk_typ">
								<img src="http://3.7.44.132/aquacredit/assets/images/cash_icn.png" class="mCS_img_loaded">
								<input type="radio" name="act_types_edit" value="cash">
								<span> Cash </span>
							</li>
							<li class="cash_trns_edit lnk_typ">
								<img src="http://3.7.44.132/aquacredit/assets/images/cash_icn.png" class="mCS_img_loaded">
								<input type="radio" name="act_types_edit" value="cash">
								<span> Crop Transfer </span>
							</li>
						</ul>

						<div class="bnk_trnk_blk">
							<ul class="trans_inf bnk_tr">
								<li class="create_li date">
									<div class="cre_inp">
  										<div class="sm_blk"> Date </div>
    									<input type="text" class="form-control" placeholder="" data-original-title="" title="">
									</div>
								</li>

								<li class="admin_bank_li">
									<div class="check_wt_serc">
										<div class="show_va"> Select Bank </div>
										<div class="selectVal">  Select Bank </div>
										<ul class="check_list">
											<li>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="trader" id="bnk1" value="Bank 1">
													<label class="form-check-label" for="bnk1">
														<div class="bank_logo"> <img src="http://3.7.44.132/aquacredit/assets/images/sib_icn.png" alt="" title="" class="mCS_img_loaded"> </div>
														<div class="bank_mny">
															<div class="bank_bal"> ₹ 10,000 </div>
															<div class="accont_numb">xxxxxxxxx01792</div>
														</div>
													</label>
												</div>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="trader" id="bnk2" value=" Bank 2">
													<label class="form-check-label" for="bnk2">
														<div class="bank_logo"> <img src="http://3.7.44.132/aquacredit/assets/images/hdfc_icn.png" alt="" title="" class="mCS_img_loaded"> </div>
														<div class="bank_mny">
															<div class="bank_bal"> ₹ 10,000 </div>
															<div class="accont_numb">xxxxxxxxx01792</div>
														</div>
													</label>
												</div>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="trader" id="bnk3" value="Bank 3">
													<label class="form-check-label" for="bnk3">
														<div class="bank_logo"> <img src="http://3.7.44.132/aquacredit/assets/images/icici_icn.png" alt="" title="" class="mCS_img_loaded"> </div>
														<div class="bank_mny">
															<div class="bank_bal"> ₹ 10,000 </div>
															<div class="accont_numb">xxxxxxxxx01792</div>
														</div>
													</label>
												</div>
												<div class="form-check">
												<input class="form-check-input" type="radio" name="trader" id="bnk4" value="Bank 4">
													<label class="form-check-label" for="bnk4">
														<div class="bank_logo"> <img src="http://3.7.44.132/aquacredit/assets/images/hdfc_icn.png" alt="" title="" class="mCS_img_loaded"> </div>
															<div class="bank_mny">
																<div class="bank_bal"> ₹ 10,000 </div>
																<div class="accont_numb">xxxxxxxxx01792</div>
															</div>
													</label>
												</div>
											</li>
										</ul>
									</div>
  								</li>

								<li class="admin_bank_li">
									<div class="check_wt_serc">
										<div class="show_va"> Select User Bank </div>
										<div class="selectVal">  Select User Bank </div>
										<ul class="check_list">										
											<li>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="trader" id="bnk1" value="Bank 1">
													<label class="form-check-label" for="bnk1">
														<div class="bank_logo"> <img src="http://3.7.44.132/aquacredit/assets/images/sib_icn.png" alt="" title="" class="mCS_img_loaded"> </div>
															<div class="bank_mny">
																<div class="bank_bal"> ₹ 10,000 </div>
																<div class="accont_numb">xxxxxxxxx01792</div>
															</div>
													</label>
												</div>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="trader" id="bnk2" value=" Bank 2">
													<label class="form-check-label" for="bnk2">
													<div class="bank_logo"> <img src="http://3.7.44.132/aquacredit/assets/images/hdfc_icn.png" alt="" title="" class="mCS_img_loaded"> </div>
															<div class="bank_mny">
																<div class="bank_bal"> ₹ 10,000 </div>
																<div class="accont_numb">xxxxxxxxx01792</div>
															</div>
													</label>
												</div>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="trader" id="bnk3" value="Bank 3">
													<label class="form-check-label" for="bnk3">
															<div class="bank_logo"> <img src="http://3.7.44.132/aquacredit/assets/images/icici_icn.png" alt="" title="" class="mCS_img_loaded"> </div>
															<div class="bank_mny">
																<div class="bank_bal"> ₹ 10,000 </div>
																<div class="accont_numb">xxxxxxxxx01792</div>
															</div>
													</label>
												</div>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="trader" id="bnk4" value="Bank 4">
													<label class="form-check-label" for="bnk4">
														<div class="bank_logo"> <img src="http://3.7.44.132/aquacredit/assets/images/hdfc_icn.png" alt="" title="" class="mCS_img_loaded"> </div>
															<div class="bank_mny">
																<div class="bank_bal"> ₹ 10,000 </div>
																<div class="accont_numb">xxxxxxxxx01792</div>
															</div>
													</label>
												</div>
											</li>
										</ul>
									</div>
  								</li>
								<li class="create_li">
									<div class="cre_inp">
										<div class="sm_blk"> Withdrawal Amount </div>
										<input type="text" class="form-control" placeholder="" data-original-title="" title="">
									</div>
								</li>
    						</ul>
        				</div>
						<div class="wth_pop_not">
							<textarea>Note</textarea>
						</div>
						<div class="pop_footer">
							<button type="submit" class="btn btn-primary wth_drw_btn">Withdraw</button>
						</div>
      				</div>
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
					<p> 10-Apr-2020 to 10-May-2020 </p>
					<div class="pop_stp_tbs">
						<div class="bdr_blue"></div>
						<div class="tbs_div fst_step act_tb"> 1
							<div class="tb_hdg"> Loans </div>
						</div>
						<div class="tbs_div sec_step"> 2
							<div class="tb_hdg"> Sales </div>
						</div>
						<div class="tbs_div thrd_step"> 3
							<div class="tb_hdg"> Billing </div>
						</div>
					</div>
				</div>
				<div class="tab_cnt_blk">
					<div class="loans_tb">
						<div class="rt_tbl_sale">
							<div class="rt_blk_in">
								<div class="analtic_blk">
									<p class="anl_sml_txt"> Final Loan Amount </p>
									<h1 class="anl_lrg_txt"> ₹1,42,000 </h1>
									<ul>
										<li>
										<span class="anl_sml_txt">Total Amount</span>
										<span class="li_amnt_an"> <b>₹1,20,000</b> </span>
										</li>
										<li>
										<span class="anl_sml_txt">Total Interest</span>
										<span class="li_amnt_an blue_txt"> <b>₹24,000</b> </span>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="lft_tbl_sale">
							<div class="res_tbl">
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
									<tbody>
									<tr>
										<td> 10-Apr-2020 </td>
										<td> 10-May-2020 </td>
										<td> 30 </td>
										<td> Crop Loan </td>
										<td class="txt_rt"> 10,000 </td>
										<td> <input type="text" class="txt_cnt rt_int" value="2"> </td>
										<td class="txt_rt"> 2,000 </td>
										<td class="txt_rt txt_red"> - 12,000 <i> <img src="http://3.7.44.132/aquacredit/assets/images/rd_c_ar.png" alt="" title=""> </i> </td>
									</tr>
									<tr>
										<td> 10-Apr-2020 </td>
										<td> 10-May-2020 </td>
										<td> 30 </td>
										<td> Crop Loan </td>
										<td class="txt_rt"> 10,000 </td>
										<td> <input type="text" class="txt_cnt rt_int" value="2"> </td>
										<td class="txt_rt"> 2,000 </td>
										<td class="txt_rt txt_red"> - 12,000 <i> <img src="http://3.7.44.132/aquacredit/assets/images/rd_c_ar.png" alt="" title=""> </i> </td>
									</tr>
									<tr>
										<td> 10-Apr-2020 </td>
										<td> 10-May-2020 </td>
										<td> 30 </td>
										<td> Crop Loan </td>
										<td class="txt_rt"> 10,000 </td>
										<td> <input type="text" class="txt_cnt rt_int" value="2"> </td>
										<td class="txt_rt"> 2,000 </td>
										<td class="txt_rt txt_red"> - 12,000 <i> <img src="http://3.7.44.132/aquacredit/assets/images/rd_c_ar.png" alt="" title=""> </i> </td>
									</tr>
									<tr>
										<td> 10-Apr-2020 </td>
										<td> 10-May-2020 </td>
										<td> 30 </td>
										<td> Crop Loan </td>
										<td class="txt_rt"> 10,000 </td>
										<td> <input type="text" class="txt_cnt rt_int" value="2"> </td>
										<td class="txt_rt"> 2,000 </td>
										<td class="txt_rt txt_red"> - 12,000 <i> <img src="http://3.7.44.132/aquacredit/assets/images/rd_c_ar.png" alt="" title=""> </i> </td>
									</tr>
									<tr>
										<td> 10-Apr-2020 </td>
										<td> 10-May-2020 </td>
										<td> 30 </td>
										<td> Crop Loan </td>
										<td class="txt_rt"> 10,000 </td>
										<td> <input type="text" class="txt_cnt rt_int" value="2"> </td>
										<td class="txt_rt"> 2,000 </td>
										<td class="txt_rt txt_red"> - 12,000 <i> <img src="http://3.7.44.132/aquacredit/assets/images/rd_c_ar.png" alt="" title=""> </i> </td>
									</tr>
									<tr>
										<td> 10-Apr-2020 </td>
										<td> 10-May-2020 </td>
										<td> 30 </td>
										<td> Crop Loan </td>
										<td class="txt_rt"> 10,000 </td>
										<td> <input type="text" class="txt_cnt rt_int" value="2"> </td>
										<td class="txt_rt"> 2,000 </td>
										<td class="txt_rt txt_red"> - 12,000 <i> <img src="http://3.7.44.132/aquacredit/assets/images/rd_c_ar.png" alt="" title=""> </i> </td>
									</tr>
									<tr>
										<td> 10-Apr-2020 </td>
										<td> 10-May-2020 </td>
										<td> 30 </td>
										<td> Crop Loan </td>
										<td class="txt_rt"> 10,000 </td>
										<td> <input type="text" class="txt_cnt rt_int" value="2"> </td>
										<td class="txt_rt"> 2,000 </td>
										<td class="txt_rt txt_red"> - 12,000 <i> <img src="http://3.7.44.132/aquacredit/assets/images/rd_c_ar.png" alt="" title=""> </i> </td>
									</tr>
									<tr>
										<td> 10-Apr-2020 </td>
										<td> 10-May-2020 </td>
										<td> 30 </td>
										<td> Crop Loan </td>
										<td class="txt_rt"> 10,000 </td>
										<td> <input type="text" class="txt_cnt rt_int" value="2"> </td>
										<td class="txt_rt"> 2,000 </td>
										<td class="txt_rt txt_red"> - 12,000 <i> <img src="http://3.7.44.132/aquacredit/assets/images/rd_c_ar.png" alt="" title=""> </i> </td>
									</tr>
									<tr>
										<td> 10-Apr-2020 </td>
										<td> 10-May-2020 </td>
										<td> 30 </td>
										<td> Crop Loan </td>
										<td class="txt_rt"> 10,000 </td>
										<td> <input type="text" class="txt_cnt rt_int" value="2"> </td>
										<td class="txt_rt"> 2,000 </td>
										<td class="txt_rt txt_red"> - 12,000 <i> <img src="http://3.7.44.132/aquacredit/assets/images/rd_c_ar.png" alt="" title=""> </i> </td>
									</tr>
									<tr>
										<td> 10-Apr-2020 </td>
										<td> 10-May-2020 </td>
										<td> 30 </td>
										<td> Crop Loan </td>
										<td class="txt_rt"> 10,000 </td>
										<td> <input type="text" class="txt_cnt rt_int" value="2"> </td>
										<td class="txt_rt"> 2,000 </td>
										<td class="txt_rt txt_red"> - 12,000 <i> <img src="http://3.7.44.132/aquacredit/assets/images/rd_c_ar.png" alt="" title=""> </i> </td>
									</tr>
									<tr>
										<td> 10-Apr-2020 </td>
										<td> 10-May-2020 </td>
										<td> 30 </td>
										<td> Crop Loan </td>
										<td class="txt_rt"> 10,000 </td>
										<td> <input type="text" class="txt_cnt rt_int" value="2"> </td>
										<td class="txt_rt"> 2,000 </td>
										<td class="txt_rt txt_red"> - 12,000 <i> <img src="http://3.7.44.132/aquacredit/assets/images/rd_c_ar.png" alt="" title=""> </i> </td>
									</tr>
									<tr>
										<td> 10-Apr-2020 </td>
										<td> 10-May-2020 </td>
										<td> 30 </td>
										<td> Crop Loan </td>
										<td class="txt_rt"> 10,000 </td>
										<td> <input type="text" class="txt_cnt rt_int" value="2"> </td>
										<td class="txt_rt"> 2,000 </td>
										<td class="txt_rt txt_red"> - 12,000 <i> <img src="http://3.7.44.132/aquacredit/assets/images/rd_c_ar.png" alt="" title=""> </i> </td>
									</tr>

									</tbody>
									<!--  <tfoot>
									<tr>
										<th>  Total  </th>
										<th colspan="4" class="txt_rt"> 1,20,000</th>
										<th> </th>
										<th class="txt_rt">  24,000  </th>
										<th class="txt_rt txt_red">  1,44,000 <i> <img src="http://3.7.44.132/aquacredit/assets/images/rd_c_ar.png" alt="" title=""> </i> </th>
									</tr>
									</tfoot> -->
								</table>
							</div>
						</div>
        			</div>

					<div class="sale_tb" style="display: none">
						<div class="rt_tbl_sale">
							<div class="rt_blk_in">
								<div class="analtic_blk">
									<p class="anl_sml_txt"> Final Amount </p>
									<h1 class="anl_lrg_txt"> ₹1,42,000 </h1>
									<ul>
										<li class="prd_typ">
										<span class="anl_sml_txt">Feed</span>
										<span class="li_amnt_an">  ₹1,00,000  </span>
										</li>
										<li class="discount_li">
										<span class="anl_sml_txt">Discount</span>
										<span class="li_amnt_an">  - ₹10,000   </span>
										</li>
										<li class="eql_tbl"> = </li>
										<li>
										<span class="anl_sml_txt">Total</span>
										<span class="li_amnt_an blue_txt"> <b>₹90,000</b> </span>
										</li>
									</ul>
									<ul>
										<li class="prd_typ">
										<span class="anl_sml_txt">Machinery </span>
										<span class="li_amnt_an">  ₹1,00,000  </span>
										</li>
										<li>
										<span class="anl_sml_txt discount_li">Discount</span>
										<span class="li_amnt_an">  - ₹10,000   </span>
										</li>
										<li class="eql_tbl"> = </li>
										<li>
										<span class="anl_sml_txt">Total</span>
										<span class="li_amnt_an blue_txt"> <b>₹90,000</b> </span>
										</li>
									</ul>
									<ul>
										<li class="prd_typ">
										<span class="anl_sml_txt">Medicine </span>
										<span class="li_amnt_an">  ₹1,00,000  </span>
										</li>
										<li class="discount_li">
										<span class="anl_sml_txt">Discount</span>
										<span class="li_amnt_an">  - ₹10,000   </span>
										</li>
										<li class="eql_tbl"> = </li>
										<li>
										<span class="anl_sml_txt">Total</span>
										<span class="li_amnt_an blue_txt"> <b>₹90,000</b> </span>
										</li>
									</ul>
									<ul class="ttl_blk_ul">
										<li class="prd_typ">
										<span class="anl_sml_txt prd_typ">Total Amount</span>
										<span class="li_amnt_an">   <b>₹3,00,00</b>    </span>
										</li>
										<li class="pad_l_none">
										<span class="anl_sml_txt">Total Discount</span>
										<span class="li_amnt_an blue_txt">   <b>₹30,000</b>   </span>
										</li>

									</ul>
    							</div>
            				</div>
          				</div>
          				<div class="lft_tbl_sale">
							<table border="0" cellpadding="0" cellspacing="0">
								<thead data-toggle="collapse" data-target="#feed_tbl" aria-expanded="false" aria-controls="feed_tbl">
									<tr>
										<th>
										<span class="tggl_act">
											<img src="http://3.7.44.132/aquacredit/assets/images/plu.svg" class="plu">
											<img src="http://3.7.44.132/aquacredit/assets/images/mini.svg" class="mini">
										</span>
										Feed (5) </th>
										<th class="pp_amnt txt_rt"> </th>
										<th class="pp_dis"> </th>
										<th class="pp_ttl txt_rt">    </th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td colspan="4">
											<div id="feed_tbl" class="collapse show tgl_div">
												<table border="0" cellpadding="0" cellspacing="0">
													<tr>
														<td class="brnd_ane"> <b> Brand Name </b> </td>
														<td class="pp_amnt txt_rt"> <b> MRP's Total</b> </td>
														<td class="pp_dis"> <b> Discount </b> </td>
														<td class="pp_ttl txt_rt"> <b> Total </b> </td>
													</tr>
													<tr>
														<td class="brnd_ane" data-toggle="collapse" data-target="#prds_tbl" aria-expanded="false" aria-controls="prds_tbl"> <a href="#"> Brand Name</a> </td>
														<td class="pp_amnt txt_rt"> 10,000 </td>
														<td class="pp_dis"> <input type="text"> </td>
														<td class="pp_ttl txt_rt"> 9,000 </td>
													</tr>
													<tr>
														<td colspan="4" class="prd_b_tb">
															<div id="prds_tbl" class="collapse tgl_div">
																<table>
																	<tr>
																		<th class="brnd_ane"> Product Name </th>
																		<th class="pp_amnt txt_rt"> MRP </th>
																		<th class="pp_dis"> Discount </th>
																		<th class="pp_ttl txt_rt"> Total </th>
																	</tr>
																	<tr>
																		<td class="brnd_ane"> <a href="#"> Vannamin Liquid Mineral </a> </td>
																		<td class="pp_amnt txt_rt"> 2,000 </td>
																		<td class="pp_dis"> <input type="text" value="10"> </td>
																		<td class="pp_ttl txt_rt"> 18,00 </td>
																	</tr>
																	<tr>
																		<td class="brnd_ane"> <a href="#"> HydroYeast </a> </td>
																		<td class="pp_amnt txt_rt"> 2,000 </td>
																		<td class="pp_dis"> <input type="text" value="10"> </td>
																		<td class="pp_ttl txt_rt"> 18,00 </td>
																	</tr>
																	<tr>
																		<td class="brnd_ane"> <a href="#"> Manamei </a> </td>
																		<td class="pp_amnt txt_rt"> 2,000 </td>
																		<td class="pp_dis"> <input type="text" value="10"> </td>
																		<td class="pp_ttl txt_rt"> 18,00 </td>
																	</tr>
																</table>
															</div>
														</td>
													</tr>
													<tr>
														<td class="brnd_ane"> <a href="#"> Brand Name</a> </td>
														<td class="pp_amnt txt_rt"> 10,000 </td>
														<td class="pp_dis"> <input type="text"> </td>
														<td class="pp_ttl txt_rt"> 9,000 </td>
													</tr>
													<tr>
														<td class="brnd_ane"> <a href="#"> Brand Name</a> </td>
														<td class="pp_amnt txt_rt"> 10,000 </td>
														<td class="pp_dis"> <input type="text"> </td>
														<td class="pp_ttl txt_rt"> 9,000 </td>
													</tr>
													<tr>
														<td class="brnd_ane"> <a href="#"> Brand Name</a> </td>
														<td class="pp_amnt txt_rt"> 10,000 </td>
														<td class="pp_dis"> <input type="text"> </td>
														<td class="pp_ttl txt_rt"> 9,000 </td>
													</tr>
													<tr>
														<td class="brnd_ane"> <a href="#"> Brand Name</a> </td>
														<td class="pp_amnt txt_rt"> 10,000 </td>
														<td class="pp_dis"> <input type="text"> </td>
														<td class="pp_ttl txt_rt"> 9,000 </td>
													</tr>
												</table>
											</div>
										</td>
									</tr>
								</tbody>
							</table>

							<table border="0" cellpadding="0" cellspacing="0">
								<thead data-toggle="collapse" data-target="#mech_tbl" aria-expanded="false" aria-controls="mech_tbl">
									<tr>
										<th>
											<span class="tggl_act">
												<img src="http://3.7.44.132/aquacredit/assets/images/plu.svg" class="plu">
												<img src="http://3.7.44.132/aquacredit/assets/images/mini.svg" class="mini">
											</span>
											Machinery (5) 
										</th>
										<th class="pp_amnt txt_rt"> </th>
										<th class="pp_dis"> </th>
										<th class="pp_ttl txt_rt">   </th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td colspan="4">
											<div id="mech_tbl" class="collapse show tgl_div">
												<table border="0" cellpadding="0" cellspacing="0">
													<tr>
														<td class="brnd_ane"> <b> Brand Name </b> </td>
														<td class="pp_amnt txt_rt"> <b> MRP's Total </b> </td>
														<td class="pp_dis"> <b> Discount </b> </td>
														<td class="pp_ttl txt_rt"> <b> Total </b> </td>
													</tr>
													<tr>
														<td class="brnd_ane"> <a href="#"> Brand Name</a> </td>
														<td class="pp_amnt txt_rt"> 10,000 </td>
														<td class="pp_dis"> <input type="text"> </td>
														<td class="pp_ttl txt_rt"> 9,000 </td>
													</tr>
													<tr>
														<td class="brnd_ane"> <a href="#"> Brand Name</a> </td>
														<td class="pp_amnt txt_rt"> 10,000 </td>
														<td class="pp_dis"> <input type="text"> </td>
														<td class="pp_ttl txt_rt"> 9,000 </td>
													</tr>
													<tr>
														<td class="brnd_ane"> <a href="#"> Brand Name</a> </td>
														<td class="pp_amnt txt_rt"> 10,000 </td>
														<td class="pp_dis"> <input type="text"> </td>
														<td class="pp_ttl txt_rt"> 9,000 </td>
													</tr>
													<tr>
														<td class="brnd_ane"> <a href="#"> Brand Name</a> </td>
														<td class="pp_amnt txt_rt"> 10,000 </td>
														<td class="pp_dis"> <input type="text"> </td>
														<td class="pp_ttl txt_rt"> 9,000 </td>
													</tr>
													<tr>
														<td class="brnd_ane"> <a href="#"> Brand Name</a> </td>
														<td class="pp_amnt txt_rt"> 10,000 </td>
														<td class="pp_dis"> <input type="text"> </td>
														<td class="pp_ttl txt_rt"> 9,000 </td>
													</tr>
												</table>
											</div>
										</td>
									</tr>
								</tbody>
							</table>

							<table border="0" cellpadding="0" cellspacing="0">
								<thead data-toggle="collapse" data-target="#med_tbl" aria-expanded="false" aria-controls="med_tbl">
									<tr>
										<th>
										<span class="tggl_act">
											<img src="http://3.7.44.132/aquacredit/assets/images/plu.svg" class="plu">
											<img src="http://3.7.44.132/aquacredit/assets/images/mini.svg" class="mini">
										</span>
										Medicine (5) </th>
										<th class="pp_amnt txt_rt">  </th>
										<th class="pp_dis">  </th>
										<th class="pp_ttl txt_rt"> </th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td colspan="4">
											<div id="med_tbl" class="collapse show tgl_div">
												<table border="0" cellpadding="0" cellspacing="0">
													<tr>
														<td class="brnd_ane"> <b> Brand Name </b> </td>
														<td class="pp_amnt txt_rt"> <b> MRP's Total </b> </td>
														<td class="pp_dis"> <b> Discount </b> </td>
														<td class="pp_ttl txt_rt"> <b> Total </b> </td>
													</tr>
													<tr>
														<td class="brnd_ane"> <a href="#"> Brand Name</a> </td>
														<td class="pp_amnt txt_rt"> 10,000 </td>
														<td class="pp_dis"> <input type="text"> </td>
														<td class="pp_ttl txt_rt"> 9,000 </td>
													</tr>
													<tr>
														<td class="brnd_ane"> <a href="#"> Brand Name</a> </td>
														<td class="pp_amnt txt_rt"> 10,000 </td>
														<td class="pp_dis"> <input type="text"> </td>
														<td class="pp_ttl txt_rt"> 9,000 </td>
													</tr>
													<tr>
														<td class="brnd_ane"> <a href="#"> Brand Name</a> </td>
														<td class="pp_amnt txt_rt"> 10,000 </td>
														<td class="pp_dis"> <input type="text"> </td>
														<td class="pp_ttl txt_rt"> 9,000 </td>
													</tr>
													<tr>
														<td class="brnd_ane"> <a href="#"> Brand Name</a> </td>
														<td class="pp_amnt txt_rt"> 10,000 </td>
														<td class="pp_dis"> <input type="text"> </td>
														<td class="pp_ttl txt_rt"> 9,000 </td>
													</tr>
													<tr>
														<td class="brnd_ane"> <a href="#"> Brand Name</a> </td>
														<td class="pp_amnt txt_rt"> 10,000 </td>
														<td class="pp_dis"> <input type="text"> </td>
														<td class="pp_ttl txt_rt"> 9,000 </td>
													</tr>
												</table>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
          				</div>
        			</div>

					<div class="billing_tb" style="display: none;">
						<div class="top_bill_tb">
							<div class="bil_tp_lft top_in_op">
								<h1> PS Prudhvi - #05657 </h1>
								<p> 9876543210 </p>
							</div>
							<div class="bil_tp_rt">
								<ul>
									<li class="top_in_op bdr_non">
										<p> Location </p>
										<h1> Kakinada </h1>
									</li>
									<li class="top_in_op">
										<p> Billing Date </p>
										<h1> 12-May-2020 </h1>
									</li>
								</ul>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="rat_blk">
									<div class="rto_tons">
										Harvest
										<div class="rto_val"> 1.000 tons </div>
									</div>
									<div class="ratio_icon grt_rto">
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
										<div class="rto_txt"> FCR: <span class="blue_txt">1:1.2</span> </div>
										<div class="sts_rto">  Good </div>
									</div>
									<div class="rto_tons">
										Feed Usage
										<div class="rto_val"> 1.200 tons </div>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<table border="none" class="prods_ls_blk">
									<thead>
										<tr>
											<th> Feeds </th>
											<th class="no_bgs"> No.of.bags </th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td> Product Name - 50kgs </td>
											<td class="no_bgs"> 5 </td>
										</tr>
										<tr>
											<td> Product Name - 50kgs </td>
											<td class="no_bgs"> 5 </td>
										</tr>
										<tr>
											<td> Product Name - 50kgs </td>
											<td class="no_bgs"> 5 </td>
										</tr>
										<tr>
											<td> Product Name - 50kgs </td>
											<td class="no_bgs"> 5 </td>
										</tr>
										<tr>
											<td> Product Name - 50kgs </td>
											<td class="no_bgs"> 5 </td>
										</tr>
										<tr>
											<td> <b> Total Bags </b> </td>
											<td class="no_bgs"> <b> 25 </b> </td>
										</tr>
									</tbody>
								</table>
							</div>
          				</div>

                		<div class="row card_list">
							<div class="col-md-9">
								<div class="row">
									<div class="col-md-4">
										<div class="analtic_blk">
											<p class="anl_sml_txt"> Loan Amount </p>
											<h1 class="anl_lrg_txt"> ₹1,42,000 </h1>
											<ul>
												<li>
												<span class="anl_sml_txt">Total Amount</span>
												<span class="li_amnt_an"> ₹1,20,000 </span>
												</li>
												<li>
												<span class="anl_sml_txt">Total Interest</span>
												<span class="li_amnt_an"> ₹24,000 </span>
												</li>
											</ul>
										</div>
                					</div>

									<div class="col-md-4">
										<div class="analtic_blk">
											<p class="anl_sml_txt"> Feed Amount </p>
											<h1 class="anl_lrg_txt"> ₹90,000 </h1>
											<ul>
												<li>
												<span class="anl_sml_txt">Total Amount</span>
												<span class="li_amnt_an"> ₹1,00,000 </span>
												</li>
												<li>
												<span class="anl_sml_txt">Total Discount</span>
												<span class="li_amnt_an"> ₹10,000 </span>
												</li>
											</ul>
										</div>
									</div>

									<div class="col-md-4">
										<div class="analtic_blk">
											<p class="anl_sml_txt"> Medicine Amount </p>
											<h1 class="anl_lrg_txt"> ₹90,000 </h1>
											<ul>
												<li>
												<span class="anl_sml_txt">Total Amount</span>
												<span class="li_amnt_an"> ₹1,00,000 </span>
												</li>
												<li>
												<span class="anl_sml_txt">Total Discount</span>
												<span class="li_amnt_an"> ₹10,000 </span>
												</li>
											</ul>
										</div>
									</div>

									<div class="col-md-4">
										<div class="analtic_blk">
											<p class="anl_sml_txt"> Machinery Amount </p>
											<h1 class="anl_lrg_txt"> ₹90,000 </h1>
											<ul>
												<li>
												<span class="anl_sml_txt">Total Amount</span>
												<span class="li_amnt_an"> ₹1,00,000 </span>
												</li>
												<li>
												<span class="anl_sml_txt">Total Discount</span>
												<span class="li_amnt_an"> ₹10,000 </span>
												</li>
											</ul>
										</div>
									</div>

									<div class="col-md-4">
										<div class="analtic_blk">
											<p class="anl_sml_txt"> Harvest </p>
											<h1 class="anl_lrg_txt"> ₹10,000 </h1>
											<ul>
												<li>
												<span class="anl_sml_txt">Type</span>
												<span class="li_amnt_an"> Vannamei </span>
												</li>
												<li>
												<span class="anl_sml_txt">Total Tons</span>
												<span class="li_amnt_an"> 1.200 </span>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="ext_pop_chrs">
									<ul>
										<li><span class="fl"> Transport </span> <span class="fr"> ₹2,000 </span> </li>
										<li><span class="fl"> Lab Fee </span> <span class="fr"> ₹3,000 </span> </li>
										<li><span class="fl"> Receipts </span> <span class="fr"> ₹10,0000 </span> </li>
										<li><span class="fl"> Return </span> <span class="fr"> ₹5000 </span> </li>
									</ul>
								</div>
							</div>
         				</div>

						<div class="list_all_vew">
							<table border="0" cellpadding="0" cellspacing="0">
								<thead>
								<tr>
								<th class="date"> Date </th>
								<th> Details </th>
								<th class="txt_rt">  Amount  </th>
								</tr>
								</thead>
								<tbody>
								<tr>
									<td class="date"> 01-Jan-2020 </td>
									<td> <a href="#"> LN123456 </a> </td>
									<td class="txt_red txt_rt out_td"> -10,000 <div class="arr_blk"> <img src="http://3.7.44.132/aquacredit/assets/images/rd_c_ar.png" class="mCS_img_loaded"> </div> </td>
								</tr>
								<tr>
									<td> </td>

									<td colspan="2">
									<table>
										<tbody><tr>
										<th> Crop Location </th>
										<th> Loan Type </th>
										<th> Loan Amount </th>
										<th>  </th>
										<th>  </th>
										</tr>
										<tr>
										<td> Kakinada </td>
										<td> Crop Loan </td>
										<td> 20,000 </td>
										<td>  </td>
										<td>  </td>
										</tr>
									</tbody></table>
								</td>

								</tr>
								<tr>
									<td class="date"> 01-Jan-2020 </td>
									<td> <a href="#"> LN123456 </a> </td>
									<td class="txt_red txt_rt out_td"> -10,000 <div class="arr_blk"> <img src="http://3.7.44.132/aquacredit/assets/images/rd_c_ar.png" class="mCS_img_loaded"> </div> </td>
								</tr>

								<tr>
									<td class="date"> 01-Jan-2020 </td>
									<td> <a href="#"> LN123456 </a> </td>
									<td class="txt_red txt_rt out_td"> -10,000 <div class="arr_blk"> <img src="http://3.7.44.132/aquacredit/assets/images/rd_c_ar.png" class="mCS_img_loaded"> </div> </td>
								</tr>

								</tbody>
							</table>
						</div>
        			</div>
    			</div>
     			<div class="footer_pp"> <button class="btn btn-primary"> Next </button> </div>
      		</div>
   		</div>
	</div>

  	<div class="sle_cr_r">
		<div class="card_view cp_anl">
			<ul class="trd_anl">
				<li class="bor_lf_none">
					<div class="top_in_op crop_top">
						<p> Loan </p>
						<h1> ₹10,00,00 </h1>
					</div>
				</li>
				<li class="">
					<div class="top_in_op crop_top">
						<p> Orders </p>
						<h1> ₹10,00,00 </h1>
					</div>
				</li>
				<li class="">
					<div class="top_in_op crop_top">
						<p> Crop Outputs </p>
						<h1> ₹10,00,00 </h1>
					</div>
				</li>
				<li class="">
					<div class="top_in_op crop_top">
						<p> Acres </p>
						<h1> 2 </h1>
					</div>
				</li>
            	<li class="fr slc_usr">
      				<div class="check_wt_serc val_seld">
						<div class="show_va">Selected  Crop</div>
						<div class="selectVal">  Kakinada Crop 1 </div>
						<ul class="check_list">
							<li id="crop_opt_li">
								<div class="form-check">
									<input class="form-check-input" type="radio" name="crop_opt" id="brn1" value="">
									<label class="form-check-label" for="brn1">
										Kakinada Crop 1
									</label>
								</div>
							</li>
							<li id="crop_opt_li">
								<div class="form-check">
									<input class="form-check-input" type="radio" name="crop_opt" id="brn2" value="">
									<label class="form-check-label" for="brn2">
										Kakinada Crop 2
									</label>
								</div>
							</li>
						</ul>
					</div>
    			</li>
         	</ul>
		</div>
		<div class="urs_dt">
			<div class="">
				<div class="res_tbl">
					<table id="usr_lst_tbl" class="table table-striped table-bordered" style="width:100%">
						<thead>
							<tr>
								<th class="date">  Date
									<span class="sts_pp">
										<i class="fa fa-filter" aria-hidden="true" style="font-size: 9px;"></i>
									</span>
									<div class="sts_fil_blk">
										<div class="form-check">
											<input class="form-check-input" type="radio" name="optradio" value="" id="this_mnt">
											<label class="form-check-label" for="this_mnt">
												This Month
											</label>
										</div>
										<div class="form-check">
											<input class="form-check-input" type="radio" name="optradio" value="" id="last_3mont">
											<label class="form-check-label" for="last_3mont">
												Last 3 Months
											</label>
										</div>
										<div class="form-check">
											<input class="form-check-input" type="radio" name="optradio" value="" id="last_6mon">
											<label class="form-check-label" for="last_6mon">
												Last 6 Months
											</label>
										</div>
										<div class="form-check">
											<input class="form-check-input" type="radio" name="optradio" value="" id="one_year">
											<label class="form-check-label" for="one_year">
												1 Year
											</label>
										</div>
										<div class="form-check">
											<input class="form-check-input" type="radio" name="optradio" value="" id="choos_date">
											<label class="form-check-label" for="choos_date">
												Choose Date
											</label>
										</div>
									</div>
								</th>
								<th class="details"> Detail
									<span class="sts_pp">
										<i class="fa fa-filter" aria-hidden="true" style="font-size: 9px;"></i>
									</span>
									<div class="sts_fil_blk rad_btns">
										<label class="form-check-label radio_blk checkd" for="ln">
											<input class="form-check-input" type="radio" name="optradio" value="" id="ln"> Loan
										</label>

										<label class="form-check-label radio_blk" for="gds">
											<input class="form-check-input" type="radio" name="optradio" value="" id="gds">
											Goods
										</label>

										<label class="form-check-label radio_blk" for="crp_op">
											<input class="form-check-input" type="radio" name="optradio" value="" id="crp_op">
											Crop Outputs
										</label>

										<label class="form-check-label radio_blk" for="expn">
											<input class="form-check-input" type="radio" name="optradio" value="" id="expn">
											Expences
										</label>


										<label class="form-check-label radio_blk" for="urp">
											<input class="form-check-input" type="radio" name="optradio" value="" id="urp">
											User repayment
										</label>
									</div>
								</th>
								<!-- <th width="150" class="txt_rt in_td"> In </th> -->
								<th width="150" class="txt_rt out_td"> Amount </th>
            				</tr>
          				</thead>
          				<tbody>
							<tr>
								<td class="date"> 01-Jan-2020 </td>
								<td> <a href="#" title=""> Loan - LN123456 </a> </td>
								<!-- <td class="txt_rt in_td"> </td> -->
								<td class="txt_red txt_rt out_td"> -10,000
								<div class="arr_blk"> <img src="http://3.7.44.132/aquacredit/assets/images/rd_c_ar.png"> </div>
								</td>
							</tr>
							<tr class="detal_row">
								<td class="date"> &nbsp; </td>
								<td colspan="2">
									<table>
										<tr>
										<th> Crop Location </th>
										<th> Loan Type </th>
										<th> Loan Amount </th>
										<th>  </th>
										<th>  </th>
										</tr>
										<tr>
										<td> Kakinada </td>
										<td> Crop Loan </td>
										<td> 20,000 </td>
										<td>  </td>
										<td>  </td>
										</tr>
									</table>
								</td>
								<td class="hide_blk"> </td>
								<td class="hide_blk"> </td>
								<td class="hide_blk"> </td>
							</tr>
							<tr>
								<td class="date"> 01-Jan-2020 </td>
								<td> <a href="#" title=""> Goods - LN123456 </a> </td>
								<!-- <td class="txt_rt in_td"> </td> -->
								<td class="grn_clr txt_rt out_td"> +1,800 <div class="arr_blk"> <img src="http://3.7.44.132/aquacredit/assets/images/grn_c_ar.png"> </div>  </td>
							</tr>
							<tr class="detal_row">
								<td class="date">&nbsp;</td>
								<td colspan="2">
									<table>
										<tr>
										<th> Product Name </th>
										<th> Qty </th>
										<th> MRP </th>
										<th> Discount  </th>
										<th> Total Price </th>
										</tr>
										<tr>
										<td> Product Name </td>
										<td> 10 </td>
										<td> 2,000 </td>
										<td> 20% </td>
										<td> 1,800 </td>
										</tr>
									</table>
								</td>
								<td class="hide_blk"> </td>
								<td class="hide_blk"> </td>
								<td class="hide_blk"> </td>
							</tr>
							<tr>
								<td class="date"> 01-Jan-2020 </td>
								<td> <a href="#" title=""> Loan - LN123456 </a> </td>
								<!-- <td class="txt_rt in_td"> </td> -->
								<td class="txt_red txt_rt out_td"> -10,000
								<div class="arr_blk"> <img src="http://3.7.44.132/aquacredit/assets/images/rd_c_ar.png"> </div>
								</td>
							</tr>
							<tr>
								<td class="date"> 01-Jan-2020 </td>
								<td> <a href="#" title=""> Loan - LN123456 </a> </td>
								<!-- <td class="txt_rt in_td"> </td> -->
								<td class="txt_red txt_rt out_td"> -10,000
								<div class="arr_blk"> <img src="http://3.7.44.132/aquacredit/assets/images/rd_c_ar.png"> </div>
								</td>
							</tr>
							<tr>
								<td class="date"> 01-Jan-2020 </td>
								<td> <a href="#" title=""> Loan - LN123456 </a> </td>
								<!-- <td class="txt_rt in_td"> </td> -->
								<td class="txt_red txt_rt out_td"> -10,000
								<div class="arr_blk"> <img src="http://3.7.44.132/aquacredit/assets/images/rd_c_ar.png"> </div>
								</td>
							</tr>
							<tr>
								<td class="date"> 01-Jan-2020 </td>
								<td> <a href="#" title=""> Loan - LN123456 </a> </td>
								<!-- <td class="txt_rt in_td"> </td> -->
								<td class="txt_red txt_rt out_td"> -10,000
								<div class="arr_blk"> <img src="http://3.7.44.132/aquacredit/assets/images/rd_c_ar.png"> </div>
								</td>
							</tr>
							<tr>
								<td class="date"> 01-Jan-2020 </td>
								<td> <a href="#" title=""> Loan - LN123456 </a> </td>
								<!-- <td class="txt_rt in_td"> </td> -->
								<td class="txt_red txt_rt out_td"> -10,000
								<div class="arr_blk"> <img src="http://3.7.44.132/aquacredit/assets/images/rd_c_ar.png"> </div>
								</td>
							</tr>
							<tr>
								<td class="date"> 01-Jan-2020 </td>
								<td> <a href="#" title=""> Loan - LN123456 </a> </td>
								<!-- <td class="txt_rt in_td"> </td> -->
								<td class="txt_red txt_rt out_td"> -10,000
								<div class="arr_blk"> <img src="http://3.7.44.132/aquacredit/assets/images/rd_c_ar.png"> </div>
								</td>
							</tr>
							<tr>
								<td class="date"> 01-Jan-2020 </td>
								<td> <a href="#" title=""> Loan - LN123456 </a> </td>
								<!-- <td class="txt_rt in_td"> </td> -->
								<td class="txt_red txt_rt out_td"> -10,000
								<div class="arr_blk"> <img src="http://3.7.44.132/aquacredit/assets/images/rd_c_ar.png"> </div>
								</td>
							</tr>
							<tr>
								<td class="date"> 01-Jan-2020 </td>
								<td> <a href="#" title=""> Loan - LN123456 </a> </td>
								<!-- <td class="txt_rt in_td"> </td> -->
								<td class="txt_red txt_rt out_td"> -10,000
								<div class="arr_blk"> <img src="http://3.7.44.132/aquacredit/assets/images/rd_c_ar.png"> </div>
								</td>
							</tr>
							<tr>
								<td class="date"> 01-Jan-2020 </td>
								<td> <a href="#" title=""> Loan - LN123456 </a> </td>
								<!-- <td class="txt_rt in_td"> </td> -->
								<td class="txt_red txt_rt out_td"> -10,000
								<div class="arr_blk"> <img src="http://3.7.44.132/aquacredit/assets/images/rd_c_ar.png"> </div>
								</td>
							</tr>
							<tr>
								<td class="date"> 01-Jan-2020 </td>
								<td> <a href="#" title=""> Loan - LN123456 </a> </td>
								<!-- <td class="txt_rt in_td"> </td> -->
								<td class="txt_red txt_rt out_td"> -10,000
								<div class="arr_blk"> <img src="http://3.7.44.132/aquacredit/assets/images/rd_c_ar.png"> </div>
								</td>
							</tr>
							<tr>
								<td class="date"> 01-Jan-2020 </td>
								<td> <a href="#" title=""> Loan - LN123456 </a> </td>
								<!-- <td class="txt_rt in_td"> </td> -->
								<td class="txt_red txt_rt out_td"> -10,000
								<div class="arr_blk"> <img src="http://3.7.44.132/aquacredit/assets/images/rd_c_ar.png"> </div>
								</td>
							</tr>
							<tr>
								<td class="date"> 01-Jan-2020 </td>
								<td> <a href="#" title=""> Loan - LN123456 </a> </td>
								<!-- <td class="txt_rt in_td"> </td> -->
								<td class="txt_red txt_rt out_td"> -10,000
								<div class="arr_blk"> <img src="http://3.7.44.132/aquacredit/assets/images/rd_c_ar.png"> </div>
								</td>
							</tr>
							<tr>
								<td class="date"> 01-Jan-2020 </td>
								<td> <a href="#" title=""> Loan - LN123456 </a> </td>
								<!-- <td class="txt_rt in_td"> </td> -->
								<td class="txt_red txt_rt out_td"> -10,000
								<div class="arr_blk"> <img src="http://3.7.44.132/aquacredit/assets/images/rd_c_ar.png"> </div>
								</td>
							</tr>
							<tr>
								<td class="date"> 01-Jan-2020 </td>
								<td> <a href="#" title=""> Loan - LN123456 </a> </td>
								<!-- <td class="txt_rt in_td"> </td> -->
								<td class="txt_red txt_rt out_td"> -10,000
								<div class="arr_blk"> <img src="http://3.7.44.132/aquacredit/assets/images/rd_c_ar.png"> </div>
								</td>
							</tr>
							<tr>
								<td class="date"> 01-Jan-2020 </td>
								<td> <a href="#" title=""> Loan - LN123456 </a> </td>
								<!-- <td class="txt_rt in_td"> </td> -->
								<td class="txt_red txt_rt out_td"> -10,000
								<div class="arr_blk"> <img src="http://3.7.44.132/aquacredit/assets/images/rd_c_ar.png"> </div>
								</td>
							</tr>
          				</tbody>
           				<tfoot>
							<tr>
								<td class="opic_non date"> &nbsp;   </td>
								<td class="txt_rt"> Total </td>
								<td class="txt_rt in_td"> +4,00000 </td>

							</tr>
							<tr>
								<td class="opic_non date"> &nbsp;  </td>
								<td class="txt_rt type"> Opening Balance</td>
								<td class="txt_rt"> +30 </td>
							</tr>
							<!-- <tr>
								<td class="opic_non date"> &nbsp;  </td>
								<td class="txt_rt type"> <b>Previous Balance <span class="grn_clr"></span></b> </td>
								<td class="grn_clr txt_rt"> <b>+100</b> </td>
							</tr>-->
							<tr>
								<td class="opic_non date"> &nbsp;  </td>
								<td class="txt_rt grd_ttl"> <b>Grand Total <span class="grn_clr"></span></b> </td>
								<td class="grd_ttl txt_rt"> <b>+130</b> </td>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
		<!-- <div class="btm_btn"> <button class="btn btn-primary"> Settle Amount </button> </div> -->
  	</div>
</div>
<script type="text/javascript">

var url = '<?php echo base_url() ?>';
$(document).ready(function() {

	$('.swith_blk').click(function(){
		//   if($(this).find('span').text() == 'Yes'){
		//   $(this).find('span').text('No');
		// }else {
		//   $(this).find('span').text('Yes')
		// }
		$(this).toggleClass('tog_yes');
	});

	var h = $(window).height();
	var min_h = h-315;
	var tables = $('#usr_lst_tbl').DataTable({
		"ordering": false,
		language: {
			searchPlaceholder: "Search Transaction Details",
			search: "",
			"dom": '<"toolbar">frtip'
		},
		"scrollY":  min_h,
			"scrollCollapse": true,
	});
	$('.dataTables_scrollBody').css('height', min_h);
    $('#usr_lst_tbl_wrapper .dataTables_length').html('<ul class="tabs_tbl"><li class="act_tab drft_cl"> <span>Unsettled</span> </li><li class="comp_cl"> <span>Settled </span> </li></ul> <span class="tbl_btn">  </span>');
	// <a href="#" class="appr_all"> Approve All </a>
	$(".loan_btm div.toolbar").html('<b>SSS</b>');
    $('.loan_btm a.toggle-vis').on( 'click', function (e) {
        $(this).parent().toggleClass('act');
        e.preventDefault();
        var column = tables.column( $(this).attr('data-column') );
        column.visible( ! column.visible() );
    });

    $('.dataTables_paginate').html('<a href="#" title=""> Show More </a>');
    $('.ad_nt').click(function(){
		$('.pp_note').toggleClass('show_blk');
	});

	$('.comp_cl').click(function(){
		$(this).addClass('act_tab');
		$('.tabs_tbl').addClass('cmp_ul');
		$('.drft_cl').removeClass('act_tab');
		console.log('load settled');
	});

	$('.drft_cl').click(function(){
		$(this).addClass('act_tab');
		$('.tabs_tbl').removeClass('cmp_ul');
		$('.comp_cl').removeClass('act_tab');
		console.log('load unsettled');
   	});

    $('#fil2').multiselect();
    $('#fil1').multiselect();
    $('#fil3').multiselect();

	$('.loans_tp').click(function(){
		$('.alpha_blk').show();
		$('.side_popup').addClass('opn_slide');
		$('#loans_tp').show();
		$('#orders_tp').hide();
		$('#crop_top').hide();
    });

    $('.orders_tp').click(function(){
		$('.alpha_blk').show();
		$('.side_popup').addClass('opn_slide');
		$('#loans_tp').hide();
		$('#orders_tp').show();
		$('#crop_top').hide();
    });


	$('.crop_top').click(function(){
		$('.alpha_blk').show();
		$('.side_popup').addClass('opn_slide');
		$('#loans_tp').hide();
		$('#orders_tp').hide();
		$('#crop_top').show();
	});

    $('.alpha_blk').click(function(){
        $('.side_popup').removeClass('opn_slide');
        $(this).hide();
    });

    $('.sec_step').click(function(){
        $(this).addClass('act_tb').removeClass('dne_tb');
		$('.fst_step').removeClass('act_tb').addClass('dne_tb');
		$('.thrd_step, .fth_step, .fst_step').removeClass('act_tb dne_tb');
		$('.bdr_blue').css('width', '75px');
		$('.loans_tb').hide();
		$('.sale_tb').show();
		$('.billing_tb').hide();
    });

	$('.fst_step').click(function(){
        $(this).addClass('act_tb').removeClass('dne_tb');
		$('.confrm_blk').show();
		$('.sec_step, .fth_step, .thrd_step').removeClass('act_tb dne_tb');
		$('.thrd_step').removeClass('act_tb dne_tb');
		$('.bdr_blue').removeAttr('style');
		$('.loans_tb').show();
		$('.sale_tb').hide();
		$('.billing_tb').hide();
    });

	$('.thrd_step').click(function(){
		$('.confrm_blk').hide();
		$(this).addClass('act_tb').removeClass('dne_tb');
		$('.fst_step, .fth_step').removeClass('act_tb').addClass('dne_tb');
		$('.sec_step').removeClass('act_tb').addClass('dne_tb');
		$('.bdr_blue').css('width', '150px');
		$('.loans_tb').hide();
		$('.sale_tb').hide();
		$('.billing_tb').show()
    });

	$('.lnk_typ').click(function(){
		$(this).parent('.assign_type').find('.lnk_typ').removeClass('act_type');
		$(this).addClass('act_type');
	});
});
</script>

<?php require_once 'footer.php';?>