$(function() {
    $("#ukey").autocomplete({
        source: function(request, response) {
            $('#userid').val('');
            $('#usercode').val('');
            $("#crop_opt").val('');
            $('#mobile').val('');
            $("#mobile").attr('readonly', false);
            var trade_type = $("input[name='trade_type']:checked").val();
            // Fetch data
            $.ajax({
                url: url + "api/trades/searchusers",
                type: 'post',
                dataType: "json",
                data: {
                    search: request.term,
                    ttype: trade_type
                },
                success: function(data) {
                    if (trade_type == 'credit') {
                        if (data == null) {
                            $("#ukey").val('');
                            /* if (data == null) {
                                err = 1;
                                err_msg = "User not registered!";
                                tagid = "#ukey";
                                return form_validation(err, err_msg, tagid);
                            } */
                        } else {
                            response($.map(data, function(result) {
                                return {
                                    label: result.label,
                                    value: result.value,
                                    imgsrc: result.img,
                                    user_id: result.user_id,
                                    usercode: result.usercode,
                                    mobile: result.mobile,
                                    user_type: result.user_type
                                }

                            }));
                        }
                    } else {
                        response($.map(data, function(result) {
                            return {
                                label: result.label,
                                value: result.value,
                                imgsrc: result.img,
                                user_id: result.user_id,
                                usercode: result.usercode,
                                mobile: result.mobile,
                                user_type: result.user_type
                            }

                        }));
                    }



                }
            });
        },
        select: function(event, ui) {
            // Set selection
            if (ui.item.user_type == "NON_FARMER") { $(".sel_loc").hide(); } else { $(".sel_loc").show(); }
            var trade_type = $("input[name='trade_type']:checked").val();
            if (trade_type == 'guest') {
                $('#mobile').val(ui.item.mobile);
                $("#mobile").attr('readonly', true);
            }
            $('#ukey').val(ui.item.label); // display the selected text
            $('#userid').val(ui.item.user_id); // save selected id to input
            $('#usercode').val(ui.item.usercode); // save selected id to input
            $(".selectVal").html('');
            //return false;
        }

    }).data("ui-autocomplete")._renderItem = function(ul, item) {
        var user = item.label;
        user = (user.length > 25) ? user.substring(0, 25) : user;
        return $("<li></li>")
            .data("item.autocomplete", item)
            .append("<a>" + "<img style='width:25px;height:25px' src='" + item.imgsrc + "' /> " + user + "</a>")
            .appendTo(ul);
    };

    //user edit
    $("#ukey_edit").autocomplete({
        source: function(request, response) {
            $('.userid_edit').val('');
            $('#usercode_edit').val('');
            $("#crop_opt_edit").val('');
            $('#mobile_edit').val('');
            var trade_type = $('#trade_type_edit').val();
            if (trade_type == 1) {
                var tt = 'guest';
            } else {
                var tt = 'credit';
            }
            //alert('test');
            $("#mobile_edit").prop("disabled", false);
            // Fetch data
            $.ajax({
                url: url + "api/trades/searchusers",
                type: 'post',
                dataType: "json",
                data: {
                    search: request.term,
                    ttype: tt
                },
                success: function(data) {
                    if (trade_type == 0) {
                        if (data == null) {
                            $("#ukey_edit").val('');
                            if (data == null) {
                                err = 1;
                                err_msg = "User not registered!";
                                tagid = "#ukey_edit";
                                return form_validation1(err, err_msg, tagid);
                            }
                        }
                    }
                    response($.map(data, function(result) {
                        //alert(JSON.stringify(result));
                        return {
                            label: result.label,
                            value: result.value,
                            imgsrc: result.img,
                            user_id: result.user_id,
                            mobile: result.mobile,
                            usercode: result.usercode,
                            user_type: result.user_type
                        }
                    }));
                }
            });
        },
        select: function(event, ui) {
            // Set selection
            $('#ukey_edit').val(ui.item.label); // display the selected text
            $('.userid_edit').val(ui.item.user_id); // save selected id to input
            $(".crop_type_val").html('Crop location');
            //$(".crop_type_val").html('');
            var trade_type = $('#trade_type_edit').val();
            if (trade_type == 1) {
                $('#mobile_edit').val(ui.item.mobile);
            }
        }

    }).data("ui-autocomplete")._renderItem = function(ul, item) {
        var user = item.label;
        user = (user.length > 25) ? user.substring(0, 25) : user;
        return $("<li></li>")

        .data("item.autocomplete", item)

        .append("<a>" + "<img style='width:25px;height:25px' src='" + item.imgsrc + "' /> " + user + "</a>")

        .appendTo(ul);

    };

    //trader
    $("#tkey").autocomplete({
        source: function(request, response) {
            $('#traderid').val('');

            // Fetch data
            $.ajax({
                url: url + "api/trades/searchtrader",
                type: 'post',
                dataType: "json",
                data: {
                    search: request.term
                },
                success: function(data) {
                    if (data == null) {
                        //$("#tkey").val('');
                        if (data == null) {
                            err = 1;
                            err_msg = "Trader not registered!";
                            tagid = "#tkey";
                            //return form_validation1(err, err_msg, tagid);
                            return false;
                        }
                    }
                    response($.map(data, function(result) {
                        //alert(JSON.stringify(result));
                        return {
                            label: result.label,
                            value: result.value,
                            imgsrc: result.img,
                            user_id: result.user_id
                        }

                    }));

                }
            });
        },
        select: function(event, ui) {
            // Set selection
            $('#tkey').val(ui.item.label); // display the selected text
            $('#traderid').val(ui.item.user_id); // save selected id to input
            //return false;
        }

    }).data("ui-autocomplete")._renderItem = function(ul, item) {
        var user = item.label;
        user = (user.length > 25) ? user.substring(0, 25) : user;
        return $("<li></li>")
            .data("item.autocomplete", item)
            .append("<a>" + "<img style='width:25px;height:25px' src='" + item.imgsrc + "' /> " + user + "</a>")
            .appendTo(ul);
    };

    //trader edit
    $("#tkey_edit").autocomplete({
        source: function(request, response) {
            $('.traderid_edit').val('');
            // Fetch data
            $.ajax({
                url: url + "api/trades/searchtrader",
                type: 'post',
                dataType: "json",
                data: {
                    search: request.term
                },
                success: function(data) {
                    if (data == null) {
                        if (data == null) {
                            err = 1;
                            err_msg = "Trader not registered!";
                            tagid = "#tkey_edit";
                            //return form_validation1(err, err_msg, tagid);
                            return false;
                        }
                    }
                    response($.map(data, function(result) {
                        //alert(JSON.stringify(result));
                        return {
                            label: result.label,
                            value: result.value,
                            imgsrc: result.img,
                            user_id: result.user_id
                        }
                    }));
                }
            });
        },
        select: function(event, ui) {
            // Set selection
            $('#tkey_edit').val(ui.item.label); // display the selected text
            $('.traderid_edit').val(ui.item.user_id); // save selected id to input
        }
    }).data("ui-autocomplete")._renderItem = function(ul, item) {
        var user = item.label;
        user = (user.length > 25) ? user.substring(0, 25) : user;
        return $("<li></li>")
            .data("item.autocomplete", item)
            .append("<a>" + "<img style='width:25px;height:25px' src='" + item.imgsrc + "' /> " + user + "</a>")
            .appendTo(ul);
    };
});

function ttype(val) {
    if (val == 'guest') {
        $('#guestmobile').show();
        $('#guest_location').show();
        $('#cropdis').hide();
        $('#ukey').val('');
        $('#userid').val('');
        $('#usercode').val('');
        $('#mobile').val('');
    } else {
        $('#guestmobile').hide();
        $('#guest_location').hide();
        $('#cropdis').show();
        $('#ukey').val('');
        $('#userid').val('');
        $('#usercode').val('');
        $('#mobile').val('');
    }
}

function getusercrops(user_id, addoredit) {
    console.log('getusercrops');
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
            res = JSON.parse(response);
            //var usercode = $('#select_usercode'+aeval).val();
            var user_id = $('#userid' + aeval).val();
            var sel = "";
            if (user_id != "") {
                //var opt = '<option value="">-- Select Crop --</option>';
                var opt = "";
                if (res.data.length > 0) {
                    $.each(res.data, function(index, crop) {
                        if (crop.cd_id == hidcrop) { sel = "checked"; } else { sel = ""; }

                        opt += '<div class="form-check"><input class="form-check-input" type="radio" name="crop_opt' + aeval + '" id="crp' + index + aeval + '" value="' + crop.cd_id + '" ' + sel + ' required /><label class="form-check-label" for="crp' + index + aeval + '">' + crop.crop_location + '</label></div>';
                    });
                }
            } else {
                //var opt = '<option value="">-- Select user first --</option>';
                var opt = '';
            }
            $("#crop_opt_li" + aeval).html(opt);
        }
    });
}

function getusercrops1(user_id, addoredit) {
    console.log('getusercrops1');
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
            res = JSON.parse(response);
            var user_id = $('.userid_edit' + aeval).val();
            var sel = "";
            if (user_id != "") {
                var opt = "";
                if (res.data.length > 0) {
                    $.each(res.data, function(index, crop) {

                        if (crop.cd_id == hidcrop) { sel = "checked"; } else { sel = ""; }

                        opt += '<div class="form-check"><input class="form-check-input" type="radio" name="crop_opt' + aeval + '" id="crp' + index + aeval + '" value="' + crop.cd_id + '" ' + sel + ' required /><label class="form-check-label" for="crp' + index + aeval + '">' + crop.crop_location + '</label></div>';
                    });
                }
            } else {
                //var opt = '<option value="">-- Select user first --</option>';
                var opt = '';
            }
            console.log(aeval);
            console.log(opt);
            $("#crop_opt_li" + aeval).html(opt);
        }
    });
}

function clickaction(id) {
    $("#hid_lid").val(id);
}

function clickactionview(id) {
    console.log('call editpopup');
    $("#hid_lid").val(id);
    editPopup();
}

