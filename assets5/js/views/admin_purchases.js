var Purchase;
var API_URL = url + 'api/purchases/';
var loader_fa = '<i class="fa fa-circle-o-notch fa-spin" style="font-size:15px"></i>';
var brand_id = '';
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

            var pur_lst_tbl = $('#pur_lst_tbl').DataTable({
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
                        //Date Filter
                        //var dateopt=$("input[name='dateopt']:checked").val();
                        //data.dateopt=dateopt;

                        //Status Filter

                        //Tab
                        var hid_tabval = $('#hid_tabval').val();
                        data.hid_tabval = hid_tabval;

                    },
                    dataSrc: function(json) {
                        setTimeout(function() {
                            $('.act_icns').popover({
                                html: true,
                                content: function() {
                                    return $('#popover-contents').html();
                                }
                            });
                            $(document).on("click", ".edt", function() {
                                Purchase.editRequest();
                            });

                            $(document).on("click", ".del", function() {
                                Purchase.delRequest();
                            });

                        }, 1000);
                        Purchase.getSummary();
                        return json.data;
                    }
                },
                //columns:[]
            });

            //Tabs
            $('#pur_lst_tbl_wrapper .dataTables_length').html('<ul class="tabs_tbl"><li class="act_tab drft_cl"> <span>Pending Requests</span> </li><li class="comp_cl"> <span>Completed Requests </span> </li></ul> <span class="tbl_btn">  </span>');

            $('.comp_cl').click(function() {
                $("#hid_tabval").val(1);
                $(this).addClass('act_tab');
                $('.tabs_tbl').addClass('cmp_ul');
                $('.drft_cl').removeClass('act_tab');

                pur_lst_tbl.columns([5]).visible(false);
                pur_lst_tbl.columns([0, 1, 2, 3, 4]).visible(true, true, true, true);
                pur_lst_tbl.columns.adjust().draw(false);
            });

            $('.drft_cl').click(function() {
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
            ebrand_id = null;
            ap_id = null;
            ap_id = apid;
            ebrand_id = brand_id;
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
                        formsteps.pending = true;
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
                        branch_list += '<li>';
                        //branch_list+='<div>';
                        branch_list += '<div class="check_wt_serc_new check_wt_serc val_seld" id="bb_' + branches[b].branch_id + '">';
                        branch_list += '<div>';
                        branch_list += '<div class="show_va">' + branches[b].branch_name + '</div>';
                        branch_list += '<div class="selectVal" onclick="Purchase.openBranch(' + branches[b].branch_id + ');">Products(' + pcnt + ')</div>';
                        branch_list += '<ul class="check_list" id="blist_' + branches[b].branch_id + '">';
                        branch_list += '<li>';
                        //branch_list+='<div class="form-group" id="bsearch_'+branches[b].branch_id+'"><input type="text" class="form-control" placeholder="Search Branch" /></div>';
                        branch_list += '</li>';
                        for (var p = 0; p < branch_prod.length; p++) {
                            branch_list += '<li>';
                            branch_list += '<div class="form-check"><input class="form-check-input" type="checkbox" id="bp_' + branches[b].branch_id + '_' + branch_prod[p].bpd_id + '" name="bp_' + branches[b].branch_id + '_' + branch_prod[p].bpd_id + '" value="' + branch_prod[p].bpd_id + '" checked="checked"/><label class="form-check-label" for="uss1">' + branch_prod[p].pname + '</label><input type="text" class="cnt" placeholder="count" id="bpc_' + branches[b].branch_id + '_' + branch_prod[p].bpd_id + '" name="bpc_' + branches[b].branch_id + '_' + branch_prod[p].bpd_id + '" value="' + branch_prod[p].quantity + '"/></div>';
                            branch_list += '</li>';
                        }

                        //Extra Products
                        var extra_products = branches[b].extra_products;
                        if (extra_products.length > 0) {
                            for (var e = 0; e < extra_products.length; e++) {
                                branch_list += '<li>';
                                branch_list += '<div class="form-check"><input class="form-check-input" type="checkbox" id="bp_' + branches[b].branch_id + '_' + extra_products[e].pid + '" name="bp_' + branches[b].branch_id + '_' + extra_products[e].pid + '" value="' + extra_products[e].pid + '"/><label class="form-check-label" for="uss1">' + extra_products[e].pname + '</label><input type="text" class="cnt" placeholder="count" id="bpc_' + branches[b].branch_id + '_' + extra_products[e].pid + '" name="bpc_' + branches[b].branch_id + '_' + extra_products[e].pid + '" value="' + extra_products[e].quantity + '"/></div>';
                                branch_list += '</li>';
                            }
                        }

                        branch_list += '<li><button class="btn save_blk btn-primary">Save</button></li>';
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
                        var icon = adminacc[i].bank_name.toLowerCase() + '_icn.png';
                        var bank_bal = '₹' + Purchase.addCommasinamt(adminacc[i].avail_amount);
                        var accont_numb = adminacc[i].account_no;
                        admin_acc += '<div class="form-check" onclick="Purchase.selectAccount(\'admin\',\'banklist\',\'' + adminacc[i].bank_id + '\')">';
                        admin_acc += '<input class="form-check-input" type="radio" name="adminacc" id="adinput_' + adminacc[i].bank_id + '" value="' + adminacc[i].bank_id + '"/>';
                        admin_acc += '<label class="form-check-label" for="adlb_' + adminacc[i].bank_id + '">';
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
                            var status = 'Confirmed';
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

                        branch_tab += '<div class="order_hist tab-pane fade ' + active + '" id="branch' + branches[b].branch_id + '">';
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
                            branch_tab += '<td class=""><a href="#" class="invoice_up"><label for="fine_inv' + branches[b].branch_id + '"><i class="fa fa-paperclip" aria-hidden="true"></i> Upload Invoice<input type="file" id="fine_inv_' + branches[b].branch_id + '"></label></a></td>';
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
                            branch_tab += '<td colspan="2" class=""><input type="text" id="unloading_chr_' + branches[b].branch_id + '" name="unloading_chr_' + branches[b].branch_id + '" class="text_rt" value="2000"/></td>';
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

                        if (purchase_info.transport_charges > 0) {
                            branch_tab += '<td colspan="2" class="green_txt"><input type="text" id="trasport_chr_' + branches[b].branch_id + '" name="trasport_chr_' + branches[b].branch_id + '" class="text_rt" value="' + purchase_info.transport_charges + '" disabled/></td>';
                        } else {
                            branch_tab += '<td colspan="2" class="green_txt"><input type="text" id="trasport_chr_' + branches[b].branch_id + '" name="trasport_chr_' + branches[b].branch_id + '" class="text_rt" value="2000"/></td>';
                        }

                        branch_tab += '</tr>';
                        branch_tab += '</tbody></table>';

                        /*if(purchase_info.transport_charges>0){

                        //sufficient balance
                        branch_tab+='<div class="checkbox adm_ant">';
                        branch_tab+='<div class="row">';
                        branch_tab+='<div class="col-md-7">';
                        branch_tab+='<label><input type="checkbox" disabled value="" />Use Cash Balance</label><p class="bal_amn_cash">Don\'t have a sufficient balance</p>';
                        branch_tab+='</div>';
                        branch_tab+='<div class="col-md-5">';
                        branch_tab+='<div class="top_in_op text_rt crop_top"><p class="text_rt">Admin pay</p><h1 class="text_rt">2000</h1></div>';
                        branch_tab+='</div>';
                        branch_tab+='</div>';
                        branch_tab+='</div>';
                        //sufficient balance end

                        }*/

                        branch_tab += '</div>';
                        //Transport Charges END

                        branch_tab += '</div>';
                        branch_tab += '</td>';
                        branch_tab += '</tr>';

                        branch_tab += '</thead>';
                        branch_tab += '</table>';

                        /*if(purchase_info.transport_charges==0){
                        //Driver
                        branch_tab+='<div class="qs_blk rem_tr_amn" id="upload_trs_chr_'+branches[b].branch_id+'">';
                        branch_tab+='<h2 class="create_hdg">Select below options to pay ₹2000 to driver</h2>';

                        //Assign Type
                        branch_tab+='<ul class="assign_type">';
                        branch_tab+='<li class="credit_trns lnk_typ" onclick="Purchase.assignType(\'upi_cash\',\''+branches[b].branch_id+'\')"><img src="http://3.7.44.132/aquacredit/assets/images/credit_icn.png" /><input type="radio" name="act_types_'+branches[b].branch_id+'" /><span> UPI </span></li>';
                        branch_tab+='<li class="act_type lnk_typ ban_trns" onclick="Purchase.assignType(\'bank\',\''+branches[b].branch_id+'\')"><img src="http://3.7.44.132/aquacredit/assets/images/bank_tansfer.png" /><input type="radio" name="act_types_'+branches[b].branch_id+'" /><span> Bank Transfer </span></li>';
                        branch_tab+='<li class="cash_trns lnk_typ" onclick="Purchase.assignType(\'upi_cash\',\''+branches[b].branch_id+'\')"><img src="http://3.7.44.132/aquacredit/assets/images/cash_icn.png" /><input type="radio" name="act_types_'+branches[b].branch_id+'" /><span> Cash </span></li>';
                        branch_tab+='</ul>';

                        branch_tab+='<ul class="trans_inf" id="tsc_frm_bank_'+branches[b].branch_id+'">';
                        branch_tab+='<li class="app_date"><div class="cre_inp"><input type="text" class="form-control" id="ddate_'+branches[b].branch_id+'" name="ddate_'+branches[b].branch_id+'" value="" placeholder="Date" autocomplete="off"/></div></li>';

                        branch_tab+='<li class="us_bn_ls bank_'+branches[b].branch_id+'">';
                        //Admin Accounts
                        branch_tab+='<div class="check_wt_serc check_wt_serc_cstm" id="dadmin_'+branches[b].branch_id+'">';
                        branch_tab+='<div class="show_va">Select Bank</div>';
                        branch_tab+='<div class="selectVal" id="dadminacc_'+branches[b].branch_id+'">Select Bank</div>';
                        branch_tab+='<ul class="check_list" id="dbanklist_'+branches[b].branch_id+'">';
                        branch_tab+='<li>';
                        for(var i=0;i<adminacc.length;i++){
                        	var icon=adminacc[i].bank_name.toLowerCase()+'_icn.png';
                        	var bank_bal='₹'+Purchase.addCommasinamt(adminacc[i].avail_amount);
                        	var accont_numb=adminacc[i].account_no;
                        	branch_tab+='<div class="form-check" onclick="Purchase.selectTsAccount(\'dadmin\',\'banklist\',\''+adminacc[i].bank_id+'\',\''+branches[b].branch_id+'\')">';
                        	branch_tab+='<input class="form-check-input" type="radio" name="dadminacc" id="dadinput_'+adminacc[i].bank_id+'_'+branches[b].branch_id+'" value="'+adminacc[i].bank_id+'"/>';
                        	branch_tab+='<label class="form-check-label" for="dadlb_'+adminacc[i].bank_id+'_'+branches[b].branch_id+'">';
                        	branch_tab+='<div class="bank_logo"><img src="'+url+'/assets/images/'+icon+'" alt="" title=""/></div>';
                        	branch_tab+='<div class="bank_mny">';
                        	branch_tab+='<div class="bank_bal">'+bank_bal+'</div>';
                        	branch_tab+='<div class="accont_numb" id="dadmin_'+adminacc[i].bank_id+'_'+branches[b].branch_id+'">'+accont_numb+'</div>';
                        	branch_tab+='</div>';
                        	branch_tab+='</label>';
                        	branch_tab+='</div>';
                        }
                        branch_tab+='</li>';
                        branch_tab+='</ul>';
                        branch_tab+='</div>';
                        //Admin Accounts END
                        branch_tab+='</li>';

                        branch_tab+='<li class="bank_'+branches[b].branch_id+'"><div class="cre_inp"><input type="text" class="form-control" id="dname_'+branches[b].branch_id+'" name="dname_'+branches[b].branch_id+'" value="" placeholder="Driver name"/></div></li>';
                        branch_tab+='<li class="bank_'+branches[b].branch_id+'"><div class="cre_inp"><input type="text" class="form-control" id="dacc_'+branches[b].branch_id+'" name="dacc_'+branches[b].branch_id+'" value="" placeholder="Account number"/></div></li>';
                        branch_tab+='<li class="bank_'+branches[b].branch_id+'"><div class="cre_inp"><input type="text" class="form-control" id="difsc_'+branches[b].branch_id+'" name="difsc_'+branches[b].branch_id+'" value="" placeholder="IFC Code"/></div></li>';
                        branch_tab+='<li class="bank_'+branches[b].branch_id+'"><div class="cre_inp"><input type="text" class="form-control" id="dref_'+branches[b].branch_id+'" name="dref_'+branches[b].branch_id+'"  value="" placeholder="Reference Id"/></div></li>';
                        branch_tab+='<li class="upi_cash_'+branches[b].branch_id+'" style="display:none;"><div class="cre_inp"><input type="text" class="form-control" id="dmobile_'+branches[b].branch_id+'" name="dmobile_'+branches[b].branch_id+'" value="" placeholder="Mobile No"/></div></li>';
                        branch_tab+='<li class="upi_cash_'+branches[b].branch_id+'" style="display:none;"><div class="cre_inp"><textarea class="form-control" id="dnote_'+branches[b].branch_id+'" name="dnote_'+branches[b].branch_id+'" colspan="5" placeholder="Note"></textarea></div></li>';
                        branch_tab+='</ul>';
                        //Assign Type End

                        branch_tab+='</div>';
                        //Driver END

                        }*/

                        if (purchase_info.status == 'PM') {
                            branch_tab += '<div class="po_ftr" id="confirm_' + branches[b].branch_id + '">';
                            branch_tab += '<button class="btn fr sb_btn btn-primary" onclick="confirmBranch(\'' + branches[b].branch_id + '\')"> Confirm </button>';
                            branch_tab += '</div>';
                        }

                        branch_tab += '</div>';
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
                    setTimeout(function() {

                    }, 2000);


                    $('#overlay_id').hide();
                    //Purchase.loadSelect();
                });

        },
        openBranch: function(branch_id) {
            var bb_id = $('#bb_' + branch_id);
            var blist = $('#blist_' + branch_id);
            if (bb_id.hasClass("act_v")) {
                bb_id.removeClass('act_v');
                blist.removeClass('show_chk');
            } else {
                bb_id.addClass('act_v');
                blist.addClass('show_chk');
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

            var adminacc = $('#dadmin_' + branch_id);
            var banklist = $('#dbanklist_' + branch_id);
            setTimeout(function() {
                adminacc.removeClass('act_v');
                banklist.removeClass('show_chk');
            }, 200);
        },
        assignType: function(attr_text, branch_id) {
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
                    }

                    $('#overlay_id').hide();
                });
        },
        payType: function(ptype) {
            $("input[name='act_pay_types'][value='" + ptype + "']").prop('checked', true);
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

                        $('#overlay_id').hide();
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