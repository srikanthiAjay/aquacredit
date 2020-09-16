<?php require_once 'header.php' ; ?>
<link href="<?php echo base_url();?>assets/css/createbrand.css" type="text/css" rel="stylesheet">
<?php require_once 'sidebar.php' ; ?>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/snackbar.css" >
<link href="<?php echo base_url();?>assets/css/all.css" type="text/css" rel="stylesheet">	
<style>
.multiselect-container .multiselect-group label:before, .multiselect-container .multiselect-group label:after {display:none}
.modal-content{
	text-align: center !important;
}
.bank_dtl, .bank_dtl_blk, .crp_dtl_blk {
    width: 400px;
    position: relative;
    float: left;
    margin-right: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 15px;
    /*background: #f8f8f8;*/
    box-shadow: 6px 9px 20px -2px rgba(0,0,0,0.1);
}
.bank_list {
    position: relative;
    height: 250px;
    overflow: auto;
}
.remove, .st {
    position: absolute;
    top: 5px;
    right: 15px;
    z-index: 999;
    cursor: pointer;
}
.create_popup {padding: 20px!important;}
.bname ~ .btn-group .multiselect-container {width: 210px!important; padding-bottom: 15px;}
.multiselect-container input[type="radio"] {display: none;}
.remove img {width: 15px;}
.per_dtls {padding: 20px 20px 0px 20px; border-bottom: 10px solid #f0f1f5;}
.blck_div {padding: 0px 20px 0px 20px; border-bottom: 10px solid #f0f1f5;}
.hdg_bk {padding: 10px 20px 10px 20px; border-bottom: 5px solid #f0f1f5; font-weight: normal;}
.bank_list.blck_div {padding: 0px 20px 0px 20px!important;}
.blck_div.bal_blk {border-bottom: none!important;}
#brand_sbmt {margin-left: 20px; margin-bottom: 10px; font-size: 13px;}
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
.remove_bank {position: absolute; right: 20px; bottom: 5px;}
.remove_bank a {text-decoration: underline; font-size: 11px;}
.tooltip {
	z-index: 999999 !important;
    position: fixed !important;
}
</style>	
<div class="right_blk">
	<div class="top_ttl_blk"> 
		<span class="back_btn"><!-- <a href="<?php echo base_url();?>admin/brands" title=""><img src="<?php echo base_url();?>assets/images/back.png" alt="" title=""> </a> --></span> 
		
		<span> <?php echo $page_title;?></span>
		<?php if($PAGE_SEGMENT == "view"){ ?>
			<a href="<?php echo base_url();?>admin/companies/edit/<?php echo $bid;?>" title="" class="fr btn btn-primary">Edit Company  </a> 
		<?php } ?>
		<div id="snackbar" class=""></div>
	</div>

	<div class="padding_30"> 
		<div class="card_view"> 
			<div class=""> 
			<!--     <div class="hdg_bk">  Create Company   </div> -->
				<form action="javascript:void(0);" id="add_brand" name="add_brand" method="post" >
					<div class="row per_dtls"> 
						<div class="col-md-3"> 
							<div class="form-group">
							<span class="border-lable-flt">								
								<!-- <input type="text" class="form-control" id="brand_name" name="brand_name" value="" placeholder=" " onblur="checkbrandname();" /> -->
								<input type="text" class="form-control" id="brand_name" name="brand_name" value="" placeholder=" " />
								<label class="control-label required" for="brand_name"> Company Name </label>
							</span>
							</div> 
						</div>

						<div class="col-md-3"> 
							<div class="form-group">
								<span class="border-lable-flt">									
									<input type="text" class="form-control" id="contact_person" name="contact_person" value="" placeholder=" " />
									<label class="control-label required" for="contact_person" > Contact Person Name</label>
								</span>
							</div>
						</div>

						<div class="col-md-3"> 
							<div class="form-group">
								<span class="border-lable-flt">									
									<input type="text" class="form-control" id="p_mobile" name="p_mobile" value="" placeholder=" " />
									<label class="control-label required" for="p_mobile"> Mobile Number</label>
							</div>
						</div>

						<div class="col-md-3"> 
							<div class="form-group">
								<span class="border-lable-flt">									
									<input type="email" class="form-control" id="p_email" name="p_email" value="" placeholder=" " />
									<label class="control-label required" for="p_email"> Email</label>
								</span>
							</div>
						</div>

						<div class="col-md-3"> 
							<div class="form-group">
								<span class="border-lable-flt">									
									<input type="text" class="form-control" id="p_loc" name="p_loc" value="" placeholder=" ">
									<label class="control-label required" for="p_loc"> Location</label>
								</span>
							</div>
						</div>

						<div class="col-md-3"> 
							<div class="form-group">
								<span class="border-lable-flt">									
									<input type="text" class="form-control" id="turn_disc" name="turn_disc" value="" placeholder=" " />
									<label for="turn_disc"> Turnover discount</label>
								</span>
							</div>
						</div>
					</div>

					<div class="cat_blk_nn">
						<div class="hdg_bk"> Category Selection   </div>
						<div class="row blck_div">
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label required"> Category  &nbsp;<span><a href="javascript:void(0);" id="catnew" class="btn btn-info btn-sm" >Add</a></span></label>
									<?php //$bcats = explode(",",$bdata["brand_cat"]);?>
									<select id="cati" name="cati[]" multiple="multiple">
									<?php /* if(count($categories)>0){ 
										foreach($categories as $cat) {
											?>									 
										<option value="<?php echo $cat["cat_id"];?>" <?php if (in_array($cat["cat_id"], $bcats)){ echo "selected";}?> > <?php echo $cat["cat_name"];?> </option>
									<?php } } */ ?>
									</select>
									<label id="cati-error" class="error" for="cati"></label>
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label required"> Subcategory  &nbsp;<span><a href="javascript:void(0);" id="subcatnew" class="btn btn-info btn-sm" >Add</a></span></label>
									<select id="sub_cati" name="sub_cati[]" multiple="multiple">
									</select>
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

						</div>
					</div>
					
					<div class="cat_blk_nn">
						<!-- <div class="hdg_bk">Bank Details(<span id="bd_cnt">1</span>) <a href="javascript:void(0)" title="" class="fr ad_bnk"> + Add Bank </a> </div> -->
						<div class="hdg_bk">Bank Details <a href="javascript:void(0)" title="" class="fr ad_bnk"> + Add Bank </a> </div>
						
						<div class="multi_banks"></div>
						<!-- <div style="clear:both;"></div><br/> -->
						
						<div class="bank_list blck_div" id="bank_cnt" data-bank-cnt="1" data-bank-ids="1">				
							<div class="bank_list_pos">								
							</div>
						</div>
					</div>
					
					<div class="cat_blk_nn">
						<div class="hdg_bk"> Opening Balance </div>
						<div class="row blck_div bal_blk">
							<div class="col-md-3"> 
								<div class="form-group">
									<span class="border-lable-flt">
										<input type="text" class="form-control mykey" id="tbal_commas" name="tbal_commas"  value="0" onkeyup = "amount_with_commas('add');" onblur = "amount_with_commas('add');"  placeholder=" " disabled />
										<label for="tbal_commas" > Opening Balance </label>
										<input type="hidden" id="tbal" name="tbal" value="" />
										
									</span>
								</div>
							</div>
							<div class="col-md-3"> 
								<label class="form-group border-lable-flt"> 
									<select  name="pub" class="form-control custom-select required" > 
										<option value="1" selected> Publish </option>
										<option value="0" > Unpublish </option>
									</select>
									<span>Status</span>
								</label>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-4">
							<!-- <button type="submit" class="btn btn-primary" id="brand_sbmt" onclick="checkbrandname();" >Update</button> -->
							<button type="submit" class="btn btn-primary" id="brand_sbmt" >Update</button>
							<input type="hidden" id="hid_bid" name="hid_bid" value="" />
							<input type="hidden" id="hid_bname" name="hid_bname" value="" />
							<input type="hidden" id="hid_email" name="hid_email" value="" />
							<input type="hidden" id="hid_mob" name="hid_mob" value="" />
							<input type="hidden" id="catexists" name="catexists" value="0" />
							<input type="hidden" id="brandexists" name="brandexists" value="0" />
							<input type="hidden" id="emailexists" name="emailexists" value="0" />
							<input type="hidden" id="mobexists" name="mobexists" value="0" />
							<input type="hidden" id="hid_cats" name="hid_cats" value="" />
							<input type="hidden" id="hid_subcats" name="hid_subcats" value="" />
							<input type="hidden" id="hid_acc_id" name="hid_acc_id" value="" />
							<input type="hidden" id="active_bank" name="active_bank" value="" />
						</div>
					</div>
					
				</form>
				
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
			
			$('#'+dynid).multiselect('rebuild');	
			
		}
	});
}
function getbrand()
{
	// Get Brand
	var bid = <?php echo $bid; ?>;
	$.ajax({		
		url: url+"api/brands/index/"+bid,
		data: {},
		type:'POST',		
		datatype:'json',
		success : function(response){
			
			//alert(response);
			res= JSON.parse(response);				
			//alert(res.data.status);
			if(res.data != "")
			{
				$("#brand_name").val(res.data.brand_name);					
				$("#contact_person").val(res.data.contact_person);					
				$("#p_mobile").val(res.data.contact_mobile);					
				$("#p_email").val(res.data.contact_email);					
				$("#p_loc").val(res.data.contact_loc);					
				$("#turn_disc").val(res.data.turnover_disc);					
				/* $("#pub").val(res.data.status);	
				$("#pub").multiselect('rebuild'); */
				$('[name=pub]').val(res.data.status);
				$('[name=med]').val(res.data.medicine_type);				
				/* $("#holder_name").val(res.data.full_name);
				$("#acc_no").val(res.data.account_no);
				$("#bank_name").val(res.data.bank_name);
				$("#ifsc_code").val(res.data.ifsc);
				$("#branch_name").val(res.data.branch_name); */
				$("#hid_cats").val(res.data.brand_cat);					
				$("#hid_subcats").val(res.data.brand_subcat);
				$("#hid_bid").val(res.data.brand_id);
				$("#hid_bname").val(res.data.brand_name);
				$("#hid_email").val(res.data.contact_email);
				$("#hid_mob").val(res.data.contact_mobile);
				$("#hid_acc_id").val(res.data.acc_id);
				$("#tbal_commas").val(addCommas(res.data.open_balance));
				$("#tbal").val(res.data.open_balance);
				allcats(); 
			}				
		}
	});
	
}

