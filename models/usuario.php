<?php

require_once(dirname(__FILE__).'/../controllers/conexao.php');
require_once(dirname(__FILE__).'/../assets/phpmailer/class.phpmailer.php');


class UsuarioModel extends Conexao{
	function salvar($dados){
		if(array_key_exists('id', $dados))
			return $this->editar($dados);
		elseif(isset($dados['dados']['admin']))
			return $this->criarAdmin($dados);
		else
			return $this->criar($dados);
	}

	function excluir($id){
		$sql = 'DELETE FROM usuarios WHERE id = '.$id;
		$excluido = $this->executarQuery($sql);

		return $excluido;
	}

	function getAcessos($usuarioId = null){
		$sql = "SELECT ua.*, u.email
				FROM usuarios_acessos ua
				JOIN usuarios u ON ua.usuario_id = u.id ";

		if($usuarioId)
			$sql .= " WHERE usuario_id = $usuarioId";
			
		return $this->executarQuery($sql);
	}

	function getCount(){
		$sql = "
			SELECT COUNT(*) AS count
			FROM usuarios
			WHERE email <> 'ADMIN'
		";

		return $this->executarQuery($sql);
	}

	function getDados($id){
		$sql = 'SELECT * FROM usuarios';

		if($id)
			$sql .= ' WHERE id = '.$id;

		return $this->executarQuery($sql);
	}

	function criar($dados){
		$dados['dados']['senha'] = password_hash($dados['dados']['senha'], PASSWORD_BCRYPT);
		
		$sql = "
			INSERT INTO usuarios
			(email, senha, nome, cpf, data_nascimento)
			VALUES 
			(
				'{$dados['dados']['email']}', 
				'{$dados['dados']['senha']}',
				'{$dados['dados']['nome']}',
				'{$dados['dados']['cpf']}',
				'{$dados['dados']['data_nascimento']}'
			)
		";
		
		$retornoQuery = $this->executarQuery($sql);
		if($retornoQuery)
			$this->emailBoasVindas($dados['dados']['email'], $dados['dados']['nome']);

		return $retornoQuery;
	}

	function emailBoasVindas($email, $nome){
		global $error;
		$mail = new PHPMailer();
		$mail->CharSet = 'UTF-8';
		$mail->IsSMTP();
		$mail->SMTPDebug = 0;
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = 'tls';
		$mail->Host = 'smtp.gmail.com';
		$mail->Port = 587;
		$mail->Username = 'golebebidaschapeco@gmail.com';
		$mail->Password = 'mariotti281';
		$mail->SetFrom('golebebidaschapeco@gmail.com', 'Gole Bebidas Chapecó');
		$mail->Subject = 'Boas Vindas';
		$mail->Body = 'Olá, '.$nome.PHP_EOL.
					  'Seja bem vindo(a) à Gole Bebidas.'.PHP_EOL.
					  'Esperamos que você possa encontrar em nosso site tudo o que procura quando o assunto é bebidas.';
		$mail->AddAddress($email);
		if(!$mail->Send()) {
			$error = 'Mail error: '.$mail->ErrorInfo; 
		} else {
			$error = 'Mensagem enviada!';
		}
	}

	function emailNovaSenha($email, $nome, $senha){
		global $error;
		$mail = new PHPMailer();
		$mail->CharSet = 'UTF-8';
		$mail->IsSMTP();
		$mail->SMTPDebug = 0;
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = 'tls';
		$mail->Host = 'smtp.gmail.com';
		$mail->Port = 587;
		$mail->Username = 'golebebidaschapeco@gmail.com';
		$mail->Password = 'mariotti281';
		$mail->SetFrom('golebebidaschapeco@gmail.com', 'Gole Bebidas Chapecó');
		$mail->Subject = 'Nova Senha';
		$mail->Body = 'Olá, '.$nome.PHP_EOL.
					  'Conforme solicitado, sua nova senha é:'.PHP_EOL.
					  $senha;
		$mail->AddAddress($email);
		if(!$mail->Send()) {
			$error = 'Mail error: '.$mail->ErrorInfo; 
		} else {
			$error = 'Mensagem enviada!';
		}
	}

