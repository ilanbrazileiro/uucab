<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Ver Detalhes da Mensalidade</title>
<style type="text/css">
body {
	background:#0099CC;
	font-family:Verdana, Geneva, sans-serif; font-size:12px;
}
fieldset{
-webkit-border-radius: 10px;
-moz-border-radius: 10px;
border-radius: 10px;
background:#FFFFFF;
overflow:hidden;
padding-top:30px;	
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
<link href="../css/jquery-uicss.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="../css/icons.css" />
<link href="../css/principal.css" rel="stylesheet" type="text/css">
<link href="../css/styles.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css" />
</head>
<script language="javascript">
//function fechajanela(p) {
//	if (p ==1){
//window.open("../inicio.php?pg=listaclientes","main");	
//	} else {
//window.open("../inicio.php?pg=listaclientes","main");
//	}
//}

</script>
<script src="../js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="../js/jquery.mask-money.js"></script>
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
<?php 

include "../classes/conexao.php";
include "../classes/funcoes.class.php";


////////////////////////////     CODGIO PARA GERAR AS MENSALIDADES 
if(isset($_POST['pagar'])){
	
	echo $id = $_POST['id1'];
	$mes = $_POST['mes'];
	$ano = $_POST['ano'];
	$edita_cliente = $_POST['edita_cliente'];
	$data = formataDatasBD($_POST['data_pagamento']);
	$n_fatura = $_POST['n_fatura'];
	$valor_pago = $_POST['valor_pago'];
	$n_recibo = $_POST['n_recibo'];
	$quem_recebeu = $_POST['quem_recebeu'];
	
	$sql1 = mysql_query("UPDATE `ref_mensalidade` SET situacao='1', n_fatura = '$n_fatura', data_pagamento = '$data', valor_pago = '$valor_pago', n_recibo = '$n_recibo', quem_recebeu = '$quem_recebeu' WHERE (id_cliente = '$id' AND mes = '$mes' AND ano = '$ano')")or die (mysql_error());
	
	$mesa = getMesAbr($mes);
	echo $mesa;
	$sql2 = mysql_query("UPDATE `mensalidades` SET ".$mesa."='1' WHERE (id_cliente = '$id' AND ano = '$ano')")or die (mysql_error());
	
	if($edita_cliente == '1'){
		if($sql1 && $sql2){/// SE CADASTRADO, ENVIA MENSAGEM INFORMANDO
		$endereco = $_SERVER['REQUEST_URI'];
			print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=editacliente.php?id=$id&p=1'>
			<script type=\"text/javascript\">
			
			</script>";
				
		} else { /// SE SIM ENVIA MENSAGEM E RETORNA PARA  A PÁGINA
			print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=?pg=editacliente&id=$id'>
			<script type=\"text/javascript\">
			
			</script>";	
		}
		
	} else {	
		if($sql1 && $sql2){/// SE CADASTRADO, ENVIA MENSAGEM INFORMANDO
			print"<META HTTP-EQUIV=REFRESH CONTENT='0;URL=editacliente.php?id=$id&p=1'>
			<script type=\"text/javascript\">
			
			</script>";
			print "<script type=\"text/javascript\"></script>";
	
		} else { /// SE SIM ENVIA MENSAGEM E RETORNA PARA  A PÁGINA
			print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=editacliente.php?id=$id&p=1'>
			<script type=\"text/javascript\">
		
			</script>";	
		}
	}
}

if(isset($_POST['estornar'])){

	$id = $_POST['id1'];
	$mes = $_POST['mes'];
	$ano = $_POST['ano'];
	$edita_cliente = $_POST['edita_cliente'];

	$sql1 = mysql_query("UPDATE `ref_mensalidade` SET situacao='0', n_fatura = '0', data_pagamento = '0', valor_pago = '0', n_recibo = '0', quem_recebeu = '0'  WHERE (id_cliente = '$id' AND mes = '$mes' AND ano = '$ano')")or die (mysql_error());
	$mesa = getMesAbr($mes);
	$sql2 = mysql_query("UPDATE `mensalidades` SET ".$mesa."='0' WHERE (id_cliente = '$id' AND ano = '$ano')")or die (mysql_error());

if($edita_cliente == '1'){		
	if($sql1 && $sql2){/// SE CADASTRADO, ENVIA MENSAGEM INFORMANDO
		$endereco = $_SERVER['REQUEST_URI'];
			print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=editacliente.php?id=$id&p=1'>
			<script type=\"text/javascript\">
			
			</script>";
							
		} else { /// SE SIM ENVIA MENSAGEM E RETORNA PARA  A PÁGINA
			print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=editacliente.php?id=$id&p=1'>
			<script type=\"text/javascript\">
		
			</script>";	
		}
		
	} else {	
		if($sql1 && $sql2){/// SE CADASTRADO, ENVIA MENSAGEM INFORMANDO
			print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=editacliente.php?id=$id&p=1'>
			<script type=\"text/javascript\">
			
			</script>";
			print "<script type=\"text/javascript\"></script>";
	
		} else { /// SE SIM ENVIA MENSAGEM E RETORNA PARA  A PÁGINA
			print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=editacliente.php?id=$id&p=1'>
			<script type=\"text/javascript\">
			
			</script>";	
		}
		
		
		}
}
################# ESTORNAR POR INTERVALO ##################
if(isset($_POST['estornar_intervalo'])){

	$id = $_POST['id1'];
	$mes = $_POST['mes'];
	$ano = $_POST['ano'];

	$mes_final = $_POST['mes_final'];
	$ano_final = $_POST['ano_final'];
	

	$edita_cliente = $_POST['edita_cliente'];

	$sql1 = mysql_query("UPDATE `ref_mensalidade` SET situacao='0', n_fatura = '0', data_pagamento = '0', valor_pago = '0', n_recibo = '0', quem_recebeu = '0'  WHERE (id_cliente = '$id' AND mes = '$mes' AND ano = '$ano')")or die (mysql_error());
	$mesa = getMesAbr($mes);
	$sql2 = mysql_query("UPDATE `mensalidades` SET ".$mesa."='0' WHERE (id_cliente = '$id' AND ano = '$ano')")or die (mysql_error());

if($edita_cliente == '1'){		
	if($sql1 && $sql2){/// SE CADASTRADO, ENVIA MENSAGEM INFORMANDO
		$endereco = $_SERVER['REQUEST_URI'];
			print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=editacliente.php?id=$id&p=1'>
			<script type=\"text/javascript\">
			
			</script>";
							
		} else { /// SE SIM ENVIA MENSAGEM E RETORNA PARA  A PÁGINA
			print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=editacliente.php?id=$id&p=1'>
			<script type=\"text/javascript\">
		
			</script>";	
		}
		
	} else {	
		if($sql1 && $sql2){/// SE CADASTRADO, ENVIA MENSAGEM INFORMANDO
			print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=editacliente.php?id=$id&p=1'>
			<script type=\"text/javascript\">
			
			</script>";
			print "<script type=\"text/javascript\"></script>";
	
		} else { /// SE SIM ENVIA MENSAGEM E RETORNA PARA  A PÁGINA
			print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=editacliente.php?id=$id&p=1'>
			<script type=\"text/javascript\">
			
			</script>";	
		}
		
		
		}
}

if(isset($_POST['cancelar'])){/// volta a pagina para caso seja cancelado

$id = $_GET['id'];///id do cliente
	$mes = $_GET['m'];
	$ano = $_GET['a'];
	$edita_cliente = $_GET['c'];
	if ($edita_cliente == '1'){
	print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=editacliente.php?id=$id&p=1'>";
	} else {
	print "<script type=\"text/javascript\">javascript:window.close()</script>";
		}
}
/////////////////////////////////////////////////////////////////////////////////////////////////////
	$id = $_GET['id'];///id do cliente
	$mes = $_GET['m'];
	$ano = $_GET['a'];
	$edita_cliente = $_GET['c'];
	
	$sql = mysql_query("SELECT * FROM cliente WHERE id_cliente='$id'")or die (mysql_error());
	$l = mysql_fetch_array($sql);
	
	$m = mysql_query("SELECT * FROM ref_mensalidade WHERE id_cliente = '$id' AND ano = '$ano' AND mes = '$mes'");
	$mensalidade = mysql_fetch_array($m);
	?>
	

<body onunload="fechajanela()">

<div id="conteudoform" style="padding:5px;background:#FFF;">

    <fieldset style="border:1px solid #666;"><legend><strong>Editar Mensalidade</strong></legend>
    <span>A mensalidade do <span style="color:#F00"><strong><?php echo $l['matricula'].' - '.$l['dir_culto']; ?></strong></span>, referente ao mês de <?php echo getMes($mes); ?> do ano de <?php echo $ano;?>?</span><br /><br />
	<form action="" method="post" enctype="multipart/form-data" id="ver_mensalidades">
		
        <input type="hidden" name="id1" value="<?php echo $id;?>">
        <input type="hidden" name="mes" value="<?php echo $mes;?>">
        <input type="hidden" name="ano" value="<?php echo $ano;?>">
        <?php if ($edita_cliente == '1'){ ?>
		<input type="hidden" name="edita_cliente" value="<?php echo $edita_cliente; ?>">
		<?php	} ?>
    <div class="linha">
    	<div class="coluna" style="width:140px;">Número da Fatura:<br/>
        <input type="text" name="n_fatura" style="width:110px;" value="<?php echo $mensalidade['n_fatura'];?>" placeholder="Digite o número da fatura ou forma de pagamento...">
		</div>
        <div class="coluna" style="width:120px;">
        <script type="text/javascript">		
			$(document).ready(function() {
      		  $("#valor_pago").maskMoney({decimal:".",thousands:""});
     			 });
		</script>
        Valor Pago:<br/>
        <input type="text" name="valor_pago" style="width:90px;" value="<?php echo number_format($mensalidade['valor_pago'], 2, ',', '.');?>" id="valor_pago">
		</div>
        <div class="coluna" style="width:150px;">Número do Recibo:<br/>
        <input type="text" name="n_recibo" style="width:120px;" value="<?php echo $mensalidade['n_recibo'];?>" placeholder="Digite o número do recibo...">
		</div>
        <div class="coluna" style="width:200px;">Quem recebeu?:<br/>
        <input type="text" name="quem_recebeu" value="<?php echo $mensalidade['quem_recebeu'];?>" style="width:170px;" placeholder="Nome da pessoa que recebeu o valor" onkeyup="up(this)">
		</div>
        <div class="coluna" style="width:120px;">Data de Pagamento:<br/>
        <input type="text" name="data_pagamento" value="<?php echo formatadatas($mensalidade['data_pagamento']);?>" style="width:100px;" placeholder="" id="data_pagamento">
		</div>
    </div>    
 	<div class="linha">
    <div class="coluna" style="width:150px;">
    <input name="pagar" type="submit" value="Editar Mensalidades" class="btn btn-success ewButton">
    </div>
    <div class="coluna" style="width:170px;">
    <input name="estornar" type="submit" value="Estornar Mensalidades" class="btn btn-danger ewButton">
    </div>
    <div class="coluna" style="width:150px;">
    <input name="cancelar" type="submit" value="Cancelar" class="btn btn-default ewButton">
    </div>
    
  </div>
</form>
</fieldset>
</div>
</body>
</html>