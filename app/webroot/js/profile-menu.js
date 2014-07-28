$(document).ready(function() {
	$(".user").on('click', function() {
		console.log("click");
		$( ".drop-down" ).toggleClass('open');
	});
});