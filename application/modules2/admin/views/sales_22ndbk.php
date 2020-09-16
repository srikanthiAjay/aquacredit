<?php require_once 'header.php' ; ?>
<link href="<?php echo base_url();?>assets/css/sales.css" type="text/css" rel="stylesheet">
<script src='https://kit.fontawesome.com/a076d05399.js'></script> 
<?php require_once 'sidebar.php' ; ?>		
<div class="right_blk"> 
	<div class="top_ttl_blk"> <span class="back_btn">
		<!-- <a href="<?php echo base_url();?>admin/sales/create" title=""><img src="<?php echo base_url();?>assets/images/back.png" alt="" title=""> </a> --></span> 
		
		<span> Sales </span>
		
	</div>
<div class="padding_10">
<div class="trd_cr_r">
	<div class="card_view"> 
		<ul class="trd_anl"> 
			<li class="bor_lf_none"> 
				 		<div class="top_in_op crop_top">
                               <p> Cash Orders </p> 
                               <h1>   ₹10,00,00   </h1>
                                    </div>
				</li>
				<li class="bor_lf_none"> 
				 		<div class="top_in_op crop_top">
                               <p> Credit Orders </p> 
                               <h1>   ₹10,00,00   </h1>
                                    </div>
				</li>
	


		
	<!-- 	<li class="fr"> <button class="btn purc_btn btn-primary"> Create Order</button> </li> -->
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
	 						 <th> User Name </th>
	 						 <!-- <th> Crop </th> -->
	 						 <th class="godown"> Branch </th>
	 						 <th class="ord_type"> Status
                  <span class="sts_pp">
           <i class="fa fa-filter" aria-hidden="true" style="font-size: 9px;"></i>   
                 </span>
                  <div class="sts_fil_blk"> 

        
<div class="trd_lst">
    <div class="form-check chek_bx">
      <input class="form-check-input" type="checkbox" name="optradio" value="" id="sta1">
  <label class="form-check-label" for="sta1">
    Cancel
  </label>
</div>
 <div class="form-check chek_bx">
  <input class="form-check-input" type="checkbox" name="optradio" value="" id="sta2">
  <label class="form-check-label" for="sta2">
    Completed
  </label>
</div>

