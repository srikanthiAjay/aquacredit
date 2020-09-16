<?php require_once 'header.php' ; ?>
<link href="<?php echo base_url();?>assets/css/trader_details.css" type="text/css" rel="stylesheet">
<script src='https://kit.fontawesome.com/a076d05399.js'></script> <?php require_once 'sidebar.php' ; ?>
	<div class="modal" id="delete_user">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
					<h1> Are You Sure ! </h1>
					<p> You want Delete Trader XXXXXX ? </p>
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
            <span class="back_btn"> <!-- <a href="<?php echo base_url();?>admin/traders" title=""><img src="<?php echo base_url();?>assets/images/back.png" alt="" title=""> </a> --></span> <span> Trader Detail</span>
<a class="btn ed_usr btn-primary fr" href="<?php echo base_url();?>admin/traders/trader_print" target="_blank" title=""> Print </a>
          <!--   <a href="<?php echo base_url();?>admin/traders/create" title="" class="btn ed_usr btn-primary fr"> Edit Trader </a> -->
           </div>
<div class="pad_10">
           <div class="">
      <div class="card_view dis_tbl">
         <ul class="trd_anl"> 
          <li class="bor_lf_none"> 
            <div class="top_in_op crop_top">
                                      <p> Total Amount </p> 
                                    <h1> ₹10,00,00 </h1>
                                    </div>
          </li>
          <li class=""> 
            <div class="top_in_op crop_top">
                                      <p> Received </p> 
                                    <h1> ₹5,00,00 </h1>
                                    </div>
          </li>
          <li class=""> 
            <div class="top_in_op crop_top">
                                      <p> Pending </p> 
                                    <h1> ₹5,00,00 </h1>
                                    </div>
          </li>

         </ul>
         
        
         </div>
      </div>


</div>
        

                    <div class="pad_l_r_10">
                  <div class="card_view urs_dt"> 
                  <div class=""> 
                                    <div class="res_tbl">
                    
<div class="dropdowns">
     <button class="btn btn-secondary drp_btn" type="button">
    <i class="fa fa-th-list" aria-hidden="true"></i>
     </button>
 <ul class="sl_menu">
<!--    <li><a class="toggle-vis" data-column="0">Id</a> </li> -->  <!--
<li>
     <a class="toggle-vis" data-column="0">Date</a> </li> -->
  
      <li><a class="toggle-vis" data-column="1">Type</a> </li>
    
    <!-- <li><a class="toggle-vis" data-column="2">Detail</a> </li> -->
     <!-- <li><a class="toggle-vis" data-column="3">In</a> </li> -->
     <!-- <li><a class="toggle-vis" data-column="4">Out</a> </li> -->
<!--       <li> <a class="toggle-vis" data-column="4">Actions</a> </li> -->
       
 </ul>
</div>
                  
                 
  <table id="usr_lst_tbl" cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped table-hover" style="width:100%">

            <thead>
                       
            <tr>
              <th width="130" class="dte">  Date 
                <span class="sts_pp">
           <i class="fa fa-filter" aria-hidden="true" style="font-size: 9px;"></i>   
                 </span>
                 <div class="sts_fil_blk"> 
    <div class="form-check">
  <input class="form-check-input" type="radio" name="optradio" value="" id="this_mnt">
  <label class="form-check-label" for="this_mnt">
    This Month
  </label>
</div>
 <div class="form-check">
  <input class="form-check-input" type="radio" name="optradio" value="" id="last_3mont">
  <label class="form-check-label" for="last_3mont">
    Last 3 Months
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="optradio" value="" id="last_6mon">
  <label class="form-check-label" for="last_6mon">
    Last 6 Months
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="optradio" value="" id="one_year">
  <label class="form-check-label" for="one_year">
    1 Year
  </label>
</div>

<div class="form-check">
  <input class="form-check-input" type="radio" name="optradio" value="" id="choos_date">
  <label class="form-check-label" for="choos_date">
    Choose Date
  </label>
