$('button[id^="btnExcluir"]').click(function(){
	var cartaoId = $(this).attr('id').split('btnExcluir')[1];
	var dados = {
		id: cartaoId,
		metodo: 'delete'
	}
	$.post("http://localhost/trabalhoFinalWeb/controllers/cartaos.php", dados, function () {
			
		}
	).done(function(data) {
		if(JSON.parse(data) === true){
			$('#cartao'+cartaoId).fadeTo('fast', 0.01, function(){ 
				$('#cartao'+cartaoId).slideUp(150, function() {
					$('#cartao'+cartaoId).remove(); 
				}); 
			});
		}
	});
})