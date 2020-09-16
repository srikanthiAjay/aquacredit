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
	<form id="return_frm" name="return_frm" action="javascript:void(0);" method="post">
	<div class="sale_rt"> 
		<h2 class="create_hdg"> Recent Returns </span></h2>
		
		<ul class="nav nav-tabs" id="myTab" role="tablist">
			<li class="nav-item">
				<a class="nav-link active" id="home-tab" data-toggle="tab" href="#f_far" role="tab" aria-controls="home" aria-selected="true" onclick="recentProducts('f');">From Farmer</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="profile-tab" data-toggle="tab" href="#t_com" role="tab" aria-controls="profile"	aria-selected="false" onclick="recentProducts('c');">To Company</a>
			</li>
		</ul>
		<div class="tab-content">
			
			<div id="f_far" class="tab-pane fade show active"></div>
			<div id="t_com" class="tab-pane fade"></div>
		</div>
	</div>
	
	<div class="sle_cr_r"> 		
		<!-- <h2 class="create_hdg"> Loan Request </h2> -->
		<ul class="assign_type"> 
			<li class="act_type lnk_typ frm_farm mykey"> 
				<img src="http://3.7.44.132/aquacredit/assets/images/credit_icn.png">
				<input type="radio" name="rtn_types" value="farmer" checked class="mykey" />
				<span> From Farmers </span>
			</li>
			<li class="lnk_typ to_cmp mykey"> 
				<img src="http://3.7.44.132/aquacredit/assets/images/cash_icn.png">
				<input type="radio" name="rtn_types" value="company" class="mykey" />
				<span> To Company </span>
			</li>
		</ul>
		<div class="from_farmer">
			<ul class="create_ul">
				<li class="create_li slc_usr">
					<div class="check_wt_serc "> 
						<div class="show_va ">Select  Branch</div>
						<div class="selectVal bname ">  Select  Branch </div>
						<!--<ul class="check_list mykey" id="brn_l"> 
							<li id="branch_opt_li"></li>
						</ul> -->										
					</div>
				</li>
				<li class="create_li">
					<div class="cre_inp">
						<div class="sm_blk"> Search User </div>
						<input type="text" class="form-control mykey" placeholder="" data-original-title="" title="" name="ukey" id="ukey" readonly />
						<input type="hidden" class="form-control" placeholder=""  name="userid" id="userid">
						<input type="hidden" class="form-control" placeholder=""  name="usertype" id="usertype">
						<input type="hidden" class="form-control" id="select_guest" name="select_guest" value="0">
					</div>
				</li>

				<li class="create_li slc_usr" id="cropids">
					<div class="check_wt_serc"> 
						<div class="show_va">Select  Crop</div>
						<div class="selectVal cval">  Select  Crop </div>
						<!-- <ul class="check_list mykey" id="crp_l"> 
							<li id="crop_opt_li"></li>													
						</ul> -->											
					</div>
				</li>
				
				<li class="create_li " style="display: none;" id="guestmobile">
					 	<div class="cre_inp">
					  		<div class="sm_blk"> Mobile </div>
					    	<input type="text" onkeypress="return onlyNumberKey(event)" maxlength="10" class="form-control mykey" placeholder="" data-original-title="" title="" name="mobile" id="mobile">
						</div>
					</li>
			</ul>
			
			<div class="res_tbl">
				<table class="sa_lst" id="rtn_table" cellpadding="0" cellspacing="" border="0">
				<thead>
					<tr> 
						<th> Product Name </th>
						<th class="qty txt_cnt"> Qty </th>
						<th class="mrp txt_rt"> MRP </th>
						<th class="disc"> Discount </th>
						<th class="ttl_prc txt_rt"> Total Price </th>
					</tr>
				</thead>
				<tbody id="invoiceItem">
					
				</tbody>
				<tfoot>
					<tr>
						<td colspan="4" class="txt_rt"> <b>Grand Total</b> </td>
						<td class="txt_rt"> <b id="gtotamt"> 0 </b> 
						<input type="hidden" placeholder="0" name="gtotamtval" id="gtotamtval" > </td>
					</tr>
				</tfoot>
			</table>
			<input type="hidden" id="rowval" value="0">
		</div>
		<h2 class="create_hdg" style="margin-bottom: 15px; "> <span class="stl_amt">₹0</span> will be added to user credit! </h2>		

	<div class="show_note">
		<div class="note_add"> <a href="#" title=""> Note </a> </div> 
		<textarea id="rece_note" name="rece_note" placeholder="Note" class="mykey" readonly ></textarea>
	</div>		

	</div>


		

	</div>
	</form>
</div>
<script type="text/javascript">
var url = '<?php echo base_url();?>';
getreturns(); recentProducts('f');

