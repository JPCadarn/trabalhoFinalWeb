<?php
	class Ehtml {
		function navBar($titulo){
			if(session_status() <> PHP_SESSION_ACTIVE)
				session_start();
				
			require_once('../../controllers/categorias.php');
			$controllerCategorias = new CategoriasController();
			$categorias = $controllerCategorias->read();

			$tagListaCategorias = "";

			echo "<ul id='dropdownCategorias' class='dropdown-content'>";
			foreach($categorias as $categoria){
				$tagListaCategorias = "
					<li><a href='../site/categoria.php?id={$categoria['id']}'>{$categoria['nome']}</a></li>
				";
				echo $tagListaCategorias;
			}
			echo "</ul>";

			echo "<ul id='dropdownCategoriasMobile' class='dropdown-content'>";
			foreach($categorias as $categoria){
				$tagListaCategorias = "
					<li><a href='../site/categoria.php?id={$categoria['id']}'>{$categoria['nome']}</a></li>
				";
				echo $tagListaCategorias;
			}
			echo "</ul>";
			
			if(isset($_SESSION['usuario']['admin']) AND $_SESSION['usuario']['admin']){
				$tagLoginOuConta = "
					<li><a href='../login/logout.php'>Logout</a></li>
					<li><a href='../administrativo/'>Painel Administrativo</a></li>
				";
			}elseif(isset($_SESSION['usuario'])){
				$tagLoginOuConta = "
					<li><a href='../login/logout.php'>Logout</a></li>
					<li><a href='../usuarios/pedidos.php'>Minha Conta</a></li>
				";
			}else{
				$tagLoginOuConta = "
					<li><a href='../login/'>Login</a></li>
				";
			}

			echo "
			<div class='navbar-fixed'>
			<nav class='indigo darken-4'>
					<div class='nav-wrapper' id='navegacao'>
						<a href='../site/' class='brand-logo center' tabIndex='-1'>
							<img class='imagem-logo responsive-img' tabIndex='-1' id='logo' src='..\..\assets\images\logo.png'/>
						</a>
						<a href='#' data-target='listaResponsivo' class='sidenav-trigger'><i class='material-icons'>menu</i></a>
						<ul class='left hide-on-med-and-down'>
							<li>{$titulo}</li>
						</ul>
						<ul class='right hide-on-med-and-down'>
							<li>
								<a class='dropdown-trigger' id='linkDrop' href='#!' data-target='dropdownCategorias'>Categorias
									<i class='material-icons right'>arrow_drop_down</i>
								</a>
							</li>
							$tagLoginOuConta
							<li><a href='../../views/site/carrinho.php'> <i class='material-icons white-text'>shopping_cart</i></a></li>
						</ul>
					</div>
				</nav>
			</div>
		
			<ul class='sidenav' id='listaResponsivo'>
				<li>
					<a class='dropdown-trigger' href='#!' data-target='dropdownCategoriasMobile'>Categorias
						<i class='material-icons right'>arrow_drop_down</i>
					</a>
				</li>
				$tagLoginOuConta
				<li><a href='../../views/site/carrinho.php'> <i class='material-icons white-text'>shopping_cart</i></a></li>
			</ul>
			";
		}

		function footer(){
			echo "
				<footer class='page-footer indigo darken-4'>
					<div class='container'>
						<div class='row center'>
							<div class='col l4 s12'>
								<h5 class='white-text'><i class='material-icons'>time_to_leave</i>Frete Grátis</h5>
								<p class='grey-text text-lighten-4'>Em compras acima de R$ 599,90</p>
							</div>
							<div class='col l4 s12'>
								<h5 class='white-text'><i class='material-icons'>credit_card</i>Até 10x</h5>
								<p class='grey-text text-lighten-4'>Parcele suas compras em até 10x no cartão de crédito</p>
							</div>
							<div class='col l4 s12'>
								<h5 class='white-text'><i class='material-icons'>timer</i>Entrega Expressa</h5>
								<p class='grey-text text-lighten-4'>Compras feitas até às 15 horas serão despachadas no mesmo dia</p>
							</div>
						</div>
					</div>
					<div class='footer-copyright'>
						<div class='container'>
							© 2019 Copyright
							<span class='white-text right'>Proibido o consumo de bebidas alcoólicas para menores de 18 anos</span>
						</div>
					</div>
			</footer>
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
					
				$tagSelect .= "<option $default value='{$categoria['id']}'>{$categoria['nome']}</option>";
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