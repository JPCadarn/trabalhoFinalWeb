<?php
	class Ehtml {
		function navBar($titulo){
			require_once('../../controllers/categorias.php');
			$controllerCategorias = new CategoriasController();
			$categorias = $controllerCategorias->read();

			$tagListaCategorias = "";

			echo "<ul id='dropdownCategorias' class='dropdown-content'>";
			foreach($categorias as $categoria){
				$tagListaCategorias = "
					<li><a href='#!'>{$categoria['nome']}</a></li>
				";
				echo $tagListaCategorias;
			}
			echo "</ul>";

			echo "
			<nav>
				<div class='nav-wrapper'>
					<ul class='left'>
						<li>Logo</li>
					</ul>
					<a href='#' data-target='listaResponsivo' class='sidenav-trigger'><i class='material-icons'>menu</i></a>
					<ul class='brand-logo center'>
						<li>{$titulo}</li>
					</ul>
					<ul class='right hide-on-med-and-down'>
						<li><a href='sass.html'>Sass</a></li>
						<li><a href='badges.html'>Components</a></li>
						<li><a href='collapsible.html'>Javascript</a></li>
						<li>
							<a class='dropdown-trigger' href='#!' data-target='dropdownCategorias'>Dropdown
								<i class='material-icons right'>arrow_drop_down</i>
							</a>
						</li>
					</ul>
				</div>
			</nav>
		
			<ul class='sidenav' id='listaResponsivo'>
				<li><a href='sass.html'>Sass</a></li>
				<li><a href='badges.html'>Components</a></li>
				<li><a href='collapsible.html'>Javascript</a></li>
				<li><a href='mobile.html'>Mobile</a></li>
			</ul>
			";
		}

		function selectCategorias($categoriaSelecionada = ""){
			require_once('../../controllers/categorias.php');
			$controllerCategorias = new CategoriasController();
			$categorias = $controllerCategorias->read();

			if(empty($categoriaSelecionada))
				$default = null;
			else
				$default = "selected";

			$tagSelect = "
				<div class='input-field col s12'>
					<select name='dados[categoria_id]'>
						<option value='' disabled ".$default.">Escolha uma categoria</option>
			";

			foreach($categorias as $categoria){
				if(empty($categoriaSelecionada))
					$default = null;
				else
					$default = "selected";
					
				$tagSelect .= "<option ".$default." value='{$categoria['id']}'>{$categoria['nome']}</option>";
			}
			
			$tagSelect .= "
					</select>
					<label>Categorias</label>
				</div>
			";
			
			echo $tagSelect;
		}
	}
?>