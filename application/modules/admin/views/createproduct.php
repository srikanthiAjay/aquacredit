<?php require_once 'header.php' ; ?>
<link href="<?php echo base_url();?>assets/css/product.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>assets/js/common.js" type="javascript"></script>
<?php require_once 'sidebar.php' ; ?>
<link href="<?php echo base_url();?>assets/css/all.css" type="text/css" rel="stylesheet">
<style>
.select2-container--default .select2-selection--single .select2-selection__rendered{ line-height: 40px;}
.select2-container .select2-selection--single .select2-selection__rendered{ padding-left: 12px; }
.border-lable-flt label, .border-lable-flt > span{ font-size: 100% !important;}
.select2-selection{ height:40px !important;}
.select2-container--default .select2-selection--single { margin: 0; }
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
.multiselect-container .active label:before{ opacity: 1; }
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
</style>		
<div class="right_blk"> 
	<div class="top_ttl_blk"> <span class="back_btn">
		<!-- <a href="<?php echo base_url();?>admin/products" title=""><img src="<?php echo base_url();?>assets/images/back.png" alt="" title=""> </a> --></span> 
		<span> <?php echo $page_title;?> </span>
		<!-- <a title="" class="btn btn-primary fr"> Show All Products </a> -->
	</div>
	<?php //print_r($packing); ?>
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
								<span class="border-lable-flt">								
									<input type="text" class="form-control" id="prod_name" name="prod_name" placeholder=" " />
									<label for="prod_name" class="control-label required"> Product Name</label>
								</span>
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<span class="border-lable-flt">									
									<input type="text" class="form-control allownumericwithoutdecimal" id="hsn" name="hsn" placeholder=" " />
									<label for="hsn" class="control-label required"> HSN</label>
								</span>
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<span class="border-lable-flt">									
									<input type="text" class="form-control allownumericwithdecimal" id="tax" name="tax" placeholder=" " onkeyup="amount_with_commas(this.id);" max="99.99" />
									<label for="tax" class="control-label required"> TAX (%)</label>
								</span>
							</div>
						</div>
						<div class="col-md-4">
							<label class="form-group border-lable-flt"> 
								<select  id="cat" name="cat" class="form-control custom-select required" >	
								</select>
								<span class="control-label required"> Category</span>
							</label>
						</div>
						<div class="col-md-4"> 
							<label class="form-group border-lable-flt"> 
								<select id="subcat" name="subcat" class="form-control custom-select required" >	
								</select>
								<span class="control-label required"> Subcategory</span>
							</label>							
						</div>
						<div class="col-md-4">
							<label class="form-group border-lable-flt"> 
								<select id="brand" name="brand" class="form-control custom-select required" placeholder=" ">	
								</select>
								<span class="control-label required"> Brand</span>
							</label>							
						</div>
						<div class="col-md-4">
							<div class="mrp">

								<div class="row"> 
									<div class="col-md-12">
										<div class="form-group">
											<span class="border-lable-flt">										
												<input type="text" class="form-control allownumericwithdecimal" id="mrp" name="mrp" placeholder=" " onkeyup="amount_with_commas(this.id);" />
												<label for="pd_name" class="control-label required"> MRP</label>
											</span>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<span class="border-lable-flt">										
												<input type="text" class="form-control allownumericwithdecimal" id="p_amt" name="p_amt" placeholder=" " onkeyup="amount_with_commas(this.id);" />
												<label class="control-label required" for="p_amt"> Purchase Amount</label>
											</span>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<span class="border-lable-flt">										
												<input type="text" class="form-control allownumericwithdecimal" id="mrp_perc" name="mrp_perc" placeholder=" " onkeyup="amount_with_commas(this.id);" />
												<label class="control-label required" for="mrp_perc"> Puchase Discount (%)</label>
											</span>
									   </div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-8">
							<div class="row qty">
								<div class="col-md-4">								
									<div class="form-group">
										<span class="border-lable-flt">											
											<input type="text" id="qty" name="qty" class="form-control allownumericwithoutdecimal" placeholder=" " />
											<label class="control-label required" for="qty"> Quantity</label>
										</span>
									</div>
								</div>
								<div class="col-md-4"> 
									<label class="form-group border-lable-flt"> 
										<select  id="qty_weight" name="qty_weight" class="form-control custom-select required" ></select>
										<span class="control-label required"> Units</span>
									</label>									
								</div>

								<div class="col-md-4"> 
									<label class="form-group border-lable-flt"> 
										<select  id="qty_opt" name="qty_opt" class="form-control custom-select required" ></select>
										<span class="control-label required"> Packing</span>
									</label>									
								</div>
							</div>
						</div>
					</div>

					<div class="row"> 
						<div class="col-md-12 pad_t">
							<button type="submit" id="prod_sbmt" class="btn btn-primary" >Submit</button>
							<input type="hidden" id="prodexists" name="prodexists" value="0" />
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