</div>
       </div>
              </th>

               <th class="ord_ttl text_rt"> Order Total </th>
                <th class="act_ms"> Actions </th>
	 					</tr>
	 				</thead>
	 				<tbody>
	 					<tr>
	 						<td class="id_td"> 
	 					<a href="#" title=""> SAL1589951524 </a>	</td>
	 					<td class="date"> 12-May-2020 </td>
	 					<td> User Name </td>
	 					<!-- <td> Kakinada </td> -->
	 					<td> Branch Name </td>
	 					<td class="ord_type"> Cancel </td>
	 					<td class="text_rt"> 1,000000 </td>
	 					 <td class="act_ms"> 
                  <i class="fa fa-ellipsis-v act_icns" data-toggle="popover" data-placement="left" tabindex="0" data-trigger="focus" data-toggle="popover" aria-hidden="true"></i>
                </td>
	 					</tr>
	 					<tr>
	 						<td class="id_td"> 
	 					<a href="#" title=""> SAL1589951524 </a>	</td>
	 					<td class="date"> 12-May-2020 </td>
	 					<td> User Name </td>
	 					<!-- <td> Kakinada </td> -->
	 					<td> Branch Name </td>
	 					<td class=""> Completed </td>
	 					<td class="text_rt"> 1,000000 </td>
	 					 <td class="act_ms"> 
                  <i class="fa fa-ellipsis-v act_icns" data-toggle="popover" data-placement="left" tabindex="0" data-trigger="focus" data-toggle="popover" aria-hidden="true"></i>
                </td>
	 					</tr>
	 					<tr>
	 						<td class="id_td"> 
	 					<a href="#" title=""> SAL1589951524 </a>	</td>
	 					<td class="date"> 12-May-2020 </td>
	 					<td> User Name </td>
	 					<!-- <td> Kakinada </td> -->
	 					<td> Branch Name </td>
	 					<td class=""> Cancel </td>
	 					<td class="text_rt"> 1,000000 </td>
	 					 <td class="act_ms"> 
                  <i class="fa fa-ellipsis-v act_icns" data-toggle="popover" data-placement="left" tabindex="0" data-trigger="focus" data-toggle="popover" aria-hidden="true"></i>
                </td>
	 					</tr>
	 					<tr>
	 						<td class="id_td"> 
	 					<a href="#" title=""> SAL1589951524 </a>	</td>
	 					<td class="date"> 12-May-2020 </td>
	 					<td> User Name </td>
	 					<!-- <td> Kakinada </td> -->
	 					<td> Branch Name </td>
	 					<td class=""> Cancel </td>
	 					<td class="text_rt"> 1,000000 </td>
	 					 <td class="act_ms"> 
                  <i class="fa fa-ellipsis-v act_icns" data-toggle="popover" data-placement="left" tabindex="0" data-trigger="focus" data-toggle="popover" aria-hidden="true"></i>
                </td>
	 					</tr>
	 					<tr>
	 						<td class="id_td"> 
	 					<a href="#" title=""> SAL1589951524 </a>	</td>
	 					<td class="date"> 12-May-2020 </td>
	 					<td> User Name </td>
	 					<!-- <td> Kakinada </td> -->
	 					<td> Branch Name </td>
	 					<td class=""> Cancel </td>
	 					<td class="text_rt"> 1,000000 </td>
	 					 <td class="act_ms"> 
                  <i class="fa fa-ellipsis-v act_icns" data-toggle="popover" data-placement="left" tabindex="0" data-trigger="focus" data-toggle="popover" aria-hidden="true"></i>
                </td>
	 					</tr>
	 					<tr>
	 						<td class="id_td"> 
	 					<a href="#" title=""> SAL1589951524 </a>	</td>
	 					<td class="date"> 12-May-2020 </td>
	 					<td> User Name </td>
	 					<!-- <td> Kakinada </td> -->
	 					<td> Branch Name </td>
	 					<td class=""> Cancel </td>
	 					<td class="text_rt"> 1,000000 </td>
	 					 <td class="act_ms"> 
                  <i class="fa fa-ellipsis-v act_icns" data-toggle="popover" data-placement="left" tabindex="0" data-trigger="focus" data-toggle="popover" aria-hidden="true"></i>
                </td>
	 					</tr>
	 					<tr>
	 						<td class="id_td"> 
	 					<a href="#" title=""> SAL1589951524 </a>	</td>
	 					<td class="date"> 12-May-2020 </td>
	 					<td> User Name </td>
	 					<!-- <td> Kakinada </td> -->
	 					<td> Branch Name </td>
	 					<td class=""> Cancel </td>
	 					<td class="text_rt"> 1,000000 </td>
	 					 <td class="act_ms"> 
                  <i class="fa fa-ellipsis-v act_icns" data-toggle="popover" data-placement="left" tabindex="0" data-trigger="focus" data-toggle="popover" aria-hidden="true"></i>
                </td>
	 					</tr>
	 					<tr>
	 						<td class="id_td"> 
	 					<a href="#" title=""> SAL1589951524 </a>	</td>
	 					<td class="date"> 12-May-2020 </td>
	 					<td> User Name </td>
	 					<!-- <td> Kakinada </td> -->
	 					<td class="godown"> Branch Name </td>
	 					<td class=""> Cancel </td>
	 					<td class="text_rt"> 1,000000 </td>
	 					 <td class="act_ms"> 
                  <i class="fa fa-ellipsis-v act_icns" data-toggle="popover" data-placement="left" tabindex="0" data-trigger="focus" data-toggle="popover" aria-hidden="true"></i>
                </td>
	 					</tr>
	 					<tr>
	 						<td class="id_td"> 
	 					<a href="#" title=""> SAL1589951524 </a>	</td>
	 					<td class="date"> 12-May-2020 </td>
	 					<td> User Name </td>
	 					<!-- <td> Kakinada </td> -->
	 					<td class="godown"> Branch Name </td>
	 					<td class=""> Cancel </td>
	 					<td class="text_rt"> 1,000000 </td>
	 					 <td class="act_ms"> 
                  <i class="fa fa-ellipsis-v act_icns" data-toggle="popover" data-placement="left" tabindex="0" data-trigger="focus" data-toggle="popover" aria-hidden="true"></i>
                </td>
	 					</tr>
	 					<tr>
	 						<td class="id_td"> 
	 					<a href="#" title=""> SAL1589951524 </a>	</td>
	 					<td class="date"> 12-May-2020 </td>
	 					<td> User Name </td>
	 					<!-- <td> Kakinada </td> -->
	 					<td class="godown"> Branch Name </td>
	 					<td class=""> Cancel </td>
	 					<td class="ord_ttl text_rt"> 1,000000 </td>
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
        searchPlaceholder: "Search Sale Details",
        search: "",
        "dom": '<"toolbar">frtip'
      }
	});
	//$(".view").click(function(){
	$(".view").on('click',function(){
   	alert('dfdfgdfg');
    });

	// $('#pur_lst_tbl_wrapper .dataTables_length').html('<h2 class="create_hdg lng_hdg"> Sales List </h2>');

	$('#pur_lst_tbl_wrapper .dataTables_length').html('<ul class="tabs_tbl"><li class="act_tab drft_cl"> <span>Cash Sale</span> </li><li class="comp_cl"> <span>Credit Sale </span> </li></ul> <span class="tbl_btn">  </span>');

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

 <div id="popover-contents" style="display: none">
  <div class="custom-popover">
  <ul class="list-group">
    <li class="list-group-item edt green_txt">Edit</li>
    <li class="list-group-item view green_txt">View</li>
    <li class="list-group-item  reject_loan del">Cancel</li>
  </ul>
</div>
</div>
<?php require_once 'footer.php' ; ?>