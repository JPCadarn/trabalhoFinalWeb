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
	$produtos = $controller->read();
	$ehtml = new Ehtml();
?>
<body>
	<?php
		echo $ehtml->navBar('Produtos');

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
			
			if(!$produtos[$i]['nome_categoria'])
				$produtos[$i]['nome_categoria'] = 'Não Cadastrado';

			$imagem = ($produtos[$i]['imagem']);

            echo "
                $tagRow
                    <div class='col s4 m4'>
                        <div class='card'>
                            <div class='card-image'>
                                <img src='..\..\assets\images\\".$produtos[$i]['imagem']."'>
							</div>
							<div class='card-content center'>
                                <span class='card-title black-text'>{$produtos[$i]['nome']}</span>
                                <p>{$produtos[$i]['nome_categoria']}</p>
                                <p>R$ {$produtos[$i]['valor']}</p>
                            </div>
                            <div class='card-action center'>
		 						<a class='tooltipped' data-position='bottom' data-tooltip='Editar Produto' href='editar.php?id={$produtos[$i]['id']}'> <i class='material-icons blue-text'>edit</i></a>
		 						<a class='tooltipped' data-position='bottom' data-tooltip='Excluir Produto' href='excluir.php?id={$produtos[$i]['id']}&metodo=delete'> <i class='material-icons blue-text'>delete</i></a>
		 					</div>
                        </div>
                    </div>
                $tagFechaRow
            ";
        }
    ?>

	<div class="fixed-action-btn">
		<a href="add.php" class="btn-floating modal-trigger btn-large indigo darken-4">
			<i class="large material-icons">add</i>
		</a>
	</div>

  	<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="../../materialize/js/materialize.min.js"></script>
	<script src="https://kit.fontawesome.com/70c1a7f591.js" crossorigin="anonymous"></script>
	<script src="..\..\assets\js\main.js" crossorigin="anonymous"></script>
  </body>
</html>