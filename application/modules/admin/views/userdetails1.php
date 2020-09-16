<?php require_once 'header.php';?>
<link href="<?php echo base_url(); ?>assets/css/user_detials.css" type="text/css" rel="stylesheet">
<script src='https://kit.fontawesome.com/a076d05399.js'></script> 
<?php require_once 'sidebar.php';?>   
<style type="text/css">
.trans_inf li {min-width:200px;}
.trans_inf li li {min-width:auto;}
.modal, .ui-autocomplete {
    z-index: 9999 !important;
}
 .ui-datepicker {
    z-index: 999999999 !important;
}
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
.trans_detail tr td:first-child {width: 2px!important;}
.down_blk {width: 100px!important;}
#snackbar.show {
  visibility: visible;
  -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
  animation: fadein 0.5s, fadeout 0.5s 2.5s;
}
#table_footer td.tr_amount{padding-right:50px;width:120px;}
 #usr_lst_tbl_wrapper th.pl_m {
  width: 33.2667px!important;
  text-align: center;
    border-right: 1px solid #f0f1f5 !important;
    cursor: pointer;
 }
  #usr_lst_tbl .pl_m {
    width: 33.2667px!important;
    text-align: center;
    border-right: 1px solid #f0f1f5 !important;
    cursor: pointer;
  }
  #usr_lst_tbl .pl_m span, #usr_lst_tbl_wrapper .pl_m span {font-size:17px;bottom: -3px;position: relative;}
  table .trans_detail {width:100%;}
  .material-icons {font-size:17px;cursor: pointer;}
  #usr_lst_tbl td.trans_detail_tr{padding: 15px !important;background: #ccc;}
  #usr_lst_tbl .trans_detail tr:hover {background:#fff !important;}
  #usr_lst_tbl_wrapper .mCSB_container {background:#fff!important;border-bottom:5px solid #F0F1F5;}

</style>
<div class="right_blk">
          <div class="top_ttl_blk"> 
            <!-- <span class="back_btn"> <a href="<?php echo base_url(); ?>admin/users" title=""><img src="<?php echo base_url(); ?>assets/images/back.png" alt="" title=""> </a></span>  -->
            <span> <b><?php echo $user["user_name"];?> </b> Transactions - #<?php echo $user["user_code"];?> </span>         
            <!-- <a href="<?php echo base_url(); ?>api/users/previewUserTransactions/" target="_blank" title="" class="btn ed_usr btn-primary fr"> Print </a> -->
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
                               <h1> <?php echo '₹'.number_format($totalLoan,2);?> </h1>
                                    </div>
        </li>
        <li class="bor_lf_none"> 
            <div class="top_in_op crop_top">
                               <p>Orders </p> 
                               <h1> <?php echo '₹'.number_format($totalOrders,2);?> </h1>
                                    </div>
        </li>
        <li class="bor_lf_none"> 
            <div class="top_in_op crop_top">
                               <p>Harvest </p> 
                               <h1> ₹<?php echo number_format($totalHarvest,2);?> </h1>
                                    </div>
        </li>
        <li class="bor_lf_none"> 
            <div class="top_in_op crop_top">
                               <p>Acres </p> 
                               <h1> <?php echo number_format($totalAcres,2);?> </h1>
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
			<div id="snackbar" class=""></div>
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
                  <input type="hidden" name="rowcount" id="rowcount">
                  <tbody id="loandata">

                  </tbody>
                  <!--  <tfoot>
                    <tr> 
                      <th>  Total  </th>
                      <th colspan="4" class="txt_rt"> 1,30,000</th>
                      <th> </th>
                      <th class="txt_rt">  24,000  </th>
                      <th class="txt_rt txt_red">  1,34,000 <i> <img src="http://3.7.44.132/aquacredit/assets/images/rd_c_ar.png" alt="" title=""> </i> </th>
                    </tr>
                    </tfoot> -->
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
                  <h1 class="anl_lrg_txt" id="grandfinalamount"> ₹0 </h1>
                  <div id="summaryrecord">
                      
                  </div>
                  <ul class="ttl_blk_ul"> 
                    <li class="prd_typ"> 
                      <span class="anl_sml_txt prd_typ">Total Amount</span> 
                      <span class="li_amnt_an">   <b id="grandtotal_amount">₹0</b><input type="hidden" id="grandtotal_amountval" name="grandtotal_amountval" >    </span>
                    </li>
                    <li class="pad_l_none"> 
                      <span class="anl_sml_txt">Total Discount</span> 
                      <span class="li_amnt_an blue_txt">   <b id="granddiscount_amount">₹0</b><input type="hidden" id="granddiscount_amountval" name="granddiscount_amountval" >   </span>
                    </li>
                  </ul>
                </div>
            </div>
          </div>
            <div class="lft_tbl_sale">   
              <form id="salefrm" name="salefrm" action="javascript:void(0);" method="post" >           
                <table border="0" cellpadding="0" cellspacing="0" id="saledataload">
                    
                </table>    
              </form>
            </div>  
        </div>

        <div class="billing_tb" style="display: none;"> 
          <div class="top_bill_tb">
              <div class="bil_tp_lft top_in_op"> 
                <h1><?php echo $user["user_name"];?> - #<?php echo $user["user_code"];?> </h1>
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
	                    <div class="rto_txt"> FCR: <span class="blue_txt">0:0</span> </div>
	                  	<div class="sts_rto">  Good </div>
	                </div>
                    <div class="rto_tons"> 
                    Feed Usage
                       <div class="rto_val" id="feedusage"> 0 tons </div>
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
                        <!-- <tr> 
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
                        </tr> -->
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
              <div class="row"> 
                <div class="col-md-4" id="loanhide"> 
                    <div class="analtic_blk"> 
                <p class="anl_sml_txt"> Loan Amount </p>
                <h1 class="anl_lrg_txt" id="floanamount"> ₹0 </h1>
                <ul> 
                  <li> 
                    <span class="anl_sml_txt">Total Amount</span> 
                    <span class="li_amnt_an" id="tloanamount"> ₹0 </span>
                  </li>
                  <li> 
                    <span class="anl_sml_txt">Total Interest</span> 
                    <span class="li_amnt_an" id="tinterestamount"> ₹0 </span>
                  </li>
                </ul>
              </div>
                </div>
               
                <div class="col-md-4" id="harvesthide" > 
                    <div class="analtic_blk"> 
                      <p class="anl_sml_txt"> Harvest </p>
                      <h1 class="anl_lrg_txt" id="harvestamount" > ₹0 </h1>
                      <ul> 
                        <li> 
                          <span class="anl_sml_txt">Type</span> 
                          <span class="li_amnt_an"> Vannamei </span>
                        </li>
                        <li> 
                          <span class="anl_sml_txt">Total Tons</span> 
                          <span class="li_amnt_an" id="harvestweight"> 0</span>
                        </li>
                      </ul>
                    </div>
                </div>

                <p id="summarysalerecord">
                  
                </p>

                

               
              </div>
          </div>
           <div class="col-md-3"> 
                <div class="ext_pop_chrs">
                  <ul> 
                    <li id="ftransporthide" ><span class="fl"> Transport </span> <span class="fr" id="ftransport"> ₹0 </span> </li>
                     <li id="flabhide"><span class="fl"> Lab Fee </span> <span class="fr" id="flabfee"> ₹0 </span> </li>
                      <li ><span class="fl"> Receipts </span> <span class="fr" id="freceipts"> ₹0 </span> </li>
                       <li><span class="fl"> Return </span> <span class="fr" id="fretrun"> ₹0 </span> </li>
                  </ul>                  
                </div>              
           </div>
         </div>
         
         <div class="list_all_vew"> 
          <table border="0" cellpadding="0" cellspacing="0" id="usr_lst_tbl1">
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
         <div id="table_footer"  style="width:100%;padding: 10px 0;">
                        <table style="width:100%">
                          <tr>
                            <td class="opic_non date"> &nbsp;   </td>
                            <td class="txt_rt"> Total </td>
                            <td class="txt_rt in_td tr_amount">  </td>

                          </tr>
                          <tr>
                            <td class="opic_non date"> &nbsp;  </td>
                            <td class="txt_rt type"> Opening Balance</td>
                            <td class="txt_rt tr_amount" id="open_bal"> +0 </td>
                          </tr>
                          <!-- <tr>
                            <td class="opic_non date"> &nbsp;  </td>
                            <td class="txt_rt type"> <b>Previous Balance <span class="grn_clr"></span></b> </td>
                            <td class="grn_clr txt_rt"> <b>+100</b> </td>
                          </tr>-->
                          <tr>
                            <td class="opic_non date"> &nbsp;  </td>
                            <td class="txt_rt grd_ttl"> <b>Grand Total <span class="grn_clr"></span></b> </td>
                            <td class="grd_ttl txt_rt grand_total tr_amount" id="grand_total"> <b>+0</b> </td>
                          </tr>
                        </table>
                    </div>
                    <a href="javascript:void(0);" id="print_transaction"  title="" class="btn ed_usr btn-primary fr"> Print </a>
        </div>
    </div> 

     <div class="footer_pp"> <button class="btn btn-primary"  id="confirmOrder" > Next </button>
                             <button class="btn btn-primary"  id="saleOrder" > Next </button>
                             <button class="btn btn-primary"  id="finalOrder" > Submit </button><input type="hidden" name="grand_totalval" id="grand_totalval"> </div>
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
    <input type="hidden" value="" id="crop_id">
         </ul>
             </div>        
                  <div class="urs_dt"> 
                  <div class=""> 
                        <div class="res_tbl">
                     <table id="usr_lst_tbl" class="table table-striped table-bordered" style="width:100%">
            <thead>
                      
            </thead>
          <tbody>        
      
          </tbody>
           
                      </table>
                    </div>
                    <div id="table_footer"  style="width:100%;padding: 10px 0;">
                        <table style="width:100%">
                          <tr>
                            <td class="opic_non date"> &nbsp;   </td>
                            <td class="txt_rt"> Total </td>
                            <td class="txt_rt in_td tr_amount">  </td>

                          </tr>
                          <tr>
                            <td class="opic_non date"> &nbsp;  </td>
                            <td class="txt_rt type"> Opening Balance</td>
                            <td class="txt_rt tr_amount" id="open_bal"> +0 </td>
                          </tr>
                          <!-- <tr>
                            <td class="opic_non date"> &nbsp;  </td>
                            <td class="txt_rt type"> <b>Previous Balance <span class="grn_clr"></span></b> </td>
                            <td class="grn_clr txt_rt"> <b>+100</b> </td>
                          </tr>-->
                          <tr>
                            <td class="opic_non date"> &nbsp;  </td>
                            <td class="txt_rt grd_ttl"> <b>Grand Total <span class="grn_clr"></span></b> </td>
                            <td class="grd_ttl txt_rt grand_total tr_amount" id="grand_total"> <b>+0</b> </td>
                          </tr>
                        </table>
                    </div>
                  </div>
               </div>
