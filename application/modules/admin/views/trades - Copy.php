<?php require_once 'header.php' ; ?>
<link href="<?php echo base_url();?>assets/css/trade.css" type="text/css" rel="stylesheet">
<?php require_once 'sidebar.php' ; ?>		
<div class="right_blk"> 
	<div class="top_ttl_blk"> <span class="back_btn">
		<a href="user_list.html" title=""><img src="<?php echo base_url();?>assets/images/back.png" alt="" title=""> </a></span> <span> Trades </span>
		<!-- <a href="<?php echo base_url();?>admin/trades/create" title="" class="btn btn-primary fr"> Create Trade </a> -->
	</div>

	<div class="">
	<!-- create loan -->
		
		<div class="padding_30">
			<div class="crt_trade card_view mar_btm">
				
					<div class="top_blk_cre"> Create Trade 
					<a href="#" title="" class="act_values_p"> + </a>
					<a href="#" title="" class="act_values_n hide"> - </a>
					 </div>
					<div class="btm_cre"> 
						<div class="padding_30">
					<div class="row"> 
					<div class="col-md-6"> 
						<b class="sub_hdg"> Select Values </b>
						<div class="row"> 
							<div class="col-md-5"> 
								<div class="form-group"> 
          				<label> User </label>
                       <select id="mul1"> 
                          <option selected> User-1 </option> 
                          <option> User-2 </option>
                          <option> User-3 </option> 
                      </select>
           </div>
						</div>
						<div class="col-md-4"> 
								<div class="form-group"> 
          				<label> Trader </label>
                       <select id="mul2"> 
                          <option selected> Trader-1 </option> 
                          <option> Trader-2 </option>
                          <option> Trader-3 </option> 
                      </select>
           </div>
						</div>
						<div class="col-md-3"> 
								<div class="form-group"> 
          				<label> Type </label>
                       <select id="mul3"> 
                          <option selected> Fish </option> 
                          <option> Prawn </option>
                      </select>
           </div>
						</div>
						</div>
					</div>
					<div class="col-md-6">
						<b class="sub_hdg"> Expected Values </b>
						<div class="row"> 
							<div class="col-md-3"> 
							<div class="form-group">
				<label>Count</label>
   <select id="mul4"> 
                          <option selected> 10 </option> 
                          <option> 25 </option>
                           <option> 40 </option>
                      </select>
							</div>
						</div>

						<div class="col-md-4"> 
							<div class="form-group">
				<label>Farmer Price</label>
    <input type="text" class="form-control" placeholder="Farmer Price">
							</div>
						</div>

						<div class="col-md-5"> 
							<div class="form-group">
				<label>Company Price</label>
    <input type="text" class="form-control" placeholder="Company Price">
							</div>
						</div>

						</div>
					</div>
					
						<div class="actual_values col-md-12"> 
						
							<div class="row"> 
<div class="col-md-6">
		<b class="sub_hdg"> Actual Farmer Values </b>
	<div class="tr_bor_blk">
<div class="row">
	<div class="col-md-4">
	<div class="form-group">
				<label>Actual Count</label>
   <select id="mul5"> 
                          <option selected> 10 </option> 
                          <option> 25 </option>
                           <option> 40 </option>
                      </select>
							</div>
						</div>
					 <div class="col-md-4">
							<div class="form-group">
				<label>Actual Weight</label>
    <input type="text" class="form-control" id="f_ac_we" placeholder="Actual Weight">
							</div>
					
				</div>
				<div class="col-md-4">
							<div class="form-group">
				<label>Actual Price</label>
    <input type="text" class="form-control" id="f_ac_prc" placeholder="Actual Price">
							</div>
						</div>
						<div class="col-md-12">
							<div class="total_amont"> 
						 Total Amount: ₹<span id="ttl_amnt_fr">0 </span> 
					</div>
				</div>
						</div>
					</div>
					</div>
					<div class="col-md-6"> 
						<b class="sub_hdg"> Actual Company Values</b>
						<div class="tr_bor_blk">
					<div class="row">
					
<div class="col-md-4">
							<div class="form-group">
				<label>Actual Count</label>
   <select id="mul6"> 
                          <option selected> 10 </option> 
                          <option> 25 </option>
                           <option> 40 </option>
                      </select>
							</div>
						</div>
						
						<div class="col-md-4">
							<div class="form-group">
				<label>Actual Weight</label>
    <input type="text" class="form-control" id="cm_ac_we" placeholder="Actual Weight">
							</div>
						</div>
						<div class="col-md-4">
					
							<div class="form-group">
				<label>Actual Price</label>
    <input type="text" class="form-control" id="cm_ac_prc" placeholder="Actual Price">
							</div>
