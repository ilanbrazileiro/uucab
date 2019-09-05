<?php

include "conexao.php";

class recordset{



// ************** SELECIONAR DADOS **************************

function seleciona($sql){

	$result = mysql_query($sql)or die(mysql_error());

	return $result;		

}



//***************** INSERIR DADOS ****************************

function inserir($tabela, $dados){

	// PEGAR CAMPOS DA ARRAY

	$arrCampo = array_keys($dados);

	//PEGAR VALORES DA ARRAY

	$arrValores = array_values($dados);

	// CONTAR CAMPOS DA ARRAY

	$numCampo = count($arrCampo);

	// CONTAR OS VALORES DA ARRAY

	$numValores = count($arrValores);

	// VALIDAÇÃO

	if($numCampo == $numValores){ // if insert

		$SQL = "INSERT INTO	".$tabela." (";

		foreach($arrCampo as $campo){

			$SQL .= "$campo, ";	

		}

		$SQL = substr_replace($SQL, ")", -2, 1);

		$SQL .="VALUES (";

			foreach($arrValores as $valores){

			$SQL .= "'".$valores."', ";	

			}

		$SQL = substr_replace($SQL, ")", -2, 1);

	}else{

		echo 'Erro ao checar valores';

	}

	$this->seleciona($SQL);		

}// fim da function inserir



// ******************* ALTERAR DADOS ***************************

function alterar($tabela, $dados, $string){

	// PEGAR CAMPOS DA ARRAY

	$arrCampo = array_keys($dados);

	//PEGAR VALORES DA ARRAY

	$arrValores = array_values($dados);

	// CONTAR CAMPOS DA ARRAY

	$numCampo = count($arrCampo);

	// CONTAR OS VALORES DA ARRAY

	$numValores = count($arrValores);

	// CONSTRUÇÃO DA SCRTING

	if($numCampo == $numValores && $numValores > 0){ // if alterar

		$SQL = "UPDATE ".$tabela." SET ";

		for($i = 0; $i < $numCampo; $i++){

			$SQL .= $arrCampo[$i]." = '".$arrValores[$i]."',";

		}

		$SQL = substr_replace($SQL, " ", -1, 1);

		$SQL .= "WHERE $string";

	}else{

		echo 'Erro ao checar o update';	

	}// fim da if alterar

	$this->seleciona($SQL);

}// FIM DA FUNCTION ALTERAR

	

}// FIM DA CLASSE



//////////Função para pegar a descrição do codigo da OCORRENCIA

function getDescricaoCodigo($cod){

	$codigo = $cod;

	if($codigo == 2) 

				return 'ENTRADA CONFIRMADA COM POSSIBILIDADE DE MENSAGEM (NOTA 20 – TABELA 10) ';

			else if($codigo == 3)  

				return 'ENTRADA REJEITADA (NOTA 20 - TABELA 1)';

			else if($codigo == 4) 

				return 'ALTERAÇÃO DE DADOS - NOVA ENTRADA OU ALTERAÇÃO/EXCLUSÃO DE DADOS ACATADA ';

			else if($codigo == 5)  

				return 'ALTERAÇÃO DE DADOS – BAIXA';

			else if($codigo == 6) 

				return 'LIQUIDAÇÃO NORMAL';

			else if($codigo == 7)

				return 'LIQUIDAÇÃO PARCIAL – COBRANÇA INTELIGENTE (B2B)';

			else if($codigo == 8) 

				return 'LIQUIDAÇÃO EM CARTÓRIO ';

			else if($codigo == 9)  

				return 'BAIXA SIMPLES';

			else if($codigo == 10) 

				return 'BAIXA POR TER SIDO LIQUIDADO ';

			else if($codigo == 11)  

				return 'EM SER (SÓ NO RETORNO MENSAL)';

			else if($codigo == 12) 

				return 'ABATIMENTO CONCEDIDO ';

			else if($codigo == 13)  

				return 'ABATIMENTO CANCELADO';

			else if($codigo == 14) 

				return 'VENCIMENTO ALTERADO ';

			else if($codigo == 15)  

				return 'BAIXAS REJEITADAS (NOTA 20 - TABELA 4)';

			else if($codigo == 16) 

				return 'INSTRUÇÕES REJEITADAS (NOTA 20 - TABELA 3) ';

			else if($codigo == 17) 

				return 'ALTERAÇÃO/EXCLUSÃO DE DADOS REJEITADOS (NOTA 20 - TABELA 2)';

			else if($codigo == 18) 

				return 'COBRANÇA CONTRATUAL - INSTRUÇÕES/ALTERAÇÕES REJEITADAS/PENDENTES (NOTA 20 - TABELA 5) ';

			else if($codigo == 19) 

				return 'CONFIRMA RECEBIMENTO DE INSTRUÇÃO DE PROTESTO';

			else if($codigo == 20) 

				return 'CONFIRMA RECEBIMENTO DE INSTRUÇÃO DE SUSTAÇÃO DE PROTESTO /TARIFA';

			else if($codigo == 21) 

				return 'CONFIRMA RECEBIMENTO DE INSTRUÇÃO DE NÃO PROTESTAR';

			else if($codigo == 23) 

				return 'TÍTULO ENVIADO A CARTÓRIO/TARIFA';

			else if($codigo == 24) 

				return 'INSTRUÇÃO DE PROTESTO REJEITADA / SUSTADA / PENDENTE (NOTA 20 - TABELA 7)';

			else if($codigo == 25) 

				return 'ALEGAÇÕES DO SACADO (NOTA 20 - TABELA 6)';

			else if($codigo == 26) 

				return 'TARIFA DE AVISO DE COBRANÇA';

			else if($codigo == 27) 

				return 'TARIFA DE EXTRATO POSIÇÃO (B40X)';

			else if($codigo == 28) 

				return 'TARIFA DE RELAÇÃO DAS LIQUIDAÇÕES';

			else if($codigo == 29) 

				return 'TARIFA DE MANUTENÇÃO DE TÍTULOS VENCIDOS';

			else if($codigo == 30)  

				return 'DÉBITO MENSAL DE TARIFAS (PARA ENTRADAS E BAIXAS)';

			else if($codigo == 32) 

				return 'BAIXA POR TER SIDO PROTESTADO';

			else if($codigo == 33) 

				return 'CUSTAS DE PROTESTO';

			else if($codigo == 34) 

				return 'CUSTAS DE SUSTAÇÃO';

			else if($codigo == 35) 

				return 'CUSTAS DE CARTÓRIO DISTRIBUIDOR';

			else if($codigo == 36) 

				return 'CUSTAS DE EDITAL';

			else if($codigo == 37) 

				return 'TARIFA DE EMISSÃO DE BOLETO/TARIFA DE ENVIO DE DUPLICATA';

			else if($codigo == 38) 

				return 'TARIFA DE INSTRUÇÃO';

			else if($codigo == 39) 

				return 'TARIFA DE OCORRÊNCIAS';

			else if($codigo == 40) 

				return 'TARIFA MENSAL DE EMISSÃO DE BOLETO/TARIFA MENSAL DE ENVIO DE DUPLICATA';

			else if($codigo == 41) 

				return 'DÉBITO MENSAL DE TARIFAS – EXTRATO DE POSIÇÃO (B4EP/B4OX)';

			else if($codigo == 42) 

				return 'DÉBITO MENSAL DE TARIFAS – OUTRAS INSTRUÇÕES';

			else if($codigo == 43) 

				return 'DÉBITO MENSAL DE TARIFAS – MANUTENÇÃO DE TÍTULOS VENCIDOS';

			else if($codigo == 44) 

				return 'DÉBITO MENSAL DE TARIFAS – OUTRAS OCORRÊNCIAS';

			else if($codigo == 45) 

				return 'DÉBITO MENSAL DE TARIFAS – PROTESTO';

			else if($codigo == 46) 

				return 'DÉBITO MENSAL DE TARIFAS – SUSTAÇÃO DE PROTESTO';

			else if($codigo == 47) 

				return 'BAIXA COM TRANSFERÊNCIA PARA DESCONTO';

			else if($codigo == 48) 

				return 'CUSTAS DE SUSTAÇÃO JUDICIAL';

			else if($codigo == 51)  

				return 'TARIFA MENSAL REF A ENTRADAS BANCOS CORRESPONDENTES NA CARTEIRA';

			else if($codigo == 52) 

				return 'TARIFA MENSAL BAIXAS NA CARTEIRA';

			else if($codigo == 53) 

				return 'TARIFA MENSAL BAIXAS EM BANCOS CORRESPONDENTES NA CARTEIRA';

			else if($codigo == 54) 

				return 'TARIFA MENSAL DE LIQUIDAÇÕES NA CARTEIRA';

			else if($codigo == 55)  

				return 'TARIFA MENSAL DE LIQUIDAÇÕES EM BANCOS CORRESPONDENTES NA CARTEIRA';

			else if($codigo == 56) 

				return 'CUSTAS DE IRREGULARIDADE';

			else if($codigo == 57)  

				return 'INSTRUÇÃO CANCELADA (NOTA 20 – TABELA 8)';

			else if($codigo == 59) 

				return 'BAIXA POR CRÉDITO EM C/C ATRAVÉS DO SISPAG';

			else if($codigo == 60)  

				return 'ENTRADA REJEITADA CARNÊ (NOTA 20 – TABELA 1)';

			else if($codigo == 61) 

				return 'TARIFA EMISSÃO AVISO DE MOVIMENTAÇÃO DE TÍTULOS (2154)';

			else if($codigo == 62) 

				return 'DÉBITO MENSAL DE TARIFA - AVISO DE MOVIMENTAÇÃO DE TÍTULOS (2154)';

			else if($codigo == 63) 

				return 'TÍTULO SUSTADO JUDICIALMENTE';

			else if($codigo == 64) 

				return 'ENTRADA CONFIRMADA COM RATEIO DE CRÉDITO';

			else if($codigo == 69) 

				return 'CHEQUE DEVOLVIDO (NOTA 20 - TABELA 9)';

			else if($codigo == 71) 

				return 'ENTRADA REGISTRADA, AGUARDANDO AVALIAÇÃO';

			else if($codigo == 72) 

				return 'BAIXA POR CRÉDITO EM C/C ATRAVÉS DO SISPAG SEM TÍTULO CORRESPONDENTE';

			else if($codigo == 73) 

				return 'CONFIRMAÇÃO DE ENTRADA NA COBRANÇA SIMPLES – ENTRADA NÃO ACEITA NA COBRANÇA CONTRATUAL';

			else if($codigo == 76) 

				return 'CHEQUE COMPENSADO';

			else

				return 'Código Inexistente';

}



