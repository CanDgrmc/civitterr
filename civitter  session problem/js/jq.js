$(document).ready(function(){

});

$('#username, #password').click(function(){
	$('.hata').hide();
})
$('.Editbuton').click(function(){
	$(this).next().next().slideToggle();
	return false;
});
$('.Editbuton1').click(function(){
	$(this).next().slideToggle();
	return false;
});
$('.delete').click(function(){
	$(this).parent().fadeOut(500);
})

$('#photoToggle').on('click',function(){
	$('#photo').click();
	$('.yukle').show();

})
$('.yukle').on('click',function(){
	$(this).hide();
	$('#photosubmit').click();

})