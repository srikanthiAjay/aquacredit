<?php require_once 'header.php';?>
<style type="text/css">
  .disabledbutton {
    pointer-events: none;
    opacity: 0.4;
}
</style>
<link href="<?php echo base_url(); ?>assets/css/sales.css" type="text/css" rel="stylesheet">
<script src='https://kit.fontawesome.com/a076d05399.js'></script>
<?php require_once 'sidebar.php';?>
<div class="right_blk">
	<div class="top_ttl_blk"><!--  <span class="back_btn">
		<a href="<?php echo base_url(); ?>admin/sales/create" title=""><img src="<?php echo base_url(); ?>assets/images/back.png" alt="" title=""> </a></span> --> <span> Sales </span>

	</div>
<div class="padding_10">
<div class="trd_cr_r">
	<div class="card_view">
		<ul class="trd_anl">
			<li class="bor_lf_none">
				 		<div class="top_in_op crop_top">
                               <p> Cash Orders </p>
                               <h1 id="cashorders">   ₹0   </h1>
                                    </div>
				</li>
				<li class="bor_lf_none">
				 		<div class="top_in_op crop_top">
                               <p> Credit Orders </p>
                               <h1 id="creditorders">   ₹0   </h1>
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
               <input type="hidden" name="saletype" id="saletype">
						                <span class="sts_pp">
                      <i class="fa fa-filter" aria-hidden="true" style="font-size: 9px;"></i>
                  </span>
                  <div class="sts_fil_blk">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="month_opt" value="" id="all" checked />
                        <label class="form-check-label" for="this_mnt">All</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="month_opt" value="m" id="this_mnt" />
                        <label class="form-check-label" for="this_mnt">This Month</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="month_opt" value="1m" id="last_mont">
                        <label class="form-check-label" for="last_mont">Last Month</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="month_opt" value="3m" id="last_3mont">
                        <label class="form-check-label" for="last_3mont">Last 3 Months</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="month_opt" value="6m" id="last_6mon">
                        <label class="form-check-label" for="last_6mon">Last 6 Months</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="month_opt" value="1y" id="one_year">
                        <label class="form-check-label" for="one_year">1 Year</label>
                      </div>

                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="month_opt" value="custom" id="choos_date">
                        <label class="form-check-label" for="choos_date">Choose Date</label>
                      </div>

                      <div class="form-group cdate" style="display:none;">
                        <input type="text" id="from_date" name="from_date" class="form-control" placeholder="From date" readonly />
                        <input type="text" id="to_date" name="to_date" class="form-control" placeholder="To date" readonly />
                        <button class="btn btn-primary" id="custom_date">Search</button>
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
                                      <input class="form-check-input" type="checkbox" name="status_opt" value="1" id="sta1">
                                  <label class="form-check-label" for="sta1">
                                    Cancel
                                  </label>
                                </div>
                                <div class="form-check chek_bx">
                                  <input class="form-check-input" type="checkbox" name="status_opt" value="0" id="sta2">
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


	 				</tbody>
	 			</table>
	 			<input type="hidden" id="hid_lid" name="hid_lid" calss="edtval" />
	 		</div>
	 	</div>
	 </div>
</div>
</div>


</div>
<div id="popover-content" style="display: none">
  <div class="custom-popover">
      <ul class="list-group">
        <li class="list-group-item edt editval green_txt" >Edit</li>
         <li class="list-group-item view viewval green_txt">View</li>
        <li class="list-group-item del delval">Cancel</li>

      </ul>
  </div>
</div>
<div id="popover-contents" style="display: none">
  <div class="custom-popover">
      <ul class="list-group">
        <li class="list-group-item view viewval green_txt">View</li>
      </ul>
  </div>
