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

                    htmlRows = '<tr><td><input type="text" class="txt_cnt mykey datepicker" onkeydown="return false;" value="' + trades.startdate + '" name="startdate[]" id="startdate' + id + '" style="width:96px;" disabled>  </td><td><input type="text" class="txt_cnt mykey datepicker" value="' + trades.enddate + '" name="enddate[]" id="enddate' + id + '"  onkeypress="return validateFloatKeyPress(this,event);" style="width:96px;"></td><td><span id="daydis' + id + '"> ' + trades.days + '</span> </td><td> ' + trades.croploan + '</td><td class="txt_rt"> ' + '₹' + currency_format(tcamtt, 2) + '</td><td> <input type="text" class="txt_cnt rt_int mykey" value="' + interestval + '" name="iinterest[]" id="iinterest' + id + '" onkeypress="return validateFloatKeyPress(this,event);"> <input type="hidden" value="' + trades.amount + '" name="tot[]" id="tot' + id + '" ><input type="hidden" value="' + trades.days + '" name="days[]" id="days' + id + '" ><input type="hidden" value="' + trades.months + '" name="months[]" id="months' + id + '" ><input type="hidden" value="' + trades.id + '" name="trans_id[]" id="trans_id' + id + '" ><input type="hidden"  name="interestamtval[]" id="interestamtval' + id + '" value="' + trades.interest_amount + '" /><input type="hidden" name="totamtval[]" id="totamtval' + id + '" value="' + trades.total_amount + '" /></td><td class="txt_rt" id="interestamt' + id + '"> ' + interest_amount + '</td><td class="txt_rt txt_red" id="totamt' + id + '">' + total_amount + '</td></tr>';

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
                            console.log('cal2');
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
                console.log('cal3');
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
        url: url + "api/users/getsalesdata_b",
        data: { userid: user_id, crop_id: crpid },
        type: 'POST',
        datatype: 'json',
        success: function(response1) {
            res1 = JSON.parse(response1);
            htmlRows = "";
            sumrecord = "";
            salesumm = "";
            $('#rowcount').val(res1.length);
            if (res1.length > 0) {
                $('#poptextshow2').html('2');

                $('#salestepshow').val(1);

                var lsshow = $('#loanstepshow').val();

                if (lsshow == 0) {
                    $('.sec_step').show();
                    $('.sale_tb').show();

                    $('#saleOrder').show();
                    $('#confirmOrder').hide();
                    $('#finalOrder').hide();
                }
                var inc = 0;
                $.each(res1, function(index, trades) {
                    salesumm = '<div class="col-md-4"><div class="analtic_blk"><p class="anl_sml_txt"> ' + trades.categoryname + ' Amount </p><h1 class="anl_lrg_txt"> ₹' + currency_format(trades.totalamount, 2) + ' </h1><ul><li><span class="anl_sml_txt">Total Amount</span><span class="li_amnt_an"> ₹' + currency_format(trades.totalamount, 2) + ' </span></li><li><span class="anl_sml_txt">Total Discount</span><span class="li_amnt_an"> ₹0</span></li></ul></div></div>';

                    /* sumrecord =  '<ul ><li class="prd_typ"><span class="anl_sml_txt">'+trades.categoryname+'</span><span class="li_amnt_an">  ₹'+addCommas(trades.totalamount)+'</span></li><li class="discount_li"><span class="anl_sml_txt">Discount</span><span class="li_amnt_an" id="catdiscount'+trades.category+'" >- ₹0</span></li><li class="eql_tbl"> = </li><li><span class="anl_sml_txt">Total</span><span class="li_amnt_an blue_txt"> <b id="cattotamt'+trades.category+'">₹'+addCommas(trades.totalamount)+'</b> </span></li></ul>';*/

                    htmlRows = '<thead data-toggle="collapse" data-target="#feed_tbl" aria-expanded="false" aria-controls="feed_tbl"><tr><th><span class="tggl_act"><img src="http://3.7.44.132/aquacredit/assets/images/plu.svg" class="plu"><img src="http://3.7.44.132/aquacredit/assets/images/mini.svg" class="mini"></span>' + trades.categoryname + ' (' + trades.bcount + ') </th><th class="pp_amnt txt_rt"></th><th class="pp_dis"></th><th class="pp_ttl txt_rt"> </th></tr></thead>';


                    var dda = trades.branchname;
                    var arr = dda.split(',');

                    var ddb = trades.branchid;
                    var arrb = ddb.split(',');

                    var ddbd = trades.bdiscount;
                    var arrbd = ddbd.split(',');

                    var tott = trades.totamount;
                    var ttt = tott.split(',');

                    var ssids = trades.sids;
                    var sids = ssids.split(',');

                    var ppmrp1 = trades.productmrp;
                    var ppmrp1a = ppmrp1.split(',');

                    var disc_limit = trades.disc_limit;
                    var discount_limit = disc_limit.split(',');

                    if (arr.length > 0) {
                        htmlRows += '<tbody><tr><td colspan="4"><div id="feed_tbl" class="collapse show tgl_div"><table border="0" cellpadding="0" cellspacing="0"><tr><td colspan="4"><div id="feed_tbl1" class="collapse show tgl_div"><table border="0" cellpadding="0" cellspacing="0"><tr><td class="brnd_ane"> <b> Brand Name</b></td><td class="pp_amnt txt_rt"> <b> MRPs Total</b></td><td class="pp_dis"> <b> Discount </b> </td><td class="pp_ttl txt_rt"> <b> Total </b></td></tr>';

                        //alert(arr.length);
                        for (var ii = 0; ii < arr.length; ii++) {
                            console.log('sri' + arr[ii]);
                            if (arr[ii] != '' && arr[ii] != undefined) {
                                var tttm = currency_format(ttt[ii], 2);

                                htmlRows += '<tr>' +
                                    '<td class="brnd_ane" data-toggle="collapse" data-target="#prds_tbl' + inc + '" aria-expanded="false" aria-controls="prds_tbl' + inc + '">' +
                                    '<a href="javascript:void(0);" onclick="return getdivpro(' + user_id + ',' + crpid + ',' + trades.category + ',' + arrb[ii] + ',' + inc + ');">' + arr[ii] + '</a>' +
                                    '</td>' +
                                    '<td class="pp_amnt txt_rt">' + currency_format(ttt[ii], 2) + '</td>' +
                                    '<td class="pp_dis">' +
                                    '<input type="text" name="branddiscount[]" id="branddiscountval' + index + arrb[ii] + trades.category + '" value="' + arrbd[ii] + '" autocomplete="off" class="brand_discount" onkeypress="return validateFloatKeyPress(this,event);">' +
                                    '<input type="text" name="discountvalue[]" id="discountvalue' + index + arrb[ii] + trades.category + '" value="" autocomplete="off" class="discountvalue">' +
                                    '<input type="hidden" name="brandidval[]" id="brandidval' + index + arrb[ii] + trades.category + '" value="' + arrb[ii] + '">' +
                                    '<input type="hidden" name="categoryidval[]" id="categoryidval' + index + arrb[ii] + trades.category + '" value="' + trades.category + '">' +
                                    '<input type="hidden" name="sids[]" id="sids' + index + arrb[ii] + trades.category + '" value="' + sids[ii] + '">' +
                                    '<input type="hidden" name="auserid" id="auserid" value="' + user_id + '" >' +
                                    '<input type="hidden" name="acropid" id="acropid" value="' + crpid + '">' +
                                    '<input type="hidden" name="discount_limit[]" id="discount_limit' + index + arrb[ii] + trades.category + '"  value="' + discount_limit[ii] + '">' +
                                    '<input type="hidden" name="prodtotamount[]" id="prodtotamount' + index + arrb[ii] + trades.category + '"  value="' + ppmrp1a[ii] + '">' +
                                    '<input type="hidden" name="brandtotamtval[]" id="brandtotamtval' + index + arrb[ii] + trades.category + '" value="' + ttt[ii] + '">' +
                                    '<input type="hidden" name="brandtotamtvalact[]" id="brandtotamtvalact' + index + arrb[ii] + trades.category + '" value="' + ttt[ii] + '">' +
                                    '</td>' +
                                    '<td class="pp_ttl txt_rt" id="brandtotamt' + index + arrb[ii] + trades.category + '" >' + tttm + '</td>' +
                                    '</tr>' +
                                    '<tr>' +
                                    '<td colspan="4" class="prd_b_tb">' +
                                    '<div id="prds_tbl' + inc + '" class="collapse tgl_div">' +
                                    '<table>' +
                                    '<tr>' +
                                    '<th class="brnd_ane"> Product Name </th>' +
                                    '<th class="pp_amnt txt_rt"> MRP </th>' +
                                    '<th class="pp_dis"> Discount </th>' +
                                    '<th class="pp_ttl txt_rt"> Total </th>' +
                                    '</tr>' +
                                    '<tbody id="productssata' + inc + arrb[ii] + '' + trades.category + '"></tbody>';

                                //getdivpro('+user_id+','+crpid+','+trades.category+','+arrb[ii]+','+index+');

                                htmlRows += '</table></div></td></tr>';
                                inc++;
                            }
                        }

                        htmlRows += '</table></div></td></tr></tbody>';
                    }

                    $('#saledataload').append(htmlRows);
                    $('#summaryrecord').append(sumrecord);
                    $('#summarysalerecord').append(salesumm);

                });
            } else {
                $('.sec_step').hide();
                $('.sale_tb').hide();
                $('#poptextshow1').html('1');
                $('#poptextshow3').html('2');
                $('#saleOrder').hide();
            }
            // calculateTotalsale();
            calculateTotalproduct();
        }
    });
    /*get sales data end*/
    /*get final data*/
    $.ajax({
        url: url + "api/users/getfinaldata",
        data: { userid: user_id, crop_id: crpid },
        type: 'POST',
        datatype: 'json',
        success: function(response112) {
            res121 = JSON.parse(response112);

            $.each(res121, function(index, finalval) {

                if (finalval.harvest != null) {
                    var hamt = parseFloat(finalval.harvest);
                } else {
                    var hamt = 0;
                }

                var hwgt = parseFloat(finalval.tradetons);
                //alert(hwgt);
                //alert(finalval.feedusage);
                if (hwgt != 0 && finalval.feedusage != null) {
                    $('#feedharvestsymbol').show();
                } else {

                    $('#feedharvestsymbol').hide();
                }
                $('#harvesttons').html(hwgt.toFixed(2));
                $('#harvesttonsval').val(hwgt.toFixed(2));

                if (hamt != '' && hamt != 0) {
                    $('#harvestamount').html(hamt.toFixed(2));
                } else {
                    $('#harvestamount').html(hamt);
                }
                if (hamt == 0) {
                    $('#harvesthide').hide();
                }

                $('#harvestweight').html(hwgt.toFixed(2));
                $('#feedusage').html(finalval.feedusage);

                if (finalval.transport == null) {
                    $('#ftransporthide').hide();
                } else {
                    $('#ftransport').html(finalval.transport);
                    $('#ftransporthide').show();
                }

                if (finalval.lab == null) {
                    $('#flabhide').hide();
                } else {

                    $('#flabfee').html(finalval.lab);
                    $('#flabhide').show();
                }

                $('#flabfee').html(finalval.lab);
                $('#freceipts').html(finalval.receipt);
                $('#fretrun').html(finalval.returnamount);

            });
        }
    });
    /*get final data*/
    /*getfeed products*/
    var html = '';
    $('#feeddata').html('');
    $.ajax({
        url: url + "api/users/getfeedproducts",
        data: { userid: user_id, crop_id: crpid },
        type: 'POST',
        datatype: 'json',
        success: function(response111) {
            res111 = JSON.parse(response111);

            if (res111 != null) {
                var bags = '';
                var fwght = '';
                $.each(res111, function(index, fval) {
                    bags += fval.quantity;
                    fwght += fval.feedweight;

                    html += '<tr><td> ' + fval.product_name + ' - ' + fval.qty + ' ' + fval.units + ' </td><td class="no_bgs"> ' + fval.quantity + ' </td></tr>';
                });
                var tfwt = fwght / 1000;
                var hval = $('#harvesttonsval').val();


                $('#feedusage').html(tfwt);
                $('#tfeedbad').html(bags);
                $('#feeddata').append(html);
            } else {
                $('#feedtable').hide();
            }
            // alert(hval);
        }
    });

    /*getfeed products*/
    getcattotal();
    /* var lsh = $('#loanstepshow').val();
    var ssh = $('#salestepshow').val();
    alert(lsh);
    alert(ssh);*/
}

