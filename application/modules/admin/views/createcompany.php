<?php require_once 'header.php' ; ?>
<link href="<?php echo base_url();?>assets/css/createbrand.css" type="text/css" rel="stylesheet">
<?php require_once 'sidebar.php' ; ?>	
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/snackbar.css" >
<link href="<?php echo base_url();?>assets/css/all.css" type="text/css" rel="stylesheet">
<style>
.multiselect-container .multiselect-group label:before, .multiselect-container .multiselect-group label:after {display:none;} 
.bank_dtl_blk, .crp_dtl_blk {
    width: 400px;
    position: relative;
    float: left;
    margin-right: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 15px;
    /*background: #f8f8f8;*/
}
.bank_list {
    position: relative;
    height: 250px;
    overflow: auto;
}
.remove {
    position: absolute;
    top: 5px;
    right: 5px;
    z-index: 999;
    cursor: pointer;
}

.bname ~ .btn-group .multiselect-container {width: 210px!important; padding-bottom: 15px;}
.multiselect-container input[type="radio"] {display: none;}
.remove img {width: 15px;}
.per_dtls {padding: 20px 20px 0px 20px; border-bottom: 10px solid #f0f1f5;}
.blck_div {padding: 0px 20px 0px 20px; border-bottom: 10px solid #f0f1f5;}
.hdg_bk {padding: 10px 20px 10px 20px; border-bottom: 5px solid #f0f1f5; font-weight: normal;}
.bank_list.blck_div {padding: 0px 20px 0px 20px!important;}
.blck_div.bal_blk {border-bottom: none!important;}
.sbt_btn {margin-left: 20px; margin-bottom: 10px; font-size: 13px;}
/*#brand_sbmt {margin-left: 20px; margin-bottom: 10px; }*/
#catnew, #subcatnew {font-size: 13px; padding: 2px 10px;}
.custom-select {position: relative;}
.form-control:disabled {background: none!important;}
.custom-select {background-image: url(http://3.7.44.132/aquacredit/assets/images/select_arow.png); position: relative; background-size:auto; }
.multiselect-container input[type='checkbox']{opacity: 0;}
.multiselect-container label {position: relative;}
.multiselect-container label:after {
	    content: ' ';
    width: 15px;
    border-radius: 2px;
    left: 12px;
    height: 15px;
    transition: all linear 0.2s;
    background: #fff;
    display: block;
    position: absolute;
    top: 10px;
    border: 1px solid #2962ff;
    z-index: 4;
}
.multiselect-container label:before {
    content: ' ';
    width: 15px;
    transition: all linear 0.2s;
    height: 15px;
    display: block;
    opacity: 0;
    position: absolute;
    left: 12px;
    top: 10px;
    background: url(http://3.7.44.132/aquacredit/assets/images/done_w.svg) no-repeat;
    background-size: 14px;
    background-position: 0 0;
    z-index: 5;
}
.multiselect-container .active label:before {
    opacity: 1;
}
.create_popup {padding: 20px!important;}
.multiselect-container .active label:after { background: #2962ff;}
.form-group label {font-weight: normal!important; /*font-size: 13px!important;*/}
.create_popup .hdg_bk {border-bottom: none!important; font-weight: normal!important; padding: 0px!important;}
.create_popup .form-group label {font-weight: normal!important;}
.create_popup .btn-primary {font-size: 13px;}
.btn_sbmt, .btn_cls {display: inline-block; padding: 5px 10px!important; width: auto!important; font-size: 13px!important;}
.txt_rt {text-align: right;}
.pp_clss {position: absolute; right: 20px; cursor: pointer;}
.bank_dtl_blk .multiselect-container label:before {display: none;}
.bank_dtl_blk .multiselect-container label:after {display: none;}

.tooltip { z-index: 999999 !important; position: fixed; !important;}
#output{ float: right; padding-right: 20px; }
.multiselect-group label:before { content: '' !important;}
</style>
	
<div class="right_blk">

	<div class="top_ttl_blk"> 
		<span class="back_btn"><!-- <a href="<?php echo base_url();?>admin/brands" title=""><img src="<?php echo base_url();?>assets/images/back.png" alt="" title=""> </a> --></span> 
		
		<span> <?php echo $page_title;?></span>
		<!-- <a href="#" title="" class="fr btn btn-primary"> Show all brands  </a> -->
		<div id="snackbar" class="snackbar" style="z-index:999999;"></div>
	</div>
	
	<div class="padding_30"> 		
		<div class="card_view"> 			
			<div class=""> 
			<!--     <div class="hdg_bk">  Create Company   </div> -->
				<form action="javascript:void(0);" data-toggle="validator" id="add_brand" name="add_brand" method="post" >
					<div class="row per_dtls">
						
						<div class="col-md-3"> 
							<div class="form-group">
							<span class="border-lable-flt">								
								<input type="text" class="form-control alphaonly" id="brand_name" name="brand_name"  placeholder=" " data-toggle="tooltip" />
								<label for="brand_name" class="control-label required">Company Name</label>
							</span>
							</div> 
						</div>

						<div class="col-md-3"> 
							<div class="form-group">
								<span class="border-lable-flt">									
									<input type="text" class="form-control alphaonly" id="contact_person" name="contact_person" placeholder=" " />
									<label for="contact_person" class="control-label required"> Contact Person Name</label>
								</span>
							</div>
						</div>

						<div class="col-md-3"> 
							<div class="form-group">
								<span class="border-lable-flt">
									<input type="text" class="form-control allownumericwithoutdecimal" id="p_mobile" name="p_mobile" placeholder=" " maxlength="10" />
									<label for="p_mobile" class="control-label required"> Mobile Number</label>
								</span>
							</div>
						</div>

						<div class="col-md-3"> 
							<div class="form-group">
								<span class="border-lable-flt">									
									<input type="email" class="form-control" id="p_email" name="p_email" placeholder=" " />
									<label for="p_email" class="control-label required"> Email</label>
								</span>
							</div>
						</div>

						<div class="col-md-3"> 
							<div class="form-group">
								<span class="border-lable-flt">								
									<input type="text" class="form-control" id="p_loc" name="p_loc" placeholder=" " />
									<label for="p_loc" class="control-label required"> Location</label>
								</span>
							</div>
						</div>

						<div class="col-md-3"> 
							<div class="form-group">
								<span class="border-lable-flt">								
									<input type="text" class="form-control allownumericwithdecimal" id="turn_disc" name="turn_disc" placeholder=" " />
									<label for="turn_disc" > Turnover discount</label>
								</span>
							</div>
						</div>
						<!-- <div class="col-md-4"> 
							<div class="form-group">
								<label class="control-label required"> Opening Balance</label>
								<input type="text" id="tbal_commas" name="tbal_commas" class="form-control mykey" value="" onkeyup = "amount_with_commas('add');" onblur = "amount_with_commas('add');"  placeholder="Opening Balance" />
							<input type="hidden" id="tbal" name="tbal" class="form-control" value="" />
							</div>
						</div> -->
					</div>

					<div class="cat_blk_nn">
						<div class="hdg_bk"> Category Selection   </div>
						<div class="row blck_div">
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label required"> Category  &nbsp;<span><a href="javascript:void(0);" id="catnew" class="btn btn-info btn-sm" >Add</a></span></label>
									<select id="cati" name="cati[]" multiple="multiple" >
									</select>
									<label id="cati-error" class="error" for="cati"></label>
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group" id="multiselection">
									<label class="control-label required"> Subcategory  &nbsp;<span><a href="javascript:void(0);" id="subcatnew" class="btn btn-info btn-sm" >Add</a></span></label>
									<select id="sub_cati" name="sub_cati[]" multiple="multiple" >
									</select>
									<span id="output"></span>
									<label id="sub_cati-error" class="error" for="sub_cati"></label>
								</div>
							</div>

							<div class="col-md-12 cat_sub_select"> 
								<!-- <b> Selected Sub Category </b>
								<ul class="subcat_ul"> 
									<li style="color:red;"> None </li>
								</ul> -->
							</div>

							<div class="col-md-3 med_div"> 
								
									<label class="form-group border-lable-flt "> 
									<select name="med" class="form-control custom-select" > 
										<option value=""> Select </option>
										<option value="1"> Medicine1 </option>
										<option value="2" > Medicine2 </option> 
										<option value="3"> Medicine3 </option>
									</select>
									<span>Medicine Type</span>
									</label>
								
							</div>

							<!-- <div class="col-md-2">								
								<label class="form-group border-lable-flt"> 
								<select  name="pub" class="form-control custom-select required" > 
									<option value="1" selected> Publish </option>
									<option value="0" > Unpublish </option>
								</select>
								<span>Status</span>
								</label>								
							</div> -->
							

						</div>
					</div>
					
					<div class="cat_blk_nn">
						<div class="hdg_bk">Bank Details(<span id="bd_cnt">1</span>) <a href="javascript:void(0)" title="" class="fr ad_bnk"> + Add Bank </a> </div>

						<div class="bank_list blck_div" id="bank_cnt" data-bank-cnt="1" data-bank-ids="1"> 
							<div class="bank_list_pos">
								<div class="bank_dtl_blk" data-bank-id="bank_acc_1" data-bid="1">
									<div class="row" style="margin-top:15px;"> 
										<div class="col-md-12"> 
											<div class="form-group">
												<span class="border-lable-flt">
													<!-- label for="name">Account Holder Name</label> -->
													<input type="text" class="form-control alphaonly" id="fname_1" name="holder_name[]" placeholder=" " />
													<label for="fname_1" class="control-label required">Account Holder Name</label>
												</span>
											</div>
										</div>

										<div class="col-md-6"> 
											<div class="form-group">
												<span class="border-lable-flt">
													<input type="text" class="form-control noalpha" id="ac_number_1" name="acc_no[]" placeholder=" " />
													<label for="ac_number_1" class="control-label required">Account Number</label>
												</span>	
											</div>
										</div>

										<!-- <div class="col-md-6">										
											<label class="form-group border-lable-flt "> 
												<select id="bc_name_1" name="bank_name[]" class="form-control custom-select bname" required > 
												</select>
												<span>Bank Name</span>
											</label> 
										</div> -->
										
										<div class="col-md-6">
											<div class="form-group">
												<!-- <label class="control-label required"> Bank Name </label> -->
												<select id="bc_name_1" name="bank_name[]" class="bname" placeholder="Select Bank" >
												</select>
											</div>
										</div>

										<div class="col-md-6"> 
											<div class="form-group">
												<span class="border-lable-flt">
													<input type="text" class="form-control" id="ifsc_1" name="ifsc_code[]" placeholder=" " />
													<label for="ifsc_1" class="control-label required">IFSC Code</label>
												</span>
											</div>
										</div>

										<div class="col-md-6"> 
											<div class="form-group">
												<span class="border-lable-flt">
													<input type="text" class="form-control alphaonly" id="branch_name_1" name="branch_name[]" placeholder=" " />
													<label for="branch_name_1" class="control-label required">Branch Name</label>
												</span>
											</div>
										</div>
										
									</div>
								</div>
							</div>
						</div>
					</div>					
					<div class="cat_blk_nn">
						<div class="hdg_bk"> Opening Balance </div>
						<div class="row blck_div bal_blk">
							<div class="col-md-3"> 
								<div class="form-group">
									<span class="border-lable-flt">
										<input type="text" class="form-control mykey" id="tbal_commas" name="tbal_commas"  value="0" onkeyup = "amount_with_commas('add');" onblur = "amount_with_commas('add');"  placeholder=" " />
										<label for="tbal_commas" > Opening Balance </label>
										<input type="hidden" id="tbal" name="tbal" value="" />
										
									</span>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-4">
							<button type="submit" class="btn btn-primary sbt_btn" >Submit</button>
						</div>
					</div>
				</form>
				<input type="hidden" id="catexists" name="catexists" value="0" />
				<input type="hidden" id="brandexists" name="brandexists" value="0" />
				<input type="hidden" id="emailexists" name="emailexists" value="0" />
				<input type="hidden" id="mobexists" name="mobexists" value="0" />
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
var url = '<?php echo base_url()?>';

function BankNames(dynid)
{	
	$.ajax({		
		url: url+"api/Banks/banknames",
		data: {},
		type:'POST',		
		datatype:'json',
		success : function(response){
			
			var opt = "<option value='' data-img=''> Select Bank </option>";
			res= JSON.parse(response);
			$.each(res.data, function(index, bank) {
				
				opt += "<option value='" + bank.short_name + "' data-img='"+bank.bank_icon
				+"' >" + bank.bank_name + "</option>";
			});
			$('#'+dynid).html(opt);
			$('#'+dynid).multiselect({
				enableHTML: true,
				optionLabel: function(element) {
					if($(element).attr('data-img') != "")
						return '<img src="'+url+'assets/images/'+$(element).attr('data-img')+'"> '+$(element).text();
					else
						return ' Select Bank ';
				},
				// ...
			});
			
			//$('#'+dynid).multiselect('rebuild');	
			
		}
	});
	
	$('#'+dynid).change(function () {	
		$(this).parent().children(".btn-group").find(".multiselect").css("border", "");
	});
			
}
function allcats()
{
	var sel_cat = [];
	$('#cati option:selected').each(function(){
		sel_cat.push($(this).val());
	});	
	
	$.ajax({		
		//url: url+"admin/brands/allcats",
		url: url+"api/categories",
		type:'POST',		
		datatype:'json',
		success : function(response){
			
			//alert(response);
			var opt = sel = opt_radio = "";
			res= JSON.parse(response);
			if(res.data.length > 0)
			{
				$.each(res.data, function(index, cat) {
					var valcheck = cat.cat_id;
					if($.inArray( valcheck, sel_cat ) != -1){ sel = "selected";	}
					opt += "<option value='" + valcheck + "' "+sel+" >" + cat.cat_name + "</option>";
					//opt_radio += "<input type='radio' class='form-check-input' id='"+valcheck+"' name='catopt' value='"+valcheck+"' /> " + cat.cat_name + " ";
					opt_radio += "<label class='form-check-label radio_blk'><input type='radio' class='form-check-input' id='"+valcheck+"' name='catopt' value='"+valcheck+"' />" + cat.cat_name + "</label>";
				});
			}
			$(".catdiv").html(opt_radio);
			$("#cati").html(opt);
			$("#cati").multiselect('rebuild');
			$('input[type="radio"]').change(function() {					
				$('.radio_blk').removeClass('checkd');
				$(this).parent('.radio_blk').toggleClass('checkd');
			});
		}
	});
}
	/* $('html, body').animate({
		scrollTop: ($('.error:visible').offset().top - 60)
	}, 500); */
$(document).ready(function() {	
	
	BankNames('bc_name_1');
	/* $(window).on('resize', function () {
	  $('input:focus').tooltip('show')
	}); */
	
	/* $("input").tooltip({
		close: function (event, ui) { //when the tooltip is supposed to close 
			if ($('input').is(':focus')) { // check to see if input is focused 
				$('input').tooltip('open'); // if so stay open
			}
		}
	}); */
	
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
	
	$(".med_div").hide();
	  
    $('#usr_lst_tbl').DataTable();
    $('#cati').multiselect();
    $('#sub_cati').multiselect();
    $('#med').multiselect();
    $('#pub').multiselect();
	allcats();
	/* //getcategories();
	function getcategories()
	{
		// Get Profile
		$.ajax({		
			url: url+"api/categories",
			data: {},
			type:'POST',		
			datatype:'json',
			success : function(response){
				
				//alert(response);
				res= JSON.parse(response);				
				//alert(res.data.length);
				var opt = "";
				if(res.data.length > 0)
				{
					$.each(res.data, function(index, cat) {
						opt += "<option value='" + cat.cat_id + "'>" + cat.cat_name + "</option>";
					});
				}
				$("#cati").html(opt);
				$("#cati").multiselect('rebuild');
			}
		});
	} */
	function selected_cats(value)
	{
		var sel_subcat = [];
		$('#sub_cati option:selected').each(function(){
			sel_subcat.push($(this).val());
		});	
		
		$.ajax({		
			url: url+"api/brands/getSubCat_New",
			data: {catid:value, subcats :''},
			type:'POST',		
			datatype:'json',
			success : function(response){
				
				var opt = new_cont = sel = "";
				res= JSON.parse(response);				
				//alert(res.length);
				if(res.length > 0)
				{
					$('#sub_cati').multiselect({
						enableClickableOptGroups: true,
						buttonWidth: '200px',

						onChange: function(option, checked, selected, element) {

							var temp = $.extend(true, {}, newData);

							var selectionData = [];
							var selectionGroup = [];
							$('#sub_cati option:selected').each(function(e) {
								for (n in newData) {
									for (d in newData[n]) {
										if (newData[n][d].value == $(this).val()) {
											for (i in temp[n]) {
												if (temp[n][i].value == $(this).val())
													temp[n].splice(i, 1);
											}

										}
									}

								}
								selectionData.push($(this).val());
							});

							for (t in temp) {
								if (temp[t].length == 0) {
									selectionGroup.push(t);
								} else {
									for (tt in newData[t]) {
										if (newData[t][tt] == temp[t][tt]) {
											selectionData.push(newData[t][tt]["value"]);
										}
									}
								}

							}
							console.log("Group : " + selectionGroup);
							console.log("Data : " + selectionData);
							$("#output").html("Group : " + selectionGroup + "<br>Data : " + selectionData);
							//alert("Group : " + selectionGroup + "\nData : " +selectionData);

						}
					});
					var newData = {};
					$('#sub_cati').multiselect('dataprovider', res);
					var clonedData = $.extend(true, {}, res);
					console.log(clonedData);
					for (i in clonedData) {
						newData[clonedData[i]["label"]] = clonedData[i]["children"];
					}
					$('#sub_cati').multiselect('rebuild');
					 /* $.each(res, function(index, subcat) {
						
						var valcheck = subcat.parent_id+'-'+subcat.subcat_id;
						if($.inArray( valcheck, sel_subcat ) != -1){ 
							sel = "selected"; 
							new_cont += '<li class="new_cont"> '+subcat.subcat_name+'<span class="cls_itm"><img src="<?php echo base_url();?>assets/images/close_btn.png" /></span><input type="hidden" value="'+subcat.parent_id + '-'+subcat.subcat_id +'" /></li>';
						}else{ sel = ""; } 				
						opt += "<option value='" + valcheck + "' "+sel+" >" + subcat.subcat_name + "</option>";
						
					}); */					
				}
				else{
					$('#sub_cati').multiselect('dataprovider', res);
					var newData = {};
					var clonedData = [];
					var selectionData = [];
					var selectionGroup = [];
					console.log(clonedData);
					//$('.subcat_ul').html('<li style="color:red;"> None </li>');
					new_cont = '<li style="color:red;"> None </li>';
				}
				$("#sub_cati").multiselect('rebuild');
				/* $("#sub_cati").html(opt);
				$("#sub_cati").multiselect('rebuild');
				$('.subcat_ul').html(new_cont); */
				//alert(res[0].subcat_id);	
			}
		});
	}
	
    $('#cati').change(function () {	
		
		$(this).parent().children(".btn-group").find(".multiselect").css("border", "");
		let value = $(this).val();
		//alert(value);
		
		if($.inArray( '2', value ) != -1)
		{
			$(".med_div").show();
		}else{
			$(".med_div").hide();
		}		
		selected_cats(value);		
    });

    $('#sub_cati').change(function () {		
		
		//alert($(this).children(".multiselect-selected-text").text());
		$(this).parent().children(".btn-group").find(".multiselect").css("border", "");
		var subcat = [];
		var subcatval = [];
		var scat = [];
		$('#sub_cati option:selected').each(function(){
			subcat.push($(this).text());
		});
		
		var new_cont = "";
		let value = $(this).val();	
		//alert(value.length);
		if(subcat.length > 0)
		{			
			$.each(subcat, function(index, val) {				
			new_cont += '<li class="new_cont"> '+val+'<span class="cls_itm"><img src="<?php echo base_url();?>assets/images/close_btn.png" /></span><input type="hidden" value="'+value[index]+'" /></li>';
			});	
			$('.subcat_ul').html(new_cont);
		}else{
			$('.subcat_ul').html('<li style="color:red;"> None </li>');
		}		
    });
	
	$(".subcat_ul").on("click", ".cls_itm", function(){	

		var subcat = [];
		$('#sub_cati option:selected').each(function(){
			subcat.push($(this).text());
		});
		var remval = $(this).siblings('input').val().trim();		
		$('#sub_cati').multiselect('deselect', remval);				
		$(this).parent().remove();
		if(subcat.length == 1){ $('.subcat_ul').html('<li style="color:red;"> None </li>'); }
	});
	
	/* $("#brand_name").on('keyup',function(){ checkbrandname(); });
	$("#p_mobile").on('keyup',function(){ checkbrandmobile(); });
	$("#p_email").on('keyup',function(){ checkbrandemail(); }); */
	
	$.validator.addMethod("eachcat", function(value, element) {
        var sel_cats = [];
		var sel_subcats = [];
		
		$('#cati option:selected').each(function(){
			sel_cats.push($(this).val());
		});
		
		$('#sub_cati option:selected').each(function(){
			
			var split_id = $(this).val().split("-");
			sel_subcats.push(split_id[0]);
		});	
		var newvals = [];
		$.each( sel_cats, function( k, v ) {
			var index = $.inArray( v, sel_subcats );
			newvals.push(index);		
		});
		return this.optional(element) || ($.inArray( -1, newvals ) === -1 ? true : false);
    }, "Please select at least one option from each category");
	
	$("#add_brand").submit(function(e) {			
			e.preventDefault();			
		}).validate({	
			//onkeyup: true,
			rules:{				
				brand_name:
				{
					required: true,
					minlength: 3,
					alpha: true,
					remote: {
						url: url + "api/Brands/checkbrandname_for_tooltip",
						type: "post",
						data: {
							brand_name: function() {
								return $('#add_brand :input[name="brand_name"]').val();
							}
						}
					}
				},				
				contact_person:{
					required:true,
					alpha:true,
					minlength:3
				},				
				p_mobile:{
					required:true,
					number:true,
					minlength:10,
					maxlength:10,
					remote: {
						url: url + "api/Brands/checkbrandmobile_for_tooltip",
						type: "post",
						data: {
							brand_mobile: function() {
								return $('#add_brand :input[name="p_mobile"]').val();
							}
						}
					}
				},				
				p_email:{
				  required: true,
				  email:true,
				  remote: {
						url: url + "api/Brands/checkbrandemail_for_tooltip",
						type: "post",
						data: {
							brand_email: function() {
								return $('#add_brand :input[name="p_email"]').val();
							}
						}
					}
				},
				p_loc:{
				  required: true,
				  minlength: 3
				},
				/* turn_disc:{
				  required: true,
				  number: true,
				  min: 1,
				  max: 100
				}, */
				"cati[]":{
					required: true
				},
				"sub_cati[]":{
					required: true,
					eachcat: true
				},
				med:{
					required: true
				},
				"holder_name[]":{
					required: true,
					alpha: true
				},
				"acc_no[]":{
					required: true,
					number: true,
					minlength: 9,
					maxlength: 18,
					remote: {
						url: url + "api/Brands/check_accno_for_tooltip",
						type: "post",
						data: {
							acc_no: function() {
								return $('#add_brand :input[name="acc_no[]"]').val();
							}
						}
					}
				},
				"bank_name[]":{
					required: true
				},
				"ifsc_code[]":{
					required: true,
					alphanumericnospace: true
				},
				"branch_name[]":{
					required: true,
					alpha: true
				}
			},
			messages: {
				brand_name:
				{
					required: "Enter company name",
					minlength: "Minimum length at least 3 characters",
					remote: "Company name already exists!",
					//keyup: "Company name already exists!"
				},
				contact_person:
				{
					required: "Enter contact person name",
					minlength: "Minimum length at least 3 characters",
				},				
				p_mobile:
				{
					required: "Enter mobile number",
					minlength: "Enter 10 digit mobile number",
					maxlength: "Enter 10 digit mobile number",
					remote: "Mobile already exists!"
				},				
				p_email:{
				  required:'Enter email address',
				  email: 'Enter valid email address',
				  remote: "Email already exists!"
				},
				p_loc:{
				  required:'Enter location'
				},
				"cati[]":{
					required: "Select category"
				},
				"sub_cati[]":{
					required: "Select subcategory"
				},
				med:{
					required: "Please select medicine"
				},
				"holder_name[]":{
					required: "Enter account holder name"					
				},
				"acc_no[]":{
					required: "Enter account number",
					remote: "Account numbers already exists!"
				},
				"bank_name[]":{
					required: "Select bank name"
				},
				"ifsc_code[]":{
					required: "Enter ifsc code"
				},
				"branch_name[]":{
					required: "Enter branch name"
				}
			},
			showErrors: function(errorMap, errorList) {			
				// Clean up any tooltips for valid elements
				$.each(this.validElements(), function(index, element) {
					var $element = $(element);
					var parent = $element.parent().attr('class');
					console.log($element);
					if (parent == "border-lable-flt") {
						$(element).data("title", "").removeClass("error").tooltip("dispose");
						$(element).css("border", "");
						$(".custom-select").css("border", "");
					} else {
						$element.parent().children(".btn-group").find(".multiselect").data("title", "").removeClass("error").tooltip("dispose");
						$(element).parent().children(".btn-group").find(".multiselect").css("border", "");
						$(".custom-select").css("border", "");
					}
				});
            $.each(errorList, function(index, error) {
                var $element = $(error.element);
				//$('.main_cnt_blk').mCustomScrollbar({ setTop : 0});
				
                console.log(error.element.name);
                if (error.element.name == "cati[]" || error.element.name == "sub_cati[]" || error.element.name == "bank_name[]" || error.element.name == "med") {
                    console.log($("#" + error.element.id).closest(".border-lable-flt"));
					$element.tooltip("dispose").data("title", error.message).data("placement", "top").addClass("error").tooltip();
                    $(".custom-select").css("border", "1px solid red");
                    $("#" + error.element.id).parent().children(".btn-group").find(".multiselect").css("border", "1px solid red");
                } else {
					$('.mCSB_container').css("top",0);					
                   $element.tooltip("dispose").data("title", error.message).data("placement", "top").addClass("error").tooltip();
                    

                    $("#" + error.element.id).css("border", "1px solid red");
					$(".custom-select").css("border", "");
                }
				
				/* $('#'+error.element.id).tooltip({
				   title : $('#'+error.element.id).data('title')
				}); */
            });
			 
        },
		submitHandler: function(form) 
		{
			var err = 0;			
			
			$("#add_brand input[type='text'], .bname").each(function(){			
		
				//alert($(this).attr("name"));
				if($(this).val() == '' && $(this).attr("id") != "undefined"){
					
					var this_id = $(this).attr("id");
					//alert(this_id);
					var split_id = this_id.split("_");
					//alert(split_id[0]);
					if(split_id[0] == "fname" || split_id[0] == "ac" || split_id[0] == "bc" || split_id[0] == "ifsc" || split_id[0] == "branch")
					{
						
						err = 1; tagid = "#"+this_id;
						//$("#"+this_id).css("border", "");
						//$(this).css("border", "1px solid red");
						if(split_id[0] == "fname"){	err_msg = "Please enter account holder name!"; }
						if(split_id[0] == "ac"){ err_msg = "Please enter account number!"; }
						if(split_id[0] == "bc"){ err_msg = "Please select bank name!"; }
						if(split_id[0] == "ifsc"){ err_msg = "Please enter ifsc code!"; }
						if(split_id[0] == "branch"){ err_msg = "Please enter branch name!"; }
						return form_validation(err,err_msg,tagid);
					}			
									
				}
			});
			
			
			if(err == 0)
			{
				formData = new FormData(form);		
			
				$.ajax({
					url: url+"api/brands/add",
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
								text: "Company created successfully!",
								type: 'success',
								shadow: true
							});
							
							//setInterval('location.reload()', 5000);
							setTimeout(function(){
								window.location.href = url+'admin/companies';
							 }, 5000);
														
						}
						else if(res.status == 'cat_exists'){
							new PNotify({
								title: 'Exists',
								text: 'Category name already exists!',
								type: 'failure',
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
			}					
		}
		
	});	
	
	//Add Banks	
	$('.ad_bnk').unbind().click(function(event){
		
		var err = 0;
		$("#add_brand input[type='text'], .bname").each(function(){			
				
        	if($(this).val() == '' && $(this).attr("id") != "undefined"){
        		
        		var this_id = $(this).attr("id");
        		//alert(this_id);
				var split_id = this_id.split("_");
        		//alert(split_id[0]);
        		if(split_id[0] == "fname" || split_id[0] == "ac" || split_id[0] == "bc" || split_id[0] == "ifsc" || split_id[0] == "branch")
        		{
					
        			err = 1; tagid = "#"+this_id;
					//$("#"+this_id).css("border", "");
        			//$(this).css("border", "1px solid red");
        			if(split_id[0] == "fname"){	err_msg = "Please enter account holder name!"; }
					if(split_id[0] == "ac"){ err_msg = "Please enter account number!"; }
					if(split_id[0] == "bc"){ err_msg = "Please select bank name!"; }
					if(split_id[0] == "ifsc"){ err_msg = "Please enter ifsc code!"; }
					if(split_id[0] == "branch"){ err_msg = "Please enter branch name!"; }
					return form_validation(err,err_msg,tagid);
        		}			
        						
        	}
        });
		
		if(err == 0){
			var bank_cnt=$("#bank_cnt").attr("data-bank-cnt");
			var extra_id=(parseInt(bank_cnt)+1);			
			
			BankNames('bc_name_'+extra_id);
			
			var html = ['<div class="bank_dtl_blk" data-bank-id="bank_acc_'+extra_id+'" data-bid="'+extra_id+'"> <span class="remove" onclick="removeBankAcc('+extra_id+')"> <img src="'+url+'/assets/images/close_btn.png" alt="" title="" /> </span> <div class="row" style="margin-top:15px;">', 
			 '<div class="col-md-12">', 
		   '<div class="form-group">',
			'<span class="border-lable-flt">',
			'<input type="text" class="form-control alphaonly" id="fname_'+extra_id+'" name="holder_name[]" placeholder=" " />',
			'<label for="fname_'+extra_id+'">Account Holder Name</label></span>',   
		  '</div>',
		  '</div>',
		  '<div class="col-md-6">', 
		   '<div class="form-group">',
			'<span class="border-lable-flt">',
			'<input type="text" class="form-control allownumericwithoutdecimal" id="ac_number_'+extra_id+'" name="acc_no[]" placeholder=" " />',
			'<label for="ac_number_'+extra_id+'">Account Number</label></span>',   
		  '</div>',
		  '</div>',
			 '<div class="col-md-6">',
				'<div class="form-group">',
					//'<label class="control-label required"> Bank Name </label>',
					'<select id="bc_name_'+extra_id+'" name="bank_name[]" class="bname" >',
					'</select>',
				'</div>',
			'</div>',
		  '<div class="col-md-6">', 
			'<div class="form-group">',
			   '<span class="border-lable-flt">',
			'<input type="text" class="form-control" id="ifsc_'+extra_id+'" name="ifsc_code[]" placeholder=" " />',
			'<label for="ifsc_'+extra_id+'">IFSC Code</label></span>',   
		  '</div>',
		  '</div>',
		  
		   '<div class="col-md-6">', 
			'<div class="form-group">',
			   '<span class="border-lable-flt">',
		   '<input type="text" class="form-control alphaonly" id="branch_name_'+extra_id+'" name="branch_name[]" placeholder=" " />',
			'<label for="branch_name_'+extra_id+'">Branch Name</label></span>',
		  '</div>',
		  '</div></div> </div>'];
			$(this).parent('.hdg_bk').siblings('.bank_list').find('.bank_list_pos').append(html.join("\n"));
			var k = $(this).parent('.hdg_bk').siblings('.bank_list').find('.bank_list_pos').children('.bank_dtl_blk').length;
			var wth = $('.bank_dtl_blk').width()+32;
			var s = k*20;
			$(this).parent('.hdg_bk').siblings('.bank_list').find('.bank_list_pos').css('width', k*wth+s);
		}
		
		

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

		$(".allownumericwithoutdecimal").on("keypress keyup blur",function (event) {    
		     $(this).val($(this).val().replace(/[^\d].+/, ""));
		      if ((event.which < 48 || event.which > 57)) {
		          event.preventDefault();
		      }
		});

		$("#bank_cnt").attr("data-bank-cnt",extra_id);
		$("#bd_cnt").text(extra_id);

		var ids=[];
		$('.bank_dtl_blk').each(function () {
		    //console.log($(this).attr('data-bank-id'));
		    ids.push($(this).attr('data-bid'));
		});
		if(ids.length>0){
			$("#bank_cnt").attr("data-bank-ids",ids.join(","));
		}
		
	});
	
	//Remove Bank Acc
	    removeBankAcc=function(bank_id){
	    	var bank_cnt=$("#bank_cnt").attr("data-bank-cnt");
			var new_bank_cnt=(parseInt(bank_cnt)-1);
			$("#bank_cnt").attr("data-bank-cnt",new_bank_cnt);
			$("#bd_cnt").text(new_bank_cnt);

			var rids=[];
			var bank_ids=$("#bank_cnt").attr("data-bank-ids").split(',');
			for(var i=0;i<bank_ids.length;i++){
				if(bank_id!=bank_ids[i]){
					rids.push(bank_ids[i]);
				}
			}
			$("#bank_cnt").attr("data-bank-ids",rids.join(","));
	    }
		
	// Add Category
	$("#cr_cat").submit(function(e) {			
			e.preventDefault();
	}).validate({
		//onkeyup: true,
		rules:{
			
			cat_name:
			{
				required: true,
				minlength: 3,					
				remote: {
					url: url+"api/Brands/checkcategory_for_tooltip",
					type:'POST',
					data: {
						catname: function() {
		
							return $("#cat_name").val().trim();
						}
					}
				}
			}
		},
		messages: {
			cat_name:
			{
				required: "Please enter category name",
				minlength: "Minimum length at least 3 characters",
				remote: "Category name already exists!"
			}
		},
		showErrors: function(errorMap, errorList) {
			
			//console.log(errorList);
			// Clean up any tooltips for valid elements
			$.each(this.validElements(), function(index, element) {
				var $element = $(element);
				console.log('+++++');				
				var parent = $element.parent().attr('class');
				console.log($element);
				$(element).data("title", "").tooltip("dispose");
                $(element).css("border", "");

			});
			
			// Create new tooltips for invalid elements
			$.each(errorList, function(index, error) {
				var $element = $(error.element);
				console.log(error.element.name);
				console.log(error.message);
				//console.log($element);

				$element.data("title", error.message).data("placement", "bottom").addClass("error").tooltip();

				$("#" + error.element.id).css("border", "1px solid red");

			});
        },
		submitHandler: function(form) 
		{
			fromsbmt('c');							
		}
		
	});
	
	// Add SubCategory
	$("#cr_sub_ct").submit(function(e) {			
			e.preventDefault();
	}).validate({
		//onkeyup: true,
		rules:{			
			catopt:{
				required: true
			},			
			subcat_name:
			{
				required: true,
				minlength: 3,					
				remote: {
					url: url+"api/Brands/checkcategory_for_tooltip",
					type:'POST',
					data: {
						catname: function() {
		
							return $("#subcat_name").val().trim();
						}
					}
				}
			}
		},
		messages: {
			catopt:{
				required: "Please select Category!"
			},
			subcat_name:
			{
				required: "Please enter subcategory name",
				minlength: "Minimum length at least 3 characters",
				remote: "Subcategory name already exists!"
			}
		},
		showErrors: function(errorMap, errorList) {
			
			//console.log(errorList);
			// Clean up any tooltips for valid elements
			$.each(this.validElements(), function(index, element) {
				var $element = $(element);
				console.log('+++++');				
				var parent = $element.parent().attr('class');
				console.log($element);
				$(element).data("title", "").tooltip("dispose");
                $(element).css("border", "");

			});
			
			// Create new tooltips for invalid elements
			$.each(errorList, function(index, error) {
				var $element = $(error.element);
				console.log(error.element.name);
				console.log(error.message);
				//console.log($element);

				$element.data("title", error.message).data("placement", "bottom").addClass("error").tooltip();

				$("#" + error.element.id).css("border", "1px solid red");

			});
        },
		submitHandler: function(form) 
		{
			fromsbmt('sc');							
		}
		
	});
		
});

$("#catnew").click(function(){
	$('.mCSB_container').css("top",0);
	$('.create_popup, .alpha_blk').show();
	$('#cr_cat').show();
	$('#cr_sub_ct').hide();
	$('.cl_pp').click(function(){
		$('.create_popup, .alpha_blk').hide();
		$('#cr_sub_ct').hide();
		$("#cr_cat")[0].reset();
	});
});
	
$("#subcatnew").click(function(){
	$('.mCSB_container').css("top",0);
	$('.create_popup, .alpha_blk').show();
		$('#cr_cat').hide();
		$('#cr_sub_ct').show();
	$('.cl_pp').click(function(){
		$('.create_popup, .alpha_blk').hide();
		$('#cr_sub_ct').hide();
		$("#cr_sub_ct")[0].reset();
	});
});


function checkcategory(cval)
{
	//var clikedForm = $("#cr_cat");
	//var catname = clikedForm.find("[name='cat_name']").val().trim();
	var err = 0; $("#catexists").val(0);
	if(cval == 'c'){ var catname = $("#cat_name").val().trim();}
	else if(cval == 'sc'){ var catname = $("#subcat_name").val().trim();}
	if(catname !=""){ 
		$.ajax({		
			url: url+"api/Brands/checkcategory",
			data: {catname:encodeURIComponent(catname.trim())},
			type:'POST',		
			datatype:'json',
			success : function(response){
				if(response == 1)
				{					
					$("#catexists").val(1);
					if(cval == 'c'){ $("#cat_name").focus(); tagid = "#cat_name"; }
					else{ $("#subcat_name").focus(); tagid = "#subcat_name"; }
					
					err = 1; err_msg = "Category name already exists, try with another name!"; 
					return form_validation(err,err_msg,tagid);
					
				}else{  
					$("#catexists").val(0); return true;
				}			
			}
		});
	}
}
function checkbrandname()
{	
	$("#brandexists").val(0);
	var brandname = $("#brand_name").val().trim(); var err = 0;
	if(brandname !=""){ 
		$.ajax({		
			url: url+"api/Brands/checkbrandname",
			data: {brand_name:encodeURIComponent(brandname.trim())},
			type:'POST',		
			datatype:'json',
			success : function(response){
				if(response == 1)
				{					
					$("#brandexists").val(1);
					$("#brand_name").focus();
					err = 1; err_msg = "Company name already exists, try with another name!"; tagid = "#brand_name";
					return form_validation(err,err_msg,tagid);
					
				}else{  
					$("#brandexists").val(0); return true;
				}			
			}
		});
	}
}
function checkbrandemail()
{
	$("#emailexists").val(0);	
	var pemail = $("#p_email").val().trim(); var err = 0
	if(pemail !=""){ 
		$.ajax({		
			url: url+"api/Brands/checkbrandemail",
			data: {brand_email:encodeURIComponent(pemail.trim())},
			type:'POST',		
			datatype:'json',
			success : function(response){
				if(response == 1)
				{					
					$("#emailexists").val(1); $("#p_email").focus();
					err = 1; err_msg = "Email already exists, try with another email!"; tagid = "#p_email";
					return form_validation(err,err_msg,tagid);
				}else{  
					$("#emailexists").val(0); return true;
				}			
			}
		});
	}
}
function checkbrandmobile()
{
	$("#mobexists").val(0);
	var pmobile = $("#p_mobile").val().trim(); var err = 0;
	if(pmobile !=""){ 
		$.ajax({		
			url: url+"api/Brands/checkbrandmobile",
			data: {brand_mobile:encodeURIComponent(pmobile.trim())},
			type:'POST',		
			datatype:'json',
			success : function(response){
				if(response == 1)
				{
					$("#mobexists").val(1); $("#p_mobile").focus();
					err = 1; err_msg = "Mobile number already exists, try with another number!"; tagid = "#p_mobile"; 
					return form_validation(err,err_msg,tagid);
				}else{  
					$("#mobexists").val(0); return true;
				}			
			}
		});
	}
}
</script>
<div class="create_popup"> 
	<div id="snackbar"></div>
	<div class="pp_clss cl_pp"><i class="fa fa-times" aria-hidden="true"></i></div>
	<form action="javascript:void(0);" id="cr_cat" name="cr_cat" method="post" >
		<div class="hdg_bk">  Create Category  </div>
		<div class="row"> 
			<div class="col-md-12"> 
				<div class="form-group">
					<span class="border-lable-flt">
						<!-- <input type="text" class="form-control" id="cat_name" name="cat_name" placeholder=" " onkeyup="checkcategory('c');"> -->
						<input type="text" class="form-control" id="cat_name" name="cat_name" placeholder=" " />
						<label class="control-label required" for="cat_name">Category Name</label>
					</span>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12"> 
				<div class="form-group">
					<span class="border-lable-flt">
						<textarea id="cat_desc" name="cat_desc" placeholder=" "></textarea>
						<label for="cat_desc">Description</label>
					</span>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 txt_rt">
				<!-- <button type="button" id="cat_sbmt" class="btn btn-primary btn_sbmt" onclick="checkcategory('c');fromsbmt('c');" >Submit</button>  -->
				<button type="submit" id="cat_sbmt" class="btn btn-primary btn_sbmt" >Submit</button> 
				<button type="button" class="btn btn-danger btn_cls cl_pp">Close</button> 
			</div>
		</div>
	</form>
  
	<form action="javascript:void(0);" id="cr_sub_ct" name="cr_sub_ct" method="post" >
		<div class="hdg_bk">  Create Sub Category  </div>

		<div class="sel_ca">			
			<div class="form-check-inline catdiv">
				<!-- <label class="form-check-label catdiv"></label> -->
			</div>			
		</div>

		<div class="row"> 
			<div class="col-md-12"> 
				<div class="form-group">
					<span class="border-lable-flt">
						<input type="text" class="form-control" id="subcat_name" name="subcat_name" placeholder=" " onkeyup="checkcategory('sc');">
						<label class="control-label required" for="subcat_name">Sub Category</label>
					</span>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12"> 
				<div class="form-group">
					<span class="border-lable-flt">
						<textarea id="subcat_desc" name="subcat_desc" placeholder=" "></textarea>
						<label for="subcat_desc">Description</label>
					</span>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 txt_rt">
				<button type="submit" id="subcat_sbmt" class="btn btn-primary btn_sbmt" >Submit</button>
				<button type="button" class="btn btn-danger btn_cls cl_pp">Close</button>
			</div>
		</div>
		
	</form>

</div>
<div class="alpha_blk"> </div>
<script>
function form_validation(err,err_msg,tagid)
{
  $('.mykey').parent().css("border", "");
  
  $("#snackbar").text(err_msg);
  $("#snackbar").addClass("show");
  
  setTimeout(function(){ $("#snackbar").removeClass("show"); }, 3000);
  //$(tagid).parent().css("border", "1px solid red");
 
  $(tagid).focus();
  return false;
}
function fromsbmt(frm)
{
	
	var myForm = ""; var formData = "";
	var err = 0;	
	if(frm == "c"){ 
		myForm = document.getElementById('cr_cat');
		/* var catname = $("#cat_name").val();
		if(catname == "")
		{
			err = 1; err_msg = "Please enter category name!"; tagid = "#cat_name";
			return form_validation1(err,err_msg,tagid);
		} */
		var succ = "Category created successfully!";
	}else if(frm == "sc"){ 
		myForm = document.getElementById('cr_sub_ct');
		/* var catopt = $("input[name='catopt']:checked").val();
		var subcatname = $("#subcat_name").val(); */
		var succ = "Subcategory created successfully!";
		
		/* if(! $("input[name='catopt']").is(':checked'))
		{
			err = 1; err_msg = "Please select category!"; tagid = "#cati";
			return form_validation1(err,err_msg,tagid);
		}
		if(subcatname == "")
		{
			err = 1; err_msg = "Please enter subcategory!"; tagid = "#sub_cati";
			return form_validation1(err,err_msg,tagid);
		} */
	}
		
	var catexists = $("#catexists").val();
	/* if(catexists == 0 && err == 0)
	{ */		
		
		formData = new FormData(myForm);		
		formData.append('hid_frm', frm);
		$.ajax({
			url: url+"api/brands/cat_subcat_add",
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
						text: succ,
						type: 'success',
						shadow: true
					});
					$(myForm)[0].reset();
					//$(myForm).reset();
					$('.create_popup, .alpha_blk').hide();					
				}else{
					new PNotify({
						title: 'Error',
						text: 'Something went wrong, try again!',
						type: 'failure',
						shadow: true
					});
				}
				allcats();
			}
		});				
	//}
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
<?php require_once 'footer.php' ; ?>