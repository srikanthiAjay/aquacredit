</div>
<style type="text/css"> body {margin: 0px; padding: 0px;}</style>

<script src="<?php echo base_url();?>assets/js/scrollbar.js"></script>
<script>
		(function($){
			$(window).on("load",function(){
				
				$(".main_cnt_blk").mCustomScrollbar({
					theme:"minimal"
				});
				$(".menu_list, .dataTables_scrollBody, .lrg_flt, .tab_cnt_blk, .pop_min_h_div, .ord_comp_bl, .comp_blk").mCustomScrollbar({
					theme:"minimal"
				});
				
			});
		})(jQuery);
	</script>

</body>
</html>