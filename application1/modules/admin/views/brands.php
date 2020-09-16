<?php require_once 'header.php';?>
<link href="<?php echo base_url(); ?>assets/css/brands.css" type="text/css" rel="stylesheet">
<?php require_once 'sidebar.php';?>
<div class="right_blk">
	<div class="top_ttl_blk"> <span class="back_btn">
		</span> <span> <?php echo $page_title; ?> </span>
		<a href="<?php echo base_url(); ?>admin/brands/create" title="" class="fr btn btn-primary"> Create Company  </a>
	</div>

	<div class="trd_cr_r">
		<!-- create loan -->
		<div class="mar_btm_20">
			<div class="card_view dis_tbl">
				<ul class="trd_anl">
					<?php foreach($categories as $category){ ?>
						<li class="bor_lf_none">
							<div class="top_in_op crop_top">
								<p><?php echo $category->cat_name;?> </p>
								<h1><?php echo $category->brands;?></h1>
							</div>
						</li>
					<?php	
					}?>
					
					<!-- <li class="fr"> <button class="btn purc_btn btn-primary sho_m"> Show More</button> </li> -->
				</ul>
			</div>
		</div>
		<!-- <div class="card_view brd_ls mar_btm">
			<div class="padding_30">
				<div class="hdg_bk">Total Companies(<span id="tot_count">0</span>)</div>
				<div class="filter_bk">
					<div class="row">

						<div class="col-md-4">
							<div class="form-group">
								<label> Category (<span id="cat_count">0</span>) </label>
								<select id="fil1" name="fil1[]" multiple="multiple">
								</select>
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label> Sub Category (<span id="sccount">0</span>)</label>
								<select id="fil2" name="fil2[]" multiple="multiple">
								</select>
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label> Status </label>
								<select id="fil3" name="fil3">
									<option value="" > All </option>
									<option value="1" > Publish </option>
									<option value="0"> Unpublish </option>
								</select>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div> -->

		<div class="card_view">
			<div class="">
				<div class="res_tbl">
					<table id="brd_lst_tbl" class="table table-striped table-bordered" style="width:100%">
						<thead>
							<tr>
								<th> ID </th>
								<th> Name </th>
								<th> Category
									<span class="sts_pp">
										<i class="fa fa-filter" aria-hidden="true" style="font-size: 9px;"></i>
									</span>
									<div class="sts_fil_blk">
										<div class="trd_lst">
											<?php foreach($categories as $category){ ?>
												<div class="form-check chek_bx">
													<input class="form-check-input" type="checkbox" name="utype_opt" value="<?php echo $category->cat_id;?>" id="sta<?php echo $category->cat_id;?>">
													<label class="form-check-label" for="sta<?php echo $category->cat_id;?>">
														<?php echo $category->cat_name;?>
													</label>
												</div>
											<?php }?>
											
										</div>
									</div>
								</th>
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
								<th> Action </th>
							</tr>
						</thead>
						<tbody>

						</tbody>
					</table>
				</div>
			</div>
		</div>
	<!-- End loan -->
	</div>

</div>
<div id="popover-contents" style="display: none">
	<div class="custom-popover">
		<ul class="list-group">
			<li class="list-group-item edt green_txt"> <a href="<?php echo base_url();?>view_it">View</a></li>
			<li class="list-group-item edt green_txt"> <a href="<?php echo base_url();?>edit_it">Edit</a></li>
			<li class="list-group-item  reject_loan del">
				<a href="javascript:void();" title="" class="delete_brand" id="delete_id"> Delete </a></li>
		</ul>
	</div>
</div>

