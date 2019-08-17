<?php



$codigobanco = "001";
$codigo_banco_com_dv = geraCodigoBanco($codigobanco);
$nummoeda = "9";
$fator_vencimento = fator_vencimento($dadosboleto["data_vencimento"]);

//valor tem 10 digitos, sem virgula
$valor = formata_numero($dadosboleto["valor_boleto"],10,0,"valor");
//agencia � sempre 4 digitos
$agencia = formata_numero($dadosboleto["agencia"],4,0);
//conta � sempre 8 digitos
$conta = formata_numero($dadosboleto["conta"],8,0);
//carteira 18
$carteira = $dadosboleto["carteira"];
//agencia e conta
$agencia_codigo = $agencia."-". modulo_11($agencia) ." / ". $conta ."-". modulo_11($conta);
//Zeros: usado quando convenio de 7 digitos
$livre_zeros='000000';

// Carteira 18 com Conv�nio de 8 d�gitos
if ($dadosboleto["formatacao_convenio"] == "8") {
	$convenio = formata_numero($dadosboleto["convenio"],8,0,"convenio");
	// Nosso n�mero de at� 9 d�gitos
	$nossonumero = formata_numero($dadosboleto["nosso_numero"],9,0);
	$dv=modulo_11("$codigobanco$nummoeda$fator_vencimento$valor$livre_zeros$convenio$nossonumero$carteira");
	$linha="$codigobanco$nummoeda$dv$fator_vencimento$valor$livre_zeros$convenio$nossonumero$carteira";
	//montando o nosso numero que aparecer� no boleto
	$nossonumero = $convenio . $nossonumero ."-". modulo_11("$convenio$nossonumero");
}

// Carteira 18 com Conv�nio de 7 d�gitos
if ($dadosboleto["formatacao_convenio"] == "7") {
	$convenio = formata_numero($dadosboleto["convenio"],7,0,"convenio");
	// Nosso n�mero de at� 10 d�gitos
	$nossonumero = formata_numero($dadosboleto["nosso_numero"],10,0);
	$dv=modulo_11("$codigobanco$nummoeda$fator_vencimento$valor$livre_zeros$convenio$nossonumero$carteira");
	$linha="$codigobanco$nummoeda$dv$fator_vencimento$valor$livre_zeros$convenio$nossonumero$carteira";
	//montando o nosso numero que aparecer� no boleto
	$nossonumero = $convenio.$nossonumero;
}

// Carteira 18 com Conv�nio de 6 d�gitos
if ($dadosboleto["formatacao_convenio"] == "6") {
	$convenio = formata_numero($dadosboleto["convenio"],6,0,"convenio");
	
	if ($dadosboleto["formatacao_nosso_numero"] == "1") {
		
		// Nosso n�mero de at� 5 d�gitos
		$nossonumero = formata_numero($dadosboleto["nosso_numero"],5,0);
		$dv = modulo_11("$codigobanco$nummoeda$fator_vencimento$valor$convenio$nossonumero$agencia$conta$carteira");
		$linha = "$codigobanco$nummoeda$dv$fator_vencimento$valor$convenio$nossonumero$agencia$conta$carteira";
		//montando o nosso numero que aparecer� no boleto
		$nossonumero = $convenio . $nossonumero ."-". modulo_11("$convenio$nossonumero");
	}
	
	if ($dadosboleto["formatacao_nosso_numero"] == "2") {
		
		// Nosso n�mero de at� 17 d�gitos
		$nservico = "21";
		$nossonumero = formata_numero($dadosboleto["nosso_numero"],17,0);
		$dv = modulo_11("$codigobanco$nummoeda$fator_vencimento$valor$convenio$nossonumero$nservico");
		$linha = "$codigobanco$nummoeda$dv$fator_vencimento$valor$convenio$nossonumero$nservico";
	}
}

$dadosboleto["codigo_barras"] = $linha;
$dadosboleto["linha_digitavel"] = monta_linha_digitavel($linha);
$dadosboleto["agencia_codigo"] = $agencia_codigo;
$dadosboleto["nosso_numero"] = $nossonumero;
$dadosboleto["codigo_banco_com_dv"] = $codigo_banco_com_dv;


// FUN��ES
// Algumas foram retiradas do Projeto PhpBoleto e modificadas para atender as particularidades de cada banco



?>
