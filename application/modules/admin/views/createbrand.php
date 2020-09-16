<?php require_once 'header.php' ; ?>
<link href="<?php echo base_url();?>assets/css/createbrand.css" type="text/css" rel="stylesheet">
<?php require_once 'sidebar.php' ; ?>		
<div class="right_blk">
	<div class="top_ttl_blk"> 
		<span class="back_btn"><!-- <a href="<?php echo base_url();?>admin/brands" title=""><img src="<?php echo base_url();?>assets/images/back.png" alt="" title=""> </a> --></span> 
		
		<span> <?php echo $page_title;?></span>
		<!-- <a href="#" title="" class="fr btn btn-primary"> Show all brands  </a> -->
	</div>

	<div class="padding_30"> 
		<div class="card_view"> 
			<div class="padding_30"> 
			<!--     <div class="hdg_bk">  Create Brand   </div> -->
				<form action="javascript:void(0);" id="add_brand" name="add_brand" method="post" >
					<div class="row"> 

						<div class="col-md-4"> 
							<div class="form-group">
							<label class="control-label required"> Company Name</label>
							<input type="text" class="form-control" id="brand_name" name="brand_name" placeholder="Company Name" >
							</div> 
						</div>

						<div class="col-md-4"> 
							<div class="form-group">
								<label class="control-label required"> Contact Person Name</label>
								<input type="text" class="form-control" id="contact_person" name="contact_person" placeholder="Contact Person Name">
							</div>
						</div>

						<div class="col-md-4"> 
							<div class="form-group">
								<label class="control-label required"> Mobile Number</label>
								<input type="text" class="form-control" id="p_mobile" name="p_mobile" placeholder="Mobile Number">
							</div>
						</div>

						<div class="col-md-4"> 
							<div class="form-group">
								<label class="control-label required"> Email</label>
								<input type="email" class="form-control" id="p_email" name="p_email" placeholder="Email">
							</div>
						</div>

						<div class="col-md-4"> 
							<div class="form-group">
								<label class="control-label required"> Location</label>
								<input type="text" class="form-control" id="p_loc" name="p_loc" placeholder="Location">
							</div>
						</div>

						<div class="col-md-4"> 
							<div class="form-group">
								<label class="control-label required"> Turnover discount</label>
								<input type="text" class="form-control allownumericwithdecimal" id="turn_disc" name="turn_disc" placeholder="Turnover discounts">
							</div>
						</div>
						<div class="col-md-4"> 
							<div class="form-group">
								<label class="control-label required"> Opening Balance</label>
								<input type="text" id="tbal_commas" name="tbal_commas" class="form-control mykey" value="" onkeyup = "amount_with_commas('add');" onblur = "amount_with_commas('add');"  placeholder="Opening Balance" />
							<input type="hidden" id="tbal" name="tbal" class="form-control" value="" />
							</div>
						</div>
					</div>

					<div class="cat_blk_nn">
						<div class="hdg_bk"> Category Selection   </div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label required"> Category  &nbsp;<span><a href="javascript:void(0);" id="catnew" class="btn btn-info btn-sm" >Add</a></span></label>
									<select id="cati" name="cati[]" multiple="multiple">
									</select>
									<label id="cati-error" class="error" for="cati"></label>
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label required"> Subcategory  &nbsp;<span><a href="javascript:void(0);" id="subcatnew" class="btn btn-info btn-sm" >Add</a></span></label>
									<select id="sub_cati" name="sub_cati[]" multiple="multiple">
									</select>
									<label id="sub_cati-error" class="error" for="sub_cati"></label>
								</div>
							</div>

							<div class="col-md-12 cat_sub_select"> 
								<b> Selected Sub Category </b>
								<ul class="subcat_ul"> 
									<li style="color:red;"> None </li>
								</ul>
							</div>

							<div class="col-md-4 med_div"> 
								<div class="form-group"> 
									<label class="control-label required"> Medicine Type</label>
									<select id="med" name="med" > 
										<option value=""> -- Select -- </option>
										<option value="1"> Medicine1 </option>
										<option value="2" > Medicine2 </option>
										<option value="3"> Medicine3 </option>
									</select>
									<label id="med-error" class="error" for="med"></label>
								</div>
							</div>

							<div class="col-md-2"> 
								<div class="form-group"> 
									<label class="control-label required"> Status</label>
									<select id="pub" name="pub"> 
										<option value="1" selected> Publish </option>
										<option value="0" > Unpublish </option>
									</select>
								</div>
							</div>

						</div>
					</div>
					
					<div class="cat_blk_nn">
						<div class="hdg_bk"> Bank Details </div>
						<div class="row">
							<div class="col-md-3"> 
								<div class="form-group">
									<label class="control-label required"> Account Holder Name </label>
									<input type="text" class="form-control" id="holder_name" name="holder_name" required placeholder="Holder Name">
								</div>
							</div>
							<div class="col-md-3"> 
								<div class="form-group">
									<label class="control-label required"> Account Number </label>
									<input type="text" class="form-control allownumericwithoutdecimal" id="acc_no" name="acc_no" required placeholder="Account Number">
								</div>
							</div>
							<div class="col-md-3"> 
								<div class="form-group">
									<label class="control-label required"> Bank Name </label>
									<input type="text" class="form-control" id="bank_name" name="bank_name" required placeholder="Bank Name">
								</div>
							</div>
							<div class="col-md-3"> 
								<div class="form-group">
									<label class="control-label required"> IFSC Code </label>
									<input type="text" class="form-control alphanumeric" id="ifsc_code" name="ifsc_code" required placeholder="IFSC Code">
								</div>
							</div>
							<div class="col-md-3"> 
								<div class="form-group">
									<label class="control-label required"> Branch Name </label>
									<input type="text" class="form-control" id="branch_name" name="branch_name" required placeholder="Branch Name">
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-4">
							<button type="submit" class="btn btn-primary" >Submit</button>
						</div>
					</div>
				</form>
				<input type="hidden" id="catexists" name="catexists" value="0" />
				<input type="hidden" id="brandexists" name="brandexists" value="0" />
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
var url = '<?php echo base_url()?>';
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
					opt_radio += "<input type='radio' class='form-check-input' id='"+valcheck+"' name='catopt' value='"+valcheck+"' /> " + cat.cat_name + " ";
				});
			}
			$(".catdiv").html(opt_radio);
			$("#cati").html(opt);
			$("#cati").multiselect('rebuild');
		}
	});
}
	
