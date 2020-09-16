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
									   <h1>  <span class="tot_farmer_amt">₹0 </span></h1>
											</div>
						</li>
						<li class=""> 
								<div class="top_in_op crop_top">
									   <p> To Comapny </p> 
									   <h1>  <span class="tot_company_amt">₹0</span>  </h1>
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
										<span class="pull-right" id="reportrange">
											<i class="fa fa-filter"  aria-hidden="true" style="font-size: 9px;"></i> 
											<span></span>
										</span>
										<input type="hidden" id="date_val" name="date_val" />
									</th>
									<th> Name </th>
									 <th> Type 
									<span class="sts_pp">
										<i class="fa fa-filter" aria-hidden="true" style="font-size: 9px;"></i>
									</span>
									<div class="sts_fil_blk">
										<div class="trd_lst">
											<div class="form-check chek_bx">
												<input class="form-check-input" type="checkbox" name="utype_opt" value="FARMER" id="sta1">
												<label class="form-check-label" for="sta1">
													Farmer 
												</label>
											</div>											
											<div class="form-check chek_bx">
												<input class="form-check-input" type="checkbox" name="utype_opt" value="DEALER" id="sta2">
												<label class="form-check-label" for="sta2">
													Dealer
												</label>
											</div>
											<div class="form-check chek_bx">
												<input class="form-check-input" type="checkbox" name="utype_opt" value="GUEST" id="sta5">
												<label class="form-check-label" for="sta5">
													Guest User
												</label>
											</div>
										</div>
									</div>
								</th>
									<th class="prd_cnt"> Branch Name </th>	 						

									<th class="ord_ttl text_rt"> Return Amount </th>
									<th class="act_ms"> Actions </th>
								</tr>
							</thead>
							<tbody>
									
							</tbody>
						</table>
						<input type="hidden" id="hid_tabval" name="hid_tabval" value="0" />
						<input type="hidden" id="hid_rid" name="hid_rid" />
						<input type="hidden" id="hid_branch" name="hid_branch"  />
						<input type="hidden" id="hid_crop" name="hid_crop" />
					</div>
				</div>
			 </div>
		</div>
	</div>	
</div>

<div id="popover-content" style="display: none">
	<div class="custom-popover">
		<ul class="list-group">
			<li class="list-group-item view viewval ">View</li>
			<li class="list-group-item edt editval green_txt">Edit</li>
			<li class="list-group-item  reject_loan del"><a href="javascript:void();" class="delete_brand" id="delete_id"> Delete </a></li>
		</ul>
	</div>
</div>

<div class="modal" id="delete_brand">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<h1> Are You Sure ! </h1>
				<p> Do you want to delete this Record ? </p>
			</div>
			<div class="modal_footer">
				<button type="button" class="btn btn-primary del_yes" data-dismiss="modal">Yes</button>
			<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>			
			</div>
		</div>
	</div>
