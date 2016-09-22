$(document).ready(function(){
	$('.flashbagMessage').each( function() {
		setTimeout(function(id){ $('#'+id).slideUp(); }, 3500, $(this).attr('id')); 
	});
});