$(document).ready(function() {
	
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
			url: url+"api/brands/getSubCat",
			data: {catid:value},
			type:'POST',		
			datatype:'json',
			success : function(response){
				
				var opt = new_cont = sel = "";
				res= JSON.parse(response);				
				//alert(res.length);
				if(res.length > 0)
				{				
					$.each(res, function(index, subcat) {
						
						var valcheck = subcat.parent_id+'-'+subcat.subcat_id;
						if($.inArray( valcheck, sel_subcat ) != -1){ 
							sel = "selected"; 
							new_cont += '<li class="new_cont"> '+subcat.subcat_name+'<span class="cls_itm"><img src="<?php echo base_url();?>assets/images/close_btn.png" /></span><input type="hidden" value="'+subcat.parent_id + '-'+subcat.subcat_id +'" /></li>';
						}else{ sel = ""; } 				
						opt += "<option value='" + valcheck + "' "+sel+" >" + subcat.subcat_name + "</option>";
						
					});					
				}
				else{
					//$('.subcat_ul').html('<li style="color:red;"> None </li>');
					new_cont = '<li style="color:red;"> None </li>';
				}
				
				$("#sub_cati").html(opt);
				$("#sub_cati").multiselect('rebuild');
				$('.subcat_ul').html(new_cont);
				//alert(res[0].subcat_id);	
			}
		});
	}
	
    $('#cati').change(function () {		
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
		var subcat = subcatval = scat = [];
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
	
	
	$("#add_brand").submit(function(e) {
			
			e.preventDefault();
		}).validate({
			rules:{
				
				brand_name:
				{
					required: true,
					minlength: 3
				},				
				contact_person:{
					required:true,
					lettersonly:true,
					minlength:3
				},				
				p_mobile:{
					required:true,
					number:true,
					minlength:10,
					maxlength:10
				},				
				p_email:{
				  required: true,
				  email:true,				 
				},
				p_loc:{
				  required: true,
				  minlength: 3
				},
				turn_disc:{
				  required: true,
				  number: true,
				  min: 1,
				  max: 100
				},
				"cati[]":{
					required: true
				},
				"sub_cati[]":{
					required: true
				},
				med:{
					required: true
				}
			},
			messages: {
				brand_name:
				{
					required: "Please enter brand name",
					minlength: "Minimum length at least 3 characters",
				},
				contact_person:
				{
					required: "Please enter contact person name",
					minlength: "Minimum length at least 3 characters",
				},				
				p_mobile:
				{
					required: "Please enter mobile number"
				},				
				p_email:{
				  required:'Please enter email',
				  email: 'Please enter valid email address'
				}

			}
			,
			submitHandler: function(form) 
			{

				var brandexists = $("#brandexists").val();
				if(brandexists == 1)
				{
					new PNotify({
						title: 'Error',
						text: 'Brand name already exists, try with another name!',
						type: 'failure',
						shadow: true
					});
					return false;
				}
				else{
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
									text: "Brand created successfully!",
									type: 'success',
									shadow: true
								});
								
								setInterval('location.reload()', 5000);
															
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
	
	$("#brand_name").keyup(function(){ checkbrandname(); });
		
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

function fromsbmt(frm)
{
	
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
	if(catexists == 0)
	{		
		
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
			}
		});
		allcats();		
	}
}
function checkcategory(cval)
{
	//var clikedForm = $("#cr_cat");
	//var catname = clikedForm.find("[name='cat_name']").val().trim();
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
					
				}else{  
					$("#catexists").val(0); return true;
				}			
			}
		});
	}
}
function checkbrandname()
{	
	var brandname = $("#brand_name").val().trim();
	if(brandname !=""){ 
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
				}else{  
					$("#brandexists").val(0); return true;
				}			
			}
		});
	}
}

