<?php require_once 'header.php' ; ?>
<link href="<?php echo base_url();?>assets/css/purchases.css" type="text/css" rel="stylesheet">
<script src='https://kit.fontawesome.com/a076d05399.js'></script> 
<style type="text/css">
    .ui-autocomplete{
        z-index: 9999;
    }
    .content{position: relative;}
.overlay{position: absolute;left: 0; top: 0; right: 0; bottom: 0;z-index: 2;background-color: rgba(255,255,255,0.8);}
.overlay-content {
    position: absolute;
    transform: translateY(-50%);
     -webkit-transform: translateY(-50%);
     -ms-transform: translateY(-50%);
    top: 50%;
    left: 0;
    right: 0;
    text-align: center;
    color: #555;
}
#delete_req .modal-content{
    padding:0px;
    min-height:0px;
}
#delete_req .modal-body {
    text-align: center;
}

#delete_req .modal-content h1 {
    font-size: 16px;
    color: #000;
    font-weight: normal;
    margin-bottom: 15px;
}

#delete_req .modal-body p {
    margin: 0px!important;
}
</style>
<?php require_once 'sidebar.php' ; ?>		
<div class="right_blk">
    <div class="top_ttl_blk">
        <span class="back_btn"> </span> <span> Purchases List </span>
        <!--<a href="#" title="" class="fr btn btn-primary"> Purchase Request </a> -->
    </div>
    <div class="padding_10">
        <div class="trd_cr_r">
            <div class="card_view">
                <ul class="trd_anl">
                    <li class="bor_lf_none">
                        <div class="top_in_op crop_top">
                            <p>Total Purchases</p>
                            <h1 id="total_purchase">0</h1>
                        </div>
                    </li>
                    <li>
                        <div class="top_in_op crop_top">
                            <p>Pendings</p>
                            <h1 id="pending">0</h1>
                        </div>
                    </li>
                    <li>
                        <div class="top_in_op crop_top">
                            <p>Paid</p>
                            <h1 id="paid">0</h1>
                        </div>
                    </li>
                    <li>
                        <div class="top_in_op crop_top">
                            <p>Approved</p>
                            <h1 id="approved">0</h1>
                        </div>
                    </li>
                    <li>
                        <div class="top_in_op crop_top">
                            <p>Completed</p>
                            <h1 id="completed">0</h1>
                        </div>
                    </li>
                    <li class="fr"><button class="btn purc_btn btn-primary" onclick="Purchase.requestPopup();">Purchase Request</button></li>
                </ul>
            </div>

            <div class="list_blk">
                <div class="overlay" id="overlay_list_id" style="display: none;"><div class="overlay-content"><img src="<?php echo base_url();?>/assets/images/loading.gif" alt="Loading..."/></div></div>
                <div class="list_tbl">
                    <div class="res_tbl">
                        <table id="pur_lst_tbl_new" class="table table-striped table-bordered" style="width: 100%;">
                            <thead>
                                <th class="id_td">Id</th>
                                <th class="app_date">
                                    Date
                                    <span class="pull-right" id="reportrange">
                                        <i class="fa fa-filter"  aria-hidden="true" style="font-size: 9px;"></i> 
                                        <span></span>
                                    </span> 
                                    <input type="hidden" id="date_val" name="date_val" />
                                </th>
                                <th>Company Name</th>
                                <!-- <th class="">Amount</th> -->
                                <th class="stat_blk">
                                    Status
                                    <span class="sts_pp" id="status_icon">
                                        <i class="fa fa-filter" aria-hidden="true" style="font-size: 9px;"></i>
                                    </span>
                                    <div class="sts_fil_blk">
                                        <div class="trd_lst">
                                            <div class="form-check chek_bx">
                                                <input class="form-check-input" type="checkbox" name="optradio" value="P" id="sta1" />
                                                <label class="form-check-label" for="sta1">
                                                    Pending
                                                </label>
                                            </div>
                                            <div class="form-check chek_bx">
                                                <input class="form-check-input" type="checkbox" name="optradio" value="PM" id="sta2" />
                                                <label class="form-check-label" for="sta2">
                                                    Payment
                                                </label>
                                            </div>
                                            <div class="form-check chek_bx">
                                                <input class="form-check-input" type="checkbox" name="optradio" value="C" id="sta3" />
                                                <label class="form-check-label" for="sta3">
                                                    Approved
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </th>
                                <th class="act_ms">Actions</th>
                            </thead>
                        </table>
                        <input type="hidden" name="hid_tabval" id="hid_tabval" value="0">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Actions-->
 <div id="popover-contents-all" style="display: none">
  <div class="custom-popover">
      <ul class="list-group">
        <li class="list-group-item edt green_txt" id="pedit">Edit</li>
        <li class="list-group-item  reject_loan del" id="pdel">Delete</li>
      </ul>
  </div>
