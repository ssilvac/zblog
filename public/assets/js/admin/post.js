$(document).ready(function(){

	$(document).on('click', ".btn-delete", function(e){

		e.preventDefault();

		if(confirm("¿estás seguro de eliminar este post?")){
			var post = $(this).attr('data-post');

			$form = $("#delete_post_"+post);

			var action 	= $form.attr('action');
			var method 	= $form.attr('method');
			var token 	= $form.children(".token").val();

			var datos = {
				'_method' 	: "DELETE",
				'_token'	: token	
			}
			
			$.ajax({
	            async:true,
	            type: method,
	            data: datos,
	            url: action,
	            dataType: 'json',
	            success: function(data) {
	                
	            	$("#tr_"+data.id).addClass('danger').fadeOut('slow',function(){
	            		$(this).remove();
	            	})

	            }
	        });
		}

	})

});