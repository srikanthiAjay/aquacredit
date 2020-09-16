<?php require_once 'header.php' ; ?>
<link href="<?php echo base_url();?>assets/css/user_list.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>assets/js/common.js" type="javascript"></script>
<?php require_once 'sidebar.php' ; ?>
	<div class="modal" id="delete_user">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
					  <h1> Are You Sure ! </h1>
					  <p> You want Delete Mr.User XXXXXX ? </p>
				</div>
				<div class="modal_footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal">Yes</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
				</div>
			</div>
		</div>
	</div>	
	<div class="right_blk">
		<div class="top_ttl_blk"> 
			<span class="padin_t_5">Users</span> <span>   </span> 
			<a href="<?php echo base_url();?>admin/users/create" title="" class="btn btn-primary fr"> Create User </a>
		</div>
		
		<div class="padding_30">
			<div class="user_type card_view mar_btm">
				<div class="padding_30">
					<div class="hdg_bk">Total Users (0)</div>
					<div class="row"> 
						<div class="col-md-3 bor_lf_none">
							<div class="top_in_op">
								<p> Farmers-Single </p> 
								<h1> 0 </h1>
							</div>
						</div>
						<div class="col-md-3">
							<div class="top_in_op tt_use">
								<p> Farmers-Partnership</p> 
								<h1> 0 </h1>
							</div>
						</div>
						<div class="col-md-3">
							<div class="top_in_op tt_use">
								<p> Dealers / Sub Dealers </p> 
								<h1> 0 </h1>
							</div>
						</div>
						<!-- <div class="col-md-2">
							<div class="top_in_op tt_use">
								<p> Sub Dealers </p> 
								<h1> 0 </h1>
							</div>
						</div> -->
						<div class="col-md-3">
							<div class="top_in_op tt_use">
								<p> Non-Farmers </p> 
								<h1> 0 </h1>
							</div>
						</div>
						<!--   <div class="col-md-2">
							<div class="top_in_op tt_loan">
								<p> Total Loan Amount </p> 
								<h1> 10.5L </h1>
							</div>
						</div>
						<div class="col-md-2">
							<div class="top_in_op tt_ord">
								<p> Total orders </p> 
								<h1> 20 </h1>
							</div>
						</div> -->

					</div> 
				</div>
			</div>
		   <div class="user_list card_view"> 
			<div class="padding_30">
				<div class="hdg_bk"> 
					<div class="row">
						<div class="col-md-6" style="line-height: 40px;">User List <a href="#" title="" class="sho_m"> (Show More) </a></div> 
						<div class="col-md-6">
							<div class="slct_box" style="margin-right: 20px"> 
								<select id="type_opt" name="type_opt"> 
									<option value=""> All </option> 
									<option value="fs"> Farmer - Single </option> 
									<option value="fm"> Farmer - Partners</option> 
									<option value="d" > Dealers / Sub-Dealer </option>
									<option value="nf"> Non-Farmer </option> 
								</select>
							</div>
						</div>
					</div>
				</div>  
				  <!-- <span class="filter"> <img src="../images/filter.png" alt="" title=""> </span> </div> -->
				<div class="res_tbl">
					<table id="usr_lst_tbl" class="table table-striped table-bordered" style="width:100%">
						<thead>
							<tr>
								<!-- <th> User Code </th>
								<th> Type </th> -->
								<!--               <th>  Created Date </th> -->
								<th> Name </th>
								<!-- <th> Email </th> -->
								<th> Mobile </th>
								<!--               <th> Role </th>
								<th> Total Acres </th>
								<th> Balance  </th>
								<th> Status </th> -->
								<th width="150"> Action </th>
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
	<!-- <div class="alpha_blk"> </div> -->
	
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
var url = '<?php echo base_url()?>';
$(document).ready(function(){
   
	var dataTable = $('#usr_lst_tbl').DataTable({
		'processing': true,
		'serverSide': true,
		'serverMethod': 'post',
		//'searching': false, // Remove default Search Control
		'ajax': {
		   'url':url+'api/users/get_users',
		   'data': function(data){
			  // Read values
			  var utype = $('#type_opt').val();		  

			  // Append to data
			  data.type_opt = utype;
		   }
		}
		/* ,
		'columns': [
		   { data: 'usercode' }, 
		   { data: 'utype' },
		   { data: 'uname' },
		   { data: 'uemail' },
		   { data: 'mobile' },
		   { data: '' },
		] */
	});

	/* $('#searchByName').keyup(function(){
		dataTable.draw();
	}); */

	$('#type_opt').change(function(){
		dataTable.draw();
	});
	
	$('.sho_m').click(function(){
		  $('.alpha_blk').show();
		   $('.side_popup').addClass('opn_slide');
	});

    $('.alpha_blk, .wh_all').click(function(){
        $('.side_popup').removeClass('opn_slide');
        $('.alpha_blk').hide();
    });
});

</script>
<div class="alpha_blk"> </div>
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
</div>
<?php require_once 'footer.php' ; ?>