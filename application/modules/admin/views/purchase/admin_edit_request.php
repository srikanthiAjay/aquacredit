<div id="edt_module" role="dialog" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content content" id="modal_content">
            <div class="overlay" id="overlay_id" style="display: none;"><div class="overlay-content"><img src="<?php echo base_url();?>/assets/images/loading.gif" alt="Loading..."/></div></div>
            <div class="pp_clss" data-dismiss="modal"> <i class="fa fa-times" aria-hidden="true"></i> </div>
            <div class="pop_hdr">
                <!-- <div class="pop_logo">
                                <img src="http://3.7.44.132/aquacredit/assets/images/ssa_logo.png" width="80" alt="" title="">
                            </div> -->
                <div class="pop_stp_tbs">
                    <div class="bdr_blue"></div>
                    <div id="confirm" class="tbs_div fst_step act_tb" onclick="Purchase.confirmation('step1');">
                        1
                        <div class="tb_hdg">Confirm Request</div>
                    </div>
                    <div id="payment" class="tbs_div sec_step" onclick="Purchase.confirmation('step2');">
                        2
                        <div class="tb_hdg">Payment</div>
                        <!-- <div class="paid_amont_bb"> <span class="paid_icn"><img src="http://3.7.44.132/aquacredit/assets/images/paid.png"> </span> <span>₹98,200</span> </div> -->
                    </div>
                    <div id="received" class="tbs_div thrd_step" onclick="Purchase.confirmation('step3');">
                        3
                        <div class="tb_hdg">Received</div>
                    </div>
                    <!-- <div class="tbs_div fth_step"> 4
                        <div class="tb_hdg"> Completed </div>
                            </div> -->
                </div>
            </div>

            <!--Step 1-->
            <div class="confrm_blk">
                <div class="ord_comp_bl">
                    <h2 class="create_hdg" id="brand_title">Avanti Brand</h2>
                    <ul class="brnchs_list" id="branch_list">
                        <!-- <li>
                            <div class="check_wt_serc val_seld">
                                <div class="show_va">Branch 1</div>
                                <div class="selectVal">Products(1)</div>
                                <ul class="check_list">
                                    <li>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Search Branch" />
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="trader" id="uss1" value="user1" />
                                            <label class="form-check-label" for="uss1">
                                                Product 1
                                            </label>
                                            <input type="text" class="cnt" placeholder="count" />
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="trader" id="uss2" value=" Bank 2" />
                                            <label class="form-check-label" for="uss2">
                                                Product 2
                                            </label>
                                            <input type="text" class="cnt" placeholder="count" />
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="trader" id="uss3" value="user3" />
                                            <label class="form-check-label" for="user3">
                                                Product 3
                                            </label>
                                            <input type="text" class="cnt" placeholder="count" />
                                        </div>
                                    </li>
                                    <li><button class="btn save_blk btn-primary">Save</button></li>
                                </ul>
                                <div></div>
                            </div>
                        </li>
                        <li>
                            <div class="check_wt_serc val_seld">
                                <div class="show_va">Branch 2</div>
                                <div class="selectVal">Products(2)</div>
                                <ul class="check_list">
                                    <li>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Search Branch" />
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="trader" id="uss1" value="user1" />
                                            <label class="form-check-label" for="uss1">
                                                Product 1
                                            </label>
                                            <input type="text" class="cnt" placeholder="count" />
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="trader" id="uss2" value=" Bank 2" />
                                            <label class="form-check-label" for="uss2">
                                                Product 2
                                            </label>
                                            <input type="text" class="cnt" placeholder="count" />
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="trader" id="uss3" value="user3" />
                                            <label class="form-check-label" for="user3">
                                                Product 3
                                            </label>
                                            <input type="text" class="cnt" placeholder="count" />
                                        </div>
                                    </li>
                                    <li><button class="btn save_blk btn-primary">Save</button></li>
                                </ul>
                                <div></div>
                            </div>
                        </li> -->
                    </ul>
                    <table class="ord_lst" cellspacing="0" cellpadding="0" border="0" id="all_prods_id">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th class="text_cent qty_pp">Qty</th>
                                <th class="text_rt txt_cnt">Purchase Amount</th>
                                <th class="text_rt ttl_pop">Total</th>
                            </tr>
                        </thead>
                        <tbody id="all_prods">
                            <!-- <tr>
                                <td><input type="text" value="Product Name -1" /></td>

                                <td class="text_cent qty_pp"><input type="text" class="text_cent" value="10" name="" /></td>
                                <td data-toggle="tooltip" data-placement="top" title="MRP:2,500" class="text_rt qty_prc">
                                    <input type="text" value="2,000" class="text_rt" name="" />
                                </td>
                                <td class="text_rt">20,000</td>
                            </tr>
                            <tr>
                                <td><input type="text" value="Product Name -1" /></td>

                                <td class="text_cent qty_pp"><input type="text" class="text_cent" value="10" name="" /></td>
                                <td data-toggle="tooltip" data-placement="top" title="MRP:2,500" class="text_rt">
                                    <input type="text" value="2,000" class="text_rt" name="" />
                                </td>
                                <td class="text_rt">20,000</td>
                            </tr>
                            <tr>
                                <td><input type="text" value="Product Name -1" /></td>

                                <td class="text_cent qty_pp"><input type="text" class="text_cent" value="10" name="" /></td>
                                <td data-toggle="tooltip" data-placement="top" title="MRP:2,500" class="text_rt">
                                    <input type="text" value="2,000" class="text_rt" name="" />
                                </td>
                                <td class="text_rt qty_pp">20,000</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text_rt ttl_amnt">Total Amount</td>
                                <td class="blue_text text_rt ttl_amnt">₹100,000</td>
                            </tr> -->
                        </tbody>
                    </table>
                </div>
                <div class="po_ftr">
                    <button class="btn fr sb_btn btn-primary" onclick="Purchase.purchaseConfirm();" id="confirm_id">Confirm</button>
                </div>
            </div>
            <!--Step 1-->

            <!--Step 2-->
            <div class="pay_sec">
              <!-- <ul>
                <li onclick="Purchase.payType('bank');">
                    <input type="radio" id="ptype_bank" name="act_types" value="bank" />
                    <span> Bank Transfer </span>
                </li>

              </ul> -->

                <div class="ord_comp_bl" id="do_payment">
                    <ul class="assign_type">

                        <li id="bk" class="act_type lnk_typ ban_trns" onclick="Purchase.payType('bank');">
                            <img src="http://3.7.44.132/aquacredit/assets/images/bank_tansfer.png" />
                            <input type="radio" id="ptype_bank" name="act_pay_types" value="bank" checked/>
                            <span> Bank Transfer </span>
                        </li>
                        <li id="ch" class="cash_trns lnk_typ" onclick="Purchase.payType('cash');">
                            <img src="http://3.7.44.132/aquacredit/assets/images/cash_icn.png" />
                            <input type="radio" id="ptype_cash" name="act_pay_types" value="cash" />
                            <span> Cash </span>
                        </li>
                        <li id="cc" class="credit_trns lnk_typ" onclick="Purchase.payType('credit');">
                            <img src="http://3.7.44.132/aquacredit/assets/images/credit_icn.png" />
                            <input type="radio" id="ptype_credit" name="act_pay_types" value="credit"/>
                            <span> Credit </span>
                        </li>
                        <li class="bor_lf_none pur_pr">
                            <div class="top_in_op crop_top">
                                <p>Purchase Amount</p>
                                <h1><span>₹</span><input type="text" value="" id="tot_pcamt" name="tot_pcamt"/></h1>
                            </div>
                        </li>
                    </ul>
                    <div class="trn_in_blk">
                        <div class="blk_disb"></div>
                        <ul class="trans_inf">
                            <li class="date_inp bktr">
                                <div class="cre_inp" id="paydatetxt_p">
                                    <div class="sm_blk" id="paydatetxt">Date</div>
                                    <input type="text" class="form-control" value="" id="paydate" name="paydate" />
                                </div>
                            </li>
                            <li class="admin_bank_li bktr">
                                <div class="check_wt_serc admin_co_acc" id="adminacc_admin">
                                    <div class="show_va">Select Bank</div>
                                    <div class="selectVal" id="adminVal" onclick="Purchase.showAccounts('admin');">Select Bank</div>
                                    <ul class="check_list" id="banklist_admin"></ul>
                                </div>
                            </li>
                            <li class="us_bn_ls bktr">
                                <div class="check_wt_serc admin_co_acc" id="adminacc_co">
                                    <div class="show_va">Company Bank</div>
                                    <div class="selectVal" id="cobankVal" onclick="Purchase.showAccounts('co');">Company Bank</div>
                                    <ul class="check_list" id="banklist_co"></ul>
                                </div>
                            </li>
                            <li>
                                <div class="cre_inp" id="refno_txt">
                                    <div class="sm_blk">Ref.Number</div>
                                    <input type="text" id="refno" name="refno" class="form-control allownumericwithoutdecimal" value=""/>
                                </div>
                            </li>
                            <li><a href="javascript:void(0);" class="ad_nt"> Add note </a></li>
                        </ul>
                    </div>
                    <div>

                    </div>
                    <div class="pp_note">
                        <textarea id="addnote" name="addnote" rows="4" placeholder="Add Note"></textarea>
                    </div>
                    <div id="step2_errmsg"></div>
                </div>
                <div class="ord_comp_bl" id="payment_info_block" style="display: none;">
                    <table class="ord_lst" cellspacing="0" cellpadding="0" border="0">
                        <thead>
                            <tr>
                                <th colspan="2">Payment Information</th>
                            </tr>
                        </thead>
                        <tbody id="payment_info">
                            <!-- <tr>
                                <td>Payment Type</td>
                                <td class="text_cent qty_pp">30</td>
                            </tr>
                            <tr>
                                <td>Date</td>
                                <td class="text_cent qty_pp">30</td>
                            </tr>
                            <tr>
                                <td>Admin Bank Acc NO</td>
                                <td class="text_cent qty_pp">30</td>
                            </tr>
                            <tr>
                                <td>Company Bank Acc NO</td>
                                <td class="text_cent qty_pp">30</td>
                            </tr>
                            <tr>
                                <td>Ref.Number</td>
                                <td class="text_cent qty_pp">30</td>
                            </tr>
                            <tr>
                                <td>Note</td>
                                <td class="text_cent qty_pp">30</td>
                            </tr>
                            <tr>
                                <td class="text_rt ttl_amnt">Total Amount</td>
                                <td class="blue_text text_rt ttl_amnt">₹1,10,000</td>
                            </tr>
                            <tr>
                                <td class="text_rt ttl_amnt">Paid Amount</td>
                                <td class="blue_text text_rt ttl_amnt">₹1,10,000</td>
                            </tr> -->
                        </tbody>
                    </table>
                </div>
                <div class="pay_blk_btn" id="paybtn">
                    <button class="btn btn-primary" onclick="Purchase.doPayment();">Pay Now</button>
                </div>
            </div>
            <!--Step 2-->

            <!--Step 3-->
            <div class="comp_blk">
                <div class="ord_comp_bl">
                    <h2 class="create_hdg" id="cname"></h2>
                    <ul class="nav nav-tabs" id="myTab" role="tablist"></ul>
                    <div class="tab-content" id="branchplist"></div>
                </div>
                <!-- <div class="po_ftr">
                    <button class="btn fr sb_btn btn-primary"> Confirm </button>
                </div> -->
            </div>
            <!--Step 3-->

        </div>
    </div>
</div>
