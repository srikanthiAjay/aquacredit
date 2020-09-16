<<<<<<< HEAD
var thisform = "#single";
$(document).ready(function(){
	$('.mnu_blk').click(function(){
		$(this).toggleClass('act_menu');
		$('.left_blk ul').toggleClass('dis_blk');
	});

	$('#far_icn').click(function(){
		$('#former').show();
		$('#dealer').hide();
		$('#non_frm').hide();
		$(this).addClass('far_act');
		$('#dl_icn').removeClass('far_act');
		$('#non_va_icn').removeClass('far_act');
		var sm = $("input[name='optradio']:checked").val();
		if(sm == "sing_far"){ $('#hid_type').val('fs'); thisform = "#single"; }else if(sm == "par_far"){ $('#hid_type').val('fm'); thisform = "#multiple"; }	
		
	});

	$('#dl_icn').click(function(){
		$('#former').hide();
		$('#dealer').show();
		$('#non_frm').hide();
		$(this).addClass('far_act');
		$('#far_icn').removeClass('far_act');
		$('#non_va_icn').removeClass('far_act');
		$('#hid_type').val('d');
  		thisform = "#dealer";	
	});

	$('#non_va_icn').click(function(){
		
		$('#non_frm').show();
		$('#former').hide();
		$('#dealer').hide();
		$(this).addClass('far_act');
		$('#far_icn').removeClass('far_act');
		$('#dl_icn').removeClass('far_act');
		$('#hid_type').val('nf');
		$('#hidm1').val(''); $('#hidm2').val(''); $('#hidm3').val('');
		thisform = "#non_frm";
	});
	
	$('.ad_bnk').unbind().click(function(event){	

		var html = ['<div class="bank_dtl_blk"> <span class="remove"> <img src="http://localhost/ac/assets/images/close_btn.png" alt="" title="" /> </span> <div class="row">', 
     '<div class="col-md-6">', 
   '<div class="form-group">',
    '<label for="name">Person Full Name</label>',
    '<input type="text" class="form-control" id="fname" name="fname[]" placeholder="Person Full Name" />',   
  '</div>',
  '</div>',
  '<div class="col-md-6">', 
   '<div class="form-group">',
    '<label for="name">Account Number</label>',
    '<input type="text" class="form-control allownumericwithoutdecimal" id="ac_number" name="ac_number[]" placeholder="Account Number" />',   
  '</div>',
  '</div>',
     '<div class="col-md-6">', 
    '<div class="form-group">',
       '<label for="name">Bank Name</label>',
    '<input type="text" class="form-control" id="bc_name" name="bc_name" placeholder="Bank Name" />',   
  '</div>',
  '</div>',
  '<div class="col-md-6">', 
    '<div class="form-group">',
       '<label for="name">IFSC</label>',
    '<input type="text" class="form-control" id="ifsc" name="ifsc[]" placeholder="IFSC" />',   
  '</div>',
  '</div>',
  
   '<div class="col-md-6">', 
    '<div class="form-group">',
       '<label for="name">Branch Name</label>',
   '<input type="text" class="form-control" id="branch_name" name="branch_name[]" placeholder="Branch Name" />',  
  '</div>',
  '</div></div> </div>'];
		$(this).parent('.hdg_bk').siblings('.bank_list').children('.bank_list_pos').append(html.join("\n"));
		var k = $(this).parent('.hdg_bk').siblings('.bank_list').children('.bank_list_pos').children('.bank_dtl_blk').length;
		var wth = $('.bank_dtl_blk').width()+32;
		var s = k*20;
		$(this).parent('.hdg_bk').siblings('.bank_list').children('.bank_list_pos').css('width', k*wth+s);

		$('.remove').unbind().click(function(){
	
			var k = $(this).parent().parent().children('.bank_dtl_blk').length;
			var wth = $('.bank_dtl_blk').width()+32;
			var s = k*20;
			  if(k == 2){
				$('.bank_list_pos').css('width', k*wth+s - 300);
			  } else {
				$('.bank_list_pos').css('width', k*wth+s);
			  }			
		
				$(this).parent('.bank_dtl_blk').remove();
		// var wths = $('.bank_list_pos').width();
		$('.bank_list_pos').stop();
		});
		
	});

	$('.ad_crp').unbind().click(function(){

		var html = ['<div class="crp_dtl_blk"> <span class="crp_remove"> <img src="http://localhost/ac/assets/images/close_btn.png" alt="" title="" /> </span> <div class="row">', 
     		'<div class="col-md-6">', 
   '<div class="form-group">',
       '<label for="name">Crop Location</label>',
   '<input type="text" class="form-control" id="crop_loc" name="crop_loc[]" placeholder="Crop Location" />',   
  '</div>',
  '</div>',
  '<div class="col-md-6">', 
   '<div class="form-group">',
    '<label for="name">Crop Type</label>',
    '<input type="text" class="form-control" id="crop_type" name="crop_type[]" placeholder="Crop Type" />',   
  '</div>',
  '</div>',
  '<div class="col-md-6">', 
   '<div class="form-group">',
    '<label for="name">Number of Acres</label>',
    '<input type="text" class="form-control" id="acres" name="acres[]" placeholder="Number of Acres" />',   
  '</div>',
  '</div>',
   '</div>'];
		//$('.crp_list_pos').append(html.join("\n"));
		$(this).parent('.hdg_bk').siblings('.crp_list').children('.crp_list_pos').append(html.join("\n"));
		var k = $(this).parent('.hdg_bk').siblings('.crp_list').children('.crp_list_pos').children('.crp_dtl_blk').length;		
		var wth = $('.crp_dtl_blk').width()+32;
		var s = k*20;
		//$('.crp_list_pos').css('width', k*wth+s);
		$(this).parent('.hdg_bk').siblings('.crp_list').children('.crp_list_pos').css('width', k*wth+s);

		$('.crp_remove').unbind().click(function(){			
			
			//var k = $('.crp_dtl_blk').length;
			var k = $(this).parent().parent().children('.crp_dtl_blk').length;
			var wth = $('.crp_dtl_blk').width()+32;
			var s = k*20;
			//$('.crp_list_pos').css('width', k*wth+s);
			if(k == 2){
				$('.crp_list_pos').css('width', k*wth+s - 300);
			  } else {
				$('.crp_list_pos').css('width', k*wth+s);
			  }	
			  $(this).parent('.crp_dtl_blk').remove();
		});
	});

});
$('.remove').unbind().click(function(){

		var k = $(this).parent().parent().children('.bank_dtl_blk').length;
		var wth = $('.bank_dtl_blk').width()+32;
		var s = k*20;
		  if(k == 2){
			$('.bank_list_pos').css('width', k*wth+s - 300);
		  } else {
			$('.bank_list_pos').css('width', k*wth+s);
		  }			
	
			$(this).parent('.bank_dtl_blk').remove();
	// var wths = $('.bank_list_pos').width();
	$('.bank_list_pos').stop();
	});


