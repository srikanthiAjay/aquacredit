<?php require_once 'header.php' ; ?>
<link href="<?php echo base_url();?>assets/css/createreturn.css" type="text/css" rel="stylesheet">
<?php require_once 'sidebar.php' ; ?>		
<div class="right_blk">
	<div class="top_ttl_blk"> 
		<!-- <span class="back_btn"><a href="<?php echo base_url();?>admin/sales" title=""><img src="<?php echo base_url();?>assets/images/back.png" alt="" title=""> </a></span> --> <span> <?php echo $page_title;?></span>
		<a href="<?php echo base_url();?>admin/returns" title="" class="fr btn btn-primary"> Show all Returns </a>
	</div>
	<div class="sale_rt"> 
	<h2 class="create_hdg"> Recent Returns </span></h2>

<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#f_far" role="tab" aria-controls="home"
      aria-selected="true">From Farmer</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#t_com" role="tab" aria-controls="profile"
      aria-selected="false">To Company</a>
  </li>
</ul>
<div class="tab-content">
	<div id="f_far" class="tab-pane fade show active">
			<div class="top_in_op crop_top">
                             
                               <h1> Product Name <span> (10) </span> </h1>
                                 <p> 12-May-2020 </p> 
               </div>
               <div class="top_in_op crop_top">
                               
                               <h1> Product Name <span> (10) </span> </h1>
                               <p> 12-May-2020 </p> 
               </div>
               <div class="top_in_op crop_top">
                              
                               <h1> Product Name <span> (10) </span> </h1>
                                <p> 12-May-2020 </p> 
               </div>
               <div class="top_in_op crop_top">
                                
                               <h1> Product Name <span> (10) </span> </h1>
                               <p> 12-May-2020 </p>
               </div>
               <div class="top_in_op crop_top">
                              
                               <h1> Product Name <span> (10) </span> </h1>
                                <p> 12-May-2020 </p> 
               </div>
</div>
               <div id="t_com" class="tab-pane fade">
			<div class="top_in_op crop_top">
                             
                               <h1> Product Name <span> (10) </span> </h1>
                                 <p> 12-Jun-2020 </p> 
               </div>
               <div class="top_in_op crop_top">
                               
                               <h1> Product Name <span> (10) </span> </h1>
                               <p> 12-Jun-2020 </p> 
               </div>
               <div class="top_in_op crop_top">
                              
                               <h1> Product Name <span> (10) </span> </h1>
                                <p> 12-Jun-2020 </p> 
               </div>
               <div class="top_in_op crop_top">
                                
                               <h1> Product Name <span> (10) </span> </h1>
                               <p> 12-Jun-2020 </p>
               </div>
               <div class="top_in_op crop_top">
                              
                               <h1> Product Name <span> (10) </span> </h1>
                                <p> 12-Jun-2020 </p> 
               </div>
           </div>
       </div>
	</div>
	<div class="sle_cr_r"> 
		<!-- <h2 class="create_hdg"> Loan Request </h2> -->
		<ul class="assign_type"> 
									<li class="act_type lnk_typ frm_farm"> 
										<img src="http://3.7.44.132/aquacredit/assets/images/credit_icn.png">
										<input type="radio" name="act_types" value="bank" checked>
										<span> From Farmers </span>
									</li>
									<li class="lnk_typ to_cmp"> 
										<img src="http://3.7.44.132/aquacredit/assets/images/cash_icn.png">
										<input type="radio" name="act_types" value="cash">
										<span> To Company </span>
									</li>

								</ul>
<div class="from_farmer">
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

