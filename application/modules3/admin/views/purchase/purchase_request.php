<div id="create_module" role="dialog" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="pp_clss" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></div>
            <h2 class="create_hdg" style="margin-bottom: 15px;">
                Purchase Request <span id="msg"></span>
            </h2>
            <ul class="trans_inf ll_inp">
                <li>
                    <div class="check_wt_serc val_seld" style="pointer-events:none;">
                        <div class="show_va">Branchs</div>
                        <div class="selectVal"><?php echo $branch["branch_name"];?></div>
                        <ul class="check_list">
                            <!-- <li>
                                <div class="form-group">
                                    <input type="email" checked="true" class="form-control" placeholder="Search Branch" />
                                </div>
                            </li> -->
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
                        <div class="selectVal" id="bselectVal">Brands</div>
                        <ul class="check_list">
                            <li>
                                <?php 
                                    foreach ($brands as $key=>$value) {
                                       ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="brand_id" id="brand_<?php echo $value["brand_id"];?>_id" value="<?php echo $value["brand_name"];?>" onclick="Purchase.getProducts(<?php echo $value["brand_id"];?>);"/>
                                            <label class="form-check-label" for="brand_<?php echo $value["brand_id"];?>_id">
                                                <?php echo $value["brand_name"];?>
                                            </label>
                                        </div>
                                       <?php 
                                    }
                                ?>
                                <!-- <div class="form-check">
                                    <input class="form-check-input" type="radio" name="trader" id="br1" value="Brand" />
                                    <label class="form-check-label" for="br1">
                                        Brand1
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="trader" id="br2" value="Brand2" />
                                    <label class="form-check-label" for="br2">
                                        Brand2
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="trader" id="br3" value="Brand3" />
                                    <label class="form-check-label" for="br3">
                                        Brand3
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="trader" id="br4" value="Brand4" />
                                    <label class="form-check-label" for="br4">
                                        Brand4
                                    </label>
                                </div> -->
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- <li class="fr ad_mr"> <a href="#" class="ad_nt"> + Add more </a> </li> -->
            </ul>

            <!-- 	<div class="pp_note"> 
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
                <tbody id="addproducts">
                    <tr><td colspan="3">Please select Brand</td></tr>
                    <!-- <tr>
                        <td><input type="text" value="Product Name 2" /></td>
                        <td class="txt_cnt qty_pp">
                            <input type="text" value="01" />
                        </td>
                        <td class="red_clr act_pp txt_cnt"><i class="fa fa-trash" aria-hidden="true"></i></td>
                    </tr>
                    <tr>
                        <td><input type="text" value="Product Name 2" /></td>
                        <td class="txt_cnt qty_pp">
                            <input type="text" value="02" />
                        </td>
                        <td class="red_clr act_pp txt_cnt"><i class="fa fa-trash" aria-hidden="true"></i></td>
                    </tr>
                    <tr>
                        <td><input type="text" value="Product Name 2" /></td>
                        <td class="txt_cnt qty_pp">
                            <input type="text" value="03" />
                        </td>
                        <td class="red_clr act_pp txt_cnt"><i class="fa fa-trash" aria-hidden="true"></i></td>
                    </tr>
                    <tr>
                        <td><input type="text" value="Product Name 2" /></td>
                        <td class="txt_cnt qty_pp">
                            <input type="text" value="04" />
                        </td>
                        <td class="red_clr act_pp txt_cnt"><i class="fa fa-trash" aria-hidden="true"></i></td>
                    </tr>
                    <tr>
                        <td><input type="text" value="Product Name 2" /></td>
                        <td class="txt_cnt qty_pp">
                            <input type="text" value="05" />
                        </td>
                        <td class="red_clr act_pp txt_cnt"><i class="fa fa-trash" aria-hidden="true"></i></td>
                    </tr>
                    <tr>
                        <td><input type="text" /></td>
                        <td><input type="text" /></td>
                        <td><input type="text" /></td>
                    </tr> -->
                </tbody>
            </table>

            <!-- <div class="fl_over">
                <div class="avail_bal">
                    <table>
                        <tbody>
                            <tr class="disc_blk">
                                <td class="green_txt">Unloading Charges <span class="red_clr"></span></td>
                                <td colspan="2" class="green_txt"><input type="text" name="" class="text_rt" value="2000" /></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="avail_bal">
                    <table>
                        <tbody>
                            <tr class="disc_blk">
                                <td class="green_txt">
                                    Transport Charges <span class="red_clr"> </span>
                                </td>
                                <td class="">
                                    <input type="text" name="" class="text_rt" value="2000" />
                                </td>
                            </tr>

                        </tbody>
                    </table>
                    <div class="checkbox adm_ant">
                        <div class="row">
                            <div class="col-md-7">
                                <label><input type="checkbox" checked="checked" value="" />Use Cash Balance</label>
                                <p class="bal_amn_cash">Remaining Balance: ₹1000</p>
                            </div>
                            <div class="col-md-5">
                                <div class="top_in_op text_rt crop_top">
                                    <p class="text_rt">You used</p>
                                    <h1 class="text_rt">4000</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

            <div class="po_ftr">
                <!-- <a href="#" title="" class="invoice_up">
                    <label for="fine_inv">
                        <i class="fa fa-paperclip" aria-hidden="true"></i> Upload Invoice
                        <input type="file" id="fine_inv" />
                    </label>
                </a> -->
                <button type="button" class="btn fr sb_btn btn-primary" onclick="Purchase.submitRequest();" id="reqbtn">Request <span id="reqloader"></span></button>
            </div>
        </div>
    </div>
</div>