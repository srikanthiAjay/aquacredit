<?php require_once 'header.php' ; ?>
<link href="<?php echo base_url();?>assets/css/purchases.css" type="text/css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
<script src='https://kit.fontawesome.com/a076d05399.js'></script> 
<?php require_once 'sidebar.php' ; ?>		
<div class="right_blk"> 
	<div class="top_ttl_blk"> <span class="back_btn">
		</span> <span> Purchases List </span>
	<!-- 	<a href="#" title="" class="fr btn btn-primary"> Purchase Request </a> -->
	</div>
	<div class="padding_10">
<div class="trd_cr_r">
	<div class="card_view"> 
		<ul class="trd_anl"> 
			<li class="bor_lf_none"> 
				 		<div class="top_in_op crop_top">
                               <p> Total Purchases </p> 
                               <h1> ₹10,00,00 </h1>
                                    </div>
				</li>
		<li> 
				<div class="top_in_op crop_top">
                         <p> Pendings </p> 
                         <h1> 30 </h1>
                </div>
		</li>
		<li> 
				<div class="top_in_op crop_top">
                         <p> Paid </p> 
                         <h1> 10 </h1>
                </div>
		</li>
		<li> 
				<div class="top_in_op crop_top">
                         <p> Approved </p> 
                         <h1> 20 </h1>
                </div>
		</li>
		<li> 
				<div class="top_in_op crop_top">
                         <p> Completed </p> 
                         <h1> 1000 </h1>
                </div>
		</li>
		<li class="fr"> <button class="btn purc_btn btn-primary"> Purchase Request</button> </li>
		</ul>
	 </div>

	 <div class="list_blk"> 
	 	<div class="list_tbl">
	 		<div class="res_tbl"> 
	 			<table id="pur_lst_tbl" class="table table-striped table-bordered" style="width:100%">
	 				<thead> 
	 				
              <th class="id_td"> Id </th>
              <th class="app_date"> Date 
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
              <th> Company Name </th>
              <th class=""> Amount </th>
              <th class="stat_blk"> Status 
                  <span class="sts_pp">
           <i class="fa fa-filter" aria-hidden="true" style="font-size: 9px;"></i>   
                 </span>
                  <div class="sts_fil_blk"> 

        
<div class="trd_lst">
    <div class="form-check chek_bx">
      <input class="form-check-input" type="checkbox" name="optradio" value="" id="sta1">
  <label class="form-check-label" for="sta1">
    Pending
  </label>
</div>
 <div class="form-check chek_bx">
  <input class="form-check-input" type="checkbox" name="optradio" value="" id="sta2">
  <label class="form-check-label" for="sta2">
    Payment
  </label>
</div>
 <div class="form-check chek_bx">
  <input class="form-check-input" type="checkbox" name="optradio" value="" id="sta3">
  <label class="form-check-label" for="sta3">
    Approved
  </label>
</div>

