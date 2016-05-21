$(document).ready(function() {
	$('.delete').click(function(){
		var postid=$(this).attr('id');
		if (confirm('Bu civit silinsin mi?')){
			$.ajax({
				type: 'GET',
				url: 'deletepost.php?id=' + postid,
				success:function(){
					location.reload();
				}
			})
			
			$(this).parent('.civitler').fadeOut(500);
			
		};
	});



});
$('form.ajax').on('submit',function(){
 	var url=$(this).attr('action');
 		method=$(this).attr('method'),
 		data={};
 	$(this).find('[name]').each(function(index, value) {	
 		var val=$(this).val();
 		var	name=$(this).attr('name');
			data[name]=val;
 	});
 	$.ajax({
 		url: url,
 		type: method,
 		data: data,
 		success:function(){
 			location.reload();
 		}
 	})
 	
 	
 	return false; 
 	
		
})