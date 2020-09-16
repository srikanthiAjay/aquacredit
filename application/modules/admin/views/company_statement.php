<?php require_once 'header.php';?>
<link href="<?php echo base_url(); ?>assets/css/user_detials.css" type="text/css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" type="text/css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css" type="text/css" rel="stylesheet">
<style>
@page 
{
	size:  auto;   /* auto is the initial value */
	margin: 0mm;  /* this affects the margin in the printer settings */
}
html{
	overflow: hidden;
}
.dataTable tbody tr td:last-child, .dataTable tr td:last-child, .dataTable th:last-child
{
	padding-right: 10px !important;
}
.maincls{ margin-bottom: 0px !importent; }
#usr_lst_tbl .sts_fil_blk.show {display:none !important;}
#usr_lst_tbl_wrapper .mCSB_container {background:#fff!important;border-bottom:5px solid #F0F1F5;}
#usr_lst_tbl td.trans_detail_tr{padding: 15px !important;background: #ccc;}
#usr_lst_tbl .trans_detail tr:hover {background:#fff !important;}
.hdiv{
	width:70%; background-color: #ddd; 
	-webkit-print-color-adjust: exact; 
}
.buttons-print{ color: #fff; background-image: none !important; background-color:blue !important;}

</style>
<script src='https://kit.fontawesome.com/a076d05399.js'></script>
<!-- <script src='https://code.jquery.com/jquery-3.5.1.js'></script>
<script src='https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js'></script> -->

<script src='https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js'></script>
<script src='https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js'></script>
<script src='https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js'></script>
<script src='<?php echo base_url(); ?>assets/js/buttons.print.min.js'></script>
<!-- <script src='https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js'></script> -->
<?php require_once 'sidebar.php';?>
<div class="right_blk">
	<div class="top_ttl_blk">
	<span class="cname"> </span> 
		<!-- <a href="<?php echo base_url(); ?>admin/companies/previewStatement/<?php echo $cid;?>" target="_blank" class="btn btn-primary fr"> </a> -->
		<a href="#" target="_blank" class="fr"> </a>
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
						<table id="usr_lst_tbl" class="table table-striped table-bordered " style="width:100%">
							<thead>
								<tr>
									<!-- <th></th> -->
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
									<td class="opic_non date">&nbsp;</td>
									<td class="txt_rt"> Total  </td>
									<td class="txt_rt in_td trans_total"></td>

								</tr>
								<tr>
									<td class="opic_non date">&nbsp;</td>
									<td class="txt_rt type"> Opening Balance (as on <span class="open_date"></span>)</td>
									<td class="txt_rt open_bal"></td>
								</tr>								
								<tr>
									<td class="opic_non date">&nbsp;</td>
									<td class="txt_rt"> <b id="grd_ttl">Grand Total</b></td>
									<td class="txt_rt grand_total"></td>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
			<input type="hidden" id="hid_bid" name="hid_bid" value="" />			
			<input type="hidden" id="cmobile" name="cmobile" value="" />			
			<input type="hidden" id="sdate" name="sdate" value="" />			
			<input type="hidden" id="edate" name="edate" value="" />			
			<input type="hidden" id="hid_tot" name="hid_tot" value="" />			
			<input type="hidden" id="hid_opb" name="hid_opb" value="" />			
			<input type="hidden" id="hid_gtot" name="hid_gtot" value="" />			
			<!-- <div class="btm_btn"> <button class="btn btn-primary"> Settle Amount </button> </div> -->
		</div>
	</div>
<script type="text/javascript">

var url = '<?php echo base_url() ?>';
$(document).ready(function() {
	
	var cur_url = window.location.href;
	//var url_params = cur_url.replace(url+"admin/brands/statement1/", "");
	var url_params = cur_url.replace(url+"admin/companies/statement/", "");
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
			$(".cname").html('<b>'+res.data.brand_name+'</b> / <small>'+res.data.contact_person+'</small> - <small> CMP'+company_id+'</small>');
			$("#cmobile").val(res.data.contact_mobile);
		}
	});	
	
	
	//console.log(company_id);
	$("#hid_bid").val(company_id);
	var h = $(window).height();
	var min_h = h-257;
	var printCounter = 0;
	//$('#usr_lst_tbl').append('<caption style="caption-side: bottom">A fictional company\'s staff table.</caption>');
	var tables = $('#usr_lst_tbl').DataTable({
		//'responsive': true,
		'ordering': false,
		'processing': true,
		'serverSide': true,
    	'serverMethod': 'post',
		language: {
			searchPlaceholder: "Search Transaction Details",
			search: "",
			//"dom": '<"toolbar">frtip'
		},
		"dom": 'Bfrtip',		
		//"dom": '<"top"i>rt<"bottom"flp><"clear">',	
		/* buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
		], */
		/* modifier: {
        selected: true
		}, */
		buttons: [
            //{ extend: 'copyHtml5', footer: true },
            //{ extend: 'excelHtml5', footer: true },
            //{ extend: 'csvHtml5', footer: true },
            //{ extend: 'pdfHtml5', footer: true },
            { extend: 'print', title: '',
				//autoPrint: false,
				/* action : function( e, dt, button, config ) {
						dt_print( e, dt, button, config, true )
				  }, */
				className : 'btn btn-primary btn-sm',
				customize: function (win) {
					 
					$(win.document.body).css('font-family', "'Roboto', sans-serif");
					$(win.document.body).css('font-size', '13px');
					$(win.document.body).find('#reportrange' ).hide();
					$(win.document.body).find('.sts_pp' ).hide();
					//$(win.document.body).css('width', '1129px');
					var pre = '<tr><td colspan="3" style="background: #ddd;padding: 10px 0px 10px 10px;"><div style="color: #373c4f;margin-bottom:10px;">'+$(".cname").html()+'</div><span>Mobile: <b>'+$("#cmobile").val()+'</b></span><span style="color:red;float:right;">'+$("#sdate").val()+' to '+$("#edate").val()+'</span></td></tr><tr style="font-weight:bold;"><td> Date </td><td>Details</td><td style="text-align:right;">Amount</td></tr>';
					
					var fot = '<tr style="text-align:right;"><td colspan="2">Total</td><td>'+$("#hid_tot").val()+'</td></tr><tr style="text-align:right;"><td colspan="2">Opening Balance (as on <span >'+$("#edate").val()+'</span>)</td><td class="open_bal">'+$("#hid_opb").val()+'</td></tr><tr style="text-align:right;"><td colspan="2"><b>Grand Total </td><td>'+$("#hid_gtot").val()+'</td></tr>';
					
					//$(win.document.body).css('width', '50%');
					//table table-striped table-bordered  dataTable
					//$(win.document.body).find('table').removeClass('dataTable');
					$(win.document.body).find('table').css('margin','0 auto');
					$(win.document.body).find('table').css('width', '70%');
					//$(win.document.body).find('table').css('margin-top', '0px');
					$(win.document.body).find('table > tbody').prepend(pre);
					$(win.document.body).find('table > tbody').append(fot);
					$(win.document.body).find('table').css('font-size', '10pt');
					//$(win.document.body).find('table').css('border', 'none');
					$(win.document.body).find('table').css('border', '1px solid #f0f1f5');				
					//$(win.document.body).find('td').css('padding', '5px');
					//$(win.document.body).find('td').css('border', '10px solid #f0f1f5');
					//$(win.document.body).find('table th').css('border-left', '1px solid #f0f1f5');
					//$(win.document.body).find('table td').css('border-top', '1px solid #f0f1f5');
					//$(win.document.body).find('table td').css('border-right', '1px solid #f0f1f5');
					//$(win.document.body).find('table td').css('border-bottom', '1px solid #f0f1f5');
					/* $(win.document.body).find( '.swith_blk' ).addClass( 'tog_yes' );
					$(win.document.body).find( '.expand_details' ).trigger("click");  */
					//$(win.document.body).append('<html elements here>'); //after the table
					//$(win.document.body).find('table').prepend('Hi'); //before the table
					//$('.swith_blk').addClass('tog_yes');
					//$(".expand_details").trigger("click");				
					
				},
				exportOptions: {					
					columns: ':visible',
					rows: ':visible',
					stripHtml: false
				},
				//messageTop: null,
			  /* messageTop: function () {				  
				  	
				  return '<span style="color:red;" class="pull-right">'+$("#sdate").val()+' to '+$("#edate").val()+'</span>';
                    printCounter++;
 
                    if ( printCounter === 1 ) {
                        return 'This is the first time you have printed this document.';
                    }
                    else {
                        return 'You have printed this document '+printCounter+' times';
                    }
                }, */
                messageBottom: null,
				header: null,
				footer: null }
				
        ],
		"columns": [
			
			{className: "date","width": "20%" },
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
				
				var len = json.data.length; var open_bal = 0; var grand_total = 0;
				var total_trans_amount = json.total_trans_amount;
				if (total_trans_amount > 0) {
                    $(".trans_total").html('<span class="grn_clr">₹' + currency_format(total_trans_amount, 2) + '</span>');
                } else {
                    tta = Math.abs(total_trans_amount);
                    $(".trans_total").html('<span class="txt_red">₹' + currency_format(tta, 2) + '</span>');
				}
				//var pn_sign = Math.sign(total_trans_amount);
				if(json.open_balance == null){ json.open_balance = 0; }
				if (json.open_balance > 0) {
                    $(".open_bal").html('<span class="grn_clr">₹' + currency_format(json.open_balance, 2) + '</span>');
                } else {
                    ob = Math.abs(json.open_balance);
                    $(".open_bal").html('<span class="txt_red">₹' + currency_format(ob, 2) + '</span>');
				}
				//var grand_total = parseFloat(total_trans_amount) + parseFloat(json.open_balance);
				open_bal = parseFloat(json.open_balance);
				if(json.balance_type == "IN")
				{
					//$(".open_bal").html('₹'+currency_format(json.open_balance,2));
					if(json.op_exists == 1){ open_bal = 0; }
					else{ open_bal = parseFloat(json.open_balance); }
					$(".open_bal").html('₹'+currency_format(open_bal,2));
					//grand_total = parseFloat(open_bal) - parseFloat(total_trans_amount);
				}else if(json.balance_type == "OUT"){
					//$(".open_bal").html('₹-'+currency_format(json.open_balance,2));
					if(json.op_exists == 1){ open_bal = 0; }
					else{
						open_bal = parseFloat(json.open_balance);
						//open_bal = parseFloat(total_trans_amount) - parseFloat(json.open_balance);
					}
					$(".open_bal").html('₹'+currency_format(open_bal,2));
					//grand_total = parseFloat(total_trans_amount) - parseFloat(open_bal);
				}
				$("#hid_opb").val('₹'+currency_format(open_bal,2));
				grand_total = parseFloat(total_trans_amount) + parseFloat(open_bal);
				if (grand_total > 0) {
                    $("#grd_ttl").html("Payable Amount");
                    $(".grand_total").html('<span class="grn_clr">₹' + currency_format(grand_total, 2) + '</span>');
                } else {
                    $("#grd_ttl").html("Receivable  Amount");
                    gtotal = Math.abs(grand_total);
                    $(".grand_total").html('<span class="txt_red">₹' + currency_format(gtotal, 2) + '</span>');
				}
				//$(".trans_total").html('₹'+currency_format(total_trans_amount,2));
				$("#hid_tot").val('₹'+currency_format(total_trans_amount,2));
				$(".open_date").html($("#date_val").val());					
				$("#hid_gtot").val('₹'+currency_format(grand_total,2));		
				$(".pamt").html('₹'+currency_format(json.purchased_amt,2));		
				$(".gamt").html('₹'+currency_format(json.goods_amt,2));	
				if(json.data.length > 0)
				{
					var sdate = json.data[0][0];
					var edate = json.data[len-1][0];
					$("#sdate").val(sdate); $("#edate").val(edate);
					
					$(".open_date").html(json.open_balance_date);
				}
				//$("#usr_lst_tbl tbody tr").addClass('shown');
				/* $(".user_dtl_tr").show();
				$('.swith_blk').addClass('tog_yes');
				$(".expand_details").trigger("click"); */
				
				return json.data;
			}
		},
		 "rowCallback": function( row, data ) {
			//setTimeout(function(){ $(".swith_blk").trigger("click"); }, 500);
        }
	});
	
	$(".buttons-print").removeClass('dt-button');
	$(".buttons-print").text('Print');	$(".buttons-print").find('span').hide();
	// placemet of button toolbar
	//tables.buttons().container().appendTo('.tblJobSpecs_wrapper');
	tables.buttons().container().appendTo('.fr');
	//$('#usr_lst_tbl').append('<tr><td>Date</td><td>Opening Balance</td><td>100000</td></tr>');
	$('.dataTables_scrollBody').css('height', min_h);
	$('#usr_lst_tbl_wrapper .dataTables_length').html('<h2 class="create_hdg lng_hdg"> </h2>');
	// $('#usr_lst_tbl_wrapper .dataTables_length').html('<ul class="tabs_tbl"><li class="act_tab drft_cl"> <span>Unsettled</span> </li><li class="comp_cl"> <span>Settled </span> </li></ul> <span class="tbl_btn">  </span>');
	// <a href="#" class="appr_all"> Approve All </a>
	
	$("#usr_lst_tbl_filter").addClass('col-md-8');
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
		
		if(row.data()[4] != "AMOUNT" && row.data()[4] != "COMPANY")
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

	//alert(d[4]);
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