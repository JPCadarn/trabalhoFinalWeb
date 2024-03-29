<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Carrinho - Gole Bebidas</title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed&display=swap" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="../../materialize/css/materialize.min.css"  media="screen,projection"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link rel="stylesheet" href="..\..\assets\css\main.css">
	<link rel="icon" href="..\..\assets\images\icone.png">
</head>
  
<?php
	if(session_status() <> PHP_SESSION_ACTIVE)
		session_start();

	if(!isset($_SESSION['usuario']))
		header('Location: ../login/');

	require_once('../../controllers/carrinhos.php');
	require_once('../../controllers/enderecos.php');
	require_once('../../controllers/cartaos.php');
	require_once('../utils/ehtml.php');
	$controllerCarrinhos = new CarrinhosController();
	$controllerEnderecos = new EnderecosController();
	$controllerCartaos = new CartaosController();
	$itens = $controllerCarrinhos->read($_SESSION['usuario']['id']);

	if(!count($itens))
		header('Location: '.$_SERVER['HTTP_REFERER']);

	$enderecos = $controllerEnderecos->readEnderecos($_SESSION['usuario']['id']);
	$cartaos = $controllerCartaos->readCartaos($_SESSION['usuario']['id']);
	$ehtml = new Ehtml();
	$valor = 0;
	$valorTotal = 0;
?>
<body>
	<?php
		echo "<header>";
			echo $ehtml->navBar('');
		echo "</header>";
		
		echo "<main>";
			echo "
				<nav>
					<div class='nav-wrapper indigo darken-4 center'>
						<div class='col s12'>
							<a href='../site/' class='breadcrumb'>Página Inicial</a>
							<a href='#' class='breadcrumb ativo'>Carrinho</a>
							<span id='totalCarrinho' class='right'></span>
						</div>
					</div>
				</nav>
			";
			echo "<form action='..\..\controllers\pedidos.php' method='POST'>";
			echo "<input type='hidden' name='cabecalho[usuario_id]' value='{$_SESSION['usuario']['id']}'>";
			for($i = 0; $i < count($itens); $i++){
				$valor = number_format($itens[$i]['valor'] * $itens[$i]['quantidade'], 2);
				$valorTotal += $valor;
				echo "
					<div class='row'>
						<div class='col s12 m12' id='produto".$i."'>
							<input type='hidden' name='itens[$i][produto_id]' value='{$itens[$i]['produto_id']}'>
							<input type='hidden' name='itens[$i][quantidade]' value='{$itens[$i]['quantidade']}'>
							<input type='hidden' name='itens[$i][id]' value='{$itens[$i]['id']}'>
							<input type='hidden' name='itens[$i][valor]' value='{$itens[$i]['valor']}'>
							<div class='card horizontal hoverable'>
								<div class='card-image'>
									<img class='img-carrinho' src='../../assets/images/".$itens[$i]['imagem']."'>
								</div>
								<div class='card-stacked'>
									<span class='carrinho-header left'>
										{$itens[$i]['nome']} 
										<span id='preco".$i."' class='carrinho-header right'>
											R\${$valor}
										</span>
									</span>
									<div class='card-content'>
									</div>
									<div class='card-action'>
										<div id='divQuantidade".$i."'>
											<span id='btnMenos' class='waves-effect waves-circle waves-light btn-floating btn-small waves-effect waves-light indigo'>
												<i class='material-icons left'>remove</i>
											</span>
											<span id='qtd".$i."'>{$itens[$i]['quantidade']}</span>
											<span id='btnMais' class='waves-effect waves-circle waves-light btn-floating btn-small waves-effect waves-light indigo'>
												<i class='material-icons left'>add</i>
											</span>
											<span id='btnExcluir' class='right waves-effect waves-circle waves-light btn-floating btn-small waves-effect waves-light red'>
												<i class='material-icons left'>clear</i>
											</span>
										</div>
									</div>
							</div>
						</div>
					</div>
				";
			}
			echo "
				<div class='row'>
					<div class='col s12 m12'>
						<div class='card hoverable center-align'>
							<div class='card-content'>	
							<span class='card-title'>Endereços</span>
			";
			foreach($enderecos as $endereco){
				echo "
					<span>
						<label>
							<input name='cabecalho[endereco_id]' value='{$endereco['id']}' required type='radio'/>
							<span>{$endereco['destinatario']}</span>
							<span>
								{$endereco['rua']}, {$endereco['bairro']}
								{$endereco['cidade']}, 
								{$endereco['cep']}, 
								{$endereco['estado']}
							</span>
						</label>
					</span>
				";
			}
			echo "
							</div>
						</div>
					</div>
				</div>";

			echo "
				<div class='row'>
					<div class='col s12 m12'>
						<div class='card hoverable center-align'>
							<div class='card-content'>	
								<span class='card-title'>Pagamento</span>
								<div class='input-field' id='parcelas'>
									<select name='cabecalho['parcelas']>
									";
									for($i = 0; $i < 10; $i++){
										echo "<option value='".($i+1)."'>".($i+1)." de R\$".number_format(($valorTotal/($i+1)), 2)."</option>";
									}
			echo "
									</select>
									<label>Número de Parcelas</label>
								</div>
								<span>
									<label>
										<input name='cabecalho[cartao_id]' value='0' required type='radio'/>
										<span>Boleto</span>
									</label>
								</span>
			";

			foreach($cartaos as $cartao){
				echo "
					<span>
						<label>
							<input name='cabecalho[cartao_id]' data-tipo='{$cartao['debito_credito']}' value='{$cartao['id']}' required type='radio'/>
							<span>**** **** *** {$cartao['ultimos_quatro']}</span>
						</label>
					</span>
				";
			}

			

			echo "
				<button class='right btn-floating btn-large indigo' name='metodo' type='submit' value='create'>
					<i class='large material-icons'>check</i>
				</button>";
		echo "</form>";
		echo "</main>";

		echo $ehtml->footer();
	?>

  	<script src="..\..\assets\js\jquery-3.4.1.js"></script>
	<script type="text/javascript" src="../../materialize/js/materialize.min.js"></script>
	<script src="..\..\assets\js\main.js" crossorigin="anonymous"></script>
	<script src="..\..\assets\js\carrinho.js" crossorigin="anonymous"></script>
  </body>
</html>