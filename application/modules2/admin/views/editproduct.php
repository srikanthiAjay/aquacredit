<?php require_once 'header.php' ; ?>
<link href="<?php echo base_url();?>assets/css/product.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>assets/js/common.js" type="javascript"></script>
<?php require_once 'sidebar.php' ; ?>
<style>
.errorTxt{
  border: 1px solid red;
  min-height: 20px;
}
</style>		
<div class="right_blk"> 
	<div class="top_ttl_blk"> <span class="back_btn">
		<!-- <a href="<?php echo base_url();?>admin/products" title=""><img src="<?php echo base_url();?>assets/images/back.png" alt="" title=""> </a> --></span> 
		<span> <?php echo $page_title;?> </span>
		<?php if($PAGE_SEGMENT == "view"){ ?>
			<a href="<?php echo base_url();?>admin/products/edit/<?php echo $pid;?>" title="" class="fr btn btn-primary">Edit Product  </a> 
		<?php } ?>
	</div>
	<?php //print_r($products); ?>
	<div class="padding_30">
	<!-- create product -->
		<div class="card_view">
			<div class="padding_30">
		<!-- 		<div class="hdg_bk"> 
                      Create Product
                      <a href="#" title="" class="fr"> Show All Products </a>
                     </div> -->
				<form action="javascript:void(0);" id="prod_frm" name="prod_frm" method="post"> 
					<div class="row"> 
						<div class="col-md-4">
							<div class="form-group">
								<label for="prod_name" class="control-label required"> Product Name</label>
								<input type="text" class="form-control" id="prod_name" name="prod_name" placeholder="Product Name" value="" >
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label for="hsn" class="control-label required"> HSN</label>
								<input type="text" class="form-control allownumericwithoutdecimal" id="hsn" name="hsn" value="" placeholder="HSN">
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label for="tax" class="control-label required"> TAX</label>
								<input type="text" class="form-control allownumericwithdecimal" id="tax" name="tax" value="" placeholder="TAX">
							</div>
						</div>
					</div>
					
					<div class="row">

						<div class="col-md-4"> 
							<div class="form-group"> 
								<label for="cat" class="control-label required"> Category</label>
									<select id="cat" name="cat" >
									</select>
									<label id="cat-error" class="error" for="cat" style="display:none;"></label>
							</div>

						</div>

						<div class="col-md-4"> 
							<div class="form-group"> 
								<label for="subcat" class="control-label required"> Subcategory</label>
									<select id="subcat" name="subcat" ></select>
									<label id="subcat-error" class="error" for="subcat" style="display:none;"></label>
							</div>

						</div>

						<div class="col-md-4"> 
							<div class="form-group"> 
								<label for="brand" class="control-label required"> Brand</label>
								<select id="brand" name="brand"></select>
								<label id="brand-error" class="error" for="brand" style="display:none;"></label>
							</div>
						</div>

						<div class="col-md-4">
							<div class="mrp">

								<div class="row"> 
									<div class="col-md-12">
										<div class="form-group">
											<label for="mrp" class="control-label required"> MRP</label>
											<input type="text" class="form-control allownumericwithdecimal" id="mrp" name="mrp" value="" placeholder="MRP">
										</div>
									</div>
								</div>
								
								<div class="row"> 
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label required"> Purchase Amount</label>
											<input type="text" class="form-control allownumericwithdecimal" id="p_amt" name="p_amt" value="" placeholder=" Amount">
										</div>
								<!--     <div class="slct_box form-group"> 
											<select>
												<option> % </option>
												<option selected=> $ </option>
											</select>
									</div> -->
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label required"> Discount</label>
											<input type="text" class="form-control allownumericwithdecimal" id="mrp_perc" name="mrp_perc" value="" placeholder=" Discount(%)">
									  </div>
									</div>
									
								</div>
							</div>
						</div>

						<div class="col-md-8"> 
							<!-- <label><b>Quantity</b></label> -->
							<div class="row qty"> 
								<div class="col-md-4"> 
									<div class="form-group">
										<label class="control-label required"> Quantity</label>
										<input type="text" id="qty" name="qty" class="form-control allownumericwithoutdecimal" value="" placeholder="Enter Count">
									</div>
								</div>
								<div class="col-md-4"> 
									<div class="form-group">
										<label class="control-label required"> Units</label>
										<select id="qty_weight" name="qty_weight">
											
										</select>
										<label id="qty_weight-error" class="error" for="qty_weight" style="display:none;"></label>
									</div>
								</div>

								<div class="col-md-4"> 
									<div class="form-group">
										<label class="control-label required"> Packing</label>
										<select id="qty_opt" name="qty_opt">							
										</select>
										<label id="qty_opt-error" class="error" for="qty_opt" style="display:none;"></label>
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-4"> 
									<div class="form-group"> 
										<label for="pub" class="control-label required"> Status</label>
										<select id="pub" name="pub">
											<option value="1" > Publish </option>
											<option value="0" > Un Publish </option>
										</select>
									</div>
								</div>
							</div>
							
						</div>
					</div>

					<div class="row"> 
						<div class="col-md-12 pad_t">
							<button type="submit" id="prod_sbmt" class="btn btn-primary" >Update</button>
							<input type="hidden" id="hid_prod_id" name="hid_prod_id" value="" />
							<input type="hidden" id="prodexists" name="prodexists" value="0" />
							<input type="hidden" id="hid_pname" name="hid_pname" value="" />
							<input type="hidden" id="hid_brand" name="hid_brand" value="" />
							<input type="hidden" id="hid_qty" name="hid_qty" value="" />
							<input type="hidden" id="hid_unit" name="hid_unit" value="" />
							<div class="errorTxt" style="display:none;"></div>						
						</div>
					</div>
				</form>
			</div>
		</div>		
	<!-- End product -->
	</div>
