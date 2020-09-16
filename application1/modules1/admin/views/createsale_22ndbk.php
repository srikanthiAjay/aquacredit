<?php require_once 'header.php' ; ?>
<link href="<?php echo base_url();?>assets/css/createsale.css" type="text/css" rel="stylesheet">
<?php require_once 'sidebar.php' ; ?>		
<div class="right_blk">
	<div class="top_ttl_blk"> 
		<!-- <span class="back_btn"><a href="<?php echo base_url();?>admin/sales" title=""><img src="<?php echo base_url();?>assets/images/back.png" alt="" title=""> </a></span> --> <span> <?php echo $page_title;?></span>
		<a href="<?php echo base_url();?>admin/sales" title="" class="fr btn btn-primary"> Show all sales  </a>
	</div>
<div class="sale_rt">
		<h2 class="create_hdg"> Transport Details </h2>
		<ul class="create_ul"> 

										<li class="create_li slc_usr">
												<div class="check_wt_serc"> 
													<div class="show_va">Select  Transport</div>
													<div class="selectVal">  Transport Type </div>
													<ul class="check_list"> 
														<li id="crop_opt_li">
															<div class="form-check">
															  <input class="form-check-input" type="radio" name="crop_opt" id="brn1" value="">
															  <label class="form-check-label" for="brn1">
															  SSA Vehicle
															  </label>
															</div>
														</li>
														<li id="crop_opt_li">
															<div class="form-check">
															  <input class="form-check-input" type="radio" name="crop_opt" id="brn2" value="">
															  <label class="form-check-label" for="brn2">
															 User Vehicle
															  </label>
															</div>
														</li>
													</ul>												
												</div>
												</li>

												<li class="create_li">
													<div class="cre_inp">
  <div class="sm_blk"> Driver Name </div>
    <input type="text" class="form-control" placeholder="" data-original-title="" title="">
 </div>
</li>
 <li class="create_li ">
 	<div class="cre_inp">
  <div class="sm_blk"> Driver Mobile </div>
    <input type="text" class="form-control" placeholder="" data-original-title="" title="">
</div>
 </li>
  <li class="create_li ">
 	<div class="cre_inp">
  <div class="sm_blk"> Vehicle Number </div>
    <input type="text" class="form-control" placeholder="" data-original-title="" title="">
</div>
 </li>

								</ul>

<h2 class="create_hdg"> Shipping Address </h2>
	<ul class="create_ul"> 
		<li class="create_li ">
 	<div class="cre_inp">
  <div class="sm_blk"> Name</div>
    <input type="text" class="form-control" placeholder="" data-original-title="" title="">
</div>
 </li>
 	<li class="create_li ">
 	<div class="cre_inp">
  <div class="sm_blk"> Mobile</div>
    <input type="text" class="form-control" placeholder="" data-original-title="" title="">
</div>
 </li>

 <li class="create_li ">
 	<div class="cre_inp">
  <div class="sm_blk"> Address</div>
    <input type="text" class="form-control" placeholder="" data-original-title="" title="">
</div>
 </li>

  <li class="create_li ">
 	<div class="cre_inp">
  <div class="sm_blk"> State</div>
    <input type="text" class="form-control" placeholder="" data-original-title="" title="">
</div>
 </li>

  <li class="create_li ">
 	<div class="cre_inp">
  <div class="sm_blk"> Pin code</div>
    <input type="text" class="form-control" placeholder="" data-original-title="" title="">
</div>
 </li>

	</ul>
	<div class="checkbox chek_bx">
 <input type="checkbox" value="" id="ch_bil"> <label for="ch_bil"> Billing and shipping address are same</label>
</div>
<div class="bil_add">
<h2 class="create_hdg"> Billing Address </h2>
	<ul class="create_ul"> 
		<li class="create_li ">
 	<div class="cre_inp">
  <div class="sm_blk"> Name</div>
    <input type="text" class="form-control" placeholder="" data-original-title="" title="">
</div>
 </li>
 	<li class="create_li ">
 	<div class="cre_inp">
  <div class="sm_blk"> Mobile</div>
    <input type="text" class="form-control" placeholder="" data-original-title="" title="">
</div>
 </li>

 <li class="create_li ">
 	<div class="cre_inp">
  <div class="sm_blk"> Address</div>
    <input type="text" class="form-control" placeholder="" data-original-title="" title="">
</div>
 </li>

  <li class="create_li ">
 	<div class="cre_inp">
  <div class="sm_blk"> State</div>
    <input type="text" class="form-control" placeholder="" data-original-title="" title="">
