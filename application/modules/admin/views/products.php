<?php require_once 'header.php' ; ?>
<link href="<?php echo base_url();?>assets/css/product_list.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>assets/js/common.js" type="javascript"></script>
<?php require_once 'sidebar.php' ; ?>		
<div class="right_blk"> 
	<div class="top_ttl_blk"> 
		<span class="back_btn">	</span> 
		<span> <?php echo $page_title;?> </span>
    	<a href="<?php echo base_url();?>admin/products/create" title="" class="fr btn btn-primary"> Create Product </a>
	</div>

	<div class="trd_cr_r">
	<!-- create product -->
		<!-- <div class="card_view mar_btm">
			<div class="">
           	<div class="filter_bk">
           			<div class="row"> 
          <div class="col-md-4">
          <div class="form-group"> 
          				<label> Select Brand (<span class="brand_count"></span>) </label>
                       <select id="fil1" name="fil1"> 
                          
                      </select>
           </div>
         </div>

         <div class="col-md-4">
           <div class="form-group"> 
          				<label> Select Product (<span id="prod_count">0</span>)</label>
                       <select id="fil2" multiple="multiple">
					   
					   </select>
           </div>
         </div>
         <div class="col-md-4">
           <div class="form-group"> 
          				<label> Select Status </label>
                       <select id="fil3">
                          <option value="1" > Publish </option> 
                          <option value="0" > Unpublish </option> 
                      </select>
           </div>
   		 </div>


           			</div>
           	</div>

		</div>
		</div> -->

    <div class="card_view urs_dt"> 
                  <div class=""> 
                        <div class="res_tbl">                      
           <table id="prdt_lst_tbl" class="table table-striped table-bordered" style="width:100%">
           <thead>    
							<tr>
							<th> ID </th>
							<th> Product Name </th>
							<th> Brand 
									<span class="sts_pp">
									<i class="fa fa-filter" aria-hidden="true" style="font-size: 9px;"></i>
								</span>								
								<div class="sts_fil_blk lrg_flt">
									<input class="form-control search-filter" type="search" placeholder="Serch Brand" />
									<?php if(count($brands) > 0){ ?>
									<div class="trd_lst" id="list">
										
										<?php foreach($brands as $brand){ 
										
											$string = $brand->brand_name;
											if (strlen($string) > 10) {

												// truncate string
												$stringCut = substr($string, 0, 10);
												$endPoint = strrpos($stringCut, ' ');

												//if the string doesn't contain any space then it will cut without word basis.
												$string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
												$string .= '...';
											}
											
										?>
											<div class="form-check chek_bx" >
												<input class="form-check-input" type="checkbox" name="brands" value="<?php echo $brand->brand_id;?>" id="brand<?php echo $brand->brand_id;?>">
												<label class="form-check-label css-label" for="brand<?php echo $brand->brand_id;?>">
													<?php echo $string;?>
												</label>
											</div>
									<?php } }?>										
									</div>
								</div>	</th>
							<th> Category 
								<span class="sts_pp">
									<i class="fa fa-filter" aria-hidden="true" style="font-size: 9px;"></i>
								</span>
								<div class="sts_fil_blk">
									<div class="trd_lst">										
										<?php foreach($categories as $category){ ?>
											<div class="form-check chek_bx">
												<input class="form-check-input" type="checkbox" name="category" value="<?php echo $category->cat_id;?>" id="category<?php echo $category->cat_id;?>">
												<label class="form-check-label" for="category<?php echo $category->cat_id;?>">
													<?php echo $category->cat_name;?>
												</label>
											</div>
										<?php }?>										
									</div>
								</div>							
							</th>
							<th> MRP </th>
							<th> Purchase Amount </th>
							<!-- <th> Purchase Discount </th> -->
							<th> Status
								<span class="sts_pp">
									<i class="fa fa-filter" aria-hidden="true" style="font-size: 9px;"></i>
								</span>
								<div class="sts_fil_blk">
									<div class="trd_lst">
										<div class="form-check chek_bx">
											<input class="form-check-input" type="checkbox" name="publish" value="1" id="publish1">
											<label class="form-check-label" for="publish1">
												Published
											</label>
										</div>	
										<div class="form-check chek_bx">
											<input class="form-check-input" type="checkbox" name="publish" value="0" id="publish2">
											<label class="form-check-label" for="publish2">
												Unpublished
											</label>
										</div>										
									</div>
								</div>
							</th>
							<th class="act_ms"> Action </th>
							</tr>
						</thead>

          <tbody>
              
          </tbody>
           </table>
                        </div>
                      </div>
           </div>
		
	<!-- End product -->
	</div>
	
