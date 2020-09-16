<?php require_once 'header.php';?>
<link href="<?php echo base_url(); ?>assets/css/createtrade.css" type="text/css" rel="stylesheet">
<?php require_once 'sidebar.php';?>
<div class="right_blk">
	<div class="top_ttl_blk"> 
		<span class="back_btn">
		<!-- <a href="<?php echo base_url(); ?>admin/trades" title=""><img src="<?php echo base_url(); ?>assets/images/back.png" alt="" title=""> </a> -->
		</span>
		<span> Trades </span>
	</div>

	<div class="padding_30">
	<!-- create loan -->
		<div class="card_view">
			<div class="padding_30">
					<div class="row">
						<div class="col-md-4">
								<div class="form-group">
          				<label> Select User </label>
                       <select id="mul1">
                          <option selected> User-1 </option>
                          <option> User-2 </option>
                          <option> User-3 </option>
                      </select>
           </div>
						</div>

							<div class="col-md-4">
								<div class="form-group">
          				<label> Select Trader </label>
                       <select id="mul2">
                          <option selected> Trader-1 </option>
                          <option> Trader-2 </option>
                          <option> Trader-3 </option>
                      </select>
           </div>
						</div>

						<div class="col-md-4">
								<div class="form-group">
          				<label> Select Type </label>
                       <select id="mul3">
                          <option selected> Fish </option>
                          <option> Prawn </option>
                      </select>
           </div>
						</div>

					</div>

					<div class="hdg_bk"> Commitment </div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
				<label>Expected Count</label>
   <select id="mul4">
                          <option selected> 10 </option>
                          <option> 25 </option>
                           <option> 40 </option>
                      </select>
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
				<label>Expected Farmer Price</label>
    <input type="text" class="form-control" placeholder="Expected Farmer Price">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
				<label>Expected Company Price</label>
    <input type="text" class="form-control" placeholder="Expected Company Price">
							</div>
						</div>
					</div>

					<div class="hdg_bk"> Actual </div>

					<div class="row">
<div class="col-md-4">
	<div class="tr_bor_blk">
		<div class="sub_hdg">
		<div class="row">
<div class="col-md-12">
	<b class=""> Farmer: </b>
</div>

</div>
</div>
	<div class="form-group">
				<label>Actual Count</label>
   <select id="mul5">
                          <option selected> 10 </option>
                          <option> 25 </option>
                           <option> 40 </option>
                      </select>
							</div>


							<div class="form-group">
				<label>Actual Weight</label>
    <input type="text" class="form-control" id="f_ac_we" placeholder="Actual Weight">
							</div>


							<div class="form-group">
				<label>Actual Price</label>
    <input type="text" class="form-control" id="f_ac_prc" placeholder="Actual Price">
							</div>
							<div class="total_amont">
						 Total Amount: ₹<span id="ttl_amnt_fr">0 </span>
					</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="tr_bor_blk">
					<b class="sub_hdg"> Company: </b>


							<div class="form-group">
				<label>Actual Count</label>
   <select id="mul6">
                          <option selected> 10 </option>
                          <option> 25 </option>
                           <option> 40 </option>
                      </select>
							</div>


							<div class="form-group">
				<label>Actual Weight</label>
    <input type="text" class="form-control" id="cm_ac_we" placeholder="Actual Weight">
							</div>


							<div class="form-group">
				<label>Actual Price</label>
    <input type="text" class="form-control" id="cm_ac_prc" placeholder="Actual Price">
							</div>

						<div class="total_amont">
						 Total Amount: ₹
						 <span id="ttl_amnt_cm">0 </span>
					</div>
					</div>
				</div>
					</div>

					<div class="sbm">  <input type="submit" class="btn mar_25_t btn-primary">	 </div>
			</div>
		</div>

	<!-- End loan -->
	</div>

</div>
<script type="text/javascript">
var url = '<?php echo base_url() ?>';
$(document).ready(function(){
	$('#mul1').multiselect();
	$('#mul2').multiselect();
	$('#mul3').multiselect();
	$('#mul4').multiselect();
	$('#mul5').multiselect();
	$('#mul6').multiselect();

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
<?php require_once 'footer.php';?>