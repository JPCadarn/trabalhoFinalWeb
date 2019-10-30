<?php

require_once(dirname(__FILE__).'/../controllers/conexao.php');
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

	function getValorPedido($id){
		$sql = "
			SELECT SUM(pi.valor_total) AS valor, pi.pedido_id
			FROM pedidos_itens pi
			WHERE pi.pedido_id = $id
		";

		return $this->executarQuery($sql);
	}

	function getPedidos($usuarioId){
		$sqlPedidos = "
			SELECT p.*, e.cep, e.destinatario, e.rua, e.bairro, e.numero, e.complemento, e.cidade, e.estado, c.numero as cartao
			FROM pedidos p
			LEFT JOIN enderecos e ON e.id = p.endereco_id
			LEFT JOIN cartaos c ON p.cartao_id = c.id
			WHERE p.usuario_id = $usuarioId
		";

		$pedidos = $this->executarQuery($sqlPedidos);
		$retorno = [];	
		
		if(!empty($pedidos)){
			foreach($pedidos as $pedido){
				$sqlItens = "
					SELECT pi.produto_id, pi.pedido_id, pi.quantidade, prod.nome, pi.valor_total
					FROM pedidos_itens pi 
					JOIN produtos prod ON pi.produto_id = prod.id 
					WHERE pi.pedido_id = {$pedido['id']}
				";
				$item = $this->executarQuery($sqlItens);
				if($item[0]['pedido_id'] = $pedido['id']){
					$retorno[$pedido['id']] = $item;
					$retorno[$pedido['id']]['cabecalho']['endereco'] = "{$pedido['rua']}, {$pedido['bairro']}, {$pedido['numero']}-{$pedido['complemento']}, {$pedido['cidade']}, {$pedido['estado']}";
					$retorno[$pedido['id']]['cabecalho']['cartao_id'] = $pedido['cartao_id'];
					$retorno[$pedido['id']]['cabecalho']['cartao'] = $pedido['cartao'];
					$retorno[$pedido['id']]['cabecalho']['pedido_id'] = $pedido['id'];
				}
			}				
		}
		
		return $retorno;
	}

	function getDados($id){
		$sql = 'SELECT * FROM pedidos';

		if($id)
			$sql .= ' WHERE id = '.$id;

		return $this->executarQuery($sql);
	}

	function salvarCabecalhoPedido($cabecalho){
		$data = date('Y-m-d');
		$hora = date('H:i:s');
		$sql = "
			INSERT INTO pedidos
			(usuario_id, endereco_id, data, hora)
			VALUES 
			(
				{$cabecalho['usuario_id']}, 
				{$cabecalho['endereco_id']}, 
				'{$data}',
				'{$hora}'
			)
		";
		
		return $this->executarQuery($sql, ['iniciarTransacao' => true, 'terminarTransacao' => true]);
	}

	function salvarItensPedido($itens){
		$sqlPedidoId = "
			SELECT id
			FROM pedidos
			ORDER BY id DESC
			LIMIT 1
		";
		$pedidoId = $this->executarQuery($sqlPedidoId, ['iniciarTransacao' => false, 'terminarTransacao' => false])[0]['id'];
		$sql = "
			INSERT INTO pedidos_itens
			(pedido_id, produto_id, quantidade, valor_total)
			VALUES
		";
		
		foreach($itens as $item){
			$virgula = $item == end($itens) ? '' : ',';
			$valorItem = $item['produto_id'] * $item['quantidade'];
			$sql .= " 
				(
					{$pedidoId}, 
					{$item['produto_id']},
					{$item['quantidade']},
					{$valorItem}
				)$virgula
			";
		}
		if(!$this->executarQuery($sql)){
			$this->executarQuery("DELETE FROM pedidos WHERE id = {$pedidoId}");
			return false;
		}
		$this->executarQuery("DELETE FROM carrinhos WHERE usuario_id = {$_SESSION['usuario']['id']}");
		
		return true;
	}

	function criar($dados){
		if(array_key_exists('itens', $dados) AND array_key_exists('cabecalho', $dados)){
			if($this->salvarCabecalhoPedido($dados['cabecalho']) AND $this->salvarItensPedido($dados['itens'])){
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
