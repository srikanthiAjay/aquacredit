<?php require_once 'header.php' ; ?>
<link href="<?php echo base_url();?>assets/css/trader.css" type="text/css" rel="stylesheet">
<?php require_once 'sidebar.php' ; ?>
<script src='https://kit.fontawesome.com/a076d05399.js'></script>		
<div class="right_blk"> 
	<div class="top_ttl_blk"> <span class="padin_t_5">Traders  </span>  
		<span class="crt_link fr">
			<button class="btn btn-primary"> Create Trader </button> 
			<i class="fa fa-times cl_crt_bl hide_blk" aria-hidden="true"></i>
		</span>
	</div>
	<!-- Create Trade Start -->
	<div class="trade_create"> 
        <div class="crt_blk"> 
          
			<h2 class="create_hdg"> Create Trader </h2>
			<form action="javascript:void(0);" id="trader_frm" name="trader_frm" method="post" >
			<div class="ove_auto">
				<div class="trd_cr">       
					
					<div class="type_trd">
						<label class="radio-inline">
							<input type="radio" value="Agent" name="trader_type" checked>Agent
						</label>
						<label class="radio-inline">
							<input type="radio" value="Exporter" name="trader_type">Exporter
						</label>
					</div>
					<div class="agnt_blk" style="display: block;">
						<div class="cre_inp firm_block" style="display:none;">
							<div class="sm_blk"> Firm Name </div>
							<input type="text" id="firm_name" name="firm_name" class="form-control" placeholder="">
						</div>
						<div class="cre_inp">
							<div class="sm_blk chng_label"> Trader Name </div>
							<input type="text" class="form-control" id="tname" name="tname" placeholder="">
						</div>

						<div class="trd_c_row"> 
							<div class="trd_c_cel"> 
								<div class="cre_inp">
									<div class="sm_blk"> Mobile </div>
									<input type="text" id="tmobile" name="tmobile" maxlength="10" class="form-control allownumericwithoutdecimal" placeholder="">
								</div>
							</div>
							<div class="trd_c_cel"> 
								<div class="cre_inp">
									<div class="sm_blk"> Location </div>
									<input type="text" id="tlocation" name="tlocation" class="form-control" placeholder="">
								</div>
							</div>
						</div>

						<div class="trd_c_row"> 
						
							<div class="trd_c_cel aadhar_block"> 
								<div class="cre_inp">
									<div class="sm_blk"> Aadhar </div>
									<input type="text" id="taadhar" name="taadhar" maxlength="12" class="form-control" placeholder="">
								</div>
							</div>	
							
							<div class="trd_c_cel pan_block"> 
								<div class="cre_inp">
									<div class="sm_blk"> Pan </div>
									<input type="text" id="tpan" name="tpan" class="form-control" placeholder="">
								</div>
							</div>

							<div class="trd_c_cel gst_block"> 
								<div class="cre_inp">
									<div class="sm_blk"> GST </div>
									<input type="text" id="tgst" name="tgst" class="form-control" placeholder="">
								</div>
							</div>						
							
						</div>       

						<div class="cre_inp bal_ll">
							<div class="sm_blk"> Balance </div>
							<ul> 
								<li id="ps"> + <input type="radio" id="p" name="bl_ch" value="Positive"> </li> <li> - <input type="radio" id="n" name="bl_ch" value="Negative"> </li> 
							</ul>
							<input type="text" id="tbal_commas" name="tbal_commas" class="form-control" value="" onkeyup = "amount_with_commas('add');" onblur = "amount_with_commas('add');" />
							<input type="hidden" id="tbal" name="tbal" class="form-control allownumericwithoutdecimal" value="" />
							<label id="bl_ch-error" class="error" for="bl_ch"></label>
						</div>   
						<div class="cre_inp">
							<div class="sm_blk"> Payment Terms </div>
							<input type="text" id="pterm" name="pterm" class="form-control" placeholder="">
						</div>
					</div>
					
				</div>        
			</div>

			<div class="trd_subm">
				<button type="submit" class="btn btn-primary fr sbt_btn"> Submit</button>
				<input type="hidden" id="hid_td_id" name="hid_td_id" value="" />
			</div>
			</form>
		</div>
	</div>
	<!-- Create Trade End -->
	<div class="trd_cr_r">
		<div class="mar_btm_20">
			<div class="card_view dis_tbl">
				<ul class="trd_anl"> 
					<li class="bor_lf_none"> 
						<div class="top_in_op crop_top">
							<p> Total Traders </p> 
							<h1><span id="tot_count">0</span></h1>
						</div>
					</li>
					<li class=""> 
						<div class="top_in_op crop_top">
							<p> Agents </p> 
							<h1><span id="agent_count">0</span></h1>
						</div>
					</li>
					<li class=""> 
						<div class="top_in_op crop_top">
							<p> Experts </p> 
							<h1><span id="exporter_count">0</span></h1>
						</div>
					</li>
				</ul>				
			</div>
		</div>
			
		<div class="lst_trd">
			<div class=""> 
				<div class="">
					<div class="res_tbl">
						<div class="dropdowns">
							<button class="btn btn-secondary drp_btn" type="button">
								<i class="fa fa-th-list" aria-hidden="true"></i>
							</button>
							<ul class="sl_menu">
								<li><a class="toggle-vis" data-column="1">Date</a></li>  
								<li><a class="toggle-vis" data-column="2">Trader Name</a> </li>    
								<li><a class="toggle-vis" data-column="3">Mobile</a> </li>
								<li><a class="toggle-vis" data-column="4">Type</a> </li>
								<li><a class="toggle-vis" data-column="5">Balance</a> </li>       
							</ul>
						</div>
						<table id="trader_lst_tbl" cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped table-hover" style="width:100%">
							<thead>
								<tr>
									<th class="id_td"> Id </th>
									<th class="date_td"> Date
										<span class="sts_pp">
											<i class="fa fa-filter" aria-hidden="true" style="font-size: 9px;"></i>
										</span>
										<div class="sts_fil_blk"> 
											<div class="form-check">
												<input class="form-check-input" type="radio" name="month_opt" value="m" id="this_mnt">
												<label class="form-check-label" for="this_mnt">
												This Month
												</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="radio" name="month_opt" value="3m" id="last_3mont">
												<label class="form-check-label" for="last_3mont">
												Last 3 Months
												</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="radio" name="month_opt" value="6m" id="last_6mon">
												<label class="form-check-label" for="last_6mon">
												Last 6 Months
												</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="radio" name="month_opt" value="1y" id="one_year">
												<label class="form-check-label" for="one_year">
												1 Year
												</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="radio" name="month_opt" value="cm" id="choos_date">
												<label class="form-check-label" for="choos_date">
												Choose Date
												</label>
											</div>
										</div>
									</th>
									<th> Trader Name  </th>
									<th class="mob_numb"> Mobile </th>
									<th class="stat_blk"> Type 
										<span class="sts_pp">
											<i class="fa fa-filter" aria-hidden="true" style="font-size: 9px;"></i>
										</span>
										<div class="sts_fil_blk">         
											<div class="trd_lst">
												<div class="form-check">
													<input class="form-check-input" type="checkbox" name="trader_opt" value="Agent" id="sta1">
													<label class="form-check-label" for="sta1">
													Agent
													</label>
												</div>
												<div class="form-check">
													<input class="form-check-input" type="checkbox" name="trader_opt" value="Exporter" id="sta2">
													<label class="form-check-label" for="sta2">
													Exporter
													</label>
												</div>
											</div>
										</div>
									</th>
									<th colspan="bal_tbl"> Balance 
										<span class="sts_pp">
											<i class="fa fa-filter" aria-hidden="true" style="font-size: 9px;"></i>  
										</span>
										<div class="sts_fil_blk">         
											<div class="trd_lst">
												<div class="form-check">
													<input class="form-check-input" type="checkbox" name="optradio" value="" id="pay1">
													<label class="form-check-label" for="pay1">
													Receivables
													</label>
												</div>
												<div class="form-check">
													<input class="form-check-input" type="checkbox" name="optradio" value="" id="pay2">
													<label class="form-check-label" for="pay2">
													Payable
													</label>
												</div>
												<div class="form-check">
													<input class="form-check-input" type="checkbox" name="optradio" value="" id="pay3">
													<label class="form-check-label" for="pay3">
													Settled
													</label>
												</div>
											</div>
										</div>
									</th>
									<th class="act_ms"> Actions </th>
								</tr>
							</thead>
							<tbody>        
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
	
	
	$(".gst_block").hide();
	$('.bal_ll li').click(function(){
		$('.bal_ll li').removeClass('atc');
		$(this).addClass('atc');
	});
	$('.type_trd label').click(function(){
		
		var k = $("input[name='trader_type']:checked").val();

		if(k == 'Agent'){
			/* $('.exppr_blk').hide();
			$('.agnt_blk').show(); */
			$('.firm_block').hide();
			$('.aadhar_block').show();
			$('.gst_block').hide();
			$(".aadhar_block").css({"float":"left"});
			$(".pan_block").css({"float":"right"});
			//$("#tname").attr("placeholder", "Trader Name");
			$(".chng_label").text("Trader Name");
			
		}else if(k == 'Exporter'){
			/* $('.agnt_blk').hide();
			$('.exppr_blk').show(); */
			$('.firm_block').show();
			$('.aadhar_block').hide();
			$('.gst_block').show();
			$(".pan_block").css({"float":"left"});
			$(".gst_block").css({"float":"right"});
			//$("#tname").attr("placeholder", "Contact Person");
			$(".chng_label").text("Contact Person");
			
		}
	});

	/* var table = $('#usr_lst_tbl').DataTable({
		"ordering": false,
		language: {
		searchPlaceholder: "Search Traders",
		search: "",
		"dom": '<"toolbar">frtip'
		}
	}); */
	
	var table = $('#trader_lst_tbl').DataTable({
		'processing': true,
		'serverSide': true,
		'serverMethod': 'post',
		"ordering": false,
		   language: {
			searchPlaceholder: "Search Trader Details",
			search: "",
			"dom": '<"toolbar">frtip'
			},
		"columnDefs": [
			{ className: "mob_numb", "targets": 3 },
			{ className: "bal_tbl", "targets": 5 },
			{ className: "txt_cnt", "targets": 6 }
		  ],
		//"order": [[ 3, 'desc' ], [ 0, 'asc' ]],
		//"order": [[ 1, 'desc' ]],
		'ajax': {
		   'url':url+'api/traders/get_traders',
		   'data': function(data){
			  // Read values		
			 
				var month_opt = $("input[name='month_opt']:checked").val();
				 
				var multi_trader = [];
				$.each($("input[name='trader_opt']:checked"), function(){
					multi_trader.push($(this).val());
				});
				 
				  // Append to data			 
				  data.month_opt = month_opt;
				  data.trader_opt = multi_trader;
			   },
		   "dataSrc": function (json) {
			   
			   var acount = ecount = 0;
			   
			   if(json.agent_count > 0){ $("#agent_count").html(addCommas(json.agent_count)); acount = json.agent_count; }
					else{ $("#agent_count").html(0); }
					if(json.exporter_count > 0){ $("#exporter_count").html(addCommas(json.exporter_count)); ecount = json.exporter_count}
					else{ $("#exporter_count").html(0);}
					
					$("#tot_count").html(addCommas(+acount+ +ecount));

				setInterval(function(){					
				
					$('.act_icn').popover({
					html: true,
					content: function() {
						return $('#popover-content').html();
						}
					});					
					
				}, 500);
			
				return json.data;
				
			}		
			
		}
	});
	 

	$("input[name='month_opt']").on('click',function() {
		//month_opt = $(this).val();
		table.draw();
	});
	$("input[name='trader_opt']").on('click',function() {		
		table.draw();
	});
	
	$('.note').click(function(){
		$('.note_txt').toggleClass('show');
	});
	
	$("div.toolbar").html('<b>SSS</b>');
	
	$('a.toggle-vis').on( 'click', function (e) {
		$(this).parent().toggleClass('act');
		e.preventDefault();
		var column = table.column( $(this).attr('data-column') );
		column.visible( ! column.visible() );
	});

	$('.dataTables_length').html('<h2 class="create_hdg lng_hdg">  Trader List </h2>');

	$('.dataTables_paginate').html('<a href="#" title=""> Show More </a>');
	$('.adds_blk').click(function(){        

		var k = $(this).text();
		$('.adds_blk').removeClass('fl_wth');
		$(this).addClass('fl_wth');

		$('.fl_wth').click(function(){
			$(this).siblings('.tool_tip').text(k);
			$(this).siblings('.tool_tip').show();
		});

		$('.fl_wth').mouseout(function(){
			$('.tool_tip').hide();
			$('.tool_tip').text('');
		});

	});

	$('.ad_mr_trd').click(function(){
		$('.sec_blk').css('display', 'table');
	});

