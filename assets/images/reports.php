<?php require_once 'header.php' ; ?>
<script src='https://kit.fontawesome.com/a076d05399.js'></script> 
<?php require_once 'sidebar.php' ; ?>
<div class="right_blk"> 
	<script type="text/javascript">
		$(document).ready(function(){
			var win_wth = $(document).width();
if(win_wth <= 700){
$(".mobile_reprts").click(function(){
	$(".reports_menu ul").toggleClass('show_rp_mn');
	$(".reports_menu ul li").click(function(){
		$('.reports_menu ul li').removeClass("act");
	  	$(this).addClass("act");
	  	var val = $(this).text();
	  	$('.act_rppt').text(val);
	});
});
}else {
$(".reports_menu ul li").click(function(){
	$('.reports_menu ul li').removeClass("act");
  $(this).addClass("act");
});
}


		});
	</script>
	<style type="text/css">
		.reports_menu {
			width: 230px;
			background: #fff;
			border:1px solid #dddddd;
			border-radius: 10px;
			position: fixed;
			height: calc(100% - 80px);
			top: 65px;
			padding-top: 20px;
		}
	.reports_menu ul {list-style: none; margin: 0px; padding: 0px;}
	.reports_menu ul li {width: 100%; padding:5px 0px;}
	.reports_menu ul li a {text-decoration: none; display: block; font-size: 13px; color: #58666e; padding:10px 20px;}
	.reports_menu ul li.act a {color: #0e82ff; border-right: 2px solid #0e82ff;}
	.rprt_anl {
			position: fixed;
			width: calc(100% - 250px);
			left: 250px;
			height: calc(100% - 80px);
			overflow: auto;
		}
		.act_rppt {display: none;}
		.anlts {width: 252px; float: left; padding: 0px 15px 0px 0px; box-sizing: border-box;}
		.tbls_blk {width: calc(100% - 252px); float: left;}
		.anl_crd {width: 100%; border: 1px solid #dddddd; padding: 15px; margin-bottom: 12px; background: #fff; border-radius: 5px;}
		.date_anl {position: relative; cursor: pointer;}
		.date_fil {position: absolute; top: 20px; right: 20px;}
		.anl_crd .top_in_op {padding: 0px;}
		.top_in_op p {margin-top: 0px; padding-bottom: 5px;}
		.top_in_op h1 {margin-bottom: 0px;}
		.date_anl .top_in_op h1 {font-size: 14px; }
		.anl_tp {width: 100%; overflow: hidden;}
		.icn_anl {width: 55px; text-align: center; border-right: 1px solid #dddddd; float: left;}
		.icn_anl_rt {width: 133px; float: left; padding-left: 20px;}
		@media (max-width: 700px){
			.mobile_reprts {position: relative; padding: 0px; width: 100%;  top: 0px; height: auto;}
			.reports_menu ul {display: none; position: fixed; top: 113px; width:calc(100% - 30px); background: #fff; padding: 20px; height: calc(100% - 125px); overflow: auto; left: 15px;}
			.show_rp_mn {display: block!important;}
			.mobile_reprts:after, .mobile_reprts:before {content: ' '; width: 5px; height: 2px; color: #000; position: absolute; right: 20px;}
			.act_rppt {display: block; padding: 15px 20px; width: 100%;}
		} 
	</style>

	
	<div class="top_ttl_blk"> <span> Reports </span></div>
	<div class="trd_cr_r">
		<div class="reports_menu mobile_reprts"> 
			<span class="act_rppt"> Loans </span>
			<ul> 
				<li> <a href="#" title=""> Overall Reports </a> </li>
<li> <a href="#" title=""> Users </a> </li>
<li> <a href="#" title=""> Company </a> </li>
<li> <a href="#" title=""> Traders </a> </li>
<li> <a href="#" title=""> Inventery </a> </li>
<li class="act"> <a href="#" title=""> Loans </a> </li>
<li> <a href="#" title=""> Sales </a> </li>
<li> <a href="#" title=""> Trades </a> </li>
<li> <a href="#" title=""> Payables & Receivables </a> </li>
<li> <a href="#" title=""> Cash book </a> </li>
			</ul>
		</div>
		<div class="rprt_anl"> 
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
				</div>

			</div>
		</div>
	</div>
</div>
<?php require_once 'footer.php' ; ?>    