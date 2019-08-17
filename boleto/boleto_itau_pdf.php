<?php

include "../classes/conexao.php";

ini_set("upload_max_filesize", "10M");
ini_set("max_execution_time", "800");
ini_set("memory_limit", "-1");
ini_set("realpath_cache_ttl", "120");

////////////// arredonda valores /////////////////////////////////
function ceil_dec($number,$precision,$separator)
{
    $numberpart=explode($separator,$number); 
	@$numberpart[1]=substr_replace($numberpart[1],$separator,$precision,0);
    if($numberpart[0]>=0)
    {$numberpart[1]=ceil($numberpart[1]);}
    else
    {$numberpart[1]=floor($numberpart[1]);}
    $ceil_number= array($numberpart[0],$numberpart[1]);
    return implode($separator,$ceil_number);
}

/////////////////////// conferir datas //////////////
function data2banco ($d2b) { 
	if(!empty($d2b)){
		$d2b_ano=substr($d2b,6,4);
		$d2b_mes=substr($d2b,3,2);
		$d2b_dia=substr($d2b,0,2);		
		$d2b="$d2b_ano-$d2b_mes-$d2b_dia";
	}
	return $d2b; 
}

function geraTimestamp($data) {
$partes = explode('/', $data);
return mktime(0, 0, 0, $partes[1], $partes[0], $partes[2]);
}

		//--------------------------------DADOS DE CONFIGURAÇÃO PADRÃO DO BOLETO----------------------

		$sql = mysql_query("SELECT * FROM config") or die (mysql_error());
		$linha = mysql_fetch_array($sql);

		$logo = $linha['logo'];
		$juros = $linha['juro'];
		$multa = $linha['multa_atrazo'];

		$dadosboleto["demonstrativo2"] = $linha['demo1'];
		$dadosboleto["demonstrativo3"] = $linha['demo2'];
		$dadosboleto["instrucoes1"] = $linha['demo1'];
		$dadosboleto["instrucoes2"] = $linha['demo2'];
		$dadosboleto["instrucoes3"] = $linha['demo3'];
		$dadosboleto["instrucoes4"] = $linha['demo4'];
		$dadosboleto["instrucoes5"] = $linha['demo5'];
		$dadosboleto["texto_boleto1"] = $linha['texto_boleto1'];

		// SEUS DADOS

		$dadosboleto["identificacao"] = $linha['nome'];
		$dadosboleto["cpf_cnpj"] = $linha['cpf'];
		$dadosboleto["endereco"] = $linha['endereco'];
		$dadosboleto["cidade_uf"] = $linha['bairro'].' - '.$linha['cidade'].' - '. $linha['uf'];
		$dadosboleto["cedente"] = $linha['nome'].'.';
		$dadosboleto["cpf_cnpj"] = $linha['cpf'];

		$str = $_SERVER['QUERY_STRING'];

		$string = base64_decode($str);
		$array = explode('&', $string);

		foreach($array as $valores){

			$valores;
			$arrays = explode('=', $valores);
				foreach($arrays as $val){
				$dado[] = $val;
				}
		}

////////////////////////INICIO DA GERAÇÃO DO BOLETO

