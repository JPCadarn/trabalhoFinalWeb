$('#inputConfirmaSenha').focusout(function(){
	var senha = $('#inputSenha').val();
	var confirmaSenha = $('#inputConfirmaSenha').val();
	if(senha === confirmaSenha){
		var dados = {
			id: $('input[name ="id"]').val(),
			senhaAntiga: $('#inputSenhaAntiga').val(),
			senhaNova: senha,
			metodo: 'validaSenha'
		}
		$.post("http://localhost/trabalhoFinalWeb/controllers/usuarios.php", dados, function(data){
		
		}).done(function(data){
			if(JSON.parse(data) === true){
				$('#btnSubmit').prop('disabled', false);
			}else{
				$('#inputSenhaAntiga').addClass('invalid');
				$('#inputSenhaAntiga').val('');
				$('#inputSenha').val('');
				$('#inputConfirmaSenha').val('');
			}
		});
	}else{
		alert('As senhas informadas não são iguais');
		$('#inputSenha').val('');
		$('#inputConfirmaSenha').val('');
		$('#inputSenha').focus();
	}
});

$('input[type=password]').focusin(function(){
	$('#btnSubmit').prop('disabled', true);
});