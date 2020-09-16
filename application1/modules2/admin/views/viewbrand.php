<?php require_once 'header.php' ; ?>
<link href="<?php echo base_url();?>assets/css/editbrand.css" type="text/css" rel="stylesheet">
<?php require_once 'sidebar.php' ; ?>		
<div class="right_blk">
	<div class="top_ttl_blk"> 
		<span class="back_btn"> 
		<!-- <a href="<?php echo base_url();?>admin/Companies" title=""><img src="<?php echo base_url();?>assets/images/back.png" alt="" title=""> </a> --></span> <span> Company Detail</span>

		<a href="<?php echo base_url();?>admin/Companies/edit/<?php echo $bdata["brand_id"];?>" title="" class="btn ed_usr btn-primary fr"> Edit Company </a>
	</div>
        
	<div class="padding_30">
		<div class="row">
			<div class="col-md-12 ll_blk">
				<div class="card_view mar_btm">
					<div class="pad_20"> 
						<div class="hdg_bk">Company Details </div>
						<div class="row"> 
						<div class="col-md-6"> <b>Company Name:</b> </div>
						<div class="col-md-6"> <?php echo $bdata["brand_name"];?> </div>
						</div>

						<div class="row"> 
							<div class="col-md-6"> <b>Contact Person:</b> </div>
							<div class="col-md-6"> <?php echo $bdata["contact_person"];?> </div>
						</div>

						<div class="row"> 
							<div class="col-md-6"> <b>Mobile Number:</b> </div>
							<div class="col-md-6"> <?php echo $bdata["contact_mobile"];?>  </div>
						</div>

						<div class="row"> 
							<div class="col-md-6"> <b>Email Id:</b> </div>
							<div class="col-md-6">  <?php echo $bdata["contact_email"];?>  </div>
						</div>

						<div class="row"> 
							<div class="col-md-6"> <b>Location:</b> </div>
							<div class="col-md-6">  <?php echo $bdata["contact_loc"];?>  </div>
						</div>
			
						<div class="row"> 
							<div class="col-md-6"> <b>Turnover Discount:</b> </div>
							<div class="col-md-6">  <?php echo $bdata["turnover_disc"];?>  </div>
						</div>
					</div>
				</div>

				<div class="card_view mar_btm">
					<div class="pad_20"> 
						<div class="hdg_bk">Categories </div>						
						<div class="col-md-12"> 
							<?php foreach($categories as $cat){ ?>
							<div class="btn btn-primary btn-sm"> <b> <?php echo $cat;?></b> </div>
							<?php } ?>
						</div>
					</div>
				</div>

				<div class="card_view mar_btm">
					<div class="pad_20"> 
						<div class="hdg_bk">Sub Categories</div>
						<div class="col-md-12"> 
							<?php foreach($subcategories as $scat){ ?>
							<div class="btn btn-info btn-sm"> <b> <?php echo $scat;?></b> </div>
							<?php } ?>
						</div>

				
						<hr/>
						<?php if(in_array(2, explode(",",$bdata["brand_cat"]))){?>
						<div class="hdg_bk">Medicine Type: <span class="btn btn-warning btn-sm"> <?php echo "Medicine".$bdata["medicine_type"];?>  </span> </div>
						<?php } ?>
						<div class="hdg_bk">Published: <span class="btn btn-success btn-sm"> <?php echo ($bdata["status"]==1)? "Yes":"No";?>  </span> </div>
				
					 </div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
var url = '<?php echo base_url()?>';  
$(document).ready(function() {
});
</script>
<?php require_once 'footer.php' ; ?>