$(document).ready(function() {

    getadminbranches('both', 0);
    $(".unload_block").hide();
    $(".dest_trans_block").hide();
    $(".rc_btn").hide();

    function cb(start, end) {

        //$("#reportrange").show();

        //$('#reportrange span').html(start.format('D/MMM/YYYY') + ' - ' + end.format('D/MMM/YYYY'));
        $('#date_val').val(start.format('D/MMM/YYYY') + ' - ' + end.format('D/MMM/YYYY'));

        if ($('#date_val').val() == "Invalid date - Invalid date") {
            //$('#reportrange span').html('');
            $('#date_val').val('');
        } else {
            //$('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            //$('#reportrange span').html(start.format('D/MMM/YYYY') + ' - ' + end.format('D/MMM/YYYY'));	
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
            /* 'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()], */
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
            'Last 6 Months': [moment().subtract(5, 'month').startOf('month'), moment().endOf('month')],
            "Last Year": [moment().subtract(1, "y").startOf("year"), moment().subtract(1, "y").endOf("year")]
        }
    }, cb);
    var instance = 0;
    dynamicAutocomplte(instance);


    /* $('input[name="prod[]"]').on('keyup', function(){
    	//alert($(this).attr("id"));
    	//$("#"+$(this).attr("id")).val('');
    	$("#hid_"+$(this).attr("id")).val('');
    	
    }); */

    $(document).on("click", ".purc_btn", function() {

        $('#stk tr td:last-child,#stk tr th:last-child').show();
        $('#stk tbody tr').remove();
        $("#stock_frm")[0].reset();
        getadminbranches('both', 0);
        dynamicAutocomplte(0, "add");
        $("#hid_stk_trans_id").val('');
        $(".src_branch_val").text('Source');
        $(".dst_branch_val").text('Destination');
        $('#create_module').modal();
        $("#add_row").show();
        $(".sb_btn").show();
        $(".fr").val("Create Transfer");
        $(".trans_block").show();
        $(".unload_block").hide();
        $(".loading_block").show();
        $(".dest_trans_block").hide();
    });
    $(document).on("click", ".edt , .vw", function() {
        $('#create_module').modal();
    });

    var tables = $('#pur_lst_tbl').DataTable({
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        "ordering": false,
        language: {
            searchPlaceholder: "Search Stock Transfer Details",
            search: "",
            "dom": '<"toolbar">frtip'
        },
        "columnDefs": [
            { className: "id_td", "targets": 0 },
            { className: "date", "targets": 1 },
            { className: "godown", "targets": [2, 3] },
            { className: "ord_type", "targets": 4 },
            { className: "act_ms", "targets": 5 }
        ],
        'ajax': {
            'url': url + 'api/stockTransfer/get_stock_transfer',
            'data': function(data) {
                // Read values
                var status_opt = $("input[name='status_opt']:checked").val();
                var reportrange = $('#date_val').val();

                // Append to data
                data.status_opt = status_opt;
                data.reportrange = reportrange;

            },
            "dataSrc": function(json) {

                //$(".tot_user_amt").html('₹'+addCommas(json.tot_user_amt));
                $(".tot_pending").html(json.tot_pending);
                $(".tot_completed").html(json.tot_completed);

                setInterval(function() {

                    $('.act_icn').popover({
                        html: true,
                        content: function() {
                            return $('#popover-content').html();
                        }
                    });

                    $('.vw_icn').popover({
                        html: true,
                        content: function() {
                            return $('#popover-content_view').html();
                        }
                    });

                }, 500);

                return json.data;

            }

        }
    });


    $("input[name='status_opt']").on('click', function() {
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

    $('#pur_lst_tbl_wrapper .dataTables_length').html('<h2 class="create_hdg lng_hdg">  Stock Transfer List </h2>');

    $(".loan_btm div.toolbar").html('<b>SSS</b>');
    $('.loan_btm a.toggle-vis').on('click', function(e) {
        $(this).parent().toggleClass('act');
        e.preventDefault();
        var column = tables.column($(this).attr('data-column'));
        column.visible(!column.visible());
    });

    $('.dataTables_paginate').html('<a href="#" title=""> Show More </a>');
    $('.ad_nt').click(function() {
        // $('.pp_note').toggleClass('show_blk');
    });

    $('.comp_cl').click(function() {
        $(this).addClass('act_tab');
        $('.tabs_tbl').addClass('cmp_ul');
        $('.drft_cl').removeClass('act_tab');
    });

    $('.drft_cl').click(function() {
        $(this).addClass('act_tab');
        $('.tabs_tbl').removeClass('cmp_ul');
        $('.comp_cl').removeClass('act_tab');
    });


    /* $(document).on("click", ".edt", function() {
    	$('#edt_module').modal();
    }); */

    $('.lnk_typ.ban_trns').click(function() {
        $(this).addClass('act_type');
        $('.blk_disb').removeClass('blk_no_dis');
        $(this).siblings('.cash_trns, .lnk_typ').removeClass('act_type');
        // $('.blk_disb').addClass('blk_no_dis');
        $(this).parent().siblings('.ove_auto').find('.lon_typ').removeClass('hide_blk_anim');
    });
    $('.lnk_typ.cash_trns').click(function() {
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

    // Add dynamic rows
    //$(document).on("focus",'#stk tr:last-child td:last-child',function() {
    $(document).on("keyup", '#stk tr:last-child td:first-child input', function() {
        //$(document).on("blur",'#stk tr:last-child td:eq(1)',function() {
        //append the new row here.
        //var input_id = $(this).children().attr("id");
        //var input_val = $(this).children().val();
        var input_val = $(this).val();
        if (input_val != "") {
            instance++;
            // Dynamic autocomplete-input			
            dynamicAutocomplte(instance);
        }
    });

    $("#add_row").on('click', function() {
        instance++;
        dynamicAutocomplte(instance);
    });

    $('#stk').on('click', '.del_btn', function() {
        //alert($(this).parents('table').find('tr').length);
        if ($(this).parents('table').find('tr').length > 2) {
            $(this).closest('tr').remove();
        } else {
            return form_validation(1, "Must have at least one product!", $(this).attr("id"));
        }
        //$(this).closest('tr').remove();
    });

    $("#src_branch_li").on("change", function() {

        //$('#stk tbody tr').slice(1).remove();
        //alert($('#stk tbody tr').length);
        instance = 0;
        $('#stk tbody tr').remove();
        dynamicAutocomplte(instance, "add");
        $('.mykey').parent().css("border", "");
        var src_id = $('input[name="src_branch"]:checked').attr("id");
        //alert(src_id);
        getadminbranches(src_id);
    });

    $("#dst_branch_li").on("change", function() {

        $('.mykey').parent().css("border", "");
        /* var dst_id = $('input[name="dst_branch"]:checked').attr("id");
        getadminbranches(dst_id); */
    });

    $(".rc_btn").on('click', function() {

        $('#sa_action').val('receive');
        $('#stock_frm').submit();
    })

    //$(".sb_btn").on("click",function() {
    $('#stock_frm').on('submit', function() {
        //alert($('input[name="src_branch"]:checked').val());
        $('.mykey').parent().css("border", "");
        $('.table_input').css("border", "");
        var role = $("#role").val();
        var err = 0;
        var src_val = $('input[name="src_branch"]:checked').val();
        var dst_val = $('input[name="dst_branch"]:checked').val();

        if (src_val == undefined) {
            err = 1;
            err_msg = "Please select source branch!";
            tagid = ".src_block";
            return form_validation(err, err_msg, tagid);
        }
        if (dst_val == undefined) {
            err = 1;
            err_msg = "Please select destination branch!";
            tagid = ".dst_block";
            return form_validation(err, err_msg, tagid);
        }
        var values = $("input[name='hid_prod[]']").map(function() { return $(this).val(); }).get();
        var qtyvalues = $("input[name='qty[]']").map(function() { return $(this).val(); }).get();
        var newArray = values.filter(function(v) { return v !== '' });
        var newQty = qtyvalues.filter(function(v) { return v !== '' });
        //console.log(newArray);
        if (newArray.length == 0) {
            err = 1;
            return form_validation(err, "Must have at least one product!", "");
        } else {
            //console.log(newQty);
            $("#stock_frm td input").each(function() {

                //alert($(this).val());
                /* if (this.innerText === '') {
                	this.closest('tr').remove();
                } */
                if ($(this).val() === '') {
                    this.closest('tr').remove();

                }
            });
        }
        /* $("#stock_frm input").each(function(){
        	
        	if($(this).val() == ''){
        		
        		var this_id = $(this).attr("id");
        		//alert(this_id);
        		if(this_id != "trans_chrg" && this_id != "unload_chrg" && this_id != "loading_chrg" && this_id != "hid_stk_trans_id" && this_id != "hid_prev_pid" && this_id != "hid_prev_qty" && this_id != "hid_srcid" && this_id != "hid_dstid" && this_id != "desti_trans_chrg" && this_id != "src_dst" && this_id != "role" && this_id != "sa_action")
        		{
        			err = 1;
        			var split_id = this_id.split("_");
        			//alert(split_id[0]);
        			//$("#"+this_id).css("border", "1px solid red");
        			//$(this).css("border", "1px solid red");
        			if(split_id[0] == "hid")
        			{
        				$("#"+split_id[1]).css("border", "1px solid red");
        				return table_validation(err,"Please enter Product and Quantity!","#"+split_id[1]);
        			}else{
        				$(this).css("border", "1px solid red");
        				return table_validation(err,"Please enter Product and Quantity!","#"+$(this).attr('id'));
        			}
        		}			
        						
        	}
        }); */
        //var values = $("input[name='prod[]']").map(function(){return $(this).val();}).get();
        //console.log(values);

        if (err == 0) {
            $('.table_input').css("border", "");
            formData = new FormData(stock_frm);

            if ($("#src_dst").val() == "dst" || $("#sa_action").val() == "receive") {
                //alert("dst");
                var dynurl = url + "api/stockTransfer/receive";
                var dynsucc = "Stock transfer received successfully!";
            } else {
                if ($("#hid_stk_trans_id").val() != "") {
                    var dynurl = url + "api/stockTransfer/update";
                    var dynsucc = "Stock transfer updated successfully!";
                } else {
                    var dynurl = url + "api/stockTransfer/add";
                    var dynsucc = "Stock transfer created successfully!";
                }
            }

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
                        $(".src_branch_val").text('Source');
                        $(".dst_branch_val").text('Destination');
                        $("#create_module").modal("hide");
                        $("#stock_frm")[0].reset();
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
        }
    });

    // Delete Stock Transfer Record
    $(document).on("click", ".del", function() {
        $('#delete_stock').modal();
    });

    $(".del_yes").click(function() {

        var delval = $("#hid_stk_trans_id").val();
        $.ajax({
            url: url + "api/stockTransfer/delete",
            data: { stk_trans_id: delval },
            type: 'POST',
            datatype: 'json',
            success: function(response) {

                res = JSON.parse(response);

                if (res.status == 'success') {
                    new PNotify({
                        title: 'Success',
                        text: "Record deleted successfully!",
                        type: 'success',
                        shadow: true
                    });
                    tables.ajax.reload();
                }
            }
        });
    });

});

function dynamicAutocomplte(id_val, addoredit = "", pid = "", pname = "", pqty = "") {

    //var num = this_id.replace('p','');
    //alert(id_val);
    var table = $("#stk");

    if (addoredit == "edit") {
        instance = id_val;

        table.append('<tr>\
		<td> <input type="text" id="p' + instance + '" name="prod[]" class="skey table_input" value="' + pname + '" placeholder="Select Product" /> <input type="hidden" id="hid_p' + instance + '" name="hid_prod[]" value="' + pid + '" /></td>\
		<td class="txt_cnt qty_pp"><input type="text" id="qty' + instance + '" name="qty[]" value="' + pqty + '" class="allownumericwithoutdecimal table_input" /></td>\
		<td class="red_clr act_pp txt_cnt"> <i class="fa fa-trash del_btn" aria-hidden="true"></i></td>\
		</tr>');
        addRows(instance);

    } else {
        if (addoredit == "add") {
            for (t = 0; t < 5; t++) {
                instance = t;
                table.append('<tr>\
				<td> <input type="text" id="p' + instance + '" name="prod[]" class="skey table_input" value="' + pname + '" placeholder="Select Product" /> <input type="hidden" id="hid_p' + instance + '" name="hid_prod[]" value="' + pid + '" /></td>\
				<td class="txt_cnt qty_pp"><input type="text" id="qty' + instance + '" name="qty[]" value="' + pqty + '" class="allownumericwithoutdecimal table_input" /></td>\
				<td class="red_clr act_pp txt_cnt"> <i class="fa fa-trash del_btn" aria-hidden="true"></i></td>\
				</tr>');

                addRows(instance);
            }
        } else {
            var last_id = $('#stk tr:last-child td:first-child').find('input').attr("id");
            if (last_id == undefined) { instance = 0; } else { instance++; }

            table.append('<tr>\
				<td> <input type="text" id="p' + instance + '" name="prod[]" class="skey table_input" value="' + pname + '" placeholder="Select Product" /> <input type="hidden" id="hid_p' + instance + '" name="hid_prod[]" value="' + pid + '" /></td>\
				<td class="txt_cnt qty_pp"><input type="text" id="qty' + instance + '" name="qty[]" value="' + pqty + '" class="allownumericwithoutdecimal table_input" /></td>\
				<td class="red_clr act_pp txt_cnt"> <i class="fa fa-trash del_btn" aria-hidden="true"></i></td>\
				</tr>');

            addRows(instance);
        }
    }

    //alert(instance);	


}

function addRows(id_val) {
    //alert(id_val);
    $("#p" + id_val).autocomplete({
        //source: url+"api/users/searchusers",
        source: function(request, response) {

            var src_val = $('input[name="src_branch"]:checked').val();

            var dyn_url = url + "api/stockTransfer/searchBranchproducts";
            //var utype = $("input[name='user_type']:checked").val();
            // Fetch data	   
            $.ajax({
                url: dyn_url,
                type: 'post',
                dataType: "json",
                data: {
                    search: request.term,
                    bid: src_val
                },
                success: function(data) {

                    response($.map(data, function(result) {

                        return {

                            label: result.label,
                            value: result.value,
                            pid: result.pid,
                            qty: result.qty
                        }

                    }));

                }
            });
        },
        select: function(event, ui) {

            $('.table_input').css("border", "");
            var this_id = $(this).attr("id");
            //var prod_arry = $("input[name='prod[]']").map(function(){return $(this).val();}).get();
            var prod_arry = $("input[name='hid_prod[]']").map(function() { return $(this).val(); }).get();
            console.log(prod_arry);
            //console.log($.inArray( ui.item.label, prod_arry ));
            console.log($.inArray(ui.item.pid, prod_arry));

            //if($.inArray( ui.item.label, prod_arry ) > -1)
            if ($.inArray(ui.item.pid, prod_arry) > -1) {
                //alert("Exists!");
                $(this).val('');
                return form_validation(1, "Product already selected!", $(this).attr("id"));
            }

            $("#" + this_id).val(ui.item.value);
            $("#hid_" + this_id).val(ui.item.pid);
            var num = this_id.replace('p', '');
            $("#qty" + num).val(ui.item.qty);

            //return false;
        }

    }).data("ui-autocomplete")._renderItem = function(ul, item) {

        return $("<li></li>")

        .data("item.autocomplete", item)

        .append("<a>" + item.label + "</a>")

        .appendTo(ul);

    };

    $("#p" + id_val).on('keyup', function() {
        //alert($(this).attr("id"));
        //$("#"+$(this).attr("id")).val('');
        $("#hid_" + $(this).attr("id")).val('');
    });

    $('#qty' + id_val).on('keyup', function() {

        var this_val = $(this).val();
        var prod_val = $("#hid_p" + id_val).val();
        if (prod_val == "") {
            $("#qty" + id_val).val('');
            return table_validation(1, "Select Product First!", "#p" + id_val);

        } else {
            var src_val = $('input[name="src_branch"]:checked').val();
            $.ajax({
                //url: url+"api/products/index/"+prod_val,
                url: url + "api/stockTransfer/checkProductQty",
                data: { branch_id: src_val, pid: prod_val },
                type: 'POST',
                datatype: 'json',
                success: function(response) {
                    //alert(response);
                    res = JSON.parse(response);
                    if (this_val == 0) {
                        $("#qty" + id_val).val(res.data['qty']);
                        return table_validation(1, "Quantity must not be zero!", "#qty" + id_val);
                    } else if (res.data['qty'] == 0) {
                        $("#qty" + id_val).val(res.data['qty']);
                        return table_validation(1, "Product quantity has zero, Please select another product!", "#qty" + id_val);
                    } else if (+this_val > +res.data['qty']) {
                        $("#qty" + id_val).val(res.data['qty']);
                        //res.data['qty']++;						
                        return table_validation(1, "Enter maximum quantity " + res.data['qty'], "#qty" + id_val);
                    }
                }
            });
        }
    });
}

function edit_stock_trans(stk_trans_id, lstatus) {
    var instance = 0;
    $('#stk tbody tr').remove();
    $("#stock_frm")[0].reset();
    $("#hid_stk_trans_id").val(stk_trans_id);
    //alert("edit");
    $('#sa_action').val('');
    if (lstatus == 1) {
        $(".sb_btn").hide();
        $("#add_row").hide();
        $(".rc_btn").hide();
        $('#stk tr td:last-child,#stk tr th:last-child').hide();
    } else { $(".sb_btn").show();
        $("#add_row").show();
        $(".rc_btn").show(); }

    $.ajax({
        url: url + "api/stockTransfer/stock_transfer_details/" + stk_trans_id,
        data: {},
        type: 'POST',
        datatype: 'json',
        success: function(response) {

            //alert(response);
            //console.log(response);
            res = JSON.parse(response);
            //alert(res.data.source_branch);
            //alert(res.branch_id);

            $("input[name=src_branch][value=" + res.data.source_branch + "]").prop('checked', true);
            $("input[name=dst_branch][value=" + res.data.destination_branch + "]").prop('checked', true);
            $('#hid_srcid').val(res.data.source_branch);
            $('#hid_dstid').val(res.data.destination_branch);
            $(".check_wt_serc").addClass('val_seld');
            $(".src_branch_val").text(res.data.src_branch);

            //alert($("input[name='dst_branch']:checked").attr("id"));
            //var src_val_id = $("input[name='src_branch']:checked").attr("id");
            //var res_id = src_val_id.split('_');
            //getadminbranches("edt_"+res_id[1]+"_"+res.data.destination_branch);
            getadminbranches("edt_" + res.data.destination_branch + "_" + res.data.source_branch, lstatus);
            $(".dst_branch_val").text(res.data.dst_branch);
            //alert(res.products.length);
            $(".fr").val('Update Transfer');
            //$(".tot_user_amt").html('₹'+addCommas(json.tot_user_amt));
            $("#trans_chrg").val(addCommas(res.data.transport_charge));
            $("#hid_trans_chrg").val(res.data.transport_charge);
            $("#loading_chrg").val(addCommas(res.data.loading_charge));
            $("#hid_loading_chrg").val(res.data.loading_charge);

            $("#desti_trans_chrg").val(addCommas(res.data.desti_trans_charge));
            $("#hid_desti_trans_chrg").val(res.data.desti_trans_charge);

            $("#unload_chrg").val(addCommas(res.data.unload_charge));
            $("#hid_unload_chrg").val(res.data.unload_charge);

            var pidArray = [];
            var pQty = [];

            $.each(res.products, function(i, val) {

                pidArray.push(val.product_id);
                pQty.push(val.prod_qty);

                dynamicAutocomplte(instance, "edit", val.product_id, val.pname, val.prod_qty);
                instance++;
            });
            //console.log(pidArray);
            $("input[name='hid_prev_pid']").val(pidArray);
            $("input[name='hid_prev_qty']").val(pQty);

            if (res.branch_id == res.data.destination_branch) {
                $("#src_branch_li").html('');
                $("#dst_branch_li").html('');
                $(".trans_block").hide();
                $(".unload_block").show();
                $(".loading_block").hide();
                $(".dest_trans_block").show();
                $("#add_row").hide();
                //$("#stock_frm :input").prop("disabled", true);
                $("#stk :input").prop("disabled", true);
                $("input[name='dst_branch']").prop("disabled", true);
                //$('#stk tr td:last-child').find('.del_btn').hide();
                $('#stk tr td:last-child,#stk tr th:last-child').hide();
                //$(".del_btn").hide();
                $(".fr").val('Receive');
                $('#dst_branch_li ').html('');
                $('#src_dst ').val('dst');
            } else {
                $(".trans_block").show();
                $(".unload_block").hide();
                $(".loading_block").show();
                $(".dest_trans_block").hide();
                $(".fr").val('Update Transfer');
                $('#stk tr td:last-child,#stk tr th:last-child').show();
                $('#src_dst ').val('src');
                //$("#add_row").show();
            }

            /* if(lstatus == 1)
            {
            	$('#stock_frm').find('input').attr('disabled','disabled');
            }else{
            	$('#stock_frm').find('input').removeAttr('disabled');
            } */

        }

    });

}

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

function table_validation(err, err_msg, tagid) {
    $('.table_input').css("border", "");
    $("#snackbar").text(err_msg);
    $("#snackbar").addClass("show");
    setTimeout(function() { $("#snackbar").removeClass("show"); }, 3000);
    $(tagid).css("border", "1px solid red");
    //$("#tname").css("border", "1px solid red");
    $(tagid).focus();
    return false;
}

function getadminbranches(src_or_dst, lstatus) {
    //Table rows clear
    //$("#stk").find('tr').remove();	
    var res_arr = src_or_dst.split('_');
    var brc_type = res_arr[0];
    $("#role").val('');
    //alert(res_arr);
    $('#stock_frm').find('input').removeAttr('disabled');
    $.ajax({
        url: url + "api/Branch/getByAdminBranch",
        data: {},
        type: 'POST',
        datatype: 'json',
        success: function(response) {

            //alert(response);
            res = JSON.parse(response);
            //alert(res.data.length);

            //var usercode = $('#selectuser_id').val().trim();

            //var opt = '<option value="">-- Select Admin Bank --</option>';
            var src_opt = dst_opt = '';
            if (res.data.length > 0) {
                //alert(brc_type);

                if (brc_type == "both") {
                    $.each(res.data, function(index, branch) {

                        if (res.admin_role == "SA") {
                            //$(".src_branch_val").text(branch.branch_name);
                            src_opt += '<div class="form-check src_branch' + index + '">\
							<input class="form-check-input" type="radio" name="src_branch" id="src_branch' + index + '" value="' + branch.branch_id + '" >\
							<label class="form-check-label" for="src_branch' + index + '">' + branch.branch_name + '</label>\
							</div>';

                        } else {
                            if (res.branch_id == branch.branch_id) {
                                $(".src_branch_val").text(branch.branch_name);
                                src_opt += '<div class="form-check src_branch' + index + '">\
								<input class="form-check-input" type="radio" name="src_branch" id="src_branch' + index + '" value="' + branch.branch_id + '" checked >\
								<label class="form-check-label" for="src_branch' + index + '">' + branch.branch_name + '</label>\
								</div>';
                            }
                        }
                        if (res.branch_id != branch.branch_id) {
                            dst_opt += '<div class="form-check dst_branch' + index + '">\
							<input class="form-check-input" type="radio" name="dst_branch" id="dst_branch' + index + '" value="' + branch.branch_id + '">\
							<label class="form-check-label" for="dst_branch' + index + '">' + branch.branch_name + '</label>\
							</div>';
                        }
                    });
                    //$(".src_branch_val").text('Source');
                    $("#src_branch_li").html(src_opt);
                    //$(".dst_branch_val").text('Select Destination');
                    $("#dst_branch_li").html(dst_opt);
                } else if (brc_type == "src") {
                    $.each(res.data, function(index, branch) {
                        dst_opt += '<div class="form-check dst_branch' + index + '">\
						<input class="form-check-input" type="radio" name="dst_branch" id="dst_branch' + index + '" value="' + branch.branch_id + '">\
						<label class="form-check-label" for="dst_branch' + index + '">' + branch.branch_name + '</label>\
						</div>';
                    });
                    $(".dst_branch_val").text('Destination');
                    $("#dst_branch_li").html(dst_opt);
                    $(".dst_" + res_arr[1]).hide();

                } else if (brc_type == "dst") {

                    /* $.each(res.data, function(index, branch) {
                    	src_opt += '<div class="form-check src_branch'+index+'">\
                    	<input class="form-check-input" type="radio" name="src_branch" id="src_branch'+index+'" value="'+branch.branch_id+'">\
                    	<label class="form-check-label" for="src_branch'+index+'">'+branch.branch_name+'</label>\
                    	</div>';
                    });	
                    $(".src_branch_val").text('Select Source');
                    $("#src_branch_li").html(src_opt);
                    $(".src_"+res_arr[1]).hide(); */
                } else if (brc_type == "edt") {

                    //alert($("input[name='src_branch']:checked").val());
                    var src_val = $('#hid_srcid').val();
                    $.each(res.data, function(index, branch) {

                        if (res.admin_role == "SA") {
                            src_opt += '<div class="form-check src_branch' + index + '">\
							<input class="form-check-input" type="radio" name="src_branch" id="src_branch' + index + '" value="' + branch.branch_id + '" >\
							<label class="form-check-label" for="src_branch' + index + '">' + branch.branch_name + '</label>\
							</div>';
                            $(".rc_btn").show();
                            //$(".trans_block").hide();
                            $(".unload_block").show();
                            //$(".loading_block").hide();
                            $(".dest_trans_block").show();
                            $("#role").val("SA");
                        } else {
                            if (res.branch_id == branch.branch_id) {
                                //$(".src_branch_val").text(branch.branch_name);
                                src_opt += '<div class="form-check src_branch' + index + '">\
								<input class="form-check-input" type="radio" name="src_branch" id="src_branch' + index + '" value="' + branch.branch_id + '" checked >\
								<label class="form-check-label" for="src_branch' + index + '">' + branch.branch_name + '</label>\
								</div>';
                                $(".rc_btn").hide();
                            }
                        }
                        var disa = "";
                        if (src_val != branch.branch_id) {
                            if (res.admin_role != "SA" && src_val != res.branch_id) { disa = "disabled"; }
                            dst_opt += '<div class="form-check dst_branch' + index + '">\
								<input class="form-check-input" type="radio" name="dst_branch" id="dst_branch' + index + '" value="' + branch.branch_id + '" ' + disa + ' >\
								<label class="form-check-label" for="dst_branch' + index + '">' + branch.branch_name + '</label>\
								</div>';

                        }

                    });
                    $("#dst_branch_li").html(dst_opt);
                    //$("#dst_branch_li").html('');
                    //$(".dst_"+res_arr[1]).hide();
                    $("input[name=dst_branch][value=" + res_arr[1] + "]").prop('checked', true);
                    $("#src_branch_li").html(src_opt);
                    $("input[name=src_branch][value=" + res_arr[2] + "]").prop('checked', true);

                    //$("#dst_branch1").prop("checked", true);
                }

                if (lstatus == 1) {
                    $('#stock_frm').find('input').attr('disabled', 'disabled');
                    $('#stk tr td:last-child,#stk tr th:last-child').hide();
                    $(".rc_btn").hide();
                }
                /* else{
                	$('#stk tr td:last-child,#stk tr th:last-child').show();
                	//$('#stock_frm').find('input').removeAttr('disabled'); 
                } */

            }
        }
    });
}

function amount_with_commas(addoredit, id_val) {
    //alert(id_val);	
    var aeval = "";
    if (addoredit == "edit") { aeval = "_edit"; }
    var textbox = '#' + id_val + aeval;
    var hidden = '#hid_' + id_val + aeval;

    var num = $(textbox).val();
    var comma = /,/g;
    num = num.replace(comma, '');
    $(hidden).val(num);
    var numCommas = addCommas(num);
    $(textbox).val(numCommas);
    /* var amt_word = convertNumberToWords(num);
    if(amt_word != undefined){
    	$('.amon_text'+aeval).html(amt_word);
    } */
}