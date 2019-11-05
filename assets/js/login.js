// $(document).keypress(function(e) {
//     e.preventDefault();
//     if (e.which == 13) {
//         alert('You pressed enter!');
//     }
// });

$('input').keypress(function (e) { 
	if(e.which == 13){
		e.preventDefault();
		$('form').submit();
	}
});