<?php if($this->session->userdata('adminid') == "")
{ 
	redirect('admin/login');	
} 
$page = $this->uri->segment(2); 
$PAGE_SEGMENT = $this->uri->segment(3); 
?>

<div class="menu_icn"> 
	<div class="menu_in_blk">
		<div class="s_menu"> </div>
	</div>
</div>
<div class="ov_lay"> </div>
<div class="side_menu"> 
	<div class="logo"> <img src="<?php echo base_url();?>assets/images/ssa_logo.png" width="120" alt="" title=""> </div>
	<div class="menu_list">		
		<ul> 
			<li> 
				<!-- <a href="#" title="" class="act_menu"> <span>Users</span> </a> -->
				<a href="<?php echo base_url();?>admin/users" title="" <?php if($page == "users") echo "class='act_menu'";?>>
				<i> <img src="<?php echo base_url();?>assets/images/users.png"> </i> <span>Users </span> 
				</a>
			</li>
			<li> 
				<a href="<?php echo base_url();?>admin/brands" title="" <?php if($page == "brands") echo "class='act_menu'";?>> <i> <img src="<?php echo base_url();?>assets/images/brand.png"> </i> <span> Companies </span> </a>
			</li>
			<li> 
				<a href="<?php echo base_url();?>admin/products" title="" <?php if($page == "products") echo "class='act_menu'";?>> <i> <img src="<?php echo base_url();?>assets/images/products.png"> </i> <span> Products </span> </a>
			</li>			
		</ul>

		<ul> 
			<li> 
				<a href="<?php echo base_url();?>admin/loans" title="" <?php if($page == "loans") echo "class='act_menu'";?>> <i> <img src="<?php echo base_url();?>assets/images/loans.png"> </i> <span> Loans </span> </a>
			</li>
			<li> 
				<a href="<?php echo base_url();?>admin/receipts" title="" <?php if($page == "receipts") echo "class='act_menu'";?>> <i> <img src="<?php echo base_url();?>assets/images/recepts.png"> </i> <span> Receipts </span> </a>
			</li>
		
		</ul>

		<ul> 
			<li> 
				<a href="<?php echo base_url();?>admin/purchases" title="" <?php if($page == "purchases") echo "class='act_menu'";?>> <i> <img src="<?php echo base_url();?>assets/images/purchases.png"> </i> <span> Purchases </span> </a>
			</li>
			<li> 
				<a href="<?php echo base_url();?>admin/sales/create" title="" <?php if($page == "sales") echo "class='act_menu'";?>> <i> <img src="<?php echo base_url();?>assets/images/loans.png"> </i> <span> Sales </span> </a>
			</li>
			
			<li> 
				<a href="<?php echo base_url();?>admin/returns/create" title="" <?php if($page == "returns") echo "class='act_menu'";?>> <i> <img src="<?php echo base_url();?>assets/images/loans.png"> </i> <span> Returns </span> </a>
			
			<li> 
				<a href="<?php echo base_url();?>admin/stockTransfer" title="" <?php if($page == "stockTransfer") echo "class='act_menu'";?>> <i> <img src="<?php echo base_url();?>assets/images/loans.png"> </i> <span> Stock Transfer </span> </a>
			</li>
			
		</ul>
		<ul> 
			<li> 
				<a href="<?php echo base_url();?>admin/traders" title="" <?php if($page == "traders") echo "class='act_menu'";?>> <i> <img src="<?php echo base_url();?>assets/images/traders.png"> </i> <span> Traders </span></a>
			</li>
			<li> 
				<a href="<?php echo base_url();?>admin/trades" title="" <?php if($page == "trades") echo "class='act_menu'";?>> <i> <img src="<?php echo base_url();?>assets/images/trading.png"> </i> <span> Trades </span> </a>
			</li>
			
		</ul>
		<ul> 
			<li> 
				<a href="<?php echo base_url();?>admin/reports" title="" <?php if($page == "reports") echo "class='act_menu'";?>> <i> <img src="<?php echo base_url();?>assets/images/traders.png"> </i> <span> Reports </span></a>
			</li>
		</ul>	

		<ul class="pro_links"> 
			<li> 
				<a href="<?php echo base_url();?>admin/profile" title="" <?php if($page == "profile") echo "class='act_menu'";?>> <i> <img src="<?php echo base_url();?>assets/images/profile.png"> </i> <span> Profile </span> </a>
			</li>
			<li> 
				<a href="<?php echo base_url();?>admin/logout" title="" <?php if($page == "logout") echo "class='act_menu'";?>> <i> <img src="<?php echo base_url();?>assets/images/logout.png"> </i> <span> Logout </span> </a>
			</li>
		
		</ul>

	</div>

</div>