function formataDataSimples($d2b){

		

	if(!empty($d2b)){

		$d2b_ano=substr($d2b,4,2);

		$d2b_mes=substr($d2b,2,2);

		$d2b_dia=substr($d2b,0,2);		

		$d2b="$d2b_dia-$d2b_mes-$d2b_ano";

	}

	return $d2b; 

}



function formatadatas($d){

	

	$data = explode("-", $d);

	$dia = $data[0];

	$mes = $data[1];

	$ano = $data[2];

		

	$resultado = $ano."/".$mes."/".$dia;

	return $resultado;	

}



function formataDatasBD($d){

	

	$data = explode("/", $d);

	$dia = $data[0];

	$mes = $data[1];

	$ano = $data[2];

		

	$resultado = $ano."-".$mes."-".$dia;

	return $resultado;	

}



function formataDataInscricao($d){

	

	$data = explode("/", $d);

	$dia = $data[0];

	$mes = $data[1];

	$ano = $data[2];

		

	$resultado = $ano."-".$mes."-".$dia;

	return $resultado;	

}



function exibeDataInscricao($d){

	

	$data = explode("-", $d);

	$dia = $data[0];

	$mes = $data[1];

	$ano = $data[2];

		

	$resultado = $ano."/".$mes."/".$dia;

	return $resultado;	

}



function exibeData($d){

	

	$data = explode("-", $d);

	$ano = $data[0];

	$mes = $data[1];

	$dia = $data[2];

		

	$resultado = $dia."/".$mes."/".$ano;

	return $resultado;	

}



function corrigeBancoDados(){

	

	$financeiro = mysql_query("SELECT * FROM financeiro");



while($fin = mysql_fetch_array($financeiro)) {

$dataOcorrencia = $fin['d_ocorrencia'];

		

		$d2b_ano=substr($dataOcorrencia,4,2);

		$d2b_mes=substr($dataOcorrencia,2,2);

		$d2b_dia=substr($dataOcorrencia,0,2);		

		$d2b="20$d2b_ano-$d2b_mes-$d2b_dia";

		

$dataOcorrencia = $d2b;

$nossoNumero = $fin['nosso_numero'];

$atualiza = mysql_query("UPDATE faturas SET dbaixa = '$dataOcorrencia' WHERE nosso_numero = '$nossoNumero' AND situacao = 'B'");



}

	}



//////////Função para pegar a descrição do codigo da LIQUIDACAO

