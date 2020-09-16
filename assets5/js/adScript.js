var my_var_1='';
var id = '';
var this_js_script = $('script[src*=adScript]');
var my_var_1 = this_js_script.attr('src'); 
if (typeof my_var_1 === "undefined" ) 
{
   	var my_var_1 = 'some_default_value';
}
t = my_var_1.split('?');
id = t[1];
if("undefined"!=typeof jQuery)
{
	!function(a)
	{
		a(function()
		{
			function b()
			{
				a.getJSON(g,function(a)
				{
					$('#'+id).html(a);
				})
			}
			var c=a(this),d="";
			document.referrer&&(d=document.referrer.split("/")[2].replace(":","_"));
			var e="";
			a(location).attr("href")&&(e=a(location).attr("href").split("/")[2].replace(":","_"));
			var ip = a(location).attr("href")&&(e=a(location).attr("href").split("/")[2].replace(":","_"));
			var g=(a(window).width(),"//aqua.deals/admin/ads/getAd/"+id+"/"+ip);
			// $("<link/>", {
			//    rel: "stylesheet",
			//    type: "text/css",
			//    href: "//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css"
			// }).appendTo("head");
			b()
		})
	}(jQuery)
}