function getbanks()
{
	// Get Brand
	var bid = <?php echo $bid; ?>;
	$.ajax({		
		url: url+"api/brands/banks/"+bid,
		data: {},
		type:'POST',		
		datatype:'json',
		success : function(response){

			res= JSON.parse(response);				
			//alert(res.data.status);
			var multi_bank = chk = rm_bank = "";
			if(res.data != "")
			{
				$.each(res.data, function(index, bank){
					
					rm_bank = '<div class="remove_bank" id="rm_bnk_'+bank.acc_id+'"> <a href="javascript:void(0);" title="">Remove</a> </div>';
					
					if(bank.status == 1){ chk_class = "checkd"; chk = "checked"; $("#active_bank").val(bank.acc_id); rm_bank = "";}else{ chk_class = ""; chk = ""; } 
					multi_bank +='<div class="bank_dtl_blk">\
					<label class="st radio_blk '+chk_class+'"><input type="radio" class="cur_bank" name="cur_bank" value="'+bank.acc_id+'" '+chk+' />&nbsp;Primary </label> '+rm_bank+'\
					<div class="row" style="margin-top:20px;">\
						<div class="col-md-12">\
							<div class="form-group">\
								<span class="border-lable-flt">\
									<input type="text" class="form-control alphaonly" placeholder=" " value="'+bank.full_name+'" disabled />\
									<label for="fname_1">Account Holder Name</label>\
								</span>\
							</div>\
						</div>\
						<div class="col-md-6">\
							<div class="form-group">\
								<span class="border-lable-flt">\
									<input type="text" class="form-control" placeholder=" " value="'+bank.account_no+'" disabled />\
									<label for="fname_1">Account Number</label>\
								</span>\
							</div>\
						</div>\
						<div class="col-md-6">\
							<div class="form-group">\
								<span class="border-lable-flt">\
									<input type="text" class="form-control" placeholder=" " value="'+bank.bank_name+'" disabled />\
									<label for="fname_1">Bank Name</label>\
								</span>\
							</div>\
						</div>\
						<div class="col-md-6">\
							<div class="form-group">\
								<span class="border-lable-flt">\
									<input type="text" class="form-control" placeholder=" " value="'+bank.ifsc+'" disabled />\
									<label for="fname_1">IFSC Code</label>\
								</span>\
							</div>\
						</div>\
						<div class="col-md-6">\
							<div class="form-group">\
								<span class="border-lable-flt">\
									<input type="text" class="form-control alphaonly" placeholder=" " value="'+bank.branch_name+'" disabled />\
									<label for="fname_1">Branch Name</label>\
								</span>\
							</div>\
						</div>\
						</div>\
					</div>';
				});
				//$(".multi_banks").html(multi_bank);
				$(".bank_list_pos").append(multi_bank);
				$('input[type="radio"]').change(function() {		
					
					$('.radio_blk').removeClass('checkd');
					$(this).parent('.radio_blk').toggleClass('checkd');
				});
			}				
		}
	});
	
}

