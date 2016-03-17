$(function() {
	$( "#datepicker" ).datepicker({
		dayNamesMin: [ "Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa" ],
		dateFormat: "yy-mm-dd",
		minDate: "getDate+1"
	});
});