</div>
 </li>

  <li class="create_li ">
 	<div class="cre_inp">
  <div class="sm_blk"> Pin code</div>
    <input type="text" class="form-control" placeholder="" data-original-title="" title="">
</div>
 </li>

  <li class="create_li ">
 	<div class="cre_inp">
  <div class="sm_blk"> GST</div>
    <input type="text" class="form-control" placeholder="" data-original-title="" title="">
</div>
 </li>

	</ul>
</div>
	</div>
	<div class="sle_cr_r"> 
		<!-- <h2 class="create_hdg"> Loan Request </h2> -->
		<ul class="assign_type"> 
									<li class="act_type lnk_typ crd_sale"> 
										<img src="http://3.7.44.132/aquacredit/assets/images/credit_icn.png">
										<input type="radio" name="act_types" value="bank" checked>
										<span> Credit Sale </span>
									</li>
									<li class="cash_sale lnk_typ"> 
										<img src="http://3.7.44.132/aquacredit/assets/images/cash_icn.png">
										<input type="radio" name="act_types" value="cash">
										<span> Cash Sale </span>
									</li>

								</ul>

								<ul class="create_ul"> 

										<li class="create_li slc_usr">
												<div class="check_wt_serc"> 
													<div class="show_va">Select  Branch</div>
													<div class="selectVal">  Select  Branch </div>
													<ul class="check_list"> 
														<li id="crop_opt_li">
															<div class="form-check">
															  <input class="form-check-input" type="radio" name="crop_opt" id="brn1" value="">
															  <label class="form-check-label" for="brn1">
															  Branch -1 
															  </label>
															</div>
														</li>
														<li id="crop_opt_li">
															<div class="form-check">
															  <input class="form-check-input" type="radio" name="crop_opt" id="brn2" value="">
															  <label class="form-check-label" for="brn2">
															  Branch -1 
															  </label>
															</div>
														</li>
													</ul>												
												</div>
												</li>

												<li class="create_li">
													<div class="cre_inp">
  <div class="sm_blk"> Search User </div>
    <input type="text" class="form-control" placeholder="" data-original-title="" title="">
 </div>
 <div class="err_msg"> User Not Found </div>
</li>
 <li class="create_li ">
 	<div class="cre_inp">
  <div class="sm_blk"> Mobile </div>
    <input type="text" class="form-control" placeholder="" data-original-title="" title="">
</div>
 </li>

								</ul>
	<div class="res_tbl">
		<table class="sa_lst" cellpadding="0" cellspacing="" border="0">
			<thead>
			<tr> 
				<th> Product Name </th>
				<th class="qty txt_cnt"> Qty </th>
				<th class="mrp txt_rt"> MRP </th>
				<th class="disc txt_rt"> Discount </th>
				<th class="ttl_prc txt_rt"> Total Price </th>
			</tr>
			</thead>
			<tbody>
				<tr> 
					<td> <input type="text" value="Product Name"> </td>
					<td class="qty txt_cnt"> <input type="text" value="10"> </td>
				<td class="mrp txt_rt"> <input type="text" value="2,000"> </td>
				<td class="disc txt_rt"> <input type="text" value="20%"> </td>
				<td class="ttl_prc txt_rt"> <input type="text" value="1,800"> </td>
				</tr>
				<tr> 
					<td> <input type="text" value="Product Name"> </td>
					<td class="qty txt_cnt"> <input type="text" value="10"> </td>
				<td class="mrp txt_rt"> <input type="text" value="2,000"> </td>
				<td class="disc txt_rt"> <input type="text" value="20%"> </td>
				<td class="ttl_prc txt_rt"> <input type="text" value="1,800"> </td>
				</tr>
				<tr> 
					<td> <input type="text" value="Product Name"></td>
					<td class="qty txt_cnt"> <input type="text" value="10"> </td>
				<td class="mrp txt_rt"> <input type="text" value="2,000"> </td>
				<td class="disc txt_rt"> <input type="text" value="20%"> </td>
				<td class="ttl_prc txt_rt"> <input type="text" value="1,800"> </td>
				</tr>
				<tr> 
					<td> <input type="text" value="Product Name"> </td>
					<td class="qty txt_cnt"> <input type="text" value="10"> </td>
				<td class="mrp txt_rt"> <input type="text" value="2,000"> </td>
				<td class="disc txt_rt"> <input type="text" value="20%"> </td>
				<td class="ttl_prc txt_rt"> <input type="text" value="1,800"> </td>
				</tr>

				<tr> 
					<td> <input type="text" value=""> </td>
					<td class="qty txt_cnt"> <input type="text"> </td>
				<td class="mrp txt_rt"> <input type="text"> </td>
				<td class="disc txt_rt"> <input type="text"> </td>
				<td class="ttl_prc txt_rt"> <input type="text"> </td>
				</tr>

				<tr>
					<td colspan="4" class="txt_rt"> <b> Total Amount </b> </td>
					<td class="txt_rt ttl_prc"> <b> 6,200 </b> </td>
				</tr>

			</tbody>
		</table>
			
			<table class="sa_lst mar_sale_ttl" cellpadding="0" cellspacing="" border="0">
				<tr>
					<td class="txt_rt"> Loading Charges </td>
					<td class="txt_rt ttl_prc"> <input type="text" value="500"> </td>
				</tr>
				<tr>
					<td class="txt_rt"> Transport Charges </td>
					<td class="txt_rt ttl_prc"> <input type="text" value="1000" name=""> </td>
				</tr>
				<tr>
					<td class="txt_rt"> <b> Grand Total </b> </td>
					<td class="txt_rt ttl_prc"> <b> 8,700 </b> </td>
				</tr>
			</table>

	</div>

	<h2 class="create_hdg"> <span class="ttl">Amount received</span>
	<span class="create_li">
													<div class="cre_inp">
  <div class="sm_blk"> Received Amount </div>
    <input type="text" class="form-control" placeholder="" data-original-title="" title="">
 </div>
