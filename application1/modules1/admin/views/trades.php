<?php require_once 'header.php' ; ?>
<link href="<?php echo base_url();?>assets/css/trade.css" type="text/css" rel="stylesheet">
<?php require_once 'sidebar.php' ; ?>

<style>
.ui-menu{
  z-index: 999999 !important;
}
.ui-datepicker
{
  z-index: 999999 !important;
}
#snackbar {
  visibility: hidden;
  min-width: 300px;
  margin-left: -150px;
  background-color: red;
  color: #fff;
  text-align: center;
  border-radius: 2px;
  padding: 10px;
  position: absolute;
  z-index: 1;
  left: 50%;
  top: 5px;
  font-size: 17px;
}
.disabledbutton {
    pointer-events: none;
    opacity: 0.4;
}
#snackbar.show {
  visibility: visible;
  -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
  animation: fadein 0.5s, fadeout 0.5s 2.5s;
}
#snackbar1 {
  visibility: hidden;
  min-width: 300px;
  margin-left: -150px;
  background-color: red;
  color: #fff;
  text-align: center;
  border-radius: 2px;
  padding: 10px;
  position: absolute;
  z-index: 1;
  left: 50%;
  top: 5px;
  font-size: 17px;
}

#snackbar1.show {
  visibility: visible;
  -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
  animation: fadein 0.5s, fadeout 0.5s 2.5s;
}
@-webkit-keyframes fadein {
  from {top: 0; opacity: 0;} 
  to {top: 5px; opacity: 1;}
}

@keyframes fadein {
  from {top: 0; opacity: 0;}
  to {top: 5px; opacity: 1;}
}

@-webkit-keyframes fadeout {
  from {top: 5px; opacity: 1;} 
  to {top: 0; opacity: 0;}
}

@keyframes fadeout {
  from {top: 5px; opacity: 1;}
  to {top: 0; opacity: 0;}
}
.required { border:  1px solid red; }
</style>
<div class="right_blk"> 
      <div class="top_ttl_blk"> <span class="padin_t_5">Trades  </span>  
        <span class="crt_link fr">
        <button class="btn btn-primary"> Create Trade </button> 
        <i class="fa fa-times cl_crt_bl hide_blk" aria-hidden="true"></i>
      </span>

         </div>
      <!-- Create Trade Start -->
      <div class="trade_create"> 
         <div class="crt_blk"> 
          <div id="snackbar" class=""></div>
        <h2 class="create_hdg"> Create Trade </h2>
        <div class="ove_auto">
          <form id="tradefrm" name="tradefrm" action="javascript:void(0);" method="post">
            <div class="trd_cr">
                <div class="type_trd rad_btns">
                  <label class="radio-inline radio_blk checkd">
                    <input  type="radio" value="credit" name="trade_type" onclick="return ttype('credit');" checked="checked" >Credit
                  </label>
                  <label class="radio-inline radio_blk">
                    <input type="radio" value="guest" name="trade_type" onclick="return ttype('guest');" >Guest
                  </label>
                </div>

                <div class="cre_inp inp_ss">
                    <div class="sm_blk"> Date </div>
                    <input type="text" maxlength="10" class="form-control mykey" name="trade_date" id="trade_date" value="<?php echo date('d-M-Y'); ?>" >
                </div>

                <!-- Trader start -->
                <div >
                  <div class="form-group cre_inp sel_loc">
                    <div class="sm_blk"> Select Trader </div>
                    <!-- <input type="text" class="form-control" id="tkey" name="tkey" onkeypress="return gettrader();" /> -->
                    <input type="text" class="form-control mykey" id="tkey" name="tkey"  />
                    <input type="hidden" class="form-control" id="traderid" name="traderid" />
                    <!-- <div id="suggesstion-box1"></div> -->
                  </div>
                  <label id="tkey-error" class="error" for="tkey"></label>
                  <div class="form-group cre_inp  sel_loc">
                    <div class="sm_blk"> Select User </div>
                    <!-- <input type="text" class="form-control" id="ukey" name="ukey" onkeypress="return getuser();"/> -->
                    <!-- <div id="suggesstion-box"></div> -->
                    <input type="text" class="form-control mykey" id="ukey" name="ukey" />
                    <input type="hidden" class="form-control" id="userid" name="userid" />
                    <input type="hidden" class="form-control" id="usercode" name="usercode" />
                </div>
                <label id="ukey-error" class="error" for="ukey"></label>
                <div class="form-group cre_inp" style="display: none;" id="guestmobile">
                    <input type="text" class="form-control noalpha mykey" id="mobile" name="mobile" Placeholder=" Enter Mobile " />
                </div>
                <div class="form-group" id="cropdis">
                  <!-- <select class="form-control" id="crop_opt" name="crop_opt" >
                               <option value=""> Select Crop Location </option>
                  </select> -->
                        <div class="check_wt_serc" id="crps"> 
                          <div class="show_va">Crop location</div>
                          <div class="selectVal">  Crop location </div>
                          <ul class="check_list" id="crop_1"> 
                            <li id="crop_opt_li">
                              <div class="form-check">
                                <input class="form-check-input mykey" type="radio" name="crop_opt" id="crop_opt" >
                                <label class="form-check-label" >
                                Crop Location
                                </label>
                              </div>
                            </li>
                          </ul>                       
                        </div>
                        <label id="crop_opt-error" class="error" ></label>
                  </div>
                </div>
                <!-- Expected Count -->
                <b class="exp_ttl"> Expected <a href="#" title="" class="note"> Add Note </a> </b>

                <div class="trd_c_row"> 
                  <div class="trd_c_cel"> 
                    <div class="cre_inp">
                  <div class="sm_blk"> Count </div>
                    <input type="text"  class="form-control mykey" placeholder="" name="exp_count" id="exp_count" >
                 </div>
                  </div>
                  <div class="trd_c_cel"> 
                     <div class="cre_inp">
                  <div class="sm_blk"> Weight(Kgs) </div>
                    <input type="text"  class="form-control mykey" placeholder="" name="exp_weight_kgs" id="exp_weight_kgs">
                 </div>
                  </div>
                </div>

                <div class="trd_c_row frm_prc"> 
                    <div class=""> 
                      <div class="cre_inp">
                        <div class="sm_blk"> Farmer Price </div>
                        <input type="text" maxlength="10" class="form-control noalpha mykey" placeholder="" name="exp_farmer_price_val" id="exp_farmer_price_val" onkeyup="amount_with_commas();" >
                              <input type="hidden" class="form-control" placeholder="" name="exp_farmer_price" id="exp_farmer_price" >
                              
                    </div>
                    <span class="amon_text"> </span>
                      </div>
                      <div class=""> 
                        <div class="cre_inp">
                          <div class="sm_blk"> Company Price </div>
                          <input type="text" maxlength="10" class="form-control noalpha mykey" placeholder="" name="exp_company_price_val" id="exp_company_price_val" onkeyup="amount_with_commasval();">
                                <input type="hidden" class="form-control" placeholder="" name="exp_company_price" id="exp_company_price" >
                              
                      </div>
                        <span class="amon_text1"> </span>
                      </div>
                  </div>
                  <textarea rows="4" placeholder="Note" class="note_txt mykey" name="note" id="note"></textarea>
                </div>

            </div>

        <div class="trd_subm"> 
          <button type="submit" class="btn btn-primary" >Submit</button>
         
        </div> </div>
      </form> 
        </div>
      <!-- Create Trade End -->
      <div class="trd_cr_r">
      <div class="mar_btm_20">
      <div class="card_view dis_tbl">
         <ul class="trd_anl"> 
          <li class="bor_lf_none"> 
            <div class="top_in_op crop_top">
                                    <p> Total Amount </p> 
                                    <h1 id="trade_totalamount"> ₹0 </h1>
                                    </div>
          </li>
          <li class=""> 
            <div class="top_in_op crop_top">
                                    <p> Total Trades </p> 
                                    <h1 id="trade_total"> 0</h1>
                                    </div>
          </li>
          <li class=""> 
            <div class="top_in_op crop_top">
                                    <p> Total Tons </p> 
                                    <h1 id="trade_tons"> 0 </h1>
                                    </div>
          </li>

         </ul>
        <!--  <div class="cl_pal">
        <a href="#" class="fr cl_crt_trd"> <i class="fa fa-times" aria-hidden="true"></i> </a>    
         </div> -->
        
        
         </div>
      </div>
    
<div class="lst_trd">

      <div class="card_view"> 
        <div class="">
          

<!-- <div class="hdg_bk"> Trade List </div> -->
          <div class="res_tbl">
            <div class="dropdowns">
     <button class="btn btn-secondary drp_btn" type="button">
    <i class="fa fa-th-list" aria-hidden="true"></i>
     </button>
 <ul class="sl_menu">
<!--    <li><a class="toggle-vis" data-column="0">Id</a> </li> -->
    <li>
      <a class="toggle-vis" data-column="2">Trader Name</a> </li>
    <li><a class="toggle-vis" data-column="3">User Name</a> </li>
     <li><a class="toggle-vis" data-column="4">Status</a> </li>
<!--       <li> <a class="toggle-vis" data-column="4">Actions</a> </li> -->
       
 </ul>
