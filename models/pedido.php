<?php

require_once('conexao.php');
date_default_timezone_set("America/Sao_Paulo");

class PedidoModel extends Conexao{
	function salvar($dados){
		if(array_key_exists('id', $dados))
			return $this->editar($dados);
		else
			return $this->criar($dados);
	}

	function excluir($id){
		$sql = 'DELETE FROM pedidos WHERE id = '.$id;
		$excluido = $this->executarQuery($sql);

		return $excluido;
	}

	function getDados($id){
		$sql = 'SELECT * FROM pedidos';

		if($id)
			$sql .= ' WHERE id = '.$id;

		return $this->executarQuery($sql);
	}

	function salvarCabecalhoPedido($cabecalho){
		$data = date('d/m/Y');
		$hora = date('H:i:s');
		$sql = "
			INSERT INTO pedidos
			(usuario_id, data, hora)
			VALUES 
			(
				{$cabecalho['usuario_id']}, 
				'{$data}',
				'{$hora}'
			)
		";
		
		return $this->executarQuery($sql);
	}

	function salvarItensPedido($id, $itens){
		$sql = "
			INSERT INTO pedidos_itens
			(pedido_id, produto_id, quantidade)
			VALUES 
			(
				{$id}, 
				{$itens['produto_id']},
				{$itens['quantidade']}
			)
		";

		return $this->executarQuery($sql);
	}

	function criar($dados){
		if(array_key_exists('itens', $dados) AND array_key_exists('cabecalho', $dados)){
			if(salvarCabecalhoPedido($dados['cabecalho'] AND salvarItensPedido($dados['cabecalho']['id'], $dados['itens']))){
				return true;
			}
		}else
			return false;
	}

	function editar($dados){
		$sql = "
			UPDATE pedidos
			SET produto_id = '{$dados['dados']['produto_id']}', 
				usuario_id = {$dados['dados']['usuario_id']},
				texto = '{$dados['dados']['texto']}'
			WHERE id = {$dados['id']}
		";
		
		return $this->executarQuery($sql);
	}
}
