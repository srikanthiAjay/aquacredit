<?php require_once 'header.php' ; ?>
<link href="<?php echo base_url();?>assets/css/createreturn.css" type="text/css" rel="stylesheet">
<?php require_once 'sidebar.php' ; ?>
<link href="<?php echo base_url();?>assets/css/snackbar.css" type="text/css" rel="stylesheet">		
<div class="right_blk">
	<div class="top_ttl_blk"> 
		<!-- <span class="back_btn"><a href="<?php echo base_url();?>admin/sales" title=""><img src="<?php echo base_url();?>assets/images/back.png" alt="" title=""> </a></span> --> <span> <?php echo $page_title;?></span>
		<a href="<?php echo base_url();?>admin/returns" title="" class="fr btn btn-primary"> Show all Returns </a>		
		<div id="snackbar" class=""></div>
	</div>
	<div class="sale_rt"> 
		<h2 class="create_hdg"> Recent Returns </span></h2>
		
		<ul class="nav nav-tabs" id="myTab" role="tablist">
			<li class="nav-item">
				<a class="nav-link active" id="home-tab" data-toggle="tab" href="#f_far" role="tab" aria-controls="home" aria-selected="true">From Farmer</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="profile-tab" data-toggle="tab" href="#t_com" role="tab" aria-controls="profile"	aria-selected="false">To Company</a>
			</li>
		</ul>
		<div class="tab-content">
			
			<div id="f_far" class="tab-pane fade show active">
				<div class="top_in_op crop_top">
					<h1> Product Name <span> (10) </span> </h1>
					<p> 12-May-2020 </p> 
				</div>
				<div class="top_in_op crop_top">
					<h1> Product Name <span> (10) </span> </h1>
					<p> 12-May-2020 </p> 
				</div>
				<div class="top_in_op crop_top">                              
					<h1> Product Name <span> (10) </span> </h1>
					<p> 12-May-2020 </p> 
				</div>
				<div class="top_in_op crop_top">
					<h1> Product Name <span> (10) </span> </h1>
					<p> 12-May-2020 </p>
				</div>
				<div class="top_in_op crop_top">
					<h1> Product Name <span> (10) </span> </h1>
					<p> 12-May-2020 </p> 
				</div>
			</div>
			<div id="t_com" class="tab-pane fade">
				<div class="top_in_op crop_top">                             
					<h1> Product Name <span> (10) </span> </h1>
					<p> 12-Jun-2020 </p> 
				</div>
				<div class="top_in_op crop_top">
					<h1> Product Name <span> (10) </span> </h1>
					<p> 12-Jun-2020 </p> 
				</div>
				<div class="top_in_op crop_top">
					<h1> Product Name <span> (10) </span> </h1>
					<p> 12-Jun-2020 </p> 
				</div>
				<div class="top_in_op crop_top">
					<h1> Product Name <span> (10) </span> </h1>
					<p> 12-Jun-2020 </p>
				</div>
				<div class="top_in_op crop_top">
					<h1> Product Name <span> (10) </span> </h1>
					<p> 12-Jun-2020 </p> 
				</div>
			</div>
		</div>
	</div>
	<div class="sle_cr_r"> 		
		<!-- <h2 class="create_hdg"> Loan Request </h2> -->
		<ul class="assign_type"> 
			<li class="act_type lnk_typ frm_farm"> 
				<img src="http://3.7.44.132/aquacredit/assets/images/credit_icn.png">
				<input type="radio" name="rtn_types" value="farmer" checked>
				<span> From Farmers </span>
			</li>
			<li class="lnk_typ to_cmp"> 
				<img src="http://3.7.44.132/aquacredit/assets/images/cash_icn.png">
				<input type="radio" name="rtn_types" value="company">
				<span> To Company </span>
			</li>
		</ul>
		<div class="from_farmer">
			<ul class="create_ul">
				<li class="create_li slc_usr">
					<div class="check_wt_serc"> 
						<div class="show_va">Select  Branch</div>
						<div class="selectVal">  Select  Branch </div>
						<ul class="check_list mykey" id="brn_l"> 
							<li id="branch_opt_li"></li>
						</ul>												
					</div>
				</li>
				<li class="create_li">
					<div class="cre_inp">
						<div class="sm_blk"> Search User </div>
						<input type="text" class="form-control mykey" placeholder="" data-original-title="" title="" name="ukey" id="ukey">
						<input type="hidden" class="form-control" placeholder=""  name="userid" id="userid">
						<input type="hidden" class="form-control" placeholder=""  name="usertype" id="usertype">
					</div>
				</li>

				<li class="create_li slc_usr">
					<div class="check_wt_serc"> 
						<div class="show_va">Select  Crop</div>
						<div class="selectVal">  Select  Crop </div>
						<ul class="check_list"> 
							<li id="crop_opt_li"></li>													
						</ul>												
					</div>
				</li>
				
				<li class="create_li " style="display: none;" id="guestmobile">
					 	<div class="cre_inp">
					  		<div class="sm_blk"> Mobile </div>
					    	<input type="text" onkeypress="return onlyNumberKey(event)" maxlength="10" class="form-control mykey" placeholder="" data-original-title="" title="" name="mobile" id="mobile">
						</div>
					</li>
			</ul>
			<div class="add_more">
				<a href="javascript:void(0);" onclick="addmorerows();">Add More</a>
			</div>
			<div class="res_tbl">
				<table class="sa_lst" cellpadding="0" cellspacing="" border="0">
				<thead>
					<tr> 
						<th> Product Name </th>
						<th class="qty txt_cnt"> Qty </th>
						<th class="mrp txt_rt"> MRP </th>
						<th class="disc"> Discount </th>
						<th class="ttl_prc txt_rt"> Total Price </th>
						<th class="dele_th_td"> Delete </th>
					</tr>
				</thead>
				<tbody id="invoiceItem">
					<!--<tr> 
						<td> <input type="text" value="Product Name"> </td>
						<td class="qty txt_cnt"> <input type="text" value="10"> </td>
						<td class="mrp txt_rt"> <input type="text" value="2,000"> </td>
						<td class="disc txt_rt"> <input type="text" value="20%"> </td>
						<td class="ttl_prc txt_rt"> <input type="text" value="1,800"> </td>
						<td class="dele_th_td"><i class="fa fa-trash" onclick="removerow(5)" style="color:red" aria-hidden="true"></i></td>
					</tr> -->
					
				</tbody>
				<tfoot>
					<tr>
						<td colspan="4" class="txt_rt"> <b>Grand Total</b> </td>
						<td class="txt_rt"> <b id="gtotamt"> 0 </b> 
						<input type="hidden" placeholder="0" name="gtotamtval" id="gtotamtval" > </td>
						<td> </td>
					</tr>
				</tfoot>
			</table>
			<input type="hidden" id="rowval" value="0">
		</div>
		<h2 class="create_hdg" style="margin-bottom: 15px; text-align: right;"> Select below options to settle ₹8,700 to user </h2>
		<ul class="assign_type"> 
			<li class="act_type lnk_typ ban_trns"> 
				<img src="http://3.7.44.132/aquacredit/assets/images/bank_tansfer.png">
				<input type="radio" name="act_types" value="bank" checked>
				<span> Bank Transfer </span>
			</li>
			<li class="cash_trns lnk_typ"> 
				<img src="http://3.7.44.132/aquacredit/assets/images/cash_icn.png">
				<input type="radio" name="act_types" value="cash">
				<span> Cash </span>
			</li>
			<li class="crdt_trns lnk_typ"> 
				<img src="http://3.7.44.132/aquacredit/assets/images/credit_icn.png">
				<input type="radio" name="act_types" value="cash">
				<span> Credit </span>
			</li>
		</ul>

		<ul class="trans_inf bnk_tr"> 
			<li class="create_li date">
				<div class="cre_inp">
					<div class="sm_blk"> Date </div>
					<input type="text" class="form-control" placeholder="" data-original-title="" title="">
				</div>
			</li>