</div>
<script type="text/javascript">
var url = '<?php echo base_url()?>';

function getproduct()
	{
		// Get Brand
		var pid = <?php echo $pid; ?>;
		$.ajax({		
			url: url+"api/products/index/"+pid,
			data: {},
			type:'POST',		
			datatype:'json',
			success : function(response){
				
				//alert(response);
				res= JSON.parse(response);				
				//alert(res.data.status);
				if(res.data != "")
				{
					$("#hid_prod_id").val(res.data.pid);
					$("#prod_name").val(res.data.pname);					
					$("#hsn").val(res.data.hsn);					
					$("#tax").val(res.data.tax);					
					$("#cat").val(res.data.cat_id);
					$("#subcat").val(res.data.subcat_id);
					$("#brand").val(res.data.brand_id);					
					$("#mrp").val(res.data.pmrp);	
					$("#p_amt").val(res.data.purchase_amt);	
					$("#mrp_perc").val(res.data.percentage);	
					$("#qty").val(res.data.qty);	
					$("#qty_weight").val(res.data.weightage);					
					$("#qty_opt").val(res.data.per_item);				
					
					$("#hid_pname").val(res.data.pname);					
					$("#hid_brand").val(res.data.brand_id);
					$("#hid_qty").val(res.data.qty);
					$("#hid_unit").val(res.data.weightage);			
					
					$("#cat").multiselect('rebuild');										
					$("#subcat").multiselect('rebuild');
					$("#brand").multiselect('rebuild');
					$("#qty_weight").multiselect('rebuild');
					$("#qty_opt").multiselect('rebuild');

					var cat_id = res.data.cat_id;
					var subcat_id = res.data.subcat_id;
					var brand_id = res.data.brand_id;
					
					selected_cat(cat_id,subcat_id);
					selected_subcat(subcat_id,brand_id);
						
				}				
			}
		});
		
	}
	
function getcategories()
{
	// Get Profile
	$.ajax({		
		url: url+"api/categories",
		data: {},
		type:'POST',		
		datatype:'json',
		success : function(response){
			
			res= JSON.parse(response);				
			
			var opt = "<option value='' > -- Select Category -- </option>";
			if(res.data.length > 0)
			{
				//$("#cat_count").text(res.data.length);
				$.each(res.data, function(index, cat) {
					opt += "<option value='" + cat.cat_id + "'>" + cat.cat_name + "</option>";
				});
			}
			$("#cat").html(opt);
			$("#cat").multiselect('rebuild');
			getproduct();
			
		}
	});
}
 
function getunits()
{
	// Get Profile
	$.ajax({		
		url: url+"api/units",
		data: {},
		type:'POST',		
		datatype:'json',
		success : function(response){			
			
			res= JSON.parse(response);				
			//alert(res.data.length);
			var opt = "<option value='' > -- Select Unit -- </option>";
			if(res.data.length > 0)
			{
				//$("#cat_count").text(res.data.length);
				$.each(res.data, function(index, unit) {
					opt += "<option value='" + unit.id + "'>" + unit.unit_name + "</option>";
				});
			}
			$("#qty_weight").html(opt);
			$("#qty_weight").multiselect('rebuild');
		}
	});
} 

function getpacking()
{
	// Get Profile
	$.ajax({		
		url: url+"api/packings",
		data: {},
		type:'POST',		
		datatype:'json',
		success : function(response){			
			
			res= JSON.parse(response);				
			//alert(res.data.length);
			var opt = "<option value='' > -- Select Packing -- </option>";
			if(res.data.length > 0)
			{
				//$("#cat_count").text(res.data.length);
				$.each(res.data, function(index, pack) {
					opt += "<option value='" + pack.id + "'>" + pack.packing_type + "</option>";
				});
			}
			$("#qty_opt").html(opt);
			$("#qty_opt").multiselect('rebuild');
		}
	});
} 

