<!DOCTYPE html>
<html lang="pt-br">
<head>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="../../materialize/css/materialize.min.css"  media="screen,projection"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link rel="stylesheet" href="..\..\assets\css\main.css">
</head>
  
<?php
	require_once('../../controllers/categorias.php');
	require_once('../utils/ehtml.php');
	$controller = new CategoriasController();
	$ehtml = new Ehtml();
	$categorias = $controller->read();
?>
<body>
	<?php
		echo $ehtml->navBar('Categorias');

		for($i = 0; $i < count($categorias); $i++){
			$countCategoria = 0;
			if($i % 2 == 0){
				$tagRow = "<div class='row'>";
				$tagFechaRow = null;
			}else{
				$tagRow = null;
				$tagFechaRow = "</div>";
			}

			ini_set('display_errors', 0);
			
			$countCategoria = $controller->countProdutos($categorias[$i]['id'])[0]['count'] ? : 0;
			$cardCategoria = "
		 		$tagRow
		 			<div class='col s6 m6'>
		 				<div class='card'>
		 					<div class='card-content'>
		 						<span class='card-title'>{$categorias[$i]['nome']}</span>
		 						<p>{$countCategoria} produto(s) cadastrado(s).</p>
		 					</div>
							 <div class='card-action'>
		 						<a class='tooltipped' data-position='bottom' data-tooltip='Adicionar Produtos' href='#'> <i class='material-icons'>add</i></a>
		 						<a class='tooltipped' data-position='bottom' data-tooltip='Editar Categoria' href='editar.php?id={$categorias[$i]['id']}'> <i class='material-icons'>edit</i></a>
		 						<a class='tooltipped' data-position='bottom' data-tooltip='Excluir Categoria' href='excluir.php?id={$categorias[$i]['id']}&metodo=delete'> <i class='material-icons'>delete</i></a>
		 					</div>
		 				</div>
		 			</div>
		 		$tagFechaRow";
		 	echo $cardCategoria;
		}
	?>

	<div id="addModal" class="modal">
		<div class="modal-title">
			<h4 class="center">Adicionar Categoria</h4>
		</div>
		<div class="modal-content">
			<div class="row">
				<form action="..\..\controllers\categorias.php" method="post" class="col s12">
					<div class="row center">
						<div class="input-field col s6">
							<i class="material-icons prefix">create</i>
							<input id="inputNome" name="dados[nome]" type="text">
							<label for="inputNome">Nome</label>
							<input type="hidden" name="metodo" value="Create">
						</div>
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