</div>
<div id="popover-contents" style="display: none">
	<div class="custom-popover">
		<ul class="list-group">
			<li class="list-group-item edt green_txt"> <a href="<?php echo base_url();?>view_it">View</a></li>
			<li class="list-group-item edt green_txt"> <a href="<?php echo base_url();?>edit_it">Edit</a></li>
			<li class="list-group-item  reject_loan del">
				<a href="javascript:void();" title="" class="delete_product" id="delete_id"> Delete </a></li>
		</ul>
	</div>
</div>
<div class="modal" id="delete_product">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<h1> Are You Sure ! </h1>
				<p> You want Delete Product ? </p>
			</div>
			<div class="modal_footer">
				<button type="button" class="btn btn-primary del_yes" data-dismiss="modal">Yes</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
				<input type="hidden" id="hid_pid" value="" />
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
var url = '<?php echo base_url()?>';
//str.match(/geeks/gi)
function listFilter(list, input) {
    var $lbs = list.find('.css-label');
	
    function filter(){
        var regex = new RegExp('\\b' + this.value);
        var $els = $lbs.filter(function(){
            return regex.test($(this).text().toLowerCase());
        });
        //$lbs.not($els).hide().prev().hide();
		//$els.show().prev().show();
		$lbs.not($els).parent().hide().prev().hide();
		$els.parent().show().prev().show();
    };

    input.keyup(filter).change(filter)
}
function del_product(pid)
{
	$("#hid_pid").val(pid);
}

function getbrands()
{
	// Get Profile
	$.ajax({		
		//url: url+"admin/brands/list",
		url: url+"api/brands",
		data: {},
		type:'POST',		
		datatype:'json',
		success : function(response){			
			
			res= JSON.parse(response);
			
			var opt = "<option value=''> -- Select Brand -- </option>";
			if(res.data.length > 0)
			{
				$(".brand_count").text(res.data.length);
				$.each(res.data, function(index, brand) {
					opt += "<option value='" + brand.brand_id + "'>" + brand.brand_name + "</option>";
				});
			}
			$("#fil1").html(opt);
			$("#fil1").multiselect('rebuild');
		}
	});
} 