<!-- <div class="btm_btn"> <button class="btn btn-primary"> Settle Amount </button> </div> -->
  </div>
</div>
<script type="text/javascript">

function onlyNumberKey(el) { 
          
        // Only ASCII charactar in that range allowed 
        /*var ASCIICode = (evt.which) ? evt.which : evt.keyCode 
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) 
            return false; 
        return true; */
        
}
function isNumberKey(el, evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode;
    var number = el.value.split('.');
    if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    //just one dot
    if(number.length>1 && charCode == 46){
         return false;
    }
    //get the carat position

    var caratPos = getSelectionStart(el);
    var dotPos = el.value.indexOf(".");
    if( caratPos > dotPos && dotPos>-1 && (number[1].length > 1)){
        return false;
    }
    return true;
}
function validateFloatKeyPress(el, evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode;
    var number = el.value.split('.');
    if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    //just one dot
    if(number.length>1 && charCode == 46){
         return false;
    }
    //get the carat position
    var caratPos = getSelectionStart(el);
    var dotPos = el.value.indexOf(".");
    if( caratPos > dotPos && dotPos>-1 && (number[1].length > 1)){
        return false;
    }
    return true;
}

//thanks: http://javascript.nwbox.com/cursor_position/
function getSelectionStart(o) {
  if (o.createTextRange) {
    var r = document.selection.createRange().duplicate()
    r.moveEnd('character', o.value.length)
    if (r.text == '') return o.value.length
    return o.value.lastIndexOf(r.text)
  } else return o.selectionStart
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

function getlloandata()
{
  $('#summaryrecord').html('');
 
 //$(".fst_step").trigger("click");
 
  var user_id = "<?php echo $user["user_id"];?>";
  var crpid = $("#crop_id").val();
  $('#acropid').val(crpid);

  /*get loans data start*/
    $('#loandata').html('');
    $.ajax({
      url: url+"api/users/getloandata",
      data: {userid:user_id,crop_id:crpid},
      type:'POST',    
      datatype:'json',
      success : function(response1){
      res1 = JSON.parse(response1);
      htmlRows = "";
      $('#rowcount').val(res1.length);

      if(res1.length>0)
      {
      	$(".fst_step").trigger("click");

      	var lss = $('#loanstepshow').val();
      	var sss = $('#salestepshow').val();
      	
      	if(lss==1)
      	{
      		//$('.sec_step').hide();
      		$('.sale_tb').hide();
      	}
      	else
      	{
      		$('.loans_tb').show();
      	}  

        $('#loanstepshow').val(1);
        $('.fst_step').show();
        $('.loans_tb').show();

        $('#saleOrder').hide();
        $('#confirmOrder').show();
        $('#finalOrder').hide();
          
        $.each(res1, function(index, trades) {
                       //alert(JSON.stringify(trades));
          var tcamtt = trades.amount;
          var interestval = trades.interestval;
          if(trades.interest_amount!='' && trades.interest_amount!=null)
          {
            var interest_amount = currency_format(trades.interest_amount,2);
          }
          else
          {
            var interest_amount = 0;
          }
          
          if(trades.total_amount!='' && trades.total_amount!=null)
          {
            var total_amount = currency_format(trades.total_amount,2);
          }
          else
          {
             var total_amount = 0;
          }
          
          /*var tfamtt = trades.total_price;*/
          $('#billdate').html(trades.billdate);


          htmlRows = '<tr><td><input type="text" class="txt_cnt mykey datepicker" onkeydown="return false;" value="'+trades.startdate+'" name="startdate[]" id="startdate'+index+'" style="width:96px;" >  </td><td><input type="text" class="txt_cnt mykey datepicker" value="'+trades.enddate+'" name="enddate[]" id="enddate'+index+'"  onkeypress="return validateFloatKeyPress(this,event);" style="width:96px;"></td><td><span id="daydis'+index+'"> '+trades.days+'</span> </td><td> '+trades.croploan+'</td><td class="txt_rt"> '+tcamtt+'</td><td> <input type="text" class="txt_cnt rt_int mykey" value="'+interestval+'" name="iinterest[]" id="iinterest'+index+'" onkeypress="return validateFloatKeyPress(this,event);"> <input type="hidden" value="'+trades.amount+'" name="tot[]" id="tot'+index+'" ><input type="hidden" value="'+trades.days+'" name="days[]" id="days'+index+'" ><input type="hidden" value="'+trades.months+'" name="months[]" id="months'+index+'" ><input type="hidden" value="'+trades.id+'" name="trans_id[]" id="trans_id'+index+'" ><input type="hidden"  name="interestamtval[]" id="interestamtval'+index+'" value="'+trades.interest_amount+'" /><input type="hidden" name="totamtval[]" id="totamtval'+index+'" value="'+trades.total_amount+'" /></td><td class="txt_rt" id="interestamt'+index+'"> '+interest_amount+'</td><td class="txt_rt txt_red" id="totamt'+index+'">'+total_amount+'</td></tr>';

              $('#loandata').append(htmlRows);
				//var dialogZ = $(event.target).parents('.ui-dialog,.ui-datepicker').css('zIndex') 
              /*calculate*/

              /*limit validation*/
              //alert(trades.startdate);
                  str = trades.startdate.split("-").join(" ");
                  var dt = new Date(str);
                  dt.setDate(dt.getDate() + 1);
                  //alert(dt);
                  
              /*limit validation*/
              $("#startdate"+index).datepicker({
                dateFormat: 'dd-M-yy',
                setDate: "28-Apr-2020",
                        //defaultDate: "+1w",
                beforeShow: function(input, inst) {
                  $(document).off('focusin.bs.modal');
                },
                onClose:function(){
                  $(document).on('focusin.bs.modal');
                },
                changeMonth: true,
                changeYear: true,
                //minDate: '28-Apr-2020',
                numberOfMonths: 1,
				      //showButtonPanel: true,
                onSelect: function (selected) {
                	//alert(selected);
					     calculateTotal();
                  str = selected.split("-").join(" ");
                  var dt = new Date(str);
                  dt.setDate(dt.getDate() + 1);
                 $("#enddate"+index).datepicker("option", "minDate", dt);
                  //$(this).parent().parent('.sts_fil_blk').addClass('show');
                  //$(this).parent().parent().parent().children('.sts_pp').addClass('ad_tgl');
                }
              });


              $("#enddate"+index).datepicker({
                dateFormat: 'dd-M-yy',
                //defaultDate: "+1w",
                beforeShow: function(input, inst) {
                  $(document).off('focusin.bs.modal');
                },
                onClose:function(){
                  $(document).on('focusin.bs.modal');
                },
                        changeMonth: true,
                changeYear: true,
                 //minDate: dateToday,
                  numberOfMonths: 1,
                  onSelect: function (selected) {
					 
                  calculateTotal();
                    str = selected.split("-").join(" ");
                    var dt = new Date(str);
                    dt.setDate(dt.getDate() - 1);
                    //$("#startdate"+index).datepicker("option", "maxDate", dt);
                    //$(this).parent().parent('.sts_fil_blk').addClass('show');
                    //$(this).parent().parent().parent().children('.sts_pp').addClass('ad_tgl');
                  }
              });
              $("#enddate"+index).datepicker("option", "minDate", dt);
              /*calculate*/
              calculateTotal();
          });
      }
      else
      {
        $('.loans_tb').hide();
        $('.fst_step').hide();
        $('#loanhide').hide();

        //$('#poptextshow1').html('1');
      	$('#poptextshow2').html('1');
      	$('#poptextshow3').html('2');
        
      }
      }
    });
  /*get loans data end*/
  /*get sales data start*/
  $('#saledataload').html('');
  $('#summarysalerecord').html('');
  $('#summaryrecord').html('');
  var user_id = "<?php echo $user["user_id"];?>";
 
    $.ajax({
      url: url+"api/users/getsalesdata",
      data: {userid:user_id,crop_id:crpid},
      type:'POST',    
      datatype:'json',
      success : function(response1){
      res1 = JSON.parse(response1);
      htmlRows = "";
      sumrecord = "";
      salesumm = "";
      $('#rowcount').val(res1.length);
      if(res1.length>0)
      {
      	    $('#poptextshow2').html('2');

        $('#salestepshow').val(1);

        var lsshow = $('#loanstepshow').val();
        
        if(lsshow==0 )
        {
          $('.sec_step').show();
          $('.sale_tb').show();

            $('#saleOrder').show();
        	$('#confirmOrder').hide();
        	$('#finalOrder').hide();
        }
			var inc = 0;
          $.each(res1, function(index, trades) {
             //alert(trades.billdate);
             //$('#billdate').html(trades.billdate);
          salesumm = '<div class="col-md-4"><div class="analtic_blk"><p class="anl_sml_txt"> '+trades.categoryname+' Amount </p><h1 class="anl_lrg_txt"> ₹'+currency_format(trades.totalamount,2)+' </h1><ul><li><span class="anl_sml_txt">Total Amount</span><span class="li_amnt_an"> ₹'+currency_format(trades.totalamount,2)+' </span></li><li><span class="anl_sml_txt">Total Discount</span><span class="li_amnt_an"> ₹0</span></li></ul></div></div>';

         /* sumrecord =  '<ul ><li class="prd_typ"><span class="anl_sml_txt">'+trades.categoryname+'</span><span class="li_amnt_an">  ₹'+addCommas(trades.totalamount)+'</span></li><li class="discount_li"><span class="anl_sml_txt">Discount</span><span class="li_amnt_an" id="catdiscount'+trades.category+'" >- ₹0</span></li><li class="eql_tbl"> = </li><li><span class="anl_sml_txt">Total</span><span class="li_amnt_an blue_txt"> <b id="cattotamt'+trades.category+'">₹'+addCommas(trades.totalamount)+'</b> </span></li></ul>';*/

          htmlRows = '<thead data-toggle="collapse" data-target="#feed_tbl" aria-expanded="false" aria-controls="feed_tbl"><tr><th><span class="tggl_act"><img src="http://3.7.44.132/aquacredit/assets/images/plu.svg" class="plu"><img src="http://3.7.44.132/aquacredit/assets/images/mini.svg" class="mini"></span>'+trades.categoryname+' ('+trades.bcount+') </th><th class="pp_amnt txt_rt"></th><th class="pp_dis"></th><th class="pp_ttl txt_rt"> </th></tr></thead>';
            

            var dda = trades.branchname;
            var arr = dda.split(',');
           
            var ddb = trades.branchid;
            var arrb = ddb.split(',');

            var ddbd = trades.bdiscount;
            var arrbd = ddbd.split(',');

            var tott = trades.totamount;
            var ttt = tott.split(',');

            var ssids = trades.sids;
            var sids = ssids.split(',');

           var ppmrp1 =  trades.productmrp;
           var ppmrp1a = ppmrp1.split(',');

            if(arr.length>0)
            {
              htmlRows += '<tbody><tr><td colspan="4"><div id="feed_tbl" class="collapse show tgl_div"><table border="0" cellpadding="0" cellspacing="0"><tr><td colspan="4"><div id="feed_tbl" class="collapse show tgl_div"><table border="0" cellpadding="0" cellspacing="0"><tr><td class="brnd_ane"> <b> Brand Name</b></td><td class="pp_amnt txt_rt"> <b> MRPs Total</b></td><td class="pp_dis"> <b> Discount </b> </td><td class="pp_ttl txt_rt"> <b> Total </b></td></tr>';

              //alert(arr.length);
              for (var ii=0;ii<=arr.length;ii++)
              {
                /*onkeypress="return onlyNumberKey(event)"*/
                if(arr[ii]!='' && arr[ii]!=undefined)
                {
                	var tttm = currency_format(ttt[ii],2);
                    //alert(tttm);

                    htmlRows += '<tr><td class="brnd_ane" data-toggle="collapse" data-target="#prds_tbl'+inc+'" aria-expanded="false" aria-controls="prds_tbl'+inc+'"><a href="javascript:void(0);" onclick="return getdivpro('+user_id+','+crpid+','+trades.category+','+arrb[ii]+','+inc+');">'+arr[ii]+'</a></td><td class="pp_amnt txt_rt">'+currency_format(ttt[ii],2)+'</td><td class="pp_dis"><input type="text"  value="'+arrbd[ii]+'" autocomplete="off" id="branddiscountval'+index+arrb[ii]+trades.category+'" name="branddiscount[]" onkeypress="return validateFloatKeyPress(this,event);"><input type="hidden" name="brandidval[]" id="brandidval'+index+arrb[ii]+trades.category+'" value="'+arrb[ii]+'"><input type="hidden" name="categoryidval[]" id="categoryidval'+index+arrb[ii]+trades.category+'" value="'+trades.category+'"><input type="hidden" name="sids[]" id="sids'+index+arrb[ii]+trades.category+'" value="'+sids[ii]+'"><input type="hidden" name="auserid" id="auserid" value="'+user_id+'" ><input type="hidden" name="acropid" id="acropid" value="'+crpid+'"><input type="hidden" id="prodtotamount'+index+arrb[ii]+trades.category+'" name="prodtotamount[]" value="'+ppmrp1a[ii]+'"><input type="hidden" id="brandtotamtval'+index+arrb[ii]+trades.category+'" name="brandtotamtval[]" value="'+ttt[ii]+'"><input type="hidden" id="brandtotamtvalact'+index+arrb[ii]+trades.category+'" name="brandtotamtvalact[]" value="'+ttt[ii]+'"></td><td class="pp_ttl txt_rt" id="brandtotamt'+index+arrb[ii]+trades.category+'" >'+tttm+'</td></tr><tr><td colspan="4" class="prd_b_tb"><div id="prds_tbl'+inc+'" class="collapse tgl_div"><table><tr><th class="brnd_ane"> Product Name </th><th class="pp_amnt txt_rt"> MRP </th><th class="pp_dis"> Discount </th><th class="pp_ttl txt_rt"> Total </th></tr><tbody id="productssata'+inc+arrb[ii]+''+trades.category+'"></tbody>';

                    //getdivpro('+user_id+','+crpid+','+trades.category+','+arrb[ii]+','+index+');

                     htmlRows += '</table></div></td></tr>';
					 inc++;
                }
              }

              htmlRows += '</table></div></td></tr></tbody>';
            }
            
            $('#saledataload').append(htmlRows);
            //$('#summaryrecord').append(sumrecord);
            $('#summarysalerecord').append(salesumm);
             
          });
      }
      else
      {
        $('.sec_step').hide();
        $('.sale_tb').hide();
        $('#poptextshow1').html('1');
        $('#poptextshow3').html('2');
        $('#saleOrder').hide();
      }
      // calculateTotalsale();
        calculateTotalproduct();
      }
    });
    /*get sales data end*/
    /*get final data*/
        $.ajax({
            url: url+"api/users/getfinaldata",
            data: {userid:user_id,crop_id:crpid},
            type:'POST',    
            datatype:'json',
            success : function(response112){
            res121 = JSON.parse(response112);
                               
                    $.each(res121, function(index, finalval) {
                      
                      if(finalval.harvest!=null)
                      {
                        var hamt = parseFloat(finalval.harvest);
                      }
                      else
                      {
                        var hamt = 0;
                      }
                      
                      var hwgt = parseFloat(finalval.tradetons);
                      //alert(hwgt);
                      //alert(finalval.feedusage);
                      if(hwgt!=0 && finalval.feedusage!=null)
                      {
                      	$('#feedharvestsymbol').show();
                      }
                      else
                      {
                      	
                      	$('#feedharvestsymbol').hide();
                      }
                      $('#harvesttons').html(hwgt.toFixed(2));
                      $('#harvesttonsval').val(hwgt.toFixed(2));
                      
                      if(hamt!='' && hamt!=0)
                      {
                         $('#harvestamount').html(hamt.toFixed(2));
                      }
                      else
                      {
                         $('#harvestamount').html(hamt);
                      }
                      if(hamt==0 )
                      {
                      	$('#harvesthide').hide();
                      }
                      
                        $('#harvestweight').html(hwgt.toFixed(2));
                        $('#feedusage').html(finalval.feedusage);
                        
                        if( finalval.transport==null)
                        {
                        	$('#ftransporthide').hide();
                        }
                        else
                        {
                        	$('#ftransport').html(finalval.transport);
                        	$('#ftransporthide').show();
                        }

                        if( finalval.lab==null)
                        {
                        	$('#flabhide').hide();
                        }
                        else
                        {
                        	
                        	$('#flabfee').html(finalval.lab);
                        	$('#flabhide').show();
                        }
                        
                        $('#flabfee').html(finalval.lab);
                        $('#freceipts').html(finalval.receipt);
                        $('#fretrun').html(finalval.returnamount);

                    });
            }
        });
    /*get final data*/
    /*getfeed products*/
    var html = '';
    $('#feeddata').html('');
      $.ajax({
            url: url+"api/users/getfeedproducts",
            data: {userid:user_id,crop_id:crpid},
            type:'POST',    
            datatype:'json',
            success : function(response111){
            res111 = JSON.parse(response111);
            
                if(res111!=null)
                {
                    var bags = '';     
                    var fwght = '';     
                    $.each(res111, function(index, fval) {
                      bags += fval.quantity;
                      fwght += fval.feedweight;

                      html += '<tr><td> '+fval.product_name+' - '+fval.qty+' '+fval.units+' </td><td class="no_bgs"> '+fval.quantity+' </td></tr>';
                    });
                    var tfwt = fwght/1000;
                    var hval = $('#harvesttonsval').val();


                    $('#feedusage').html(tfwt);
                    $('#tfeedbad').html(bags);
                    $('#feeddata').append(html);
                }   
                else
                {
                	$('#feedtable').hide();
                } 
                   // alert(hval);
            }
      });

    /*getfeed products*/
   // getcattotal();
  /* var lsh = $('#loanstepshow').val();
   var ssh = $('#salestepshow').val();
  alert(lsh);
  alert(ssh);*/
}

function getcattotal()
{
  var user_id = "<?php echo $user["user_id"];?>";
  var crpid = $("#crop_id").val();
  $('#summaryrecord').html('');
    $.ajax({
      url: url+"api/users/getsalesdata",
      data: {userid:user_id,crop_id:crpid},
      type:'POST',    
      datatype:'json',
      success : function(response1){
      res1 = JSON.parse(response1);
      htmlRows = "";
      sumrecord = "";
      salesumms = "";
      $('#rowcount').val(res1.length);
      
      if(res1.length>0)
      {
          $.each(res1, function(index, trades) {

            var dda = trades.branchname;
            var arr = dda.split(',');
           
            var ddb = trades.branchid;
            var arrb = ddb.split(',');

            var tott = trades.totamount;
            var ttt = tott.split(',');

            if(arr.length>0)
            {
              var grandTotalv = 0;
              var ddisc =0;

              for (var ii=0;ii<=arr.length;ii++)
              {
                if(arr[ii]!='' && arr[ii]!=undefined)
                {
                    var prodisc = $('#branddiscountval' +index+arrb[ii]+trades.category).val();
                    var total = $('#brandtotamtvalact' +index+arrb[ii]+trades.category).val();
                    
                    var vaal = $('#pro_discount' + index+arrb[ii]+trades.category).val();
					
					var ds = prodisc/100;
                    var dsc = ds*total;
                    var tot1 = total-dsc;
					
					if(vaal==undefined)
        			{
                    	grandTotalv += parseFloat(tot1);
                    	ddisc += parseFloat(dsc);
                    }
                    else
                    {
                    	var total = $('#brandtotamtvalact' +index+arrb[ii]+trades.category).val();;
                    	grandTotalv += parseFloat(total);
                    	//ddisc += dsc;
                    }
                }
              }

            }

            sumrecord =  '<ul ><li class="prd_typ"><span class="anl_sml_txt">'+trades.categoryname+'</span><span class="li_amnt_an">  ₹'+currency_format(trades.totalamount,2)+'</span></li><li class="discount_li"><span class="anl_sml_txt">Discount</span><span class="li_amnt_an" id="catdiscount'+trades.category+'" >- ₹'+ddisc+'</span></li><li class="eql_tbl"> = </li><li><span class="anl_sml_txt">Total</span><span class="li_amnt_an blue_txt"> <b id="cattotamt'+trades.category+'">₹'+currency_format(grandTotalv,2)+'</b> </span></li></ul>';

            salesumms = '<div class="col-md-4"><div class="analtic_blk"><p class="anl_sml_txt"> '+trades.categoryname+' Amount </p><h1 class="anl_lrg_txt"> ₹'+currency_format(trades.totalamount,2)+' </h1><ul><li><span class="anl_sml_txt">Total Amount</span><span class="li_amnt_an"> ₹'+currency_format(grandTotalv,2)+' </span></li><li><span class="anl_sml_txt">Total Discount</span><span class="li_amnt_an"> ₹'+ddisc+'</span></li></ul></div></div>';
            
            $('#summaryrecord').append(sumrecord);
            $('#summarysalerecord').append(salesumms);
          });
      }
      }
    });
}

function getdivpro(user_id,crpid,category,brandid,ind)
{
	htmlr = '';
	$('#productssata'+ind+brandid+category).html('');
      $.ajax({
        url: url+"api/users/getproductsdata",
        data: {userid:user_id,crop_id:crpid,category:category,branchid:brandid},
        type:'POST',    
        datatype:'json',
        success : function(response12){
        res12 = JSON.parse(response12);                         
            if(res12.length>0)
            {
              var inc =0;
                $.each(res12, function(index, prod) {
                	/**/
                	var pdiss = $("#branddiscountval"+ind+brandid+category).val();
                	
                	if(prod.prodiscount==null)
                	{
                		var pdisc = 0;
                	}
                	else
                	{
                		var pdisc = prod.prodiscount;
                	}
                  htmlr += '<tr><td class="brnd_ane"> <a href="javascript:void(0)"> '+prod.product_name+'</a></td><td class="pp_amnt txt_rt"> '+currency_format(prod.totprice,2)+' </td><td class="pp_dis"> <input type="text" name="pro_discount[]" id="pro_discount'+ind+brandid+category+'_'+inc+'" onkeypress="return validateFloatKeyPress(this,event);" value="'+pdisc+'"><input type="hidden" name="categoryid[]" id="categoryid'+ind+brandid+category+'" value="'+category+'"><input type="hidden" name="purchaseamountval[]" id="purchaseamountval'+ind+brandid+category+'_'+inc+'" value="'+prod.purchaseamountval+'"><input type="hidden" name="brandid[]" id="brandid'+ind+brandid+category+'" value="'+brandid+'"><input type="hidden" name="pbranddiscountval[]" id="pbranddiscountval'+ind+brandid+category+'_'+inc+'" value="'+pdiss+'"><input type="hidden" name="prosids[]" id="prosids'+ind+brandid+category+'_'+inc+'" value="'+prod.sids+'" ><input type="hidden" name="prodid[]" id="prodid'+ind+brandid+category+'_'+inc+'" value="'+prod.product_id+'"><input type="hidden" id="pro_t'+ind+brandid+category+'_'+inc+'" value="0" /><input type="hidden" value="'+prod.proamount+'" name="pro_totamount[]" id="pro_totamount'+ind+brandid+category+'_'+inc+'" ><input type="hidden" value="'+prod.totprice+'" name="pro_totvalact[]" id="pro_totvalact'+ind+brandid+category+'_'+inc+'" ></td><td class="pp_ttl txt_rt" id="pro_total'+ind+brandid+category+'_'+inc+'"> '+currency_format(prod.totprice,2)+' </td></tr>';

                  inc++;
                                         
                });
            }
            //alert(ind+brandid+category);
            $('#productssata'+ind+brandid+category).append(htmlr);
            calculateTotalproduct();
        }
      });
  /*b h*/
}
function form_validation(err,err_msg,tagid)
{
  $('.mykey').parent().css("border", "");
  
  $("#snackbar").text(err_msg);
  $("#snackbar").addClass("show");
  
  setTimeout(function(){ $("#snackbar").removeClass("show"); }, 3000);
  $(tagid).parent().css("border", "1px solid red");
 
  $(tagid).focus();
  return false;
}
/*form submit*/`1q`
$("#confirmOrder").on("click",function(){

      var rcount = $('#rowcount').val();

      var i;
      for (i = 0; i <= rcount; i++) {

        var interests = $('#iinterest'+i).val();

        if(interests == 0 || interests == ''){ err = 1; err_msg = "Please select sale type!"; tagid = "#iinterest"+i;
          return form_validation(err,err_msg,tagid);}
      }

      formData = new FormData(loanfrm);
      $.ajax({
              url: url+"api/users/loandataupdate",
              data: formData,
              type:'POST',
              contentType: false,
              processData: false,
              enctype: 'multipart/form-data',
              datatype:'json',
              success : function(response)
              {           
                  res= JSON.parse(response);
                  var lstp = $('#salestepshow').val();
                  if(lstp==1)
                  {
                    $(".sec_step").trigger("click");
                  }
                  else
                  {
                    $(".thrd_step").trigger("click");
                  }
              }
      });
});
$("#saleOrder").on("click",function(){

     formData = new FormData(salefrm);
      $.ajax({
              url: url+"api/users/saledataupdate",
              data: formData,
              type:'POST',
              contentType: false,
              processData: false,
              enctype: 'multipart/form-data',
              datatype:'json',
              success : function(response)
              {           
                res= JSON.parse(response);
                 $(".thrd_step").trigger("click");
              }
      });
});
$("#finalOrder").on("click",function(){
  var gval = $('#grand_totalval').val();
  var interestval = $('#totalinterestval').val();
  var user_id = "<?php echo $user["user_id"];?>";
  var crpid = $("#crop_id").val();
  var gdiscount = $('#granddiscount_amountval').val();
  var loanstep = $('#loanstepshow').val();
  var salestep = $('#salestepshow').val(); 

    $.ajax({
      url: url+"api/users/updatefinaldata",
      data: {userid:user_id,crop_id:crpid,gval:gval,interestval:interestval,gdiscount:gdiscount,loanstep:loanstep,salestep:salestep},
      type:'POST',    
      datatype:'json',
      success : function(response1){
      res1 = JSON.parse(response1);
          location.reload();
      }
    });


});
$(document).on('blur', "[id^=iinterest]", function() {
    calculateTotal();
});
$(document).on('change', "[id^=startdate]", function() {
    calculateTotal();
});
$(document).on('change', "[id^=enddate]", function() {
  
    calculateTotal();
});
$(document).on('blur', "[id^=pro_discount]", function() {
   
    calculateTotalproduct();
    
});
$(document).on('blur', "[id^=branddiscountval]", function() {
    calculateTotalsale();
});

function calculateTotalproduct()
{
 
  var grandTotals = 0;
  var idds =0;
    $("[id^='pro_discount']").each(function() {
        var id = $(this).attr('id');
        id = id.replace("pro_discount", '');
        
        	/*validation*/
        	var bid = $('#brandid' + id).val();
        	var pid = $('#prodid' + id).val();
        	/*validation*/
          var resid = id.split('_');
          var vv = resid[0];

            var promrpval = $('#pro_totvalact' + id).val();
            var prodisc = $('#pro_discount' + id).val();
            var ppr = $('#purchaseamountval' + id).val();
           

            if(prodisc!='' && prodisc!=undefined && prodisc!=null)
            {
                var total = promrpval;
                var ds = prodisc/100;
                var dsc = ds*total;
                var tot1 = total-dsc;

                var proamtval = $('#pro_totamount' + id).val();
                var ptotal = proamtval;
                var pds = prodisc/100;
                var pdsc = ds*ptotal;
                var ptot1 = ptotal-pdsc;

            }
        
         
             
             if(parseFloat(ptot1)<parseFloat(ppr))
		         {
		         	  var pdis_val = $('#pro_discount'+id).val();
			          alert('Discount should be lessthan purchase amount, purchase amount is '+response1);
			          $('#pro_discount' + id).val('');
                $('#pro_total' + id).html(currency_format(promrpval,2));
                $('#pro_totval' + id).val(promrpval);
                return false;
		         }
             else
             {
                var ii = $('#pro_t' + id).val();
                //alert(ii);
                if(ii==0 )
                {
                  
                  //alert(id);
                  //$('#pro_t' + id).val(1);
                  $('#pro_total' + id).html(currency_format(tot1,2));
                  $('#pro_totval' + id).val(tot1);
                 // $('#brandtotamt' + vv).html(currency_format(tot1,2));
                 // $('#brandtotamtval' + vv).val(tot1);
                 // $('#brandtotamtvalact' + vv).val(tot1);
                  $('#brandtotamtval' + vv).prop('disabled',true);
                  grandTotals += parseFloat(tot1);
                }
             }
		      

            
    });
   // alert(grandTotals);
    calculateTotalsale();
}
function calculateTotalsale() {
 
    var grandTotal = 0;
    var ddisc =0;
    var grandTotals = 0;
     $('#summaryrecord').html('');
     $('#summarysalerecord').html('');

     $("[id^='branddiscountval']").each(function() {
        var id = $(this).attr('id');
        id = id.replace("branddiscountval", '');
        var vaal = $('#pro_discount' + id).val();
        
	         var bidd = $('#brandidval' + id).val(); 
           var catid = $('#categoryidval' + id).val();

          /*  $.ajax({
          url: url+"api/users/purchaseamountvalbrand",
          data: {bid:bidd,catid:catid},
          type:'POST',    
          datatype:'json',
          success : function(response1){
             res1 = JSON.parse(response1);*/

             var promrpval = $('#brandtotamtvalact' + id).val();
         

          var prodisc = $('#branddiscountval' + id).val();
          var total = promrpval;
          var ptotm = $('#prodtotamount' + id).val(); 
         

                    var ds1 = prodisc/100;
                    var dsc1 = ds1*ptotm;
                    var tot11 = ptotm-dsc1;

              /*if(parseFloat(tot11)<parseFloat(response1))
               {
                    $('#branddiscountval'+id).val('');
                    alert('Discount should be lessthan purchase amount, purchase amount is '+response1);
                                   
                    $('#brandtotamt' + id).html(currency_format(promrpval,2));
                    $('#brandtotamtval' + id).val(currency_format(promrpval,2));
                    return false;
               }
               else
               {*/
          	        var ds = prodisc/100;
          	        var dsc = ds*total;
          	        var tot1 = total-dsc;
          	        
          	        if(vaal==undefined)
                  	{
                  		$('#brandtotamt' + id).html(currency_format(tot1,2));
          	        	$('#brandtotamtval' + id).val(tot1);
          	        	//$('#pro_discount' + id).val(prodisc);

          	        	grandTotal += parseFloat(tot1);
          	        	ddisc += parseFloat(dsc); 
          	        	grandTotals += parseFloat(promrpval);
                  	}
          	        else
          	        {
          	        	var promrpval = $('#brandtotamtvalact' + id).val();
          	        	
          	        	grandTotal += parseFloat(promrpval);
          	        	grandTotals += parseFloat(promrpval);
          	        }
                    //alert(promrpval);
                    //alert(prodisc);
                    //alert(grandTotals);
                /*}*/
             /*}*/
        /*});  */  
         
	        /**/
	       // $('#pro_discount' + id).val(prodisc);
	        //$('#pro_totval' + id).val(tot1);
	        /**/
	        
	    

    });
   //alert(grandTotal);
    $('#grandtotal_amount').html('₹'+currency_format(grandTotal,3));
    $('#granddiscount_amount').html('₹'+currency_format(ddisc,3));
    $('#grandtotal_amountval').val(grandTotal);
    $('#granddiscount_amountval').val(ddisc);
    $('#grandfinalamount').html('₹'+currency_format(grandTotal,3));
    getcattotal();
} 
function calculateTotal() {
   
    var totalamtvalue = 0;
    var totinterestvalue = 0;
    var totval = 0;

    $("[id^='iinterest']").each(function() {
        var id = $(this).attr('id');
        id = id.replace("iinterest", '');

        /*calculate day difference*/
        var start = $('#startdate'+id).val();
        var end = $('#enddate'+id).val();
        /*var sd = new Date(start);
        var ed = new Date(end);
        var diff = new Date(ed - sd);
        var daysval = diff/1000/60/60/24;*/
         var From_date = new Date(start);
        var To_date = new Date(end);
        var diff_date =  To_date - From_date;

        /*var years = Math.floor(diff_date/31536000000);
        var months = Math.floor((diff_date % 31536000000)/2628000000);
        var days = Math.floor(((diff_date % 31536000000) % 2628000000)/86400000);*/
        
       /* alert(months);
        alert(days);*/

        /*var cf = months*30;
        var daysval = cf+days;*/
        /**/
        $.ajax({
          url: url+'api/Users/getdayscount',
          type: "POST",
          data: { fromdate: start, todate:end },
          dataType: "json",
          async: false,
          success: function(data){
            var daysval = data;
             $('#days' + id).val(daysval);
            $('#daydis' + id).html(daysval);
            /*calculate day difference*/
            
            var t = $("#iinterest" + id).val();
            var p = $('#tot' + id).val();
            var days = daysval;
            var r = $('#months' + id).val();

            if(r==0)
            {
              r=1;
            }

            var intrests = ( ( p * t ) / 3000 ) * days
            $("#intrestResult").val(intrests)
            $("#totalResult").val((+p) + intrests)
           
            $('#interestamt' + id).html('₹'+currency_format(intrests,3));
            $('#interestamtval' + id).val(intrests);

            $('#totamt' + id).html('₹'+currency_format((+p) + intrests),3);
            $('#totamtval' + id).val((+p) + intrests);
            var tf = (+p) + intrests;
            var ttt = (+p);

            totalamtvalue += tf;
            totinterestvalue += intrests;
            totval += ttt;
           
          }
        });
        /**/

    });

   
    $('#finalamount').html('₹'+currency_format(totalamtvalue,2));
    $('#totalamount').html('₹'+currency_format(totval,2));
    $('#totalinterest').html('₹'+currency_format(totinterestvalue,2));

    $('#totalamountval').val(totval);
    $('#totalinterestval').val(totinterestvalue);


    $('#floanamount').html('₹'+currency_format(totalamtvalue,3));
    $('#tloanamount').html('₹'+currency_format(totval,3));
    $('#tinterestamount').html('₹'+currency_format(totinterestvalue,3));
     
}


var url = '<?php echo base_url() ?>';
$(document).ready(function() {

        $('#saleOrder').hide();
        $('#confirmOrder').show();
        $('#finalOrder').hide();

  var user_id = "<?php echo $user["user_id"];?>";
  hidcrop = ""
  //get crops data
  $.ajax({    
    url: url+"api/UserCrops/index/"+user_id,
    data: {},
    type:'POST',    
    datatype:'json',
    success : function(response){     
      res= JSON.parse(response);        
      // var user_id = $('#selectuser_id'+aeval).val();
	  if(res.data.length > 1){$("#crop_trns").show();}else{ $("#crop_trns").hide();}
      var sel = "";
      if(user_id != "")
      {
        var opt = '<div class="form-check"><input class="form-check-input" type="radio" name="crop_opt" id="crp" /><label class="form-check-label" for="crp"></label></div>';;
        if(res.data.length > 0)
        {
          opt = '';
          $.each(res.data, function(index, crop) {
            if($("#crop_id").val() == "")
            { 
              $("#crop_id").val(crop.cd_id); 
              console.log(crop.crop_location);
              $(".cropValue").text(crop.crop_location);
              sel = "checked"; 
            } else{ 
              sel = "";
            }
            //if(crop.cd_id == hidcrop){ sel = "checked"; }else{ sel = "";}
            opt += '<div class="form-check"><input class="form-check-input" type="radio" name="crop_opt" id="crp'+index+'" value="'+crop.cd_id+'" '+sel+' required /><label class="form-check-label" for="crp'+index+'">'+crop.crop_location+'</label></div>';
          });
        }
      }else{
        var opt = '';
      }
      $("#crop_opt_li").html(opt); 
      load_unsettled();
      load_analytics();
      summary_settled();
    }
  });

  $(document).on("change", ".check_list input[name='crop_opt']", function(){
    var id = $( 'input[name=crop_opt]:checked' ).val();
    $("#crop_id").val(id);
    $(".swith_blk").toggleClass('tog_yes');
    $('#usr_lst_tbl').DataTable().destroy();
    load_unsettled();
    load_analytics();
  });

  $(document).on("click", "#print_transaction",function(){
    console.log('print');
    user_id = user_id;
    crop_id = $("#crop_id").val();
    settled = $(".act_tab").attr("id");

    console.log('user_id'+user_id);
    console.log('crop'+crop_id);
    console.log('settled'+ settled);
    window.location.href = "<?php echo base_url('api/users/printTrans');?>/"+user_id+"/"+crop_id+"/0";
  });

  $('.swith_blk').click(function(){
    tables = $('#usr_lst_tbl').DataTable();
    $(".expand_details").each(function() {       
      var tr = $(this).closest('tr');
      var row = tables.row( tr );
      row.child.hide();
      tr.removeClass('shown');
    });
    if($(this).hasClass('tog_yes')){
      $(this).removeClass('tog_yes');   
    }else{
      $(this).addClass('tog_yes');
      $(".expand_details").trigger("click");
    }
  });

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

  $(document).on('click','.comp_cl',function(){
    $(this).addClass('act_tab');
    $('.tabs_tbl').addClass('cmp_ul');
    $('.drft_cl').removeClass('act_tab');
    //$('#usr_lst_tbl').DataTable().ajax.reload();
    $('#usr_lst_tbl').DataTable().destroy();
    load_settled();
  });

  $(document).on('click','.drft_cl',function(){
    $(this).addClass('act_tab');
    $('.tabs_tbl').removeClass('cmp_ul');
    $('.comp_cl').removeClass('act_tab');
    //$('#usr_lst_tbl').DataTable().ajax.reload();
    $('#usr_lst_tbl').DataTable().destroy();
    load_unsettled();
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
        $('#saleOrder').show();
        $('#confirmOrder').hide();
        $('#finalOrder').hide();

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
        $('#saleOrder').hide();
        $('#confirmOrder').show();
        $('#finalOrder').hide();
    });

    $('.thrd_step').click(function(){
      $('.confrm_blk').hide();
      $(this).addClass('act_tb').removeClass('dne_tb');
      $('.fst_step, .fth_step').removeClass('act_tb').addClass('dne_tb');
      $('.sec_step').removeClass('act_tb').addClass('dne_tb');
      $('.bdr_blue').css('width', '150px');
      $('.loans_tb').hide();
      $('.sale_tb').hide();
      $('.billing_tb').show();
      $('#saleOrder').hide();
      $('#confirmOrder').hide();
      $('#finalOrder').show();
    });

	$('.lnk_typ').click(function(){
		
		$(this).parent('.assign_type').find('.lnk_typ').removeClass('act_type');
		$(this).addClass('act_type');
		var this_id = $(this).attr("id");
		$('#skey').val('');
		$('#selectuser_id').val('');
		$('#select_usercode').val('');
		$('#select_usertype').val('');
		//$(".guest_block").hide();
		$("#bank_block").hide(); $("#cash_block").hide();
		$("#user_block").hide(); $("#crop_block").hide();
		$('#src_user').hide(); 
		$('input[name="user_crop"]').prop('checked', false);
		$('.cval').html('Select Crop');
		if(this_id == 'ban_trns')
		{
			$("input[name='act_types']:checked").val('bank');
			$("#bank_block").show(); $("#user_block").show(); 
		}else{
			
			if(this_id == 'crop_trns' || this_id == 'user_trns')
			{
				var chk_val = this_id.split('_');
				if(chk_val[0] == 'user'){ $('#src_user').show(); $("#user_crop_li").html('');}
				else{ getusercrops(user_id);}
				$("input[name='act_types']:checked").val(chk_val[0]);
				$("#crop_block").show();
				
			}else if(this_id == 'cash_trns')
			{
				$("input[name='act_types']:checked").val('cash');
				$("#cash_block").show();
			}
		}
	});
	
	$("#admin_bank_li, #admin_cash_li").on("change", function() {
        bankBalCheck();
        setTimeout(function() {
            if ($("#hid_chkbal").val() == 1) {
                new PNotify({
                    title: 'Error',
                    text: "Insufficient Balance, please select another admin bank!",
                    type: 'failure',
                    shadow: true,
                    delay: 3000,
                    stack: { "dir1": "down", "dir2": "right", "push": "top" }
                });
                return false;
            }

        }, 500);


    });

    $('#drawal_amt_commas').keyup(function() {

        bankBalCheck();
        setTimeout(function() {

            if ($("#hid_chkbal").val() == 1) {
                new PNotify({
                    title: 'Error',
                    text: "Insufficient Balance, please select another admin bank!",
                    type: 'failure',
                    shadow: true,
                    delay: 3000,
                    stack: { "dir1": "down", "dir2": "right", "push": "top" }
                });
                return false;
            }

        }, 500);
    });
});
function load_unsettled()
{
  $("#table_footer").show();
  $("#usr_lst_tbl").empty();
  var h = $(window).height();
  var min_h = h-315;
  var tables = $('#usr_lst_tbl').DataTable({
    'ordering': false,
    'processing': true,
    'serverSide': true,
      'serverMethod': 'post',
    "columns": [
      {title: "Date", className: "date","width": "20%"},
      {title: "Detail",className: ""},
      {title: "Amount",className: "txt_rt out_td","width": "40%"} //grn_clr txt_red out_td
    ],
    
    language: {
      searchPlaceholder: "Search Transaction Details",
      search: "",
      "dom": '<"toolbar">frtip',
    },
    "scrollY":  min_h,
    "scrollCollapse": true,
    'ajax': {
      'url':url+'api/users/unsettled_trans',
      'data': function(data){
          data.user_id = "<?php echo $user["user_id"];?>";
          data.crop_id = $("#crop_id").val();
          data.settled = $(".act_tab").attr("id");
      },
      "dataSrc": function (json) {
      	//alert(json.total_record);
       if(json.total_record>0)
       {
          $('#setacnt').prop('disabled',false);
       }
       else
       {
          $('#setacnt').prop('disabled',true);
       }

        total_trans_amount = json.total_trans_amount;
        grand_total = parseFloat(total_trans_amount) + parseFloat(json.open_balance);
        $(".in_td").html('₹'+currency_format(total_trans_amount,2));
        $("#open_bal").html('₹'+currency_format(json.open_balance,2));
        $(".grand_total").html('₹'+currency_format(grand_total,2));   
        $('#grand_totalval').val(grand_total);
        return json.data;
      }
    }
  });
  
  $('.dataTables_scrollBody').css('height', min_h);
  $('#usr_lst_tbl_wrapper .dataTables_length').html('<ul class="tabs_tbl"><li class="act_tab drft_cl" id="status_0"> <span>Unsettled</span> </li><li class="comp_cl" id="status_1"> <span>Settled </span> </li></ul> <span class="tbl_btn">  </span>');
  $('.dataTables_scrollBody').mCustomScrollbar("destroy");
  $('.dataTables_scrollBody').mCustomScrollbar({
    theme:"minimal",
    mouseWheelPixels: 35,
    scrollInertia:250,
  });  
  $('#usr_lst_tbl tbody').on('click', '.expand_details', function () {
        var tr = $(this).closest('tr');
        var row = tables.row( tr );
 
        if ( row.child.isShown() ) {
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
          $content = format(row.data())
            if($content !='')
            {
              row.child( $content,'user_dtl_tr' ).show();
              tr.addClass('shown');
            }
        }
    } );
}
function summary_settled()
{
  $("#table_footer").show();
  $("#usr_lst_tbl1").empty();
  var h = $(window).height();
  var min_h = h-315;
  var tables = $('#usr_lst_tbl1').DataTable({
    'ordering': false,
    'processing': true,
    'serverSide': true,
      'serverMethod': 'post',
    "columns": [
      {title: "Date", className: "date","width": "20%"},
      {title: "Detail",className: "", "width": "20%"},
      {title: "Amount",className: "txt_rt out_td","width": "60%"} //grn_clr txt_red out_td
    ],
    
    language: {
      searchPlaceholder: "Search Transaction Details",
      search: "",
      "dom": '<"toolbar">frtip',
    },
    "scrollY":  min_h,
    "scrollCollapse": true,
    'ajax': {
      'url':url+'api/users/unsettled_trans',
      'data': function(data){
          data.user_id = "<?php echo $user["user_id"];?>";
          data.crop_id = $("#crop_id").val();
          data.settled = $(".act_tab").attr("id");
      },
      "dataSrc": function (json) {
        total_trans_amount = json.total_trans_amount;
        grand_total = parseFloat(total_trans_amount) + parseFloat(json.open_balance);
        $(".in_td").html('₹'+currency_format(total_trans_amount,2));
        $("#open_bal").html('₹'+currency_format(json.open_balance,2));
        $(".grand_total").html('₹'+currency_format(grand_total,2));
		$("#hid_gtot").val(grand_total);
        //$(".bal_draw").html('₹'+currency_format(grand_total,2));   
        $(".bal_draw").html('₹'+currency_format($("#hid_gtot").val(),2));
        
		var sign = Math.sign($("#hid_gtot").val());
		if(sign == 1)
		{
			$('.gtot_withdrawal').show();
		}
        return json.data;
      }
    }
  });
  
  $('.dataTables_scrollBody').css('height', min_h);
  $('#usr_lst_tbl_wrapper .dataTables_length').html('<ul class="tabs_tbl"><li class="act_tab drft_cl" id="status_0"> <span>Unsettled</span> </li><li class="comp_cl" id="status_1"> <span>Settled </span> </li></ul> <span class="tbl_btn">  </span>');
  $('.dataTables_scrollBody').mCustomScrollbar("destroy");
  $('.dataTables_scrollBody').mCustomScrollbar({
    theme:"minimal",
    mouseWheelPixels: 35,
    scrollInertia:250,
  });  
  $('#usr_lst_tbl1 tbody').on('click', '.expand_details', function () {
        var tr = $(this).closest('tr');
        var row = tables.row( tr );
 
        if ( row.child.isShown() ) {
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
          $content = format(row.data())
            if($content !='')
            {
              row.child( $content,'user_dtl_tr' ).show();
              tr.addClass('shown');
            }
        }
    } );
}
function load_settled()
{
  $("#table_footer").hide();
  $("#usr_lst_tbl").empty();
  var h = $(window).height();
  var min_h = h-230;
  var tables = $('#usr_lst_tbl').DataTable({
    'ordering': false,
    'processing': true,
    'serverSide': true,
      'serverMethod': 'post',
    "columns": [
      {title: "", className: "pl_m","width": "50px"},
      {title: "Settled Date", className: "date","width": "100px"},
      {title: "Settled Id",className: "", "width": ""},
      {title: "Status",className: "txt_rt out_td","width": ""},
      {title: "Download",className: "txt_rt down_blk","width": ""},
    ],
    
    language: {
      searchPlaceholder: "Search Transaction Details",
      search: "",
      "dom": '<"toolbar">frtip',
    },
    "scrollY":  min_h,
    "scrollCollapse": true,
    'ajax': {
      'url':url+'api/users/settled_trans',
      'data': function(data){
          data.user_id = "<?php echo $user["user_id"];?>";
          data.crop_id = $("#crop_id").val();
          data.settled = $(".act_tab").attr("id");;
      },
      "dataSrc": function (json) {
        return json.data;
      }
    }
  });
  $('.dataTables_scrollBody').css('height', min_h);
  $('#usr_lst_tbl_wrapper .dataTables_length').html('<ul class="tabs_tbl cmp_ul"><li class="drft_cl" id="status_0"> <span>Unsettled</span> </li><li class="act_tab comp_cl" id="status_1"> <span>Settled </span> </li></ul> <span class="tbl_btn">  </span>');
  $('.dataTables_scrollBody').mCustomScrollbar("destroy");
  $('.dataTables_scrollBody').mCustomScrollbar({
    theme:"minimal",
    mouseWheelPixels: 35,
    scrollInertia:250,
  });
 $('#usr_lst_tbl tbody').on('click', '.expand_details', function () {
    console.log('expand on click');
        var tr = $(this).closest('tr');
        var row = tables.row( tr );
 
    $.ajax({
      url: url+'api/users/getSettledDetails/'+row.data()[5],
      type: "GET",
      dataType: "json",
      async: false,
      success: function(result){
        if (row.child.isShown()){
          tr.removeClass('details');
          row.child.hide();
          $("#hide_details").hide();
          $("#show_details").show();
        }
        else {
          tr.addClass('details');
          row.child(result,'trans_detail_tr').show();
          $("#hide_details").show();
          $("#show_details").hide();    
        }
        
      },
      error: function(error){
        console.log("Error:");
        console.log(error);
      }
    }); 
       /*  if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            //console.log(row.data());
            row.child( load_records(row.data()) ).show();
            tr.addClass('shown');
        } */
    } );

}

function load_analytics()
{
  $.ajax({
    url: url+'admin/Users/getAnalytics',
    type: "POST",
    data: { user_id: "<?php echo $user["user_id"];?>", crop_id: $("#crop_id").val() },
    dataType: "json",
    async: false,
    success: function(data){
      data.cropLoan = (data.cropLoan) ? data.cropLoan : 0;
      data.cropOrders = (data.cropOrders) ? data.cropOrders : 0;
      data.cropHarvest = (data.cropHarvest) ? data.cropHarvest : 0;
      data.cropAcres = (data.cropAcres) ? data.cropAcres : 0;
      $("#cropLoan").text('₹'+currency_format(data.cropLoan,2));
      $("#cropOrder").text('₹'+currency_format(data.cropOrders,2));
      $("#cropHarvest").text('₹'+currency_format(data.cropHarvest,2));
      $("#cropAcre").text(data.cropAcres);
        //console.log(data.cropLoan);
    },
    error: function(error){
      console.log("Error:");
      console.log(error);
    }
  }); 

}

function format ( d ) {
  var  details = "";
  if(d[3] == "LOAN")
  {
    $.ajax({
      url: url+'api/loans/getLoanTypeByLoan/'+d[5],
      type: "POST",
      dataType: "json",
      async: false,
      success: function(data){
         details = '<tr class="detal_row">'+
            '<td class="date"> &nbsp; </td>'+
            '<td colspan="2">'+
              '<table>'+
                '<tr>'+
                  '<th> Crop Location </th>'+
                  '<th> Loan Type </th>'+
                  '<th> Loan Amount </th>'+
                  '<th>  </th>'+
                  '<th>  </th>'+
                '</tr>'+
                '<tr>'+
                  '<td> '+data.crop_location+'  </td>'+
                  '<td> '+data.loan_type+' </td>'+
                  '<td> '+'₹'+currency_format(data.loan_amt,3)+' </td>'+
                  '<td>  </td>'+
                  '<td>  </td>'+
                '</tr>'+
              '</table>'+
            '</td>'+
            '<td class="hide_blk"> </td>'+
            '<td class="hide_blk"> </td>'+
            '<td class="hide_blk"> </td>'+
          '</tr>';
        return details;
      },
      error: function(error){
        console.log("Error:");
        console.log(error);
      }
    });   
  }
  else if(d[3] == "RECEIPT")
  {
    details = '<tr class="detal_row">'+
            '<td class="date"> &nbsp; </td>'+
            '<td colspan="2">'+
              '<table>'+
                '<tr>'+
                  '<th> Transfer Type </th>'+
                  '<th> Amount </th>'+
                  '<th>  </th>'+
                  '<th>  </th>'+
                '</tr>'+
                '<tr>'+
                  '<td> '+d[4]+' transfer </td>'+
                  '<td> '+'₹'+currency_format(d[6],3)+' </td>'+
                  '<td>  </td>'+
                  '<td>  </td>'+
                '</tr>'+
              '</table>'+
            '</td>'+
            '<td class="hide_blk"> </td>'+
            '<td class="hide_blk"> </td>'+
            '<td class="hide_blk"> </td>'+
          '</tr>';
  }
  else if(d[4] == "GOODS")
  {
    $.ajax({
      url: url+'api/sales/getSaleItemDetails/'+d[5],
      type: "POST",
      dataType: "json",
      async: false,
      success: function(data){
        //var obj = jQuery.parseJSON(data);
         details = '<tr class="detal_row">'+
            '<td class="date"> &nbsp; </td>'+
            '<td colspan="2">'+
              '<table>'+
                '<tr>'+
                  '<th> Product Name </th>'+
                  '<th> Qty </th>'+
                  '<th> MRP </th>'+
                  '<th> Discount </th>'+
                  '<th> Total Price </th>'+
                '</tr>';
          $.each(data.data, function(key,value) {
            details += '<tr>'+
                  '<td> '+value.pname+'  </td>'+
                  '<td> '+value.quantity+' </td>'+
                  '<td> '+'₹'+currency_format(value.mrp,3)+' </td>'+
                  '<td> '+value.discount+' </td>'+
                  '<td> '+'₹'+currency_format(value.total_price,3)+' </td>'+
                '</tr>';
          }); 
        
        
          details += '</table>'+
            '</td>'+
            '<td class="hide_blk"> </td>'+
            '<td class="hide_blk"> </td>'+
            '<td class="hide_blk"> </td>'+
          '</tr>';
        return details;
      },
      error: function(error){
        console.log("Error:");
        console.log(error);
      }
    });
    
  }
  else if(d[4]=="HARVEST")
  {
    $.ajax({
      url: url+'api/Trades/tradeactualdetails/'+d[5],
      type: "GET",
      dataType: "json",
      async: false,
      success: function(data){
        //console.log(data);
        //var obj = jQuery.parseJSON(data);
         details = '<tr class="detal_row">'+
            '<td class="date"> &nbsp; </td>'+
            '<td colspan="2">'+
              '<table>'+
                '<tr>'+
                  '<th> Date </th>'+
                  '<th> Count </th>'+
                  '<th> Price </th>'+
                  '<th> Weight </th>'+
                  '<th> Total Price </th>'+
                '</tr>';
          $.each(data.data, function(key,value) {
            details += '<tr>'+
                  '<td> '+value.trade_date+'  </td>'+
                  '<td> '+value.count+' </td>'+
                  '<td> '+'₹'+currency_format(value.farmer_price,3)+' </td>'+
                  '<td> '+value.farmer_weight+' </td>'+
                  '<td> '+'₹'+currency_format(value.farmer_amount,3)+' </td>'+
                '</tr>';
          }); 
        
        
          details += '</table>'+
            '</td>'+
            '<td class="hide_blk"> </td>'+
            '<td class="hide_blk"> </td>'+
            '<td class="hide_blk"> </td>'+
          '</tr>';
        return details;
      },
      error: function(error){
        console.log("Error:");
        console.log(error);
      }
    });
  }
  else if(d[4] == "BANK TRANSFER")
  {
    $.ajax({
      url: url+'api/users/getWithdrawalDetails/'+d[5],
      type: "POST",
      dataType: "json",
      async: false,
      success: function(res){
        //var obj = jQuery.parseJSON(res);
         details = '<tr class="detal_row">'+
            '<td class="date"> &nbsp; </td>'+
            '<td colspan="2">'+
              '<table>'+
                '<tr>'+
                  '<th> Account No. </th>'+
                  '<th> Bank Name </th>'+
                  '<th> Amount </th>'+
                '</tr>';
          $.each(res.data, function(key,value) {
            details += '<tr>'+
                  '<td> '+value.account_no+'  </td>'+
                  '<td> '+value.bank_name+' </td>'+
                  '<td> '+'₹'+currency_format(value.withdrawal_amount,3)+' </td>'+
                '</tr>';
          }); 
        
        
          details += '</table>'+
            '</td>'+
            '<td class="hide_blk"> </td>'+
            '<td class="hide_blk"> </td>'+
            '<td class="hide_blk"> </td>'+
          '</tr>';
        return details;
      },
      error: function(error){
        console.log("Error:");
        console.log(error);
      }
    });
    
  }else if(d[4] == "CROP TRANSFER")
  {
    $.ajax({
      url: url+'api/users/getWithdrawalDetails/'+d[5],
      type: "POST",
      dataType: "json",
      async: false,
      success: function(res){
        //var obj = jQuery.parseJSON(res);
         details = '<tr class="detal_row">'+
            '<td class="date"> &nbsp; </td>'+
            '<td colspan="2">'+
              '<table>'+
                '<tr>'+
                  '<th> From Crop</th>'+
                  '<th> To Crop </th>'+
                  '<th> Amount </th>'+
                '</tr>';
          $.each(res.data, function(key,value) {
            details += '<tr>'+
                  '<td> '+value.src_crop+'  </td>'+
                  '<td> '+value.dst_crop+'  </td>'+
                  '<td> '+'₹'+currency_format(value.withdrawal_amount,3)+' </td>'+
                '</tr>';
          }); 
        
        
          details += '</table>'+
            '</td>'+
            '<td class="hide_blk"> </td>'+
            '<td class="hide_blk"> </td>'+
            '<td class="hide_blk"> </td>'+
          '</tr>';
        return details;
      },
      error: function(error){
        console.log("Error:");
        console.log(error);
      }
    });
    
  }
  else if(d[4] == "USER TRANSFER")
  {
    $.ajax({
      url: url+'api/users/getWithdrawalDetails/'+d[5],
      type: "POST",
      dataType: "json",
      async: false,
      success: function(res){
        //var obj = jQuery.parseJSON(res);
		var user_or_crop = "";
		var src_crop = dst_crop = "NA"
         details = '<tr class="detal_row">'+
            '<td class="date"> &nbsp; </td>'+
            '<td colspan="2">'+
              '<table>'+
                '<tr>'+
                  '<th> From User/Crop Name </th>'+
                  '<th> To User/Crop Name</th>'+
                  '<th> Amount </th>'+
                '</tr>';
          $.each(res.data, function(key,value) {
			  /* if(value.crop_location == null || value.crop_location == "")
			  {
				  user_or_crop = value.user_name;
			  }else{
				  user_or_crop = value.crop_location;
			  } */
			 if(value.src_crop != null){ src_crop = value.src_crop;}
			 if(value.dst_crop != null){ dst_crop = value.dst_crop;}
            details += '<tr>'+
                  '<td> '+value.src_user+' / '+src_crop+'  </td>'+
                  '<td> '+value.dst_user+' / '+dst_crop+'  </td>'+
                  '<td> '+'₹'+currency_format(value.withdrawal_amount,3)+' </td>'+
                '</tr>';
          }); 
        
        
          details += '</table>'+
            '</td>'+
            '<td class="hide_blk"> </td>'+
            '<td class="hide_blk"> </td>'+
            '<td class="hide_blk"> </td>'+
          '</tr>';
        return details;
      },
      error: function(error){
        console.log("Error:");
        console.log(error);
      }
    });
    
  }
  else if(d[4] == "LOADING" || d[4] == "TRANSPORT"|| d[4] == "AMOUNT")
  {
    details = '';
  }
  return details;
    
}

/* function load_records(d){
  console.log(d);
  var  details = "";
  $.ajax({
    url: url+'api/users/getSettledDetails/'+d[5],
    type: "POST",
    dataType: "json",
    async: false,
    success: function(data){
      console.log(data);
      details = '<tr class="detal_row">'+
          '<td class="date"> &nbsp; </td>'+
          '<td colspan="2">'+
            '<table>'+
              '<tr>'+
                '<th> Crop Location </th>'+
                '<th> Loan Type </th>'+
                '<th> Loan Amount </th>'+
                '<th>  </th>'+
                '<th>  </th>'+
              '</tr>'+
              '<tr>'+
                '<td>   </td>'+
                '<td>  </td>'+
                '<td>  </td>'+
                '<td>  </td>'+
                '<td>  </td>'+
              '</tr>'+
            '</table>'+
          '</td>'+
          '<td class="hide_blk"> </td>'+
          '<td class="hide_blk"> </td>'+
          '<td class="hide_blk"> </td>'+
        '</tr>';
      return details;
    },
    error: function(error){
      console.log("Error:");
      console.log(error);
    }
  });   
  //return data;
} */
</script>
<script src='<?php echo base_url(); ?>assets/js/withdrawals.js'></script>
<?php require_once 'footer.php';?>