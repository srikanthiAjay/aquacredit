function isNumberKey(el, evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode;
    var number = el.value.split('.');
    if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    //just one dot
    if (number.length > 1 && charCode == 46) {
        return false;
    }
    //get the carat position

    var caratPos = getSelectionStart(el);
    var dotPos = el.value.indexOf(".");
    if (caratPos > dotPos && dotPos > -1 && (number[1].length > 1)) {
        return false;
    }
    return true;
}

function validateFloatKeyPress(el, evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode;
    var number = el.value.split('.');
    if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    //just one dot
    if (number.length > 1 && charCode == 46) {
        return false;
    }
    //get the carat position
    var caratPos = getSelectionStart(el);
    var dotPos = el.value.indexOf(".");
    if (caratPos > dotPos && dotPos > -1 && (number[1].length > 1)) {
        return false;
    }
    return true;
}

//thanks: http://javascript.nwbox.com/cursor_position/
function getSelectionStart(o) {
    if (o.createTextRange) {
        var r = document.selection.createRange().duplicate()
        r.moveEnd('character', o.value.length)
        if (r.text == '') return o.value.length
        return o.value.lastIndexOf(r.text)
    } else return o.selectionStart
}

function addCommas(x) {
    x = x.toString();
    var lastThree = x.substring(x.length - 3);
    var otherNumbers = x.substring(0, x.length - 3);
    if (otherNumbers != '')
        lastThree = ',' + lastThree;
    //var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
    var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/, ",") + lastThree;

    return res;
}

