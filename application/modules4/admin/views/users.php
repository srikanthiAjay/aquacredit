<?php $this->load->view('admin/header');?>
<link href="<?php echo base_url(); ?>assets/css/user_list.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js" type="javascript"></script>
<?php $this->load->view('admin/sidebar');?>
	<div class="modal" id="delete_user">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
					  <h1> Are You Sure ! </h1>
					  <p> You want Delete this user? </p>
				</div>
				<div class="modal_footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal" onclick="deleteUser();">Yes</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
				</div>
			</div>
		</div>
	</div>	
	<div class="right_blk">
		<div class="top_ttl_blk"> 
			<span class="padin_t_5">Users</span> 
      <span>   </span> 
			<a href="<?php echo base_url(); ?>admin/users/createfarmer" title="" class="btn btn-primary fr"> Create User </a>
		</div>

     <div class="trd_cr_r"> 
      <div class="mar_btm_20">
      <div class="card_view dis_tbl">
        <ul class="trd_anl"> 
          <li class="bor_lf_none"> 
            <div class="top_in_op crop_top">
              <p>  Farmers-Single </p> 
              <h1><?php echo ($usersummary['farmers'] > 0) ? $usersummary['farmers'] : 0; ?></h1>
            </div>
          </li>
          <li class=""> 
            <div class="top_in_op crop_top">
              <p> Farmers-Partnership </p> 
              <h1> <?php echo ($usersummary['farmerswithpartnership'] > 0) ? $usersummary['farmerswithpartnership'] : 0; ?></h1>
            </div>
          </li>
          <li class=""> 
            <div class="top_in_op crop_top">
            <p> Dealers / Sub Dealers </p>
            <h1> <?php echo ($usersummary['delears'] > 0) ? $usersummary['delears'] : 0; ?> </h1> </h1>
            </div>
          </li>
          <li class=""> 
            <div class="top_in_op crop_top">
            <p> Non Farmers</p>
            <h1> <?php echo ($usersummary['nonfarmers'] > 0) ? $usersummary['nonfarmers'] : 0; ?> </h1>
            </div>
          </li>
          <li class="">
						<div class="top_in_op crop_top">
							<p> Guests</p>
							<h1> <?php echo ($usersummary['guests'] > 0) ? $usersummary['guests'] : 0; ?> </h1>
						</div>
					</li>

          <!-- <li class="fr"> <button class="btn purc_btn btn-primary sho_m"> Show More</button> </li> -->
        </ul>
      </div>
    </div>

		   <div class="user_list card_view"> 
			<div class="">
			<!-- 	<div class="hdg_bk"> 
					<div class="row">
						<div class="col-md-6" style="line-height: 40px;">User List <a href="#" title="" class="sho_m"> (Show More) </a></div> 
						<div class="col-md-6">
							<div class="slct_box" style="margin-right: 20px"> 
								<select id="type_opt" name="type_opt"> 
									<option value=""> All </option> 
									<option value="FARMER"> Farmer - Single </option> 
									<option value="PARTNER"> Farmer - Partners</option> 
									<option value="DEALER" > Dealers / Sub-Dealer </option>
									<option value="NON_FARMER"> Non-Farmer </option> 
								</select>
							</div>
						</div>
					</div>
				</div>   -->
				  <!-- <span class="filter"> <img src="../images/filter.png" alt="" title=""> </span> </div> -->
				<div class="res_tbl">
          <div class="dropdowns">
              <button class="btn btn-secondary drp_btn" type="button">
                <i class="fa fa-th-list" aria-hidden="true"></i>
              </button>
              <ul class="sl_menu">
                <li><a class="toggle-vis" data-column="1">Name</a></li>  
                <li><a class="toggle-vis" data-column="2">Mobile</a> </li> 
                <li><a class="toggle-vis" data-column="3">User Type</a> </li>   
                <li><a class="toggle-vis" data-column="4">Action</a> </li>      
              </ul>
            </div>
					<table id="usr_lst_tbl" class="table table-striped table-bordered" style="width:100%">
						<thead>
							<tr>
                <th> ID </th>
								<th> Name </th>
								<th> Mobile </th>
                <th> Type 
									<span class="sts_pp">
										<i class="fa fa-filter" aria-hidden="true" style="font-size: 9px;"></i>
									</span>
									<div class="sts_fil_blk">
										<div class="trd_lst">
											<div class="form-check chek_bx">
												<input class="form-check-input" type="checkbox" name="utype_opt" value="FARMER" id="sta1">
												<label class="form-check-label" for="sta1">
													Farmer-Single 
												</label>
											</div>
											<div class="form-check chek_bx">
												<input class="form-check-input" type="checkbox" name="utype_opt" value="PARTNER" id="sta4">
												<label class="form-check-label" for="sta4">
													Farmer-Partnership 
												</label>
											</div>
											<div class="form-check chek_bx">
												<input class="form-check-input" type="checkbox" name="utype_opt" value="DEALER" id="sta2">
												<label class="form-check-label" for="sta2">
													Dealer
												</label>
											</div>
											<div class="form-check chek_bx">
												<input class="form-check-input" type="checkbox" name="utype_opt" value="NON_FARMER" id="sta3">
												<label class="form-check-label" for="sta3">
													Non Farmer
												</label>
											</div>
											<div class="form-check chek_bx">
												<input class="form-check-input" type="checkbox" name="utype_opt" value="GUEST" id="sta5">
												<label class="form-check-label" for="sta5">
													Guest User
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
    </div>
        </div>
