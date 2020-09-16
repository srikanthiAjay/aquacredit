<?php if($this->session->userdata('adminid') == "")
{ 
	redirect('admin/login');
	
} 
$page = $this->uri->segment(2);
?>
<div class="left_blk">
	<div class="mnu_blk"> 
	  <div class="menu_icn"> </div>
	</div>
	<div class="logo"> <img src="<?php echo base_url();?>assets/images/ssa_logo.png" width="120" alt="" title=""> </div>
	<ul> 
	  <li> <a href="<?php echo base_url();?>admin/users" title="" <?php if($page == "users") echo "class='act'";?> > Users </a> </li>
	   <li> <a href="<?php echo base_url();?>admin/traders" title="" <?php if($page == "traders") echo "class='act'";?> > Traders </a> </li>
	  <li> <a href="<?php echo base_url();?>admin/brands" title="" <?php if($page == "brands") echo "class='act'";?> > Brands </a> </li>

	    <li> <a href="<?php echo base_url();?>admin/products" title="" <?php if($page == "products") echo "class='act'";?> > Products </a> </li>
	  <!-- <li> <a href="#" title="" <?php if($page == "categories") echo "class='act'";?>> Categories </a> </li> -->
	  <li> <a href="<?php echo base_url();?>admin/loans" title="" <?php if($page == "loans") echo "class='act'";?>> Loans </a> </li>
	
	 
	  <li> <a href="<?php echo base_url();?>admin/trades" title="" <?php if($page == "trades") echo "class='act'";?> > Trades </a> </li>
	 <!--  <li> <a href="#" title=""> Seller Branches </a> </li> -->
	  
	  <li> <a href="<?php echo base_url();?>admin/profile" title="" <?php if($page == "profile") echo "class='act'";?> > Profile </a> </li>
	  <li> <a href="<?php echo base_url();?>admin/logout" title=""> Logout </a> </li>
	</ul>
</div>