</div>
                    </div>

              </th>
              <th width="80"> Type 
                <span class="sts_pp">
           <i class="fa fa-filter" aria-hidden="true" style="font-size: 9px;"></i>   
                  </span>

                  <div class="sts_fil_blk">         
<div class="trd_lst">
    <div class="form-check chek_bx">
      <input class="form-check-input" type="checkbox" name="optradio" value="" id="sta1">
  <label class="form-check-label" for="sta1">
    Fish
  </label>
</div>
 <div class="form-check chek_bx">
  <input class="form-check-input" type="checkbox" name="optradio" value="" id="sta2">
  <label class="form-check-label" for="sta2">
    Prawn
  </label>
</div>

</div>
       </div>

              </th>
              <th> Detail </th>
              <th width="150" class="txt_rt"> In </th>
              <th width="150" class="txt_rt"> Out </th>
            </tr>
          </thead>

          <tbody>
            <tr> 
                <td> 01-Jan-2020 </td>
                <td> Fish </td>
                <td> <a href="#" title=""> Trade - TR123456 </a> </td>
                <td class="txt_rt"> </td>
                <td class="txt_red txt_rt"> -100 </td>
            </tr>
            <tr> 
              <td> 01-Jan-2020 </td>
              <td> Prawn </td>
                <td> <a href="#" title=""> Trade - TR123456 </a> </td>
                <td class="txt_rt"> </td>
                <td class="txt_red txt_rt"> -50 </td>
            </tr>
            <tr> 
                <td> 01-Jan-2020 </td>
                <td> Prawn </td>
                <td> <a href="#" title=""> Trade - TR123456 </a> </td>
                <td class="grn_clr txt_rt"> +200 </td>
                <td class="txt_red txt_rt"> </td>
            </tr>
            <tr> 
                <td> 01-Jan-2020 </td>
                <td> Fish </td>
                <td> <a href="#" title=""> Trade - LN123456 </a> </td>
                <td class="txt_rt"> </td>
                <td class="txt_red txt_rt"> -20 </td>
            </tr>

  
    
            <tr> 
                <td class="opic_non"> s  </td>
                <td> </td>
                <td class="txt_rt"> <b>Total</b> </td>
                <td class="grn_clr txt_rt"> +200 </td>
                <td class="txt_red txt_rt"> -170 </td>
            </tr>
            <tr> 
                <td class="opic_non"> s </td>
                 <td> </td>
                <td class="txt_rt"> <b>Current Balance</b> </td>              
                <td class="grn_clr txt_rt"> <b>+30</b> </td>
                <td > </td>
            </tr>
             <tr> 
                <td class="opic_non"> s </td>
                 <td> </td>
                <td class="txt_rt"> <b>Previous Balance <span class="grn_clr"></span></b> </td>
                <td class="grn_clr txt_rt"> <b>+100</b> </td>
                <td>  </td>
            </tr>

 <tr> 
                <td class="opic_non"> s </td>
                 <td> </td>
                <td class="txt_rt"> <b>Grand Total <span class="grn_clr"></span></b> </td>
                <td class="grn_clr txt_rt"> <b>+130</b> </td>
                <td>  </td>
            </tr>
     
          </tbody>

                      </table>
                    </div>

                  </div>
               </div>
</div>
</div>
<script type="text/javascript">
var url = '<?php echo base_url()?>';
        
$(document).ready(function(){
	// $('#fil2').multiselect();
	// $('#fil1').multiselect();
	// $('#fil3').multiselect();

var table = $('#usr_lst_tbl').DataTable({
      "ordering": false,
       language: {
        searchPlaceholder: "Search Trade Details",
        search: "",
        "dom": '<"toolbar">frtip'
      }
});

    $('.dataTables_length').html('<h2 class="create_hdg lng_hdg"> Trader Name - #AU000001 </h2>');
    $("div.toolbar").html('<b>SSS</b>');
    $('a.toggle-vis').on( 'click', function (e) {
        $(this).parent().toggleClass('act');
        e.preventDefault();
        var column = table.column( $(this).attr('data-column') );
        column.visible( ! column.visible() );
    } );
   });
</script>
<?php require_once 'footer.php' ; ?>