<div id="popover-contents" style="display: none">
	<div class="custom-popover">
		<ul class="list-group">
			<li class="list-group-item edt green_txt"> <a href="<?php echo base_url();?>edit_id">Edit</a></li>
			<li class="list-group-item  reject_loan del">
				<a href="javascript:void();" title="" class="delete_user" id="delete_id"> Delete </a></li>
		</ul>
	</div>
</div>	
	<div class="side_popup"> 
  <div class="padding_30"> 
        <div id="ttl_usrs"> 
            <div class="hdg_bk"> 
                    Total Users
                  </div>
                  <ul class="list_blk">
                    <li> 
                      <div class="row"> 
                        <div class="col-md-6"> Farmer-Single </div> 
                        <div class="col-md-6"> <b>50 </b> </div>
                      </div> 
                    </li>
                    <li> 
                      <div class="row"> 
                        <div class="col-md-6"> Farmer-Partners </div> 
                        <div class="col-md-6"> <b>50</b> </div>
                      </div> 
                    </li>

                      <li> 
                      <div class="row"> 
                        <div class="col-md-6"> Dealers </div> 
                        <div class="col-md-6"> <b>20</b> </div>
                      </div> 
                    </li>

                    <li> 
                      <div class="row"> 
                        <div class="col-md-6"> Sub Dealers </div> 
                        <div class="col-md-6"> <b>50</b> </div>
                      </div> 
                    </li>

                    <li> 
                      <div class="row"> 
                        <div class="col-md-6"> Non-Farmers </div> 
                        <div class="col-md-6"> <b>10</b> </div>
                      </div> 
                    </li>

                  </ul>
        </div>

          <div id="ttl_loan"> 
            <div class="hdg_bk"> 
                    Total Loan
                  </div>
                  <ul class="list_blk">
                      <li> 
                      <div class="row"> 
                        <div class="col-md-6"> Granted </div> 
                        <div class="col-md-6"> <b>10L</b> </div>
                      </div> 
                    </li>
                    <li> 
                      <div class="row"> 
                        <div class="col-md-6"> Received </div> 
                        <div class="col-md-6"> <b>5L</b> </div>
                      </div> 
                    </li>
                    <li> 
                      <div class="row"> 
                        <div class="col-md-6"> Outstanding </div> 
                        <div class="col-md-6"> <b>5L</b> </div>
                      </div> 
                    </li>
                  </ul>
                  <br/>
                  <div class="hdg_bk"> 
                    Crop Related
                  </div>
                     <ul class="list_blk"> 
                      <li>
                        <div class="row"> 
                        <div class="col-md-6"> Total Acres </div> 
                        <div class="col-md-6"> <b>50</b> </div>
                        </div> 
                      </li>
                      <li>
                        <div class="row"> 
                        <div class="col-md-6"> Crop Type </div> 
                        <div class="col-md-6"> <b>Crop Type</b> </div>
                        </div> 
                      </li>
                  </ul>
        </div>

        <div id="ttl_ord"> 
            <div class="hdg_bk"> 
                    Total Orders
                  </div>               
        </div>
    </div>
  </div>

