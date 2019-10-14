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
	$controller = new CategoriasController();
	$categoria = $controller->read($_GET['id']);
?>
<body>
	<ul id="dropdownCategorias" class="dropdown-content">
		<?php
		foreach($categorias as $categoria){
			$tagListaCategorias = "
				<li><a href='#!'>{$categoria['nome']}</a></li>
			";
			echo $tagListaCategorias;
		}
		?>
	</ul>
	<nav>
		<div class="nav-wrapper">
			<a href="#!" class="brand-logo">Logo</a>
			<a href="#" data-target="listaResponsivo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
			<ul class="brand-logo center">
				<li>Categorias -> Alterar</li>
			</ul>
			<ul class="right hide-on-med-and-down">
				<li><a href="sass.html">Sass</a></li>
				<li><a href="badges.html">Components</a></li>
				<li><a href="collapsible.html">Javascript</a></li>
				<li>
					<a class="dropdown-trigger" href="#!" data-target="dropdownCategorias">Dropdown
						<i class="material-icons right">arrow_drop_down</i>
					</a>
				</li>
			</ul>
		</div>
	</nav>

	<ul class="sidenav" id="listaResponsivo">
		<li><a href="sass.html">Sass</a></li>
		<li><a href="badges.html">Components</a></li>
		<li><a href="collapsible.html">Javascript</a></li>
		<li><a href="mobile.html">Mobile</a></li>
	</ul>

	<div class="row">
		<div class="modal-title">
			<h4 class="center">Alterar Categoria</h4>
		</div>
		<div class="row">
			<form action="..\..\controllers\categorias.php" method="post" class="col s12">
				<div class="row center">
					<div class="input-field col s6">
						<i class="material-icons prefix">create</i>
						<input id="inputNome" name="dados[nome]" value="<?php echo $categoria[0]['nome'] ?>" type="text">
						<label for="inputNome">Nome</label>
						<input type="hidden" name="metodo" value="edit">
						<input type="hidden" name="id" value="<?php echo $categoria[0]['id'] ?>">
					</div>
				</div>
				<div class="fixed-action-btn">
					<button class="btn-floating btn-large red" type="submit" value="edit">
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