function update_activity_table(col, value, id) {
    console.log(col);
    console.log(value);
    console.log(id);
    $.ajax({
        url: url + 'api/Loans/update_single_field',
        type: "POST",
        data: { column: col, value: value, loan_id: id },
        dataType: "json",
        async: false,
        success: function(data) {
            console.log('ss');
        }
    });
}

function getcattotal() {
    console.log('get cat total');
    var crpid = $("#crop_id").val();
    $('#summaryrecord').html('');
    $.ajax({
        url: url + "api/users/getsalesdata_b",
        data: { userid: user_id, crop_id: crpid },
        type: 'POST',
        datatype: 'json',
        success: function(response1) {
            res1 = JSON.parse(response1);
            htmlRows = "";
            sumrecord = "";
            salesumms = "";
            $('#rowcount').val(res1.length);

            if (res1.length > 0) {
                $.each(res1, function(index, trades) {

                    var dda = trades.branchname;
                    var arr = dda.split(',');

                    var ddb = trades.branchid;
                    var arrb = ddb.split(',');

                    var tott = trades.totamount;
                    var ttt = tott.split(',');

                    if (arr.length > 0) {
                        var grandTotalv = 0;
                        var ddisc = 0;

                        for (var ii = 0; ii <= arr.length; ii++) {
                            if (arr[ii] != '' && arr[ii] != undefined) {
                                var prodisc = $('#branddiscountval' + index + arrb[ii] + trades.category).val();
                                prodisc = (prodisc == "undefined") ? prodisc : 0;
                                var total = $('#brandtotamtvalact' + index + arrb[ii] + trades.category).val();
                                //total = (total == "undefined") ? total : 0;
                                console.log("prodisc------" + prodisc);
                                console.log('#brandtotamtvalact' + index + arrb[ii] + trades.category + "total------" + total);





                                var vaal = $('#pro_discount' + index + arrb[ii] + trades.category + '_' + ii).val();
                                console.log('#pro_discount' + index + arrb[ii] + trades.category + '_' + ii + '---' + vaal);
                                var ds = prodisc / 100;
                                var dsc = ds * total;
                                var tot1 = total - dsc;

                                if (vaal == undefined) {
                                    console.log('ss' + ddisc);
                                    grandTotalv += parseFloat(tot1);
                                    ddisc += parseFloat(dsc);
                                } else {
                                    console.log('rr' + vaal);
                                    var total = $('#brandtotamtvalact' + index + arrb[ii] + trades.category).val();
                                    grandTotalv += parseFloat(total).toFixed(2);
                                    ddisc += parseFloat(dsc);
                                }

                            }
                        }
                        //ddisc = ($('#discountvalue' + index + arrb[ii] + trades.category).val() == "undefined") ? 0 : $('#discountvalue' + index + arrb[ii] + trades.category).val();
                    }

                    sumrecord = '<ul ><li class="prd_typ"><span class="anl_sml_txt">' + trades.categoryname + '</span><span class="li_amnt_an">  ₹' + currency_format(trades.totalamount, 2) + '</span></li><li class="discount_li"><span class="anl_sml_txt">Discount</span><span class="li_amnt_an" id="catdiscount' + trades.category + '" >- ₹' + ddisc + '</span></li><li class="eql_tbl"> = </li><li><span class="anl_sml_txt">Total</span><span class="li_amnt_an blue_txt"> <b id="cattotamt' + trades.category + '">₹' + currency_format(grandTotalv, 2) + '</b> </span></li></ul>';

                    salesumms = '<div class="col-md-4"><div class="analtic_blk"><p class="anl_sml_txt"> ' + trades.categoryname + ' Amount </p><h1 class="anl_lrg_txt"> ₹' + currency_format(trades.totalamount, 2) + ' </h1><ul><li><span class="anl_sml_txt">Total Amount</span><span class="li_amnt_an"> ₹' + currency_format(grandTotalv, 2) + ' </span></li><li><span class="anl_sml_txt">Total Discount</span><span class="li_amnt_an"> ₹' + ddisc + '</span></li></ul></div></div>';

                    $('#summaryrecord').append(sumrecord);
                    $('#summarysalerecord').append(salesumms);
                });
            }
        }
    });
}

