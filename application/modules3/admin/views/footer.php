	<div id="loading" style="display:none;">
		<div class="loader">Loading...</div>
	</div>
	<input type="hidden" value="<?php echo current_url();?>" id="last_url">
</div>
<style type="text/css"> body {margin: 0px; padding: 0px;}</style>
<style>
#overlay {
	position: absolute;
	top: 0;
	left: 0;
	height: 100%;
	width: 100%;
	z-index: 1001; 
	background-color: #F1F6FC;
	opacity:0.3;
}
#loading {
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  position: fixed;
  display: block;
  opacity: 0.7;
  background-color: #fff;
  z-index: 9999;
  text-align: center;
}

#loading-image {
  position: absolute;
  top: 100px;
  left: 240px;
  z-index: 100;
}
.loader,
.loader:before,
.loader:after {
  background: #0052eb;
  -webkit-animation: load1 1s infinite ease-in-out;
  animation: load1 1s infinite ease-in-out;
  width: 1em;
  height: 4em;
}
.loader {
  color: #0052eb;
  text-indent: -9999em;
  margin: 88px auto;
  position: relative;
  font-size: 11px;
  -webkit-transform: translateZ(0);
  -ms-transform: translateZ(0);
  transform: translateZ(0);
  -webkit-animation-delay: -0.16s;
  animation-delay: -0.16s;
}
.loader:before,
.loader:after {
  position: absolute;
  top: 0;
  content: '';
}
.loader:before {
  left: -1.5em;
  -webkit-animation-delay: -0.32s;
  animation-delay: -0.32s;
}
.loader:after {
  left: 1.5em;
}
@-webkit-keyframes load1 {
  0%,
  80%,
  100% {
    box-shadow: 0 0;
    height: 4em;
  }
  40% {
    box-shadow: 0 -2em;
    height: 5em;
  }
}
@keyframes load1 {
  0%,
  80%,
  100% {
    box-shadow: 0 0;
    height: 4em;
  }
  40% {
    box-shadow: 0 -2em;
    height: 5em;
  }
}

</style>
<script src="<?php echo base_url();?>assets/js/scrollbar.js"></script>
<script>
		(function($){
			var wth = $(window).width();
			
			if(wth > 1024){
				$(window).on("load",function(){
				
				$(".main_cnt_blk").mCustomScrollbar({
					theme:"minimal",
					mouseWheelPixels: 35,
					scrollInertia:250,
				});
				$(".menu_list, .dataTables_scrollBody, #apr_loan, #apr_loans, .rprt_anl, .pop_blk_prive .lrg_flt, .tab_cnt_blk, .pop_min_h_div, .ord_comp_bl, .comp_blk").mCustomScrollbar({
					theme:"minimal",
					mouseWheelPixels: 35,
					scrollInertia:250,
				});
				
			});
		
			}
		})(jQuery);

	function check_session()
    {
		var url = '<?php echo base_url()?>';
        $.ajax({
            url:url+"admin/login/checkSession",
            method:"POST",
            success:function(data)
            {
				if(data == '1')
				{
					last_url = $("#last_url").val();
					window.location = url+'admin/logout?last_url='+last_url;
				}
			}
        })
	}
	var count_interval = setInterval(function(){
        check_session();
    }, 10000);
			
	</script>

</body>
</html>