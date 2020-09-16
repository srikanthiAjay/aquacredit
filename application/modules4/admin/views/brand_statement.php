<?php require_once 'header.php';?>
<link href="<?php echo base_url(); ?>assets/css/user_detials.css" type="text/css" rel="stylesheet">
<style>
#usr_lst_tbl .sts_fil_blk.show {display:none !important;}
#usr_lst_tbl_wrapper .mCSB_container {background:#fff!important;border-bottom:5px solid #F0F1F5;}
#usr_lst_tbl td.trans_detail_tr{padding: 15px !important;background: #ccc;}
#usr_lst_tbl .trans_detail tr:hover {background:#fff !important;}
</style>
<script src='https://kit.fontawesome.com/a076d05399.js'></script>
<?php require_once 'sidebar.php';?>
<div class="right_blk">
	<div class="top_ttl_blk">
	<span class="cname"> </span>
		<!-- <a href="<?php echo base_url(); ?>api/traders/previewAgentTransaction/<?php echo $trader["td_id"];?>" target="_blank" title="" class="btn ed_usr btn-primary fr"> Print </a> -->
	</div>

	<div class="sale_rt">
		<div class="det_view">
			<input type="checkbox">
			<p> Detailed View</p>

				<div class="swith_blk">
					<!-- <span> No </span> -->
				</div>
		</div>
		<div class="dvder"> </div>

		<div class="main_anal">
			<h2 class="create_hdg"> Analytics  </h2>
			<ul class="anl_tcs">
				<li class="bor_lf_none">
					<div class="top_in_op crop_top">
						<p>Purchased Amount</p>
						<h1 class="pamt"> ₹0 </h1>
					</div>
				</li>
				<li class="bor_lf_none">
					<div class="top_in_op crop_top">
						<p>Received Goods</p>
						<h1 class="gamt"> ₹0 </h1>
					</div>
				</li>
				<li class="bor_lf_none">
					<div class="top_in_op crop_top">
						<p> Sales profit </p>
						<h1> N/A </h1>
					</div>
				</li>				
			</ul>
		</div>
	</div>
	<div class="sle_cr_r">
		<div class="urs_dt">
			<div class="">
					<div class="res_tbl">
						<table id="usr_lst_tbl" class="table table-striped table-bordered" style="width:100%">
							<thead>
								<tr>
									<th class="date">  Date
									<span class="pull-right" id="reportrange">
											<i class="fa fa-filter"  aria-hidden="true" style="font-size: 9px;"></i> 
											<span></span>
										</span>	
										<input type="hidden" id="date_val" name="date_val" />
									</th>
									<th class="details"> Detail
										<span class="sts_pp">
											<i class="fa fa-filter" aria-hidden="true" style="font-size: 9px;"></i>
										</span>
										<div class="sts_fil_blk rad_btns">
											<label class="form-check-label radio_blk checkd" for="All">
												<input class="form-check-input" type="radio" name="trans_type" value="" id="All">
												All
											</label>
											<label class="form-check-label radio_blk" for="PURCHASE">
												<input class="form-check-input" type="radio" name="trans_type" value="PURCHASE" id="PURCHASE">
												PURCHASE
											</label>

											<label class="form-check-label radio_blk" for="RETURN">
												<input class="form-check-input" type="radio" name="trans_type" value="RETURN" id="RETURN">
												RETURN
											</label>
										</div>
									</th>
									<!-- <th width="150" class="txt_rt in_td"> In </th> -->
									<th width="150" class="txt_rt out_td"> Amount </th>
								</tr>
							</thead>

							<tbody>
							</tbody>
							<tfoot>
								<tr>
									<td class="opic_non date"> &nbsp;   </td>
									<td class="txt_rt"> Total </td>
									<td class="txt_rt in_td trans_total"> </td>

								</tr>
								<tr>
									<td class="opic_non date"> &nbsp;  </td>
									<td class="txt_rt type"> Opening Balance</td>
									<td class="txt_rt open_bal">  </td>
								</tr>
								<!-- <tr>
									<td class="opic_non date"> &nbsp;  </td>
									<td class="txt_rt type"> <b>Previous Balance <span class="grn_clr"></span></b> </td>
									<td class="grn_clr txt_rt"> <b>+100</b> </td>
								</tr>-->
								<tr>
									<td class="opic_non date"> &nbsp;  </td>
									<td class="txt_rt grd_ttl"> <b>Grand Total <span class="grn_clr"></span></b> </td>
									<td class="grd_ttl txt_rt grand_total"> <b></b> </td>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
			<input type="hidden" id="hid_bid" name="hid_bid" value="" />
			<!-- <div class="btm_btn"> <button class="btn btn-primary"> Settle Amount </button> </div> -->
		</div>
	</div>
