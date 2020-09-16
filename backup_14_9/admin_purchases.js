var Purchase;
var API_URL = url + 'api/purchases/';
var loader_fa = '<i class="fa fa-circle-o-notch fa-spin" style="font-size:15px"></i>';
var brand_id = '';
var ad_brand_id = '';
var productlist = {};
var userselectedprod = userselectedpdis = [];
var pinc = 0;
var pur_lst_tbl = '';

//Edit
var eproductlist = {};
var euserselectedprod = euserselectedpdis = [];
var epinc = 0;
var ebrand_id = null;
var ebrand_id = '';
var ap_id = null;

var formsteps = {
    pending: false,
    confirm: false,
    payment: false,
    received: false,
    complete: false
};

(function($) {
    Purchase = {
        init: function() {

            pur_lst_tbl = $('#pur_lst_tbl').DataTable({
                ordering: false,
                processing: true,
                serverSide: true,
                serverMethod: 'post',
                //pageLength:1,
                language: {
                    searchPlaceholder: "Search Purchase",
                    search: "",
                    "dom": '<"toolbar">frtip'
                },
                columnDefs: [
                    { className: "id_td", "targets": 0 },
                    { className: "app_date", "targets": 1 },
                    { className: "company", "targets": 2 },
                    { className: "amt", "targets": 3 },
                    { className: "stat_blk", "targets": 4 },
                    { className: "act_ms", "targets": 5 }
                ],
                ajax: {
                    url: API_URL + 'purchaselist',
                    data: function(data) {
                        //Status Filter
                        var multi_status = [];
                        $.each($("input[name='optradio']:checked"), function() {
                            multi_status.push($(this).val());
                        });

                        data.optradio = multi_status;

                        //Date Filter
                        var reportrange = $('#date_val').val();
                        data.reportrange = reportrange;

                        //Tab
                        var hid_tabval = $('#hid_tabval').val();
                        data.hid_tabval = hid_tabval;

                    },
                    dataSrc: function(json) {
                        /*setTimeout(function(){
	        				$('.act_icns').popover({
								html: true,
								content: function(){
								  return $('#popover-contents').html();
								}
							});
							
							$(document).on("click", "#pedit", function() {
							   Purchase.editRequest();
							});

							$(document).on("click", "#pdel", function() {
							   Purchase.delRequest();
							});

        				},1000);*/
                        Purchase.getSummary();
                        return json.data;
                    }
                },
                //columns:[]
            });

            //Tabs
            $('#pur_lst_tbl_wrapper .dataTables_length').html('<ul class="tabs_tbl"><li class="act_tab drft_cl"> <span>Pending Requests</span> </li><li class="comp_cl"> <span>Completed Requests </span> </li></ul> <span class="tbl_btn">  </span>');

            $('.comp_cl').click(function() {
                $('#status_icon').hide();
                $("#hid_tabval").val(1);
                $(this).addClass('act_tab');
                $('.tabs_tbl').addClass('cmp_ul');
                $('.drft_cl').removeClass('act_tab');

                pur_lst_tbl.columns([5]).visible(false);
                pur_lst_tbl.columns([0, 1, 2, 3, 4]).visible(true, true, true, true);
                pur_lst_tbl.columns.adjust().draw(false);
            });

            $('.drft_cl').click(function() {
                $('#status_icon').show();
                $("#hid_tabval").val(0);
                $(this).addClass('act_tab');
                $('.tabs_tbl').removeClass('cmp_ul');
                $('.comp_cl').removeClass('act_tab');
                pur_lst_tbl.columns([0, 1, 2, 3, 4, 5]).visible(true, true, true, true);
                pur_lst_tbl.columns.adjust().draw(false);
            });
            //Tabs End

            $('.tp_rt_tgl').click(function() {
                $(this).find('.ys').toggleClass('hide_blk');
                $(this).find('.no').toggleClass('hide_blk');
                $(this).toggleClass('yes_val');
            });

            $('.ad_nt').click(function() {
                $('.pp_note').toggleClass('show_blk');
            });

            $('.sec_step').click(function() {
                $(this).addClass('act_tb').removeClass('dne_tb');
                $('.fst_step').removeClass('act_tb').addClass('dne_tb');
                $('.thrd_step, .fth_step, .fst_step').removeClass('act_tb dne_tb');
                $('.bdr_blue').css('width', '75px');
                $('.paid_amont_bb').hide();
                $('.confrm_blk').hide();
                $('.pay_sec').show();
                $('.comp_blk, .ord_comp_blk').hide();
            });

            $('.fst_step').click(function() {
                $(this).addClass('act_tb').removeClass('dne_tb');
                $('.confrm_blk').show();
                $('.sec_step, .fth_step, .thrd_step').removeClass('act_tb dne_tb');
                $('.thrd_step').removeClass('act_tb dne_tb');
                $('.bdr_blue').removeAttr('style');
                $('.paid_amont_bb').hide();
                $('.pay_sec').hide();
                $('.comp_blk, .ord_comp_blk').hide();
            });
            $('.thrd_step').click(function() {
                $('.confrm_blk').hide();
                $(this).addClass('act_tb').removeClass('dne_tb');
                $('.fst_step, .fth_step').removeClass('act_tb').addClass('dne_tb');
                $('.sec_step').removeClass('act_tb').addClass('dne_tb');
                $('.bdr_blue').css('width', '150px');
                // $('.paid_amont_bb').show();
                $('.pay_sec, .ord_comp_blk').hide();
                $('.comp_blk').show();
                $('.show_dtl').click(function() {
                    var scrollTop = $('.brn_lst').offset().top - 50;
                    $('.comp_blk .ord_comp_bl').animate({
                        scrollTop: $(".brn_lst").offset().top - 50
                    }, 1000);
                });
            });

            $(".allownumericwithoutdecimal").on("keypress keyup blur", function(event) {
                $(this).val($(this).val().replace(/[^\d].+/, ""));
                if ((event.which < 48 || event.which > 57)) {
                    event.preventDefault();
                }
            });

            $(document).on("click", "#pedit", function() {
                Purchase.editRequest();
            });

            $(document).on("click", "#pdel", function() {
                Purchase.delRequest();
            });

            $('body').on('click', function(e) {
                //did not click a popover toggle, or icon in popover toggle, or popover
                if ($(e.target).data('toggle') !== 'popover' &&
                    $(e.target).parents('[data-toggle="popover"]').length === 0 &&
                    $(e.target).parents('.popover.in').length === 0) {
                    $('[data-toggle="popover"]').popover('hide');
                }
            });

            //Filters
            $("input[name='optradio']").on('click', function() {
                pur_lst_tbl.draw();
            });

            $('#reportrange').daterangepicker({
                opens: 'right',
                drops: 'down',
                showDropdowns: true,
                locale: {
                    format: 'D-MMM-YYYY',
                    customRangeLabel: 'Date Range'
                },
                parentEl: '.dateEle',
                ranges: {
                    'Till Date': [],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                    'Last 6 Months': [moment().subtract(5, 'month').startOf('month'), moment().endOf('month')],
                    "Last Year": [moment().subtract(1, "y").startOf("year"), moment().subtract(1, "y").endOf("year")]
                }
            }, Purchase.cb);

            $(document).on('click', '.ranges ul li', function() {
                $(this).parent().children().removeClass('active');
                $(this).addClass('active');
                $('.drp-selected').css('font-weight', 'bold');
                if ($(this).text() == "Till Date") {
                    $("#date_val").val('Till Date');
                }

                if ($(this).text() != "Date Range") {
                    pur_lst_tbl.draw();
                }
            });

            $(document).on('click', '.applyBtn', function() {
                pur_lst_tbl.draw();
            });

            $("input[name='month_opt']").on('click', function() {
                pur_lst_tbl.draw();
            });
        },
        cb: function(start, end) {
            $('#date_val').val(start.format('D/MMM/YYYY') + ' - ' + end.format('D/MMM/YYYY'));
            if ($('#date_val').val() == "Invalid date - Invalid date") {
                $('#date_val').val('');
            } else {
                $('#date_val').val(start.format('D/MMM/YYYY') + ' - ' + end.format('D/MMM/YYYY'));
            }
        },
        addCommasinamt: function(x) {
            x = x.toString();
            var lastThree = x.substring(x.length - 3);
            var otherNumbers = x.substring(0, x.length - 3);
            if (otherNumbers != '')
                lastThree = ',' + lastThree;
            //var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
            var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/, ",") + lastThree;

            return res;
        },
        getSummary: function() {
            jQuery.post(API_URL + '/apSummary')
                .done(function(data) {
                    //summary
                    var result = $.parseJSON(data);
                    var pending = result.summary.pending;
                    var approved = result.summary.approved;
                    var paid = result.summary.paid;
                    var branch_confirm = result.summary.admin_confirm;
                    var completed = result.summary.completed;
                    var total_purchase = '₹' + Purchase.addCommasinamt(result.summary.total_purchase);
                    $('#total_purchase').html(total_purchase);
                    $('#pending').html(pending);
                    $('#approved').html(approved);
                    $('#paid').html(paid);
                    $('#completed').html(completed);
                    $('#total_purchase').html(total_purchase);
                });
        },
        purchaseact: function(apid, brand_id) {
            //console.log(apid+'---'+brand_id);
            ebrand_id = null;
            ap_id = null;
            ap_id = apid;
            ebrand_id = brand_id;

            $('#req_' + ap_id).popover({
                html: true,
                content: function() {
                    return $('#popover-contents').html();
                },
                trigger: 'click'
            });
        },
        editRequest: function() {
            formsteps = {
                pending: false,
                confirm: false,
                payment: false,
                received: false,
                complete: false
            };
            //console.log('####');
            //console.log(ap_id+'---'+ebrand_id);
            //modal_content
            //overlay_id
            $('#overlay_id').show();
            //$('#edit_module').modal({backdrop: 'static', keyboard: false});
            $('#edt_module').modal({ backdrop: 'static', keyboard: false });
            jQuery.post(API_URL + '/editrequest', { brand_id: ebrand_id, ap_id: ap_id })
                .done(function(data) {
                    $('#all_prods').empty();
                    $('#banklist_admin').empty();
                    $('#banklist_co').empty();
                    $('#myTab').empty();
                    $('#branchplist').empty();
                    var prod_list = '';
                    var branch_list = '';

                    var res = $.parseJSON(data);
                    var brand_info = res.brand_info;
                    var purchase_info = res.purchase_info;

                    //P-pending,C-confirm,PM-payment,BC-branch confirm,CE-Complete
                    if (purchase_info.status == 'P') {
                        //console.log('####');
                        formsteps.pending = true;

                        $('#confirm').addClass('act_tb').removeClass('dne_tb');
                        $('.confrm_blk').show();
                        $('#confirm_id').show();
                        $('#paybtn').hide();
                        $('.sec_step, .fth_step, .thrd_step').removeClass('act_tb dne_tb');
                        $('.thrd_step').removeClass('act_tb dne_tb');
                        $('.bdr_blue').removeAttr('style');
                        $('.paid_amont_bb').hide();
                        $('.pay_sec').hide();
                        $('#do_payment').show();
                        $('#payment_info_block').hide();
                        $('#payment_info').empty();
                        $('.comp_blk, .ord_comp_blk').hide();
                    } else if (purchase_info.status == 'C') {
                        formsteps.confirm = true;
                        $('#confirm_id').hide();

                        $('.fst_step').click(function() {
                            $(this).addClass('act_tb').removeClass('dne_tb');
                            $('.confrm_blk').show();
                            $('.sec_step, .fth_step, .thrd_step').removeClass('act_tb dne_tb');
                            $('.thrd_step').removeClass('act_tb dne_tb');
                            $('.bdr_blue').removeAttr('style');
                            $('.paid_amont_bb').hide();
                            $('.pay_sec').hide();
                            $('.comp_blk, .ord_comp_blk').hide();
                        });
                        $('.thrd_step').click(function() {
                            $('.confrm_blk').hide();
                            $(this).addClass('act_tb').removeClass('dne_tb');
                            $('.fst_step, .fth_step').removeClass('act_tb').addClass('dne_tb');
                            $('.sec_step').removeClass('act_tb').addClass('dne_tb');
                            $('.bdr_blue').css('width', '150px');
                            // $('.paid_amont_bb').show();
                            $('.pay_sec, .ord_comp_blk').hide();
                            $('.comp_blk').show();
                            $('.show_dtl').click(function() {
                                var scrollTop = $('.brn_lst').offset().top - 50;
                                $('.comp_blk .ord_comp_bl').animate({
                                    scrollTop: $(".brn_lst").offset().top - 50
                                }, 1000);
                            });
                        });


                        //Step 2
                        $('#payment').addClass('act_tb').removeClass('dne_tb');

                        //Step 1
                        $('.fst_step').removeClass('act_tb').addClass('dne_tb');
                        $('.thrd_step, .fth_step, .fst_step').removeClass('act_tb dne_tb');
                        $('.bdr_blue').css('width', '75px');
                        $('.paid_amont_bb').hide();
                        $('.confrm_blk').hide();
                        $('.pay_sec').show();
                        $('#paybtn').show();
                        $('.comp_blk, .ord_comp_blk').hide();
                    } else if (purchase_info.status == 'PM') {
                        //Default
                        $('#ptype_bank').attr('checked', true);
                        formsteps.payment = true;
                        $('#confirm_id').hide();
                        $('#paybtn').hide();

                        //Set Payment Information

                        //Step 1
                        $('.fst_step').removeClass('act_tb').addClass('dne_tb');
                        $('.thrd_step, .fth_step, .fst_step').removeClass('act_tb dne_tb');
                        $('.bdr_blue').css('width', '75px');
                        $('.paid_amont_bb').hide();
                        $('.confrm_blk').hide();
                        $('.pay_sec').show();
                        $('.comp_blk, .ord_comp_blk').hide();

                        //Step 2
                        $('.sec_step').addClass('act_tb').removeClass('dne_tb');

                        //Step 3
                        $('#received').addClass('act_tb').removeClass('dne_tb');
                        $('.fst_step, .fth_step').removeClass('act_tb').addClass('dne_tb');
                        $('.sec_step').removeClass('act_tb').addClass('dne_tb');
                        $('.bdr_blue').css('width', '150px');
                        $('.pay_sec, .ord_comp_blk').hide();
                        $('.comp_blk').show();
                        $('.show_dtl').click(function() {
                            var scrollTop = $('.brn_lst').offset().top - 50;
                            $('.comp_blk .ord_comp_bl').animate({
                                scrollTop: $(".brn_lst").offset().top - 50
                            }, 1000);
                        });

                        $('#do_payment').hide();
                        $('#payment_info_block').show();
                        $('#payment_info').empty();

                        var payment_info = '';
                        payment_info += '<tr><td>Payment Type</td><td class="text_cent qty_pp">' + purchase_info.ptype + '</td></tr>';
                        if (purchase_info.payment_type == 'BK') {
                            payment_info += '<tr><td width="50%">Date</td><td class="text_cent qty_pp">' + purchase_info.payment_date + '</td></tr>';
                            payment_info += '<tr><td width="50%">Admin Bank Acc NO</td><td class="text_cent qty_pp">' + purchase_info.admin_acc_name + '-' + purchase_info.admin_acc + '</td></tr>';
                            payment_info += '<tr><td width="50%">Company Bank Acc NO</td><td class="text_cent qty_pp">' + purchase_info.co_acc_name + '-' + purchase_info.co_acc + '</td></tr>';
                            payment_info += '<tr><td width="50%">Ref.Number</td><td class="text_cent qty_pp">' + purchase_info.refno + '</td></tr>';
                            payment_info += '<tr><td width="50%">Note</td><td class="text_cent qty_pp">' + purchase_info.note + '</td></tr>';
                        } else if (purchase_info.payment_type == 'CH') {
                            payment_info += '<tr><td width="50%">Ref.Number</td><td class="text_cent qty_pp">' + purchase_info.refno + '</td></tr>';
                            payment_info += '<tr><td width="50%">Note</td><td class="text_cent qty_pp">' + purchase_info.note + '</td></tr>';
                        } else {

                        }

                        var total_price = parseInt(purchase_info.total_price);
                        payment_info += '<tr><td class="text_rt ttl_amnt">Total Amount</td><td class="blue_text text_rt ttl_amnt">₹' + Purchase.addCommasinamt(total_price) + '</td></tr>';
                        payment_info += '<tr><td class="text_rt ttl_amnt">Paid Amount</td><td class="blue_text text_rt ttl_amnt">₹' + Purchase.addCommasinamt(purchase_info.trasaction_info.total_amount) + '</td></tr>';

                        $('#payment_info').append(payment_info);
                    } else if (purchase_info.status == 'CE') {
                        formsteps.complete = true;
                        $('#confirm_id').hide();
                        $('#paybtn').hide();

                        //Step 1
                        $('.fst_step').removeClass('act_tb').addClass('dne_tb');
                        $('.thrd_step, .fth_step, .fst_step').removeClass('act_tb dne_tb');
                        $('.bdr_blue').css('width', '75px');
                        $('.paid_amont_bb').hide();
                        $('.confrm_blk').hide();
                        $('.pay_sec').show();
                        $('.comp_blk, .ord_comp_blk').hide();

                        //Step 2
                        $('.sec_step').addClass('act_tb').removeClass('dne_tb');

                        //Step 3
                        $('#received').addClass('act_tb').removeClass('dne_tb');
                        $('.fst_step, .fth_step').removeClass('act_tb').addClass('dne_tb');
                        $('.sec_step').removeClass('act_tb').addClass('dne_tb');
                        $('.bdr_blue').css('width', '150px');
                        $('.pay_sec, .ord_comp_blk').hide();
                        $('.comp_blk').show();
                        $('.show_dtl').click(function() {
                            var scrollTop = $('.brn_lst').offset().top - 50;
                            $('.comp_blk .ord_comp_bl').animate({
                                scrollTop: $(".brn_lst").offset().top - 50
                            }, 1000);
                        });
                    }

                    var products = res.products;
                    var branches = res.branches;
                    var adminacc = res.adminacc;
                    var coacc = res.coacc;
                    $('#brand_title').html(brand_info.brand_name);
                    $('#cname').html(brand_info.brand_name);

                    //step 1
                    //brand_title,branch_list,all_prods

                    //Branches
                    $('#branch_list').empty();
                    for (var b = 0; b < branches.length; b++) {
                        //console.log(branches[b]);
                        var branch_prod = branches[b].products;
                        var pcnt = branch_prod.length;
                        var bpurchase_info = branches[b].purchase_info;

                        branch_list += '<li onclick="Purchase.openBranch(' + branches[b].branch_id + ',event);">';
                        //branch_list+='<div>';
                        branch_list += '<div class="check_wt_serc_new check_wt_serc val_seld" id="bb_' + branches[b].branch_id + '">';
                        branch_list += '<div>';
                        branch_list += '<div class="show_va" id="branch_name_' + branches[b].branch_id + '" data-bp-id="' + branches[b].purchase_info.bp_id + '">' + branches[b].branch_name + '</div>';
                        branch_list += '<div class="selectVal">Products(' + pcnt + ')</div>';
                        branch_list += '<ul class="check_list" id="blist_' + branches[b].branch_id + '">';

                        branch_list += '<li>';
                        branch_list += '<div class="form-group" id="bsearch_' + branches[b].branch_id + '"><input type="text" class="form-control" placeholder="Search Branch" id="search_' + branches[b].branch_id + '" onkeyup="Purchase.searchElements(' + branches[b].branch_id + ');"/></div>';
                        branch_list += '</li>';

                        branch_list += '<li id="bpglist_' + branches[b].branch_id + '">';
                        for (var p = 0; p < branch_prod.length; p++) {
                            //console.log(branch_prod[p]);
                            //branch_list+='<li>';
                            branch_list += '<div class="form-check chek_bx checkd" id="fcheck_' + branches[b].branch_id + '_' + branch_prod[p].pid + '"><input class="form-check-input" type="checkbox" id="bp_' + branches[b].branch_id + '_' + branch_prod[p].pid + '" name="bp_' + branches[b].branch_id + '[]" value="' + branch_prod[p].pid + '" checked="checked" onclick="Purchase.isChecked(' + branches[b].branch_id + ',' + branch_prod[p].pid + ');"/><label class="form-check-label" for="uss_' + branches[b].branch_id + '_' + branch_prod[p].pid + '" id="bpname_' + branches[b].branch_id + '_' + branch_prod[p].pid + '" data-price="' + branch_prod[p].price + '" data-bpd-id="' + branch_prod[p].bpd_id + '">' + branch_prod[p].pname + '</label><input type="text" class="cnt allownumericwithoutdecimal" placeholder="count" id="bpc_' + branches[b].branch_id + '_' + branch_prod[p].pid + '" name="bpc_' + branches[b].branch_id + '[]" value="' + branch_prod[p].quantity + '" style="opacity:1 !important;"/></div>';
                            //branch_list+='</li>';
                        }

                        //Extra Products
                        var extra_products = branches[b].extra_products;
                        if (extra_products.length > 0) {
                            for (var e = 0; e < extra_products.length; e++) {
                                //branch_list+='<li>';
                                branch_list += '<div class="form-check chek_bx" id="fcheck_' + branches[b].branch_id + '_' + extra_products[e].pid + '"><input class="form-check-input" type="checkbox" id="bp_' + branches[b].branch_id + '_' + extra_products[e].pid + '" name="bp_' + branches[b].branch_id + '[]" value="' + extra_products[e].pid + '" onclick="Purchase.isChecked(' + branches[b].branch_id + ',' + extra_products[e].pid + ');"/><label class="form-check-label" for="uss_' + branches[b].branch_id + '_' + extra_products[e].pid + '" id="bpname_' + branches[b].branch_id + '_' + extra_products[e].pid + '" data-price="' + extra_products[e].purchase_amt + '" data-bpd-id="">' + extra_products[e].pname + '</label><input type="text" class="cnt allownumericwithoutdecimal" placeholder="count" id="bpc_' + branches[b].branch_id + '_' + extra_products[e].pid + '" name="bpc_' + branches[b].branch_id + '[]" value="' + extra_products[e].quantity + '" style="opacity:1 !important;"/></div>';
                                //branch_list+='</li>';
                            }
                        }
                        branch_list += '</li>';
                        if (bpurchase_info.status == 'P' || bpurchase_info.status == 'C' || bpurchase_info.status == 'PM') {
                            branch_list += '<li><button class="btn save_blk btn-primary" onclick="Purchase.updateBranchProd(' + branches[b].branch_id + ');">Save</button></li>';
                        }

                        branch_list += '</ul>';
                        branch_list += '</div>';
                        branch_list += '<div>';
                        branch_list += '</li>';

                    }
                    $('#branch_list').append(branch_list);

                    //Product List
                    var tot_amt = 0;
                    for (var i = 0; i < products.length; i++) {
                        var price = Purchase.addCommasinamt(parseInt(products[i].price));
                        var total_price = Purchase.addCommasinamt(parseInt(products[i].total_price));
                        tot_amt = tot_amt + parseInt(products[i].total_price);
                        prod_list += '<tr id="pindex_' + i + '">';
                        prod_list += '<td>' + products[i].pname + '</td>';
                        prod_list += '<td class="text_cent qty_pp">' + products[i].quantity + '</td>';
                        prod_list += '<td data-toggle="tooltip" data-placement="top" title="MRP:' + price + '" class="text_rt qty_prc"><input type="text" value="' + price + '" class="text_rt" name="" /></td>';
                        prod_list += '<td class="text_rt">' + total_price + '</td>';
                        prod_list += '</tr>';
                    }
                    var tot_amt_new = '₹' + Purchase.addCommasinamt(tot_amt);
                    prod_list += '<tr>';
                    prod_list += '<td colspan="3" class="text_rt ttl_amnt">Total Amount</td>';
                    prod_list += '<td class="blue_text text_rt ttl_amnt">' + tot_amt_new + '</td>';
                    prod_list += '</tr>';
                    $('#all_prods').append(prod_list);

                    //Total Purchase Amount
                    $('#tot_pcamt').val(Purchase.addCommasinamt(tot_amt));

                    //step 2
                    //bankVal,banklist,cobankVal,cobanklist
                    var dateToday = new Date();
                    $("#paydate").datepicker({
                        beforeShow: function() {
                            setTimeout(function() {
                                $('.ui-datepicker').css('z-index', 99999999999999);
                            }, 0);
                        },
                        dateFormat: 'dd-M-yy',
                        //defaultDate: "+1w",
                        changeMonth: true,
                        changeYear: true,
                        minDate: dateToday,
                        numberOfMonths: 1,
                        onSelect: function(selected) {
                            $('#paydatetxt').text('');
                            //event.stopPropagation();
                            // $("#start_date").parent().addClass('inp_ss');
                            // $("#start_date").removeClass('error');
                            // str = selected.split("-").join(" ");
                            //var dt = new Date(str);
                            //dt.setDate(dt.getDate() + 1);
                            //$("#end_date").datepicker("option", "minDate", dt);
                        }
                    });

                    //Admin Accounts
                    var admin_acc = '<li>';
                    for (var i = 0; i < adminacc.length; i++) {
                        var icon = adminacc[i].account_name.toLowerCase() + '_icn.png';
                        var bank_bal = '₹' + Purchase.addCommasinamt(adminacc[i].avail_amount);
                        var accont_numb = adminacc[i].account_number;
                        admin_acc += '<div class="form-check" onclick="Purchase.selectAccount(\'admin\',\'banklist\',\'' + adminacc[i].id + '\')">';
                        admin_acc += '<input class="form-check-input" type="radio" name="adminacc" id="adinput_' + adminacc[i].id + '" value="' + adminacc[i].id + '"/>';
                        admin_acc += '<label class="form-check-label" for="adlb_' + adminacc[i].id + '">';
                        admin_acc += '<div class="bank_logo"><img src="' + url + '/assets/images/' + icon + '" alt="" title=""/></div>';
                        admin_acc += '<div class="bank_mny">';
                        admin_acc += '<div class="bank_bal">' + bank_bal + '</div>';
                        admin_acc += '<div class="accont_numb" id="admin_' + adminacc[i].bank_id + '">' + accont_numb + '</div>';
                        admin_acc += '</div>';
                        admin_acc += '</label>';
                        admin_acc += '</div>';
                    }
                    admin_acc += '</li>';
                    $('#banklist_admin').append(admin_acc);

                    var co_acc = '<li>';
                    for (var i = 0; i < coacc.length; i++) {
                        var icon = coacc[i].bank_name.toLowerCase() + '_icn.png';
                        var accont_numb = coacc[i].account_no;
                        co_acc += '<div class="form-check" onclick="Purchase.selectAccount(\'co\',\'banklist\',\'' + coacc[i].acc_id + '\')">';
                        co_acc += '<input class="form-check-input" type="radio" name="coacc" id="coinput_' + coacc[i].acc_id + '" value="' + coacc[i].acc_id + '"/>';
                        co_acc += '<label class="form-check-label" for="colb_' + coacc[i].acc_id + '">';
                        co_acc += '<div class="bank_logo"><img src="' + url + '/assets/images/' + icon + '" alt="" title=""/></div>';
                        co_acc += '<div class="bank_mny">';
                        co_acc += '<div class="accont_numb" id="co_' + coacc[i].acc_id + '">' + accont_numb + '</div>';
                        co_acc += '</div>';
                        co_acc += '</label>';
                        co_acc += '</div>';
                    }
                    co_acc += '</li>';
                    $('#banklist_co').append(co_acc);

                    //step 3
                    //cname,branchplist
                    //myTab
                    var branch = '';
                    for (var b = 0; b < branches.length; b++) {
                        var active = '';
                        if (b == 0) {
                            active = 'active';
                        }
                        branch += '<li class="nav-item ' + active + '">';
                        branch += '<a class="nav-link ' + active + '" data-toggle="tab" href="#branch' + branches[b].branch_id + '" role="tab" aria-controls="home" aria-selected="true">' + branches[b].branch_name + '</a>';
                        branch += '</li>';
                    }
                    $('#myTab').append(branch);

                    //Tab Content
                    var branch_tab = '';
                    for (var b = 0; b < branches.length; b++) {
                        var active = '';
                        var purchase_info = branches[b].purchase_info;
                        var prods = branches[b].products;

                        if (purchase_info.status == 'CE') {
                            var ts_charges = '';
                            if (purchase_info.admin_pay_req == 1) {
                                ts_charges += '(<span style="color:red;">Transport charges not paid</span>)';
                            }
                            var status = 'Confirmed' + ts_charges;
                            var status_cls = 'grn_clr';
                        } else {
                            var status = 'Pending';
                            var status_cls = 'pen_st';
                        }

                        if (purchase_info.upload_invoice != '') {
                            var upload_invoice = 'Invoice uploaded';
                            var cls = 'grn_clr';
                        } else {
                            var upload_invoice = 'Invoice not uploaded';
                            var cls = 'pen_st';
                        }

                        if (b == 0) {
                            active = 'show active';
                        }

                        //<form id="branch_edit_'+branches[b].branch_id+'" name="branch_edit_'+branches[b].branch_id+'" enctype="multipart/form-data">
                        branch_tab += '<div class="order_hist tab-pane fade ' + active + '" id="branch' + branches[b].branch_id + '"><form id="branch_edit_' + branches[b].branch_id + '" name="branch_edit" enctype="multipart/form-data">';
                        branch_tab += '<h2 class="create_hdg"><span class="' + status_cls + '">' + status + '</span> &nbsp;&nbsp;<span class="gry_clr">I</span>&nbsp;&nbsp; <span class="' + cls + '"> ' + upload_invoice + ' </span></h2>';
                        branch_tab += '<table class="ord_lst mar_tp_non" cellspacing="0" cellpadding="0" border="0">';
                        branch_tab += '<thead>';
                        branch_tab += '<tr>';
                        branch_tab += '<th>Product Name</th>';
                        branch_tab += '<th>Qty</th>';
                        branch_tab += '<th>Purchase Amount</th>';
                        branch_tab += '<th>Total</th>';
                        branch_tab += '</tr>';

                        /*branch_list+='<div class="form-check"><input class="form-check-input" type="checkbox" id="bp_'+branches[b].branch_id+'_'+extra_products[e].pid+'" name="bp_'+branches[b].branch_id+'_'+extra_products[e].pid+'" value="'+extra_products[e].pid+'"/><label class="form-check-label" for="uss1">'+extra_products[e].pname+'</label><input type="text" class="cnt" placeholder="count" id="bpc_'+branches[b].branch_id+'_'+extra_products[e].pid+'" name="bpc_'+branches[b].branch_id+'_'+extra_products[e].pid+'" value="'+extra_products[e].quantity+'"/></div>';
                        branch_list+='</li>';*/

                        //Branch Products
                        var btot_amt = 0;
                        for (var i = 0; i < prods.length; i++) {
                            var price = Purchase.addCommasinamt(parseInt(prods[i].price));
                            var total_price = Purchase.addCommasinamt(parseInt(prods[i].total_price));
                            btot_amt += parseInt(prods[i].total_price);
                            branch_tab += '<tr>';
                            branch_tab += '<td>' + prods[i].pname + '</td>';
                            branch_tab += '<td>' + prods[i].quantity + '</td>';
                            branch_tab += '<td data-toggle="tooltip" data-placement="top" title="MRP:' + total_price + '" class="text_rt">' + price + '</td>';
                            branch_tab += '<td class="text_rt">' + total_price + '</td>';
                            branch_tab += '</tr>';
                            if ((i + 1) == prods.length) {
                                // branch_tab+='<tr id="searchtrid_'+branches[b].branch_id+'">';
                                // branch_tab+='<td colspan="4"><input id="search" name="search" type="text" value="" placeholder="Search product"/></td>';
                                // branch_tab+='</tr>';
                                branch_tab += '<tr><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td></td></tr>';
                            }
                        }
                        var btot_amt_str = '';
                        btot_amt_str = Purchase.addCommasinamt(btot_amt);
                        branch_tab += '<tr>';

                        //Admin Payment status
                        var admin_pay_staus = purchase_info.status;
                        if (admin_pay_staus) {

                        }

                        if (purchase_info.upload_invoice == '') {
                            branch_tab += '<td class=""><a href="#" class="invoice_up"><label for="fine_inv_' + branches[b].branch_id + '"><i class="fa fa-paperclip" aria-hidden="true"></i> Upload Invoice<input type="file" id="fine_inv_' + branches[b].branch_id + '" name="fine_inv_' + branches[b].branch_id + '" accept="application/pdf,image/jpg,image/jpeg,image/png" onchange="Purchase.uploadInvoice(event,' + branches[b].branch_id + ');"></label><p id="invoice_file_' + branches[b].branch_id + '"></p></a></td>';
                        } else {
                            branch_tab += '<td class=""></td>';
                        }


                        branch_tab += '<td colspan="2" class="grd_ttl text_rt">Total Amount</td>';
                        branch_tab += '<td class="blue_text text_rt">' + btot_amt_str + '</td>';
                        branch_tab += '</tr>';

                        //Uploading Charges
                        branch_tab += '<tr class="last_cld2">';
                        branch_tab += '<td colspan="4" class="p_t_5">';
                        branch_tab += '<div class="fl_over">';

                        //Uploading Charges
                        branch_tab += '<div class="avail_bal">';
                        branch_tab += '<table><tbody>';
                        branch_tab += '<tr class="disc_blk">';
                        branch_tab += '<td class="green_txt">Unloading Charges <span class="red_clr"></span></td>';

                        if (purchase_info.unloading_charges > 0) {
                            branch_tab += '<td colspan="2" class="green_txt"><input type="text" id="unloading_chr_' + branches[b].branch_id + '" name="unloading_chr_' + branches[b].branch_id + '" class="text_rt" value="' + purchase_info.unloading_charges + '" disabled/></td>';
                        } else {
                            branch_tab += '<td colspan="2" class=""><input type="text" id="unloading_chr_' + branches[b].branch_id + '" name="unloading_chr_' + branches[b].branch_id + '" class="text_rt" value="0"/></td>';
                        }

                        branch_tab += '</tr>';
                        branch_tab += '</tbody></table>';
                        branch_tab += '</div>';
                        //Uploading Charges End

                        //Transport Charges
                        branch_tab += '<div class="avail_bal">';
                        branch_tab += '<table><tbody>';
                        branch_tab += '<tr class="disc_blk">';
                        branch_tab += '<td class="green_txt">Transport Charges <span class="red_clr"></span></td>';

                        if (purchase_info.transport_charges > 0 && purchase_info.admin_pay_req == 0) {
                            branch_tab += '<td colspan="2" class="green_txt"><input type="text" id="trasport_chr_' + branches[b].branch_id + '" name="trasport_chr_' + branches[b].branch_id + '" class="text_rt" value="' + purchase_info.transport_charges + '" disabled/></td>';
                        } else {
                            if (purchase_info.transport_charges > 0) {
                                var transport_charges = parseInt(purchase_info.transport_charges);
                            } else {
                                var transport_charges = 0;
                            }

                            branch_tab += '<td colspan="2" class="green_txt"><input type="text" id="trasport_chr_' + branches[b].branch_id + '" name="trasport_chr_' + branches[b].branch_id + '" class="text_rt" value="' + transport_charges + '"/></td>';
                        }

                        branch_tab += '</tr>';
                        branch_tab += '</tbody></table>';

                        //if(purchase_info.transport_charges>0){

                        //sufficient balance
                        //Don\'t have a sufficient balance
                        if (purchase_info.admin_pay_req == 1) {
                            branch_tab += '<div class="checkbox adm_ant" id="balance_check_' + branches[b].branch_id + '">';
                        } else {
                            branch_tab += '<div class="checkbox adm_ant" id="balance_check_' + branches[b].branch_id + '" style="display:none;">';
                        }


                        branch_tab += '<div class="row">';
                        branch_tab += '<div class="col-md-7">';
                        branch_tab += '<label><input type="checkbox" value="yes" id="cash_balance_' + branches[b].branch_id + '" disabled/>Use Cash Balance</label><p class="bal_amn_cash" id="cash_balance_msg_' + branches[b].branch_id + '">' + branches[b].amount + '</p>';
                        branch_tab += '</div>';
                        branch_tab += '<div class="col-md-5" id="admin_pay_' + branches[b].branch_id + '">';
                        if (purchase_info.admin_pay_req == 1) {
                            branch_tab += '<div class="top_in_op text_rt crop_top"><p class="text_rt"><input type="checkbox" value="admin" id="pay_by_' + branches[b].branch_id + '" checked="checked" disabled/>Admin pay</p><h1 class="text_rt" id="admin_pay_amt_' + branches[b].branch_id + '"></h1></div>';
                        } else {
                            branch_tab += '<div class="top_in_op text_rt crop_top"><p class="text_rt"><input type="checkbox" value="admin" id="pay_by_' + branches[b].branch_id + '" disabled/>Admin pay</p><h1 class="text_rt" id="admin_pay_amt_' + branches[b].branch_id + '"></h1></div>';
                        }

                        branch_tab += '</div>';
                        branch_tab += '</div>';
                        branch_tab += '</div>';
                        //sufficient balance end

                        //}

                        branch_tab += '</div>';
                        //Transport Charges END

                        branch_tab += '</div>';
                        branch_tab += '</td>';
                        branch_tab += '</tr>';

                        branch_tab += '</thead>';
                        branch_tab += '</table>';

                        //if(purchase_info.transport_charges==0){
                        //Driver
                        if (purchase_info.admin_pay_req == 1) {
                            branch_tab += '<div class="qs_blk rem_tr_amn" id="driver_' + branches[b].branch_id + '">';
                            branch_tab += '<h2 class="create_hdg">Select below options to pay ₹' + purchase_info.transport_charges + ' to driver</h2>';
                        } else {
                            branch_tab += '<div class="qs_blk rem_tr_amn" id="driver_' + branches[b].branch_id + '" style="display:none;">';
                            branch_tab += '<h2 class="create_hdg">Select below options to pay ₹<span id="admin_pay_driver_' + branches[b].branch_id + '"></span> to driver</h2>';
                        }

                        //Assign Type
                        branch_tab += '<ul class="assign_type">';
                        branch_tab += '<li class="credit_trns lnk_typ" onclick="Purchase.assignType(\'upi_cash\',\'' + branches[b].branch_id + '\')"><img src="http://3.7.44.132/aquacredit/assets/images/credit_icn.png" /><input type="radio" name="act_types_' + branches[b].branch_id + '" value="upi_cash"/><span> UPI </span></li>';
                        if (purchase_info.admin_pay_req == 1) {
                            branch_tab += '<li class="act_type lnk_typ ban_trns" onclick="Purchase.assignType(\'bank\',\'' + branches[b].branch_id + '\')"><img src="http://3.7.44.132/aquacredit/assets/images/bank_tansfer.png" /><input type="radio" name="act_types_' + branches[b].branch_id + '" value="bank" checked="checked"/><span> Bank Transfer </span></li>';
                        } else {
                            branch_tab += '<li class="act_type lnk_typ ban_trns" onclick="Purchase.assignType(\'bank\',\'' + branches[b].branch_id + '\')"><img src="http://3.7.44.132/aquacredit/assets/images/bank_tansfer.png" /><input type="radio" name="act_types_' + branches[b].branch_id + '" value="bank"/><span> Bank Transfer </span></li>';
                        }

                        branch_tab += '<li class="cash_trns lnk_typ" onclick="Purchase.assignType(\'cash\',\'' + branches[b].branch_id + '\')"><img src="http://3.7.44.132/aquacredit/assets/images/cash_icn.png" /><input type="radio" name="act_types_' + branches[b].branch_id + '" value="cash"/><span> Cash </span></li>';
                        branch_tab += '</ul>';

                        branch_tab += '<ul class="trans_inf" id="tsc_frm_bank_' + branches[b].branch_id + '">';
                        branch_tab += '<li class="app_date"><div class="cre_inp"><input type="text" class="form-control" id="ddate_' + branches[b].branch_id + '" name="ddate_' + branches[b].branch_id + '" value="" placeholder="Date" autocomplete="off"/></div></li>';

                        branch_tab += '<li class="us_bn_ls bank_' + branches[b].branch_id + '">';
                        //Admin Accounts
                        branch_tab += '<div class="check_wt_serc check_wt_serc_cstm" id="dadmin_' + branches[b].branch_id + '">';
                        branch_tab += '<div class="show_va">Select Bank</div>';
                        branch_tab += '<div class="selectVal" id="dadminacc_' + branches[b].branch_id + '">Select Bank</div>';
                        branch_tab += '<ul class="check_list" id="dbanklist_' + branches[b].branch_id + '">';
                        branch_tab += '<li>';
                        for (var i = 0; i < adminacc.length; i++) {
                            var icon = adminacc[i].account_name.toLowerCase() + '_icn.png';
                            var bank_bal = '₹' + Purchase.addCommasinamt(adminacc[i].avail_amount);
                            var accont_numb = adminacc[i].account_number;
                            branch_tab += '<div class="form-check" onclick="Purchase.selectTsAccount(\'dadmin\',\'banklist\',\'' + adminacc[i].id + '\',\'' + branches[b].branch_id + '\')">';
                            branch_tab += '<input class="form-check-input" type="radio" name="dadminacc_' + branches[b].branch_id + '" id="dadinput_' + adminacc[i].id + '_' + branches[b].branch_id + '" value="' + adminacc[i].id + '"/>';
                            branch_tab += '<label class="form-check-label" for="dadlb_' + adminacc[i].id + '_' + branches[b].branch_id + '">';
                            branch_tab += '<div class="bank_logo"><img src="' + url + '/assets/images/' + icon + '" alt="" title=""/></div>';
                            branch_tab += '<div class="bank_mny">';
                            branch_tab += '<div class="bank_bal">' + bank_bal + '</div>';
                            branch_tab += '<div class="accont_numb" id="dadmin_' + adminacc[i].id + '_' + branches[b].branch_id + '">' + accont_numb + '</div>';
                            branch_tab += '</div>';
                            branch_tab += '</label>';
                            branch_tab += '</div>';
                        }
                        branch_tab += '</li>';
                        branch_tab += '</ul>';
                        branch_tab += '</div>';
                        //Admin Accounts END
                        branch_tab += '</li>';

                        branch_tab += '<li class="bank_' + branches[b].branch_id + '"><div class="cre_inp"><input type="text" class="form-control" id="dname_' + branches[b].branch_id + '" name="dname_' + branches[b].branch_id + '" value="" placeholder="Driver name"/></div></li>';
                        branch_tab += '<li class="bank_' + branches[b].branch_id + '"><div class="cre_inp"><input type="text" class="form-control" id="dacc_' + branches[b].branch_id + '" name="dacc_' + branches[b].branch_id + '" value="" placeholder="Account number"/></div></li>';
                        branch_tab += '<li class="bank_' + branches[b].branch_id + '"><div class="cre_inp"><input type="text" class="form-control" id="difsc_' + branches[b].branch_id + '" name="difsc_' + branches[b].branch_id + '" value="" placeholder="IFC Code"/></div></li>';
                        branch_tab += '<li class="bank_' + branches[b].branch_id + '"><div class="cre_inp"><input type="text" class="form-control" id="dref_' + branches[b].branch_id + '" name="dref_' + branches[b].branch_id + '"  value="" placeholder="Reference Id"/></div></li>';
                        branch_tab += '<li class="upi_cash_' + branches[b].branch_id + '" style="display:none;"><div class="cre_inp"><input type="text" class="form-control" id="dmobile_' + branches[b].branch_id + '" name="dmobile_' + branches[b].branch_id + '" value="" placeholder="Mobile No"/></div></li>';
                        branch_tab += '<li class="upi_cash_' + branches[b].branch_id + '" style="display:none;"><div class="cre_inp"><textarea class="form-control" id="dnote_' + branches[b].branch_id + '" name="dnote_' + branches[b].branch_id + '" colspan="5" placeholder="Note"></textarea></div></li>';
                        branch_tab += '</ul>';
                        //Assign Type End

                        branch_tab += '</div>';
                        //Driver END

                        //}

                        //console.log(purchase_info);
                        if (purchase_info.status == 'PM') {
                            branch_tab += '<div id="error_' + branches[b].branch_id + '" class="clear:both;" style="text-align:right;"></div>';
                            branch_tab += '<div class="po_ftr" id="confirm_' + branches[b].branch_id + '">';
                            branch_tab += '<button type="button" class="btn fr sb_btn btn-primary" onclick="Purchase.confirmBranch(\'' + branches[b].branch_id + '\')"> Confirm </button>';
                            branch_tab += '</div>';
                        } else {
                            if (purchase_info.status == 'CE' && purchase_info.admin_pay_req == 1) {
                                branch_tab += '<div id="error_' + branches[b].branch_id + '" class="clear:both;" style="text-align:right;"></div>';
                                branch_tab += '<div class="po_ftr" id="confirm_' + branches[b].branch_id + '">';
                                branch_tab += '<button type="button" class="btn fr sb_btn btn-primary" onclick="Purchase.payTransportCharges(\'' + branches[b].branch_id + '\')"> Admin Pay </button>';
                                branch_tab += '</div>';
                            }
                        }

                        branch_tab += '</form></div>';
                    }



                    $('#branchplist').append(branch_tab);

                    //Payment Options in branch
                    $('.lnk_typ.ban_trns').click(function() {
                        $(this).addClass('act_type');
                        $('.bktr').show();
                        $('.blk_disb').removeClass('blk_no_dis');
                        $(this).siblings('.cash_trns, .lnk_typ').removeClass('act_type');
                        // $('.blk_disb').addClass('blk_no_dis');
                        $(this).parent().siblings('.ove_auto').find('.lon_typ').removeClass('hide_blk_anim');
                    });

                    $('.lnk_typ.cash_trns').click(function() {
                        $('.bktr').hide();
                        $(this).addClass('act_type');
                        $('.blk_disb').removeClass('blk_no_dis');
                        // $('.blk_disb').addClass('blk_no_dis');
                        $(this).siblings('.ban_trns, .lnk_typ').removeClass('act_type');
                        $(this).parent().siblings('.ove_auto').find('.lon_typ').addClass('hide_blk_anim');
                    });

                    $('.lnk_typ.credit_trns').click(function() {
                        $(this).addClass('act_type');
                        $('.blk_disb').addClass('blk_no_dis');
                        $(this).siblings('.ban_trns, .cash_trns').removeClass('act_type');
                        $(this).parent().siblings('.ove_auto').find('.lon_typ').addClass('hide_blk_anim');
                    });

                    $('.check_wt_serc.check_wt_serc_cstm').click(function() {
                        $(".check_wt_serc.check_wt_serc_cstm").not(this).removeClass('act_v');
                        $(this).toggleClass('act_v')
                        $(".check_wt_serc.check_wt_serc_cstm").not(this).find('.check_list').removeClass('show_chk');
                        $(this).find('.check_list').toggleClass('show_chk');
                    });

                    for (var d = 0; d < branches.length; d++) {
                        var ddate_txt = branches[d].branch_id;
                        $("#ddate_" + branches[d].branch_id).datepicker({
                            beforeShow: function() {
                                setTimeout(function() {
                                    $('.ui-datepicker').css('z-index', 99999999999999);
                                }, 0);
                            },
                            dateFormat: 'dd-M-yy',
                            //defaultDate: "+1w",
                            changeMonth: true,
                            changeYear: true,
                            minDate: dateToday,
                            numberOfMonths: 1,
                            onSelect: function(selected) {
                                $('#ddate_txt_' + ddate_txt).text('');
                                //event.stopPropagation();
                                // $("#start_date").parent().addClass('inp_ss');
                                // $("#start_date").removeClass('error');
                                // str = selected.split("-").join(" ");
                                //var dt = new Date(str);
                                //dt.setDate(dt.getDate() + 1);
                                //$("#end_date").datepicker("option", "minDate", dt);
                            }
                        });
                    }

                    $(".allownumericwithoutdecimal").on("keypress keyup blur", function(event) {
                        $(this).val($(this).val().replace(/[^\d].+/, ""));
                        if ((event.which < 48 || event.which > 57)) {
                            event.preventDefault();
                        }
                    });


                    setTimeout(function() {
                        //
                    }, 2000);


                    $('#overlay_id').hide();
                    //Purchase.loadSelect();
                });

        },
        openBranch: function(branch_id, ev) {

            //bp_,bpc_
            if (ev.target.id != "") {
                var ob_arr = ev.target.id.split('_');
                //console.log(ob_arr);
                if (ob_arr[0] == 'bp' || ob_arr[0] == 'bpc' || ob_arr[0] == 'search') {
                    return;
                }

            }

            var bb_id = $('#bb_' + branch_id);
            var blist = $('#blist_' + branch_id);
            if (bb_id.hasClass("act_v")) {
                bb_id.removeClass('act_v');
                blist.removeClass('show_chk');
                //$(".check_wt_serc").not(this_ev).removeClass('act_v');
                //$(".check_wt_serc").not(this_ev).find('.check_list').removeClass('show_chk');
            } else {
                bb_id.addClass('act_v');
                blist.addClass('show_chk');
                //$(this_ev).toggleClass('act_v');
                //$(this_ev).find('.check_list').toggleClass('show_chk');
            }
        },
        searchElements: function(branch_id) {
            // Declare variables
            var input, filter, ul, li, a, i, txtValue;
            input = document.getElementById('search_' + branch_id);
            filter = input.value.toUpperCase();
            ul = document.getElementById("bpglist_" + branch_id);
            li = ul.getElementsByTagName('div');

            // Loop through all list items, and hide those who don't match the search query
            for (i = 0; i < li.length; i++) {
                //a = li[i].getElementsByTagName("a")[0];
                a = li[i].getElementsByTagName("label")[0];
                txtValue = a.textContent || a.innerText;

                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    li[i].style.display = "";
                } else {
                    li[i].style.display = "none";
                }
            }
        },
        showAccounts: function(id) {
            // var adminacc=$('#adminacc_'+id);
            // var banklist=$('#banklist_'+id);
            // if(adminacc.hasClass("act_v")){
            // 	adminacc.removeClass('act_v');
            // 	banklist.removeClass('show_chk');
            // }else{
            // 	adminacc.addClass('act_v');
            // 	banklist.addClass('show_chk');
            // }
        },
        selectAccount: function(id, blistid, bid) {
            var parent_id = id;
            var blistid = blistid;
            var bid = bid;
            var acc_text = $('#' + parent_id + '_' + bid).text().trim();
            if (parent_id == 'admin') {
                $('#adminVal').text(acc_text);
                $('#adminacc_' + parent_id).addClass('val_seld');
                $("input[name='adminacc'][value='" + bid + "']").prop('checked', true);
            } else {
                $('#cobankVal').text(acc_text);
                $("input[name='coacc'][value='" + bid + "']").prop('checked', true);
            }

            var adminacc = $('#adminacc_' + parent_id);
            var banklist = $('#banklist_' + id);
            setTimeout(function() {
                adminacc.removeClass('act_v');
                banklist.removeClass('show_chk');
            }, 200);

        },
        selectTsAccount: function(id, blistid, bid, branch_id) {
            var branch_id = branch_id;
            var parent_id = id;
            var blistid = blistid;
            var bid = bid;
            var acc_text = $('#' + parent_id + '_' + bid + '_' + branch_id).text().trim();
            $('#dadminacc' + '_' + branch_id).text(acc_text);
            $('#dadmin_' + branch_id).addClass('val_seld');
            $("input[name='dadminacc_" + branch_id + "'][value='" + bid + "']").prop('checked', true);

            var adminacc = $('#dadmin_' + branch_id);
            var banklist = $('#dbanklist_' + branch_id);
            setTimeout(function() {
                adminacc.removeClass('act_v');
                banklist.removeClass('show_chk');
            }, 200);
        },
        assignType: function(attr_text, branch_id) {
            $("input[name='act_types_" + branch_id + "'][value='" + attr_text + "']").prop('checked', true);
            $('#error_' + branch_id).empty();

            if (attr_text == 'bank') {
                $('.bank_' + branch_id).show();
                $('.upi_cash_' + branch_id).hide();
            } else {
                $('.bank_' + branch_id).hide();
                $('.upi_cash_' + branch_id).show();
            }
        },
        confirmation: function(step) {
            //confirm_r,payment,received
            //console.log(step);
            // if(){
            // }else{
            // }
        },
        purchaseConfirm: function() {
            //Validation for branch products
            //brand_id:ebrand_id,ap_id:ap_id
            $('#overlay_id').show();
            jQuery.post(API_URL + '/confirmrequest', { brand_id: ebrand_id, ap_id: ap_id })
                .done(function(data) {
                    var res = $.parseJSON(data);
                    if (res.update_status) {
                        formsteps.confirm = true;
                        $('#confirm_id').hide();

                        //Step 2
                        $('#payment').addClass('act_tb').removeClass('dne_tb');
                        $('.fst_step').removeClass('act_tb').addClass('dne_tb');
                        $('.thrd_step, .fth_step, .fst_step').removeClass('act_tb dne_tb');
                        $('.bdr_blue').css('width', '75px');
                        $('.paid_amont_bb').hide();
                        $('.confrm_blk').hide();
                        $('.pay_sec').show();
                        $('.comp_blk, .ord_comp_blk').hide();

                        Purchase.updateRequest();
                    }

                    $('#overlay_id').hide();
                });
        },
        payType: function(ptype) {
            $("input[name='act_pay_types'][value='" + ptype + "']").prop('checked', true);
            $('#step2_errmsg').empty();
        },
        doPayment: function() {
            $('#step2_errmsg').empty();
            //Step 2
            var act_types = $("input[name='act_pay_types']:checked").val();
            var tot_pcamt = $('#tot_pcamt').val();
            var refno = $('#refno').val();

            var error = '';
            if (act_types == 'bank') {
                var paydate = $('#paydate').val();
                var adminacc = $("input[name='adminacc']:checked").val();
                //console.log(adminacc);
                var coacc = $("input[name='coacc']:checked").val();

                if (paydate == '' || typeof paydate === "undefined") {
                    error += '<p style="color:red;">Date is required</p>';
                }

                if (adminacc == '' || typeof adminacc === "undefined") {
                    error += '<p style="color:red;">Bank account is required</p>';
                }

                if (coacc == '' || typeof coacc === "undefined") {
                    error += '<p style="color:red;">Company bank account is required</p>';
                }

                if (refno == '' || typeof refno === "undefined") {
                    error += '<p style="color:red;">Reference number is required</p>';
                }

                if (tot_pcamt <= 0) {
                    error += '<p style="color:red;">Purchase amount is required</p>';
                }

                var params = {
                    'act_types': act_types,
                    'tot_pcamt': tot_pcamt,
                    'paydate': paydate,
                    'adminacc': adminacc,
                    'coacc': coacc,
                    'refno': refno,
                    'tot_amt': tot_pcamt
                };
            } else if (act_types == 'cash') {
                var params = {
                    'act_types': act_types,
                    'tot_pcamt': tot_pcamt,
                    'refno': refno,
                    'tot_amt': tot_pcamt
                };
            } else {
                var params = {
                    'act_types': act_types,
                    'tot_pcamt': tot_pcamt,
                };
            }

            params.brand_id = ebrand_id;
            params.ap_id = ap_id;

            if (error != '') {
                $('#step2_errmsg').append(error);
                return false;
            }

            $('#overlay_id').show();
            jQuery.post(API_URL + '/dopayment', params)
                .done(function(data) {
                    var result = $.parseJSON(data);
                    if (result.is_payment_done) {
                        $('#paybtn').hide();

                        //Step 3
                        $('#received').addClass('act_tb').removeClass('dne_tb');
                        $('.fst_step, .fth_step').removeClass('act_tb').addClass('dne_tb');
                        $('.sec_step').removeClass('act_tb').addClass('dne_tb');
                        $('.bdr_blue').css('width', '150px');
                        $('.pay_sec, .ord_comp_blk').hide();
                        $('.comp_blk').show();
                        $('.show_dtl').click(function() {
                            var scrollTop = $('.brn_lst').offset().top - 50;
                            $('.comp_blk .ord_comp_bl').animate({
                                scrollTop: $(".brn_lst").offset().top - 50
                            }, 1000);
                        });

                        Purchase.updateRequest();
                    } else {
                        $('#overlay_id').hide();
                    }

                });
            //console.log(error);
        },
        loadSelect: function() {
            /*$('.paycheck').click(function(){
            	//console.log('####');
                $(".paycheck").not(this).removeClass('act_v');
                $(this).toggleClass('act_v')
                $(".paycheck").not(this).find('.check_list').removeClass('show_chk');
                $(this).find('.check_list').toggleClass('show_chk');
                $(".check_list input[type='radio']").change(function(){
            		var val =$(this).siblings('label').text();
                    $(this).parent().parent('li').parent('ul').parent('.paycheck').find('.selectVal').text(val);
                    $(this).parent().parent('li').parent('ul').removeClass('show_chk');
                    $(this).parent().parent('li').parent('ul').parent('.paycheck').removeClass('act_v').addClass('val_seld');
                });

            });*/
        },
        selectAdminAcc: function(ev, bid) {
            ev.stopPropagation();
            //var data=jQuery.parseJSON($('#'+bid).attr("data-acc"));
            //var data=$('#'+bid).attr("data-acc");
            console.log(bid);
            //var res=$.parseJSON(response);
            // console.log(parent_id+'=='+banklist+'=='+acc_id);
            // console.log('#'+banklist);
            // //adminVal
            // setTimeout(function(){
            // 	$('#'+banklist).removeClass('show_chk');
            // 	$('#'+parent_id).removeClass('act_v').addClass('val_seld');
            // },100);

            //$(this).parent().parent('li').parent('ul').removeClass('show_chk');
            //$(this).parent().parent('li').parent('ul').parent('#adminacc').removeClass('act_v').addClass('val_seld');
        },
        updateBranchProd: function(branch_id) {
            //console.log(branch_id);
            //bp_4[]
            //bpc_
            var selected_prod = [];
            var checked_prod = 0;
            var branch_name = $('#branch_name_' + branch_id).text();
            var bp_id = $('#branch_name_' + branch_id).attr('data-bp-id');
            var bprod_list = $('input[name="bp_' + branch_id + '[]"]');
            for (var i = 0; i < bprod_list.length; i++) {
                //console.log(bprod_list[i].value);
                var pid = bprod_list[i].value;
                var is_checked = $('#bp_' + branch_id + '_' + pid).attr("checked");
                //$('#bp_3_69').attr("checked");				
                //console.log(is_checked+'--#bpc_'+branch_id+'_'+pid);
                if (is_checked == 'checked') {
                    //console.log(pid);
                    var pqty = $('#bpc_' + branch_id + '_' + pid).val();
                    var pname = $('#bpname_' + branch_id + '_' + pid).text();
                    var price = $('#bpname_' + branch_id + '_' + pid).attr('data-price');
                    var bpd_id = $('#bpname_' + branch_id + '_' + pid).attr('data-bpd-id');
                    //console.log(pid+'==='+pqty);
                    var product = { 'pname': pname, 'pid': pid, 'qty': pqty, 'price': price, 'bpd_id': bpd_id };
                    selected_prod.push(product);
                }

            }

            if (selected_prod.length == 0) {
                new PNotify({
                    title: branch_name,
                    text: 'Please select product and enter quantity',
                    type: 'failure',
                    shadow: true
                });
                return;
            }

            for (var j = 0; j < selected_prod.length; j++) {
                //console.log(selected_prod[j]);
                if (selected_prod[j].qty == "" || selected_prod[j].qty == 0 || typeof selected_prod[j].qty === "undefined") {
                    new PNotify({
                        title: branch_name,
                        text: selected_prod[j].pname + ' quantity required',
                        type: 'failure',
                        shadow: true
                    });
                    return;
                }
            }

            //console.log(bprod_list);
            //branch_id,brand_id:ebrand_id,ap_id:ap_id
            $('#overlay_id').show();
            var params = {
                brand_id: ebrand_id,
                ap_id: ap_id,
                branch_id: branch_id,
                bp_id: bp_id,
                selected_prod: selected_prod
            };
            jQuery.post(API_URL + '/adminUpdateBranchProd', params)
                .done(function(data) {
                    var result = $.parseJSON(data);
                    if (result.update_staus) {
                        Purchase.updateRequest();
                    } else {
                        $('#overlay_id').hide();
                    }

                });

        },
        isChecked: function(branch_id, pid) {
            var is_checked = $('#bp_' + branch_id + '_' + pid).attr("checked");
            if (is_checked == 'checked') {
                $('#bp_' + branch_id + '_' + pid).attr("checked", false);
                $('#fcheck_' + branch_id + '_' + pid).removeClass('checkd');
                Purchase.deleteBranchProd(branch_id, pid);
            } else {
                $('#bp_' + branch_id + '_' + pid).attr("checked", true);
                $('#fcheck_' + branch_id + '_' + pid).addClass('checkd');
            }
        },
        deleteBranchProd: function(branch_id, pid) {
            //console.log(branch_id+'==='+pid);
            $('#overlay_id').show();
            var branch_name = $('#branch_name_' + branch_id).text();
            var bp_id = $('#branch_name_' + branch_id).attr('data-bp-id');
            var pname = $('#bpname_' + branch_id + '_' + pid).text();
            var bpd_id = $('#bpname_' + branch_id + '_' + pid).attr('data-bpd-id');
            var params = {
                brand_id: ebrand_id,
                ap_id: ap_id,
                branch_id: branch_id,
                bp_id: bp_id,
                pid: pid,
                bpd_id: bpd_id
            };
            jQuery.post(API_URL + '/adminDelBranchProd', params)
                .done(function(data) {
                    var result = $.parseJSON(data);
                    if (result.branch_reset) {
                        Purchase.updateRequest();
                        setTimeout(function() {
                            new PNotify({
                                title: branch_name,
                                text: pname + ' deleted successfully!',
                                type: 'success',
                                shadow: true
                            });
                        }, 1000);
                    } else {
                        $('#overlay_id').hide();
                    }
                });
        },
        updateRequest: function() {
            formsteps = {
                pending: false,
                confirm: false,
                payment: false,
                received: false,
                complete: false
            };

            jQuery.post(API_URL + '/editrequest', { brand_id: ebrand_id, ap_id: ap_id })
                .done(function(data) {
                    $('#all_prods').empty();
                    $('#banklist_admin').empty();
                    $('#banklist_co').empty();
                    $('#myTab').empty();
                    $('#branchplist').empty();
                    var prod_list = '';
                    var branch_list = '';

                    var res = $.parseJSON(data);
                    var brand_info = res.brand_info;
                    var purchase_info = res.purchase_info;

                    //P-pending,C-confirm,PM-payment,BC-branch confirm,CE-Complete
                    if (purchase_info.status == 'P') {
                        formsteps.pending = true;
                        $('#confirm').addClass('act_tb').removeClass('dne_tb');
                        $('.confrm_blk').show();
                        $('#confirm_id').show();
                        $('#paybtn').hide();
                        $('.sec_step, .fth_step, .thrd_step').removeClass('act_tb dne_tb');
                        $('.thrd_step').removeClass('act_tb dne_tb');
                        $('.bdr_blue').removeAttr('style');
                        $('.paid_amont_bb').hide();
                        $('.pay_sec').hide();
                        $('#do_payment').show();
                        $('#payment_info_block').hide();
                        $('#payment_info').empty();
                        $('.comp_blk, .ord_comp_blk').hide();
                    } else if (purchase_info.status == 'C') {
                        formsteps.confirm = true;
                        $('#confirm_id').hide();

                        $('.fst_step').click(function() {
                            $(this).addClass('act_tb').removeClass('dne_tb');
                            $('.confrm_blk').show();
                            $('.sec_step, .fth_step, .thrd_step').removeClass('act_tb dne_tb');
                            $('.thrd_step').removeClass('act_tb dne_tb');
                            $('.bdr_blue').removeAttr('style');
                            $('.paid_amont_bb').hide();
                            $('.pay_sec').hide();
                            $('.comp_blk, .ord_comp_blk').hide();
                        });
                        $('.thrd_step').click(function() {
                            $('.confrm_blk').hide();
                            $(this).addClass('act_tb').removeClass('dne_tb');
                            $('.fst_step, .fth_step').removeClass('act_tb').addClass('dne_tb');
                            $('.sec_step').removeClass('act_tb').addClass('dne_tb');
                            $('.bdr_blue').css('width', '150px');
                            // $('.paid_amont_bb').show();
                            $('.pay_sec, .ord_comp_blk').hide();
                            $('.comp_blk').show();
                            $('.show_dtl').click(function() {
                                var scrollTop = $('.brn_lst').offset().top - 50;
                                $('.comp_blk .ord_comp_bl').animate({
                                    scrollTop: $(".brn_lst").offset().top - 50
                                }, 1000);
                            });
                        });

                        //Step 2
                        $('#payment').addClass('act_tb').removeClass('dne_tb');

                        //Step 1
                        $('.fst_step').removeClass('act_tb').addClass('dne_tb');
                        $('.thrd_step, .fth_step, .fst_step').removeClass('act_tb dne_tb');
                        $('.bdr_blue').css('width', '75px');
                        $('.paid_amont_bb').hide();
                        $('.confrm_blk').hide();
                        $('.pay_sec').show();
                        $('#paybtn').show();
                        $('.comp_blk, .ord_comp_blk').hide();
                    } else if (purchase_info.status == 'PM') {
                        //Default
                        $('#ptype_bank').attr('checked', true);
                        formsteps.payment = true;
                        $('#confirm_id').hide();
                        $('#paybtn').hide();

                        //Step 1
                        $('.fst_step').removeClass('act_tb').addClass('dne_tb');
                        $('.thrd_step, .fth_step, .fst_step').removeClass('act_tb dne_tb');
                        $('.bdr_blue').css('width', '75px');
                        $('.paid_amont_bb').hide();
                        $('.confrm_blk').hide();
                        $('.pay_sec').show();
                        $('.comp_blk, .ord_comp_blk').hide();

                        //Step 2
                        $('.sec_step').addClass('act_tb').removeClass('dne_tb');

                        //Step 3
                        $('#received').addClass('act_tb').removeClass('dne_tb');
                        $('.fst_step, .fth_step').removeClass('act_tb').addClass('dne_tb');
                        $('.sec_step').removeClass('act_tb').addClass('dne_tb');
                        $('.bdr_blue').css('width', '150px');
                        $('.pay_sec, .ord_comp_blk').hide();
                        $('.comp_blk').show();
                        $('.show_dtl').click(function() {
                            var scrollTop = $('.brn_lst').offset().top - 50;
                            $('.comp_blk .ord_comp_bl').animate({
                                scrollTop: $(".brn_lst").offset().top - 50
                            }, 1000);
                        });

                        $('#do_payment').hide();
                        $('#payment_info_block').show();
                        $('#payment_info').empty();

                        var payment_info = '';
                        payment_info += '<tr><td>Payment Type</td><td class="text_cent qty_pp">' + purchase_info.ptype + '</td></tr>';
                        if (purchase_info.payment_type == 'BK') {
                            payment_info += '<tr><td width="50%">Date</td><td class="text_cent qty_pp">' + purchase_info.payment_date + '</td></tr>';
                            payment_info += '<tr><td width="50%">Admin Bank Acc NO</td><td class="text_cent qty_pp">' + purchase_info.admin_acc_name + '-' + purchase_info.admin_acc + '</td></tr>';
                            payment_info += '<tr><td width="50%">Company Bank Acc NO</td><td class="text_cent qty_pp">' + purchase_info.co_acc_name + '-' + purchase_info.co_acc + '</td></tr>';
                            payment_info += '<tr><td width="50%">Ref.Number</td><td class="text_cent qty_pp">' + purchase_info.refno + '</td></tr>';
                            payment_info += '<tr><td width="50%">Note</td><td class="text_cent qty_pp">' + purchase_info.note + '</td></tr>';
                        } else if (purchase_info.payment_type == 'CH') {
                            payment_info += '<tr><td width="50%">Ref.Number</td><td class="text_cent qty_pp">' + purchase_info.refno + '</td></tr>';
                            payment_info += '<tr><td width="50%">Note</td><td class="text_cent qty_pp">' + purchase_info.note + '</td></tr>';
                        } else {

                        }

                        var total_price = parseInt(purchase_info.total_price);
                        payment_info += '<tr><td class="text_rt ttl_amnt">Total Amount</td><td class="blue_text text_rt ttl_amnt">₹' + Purchase.addCommasinamt(total_price) + '</td></tr>';
                        payment_info += '<tr><td class="text_rt ttl_amnt">Paid Amount</td><td class="blue_text text_rt ttl_amnt">₹' + Purchase.addCommasinamt(purchase_info.trasaction_info.total_amount) + '</td></tr>';

                        $('#payment_info').append(payment_info);

                    } else if (purchase_info.status == 'CE') {
                        formsteps.complete = true;
                        $('#confirm_id').hide();
                        $('#paybtn').hide();

                        //Step 1
                        $('.fst_step').removeClass('act_tb').addClass('dne_tb');
                        $('.thrd_step, .fth_step, .fst_step').removeClass('act_tb dne_tb');
                        $('.bdr_blue').css('width', '75px');
                        $('.paid_amont_bb').hide();
                        $('.confrm_blk').hide();
                        $('.pay_sec').show();
                        $('.comp_blk, .ord_comp_blk').hide();

                        //Step 2
                        $('.sec_step').addClass('act_tb').removeClass('dne_tb');

                        //Step 3
                        $('#received').addClass('act_tb').removeClass('dne_tb');
                        $('.fst_step, .fth_step').removeClass('act_tb').addClass('dne_tb');
                        $('.sec_step').removeClass('act_tb').addClass('dne_tb');
                        $('.bdr_blue').css('width', '150px');
                        $('.pay_sec, .ord_comp_blk').hide();
                        $('.comp_blk').show();
                        $('.show_dtl').click(function() {
                            var scrollTop = $('.brn_lst').offset().top - 50;
                            $('.comp_blk .ord_comp_bl').animate({
                                scrollTop: $(".brn_lst").offset().top - 50
                            }, 1000);
                        });
                    }

                    var products = res.products;
                    var branches = res.branches;
                    var adminacc = res.adminacc;
                    var coacc = res.coacc;
                    $('#brand_title').html(brand_info.brand_name);
                    $('#cname').html(brand_info.brand_name);

                    //step 1
                    //brand_title,branch_list,all_prods

                    //Branches
                    $('#branch_list').empty();
                    for (var b = 0; b < branches.length; b++) {
                        //console.log(branches[b]);
                        var branch_prod = branches[b].products;
                        var pcnt = branch_prod.length;
                        var bpurchase_info = branches[b].purchase_info;

                        branch_list += '<li onclick="Purchase.openBranch(' + branches[b].branch_id + ',event);">';
                        //branch_list+='<div>';
                        branch_list += '<div class="check_wt_serc_new check_wt_serc val_seld" id="bb_' + branches[b].branch_id + '">';
                        branch_list += '<div>';
                        branch_list += '<div class="show_va" id="branch_name_' + branches[b].branch_id + '" data-bp-id="' + branches[b].purchase_info.bp_id + '">' + branches[b].branch_name + '</div>';
                        branch_list += '<div class="selectVal">Products(' + pcnt + ')</div>';
                        branch_list += '<ul class="check_list" id="blist_' + branches[b].branch_id + '">';

                        branch_list += '<li>';
                        branch_list += '<div class="form-group" id="bsearch_' + branches[b].branch_id + '"><input type="text" class="form-control" placeholder="Search Branch" id="search_' + branches[b].branch_id + '" onkeyup="Purchase.searchElements(' + branches[b].branch_id + ');"/></div>';
                        branch_list += '</li>';

                        branch_list += '<li id="bpglist_' + branches[b].branch_id + '">';
                        for (var p = 0; p < branch_prod.length; p++) {
                            //console.log(branch_prod[p]);
                            //branch_list+='<li>';
                            branch_list += '<div class="form-check chek_bx checkd" id="fcheck_' + branches[b].branch_id + '_' + branch_prod[p].pid + '"><input class="form-check-input" type="checkbox" id="bp_' + branches[b].branch_id + '_' + branch_prod[p].pid + '" name="bp_' + branches[b].branch_id + '[]" value="' + branch_prod[p].pid + '" checked="checked" onclick="Purchase.isChecked(' + branches[b].branch_id + ',' + branch_prod[p].pid + ');"/><label class="form-check-label" for="uss_' + branches[b].branch_id + '_' + branch_prod[p].pid + '" id="bpname_' + branches[b].branch_id + '_' + branch_prod[p].pid + '" data-price="' + branch_prod[p].price + '" data-bpd-id="' + branch_prod[p].bpd_id + '">' + branch_prod[p].pname + '</label><input type="text" class="cnt allownumericwithoutdecimal" placeholder="count" id="bpc_' + branches[b].branch_id + '_' + branch_prod[p].pid + '" name="bpc_' + branches[b].branch_id + '[]" value="' + branch_prod[p].quantity + '" style="opacity:1 !important;"/></div>';
                            //branch_list+='</li>';
                        }

                        //Extra Products
                        var extra_products = branches[b].extra_products;
                        if (extra_products.length > 0) {
                            for (var e = 0; e < extra_products.length; e++) {
                                //branch_list+='<li>';
                                branch_list += '<div class="form-check chek_bx" id="fcheck_' + branches[b].branch_id + '_' + extra_products[e].pid + '"><input class="form-check-input" type="checkbox" id="bp_' + branches[b].branch_id + '_' + extra_products[e].pid + '" name="bp_' + branches[b].branch_id + '[]" value="' + extra_products[e].pid + '" onclick="Purchase.isChecked(' + branches[b].branch_id + ',' + extra_products[e].pid + ');"/><label class="form-check-label" for="uss_' + branches[b].branch_id + '_' + extra_products[e].pid + '" id="bpname_' + branches[b].branch_id + '_' + extra_products[e].pid + '" data-price="' + extra_products[e].purchase_amt + '" data-bpd-id="">' + extra_products[e].pname + '</label><input type="text" class="cnt allownumericwithoutdecimal" placeholder="count" id="bpc_' + branches[b].branch_id + '_' + extra_products[e].pid + '" name="bpc_' + branches[b].branch_id + '[]" value="' + extra_products[e].quantity + '" style="opacity:1 !important;"/></div>';
                                //branch_list+='</li>';
                            }
                        }
                        branch_list += '</li>';
                        if (bpurchase_info.status == 'P' || bpurchase_info.status == 'C' || bpurchase_info.status == 'PM') {
                            branch_list += '<li><button class="btn save_blk btn-primary" onclick="Purchase.updateBranchProd(' + branches[b].branch_id + ');">Save</button></li>';
                        }

                        branch_list += '</ul>';
                        branch_list += '</div>';
                        branch_list += '<div>';
                        branch_list += '</li>';

                    }
                    $('#branch_list').append(branch_list);

                    //Product List
                    var tot_amt = 0;
                    for (var i = 0; i < products.length; i++) {
                        var price = Purchase.addCommasinamt(parseInt(products[i].price));
                        var total_price = Purchase.addCommasinamt(parseInt(products[i].total_price));
                        tot_amt = tot_amt + parseInt(products[i].total_price);
                        prod_list += '<tr id="pindex_' + i + '">';
                        prod_list += '<td>' + products[i].pname + '</td>';
                        prod_list += '<td class="text_cent qty_pp">' + products[i].quantity + '</td>';
                        prod_list += '<td data-toggle="tooltip" data-placement="top" title="MRP:' + price + '" class="text_rt qty_prc"><input type="text" value="' + price + '" class="text_rt" name="" /></td>';
                        prod_list += '<td class="text_rt">' + total_price + '</td>';
                        prod_list += '</tr>';
                    }
                    var tot_amt_new = '₹' + Purchase.addCommasinamt(tot_amt);
                    prod_list += '<tr>';
                    prod_list += '<td colspan="3" class="text_rt ttl_amnt">Total Amount</td>';
                    prod_list += '<td class="blue_text text_rt ttl_amnt">' + tot_amt_new + '</td>';
                    prod_list += '</tr>';
                    $('#all_prods').append(prod_list);

                    //Total Purchase Amount
                    $('#tot_pcamt').val(Purchase.addCommasinamt(tot_amt));

                    //step 2
                    //bankVal,banklist,cobankVal,cobanklist
                    var dateToday = new Date();
                    $("#paydate").datepicker({
                        beforeShow: function() {
                            setTimeout(function() {
                                $('.ui-datepicker').css('z-index', 99999999999999);
                            }, 0);
                        },
                        dateFormat: 'dd-M-yy',
                        //defaultDate: "+1w",
                        changeMonth: true,
                        changeYear: true,
                        minDate: dateToday,
                        numberOfMonths: 1,
                        onSelect: function(selected) {
                            $('#paydatetxt').text('');
                            //event.stopPropagation();
                            // $("#start_date").parent().addClass('inp_ss');
                            // $("#start_date").removeClass('error');
                            // str = selected.split("-").join(" ");
                            //var dt = new Date(str);
                            //dt.setDate(dt.getDate() + 1);
                            //$("#end_date").datepicker("option", "minDate", dt);
                        }
                    });

                    //Admin Accounts
                    var admin_acc = '<li>';
                    for (var i = 0; i < adminacc.length; i++) {
                        var icon = adminacc[i].account_name.toLowerCase() + '_icn.png';
                        var bank_bal = '₹' + Purchase.addCommasinamt(adminacc[i].avail_amount);
                        var accont_numb = adminacc[i].account_number;
                        admin_acc += '<div class="form-check" onclick="Purchase.selectAccount(\'admin\',\'banklist\',\'' + adminacc[i].id + '\')">';
                        admin_acc += '<input class="form-check-input" type="radio" name="adminacc" id="adinput_' + adminacc[i].id + '" value="' + adminacc[i].id + '"/>';
                        admin_acc += '<label class="form-check-label" for="adlb_' + adminacc[i].id + '">';
                        admin_acc += '<div class="bank_logo"><img src="' + url + '/assets/images/' + icon + '" alt="" title=""/></div>';
                        admin_acc += '<div class="bank_mny">';
                        admin_acc += '<div class="bank_bal">' + bank_bal + '</div>';
                        admin_acc += '<div class="accont_numb" id="admin_' + adminacc[i].id + '">' + accont_numb + '</div>';
                        admin_acc += '</div>';
                        admin_acc += '</label>';
                        admin_acc += '</div>';
                    }
                    admin_acc += '</li>';
                    $('#banklist_admin').append(admin_acc);

                    var co_acc = '<li>';
                    for (var i = 0; i < coacc.length; i++) {
                        var icon = coacc[i].bank_name.toLowerCase() + '_icn.png';
                        var accont_numb = coacc[i].account_no;
                        co_acc += '<div class="form-check" onclick="Purchase.selectAccount(\'co\',\'banklist\',\'' + coacc[i].acc_id + '\')">';
                        co_acc += '<input class="form-check-input" type="radio" name="coacc" id="coinput_' + coacc[i].acc_id + '" value="' + coacc[i].acc_id + '"/>';
                        co_acc += '<label class="form-check-label" for="colb_' + coacc[i].acc_id + '">';
                        co_acc += '<div class="bank_logo"><img src="' + url + '/assets/images/' + icon + '" alt="" title=""/></div>';
                        co_acc += '<div class="bank_mny">';
                        co_acc += '<div class="accont_numb" id="co_' + coacc[i].acc_id + '">' + accont_numb + '</div>';
                        co_acc += '</div>';
                        co_acc += '</label>';
                        co_acc += '</div>';
                    }
                    co_acc += '</li>';
                    $('#banklist_co').append(co_acc);

                    //step 3
                    //cname,branchplist
                    //myTab
                    var branch = '';
                    for (var b = 0; b < branches.length; b++) {
                        var active = '';
                        if (b == 0) {
                            active = 'active';
                        }
                        branch += '<li class="nav-item ' + active + '">';
                        branch += '<a class="nav-link ' + active + '" data-toggle="tab" href="#branch' + branches[b].branch_id + '" role="tab" aria-controls="home" aria-selected="true">' + branches[b].branch_name + '</a>';
                        branch += '</li>';
                    }
                    $('#myTab').append(branch);

                    //Tab Content
                    var branch_tab = '';
                    for (var b = 0; b < branches.length; b++) {
                        var active = '';
                        var purchase_info = branches[b].purchase_info;
                        var prods = branches[b].products;

                        if (purchase_info.status == 'CE') {
                            var ts_charges = '';
                            if (purchase_info.admin_pay_req == 1) {
                                ts_charges += '(<span style="color:red;">Transport charges not paid</span>)';
                            }
                            var status = 'Confirmed' + ts_charges;
                            var status_cls = 'grn_clr';
                        } else {
                            var status = 'Pending';
                            var status_cls = 'pen_st';
                        }

                        if (purchase_info.upload_invoice != '') {
                            var upload_invoice = 'Invoice uploaded';
                            var cls = 'grn_clr';
                        } else {
                            var upload_invoice = 'Invoice not uploaded';
                            var cls = 'pen_st';
                        }

                        if (b == 0) {
                            active = 'show active';
                        }

                        //<form id="branch_edit_'+branches[b].branch_id+'" name="branch_edit_'+branches[b].branch_id+'" enctype="multipart/form-data">
                        branch_tab += '<div class="order_hist tab-pane fade ' + active + '" id="branch' + branches[b].branch_id + '"><form id="branch_edit_' + branches[b].branch_id + '" name="branch_edit" enctype="multipart/form-data">';
                        branch_tab += '<h2 class="create_hdg"><span class="' + status_cls + '">' + status + '</span> &nbsp;&nbsp;<span class="gry_clr">I</span>&nbsp;&nbsp; <span class="' + cls + '"> ' + upload_invoice + ' </span></h2>';
                        branch_tab += '<table class="ord_lst mar_tp_non" cellspacing="0" cellpadding="0" border="0">';
                        branch_tab += '<thead>';
                        branch_tab += '<tr>';
                        branch_tab += '<th>Product Name</th>';
                        branch_tab += '<th>Qty</th>';
                        branch_tab += '<th>Purchase Amount</th>';
                        branch_tab += '<th>Total</th>';
                        branch_tab += '</tr>';

                        /*branch_list+='<div class="form-check"><input class="form-check-input" type="checkbox" id="bp_'+branches[b].branch_id+'_'+extra_products[e].pid+'" name="bp_'+branches[b].branch_id+'_'+extra_products[e].pid+'" value="'+extra_products[e].pid+'"/><label class="form-check-label" for="uss1">'+extra_products[e].pname+'</label><input type="text" class="cnt" placeholder="count" id="bpc_'+branches[b].branch_id+'_'+extra_products[e].pid+'" name="bpc_'+branches[b].branch_id+'_'+extra_products[e].pid+'" value="'+extra_products[e].quantity+'"/></div>';
                        branch_list+='</li>';*/

                        //Branch Products
                        var btot_amt = 0;
                        for (var i = 0; i < prods.length; i++) {
                            var price = Purchase.addCommasinamt(parseInt(prods[i].price));
                            var total_price = Purchase.addCommasinamt(parseInt(prods[i].total_price));
                            btot_amt += parseInt(prods[i].total_price);
                            branch_tab += '<tr>';
                            branch_tab += '<td>' + prods[i].pname + '</td>';
                            branch_tab += '<td>' + prods[i].quantity + '</td>';
                            branch_tab += '<td data-toggle="tooltip" data-placement="top" title="MRP:' + total_price + '" class="text_rt">' + price + '</td>';
                            branch_tab += '<td class="text_rt">' + total_price + '</td>';
                            branch_tab += '</tr>';
                            if ((i + 1) == prods.length) {
                                // branch_tab+='<tr id="searchtrid_'+branches[b].branch_id+'">';
                                // branch_tab+='<td colspan="4"><input id="search" name="search" type="text" value="" placeholder="Search product"/></td>';
                                // branch_tab+='</tr>';
                                branch_tab += '<tr><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td></td></tr>';
                            }
                        }
                        var btot_amt_str = '';
                        btot_amt_str = Purchase.addCommasinamt(btot_amt);
                        branch_tab += '<tr>';

                        //Admin Payment status
                        var admin_pay_staus = purchase_info.status;
                        if (admin_pay_staus) {

                        }

                        if (purchase_info.upload_invoice == '') {
                            branch_tab += '<td class=""><a href="#" class="invoice_up"><label for="fine_inv_' + branches[b].branch_id + '"><i class="fa fa-paperclip" aria-hidden="true"></i> Upload Invoice<input type="file" id="fine_inv_' + branches[b].branch_id + '" name="fine_inv_' + branches[b].branch_id + '" accept="application/pdf,image/jpg,image/jpeg,image/png" onchange="Purchase.uploadInvoice(event,' + branches[b].branch_id + ');"></label><p id="invoice_file_' + branches[b].branch_id + '"></p></a></td>';
                        } else {
                            branch_tab += '<td class=""></td>';
                        }


                        branch_tab += '<td colspan="2" class="grd_ttl text_rt">Total Amount</td>';
                        branch_tab += '<td class="blue_text text_rt">' + btot_amt_str + '</td>';
                        branch_tab += '</tr>';

                        //Uploading Charges
                        branch_tab += '<tr class="last_cld2">';
                        branch_tab += '<td colspan="4" class="p_t_5">';
                        branch_tab += '<div class="fl_over">';

                        //Uploading Charges
                        branch_tab += '<div class="avail_bal">';
                        branch_tab += '<table><tbody>';
                        branch_tab += '<tr class="disc_blk">';
                        branch_tab += '<td class="green_txt">Unloading Charges <span class="red_clr"></span></td>';

                        if (purchase_info.unloading_charges > 0) {
                            branch_tab += '<td colspan="2" class="green_txt"><input type="text" id="unloading_chr_' + branches[b].branch_id + '" name="unloading_chr_' + branches[b].branch_id + '" class="text_rt" value="' + purchase_info.unloading_charges + '" disabled/></td>';
                        } else {
                            branch_tab += '<td colspan="2" class=""><input type="text" id="unloading_chr_' + branches[b].branch_id + '" name="unloading_chr_' + branches[b].branch_id + '" class="text_rt" value="0"/></td>';
                        }

                        branch_tab += '</tr>';
                        branch_tab += '</tbody></table>';
                        branch_tab += '</div>';
                        //Uploading Charges End

                        //Transport Charges
                        branch_tab += '<div class="avail_bal">';
                        branch_tab += '<table><tbody>';
                        branch_tab += '<tr class="disc_blk">';
                        branch_tab += '<td class="green_txt">Transport Charges <span class="red_clr"></span></td>';

                        if (purchase_info.transport_charges > 0 && purchase_info.admin_pay_req == 0) {
                            branch_tab += '<td colspan="2" class="green_txt"><input type="text" id="trasport_chr_' + branches[b].branch_id + '" name="trasport_chr_' + branches[b].branch_id + '" class="text_rt" value="' + purchase_info.transport_charges + '" disabled/></td>';
                        } else {
                            if (purchase_info.transport_charges > 0) {
                                var transport_charges = parseInt(purchase_info.transport_charges);
                            } else {
                                var transport_charges = 0;
                            }

                            branch_tab += '<td colspan="2" class="green_txt"><input type="text" id="trasport_chr_' + branches[b].branch_id + '" name="trasport_chr_' + branches[b].branch_id + '" class="text_rt" value="' + transport_charges + '"/></td>';
                        }

                        branch_tab += '</tr>';
                        branch_tab += '</tbody></table>';

                        //if(purchase_info.transport_charges>0){

                        //sufficient balance
                        //Don\'t have a sufficient balance
                        if (purchase_info.admin_pay_req == 1) {
                            branch_tab += '<div class="checkbox adm_ant" id="balance_check_' + branches[b].branch_id + '">';
                        } else {
                            branch_tab += '<div class="checkbox adm_ant" id="balance_check_' + branches[b].branch_id + '" style="display:none;">';
                        }


                        branch_tab += '<div class="row">';
                        branch_tab += '<div class="col-md-7">';
                        branch_tab += '<label><input type="checkbox" value="yes" id="cash_balance_' + branches[b].branch_id + '" disabled/>Use Cash Balance</label><p class="bal_amn_cash" id="cash_balance_msg_' + branches[b].branch_id + '">' + branches[b].amount + '</p>';
                        branch_tab += '</div>';
                        branch_tab += '<div class="col-md-5" id="admin_pay_' + branches[b].branch_id + '">';
                        if (purchase_info.admin_pay_req == 1) {
                            branch_tab += '<div class="top_in_op text_rt crop_top"><p class="text_rt"><input type="checkbox" value="admin" id="pay_by_' + branches[b].branch_id + '" checked="checked" disabled/>Admin pay</p><h1 class="text_rt" id="admin_pay_amt_' + branches[b].branch_id + '"></h1></div>';
                        } else {
                            branch_tab += '<div class="top_in_op text_rt crop_top"><p class="text_rt"><input type="checkbox" value="admin" id="pay_by_' + branches[b].branch_id + '" disabled/>Admin pay</p><h1 class="text_rt" id="admin_pay_amt_' + branches[b].branch_id + '"></h1></div>';
                        }

                        branch_tab += '</div>';
                        branch_tab += '</div>';
                        branch_tab += '</div>';
                        //sufficient balance end

                        //}

                        branch_tab += '</div>';
                        //Transport Charges END

                        branch_tab += '</div>';
                        branch_tab += '</td>';
                        branch_tab += '</tr>';

                        branch_tab += '</thead>';
                        branch_tab += '</table>';

                        //if(purchase_info.transport_charges==0){
                        //Driver
                        if (purchase_info.admin_pay_req == 1) {
                            branch_tab += '<div class="qs_blk rem_tr_amn" id="driver_' + branches[b].branch_id + '">';
                            branch_tab += '<h2 class="create_hdg">Select below options to pay ₹' + purchase_info.transport_charges + ' to driver</h2>';
                        } else {
                            branch_tab += '<div class="qs_blk rem_tr_amn" id="driver_' + branches[b].branch_id + '" style="display:none;">';
                            branch_tab += '<h2 class="create_hdg">Select below options to pay ₹<span id="admin_pay_driver_' + branches[b].branch_id + '"></span> to driver</h2>';
                        }

                        //Assign Type
                        branch_tab += '<ul class="assign_type">';
                        branch_tab += '<li class="credit_trns lnk_typ" onclick="Purchase.assignType(\'upi_cash\',\'' + branches[b].branch_id + '\')"><img src="http://3.7.44.132/aquacredit/assets/images/credit_icn.png" /><input type="radio" name="act_types_' + branches[b].branch_id + '" value="upi_cash"/><span> UPI </span></li>';
                        if (purchase_info.admin_pay_req == 1) {
                            branch_tab += '<li class="act_type lnk_typ ban_trns" onclick="Purchase.assignType(\'bank\',\'' + branches[b].branch_id + '\')"><img src="http://3.7.44.132/aquacredit/assets/images/bank_tansfer.png" /><input type="radio" name="act_types_' + branches[b].branch_id + '" value="bank" checked="checked"/><span> Bank Transfer </span></li>';
                        } else {
                            branch_tab += '<li class="act_type lnk_typ ban_trns" onclick="Purchase.assignType(\'bank\',\'' + branches[b].branch_id + '\')"><img src="http://3.7.44.132/aquacredit/assets/images/bank_tansfer.png" /><input type="radio" name="act_types_' + branches[b].branch_id + '" value="bank"/><span> Bank Transfer </span></li>';
                        }

                        branch_tab += '<li class="cash_trns lnk_typ" onclick="Purchase.assignType(\'cash\',\'' + branches[b].branch_id + '\')"><img src="http://3.7.44.132/aquacredit/assets/images/cash_icn.png" /><input type="radio" name="act_types_' + branches[b].branch_id + '" value="cash"/><span> Cash </span></li>';
                        branch_tab += '</ul>';

                        branch_tab += '<ul class="trans_inf" id="tsc_frm_bank_' + branches[b].branch_id + '">';
                        branch_tab += '<li class="app_date"><div class="cre_inp"><input type="text" class="form-control" id="ddate_' + branches[b].branch_id + '" name="ddate_' + branches[b].branch_id + '" value="" placeholder="Date" autocomplete="off"/></div></li>';

                        branch_tab += '<li class="us_bn_ls bank_' + branches[b].branch_id + '">';
                        //Admin Accounts
                        branch_tab += '<div class="check_wt_serc check_wt_serc_cstm" id="dadmin_' + branches[b].branch_id + '">';
                        branch_tab += '<div class="show_va">Select Bank</div>';
                        branch_tab += '<div class="selectVal" id="dadminacc_' + branches[b].branch_id + '">Select Bank</div>';
                        branch_tab += '<ul class="check_list" id="dbanklist_' + branches[b].branch_id + '">';
                        branch_tab += '<li>';
                        for (var i = 0; i < adminacc.length; i++) {
                            var icon = adminacc[i].account_name.toLowerCase() + '_icn.png';
                            var bank_bal = '₹' + Purchase.addCommasinamt(adminacc[i].avail_amount);
                            var accont_numb = adminacc[i].account_number;
                            branch_tab += '<div class="form-check" onclick="Purchase.selectTsAccount(\'dadmin\',\'banklist\',\'' + adminacc[i].id + '\',\'' + branches[b].branch_id + '\')">';
                            branch_tab += '<input class="form-check-input" type="radio" name="dadminacc_' + branches[b].branch_id + '" id="dadinput_' + adminacc[i].id + '_' + branches[b].branch_id + '" value="' + adminacc[i].id + '"/>';
                            branch_tab += '<label class="form-check-label" for="dadlb_' + adminacc[i].id + '_' + branches[b].branch_id + '">';
                            branch_tab += '<div class="bank_logo"><img src="' + url + '/assets/images/' + icon + '" alt="" title=""/></div>';
                            branch_tab += '<div class="bank_mny">';
                            branch_tab += '<div class="bank_bal">' + bank_bal + '</div>';
                            branch_tab += '<div class="accont_numb" id="dadmin_' + adminacc[i].id + '_' + branches[b].branch_id + '">' + accont_numb + '</div>';
                            branch_tab += '</div>';
                            branch_tab += '</label>';
                            branch_tab += '</div>';
                        }
                        branch_tab += '</li>';
                        branch_tab += '</ul>';
                        branch_tab += '</div>';
                        //Admin Accounts END
                        branch_tab += '</li>';

                        branch_tab += '<li class="bank_' + branches[b].branch_id + '"><div class="cre_inp"><input type="text" class="form-control" id="dname_' + branches[b].branch_id + '" name="dname_' + branches[b].branch_id + '" value="" placeholder="Driver name"/></div></li>';
                        branch_tab += '<li class="bank_' + branches[b].branch_id + '"><div class="cre_inp"><input type="text" class="form-control" id="dacc_' + branches[b].branch_id + '" name="dacc_' + branches[b].branch_id + '" value="" placeholder="Account number"/></div></li>';
                        branch_tab += '<li class="bank_' + branches[b].branch_id + '"><div class="cre_inp"><input type="text" class="form-control" id="difsc_' + branches[b].branch_id + '" name="difsc_' + branches[b].branch_id + '" value="" placeholder="IFC Code"/></div></li>';
                        branch_tab += '<li class="bank_' + branches[b].branch_id + '"><div class="cre_inp"><input type="text" class="form-control" id="dref_' + branches[b].branch_id + '" name="dref_' + branches[b].branch_id + '"  value="" placeholder="Reference Id"/></div></li>';
                        branch_tab += '<li class="upi_cash_' + branches[b].branch_id + '" style="display:none;"><div class="cre_inp"><input type="text" class="form-control" id="dmobile_' + branches[b].branch_id + '" name="dmobile_' + branches[b].branch_id + '" value="" placeholder="Mobile No"/></div></li>';
                        branch_tab += '<li class="upi_cash_' + branches[b].branch_id + '" style="display:none;"><div class="cre_inp"><textarea class="form-control" id="dnote_' + branches[b].branch_id + '" name="dnote_' + branches[b].branch_id + '" colspan="5" placeholder="Note"></textarea></div></li>';
                        branch_tab += '</ul>';
                        //Assign Type End

                        branch_tab += '</div>';
                        //Driver END

                        //}

                        //console.log(purchase_info);
                        if (purchase_info.status == 'PM') {
                            branch_tab += '<div id="error_' + branches[b].branch_id + '" class="clear:both;" style="text-align:right;"></div>';
                            branch_tab += '<div class="po_ftr" id="confirm_' + branches[b].branch_id + '">';
                            branch_tab += '<button type="button" class="btn fr sb_btn btn-primary" onclick="Purchase.confirmBranch(\'' + branches[b].branch_id + '\')"> Confirm </button>';
                            branch_tab += '</div>';
                        } else {
                            if (purchase_info.status == 'CE' && purchase_info.admin_pay_req == 1) {
                                branch_tab += '<div id="error_' + branches[b].branch_id + '" class="clear:both;" style="text-align:right;"></div>';
                                branch_tab += '<div class="po_ftr" id="confirm_' + branches[b].branch_id + '">';
                                branch_tab += '<button type="button" class="btn fr sb_btn btn-primary" onclick="Purchase.payTransportCharges(\'' + branches[b].branch_id + '\')"> Admin Pay </button>';
                                branch_tab += '</div>';
                            }
                        }

                        branch_tab += '</form></div>';
                    }



                    $('#branchplist').append(branch_tab);

                    //Payment Options in branch
                    $('.lnk_typ.ban_trns').click(function() {
                        $(this).addClass('act_type');
                        $('.bktr').show();
                        $('.blk_disb').removeClass('blk_no_dis');
                        $(this).siblings('.cash_trns, .lnk_typ').removeClass('act_type');
                        // $('.blk_disb').addClass('blk_no_dis');
                        $(this).parent().siblings('.ove_auto').find('.lon_typ').removeClass('hide_blk_anim');
                    });

                    $('.lnk_typ.cash_trns').click(function() {
                        $('.bktr').hide();
                        $(this).addClass('act_type');
                        $('.blk_disb').removeClass('blk_no_dis');
                        // $('.blk_disb').addClass('blk_no_dis');
                        $(this).siblings('.ban_trns, .lnk_typ').removeClass('act_type');
                        $(this).parent().siblings('.ove_auto').find('.lon_typ').addClass('hide_blk_anim');
                    });

                    $('.lnk_typ.credit_trns').click(function() {
                        $(this).addClass('act_type');
                        $('.blk_disb').addClass('blk_no_dis');
                        $(this).siblings('.ban_trns, .cash_trns').removeClass('act_type');
                        $(this).parent().siblings('.ove_auto').find('.lon_typ').addClass('hide_blk_anim');
                    });

                    $('.check_wt_serc.check_wt_serc_cstm').click(function() {
                        $(".check_wt_serc.check_wt_serc_cstm").not(this).removeClass('act_v');
                        $(this).toggleClass('act_v')
                        $(".check_wt_serc.check_wt_serc_cstm").not(this).find('.check_list').removeClass('show_chk');
                        $(this).find('.check_list').toggleClass('show_chk');
                    });

                    for (var d = 0; d < branches.length; d++) {
                        var ddate_txt = branches[d].branch_id;
                        $("#ddate_" + branches[d].branch_id).datepicker({
                            beforeShow: function() {
                                setTimeout(function() {
                                    $('.ui-datepicker').css('z-index', 99999999999999);
                                }, 0);
                            },
                            dateFormat: 'dd-M-yy',
                            //defaultDate: "+1w",
                            changeMonth: true,
                            changeYear: true,
                            minDate: dateToday,
                            numberOfMonths: 1,
                            onSelect: function(selected) {
                                $('#ddate_txt_' + branches[d].branch_id).text('');
                                //event.stopPropagation();
                                // $("#start_date").parent().addClass('inp_ss');
                                // $("#start_date").removeClass('error');
                                // str = selected.split("-").join(" ");
                                //var dt = new Date(str);
                                //dt.setDate(dt.getDate() + 1);
                                //$("#end_date").datepicker("option", "minDate", dt);
                            }
                        });
                    }

                    $(".allownumericwithoutdecimal").on("keypress keyup blur", function(event) {
                        $(this).val($(this).val().replace(/[^\d].+/, ""));
                        if ((event.which < 48 || event.which > 57)) {
                            event.preventDefault();
                        }
                    });

                    pur_lst_tbl.draw();
                    $('#overlay_id').hide();
                    //Purchase.loadSelect();
                });

        },
        requestPopup: function() {
            var req_prod_list = '';
            productlist = {};
            userselectedprod = [];
            userselectedpdis = [];
            $('input[name="brand_id"]').attr('checked', false);
            $('#bselectVal').text("Brands");

            $('#selectBranchVal').text(mbranch_name);
            $('#rbranch_' + mbranch_id).attr('checked', true);

            $('#reqbtn').show();
            $('#addproducts').empty();
            req_prod_list += '<tr>';
            req_prod_list += '<td colspan="3">Please select Brand</td>';
            req_prod_list += '</tr>';
            $('#addproducts').append(req_prod_list);
            $('#create_module').modal({ backdrop: 'static', keyboard: false });
        },
        getProducts: function(bid) {
            userselectedprod = [];
            userselectedpdis = [];
            productlist = {};
            ad_brand_id = bid;
            pinc = 0;

            jQuery.post(API_URL + '/index', { brand_id: ad_brand_id })
                .done(function(data) {
                    userselectedprod = [];
                    $('#addproducts').empty();
                    var prod_list = '';
                    var result = $.parseJSON(data);
                    if (result.error == false) {
                        var products = result.topproducts;
                        for (var i = 0; i < products.length; i++) {
                            products[i].index = i;
                            products[i].is_selected = true;
                            products[i].is_deleted = false;
                            products[i].uqty = 1;
                            prod_list += '<tr id="pindex_' + i + '">';
                            prod_list += '<td>' + products[i].pname + '</td>';
                            prod_list += '<td class="txt_cnt qty_pp"><input id="pqty_' + products[i].index + '" name="pqty_' + products[i].index + '" type="text" value="' + products[i].uqty + '" onkeypress="return Purchase.onlyNumbers(event);" maxlength="6"/></td>';
                            prod_list += '<td class="red_clr act_pp txt_cnt"><a javascript="void(0);" onclick="Purchase.delProd(' + i + ');"><i class="fa fa-trash" aria-hidden="true"></i></a></td>';
                            prod_list += '</tr>';

                            if ((i + 1) == products.length) {
                                prod_list += '<tr id="searchtrid">';
                                prod_list += '<td colspan="3"><input id="search" name="search" type="text" value="" placeholder="Search product"/></td>';
                                prod_list += '</tr>';
                            }

                            productlist[i] = products[i];
                            userselectedprod[i] = products[i];
                            userselectedpdis[i] = products[i].pid;
                        }
                        pinc = products.length;
                    } else {
                        prod_list += '<tr>';
                        prod_list += '<td colspan="3">No Products Found</td>';
                        prod_list += '</tr>';
                    }

                    $('#addproducts').append(prod_list);
                    setTimeout(function() {
                        Purchase.autoSearch();
                    }, 1000);

                });
        },
        delProd: function(pindex) {
            $('#pindex_' + pindex).remove();
            productlist[pindex].is_selected = false;
            productlist[pindex].is_deleted = true;
            Purchase.getUserSelectedProd();
        },
        getUserSelectedProd: function() {
            userselectedprod = [];
            userselectedpdis = [];
            $.each(productlist, function(index, value) {
                //console.log(value);
                if (value.is_selected) {
                    userselectedprod.push(value);
                    userselectedpdis.push(value.pid);
                }
            });
        },
        autoSearch: function() {
            var branch_id = $("input[name='rbranch']:checked").val();
            $("#search").autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: API_URL + 'searchproduct',
                        method: "POST",
                        //headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        data: { keyword: $('#search').val(), 'brand_id': ad_brand_id, branch_id: branch_id, 'userselectedpdis': userselectedpdis },
                        dataType: "JSON",
                        success: function(data) {
                            response(data.products);
                        },
                        error: function(data) {
                            console.log(data);
                        }
                    });
                },
                minLength: 3,
                select: function(event, ui) {
                    var pinfo = '';
                    if (ui.item.id) {
                        //console.log('###');
                        pinc = pinc + 1;
                        pinfo = ui.item.pinfo;
                        pinfo.index = (pinc - 1);
                        pinfo.is_selected = true;
                        pinfo.is_deleted = false;
                        pinfo.uqty = 1;

                        var prod = '';
                        prod += '<tr id="pindex_' + pinfo.index + '">';
                        prod += '<td>' + pinfo.pname + '</td>';
                        prod += '<td class="txt_cnt qty_pp"><input id="pqty_' + pinfo.index + '" name="pqty_' + pinfo.index + '" type="text" value="' + pinfo.uqty + '" onkeypress="return Purchase.onlyNumbers(event);" maxlength="6"/></td>';
                        prod += '<td class="red_clr act_pp txt_cnt"><a javascript="void(0);" onclick="Purchase.delProd(' + pinfo.index + ');"><i class="fa fa-trash" aria-hidden="true"></i></a></td>';
                        prod += '</tr>';
                        $("#searchtrid").before(prod);
                        productlist[pinfo.index] = pinfo;
                        Purchase.getUserSelectedProd();
                    }
                },
                change: function() {
                    //$("#search").val("");
                },
                close: function(event, ui) {
                    $("#search").val("");
                }
            });
        },
        updateQty: function(pindex) {
            var qty = $('#pqty_' + pindex).val();
            if (qty != '') {
                productlist[pindex].qty = qty;
            } else {
                productlist[pindex].qty = 1;
            }
            Purchase.getUserSelectedProd();
        },
        submitRequest: function() {
            //productlist,userselectedprod
            //table-danger
            if (userselectedprod.length == 0) {
                $("#msg").addClass('badge badge-danger').html("Please select products!");
                setTimeout(function() {
                    $("#msg").removeClass('badge badge-danger').html("");
                }, 2500);
                return;
            }

            var validate = false;
            for (var i = 0; i < userselectedprod.length; i++) {

                var pinfo = userselectedprod[i];
                var index = pinfo.index;
                var qty = $('#pqty_' + index).val();
                if (qty == '') {
                    $('#pindex_' + index).addClass('table-danger');
                    validate = true;
                } else {
                    $('#pindex_' + i).removeClass('table-danger');
                    userselectedprod[i].qty = $('#pqty_' + index).val();
                    validate = false;
                }

                if (validate) {
                    break;
                }
                //console.log(pinfo);
            }

            if (validate) {
                return;
            }

            document.getElementById("reqbtn").disabled = true;
            $("#reqloader").html(loader_fa);

            var branch_id = $("input[name='rbranch']:checked").val();
            //Save Request
            jQuery.post(API_URL + '/saverequest', { brand_id: ad_brand_id, branch_id: branch_id, userproducts: userselectedprod })
                .done(function(data) {
                    var result = $.parseJSON(data);
                    //console.log(result);
                    var prod_list = message = '';
                    $('#addproducts').empty();
                    var process_done = false;

                    if (result.error == false) {
                        process_done = true;
                        message = 'Request submited successfully !';
                    } else {
                        process_done = true;
                        message = 'Request failed try again !';
                    }

                    prod_list += '<tr class="table-success">';
                    prod_list += '<td colspan="3">' + message + ' <a class="btn btn-warning btn-sm" onclick="Purchase.createRequest();">Another request</a></td>';
                    prod_list += '</tr>';

                    if (process_done) {
                        $('#addproducts').append(prod_list);
                        $('input[name="brand_id"]').attr('checked', false);
                        $('#bselectVal').text("Brands");
                        $('#reqbtn').hide();

                        productlist = {};
                        userselectedprod = userselectedpdis = [];

                        setTimeout(function() {
                            document.getElementById("reqbtn").disabled = false;
                            $("#reqloader").html("");
                            pur_lst_tbl.draw();
                        }, 1000);
                    }


                });
        },
        confirmBranch: function(branch_id) {
            //console.log('###'+branch_id);
            //unloading_chr_
            //trasport_chr_
            //fine_inv_
            $('#error_' + branch_id).empty();
            var unloading_charges = $('#unloading_chr_' + branch_id).val();
            var transport_charges = $('#trasport_chr_' + branch_id).val();

            var error = '';
            if (unloading_charges == '' || unloading_charges == 0 || typeof unloading_charges === "undefined") {
                error += '<p style="color:red;">Unloading charges is required</p>';
            }

            if (transport_charges == '' || transport_charges == 0 || typeof transport_charges === "undefined") {
                error += '<p style="color:red;">Transport charges is required</p>';
            }

            if ($('input[name=fine_inv_' + branch_id + ']')[0].files[0] == '' || typeof $('input[name=fine_inv_' + branch_id + ']')[0].files[0] === 'undefined') {
                error += '<p style="color:red;">Invoice is required</p>';
            }

            if (error != '') {
                $('#error_' + branch_id).append(error);
                return false;
            }


            //$('#overlay_id').show();

            var bpid = $('#branch_name_' + branch_id).attr('data-bp-id');
            var formData = new FormData($('#branch_edit_' + branch_id)[0]);
            formData.append('unloading_charges', unloading_charges);
            formData.append('transport_charges', transport_charges);
            formData.append('invoice_file', $('input[name=fine_inv_' + branch_id + ']')[0].files[0]);
            formData.append('ap_id', ap_id);
            formData.append('bpid', bpid);
            formData.append('brand_id', ebrand_id);
            formData.append('branch_id', branch_id);
            if ($('#pay_by_' + branch_id).is(":checked")) {
                formData.append('pay_by', 'admin');
                var pay_by = 'admin';
            } else {
                formData.append('pay_by', 'branch');
                var pay_by = 'branch';
            }

            var act_types = '';
            error = '';
            if (pay_by == 'admin') {
                act_types = $("input[name='act_types_" + branch_id + "']:checked").val();

                var ddate = $('#ddate_' + branch_id).val();
                if (ddate == '' || typeof ddate === 'undefined') {
                    error += '<p style="color:red;">Date is required</p>';
                }

                if (act_types == 'upi_cash' || act_types == 'cash') {
                    var dmobile = $('#dmobile_' + branch_id).val();
                    if (dmobile == '' || typeof dmobile === 'undefined') {
                        error += '<p style="color:red;">Mobile is required</p>';
                    }

                } else {
                    var dadminacc = $("input[name='dadminacc_" + branch_id + "']:checked").val();
                    //console.log(dadminacc);
                    var dname = $('#dname_' + branch_id).val();
                    var dacc = $('#dacc_' + branch_id).val();
                    var difsc = $('#difsc_' + branch_id).val();

                    if (dadminacc == '' || typeof dadminacc === "undefined") {
                        error += '<p style="color:red;">Bank account is required</p>';
                    }

                    if (dname == '' || typeof dname === "undefined") {
                        error += '<p style="color:red;">Driver name is required</p>';
                    }

                    if (dacc == '' || typeof dacc === "undefined") {
                        error += '<p style="color:red;">Account is required</p>';
                    }

                    if (difsc == '' || typeof difsc === "undefined") {
                        error += '<p style="color:red;">IFSC code is required</p>';
                    }
                }
            }

            if (error != '') {
                $('#error_' + branch_id).append(error);
                return false;
            }

            if (pay_by == 'admin') {
                formData.append('act_types', act_types);
                formData.append('ddate', ddate);
                if (act_types == 'upi_cash' || act_types == 'cash') {
                    formData.append('dmobile', dmobile);
                } else {
                    formData.append('dadminacc', dadminacc);
                    formData.append('dname', dname);
                    formData.append('dacc', dacc);
                    formData.append('difsc', difsc);
                }
            }

            $.ajax({
                url: API_URL + '/goodsconfirm',
                type: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    var result = $.parseJSON(data);
                    if (result.admin_pay) {
                        $('#balance_check_' + branch_id).show();
                        $('#cash_balance_msg_' + branch_id).text('Don\'t have a sufficient balance');
                        $('#pay_by_' + branch_id).prop('checked', true);
                        $('#admin_pay_amt_' + branch_id).text(transport_charges);
                        $('#driver_' + branch_id).show();
                        $('#admin_pay_driver_' + branch_id).text(transport_charges);
                        $("input[name='act_types_" + branch_id + "'][value='bank']").prop('checked', true);
                    } else {
                        $('#overlay_id').show();
                        if (result.confirm_status) {
                            $('#updatebtn,#invoice_up,#paymentbtn,#uploading').hide();
                            pur_lst_tbl.draw();
                        }
                        //document.getElementById("paymentbtn").disabled=false;
                        //$('#epayloader').html('');

                        Purchase.updateRequest();
                    }
                    //$('#overlay_id').hide();
                    /*var result=$.parseJSON(data);
                    if(result.confirm_status){
                    	$('#updatebtn,#invoice_up,#paymentbtn,#uploading').hide();
                    	pur_lst_tbl.draw();
                    }
                    document.getElementById("paymentbtn").disabled=false;
                    $('#epayloader').html('');*/
                }
            });
        },
        payTransportCharges: function(branch_id) {
            $('#error_' + branch_id).empty();
            var transport_charges = $('#trasport_chr_' + branch_id).val();

            var error = '';

            if (transport_charges == '' || transport_charges == 0 || typeof transport_charges === "undefined") {
                error += '<p style="color:red;">Transport charges is required</p>';
            }

            if (error != '') {
                $('#error_' + branch_id).append(error);
                return false;
            }

            var bpid = $('#branch_name_' + branch_id).attr('data-bp-id');
            var formData = new FormData($('#branch_edit_' + branch_id)[0]);
            formData.append('transport_charges', transport_charges);
            formData.append('ap_id', ap_id);
            formData.append('bpid', bpid);
            formData.append('brand_id', ebrand_id);
            formData.append('branch_id', branch_id);
            formData.append('pay_by', 'admin');
            var pay_by = 'admin';

            var act_types = '';
            error = '';
            if (pay_by == 'admin') {
                act_types = $("input[name='act_types_" + branch_id + "']:checked").val();

                var ddate = $('#ddate_' + branch_id).val();
                if (ddate == '' || typeof ddate === 'undefined') {
                    error += '<p style="color:red;">Date is required</p>';
                }

                if (act_types == 'upi_cash' || act_types == 'cash') {
                    var dmobile = $('#dmobile_' + branch_id).val();
                    if (dmobile == '' || typeof dmobile === 'undefined') {
                        error += '<p style="color:red;">Mobile is required</p>';
                    }

                } else {
                    var dadminacc = $("input[name='dadminacc_" + branch_id + "']:checked").val();
                    //console.log(dadminacc);
                    var dname = $('#dname_' + branch_id).val();
                    var dacc = $('#dacc_' + branch_id).val();
                    var difsc = $('#difsc_' + branch_id).val();

                    if (dadminacc == '' || typeof dadminacc === "undefined") {
                        error += '<p style="color:red;">Bank account is required</p>';
                    }

                    if (dname == '' || typeof dname === "undefined") {
                        error += '<p style="color:red;">Driver name is required</p>';
                    }

                    if (dacc == '' || typeof dacc === "undefined") {
                        error += '<p style="color:red;">Account is required</p>';
                    }

                    if (difsc == '' || typeof difsc === "undefined") {
                        error += '<p style="color:red;">IFSC code is required</p>';
                    }
                }
            }

            if (error != '') {
                $('#error_' + branch_id).append(error);
                return false;
            }

            if (pay_by == 'admin') {
                formData.append('act_types', act_types);
                formData.append('ddate', ddate);
                if (act_types == 'upi_cash' || act_types == 'cash') {
                    formData.append('dmobile', dmobile);
                } else {
                    formData.append('dadminacc', dadminacc);
                    formData.append('dname', dname);
                    formData.append('dacc', dacc);
                    formData.append('difsc', difsc);
                }
            }

            $.ajax({
                url: API_URL + '/paytransportcharges',
                type: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    var result = $.parseJSON(data);
                    $('#overlay_id').show();
                    if (result.confirm_status) {
                        $('#updatebtn,#invoice_up,#paymentbtn,#uploading').hide();
                        pur_lst_tbl.draw();
                    }
                    Purchase.updateRequest();
                }
            });
        },
        uploadInvoice: function(e, branch_id) {
            try {
                var invoice = e.target.files[0].name;
                $("#invoice_file_" + branch_id).css({ color: 'red' }).text(invoice);
            } catch (err) {

            }
        },
        onlyNumbers: function(event) {
            var charCode = (event.which) ? event.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57)) { return false; } else { return true; }
        },
    };
    $(document).ready(function($) {
        Purchase.init();
        //Scheduler.getScheduleList();
    });
})(jQuery);