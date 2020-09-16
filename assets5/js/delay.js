var min = 0;
var max = 5;
function ad_delay()
{
	var interwel = ["200","400","600","800","1000","1200"];
	var random = Math.floor(Math.random() * (max - min + 1)) + min;
	return interwel[random];
}