</div>
<script type="text/javascript"> 
var url = '<?php echo base_url()?>';
function edit_returns(rid,bid,cid)
{
	//alert(rid);
	$("#hid_rid").val(rid);
	$("#hid_branch").val(bid);
	$("#hid_crop").val(cid);
}
$(document).ready(function() {		
	
	function cb(start, end) {
		
		//$("#reportrange").show();
				
		//$('#reportrange span').html(start.format('D/MMM/YYYY') + ' - ' + end.format('D/MMM/YYYY'));
		$('#date_val').val(start.format('D/MMM/YYYY') + ' - ' + end.format('D/MMM/YYYY'));
		
		if($('#date_val').val() == "Invalid date - Invalid date")
		{
			//$('#reportrange span').html('');
			$('#date_val').val('');
		}else{
			//$('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
			//$('#reportrange span').html(start.format('D/MMM/YYYY') + ' - ' + end.format('D/MMM/YYYY'));	
			$('#date_val').val(start.format('D/MMM/YYYY') + ' - ' + end.format('D/MMM/YYYY'));
		}		
    }
	
		
    $('#reportrange').daterangepicker({
		//timePicker: true,
        /* startDate: null,
        endDate: null, */
		opens: 'left',
		drops: 'down',
		showDropdowns: true,		
		locale: {
		  format: 'D-MMM-YYYY',
		  customRangeLabel: 'Date Range'
		},
		parentEl: '.dateEle',
        ranges: {
			'Till Date': [],
			/* 'Today': [moment(), moment()],
			'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
			'Last 7 Days': [moment().subtract(6, 'days'), moment()],
			'Last 30 Days': [moment().subtract(29, 'days'), moment()], */
			'This Month': [moment().startOf('month'), moment().endOf('month')],
			'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
			'Last 6 Months': [moment().subtract(6, 'month').startOf('month'), moment().subtract(6, 'month').endOf('month')],
			"Last Year": [moment().subtract(1, "y").startOf("year"), moment().subtract(1, "y").endOf("year")]
        }
    }, cb);
	
	//Data Tables
	var tables = $('#pur_lst_tbl').DataTable({
		'processing': true,
		'serverSide': true,
		'serverMethod': 'post',
		"ordering": false,
		   language: {
			searchPlaceholder: "Search Return Details",
			search: "",
			"dom": '<"toolbar">frtip'
			},
		"columnDefs": [
			{ className: "id_td", "targets": 0 },
			{ className: "date", "targets": 1 },
			{ className: "godown", "targets": 3 },
			{ className: "godown", "targets": 4 },
			{ className: "ord_ttl text_rt", "targets": 5 },
			{ className: "act_ms", "targets": 6 }
		  ],
		'ajax': {
		   'url':url+'api/returns/get_returns',
		   'data': function(data){
			  // Read values
				var multi_status = [];
				$.each($("input[name='utype_opt']:checked"), function(){
					multi_status.push($(this).val());
				});
				var reportrange = $('#date_val').val();
				var tabval = $("#hid_tabval").val();
				var utype_opt = multi_status;
				
				// Append to data				
				data.reportrange = reportrange;
				data.tabval = tabval;
				data.utype_opt = utype_opt;
				
			},
		   "dataSrc": function (json) {	

				$(".tot_farmer_amt").html('₹'+addCommas(json.tot_farmer_amt));
				$(".tot_company_amt").html('₹'+addCommas(json.tot_company_amt));

				setInterval(function(){ 
					  $('.act_icn').popover({
					  html: true,
					  content: function() {
						return $('#popover-content').html();
					  }
					}); 
				  }, 2000);
			  
				if(json.data.length == 0){ $("#reportrange").hide(); $(".sts_pp").hide(); }
				return json.data;
				
			}		
			
		}
	});
	
	$("input[name='utype_opt']").on('click',function() {
		/* $(this).parent('.chek_bx').toggleClass('checkd');
		$(this).parent('.chek_bx').toggleClass('checkd'); */
		tables.draw();
	});

	$('#pur_lst_tbl_wrapper .dataTables_length').html('<ul class="tabs_tbl"><li class="act_tab drft_cl"> <span>From Farmer</span> </li><li class="comp_cl"> <span> To Company </span> </li></ul> <span class="tbl_btn">  </span>');
	
	
	
	$(".ranges ul li ").mouseup(function(){
		
		$(this).parent().children().removeClass('active');
		$(this).addClass('active');
		$('.drp-selected').css('font-weight','bold');
		if($(this).text() == "Till Date")
		{
			setTimeout(function(){ 
				$("#date_val").val('Till Date');
			}, 500);
			
		}
		
		if($(this).text() != "Date Range")
		{
			
			setTimeout(function(){ 
				tables.draw();
			}, 500);
		}
		
		/* $('.mydateDiv').text($('.drp-selected').text());
		$('.drp-selected').hide();
		$('.mydateDiv').addClass('drp-selected'); */
		
	});
	$(".applyBtn").on("click",function(){
		
		setTimeout(function(){ 
			tables.draw();			
		}, 500);
		
	});

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
		$("#hid_tabval").val(1);
    	$(this).addClass('act_tab');
		$('.tabs_tbl').addClass('cmp_ul');
        $('.drft_cl').removeClass('act_tab');
		$('.sts_pp').hide();
        //$('.sts_fil_blk').hide();
		tables.columns.adjust().draw( false );
		tables.ajax.reload();
	});

	 $('.drft_cl').click(function(){
		$("#hid_tabval").val(0);
	 	$(this).addClass('act_tab');
	 	$('.tabs_tbl').removeClass('cmp_ul');
	 	$('.comp_cl').removeClass('act_tab');
		$('.sts_pp').show();
        //$('.sts_fil_blk').show();
		tables.columns.adjust().draw( false );
		tables.ajax.reload();
	 });
	 
	 
	/*  $('.act_icn').popover({
		html: true,
		content: function() {
		  return $('#popover-content').html();
		}

	  }); */
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
	
	$(document).on("click", ".viewval", function() {
 		var delval = $("#hid_rid").val();
   		location.replace(url+'admin/returns/view/'+delval);
 	});
 	$(document).on("click", ".editval", function() {
   		var delval = $("#hid_rid").val();
   		location.replace(url+'admin/returns/edit/'+delval);
 	});
	
	$(document).on("click", ".reject_loan",function(){	
		$('#delete_brand').modal('show');
	});
	
	
	$(".del_yes").click(function(){

		var delval = $("#hid_rid").val();
		var branch = $("#hid_branch").val();
		var crop = $("#hid_crop").val();
		var tabval = $("#hid_tabval").val();
		$.ajax({
			url: url+"api/returns/returns_delete",
			data: {rid:delval,bid:branch,cid:crop,tabval:tabval},
			type:'POST',
			datatype:'json',
			success : function(response){

				res= JSON.parse(response);

				if(res.status == 'success')
				{
					tables.ajax.reload();
					new PNotify({
						title: 'Success',
						text: "Returns deleted successfully!",
						type: 'success',
						shadow: true
					});
					
				}
			}
		});
	});

});
</script>
<?php require_once 'footer.php' ; ?>