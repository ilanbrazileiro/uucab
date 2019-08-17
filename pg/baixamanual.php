<?php 
session_start();
//se nao existir volta para a pagina do form de login
if(!isset($_SESSION['login_session']) and !isset($_SESSION['senha_session'])){
	header("Location:../index.php");
	exit;		
}
?>

<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Edita fatura</title>
<link href="../css/styles.css" rel="stylesheet" type="text/css">
<link href="../css/jquery-uicss.css" rel="stylesheet" type="text/css">
<link href="../css/principal.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="../css/icons.css" />
<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css" />
<link href="../css/jquery-ui-1.10.4.custom.css" rel="stylesheet" type="text/css">
<style type="text/css">
body {
	background: #f2f2f2;
	padding:10px;
}

.linha {
	width:900px;
	display:table;
	margin-bottom:10px;
	}
.coluna {
	float:left;	
	}
</style>
</head>
<?php $pg = $_GET['pagina'];
	
	
?>
<script type="text/javascript">
function fechajanela() {
window.open("../inicio.php?pg=<?php echo $pg ?>","main");
}
</script>

<script type="text/javascript" src="../js/funcoes.js"></script>
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/jquery.maskedinput.js"></script>
<script type="text/javascript">
    jQuery(function ($) {
            $("#data_pagamento").mask("99/99/9999");
			
        });

function up(lstr){ // converte minusculas em maiusculas
var str=lstr.value; //obtem o valor
lstr.value=str.toUpperCase(); //converte as strings e retorna ao campo
}

</script>

<script src="../js/jquery-1.10.2.js"></script>
<script src="../js/jquery-ui-1.10.4.custom.js"></script>
<script type="text/javascript" src="../js/jquery.mask-money.js"></script>
<script type="text/javascript">		
$(document).ready(function() {
        $("#valor").maskMoney({decimal:",",thousands:""});
      });

function SomenteNumero(e){

  var tecla=(window.event)?event.keyCode:e.which;   
  if((tecla>47 && tecla<58)){
      return true;
  }else{
      if(tecla==8 || tecla==0){
         return true;
      }else{
         return false;
      }
  }
}
</script>
<body onunload="fechajanela()">
<?php 
include "../classes/conexao.php";
include "../classes/funcoes.class.php";

$id = $_GET['id_venda'];

if(isset($_POST['baixar'])){
	
	$data = date("Y-m-d");
	$valor_recebido = $_POST['valor_recebido'];
	$n_fatura = $_POST['n_fatura'];
	$n_recibo = $_POST['n_recibo'];
	$quem_recebeu = $_POST['quem_recebeu'];
	$data_pagamento = $_POST['data_pagamento'];
	$banco_receb = "BAIXA MANUAL";
	$motivo = $_POST['motivo'];
	
	if ($motivo == 1){
		$SQL = mysql_query("UPDATE faturas SET dbaixa = '$data', valor_recebido = '$valor_recebido', situacao ='B', remessa = 0, motivo_baixa = 'Pagamento direto', codigo_operacao = 34 WHERE id_venda = '$id'") or die(mysql_error());
	
		if ($SQL == 1){
			
		/////Baixa nas mensalidades pagas 
		$sql_fatura = mysql_query("SELECT * FROM faturas WHERE id_venda = '$id'");
		$fatura = mysql_fetch_array($sql_fatura);
		$ref2 = $fatura['ref2'];
		$id_cliente = $fatura['id_cliente'];

		if (isset($ref2) && !empty($ref2)){
	
	//Preenchendo as variaveis
	  $dbaixa				= $data;
	  $nm 					= $id;
	  $valor 				= $valor_recebido;
	 
			if (strlen($ref2) >= 13){
			
			$partes = explode("_", $ref2);
			  	$i = explode("-", $partes[0]);
				$f = explode("-", $partes[1]);
				
				$mi = $i[0]; $ai = $i[1]; $mf = $f[0]; $af = $f[1];
				
					$v = verificaGerarMensalidade($id_cliente,$ai,$mi);
					$v1 = verificaGerarMensalidade($id_cliente,$af,$mf);
			
				$qtd_mes = contaMeses ($mi,$ai,$mf,$af);
								
  				for ($i=0;$i < $qtd_mes; $i++){
					$mes_verificar = $mi + $i;
					$ano_verificar = $ai;
					
					if ($mes_verificar > 12 && $mes_verificar <= 24){
						$mes_verificar = $mes_verificar - 12;
						$ano_verificar = $ano_verificar + 1;
						
						$sql1 = mysql_query("UPDATE `ref_mensalidade` SET situacao='1', n_fatura = '$n_fatura', data_pagamento = '$data_pagamento', quem_recebeu = '$quem_recebeu', n_recibo = '$n_recibo', valor_pago = '$valor_recebido' WHERE (id_cliente = '$id_cliente' AND mes = '$mes_verificar' AND ano = '$ano_verificar')")or die (mysql_error());
						$mes_verificar = getMesAbr($mes_verificar);
						$sql2 = mysql_query("UPDATE `mensalidades` SET ".$mes_verificar."='1' WHERE id_cliente = '$id_cliente' AND ano = '$ano_verificar'")or die (mysql_error());
											
					} else if ($mes_verificar > 24){
						$mes_verificar = $mes_verificar - 24;
						$ano_verificar = $ano_verificar + 2;
						
						$sql1 = mysql_query("UPDATE `ref_mensalidade` SET situacao='1', n_fatura = '$n_fatura', data_pagamento = '$data_pagamento', quem_recebeu = '$quem_recebeu', n_recibo = '$n_recibo', valor_pago = '$valor_recebido' WHERE (id_cliente = '$id_cliente' AND mes = '$mes_verificar' AND ano = '$ano_verificar')")or die (mysql_error());
						$mes_verificar = getMesAbr($mes_verificar);
						$sql2 = mysql_query("UPDATE `mensalidades` SET ".$mes_verificar."='1' WHERE id_cliente = '$id_cliente' AND ano = '$ano_verificar'")or die (mysql_error());					
						} else {
						$sql1 = mysql_query("UPDATE `ref_mensalidade` SET situacao='1', n_fatura = '$n_fatura', data_pagamento = '$data_pagamento', quem_recebeu = '$quem_recebeu', n_recibo = '$n_recibo', valor_pago = '$valor_recebido' WHERE (id_cliente = '$id_cliente' AND mes = '$mes_verificar' AND ano = '$ano_verificar')")or die (mysql_error());
						$mes_verificar = getMesAbr($mes_verificar);
						$sql2 = mysql_query("UPDATE `mensalidades` SET ".$mes_verificar."='1' WHERE id_cliente = '$id_cliente' AND ano = '$ano_verificar'")or die (mysql_error());
						}
				}//fim do for
			
				  
	  } else {
			  $id_cliente = $fatura['id_cliente'];
			 
			  $partes = explode("-", $ref2);
				$mes = $partes[0];
				$ano = $partes[1];
			 		
			  $sql1 = mysql_query("UPDATE `ref_mensalidade` SET situacao='1', n_fatura = '$n_fatura', data_pagamento = '$data_pagamento', quem_recebeu = '$quem_recebeu', n_recibo = '$n_recibo', valor_pago = '$valor_recebido' WHERE (id_cliente = '$id_cliente' AND mes = '$mes' AND ano = '$ano')")or die (mysql_error());
			  
			  $mesa = getMesAbr($mes);
				$sql2 = mysql_query("UPDATE `mensalidades` SET ".$mesa."='1' WHERE (id_cliente = '$id_cliente' AND ano = '$ano')")or die (mysql_error());
		}
		}
	   }//fim da verificação de sucesso do pagamento
}// fim do motivo 1

else if ($motivo == 2){
	
		$SQL = mysql_query("UPDATE faturas SET dbaixa = '$data', valor_recebido = '$valor_recebido', situacao ='B', remessa = 0, motivo_baixa = 'Cancelamento do boleto', codigo_operacao = 2 WHERE id_venda = '$id'") or die(mysql_error());
}

	echo "<script type='text/javascript'>
			window.close();
		</script>
		
	";
}
	$ver = mysql_query("SELECT *,date_format(data_venci, '%d/%m/%Y') AS data FROM faturas WHERE id_venda = '$id'");
	$linha = mysql_fetch_array($ver);