</div>
<div class="col-md-12">
						<div class="total_amont"> 
						 Total Amount: ₹
						 <span id="ttl_amnt_cm">0 </span> 
					</div>
				</div>
			</div>
					</div>
				</div>
					</div>
						</div>

					
			
					</div>
					<div class="row" style="margin-top: 20px;"> 
						<div class="col-md-12"> <button class="btn btn-primary"> Create Trade </button>  </div> 
					</div>
				</div>
			</div>
			</div>
			<div class="user_list card_view mar_btm"> 
				<div class="padding_30"> 
					<div class="filter_bk">
	<div class="row"> 
		<div class="col-md-4">
          <div class="form-group"> 
          	<label> Select Duration </label>
                       <select id="fil1"> 
                          <option selected> This Month </option> 
                          <option> Last 3 Months </option> 
                          <option> Last 6 Months </option> 
                          <option> 1 Year </option>
                          <option> Choose Date </option> 
                      </select>
           </div>
    </div>
		<div class="col-md-4">
          <div class="form-group"> 
          		<label> Select Trader </label>
                       <select id="fil2" multiple="multiple"> 
                          <option selected> Trader -1 </option> 
                          <option> Trader -2  </option>
                          <option> Trader -3  </option> 
                      </select>
      </div>
    </div>

    <div class="col-md-4">
          <div class="form-group"> 
          		<label> Select User </label>
                       <select id="fil3" multiple="multiple"> 
                          <option selected> User -1 </option> 
                          <option> User -2  </option>
                          <option> User -3  </option> 
                      </select>
      </div>
    </div>


</div>
					</div>
					<div class="row"> 
				<div class="col-md-2 bor_lf_none">
							<div class="top_in_op trd_amnt">
                                  <p> Total Amount </p> 
                                   <h1> ₹50L </h1>
                            </div>
						</div>
						<div class="col-md-2">
							<div class="top_in_op trd_amnt">
                                  <p> Total Trades </p> 
                                   <h1> 15 </h1>
                            </div>
						</div>
						
						<div class="col-md-2">
							<div class="top_in_op">
                                  <p> Total Tons </p> 
                                   <h1>100 </h1>
                            </div>
						</div>
					<!-- 	<div class="col-md-2">
							<div class="top_in_op">
                                  <p> Trader split up count </p> 
                                   <h1> 10 </h1>
                            </div>
						</div> -->
					</div>
