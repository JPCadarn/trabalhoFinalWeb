$('#btnMenos').click(function(){
	var divPai = this.closest('div');
	var nroItem = divPai.id.split('divQuantidade')[1];
	var nomeSpan = '#qtd' + nroItem;
	var qtd = $(nomeSpan).text();
	var divProduto = $('#produto'+nroItem)[0];
	console.log($('#'+divProduto.id).children()[0]);
	var usuario_id;
	if(qtd > 1){
		var dados = {
			metodo: 'edit',
			quantidade: qtd,
			produto_id: produto_id,
			usuario_id: usuario_id
		}
		qtd--;
		$.post("http://localhost/trabalhoFinalWeb/controllers/carrinhos.php", dados, function(data){

		})
	}
});