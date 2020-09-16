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
var bpid = null;
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
            pur_lst_tbl = $('#pur_lst_tbl_new').DataTable({
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
                    url: API_URL + 'branchplist',
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
                        Purchase.getSummary();
                        return json.data;
                    }
                },
                //columns:[]
            });

            /*$("input[name='dateopt']").on('click',function(){
            	var dateopt=$("input[name='dateopt']:checked").val();
            	console.log(dateopt);
            	pur_lst_tbl.draw();
            });*/

            //Tabs
            $('#pur_lst_tbl_new_wrapper .dataTables_length').html('<ul class="tabs_tbl"><li class="act_tab drft_cl"><span>Pending Requests</span></li><li class="comp_cl"><span>Completed Requests</span></li></ul> <span class="tbl_btn"></span>');

            $('.drft_cl').click(function() {
                $("#hid_tabval").val(0);
                $('.tabs_tbl').removeClass('cmp_ul');
                $(this).addClass('act_tab');
                $('.comp_cl').removeClass('act_tab');
                pur_lst_tbl.columns([0, 1, 2, 3, 4, 5]).visible(true, true, true, true);
                pur_lst_tbl.columns.adjust().draw(false);
                //pur_lst_tbl.ajax.reload();
            });

            $('.comp_cl').click(function() {
                $("#hid_tabval").val(1);
                $('.tabs_tbl').addClass('cmp_ul');
                $(this).addClass('act_tab');
                $('.drft_cl').removeClass('act_tab');

                pur_lst_tbl.columns([5]).visible(false);
                pur_lst_tbl.columns([0, 1, 2, 3, 4]).visible(true, true, true, true);
                pur_lst_tbl.columns.adjust().draw(false);
                //pur_lst_tbl.ajax.reload();

            });
            //Tabs End

            $('#fine_inv').change(function(e) {
                try {
                    var invoice = e.target.files[0].name;
                    $("#invoice_file").text(invoice + ' is the selected file.');
                } catch (err) {

                }


            });

            $(document).on("click", "#pedit", function() {
                Purchase.editRequest();
            });

            $(document).on("click", "#pdel", function() {
                Purchase.confirmDelRequest();
            });

            $('body').on('click', function(e) {
                //did not click a popover toggle, or icon in popover toggle, or popover
                if ($(e.target).data('toggle') !== 'popover' &&
                    $(e.target).parents('[data-toggle="popover"]').length === 0 &&
                    $(e.target).parents('.popover.in').length === 0) {
                    $('[data-toggle="popover"]').popover('hide');
                }
            });
        },
        addCommasinamt: function(x) {
            if (x == '' || x == null || typeof x == 'undefined') {
                return;
            }

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
            jQuery.post(API_URL + '/bpSummary')
                .done(function(data) {
                    //summary
                    var result = $.parseJSON(data);
                    var pending = result.summary.pending;
                    var approved = result.summary.approved;
                    var paid = result.summary.paid;
                    var branch_confirm = result.summary.branch_confirm;
                    var completed = result.summary.completed;
                    var total_purchase = result.summary.total_purchase;
                    var total_purchase = (result.summary.total_purchase > 0) ? Purchase.addCommasinamt(result.summary.total_purchase) : 0;
                    //console.log(total_purchase);
                    //$('#total_purchase').html('₹');
                    $('#pending').html(pending);
                    $('#approved').html(approved);
                    $('#paid').html(paid);
                    $('#completed').html(completed);
                    $('#total_purchase').html('₹' + total_purchase);
                });
        },
        requestPopup: function() {
            var prod_list = '';
            productlist = {};
            userselectedprod = userselectedpdis = [];
            $('input[name="brand_id"]').attr('checked', false);
            $('#bselectVal').text("Brands");
            $('#reqbtn').show();
            $('#addproducts').empty();
            prod_list += '<tr>';
            prod_list += '<td colspan="3">Please select Brand</td>';
            prod_list += '</tr>';
            $('#addproducts').append(prod_list);
            $('#create_module').modal({ backdrop: 'static', keyboard: false });
        },
        getProducts: function(bid) {
            userselectedprod = [];
            userselectedpdis = [];
            productlist = {};
            brand_id = bid;
            pinc = 0;

            jQuery.post(API_URL + '/index', { brand_id: brand_id })
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
            //userselectedprod
            //console.log(pid);
            $('#pindex_' + pindex).remove();
            productlist[pindex].is_selected = false;
            productlist[pindex].is_deleted = true;

            //delete userselectedprod[pindex];
            // console.log(userselectedprod);
            // var rindex=(userselectedprod.length>1)?1:0;
            // userselectedprod.splice(pindex,rindex);
            //console.log(userselectedprod.length);
            //console.log(productlist);
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
                //console.log(index+'--'+value.pid);
                // Will stop running after "three"
                //return (value !== 'three');
            });

            //console.log(userselectedprod);

        },
        autoSearch: function() {
            $("#search").autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: API_URL + 'searchproduct',
                        method: "POST",
                        //headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        data: { keyword: $('#search').val(), 'brand_id': brand_id, 'userselectedpdis': userselectedpdis },
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
        onlyNumbers: function(event) {
            var charCode = (event.which) ? event.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57)) { return false; } else { return true; }
        },
        createRequest: function() {
            var prod_list = '';
            $('input[name="brand_id"]').attr('checked', false);
            $('#bselectVal').text("Brands");
            $('#reqbtn').show();
            $('#addproducts').empty();
            $('#editproducts').empty();
            prod_list += '<tr>';
            prod_list += '<td colspan="3">Please select Brand</td>';
            prod_list += '</tr>';
            $('#addproducts').append(prod_list);
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

            //Save Request
            jQuery.post(API_URL + '/saverequest', { brand_id: brand_id, userproducts: userselectedprod })
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
        purchaseact: function(bid, brand_id) {
            ebrand_id = null;
            bpid = null;
            bpid = bid;
            ebrand_id = brand_id;
            //console.log('####');

            $('#req_' + bpid).popover({
                html: true,
                content: function() {
                    return $('#popover-contents').html();
                },
                trigger: 'click'
            });
        },
        editRequest: function() {
            $('#addproducts').empty();
            var prod_list = '';
            eproductlist = {};
            euserselectedprod = [];
            euserselectedpdis = [];
            epinc = 0;
            $('#ebselectVal').text("");
            //$('input[name="ebrand_id"]').attr('checked',false);
            $('#ebrand_' + ebrand_id + '_id').attr('checked', true);
            var btext = $('#ebrand_lb_' + ebrand_id + '_id').text();
            $('#ebselectVal').text(btext.trim());

            //Loader Setup
            prod_list += '<tr>';
            prod_list += '<td colspan="3" align="center">' + loader_fa + '</td>';
            prod_list += '</tr>';
            $('#editproducts').append(prod_list);

            $('#edit_module').modal({ backdrop: 'static', keyboard: false });
            $('#bds_list_id').css('pointer-events', 'none');

            jQuery.post(API_URL + '/getreq_products', { brand_id: ebrand_id, bp_id: bpid })
                .done(function(data) {
                    $('#editproducts').empty();
                    var prod_list = '';
                    var result = $.parseJSON(data);
                    if (result.error == false) {
                        var purchase_info = result.bpurchase_info;
                        var products = result.bpurchase_details;
                        var is_disabled = result.is_disabled;
                        var upd_invoice_chrg = result.upd_invoice_chrg;
                        var wallet_bal = parseInt(result.wallet_amt);
                        ap_id = purchase_info.ap_id;

                        //P-pending,C-confirm,PM-payment,BC-branch confirm,CE-Complete
                        if (purchase_info.status == 'P') {
                            $('#uploading').hide();
                            var req_status_msg = "Request Pending - PBR";
                            formsteps.pending = true;
                            $('#bconfirm_note').hide();
                        } else if (purchase_info.status == 'C') {
                            formsteps.confirm = true;
                            //$('#invoice_up,#paymentbtn,#uploading').show();
                            $('#uploading').hide();
                            $('#updatebtn').show();
                            $('#bconfirm_note').hide();
                            var req_status_msg = "Request Approved - PBR";
                        } else if (purchase_info.status == 'PM') {
                            formsteps.payment = true;
                            $('#invoice_up,#paymentbtn,#uploading').show();
                            $('#updatebtn').hide();
                            var req_status_msg = "Confirm Request - PBR";
                            $('#bconfirm_note').show();
                        } else if (purchase_info.status == 'CE') {
                            formsteps.complete = true;
                            $('#updatebtn,#invoice_up,#paymentbtn,#uploading').hide();
                        } else {
                            //formsteps.received=true;
                            //$('#updatebtn').hide();
                        }

                        $('#req_status_id').text(req_status_msg + '' + purchase_info.bp_id);
                        for (var i = 0; i < products.length; i++) {
                            products[i].index = i;
                            products[i].is_selected = true;
                            products[i].is_deleted = false;
                            products[i].uqty = products[i].quantity;
                            prod_list += '<tr id="pindex_' + i + '">';
                            prod_list += '<td>' + products[i].pname + '</td>';

                            //purchase_info.status=='PM' || purchase_info.status=='C' || 
                            if (purchase_info.status == 'CE') {
                                prod_list += '<td class="txt_cnt qty_pp">' + products[i].uqty + '</td>';
                                prod_list += '<td class="red_clr act_pp txt_cnt">--</td>';
                            } else {
                                prod_list += '<td class="txt_cnt qty_pp"><input id="pqty_' + products[i].index + '" name="pqty_' + products[i].index + '" type="text" value="' + products[i].uqty + '" onkeypress="return Purchase.onlyNumbers(event);" maxlength="6"/></td>';
                                prod_list += '<td class="red_clr act_pp txt_cnt"><a javascript="void(0);" onclick="Purchase.delRequest(' + i + ');"><i class="fa fa-trash" aria-hidden="true"></i></a></td>';
                            }

                            prod_list += '</tr>';

                            if ((i + 1) == products.length && is_disabled == false) {
                                if (purchase_info.status == 'P' || purchase_info.status == 'PM') {
                                    prod_list += '<tr id="esearchtrid">';
                                    prod_list += '<td colspan="3"><input id="esearch" name="esearch" type="text" value="" placeholder="Search product"/></td>';
                                    prod_list += '</tr>';
                                }
                            }

                            eproductlist[i] = products[i];
                            euserselectedprod[i] = products[i];
                            euserselectedpdis[i] = products[i].pid;
                        }
                        epinc = products.length;
                    } else {
                        prod_list += '<tr>';
                        prod_list += '<td colspan="3">No Products Found</td>';
                        prod_list += '</tr>';
                    }

                    $('#editproducts').append(prod_list);
                    setTimeout(function() {
                        Purchase.eautoSearch();
                    }, 1000);

                    $('#overlay_id').hide();
                });


            /*
            $('#reqbtn').show();
            $('#addproducts').empty();
            prod_list+='<tr>';
            prod_list+='<td colspan="3">Please select Brand</td>';
            prod_list+='</tr>';
            $('#addproducts').append(prod_list);
            */
        },
        eautoSearch: function() {
            $("#esearch").autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: API_URL + 'searchproduct',
                        method: "POST",
                        //headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        data: { keyword: $('#esearch').val(), 'brand_id': ebrand_id, 'userselectedpdis': euserselectedpdis },
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
                        epinc = epinc + 1;
                        pinfo = ui.item.pinfo;
                        pinfo.index = (epinc - 1);
                        pinfo.is_selected = true;
                        pinfo.is_deleted = false;
                        pinfo.uqty = 1;

                        var prod = '';
                        prod += '<tr id="pindex_' + pinfo.index + '">';
                        prod += '<td>' + pinfo.pname + '</td>';
                        prod += '<td class="txt_cnt qty_pp"><input id="pqty_' + pinfo.index + '" name="pqty_' + pinfo.index + '" type="text" value="' + pinfo.uqty + '" onkeypress="return Purchase.onlyNumbers(event);" maxlength="6"/></td>';
                        prod += '<td class="red_clr act_pp txt_cnt"><a javascript="void(0);" onclick="Purchase.delRequest(' + pinfo.index + ');"><i class="fa fa-trash" aria-hidden="true"></i></a></td>';
                        prod += '</tr>';
                        $("#esearchtrid").before(prod);
                        eproductlist[pinfo.index] = pinfo;
                        Purchase.updateUserSelectedProd();
                    }
                },
                change: function() {
                    //$("#search").val("");
                },
                close: function(event, ui) {
                    $("#esearch").val("");
                }
            });
        },
        updateUserSelectedProd: function() {
            euserselectedprod = [];
            euserselectedpdis = [];
            $.each(eproductlist, function(index, value) {
                if (value.is_selected) {
                    euserselectedprod.push(value);
                    euserselectedpdis.push(value.pid);
                }
                //console.log(index+'--'+value.pid);
                // Will stop running after "three"
                //return (value !== 'three');
            });

            //console.log(userselectedprod);

        },
        updateRequest: function() {
            //productlist,userselectedprod
            //table-danger
            if (euserselectedprod.length == 0) {
                $("#emsg").addClass('badge badge-danger').html("Please select products!");
                setTimeout(function() {
                    $("#emsg").removeClass('badge badge-danger').html("");
                }, 2500);
                return;
            }

            var validate = false;
            for (var i = 0; i < euserselectedprod.length; i++) {

                var pinfo = euserselectedprod[i];
                var index = pinfo.index;
                var qty = $('#pqty_' + index).val();
                if (qty == '') {
                    $('#pindex_' + index).addClass('table-danger');
                    validate = true;
                } else {
                    $('#pindex_' + index).removeClass('table-danger');
                    euserselectedprod[i].qty = $('#pqty_' + index).val();
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

            document.getElementById("updatebtn").disabled = true;
            $("#ereqloader").html(loader_fa);

            //Save Request
            jQuery.post(API_URL + '/saverequest', { brand_id: ebrand_id, userproducts: euserselectedprod, ap_id: ap_id, bp_id: bpid })
                .done(function(data) {
                    var process_done = false;
                    var cls = '';
                    var result = $.parseJSON(data);
                    if (result.update_staus) {
                        process_done = true;
                        message = 'Request updated successfully !';
                        cls = 'badge badge-success';
                    } else {
                        process_done = true;
                        message = 'Request failed try again !';
                        cls = 'badge badge-danger';
                    }

                    if (process_done) {
                        $("#emsg").addClass(cls).html(message);
                        setTimeout(function() {
                            $("#emsg").removeClass(cls).html('');
                            document.getElementById("updatebtn").disabled = false;
                            $("#ereqloader").html("");
                            pur_lst_tbl.draw();
                        }, 2000);
                    }
                });
        },
        updatePayment: function() {
            $('#error').empty();
            if (euserselectedprod.length == 0) {
                $("#emsg").addClass('badge badge-danger').html("Please select products!");
                setTimeout(function() {
                    $("#emsg").removeClass('badge badge-danger').html("");
                }, 2500);
                return;
            }

            var validate = false;
            for (var i = 0; i < euserselectedprod.length; i++) {

                var pinfo = euserselectedprod[i];
                var index = pinfo.index;
                var qty = $('#pqty_' + index).val();
                if (qty == '') {
                    $('#pindex_' + index).addClass('table-danger');
                    validate = true;
                } else {
                    $('#pindex_' + index).removeClass('table-danger');
                    euserselectedprod[i].qty = $('#pqty_' + index).val();
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

            //unloading_charges,transport_charges
            var unloading_charges = $('#unloading_charges').val();
            var transport_charges = $('#transport_charges').val();

            /*var pay_by='';
            if($('#admin_pay_by').is(":checked")){
             pay_by='admin';
            }else if($('#branch_pay_by').is(":checked")){
             pay_by='branch';	
            }*/

            var error = '';
            if (unloading_charges == '' || unloading_charges == 0 || typeof unloading_charges === "undefined") {
                error += '<p style="color:red;">Unloading charges is required</p>';
            }


            if (transport_charges == '' || transport_charges == 0 || typeof transport_charges === "undefined") {
                error += '<p style="color:red;">Transport charges is required</p>';
            }

            if ($('input[name=fine_inv]')[0].files[0] == '' || typeof $('input[name=fine_inv]')[0].files[0] === 'undefined') {
                error += '<p style="color:red;">Invoice is required</p>';
            }

            var pay_by = $('#pay_by').val();
            if (pay_by == 'admin') {
                if (!$('#admin_pay_by').is(":checked")) {
                    error += '<p style="color:red;">Please check the admin pay</p>';
                }
            }

            if (error != '') {
                $('#error').append(error);
                return false;
            }

            $('#overlay_id').show();
            //$('#epayloader').html(loader_fa);
            //document.getElementById("paymentbtn").disabled=true;
            var formData = new FormData($('#branch_edit')[0]);
            formData.append('unloading_charges', unloading_charges);
            formData.append('transport_charges', transport_charges);
            formData.append('invoice_file', $('input[name=fine_inv]')[0].files[0]);
            formData.append('ap_id', ap_id);
            formData.append('bpid', bpid);
            formData.append('brand_id', ebrand_id);
            formData.append('pay_by', pay_by);
            formData.append('userproducts', JSON.stringify(euserselectedprod));
            $.ajax({
                url: API_URL + '/confirmbranch',
                type: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    var result = $.parseJSON(data);
                    if (result.admin_pay) {
                        $('#bwallet_remain').show();
                        $('#branch_pay_by').prop('checked', false);
                        $('#bwallet_bal').text(result.wallet_bal);
                        //$('#admin_pay_by').prop('checked',true);
                        $('#pay_by').val('admin');
                        $('#overlay_id').hide();
                    } else {
                        if (result.confirm_status) {
                            $('#updatebtn,#invoice_up,#paymentbtn,#uploading').hide();
                            pur_lst_tbl.draw();
                        }
                        Purchase.editRequest();
                    }
                    //document.getElementById("paymentbtn").disabled=false;
                    //$('#epayloader').html('');
                }
            });

        },
        delRequest: function(pindex) {
            //userselectedprod
            //ap_id:ap_id,bp_id:bpid
            $('#overlay_id').show();
            jQuery.post(API_URL + '/delrequest', { bp_id: bpid, ap_id: ap_id, delprod: eproductlist[pindex] })
                .done(function(data) {
                    $('#pindex_' + pindex).remove();
                    var result = $.parseJSON(data);
                    if (result.all_prod_removed) {
                        $('#mcontent_id').empty();
                        $('#mcontent_id').html('<h2>Request removed.Please create another request</h2>');
                        setTimeout(function() {
                            $('#edit_module').modal('hide');
                        }, 2000);
                    }
                    eproductlist[pindex].is_selected = false;
                    eproductlist[pindex].is_deleted = true;
                    Purchase.updateUserSelectedProd();
                    pur_lst_tbl.draw();
                    $('#overlay_id').hide();
                });

            //console.log(eproductlist[pindex]);
            //return;

        },
        confirmDelRequest: function() {
            $('#brand_name').empty();
            var brand = $('#req_' + bpid).attr("data-brand");
            //var result=$.parseJSON(JSON.stringify(res));
            //console.log(brand);
            $('#brand_name').html('<b>' + brand + '</b>')
            $('#delete_req').modal('show');
        },
        deleteReq: function() {
            //console.log(bpid+'=='+ebrand_id);
            $('#delete_req').modal('hide');
            $('#overlay_list_id').show();

            jQuery.post(API_URL + '/deletebranchreq', { bp_id: bpid, brand_id: ebrand_id })
                .done(function(data) {
                    pur_lst_tbl.draw();
                    $('#overlay_list_id').hide();
                });
        },
        viewProducts: function(bid, brand_id) {
            $('#view_overlay_id').show();
            $('#vbselectVal').text("");
            $('#vebrand_' + brand_id + '_id').attr('checked', true);
            var btext = $('#vebrand_lb_' + brand_id + '_id').text();
            $('#vbselectVal').text(btext.trim());

            //console.log(bid+'#####'+brand_id);
            $('#view_module').modal({ backdrop: 'static', keyboard: false });
            $('#vbds_list_id').css('pointer-events', 'none');
            jQuery.post(API_URL + '/getpbrreq_products', { brand_id: brand_id, bp_id: bid })
                .done(function(data) {
                    $('#viewproducts').empty();
                    var prod_list = '';
                    var result = $.parseJSON(data);
                    if (result.error == false) {
                        var purchase_info = result.bpurchase_info;
                        var products = result.bpurchase_details;

                        for (var i = 0; i < products.length; i++) {
                            prod_list += '<tr id="vpindex_' + i + '">';
                            prod_list += '<td>' + products[i].pname + '</td>';
                            prod_list += '<td>' + products[i].prod_price + '</td>';
                            prod_list += '<td>' + products[i].purchase_amt + '</td>';
                            prod_list += '</tr>';
                        }
                    } else {
                        prod_list += '<tr>';
                        prod_list += '<td colspan="3">No Products Found</td>';
                        prod_list += '</tr>';
                    }

                    $('#viewproducts').append(prod_list);
                    $('#view_overlay_id').hide();
                });
        }
    };
    $(document).ready(function($) {
        Purchase.init();
        //Scheduler.getScheduleList();
    });
})(jQuery);