<li class="admin_bank_li"> 
 		<div class="check_wt_serc wth_225_sel"> 
              <div class="show_va"> Select Bank </div>
            <div class="selectVal">  Select Bank </div>
            <ul class="check_list"> 
  
              <li> 
        <div class="form-check">
  <input class="form-check-input" type="radio" name="trader" id="bnk1" value="Bank 1">
<label class="form-check-label" for="bnk1">
    <div class="bank_logo"> <img src="http://3.7.44.132/aquacredit/assets/images/sib_icn.png" alt="" title=""> </div>
        <div class="bank_mny"> 
            <div class="bank_bal"> ₹ 10,000 </div>
            <div class="accont_numb">xxxxxxxxx01792</div>
        </div>
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="trader" id="bnk2" value=" Bank 2">
<label class="form-check-label" for="bnk2">
  <div class="bank_logo"> <img src="http://3.7.44.132/aquacredit/assets/images/hdfc_icn.png" alt="" title=""> </div>
        <div class="bank_mny"> 
            <div class="bank_bal"> ₹ 10,000 </div>
            <div class="accont_numb">xxxxxxxxx01792</div>
        </div>
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="trader" id="bnk3" value="Bank 3">
<label class="form-check-label" for="bnk3">
         <div class="bank_logo"> <img src="http://3.7.44.132/aquacredit/assets/images/icici_icn.png" alt="" title=""> </div>
        <div class="bank_mny"> 
            <div class="bank_bal"> ₹ 10,000 </div>
            <div class="accont_numb">xxxxxxxxx01792</div>
        </div>
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="trader" id="bnk4" value="Bank 4">
<label class="form-check-label" for="bnk4">
      <div class="bank_logo"> <img src="http://3.7.44.132/aquacredit/assets/images/hdfc_icn.png" alt="" title=""> </div>
        <div class="bank_mny"> 
            <div class="bank_bal"> ₹ 10,000 </div>
            <div class="accont_numb">xxxxxxxxx01792</div>
        </div>
  </label>
