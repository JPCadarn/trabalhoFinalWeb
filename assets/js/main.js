$(document).ready(function(){
	$('.sidenav').sidenav();
});

$(document).ready(function(){
    $('.tooltipped').tooltip();
});

$(document).ready(function(){
    $('.modal').modal();
});

$(document).ready(function(){
    $('select').formSelect();
});

$(document).ready(function(){
    $('.fixed-action-btn').floatingActionButton();
});

$(document).ready(function(){
    $('.datepicker').datepicker();
});

$(document).ready(function(){
    $('.slider').slider();
}); 

$('#dropdownCategorias').mouseleave(function(){
    $('#dropdownCategorias').blur();
    $('#navegacao').focus();
});

$(".dropdown-trigger").dropdown({
    hover: true,
    closeOnClick: true,
    coverTrigger: false
});