function getDescricaoLiquidacao($codigo_liquidacao){

	

	$codigo = $codigo_liquidacao;

		

    if($codigo =='AA')

		return 'CAIXA ELETRÔNICO BANCO ITAÚ';

	else if($codigo =='AC')

		return 'PAGAMENTO EM CARTÓRIO AUTOMATIZADO';

	else if($codigo =='AO')

		return 'ACERTO ONLINE';

	else if($codigo =='BC')

		return  'BANCOS CORRESPONDENTES';

	else if($codigo =='BF')

		return  'ITAÚ BANKFONE';

	else if($codigo =='BL')

		return 'ITAÚ BANKLINE';

	else if($codigo ==			'B0')

		return 'OUTROS BANCOS – RECEBIMENTO OFF-LINE';

	else if($codigo ==			'B1')

		return 'OUTROS BANCOS – PELO CÓDIGO DE BARRAS';

	else if($codigo ==			'B2')

		return 'OUTROS BANCOS – PELA LINHA DIGITÁVEL';

	else if($codigo ==			'B3')

		return 'OUTROS BANCOS – PELO AUTO ATENDIMENTO';

	else if($codigo ==			'B4')

		return 'OUTROS BANCOS – RECEBIMENTO EM CASA LOTÉRICA';

	else if($codigo ==			'B5')

		return 'OUTROS BANCOS – CORRESPONDENTE';

	else if($codigo ==			'B6')

		return 'OUTROS BANCOS – TELEFONE';

	else if($codigo ==			'B7')

		return 'OUTROS BANCOS – ARQUIVO ELETRÔNICO (Pagamento Efetuado por meio de troca de arquivos)';

	else if($codigo ==			'CC')

		return 'AGÊNCIA ITAÚ – COM CHEQUE DE OUTRO BANCO ou (CHEQUE ITAÚ)*';

	else if($codigo ==			'CI')

		return 'CORRESPONDENTE ITAÚ';

	else if($codigo ==			'CK')

		return 'SISPAG – SISTEMA DE CONTAS A PAGAR ITAÚ';

	else if($codigo ==			'CP')

		return 'AGÊNCIA ITAÚ – POR DÉBITO EM CONTA CORRENTE, CHEQUE ITAÚ* OU DINHEIRO';

	else if($codigo ==			'DG')

		return 'AGÊNCIA ITAÚ – CAPTURADO EM OFF-LINE';

	else if($codigo ==			'LC')

		return 'PAGAMENTO EM CARTÓRIO DE PROTESTO COM CHEQUE A COMPENSAR';

	else if($codigo ==			'EA')

		return 'TERMINAL DE CAIXA';

	else if($codigo ==			'Q0')

		return 'AGENDAMENTO – PAGAMENTO AGENDADO VIA BANKLINE OU OUTRO CANAL ELETRÔNICO E LIQUIDADO NA DATA INDICADA';

	else if($codigo ==			'RA')

		return 'DIGITAÇÃO – REALIMENTAÇÃO AUTOMÁTICA';

	else if($codigo ==			'ST')

		return 'PAGAMENTO VIA SELTEC**';

	else

		return 'Código não identificado';

}



function getMesPassado ($d){

	

	$dataatual = date('d/m/y');

	$partes = explode("/", $dataatual);

	$mesatual = $partes[1];

    $ultimomes = $mesatual - 1;

	

	return $ultimomes;

	}

	

function getSituacaoMensalidade ($s,$m,$a,$i){

	$situacao = $s;

	$id = $i;

	$ano = $a;

	$mes = $m;

	if($situacao == 0){

		$r ="<a href='pg/pagar_mensalidade.php?id=".$id."&a=".$ano."&m=".$mes."' style='text-decoration:none;' 

            class='mesnpago' onclick=\"NovaJanela(this.href,'nomeJanela','800','600','yes');return false\" title='Pagar Mensalidades'>

            N.Pago</a>";

		} else if ($situacao == 1){

			$r ="<a href='pg/ver_mensalidade.php?id=".$id."&a=".$ano."&m=".$mes."&estornar=estornar' style='text-decoration:none;' 

            class='mespago' onclick=\"NovaJanela(this.href,'nomeJanela','800','600','yes');return false\" title='Ver Mensalidade'>

            Pago</a>";

			//$r = "<center><input type='submit' class='mespago' name='estornar' value='Pago'/></center>";

			} else if ($situacao == 2){

				$r = "<a href='pg/pagar_mensalidade.php?id=".$id."&a=".$ano."&m=".$mes."' style='text-decoration:none;' class='mesatraso' onclick=\"NovaJanela(this.href,'nomeJanela','800','600','yes');return false\" title='Pagar Mensalidades'>Atraso</a>";

				} else if ($situacao == 3){

					$r = "<center><input type='button' class='mespre tip-top' value=' pré ' title='cliente não era matriculado' /></center>";

				}

		return $r;

	}



function getSituacaoMensalidade1 ($s,$m,$a,$i){

	$situacao = $s;

	$id = $i;

	$ano = $a;

	$mes = $m;

	if($situacao == 0){

		$r ="<a href='pagar_mensalidade.php?id=".$id."&a=".$ano."&m=".$mes."&c=1' style='text-decoration:none;' 

            class='mesnpago' onclick=\"NovaJanela(this.href,'nomeJanela','900','200','yes');return false\" title='Pagar Mensalidades'>

            N.Pago</a>";

		} else if ($situacao == 1){

			$r ="<a href='ver_mensalidade.php?id=".$id."&a=".$ano."&m=".$mes."&estornar=estornar&c=1'' style='text-decoration:none;' 

            class='mespago' onclick=\"NovaJanela(this.href,'nomeJanela','800','600','yes');return false\" title='Ver Mensalidade'>

            Pago</a>";

			//$r = "<center><input type='submit' class='mespago' name='estornar' value='Pago'/></center>";

			} else if ($situacao == 2){

				$r = "<a href='pagar_mensalidade.php?id=".$id."&a=".$ano."&m=".$mes."' style='text-decoration:none;' class='mesatraso' onclick=\"NovaJanela(this.href,'nomeJanela','800','600','yes');return false\" title='Pagar Mensalidades'>Atraso</a>";

				} else if ($situacao == 3){

					$r = "<center><input type='button' class='mespre tip-top' value=' pré ' title='Aluno não era matriculado' /></center>";

				} else if ($situacao == 5){

				$r = "<a href='ver_mensalidade.php?id=".$id."&a=".$ano."&m=".$mes."' style='text-decoration:none;' class='mesanistiado' onclick=\"NovaJanela(this.href,'nomeJanela','800','600','yes');return false\" title='Mensalidade Anistiada'>Anistiada</a>";

				}

		return $r;

	}

	

function getMes ($m){

	$mes = $m;

	if($mes == '1') 

				return 'JANEIRO';

		else if($mes == '2')  

				return 'FEVEREIRO';

		else if($mes == '3')  

				return 'MARÇO';

		else if($mes == '4')  

				return 'ABRIL';

		else if($mes == '5')  

				return 'MAIO';

		else if($mes == '6')  

				return 'JUNHO';

		else if($mes == '7')  

				return 'JULHO';

		else if($mes == '8')  

				return 'AGOSTO';

		else if($mes == '9')  

				return 'SETEMBRO';

		else if($mes == '10')  

				return 'OUTUBRO';

		else if($mes == '11')  

				return 'NOVEMBRO';

		else if($mes == '12')  

				return 'DEZEMBRO';		

		else

			return 'Mês não existe!';		

}	



function getMesAbr ($m){

	$mes = $m;

	if($mes == '1') 

				return 'jan';

		else if($mes == '2')  

				return 'fev';

		else if($mes == '3')  

				return 'mar';

		else if($mes == '4')  

				return 'abr';

		else if($mes == '5')  

				return 'mai';

		else if($mes == '6')  

				return 'jun';

		else if($mes == '7')  

				return 'jul';

		else if($mes == '8')  

				return 'ago';

		else if($mes == '9')  

				return 'setembro';

		else if($mes == '10')  

				return 'outubro';

		else if($mes == '11')  

				return 'nov';

		else if($mes == '12')  

				return 'dez';		

		else

			return 'Mês não existe!';		

}	