</div>
</li>
</ul>
</div>
 	</li>

 	<li class="admin_bank_li"> 
 		<div class="check_wt_serc wth_225_sel"> 
              <div class="show_va"> Select User Bank </div>
            <div class="selectVal">  Select User Bank </div>
            <ul class="check_list"> 
              <!-- <li> <div class="form-group">
                <input type="email" checked="true" class="form-control" placeholder="Search User Bank">
              </div> </li> -->
              <li> 
        <div class="form-check">
  <input class="form-check-input" type="radio" name="trader" id="bnk1" value="Bank 1">
<label class="form-check-label" for="bnk1">
    <div class="bank_logo"> <img src="http://3.7.44.132/aquacredit/assets/images/sib_icn.png" alt="" title=""> </div>
        <div class="bank_mny"> 
            <div class="bank_bal"> ₹ 10,000 </div>
            <div class="accont_numb">xxxxxxxxx01792</div>
        </div>
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="trader" id="bnk2" value=" Bank 2">
<label class="form-check-label" for="bnk2">
  <div class="bank_logo"> <img src="http://3.7.44.132/aquacredit/assets/images/hdfc_icn.png" alt="" title=""> </div>
        <div class="bank_mny"> 
            <div class="bank_bal"> ₹ 10,000 </div>
            <div class="accont_numb">xxxxxxxxx01792</div>
        </div>
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="trader" id="bnk3" value="Bank 3">
<label class="form-check-label" for="bnk3">
         <div class="bank_logo"> <img src="http://3.7.44.132/aquacredit/assets/images/icici_icn.png" alt="" title=""> </div>
        <div class="bank_mny"> 
            <div class="bank_bal"> ₹ 10,000 </div>
            <div class="accont_numb">xxxxxxxxx01792</div>
        </div>
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="trader" id="bnk4" value="Bank 4">
<label class="form-check-label" for="bnk4">
      <div class="bank_logo"> <img src="http://3.7.44.132/aquacredit/assets/images/hdfc_icn.png" alt="" title=""> </div>
        <div class="bank_mny"> 
            <div class="bank_bal"> ₹ 10,000 </div>
            <div class="accont_numb">xxxxxxxxx01792</div>
        </div>
  </label>
</div>
</li>
</ul>
</div>
 	</li>
<li class="create_li">
<div class="cre_inp">
  <div class="sm_blk"> Paid Amount </div>
    <input type="text" class="form-control" placeholder="" data-original-title="" title="">
 </div>
</li>
<li class="create_li">
<div class="cre_inp">
  <div class="sm_blk"> Reference Number </div>
    <input type="text" class="form-control" placeholder="" data-original-title="" title="">
 </div>
</li>


		</ul>

<!-- <div class="show_note">
<div class="note_add"> <a href="#" title=""> Note </a> </div> 
	<textarea placeholder="Note"></textarea>
</div> -->


<div class="not_li note_blk"> 
											<a href="" title="" class="ad_note" data-toggle="modal"> Note </a> 
											<div class="note_entr">
											<div class="form-group note_area"> 
											<textarea id="rece_note" name="rece_note" placeholder="Note" class="mykey" ></textarea>
											</div>
											</div>
										</div>

</div>

<div class="to_comp">
	<ul class="create_ul"> 

				<li class="create_li slc_usr">
												<div class="check_wt_serc"> 
													<div class="show_va">Select branch</div>
													<div class="selectVal">  Select branch </div>
													<ul class="check_list"> 
														<li id="branch_opt_li">
															
				</li>
					
													</ul>												
												</div>
												</li>
												