</div>
        <table id="usr_lst_tbl" cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped " style="width:100%">
            <thead>
              <tr>
                <th class="id_td"> Id </th>
                <th class="date_td"> Date 
                  <span class="sts_pp">
                      <i class="fa fa-filter" aria-hidden="true" style="font-size: 9px;"></i>   
                  </span>
                  <div class="sts_fil_blk"> 
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="month_opt" value="" id="all" checked />
                        <label class="form-check-label" for="this_mnt">All</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="month_opt" value="m" id="this_mnt" />
                        <label class="form-check-label" for="this_mnt">This Month</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="month_opt" value="1m" id="last_mont">
                        <label class="form-check-label" for="last_mont">Last Month</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="month_opt" value="3m" id="last_3mont">
                        <label class="form-check-label" for="last_3mont">Last 3 Months</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="month_opt" value="6m" id="last_6mon">
                        <label class="form-check-label" for="last_6mon">Last 6 Months</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="month_opt" value="1y" id="one_year">
                        <label class="form-check-label" for="one_year">1 Year</label>
                      </div>

                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="month_opt" value="custom" id="choos_date">
                        <label class="form-check-label" for="choos_date">Choose Date</label>
                      </div>

                      <div class="form-group cdate" style="display:none;">
                        <input type="text" id="from_date" name="from_date" class="form-control" placeholder="From date" readonly />
                        <input type="text" id="to_date" name="to_date" class="form-control" placeholder="To date" readonly />
                        <button class="btn btn-primary" id="custom_date">Search</button>
                      </div>
                  </div>
                </th>
                <th> Trader Name  
                  <!-- <span class="sts_pp">
                    <i class="fa fa-filter" aria-hidden="true" style="font-size: 9px;"></i>   
                  </span>
                  <div class="sts_fil_blk"> 

                    <div class="form-group mar_10_t">
                      <input type="text" class="form-control" placeholder="Search Trader" id="trader_searchkey" onkeypress="return gettrader_search();">
                    </div>
       
                    <div class="trd_lst" id="traderslist_search">
                      
                    </div>
                  </div> -->
                </th>
                <th> User Name 
                  <!-- <span class="sts_pp">
                            <i class="fa fa-filter" aria-hidden="true" style="font-size: 9px;"></i>   
                  </span>
                  <div class="sts_fil_blk"> 

                    <div class="form-group mar_10_t">
                      <input type="text" class="form-control" placeholder="Search User" id="user_searchkey" onkeypress="return getuser_search();">
                    </div>
 
                    <div class="trd_lst" id="userlist_search">

                      
                    </div>
                  </div> -->
                </th>
                <th class="stat_blk"> Status 

                  <span class="sts_pp">
                    <i class="fa fa-filter" aria-hidden="true" style="font-size: 9px;"></i>   
                  </span>
                  <div class="sts_fil_blk"> 
                        <div class="">
                                 <div class="form-check chek_bx">
                                      <input class="form-check-input" type="checkbox" name="status_opt" value="1" id="sta1">
                                  <label class="form-check-label" for="sta1">
                                    Completed
                                  </label>
                                </div>
                                <div class="form-check chek_bx">
                                  <input class="form-check-input" type="checkbox" name="status_opt" value="0" id="sta2">
                                  <label class="form-check-label" for="sta2">
                                    Pending
                                  </label>
                                </div>
                        </div>
                  </div>
                </th>
                <th class="act_ms"> Actions </th>
              </tr>
            </thead>

            <tbody> 
                <!-- <tr>
                    <td> 65852 </td>
                    <td> 12-Feb-2020 </td>
                    <td> <a href="<?php echo base_url();?>admin/traders/details" title=""> Trader Name </a> </td>
                    <td> <a href="<?php echo base_url();?>admin/users/detail" title=""> User Name </a> </td>
                    <td class="txt_cnt stat_com"> <i class="fa fa-check" aria-hidden="true"></i> </td>
                    <td class="txt_cnt"> 
                      <i class="fa fa-ellipsis-v act_icn" data-toggle="popover" data-placement="left" tabindex="0" data-trigger="focus" data-toggle="popover" title="Actions" aria-hidden="true"></i>
                      
                </tr> -->
                
               
            </tbody>
        </table>
        <input type="hidden" id="hid_lid" name="hid_lid" />
        </div>
        </div>
      </div>

</div>
</div>
        </div>
<script type="text/javascript">