function getlloandata() {
    $('#summaryrecord').html('');
    var crpid = $("#crop_id").val();
    $('#acropid').val(crpid);

    /*get loans data start*/
    $('#loandata').html('');
    $.ajax({
        url: url + "api/users/getloandata",
        data: { userid: user_id, crop_id: crpid },
        type: 'POST',
        datatype: 'json',
        success: function(response1) {
            res1 = JSON.parse(response1);
            htmlRows = "";
            $('#rowcount').val(res1.length);

            if (res1.length > 0) {
                $(".fst_step").trigger("click");

                var lss = $('#loanstepshow').val();
                var sss = $('#salestepshow').val();

                if (lss == 1) {
                    //$('.sec_step').hide();
                    $('.sale_tb').hide();
                } else {
                    $('.loans_tb').show();
                }

                $('#loanstepshow').val(1);
                $('.fst_step').show();
                $('.loans_tb').show();

                $('#saleOrder').hide();
                $('#confirmOrder').show();
                $('#finalOrder').hide();

                $.each(res1, function(index, trades) {
                    //alert(JSON.stringify(trades));
                    var tcamtt = trades.amount;
                    var interestval = trades.interestval;
                    if (trades.interest_amount != '' && trades.interest_amount != null) {
                        var interest_amount = currency_format(trades.interest_amount, 2);
                    } else {
                        var interest_amount = 0;
                    }

                    if (trades.total_amount != '' && trades.total_amount != null) {
                        var total_amount = currency_format(trades.total_amount, 2);
                    } else {
                        var total_amount = 0;
                    }

                    /*var tfamtt = trades.total_price;*/
                    $('#billdate').html(trades.billdate);
                    id = trades.trans_id;

                    htmlRows = '<tr><td><input type="text" class="txt_cnt mykey datepicker" onkeydown="return false;" value="' + trades.startdate + '" name="startdate[' + id + ']" id="startdate' + id + '" style="width:96px;" disabled>  </td><td><input type="text" class="txt_cnt mykey datepicker" value="' + trades.enddate + '" name="enddate[' + id + ']" id="enddate' + id + '"  onkeypress="return validateFloatKeyPress(this,event);" style="width:96px;"></td><td><span id="daydis' + id + '"> ' + trades.days + '</span> </td><td> ' + trades.croploan + '</td><td class="txt_rt"> ' + '₹' + currency_format(tcamtt, 2) + '</td><td> <input type="text" class="txt_cnt rt_int mykey" value="' + interestval + '" name="iinterest[' + id + ']" id="iinterest' + id + '" onkeypress="return validateFloatKeyPress(this,event);"> <input type="hidden" value="' + trades.amount + '" name="tot[' + id + ']" id="tot' + id + '" ><input type="hidden" value="' + trades.days + '" name="days[' + id + ']" id="days' + id + '" ><input type="hidden" value="' + trades.months + '" name="months[' + id + ']" id="months' + id + '" ><input type="hidden" value="' + trades.id + '" name="trans_id[' + id + ']" id="trans_id' + id + '" ><input type="hidden"  name="interestamtval[' + id + ']" id="interestamtval' + id + '" value="' + trades.interest_amount + '" /><input type="hidden" name="totamtval[' + id + ']" id="totamtval' + id + '" value="' + trades.total_amount + '" /></td><td class="txt_rt" id="interestamt' + id + '"> ' + interest_amount + '</td><td class="txt_rt txt_red" id="totamt' + id + '">' + total_amount + '</td></tr>';

                    $('#loandata').append(htmlRows);

                    /*limit validation*/
                    $("#startdate" + id).datepicker({
                        dateFormat: 'dd-M-yy',
                        setDate: "28-Apr-2020",
                        //defaultDate: "+1w",
                        beforeShow: function(input, inst) {
                            $(document).off('focusin.bs.modal');
                        },
                        onClose: function() {
                            $(document).on('focusin.bs.modal');
                        },
                        changeMonth: true,
                        changeYear: true,
                        //minDate: '28-Apr-2020',
                        numberOfMonths: 1,
                        //showButtonPanel: true,
                        onSelect: function(selected) {
                            calculateTotal();
                            str = selected.split("-").join(" ");
                            var dt = new Date(str);
                            dt.setDate(dt.getDate() + 1);
                            $("#enddate" + id).datepicker("option", "minDate", dt);
                            //update_activity_table('start_date', selected, $(this).attr("id").replace("startdate", ''));
                        }
                    });

                    $("#enddate" + id).datepicker({
                        dateFormat: 'dd-M-yy',
                        //defaultDate: "+1w",
                        beforeShow: function(input, inst) {
                            $(document).off('focusin.bs.modal');
                        },
                        onClose: function() {
                            $(document).on('focusin.bs.modal');
                        },
                        changeMonth: true,
                        changeYear: true,
                        //minDate: dateToday,
                        numberOfMonths: 1,
                        onSelect: function(selected) {
                            calculateTotal();
                            str = selected.split("-").join(" ");
                            var dt = new Date(str);
                            dt.setDate(dt.getDate() - 1);
                            //update_activity_table('end_date', selected, $(this).attr("id").replace("enddate", ''));
                        }
                    });
                    str = trades.startdate.split("-").join(" ");
                    var dt = new Date(str);
                    dt.setDate(dt.getDate() + 1);
                    $("#enddate" + id).datepicker("option", "minDate", dt);
                });
                calculateTotal();
            } else {
                $('.loans_tb').hide();
                $('.fst_step').hide();
                $('#loanhide').hide();

                //$('#poptextshow1').html('1');
                $('#poptextshow2').html('1');
                $('#poptextshow3').html('2');
            }
        }
    });
    /*get loans data end*/
    /*get sales data start*/
    $('#saledataload').html('');
    $('#summarysalerecord').html('');
    $('#summaryrecord').html('');

    $.ajax({
        url: url + "api/users/getsalesdata",
        data: { userid: user_id, crop_id: crpid },
        type: 'POST',
        datatype: 'json',
        success: function(response1) {
            data = JSON.parse(response1);
            var sumrecord = final_sale = final_products = cat_row = '';
            var bags = feed_weight = 0;
            $(".sale_details").remove();

            $('#salestepshow').val(1);
            var lsshow = $('#loanstepshow').val();
            if (lsshow == 0) {
                $('.sec_step').show();
                $('.sale_tb').show();

                $('#saleOrder').show();
                $('#confirmOrder').hide();
                $('#finalOrder').hide();
            }

            $.each(data.categories, function(c_index, category) {
                var category_sum = 0;
                cat_brand_count = Object.keys(data.brands[c_index]).length;
                cat_row += '<thead data-toggle="collapse" data-target="#feed_tbl' + c_index + '" aria-expanded="false" aria-controls="feed_tbl' + c_index + '"><tr><th><span class="tggl_act"><img src="' + url + 'assets/images/plu.svg" class="plu"><img src="' + url + 'assets/images/mini.svg" class="mini"></span>' + category + ' (' + cat_brand_count + ') </th><th class="pp_amnt txt_rt"></th><th class="pp_dis"></th><th class="pp_ttl txt_rt"> </th></tr></thead>';
                if (cat_brand_count > 0) {
                    cat_row += '<tbody>' + //2
                        '<tr>' +
                        '<td colspan="4">' +
                        '<div id="feed_tbl' + c_index + '" class="collapse show tgl_div">' +
                        '<table border="0" cellpadding="0" cellspacing="0">' +
                        '<tr>' + //1
                        '<td colspan="4">' +
                        '<div><table border="0" cellpadding="0" cellspacing="0">' +
                        '<tr><td class="brnd_ane"> <b> Brand Name</b> </td><td class="pp_amnt txt_rt"> <b> MRPs Total</b></td><td class="pp_dis"> <b> Discount </b> </td><td class="pp_ttl txt_rt"> <b> Total </b></td></tr>';

                    $.each(data.brands[c_index], function(b_index, brand) {
                        cat_row += '<tr>' +
                            '<td class="brnd_ane" data-toggle="collapse" data-target="#prds_tbl' + c_index + b_index + '" aria-expanded="false" aria-controls="prds_tbl' + c_index + b_index + '">' +
                            '<a href="javascript:void(0);" >' + brand.name + '</a>' +
                            '</td>' +
                            '<td class="pp_amnt txt_rt">' + '₹' + currency_format(brand.sum_mrp, 2) + '</td>' +
                            '<td class="pp_dis">' +
                            '<input type="text" name="branddiscount[' + c_index + '][' + b_index + ']" id="branddiscountval' + c_index + '_' + b_index + '" value="" autocomplete="off" class="brand_discount" onkeypress="return validateFloatKeyPress(this,event);">' +
                            '<input type="hidden" name="discountvalue[' + c_index + '][' + b_index + ']" id="discountvalue' + c_index + '_' + b_index + '" value="" autocomplete="off" class="discountvalue">' +
                            '<input type="hidden" name="discount_limit[' + c_index + '][' + b_index + ']" id="discount_limit' + c_index + '_' + b_index + '"  value="' + brand.brand_disc_limit + '">' +
                            '<input type="hidden" name="brandtotal[' + c_index + '][' + b_index + ']" id="brandtotal' + c_index + '_' + b_index + '"  value="' + roundTo(brand.sum_mrp, 2) + '"></td>' +
                            '<td class="pp_ttl txt_rt" id="brandtotamt' + c_index + '_' + b_index + '" >' + '₹' + currency_format(brand.sum_mrp, 2) + '</td>' +
                            '</tr>' +
                            '<tr>' + //3
                            '<td colspan="4" class="prd_b_tb">' +
                            '<div id="prds_tbl' + c_index + b_index + '" class="collapse tgl_div">' +
                            '<table>' +
                            '<tr>' +
                            '<th class="brnd_ane"> Product Name </th>' +
                            '<th class="pp_amnt txt_rt"> MRP </th>' +
                            '<th class="pp_dis"> Discount </th>' +
                            '<th class="pp_ttl txt_rt"> Total </th>' +
                            '</tr>';
                        $.each(data.products[c_index][b_index], function(p_index, product) {
                            cat_row += '<tr>' +
                                '<td class="brnd_ane"> ' +
                                '<a href="javascript:void(0)"> ' + product.name + '</a>' +
                                '</td>' +
                                '<td class="pp_amnt txt_rt"> ' + '₹' + currency_format(product.total_mrp, 2) + ' </td>' +
                                '<td class="pp_dis"> ' +
                                '<input type="text" name="proDiscount[' + c_index + '][' + b_index + '][' + p_index + ']" id="proDiscount' + c_index + '_' + b_index + '_' + p_index + '" onkeypress="return validateFloatKeyPress(this,event);" value="">' +
                                '<input type="hidden" name="proDiscLmt[' + c_index + '][' + b_index + '][' + p_index + ']" id="proDiscLmt' + c_index + '_' + b_index + '_' + p_index + '"  value="' + product.transaction + '">' +
                                '<input type="hidden" name="proDiscountVal[' + c_index + '][' + b_index + '][' + p_index + ']" id="proDiscountVal' + c_index + '_' + b_index + '_' + p_index + '">' +
                                '<input type="hidden" name="proMRPTotal[' + c_index + '][' + b_index + '][' + p_index + ']" id="proMRPTotal' + c_index + '_' + b_index + '_' + p_index + '"  value="' + roundTo(product.total_mrp, 2) + '">' +
                                '</td>' +
                                '<td class="pp_ttl txt_rt" id="pro_total' + c_index + '_' + b_index + '_' + p_index + '"> ' + '₹' + currency_format(product.total_mrp, 2) + ' </td>' +
                                '</tr>';


                            if (c_index == 1) {
                                final_products += '<tr><td> ' + product.name + ' - ' + product.weight + ' ' + product.units + ' </td><td class="no_bgs"> ' + product.sale_qty + ' </td></tr>';
                                bags += parseFloat(product.sale_qty);
                                if (product.units == "MT") {
                                    in_tons = product.weight * 1000;
                                } else if (product.units == "kg") {
                                    in_tons = product.weight / 1000;
                                } else if (product.units == "gm") {
                                    in_tons = product.weight / 1000000;
                                } else {
                                    in_tons = product.weight;
                                }
                                feed_weight += parseFloat(in_tons * product.sale_qty);
                            }
                        });

                        cat_row += '</table></div></td></tr> '; //3q
                        category_sum += brand.sum_mrp;
                    });
                    cat_row += '</table></div></td></tr>'; //1
                    cat_row += '</table></div></td></tr></tbody>'; //2

                    sumrecord += '<ul ><li class="prd_typ"><span class="anl_sml_txt">' + category + '</span><span class="li_amnt_an cat_total' + c_index + '" id="cat_total' + c_index + '">  ₹0</span></li>' +
                        '<li class="discount_li"><span class="anl_sml_txt">Discount</span><span class="li_amnt_an catdiscount' + c_index + '" id="catdiscount' + c_index + '" >- ₹0</span></li>' +
                        '<li class="eql_tbl"> = </li><li><span class="anl_sml_txt">Total</span><span class="li_amnt_an blue_txt"> <b class="cattotamt' + c_index + '" id="cattotamt' + c_index + '">₹0</b> </span></li></ul>';

                    final_sale += '<div class="col-md-4 sale_details" id="sale_details' + c_index + '">' +
                        '<div class="analtic_blk">' +
                        '<p class="anl_sml_txt">' + category + ' Sale </p>' +
                        '<h1 class="anl_lrg_txt cattotamt' + c_index + '" id="saleamount' + c_index + '"> ₹0 </h1>' +
                        '<ul>' +
                        '<li>' +
                        '<span class="anl_sml_txt">Total Amount</span>' +
                        '<span class="li_amnt_an grandtotal_amount cat_total' + c_index + '" id="saletotal' + c_index + '"> ₹0 </span>' +
                        '</li>' +
                        '<li>' +
                        '<span class="anl_sml_txt">Total Discount</span>' +
                        '<span class="li_amnt_an granddiscount_amount catdiscount' + c_index + '" id="salediscount' + c_index + '"> ₹0 </span>' +
                        '</li>' +
                        '</ul>' +
                        '</div>' +
                        '</div>';
                }
                $('#summaryrecord').html(sumrecord);
            });
            feed_weight = parseFloat(feed_weight).toFixed(2);
            $('#saledataload').html(cat_row);
            $('#loanhide').after(final_sale);
            $('#feeddata').html(final_products);
            $('#tfeedbad').html(bags);
            $('#feedusage').html(feed_weight);
            $('#feed_wt').val(feed_weight);

            if (data.harvest > 0) {
                var hamt = parseFloat(data.harvest);
                $('#harvestamount').html(hamt.toFixed(2));
                $("#harvest_amount").val(hamt.toFixed(2));
                $('#harvesthide').show();

                var hwgt = parseFloat(data.tradetons).toFixed(2);
                $('#harvesttons').html(hwgt);
                $('#harvesttonsval').val(hwgt);
                $('#harvestweight').html(hwgt);
                $('#feedharvestsymbol').show();
                ratio = feedRatio(hwgt, feed_weight);
                $("#ratio_display").html(ratio);
                $("#fcr").val(ratio);
                get_sec = ratio.split(":");
                secVal = get_sec[1];
                if (secVal >= 1 && secVal < 1.3) {
                    $("#feed_status").html('Good');
                    $("#fcr_status").val('Good');
                } else if (secVal >= 1.3 && secVal <= 1.5) {
                    $("#feed_status").html('Average');
                    $("#fcr_status").val('Average');
                } else if (secVal > 1.5) {
                    $("#feed_status").html('Bad');
                    $("#fcr_status").val('Bad');
                }
                if (get_sec[0] > get_sec[1]) {
                    $(".ratio_icon").removeClass("lss_rto eql_rto").addClass("grt_rto");

                } else if (get_sec[0] < get_sec[1]) {
                    $(".ratio_icon").removeClass("grt_rto eql_rto").addClass("lss_rto");

                } else if (get_sec[0] == get_sec[1]) {
                    $(".ratio_icon").removeClass("lss_rto grt_rto").addClass("eql_rto");

                }
                //console.log(ratio);
            } else {
                $('#harvesthide').hide();
                $('#feedharvestsymbol').hide();
            }


            getGrandMRP();
            getGrandTotal();
            finalAmount();

        }
    });

    $.ajax({
        url: url + "api/users/getfinaldata",
        data: { userid: user_id, crop_id: crpid },
        type: 'POST',
        datatype: 'json',
        success: function(response112) {
            res121 = JSON.parse(response112);
            $('#harvesthide').show();

            $.each(res121, function(index, finalval) {
                /* *********** */
                if (finalval.transport > 0) {
                    $('#ftransport').html('₹' + currency_format(finalval.transport, 2));
                    $("#transport").val(finalval.transport);
                    $('#ftransporthide').show();
                } else {
                    $('#ftransporthide').hide();
                }

                if (finalval.loading > 0) {
                    $('#floading').html('₹' + currency_format(finalval.loading, 2));
                    $('#floadinghide').show();
                    $("#loading").val(finalval.loading);
                } else {
                    $('#floadinghide').hide();
                }

                if (finalval.lab > 0) {
                    $('#flabfee').html('₹' + currency_format(finalval.lab, 2));
                    $("#lab_fee").val(finalval.lab);
                    $('#flabhide').show();
                } else {
                    $('#flabhide').hide();
                }

                if (finalval.expenses > 0) {
                    $('#expenses').html('₹' + currency_format(finalval.expenses, 2));
                    $("#expenses_val").val(finalval.expenses);
                    $('#exphide').show();
                } else {
                    $('#exphide').hide();
                }

                if (finalval.receipt > 0) {
                    $('#freceipts').html('₹' + currency_format(finalval.receipt, 2));
                    $("#receipts").val(finalval.receipt);
                    $('#receipthide').show();
                } else {
                    $('#receipthide').hide();
                }

                if (finalval.returnamount > 0) {
                    $('#fretrun').html('₹' + currency_format(finalval.returnamount, 2));
                    $("#returns").val(finalval.returnamount);
                    $('#returnhide').show();
                } else {
                    $('#returnhide').hide();
                }
                $("#crop_location").html(finalval.crop_location);
                $("#crop_location_val").val(finalval.crop_location);
                $("#crop_type").html(finalval.crop_type);
                $("#harvest_type").val(finalval.crop_type);
                /*  */
            });
        }
    });
}

