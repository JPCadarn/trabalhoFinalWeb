<?php
	$parametros = [];
	
	$parametros['nCdEmpresa'] = '';
	$parametros['sDsSenha'] = '';
	$parametros['sCepOrigem'] = '98460000';
	$parametros['sCepDestino'] = '89803660';
	$parametros['nVlPeso'] = '1.5';
	$parametros['nCdFormato'] = '1';
	$parametros['nVlComprimento'] = '20';
	$parametros['nVlAltura'] = '10';
	$parametros['nVlLargura'] = '25';
	$parametros['nVlDiametro'] = '0';
	$parametros['sCdMaoPropria'] = 'n';
	$parametros['nVlValorDeclarado'] = '0';
	$parametros['sCdAvisoRecebimento'] = 'n';
	$parametros['StrRetorno'] = 'xml';
	
/*
	40010	 SEDEX
	41106	 PAC
*/
	$parametros['nCdServico'] = '41106';
	
	
	$parametros = http_build_query($parametros);
	$url = 'http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx';
	$curl = curl_init($url.'?'.$parametros);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$dados = curl_exec($curl);
	$dados = simplexml_load_string($dados);
	$retorno = $dados->cServico;
	if(!$retorno->Erro){
		echo $retorno->MsgErro;
	}else{
		echo json_encode($retorno);
	}
?>