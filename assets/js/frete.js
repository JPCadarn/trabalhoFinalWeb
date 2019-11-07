$(document).ready(function () {
	$('#inputCep').mask('00000-000');
});

$('#btnFrete').click(function(){
	var cep = $('#inputCep').val().replace('-', '');
	var dados = {
		cep: cep
	}

	$.post("http://localhost/trabalhoFinalWeb/views/utils/frete.php", dados, function() {
				
			}
		).done(function(data){
			frete = JSON.parse(data);
			console.log(frete);
			$('#valorExpresso').text('R$ ' + frete.valorExpresso);
			$('#prazoExpresso').text(frete.prazoExpresso + ' dias');
			$('#valorNormal').text('R$ ' + frete.valorNormal);
			$('#prazoNormal').text(frete.prazoNormal + ' dias');
			mostrarValores();
		});
});

function mostrarValores(){
	var valorExpresso = $('#valorExpresso').text();
	var valorNormal = $('#valorNormal').text();
	var prazoExpresso = $('#prazoExpresso').text();
	var prazoNormal = $('#prazoNormal').text();

	if(valorExpresso && valorNormal && prazoExpresso && prazoNormal){
		$('#valoresFrete').show(400);
	}
}