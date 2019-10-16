<!DOCTYPE html>
<html lang="pt-br">
<head>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="../../materialize/css/materialize.min.css"  media="screen,projection"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link rel="stylesheet" href="..\..\assets\css\main.css">
</head>
  
<?php
	require_once('../../controllers/produtos.php');
	require_once('../utils/ehtml.php');
	$controller = new ProdutosController();
	$ehtml = new Ehtml();
	$produto = $controller->read($_GET['id'])[0];
?>
<body>
	<?php
		echo $ehtml->navBar('Produtos');
	?>

	<div class="row">
		<div class="modal-title">
			<h4 class="center">Alterar Produto</h4>
		</div>
		<div class="row">
			<form action="..\..\controllers\produtos.php" enctype="multipart/form-data" method="post" class="col s12">
				<div class="input-field col s12">
					<i class="material-icons prefix">create</i>
					<input required id="inputNome" value="<?php echo $produto['nome'] ?>" name="dados[nome]" type="text">
					<input name="metodo" type="hidden" value="edit">
					<input name="id" type="hidden" value="<?php echo $_GET['id'] ?>">
					<label for="inputNome">Nome</label>
				</div>
				<div class="input-field col s12">
					<i class="material-icons prefix">assignment</i>
					<input required id="inputDescricao" value="<?php echo $produto['descricao'] ?>" name="dados[descricao]" type="text">
					<label for="inputDescricao">Descrição</label>
				</div>
				<div class="input-field col s12">
					<i class="material-icons prefix">attach_money</i>
					<input required id="inputValor" value="<?php echo $produto['valor'] ?>" name="dados[valor]" type="text">
					<label for="inputValor">Valor</label>
				</div>
				<div class="input-field col s12">
					<i class="material-icons prefix">local_bar</i>
					<input required id="inputTeor" value="<?php echo $produto['teor_alcoolico'] ?>" name="dados[teor_alcoolico]" type="text">
					<label for="inputTeor">Teor Alcoólico</label>
				</div>
				<?php
					echo $ehtml->selectCategorias($produto['categoria_id']);
				?>
				<div class="file-field input-field col s12">
					<div class="btn blue">
						<span>Imagem</span>
						<input required name='imagem' type="file" accept="image/*">
					</div>
					<div class="file-path-wrapper">
						<input class="file-path" type="text">
					</div>
				</div>
				<div class="fixed-action-btn">
					<button class="btn-floating btn-large indigo darken-4" type="submit" value="edit">
						<i class="large material-icons">check</i>
					</button>
				</div>
			</form>
		</div>
	</div>

  	<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="../../materialize/js/materialize.min.js"></script>
	<script src="https://kit.fontawesome.com/70c1a7f591.js" crossorigin="anonymous"></script>
	<script src="..\..\assets\js\main.js" crossorigin="anonymous"></script>
  </body>
</html>