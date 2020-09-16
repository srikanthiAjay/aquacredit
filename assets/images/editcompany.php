<?php require_once 'header.php' ; ?>
<link href="<?php echo base_url();?>assets/css/createbrand.css" type="text/css" rel="stylesheet">
<?php require_once 'sidebar.php' ; ?>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/snackbar.css" >	
<style>
.border-lable-flt .form-control::-moz-placeholder{
  opacity: 1;
  -moz-transition: all .2s;
          transition: all .2s;
}
.border-lable-flt .form-control::-moz-placeholder {
  opacity: 1;
  -moz-transition: all .2s;
          transition: all .2s;
}
.border-lable-flt .form-control:placeholder-shown:not(:focus)::-moz-placeholder {
  opacity: 0;
}

.border-lable-flt .form-control::-webkit-input-placeholder{
  opacity: 1;
  -webkit-transition: all .2s;
          transition: all .2s;
}
.border-lable-flt .form-control::-webkit-input-placeholder {
  opacity: 1;
  -webkit-transition: all .2s;
          transition: all .2s;
}
.border-lable-flt .form-control:placeholder-shown:not(:focus)::-webkit-input-placeholder {
  opacity: 0;
}
.border-lable-flt {
  display: block;
  position: relative;
}
.border-lable-flt label, .border-lable-flt > span {
  position: absolute;
  left: 0;
  top: 0;
  cursor: text;
  font-size: 75%;
  opacity: 1;
  -webkit-transition: all .2s;
          transition: all .2s;
  top: -.5em;
  left: 0.75rem;
  z-index: 3;
  line-height: 1;
  padding: 0 1px;
}
.border-lable-flt label::after, .border-lable-flt > span::after {
  content: " ";
  display: block; 
  position: absolute;
  background: white;
  height: 2px;
  top: 50%;
  left: -.2em;
  right: -.2em;
  z-index: -1;
}

.border-lable-flt .form-control:placeholder-shown:not(:focus) + * {
  font-size: 100%;
  opacity: .5;
  top: 1em;
}

.input-group .border-lable-flt {
  display: table-cell;
}
.input-group .border-lable-flt .form-control {
  border-radius: 0.25rem;
}
.input-group .border-lable-flt:not(:last-child), .input-group .border-lable-flt:not(:last-child) .form-control {
  border-bottom-right-radius: 0;
  border-top-right-radius: 0;
  border-right: 0;
}
.input-group .border-lable-flt:not(:first-child), .input-group .border-lable-flt:not(:first-child) .form-control {
  border-bottom-left-radius: 0;
  border-top-left-radius: 0;
}

.form-control:focus {
  /* color: #804000; */
  background-color: #fff;
  /* border-color: #006633; */
  border-color: red;
  box-shadow: 0 0 0 0.2rem rgba(0, 102, 51, 0.25);
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
.bname ~ .btn-group .multiselect-container {width: 210px!important;}
.multiselect-container input[type="radio"] {display: none;}
.remove img {width: 15px;}
.per_dtls {padding: 20px 20px 0px 20px; border-bottom: 10px solid #f0f1f5;}
.blck_div {padding: 0px 20px 0px 20px; border-bottom: 10px solid #f0f1f5;}
.hdg_bk {padding: 10px 20px 10px 20px; border-bottom: 5px solid #f0f1f5;}
.bank_list.blck_div {padding: 0px 20px 0px 20px!important;}
.blck_div.bal_blk {border-bottom: none!important;}
#brand_sbmt {margin-left: 20px; margin-bottom: 10px;}
#brand_sbmt {margin-left: 20px; margin-bottom: 10px; }
#catnew, #subcatnew {font-size: 13px; padding: 2px 10px;}
.custom-select {position: relative;}

.custom-select {background-image: url(http://3.7.44.132/aquacredit/assets/images/select_arow.png); position: relative;}

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
								<input type="text" class="form-control" id="brand_name" name="brand_name" value="" placeholder=" " onblur="checkbrandname();" />
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
							<button type="submit" class="btn btn-primary" id="brand_sbmt" onclick="checkbrandname();" >Update</button>
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
			var multi_bank = chk = "";
			if(res.data != "")
			{
				$.each(res.data, function(index, bank){
					
					if(bank.status == 1){ chk = "checked"; $("#active_bank").val(bank.acc_id); }else{ chk = ""; } 
					multi_bank +='<div class="bank_dtl_blk">\
					<label class="st"><input type="radio" name="cur_bank" value="'+bank.acc_id+'" '+chk+'/>&nbsp;Active&nbsp;</label>\
					<div class="row" style="margin-top:15px;">\
						<div class="col-md-12">\
							<div class="form-group">\
								<span class="border-lable-flt">\
									<input type="text" class="form-control" placeholder=" " value="'+bank.full_name+'" disabled />\
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
									<input type="text" class="form-control" placeholder=" " value="'+bank.branch_name+'" disabled />\
									<label for="fname_1">Branch Name</label>\
								</span>\
							</div>\
						</div>\
						</div>\
					</div>';
				});
				//$(".multi_banks").html(multi_bank);
				$(".bank_list_pos").append(multi_bank);
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
					opt_radio += "<input type='radio' class='form-check-input' id='"+valcheck+"' name='catopt' value='"+valcheck+"' /> " + cat.cat_name + " ";
				});
				
				var catvals = $('#hid_cats').val();	
				selected_cats(catvals.split(','));
			}
			$(".catdiv").html(opt_radio);
			$("#cati").html(opt);
			$("#cati").multiselect('rebuild');
		}
	});
}

