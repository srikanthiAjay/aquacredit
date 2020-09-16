<?php require_once 'header.php' ; ?>

<link href="<?php echo base_url();?>assets/css/trade.css" type="text/css" rel="stylesheet">
<?php require_once 'sidebar.php' ; ?>
<script src='https://kit.fontawesome.com/a076d05399.js'></script>		
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
          
          <h2 class="create_hdg"> Create Trade </h2>
        <div class="ove_auto">
	        <form id="tradefrm" name="tradefrm" action="javascript:void(0);" method="post">
	        	<div class="trd_cr">
	             	<div class="cre_inp">
      			  			<div class="sm_blk"><!--  Date  --></div>
      			    		<input type="date" maxlength="10" class="form-control" name="trade_date" id="trade_date" >
      			 		</div>

	 				      <!-- Trader start -->
      	 				<div class="row">
      						<div class="form-group col-md-12">
      	 						<input type="text" class="form-control" id="tkey" name="tkey" Placeholder="Search Trader" onkeypress="return gettrader();" />
                    <input type="hidden" class="form-control" id="traderid" name="traderid" />
                    <div id="suggesstion-box1"></div>
      	 					</div>
      	 					<div class="form-group col-md-12">
      	 						<input type="text" class="form-control" id="ukey" name="ukey" Placeholder=" Search User " onkeypress="return getuser();"/>
                    <div id="suggesstion-box"></div>
      	 						<input type="hidden" class="form-control" id="userid" name="userid" />
                    <input type="hidden" class="form-control" id="usercode" name="usercode" />

      							
      	 					</div>
      	 					<div class="form-group col-md-12">
      	 							<select class="form-control" id="crop_opt" name="crop_opt" >
      											   <option value="">-- Select Crop Location --</option>
      								</select>
      								<label id="crop_opt-error" class="error" for="crop_opt"></label>
      						</div>
      	 				</div>
	          		<!-- Expected Count -->
	          		<b class="exp_ttl"> Expected <a href="#" title="" class="note"> Add Note </a> </b>

      					<div class="trd_c_row"> 
      					  <div class="trd_c_cel"> 
      					    <div class="cre_inp">
      					  <div class="sm_blk"> Count </div>
      					    <input type="text" maxlength="12" class="form-control" placeholder="" name="exp_count" id="exp_count">
      					 </div>
      					  </div>
      					  <div class="trd_c_cel"> 
      					     <div class="cre_inp">
      					  <div class="sm_blk"> Weight(Kgs) </div>
      					    <input type="text" maxlength="10" class="form-control" placeholder="" name="exp_weight_kgs" id="exp_weight_kgs">
      					 </div>
      					  </div>
      					</div>

      					<div class="trd_c_row"> 
      					  	<div class="trd_c_cel"> 
      						    <div class="cre_inp">
      						  		<div class="sm_blk"> Farmer Price </div>
      						    	<input type="text" maxlength="10" class="form-control" placeholder="" name="exp_farmer_price_val" id="exp_farmer_price_val" onkeyup="amount_with_commas();" >
                        <input type="hidden" class="form-control" placeholder="" name="exp_farmer_price" id="exp_farmer_price" >
                        <span class="amon_text"> </span>
      						 	</div>
      						  	</div>
      						  	<div class="trd_c_cel"> 
      							    <div class="cre_inp">
      							  		<div class="sm_blk"> Company Price </div>
      							    	<input type="text" maxlength="10" class="form-control" placeholder="" name="exp_company_price_val" id="exp_company_price_val" onkeyup="amount_with_commasval();">
                          <input type="hidden" class="form-control" placeholder="" name="exp_company_price" id="exp_company_price" >
                          <span class="amon_text1"> </span>
      							 	</div>
      						  	</div>
      						</div>
      						<textarea rows="4" placeholder="Note" class="note_txt" name="note" id="note"></textarea>
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
				<div class="padding_30">
					

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
          <table id="usr_lst_tbl" cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped table-hover" style="width:100%">
            <thead>
              <tr>
                <th class="id_td"> Id </th>
                <th class="date_td"> Date 
                	<span class="sts_pp">
                      <i class="fa fa-filter" aria-hidden="true" style="font-size: 9px;"></i>   
                  </span>
                  <div class="sts_fil_blk"> 
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="optradio" value="" id="this_mnt">
                        <label class="form-check-label" for="this_mnt">
                          This Month
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="optradio" value="" id="last_3mont">
                        <label class="form-check-label" for="last_3mont">
                          Last 3 Months
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="optradio" value="" id="last_6mon">
                        <label class="form-check-label" for="last_6mon">
                          Last 6 Months
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="optradio" value="" id="one_year">
                        <label class="form-check-label" for="one_year">
                          1 Year
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="optradio" value="" id="choos_date">
                        <label class="form-check-label" for="choos_date">
                          Choose Date
                        </label>
                      </div>
                  </div>
                </th>
                <th> Trader Name  
                	<span class="sts_pp">
                    <i class="fa fa-filter" aria-hidden="true" style="font-size: 9px;"></i>   
                  </span>
                  <div class="sts_fil_blk"> 

                    <div class="form-group mar_10_t">
                      <input type="text" class="form-control" placeholder="Search Trader">
                    </div>
       
                    <div class="trd_lst">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="optradio" value="" id="trdd1">
                        <label class="form-check-label" for="trdd1">
                          Trader Name -1
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="optradio" value="" id="trdd2">
                        <label class="form-check-label" for="trdd2">
                          Trader Name -1
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="optradio" value="" id="trdd3">
                        <label class="form-check-label" for="trdd3">
                          Trader Name -1
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="optradio" value="" id="trdd4">
                        <label class="form-check-label" for="trdd4">
                          Trader Name -1
                        </label>
                      </div>
                    </div>
                  </div>
                </th>
                <th> User Name 
                	<span class="sts_pp">
                            <i class="fa fa-filter" aria-hidden="true" style="font-size: 9px;"></i>   
                  </span>
                  <div class="sts_fil_blk"> 

                  	<div class="form-group mar_10_t">
                      <input type="text" class="form-control" placeholder="Search Trader">
                    </div>
 
                    <div class="trd_lst">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="optradio" value="" id="usr1">
                        <label class="form-check-label" for="usr1">
                          User Name -1
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="optradio" value="" id="usr2">
                        <label class="form-check-label" for="usr2">
                          User Name -2
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="optradio" value="" id="usr3">
                        <label class="form-check-label" for="usr3">
                          User Name -3
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="optradio" value="" id="usr4">
                        <label class="form-check-label" for="usr4">
                          User Name -4
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="optradio" value="" id="usr5">
                        <label class="form-check-label" for="usr5">
                          User Name -5
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="optradio" value="" id="usr6">
                        <label class="form-check-label" for="usr6">
                          User Name -6
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="optradio" value="" id="usr7">
                        <label class="form-check-label" for="usr7">
                          User Name -7
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="optradio" value="" id="usr8">
                        <label class="form-check-label" for="usr8">
                          User Name -8
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="optradio" value="" id="usr9">
                        <label class="form-check-label" for="usr9">
                          User Name -9
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="optradio" value="" id="usr10">
                        <label class="form-check-label" for="usr10">
                          User Name -10
                        </label>
                      </div>
                    </div>
                  </div>
                </th>
                <th class="stat_blk"> Status 

                  <span class="sts_pp">
                    <i class="fa fa-filter" aria-hidden="true" style="font-size: 9px;"></i>   
                  </span>
                  <div class="sts_fil_blk"> 
                        <div class="trd_lst">
                                <div class="form-check">
                                      <input class="form-check-input" type="checkbox" name="optradio" value="" id="sta1">
                                  <label class="form-check-label" for="sta1">
                                    Completed
                                  </label>
                                </div>
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" name="optradio" value="" id="sta2">
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
function clickaction(id)
{
  $("#hid_lid").val(id);
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
  

  //$(textbox).keyup(function () {
    
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
  

  //$(textbox).keyup(function () {
    
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
//get crop locations
function selectVal1(id,val,code) {

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

// get traders
function gettrader()
{
  $.ajax({    
    //url: url+"admin/brands/list",
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
//get users
function getuser()
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


//form submit start
  //Form submit
  $("#tradefrm").submit(function(e) {  

    e.preventDefault();
  }).validate({
    rules:{
      trade_date:
      {
        required: true
      },        
      tkey:{
        required:true,
        minlength:3
      },        
      ukey:{
        required:true,
        minlength: 1
      }, 
      crop_opt:{
        required:true
      },        
      exp_count:{
        required: true
      },
      exp_weight_kgs:{
        required:true
      }, 
      exp_farmer_price:{
        required: true,
        number: true,
        min: 1
      },
       exp_comapny_price:{
        required: true,
        number: true,
        min: 1
      }
    },
    messages: {
      trade_date:
      {
        required: "Please select trade date"
      },
      tkey:{
        required: "Please enter trader name"
      },        
      ukey:{
        required:"Please enter username",
       
      },        
      crop_opt:{
        required: "Please select crop location"       
      },
      exp_count:{
        required: "Please enter expected count"
      },
      exp_weight_kgs:{
        required: "Please enter expected weight"
      },
      exp_farmer_price:{
        required: "Please enter farmer price"
      },
      exp_comapny_price:{
        required: "Please enter company price"
      },
    },
    /* errorElement : 'div',
    errorLabelContainer: '.errorTxt', */
    submitHandler: function(form) 
    {    
     
        formData = new FormData(form);    
      
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
              
              setInterval('location.reload()', 2000);
                            
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
             
    }
  });
//form submit end
/*delete trade*/



/*delete trade*/
$(document).ready(function() {

    var table = $('#usr_lst_tbl').DataTable({
      /*'ordering': false,
      language: {
        searchPlaceholder: "Search Trades",
        search: "",
        "dom": '<"toolbar">frtip'
      }*/
      'processing': true,
        'serverSide': true,
        'serverMethod': 'post',   
         language: {
        searchPlaceholder: "Search Trades",
        search: "",
        "dom": '<"toolbar">frtip'
        },
        "order": [[ 1, 'desc' ]],
        'ajax': {
           'url':url+'api/trades/gettrades',
           'data': function(data){
            // Read values
            /*var brand = $('#fil1').val();
            var products = $('#fil2').val();
            var publish = $('#fil3').val();
            // Append to data
            data.fil1 = brand;
            data.fil2 = products;
            data.fil3 = publish;*/
            /* console.log(data.order);
            return JSON.stringify( data ); */
           },
           "dataSrc": function (json) {    
           //alert(JSON.stringify(json));    
            //$("#tot_count").html(json.recordsTotal);   
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
               setInterval('location.reload()', 2000);
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

    $('.dataTables_length').text('Trade List');
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

$(document).on("click", ".del", function() {
   $('#delete_trade').modal();
});

$(document).on("click", ".edt", function() {

	var lid = $("#hid_lid").val();
	$.ajax({		
		//url: url+"api/loans/index/"+lid,
		url: url+"api/trades/tradedetails/"+lid,
		data: {},
		type:'POST',		
		datatype:'json',
		success : function(response){
			
			res= JSON.parse(response);
			$("#ukey_edit").val(res.data.user_name);
      $("#tkey_edit").val(res.data.firm_name);
      $("#crop_opt_edit").val(res.data.crop_loc);
      $("#trade_date_edit").val(res.data.trade_date);
      $("#exp_count_edit").val(res.data.exp_count);
      $("#exp_weight_kgs_edit").val(res.data.exp_weight_kgs);
      $("#exp_farmer_price_val_edit").val(res.data.exp_farmer_price);
      $("#exp_farmer_price_edit").val(res.data.exp_farmer_price);
      $("#exp_company_price_val_edit").val(res.data.exp_company_price);
      $("#exp_company_price_edit").val(res.data.exp_company_price);
      $("#note_edit").val(res.data.note);
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
  <div class="pp_clss"> <i class="fa fa-times" aria-hidden="true"></i> </div>
  <div class="tr_exp_dtl">
    <div class="hdg_bks"> Trade Expected Details <i class="fa fa-edit edt_bl_lnk" aria-hidden="true"></i>
      </div>
 
<ul class="top_exp_blk disb_sel">

    <li> 
      <div class="cre_inp inp_ss">
        <div class="sm_blk"> User</div>
          <input type="text" class="form-control" placeholder="" data-original-title="" name="ukey_edit" id="ukey_edit" >
          <input type="hidden" class="form-control" id="userid_edit" name="userid_edit" />
      </div>
    </li>
  
    <li> 
      <div class="cre_inp inp_ss">
        <div class="sm_blk"> Trader </div>
        <input type="text" class="form-control" placeholder="" data-original-title="" title="" value="" name="tkey_edit" id="tkey_edit">
        <input type="hidden" class="form-control" id="traderid_edit" name="traderid_edit" />
      </div>
    </li>
 
  <li> 
          <!-- Trader start -->
            <div class="check_wt_serc val_seld"> 
              <div class="show_va"> Location </div>
             <div class="selectVal" id="crop_opt_edit">  Kakinada </div>
            <ul class="check_list"> 
              <li> <div class="form-group">
                <input type="email" checked="true" class="form-control" placeholder="Search Trader">
              </div> </li>
              <li> 
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="trader" id="cty1" value="kakinada">
                      <label class="form-check-label" for="cty1">
                      Kakinada
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="trader" id="cty2" value="amalapuram">
                      <label class="form-check-label" for="cty2">
                       Amalapuram
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="trader" id="cty3" value="bheemavaram">
                      <label class="form-check-label" for="cty3">
                        Bheemavaram
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="trader" id="cty4" value="rajamandri">
                      <label class="form-check-label" for="cty4">
                        Rajamandri
                      </label>
                    </div>
              </li>

            </ul> 
          </div>
          <!-- Trader End -->
  </li>

</ul>
<ul class="btm_exp_blk disb_sel bdr_btm">
  <li class="dt_inp"> 
    <div class="cre_inp inp_ss">
  <div class="sm_blk"> Date </div>
    <input type="text" class="form-control" placeholder="" value="" name="trade_date_edit" id="trade_date_edit" >
 </div>
  </li>
  <li class="count_inp"> 
       <div class="cre_inp inp_ss">
  <div class="sm_blk"> Count </div>
    <input type="text" class="form-control" placeholder="" value="" name="exp_count_edit" id="exp_count_edit">
 </div>
  </li>

  <li class="wt_inp"> 
        <div class="cre_inp inp_ss">
  <div class="sm_blk"> Weight <!-- (Kgs)  --></div>
    <input type="text" class="form-control" placeholder="" value="" name="exp_weight_kgs_edit" id="exp_weight_kgs_edit">
 </div>
  </li>

  <li class="prc_inp"> 
      <div class="cre_inp inp_ss">
  <div class="sm_blk"> Farmer Price </div>
    <input type="text" maxlength="10" class="form-control" placeholder="" value="" name="exp_farmer_price_val_edit" id="exp_farmer_price_val_edit">
    <input type="hidden" class="form-control" placeholder="" name="exp_farmer_price_edit" id="exp_farmer_price_edit" >
 </div>
  </li>
  <li class="prc_inp"> 
       <div class="cre_inp inp_ss">
  <div class="sm_blk"> Company Price </div>
    <input type="text" maxlength="10" class="form-control" placeholder="" value="" name="exp_company_price_val_edit" id="exp_company_price_val_edit">
    <input type="hidden" class="form-control" placeholder="" name="exp_company_price_edit" id="exp_company_price_edit" >
 </div>
  </li>
   <li class="prc_txt_area"> 
       <div class="cre_inp inp_ss">
  <div class="sm_blk"> Note </div>
    <textarea class="form-control" placeholder="" name="note_edit" id="note_edit"></textarea>
 </div>
  </li>
</ul>

</div>
<!--  <div class="sb_hdg_blk">  </div>   -->  
<div class="tr_act_dtls">

<div class="hdg_bks"> Trade Actual Details  <a href="#" title="" class="fr"> Add More </a> </div>
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
  </thead>
  <tbody>
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
    <tr> 
      <td> <input type="text" class="form-control" placeholder=""> </td>
      <td class="cnt_wth"> <input maxlength="7" type="text" class="form-control" placeholder=""> </td>
      <td class="bor_t_b_none"> <div> &nbsp;</div> </td>
      <td class="weig"> <input type="text" class="form-control" placeholder="" maxlength="9"> </td>
      <td class="com_bg weig" width="80"> <input type="text" class="form-control" placeholder=""> </td>
      <td class="com_bg amn_blk"> <input type="text" class="form-control" placeholder="" disabled> </td>
      <td class="bor_t_b_none"> <div> &nbsp;</div> </td>
      <td class="far_bg weig"> <input type="text" maxlength="9" class="form-control" placeholder=""> </td>
      <td class="far_bg" width="80"> <input type="text" class="form-control" placeholder=""> </td>
      <td class="far_bg amn_blk"> <input type="text" class="form-control" placeholder="" disabled> </td>
    </tr>
    <tr> 
      <td width="100"> <input type="text" class="form-control" placeholder=""> </td>
      <td width="108" class="cnt_wth"> <input maxlength="7" type="text" class="form-control" placeholder=""> </td>
      <td class="bor_t_b_none"> <div> &nbsp;</div> </td>
      <td class="weig"> <input type="text" maxlength="9" class="form-control" placeholder=""> </td>
      <td class="far_bg weig" width="80"> <input type="text" class="form-control" placeholder=""> </td>
      <td class="com_bg amn_blk" width="112"> <input type="text" class="form-control" placeholder="" disabled> </td>
      <td class="bor_t_b_none"> <div> &nbsp;</div> </td>
      <td class="com_bg weig"> <input maxlength="9" type="text" class="form-control" placeholder=""> </td>

      <td class="far_bg" width="80"> <input type="text" class="form-control" placeholder=""> </td>
      <td class="far_bg amn_blk"> <input type="text" class="form-control" placeholder="" disabled> </td>
    </tr>
    <tr> 
      <td colspan="2" class="total"> </td>
      <td class="bor_t_b_none"> <div> &nbsp;</div> </td>
      <td>  </td>
      <td class="txt_rt"> 200 </td>
      <td class="total"> 20,00,000 </td>
      <td class="bor_t_b_none"> <div> &nbsp;</div> </td>
      <td></td>
      <td class="txt_rt"> 200 </td>
      <td class="total"> 20,00,000 </td>
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
      <td class="far_bg" width="120"> <input type="text" class="form-control" placeholder=""> </td>
   </tr>
   <tr>
       <td class="far_bg"> Lab Fee </td>
      <td class="far_bg" width="120"> <input type="text" class="form-control" placeholder=""> </td>
  </tr>
      <tr>
       <td class="far_bg"> <b>Grand Total</b></td>
      <td class="txt_rt far_bg"> <b>20,00,000</b> </td>
    </tr>
</table> 
      </td>
    </tr>
  </tbody>
</table>
</div>

<div class="clr_btn"> </div>
<div class="sb_btm"> 
<button class="fr btn btn-success"> Finish Trade </button>
  <button class="fr btn btn-primary"> Update </button>  </div>
</div>
</div>
<script type="text/javascript">
  $(document).ready(function(){
    $('.edt_bl_lnk').click(function(){
      $(this).toggleClass('opacity_1');
        $(this).parent().siblings('ul').toggleClass('disb_sel');
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
</script>
<div id="note_cnt"> 
 Lorem Ipsum is simply dummy text of the printing and typesetting industry
</div>
<?php require_once 'footer.php' ; ?><link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>