</div>
</div>
<div class="user_list card_view"> 
				<div class="padding_30"> 
				<!-- 	<div class="hdg_bk"> 
					<div class="row">
					<div class="col-md-6">Traders List</div> 
					<div class="col-md-6">
				
					</div>
					</div>
					</div>  --> 
					<!-- <span class="filter"> <img src="../images/filter.png" alt="" title=""> </span> </div> -->
					<div class="res_tbl">
					<table id="usr_lst_tbl" class="table table-bordered table-striped table-hover" style="width:100%">
						<thead>
							<tr>
								<th> Id </th>
								<th> Trader Name  </th>
								<th> User Name </th>
								<th> Final Price </th>
								<th> Actions </th>
							</tr>
						</thead>

						<tbody>	
							<tr>
							<td> 65852 </td>
							<td> <a href="<?php echo base_url();?>admin/traders/details" title=""> Trader Name </a> </td>
							<td> <a href="<?php echo base_url();?>admin/users/details" title=""> User Name </a> </td>
							<td> 2.3L</td>
						<td> 
							 <ul class="action_list"> 
                  <li> <a href="<?php echo base_url();?>admin/trades/edit" title=""> Edit </a> </li>
                  <li> / </li>
                  <li> <a href="#" title="" data-toggle="modal" data-target="#delete_user"> Delete </a> </li>
                </ul>
						</td>
						</tr>
						<tr>
							<td> 65852 </td>
							<td> <a href="<?php echo base_url();?>admin/traders/details" title=""> Trade Name </a> </td>
							<td> <a href="<?php echo base_url();?>admin/users/details" title="">User Name </a> </td>
							<td> 2.3L</td>
						<td> 
							 <ul class="action_list"> 
                  <li> <a href="<?php echo base_url();?>admin/trades/edit" title=""> Edit </a> </li>
                  <li> / </li>
                  <li> <a href="#" title="" data-toggle="modal" data-target="#delete_user"> Delete </a> </li>
                </ul>
						</td>
						</tr>
						<tr>
							<td> 65852 </td>
							<td> <a href="<?php echo base_url();?>admin/traders/details" title=""> Trade Name </a> </td>
							<td> <a href="<?php echo base_url();?>admin/users/details" title="">User Name </a> </td>
							<td> 2.3L</td>
						<td> 
							 <ul class="action_list"> 
                  <li> <a href="#" title=""> Edit </a> </li>
                  <li> / </li>
                  <li> <a href="<?php echo base_url();?>admin/trades/edit" title="" data-toggle="modal" data-target="#delete_user"> Delete </a> </li>
                </ul>
						</td>
						</tr>
						<tr>
							<td> 65852 </td>
							<td> <a href="<?php echo base_url();?>admin/traders/details" title=""> Trade Name </a> </td>
							<td> <a href="<?php echo base_url();?>admin/users/details" title="">User Name </a> </td>
							<td> 2.3L</td>
						<td> 
							 <ul class="action_list"> 
                  <li> <a href="<?php echo base_url();?>admin/trades/edit" title=""> Edit </a> </li>
                  <li> / </li>
                  <li> <a href="#" title="" data-toggle="modal" data-target="#delete_user"> Delete </a> </li>
                </ul>
						</td>
						</tr>
						<tr>
							<td> 65852 </td>
							<td> <a href="<?php echo base_url();?>admin/traders/details" title=""> Trade Name </a> </td>
							<td> <a href="<?php echo base_url();?>admin/users/details" title="">User Name </a> </td>
							<td> 2.3L</td>
						<td> 
							 <ul class="action_list"> 
                  <li> <a href="<?php echo base_url();?>admin/trades/edit" title=""> Edit </a> </li>
                  <li> / </li>
                  <li> <a href="#" title="" data-toggle="modal" data-target="#delete_user"> Delete </a> </li>
                </ul>
						</td>
						</tr>
						<tr>
							<td> 65852 </td>
							<td> <a href="<?php echo base_url();?>admin/traders/details" title=""> Trade Name </a> </td>
							<td> <a href="<?php echo base_url();?>admin/users/details" title="">User Name </a> </td>
							<td> 2.3L</td>
						<td> 
							 <ul class="action_list"> 
                  <li> <a href="<?php echo base_url();?>admin/trades/edit" title=""> Edit </a> </li>
                  <li> / </li>
                  <li> <a href="#" title="" data-toggle="modal" data-target="#delete_user"> Delete </a> </li>
                </ul>
						</td>
						</tr>
						<tr>
							<td> 65852 </td>
							<td> <a href="<?php echo base_url();?>admin/traders/details" title=""> Trade Name </a> </td>
							<td> <a href="<?php echo base_url();?>admin/users/details" title="">User Name </a> </td>
							<td> 2.3L</td>
						<td> 
							 <ul class="action_list"> 
                  <li> <a href="<?php echo base_url();?>admin/trades/edit" title=""> Edit </a> </li>
                  <li> / </li>
                  <li> <a href="#" title="" data-toggle="modal" data-target="#delete_user"> Delete </a> </li>
                </ul>
						</td>
						</tr>
						
						
						<tr>
							<td> 65852 </td>
							<td> <a href="<?php echo base_url();?>admin/traders/details" title=""> Trade Name </a> </td>
							<td> <a href="<?php echo base_url();?>admin/users/details" title="">User Name </a> </td>
							<td> 2.3L</td>
						<td> 
							 <ul class="action_list"> 
                  <li> <a href="<?php echo base_url();?>admin/trades/edit" title=""> Edit </a> </li>
                  <li> / </li>
                  <li> <a href="#" title="" data-toggle="modal" data-target="#delete_user"> Delete </a> </li>
                </ul>
						</td>
						</tr>	
						</tbody>
					</table>
				</div>
				</div>
			</div>
		</div>
	
		
	<!-- End loan -->
	</div>
	
</div>
<script type="text/javascript">
var url = '<?php echo base_url()?>';
$('#usr_lst_tbl').DataTable();
$(document).ready(function(){
		 $('#fil1').multiselect();
		 $('#fil2').multiselect();
		 $('#fil3').multiselect();
		 $('#mul1').multiselect();
	$('#mul2').multiselect();
	$('#mul3').multiselect();
	$('#mul4').multiselect();
	$('#mul5').multiselect();
	$('#mul6').multiselect();
	$('.top_blk_cre').click(function(){
		$('.btm_cre').slideToggle();
		$('.act_values_n, .act_values_p').toggleClass('hide');
	});
	$('#f_ac_prc, #f_ac_we').keyup(function(){
 			var f_prc = $('#f_ac_prc').val();
 			var f_wth = $('#f_ac_we').val();
 			$('#ttl_amnt_fr').html(f_prc*f_wth);
 			// alert();
	});
	$('#cm_ac_prc, #cm_ac_we').keyup(function(){
 			var f_prc = $('#cm_ac_prc').val();
 			var f_wth = $('#cm_ac_we').val();
 			$('#ttl_amnt_cm').html(f_prc*f_wth);
 			// alert();
	});
		});
</script>
<div class="modal" id="delete_user">
              <div class="modal-dialog">
                   <div class="modal-content">
                        <div class="modal-body">
                              <h1> Are You Sure ! </h1>
                              <p> You want delete this Trade </p>
                        </div>
                        <div class="modal_footer">
                          <button type="button" class="btn btn-primary" data-dismiss="modal">Yes</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
        </div>
                   </div>
              </div>
          </div>
<?php require_once 'footer.php' ; ?>