function getdivpro(user_id, crpid, category, brandid, ind) {
    htmlr = '';
    $('#productssata' + ind + brandid + category).html('');
    $.ajax({
        url: url + "api/users/getproductsdata",
        data: { userid: user_id, crop_id: crpid, category: category, branchid: brandid },
        type: 'POST',
        datatype: 'json',
        success: function(response12) {
            res12 = JSON.parse(response12);
            if (res12.length > 0) {
                var inc = 0;
                $.each(res12, function(index, prod) {
                    /**/
                    var pdiss = $("#branddiscountval" + ind + brandid + category).val();

                    if (prod.prodiscount == null) {
                        var pdisc = 0;
                    } else {
                        var pdisc = prod.prodiscount;
                    }
                    htmlr += '<tr>' +
                        '<td class="brnd_ane"> ' +
                        '<a href="javascript:void(0)"> ' + prod.product_name + '</a>' +
                        '</td>' +
                        '<td class="pp_amnt txt_rt"> ' + currency_format(prod.totprice, 2) + ' </td>' +
                        '<td class="pp_dis"> ' +
                        '<input type="text" name="pro_discount[]" id="pro_discount' + ind + brandid + category + '_' + inc + '" onkeypress="return validateFloatKeyPress(this,event);" value="' + pdisc + '">' +
                        '<input type="hidden" name="categoryid[]" id="categoryid' + ind + brandid + category + '" value="' + category + '">' +
                        '<input type="hidden" name="purchaseamountval[]" id="purchaseamountval' + ind + brandid + category + '_' + inc + '" value="' + prod.purchaseamountval + '">' +
                        '<input type="hidden" name="productdiscount[]" id="productdiscount' + ind + brandid + category + '_' + inc + '" value="' + prod.productdiscount + '">' +
                        ' <input type="hidden" name="brandid[]" id="brandid' + ind + brandid + category + '" value="' + brandid + '">' +
                        '<input type="hidden" name="pbranddiscountval[]" id="pbranddiscountval' + ind + brandid + category + '_' + inc + '" value="' + pdiss + '">' +
                        '<input type="hidden" name="prosids[]" id="prosids' + ind + brandid + category + '_' + inc + '" value="' + prod.sids + '" >' +
                        '<input type="hidden" name="prodid[]" id="prodid' + ind + brandid + category + '_' + inc + '" value="' + prod.product_id + '">' +
                        '<input type="hidden" id="pro_t' + ind + brandid + category + '_' + inc + '" value="0" />' +
                        '<input type="hidden" value="' + prod.proamount + '" name="pro_totamount[]" id="pro_totamount' + ind + brandid + category + '_' + inc + '" >' +
                        '<input type="hidden" value="' + prod.totprice + '" name="pro_totvalact[]" id="pro_totvalact' + ind + brandid + category + '_' + inc + '" >' +
                        '</td>' +
                        '<td class="pp_ttl txt_rt" id="pro_total' + ind + brandid + category + '_' + inc + '"> ' + currency_format(prod.totprice, 2) + ' </td>' +
                        '</tr>';

                    inc++;

                });
            }
            //alert(ind+brandid+category);
            $('#productssata' + ind + brandid + category).append(htmlr);
            calculateTotalproduct();
        }
    });
    /*b h*/
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

    formData = new FormData(loanfrm);
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
            var lstp = $('#salestepshow').val();
            if (lstp == 1) {
                $(".sec_step").trigger("click");
            } else {
                $(".thrd_step").trigger("click");
            }
        }
    });
});
$("#saleOrder").on("click", function() {

    formData = new FormData(salefrm);
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
    var crpid = $("#crop_id").val();
    var gdiscount = $('#granddiscount_amountval').val();
    var loanstep = $('#loanstepshow').val();
    var salestep = $('#salestepshow').val();

    $.ajax({
        url: url + "api/users/updatefinaldata",
        data: { userid: user_id, crop_id: crpid, gval: gval, interestval: interestval, gdiscount: gdiscount, loanstep: loanstep, salestep: salestep },
        type: 'POST',
        datatype: 'json',
        success: function(response1) {
            res1 = JSON.parse(response1);
            location.reload();
        }
    });


});
$(document).on('blur', "[id^=iinterest]", function() {
    console.log('cal4');
    id = $(this).attr("id").replace("iinterest", '');
    //update_activity_table('rate_of_interest', $(this).val(), id);
    calculateTotal();
});
$(document).on('change', "[id^=startdate]", function() {
    console.log('remove');
    console.log('cal5');
    calculateTotal();
});
$(document).on('change', "[id^=enddate]", function() {
    console.log('cal6');
    console.log('remove');
    calculateTotal();
});
$(document).on('blur', "[id^=pro_discount]", function() {
    product_discount = $(this).val();
    if (product_discount != "") {
        var id = $(this).attr('id');
        arr = id.split("_");
        pid = arr[2];
        id = arr[1].replace("discount", '');
        $("#branddiscountval" + id).val('0'); //clear brand discount
        pro_disc_limit = $("#productdiscount" + id + "_" + pid).val();
        if (parseFloat(product_discount) > parseFloat(pro_disc_limit)) {
            //clear product discount
            console.log('dont apply');
            $(this).val('0');
        } else {
            console.log('apply');
        }
    }
    calculateTotalproduct(id);

});

