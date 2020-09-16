$(document).ready(function() {
	
	getadminbranches('both');
	var instance = 0;
	dynamicAutocomplte(instance);
	function dynamicAutocomplte(id_val){	 
		 
		$("#p"+id_val).autocomplete({
			//source: url+"api/users/searchusers",
			source: function( request, response ) {		
				
			var dyn_url = url+"api/products/searchproducts";
			//var utype = $("input[name='user_type']:checked").val();
			// Fetch data	   
			$.ajax({
			url: dyn_url,
			type: 'post',
			dataType: "json",
			data: {
			 search: request.term
			},
			success: function( data ) {  

				response( $.map( data, function( result ) {  

					return {  

						label: result.label,
						value: result.value,
						pid: result.pid
					}  

				}));  

			}  
		   });
		  },
		  select: function (event, ui) {
			  
			  $('.table_input').css("border", "");
			  
			  var this_id = $(this).attr("id");
			  
			  $("#hid_"+this_id).val(ui.item.pid);
			 var prod_arry = $("input[name='prod[]']").map(function(){return $(this).val();}).get();
			  console.log(prod_arry);
			  console.log($.inArray( ui.item.label, prod_arry ));
			 if($.inArray( ui.item.label, prod_arry ) > -1)
			 {
				 //alert("Exists!");
				 $(this).val('');
				 return form_validation(1,"Product already selected!",$(this).attr("id"));
			 }
			$("#"+this_id).val(ui.item.value);
		   //return false;
		  }
		  
		 }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {  

		   return $( "<li></li>" )  

			   .data( "item.autocomplete", item )  

			   .append( "<a>" + item.label+ "</a>" )  

			   .appendTo( ul );  

		};
	}
	
	$('input[name="prod[]"]').on('keyup', function(){
		//alert($(this).attr("id"));
		//$("#"+$(this).attr("id")).val('');
		$("#hid_"+$(this).attr("id")).val('');
		
	});
	$(document).on("click", ".purc_btn", function() {
		$('#create_module').modal();
	});

	var tables = $('#pur_lst_tbl').DataTable({
		"ordering": false,
		language: {
		searchPlaceholder: "Search stock transport details",
		search: "",
		"dom": '<"toolbar">frtip'
		}
	});

	$('#pur_lst_tbl_wrapper .dataTables_length').html('<h2 class="create_hdg lng_hdg">  Stock Transport List </h2>');

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
	
	$(document).on("click", ".edt", function() {
		$('#edt_module').modal();
	});

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
	
	// Add dynamic rows
	//$(document).on("focus",'#stk tr:last-child td:last-child',function() {
	$(document).on("keyup",'#stk tr:last-child td:first-child input',function() {
	//$(document).on("blur",'#stk tr:last-child td:eq(1)',function() {
        //append the new row here.
		//var input_id = $(this).children().attr("id");
		//var input_val = $(this).children().val();
		var input_val = $(this).val();
		if(input_val != "")
		{
			instance++;
			var table = $("#stk");
			table.append('<tr>\
			<td> <input type="text" id="p'+instance+'" name="prod[]" class="skey table_input" value="" placeholder="Select Product" /> <input type="hidden" id="hid_p'+instance+'" name="hid_prod[]" value="" /></td>\
			<td class="txt_cnt qty_pp"><input type="text" id="'+instance+'" name="qty[]" value="" class="allownumericwithoutdecimal table_input" /></td>\
			<td class="red_clr act_pp txt_cnt"> <i class="fa fa-trash del_btn" aria-hidden="true"></i></td>\
			</tr>');
			
			// Dynamic autocomplete-input			
			dynamicAutocomplte(instance);			
		}
    });
	
	//$('#stk').on('click', 'input[type="button"]', function () {
	$('#stk').on('click', '.del_btn', function () {
		//alert($(this).parents('table').find('tr').length);
		if ($(this).parents('table').find('tr').length >  2) { 
			$(this).closest('tr').remove();
		 }else{			
			return form_validation(1,"Must have at least one product!",$(this).attr("id"));
		}
		//$(this).closest('tr').remove();
	});	
	
	$("#src_branch_li").on("change",function() {
		
		$('.mykey').parent().css("border", "");
		var src_id = $('input[name="src_branch"]:checked').attr("id");
		getadminbranches(src_id);
	});
	
	$("#dst_branch_li").on("change",function() {
		
		$('.mykey').parent().css("border", "");
		/* var dst_id = $('input[name="dst_branch"]:checked').attr("id");
		getadminbranches(dst_id); */
	});
	
	//$(".sb_btn").on("click",function() {
	$('#stock_frm').on('submit', function(){
		//alert($('input[name="src_branch"]:checked').val());
		$('.mykey').parent().css("border", "");
		var err = 0;		
		var src_val = $('input[name="src_branch"]:checked').val();
		var dst_val = $('input[name="dst_branch"]:checked').val();
		if(src_val == undefined){
			err = 1; err_msg = "Please select source branch!"; 
			tagid = ".src_block"; 
			return form_validation(err,err_msg,tagid);
		}
		if(dst_val == undefined){
			err = 1; err_msg = "Please select destination branch!"; 
			tagid = ".dst_block"; 
			return form_validation(err,err_msg,tagid);
		}
		$("#stock_frm input").each(function(){
			
			if($(this).val() == ''){
				err = 1;
				var this_id = $(this).attr("id");
				
				if(this_id != "trans_chrg" && this_id != "upload_chrg" && this_id != "loading_chrg" )
				{
					var split_id = this_id.split("_");
					//alert(split_id[0]);
					//$("#"+this_id).css("border", "1px solid red");
					//$(this).css("border", "1px solid red");
					if(split_id[0] == "hid")
					{
						$("#"+split_id[1]).css("border", "1px solid red");
						return table_validation(err,"Please enter Product and Quantity!","#"+split_id[1]);
					}else{
						$(this).css("border", "1px solid red");
						return table_validation(err,"Please enter Product and Quantity!","#"+$(this).attr('id'));
					}
				}else if(this_id == "trans_chrg")
				{
					$(this).css("border", "1px solid red");
					return table_validation(err,"Please enter transport charges!","#"+$(this).attr('id'));
					
				}else if(this_id == "upload_chrg")
				{
					$(this).css("border", "1px solid red");
					return table_validation(err,"Please enter upload charges!","#"+$(this).attr('id'));
					
				}else if(this_id == "loading_chrg")
				{
					$(this).css("border", "1px solid red");
					return table_validation(err,"Please enter loading charges!","#"+$(this).attr('id'));
				}					
								
			}
		});
		//var values = $("input[name='prod[]']").map(function(){return $(this).val();}).get();
		//console.log(values);
		if(err == 0)
		{
			formData = new FormData(stock_frm);
			var dynurl = url+"api/stockTransfer/add";
			var dynsucc = "Stock transfered successfully!";
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
					alert(response);
					res= JSON.parse(response);
					if(res.status == 'success')
					{
						new PNotify({
							title: 'Success',
							text: dynsucc,
							type: 'success',
							shadow: true
						});
						
						//tables.ajax.reload();
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
function form_validation(err,err_msg,tagid)
{
	$('.mykey').parent().css("border", "");
	$("#snackbar").text(err_msg);
	$("#snackbar").addClass("show");
	setTimeout(function(){ $("#snackbar").removeClass("show"); }, 3000);
	$(tagid).parent().css("border", "1px solid red");
	//$("#tname").css("border", "1px solid red");
	$(tagid).focus();
	return false;
}
function table_validation(err,err_msg,tagid)
{
	$('.table_input').css("border", "");
	$("#snackbar").text(err_msg);
	$("#snackbar").addClass("show");
	setTimeout(function(){ $("#snackbar").removeClass("show"); }, 3000);
	$(tagid).css("border", "1px solid red");
	//$("#tname").css("border", "1px solid red");
	$(tagid).focus();
	return false;
}
function getadminbranches(src_or_dst)
{
	//alert(src_or_dst);
	var res_arr = src_or_dst.split('_');
	var brc_type = res_arr[0];
	
	$.ajax({		
		url: url+"api/Branch/getByAdminBranch",
		data: {},
		type:'POST',		
		datatype:'json',
		success : function(response){
			
			//alert(response);
			res= JSON.parse(response);				
			//alert(res.data.length);
			
			//var usercode = $('#selectuser_id').val().trim();
			
			//var opt = '<option value="">-- Select Admin Bank --</option>';
			var src_opt = dst_opt = '';
			if(res.data.length > 0)
			{
				//alert(brc_type);
					
				if(brc_type == "both"){
					$.each(res.data, function(index, branch) {
						src_opt += '<div class="form-check src_branch'+index+'">\
						<input class="form-check-input" type="radio" name="src_branch" id="src_branch'+index+'" value="'+branch.branch_id+'">\
						<label class="form-check-label" for="src_branch'+index+'">'+branch.branch_name+'</label>\
						</div>';
						
						dst_opt += '<div class="form-check dst_branch'+index+'">\
						<input class="form-check-input" type="radio" name="dst_branch" id="dst_branch'+index+'" value="'+branch.branch_id+'">\
						<label class="form-check-label" for="dst_branch'+index+'">'+branch.branch_name+'</label>\
						</div>';
					});
					$(".src_branch_val").text('Source');
					$("#src_branch_li").html(src_opt);
					/* $(".dst_branch_val").text('Select Destination');
					$("#dst_branch_li").html(dst_opt);	 */
				}else if(brc_type == "src")
				{
					$.each(res.data, function(index, branch) {
						dst_opt += '<div class="form-check dst_branch'+index+'">\
						<input class="form-check-input" type="radio" name="dst_branch" id="dst_branch'+index+'" value="'+branch.branch_id+'">\
						<label class="form-check-label" for="dst_branch'+index+'">'+branch.branch_name+'</label>\
						</div>';
					});				
					$(".dst_branch_val").text('Destination');
					$("#dst_branch_li").html(dst_opt);	
					$(".dst_"+res_arr[1]).hide();
				}else if(brc_type = "dst"){
					
					$.each(res.data, function(index, branch) {
						src_opt += '<div class="form-check src_branch'+index+'">\
						<input class="form-check-input" type="radio" name="src_branch" id="src_branch'+index+'" value="'+branch.branch_id+'">\
						<label class="form-check-label" for="src_branch'+index+'">'+branch.branch_name+'</label>\
						</div>';
					});	
					$(".src_branch_val").text('Select Source');
					$("#src_branch_li").html(src_opt);
					$(".src_"+res_arr[1]).hide();
				}				
			}
					
			//document.getElementById("admin_bank").fstdropdown.rebind();
		}
	});
}