?>
<div id="entrada">
<div id="cabecalho">
  <h2><i class="icon-cloud-download iconmd"></i> Baixar fatura</h2></div>
<div id="forms">
	<form action="" method="post" name="form" id="form" enctype="multipart/form-data">
    <ul>
    	<li><strong>Cliente:</strong> <?php echo $linha['nome']; ?></li>
    	<li><strong>Valor da fatura:</strong> <?php echo $linha['valor']; ?></li>
    	<li><strong>Vencimento:</strong> <?php echo $linha['data']; ?></li>
        <li><strong>Documento:</strong> <?php echo $linha['num_doc']; ?></li>
        
   </ul>
    <hr>
     <div class="coluna" style="width:300px;"><strong>Motivo da Baixa:</strong><br/>
    <input name="motivo" type="radio" value="1" onclick="document.getElementById('referencia').style.visibility = 'visible'"> Pagamento &nbsp;|&nbsp;
    <input name="motivo" type="radio" value="2" onclick="document.getElementById('referencia').style.visibility = 'hidden'"> Cancelar Boleto
    </div>
  
       <div class="linha">
    <br/>
      <br/>
                <div style="visibility:hidden" id="referencia"> <?php echo recuperaReferencia($linha['ref2']); ?> <br>
                	<br>
                    <div class="coluna" style="width:190px;">Número da Fatura:<br/>
                    <input type="text" name="n_fatura" style="width:160px;" value="<?php echo $linha['id_venda']; ?>" placeholder="Digite o número da fatura ou forma de pagamento...">
                    </div>
                    <div class="coluna" style="width:150px;">Número do Recibo:<br/>
                    <input type="text" name="n_recibo" style="width:120px;" value="" placeholder="Digite o número do recibo...">
                    </div>
                    <div class="coluna" style="width:200px;">Quem recebeu?:<br/>
                    <input type="text" name="quem_recebeu" value="" onkeyup="up(this)"style="width:170px;" placeholder="Nome da pessoa que recebeu o valor" onkeyup="up(this)">
                    </div>
                    <div class="coluna" style="width:120px;">Data de Pagamento:<br/>
                    <input type="text" name="data_pagamento" value="<?php echo date("d/m/Y"); ?>" style="width:100px;" placeholder="" id="data_pagamento">
                    </div>
                </div>
    
    
    </div>
    
    <br/>
    <strong>Valor recebido:</strong><br/>
    <div class="input-prepend">
    <span class="add-on"><i class="icon-money"></i></span>
    <input name="valor_recebido" type="text" id="valor" style="text-align:right; width:60px;">
    <br/>
    </div><br/>
<br/>
    <div class="control-groupa">
    <div class="controlsa">
    
    <input name="baixar" type="hidden" value="baixar">
    
    <button type="submit" class="btn btn-success ewButton" name="editar">
    <i class="icon-thumbs-up icon-white"></i> Baixar</button>
    </div></div>
    </form>
</div>
</div>
</body>
</html>