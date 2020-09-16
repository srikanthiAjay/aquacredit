<?php require_once 'header.php' ; ?>
<link href="<?php echo base_url();?>assets/css/product_list.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>assets/js/common.js" type="javascript"></script>
<?php require_once 'sidebar.php' ; ?>		
<div class="right_blk"> 
	<div class="top_ttl_blk"> <span class="back_btn">
		</span> <span> Product List </span>
    <a href="<?php echo base_url();?>admin/products/create" title="" class="fr btn btn-primary"> Create Product </a>
	</div>

 

	<div class="padding_30">
	<!-- create product -->
		<div class="card_view mar_btm">
			<div class="padding_30">		
		

           	<div class="filter_bk">
           			<div class="row"> 

          <div class="col-md-4">
          <div class="form-group"> 
          				<label> Select Brand (5) </label>
                       <select id="fil1"> 
                          <option selected> Brand 1 </option> 
                          <option> Brand 2 </option> 
                          <option> Brand 3 </option> 
                          <option> Brand 2 </option>
                          <option> Brand 4 </option> 
                      </select>
           </div>
         </div>

         <div class="col-md-4">
           <div class="form-group"> 
          				<label> Select Product (5)</label>
                       <select id="fil2" multiple="multiple"> 
                          <option selected> Product 1 </option> 
                          <option> Product 2 </option> 
                          <option> Product 3 </option> 
                          <option> Product 2 </option>
                          <option> Product 4 </option> 
                      </select>
           </div>
         </div>
         <div class="col-md-4">
           <div class="form-group"> 
          				<label> Select Status </label>
                       <select id="fil3"> 
                          <option selected> Publish </option> 
                          <option> Unpublish </option> 
                      </select>
           </div>
   		 </div>


           			</div>
           	</div>

          <!-- <div class="row"> 
            <div class="col-md-2 bor_lf_none">
                                    <div class="top_in_op crop_top">
                                      <p> Total Brands </p> 
                                    <h1> 10 </h1>
                                    </div>
                    </div>

                     <div class="col-md-2">
                                    <div class="top_in_op crop_top">
                                      <p> Total Produts </p> 
                                    <h1> 250 </h1>
                                    </div>
                    </div>
          </div> -->    

		</div>
		</div>

    <div class="card_view urs_dt"> 
                  <div class="padding_30"> 
                    <div class="hdg_bk">  Products  </div>
                        <div class="res_tbl">
                            

           <table id="prdt_lst_tbl" class="table table-striped table-bordered" style="width:100%">
           <thead>    
            <tr>
              <th>  Product Name </th>
              <th> Select Brand </th>
              <th> MRP </th>
              <th> Action </th>
            </tr>
          </thead>

          <tbody>
              <tr>
              <td>  Product Name </td>
              <td> Brand -1 </td>
              <td> ₹ 2000/- </td>
              <td>  <ul class="action_list"> 
                  <li> <a href="<?php echo base_url();?>admin/products/create" title=""> Edit </a> </li>
                  <li> / </li>
                  <li> <a href="#" title="" data-toggle="modal" data-target="#delete_user"> Delete </a> </li>
                </ul> </td>
            </tr>

            <tr>
              <td>  Product Name </td>
              <td> Brand -1 </td>
              <td> ₹ 2000/- </td>
              <td>  <ul class="action_list"> 
                  <li> <a href="<?php echo base_url();?>admin/products/create" title=""> Edit </a> </li>
                  <li> / </li>
                  <li> <a href="#" title="" data-toggle="modal" data-target="#delete_user"> Delete </a> </li>
                </ul> </td>
            </tr>

            <tr>
              <td>  Product Name </td>
              <td> Brand -1 </td>
              <td> ₹ 2000/- </td>
              <td>  <ul class="action_list"> 
                  <li> <a href="<?php echo base_url();?>admin/products/create" title=""> Edit </a> </li>
                  <li> / </li>
                  <li> <a href="#" title="" data-toggle="modal" data-target="#delete_user"> Delete </a> </li>
                </ul> </td>
            </tr>

            <tr>
              <td>  Product Name </td>
              <td> Brand -1 </td>
              <td> ₹ 2000/- </td>
              <td>  <ul class="action_list"> 
                  <li> <a href="<?php echo base_url();?>admin/products/create" title=""> Edit </a> </li>
                  <li> / </li>
                  <li> <a href="#" title="" data-toggle="modal" data-target="#delete_user"> Delete </a> </li>
                </ul> </td>
            </tr>

            <tr>
              <td>  Product Name </td>
              <td> Brand -1 </td>
              <td> ₹ 2000/- </td>
              <td>  <ul class="action_list"> 
                  <li> <a href="<?php echo base_url();?>admin/products/create" title=""> Edit </a> </li>
                  <li> / </li>
                  <li> <a href="#" title="" data-toggle="modal" data-target="#delete_user"> Delete </a> </li>
                </ul> </td>
            </tr>

            <tr>
              <td>  Product Name </td>
              <td> Brand -1 </td>
              <td> ₹ 2000/- </td>
              <td>  <ul class="action_list"> 
                  <li> <a href="<?php echo base_url();?>admin/products/create" title=""> Edit </a> </li>
                  <li> / </li>
                  <li> <a href="#" title="" data-toggle="modal" data-target="#delete_user"> Delete </a> </li>
                </ul> </td>
            </tr>

            <tr>
              <td>  Product Name </td>
              <td> Brand -1 </td>
              <td> ₹ 2000/- </td>
              <td>  <ul class="action_list"> 
                  <li> <a href="<?php echo base_url();?>admin/products/create" title=""> Edit </a> </li>
                  <li> / </li>
                  <li> <a href="#" title="" data-toggle="modal" data-target="#delete_user"> Delete </a> </li>
                </ul> </td>
            </tr>

            <tr>
              <td>  Product Name </td>
              <td> Brand -1 </td>
              <td> ₹ 2000/- </td>
              <td>  <ul class="action_list"> 
                  <li> <a href="<?php echo base_url();?>admin/products/create" title=""> Edit </a> </li>
                  <li> / </li>
                  <li> <a href="#" title="" data-toggle="modal" data-target="#delete_user"> Delete </a> </li>
                </ul> </td>
            </tr>

            <tr>
              <td>  Product Name </td>
              <td> Brand -1 </td>
              <td> ₹ 2000/- </td>
              <td>  <ul class="action_list"> 
                  <li> <a href="<?php echo base_url();?>admin/products/create" title=""> Edit </a> </li>
                  <li> / </li>
                  <li> <a href="#" title="" data-toggle="modal" data-target="#delete_user"> Delete </a> </li>
                </ul> </td>
            </tr>

            <tr>
              <td>  Product Name </td>
              <td> Brand -1 </td>
              <td> ₹ 2000/- </td>
              <td>  <ul class="action_list"> 
                  <li> <a href="<?php echo base_url();?>admin/products/create" title=""> Edit </a> </li>
                  <li> / </li>
                  <li> <a href="#" title="" data-toggle="modal" data-target="#delete_user"> Delete </a> </li>
                </ul> </td>
            </tr>
          </tbody>
           </table>
                        </div>
                      </div>
           </div>
		
	<!-- End product -->
	</div>
	
</div>

 <div class="modal" id="delete_user">
              <div class="modal-dialog">
                   <div class="modal-content">
                        <div class="modal-body">
                              <h1> Are You Sure ! </h1>
                              <p> You want Delete Product ? </p>
                        </div>
                        <div class="modal_footer">
                          <button type="button" class="btn btn-primary" data-dismiss="modal">Yes</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
        </div>
                   </div>
              </div>
          </div>
<script type="text/javascript"> 
   $(document).ready(function() {
    $('#prdt_lst_tbl').DataTable();
  $('#fil1').multiselect();
  $('#fil2').multiselect();
  $('#fil3').multiselect();
});
</script>
<?php require_once 'footer.php' ; ?>

