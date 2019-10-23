function carregar_dados(){
	var dados = {
		metodo: "select"
	}

	$.post("http://localhost/exemplo_webservice/api.php", dados, function(data){
		var json = JSON.parse(data);
		$("#resultado").append(data);
		for(var i=0; i<json.length; i++){
			$("#resultado").append(json[i].id + "<br>");
		}
	});
}
$( window ).load(function() {
  carregar_dados();
});
function  buscar_usuario()
{	

	var input_valor = $("[name=input_valor]").val();

  	var dados = {
		metodo: "mostrar", valor: input_valor  
	}

	$.post("http://localhost/exemplo_webservice/api.php", dados, function(data){
	var json = JSON.parse(data);
		for(var i=0; i<json.length; i++){
			$("#resultado").append(json[i].id + json[i].nome + json[i].email + json[i].senha + "<br>");
		}
	})
	.done(function(){
          alert("Ok");
     })
	 .fail(function(){
          alert("Erro :");
     });
}	
    
$("#btn_buscar").on('click', function()
    {
       buscar_usuario();

    });