<?php require_once 'header.php' ; ?>
<link href="<?php echo base_url();?>assets/css/createbrand.css" type="text/css" rel="stylesheet">
<?php require_once 'sidebar.php' ; ?>	
	
<div class="right_blk">
	<div class="top_ttl_blk"> 
		<span class="back_btn"><!-- <a href="<?php echo base_url();?>admin/brands" title=""><img src="<?php echo base_url();?>assets/images/back.png" alt="" title=""> </a> --></span> 
		
		<span> <?php echo $page_title;?></span>
		<?php if($PAGE_SEGMENT == "view"){ ?>
			<a href="<?php echo base_url();?>admin/brands/edit/<?php echo $bid;?>" title="" class="fr btn btn-primary">Edit Brand  </a> 
		<?php } ?>
	</div>

	<div class="padding_30"> 
		<div class="card_view"> 
			<div class="padding_30"> 
			<!--     <div class="hdg_bk">  Create Brand   </div> -->
				<form action="javascript:void(0);" id="add_brand" name="add_brand" method="post" >
					<div class="row"> 

						<div class="col-md-4"> 
							<div class="form-group">
							<label class="control-label required"> Brand Name </label>
							<input type="text" class="form-control" id="brand_name" name="brand_name" value="" placeholder="Brand Name" onblur="checkbrandname();">
							</div> 
						</div>

						<div class="col-md-4"> 
							<div class="form-group">
								<label class="control-label required"> Contact Person Name</label>
								<input type="text" class="form-control" id="contact_person" name="contact_person" value="" placeholder="Contact Person Name">
							</div>
						</div>

						<div class="col-md-4"> 
							<div class="form-group">
								<label class="control-label required"> Mobile Number</label>
								<input type="text" class="form-control" id="p_mobile" name="p_mobile" value="" placeholder="Mobile Number">
							</div>
						</div>

						<div class="col-md-4"> 
							<div class="form-group">
								<label class="control-label required"> Email</label>
								<input type="email" class="form-control" id="p_email" name="p_email" value="" placeholder="Email">
							</div>
						</div>

						<div class="col-md-4"> 
							<div class="form-group">
								<label class="control-label required"> Location</label>
								<input type="text" class="form-control" id="p_loc" name="p_loc" value="" placeholder="Location">
							</div>
						</div>

						<div class="col-md-4"> 
							<div class="form-group">
								<label class="control-label required"> Turnover discount</label>
								<input type="text" class="form-control" id="turn_disc" name="turn_disc" value="" placeholder="Turnover discounts">
							</div>
						</div>
					</div>

					<div class="cat_blk_nn">
						<div class="hdg_bk"> Category Selection   </div>
						<div class="row">
							<div class="col-md-4">
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
									<label class="control-label required"> Select Type</label>
									<select id="med" name="med" >
										<option value=""> -- Select -- </option>
										<option value="1"> Medicine1 </option>
										<option value="2" > Medicine2 </option>
										<option value="3"> Medicine3 </option>
									</select>
									<label id="med-error" class="error" for="med"></label>
								</div>
							</div>

							<div class="col-md-4"> 
								<div class="form-group"> 
									<label class="control-label required"> Status</label>
									<select id="pub" name="pub"> 
										<option value="1" > Publish </option>
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
									<label class="control-label required"> Holder Name </label>
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
							<button type="submit" class="btn btn-primary" id="brand_sbmt" onclick="checkbrandname();" >Update</button>
							<input type="hidden" id="hid_bid" name="hid_bid" value="" />
							<input type="hidden" id="hid_bname" name="hid_bname" value="" />
							<input type="hidden" id="catexists" name="catexists" value="0" />
							<input type="hidden" id="brandexists" name="brandexists" value="0" />
							<input type="hidden" id="hid_cats" name="hid_cats" value="" />
							<input type="hidden" id="hid_subcats" name="hid_subcats" value="" />
							<input type="hidden" id="hid_acc_id" name="hid_acc_id" value="" />
						</div>
					</div>
					
				</form>
				
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
var url = '<?php echo base_url()?>';

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
				$("#pub").val(res.data.status);	
				$("#pub").multiselect('rebuild');
				$("#holder_name").val(res.data.full_name);
				$("#acc_no").val(res.data.account_no);
				$("#bank_name").val(res.data.bank_name);
				$("#ifsc_code").val(res.data.ifsc);
				$("#branch_name").val(res.data.branch_name);
				$("#hid_cats").val(res.data.brand_cat);					
				$("#hid_subcats").val(res.data.brand_subcat);
				$("#hid_bid").val(res.data.brand_id);
				$("#hid_bname").val(res.data.brand_name);
				$("#hid_acc_id").val(res.data.acc_id);
				allcats(); 
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
	
	getbrand(); 
	
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
		$('#brand_sbmt').hide(); $('.cls_itm').hide();
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
				   min: 1
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
									text: "Brand updated successfully!",
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
						}
					});
				}
			}
			
		});
		
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
</script>
<div class="create_popup"> 
	<form action="javascript:void(0);" id="cr_cat" name="cr_cat" method="post" >
		<div class="hdg_bk">  Create Category  </div>
		<div class="row"> 
			<div class="col-md-12"> 
				<div class="form-group">
					<input type="text" class="form-control" id="cat_name" name="cat_name" aria-describedby="emailHelp" placeholder="Category Name" onkeyup="checkcategory('c');" >
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
					<input type="text" class="form-control" id="subcat_name" name="subcat_name" placeholder="Enter Sub Category" onkeyup="checkcategory('c');" >
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