</div>
       </div>
              </th>
              <th class="act_ms"> Actions </th>
	 				</thead>
	 				<tbody>
	 					<tr> 
	 						<td class="id_td"> 
	 					<a href="#" title=""> 65852 </a>	</td>
	 					<td class="app_date"> 12-May-2020 </td>
	 					<td> Branch Name </td>
	 					<td> 5,0000 </td>
	 					<td class="pen_stat stat_blk"> Pending </td>
	 					 <td class="act_ms"> 
                  <i class="fa fa-ellipsis-v act_icns" data-toggle="popover" data-placement="left" tabindex="0" data-trigger="focus" data-toggle="popover" aria-hidden="true"></i>
                </td>
	 					</tr>
	 					<tr> 
	 						<td class="id_td"> 
	 					<a href="#" title=""> 65852 </a>	</td>
	 					<td class="app_date"> 12-May-2020 </td>
	 					<td> Branch Name </td>
	 					<td> 5,0000 </td>
	 					<td class="pen_stat stat_blk"> Pending </td>
	 					 <td class="act_ms"> 
                  <i class="fa fa-ellipsis-v act_icns" data-toggle="popover" data-placement="left" tabindex="0" data-trigger="focus" data-toggle="popover" aria-hidden="true"></i>
                </td>
	 					</tr>
	 					<tr> 
	 						<td class="id_td"> 
	 					<a href="#" title=""> 65852 </a>	</td>
	 					<td class="app_date"> 12-May-2020 </td>
	 					<td> Branch Name </td>
	 					<td> 5,0000 </td>
	 					<td class="pen_stat stat_blk"> Pending </td>
	 					 <td class="act_ms"> 
                  <i class="fa fa-ellipsis-v act_icns" data-toggle="popover" data-placement="left" tabindex="0" data-trigger="focus" data-toggle="popover" aria-hidden="true"></i>
                </td>
	 					</tr>
	 					<tr> 
	 						<td class="id_td"> 
	 					<a href="#" title=""> 65852 </a>	</td>
	 					<td class="app_date"> 12-May-2020 </td>
	 					<td> Branch Name </td>
	 					<td> 5,0000 </td>
	 					<td class="pen_stat stat_blk"> Pending </td>
	 					 <td class="act_ms"> 
                  <i class="fa fa-ellipsis-v act_icns" data-toggle="popover" data-placement="left" tabindex="0" data-trigger="focus" data-toggle="popover" aria-hidden="true"></i>
                </td>
	 					</tr>
	 					<tr> 
	 						<td class="id_td"> 
	 					<a href="#" title=""> 65852 </a>	</td>
	 					<td class="app_date"> 12-May-2020 </td>
	 					<td> Branch Name </td>
	 					<td> 5,0000 </td>
	 					<td class="pen_stat stat_blk"> Pending </td>
	 					 <td class="act_ms"> 
                  <i class="fa fa-ellipsis-v act_icns" data-toggle="popover" data-placement="left" tabindex="0" data-trigger="focus" data-toggle="popover" aria-hidden="true"></i>
                </td>
	 					</tr>
	 					<tr> 
	 						<td class="id_td"> 
	 					<a href="#" title=""> 65852 </a>	</td>
	 					<td class="app_date"> 12-May-2020 </td>
	 					<td> Branch Name </td>
	 					<td> 5,0000 </td>
	 					<td class="pen_stat stat_blk"> Pending </td>
	 					 <td class="act_ms"> 
                  <i class="fa fa-ellipsis-v act_icns" data-toggle="popover" data-placement="left" tabindex="0" data-trigger="focus" data-toggle="popover" aria-hidden="true"></i>
                </td>
	 					</tr>
	 					<tr> 
	 						<td class="id_td"> 
	 					<a href="#" title=""> 65852 </a>	</td>
	 					<td class="app_date"> 12-May-2020 </td>
	 					<td> Branch Name </td>
	 					<td> 5,0000 </td>
	 					<td class="pen_stat stat_blk"> Pending </td>
	 					 <td class="act_ms"> 
                  <i class="fa fa-ellipsis-v act_icns" data-toggle="popover" data-placement="left" tabindex="0" data-trigger="focus" data-toggle="popover" aria-hidden="true"></i>
                </td>
	 					</tr>
	 					<tr> 
	 						<td class="id_td"> 
	 					<a href="#" title=""> 65852 </a>	</td>
	 					<td class="app_date"> 12-May-2020 </td>
	 					<td> Branch Name </td>
	 					<td> 5,0000 </td>
	 					<td class="pen_stat stat_blk"> Pending </td>
	 					 <td class="act_ms"> 
                  <i class="fa fa-ellipsis-v act_icns" data-toggle="popover" data-placement="left" tabindex="0" data-trigger="focus" data-toggle="popover" aria-hidden="true"></i>
                </td>
	 					</tr>
	 					<tr> 
	 						<td class="id_td"> 
	 					<a href="#" title=""> 65852 </a>	</td>
	 					<td class="app_date"> 12-May-2020 </td>
	 					<td> Branch Name </td>
	 					<td> 5,0000 </td>
	 					<td class="pen_stat stat_blk"> Pending </td>
	 					 <td class="act_ms"> 
                  <i class="fa fa-ellipsis-v act_icns" data-toggle="popover" data-placement="left" tabindex="0" data-trigger="focus" data-toggle="popover" aria-hidden="true"></i>
                </td>
	 					</tr>
	 					<tr> 
	 						<td class="id_td"> 
	 					<a href="#" title=""> 65852 </a>	</td>
	 					<td class="app_date"> 12-May-2020 </td>
	 					<td> Branch Name </td>
	 					<td> 5,0000 </td>
	 					<td class="pen_stat stat_blk"> Pending </td>
	 					 <td class="act_ms"> 
                  <i class="fa fa-ellipsis-v act_icns" data-toggle="popover" data-placement="left" tabindex="0" data-trigger="focus" data-toggle="popover" aria-hidden="true"></i>
                </td>
	 					</tr>
	 				</tbody>
	 			</table>

	 		</div>
	 	</div>
	 </div>

</div>
	</div>
</div>
 <div id="popover-contents" style="display: none">
  <div class="custom-popover">
  <ul class="list-group">
    <li class="list-group-item edt green_txt">Edit</li>
    <li class="list-group-item  reject_loan del">Delete</li>
  </ul>
</div>
</div>
<div id="create_module" role="dialog" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="pp_clss" data-dismiss="modal"> <i class="fa fa-times" aria-hidden="true"></i> </div>
			<h2 class="create_hdg" style="margin-bottom: 15px;"> Purchase Request </h2>
				<ul class="trans_inf ll_inp">
				<li> 
					<div class="check_wt_serc"> 
              <div class="show_va"> Branchs </div>
            <div class="selectVal">  Branchs </div>
            <ul class="check_list"> 
          
              <li> 
        <div class="form-check">
  <input class="form-check-input" type="radio" name="trader" id="brc1" value="Branch1">
  <label class="form-check-label" for="brc1">
  Branch1
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="trader" id="brc2" value="Bracnh2">
  <label class="form-check-label" for="brc2">
   Branch2
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="trader" id="brc3" value="Branch3">
  <label class="form-check-label" for="brc3">
    Branch3
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="trader" id="brc4" value="Branch4">
  <label class="form-check-label" for="brc4">
    Branch4
  </label>
</div>
              </li>


            </ul>
          </div>
				</li>
				<li> 
					<div class="check_wt_serc"> 
              <div class="show_va"> Brands </div>
            <div class="selectVal">  Brands </div>
            <ul class="check_list"> 
           
              <li> 
        <div class="form-check">
  <input class="form-check-input" type="radio" name="trader" id="br1" value="Brand">
  <label class="form-check-label" for="br1">
  Brand1
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="trader" id="br2" value="Brand2">
  <label class="form-check-label" for="br2">
   Brand2
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="trader" id="br3" value="Brand3">
  <label class="form-check-label" for="br3">
    Brand3
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="trader" id="br4" value="Brand4">
  <label class="form-check-label" for="br4">
    Brand4
  </label>
