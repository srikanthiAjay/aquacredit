<?php require_once 'header.php' ; ?>
<script src='https://kit.fontawesome.com/a076d05399.js'></script> 
<?php require_once 'sidebar.php' ; ?>
<div class="right_blk"> 
	<script type="text/javascript">
		$(document).ready(function(){
			var win_wth = $(document).width();
if(win_wth <= 1100){
$(".mobile_reprts").click(function(){
	$(".reports_menu ul").toggleClass('show_rp_mn');
	$(".reports_menu ul li").click(function(){
		$('.reports_menu ul li').removeClass("act");
	  	$(this).addClass("act");
	  	var val = $(this).text();
	  	$('.act_rppt').text(val);
	  	$('.reports_main').hide();
   var k = $(this).find('a').attr('href');
  $(k).show();
	});
});
}else {
$(".reports_menu ul li").click(function(){
	$('.reports_menu ul li').removeClass("act");
  $(this).addClass("act"); 
  $('.reports_main').hide();
   var k = $(this).find('a').attr('href');
  $(k).show();
});
}


		});
	</script>
	<style type="text/css">
		.hide_blk {display: none;}
		td.nbm_usr_td, th.nbm_usr_td {width: 80px!important; max-width: 80px!important;}
		td.ttl_amnt_td, th.ttl_amnt_td {width: 150px!important; max-width: 150px!important;}
		td.prgt_td, th.prgt_td {width: 150px!important; max-width: 150px!important;}
		.grn_row {color: green!important;}
		.rd_row {color: red!important;}
		.grn_arow{margin-left: 5px;}
		.dataTable tr td {cursor: pointer;}
		#feed_date.dataTable tr td {cursor: default;}
		.dataTables_filter {margin-top: 10px;}
		.dataTables_wrapper td, .dataTables_wrapper th {height: auto!important; padding-top: 10px!important; padding-bottom: 10px!important;}
	#feed_Product_wrapper, #feed_month_wrapper, #feed_date_wrapper {display: none;}
		.dataTables_length .check_wt_serc {max-width: 220px;}
		.blu_txt {color: #007bff;}
		.back_btn {position: relative;top: -2px;}
		.tab-content .dataTable {border-top: 1px solid #f0f1f5!important;}
		.dataTables_wrapper thead {border-bottom: 6px solid #f0f1f5!important;}
		.reports_menu {
			width: 230px;
			background: #fff;
			border:1px solid #dddddd;
			border-radius: 5px;
			position: fixed;
			height: calc(100% - 80px);
			top: 65px;
			padding-top: 20px;
		}
	.reports_menu ul {list-style: none; margin: 0px; padding: 0px;}
	.reports_menu ul li {width: 100%; padding:5px 0px;}
	.reports_menu ul li a {text-decoration: none; display: block; font-size: 13px; color: #58666e; padding:10px 20px;}
	.sts_pp {float: none; margin-left: 30px;}
	.sts_fil_blk {left: 30px; top: 37px!important;}
	.sts_pp:after {top: -12px;}
	.reports_menu ul li.act a {color: #0e82ff; border-right: 2px solid #0e82ff;}
	.rprt_anl {
			position: fixed;
			width: calc(100% - 250px);
			left: 250px;
			height: calc(100% - 100px);
			overflow: auto;
			padding-right: 20px;
		}
		.btn_anl {font-size: 13px;}
		.act_rppt {display: none;}
		.res_tbl table {min-width: 780px;}
		.anlts {width: 252px; float: left; padding: 0px 15px 0px 0px; box-sizing: border-box;}
		.tbls_blk {width: calc(100% - 252px); float: left;}
		.anl_crd {width: 100%; border: 1px solid #dddddd; padding: 10px 20px; margin-bottom: 12px; background: #fff; border-radius: 5px;}
		#over_reports .tp_anl .anl_crd {padding-top: 0px; padding-bottom: 0px;}
		.date_anl {position: relative; cursor: pointer;}
		.date_fil {position: absolute; top: 20px; right: 20px;}
		.anl_crd .top_in_op {padding: 0px;}
		.top_in_op p {margin-top: 0px;}
		.date_anl .top_in_op p {padding-bottom: 5px;}
		.top_in_op h1 {margin-bottom: 0px;}
		.date_anl .top_in_op h1 {font-size: 13px; }
		.anl_tp {width: 100%; overflow: hidden;}
		.icn_anl {width: 55px; text-align: center; height: 37px; padding-top: 8px; border-right: 1px solid #dddddd; float: left;}
		.icn_anl_rt {width: 133px; float: left; padding-left: 20px;}
		.btm_blk_anl {border-top: 1px solid #dddddd; padding-left: 0px; margin-top: 15px; margin-bottom: 10px;}
		.btm_blk_anl li {margin-top: 20px; overflow: hidden; font-size: 13px;}
		.btm_blk_anl li .lft_tl {width: 100px; float: left;}
		.btm_blk_anl li .rt_prc {width: 85px; text-align: right; float: right; color: #007bff;}
		.ttl_anl {font-size: 16px; color: #000;}
		.tp_anl {overflow: hidden;}
		.tp_anl ul {list-style: none; padding: 0px; margin: 0px;}
		.tp_anl ul li {float: left; margin-right: 15px; font-size: 13px;}
		.txt_rt {text-align: right;}
		.res_tbl {border-radius: 5px; overflow: auto; border: 1px solid #dddddd; overflow: auto;}
		.tabs_tbl {list-style: none; overflow: hidden; margin-bottom: 0px;}
		.tabs_tbl li {float: right; margin-left: 20px; cursor: pointer;}
		.tp_anl ul li.fr {float: right!important;}
		.tp_anl ul {overflow: hidden;}
		.dataTables_filter {margin-right: 0px; padding-top: 18px; padding-right: 20px;}
		.dataTables_length {padding-left: 20px; padding-top: 10px;}
		.dataTables_length h2 {margin-top: 10px!important; margin-bottom: 0px!important;}
			.tabs_tbl {list-style: none; padding:9px 0px;position: relative; margin: 0px 0px 0px 0px;}
		}
	.tabs_tbl li {display: inline-block; /*width: 160px;*/ text-align: center; transition: all linear 0.2s; cursor: pointer; font-size: 13px; position: relative; margin-left: 10px; margin-right: 10px;}
	.tabs_tbl li span {position: relative;z-index: 1; transition: all linear 0.2s;}
	.tabs_tbl li:after {height: 0px; transition: all linear 0.2s;}
	.tabs_tbl:after {position: absolute; transition: all linear 0.2s; bottom: 0px; right: -8px; content: ' ';  height: 2px; width: 60px; background: #007bff;}
	.deal_tb_ul.tabs_tbl:after {width: 46px; right: 176px;}
	.non_farm_ul.tabs_tbl:after {width: 83px; right: 72px;}
.sts_fil_blk {top: 38px;}
	.tabs_tbl.fd_md:after {width: 45px;}
	.deal_tb_ul.tabs_tbl.fd_md:after {width: 65px; right: 135px;}
	#pay_rec .deal_tb_ul.tabs_tbl.fd_md:after {right: 127px;}
	.non_farm_ul.tabs_tbl.fd_md:after {width: 60px; right: 57px;}
	.dataTables_wrapper td, .dataTables_wrapper th {padding-right: 30px!important; padding-left: 20px!important;}
	table.dataTable {margin-top: 0px!important; width: 100%;}
	.anl_btn {display: none;}
	.anl_mb_blk {display: none;}
	.show_anl {display: block!important;}
	/*.tabs_tbl li.act_tab span {color: #fff;}*/
	.txt_cnt {text-align: center;}
	#loans, #company {display: none;}
	.modal-dialog {max-width: 850px;}
	#user_lst_blk {width: 100%;}
	.modal-body {padding: 0px!important;}
	.modal-body .dataTables_length {padding-bottom: 15px;}
	.close {
		    position: absolute;
    z-index: 99999;
    right: 20px;
    top: 20px;
	}
	.pagination {padding-bottom: 5px;}
	.pagination {padding-right: 5px;}
	.over_lst {width: 100%; list-style: none; padding: 0px; margin: 0px; position: relative;}
	.over_lst:after {    position: absolute;
    transition: all linear 0.2s;
    bottom: 0px;
    right: 317px;
    content: ' ';
    height: 2px;
    width: 88px;
    background: #007bff;}
    .over_lst.frm:after {
    	width: 88px;
    	right: 317px;
    }
    .over_lst.nn_frm:after {
    	width: 112px;
    	right: 200px;
    }
    .over_lst.dlr_lnk:after {
    	width: 70px;
    	right: 120px;
    }
    .over_lst.gst_lnk:after {
    	width: 108px;
    	right: 8px;	
    }	
	.over_lst li {display: inline-block;}
	.over_lst li.fr {padding: 19px 0px;}
	.over_lst li.act a, .over_lst li.act {color: #007bff}
	.over_lst li input {
		border: none; 
		outline: none; 
		background: url("http://3.7.44.132/aquacredit/assets/images/search_icn.png") 0px 23px no-repeat;
		padding-left: 25px;
		height: 57px;
		padding-top: 7px;
	}
	.lnks {cursor: pointer;}
	.fr {float: right;}
	.td_mob {font-size: 11px; color: #007bff; font-weight: bold;}
	.al_r_tbl, .cash_tbl {width: 100%!important;}
	.rprt_anl {height: calc(100% - 80px)};
	.cash_tbl {border-radius: 5px;}
	.al_r_tbl td, .cash_tbl td {border-bottom: 1px solid #f0f1f5;}
	.al_r_tbl th, .cash_tbl th {border-bottom: 5px solid #f0f1f5;}
	.al_r_tbl td, .al_r_tbl th {color: #58666e; background: none!important; font-size: 13px; padding:0px 20px!important; height: 40px;}
	.al_r_tbl td span {color: #030303;}
	.sub_prc {font-size: 11px; color: #1c9f02; font-weight: bold;}
	/*#over_reports {display: none;}*/
	#users_st, #trades, #sales, #trade_start, #pay_rec, #cash_book, #inventery {display: none;}
	.conts_anl {list-style: none; overflow: hidden; margin: 0px; padding: 0px; border-top: 1px solid #dddddd; margin-top: 10px;}
	.conts_anl li {width: 33.3%; float: left; margin-top: 10px;}
.bank_logo {
    width: 30px;
    float: left;
    position: relative;
    bottom: -5px;
}

.bank_mny {
    width: calc(100% - 30px);
    float: left;
    padding-left: 20px;
}
.bank_bal {
    font-size: 14px;
    color: #000;
    padding-bottom: 0px;
}
.accont_numb {
    font-size: 12px;
    color: #7d888e;
}
.all_bnks {padding: 0px; margin: 0px; list-style: none; margin-top: 10px; border-top: 1px solid #dddddd;}
.all_bnks li {width: 100%; margin-top: 0px;overflow: hidden;
    padding: 12px 0px;
    border-bottom: 1px solid #ddd;}
.all_bnks li:last-child {border-bottom: none;}
.top_blk_inv li {position: relative; display: inline-block; padding-right: 15px; border-right: 1px solid #b0b0b0;}
.top_blk_inv ul {list-style: none; margin: 0px; padding:5px 0px;}
.top_blk_inv li {min-width: 185px; margin-right: 15px;}
.top_blk_inv li .top_in_op h1 {font-size: 13px; margin-top: 5px;}
.top_blk_inv li .top_in_op {border-left: none;}
.top_blk_inv li .date_fil {top: 5px;}
.nav-tabs .nav-item a.nav-link {outline: none!important; border: none!important;}
.nav-item .nav-link.active .anl_crd{
	border: 1px solid #007bff;
	position: relative;
}
.nav-item .nav-link.active .anl_crd:after {position: absolute; width: calc(100% + 2px); bottom:-18px; height: 30px; background: #fff; border-left:1px solid #007bff; border-right:1px solid #007bff; left: -1px; content: ' ';}
.tp_anl .nav-tabs {border-bottom: 1px solid #007bff}
.nav-item .nav-link .anl_crd {padding: 20px;}
#inventery .tab-content {padding: 20px 0px	; border: 1px solid #007bff; border-top: none; background: #fff;}
#inventery .nav-tabs .nav-item.show .nav-link, #inventery .nav-tabs .nav-link.active {background: none!important; border: none!important;}
#inventery .tp_anl, #inventery .tp_anl ul {overflow: visible;}
.ttl_th {display: block; font-weight: normal; color: #007bff;}
#inventery .dataTables_filter {padding-top: 0px!important;}
#inventery .res_tbl {border: none;}
		@media (max-width: 1100px){
			.mobile_reprts {position: relative; padding: 0px; width: calc(100% - 20px); margin-left: 10px; top: 0px; height: auto;}
			.reports_menu ul {display: none; z-index: 999; position: fixed; top: 110px; width:calc(100% - 42px); background: #fff; padding: 20px; height: calc(100% - 150px); overflow: auto; left: 22px;}
			.show_rp_mn {display: block!important;}
			.mobile_reprts:after, .mobile_reprts:before {content: ' '; width: 10px; height: 2px; background: #000; position: absolute; right: 20px; opacity: 0.5; top: 25px;}	
			.mobile_reprts:after {transform: rotate(45deg); right: 27px;}
			.mobile_reprts:before {transform: rotate(-45deg);}
			.act_rppt {display: block; padding: 15px 20px 12px 20px; width: 100%;}
			.rprt_anl {width: 100%; left: 0px; padding:10px 20px 20px 20px;}
			.btn_anl {display: none;}
		} 

		@media (max-width: 1000px){
			.anl_btn {display: block; padding: 15px 20px 12px 20px; width: 100%;}
			.anlts, .tp_anl {display: none;}
			#inventery .tp_anl {display: block;}
			.tbls_blk {width: 100%;}
			.anl_btn {background: #fff; border-radius: 5px; margin-bottom: 10px; border: 1px solid #dddddd;}
			.date_anl {width: 250px; margin-bottom: 0px; border: none; padding:0px;}
			.anl_btn {overflow: hidden;}
			.date_anl {margin-top: 10px;}
			.btn_anl {display: inline-block;}
			.anl_mb_blk {position: fixed; padding: 20px; background: #fff; width: 280px; height: 100%; right: 0px; top: 0px; z-index: 999; overflow: auto;}
			.al_anl {position: fixed; background: rgba(0,0,0,0.5); display: none; top: 0px; left: 0px; width: 100%; height: 100%; z-index: 99;}
		}

		@media (max-width: 768px){
			.dataTables_length h2{text-align: center;}
			.dataTables_filter {background: #ddd; padding-top: 0px; text-align: center;}
			.dataTables_filter li {float: none; display: inline-block;}
			.deal_tb_ul.tabs_tbl:after {display: none;}
			.tabs_tbl {padding: 0px;}
			.tabs_tbl {text-align: center;}
			.tabs_tbl:after {display: none;}
			.tabs_tbl li {padding: 9px 10px;}
			.tabs_tbl li.act_tab {background: #007bff; color: #fff;}
			.dataTables_length {padding-left: 0px!important;}
			.date_anl {margin-top: 0px;}
			.tab-content .dataTables_length {padding-left: 15px!important;}
			.tab-content div.dataTables_wrapper div.dataTables_filter label input {margin-top: 10px!important;}
			.dropdown.responsivetabs-more .dropdown-toggle {height: 79px; display: block;  width: 50px;  background: #fff url(http://3.7.44.132/aquacredit/assets/images/menu_drop_down.png) 5px 5px no-repeat; border-radius: 5px;  margin-top: 5px;}
			.icn_anl {display: none;}
		}
		@media (max-width: 620px){
			/*.tp_anl ul.nav-tabs li {width: 100%;}*/
			.icn_anl {display: none;}
			/*.total_purchase {display: none;}*/
			.tp_anl ul.nav-tabs li .icn_anl_rt {width: auto;}
			.nav-item .nav-link.active .anl_crd:after {display: none;}
			.tp_anl ul.nav-tabs li .top_in_op h1 {font-size: 12px!important;}
			.tp_anl ul.nav-tabs li .icn_anl_rt {padding-left: 0px;}
			.nav-item .nav-link .anl_crd {padding: 8px 15px!important;}
			.tp_anl ul li {margin-right: 10px!important;}
			.tp_anl ul.nav-tabs li .anl_crd {margin-bottom: 5px!important;}
			
		}
		@media (max-width: 510px){ 
			.top_blk_inv li {border-right: none;}
			.top_blk_inv li:last-child {margin-top: 10px;}
		}
		@media (max-width: 490px){ 
			.date_anl, .btn_anl {width: 100%; margin-top: 10px;}
		}
	#cash_tbl_tbl_wrapper .dataTables_filter {margin-top: 0px!important;}
	</style>

	
	<div class="top_ttl_blk"> <span> Reports </span></div>
	<div class="trd_cr_r">
		<div class="reports_menu mobile_reprts"> 
			<span class="act_rppt"> Loans </span>
			<ul> 
<li class="act"> <a href="#over_reports" title=""> Overall Reports </a> </li>
<li> <a href="#users_st" title=""> Users </a> </li>
<li> <a href="#company" title=""> Company </a> </li>
<li> <a href="#trades" title=""> Traders </a> </li>
<li> <a href="#inventery" title=""> Inventery </a> </li>
<li> <a href="#loans" title=""> Loans </a> </li>
<li> <a href="#sales" title=""> Sales </a> </li>
<li> <a href="#trade_start" title=""> Trades </a> </li>
<li> <a href="#pay_rec" title=""> Payables & Receivables </a> </li>
<li> <a href="#cash_book" title=""> Cash Book </a> </li>
			</ul>
		</div>
		<div class="rprt_anl"> 

			<!-- inventery start -->
			<div id="inventery" class="reports_main"> 
				<div class="top_blk_inv"> 
					<div class="anl_crd"> 
						<ul> 
							<li> 
								<i class="fa fa-filter date_fil" aria-hidden="true" style="font-size: 9px;"></i>
								<div class="top_in_op">
                            <p>Date</p>
                            <h1 id="total_purchase">12-May-2020 to 10-Jun-2020</h1>
                        </div>
							</li>

							<li> 
								<i class="fa fa-filter date_fil" aria-hidden="true" style="font-size: 9px;"></i>
								<div class="top_in_op">
                            <p>Select Branch</p>
                            <h1>All Branches</h1>
                        </div>
							</li>


						</ul>
					</div>
				</div>
				<div class="tp_anl"> 
					<ul class="nav nav-tabs" role="tablist"> 
						<li class="nav-item"> 
							<a href="#feed" data-toggle="tab" role="tab" title="" class="nav-link active show">
								<div class="anl_crd bor_lf_none"> 
						<div class="anl_tp">							
							<div class="icn_anl"> 
								<img src="http://3.7.44.132/aquacredit/assets/images/amnt_icn.png" alt="" title="" class="mCS_img_loaded">
							</div>
							<div class="icn_anl_rt"> 
								<div class="top_in_op">
                            <p>Feed</p>
                            <h1 id="total_purchase">₹10,25000</h1>
                        </div>                     
							</div>
					</div>
					</div>
							</a>
						</li>
						<li class="nav-item"> 
							<a href="#medicine" role="tab" data-toggle="tab" title="" class="nav-link">
								<div class="anl_crd bor_lf_none"> 
						<div class="anl_tp">							
							<div class="icn_anl"> 
								<img src="http://3.7.44.132/aquacredit/assets/images/amnt_icn.png" alt="" title="" class="mCS_img_loaded">
							</div>
							<div class="icn_anl_rt"> 
								<div class="top_in_op">
                            <p>Medicine</p>
                            <h1 id="total_purchase">₹10,25000</h1>
                        </div>                     
							</div>
					</div>
					</div>
							</a>
						</li>
						<li class="nav-item"> 
							<a href="#mechinery" role="tab" data-toggle="tab" title="" class="nav-link">
								<div class="anl_crd bor_lf_none"> 
						<div class="anl_tp">							
							<div class="icn_anl"> 
								<img src="http://3.7.44.132/aquacredit/assets/images/amnt_icn.png" alt="" title="" class="mCS_img_loaded">
							</div>
							<div class="icn_anl_rt"> 
								<div class="top_in_op">
                            <p>Mechinery</p>
                            <h1 id="total_purchase">₹10,25000</h1>
                        </div>                     
							</div>
					</div>
					</div>
							</a>
						</li>
					</ul>
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane active show fade in" id="feed">
							<div class="res_tbl">
									<table id="feed_brand">
										<thead>
											<tr> 
												<th> Company Name </th>
												<th class="txt_rt"> Opening <span class="ttl_th"> Total: 50,000 </span></th>
												<th class="txt_rt"> Inwards <span class="ttl_th"> Total: 50,000 </span> </th>
												<th class="txt_rt"> Outwards <span class="ttl_th"> Total: 50,000 </span> </th>
												<th class="txt_rt"> Closing <span class="ttl_th"> Total: 50,000 </span> </th>
											</tr>
										</thead>
										<tbody>
											<tr> 
												<td> Company Name </td>
												<td class="txt_rt"> 27,000</td>
												<td class="txt_rt"> 9,000 </td>
												<td class="txt_rt"> 20,000 </td>
												<td class="txt_rt"> 18,000 </td>
											</tr>
											<tr> 
												<td> Company Name </td>
												<td class="txt_rt"> 27,000</td>
												<td class="txt_rt"> 9,000 </td>
												<td class="txt_rt"> 20,000 </td>
												<td class="txt_rt"> 18,000 </td>
											</tr>
											<tr> 
												<td> Company Name </td>
												<td class="txt_rt"> 27,000</td>
												<td class="txt_rt"> 9,000 </td>
												<td class="txt_rt"> 20,000 </td>
												<td class="txt_rt"> 18,000 </td>
											</tr>
											<tr> 
												<td> Company Name </td>
												<td class="txt_rt"> 27,000</td>
												<td class="txt_rt"> 9,000 </td>
												<td class="txt_rt"> 20,000 </td>
												<td class="txt_rt"> 18,000 </td>
											</tr>
											<tr> 
												<td> Company Name </td>
												<td class="txt_rt"> 27,000</td>
												<td class="txt_rt"> 9,000 </td>
												<td class="txt_rt"> 20,000 </td>
												<td class="txt_rt"> 18,000 </td>
											</tr>
											<tr> 
												<td> Company Name </td>
												<td class="txt_rt"> 27,000</td>
												<td class="txt_rt"> 9,000 </td>
												<td class="txt_rt"> 20,000 </td>
												<td class="txt_rt"> 18,000 </td>
											</tr>
											<tr> 
												<td> Company Name </td>
												<td class="txt_rt"> 27,000</td>
												<td class="txt_rt"> 9,000 </td>
												<td class="txt_rt"> 20,000 </td>
												<td class="txt_rt"> 18,000 </td>
											</tr>
											<tr> 
												<td> Company Name </td>
												<td class="txt_rt"> 27,000</td>
												<td class="txt_rt"> 9,000 </td>
												<td class="txt_rt"> 20,000 </td>
												<td class="txt_rt"> 18,000 </td>
											</tr>
											<tr> 
												<td> Company Name </td>
												<td class="txt_rt"> 27,000</td>
												<td class="txt_rt"> 9,000 </td>
												<td class="txt_rt"> 20,000 </td>
												<td class="txt_rt"> 18,000 </td>
											</tr>
											<tr> 
												<td> Company Name </td>
												<td class="txt_rt"> 27,000</td>
												<td class="txt_rt"> 9,000 </td>
												<td class="txt_rt"> 20,000 </td>
												<td class="txt_rt"> 18,000 </td>
											</tr>
											<tr> 
												<td> Company Name </td>
												<td class="txt_rt"> 27,000</td>
												<td class="txt_rt"> 9,000 </td>
												<td class="txt_rt"> 20,000 </td>
												<td class="txt_rt"> 18,000 </td>
											</tr>
										</tbody>
									</table>

									<table id="feed_Product">
										<thead>
											<tr> 
												<th> <span class="back_btn"> <img src="http://3.7.44.132/aquacredit/assets/images/back_btn.png"> </span> Product Name </th>
												<th class="txt_rt"> Opening <span class="ttl_th"> Total: 50,000 </span></th>
												<th class="txt_rt"> Inwards <span class="ttl_th"> Total: 50,000 </span> </th>
												<th class="txt_rt"> Outwards <span class="ttl_th"> Total: 50,000 </span> </th>
												<th class="txt_rt"> Closing <span class="ttl_th"> Total: 50,000 </span> </th>
											</tr>
										</thead>
										<tbody>
											<tr> 
												<td> Product Name </td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
											</tr>
											<tr> 
												<td> Product Name </td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
											</tr>
											<tr> 
												<td> Product Name </td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
											</tr>
											<tr> 
												<td> Product Name </td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
											</tr>
											<tr> 
												<td> Product Name </td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
											</tr>
											<tr> 
												<td> Product Name </td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
											</tr>
											<tr> 
												<td> Product Name </td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
											</tr>
											<tr> 
												<td> Product Name </td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
											</tr>
											<tr> 
												<td> Product Name </td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
											</tr>
											<tr> 
												<td> Product Name </td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
											</tr>
											<tr> 
												<td> Product Name </td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
											</tr>
										</tbody>
									</table>
<table id="feed_month">
	<thead>
				<tr> 
												<th> <span class="back_btn"> <img src="http://3.7.44.132/aquacredit/assets/images/back_btn.png"> </span> Month </th>
												<th class="txt_rt"> Opening <span class="ttl_th"> Total: 50,000 </span></th>
												<th class="txt_rt"> Inwards <span class="ttl_th"> Total: 50,000 </span> </th>
												<th class="txt_rt"> Outwards <span class="ttl_th"> Total: 50,000 </span> </th>
												<th class="txt_rt"> Closing <span class="ttl_th"> Total: 50,000 </span> </th>
											</tr>
										</thead>

										<tbody>
											<tr> 
												<td> November - <span class="blu_txt"> 2019 </span> </td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
											</tr>

											<tr> 
												<td> December - <span class="blu_txt"> 2019 </span> </td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
											</tr>

											<tr> 
												<td> January - <span class="blu_txt"> 2020 </span> </td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
											</tr>

											<tr> 
												<td> February - <span class="blu_txt"> 2020 </span> </td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
											</tr>

											<tr> 
												<td> March - <span class="blu_txt"> 2020 </span> </td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
											</tr>

											<tr> 
												<td> April - <span class="blu_txt"> 2020 </span> </td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
											</tr>

											<tr> 
												<td> May - <span class="blu_txt"> 2020 </span> </td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
											</tr>

											<tr> 
												<td> June - <span class="blu_txt"> 2020 </span> </td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
											</tr>	

										</tbody>
</table>


<table id="feed_date">
	<thead>
				<tr> 
												<th> <span class="back_btn"> <img src="http://3.7.44.132/aquacredit/assets/images/back_btn.png"> </span> Date </th>
												<th>Type</th>
												<th class="txt_rt"> Opening <span class="ttl_th"> Total: 50,000 </span></th>
												<th class="txt_rt"> Inwards <span class="ttl_th"> Total: 50,000 </span> </th>
												<th class="txt_rt"> Outwards <span class="ttl_th"> Total: 50,000 </span> </th>
												<th class="txt_rt"> Closing <span class="ttl_th"> Total: 50,000 </span> </th>
											</tr>
										</thead>

										<tbody>
											<tr> 
												<td> 01-Dec-2019  </td>
												<td> 
													<div class="blu_txt"> <b>Sale (SL65896)</b> </div>
													<div><b>Prudhvi.Ps </b> </div>
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
												<td class="txt_rt"> 
													
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>10 Bags</b> </span>  <span> X 1000.00 </span> </div>
													<div class="txt_rt"> = <b>10,000</b> </div>
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>20 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>18,000</b> </div>
												</td>
											</tr>


											<tr> 
												<td> 01-Dec-2019  </td>
												<td> 
													<div class="blu_txt"> <b>Sale (SL65896)</b> </div>
													<div><b>Prudhvi.Ps </b> </div>
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>20 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>18,000</b> </div>
												</td>
												<td class="txt_rt"> 
													
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>10 Bags</b> </span>  <span> X 1000.00 </span> </div>
													<div class="txt_rt"> = <b>10,000</b> </div>
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>10 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>9,000</b> </div>
												</td>
											</tr>

											<tr> 
												<td> 01-Dec-2019  </td>
												<td> 
													<div class="blu_txt"> <b>Purchase  (PU65896)</b> </div>
													<div><b>Prudhvi.Ps </b> </div>
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>10 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>9,000</b> </div>
												</td>
												<td class="txt_rt"> 
														<div class="txt_rt"> <span class="blu_txt"> <b>20 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>18,000</b> </div>
												</td>
												<td class="txt_rt"> 
													
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
											</tr>

											<tr> 
												<td> 01-Dec-2019  </td>
												<td> 
													<div class="blu_txt"> <b>Sale (SL65896)</b> </div>
													<div><b>Prudhvi.Ps </b> </div>
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
												<td class="txt_rt"> 
													
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>10 Bags</b> </span>  <span> X 1000.00 </span> </div>
													<div class="txt_rt"> = <b>10,000</b> </div>
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>20 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>18,000</b> </div>
												</td>
											</tr>

											<tr> 
												<td> 01-Dec-2019  </td>
												<td> 
													<div class="blu_txt"> <b>Sale (SL65896)</b> </div>
													<div><b>Prudhvi.Ps </b> </div>
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>20 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
												<td class="txt_rt"> 
														<div class="txt_rt"> <span class="blu_txt"> <b>10 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>9,000</b> </div>
												</td>
												<td class="txt_rt"> 
													
												</td>
												<td class="txt_rt"> 
													<div class="txt_rt"> <span class="blu_txt"> <b>30 Bags</b> </span>  <span> X 900.00 </span> </div>
													<div class="txt_rt"> = <b>27,000</b> </div>
												</td>
											</tr>
											

										</tbody>
</table>

							</div>
						</div>
						<div role="tabpanel" class="tab-pane fade" id="medicine">...medicine...</div>
						<div role="tabpanel" class="tab-pane fade" id="mechinery">...mechinery...</div>
					</div>
				</div>
			</div>
			<!-- inventery end -->

			<!-- Loans Start -->
				<div id="loans" class="reports_main">
					<div class="anl_btn"> 
						<div class="anl_crd bor_lf_none date_anl fl"> 
					<i class="fa fa-filter date_fil" aria-hidden="true" style="font-size: 9px;"></i>
					<div class="top_in_op">
                            <p>Date</p>
                            <h1 id="total_purchase">12-May-2020 to 10-Jun-2020</h1>
                        </div>
				</div>
				<div class="btn_anl fr btn btn-primary"> Show All Analytics </div>
					 </div>
					 <div class="al_anl"> </div>
					<div class="anl_mb_blk"> 
						<div class="anl_crd bor_lf_none"> 
						<div class="anl_tp">							
							<div class="icn_anl"> 
								<img src="http://3.7.44.132/aquacredit/assets/images/amnt_icn.png" alt="" title="" class="mCS_img_loaded">
							</div>
							<div class="icn_anl_rt"> 
								<div class="top_in_op">
                            <p>Cash (1)</p>
                            <h1 id="total_purchase">₹40,000</h1>
                        </div>                     
							</div>
					</div>
					</div>
					<div class="anl_crd bor_lf_none"> 
						<div class="anl_tp">							
							<div class="icn_anl"> 
								<img src="http://3.7.44.132/aquacredit/assets/images/amnt_icn.png" alt="" title="" class="mCS_img_loaded">
							</div>
							<div class="icn_anl_rt"> 
								<div class="top_in_op">
                            <p>Bank (1)</p>
                            <h1 id="total_purchase">₹40,000</h1>
                        </div>                     
							</div>
					</div>
					</div>
							<div class="anl_crd bor_lf_none">
					<div class="anl_tp">
							<div class="icn_anl"> 
								<img src="http://3.7.44.132/aquacredit/assets/images/amnt_icn.png" alt="" title="">
							</div>
							<div class="icn_anl_rt"> 
								<div class="top_in_op">
                            <p>Total  Loans</p>
                            <h1 id="total_purchase">₹40,000</h1>
                        </div>                     
							</div>
					</div>
					   <ul class="btm_blk_anl"> 
                        	<li> 
                        		<div class="lft_tl"> Farmer </div>
                        		<div class="rt_prc"> ₹ 10,000 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Dealer </div>
                        		<div class="rt_prc"> ₹ 20,000 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Non-Farmer </div>
                        		<div class="rt_prc"> ₹ 10,000 </div>
                        	</li>
                        </ul>
				</div>
				<div class="anl_crd bor_lf_none">
					<div class="anl_tp">
							<div class="icn_anl"> 
								<img src="http://3.7.44.132/aquacredit/assets/images/amnt_icn.png" alt="" title="">
							</div>
							<div class="icn_anl_rt"> 
								<div class="top_in_op">
                            <p>Total Intrest</p>
                            <h1 id="total_purchase">₹3,000</h1>
                        </div>                     
							</div>
					</div>
					   <ul class="btm_blk_anl"> 
                        	<li> 
                        		<div class="lft_tl"> Farmer </div>
                        		<div class="rt_prc"> ₹ 1,000 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Dealer </div>
                        		<div class="rt_prc"> ₹ 2,000 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Non-Farmer </div>
                        		<div class="rt_prc"> ₹ 1,000 </div>
                        	</li>
                        </ul>
				</div>

				<div class="anl_crd bor_lf_none">
					<div class="anl_tp">
						<div class="ttl_anl"> Loan Type </div>
					</div>
					   <ul class="btm_blk_anl"> 
                        	<li> 
                        		<div class="lft_tl"> Farmer </div>
                        		<div class="rt_prc"> ₹ 1,000 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Dealer </div>
                        		<div class="rt_prc"> ₹ 2,000 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Non-Farmer </div>
                        		<div class="rt_prc"> ₹ 1,000 </div>
                        	</li>
                        </ul>
				</div>

					</div>
			<div class="anlts"> 
				<div class="anl_crd bor_lf_none date_anl"> 
					<i class="fa fa-filter date_fil" aria-hidden="true" style="font-size: 9px;"></i>
					<div class="top_in_op">
                            <p>Date</p>
                            <h1 id="total_purchase">12-May-2020 to 10-Jun-2020</h1>
                        </div>
				</div>

				<div class="anl_crd bor_lf_none">
					<div class="anl_tp">
							<div class="icn_anl"> 
								<img src="http://3.7.44.132/aquacredit/assets/images/amnt_icn.png" alt="" title="">
							</div>
							<div class="icn_anl_rt"> 
								<div class="top_in_op">
                            <p>Total  Loans</p>
                            <h1 id="total_purchase">₹40,000</h1>
                        </div>                     
							</div>
					</div>
					   <ul class="btm_blk_anl"> 
                        	<li> 
                        		<div class="lft_tl"> Farmer </div>
                        		<div class="rt_prc"> ₹ 10,000 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Dealer </div>
                        		<div class="rt_prc"> ₹ 20,000 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Non-Farmer </div>
                        		<div class="rt_prc"> ₹ 10,000 </div>
                        	</li>
                        </ul>
				</div>


				<div class="anl_crd bor_lf_none">
					<div class="anl_tp">
							<div class="icn_anl"> 
								<img src="http://3.7.44.132/aquacredit/assets/images/amnt_icn.png" alt="" title="">
							</div>
							<div class="icn_anl_rt"> 
								<div class="top_in_op">
                            <p>Total Intrest</p>
                            <h1 id="total_purchase">₹3,000</h1>
                        </div>                     
							</div>
					</div>
					   <ul class="btm_blk_anl"> 
                        	<li> 
                        		<div class="lft_tl"> Farmer </div>
                        		<div class="rt_prc"> ₹ 1,000 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Dealer </div>
                        		<div class="rt_prc"> ₹ 2,000 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Non-Farmer </div>
                        		<div class="rt_prc"> ₹ 1,000 </div>
                        	</li>
                        </ul>
				</div>


				<div class="anl_crd bor_lf_none">
					<div class="anl_tp">
						<div class="ttl_anl"> Loan Type </div>
					</div>
					   <ul class="btm_blk_anl"> 
                        	<li> 
                        		<div class="lft_tl"> Farmer </div>
                        		<div class="rt_prc"> ₹ 1,000 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Dealer </div>
                        		<div class="rt_prc"> ₹ 2,000 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Non-Farmer </div>
                        		<div class="rt_prc"> ₹ 1,000 </div>
                        	</li>
                        </ul>
				</div>


			</div>

			<div class="tbls_blk"> 
				<div class="tp_anl"> 
					<ul> <li>
					<div class="anl_crd bor_lf_none"> 
						<div class="anl_tp">							
							<div class="icn_anl"> 
								<img src="http://3.7.44.132/aquacredit/assets/images/amnt_icn.png" alt="" title="" class="mCS_img_loaded">
							</div>
							<div class="icn_anl_rt"> 
								<div class="top_in_op">
                            <p>Cash (1)</p>
                            <h1 id="total_purchase">₹40,000</h1>
                        </div>                     
							</div>
					</div>
					</div>
				</li>
				<li>
					<div class="anl_crd bor_lf_none"> 
						<div class="anl_tp">							
							<div class="icn_anl"> 
								<img src="http://3.7.44.132/aquacredit/assets/images/amnt_icn.png" alt="" title="" class="mCS_img_loaded">
							</div>
							<div class="icn_anl_rt"> 
								<div class="top_in_op">
                            <p>Bank (1)</p>
                            <h1 id="total_purchase">₹40,000</h1>
                        </div>                     
							</div>
					</div>
					</div>
				</li>
			</ul>
				</div>

				<div class="res_tbl"> 

<table id="lns_tbl" class="table table-striped table-bordered" style="width:100%">
	<thead>
            <tr>
                <th>User Name</th>
                <th class="txt_rt">Amount</th>
                <th class="txt_rt">Interest</th>
            </tr>
        </thead>
        <tbody>
        	 <tr>
                <td>User Name</td>
                <td class="txt_rt" width="150">₹1000.86</td>
                <td class="txt_rt" width="150">₹100.86</td>
            </tr>
             <tr>
                <td>User Name</td>
                <td class="txt_rt" width="150">₹1000.86</td>
                <td class="txt_rt" width="150">₹100.86</td>
            </tr>
             <tr>
                <td>User Name</td>
                <td class="txt_rt" width="150">₹1000.86</td>
                <td class="txt_rt" width="150">₹100.86</td>
            </tr>
            <tr>
                <td>User Name</td>
                <td class="txt_rt" width="150">₹1000.86</td>
                <td class="txt_rt" width="150">₹100.86</td>
            </tr>
             <tr>
                <td>User Name</td>
                <td class="txt_rt" width="150">₹1000.86</td>
                <td class="txt_rt" width="150">₹100.86</td>
            </tr>
            <tr>
                <td>User Name</td>
                <td class="txt_rt" width="150">₹1000.86</td>
                <td class="txt_rt" width="150">₹100.86</td>
            </tr>
        </tbody>
</table>

				</div>
			</div>
</div>
<!-- Loans End -->


<!-- Sales Start -->
				<div id="sales" class="reports_main">
					<div class="anl_btn"> 
						<div class="anl_crd bor_lf_none date_anl fl"> 
					<i class="fa fa-filter date_fil" aria-hidden="true" style="font-size: 9px;"></i>
					<div class="top_in_op">
                            <p>Date</p>
                            <h1 id="total_purchase">12-May-2020 to 10-Jun-2020</h1>
                        </div>
				</div>
				<div class="btn_anl fr btn btn-primary"> Show All Analytics </div>
					 </div>
					 <div class="al_anl"> </div>
					<div class="anl_mb_blk"> 
									
							<div class="anl_crd bor_lf_none">
					<div class="anl_tp">
							<div class="icn_anl"> 
								<img src="http://3.7.44.132/aquacredit/assets/images/amnt_icn.png" alt="" title="">
							</div>
							<div class="icn_anl_rt"> 
								<div class="top_in_op">
                            <p>Total Sales (200)</p>
                            <h1 id="total_purchase">₹40,000</h1>
                        </div>                     
							</div>
					</div>
					   <ul class="btm_blk_anl"> 
                        	<li> 
                        		<div class="lft_tl"> Feed </div>
                        		<div class="rt_prc"> ₹ 10,000 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Medicine </div>
                        		<div class="rt_prc"> ₹ 20,000 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Mechinery </div>
                        		<div class="rt_prc"> ₹ 10,000 </div>
                        	</li>
                        </ul>
				</div>


				<div class="anl_crd bor_lf_none">
					<div class="anl_tp">
					<div class="top_in_op">
                            <p>Farmer Sales (100)</p>
                            <h1>₹20,000</h1>
                        </div>
					</div>					
				</div>

				<div class="anl_crd bor_lf_none">
					<div class="anl_tp">
					<div class="top_in_op">
                            <p>Dealer Sales (50)</p>
                            <h1>₹10,000</h1>
                        </div>
					</div>					
				</div>

				<div class="anl_crd bor_lf_none">
					<div class="anl_tp">
					<div class="top_in_op">
                            <p>Gust User Sales (50)</p>
                            <h1>₹10,000</h1>
                        </div>
					</div>					
				</div>

<div class="anl_crd bor_lf_none">
					<div class="anl_tp">
							<div class="icn_anl"> 
								<img src="http://3.7.44.132/aquacredit/assets/images/amnt_icn.png" alt="" title="">
							</div>
							<div class="icn_anl_rt"> 
								<div class="top_in_op">
                            <p>Returns</p>
                            <h1 id="total_purchase">₹40,000</h1>
                        </div>                     
							</div>
					</div>
					   <ul class="btm_blk_anl"> 
                        	<li> 
                        		<div class="lft_tl"> Farmers(5) </div>
                        		<div class="rt_prc"> ₹ 10,000 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Dealers(5) </div>
                        		<div class="rt_prc"> ₹ 20,000 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Guest Users(5) </div>
                        		<div class="rt_prc"> ₹ 10,000 </div>
                        	</li>
                        </ul>
				</div>
		

					</div>
			<div class="anlts"> 
				<div class="anl_crd bor_lf_none date_anl"> 
					<i class="fa fa-filter date_fil" aria-hidden="true" style="font-size: 9px;"></i>
					<div class="top_in_op">
                            <p>Date</p>
                            <h1 id="total_purchase">12-May-2020 to 10-Jun-2020</h1>
                        </div>
				</div>

				<div class="anl_crd bor_lf_none">
					<div class="anl_tp">
							<div class="icn_anl"> 
								<img src="http://3.7.44.132/aquacredit/assets/images/amnt_icn.png" alt="" title="">
							</div>
							<div class="icn_anl_rt"> 
								<div class="top_in_op">
                            <p>Total Sales (200)</p>
                            <h1 id="total_purchase">₹40,000</h1>
                        </div>                     
							</div>
					</div>
					   <ul class="btm_blk_anl"> 
                        	<li> 
                        		<div class="lft_tl"> Feed </div>
                        		<div class="rt_prc"> ₹ 10,000 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Medicine </div>
                        		<div class="rt_prc"> ₹ 20,000 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Mechinery </div>
                        		<div class="rt_prc"> ₹ 10,000 </div>
                        	</li>
                        </ul>
				</div>


				<div class="anl_crd bor_lf_none">
					<div class="anl_tp">
					<div class="top_in_op">
                            <p>Farmer Sales (100)</p>
                            <h1>₹20,000</h1>
                        </div>
					</div>					
				</div>

				<div class="anl_crd bor_lf_none">
					<div class="anl_tp">
					<div class="top_in_op">
                            <p>Dealer Sales (50)</p>
                            <h1>₹10,000</h1>
                        </div>
					</div>					
				</div>

				<div class="anl_crd bor_lf_none">
					<div class="anl_tp">
					<div class="top_in_op">
                            <p>Gust User Sales (50)</p>
                            <h1>₹10,000</h1>
                        </div>
					</div>					
				</div>

<div class="anl_crd bor_lf_none">
					<div class="anl_tp">
							<div class="icn_anl"> 
								<img src="http://3.7.44.132/aquacredit/assets/images/amnt_icn.png" alt="" title="">
							</div>
							<div class="icn_anl_rt"> 
								<div class="top_in_op">
                            <p>Returns</p>
                            <h1 id="total_purchase">₹40,000</h1>
                        </div>                     
							</div>
					</div>
					   <ul class="btm_blk_anl"> 
                        	<li> 
                        		<div class="lft_tl"> Farmers(5) </div>
                        		<div class="rt_prc"> ₹ 10,000 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Dealers(5) </div>
                        		<div class="rt_prc"> ₹ 20,000 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Guest Users(5) </div>
                        		<div class="rt_prc"> ₹ 10,000 </div>
                        	</li>
                        </ul>
				</div>
		


			</div>

			<div class="tbls_blk"> 
				<div class="tp_anl"> 
					<ul> <li>
					<div class="anl_crd bor_lf_none"> 
						<div class="anl_tp">							
							<div class="icn_anl" style="padding-top: 0px!important;"> 
								<img src="http://3.7.44.132/aquacredit/assets/images/credit_icn.png" alt="" title="" class="mCS_img_loaded">
							</div>
							<div class="icn_anl_rt"> 
								<div class="top_in_op">
                            <p>Credit Sales (100)</p>
                            <h1 id="total_purchase">₹20,000</h1>
                        </div>                     
							</div>
					</div>
					</div>
				</li>
				<li>
					<div class="anl_crd bor_lf_none"> 
						<div class="anl_tp">							
							<div class="icn_anl" style="padding-top: 0px!important;"> 
								<img src="http://3.7.44.132/aquacredit/assets/images/cash_icn.png" alt="" title="" class="mCS_img_loaded">
							</div>
							<div class="icn_anl_rt"> 
								<div class="top_in_op">
                            <p>Cash Sales (100)</p>
                            <h1 id="total_purchase">₹20,000</h1>
                        </div>                     
							</div>
					</div>
					</div>
				</li>
			</ul>
				</div>

				<div class="res_tbl"> 

<table id="sls_tbl" class="table table-striped table-bordered" style="width:100%">
	<thead>
            <tr>
                <th>Product Name</th>
                <th class="">Brand Name</th>
                <th class="txt_rt">QTY</th>
            </tr>
        </thead>
        <tbody>
        	 <tr>
                <td>Product Name</td>
                <td class="" width="150">Sanitizers</td>
                <td class="txt_rt" width="150">2000</td>
            </tr>
            <tr>
                <td>Product Name</td>
                <td class="" width="150">Brand Name</td>
                <td class="txt_rt" width="150">2000</td>
            </tr>
             <tr>
                <td>Product Name</td>
                <td class="" width="150">Brand Name</td>
                <td class="txt_rt" width="150">2000</td>
            </tr>
           <tr>
                <td>Product Name</td>
                <td class="" width="150">Brand Name</td>
                <td class="txt_rt" width="150">2000</td>
            </tr>
             <tr>
                <td>Product Name</td>
                <td class="" width="150">Brand Name</td>
                <td class="txt_rt" width="150">2000</td>
            </tr>
            <tr>
                <td>Product Name</td>
                <td class="" width="150">Brand Name</td>
                <td class="txt_rt" width="150">2000</td>
            </tr>
        </tbody>
</table>

				</div>
			</div>
</div>
<!-- Sales End -->

<!-- Trades Start -->

	<div id="trade_start" class="reports_main">
		<div class="anl_btn"> 
						<div class="anl_crd bor_lf_none date_anl fl"> 
					<i class="fa fa-filter date_fil" aria-hidden="true" style="font-size: 9px;"></i>
					<div class="top_in_op">
                            <p>Date</p>
                            <h1 id="total_purchase">12-May-2020 to 10-Jun-2020</h1>
                        </div>
				</div>
				<div class="btn_anl fr btn btn-primary"> Show All Analytics </div>
					 </div>
					 <div class="al_anl"> </div>

					 <div class="anl_mb_blk"> 
					 	<div class="anl_crd bor_lf_none">
					<div class="anl_tp">
							<div class="icn_anl"> 
								<img src="http://3.7.44.132/aquacredit/assets/images/amnt_icn.png" alt="" title="" class="mCS_img_loaded">
							</div>
							<div class="icn_anl_rt"> 
								<div class="top_in_op">
                            <p>Trades (200)</p>
                            <h1 id="total_purchase">₹2,000</h1>
                        </div>                     
							</div>
					</div>
					   <ul class="btm_blk_anl"> 
                        	<li> 
                        		<div class="lft_tl"> Farmers </div>
                        		<div class="rt_prc"> ₹1,000 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Gust Users </div>
                        		<div class="rt_prc"> ₹1,000 </div>
                        	</li>
                        </ul>
				</div>

				<div class="anl_crd bor_lf_none">
					<div class="anl_tp">
							<div class="icn_anl"> 
								<img src="http://3.7.44.132/aquacredit/assets/images/amnt_icn.png" alt="" title="" class="mCS_img_loaded">
							</div>
							<div class="icn_anl_rt"> 
								<div class="top_in_op">
                            <p>Trade Profit</p>
                            <h1 id="total_purchase">₹200</h1>
                        </div>                     
							</div>
					</div>
					   <ul class="btm_blk_anl"> 
                        	<li> 
                        		<div class="lft_tl"> Farmers (20) </div>
                        		<div class="rt_prc"> ₹100 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Gust Users (20) </div>
                        		<div class="rt_prc"> ₹100 </div>
                        	</li>
                        </ul>
				</div>

				<div class="anl_crd bor_lf_none">
					<div class="anl_tp">
							<div class="icn_anl"> 
								<img src="http://3.7.44.132/aquacredit/assets/images/amnt_icn.png" alt="" title="" class="mCS_img_loaded">
							</div>
							<div class="icn_anl_rt"> 
								<div class="top_in_op">
                            <p>Trade Tonnage</p>
                            <h1 id="total_purchase">500.123 tons</h1>
                        </div>                     
							</div>
					</div>
					   <ul class="btm_blk_anl"> 
                        	<li> 
                        		<div class="lft_tl"> Farmers </div>
                        		<div class="rt_prc"> 300.00 tons </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Gust Users </div>
                        		<div class="rt_prc"> 200.123 tons </div>
                        	</li>
                        </ul>
				</div>

				<div class="anl_crd bor_lf_none">
					<h2 class="create_hdg"> Transport Details </h2>
					<ul class="conts_anl"> 
						<li> 10.00c </li>
						<li> 35.05c </li>
						<li> SLc </li>
						<li> 10.00c </li>
						<li> 35.05c </li>
						<li> SLc </li>
						<li> 10.00c </li>
						<li> 35.05c </li>
						<li> SLc </li>
					</ul>
				</div>
					 </div>
		<div class="anlts">
			<div class="anl_crd bor_lf_none date_anl"> 
					<i class="fa fa-filter date_fil" aria-hidden="true" style="font-size: 9px;"></i>
					<div class="top_in_op">
                            <p>Date</p>
                            <h1 id="total_purchase">12-May-2020 to 10-Jun-2020</h1>
                        </div>
				</div>
					<div class="anl_crd bor_lf_none">
					<div class="anl_tp">
							<div class="icn_anl"> 
								<img src="http://3.7.44.132/aquacredit/assets/images/amnt_icn.png" alt="" title="" class="mCS_img_loaded">
							</div>
							<div class="icn_anl_rt"> 
								<div class="top_in_op">
                            <p>Trades (200)</p>
                            <h1 id="total_purchase">₹2,000</h1>
                        </div>                     
							</div>
					</div>
					   <ul class="btm_blk_anl"> 
                        	<li> 
                        		<div class="lft_tl"> Farmers </div>
                        		<div class="rt_prc"> ₹1,000 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Gust Users </div>
                        		<div class="rt_prc"> ₹1,000 </div>
                        	</li>
                        </ul>
				</div>

				<div class="anl_crd bor_lf_none">
					<div class="anl_tp">
							<div class="icn_anl"> 
								<img src="http://3.7.44.132/aquacredit/assets/images/amnt_icn.png" alt="" title="" class="mCS_img_loaded">
							</div>
							<div class="icn_anl_rt"> 
								<div class="top_in_op">
                            <p>Trade Profit</p>
                            <h1 id="total_purchase">₹200</h1>
                        </div>                     
							</div>
					</div>
					   <ul class="btm_blk_anl"> 
                        	<li> 
                        		<div class="lft_tl"> Farmers (20) </div>
                        		<div class="rt_prc"> ₹100 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Gust Users (20) </div>
                        		<div class="rt_prc"> ₹100 </div>
                        	</li>
                        </ul>
				</div>

				<div class="anl_crd bor_lf_none">
					<div class="anl_tp">
							<div class="icn_anl"> 
								<img src="http://3.7.44.132/aquacredit/assets/images/amnt_icn.png" alt="" title="" class="mCS_img_loaded">
							</div>
							<div class="icn_anl_rt"> 
								<div class="top_in_op">
                            <p>Trade Tonnage</p>
                            <h1 id="total_purchase">500.123 tons</h1>
                        </div>                     
							</div>
					</div>
					   <ul class="btm_blk_anl"> 
                        	<li> 
                        		<div class="lft_tl"> Farmers </div>
                        		<div class="rt_prc"> 300.00 tons </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Gust Users </div>
                        		<div class="rt_prc"> 200.123 tons </div>
                        	</li>
                        </ul>
				</div>

				<div class="anl_crd bor_lf_none">
					<h2 class="create_hdg"> Transport Details </h2>
					<ul class="conts_anl"> 
						<li> 10.00c </li>
						<li> 35.05c </li>
						<li> SLc </li>
						<li> 10.00c </li>
						<li> 35.05c </li>
						<li> SLc </li>
						<li> 10.00c </li>
						<li> 35.05c </li>
						<li> SLc </li>
					</ul>
				</div>
					</div>
			
			<div class="tbls_blk"> 
					
				<div class="res_tbl"> 
					<table id="harv_dtls">
						<thead>
							<tr> 
								<th> User Name  </th>
								<th class="txt_rt"> Tonnage  </th>
							</tr>
						</thead>	
						<tbody>
							<tr> 
								<td> User Name </td>
								<td class="txt_rt"> 1000.123 tons </td>
							</tr>
							<tr> 
								<td> User Name </td>
								<td class="txt_rt"> 1000.123 tons </td>
							</tr>
							<tr> 
								<td> User Name </td>
								<td class="txt_rt"> 1000.123 tons </td>
							</tr>
							<tr> 
								<td> User Name </td>
								<td class="txt_rt"> 1000.123 tons </td>
							</tr>
							<tr> 
								<td> User Name </td>
								<td class="txt_rt"> 1000.123 tons </td>
							</tr>
							<tr> 
								<td> User Name </td>
								<td class="txt_rt"> 1000.123 tons </td>
							</tr>
							<tr> 
								<td> User Name </td>
								<td class="txt_rt"> 1000.123 tons </td>
							</tr>
							<tr> 
								<td> User Name </td>
								<td class="txt_rt"> 1000.123 tons </td>
							</tr>
							<tr> 
								<td> User Name </td>
								<td class="txt_rt"> 1000.123 tons </td>
							</tr>
							<tr> 
								<td> User Name </td>
								<td class="txt_rt"> 1000.123 tons </td>
							</tr>
						</tbody>
					</table>
				</div>


				<div class="res_tbl" style="margin-top: 15px;"> 
					<table id="tonnge_tbl">
						<thead>
							<tr> 
								<th> Type  </th>
								<th> Count  </th>
								<th class="txt_rt"> Tonnage  </th>
							</tr>
						</thead>	
						<tbody>
							<tr> 
								<td> User Name </td>
								<td>  10c </td>
								<td class="txt_rt"> 2000 </td>
							</tr>
							<tr> 
								<td> User Name </td>
								<td>  10c </td>
								<td class="txt_rt"> 2000 </td>
							</tr>
							<tr> 
								<td> User Name </td>
								<td>  10c </td>
								<td class="txt_rt"> 2000 </td>
							</tr>
							<tr> 
								<td> User Name </td>
								<td>  10c </td>
								<td class="txt_rt"> 2000 </td>
							</tr>
							<tr> 
								<td> User Name </td>
								<td>  10c </td>
								<td class="txt_rt"> 2000 </td>
							</tr>
							<tr> 
								<td> User Name </td>
								<td>  10c </td>
								<td class="txt_rt"> 2000 </td>
							</tr>
							<tr> 
								<td> User Name </td>
								<td>  10c </td>
								<td class="txt_rt"> 2000 </td>
							</tr>
							<tr> 
								<td> User Name </td>
								<td>  10c </td>
								<td class="txt_rt"> 2000 </td>
							</tr>
							<tr> 
								<td> User Name </td>
								<td>  10c </td>
								<td class="txt_rt"> 2000 </td>
							</tr>
							<tr> 
								<td> User Name </td>
								<td>  10c </td>
								<td class="txt_rt"> 2000 </td>
							</tr>
						</tbody>
					</table>
				</div>


			</div>

	</div>

<!-- Trades End -->

<!-- Payables & Receivables start -->
	<div id="pay_rec" class="reports_main">
<div class="anl_btn"> 
						<div class="anl_crd bor_lf_none date_anl fl"> 
					<i class="fa fa-filter date_fil" aria-hidden="true" style="font-size: 9px;"></i>
					<div class="top_in_op">
                            <p>Date</p>
                            <h1 id="total_purchase">12-May-2020 to 10-Jun-2020</h1>
                        </div>
				</div>
				<div class="btn_anl fr btn btn-primary"> Show All Analytics </div>
					 </div>
					 <div class="al_anl"> </div>

					 <div class="anl_mb_blk"> 
					 	<div class="anl_crd bor_lf_none">
					<div class="anl_tp">
							<div class="icn_anl"> 
								<img src="http://3.7.44.132/aquacredit/assets/images/amnt_icn.png" alt="" title="" class="mCS_img_loaded">
							</div>
							<div class="icn_anl_rt"> 
								<div class="top_in_op">
                            <p>Receivable Amount</p>
                            <h1 id="total_purchase">₹32,000</h1>
                        </div>                     
							</div>
					</div>
					   <ul class="btm_blk_anl"> 
                        	<li> 
                        		<div class="lft_tl"> Farmers </div>
                        		<div class="rt_prc"> ₹10,000 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Non-Farmers </div>
                        		<div class="rt_prc"> ₹5,000 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Dealers </div>
                        		<div class="rt_prc"> ₹15,000 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Guest Users </div>
                        		<div class="rt_prc"> ₹1,000 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Company </div>
                        		<div class="rt_prc"> ₹5,000 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Traders </div>
                        		<div class="rt_prc"> ₹5,000</div>
                        	</li>
                        </ul>
				</div>

				<div class="anl_crd bor_lf_none">
					<div class="anl_tp">
							<div class="icn_anl"> 
								<img src="http://3.7.44.132/aquacredit/assets/images/amnt_icn.png" alt="" title="" class="mCS_img_loaded">
							</div>
							<div class="icn_anl_rt"> 
								<div class="top_in_op">
                            <p>Payables Amount</p>
                            <h1 id="total_purchase">₹32,000</h1>
                        </div>                     
							</div>
					</div>
					   <ul class="btm_blk_anl"> 
                        	<li> 
                        		<div class="lft_tl"> Farmers </div>
                        		<div class="rt_prc"> ₹10,000 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Non-Farmers </div>
                        		<div class="rt_prc"> ₹5,000 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Dealers </div>
                        		<div class="rt_prc"> ₹15,000 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Guest Users </div>
                        		<div class="rt_prc"> ₹1,000 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Company </div>
                        		<div class="rt_prc"> ₹5,000 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Traders </div>
                        		<div class="rt_prc"> ₹5,000</div>
                        	</li>
                        </ul>
				</div>
					 </div>

			<div class="anlts"> 
				<div class="anl_crd bor_lf_none date_anl"> 
					<i class="fa fa-filter date_fil" aria-hidden="true" style="font-size: 9px;"></i>
					<div class="top_in_op">
                            <p>Date</p>
                            <h1 id="total_purchase">12-May-2020 to 10-Jun-2020</h1>
                        </div>
				</div>
			
				<div class="anl_crd bor_lf_none">
					<div class="anl_tp">
							<div class="icn_anl"> 
								<img src="http://3.7.44.132/aquacredit/assets/images/amnt_icn.png" alt="" title="" class="mCS_img_loaded">
							</div>
							<div class="icn_anl_rt"> 
								<div class="top_in_op">
                            <p>Receivable Amount</p>
                            <h1 id="total_purchase">₹32,000</h1>
                        </div>                     
							</div>
					</div>
					   <ul class="btm_blk_anl"> 
                        	<li> 
                        		<div class="lft_tl"> Farmers </div>
                        		<div class="rt_prc"> ₹10,000 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Non-Farmers </div>
                        		<div class="rt_prc"> ₹5,000 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Dealers </div>
                        		<div class="rt_prc"> ₹15,000 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Guest Users </div>
                        		<div class="rt_prc"> ₹1,000 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Company </div>
                        		<div class="rt_prc"> ₹5,000 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Traders </div>
                        		<div class="rt_prc"> ₹5,000</div>
                        	</li>
                        </ul>
				</div>

				<div class="anl_crd bor_lf_none">
					<div class="anl_tp">
							<div class="icn_anl"> 
								<img src="http://3.7.44.132/aquacredit/assets/images/amnt_icn.png" alt="" title="" class="mCS_img_loaded">
							</div>
							<div class="icn_anl_rt"> 
								<div class="top_in_op">
                            <p>Payables Amount</p>
                            <h1 id="total_purchase">₹32,000</h1>
                        </div>                     
							</div>
					</div>
					   <ul class="btm_blk_anl"> 
                        	<li> 
                        		<div class="lft_tl"> Farmers </div>
                        		<div class="rt_prc"> ₹10,000 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Non-Farmers </div>
                        		<div class="rt_prc"> ₹5,000 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Dealers </div>
                        		<div class="rt_prc"> ₹15,000 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Guest Users </div>
                        		<div class="rt_prc"> ₹1,000 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Company </div>
                        		<div class="rt_prc"> ₹5,000 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Traders </div>
                        		<div class="rt_prc"> ₹5,000</div>
                        	</li>
                        </ul>
				</div>
			
			</div>

			<div class="tbls_blk"> 
				<div class="res_tbl"> 
					<table id="paybl_tble">
						<thead>
							<tr> 
								<th width="50"> Id </th>
								<th> User Name </th>
								<th> Mobile </th>
								<th> Type
									<span class="sts_pp">
						<i class="fa fa-filter" aria-hidden="true" style="font-size: 9px;"></i>
					</span>
					<div class="sts_fil_blk rad_btns"> 
											
												<label class="form-check-label radio_blk checkd" for="utype_all">
												<input class="form-check-input" type="radio" name="user_type_opt" value="" id="utype_all" checked="">
												All</label>
										
											
												<label class="form-check-label radio_blk utypes" for="utype_f">
												<input class="form-check-input" type="radio" name="user_type_opt" value="farmer" id="utype_f">
												Farmer</label>
										
										
												<label class="form-check-label radio_blk utypes" for="utype_nf">
												<input class="form-check-input" type="radio" name="user_type_opt" value="non_farmer" id="utype_nf">
												Non Farmer</label>
										
										
												<label class="form-check-label radio_blk utypes" for="utype_d">
												<input class="form-check-input" type="radio" name="user_type_opt" value="dealer" id="utype_d">
												Dealer/Sub-Dealer</label>
										
											
												<label class="form-check-label radio_blk ttypes" for="ttype_a" style="display: none;">
												<input class="form-check-input" type="radio" name="user_type_opt" value="agent" id="ttype_a">
												Agent</label>
										
											
												<label class="form-check-label radio_blk ttypes" for="ttype_e" style="display: none;">
												<input class="form-check-input" type="radio" name="user_type_opt" value="exporter" id="ttype_e">
												Exporter</label>
											
										</div>
								</th>
								<th class="txt_rt"> Amount </th>
							</tr>
						</thead>
						<tbody>
							<tr> 
								<td width="80"> 3568 </td>
								<td> Sample User Name </td>
								<td width="120"> 9876543210 </td>
								<td> Farmer </td>
								<td class="txt_rt"> ₹100.86 </td>
							</tr>
							<tr> 
								<td width="80"> 3568 </td>
								<td> Sample User Name </td>
								<td width="120"> 9876543210 </td>
								<td> Farmer </td>
								<td class="txt_rt"> ₹100.86 </td>
							</tr>
						</tbody>
					</table>
				</div>

				<div class="res_tbl" style="margin-top: 15px;"> 
					<table id="recv_tble">
						<thead>
							<tr> 
								<th width="50"> Id </th>
								<th> User Name </th>
								<th> Mobile </th>
								<th> Type
									<span class="sts_pp">
						<i class="fa fa-filter" aria-hidden="true" style="font-size: 9px;"></i>
					</span>
					<div class="sts_fil_blk rad_btns"> 
											
												<label class="form-check-label radio_blk checkd" for="utype_all">
												<input class="form-check-input" type="radio" name="user_type_opt" value="" id="utype_all" checked="">
												All</label>
										
											
												<label class="form-check-label radio_blk utypes" for="utype_f">
												<input class="form-check-input" type="radio" name="user_type_opt" value="farmer" id="utype_f">
												Farmer</label>
										
										
												<label class="form-check-label radio_blk utypes" for="utype_nf">
												<input class="form-check-input" type="radio" name="user_type_opt" value="non_farmer" id="utype_nf">
												Non Farmer</label>
										
										
												<label class="form-check-label radio_blk utypes" for="utype_d">
												<input class="form-check-input" type="radio" name="user_type_opt" value="dealer" id="utype_d">
												Dealer/Sub-Dealer</label>
										
											
												<label class="form-check-label radio_blk ttypes" for="ttype_a" style="display: none;">
												<input class="form-check-input" type="radio" name="user_type_opt" value="agent" id="ttype_a">
												Agent</label>
										
											
												<label class="form-check-label radio_blk ttypes" for="ttype_e" style="display: none;">
												<input class="form-check-input" type="radio" name="user_type_opt" value="exporter" id="ttype_e">
												Exporter</label>
											
										</div>
								</th>
								<th class="txt_rt"> Amount </th>
							</tr>
						</thead>
						<tbody>
							<tr> 
								<td width="80"> 3568 </td>
								<td> Sample User Name </td>
								<td width="120"> 9876543210 </td>
								<td> Farmer </td>
								<td class="txt_rt"> ₹100.86 </td>
							</tr>
							<tr> 
								<td width="80"> 3568 </td>
								<td> Sample User Name </td>
								<td width="120"> 9876543210 </td>
								<td> Farmer </td>
								<td class="txt_rt"> ₹100.86 </td>
							</tr>
						</tbody>
					</table>
				</div>

			</div>


	</div>
<!-- Payables & Receivables End -->

<!-- Company Start -->
	<div id="company" class="reports_main">
		<div class="anl_btn"> 
						<div class="anl_crd bor_lf_none date_anl fl"> 
					<i class="fa fa-filter date_fil" aria-hidden="true" style="font-size: 9px;"></i>
					<div class="top_in_op">
                            <p>Date</p>
                            <h1 id="total_purchase">12-May-2020 to 10-Jun-2020</h1>
                        </div>
				</div>
				<div class="btn_anl fr btn btn-primary"> Show All Analytics </div>
					 </div>
					 <div class="al_anl"> </div>
					 <div class="anl_mb_blk"> 

<div class="anl_crd bor_lf_none">
					<div class="anl_tp">
							<div class="icn_anl"> 
								<img src="http://3.7.44.132/aquacredit/assets/images/amnt_icn.png" alt="" title="" class="mCS_img_loaded">
							</div>
							<div class="icn_anl_rt"> 
								<div class="top_in_op">
                            <p>Feed</p>
                            <h1 id="total_purchase">₹3,000</h1>
                        </div>                     
							</div>
					</div>
					   <ul class="btm_blk_anl"> 
                        	<li> 
                        		<div class="lft_tl"> Brands </div>
                        		<div class="rt_prc"> 500 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Products </div>
                        		<div class="rt_prc"> 3000 </div>
                        	</li>
                        </ul>
				</div>
				<div class="anl_crd bor_lf_none">
					<div class="anl_tp">
							<div class="icn_anl"> 
								<img src="http://3.7.44.132/aquacredit/assets/images/amnt_icn.png" alt="" title="" class="mCS_img_loaded">
							</div>
							<div class="icn_anl_rt"> 
								<div class="top_in_op">
                            <p>Medicine</p>
                            <h1 id="total_purchase">₹3,000</h1>
                        </div>                     
							</div>
					</div>
					   <ul class="btm_blk_anl"> 
                        	<li> 
                        		<div class="lft_tl"> Brands </div>
                        		<div class="rt_prc"> 500 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Products </div>
                        		<div class="rt_prc"> 3000 </div>
                        	</li>
                        </ul>
				</div>
				<div class="anl_crd bor_lf_none">
					<div class="anl_tp">
							<div class="icn_anl"> 
								<img src="http://3.7.44.132/aquacredit/assets/images/amnt_icn.png" alt="" title="" class="mCS_img_loaded">
							</div>
							<div class="icn_anl_rt"> 
								<div class="top_in_op">
                            <p>Mechinery</p>
                            <h1 id="total_purchase">₹3,000</h1>
                        </div>                     
							</div>
					</div>
					   <ul class="btm_blk_anl"> 
                        	<li> 
                        		<div class="lft_tl"> Brands </div>
                        		<div class="rt_prc"> 500 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Products </div>
                        		<div class="rt_prc"> 3000 </div>
                        	</li>
                        </ul>
				</div>
					 </div>
		<div class="anlts"> 
			<div class="anl_crd bor_lf_none date_anl"> 
					<i class="fa fa-filter date_fil" aria-hidden="true" style="font-size: 9px;"></i>
					<div class="top_in_op">
                            <p>Date</p>
                            <h1 id="total_purchase">12-May-2020 to 10-Jun-2020</h1>
                        </div>
				</div>

				<div class="anl_crd bor_lf_none">
					<div class="anl_tp">
							<div class="icn_anl"> 
								<img src="http://3.7.44.132/aquacredit/assets/images/amnt_icn.png" alt="" title="" class="mCS_img_loaded">
							</div>
							<div class="icn_anl_rt"> 
								<div class="top_in_op">
                            <p>Feed</p>
                            <h1 id="total_purchase">₹3,000</h1>
                        </div>                     
							</div>
					</div>
					   <ul class="btm_blk_anl"> 
                        	<li> 
                        		<div class="lft_tl"> Brands </div>
                        		<div class="rt_prc"> 500 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Products </div>
                        		<div class="rt_prc"> 3000 </div>
                        	</li>
                        </ul>
				</div>
				<div class="anl_crd bor_lf_none">
					<div class="anl_tp">
							<div class="icn_anl"> 
								<img src="http://3.7.44.132/aquacredit/assets/images/amnt_icn.png" alt="" title="" class="mCS_img_loaded">
							</div>
							<div class="icn_anl_rt"> 
								<div class="top_in_op">
                            <p>Medicine</p>
                            <h1 id="total_purchase">₹3,000</h1>
                        </div>                     
							</div>
					</div>
					   <ul class="btm_blk_anl"> 
                        	<li> 
                        		<div class="lft_tl"> Brands </div>
                        		<div class="rt_prc"> 500 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Products </div>
                        		<div class="rt_prc"> 3000 </div>
                        	</li>
                        </ul>
				</div>
				<div class="anl_crd bor_lf_none">
					<div class="anl_tp">
							<div class="icn_anl"> 
								<img src="http://3.7.44.132/aquacredit/assets/images/amnt_icn.png" alt="" title="" class="mCS_img_loaded">
							</div>
							<div class="icn_anl_rt"> 
								<div class="top_in_op">
                            <p>Mechinery</p>
                            <h1 id="total_purchase">₹3,000</h1>
                        </div>                     
							</div>
					</div>
					   <ul class="btm_blk_anl"> 
                        	<li> 
                        		<div class="lft_tl"> Brands </div>
                        		<div class="rt_prc"> 500 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Products </div>
                        		<div class="rt_prc"> 3000 </div>
                        	</li>
                        </ul>
				</div>

		</div>
		<div class="tbls_blk">

			

					<div class="res_tbl"> 
						<table id="cmp_tbl" class="table table-striped table-bordered" style="width:100%">
	<thead>
            <tr>
                <th>Brand Name</th>
                 <th class="txt_cnt nbm_usr_td" width="80">No of Users</th>
                <th class="txt_rt ttl_amnt_td">Total Amount</th>
                <th class="txt_rt prgt_td">Profit</th>
            </tr>
        </thead>
        <tbody>
        	 <tr>
                <td>Brand Name</td>
                <td class="txt_cnt nbm_usr_td" width="80"><a href="#" title="" data-toggle="modal" data-target="#user_lst"> 10 </a></td>
                <td class="txt_rt ttl_amnt_td" width="150">₹1000.86</td>
                <td class="txt_rt prgt_td" width="150">₹10.86</td>
            </tr>
             <tr>
                <td>Brand Name</td>
                <td class="txt_cnt nbm_usr_td" width="80"><a href="#" title="" data-toggle="modal" data-target="#user_lst"> 10 </a></td>
                <td class="txt_rt ttl_amnt_td" width="150">₹1000.86</td>
                <td class="txt_rt prgt_td" width="150">₹10.86</td>
            </tr>
             <tr>
                <td>Brand Name</td>
                <td class="txt_cnt nbm_usr_td" width="80"><a href="#" title="" data-toggle="modal" data-target="#user_lst"> 10 </a></td>
                <td class="txt_rt ttl_amnt_td" width="150">₹1000.86</td>
                <td class="txt_rt prgt_td" width="150">₹10.86</td>
            </tr>
             <tr>
                <td>Brand Name</td>
                <td class="txt_cnt nbm_usr_td" width="80"><a href="#" title="" data-toggle="modal" data-target="#user_lst"> 10 </a></td>
                <td class="txt_rt ttl_amnt_td" width="150">₹1000.86</td>
                <td class="txt_rt prgt_td" width="150">₹10.86</td>
            </tr>
             <tr>
                <td>Brand Name</td>
                <td class="txt_cnt nbm_usr_td" width="80"><a href="#" title="" data-toggle="modal" data-target="#user_lst"> 10 </a></td>
                <td class="txt_rt ttl_amnt_td" width="150">₹1000.86</td>
                <td class="txt_rt prgt_td" width="150">₹10.86</td>
            </tr>
             <tr>
                <td>Brand Name</td>
                <td class="txt_cnt nbm_usr_td" width="80"><a href="#" title="" data-toggle="modal" data-target="#user_lst"> 10 </a></td>
                <td class="txt_rt ttl_amnt_td" width="150">₹1000.86</td>
                <td class="txt_rt prgt_td" width="150">₹10.86</td>
            </tr>
             <tr>
                <td>Brand Name</td>
                <td class="txt_cnt nbm_usr_td" width="80"><a href="#" title="" data-toggle="modal" data-target="#user_lst"> 10 </a></td>
                <td class="txt_rt ttl_amnt_td" width="150">₹1000.86</td>
                <td class="txt_rt prgt_td" width="150">₹10.86</td>
            </tr>
             <tr>
                <td>Brand Name</td>
                <td class="txt_cnt nbm_usr_td" width="80"><a href="#" title="" data-toggle="modal" data-target="#user_lst"> 10 </a></td>
                <td class="txt_rt ttl_amnt_td" width="150">₹1000.86</td>
                <td class="txt_rt prgt_td" width="150">₹10.86</td>
            </tr>
             <tr>
                <td>Brand Name</td>
                <td class="txt_cnt nbm_usr_td" width="80"><a href="#" title="" data-toggle="modal" data-target="#user_lst"> 10 </a></td>
                <td class="txt_rt ttl_amnt_td" width="150">₹1000.86</td>
                <td class="txt_rt prgt_td" width="150">₹10.86</td>
            </tr>
             <tr>
                <td>Brand Name</td>
                <td class="txt_cnt nbm_usr_td" width="80"><a href="#" title="" data-toggle="modal" data-target="#user_lst"> 10 </a></td>
                <td class="txt_rt ttl_amnt_td" width="150">₹1000.86</td>
                <td class="txt_rt prgt_td" width="150">₹10.86</td>
            </tr>
            
        </tbody>
</table>
					</div>
				</div>
	</div>
<!-- Company End -->

<!-- Over all Reports -->
	<div id="over_reports" class="reports_main">

		<div class="anl_btn"> 
						<div class="anl_crd bor_lf_none date_anl fl"> 
					<i class="fa fa-filter date_fil" aria-hidden="true" style="font-size: 9px;"></i>
					<div class="top_in_op">
                            <p>Date</p>
                            <h1 id="total_purchase">12-May-2020 to 10-Jun-2020</h1>
                        </div>
				</div>
				<div class="btn_anl fr btn btn-primary"> Show All Analytics </div>
					 </div>
					 <div class="al_anl"> </div>

					 <div class="anl_mb_blk"> 
					 	<div class="anl_crd bor_lf_none">
					<div class="anl_tp">
							<div class="icn_anl"> 
								<img src="http://3.7.44.132/aquacredit/assets/images/amnt_icn.png" alt="" title="" class="mCS_img_loaded">
							</div>
							<div class="icn_anl_rt"> 
								<div class="top_in_op">
                            <p>Total Business</p>
                            <h1 id="total_purchase">₹ 5,00000</h1>
                        </div>                     
							</div>
					</div>
					   <ul class="btm_blk_anl"> 
                        	<li> 
                        		<div class="lft_tl"> Loans </div>
                        		<div class="rt_prc"> ₹ 20,0000 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Sales </div>
                        		<div class="rt_prc"> ₹ 10,0000 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Trades </div>
                        		<div class="rt_prc"> ₹ 20,0000 </div>
                        	</li>
                        </ul>
				</div>

				<div class="anl_crd bor_lf_none">
					<div class="anl_tp">
							<div class="icn_anl"> 
								<img src="http://3.7.44.132/aquacredit/assets/images/amnt_icn.png" alt="" title="" class="mCS_img_loaded">
							</div>
							<div class="icn_anl_rt"> 
								<div class="top_in_op">
                            <p>Total Profit</p>
                            <h1 id="total_purchase">₹ 5,00000</h1>
                        </div>                     
							</div>
					</div>
					   <ul class="btm_blk_anl"> 
                        	<li> 
                        		<div class="lft_tl"> Loans </div>
                        		<div class="rt_prc"> ₹ 20,0000 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Sales </div>
                        		<div class="rt_prc"> ₹ 10,0000 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Trades </div>
                        		<div class="rt_prc"> ₹ 20,0000 </div>
                        	</li>
                        </ul>
				</div>

				<div class="anl_crd bor_lf_none">
					<div class="anl_tp">
							<div class="icn_anl"> 
								<img src="http://3.7.44.132/aquacredit/assets/images/amnt_icn.png" alt="" title="" class="mCS_img_loaded">
							</div>
							<div class="icn_anl_rt"> 
								<div class="top_in_op">
                            <p>Trade Tonnage</p>
                            <h1 id="total_purchase">₹ 5,00000</h1>
                        </div>                     
							</div>
					</div>
				</div>

					 </div>

			<div class="anlts"> 
				<div class="anl_crd bor_lf_none date_anl"> 
					<i class="fa fa-filter date_fil" aria-hidden="true" style="font-size: 9px;"></i>
					<div class="top_in_op">
                            <p>Date</p>
                            <h1 id="total_purchase">12-May-2020 to 10-Jun-2020</h1>
                        </div>
				</div>
				<div class="anl_crd bor_lf_none">
					<div class="anl_tp">
							<div class="icn_anl"> 
								<img src="http://3.7.44.132/aquacredit/assets/images/amnt_icn.png" alt="" title="" class="mCS_img_loaded">
							</div>
							<div class="icn_anl_rt"> 
								<div class="top_in_op">
                            <p>Total Business</p>
                            <h1 id="total_purchase">₹ 5,00000</h1>
                        </div>                     
							</div>
					</div>
					   <ul class="btm_blk_anl"> 
                        	<li> 
                        		<div class="lft_tl"> Loans </div>
                        		<div class="rt_prc"> ₹ 20,0000 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Sales </div>
                        		<div class="rt_prc"> ₹ 10,0000 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Trades </div>
                        		<div class="rt_prc"> ₹ 20,0000 </div>
                        	</li>
                        </ul>
				</div>
				<div class="anl_crd bor_lf_none">
					<div class="anl_tp">
							<div class="icn_anl"> 
								<img src="http://3.7.44.132/aquacredit/assets/images/amnt_icn.png" alt="" title="" class="mCS_img_loaded">
							</div>
							<div class="icn_anl_rt"> 
								<div class="top_in_op">
                            <p>Total Profit</p>
                            <h1 id="total_purchase">₹ 5,00000</h1>
                        </div>                     
							</div>
					</div>
					   <ul class="btm_blk_anl"> 
                        	<li> 
                        		<div class="lft_tl"> Loans </div>
                        		<div class="rt_prc"> ₹ 20,0000 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Sales </div>
                        		<div class="rt_prc"> ₹ 10,0000 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Trades </div>
                        		<div class="rt_prc"> ₹ 20,0000 </div>
                        	</li>
                        </ul>
				</div>
				<div class="anl_crd bor_lf_none">
					<div class="anl_tp">
							<div class="icn_anl"> 
								<img src="http://3.7.44.132/aquacredit/assets/images/amnt_icn.png" alt="" title="" class="mCS_img_loaded">
							</div>
							<div class="icn_anl_rt"> 
								<div class="top_in_op">
                            <p>Trade Tonnage</p>
                            <h1 id="total_purchase">₹ 5,00000</h1>
                        </div>                     
							</div>
					</div>
				</div>
			</div>

			<div class="tbls_blk"> 
				<div class="tp_anl"> 
					<div class="anl_crd"> 
						<ul class="over_lst"> 
							<li> <input type="text" placeholder="Search"> </li>						
							
							
							<li class="lnks fr gst_usr_lnk"> Guest Users(50) </li>
							<li class="lnks fr dlr_lnk"> Dealers(50) </li>
							<li class="lnks fr non_far_link"> Non-Farmers(50) </li>
							<li class="lnks fr far_link act"> Farmers(100) </li>
						</ul>
					</div>
				</div>

				<div class="res_tbl"> 
					<table class="al_r_tbl"> 
						<thead>
						<tr> 
							<th> User Name </th>
							<th class="txt_rt"> Loan Amount </th>
							<th class="txt_rt"> Sale Amount </th>
							<th class="txt_rt"> Trade Amount </th>
							<th class="txt_rt"> Total </th>
						</tr>
						</thead>
						<tbody>
							<tr> 
								<td> 
									User Name <span>- USR658</span>
									<div class="td_mob"> 98765432110 </div>
								</td>
								<td class="txt_rt"> 10,000	<div class="sub_prc txt_rt"> Intrest:1000 </div> </td>
								<td class="txt_rt"> 10,000	<div class="sub_prc txt_rt"> Profit:1000 </div> </td>
								<td class="txt_rt"> 10,000	<div class="sub_prc txt_rt"> Profit:1000 </div> </td>
								<td class="txt_rt"> 30,000	<div class="sub_prc txt_rt"> Profit:3000  </div> </td>
							</tr>
							<tr> 
								<td> 
									User Name <span>- USR658</span>
									<div class="td_mob"> 98765432110 </div>
								</td>
								<td class="txt_rt"> 10,000	<div class="sub_prc txt_rt"> Intrest:1000 </div> </td>
								<td class="txt_rt"> 10,000	<div class="sub_prc txt_rt"> Profit:1000 </div> </td>
								<td class="txt_rt"> 10,000	<div class="sub_prc txt_rt"> Profit:1000 </div> </td>
								<td class="txt_rt"> 30,000	<div class="sub_prc txt_rt"> Profit:3000  </div> </td>
							</tr>
							<tr> 
								<td> 
									User Name <span>- USR658</span>
									<div class="td_mob"> 98765432110 </div>
								</td>
								<td class="txt_rt"> 10,000	<div class="sub_prc txt_rt"> Intrest:1000 </div> </td>
								<td class="txt_rt"> 10,000	<div class="sub_prc txt_rt"> Profit:1000 </div> </td>
								<td class="txt_rt"> 10,000	<div class="sub_prc txt_rt"> Profit:1000 </div> </td>
								<td class="txt_rt"> 30,000	<div class="sub_prc txt_rt"> Profit:3000  </div> </td>
							</tr>
							<tr> 
								<td> 
									User Name <span>- USR658</span>
									<div class="td_mob"> 98765432110 </div>
								</td>
								<td class="txt_rt"> 10,000	<div class="sub_prc txt_rt"> Intrest:1000 </div> </td>
								<td class="txt_rt"> 10,000	<div class="sub_prc txt_rt"> Profit:1000 </div> </td>
								<td class="txt_rt"> 10,000	<div class="sub_prc txt_rt"> Profit:1000 </div> </td>
								<td class="txt_rt"> 30,000	<div class="sub_prc txt_rt"> Profit:3000  </div> </td>
							</tr>
							<tr> 
								<td> 
									User Name <span>- USR658</span>
									<div class="td_mob"> 98765432110 </div>
								</td>
								<td class="txt_rt"> 10,000	<div class="sub_prc txt_rt"> Intrest:1000 </div> </td>
								<td class="txt_rt"> 10,000	<div class="sub_prc txt_rt"> Profit:1000 </div> </td>
								<td class="txt_rt"> 10,000	<div class="sub_prc txt_rt"> Profit:1000 </div> </td>
								<td class="txt_rt"> 30,000	<div class="sub_prc txt_rt"> Profit:3000  </div> </td>
							</tr>
							<tr> 
								<td> 
									User Name <span>- USR658</span>
									<div class="td_mob"> 98765432110 </div>
								</td>
								<td class="txt_rt"> 10,000	<div class="sub_prc txt_rt"> Intrest:1000 </div> </td>
								<td class="txt_rt"> 10,000	<div class="sub_prc txt_rt"> Profit:1000 </div> </td>
								<td class="txt_rt"> 10,000	<div class="sub_prc txt_rt"> Profit:1000 </div> </td>
								<td class="txt_rt"> 30,000	<div class="sub_prc txt_rt"> Profit:3000  </div> </td>
							</tr>
							<tr> 
								<td> 
									User Name <span>- USR658</span>
									<div class="td_mob"> 98765432110 </div>
								</td>
								<td class="txt_rt"> 10,000	<div class="sub_prc txt_rt"> Intrest:1000 </div> </td>
								<td class="txt_rt"> 10,000	<div class="sub_prc txt_rt"> Profit:1000 </div> </td>
								<td class="txt_rt"> 10,000	<div class="sub_prc txt_rt"> Profit:1000 </div> </td>
								<td class="txt_rt"> 30,000	<div class="sub_prc txt_rt"> Profit:3000  </div> </td>
							</tr>
							<tr> 
								<td> 
									User Name <span>- USR658</span>
									<div class="td_mob"> 98765432110 </div>
								</td>
								<td class="txt_rt"> 10,000	<div class="sub_prc txt_rt"> Intrest:1000 </div> </td>
								<td class="txt_rt"> 10,000	<div class="sub_prc txt_rt"> Profit:1000 </div> </td>
								<td class="txt_rt"> 10,000	<div class="sub_prc txt_rt"> Profit:1000 </div> </td>
								<td class="txt_rt"> 30,000	<div class="sub_prc txt_rt"> Profit:3000  </div> </td>
							</tr>
							<tr> 
								<td> 
									User Name <span>- USR658</span>
									<div class="td_mob"> 98765432110 </div>
								</td>
								<td class="txt_rt"> 10,000	<div class="sub_prc txt_rt"> Intrest:1000 </div> </td>
								<td class="txt_rt"> 10,000	<div class="sub_prc txt_rt"> Profit:1000 </div> </td>
								<td class="txt_rt"> 10,000	<div class="sub_prc txt_rt"> Profit:1000 </div> </td>
								<td class="txt_rt"> 30,000	<div class="sub_prc txt_rt"> Profit:3000  </div> </td>
							</tr>
							<tr> 
								<td> 
									User Name <span>- USR658</span>
									<div class="td_mob"> 98765432110 </div>
								</td>
								<td class="txt_rt"> 10,000	<div class="sub_prc txt_rt"> Intrest:1000 </div> </td>
								<td class="txt_rt"> 10,000	<div class="sub_prc txt_rt"> Profit:1000 </div> </td>
								<td class="txt_rt"> 10,000	<div class="sub_prc txt_rt"> Profit:1000 </div> </td>
								<td class="txt_rt"> 30,000	<div class="sub_prc txt_rt"> Profit:3000  </div> </td>
							</tr>
							<tr> 
								<td> 
									User Name <span>- USR658</span>
									<div class="td_mob"> 98765432110 </div>
								</td>
								<td class="txt_rt"> 10,000	<div class="sub_prc txt_rt"> Intrest:1000 </div> </td>
								<td class="txt_rt"> 10,000	<div class="sub_prc txt_rt"> Profit:1000 </div> </td>
								<td class="txt_rt"> 10,000	<div class="sub_prc txt_rt"> Profit:1000 </div> </td>
								<td class="txt_rt"> 30,000	<div class="sub_prc txt_rt"> Profit:3000  </div> </td>
							</tr>
							<tr> 
								<td> 
									User Name <span>- USR658</span>
									<div class="td_mob"> 98765432110 </div>
								</td>
								<td class="txt_rt"> 10,000	<div class="sub_prc txt_rt"> Intrest:1000 </div> </td>
								<td class="txt_rt"> 10,000	<div class="sub_prc txt_rt"> Profit:1000 </div> </td>
								<td class="txt_rt"> 10,000	<div class="sub_prc txt_rt"> Profit:1000 </div> </td>
								<td class="txt_rt"> 30,000	<div class="sub_prc txt_rt"> Profit:3000  </div> </td>
							</tr>
							<tr> 
								<td> 
									User Name <span>- USR658</span>
									<div class="td_mob"> 98765432110 </div>
								</td>
								<td class="txt_rt"> 10,000	<div class="sub_prc txt_rt"> Intrest:1000 </div> </td>
								<td class="txt_rt"> 10,000	<div class="sub_prc txt_rt"> Profit:1000 </div> </td>
								<td class="txt_rt"> 10,000	<div class="sub_prc txt_rt"> Profit:1000 </div> </td>
								<td class="txt_rt"> 30,000	<div class="sub_prc txt_rt"> Profit:3000  </div> </td>
							</tr>
							<tr> 
								<td> 
									User Name <span>- USR658</span>
									<div class="td_mob"> 98765432110 </div>
								</td>
								<td class="txt_rt"> 10,000	<div class="sub_prc txt_rt"> Intrest:1000 </div> </td>
								<td class="txt_rt"> 10,000	<div class="sub_prc txt_rt"> Profit:1000 </div> </td>
								<td class="txt_rt"> 10,000	<div class="sub_prc txt_rt"> Profit:1000 </div> </td>
								<td class="txt_rt"> 30,000	<div class="sub_prc txt_rt"> Profit:3000  </div> </td>
							</tr>	
						</tbody>
					</table>
				</div>
			</div>

	</div>
<!-- Over all Reports End -->

<!-- Users Start -->
	<div id="users_st" class="reports_main"> 
		<div class="anl_btn"> 
						<div class="anl_crd bor_lf_none date_anl fl"> 
					<i class="fa fa-filter date_fil" aria-hidden="true" style="font-size: 9px;"></i>
					<div class="top_in_op">
                            <p>Date</p>
                            <h1 id="total_purchase">12-May-2020 to 10-Jun-2020</h1>
                        </div>
				</div>
				<div class="btn_anl fr btn btn-primary"> Show All Analytics </div>
					 </div>
					 <div class="al_anl"> </div>

					 <div class="anl_mb_blk"> 
					 	<div class="anl_crd bor_lf_none">
					<div class="anl_tp">
							<div class="icn_anl"> 
								<img src="http://3.7.44.132/aquacredit/assets/images/amnt_icn.png" alt="" title="" class="mCS_img_loaded">
							</div>
							<div class="icn_anl_rt"> 
								<div class="top_in_op">
                            <p>Total Users</p>
                            <h1 id="total_purchase">32,000</h1>
                        </div>                     
							</div>
					</div>
					   <ul class="btm_blk_anl"> 
                        	<li> 
                        		<div class="lft_tl"> Farmers </div>
                        		<div class="rt_prc"> 10,000 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Non-Farmers </div>
                        		<div class="rt_prc"> 5,000 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Dealers </div>
                        		<div class="rt_prc"> ₹ 20,0000 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Guest </div>
                        		<div class="rt_prc"> ₹ 2,0000 </div>
                        	</li>
                        </ul>
				</div>

				<div class="anl_crd bor_lf_none">
					<div class="anl_tp">
							<div class="icn_anl"> 
								<img src="http://3.7.44.132/aquacredit/assets/images/amnt_icn.png" alt="" title="" class="mCS_img_loaded">
							</div>
							<div class="icn_anl_rt"> 
								<div class="top_in_op">
                            <p>Total Business</p>
                            <h1 id="total_purchase">₹ 50,000</h1>
                        </div>                     
							</div>
					</div>
					   <ul class="btm_blk_anl"> 
                        	<li> 
                        		<div class="lft_tl"> Farmers </div>
                        		<div class="rt_prc"> ₹ 20,000 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Non-Farmers </div>
                        		<div class="rt_prc"> ₹ 10,000 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Dealers </div>
                        		<div class="rt_prc"> ₹ 10,000 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Guest </div>
                        		<div class="rt_prc"> ₹ 10,000 </div>
                        	</li>
                        </ul>
				</div>
				
				<div class="anl_crd bor_lf_none">
					<div class="anl_tp">
							<div class="icn_anl"> 
								<img src="http://3.7.44.132/aquacredit/assets/images/amnt_icn.png" alt="" title="" class="mCS_img_loaded">
							</div>
							<div class="icn_anl_rt"> 
								<div class="top_in_op">
                            <p>Total Acers</p>
                            <h1 id="total_purchase">2,000 Sft</h1>
                        </div>                     
							</div>
					</div>
				</div>
					 </div>
			<div class="anlts"> 
				<div class="anl_crd bor_lf_none date_anl"> 
					<i class="fa fa-filter date_fil" aria-hidden="true" style="font-size: 9px;"></i>
					<div class="top_in_op">
                            <p>Date</p>
                            <h1 id="total_purchase">12-May-2020 to 10-Jun-2020</h1>
                        </div>
				</div>
				<div class="anl_crd bor_lf_none">
					<div class="anl_tp">
							<div class="icn_anl"> 
								<img src="http://3.7.44.132/aquacredit/assets/images/amnt_icn.png" alt="" title="" class="mCS_img_loaded">
							</div>
							<div class="icn_anl_rt"> 
								<div class="top_in_op">
                            <p>Total Users</p>
                            <h1 id="total_purchase">32,000</h1>
                        </div>                     
							</div>
					</div>
					   <ul class="btm_blk_anl"> 
                        	<li> 
                        		<div class="lft_tl"> Farmers </div>
                        		<div class="rt_prc"> 10,000 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Non-Farmers </div>
                        		<div class="rt_prc"> 5,000 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Dealers </div>
                        		<div class="rt_prc"> ₹ 20,0000 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Guest </div>
                        		<div class="rt_prc"> ₹ 2,0000 </div>
                        	</li>
                        </ul>
				</div>

				<div class="anl_crd bor_lf_none">
					<div class="anl_tp">
							<div class="icn_anl"> 
								<img src="http://3.7.44.132/aquacredit/assets/images/amnt_icn.png" alt="" title="" class="mCS_img_loaded">
							</div>
							<div class="icn_anl_rt"> 
								<div class="top_in_op">
                            <p>Total Business</p>
                            <h1 id="total_purchase">₹ 50,000</h1>
                        </div>                     
							</div>
					</div>
					   <ul class="btm_blk_anl"> 
                        	<li> 
                        		<div class="lft_tl"> Farmers </div>
                        		<div class="rt_prc"> ₹ 20,000 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Non-Farmers </div>
                        		<div class="rt_prc"> ₹ 10,000 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Dealers </div>
                        		<div class="rt_prc"> ₹ 10,000 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Guest </div>
                        		<div class="rt_prc"> ₹ 10,000 </div>
                        	</li>
                        </ul>
				</div>
				
				<div class="anl_crd bor_lf_none">
					<div class="anl_tp">
							<div class="icn_anl"> 
								<img src="http://3.7.44.132/aquacredit/assets/images/amnt_icn.png" alt="" title="" class="mCS_img_loaded">
							</div>
							<div class="icn_anl_rt"> 
								<div class="top_in_op">
                            <p>Total Acers</p>
                            <h1 id="total_purchase">2,000 Sft</h1>
                        </div>                     
							</div>
					</div>
				</div>
			</div>

			<div class="tbls_blk"> 
				<div class="res_tbl"> 
					<table id="far_loc">
						<thead>
							<tr> 
								<th> Location </th>
								<th width="100" class="txt_cnt" style="width: 100px;"> Number of Users </th>
								<th width="100" class="txt_rt" style="width: 100px;"> Number of acers </th>
							</tr>
						</thead>
						<tbody>
							<tr> 
								<td> User Name</td>
								<td class="txt_cnt"> <a href="#" title="" data-toggle="modal" data-target="#user_loc_lst"> 22 </a></td>
								<td class="txt_rt"> 22 </td>
							</tr>
							<tr> 
								<td> User Name</td>
								<td class="txt_cnt"> <a href="#" title="" data-toggle="modal" data-target="#user_loc_lst"> 22 </a></td>
								<td class="txt_rt"> 22 </td>
							</tr>
							<tr> 
								<td> User Name</td>
								<td class="txt_cnt"> <a href="#" title="" data-toggle="modal" data-target="#user_loc_lst"> 22 </a></td>
								<td class="txt_rt"> 22 </td>
							</tr>
							<tr> 
								<td> User Name</td>
								<td class="txt_cnt"> <a href="#" title="" data-toggle="modal" data-target="#user_loc_lst"> 22 </a></td>
								<td class="txt_rt"> 22 </td>
							</tr>
							<tr> 
								<td> User Name</td>
								<td class="txt_cnt"> <a href="#" title="" data-toggle="modal" data-target="#user_loc_lst"> 22 </a></td>
								<td class="txt_rt"> 22 </td>
							</tr>
							<tr> 
								<td> User Name</td>
								<td class="txt_cnt"> <a href="#" title="" data-toggle="modal" data-target="#user_loc_lst"> 22 </a></td>
								<td class="txt_rt"> 22 </td>
							</tr>
							<tr> 
								<td> User Name</td>
								<td class="txt_cnt"> <a href="#" title="" data-toggle="modal" data-target="#user_loc_lst"> 22 </a></td>
								<td class="txt_rt"> 22 </td>
							</tr>
							<tr> 
								<td> User Name</td>
								<td class="txt_cnt"> <a href="#" title="" data-toggle="modal" data-target="#user_loc_lst"> 22 </a></td>
								<td class="txt_rt"> 22 </td>
							</tr>
							<tr> 
								<td> User Name</td>
								<td class="txt_cnt"> <a href="#" title="" data-toggle="modal" data-target="#user_loc_lst"> 22 </a></td>
								<td class="txt_rt"> 22 </td>
							</tr>
							<tr> 
								<td> User Name</td>
								<td class="txt_cnt"> <a href="#" title="" data-toggle="modal" data-target="#user_loc_lst"> 22 </a></td>
								<td class="txt_rt"> 22 </td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
	</div>
<!-- users End -->

<!-- Traders Start -->

	<div id="trades" class="reports_main">
		<div class="anl_btn"> 
						<div class="anl_crd bor_lf_none date_anl fl"> 
					<i class="fa fa-filter date_fil" aria-hidden="true" style="font-size: 9px;"></i>
					<div class="top_in_op">
                            <p>Date</p>
                            <h1 id="total_purchase">12-May-2020 to 10-Jun-2020</h1>
                        </div>
				</div>
				<div class="btn_anl fr btn btn-primary"> Show All Analytics </div>
					 </div>
					 <div class="al_anl"> </div>

					 <div class="anl_mb_blk"> 
					 		<div class="anl_crd bor_lf_none">
					<div class="anl_tp">
							<div class="icn_anl"> 
								<img src="http://3.7.44.132/aquacredit/assets/images/amnt_icn.png" alt="" title="" class="mCS_img_loaded">
							</div>
							<div class="icn_anl_rt"> 
								<div class="top_in_op">
                            <p>Total Traders</p>
                            <h1 id="total_purchase">1,000</h1>
                        </div>                     
							</div>
					</div>
					   <ul class="btm_blk_anl"> 
                        	<li> 
                        		<div class="lft_tl"> Agents </div>
                        		<div class="rt_prc"> 500 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Exporters </div>
                        		<div class="rt_prc"> 500 </div>
                        	</li>
                        </ul>
				</div>
				<div class="anl_crd bor_lf_none">
					<div class="anl_tp">
							<div class="icn_anl"> 
								<img src="http://3.7.44.132/aquacredit/assets/images/amnt_icn.png" alt="" title="" class="mCS_img_loaded">
							</div>
							<div class="icn_anl_rt"> 
								<div class="top_in_op">
                            <p>Total Trades</p>
                            <h1 id="total_purchase">₹20,00000</h1>
                        </div>                     
							</div>
					</div>
					   <ul class="btm_blk_anl"> 
                        	<li> 
                        		<div class="lft_tl"> Agents </div>
                        		<div class="rt_prc"> ₹10,00000 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Exporters </div>
                        		<div class="rt_prc"> ₹ 10,0000 </div>
                        	</li>
                        </ul>
				</div>

				<div class="anl_crd bor_lf_none">
					<div class="anl_tp">
							<div class="icn_anl"> 
								<img src="http://3.7.44.132/aquacredit/assets/images/amnt_icn.png" alt="" title="" class="mCS_img_loaded">
							</div>
							<div class="icn_anl_rt"> 
								<div class="top_in_op">
                            <p>Pending Amount</p>
                            <h1 id="total_purchase">₹20,00000</h1>
                        </div>                     
							</div>
					</div>
					   <ul class="btm_blk_anl"> 
                        	<li> 
                        		<div class="lft_tl"> Agents </div>
                        		<div class="rt_prc"> ₹10,00000 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Exporters </div>
                        		<div class="rt_prc"> ₹ 10,0000 </div>
                        	</li>
                        </ul>
				</div>
					 </div>
			<div class="anlts"> 
				<div class="anl_crd bor_lf_none date_anl"> 
					<i class="fa fa-filter date_fil" aria-hidden="true" style="font-size: 9px;"></i>
					<div class="top_in_op">
                            <p>Date</p>
                            <h1 id="total_purchase">12-May-2020 to 10-Jun-2020</h1>
                        </div>
				</div>
				<div class="anl_crd bor_lf_none">
					<div class="anl_tp">
							<div class="icn_anl"> 
								<img src="http://3.7.44.132/aquacredit/assets/images/amnt_icn.png" alt="" title="" class="mCS_img_loaded">
							</div>
							<div class="icn_anl_rt"> 
								<div class="top_in_op">
                            <p>Total Traders</p>
                            <h1 id="total_purchase">1,000</h1>
                        </div>                     
							</div>
					</div>
					   <ul class="btm_blk_anl"> 
                        	<li> 
                        		<div class="lft_tl"> Agents </div>
                        		<div class="rt_prc"> 500 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Exporters </div>
                        		<div class="rt_prc"> 500 </div>
                        	</li>
                        </ul>
				</div>
				<div class="anl_crd bor_lf_none">
					<div class="anl_tp">
							<div class="icn_anl"> 
								<img src="http://3.7.44.132/aquacredit/assets/images/amnt_icn.png" alt="" title="" class="mCS_img_loaded">
							</div>
							<div class="icn_anl_rt"> 
								<div class="top_in_op">
                            <p>Total Trades</p>
                            <h1 id="total_purchase">₹20,00000</h1>
                        </div>                     
							</div>
					</div>
					   <ul class="btm_blk_anl"> 
                        	<li> 
                        		<div class="lft_tl"> Agents </div>
                        		<div class="rt_prc"> ₹10,00000 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Exporters </div>
                        		<div class="rt_prc"> ₹ 10,0000 </div>
                        	</li>
                        </ul>
				</div>

				<div class="anl_crd bor_lf_none">
					<div class="anl_tp">
							<div class="icn_anl"> 
								<img src="http://3.7.44.132/aquacredit/assets/images/amnt_icn.png" alt="" title="" class="mCS_img_loaded">
							</div>
							<div class="icn_anl_rt"> 
								<div class="top_in_op">
                            <p>Pending Amount</p>
                            <h1 id="total_purchase">₹20,00000</h1>
                        </div>                     
							</div>
					</div>
					   <ul class="btm_blk_anl"> 
                        	<li> 
                        		<div class="lft_tl"> Agents </div>
                        		<div class="rt_prc"> ₹10,00000 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Exporters </div>
                        		<div class="rt_prc"> ₹ 10,0000 </div>
                        	</li>
                        </ul>
				</div>
				
			</div>

			<div class="tbls_blk"> 
					<div class="res_tbl"> 
						<table id="trades_tbl">
							<thead>
								<tr> 
									<th> Trader Name </th>
									<th width="100"> Type 
										<span class="sts_pp">
						<i class="fa fa-filter" aria-hidden="true" style="font-size: 9px;"></i>
					</span>
					<div class="sts_fil_blk rad_btns"> 
											
												<label class="form-check-label radio_blk checkd" for="utype_all">
												<input class="form-check-input" type="radio" name="user_type_opt" value="" id="utype_all" checked="">
												All</label>
										
											
												<label class="form-check-label radio_blk utypes" for="utype_f">
												<input class="form-check-input" type="radio" name="user_type_opt" value="farmer" id="utype_f">
												Farmer</label>
										
										
												<label class="form-check-label radio_blk utypes" for="utype_nf">
												<input class="form-check-input" type="radio" name="user_type_opt" value="non_farmer" id="utype_nf">
												Non Farmer</label>
										
										
												<label class="form-check-label radio_blk utypes" for="utype_d">
												<input class="form-check-input" type="radio" name="user_type_opt" value="dealer" id="utype_d">
												Dealer/Sub-Dealer</label>
										
											
												<label class="form-check-label radio_blk ttypes" for="ttype_a" style="display: none;">
												<input class="form-check-input" type="radio" name="user_type_opt" value="agent" id="ttype_a">
												Agent</label>
										
											
												<label class="form-check-label radio_blk ttypes" for="ttype_e" style="display: none;">
												<input class="form-check-input" type="radio" name="user_type_opt" value="exporter" id="ttype_e">
												Exporter</label>
											
										</div>
									</th> 
									<th width="100"> Tonnage </th>
									<th width="100" class="txt_rt"> Pending </th>
								</tr>
							</thead>
							<tbody>
								<tr> 
									<td> Trader Name </td>
									<td width="100"> Agent </td>
									<td width="100"> 10 Tons </td>
									<td width="100" class="txt_rt"> ₹100.86 </td>
								</tr>
								<tr> 
									<td> Trader Name </td>
									<td width="100"> Agent </td>
									<td width="100"> 10 Tons </td>
									<td width="100" class="txt_rt"> ₹100.86 </td>
								</tr>
								<tr> 
									<td> Trader Name </td>
									<td width="100"> Agent </td>
									<td width="100"> 10 Tons </td>
									<td width="100" class="txt_rt"> ₹100.86 </td>
								</tr>
								<tr> 
									<td> Trader Name </td>
									<td width="100"> Agent </td>
									<td width="100"> 10 Tons </td>
									<td width="100" class="txt_rt"> ₹100.86 </td>
								</tr>
								<tr> 
									<td> Trader Name </td>
									<td width="100"> Agent </td>
									<td width="100"> 10 Tons </td>
									<td width="100" class="txt_rt"> ₹100.86 </td>
								</tr>
								<tr> 
									<td> Trader Name </td>
									<td width="100"> Agent </td>
									<td width="100"> 10 Tons </td>
									<td width="100" class="txt_rt"> ₹100.86 </td>
								</tr>
								<tr> 
									<td> Trader Name </td>
									<td width="100"> Agent </td>
									<td width="100"> 10 Tons </td>
									<td width="100" class="txt_rt"> ₹100.86 </td>
								</tr>
								<tr> 
									<td> Trader Name </td>
									<td width="100"> Agent </td>
									<td width="100"> 10 Tons </td>
									<td width="100" class="txt_rt"> ₹100.86 </td>
								</tr>
								<tr> 
									<td> Trader Name </td>
									<td width="100"> Agent </td>
									<td width="100"> 10 Tons </td>
									<td width="100" class="txt_rt"> ₹100.86 </td>
								</tr>
								<tr> 
									<td> Trader Name </td>
									<td width="100"> Agent </td>
									<td width="100"> 10 Tons </td>
									<td width="100" class="txt_rt"> ₹100.86 </td>
								</tr>
							</tbody>
						</table>
					</div>
			</div>

	</div>

<!-- Traders End-->

<!-- Cash Book Start -->
<div id="cash_book" class="reports_main">
	
	<div class="anl_btn"> 
						<div class="anl_crd bor_lf_none date_anl fl"> 
					<!-- <span class="pull-right" id="reportrange"><i class="fa fa-filter date_fil" aria-hidden="true" style="font-size: 9px;"></i></span>
					<input type="hidden" id="date_val" name="date_val" /> -->
					<div class="top_in_op">
                            <p>Date</p>
                            <h1 >12-May-2020 to 10-Jun-2020</h1>
                            
                            
                        </div>
				</div>
				<div class="btn_anl fr btn btn-primary"> Show All Analytics </div>
					 </div>
					 <div class="al_anl"> </div>

					 <div class="anl_mb_blk"> 
					 	<div class="anl_crd bor_lf_none">
					<div class="anl_tp">
							<div class="icn_anl"> 
								<img src="http://3.7.44.132/aquacredit/assets/images/amnt_icn.png" alt="" title="" class="mCS_img_loaded">
							</div>
							<div class="icn_anl_rt"> 
								<div class="top_in_op">
                            <p>Total Amount</p>
                            <h1 >0</h1>
                        </div>                     
							</div>
					</div>
					   <ul class="btm_blk_anl"> 
                        	<li> 
                        		<div class="lft_tl"> Bank Account </div>
                        		<div class="rt_prc" > 0 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Cash Account </div>
                        		<div class="rt_prc" > 0 </div>
                        	</li>
  
                        </ul>
				</div>

				<div class="anl_crd bor_lf_none"> 
					<h2 class="create_hdg"> Transport Details </h2>
					<ul class="all_bnks"> 
						<li><div class="bank_logo"> <img src="http://3.7.44.132/aquacredit/assets/images/cash_account.png" alt="" title="" class="mCS_img_loaded"> </div>     <div class="bank_mny"><div class="bank_bal" id="branch_cash">₹ -1,67,766</div><div class="accont_numb">Cash Account</div></div></li>
						<li><div class="bank_logo"> <img src="http://3.7.44.132/aquacredit/assets/images/cash_account.png" alt="" title="" class="mCS_img_loaded"> </div>     <div class="bank_mny"><div class="bank_bal" id="branch_cash">₹ -1,67,766</div><div class="accont_numb">Cash Account</div></div></li>

						<li><div class="bank_logo"> <img src="http://3.7.44.132/aquacredit/assets/images/hdfc_icn.png" alt="" title="" class="mCS_img_loaded"> </div>     <div class="bank_mny"><div class="bank_bal" id="branch_cash">₹ -1,67,766</div><div class="accont_numb">4008956125</div></div></li>
					</ul>
				</div>
					 </div>


			<div class="anlts"> 
				<div class="anl_crd bor_lf_none date_anl" id="reportrange"> 
					<!-- <i class="fa fa-filter date_fil" aria-hidden="true" style="font-size: 9px;"></i> -->
					<span class="pull-right" >
										<i class="fa fa-filter"  aria-hidden="true" style="font-size: 9px;"></i>
										<span></span>
									</span>
									<input type="hidden" id="date_val" name="date_val" />
					<div class="top_in_op">
                            <p>Date</p>
                            <h1 id="total_purchase dateval" class="datevalshow" >Till Date</h1>
                        </div>
				</div>
				<div class="anl_crd bor_lf_none">
					<div class="anl_tp">
							<div class="icn_anl"> 
								<img src="http://3.7.44.132/aquacredit/assets/images/amnt_icn.png" alt="" title="" class="mCS_img_loaded">
							</div>
							<div class="icn_anl_rt"> 
								<div class="top_in_op">
                            <p>Total Amount</p>
                            <h1 id="totamount">0</h1>
                        </div>                     
							</div>
					</div>
					   <ul class="btm_blk_anl"> 
                        	<li> 
                        		<div class="lft_tl"> Bank Account </div>
                        		<div class="rt_prc" id="bankamount"> 0 </div>
                        	</li>
                        	<li> 
                        		<div class="lft_tl"> Cash Account </div>
                        		<div class="rt_prc" id="cashamount"> 0 </div>
                        	</li>
  
                        </ul>
				</div>
				
				<div class="anl_crd bor_lf_none"> 
					<h2 class="create_hdg" style="margin-top: 12px"> Accounts </h2>
					<ul class="all_bnks"> 
						<li><div class="bank_logo"> <img src="http://3.7.44.132/aquacredit/assets/images/cash_account.png" alt="" title="" class="mCS_img_loaded"> </div>     <div class="bank_mny"><div class="bank_bal" id="branch_cash">₹ -1,67,766</div><div class="accont_numb">Cash Account</div></div></li>
						<li><div class="bank_logo"> <img src="http://3.7.44.132/aquacredit/assets/images/cash_account.png" alt="" title="" class="mCS_img_loaded"> </div>     <div class="bank_mny"><div class="bank_bal" id="branch_cash">₹ -1,67,766</div><div class="accont_numb">Cash Account</div></div></li>

						<li><div class="bank_logo"> <img src="http://3.7.44.132/aquacredit/assets/images/hdfc_icn.png" alt="" title="" class="mCS_img_loaded"> </div>     <div class="bank_mny"><div class="bank_bal" id="branch_cash">₹ -1,67,766</div><div class="accont_numb">4008956125</div></div></li>
					</ul>
				</div>
				
			</div>

			<div class="tbls_blk"> 
					<div class="res_tbl">
						<table class="cash_tbl" id="cash_tbl_tbl">
							<thead>
							
								<tr> 
									<th> Date </th>
									<th> Type 
										<span class="sts_pp">
											<i class="fa fa-filter" aria-hidden="true" style="font-size: 9px;"></i>
										</span>
										<div class="sts_fil_blk rad_btns"> 
											
												<label class="form-check-label radio_blk checkd" for="utype_all">
												<input class="form-check-input" type="radio" name="cash_type_opt" value="" id="utype_all" checked="" value="">
												All</label>
										
											
												<label class="form-check-label radio_blk utypes" for="utype_f">
												<input class="form-check-input" type="radio" name="cash_type_opt" value="Loan" id="utype_f" value="Loan">
												Loan</label>
										
										
												<label class="form-check-label radio_blk utypes" for="utype_nf">
												<input class="form-check-input" type="radio" name="cash_type_opt" value="Sale" id="utype_nf" value="Sale">
												Sale</label>
										
										
												<label class="form-check-label radio_blk utypes" for="utype_d">
												<input class="form-check-input" type="radio" name="cash_type_opt" value="Purchase" id="utype_d" value="Purchase">
												Purchase</label>

												<label class="form-check-label radio_blk utypes" for="utype_d">
												<input class="form-check-input" type="radio" name="cash_type_opt" value="Receipt" id="utype_d" value="Receipt">
												Receipt</label>
										
										</div>
									</th>
									<th> 
										Bank / Cash
										<span class="sts_pp">
											<i class="fa fa-filter" aria-hidden="true" style="font-size: 9px;"></i>
										</span>
										<div class="sts_fil_blk rad_btns"> 
											
												<label class="form-check-label radio_blk checkd" for="utype_all">
												<input class="form-check-input" type="radio" name="cash_type" value="" id="utype_all" checked="">
												All</label>
										
											
												<label class="form-check-label radio_blk utypes" for="utype_f">
												<input class="form-check-input" type="radio" name="cash_type" value="bank" id="utype_f">
												Bank </label>
										
										
												<label class="form-check-label radio_blk utypes" for="utype_nf">
												<input class="form-check-input" type="radio" name="cash_type" value="cash" id="utype_nf">
												Cash</label>
				
											
										</div>
									</th>
									<th class="txt_rt" style="padding-right: 40px!important;"> Amount </th>
								</tr>
							</thead>
							
								
								<tbody>
								<tr> 
									<td> 20-May-2020 </td>
									<td> Loan - 0566 </td>
									<td> HDFC- XXXXXXX6665 </td>
									<td class="txt_rt grn_row"> ₹100.86 <span> <img class="grn_arow" src="http://3.7.44.132/aquacredit/assets/images/grn_c_ar.png" alt="" title=""> </span> </td>
								</tr>
								<tr> 
									<td> 20-May-2020 </td>
									<td> Loan - 0566 </td>
									<td> HDFC- XXXXXXX6665 </td>
									<td class="txt_rt grn_row"> ₹100.86 <span> <img class="grn_arow" src="http://3.7.44.132/aquacredit/assets/images/grn_c_ar.png" alt="" title=""> </span> </td>
								</tr>
								<tr> 
									<td> 20-May-2020 </td>
									<td> Loan - 0566 </td>
									<td> HDFC- XXXXXXX6665 </td>
									<td class="txt_rt grn_row"> ₹100.86 <span> <img class="grn_arow" src="http://3.7.44.132/aquacredit/assets/images/grn_c_ar.png" alt="" title=""> </span> </td>
								</tr>
								<tr> 
									<td> 20-May-2020 </td>
									<td> Sale - 0566 </td>
									<td> Cash- KKD </td>
									<td class="txt_rt rd_row"> ₹100.86 <span> <img class="grn_arow" src="http://3.7.44.132/aquacredit/assets/images/rd_c_ar.png" alt="" title=""> </span> </td>
								</tr>

								<tr> 
									<td> 20-May-2020 </td>
									<td> Loan - 0566 </td>
									<td> HDFC- XXXXXXX6665 </td>
									<td class="txt_rt rd_row"> ₹100.86 <span> <img class="grn_arow" src="http://3.7.44.132/aquacredit/assets/images/rd_c_ar.png" alt="" title=""> </span> </td>
								</tr>								
							</tbody>
						</table>
					</div>
			</div>


</div>
<!-- Cash Book End -->
		</div>
	</div>
</div>
<div id="user_lst" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
  
      <div class="modal-body">
      	<button type="button" class="close" data-dismiss="modal">&times;</button>
       <div class="res_tbl"> 
       			<table id="user_lst_blk">
       				<thead>
       					<th> User Name </th>
       					<th> Mobile </th>
       					<th> Type 
       						<span class="sts_pp">
						<i class="fa fa-filter" aria-hidden="true" style="font-size: 9px;"></i>
					</span>
					<div class="sts_fil_blk rad_btns"> 
											
												<label class="form-check-label radio_blk checkd" for="utype_all">
												<input class="form-check-input" type="radio" name="user_type_opt" value="" id="utype_all" checked="">
												All</label>
										
											
												<label class="form-check-label radio_blk utypes" for="utype_f">
												<input class="form-check-input" type="radio" name="user_type_opt" value="farmer" id="utype_f">
												Farmer</label>
										
										
												<label class="form-check-label radio_blk utypes" for="utype_nf">
												<input class="form-check-input" type="radio" name="user_type_opt" value="non_farmer" id="utype_nf">
												Non Farmer</label>
										
										
												<label class="form-check-label radio_blk utypes" for="utype_d">
												<input class="form-check-input" type="radio" name="user_type_opt" value="dealer" id="utype_d">
												Dealer/Sub-Dealer</label>
										
											
												<label class="form-check-label radio_blk ttypes" for="ttype_a" style="display: none;">
												<input class="form-check-input" type="radio" name="user_type_opt" value="agent" id="ttype_a">
												Agent</label>
										
											
												<label class="form-check-label radio_blk ttypes" for="ttype_e" style="display: none;">
												<input class="form-check-input" type="radio" name="user_type_opt" value="exporter" id="ttype_e">
												Exporter</label>
											
										</div>
       					</th>
       					<th class="txt_cnt"> Tonnage </th>
       					<th class="txt_rt">  Amount </th>
       				</thead>
       				<tbody>
       					<tr> 
       						<td> User Name </td>
       						<td width="80"> 9876543210 </td>
       						<td width="80"> Farmer </td>
       						<td width="80" class="txt_cnt"> 10 </td>
       						<td width="100" class="txt_rt"> ₹10.86 </td>
       					</tr>
       					<tr> 
       						<td> User Name </td>
       						<td width="80"> 9876543210 </td>
       						<td width="80"> Farmer </td>
       						<td width="80" class="txt_cnt"> 10 </td>
       						<td width="100" class="txt_rt"> ₹10.86 </td>
       					</tr>
       					<tr> 
       						<td> User Name </td>
       						<td width="80"> 9876543210 </td>
       						<td width="80"> Farmer </td>
       						<td width="80" class="txt_cnt"> 10 </td>
       						<td width="100" class="txt_rt"> ₹10.86 </td>
       					</tr>
       					<tr> 
       						<td> User Name </td>
       						<td width="80"> 9876543210 </td>
       						<td width="80"> Farmer </td>
       						<td width="80" class="txt_cnt"> 10 </td>
       						<td width="100" class="txt_rt"> ₹10.86 </td>
       					</tr>
       					<tr> 
       						<td> User Name </td>
       						<td width="80"> 9876543210 </td>
       						<td width="80"> Farmer </td>
       						<td width="80" class="txt_cnt"> 10 </td>
       						<td width="100" class="txt_rt"> ₹10.86 </td>
       					</tr>
       					<tr> 
       						<td> User Name </td>
       						<td width="80"> 9876543210 </td>
       						<td width="80"> Farmer </td>
       						<td width="80" class="txt_cnt"> 10 </td>
       						<td width="100" class="txt_rt"> ₹10.86 </td>
       					</tr>
       					<tr> 
       						<td> User Name </td>
       						<td width="80"> 9876543210 </td>
       						<td width="80"> Farmer </td>
       						<td width="80" class="txt_cnt"> 10 </td>
       						<td width="100" class="txt_rt"> ₹10.86 </td>
       					</tr>
       					<tr> 
       						<td> User Name </td>
       						<td width="80"> 9876543210 </td>
       						<td width="80"> Farmer </td>
       						<td width="80" class="txt_cnt"> 10 </td>
       						<td width="100" class="txt_rt"> ₹10.86 </td>
       					</tr>
       				</tbody>
       			</table>
       </div>
      </div>
     
    </div>

  </div>
</div>


<div id="user_loc_lst" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
  
      <div class="modal-body">
      	<button type="button" class="close" data-dismiss="modal">&times;</button>
       <div class="res_tbl"> 
       			<table id="user_loc_lst_blk">
       				<thead>
       					<th> User Name </th>
       					<th> Mobile </th>
       					<th> Type </th>
       					<th class="txt_rt">  No of Acrs </th>
       				</thead>
       				<tbody>
       					<tr> 
       						<td> User Name </td>
       						<td width="80"> 9876543210 </td>
       						<td width="80"> Farmer </td>
       						<td width="80" class="txt_rt"> 10 </td>
       					</tr>
       					<tr> 
       						<td> User Name </td>
       						<td width="80"> 9876543210 </td>
       						<td width="80"> Farmer </td>
       						<td width="80" class="txt_rt"> 10 </td>
       					</tr>
       					<tr> 
       						<td> User Name </td>
       						<td width="80"> 9876543210 </td>
       						<td width="80"> Farmer </td>
       						<td width="80" class="txt_rt"> 10 </td>
       					</tr>
       					<tr> 
       						<td> User Name </td>
       						<td width="80"> 9876543210 </td>
       						<td width="80"> Farmer </td>
       						<td width="80" class="txt_rt"> 10 </td>
       					</tr>
       					<tr> 
       						<td> User Name </td>
       						<td width="80"> 9876543210 </td>
       						<td width="80"> Farmer </td>
       						<td width="80" class="txt_rt"> 10 </td>
       					</tr>
       					<tr> 
       						<td> User Name </td>
       						<td width="80"> 9876543210 </td>
       						<td width="80"> Farmer </td>
       						<td width="80" class="txt_rt"> 10 </td>
       					</tr>
       					<tr> 
       						<td> User Name </td>
       						<td width="80"> 9876543210 </td>
       						<td width="80"> Farmer </td>
       						<td width="80" class="txt_rt"> 10 </td>
       					</tr>
       					<tr> 
       						<td> User Name </td>
       						<td width="80"> 9876543210 </td>
       						<td width="80"> Farmer </td>
       						<td width="80" class="txt_rt"> 10 </td>
       					</tr>
       				</tbody>
       			</table>
       </div>
      </div>
     
    </div>

  </div>
</div>

<script type="text/javascript">
var url = '<?php echo base_url(); ?>';
$(document).ready( function () {



    $('#lns_tbl, #sls_tbl, #harv_dtls, #tonnge_tbl').DataTable({
    	"autoWidth": false
    });
    $('#cmp_tbl, #user_lst_blk, #far_loc, #user_loc_lst_blk, #trades_tbl, #paybl_tble, #recv_tble').DataTable({
    	"autoWidth": false
    });
    $('#feed_brand').DataTable({
    	// "paging": false,
    	"language": { search: "" },
    	"autoWidth": false
    });
    $('#feed_Product, #feed_month, #feed_date').DataTable({
    	// "paging": false,
    	"language": { search: "" },
    	"autoWidth": false
    });

    getadminbanks();
    /**/
	var table = $('#cash_tbl_tbl').DataTable({     
      'ordering': false,
      'processing': true,
        'serverSide': true,
        'serverMethod': 'post',   
         'searching': true,
         "pageLength": 20,
         "language": { searchPlaceholder: "Search by Type",
         search: "" },
        "columnDefs": [
           
      { className: "txt_rt ", "targets": 3 },
     
      ],
        "order": [[ 1, 'desc' ]],
       'ajax': {
           'url':url+'api/reports/getcashbook',
           'data': function(data){

              var cash_type_opt = $("input[name='cash_type_opt']:checked").val();
              var cash_type = $("input[name='cash_type']:checked").val();
               var reportrange = $('#date_val').val();	
               var from_date = $("#from_date").val();
               var to_date = $("#to_date").val();

              data.cash_type_opt = cash_type_opt;
              data.cash_type = cash_type;
              data.reportrange = reportrange;
              data.from_date = from_date;
              data.to_date = to_date;
             
           },
           "dataSrc": function (json) {    
          // alert(json.bankamount);
            $("#bankamount").html('₹'+addCommas(json.bankamount)); 
            $("#cashamount").html('₹'+addCommas(json.cashamount)); 
            $("#totamount").html('₹'+addCommas(json.totamount));

            return json.data;
          }
        }
      
});
	$("input[name='cash_type_opt']").on('click',function() {		
  		table.draw();
  	});

  	$("input[name='cash_type']").on('click',function() {		
  		table.draw();
  	});
  	$(document).on('click', '.ranges ul li', function() {
        $(this).parent().children().removeClass('active');
        $(this).addClass('active');
        $('.drp-selected').css('font-weight', 'bold');

        /*if ($(this).text() != "Date Range") {*/
        	$('.datevalshow').html($(this).text());
        /*}*/
        if ($(this).text() == "Till Date") {
            $("#date_val").val('Till Date');
        }

        if ($(this).text() != "Date Range") {
            table.draw();
        }
    });

    $(document).on('click', '.applyBtn', function() {
    	var reportrange = $('#date_val').val();	
        $('.datevalshow').html(reportrange);
        table.draw();
    });

    $("#custom_date").click(function() {
        table.draw();
    });

    $("#from_date").change(function(e) {
        e.stopPropagation()
    });
/**/
 $('#feed_Product .back_btn').click(function(){
 	$('#feed_Product_wrapper').hide();
 	$('#feed_brand_wrapper').show();
 });

  $('#feed_month .back_btn').click(function(){
 	$('#feed_Product_wrapper').show();
 	$('#feed_month_wrapper').hide();
 });

   $('#feed_date .back_btn').click(function(){
 	$('#feed_date_wrapper').hide();
 	$('#feed_month_wrapper').show();
 });

  $('#feed_brand tbody tr').click(function(){
 	$('#feed_brand_wrapper').hide();
 	$('#feed_Product_wrapper').show();
 });

  $('#feed_Product tbody tr').click(function(){
 	$('#feed_Product_wrapper').hide();
 	$('#feed_month_wrapper').show();
 });

   $('#feed_month tbody tr').click(function(){
 	$('#feed_month_wrapper').hide();
 	$('#feed_date_wrapper').show();
 });

  $('#cash_tbl_tbl_wrapper .dataTables_length').html('<h2 class="create_hdg" style="padding-top: 0px;"> Cash Book </h2>');
  $('#feed_month_wrapper .dataTables_length').html('<div class="check_wt_serc val_seld"> <div class="show_va">Select Product</div> <div class="selectVal">Avant Saldo Mixtos 10Kg</div> <ul class="check_list"> <li> <div class="form-check"> <input class="form-check-input" type="radio" id="prd1" name="branch" value="Avant Saldo Mixtos 10Kg" checked="checked"> <label class="form-check-label" for="prd1"> Avant Saldo Mixtos 10Kg  </label> </div> </li> <li> <div class="form-check"> <input class="form-check-input" type="radio" id="prd2" name="branch" value="Category2"> <label class="form-check-label" for="prd2"> Product 2                                    </label> </div> </li> </ul>  </div>');

  $('#feed_date_wrapper .dataTables_length').html('<div class="check_wt_serc val_seld"> <div class="show_va">Select Product</div> <div class="selectVal">Avant Saldo Mixtos 10Kg</div> <ul class="check_list"> <li> <div class="form-check"> <input class="form-check-input" type="radio" id="prdd1" name="branch" value="Avant Saldo Mixtos 10Kg" checked="checked"> <label class="form-check-label" for="prdd1"> Avant Saldo Mixtos 10Kg  </label> </div> </li> <li> <div class="form-check"> <input class="form-check-input" type="radio" id="prdd2" name="branch" value="Category2"> <label class="form-check-label" for="prdd2"> Product 2                                    </label> </div> </li> </ul>  </div>');

$('#feed_brand_wrapper .dataTables_length').html('<div class="check_wt_serc val_seld"> <div class="show_va">Select Category</div> <div class="selectVal">Branch1</div> <ul class="check_list"> <li> <div class="form-check"> <input class="form-check-input" type="radio" id="branch" name="branch" value="All Categories" checked="checked"> <label class="form-check-label" for="branch"> All Categories  </label> </div> </li> <li> <div class="form-check"> <input class="form-check-input" type="radio" id="branch2" name="branch" value="Category2"> <label class="form-check-label" for="branch2"> Category2                                    </label> </div> </li> </ul>  </div>');
$('#feed_Product_wrapper .dataTables_length').html('<ul class="fltr_ul"><li class="fltr_li"><div class="check_wt_serc val_seld"> <div class="show_va">Select Company </div> <div class="selectVal">Avanti Pvt.LTd</div> <ul class="check_list"> <li> <div class="form-check"> <input class="form-check-input" type="radio" id="selComp" name="cmp" value="Avanti Pvt.LTd" checked="checked"> <label class="form-check-label" for="selComp"> Avanti Pvt.LTd </label> </div> </li> <li> <div class="form-check"> <input class="form-check-input" type="radio" id="cmp2" name="cmp" value="Company 2"> <label class="form-check-label" for="cmp2"> Compnay 2                                    </label> </div> </li> </ul>  </div></li> <li class="fltr_li"><div class="check_wt_serc val_seld"> <div class="show_va">Select Category</div> <div class="selectVal">Branch1</div> <ul class="check_list"> <li> <div class="form-check"> <input class="form-check-input" type="radio" id="branch3" name="branch" value="All Categories" checked="checked"> <label class="form-check-label" for="branch3"> All Categories  </label> </div> </li> <li> <div class="form-check"> <input class="form-check-input" type="radio" id="branch4" name="branch" value="Category2"> <label class="form-check-label" for="branch4"> Category2                                    </label> </div> </li> </ul>  </div></li></ul>');
 $('.check_wt_serc').click(function() {
        $(".check_wt_serc").not(this).removeClass('act_v');
        $(this).toggleClass('act_v')
        $(".check_wt_serc").not(this).find('.check_list').removeClass('show_chk');
        $(this).find('.check_list').toggleClass('show_chk');
        $(".check_list input[type='radio']").change(function() {
            //var val = $(this).parent().parent('li').parent('ul').parent('.check_wt_serc').find(".check_list input[type='radio']:checked").val();
            var acc_no = $(this).siblings('label').text();
            if (acc_no == "") {
                var val = $(this).siblings('label').text();
            } else {
                var val = acc_no;
            }
            // alert(val);
            $(this).parent().parent('li').parent('ul').parent('.check_wt_serc').find('.selectVal').text(val);
            $(this).parent().parent('li').parent('ul').removeClass('show_chk');
            $(this).parent().parent('li').parent('ul').parent('.check_wt_serc').removeClass('act_v').addClass('val_seld');
        });

    });

	$('#lns_tbl_wrapper .dataTables_length').html('<h2 class="Loans"> Recent Returns </h2>');
    $('#lns_tbl_wrapper .dataTables_filter').html('<ul class="tabs_tbl"><li class="act_tab frm_tb"> <span>Farmers</span></li><li class="non_farm"> <span> Non-Farmers </span> </li> <li class="deal_tb"> <span> Dealers </span></li></ul>');

    $('#harv_dtls_wrapper .dataTables_length').html('<h2 class="Loans"> Harvest Details </h2>');
    $('#harv_dtls_wrapper .dataTables_filter').html('<ul class="tabs_tbl"><li class="act_tab frm_tb"> <span>Farmers</span></li><li class="non_farm"> <span> Gust Users </span> </li> </ul>');

    $('#cmp_tbl_wrapper .dataTables_length').html('<h2 class="Loans"> Brands </h2>');
    $('#cmp_tbl_wrapper .dataTables_filter').html('<ul class="tabs_tbl fd_md"><li class="act_tab frm_tb"> <span> Feeds </span></li><li class="non_farm"> <span> Medicine </span> </li> <li class="deal_tb"> <span> Mechinery </span></li></ul>');


    $('#paybl_tble_wrapper .dataTables_length').html('<h2 class="Loans"> Payables </h2>');
    $('#paybl_tble_wrapper .dataTables_filter').html('<ul class="tabs_tbl pay_rec fd_md"><li class="act_tab frm_tb"> <span> Users </span></li><li class="non_farm"> <span> Company </span> </li> <li class="deal_tb"> <span> Traders </span></li></ul>');

	$('#recv_tble_wrapper .dataTables_length').html('<h2 class="Loans"> Receivable </h2>');
    $('#recv_tble_wrapper .dataTables_filter').html('<ul class="tabs_tbl pay_rec fd_md"><li class="act_tab frm_tb"> <span> Users </span></li><li class="non_farm"> <span> Company </span> </li> <li class="deal_tb"> <span> Traders </span></li></ul>');


    $('#user_lst_blk_wrapper .dataTables_length').html('<h2 class="Loans"> Brand Name </h2>');
    $('#user_lst_blk_wrapper .dataTables_filter').html('');
     $('#user_loc_lst_blk_wrapper .dataTables_length').html('<h2 class="Loans"> Location Name </h2>');
    $('#user_loc_lst_blk_wrapper .dataTables_filter').html('');

    $('#far_loc_wrapper .dataTables_length').html('<h2 class="Loans" style="margin-bottom:15px!important;"> Farming Locations </h2>');
    $('#far_loc_wrapper .dataTables_filter').html('');

    $('#sls_tbl_wrapper .dataTables_length').html('<h2 class="Loans" style="margin-bottom:15px!important;"> Sold Products </h2>');
    $('#sls_tbl_wrapper .dataTables_filter').html('');

     $('#tonnge_tbl_wrapper .dataTables_length').html('<h2 class="Loans" style="margin-bottom:15px!important;"> Sold Products </h2>');
    $('#tonnge_tbl_wrapper .dataTables_filter').html('');

    $('#trades_tbl_wrapper .dataTables_length').html('<h2 class="Loans" style="margin-bottom:15px!important;"> Traders </h2>');
    $('#trades_tbl_wrapper .dataTables_filter').html('');

    $('.frm_tb').click(function(){
    		$('.tabs_tbl li').removeClass('act_tab');
    		$('.tabs_tbl li.frm_tb').addClass('act_tab');
    		$(this).parent('.tabs_tbl').addClass('frm_ul');
    		$('.tabs_tbl').removeClass('deal_tb_ul'); 
    		$('.tabs_tbl').removeClass('non_farm_ul');
    });
    $('.non_farm').click(function(){
    	$('.tabs_tbl li').removeClass('act_tab');
    	$('.tabs_tbl li.non_farm').addClass('act_tab');  
    	$(this).parent('.tabs_tbl').addClass('non_farm_ul'); 
    	$('.tabs_tbl').removeClass('frm_ul');
    	$('.tabs_tbl').removeClass('deal_tb_ul');  	
    });
    $('.deal_tb').click(function(){
    	$('.tabs_tbl li').removeClass('act_tab');
    	$('.tabs_tbl li.deal_tb').addClass('act_tab'); 
    	$(this).parent('.tabs_tbl').addClass('deal_tb_ul');
    	$('.tabs_tbl').removeClass('non_farm_ul'); 
    	$('.tabs_tbl').removeClass('frm_ul');   	
    });

    $('.far_link').click(function(){
    	$(".over_lst").attr('class', 'over_lst');
    	$(this).parent('.over_lst').addClass('frm');
    	$('.over_lst li').removeClass('act');
    	$(this).addClass('act');
    });
     $('.non_far_link').click(function(){
     $(".over_lst").attr('class', 'over_lst');
    	$(this).parent('.over_lst').addClass('nn_frm');
    	$('.over_lst li').removeClass('act');
    	$(this).addClass('act');
    });
      $('.dlr_lnk').click(function(){
     $(".over_lst").attr('class', 'over_lst');
    	$(this).parent('.over_lst').addClass('dlr_lnk');
    	$('.over_lst li').removeClass('act');
    	$(this).addClass('act');
    });
       $('.gst_usr_lnk').click(function(){
       	$(".over_lst").attr('class', 'over_lst');
    	$(this).parent('.over_lst').addClass('gst_lnk');
    	$('.over_lst li').removeClass('act');
    	$(this).addClass('act');
    });
    // sale
    $('#loans .btn_anl').click(function(){
    	$('#loans .anl_mb_blk, #loans .al_anl').toggleClass('show_anl');

    	$('#loans .al_anl').click(function(){
    		$('#loans .anl_mb_blk, #loans .al_anl').removeClass('show_anl');
    	});
    });
    // company
      $('#company .btn_anl').click(function(){
    	$('#company .anl_mb_blk, #company .al_anl').toggleClass('show_anl');

    	$('#company .al_anl').click(function(){
    		$('#company .anl_mb_blk, #company .al_anl').removeClass('show_anl');
    	});
    });
      //

       // sales
      $('#sales .btn_anl').click(function(){
    	$('#sales .anl_mb_blk, #sales .al_anl').toggleClass('show_anl');

    	$('#sales .al_anl').click(function(){
    		$('#sales .anl_mb_blk, #sales .al_anl').removeClass('show_anl');
    	});
    });
      //

      // trades
      $('#trade_start .btn_anl').click(function(){
    	$('#trade_start .anl_mb_blk, #trade_start .al_anl').toggleClass('show_anl');

    	$('#trade_start .al_anl').click(function(){
    		$('#trade_start .anl_mb_blk, #trade_start .al_anl').removeClass('show_anl');
    	});
    });
      //


      // pay_rec
      $('#pay_rec .btn_anl').click(function(){
    	$('#pay_rec .anl_mb_blk, #pay_rec .al_anl').toggleClass('show_anl');

    	$('#pay_rec .al_anl').click(function(){
    		$('#pay_rec .anl_mb_blk, #pay_rec .al_anl').removeClass('show_anl');
    	});
    });
      //

      // Users
      $('#users_st .btn_anl').click(function(){
    	$('#users_st .anl_mb_blk, #users_st .al_anl').toggleClass('show_anl');

    	$('#users_st .al_anl').click(function(){
    		$('#users_st .anl_mb_blk, #users_st .al_anl').removeClass('show_anl');
    	});
    });
      //

      // Traders
      $('#trades .btn_anl').click(function(){
    	$('#trades .anl_mb_blk, #trades .al_anl').toggleClass('show_anl');

    	$('#trades .al_anl').click(function(){
    		$('#trades .anl_mb_blk, #trades .al_anl').removeClass('show_anl');
    	});
    });
      //

      // Cash Book
      $('#cash_book .btn_anl').click(function(){
    	$('#cash_book .anl_mb_blk, #cash_book .al_anl').toggleClass('show_anl');

    	$('#cash_book .al_anl').click(function(){
    		$('#cash_book .anl_mb_blk, #cash_book .al_anl').removeClass('show_anl');
    	});
    });
      //

        // all reports
      $('#over_reports .btn_anl').click(function(){
    	$('#over_reports .anl_mb_blk, #over_reports .al_anl').toggleClass('show_anl');

    	$('#over_reports .al_anl').click(function(){
    		$('#over_reports .anl_mb_blk, #over_reports .al_anl').removeClass('show_anl');
    	});
    });
      //

    // $('.nav-tabs').responsiveTabs();

} );
function getadminbanks() {
    bank_icn = '';
    $.ajax({
        url: url + "api/Banks/allaccounts",
        data: {},
        type: 'POST',
        datatype: 'json',
        success: function(response) {
            res = JSON.parse(response);
            var opt = '';
            if (res.data.length > 0) {
                $.each(res.data, function(index, bank) {

                     if (bank.account_type == "BANK") {
                        if (bank.account_name == "SBI") { bank_icn = 'sib_icn.png'; } else if (bank.account_name == "HDFC") { bank_icn = 'hdfc_icn.png'; } else if (bank.account_name == "ICICI") { bank_icn = 'icici_icn.png'; }

                        opt += '<li><div class="bank_logo"> <img src="http://3.7.44.132/aquacredit/assets/images/' + bank_icn + '" alt="" title=""> </div><div class="bank_mny"><div class="bank_bal"> ₹ ' + addCommas(bank.avail_amount) + ' </div><div class="accont_numb">' + bank.account_number + '</div></div></li>';
                    } else if (bank.account_type == "CASH") {
                        opt += '<li><div class="bank_logo"> <img src="http://3.7.44.132/aquacredit/assets/images/cash_account.png" alt="" title=""> </div>     <div class="bank_mny"><div class="bank_bal" id="branch_cash"> ₹ ' + addCommas(bank.avail_amount) + ' </div><div class="accont_numb">' + bank.account_name + '</div></div></li>';
                    }
                });
            }
            
            $(".all_bnks").html(opt);
            //document.getElementById("admin_bank").fstdropdown.rebind();
        }
    });
}
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
 function cb(start, end) {
    $('#date_val').val(start.format('D/MMM/YYYY') + ' - ' + end.format('D/MMM/YYYY'));
       
    if ($('#date_val').val() == "Invalid date - Invalid date") {
        $('#date_val').val('');
    } else {
        $('#date_val').val(start.format('D-MMM-YYYY') + ' to ' + end.format('D-MMM-YYYY'));
    }
}
</script>
<!-- <script type="text/javascript">
  (function($) {
      fakewaffle.responsiveTabs(['xs', 'sm']);
  })(jQuery);
</script> -->
<?php require_once 'footer.php' ; ?>    