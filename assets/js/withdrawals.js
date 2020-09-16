var cur_url = window.location.href;
var url_params = cur_url.replace(url+"admin/users/details/", "");
var arr=url_params.split('/');
//var last_param = cur_url.substring(cur_url.lastIndexOf('/') + 1);
var user_id = arr[0];
//alert(user_id);
$('.gtot_withdrawal').hide();
$("#bank_block").show(); $("#cash_block").hide(); $("#user_block").show(); $("#crop_block").hide(); 
$('#src_user').hide();
getadminbanks(); getuserbanks(user_id); getadmincash_acc();

$( "#skey" ).autocomplete({
	//source: url+"api/users/searchusers",
  source: function( request, response ) {
		$('#selectuser_id').val('');
		$('#select_usercode').val('');
		$('#select_usertype').val('');
		$(".guest_block").hide();
		//$(".sel_loc").show();
		$(".cval").text('Crop location');
		var dyn_url = url+"api/users/searchusers_farmers";
   // Fetch data
   $.ajax({
	url: dyn_url,
	type: 'post',
	dataType: "json",
	data: {
	 search: request.term, allusers: 1
	},
	success: function( data ) {  

		response( $.map( data, function( result ) {  

		return {  

		label: result.label,
		value: result.value,
		imgsrc: result.img,		
		user_id: result.user_id,
		usercode: result.usercode,
		user_type: result.user_type,
		guest: result.guest,
		guest_mobile: result.guest_mobile

		}  

		}));  

	}  
   });
  },
  select: function (event, ui) {
   // Set selection	
	$("#snackbar").removeClass("show");
	var err_msg = "";
	err_msg = ui.item.user_type.toLowerCase().replace("_", "-");
	if(ui.item.guest == 1){ err_msg = "guest"; }   
   
   if(ui.item.user_type == "NON_FARMER" || ui.item.user_type == "DEALER" || ui.item.guest == 1){
	   
		$("#crop_block").hide();
		if(ui.item.guest == 1){ 				
			$(".guest_block").show(); }else{ $(".guest_block").hide();				
		}
	}else{ 
		 
		$("#crop_block").show(); 
		$(".guest_block").hide();
		
	}
	
   $('#skey').val(ui.item.label); // display the selected text
   $('#selectuser_id').val(ui.item.user_id); // save selected id to input
   $('#select_usercode').val(ui.item.usercode); 
   $('#select_usertype').val(ui.item.user_type); 
   $('#select_guest').val(ui.item.guest); // 
   //$('#guest_mob').val(ui.item.guest_mobile); 
   //$(".guest_block").show(); 
   getusercrops(ui.item.user_id);
   //return false;
  }
  
 }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {  

	   return $( "<li></li>" )  

		   .data( "item.autocomplete", item )  

		   .append( "<a>" + "<img style='width:25px;height:25px' src='" + item.imgsrc + "' /> " + item.label+ "</a>" )  

		   .appendTo( ul );  

   };
	  
$(document).on('blur','#skey',function(){
	if($(this).val() == "")
	{
		$('#selectuser_id').val(''); 
		$('#select_usercode').val(''); 
		$('#select_usertype').val(''); 
		$('#select_guest').val(0);
		$("#user_crop_li").html('');
		$(".cval").text('Crop location');
	}
});	  
$(document).on('click','.gtot_withdrawal',function(){
	$('.mykey').parent().css("border", "");
	$("#ban_trns").trigger("click");
	getusercrops(user_id);
});
$(document).on('click','.wth_drw_btn',function(){
	
	$('.mykey').parent().css("border", "");
	var err = 0;
	var ttype = $( 'input[name=act_types]:checked' ).val();
	var drawal_date = $("#drawal_date").val();
	var drawal_amt = $("#drawal_amt").val();
	var gtot = $("#hid_gtot").val();
	
	if(drawal_date == ""){ 
		err = 1; err_msg = "Please select date!"; 
		tagid = "#drawal_date"; 
		return form_validation(err,err_msg,tagid);
	}
	if(ttype == "bank")
	{
		var admin_bank = $('input[name="admin_bank"]:checked').val();
		var user_bank = $('input[name="user_bank"]:checked').val();
		
		if(admin_bank == undefined){
			err = 1; err_msg = "Please select admin bank!"; 
			tagid = ".admin_bank"; 
			return form_validation(err,err_msg,tagid);
		}
		if(user_bank == undefined){
			err = 1; err_msg = "Please select user bank!"; 
			tagid = ".user_bank"; 
			return form_validation(err,err_msg,tagid);
		}
	}
	if(ttype == "cash")
	{
		var admin_cash = $('input[name="admin_cash"]:checked').val();
		
		if(admin_cash == undefined){
			err = 1; err_msg = "Please select admin cash account!"; 
			tagid = ".admin_cash"; 
			return form_validation(err,err_msg,tagid);
		}
	}
	if(ttype == "crop")
	{
		var user_crop = $('input[name="user_crop"]:checked').val();
		
		if(user_crop == undefined){
			err = 1; err_msg = "Please select user crop!"; 
			tagid = ".user_crop"; 
			return form_validation(err,err_msg,tagid);
		}
	}
	if(ttype == "user")
	{
		var user_crop = $('input[name="user_crop"]:checked').val();
		var sel_userid = $("#selectuser_id").val();
		var sel_utype = $("#select_usertype").val();
		var guest = $("#select_guest").val();
		if(sel_userid == ""){
			err = 1; err_msg = "Please select user!"; 
			tagid = "#skey"; 
			return form_validation(err,err_msg,tagid);
		}
		if(sel_utype == "FARMER" && user_crop == undefined && guest == 0){
			err = 1; err_msg = "Please select user crop!"; 
			tagid = ".user_crop"; 
			return form_validation(err,err_msg,tagid);
		}
	}
	if(drawal_amt == "" || drawal_amt == "0"){
		err = 1; err_msg = "Please enter withdrawal amount!"; 
		tagid = "#drawal_amt_commas"; 
		return form_validation(err,err_msg,tagid);
	}
	if(+drawal_amt > gtot){
		err = 1; err_msg = "Please enter the amount not exceed "+gtot+"!"; 
		tagid = "#drawal_amt_commas"; 
		return form_validation(err,err_msg,tagid);
	}
	
	if(err == 0)
	{
		submit_form();
	}
});
function submit_form()
{
	if ($("#hid_chkbal").val() == 1) {
		new PNotify({
			title: 'Error',
			text: "Insufficient Balance, please select another admin bank!",
			type: 'failure',
			shadow: true,
			delay: 3000,
			stack: { "dir1": "down", "dir2": "right", "push": "top" }
		});
		return false;
	}
	var sel_crp_id = $( '#crop_id' ).val();
	formData = new FormData(wth_drw_frm);
	formData.append('uid', user_id);
	formData.append('src_crop', sel_crp_id);
				var dynurl = url+"api/users/withdrawals";
				var dynsucc = "The amount withdrawal successfully!";
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
						$('.mykey').parent().css("border", "");
						$("#wth_drw_frm")[0].reset();
						res= JSON.parse(response);
						if(res.status == 'success')
						{
							$('#bal_wthdr').modal("toggle");
							new PNotify({
								title: 'Success',
								text: dynsucc,
								type: 'success',
								shadow: true
							});	
							$('.mykey').parent().css("border", "");
							//setInterval('location.reload()', 2000);
							$("#wth_drw_frm")[0].reset();
							$("#drawal_date").datepicker({
								dateFormat: 'dd-M-yy',
								//defaultDate: "+1w",
								changeMonth: true,
								changeYear: true,
								minDate: dateToday,
								numberOfMonths: 1,
								onSelect: function (selected) {
									$("#drawal_date").parent().addClass('inp_ss');
								}
							}).datepicker("setDate",'now');
							$(".amon_text").hide();
							$("#user_crop_li").html('');
							$(".cval").text('Crop location');
							//$(".sel_loc").show();
							
							$("#admin_cash_li").html('');
							$(".admin_cash_val").text('Select Admin Bank');
							//$("#cash_block").show();
							
							$("#admin_bank_li").html('');
							$(".admin_bank_val").text('Select Admin Bank');
							//$("#bank_block").show();
							
							$("#user_bank_li").html('');
							$(".bank_val").text('Select User Bank');
							//$("#user_block").show();
							//$(".guest_block").hide();
							$("#drawal_amt").val('');
							$(".amon_text").text('');
							var tables = $('#usr_lst_tbl').DataTable()
							tables.ajax.reload();
							$("#ban_trns").trigger("click");
							getadminbanks(); getuserbanks(user_id); getadmincash_acc();
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
$("#drawal_date").parent().addClass('inp_ss');
var dateToday = new Date();
$("#drawal_date").datepicker({
	dateFormat: 'dd-M-yy',
	//defaultDate: "+1w",
	changeMonth: true,
	changeYear: true,
	minDate: dateToday,
	numberOfMonths: 1,
	onSelect: function (selected) {
		$("#drawal_date").parent().addClass('inp_ss');
	}
}).datepicker("setDate",'now');
function amount_with_commas()
{	
	var textbox = '#drawal_amt_commas';
	var hidden = '#drawal_amt';	  
	var num = $(textbox).val();
	var comma = /,/g;
	num = num.replace(comma,'');
	$(hidden).val(num);
	var numCommas = addCommas(num);
	$(textbox).val(numCommas);
	var amt_word = convertNumberToWords(num);
	if(amt_word != undefined){
		$('.amon_text').html(amt_word);
	} 
}
function getusercrops(user_id)
{	
	var aeval = hidcrop = defcorp = "";	
	var sel_crp_id = $( '#crop_id' ).val();
	//alert(sel_crp_id);
	$.ajax({		
		url: url+"api/UserCrops/index/"+user_id,
		data: {},
		type:'POST',		
		datatype:'json',
		success : function(response){
			
			//alert(response);
			res= JSON.parse(response);				
			
			var sel = "";
			if(user_id != "")
			{
				
				var opt = '';
				if(res.data.length > 0)
				{
					
					$.each(res.data, function(index, crop) {
						
						//if(crop.cd_id == hidcrop){ sel = "checked"; }else{ sel = "";}
						if(crop.cd_id != sel_crp_id)
						{
							opt += '<div class="form-check"><input class="form-check-input" type="radio" name="user_crop'+aeval+'" id="crp'+index+aeval+'" value="'+crop.cd_id+'" '+sel+' /><label class="form-check-label" for="crp'+index+aeval+'">'+crop.crop_location+'</label></div>';
						}
					});
				}
			}else{
				//$("#crop_trns").hide();
				var opt = '';
			}
			
			$("#user_crop_li"+aeval).html(opt);
		}
	});
}
function getadminbanks() {
    bank_icn = '';
    $.ajax({
        url: url + "api/Banks/banks",
        data: {},
        type: 'POST',
        datatype: 'json',
        success: function(response) {
            res = JSON.parse(response);
            var opt = '';
            if (res.data.length > 0) {
                $.each(res.data, function(index, bank) {

                    if (bank.account_name == "SBI") { bank_icn = 'sib_icn.png'; } else if (bank.account_name == "HDFC") { bank_icn = 'hdfc_icn.png'; } else if (bank.account_name == "ICICI") { bank_icn = 'icici_icn.png'; }

                    //opt += '<option value="'+bank.bank_id+'">'+bank.bank_name+' - '+bank.account_no+'</option>';
                    opt += '<div class="form-check"><input class="form-check-input" type="radio" name="admin_bank" id="bnk' + bank.id + '" value="' + bank.id + '"><label  class="form-check-label" for="bnk' + bank.id + '"><div class="bank_logo"> <img src="http://3.7.44.132/aquacredit/assets/images/' + bank_icn + '" alt="" title=""> </div><div class="bank_mny"><div class="bank_bal"> ₹ ' + addCommas(bank.avail_amount) + ' </div><div class="accont_numb">' + bank.account_number + '</div></div></label></div>';
                });
            }
            $(".admin_bank_val").text('Select Admin Bank');
            $("#admin_bank_li").html(opt);
            //document.getElementById("admin_bank").fstdropdown.rebind();
        }
    });
}
function getuserbanks(user_id) {
      
    $.ajax({
        url: url + "api/UserBanks/index/" + user_id,
        data: {},
        type: 'POST',
        datatype: 'json',
        success: function(response) {

            //alert(response);
            res = JSON.parse(response);
            //alert(res.data.length);
            bank_icn = '';
             var opt = '';
            if (user_id != "") {               
                if (res.data.length > 0) {
                    var opt = "";
                    $.each(res.data, function(index, bank) {
                        if (bank.bank_name == "SBI") { bank_icn = 'sib_icn.png'; } else if (bank.bank_name == "HDFC") { bank_icn = 'hdfc_icn.png'; } else if (bank.bank_name == "ICICI") { bank_icn = 'icici_icn.png'; }                      
                        
                        opt += '<div class="form-check"><input class="form-check-input" type="radio" name="user_bank" id="tps_l' + index + '" value="' + bank.acc_id + '" /><label class="form-check-label" for="tps_l' + index + '"><div class="bank_logo"> <img src="http://3.7.44.132/aquacredit/assets/images/' + bank_icn + '" alt="" title="">  </div><div class="bank_mny"><div class="bank_bal"> ' + bank.account_no + ' </div></div></label></div>';
                    });
                }
            } 
            $("#user_bank_li").html(opt);
        }
    });
}
function getadmincash_acc() {
       
    $.ajax({
        url: url + "api/Banks/cash_accounts",
        data: {},
        type: 'POST',
        datatype: 'json',
        success: function(response) {

            //alert(response);
            res = JSON.parse(response);
                        
			var opt = '';
			if (res.data.length > 0) {
				var opt = "";
				$.each(res.data, function(index, bank) {

					opt += '<div class="form-check"><input class="form-check-input" type="radio" name="admin_cash" id="bnk' + bank.id + '" value="' + bank.id + '"><label  class="form-check-label" for="bnk' + bank.id + '"><div class="bank_logo"> </div><div class="bank_mny"><div class="bank_bal"> ₹ ' + addCommas(bank.avail_amount) + ' </div><div class="accont_numb">' + bank.account_name + '</div></div></label></div>';
				});
			}
            $("#admin_cash_li").html(opt);
        }
    });
}
function bankBalCheck() {
    var req_amt = $("#drawal_amt").val();
    var bank_id = $("input[name='admin_bank']:checked").val();

    if (bank_id != undefined) {
        $.ajax({
            url: url + "api/banks/check_balance",
            data: { bank_id: bank_id },
            type: 'POST',
            datatype: 'json',
            success: function(response) {
                res = JSON.parse(response);
                if (res.data != null) {
                    if (+req_amt > +res.data.avail_amount) {
                        $("#hid_chkbal").val(1);
                    } else {
                        $("#hid_chkbal").val(0);
                    }
                }
            }
        });
    }

}