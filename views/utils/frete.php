<?php
	header('Access-Control-Allow-Origin: *');

	$cep = $_POST['cep'];

	$frete = [];

	$valorNormal = rand(0, 89).'.'.rand(0, 99);
	$valorNormal = number_format($valorNormal, 2);
	$prazoNormal = $valorNormal / 3;
	$prazoNormal = intval($prazoNormal);

	$valorExpresso = rand(0, $prazoNormal).'.'.rand(0, 99);
	$valorExpresso = number_format($valorExpresso, 2);
	$prazoExpresso = $valorExpresso / 4.3;
	$prazoExpresso = $prazoExpresso >= 1 ? intval($prazoExpresso) : 1;

	$frete['valorNormal'] = $valorNormal;
	$frete['prazoNormal'] = $prazoNormal;
	$frete['valorExpresso'] = $valorExpresso;
	$frete['prazoExpresso'] = $prazoExpresso;

	echo json_encode($frete);
?>