$(document).mouseup(function(e) 
{
    var container = $(".sl_menu, .drp_btn");

    if (!container.is(e.target) && container.has(e.target).length === 0) 
    {
        $('.sl_menu').removeClass('show');
    }

    // var containerff = $(".sts_fil_blk, .sts_pp");

    //  if (!containerff.is(e.target) && containerff.has(e.target).length === 0) 
    // {
    //     $('.sts_fil_blk').removeClass('show');
    //     $('.sts_pp').removeClass('ad_tgl');
    // }

    var fl_cnt = $('.adds_blk');
    if (!fl_cnt.is(e.target) && fl_cnt.has(e.target).length === 0) 
    {
        $('.adds_blk ').removeClass('fl_wth');
    }

    //  var cl_val = $('.check_list, .check_wt_serc');
    // if (!cl_val.is(e.target) && cl_val.has(e.target).length === 0) 
    // {
    //     $('.check_list ').removeClass('show_chk');
    //     $('.check_wt_serc').removeClass('act_v');
    // }

});

$('.crt_link').click(function(){
    $('.trade_create').toggleClass('sh_trade_create');
    $('.trd_cr_r').toggleClass('trd_cr_r_r');
    $(this).find('.btn').toggleClass('hide_blk');
    $('.cl_crt_bl').toggleClass('hide_blk');
	$('.sbt_btn').text('Submit');
	$("#hid_td_id").val('');
	document.getElementById("trader_frm").reset(); 
    // $(this).toggleClass('crt_link');
    
});
 // $('.sts_pp').click(function(){
 //        $(".sts_pp").not(this).removeClass('ad_tgl');
 //        $(".sts_pp").not(this).siblings('.sts_fil_blk').removeClass('show');
 //        $(this).siblings('.sts_fil_blk').toggleClass('show');
 //        $(this).toggleClass('ad_tgl');
 // });
	// $('#fil1').multiselect();
 //     $('#fil2').multiselect();
 //     $('#fil3').multiselect();
 //   $('#mul1').multiselect();
 //   $('#mul2').multiselect();
 //   $('#mul3').multiselect();
 //   $('#mul4').multiselect();
 //   $('#mul5').multiselect();
 //   $('#mul6').multiselect();  
