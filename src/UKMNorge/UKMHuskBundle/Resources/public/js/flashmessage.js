$(document).ready(function(){
	$('.flashbagMessage').each( function() {
		setTimeout(function(id){ $('#'+id).slideUp(); }, 4500, $(this).attr('id')); 
	});
});