function editPopup() {
    console.log('show popup');
    $('#fnhide').removeAttr("disabled"); // activate finish trade button
    var lid = $("#hid_lid").val();
    $("#ukey_edit").val('');
    $("#tkey_edit").val('');
    $(".userid_edit").val('');
    $(".traderid_edit").val('');
    $("#crop_opt_edit").val('');
    $("#trade_date_edit").val('');
    $("#exp_count_edit").val('');
    $("#exp_weight_kgs_edit").val('');
    $("#exp_farmer_price_val_edit").val('');
    $("#exp_farmer_price_edit").val('');
    $("#exp_company_price_val_edit").val('');
    $("#exp_company_price_edit").val('');
    $("#note_edit").val('');
    $("#status").val('');
    $('#cweight').html('');
    $('#camount').html('');
    $('#fweight').html('');
    $('#famount').html('');
    $('#cweightval').val('');
    $('#camountval').val('');
    $('#fweightval').val('');
    $('#famountval').val('');
    $('#expenses').val('');
    $('#labfee').val('');
    $('#gtotalval').val('');
    $('#gtotal').html('');
    $('#invoiceItem').html('');
    edit_pop_init();
    $.ajax({
        //url: url+"api/loans/index/"+lid,
        url: url + "api/trades/tradedetails/" + lid,
        data: {},
        type: 'POST',
        datatype: 'json',
        success: function(response) {
            res = JSON.parse(response);
            $(".trade_id").val(lid);

            /* var endv = $("#endis").val();
            if(endv==1)
            {
            	$(".edt_bl_lnk").trigger("click");
            	$("#endis").val(0);
            	$("#note_edit").attr("disabled","disabled");
            	$("#endis").val(0);
            	$('.edt_bl_lnk').removeClass('opacity_1');
            	$('.edt_bl_lnk').parent().find('ul').toggleClass('disb_sel');
            	$('.popover').remove();
            } */


            if (res.data.tradetype == 1) {
                $("#crplist_edit").hide();
                $("#mobiledis").show();
                $("#mobile_edit").val(res.data.guest_mobile);
                $("#mobile_edit").prop("disabled", true);
            } else {
                $("#crplist_edit").show();
                $("#mobiledis").show();
                $("#mobiledis").hide();
            }

            $("#trade_type_edit").val(res.data.tradetype);
            $("#ukey_edit").val(res.data.user_name);
            if (res.data.trader_type == 'Agent') {
                $("#tkey_edit").val(res.data.full_name);
            } else {
                $("#tkey_edit").val(res.data.firm_name + ' ( ' + res.data.contact_person + ' )');
            }


            $(".userid_edit").val(res.data.userid);
            $(".traderid_edit").val(res.data.trader_id);
            /*$("#crop_opt_edit").val(res.data.crop_loc);*/
            var a = $.datepicker.formatDate("dd-M-yy", new Date(res.data.trade_date));

            $("#trade_edit_id").html(" - TR" + res.data.id);
            $("#trade_date_edit").val(a);
            $("#exp_count_edit").val(res.data.exp_count);
            $("#exp_weight_kgs_edit").val(res.data.exp_weight_kgs);
            $("#exp_farmer_price_val_edit").val(res.data.exp_farmer_price);
            $("#exp_farmer_price_edit").val(res.data.exp_farmer_price);
            $("#exp_company_price_val_edit").val(res.data.exp_company_price);
            $("#exp_company_price_edit").val(res.data.exp_company_price);
            $("#note_edit").val(res.data.note);
            $("#status").val(res.data.status);

            if (res.data.status == 1) {
                $('.edt_bl_lnk').hide();
                $('#fnhide').hide();
                $('#upthide').hide();
                $("#expenses").prop("readonly", true);
                $("#labfee").prop("readonly", true);
                //$("#tradefrm_edit .mykey").attr("readonly", true);
            } else {
                $('.edt_bl_lnk').show();
                $('#fnhide').show();
                $('#upthide').show();
                $("#expenses").prop("readonly", false);
                $("#labfee").prop("readonly", false);
            }

            amount_with_commasedit();
            amount_with_commasedit_val();

            $('#cweight').html(roundTo(res.data.company_fweight, 3));

            $('#camount').html(currency_format((res.data.company_fprice), 3));
            $('#fweight').html(roundTo(res.data.farmer_fweight, 3));
            $('#famount').html(currency_format((res.data.farmer_fprice), 3));

            $('#cweightval').val(roundTo(res.data.company_fweight, 3));
            $('#camountval').val(roundTo(res.data.company_fprice, 3));
            $('#fweightval').val(roundTo(res.data.farmer_fweight, 3));
            $('#famountval').val(roundTo(res.data.farmer_fprice, 3));

            $('#expenses').val(res.data.expenses_farmer);
            $('#labfee').val(res.data.labfee_framer);
            var gttot = parseFloat(res.data.gtotal) - parseFloat(res.data.expenses_farmer) - parseFloat(res.data.labfee_framer);
            $('#gtotalval').val(roundTo(res.data.gtotal, 2));
            $('#gtotal').html(currency_format(gttot, 2));
            //$('#crop_opt_edit option:eq('+res.data.crop_loc+')').attr('selected', true);
            /*$('#invoiceItem').html('');*/
            //htmlRows = "";
            /*get trade actual details*/
            $.ajax({
                url: url + "api/trades/tradeactualdetails/" + lid,
                data: {},
                type: 'POST',
                datatype: 'json',
                success: function(response) {
                    res1 = JSON.parse(response);
                    htmlRows = "";
                    if (res1.data.length > 0) {
                        $('#rcntval').val(res1.data.length);
                        $.each(res1.data, function(index, trades) {
                            $("#tcount10").prop("disabled", true);
                            $("#tcount11").prop("disabled", true);


                            var tcamtt = (trades.company_amount);
                            var tfamtt = (trades.farmer_amount);
                            // console.log(trades.trade_date);
                            // var a=$.datepicker.formatDate( "dd-M-yy", new Date(trades.trade_date));
                            a = trades.trade_date;
                            //console.log(a);
                            htmlRows = '<tr id="rowNums' + trades.id + '"><td class="date_td"> <input type="text" class="form-control mykey edate" placeholder="" name="tdate[]" id="tdate' + trades.id + '" value="' + a + '" onkeydown="return false;"></td><td class="cnt_wth"><input maxlength="7" type="text" class="form-control mykey" placeholder="" name="tcount[]" id="tcount' + trades.id + '" value="' + trades.count + '" onkeypress="return IsAlphaNumeric(this,event)" ></td><td class="bor_t_b_none"><div> &nbsp;</div></td><td class="prc_td"><input type="text" class="form-control mykey" placeholder="" maxlength="9" name="tcprice[]" id="tcprice_' + trades.id + '" value="' + trades.company_price + '" onkeypress="return isPrice(this,event)" ></td><td class="com_bg weig" width="80"> <input type="text" class="form-control mykey" placeholder="" name="tcweight[]" id="tcweight_' + trades.id + '" value="' + trades.company_weight + '" onkeypress="return isWeight(this,event)" ></td><td class="com_bg amn_blk"><input type="text" class="form-control mykey" placeholder="" readonly name="tcamount[]" id="tcamount_' + trades.id + '" value="' + tcamtt + '" onkeypress="return onlyNumberKey(event)" ><input type="hidden" class="form-control mykey" placeholder="" readonly name="tcamountval[]" id="tcamountval_' + trades.id + '" value="' + trades.company_amount + '" ></td><td class="bor_t_b_none"><div> &nbsp;</div></td><td class="far_bg prc_td"> <input type="text" maxlength="9" class="form-control mykey" placeholder="" name="tfprice[]" id="tfprice_' + trades.id + '" value="' + trades.farmer_price + '" onkeypress="return isPrice(this,event)"></td><td class="far_bg weig" width="80"><input type="text" class="form-control mykey" placeholder="" name="tfweight[]" id="tfweight_' + trades.id + '" value="' + trades.farmer_weight + '" onkeypress="return isWeight(this,event)" readonly></td><td class="far_bg amn_blk"> <input type="text" class="form-control" placeholder="" readonly name="tfamount[]" id="tfamount_' + trades.id + '" value="' + tfamtt + '" ><input type="hidden" class="form-control noalpha mykey" placeholder="" readonly name="tfamountval[]" id="tfamountval_' + trades.id + '" value="' + trades.farmer_amount + '" onkeypress="return onlyNumberKey(event)"><input type="hidden" class="form-control noalpha mykey" placeholder="" readonly name="hid_acivity_id[]" id="hid_acivity_id_' + trades.id + '" value="' + trades.id + '"> </td></tr>';

                            $('#invoiceItem').append(htmlRows);

                            var dateToday = new Date();
                            $("#tdate" + trades.id).datepicker({
                                dateFormat: 'dd-M-yy',
                                defaultDate: trades.trade_date,
                                changeMonth: true,
                                changeYear: true,
                                //minDate: dateToday,
                                numberOfMonths: 1
                            });
                            if (res.data.status == 1) {
                                $(".mykey").prop("disabled", true);
                            } else {
                                $(".mykey").prop("disabled", false);
                            }

                        });
                        htmlRows = '<tr id="rowNums0"><td> <input type="text" class="form-control mykey edate" placeholder="" name="tdate[]" id="tdate0" onkeydown="return false;"></td><td class="cnt_wth"><input maxlength="7" type="text" class="form-control mykey" placeholder="" name="tcount[]" id="tcount0" onkeypress="return IsAlphaNumeric(this,event)"></td><td class="bor_t_b_none"><div> &nbsp;</div></td><td class="weig"><input type="text" class="form-control mykey" placeholder="" maxlength="9" name="tcprice[]" id="tcprice_0" onkeypress="return isPrice(this, event);"></td><td class="com_bg weig" width="80"> <input type="text" class="form-control mykey" placeholder="" name="tcweight[]" id="tcweight_0" onkeypress="return isWeight(this,event)" ></td><td class="com_bg amn_blk"><input type="text" class="form-control mykey" placeholder="" readonly name="tcamount[]" id="tcamount_0"  ><input type="hidden" class="form-control mykey" placeholder="" readonly name="tcamountval[]" id="tcamountval_0"></td><td class="bor_t_b_none"><div> &nbsp;</div></td><td class="far_bg weig"> <input type="text" maxlength="9" class="form-control mykey" placeholder="" name="tfprice[]" id="tfprice_0" onkeypress="return isPrice(this,event)"></td><td class="far_bg weig" width="80"><input type="text" class="form-control mykey" placeholder="" name="tfweight[]" id="tfweight_0" onkeypress="return isWeight(this,event)" readonly></td><td class="far_bg amn_blk"> <input type="text" class="form-control mykey" placeholder="" readonly name="tfamount[]" id="tfamount_0" ><input type="hidden" class="form-control mykey" plcrpsaceholder="" readonly name="tfamountval[]" id="tfamountval_0" ><input type="hidden" class="form-control mykey" placeholder="" readonly name="hid_acivity_id[]" id="hid_acivity_id_0" value="0"> </td></tr>';

                        $('#invoiceItem').append(htmlRows);
                        if (res.data.status == 1) {
                            $(".mykey").prop("disabled", true);
                        } else {
                            $(".mykey").prop("disabled", false);
                        }

                        var dateToday = new Date();
                        $("#tdate0").datepicker({
                            dateFormat: 'dd-M-yy',
                            changeMonth: true,
                            changeYear: true,
                            //minDate: dateToday,
                            numberOfMonths: 1
                        });
                    } else {

                        htmlRows = '<tr id="rowNums0"><td> <input type="text" class="form-control mykey edate" placeholder="" name="tdate[]" id="tdate0" onkeydown="return false;"></td><td class="cnt_wth"><input maxlength="7" type="text" class="form-control mkey" placeholder="" name="tcount[]" id="tcount0" onkeypress="return IsAlphaNumeric(this,event)" ></td><td class="bor_t_b_none"><div> &nbsp;</div></td><td class="weig"><input type="text" class="form-control mkey" placeholder="" maxlength="9" name="tcprice[]" id="tcprice_0" onkeypress="return isPrice(this, event);" ></td><td class="com_bg weig" width="80"> <input type="text" class="form-control mkey" placeholder="" name="tcweight[]" id="tcweight_0" onkeypress="return isWeight(this,event)" ></td><td class="com_bg amn_blk"><input type="text" class="form-control" placeholder="" readonly name="tcamount[]" id="tcamount_0"  onkeypress="return onlyNumberKey(event)" ><input type="hidden" class="form-control " placeholder="" readonly name="tcamountval[]" id="tcamountval_0"></td><td class="bor_t_b_none"><div> &nbsp;</div></td><td class="far_bg weig"> <input type="text" maxlength="9" class="form-control mkey" placeholder="" name="tfprice[]" id="tfprice_0" onkeypress="return isPrice(this,event)" ></td><td class="far_bg weig" width="80"><input type="text" class="form-control mkey" placeholder="" name="tfweight[]" id="tfweight_0" onkeypress="return isWeight(this,event)" readonly></td><td class="far_bg amn_blk"> <input type="text" class="form-control" placeholder="" readonly name="tfamount[]" id="tfamount_0" ><input type="hidden" class="form-control " placeholder="" readonly name="tfamountval[]" id="tfamountval_0" ><input type="hidden" class="form-control " placeholder="" readonly name="hid_acivity_id[]" id="hid_acivity_id_0" value="0"> </td></tr>';

                        $('#invoiceItem').append(htmlRows);

                        var dateToday = new Date();
                        $("#tdate0").datepicker({
                            dateFormat: 'dd-M-yy',
                            changeMonth: true,
                            changeYear: true,
                            //minDate: dateToday,
                            numberOfMonths: 1
                        });
                    }

                }
            });
            /*get trade actual details*/

            /*get crop details*/
            $.ajax({
                url: url + "api/UserCrops/index/" + res.data.userid,
                data: {},
                type: 'POST',
                datatype: 'json',
                success: function(response1) {

                    rescp1 = JSON.parse(response1);
                    var aeval = '_edit';
                    var opt = '';
                    if (rescp1.data.length > 0) {
                        $.each(rescp1.data, function(index, crop) {


                            if (crop.cd_id == res.data.location) {
                                sel = "checked";
                                $(".crop_type_val").text(crop.crop_location);
                            } else {
                                sel = "";
                            }

                            opt += '<div class="form-check"><input class="form-check-input" type="radio" name="crop_opt_edit" id="crp' + index + aeval + '" value="' + crop.cd_id + '" ' + sel + ' /><label class="form-check-label" for="crp' + index + aeval + '">' + crop.crop_location + '</label></div>';
                        });
                    }

                    $("#crop_opt_li_edit").html(opt);


                }
            });
            /*get crop details*/

        }
    });

    $('#edt_user_id').show();
    $('.ap_blk').show();
}

