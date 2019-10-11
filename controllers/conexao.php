<?php
	class Conexao{
		const serverName = 'localhost';
		const userName = 'root';
		const senha = '';
		const dbName = 'gole'; 

		function conectar(){
			try{
				$conexao = new mysqli($this::serverName, $this::userName, $this::senha, $this::dbName);
				return $conexao;
			} catch(Exception $e){
				return false;
			}
		}

		function desconectar($conexao){
			$conexao->close();
		}

		function executarQuery($query, $conexao){
			$retorno = [];
			$retorno = $conexao->query($query);
			$retorno = $retorno->fetch_all(MYSQLI_ASSOC);

			return $retorno;
		}
	}