$('body').css('display', 'block');
// $('#mul1').change(function (){
// 		if($('#mul1').val() == null){
// 			$('#exp_far, #exp_cmp').prop('disabled', true);
// 		}else {
// 			$('#exp_far, #exp_cmp').prop('disabled', false);
// 		}
// });
$('#exp_far, #exp_cmp').keyup(function(){

		var e_cnt =  $('#mul1').val();
		var e_far = $('#exp_far').val();
		var e_cmp = $('#exp_cmp').val();
		if(e_cnt != null){
			if(e_far != ''){
				if(e_cmp != ''){
						$('.expected_blk').show();
				}
			}			
		}
});

$(document).on("click", ".del", function() {
   $('#delete_trader').modal();
});

$(document).on("click", ".edt", function() {
   $('.trade_create').addClass('sh_trade_create');
   $('.trd_cr_r').addClass('trd_cr_r_r');
   $('.crt_link').find('.btn').addClass('hide_blk');
   $('.crt_link').find('.cl_crt_bl').removeClass('hide_blk');
});

$('.pp_clss').click(function(){
    $('#edt_user_id').hide();
   $('.ap_blk').hide();
   $('.popover').remove();
    $('.prc_txt_area').removeAttr('aria-describedby');
});

$('.crt_blk').click(function(){
	$('.cl_crt_trd').show();
	$(this).addClass('cre_all_blk');
	// $('.alpha').addClass('ful_alpha');
  // $('.trd_anl').addClass('wth_100');

});
 // $('.crt_link').tooltip();