</div>
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
						<th> Product Name </th>
						<th class="txt_cnt qty_pp"> Qty </th>
						<th class="txt_cnt act_pp"> Delete </th>
					</tr>
				</thead>
				<tbody>
					<tr> 
						<td> <input type="text" value="Product Name 2"> </td>
					<td class="txt_cnt qty_pp">
					<input type="text" value="01"> 
					</td>
						<td class="red_clr act_pp txt_cnt"> <i class="fa fa-trash" aria-hidden="true"></i> </td>
					</tr>
					<tr> 
						<td> <input type="text" value="Product Name 2"> </td>
					<td class="txt_cnt qty_pp">
					<input type="text" value="02"> 
					</td>
						<td class="red_clr act_pp txt_cnt"> <i class="fa fa-trash" aria-hidden="true"></i> </td>
					</tr>
					<tr> 
						<td> <input type="text" value="Product Name 2"> </td>
					<td class="txt_cnt qty_pp">
					<input type="text" value="03"> 
					</td>
						<td class="red_clr act_pp txt_cnt"> <i class="fa fa-trash" aria-hidden="true"></i> </td>
					</tr>
					<tr> 
						<td> <input type="text" value="Product Name 2"> </td>
					<td class="txt_cnt qty_pp">
					<input type="text" value="04"> 
					</td>
						<td class="red_clr act_pp txt_cnt"> <i class="fa fa-trash" aria-hidden="true"></i> </td>
					</tr>
					<tr> 
						<td> <input type="text" value="Product Name 2"> </td>
					<td class="txt_cnt qty_pp">
					<input type="text" value="05"> 
					</td>
						<td class="red_clr act_pp txt_cnt"> <i class="fa fa-trash" aria-hidden="true"></i> </td>
					</tr>
					<tr> 
						<td> <input type="text"> </td>
						<td> <input type="text"> </td>
						<td> <input type="text"> </td>
					</tr>
				</tbody></table>
				
<div class="fl_over">
			<div class="avail_bal">
			
		
<table><tbody>
	

						  <tr class="disc_blk"> 
				<td class="green_txt"> Unloading Charges <span class="red_clr"></span> </td>
				<td colspan="2" class="green_txt"> <input type="text" name="" class="text_rt" value="2000"> </td>
						 </tr>
						</tbody></table>
					</div>
					<div class="avail_bal">
						<table><tbody>
					
			 <tr class="disc_blk"> 
				<td class="green_txt"> Transport Charges <span class="red_clr"><!-- (not paid) --> </span> </td>
				<td class=""> 
					<input type="text" name="" class="text_rt" value="2000"> 
				</td>

						 </tr>

					<!-- 	 <tr class="disc_blk"> 
				<td class="green_txt"> Used Cash Balance </td>
				<td class="text_rt red_clr"> 
					- 4000 
				</td>

						 </tr>
						 <tr class="disc_blk"> 
				<td class="green_txt bdr_tp"> Available Cash Balance </td>
				<td class="text_rt bdr_tp"> 
					₹1000 
				</td>

						 </tr> -->


				</tbody>
			</table>
				<div class="checkbox adm_ant">
					<div class="row">
						<div class="col-md-7">
  <label><input type="checkbox" checked="checked" value="">Use Cash Balance</label>
  <p class="bal_amn_cash"> Remaining Balance: ₹1000 </p>
</div>	
<div class="col-md-5"> 
	<div class="top_in_op text_rt crop_top">
                         <p class="text_rt"> You used </p> 
                         <h1 class="text_rt"> 4000 </h1>
                </div>
	</div>
</div>
</div>
		</div>
</div>
			
			<div class="po_ftr">
				<a href="#" title="" class="invoice_up"> 
		<label for="fine_inv">
			<i class="fa fa-paperclip" aria-hidden="true"></i> Upload Invoice
			<input type="file" id="fine_inv">			
		</label>
	 </a>
			<button class="btn fr sb_btn btn-primary"> Request </button>
		</div>
		</div>
	</div>
	</div>
