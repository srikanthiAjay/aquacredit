$(document).ready(function() {
	
	//$.validator.setDefaults({ ignore: ":hidden:not(select)" }) //for all select
	//OR for all select having class .chosen-select
	//$.validator.setDefaults({ ignore: ":hidden:not(.chosen-select)" });
	$.validator.setDefaults({ ignore: [] });
	
	getadminbanks(); getaloantype(); getadminbankslist();
	
	$('#crop_opt').select2();
	$('#bank_opt').select2();
	$('#crop_opt_edit').select2();
	$('#bank_opt_edit').select2();  
	$('#admin_bank').select2();  
	$('#loan_type').select2();  
	
	//alert($("input[name='month_opt']:checked").val());	
	
	$("#crop_opt").val('');
	$("#bank_opt").val('');	
	
	/* $('#users_opt').multiselect({
		enableFiltering: true
	}); */
	
	
	$('#skey').blur(function(){
		//var usercode = $(this).val();		
		var usercode = $("#select_usercode").val().trim();
		if(usercode != "")
		{
			getusercrops(usercode,'add');
			getuserbanks(usercode,'add');
		}else{
			var opt = '<option value="">-- Select user first --</option>';
			$("#crop_opt").html(opt); $("#crop_opt").val('');		
			$("#bank_opt").html(opt); $("#bank_opt").val('');			
			//document.getElementById("crop_opt").fstdropdown.rebind();
			//document.getElementById("bank_opt").fstdropdown.rebind();
			
		}			
	});
	
	/* $('#loan_amt').keyup(function(){
		var loan_amt = $(this).val();		
		var amt_word = convertNumberToWords(loan_amt);
		$('.amon_text').html(amt_word);
	}); */

    $('.lnk_typ.ban_trns').click(function(){
		
        $(this).addClass('act_type');
        $(this).siblings('.cash_trns').removeClass('act_type');
        //$(this).parent().siblings('.ove_auto').find('.lon_typ').removeClass('hide_blk');
		$('#bank_opt').addClass('required');
		$('#bank_opt_edit').addClass('required');
		
		$(".lon_typ").show();
		$("input[name='act_types']:checked").val('bank');
		$("input[name='act_types_edit']:checked").val('bank');
		
    });
    $('.lnk_typ.cash_trns').click(function(){
        $(this).addClass('act_type');
        $(this).siblings('.ban_trns').removeClass('act_type');
        //$(this).parent().siblings('.ove_auto').find('.lon_typ').addClass('hide_blk');
		$('#bank_opt').removeClass('required');
		$('#bank_opt_edit').removeClass('required');
		$(".lon_typ").hide();
		$("input[name='act_types']:checked").val('cash');
		$("input[name='act_types_edit']:checked").val('cash');
		
    });
	
	
	//Add Loan Form submit
	$("#loanfrm").submit(function(e) {			
		e.preventDefault();
		
	}).validate({
		rules:{
			
			skey:
			{
				required: true
			},
			crop_opt:
			{
				required: true
			},
			/* bank_opt:
			{
				required: true
			},	 */		
			loan_amt_commas:{
				required: true,
				maxlength:8	
			},
			/* loan_amt:{
				required: true,
				number: true,
				//decimal: true,
				min: 1,
				max: 999999,
				minlength:1,
				maxlength:6				
			}, */
			crop_opt:{
				required: true
			}
		},
		messages: {
			skey:
			{
				required: "Please select user"
			},
			crop_opt:
			{
				required: "Please select crop"
			},
			bank_opt:
			{
				required: "Please select bank"
			},
			loan_amt_commas:
			{
				required: "Please enter loan amount"
			}
		},
		/* errorElement : 'div',
		errorLabelContainer: '.errorTxt', */
		submitHandler: function(form) 
		{	
			formData = new FormData(form);		
			
			$.ajax({
				url: url+"api/loans/add",
				data: formData,
				type:'POST',
				contentType: false,
				processData: false,
				enctype: 'multipart/form-data',
				datatype:'json',
				success : function(response)
				{						
					res= JSON.parse(response);
					if(res.status == 'success')
					{	
						new PNotify({
							title: 'Success',
							text: "Loan created successfully!",
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

	// $('.lons_hdg_blk').click(function(){
	//       $('.lns_sub_blk').toggleClass('show_blk');
	//     });
	
	$(".updt_btn").click(function(){
		$("#admin_bank").removeClass('required');
		$("#loan_type").removeClass('required');
		$("#start_date").removeClass('required');
		$("#end_date").removeClass('required');
		$("#roi").removeClass('required');
		$("#hid_appove").val(0);
		//$('#loanfrm_edit').submit();
	});
	
	//Edit Loan Form submit
	$("#loanfrm_edit").submit(function(e) {			
		e.preventDefault();
		
	}).validate({
		rules:{
			
			skey_edit:
			{
				required: true
			},
			crop_opt_edit:
			{
				required: true
			},
			/* bank_opt_edit:
			{
				required: true
			},	 */		
			loan_amt_commas_edit:{
				required: true,
				maxlength:8	
			},
			/* loan_amt_edit:{
				required: true,
				number: true,
				//decimal: true,
				min: 1,
				max: 999999,
				minlength:1,
				maxlength:6				
			}, */
			crop_opt_edit:{
				required: true
			}
		},
		messages: {
			skey_edit:
			{
				required: "Please select user"
			},
			crop_opt_edit:
			{
				required: "Please select crop"
			},
			bank_opt_edit:
			{
				required: "Please select bank"
			},
			loan_amt_commas_edit:
			{
				required: "Please enter loan amount"
			}
		},
		/* errorElement : 'div',
		errorLabelContainer: '.errorTxt', */
		submitHandler: function(form) 
		{	
			formData = new FormData(form);			
			/* formData.append('hid_lid', $("#hid_lid").val());
			formData.append('hid_crop_id', $("#hid_crop_id").val());
			formData.append('hid_bank_id', $("#hid_bank_id").val()); */
			
			$.ajax({
				url: url+"api/loans/update",
				data: formData,
				type:'POST',
				contentType: false,
				processData: false,
				enctype: 'multipart/form-data',
				datatype:'json',
				success : function(response)
				{						
					res= JSON.parse(response);
					if(res.status == 'success')
					{	
						new PNotify({
							title: 'Success',
							text: "Loan updated successfully!",
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
	
	// Apporve 
	$(".approv_btn").click(function(){
		$("#admin_bank").addClass('required');
		$("#loan_type").addClass('required');
		$("#start_date").addClass('required');
		$("#start_date").addClass('required');
		$("#roi").addClass('required');
		$("#hid_appove").val(1);
		$('#loanfrm_edit').submit();
	});
	$("#loanfrm_cnf").submit(function(e) {			
		e.preventDefault();
		
	}).validate({
		rules:{			
			
			admin_bank:
			{
				required: true
			},
			loan_type:
			{
				required: true
			},
			start_date:
			{
				required: true
			},
			end_date:
			{
				required: true
			},
			roi:
			{
				required: true
			},		
		},
		messages: {
			
			admin_bank:
			{
				required: "Please select admin bank"
			},
			loan_type:
			{
				required: "Please select loan type"
			},
			start_date:
			{
				required: "Please select start date"
			},
			end_date:
			{
				required: "Please select end date"
			},
			roi:
			{
				required: "Please enter rate of interest"
			}
			
		},		
		submitHandler: function(form) 
		{	
			formData = new FormData(form);			
			formData.append('hid_lid', $("#hid_lid").val());
			
			$.ajax({
				url: url+"api/loans/approve",
				data: formData,
				type:'POST',
				contentType: false,
				processData: false,
				enctype: 'multipart/form-data',
				datatype:'json',
				success : function(response)
				{						
					res= JSON.parse(response);
					if(res.status == 'success')
					{	
						new PNotify({
							title: 'Success',
							text: "Loan approved successfully!",
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
	
	$('.rej_btn').click(function(){
		//alert($("#hid_lid").val());
		$.ajax({		
		url: url+"api/loans/reject",
		data: {lid : $("#hid_lid").val()},
		type:'POST',		
		datatype:'json',
		success : function(response){
			
			//alert(response);
			res= JSON.parse(response);		
			
			if(res.status == 'success')
			{	
				new PNotify({
					title: 'Success',
					text: "Loan rejected successfully!",
					type: 'success',
					shadow: true
				});												
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
		
	});

	 $('.stat_Reg, .bnk_dl_li').popover({
	  trigger: 'focus'
	});

    /* var tables = $('#loan_lst_tbl_pend').DataTable({
      "ordering": false,
       language: {
        searchPlaceholder: "Search Loan Details",
        search: "",
        "dom": '<"toolbar">frtip'
		}
	}); */
	
	
	var tables = $('#loan_lst_tbl_pend').DataTable({
		'processing': true,
		'serverSide': true,
		'serverMethod': 'post',
		"ordering": false,
		    language: {
			searchPlaceholder: "Search Loan Details",
			search: "",
			"dom": '<"toolbar">frtip'
			}, 
		"columnDefs": [
			{ className: "tbl_check", "targets": 0 },
			{ className: "id_td", "targets": 1 },
			{ className: "app_date", "targets": 2 },
			{ className: "usr_dtl", "targets": 3 },
			{ className: "tran_type", "targets": 5 },
			{ className: "loan_type_td", "targets": 6 },
			{ className: "loan_amnt", "targets": 7 },
			{ className: "txt_cnt stat_blk", "targets": 8 },
			{ className: "act_ms", "targets": 9 }			
		  ],
		//"order": [[ 3, 'desc' ], [ 0, 'asc' ]],
		"order": [[ 1, 'desc' ]],
		'ajax': {
		   'url':url+'api/loans/getloans',
		   'data': function(data){
			  // Read values
				var multi_status = [];
				$.each($("input[name='status_opt']:checked"), function(){

					multi_status.push($(this).val());

				});
				
			  var month_opt = $("input[name='month_opt']:checked").val();
			  var tabval = $("#hid_tabval").val();
			  var status_opt = multi_status;
			  // Append to data
			  data.month_opt = month_opt;
			  data.tabval = tabval;
			  data.status_opt = status_opt;
		   },
		   "dataSrc": function (json) {		   
			
			  var totcompleted = +json.approved+ +json.rejected;			   
			  //var tot_amt = +json.approved+ +json.rejected;			   
			  $(".pending_amt").html('₹'+addCommas(json.pending_amt));
			  $(".tot_amt").html('₹'+addCommas(json.pending_amt));
			  $("#draft_count").html('Draft List ('+json.pending+')');
			  $("#except_pending").html('Completed List ('+totcompleted+')');
			  $(".tot_loans").html('Loans('+json.tot_rec+')');
			  $(".pending_count").html(json.pending);
			  $(".approved_count").html(json.approved);
			  $(".rejected_count").html(json.rejected);
				setInterval(function(){ 
					$('.act_icns').popover({
						html: true,
						content: function() {
						  return $('#popover-contents').html();
						}
					}); 
				}, 2000);
			 
				return json.data;
				
			},		
			'columns': [
			   { data: '' }, 
			   { data: 'loan_id' }, 
			   { data: 'loan_status_date' },
			   { data: 'user_id' },
			   { data: 'crop_id' },
			   { data: 'transfer_type' },
			   { data: 'loan_type' },
			   { data: 'loan_amt' },
			   { data: '' },
			   { data: '' },
			]
		}
	});
	
	tables.columns( [ 2, 6, 8 ] ).visible( false, false, false );
	tables.columns.adjust().draw( false );
		
    $('.edt_bl_lnk').click(function(){
        $('.app_pop_tbl').toggleClass('disb_sel');
        $('.ds_as_type').toggleClass('show_blk');
    });   

    $('.reject_tr').click(function(){
      $(this).addClass('bdr_t_1');
      $('.rej_list').toggleClass('hide_blk');
      $('.cmp_list').addClass('hide_blk');
    });
    $('.comp_blk_tr').click(function(){
      $('.reject_tr').removeClass('bdr_t_1');
      $('.cmp_list').toggleClass('hide_blk');
      $('.rej_list').addClass('hide_blk');
    });

	$('#loan_lst_tbl_pend_wrapper .dataTables_length').html('<ul class="tabs_tbl"><li class="act_tab drft_cl"> <span id="draft_count">Draft list (0)</span> </li><li class="comp_cl"> <span id="except_pending">Completed list (0) </span> </li></ul> <span class="tbl_btn">  </span>');
	// <a href="#" class="appr_all"> Approve All </a>
	$(".loan_btm div.toolbar").html('<b>SSS</b>');
    $('.loan_btm a.toggle-vis').on( 'click', function (e) {
        $(this).parent().toggleClass('act');
        e.preventDefault();
        var column = tables.column( $(this).attr('data-column') );
        column.visible( ! column.visible() );
    });

    $('.dataTables_paginate').html('<a href="#" title=""> Show More </a>');
    $('.ad_nt').click(function(){
		$('.pp_note').toggleClass('show_blk');
	});  

    $('.act_icn').popover({
		html: true,
		content: function() {
		  return $('#popover-content').html();
		}
	});

    $('.tbl_check').popover({
		html: true,
		content: function() {
		  return $('#popover-tbl').html();
		}

	});
	

	$('.comp_cl').click(function(){			
		
		$("#hid_tabval").val(1);
		$('.tabs_tbl').addClass('cmp_ul');
		$(this).addClass('act_tab');
		$('.drft_cl').removeClass('act_tab');		
		//$(row).addClass("label-warning");
		//$('tr').addClass('rej_list');
		//$('tr').removeClass('cmp_list');
		tables.columns( [ 0, 9 ] ).visible( false, false );
		tables.columns( [ 1, 2, 3, 4, 5, 6, 7, 8 ] ).visible( true, true, true, true, true, true, true, true );
		tables.columns.adjust().draw( false );
		
		 /* setTimeout(function(){ 
		
			$('.tbl_check, .usr_sub_dtl, .acrs_td').addClass('hide_blk');
			$('.drft_cl').removeClass('act_tab');
			$('.stat_blk').removeClass('hide_blk');
			$('.app_date').removeClass('hide_blk');
			$('.tbl_btn').addClass('hide_blk');
			$('.act_ms').addClass('hide_blk');
			$('.comp_blk_tr, .reject_tr').removeClass('hide_blk');
			$('.loan_type_td').removeClass('hide_blk');
					
		}, 100); */
		
		
		
	});
	$('.drft_cl').click(function(){
		
		$("#hid_tabval").val(0);				
		$('.tabs_tbl').removeClass('cmp_ul');
		$(this).addClass('act_tab');
		$('.comp_cl').removeClass('act_tab');
		//$('tr').addClass('cmp_list');
		//$('tr').removeClass('rej_list');
		tables.columns( [ 2, 6, 8 ] ).visible( false, false, false );
		tables.columns( [ 0, 1, 3, 4, 5, 7, 9 ] ).visible( true, true, true, true, true, true, true );  
		tables.columns.adjust().draw( false );
		 /* setTimeout(function(){ 
		
			$('.tbl_check, .usr_sub_dtl, .acrs_td').removeClass('hide_blk');
			$('.loan_type_td').addClass('hide_blk');        
			$('.stat_blk').addClass('hide_blk');
			$('.app_date').addClass('hide_blk');
			$('.act_ms').removeClass('hide_blk');
			$('.rej_list, .tbl_btn').removeClass('hide_blk');
			$('.cmp_list').removeClass('hide_blk');
			$('.comp_blk_tr, .reject_tr').addClass('hide_blk');
					
		}, 500);	 */
		
	});

	$('.bnk_icn').click(function(){
		$('.bnk_ll_blk').toggleClass('show_blk');
		$('.create_loan_module').toggleClass('show_blk');
		$('.loan_create .fa-university, .loan_create .fa-times').toggleClass('show_blk');
		var swiper = new Swiper('.swiper-container', {
			pagination: {
			el: '.swiper-pagination',
			dynamicBullets: true,
			},
		});

	});
	$('.amnt input, .ln_amn_blk input').popover();
	$('.actvty .anlat_bb').popover({
		html: true,
		content: function() {
		return $('#popover-ana').html();
		}
	});

	$('.crt_link').click(function(){
		$('.trade_create').toggleClass('sh_trade_create');
		$('.trd_cr_r').toggleClass('trd_cr_r_r');
		$(this).find('.btn').toggleClass('hide_blk');
		$('.cl_crt_bl').toggleClass('hide_blk');
		// $(this).toggleClass('crt_link');
	});

	$(document).on("click", ".edt", function() {
	   $('#apr_loan').modal();
	});

	$(document).on("click", ".appr_all", function() {
	   $('#apr_loans').modal();
	});
	
	// $(document).on("click", ".reject_loan", function() {
	//   // alert('ss');
	//    $('#rej_loan').modal();

	// });

	$(document).on("click", ".del", function() {
	  // alert('ss');
	   $('#delete_user').modal();
	});
});
function edit_loan(lid)
{
	$("#hid_lid").val(lid);
	$.ajax({		
		//url: url+"api/loans/index/"+lid,
		url: url+"api/loans/loandetails/"+lid,
		data: {},
		type:'POST',		
		datatype:'json',
		success : function(response){
			
			//alert(response);
			res= JSON.parse(response);
			//alert(res.data.transfer_type);
			if(res.data.transfer_type == "bank")
			{
				$('.lnk_typ.ban_trns').addClass('act_type');
				$('.lnk_typ.cash_trns').removeClass('act_type');
				$('#bank_opt_edit').addClass('required');
				$('.lon_typ').show();
				
			}else{
				$('.lnk_typ.ban_trns').removeClass('act_type');
				$('.lnk_typ.cash_trns').addClass('act_type');
				$('#bank_opt_edit').removeClass('required');
				$('.lon_typ').hide();				
			}
			
			$("input[name='act_types_edit']:checked").val(res.data.transfer_type);		
			$("#skey_edit").val(res.data.uname);
			$("#act_types_edit").val(res.data.transfer_type);
			$("#loan_amt_commas_edit").val(res.data.loan_amt);
			$("#loan_amt_edit").val(res.data.loan_amt);
			$("#hid_crop_id").val(res.data.crop_id);
			$("#hid_bank_id").val(res.data.user_bank_id);
			$("#selectuser_id_edit").val(res.data.user_id);
			$("#select_usercode_edit").val(res.data.usercode);
			
			$("#hid_acivity_id").val(res.data.la_id);			
			$("#start_date").val(res.data.start_date);			
			$("#end_date").val(res.data.end_date);			
			$("#roi").val(res.data.rate_of_interest);			
			$("#ref_no").val(res.data.ref_no);			
			$('#admin_bank option:eq('+res.data.admin_bank+')').attr('selected', true)
			$('#loan_type option:eq('+res.data.loan_type+')').attr('selected', true)
			$('#admin_bank').select2();
			$('#loan_type').select2();
			
			$(".crop.selectVal").html(res.data.crop_loc);
			getusercrops(res.data.usercode,"edit");			
			getuserbanks(res.data.usercode,"edit");	
			amount_with_commas("edit");
		}
	});
}
function loan_upd(lid)
{
	edit_loan(lid);
}
$( function() {
	$( "#skey" ).autocomplete({
	  source: function( request, response ) {
			$('#selectuser_id').val('');
			$('#select_usercode').val('');
			$("#crop_opt").val('');
			$("#bank_opt").val('');
	   // Fetch data
	   $.ajax({
		url: url+"api/users/searchusers",
		type: 'post',
		dataType: "json",
		data: {
		 search: request.term
		},
		success: function( data ) {
			
			response(data);				 
		}
	   });
	  },
	  select: function (event, ui) {
	   // Set selection
	   $('#skey').val(ui.item.label); // display the selected text
	   $('#selectuser_id').val(ui.item.value); // save selected id to input
	   $('#select_usercode').val(ui.item.usercode); // save selected id to input
	   return false;
	  }
	 });
	 
	 //Edit
	 $( "#skey_edit" ).autocomplete({
	  source: function( request, response ) {
			$('#selectuser_id_edit').val('');
			$('#select_usercode_edit').val('');
			$("#crop_opt_edit").val('');
			$("#bank_opt_edit").val('');
	   // Fetch data
	   $.ajax({
		url: url+"api/users/searchusers",
		type: 'post',
		dataType: "json",
		data: {
		 search: request.term
		},
		success: function( data ) {
			
			response(data);	 
		}
	   });
	  },
	  select: function (event, ui) {
	   // Set selection
	   $('#skey_edit').val(ui.item.label); // display the selected text
	   $('#selectuser_id_edit').val(ui.item.value); // save selected id to input
	   $('#select_usercode_edit').val(ui.item.usercode); // save selected id to input
	   return false;
	  }
	 });
});

function getusercrops(usercode,addoredit)
{
	var aeval = hidcrop = "";
	if(addoredit == "edit"){ aeval = "_edit"; hidcrop = $("#hid_crop_id").val();}
	$.ajax({		
		url: url+"api/UserCrops/index/"+usercode,
		data: {},
		type:'POST',		
		datatype:'json',
		success : function(response){
			
			//alert(response);
			res= JSON.parse(response);				
			//alert(res.data.length);
			
			var usercode = $('#select_usercode'+aeval).val();
			var sel = "";
			if(usercode != "")
			{
				var opt = '<option value="">-- Select Crop --</option>';
				if(res.data.length > 0)
				{
					$.each(res.data, function(index, crop) {
						if(crop.id == hidcrop){ sel = "selected"; }else{ sel = "";}
						opt += '<option value="'+crop.id+'" '+sel+' >'+crop.crop_loc+'</option>';
					});
				}
			}else{
				var opt = '<option value="">-- Select user first --</option>';
			}
			$("#crop_opt"+aeval).html(opt);
			//$("#crop_opt"+aeval).select2('refresh');
			//document.getElementById("crop_opt"+aeval).fstdropdown.rebind();
		}
	});
}

function getuserbanks(usercode,addoredit)
{
	var aeval = hidbank = "";
	if(addoredit == "edit"){ aeval = "_edit"; hidbank = $("#hid_bank_id").val(); }
	$.ajax({		
		url: url+"api/UserBanks/index/"+usercode,
		data: {},
		type:'POST',		
		datatype:'json',
		success : function(response){
			
			//alert(response);
			res= JSON.parse(response);				
			//alert(res.data.length);
			
			var usercode = $('#select_usercode'+aeval).val().trim();
			var sel = "";
			if(usercode != "")
			{
				var opt = '<option value="">-- Select Bank --</option>';
				if(res.data.length > 0)
				{
					$.each(res.data, function(index, bank) {
						if(bank.id == hidbank){ sel = "selected"; }else{ sel = "";}
						opt += '<option value="'+bank.id+'" '+sel+' >'+bank.bank_name+' - '+bank.ac_number+'</option>';
					});
				}
			}
			else{
				var opt = '<option value="">-- Select user first --</option>';
			}
			$("#bank_opt"+aeval).html(opt);			
			//document.getElementById("bank_opt"+aeval).fstdropdown.rebind();
		}
	});
}
function getadminbankslist()
{
	$.ajax({		
		url: url+"api/Banks",
		data: {},
		type:'POST',		
		datatype:'json',
		success : function(response){
			
			//alert(response);
			res= JSON.parse(response);				
			//alert(res.data.length);	
			
			var opt = '<li><div class="bank_logo"> <img src="http://3.7.44.132/aquacredit/assets/images/cash_account.png" alt="" title=""> </div>     <div class="bank_mny"><div class="bank_bal"> ₹ 0 </div><div class="accont_numb">Cash Account</div></div></li>';
			if(res.data.length > 0)
			{
				var bank_icn = "";
				$.each(res.data, function(index, bank) {
					
					if(bank.bank_name == "SBI"){  bank_icn = 'sib_icn.png'; }
					else if(bank.bank_name == "HDFC"){  bank_icn = 'hdfc_icn.png'; }
					else if(bank.bank_name == "ICICI"){  bank_icn = 'icici_icn.png'; }
					opt += '<li><div class="bank_logo"> <img src="http://3.7.44.132/aquacredit/assets/images/'+bank_icn+'" alt="" title=""> </div><div class="bank_mny"><div class="bank_bal"> ₹ '+addCommas(bank.avail_amount)+' </div><div class="accont_numb">'+bank.account_no+'</div></div></li>';
				});
			}
			
			$(".bank_lst_blk").html(opt);			
			//document.getElementById("admin_bank").fstdropdown.rebind();
		}
	});
}
function getadminbanks()
{
	$.ajax({		
		url: url+"api/Banks",
		data: {},
		type:'POST',		
		datatype:'json',
		success : function(response){
			
			//alert(response);
			res= JSON.parse(response);				
			//alert(res.data.length);
			
			//var usercode = $('#selectuser_id').val().trim();
			
			var opt = '<option value="">-- Select Admin Bank --</option>';
			if(res.data.length > 0)
			{
				$.each(res.data, function(index, bank) {
					
					opt += '<option value="'+bank.bank_id+'">'+bank.bank_name+' - '+bank.account_no+'</option>';
				});
			}
			
			$("#admin_bank").html(opt);			
			//document.getElementById("admin_bank").fstdropdown.rebind();
		}
	});
}

function getaloantype()
{
	$.ajax({		
		url: url+"api/LoanTypes",
		data: {},
		type:'POST',		
		datatype:'json',
		success : function(response){
			
			//alert(response);
			res= JSON.parse(response);
			
			//var usercode = $('#selectuser_id').val().trim();
			
			var opt = '<option value="">-- Select Loan Type --</option>';
			if(res.data.length > 0)
			{
				$.each(res.data, function(index, loan) {
					
					opt += '<option value="'+loan.loan_type_id+'">'+loan.loan_type+'</option>';
				});
			}
			
			$("#loan_type").html(opt);			
			//document.getElementById("loan_type").fstdropdown.rebind();
		}
	});
}
function addCommas(x) {
	x=x.toString();
	var lastThree = x.substring(x.length-3);
	var otherNumbers = x.substring(0,x.length-3);
	if(otherNumbers != '')
	lastThree = ',' + lastThree;
	//var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
	var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/, ",") + lastThree;

	return res;
}

function amount_with_commas(addoredit)
{
	var aeval = "";
	if(addoredit == "edit"){ aeval = "_edit";}
	var textbox = '#loan_amt_commas'+aeval;
	var hidden = '#loan_amt'+aeval;

	//$(textbox).keyup(function () {
	  
	var num = $(textbox).val();
	var comma = /,/g;
	num = num.replace(comma,'');
	$(hidden).val(num);
	var numCommas = addCommas(num);
	$(textbox).val(numCommas);
	var amt_word = convertNumberToWords(num);
	if(amt_word != undefined){
		$('.amon_text'+aeval).html(amt_word);
	}
  //});
}
	