function calculateTotalproduct(bid) {
    var total_prods_dis = 0;
    var total_product_amount = 0;
    $("[id^='pro_discount']").each(function() {
        var id = $(this).attr('id');
        id = id.replace("pro_discount", '');

        /*validation*/
        /* var bid = $('#brandid' + id).val();
        var pid = $('#prodid' + id).val(); */
        /*validation*/
        //var resid = id.split('_');
        //var vv = resid[0];
        var promrpval = $('#pro_totvalact' + id).val();
        var prodisc = $('#pro_discount' + id).val();
        var ppr = $('#purchaseamountval' + id).val(); //single product purchase amount


        if (prodisc != '' && prodisc != undefined && prodisc != null) {
            var total = promrpval;
            var ds = prodisc / 100;
            var dsc = ds * total;
            var tot1 = total - dsc; //after discount value for total qty

            var proamtval = $('#pro_totamount' + id).val();
            var ptotal = proamtval;
            var pdsc = ds * ptotal;
            var ptot1 = ptotal - pdsc; //after discount value for single product
        }
        console.log(ptot1 + "----" + ppr);
        if (parseFloat(ptot1) < parseFloat(ppr)) {
            var pdis_val = $('#pro_discount' + id).val();
            alert('Discount should be lessthan purchase amount, purchase amount is ' + pdis_val);
            $('#pro_discount' + id).val('');
            $('#pro_total' + id).html(currency_format(promrpval, 2));
            $('#pro_totval' + id).val(promrpval);
            return false;
        } else {
            var ii = $('#pro_t' + id).val();
            if (ii == 0) {
                $('#pro_total' + id).html(currency_format(tot1, 2));
                $('#pro_totval' + id).val(tot1);
                $('#brandtotamtval' + bid).prop('disabled', true);
                //grandTotals += parseFloat(tot1);
                total_prods_dis += dsc;
                total_product_amount += tot1;
            }
        }
    });
    $("#discountvalue" + bid).val(total_prods_dis);
    $('#brandtotamt' + bid).html(currency_format(total_product_amount, 2));
    $('#brandtotamtval' + bid).val(total_product_amount);
    //getcattotal2();
    finalsaledata();
}

