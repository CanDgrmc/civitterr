$(document).ready(function(){

});

$('#username, #password').click(function(){
	$('.hata').hide();
})
$('.Editbuton').click(function(){
	$(this).next().next().slideToggle();
	return false;
});
$('.delete').click(function(){
	$(this).parent().fadeOut(500);
})

