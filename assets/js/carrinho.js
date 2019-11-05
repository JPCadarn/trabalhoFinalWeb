$('span[id^="btnMenos"]').click(function() {
    var divPai = this.closest('div');
    var nroItem = divPai.id.split('divQuantidade')[1];
    var nomeSpan = '#qtd' + nroItem;
    var qtd = $(nomeSpan).text();
    var produto_id = $('input[name ="itens[' + nroItem + '][produto_id]"]').val();
    var usuario_id = $('input[name ="cabecalho[usuario_id]"]').val();
    var id = $('input[name ="itens[' + nroItem + '][id]"]').val();
    var valorUnitario = $('#preco'+nroItem).text().trim().split('R$')[1] / qtd;
    if (qtd > 1) {
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
        $.post("http://localhost/trabalhoFinalWeb/controllers/carrinhos.php", dados, function(data) {
            
        }).done(function(data) {
            if (JSON.parse(data) === true){
                $(nomeSpan).text(qtd);
                var novoValor = valorUnitario * qtd;
                $('#preco'+nroItem).text('R$'+novoValor.toFixed(2));
                calcularTotalCarrinho();
            }
        });
    }
});

$('span[id^="btnMais"]').click(function() {
    var divPai = this.closest('div');
    var nroItem = divPai.id.split('divQuantidade')[1];
    var nomeSpan = '#qtd' + nroItem;
    var qtd = $(nomeSpan).text();
    var produto_id = $('input[name ="itens[' + nroItem + '][produto_id]"]').val();
    var usuario_id = $('input[name ="cabecalho[usuario_id]"]').val();
    var id = $('input[name ="itens[' + nroItem + '][id]"]').val();
    var valorUnitario = $('#preco'+nroItem).text().trim().split('R$')[1] / qtd;
    if (qtd < 10) {        
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
        $.post("http://localhost/trabalhoFinalWeb/controllers/carrinhos.php", dados, function(data) {

        }).done(function(data) {
            if (JSON.parse(data) === true){
                $(nomeSpan).text(qtd);
                var novoValor = valorUnitario * qtd;
                $('#preco'+nroItem).text('R$'+novoValor.toFixed(2));
                calcularTotalCarrinho();
            }
        });
    } else {
        alert("Não é possível adicionar comprar mais de 10 unidades deste produto");
    }
});

$('span[id^="btnExcluir"]').click(function() {
    var divPai = this.closest('div');
    var nroItem = divPai.id.split('divQuantidade')[1];
    var id = $('input[name ="itens[' + nroItem + '][id]"]').val();
    if (id) {
        var dados = {
            id: id,
            metodo: 'delete',
        }
        $.post("http://localhost/trabalhoFinalWeb/controllers/carrinhos.php", dados, function(data) {}).done(function(data) {
            data = JSON.parse(data);
            if (data == true) {
                $('#produto' + nroItem).fadeTo('fast', 0.01, function() {
                    $('#produto' + nroItem).slideUp(150, function() {
                        $('#produto' + nroItem).remove();
                    });
                });
            }
        });
    }
});

$("input[name='cabecalho[cartao_id]']").change(function(){
    if(this.value != 0 && $(this).data('tipo') == 'C'){
        $('#parcelas').show(400);
    }else{
        $('#parcelas').hide(400);
    }
});

function calcularTotalCarrinho() {
    var itens = $('div[id^="produto"]');
    var totalCarrinho = 0;
    itens.each(function() {
        var nroItem = this.id.split('produto')[1];
        totalCarrinho += parseFloat($(this).find('#preco'+nroItem).text().trim().split('R$')[1]);
    });
    $('#totalCarrinho').text('Total do Carrinho: R$'+totalCarrinho.toFixed(2));
}

$(document).ready(function () {
    calcularTotalCarrinho();    
});