$('.cl_crt_trd').click(function(){
	$('.crt_blk').removeClass('cre_all_blk');
	// $('.alpha').removeClass('ful_alpha');
  $('.trd_anl').removeClass('wth_100');
	$(this).hide();
  $('.sec_blk').hide();
    $('.trd_cr input[type=text]').val('');
    $(".trd_cr input[type=radio]"). prop("checked", true);
    $('.check_wt_serc').removeClass('val_seld');
    $('.cre_inp').removeClass('inp_ss');
    $('.sm_blk').hide();
    $('#sel_usr').text('Select User');
    $('#sel_trd').text('Select Trader');
    $('#exp_cnt').text('Expected Count');
    $('#ac_f_cnt').text('Act.Farmer Count');
    $('#act_com_cn').text('Act.Company Count');
    $('.trd_ad_lst').addClass('show_ad_m');
});
$('.remv_blk').click(function(){
  $('.sec_blk').hide();
});
// $('.check_wt_serc').click(function(){
// 	$(this).toggleClass('act_v')
// 	$('.check_list').removeClass('show_chk');
// 	$(this).find('.check_list').toggleClass('show_chk');
// 	$(".check_list input[type='radio']").change(function(){
// 		var val = $(this).parent().parent('li').parent('ul').parent('.check_wt_serc').find(".check_list input[type='radio']:checked").val();
// 		$(this).parent().parent('li').parent('ul').parent('.check_wt_serc').find('.selectVal').text(val);
// 		$(this).parent().parent('li').parent('ul').removeClass('show_chk');
// 		$(this).parent().parent('li').parent('ul').parent('.check_wt_serc').removeClass('act_v').addClass('val_seld');
// 	});
	