</div>
<div id="popover-contents-edit" style="display: none">
    <div class="custom-popover">
      <ul class="list-group">
        <li class="list-group-item edt green_txt" id="epedit">Edit</li>
      </ul>
    </div>
</div>
<!--Actions End-->
<!--Delete Request-->
<div class="modal" id="delete_req">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h1> Are You Sure ! </h1>
                <p> You want Delete this request <span id="brand_name"></span> ? </p>
            </div>
            <div class="modal_footer">
                <button type="button" class="btn btn-primary del_yes" data-dismiss="modal" onclick="Purchase.deleteReq();">Yes</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
<!--Delete Request End-->
<?php 
    $this->load->view('purchase/purchase_request.php',$data);
    $this->load->view('purchase/edit_request.php');
    $this->load->view('purchase/view_request.php');
?>
<script type="text/javascript"> 
var url = '<?php echo base_url()?>';

$(document).ready(function() {
$('.tp_rt_tgl').click(function(){
	$(this).find('.ys').toggleClass('hide_blk');
	$(this).find('.no').toggleClass('hide_blk');
	$(this).toggleClass('yes_val');
	
});

$('.ad_nt').click(function(){
    $('.pp_note').toggleClass('show_blk');
}); 

$('.lnk_typ.ban_trns').click(function(){
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
$('.lnk_typ.credit_trns').click(function(){
    $(this).addClass('act_type');
    $('.blk_disb').addClass('blk_no_dis');
    $(this).siblings('.ban_trns, .cash_trns').removeClass('act_type');
     $(this).parent().siblings('.ove_auto').find('.lon_typ').addClass('hide_blk_anim');
});

$(document).on("click", ".edt", function() {
   $('#edt_module').modal();
});

/*$(document).on("click", ".purc_btn", function() {
   $('#create_module').modal();
});*/

/*$('.act_icns').popover({
    html: true,
    content: function() {
      return $('#popover-contents').html();
    }

});*/


var tables = $('#pur_lst_tbl').DataTable({
      "ordering": false,
       language: {
        searchPlaceholder: "Search Loan Details",
        search: "",
        "dom": '<"toolbar">frtip'
      }
    });

	$('#pur_lst_tbl_wrapper .dataTables_length').html('<ul class="tabs_tbl"><li class="act_tab drft_cl"> <span>Pending Requests</span> </li><li class="comp_cl"> <span>Completed Requests </span> </li></ul> <span class="tbl_btn">  </span>');

	$(".loan_btm div.toolbar").html('<b>SSS</b>');
    $('.loan_btm a.toggle-vis').on( 'click', function (e) {
        $(this).parent().toggleClass('act');
        e.preventDefault();
        var column = tables.column( $(this).attr('data-column') );
        column.visible( ! column.visible() );
    });

    $('.dataTables_paginate').html('<a href="#" title=""> Show More </a>');

    $('.ad_nt').click(function(){
    // $('.pp_note').toggleClass('show_blk');
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

});
</script>
<!-- https://cdnjs.cloudflare.com/ajax/libs/jquery-mockjax/2.5.1/jquery.mockjax.min.js -->
<script type="text/javascript" src="<?php echo base_url();?>assets/js/views/purchases.js"></script>
<?php require_once 'footer.php' ; ?>