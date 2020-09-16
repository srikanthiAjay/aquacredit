<?php require_once 'header.php' ; ?>
<link href="<?php echo base_url();?>assets/css/returns.css" type="text/css" rel="stylesheet">
<script src='https://kit.fontawesome.com/a076d05399.js'></script> 
<?php require_once 'sidebar.php' ; ?>		
<div class="right_blk"> 
	<div class="top_ttl_blk"> <span class="back_btn">
		<!-- <a href="<?php echo base_url();?>admin/returns/create" title=""><img src="<?php echo base_url();?>assets/images/back.png" alt="" title=""> </a> --></span> <span> Returns </span>
		
	</div>
<div class="padding_10">
<div class="trd_cr_r">
	<div class="card_view"> 
		<ul class="trd_anl"> 
			<li class="bor_lf_none"> 
				 		<div class="top_in_op crop_top">
                               <p> From Farmers </p> 
                               <h1>  ₹10,00,00  </h1>
                                    </div>
				</li>
				<li class=""> 
				 		<div class="top_in_op crop_top">
                               <p> To Comapny </p> 
                               <h1>  ₹10,00,00  </h1>
                                    </div>
				</li>
	


		
		<!-- <li class="fr"> <button class="btn purc_btn btn-primary"> Return Request</button> </li> -->
		</ul>
	</div>
	<div class="list_blk"> 
	 	<div class="list_tbl">
	 		<div class="res_tbl"> 
	 			<table id="pur_lst_tbl" class="table table-striped table-bordered" style="width:100%">
	 				<thead>
	 					<tr> 
	 						 <th class="id_td"> Id </th>
	 						 <th class="date"> Date 
	 						 	<span class="sts_pp"><i class="fa fa-filter" aria-hidden="true" style="font-size: 9px;"></i>   
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
	 						
	 						 <th> Name </th>
	 	 <th class="prd_cnt"> Branch Name </th>	 						

               <th class="ord_ttl text_rt"> Return Amount </th>
                <th class="act_ms"> Actions </th>
	 					</tr>
	 				</thead>
	 				<tbody>
	 						<tr>
	 						<td class="id_td"> 
	 					<a href="#" title=""> RET1589951524 </a>	</td>
	 					<td> 12-May-2020  </td>
	 					<!-- <td> To Company </td> -->
	 					<td> Company Name </td>
	 					<td class="godown"> Branch Name </td>
	 	
	 					<td class="ord_ttl text_rt"> 10,000 </td>
	 					 <td class="act_ms"> 
                  <i class="fa fa-ellipsis-v act_icns" data-toggle="popover" data-placement="left" tabindex="0" data-trigger="focus" data-toggle="popover" aria-hidden="true"></i>
                </td>
	 					</tr>

	 					<tr>
	 						<td class="id_td"> 
	 					<a href="#" title=""> RET1589951524 </a>	</td>
	 					<td> 12-May-2020  </td>
	 					<!-- <td> From Farmer </td> -->
	 					<td> Farmer Name </td>
	 					<td class="godown"> Branch Name </td>
	 	
	 					<td class="ord_ttl text_rt"> 10,000 </td>
	 					 <td class="act_ms"> 
                  <i class="fa fa-ellipsis-v act_icns" data-toggle="popover" data-placement="left" tabindex="0" data-trigger="focus" data-toggle="popover" aria-hidden="true"></i>
                </td>
	 					</tr>

	 					<tr>
	 						<td class="id_td"> 
	 					<a href="#" title=""> RET1589951524 </a>	</td>
	 					<td> 12-May-2020  </td>
	 					<!-- <td> From Farmer </td> -->
	 					<td> Farmer Name </td>
	 					<td class="godown"> Branch Name </td>
	 	
	 					<td class="ord_ttl text_rt"> 10,000 </td>
	 					 <td class="act_ms"> 
                  <i class="fa fa-ellipsis-v act_icns" data-toggle="popover" data-placement="left" tabindex="0" data-trigger="focus" data-toggle="popover" aria-hidden="true"></i>
                </td>
	 					</tr>

	 					<tr>
	 						<td class="id_td"> 
	 					<a href="#" title=""> RET1589951524 </a>	</td>
	 					<td> 12-May-2020  </td>
	 					<!-- <td> From Farmer </td> -->
	 					<td> Farmer Name </td>
	 					<td class="godown"> Branch Name </td>
	 	
	 					<td class="ord_ttl text_rt"> 10,000 </td>
	 					 <td class="act_ms"> 
                  <i class="fa fa-ellipsis-v act_icns" data-toggle="popover" data-placement="left" tabindex="0" data-trigger="focus" data-toggle="popover" aria-hidden="true"></i>
                </td>
	 					</tr>

	 					<tr>
	 						<td class="id_td"> 
	 					<a href="#" title=""> RET1589951524 </a>	</td>
	 					<td> 12-May-2020  </td>
	 					<!-- <td> From Farmer </td> -->
	 					<td> Farmer Name </td>
	 					<td class="godown"> Branch Name </td>
	 	
	 					<td class="ord_ttl text_rt"> 10,000 </td>
	 					 <td class="act_ms"> 
                  <i class="fa fa-ellipsis-v act_icns" data-toggle="popover" data-placement="left" tabindex="0" data-trigger="focus" data-toggle="popover" aria-hidden="true"></i>
                </td>
	 					</tr>

	 					<tr>
	 						<td class="id_td"> 
	 					<a href="#" title=""> RET1589951524 </a>	</td>
	 					<td> 12-May-2020  </td>
	 					<!-- <td> From Farmer </td> -->
	 					<td> Farmer Name </td>
	 					<td class="godown"> Branch Name </td>
	 	
	 					<td class="ord_ttl text_rt"> 10,000 </td>
	 					 <td class="act_ms"> 
                  <i class="fa fa-ellipsis-v act_icns" data-toggle="popover" data-placement="left" tabindex="0" data-trigger="focus" data-toggle="popover" aria-hidden="true"></i>
                </td>
	 					</tr>

	 					<tr>
	 						<td class="id_td"> 
	 					<a href="#" title=""> RET1589951524 </a>	</td>
	 					<td> 12-May-2020  </td>
	 					<!-- <td> From Farmer </td> -->
	 					<td> Farmer Name </td>
	 					<td class="godown"> Branch Name </td>
	 	
	 					<td class="ord_ttl text_rt"> 10,000 </td>
	 					 <td class="act_ms"> 
                  <i class="fa fa-ellipsis-v act_icns" data-toggle="popover" data-placement="left" tabindex="0" data-trigger="focus" data-toggle="popover" aria-hidden="true"></i>
                </td>
	 					</tr>

	 					<tr>
	 						<td class="id_td"> 
	 					<a href="#" title=""> RET1589951524 </a>	</td>
	 					<td> 12-May-2020  </td>
	 					<!-- <td> From Farmer </td> -->
	 					<td> Farmer Name </td>
	 					<td class="godown"> Branch Name </td>
	 	
	 					<td class="ord_ttl text_rt"> 10,000 </td>
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

