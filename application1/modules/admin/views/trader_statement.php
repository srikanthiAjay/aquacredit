<?php require_once 'header.php';?>
<link href="<?php echo base_url(); ?>assets/css/user_detials.css" type="text/css" rel="stylesheet">
<style>
#usr_lst_tbl .sts_fil_blk.show {display:none !important;}
#usr_lst_tbl_wrapper .mCSB_container {background:#fff!important;border-bottom:5px solid #F0F1F5;}
</style>
<script src='https://kit.fontawesome.com/a076d05399.js'></script>
<?php require_once 'sidebar.php';?>
<div class="right_blk">
	<div class="top_ttl_blk">
	<span> <b><?php echo $trader["full_name"];?>  <?php echo $trader["firm_name"];?></b>Transactions - TDR<?php echo $trader["td_id"];?> </span>
		<a href="<?php echo base_url(); ?>api/traders/previewAgentTransaction/<?php echo $trader["td_id"];?>" target="_blank" title="" class="btn ed_usr btn-primary fr"> Print </a>
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
						<p>Total Tons</p>
						<h1> <?php echo ($trade_profit->weight)/1000; ?> </h1>
					</div>
				</li>
				<li class="bor_lf_none">
					<div class="top_in_op crop_top">
						<p>Highly Sold Counts</p>
						<h1> 
						<?php foreach ($soldCounts as $count) {
							echo $count->count.'<small>c</small> <span></span> ';
						}?>
						</h1>
					</div>
				</li>
				<li class="bor_lf_none">
					<div class="top_in_op crop_top">
						<p> Trade Profit </p>
						<h1> <?php echo ($trade_profit->profit) ? '₹'.IND_money_format($trade_profit->profit) : ''; ?> </h1>
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
											<label class="form-check-label radio_blk" for="TRADE">
												<input class="form-check-input" type="radio" name="trans_type" value="TRADE" id="TRADE">
												Trades
											</label>

											<label class="form-check-label radio_blk" for="RECEIPT">
												<input class="form-check-input" type="radio" name="trans_type" value="RECEIPT" id="RECEIPT">
												Receipt
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
			<!-- <div class="btm_btn"> <button class="btn btn-primary"> Settle Amount </button> </div> -->
		</div>
	</div>
<script type="text/javascript">