<div id="edt_module" role="dialog" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="pp_clss" data-dismiss="modal"> <i class="fa fa-times" aria-hidden="true"></i> </div>
			<div class="pop_hdr"> 
				<!-- <div class="pop_logo">
					<img src="http://3.7.44.132/aquacredit/assets/images/ssa_logo.png" width="80" alt="" title="">					
				</div> -->
			<div class="pop_stp_tbs"> 
				<div class="bdr_blue"></div>
			<div class="tbs_div fst_step act_tb"> 1
				<div class="tb_hdg"> Confirm Request </div> 
			</div>
				<div class="tbs_div sec_step"> 2 
			<div class="tb_hdg"> Payment </div>
			<!-- <div class="paid_amont_bb"> <span class="paid_icn"><img src="http://3.7.44.132/aquacredit/assets/images/paid.png"> </span> <span>₹98,200</span> </div> -->
				</div>
				<div class="tbs_div thrd_step"> 3 
			<div class="tb_hdg"> Received </div>
				</div>
				<!-- <div class="tbs_div fth_step"> 4 
			<div class="tb_hdg"> Completed </div>
				</div> -->
			</div>
		</div>
			<div class="confrm_blk"> 
				<div class="ord_comp_bl">
				<h2 class="create_hdg"> Avanti Brand </h2>
				<ul class="brnchs_list"> 
					<li> 
						<div class="check_wt_serc val_seld"> 
						<div class="show_va"> Branch 1  </div>
						<div class="selectVal">  Products(1) </div>
						<ul class="check_list"> 
						<!-- <li> <div class="form-group">
							<input type="text" class="form-control" placeholder="Search Branch">
						</div> </li> -->
							<li> 
								<div class="form-check chek_bx">
									<input class="form-check-input" type="checkbox" name="trader" id="uss1" value="user1">
									<label class="form-check-label" for="uss1">
										Product 1
									</label>
									<input type="text" class="cnt" placeholder="count">
								</div>
									<div class="form-check chek_bx">
									<input class="form-check-input" type="checkbox" name="trader" id="uss2" value=" Bank 2">
									<label class="form-check-label" for="uss2">
										Product 2     
									</label>
									<input type="text" class="cnt" placeholder="count">
									</div>
									<div class="form-check chek_bx">
									<input class="form-check-input" type="checkbox" name="trader" id="uss3" value="user3">
									<label class="form-check-label" for="user3">
											Product 3
									
									</label>
									<input type="text" class="cnt" placeholder="count">
									</div>

							</li>
							<li> <button class="btn save_blk btn-primary"> Save </button> </li>	
						</ul>
						<div> </div>

						</div>

					</li>
					<li> 
						 <div class="check_wt_serc val_seld"> 
						<div class="show_va"> Branch 2  </div>
						<div class="selectVal">  Products(2) </div>
						<ul class="check_list"> 
						<!--   <li> <div class="form-group">
							<input type="text" class="form-control" placeholder="Search Branch">
						</div> </li> -->
										<li> 
									<div class="form-check chek_bx">
							<input class="form-check-input" type="checkbox" name="trader" id="uss1" value="user1">
							<label class="form-check-label" for="uss1">
								Product 1
							</label>
							<input type="text" class="cnt" placeholder="count">
							</div>
							<div class="form-check chek_bx">
							<input class="form-check-input" type="checkbox" name="trader" id="uss2" value=" Bank 2">
							<label class="form-check-label" for="uss2">
								Product 2     
							</label>
							<input type="text" class="cnt" placeholder="count">
							</div>
							<div class="form-check chek_bx">
							<input class="form-check-input" type="checkbox" name="trader" id="uss3" value="user3">
							<label class="form-check-label" for="user3">
									Product 3
							
							</label>
							<input type="text" class="cnt" placeholder="count">
							</div>

							</li>
							<li> <button class="btn save_blk btn-primary"> Save </button> </li>
						</ul>
						<div> </div>

						</div>

					</li>

				</ul>
				<table class="ord_lst" cellspacing="0" cellpadding="0" border="0">
					<thead>
						<tr> <th> Product Name </th> 						
							<th class="text_cent qty_pp"> Qty </th> 
							<th class="text_rt txt_cnt"> Purchase Amount </th>
							<th class="text_rt ttl_pop"> Total </th>
						 </tr>
						<tr> 
						 	<td> <input type="text" value="Product Name -1"> </td>
						 
						 	<td class="text_cent qty_pp"> <input type="text" class="text_cent" value="10" name=""> </td>
						 	<td data-toggle="tooltip" data-placement="top" title="MRP:2,500" class="text_rt qty_prc"> 
							<input type="text" value="2,000" class="text_rt" name=""> 
						 	 </td>
						 	<td class="text_rt"> 20,000 </td>
						 </tr>
						<tr> 
						 	<td> <input type="text" value="Product Name -1"> </td>
						 	
						 	<td class="text_cent qty_pp"> <input type="text" class="text_cent" value="10" name=""> </td>
						 	<td data-toggle="tooltip" data-placement="top" title="MRP:2,500" class="text_rt"> 
			<input type="text" value="2,000" class="text_rt" name=""> 
						 	 </td>
						 	<td class="text_rt"> 20,000 </td>
						 </tr>
						 <tr> 
						 	<td> <input type="text" value="Product Name -1"> </td>
						 
						 	<td class="text_cent qty_pp"> <input type="text" class="text_cent" value="10" name=""> </td>
						 	<td data-toggle="tooltip" data-placement="top" title="MRP:2,500" class="text_rt"> 
			<input type="text" value="2,000" class="text_rt" name=""> 
						 	 </td>
						 	<td class="text_rt qty_pp"> 20,000 </td>
						 </tr>
						 <tr> 
						 	<td colspan="3" class="text_rt ttl_amnt"> Total Amount </td>
						 	<td class="blue_text text_rt ttl_amnt"> ₹100,000 </td>
						 </tr>
						<!--  <tr class="disc_blk"> 
				<td colspan="2" class="red_clr text_rt"> Discount </td>
				<td class="red_clr"> <input type="text" name="" class="red_clr text_rt" value="20%"> </td>
				<td class="red_clr"> <input type="text" name="" class="red_clr text_rt" value="-2000"> </td>
						 </tr> -->
						 
						
					</thead>
				</table>
					</div>
				<div class="po_ftr">
					
			<button class="btn fr sb_btn btn-primary"> Confirm </button>
		</div>
		
		</div>
			<div class="pay_sec"> 
<div class="ord_comp_bl">
				<ul class="assign_type"> 
    <li class="act_type lnk_typ ban_trns"> 
      <img src="http://3.7.44.132/aquacredit/assets/images/bank_tansfer.png">
      <input type="radio" name="act_types">
      <span> Bank Transfer </span>
    </li>
    <li class="cash_trns lnk_typ"> 
      <img src="http://3.7.44.132/aquacredit/assets/images/cash_icn.png">
      <input type="radio" name="act_types">
      <span> Cash </span>
    </li>
    <li class="credit_trns lnk_typ"> 
    	<img src="http://3.7.44.132/aquacredit/assets/images/credit_icn.png">
      <input type="radio" name="act_types">
      <span> Credit </span>
    </li>
    <li class="bor_lf_none pur_pr"> <div class="top_in_op crop_top">
                         <p> Purchase Amount </p> 
                         <h1> <input type="text" value="98,000"> </h1>
                </div></li>

 </ul>
<div class="trn_in_blk">
				<div class="blk_disb"> </div>
 <ul class="trans_inf"> 
 		<li class="date_inp"> 
 	<div class="cre_inp">
  <div class="sm_blk"> Date </div>
    <input type="text" class="form-control" value="">
 </div>
 	</li>
 	<li class="admin_bank_li"> 
 		<div class="check_wt_serc wth_225_sel"> 
              <div class="show_va"> Select Bank </div>
            <div class="selectVal">  Select Bank </div>
            <ul class="check_list"> 
              <!-- <li> <div class="form-group">
                <input type="email" checked="true" class="form-control" placeholder="Search User Bank">
              </div> </li> -->
              <li> 
        <div class="form-check">
  <input class="form-check-input" type="radio" name="trader" id="bnk1" value="Bank 1">
