<div id="edit_module" role="dialog" class="modal fade">
    <div class="modal-dialog">
        <form id="branch_edit" name="branch_edit" enctype="multipart/form-data">
        <div class="modal-content">
            <div class="pp_clss" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></div>
            <h2 class="create_hdg" style="margin-bottom: 15px;">
                Update Request <span id="emsg"></span>
            </h2>
            <ul class="trans_inf ll_inp">
                <li>
                    <div class="check_wt_serc val_seld">
                        <div class="show_va">Branchs</div>
                        <div class="selectVal"><?php echo $branch["branch_name"];?></div>
                        <ul class="check_list">
                            <li>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="branch" name="branch" value="Branch1" checked="checked" />
                                    <label class="form-check-label" for="branch">
                                        <?php echo $branch["branch_name"];?>
                                    </label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <div class="check_wt_serc">
                        <div class="show_va">Brands</div>
                        <div class="selectVal" id="ebselectVal">Brands</div>
                        <ul class="check_list">
                            <li>
                                <?php 
                                    foreach ($brands as $key=>$value) {
                                       ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="ebrand_id" id="ebrand_<?php echo $value["brand_id"];?>_id" value="<?php echo $value["brand_name"];?>" disabled/>
                                            <label class="form-check-label" id="ebrand_lb_<?php echo $value["brand_id"];?>_id" for="ebrand_<?php echo $value["brand_id"];?>_id">
                                                <?php echo $value["brand_name"];?>
                                            </label>
                                        </div>
                                       <?php 
                                    }
                                ?>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- <li class="fr ad_mr"> <a href="#" class="ad_nt"> + Add more </a> </li> -->
            </ul>

            <!--<div class="pp_note"> 
              <textarea rows="4" placeholder="Add Note"></textarea>
            </div> -->
            <table class="ord_lst" cellspacing="0" cellpadding="0" border="0">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th class="txt_cnt qty_pp">Qty</th>
                        <th class="txt_cnt act_pp">Delete</th>
                    </tr>
                </thead>
                <tbody id="editproducts">
                </tbody>
            </table>
            <div class="fl_over" id="uploading">
                <div class="avail_bal" id="upd_chr">
                    <table>
                        <tbody>
                            <tr class="disc_blk">
                                <td class="green_txt">Unloading Charges <span class="red_clr"></span></td>
                                <td colspan="2" class="green_txt"><input type="text" id="unloading_charges" name="unloading_charges" class="text_rt" value="2000" /></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="avail_bal" id="trs_chr">
                    <table>
                        <tbody>
                            <tr class="disc_blk">
                                <td class="green_txt">
                                    Transport Charges <span class="red_clr"> </span>
                                </td>
                                <td class="">
                                    <input type="text" id="transport_charges" name="transport_charges" class="text_rt" value="2000" />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="checkbox adm_ant" id="bwallet_remain" style="display: none;">
                        <div class="row">
                            <div class="col-md-7">
                                <label><input type="checkbox" checked="checked" value="" />Use Cash Balance</label>
                                <p class="bal_amn_cash">Remaining Balance: <span id="bwallet_bal"></span></p>
                            </div>
                            <div class="col-md-5">
                                <div class="top_in_op text_rt crop_top">
                                    <p class="text_rt">You used</p>
                                    <h1 class="text_rt" id="bwallet_bal"></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="po_ftr">
                <a href="javascript:void(0);" title="" class="invoice_up" id="invoice_up" style="display: none;">
                    <label for="fine_inv">
                        <i class="fa fa-paperclip" aria-hidden="true"></i> Upload Invoice
                        <input type="file" id="fine_inv" name="fine_inv" accept="application/pdf,image/jpg,image/jpeg,image/png"/>
                    </label>
                    <p id="invoice_file"></p>
                </a>
                <button type="button" class="btn fr sb_btn btn-primary" onclick="Purchase.updateRequest();" id="updatebtn">Update <span id="ereqloader"></span></button>
                <button type="button" class="btn fr sb_btn btn-primary" onclick="Purchase.updatePayment();" id="paymentbtn" style="display:none;">Pay <span id="epayloader"></span></button>
                <span id="updmsg"></span>
            </div>
            <div id="error" class="clear:both;"></div>
        </div>
        </form>
    </div>
</div>