<?php require_once 'header.php' ; ?>
<link href="<?php echo base_url();?>assets/css/trader.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>assets/js/common.js" type="javascript"></script>
<?php require_once 'sidebar.php' ; ?>		
<div class="right_blk"> 
	<div class="top_ttl_blk"> <span class="back_btn">
		<a href="<?php echo base_url();?>admin/traders/" title=""><img src="<?php echo base_url();?>assets/images/back.png" alt="" title=""> </a></span> <span> Create Trader </span>
		<!-- <a href="#" title="" class="fr btn btn-primary"> Show all Traders  </a> -->
	</div>

	<div class="padding_30">

		<ul class="usrs_blk"> 
          <li class="far_act act" id="exp"> <img src="../../assets/images/export.png" width="62"> <span> Exporter </span> </li>
          <li id="age"> <img src="../../assets/images/f_2.png"> <span>  Agent </span> </li>
              </ul>
	<!-- create loan -->
		<div class="card_view bg_gry">
			<div class="padding_30"> 
				<form class="exp">
					<div class="hdg_bk"> Exporter </div>
					<div class="row"> 


      <div class="col-md-4"> 
            <div class="form-group">
    <label>Firm Name</label>
    <input type="text" class="form-control" placeholder="Firm Name">
  </div>
      </div>

       <div class="col-md-4"> 
            <div class="form-group">
    <label>Contact Person</label>
    <input type="text" class="form-control" placeholder="Contact Person">
  </div>
      </div>

      <div class="col-md-4"> 
            <div class="form-group">
    <label>Mobile</label>
    <input type="text" class="form-control" placeholder="Mobile">
  </div>
      </div>

       <div class="col-md-4"> 
            <div class="form-group">
    <label>Location</label>
    <input type="text" class="form-control" placeholder="Location">
  </div>
      </div>

      <div class="col-md-4"> 
            <div class="form-group">
    <label>Payment Terms</label>
    <input type="text" class="form-control" placeholder="Payment Terms">
  </div>
      </div>


       <div class="col-md-4"> 
            <div class="form-group">
    <label>PAN</label>
    <input type="text" class="form-control" placeholder="PAN">
  </div>
      </div>

       <div class="col-md-4"> 
            <div class="form-group">
    <label>GST</label>
    <input type="text" class="form-control" placeholder="GST">
  </div>
      </div>

       <div class="col-md-4"> 
       <div class="form-group">
    <label>Balance</label>
    <input type="text" class="form-control" placeholder="Balance">
  </div>
      </div>
					</div>


<button type="submit" class="btn btn-primary mar_tp_20"> Submit </button>

					</form>


					<form class="age">
						<div class="hdg_bk"> Agent </div>
					<div class="row"> 


      <div class="col-md-4"> 
            <div class="form-group">
    <label>Full Name</label>
    <input type="text" class="form-control" placeholder="Full Name">
  </div>
      </div>

<!--        <div class="col-md-4"> 
            <div class="form-group">
    <label>Contact Person</label>
    <input type="text" class="form-control" placeholder="Contact Person">
  </div>
      </div> -->

      <div class="col-md-4"> 
            <div class="form-group">
    <label>Mobile</label>
    <input type="text" class="form-control" placeholder="Mobile">
  </div>
      </div>

       <div class="col-md-4"> 
            <div class="form-group">
    <label>Location</label>
    <input type="text" class="form-control" placeholder="Location">
  </div>
      </div>

 

       <div class="col-md-4"> 
            <div class="form-group">
    <label>Aadhar</label>
    <input type="text" class="form-control" placeholder="Payment Terms">
  </div>
      </div>

       <div class="col-md-4"> 
            <div class="form-group">
    <label>PAN</label>
    <input type="text" class="form-control" placeholder="PAN">
  </div>
      </div>

        <div class="col-md-4"> 
            <div class="form-group">
    <label>Payment Terms</label>
    <input type="text" class="form-control" placeholder="Payment Terms">
  </div>
      </div>
       <div class="col-md-4"> 
       <div class="form-group">
    <label>Balance</label>
    <input type="text" class="form-control" placeholder="Balance">
  </div>
      </div>
					</div>


<button type="submit" class="btn btn-primary mar_tp_20"> Submit </button>

					</form>
			</div>
		</div>
		
	<!-- End loan -->
	</div>
	
</div>
<script type="text/javascript">
var url = '<?php echo base_url()?>';
</script>
<script type="text/javascript">
       
  $(document).ready(function() {
  	$('#type_tri').multiselect();
  	$('#exp').click(function(){
  		$(this).addClass('act');
  		$('.exp').show();
  		$('.age').hide();
  		$('#age').removeClass('act');
  	});
  	$('#age').click(function(){
  		$(this).addClass('act');
  		$('.age').show();
  		$('.exp').hide();
  		$('#exp').removeClass('act');
  	});
  });
  	</script>
<?php require_once 'footer.php' ; ?>