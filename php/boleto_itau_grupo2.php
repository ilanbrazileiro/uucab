<?php



//------------------------------------------------------------------------
$sql = mysql_query("SELECT * FROM config")or die (mysql_error());
$linha = mysql_fetch_array($sql);

$logo = $linha['logo'];

$banco = mysql_query("SELECT * FROM bancos WHERE id_banco='5'")or die (mysql_error());
$li = mysql_fetch_array($banco);

$id_vendas = $id_res;

////////////////////////////////////////////////////////////////////////////////

$compra = mysql_query("SELECT *,date_format(data_venci, '%d/%m/%Y') AS datad, date_format(data, '%d/%m/%Y') AS data FROM faturas WHERE id_venda IN('$id_vendas')")or die (mysql_error());
while($valor = mysql_fetch_array($compra)){
$id_venda = $valor['id_venda'];
$valor_doc = $valor['valor'];
$idcliente = $valor['id_cliente'];
$dat_novo_venc = date("d/m/Y");
$juros = $linha['juro'];
$multa = $linha['multa_atrazo'];


// DADOS DO BOLETO PARA O SEU CLIENTE
$dias_de_prazo_para_pagamento = $linha['receber'];
$vencimento = data2banco($valor['datad']);
$data_atual = date("Y-m-d");
if($vencimento < $data_atual){
$data_venc = date("d/m/Y");
}else{
$data_venc = $valor['datad'];
}
$valor_cobrado = $valor_doc; // Valor - REGRA: Sem pontos na milhar e tanto faz com "." ou "," ou com 1 ou 2 ou sem casa decimal
$valor_cobrado = str_replace(",", ".",$valor_cobrado);
$valor_boleto = number_format($valor_cobrado, 2, ',', '');

$dadosboleto["nosso_numero"] = $id_venda;  // Nosso numero - REGRA: Máximo de 8 caracteres!
$dadosboleto["numero_documento"] = $dadosboleto["nosso_numero"];	// Num do pedido ou nosso numero
$dadosboleto["data_vencimento"] = $data_venc; // Data de Vencimento do Boleto - REGRA: Formato DD/MM/AAAA
$dadosboleto["data_documento"] = $valor['data']; // Data de emissão do Boleto
$dadosboleto["data_processamento"] = date("d/m/Y"); // Data de processamento do boleto (opcional)
$dadosboleto["valor_boleto"] = $valor_boleto; 	// Valor do Boleto - REGRA: Com vírgula e sempre com duas casas depois da virgula

// DADOS DO SEU CLIENTE
$cli = mysql_query("SELECT * FROM cliente WHERE id_cliente='$idcliente'")or die (mysql_error());
$cliente = mysql_fetch_array($cli);
$Cnome = $cliente['nome'];
$rg = $cliente['rg'];
$endereco = $cliente['endereco'];
$numero = $cliente['numero'];
$bairro = $cliente['bairro'];
$cidade = $cliente['cidade'];
$estado = $cliente['uf'];
$cep = $cliente['cep'];
$cpfcnpj = $cliente['cpfcnpj'];
$Ccomplemento = $cliente['complemento'];
$Cmatricula = $cliente['matricula'];

$dadosboleto["sacado"] = "$Cmatricula - $Cnome - $cpfcnpj";
$dadosboleto["endereco1"] = "$endereco, Nº $numero, $Ccomplemento - $bairro";
$dadosboleto["endereco2"] = "$cidade - $estado - CEP: $cep";

// INFORMACOES PARA O CLIENTE
$dadosboleto["demonstrativo1"] = $valor['ref'];
$dadosboleto["demonstrativo2"] = $linha['demo1'];
$dadosboleto["demonstrativo3"] = $linha['demo2'];
$dadosboleto["instrucoes1"] = $linha['demo1'];
$dadosboleto["instrucoes2"] = $linha['demo2'];
$dadosboleto["instrucoes3"] = $linha['demo3'];
$dadosboleto["instrucoes4"] = $linha['demo4'];

// DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
$dadosboleto["quantidade"] = "001";
$dadosboleto["valor_unitario"] = $valor_boleto;
$dadosboleto["aceite"] = "SEM";		
$dadosboleto["uso_banco"] = ""; 	
$dadosboleto["especie"] = "R$";
$dadosboleto["especie_doc"] = "DM";


// ---------------------- DADOS FIXOS DE CONFIGURAÇÃO DO SEU BOLETO --------------- //


// DADOS DA SUA CONTA - ITAÚ
$dadosboleto["agencia"] = $li['agencia']; // Num da agencia, sem digito
$dadosboleto["conta"] = $li['conta']; 	// Num da conta, sem digito
$dadosboleto["conta_dv"] = $li['digito_co']; 	// Digito do Num da conta

// DADOS PERSONALIZADOS - ITAÚ
$dadosboleto["carteira"] = $li['carteira'];  // Código da Carteira

// SEUS DADOS
$dadosboleto["identificacao"] = $linha['nome'];
$dadosboleto["cpf_cnpj"] = $linha['cpf'];
$dadosboleto["endereco"] = $linha['endereco'];
$dadosboleto["cidade_uf"] = $linha['cidade'].' - '. $linha['uf'];
$dadosboleto["cedente"] = $linha['nome'].'.';
$dadosboleto["cpf_cnpj"] = $linha['cpf'];

$id[] = $valor['id_venda'];

}

// NÃO ALTERAR!

$nosso = @implode('',$id);
if(!empty($nosso)){
foreach($id as $nm){
$nnum = formata_numero($nm,8,0);
$nossonumero = $carteira.'/'.$nnum.'-'.modulo_10($agencia.$conta.$carteira.$nnum).' ' ;
$numero = explode("/",$nossonumero);
$d = explode("-",$numero[1]);
$res = $d[0].$d[1];
$banco = "ITAU";
$upasd = mysql_query("UPDATE faturas SET nosso_remessa ='$res', banco ='$banco' WHERE id_venda = '$nm' ") or die(mysql_error());
}
}
?>