<li class="create_li slc_usr">
												<div class="check_wt_serc"> 
													<div class="show_va">Select  Crop</div>
													<div class="selectVal">  Select  Crop </div>
													<ul class="check_list"> 
														<li id="crop_opt_li">
															<div class="form-check">
															  <input class="form-check-input" type="radio" name="crop_opt" id="us1" value="">
															  <label class="form-check-label" for="us1">
															  Crop -1 
															  </label>
															</div>
														</li>
														<li id="crop_opt_li">
															<div class="form-check">
															  <input class="form-check-input" type="radio" name="crop_opt" id="us2" value="">
															  <label class="form-check-label" for="us2">
															  Crop -2 
															  </label>
															</div>
														</li>
													</ul>												
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
				<th class="disc"> Discount </th>
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
					<td> <input type="text" value="Product Name"> </td>
					<td class="qty txt_cnt"> <input type="text" value="10"> </td>
				<td class="mrp txt_rt"> <input type="text" value="2,000"> </td>
				<td class="txt_rt"> <input type="text" value="20%"> </td>
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
					<td> <input type="text"> </td>
					<td class="qty txt_cnt"> <input type="text"> </td>
				<td class="mrp txt_rt"> <input type="text"> </td>
				<td class=""> <input type="text"> </td>
				<td class="ttl_prc txt_rt">  </td>
				</tr>

				<tr>
					<td colspan="4" class="txt_rt"> <b>Grand Total</b> </td>
					<td class="txt_rt"> <b>8,700</b> </td>
				</tr>

			</tbody>
		</table>
			

	</div>

	<!-- <h2 class="create_hdg"> <span class="ttl">Amount Received</span>
	<span class="create_li">
													<div class="cre_inp">
  <div class="sm_blk"> Received Amount </div>
    <input type="text" class="form-control" placeholder="" data-original-title="" title="">
 </div>
</span> 

	</h2> -->
	<h2 class="create_hdg" style="margin-bottom: 15px;"> Select below options to settle ₹8,700 to user </h2>
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

									<li class="crdt_trns lnk_typ"> 
										<img src="http://3.7.44.132/aquacredit/assets/images/credit_icn.png">
										<input type="radio" name="act_types" value="cash">
										<span> Credit </span>
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
 		<div class="check_wt_serc wth_225_sel"> 
              <div class="show_va"> Select Bank </div>
            <div class="selectVal">  Select Bank </div>
            <ul class="check_list"> 
  
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

 	<li class="admin_bank_li"> 
 		<div class="check_wt_serc wth_225_sel"> 
              <div class="show_va"> Select User Bank </div>
            <div class="selectVal">  Select User Bank </div>
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
  <div class="sm_blk"> Paid Amount </div>
    <input type="text" class="form-control" placeholder="" data-original-title="" title="">
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

</div>

<div class="to_comp">
	<ul class="create_ul"> 

				<li class="create_li slc_usr">
												<div class="check_wt_serc"> 
													<div class="show_va">Select branch</div>
													<div class="selectVal">  Select branch </div>
													<ul class="check_list"> 
														<li id="crop_opt_li">
															<div class="form-check">
															  <input class="form-check-input" type="radio" name="crop_opt" id="brn1" value="">
															  <label class="form-check-label" for="brn1">
															  Branch -1 
															  </label>
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
												