function geraOptionMeses (){

	

	$texto = "<option value='1'>Janeiro</option>

   			  <option value='2'>Fevereiro</option>

			  <option value='3'>Março</option>

			  <option value='4'>Abril</option>

			  <option value='5'>Maio</option>

			  <option value='6'>Junho</option>

			  <option value='7'>Julho</option>

			  <option value='8'>Agosto</option>

			  <option value='9'>Setembro</option>

			  <option value='10'>Outubro</option>

			  <option value='11'>Novembro</option>

			  <option value='12'>Dezembro</option>

			  ";

			return $texto;		

}



function geraOptionCampoCliente (){

	

	$texto = "<option value='inscricao'>Data de Admissão</option>

   			  <option value='cpfcnpj'>CPF</option>

			  ";

	return $texto;		

}	



function verificaGerarMensalidade($i,$a,$m){

	$id  = $i;//ID DO CLIENTE

	$ano = $a;// ANO ESCOLHIDO PARA GERAR AS MENSALIDADES

	$sql = mysql_query("SELECT * FROM cliente WHERE id_cliente='$id'")or die (mysql_error());//GET CLIENTE
	$l = mysql_fetch_array($sql);

	$matricula_cliente = $l['matricula'];

	//// TESTA SE AS MENSALIDADES JÁ FORAM INSERIDAS

	$sqla = mysql_query("SELECT * FROM mensalidades WHERE id_cliente='$id' AND ano='$ano'")or die (mysql_error());
	$l2 = mysql_fetch_array($sqla);
	$idc = $l2['id_cliente']; $anoc = $l2['ano'];

	if ($id != $l2['id_cliente'] && $ano != $l2['ano']){//SE NÃO INSERE

				

		$sql = mysql_query("INSERT INTO `mensalidades`(`id_mensalidade`, `id_cliente`, `matricula_cliente`, `ano`, `jan`, `fev`, `mar`, `abr`, `mai`, `jun`, `jul`, `ago`, `setembro`, `outubro`, `nov`, `dez`) VALUES ('','$id','$matricula_cliente','$ano','0','0','0','0','0','0','0','0','0','0','0','0')")or die (mysql_error());

		

		for ($i = 1; $i <= 12; $i++){

			$sqlm = mysql_query("INSERT INTO `ref_mensalidade`(`id`, `id_mensalidade`, `id_cliente`, `situacao`, `data_pagamento`, `n_fatura`, `mes`, `ano`) VALUES ('','','$id','0','','','$i','$ano')")or die (mysql_error()); 

			}

	

		if($sql == 1){/// SE CADASTRADO, ENVIA MENSAGEM INFORMANDO

			return 'cadastrado';

		} else { /// SE SIM ENVIA MENSAGEM E RETORNA PARA  A PÁGINA

		return 'não cadastrado';

		}

	}

}



function contaMeses ($mi, $ai, $mf, $af){

	

	$data_inicial = $ai.'-'.$mi;

	$data_final = $af.'-'.$mf;

	

	$data1 = new DateTime( $data_final );

	$data2 = new DateTime( $data_inicial );



	$intervalo = $data1->diff( $data2 );



	return ($intervalo->y)*12 + $intervalo->m + 1;

	

	//echo "Intervalo é de {$intervalo->y} anos, {$intervalo->m} meses e {$intervalo->d} dias";

		

}





function verificaMensalidadePaga ($mes, $ano, $id){

	$verifica_mensalidade = mysql_query("SELECT * FROM mensalidades WHERE ano = $ano AND id_cliente = $id");	

	$vm = mysql_fetch_array($verifica_mensalidade);	
	

	if($vm[$mes] == '1'){

		return true;

	} else { return false;}

}



function verificaBoletoExistente ($ref2, $id){

	

	$sql = mysql_query("SELECT * FROM faturas WHERE id_cliente = $id AND situacao != 'B' AND ref2 = '$ref2'");	



	if (mysql_num_rows($sql) > 0) {

    	return true;

	} else {

    	return false;

	}

	

}



