$(document).ready(function(){	
	
	$(".noalpha").on("keypress keyup blur",function (event) {
            //this.value = this.value.replace(/[^0-9\.]/g,'');
		$(this).val($(this).val().replace(/[^0-9\.,]/g,''));
		if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
			event.preventDefault();
		}
	});
	
	$(".allownumericwithoutdecimal").on("keypress keyup blur",function (event) {    
		$(this).val($(this).val().replace(/[^\d].+/, ""));
		if ((event.which < 48 || event.which > 57)) {
		  event.preventDefault();
		}
	});
	
	$(".allownumericwithdecimal").on("keypress keyup blur",function (event) {
            //this.value = this.value.replace(/[^0-9\.]/g,'');
		$(this).val($(this).val().replace(/[^0-9\.]/g,''));
		if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
			event.preventDefault();
		}
	});

    

$('.radio_blk input').change(function() {
   if($(this).is(':checked')) {
    $(this).parent().parent('.rad_btns').find('.radio_blk').removeClass('checkd')
    $(this).parent('.radio_blk').addClass('checkd');
  }
});

$('.chek_bx input').change(function() {
   $(this).parent('.chek_bx').toggleClass('checkd');
});

	
	//Add Jqeury custom validation methods
	
	// End date is greater than start date
	
	$.validator.addMethod("greaterThan", 
	function(value, element, params) {

		if (!/Invalid|NaN/.test(new Date(value))) {
			return new Date(value) > new Date($(params).val());
		}

		return isNaN(value) && isNaN($(params).val()) 
			|| (Number(value) > Number($(params).val())); 
	},'Must be greater than start date.');
	
	//Decimals
	$.validator.addMethod("decimal", function(value, element) {
		return this.optional(element) || /^\d{0,4}(\.\d{0,3})?$/i.test(value);
	}, "You include only three decimal places");
	
	$.validator.addMethod("lettersonly", function(value, element) {
		return this.optional(element) || /^[a-z\s]+$/i.test(value);
	}, "Only alphabetical characters");
	
	$.validator.addMethod('email_regexp', function (value, element) 
    {
        if (value != element.defaultValue) { 
        return this.optional(element) ||  /^[0-9a-zA-Z_.-]+@[a-zA-Z]+[.][a-zA-Z]{2,5}$/.test(value);
    }
        return true;
    },'Please enter valid email');
	
	$.validator.addMethod("aadhar_regexp", function(value, element)
    {
       return this.optional(element) || /^\d{4}\s\d{4}\s\d{4}$/.test(value.toUpperCase());
    }, "Invalid Aadhar Number");
	
	$.validator.addMethod("pan_regexp", function(value, element)
    {
        //return this.optional(element) || /^[A-Z]{5}\d{4}[A-Z]{1}$/.test(value);
        return this.optional(element) || /([A-Z]){5}([0-9]){4}([A-Z]){1}$/.test(value.toUpperCase());
    }, "Invalid Pan Number");
	
	// Custom functions
	
	$(document).mouseup(function(e) {	

		
		var containerff = $(".sts_fil_blk, .sts_pp");
		
		if (!containerff.is(e.target) && containerff.has(e.target).length === 0) 
		{
			$('.sts_fil_blk').removeClass('show');
			$('.sts_pp').removeClass('ad_tgl');
		}

		var container = $(".sl_menu, .drp_btn");

		if (!container.is(e.target) && container.has(e.target).length === 0) 
		{
			$('.sl_menu').removeClass('show');
		}

		var cl_val = $('.check_list, .check_wt_serc');
		if (!cl_val.is(e.target) && cl_val.has(e.target).length === 0) 
		{  
			$('.check_list ').removeClass('show_chk');
			$('.check_wt_serc').removeClass('act_v');
		}

		var container_nt = $(".note_blk");

		if (!container_nt.is(e.target) && container_nt.has(e.target).length === 0) 
		{
			$('.note_blk').removeClass('sh_nt');
		}

	});

	$('.mnu_blk').click(function(){
		$(this).toggleClass('act_menu');
		$('.left_blk ul').toggleClass('dis_blk');
    });

    $(".menu_icn, .ov_lay").click(function(){
		$(".menu_icn").toggleClass('ac_menu');
		$('.side_menu').toggleClass('show_menu');
		$('.ov_lay').toggleClass('show_over');
    });

$('.sts_pp').click(function(){
        $(".sts_pp").not(this).removeClass('ad_tgl');
        $(".sts_pp").not(this).siblings('.sts_fil_blk').removeClass('show');
        $(this).siblings('.sts_fil_blk').toggleClass('show');
        $(this).toggleClass('ad_tgl');
 });