$('.crp_remove').unbind().click(function(){			
		
	//var k = $('.crp_dtl_blk').length;
	var k = $(this).parent().parent().children('.crp_dtl_blk').length;
	var wth = $('.crp_dtl_blk').width()+32;
	var s = k*20;
	//$('.crp_list_pos').css('width', k*wth+s);
	if(k == 2){
		$('.crp_list_pos').css('width', k*wth+s - 300);
	  } else {
		$('.crp_list_pos').css('width', k*wth+s);
	  }	
	  $(this).parent('.crp_dtl_blk').remove();
});
=======
var thisform = "#single";
$(document).ready(function(){
	$('.mnu_blk').click(function(){
		$(this).toggleClass('act_menu');
		$('.left_blk ul').toggleClass('dis_blk');
	});

	$('#far_icn').click(function(){
		$('#former').show();
		$('#dealer').hide();
		$('#non_frm').hide();
		$(this).addClass('far_act');
		$('#dl_icn').removeClass('far_act');
		$('#non_va_icn').removeClass('far_act');
		var sm = $("input[name='optradio']:checked").val();
		if(sm == "sing_far"){ $('#hid_type').val('fs'); thisform = "#single"; }else if(sm == "par_far"){ $('#hid_type').val('fm'); thisform = "#multiple"; }	
		
	});

	$('#dl_icn').click(function(){
		$('#former').hide();
		$('#dealer').show();
		$('#non_frm').hide();
		$(this).addClass('far_act');
		$('#far_icn').removeClass('far_act');
		$('#non_va_icn').removeClass('far_act');
		$('#hid_type').val('d');
  		thisform = "#dealer";	
	});

	$('#non_va_icn').click(function(){
		
		$('#non_frm').show();
		$('#former').hide();
		$('#dealer').hide();
		$(this).addClass('far_act');
		$('#far_icn').removeClass('far_act');
		$('#dl_icn').removeClass('far_act');
		$('#hid_type').val('nf');
		$('#hidm1').val(''); $('#hidm2').val(''); $('#hidm3').val('');
		thisform = "#non_frm";
	});
	
	$('.ad_bnk').unbind().click(function(event){	

		var html = ['<div class="bank_dtl_blk"> <span class="remove"> <img src="http://localhost/ac/assets/images/close_btn.png" alt="" title="" /> </span> <div class="row">', 
     '<div class="col-md-6">', 
   '<div class="form-group">',
    '<label for="name">Person Full Name</label>',
    '<input type="text" class="form-control" id="fname" name="fname[]" placeholder="Person Full Name" />',   
  '</div>',
  '</div>',
  '<div class="col-md-6">', 
   '<div class="form-group">',
    '<label for="name">Account Number</label>',
    '<input type="text" class="form-control allownumericwithoutdecimal" id="ac_number" name="ac_number[]" placeholder="Account Number" />',   
  '</div>',
  '</div>',
     '<div class="col-md-6">', 
    '<div class="form-group">',
       '<label for="name">Bank Name</label>',
    '<input type="text" class="form-control" id="bc_name" name="bc_name" placeholder="Bank Name" />',   
  '</div>',
  '</div>',
  '<div class="col-md-6">', 
    '<div class="form-group">',
       '<label for="name">IFSC</label>',
    '<input type="text" class="form-control" id="ifsc" name="ifsc[]" placeholder="IFSC" />',   
  '</div>',
  '</div>',
  
   '<div class="col-md-6">', 
    '<div class="form-group">',
       '<label for="name">Branch Name</label>',
   '<input type="text" class="form-control" id="branch_name" name="branch_name[]" placeholder="Branch Name" />',  
  '</div>',
  '</div></div> </div>'];
		$(this).parent('.hdg_bk').siblings('.bank_list').children('.bank_list_pos').append(html.join("\n"));
		var k = $(this).parent('.hdg_bk').siblings('.bank_list').children('.bank_list_pos').children('.bank_dtl_blk').length;
		var wth = $('.bank_dtl_blk').width()+32;
		var s = k*20;
		$(this).parent('.hdg_bk').siblings('.bank_list').children('.bank_list_pos').css('width', k*wth+s);

		$('.remove').unbind().click(function(){
	
			var k = $(this).parent().parent().children('.bank_dtl_blk').length;
			var wth = $('.bank_dtl_blk').width()+32;
			var s = k*20;
			  if(k == 2){
				$('.bank_list_pos').css('width', k*wth+s - 300);
			  } else {
				$('.bank_list_pos').css('width', k*wth+s);
			  }			
		
				$(this).parent('.bank_dtl_blk').remove();
		// var wths = $('.bank_list_pos').width();
		$('.bank_list_pos').stop();
		});
		
	});

	$('.ad_crp').unbind().click(function(){

		var html = ['<div class="crp_dtl_blk"> <span class="crp_remove"> <img src="http://localhost/ac/assets/images/close_btn.png" alt="" title="" /> </span> <div class="row">', 
     		'<div class="col-md-6">', 
   '<div class="form-group">',
       '<label for="name">Crop Location</label>',
   '<input type="text" class="form-control" id="crop_loc" name="crop_loc[]" placeholder="Crop Location" />',   
  '</div>',
  '</div>',
  '<div class="col-md-6">', 
   '<div class="form-group">',
    '<label for="name">Crop Type</label>',
    '<input type="text" class="form-control" id="crop_type" name="crop_type[]" placeholder="Crop Type" />',   
  '</div>',
  '</div>',
  '<div class="col-md-6">', 
   '<div class="form-group">',
    '<label for="name">Number of Acres</label>',
    '<input type="text" class="form-control" id="acres" name="acres[]" placeholder="Number of Acres" />',   
  '</div>',
  '</div>',
   '</div>'];
		//$('.crp_list_pos').append(html.join("\n"));
		$(this).parent('.hdg_bk').siblings('.crp_list').children('.crp_list_pos').append(html.join("\n"));
		var k = $(this).parent('.hdg_bk').siblings('.crp_list').children('.crp_list_pos').children('.crp_dtl_blk').length;		
		var wth = $('.crp_dtl_blk').width()+32;
		var s = k*20;
		//$('.crp_list_pos').css('width', k*wth+s);
		$(this).parent('.hdg_bk').siblings('.crp_list').children('.crp_list_pos').css('width', k*wth+s);

		$('.crp_remove').unbind().click(function(){			
			
			//var k = $('.crp_dtl_blk').length;
			var k = $(this).parent().parent().children('.crp_dtl_blk').length;
			var wth = $('.crp_dtl_blk').width()+32;
			var s = k*20;
			//$('.crp_list_pos').css('width', k*wth+s);
			if(k == 2){
				$('.crp_list_pos').css('width', k*wth+s - 300);
			  } else {
				$('.crp_list_pos').css('width', k*wth+s);
			  }	
			  $(this).parent('.crp_dtl_blk').remove();
		});
	});

});
$('.remove').unbind().click(function(){

		var k = $(this).parent().parent().children('.bank_dtl_blk').length;
		var wth = $('.bank_dtl_blk').width()+32;
		var s = k*20;
		  if(k == 2){
			$('.bank_list_pos').css('width', k*wth+s - 300);
		  } else {
			$('.bank_list_pos').css('width', k*wth+s);
		  }			
	
			$(this).parent('.bank_dtl_blk').remove();
	// var wths = $('.bank_list_pos').width();
	$('.bank_list_pos').stop();
	});


$('.crp_remove').unbind().click(function(){			
		
	//var k = $('.crp_dtl_blk').length;
	var k = $(this).parent().parent().children('.crp_dtl_blk').length;
	var wth = $('.crp_dtl_blk').width()+32;
	var s = k*20;
	//$('.crp_list_pos').css('width', k*wth+s);
	if(k == 2){
		$('.crp_list_pos').css('width', k*wth+s - 300);
	  } else {
		$('.crp_list_pos').css('width', k*wth+s);
	  }	
	  $(this).parent('.crp_dtl_blk').remove();
});
>>>>>>> 879a1b5b54a411bf1c5dde2c628913c9b8ea40b0