function selected_cats(value)
{	
	var subcat = [];
	var new_cont = "";
				
	var subcatvals = $('#hid_subcats').val();
	var subcat_arry = subcatvals.split(',');
	var sel = "";
	
	if($.inArray( '2', value ) != -1)
	{
		$(".med_div").show();
	}else{
		$(".med_div").hide();
	}
	
	$.ajax({		
		url: url+"api/brands/getSubCat",
		data: {catid:value},
		type:'POST',		
		datatype:'json',
		success : function(response){
			
			var opt = new_cont = sel = "";
			//alert(response);
			res= JSON.parse(response);			
			if(res.length > 0)
			{				
				$.each(res, function(index, subcat) {
					
					if($.inArray( subcat.subcat_id, subcat_arry ) != -1)
					{ 
						sel = "selected";
						new_cont += '<li class="new_cont"> '+subcat.subcat_name+'<span class="cls_itm"><img src="<?php echo base_url();?>assets/images/close_btn.png" /></span><input type="hidden" value="'+subcat.parent_id + '-'+subcat.subcat_id +'" /></li>';						
					}else{ sel = ""; } 
					opt += "<option value='" + subcat.parent_id + '-'+subcat.subcat_id + "' "+sel+" >" + subcat.subcat_name + "</option>";
					
				});	
				
				//$('.subcat_ul').html(new_cont);
			}
			else{
				
				//$('.subcat_ul').html('<li style="color:red;"> None </li>');
				new_cont = '<li style="color:red;"> None </li>';
			}
			
			
			$("#sub_cati").html(opt);
			$("#sub_cati").multiselect('rebuild');
			$('.subcat_ul').html(new_cont);
			
					
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
	
	$(document).on('click',"#brand_sbmt",function(){
		
		var err = 0;
		var brandexists = $("#brandexists").val();
		var emailexists = $("#emailexists").val();
		var mobexists = $("#mobexists").val();		
		
		if(brandexists == 1)
		{
			err = 1;
			new PNotify({
				title: 'Error',
				text: 'Company name already exists, try with another name!',
				type: 'failure',
				shadow: true
			});
			return false;
		}
		if(emailexists == 1)
		{
			err = 1;
			new PNotify({
				title: 'Error',
				text: 'Email already exists, try with another email!',
				type: 'failure',
				shadow: true
			});
			return false;
		}
		if(mobexists == 1)
		{
			err = 1;
			new PNotify({
				title: 'Error',
				text: 'Mobile already exists, try with another number!',
				type: 'failure',
				shadow: true
			});
			return false;
		}
		if($("#brand_name").val() == "")
		{
			err = 1; err_msg = "Please enter company name!"; tagid = "#brand_name";
			return form_validation(err,err_msg,tagid);
		}
		if($("#contact_person").val() == "")
		{
			err = 1; err_msg = "Please enter contact person name!"; tagid = "#contact_person";
			return form_validation(err,err_msg,tagid);
		}
		if($("#p_mobile").val() == "")
		{
			err = 1; err_msg = "Please enter mobile number!"; tagid = "#p_mobile";
			return form_validation(err,err_msg,tagid);
		}
		if($("#p_email").val() == "")
		{
			err = 1; err_msg = "Please enter email address!"; tagid = "#p_email";
			return form_validation(err,err_msg,tagid);
		}
		if(!/^[0-9a-zA-Z_.-]+@[a-zA-Z]+[.][a-zA-Z]{2,5}$/.test($("#p_email").val()))
		{
			err = 1; err_msg = "Please enter valid email address!"; tagid = "#p_email";
			return form_validation(err,err_msg,tagid);
		}
		
		if($("#cati").val() == null)
		{
			err = 1; err_msg = "Please select categories!"; tagid = "#cati";
			return form_validation(err,err_msg,tagid);
		}
		if($("#sub_cati").val() == null)
		{
			err = 1; err_msg = "Please select sub-categories!"; tagid = "#sub_cati";
			return form_validation(err,err_msg,tagid);
		}
		if($.inArray( "2", $('#cati').val() ) !== -1)
		{
			if($('select[name=med]').find(":selected").val() == "")
			{
				err = 1; err_msg = "Please select medicine!"; tagid = "#med";
				return form_validation(err,err_msg,tagid);
			}
		}
		
		$("#add_brand input[type='text'], .bname").each(function(){
        	
        	if($(this).val() == ''){
        		
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
					else if(split_id[0] == "ac"){ err_msg = "Please enter account number!"; }
					else if(split_id[0] == "bc"){ err_msg = "Please select bank name!"; }
					else if(split_id[0] == "ifsc"){ err_msg = "Please enter ifsc code!"; }
					else if(split_id[0] == "branch"){ err_msg = "Please enter branch name!"; }
					return form_validation(err,err_msg,tagid);
        		}			
        						
        	}
        });
		
		//else{
		if(err == 0){
			formData = new FormData(add_brand);		
		
			$.ajax({
				url: url+"api/Brands/update",
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
						
						//setInterval('location.reload()', 5000);
						setInterval('window.location.replace("../");', 5000);
													
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
	});	
	
	$("#brand_name").keyup(function(){ checkbrandname(); });
	$("#p_email").keyup(function(){ checkbrandemail(); });
	$("#p_mobile").keyup(function(){ checkbrandmobile(); });
	
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
			'<input type="text" class="form-control" id="fname_'+extra_id+'" name="holder_name[]" placeholder=" " />',
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
		   '<input type="text" class="form-control" id="branch_name_'+extra_id+'" name="branch_name[]" placeholder=" " />',
			'<label for="branch_name_'+extra_id+'">Branch Name</label></span>',
		  '</div>',
		  '</div></div> </div>'];
			$(this).parent('.hdg_bk').siblings('.bank_list').children('.bank_list_pos').prepend(html.join("\n"));
			//$(this).parent('.hdg_bk').siblings('.bank_list').append(html.join("\n"));
			var k = $(this).parent('.hdg_bk').siblings('.bank_list').children('.bank_list_pos').children('.bank_dtl_blk').length;
			//var k = $(this).parent('.hdg_bk').siblings('.bank_list').children('.bank_dtl_blk').length;
			var wth = $('.bank_dtl_blk').width()+32;
			var s = k*20;
			$(this).parent('.hdg_bk').siblings('.bank_list').children('.bank_list_pos').css('width', k*wth+s);
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
		
});


$("#catnew").click(function(){
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
		var catname = $("#cat_name").val();
		if(catname == "")
		{
			new PNotify({
				title: 'Error',
				text: 'Please enter category name!',
				type: 'failure',
				shadow: true
			});
			return false;
		}
		var succ = "Category created successfully!";
	}else if(frm == "sc"){ 
		myForm = document.getElementById('cr_sub_ct');
		var catopt = $("input[name='catopt']:checked").val();
		var subcatname = $("#subcat_name").val();
		var succ = "Subcategory created successfully!";
		
		if(! $("input[name='catopt']").is(':checked'))
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
		}
	}
	
	var catexists = $("#catexists").val();
	if(catexists == 0){		
		
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
			}
		});
		allcats();
	}
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
							text: 'Brand name already exists, try with another name!',
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
	<form action="javascript:void(0);" id="cr_cat" name="cr_cat" method="post" >
		<div class="hdg_bk">  Create Category  </div>
		<div class="row"> 
			<div class="col-md-12"> 
				<div class="form-group">
					<span class="border-lable-flt">
						<input type="text" class="form-control" id="cat_name" name="cat_name" aria-describedby="emailHelp" placeholder=" " onkeyup="checkcategory('c');" >
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
						<label class="control-label required" for="subcat_name">Description</label>
					</span>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<button type="button" id="cat_sbmt" class="btn btn-primary" onclick="checkcategory('c');fromsbmt('c');" >Submit</button> 
			</div>
			<div class="col-md-6">
				<button type="button" class="btn btn-danger cl_pp">Close</button> 
			</div>
		</div>
	</form>
  
	<form action="javascript:void(0);" id="cr_sub_ct" name="cr_sub_ct" method="post" >
		<div class="hdg_bk">  Create Sub Category  </div>

		<div class="sel_ca"> 			
			<div class="form-check-inline">
				<label class="form-check-label catdiv"></label>
			</div>				
		</div>

		<div class="row"> 
			<div class="col-md-12"> 
				<div class="form-group">
					<span class="border-lable-flt">
						<input type="text" class="form-control" id="subcat_name" name="subcat_name" placeholder=" " onkeyup="checkcategory('c');" >
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
						<label class="control-label required" for="subcat_name">Description</label>
					</span>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<button type="button" id="cat_sbmt" class="btn btn-primary" onclick="checkcategory('sc');fromsbmt('sc');" >Submit</button> 
			</div>
			<div class="col-md-6">
				<button type="button" class="btn btn-danger cl_pp">Close</button> 
			</div>
		</div>
	</form>

</div>
<div class="alpha_blk"> </div>
<?php require_once 'footer.php' ; ?>