// function calculateTotalproduct() {
//     //var grandTotals = 0;
//     var vv = "";
//     var total_prods_dis = 0;
//     $("[id^='pro_discount']").each(function() {
//         var id = $(this).attr('id');
//         id = id.replace("pro_discount", '');

//         /*validation*/
//         /* var bid = $('#brandid' + id).val();
//         var pid = $('#prodid' + id).val(); */
//         /*validation*/
//         var resid = id.split('_');
//         var vv = resid[0];
//         console.log('vv' + vv);
//         var promrpval = $('#pro_totvalact' + id).val();
//         var prodisc = $('#pro_discount' + id).val();
//         var ppr = $('#purchaseamountval' + id).val(); //single product purchase amount


//         if (prodisc != '' && prodisc != undefined && prodisc != null) {
//             var total = promrpval;
//             var ds = prodisc / 100;
//             var dsc = ds * total;
//             var tot1 = total - dsc; //after discount value for total qty

//             var proamtval = $('#pro_totamount' + id).val();
//             var ptotal = proamtval;
//             var pdsc = ds * ptotal;
//             var ptot1 = ptotal - pdsc; //after discount value for single product
//         }
//         console.log(ptot1 + "----" + ppr);
//         if (parseFloat(ptot1) < parseFloat(ppr)) {
//             var pdis_val = $('#pro_discount' + id).val();
//             alert('Discount should be lessthan purchase amount, purchase amount is ' + pdis_val);
//             $('#pro_discount' + id).val('');
//             $('#pro_total' + id).html(currency_format(promrpval, 2));
//             $('#pro_totval' + id).val(promrpval);
//             return false;
//         } else {
//             var ii = $('#pro_t' + id).val();
//             if (ii == 0) {
//                 $('#pro_total' + id).html(currency_format(tot1, 2));
//                 $('#pro_totval' + id).val(tot1);
//                 $('#brandtotamtval' + vv).prop('disabled', true);
//                 //grandTotals += parseFloat(tot1);
//                 total_prods_dis += dsc;
//                 $("#discountvalue" + vv).val(total_prods_dis);
//             }
//         }
//     });
//     //calculateTotalsale();
// }