$("#brand").select2();
// $("#brand").chosen();
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
			
			var opt = "<option value='' > Select Category </option>";
			if(res.data.length > 0)
			{
				//$("#cat_count").text(res.data.length);
				$.each(res.data, function(index, cat) {
					opt += "<option value='" + cat.cat_id + "'>" + cat.cat_name + "</option>";
				});
			}
			$("#cat").html(opt);
			//$("#cat").multiselect('rebuild');
		}
	});
} 

function getunits()
{
	
	$.ajax({		
		url: url+"api/units",
		data: {},
		type:'POST',		
		datatype:'json',
		success : function(response){			
			
			res= JSON.parse(response);				
			//alert(res.data.length);
			var opt = "<option value='' > Select Unit </option>";
			if(res.data.length > 0)
			{
				//$("#cat_count").text(res.data.length);
				$.each(res.data, function(index, unit) {
					opt += "<option value='" + unit.id + "'>" + unit.unit_name + "</option>";
				});
			}
			$("#qty_weight").html(opt);
			//$("#qty_weight").multiselect('rebuild');
		}
	});
} 

function getpacking()
{
	
	$.ajax({		
		url: url+"api/packings",
		data: {},
		type:'POST',		
		datatype:'json',
		success : function(response){			
			
			res= JSON.parse(response);				
			//alert(res.data.length);
			var opt = "<option value='' > Select Packing </option>";
			if(res.data.length > 0)
			{
				//$("#cat_count").text(res.data.length);
				$.each(res.data, function(index, pack) {
					opt += "<option value='" + pack.id + "'>" + pack.packing_type + "</option>";
				});
			}
			$("#qty_opt").html(opt);
			//$("#qty_opt").multiselect('rebuild');
		}
	});
} 

