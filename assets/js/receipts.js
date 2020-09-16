$(document).ready(function() {

    getadminbanks('add');
    $(".guest_block").hide();
    $(".guest_block_edit").hide();

    function cb(start, end) {
        $('#date_val').val(start.format('D/MMM/YYYY') + ' - ' + end.format('D/MMM/YYYY'));
        if ($('#date_val').val() == "Invalid date - Invalid date") {
            $('#date_val').val('');
        } else {
            $('#date_val').val(start.format('D/MMM/YYYY') + ' - ' + end.format('D/MMM/YYYY'));
        }
    }

    $('#reportrange').daterangepicker({
        //timePicker: true,
        /* startDate: null,
        endDate: null, */
        opens: 'left',
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
            'Last 6 Months': [moment().subtract(6, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
            "Last Year": [moment().subtract(1, "y").startOf("year"), moment().subtract(1, "y").endOf("year")]
        }
    }, cb);

    $('.lnk_typ.ban_trns').click(function() {
        $(this).addClass('act_type');
        $(this).siblings('.cash_trns').removeClass('act_type');
        $("input[name='trans_type']:checked").val('bank');
        $("#bank_block").show();
        $("#selected_type").val('BANK');
        getadminbanks('add');
    });
    $('.lnk_typ.cash_trns').click(function() {
        $(this).addClass('act_type');
        $(this).siblings('.ban_trns').removeClass('act_type');
        $("input[name='trans_type']:checked").val('cash');
        //$("#bank_block").hide();
        $("#selected_type").val('CASH');
        getadminbanks('add');
    });

    $('.lnk_typ.brd_icn').click(function() {
        $(this).addClass('act_type');
        $(this).siblings('.trd_icn, .usr_icn').removeClass('act_type');
        $("input[name='user_type']:checked").val('brand');
    });

    $('.lnk_typ.usr_icn').click(function() {
        $('#skey').val('');
        $('#selectuser_id').val('');
        $('#select_usercode').val('');
        $('#select_usertype').val('');
        $("#crop_opt_li").html('<div class="form-check"><input class="form-check-input" type="radio" name="crop_opt" id="crp" /><label class="form-check-label" for="crp"></label></div>');
        $(".cval").text('Crop location');

        $(this).addClass('act_type');
        $(this).siblings('.trd_icn, .brd_icn').removeClass('act_type');
        $("input[name='user_type']:checked").val('user');
        $(".uname_val").text("User Name / Mobile");
        $(".sel_loc").show();
    });

    $('.lnk_typ.trd_icn').click(function() {

        $('#skey').val('');
        $('#selectuser_id').val('');
        $('#select_usercode').val('');
        $('#select_usertype').val('');
        $("#crop_opt_li").html('<div class="form-check"><input class="form-check-input" type="radio" name="crop_opt" id="crp" /><label class="form-check-label" for="crp"></label></div>');
        $(".cval").text('Crop location');

        $(this).addClass('act_type');
        $(this).siblings('.brd_icn, .usr_icn').removeClass('act_type');
        $("input[name='user_type']:checked").val('trader');
        $(".uname_val").text("Trader Name / Mobile");
        $(".sel_loc").hide();
        $('#guest_mob').val('');
        $(".guest_block").hide();
    });

    // On Edit Links
    $('.lnk_typ.ban_trns_edit').click(function() {
        $(this).addClass('act_type');
        $(this).siblings('.cash_trns_edit').removeClass('act_type');
        $("input[name='trans_type_edit']:checked").val('bank');
        $("#bank_block_edit").show();
    });
    $('.lnk_typ.cash_trns_edit').click(function() {
        $(this).addClass('act_type');
        $(this).siblings('.ban_trns_edit').removeClass('act_type');
        $("input[name='trans_type_edit']:checked").val('cash');
        $("#bank_block_edit").hide();
    });

    $('.lnk_typ.usr_icn_edit').click(function() {

        $(this).addClass('act_type');
        $(this).siblings('.trd_icn_edit, .brd_icn_edit').removeClass('act_type');
        $("input[name='user_type_edit']:checked").val('user');
        $(".uname_val_edit").text("User Name / Mobile");
        $(".sel_loc_edit").show();

    });

    $('.lnk_typ.trd_icn_edit').click(function() {

        $(this).addClass('act_type');
        $(this).siblings('.brd_icn_edit, .usr_icn_edit').removeClass('act_type');
        $("input[name='user_type']:checked").val('trader');
        $(".uname_val_edit").text("Trader Name / Mobile");
        $(".sel_loc_edit").hide();

    });

    // End Edit Links

    $('.stat_Reg, .bnk_dl_li').popover({
        trigger: 'focus'
    });

    var tables = $('#loan_lst_tbl_pend').DataTable({
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        "ordering": false,
        language: {
            searchPlaceholder: "Search Receipt Details",
            search: "",
            "dom": '<"toolbar">frtip'
        },
        "columnDefs": [
            { className: "id_td", "targets": 0 },
            { className: "app_date", "targets": 1 },
            { className: "usr_dtl", "targets": 2 },
            { className: "loan_amnt", "targets": 4 },
            { className: "txt_cnt stat_blk", "targets": 5 },
            { className: "txt_cnt stat_blk", "targets": 6 },
            { className: "act_ms", "targets": 7 }
        ],
        'ajax': {
            'url': url + 'api/receipts/get_receipts',
            'data': function(data) {
                // Read values
                var trans_opt = $("input[name='trans_opt']:checked").val();
                var reportrange = $('#date_val').val();
                var tabval = $("#hid_tabval").val();
                var utype_opt = $('input[name="user_type_opt"]:checked').val();
                // Append to data
                data.trans_opt = trans_opt;
                data.reportrange = reportrange;
                data.tabval = tabval;
                data.utype_opt = utype_opt;
            },
            "dataSrc": function(json) {

                $(".tot_user_amt").html('₹' + addCommas(json.tot_user_amt));
                $(".tot_trader_amt").html('₹' + addCommas(json.tot_trader_amt));
                $(".f_amt").html('₹' + addCommas(json.farmer_amt));
                $(".nf_amt").html('₹' + addCommas(json.non_farmer_amt));
                $(".dl_amt").html('₹' + addCommas(json.dealer_amt));
                $(".g_amt").html('₹' + addCommas(json.guest_amt));
                $(".ag_amt").html('₹' + addCommas(json.agent_amt));
                $(".exp_amt").html('₹' + addCommas(json.exporter_amt));
                return json.data;
            }
        }
    });

    $(document).on('click', '[data-toggle="popover"]', function() {
        var $this = $(this);
        if (!$this.data('bs.popover')) {
            $this.popover({
                content: popoverContent,
                html: true,
                trigger: 'focus',
                delay: {
                    hide: "100"
                },
            }).popover('show');
        }
    });

    function popoverContent() {
        var content = '';
        var element = $(this);
        var id = element.attr("data-id");
        $("#r_id").val(id);
        content = $("#popover-content").html();
        return content;
    }

    $("input[name='trans_opt']").on('click', function() {
        tables.draw();
    });
    $("input[name='user_type_opt']").on('click', function() {
        tables.draw();
    });

    $(".ranges ul li ").mouseup(function() {

        $(this).parent().children().removeClass('active');
        $(this).addClass('active');
        $('.drp-selected').css('font-weight', 'bold');
        if ($(this).text() == "Till Date") {
            setTimeout(function() {
                $("#date_val").val('Till Date');
            }, 500);

        }

        if ($(this).text() != "Date Range") {

            setTimeout(function() {
                tables.draw();
            }, 500);
        }

        /* $('.mydateDiv').text($('.drp-selected').text());
        $('.drp-selected').hide();
        $('.mydateDiv').addClass('drp-selected'); */

    });
    $(".applyBtn").on("click", function() {

        setTimeout(function() {
            tables.draw();
        }, 500);

    });
    $("#receipt_date").parent().addClass('inp_ss');
    var dateToday = new Date();
    $("#receipt_date").datepicker({
        dateFormat: 'dd-M-yy',
        //defaultDate: "+1w",
        changeMonth: true,
        changeYear: true,
        maxDate: dateToday,
        numberOfMonths: 1,
        onSelect: function(selected) {
            $("#receipt_date").parent().addClass('inp_ss');
        }
    }).datepicker("setDate", 'now');

    $("#skey").autocomplete({
        //source: url+"api/users/searchusers",
        source: function(request, response) {
            $('#selectuser_id').val('');
            $('#select_usercode').val('');
            $('#select_usertype').val('');
            $(".guest_block").hide();
            $("#crop_opt_li").html('<div class="form-check"><input class="form-check-input" type="radio" name="crop_opt" id="crp" /><label class="form-check-label" for="crp"></label></div>');
            $(".cval").text('Crop location');
            var dyn_url = url + "api/users/searchusers";
            var utype = $("input[name='user_type']:checked").val();
            if (utype == "trader") { dyn_url = url + "api/trades/searchtrader"; }
            // Fetch data
            $.ajax({
                url: dyn_url,
                type: 'post',
                dataType: "json",
                data: {
                    search: request.term,
                    allusers: 1
                },
                success: function(data) {

                    response($.map(data, function(result) {

                        return {

                            label: result.label,
                            value: result.value,
                            imgsrc: result.img,
                            user_id: result.user_id,
                            usercode: result.usercode,
                            user_type: result.user_type,
                            guest: result.guest,
                            guest_mobile: result.guest_mobile

                        }

                    }));

                }
            });
        },
        select: function(event, ui) {
            // Set selection	
            $("#snackbar").removeClass("show");
            var err_msg = "";
            err_msg = ui.item.user_type.toLowerCase().replace("_", "-");
            if (ui.item.guest == 1) { err_msg = "guest"; }

            var user_or_trader = $('input[name="user_type"]:checked').val();
            if (ui.item.user_type == "NON_FARMER" || ui.item.user_type == "DEALER" || user_or_trader == "trader" || ui.item.guest == 1) {

                $('input[name="crop_opt"]').removeAttr('required');
                $(".sel_loc").hide();
                if (ui.item.guest == 1) {
                    $(".guest_block").show();
                } else {
                    $(".guest_block").hide();
                }
            } else {
                $('input[name="crop_opt"]').prop('required', true);
                $(".sel_loc").show();
                $(".guest_block").hide();

            }

            $("#snackbar_succ").text('You have selected ' + err_msg + '!');
            $("#snackbar_succ").addClass("show");
            setTimeout(function() { $("#snackbar_succ").removeClass("show"); }, 3000);

            /*  $(".cval").text('Crop Loaction');
		$(".bval").text('Select User Bank');  */
            $('#skey').val(ui.item.label); // display the selected text
            $('#selectuser_id').val(ui.item.user_id); // save selected id to input
            $('#select_usercode').val(ui.item.usercode);
            $('#select_usertype').val(ui.item.user_type);
            $('#select_guest').val(ui.item.guest); // 
            $('#guest_mob').val(ui.item.guest_mobile);
            //$(".guest_block").show(); 
            getusercrops(ui.item.user_id, 'add');
            //return false;
        }

    }).data("ui-autocomplete")._renderItem = function(ul, item) {
        return $("<li></li>")
            .data("item.autocomplete", item)
            .append("<a>" + "<img style='width:25px;height:25px' src='" + item.imgsrc + "' /> " + item.label + "</a>")
            .appendTo(ul);
    };

    $.validator.addMethod("user_check", function(value, element) {
        return ($("#selectuser_id").val() != "");
    }, "User is not registered!");

    var validator = $('#receipt_frm').validate({
        debug: false,
        ignore: '',
        rules: {
            admin_bank: {
                required: true,
            },
            receipt_amt_commas: {
                required: true,
            },
            skey: {
                required: true,
                user_check: true,
            },
            crop_opt: {
                required: function(element) {
                    return ($("input[name='user_type']:checked").val() == "user") ? (($("#select_usertype").val() == "FARMER") ? (($("#select_guest").val() == "0") ? true : false) : false) : false;
                }
            },
        },
        messages: {
            admin_bank: {
                required: "Mandatory",
            },
            receipt_amt_commas: {
                required: "Mandatory",
            },
            skey: {
                required: "Mandatory",
                user_check: "Select User",
            },
            crop_opt: {
                required: "Mandatory",
            },
        },
        showErrors: function(errorMap, errorList) {
            // Clean up any tooltips for valid elements
            $.each(this.validElements(), function(index, element) {
                var $element = $(element);
                var parent = $element.parent().attr('class');
                if (parent == "form-check" || parent == "form-check") {
                    $(element).closest(".check_wt_serc").data("title", "").tooltip("dispose");
                    $(element).closest(".check_wt_serc").css("border", "");
                } else {
                    $element.data("title", "").removeClass("error").tooltip("dispose");
                    $(element).parent().css("border", "");
                }
            });


            $.each(errorList, function(index, error) {
                var $element = $(error.element);
                if (error.element.name == "crop_opt" || error.element.name == "admin_bank") {
                    $element.closest(".check_wt_serc").tooltip("dispose").data("title", error.message).data("placement", "top").tooltip({ onShow: function() { this.getTrigger().fadeTo("slow", 0.8); } });

                    $("#" + error.element.id).closest(".check_wt_serc").css("border", "1px solid red");
                } else {
                    $element.tooltip("dispose").data("title", error.message).data("placement", "bottom").addClass("error").tooltip({ onShow: function() { this.getTrigger().fadeTo("slow", 0.8); } });

                    $("#" + error.element.id).parent().css("border", "1px solid red");
                }
            });
        },
        submitHandler: function(form) {
            $('#cnf_rec').modal();
        }
    });
    // Form submit
    /* $('.rec_sen_btn').click(function() {

        $("#snackbar_succ").removeClass("show");
        var err = 0;
        var err_msg = tagid = "";
        var trans_type = $('input[name="trans_type"]:checked').val();
        var receipt_date = $("#receipt_date").val();
        var admin_bank = $('input[name="admin_bank"]:checked').val();
        var rece_amt = $("#receipt_amt_commas").val();
        var skey = $("#skey").val();
        var sel_userid = $("#selectuser_id").val();
        var crop_opt = $('input[name="crop_opt"]:checked').val();
        var user_type = $('#select_usertype').val();
        var guest = $('#select_guest').val();

        if (receipt_date == "") {
            err = 1;
            err_msg = "Please select receipt date!";
            tagid = "#receipt_date";
            return form_validation(err, err_msg, tagid);
        }
        if (trans_type == "bank") {
            if (admin_bank == undefined) {
                err = 1;
                err_msg = "Please select admin bank!";
                tagid = ".admin_bank";
                return form_validation(err, err_msg, tagid);
            }
        }
        if (trans_type == "cash") {
            if (admin_bank == undefined) {
                err = 1;
                err_msg = "Please select cash account!";
                tagid = ".admin_bank";
                return form_validation(err, err_msg, tagid);
            }
        }
        if (rece_amt == "") {
            err = 1;
            err_msg = "Please enter receipt amount!";
            tagid = "#receipt_amt_commas";
            return form_validation(err, err_msg, tagid);
        }
        if (sel_userid == "") {
            err = 1;
            err_msg = "Please select user!";
            tagid = "#skey";
            return form_validation(err, err_msg, tagid);
        }
        if (user_type == "FARMER" && guest == 0) {
            if (crop_opt == undefined) {
                err = 1;
                err_msg = "Please select crop location!";
                tagid = ".crop_opt";
                return form_validation(err, err_msg, tagid);
            }
        }

        // form submit
        if (err == 0) {
            $('#cnf_rec').modal();
        }
    }); */

    $(".cnf_yes").click(function(e) {
        e.preventDefault();
        formData = new FormData(receipt_frm);
        var dynurl = url + "api/receipts/add";
        var dynsucc = "Receipt created successfully!";
        $.ajax({
            url: dynurl,
            data: formData,
            type: 'POST',
            contentType: false,
            processData: false,
            enctype: 'multipart/form-data',
            datatype: 'json',
            success: function(response) {
                //alert(response);
                res = JSON.parse(response);
                if (res.status == 'success') {
                    new PNotify({
                        title: 'Success',
                        text: dynsucc,
                        type: 'success',
                        shadow: true
                    });
                    validator.resetForm();
                    getadminbanks('add');
                    $('.mykey').parent().css("border", "");
                    //setInterval('location.reload()', 2000);
                    $("#receipt_frm")[0].reset();
                    $("#receipt_date").datepicker({
                        dateFormat: 'dd-M-yy',
                        //defaultDate: "+1w",
                        changeMonth: true,
                        changeYear: true,
                        maxDate: dateToday,
                        numberOfMonths: 1,
                        onSelect: function(selected) {
                            $("#receipt_date").parent().addClass('inp_ss');
                        }
                    }).datepicker("setDate", 'now');
                    //$(".amon_text").hide();
                    $("#crop_opt_li").html('<div class="form-check"><input class="form-check-input" type="radio" name="crop_opt" id="crp" /><label class="form-check-label" for="crp"></label></div>');
                    $(".cval").text('Crop location');
                    $("input[name='user_type']:checked").val('user');
                    $(".usr_icn").addClass('act_type');
                    $(".trd_icn").removeClass('act_type');
                    $(".uname_val").text("User Name / Mobile");
                    $(".sel_loc").show();

                    /* $("#admin_bank_li").html('<div class="form-check"><input class="form-check-input" type="radio" name="admin_bank" id="bnk" /><label class="form-check-label" for="bnk"></label></div>'); */
                    $(".admin_bank_val").text('Select Account');
                    $("#bank_block").show();
                    $(".guest_block").hide();

                    tables.ajax.reload();
                } else {
                    new PNotify({
                        title: 'Error',
                        text: 'Something went wrong, try again!',
                        type: 'failure',
                        shadow: true
                    });
                }
            }
        });
    });

    $(".del_yes").click(function() {
        var delval = $("#r_id").val();
        $.ajax({
            url: url + "api/receipts/delete",
            data: { rc_id: delval },
            type: 'POST',
            datatype: 'json',
            success: function(response) {

                res = JSON.parse(response);

                if (res.status == 'success') {
                    new PNotify({
                        title: 'Success',
                        text: "Receipt deleted successfully!",
                        type: 'success',
                        shadow: true
                    });
                    tables.ajax.reload();
                    getadminbanks('add');
                }
            }
        });
    });

    $('.edt_bl_lnk').click(function() {
        $('.app_pop_tbl').toggleClass('disb_sel');
        $('.ds_as_type').toggleClass('show_blk');
        var x = document.getElementById("myDIV");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    });

    $('.reject_tr').click(function() {
        $(this).addClass('bdr_t_1');
        $('.rej_list').toggleClass('hide_blk');
        $('.cmp_list').addClass('hide_blk');
    });

    $('.comp_blk_tr').click(function() {
        $('.reject_tr').removeClass('bdr_t_1');
        $('.cmp_list').toggleClass('hide_blk');
        $('.rej_list').addClass('hide_blk');
    });

    $('#loan_lst_tbl_pend_wrapper .dataTables_length').html('<ul class="tabs_tbl"><li class="act_tab drft_cl"> <span>Users</span> </li><li class="comp_cl"> <span> Traders </span> </li></ul> <span class="tbl_btn">  </span>');

    // $('#loan_lst_tbl_pend_wrapper .dataTables_length').html('<h2 class="create_hdg lng_hdg"> Receipts List </h2>');

    // <a href="#" class="appr_all"> Approve All </a>
    $(".loan_btm div.toolbar").html('<b>SSS</b>');
    $('.loan_btm a.toggle-vis').on('click', function(e) {
        $(this).parent().toggleClass('act');
        e.preventDefault();
        var column = tables.column($(this).attr('data-column'));
        column.visible(!column.visible());
    });

    $('.dataTables_paginate').html('<a href="#" title=""> Show More </a>');

    $('.tbl_check').popover({
        html: true,
        content: function() {
            return $('#popover-tbl').html();
        }
    });

    $('.act_icns').popover({
        html: true,
        content: function() {
            return $('#popover-contents').html();
        }
    });

    $('.utypes').show();
    $('.ttypes').hide();
    $('.comp_cl').click(function() {
        $("#hid_tabval").val(1);
        $('.utypes').hide();
        $('.ttypes').show();
        $('input[name="user_type_opt"][value=""]').prop('checked', true);
        $('.tabs_tbl').addClass('cmp_ul');
        $(this).addClass('act_tab');
        $('.drft_cl').removeClass('act_tab');
        tables.columns.adjust().draw(false);
        tables.ajax.reload();
    });
    $('.drft_cl').click(function() {
        $("#hid_tabval").val(0);
        $('.utypes').show();
        $('.ttypes').hide();
        $('input[name="user_type_opt"][value=""]').prop('checked', true);
        $('.tabs_tbl').removeClass('cmp_ul');
        $(this).addClass('act_tab');
        $('.comp_cl').removeClass('act_tab');
        tables.columns.adjust().draw(false);
        tables.ajax.reload();
    });


    $('.amnt input, .ln_amn_blk input').popover();
    $('.actvty .anlat_user').popover({
        html: true,
        content: function() {
            return $('#popover-ana_usr').html();
        }
    });

    $('.actvty .anlat_trader').popover({
        html: true,
        content: function() {
            return $('#popover-ana_trd').html();
        }
    });

    $('.crt_link').click(function() {
        $('.trade_create').toggleClass('sh_trade_create');
        $('.trd_cr_r').toggleClass('trd_cr_r_r');
        $(this).find('.btn').toggleClass('hide_blk');
        $('.cl_crt_bl').toggleClass('hide_blk');

    });

    $(document).on("click", ".edt , .vw", function() {
        $('#apr_loan').modal();
    });

    $(document).on("click", ".appr_all", function() {
        $('#apr_loans').modal();
    });

    $(document).on("click", ".del", function() {
        $('#delete_user').modal();
    });
    $(document).on("click", ".edt", function() {
        rc_id = $("#r_id").val();
        edit_receipt(rc_id);
    });
});

function form_validation(err, err_msg, tagid) {
    $('.mykey').parent().css("border", "");
    $("#snackbar").text(err_msg);
    $("#snackbar").addClass("show");
    setTimeout(function() { $("#snackbar").removeClass("show"); }, 3000);
    $(tagid).parent().css("border", "1px solid red");
    //$("#tname").css("border", "1px solid red");
    $(tagid).focus();
    return false;
}

function edit_receipt(rc_id) {
    $("#receiptfrm_edit")[0].reset();
    $("#hid_rc_id").val(rc_id);
    $.ajax({
        url: url + "api/receipts/receipt_details/" + rc_id,
        data: {},
        type: 'POST',
        datatype: 'json',
        success: function(response) {
            res = JSON.parse(response);
            if (res.data.transfer_from_type == "user") {
                $(".uname_val_edit").text('User Name');
                (res.data.user_name) ? $("#skey_edit").val(res.data.user_name): $("#skey_edit").val(res.data.owner_name);
                $("#selectuser_id_edit").val(res.data.from_user_id);
                $("#select_usercode_edit").val(res.data.user_code);

                $('.lnk_typ.usr_icn_edit').addClass('act_type');
                $('.lnk_typ.trd_icn_edit').removeClass('act_type');
                //$('#bank_opt_edit').addClass('required');				
                //$('.adm_bn_ls').show();

                if (res.data.user_type == "FARMER" && res.data.typeofuser == 0) {
                    //$(".row_right").css('padding-left','5px');
                    $('.sel_loc_edit').show();
                    getusercrops(res.data.from_user_id, "edit");
                    //$("input[name='crop_opt_edit'][value='"+res.data.from_crop_id+"']").prop('checked', true);
                    $(".crop_val").text(res.data.crop_location);
                    $('.guest_block_edit').hide();
                    $('#guest_mob_edit').val('');
                } else {
                    $(".row_right").css('padding-left', '0px');
                    $('.sel_loc_edit').hide();
                    $('.guest_block_edit').hide();
                    $('#guest_mob_edit').val('');
                    if (res.data.typeofuser == 1) {
                        $(".uname_val_edit").text('Guest Name');
                        $('.guest_block_edit').show();
                        $('#guest_mob_edit').val(res.data.mobile);
                    }
                }

            } else if (res.data.transfer_from_type == "trader") {

                $(".uname_val_edit").text('Trader Name');
                if (res.data.trader_type == "Agent") {
                    $("#skey_edit").val(res.data.full_name);
                } else {
                    $("#skey_edit").val(res.data.contact_person);
                }
                $("#selectuser_id_edit").val(res.data.td_id);
                //$("#select_usercode_edit").val(res.data.user_code);

                $('.lnk_typ.usr_icn_edit').removeClass('act_type');
                $('.lnk_typ.trd_icn_edit').addClass('act_type');
                //$('#bank_opt_edit').removeClass('required');								
                $('.sel_loc_edit').hide();
                $(".row_right").css('padding-left', '0px');
            }

            $("#edit_id").html(' - RCP' + res.data.rc_id);
            $("#ref_no_edit").val(res.data.reference_no);

            if (res.data.receipt_note != "") {
                $(".ad_nt").addClass('sh_nt');
                $("#rece_note_edit").val(res.data.receipt_note);
            }
            $("#hid_crop_id").val(res.data.from_crop_id);
            $("#receipt_amt_edit").val(res.data.transfer_amt);
            $("#receipt_amt_commas_edit").val(addCommas(res.data.transfer_amount));
            $("#admin_bank_edit").val(res.data.account_number);

            if (res.data.transfer_type == "bank") {
                $('.lnk_typ.ban_trns_edit').addClass('act_type');
                $('.lnk_typ.cash_trns_edit').removeClass('act_type');
                //$('#bank_opt_edit').addClass('required');				
                $('.adm_bn_ls').show();

            } else if (res.data.transfer_type == "cash") {
                $('.lnk_typ.ban_trns_edit').removeClass('act_type');
                $('.lnk_typ.cash_trns_edit').addClass('act_type');
                //$('#bank_opt_edit').removeClass('required');								
                $('.adm_bn_ls').hide();
            }

            var new_receipt_date = new Date(res.data.receipt_date);
            $("#receipt_date_edit").datepicker({
                dateFormat: 'd-M-yy'
            }).datepicker('setDate', new_receipt_date);
        }
    });
}
// Custom functions
function getadminbanks(addoredit) {
    var sel_type = $('#selected_type').val();
    var aeval = hidbank = "";
    if (addoredit == "edit") {
        aeval = "_edit";
        hidbank = $("#hid_bank_id").val();
    }
    $.ajax({
        url: url + "api/Banks/getdata",
        data: { seltype: sel_type },
        type: 'POST',
        datatype: 'json',
        success: function(response) {

            //alert(response);
            res = JSON.parse(response);
            //alert(res.data.length);
            var opt = '';
            if (res.data.length > 0) {
                $.each(res.data, function(index, bank) {

                    if (bank.account_name == "SBI") { var bank_icn = 'http://3.7.44.132/aquacredit/assets/images/sib_icn.png'; } else if (bank.account_name == "HDFC") { var bank_icn = 'http://3.7.44.132/aquacredit/assets/images/hdfc_icn.png'; } else if (bank.account_name == "ICICI") { var bank_icn = 'http://3.7.44.132/aquacredit/assets/images/icici_icn.png'; } else { var bank_icn = 'http://3.7.44.132/aquacredit/assets/images/cash_account.png'; }

                    /* if (bank.account_type == 'BANK') {
                        var amountval = bank.account_number;
                    } else {
                        var amountval = bank.account_name;
                    } */

                    opt += '<div class="form-check"><input class="form-check-input" type="radio" name="admin_bank' + aeval + '" id="bnk' + index + aeval + '" value="' + bank.id + '"><label class="form-check-label" for="bnk' + index + aeval + '"><div class="bank_logo"> <img src="' + bank_icn + '" alt="" title=""> </div><div class="bank_mny"><div class="bank_bal"> ₹ ' + addCommas(bank.avail_amount) + ' </div><div class="accont_numb">' + bank.account_number + '</div></div></label></div>';
                });
            }
            $(".admin_bank_val" + aeval).text('Select Account');
            $("#admin_bank_li" + aeval).html(opt);
            //document.getElementById("admin_bank").fstdropdown.rebind();
        }
    });
}

function getusercrops(user_id, addoredit) {
    var aeval = hidcrop = "";
    if (addoredit == "edit") {
        aeval = "_edit";
        hidcrop = $("#hid_crop_id").val();
    }
    $.ajax({
        url: url + "api/UserCrops/index/" + user_id,
        data: {},
        type: 'POST',
        datatype: 'json',
        success: function(response) {

            //alert(response);
            res = JSON.parse(response);
            //alert(res.data.length);

            //var usercode = $('#select_usercode'+aeval).val();
            var user_id = $('#selectuser_id' + aeval).val();
            var sel = "";
            if (user_id != "") {
                //var opt = '<option value="">-- Select Crop --</option>';
                var opt = '<div class="form-check"><input class="form-check-input" type="radio" name="crop_opt' + aeval + '" id="crp' + aeval + '" /><label class="form-check-label" for="crp' + aeval + '"></label></div>';;
                if (res.data.length > 0) {
                    opt = '';
                    $.each(res.data, function(index, crop) {
                        //if(crop.id == hidcrop){ sel = "selected"; }else{ sel = "";}
                        if (crop.cd_id == hidcrop) { sel = "checked"; } else { sel = ""; }
                        //sel = "";
                        //opt += '<option value="'+crop.id+'" '+sel+' >'+crop.crop_loc+'</option>';
                        opt += '<div class="form-check"><input class="form-check-input" type="radio" name="crop_opt' + aeval + '" id="crp' + index + aeval + '" value="' + crop.cd_id + '" ' + sel + ' required /><label class="form-check-label" for="crp' + index + aeval + '">' + crop.crop_location + '</label></div>';
                    });
                }
            } else {
                //var opt = '<option value="">-- Select user first --</option>';
                var opt = '';
            }

            //$(".crop_val").text('Crop Loaction');
            $("#crop_opt_li" + aeval).html(opt);
            //$("#crop_opt"+aeval).select2('refresh');
            //document.getElementById("crop_opt"+aeval).fstdropdown.rebind();
        }
    });
}

function amount_with_commas(addoredit) {
    var aeval = "";
    if (addoredit == "edit") { aeval = "_edit"; }
    var textbox = '#receipt_amt_commas' + aeval;
    var hidden = '#receipt_amt' + aeval;

    var num = $(textbox).val();
    var comma = /,/g;
    num = num.replace(comma, '');

    var len = num.length;
    var index = num.indexOf('.');
    if (index > 0) {
        var CharAfterdot = (len + 1) - index;
        if (CharAfterdot > 3) {
            num = parseFloat(num).toFixed(2);
        }
    }

    $(hidden).val(num);
    var numCommas = addCommas(num);
    $(textbox).val(numCommas);
}