<!DOCTYPE html>
<html lang="pt-br">
<head>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed&display=swap" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="../../materialize/css/materialize.min.css"  media="screen,projection"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link rel="stylesheet" href="..\..\assets\css\main.css">
</head>
  
<?php
	if(session_status() <> PHP_SESSION_ACTIVE)
		session_start();

	if(!isset($_SESSION['usuario']))
		header('Location: ../login/');

	require_once('../../controllers/carrinhos.php');
	require_once('../../controllers/enderecos.php');
	require_once('../utils/ehtml.php');
	$controllerCarrinhos = new CarrinhosController();
	$controllerEnderecos = new EnderecosController();
	$itens = $controllerCarrinhos->read($_SESSION['usuario']['id']);

	if(!count($itens))
		header('Location: '.$_SERVER['HTTP_REFERER']);

		$enderecos = $controllerEnderecos->readEnderecos($_SESSION['usuario']['id']);
	$ehtml = new Ehtml();
?>
<body>
	<?php
		echo "<header>";
			echo $ehtml->navBar('Carrinho');
		echo "</header>";
		
		echo "<main>";
			echo "<input type='hidden' name='cabecalho[usuario_id]' value='{$_SESSION['usuario']['id']}'>";
			for($i = 0; $i < count($itens); $i++){
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
										<span class='carrinho-header right'>
											R\${$itens[$i]['valor']}
										</span>
									</span>
									<div class='card-content'>
									</div>
									<div class='card-action'>
										<div id='divQuantidade".$i."'>
											<button id='btnMenos' class='waves-effect waves-circle waves-light btn-floating btn-small waves-effect waves-light indigo'>
												<i class='material-icons left'>remove</i>
											</button>
											<span id='qtd".$i."'>{$itens[$i]['quantidade']}</span>
											<button id='btnMais' class='waves-effect waves-circle waves-light btn-floating btn-small waves-effect waves-light indigo'>
												<i class='material-icons left'>add</i>
											</button>
											<button id='btnExcluir' class='right waves-effect waves-circle waves-light btn-floating btn-small waves-effect waves-light red'>
												<i class='material-icons left'>clear</i>
											</button>
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
							<input name='cabecalho[endereco_id]' value='{$endereco['id']}' type='radio'/>
							<span>{$endereco['destinatario']}</span>
							<span>
								{$endereco['logradouro']}, 
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
				<button class='right btn-floating btn-large indigo' name='metodo' type='submit' value='create'>
					<i class='large material-icons'>check</i>
				</button>";
		echo "</main>";

		echo $ehtml->footer();
	?>

  	<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="../../materialize/js/materialize.min.js"></script>
	<script src="..\..\assets\js\main.js" crossorigin="anonymous"></script>
	<script src="..\..\assets\js\carrinho.js" crossorigin="anonymous"></script>
  </body>
</html>