</script>
<div class="create_popup"> 
	<form action="javascript:void(0);" id="cr_cat" name="cr_cat" method="post" >
		<div class="hdg_bk">  Create Category  </div>
		<div class="row"> 
			<div class="col-md-12"> 
				<div class="form-group">
					<input type="text" class="form-control" id="cat_name" name="cat_name" placeholder="Category Name" onkeyup="checkcategory('c');">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12"> 
				<div class="form-group">
					<textarea id="cat_desc" name="cat_desc" placeholder="Discription"></textarea>
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
					<label class="form-check-label catdiv">
						
					</label>
				</div>
				
		</div>

		<div class="row"> 
			<div class="col-md-12"> 
				<div class="form-group">
					<input type="text" class="form-control" id="subcat_name" name="subcat_name" placeholder="Enter Sub Category" onkeyup="checkcategory('sc');">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12"> 
				<div class="form-group">
					<textarea id="subcat_desc" name="subcat_desc" placeholder="Discription"></textarea>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<button type="button" id="subcat_sbmt" class="btn btn-primary" onclick="checkcategory('sc');fromsbmt('sc');" >Submit</button> 
			</div>
			<div class="col-md-6">
				<button type="button" class="btn btn-danger cl_pp">Close</button> 
			</div>
		</div>
	</form>

</div>
<div class="alpha_blk"> </div>
<script>
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