function update_activity_table(col, value, id) {
    $.ajax({
        url: url + 'api/Loans/update_single_field',
        type: "POST",
        data: { column: col, value: value, loan_id: id },
        dataType: "json",
        async: false,
        success: function(data) {}
    });
}

function feedRatio(num1, num2) {
    if (num1 > 1) {
        console.log('i');
        for (i = num1; i > 1; i--) {
            if ((num1 % i) == 0 && (num2 % i) == 0) {
                num1 = num1 / i;
                num2 = num2 / i;
            }
        }
    } else if (num1 > 0) {
        console.log('s');
        d = num1;
        if ((num1 % num1) == 0) {
            console.log('r');
            num1 = num1 / d;
            num2 = num2 / d;
            console.log(num1);
        }
    }
    return num1 + ":" + num2;
}

function form_validation(err, err_msg, tagid) {
    $('.mykey').parent().css("border", "");

    $("#snackbar").text(err_msg);
    $("#snackbar").addClass("show");

    setTimeout(function() { $("#snackbar").removeClass("show"); }, 3000);
    $(tagid).parent().css("border", "1px solid red");

    $(tagid).focus();
    return false;
}

//dev_php get discount from product listing under a brand
function TotalProductDiscount(cbid) {
    var final_discount = 0;
    $("[id^='proDiscountVal" + cbid + "']").each(function() {
        if ($(this).val() != "") {
            final_discount += parseFloat($(this).val());
        }
    });
    $("#discountvalue" + cbid).val(roundTo(final_discount, 2));
    total_amount = $("#brandtotal" + cbid).val();
    amount_after_disc = total_amount - final_discount;
    $("#brandtotamt" + cbid).html('₹' + currency_format(amount_after_disc, 2));
}
//dev_php total discount value
function getGrandDiscount() {
    var final_discount = 0;
    $("[id^='discountvalue']").each(function() {
        if ($(this).val() != "") {
            final_discount += parseFloat($(this).val());
        }
    });
    $(".granddiscount_amount").html('₹' + currency_format(final_discount, 2));
    $("#granddiscount_amountval").val(roundTo(final_discount, 2));
    getGrandTotal();

    //append discount row
    $('#discount_row').remove();
    discount_row = '<tr role="row" class="even" id="discount_row"><td class=" date">19-Sep-2020</td><td><a href="javascript:void(0);" title="">DISCOUNT</a></td><td class=" txt_rt out_td"><span class="grn_clr"><span class="arr_blk">₹' + final_discount + '<img src="' + url + '/assets/images/grn_c_ar.png"> </span></span></td></tr>';
    $('#usr_lst_tbl1 tr:last').after(discount_row);

    total_bal = $("#sum_total").val();
    total_trans_amount = parseFloat(total_bal) + final_discount;
    $("#sum_total").val(total_trans_amount);
    if (total_trans_amount > 0) {
        $("#in_td1").html('<span class="grn_clr">₹' + currency_format(total_trans_amount, 2) + '</span');
    } else {
        tta = Math.abs(total_trans_amount);
        $("#in_td1").html('<span class="txt_red">₹' + currency_format(tta, 2) + '</span>');
    }
}

//dev_php total mrp
function getGrandMRP() {
    var grandMRP = 0;
    $("[id^='brandtotal']").each(function() {
        if ($(this).val() != "") {
            grandMRP += parseFloat($(this).val());
        }

    });
    $(".grandtotal_amount").html('₹' + currency_format(grandMRP, 2));
    $("#grandtotal_amountval").val(roundTo(grandMRP, 2));
}

//dev_php total amount after discount
function getGrandTotal() {
    finalAmount();
    var GrandMRP = $("#grandtotal_amountval").val();
    var GrandDiscount = ($("#granddiscount_amountval").val()) ? $("#granddiscount_amountval").val() : 0;
    var GrandTotal = parseFloat(GrandMRP) - parseFloat(GrandDiscount);
    $(".grandfinalamount").html('₹' + currency_format(GrandTotal, 2));
}