<li class="create_li slc_usr">
												<div class="check_wt_serc"> 
													<div class="show_va">Select  Company</div>
													<div class="selectVal">  Select  Company </div>
													<ul class="check_list"> 
														<li id="company_opt_li">
															
														</li>
														
													</ul>												
												</div>
												</li>
								</ul>

								<div class="res_tbl">
		<table class="sa_lst" cellpadding="0" cellspacing="" border="0">
			<thead>
			<tr> 
				<th> Product Name </th>
				<th class="qty txt_cnt"> Qty </th>
				<th class="mrp txt_rt"> Purchased Amount </th>
			</tr>
			</thead>
			<tbody>
				<tr> 
			<td> <input type="text" value="Product Name"> </td>
			<td class="qty txt_cnt"> <input type="text" value="10"> </td>
			<td class="mrp txt_rt"> <input type="text" value="2,000"> </td>
				</tr>
				<tr> 
		<td> <input type="text" value="Product Name"> </td>
		<td class="qty txt_cnt"> <input type="text" value="10"> </td>
		<td class="mrp txt_rt"> <input type="text" value="2,000"> </td>
				</tr>
				<tr> 
			<td> <input type="text" value="Product Name"> </td>
			<td class="qty txt_cnt"> <input type="text" value="10"> </td>
			<td class="mrp txt_rt"> <input type="text" value="2,000"> </td>
				</tr>
				<tr> 
			<td> <input type="text" value="Product Name"> </td>
			<td class="qty txt_cnt"> <input type="text" value="10"> </td>
			<td class="mrp txt_rt"> <input type="text" value="2,000"> </td>
				</tr>

				
				<tr>
						<td colspan="2" class="txt_rt"> <b> Total Amount </b> </td>
						<td class="txt_rt ttl_prc" colspan="2"> <b id="totamt"> 0 </b> 
						<input type="hidden" placeholder="0" name="totamtval" id="totamtval" >
						<input type="hidden" placeholder="0" name="totdiscount" id="totdiscount" >
						</td>
					</tr>

					<tr>
					<td colspan="2" class="txt_rt"> Loading Charges </td>
					<td class="txt_rt ttl_prc"> <input type="text" onkeypress="return onlyNumberKey(event)" value="0" name="load_charge" id="load_charge"> </td>
				</tr>
				<tr>
					<td colspan="2" class="txt_rt"> Transport Charges </td>
					<td class="txt_rt ttl_prc"> <input type="text" onkeypress="return onlyNumberKey(event)" value="0" name="transport_charge" id="transport_charge"> </td>
				</tr>

				<tr>
					<td colspan="2" class="txt_rt"> <b>Grand Total</b> </td>
					<td class="txt_rt ttl_prc"> <b id="gtotamt"> 0 </b> 
						<input type="hidden" placeholder="0" name="gtotamtval" id="gtotamtval" > </td>
				</tr>

			</tbody>
		</table>
		<h2 class="create_hdg" style="margin-top: 20px; text-align: right;">₹8,600 will be added to company balance </h2>
		<div class="show_note">
<div class="note_add"> <a href="#" title=""> Note </a> </div> 
	<textarea placeholder="Note"></textarea>
</div>
	</div>
</div>
		<div class="po_ftr">
					
			<button class="btn fr sb_btn btn-primary"> Return </button>
		</div>

	</div>
	
