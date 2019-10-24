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
	require_once('../../controllers/categorias.php');
	require_once('../utils/ehtml.php');
	$controllerCategorias = new CategoriasController();
	$categoria = $controllerCategorias->read($_GET['id'])[0];
	$produtos = $controllerCategorias->readProdutos($_GET['id']);
	$ehtml = new Ehtml();
?>
<body>
	<?php
		echo "<header>";
			echo $ehtml->navBar('Produtos -> '.$categoria['nome']);
		echo "</header>";
		
		echo "<main>";
			for($i = 0; $i < count($produtos); $i++){
				if($i % 3 == 0){
					$tagRow = "<div class='row'>";
					$tagFechaRow = null;
				}elseif($i % 2 == 2){
					$tagRow = null;
					$tagFechaRow = "</div>";
				}else{
					$tagRow = null;
					$tagFechaRow = null;
				}
				
				$imagem = ($produtos[$i]['imagem']);
				
				echo "
				$tagRow
				<div class='col s6 m4'>
				<div class='card hoverable'>
				<div class='card-image'>
				<a href='produto.php?id={$produtos[$i]['id']}'><img src='..\..\assets\images\\".$produtos[$i]['imagem']."'></a>
				</div>
				<div class='card-content center'>
				<span class='card-title black-text'>{$produtos[$i]['nome']}</span>
				<p>R$ {$produtos[$i]['valor']}</p>
				</div>
				</div>
				</div>
				$tagFechaRow
				";
			}
		echo "</main>";

		echo $ehtml->footer();
	?>

  	<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="../../materialize/js/materialize.min.js"></script>
	<script src="..\..\assets\js\main.js" crossorigin="anonymous"></script>
  </body>
</html>