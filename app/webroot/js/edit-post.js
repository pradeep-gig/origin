$(document).ready(function() {
	$(".edit-button").on('click', function(e) {
		e.preventDefault();
		var post_id = $(this).next('.post-id').val();
    var temp = $(this);
		$.ajax({
           type: "post",
           url: "/Posts/postedit",
           data: {post_id : post_id},
           //timeout: 10000,
           success: function(data){    
               //console.log(data);
               if(data=='not found error'){
               	//error handule function
               }
               var post_details=JSON.parse(data);
               $(".Epost-title").val(post_details.Post.title);
               $(".Epost-body").val(post_details.Post.body);
               $(".Epost-id").val(post_id);

               $( ".edit-post" ).dialog({
                width: 500
               });

               $("#Save-post").on('click', function() {
                var edited_id = $(".Epost-id").val();
                var edited_title = $(".Epost-title").val();
                var edited_body = $(".Epost-body").val();
                $.ajax({
                        type: "post",
                        url: "/Posts/posteditdone",
                        dataType: "json",
                        data: {edited_title : edited_title,
                               edited_body  : edited_body,
                               edited_id    : edited_id
                        },
                        success: function(data){
                          temp.parent().find('.post-title').text(data.title);
                          temp.parent().find('.post-body').text(data.body);

                        }
                        
                });
                $(".edit-post").dialog( "close" );
              });

           },
           error: function(data){
           		console.log(data);	
             }
       });

	});
      
  	
});