<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Categorias - Gole Bebidas</title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed&display=swap" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="../../materialize/css/materialize.min.css"  media="screen,projection"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link rel="stylesheet" href="..\..\assets\css\main.css">
	<link rel="icon" href="..\..\assets\images\icone.png">
</head>
  
<?php
	if (session_status() <> PHP_SESSION_ACTIVE)
	session_start();

	if (!$_SESSION['usuario']['admin'])
		header('Location: ../site/');

	require_once('../../controllers/categorias.php');
	require_once('../utils/ehtml.php');
	$controller = new CategoriasController();
	$ehtml = new Ehtml();
	$categoria = $controller->read($_GET['id']);
?>
<body>
	<header>
	<?php
		echo $ehtml->navBar('')
	?>
	</header>

	<main>
		<div class="row">
			<div class="modal-title">
				<h4 class="center">Alterar Categoria</h4>
			</div>
			<div class="row">
				<form action="..\..\controllers\categorias.php" method="post" class="col s12">
					<div class="row center">
						<div class="input-field col s12">
							<i class="material-icons prefix">create</i>
							<input id="inputNome" name="dados[nome]" value="<?php echo $categoria[0]['nome'] ?>" type="text">
							<label for="inputNome">Nome</label>
							<input type="hidden" name="metodo" value="edit">
							<input type="hidden" name="id" value="<?php echo $categoria[0]['id'] ?>">
						</div>
					</div>
					<div class="fixed-action-btn">
						<button class="waves-effect waves-circle waves-light btn-floating btn-large indigo darken-4" type="submit" value="edit">
							<i class="large material-icons">check</i>
						</button>
					</div>
				</form>
			</div>
		</div>
	</main>

	<?php
		echo $ehtml->footer();
	?>

  	<script src="..\..\assets\js\jquery-3.4.1.js"></script>
	<script type="text/javascript" src="../../materialize/js/materialize.min.js"></script>
	<script src="..\..\assets\js\main.js" crossorigin="anonymous"></script>
  </body>
</html>