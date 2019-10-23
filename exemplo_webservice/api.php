<?php
	header('Access-Control-Allow-Origin: *');

	function conectar(){

		$mysql = mysqli_connect("127.0.0.1", "root", "", "gole");
		return $mysql;
	}
	function mostrar_usuario($valor){
		$mysql = conectar();
		$query = $mysql->query("select * from usuarios where id = $valor");
		$data = array();
		$i = 0;
		while($row = $query->fetch_assoc()){
			$data[$i] = $row;
			$i++;
		}
		$mysql->close();
		return json_encode($data);
	}
	function mostrar(){
		$mysql = conectar();
		$query = $mysql->query("select * from usuarios");
		$data = array();
		$i = 0;
		while($row = $query->fetch_assoc()){
			$data[$i] = $row;
			$i++;
		}

		$mysql->close();
		return json_encode($data);
	}
	if(isset($_POST["metodo"])){
		$metodo = $_POST["metodo"];
		if($metodo == "select")
			echo mostrar();
		if($metodo == "mostrar")
			echo mostrar_usuario($_POST["valor"]);
	}

	
?>