</div>
<script type="text/javascript">
var url = '<?php echo base_url()?>';
getbranches(); getbanks();
function getbranches()
{ 
  $.ajax({    
    url: url+"api/sales/getbranches",
    data: {},
    type:'POST',    
    datatype:'json',
    success : function(response){
      
      res= JSON.parse(response);        
      
        var opt = "";
        if(res.data.length > 0)
        {
            $.each(res.data, function(index, crop) {
            opt += '<div class="form-check"><input class="form-check-input" onclick="hidecolor();" type="radio" name="branchval" id="branch'+index+'" value="'+crop.branch_id+'" /><label class="form-check-label" for="branch'+index+'">'+crop.branch_name+'</label></div>';
          });
        }
       
        $("#branch_opt_li").html(opt);
    }
  });
}
function hidecolor()
{
	$('.mykey').parent().css("border", "");
}
function getusercrops(user_id,addoredit)
{
  var aeval = hidcrop = "";
  if(addoredit == "edit"){ aeval = "_edit"; hidcrop = $("#hid_crop_id").val();}
  $.ajax({    
    url: url+"api/UserCrops/index/"+user_id,
    data: {},
    type:'POST',    
    datatype:'json',
    success : function(response){
      
      //alert(response);
      res= JSON.parse(response);        
      //alert(res.data.length);
      
      //var usercode = $('#select_usercode'+aeval).val();
      var user_id = $('#userid'+aeval).val();
      var sel = "";
      if(user_id != "")
      {

        //var opt = '<option value="">-- Select Crop --</option>';
        var opt = "";
        if(res.data.length > 0)
        {

          $.each(res.data, function(index, crop) {
            
            if(crop.cd_id == hidcrop){ sel = "checked"; }else{ sel = "";}
            
            opt += '<div class="form-check"><input class="form-check-input" onclick="hidecolor();" type="radio" name="crop_opt'+aeval+'" id="crp'+index+aeval+'" value="'+crop.cd_id+'" '+sel+' /><label class="form-check-label" for="crp'+index+aeval+'">'+crop.crop_location+'</label></div>';
          });
        }
      }else{
        //var opt = '<option value="">-- Select user first --</option>';
        var opt = '';
      }
      $("#crop_opt_li"+aeval).html(opt);
      //$("#crop_opt"+aeval).select2('refresh');
      //document.getElementById("crop_opt"+aeval).fstdropdown.rebind();
    }
  });
}
function getbanks()
{ 

  $.ajax({    
    url: url+"api/sales/getbanks",
    data: {},
    type:'POST',    
    datatype:'json',
    success : function(response){
      
      res= JSON.parse(response);        
      
        var opt = "";
        if(res.data.length > 0)
        {
            $.each(res.data, function(index, crop) {
            	var bimg = '';
            	if(crop.bank_name=='SBI')
            	{
            		bimg = '<img src="http://3.7.44.132/aquacredit/assets/images/sib_icn.png" alt="" title="">';
            	}
            	else if(crop.bank_name=='ICICI')
            	{
            		bimg = '<img src="http://3.7.44.132/aquacredit/assets/images/icici_icn.png" alt="" title="">';
            	}
            	else
            	{
            		bimg = '<img src="http://3.7.44.132/aquacredit/assets/images/hdfc_icn.png" alt="" title="">';
            	}
            opt += '<div class="form-check"><input class="form-check-input" type="radio" name="bankid" id="bnk'+index+'" value="'+crop.bank_id+'"><label class="form-check-label" for="bnk'+index+'"><div class="bank_logo">'+bimg+'</div><div class="bank_mny"><div class="bank_bal"> ₹ '+crop.avail_amount+'</div><div class="accont_numb">'+crop.account_no+'</div></div></label></div>';
          });
        }
       
        $("#bank_opt_li").html(opt);
    }
  });
}
function form_validation(err,err_msg,tagid)
{
  $('.mykey').parent().css("border", "");
  /* $(".err_msg").text(err_msg);
      
  $("#danger-alert").fadeTo(2000, 500).slideUp(1000, function(){
    $("#danger-alert").slideUp(1000);
  }); */
  $("#snackbar").text(err_msg);
  $("#snackbar").addClass("show");
  /* var x = document.getElementById("snackbar");
  x.className = "show";
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 5000); */
  setTimeout(function(){ $("#snackbar").removeClass("show"); }, 3000);
  $(tagid).parent().css("border", "1px solid red");
  //$("#tname").css("border", "1px solid red");
  $(tagid).focus();
  return false;
}
function calculateTotal() {
    var qty = 0;
    var totamt = 0;
    var grandTotal = 0;
    $('.cre_inp').addClass('inp_ss');
    var ddisc =0;

    $("[id^='proqty']").each(function() {
        var id = $(this).attr('id');
        id = id.replace("proqty", '');
        var proqty = $("#proqty" + id).val();
        var promrpval = $('#promrpval' + id).val();
        var prodisc = $('#prodisc' + id).val();
       //alert(prodisc);
        $('#promrp' + id).val(promrpval);

        var total = proqty * promrpval;
        
        var ds = prodisc/100;
        var dsc = ds*total;
        var tot1 = total-dsc;

        var ftot = tot1.toFixed(2);
        //$('#protot' + id).val(addCommas(ftot));
        $('#protot' + id).val(ftot);
        $('#prototval' + id).val(ftot);

        grandTotal += tot1;
        ddisc += prodisc; 

    });
    var loadc = $('#load_charge').val();
    var transportc = $('#transport_charge').val();
    
    if(loadc!='' && loadc!=NaN )
    {
      
    }
    else
    {
      loadc = 0;
    }

    if(transportc!='' && transportc!=NaN )
    { 
      
    }
    else
    {
      transportc = 0;
    }
   //alert(ddisc);

    var GrandTot = parseFloat(grandTotal) + parseInt(loadc) + parseInt(transportc);
   // $('#totamt').html(addCommas(grandTotal));
   // $('#gtotamt').html(addCommas(GrandTot));
    $('#totamt').html(grandTotal.toFixed(2));
    $('#gtotamt').html(GrandTot.toFixed(2));
    $('#totdiscount').val(ddisc);
    $('#totamtval').val(grandTotal.toFixed(2));
    $('#gtotamtval').val(GrandTot.toFixed(2));

    var saletype = $("input[name='rtn_types']:checked").val();
    if(saletype=='company')
    {
    	$('#received_amount').val(GrandTot.toFixed(2));
    	$('#disamt').show();
    	$('#textcredit').show();
    	$('#textcredit').html(GrandTot.toFixed(2)+' will be added to user credit');
    	$('#textcash').hide();
    }else
    {
    	$('#textcash').show();
    	$('#disamt').show();
    	$('#textcash').html('Remaining amount will be added to user credit amount');
    	$('#textcredit').hide();
    }
}
$(document).ready(function(){
	
	var rr = 4;
	$('#rowval').val(4);
	var rowNum = $('#rowval').val();

	for(var ii=0;ii<=rr;ii++)
	{
	    rowNum ++;
	    htmlRows = '<tr id="rowNums'+rowNum+'" ><td><input type="hidden" placeholder="Product Name" name="proid[]" id="proid'+rowNum+'" value="0" ><input class="mykey" type="text" placeholder="Product Name" autocomplete="off" name="proname[]" id="proname'+rowNum+'" > </td><td class="qty txt_cnt"> <input type="text" class="mykey" placeholder="0" onkeypress="return onlyNumberKey(event)" name="proqty[]" id="proqty'+rowNum+'"></td><td class="mrp txt_rt"> <input type="text" class="mykey" readonly placeholder="0" name="promrp[]" id="promrp'+rowNum+'"><input type="hidden" placeholder="0" name="promrpval[]" id="promrpval'+rowNum+'"> </td><td class="disc txt_rt"> <input type="text" class="mykey disckey noalpha" placeholder="0" name="prodisc[]" id="prodisc'+rowNum+'"> </td><td class="ttl_prc txt_rt"> <input type="text" placeholder="0" readonly name="protot[]" id="protot'+rowNum+'"><input type="hidden" placeholder="0" name="prototval[]" id="prototval'+rowNum+'" > </td><td class="dele_th_td"><i class="fa fa-trash" onclick="removerow('+rowNum+')" style="color:red" ></i></td></tr>';

	    var saletype = $("input[name='rtn_types']:checked").val();
    	if(saletype=='company')
    	{
	     	$('.disckey').prop('readonly', true);
	    }
	    else{
	    	$('.disckey').prop('readonly', true);
	    } 	
	    
	    $('#invoiceItem').append(htmlRows);
	}
	
	$( "#ukey" ).autocomplete({
    source: function( request, response ) {
      $('#userid').val('');
     
      $('#mobile').val('');
      $("#mobile").prop( "readonly", false );
      var sale_type = $("input[name='rtn_types']:checked").val();
     // Fetch data
     $('.err_msg').hide();
     $.ajax({
    url: url+"api/returns/searchusers",
    type: 'post',
    dataType: "json",
    data: {
     search: request.term,ttype:sale_type
    },
    success: function( data ) { 
    	$('.cre_inp').addClass('inp_ss');
    if(sale_type=='credit')
    {
      if(data == null)
      {
        //$("#ukey").val('');
        $('.err_msg').show();
      }
    } 
      response( $.map( data, function( result ) {  

      return {  
      label: result.label,
      value: result.value,
      imgsrc: result.img,   
      user_id: result.user_id,
      mobile:result.mobile,
      user_type: result.user_type
      }  

      }));  

    }  
     });
    },
    select: function (event, ui) {
    	
     // Set selection
      if(ui.item.user_type == "DEALER"){ $("#cropdis").hide();}else{ $("#cropdis").show(); }

     var sale_type = $("input[name='rtn_types']:checked").val();
     if(sale_type=='cash')
     {
     	$("#cropdis").hide();
     	$('#guestmobile').show();
     }
     else
     {
     	$("#cropdis").show();
     	$('#guestmobile').hide();
     }
     
        $('#mobile').val(ui.item.mobile);
        $("#mobile").prop( "readonly", true );

     $('#ukey').val(ui.item.label); // display the selected text
     $('#userid').val(ui.item.user_id); // save selected id to input
     $('#usertype').val(ui.item.user_type);
     //return false;
    }
    
   }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {  

           return $( "<li></li>" )  

               .data( "item.autocomplete", item )  

               .append( "<a>" + "<img style='width:25px;height:25px' src='" + item.imgsrc + "' /> " + item.label+ "</a>" )  

               .appendTo( ul );  

  };
  
  $('#ukey').blur(function(){
    //var usercode = $(this).val();   
    //var usercode = $("#select_usercode").val().trim();
    var user_id = $("#userid").val().trim();
    if(user_id != "")
    {
      getusercrops(user_id,'add');
     
    }else{
      var opt = '<option value="">-- Select Crop --</option>';
      $("#crop_opt").html(opt); $("#crop_opt").val('');   
       
      //document.getElementById("crop_opt").fstdropdown.rebind();
      //document.getElementById("bank_opt").fstdropdown.rebind();
      
    }     
});


	$('.lnk_typ.frm_farm').click(function(){
		
		$('input[name="rtn_types"][value="farmer"]').prop('checked', true);
        $(this).addClass('act_type');
        $('.blk_disb').removeClass('blk_no_dis');
        $(this).siblings('.cash_trns, .lnk_typ').removeClass('act_type');
        // $('.blk_disb').addClass('blk_no_dis');
        $(this).parent().siblings('.ove_auto').find('.lon_typ').removeClass('hide_blk_anim');
        $('.from_farmer').show();
        $('.to_comp').hide();
    });
     $('.lnk_typ.to_cmp').click(function(){
		 $('input[name="sale_types"][value="company"]').prop('checked', true);
        $(this).addClass('act_type');
        $('.blk_disb').removeClass('blk_no_dis');
        // $('.blk_disb').addClass('blk_no_dis');
        $(this).siblings('.ban_trns, .lnk_typ').removeClass('act_type');
        $(this).parent().siblings('.ove_auto').find('.lon_typ').addClass('hide_blk_anim');
         $('.from_farmer').hide();
         $('.to_comp').show();
    });


     $('.lnk_typ.crdt_trns').click(function(){
        $(this).addClass('act_type');
        $('.blk_disb').removeClass('blk_no_dis');
        $(this).siblings('.cash_trns, .lnk_typ').removeClass('act_type');
        // $('.blk_disb').addClass('blk_no_dis');
        $(this).parent().siblings('.ove_auto').find('.lon_typ').removeClass('hide_blk_anim');
    });
     $('.lnk_typ.cash_trns').click(function(){
        $(this).addClass('act_type');
        $('.blk_disb').removeClass('blk_no_dis');
        // $('.blk_disb').addClass('blk_no_dis');
        $(this).siblings('.ban_trns, .lnk_typ').removeClass('act_type');
        $(this).parent().siblings('.ove_auto').find('.lon_typ').addClass('hide_blk_anim');
    });

      $('.lnk_typ.ban_trns').click(function(){
        $(this).addClass('act_type');
        $('.blk_disb').removeClass('blk_no_dis');
        // $('.blk_disb').addClass('blk_no_dis');
        $(this).siblings('.ban_trns, .lnk_typ').removeClass('act_type');
        $(this).parent().siblings('.ove_auto').find('.lon_typ').addClass('hide_blk_anim');
    });
	
	
	$(document).on('keypress', "[id^=proname]", function() {
		var id = $(this).attr('id');
		id = id.replace("proname", '');
		
		var branch = $("input[name='branchval']:checked").val();
		var proids = $("input[name='proid[]']").map(function(){return $(this).val();}).get();
		//alert(branch);
		if(branch == undefined || branch == '')
		{
			err = 1; err_msg = "Please select branch"; tagid = "#brn_l";
			return form_validation(err,err_msg,tagid);
		}
		else
		{
			$('.mykey').parent().css("border", "");
			$('#proid'+id).val(0);
			$('#promrpval'+id).val(0);
			$('#promrp'+id).val(0);
			$('#proqty'+id).val(0);
			$('#protot'+id).val(0);
			$('#prototval'+id).val(0);

			calculateTotal();

			$( "#proname"+id ).autocomplete({
				source: function( request, response ) {

				 $.ajax({
				url: url+"api/sales/search_products",
				type: 'post',
				dataType: "json",
				data: {
				 search: request.term,branch:branch,proid:proids
				},
				success: function( data ) { 

				if(data == null)
				{
					var err_msg= 'Product not available';
					$("#snackbar").text(err_msg);
					$("#snackbar").addClass("show");
					setTimeout(function(){ $("#snackbar").removeClass("show"); }, 3000);
				}
			
				response( $.map( data, function( result ) {  

				return {  
					  label: result.label,
					  value: result.value,
					  imgsrc: result.img,   
					  pro_id: result.pid,
					  promrp : result.pmrp,
					  packing: result.packing,
					  units : result.units
				}  
			  }));  

			}  
			 });
			},
			select: function (event, ui) {
			 // Set selection

				$('#proname'+id).val(ui.item.label); 
				$('#proid'+id).val(ui.item.pro_id);
				$('#promrpval'+id).val(ui.item.promrp);
				$('#promrp'+id).val(addCommas(ui.item.promrp));
				$('#proqty'+id).val(1);

				
				calculateTotal();
				
			}
			
			}).data( "ui-autocomplete" )._renderItem = function( ul, item ) { 
				
				
				   return $( "<li></li>" )  

					   .data( "item.autocomplete", item )  

					   .append( "<a>" + item.label+ " "+item.units+"/"+item.packing+"</a>" )  

					   .appendTo( ul );  


					 
		   };
		}
		
	});
	$(document).on('blur', "[id^=prodisc]", function() {
    calculateTotal();
}); 
$(document).on('blur', "[id^=proqty]", function() {
    calculateTotal();
}); 
$(document).on('blur', "[id^=load_charge]", function() {
    calculateTotal();
}); 
$(document).on('blur', "[id^=transport_charge]", function() {
    calculateTotal();
});
		
});

function removerow(id)
{
	var rr = $('#rowval').val();
	if(rr!=0)
	{
		rr --;
		$('#rowval').val(rr);
		$('#rowNums'+id).remove();
		calculateTotal();
	}
	else if(rr==0)
	{
		$('#proname'+id).val('');
		$('#proqty'+id).val('');
		$('#promrpval'+id).val('');
		$('#promrp'+id).html('');
		$('#prodisc'+id).val('');
		calculateTotal();
		$('#rowval').val(rr);
		$('#rowNums'+id).remove();

		htmlRows = '<tr id="rowNums0" ><td><input type="hidden" placeholder="Product Name" name="proid[]" id="proid0" value="0"><input class="mykey" type="text" placeholder="Product Name" name="proname[]" id="proname0" autocomplete="off" > </td><td class="qty txt_cnt"> <input type="text" class="mykey" placeholder="0" onkeypress="return onlyNumberKey(event)" name="proqty[]" id="proqty0"></td><td class="mrp txt_rt"> <input type="text" class="mykey" readonly placeholder="0" name="promrp[]" id="promrp0"><input type="hidden" placeholder="0" name="promrpval[]" id="promrpval0"> </td><td class="disc txt_rt"> <input type="text" class="mykey disckey noalpha" placeholder="0" name="prodisc[]" onkeypress="return onlyNumberKey(event)" id="prodisc0"> </td><td class="ttl_prc txt_rt"> <input type="text" placeholder="0" readonly name="protot[]" id="protot0"><input type="hidden" placeholder="0" name="prototval[]" id="prototval0"><input type="hidden" class="form-control noalpha mykey" placeholder="" readonly name="hid_acivity_id[]" id="hid_acivity_id_0" value="0"></td><td class="dele_th_td"> <i class="fa fa-trash" onclick="removerow(0,0)" style="color:red"></i> </td></tr>';
			        
		$('#invoiceItem').append(htmlRows);
		
	}
}
function addmorerows()
{
		var rr = $('#rowval').val();

		var rowNum = rr;
	    rowNum ++;
	    var rrv = rowNum;
	    $('#rowval').val(rrv);
	     	
	    htmlRows = '<tr id="rowNums'+rowNum+'" ><td><input type="hidden" placeholder="Product Name" name="proid[]" id="proid'+rowNum+'" value="0" ><input class="mykey" type="text" placeholder="Product Name" autocomplete="off" name="proname[]" id="proname'+rowNum+'" > </td><td class="qty txt_cnt"> <input type="text" class="mykey" placeholder="0" onkeypress="return onlyNumberKey(event)" name="proqty[]" id="proqty'+rowNum+'"></td><td class="mrp txt_rt"> <input type="text" class="mykey" readonly placeholder="0" name="promrp[]" id="promrp'+rowNum+'"><input type="hidden" placeholder="0" name="promrpval[]" id="promrpval'+rowNum+'"> </td><td class="disc txt_rt"> <input type="text" class="mykey disckey noalpha" placeholder="0" name="prodisc[]" id="prodisc'+rowNum+'"> </td><td class="ttl_prc txt_rt"> <input type="text" placeholder="0" readonly name="protot[]" id="protot'+rowNum+'"><input type="hidden" placeholder="0" name="prototval[]" id="prototval'+rowNum+'" > </td><td class="dele_th_td"><i class="fa fa-trash" onclick="removerow('+rowNum+')" style="color:red" ></i></td></tr>';

	    var saletype = $("input[name='sale_types']:checked").val();
    	if(saletype=='cash')
    	{
	     	$('.disckey').prop('readonly', true);
	    }
	    else{
	    	$('.disckey').prop('readonly', true);
	    } 	
	    
	    $('#invoiceItem').append(htmlRows);
}
</script>
<?php require_once 'footer.php' ; ?>