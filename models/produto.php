<?php

require_once(dirname(__FILE__).'/../controllers/conexao.php');

class ProdutoModel extends Conexao{
	function salvar($dados){
		if(array_key_exists('id', $dados))
			return $this->editar($dados);
		else
			return $this->criar($dados);
	}

	function getCount(){
		$sql = "
			SELECT COUNT(*) as count
			FROM produtos
		";

		return $this->executarQuery($sql);
	}

	function getMaisVendidos(){
		$sql = "
			SELECT produto_id, COUNT(produto_id)
			FROM pedidos_itens
			GROUP BY produto_id
			ORDER BY COUNT(produto_id) DESC
			LIMIT 5
		";

		return $this->executarQuery($sql);
	}

	function getMaisAcessados(){
		$sql = "
			SELECT COUNT(produto_id), produto_id
			FROM produtos_acessos
			GROUP BY produto_id
			ORDER BY COUNT(produto_id)
			LIMIT 5
		";

		return $this->executarQuery($sql);
	}

	function excluir($id){
		$sql = 'DELETE FROM produtos WHERE id = '.$id;
		$excluido = $this->executarQuery($sql);

		return $excluido;
	}

	function getDados($id){
		$sql = '
			SELECT p.*, c.nome AS nome_categoria
			FROM produtos p
			LEFT JOIN categorias c ON c.id = p.categoria_id
		';

		if($id)
			$sql .= ' WHERE p.id = '.$id;

		return $this->executarQuery($sql);
	}

	function criar($dados){
		$imagem = $_FILES['imagem'];
		$imagem['name'] = password_hash($imagem['name'], PASSWORD_BCRYPT);
		$destino = explode('models', dirname(__FILE__))[0].'assets\\images\\'.$imagem['name'];

		if(rename($imagem['tmp_name'], $destino)){
			$teor = floatval($dados['dados']['teor_alcoolico']);
			$sql = "
			INSERT INTO produtos
			(nome, descricao, valor, categoria_id, imagem, teor_alcoolico)
			VALUES 
			(
				'{$dados['dados']['nome']}', 
				'{$dados['dados']['descricao']}', 
				{$dados['dados']['valor']}, 
				{$dados['dados']['categoria_id']}, 
				'{$imagem['name']}', 
				{$teor}
			)";

			return $this->executarQuery($sql);
		}else
			return false;
	}

	function editar($dados){
		$imagem = $_FILES['imagem'];
		$imagem['name'] = password_hash($imagem['name'], PASSWORD_BCRYPT);
		$destino = explode('models', dirname(__FILE__))[0].'assets\\images\\'.$imagem['name'];

		if(rename($imagem['tmp_name'], $destino)){
			$sql = "
				UPDATE produtos
				SET nome = '{$dados['dados']['nome']}', 
					descricao = '{$dados['dados']['descricao']}', 
					valor = {$dados['dados']['valor']}, 
					categoria_id = {$dados['dados']['categoria_id']}, 
					imagem = '{$imagem['name']}', 
					teor_alcoolico = {$dados['dados']['teor_alcoolico']}
				WHERE id = {$dados['id']}
			";

			return $this->executarQuery($sql);
		}else
			return false;

	}
}