$(document).on('blur', "[id^=branddiscountval]", function() {
    //validate discount and clear product discounts if not empty
    id = $(this).attr("id");
    id = id.replace("branddiscountval", '');
    var disc_limit = $('#discount_limit' + id).val();
    var disc_value = $(this).val();
    $("input[id^='pro_discount" + id + "']").val('0'); // clear listed products discount
    if (parseFloat(disc_limit) < parseFloat(disc_value)) {
        $(this).val('0');
    } else {
        console.log('Apply');
    }
    calculateTotalsale();
});

function calculateTotalsale() {
    console.log('calculate total sale');
    var grandTotal = 0;
    var ddisc = 0;
    var grandTotals = 0;
    $('#summaryrecord').html('');
    $('#summarysalerecord').html('');

    $("[id^='branddiscountval']").each(function() {
        var id = $(this).attr('id');
        id = id.replace("branddiscountval", '');
        var promrpval = $('#brandtotamtvalact' + id).val();

        var prodisc = $('#branddiscountval' + id).val();
        var total = promrpval;

        var ds = prodisc / 100;
        var dsc = ds * total;
        var tot1 = total - dsc;

        $('#brandtotamt' + id).html(currency_format(tot1, 2));
        $('#brandtotamtval' + id).val(tot1);

        //if (vaal == undefined) {
        grandTotal += parseFloat(tot1);
        ddisc += parseFloat(dsc);
        grandTotals += parseFloat(promrpval);
        $("#discountvalue" + id).val(dsc);


    });
    //alert(grandTotal);
    $('#grandtotal_amount').html('₹' + currency_format(grandTotals, 3));
    $('#granddiscount_amount').html('₹' + currency_format(ddisc, 3));
    $('#grandtotal_amountval').val(grandTotals);
    $('#granddiscount_amountval').val(ddisc);
    $('#grandfinalamount').html('₹' + currency_format(grandTotal, 3));
    //getcattotal3();
    finalsaledata();
}

function finalsaledata() {

}

// function calculateTotalsale1() {
//     console.log('calculate total sale');
//     var grandTotal = 0;
//     var ddisc = 0;
//     var grandTotals = 0;
//     $('#summaryrecord').html('');
//     $('#summarysalerecord').html('');