function edit_pop_init() {
    //remove red borders if any
    $('.mykey').parent().css("border", "");
    $('.mykey').parent().addClass("inp_ss");
    //no animation
    $('.top_no_txt').removeClass('blu_bd_txt');
    $('.top_no_txt').removeClass('gry_bdr');
    //make save to edit
    $('.edt_bl_lnk').removeClass('opacity_1');
    //disable all fields
    $('.edt_bl_lnk').parent().find('ul').addClass('disb_sel');
    $("#note_edit").attr("disabled", "disabled");
}

function edit_exp_act() {
    console.log('activate expected');
    //animation border to blue
    $('.top_no_txt').removeClass('gry_bdr');
    $('.top_no_txt').addClass('blu_bd_txt');
    //make edit to save
    $('.edt_bl_lnk').addClass('opacity_1');
    //enable all fields
    $('.edt_bl_lnk').parent().find('ul').removeClass('disb_sel');
    $("#note_edit").prop("disabled", false);
}

function edit_exp_inact() {
    console.log('inactive expected');
    $('.mykey').parent().css("border", "");
    $('.mykey').parent().addClass("inp_ss");
    //animation border to grey
    if ($('.top_no_txt').hasClass("blu_bd_txt")) {
        $('.top_no_txt').removeClass('blu_bd_txt');
        $('.top_no_txt').addClass('gry_bdr');
    }

    //make save to edit
    $('.edt_bl_lnk').removeClass('opacity_1');
    //disable all fields
    $('.edt_bl_lnk').parent().find('ul').addClass('disb_sel');
    $("#note_edit").attr("disabled", "disabled");
}


function amount_with_commasedit(addoredit) {
    var aeval = "";
    if (addoredit == "edit") { aeval = "_edit"; }
    var textbox = '#exp_farmer_price_val_edit' + aeval;
    var hidden = '#exp_farmer_price_edit' + aeval;

    var num = $('#exp_farmer_price_val_edit').val();
    var comma = /,/g;
    num = num.replace(comma, '');
    $('#exp_farmer_price_edit').val(num);
    var numCommas = (num);
    $(textbox).val(numCommas);
    var amt_word = convertNumberToWords(num);
    if (amt_word != undefined) {
        $('.amon_text2' + aeval).html(amt_word);
    }
}

function amount_with_commasedit_val(addoredit) {
    var aeval = "";
    if (addoredit == "edit") { aeval = "_edit"; }
    var textbox = '#exp_company_price_val_edit' + aeval;
    var hidden = '#exp_company_price_edit' + aeval;

    var num = $('#exp_company_price_val_edit').val();
    var comma = /,/g;
    num = num.replace(comma, '');
    $('#exp_company_price_edit').val(num);
    var numCommas = (num);
    $(textbox).val(numCommas);
    var amt_word = convertNumberToWords(num);
    if (amt_word != undefined) {
        $('.amon_text3' + aeval).html(amt_word);
    }
}

function get_traders(type = null) {
    /*GET TRADERS*/
    $.ajax({
        url: url + "api/trades/traders",
        data: { status: type },
        type: 'POST',
        datatype: 'json',
        success: function(response) {
            res = JSON.parse(response);
            var opt = '';
            if (res.data.length > 0) {
                opt += '<div class="form-check chek_bx"><input class="form-check-input" type="checkbox" name="" value="" id="trdd0"><label class="form-check-label" for="trdd0" id="trdd_text0"><strong>Clear All</stron></label></div>';

                $.each(res.data, function(index, brand) {
                    //var tname = brand.firm_name.replace(/[_\W]+/g, "-");
                    if (brand.trader_type == "Agent") {
                        opt += '<div class="form-check chek_bx"><input class="form-check-input" type="checkbox" name="traderval" value="' + brand.trader_id + '" id="trdd' + brand.trader_id + '"><label class="form-check-label" for="trdd' + brand.trader_id + '" id="trdd_text' + brand.trader_id + '">' + brand.full_name + '</label></div>';
                    } else {
                        opt += '<div class="form-check chek_bx"><input class="form-check-input" type="checkbox" name="traderval" value="' + brand.trader_id + '" id="trdd' + brand.trader_id + '"><label class="form-check-label" for="trdd' + brand.trader_id + '" id="trdd_text' + brand.trader_id + '">' + brand.firm_name + '</label></div>';
                    }
                });
            }

            $("#traderslist_search").html(opt);

        }
    });
}

function get_users(type = null) {
    /*GET USERS*/
    $.ajax({
        url: url + "api/trades/users",
        data: { status: type },
        type: 'POST',
        datatype: 'json',
        success: function(response) {

            res = JSON.parse(response);

            var opt = '';
            if (res.data.length > 0) {
                opt += '<div class="form-check chek_bx"><input class="form-check-input" type="checkbox" name="" value="" id="usr0"><label class="form-check-label" for="usr0" id="usr_text0"><strong>Clear All</stron></label></div>';

                $.each(res.data, function(index, brand) {
                    var tname = brand.user_name.replace(/[_\W]+/g, "-");
                    if (brand.user_name == '')
                        brand.user_name = brand.firm_name;
                    opt += '<div class="form-check chek_bx"><input class="form-check-input" type="checkbox" name="userval" value="' + brand.user_id + '" id="usr' + brand.user_id + '"><label class="form-check-label" for="usr' + brand.user_id + '" id="usr_text' + brand.user_id + '">' + brand.user_name + '</label></div>';
                });
            }

            $("#userlist_search").html(opt);

        }
    });
}

function selectVal(id, val) {
    var tn = val.replace("-", " ");
    $("#tkey").val(tn);
    $("#traderid").val(id);
    $("#suggesstion-box1").hide();
}

//edit selection
function selectVal_edit(id, val) {
    var tn = val.replace("-", " ");
    $("#tkey_edit").val(tn);
    $(".traderid_edit").val(id);
    $("#suggesstion-box1_edit").hide();
}

//get crop locations
/* function selectVal1(id, val, code) {
    console.log('selectVal1');
    $.ajax({
        url: url + "api/UserCrops/index/" + id,
        data: {},
        type: 'POST',
        datatype: 'json',
        success: function(response) {
            res = JSON.parse(response);
            var opt = '<option value="">-- Select Crop --</option>';
            if (res.data.length > 0) {
                $.each(res.data, function(index, crop) {
                    opt += '<option value="' + crop.id + '" >' + crop.crop_location + '</option>';
                });
            }

            $("#crop_opt").html(opt);
            var tn = val.replace("-", " ");
            $("#ukey").val(tn);
            $("#userid").val(id);
            $("#usercode").val(code);
            $("#suggesstion-box").hide();
        }
    });
} */

//edit get crop locations
//get crop locations
function selectVal1_edit(id, val, code) {
    console.log('selectVal1_edit');
    $.ajax({
        url: url + "api/UserCrops/index/" + id,
        data: {},
        type: 'POST',
        datatype: 'json',
        success: function(response) {
            res = JSON.parse(response);
            var opt = '<option value="">-- Select Crop --</option>';
            if (res.data.length > 0) {
                $.each(res.data, function(index, crop) {
                    opt += '<option value="' + crop.cd_id + '" >' + crop.crop_location + '</option>';
                });
            }

            $("#crop_opt_edit").html(opt);
            var tn = val.replace("-", " ");
            $("#ukey_edit").val(tn);
            $(".userid_edit").val(id);
            $("#suggesstion-box_edit").hide();
        }
    });
}

// get traders
function gettrader() {
    var trk = $("#tkey").val();
    if (trk.length > 1) {
        $.ajax({
            url: url + "api/trades",
            data: { txt: $("#tkey").val() },
            type: 'POST',
            datatype: 'json',
            success: function(response) {

                res = JSON.parse(response);

                var opt = "<ul>";
                if (res.data.length > 0) {
                    $.each(res.data, function(index, brand) {
                        var tname = brand.firm_name.replace(/[_\W]+/g, "-");
                        opt += '<li onclick=selectVal("' + brand.td_id + '","' + tname + '"); >' + brand.firm_name + '</li>';
                    });
                }
                opt += "</ul>";
                $("#suggesstion-box1").show();
                $("#suggesstion-box1").html(opt);
            }
        });
    }
}

