$('button[id^="btnMenos"]').click(function(){
	var divPai = this.closest('div');
	var nroItem = divPai.id.split('divQuantidade')[1];
	var nomeSpan = '#qtd' + nroItem;
	var qtd = $(nomeSpan).text();
	var produto_id = $('input[name ="itens['+nroItem+'][produto_id]"]').val();
	var usuario_id = $('input[name ="cabecalho[usuario_id]"]').val();
	var id = $('input[name ="cabecalho[id]"]').val();
	if(qtd > 1){
		qtd--;
		var dados = {
			dados: {
				quantidade: qtd,
				produto_id: produto_id,
				usuario_id: usuario_id,
				id: id
			},
			metodo: 'edit',
		}
		$.post("http://localhost/trabalhoFinalWeb/controllers/carrinhos.php", dados, function(data){
			
		}).done(function(){
			$(nomeSpan).text(qtd);
		});
	}
});

$('button[id^="btnMais"]').click(function(){
	var divPai = this.closest('div');
	var nroItem = divPai.id.split('divQuantidade')[1];
	var nomeSpan = '#qtd' + nroItem;
	var qtd = $(nomeSpan).text();
	var produto_id = $('input[name ="itens['+nroItem+'][produto_id]"]').val();
	var usuario_id = $('input[name ="cabecalho[usuario_id]"]').val();
	var id = $('input[name ="itens['+nroItem+'][id]"]').val();
	if(qtd < 10){
		qtd++;
		var dados = {
			dados: {
				quantidade: qtd,
				produto_id: produto_id,
				usuario_id: usuario_id,
				id: id
			},
			metodo: 'edit',
		}
		$.post("http://localhost/trabalhoFinalWeb/controllers/carrinhos.php", dados, function(data){
		}).done(function(data){
			if(data === true)
				$(nomeSpan).text(qtd);
		});
	}else{
		alert("Não é possível adicionar comprar mais de 10 unidades deste produto");
	}
});

$('button[id^="btnExcluir"]').click(function(){
	var divPai = this.closest('div');
	var nroItem = divPai.id.split('divQuantidade')[1];
	var id = $('input[name ="itens['+nroItem+'][id]"]').val();
	if(id){
		var dados = {
			id: id,
			metodo: 'delete',
		}
		$.post("http://localhost/trabalhoFinalWeb/controllers/carrinhos.php", dados, function(data){
		}).done(function(data){
			data = JSON.parse(data);
			if(data == true)
				$('#produto'+nroItem).remove();
		});
	}
});