function selected_cat(value,subcat_id)
	{
		if(value != "")
		{
			
			$.ajax({		
				url: url+"api/subcategories/index/"+value,
				//data: {catid:value},
				type:'POST',		
				datatype:'json',
				success : function(response){			
					
					var opt = sel = "";
					res= JSON.parse(response);				
					//alert(res.data.length);
					if(res.data.length > 0)
					{
						opt += "<option value='' > -- Select Subcategory -- </option>";
						$.each(res.data, function(index, subcat) { 
							
							if(subcat.cat_id == subcat_id){ sel = "selected"; }else{ sel = ""; }
							opt += "<option value='" + subcat.cat_id + "' "+sel+" >" + subcat.cat_name + "</option>";
							
						});					
					}				
					$("#subcat").html(opt);
					$("#subcat").multiselect('rebuild');
					$("#brand").html('');
					$("#brand").multiselect('rebuild');
					<?php if($PAGE_SEGMENT == "view"){ ?>
						$('#prod_frm').find('input, textarea, button, select, ul').attr('disabled','disabled');
						$('#prod_sbmt').hide(); 
					<?php } ?>
				}
			});
		}else{
			$("#subcat").html('');
			$("#subcat").multiselect('rebuild');
			$("#brand").html('');
			$("#brand").multiselect('rebuild');
		}
	}
	function selected_subcat(value,brand_id)
	{
		if(value != "")
		{
			$.ajax({		
				url: url+"api/products/getbrandsbysubcat/"+value,
				//data: {catid:value},
				type:'POST',		
				datatype:'json',
				success : function(response){
					
					//alert(response);
					var opt = sel = "";
					res= JSON.parse(response);				
					//alert(res.length);
					if(res.length > 0)
					{
						opt += "<option value='' > -- Select Brand -- </option>";
						$.each(res, function(index, brand) {	
							
							if(brand.brand_id == brand_id){ sel = "selected"; }else{ sel = ""; }
							if(brand.status == 1){
								opt += "<option value='" + brand.brand_id + "' "+sel+" >" + brand.brand_name + "</option>";
							}
							
						});					
					}				
					$("#brand").html(opt);
					$("#brand").multiselect('rebuild');
					
					<?php if($PAGE_SEGMENT == "view"){ ?>
						$('#prod_frm').find('input, textarea, button, select, ul').attr('disabled','disabled');
						$('#prod_sbmt').hide(); 
					<?php } ?>			
					
				}
			});
		}else{
			$("#brand").html('');
			$("#brand").multiselect('rebuild');
		}
		
	}
 