function verificaMensalidadePagaGrupo ($mes, $ano, $ids_clientes){

	

	foreach($ids_clientes as $id){

		$verifica_mensalidade = mysql_query("SELECT * FROM mensalidades WHERE ano = $ano AND id_cliente = $id");	

		$vm = mysql_fetch_array($verifica_mensalidade);	

	

		if($vm[$mes] == '1'){					

			print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=inicio.php?pg=lancafatura'>

				  <script type=\"text/javascript\">	

				  alert(\"Exite mensalidade que já é considerada PAGA no sistema!\");	

				  </script>";

			 exit;

		}	

	}

	

}



function getCliente ($id_cliente){

	

	$sql_cliente = mysql_query("SELECT * FROM cliente WHERE id_cliente = $id_cliente");

$cliente = mysql_fetch_array($sql_cliente);



return $cliente;



}



function getFatura($id_fatura){

	

	$sql_fatura = mysql_query("SELECT * FROM faturas WHERE id_venda = $id_fatura");

$fatura = mysql_fetch_array($sql_fatura);



return $fatura;



}



function resgataSQL($m){

	$mes = $m;

	if($mes == '02')  

				return "UPDATE mensalidades SET jan = '3' " ;

		else if($mes == '03')  

				return "UPDATE mensalidades SET jan = '3', fev = '3' " ;

		else if($mes == '04')  

				return "UPDATE mensalidades SET jan = '3', fev = '3', mar = '3' " ;

		else if($mes == '05')  

				return "UPDATE mensalidades SET jan = '3', fev = '3', mar = '3', abr = '3' " ;

		else if($mes == '06')  

				return "UPDATE mensalidades SET jan = '3', fev = '3', mar = '3', abr = '3', mai = '3' " ;

		else if($mes == '07')  

				return "UPDATE mensalidades SET jan = '3', fev = '3', mar = '3', abr = '3', mai = '3', jun = '3' " ;

		else if($mes == '08')  

				return "UPDATE mensalidades SET jan = '3', fev = '3', mar = '3', abr = '3', mai = '3', jun = '3', jul = '3' " ;

		else if($mes == '09')  

				return "UPDATE mensalidades SET jan = '3', fev = '3', mar = '3', abr = '3', mai = '3', jun = '3', jul = '3', ago = '3' " ;

		else if($mes == '10')  

				return "UPDATE mensalidades SET jan = '3', fev = '3', mar = '3', abr = '3', mai = '3', jun = '3', jul = '3', ago = '3', setembro = '3' " ;

		else if($mes == '11')  

				return "UPDATE mensalidades SET jan = '3', fev = '3', mar = '3', abr = '3', mai = '3', jun = '3', jul = '3', ago = '3', setembro = '3', outubro = '3' " ;

		else if($mes == '12')  

				return "UPDATE mensalidades SET jan = '3', fev = '3', mar = '3', abr = '3', mai = '3', jun = '3', jul = '3', ago = '3', setembro = '3', outubro = '3', nov = '3' " ;		

		else

			return 'Mês não existe!';		

}



function getProximaMatricula(){

$sqlpm = mysql_query("SELECT max(matricula) FROM cliente WHERE matricula != '55555' AND matricula != '66666' AND matricula < '40000'")or die (mysql_error());

$proxima_matricula = mysql_fetch_array($sqlpm);



$proxima_matricula = $proxima_matricula['0'] + 1;

return $proxima_matricula;

}



function gerarMensalidadeCadastro($id){

	$cliente = getCliente($id);
	$matricula_cliente = $cliente['matricula'];

	$ano = date("Y");
	$partes = explode("-", $cliente['inscricao']);
	$mes = $partes[1];

	if ($mes == '12'){
		$mes = '1';
		$ano++;
	} else {
		$mes++;
	}

	$s = "'','$id','$matricula_cliente','$ano', ";

	for ($m = 1; $m <=12; $m++){
		if ($m < $mes) {
			$s .= "'3'";
		} else {
			$s .= "'0'";
		}
		if ($m < 12){ $s .= ", ";}
	}

		$sql = mysql_query("INSERT INTO `mensalidades`(`id_mensalidade`, `id_cliente`, `matricula_cliente`, `ano`, `jan`, `fev`, `mar`, `abr`, `mai`, `jun`, `jul`, `ago`, `setembro`, `outubro`, `nov`, `dez`) VALUES (".$s.")") or die (mysql_error());

	if ($sql == 1){
		for ($mes; $mes <= 12; $mes++){
			$sqlm = mysql_query("INSERT INTO `ref_mensalidade`(`id`, `id_mensalidade`, `id_cliente`, `situacao`, `data_pagamento`, `n_fatura`, `mes`, `ano`) VALUES ('','','$id','0','','','$mes','$ano')") or die (mysql_error());
		}

		return true;

	} else {

		return false;

	}
}


function cancelarBaixa($id_venda){

	$conecta = new recordset();

	$tabela = 'faturas';

	$dados = array(

		'situacao' 			=> 'P',

		'valor_recebido'	=> 0.00,

		'motivo_baixa'		=> ''

	);

	

	$s = "id_venda = '$id_venda'";

	

	$retorno = $conecta->alterar($tabela, $dados, $s);

	

	return $retorno; 

}



function pagarMensalidadeComReferencia(){





}



function gerarBoletoTexto ($id_cliente, $data_venc, $define, $referencia, $valor_postado, $qtd_mes){



	$cliente 		= getCliente($id_cliente);//BUSCA O CLIENTE

	$situacao 		= 'P'; //SITUAÇÃO DA FATURA

	$tipofatura		= 'AVULSO'; //TIPO DA FATURA

	$banco			= 'ITAU';

	

						if($define == "s"){

								$valor_cliente = $qtd_mes * $cliente['valor'];

						} else if ($define == 'a'){

								$valor_cliente = $cliente['valor_anual']; 

						} else {

								$valor_cliente = tiraMoeda($valor_postado);

						}

	

	$ban = mysql_query("SELECT * FROM bancos WHERE situacao = '1' ");//SELECIONA O BANCO ATUAL

	$ba = mysql_fetch_array($ban);

		

	$dados = array(//////////////////////DADOS DO BOLETO EM UM ARRAY

				'id_cliente' 	=> $id_cliente,

				'grupoCliente'	=> $cliente['id_grupo'],

				'nosso_numero' 	=> "00",

				'banco'		 	=> $banco,

				'nome'		 	=> $cliente['dir_culto'],

				'ref'		 	=> $referencia,

				'data'		 	=> date("Y-m-d"),

				'data_venci' 	=> formataDatasBD($data_venc),

				'valor' 	 	=> $valor_cliente,

				'situacao'	 	=> $situacao,

				'emailcli'	 	=> $cliente['email'],

				'tipofatura' 	=> $tipofatura,

				'conta'		 	=> $ba['conta'],

				'dv_receb'	 	=> $ba['digito_co'],

				'banco_receb' 	=> $ba['agencia'],

				'id_banco'	 	=> $ba['id_banco'],

				'ref2'			=> '0',

				'codigo_operacao' => '1'	

				);

				

		return $dados;

	

}//FECHA FUNÇÃO 



function gerarBoletoUnicoMes ($id_cliente, $data_venc, $define, $valor_postado, $mes, $ano){



		

			/////////////VERIFICAR SE MENSALIDADE JÁ PAGA

			$mes_abreviado = getMesAbr($mes);

			$pago = verificaMensalidadePaga ($mes_abreviado, $ano, $id_cliente);			

			

			if ($pago){

			

				return 1;

			

			} else {

			

				$ref2 = $mes.'-'.$ano;

				$existe_boleto = verificaBoletoExistente ($ref2, $id_cliente);

				

					if ($existe_boleto){

			

						return 2;

			

					} else {

			

						$referencia 	= 'MENSALIDADE DE '.getMes($mes).' '.$ano;

						$qtd_mes 		= 1;

						$cliente 		= getCliente($id_cliente);//BUSCA O CLIENTE

						$situacao 		= 'P'; //SITUAÇÃO DA FATURA

						$tipofatura		= 'AVULSO'; //TIPO DA FATURA

						$banco			= 'ITAU';

						

						if($define == "s"){

								$valor_cliente = $qtd_mes * $cliente['valor'];

						} else if ($define == 'a'){

								$valor_cliente = $cliente['valor_anual']; 

						} else {

								$valor_cliente = tiraMoeda($valor_postado);

						}

						

						$ban = mysql_query("SELECT * FROM bancos WHERE situacao = '1' ");//SELECIONA O BANCO ATUAL

						$ba = mysql_fetch_array($ban);

							

						$dados = array(//////////////////////DADOS DO BOLETO EM UM ARRAY

									'id_cliente' 	=> $id_cliente,

									'grupoCliente'	=> $cliente['id_grupo'],

									'nosso_numero' 	=> "00",

									'banco'		 	=> $banco,

									'nome'		 	=> $cliente['dir_culto'],

									'ref'		 	=> $referencia,

									'data'		 	=> date("Y-m-d"),

									'data_venci' 	=> formataDatasBD($data_venc),

									'valor' 	 	=> $valor_cliente,

									'situacao'	 	=> $situacao,

									'emailcli'	 	=> $cliente['email'],

									'tipofatura' 	=> $tipofatura,

									'conta'		 	=> $ba['conta'],

									'dv_receb'	 	=> $ba['digito_co'],

									'banco_receb' 	=> $ba['agencia'],

									'id_banco'	 	=> $ba['id_banco'],

									'ref2'			=> $ref2,

									'codigo_operacao' => '1'	

									);

									

						return $dados;

			

					}/////FIM DO TESTE SE EXISTE BOLETO

			}//FIM DO TESTE SE MENSALIDADE PAGA



}//FECHA FUNÇÃO 



function verificaAlgumaMensalidadePagaParaAno($id_cliente, $ano)

{



	$sql = mysql_query("SELECT * FROM mensalidades WHERE id_cliente = '$id_cliente' AND ano = '$ano' AND (

	jan = '1' OR fev = '1' OR 

    mar = '1' OR abr = '1' OR 

    mai = '1' OR jun = '1' OR 

    jul = '1' OR ago = '1' OR 

    setembro = '1' OR outubro = '1' OR 

    nov = '1' OR dez = '1'

    )");



	if($cliente = mysql_num_rows($sql) == 1){

		

		return true;

	

	} else {

	

		return false;

	}



}





function gerarBoletoAnual ($id_cliente, $data_venc, $define, $valor_postado, $ano){

					

				$ref2 = '1-'.$ano.'_12-'.$ano;

				$ano_pago = verificaAlgumaMensalidadePagaParaAno($id_cliente, $ano);

				

				if ($ano_pago){

					

					return 3;

				

				} else {				

				

				$existe_boleto = verificaBoletoExistente ($ref2, $id_cliente);///VERIFICA SE EXISTE O BOLETO ANUAL

				

					if ($existe_boleto){

			

						return 2;

			

					} else {

			

						$referencia 	= 'ANUIDADE: JANEIRO A DEZEMBRO '.$ano;

						$qtd_mes 		= 12;

						$cliente 		= getCliente($id_cliente);//BUSCA O CLIENTE

						$situacao 		= 'P'; //SITUAÇÃO DA FATURA

						$tipofatura		= 'AVULSO'; //TIPO DA FATURA

						$banco			= 'ITAU';

						

						if($define == "s"){

								$valor_cliente = $qtd_mes * $cliente['valor'];

						} else if ($define == 'a'){

								$valor_cliente = $cliente['valor_anual']; 

						} else {

								$valor_cliente = tiraMoeda($valor_postado);

						}

						

						$ban = mysql_query("SELECT * FROM bancos WHERE situacao = '1' ");//SELECIONA O BANCO ATUAL

						$ba = mysql_fetch_array($ban);

							

						$dados = array(//////////////////////DADOS DO BOLETO EM UM ARRAY

									'id_cliente' 	=> $id_cliente,

									'grupoCliente'	=> $cliente['id_grupo'],

									'nosso_numero' 	=> "00",

									'banco'		 	=> $banco,

									'nome'		 	=> $cliente['dir_culto'],

									'ref'		 	=> $referencia,

									'data'		 	=> date("Y-m-d"),

									'data_venci' 	=> formataDatasBD($data_venc),

									'valor' 	 	=> $valor_cliente,

									'situacao'	 	=> $situacao,

									'emailcli'	 	=> $cliente['email'],

									'tipofatura' 	=> $tipofatura,

									'conta'		 	=> $ba['conta'],

									'dv_receb'	 	=> $ba['digito_co'],

									'banco_receb' 	=> $ba['agencia'],

									'id_banco'	 	=> $ba['id_banco'],

									'ref2'			=> $ref2,

									'codigo_operacao' => '1'	

									);

									

						return $dados;

			

					}/////FIM DO TESTE SE EXISTE BOLETO

				}/////////FIM DO TESTE SE A MENSALIDADE JÁ ESTA PAGA

			

}//FECHA FUNÇÃO 



function gerarBoletoPorIntervalo($id_cliente, $data_venc, $define, $valor_postado, $mes_inicial, $mes_final, $ano_inicial, $ano_final){

	

				$ref2 = $mes_inicial.'-'.$ano_inicial.'_'.$mes_final.'-'.$ano_final;

				$qtd_mes = contaMeses ($mes_inicial,$ano_inicial,$mes_final,$ano_final);

					

				$existe_boleto = verificaBoletoExistente ($ref2, $id_cliente);///VERIFICA SE EXISTE O BOLETO ANUAL

				

					if ($existe_boleto){

			

						return 2;

			

					} else {

			

						$referencia 	= 'MENSALIDADES DE '.getMes($mes_inicial).' '.$ano_inicial.' A '.getMes($mes_final).' '.$ano_final;

						$cliente 		= getCliente($id_cliente);//BUSCA O CLIENTE

						$situacao 		= 'P'; //SITUAÇÃO DA FATURA

						$tipofatura		= 'AVULSO'; //TIPO DA FATURA

						$banco			= 'ITAU';

						

						if($define == "s"){

								$valor_cliente = $qtd_mes * $cliente['valor'];

						} else if ($define == 'a'){

								$valor_cliente = $cliente['valor_anual']; 

						} else {

								$valor_cliente = tiraMoeda($valor_postado);

						}

						

						$ban = mysql_query("SELECT * FROM bancos WHERE situacao = '1' ");//SELECIONA O BANCO ATUAL

						$ba = mysql_fetch_array($ban);

							

						$dados = array(//////////////////////DADOS DO BOLETO EM UM ARRAY

									'id_cliente' 	=> $id_cliente,

									'grupoCliente'	=> $cliente['id_grupo'],

									'nosso_numero' 	=> "00",

									'banco'		 	=> $banco,

									'nome'		 	=> $cliente['dir_culto'],

									'ref'		 	=> $referencia,

									'data'		 	=> date("Y-m-d"),

									'data_venci' 	=> formataDatasBD($data_venc),

									'valor' 	 	=> $valor_cliente,

									'situacao'	 	=> $situacao,

									'emailcli'	 	=> $cliente['email'],

									'tipofatura' 	=> $tipofatura,

									'conta'		 	=> $ba['conta'],

									'dv_receb'	 	=> $ba['digito_co'],

									'banco_receb' 	=> $ba['agencia'],

									'id_banco'	 	=> $ba['id_banco'],

									'ref2'			=> $ref2,

									'codigo_operacao' => '1'	

									);

									

						return $dados;

					}/////FIM DO TESTE SE EXISTE BOLETO			

}//FECHA FUNÇÃO 

function getEstadoCivil($estado_civil){

	

	if ($estado_civil == 'SOLTEIRO'){

		return 'Solteiro (a)';

	} else if ($estado_civil == 'CASADO'){

		return 'Casado (a)';

	} else if ($estado_civil == 'VIUVO'){

		return 'Viúvo (a)';

	} else if ($estado_civil == 'DIVORCIADO'){

		return 'Divorciado (a)';

	} else if ($estado_civil == 'UNIAO'){

		return 'União Estável';

	} else if ($estado_civil == 'OUTROS'){

		return 'Outros';

	} else if ($estado_civil == 'NAO'){

		return 'Não consta informação';

	}

	             

}



function getSituacao($situacao){

	

	if ($situacao == 'V'){

		return 'VIVO';

	} else if ($situacao == 'M'){

		return 'MORTO';

	} else if ($situacao == 'A'){

		return 'AGUARDAR';

	} else if ($situacao == 'I'){

		return 'ISENTO';

	} 

	             

}



function ultimaMensalidade($id_cliente){

	$m = mysql_query("SELECT *, MAX(ano) FROM mensalidades WHERE id_cliente = '$id_cliente' AND (
	jan = '1' OR fev = '1' OR 
    mar = '1' OR abr = '1' OR 
    mai = '1' OR jun = '1' OR 
    jul = '1' OR ago = '1' OR 
    setembro = '1' OR outubro = '1' OR 
    nov = '1' OR dez = '1' OR
    jan = '5' OR fev = '5' OR 
    mar = '5' OR abr = '5' OR 
    mai = '5' OR jun = '5' OR 
    jul = '5' OR ago = '5' OR 
    setembro = '5' OR outubro = '5' OR 
    nov = '5' OR dez = '5'
    )");

	$mensalidades = mysql_fetch_array($m);

	if (is_null($mensalidades['MAX(ano)'])){//Se vazio - Nunca pagou
		return "Nunca Pagou!";
	} else {

		$ano = $mensalidades['MAX(ano)'];

			$m = mysql_query("SELECT * FROM mensalidades WHERE id_cliente = '$id_cliente' AND ano = $ano");

			$mensalidades = mysql_fetch_array($m);

			if ($mensalidades['dez'] == '1' || $mensalidades['dez'] == '5'){				$mes = 12;
			} else if ($mensalidades['nov'] == '1' || $mensalidades['nov'] == '5'){		$mes = 11;
			} else if ($mensalidades['outubro'] == '1' || $mensalidades['outubro'] == '5'){	$mes = 10;
			} else if ($mensalidades['setembro'] == '1' || $mensalidades['setembro'] == '5'){	$mes = 9;
			} else if ($mensalidades['ago'] == '1' || $mensalidades['ago'] == '5'){		$mes = 8;
			} else if ($mensalidades['jul'] == '1' || $mensalidades['jul'] == '5'){		$mes = 7;
			} else if ($mensalidades['jun'] == '1' || $mensalidades['jun'] == '5'){		$mes = 6;
			} else if ($mensalidades['mai'] == '1' || $mensalidades['mai'] == '5'){		$mes = 5;
			} else if ($mensalidades['abr'] == '1' || $mensalidades['abr'] == '5'){		$mes = 4;
			} else if ($mensalidades['mar'] == '1' || $mensalidades['mar'] == '5'){		$mes = 3;
			} else if ($mensalidades['fev'] == '1' || $mensalidades['fev'] == '5'){		$mes = 2;
			} else if ($mensalidades['jan'] == '1' || $mensalidades['jan'] == '5'){		$mes = 1;
			} 
		return	$mes."/".$ano;
	}
}



function verificaAtraso($ultima_mensalidade){

	if ($ultima_mensalidade == "Nunca Pagou!"){
	return 1;
	exit;	
	}

		$partes = explode("/", $ultima_mensalidade);

		$m = $partes[0];
		$a = $partes[1];

		$mes_atual = date("m");

		$ano_atual = date("Y");

		

		if($a < $ano_atual){

			return "1";

		} else if ($a > $ano_atual){

			return "2";

		} else {

			if ($mes_atual > $m){

				return "1";

			} else {

				return "2";

			}	

		}

}



function clientesAtrasoMes($mes, $ano){



	$sql = mysql_query("SELECT * FROM mensalidades WHERE $mes = '2' AND ano = $ano");

	

	while($mensalidade = mysql_fetch_array($sql)) {

		

		$cliente = getCliente($mensalidade['id_cliente']);



			if ($cliente['situacao'] == 'V'){

				$clientes[] = $mensalidade['id_cliente'];

			}

	}

	

	return $clientes;

}



function clientesSemBoletoMes($mes, $ano){

	$referencia = $mes."-".$ano;

	$sql = mysql_query("SELECT * FROM cliente WHERE situacao = 'V' ORDER BY matricula ASC");

	while($cliente = mysql_fetch_array($sql)) {

		$id_cliente = $cliente['id_cliente'];

		if (validaCPF($cliente['cpfcnpj']) && !verificaMensalidadePaga(getMesAbr($mes), $ano, $id_cliente)){///Verifica cpf valido e mensalidade paga

		$sql2 = mysql_query("SELECT * FROM faturas WHERE id_cliente = $id_cliente");

			if (mysql_num_rows($sql2) > 0) {// SE EXISTE ALGUMA FATURA

				$achou = 0;
				while($faturas_cliente = mysql_fetch_array($sql2)){

					if (strlen($faturas_cliente['ref2']) > 13 ){

								$partes = explode("_", $faturas_cliente['ref2']);
								$inicial = explode("-", $partes[0]);
								$final = explode("-", $partes[1]);
										

							$mi = $inicial[0];		$ai = $inicial[1];
							$mf = $final[0];		$af = $final[1];


							if ($mi == '1' && $mf == '12' && $ai == $af){///VERIFICA SE BOLETO ANUAL	


							} else {
								for ($ai; $ai<=$af;$ai++){

									for ($mi;$mi<=12;$mi++){

										$ref = $mi.'-'.$ai;

										if ($ref == $referencia){

											$achou = 1;

											break 2;

										}//fim do IF

									}//fim do FOR

								}//Fim do FOR

							}	

					} else if ($referencia == $faturas_cliente['ref2']){
	 						$achou = 1;
							break 1;
					}//Fim do Else If*/

				} //fim do While

				if ($achou == 0) {

					$clientes[] = $id_cliente;

				}

								

			} else {

				$clientes[] = $id_cliente;

			}
		}
			

	}			

	

	return $clientes;

}



function campoVazio($campo){



	$sql = mysql_query("SELECT * FROM cliente order by matricula ASC");

	

	if (mysql_num_rows($sql) > 0) {

		

		while($select_cliente = mysql_fetch_array($sql)){

		

			if (empty($select_cliente[$campo]) || $select_cliente[$campo] == '--'){

			

				$ids[] = $select_cliente['id_cliente'];

			

			}

		}

		return $ids;	

	} else {

		return 2;

	}

}



function mensalidadePagaParaAno($ano)

{



	$sql = mysql_query("SELECT id_cliente FROM mensalidades WHERE ano = $ano AND (

	jan = '1' OR fev = '1' OR 

    mar = '1' OR abr = '1' OR 

    mai = '1' OR jun = '1' OR 

    jul = '1' OR ago = '1' OR 

    setembro = '1' OR outubro = '1' OR 

    nov = '1' OR dez = '1'

    ) ORDER BY matricula_cliente ASC");



	while($select_cliente = mysql_fetch_array($sql)){

		

		$ids[] = $select_cliente['id_cliente'];

			

	}

		return $ids;	

	

}



function recuperaReferencia($ref)

{

	if (strlen($ref) > 12){

		

		$partes = explode("_", $ref);

		

		$di = $partes[0];

		$di = explode("-", $di);

		$mi = $di[0]; $ai = $di[1];

		

		$df = $partes[1];

		$df = explode("-", $df);

		$mf = $df[0]; $af = $df[1];

		

		return "O boleto referece ao pagamento das mensalidades de ".getMes($mi)."/$ai a ".getMes($mf)."/$af";

	

	} else if (strlen($ref) > 5 && strlen($ref) <= 7){

	

		$partes = explode("-", $ref);

		$mi = $partes[0]; $ai = $partes[1];

		

		return "O boleto referece ao pagamento da mensalidade de ".getMes($mi)."/$ai";

	

	} else {

	

		return 'Não foi possível encontrar a referência para este boleto';

	}



}



function validaCPF ($cpf){

	if(empty($cpf)) {
        return false;
    }

    $cpf = str_replace(".", "", $cpf);
    $cpf = str_replace("-", "", $cpf);
    $cpf = preg_match('/[0-9]/', $cpf)?$cpf:0;

    $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);

    if (strlen($cpf) != 11) {
        return false;
    }

    else if ($cpf == '00000000000' || 

        $cpf == '11111111111' || 
        $cpf == '22222222222' || 
        $cpf == '33333333333' || 
        $cpf == '44444444444' || 
        $cpf == '55555555555' || 
        $cpf == '66666666666' || 
        $cpf == '77777777777' || 
        $cpf == '88888888888' || 
        $cpf == '99999999999') {
        return false;

    } else {   

        for ($t = 9; $t < 11; $t++) {

            for ($d = 0, $c = 0; $c < $t; $c++) {

                $d += $cpf{$c} * (($t + 1) - $c);

            }

            $d = ((10 * $d) % 11) % 10;

            if ($cpf{$c} != $d) {

              return false;

            }
        }

        return true;

    }
}



