<div class="alpha_blk"></div>
<div class="side_popup"> 
	<div class="padding_30">
		<div id="flsh_msg_med"></div>
		<form class="products_slcs tab-content" action="javascript:void(0);" method="post">
			<div class="hdg_bk">All Brands </div>
			<div class="auto_search"> 
				<div class="form-group">
					<input type="text" class="form-control" id="ato_serc" placeholder="Search Brands" onkeyup="myFunction();" />   
				</div>
			</div>
		<ul class="al_brands" id="myUL">
			<?php 
				if(count($brands>0)){
					foreach ($brands as $key=>$value) {
					?>
						<li id="<?php echo $value['brand_id'];?>" rel="<?php echo $value['brand_name'];?>">
						  <div class="form-check">
							<input type="checkbox" class="form-check-input" id="brand<?php echo $value['brand_id'];?>" name="brand[]" value="<?php echo $value['brand_id'];?>" onchange="barndcheck('<?php echo $value['brand_id'];?>');" <?php if(in_array($value['brand_id'], $allmed_arr)){echo 'checked="checked"';}?>/>
							<label class="form-check-label" for="brand<?php echo $value['brand_id'];?>"><?php echo $value['brand_name'];?></label>
						  </div>
						</li>
					<?php
					}
				}
				
			?>
			<?php /*for($i=0;$i<20;$i++){ ?>
			<li id="<?php echo $i+1;?>" rel="Brand <?php echo $i+1;?>"> 
				<div class="form-check" >
					<input type="checkbox" class="form-check-input" id="brand<?php echo $i+1;?>" id="brand" name="brand[]" value="<?php echo $i+1;?>" onchange="barndcheck('<?php echo $i+1;?>');">
					<label class="form-check-label" for="brand<?php echo $i+1;?>">Brand <?php echo $i+1;?></label>
				</div>
			</li>
			<?php }*/ ?>
		</ul>
		
		 <div class="pop_ftr"> <button class="btn btn-primary medsub" > Assign to Medicines<span id="medsection"></span></button>
		 <button type="button" class="btn btn-danger cls_pp_sd"> Close </button> </div> 
		</form>
	</div>
</div>


