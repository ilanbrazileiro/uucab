<?php 
include "../classes/conexao.php";
include "../classes/funcoes.class.php";
require '../classes/class.phpmailer.php';
$mail = new PHPMailer();

// SELECIONA DADOS DO EMAIL QUE ENVIA COBRANÇA
$sql = mysql_query("SELECT * FROM maile")or die (mysql_error());
$linha = mysql_fetch_array($sql);
$host = $linha['url'];
$empresa = $linha['empresa'];
$endereco = $linha['endereco'];
$email = $linha['email'];
$html = $linha['text1'];

//////////////////////// encodifica url //////////////////////////////////////
function base64url_encode($data) {
			return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
			}

// RETIRA PONTOS DOS VALORES
	function tiraMoeda($valor){
	$pontos = '.';
	$virgula = ',';
	$result = str_replace($pontos, "", $valor);
	$result2 = str_replace($virgula, ".", $result);
	return $result2;
	}
// SELECIONA AS CONFIGURAÇÕES
$sql = mysql_query("SELECT * FROM config");
$config = mysql_fetch_array($sql);
	$nomeconf = $config['nome'];
	$emailconf = $config['email'];
	$dias_antes = $config['dias'];
//////////////////////////////////////////////////INICIO DA GERAÇÂO DE BOLETOS MENSAIS PARA OS VIVOS

/////as datas serão fixadas para gerar os boletos
$ano = date('Y');//define o ano atual
$ano_seguinte = $ano + 1 ; //define o ano anterior

$jf = $ano.'-12-14';
$mam = $ano.'-02-15';
$jja = $ano.'-05-15';
$son = $ano.'-08-15';
$d = $ano.'-11-15';

$hoje = date('Y-m-d');//define a data de hoje
$mam1 = $ano_seguinte.'-02-15';
$jf1 = $ano_seguinte.'-01-01';

if(strtotime($hoje) >= strtotime($jf) && strtotime($hoje) < strtotime($mam1)){
	// SELECIONA OS CLIENTES--- JANEIRO E FEVEREIRO -------
	$sql_cliente = mysql_query("SELECT * FROM cliente WHERE situacao = 'V' AND (id_grupo = 3 OR id_grupo = 18)");
	$b =0;
	while($select_cliente = mysql_fetch_array($sql_cliente)){
		$id_cliente = $select_cliente['id_cliente'];
		
			$sql_mensalidade = mysql_query("SELECT * FROM mensalidades WHERE ano = $ano_seguinte AND id_cliente = $id_cliente");
			$b = $b+1;
						
			while($sql_mensalidade = mysql_fetch_array($sql_mensalidade)){
				$jan = $sql_mensalidade['jan'];
				$fev = $sql_mensalidade['fev'];
				
				if ($jan == '0'){
									
					$referencia = '1-'.$ano_seguinte;
					$sql_faturas = mysql_query("SELECT * FROM faturas WHERE id_cliente = $id_cliente AND ref2 = '$referencia'");
						while($sql_faturas = mysql_fetch_array($sql_faturas)){
							$ref2 = $sql_faturas['ref2'];
						}
					if ($referencia == $ref2){
						echo 'Fatura já cadastrada para Janeiro<br>';
					
					} else {
						echo 'entrou em '.getMes(1).'<br>';
						$dados = geraFatura($id_cliente,1,$ano_seguinte,$b);
						echo $dados;	 //Função em funcoes.class.php
					}
				}
				
				if ($fev == '0'){
					
					$referencia = '2-'.$ano_seguinte;
					$sql_faturas = mysql_query("SELECT * FROM faturas WHERE id_cliente = $id_cliente AND ref2 = '$referencia'");
						while($sql_faturas = mysql_fetch_array($sql_faturas)){
							$ref2 = $sql_faturas['ref2'];
						}
					if ($referencia == $ref2){
						echo 'Fatura já cadastrada para Fevereiro<br>';
					
					} else {
						echo 'entrou em '.getMes(2).'<br>';
						$dados = geraFatura($id_cliente,2,$ano_seguinte,$b);
						echo $dados;	 //Função em funcoes.class.php
					}
				}
			}	
	}




} elseif(strtotime($hoje) >= strtotime($mam) && strtotime($hoje) < strtotime($jja)){
	echo 'Mensalidade de março, abril e maio';



} elseif(strtotime($hoje) >= strtotime($jja) && strtotime($hoje) < strtotime($son)){
	echo 'Mensalidade de junho, julho e agosto';
	
	
} elseif(strtotime($hoje) >= strtotime($son) && strtotime($hoje) < strtotime($d)){
	echo 'Mensalidade de setembro, outubro e novembro';
	


} elseif(strtotime($hoje) >= strtotime($d) && strtotime($hoje) < strtotime($jf1)){
	echo 'Mensalidade de dezembro';





} else {
	echo $hoje.' Não entrou em data nenhuma'.$jf1;
	}

















?>