//dev_php get final amount in step 2
function finalAmount() {
    $("[id^='cat_total']").each(function() {
        cid = $(this).attr("id");
        cid = cid.replace("cat_total", '');
        var c_MRP = 0;
        $("[id^='brandtotal" + cid + "']").each(function() {
            c_MRP += parseFloat($(this).val());
        });
        $(".cat_total" + cid).html("₹" + currency_format(c_MRP, 2));

        var c_discount = 0;
        $("[id^='discountvalue" + cid + "']").each(function() {
            if ($(this).val() != "")
                c_discount += parseFloat($(this).val());
        });
        $(".catdiscount" + cid).html("₹" + currency_format(c_discount, 2));

        c_final = parseFloat(c_MRP) - parseFloat(c_discount);
        $(".cattotamt" + cid).html("₹" + currency_format(c_final, 2))
    });
}
//dev_php reset product discount
function resetProductDiscounts(id) {
    $("[id^='proDiscount" + id + "']").each(function() {
        var pid = $(this).attr("id");
        pid = pid.replace("proDiscount" + id, '');
        $("#proDiscount" + id + pid).val('0');
        $("#proDiscountVal" + id + pid).val('0');
        $("#pro_total" + id + pid).html($("#proMRPTotal" + id + pid).val());
    });
}

/* function printDiv() {
    var divContents = document.getElementById("final_print").innerHTML;
    var a = window.open('', '', 'height=1200, width=1200');
    a.document.write('<html>');
    a.document.write('<body>');
    a.document.write(divContents);
    a.document.write('</body></html>');
    a.document.write('<link href="http://localhost/credit_new/assets/css/user_detials.css" rel="stylesheet" type="text/css" />');
    a.document.write('<link href="http://localhost/credit_new/assets/css/style.css" rel="stylesheet" type="text/css" />');
    a.document.write('<link href="http://localhost/credit_new/assets/css/bootstrap-4.4.1.min.css" rel="stylesheet" type="text/css" />');
    a.document.close();
    a.print();
} */

// for step one loans
function calculateTotal() {
    var totalamtvalue = 0;
    var totinterestvalue = 0;
    var totval = 0;

    $("[id^='iinterest']").each(function() {
        var id = $(this).attr('id');
        id = id.replace("iinterest", '');

        /*calculate day difference*/
        var start = $('#startdate' + id).val();
        var end = $('#enddate' + id).val();

        $.ajax({
            url: url + 'api/Users/getdayscount',
            type: "POST",
            data: { fromdate: start, todate: end },
            dataType: "json",
            async: false,
            success: function(data) {
                var daysval = data;
                $('#days' + id).val(daysval);
                $('#daydis' + id).html(daysval);
                /*calculate day difference*/

                var t = $("#iinterest" + id).val();
                var p = $('#tot' + id).val();
                //var days = daysval;
                /*  var r = $('#months' + id).val();

                 if (r == 0) {
                     r = 1;
                 } */
                var intrests = ((p * t) / 3000) * daysval;
                $("#intrestResult").val(intrests);
                $("#totalResult").val((+p) + intrests);

                $('#interestamt' + id).html('₹' + currency_format(intrests, 2));
                $('#interestamtval' + id).val(intrests);

                $('#totamt' + id).html('₹' + currency_format((+p) + intrests, 2));
                $('#totamtval' + id).val((+p) + intrests);
                var tf = (+p) + intrests;
                var ttt = (+p);

                totalamtvalue += tf;
                totinterestvalue += intrests;
                totval += ttt;

            }
        });
    });

    $('#finalamount').html('₹' + currency_format(totalamtvalue, 2));
    $('#totalamount').html('₹' + currency_format(totval, 2));
    $('#totalinterest').html('₹' + currency_format(totinterestvalue, 2));

    $('#totalamountval').val(totval);
    $('#totalinterestval').val(totinterestvalue);


    $('#floanamount').html('₹' + currency_format(totalamtvalue, 2));
    $("#total_loan_amount").val(totalamtvalue);
    $('#tloanamount').html('₹' + currency_format(totval, 2));
    $("#loan_amount").val(totval);
    $('#tinterestamount').html('₹' + currency_format(totinterestvalue, 2));
    $("#loan_interest").val(totinterestvalue);

    //append intrest row
    $('#interest_row').remove();
    interest_row = '<tr role="row" class="odd" id="interest_row"><td class=" date">19-Sep-2020</td><td><a href="javascript:void(0);" title="">INTEREST</a></td><td class=" txt_rt out_td"><span class="txt_red"><span class="arr_blk">₹' + totinterestvalue + '<img src="' + url + 'assets/images/rd_c_ar.png"> </span></span></td></tr>';
    $('#usr_lst_tbl1 tr:last').after(interest_row);

    total_bal = $("#sum_total").val();
    total_trans_amount = parseFloat(total_bal) - totinterestvalue;
    $("#sum_total").val(total_trans_amount);
    if (total_trans_amount > 0) {
        $("#in_td1").html('<span class="grn_clr">₹' + currency_format(total_trans_amount, 2) + '</span');
    } else {
        tta = Math.abs(total_trans_amount);
        $("#in_td1").html('<span class="txt_red">₹' + currency_format(tta, 2) + '</span>');
    }
}


