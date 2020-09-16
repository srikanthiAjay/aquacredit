<input type="hidden" value="<?php echo current_url();?>" id="last_url">
</div>
<style type="text/css"> body {margin: 0px; padding: 0px;}</style>

<script src="<?php echo base_url();?>assets/js/scrollbar.js"></script>
<script>
	(function($){
		//$(".dataTables_scrollBody").mCustomScrollbar("update");
		var wth = $(window).width();
		
		if(wth > 1024){
			$(window).on("load",function(){
			
			$(".main_cnt_blk").mCustomScrollbar({
				theme:"minimal",
				mouseWheelPixels: 35,
				scrollInertia:250,
			});
			$(".menu_list, .dataTables_scrollBody, .pop_blk_prive .lrg_flt, .tab_cnt_blk, .pop_min_h_div, .ord_comp_bl, .comp_blk").mCustomScrollbar({
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