function clientesComCPFinvalido($situacao){

	if ($situacao == "T"){

		$sql = mysql_query("SELECT * FROM cliente");

		while($select_cliente = mysql_fetch_array($sql)){

			if (!validaCPF($select_cliente['cpfcnpj'])){
				$ids[] = $select_cliente['id_cliente'];
			}
		}

	} elseif ($situacao == "V"){

		$sql = mysql_query("SELECT * FROM cliente WHERE situacao = 'V'");

		while($select_cliente = mysql_fetch_array($sql)){

			if (!validaCPF($select_cliente['cpfcnpj'])){
				$ids[] = $select_cliente['id_cliente'];

			}
		}

	} elseif ($situacao == "M"){

		$sql = mysql_query("SELECT * FROM cliente WHERE situacao = 'M'");

		while($select_cliente = mysql_fetch_array($sql)){

			if (!validaCPF($select_cliente['cpfcnpj'])){
				$ids[] = $select_cliente['id_cliente'];
			}
		}

	} elseif ($situacao == "A"){

		$sql = mysql_query("SELECT * FROM cliente WHERE situacao = 'A'");

		while($select_cliente = mysql_fetch_array($sql)){
			if (!validaCPF($select_cliente['cpfcnpj'])){
				$ids[] = $select_cliente['id_cliente'];
			}
		}
	}

	return $ids;	
}