<div class="modal" id="delete_brand">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<h1> Are You Sure ! </h1>
				<p> Do you want to delete this Company ? </p>
			</div>
			<div class="modal_footer">
				<button type="button" class="btn btn-primary del_yes" data-dismiss="modal">Yes</button>
			<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
			<input type="hidden" id="hid_bid" value="" />
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
var url = '<?php echo base_url() ?>';
function del_brand(bid)
{
	$("#hid_bid").val(bid);
}
$(document).ready(function() {
	//$('#brd_lst_tbl').DataTable();
	//$('#fil1').multiselect();
	//$('#fil2').multiselect();
	//$('#fil3').multiselect();

	/* $('#myTable').on( 'click', 'tbody tr', function () {
		myTable.row( this ).delete();
	}); */

	var dataTable = $('#brd_lst_tbl').DataTable({
		'ordering': false,
		'processing': true,
		'serverSide': true,
		'serverMethod': 'post',
		"columnDefs": [
			{ className: "act_ms", "targets": [ 4 ] }
		],
		language: {
			searchPlaceholder: "Search Companies",
			search: "search",
			"dom": '<"toolbar">frtip'
		},
		//'searching': false, // Remove default Search Control
		'ajax': {
		   'url':url+'api/brands/getbrands',
		   'data': function(data){
				var multi_cat = [];
				$.each($("input[name='utype_opt']:checked"), function(){
					multi_cat.push($(this).val());
				});
				data.category = multi_cat;

				var multi_publish = [];
				$.each($("input[name='publish']:checked"), function(){
					multi_publish.push($(this).val());
				});
				data.publish = multi_publish;

			  // Read values
			  //var cat = $('#fil1').val();
			  var subcat = $('#fil2').val();
			  //var publish = $('#fil3').val();
			  // Append to data
			  //data.fil1 = cat;
			  data.fil2 = subcat;
			  //data.fil3 = publish;
			  /* console.log(data.order);
			  return JSON.stringify( data ); */
		   },
		   "dataSrc": function (json) {

				//$("#tot_count").html(json.recordsTotal);
				//$("#tot_count").html(json.tot_rec);
				/* if(json.feed_count > 0){ $("#fe_count").html(json.feed_count); }
				else{ $("#fe_count").html(0);}
				if(json.med_count > 0){ $("#me_count").html(json.med_count); }
				else{ $("#me_count").html(0);}
				if(json.mach_count > 0){ $("#ma_count").html(json.mach_count); }
				else{ $("#ma_count").html(0);} */
				return json.data;
			}
		}
	});

	$('.chek_bx input').change(function() {
		$(this).parent('.chek_bx').toggleClass('checkd');
	});

	$("input[name='utype_opt']").on('click',function() {
		dataTable.draw();
  	});

	$("input[name='publish']").on('click',function() {
		dataTable.draw();
  	});

	$('.dataTables_length').html('');

	// get Categories
	//getcategories();
	/* function getcategories()
	{
		// Get Profile
		$.ajax({
			url: url+"api/categories",
			data: {},
			type:'POST',
			datatype:'json',
			success : function(response){

				res= JSON.parse(response);

				var opt = "";
				if(res.data.length > 0)
				{
					$("#cat_count").text(res.data.length);
					$.each(res.data, function(index, cat) {
						opt += "<option value='" + cat.cat_id + "'>" + cat.cat_name + "</option>";
					});
				}
				$("#fil1").html(opt);
				$("#fil1").multiselect('rebuild');
			}
		});
	} */

	//get Subcategories
	/* $('#fil1').change(function () {
		let value = $(this).val();
		$.ajax({
			url: url+"api/brands/getSubCat",
			data: {catid:value},
			type:'POST',
			datatype:'json',
			success : function(response){

				res= JSON.parse(response);
				$("#sccount").text(0);
				var opt = "";
				if(res.length > 0)
				{
					$("#sccount").text(res.length);

					$.each(res, function(index, subcat) {
						opt += "<option value='" + subcat.subcat_id + "'>" + subcat.subcat_name + "</option>";
					});

				}
				$("#fil2").html(opt);
				$("#fil2").multiselect('rebuild');
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


	$(".del_yes").click(function(){

		var delval = $("#hid_bid").val();
		$.ajax({
			url: url+"api/brands/delete",
			data: {bid:delval},
			type:'POST',
			datatype:'json',
			success : function(response){

				res= JSON.parse(response);

				if(res.status == 'success')
				{
					new PNotify({
						title: 'Success',
						text: "Company deleted successfully!",
						type: 'success',
						shadow: true
					});
					//var dataTable = $('#brd_lst_tbl').DataTable();
					dataTable.ajax.reload();
				}
			}
		});
	});

	$("#brd_lst_tbl").on("mouseover", ".show_cat", function(){
	   $(this).find('.category_blk').show();
	});
	$("#brd_lst_tbl").on("mouseout", ".show_cat", function(){
	   $(this).find('.category_blk').hide();
	});
});
$(document).on("click", ".delete_brand",function(){
	id = $(this).attr('id');
	id = id.replace('delete_','');
	$('#delete_brand').modal('show');
	$("#hid_bid").val(id);
	console.log('hid'+$("#hid_bid").val());
	//userobj.user_id=id;
});
function popoverContent() {
	var content = '';
	var element = $(this);
	var id = element.attr("id");
	content = $("#popover-contents").html();
	content = content.replace(/view_it/g, 'admin/brands/view/'+id);
	content = content.replace(/edit_it/g, 'admin/brands/edit/'+id);
	content = content.replace(/delete_id/g, "delete_"+id);
	return content;
}
</script>
<?php require_once 'footer.php';?>