if(isset($_GET['id_venda'])){

		$id_venda = $_GET['id_venda'];// PEGA O ID PARA GERAR O BOLETO

			require_once('../pg/pdf/mpdf.php');
			$mpdf = new mPDF('utf-8','A4');

		$compra = mysql_query("SELECT *,date_format(data_venci, '%d/%m/%Y') AS datad, date_format(data, '%d/%m/%Y') AS data FROM faturas WHERE id_venda='$id_venda' AND situacao !='B'") or die (mysql_error());//BUSCA OS DADOS DO BOLETOS A SEREM GERADOS

		$valor = mysql_fetch_array($compra);
		$contar = mysql_num_rows($compra);
		$valor_doc = $valor['valor'];
		$idcliente = $valor['id_cliente'];
		$dat_novo_venc = date("d/m/Y");
		$id_banco = $valor['id_banco'];

		if($contar != 1){
			echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=erro.php'>";
			exit;	
		}

		////////////////////////// CALCULA DIAS DE VENCIDO /////////////////////

		$data_inicial = $valor['datad'];;
		$data_final = date("d/m/Y");
		$time_inicial = geraTimestamp($data_inicial);
		$time_final = geraTimestamp($data_final);
		$diferenca = $time_final - $time_inicial; 
		$dias = (int)floor( $diferenca / (60 * 60 * 24));

		//------------- SE O VALOR FOR NEGATIVO COLOCA ZERO NA DIVERENCA ------------------------
		if($dias <= 0){	$dias = 0;	}

		////////////////////////////////////CALCULA JUROS //////////////////////////////////////////
		if($dias <= 0){	
			$multa = 0;	
		} 
			$valormulta = ($valor_doc * $multa / 100 );
			$valordojuro = ($dias*($valor_doc * $juros / 100));

		$valor_boleto = @ceil_dec($valor_doc + $valordojuro + $valormulta,2,'.');



		// DADOS DO BOLETO PARA O SEU CLIENTE

		$dias_de_prazo_para_pagamento = $linha['receber'];
		$vencimento = data2banco($valor['datad']);
		$data_atual = date("Y-m-d");

		if($vencimento < $data_atual){
			$data_venc = date("d/m/Y");
		} else {
			$data_venc = $valor['datad'];
		}

		$valor_cobrado = $valor_boleto; // Valor - REGRA: Sem pontos na milhar e tanto faz com "." ou "," ou com 1 ou 2 ou sem casa decimal
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

		if ($cliente['responsavel'] == 'CPF'){
			$nome_resp = $cliente['dir_culto'];
			$cpfcnpj = $cliente['cpfcnpj'];

		} else if($cliente['responsavel'] == 'CNPJ'){
			$nome_resp = $cliente['centro'];
			$cpfcnpj = $cliente['cnpj'];

		} else {
			print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=?pg=listaclientes'>
				<script type=\"text/javascript\">
					alert(\"Boleto sem um Responsável Financeiro! Por favor atualize o cadastro. \");
				</script>";
		}

		$Cnome = $cliente['dir_culto'];
		$endereco = $cliente['endereco'];
		$numero = $cliente['numero'];
		$bairro = $cliente['bairro'];
		$cidade = $cliente['cidade'];
		$estado = $cliente['uf'];
		$cep = $cliente['cep'];
		$Ccomplemento = $cliente['complemento'];
		$Cmatricula = $cliente['matricula'];
		$dadosboleto["sacado"] = "$Cmatricula - $nome_resp - $cpfcnpj";
		$dadosboleto["sacado"] .= "<br>Diretor(a) Espiritual - $Cnome";
		$dadosboleto["dest"] = "$Cmatricula - $Cnome";

		if (!empty($numero)){
			$dadosboleto["endereco1"] = "$endereco, Nº $numero $Ccomplemento";
		} else {
			$dadosboleto["endereco1"] = "$endereco, S/N $Ccomplemento";
		}
		$dadosboleto["endereco2"] = "$bairro - $cidade - $estado - CEP: $cep";

		// INFORMACOES PARA O CLIENTE
		$dadosboleto["demonstrativo1"] = $valor['ref'];

		// DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
		$dadosboleto["quantidade"] = "001";
		$dadosboleto["valor_unitario"] = $valor_boleto;
		$dadosboleto["aceite"] = "SEM";		
		$dadosboleto["uso_banco"] = ""; 	
		$dadosboleto["especie"] = "R$";
		$dadosboleto["especie_doc"] = "DM";

		$banco = mysql_query("SELECT * FROM bancos WHERE id_banco = '$id_banco'")or die (mysql_error());
		$li = mysql_fetch_array($banco);

		$dadosboleto["agencia"] = $li['agencia']; // Num da agencia, sem digito
		$dadosboleto["conta"] = $li['conta']; 	// Num da conta, sem digito
		$dadosboleto["conta_dv"] = $li['digito_co']; 	// Digito do Num da conta
		$dadosboleto["carteira"] = $li['carteira'];  // Código da Carteira

		ob_start(); 

		include_once("include/funcoes_itau.php");
		include('include/layout_itau.php');

		$html .= ob_get_clean(); 

		$css = file_get_contents('include/lote_boleto_pedf.css');
		$mpdf->WriteHTML($css,1);
		$mpdf->WriteHTML($html);

		$mpdf->Output('BoletoUUCAB.pdf','D');//I - Inline / D - Forçar Download

		$numero = explode("/",$dadosboleto["nosso_numero"]);
		$d = explode("-",$numero[1]);
		$res = $d[0];
		$banco = "ITAU";
		$up = mysql_query("UPDATE faturas SET nosso_numero ='$res', banco ='$banco' WHERE id_venda='$id_venda'") or die(mysql_error());

/////////////////////////////Para impressão em lote//////////////////			
} else if (isset($_POST['ids'])){

	

	include_once("include/funcoes_itau.php");

	

	require_once('../pg/pdf/mpdf.php');

	$mpdf = new mPDF('utf-8','A4');

	

	foreach($_POST['ids'] as $key => $id_fatura){	

		$id_venda = isset($_POST['ids'][$key])? $_POST['ids'][$key] :null;



		$compra = mysql_query("SELECT *,date_format(data_venci, '%d/%m/%Y') AS datad, date_format(data, '%d/%m/%Y') AS data FROM faturas WHERE id_venda='$id_venda' AND situacao !='B'")or die (mysql_error());

		$valor = mysql_fetch_array($compra);



		$contar = mysql_num_rows($compra);

		$valor_doc = $valor['valor'];

		$idcliente = $valor['id_cliente'];

		$dat_novo_venc = date("d/m/Y");

		$id_banco = $valor['id_banco'];



		$banco = mysql_query("SELECT * FROM bancos WHERE id_banco = '$id_banco'")or die (mysql_error());

		$li = mysql_fetch_array($banco);

		

		$dadosboleto["agencia"] = $li['agencia']; // Num da agencia, sem digito

		$dadosboleto["conta"] = $li['conta']; 	// Num da conta, sem digito

		$dadosboleto["conta_dv"] = $li['digito_co']; 	// Digito do Num da conta

		

		$dadosboleto["carteira"] = $li['carteira'];  // Código da Carteira



		

		if($contar != 1){

			echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=erro.php'>";

			exit;	

		}

		

		////////////////////////// CALCULA DIAS DE VENCIDO /////////////////////

		$data_inicial = $valor['datad'];;

		$data_final = date("d/m/Y");

		$time_inicial = geraTimestamp($data_inicial);

		$time_final = geraTimestamp($data_final);

		$diferenca = $time_final - $time_inicial; 

		$dias = (int)floor( $diferenca / (60 * 60 * 24));

		//------------- SE O VALOR FOR NEGATIVO COLOCA ZERO NA DIVERENCA ------------------------

		if($dias <= 0){	$dias = 0;	}

		

		////////////////////////////////////CALCULA JUROS //////////////////////////////////////////

		$jurost = ($juros * $dias);

		$valordojuro = ($valor_doc * $jurost / 100); 

		$valorcomjuros = ($valor_doc + $valordojuro);

		if($dias <= 0){	$multa = 0;	}

		$valormulta = ($valorcomjuros * $multa / 100 );

		$valor_boleto = @ceil_dec($valorcomjuros + $valormulta,2,'.');

		

		// DADOS DO BOLETO PARA O SEU CLIENTE

		$dias_de_prazo_para_pagamento = $linha['receber'];

		$vencimento = data2banco($valor['datad']);

		$data_atual = date("Y-m-d");

		if($vencimento < $data_atual){

		$data_venc = date("d/m/Y");

		}else{

		$data_venc = $valor['datad'];

		}

		$valor_cobrado = $valor_boleto; // Valor - REGRA: Sem pontos na milhar e tanto faz com "." ou "," ou com 1 ou 2 ou sem casa decimal

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

		if ($cliente['responsavel'] == 'CPF'){

			

			$nome_resp = $cliente['dir_culto'];

			$cpfcnpj = $cliente['cpfcnpj'];

					

		} else if($cliente['responsavel'] == 'CNPJ'){

			

			$nome_resp = $cliente['centro'];

			$cpfcnpj = $cliente['cnpj'];

		

		} else {

		print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=?pg=listaclientes'>

				<script type=\"text/javascript\">

				alert(\"Boleto sem um Responsável Financeiro! Por favor atualize o cadastro. \");

				</script>";

		}

		

		$Cnome = $cliente['dir_culto'];



		$endereco = $cliente['endereco'];

		$numero = $cliente['numero'];

		$bairro = $cliente['bairro'];

		$cidade = $cliente['cidade'];

		$estado = $cliente['uf'];

		$cep = $cliente['cep'];

		$Ccomplemento = $cliente['complemento'];

		$Cmatricula = $cliente['matricula'];

		

		$dadosboleto["sacado"] = "$Cmatricula - $nome_resp - $cpfcnpj";
		$dadosboleto["sacado"] .= "<br>Diretor(a) Espiritual - $Cnome";
		$dadosboleto["dest"] = "$Cmatricula - $Cnome";

		

		if (!empty($numero)){

			$dadosboleto["endereco1"] = "$endereco, Nº $numero $Ccomplemento";

		} else {

			$dadosboleto["endereco1"] = "$endereco, S/N $Ccomplemento";

		}

		$dadosboleto["endereco2"] = "$bairro - $cidade - $estado - CEP: $cep";

		

		// INFORMACOES PARA O CLIENTE

		$dadosboleto["demonstrativo1"] = $valor['ref'];

		

		// DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE

		$dadosboleto["quantidade"] = "001";

		$dadosboleto["valor_unitario"] = $valor_boleto;

		$dadosboleto["aceite"] = "SEM";		

		$dadosboleto["uso_banco"] = ""; 	

		$dadosboleto["especie"] = "R$";

		$dadosboleto["especie_doc"] = "DM";

		

		/////////////////////////////////////////////////////////

								$codigobanco = "341";

								$codigo_banco_com_dv = geraCodigoBanco($codigobanco);

								$nummoeda = "9";

								$fator_vencimento = fator_vencimento($dadosboleto["data_vencimento"]);

								

								//valor tem 10 digitos, sem virgula

								$valor = formata_numero($dadosboleto["valor_boleto"],10,0,"valor");

								//agencia é 4 digitos

								$agencia = formata_numero($dadosboleto["agencia"],4,0);

								//conta é 5 digitos + 1 do dv

								$conta = formata_numero($dadosboleto["conta"],5,0);

								$conta_dv = formata_numero($dadosboleto["conta_dv"],1,0);

								$carteira = $dadosboleto["carteira"];

								//carteira 175

								//nosso_numero no maximo 8 digitos

								$nnum = formata_numero($dadosboleto["nosso_numero"],8,0);

								

								$codigo_barras = $codigobanco.$nummoeda.$fator_vencimento.$valor.$carteira.$nnum.modulo_10($agencia.$conta.$carteira.$nnum).$agencia.$conta.modulo_10($agencia.$conta).'000';

								// 43 numeros para o calculo do digito verificador

								$dv = digitoVerificador_barra($codigo_barras);

								// Numero para o codigo de barras com 44 digitos

								$linha = substr($codigo_barras,0,4).$dv.substr($codigo_barras,4,43);

								

								$nossonumero = $carteira.'/'.$nnum.'-'.modulo_10($agencia.$conta.$carteira.$nnum);

								$agencia_codigo = $agencia." / ". $conta."-".modulo_10($agencia.$conta);

								

								$dadosboleto["codigo_barras"] = $linha;

								$dadosboleto["linha_digitavel"] = monta_linha_digitavel($linha); // verificar

								$dadosboleto["agencia_codigo"] = $agencia_codigo ;

								$dadosboleto["nosso_numero"] = $nossonumero;

								$dadosboleto["codigo_banco_com_dv"] = $codigo_banco_com_dv;

	

		////////////////////////////////////////////////////////

	

		ob_start(); 



	include('include/layout_itau_pdf.php');

			

	$html .= ob_get_clean(); 

	

	}//fim do for

	$mpdf->repackageTTF = false;

	$css = file_get_contents('include/lote_boleto_pedf.css');

	$mpdf->WriteHTML($css,1);

	$mpdf->WriteHTML($html);

	

	$mpdf->Output('boletos.pdf','D');//I - Inline / D - Forçar Download

		

	

}// fim do else

?>