var url = '<?php echo base_url() ?>';
$(document).ready(function() {
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
			'url':url+'api/traders/transactions',
			'data': function(data){
				var reportrange = $('#date_val').val();
				data.reportrange = reportrange;
				data.trader_id = "<?php echo $trader["td_id"];?>";
				data.trans_type = $("input[name='trans_type']:checked").val();
				data.month_opt = $("input[name='month_opt']:checked").val();
			},
			"dataSrc": function (json) {
				total_trans_amount = json.total_trans_amount;
				grand_total = parseFloat(total_trans_amount) + parseFloat(json.open_balance);
				$(".trans_total").html('₹'+currency_format(total_trans_amount,2));
				$(".open_bal").html('₹'+currency_format(json.open_balance,2));
				$(".grand_total").html('₹'+currency_format(grand_total,2));		
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
        if ( row.child.isShown() ) {
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
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
function format ( d ) {
	var  details = "";
	if(d[3] == "RECEIPT")
	{
		details = '<tr class="detal_row">'+
						'<td class="date"> &nbsp; </td>'+
						'<td colspan="2">'+
							'<table>'+
								'<tr>'+
									'<th> Transfer Type </th>'+
									'<th> Amount </th>'+
									'<th>  </th>'+
									'<th>  </th>'+
								'</tr>'+
								'<tr>'+
									'<td> '+d[4]+' transfer </td>'+
									'<td> '+d[6]+' </td>'+
									'<td>  </td>'+
									'<td>  </td>'+
								'</tr>'+
							'</table>'+
						'</td>'+
						'<td class="hide_blk"> </td>'+
						'<td class="hide_blk"> </td>'+
						'<td class="hide_blk"> </td>'+
					'</tr>';
		return details;
	}
	else if(d[4]=="HARVEST")
	{
		$.ajax({
			url: url+'api/Trades/tradeactualdetails/'+d[5],
			type: "GET",
			dataType: "json",
			async: false,
			success: function(data){
				//console.log(data);
				//var obj = jQuery.parseJSON(data);
				 details = '<tr class="detal_row">'+
						'<td class="date"> &nbsp; </td>'+
						'<td colspan="2">'+
							'<table>'+
								'<tr>'+
									'<th> Date </th>'+
									'<th> Count </th>'+
									'<th> Price </th>'+
									'<th> Weight </th>'+
									'<th> Total Price </th>'+
								'</tr>';
					$.each(data.data, function(key,value) {
						details += '<tr>'+
									'<td> '+value.trade_date+'  </td>'+
									'<td> '+value.count+' </td>'+
									'<td> '+'₹'+currency_format(value.company_price,2)+' </td>'+
									'<td> '+value.company_weight+' </td>'+
									'<td> '+'₹'+currency_format(value.company_amount,2)+' </td>'+
								'</tr>';
					}); 
				
				
					details += 	'</table>'+
						'</td>'+
						'<td class="hide_blk"> </td>'+
						'<td class="hide_blk"> </td>'+
						'<td class="hide_blk"> </td>'+
					'</tr>';
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
function load_TRADE( id )
{
	console.log('edit');
	var lid = $("#hid_lid").val();
	$("#ukey_edit").val('');
	$("#tkey_edit").val('');
	$("#userid_edit").val('');
	$("#traderid_edit").val('');
	$("#crop_opt_edit").val('');
	$("#trade_date_edit").val('');
	$("#exp_count_edit").val('');
	$("#exp_weight_kgs_edit").val('');
	$("#exp_farmer_price_val_edit").val('');
	$("#exp_farmer_price_edit").val('');
	$("#exp_company_price_val_edit").val('');
	$("#exp_company_price_edit").val('');
	$("#note_edit").val('');
	$("#status").val('');
	$('#cweight').html('');
	$('#camount').html('');
	$('#fweight').html('');
	$('#famount').html('');
	$('#cweightval').val('');
	$('#camountval').val('');
	$('#fweightval').val('');
	$('#famountval').val('');
	$('#expenses').val('');
	$('#labfee').val('');
	$('#gtotalval').val('');
	$('#gtotal').html('');
	$('#invoiceItem').html('');

	$.ajax({
		//url: url+"api/loans/index/"+lid,
		url: url+"api/trades/tradedetails/"+lid,
		data: {},
		type:'POST',
		datatype:'json',
		success : function(response){
		res= JSON.parse(response);
		$("#trade_id").val(lid);
			var endv = $("#endis").val();
			if(endv==1)
			{
				$(".edt_bl_lnk").trigger("click");
				$("#endis").val(0);
			}


			if(res.data.tradetype==1)
			{
				$("#crplist_edit").hide();
				$("#mobiledis").show();
				$("#mobile_edit").val(res.data.guest_mobile);
				$("#mobile_edit").prop( "disabled", true );
			}
			else
			{
				$("#crplist_edit").show();
				$("#mobiledis").show();
				$("#mobiledis").hide();
			}

			$("#trade_type_edit").val(res.data.tradetype);
			$("#ukey_edit").val(res.data.user_name);
			if(res.data.trader_type=='Agent')
			{
				$("#tkey_edit").val(res.data.full_name);
			}
			else
			{
				$("#tkey_edit").val(res.data.firm_name+' ( '+res.data.contact_person+' )');
			}


			$("#userid_edit").val(res.data.userid);
			$("#traderid_edit").val(res.data.trader_id);
			/*$("#crop_opt_edit").val(res.data.crop_loc);*/
			var a=$.datepicker.formatDate( "dd-M-yy", new Date(res.data.trade_date));


			$("#trade_date_edit").val(a);
			$("#exp_count_edit").val(res.data.exp_count);
			$("#exp_weight_kgs_edit").val(res.data.exp_weight_kgs);
			$("#exp_farmer_price_val_edit").val(res.data.exp_farmer_price);
			$("#exp_farmer_price_edit").val(res.data.exp_farmer_price);
			$("#exp_company_price_val_edit").val(res.data.exp_company_price);
			$("#exp_company_price_edit").val(res.data.exp_company_price);
			$("#note_edit").val(res.data.note);
			$("#status").val(res.data.status);

			if(res.data.status==1)
			{
				$('#edthide').hide();
				$('#fnhide').hide();
				$('#upthide').hide();
				$("#expenses").prop("readonly", true);
				$("#labfee").prop("readonly", true);

			}
			else
			{
				$('#edthide').show();
				$('#fnhide').show();
				$('#upthide').show();
				$("#expenses").prop("readonly", false);
				$("#labfee").prop("readonly", false);
			}

			amount_with_commasedit();
			amount_with_commasedit_val();

			$('#cweight').html(roundTo(res.data.company_fweight,4));

			$('#camount').html(number_format((res.data.company_fprice),2));
			$('#fweight').html(roundTo(res.data.farmer_fweight,4));
			$('#famount').html(number_format((res.data.farmer_fprice),2));

			$('#cweightval').val(roundTo(res.data.company_fweight,4));
			$('#camountval').val(roundTo(res.data.company_fprice,2));
			$('#fweightval').val(roundTo(res.data.farmer_fweight,4));
			$('#famountval').val(roundTo(res.data.farmer_fprice,2));

			$('#expenses').val(res.data.expenses_farmer);
			$('#labfee').val(res.data.labfee_framer);
			var gttot = parseFloat(res.data.expenses_farmer) + parseFloat(res.data.gtotal) + parseFloat(res.data.labfee_framer);
			$('#gtotalval').val(roundTo(res.data.gtotal,2));
			$('#gtotal').html(number_format(gttot,2));
			//$('#crop_opt_edit option:eq('+res.data.crop_loc+')').attr('selected', true);
					/*$('#invoiceItem').html('');*/
			//htmlRows = "";
			/*get trade actual details*/
				$.ajax({
				url: url+"api/trades/tradeactualdetails/"+lid,
				data: {},
				type:'POST',
				datatype:'json',
				success : function(response){
				res1 = JSON.parse(response);
				htmlRows = "";
				if(res1.data.length>0)
				{
					$('#rcntval').val(res1.data.length);
					$.each(res1.data, function(index, trades) {
						$("#tcount10").prop("disabled", true);
						$("#tcount11").prop("disabled", true);


					var tcamtt = (trades.company_amount);
					var tfamtt = (trades.farmer_amount);
					// console.log(trades.trade_date);
					// var a=$.datepicker.formatDate( "dd-M-yy", new Date(trades.trade_date));
					a =trades.trade_date;
					//console.log(a);
					htmlRows = '<tr id="rowNums'+trades.id+'"><td class="date_td"> <input type="text" class="form-control mykey edate" placeholder="" name="tdate[]" id="tdate'+trades.id+'" value="'+a+'" onkeydown="return false;"></td><td class="cnt_wth"><input maxlength="7" type="text" class="form-control mykey" placeholder="" name="tcount[]" id="tcount'+trades.id+'" value="'+trades.count+'" onkeypress="return IsAlphaNumeric(event)" ></td><td class="bor_t_b_none"><div> &nbsp;</div></td><td class="prc_td"><input type="text" class="form-control mykey" placeholder="" maxlength="9" name="tcprice[]" id="tcprice_'+trades.id+'" value="'+trades.company_price+'" onkeypress="return onlyNumberKey(event)" ></td><td class="com_bg weig" width="80"> <input type="text" class="form-control mykey" placeholder="" name="tcweight[]" id="tcweight_'+trades.id+'" value="'+trades.company_weight+'" onkeypress="return onlyNumberKey(event)" ></td><td class="com_bg amn_blk"><input type="text" class="form-control mykey" placeholder="" readonly name="tcamount[]" id="tcamount_'+trades.id+'" value="'+tcamtt+'" onkeypress="return onlyNumberKey(event)" ><input type="hidden" class="form-control mykey" placeholder="" readonly name="tcamountval[]" id="tcamountval_'+trades.id+'" value="'+trades.company_amount+'" ></td><td class="bor_t_b_none"><div> &nbsp;</div></td><td class="far_bg prc_td"> <input type="text" maxlength="9" class="form-control mykey" placeholder="" name="tfprice[]" id="tfprice_'+trades.id+'" value="'+trades.farmer_price+'" ></td><td class="far_bg weig" width="80" onkeypress="return onlyNumberKey(event)" ><input type="text" class="form-control mykey" placeholder="" name="tfweight[]" id="tfweight_'+trades.id+'" value="'+trades.farmer_weight+'" ></td><td class="far_bg amn_blk" onkeypress="return onlyNumberKey(event)" > <input type="text" class="form-control" placeholder="" readonly name="tfamount[]" id="tfamount_'+trades.id+'" value="'+tfamtt+'" ><input type="hidden" class="form-control noalpha mykey" placeholder="" readonly name="tfamountval[]" id="tfamountval_'+trades.id+'" value="'+trades.farmer_amount+'" onkeypress="return onlyNumberKey(event)"><input type="hidden" class="form-control noalpha mykey" placeholder="" readonly name="hid_acivity_id[]" id="hid_acivity_id_'+trades.id+'" value="'+trades.id+'"> </td></tr>';

					$('#invoiceItem').append(htmlRows);

					var dateToday = new Date();
					$("#tdate"+trades.id).datepicker({
						dateFormat: 'dd-M-yy',
						defaultDate: trades.trade_date,
						changeMonth: true,
						changeYear: true,
						//minDate: dateToday,
						numberOfMonths: 1
					});
						if(res.data.status==1)
						{
							$(".mykey").prop("disabled", true);
						}
						else
						{
							$(".mykey").prop("disabled", false);
						}

					});
					htmlRows = '<tr id="rowNums0"><td> <input type="text" class="form-control mykey edate" placeholder="" name="tdate[]" id="tdate0" onkeydown="return false;"></td><td class="cnt_wth"><input maxlength="7" type="text" class="form-control mykey" placeholder="" name="tcount[]" id="tcount0" onkeypress="return IsAlphaNumeric(event)"></td><td class="bor_t_b_none"><div> &nbsp;</div></td><td class="weig"><input type="text" class="form-control mykey" placeholder="" maxlength="9" name="tcprice[]" id="tcprice_0" onkeypress="return onlyNumberKey(event)"></td><td class="com_bg weig" width="80"> <input type="text" class="form-control mykey" placeholder="" name="tcweight[]" id="tcweight_0" onkeypress="return onlyNumberKey(event)" ></td><td class="com_bg amn_blk"><input type="text" class="form-control mykey" placeholder="" readonly name="tcamount[]" id="tcamount_0"  ><input type="hidden" class="form-control mykey" placeholder="" readonly name="tcamountval[]" id="tcamountval_0"></td><td class="bor_t_b_none"><div> &nbsp;</div></td><td class="far_bg weig"> <input type="text" maxlength="9" class="form-control mykey" placeholder="" name="tfprice[]" id="tfprice_0" onkeypress="return onlyNumberKey(event)"></td><td class="far_bg weig" width="80"><input type="text" class="form-control mykey" placeholder="" name="tfweight[]" id="tfweight_0" onkeypress="return onlyNumberKey(event)" ></td><td class="far_bg amn_blk"> <input type="text" class="form-control mykey" placeholder="" readonly name="tfamount[]" id="tfamount_0" ><input type="hidden" class="form-control mykey" plcrpsaceholder="" readonly name="tfamountval[]" id="tfamountval_0" ><input type="hidden" class="form-control mykey" placeholder="" readonly name="hid_acivity_id[]" id="hid_acivity_id_0" value="0"> </td></tr>';

						$('#invoiceItem').append(htmlRows);
						if(res.data.status==1)
						{
							$(".mykey").prop("disabled", true);
						}
						else
						{
							$(".mykey").prop("disabled", false);
						}

					var dateToday = new Date();
					$("#tdate0").datepicker({
						dateFormat: 'dd-M-yy',
						changeMonth: true,
						changeYear: true,
						//minDate: dateToday,
						numberOfMonths: 1
					});
				}
				else
				{

					htmlRows = '<tr id="rowNums0"><td> <input type="text" class="form-control mykey edate" placeholder="" name="tdate[]" id="tdate0" onkeydown="return false;"></td><td class="cnt_wth"><input maxlength="7" type="text" class="form-control mkey" placeholder="" name="tcount[]" id="tcount0" onkeypress="return IsAlphaNumeric(event)" ></td><td class="bor_t_b_none"><div> &nbsp;</div></td><td class="weig"><input type="text" class="form-control mkey" placeholder="" maxlength="9" name="tcprice[]" id="tcprice_0" onkeypress="return onlyNumberKey(event)" ></td><td class="com_bg weig" width="80"> <input type="text" class="form-control mkey" placeholder="" name="tcweight[]" id="tcweight_0" onkeypress="return onlyNumberKey(event)" ></td><td class="com_bg amn_blk"><input type="text" class="form-control" placeholder="" readonly name="tcamount[]" id="tcamount_0"  onkeypress="return onlyNumberKey(event)" ><input type="hidden" class="form-control " placeholder="" readonly name="tcamountval[]" id="tcamountval_0"></td><td class="bor_t_b_none"><div> &nbsp;</div></td><td class="far_bg weig"> <input type="text" maxlength="9" class="form-control mkey" placeholder="" name="tfprice[]" id="tfprice_0" onkeypress="return onlyNumberKey(event)" ></td><td class="far_bg weig" width="80"><input type="text" class="form-control mkey" placeholder="" name="tfweight[]" id="tfweight_0" onkeypress="return onlyNumberKey(event)" ></td><td class="far_bg amn_blk"> <input type="text" class="form-control" placeholder="" readonly name="tfamount[]" id="tfamount_0" ><input type="hidden" class="form-control " placeholder="" readonly name="tfamountval[]" id="tfamountval_0" ><input type="hidden" class="form-control " placeholder="" readonly name="hid_acivity_id[]" id="hid_acivity_id_0" value="0"> </td></tr>';

					$('#invoiceItem').append(htmlRows);

					var dateToday = new Date();
					$("#tdate0").datepicker({
						dateFormat: 'dd-M-yy',
						changeMonth: true,
						changeYear: true,
						//minDate: dateToday,
						numberOfMonths: 1
					});
				}

				}
			});
			/*get trade actual details*/

			/*get crop details*/

				$.ajax({
				url: url+"api/UserCrops/index/"+res.data.userid,
				data: {},
				type:'POST',
				datatype:'json',
				success : function(response1){

				rescp1 = JSON.parse(response1);
					var aeval = '_edit';
					var opt = '';
					if(rescp1.data.length > 0)
					{
					$.each(rescp1.data, function(index, crop) {


						if(crop.cd_id == res.data.location)
						{
						sel = "checked";
						$(".crop_type_val").text(crop.crop_location);
						}
						else
						{
						sel = "";
						}

						opt += '<div class="form-check"><input class="form-check-input" type="radio" name="crop_opt_edit" id="crp'+index+aeval+'" value="'+crop.cd_id+'" '+sel+' /><label class="form-check-label" for="crp'+index+aeval+'">'+crop.crop_location+'</label></div>';
					});
					}

				$("#crop_opt_li_edit").html(opt);


				}
			});

			/*get crop details*/

		}
	});

	$('#edt_user_id').show();
	$('.ap_blk').show();
}
function load_RECEIPT( id )
{
	console.log('receipt '+id);
}
</script>
<?php require_once 'footer.php';?>