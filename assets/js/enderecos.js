$('button[id^="btnExcluir"]').click(function(){
	var enderecoId = $(this).attr('id').split('btnExcluir')[1];
	var dados = {
		id: enderecoId,
		metodo: 'delete'
	}
	$.post("http://localhost/trabalhoFinalWeb/controllers/enderecos.php", dados, function () {
			
		}
	).done(function(data) {
		$('#endereco'+enderecoId).fadeTo('fast', 0.01, function(){ 
			$('#endereco'+enderecoId).slideUp(150, function() {
				$('#endereco'+enderecoId).remove(); 
			}); 
		});
		// if(JSON.parse(data) === true)
		// 	$('#endereco'+enderecoId).remove();
	});
})