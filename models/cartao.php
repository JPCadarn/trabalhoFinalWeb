<?php

require_once(dirname(__FILE__).'/../controllers/conexao.php');

class CartaoModel extends Conexao{
	function salvar($dados){
		if(array_key_exists('id', $dados))
			return $this->editar($dados);
		else
			return $this->criar($dados);
	}

	function excluir($id){
		$sql = 'DELETE FROM cartaos WHERE id = '.$id;
		$excluido = $this->executarQuery($sql);

		return $excluido;
	}

	function getCartaos($usuarioId){
		$sql = "SELECT * FROM cartaos WHERE usuario_id = $usuarioId";

		return $this->executarQuery($sql);
	}

	function getDados($id){
		$sql = 'SELECT * FROM cartaos';

		if($id)
			$sql .= ' WHERE id = '.$id;

		return $this->executarQuery($sql);
	}

	function criar($dados){
		$dados['dados']['codigo_seguranca'] = password_hash($dados['dados']['codigo_seguranca'], PASSWORD_BCRYPT);
		$ultimosQuatro = substr($dados['dados']['numero'], -4);
		$dados['dados']['numero'] = password_hash($dados['dados']['numero'], PASSWORD_BCRYPT);

		$sql = "
			INSERT INTO cartaos
			(usuario_id, ultimos_quatro, codigo_seguranca, numero, validade, debito_credito, nome_impresso)
			VALUES 
			(
				{$dados['dados']['usuario_id']},
				{$ultimosQuatro},
				'{$dados['dados']['codigo_seguranca']}',
				'{$dados['dados']['numero']}',
				'{$dados['dados']['validade']}',
				'{$dados['dados']['debito_credito']}',
				'{$dados['dados']['nome_impresso']}'
			)
		";
		
		return $this->executarQuery($sql);
	}

	function editar($dados){
		$sql = "
			UPDATE cartaos
			SET codigo_seguranca = '{$dados['dados']['codigo_seguranca']}', 
				usuario_id = '{$dados['dados']['usuario_id']}',
				numero = '{$dados['dados']['numero']}',
				validade = '{$dados['dados']['validade']}',
				debito_credito = '{$dados['dados']['debito_credito']}'
				nome_impresso = '{$dados['dados']['nome_impresso']}'
			WHERE id = {$dados['id']}
		";
		
		return $this->executarQuery($sql);
	}
}