<label class="form-check-label" for="bnk1">
    <div class="bank_logo"> <img src="http://3.7.44.132/aquacredit/assets/images/sib_icn.png" alt="" title=""> </div>
        <div class="bank_mny"> 
            <div class="bank_bal"> ₹ 10,000 </div>
            <div class="accont_numb">xxxxxxxxx01792</div>
        </div>
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="trader" id="bnk2" value=" Bank 2">
<label class="form-check-label" for="bnk2">
  <div class="bank_logo"> <img src="http://3.7.44.132/aquacredit/assets/images/hdfc_icn.png" alt="" title=""> </div>
        <div class="bank_mny"> 
            <div class="bank_bal"> ₹ 10,000 </div>
            <div class="accont_numb">xxxxxxxxx01792</div>
        </div>
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="trader" id="bnk3" value="Bank 3">
<label class="form-check-label" for="bnk3">
         <div class="bank_logo"> <img src="http://3.7.44.132/aquacredit/assets/images/icici_icn.png" alt="" title=""> </div>
        <div class="bank_mny"> 
            <div class="bank_bal"> ₹ 10,000 </div>
            <div class="accont_numb">xxxxxxxxx01792</div>
        </div>
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="trader" id="bnk4" value="Bank 4">
<label class="form-check-label" for="bnk4">
      <div class="bank_logo"> <img src="http://3.7.44.132/aquacredit/assets/images/hdfc_icn.png" alt="" title=""> </div>
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
 	<li class="us_bn_ls"> 
 		<div class="check_wt_serc"> 
              <div class="show_va"> Company Bank </div>
            <div class="selectVal">  Company Bank </div>
            <ul class="check_list"> 
              <!-- <li> <div class="form-group">
                <input type="email" checked="true" class="form-control" placeholder="Search User Bank">
              </div> </li> -->
              <li> 
        <div class="form-check">
  <input class="form-check-input" type="radio" name="trader" id="bnk1" value="Bank 1">
<label class="form-check-label" for="bnk1">
    <div class="bank_logo"> <img src="http://3.7.44.132/aquacredit/assets/images/sib_icn.png" alt="" title=""> </div>
        <div class="bank_mny"> 
            <div class="bank_bal"> ₹ 10,000 </div>
            
        </div>
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="trader" id="bnk2" value=" Bank 2">
<label class="form-check-label" for="bnk2">
  <div class="bank_logo"> <img src="http://3.7.44.132/aquacredit/assets/images/hdfc_icn.png" alt="" title=""> </div>
        <div class="bank_mny"> 
            <div class="bank_bal"> ₹ 10,000 </div>
            
        </div>
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="trader" id="bnk3" value="Bank 3">
<label class="form-check-label" for="bnk3">
         <div class="bank_logo"> <img src="http://3.7.44.132/aquacredit/assets/images/icici_icn.png" alt="" title=""> </div>
        <div class="bank_mny"> 
            <div class="bank_bal"> ₹ 10,000 </div>
            
        </div>
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="trader" id="bnk4" value="Bank 4">
<label class="form-check-label" for="bnk4">
      <div class="bank_logo"> <img src="http://3.7.44.132/aquacredit/assets/images/hdfc_icn.png" alt="" title=""> </div>
        <div class="bank_mny"> 
            <div class="bank_bal"> ₹ 10,000 </div>
            
        </div>
  </label>
</div>
</li>
</ul>
</div>
 	</li>
 	<li> 
 	<div class="cre_inp">
  <div class="sm_blk"> Ref.Number </div>
    <input type="text" class="form-control" value="">
 </div>
 	</li>
 
 	<li class="not_li note_blk"> 
											<a href="" title="" class="ad_note" data-toggle="modal"> Note </a> 
											<div class="note_entr">
											<div class="form-group note_area"> 
											<textarea id="rece_note" name="rece_note" placeholder="Note" class="mykey" ></textarea>
											</div>
											</div>
										</li>
 </ul>
</div>
 <div class="pp_note"> 
  <textarea rows="4" placeholder="Add Note"></textarea>
</div>
	</div>
<div class="pay_blk_btn"> 

	<button class="btn btn-primary"> Pay Now </button>
</div>
		
</div>
			<div class="comp_blk"> 
				<div class="ord_comp_bl">
				<h2 class="create_hdg"> Company Name  </h2>


<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" data-toggle="tab" href="#branch1" role="tab" aria-controls="home"
      aria-selected="true">Branch -1</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#branch2" role="tab" aria-controls="profile"
      aria-selected="false">Branch -2</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#branch3" role="tab" aria-controls="contact"
      aria-selected="false">Branch -3</a>
  </li>
   <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#brnch4" role="tab" aria-controls="contact"
      aria-selected="false">Branch -4</a>
  </li>