</div>
<script type="text/javascript">
var url = '<?php echo base_url(); ?>';
$(document).ready(function() {

	$("#from_date").datepicker({
		dateFormat: 'dd-M-yy',
		//defaultDate: "+1w",
		changeMonth: true,
		changeYear: true,
		//minDate: dateToday,
		numberOfMonths: 1,
		onSelect: function (selected) {
			str = selected.split("-").join(" ");
			var dt = new Date(str);
			dt.setDate(dt.getDate() + 1);
			$("#to_date").datepicker("option", "minDate", dt);
			$(this).parent().parent('.sts_fil_blk').addClass('show');
			$(this).parent().parent().parent().children('.sts_pp').addClass('ad_tgl');
		}
	});

    $("#to_date").datepicker({
		dateFormat: 'dd-M-yy',
		//defaultDate: "+1w",
		changeMonth: true,
		changeYear: true,
		//minDate: dateToday,
			numberOfMonths: 1,
			onSelect: function (selected) {
				str = selected.split("-").join(" ");
				var dt = new Date(str);
				dt.setDate(dt.getDate() - 1);
				$("#from_date").datepicker("option", "maxDate", dt);
				$(this).parent().parent('.sts_fil_blk').addClass('show');
				$(this).parent().parent().parent().children('.sts_pp').addClass('ad_tgl');
			}
    });


	var table = $('#pur_lst_tbl').DataTable({
		'ordering': false,
		'processing': true,
			'serverSide': true,
			'serverMethod': 'post',
			language: {
			searchPlaceholder: "Search sale details",
			search: "",
			"dom": '<"toolbar">frtip'
			},
			"columnDefs": [/* {
		}, */

		{ className: "id_td", "targets": 0 },
		{ className: "date", "targets": 1 },
		{ className: "godown", "targets": 3 },
		{ className: "text_rt", "targets": 5 },
		{ className: "act_ms", "targets": 6 },
		],
        "order": [[ 1, 'desc' ]],
        'ajax': {
           'url':url+'api/sales/getsales',
           'data': function(data){
              var multi_status = [];
              $.each($("input[name='status_opt']:checked"), function(){
                multi_status.push($(this).val());
              });

              var month_opt = $("input[name='month_opt']:checked").val();
              var from_date = $("#from_date").val();
              var to_date = $("#to_date").val();
              var saletype = $("#saletype").val();
              var status_opt = multi_status;

              data.month_opt = month_opt;
              data.from_date = from_date;
              data.to_date = to_date;
              data.status_opt = status_opt;
              data.saletype = saletype
           },
           "dataSrc": function (json) {

            $("#creditorders").html('₹'+addCommas(json.creditsale));
            $("#cashorders").html('₹'+addCommas(json.cashsale));


              setInterval(function(){
                  $('.act_icn').popover({
                  html: true,
                  content: function() {
                    return $('#popover-content').html();
                  }
                });
              }, 2000);

              setInterval(function(){
                  $('.act_icns').popover({
                  html: true,
                  content: function() {
                    return $('#popover-contents').html();
                  }
                });
              }, 2000);

            return json.data;
          }
        }


    });

    $("input[name='month_opt']").on('click',function() {
		var date_val = $("input[name='month_opt']:checked").val();
		if(date_val == "custom"){ $(".cdate").show(); }
        else{ $(".cdate").hide(); table.draw(); }
	});


  	$("input[name='status_opt']").on('click',function() {
  		table.draw();
  	});

  	$("#custom_date").click(function(){
    	table.draw();
    });
    $("#from_date").change(function(e){
     	e.stopPropagation()
    });




	$('#pur_lst_tbl_wrapper .dataTables_length').html('<ul class="tabs_tbl"><li class="act_tab drft_cl"> <span>Cash Sale</span> </li><li class="comp_cl"> <span>Credit Sale </span> </li></ul> <span class="tbl_btn">  </span>');

	$(".loan_btm div.toolbar").html('<b>SSS</b>');
    $('.loan_btm a.toggle-vis').on( 'click', function (e) {
        $(this).parent().toggleClass('act');
        e.preventDefault();
        var column = tables.column( $(this).attr('data-column') );
        column.visible( ! column.visible() );
    });

    //$('.dataTables_paginate').html('<a href="#" title=""> Show More </a>');
    $('.ad_nt').click(function(){
    // $('.pp_note').toggleClass('show_blk');
	});

	$('.comp_cl').click(function(){
      	$('#saletype').val(0);
    	$(this).addClass('act_tab');
		$('.tabs_tbl').addClass('cmp_ul');
        $('.drft_cl').removeClass('act_tab');
		table.draw();
	});

	$('.drft_cl').click(function(){
      	$('#saletype').val(1);
		$(this).addClass('act_tab');
		$('.tabs_tbl').removeClass('cmp_ul');
		$('.comp_cl').removeClass('act_tab');
		table.draw();
	});
	$('.act_icns').popover({
		html: true,
		content: function() {
			return $('#popover-contents').html();
		}
  	});
 	$(document).on("click", ".viewval", function() {
 		var delval = $("#hid_lid").val();
   		location.replace(url+'admin/sales/view/'+delval);
 	});
 	$(document).on("click", ".editval", function() {
   		var delval = $("#hid_lid").val();
   		location.replace(url+'admin/sales/edit/'+delval);
 	});
 	/*cancel sale*/
 	$(document).on("click", ".delval", function() {
   		var delval = $("#hid_lid").val();
      if (confirm('Are you sure you want to cancel')) {
   		$.ajax({
            url: url+"api/sales/ordercancel",
            data: {tid:delval},
            type:'POST',
            datatype:'json',
            success : function(response){

              res= JSON.parse(response);

              if(res.status == 'success')
              {
                new PNotify({
                  title: 'Success',
                  text: "Order cancelled successfully!",
                  type: 'success',
                  shadow: true
                });

               table.ajax.reload();
              }
            }
        });
     }
 	});
 	/*cancel sale*/

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
function clickaction(id,sta,est)
{
  $("#hid_lid").val(id);
  if(est==1)
  {
     $(".edt").addClass("disabledbutton");
  }
  else
  {
     $(".edt").removeClass("disabledbutton");
  }
}

</script>


<?php require_once 'footer.php';?>