<script type="text/javascript"> 
var url = '<?php echo base_url()?>';
$(document).ready(function() {
	var tables = $('#pur_lst_tbl').DataTable({
      "ordering": false,
       language: {
        searchPlaceholder: "Search Return Details",
        search: "",
        "dom": '<"toolbar">frtip'
      }
});


	$('#pur_lst_tbl_wrapper .dataTables_length').html('<ul class="tabs_tbl"><li class="act_tab drft_cl"> <span>From Farmer</span> </li><li class="comp_cl"> <span> To Company </span> </li></ul> <span class="tbl_btn">  </span>');

	// $('#pur_lst_tbl_wrapper .dataTables_length').html('<h2 class="create_hdg lng_hdg"> Returns List </h2>');

	$(".loan_btm div.toolbar").html('<b>SSS</b>');
    $('.loan_btm a.toggle-vis').on( 'click', function (e) {
        $(this).parent().toggleClass('act');
        e.preventDefault();
        var column = tables.column( $(this).attr('data-column') );
        column.visible( ! column.visible() );
    });

    // $('.dataTables_paginate').html('<a href="#" title=""> Show More </a>');
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
	 $('.act_icns').popover({
    html: true,
    content: function() {
      return $('#popover-contents').html();
    }

  });
// 	 $(document).on("click", ".edt", function() {
//    $('#edt_module').modal();
// });

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

});
</script>
<div id="edt_module" role="dialog" class="modal fade">
<div class="modal-dialog">
	<div class="modal-content">
		<div class="pp_clss" data-dismiss="modal"> <i class="fa fa-times" aria-hidden="true"></i> </div>
		<h2 class="create_hdg"> Return Request </h2>
		<ul class="assign_type"> 
					<!-- <div class="ds_as_type show_blk"></div>    -->
					<li class="ban_trns lnk_typ">      
						<img src="http://3.7.44.132/aquacredit/assets/images/bank_tansfer.png">
						<input type="radio" name="act_types_edit" value="cash" checked="">
						<span> Bank Transfer </span>
					</li>
					<li class="cash_trns lnk_typ act_type"> 
						<img src="http://3.7.44.132/aquacredit/assets/images/cash_icn.png">
						<input type="radio" name="act_types_edit" value="cash">
						<span> Cash </span>
					</li>

				</ul>