//     $("[id^='branddiscountval']").each(function() {
//         var id = $(this).attr('id');
//         id = id.replace("branddiscountval", '');

//         var vaal = $('#pro_discount' + id).val();

//         /* var bidd = $('#brandidval' + id).val();
//         var catid = $('#categoryidval' + id).val(); */

//         var promrpval = $('#brandtotamtvalact' + id).val();


//         var prodisc = $('#branddiscountval' + id).val();
//         var total = promrpval;
//         var ptotm = $('#prodtotamount' + id).val();


//         var ds1 = prodisc / 100;
//         var dsc1 = ds1 * ptotm;
//         var tot11 = ptotm - dsc1;

//         var ds = prodisc / 100;
//         var dsc = ds * total;
//         var tot1 = total - dsc;

//         if (vaal == undefined) {
//             $('#brandtotamt' + id).html(currency_format(tot1, 2));
//             $('#brandtotamtval' + id).val(tot1);
//             //$('#pro_discount' + id).val(prodisc);

//             grandTotal += parseFloat(tot1);
//             ddisc += parseFloat(dsc);
//             grandTotals += parseFloat(promrpval);
//         } else {
//             var promrpval = $('#brandtotamtvalact' + id).val();

//             grandTotal += parseFloat(promrpval);
//             grandTotals += parseFloat(promrpval);
//             $("#discountvalue" + id).val(tot1);
//         }
//     });
//     //alert(grandTotal);
//     $('#grandtotal_amount').html('₹' + currency_format(grandTotal, 3));
//     $('#granddiscount_amount').html('₹' + currency_format(ddisc, 3));
//     $('#grandtotal_amountval').val(grandTotal);
//     $('#granddiscount_amountval').val(ddisc);
//     $('#grandfinalamount').html('₹' + currency_format(grandTotal, 3));
//     getcattotal();
// }

function calculateTotal() {
    console.log('calulate total');
    var totalamtvalue = 0;
    var totinterestvalue = 0;
    var totval = 0;

    $("[id^='iinterest']").each(function() {
        var id = $(this).attr('id');
        id = id.replace("iinterest", '');

        /*calculate day difference*/
        var start = $('#startdate' + id).val();
        var end = $('#enddate' + id).val();
        /*var sd = new Date(start);
        var ed = new Date(end);
        var diff = new Date(ed - sd);
        var daysval = diff/1000/60/60/24;*/
        var From_date = new Date(start);
        var To_date = new Date(end);
        var diff_date = To_date - From_date;

        /*var years = Math.floor(diff_date/31536000000);
        var months = Math.floor((diff_date % 31536000000)/2628000000);
        var days = Math.floor(((diff_date % 31536000000) % 2628000000)/86400000);*/

        /* alert(months);
         alert(days);*/

        /*var cf = months*30;
        var daysval = cf+days;*/
        /**/
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
                var days = daysval;
                var r = $('#months' + id).val();

                if (r == 0) {
                    r = 1;
                }

                var intrests = ((p * t) / 3000) * days
                $("#intrestResult").val(intrests)
                $("#totalResult").val((+p) + intrests)

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
        /**/

    });


    $('#finalamount').html('₹' + currency_format(totalamtvalue, 2));
    $('#totalamount').html('₹' + currency_format(totval, 2));
    $('#totalinterest').html('₹' + currency_format(totinterestvalue, 2));

    $('#totalamountval').val(totval);
    $('#totalinterestval').val(totinterestvalue);


    $('#floanamount').html('₹' + currency_format(totalamtvalue, 3));
    $('#tloanamount').html('₹' + currency_format(totval, 3));
    $('#tinterestamount').html('₹' + currency_format(totinterestvalue, 3));

}


