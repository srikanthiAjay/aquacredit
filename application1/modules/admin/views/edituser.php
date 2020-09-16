<?php $this->load->view('admin/header');?>
<link href="<?php echo base_url();?>assets/css/user.css" type="text/css" rel="stylesheet">
<style type="text/css">
.modal-body {
    padding-top: 40px;
}
.modal-body h1, .modal-body p {
    text-align: center;
}
</style>
<?php $this->load->view('admin/sidebar');?>
<div class="modal" id="delete_user">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				  <h1> Are You Sure ! </h1>
				  <p id="ele_msg"></p>
			</div>
			<div class="modal_footer">
				<input type="hidden" name="ele_action" id="ele_action" value="" />
				<input type="hidden" name="ele_id" id="ele_id" value=""/>
				<button type="button" class="btn btn-primary" data-dismiss="modal" onclick="delConfirm();">Yes</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
			</div>
		</div>
	</div>
</div>
<!--View Doc-->
<div class="modal" id="delete_doc">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				  <h1> Are You Sure ! </h1>
				  <p id="ele_doc_msg"></p>
			</div>
			<div class="modal_footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal" onclick="delDocConfirm();">Yes</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
			</div>
		</div>
	</div>
</div>
<div id="PDFModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="display: block;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="doc_type">Modal Header</h4>
            </div>
            <div class="modal-body">
                <div id="IMG_ID">
                    <embed id="IMGSRC" src="" width="100%" frameborder="0">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
</div>
<!--View Doc End-->		
<div class="right_blk"> 
	<div class="top_ttl_blk"> <span class="back_btn">
		<!-- <a href="<?php echo base_url();?>admin/users/" title=""><img src="<?php echo base_url();?>assets/images/back.png" alt="" title=""> </a> --> </span><span> Edit Users </span>
	</div>

	<div class="padding_30">
		<div class="card_view bg_gry">
		<div class="form-group" id="flsh_msg"></div>
		<?php 
			if($user['user_type']=='FARMER'){
				$this->load->view('admin/user/editfarmer',$data);
			}else if($user['user_type']=='DEALER'){
				$this->load->view('admin/user/editdealer',$data);
			}else{
				$this->load->view('admin/user/editnonformer',$data);
			}
		?>	
		</div>
		
	  </div>
	</div>
</div>
<?php $this->load->view('admin/user/brands',$data);?>
<script type="text/javascript">
	var url = '<?php echo base_url()?>';
	var loader_fa='<i class="fa fa-circle-o-notch fa-spin" style="font-size:15px"></i>';
	$('.input_disable').prop("disabled", true);
	$('.hide_action_btn').hide();
</script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/new_common.js" type="javascript"></script>
<?php 
if($user['user_type']=='FARMER'){
?>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/views/farmer.js" type="javascript"></script>
<?php
}else if($user['user_type']=='DEALER'){
?>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/views/dealer.js" type="javascript"></script>
<?php
}else{
?>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/views/nonfarmer.js" type="javascript"></script>
<?php
}
?>	
<?php $this->load->view('admin/footer');?>