$(document).ready(function() {
	
	getcategories(); getunits(); getpacking();
	
	//$('#cat').multiselect();
	//$('#subcat').multiselect();
	//$('#brand').multiselect();
	//$('#qty_weight').multiselect();
	//$('#qty_opt').multiselect();
	$('#pub').multiselect();
	
	// On Chage Category
	$('#cat').change(function () {		
		let value = $(this).val();
		
		if(value != "")
		{
			$.ajax({		
				url: url+"api/subcategories/index/"+value,
				data: {},
				type:'POST',		
				datatype:'json',
				success : function(response){			
					
					var opt = "";
					res= JSON.parse(response);				
					//alert(res.data.length);
					if(res.data.length > 0)
					{
						opt += "<option value='' > Select Subcategory </option>";
						$.each(res.data, function(index, subcat) {	
																
							opt += "<option value='" + subcat.cat_id + "' >" + subcat.cat_name + "</option>";
							
						});					
					}				
					$("#subcat").html(opt);
					//$("#subcat").multiselect('rebuild');
					$("#brand").html('');
					$("#brand").select2('refresh');
					//$("#brand").multiselect('rebuild');
				}
			});
		}			
    });
	
	// On Change SubCategory
	$('#subcat').change(function () {		
		let value = $(this).val();
		
		if(value != "")
		{
			$.ajax({		
				url: url+"api/products/getbrandsbysubcat/"+value,
				//data: {catid:value},
				type:'POST',		
				datatype:'json',
				success : function(response){
					
					//alert(response);
					var opt = "";
					res= JSON.parse(response);				
					//alert(res.length);
					if(res.length > 0)
					{
						opt += "<option value='' > Select Brand </option>";
						$.each(res, function(index, brand) {	
																
							opt += "<option value='" + brand.brand_id + "' >" + brand.brand_name + "</option>";
							
						});					
					}				
					$("#brand").html(opt);
					//$("#brand").multiselect('rebuild');
					$(".select2-selection").addClass("form-control");
					$("#brand").select2('refresh');
					
					//$("#brand").trigger("chosen:updated");
				}
			});
		}else{
			$("#brand").html('');
			//$("#brand").multiselect('rebuild');
		}			
    });
	
	
	//Form submit
	
	$("#prod_frm").submit(function(e) {			
		e.preventDefault();
	}).validate({
		rules:{			
			prod_name:
			{
				required: true,
				minlength: 3,
				//alphanumeric: true,
				remote: {
					depends: function(){
						return ($("#prod_name").val() && $("#brand").val() != "" && $("#qty").val() != "" && $("#qty_weight").val());
					},
					param: {
						url: url+"api/products/checkproductname_by_qty_weight_for_tooltip",
						type:'POST',
						data: {	
							brand: function(){ return $("#brand").val().trim();	},
							prod_name: function(){ return $("#prod_name").val().trim();	},
							qty: function(){ return $("#qty").val().trim(); },
							units: function(){ return $("#qty_weight").val().trim(); }
						}
					}
				}				
			},				
			hsn:{
				required:true,
				number:true,
				minlength:6,
				maxlength:8
			},				
			tax:{
				required:true,
				number:true,
				min: 1,
				max: 99.99,
				twodecimals: true
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
				min: 1,
				twodecimals: true,
				//greaterthan: '#p_amt'
			},
			p_amt:{
				required: true,
				number: true,
				min: 1,
				twodecimals: true,				
				lessthan: '#mrp'
			},
			mrp_perc:{
				required: true,
				number: true,
				decimal: true,
				min: 0,
				max: 100,
				twodecimals: true
			},
			brand:{
				required: true,
				remote: {
					depends: function(){
						return ($("#prod_name").val() && $("#brand").val() != "" && $("#qty").val() != "" && $("#qty_weight").val());
					},
					param: {
						url: url+"api/products/checkproductname_by_qty_weight_for_tooltip",
						type:'POST',
						data: {	
							brand: function(){ return $("#brand").val().trim();	},
							prod_name: function(){ return $("#prod_name").val().trim();	},
							qty: function(){ return $("#qty").val().trim(); },
							units: function(){ return $("#qty_weight").val().trim(); }
						}
					}
				}
			},
			qty:{
				required: true,
				number: true,
				min: 1,
				minlength:1,
				maxlength:4,
				remote: {
					depends: function(){
						return ($("#prod_name").val() && $("#brand").val() != "" && $("#qty").val() != "" && $("#qty_weight").val());
					},
					param: {
						url: url+"api/products/checkproductname_by_qty_weight_for_tooltip",
						type:'POST',
						data: {	
							brand: function(){ return $("#brand").val().trim();	},
							prod_name: function(){ return $("#prod_name").val().trim();	},
							qty: function(){ return $("#qty").val().trim(); },
							units: function(){ return $("#qty_weight").val().trim(); }
						}
					}
				}
			},
			qty_weight:{
				required: true,
				remote: {
					depends: function(){
						return ($("#prod_name").val() && $("#brand").val() != "" && $("#qty").val() != "" && $("#qty_weight").val());
					},
					param: {
						url: url+"api/products/checkproductname_by_qty_weight_for_tooltip",
						type:'POST',
						data: {	
							brand: function(){ return $("#brand").val().trim();	},
							prod_name: function(){ return $("#prod_name").val().trim();	},
							qty: function(){ return $("#qty").val().trim(); },
							units: function(){ return $("#qty_weight").val().trim(); }
						}
					}
				}
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
				required: "Enter product name",
				minlength: "Minimum length at least 3 characters",
				remote: "The combination of product, brand, quantity and units already exists!"
			},
			hsn:{
				required: "Please enter HSN "
			},				
			tax:{
				required:"Please enter TAX",
			},				
			cat:{
				required: "Please select category"			 
			},
			subcat:{
				required: "Please select subcategory"
			},
			brand:{
				required: "Please select brand",
				remote: "The combination of product, brand, quantity and units already exists!"
			},
			mrp:{
				required: "Please enter MRP"
			},
			p_amt:{
				required: "Enter purchase amount "
			},
			mrp_perc:{
				required: "Please enter discount (%)"				
			},			
			qty:{
				required: "Please enter quntity",
				remote: "The combination of product, brand, quantity and units already exists!"
			},
			qty_weight:{
				required: "Please enter unit",
				remote: "The combination of product, brand, quantity and units already exists!"
			},
			qty_opt:{
				required: "Please enter package type"
			},
		},
		showErrors: function(errorMap, errorList) {
			  // Clean up any tooltips for valid elements
			  $.each(this.validElements(), function (index, element) {
				  var $element = $(element);
				  //var parent = $element.parent().attr('class');					
				  $element.data("title", "").parent().removeClass("error").tooltip("dispose");
				  $element.data("title", "").removeClass("error").tooltip("dispose");
					$(element).css("border", "");
					$(".custom-select").css("border", "");
					$(".select2-selection").css("border", "");
			  });
			  // Create new tooltips for invalid elements
			  $.each(errorList, function (index, error) {
				  var $element = $(error.element);
				  $element.tooltip("dispose").data("title", error.message).addClass("error").tooltip();
					$("#" + error.element.id).css("border", "1px solid red");
					
					$(".custom-select").css("border", "1px solid red");
					$(".select2-selection").css("border", "1px solid red");
			  });
		},		
		submitHandler: function(form) 
		{			
			var prodexists = $("#prodexists").val();
			/* if(prodexists == 1)
			{
				new PNotify({
					title: 'Error',
					text: 'The combination of product, brand, quantity and units already exists!',
					type: 'failure',
					shadow: true
				});
				return false;
			}
			else{ */
				formData = new FormData(form);		
			
				$.ajax({
					url: url+"api/products/add",
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
								text: "Product created successfully!",
								type: 'success',
								shadow: true
							});
							
							setTimeout(function(){
								window.location.href = url+'admin/products';
							 }, 2000);
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
			//}					
		}
	});
	
	// Puchase amount change
	$("#p_amt").keyup(function(){
		var mrp = +$("#mrp").val();
		var purch_val = +$(this).val();
		var percent = (100 - ((100 * purch_val) / mrp));
		if(percent %1 == 0){
			$("#mrp_perc").val(percent);
		}else{	$("#mrp_perc").val(+percent.toFixed(2)); }
		
		//$("#mrp_perc").val(percent.toFixed(2));
		//alert(purch_val);
	});
	
	$("#mrp_perc").keyup(function(){
		
		var mrp = +$("#mrp").val();
		var percent = +$(this).val();
		
		var purch_val = (mrp - ((mrp * percent) / 100));
		//$("#p_amt").val(purch_val);
		$("#p_amt").val(+purch_val.toFixed(2));
	});
	
	// On Submit button click
	//$("#prod_sbmt").click(function(){ checkproductname(); });
	
	// On Quantity enter
	$("#prod_name , #qty").keyup(function(){ checkproductname(); });
	
	// On Weightage change
	$("#qty_weight, #brand").change(function(){ checkproductname();  });
	
});
function checkproductname()
{
	if($("#brand").val() != null){ var brand = $("#brand").val().trim();}else{ var brand = "";}
	var prod_name = $("#prod_name").val().trim();	
	var qty = $("#qty").val().trim();
	var units = $("#qty_weight").val().trim();

	if(prod_name !="" && qty != "" && units != "" && brand != ""){ 
		$.ajax({		
			//url: url+"admin/products/checkproductname",
			url: url+"api/products/checkproductname_by_qty_weight",
			data: {prod_name:encodeURIComponent(prod_name), brand:brand, qty:qty, units:encodeURIComponent(units)},
			type:'POST',		
			datatype:'json',
			success : function(response){
				if(response == 1)
				{
					/* new PNotify({
						title: 'Error',
						text: 'The combination of product, brand, quantity and units already exists!',
						type: 'failure',
						shadow: true
					});	 */				
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
}
function amount_with_commas(tagid) {	
   
    var textbox = '#'+tagid;    

    var num = $(textbox).val();
    var comma = /,/g;
    num = num.replace(comma, '');

    var len = num.length;
    var index = num.indexOf('.');
    if (index > 0) {
        var CharAfterdot = (len + 1) - index;
        if (CharAfterdot > 3) {
            num = parseFloat(num).toFixed(2);
        }
    }    
    var numCommas = addCommas(num);
    $(textbox).val(numCommas);
}
</script>
<?php require_once 'footer.php' ; ?>