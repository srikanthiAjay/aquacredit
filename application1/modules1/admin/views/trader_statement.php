<?php require_once 'header.php' ; ?>
<link href="<?php echo base_url();?>assets/css/user_detials.css" type="text/css" rel="stylesheet">
<script src='https://kit.fontawesome.com/a076d05399.js'></script> 
<?php require_once 'sidebar.php' ; ?>   
<div class="right_blk">
          <div class="top_ttl_blk"> 
           <!--  <span class="back_btn"> <a href="<?php echo base_url();?>admin/users" title=""><img src="<?php echo base_url();?>assets/images/back.png" alt="" title=""> </a></span> --> <span> Prudhvi Sea Foods Statement </span>

         <!--    <a href="<?php echo base_url();?>admin/users/create" title="" class="btn ed_usr btn-primary fr"> Edit User </a> -->
         
            <a href="<?php echo base_url();?>admin/users/crop_print" target="_blank" title="" class="btn ed_usr btn-primary fr"> Print </a>

            

           </div>

<div class="sale_rt">

<div class="det_view">
<input type="checkbox"> 
<p> Detailed View</p>

<div class="swith_blk"> 
  <!-- <span> No </span> -->
</div>
</div>
  <div class="dvder"> </div>
 
   <div class="main_anal">
        <h2 class="create_hdg"> Analytics  </h2>
      <ul class="anl_tcs">
                      <li class="bor_lf_none"> 
            <div class="top_in_op crop_top">
                               <p>Total Tons</p> 
                               <h1> 200 </h1>
                                    </div>
        </li>
        <li class="bor_lf_none"> 
            <div class="top_in_op crop_top">
                               <p>Highly Sold Counts</p> 
                               <h1> 24<small>c</small> <span></span> 30<small>c</small> <span></span> 40<small>c</small> </h1>
                                    </div>
        </li>
        <li class="bor_lf_none"> 
            <div class="top_in_op crop_top">
                               <p> Trade Profit </p> 
                               <h1> ₹2,00,00 </h1>
                                    </div>
        </li>
    
    
        
                     </ul>     
                   </div>
                   