<script type="text/javascript">

var url = '<?php echo base_url() ?>';
$(document).ready(function() {
	
	var cur_url = window.location.href;
	//var url_params = cur_url.replace(url+"admin/brands/statement1/", "");
	var url_params = cur_url.replace(url+"admin/companies/statement1/", "");
	var arr=url_params.split('/');
	//var last_param = cur_url.substring(cur_url.lastIndexOf('/') + 1);
	var company_id = arr[0];
	
	$.ajax({
		url: url+'api/Brands/index/'+company_id,
		type: "GET",
		dataType: "json",
		async: false,
		success: function(res){
			//console.log(res.data.brand_name);
			$(".cname").html('<b>'+res.data.brand_name+' Statement</b>');
		}
	});	
	
	//console.log(company_id);
	$("#hid_bid").val(company_id);
	var h = $(window).height();
	var min_h = h-257;
	var tables = $('#usr_lst_tbl').DataTable({
		'ordering': false,
		'processing': true,
		'serverSide': true,
    	'serverMethod': 'post',
		language: {
			searchPlaceholder: "Search Transaction Details",
			search: "",
			"dom": '<"toolbar">frtip'
		},
		"columns": [
			{className: "date","width": "20%"},
			{className: "", "width": "20%"},
			{className: "txt_rt out_td","width": "60%"} //grn_clr txt_red out_td
		],
		"scrollY":  min_h,
		"scrollCollapse": true,
		'ajax': {
			'url':url+'api/brands/transactions',
			'data': function(data){
				var reportrange = $('#date_val').val();
				data.reportrange = reportrange;
				data.company_id = company_id;
				data.trans_type = $("input[name='trans_type']:checked").val();
				data.month_opt = $("input[name='month_opt']:checked").val();
			},
			"dataSrc": function (json) {
				total_trans_amount = json.total_trans_amount;
				if(json.open_balance == null){ json.open_balance = 0; }
				$(".open_bal").html('₹'+currency_format(json.open_balance,2));
				grand_total = parseFloat(total_trans_amount) - parseFloat(json.open_balance);
				if(json.balance_type == "IN")
				{
					$(".open_bal").html('₹'+currency_format(json.open_balance,2));
					grand_total = parseFloat(total_trans_amount) + parseFloat(json.open_balance);
				}else if(json.balance_type == "OUT"){
					$(".open_bal").html('₹-'+currency_format(json.open_balance,2));
					grand_total = parseFloat(total_trans_amount) - parseFloat(json.open_balance);
				}
				$(".trans_total").html('₹'+currency_format(total_trans_amount,2));
				
				$(".grand_total").html('₹'+currency_format(grand_total,2));		
				$(".pamt").html('₹'+currency_format(json.purchased_amt,2));		
				$(".gamt").html('₹'+currency_format(json.goods_amt,2));		
				return json.data;
			}
		},
	});
	$('.dataTables_scrollBody').css('height', min_h);
	$('#usr_lst_tbl_wrapper .dataTables_length').html('<h2 class="create_hdg lng_hdg"> </h2>');
	// $('#usr_lst_tbl_wrapper .dataTables_length').html('<ul class="tabs_tbl"><li class="act_tab drft_cl"> <span>Unsettled</span> </li><li class="comp_cl"> <span>Settled </span> </li></ul> <span class="tbl_btn">  </span>');
	// <a href="#" class="appr_all"> Approve All </a>
	
	$("input[name='trans_type'], input[name='month_opt']").on('click',function() {
		tables.ajax.reload();
	});

	function cb(start, end) {
		$('#date_val').val(start.format('D/MMM/YYYY') + ' - ' + end.format('D/MMM/YYYY'));		
		if($('#date_val').val() == "Invalid date - Invalid date")
		{
			$('#date_val').val('');
		}else{
			$('#date_val').val(start.format('D/MMM/YYYY') + ' - ' + end.format('D/MMM/YYYY'));
		}		
  	}
	
		
	$('#reportrange').daterangepicker({
		opens: 'right',
		drops: 'down',
		showDropdowns: true,		
		locale: {
		format: 'D-MMM-YYYY',
		customRangeLabel: 'Date Range'
		},
		parentEl: '.dateEle',
		ranges: {
			'Till Date': [],
			'This Month': [moment().startOf('month'), moment().endOf('month')],
			'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
			'Last 6 Months': [moment().subtract(5, 'month').startOf('month'), moment().endOf('month')],
			"Last Year": [moment().subtract(1, "y").startOf("year"), moment().subtract(1, "y").endOf("year")]
		}
	}, cb); 

	$(document).on('click','.ranges ul li',function(){
		$(this).parent().children().removeClass('active');
		$(this).addClass('active');
		$('.drp-selected').css('font-weight', 'bold');
		if ($(this).text() == "Till Date") {
			$("#date_val").val('Till Date');
		}

		if ($(this).text() != "Date Range") {
			tables.draw();
		}
	});
	
    $(document).on('click','.applyBtn',function(){
		tables.draw();
    });

	$('.swith_blk').click(function(){
		//   if($(this).find('span').text() == 'Yes'){
		//   $(this).find('span').text('No');
		// }else {
		//   $(this).find('span').text('Yes')
		// }
		//$(this).toggleClass('tog_yes');
		tables = $('#usr_lst_tbl').DataTable();
		$(".expand_details").each(function() {       
			var tr = $(this).closest('tr');
			var row = tables.row( tr );
			row.child.hide();
			tr.removeClass('shown');
		});
		if($(this).hasClass('tog_yes')){
			$(this).removeClass('tog_yes');		
		}else{
			$(this).addClass('tog_yes');
			$(".expand_details").trigger("click");
		}
	});

	$('#usr_lst_tbl tbody').on('click', '.expand_details', function () {
        var tr = $(this).closest('tr');
        var row = tables.row( tr );
		if(row.data()[4] != "AMOUNT")
		{
			if ( row.child.isShown() ) {
				row.child.hide();
				tr.removeClass('shown');
			}
			else {
				row.child( format(row.data()),'user_dtl_tr').show();
				tr.addClass('shown');
			}
		}
    } );

	$('.dataTables_paginate').html('<a href="#" title=""> Show More </a>');
	$('.ad_nt').click(function(){
		$('.pp_note').toggleClass('show_blk');
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
	$('#fil2').multiselect();
	$('#fil1').multiselect();
	$('#fil3').multiselect();

	$('.loans_tp').click(function(){
		$('.alpha_blk').show();
		$('.side_popup').addClass('opn_slide');
		$('#loans_tp').show();
		$('#orders_tp').hide();
		$('#crop_top').hide();
	});

	$('.orders_tp').click(function(){
		$('.alpha_blk').show();
		$('.side_popup').addClass('opn_slide');
		$('#loans_tp').hide();
		$('#orders_tp').show();
		$('#crop_top').hide();
	});


	$('.crop_top').click(function(){
		$('.alpha_blk').show();
		$('.side_popup').addClass('opn_slide');
		$('#loans_tp').hide();
		$('#orders_tp').hide();
		$('#crop_top').show();
	});

	$('.alpha_blk').click(function(){
		$('.side_popup').removeClass('opn_slide');
		$(this).hide();
	});
});
function currency_format (number, decimals, dec_point, thousands_sep) {
	number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
	var n = !isFinite(+number) ? 0 : +number,
	prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
	sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
	dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
	s = '',
	toFixedFix = function (n, prec) {
		var k = Math.pow(10, prec);
		return '' + Math.round(n * k) / k;
	};
	// Fix for IE parseFloat(0.55).toFixed(0) = 0;
	s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
	if (s[0].length > 3) {
		s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
	}
	if ((s[1] || '').length < prec) {
		s[1] = s[1] || '';
		s[1] += new Array(prec - s[1].length + 1).join('0');
	}
	return s.join(dec);
}
function format(d) {

	//alert(d[5]);
	var  details = "";
	if(d[3] == "RETURN")
	{
		$.ajax({
			url: url+'api/Returns/getreturnactualdetails/'+d[5],
			type: "GET",
			dataType: "json",
			async: false,
			success: function(res){
				console.log(res);
				//var obj = jQuery.parseJSON(res);
				 details = '<table><tr class="detal_row">'+
						'<td class="date"> &nbsp; </td>'+
						'<td colspan="2">'+
							'<table>'+
								'<tr>'+
									'<th> Product Name </th>'+
									'<th> Quantity </th>'+
									'<th> Purchased Amount </th>'+
									'<th> Total </th>'+
								'</tr>';
					$.each(res.data, function(key,value) {
						details += '<tr class="txt_rt">'+
									'<td align="left"> '+value.pname+'  </td>'+
									'<td> '+value.return_qty+' </td>'+
									'<td> '+'₹'+currency_format(value.prod_mrp,3)+' </td>'+
									'<td> '+'₹'+currency_format(value.total_price,3)+' </td>'+
								'</tr>';
					}); 
				
				
					details += 	'</table>'+
						'</td>'+
						'<td class="hide_blk"> </td>'+
						'<td class="hide_blk"> </td>'+
						'<td class="hide_blk"> </td>'+
					'</tr></table>';
				return details;
			},
			error: function(error){
				console.log("Error:");
				console.log(error);
			}
		});
	}
	else if(d[3]=="PURCHASE")
	{
		$.ajax({
			url: url+'api/Brands/adminpurchasedetails/'+d[5],
			type: "GET",
			dataType: "json",
			async: false,
			success: function(data){
				//console.log(data);
				//var obj = jQuery.parseJSON(data);
				 details = '<table><tr class="detal_row">'+
						'<td class="date"> &nbsp; </td>'+
						'<td colspan="2">'+
							'<table>'+
								'<tr>'+
									'<th> Product Name </th>'+
									'<th> Quantity </th>'+
									'<th> Purchased Amount </th>'+
									'<th> Total </th>'+
								'</tr>';
					$.each(data.data, function(key,value) {
						details += '<tr class="txt_rt">'+
									'<td align="left"> '+value.pname+'  </td>'+
									'<td> '+value.quantity+' </td>'+
									'<td> '+'₹'+currency_format(value.price,3)+' </td>'+			
									'<td> '+'₹'+currency_format(value.total_price,3)+' </td>'+
								'</tr>';
					}); 
				
				
					details += 	'</table>'+
						'</td>'+
						'<td class="hide_blk"> </td>'+
						'<td class="hide_blk"> </td>'+
						'<td class="hide_blk"> </td>'+
					'</tr></table>';
				return details;
			},
			error: function(error){
				console.log("Error:");
				console.log(error);
			}
		});
	}
	return details;
}
</script>
<?php require_once 'footer.php';?>