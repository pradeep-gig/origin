$(document).ready(function() {
	$(".button").on('click', function(event) {
		console.log("click");
		event.preventDefault();
		$(".livepost").css('display', 'block');
		
		$(".add-post").css('display', 'block');
	})	
});