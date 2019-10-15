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
	$controller = new ProdutosController();
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
				<li>Produtos -> Adicionar</li>
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
			<form action="..\..\controllers\produtos.php" method="post" class="col s12">
				<div class="row center">
					<div class="input-field col s12">
						<i class="material-icons prefix">create</i>
						<input required id="inputNome" name="dados[nome]" type="text">
						<label for="inputNome">Nome</label>
					</div>
					<div class="input-field col s12">
						<i class="material-icons prefix">assignment</i>
						<input required id="inputNome" name="dados[descricao]" type="text">
						<label for="inputNome">Descrição</label>
                    </div>
                    <div class="input-field col s12">
						<i class="material-icons prefix">attach_money</i>
						<input required id="inputNome" name="dados[valor]" type="text">
						<label for="inputNome">Valor</label>
                    </div>
                    <div class="input-field col s12">
						<i class="material-icons prefix">local_bar</i>
						<input required id="inputNome" name="dados[teor_alcoolico]" type="text">
						<label for="inputNome">Teor Alcoólico</label>
                    </div>
                    <div class="input-field col s12">
                        <select>
                            <option value="" disabled selected>Choose your option</option>
                            <option value="1">Option 1</option>
                            <option value="2">Option 2</option>
                            <option value="3">Option 3</option>
                        </select>
                        <label>Materialize Select</label>
                    </div>
                    <div class="file-field input-field">
                        <div class="btn">
                            <span>File</span>
                            <input type="file">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text">
                        </div>
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