function validaCEP ($nrcep){

		$nrcep = str_replace("-", "", $nrcep);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "http://viacep.com.br/ws/$nrcep/json/");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$data = json_decode(curl_exec($ch), true);
		curl_close($ch);

		return $data;

}

function clientesComCEPinvalido(){

	$sql = mysql_query("SELECT * FROM cliente WHERE situacao = 'V' limit 50");
		while($select_cliente = mysql_fetch_array($sql)){
				$resultado = validaCEP($select_cliente['cep']);
				if (isset($resultado['erro'])){
					$ids[] = $select_cliente['id_cliente'];
				}
		}
	return $ids;	
}

function atualizaPreMensalidades(){

	$sql = mysql_query("SELECT * FROM cliente order by id_cliente DESC limit 300");

	while($cliente = mysql_fetch_array($sql)){
		
		$data = explode("-", $cliente['inscricao']);

		$ano = $data[0];
		$mes = $data[1];
		

		$m = mysql_query("SELECT * FROM mensalidades WHERE id_cliente = ".$cliente['id_cliente']);

		while ($mensalidade = mysql_fetch_array($m)) {
			
			if($mensalidade['ano'] < $ano){//VERIFICA SE ANO MENOR QUE ANO DE INSCRICAO

				mysql_query("UPDATE mensalidades SET 
					jan = 3, 
					fev = 3,
					mar = 3,
					abr = 3,
					mai = 3,
					jun = 3,
					jul = 3,
					ago = 3,
					setembro = 3,
					outubro = 3,
					nov = 3,
					dez = 3
					WHERE id_mensalidade = ".$mensalidade['id_mensalidade']);

			} else if ($mes == '01' && $mensalidade['ano'] == $ano){ //VERIFCA SE MES JANEIRO E ANO IGUAL

				mysql_query("UPDATE mensalidades SET 
					jan = 3 
					WHERE id_mensalidade = ".$mensalidade['id_mensalidade']." AND ano = ".$ano);

			} else if ($mes == '02' && $mensalidade['ano'] == $ano){ //VERIFCA SE MES FEVEREIRO E ANO IGUAL

				mysql_query("UPDATE mensalidades SET 
					jan = 3, 
					fev = 3
					WHERE id_mensalidade = ".$mensalidade['id_mensalidade']." AND ano = ".$ano);

			} else if ($mes == '03' && $mensalidade['ano'] == $ano){ //VERIFCA SE MES DEZEMBRO E ANO IGUAL

				mysql_query("UPDATE mensalidades SET 
					jan = 3,
					fev = 3,
					mar = 3
					WHERE id_mensalidade = ".$mensalidade['id_mensalidade']." AND ano = ".$ano);
			
			} else if ($mes == '04' && $mensalidade['ano'] == $ano){ //VERIFCA SE MES DEZEMBRO E ANO IGUAL

				mysql_query("UPDATE mensalidades SET 
					jan = 3,
					fev = 3,
					mar = 3,
					abr = 3
					WHERE id_mensalidade = ".$mensalidade['id_mensalidade']." AND ano = ".$ano);
			
			} else if ($mes == '05' && $mensalidade['ano'] == $ano){ //VERIFCA SE MES DEZEMBRO E ANO IGUAL

				mysql_query("UPDATE mensalidades SET 
					jan = 3,
					fev = 3,
					mar = 3,
					abr = 3,
					mai = 3
					WHERE id_mensalidade = ".$mensalidade['id_mensalidade']." AND ano = ".$ano);
			
			} else if ($mes == '06' && $mensalidade['ano'] == $ano){ //VERIFCA SE MES DEZEMBRO E ANO IGUAL

				mysql_query("UPDATE mensalidades SET 
					jan = 3,
					fev = 3,
					mar = 3,
					abr = 3,
					mai = 3,
					jun = 3
					WHERE id_mensalidade = ".$mensalidade['id_mensalidade']." AND ano = ".$ano);
			}
			
		}//FIM DO 2 WHILE
	
	}//FIM DO 1 WHILE

}

function acertaInscricao(){

	$sql = mysql_query("SELECT * FROM cliente WHERE inscricao like '%/%' order by id_cliente DESC");

	while($cliente = mysql_fetch_array($sql)){

		$data = formataDatasBD($cliente['inscricao']);

		mysql_query("UPDATE cliente SET inscricao = '$data' WHERE id_cliente = ".$cliente['id_cliente']);

	}
}


	function getUserImage(){

		$login = $_SESSION['login_session'];

		return $login;

	}

################# INICIO DAS FUNÇÔES DO NOVO LAYOUT

function moedaParaBanco($valor){
	$result = str_replace("R$ ", "", $valor);
	return tiraMoeda($result);
}

function tiraMoeda($valor){
	$pontos = '.';
	$virgula = ',';

	$result = str_replace($pontos, "", $valor);
	$result2 = str_replace($virgula, ".", $result);

	return $result2;
}

?>