// });

// $('.cre_inp input').focus(function(){
//     $(this).parent().addClass('inp_ss');	
// });

// $('.cre_inp input').focusout(function(){
//   if($(this).val() != ''){
//    $(this).parent().addClass('inp_ss');
//   }else {
//    $(this).parent().removeClass('inp_ss');
//   }  
// });

$('.ap_blk').click(function(){
  $('#edt_user_id').hide();
  $(this).hide();
});

// Edit section
$('.edt_bl_lnk').click(function(){
      $(this).toggleClass('opacity_1');
        $(this).parent().siblings('ul').toggleClass('disb_sel');
         $('.popover').remove();
         $('.prc_txt_area').removeAttr('aria-describedby');
    });
    $('.disb_sel .prc_txt_area').popover({
    html: true,
    content: function() {
      return $('#note_cnt').html();
    }

  });
  
  $("#trader_frm").submit(function(e) {			
		e.preventDefault();
		 
	}).validate({
		rules:{
			
			firm_name:
			{
				required: true
			},
			tname:
			{
				required: true,
				lettersonly:true
			},
			tmobile:
			{
				required: true,
				minlength: 10,
				maxlength: 10
			},
			tlocation:
			{
				required: true
			},
			taadhar:
			{
				required: true,
				minlength: 12,
				maxlength: 12
			},
			tpan:
			{
				required: true,
				minlength: 10,
				maxlength: 10,
				pan_regexp:true
			},
			tgst:
			{
				required: true
			},
			tbal:
			{
				required: true,
				number : true
				//decimal : true
			},
			pterm:
			{
				required: true
			},
			bl_ch:
			{
				required: true
			}
			
			
		},
		messages: {
			tname:
			{
				required: "Enter name"
			},
			tmobile:
			{
				required: "Please enter mobile number"
			},
			bl_ch:
			{
				required: "Please select balace is positive or Negitive"
			},
			taadhar:
			{
				required: "Plese enter Aadhar number",
				minlength: "Enter 12 digits Aadhar number",
				maxlength: "Enter 12 digits Aadhar number"
			},
			tpan:
			{
				required: "Please enter PAN number"				
			}
			
		},
		/* errorElement : 'div',
		errorLabelContainer: '.errorTxt', */
		submitHandler: function(form) 
		{	
			formData = new FormData(form);
			var dynurl = url+"api/traders/add";
			var dynsucc = "Trader created successfully!";
			if($("#hid_td_id").val() != ""){ dynurl = url+"api/traders/update"; var dynsucc = "Trader updated successfully!"; }
			
			$.ajax({
				url: dynurl,
				data: formData,
				type:'POST',
				contentType: false,
				processData: false,
				enctype: 'multipart/form-data',
				datatype:'json',
				success : function(response)
				{
					//alert(response);
					res= JSON.parse(response);
					if(res.status == 'success')
					{	
						new PNotify({
							title: 'Success',
							text: dynsucc,
							type: 'success',
							shadow: true
						});
						
						setInterval('location.reload()', 2000);
													
					}
					else{
						new PNotify({
							title: 'Error',
							text: 'Something went wrong, try again!',
							type: 'failure',
							shadow: true
						});
					}					
				}
			});								
		}
	});

});
function edit_trader(tdid)
{
	$("#hid_td_id").val(tdid);
	$.ajax({
		url: url+"api/traders/traderdetails/"+tdid,
		data: {},
		type:'POST',		
		datatype:'json',
		success : function(response){
			
			//alert(response);
			res= JSON.parse(response);
			if(res.status == "success")
			{
				$('.sbt_btn').text('Update');
				$('input:radio[name=trader_type]').filter('[value='+res.data.trader_type+']').attr('checked', true);
				$(".cre_inp").addClass("inp_ss");
				if(res.data.trader_type == "Exporter"){
					$(".firm_block").show(); $("#firm_name").val(res.data.firm_name); 
					$("#tname").val(res.data.contact_name);	$("#tgst").val(res.data.gst);
				}else{ 
					$(".firm_block").hide(); $("#firm_name").val(''); 
					$("#tname").val(res.data.full_name); $("#tgst").val('');
				}
				
				$("#tmobile").val(res.data.mobile_no);
				$("#tlocation").val(res.data.location);
				$("#taadhar").val(res.data.aadhar_no);
				$("#tpan").val(res.data.pan_no);
				$("#tbal_commas").val(addCommas(res.data.balance));
				$("#tbal").val(res.data.balance);
				$('input:radio[name=bl_ch]').filter('[value='+res.data.balance_type+']').attr('checked', true);
				$('input[type=radio][name=bl_ch]:checked').parent().addClass('inp_ss atc');
				$("#pterm").val(res.data.payment_terms);
			}
		}
	});
	$(".del_yes").click(function(){
			
		var delval = $("#hid_td_id").val();
		$.ajax({		
			url: url+"api/traders/delete",
			data: {tdid:delval},
			type:'POST',		
			datatype:'json',
			success : function(response){				
				
				res= JSON.parse(response);			
				
				if(res.status == 'success')
				{	
					new PNotify({
						title: 'Success',
						text: "Trader deleted successfully!",
						type: 'success',
						shadow: true
					});	
					//var dataTable = $('#brd_lst_tbl').DataTable();
					table.ajax.reload();
				}				
			}
		});
	});
}
function amount_with_commas(addoredit)
{
	//alert($('input[type=radio][name=crop_opt]:checked').val());
	var aeval = "";
	if(addoredit == "edit"){ aeval = "_edit";}
	var textbox = '#tbal_commas'+aeval;
	var hidden = '#tbal'+aeval;

	//$(textbox).keyup(function () {
	  
	var num = $(textbox).val();
	var comma = /,/g;
	num = num.replace(comma,'');
	$(hidden).val(num);
	var numCommas = addCommas(num);
	$(textbox).val(numCommas);
	/* var amt_word = convertNumberToWords(num);
	if(amt_word != undefined){
		$('.amon_text'+aeval).html(amt_word);
	} */
}
</script>
<div class="modal" id="delete_trader">
	<div class="modal-dialog">
	   <div class="modal-content">
			<div class="modal-body">
				<h1> Are You Sure ! </h1>
				<p> You want delete this Trader </p>
			</div>
			<div class="modal_footer">
				<button type="button" class="btn btn-primary del_yes" data-dismiss="modal">Yes</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
			</div>
	   </div>
	</div>
</div>
<div id="popover-content" style="display: none">
	<div class="custom-popover">
  <ul class="list-group">
    <li class="list-group-item edt">Edit</li>
    <li class="list-group-item del">Delete</li>
  </ul>
</div>
</div>

<div id="note_cnt"> 
 
</div>
<?php require_once 'footer.php' ; ?>