<?php
	class Conexao {
		const serverName = 'localhost';
		const userName = 'root';
		const senha = '';
		const dbName = 'gole'; 

		function conectar() {
			try {
				$conexao = mysqli_connect($this::serverName, $this::userName, $this::senha, $this::dbName);
				return $conexao;
			} catch(Exception $e) {
				return false;
			}
		}

		function desconectar() {

		}
	}
