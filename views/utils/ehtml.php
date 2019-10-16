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
			<nav class='navbar-fixed indigo darken-4'>
				<div class='nav-wrapper'>
					<a href='index.html' class='brand-logo center'>
						<img class='imagem-logo responsive-img' id='logo' src='..\..\assets\images\logo.png'/>
					</a>
					<a href='#' data-target='listaResponsivo' class='sidenav-trigger'><i class='material-icons'>menu</i></a>
					<ul class='left hide-on-med-and-down'>
						<li>{$titulo}</li>
					</ul>
					<ul class='right hide-on-med-and-down'>
						<li>
							<a class='dropdown-trigger' href='#!' data-target='dropdownCategorias'>Categorias
								<i class='material-icons right'>arrow_drop_down</i>
							</a>
						</li>
						<li><a href='sass.html'>Minha Conta</a></li>
						<li><a href='badges.html'> <i class='material-icons white-text'>shopping_cart</i></a></li>
					</ul>
				</div>
			</nav>
		
			<ul class='sidenav' id='listaResponsivo'>
				<li><a href='sass.html'>Sass</a></li>
				<li><a href='badges.html'>Components</a></li>
				<li><a href='collapsible.html'>Javascript</a></li>
			</ul>
			";
		}

		function selectProdutos($produtoSelecionado = ""){
			require_once('../../controllers/produtos.php');
			$controllerProdutos = new ProdutosController();
			$produtos = $controllerProdutos->read();

			if(empty($produtoSelecionado))
				$default = "selected";
			else
				$default = null;

			$tagSelect = "
				<div class='input-field col s12'>
					<select name='dados[produto_id]'>
						<option value='' disabled ".$default.">Escolha um produto</option>
			";

			foreach($produtos as $produto){
				if(empty($produtoSelecionado))
					$default = null;
				else
					$default = "selected";
					
				$tagSelect .= "<option ".$default." value='{$produto['id']}'>{$produto['nome']}</option>";
			}
			
			$tagSelect .= "
					</select>
					<label>Produto</label>
				</div>
			";
			
			echo $tagSelect;
		}

		function selectCategorias($categoriaSelecionada = ""){
			require_once('../../controllers/categorias.php');
			$controllerCategorias = new CategoriasController();
			$categorias = $controllerCategorias->read();

			if(empty($categoriaSelecionada))
				$default = "selected";
			else
				$default = null;

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