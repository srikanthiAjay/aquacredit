<?php require_once 'header.php' ; ?>
<link href="<?php echo base_url();?>assets/css/trader.css" type="text/css" rel="stylesheet">
<?php require_once 'sidebar.php' ; ?>
<script src='https://kit.fontawesome.com/a076d05399.js'></script>
<style>
.dataTables_filter {margin-right:0px!important;}
#snackbar{width:100%;}
</style>

<link href="<?php echo base_url();?>assets/css/snackbar.css" type="text/css" rel="stylesheet">
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
			<div id="snackbar" class=""></div>
			<h2 class="create_hdg"> Create Trader </h2>			
			<form action="javascript:void(0);" id="trader_frm" name="trader_frm" method="post" >		 
			<div class="ove_auto">				
				<div class="trd_cr"> 
					<div class="type_trd rad_btns">
						<label class="radio-inline radio_blk checkd">
							<input type="radio" value="Agent" name="trader_type" checked>Agent
						</label>
						<label class="radio-inline radio_blk">
							<input type="radio" value="Exporter" name="trader_type">Exporter
						</label>
					</div>
					<div class="agnt_blk" style="display: block;">
						<div class="cre_inp firm_block" style="display:none;">
							<div class="sm_blk"> Firm Name </div>
							<input type="text" id="firm_name" name="firm_name" class="form-control"  placeholder="" />
						</div>
						<div class="cre_inp">
							<div class="sm_blk chng_label"> Trader Name </div>
							<input type="text" class="form-control mykey" id="tname" name="tname" placeholder="" />
						</div>

						<div class="trd_c_row"> 
							<div class="trd_c_cel"> 
								<div class="cre_inp">
									<div class="sm_blk"> Mobile </div>
									<input type="text" id="tmobile" name="tmobile" maxlength="10" class="form-control allownumericwithoutdecimal mykey" placeholder="" />
								</div>
							</div>
							<div class="trd_c_cel"> 
								<div class="cre_inp">
									<div class="sm_blk"> Location </div>
									<input type="text" id="tlocation" name="tlocation" class="form-control mykey" placeholder="" />
								</div>
							</div>
						</div>

						<div class="trd_c_row"> 						
							<div class="trd_c_cel aadhar_block"> 
								<div class="cre_inp">
									<div class="sm_blk"> Aadhar </div>
									<input type="text" id="taadhar" name="taadhar" maxlength="12" class="form-control allownumericwithoutdecimal mykey" placeholder="" />
								</div>
							</div>	
							
							<div class="trd_c_cel pan_block"> 
								<div class="cre_inp">
									<div class="sm_blk"> Pan </div>
									<input type="text" id="tpan" name="tpan" class="form-control mykey" placeholder="" />
								</div>
							</div>

							<div class="trd_c_cel gst_block"> 
								<div class="cre_inp">
									<div class="sm_blk"> GST </div>
									<input type="text" id="tgst" name="tgst" class="form-control mykey" placeholder="">
								</div>
							</div>
						</div>       

						<div class="cre_inp bal_ll">
							<div class="sm_blk"> Balance </div>							
							<input type="text" id="tbal_commas" name="tbal_commas" class="form-control mykey" value="" onkeyup = "amount_with_commas('add');" onblur = "amount_with_commas('add');" />
							<input type="hidden" id="tbal" name="tbal" class="form-control allownumericwithoutdecimal" value="" />
						</div>   
						<div class="cre_inp">
							<div class="sm_blk"> Payment Terms </div>
							<input type="text" id="pterm" name="pterm" class="form-control mykey" placeholder="" />
						</div>
					</div>
					
				</div>        
			</div>

			<div class="trd_subm">
				<button type="submit" class="btn btn-primary fr sbt_btn"> Submit</button>
				<input type="hidden" id="hid_td_id" name="hid_td_id" value="" />
				<input type="hidden" id="traderexists" name="traderexists" value="0" />
				<input type="hidden" id="firmexists" name="firmexists" value="0" />
				<input type="hidden" id="hid_tname" name="hid_tname" value="" />
				<input type="hidden" id="hid_firmname" name="hid_firmname" value="" />
			</div>
			<!-- <div class="form-errors"></div> -->
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
							<p> Traders </p> 
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
							<p> Exporters </p> 
							<h1><span id="exporter_count">0</span></h1>
						</div>
					</li>
				</ul>				
			</div>
		</div>
			
		<div class="lst_trd">
			<div class="card_view"> 
				<div class="">
					<div class="res_tbl">
						<table id="trader_lst_tbl" cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped table-hover" style="width:100%">
							<thead>
								<tr>
									<th class="id_td"> Id </th>
									<th class="date_td"> Date
									<span class="pull-right" id="reportrange">
											<i class="fa fa-filter"  aria-hidden="true" style="font-size: 9px;"></i> 
											<span></span>
										</span>	
										<input type="hidden" id="date_val" name="date_val" />
									</th>
									<th> Trader </th>
									<th class="mob_numb"> Mobile </th>
									<th class="stat_blk"> Type 
										<span class="sts_pp">
											<i class="fa fa-filter" aria-hidden="true" style="font-size: 9px;"></i>
										</span>
										<div class="sts_fil_blk">         
											<div class="trd_lst">
												<div class="form-check chek_bx">
													<input class="form-check-input" type="checkbox" name="trader_opt" value="Agent" id="sta1">
													<label class="form-check-label" for="sta1">
													Agent
													</label>
												</div>
												<div class="form-check chek_bx">
													<input class="form-check-input" type="checkbox" name="trader_opt" value="Exporter" id="sta2">
													<label class="form-check-label" for="sta2">
													Exporter
													</label>
												</div>
											</div>
										</div>
									</th>
									<th colspan="bal_tbl"> Open Balance</th>
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
	jQuery.validator.addMethod("checkTrader", function(value, element) {
		//response = '';
		if($("input[name='trader_type']:checked").val() != "Agent")
			return true;
		else
		{	
			if($("#hid_td_id").val() != "")
			{
				trader_id = $("#hid_td_id").val();
				url1 = url+"api/traders/checkTrader/"+trader_id;
			}
			else
			{
				url1 = url+"api/traders/checkTrader";
			}			
				
            $.ajax({
                type: "POST",
                url: url1,
                data: "tname="+$('#trader_frm :input[name="tname"]').val(),
                dataType:"html",
                success: function(msg)
                {
					response = ( msg == 'true' ) ? true : false;
                }
            });
            return response;
		}
	});

	jQuery.validator.addMethod("checkMobile", function(value, element) {
		if($("#hid_td_id").val() != "")
		{
			trader_id = $("#hid_td_id").val();
			url1 = url+"api/traders/checkmobile/"+trader_id;
		}
		else
		{
			url1 = url+"api/traders/checkmobile";
		}
		$.ajax({
			type: "POST",
			url: url1,
			data: "tmobile="+$('#trader_frm :input[name="tmobile"]').val(),
			dataType:"html",
			success: function(msg)
			{
				response1 = ( msg == 'true' ) ? true : false;
			}
			});
		return response1;
	});

	$.validator.addMethod("pan", function(value, element)
    {
        return this.optional(element) || /^[A-Z]{5}\d{4}[A-Z]{1}$/.test(value);
	}, "Invalid Pan Number");
	
	$(document).on("click",".sbt_btn",function(){
		console.log($("input[name='trader_type']:checked").val());
		$('#trader_frm').validate({
			debug: false,
			rules: {
				tname: {
					required: function(element) {
						if($("input[name='trader_type']:checked").val() == "Agent")
							return true;
						else
							return false;
					},
					checkTrader:true,
				},
				tmobile: {
					required: true,
					minlength: 10,
					maxlength: 10,
					checkMobile:true,
				},
				tlocation: {
					required: true,
				},
				taadhar: {
					minlength:12,
				},
				tpan: {
					pan:true,
				},
				tbal_commas:{
					required: true,
				},
				firm_name:{
					required: function(element) {
						return $("input[name='trader_type']:checked").val() == "Exporter";
					}
				}
			},
			messages: {
				tname: {
					required: "Trader name is mandatory",
					checkTrader: 'TraderName is Already Taken',
				},
				tmobile: {
					required: "Mobile Number is mandatory",
					minlength: "Required valid Mobile number",
					maxlength: "Required valid Mobile number",
					checkMobile: 'Mobile Number Already Exists',
				},
				tlocation: {
					required: "Location is mandatory",
				},
				taadhar: {
					minlength:"Enter valid Aadhar Number",
				},
				tpan: {

				},
				tbal_commas:{
					required: 'Balance amount is madatory',
				},
				firm_name:{
					required: "Firm Name is manatory",
				}

			},
			showErrors: function(errorMap, errorList) {
				//var summary ='';
				//$.each(errorList, function() { summary += " * " + this.message + "<br/>"; });
				//$(".form-errors").html(summary);
				if(errorList.length)
				{
					err_msg = errorList[0].message;
					tagid = errorList[0].element.id;
					console.log('eer'+tagid);
					$("#snackbar").text(err_msg);
					$("#snackbar").addClass("show");
					setTimeout(function(){ $("#snackbar").removeClass("show"); }, 3000);
					$(tagid).parent().css("border", "1px solid red");
					$(tagid).focus();
				}
			},
			
			submitHandler: function(form) {
				formData = new FormData(trader_frm);
				var dynurl = url+"api/traders/add";
				var dynsucc = "Trader created successfully!";
				if($("#hid_td_id").val() != "")
				{ 
					dynurl = url+"api/traders/update"; 
					var dynsucc = "Trader updated successfully!"; 
				}
				
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
								closerHover: false,
  								stickerHover: false
							});	
							table.draw();	
							$("#trader_frm")[0].reset();
							$('.crt_link').trigger('click');				
							//setInterval('location.reload()', 2000);											
						}
						else{
							new PNotify({
								title: 'Error',
								text: 'Something went wrong, try again!',
								type: 'failure',
								closer: true,
								shadow: true
							});
						}					
					}
				});	
			}
		});
	});

	$(".mykey").on("keyup blur", function(){
		var tagid = $(this).attr("id");
		$('.mykey').parent().css("border", "");
		if($(this).val() != "")
		{			
			$('#'+tagid).parent().css("border", "1px solid green");
		}else{
			$('#'+tagid).parent().css("border", "1px solid red");
		}
	});
	
	$(".gst_block").hide();
	$(document).on("click",".bal_ll li",function(){
		$('.bal_ll li').removeClass('atc');
		$(this).addClass('atc');
	});
	$(document).on("click",".type_trd label",function(){		
		$("#hid_tname").val('');
		$("#hid_firmname").val('');
		
		$('.mykey').parent().css("border", "");
		var k = $("input[name='trader_type']:checked").val();

		if(k == 'Agent'){
			$('.firm_block').hide();
			$('.aadhar_block').show();
			$('.gst_block').hide();
			$(".aadhar_block").css({"float":"left"});
			$(".pan_block").css({"float":"right"});
			$(".chng_label").text("Trader Name");	
			
		}else if(k == 'Exporter'){
			$('.firm_block').show();
			$('.aadhar_block').hide();
			$('.gst_block').show();
			$(".pan_block").css({"float":"left"});
			$(".gst_block").css({"float":"right"});
			$(".chng_label").text("Contact Person");
			
		}
	});

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
			{ className: "text-capitalize", "targets": 2 },
			{ className: "mob_numb", "targets": 3 },
			{ className: "bal_tbl txt_rt", "targets": 5 },
			{ className: "txt_cnt", "targets": 6 }
		  ],
		'ajax': {
		   'url':url+'api/traders/get_traders',
		   'data': function(data){
			  // Read values				 
				var month_opt = $("input[name='month_opt']:checked").val();
				 var multi_trader = [];
				 var reportrange = $('#date_val').val();
				$.each($("input[name='trader_opt']:checked"), function(){
					multi_trader.push($(this).val());
				});				 
				  // Append to data			 
				  data.month_opt = month_opt;
				  data.trader_opt = multi_trader;
				  data.reportrange = reportrange;
			   },
		   	"dataSrc": function (json) {			   
			   	var acount = ecount = 0;
			   
			  	if(json.agent_count > 0){ $("#agent_count").html(addCommas(json.agent_count)); acount = json.agent_count; }
				else{ $("#agent_count").html(0); }

				if(json.exporter_count > 0){ $("#exporter_count").html(addCommas(json.exporter_count)); ecount = json.exporter_count}
				else{ $("#exporter_count").html(0);}
				
				$("#tot_count").html(addCommas(+acount+ +ecount));			
				return json.data;				
			}		
			
		}
	});

	$(document).on('click', '[data-toggle="popover"]', function() {
		var $this = $(this);
		if (!$this.data('bs.popover')) {
			$this.popover({
				html: true,
				content: function() {	
					return $('#popover-content').html();
				},
				trigger: 'focus',
				delay: { 
					hide: "100"
				},
			}).popover('show');
		}
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
	
	$(document).on("click",".del_yes",function(){		
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
						closer: true,
						shadow: true
					});	
					table.draw();
				}				
			}
		});
	});
		
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
        table.draw();
      }
    });
    $(document).on('click','.applyBtn',function(){
      table.draw();
    });
	
	$("input[name='month_opt']").on('click',function() {
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

	 $('.dataTables_length').html('<h2 class="create_hdg lng_hdg"> Trader List </h2>');

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

		var fl_cnt = $('.adds_blk');
		if (!fl_cnt.is(e.target) && fl_cnt.has(e.target).length === 0) 
		{
			$('.adds_blk ').removeClass('fl_wth');
		}
	});

	$('.crt_link').click(function(){
		$('.trade_create').toggleClass('sh_trade_create');
		$('.trd_cr_r').toggleClass('trd_cr_r_r');
		$(this).find('.btn').toggleClass('hide_blk');
		$('.cl_crt_bl').toggleClass('hide_blk');
		$('.sbt_btn').text('Submit');
		$("#hid_td_id").val('');
		document.getElementById("trader_frm").reset(); 
		// reload action
		$('.firm_block').hide();
		$('.aadhar_block').show();
		$('.gst_block').hide();
		$(".aadhar_block").css({"float":"left"});
		$(".pan_block").css({"float":"right"});
		$(".chng_label").text("Trader Name");	
		
		$('.rad_btns').find('.radio_blk').removeClass('checkd');
		$( ".rad_btns").children(".radio_blk").first().addClass('checkd');
		//$(this).parent('.radio_blk').addClass('checkd');
	});

	$('body').css('display', 'block');

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
			res= JSON.parse(response);
			if(res.status == "success")
			{
				$('.sbt_btn').text('Update');
				$('input:radio[name=trader_type]').filter('[value='+res.data.trader_type+']').attr('checked', true);
				$(".cre_inp").addClass("inp_ss");
				if(res.data.trader_type == "Exporter"){
					$(".chng_label").text("Contact Person");
					$(".pan_block").css({"float":"left"});
					$(".gst_block").css({"float":"right"});
					$(".aadhar_block").hide(); $(".gst_block").show();
					$(".firm_block").show(); $("#firm_name").val(res.data.firm_name); 
					$("#tname").val(res.data.contact_person);	$("#tgst").val(res.data.gst);
					$("#hid_tname").val('');
					$("#hid_firmname").val(res.data.firm_name);
				}else{
					$(".chng_label").text("Trader Name");
					$(".pan_block").css({"float":"right"});
					$(".aadhar_block").show(); $(".gst_block").hide();
					$(".firm_block").hide(); $("#firm_name").val(''); 
					$("#tname").val(res.data.full_name); $("#tgst").val('');
					$("#hid_tname").val(res.data.full_name);
					$("#hid_firmname").val('');
				}
				
				$("#tmobile").val(res.data.mobile_no);
				$("#tlocation").val(res.data.location);
				$("#taadhar").val(res.data.aadhar_no);
				$("#tpan").val(res.data.pan_no);
				$("#tbal_commas").val(addCommas(res.data.balance));
				$("#tbal").val(res.data.balance);
				$("#pterm").val(res.data.payment_terms);				
			}
		}
	});
	
}


function amount_with_commas(addoredit)
{
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
}

$('.dataTables_paginate').html('<a href="#" title=""> Show More </a>');
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