<ul class="trans_inf ll_inp">
				<li> 
					<div class="check_wt_serc act_v"> 
              <div class="show_va"> Select Branch </div>
            <div class="selectVal">  Select Branch </div>
            <ul class="check_list show_chk"> 
              
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
              <div class="show_va"> Select User </div>
            <div class="selectVal">  Select User </div>
            <ul class="check_list"> 
             
              <li> 
        <div class="form-check">
  <input class="form-check-input" type="radio" name="trader" id="br1" value="Brand">
  <label class="form-check-label" for="br1">
  User1
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="trader" id="br2" value="Brand2">
  <label class="form-check-label" for="br2">
   User2
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="trader" id="br3" value="Brand3">
  <label class="form-check-label" for="br3">
    User3
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="trader" id="br4" value="Brand4">
  <label class="form-check-label" for="br4">
    User4
  </label>
</div>
              </li>


            </ul>
          </div>
				</li>
				<li> 
					<div class="check_wt_serc"> 
              <div class="show_va"> Select User </div>
            <div class="selectVal">  Select User </div>
            <ul class="check_list"> 
            
              <li> 
        <div class="form-check">
  <input class="form-check-input" type="radio" name="trader" id="cbr1" value="Brand">
  <label class="form-check-label" for="cbr1">
  Crop1
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="trader" id="cbr2" value="Brand2">
  <label class="form-check-label" for="cbr2">
   Crop2
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="trader" id="br3" value="Brand3">
  <label class="form-check-label" for="cbr3">
    Crop3
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="trader" id="cbr4" value="Brand4">
  <label class="form-check-label" for="cbr4">
    Crop4
  </label>
</div>
              </li>


            </ul>
          </div>
				</li>
				<li> 
					<div class="check_wt_serc"> 
              <div class="show_va"> Select Products </div>
            <div class="selectVal">  Select Products </div>
            <ul class="check_list"> 
           
              <li> 
        <div class="form-check">
  <input class="form-check-input" type="radio" name="trader" id="pbr1" value="Brand">
  <label class="form-check-label" for="pbr1">
  Products1
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="trader" id="pbr2" value="Brand2">
  <label class="form-check-label" for="pbr2">
   Products2
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="trader" id="pbr3" value="Brand3">
  <label class="form-check-label" for="pbr3">
    Products3
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="trader" id="pbr4" value="Brand4">
  <label class="form-check-label" for="pbr4">
    Products4
  </label>
</div>
              </li>


            </ul>
          </div>
				</li>
				<li class="fr ad_mr"> <a href="#" class="ad_nt"> + Add Note </a> </li>
			</ul>
				<table class="ord_lst mar_tp_non" cellspacing="0" cellpadding="0" border="0">
					<thead>
<tr> 						<th> Product Name </th> 							
							<th class="text_cent qty_pp"> Qty </th> 
							<th class="text_rt qty_prc"> Mrp </th>
							<th class="text_rt qty_prc"> Discount </th>
							<th class="text_rt ttl_pop"> Total Price </th>
						 </tr>
					</thead>
					<tbody>
						<tr> 
							<td> Product Name </td>
							<td class="text_cent qty_pp"> 100 </td> 
							<td class="text_rt qty_prc"> 3000 </td>
							<td class="text_rt qty_prc"> 10% </td>
							<td class="text_rt ttl_pop"> 270,000‬ </td>
						</tr>
						<tr> 
							<td> Product Name </td>
							<td class="text_cent qty_pp"> 100 </td> 
							<td class="text_rt qty_prc"> 3000 </td>
							<td class="text_rt qty_prc"> 10% </td>
							<td class="text_rt ttl_pop"> 270,000‬ </td>
						</tr>
						<tr> 
							<td> Product Name </td>
							<td class="text_cent qty_pp"> 100 </td> 
							<td class="text_rt qty_prc"> 3000 </td>
							<td class="text_rt qty_prc"> 10% </td>
							<td class="text_rt ttl_pop"> 270,000‬ </td>
						</tr>
						<tr> 
							<td> Product Name </td>
							<td class="text_cent qty_pp"> 100 </td> 
							<td class="text_rt qty_prc"> 3000 </td>
							<td class="text_rt qty_prc"> 10% </td>
							<td class="text_rt ttl_pop"> 270,000‬ </td>
						</tr>
						<tr> 
							<td> Product Name </td>
							<td class="text_cent qty_pp"> 100 </td> 
							<td class="text_rt qty_prc"> 3000 </td>
							<td class="text_rt qty_prc"> 10% </td>
							<td class="text_rt ttl_pop"> 270,000‬ </td>
						</tr>	
					</tbody>
				</table>
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
<?php require_once 'footer.php' ; ?>