<!DOCTYPE html>
<html lang="pt-br">
<head>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="../../materialize/css/materialize.min.css"  media="screen,projection"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link rel="stylesheet" href="..\..\assets\css\main.css">
</head>
  
<?php
	require_once('../../controllers/produtos_destaque.php');
	require_once('../../controllers/produtos.php');
	require_once('../utils/ehtml.php');
	$destaquesController = new ProdutosDestaqueController();
	$destaques = $destaquesController->read();
	$ehtml = new Ehtml();
?>
<body>
	<?php
		echo $ehtml->navBar('Destaques');

		for($i = 0; $i < count($destaques); $i++){
            if($i % 3 == 0){
				$tagRow = "<div class='row'>";
				$tagFechaRow = null;
			}elseif($i % 2 == 2){
				$tagRow = null;
				$tagFechaRow = "</div>";
            }else{
                $tagRow = null;
				$tagFechaRow = null;
			}

			$imagem = ($destaques[$i]['imagem']);

            echo "
                $tagRow
                    <div class='col s4 m4'>
                        <div class='card'>
                            <div class='card-image'>
                                <img src='..\..\assets\images\\".$destaques[$i]['imagem']."'>
							</div>
							<div class='card-content center'>
                                <span class='card-title black-text'>{$destaques[$i]['nome']}</span>
                                <p>R$ {$destaques[$i]['valor']}</p>
                            </div>
                            <div class='card-action center'>
		 						<a class='tooltipped' data-position='bottom' data-tooltip='Excluir Destaque' href='excluir.php?id={$destaques[$i]['id']}&metodo=delete'> <i class='material-icons'>delete</i></a>
		 					</div>
                        </div>
                    </div>
                $tagFechaRow
            ";
        }
	?>
	
	<div id="addModal" class="modal">
		<div class="modal-title">
			<h4 class="center">Adicionar Categoria</h4>
		</div>
		<div class="modal-content">
			<div class="row">
				<form action="..\..\controllers\produtos_destaque.php" method="post" class="col s12">
					<div class="row center">
						<div class="input-field col s6">
							<i class="material-icons prefix">reorder</i>
							<input id="inputOrdem" name="dados[ordem]" type="number">
							<label for="inputOrdem">Ordem</label>
							<input type="hidden" name="metodo" value="Create">
						</div>
						<?php
							echo $ehtml->selectProdutos();
						?>
					</div>
					<div class="fixed-action-btn">
					<div class="fixed-action-btn">
						<button class="btn-floating btn-large red" type="submit" value="Create">
							<i class="large material-icons">check</i>
						</button>
					</div>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="fixed-action-btn">
		<a data-target="addModal" class="btn-floating modal-trigger btn-large red">
			<i class="large material-icons">add</i>
		</a>
	</div>

  	<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="../../materialize/js/materialize.min.js"></script>
	<script src="https://kit.fontawesome.com/70c1a7f591.js" crossorigin="anonymous"></script>
	<script src="..\..\assets\js\main.js" crossorigin="anonymous"></script>
  </body>
</html>