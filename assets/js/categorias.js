$('button[id^="btnExcluir"]').click(function() {
    var categoriaId = $(this).attr('id').split('btnExcluir')[1];
    var dados = {
        id: categoriaId,
        metodo: 'delete'
    }
    $.post("http://localhost/trabalhoFinalWeb/controllers/categorias.php", dados, function() {

    }).done(function(data) {
        if (JSON.parse(data) === true) {
            $('#categoria' + categoriaId).fadeTo('fast', 0.01, function() {
                $('#categoria' + categoriaId).slideUp(150, function() {
                    $('#categoria' + categoriaId).remove();
                });
            });
        }else if(JSON.parse(data) == 2){
			alert('Esta categoria possui produtos cadastrados. Não é possível exclui-la.')
		}
    });
})