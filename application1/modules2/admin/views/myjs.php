<script>
$("#hid_medval").val(mval);
	//alert(mval);
	var mval = mval;
	var	hidmedval = $("#hid"+mval).val();
	var	newhidmedval = "";
	
	var allboxes = $(".al_brands input:checkbox").map(function(){
		  return $(this).val();
		}).get();
	var cnf = document.getElementById("brand"+bval);
	if( cnf.checked ==  true){		
		
		//$('#autoUpdate').fadeIn('slow');
		//$('#'+bval).fadeOut('slow');
		if(hidmedval == "") $("#hid"+mval).val(bval);
		else $("#hid"+mval).val(hidmedval +','+bval);	
	}
	var allchecks = $(".al_brands input:checkbox:checked").map(function(){
	  return $(this).val();
	}).get();
	console.log(allchecks);
	var	newhidmedval = $("#hid"+mval).val();	
	
	//console.log(hidmedval);
	var names_arr = newhidmedval.split(',');
	console.log(names_arr);
	
	$.each(names_arr, function( index, value ) {
	  //alert( index + ": " + value );
	  $('#'+value).fadeIn('slow');
	});
	
	difference = allchecks.filter(a => !names_arr.includes(a));
	console.log(difference);
	$.each(difference, function( index, value ) {
	  //alert( index + ": " + value );
	  $('#'+value).fadeOut('slow');
	});
</script>