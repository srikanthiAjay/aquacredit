<div id="view_module" role="dialog" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content" id="mcontent_id">
            <div class="overlay" id="view_overlay_id" style="display: none;"><div class="overlay-content"><img src="<?php echo base_url();?>/assets/images/loading.gif" alt="Loading..."/></div></div>
            <div class="pp_clss" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></div>
            <h2 class="create_hdg" style="margin-bottom: 15px;"><span id="vreq_status_id">View Request</span> <span id="emsg"></span></h2>
            <ul class="trans_inf ll_inp">
                <li>
                    <div class="check_wt_serc val_seld" style="pointer-events:none;">
                        <div class="show_va">Branchs</div>
                        <div class="selectVal"><?php echo $branch["branch_name"];?></div>
                        <ul class="check_list">
                            <li>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="vbranch" name="vbranch" value="Branch1" checked="checked" />
                                    <label class="form-check-label" for="branch">
                                        <?php echo $branch["branch_name"];?>
                                    </label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <div class="check_wt_serc" id="vbds_list_id">
                        <div class="show_va">Brands</div>
                        <div class="selectVal" id="vbselectVal">Brands</div>
                        <ul class="check_list">
                            <li>
                                <?php 
                                    foreach ($brands as $key=>$value) {
                                       ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="vebrand_id" id="vebrand_<?php echo $value["brand_id"];?>_id" value="<?php echo $value["brand_name"];?>" disabled/>
                                            <label class="form-check-label" id="vebrand_lb_<?php echo $value["brand_id"];?>_id" for="vebrand_<?php echo $value["brand_id"];?>_id">
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
            </ul>
            <table class="ord_lst" cellspacing="0" cellpadding="0" border="0">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th class="txt_cnt qty_pp">MRP</th>
                        <th class="txt_cnt qty_pp">PR AMOUNT</th>
                        <!-- <th class="txt_cnt act_pp">Delete</th> -->
                    </tr>
                </thead>
                <tbody id="viewproducts">
                </tbody>
            </table>
        </div>
    </div>
</div>