	function esqueceuSenha($email){
		$sqlUsuario = "SELECT id, email, nome FROM usuarios WHERE email = '{$email['email']}'";
		$dadosUsuario = $this->executarQuery($sqlUsuario);

		if($dadosUsuario){
			$novaSenha = $this->updateSenha($dadosUsuario[0]['id']);
			if($novaSenha){
				$this->emailNovaSenha($dadosUsuario[0]['email'], $dadosUsuario[0]['nome'], $novaSenha);
				return true;
			}else
				return 4;
		}else
			return 2;
	}

	function updateSenha($id){
		$novaSenha = '';
		$caracteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		for($i = 0; $i < 8; $i++){
			$random[] = $caracteres[rand(0, strlen($caracteres))];
			$novaSenha = implode($random);
		}
		$novaSenhaCripto = password_hash($novaSenha, PASSWORD_BCRYPT);
		$sql = "UPDATE usuarios SET senha = '$novaSenhaCripto' WHERE id = $id";

		if($this->executarQuery($sql))
			return $novaSenha;
		else
			return false;
	}

	function criarAdmin($dados){
		$dados['dados']['senha'] = password_hash($dados['dados']['senha'], PASSWORD_BCRYPT);
		
		$sql = "
			INSERT INTO usuarios
			(email, senha, nome, cpf, data_nascimento, admin)
			VALUES 
			(
				'{$dados['dados']['email']}', 
				'{$dados['dados']['senha']}',
				'{$dados['dados']['nome']}',
				'{$dados['dados']['cpf']}',
				'{$dados['dados']['data_nascimento']}',
				{$dados['dados']['admin']}
			)
		";
		
		return $this->executarQuery($sql);
	}

	function editar($dados){
		$dados['dados']['senha'] = password_hash($dados['dados']['senha'], PASSWORD_BCRYPT);

		$sql = "
			UPDATE usuarios
			SET senha = '{$dados['dados']['senha']}', 
				email = '{$dados['dados']['email']}',
				nome = '{$dados['dados']['nome']}',
				cpf = '{$dados['dados']['cpf']}',
				data_nascimento = '{$dados['dados']['data_nascimento']}'
			WHERE id = {$dados['id']}
		";
		
		return $this->executarQuery($sql);
	}

	function logAcesso($id){
		$hora = date('H:i:s');
		$data = date('Y-m-d');		
		$sql = "
			INSERT INTO usuarios_acessos
			(usuario_id, data, hora)
			VALUES
			($id, '$data', '$hora')
		";

		return $this->executarQuery($sql);
	}

	function validarSenha($dados){
		$sqlSenhaAtual = "
			SELECT senha
			FROM usuarios
			WHERE id = {$dados['id']}
		";
		$senhaAtual = $this->executarQuery($sqlSenhaAtual)[0]['senha'];

		if(password_verify($dados['senhaAntiga'], $senhaAtual))
			return true;
		else
			return false;
	}

	function validarEmail($dados){
		$sql = "SELECT id FROM usuarios WHERE email = '{$dados['email']}'";
		$emailValido = $this->executarQuery($sql);
		
		return !empty($emailValido);
	}

	function login($dados){
		if(session_status() <> PHP_SESSION_ACTIVE)
			session_start();
			
		$dadosUsuarioBD = $this->executarQuery("SELECT id, senha FROM usuarios WHERE email = '{$dados['email']}'")[0];
		$passou = password_verify($dados['senha'], $dadosUsuarioBD['senha']);

		if(!$dadosUsuarioBD)
			return 2;

		if($passou){
			$this->logAcesso($dadosUsuarioBD['id']);
			$_SESSION['usuario'] = $this->getDados($dadosUsuarioBD['id'])[0];
			return true;
		}else
			return 3;
	}

	function logout(){
		if(session_status() <> PHP_SESSION_ACTIVE)
			session_start();
		return session_unset();
	}
}
