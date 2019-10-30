$('button[id^="btnExcluir"]').click(function(){
	var produtoId = $(this).attr('id').split('btnExcluir')[1];
	var dados = {
		id: produtoId,
		metodo: 'delete'
	}
	$.post("http://localhost/trabalhoFinalWeb/controllers/produtos.php", dados, function () {
			
		}
	).done(function(data) {
		if(JSON.parse(data) === true){
			$('#produto'+produtoId).fadeTo('fast', 0.01, function(){ 
				$('#produto'+produtoId).slideUp(150, function() {
					$('#produto'+produtoId).remove(); 
				}); 
			});
		}
	});
})