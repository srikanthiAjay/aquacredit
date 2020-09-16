<?php require_once 'header.php' ; ?>
<link href="<?php echo base_url();?>assets/css/stock_transfer.css" type="text/css" rel="stylesheet">
<script src='https://kit.fontawesome.com/a076d05399.js'></script> 
<?php require_once 'sidebar.php' ; ?>
<style>
.ui-menu{
  z-index: 999999 !important;
}
</style>
<link href="<?php echo base_url();?>assets/css/snackbar.css" type="text/css" rel="stylesheet">		
<div class="right_blk"> 
	<div class="top_ttl_blk"> <span class="back_btn">
		</span> <span> Stock Transfer </span>
		
	</div>
	<div class="padding_10">
		<div class="trd_cr_r">
			<div class="card_view"> 
				<ul class="trd_anl"> 
					<li class="bor_lf_none"> 
						<div class="top_in_op crop_top">
							<p> Pending </p> 
							<h1 class="tot_pending"> 0 </h1>
						</div>
					</li>
					<li class=""> 
						<div class="top_in_op crop_top">
							<p> Completed </p> 
							<h1 class="tot_completed"> 0 </h1>
						</div>
					</li>			
					<li class="fr"> <button class="btn purc_btn btn-primary cre_ord"> Transfer Request</button> </li>
				</ul>
			</div>
			<div class="list_blk"> 
				<div class="list_tbl">
					<div class="res_tbl">	
						<div class="dateEle" ></div>
						<table id="pur_lst_tbl" class="table table-striped table-bordered" style="width:100%">
							<thead>
								<tr> 
									<th class="id_td"> Id </th>
									<!-- <th> User Name </th> -->
									<th class="date"> Date 
										<span class="pull-right" id="reportrange">
										<i class="fa fa-filter"  aria-hidden="true" style="font-size: 9px;"></i> 
										<span></span>
									</span>
									<input type="hidden" id="date_val" name="date_val" />
									</th>
									<th class="godown"> Source </th>
									<th class="godown"> Destination </th>
									<th class="ord_type"> Status 
										<span class="sts_pp">
											<i class="fa fa-filter" aria-hidden="true" style="font-size: 9px;"></i>   
										</span>
										<div class="sts_fil_blk">				
											<div class="trd_lst">
												<div class="form-check chek_bx">
													<input class="form-check-input" type="checkbox" name="status_opt" value="0" id="sta1">
													<label class="form-check-label" for="sta1">
													Pending
													</label>
												</div>
												<div class="form-check chek_bx">
													<input class="form-check-input" type="checkbox" name="status_opt" value="1" id="sta2">
													<label class="form-check-label" for="sta2">
													Completed
													</label>
												</div>
											</div>
										</div>
									</th>

									<!-- <th class="ord_ttl text_rt"> Order Total </th> -->
									<th class="act_ms"> Actions </th>
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
</div>

<script type="text/javascript"> 
var url = '<?php echo base_url()?>';
</script>
<script src="<?php echo base_url();?>assets/js/stock_transfer.js"></script>

