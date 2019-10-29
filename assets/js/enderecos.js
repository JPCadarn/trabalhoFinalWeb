$('button[id^="btnExcluir"]').click(function(){
	var enderecoId = $(this).attr('id').split('btnExcluir')[1];
	var dados = {
		id: enderecoId,
		metodo: 'delete'
	}
	$.post("http://localhost/trabalhoFinalWeb/controllers/enderecos.php", dados, function () {
			
		}
	).done(function(data) {
		console.log(JSON.parse(data));
		if(JSON.parse(data) === true)
			$('#endereco'+enderecoId).remove();
	});
})