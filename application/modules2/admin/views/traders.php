<?php require_once 'header.php' ; ?>
<link href="<?php echo base_url();?>assets/css/trader.css" type="text/css" rel="stylesheet">
<?php require_once 'sidebar.php' ; ?>
<script src='https://kit.fontawesome.com/a076d05399.js'></script>
<style>
.dataTables_filter {margin-right:0px!important;}
/* #snackbar{width:100%;} */
.invalid{border:1px solid red;}
.error {
    border: 2px solid #f00 !important;
}

.valid {
    border: 2px solid #0ff !important;
}
.tooltip{
	opacity:0.7 !important;
}
</style>

<link href="<?php echo base_url();?>assets/css/snackbar.css" type="text/css" rel="stylesheet">
<div class="right_blk"> 
	<div class="top_ttl_blk"> <span class="padin_t_5">Traders  </span>  
		<span class="crt_link fr">
			<button class="btn btn-primary"> Create Trader </button> 
			<i class="fa fa-times cl_crt_bl hide_blk" aria-hidden="true"></i>
		</span>
	</div>
	<!-- Create Trade Start -->
	<div class="trade_create"> 
        <div class="crt_blk"> 
			<div id="snackbar" class=""></div>
			<h2 class="create_hdg" id="trader_hd"> Create Trader </h2>			
			<form action="javascript:void(0);" id="trader_frm" name="trader_frm" method="post" >		 
			<div class="ove_auto">				
				<div class="trd_cr"> 
					
					<!-- <div class="alert alert-danger" id="danger-alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<span class="err_msg"></span>
					</div> -->
					
					<div class="type_trd rad_btns">
						<label class="radio-inline radio_blk checkd">
							<input type="radio" value="Agent" name="trader_type" checked>Agent
						</label>
						<label class="radio-inline radio_blk">
							<input type="radio" value="Exporter" name="trader_type">Exporter
						</label>
					</div>
					<div class="agnt_blk" style="display: block;">
						<div class="cre_inp firm_block" style="display:none;">
							<div class="sm_blk"> <!-- <span class="red_clr">*</span> -->Firm Name </div>
							<input type="text" id="firm_name" name="firm_name" class="form-control mykey"  placeholder="" />
						</div>
						<div class="cre_inp">
							<div class="sm_blk chng_label"> <!-- <span class="red_clr">*</span> -->Trader Name </div>
							<input type="text" class="form-control mykey" id="tname" name="tname" placeholder="" />
						</div>

						<div class="trd_c_row"> 
							<div class="trd_c_cel"> 
								<div class="cre_inp">
									<div class="sm_blk"> <!-- <span class="red_clr">*</span> -->Mobile </div>
									<input type="text" id="tmobile" name="tmobile" maxlength="10" class="form-control allownumericwithoutdecimal mykey" placeholder="" />
								</div>
							</div>
							<div class="trd_c_cel"> 
								<div class="cre_inp">
									<div class="sm_blk"> <!-- <span class="red_clr">*</span> -->Location </div>
									<input type="text" id="tlocation" name="tlocation" class="form-control mykey" placeholder="" />
								</div>
							</div>
						</div>

						<div class="trd_c_row"> 
						
							<div class="trd_c_cel aadhar_block"> 
								<div class="cre_inp">
									<div class="sm_blk"> Aadhar </div>
									<input type="text" id="taadhar" name="taadhar" maxlength="12" class="form-control allownumericwithoutdecimal mykey" placeholder="" />
								</div>
							</div>	
							
							<div class="trd_c_cel pan_block"> 
								<div class="cre_inp">
									<div class="sm_blk"> Pan </div>
									<input type="text" id="tpan" name="tpan" class="form-control mykey" placeholder="" />
								</div>
							</div>

							<div class="trd_c_cel gst_block"> 
								<div class="cre_inp">
									<div class="sm_blk"> GST </div>
									<input type="text" id="tgst" name="tgst" class="form-control mykey" placeholder="">
								</div>
							</div>						
							
						</div>       

						<div class="cre_inp bal_ll">
							<div class="sm_blk"> <!-- <span class="red_clr">*</span> -->Balance </div>
							<!-- <ul> 
								<li id="ps"> + <input type="radio" id="p" name="bl_ch" value="Positive" /> </li> <li> - <input type="radio" id="n" name="bl_ch" value="Negative" /> </li> 
							</ul> -->
							<input type="text" id="tbal_commas" name="tbal_commas" class="form-control mykey" value="" onkeyup = "amount_with_commas('add');" onblur = "amount_with_commas('add');" />
							<input type="hidden" id="tbal" name="tbal" class="form-control allownumericwithoutdecimal" value="" />
							<!-- <label id="bl_ch-error" class="error" for="bl_ch"></label> -->
						</div>   
						<div class="cre_inp">
							<div class="sm_blk"> Payment Terms </div>
							<input type="text" id="pterm" name="pterm" class="form-control mykey" placeholder="" />
						</div>
					</div>
					
				</div>        
			</div>

			<div class="trd_subm">
				<button type="submit" class="btn btn-primary fr sbt_btn"> Submit</button>
				<input type="text" id="hid_td_id" name="hid_td_id" value="" />
				<input type="hidden" id="traderexists" name="traderexists" value="0" />
				<input type="hidden" id="firmexists" name="firmexists" value="0" />
				<input type="hidden" id="hid_tname" name="hid_tname" value="" />
				<input type="hidden" id="hid_firmname" name="hid_firmname" value="" />
			</div>
			<div class="form-errors"></div>
			</form>
		</div>
	</div>
	<!-- Create Trade End -->
	<div class="trd_cr_r">
		<div class="mar_btm_20">
			<div class="card_view dis_tbl">
				<ul class="trd_anl"> 
					<li class="bor_lf_none"> 
						<div class="top_in_op crop_top">
							<p> Traders </p> 
							<h1><span id="tot_count">0</span></h1>
						</div>
					</li>
					<li class=""> 
						<div class="top_in_op crop_top">
							<p> Agents </p> 
							<h1><span id="agent_count">0</span></h1>
						</div>
					</li>
					<li class=""> 
						<div class="top_in_op crop_top">
							<p> Exporters </p> 
							<h1><span id="exporter_count">0</span></h1>
						</div>
					</li>
				</ul>				
			</div>
		</div>
			
		<div class="lst_trd">
			<div class="card_view"> 
				<div class="">
					<div class="res_tbl">
						<!-- <div class="dropdowns">
							<button class="btn btn-secondary drp_btn" type="button">
								<i class="fa fa-th-list" aria-hidden="true"></i>
							</button>
							<ul class="sl_menu">
								<li><a class="toggle-vis" data-column="1">Date</a></li>  
								<li><a class="toggle-vis" data-column="2">Trader</a> </li>    
								<li><a class="toggle-vis" data-column="3">Mobile</a> </li>
								<li><a class="toggle-vis" data-column="4">Type</a> </li>
								<li><a class="toggle-vis" data-column="5">Open Balance</a> </li>       
							</ul>
						</div> -->
						<table id="trader_lst_tbl" cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped table-hover" style="width:100%">
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
									<th> Trader </th>
									<th class="mob_numb"> Mobile </th>
									<th class="stat_blk"> Type 
										<span class="sts_pp">
											<i class="fa fa-filter" aria-hidden="true" style="font-size: 9px;"></i>
										</span>
										<div class="sts_fil_blk">         
											<div class="trd_lst">
												<div class="form-check chek_bx">
													<input class="form-check-input" type="checkbox" name="trader_opt" value="Agent" id="sta1">
													<label class="form-check-label" for="sta1">
													Agent
													</label>
												</div>
												<div class="form-check chek_bx">
													<input class="form-check-input" type="checkbox" name="trader_opt" value="Exporter" id="sta2">
													<label class="form-check-label" for="sta2">
													Exporter
													</label>
												</div>
											</div>
										</div>
									</th>
									<th colspan="bal_tbl"> Open Balance</th>
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

<div class="modal" id="delete_trader">
	<div class="modal-dialog">
	   <div class="modal-content">
			<div class="modal-body">
				<h1> Are You Sure ! </h1>
				<p> You want delete this Trader </p>
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
		<input type="text" value="" id="popover_id">
	</div>
</div>

<div id="note_cnt"> 
 
</div>
<script type="text/javascript">
var url = "<?php echo base_url()?>";
</script>
<script src="<?php echo base_url();?>assets/js/trader.js"></script>
<?php require_once 'footer.php' ; ?>