$( function() {
  $( "#ukey" ).autocomplete({
    //source: url+"api/users/searchusers",
    source: function( request, response ) {
      $('#userid').val('');
      $('#usercode').val('');
      $("#crop_opt").val('');
      $('#mobile').val('');
      var trade_type = $("input[name='trade_type']:checked").val();
     // Fetch data
     $.ajax({
    url: url+"api/trades/searchusers",
    type: 'post',
    dataType: "json",
    data: {
     search: request.term,ttype:trade_type
    },
    success: function( data ) { 
    if(trade_type=='credit')
    {
      if(data == null)
      {
        $("#ukey").val('');
        if(data == null){ err = 1; err_msg = "User not registered!"; tagid = "#ukey";
        return form_validation(err,err_msg,tagid);}
      }
    } 
      
      response( $.map( data, function( result ) {  

      return {  
      label: result.label,
      value: result.value,
      imgsrc: result.img,   
      user_id: result.user_id,
      usercode: result.usercode,
      mobile:result.mobile,
      user_type: result.user_type
      }  

      }));  

    }  
     });
    },
    select: function (event, ui) {
     // Set selection
     if(ui.item.user_type == "NON_FARMER"){ $(".sel_loc").hide();}else{ $(".sel_loc").show(); }
     var trade_type = $("input[name='trade_type']:checked").val();
     if(trade_type=='guest')
     {
        $('#mobile').val(ui.item.mobile);
     }
     $('#ukey').val(ui.item.label); // display the selected text
     $('#userid').val(ui.item.user_id); // save selected id to input
     $('#usercode').val(ui.item.usercode); // save selected id to input
     //return false;
    }
    
   }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {  

           return $( "<li></li>" )  

               .data( "item.autocomplete", item )  

               .append( "<a>" + "<img style='width:25px;height:25px' src='" + item.imgsrc + "' /> " + item.label+ "</a>" )  

               .appendTo( ul );  

  };  
   //user edit


  $( "#ukey_edit" ).autocomplete({
      
    //source: url+"api/users/searchusers",
    source: function( request, response ) {
      $('#userid_edit').val('');
      $('#usercode_edit').val('');
      $("#crop_opt_edit").val('');
      $('#mobile_edit').val('');
      var trade_type = $('#trade_type_edit').val();
      if(trade_type==1)
      {
        var tt = 'guest';
      }
      else
      {
        var tt = 'credit';
      }
     //alert('test');
     $( "#mobile_edit" ).prop( "disabled", false );
     // Fetch data
     $.ajax({
    url: url+"api/trades/searchusers",
    type: 'post',
    dataType: "json",
    data: {
     search: request.term,ttype:tt
    },
    success: function( data ) {
    if(trade_type==0)
    {
      if(data == null)
      {
        $("#ukey_edit").val('');
        if(data == null){ err = 1; err_msg = "User not registered!"; tagid = "#ukey_edit";
        return form_validation1(err,err_msg,tagid);}
      }
    }
        response( $.map( data, function( result ) {  
          //alert(JSON.stringify(result));
          return {  
          label: result.label,
          value: result.value,
          imgsrc: result.img,   
          user_id: result.user_id,
          mobile:result.mobile,
          usercode: result.usercode,
          user_type: result.user_type
          }  

        }));  

    }  
     });
    },
    select: function (event, ui) {
     // Set selection
     
     $('#ukey_edit').val(ui.item.label); // display the selected text
     $('#userid_edit').val(ui.item.user_id); // save selected id to input
     var trade_type = $('#trade_type_edit').val();
     if(trade_type==1)
     {
        $('#mobile_edit').val(ui.item.mobile);
     }
    }
    
   }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {  
    //alert(item.label);
           return $( "<li></li>" )  

               .data( "item.autocomplete", item )  

               .append( "<a>" + "<img style='width:25px;height:25px' src='" + item.imgsrc + "' /> " + item.label+ "</a>" )  

               .appendTo( ul );  

  };  

   //trader
  $( "#tkey" ).autocomplete({
    source: function( request, response ) {
      $('#traderid').val('');
     
     // Fetch data
     $.ajax({
    url: url+"api/trades/searchtrader",
    type: 'post',
    dataType: "json",
    data: {
     search: request.term
    },
    success: function( data ) {  
      if(data == null)
      {
        //$("#tkey").val('');
        if(data == null){ err = 1; err_msg = "Trader not registered!"; tagid = "#tkey";
        return form_validation(err,err_msg,tagid);}
      }
      response( $.map( data, function( result ) {  
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
    select: function (event, ui) {
     // Set selection
     $('#tkey').val(ui.item.label); // display the selected text
     $('#traderid').val(ui.item.user_id); // save selected id to input
     //return false;
    }
    
   }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {  
      //alert(item.label);
           return $( "<li></li>" )  

               .data( "item.autocomplete", item )  

               .append( "<a>" + "<img style='width:25px;height:25px' src='" + item.imgsrc + "' /> " + item.label+ "</a>" )  

               .appendTo( ul );  

    };  
   //trader edit
   $( "#tkey_edit" ).autocomplete({
    source: function( request, response ) {
      $('#traderid_edit').val('');
     
     // Fetch data
     $.ajax({
    url: url+"api/trades/searchtrader",
    type: 'post',
    dataType: "json",
    data: {
     search: request.term
    },
    success: function( data ) {  
      if(data == null)
      {
        
        if(data == null){ err = 1; err_msg = "Trader not registered!"; tagid = "#tkey_edit";
        return form_validation1(err,err_msg,tagid);}
      }
      response( $.map( data, function( result ) {  
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
    select: function (event, ui) {
     // Set selection
     $('#tkey_edit').val(ui.item.label); // display the selected text
     $('#traderid_edit').val(ui.item.user_id); // save selected id to input
     //return false;
    }
    
   }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {  
      
           return $( "<li></li>" )  

               .data( "item.autocomplete", item )  

               .append( "<a>" + "<img style='width:25px;height:25px' src='" + item.imgsrc + "' /> " + item.label+ "</a>" )  

               .appendTo( ul );  

    };  
   
});
function ttype(val)
{
  if(val=='guest')
  {
      $('#guestmobile').show();
      $('#cropdis').hide();
      $('#ukey').val('');
       $('#userid').val('');
        $('#usercode').val('');
        $('#mobile').val('');
  }
  else
  {
     $('#guestmobile').hide();
     $('#cropdis').show();
     $('#ukey').val('');
       $('#userid').val('');
        $('#usercode').val('');
        $('#mobile').val('');
  }
}
function getusercrops(user_id,addoredit)
{
  var aeval = hidcrop = "";
  if(addoredit == "edit"){ aeval = "_edit"; hidcrop = $("#hid_crop_id").val();}
  $.ajax({    
    url: url+"api/UserCrops/index/"+user_id,
    data: {},
    type:'POST',    
    datatype:'json',
    success : function(response){
      
      //alert(response);
      res= JSON.parse(response);        
      //alert(res.data.length);
      
      //var usercode = $('#select_usercode'+aeval).val();
      var user_id = $('#userid'+aeval).val();
      var sel = "";
      if(user_id != "")
      {
        //var opt = '<option value="">-- Select Crop --</option>';
        var opt = "";
        if(res.data.length > 0)
        {
          $.each(res.data, function(index, crop) {
            
            if(crop.cd_id == hidcrop){ sel = "checked"; }else{ sel = "";}
            
            opt += '<div class="form-check"><input class="form-check-input" type="radio" name="crop_opt'+aeval+'" id="crp'+index+aeval+'" value="'+crop.cd_id+'" '+sel+' /><label class="form-check-label" for="crp'+index+aeval+'">'+crop.crop_location+'</label></div>';
          });
        }
      }else{
        //var opt = '<option value="">-- Select user first --</option>';
        var opt = '';
      }
      $("#crop_opt_li"+aeval).html(opt);
      //$("#crop_opt"+aeval).select2('refresh');
      //document.getElementById("crop_opt"+aeval).fstdropdown.rebind();
    }
  });
}
function getusercrops1(user_id,addoredit)
{
  
  var aeval = hidcrop = "";
  if(addoredit == "edit"){ aeval = "_edit"; hidcrop = $("#hid_crop_id").val();}
  $.ajax({    
    url: url+"api/UserCrops/index/"+user_id,
    data: {},
    type:'POST',    
    datatype:'json',
    success : function(response){
      
      //alert(response);
      res= JSON.parse(response);        
      //alert(res.data.length);
      
      //var usercode = $('#select_usercode'+aeval).val();
      var user_id = $('#userid_edit'+aeval).val();
      var sel = "";
      if(user_id != "")
      {
        //var opt = '<option value="">-- Select Crop --</option>';
        var opt = "";
        if(res.data.length > 0)
        {
          $.each(res.data, function(index, crop) {
            
            if(crop.cd_id == hidcrop){ sel = "checked"; }else{ sel = "";}
            
            opt += '<div class="form-check"><input class="form-check-input" type="radio" name="crop_opt'+aeval+'" id="crp'+index+aeval+'" value="'+crop.cd_id+'" '+sel+' /><label class="form-check-label" for="crp'+index+aeval+'">'+crop.crop_location+'</label></div>';
          });
        }
      }else{
        //var opt = '<option value="">-- Select user first --</option>';
        var opt = '';
      }
      $("#crop_opt_li"+aeval).html(opt);
      //$("#crop_opt"+aeval).select2('refresh');
      //document.getElementById("crop_opt"+aeval).fstdropdown.rebind();
    }
  });
}
function clickaction(id)
{
  $("#hid_lid").val(id);
}
function clickactionview(id)
{
  $("#hid_lid").val(id);
  $(".edt").trigger("click");
}
function addCommas(x) {
  x=x.toString();
  var lastThree = x.substring(x.length-3);
  var otherNumbers = x.substring(0,x.length-3);
  if(otherNumbers != '')
  lastThree = ',' + lastThree;
  //var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
  var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/, ",") + lastThree;

  return res;
}
function amount_with_commas(addoredit)
{
  var aeval = "";
  if(addoredit == "edit"){ aeval = "_edit";}
  var textbox = '#exp_farmer_price_val'+aeval;
  var hidden = '#exp_farmer_price'+aeval;
    
  var num = $('#exp_farmer_price_val').val();
  var comma = /,/g;
  num = num.replace(comma,'');
  $('#exp_farmer_price').val(num);
  var numCommas = addCommas(num);
  $(textbox).val(numCommas);
  var amt_word = convertNumberToWords(num);
  if(amt_word != undefined){
    $('.amon_text'+aeval).html(amt_word);
  }
  //});
}
function amount_with_commasval(addoredit)
{
  var aeval = "";
  if(addoredit == "edit"){ aeval = "_edit";}
  var textbox = '#exp_company_price_val'+aeval;
  var hidden = '#exp_company_price'+aeval;
  
 
  var num = $('#exp_company_price_val').val();
  var comma = /,/g;
  num = num.replace(comma,'');
  $('#exp_company_price').val(num);
  var numCommas = addCommas(num);
  $(textbox).val(numCommas);
  var amt_word = convertNumberToWords(num);
  if(amt_word != undefined){
    $('.amon_text1'+aeval).html(amt_word);
  }
  //});
}
function amount_with_commasedit(addoredit)
{
  var aeval = "";
  if(addoredit == "edit"){ aeval = "_edit";}
  var textbox = '#exp_farmer_price_val_edit'+aeval;
  var hidden = '#exp_farmer_price_edit'+aeval;
  
    
  var num = $('#exp_farmer_price_val_edit').val();
  var comma = /,/g;
  num = num.replace(comma,'');
  $('#exp_farmer_price_edit').val(num);
  var numCommas = addCommas(num);
  $(textbox).val(numCommas);
  var amt_word = convertNumberToWords(num);
  if(amt_word != undefined){
    $('.amon_text2'+aeval).html(amt_word);
  }
}
function amount_with_commasedit_val(addoredit)
{
  var aeval = "";
  if(addoredit == "edit"){ aeval = "_edit";}
  var textbox = '#exp_company_price_val_edit'+aeval;
  var hidden = '#exp_company_price_edit'+aeval;
  
 
  var num = $('#exp_company_price_val_edit').val();
  var comma = /,/g;
  num = num.replace(comma,'');
  $('#exp_company_price_edit').val(num);
  var numCommas = addCommas(num);
  $(textbox).val(numCommas);
  var amt_word = convertNumberToWords(num);
  if(amt_word != undefined){
    $('.amon_text3'+aeval).html(amt_word);
  }
  //});
}
$(document).ready(function () {


      $('html').click(function (e){
        if(e.target.id=='tkey' ){
          $('#suggesstion-box1').show();
        }
        else{
          $('#suggesstion-box1').hide();  
        }
      });


});

var url = '<?php echo base_url()?>';
function selectVal(id,val) {

    var tn = val.replace("-", " ");
    $("#tkey").val(tn);
    $("#traderid").val(id);
    $("#suggesstion-box1").hide();

}
//edit selection
function selectVal_edit(id,val) {

    var tn = val.replace("-", " ");
    $("#tkey_edit").val(tn);
    $("#traderid_edit").val(id);
    $("#suggesstion-box1_edit").hide();

}
//get crop locations
function selectVal1(id,val,code)
{
  $.ajax({    
    url: url+"api/UserCrops/index/"+id,
    data: {},
    type:'POST',    
    datatype:'json',
    success : function(response){
      
      res= JSON.parse(response);        
      
        var opt = '<option value="">-- Select Crop --</option>';
        if(res.data.length > 0)
        {
          $.each(res.data, function(index, crop) {
            opt += '<option value="'+crop.id+'" >'+crop.crop_location+'</option>';
          });
        }
      
      $("#crop_opt").html(opt);
      var tn = val.replace("-", " ");
      $("#ukey").val(tn);
      $("#userid").val(id);
      $("#usercode").val(code);
      $("#suggesstion-box").hide();
      //$("#crop_opt"+aeval).select2('refresh');
      //document.getElementById("crop_opt"+aeval).fstdropdown.rebind();
    }
  });
}
//edit get crop locations
//get crop locations
function selectVal1_edit(id,val,code)
{
  $.ajax({    
    url: url+"api/UserCrops/index/"+id,
    data: {},
    type:'POST',    
    datatype:'json',
    success : function(response){
      
      res= JSON.parse(response);        
      
        var opt = '<option value="">-- Select Crop --</option>';
        if(res.data.length > 0)
        {
          $.each(res.data, function(index, crop) {
            opt += '<option value="'+crop.cd_id+'" >'+crop.crop_location+'</option>';
          });
        }
      
      $("#crop_opt_edit").html(opt);
      var tn = val.replace("-", " ");
      $("#ukey_edit").val(tn);
      $("#userid_edit").val(id);
      $("#suggesstion-box_edit").hide();
      //$("#crop_opt"+aeval).select2('refresh');
      //document.getElementById("crop_opt"+aeval).fstdropdown.rebind();
    }
  });
}
function getuser_search()
{
  $.ajax({    
              url: url+"api/trades/users",
              data: {txt:$("#user_searchkey").val()},
              type:'POST',    
              datatype:'json',
              success : function(response){     
                
                res= JSON.parse(response);
                
                var opt = '';
                if(res.data.length > 0)
                {
                  $.each(res.data, function(index, brand) {
                    var tname = brand.user_name.replace(/[_\W]+/g, "-");
                    opt += '<div class="form-check"><input class="form-check-input" type="checkbox" name="userval" value="' + brand.user_id + '" id="usr'+brand.user_id+'"><label class="form-check-label" for="usr'+brand.user_id+'">' + brand.user_name + '</label></div>';
                  });
                }
                
                $("#userlist_search").html(opt);
                
              }
  });
}
function gettrader_search()
{
  $.ajax({    
              url: url+"api/trades/traders",
              data: {txt:$("#trader_searchkey").val()},
              type:'POST',    
              datatype:'json',
              success : function(response){     
                
                res= JSON.parse(response);
                
                var opt = '';
                if(res.data.length > 0)
                {
                  $.each(res.data, function(index, brand) {
                    var tname = brand.firm_name.replace(/[_\W]+/g, "-");
                    opt += '<div class="form-check"><input class="form-check-input" type="checkbox" name="traderval" value="' + brand.td_id + '" id="trdd'+brand.td_id+'"><label class="form-check-label" for="trdd'+brand.td_id+'">' + brand.firm_name + '</label></div>';
                  });
                }
                
                $("#traderslist_search").html(opt);
                
              }
            });
}
// get traders
function gettrader()
{
  var trk = $("#tkey").val();
  if(trk.length>1)
  {
    $.ajax({    
        url: url+"api/trades",
        data: {txt:$("#tkey").val()},
        type:'POST',    
        datatype:'json',
        success : function(response){     
          
          res= JSON.parse(response);
          
          var opt = "<ul>";
          if(res.data.length > 0)
          {
            $.each(res.data, function(index, brand) {
              var tname = brand.firm_name.replace(/[_\W]+/g, "-");
              opt += '<li onclick=selectVal("' + brand.td_id + '","'+tname+'"); >' + brand.firm_name + '</li>';
            });
          }
          opt +="</ul>";
          $("#suggesstion-box1").show();
          $("#suggesstion-box1").html(opt);
        }
    });
  }
      
}
//get traders edit
function gettraderedit()
{
  var trk = $("#tkey_edit").val();
  if(trk.length>1)
  {
      $.ajax({    
        url: url+"api/trades",
        data: {txt:$("#tkey_edit").val()},
        type:'POST',    
        datatype:'json',
        success : function(response){     
          
          res= JSON.parse(response);
          
          var opt = "<ul>";
          if(res.data.length > 0)
          {
            
            $.each(res.data, function(index, brand) {
              var tname = brand.firm_name.replace(/[_\W]+/g, "-");
              opt += '<li onclick=selectVal_edit("' + brand.td_id + '","'+tname+'"); >' + brand.firm_name + '</li>';
            });
          }
          opt +="</ul>";
          $("#suggesstion-box1_edit").show();
          $("#suggesstion-box1_edit").html(opt);
          
        }
      });
  }
}
//get user edit
function getuseredit()
{
  var trk = $("#ukey_edit").val();
  if(trk.length>1)
  {
      $.ajax({    
        url: url+"api/trades/users",
        data: {txt:$("#ukey_edit").val()},
        type:'POST',    
        datatype:'json',
        success : function(response){     
          
          res= JSON.parse(response);
          
          var opt = "<ul>";
          if(res.data.length > 0)
          {
            $.each(res.data, function(index, brand) {
              var tname = brand.user_name.replace(/[_\W]+/g, "-");
              opt += '<li onclick=selectVal1_edit("' + brand.user_id + '","'+tname+'","'+brand.user_id+'"); >' + brand.user_name + '</li>';
            });
          }
          opt +="</ul>";
          $("#suggesstion-box_edit").show();
          $("#suggesstion-box_edit").html(opt);
          
        }
      });
  }
}
//get users
function getuser()
{
  var trk = $("#ukey").val();
  if(trk.length>1)
  {
      $.ajax({    
        url: url+"api/trades/users",
        data: {txt:$("#ukey").val()},
        type:'POST',    
        datatype:'json',
        success : function(response){     
          
          res= JSON.parse(response);
          
          var opt = "<ul>";
          if(res.data.length > 0)
          {
            $.each(res.data, function(index, brand) {
              var tname = brand.user_name.replace(/[_\W]+/g, "-");
              opt += '<li onclick=selectVal1("' + brand.user_id + '","'+tname+'","'+brand.user_id+'"); >' + brand.user_name + '</li>';
            });
          }
          opt +="</ul>";
          $("#suggesstion-box").show();
          $("#suggesstion-box").html(opt);
          
        }
      });
  }
}






/*delete trade*/
$(document).ready(function() {

    /*GET USERS*/
            $.ajax({    
              url: url+"api/trades/users",
              data: {txt:''},
              type:'POST',    
              datatype:'json',
              success : function(response){     
                
                res= JSON.parse(response);
                
                var opt = '';
                if(res.data.length > 0)
                {
                  $.each(res.data, function(index, brand) {
                    var tname = brand.user_name.replace(/[_\W]+/g, "-");
                    opt += '<div class="form-check"><input class="form-check-input" type="checkbox" name="userval" value="' + brand.user_id + '" id="usr'+brand.user_id+'"><label class="form-check-label" for="usr'+brand.user_id+'">' + brand.user_name + '</label></div>';
                  });
                }
                
                $("#userlist_search").html(opt);
                
              }
            });
            /*GET TRADERS*/
            $.ajax({    
              url: url+"api/trades/traders",
              data: {txt:''},
              type:'POST',    
              datatype:'json',
              success : function(response){     
                
                res= JSON.parse(response);
                
                var opt = '';
                if(res.data.length > 0)
                {
                  $.each(res.data, function(index, brand) {
                    var tname = brand.firm_name.replace(/[_\W]+/g, "-");
                    opt += '<div class="form-check"><input class="form-check-input" type="checkbox" name="traderval" value="' + brand.td_id + '" id="trdd'+brand.td_id+'"><label class="form-check-label" for="trdd'+brand.td_id+'">' + brand.firm_name + '</label></div>';
                  });
                }
                
                $("#traderslist_search").html(opt);
                
              }
            });



    var table = $('#usr_lst_tbl').DataTable({
      /*'ordering': false,
      language: {
        searchPlaceholder: "Search Trades",
        search: "",
        "dom": '<"toolbar">frtip'
      }*/
      'ordering': false,
      'processing': true,
        'serverSide': true,
        'serverMethod': 'post',   
         language: {
        searchPlaceholder: "Search Trades",
        search: "",
        "dom": '<"toolbar">frtip'
        },
        "columnDefs": [/* {
        'targets': [0,1,3,4,5,7,9], // column index (start from 0)
        'orderable': false, // set orderable false for selected columns
       }, */
     
      { className: "id_td", "targets": 0 },
        
      ],
        "order": [[ 1, 'desc' ]],
        'ajax': {
           'url':url+'api/trades/gettrades',
           'data': function(data){
              var multi_status = [];
              $.each($("input[name='status_opt']:checked"), function(){
                multi_status.push($(this).val());
              });

              var month_opt = $("input[name='month_opt']:checked").val();
              var from_date = $("#from_date").val();
              var to_date = $("#to_date").val();
              var userval = $("input[name='userval']:checked").val();
              var traderval = $("input[name='traderval']:checked").val();
              var tabval = $("#hid_tabval").val();
              var status_opt = multi_status;
            
              data.month_opt = month_opt;
              data.from_date = from_date;
              data.to_date = to_date;
              data.userval = userval;
              data.traderval = traderval;
              data.status_opt = status_opt;
           },
           "dataSrc": function (json) {    
          
            $("#trade_totalamount").html('₹'+addCommas(json.tot_amt)); 
            $("#trade_total").html(json.tot_rec);
            $("#trade_tons").html(json.tot_count);

              setInterval(function(){ 
                  $('.act_icn').popover({
                  html: true,
                  content: function() {
                    return $('#popover-content').html();
                  }
                }); 
              }, 2000);   

            return json.data;
          }
        }
      
     
    });

    $("input[name='month_opt']").on('click',function() {

    	  var date_val = $("input[name='month_opt']:checked").val(); 
		    if(date_val == "custom"){ $(".cdate").show(); }
        else{ $(".cdate").hide(); table.draw(); }

	  });

	
  	$("input[name='status_opt']").on('click',function() {		
  		table.draw();
  	});

    $("#custom_date").click(function(){   
  
    table.draw();
    });
    $("#from_date").change(function(e){   
    
      e.stopPropagation()
    });
    
    //form submit start create trade
  //Form submit
  $("#tradefrm").submit(function(e) {  


    var trade_date = $("#trade_date").val();
    var tkey = $("#tkey").val();
    var ukey = $("#ukey").val();
    var traderid = $("#traderid").val();
    var userid = $("#userid").val();    
    /*var crop_opt = $("#crop_opt").val();*/
    var len = $(':radio[name="crop_opt"]:checked').length;
    var exp_count = $("#exp_count").val();
    var exp_weight_kgs = $("#exp_weight_kgs").val(); 
    var exp_farmer_price_val = $("#exp_farmer_price_val").val();
    var exp_company_price_val = $("#exp_company_price_val").val();

    var trade_type = $("input[name='trade_type']:checked").val();

    if(tkey == ""){ err = 1; err_msg = "Please search trader!"; tagid = "#tkey";
        return form_validation(err,err_msg,tagid);}
    if(traderid == ""){ err = 1; err_msg = "Trader is not registered!"; tagid = "#traderid";
        return form_validation(err,err_msg,tagid);}

    if(ukey == ""){ err = 1; err_msg = "Please search user!"; tagid = "#ukey";
        return form_validation(err,err_msg,tagid);}  
    if(userid == ""){ err = 1; err_msg = "User is not registered!"; tagid = "#userid";
        return form_validation(err,err_msg,tagid);}  

    if(trade_type == "guest")
    {     
      var mobile = $("#mobile").val();  
      if(mobile == ""){ err = 1; err_msg = "Please enter mobile!"; tagid = "#mobile";
        return form_validation(err,err_msg,tagid);}     
    } 
    if(trade_type == "credit")
    { 
    if(len == 0 ){ err = 1; err_msg = "Please select crop location!"; tagid = "#crop_1";
        return form_validation(err,err_msg,tagid);}
    }
    if(exp_count == ""){ err = 1; err_msg = "Please enter count!"; tagid = "#exp_count";
        return form_validation(err,err_msg,tagid);}
    if(exp_weight_kgs == ""){ err = 1; err_msg = "Please enter weight!"; tagid = "#exp_weight_kgs";
        return form_validation(err,err_msg,tagid);}
    if(exp_farmer_price_val == ""){ err = 1; err_msg = "Please enter farmer price!"; tagid = "#exp_farmer_price_val";
        return form_validation(err,err_msg,tagid);}
    if(exp_company_price_val == ""){ err = 1; err_msg = "Please enter company price!"; tagid = "#exp_company_price_val";
        return form_validation(err,err_msg,tagid);}         

    /*form submit*/
    formData = new FormData(tradefrm);    
        
          $.ajax({
            url: url+"api/trades/add",
            data: formData,
            type:'POST',
            contentType: false,
            processData: false,
            enctype: 'multipart/form-data',
            datatype:'json',
            success : function(response)
            {           
              res= JSON.parse(response);
              if(res.status == 'success')
              { 
                new PNotify({
                  title: 'Success',
                  text: "Trade created successfully!",
                  type: 'success',
                  shadow: true
                });
                
                //setInterval('location.reload()', 2000);
                table.ajax.reload(); 
                $(".crt_link").trigger("click");        
              }
              else{
                new PNotify({
                  title: 'Error',
                  text: 'Something went wrong, try again!',
                  type: 'failure',
                  shadow: true
                });
              }         
            }
     }); 
    /*form submit*/
  });
//form submit end create trade

/*form edit*/
$("#tradefrm_edit").submit(function(e) {

          var trade_date_edit = $("#trade_date_edit").val();
          var tkey_edit = $("#tkey_edit").val();
          var traderid_edit = $("#traderid_edit").val();

          var ukey_edit = $("#ukey_edit").val(); 
          var userid_edit = $("#userid_edit").val();   
         
          var len = $(':radio[name="crop_opt_edit"]:checked').length;
          var exp_count_edit = $("#exp_count_edit").val();
          var exp_weight_kgs_edit = $("#exp_weight_kgs_edit").val(); 
          var exp_farmer_price_val_edit = $("#exp_farmer_price_val_edit").val();
          var exp_company_price_val_edit = $("#exp_company_price_val_edit").val();

          var trade_type = $("#trade_type_edit").val();

           if(tkey_edit == ""){ err = 1; err_msg = "Please search trader!"; tagid = "#tkey_edit";
              return form_validation1(err,err_msg,tagid);}
           if(traderid_edit == ""){ err = 1; err_msg = "Trader is not registered!"; tagid = "#tkey_edit";
            return form_validation1(err,err_msg,tagid);}


           if(ukey_edit == ""){ err = 1; err_msg = "Please search user!"; tagid = "#ukey_edit";
              return form_validation1(err,err_msg,tagid);} 
           if(userid_edit == ""){ err = 1; err_msg = "User is not registered!"; tagid = "#ukey_edit";
            return form_validation1(err,err_msg,tagid);} 

          if(trade_type == 1)
          {     
            var mobile = $("#mobile_edit").val();  
            if(mobile == ""){ err = 1; err_msg = "Please enter mobile!"; tagid = "#mobile_edit";
              return form_validation1(err,err_msg,tagid);}     
          } 
          if(trade_type == 0)
          { 
            if(len == 0 ){ err = 1; err_msg = "Please select crop location!"; tagid = "#crp_e1";
              return form_validation1(err,err_msg,tagid);}
          }
          if(exp_count_edit == ""){ err = 1; err_msg = "Please enter count!"; tagid = "#exp_count_edit";
              return form_validation1(err,err_msg,tagid);}
          if(exp_weight_kgs_edit == ""){ err = 1; err_msg = "Please enter weight!"; tagid = "#exp_weight_kgs_edit";
              return form_validation1(err,err_msg,tagid);}
          if(exp_farmer_price_val_edit == ""){ err = 1; err_msg = "Please enter farmer price!"; tagid = "#exp_farmer_price_val_edit";
              return form_validation1(err,err_msg,tagid);}
          if(exp_company_price_val_edit == ""){ err = 1; err_msg = "Please enter company price!"; tagid = "#exp_company_price_val_edit";
              return form_validation1(err,err_msg,tagid);}         

          
          formData = new FormData(tradefrm_edit);    
              
                $.ajax({
                  url: url+"api/trades/update",
                  data: formData,
                  type:'POST',
                  contentType: false,
                  processData: false,
                  enctype: 'multipart/form-data',
                  datatype:'json',
                  success : function(response)
                  {           
                    res= JSON.parse(response);
                    if(res.status == 'success')
                    { 
                      new PNotify({
                        title: 'Success',
                        text: "Trade updated successfully!",
                        type: 'success',
                        shadow: true
                      });
                      
                      //setInterval('location.reload()', 2000);
                      table.ajax.reload(); 
                      $(".pp_clss").trigger("click");  
                                    
                    }
                    else{
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

    $(".updt_btn").click(function(){

      $('#status').val(1);
    });
/*form edit*/

    /*delete*/
    $(".del_yes").click(function(){
        
        var delval = $("#hid_lid").val();
        $.ajax({    
            url: url+"api/trades/delete",
            data: {tid:delval},
            type:'POST',    
            datatype:'json',
            success : function(response){       
              
              res= JSON.parse(response);      
              
              if(res.status == 'success')
              { 
                new PNotify({
                  title: 'Success',
                  text: "Trade deleted successfully!",
                  type: 'success',
                  shadow: true
                }); 
                //var dataTable = $('#brd_lst_tbl').DataTable();
               //setInterval('location.reload()', 2000);
               table.ajax.reload();
              }       
            }
        });
    });
    /*delete*/

    $('.note').click(function(){
      $('.note_txt').toggleClass('show');
    });
    $("div.toolbar").html('<b>SSS</b>');
        $('a.toggle-vis').on( 'click', function (e) {
            $(this).parent().toggleClass('act');
            e.preventDefault();
            var column = table.column( $(this).attr('data-column') );
            column.visible( ! column.visible() );
        } );

    // $('.dataTables_length').text('Trade List');

    $('.dataTables_length').html('<h2 class="create_hdg lng_hdg">  Trade List </h2>');

 $('.adds_blk').click(function(){
        
       
        var k = $(this).text();
        $('.adds_blk').removeClass('fl_wth');
        $(this).addClass('fl_wth');

         $('.fl_wth').click(function(){
            $(this).siblings('.tool_tip').text(k);
           $(this).siblings('.tool_tip').show();
        });

        $('.fl_wth').mouseout(function(){
             $('.tool_tip').hide();
         $('.tool_tip').text('');
        });

    });

//  $('.drp_btn').click(function(){
//             $('.sl_menu').toggleClass('show');
// });

 $('.ad_mr_trd').click(function(){
    $('.sec_blk').css('display', 'table');
 });

  $(document).mouseup(function(e) 
  {
      var fl_cnt = $('.adds_blk');
      if (!fl_cnt.is(e.target) && fl_cnt.has(e.target).length === 0) 
      {
          $('.adds_blk ').removeClass('fl_wth');
      }

  });

  $('.crt_link').click(function(){
      $('.trade_create').toggleClass('sh_trade_create');
      $('.trd_cr_r').toggleClass('trd_cr_r_r');
      $(this).find('.btn').toggleClass('hide_blk');
      $('.cl_crt_bl').toggleClass('hide_blk');
      // $(this).toggleClass('crt_link');
      
  });
 
  $('body').css('display', 'block');

  $('#exp_far, #exp_cmp').keyup(function(){

      var e_cnt =  $('#mul1').val();
      var e_far = $('#exp_far').val();
      var e_cmp = $('#exp_cmp').val();
      if(e_cnt != null){
        if(e_far != ''){
          if(e_cmp != ''){
              $('.expected_blk').show();
          }
        }     
      }
  });

 /* $('.act_icn').popover({
    html: true,
    content: function() {
      return $('#popover-content').html();
    }

  });*/
  $('#mobile').blur(function(){
    
    var user_id = $("#userid").val().trim();
    var ukey = $("#ukey").val().trim();
    var mobile = $("#mobile").val().trim();
    if(user_id == "")
    {
      if(ukey!='' && mobile!='')
      {
          $.ajax({    
                url: url+"api/trades/insertguest",
                data: {ukey:ukey,mobile:mobile},
                type:'POST',    
                datatype:'json',
                success : function(response1){
                  
                  rescp1 = JSON.parse(response1);        
                    //alert(JSON.stringify(rescp1));
                   if(rescp1.status=='success')
                   {
                    $("#userid").val(rescp1.insert_id);
                    var err_msg= 'Guest user added successfully';
                    $("#snackbar").text(err_msg);
                    $("#snackbar").addClass("show");
                    setTimeout(function(){ $("#snackbar").removeClass("show"); }, 3000);
                   
                   }

                }
          });
      }
    }
  });
  $('#mobile_edit').blur(function(){
    $( "#mobile_edit" ).prop( "disabled", false );
    var user_id = $("#userid_edit").val().trim();
    var ukey = $("#ukey_edit").val().trim();
    var mobile = $("#mobile_edit").val().trim();
    if(user_id == "")
    {
      if(ukey!='' && mobile!='')
      {
        $.ajax({    
            url: url+"api/trades/insertguest",
            data: {ukey:ukey,mobile:mobile},
            type:'POST',    
            datatype:'json',
            success : function(response1){
              
              rescp1 = JSON.parse(response1);        
               // alert(JSON.stringify(rescp1));
               if(rescp1.status=='success')
               {
                $("#userid_edit").val(rescp1.insert_id);
                var err_msg= 'Guest user added successfully';
                $("#snackbar1").text(err_msg);
                $("#snackbar1").addClass("show");
                setTimeout(function(){ $("#snackbar").removeClass("show"); }, 3000);
               
               }

            }
          });
      }
          
    }
  });
  $('#ukey').blur(function(){
    //var usercode = $(this).val();   
    //var usercode = $("#select_usercode").val().trim();
    var user_id = $("#userid").val().trim();
    if(user_id != "")
    {
      getusercrops(user_id,'add');
     
    }else{
      var opt = '<option value="">-- Select Crop --</option>';
      $("#crop_opt").html(opt); $("#crop_opt").val('');   
       
      //document.getElementById("crop_opt").fstdropdown.rebind();
      //document.getElementById("bank_opt").fstdropdown.rebind();
      
    }     
  });
  $('#ukey_edit').blur(function(){
    //var usercode = $(this).val();   
    //var usercode = $("#select_usercode").val().trim();
    var user_id = $("#userid_edit").val().trim();
    if(user_id != "")
    {
      getusercrops1(user_id,'add');
     
    }else{
      var opt = '<option value="">-- Select Crop --</option>';
      $("#crop_opt_edit").html(opt); $("#crop_opt_edit").val('');   
       
      //document.getElementById("crop_opt").fstdropdown.rebind();
      //document.getElementById("bank_opt").fstdropdown.rebind();
      
    }     
  });
  $(document).on("click", ".del", function() {
   $('#delete_trade').modal();
  });


$(document).on("click", ".edt", function() {

  var lid = $("#hid_lid").val();

          $("#ukey_edit").val('');
          $("#tkey_edit").val('');
          $("#userid_edit").val('');
          $("#traderid_edit").val('');
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

  $.ajax({    
    //url: url+"api/loans/index/"+lid,
    url: url+"api/trades/tradedetails/"+lid,
    data: {},
    type:'POST',    
    datatype:'json',
    success : function(response){
      res= JSON.parse(response);
       $("#trade_id").val(lid);
        
         //$('.edt_bl_lnk').parent().siblings('ul').toggleClass('disb_sel');
         //$('.prc_txt_area').removeAttr('aria-describedby');
         var endv = $("#endis").val();
         if(endv==1)
         {
         	$(".edt_bl_lnk").trigger("click");
         	$("#endis").val(0);
         }
         	

          if(res.data.tradetype==1)
          {
            $("#crplist_edit").hide();
            $("#mobiledis").show();
            $("#mobile_edit").val(res.data.guest_mobile);
            $("#mobile_edit").prop( "disabled", true );
          }
          else
          {
            $("#crplist_edit").show();
            $("#mobiledis").show();
            $("#mobiledis").hide();
          }

          $("#trade_type_edit").val(res.data.tradetype);
          $("#ukey_edit").val(res.data.user_name);
          if(res.data.trader_type=='Agent')
          {
          	$("#tkey_edit").val(res.data.full_name);
          }
          else
          {
          	$("#tkey_edit").val(res.data.firm_name+' ( '+res.data.contact_person+' )');
          }
          

          $("#userid_edit").val(res.data.userid);
          $("#traderid_edit").val(res.data.trader_id);
          /*$("#crop_opt_edit").val(res.data.crop_loc);*/
          var a=$.datepicker.formatDate( "dd-M-yy", new Date(res.data.trade_date));
  

          $("#trade_date_edit").val(a);
          $("#exp_count_edit").val(res.data.exp_count);
          $("#exp_weight_kgs_edit").val(res.data.exp_weight_kgs);
          $("#exp_farmer_price_val_edit").val(res.data.exp_farmer_price);
          $("#exp_farmer_price_edit").val(res.data.exp_farmer_price);
          $("#exp_company_price_val_edit").val(res.data.exp_company_price);
          $("#exp_company_price_edit").val(res.data.exp_company_price);
          $("#note_edit").val(res.data.note);
          $("#status").val(res.data.status);
          
          if(res.data.status==1)
          {
            $('#edthide').hide();
            $('#fnhide').hide();
            $('#upthide').hide();
            $("#expenses").prop("readonly", true);
            $("#labfee").prop("readonly", true);
           
          }
          else
          {
            $('#edthide').show();
            $('#fnhide').show();
            $('#upthide').show();
            $("#expenses").prop("readonly", false);
            $("#labfee").prop("readonly", false);
          }

          amount_with_commasedit();
          amount_with_commasedit_val();

          $('#cweight').html(res.data.company_fweight);

          $('#camount').html(addCommas(res.data.company_fprice));
          $('#fweight').html(res.data.farmer_fweight);
          $('#famount').html(addCommas(res.data.farmer_fprice));

          $('#cweightval').val(res.data.company_fweight);
          $('#camountval').val(addCommas(res.data.company_fprice));
          $('#fweightval').val(res.data.farmer_fweight);
          $('#famountval').val(addCommas(res.data.farmer_fprice));

          $('#expenses').val(res.data.expenses_farmer);
          $('#labfee').val(res.data.labfee_framer);
          var gttot = parseInt(res.data.expenses_farmer) + parseInt(res.data.gtotal) + parseInt(res.data.labfee_framer);
          $('#gtotalval').val(res.data.gtotal);
          $('#gtotal').html(addCommas(gttot));
          //$('#crop_opt_edit option:eq('+res.data.crop_loc+')').attr('selected', true);
                  /*$('#invoiceItem').html('');*/
          //htmlRows = "";
          /*get trade actual details*/
            $.ajax({    
            url: url+"api/trades/tradeactualdetails/"+lid,
            data: {},
            type:'POST',    
            datatype:'json',
            success : function(response){
              res1 = JSON.parse(response);
              htmlRows = "";
              if(res1.data.length>0)
              {
                $('#rcntval').val(res1.data.length);
                $.each(res1.data, function(index, trades) {
                	$("#tcount10").prop("disabled", true);
          			$("#tcount11").prop("disabled", true);
                	

                  var tcamtt = addCommas(trades.company_amount);
                  var tfamtt = addCommas(trades.farmer_amount);

                   var a=$.datepicker.formatDate( "dd-M-yy", new Date(trades.trade_date));

                  htmlRows = '<tr id="rowNums'+trades.id+'"><td> <input type="text" class="form-control mykey" placeholder="" name="tdate[]" id="tdate'+trades.id+'" value="'+a+'" onkeydown="return false;"></td><td class="cnt_wth"><input maxlength="7" type="text" class="form-control mykey" placeholder="" name="tcount[]" id="tcount'+trades.id+'" value="'+trades.count+'" onkeypress="return onlyNumberKey(event)" ></td><td class="bor_t_b_none"><div> &nbsp;</div></td><td class="weig"><input type="text" class="form-control mykey" placeholder="" maxlength="9" name="tcprice[]" id="tcprice_'+trades.id+'" value="'+trades.company_price+'" onkeypress="return onlyNumberKey(event)" ></td><td class="com_bg weig" width="80"> <input type="text" class="form-control mykey" placeholder="" name="tcweight[]" id="tcweight_'+trades.id+'" value="'+trades.company_weight+'" onkeypress="return onlyNumberKey(event)" ></td><td class="com_bg amn_blk"><input type="text" class="form-control mykey" placeholder="" readonly name="tcamount[]" id="tcamount_'+trades.id+'" value="'+tcamtt+'" onkeypress="return onlyNumberKey(event)" ><input type="hidden" class="form-control mykey" placeholder="" readonly name="tcamountval[]" id="tcamountval_'+trades.id+'" value="'+trades.company_amount+'" ></td><td class="bor_t_b_none"><div> &nbsp;</div></td><td class="far_bg weig"> <input type="text" maxlength="9" class="form-control mykey" placeholder="" name="tfprice[]" id="tfprice_'+trades.id+'" value="'+trades.farmer_price+'" ></td><td class="far_bg weig" width="80" onkeypress="return onlyNumberKey(event)" ><input type="text" class="form-control mykey" placeholder="" name="tfweight[]" id="tfweight_'+trades.id+'" value="'+trades.farmer_weight+'" ></td><td class="far_bg amn_blk" onkeypress="return onlyNumberKey(event)" > <input type="text" class="form-control" placeholder="" readonly name="tfamount[]" id="tfamount_'+trades.id+'" value="'+tfamtt+'" ><input type="hidden" class="form-control noalpha mykey" placeholder="" readonly name="tfamountval[]" id="tfamountval_'+trades.id+'" value="'+trades.farmer_amount+'" onkeypress="return onlyNumberKey(event)"><input type="hidden" class="form-control noalpha mykey" placeholder="" readonly name="hid_acivity_id[]" id="hid_acivity_id_'+trades.id+'" value="'+trades.id+'"> </td></tr>';

                  $('#invoiceItem').append(htmlRows);

                  var dateToday = new Date();
                  $("#tdate"+trades.id).datepicker({
                    dateFormat: 'dd-M-yy',
                    defaultDate: trades.trade_date,
                    changeMonth: true,
                    changeYear: true,
                    minDate: dateToday,
                    numberOfMonths: 1
                  });
                    if(res.data.status==1)
          			{
          				$(".mykey").prop("disabled", true);
          			}
          			else
          			{
          				$(".mykey").prop("disabled", false);
          			}

                });
                htmlRows = '<tr id="rowNums0"><td> <input type="text" class="form-control mykey" placeholder="" name="tdate[]" id="tdate0" onkeydown="return false;"></td><td class="cnt_wth"><input maxlength="7" type="text" class="form-control mykey" placeholder="" name="tcount[]" id="tcount0" onkeypress="return onlyNumberKey(event)"></td><td class="bor_t_b_none"><div> &nbsp;</div></td><td class="weig"><input type="text" class="form-control mykey" placeholder="" maxlength="9" name="tcprice[]" id="tcprice_0" onkeypress="return onlyNumberKey(event)"></td><td class="com_bg weig" width="80"> <input type="text" class="form-control mykey" placeholder="" name="tcweight[]" id="tcweight_0" onkeypress="return onlyNumberKey(event)" ></td><td class="com_bg amn_blk"><input type="text" class="form-control mykey" placeholder="" readonly name="tcamount[]" id="tcamount_0"  ><input type="hidden" class="form-control mykey" placeholder="" readonly name="tcamountval[]" id="tcamountval_0"></td><td class="bor_t_b_none"><div> &nbsp;</div></td><td class="far_bg weig"> <input type="text" maxlength="9" class="form-control mykey" placeholder="" name="tfprice[]" id="tfprice_0" onkeypress="return onlyNumberKey(event)"></td><td class="far_bg weig" width="80"><input type="text" class="form-control mykey" placeholder="" name="tfweight[]" id="tfweight_0" onkeypress="return onlyNumberKey(event)" ></td><td class="far_bg amn_blk"> <input type="text" class="form-control mykey" placeholder="" readonly name="tfamount[]" id="tfamount_0" ><input type="hidden" class="form-control mykey" plcrpsaceholder="" readonly name="tfamountval[]" id="tfamountval_0" ><input type="hidden" class="form-control mykey" placeholder="" readonly name="hid_acivity_id[]" id="hid_acivity_id_0" value="0"> </td></tr>';
          
                    $('#invoiceItem').append(htmlRows);
                    if(res.data.status==1)
          			{
          				$(".mykey").prop("disabled", true);
          			}
          			else
          			{
          				$(".mykey").prop("disabled", false);
          			}

                  var dateToday = new Date();
                  $("#tdate0").datepicker({
                    dateFormat: 'dd-M-yy',
                    changeMonth: true,
                    changeYear: true,
                    minDate: dateToday,
                    numberOfMonths: 1
                  });
              }
              else
              {

                  htmlRows = '<tr id="rowNums0"><td> <input type="text" class="form-control mykey" placeholder="" name="tdate[]" id="tdate0" onkeydown="return false;"></td><td class="cnt_wth"><input maxlength="7" type="text" class="form-control mkey" placeholder="" name="tcount[]" id="tcount0" onkeypress="return onlyNumberKey(event)" ></td><td class="bor_t_b_none"><div> &nbsp;</div></td><td class="weig"><input type="text" class="form-control mkey" placeholder="" maxlength="9" name="tcprice[]" id="tcprice_0" onkeypress="return onlyNumberKey(event)" ></td><td class="com_bg weig" width="80"> <input type="text" class="form-control mkey" placeholder="" name="tcweight[]" id="tcweight_0" onkeypress="return onlyNumberKey(event)" ></td><td class="com_bg amn_blk"><input type="text" class="form-control" placeholder="" readonly name="tcamount[]" id="tcamount_0"  onkeypress="return onlyNumberKey(event)" ><input type="hidden" class="form-control " placeholder="" readonly name="tcamountval[]" id="tcamountval_0"></td><td class="bor_t_b_none"><div> &nbsp;</div></td><td class="far_bg weig"> <input type="text" maxlength="9" class="form-control mkey" placeholder="" name="tfprice[]" id="tfprice_0" onkeypress="return onlyNumberKey(event)" ></td><td class="far_bg weig" width="80"><input type="text" class="form-control mkey" placeholder="" name="tfweight[]" id="tfweight_0" onkeypress="return onlyNumberKey(event)" ></td><td class="far_bg amn_blk"> <input type="text" class="form-control" placeholder="" readonly name="tfamount[]" id="tfamount_0" ><input type="hidden" class="form-control " placeholder="" readonly name="tfamountval[]" id="tfamountval_0" ><input type="hidden" class="form-control " placeholder="" readonly name="hid_acivity_id[]" id="hid_acivity_id_0" value="0"> </td></tr>';
        
                  $('#invoiceItem').append(htmlRows);

                  var dateToday = new Date();
                  $("#tdate0").datepicker({
                    dateFormat: 'dd-M-yy',
                    changeMonth: true,
                    changeYear: true,
                    minDate: dateToday,
                    numberOfMonths: 1
                  });
              }
              
            }
          });
          /*get trade actual details*/
          
          /*get crop details*/
             
            $.ajax({    
            url: url+"api/UserCrops/index/"+res.data.userid,
            data: {},
            type:'POST',    
            datatype:'json',
            success : function(response1){
              
              rescp1 = JSON.parse(response1);        
                var aeval = '_edit';
                var opt = '';
                if(rescp1.data.length > 0)
                {
                  $.each(rescp1.data, function(index, crop) {
                    
                    
                    if(crop.cd_id == res.data.location)
                    { 
                       sel = "checked"; 
                       $(".crop_type_val").text(crop.crop_location); 
                    }
                    else
                    { 
                      sel = "";
                    }
            
                    opt += '<div class="form-check"><input class="form-check-input" type="radio" name="crop_opt_edit" id="crp'+index+aeval+'" value="'+crop.cd_id+'" '+sel+' /><label class="form-check-label" for="crp'+index+aeval+'">'+crop.crop_location+'</label></div>';
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

});

$('.pp_clss').click(function(){
    $('#edt_user_id').hide();
   $('.ap_blk').hide();
   $('.popover').remove();
    $('.prc_txt_area').removeAttr('aria-describedby');
});

$('.crt_blk').click(function(){
  $('.cl_crt_trd').show();
  $(this).addClass('cre_all_blk');
  // $('.alpha').addClass('ful_alpha');
  // $('.trd_anl').addClass('wth_100');

});
 // $('.crt_link').tooltip();
$('.cl_crt_trd').click(function(){
  $('.crt_blk').removeClass('cre_all_blk');
  $('.trd_anl').removeClass('wth_100');
  $(this).hide();
  $('.sec_blk').hide();
    $('.trd_cr input[type=text]').val('');
    $(".trd_cr input[type=radio]"). prop("checked", true);
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
$('.remv_blk').click(function(){
  $('.sec_blk').hide();
});


$('.ap_blk').click(function(){
  $('#edt_user_id').hide();
  $(this).hide();
});



});
function onlyNumberKey(evt) { 
          
        // Only ASCII charactar in that range allowed 
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode 
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) 
            return false; 
        return true; 
    }
</script>
<div class="modal" id="delete_trade">
  <div class="modal-dialog">
     <div class="modal-content">
      <div class="modal-body">
        <h1> Are You Sure ! </h1>
        <p> You want delete this Trade </p>
      </div>
      <div class="modal_footer">

        <button type="button" class="btn btn-primary del_yes" data-dismiss="modal">Yes</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
      </div>
     </div>
  </div>
</div>


<div id="popover-content" style="display: none">
  <div class="custom-popover">
      <ul class="list-group">
        <li class="list-group-item edt">Edit</li>
        <li class="list-group-item del">Delete</li>
      </ul>
  </div>
</div>

<div class="ap_blk"> </div>
<div id="edt_user_id">
  <form id="tradefrm_edit" name="tradefrm_edit" action="javascript:void(0);" method="post">
      <div class="pp_clss"> <i class="fa fa-times" aria-hidden="true"></i> </div>
      <div class="tr_exp_dtl">
      <div id="snackbar1" class=""></div>
          <div class="hdg_bks"> Trade Expected Details </div>
          <div class="over_x_hdn">
            <div class="pop_min_h_div">
            <div class="top_no_txt">
              <!-- <i id="edthide" class="fa fa-edit edt_bl_lnk" aria-hidden="true"></i> -->
              <span id="edthide" class="material-icons edt_bl_lnk">edit</span>
              <input type="hidden" id="endis" value="0">
        <ul class="top_exp_blk disb_sel">
            
            <li> 
              <div class="cre_inp inp_ss">
                <div class="sm_blk"> Trader </div>
                <!-- <input type="text" class="form-control" placeholder="" data-original-title="" title="" value="" name="tkey_edit" id="tkey_edit" onkeypress="return gettraderedit();" > -->
                <!-- <div id="suggesstion-box1_edit"></div> -->
                <input type="text" class="form-control mykey" placeholder="" data-original-title="" title="" value="" name="tkey_edit" id="tkey_edit"  >
                <input type="hidden" class="form-control"  value="" name="trade_type_edit" id="trade_type_edit"  >
              </div>
            </li>
            <li> 
              <div class="cre_inp inp_ss">
                <div class="sm_blk"> User</div>
                  <!-- <input type="text" class="form-control" placeholder="" data-original-title="" name="ukey_edit" id="ukey_edit" onkeypress="return getuseredit();" >
                  <div id="suggesstion-box_edit"></div> -->
                  <input type="text" class="form-control mykey" placeholder="" data-original-title="" name="ukey_edit" id="ukey_edit"  >
              </div>
            </li>
            <li id="mobiledis" style="display: none;"> 
              <div class="cre_inp inp_ss">
                <div class="sm_blk"> Mobile</div>
                
                  <input type="text" class="form-control mykey noalpha"  placeholder="" data-original-title="" name="mobile_edit" id="mobile_edit"  >
              </div>
            </li>
            <li> 
               <div class="check_wt_serc val_seld" id="crplist_edit"> 
                          <div class="show_va">Crop location</div>
                          <div class="selectVal  crop_type_val">  Crop location </div>
                          <ul class="check_list" id="crp_e1"> 
                            <li id="crop_opt_li_edit">
                              <div class="form-check">
                                <input class="form-check-input mykey" type="radio" name="crop_opt_edit" id="crop_opt_edit" required value="">
                                <label class="form-check-label" for="crp">
                                Crop Location
                                </label>
                              </div>
                            </li>
                          </ul> 
                           <label id="crop_opt-error" class="error" for="crop_opt"></label>                      
                        </div>
                       
            </li>
        </ul>
        <ul class="btm_exp_blk disb_sel">
              <li class="dt_inp"> 
                <div class="cre_inp inp_ss">
                  <div class="sm_blk"> Date </div>
                  <input type="text" maxlength="10" class="form-control mykey" placeholder="" name="trade_date_edit" id="trade_date_edit" onkeydown="return false;">
              </div>
              </li>
              <li class="count_inp"> 
                <div class="cre_inp inp_ss">
                  <div class="sm_blk"> Count </div>
                  <input type="text" class="form-control mykey" placeholder="" value="" name="exp_count_edit" id="exp_count_edit">
              </div>
            </li>

              <li class="wt_inp"> 
                 <div class="cre_inp inp_ss">
                  <div class="sm_blk"> Weight </div>
                  <input type="text" class="form-control mykey" placeholder="" value="" name="exp_weight_kgs_edit" id="exp_weight_kgs_edit">
              </div>
              </li>
            <li class="prc_inp"> 
                <div class="cre_inp inp_ss">
                  <div class="sm_blk"> Farmer Price </div>
                  <input type="text" maxlength="10" class="form-control noalpha mykey" placeholder="" value="" name="exp_farmer_price_val_edit" id="exp_farmer_price_val_edit" onkeyup="amount_with_commasedit();" >
                  <input type="hidden" class="form-control noalpha mykey" name="exp_farmer_price_edit" id="exp_farmer_price_edit" >
                  <!-- <span class="amon_text2"> </span> -->
              </div>
            </li>
            <li class="prc_inp"> 
                <div class="cre_inp inp_ss">
                  <div class="sm_blk"> Company Price </div>
                  <input type="text" maxlength="10" class="form-control noalpha" placeholder="" value="" name="exp_company_price_val_edit" id="exp_company_price_val_edit" onkeyup="amount_with_commasedit_val();" >
                  <input type="hidden" class="form-control noalpha mykey" name="exp_company_price_edit" id="exp_company_price_edit" >
                  <!-- <span class="amon_text3"> </span> -->
             </div>
            </li>

             <li class="not_li note_blk"> <a href="" title="" class="ad_note" data-toggle="modal"> Note </a> 
              <div class="note_entr">
           
             <div class="form-group note_area"> 
              <textarea placeholder="Note" id="note_edit" name="note_edit" class="mykey"></textarea>
             </div>
             <!-- <div class="pop_footer"> <button type="button" class="btn btn-primary updt_btn">Add</button> </div> -->
          

           </div>
           </li>

             <!--  <li class="prc_txt_area"> 
                  <div class="cre_inp inp_ss">
                <div class="sm_blk"> Note </div>
                  <textarea class="form-control" placeholder="" name="note_edit" id="note_edit"></textarea>
              </div>
             </li> -->
        </ul>
      </div>
  
    <div class="tr_act_dtls">
        <div class="hdg_bks"> Trade Actual Details  <!-- <a href="#" title="" class="fr"> Add More </a> --> </div>
        <div class="pop_res_tbl">
          <table class="actl_tbl table" cellspacing="0" cellpadding="0" border="0">
            <thead>
              <tr> 
                <th colspan="2"> </th>
                <th class="bor_t_b_none"> <div> &nbsp;</div> </th>
                <th colspan="3" class="com_bg"> Final Company Details</th>
                <th class="bor_t_b_none"> <div> &nbsp;</div> </th>
                <th colspan="3" class="far_bg"> Final Farmer Details </th>
              </tr>
              <tr> 
                <td> Date </td>
                <td class="cnt_wth"> Count </td>
                <td class="bor_t_b_none"> <div> &nbsp;</div> </td>
                <td class="com_bg"> Price </td>      
                <td class="com_bg weig"> Weight(Kgs) </td>
                <td class="com_bg"> Amount </td>
                <td class="bor_t_b_none"> <div> &nbsp;</div> </td>
                <td class="far_bg"> Price </td>
                <td class="far_bg weig"> Weight(Kgs) </td>
                <td class="far_bg"> Amount </td>
              </tr>
            </thead>
            <tbody id="invoiceItem">
               <input type="hidden" name="rcntval" id="rcntval" >
            </tbody>
            <tfoot>
            <tr> 
                <td colspan="2" class="total"> </td>
                <td class="bor_t_b_none"> <div> &nbsp;</div> </td>
                <td>  </td>
                <td class="txt_rt" > <span id="cweight" > 0 </span> </td>
                <td class="total" > <span id="camount" > 0 </span> </td>
                <td class="bor_t_b_none"> <div> &nbsp;</div> </td>
                <td></td>
                <td class="txt_rt" > <span id="fweight" > 0 </span> </td>
                <td class="total"> <span id="famount" > 0 </span> </td>
              </tr>
                <tr> 
                  <td colspan="2" class="pad_none"> </td>
                  <td class="bor_t_b_none"> <div> &nbsp;</div> </td>
                  <td colspan="3" class="pad_none"> </td>
                  <td class="bor_t_b_none"> <div> &nbsp;</div> </td>
                  <td colspan="3" class="pad_none"> 
                    <table class="extra_tbl">
                    <tr>   
                        <td class="far_bg"> Expenses  </td>
                        <td class="far_bg" width="120"> <input type="text" class="form-control noalpha" placeholder="" id="expenses" name="expenses" > </td>
                    </tr>
                    <tr>
                      <td class="far_bg"> Lab Fee </td>
                        <td class="far_bg" width="120"> <input type="text" class="form-control noalpha" placeholder="" id="labfee" name="labfee"  > </td>
                    </tr>
                      <tr>
                        <td class="far_bg"> <b>Grand Total</b></td>
                        <input type="hidden" class="form-control" name="gtotalval" id="gtotalval" >
                        <input type="hidden" class="form-control" name="cweightval" id="cweightval" >
                        <input type="hidden" class="form-control" name="camountval" id="camountval" >
                        <input type="hidden" class="form-control" name="fweightval" id="fweightval" >
                        <input type="hidden" class="form-control" name="famountval" id="famountval" >
                        <input type="hidden" class="form-control" name="status" id="status" value="0">
                        <td class="txt_rt far_bg"> <b id="gtotal">0</b> </td>
                    </tr>
                </table> 
                  </td>
              </tr>
            </tfoot>
          </table>
        </div>
        <div class="clr_btn"> </div>
      </div>
    </div>
        <div class="sb_btm"> 
          <input type="hidden" id="trade_id" name="trade_id" />
          <input type="hidden"  id="userid_edit" name="userid_edit" >
          <input type="hidden"  id="traderid_edit" name="traderid_edit" >
          <button class="fr btn btn-success updt_btn" id="fnhide" > Finish Trade </button>
            <button type="submit" class="fr btn btn-primary" id="upthide" >Update</button>  
          </div>
    </div>
  </div>
  </form>
</div>
<!-- Trader Actual Details --> 
<script type="text/javascript">
$(document).ready(function() {
  var dateToday = new Date();
  $("#trade_date").datepicker({
    dateFormat: 'dd-M-yy',
    changeMonth: true,
    changeYear: true,
    minDate: dateToday,
    numberOfMonths: 1
  });
  $("#trade_date_edit").datepicker({
    dateFormat: 'dd-M-yy',
    changeMonth: true,
    changeYear: true,
    minDate: dateToday,
    numberOfMonths: 1
  });

  $("#from_date").datepicker({
    dateFormat: 'dd-M-yy',
    //defaultDate: "+1w",   
    changeMonth: true,
    changeYear: true,
    //minDate: dateToday,   
    numberOfMonths: 1,
        onSelect: function (selected) {
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
        onSelect: function (selected) {
      str = selected.split("-").join(" ");
            var dt = new Date(str);
            dt.setDate(dt.getDate() - 1);     
            $("#from_date").datepicker("option", "maxDate", dt);
      $(this).parent().parent('.sts_fil_blk').addClass('show');
      $(this).parent().parent().parent().children('.sts_pp').addClass('ad_tgl');
        }
    });
});
function form_validation(err,err_msg,tagid)
{
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
  setTimeout(function(){ $("#snackbar").removeClass("show"); }, 3000);
  $(tagid).parent().css("border", "1px solid red");
  //$("#tname").css("border", "1px solid red");
  $(tagid).focus();
  return false;
}
function form_validation1(err,err_msg,tagid)
{
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
  setTimeout(function(){ $("#snackbar1").removeClass("show"); }, 3000);
  $(tagid).parent().css("border", "1px solid red");
  //$("#tname").css("border", "1px solid red");
  $(tagid).focus();
  return false;
}
    $(document).ready(function(){
      $('.edt_bl_lnk').click(function(){
      	var dnd = $("#endis").val();
      	if(dnd==0)
      	{
      		$("#endis").val(1);
      	}
      	else
      	{
      		$("#endis").val(0);
      	}
      	
        $(this).toggleClass('opacity_1');
          $(this).parent().find('ul').toggleClass('disb_sel');
           $('.popover').remove();
           $('.prc_txt_area').removeAttr('aria-describedby');
      });
      $('.disb_sel .prc_txt_area').popover({
      html: true,
      content: function() {
        return $('#note_cnt').html();
      }

      });
    });

    //form submit for trade update

  

    
    /*calculations*/
    // company price
  $(document).on('blur', "[id^=tcweight_]", function() {
    var id = $(this).attr('id');
    id = id.replace("tcweight_", '');
    var qty = $(this).val();  
    calculateTotal();
  }); 

    $(document).on('blur', "[id^=tcprice_]", function() {
        calculateTotal();
    }); 

    $(document).on('keyup', "[id^=tfprice_]", function() {
        var id = $(this).attr('id');
        id = id.replace("tfprice_", '');
        var tcp = $('#tcprice_'+id).val();
        var tfp = $('#tfprice_'+id).val();
        /*alert(tfp);
        alert(tcp);*/
        if(tcp=='')
        {
          if(tcp == ""){ err = 1; err_msg = "Please enter company price!"; tagid = "#tcprice_"+id; 
          return form_validation1(err,err_msg,tagid); }
          return false;
        }
       if(parseInt(tfp)>parseInt(tcp))
        {
          $('#tfprice_'+id).val('');
          if(parseInt(tfp)>parseInt(tcp)){ err = 1; err_msg = "Farmer price less than company price!"; tagid = "#tfprice_"+id; 
          return form_validation1(err,err_msg,tagid); }
           return false;
        }
        calculateTotal1();
    });

    //farmer price

      $(document).on('blur', "[id^=tfweight_]", function() {

        var status = $('#status').val();
        
        if(status==1)
        {
          return false;
        }
        else
        {
      var id = $(this).attr('id');
      id = id.replace("tfweight_", '');
      var qty = $(this).val();  
      calculateTotal1();
      var rowNum = id;
      
      /*appending*/
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
      
      if(tdt0=='' )
      {
        if(tdt0 == '' ){ err = 1; err_msg = "Please select date!"; tagid = "#tdate0";
        return form_validation1(err,err_msg,tagid);}
       
        return false;
      }
      if(tdt1=='' )
      {
        if(tdt1 == '' ){ err = 1; err_msg = "Please select date!"; tagid = "#tdate1";
        return form_validation1(err,err_msg,tagid);}
       
        return false;
      }
      if(tdt=='' )
      {
        if(tdt == '' ){ err = 1; err_msg = "Please select date!"; tagid = "#tdate"+ id;
        return form_validation1(err,err_msg,tagid);}
       
        return false;
      }
      if(tcnt=='')
      {
        if(tcnt == '' ){ err = 1; err_msg = "Please enter count!"; tagid = "#tcount"+ id;
        return form_validation1(err,err_msg,tagid);}
       
        return false;
      }
      if(tcp=='')
      {
        if(tcp == '' ){ err = 1; err_msg = "Please enter price!"; tagid = "#tcprice_"+ id;
        return form_validation1(err,err_msg,tagid);}
       
        return false;
      }
      else if(tcw=='')
      {
        if(tcw == '' ){ err = 1; err_msg = "Please enter weight!"; tagid = "#tcweight_"+ id;
        return form_validation1(err,err_msg,tagid);}
       
        return false;
      }
      else if(tfp=='')
      {
        if(tfp == '' ){ err = 1; err_msg = "Please enter price!"; tagid = "#tfprice_"+ id;
        return form_validation1(err,err_msg,tagid);}

        return false;
      }
      else if(qty!='' && tcnt0!='' && tcp0!='' && tfp0!='' && tcw0!='' && tfw0!='')
      {
        rowNum ++;
       
        htmlRows = '<tr id="rowNums'+rowNum+'"><td> <input type="text" class="form-control mykey" placeholder="" name="tdate[]" id="tdate'+rowNum+'" onkeydown="return false;" ></td><td class="cnt_wth"><input maxlength="7" type="text" class="form-control noalpha mykey" placeholder="" name="tcount[]" id="tcount'+rowNum+'" onkeypress="return onlyNumberKey(event)" > </td><td class="bor_t_b_none"><div> &nbsp;</div></td><td class="weig"><input type="text" class="form-control mykey" placeholder="" maxlength="9" name="tcprice[]" id="tcprice_'+rowNum+'" onkeypress="return onlyNumberKey(event)" ></td><td class="com_bg weig" width="80"> <input type="text" class="form-control mykey" placeholder="" name="tcweight[]" id="tcweight_'+rowNum+'" onkeypress="return onlyNumberKey(event)" ></td><td class="com_bg amn_blk"><input type="text" class="form-control mykey" placeholder="" readonly name="tcamount[]" id="tcamount_'+rowNum+'"  ><input type="hidden" class="form-control mykey" placeholder="" readonly name="tcamountval[]" id="tcamountval_'+rowNum+'"></td><td class="bor_t_b_none"><div> &nbsp;</div></td><td class="far_bg weig"> <input type="text" maxlength="9" class="form-control mykey" placeholder="" name="tfprice[]" id="tfprice_'+rowNum+'" onkeypress="return onlyNumberKey(event)" ></td><td class="far_bg weig" width="80"><input type="text" class="form-control mykey" placeholder="" name="tfweight[]" id="tfweight_'+rowNum+'" onkeypress="return onlyNumberKey(event)"></td><td class="far_bg amn_blk"> <input type="text" class="form-control mykey" placeholder="" readonly name="tfamount[]" id="tfamount_'+rowNum+'" ><input type="hidden" class="form-control mykey" placeholder="" readonly name="tfamountval[]" id="tfamountval_'+rowNum+'" ><input type="hidden" class="form-control noalpha mykey" placeholder="" readonly name="hid_acivity_id[]" id="hid_acivity_id_'+rowNum+'" value="0"> </td></tr>';

        $('#invoiceItem').append(htmlRows);

                    var dateToday = new Date();
                    $("#tdate"+rowNum).datepicker({
                      dateFormat: 'dd-M-yy',
                      changeMonth: true,
                      changeYear: true,
                      minDate: dateToday,
                      numberOfMonths: 1
                    });
      }
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
      
      if(id>0)
      {
        var qty = $(this).val();
        if(qty=='' && status==0)
        {
          
          var thid = $('#hid_acivity_id_' + id).val();
          var tdt = $('#tdate' + id).val();
          var tcp = $('#tcprice_' + id).val();
          var tfp = $('#tfprice_' + id).val();
          var tcw = $('#tcweight_' + id).val();
          var tfw = $('#tfweight_' + id).val();
          var thid = $('#hid_acivity_id_' + id).val();

          var ttid = $("#trade_id").val();
          if(thid>0 )
          {
            if(tcp=='' && tfp=='' && tcw=='' && tfw=='')
            {
              if (confirm('Are you sure you want to remove')) {
                
                    $.ajax({    
                        url: url+"api/trades/tradesdelete",
                        data: {tid:thid,tradeid:ttid},
                        type:'POST',    
                        datatype:'json',
                        success : function(responseff){  
                            res= JSON.parse(responseff);     
                            $('#cweight').html(res.data.company_fweight);
                            $('#camount').html(addCommas(res.data.company_fprice));
                            $('#fweight').html(res.data.farmer_fweight);
                            $('#famount').html(addCommas(res.data.farmer_fprice));

                            $('#cweightval').val(res.data.company_fweight);
                            $('#camountval').val(addCommas(res.data.company_fprice));
                            $('#fweightval').val(res.data.farmer_fweight);
                            $('#famountval').val(addCommas(res.data.farmer_fprice));

                            $('#expenses').val(res.data.expenses_farmer);
                            $('#labfee').val(res.data.labfee_framer);
                            var gttot = parseInt(res.data.expenses_farmer) + parseInt(res.data.gtotal) + parseInt(res.data.labfee_framer);
                            $('#gtotalval').val(res.data.gtotal);
                            $('#gtotal').html(addCommas(gttot));
                        }
                    });

                    $('#rowNums'+id).remove();
              } 
            }
          }
          else
          {
            if(tcp=='' && tfp=='' && tcw=='' && tfw=='' && tdt=='')
            {
              $('#rowNums'+id).remove();
            }
          }
          
        }
      }
    });

  /*calculations*/
/*form submit for trade update*/
function calculateTotal() {
    var cweightTot = 0;
    var camountTot = 0;
    /*var gtot = $('#gtotalval').val();*/   
    var grandTotal = 0;
    

    $("[id^='tcprice_']").each(function() {
        var id = $(this).attr('id');
        id = id.replace("tcprice_", '');
        var tcprice = $("#tcprice_" + id).val();
        var tcweight = $('#tcweight_' + id).val();
        var tcw = 1;

        var total = tcprice * tcweight;
        $('#tcamount_' + id).val(addCommas(total));
        $('#tcamountval_' + id).val(total);
        var tcwt = tcw * tcweight;
       
        grandTotal += total;
        cweightTot += tcwt;
        camountTot += total;

    });

    var expenses = $('#expenses').val();
    var labfee = $('#labfee').val();
    var famountval = $('#famountval').val();
    var cwt = addCommas(cweightTot);
    $('#cweight').html(cweightTot);
    var cmt = addCommas(camountTot);
    $('#camount').html(cmt);

    if(expenses!='' && expenses!=NaN )
    {
      
    }
    else
    {
      expenses = 0;
    }

    if(labfee!='' && labfee!=NaN )
    { 
      
    }
    else
    {
      labfee = 0;
    }

    var GrandTot = parseInt(grandTotal) + parseInt(expenses) + parseInt(labfee);
    //$('#gtotal').html(addCommas(GrandTot));

    //$('#gtotalval').val(grandTotal);
    $('#cweightval').val(cweightTot);
    $('#camountval').val(camountTot);
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

        var total = tfprice * tfweight;
        $('#tfamount_' + id).val(addCommas(total));
        $('#tfamountval_' + id).val(total);
        var tfwt = tfw * tfweight;

        grandTotal += total;
        fweightTot += tfwt;
        famountTot += total;

    });
    var expenses = $('#expenses').val();
    var labfee = $('#labfee').val();
    var camountval = $('#camountval').val();

    if(expenses!='' && expenses!=NaN )
    {
      
    }
    else
    {
      expenses = 0;
    }

    if(labfee!='' && labfee!=NaN )
    { 
      
    }
    else
    {
      labfee = 0;
    }

    var GrandTot = parseInt(grandTotal) + parseInt(expenses) + parseInt(labfee);
    $('#gtotal').html(addCommas(GrandTot));
    $('#fweight').html(fweightTot);
    var cmt = addCommas(famountTot);
    $('#famount').html(cmt);

    
    $('#gtotalval').val(grandTotal);
    $('#fweightval').val(fweightTot);
    $('#famountval').val(famountTot);
}

$('.noalpha').keypress(function(event){
        
       if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
           event.preventDefault(); //stop character from entering input
       }

      });
</script>
<div id="note_cnt"> 
 
</div>
<?php require_once 'footer.php' ; ?><link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<style type="text/css">
.sorting, .sorting_asc, .sorting_desc {
    background : none !important;
}
</style>