<!-- user privew -->
<div class="alpha_blk2"></div>
<div class="full_wth_popup padding_30"> 
	<div class="hdg_bk head_title"> User Details (Farmer - Single)</div>
	<div class="row">

		<div class="col-md-4 view_uname"> 
			<div class="form-group">
				<label for="vuname">Name</label>
				<span id="vuname">Sample Name</span> 
			</div>
		</div>

		<div class="col-md-4 view_gname"> 
			<div class="form-group">
				<label for="vgname" >Guarantor(C/O)</label>
				<span id="vgname"></span>
			</div>
		</div>

		<div class="col-md-4 view_mobile"> 
			<div class="form-group">
				<label for="vmobile" >Mobile</label>
				<span id="vmobile"></span>   
			</div>
		</div> 	  

		<div class="col-md-4 view_emailid"> 
			<div class="form-group">
				<label for="vemailid">Email Id</label>
				<span id="vemailid"></span> 
			</div>
		</div>
		
		<div class="col-md-4 view_addr"> 
			<div class="form-group">
				<label for="vaddr">Address</label>
				<span id="vaddr"></span>
			</div>
		</div>
	</div>
	<div class="hdg_bk">Alerts </div>
	<p> Do you want to receive alerts : <b class="grn_clr"> <span id="valert"></span> </b> </p>
	<div class="row view_alerts"> 
		<div class="col-md-6"> 
			<div class="form-group">
			   <label for="valertmob">Phone Number</label>  
			   <span id="valertmob"></span>
			</div>
		</div>

		<div class="col-md-6"> 
			<div class="form-group">
			   <label for="valertmail">Email</label>  
			   <span id="valertmail"></span>
			</div>
		</div>
	</div>
	
	<div class="hdg_bk partner_block">Partner Details <span id="partnercount">(1)</span></div>
	<div class="row view_partners_labels"> 
		<div class="col-md-4"> 
			<div class="form-group">
				<label for="vpartner">Partner Name</label>
			</div>	
		</div>
		<div class="col-md-4"> 
			<div class="form-group">
				<label for="vpaadhar">Aadhar </label>
			</div>
		</div>
		<div class="col-md-4"> 
			<div class="form-group">
				<label for="vpmobile">Phone Number </label>
			</div>
		</div>
	</div>
	<div class="row view_partners"></div>
	
	<div class="hdg_bk">Accounts Information </div>
	<div class="row view_accounts"> 
		<div class="col-md-4 vaadhar_block"> 
			<div class="form-group">
				<label for="vaadhar">Aadhar</label>  
				<span id="vaadhar"></span>
			</div>
		</div>
		<div class="col-md-4 vpan_block"> 
			<div class="form-group">
				<label for="vpan">PAN </label>
				<span id="vpan"></span>
			</div>
		</div>
		<div class="col-md-4 vgst_block"> 
			<div class="form-group">
				<label for="vgst">GST </label>
				<span id="vgst"></span>
			</div>
		</div>
	</div>
  
	<div class="hdg_bk">Bank Details <span id="bankcount">(1)</span> </div>
	<div class="row"> 
		<div class="col-md-3"> 
			<div class="form-group">
				<label for="vperson">Person Name </label>				
			</div>
		</div>

		<div class="col-md-3"> 
			<div class="form-group">
			   <label for="vacnum">Account Number</label>			
			</div>
		</div>
	  
		<div class="col-md-2"> 
			<div class="form-group">
				<label for="vbname">Bank Name</label>				
			</div>
		</div>

		<div class="col-md-2"> 
			<div class="form-group">
			   <label for="vifsc">IFSC</label>			
			</div>
		</div>

		<div class="col-md-2"> 
			<div class="form-group">
				<label for="vbranch">Branch Name</label>				
			</div>			
		</div>
		
	</div>
	<div class="row view_banks"></div>

	<div class="hdg_bk">Crop Details <span id="cropcount">(1)</span> </div>

	<div class="row"> 
		<div class="col-md-4"> 
			<div class="form-group">
				<label for="vcroploc">Crop Location</label>
			</div>
		</div>

		<div class="col-md-4"> 
			<div class="form-group">
				<label for="vcroptype">Crop Type</label>
			</div>
		</div>

		<div class="col-md-4"> 
			<div class="form-group">
				<label for="vacres">Number Of Acres</label>
			</div>
		</div>
	</div>
	<div class="row view_crops"></div>

	<div class="hdg_bk">Defalst Discount </div>
	<div class="row view_discounts">
		<div class="col-md-4"> 
			<div class="form-group">
				<label for="vfeed">Feed(%)</label>
				<span id="vfeed"></span>%
		  </div>
		</div>

		<div class="col-md-4"> 
			<div class="form-group">
			   <label for="vmed1">Medicines1 (%)</label>
				<span id="vmed1"></span>% - Default
			</div>
		</div>
		
		<div class="col-md-4"> 
			<div class="form-group">
				<label for="vmed2">Medicines2 (%)</label>
				<span id="vmed2"></span>% - Default
		  </div>
		</div>
		
		<div class="col-md-4"> 
			<div class="form-group">
			   <label for="vmed3">Medicines3 (%)</label>
			<span id="vmed3"></span>% - Default
			</div>
		</div>

		<div class="col-md-4"> 
			<div class="form-group">
			   <label for="vroi">Rate Of Intrest</label>
				<span id="vroi"></span>%
			</div>
		</div>
	</div>

	<div class="hdg_bk">Document Upload </div>
	<div class="row view_docs"> 
		<div class="col-md-4">  
		  <ul id="vdocs"> 
			
		  </ul>
		</div>

		<div class="col-md-4"> 
			<div class="form-group">
			   <label for="vrcdate">Documents Received Date</label>
				<span id="vrcdate">10-Apr-2020</span>
		  </div>
		</div>

		<div class="col-md-4"> 
			<div class="form-group">
			   <label for="vrtdate">Documents Return Date</label>
				<span id="vrtdate">15-Apr-2021</span>
		  </div>
		</div>

		<div class="col-md-12">
		  <div class="form-group">
			   <label for="vdocrem">Remarks</label>
				<p id="vdocrem"></p>
		  </div>
		</div>

		<div class="hdg_bk">Out Standing Amount <span class="rd_clr vosamt"> -20,000  </span> </div>
		<div class="row"> 
			<div class="col-md-12">
			  <div class="form-group"> 
					<label for="vosrem">Remarks</label>
					<p id="vosrem"></p>
			  </div>
			</div>
		</div>
	</div>

	<div class="ftr_pop"> 
		<button type="button" class="btn btn-info edt_user">Edit</button>
		<button type="button" class="btn btn-primary" id="cnf_sbmt" >Submit</button>
	</div>
</div>