function allcats()
{
	/* var sel_cat = [];
	$('#cati option:selected').each(function(){
		sel_cat.push($(this).val());
	});	 */
	var sel_cat = $('#hid_cats').val().split(',');
	
	$.ajax({		
		//url: url+"admin/brands/allcats",
		url: url+"api/categories",
		type:'POST',		
		datatype:'json',
		success : function(response){
			
			var opt = sel = opt_radio = "";
			res= JSON.parse(response);
			if(res.data.length > 0)
			{
				$.each(res.data, function(index, cat) {
					var valcheck = cat.cat_id;
				if($.inArray( valcheck, sel_cat ) != -1){ sel = "selected";	}else{ sel = ""; }
					opt += "<option value='" + valcheck + "' "+sel+" >" + cat.cat_name + "</option>";
					opt_radio += "<label class='form-check-label radio_blk'><input type='radio' class='form-check-input' id='"+valcheck+"' name='catopt' value='"+valcheck+"' />" + cat.cat_name + "</label>";
				});
				
				var catvals = $('#hid_cats').val();	
				selected_cats(catvals.split(','));
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

function selected_cats(value)
{	
	var subcat = [];
	var new_cont = "";
				
	var subcatvals = $('#hid_subcats').val();
	var subcat_arry = subcatvals.split(',');
	//console.log(subcat_arry);
	var sel = "";
	
	if($.inArray( '2', value ) != -1)
	{
		$(".med_div").show();
	}else{
		$(".med_div").hide();
	}
	
	$.ajax({		
		url: url+"api/brands/getSubCat_New",
		data: {catid:value, subcats :subcatvals},
		type:'POST',		
		datatype:'json',
		success : function(response){
			
			var opt = new_cont = sel = "";
			//alert(response);
			res= JSON.parse(response);			
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
						}					
					});
					var newData = {};
					$('#sub_cati').multiselect('dataprovider', res);
					var clonedData = $.extend(true, {}, res);
					console.log(clonedData);
					for (i in clonedData) {
						newData[clonedData[i]["label"]] = clonedData[i]["children"];
					}
					//$('#sub_cati').multiselect('rebuild');
				/* $.each(res, function(index, subcat) {
					
					if($.inArray( subcat.subcat_id, subcat_arry ) != -1)
					{ 
						sel = "selected";
						new_cont += '<li class="new_cont"> '+subcat.subcat_name+'<span class="cls_itm"><img src="<?php echo base_url();?>assets/images/close_btn.png" /></span><input type="hidden" value="'+subcat.parent_id + '-'+subcat.subcat_id +'" /></li>';						
					}else{ sel = ""; } 
					opt += "<option value='" + subcat.parent_id + '-'+subcat.subcat_id + "' "+sel+" >" + subcat.subcat_name + "</option>";
					
				});	 */
				
				//$('.subcat_ul').html(new_cont);
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
			
			
			/* $("#sub_cati").html(opt);
			$("#sub_cati").multiselect('rebuild');
			$('.subcat_ul').html(new_cont); */
			
					
			<?php if($PAGE_SEGMENT == "view"){ ?>
				$('#add_brand').find('input, textarea, button, select').attr('disabled','disabled');
				$('#catnew').hide();$('#subcatnew').hide();
				$('#brand_sbmt').hide(); $('.cls_itm').hide();
			<?php } ?>
			
		}
	});
	
}


$(document).ready(function() {
	
	getbrand(); getbanks();	
	
	$(document).on('click','.cur_bank',function(){
		
		$('.ui-pnotify').remove();
		if($(this).val() != $("#active_bank").val())
		{
			$.ajax({		
				url: url+"api/Brands/primary_bank",
				data: {acc_id:$(this).val(),prev_bank:$("#active_bank").val()},
				type:'POST',		
				datatype:'json',
				success : function(response){
					res= JSON.parse(response);
					if(res.status == 'success')
					{
						new PNotify({
							title: 'Success',
							text: "Primary bank updated successfully!",
							type: 'success',
							shadow: true
						});
						$(".bank_list_pos").html('');
						getbanks();
					}			
				}
			});
		}		
	});
	
	/* $('#add_brand').on('afterValidate', function (event, messages) {
		if(typeof $('.error').first().offset() !== 'undefined') {
			$('html, body').animate({
				scrollTop: $('.error').first().offset().top
			}, 1000);
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

	
	<?php if($PAGE_SEGMENT == "view"){ ?>
		//$("#add_brand :input").prop("disabled", true);
		$('#add_brand').find('input, textarea, button, select').attr('disabled','disabled');
		$('#catnew').hide();$('#subcatnew').hide();
		$('#brand_sbmt').hide(); $('.cls_itm').hide(); $('.ad_bnk').hide();
	<?php } ?>
	
	$('#usr_lst_tbl').DataTable();
    $('#cati').multiselect();
    $('#sub_cati').multiselect();
    $('#med').multiselect();
    $('#pub').multiselect();
	
	

	$('#cati').change(function () {		
		
		let value = $(this).val();			
		selected_cats(value);		
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

	$('#sub_cati').change(function () {	
		
		var subcat = subcatval = [];
		$('#sub_cati option:selected').each(function(){
			subcat.push($(this).text());
		});		
		//alert(subcat.length);
		let value = $(this).val();	
		var new_cont = "";
		if(subcat.length > 0)
		{	
			
			$.each(subcat, function(index, val) {				
			new_cont += '<li class="new_cont"> '+val+'<span class="cls_itm"><img src="<?php echo base_url();?>assets/images/close_btn.png" /></span><input type="hidden" value="'+value[index]+'" /></li>';
			});	
			$('.subcat_ul').html(new_cont);
		}
		else{
			$('.subcat_ul').html('<li style="color:red;"> None </li>');
		}	
	});
	
	/* $("#brand_name").keyup(function(){ checkbrandname(); });
	$("#p_email").keyup(function(){ checkbrandemail(); });
	$("#p_mobile").keyup(function(){ checkbrandmobile(); }); */
	
	/* $('input[name^="acc_no[]"]').keyup(function() {

		var current = $(this);

		$('input[name^="acc_no[]"]').each(function() {
			if ($(this).val() == current.val() && $(this).attr('id') != current.attr('id'))
			{
				alert('duplicate found!');
			}

		});
	  }); */
	
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
			rules:{
				
				brand_name:
				{
					required: true,
					minlength: 3,
					alpha: true,
					remote: {
						depends: function(){
							return $("#hid_bname").val().trim() != $("#brand_name").val().trim();
						},
						param: {
							url: url + "api/Brands/checkbrandname_for_tooltip",
							type: "post",
							data: {
								brand_name: function() {
									return $('#add_brand :input[name="brand_name"]').val();
								}
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
						depends: function(){
							return $("#hid_mob").val().trim() != $("#p_mobile").val().trim();
						},
						param: {
							url: url + "api/Brands/checkbrandmobile_for_tooltip",
							type: "post",
							data: {
								brand_mobile: function() {
									return $('#add_brand :input[name="p_mobile"]').val();
								}
							}
						}
					}
				},				
				p_email:{
				  required: true,
				  email:true,
				  remote: {
					  depends: function(){
							return $("#hid_email").val().trim() != $("#p_email").val().trim();
						},
						param: {
							url: url + "api/Brands/checkbrandemail_for_tooltip",
							type: "post",
							data: {
								brand_email: function() {
									return $('#add_brand :input[name="p_email"]').val();
								}
							}
						}
					}
				},
				p_loc:{
				  required: true,
				  alpha:true,
				  minlength: 3
				},
				/* turn_disc:{
				  required: true,
				  number: true,
				   min: 1
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
					required: true,
					//alphanumeric: true
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
					required: "Please enter brand name",
					minlength: "Minimum length at least 3 characters",
					remote: "Company name already exists!",
				},
				contact_person:
				{
					required: "Please enter contact person name",
					minlength: "Minimum length at least 3 characters",
				},				
				p_mobile:
				{
					required: "Please enter mobile number",
					remote: "Mobile already exists!"
				},				
				p_email:{
				  required:'Please enter email',
				  email: 'Please enter valid email address',
				  remote: "Email already exists!"
				},
				p_loc:{
				  required:'Please enter location'
				},
				"cati[]":{
					required: "Please select category"
				},
				"sub_cati[]":{
					required: "Please select sub-category"
				},
				med:{
					required: "Please select medicine"
				},
				"holder_name[]":{
					required: "Enter account holder name"
				},
				"acc_no[]":{
					required: "Enter account number"
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
				
				$('.mCSB_container').css("top",0);
				//console.log(errorList);
				// Clean up any tooltips for valid elements
				$.each(this.validElements(), function(index, element) {
					var $element = $(element);
					console.log('+++++');
					var parent = $element.parent().attr('class');
					console.log($element);
					
					if (parent == "border-lable-flt") {
						console.log('in');
					   /*  $(element).closest(".check_wt_serc").data("title", "").tooltip("dispose");
						$(element).closest(".check_wt_serc").css("border", ""); */
						$(element).data("title", "").removeClass("error").tooltip("dispose");
						$(element).css("border", "");
						$(".custom-select").css("border", "");
					} else {
						console.log($element);
						$element.parent().children(".btn-group").find(".multiselect").data("title", "").removeClass("error").tooltip("dispose");
						$(element).parent().children(".btn-group").find(".multiselect").css("border", "");
						$(".custom-select").css("border", "");
					}

				});
				
				$.each(errorList, function(index, error) {					
					
					var $element = $(error.element);
					console.log(error.element.name);
					if (error.element.name == "cati[]" || error.element.name == "sub_cati[]" || error.element.name == "bank_name[]" || error.element.name == "med") {
						console.log($("#" + error.element.id).closest(".border-lable-flt"));
						
						//$element.tooltip("dispose").data("title", error.message).data("placement", "bottom").data("trigger", "manual").addClass("error").tooltip({ onShow: function() { this.getTrigger().fadeTo("slow", 0.8); } });
						$element.tooltip("dispose").data("title", error.message).data('trigger','focus').data("placement", "bottom").addClass("error").tooltip();
					   
						//$("#" + error.element.id).closest(".check_wt_serc").css("border", "1px solid red");
						$(".custom-select").css("border", "1px solid red");
						$("#" + error.element.id).parent().children(".btn-group").find(".multiselect").css("border", "1px solid red");
					} else {					
						
						$('.mCSB_container').css("top",0);
					   //$element.tooltip("dispose").data("title", error.message).data("placement", "bottom").addClass("error").tooltip({ onShow: function() { this.getTrigger().fadeTo("slow", 0.8); } });
					   $element.tooltip("dispose").data("title", error.message).data('trigger','focus').data("placement", "bottom").addClass("error").tooltip();
						

						$("#" + error.element.id).css("border", "1px solid red");
						$(".custom-select").css("border", "");
					}
					

				});
			},
			submitHandler: function(form) 
			{
				var err = 0;
									
				formData = new FormData(form);				
				$.ajax({
					url: url+"api/brands/update",
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
								text: "Company updated successfully!",
								type: 'success',
								shadow: true
							});
							//$("#add_brand")[0].reset();							
						}else{
							new PNotify({
								title: 'Error',
								text: 'Something went wrong, try again!',
								type: 'failure',
								shadow: true
							});
						}
						$(".bank_list_pos").html('');
						getbanks();
						$(".mCSB_container").css('top',0);
					}
				});
			
			}
			
		});
		
		// Remove Bank
		$(document).on("click", ".remove_bank",function(){
			id = $(this).attr('id');
			id = id.replace('rm_bnk_','');
			$('#delete_brand').modal('show');
			$("#hid_acid").val(id);
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
			$(this).parent('.hdg_bk').siblings('.bank_list').find('.bank_list_pos').prepend(html.join("\n"));
			//$(this).parent('.hdg_bk').siblings('.bank_list').append(html.join("\n"));
			var k = $(this).parent('.hdg_bk').siblings('.bank_list').find('.bank_list_pos').children('.bank_dtl_blk').length;
			//var k = $(this).parent('.hdg_bk').siblings('.bank_list').children('.bank_dtl_blk').length;
			var wth = $('.bank_dtl_blk').width()+32;
			var s = k*20;
			$(this).parent('.hdg_bk').siblings('.bank_list').find('.bank_list_pos').css('width', k*wth+s);
			//$(this).parent('.hdg_bk').siblings('.bank_list').css('width', k*wth+s);
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
		
	$(".del_yes").click(function(){

		var delval = $("#hid_acid").val();
		$.ajax({
			url: url+"api/brands/bank_delete",
			data: {acc_id:delval},
			type:'POST',
			datatype:'json',
			success : function(response){

				res= JSON.parse(response);

				if(res.status == 'success')
				{
					new PNotify({
						title: 'Success',
						text: "Bank deleted successfully!",
						type: 'success',
						shadow: true
					});
					$(".bank_list_pos").html('');
					getbanks();
				}
			}
		});
	});
	
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

				
function fromsbmt(frm){
	
	var myForm = ""; var formData = "";
		
	if(frm == "c"){ 
		myForm = document.getElementById('cr_cat');
		/* var catname = $("#cat_name").val();
		if(catname == "")
		{
			new PNotify({
				title: 'Error',
				text: 'Please enter category name!',
				type: 'failure',
				shadow: true
			});
			return false;
		} */
		var succ = "Category created successfully!";
	}else if(frm == "sc"){ 
		myForm = document.getElementById('cr_sub_ct');
		var catopt = $("input[name='catopt']:checked").val();
		var subcatname = $("#subcat_name").val();
		var succ = "Subcategory created successfully!";
		
		/* if(! $("input[name='catopt']").is(':checked'))
		{
			new PNotify({
				title: 'Error',
				text: 'Please select category!',
				type: 'failure',
				shadow: true
			});
			return false;
		}
		if(subcatname == "")
		{
			new PNotify({
				title: 'Error',
				text: 'Please enter subcategory!',
				type: 'failure',
				shadow: true
			});
			return false;
		} */
	}
	
	/* var catexists = $("#catexists").val();
	if(catexists == 0){	 */	
		
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
					//$("#cr_cat")[0].reset();
					$(myForm)[0].reset();
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

function checkcategory(cval)
{	
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
					new PNotify({
						title: 'Error',
						text: 'Category name already exists, try with another name!',
						type: 'failure',
						shadow: true
					});
					
					$("#catexists").val(1);
					if(cval == 'c')	$("#cat_name").focus();
					else $("#subcat_name").focus();
					return false;
				}else{  $("#catexists").val(0); return true; }			
			}
		});
	}
}
function checkbrandname()
{
	var bname = $("#hid_bname").val().trim();		
	var brandname = $("#brand_name").val().trim();
	
	if(brandname !=""){ 
		
		if(bname != brandname)
		{
			$.ajax({		
				url: url+"api/Brands/checkbrandname",
				data: {brand_name:encodeURIComponent(brandname.trim())},
				type:'POST',		
				datatype:'json',
				success : function(response){
					if(response == 1)
					{
						new PNotify({
							title: 'Error',
							text: 'Company name already exists, try with another name!',
							type: 'failure',
							shadow: true
						});
						
						$("#brandexists").val(1);
						$("#brand_name").focus();
						return false;
					}else{  $("#brandexists").val(0); return true;	}			
				}
			});
		}
	}
}
function checkbrandemail()
{	
	var hid_email = $("#hid_email").val().trim();
	var pemail = $("#p_email").val().trim();
	if(pemail !=""){ 
		
		if(hid_email != pemail)
		{
			$.ajax({		
				url: url+"api/Brands/checkbrandemail",
				data: {brand_email:encodeURIComponent(pemail.trim())},
				type:'POST',		
				datatype:'json',
				success : function(response){
					if(response == 1)
					{
						new PNotify({
							title: 'Error',
							text: 'Email already exists, try with another email!',
							type: 'failure',
							shadow: true
						});
						
						$("#emailexists").val(1);
						$("#p_email").focus();
						return false;
					}else{  
						$("#emailexists").val(0); return true;
					}			
				}
			});
		}
	}
}
function checkbrandmobile()
{	
	var hid_mob = $("#hid_mob").val().trim();
	var pmobile = $("#p_mobile").val().trim();
	if(pmobile !=""){

		if(hid_mob != pmobile)
		{
			$.ajax({		
				url: url+"api/Brands/checkbrandmobile",
				data: {brand_mobile:encodeURIComponent(pmobile.trim())},
				type:'POST',		
				datatype:'json',
				success : function(response){
					if(response == 1)
					{
						new PNotify({
							title: 'Error',
							text: 'Mobile number already exists, try with another number!',
							type: 'failure',
							shadow: true
						});
						
						$("#mobexists").val(1);
						$("#p_mobile").focus();
						return false;
					}else{  
						$("#mobexists").val(0); return true;
					}			
				}
			});
		}
	}
}
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
<div class="create_popup"> 
	<div class="pp_clss cl_pp"><i class="fa fa-times" aria-hidden="true"></i></div>
	<form action="javascript:void(0);" id="cr_cat" name="cr_cat" method="post" >
		<div class="hdg_bk">  Create Category  </div>
		<div class="row"> 
			<div class="col-md-12"> 
				<div class="form-group">
					<span class="border-lable-flt">
						<!-- <input type="text" class="form-control" id="cat_name" name="cat_name" aria-describedby="emailHelp" placeholder=" " onkeyup="checkcategory('c');" > -->
						<input type="text" class="form-control" id="cat_name" name="cat_name" aria-describedby="emailHelp" placeholder=" " />
						<label class="control-label required" for="subcat_name">Category Name</label>
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
				<!-- <button type="button" id="cat_sbmt" class="btn btn-primary btn_sbmt" onclick="checkcategory('c');fromsbmt('c');" >Submit</button> -->
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
						<!-- <input type="text" class="form-control" id="subcat_name" name="subcat_name" placeholder=" " onkeyup="checkcategory('c');" /> -->
						<input type="text" class="form-control" id="subcat_name" name="subcat_name" placeholder=" " />
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
				<!-- <button type="button" id="cat_sbmt" class="btn btn_sbmt btn-primary" onclick="checkcategory('sc');fromsbmt('sc');" >Submit</button> --> 		
				<button type="submit" id="cat_sbmt" class="btn btn_sbmt btn-primary" >Submit</button> 		
				<button type="button" class="btn btn-danger btn_cls cl_pp">Close</button> 
			</div>
		</div>
	</form>

</div>
<div class="modal" id="delete_brand">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<h1> Are You Sure ! </h1>
				<p> Do you want to delete this Account ? </p>
			</div>
			<div class="modal_footer">
				<button type="button" class="btn btn-primary del_yes" data-dismiss="modal">Yes</button>
			<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
			<input type="hidden" id="hid_acid" value="" />
			</div>
		</div>
	</div>
</div>
<div class="alpha_blk"> </div>
<?php require_once 'footer.php' ; ?>