$(document).ready(function() {
    $('#saleOrder').hide();
    $('#confirmOrder').show();
    $('#finalOrder').hide();
    hidcrop = ""
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
                        //if(crop.cd_id == hidcrop){ sel = "checked"; }else{ sel = "";}
                        opt += '<div class="form-check"><input class="form-check-input" type="radio" name="crop_opt" id="crp' + index + '" value="' + crop.cd_id + '" ' + sel + ' required /><label class="form-check-label" for="crp' + index + '">' + crop.crop_location + '</label></div>';
                    });
                }
            } else {
                var opt = '';
            }
            $("#crop_opt_li").html(opt);
            load_unsettled();
            load_analytics();
            //summary_settled();
        }
    });

    $(document).on("change", ".check_list input[name='crop_opt']", function() {
        var id = $('input[name=crop_opt]:checked').val();
        $("#crop_id").val(id);
        $(".swith_blk").toggleClass('tog_yes');
        $('#usr_lst_tbl').DataTable().destroy();
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

    $(document).on('click', '.comp_cl', function() {
        $(this).addClass('act_tab');
        $('.tabs_tbl').addClass('cmp_ul');
        $('.drft_cl').removeClass('act_tab');
        //$('#usr_lst_tbl').DataTable().ajax.reload();
        $('#usr_lst_tbl').DataTable().destroy();
        load_settled();
    });

    $(document).on('click', '.drft_cl', function() {
        $(this).addClass('act_tab');
        $('.tabs_tbl').removeClass('cmp_ul');
        $('.comp_cl').removeClass('act_tab');
        //$('#usr_lst_tbl').DataTable().ajax.reload();
        $('#usr_lst_tbl').DataTable().destroy();
        load_unsettled();
    });

    // $('#fil2').multiselect();
    // $('#fil1').multiselect();
    // $('#fil3').multiselect();

    /* $('.loans_tp').click(function() {
        $('.alpha_blk').show();
        $('.side_popup').addClass('opn_slide');
        $('#loans_tp').show();
        $('#orders_tp').hide();
        $('#crop_top').hide();
    }); */

    /* $('.orders_tp').click(function() {
        $('.alpha_blk').show();
        $('.side_popup').addClass('opn_slide');
        $('#loans_tp').hide();
        $('#orders_tp').show();
        $('#crop_top').hide();
    }); */


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
});

function load_unsettled() {
    $("#table_footer").show();
    $("#usr_lst_tbl").empty();
    var h = $(window).height();
    var min_h = h - 315;
    var tables = $('#usr_lst_tbl').DataTable({
        'ordering': false,
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        "columns": [
            { title: "Date", className: "date", "width": "20%" },
            { title: "Detail", className: "" },
            { title: "Amount", className: "txt_rt out_td", "width": "40%" } //grn_clr txt_red out_td
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
                //alert(json.total_record);
                if (json.total_record > 0) {
                    $('#setacnt').prop('disabled', false);
                } else {
                    $('#setacnt').prop('disabled', true);
                }

                total_trans_amount = json.total_trans_amount;
                if (total_trans_amount > 0) {
                    $(".in_td").html('<span class="grn_clr">₹' + currency_format(total_trans_amount, 2) + '</span');
                } else {
                    tta = Math.abs(total_trans_amount);
                    $(".in_td").html('<span class="txt_red">₹' + currency_format(tta, 2) + '</span>');
                }
                json.open_balance = 0; // need to work for open balance
                grand_total = parseFloat(total_trans_amount) + parseFloat(json.open_balance);
                if (grand_total > 0) {
                    $("#grd_ttl").html("Payable Amount");
                    $(".grand_total").html('<span class="grn_clr">₹' + currency_format(grand_total, 2) + '</span>');
                } else {
                    $("#grd_ttl").html("Receivable  Amount");
                    gtotal = Math.abs(grand_total);
                    $(".grand_total").html('<span class="txt_red">₹' + currency_format(gtotal, 2) + '</span>');
                }

                $("#open_bal").html('₹' + currency_format(json.open_balance, 2));
                //$(".grand_total").html('₹' + currency_format(grand_total, 2));
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

    $('.dataTables_scrollBody').css('height', min_h);
    $('#usr_lst_tbl_wrapper .dataTables_length').html('<ul class="tabs_tbl"><li class="act_tab drft_cl" id="status_0"> <span>Unsettled</span> </li><li class="comp_cl" id="status_1"> <span>Settled </span> </li></ul> <span class="tbl_btn">  </span>');
    $('.dataTables_scrollBody').mCustomScrollbar("destroy");
    $('.dataTables_scrollBody').mCustomScrollbar({
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

/* function summary_settled() {
    console.log('summary_settled');
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
                $(".in_td").html('₹' + currency_format(total_trans_amount, 2));
                $("#open_bal").html('₹' + currency_format(json.open_balance, 2));
                $(".grand_total").html('₹' + currency_format(grand_total, 2));
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
    $("#usr_lst_tbl").empty();
    var h = $(window).height();
    var min_h = h - 230;
    var tables = $('#usr_lst_tbl').DataTable({
        'ordering': false,
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        "columns": [
            { title: "", className: "pl_m", "width": "50px" },
            { title: "Settled Date", className: "date", "width": "100px" },
            { title: "Settled Id", className: "", "width": "" },
            { title: "Status", className: "txt_rt out_td", "width": "" },
            { title: "Download", className: "txt_rt down_blk", "width": "" },
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
    $('.dataTables_scrollBody').css('height', min_h);
    $('#usr_lst_tbl_wrapper .dataTables_length').html('<ul class="tabs_tbl cmp_ul"><li class="drft_cl" id="status_0"> <span>Unsettled</span> </li><li class="act_tab comp_cl" id="status_1"> <span>Settled </span> </li></ul> <span class="tbl_btn">  </span>');
    $('.dataTables_scrollBody').mCustomScrollbar("destroy");
    $('.dataTables_scrollBody').mCustomScrollbar({
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