</div>
  <div class="sle_cr_r"> 
                     
                  <div class="urs_dt"> 
                  <div class=""> 
                        <div class="res_tbl">
                     <table id="usr_lst_tbl" class="table table-striped table-bordered" style="width:100%">

            <thead>
                       
            <tr>
              <th class="date">  Date 
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
              <th class="details"> Detail 

                <span class="sts_pp">
           <i class="fa fa-filter" aria-hidden="true" style="font-size: 9px;"></i>   
                 </span>
                  <div class="sts_fil_blk rad_btns"> 
 <label class="form-check-label radio_blk checkd" for="ln">
  <input class="form-check-input" type="radio" name="optradio" value="" id="ln">
  
    Loan
  </label>

  <label class="form-check-label radio_blk" for="gds">
  <input class="form-check-input" type="radio" name="optradio" value="" id="gds">

   Goods
  </label>

  <label class="form-check-label radio_blk" for="crp_op">
  <input class="form-check-input" type="radio" name="optradio" value="" id="crp_op">

    Crop Outputs
  </label>

 <label class="form-check-label radio_blk" for="expn">
  <input class="form-check-input" type="radio" name="optradio" value="" id="expn">
 
   Expences
  </label>


  <label class="form-check-label radio_blk" for="urp">
  <input class="form-check-input" type="radio" name="optradio" value="" id="urp">

    User repayment
  </label>

                    </div>
              </th>
              <!-- <th width="150" class="txt_rt in_td"> In </th> -->
              <th width="150" class="txt_rt out_td"> Amount </th>
            </tr>
          </thead>

          <tbody>
            <tr> 
                <td class="date"> 01-Jan-2020 </td>
                <td> <a href="#" title=""> Vannamei Sale  - VS123456 </a> </td>
                <!-- <td class="txt_rt in_td"> </td> -->
                <td class="txt_red txt_rt out_td"> -10,000 
                  <div class="arr_blk"> <img src="http://3.7.44.132/aquacredit/assets/images/rd_c_ar.png"> </div> 
                </td>
            </tr>
             <tr> 
              <td class="date"> 05-Jan-2020 </td>
                <td> <a href="#" title=""> Received Amount - HRA123456 </a> </td>
                <!-- <td class="txt_rt in_td"> </td> -->
                <td class="grn_clr txt_rt out_td"> +9,000 <div class="arr_blk"> <img src="http://3.7.44.132/aquacredit/assets/images/grn_c_ar.png"> </div>  </td>
            </tr>
            <tr class="detal_row">
              <td class="date"> &nbsp; </td>
              <td colspan="2"> 
                  <table>
                    <tr> 
                      <th> Date </th>
                      <th> Count </th>
                      <th> Price </th>
                      <th> Weight(Kgs) </th>
                      <th> Amount </th>
                    </tr>
                    <tr> 
                     <td> 06-Apr-2020 </td>
                      <td> 10 </td>
                      <td> 100 </td>
                      <td> 100 </td>
                      <td> 10,000 </td>
                    </tr>
                     <tr> 
                     <td> 06-Apr-2020 </td>
                      <td> 10 </td>
                      <td> 100 </td>
                      <td> 100 </td>
                      <td> 10,000 </td>
                    </tr>
                  </table>
              </td>
              <td class="hide_blk"> </td>
              <td class="hide_blk"> </td>
              <td class="hide_blk"> </td>
            </tr>
           
           
            <tr> 
                <td class="date"> 01-Jan-2020 </td>
                <td> <a href="#" title=""> Vannamei Sale  - VS123456 </a> </td>
                <!-- <td class="txt_rt in_td"> </td> -->
                <td class="txt_red txt_rt out_td"> -10,000 
                  <div class="arr_blk"> <img src="http://3.7.44.132/aquacredit/assets/images/rd_c_ar.png"> </div> 
                </td>
            </tr>
            <tr> 
                <td class="date"> 01-Jan-2020 </td>
                <td> <a href="#" title=""> Vannamei Sale  - VS123456 </a> </td>
                <!-- <td class="txt_rt in_td"> </td> -->
                <td class="txt_red txt_rt out_td"> -10,000 
                  <div class="arr_blk"> <img src="http://3.7.44.132/aquacredit/assets/images/rd_c_ar.png"> </div> 
                </td>
            </tr>
            <tr> 
                <td class="date"> 01-Jan-2020 </td>
                <td> <a href="#" title=""> Vannamei Sale  - VS123456 </a> </td>
                <!-- <td class="txt_rt in_td"> </td> -->
                <td class="txt_red txt_rt out_td"> -10,000 
                  <div class="arr_blk"> <img src="http://3.7.44.132/aquacredit/assets/images/rd_c_ar.png"> </div> 
                </td>
            </tr>
            <tr> 
                <td class="date"> 01-Jan-2020 </td>
                <td> <a href="#" title=""> Vannamei Sale  - VS123456 </a> </td>
                <!-- <td class="txt_rt in_td"> </td> -->
                <td class="txt_red txt_rt out_td"> -10,000 
                  <div class="arr_blk"> <img src="http://3.7.44.132/aquacredit/assets/images/rd_c_ar.png"> </div> 
                </td>
            </tr>
            <tr> 
                <td class="date"> 01-Jan-2020 </td>
                <td> <a href="#" title=""> Vannamei Sale  - VS123456 </a> </td>
                <!-- <td class="txt_rt in_td"> </td> -->
                <td class="txt_red txt_rt out_td"> -10,000 
                  <div class="arr_blk"> <img src="http://3.7.44.132/aquacredit/assets/images/rd_c_ar.png"> </div> 
                </td>
            </tr>
           <tr> 
                <td class="date"> 01-Jan-2020 </td>
                <td> <a href="#" title=""> Vannamei Sale  - VS123456 </a> </td>
                <!-- <td class="txt_rt in_td"> </td> -->
                <td class="txt_red txt_rt out_td"> -10,000 
                  <div class="arr_blk"> <img src="http://3.7.44.132/aquacredit/assets/images/rd_c_ar.png"> </div> 
                </td>
            </tr>

   <tr> 
                <td class="date"> 01-Jan-2020 </td>
                <td> <a href="#" title=""> Vannamei Sale  - VS123456 </a> </td>
                <!-- <td class="txt_rt in_td"> </td> -->
                <td class="txt_red txt_rt out_td"> -10,000 
                  <div class="arr_blk"> <img src="http://3.7.44.132/aquacredit/assets/images/rd_c_ar.png"> </div> 
                </td>
            </tr>
            <tr> 
                <td class="date"> 01-Jan-2020 </td>
                <td> <a href="#" title=""> Vannamei Sale  - VS123456 </a> </td>
                <!-- <td class="txt_rt in_td"> </td> -->
                <td class="txt_red txt_rt out_td"> -10,000 
                  <div class="arr_blk"> <img src="http://3.7.44.132/aquacredit/assets/images/rd_c_ar.png"> </div> 
                </td>
            </tr>
           <tr> 
                <td class="date"> 01-Jan-2020 </td>
                <td> <a href="#" title=""> Vannamei Sale  - VS123456 </a> </td>
                <!-- <td class="txt_rt in_td"> </td> -->
                <td class="txt_red txt_rt out_td"> -10,000 
                  <div class="arr_blk"> <img src="http://3.7.44.132/aquacredit/assets/images/rd_c_ar.png"> </div> 
                </td>
            </tr>
            <tr> 
                <td class="date"> 01-Jan-2020 </td>
                <td> <a href="#" title=""> Vannamei Sale  - VS123456 </a> </td>
                <!-- <td class="txt_rt in_td"> </td> -->
                <td class="txt_red txt_rt out_td"> -10,000 
                  <div class="arr_blk"> <img src="http://3.7.44.132/aquacredit/assets/images/rd_c_ar.png"> </div> 
                </td>
            </tr>
           <tr> 
                <td class="date"> 01-Jan-2020 </td>
                <td> <a href="#" title=""> Vannamei Sale  - VS123456 </a> </td>
                <!-- <td class="txt_rt in_td"> </td> -->
                <td class="txt_red txt_rt out_td"> -10,000 
                  <div class="arr_blk"> <img src="http://3.7.44.132/aquacredit/assets/images/rd_c_ar.png"> </div> 
                </td>
            </tr>
           <tr> 
                <td class="date"> 01-Jan-2020 </td>
                <td> <a href="#" title=""> Vannamei Sale  - VS123456 </a> </td>
                <!-- <td class="txt_rt in_td"> </td> -->
                <td class="txt_red txt_rt out_td"> -10,000 
                  <div class="arr_blk"> <img src="http://3.7.44.132/aquacredit/assets/images/rd_c_ar.png"> </div> 
                </td>
            </tr>
            <tr> 
                <td class="date"> 01-Jan-2020 </td>
                <td> <a href="#" title=""> Vannamei Sale  - VS123456 </a> </td>
                <!-- <td class="txt_rt in_td"> </td> -->
                <td class="txt_red txt_rt out_td"> -10,000 
                  <div class="arr_blk"> <img src="http://3.7.44.132/aquacredit/assets/images/rd_c_ar.png"> </div> 
                </td>
            </tr>
            <tr> 
                <td class="date"> 01-Jan-2020 </td>
                <td> <a href="#" title=""> Vannamei Sale  - VS123456 </a> </td>
                <!-- <td class="txt_rt in_td"> </td> -->
                <td class="txt_red txt_rt out_td"> -10,000 
                  <div class="arr_blk"> <img src="http://3.7.44.132/aquacredit/assets/images/rd_c_ar.png"> </div> 
                </td>
            </tr>
            <tr> 
                <td class="date"> 01-Jan-2020 </td>
                <td> <a href="#" title=""> Vannamei Sale  - VS123456 </a> </td>
                <!-- <td class="txt_rt in_td"> </td> -->
                <td class="txt_red txt_rt out_td"> -10,000 
                  <div class="arr_blk"> <img src="http://3.7.44.132/aquacredit/assets/images/rd_c_ar.png"> </div> 
                </td>
            </tr>
            <tr> 
                <td class="date"> 01-Jan-2020 </td>
                <td> <a href="#" title=""> Vannamei Sale  - VS123456 </a> </td>
                <!-- <td class="txt_rt in_td"> </td> -->
                <td class="txt_red txt_rt out_td"> -10,000 
                  <div class="arr_blk"> <img src="http://3.7.44.132/aquacredit/assets/images/rd_c_ar.png"> </div> 
                </td>
            </tr>
            <tr> 
                <td class="date"> 01-Jan-2020 </td>
                <td> <a href="#" title=""> Vannamei Sale  - VS123456 </a> </td>
                <!-- <td class="txt_rt in_td"> </td> -->
                <td class="txt_red txt_rt out_td"> -10,000 
                  <div class="arr_blk"> <img src="http://3.7.44.132/aquacredit/assets/images/rd_c_ar.png"> </div> 
                </td>
            </tr>
            <tr> 
                <td class="date"> 01-Jan-2020 </td>
                <td> <a href="#" title=""> Vannamei Sale  - VS123456 </a> </td>
                <!-- <td class="txt_rt in_td"> </td> -->
                <td class="txt_red txt_rt out_td"> -10,000 
                  <div class="arr_blk"> <img src="http://3.7.44.132/aquacredit/assets/images/rd_c_ar.png"> </div> 
                </td>
            </tr>
           <tr> 
                <td class="date"> 01-Jan-2020 </td>
                <td> <a href="#" title=""> Vannamei Sale  - VS123456 </a> </td>
                <!-- <td class="txt_rt in_td"> </td> -->
                <td class="txt_red txt_rt out_td"> -10,000 
                  <div class="arr_blk"> <img src="http://3.7.44.132/aquacredit/assets/images/rd_c_ar.png"> </div> 
                </td>
            </tr>
    
           

 
     
          </tbody>
           <tfoot>
             <tr> 
                <td class="opic_non date"> &nbsp;   </td>
                <td class="txt_rt"> Total </td>
                <td class="txt_rt in_td"> +4,00000 </td>

            </tr>
            <tr> 
                <td class="opic_non date"> &nbsp;  </td>
                <td class="txt_rt type"> Opening Balance</td>              
                <td class="txt_rt"> +30 </td>
            </tr>
             <!-- <tr> 
                <td class="opic_non date"> &nbsp;  </td>
                <td class="txt_rt type"> <b>Previous Balance <span class="grn_clr"></span></b> </td>
                <td class="grn_clr txt_rt"> <b>+100</b> </td>
            </tr>-->
            <tr> 
                <td class="opic_non date"> &nbsp;  </td>
                <td class="txt_rt grd_ttl"> <b>Grand Total <span class="grn_clr"></span></b> </td>
                <td class="grd_ttl txt_rt"> <b>+130</b> </td>
            </tr> 
           </tfoot>

                      </table>
                    </div>

                  </div>
               </div>