</span> 

	</h2>
		<ul class="assign_type"> 
									<li class="act_type lnk_typ ban_trns"> 
										<img src="http://3.7.44.132/aquacredit/assets/images/bank_tansfer.png">
										<input type="radio" name="act_types" value="bank" checked>
										<span> Bank Transfer </span>
									</li>
									<li class="cash_trns lnk_typ"> 
										<img src="http://3.7.44.132/aquacredit/assets/images/cash_icn.png">
										<input type="radio" name="act_types" value="cash">
										<span> Cash </span>
									</li>

								</ul>

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

<li class="create_li">
<div class="cre_inp">
  <div class="sm_blk"> Reference Number </div>
    <input type="text" class="form-control" placeholder="" data-original-title="" title="">
 </div>
</li>
								</ul>
<!-- <div class="show_note">
<div class="note_add"> <a href="#" title=""> Note </a> </div> 
	<textarea placeholder="Note"></textarea>
</div> -->

<div class="not_li note_blk"> 
											<a href="" title="" class="ad_note" data-toggle="modal"> Note </a> 
											<div class="note_entr">
											<div class="form-group note_area"> 
											<textarea id="rece_note" name="rece_note" placeholder="Note" class="mykey" ></textarea>
											</div>
											</div>
										</div>

		<div class="po_ftr">
					
			<button class="btn fr sb_btn btn-primary" data-toggle="modal" data-target="#view_order"> Create Order </button>
		</div>

	</div>
	
</div>


<div class="modal fade" id="view_order" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
  	 <div class="modal-content">
  	 	 <div class="modal-body">
  	 	 	<div class="pp_clss" data-dismiss="modal"> <i class="fa fa-times" aria-hidden="true"></i> </div>
  	 	 	<h2 class="create_hdg"> Order View </h2>
  	 	 	<table cellspacing="0" cellpadding="0" border="0" style="width: 100%; font-family: arial; border-top: 1px solid #ccc; padding:10px 20px;">
<tr> 
  <td style="padding-right: 10px; padding-top: 10px; padding-bottom: 10px; width: 50%;">  
    <p style="font-size: 13px; margin: 0px; padding: 0px;"> <b> Details of Receiver | Billed to:</b> </p>
  </td>
  <td style="padding-left: 10px; padding-top: 10px; padding-bottom: 10px; width: 50%;"> 
   <p style="font-size: 13px; margin: 0px; padding: 0px;"> <b>Details of Consignee | Shipped to:</b> </p>
   </td>
</tr>
<tr> <td colspan="2"> <table cellspacing="0" cellpadding="0" border="0" style="width: 100%;">
<tr>
<td style="padding:5px 10px; margin-top: 10px; border: 1px solid #000;"> 
  
 
    <p style="font-size: 13px; padding: 0px; margin: 0px 0px 5px 0px;"> Sample Name </p>
    <p style="font-size: 13px; padding: 0px; margin: 0px 0px 5px 0px;"> <b>Address:</b> Sample Address, 9876543210, Andhrapradedsh, 533001 </p>
   <p style="font-size: 13px; padding: 0px; margin: 0px 0px 5px 0px;"> <b> GST: </b>  </p>