$(document).ready(function() {
    $('#saleOrder').hide();
    $('#confirmOrder').show();
    $('#finalOrder').hide();
    hidcrop = ""
    var tables = "";
    //get crops data
    $.ajax({
        url: url + "api/UserCrops/index/" + user_id,
        data: {},
        type: 'POST',
        datatype: 'json',
        success: function(response) {
            res = JSON.parse(response);
            // var user_id = $('#selectuser_id'+aeval).val();
            if (res.data.length > 1) { $("#crop_trns").show(); } else { $("#crop_trns").hide(); }
            var sel = "";
            if (user_id != "") {
                var opt = '<div class="form-check"><input class="form-check-input" type="radio" name="crop_opt" id="crp" /><label class="form-check-label" for="crp"></label></div>';;
                $("#crop_count").html("All crops(" + res.data.length + ")");
                if (res.data.length > 0) {
                    opt = '';
                    $.each(res.data, function(index, crop) {
                        if ($("#crop_id").val() == "") {
                            $("#crop_id").val(crop.cd_id);
                            $(".cropValue").text(crop.crop_location);
                            sel = "checked";
                        } else {
                            sel = "";
                        }
                        opt += '<div class="form-check"><input class="form-check-input" type="radio" name="crop_opt" id="crp' + index + '" value="' + crop.cd_id + '" ' + sel + ' required /><label class="form-check-label" for="crp' + index + '">' + crop.crop_location + '</label></div>';
                    });
                }
            } else {
                var opt = '';
            }
            $("#crop_opt_li").html(opt);
            load_unsettled();
            final_unsettled();
            load_analytics();
            //summary_settled();
        }
    });

    $(document).on("change", ".check_list input[name='crop_opt']", function() {
        var id = $('input[name=crop_opt]:checked').val();
        $("#crop_id").val(id);
        $(".swith_blk").removeClass('tog_yes');
        $('.usr_lst_tbl').DataTable().destroy();
        load_unsettled();
        load_analytics();
    });

    $(document).on("click", "#print_transaction", function() {
        console.log('print');
        user_id = user_id;
        crop_id = $("#crop_id").val();
        settled = $(".act_tab").attr("id");

        console.log('user_id' + user_id);
        console.log('crop' + crop_id);
        console.log('settled' + settled);
        //window.location.href = "<?php echo base_url('api/users/printTrans');?>/" + user_id + "/" + crop_id + "/0";
        window.location.href = url + "/api/users/printTrans/" + user_id + "/" + crop_id + "/0";
    });

    $('.swith_blk').click(function() {
        tables = $('#usr_lst_tbl').DataTable();
        $(".expand_details").each(function() {
            var tr = $(this).closest('tr');
            var row = tables.row(tr);
            row.child.hide();
            tr.removeClass('shown');
        });
        if ($(this).hasClass('tog_yes')) {
            $(this).removeClass('tog_yes');
        } else {
            $(this).addClass('tog_yes');
            $(".expand_details").trigger("click");
        }
    });

    //$(".loan_btm div.toolbar").html('<b>SSS</b>');
    $('.loan_btm a.toggle-vis').on('click', function(e) {
        $(this).parent().toggleClass('act');
        e.preventDefault();
        var column = tables.column($(this).attr('data-column'));
        column.visible(!column.visible());
    });

    $('.dataTables_paginate').html('<a href="#" title=""> Show More </a>');
    $('.ad_nt').click(function() {
        $('.pp_note').toggleClass('show_blk');
    });

    $('.crop_top').click(function() {
        $('.alpha_blk').show();
        $('.side_popup').addClass('opn_slide');
        $('#loans_tp').hide();
        $('#orders_tp').hide();
        $('#crop_top').show();
    });

    $('.alpha_blk').click(function() {
        $('.side_popup').removeClass('opn_slide');
        $(this).hide();
    });

    $('.sec_step').click(function() {
        $(this).addClass('act_tb').removeClass('dne_tb');
        $('.fst_step').removeClass('act_tb').addClass('dne_tb');
        $('.thrd_step, .fth_step, .fst_step').removeClass('act_tb dne_tb');
        $('.bdr_blue').css('width', '75px');
        $('.loans_tb').hide();
        $('.sale_tb').show();
        $('.billing_tb').hide();
        $('#saleOrder').show();
        $('#confirmOrder').hide();
        $('#finalOrder').hide();

    });

    $('.fst_step').click(function() {
        $(this).addClass('act_tb').removeClass('dne_tb');
        $('.confrm_blk').show();
        $('.sec_step, .fth_step, .thrd_step').removeClass('act_tb dne_tb');
        $('.thrd_step').removeClass('act_tb dne_tb');
        $('.bdr_blue').removeAttr('style');
        $('.loans_tb').show();
        $('.sale_tb').hide();
        $('.billing_tb').hide();
        $('#saleOrder').hide();
        $('#confirmOrder').show();
        $('#finalOrder').hide();
    });

    $('.thrd_step').click(function() {
        $('.confrm_blk').hide();
        $(this).addClass('act_tb').removeClass('dne_tb');
        $('.fst_step, .fth_step').removeClass('act_tb').addClass('dne_tb');
        $('.sec_step').removeClass('act_tb').addClass('dne_tb');
        $('.bdr_blue').css('width', '150px');
        $('.loans_tb').hide();
        $('.sale_tb').hide();
        $('.billing_tb').show();
        $('#saleOrder').hide();
        $('#confirmOrder').hide();
        $('#finalOrder').show();
    });

    $('.lnk_typ').click(function() {
        $(this).parent('.assign_type').find('.lnk_typ').removeClass('act_type');
        $(this).addClass('act_type');
        var this_id = $(this).attr("id");
        $('#skey').val('');
        $('#selectuser_id').val('');
        $('#select_usercode').val('');
        $('#select_usertype').val('');
        //$(".guest_block").hide();
        $("#bank_block").hide();
        $("#cash_block").hide();
        $("#user_block").hide();
        $("#crop_block").hide();
        $('#src_user').hide();
        $('input[name="user_crop"]').prop('checked', false);
        $('.cval').html('Select Crop');
        if (this_id == 'ban_trns') {
            $("input[name='act_types']:checked").val('bank');
            $("#bank_block").show();
            $("#user_block").show();
        } else {

            if (this_id == 'crop_trns' || this_id == 'user_trns') {
                var chk_val = this_id.split('_');
                if (chk_val[0] == 'user') {
                    $('#src_user').show();
                    $("#user_crop_li").html('');
                } else { getusercrops(user_id); }
                $("input[name='act_types']:checked").val(chk_val[0]);
                $("#crop_block").show();

            } else if (this_id == 'cash_trns') {
                $("input[name='act_types']:checked").val('cash');
                $("#cash_block").show();
            }
        }
    });

    $("#admin_bank_li, #admin_cash_li").on("change", function() {
        bankBalCheck();
        setTimeout(function() {
            if ($("#hid_chkbal").val() == 1) {
                new PNotify({
                    title: 'Error',
                    text: "Insufficient Balance, please select another admin bank!",
                    type: 'failure',
                    shadow: true,
                    delay: 3000,
                    stack: { "dir1": "down", "dir2": "right", "push": "top" }
                });
                return false;
            }

        }, 500);


    });

    $('#drawal_amt_commas').keyup(function() {
        bankBalCheck();
        setTimeout(function() {

            if ($("#hid_chkbal").val() == 1) {
                new PNotify({
                    title: 'Error',
                    text: "Insufficient Balance, please select another admin bank!",
                    type: 'failure',
                    shadow: true,
                    delay: 3000,
                    stack: { "dir1": "down", "dir2": "right", "push": "top" }
                });
                return false;
            }

        }, 500);
    });

    /*form submit*/
    $("#confirmOrder").on("click", function() {

        var rcount = $('#rowcount').val();

        var i;
        for (i = 0; i <= rcount; i++) {

            var interests = $('#iinterest' + i).val();

            if (interests == 0 || interests == '') {
                err = 1;
                err_msg = "Please select sale type!";
                tagid = "#iinterest" + i;
                return form_validation(err, err_msg, tagid);
            }
        }
        var lstp = $('#salestepshow').val();
        if (lstp == 1) {
            $(".sec_step").trigger("click");
        } else {
            $(".thrd_step").trigger("click");
        }

        /* formData = new FormData(loanfrm);
        $.ajax({
            url: url + "api/users/loandataupdate",
            data: formData,
            type: 'POST',
            contentType: false,
            processData: false,
            enctype: 'multipart/form-data',
            datatype: 'json',
            success: function(response) {
                res = JSON.parse(response);
                
            }
        }); */
    });

    $("#saleOrder").on("click", function() {
        formData = new FormData(salefrm);
        formData.append("user_id", user_id);
        formData.append("crop_id", $('#crop_id').val());
        $.ajax({
            url: url + "api/users/saledataupdate",
            data: formData,
            type: 'POST',
            contentType: false,
            processData: false,
            enctype: 'multipart/form-data',
            datatype: 'json',
            success: function(response) {
                res = JSON.parse(response);
                $(".thrd_step").trigger("click");
            }
        });
    });

    $("#finalOrder").on("click", function() {
        var gval = $('#grand_totalval').val();
        var interestval = $('#totalinterestval').val();
        var crop_id = $("#crop_id").val();
        var gdiscount = $('#granddiscount_amountval').val();
        var loanstep = $('#loanstepshow').val();
        var salestep = $('#salestepshow').val();

        $.ajax({
            url: url + "api/users/updatefinaldata",
            //data: { userid: user_id, crop_id: crpid, gval: gval, interestval: interestval, gdiscount: gdiscount, loanstep: loanstep, salestep: salestep },
            data: $('#loanfrm, #salefrm, #final_frm').serialize() + "&loanstep=" + loanstep + "&salestep=" + salestep + "&gdiscount=" + gdiscount + "&interestval=" + interestval + "&crop_id=" + crop_id + "&user_id=" + user_id + "&gval=" + gval,
            type: 'POST',
            datatype: 'json',
            success: function(response1) {
                settled_id = response1;
                window.location.href = url + "/api/users/settled_pdf/" + settled_id;
                location.reload();
            }
        });


    });
    $(document).on('blur', "[id^=iinterest]", function() {
        id = $(this).attr("id").replace("iinterest", '');
        //update_activity_table('rate_of_interest', $(this).val(), id);
        calculateTotal();
    });
    $(document).on('change', "[id^=startdate]", function() {
        calculateTotal();
    });
    $(document).on('change', "[id^=enddate]", function() {
        calculateTotal();
    });

    //dev_php brand discount apply
    $(document).on('blur', "[id^=branddiscountval]", function() {
        //validate discount and clear product discounts if not empty
        id = $(this).attr("id");
        id = id.replace("branddiscountval", '');
        var disc_limit = $('#discount_limit' + id).val();
        var discount = $(this).val();
        resetProductDiscounts(id); // clear listed products discount
        if (parseFloat(disc_limit) < parseFloat(discount)) {
            $(this).val('0');
            new PNotify({
                title: 'Discount Limit',
                text: "Brand discount limit is " + disc_limit + "%",
                type: 'success',
                shadow: true,
                delay: 3000,
                stack: { "dir1": "down", "dir2": "right", "push": "top" }
            });
        } else {
            //calculate discount of particular brand
            total_amount = $("#brandtotal" + id).val();
            discount_value = (total_amount * discount) / 100;
            $("#discountvalue" + id).val(discount_value);
            amount_after_disc = total_amount - discount_value;
            $("#brandtotamt" + id).html('₹' + currency_format(amount_after_disc, 2));
        }
        //calculateTotalsale();
        getGrandDiscount();
    });

    //product discount apply
    $(document).on('blur', "[id^=proDiscount]", function() {
        product_discount = $(this).val();
        if (product_discount != "") {
            var id = $(this).attr('id');
            arr = id.split("_");
            pid = arr[2];
            bid = arr[1];
            cid = arr[0].replace("proDiscount", '');
            $("#branddiscountval" + cid + "_" + bid).val('0'); //clear brand discount
            pro_disc_limit = $("#proDiscLmt" + cid + "_" + bid + "_" + pid).val();
            if (parseFloat(product_discount) > parseFloat(pro_disc_limit)) {
                //clear product discount
                $(this).val('0');
                new PNotify({
                    title: 'Discount Limit',
                    text: "Product discount limit is " + pro_disc_limit + "%",
                    type: 'success',
                    shadow: true,
                    delay: 3000,
                    stack: { "dir1": "down", "dir2": "right", "push": "top" }
                });
            } else {
                total_amount = $("#proMRPTotal" + cid + "_" + bid + "_" + pid).val();
                discount_value = (total_amount * product_discount) / 100;
                $("#proDiscountVal" + cid + "_" + bid + "_" + pid).val(discount_value);
                amount_after_disc = total_amount - discount_value;
                $("#pro_total" + cid + "_" + bid + "_" + pid).html('₹' + currency_format(amount_after_disc, 2));
                TotalProductDiscount(cid + "_" + bid);
            }
        }
        getGrandDiscount();

    });

    /* date filters */
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
            'Last 6 Months': [moment().subtract(6, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
            "Last Year": [moment().subtract(1, "y").startOf("year"), moment().subtract(1, "y").endOf("year")]
        }
    }, cb);

    $(document).on('click', '.ranges ul li', function() {
        $(this).parent().children().removeClass('active');
        $(this).addClass('active');
        $('.drp-selected').css('font-weight', 'bold');
        if ($(this).text() == "Till Date") {
            $("#date_val").val('Till Date');
        }

        if ($(this).text() != "Date Range") {
            $('#usr_lst_tbl').DataTable().destroy();
            load_unsettled();
        }
    });

    $(document).on('click', '.applyBtn', function() {
        $('#usr_lst_tbl').DataTable().destroy();
        load_unsettled();
    });
    /* date filters */

    $(document).on('click', '.comp_cl', function() {
        $(this).addClass('act_tab');
        $('.tabs_tbl').addClass('cmp_ul');
        $('.drft_cl').removeClass('act_tab');
        $('#usr_lst_tbl').DataTable().destroy();
        load_settled();
    });

    $(document).on('click', '.drft_cl', function() {
        $(this).addClass('act_tab');
        $('.tabs_tbl').removeClass('cmp_ul');
        $('.comp_cl').removeClass('act_tab');
        $('#usr_lst_tbl').DataTable().destroy();
        load_unsettled();
    });
});