//get traders edit
function gettraderedit() {
    var trk = $("#tkey_edit").val();
    if (trk.length > 1) {
        $.ajax({
            url: url + "api/trades",
            data: { txt: $("#tkey_edit").val() },
            type: 'POST',
            datatype: 'json',
            success: function(response) {

                res = JSON.parse(response);

                var opt = "<ul>";
                if (res.data.length > 0) {

                    $.each(res.data, function(index, brand) {
                        var tname = brand.firm_name.replace(/[_\W]+/g, "-");
                        opt += '<li onclick=selectVal_edit("' + brand.td_id + '","' + tname + '"); >' + brand.firm_name + '</li>';
                    });
                }
                opt += "</ul>";
                $("#suggesstion-box1_edit").show();
                $("#suggesstion-box1_edit").html(opt);

            }
        });
    }
}

//get user edit
function getuseredit() {
    var trk = $("#ukey_edit").val();
    if (trk.length > 1) {
        $.ajax({
            url: url + "api/trades/users",
            data: { txt: $("#ukey_edit").val() },
            type: 'POST',
            datatype: 'json',
            success: function(response) {

                res = JSON.parse(response);

                var opt = "<ul>";
                if (res.data.length > 0) {
                    $.each(res.data, function(index, brand) {
                        var tname = brand.user_name.replace(/[_\W]+/g, "-");
                        opt += '<li onclick=selectVal1_edit("' + brand.user_id + '","' + tname + '","' + brand.user_id + '"); >' + brand.user_name + '</li>';
                    });
                }
                opt += "</ul>";
                $("#suggesstion-box_edit").show();
                $("#suggesstion-box_edit").html(opt);

            }
        });
    }
}

//get users
/* function getuser() {
    var trk = $("#ukey").val();
    if (trk.length > 1) {
        $.ajax({
            url: url + "api/trades/users",
            data: { txt: $("#ukey").val() },
            type: 'POST',
            datatype: 'json',
            success: function(response) {

                res = JSON.parse(response);

                var opt = "<ul>";
                if (res.data.length > 0) {
                    $.each(res.data, function(index, brand) {
                        var tname = brand.user_name.replace(/[_\W]+/g, "-");
                        opt += '<li onclick=selectVal1("' + brand.user_id + '","' + tname + '","' + brand.user_id + '"); >' + brand.user_name + '</li>';
                    });
                }
                opt += "</ul>";
                $("#suggesstion-box").show();
                $("#suggesstion-box").html(opt);

            }
        });
    }
} */

function onlyNumberKey(evt) {
    // Only ASCII charactar in that range allowed
    var ASCIICode = (evt.which) ? evt.which : evt.keyCode
    if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57) && ASCIICode != 46)
        return false;
    return true;
}

function IsAlphaNumeric(txt, e) {
    var keyCode = e.keyCode == 0 ? e.charCode : e.keyCode;
    var ret = (keyCode > 31 && (keyCode < 48 || keyCode > 57) && !(keyCode == 46 || keyCode == 8) && (keyCode < 97 && keyCode > 122));
    if (ret)
        return false;
    else {
        var len = $(txt).val().length;
        var index = $(txt).val().indexOf('.');
        if (index > 0 && keyCode == 46) {
            return false;
        }
        if (index > 0) {
            var CharAfterdot = (len + 1) - index;
            if (CharAfterdot > 4) {
                return false;
            }
        }
    }
    return true;
}

function cb(start, end) {
    $('#date_val').val(start.format('D/MMM/YYYY') + ' - ' + end.format('D/MMM/YYYY'));
    if ($('#date_val').val() == "Invalid date - Invalid date") {
        $('#date_val').val('');
    } else {
        $('#date_val').val(start.format('D/MMM/YYYY') + ' - ' + end.format('D/MMM/YYYY'));
    }
}

function form_validation(err, err_msg, tagid) {
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
    setTimeout(function() { $("#snackbar").removeClass("show"); }, 3000);
    $(tagid).parent().css("border", "1px solid red");
    //$("#tname").css("border", "1px solid red");
    $(tagid).focus();
    return false;
}

function form_validation1(err, err_msg, tagid) {
    $('.mykey').parent().css("border", "");
    $(tagid).parent().css("border", "");
    /* $(".err_msg").text(err_msg);

    $("#danger-alert").fadeTo(2000, 500).slideUp(1000, function(){
    	$("#danger-alert").slideUp(1000);
    }); */
    $("#snackbar1").text(err_msg);
    $("#snackbar1").addClass("show");
    /* var x = document.getElementById("snackbar");
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 5000); */
    setTimeout(function() { $("#snackbar1").removeClass("show"); }, 3000);
    $(tagid).parent().css("border", "1px solid red");
    //$("#tname").css("border", "1px solid red");
    $(tagid).focus();
    return false;
}

function calculateTotal() {
    var cweightTot = 0;
    var camountTot = 0;
    var grandTotal = 0;


    $("[id^='tcprice_']").each(function() {
        var id = $(this).attr('id');
        id = id.replace("tcprice_", '');
        var tcprice = $("#tcprice_" + id).val();
        var tcweight = $('#tcweight_' + id).val();
        var tcw = 1;
        var total = (tcprice * tcweight);
        $('#tcamount_' + id).val(currency_format(total, 3));
        $('#tcamountval_' + id).val(roundTo(total, 3));
        var tcwt = tcw * tcweight;
        grandTotal += total;
        cweightTot += tcwt;
        camountTot += total;

    });

    var expenses = $('#expenses').val();
    var labfee = $('#labfee').val();
    var famountval = $('#famountval').val();
    //var cwt = addCommas(cweightTot);
    $('#cweight').html(roundTo(cweightTot, 3));
    var cmt = currency_format(camountTot, 3);
    $('#camount').html(cmt);

    if (expenses != '' && expenses != NaN) {

    } else {
        expenses = 0;
    }

    if (labfee != '' && labfee != NaN) {

    } else {
        labfee = 0;
    }

    var GrandTot = parseInt(grandTotal) - parseInt(expenses) - parseInt(labfee);
    $('#cweightval').val(roundTo(cweightTot, 3));
    $('#camountval').val(roundTo(camountTot, 3));
}

function calculateTotal1() {

    var fweightTot = 0;
    var famountTot = 0;
    var grandTotal = 0;

    $("[id^='tfprice_']").each(function() {
        var id = $(this).attr('id');
        id = id.replace("tfprice_", '');
        var tfprice = $("#tfprice_" + id).val();
        var tfweight = $('#tfweight_' + id).val();
        var tfw = 1;

        var total = (tfprice * tfweight);
        if (total != 0) {
            $('#tfamount_' + id).val(currency_format(total, 3));
            $('#tfamountval_' + id).val(roundTo(total, 3));
        }
        var tfwt = tfw * tfweight;

        grandTotal += total;
        fweightTot += tfwt;
        famountTot += total;

    });
    var expenses = $('#expenses').val();
    var labfee = $('#labfee').val();
    var camountval = $('#camountval').val();

    if (expenses != '' && expenses != NaN) {

    } else {
        expenses = 0;
    }

    if (labfee != '' && labfee != NaN) {

    } else {
        labfee = 0;
    }

    var GrandTot = parseFloat(grandTotal) - parseFloat(expenses) - parseFloat(labfee);
    $('#gtotal').html(currency_format(GrandTot, 2));
    $('#fweight').html(roundTo(fweightTot, 3));
    var cmt = currency_format(famountTot, 3);
    $('#famount').html(cmt);


    $('#gtotalval').val(roundTo(grandTotal, 2));
    $('#fweightval').val(roundTo(fweightTot, 3));
    $('#famountval').val(roundTo(famountTot, 3));
}