</td>
<td style="width: 20px;"> </td>
<td style="padding:5px 10px; margin-top: 10px; border: 1px solid #000;"> 
 

    <p style="font-size: 13px; padding: 0px; margin: 0px 0px 5px 0px;"> Sample Name </p>
    <p style="font-size: 13px; padding: 0px; margin: 0px 0px 5px 0px;"> <b>Address:</b> Sample Address, 9876543210, Andhrapradedsh, 533001 </p>
   <p style="font-size: 13px; padding: 0px; margin: 0px 0px 5px 0px;"> <b> Transport: </b> </p>

</td>
</tr>
</table>
</td>
</tr>
<tr>
<td colspan="2">
<table style="width:100%; margin-top: 10px; font-size: 13px;" cellpadding="5" cellspacing="0" border="0">
  <tr>
    <th style="text-align: left; padding: 2px 5px; border-left: 1px solid #ccc; border-right: 1px solid #ccc; border-top: 1px solid #ccc; background: #f8f8f8;">Product Name</th>
    <th style="text-align: center; padding: 2px 5px; width: 80px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; background: #f8f8f8;">HSN</th> 
    <th style="text-align: center; padding: 2px 5px; width: 60px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; background: #f8f8f8;">Qty</th> 
    <th style="text-align: right; padding: 2px 5px; width: 80px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; background: #f8f8f8;">Value </th>
    <th style="text-align: right; padding: 2px 5px; width:60px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; background: #f8f8f8;">Tax </th> 
    <th style="text-align: right; padding: 2px 5px; width: 100px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; background: #f8f8f8;">Total</th>
  </tr>
  <tr>
    <td style="border-right: 1px solid #ccc; padding: 2px 5px; border-left: 1px solid #ccc;  border-top: 1px solid #ccc;">Product Name -2</td>
    <td style="text-align: center; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 80px;">&nbsp;</td> 
    <td style="text-align: center; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 60px;">10</td> 
    <td style="text-align: right; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 80px">2,000</td>
    <td style="text-align: right; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width:60px">20%</td> 
    <td style="text-align: right; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 100px;">1,800</td>
  </tr> 
  <tr>
    <td style="border-right: 1px solid #ccc; padding: 2px 5px; border-left: 1px solid #ccc;  border-top: 1px solid #ccc;">Product Name -3</td>
    <td style="text-align: center; padding:2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 80px;">&nbsp;</td> 
    <td style="text-align: center; padding:2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 60px;">10</td> 
    <td style="text-align: right; padding:2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 80px">2,000</td>
    <td style="text-align: right; padding:2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width:60px">20%</td> 
    <td style="text-align: right; padding:2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 100px;">1,800</td>
  </tr> 
  <tr>
    <td style="border-right: 1px solid #ccc; padding: 2px 5px; border-left: 1px solid #ccc;  border-top: 1px solid #ccc;">Product Name -4</td>
    <td style="text-align: center; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 80px;">&nbsp;</td> 
    <td style="text-align: center; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 60px;">10</td> 
    <td style="text-align: right; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 80px">2,000</td>
    <td style="text-align: right; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width:60px">20%</td> 
    <td style="text-align: right; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 100px;">1,800</td>
  </tr> 
    <tr>
    <td style="border-right: 1px solid #ccc; padding: 2px 5px; border-left: 1px solid #ccc; border-top: 1px solid #ccc;  ">Product Name -5</td>
    <td style="text-align: center; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 80px;">&nbsp;</td> 
    <td style="text-align: center; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 60px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; ">10</td> 
    <td style="text-align: right; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc;  width: 80px">2,000</td>
    <td style="text-align: right; padding: 2px 5px;  border-right: 1px solid #ccc; border-top: 1px solid #ccc; width:60px border-bottom: 1px solid #ccc;">20%</td> 
    <td style="text-align: right; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 100px;">1,800</td>
  </tr> 
    <tr>
    <td style="border-right: 1px solid #ccc; padding: 2px 5px; border-left: 1px solid #ccc; border-top: 1px solid #ccc;  ">Product Name -5</td>
    <td style="text-align: center; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 80px;">&nbsp;</td> 
    <td style="text-align: center; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 60px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; ">10</td> 
    <td style="text-align: right; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc;  width: 80px">2,000</td>
    <td style="text-align: right; padding: 2px 5px;  border-right: 1px solid #ccc; border-top: 1px solid #ccc; width:60px border-bottom: 1px solid #ccc;">20%</td> 
    <td style="text-align: right; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 100px;">1,800</td>
  </tr> 
    <tr>
    <td style="border-right: 1px solid #ccc; padding: 2px 5px; border-left: 1px solid #ccc; border-top: 1px solid #ccc;  ">Product Name -5</td>
    <td style="text-align: center; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 80px;">&nbsp;</td> 
    <td style="text-align: center; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 60px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; ">10</td> 
    <td style="text-align: right; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc;  width: 80px">2,000</td>
    <td style="text-align: right; padding: 2px 5px;  border-right: 1px solid #ccc; border-top: 1px solid #ccc; width:60px border-bottom: 1px solid #ccc;">20%</td> 
    <td style="text-align: right; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 100px;">1,800</td>
  </tr> 
   <tr>
    <td style="border-right: 1px solid #ccc; padding: 2px 5px; border-left: 1px solid #ccc; border-top: 1px solid #ccc;  ">Product Name -5</td>
    <td style="text-align: center; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 80px;">&nbsp;</td> 
    <td style="text-align: center; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 60px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; ">10</td> 
    <td style="text-align: right; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc;  width: 80px">2,000</td>
    <td style="text-align: right; padding: 2px 5px;  border-right: 1px solid #ccc; border-top: 1px solid #ccc; width:60px border-bottom: 1px solid #ccc;">20%</td> 
    <td style="text-align: right; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 100px;">1,800</td>
  </tr>  
    <tr>
    <td style="border-right: 1px solid #ccc; padding: 2px 5px; border-left: 1px solid #ccc; border-top: 1px solid #ccc;  ">Product Name -5</td>
    <td style="text-align: center; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 80px;">&nbsp;</td> 
    <td style="text-align: center; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 60px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; ">10</td> 
    <td style="text-align: right; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc;  width: 80px">2,000</td>
    <td style="text-align: right; padding: 2px 5px;  border-right: 1px solid #ccc; border-top: 1px solid #ccc; width:60px border-bottom: 1px solid #ccc;">20%</td> 
    <td style="text-align: right; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 100px;">1,800</td>
  </tr> 
   <tr>
    <td style="border-right: 1px solid #ccc; padding: 2px 5px; border-left: 1px solid #ccc; border-top: 1px solid #ccc;  ">Product Name -5</td>
    <td style="text-align: center; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 80px;">&nbsp;</td> 
    <td style="text-align: center; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 60px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; ">10</td> 
    <td style="text-align: right; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc;  width: 80px">2,000</td>
    <td style="text-align: right; padding: 2px 5px;  border-right: 1px solid #ccc; border-top: 1px solid #ccc; width:60px border-bottom: 1px solid #ccc;">20%</td> 
    <td style="text-align: right; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 100px;">1,800</td>
  </tr> 
  <tr>
    <td style="border-right: 1px solid #ccc; padding: 2px 5px; border-left: 1px solid #ccc; border-top: 1px solid #ccc; border-bottom: 1px solid #ccc;  ">Product Name -5</td>
    <td style="text-align: center; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc;  border-bottom: 1px solid #ccc;width: 80px;">&nbsp;</td> 
    <td style="text-align: center; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 60px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; border-bottom: 1px solid #ccc;">10</td> 
    <td style="text-align: right; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; border-bottom: 1px solid #ccc; width: 80px">2,000</td>
    <td style="text-align: right; padding: 2px 5px; border-bottom: 1px solid #ccc; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width:60px border-bottom: 1px solid #ccc;">20%</td> 
    <td style="text-align: right; padding: 2px 5px; border-right: 1px solid #ccc; border-top: 1px solid #ccc; width: 100px; border-bottom: 1px solid #ccc;">1,800</td>
  </tr> 
    <tr> 
    <td colspan="5" style="border-right: 1px solid #ccc; padding: 2px 5px; text-align: right; color: green;  border-left: 1px solid #ccc; border-bottom: 1px solid #ccc;">Promotional Offers </td>
    <td style="border-right: 1px solid #ccc; color: green; padding: 2px 5px; text-align: right;   border-bottom: 1px solid #ccc;">-0.00</td>
  </tr>
   <tr> 

    <td colspan="5" style="border-right: 1px solid #ccc; padding: 2px 5px; border-bottom: 1px solid #ccc; text-align: right;   border-left: 1px solid #ccc;">CGST </td>
    <td style="border-right: 1px solid #ccc; padding: 2px 5px; border-top: 1px solid #ccc; border-bottom: 1px solid #ccc; text-align: right;   border-top: 0px solid #ccc;">1000</td>
  </tr>
  <tr> 
      
    <td colspan="5" style="border-right: 1px solid #ccc;  padding: 2px 5px; text-align: right;   border-left: 1px solid #ccc;">SGST </td>
    <td style="border-right: 1px solid #ccc;  text-align: right;  ">1000</td>
  </tr>

  <tr> 
    <td colspan="5" style="border-right: 1px solid #ccc; padding: 5px 5px; text-align: right; border-bottom: 1px solid #ccc;  border-left: 1px solid #ccc; border-top: 1px solid #ccc;"><b>Total Amount</b></td>
    <td style="border-right: 1px solid #ccc; padding: 5px 5px; text-align: right; border-bottom: 1px solid #ccc;  border-top: 1px solid #ccc;"><b>20,000</b></td>
  </tr>
