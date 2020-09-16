<?php require_once 'header.php';?>
<link href="<?php echo base_url(); ?>assets/css/trade.css" type="text/css" rel="stylesheet">
<?php require_once 'sidebar.php';?>

<style>
	.dataTables_filter {margin-right:0px!important;}
	.ui-menu{
	z-index: 999999 !important;
	}
	.ui-datepicker
	{
	z-index: 999999 !important;
	}
	.cre_error {
		border: 1px solid #f00 !important;
	}
	.cre_valid {
		border: 1px solid #0ff !important;
	}
	.tooltip{
		opacity:0.7 !important;
		z-index:99999;
	}
	.disabledbutton {
		pointer-events: none;
		opacity: 0.4;
	}

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

	@-webkit-keyframes fadeout {
	from {top: 5px; opacity: 1;}
	to {top: 0; opacity: 0;}
	}

	@keyframes fadeout {
	from {top: 5px; opacity: 1;}
	to {top: 0; opacity: 0;}
	}

	.required { border:  1px solid red; }
	.prc_td input {text-align:right}
	.tabs_tbl {list-style: none; padding:9px 0px;position: relative; float: left; margin: 0px 0px 0px 0px;}
	.tabs_tbl li {display: inline-block; /*width: 160px;*/ text-align: center; transition: all linear 0.2s; cursor: pointer; font-size: 13px; position: relative; margin-left: 10px; margin-right: 10px; padding:12px 15px 6px 15px;}
	.tabs_tbl li span {position: relative;z-index: 1; transition: all linear 0.2s;}
	.tabs_tbl li:after {height: 0px; transition: all linear 0.2s;}
	.tabs_tbl:after {position: absolute; transition: all linear 0.2s; bottom: -2px; left: 0px; border-top-left-radius: 5px;
	border-top-right-radius: 5px; transform: perspective(5px) rotateX(0.93deg) translateZ(-1px); transform-origin:0 0; content: ' ';  height: 57px; width: 120px; background: #007bff;}
	/*.tabs_tbl li.act_tab:after {position: absolute;  bottom: -10px; left: 0; width: 100%; height: 1px; content: ' '; background:#007bff; }*/
	.tabs_tbl li.act_tab span {color: #fff;}
	.note_blk .pop_footer {border:none!important; padding: 0px!important; margin: 0px!important;}
	.tabs_tbl.cmp_ul:after {left: 110px;    width: 140px;}
	.assign_type li.act_type {border-color: #7abaff;  box-shadow: 5px 5px 5px -1px rgba(0,123,255,0.10); position: relative;}
	.assign_type li input {opacity: 0; position: absolute; cursor: pointer; top: 0px; left: 0px; width: 100%; height: 100%;}
	.lnk_typ.assign_type li input {cursor: pointer;}
	.sts_fil_blk.lrg_flt .form-check {
		/* width: 100%; */
		float: left;
		/* padding: 5px 20px; */
	}
	.sts_fil_blk.lrg_flt{
		width:400px !important;
	}
</style>
<div class="right_blk">
	<div class="top_ttl_blk"> <span class="padin_t_5">Trades  </span>
		<span class="crt_link fr">
            <button class="btn btn-primary"> Create Trade </button>
            <i class="fa fa-times cl_crt_bl hide_blk" aria-hidden="true"></i>
        </span>
		
    </div>
	<!-- Create Trade Start -->
	<div class="trade_create">
		<div class="crt_blk">
		    <div id="snackbar" class=""></div>
		    <h2 class="create_hdg"> Create Trade </h2>
            <div class="ove_auto">
                <form id="tradefrm" name="tradefrm" action="javascript:void(0);" method="post">
			        <div class="trd_cr">
				        <div class="type_trd rad_btns">
                            <label class="radio-inline radio_blk checkd">
                                <input  type="radio" value="credit" name="trade_type" onclick="return ttype('credit');" checked="checked" >Credit
                            </label>
                            <label class="radio-inline radio_blk">
                                <input type="radio" value="guest" name="trade_type" onclick="return ttype('guest');" >Guest
                            </label>
				        </div>

                        <div class="cre_inp inp_ss">
                            <div class="sm_blk"> Date </div>
                            <input type="text" class="form-control mykey" name="trade_date" id="trade_date" value="<?php echo date('d-M-Y'); ?>" >
                        </div>

                        <!-- Trader start -->
                        <div class="cr_trd_blk">
                            <div class="form-group cre_inp sel_loc">
                                <div class="sm_blk"> Select Trader </div>
                                <!-- <input type="text" class="form-control" id="tkey" name="tkey" onkeypress="return gettrader();" /> -->
                                <input type="text" class="form-control mykey" id="tkey" name="tkey"  />
                                <input type="hidden" class="form-control" id="traderid" name="traderid" />
                                <!-- <div id="suggesstion-box1"></div> -->
                            </div>
                            <div class="form-group cre_inp  sel_loc">
                                <div class="sm_blk"> Select User </div>
                                <!-- <input type="text" class="form-control" id="ukey" name="ukey" onkeypress="return getuser();"/> -->
                                <!-- <div id="suggesstion-box"></div> -->
                                <input type="text" class="form-control mykey" id="ukey" name="ukey" />
                                <input type="hidden" class="form-control" id="userid" name="userid" />
                                <input type="hidden" class="form-control" id="usercode" name="usercode" />
                            </div>
                        
                            <div class="form-group cre_inp" style="display: none;" id="guestmobile">
                                <input type="text" maxlength="10" class="form-control noalpha mykey" id="mobile" name="mobile" Placeholder=" Enter Mobile " />
                            </div>
							<div class="form-group cre_inp" style="display: none;" id="guest_location">
								<div class="sm_blk"> Location </div>
								<input type="text"  class="form-control mykey" placeholder="" name="location" id="location">
                            </div>
                            <div class="form-group" id="cropdis">
                                <div class="check_wt_serc" id="crps">
                                    <div class="show_va">Crop location</div>
                                    <div class="selectVal">  Crop location </div>
                                    <ul class="check_list" id="crop_1">
                                        <li id="crop_opt_li">
                                            <div class="form-check">
                                                <input class="form-control form-check-input mykey" type="radio" name="crop_opt" id="crop_opt" value="" required>
                                                <label class="form-check-label" for="crop_opt">
                                                Crop Location
                                                </label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Expected Count -->
                        <b class="exp_ttl"> Expected <!-- <a href="#" title="" class="note"> Add Note </a> --> </b>

                        <div class="trd_c_row">
                            <div class="trd_c_cel">
                                <div class="cre_inp">
                                    <div class="sm_blk"> Count </div>
                                    <input type="text"  class="form-control mykey" placeholder="" name="exp_count" id="exp_count">
                                </div>
                            </div>
                            <div class="trd_c_cel">
                                <div class="cre_inp">
                                    <div class="sm_blk"> Weight(Tons) </div>
                                    <input type="text"  class="form-control mykey" placeholder="" name="exp_weight_kgs" id="exp_weight_kgs" >
                                </div>
                            </div>
                        </div>

                        <div class="trd_c_row frm_prc">
                            <div class="" style="width: 48%; float: left; margin-right: 10px;">
                                <div class="cre_inp">
                                    <div class="sm_blk"> Company Price </div>
                                    <input type="text" class="form-control mykey" placeholder="" name="exp_company_price" id="exp_company_price" >
                                    <!-- <input type="hidden" class="form-control" placeholder="" name="exp_company_price" id="exp_company_price" > -->
                                </div>
                                <span class="amon_text1"> </span>
                            </div>
                            <div class="" style="width: 47%; float: left;">
                                <div class="cre_inp">
                                    <div class="sm_blk"> Farmer Price </div>
                                    <input type="text"  class="form-control mykey" placeholder="" name="exp_farmer_price" id="exp_farmer_price">
                                    <!-- <input type="hidden" class="form-control" placeholder="" name="exp_farmer_price" id="exp_farmer_price" > -->
                                </div>
                                <span class="amon_text"> </span>						
                            </div>
                        </div>
				        <textarea rows="4" style="display: inline-block;" placeholder="Note" class="note_txt mykey" name="note" id="note"></textarea>
				    </div>

			        </div>

		            <div class="trd_subm">
		                <button type="submit" name="trade_btn" class="btn btn-primary trade_btn" >Submit</button>
		            </div> 
                    </div>
	            </form>
		    </div>
	<!-- Create Trade End -->
	<div class="trd_cr_r">
	    <div class="mar_btm_20">
	        <div class="card_view dis_tbl">
                <ul class="trd_anl">
		            <li class="bor_lf_none">
			            <div class="top_in_op crop_top">
                            <p> Total Amount </p>
                            <h1 id="trade_totalamount"> ₹0 </h1>
                        </div>
                    </li>
		            <li class="">
			            <div class="top_in_op crop_top">
                            <p> Pending Amount</p>
                            <h1 id="pending_amount"> 0</h1>
                        </div>
                    </li>
                    <li class="">
                        <div class="top_in_op crop_top">
                            <p> Total Tons </p>
                            <h1 id="trade_tons"> 0 </h1>
                        </div>
		            </li>
		        </ul>
    		</div>
	    </div>

        <div class="lst_trd">
            <div class="card_view">
                <div class="">
                    <div class="res_tbl">
                        <table id="usr_lst_tbl" cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped " style="width:100%">
                            <thead>
                            <tr>
                                <th class="id_td"> Id </th>
                                <th class="date_td"> Date
                                <span class="pull-right" id="reportrange">
                                    <i class="fa fa-filter"  aria-hidden="true" style="font-size: 9px;"></i>
                                    <span></span>
                                </span>
                                <input type="hidden" id="date_val" name="date_val" />
                                </th>
                                <th> Trader Name
                                    <span class="sts_pp">
                                        <i class="fa fa-filter" aria-hidden="true" style="font-size: 9px;"></i>
                                    </span>
                                    <div class="sts_fil_blk lrg_flt">
                                    
                                        <input type="search" class="form-control" id="trader_searchkey" placeholder="Search" >
                                        <div class=""  id="traderslist_search">
                                                                                
                                        </div>
                                    </div>	
                                </th>
                                <th> User Name 
                                    <span class="sts_pp">
                                        <i class="fa fa-filter" aria-hidden="true" style="font-size: 9px;"></i>
                                    </span>
                                    <div class="sts_fil_blk lrg_flt">
                                        <input type="search" class="form-control" id="user_searchkey"  placeholder="Search" >
                                        <div class=""  id="userlist_search">
                                                                                
                                        </div>
                                        
                                    </div>
                                </th>
                                <th> Note </th>
                                <th class="act_ms"> Actions </th>
                            </tr>
                            </thead>

                            <tbody>


                            </tbody>
                        </table>
						
                        <input type="hidden" id="hid_lid" name="hid_lid" />
                        <input type="hidden" id="hid_tabval" name="hid_tabval" value="0" />
						<div id="overlay"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="delete_trade">
	<div class="modal-dialog">
		<div class="modal-content">
		<div class="modal-body">
			<h1> Are You Sure ! </h1>
			<p> You want delete this Trade </p>
		</div>
		<div class="modal_footer">

			<button type="button" class="btn btn-primary del_yes" data-dismiss="modal">Yes</button>
			<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
		</div>
		</div>
	</div>
</div>

<div id="popover-content" style="display: none">
	<div class="custom-popover">
		<ul class="list-group">
			<li class="list-group-item edt">Edit</li>
			<li class="list-group-item del">Delete</li>
		</ul>
	</div>
</div>

<div id="popover-content1" style="display: none">
	<div class="custom-popover">
		<ul class="list-group">
			<li class="list-group-item edt">View</li>
		</ul>
	</div>
</div>

<div class="ap_blk"> </div>

<div id="edt_user_id">
	<div class="pp_clss"> <i class="fa fa-times" aria-hidden="true"></i> </div>
	<div class="tr_exp_dtl">
	<div id="snackbar1" class=""></div>
		<div class="hdg_bks"> Trade Expected Details <span id="trade_edit_id"></span></div>
		<div class="over_x_hdn">
			<div class="pop_min_h_div">
			<form id="tradefrm_edit_exp" name="tradefrm_edit_exp" action="javascript:void(0);" method="post">
				<div class="top_no_txt">
					<div class="brd_lft brd_all"></div>
					<div class="brd_rt brd_all"></div>
					<div class="brd_tp brd_all"></div>
					<div class="brd_btm brd_all"></div>
					<div class="edt_bl_lnk">
						<span class="edt_lnk" id="edthide">
						<!-- <i id="edthide1" class="fa fa-edit" aria-hidden="true"></i> -->
						<img class="idt_icn" src="http://3.7.44.132/aquacredit/assets/images/edit.svg" alt="" title="">
						Edit</span>
						<input type="submit" value="Save" class="save_lnk">
					</div>
					<input type="hidden" id="endis" value="0">
					<input type="hidden" class="trade_id" name="trade_id" />
					<input type="hidden"  id="" class="userid_edit" name="userid_edit" >
					<input type="hidden"  class="traderid_edit" name="traderid_edit" >
				<ul class="top_exp_blk disb_sel">
					<li>
					<div class="cre_inp inp_ss">
						<div class="sm_blk"> Trader </div>
						<!-- <input type="text" class="form-control" placeholder="" data-original-title="" title="" value="" name="tkey_edit" id="tkey_edit" onkeypress="return gettraderedit();" > -->
						<!-- <div id="suggesstion-box1_edit"></div> -->
						<input type="text" class="form-control mykey" placeholder="" data-original-title="" title="" value="" name="tkey_edit" id="tkey_edit"  >
						<input type="hidden" class="form-control"  value="" name="trade_type_edit" id="trade_type_edit"  >
					</div>
					</li>
					<li>
					<div class="cre_inp inp_ss">
						<div class="sm_blk"> User</div>
						<!-- <input type="text" class="form-control" placeholder="" data-original-title="" name="ukey_edit" id="ukey_edit" onkeypress="return getuseredit();" >
						<div id="suggesstion-box_edit"></div> -->
						<input type="text" class="form-control mykey" placeholder="" data-original-title="" name="ukey_edit" id="ukey_edit"  >
					</div>
					</li>
					<li id="mobiledis" style="display: none;">
					<div class="cre_inp inp_ss">
						<div class="sm_blk"> Mobile</div>

						<input type="text" class="form-control mykey noalpha"  placeholder="" data-original-title="" name="mobile_edit" id="mobile_edit"  >
					</div>
					</li>
					<li>
					<div class="check_wt_serc val_seld" id="crplist_edit">
								<div class="show_va">Crop location</div>
								<div class="selectVal  crop_type_val">  Crop location </div>
								<ul class="check_list" id="crp_e1">
									<li id="crop_opt_li_edit">
									<div class="form-check">
										<input class="form-check-input mykey" type="radio" name="crop_opt_edit" id="crop_opt_edit" required value="">
										<label class="form-check-label" for="crp">
										Crop Location
										</label>
									</div>
									</li>
								</ul>
								<label id="crop_opt_edit-error" class="error" for="crop_opt_edit"></label>
								</div>
					</li>
				</ul>
				<ul class="btm_exp_blk disb_sel">
					<li class="dt_inp">
						<div class="cre_inp inp_ss">
						<div class="sm_blk"> Date </div>
						<input type="text" class="form-control mykey" placeholder="" name="trade_date_edit" id="trade_date_edit" onkeydown="return false;">
					</div>
					</li>
					<li class="count_inp">
						<div class="cre_inp inp_ss">
						<div class="sm_blk"> Count </div>
						<input type="text" class="form-control mykey" placeholder="" value="" name="exp_count_edit" id="exp_count_edit">
					</div>
					</li>

					<li class="wt_inp">
						<div class="cre_inp inp_ss">
						<div class="sm_blk"> Weight(Tons) </div>
						<input type="text" class="form-control mykey" placeholder="" value="" name="exp_weight_kgs_edit" id="exp_weight_kgs_edit" onkeypress="return isWeight(this,event)">
					</div>
					</li>
					<li class="prc_inp">
								<div class="cre_inp inp_ss">
								<div class="sm_blk"> Company Price </div>
								<input type="text"  class="form-control mykey" placeholder="" value="" name="exp_company_price_val_edit" id="exp_company_price_val_edit" onkeyup="amount_with_commasedit_val();" onkeypress="return isPrice(this,event)">
								<input type="hidden" class="form-control" name="exp_company_price_edit" id="exp_company_price_edit" >
								<!-- <span class="amon_text2"> </span> -->
							</div>
							</li>
							<li class="prc_inp">
								<div class="cre_inp inp_ss">
								<div class="sm_blk"> Farmer Price </div>
								<input type="text" maxlength="10" class="form-control mykey" placeholder="" value="" name="exp_farmer_price_val_edit" id="exp_farmer_price_val_edit" onkeyup="amount_with_commasedit();" onkeypress="return isPrice(this,event)">
								<input type="hidden" class="form-control" name="exp_farmer_price_edit" id="exp_farmer_price_edit" >
								<!-- <span class="amon_text3"> </span> -->
							</div>
					</li>
					<li class="prc_inp">
						<div class="cre_inp inp_ss note_wth">
							<div class="sm_blk"> Note</div>
							<textarea placeholder="Note" id="note_edit" name="note_edit"  class="form-control mykey" disabled></textarea>
						</div>
					</li>


					<!-- <li class="not_li note_blk"> 
						<a href="" title="" class="ad_note" data-toggle="modal"> Note </a>
							<div class="note_entr">
								<div class="form-group note_area">
									
								</div>
							</div>
					</li> -->
				</ul>
			</div>
			</form>
			<form id="tradefrm_edit" name="tradefrm_edit" action="javascript:void(0);" method="post">
				<div class="tr_act_dtls">
					<div class="hdg_bks"> Trade Actual Details  <!-- <a href="#" title="" class="fr"> Add More </a> --> </div>
					<div class="pop_res_tbl">
					<table class="actl_tbl table" cellspacing="0" cellpadding="0" border="0">
						<thead>
						<tr>
							<th colspan="2"> </th>
							<th class="bor_t_b_none"> <div> &nbsp;</div> </th>
							<th colspan="3" class="com_bg"> Final Company Details</th>
							<th class="bor_t_b_none"> <div> &nbsp;</div> </th>
							<th colspan="3" class="far_bg"> Final Farmer Details </th>
						</tr>
						<tr>
							<td class="date_td"> Date </td>
							<td class="cnt_wth"> Count </td>
							<td class="bor_t_b_none"> <div> &nbsp;</div> </td>
							<td class="com_bg prc_td"> Price </td>
							<td class="com_bg weig"> Weight(Kgs) </td>
							<td class="com_bg amnt_td"> Amount </td>
							<td class="bor_t_b_none"> <div> &nbsp;</div> </td>
							<td class="far_bg prc_td"> Price </td>
							<td class="far_bg weig"> Weight(Kgs) </td>
							<td class="far_bg amnt_td"> Amount </td>
						</tr>
						</thead>
						<tbody id="invoiceItem">
						<input type="hidden" name="rcntval" id="rcntval" >
						</tbody>
						<tfoot>
						<tr>
							<td colspan="2" class="total"> </td>
							<td class="bor_t_b_none"> <div> &nbsp;</div> </td>
							<td>  </td>
							<td class="txt_rt" > <span id="cweight" > 0 </span> </td>
							<td class="total" > <span id="camount" > 0 </span> </td>
							<td class="bor_t_b_none"> <div> &nbsp;</div> </td>
							<td></td>
							<td class="txt_rt" > <span id="fweight" > 0 </span> </td>
							<td class="total"> <span id="famount" > 0 </span> </td>
						</tr>
							<tr>
							<td colspan="2" class="pad_none"> </td>
							<td class="bor_t_b_none"> <div> &nbsp;</div> </td>
							<td colspan="3" class="pad_none"> </td>
							<td class="bor_t_b_none"> <div> &nbsp;</div> </td>
							<td colspan="3" class="pad_none">
								<table class="extra_tbl">
								<tr>
									<td class="far_bg"> Expenses  </td>
									<td class="far_bg" width="120"> <input type="text" class="form-control noalpha" placeholder="" id="expenses" name="expenses" > </td>
								</tr>
								<tr>
								<td class="far_bg"> Lab Fee </td>
									<td class="far_bg" width="120"> <input type="text" class="form-control noalpha" placeholder="" id="labfee" name="labfee"  > </td>
								</tr>
								<tr>
									<td class="far_bg"> <b>Grand Total</b></td>
									<input type="hidden" class="form-control" name="gtotalval" id="gtotalval" >
									<input type="hidden" class="form-control" name="cweightval" id="cweightval" >
									<input type="hidden" class="form-control" name="camountval" id="camountval" >
									<input type="hidden" class="form-control" name="fweightval" id="fweightval" >
									<input type="hidden" class="form-control" name="famountval" id="famountval" >
									<input type="hidden" class="form-control" name="status" id="status" value="0">
									<td class="txt_rt far_bg"> <b id="gtotal">0</b> </td>
								</tr>
							</table>
							</td>
						</tr>
						</tfoot>
					</table>
					</div>
					<div class="clr_btn"> </div>
				</div>
				<div class="sb_btm">
					<input type="hidden" class="trade_id" name="trade_id" />
					<input type="hidden"  id="" class="userid_edit" name="userid_edit" >
					<input type="hidden"  class="traderid_edit" name="traderid_edit" >						
					<button class="fr btn btn-success updt_btn" id="fnhide" > Finish Trade </button>
					<button type="submit" class="fr btn btn-primary" id="upthide" >Update</button>
				</div>
			</form>
			</div>		
		</div>
	</div>
</div>
<!-- Trader Actual Details -->

<div id="note_cnt">

</div>

<script type="text/javascript">
var url = "<?php echo base_url()?>";
</script>
<script src="<?php echo base_url();?>assets/js/trade.js"></script>

<?php require_once 'footer.php';?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<style type="text/css">
.sorting, .sorting_asc, .sorting_desc {
	background : none !important;
}
.note_wth {width: 220px!important;}
.idt_icn {width: 13px;
    position: relative;
    top: -2px;
    left: 0px;}
</style>