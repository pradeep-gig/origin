$(document).ready(function() {
	$(".button").on('click', function(event) {
		console.log("click");
		event.preventDefault();
		$(".add-post").css('display', 'block');
	})	
});