/* date  filters */
function cb(start, end) {
    $('#date_val').val(start.format('D/MMM/YYYY') + ' - ' + end.format('D/MMM/YYYY'));
    if ($('#date_val').val() == "Invalid date - Invalid date") {
        $('#date_val').val('');
    } else {
        $('#date_val').val(start.format('D/MMM/YYYY') + ' - ' + end.format('D/MMM/YYYY'));
    }
}

function load_unsettled() {
    $("#table_footer").show();
    //$(".usr_lst_tbl").empty();
    var h = $(window).height();
    var min_h = h - 315;
    $("#unsettled_header").show();
    $("#settled_header").hide();
    tables = $('#usr_lst_tbl').DataTable({
        'ordering': false,
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        "lengthChange": false,
        "columns": [
            { className: "date", "width": "20%" },
            { className: "" },
            { className: "txt_rt out_td", "width": "40%" } //grn_clr txt_red out_td
        ],

        language: {
            searchPlaceholder: "Search Transaction Details",
            search: "",
            "dom": '<"toolbar">frtip',
        },
        "scrollY": min_h,
        "scrollCollapse": true,
        'ajax': {
            'url': url + 'api/users/unsettled_trans',
            'data': function(data) {
                data.user_id = user_id;
                data.crop_id = $("#crop_id").val();
                data.settled = $(".act_tab").attr("id");
                var reportrange = $('#date_val').val();
                data.reportrange = reportrange;
            },
            "dataSrc": function(json) {
                //alert(json.total_record);
                if (json.total_record > 0) {
                    $('#setacnt').prop('disabled', false);
                } else {
                    $('#setacnt').prop('disabled', true);
                }

                total_trans_amount = json.total_trans_amount;
                if (total_trans_amount > 0) {
                    $("#in_td").html('<span class="grn_clr">₹' + currency_format(total_trans_amount, 2) + '</span');
                } else {
                    tta = Math.abs(total_trans_amount);
                    $("#in_td").html('<span class="txt_red">₹' + currency_format(tta, 2) + '</span>');
                }
                json.open_balance = 0; // need to work for open balance
                grand_total = parseFloat(total_trans_amount) + parseFloat(json.open_balance);
                if (grand_total > 0) {
                    $("#grd_ttl").html("Payable Amount");
                    $("#grand_total").html('<span class="grn_clr">₹' + currency_format(grand_total, 2) + '</span>');
                } else {
                    $("#grd_ttl").html("Receivable  Amount");
                    gtotal = Math.abs(grand_total);
                    $("#grand_total").html('<span class="txt_red">₹' + currency_format(gtotal, 2) + '</span>');
                }

                $("#open_bal").html('₹' + currency_format(json.open_balance, 2));
                $('#grand_totalval').val(grand_total);
                $("#hid_gtot").val(grand_total);
                $(".bal_draw").html('₹' + currency_format($("#hid_gtot").val(), 2));

                var sign = Math.sign($("#hid_gtot").val());
                if (sign == 1) {
                    $('.gtot_withdrawal').show();
                }
                return json.data;
            }
        }
    });



    $('#usr_lst_tbl_wrapper .dataTables_scrollBody').css('height', min_h);
    $('#usr_lst_tbl_wrapper .dataTables_length').html('');
    $('#usr_lst_tbl_wrapper .dataTables_scrollBody').mCustomScrollbar("destroy");
    $('#usr_lst_tbl_wrapper .dataTables_scrollBody').mCustomScrollbar({
        theme: "minimal",
        mouseWheelPixels: 35,
        scrollInertia: 250,
    });
    $('#usr_lst_tbl tbody').on('click', '.expand_details', function() {
        var tr = $(this).closest('tr');
        var row = tables.row(tr);

        if (row.child.isShown()) {
            row.child.hide();
            tr.removeClass('shown');
        } else {
            $content = format(row.data())
            if ($content != '') {
                row.child($content, 'user_dtl_tr').show();
                tr.addClass('shown');
            }
        }
    });
}

function final_unsettled() {
    var tables_pop = $('#usr_lst_tbl1').DataTable({
        'ordering': false,
        'processing': true,
        'serverSide': true,
        "searching": false,
        "lengthChange": false,
        'serverMethod': 'post',
        "columns": [
            { title: "Date", className: "date", "width": "20%" },
            { title: "Detail", className: "" },
            { title: "Amount", className: "txt_rt out_td", "width": "40%" } //grn_clr txt_red out_td
        ],
        'ajax': {
            'url': url + 'api/users/unsettled_trans',
            'data': function(data) {
                data.user_id = user_id;
                data.crop_id = $("#crop_id").val();
                data.settled = $(".act_tab").attr("id");
            },
            "dataSrc": function(json) {
                //alert(json.total_record);
                if (json.total_record > 0) {
                    $('#setacnt').prop('disabled', false);
                } else {
                    $('#setacnt').prop('disabled', true);
                }

                total_trans_amount = json.total_trans_amount;
                $("#sum_total").val(total_trans_amount);
                if (total_trans_amount > 0) {
                    $("#in_td1").html('<span class="grn_clr">₹' + currency_format(total_trans_amount, 2) + '</span');
                } else {
                    tta = Math.abs(total_trans_amount);
                    $("#in_td1").html('<span class="txt_red">₹' + currency_format(tta, 2) + '</span>');
                }
                json.open_balance = 0; // need to work for open balance
                grand_total = parseFloat(total_trans_amount) + parseFloat(json.open_balance);
                if (grand_total > 0) {
                    $("#grd_ttl1").html("Payable Amount");
                    $("#grand_total1").html('<span class="grn_clr">₹' + currency_format(grand_total, 2) + '</span>');
                } else {
                    $("#grd_ttl1").html("Receivable  Amount");
                    gtotal = Math.abs(grand_total);
                    $("#grand_total1").html('<span class="txt_red">₹' + currency_format(gtotal, 2) + '</span>');
                }

                $("#open_bal1").html('₹' + currency_format(json.open_balance, 2));
                $('#grand_totalval').val(grand_total);
                $("#hid_gtot").val(grand_total);
                $(".bal_draw").html('₹' + currency_format($("#hid_gtot").val(), 2));

                return json.data;
            }
        }
    });
}