$(document).ready(function() {
	
	listFilter($('#list'), $('.search-filter'))
	/* getbrands();
	$('#fil1').multiselect();
	$('#fil2').multiselect();
	$('#fil3').multiselect(); */
	/* $('#prdt_lst_tbl thead tr').clone(true).appendTo( '#prdt_lst_tbl thead' );
    $('#prdt_lst_tbl thead tr:eq(1) th').each( function (i) {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
 
        $( 'input', this ).on( 'keyup change', function () {
            if ( dataTable.column(i).search() !== this.value ) {
                dataTable
                    .column(i)
                    .search( this.value )
                    .draw();
            }
        } );
    } ); */
	var dataTable = $('#prdt_lst_tbl').DataTable({
		'orderCellsTop': true,
        'fixedHeader': true,
		'ordering': false,
		'processing': true,
		'serverSide': true,
		'serverMethod': 'post',	
		"columnDefs": [
			{ className: "act_ms", "targets": [ 7 ] }
		],		
		 'language': {
        searchPlaceholder: "Search Products",
        search: "",
        "dom": '<"toolbar">frtip'
      },
		'ajax': {
			
		   'url':url+'api/products/getproducts',
		   'data': function(data){
			var brands = [];
				$.each($("input[name='brands']:checked"), function(){
					brands.push($(this).val());
				});
				data.brands = brands;

				var category = [];
				$.each($("input[name='category']:checked"), function(){
					category.push($(this).val());
				});
				data.category = category;

				var multi_publish = [];
				$.each($("input[name='publish']:checked"), function(){
					multi_publish.push($(this).val());
				});
				data.publish = multi_publish;

			  // Read values
			 /* var brand = $('#fil1').val();
			  var products = $('#fil2').val();
			  var publish = $('#fil3').val();
			  // Append to data
			  data.fil1 = brand;
			  data.fil2 = products;
			  data.fil3 = publish; */
			  /* console.log(data.order);
			  return JSON.stringify( data ); */
		   },
		   "dataSrc": function (json) {			   
			  //$("#tot_count").html(json.recordsTotal);			 
				return json.data;
			}
		}
	});
	$('.dataTables_length').html('<h2 class="create_hdg lng_hdg"></h2>');

	/* $('.chek_bx input').change(function() {
		$(this).parent('.chek_bx').toggleClass('checkd');
	}); */
	//get Sub categories
	/* $('#fil1').change(function () {		
		let value = $(this).val();
		$.ajax({		
			url: url+"api/products/getProductsByBrand",
			data: {bid:value},
			type:'POST',		
			datatype:'json',
			success : function(response){
				
				//alert(response);
				res= JSON.parse(response);				
				//alert(res.length);
				$("#prod_count").text(0);
				var opt = "";
				if(res.length > 0)
				{
					$("#prod_count").text(res.length);
					
					$.each(res, function(index, product) {
						opt += "<option value='" + product.pid + "'>" + product.pname + "</option>";
					});				
					
				}				
				$("#fil2").html(opt);
				$("#fil2").multiselect('rebuild');
				//alert(res[0].subcat_id);	
			}
		});

		dataTable.draw();
		
    });
	$('#fil2').change(function(){
		dataTable.draw();
	});
	$('#fil3').change(function(){
		dataTable.draw();
	}); */

	$("input[name='brands'], input[name='category'], input[name='publish']").on('click',function() {
		$(this).parent('.chek_bx').toggleClass('checkd');
    	$(this).parent('.chek_bx').toggleClass('checkd');
		dataTable.draw();
	});
	
	// Delete Product
	$(".del_yes").click(function(){
		
		var delval = $("#hid_pid").val();
		$.ajax({		
			url: url+"api/products/delete",
			data: {pid:delval},
			type:'POST',		
			datatype:'json',
			success : function(response){				
				
				res= JSON.parse(response);			
				
				if(res.status == 'success')
				{	
					new PNotify({
						title: 'Success',
						text: "Product deleted successfully!",
						type: 'success',
						shadow: true
					});	
					//var dataTable = $('#brd_lst_tbl').DataTable();
					dataTable.ajax.reload();
				}				
			}
		});
		
		/* $('#brd_lst_tbl').on( 'click', 'tbody tr', function () {
			dataTable.row( this ).delete();
		}); */
	});
});
$(document).on('click', '[data-toggle="popover"]', function() {
	var $this = $(this);
	if (!$this.data('bs.popover')) {
		$this.popover({
			content: popoverContent,
			html: true,
			trigger: 'focus',
			delay: { 
				hide: "100"
			},
		}).popover('show');
	}
});
$(document).on("click", ".delete_product",function(){
	id = $(this).attr('id');
	id = id.replace('delete_','');
	$('#delete_product').modal('show');
	$("#hid_pid").val(id);
	//console.log('hid'+$("#hid_pid").val());
	//userobj.user_id=id;
});
function popoverContent() {
	var content = '';
	var element = $(this);
	var id = element.attr("id");
	content = $("#popover-contents").html();
	content = content.replace(/view_it/g, 'admin/products/view/'+id);
	content = content.replace(/edit_it/g, 'admin/products/edit/'+id);
	content = content.replace(/delete_id/g, "delete_"+id);
	return content;
}
</script>
<?php require_once 'footer.php' ; ?>