<tr> <td colspan="5" style="padding: 2px;"> &nbsp; </td> </tr>

 

  <tr> 
         <td colspan="3" style="text-align: left;  padding: 2px 5px; border-left: 1px solid #ccc; border-top: 1px solid #ccc;"> <p style="margin: 0px; padding: 0px; font-size: 11px;"> Above invoice inclusive of aqua cash redemption </p> </td>
    <td colspan="2" style="border-right: 1px solid #ccc; padding: 2px 5px; text-align: right;   border-left: 1px solid #ccc; border-top: 1px solid #ccc;">Loading Charges </td>
    <td style="border-right: 1px solid #ccc; padding: 2px 5px; text-align: right;   border-top: 1px solid #ccc;">500</td>
  </tr>

  <tr> 
      <td colspan="3" style="text-align: left; padding: 2px 5px; border-left: 1px solid #ccc;border-top: 1px solid #ccc; border-bottom: 1px solid #ccc; "> <p style="margin: 0px; padding: 0px; font-size: 11px;"> This is computer generated Invoice, no signature is required </p>  </td>
    <td colspan="2" style="border-right: 1px solid #ccc; padding: 2px 5px; border-bottom: 1px solid #ccc; text-align: right;   border-left: 1px solid #ccc; border-top: 1px solid #ccc;">Transport Charges </td>
    <td style="border-right: 1px solid #ccc; padding: 2px 5px; border-bottom: 1px solid #ccc; text-align: right;   border-top: 1px solid #ccc;">1000</td>
  </tr>
 

  <tr> 
      <td colspan="3"> </td>
    <td colspan="2" style="font-size: 16px; padding-top: 10px; padding-bottom: 10px; text-align: right;"><b>Grand Total </b></td>
    <td style="font-size: 16px; padding-top: 10px; padding-bottom: 10px; text-align: right;"><b>21,500</b></td>
  </tr>
  <tr> 
      <td colspan="3" style="border-top: 1px solid #ccc; padding-top: 10px;">   </td>
      <td colspan="3" style="border-top: 1px solid #ccc; padding-top: 10px; text-align: right;"> <button class="btn btn-primary"> Submit </button>  </td>
  </tr>
</table>
</td>
</tr>
</table>
  	 	 </div>
  	 </div>
  </div>
</div>

<script type="text/javascript">
var url = '<?php echo base_url()?>';

$(document).ready(function(){

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


     $('.lnk_typ.crd_sale').click(function(){
        $(this).addClass('act_type');
        $('.blk_disb').removeClass('blk_no_dis');
        $(this).siblings('.cash_trns, .lnk_typ').removeClass('act_type');
        // $('.blk_disb').addClass('blk_no_dis');
        $(this).parent().siblings('.ove_auto').find('.lon_typ').removeClass('hide_blk_anim');
    });
     $('.lnk_typ.cash_sale').click(function(){
        $(this).addClass('act_type');
        $('.blk_disb').removeClass('blk_no_dis');
        // $('.blk_disb').addClass('blk_no_dis');
        $(this).siblings('.ban_trns, .lnk_typ').removeClass('act_type');
        $(this).parent().siblings('.ove_auto').find('.lon_typ').addClass('hide_blk_anim');
    });
		
});
</script>
<?php require_once 'footer.php' ; ?>