<!-- <div class="btm_btn"> <button class="btn btn-primary"> Settle Amount </button> </div> -->
  </div>
</div>
<script type="text/javascript">
 
var url = '<?php echo base_url()?>';
$(document).ready(function() {

  $('.swith_blk').click(function(){
    //   if($(this).find('span').text() == 'Yes'){
    //   $(this).find('span').text('No');
    // }else {
    //   $(this).find('span').text('Yes')
    // }
    $(this).toggleClass('tog_yes');
  });

   var h = $(window).height();
  var min_h = h-280;
    var tables = $('#usr_lst_tbl').DataTable({
      "ordering": false,
       language: {
        searchPlaceholder: "Search Transaction Details",
        search: "",
        "dom": '<"toolbar">frtip'
      },
      "scrollY":  min_h,
        "scrollCollapse": true,
});
$('.dataTables_scrollBody').css('height', min_h);
    $('#usr_lst_tbl_wrapper .dataTables_length').html('<h2 class="create_hdg lng_hdg"> </h2>');
    // $('#usr_lst_tbl_wrapper .dataTables_length').html('<ul class="tabs_tbl"><li class="act_tab drft_cl"> <span>Unsettled</span> </li><li class="comp_cl"> <span>Settled </span> </li></ul> <span class="tbl_btn">  </span>');
// <a href="#" class="appr_all"> Approve All </a>
   $(".loan_btm div.toolbar").html('<b>SSS</b>');
    $('.loan_btm a.toggle-vis').on( 'click', function (e) {
        $(this).parent().toggleClass('act');
        e.preventDefault();
        var column = tables.column( $(this).attr('data-column') );
        column.visible( ! column.visible() );
    });

    $('.dataTables_paginate').html('<a href="#" title=""> Show More </a>');
    $('.ad_nt').click(function(){
    $('.pp_note').toggleClass('show_blk');
});  

$('.comp_cl').click(function(){
      $(this).addClass('act_tab');
    $('.tabs_tbl').addClass('cmp_ul');
        $('.drft_cl').removeClass('act_tab');
  });

   $('.drft_cl').click(function(){
    $(this).addClass('act_tab');
     $('.tabs_tbl').removeClass('cmp_ul');
     $('.comp_cl').removeClass('act_tab');
   });
    $('#fil2').multiselect();
    $('#fil1').multiselect();
    $('#fil3').multiselect();

  $('.loans_tp').click(function(){
      $('.alpha_blk').show();
      $('.side_popup').addClass('opn_slide');
      $('#loans_tp').show();
      $('#orders_tp').hide();
      $('#crop_top').hide();

    });

    $('.orders_tp').click(function(){
      $('.alpha_blk').show();
      $('.side_popup').addClass('opn_slide');
       $('#loans_tp').hide();
      $('#orders_tp').show();
      $('#crop_top').hide();

    });


 $('.crop_top').click(function(){
      $('.alpha_blk').show();
      $('.side_popup').addClass('opn_slide');
      $('#loans_tp').hide();
      $('#orders_tp').hide();
      $('#crop_top').show();

    });

    $('.alpha_blk').click(function(){
        $('.side_popup').removeClass('opn_slide');
        $(this).hide();
    });

} );
</script>

<?php require_once 'footer.php' ; ?>