$(document).ready(function() {
	
	 getcategories(); getunits(); getpacking();	

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
	
	$.validator.addMethod("decimal", function(value, element) {
		return this.optional(element) || /^\d{0,4}(\.\d{0,3})?$/i.test(value);
	}, "You include only three decimal places");
	

	$('#cat').multiselect();
	$('#subcat').multiselect();
	$('#brand').multiselect();
	$('#qty_weight').multiselect();
	$('#qty_opt').multiselect();
	$('#pub').multiselect();	
	
	// On Chage Category
	$('#cat').change(function () {		
		let value = $(this).val();
		selected_cat(value);				
    });
	
		
	
	
	// On Change SubCategory
	$('#subcat').change(function () {		
		let value = $(this).val();		
		selected_subcat(value);				
    });
	
	
	//Form submit
	$("#prod_frm").submit(function(e) {
			
		e.preventDefault();
	}).validate({
		rules:{
			
			prod_name:
			{
				required: true,
				minlength: 3
			},				
			hsn:{
				required:true,
				number: true,
				maxlength: 8
			},				
			tax:{
				required:true,
				number:true,
				minlength: 1,
				maxlength: 6
			},				
			cat:{
				required: true			 
			},
			subcat:{
				required: true
			},
			mrp:{
				required: true,
				number: true,
				min: 1
			},
			p_amt:{
				required: true,
				number: true,
				min: 1
			},
			mrp_perc:{
				required: true,
				number: true,
				decimal: true,
				min: 0,
				max: 100,					
			},
			brand:{
				required: true
			},
			qty:{
				required: true,
				number: true,
				minlength:1,
				maxlength:4
			},
			qty_weight:{
				required: true
			},
			qty_opt:{
				required: true
			},
			pub:{
				required: true
			}
		},
		messages: {
			prod_name:
			{
				required: "Please enter product name",
				minlength: "Minimum length at least 3 characters"
			},
			hsn:{
				required: "Please enter HSN "
			},				
			tax:{
				required:"Please enter TAX",
				/* minlength:10,
				maxlength:10 */
			},				
			cat:{
				required: "Please select category"			 
			},
			subcat:{
				required: "Please select subcategory"
			},
			brand:{
				required: "Please select brand"
			},
			mrp:{
				required: "Please enter MRP"
			},
			p_amt:{
				required: "Please enter amount"
			},
			mrp_perc:{
				required: "Please enter discount (%)"				
			},			
			qty:{
				required: "Please enter quntity"
			},
			qty_weight:{
				required: "Please enter unit"
			},
			qty_opt:{
				required: "Please enter package type"
			},
		},
		/* errorElement : 'div',
		errorLabelContainer: '.errorTxt', */
		submitHandler: function(form) 
		{
			var prodexists = $("#prodexists").val();
			if(prodexists == 1)
			{
				new PNotify({
					title: 'Error',
					text: 'The combination of product, brand, quantity and units already exists!',
					type: 'failure',
					shadow: true
				});
				return false;
			}
			else{
				formData = new FormData(form);		
			
				$.ajax({
					url: url+"api/products/update",
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
								text: "Product updated successfully!",
								type: 'success',
								shadow: true
							});
							//$("#prod_frm").reset();							
							setInterval('location.reload()', 3000);														
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
	
	// Puchase amount change
	$("#p_amt").keyup(function(){
		
		//var num = 5.56789;
		//var n = num.toFixed(2); 
		//Ans: 5.57
		/* var mrp = Number($("#mrp").val());
		var purch_val = Number($(this).val()); */
		var mrp = +$("#mrp").val();
		var purch_val = +$(this).val();
		
		if(mrp == ""){
			new PNotify({
				title: 'Error',
				text: 'Please enter MRP value!',
				type: 'failure',
				shadow: true
			});
			$("#mrp").focus();
			
			return false;			
		}
		if(purch_val >=mrp){
			new PNotify({
				title: 'Error',
				text: 'Please enter less than MRP value!',
				type: 'failure',
				shadow: true
			});
			$("#p_amt").focus();
			
			return false;			
		}
		var percent = (100 - ((100 * purch_val) / mrp));
		
		if(percent %1 == 0){
			$("#mrp_perc").val(percent);
		}else{	$("#mrp_perc").val(percent.toFixed(3)); }
		//alert(purch_val);
	});
	
	$("#mrp_perc").keyup(function(){
		
		var mrp = +$("#mrp").val();
		var percent = +$(this).val();
		
		if(mrp == ""){
			new PNotify({
				title: 'Error',
				text: 'Please enter MRP value!',
				type: 'failure',
				shadow: true
			});
			$("#mrp").focus();
			$("#mrp_perc").val(0);
			return false;			
		}
		
		var purch_val = (mrp - ((mrp * percent) / 100));
		$("#p_amt").val(purch_val);
	});
	
	// On Submit button click
	//$("#prod_sbmt").click(function(){ checkproductname(); });
	
	// On Quantity enter
	$("#qty , #prod_name").keyup(function(){ checkproductname(); });
	
	// On Weightage change
	$("#qty_weight , #brand").change(function(){ checkproductname();  });
	
	<?php if($PAGE_SEGMENT == "view"){ ?>
		//$("#add_brand :input").prop("disabled", true);
		$('#prod_frm').find('input, textarea, button, select, ul').attr('disabled','disabled');
		$('#prod_sbmt').hide(); 
	<?php } ?>
	
});
function checkproductname()
{
	var pname = $("#hid_pname").val();		
	var pbrand = $("#hid_brand").val();	
	var pqty = $("#hid_qty").val();
	var punits = $("#hid_unit").val();
	
	var prod_name = $("#prod_name").val().trim();	
	var brand = $("#brand").val().trim();	
	var qty = $("#qty").val().trim();	
	var units = $("#qty_weight").val().trim();	
	//if(prod_name !=""){

		if(pname != prod_name || pbrand != brand || pqty != qty || punits != units)
		{
			
			$.ajax({		
				//url: url+"admin/products/checkproductname",
				url: url+"api/products/checkproductname_by_qty_weight",
				data: {prod_name:encodeURIComponent(prod_name), brand:brand, qty:qty, units:encodeURIComponent(units)},
				type:'POST',		
				datatype:'json',
				success : function(response){
					if(response == 1)
					{
						new PNotify({
							title: 'Error',
							text: 'The combination of product, brand, quantity and units already exists!',
							type: 'failure',
							shadow: true
						});						
						$("#prodexists").val(1);
						$("#brand_name").focus();
						return false;
					}else{  
						$("#prodexists").val(0);
						return true;
					}			
				}
			});
		}
	//}
}
</script>
<?php require_once 'footer.php' ; ?>