<?php

/*ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);
*/

include "../classes/conexao.php";
include "../classes/funcoes.class.php";
require_once("RetornoBanco.php");
require_once("RetornoFactory.php");

$LIMPA = mysql_query("TRUNCATE financeiro");

function linhaProcessada1($self, $numLn, $vlinha) {

  if(!empty($vlinha)){
    foreach($vlinha as $nome_indice => $valor)
	//echo "$nome_indice: $valor<br/>";

	  $dt_geracao			= $vlinha["dt_geracao"];
	  $b					= $vlinha["banco"];
	  $ag_receb				= $vlinha["ag_receb"];
	  $dv_receb 			= $vlinha["dv_receb"];
	  $nm 					= $vlinha['nosso_numero'];
	  $venc					= $vlinha['vencimento'];
	  $valor				= $vlinha['valor'];

	  //novos
	  $tipo_registro 		= $vlinha["tipo_registro"]; //9  Identificação do registro transação
	  $c_ocorrencia 		= $vlinha["c_ocorrencia"]; //9  identificação da ocorrencia
	  $d_ocorrencia 		= $vlinha["d_ocorrencia"]; //9  data da ocorrencia
      $d_credito 			= $vlinha["d_credito"]; //9  data do credito desta liquidação
	  $c_liquidacao			= $vlinha["c_liquidacao"]; //9  Nosso-Número
	  $conta_receb 			= $vlinha['conta_receb'];
	  $dac		 			= $vlinha['dac'];
	  $detalhe_ocorrencia 	= $vlinha['detalhe_ocorrencia'];
	  $n_pagador    		= $vlinha['n_pagador'];

	 if ($b != 0){  

	 //Insere na tabela financeiro
	 $sql = mysql_query("INSERT INTO financeiro (banco, ag_receb, conta_receb, dac, dv_receb, nosso_numero, vencimento, valor, tipo_registro, c_ocorrencia, detalhe_ocorrencia, d_ocorrencia, d_credito, c_liquidacao, n_pagador) 

	 VALUES('$b','$ag_receb','$conta_receb', '$dac', '$dv_receb', '$nm', '$venc', '$valor', '$tipo_registro', '$c_ocorrencia','$detalhe_ocorrencia', '$d_ocorrencia', '$d_credito', '$c_liquidacao','$n_pagador')")or die(mysql_error());

	 //Insere na tabela de relatorio
	 $sql_relatorio = mysql_query("INSERT INTO relatorio_retorno (banco,ag_receb, conta_receb, dac, dv_receb, nosso_numero, vencimento, valor, tipo_registro, c_ocorrencia, detalhe_ocorrencia, d_ocorrencia, d_credito, c_liquidacao, n_pagador) 

	 VALUES('$b','$ag_receb','$conta_receb', '$dac', '$dv_receb', '$nm', '$venc', '$valor', '$tipo_registro', '$c_ocorrencia','$detalhe_ocorrencia', '$d_ocorrencia', '$d_credito', '$c_liquidacao','$n_pagador')")or die(mysql_error());

	 }

  echo "<br/>\n";

  }

}

 echo "<script language='javascript'>
	 window.open('relat_baixa.php?data=$dt_geracao', '_blank');
	</script>"; 


//window.open('relatorio.php', '_blank');

print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=../inicio.php?pg=fatbaixada'>";

//--------------------------------------INÍCIO DA EXECUÇÃO DO CÓDIGO-----------------------------------------------------

$fileName = $_FILES['arquivo']['tmp_name'];
$nome_arquivo = $_FILES['arquivo']['name'];// Pega o nome do arquivo.RET
$sql2 = mysql_query("SELECT * FROM retornos WHERE nome_arquivo = '$nome_arquivo'") ;//Consulta se existe o nome do arquivo.RET
$arquivo = mysql_fetch_array($sql2);
$nome_arquivo1 = $arquivo['nome_arquivo'];//recupera o nome do aruivo no banco de dados

if ($nome_arquivo == $nome_arquivo1){//Se o arquivo existir

	print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=../inicio.php?pg=baixa'>
		  <script type=\"text/javascript\">
			  alert(\"ARQUIVO JÁ PROCESSADO!\");
		  </script>";

} else {//se o arquivo não existir

$cnab240 = RetornoFactory::getRetorno($fileName, "linhaProcessada1");
$retorno = new RetornoBanco($cnab240);
$retorno->processar();

 //cadastro do arquivo de retorno
	  $codigo1				= $vlinha['cod_retorno1'];
	  $codigo2				= $vlinha['cod_retorno2'];

 $sql2 = mysql_query("INSERT INTO retornos (data_proc, nome_arquivo, id_arquivo) 
				 VALUES('$codigo1', '$nome_arquivo', '$codigo2')")or die(mysql_error()) ; 
	}

//////RECUPERA O ULTIMO REGISTRO DO FINNCEIRO

	$sql = mysql_query("SELECT * FROM financeiro");

while($ver = mysql_fetch_array($sql)){

	  $dbaixa				= date("Y-m-d");
	  $banco 				= $ver["banco"];
	  $ag_receb 			= $ver["ag_receb"];
	  $dv_receb 			= $ver["dv_receb"];
	  $nm 					= $ver['nosso_numero'];
	  $valor 				= $ver['valor'];
	  $conta_receb 			= $ver['conta_receb'];
	  $dac		 			= $ver['dac'];
	  $detalhe_ocorrencia 	= $ver['detalhe_ocorrencia'];
	  $n_pagador    		= $ver['n_pagador'];
	  $c_ocorrencia1 		= $ver["c_ocorrencia"]; //9  identificação da ocorrencia
	  $d_ocorrencia 		= $ver["d_ocorrencia"]; //9  data da ocorrencia

	  $d2b_ano=substr($d_ocorrencia,4,2);
		$d2b_mes=substr($d_ocorrencia,2,2);
		$d2b_dia=substr($d_ocorrencia,0,2);		
		$d2b="20$d2b_ano-$d2b_mes-$d2b_dia";

	if ($c_ocorrencia1 == '09'){

		$cancelada = mysql_query("UPDATE faturas SET dbaixa = '$d2b', motivo_baixa = 'CANCELADA' WHERE id_venda = '$nm' OR nosso_numero='$nm'") or die(mysql_error());

	}


	if ($c_ocorrencia1 == '06'){

	$baixa = mysql_query("UPDATE faturas SET dbaixa = '$d2b', codbanco = '$banco', banco_receb ='$ag_receb',dv_receb='$dv_receb',valor_recebido='$valor', situacao ='B', motivo_baixa ='PAGA' WHERE id_venda='$nm' OR nosso_numero='$nm'") or die(mysql_error());

	/////Baixa nas mensalidades pagas 
	$sql_fatura = mysql_query("SELECT * FROM faturas WHERE id_venda = '$nm'");
	$fatura = mysql_fetch_array($sql_fatura);
	$ref2 = $fatura['ref2'];
	$id_cliente = $fatura['id_cliente'];

	if (isset($ref2) && !empty($ref2)){

		if (strlen($ref2) >= 13){

			$partes = explode("_", $ref2);
			  	$i = explode("-", $partes[0]);
				$f = explode("-", $partes[1]);

				$mi = $i[0]; $ai = $i[1]; $mf = $f[0]; $af = $f[1];

					$cont = $ai;

					while ($af >= $cont){

					$v = verificaGerarMensalidade($id_cliente,$ai,$mi);
						$cont++;
					}

				$qtd_mes = contaMeses ($mi,$ai,$mf,$af);
	

  				for ($i=0;$i < $qtd_mes; $i++){

					$mes_verificar = $mi + $i;
					$ano_verificar = $ai;

					if ($mes_verificar > 12 && $mes_verificar <= 24){

						$mes_verificar = $mes_verificar - 12;
						$ano_verificar = $ano_verificar + 1;

						$sql1 = mysql_query("UPDATE `ref_mensalidade` SET situacao='1', n_fatura = '$nm', data_pagamento = '$$d2b', quem_recebeu = 'BANCO', n_recibo = '$nm', valor_pago = '$valor' WHERE (id_cliente = '$id_cliente' AND mes = '$mes_verificar' AND ano = '$ano_verificar')")or die (mysql_error());

						$mes_verificar = getMesAbr($mes_verificar);

						$sql2 = mysql_query("UPDATE `mensalidades` SET ".$mes_verificar."='1' WHERE id_cliente = '$id_cliente' AND ano = '$ano_verificar'")or die (mysql_error());

											

					} else if ($mes_verificar > 24){

						$mes_verificar = $mes_verificar - 24;

						$ano_verificar = $ano_verificar + 2;

						

						$sql1 = mysql_query("UPDATE `ref_mensalidade` SET situacao='1', n_fatura = '$nm', data_pagamento = '$d2b', quem_recebeu = 'BANCO', n_recibo = '$nm', valor_pago = '$valor' WHERE (id_cliente = '$id_cliente' AND mes = '$mes_verificar' AND ano = '$ano_verificar')")or die (mysql_error());

						$mes_verificar = getMesAbr($mes_verificar);

						$sql2 = mysql_query("UPDATE `mensalidades` SET ".$mes_verificar."='1' WHERE id_cliente = '$id_cliente' AND ano = '$ano_verificar'")or die (mysql_error());					

					} else if ($mes_verificar > 36){

						$mes_verificar = $mes_verificar - 36;
						$ano_verificar = $ano_verificar + 3;

						$sql1 = mysql_query("UPDATE `ref_mensalidade` SET situacao='1', n_fatura = '$nm', data_pagamento = '$d2b', quem_recebeu = 'BANCO', n_recibo = '$nm', valor_pago = '$valor' WHERE (id_cliente = '$id_cliente' AND mes = '$mes_verificar' AND ano = '$ano_verificar')")or die (mysql_error());

						$mes_verificar = getMesAbr($mes_verificar);

						$sql2 = mysql_query("UPDATE `mensalidades` SET ".$mes_verificar."='1' WHERE id_cliente = '$id_cliente' AND ano = '$ano_verificar'")or die (mysql_error());					

					} else {

						$sql1 = mysql_query("UPDATE `ref_mensalidade` SET situacao='1', n_fatura = '$nm', data_pagamento = '$dbaixa', quem_recebeu = 'BANCO', n_recibo = '$nm', valor_pago = '$valor' WHERE (id_cliente = '$id_cliente' AND mes = '$mes_verificar' AND ano = '$ano_verificar')")or die (mysql_error());

						$mes_verificar = getMesAbr($mes_verificar);

						$sql2 = mysql_query("UPDATE `mensalidades` SET ".$mes_verificar."='1' WHERE id_cliente = '$id_cliente' AND ano = '$ano_verificar'")or die (mysql_error());

					}

				}//fim do for

				

			} else {

		

				$partes = explode("-", $ref2);

			  		$mes = $partes[0];

					$ano = $partes[1];

	

		 		$sql1 = mysql_query("UPDATE `ref_mensalidade` SET situacao='1', n_fatura = '$nm', data_pagamento = '$d2b', quem_recebeu = 'BANCO', n_recibo = '$nm', valor_pago = '$valor' WHERE (id_cliente = '$id_cliente' AND mes = '$mes' AND ano = '$ano')")or die (mysql_error());

				$mesa = getMesAbr($mes);

	 			$sql2 = mysql_query("UPDATE `mensalidades` SET ".$mesa."='1' WHERE id_cliente = '$id_cliente' AND ano = '$ano'")or die (mysql_error());

		}//fim do else

  	}//fim do if ($ref2)  

  }//fim do if para pagamento (06 ou 09)

}//fim do While





?>