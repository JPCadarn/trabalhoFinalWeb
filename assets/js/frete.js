$(document).ready(function () {
	$('#inputCep').mask('00000-000');
});

$('#btnFrete').click(function(){
	var cep = $('#inputCep').val().replace('-', '');
	requestFrete(cep, '40010');
	requestFrete(cep, '41106');
});

function requestFrete(cep, tipo){
	var frete;
	if(cep){
		var dados = {
			cep: cep,
			tipo: tipo
		}

		$.post("http://localhost/trabalhoFinalWeb/views/utils/frete.php", dados, function() {
				
			}
		).done(function(data){
			frete = JSON.parse(data);
			if(frete.Erro == 0){
				switch (tipo){
					case '40010':
						$('#valorSedex').text('R$ ' + frete.Valor);
						$('#prazoSedex').text(frete.PrazoEntrega + ' dias');
						break;

						case '41106':
						$('#valorPAC').text('R$ ' + frete.Valor);
						$('#prazoPAC').text(frete.PrazoEntrega + ' dias');
						break;
				}
			}else{
				console.log(frete.MsgErro)
			}
			mostrarValores();
		});
	}
}

function mostrarValores(){
	var sedexValor = $('#valorSedex').text();
	var pacValor = $('#valorPAC').text();
	var sedexPrazo = $('#prazoSedex').text();
	var pacPrazo = $('#prazoPAC').text();
	console.log(sedexValor, pacValor, sedexPrazo, pacPrazo)

	if(sedexValor && pacValor && sedexPrazo && pacPrazo){
		$('#valoresFrete').show(400);
	}
}