function getreturns()
{
	var rid = <?php echo $rid; ?>;
	$.ajax({		
			url: url+"api/returns/getreturndetails/"+rid,
			data: {},
			type:'POST',		
			datatype:'json',
			success : function(response){
				
				res= JSON.parse(response);	
				//console.log(res);
				$('.cre_inp').addClass('inp_ss');
				
				
				$("#ukey").val(res.data.user_name);	
				$("#userid").val(res.data.user_id);					
				$("#usertype").val(res.data.user_type);					
				$("#select_guest").val(res.data.typeofuser);					
				$("#mobile").val(res.data.mobile);					
				$("#note").val(res.data.note);
				$(".bname").html(res.data.branch_name);
				$(".cval").html(res.data.crop_location);				
				
				$("#gtotamt").html(res.data.return_amount);
				$("#gtotamtval").val(res.data.return_amount);
				$(".stl_amt").html('₹'+addCommas(res.data.return_amount));
				
				// Return Products
				$.ajax({
		            	url: url+"api/returns/getreturnactualdetails/"+rid,
			            data: {},
			            type:'POST',    
			            datatype:'json',
			            success : function(response1){

			              res1 = JSON.parse(response1);
			              console.log(res1);
			              htmlRows = "";
			              $('#rowval').val(res1.data.length);
			              if(res1.data.length>0)
			              {
			                $('#rcntval').val(res1.data.length);
			                $.each(res1.data, function(index, returns) {
			                	
			                  var tcamtt = returns.prod_mrp;
			                  //var tfamtt = addCommas(returns.total_price);
			                  var tfamtt = returns.total_price;


			                  htmlRows = '<tr id="rowNums'+returns.index+'"><td> <input type="hidden" class="mykey" placeholder="Product Name" name="proid[]" id="proid'+returns.id+'" value="'+returns.product_id+'" ><input type="text" class="mykey" placeholder="Product Name" autocomplete="off"  name="proname[]" id="proname'+returns.index+'" value="'+returns.pname+'" readonly ></td><td class="qty txt_cnt"> <input type="text" class="mykey" placeholder="0" onkeypress="return onlyNumberKey(event)" name="proqty[]" id="proqty'+returns.index+'" value="'+returns.return_qty+'" readonly> </td><td class="mrp txt_rt"> <input type="text" class="mykey" placeholder="0" name="promrp[]" id="promrp'+returns.index+'" readonly value="'+tcamtt+'"><input type="hidden" class="mykey" placeholder="0" name="promrpval[]" id="promrpval'+returns.index+'" value="'+returns.prod_mrp+'"> </td><td class="disc txt_rt"> <input type="text" class="mykey disckey" onkeypress="return onlyNumberKey(event)" placeholder="0" name="prodisc[]" id="prodisc'+returns.index+'" value="'+returns.discount+'"> </td><td class="ttl_prc txt_rt"> <input type="text" class="mykey" placeholder="0" name="protot[]" id="protot'+returns.index+'" readonly value="'+tfamtt+'"><input type="hidden" placeholder="0" name="prototval[]" id="prototval'+returns.index+'" value="'+returns.total_price+'"><input type="hidden" class="form-control noalpha mykey" placeholder="" readonly name="hid_acivity_id[]" id="hid_acivity_id_'+returns.index+'" value="'+returns.rtn_pro_id+'"></td></tr>';

			                  $('#invoiceItem').append(htmlRows);

			                });		                

			              }		             
			              
			            }
		            });
			}
	});
}


function recentProducts(val)
{
	$.ajax({    
    url: url+"api/returns/getRecentProducts",
    data: {rtn_type:val},
    type:'POST',    
    datatype:'json',
    success : function(response){      
	  
      res= JSON.parse(response);        
      
        var opt = "";
        if(res.data.length > 0)
        {
            $.each(res.data, function(index, prod) {
            opt += '<div class="top_in_op crop_top">\
					<h1> '+prod.pname+' <span> ('+prod.return_qty+') </span> </h1>\
					<p> '+prod.return_date+' </p>\
				</div>';
          });
        }else{
			opt = "<span style='color:red;'>No Records found!</span>";
		}
       if(val == 'f'){
			$("#f_far").html(opt);
			$("#t_com").html('');
	   }
	   else if(val == 'c'){
		   $("#f_far").html('');
		   $("#t_com").html(opt);
	   }
    }
  });
}

function hidecolor()
{
	$('.mykey').parent().css("border", "");
}
function onlyNumberKey(evt) { 
          
        // Only ASCII charactar in that range allowed 
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode 
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) 
            return false; 
        return true; 
}
</script>
<?php require_once 'footer.php' ; ?>