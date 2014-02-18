$(document).ready(function() {
	$("#datepicker").datepicker();
});

$(document).ready(function() {
	$("#datepicker1").datepicker();
});

function imageSizeOn() {
	document.getElementById("base-image").setAttribute("width", "300");
}

function imageSizeOff() {
	document.getElementById("base-image").setAttribute("width", "200");
}