<div id="create_module" role="dialog" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="pp_clss" data-dismiss="modal"> <i class="fa fa-times" aria-hidden="true"></i> </div>
			<h2 class="create_hdg" style="margin-bottom: 15px;"> Transfer Request </h2>
			<div id="snackbar" class=""></div>
			<form action="javascript:void(0);" id="stock_frm" name="stock_frm" method="post" >			
			<ul class="trans_inf ll_inp">
				<li> 
					<div class="check_wt_serc"> 
						<div class="show_va"> Source </div>
						<div class="selectVal src_branch_val"> Source </div>
						<ul class="check_list src_block mykey"> 
							<!--  <li> <div class="form-group">
							<input type="email" checked="true" class="form-control" placeholder="Search Branch">
							</div> </li> -->
							<li id="src_branch_li"> 
								<div class="form-check">
									<input class="form-check-input" type="radio" id="src_branch" name="src_branch"  value="" required />
									<label class="form-check-label" for="src_branch"></label>
								</div>
							</li>
						</ul>
					</div>
				</li>
				<li> 
					<div class="check_wt_serc"> 
						<div class="show_va"> Destination </div>
						<div class="selectVal dst_branch_val"> Destination </div>
						<ul class="check_list dst_block mykey"> 
							<li id="dst_branch_li"> 
								<div class="form-check">
									<input class="form-check-input" type="radio" id="dst_branch" name="dst_branch"  value="" disabled required />								
									<label class="form-check-label" for="dst_branch"></label>
								</div>
							</li>
						</ul>
					</div>
				</li>			
			</ul>
			<a href="javascript:void(0);" id="add_row" name="add_row" class="btn btn-primary btn-sm pull-right">Add Row</a><br/><br/>
			<table class="ord_lst" id="stk" cellspacing="0" cellpadding="0" border="0">
				<thead>
					<tr> 
						<th> Product Name </th>
						<th class="txt_cnt qty_pp"> Qty </th>
						<th class="txt_cnt act_pp"> Delete </th>
					</tr>
				</thead>
				<tbody>
					<!-- <tr> 
						<td class="prod_err"> <input type="text" id="p0" name="prod[]" class="skey table_input" value="" placeholder="Select Product" /> 
						<input type="hidden" id="hid_p0" name="hid_prod[]" value="" /></td>
						<td class="txt_cnt qty_pp qty_err"><input type="text" id="qty0" name="qty[]" value="" class="allownumericwithoutdecimal table_input" /></td>
						<td class="red_clr act_pp txt_cnt">
							<i class="fa fa-trash del_btn" aria-hidden="true"></i> 
						</td>
					</tr -->
				</tbody>
			</table>
			<div class="transport_blk">
				<table class="ord_lst">
					<tbody>
						<tr> 
							<td class="text_rt"> Transport Charges (₹)</td>
							<td class="trns_val"> <input type="text" id="trans_chrg" name="trans_chrg"  class="text_rt noalpha table_input" value="0" onkeyup="amount_with_commas('add',this.id);" />
							<input type="hidden" id="hid_trans_chrg" name="hid_trans_chrg"  class="text_rt allownumericwithdecimal" value="0" /></td>
						</tr>
					<!--	<tr> 
							<td class="text_rt"> Unloading Charges (₹)</td>
							<td class="trns_val"> <input type="text" id="upload_chrg" name="upload_chrg" class="text_rt noalpha table_input" value="0" onkeyup="amount_with_commas('add',this.id);" disabled /><input type="hidden" id="hid_upload_chrg" name="hid_upload_chrg" class="text_rt allownumericwithdecimal" value="0" />  </td>
						</tr> -->
						<tr> 
							<td class="text_rt"> Loading Charges (₹)</td>
							<td class="trns_val"> <input type="text" id="loading_chrg" name="loading_chrg" class="text_rt noalpha table_input" value="0" onkeyup="amount_with_commas('add',this.id);" /><input type="hidden" id="hid_loading_chrg" name="hid_loading_chrg" class="text_rt allownumericwithdecimal" value="0" />  </td>
						</tr>
					</tbody>
				</table>
			</div>

			<div class="po_ftr">
				<!-- <a href="#" title="" class="invoice_up"> 
				<label for="fine_inv">
				<i class="fa fa-paperclip" aria-hidden="true"></i> Upload Invoice
				<input type="file" id="fine_inv">			
				</label>
				</a> -->
				<input type="submit" class="btn fr sb_btn btn-primary" value="Create Transfer" />   
				<input type="hidden" id="hid_stk_trans_id" name="hid_stk_trans_id" value="" />   
				<input type="hidden" id="hid_prev_pid" name="hid_prev_pid" />   
				<input type="hidden" id="hid_prev_qty" name="hid_prev_qty" />   
			</div>
			</form>
		</div>
	</div>
</div>
<div id="popover-content" style="display: none">
	<div class="custom-popover">
		<ul class="list-group">
			<li class="list-group-item edt green_txt">Edit</li>
			<li class="list-group-item  reject_loan del">Delete</li>
		</ul>
	</div>
</div>
<?php require_once 'footer.php' ; ?>