</ul>
<div class="tab-content">
	 	<div class="order_hist tab-pane fade show active" id="branch1">
	 		<h2 class="create_hdg"> <span class="pen_st">Pending</span> &nbsp;&nbsp;<span class="gry_clr">I</span>&nbsp;&nbsp; <span class="pen_st"> Invoice not uploaded </span> </h2>
   		<table class="ord_lst mar_tp_non" cellspacing="0" cellpadding="0" border="0">
					<thead>
						<tr> <th> Product Name </th> 
							
							<th class="text_cent qty_pp"> Qty </th> 
							<th class="text_rt qty_prc"> Purchase Amount </th>
							<th class="text_rt ttl_pop"> Total </th>
						 </tr>
						<tr> 
						 	<td> <input type="text" value="Product Name -1"> </td>
						
						 	<td class="text_cent"> <input type="text" class="text_cent" value="10" name=""> </td>
						 	<td data-toggle="tooltip" data-placement="top" title="MRP:2,500" class="text_rt "> 
			<input type="text" value="2,000" class="text_rt" name=""> 
						 	 </td>
						 	<td class="text_rt"> 20,000 </td>
						 </tr> 
						<tr> 
						 	<td> <input type="text" value="Product Name -1"> </td>
						 
						 	<td class="text_cent"> <input type="text" class="text_cent" value="10" name=""> </td>
						 	<td data-toggle="tooltip" data-placement="top" title="MRP:2,500" class="text_rt"> 
			<input type="text" value="2,000" class="text_rt" name=""> 
						 	 </td>
						 	<td class="text_rt"> 20,000 </td>
						 </tr>
						 <tr> 
						 	<td> <input type="text" value="Product Name -1"> </td>
						 
						 	<td class="text_cent"> <input type="text" class="text_cent" value="10" name=""> </td>
						 	<td data-toggle="tooltip" data-placement="top" title="MRP:2,500" class="text_rt"> 
			<input type="text" value="2,000" class="text_rt" name=""> 
						 	 </td>
						 	<td class="text_rt"> 20,000 </td>
						 </tr>
						 <tr> 
						 	<td> <input type="text"> </td>
						 	<td> <input type="text"> </td>
						 	<td> <input type="text"> </td>
						 	<td> </td>
						 </tr>
						   <tr class="grd_ttl"> 
						   	<td> <a href="#" title="" class="invoice_up"> 
		<label for="fine_inv">
			<i class="fa fa-paperclip" aria-hidden="true"></i> Upload Invoice
			<input type="file" id="fine_inv">			
		</label>
	 </a> </td>
						 	<td colspan="2" class="text_rt"> <!-- <a href="#" class="fl"> Show Invoice </a> -->
						 	Total Amount </td>
						 	<td class="blue_text text_rt"> ₹60,000 </td>
						 </tr>
			<!-- 		<tr> 
							<td colspan="3" class="text_rt"> Unloading <span class="red_clr">(Not Paid)</span> </td>
							<td class="text_rt"> 1000  </td>
						</tr> -->
		<!-- 				<tr> 
							<td colspan="3" class="text_rt"> Transport <span class="red_clr">(Not Paid)</span> </td>
							<td> <input class="text_rt" type="text" value="1000" name=""> </td>
								</tr> -->
						
						<tr class="last_cld2">
								<td colspan="4" class="p_t_5"> <div class="fl_over">
			<div class="avail_bal">
			
		
<table><tbody>
	

						  <tr class="disc_blk"> 
				<td class="green_txt"> Unloading Charges <span class="red_clr"></span> </td>
				<td colspan="2" class="green_txt"> <input type="text" name="" class="text_rt" value="2000"> </td>
						 </tr>
						</tbody></table>
					</div>
					<div class="avail_bal">
						<table><tbody>
					
			 <tr class="disc_blk"> 
				<td class="green_txt"> Transport Charges <span class="red_clr"><!-- (not paid) --> </span> </td>
				<td class=""> 
					<input type="text" name="" class="text_rt" value="2000"> 
				</td>

						 </tr>
				</tbody>
			</table>
				<div class="checkbox adm_ant">
					<div class="row">
						<div class="col-md-7">
  <label><input type="checkbox" disabled value="">Use Cash Balance</label>
  <p class="bal_amn_cash"> Don't have a sufficient balance </p>
</div>	
<div class="col-md-5"> 
	<div class="top_in_op text_rt crop_top">
                         <p class="text_rt"> Admin pay </p> 
                         <h1 class="text_rt"> 4000 </h1>
                </div>
	</div>
</div>
</div> </td>

						</tr>
						
					</thead>
				</table> 

				<div class="qs_blk rem_tr_amn">
		<h2 class="create_hdg"> Select below options to pay ₹4000 to driver</h2>
		<ul class="assign_type"> 
			<li class="credit_trns lnk_typ"> 
      <img src="http://3.7.44.132/aquacredit/assets/images/credit_icn.png">
      <input type="radio" name="act_types">
      <span> UPI </span>
    </li>
		<li class="act_type lnk_typ ban_trns"> 
      <img src="http://3.7.44.132/aquacredit/assets/images/bank_tansfer.png">
      <input type="radio" name="act_types">
      <span> Bank Transfer </span>
    </li>
    <li class="cash_trns lnk_typ"> 
      <img src="http://3.7.44.132/aquacredit/assets/images/cash_icn.png">
      <input type="radio" name="act_types">
      <span> Cash </span>
    </li>
     
		</ul>
		<ul class="trans_inf"> 
			<li class="app_date"> 
		<div class="cre_inp">
  <div class="sm_blk"> Date </div>
    <input type="text" class="form-control" value="">
 </div>
	</li>
	<li class="us_bn_ls"> 
 		<div class="check_wt_serc wth_225_sel"> 
              <div class="show_va"> Select Bank </div>
            <div class="selectVal">  Select Bank </div>
            <ul class="check_list"> 
              <!-- <li> <div class="form-group">
                <input type="email" checked="true" class="form-control" placeholder="Search User Bank">
              </div> </li> -->
              <li> 
        <div class="form-check">
  <input class="form-check-input" type="radio" name="trader" id="bnk1" value="Bank 1">
<label class="form-check-label" for="bnk1">
    <div class="bank_logo"> <img src="http://3.7.44.132/aquacredit/assets/images/sib_icn.png" alt="" title=""> </div>
        <div class="bank_mny"> 
            <div class="bank_bal"> ₹ 10,000 </div>
            
        </div>
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="trader" id="bnk2" value=" Bank 2">
<label class="form-check-label" for="bnk2">
  <div class="bank_logo"> <img src="http://3.7.44.132/aquacredit/assets/images/hdfc_icn.png" alt="" title=""> </div>
        <div class="bank_mny"> 
            <div class="bank_bal"> ₹ 10,000 </div>
            
        </div>
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="trader" id="bnk3" value="Bank 3">
<label class="form-check-label" for="bnk3">
         <div class="bank_logo"> <img src="http://3.7.44.132/aquacredit/assets/images/icici_icn.png" alt="" title=""> </div>
        <div class="bank_mny"> 
            <div class="bank_bal"> ₹ 10,000 </div>
            
        </div>
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="trader" id="bnk4" value="Bank 4">
<label class="form-check-label" for="bnk4">
      <div class="bank_logo"> <img src="http://3.7.44.132/aquacredit/assets/images/hdfc_icn.png" alt="" title=""> </div>
        <div class="bank_mny"> 
            <div class="bank_bal"> ₹ 10,000 </div>
            
        </div>
  </label>
