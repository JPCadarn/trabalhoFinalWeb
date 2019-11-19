$('.estrela').click(function(){	
	var nroEstrela = this.id.split('estrela')[1];
	var i;
	for(i = 1; i <= 5; i++){
		$('#estrela'+i).removeClass('indigo-text');
	}
	for(i = 1; i <= nroEstrela; i++){
		$('#estrela'+i).addClass('indigo-text');
		$('#inputNota').val(nroEstrela);
	}
});

$('#btnAvaliar').click(function(){
	var nota = $('#inputNota').val();
	var usuarioId = $('input[name ="dados[usuario_id]"]').val();
	var produtoId = $('input[name ="dados[produto_id]"]').val();
	var avaliacao = $('#textarea').val().trim();
	var dados = {
		dados: {
			produto_id: parseInt(produtoId),
			usuario_id: parseInt(usuarioId),
			texto: avaliacao,
			nota: parseInt(nota)
		},
		metodo: 'create'
	}
	$.post("http://localhost/trabalhoFinalWeb/controllers/avaliacaos.php", dados, function(data) {
            
	}).done(function (data) {
		console.log(JSON.parse(data));
		if (JSON.parse(data).insert === true){
			var tag = "<div class='col s12 m4'>";
			tag += "<div class='card hoverable'>";
			tag += "<div class='card-content'>";
			for(var i = 1; i <= 5; i++){
				if(i <= JSON.parse(data).dados.nota)
					tag += "<i class='material-icons indigo-text'>star</i>";
				else
					tag += "<i class='material-icons'>star</i>";
			}
			tag += "<p>"+JSON.parse(data).dados.texto+"</p></div></div></div>";
			alert('Avaliação cadastrada com sucesso!');
			$('#textarea').val('');
			$('#avaliacaos').append(tag);
		}
	});
});

$(document).ready(function () {
	for(i = 1; i <= 5; i++){
		$('#estrela'+i).addClass('indigo-text');
	}
	$('#inputNota').val(5);
});