/*delete trade*/
$(document).ready(function() {
    var table = $('#usr_lst_tbl').DataTable({
        'ordering': false,
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        language: {
            searchPlaceholder: "Search Trades",
            search: "",
            "dom": '<"toolbar">frtip'
        },
        "columnDefs": [
            //{ className: "txt_cnt", "targets": [ 4 ] },
            { className: "act_ms", "targets": [5] },
            { className: "id_td", "targets": 0 },
            { className: "text-capitalize", "targets": [2, 3] },

        ],
        "order": [
            [1, 'desc']
        ],
        'ajax': {
            'url': url + 'api/trades/gettrades',
            'data': function(data) {
                var multi_users = [];
                $.each($("input[name='userval']:checked"), function() {
                    multi_users.push($(this).val());
                });

                var multi_traders = [];
                $.each($("input[name='traderval']:checked"), function() {
                    multi_traders.push($(this).val());
                });

                var month_opt = $("input[name='month_opt']:checked").val();
                var reportrange = $('#date_val').val();
                var from_date = $("#from_date").val();
                var to_date = $("#to_date").val();
                //var userval = $("input[name='userval']:checked").val();
                //var traderval = $("input[name='traderval']:checked").val();
                var tabval = $("#hid_tabval").val();
                //var status_opt = $("#hid_tabval").val();

                data.month_opt = month_opt;
                data.reportrange = reportrange;
                data.from_date = from_date;
                data.to_date = to_date;
                data.userval = multi_users;
                data.traderval = multi_traders;
                data.status_opt = tabval;
            },
            "dataSrc": function(json) {

                $("#trade_totalamount").html('₹' + currency_format(json.tot_amt, 2));
                $("#trade_total").html('(' + json.tot_rec + ')');
                $("#trade_draft").html('(' + json.tot_draft + ')');
                var tons = (json.tot_count) / 1000;
                $("#trade_tons").html(currency_format(tons, 5));
                return json.data;
            }
        }
    });

    $(document).on('keyup', "#user_searchkey", function() {
        console.log('usersearch');
        var $this = $(this);
        var exp = new RegExp($this.val(), 'i');
        $("input[name='userval']").each(function() {
            var $self = $(this);
            var id = $self.attr('id');
            id = id.replace("usr", '');
            var text = $("#usr_text" + id).text();
            console.log(text);
            //console.log($self);
            if (!exp.test(text)) {
                $self.parent().parent().hide();
            } else {
                $self.parent().parent().show();
            }
        });
    });

    $(document).on('keyup', "#trader_searchkey", function() {
        console.log('usersearch');
        var $this = $(this);
        var exp = new RegExp($this.val(), 'i');
        $("input[name='traderval']").each(function() {
            var $self = $(this);
            var id = $self.attr('id');
            id = id.replace("trdd", '');
            var text = $("#trdd_text" + id).text();
            console.log(text);
            //console.log($self);
            if (!exp.test(text)) {
                $self.parent().parent().hide();
            } else {
                $self.parent().parent().show();
            }
        });
    });

    get_traders(0);
    get_users(0);

    $.ajax({
        url: url + "api/trades/getPendingAmount",
        data: { txt: '' },
        type: 'POST',
        datatype: 'json',
        success: function(response) {

            $("#pending_amount").html('₹' + currency_format(response, 2));

        }
    });


    $(document).on('click', "input[name='traderval']", function() {
        $(this).parent().closest(".chek_bx").toggleClass("checkd")
        table.draw();
    });

    $(document).on("click", "#trdd0", function() {
        $("input[name='traderval']").parent().closest(".chek_bx").removeClass("checkd");
        $("input[name='traderval']").prop('checked', false);
        table.draw();
    });

    $(document).on('click', "input[name='userval']", function() {
        $(this).parent().closest(".chek_bx").toggleClass("checkd")
        table.draw();
    });

    $(document).on("click", "#usr0", function() {
        $("input[name='userval']").parent().closest(".chek_bx").removeClass("checkd");
        $("input[name='userval']").prop('checked', false);
        table.draw();
        return false;
        /*  $(this).parent().closest(".chek_bx").toggleClass("checkd")
         if ($(this).parent().closest(".chek_bx").hasClass("checkd")) {
             $("input[name='userval']").parent().closest(".chek_bx").addClass("checkd");
         } else if ($(this).prop("checked") == false) {
             $("input[name='userval']").parent().closest(".chek_bx").removeClass("checkd");
             $("input[name='userval']").prop('checked', false);
         } */
    });

    /* $(document).on('mouseover', '[data-toggle="popover"]', function() {
        console.log('hover');
        var $this = $(this);
        if ($this.hasClass('note_pop')) {
            var id = $(this).attr('id');
            console.log(id);
            id = id.replace("note_pop_", '');

            $this.popover({
                html: true,
                content: function() {
                    return $('#popover-note' + id).html();
                },
                trigger: 'focus',
                delay: {
                    hide: "100"
                },
            }).popover('show');
        }
    }); */

    /* $(document).on('mouseleave', '[data-toggle="popover"]', function() {
        console.log('leave');
        var $this = $(this);
        if ($this.hasClass('note_pop')) {
            $this.popover('hide');
        }
    }); */

    $(document).on('click', '[data-toggle="popover"]', function() {
        var $this = $(this);
        if ($this.hasClass('act_icn')) {
            $this.popover({
                html: true,
                content: function() {
                    return $('#popover-content').html();
                },
                trigger: 'focus',
                delay: {
                    hide: "100"
                },
            }).popover('show');
        }
        if ($this.hasClass('act_icn1')) {
            $this.popover({
                html: true,
                content: function() {
                    return $('#popover-content1').html();
                },
                trigger: 'focus',
                delay: {
                    hide: "100"
                },
            }).popover('show');
        }
    });

    $("input[name='month_opt']").on('click', function() {
        var date_val = $("input[name='month_opt']:checked").val();
        if (date_val == "custom") { $(".cdate").show(); } else {
            $(".cdate").hide();
            table.draw();
        }
    });

    $(document).on('click', '.ranges ul li', function() {
        $(this).parent().children().removeClass('active');
        $(this).addClass('active');
        $('.drp-selected').css('font-weight', 'bold');
        if ($(this).text() == "Till Date") {
            $("#date_val").val('Till Date');
        }

        if ($(this).text() != "Date Range") {
            table.draw();
        }
    });

    $(document).on('click', '.applyBtn', function() {
        table.draw();
    });

    $("#custom_date").click(function() {
        table.draw();
    });

    $("#from_date").change(function(e) {
        e.stopPropagation()
    });
    $.validator.addMethod("trader_check", function(value, element) {
        return ($("#traderid").val() != "");
    }, "Trader is not registered!");
    $.validator.addMethod("user_check", function(value, element) {
        if ($("input[name='trade_type']:checked").val() == "credit") {
            console.log($("#userid").val());
            return ($("#userid").val() != "");
        } else
            return true;
    }, "User is not registered!");
    $.validator.addMethod("crop_location", function(value, element) {
        if ($("input[name='trade_type']:checked").val() == "credit")
            return ($('input:radio[name=crop_opt]:checked').length != 0);
        else
            return true;
    }, "Crop location not selected");
    $(document).on("click", ".trade_btn", function() {

        $('#tradefrm').validate({
            debug: false,
            rules: {
                tkey: {
                    required: true,
                    trader_check: true,
                },
                ukey: {
                    required: true,
                    //user_check: true,
                    //crop_location: true,
                },
                crop_opt: {
                    required: function(element) {
                        return ($("input[name='trade_type']:checked").val() == "credit") ? true : false;
                    }
                },
                mobile: {
                    required: function() {
                        if ($("input[name='trade_type']:checked").val() == "guest") {
                            if ($("#userid").val() == "") {
                                console.log('true');
                                return true;
                            } else {
                                console.log('false');
                                return false;
                            }
                        }
                    },
                    minlength: 10,
                    maxlength: 10,
                    remote: {
                        url: url + "api/users/checkMobile",
                        type: "post",
                        data: {
                            mobile: function() {
                                return $("#mobile").val();
                            },
                            user_id: function() {
                                return $("#userid").val();
                            }
                        }
                    },
                },
                location: {
                    required: true,
                    lettersonly: true,
                },

                exp_count: {
                    required: true,
                    minlength: 2,
                },
                exp_weight_kgs: {
                    required: true,
                },
                exp_farmer_price: {
                    required: true,
                },
                exp_company_price: {
                    required: true,
                },

            },
            messages: {
                tkey: {
                    required: "Mandatory",
                },
                ukey: {
                    required: "Mandatory",
                    // user_check: "User not selected",
                },
                mobile: {
                    required: "Mandatory",
                    minlength: "Invalid Number",
                    maxlength: "Invalid Number",
                    remote: 'Mobile Number Already Exists',
                },
                location: {
                    required: "Mandatory",
                    lettersonly: "Letters only please",
                },
                crop_opt: {
                    required: "Mandatory",
                },
                exp_count: {
                    required: "Mandatory",
                    minlength: "Invalid Count",
                },
                exp_weight_kgs: {
                    required: "Mandatory",
                },
                exp_farmer_price: {
                    required: "Mandatory",
                },
                exp_company_price: {
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
                    console.log(error.element.name);
                    if (error.element.name == "crop_opt") {
                        console.log('crop_opt');
                        $element.closest(".check_wt_serc").tooltip("dispose").data("title", error.message).data("placement", "top").tooltip({ onShow: function() { this.getTrigger().fadeTo("slow", 0.8); } });

                        $("#" + error.element.id).closest(".check_wt_serc").css("border", "1px solid red");
                    } else {
                        $element.tooltip("dispose").data("title", error.message).data("placement", "bottom").addClass("error").tooltip({ onShow: function() { this.getTrigger().fadeTo("slow", 0.8); } });

                        $("#" + error.element.id).parent().css("border", "1px solid red");
                    }
                });
            },
            submitHandler: function(form) {
                /*form submit*/
                formData = new FormData(tradefrm);
                $.ajax({
                    url: url + "api/trades/add",
                    data: formData,
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    enctype: 'multipart/form-data',
                    datatype: 'json',
                    success: function(response) {
                        res = JSON.parse(response);
                        if (res.status == 'success') {
                            new PNotify({
                                title: 'Success',
                                text: "Trade created successfully!",
                                type: 'success',
                                shadow: true
                            });
                            $('#tradefrm')[0].reset();
                            $("#crop_opt_li").html('<div class="form-check"><input class="form-check-input" type="radio" name="crop_opt" id="crp" required /><label class="form-check-label" for="crp"></label></div>');
                            $(".crop_type_val").html('Crop Location');
                            //setInterval('location.reload()', 2000);
                            table.ajax.reload();
                            $(".crt_link").trigger("click");
                        } else {
                            new PNotify({
                                title: 'Error',
                                text: res.msg,
                                type: 'failure',
                                shadow: true
                            });
                        }
                    }
                });
                /*form submit*/
            }
        });
    });

    $.validator.addMethod("edit_trader_check", function(value, element) {
        return ($("#trade_type_edit").val() != "");
    }, "Trader is not registered!");
    $.validator.addMethod("edit_user_check", function(value, element) {
        return ($(".userid_edit").val() != "");
    }, "User is not registered!");

    $(document).on("click", ".save_lnk", function() {
        console.log('edit submit');
        $('#tradefrm_edit_exp').validate({
            debug: false,
            rules: {
                tkey_edit: {
                    required: true,
                    edit_trader_check: true,
                },
                ukey_edit: {
                    required: true,
                    edit_user_check: true,
                },
                mobile: {
                    /* required: function(element) {
                        if ($("input[name='trade_type']:checked").val() == "guest")
                            return ($("#userid").val() != "");
                        else
                            return false;
                    }, */
                    //check_mobile: true,
                    minlength: 10,
                    maxlength: 10,
                    /* remote: {
                        url: url + "api/traders/checkmobile",
                        type: "post",
                        data: {
                            tname: function() {
                                return $('#trader_frm :input[name="tmobile"]').val();
                            },
                            trader_id: function() {
                                return $("#hid_td_id").val();
                            },
                        }
                    } */
                },
                location: {
                    required: true,
                    lettersonly: true,
                },
                crop_opt_edit: {
                    required: true,
                },
                exp_count_edit: {
                    required: true,
                    minlength: 2,
                },
                exp_weight_kgs_edit: {
                    required: true,
                },
                exp_farmer_price_val_edit: {
                    required: true,
                },
                exp_company_price_val_edit: {
                    required: true,
                },

            },
            messages: {
                tkey_edit: {
                    required: "Mandatory",
                },
                ukey_edit: {
                    required: "Mandatory",
                },
                mobile: {
                    // required: "Mandatory",
                    minlength: "Invalid Number",
                    maxlength: "Invalid Number",
                    //remote: 'Mobile Number Already Exists',
                },
                location: {
                    required: "Mandatory",
                    lettersonly: "Letters only please",
                },
                crop_opt_edit: {
                    required: "Mandatory",
                },
                exp_count_edit: {
                    required: "Mandatory",
                    minlength: "Invalid Count",
                },
                exp_weight_kgs_edit: {
                    required: "Mandatory",
                },
                exp_farmer_price_val_edit: {
                    required: "Mandatory",
                },
                exp_company_price_val_edit: {
                    required: "Mandatory",
                },

            },
            showErrors: function(errorMap, errorList) {
                // Clean up any tooltips for valid elements
                $.each(this.validElements(), function(index, element) {
                    var $element = $(element);
                    console.log('+++++');
                    var parent = $element.parent().attr('class');
                    console.log(parent);
                    if (parent == "form-check" || parent == "form-check") {
                        console.log('in');
                        $(element).closest(".check_wt_serc").data("title", "").tooltip("dispose");
                        $(element).closest(".check_wt_serc").css("border", "");
                    } else {
                        $element.data("title", "").removeClass("error").tooltip("dispose");
                        $(element).parent().css("border", "");
                    }

                });


                $.each(errorList, function(index, error) {
                    var $element = $(error.element);
                    console.log(error.element.name);
                    if (error.element.name == "crop_opt_edit") {
                        console.log($("#" + error.element.id).closest(".check_wt_serc"));

                        $element.closest(".check_wt_serc").tooltip("dispose").data("title", error.message).data("placement", "top").tooltip({ onShow: function() { this.getTrigger().fadeTo("slow", 0.8); } });

                        $("#" + error.element.id).closest(".check_wt_serc").css("border", "1px solid red");
                    } else {
                        $element.tooltip("dispose").data("title", error.message).data("placement", "bottom").addClass("error").tooltip({ onShow: function() { this.getTrigger().fadeTo("slow", 0.8); } });

                        $("#" + error.element.id).parent().css("border", "1px solid red");
                    }

                });
            },
            submitHandler: function(form) {
                formData = new FormData(tradefrm_edit_exp);
                formData.append("note_edit", $('#note_edit').val());

                $.ajax({
                    url: url + "api/trades/expected_update",
                    data: formData,
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    enctype: 'multipart/form-data',
                    datatype: 'json',
                    success: function(response) {
                        res = JSON.parse(response);
                        if (res.status == 'success') {
                            edit_exp_inact();
                            /* new PNotify({
                            	title: 'Success',
                            	text: "Trade updated successfully!",
                            	type: 'success',
                            	shadow: true
                            }); */
                            table.ajax.reload();
                            return false;
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
            }
        });
    });

    $(document).on("keyup blur focus", ".mykey", function() {
        //console.log('action');
        $(".mykey").each(function() {
            //console.log($(this).attr("id"));
            if ($(this).hasClass("error")) {
                $(this).parent().css("border", "1px solid red");
            } else {
                $(this).parent().css("border", "");
            }
        });
    });

    //Form submit
    $("#tradefrm1").submit(function(e) {
        var trade_date = $("#trade_date").val();
        var tkey = $("#tkey").val();
        var ukey = $("#ukey").val();
        var traderid = $("#traderid").val();
        var userid = $("#userid").val();
        var len = $(':radio[name="crop_opt"]:checked').length;
        var exp_count = $("#exp_count").val();
        var exp_weight_kgs = $("#exp_weight_kgs").val();
        var exp_farmer_price_val = $("#exp_farmer_price_val").val();
        var exp_company_price_val = $("#exp_company_price_val").val();

        var trade_type = $("input[name='trade_type']:checked").val();

        if (tkey == "") {
            err = 1;
            err_msg = "Please search trader!";
            tagid = "#tkey";
            return form_validation(err, err_msg, tagid);
        }
        if (traderid == "") {
            err = 1;
            err_msg = "Trader is not registered!";
            tagid = "#traderid";
            return form_validation(err, err_msg, tagid);
        }

        if (ukey == "") {
            err = 1;
            err_msg = "Please search user!";
            tagid = "#ukey";
            return form_validation(err, err_msg, tagid);
        }


        if (trade_type == "guest") {
            var mobile = $("#mobile").val();
            if (mobile == "") {
                err = 1;
                err_msg = "Please enter mobile!";
                tagid = "#mobile";
                return form_validation(err, err_msg, tagid);
            }
            if (mobile.length != "10") {
                err = 1;
                err_msg = "Enter valid mobile!";
                tagid = "#mobile";
                return form_validation(err, err_msg, tagid);
            }
        }
        if (trade_type == "credit") {
            if (userid == "") {
                err = 1;
                err_msg = "User is not registered!";
                tagid = "#userid";
                return form_validation(err, err_msg, tagid);
            }
            if (len == 0) {
                err = 1;
                err_msg = "Please select crop location!";
                tagid = "#crop_1";
                return form_validation(err, err_msg, tagid);
            }
        }
        if (exp_count == "") {
            err = 1;
            err_msg = "Please enter count!";
            tagid = "#exp_count";
            return form_validation(err, err_msg, tagid);
        }
        if (exp_weight_kgs == "") {
            err = 1;
            err_msg = "Please enter weight!";
            tagid = "#exp_weight_kgs";
            return form_validation(err, err_msg, tagid);
        }
        if (exp_farmer_price_val == "") {
            err = 1;
            err_msg = "Please enter farmer price!";
            tagid = "#exp_farmer_price_val";
            return form_validation(err, err_msg, tagid);
        }
        if (exp_company_price_val == "") {
            err = 1;
            err_msg = "Please enter company price!";
            tagid = "#exp_company_price_val";
            return form_validation(err, err_msg, tagid);
        }
        if (parseFloat(exp_company_price_val) < parseFloat(exp_farmer_price_val)) {
            err = 1;
            err_msg = "Farmer price should be less than company price!";
            tagid = "#exp_company_price_val";
            return form_validation(err, err_msg, tagid);
        }


    });

    //form submit end create trade
    $("#tradefrm_edit_exp1").submit(function(e) {
        console.log('exp form submit');
        var trade_date_edit = $("#trade_date_edit").val();
        var tkey_edit = $("#tkey_edit").val();
        var traderid_edit = $(".traderid_edit").val();

        var ukey_edit = $("#ukey_edit").val();
        var userid_edit = $(".userid_edit").val();

        var len = $(':radio[name="crop_opt_edit"]:checked').length;
        var exp_count_edit = $("#exp_count_edit").val();
        var exp_weight_kgs_edit = $("#exp_weight_kgs_edit").val();
        var exp_farmer_price_val_edit = $("#exp_farmer_price_val_edit").val();
        var exp_company_price_val_edit = $("#exp_company_price_val_edit").val();

        var trade_type = $("#trade_type_edit").val();

        if (tkey_edit == "") {
            err = 1;
            err_msg = "Please search trader!";
            tagid = "#tkey_edit";
            return form_validation1(err, err_msg, tagid);
        }
        if (traderid_edit == "") {
            err = 1;
            err_msg = "Trader is not registered!";
            tagid = "#tkey_edit";
            return form_validation1(err, err_msg, tagid);
        }


        if (ukey_edit == "") {
            err = 1;
            err_msg = "Please search user!";
            tagid = "#ukey_edit";
            return form_validation1(err, err_msg, tagid);
        }
        if (userid_edit == "") {
            err = 1;
            err_msg = "User is not registered!";
            tagid = "#ukey_edit";
            return form_validation1(err, err_msg, tagid);
        }

        if (trade_type == 1) {
            var mobile = $("#mobile_edit").val();
            if (mobile == "") {
                err = 1;
                err_msg = "Please enter mobile!";
                tagid = "#mobile_edit";
                return form_validation1(err, err_msg, tagid);
            }
        }
        if (trade_type == 0) {
            if (len == 0) {
                err = 1;
                err_msg = "Please select crop location!";
                tagid = "#crp_e1";
                return form_validation1(err, err_msg, tagid);
            }
        }
        if (exp_count_edit == "") {
            err = 1;
            err_msg = "Please enter count!";
            tagid = "#exp_count_edit";
            return form_validation1(err, err_msg, tagid);
        }
        if (exp_weight_kgs_edit == "") {
            err = 1;
            err_msg = "Please enter weight!";
            tagid = "#exp_weight_kgs_edit";
            return form_validation1(err, err_msg, tagid);
        }
        if (exp_farmer_price_val_edit == "") {
            err = 1;
            err_msg = "Please enter farmer price!";
            tagid = "#exp_farmer_price_val_edit";
            return form_validation1(err, err_msg, tagid);
        }
        if (exp_company_price_val_edit == "") {
            err = 1;
            err_msg = "Please enter company price!";
            tagid = "#exp_company_price_val_edit";
            return form_validation1(err, err_msg, tagid);
        }

        formData = new FormData(tradefrm_edit_exp);
        formData.append("note_edit", $('#note_edit').val());

        $.ajax({
            url: url + "api/trades/expected_update",
            data: formData,
            type: 'POST',
            contentType: false,
            processData: false,
            enctype: 'multipart/form-data',
            datatype: 'json',
            success: function(response) {
                res = JSON.parse(response);
                if (res.status == 'success') {
                    edit_exp_inact();
                    /* new PNotify({
                    	title: 'Success',
                    	text: "Trade updated successfully!",
                    	type: 'success',
                    	shadow: true
                    }); */
                    table.ajax.reload();
                    return false;
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

    /*form edit*/
    $("#tradefrm_edit").submit(function(e) {
        //actual form validation
        if ($('#status').val() == "1") {
            var err = 0;
            rowCount = $(".actl_tbl > tbody > tr").length;
            if (rowCount == '1') {
                id = 0;
                tdate = $("#tdate" + id).val();
                tcount = $("#tcount" + id).val();
                tcprice = $("#tcprice_" + id).val();
                tcweight = $("#tcweight_" + id).val();
                tcamount = $("#tcamount_" + id).val();
                tfprice = $("#tfprice_" + id).val();
                tfweight = $("#tfweight_" + id).val();
                tfamount = $("#tfamount_" + id).val();
                if (tdate == "" || tdate == "01-Jan-1970" || tcount == "" || tcprice == "" || tcprice == "0" || tcweight == "" || tcweight == "0" || tcamount == "" || tcamount == "0" || tfprice == "" || tfprice == "0" || tfweight == "" || tfweight == "0" || tfamount == "" || tfamount == "0") {
                    $('#status').val('0');
                    err = 1;
                    err_msg = "Fill atleast single record before finishing trade";
                    new PNotify({
                        title: 'Error',
                        text: err_msg,
                        type: 'error',
                        shadow: true,
                        delay: 3000,
                        stack: { "dir1": "down", "dir2": "right", "push": "top" }
                    });
                    return false;
                    /* err = 1;
                    err_msg = "Fill atleast single record before finishing trade";
                    tagid = "";
                    console.log('data is incomplete' + id);
                    $('#status').val('0');
                    return form_validation1(err, err_msg, tagid);
                    return false; */
                }
            } else {
                $("[id^='tcprice_']").each(function() {
                    var id = $(this).attr('id');
                    id = id.replace("tcprice_", '');
                    console.log(id);
                    tdate = $("#tdate" + id).val();
                    tcount = $("#tcount" + id).val();
                    tcprice = $("#tcprice_" + id).val();
                    tcweight = $("#tcweight_" + id).val();
                    tcamount = $("#tcamount_" + id).val();
                    tfprice = $("#tfprice_" + id).val();
                    tfweight = $("#tfweight_" + id).val();
                    tfamount = $("#tfamount_" + id).val();
                    if (tdate == "" || tdate == "01-Jan-1970" || tcount == "" || tcprice == "" || tcprice == "0" || tcweight == "" || tcweight == "0" || tcamount == "" || tcamount == "0" || tfprice == "" || tfprice == "0" || tfweight == "" || tfweight == "0" || tfamount == "" || tfamount == "0") {
                        if ((tdate == "" || tdate == "01-Jan-1970") && tcount == "" && (tcprice == "" || tcprice == "0") && (tcweight == "" || tcweight == "0") && (tcamount == "" || tcamount == "0.0000") && (tfprice == "" || tfprice == "0") && (tfweight == "" || tfweight == "0") && (tfamount == "" || tfamount == "0.0000")) {
                            console.log('cant check');
                            //return true;
                        } else {
                            $('#status').val('0');
                            err = 1;
                            err_msg = "Please fill complete details";
                            new PNotify({
                                title: 'Error',
                                text: err_msg,
                                type: 'error',
                                shadow: true,
                                delay: 3000,
                                stack: { "dir1": "down", "dir2": "right", "push": "top" }
                            });
                            return false;
                            /* err = 1;
                            err_msg = "Please fill complete details";
                            tagid = "";
                            console.log('data is incomplete' + id);
                            $('#status').val('0');
                            return form_validation1(err, err_msg, tagid); */
                        }

                    } else {
                        console.log('data is complete' + id);
                    }
                });
            }
            if (err == 1) {
                return false;
            }
        }
        $('#fnhide').prop('disabled', true);
        formData = new FormData(tradefrm_edit);
        formData.append("crop_opt_edit", $("input[name='crop_opt_edit']:checked").val());
        $.ajax({
            url: url + "api/trades/update",
            data: formData,
            type: 'POST',
            contentType: false,
            processData: false,
            enctype: 'multipart/form-data',
            datatype: 'json',
            success: function(response) {
                res = JSON.parse(response);
                if (res.status == 'success') {
                    new PNotify({
                        title: 'Success',
                        text: "Trade updated successfully!",
                        type: 'success',
                        shadow: true
                    });
                    table.ajax.reload();
                    $(".pp_clss").trigger("click");

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

    $(".updt_btn").click(function() {
        $('#status').val(1);
    });
    /*form edit*/

    /*delete*/
    $(".del_yes").click(function() {
        var delval = $("#hid_lid").val();
        $.ajax({
            url: url + "api/trades/delete",
            data: { tid: delval },
            type: 'POST',
            datatype: 'json',
            success: function(response) {

                res = JSON.parse(response);

                if (res.status == 'success') {
                    new PNotify({
                        title: 'Success',
                        text: "Trade deleted successfully!",
                        type: 'success',
                        shadow: true
                    });
                    table.ajax.reload();
                }
            }
        });
    });
    /*delete*/

    $(document).on('click', '.note', function() {
        $('.note_txt').toggle();
    });

    $('#usr_lst_tbl_wrapper .dataTables_length').html('<ul class="tabs_tbl"><li class="act_tab drft_cl"> <span>Drafts</span> <span id="trade_draft"> </span> </li><li class="comp_cl"> <span> Completed </span><span id="trade_total"> </span> </li></ul> <span class="tbl_btn">  </span>');

    $("div.toolbar").html('<b>SSS</b>');
    $('a.toggle-vis').on('click', function(e) {
        $(this).parent().toggleClass('act');
        e.preventDefault();
        var column = table.column($(this).attr('data-column'));
        column.visible(!column.visible());
    });


    //$('.dataTables_length').html('<h2 class="create_hdg lng_hdg">  Trade List </h2>');
    $('.adds_blk').click(function() {
        var k = $(this).text();
        $('.adds_blk').removeClass('fl_wth');
        $(this).addClass('fl_wth');

        $('.fl_wth').click(function() {
            $(this).siblings('.tool_tip').text(k);
            $(this).siblings('.tool_tip').show();
        });

        $('.fl_wth').mouseout(function() {
            $('.tool_tip').hide();
            $('.tool_tip').text('');
        });

    });

    $('.comp_cl').click(function() {
        $("#hid_tabval").val(1);
        /*  $('.utypes').hide();
         $('.ttypes').show();
         $('input[name="user_type_opt"][value=""]').prop('checked', true); */
        $('.tabs_tbl').addClass('cmp_ul');
        $(this).addClass('act_tab');
        $('.drft_cl').removeClass('act_tab');
        get_traders('1');
        get_users('1');
        table.ajax.reload();
    });

    $('.drft_cl').click(function() {
        $("#hid_tabval").val(0);
        /*  $('.utypes').show();
         $('.ttypes').hide();
         $('input[name="user_type_opt"][value=""]').prop('checked', true); */
        $('.tabs_tbl').removeClass('cmp_ul');
        $(this).addClass('act_tab');
        $('.comp_cl').removeClass('act_tab');
        get_traders('0');
        get_users('0');
        table.ajax.reload();
    });

    $('.ad_mr_trd').click(function() {
        $('.sec_blk').css('display', 'table');
    });

    $(document).mouseup(function(e) {
        var fl_cnt = $('.adds_blk');
        if (!fl_cnt.is(e.target) && fl_cnt.has(e.target).length === 0) {
            $('.adds_blk ').removeClass('fl_wth');
        }
    });

    $('.crt_link').click(function() {
        $('.trade_create').toggleClass('sh_trade_create');
        $('.trd_cr_r').toggleClass('trd_cr_r_r');
        $(this).find('.btn').toggleClass('hide_blk');
        $('.cl_crt_bl').toggleClass('hide_blk');
        $('#tradefrm')[0].reset();
        $("#crop_opt_li").html('<div class="form-check"><input class="form-check-input" type="radio" name="crop_opt" id="crp" required /><label class="form-check-label" for="crp"></label></div>');
        $(".crop_type_val").html('Crop Location');
        $("#cropdis").show();
        $("#guestmobile").hide();
        $("#guest_location").hide();
        $(".mykey").parent().css("border", "");
        $(".mykey").each(function() {
            if ($(this).val() == "") {
                $(this).parent().removeClass('inp_ss');
            }
        });
        $('.radio_blk').removeClass('checkd');
        $('input:radio[name=trade_type]:checked').parent().addClass("checkd")

    });

    $('body').css('display', 'block');

    $('#exp_far, #exp_cmp').keyup(function() {
        var e_cnt = $('#mul1').val();
        var e_far = $('#exp_far').val();
        var e_cmp = $('#exp_cmp').val();
        if (e_cnt != null) {
            if (e_far != '') {
                if (e_cmp != '') {
                    $('.expected_blk').show();
                }
            }
        }
    });

    $('#mobile_edit').blur(function() {
        $("#mobile_edit").prop("disabled", false);
        var user_id = $(".userid_edit").val().trim();
        var ukey = $("#ukey_edit").val().trim();
        var mobile = $("#mobile_edit").val().trim();
        if (user_id == "") {
            if (ukey != '' && mobile != '') {
                $.ajax({
                    url: url + "api/trades/insertguest",
                    data: { ukey: ukey, mobile: mobile },
                    type: 'POST',
                    datatype: 'json',
                    success: function(response1) {

                        rescp1 = JSON.parse(response1);
                        // alert(JSON.stringify(rescp1));
                        if (rescp1.status == 'success') {
                            $(".userid_edit").val(rescp1.insert_id);
                            var err_msg = 'Guest user added successfully';
                            $("#snackbar1").text(err_msg);
                            $("#snackbar1").addClass("show");
                            setTimeout(function() { $("#snackbar").removeClass("show"); }, 3000);

                        }

                    }
                });
            }

        }
    });

    $(document).on('blur', '#ukey', function() {
        $(".selectVal").html('');
        if ($(this).val() == '') {
            $("#userid").val('');
        }
        var user_id = $("#userid").val().trim();
        if (user_id != "") {
            getusercrops(user_id, 'add');
        } else {
            console.log('clear crop');
            var opt = '<option value="">Crop Location</option>';
            $("#crop_opt_li").html('<div class="form-check"><input class="form-check-input" type="radio" name="crop_opt" id="crp" required /><label class="form-check-label" for="crp"></label></div>');
            $(".crop_type_val").html('Crop Location');
        }
    });

    $('#ukey_edit').blur(function() {
        $(".crop_type_val").html('Crop location');
        if ($(this).val() == '') {
            $(".userid_edit").val('');
        }
        //var usercode = $(this).val();
        //var usercode = $("#select_usercode").val().trim();
        var user_id = $(".userid_edit").val().trim();
        if (user_id != "") {
            getusercrops1(user_id, 'edit');

        } else {
            var opt = '<option value="">Crop Location</option>';
            $("#crop_opt_edit").html(opt);
            $("#crop_opt_edit").val('');
        }
    });

    $(document).on("click", ".del", function() {
        $('#delete_trade').modal();
    });

    $(document).on("click", ".edt", function() {
        editPopup();
    });

    $('.pp_clss').click(function() {
        $('#edt_user_id').hide();
        $('.ap_blk').hide();
        $('.popover').remove();
        //$('.top_no_txt').removeClass('gry_bdr');
        //$('.top_no_txt').removeClass('blu_bd_txt');

    });

    $('.crt_blk').click(function() {
        $('.cl_crt_trd').show();
        $(this).addClass('cre_all_blk');
    });

    $('.cl_crt_trd').click(function() {
        $('.crt_blk').removeClass('cre_all_blk');
        $('.trd_anl').removeClass('wth_100');
        $(this).hide();
        $('.sec_blk').hide();
        $('.trd_cr input[type=text]').val('');
        $(".trd_cr input[type=radio]").prop("checked", true);
        $('.check_wt_serc').removeClass('val_seld');
        $('.cre_inp').removeClass('inp_ss');
        $('.sm_blk').hide();
        $('#sel_usr').text('Select User');
        $('#sel_trd').text('Select Trader');
        $('#exp_cnt').text('Expected Count');
        $('#ac_f_cnt').text('Act.Farmer Count');
        $('#act_com_cn').text('Act.Company Count');
        $('.trd_ad_lst').addClass('show_ad_m');
    });

    $('.remv_blk').click(function() {
        $('.sec_blk').hide();
    });

    $('.ap_blk').click(function() {
        $('#edt_user_id').hide();
        $(this).hide();
    });

    var dateToday = new Date();

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
    }, cb);

    $("#trade_date").datepicker({
        dateFormat: 'dd-M-yy',
        changeMonth: true,
        changeYear: true,
        //minDate: dateToday,
        numberOfMonths: 1
    });

    $("#trade_date_edit").datepicker({
        dateFormat: 'dd-M-yy',
        changeMonth: true,
        changeYear: true,
        //minDate: dateToday,
        numberOfMonths: 1
    });

    $("#from_date").datepicker({
        dateFormat: 'dd-M-yy',
        //defaultDate: "+1w",
        changeMonth: true,
        changeYear: true,
        //minDate: dateToday,
        numberOfMonths: 1,
        onSelect: function(selected) {
            str = selected.split("-").join(" ");
            var dt = new Date(str);
            dt.setDate(dt.getDate() + 1);
            $("#to_date").datepicker("option", "minDate", dt);
            $(this).parent().parent('.sts_fil_blk').addClass('show');
            $(this).parent().parent().parent().children('.sts_pp').addClass('ad_tgl');
        }
    });

    $("#to_date").datepicker({
        dateFormat: 'dd-M-yy',
        //defaultDate: "+1w",
        changeMonth: true,
        changeYear: true,
        //minDate: dateToday,
        numberOfMonths: 1,
        onSelect: function(selected) {
            str = selected.split("-").join(" ");
            var dt = new Date(str);
            dt.setDate(dt.getDate() - 1);
            $("#from_date").datepicker("option", "maxDate", dt);
            $(this).parent().parent('.sts_fil_blk').addClass('show');
            $(this).parent().parent().parent().children('.sts_pp').addClass('ad_tgl');
        }
    });

    $('.edt_bl_lnk').click(function() {
        console.log('edit click');
        edit_exp_act();
    });
});

/*calculations*/
// company price
$(document).on('blur', "[id^=tcweight_]", function() {
    var id = $(this).attr('id');
    id = id.replace("tcweight_", '');
    var qty = $(this).val();
    $("#tfweight_" + id).val($(this).val());
    calculateTotal();
});

$(document).on('blur', "[id^=tcprice_]", function() {
    calculateTotal();
});

$(document).on('blur', "[id^=tfprice_]", function() {
    var id = $(this).attr('id');
    id = id.replace("tfprice_", '');
    var tcp = $('#tcprice_' + id).val();
    var tfp = $('#tfprice_' + id).val();
    /*alert(tfp);
    alert(tcp);*/
    if (tcp == '') {
        if (tcp == "") {
            err = 1;
            err_msg = "Please enter company price!";
            new PNotify({
                title: 'Error',
                text: err_msg,
                type: 'error',
                shadow: true,
                delay: 3000,
                stack: { "dir1": "down", "dir2": "right", "push": "top" }
            });
            /* tagid = "#tcprice_" + id;
            return form_validation1(err, err_msg, tagid); */
        }
        return false;
    }
    if (parseInt(tfp) > parseInt(tcp)) {
        $('#tfprice_' + id).val('');
        $('#tfamount_' + id).val('');
        if (parseInt(tfp) > parseInt(tcp)) {
            //err = 1;
            err_msg = "Farmer price less than company price!";
            new PNotify({
                title: 'Error',
                text: err_msg,
                type: 'error',
                shadow: true,
                delay: 3000,
                stack: { "dir1": "down", "dir2": "right", "push": "top" }
            });
            /* tagid = "#tfprice_" + id;
            return form_validation1(err, err_msg, tagid); */
        }
        return false;
    }
    calculateTotal1();
    /*appending*/
    var rowNum = id;
    var tdt = $('#tdate' + id).val();
    var tcnt = $('#tcount' + id).val();
    var tcp = $('#tcprice_' + id).val();
    var tfp = $('#tfprice_' + id).val();
    var tcw = $('#tcweight_' + id).val();
    var tfw = $('#tfweight_' + id).val();

    var tdt0 = $('#tdate0').val();
    var tdt1 = $('#tdate1').val();
    var tcnt0 = $('#tcount0').val();
    var tcp0 = $('#tcprice_0').val();
    var tfp0 = $('#tfprice_0').val();
    var tcw0 = $('#tcweight_0').val();
    var tfw0 = $('#tfweight_0').val();

    if (tdt0 == '') {
        if (tdt0 == '') {
            err = 1;
            err_msg = "Please select date!";
            new PNotify({
                title: 'Error',
                text: err_msg,
                type: 'error',
                shadow: true,
                delay: 3000,
                stack: { "dir1": "down", "dir2": "right", "push": "top" }
            });
            return false;
            /*  tagid = "#tdate0";
             return form_validation1(err, err_msg, tagid); */
        }

        return false;
    }
    if (tdt1 == '') {
        if (tdt1 == '') {
            err = 1;
            err_msg = "Please select date!";
            new PNotify({
                title: 'Error',
                text: err_msg,
                type: 'error',
                shadow: true,
                delay: 3000,
                stack: { "dir1": "down", "dir2": "right", "push": "top" }
            });
            return false;
            /* tagid = "#tdate1";
            return form_validation1(err, err_msg, tagid); */
        }

        return false;
    }
    if (tdt == '') {
        if (tdt == '') {
            err = 1;
            err_msg = "Please select date!";
            new PNotify({
                title: 'Error',
                text: err_msg,
                type: 'error',
                shadow: true,
                delay: 3000,
                stack: { "dir1": "down", "dir2": "right", "push": "top" }
            });
            return false;
            /* tagid = "#tdate" + id;
            return form_validation1(err, err_msg, tagid); */
        }

        return false;
    }
    if (tcnt == '') {
        if (tcnt == '') {
            err = 1;
            err_msg = "Please enter count!";
            new PNotify({
                title: 'Error',
                text: err_msg,
                type: 'error',
                shadow: true,
                delay: 3000,
                stack: { "dir1": "down", "dir2": "right", "push": "top" }
            });
            return false;
            /* tagid = "#tcount" + id;
            return form_validation1(err, err_msg, tagid); */
        }

        return false;
    }
    if (tcp == '') {
        if (tcp == '') {
            err = 1;
            err_msg = "Please enter price!";
            tagid = "#tcprice_" + id;
            return form_validation1(err, err_msg, tagid);
        }

        return false;
    } else if (tcw == '') {
        if (tcw == '') {
            err = 1;
            err_msg = "Please enter weight!";
            tagid = "#tcweight_" + id;
            return form_validation1(err, err_msg, tagid);
        }

        return false;
    } else if (tfp == '') {
        if (tfp == '') {
            err = 1;
            err_msg = "Please enter price!";
            tagid = "#tfprice_" + id;
            return form_validation1(err, err_msg, tagid);
        }

        return false;
    } else if (tcnt0 != '' && tcp0 != '' && tfp0 != '' && tcw0 != '' && tfw0 != '') {
        rowNum++;

        htmlRows = '<tr id="rowNums' + rowNum + '"><td> <input type="text" class="form-control mykey edate" placeholder="" name="tdate[]" id="tdate' + rowNum + '" onkeydown="return false;" ></td><td class="cnt_wth"><input maxlength="7" type="text" class="form-control noalpha mykey" placeholder="" name="tcount[]" id="tcount' + rowNum + '" onkeypress="return IsAlphaNumeric(this,event)"> </td><td class="bor_t_b_none"><div> &nbsp;</div></td><td class="weig"><input type="text" class="form-control mykey" placeholder="" maxlength="9" name="tcprice[]" id="tcprice_' + rowNum + '" onkeypress="return isPrice(this, event);" ></td><td class="com_bg weig" width="80"> <input type="text" class="form-control mykey" placeholder="" name="tcweight[]" id="tcweight_' + rowNum + '" onkeypress="return isWeight(this,event)" ></td><td class="com_bg amn_blk"><input type="text" class="form-control mykey" placeholder="" readonly name="tcamount[]" id="tcamount_' + rowNum + '"  ><input type="hidden" class="form-control mykey" placeholder="" readonly name="tcamountval[]" id="tcamountval_' + rowNum + '"></td><td class="bor_t_b_none"><div> &nbsp;</div></td><td class="far_bg weig"> <input type="text" maxlength="9" class="form-control mykey" placeholder="" name="tfprice[]" id="tfprice_' + rowNum + '" onkeypress="return isPrice(this,event)" ></td><td class="far_bg weig" width="80"><input type="text" class="form-control mykey" placeholder="" name="tfweight[]" id="tfweight_' + rowNum + '" onkeypress="return isWeight(this,event)" readonly></td><td class="far_bg amn_blk"> <input type="text" class="form-control mykey" placeholder="" readonly name="tfamount[]" id="tfamount_' + rowNum + '" ><input type="hidden" class="form-control mykey" placeholder="" readonly name="tfamountval[]" id="tfamountval_' + rowNum + '" ><input type="hidden" class="form-control noalpha mykey" placeholder="" readonly name="hid_acivity_id[]" id="hid_acivity_id_' + rowNum + '" value="0"> </td></tr>';

        $('#invoiceItem').append(htmlRows);

        var dateToday = new Date();
        $("#tdate" + rowNum).datepicker({
            dateFormat: 'dd-M-yy',
            changeMonth: true,
            changeYear: true,
            // minDate: dateToday,
            numberOfMonths: 1
        });
    }
});

//farmer price

$(document).on('blur', "[id^=tfweight_]", function() {
    var status = $('#status').val();
    if (status == 1) {
        return false;
    } else {
        var id = $(this).attr('id');
        id = id.replace("tfweight_", '');
        $("#tcweight_" + id).val($(this).val());
        var qty = $(this).val();
        calculateTotal1();
        return false;
    }
    /*appending*/
});

$(document).on('blur', "[id^=expenses]", function() {
    calculateTotal1();
});
$(document).on('blur', "[id^=labfee]", function() {
    calculateTotal1();
});
$(document).on('blur', "[id^=tcount]", function() {
    var id = $(this).attr('id');
    id = id.replace("tcount", '');
    var status = $('#status').val();

    if (id > 0) {
        var qty = $(this).val();
        if (qty == '' && status == 0) {
            var thid = $('#hid_acivity_id_' + id).val();
            var tdt = $('#tdate' + id).val();
            var tcp = $('#tcprice_' + id).val();
            var tfp = $('#tfprice_' + id).val();
            var tcw = $('#tcweight_' + id).val();
            var tfw = $('#tfweight_' + id).val();
            var thid = $('#hid_acivity_id_' + id).val();

            var ttid = $(".trade_id").val();
            if (thid > 0) {
                if (tcp == '' && tfp == '' && tcw == '' && tfw == '') {
                    if (confirm('Are you sure you want to remove')) {

                        $.ajax({
                            url: url + "api/trades/tradesdelete",
                            data: { tid: thid, tradeid: ttid },
                            type: 'POST',
                            datatype: 'json',
                            success: function(responseff) {
                                res = JSON.parse(responseff);
                                $('#cweight').html(roundTo(res.data.company_fweight, 3));
                                $('#camount').html(currency_format((res.data.company_fprice), 3));
                                $('#fweight').html(roundTo(res.data.farmer_fweight, 3));
                                $('#famount').html(currency_format((res.data.farmer_fprice), 3));

                                $('#cweightval').val(roundTo(res.data.company_fweight, 3));
                                $('#camountval').val(roundTo(res.data.company_fprice, 3));
                                $('#fweightval').val(roundTo(res.data.farmer_fweight, 3));
                                $('#famountval').val(roundTo(res.data.farmer_fprice, 3));

                                $('#expenses').val(res.data.expenses_farmer);
                                $('#labfee').val(res.data.labfee_framer);
                                var gttot = parseFloat(res.data.gtotal) - parseFloat(res.data.expenses_farmer) - parseFloat(res.data.labfee_framer);
                                $('#gtotalval').val(roundTo(res.data.gtotal, 2));
                                $('#gtotal').html(currency_format(gttot, 2));
                            }
                        });

                        $('#rowNums' + id).remove();
                    }
                }
            } else {
                if (tcp == '' && tfp == '' && tcw == '' && tfw == '' && tdt == '') {
                    $('#rowNums' + id).remove();
                }
            }

        }
    }
});

$('.noalpha').keypress(function(event) {

    if (event.which != 8 && isNaN(String.fromCharCode(event.which))) {
        event.preventDefault(); //stop character from entering input
    }

});