$('.note_blk a').click(function(){
        $(".note_blk a").not(this).parent('.note_blk').removeClass('sh_nt');
        $(this).parent('.note_blk').toggleClass('sh_nt');
 });

$('.drp_btn').click(function(){
            $('.sl_menu').toggleClass('show');
});

$('.cre_inp input').focus(function(){
    $(this).parent().addClass('inp_ss');
});

$('.cre_inp input').focusout(function(){
  if($(this).val() != ''){
   $(this).parent().addClass('inp_ss');
  }else {
   $(this).parent().removeClass('inp_ss');
  }  
});

$('.check_wt_serc').click(function(){
    $(".check_wt_serc").not(this).removeClass('act_v');
    $(this).toggleClass('act_v')
     $(".check_wt_serc").not(this).find('.check_list').removeClass('show_chk');
    $(this).find('.check_list').toggleClass('show_chk');
    $(".check_list input[type='radio']").change(function(){
        //var val = $(this).parent().parent('li').parent('ul').parent('.check_wt_serc').find(".check_list input[type='radio']:checked").val();
			var acc_no = $(this).siblings('label').children('.bank_mny').find('.accont_numb').text();
		if(acc_no == ""){
			var val = $(this).siblings('label').text();
		}else{
			var val = acc_no;
		}
        $(this).parent().parent('li').parent('ul').parent('.check_wt_serc').find('.selectVal').text(val);
        $(this).parent().parent('li').parent('ul').removeClass('show_chk');
        $(this).parent().parent('li').parent('ul').parent('.check_wt_serc').removeClass('act_v').addClass('val_seld');
    });
    
});

});
function convertNumberToWords(amount) {
    var words = new Array();
    words[0] = '';
    words[1] = 'One';
    words[2] = 'Two';
    words[3] = 'Three';
    words[4] = 'Four';
    words[5] = 'Five';
    words[6] = 'Six';
    words[7] = 'Seven';
    words[8] = 'Eight';
    words[9] = 'Nine';
    words[10] = 'Ten';
    words[11] = 'Eleven';
    words[12] = 'Twelve';
    words[13] = 'Thirteen';
    words[14] = 'Fourteen';
    words[15] = 'Fifteen';
    words[16] = 'Sixteen';
    words[17] = 'Seventeen';
    words[18] = 'Eighteen';
    words[19] = 'Nineteen';
    words[20] = 'Twenty';
    words[30] = 'Thirty';
    words[40] = 'Forty';
    words[50] = 'Fifty';
    words[60] = 'Sixty';
    words[70] = 'Seventy';
    words[80] = 'Eighty';
    words[90] = 'Ninety';
    amount = amount.toString();
    var atemp = amount.split(".");
    var number = atemp[0].split(",").join("");
    var n_length = number.length;
    var words_string = "";
    if (n_length <= 9) {
        var n_array = new Array(0, 0, 0, 0, 0, 0, 0, 0, 0);
        var received_n_array = new Array();
        for (var i = 0; i < n_length; i++) {
            received_n_array[i] = number.substr(i, 1);
        }
        for (var i = 9 - n_length, j = 0; i < 9; i++, j++) {
            n_array[i] = received_n_array[j];
        }
        for (var i = 0, j = 1; i < 9; i++, j++) {
            if (i == 0 || i == 2 || i == 4 || i == 7) {
                if (n_array[i] == 1) {
                    n_array[j] = 10 + parseInt(n_array[j]);
                    n_array[i] = 0;
                }
            }
        }
        value = "";
        for (var i = 0; i < 9; i++) {
            if (i == 0 || i == 2 || i == 4 || i == 7) {
                value = n_array[i] * 10;
            } else {
                value = n_array[i];
            }
            if (value != 0) {
                words_string += words[value] + " ";
            }
            if ((i == 1 && value != 0) || (i == 0 && value != 0 && n_array[i + 1] == 0)) {
                words_string += "Crores ";
            }
            if ((i == 3 && value != 0) || (i == 2 && value != 0 && n_array[i + 1] == 0)) {
                words_string += "Lakhs ";
            }
            if ((i == 5 && value != 0) || (i == 4 && value != 0 && n_array[i + 1] == 0)) {
                words_string += "Thousand ";
            }
            if (i == 6 && value != 0 && (n_array[i + 1] != 0 && n_array[i + 2] != 0)) {
                words_string += "Hundred and ";
            } else if (i == 6 && value != 0) {
                words_string += "Hundred ";
            }
        }
        words_string = words_string.split("  ").join(" ");
    }
    return words_string;
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