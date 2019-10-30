$('button[id^="btnExcluir"]').click(function(){
	var destaqueId = $(this).attr('id').split('btnExcluir')[1];
	var dados = {
		id: destaqueId,
		metodo: 'delete'
	}
	$.post("http://localhost/trabalhoFinalWeb/controllers/produtos_destaque.php", dados, function () {
			
		}
	).done(function(data) {
		if(JSON.parse(data) === true){
			$('#destaque'+destaqueId).fadeTo('fast', 0.01, function(){ 
				$('#destaque'+destaqueId).slideUp(150, function() {
					$('#destaque'+destaqueId).remove(); 
				}); 
			});
		}
	});
})