</div>
</li>
</ul>
</div>
 	</li>
	<!-- <li> 
		

		<div class="check_wt_serc val_seld"> 
              <div class="show_va"> Payment to  </div>
            <div class="selectVal">  Driver </div>
            <ul class="check_list"> 
            	
              <li> <div class="form-group">
                <input type="text" class="form-control" placeholder="Search Branch">
              </div> </li>
              <li> 
        <div class="form-check">
  <input class="form-check-input" type="checkbox" name="trader" id="drv" value="user1">
  <label class="form-check-label" for="drv">
      Driver
  </label>
  <input type="text" class="cnt" placeholder="count">
</div>
<div class="form-check">
  <input class="form-check-input" type="checkbox" name="trader" id="cmc" value=" Bank 2">
  <label class="form-check-label" for="cmc">
       Company    
  </label>
  <input type="text" class="cnt" placeholder="count">
</div>


</li>
	
</ul>
<div> </div>

</div>


	</li> -->
	<!-- <li> 
		<div class="check_wt_serc val_seld"> 
              <div class="show_va"> Payment to  </div>
            <div class="selectVal">  Net Banking </div>
            <ul class="check_list"> 
              <li> <div class="form-group">
                <input type="text" class="form-control" placeholder="Search Branch">
              </div> </li>
              <li> 
        <div class="form-check">
  <input class="form-check-input" type="checkbox" name="trader" id="ntb" value="user1">
  <label class="form-check-label" for="ntb">
      Net Banking
  </label>
  <input type="text" class="cnt" placeholder="count">
</div>
<div class="form-check">
  <input class="form-check-input" type="checkbox" name="trader" id="upi" value=" Bank 2">
  <label class="form-check-label" for="upi">
       UPI    
  </label>
  <input type="text" class="cnt" placeholder="count">
</div>


</li>
	
</ul>
<div> </div>

</div>
	</li> -->
	<li> 
		<div class="cre_inp">
  <div class="sm_blk"> Driver name </div>
    <input type="text" class="form-control" value="">
 </div>
	</li>
	<li> 
		<div class="cre_inp">
  <div class="sm_blk"> Account number </div>
    <input type="text" class="form-control" value="">
 </div>
	</li>
	<li> 
		<div class="cre_inp">
  <div class="sm_blk"> IFC Code </div>
    <input type="text" class="form-control" value="">
 </div>
	</li>
	<li> 
		<div class="cre_inp">
  <div class="sm_blk"> Reference Id </div>
    <input type="text" class="form-control" value="">
 </div>
	</li>
</ul>
	</div>


  </div>

  <div class="order_hist tab-pane fade" id="branch2">
  	<h2 class="create_hdg"> <span class="grn_clr">Confirmed</span> &nbsp;&nbsp;<span class="gry_clr">I</span>&nbsp;&nbsp; <span class="grn_clr"> Invoice uploaded </span> </h2>
  	<table class="ord_lst mar_tp_non" cellspacing="0" cellpadding="0" border="0">
					<thead>
						<tr> <th> Product Name </th> 
							
							<th class="text_cent qty_pp"> Qty </th> 
							<th class="text_rt qty_prc"> Purchase Amount </th>
							<th class="text_rt ttl_pop"> Total </th>
						 </tr>
						<tr> 
						 	<td> <input type="text" value="Product Name -1"> </td>
						
						 	<td class="text_cent"> <input type="text" class="text_cent" value="10" name=""> </td>
						 	<td data-toggle="tooltip" data-placement="top" title="MRP:2,500" class="text_rt "> 
			<input type="text" value="2,000" class="text_rt" name=""> 
						 	 </td>
						 	<td class="text_rt"> 20,000 </td>
						 </tr> 
						<tr> 
						 	<td> <input type="text" value="Product Name -1"> </td>
						 
						 	<td class="text_cent"> <input type="text" class="text_cent" value="10" name=""> </td>
						 	<td data-toggle="tooltip" data-placement="top" title="MRP:2,500" class="text_rt"> 
			<input type="text" value="2,000" class="text_rt" name=""> 
						 	 </td>
						 	<td class="text_rt"> 20,000 </td>
						 </tr>
						 <tr> 
						 	<td> <input type="text" value="Product Name -1"> </td>
						 
						 	<td class="text_cent"> <input type="text" class="text_cent" value="10" name=""> </td>
						 	<td data-toggle="tooltip" data-placement="top" title="MRP:2,500" class="text_rt"> 
			<input type="text" value="2,000" class="text_rt" name=""> 
						 	 </td>
						 	<td class="text_rt"> 20,000 </td>
						 </tr>
<tr> 
						 	<td> <input type="text"> </td>
						 	<td> <input type="text"> </td>
						 	<td> <input type="text"> </td>
						 	<td> </td>
						 </tr>

						  <tr class="grd_ttl"> 
					<td class=""> 
						 		<a href="#" class="fl"> Show Invoice </a>
						 	</td>
						 	<td colspan="2" class="grd_ttl text_rt">
						 	Total Amount </td>
						 	<td class="blue_text text_rt"> ₹60,000 </td>
						 </tr>


					
						<tr class="last_cld2">
								<td colspan="4" class="p_t_5"> <div class="fl_over">
			<div class="avail_bal">
			
		
<table><tbody>
	

						  <tr class="disc_blk"> 
				<td class="green_txt"> Unloading Charges <span class="red_clr"></span> </td>
				<td colspan="2" class="green_txt"> <input type="text" name="" class="text_rt" value="2000"> </td>
						 </tr>
						</tbody></table>
					</div>
					<div class="avail_bal">
						<table><tbody>
					
			 <tr class="disc_blk"> 
				<td class="green_txt"> Transport Charges <span class="grn_clr">(Paid) </span> </td>
				<td class=""> 
					<input type="text" name="" class="text_rt" value="2000"> 
				</td>

						 </tr>
				</tbody>
			</table>
  </div>

	</div>
	</td>
	</tr>
	</thead>
	</table>
	</div>
	</div>			
				</div>
				<div class="po_ftr">
					
			<button class="btn fr sb_btn btn-primary"> Confirm </button>
		</div>
			