/* function summary_settled() {
    $("#table_footer").show();
    $("#usr_lst_tbl1").empty();
    var h = $(window).height();
    var min_h = h - 315;
    var tables = $('#usr_lst_tbl1').DataTable({
        'ordering': false,
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        "columns": [
            { title: "Date", className: "date", "width": "20%" },
            { title: "Detail", className: "", "width": "20%" },
            { title: "Amount", className: "txt_rt out_td", "width": "60%" } //grn_clr txt_red out_td
        ],

        language: {
            searchPlaceholder: "Search Transaction Details",
            search: "",
            "dom": '<"toolbar">frtip',
        },
        "scrollY": min_h,
        "scrollCollapse": true,
        'ajax': {
            'url': url + 'api/users/unsettled_trans',
            'data': function(data) {
                data.user_id = user_id;
                data.crop_id = $("#crop_id").val();
                data.settled = $(".act_tab").attr("id");
            },
            "dataSrc": function(json) {
                total_trans_amount = json.total_trans_amount;
                grand_total = parseFloat(total_trans_amount) + parseFloat(json.open_balance);
                $("#in_td").html('₹' + currency_format(total_trans_amount, 2));
                $("#open_bal").html('₹' + currency_format(json.open_balance, 2));
                $("#grand_total").html('₹' + currency_format(grand_total, 2));
                return json.data;
            }
        }
    });

    $('.dataTables_scrollBody').css('height', min_h);
    $('#usr_lst_tbl_wrapper .dataTables_length').html('<ul class="tabs_tbl"><li class="act_tab drft_cl" id="status_0"> <span>Unsettled</span> </li><li class="comp_cl" id="status_1"> <span>Settled </span> </li></ul> <span class="tbl_btn">  </span>');
    $('.dataTables_scrollBody').mCustomScrollbar("destroy");
    $('.dataTables_scrollBody').mCustomScrollbar({
        theme: "minimal",
        mouseWheelPixels: 35,
        scrollInertia: 250,
    });
    $('#usr_lst_tbl1 tbody').on('click', '.expand_details', function() {
        var tr = $(this).closest('tr');
        var row = tables.row(tr);

        if (row.child.isShown()) {
            row.child.hide();
            tr.removeClass('shown');
        } else {
            $content = format(row.data())
            if ($content != '') {
                row.child($content, 'user_dtl_tr').show();
                tr.addClass('shown');
            }
        }
    });
} */

function load_settled() {
    $("#table_footer").hide();
    //$("#usr_lst_tbl").empty();
    var h = $(window).height();
    var min_h = h - 230;
    $("#unsettled_header").hide();
    $("#settled_header").show();
    return false;
    var tables = $('#usr_lst_tbl').DataTable({
        'ordering': false,
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        "lengthChange": false,
        "columns": [
            { className: "pl_m", "width": "50px" },
            { className: "date", "width": "100px" },
            { className: "", "width": "" },
            { className: "txt_rt out_td", "width": "" },
            { className: "txt_rt down_blk", "width": "" },
        ],

        language: {
            searchPlaceholder: "Search Transaction Details",
            search: "",
            "dom": '<"toolbar">frtip',
        },
        "scrollY": min_h,
        "scrollCollapse": true,
        'ajax': {
            'url': url + 'api/users/settled_trans',
            'data': function(data) {
                data.user_id = user_id;
                data.crop_id = $("#crop_id").val();
                data.settled = $(".act_tab").attr("id");;
            },
            "dataSrc": function(json) {
                return json.data;
            }
        }
    });
    $('#usr_lst_tbl_wrapper .dataTables_scrollBody').css('height', min_h);
    $('#usr_lst_tbl_wrapper .dataTables_length').html('');
    $('#usr_lst_tbl_wrapper .dataTables_scrollBody').mCustomScrollbar("destroy");
    $('#usr_lst_tbl_wrapper .dataTables_scrollBody').mCustomScrollbar({
        theme: "minimal",
        mouseWheelPixels: 35,
        scrollInertia: 250,
    });
    $('#usr_lst_tbl tbody').on('click', '.expand_details', function() {
        console.log('expand on click');
        var tr = $(this).closest('tr');
        var row = tables.row(tr);

        $.ajax({
            url: url + 'api/users/getSettledDetails/' + row.data()[5],
            type: "GET",
            dataType: "json",
            async: false,
            success: function(result) {
                if (row.child.isShown()) {
                    tr.removeClass('details');
                    row.child.hide();
                    $("#hide_details").hide();
                    $("#show_details").show();
                } else {
                    tr.addClass('details');
                    row.child(result, 'trans_detail_tr').show();
                    $("#hide_details").show();
                    $("#show_details").hide();
                }

            },
            error: function(error) {
                console.log("Error:");
                console.log(error);
            }
        });
        /*  if ( row.child.isShown() ) {
             // This row is already open - close it
             row.child.hide();
             tr.removeClass('shown');
         }
         else {
             //console.log(row.data());
             row.child( load_records(row.data()) ).show();
             tr.addClass('shown');
         } */
    });

}

function load_analytics() {
    $.ajax({
        url: url + 'admin/Users/getAnalytics',
        type: "POST",
        data: {
            user_id: user_id,
            crop_id: $("#crop_id").val()
        },
        dataType: "json",
        async: false,
        success: function(data) {
            data.cropLoan = (data.cropLoan) ? data.cropLoan : 0;
            data.cropOrders = (data.cropOrders) ? data.cropOrders : 0;
            data.cropHarvest = (data.cropHarvest) ? data.cropHarvest : 0;
            data.cropAcres = (data.cropAcres) ? data.cropAcres : 0;
            $("#cropLoan").text('₹' + currency_format(data.cropLoan, 2));
            $("#cropOrder").text('₹' + currency_format(data.cropOrders, 2));
            $("#cropHarvest").text('₹' + currency_format(data.cropHarvest, 2));
            $("#cropAcre").text(data.cropAcres);
            //console.log(data.cropLoan);
        },
        error: function(error) {
            console.log("Error:");
            console.log(error);
        }
    });

}

