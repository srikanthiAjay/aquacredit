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
</style> 
<?php require_once 'sidebar.php' ; ?>		
<div class="right_blk">
    <div class="top_ttl_blk">
        <span class="back_btn"> </span> <span> Purchases List </span>
        <!-- 	<a href="#" title="" class="fr btn btn-primary"> Purchase Request </a> -->
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
                <div class="list_tbl">
                    <div class="res_tbl">
                        <table id="pur_lst_tbl" class="table table-striped table-bordered" style="width: 100%;">
                            <thead>
                                <th class="id_td">Id</th>
                                <th class="app_date">
                                    Date
                                    <span class="sts_pp">
                                        <i class="fa fa-filter" aria-hidden="true" style="font-size: 9px;"></i>
                                    </span>
                                    <div class="sts_fil_blk">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="optradio" value="" id="this_mnt" />
                                            <label class="form-check-label" for="this_mnt">
                                                This Month
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="optradio" value="" id="last_3mont" />
                                            <label class="form-check-label" for="last_3mont">
                                                Last 3 Months
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="optradio" value="" id="last_6mon" />
                                            <label class="form-check-label" for="last_6mon">
                                                Last 6 Months
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="optradio" value="" id="one_year" />
                                            <label class="form-check-label" for="one_year">
                                                1 Year
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="optradio" value="" id="choos_date" />
                                            <label class="form-check-label" for="choos_date">
                                                Choose Date
                                            </label>
                                        </div>
                                    </div>
                                </th>
                                <th>Company Name</th>
                                <th class="">Amount</th>
                                <th class="stat_blk">
                                    Status
                                    <span class="sts_pp">
                                        <i class="fa fa-filter" aria-hidden="true" style="font-size: 9px;"></i>
                                    </span>
                                    <div class="sts_fil_blk">
                                        <div class="trd_lst">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="optradio" value="" id="sta1" />
                                                <label class="form-check-label" for="sta1">
                                                    Pending
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="optradio" value="" id="sta2" />
                                                <label class="form-check-label" for="sta2">
                                                    Payment
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="optradio" value="" id="sta3" />
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
<div id="popover-contents" style="display: none">
	<div class="custom-popover">
	  <ul class="list-group">
	    <li class="list-group-item edt green_txt" id="pedit">Edit</li>
	    <li class="list-group-item  reject_loan del" id="pdel">Delete</li>
	  </ul>
	</div>
</div>
<?php 
    $this->load->view('purchase/admin_purchase_request.php',$data);
    $this->load->view('purchase/admin_edit_request.php');
?>
<script type="text/javascript"> 
var url = '<?php echo base_url()?>';

$(document).ready(function() {



// $(document).on("click", ".edt", function() {
//    $('#edt_module').modal();
// });

$(document).on("click", ".purc_btn", function() {
   $('#create_module').modal();
});

  $('.act_icns').popover({
    html: true,
    content: function() {
      return $('#popover-contents').html();
    }

  });

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
    

});
</script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/views/admin_purchases.js"></script>
<?php require_once 'footer.php' ; ?>