<script type="text/javascript">
var url = '<?php echo base_url() ?>';
var dataTable='';
var userobj={'user_id':'','user_name':''};
$(document).ready(function(){

	dataTable = $('#usr_lst_tbl').DataTable({
    'ordering': false,
		'processing': true,
		'serverSide': true,
    'serverMethod': 'post',
    "columnDefs": [
      { className: "act_ms", "targets": [ 4 ] }
    ],
     language: {
        searchPlaceholder: "Search Users",
        search: "",
        "dom": '<"toolbar">frtip'
      },
		'ajax': {
		   'url':url+'admin/users/getusers',
		   'data': function(data){
          var multi_status = [];
          $.each($("input[name='utype_opt']:checked"), function(){
            multi_status.push($(this).val());
          });
          var utype_opt = multi_status;
          //var utype = $('#utype_opt').val();

          //data.type_opt = utype;
          data.utype_opt = utype_opt;
        },
		}
  });

/*   $('.chek_bx input').on('change',function() {
    console.log('shap');
    //$('.chek_bx input').change(function() {
		//$(this).parent('.chek_bx').toggleClass('checkd');
  }); */
  
  $("input[name='utype_opt']").on('click',function() {
    $(this).parent('.chek_bx').toggleClass('checkd');
    $(this).parent('.chek_bx').toggleClass('checkd');
		dataTable.draw();
  });

  $('#usr_lst_tbl_wrapper .dataTables_length').html('<h2 class="create_hdg lng_hdg">  </h2>');

	/* $('#searchByName').keyup(function(){
		dataTable.draw();
	}); */

	$('#utype_opt').change(function(){
		dataTable.draw();
	});
	
	/* $('.sho_m').click(function(){
		  $('.alpha_blk').show();
		   $('.side_popup').addClass('opn_slide');
	});

    $('.alpha_blk, .wh_all').click(function(){
        $('.side_popup').removeClass('opn_slide');
        $('.alpha_blk').hide();
    }); */
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
function popoverContent() {
	var content = '';
	var element = $(this);
	var id = element.attr("id");
	content = $("#popover-contents").html();
	content = content.replace(/edit_id/g, 'admin/users/edit/'+id);
	content = content.replace(/delete_id/g, "delete_"+id);
	return content;
}
$(document).on("click", ".delete_user",function(){
	id = $(this).attr('id');
	id = id.replace('delete_','');
	$('#delete_user').modal('show');
	userobj.user_id=id;
});


//Delete User
function deleteUser(){
  //table-danger
  //dataTable.draw();
  var msg='User Deleted Successfully!';
  $.ajax({    
    url: url+"admin/users/delelement",
    data: {'action':'user','ele_id':userobj.user_id},
    type:'POST',    
    datatype:'json',
    success : function(response){
      var res=$.parseJSON(response);
      if(res.result){
        new PNotify({
          title: 'Success',
          text: msg,
          type: 'success',
          shadow: true
        });
        dataTable.draw();
        $("#delete_user").modal("hide");
      } 
    }
  });
}

//Set User
/* function setUser(uid,uname){
  userobj.user_id=uid;
  userobj.user_name=uname;
  $('#alert_msg').text(userobj.user_name);
} */

$('.dataTables_paginate').html('<a href="#" title=""> Show More </a>');
</script>
<!-- <div class="alpha_blk"> </div>
<div class="side_popup">
  <div class="padding_30">
  	<div class="hdg_bk"> User Details </div>
  	<ul> 
  		<li> 
  			<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" id="op1" value="option1">
  <label class="form-check-label" for="op1">14</label>
</div>
  		 </li>
  		 <li> 
  			<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" id="op2" value="option1">
  <label class="form-check-label" for="op2">13</label>
</div>
  		 </li>
  		 <li> 
  			<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" id="op3" value="option1">
  <label class="form-check-label" for="op3">option 1</label>
</div>
  		 </li>
  		 <li> 
  			<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" id="op5" value="option1">
  <label class="form-check-label" for="op5">option 2</label>
</div>
  		 </li>
  		 <li> 
  			<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" id="op6" value="option1">
  <label class="form-check-label" for="op6">option 3</label>
</div>
  		 </li>
  		 <li> 
  			<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" id="op6" value="option1">
  <label class="form-check-label" for="op6">option 4</label>
</div>
  		 </li>
  		 <li> 
  			<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" id="op7" value="option1">
  <label class="form-check-label" for="op7">option 5</label>
</div>
  		 </li>
  		 <li> 
  			<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" id="op8" value="option1">
  <label class="form-check-label" for="op8">option 6</label>
</div>
  		 </li>
  		 <li> 
  			<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" id="op9" value="option1">
  <label class="form-check-label" for="op9">option 7</label>
</div>
  		 </li>
  		 <li> 
  			<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" id="op10" value="option1">
  <label class="form-check-label" for="op10">option 8</label>
</div>
  		 </li>
  		 <li> 
  			<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" id="op11" value="option1">
  <label class="form-check-label" for="op11">option 9</label>
</div>
  		 </li>
  		 <li> 
  			<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" id="op12" value="option1">
  <label class="form-check-label" for="op12">option 10</label>
</div>
  		 </li>
  		 <li> 
  			<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" id="op13" value="option1">
  <label class="form-check-label" for="op13">option 11</label>
</div>
  		 </li>
  		 <li> 
  			<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" id="op14" value="option1">
  <label class="form-check-label" for="op14">option 12</label>
</div>
  		 </li>
  	</ul>
  	<button type="submit" class="btn btn-primary wh_all"> Add to user Details </button>
  </div>
</div> -->
<?php $this->load->view('admin/footer');?>