function format(d) {
    var details = "";
    if (d[3] == "LOAN") {
        $.ajax({
            url: url + 'api/loans/getLoanTypeByLoan/' + d[5],
            type: "POST",
            dataType: "json",
            async: false,
            success: function(data) {
                details = '<tr class="detal_row">' +
                    '<td class="date"> &nbsp; </td>' +
                    '<td colspan="2">' +
                    '<table>' +
                    '<tr>' +
                    '<th> Crop Location </th>' +
                    '<th> Loan Type </th>' +
                    '<th> Loan Amount </th>' +
                    '<th>  </th>' +
                    '<th>  </th>' +
                    '</tr>' +
                    '<tr>' +
                    '<td> ' + data.crop_location + '  </td>' +
                    '<td> ' + data.loan_type + ' </td>' +
                    '<td> ' + '₹' + currency_format(data.loan_amt, 3) + ' </td>' +
                    '<td>  </td>' +
                    '<td>  </td>' +
                    '</tr>' +
                    '</table>' +
                    '</td>' +
                    '<td class="hide_blk"> </td>' +
                    '<td class="hide_blk"> </td>' +
                    '<td class="hide_blk"> </td>' +
                    '</tr>';
                return details;
            },
            error: function(error) {
                console.log("Error:");
                console.log(error);
            }
        });
    } else if (d[3] == "RECEIPT") {
        details = '<tr class="detal_row">' +
            '<td class="date"> &nbsp; </td>' +
            '<td colspan="2">' +
            '<table>' +
            '<tr>' +
            '<th> Transfer Type </th>' +
            '<th> Amount </th>' +
            '<th>  </th>' +
            '<th>  </th>' +
            '</tr>' +
            '<tr>' +
            '<td> ' + d[4] + ' transfer </td>' +
            '<td> ' + '₹' + currency_format(d[6], 3) + ' </td>' +
            '<td>  </td>' +
            '<td>  </td>' +
            '</tr>' +
            '</table>' +
            '</td>' +
            '<td class="hide_blk"> </td>' +
            '<td class="hide_blk"> </td>' +
            '<td class="hide_blk"> </td>' +
            '</tr>';
    } else if (d[4] == "GOODS") {
        $.ajax({
            url: url + 'api/sales/getSaleItemDetails/' + d[5],
            type: "POST",
            dataType: "json",
            async: false,
            success: function(data) {
                //var obj = jQuery.parseJSON(data);
                details = '<tr class="detal_row">' +
                    '<td class="date"> &nbsp; </td>' +
                    '<td colspan="2">' +
                    '<table>' +
                    '<tr>' +
                    '<th> Product Name </th>' +
                    '<th> Qty </th>' +
                    '<th> MRP </th>' +
                    '<th> Discount </th>' +
                    '<th> Total Price </th>' +
                    '</tr>';
                $.each(data.data, function(key, value) {
                    details += '<tr>' +
                        '<td> ' + value.pname + '  </td>' +
                        '<td> ' + value.quantity + ' </td>' +
                        '<td> ' + '₹' + currency_format(value.mrp, 3) + ' </td>' +
                        '<td> ' + value.discount + ' </td>' +
                        '<td> ' + '₹' + currency_format(value.total_price, 3) + ' </td>' +
                        '</tr>';
                });


                details += '</table>' +
                    '</td>' +
                    '<td class="hide_blk"> </td>' +
                    '<td class="hide_blk"> </td>' +
                    '<td class="hide_blk"> </td>' +
                    '</tr>';
                return details;
            },
            error: function(error) {
                console.log("Error:");
                console.log(error);
            }
        });

    } else if (d[4] == "HARVEST") {
        $.ajax({
            url: url + 'api/Trades/tradeactualdetails/' + d[5],
            type: "GET",
            dataType: "json",
            async: false,
            success: function(data) {
                //console.log(data);
                //var obj = jQuery.parseJSON(data);
                details = '<tr class="detal_row">' +
                    '<td class="date"> &nbsp; </td>' +
                    '<td colspan="2">' +
                    '<table>' +
                    '<tr>' +
                    '<th> Date </th>' +
                    '<th> Count </th>' +
                    '<th> Price </th>' +
                    '<th> Weight </th>' +
                    '<th> Total Price </th>' +
                    '</tr>';
                $.each(data.data, function(key, value) {
                    details += '<tr>' +
                        '<td> ' + value.trade_date + '  </td>' +
                        '<td> ' + value.count + ' </td>' +
                        '<td> ' + '₹' + currency_format(value.farmer_price, 3) + ' </td>' +
                        '<td> ' + value.farmer_weight + ' </td>' +
                        '<td> ' + '₹' + currency_format(value.farmer_amount, 3) + ' </td>' +
                        '</tr>';
                });


                details += '</table>' +
                    '</td>' +
                    '<td class="hide_blk"> </td>' +
                    '<td class="hide_blk"> </td>' +
                    '<td class="hide_blk"> </td>' +
                    '</tr>';
                return details;
            },
            error: function(error) {
                console.log("Error:");
                console.log(error);
            }
        });
    } else if (d[4] == "BANK TRANSFER") {
        $.ajax({
            url: url + 'api/users/getWithdrawalDetails/' + d[5],
            type: "POST",
            dataType: "json",
            async: false,
            success: function(res) {
                //var obj = jQuery.parseJSON(res);
                details = '<tr class="detal_row">' +
                    '<td class="date"> &nbsp; </td>' +
                    '<td colspan="2">' +
                    '<table>' +
                    '<tr>' +
                    '<th> Account No. </th>' +
                    '<th> Bank Name </th>' +
                    '<th> Amount </th>' +
                    '</tr>';
                $.each(res.data, function(key, value) {
                    details += '<tr>' +
                        '<td> ' + value.account_no + '  </td>' +
                        '<td> ' + value.bank_name + ' </td>' +
                        '<td> ' + '₹' + currency_format(value.withdrawal_amount, 3) + ' </td>' +
                        '</tr>';
                });


                details += '</table>' +
                    '</td>' +
                    '<td class="hide_blk"> </td>' +
                    '<td class="hide_blk"> </td>' +
                    '<td class="hide_blk"> </td>' +
                    '</tr>';
                return details;
            },
            error: function(error) {
                console.log("Error:");
                console.log(error);
            }
        });

    } else if (d[4] == "CROP TRANSFER") {
        $.ajax({
            url: url + 'api/users/getWithdrawalDetails/' + d[5],
            type: "POST",
            dataType: "json",
            async: false,
            success: function(res) {
                //var obj = jQuery.parseJSON(res);
                details = '<tr class="detal_row">' +
                    '<td class="date"> &nbsp; </td>' +
                    '<td colspan="2">' +
                    '<table>' +
                    '<tr>' +
                    '<th> From Crop</th>' +
                    '<th> To Crop </th>' +
                    '<th> Amount </th>' +
                    '</tr>';
                $.each(res.data, function(key, value) {
                    details += '<tr>' +
                        '<td> ' + value.src_crop + '  </td>' +
                        '<td> ' + value.dst_crop + '  </td>' +
                        '<td> ' + '₹' + currency_format(value.withdrawal_amount, 3) + ' </td>' +
                        '</tr>';
                });


                details += '</table>' +
                    '</td>' +
                    '<td class="hide_blk"> </td>' +
                    '<td class="hide_blk"> </td>' +
                    '<td class="hide_blk"> </td>' +
                    '</tr>';
                return details;
            },
            error: function(error) {
                console.log("Error:");
                console.log(error);
            }
        });

    } else if (d[4] == "USER TRANSFER") {
        $.ajax({
            url: url + 'api/users/getWithdrawalDetails/' + d[5],
            type: "POST",
            dataType: "json",
            async: false,
            success: function(res) {
                //var obj = jQuery.parseJSON(res);
                var user_or_crop = "";
                var src_crop = dst_crop = "NA"
                details = '<tr class="detal_row">' +
                    '<td class="date"> &nbsp; </td>' +
                    '<td colspan="2">' +
                    '<table>' +
                    '<tr>' +
                    '<th> From User/Crop Name </th>' +
                    '<th> To User/Crop Name</th>' +
                    '<th> Amount </th>' +
                    '</tr>';
                $.each(res.data, function(key, value) {
                    /* if(value.crop_location == null || value.crop_location == "")
                    {
                        user_or_crop = value.user_name;
                    }else{
                        user_or_crop = value.crop_location;
                    } */
                    if (value.src_crop != null) { src_crop = value.src_crop; }
                    if (value.dst_crop != null) { dst_crop = value.dst_crop; }
                    details += '<tr>' +
                        '<td> ' + value.src_user + ' / ' + src_crop + '  </td>' +
                        '<td> ' + value.dst_user + ' / ' + dst_crop + '  </td>' +
                        '<td> ' + '₹' + currency_format(value.withdrawal_amount, 3) + ' </td>' +
                        '</tr>';
                });


                details += '</table>' +
                    '</td>' +
                    '<td class="hide_blk"> </td>' +
                    '<td class="hide_blk"> </td>' +
                    '<td class="hide_blk"> </td>' +
                    '</tr>';
                return details;
            },
            error: function(error) {
                console.log("Error:");
                console.log(error);
            }
        });
    } else if (d[4] == "LOADING" || d[4] == "TRANSPORT" || d[4] == "AMOUNT") {
        details = '';
    }
    return details;

}