</div>

			
		</div>
	</div>
</div>
<script type="text/javascript"> 
var url = '<?php echo base_url()?>';

$(document).ready(function() {



$('.tp_rt_tgl').click(function(){
	$(this).find('.ys').toggleClass('hide_blk');
	$(this).find('.no').toggleClass('hide_blk');
	$(this).toggleClass('yes_val');
	
});

$('.ad_nt').click(function(){
    $('.pp_note').toggleClass('show_blk');
}); 

$('.sec_step').click(function(){
$(this).addClass('act_tb').removeClass('dne_tb');
$('.fst_step').removeClass('act_tb').addClass('dne_tb');
$('.thrd_step, .fth_step, .fst_step').removeClass('act_tb dne_tb');
$('.bdr_blue').css('width', '75px');
$('.paid_amont_bb').hide();
$('.confrm_blk').hide();
$('.pay_sec').show();
$('.comp_blk, .ord_comp_blk').hide();
});

$('.fst_step').click(function(){
$(this).addClass('act_tb').removeClass('dne_tb');
$('.confrm_blk').show();
$('.sec_step, .fth_step, .thrd_step').removeClass('act_tb dne_tb');
$('.thrd_step').removeClass('act_tb dne_tb');
$('.bdr_blue').removeAttr('style');
$('.paid_amont_bb').hide();
$('.pay_sec').hide();
$('.comp_blk, .ord_comp_blk').hide();
});
$('.thrd_step').click(function(){
	$('.confrm_blk').hide();
$(this).addClass('act_tb').removeClass('dne_tb');
$('.fst_step, .fth_step').removeClass('act_tb').addClass('dne_tb');
$('.sec_step').removeClass('act_tb').addClass('dne_tb');
$('.bdr_blue').css('width', '150px');
// $('.paid_amont_bb').show();
$('.pay_sec, .ord_comp_blk').hide();
$('.comp_blk').show();
	
	$('.show_dtl').click(function(){
		var scrollTop = $('.brn_lst').offset().top - 50; 
			$('.comp_blk .ord_comp_bl').animate({
        	scrollTop: $(".brn_lst").offset().top - 50
   			 }, 1000);

	});

});

// $('.fth_step').click(function(){
// 	$(this).addClass('act_tb').removeClass('dne_tb');
// $('.fst_step, .sec_step, .thrd_step').removeClass('act_tb').addClass('dne_tb');
// $('.bdr_blue').css('width', '225px');
// $('.pay_sec, .comp_blk, .confrm_blk').hide();
// $('.ord_comp_blk').show();


// 	});

$('.lnk_typ.ban_trns').click(function(){
        $(this).addClass('act_type');
        $('.blk_disb').removeClass('blk_no_dis');
        $(this).siblings('.cash_trns, .lnk_typ').removeClass('act_type');
        // $('.blk_disb').addClass('blk_no_dis');
        $(this).parent().siblings('.ove_auto').find('.lon_typ').removeClass('hide_blk_anim');
    });
     $('.lnk_typ.cash_trns').click(function(){
        $(this).addClass('act_type');
        $('.blk_disb').removeClass('blk_no_dis');
        // $('.blk_disb').addClass('blk_no_dis');
        $(this).siblings('.ban_trns, .lnk_typ').removeClass('act_type');
        $(this).parent().siblings('.ove_auto').find('.lon_typ').addClass('hide_blk_anim');
    });
      $('.lnk_typ.credit_trns').click(function(){
        $(this).addClass('act_type');
        $('.blk_disb').addClass('blk_no_dis');
        $(this).siblings('.ban_trns, .cash_trns').removeClass('act_type');
         $(this).parent().siblings('.ove_auto').find('.lon_typ').addClass('hide_blk_anim');
    });

$(document).on("click", ".edt", function() {
   $('#edt_module').modal();
});

$(document).on("click", ".purc_btn", function() {
   $('#create_module').modal();
});

	$('.act_icns').popover({
    html: true,
    content: function() {
      return $('#popover-contents').html();
    }

  });



	var tables = $('#pur_lst_tbl').DataTable({
      "ordering": false,
       language: {
        searchPlaceholder: "Search Purchases Details",
        search: "",
        "dom": '<"toolbar">frtip'
      }
});

	$('#pur_lst_tbl_wrapper .dataTables_length').html('<ul class="tabs_tbl"><li class="act_tab drft_cl"> <span>Pending Requests</span> </li><li class="comp_cl"> <span>Completed Requests </span> </li></ul> <span class="tbl_btn">  </span>');

	$(".loan_btm div.toolbar").html('<b>SSS</b>');
    $('.loan_btm a.toggle-vis').on( 'click', function (e) {
        $(this).parent().toggleClass('act');
        e.preventDefault();
        var column = tables.column( $(this).attr('data-column') );
        column.visible( ! column.visible() );
    });

    $('.dataTables_paginate').html('<a href="#" title=""> Show More </a>');
    $('.ad_nt').click(function(){
    // $('.pp_note').toggleClass('show_blk');
});  
    $('.comp_cl').click(function(){
    	$(this).addClass('act_tab');
		$('.tabs_tbl').addClass('cmp_ul');
        $('.drft_cl').removeClass('act_tab');
	});

	 $('.drft_cl').click(function(){
	 	$(this).addClass('act_tab');
	 	 $('.tabs_tbl').removeClass('cmp_ul');
	 	 $('.comp_cl').removeClass('act_tab');
	 });

});
</script>
<?php require_once 'footer.php' ; ?>