<li class="create_li slc_usr">
												<div class="check_wt_serc"> 
													<div class="show_va">Select  Company</div>
													<div class="selectVal">  Select  Company </div>
													<ul class="check_list"> 
														<li id="crop_opt_li">
															<div class="form-check">
															  <input class="form-check-input" type="radio" name="crop_opt" id="us1" value="">
															  <label class="form-check-label" for="us1">
															  Company -1 
															  </label>
															</div>
														</li>
														<li id="crop_opt_li">
															<div class="form-check">
															  <input class="form-check-input" type="radio" name="crop_opt" id="us2" value="">
															  <label class="form-check-label" for="us2">
															  Company -2 
															  </label>
															</div>
														</li>
													</ul>												
												</div>
												</li>
								</ul>

								<div class="res_tbl">
		<table class="sa_lst" cellpadding="0" cellspacing="" border="0">
			<thead>
			<tr> 
				<th> Product Name </th>
				<th class="qty txt_cnt"> Qty </th>
				<th class="mrp txt_rt"> Purchased Amount </th>
			</tr>
			</thead>
			<tbody>
				<tr> 
			<td> <input type="text" value="Product Name"> </td>
			<td class="qty txt_cnt"> <input type="text" value="10"> </td>
			<td class="mrp txt_rt"> <input type="text" value="2,000"> </td>
				</tr>
				<tr> 
		<td> <input type="text" value="Product Name"> </td>
		<td class="qty txt_cnt"> <input type="text" value="10"> </td>
		<td class="mrp txt_rt"> <input type="text" value="2,000"> </td>
				</tr>
				<tr> 
			<td> <input type="text" value="Product Name"> </td>
			<td class="qty txt_cnt"> <input type="text" value="10"> </td>
			<td class="mrp txt_rt"> <input type="text" value="2,000"> </td>
				</tr>
				<tr> 
			<td> <input type="text" value="Product Name"> </td>
			<td class="qty txt_cnt"> <input type="text" value="10"> </td>
			<td class="mrp txt_rt"> <input type="text" value="2,000"> </td>
				</tr>

				<tr> 
				<td> <input type="text"> </td>
				<td class="qty txt_cnt"> <input type="text"> </td>
				<td class="pur_amnt txt_rt"> <input type="text"> </td>

				</tr>

					<tr>
					<td colspan="2" class="txt_rt"> Loading Charges </td>
					<td class="txt_rt"> <input type="text" value="500"> </td>
				</tr>
				<tr>
					<td colspan="2" class="txt_rt"> Transport Charges </td>
					<td class="txt_rt"> <input type="text" value="1,000"> </td>
				</tr>

				<tr>
					<td colspan="2" class="txt_rt"> <b>Grand Total</b> </td>
					<td class="txt_rt"> <b>8,600</b> </td>
				</tr>

			</tbody>
		</table>
		<h2 class="create_hdg" style="margin-top: 20px; text-align: right;">₹8,600 will be added to company balance </h2>
		<div class="show_note">
<div class="note_add"> <a href="#" title=""> Note </a> </div> 
	<textarea placeholder="Note"></textarea>
</div>
	</div>
</div>
		<div class="po_ftr">
					
			<button class="btn fr sb_btn btn-primary"> Return </button>
		</div>

	</div>
	
</div>
<script type="text/javascript">
var url = '<?php echo base_url()?>';

$(document).ready(function(){

	$('.lnk_typ.frm_farm').click(function(){
        $(this).addClass('act_type');
        $('.blk_disb').removeClass('blk_no_dis');
        $(this).siblings('.cash_trns, .lnk_typ').removeClass('act_type');
        // $('.blk_disb').addClass('blk_no_dis');
        $(this).parent().siblings('.ove_auto').find('.lon_typ').removeClass('hide_blk_anim');
        $('.from_farmer').show();
        $('.to_comp').hide();
    });
     $('.lnk_typ.to_cmp').click(function(){
        $(this).addClass('act_type');
        $('.blk_disb').removeClass('blk_no_dis');
        // $('.blk_disb').addClass('blk_no_dis');
        $(this).siblings('.ban_trns, .lnk_typ').removeClass('act_type');
        $(this).parent().siblings('.ove_auto').find('.lon_typ').addClass('hide_blk_anim');
         $('.from_farmer').hide();
         $('.to_comp').show();
    });


     $('.lnk_typ.crdt_trns').click(function(){
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

      $('.lnk_typ.ban_trns').click(function(){
        $(this).addClass('act_type');
        $('.blk_disb').removeClass('blk_no_dis');
        // $('.blk_disb').addClass('blk_no_dis');
        $(this).siblings('.ban_trns, .lnk_typ').removeClass('act_type');
        $(this).parent().siblings('.ove_auto').find('.lon_typ').addClass('hide_blk_anim');
    });
		
});
</script>
<?php require_once 'footer.php' ; ?>