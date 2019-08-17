<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Pagar Mensalidade</title>
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

 

 <script type="text/javascript">

 

function controlaCheck(){

	if(document.getElementById('check').checked == true){

			document.getElementById('checkLinha').style.visibility = 'visible';
			document.getElementById('buttonLinha').style.visibility = 'collapse';

	} else {
			document.getElementById('checkLinha').style.visibility = 'collapse';
			document.getElementById('buttonLinha').style.visibility = 'visible';
	}
}


function validar_uni() {
var n_fatura = form.n_fatura.value;
var valor_pago = form.valor_pago.value;
var n_recibo = form.n_recibo.value;
var quem_recebeu = form.quem_recebeu.value;
var data_pagamento = form.data_pagamento.value;
var mes_inicial = form.mes_inicial.value;
var ano_inicial = form.ano_inicial.value;
var mes_final = form.mes_final.value;
var ano_final = form.ano_final.value;


if (n_fatura == "") {	

alert('Digite o Número da Fatura. Caso não queira informar, favor preencher com 0!');
form.n_fatura.focus();
return false;
}

if (valor_pago == "") {	

alert('Digite o Valor Recebido. Caso não queira informar, favor preencher com 0!');

form.valor_pago.focus();

return false;

}

if (n_recibo == "") {	

alert('Digite o Número do Recibo. Caso não queira informar, favor preencher com 0!');

form.n_recibo.focus();

return false;

}

if (quem_recebeu == "") {	

alert('Digite a Pessoa que recebeu. Caso não queira informar, favor preencher com 0!');

form.quem_recebeu.focus();

return false;

}

if (data_pagamento == "") {	

alert('Digite a data de pagamento. Caso não queira informar, favor preencher com 0!');

form.data_pagamento.focus();

return false;

}

if(document.getElementById('check').checked == true){
	if (mes_inicial == "" || mes_inicial == '---') {	
		alert('Selecione corretamente o mês inicial de pagamento');
		form.data_pagamento.focus();
		return false;
	}

	if (ano_inicial == "" || ano_inicial == '---') {	
		alert('Selecione corretamente o ano inicial de pagamento');
		form.data_pagamento.focus();
		return false;
	}

	if (mes_final == "" || mes_final == '---') {	
		alert('Selecione corretamente o mês final de pagamento');
		form.data_pagamento.focus();
		return false;
	}

	if (ano_final == "" || ano_final == '---') {	
		alert('Selecione corretamente o ano final de pagamento');
		form.data_pagamento.focus();
		return false;
	}
}


}/* Fecha função*/

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
	$p = $_POST['p'];
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

			print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=editacliente.php?id=$id&p=$p'>

			<script type=\"text/javascript\">

			

			</script>";

				

		} else { /// SE SIM ENVIA MENSAGEM E RETORNA PARA  A PÁGINA

			print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=?pg=editacliente&id=$id&p=$p'>

			<script type=\"text/javascript\">

			

			</script>";	

		}

		

	} else {	

		if($sql1 && $sql2){/// SE CADASTRADO, ENVIA MENSAGEM INFORMANDO

			print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=editacliente.php?id=$id&p=$p'>

			<script type=\"text/javascript\">

			

			</script>";

			print "<script type=\"text/javascript\"></script>";

	

		} else { /// SE SIM ENVIA MENSAGEM E RETORNA PARA  A PÁGINA

			print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=editacliente.php?id=$id&p=$p'>

			<script type=\"text/javascript\">

			

			</script>";	

		}

	}

}



///////////////////////////////////////PAGA A MENSALIDADE DE TODO O ANO RESTANTE////////////////////

if(isset($_POST['pagar_ano'])){

	

	echo $id = $_POST['id1'];

	$mes = $_POST['mes'];

	$ano = $_POST['ano'];

	$edita_cliente = $_POST['edita_cliente'];

	$p = $_POST['p'];

	$data = formataDatasBD($_POST['data_pagamento']);

	$n_fatura = $_POST['n_fatura'];

	$valor_pago = $_POST['valor_pago'];

	$n_recibo = $_POST['n_recibo'];

	$quem_recebeu = $_POST['quem_recebeu'];

	

	$sql1 = mysql_query("UPDATE `ref_mensalidade` SET situacao='1', n_fatura = '$n_fatura', data_pagamento = '$data', valor_pago = '$valor_pago', n_recibo = '$n_recibo', quem_recebeu = '$quem_recebeu' WHERE (id_cliente = '$id' AND ano = '$ano')")or die (mysql_error());

	

	$mesa = getMesAbr($mes);

	$sql2 = mysql_query("UPDATE `mensalidades` SET 

	jan ='1',

	fev ='1',

	mar ='1',

	abr ='1',

	mai ='1',

	jun ='1',

	jul ='1',

	ago ='1',

	setembro ='1',

	outubro ='1',

	nov ='1',

	dez ='1'

			WHERE (id_cliente = '$id' AND ano = '$ano')")or die (mysql_error());

		

	if($edita_cliente == '1'){

		if($sql1 && $sql2){/// SE CADASTRADO, ENVIA MENSAGEM INFORMANDO

		$endereco = $_SERVER['REQUEST_URI'];

			print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=editacliente.php?id=$id&p=$p'>

			<script type=\"text/javascript\">

			

			</script>";

				

		} else { /// SE SIM ENVIA MENSAGEM E RETORNA PARA  A PÁGINA

			print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=?pg=editacliente&id=$id&p=$p'>

			<script type=\"text/javascript\">

			

			</script>";	

		}

		

	} else {	

		if($sql1 && $sql2){/// SE CADASTRADO, ENVIA MENSAGEM INFORMANDO

			print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=editacliente.php?id=$id&p=$p'>

			<script type=\"text/javascript\">

			

			</script>";

			print "<script type=\"text/javascript\"></script>";

	

		} else { /// SE SIM ENVIA MENSAGEM E RETORNA PARA  A PÁGINA

			print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=editacliente.php?id=$id&p=$p'>

			<script type=\"text/javascript\">

			

			</script>";	

		}

	}

}



//////////////////////////////////////PAGAR POR INTERVALO///////////////////////////////////////

if(isset($_POST['pagar_intervalo'])){

	$id_cliente = $_POST['id1'];

	$mi = $_POST['mes_inicial']; $mf = $_POST['mes_final'];
	$ai = $_POST['ano_inicial']; $af = $_POST['ano_final'];

	$edita_cliente = $_POST['edita_cliente'];

	$p = $_POST['p'];
	$dbaixa = formataDatasBD($_POST['data_pagamento']);
	$nm = $_POST['n_fatura'];
	$valor = $_POST['valor_pago'];
	$n_recibo = $_POST['n_recibo'];
	$quem_recebeu = $_POST['quem_recebeu'];

					$cont = $ai;
					while ($af >= $cont){
						$v = verificaGerarMensalidade($id_cliente,$cont,$mi);
						$cont++;
					}

				$qtd_mes = contaMeses ($mi,$ai,$mf,$af);
				
  				for ($i=0;$i < $qtd_mes; $i++){
					$mes_verificar = $mi + $i;
					$ano_verificar = $ai;

					if ($mes_verificar > 12 && $mes_verificar <= 24){
						$mes_verificar = $mes_verificar - 12;
						$ano_verificar = $ano_verificar + 1;

						$sql1 = mysql_query("UPDATE `ref_mensalidade` SET situacao='1', n_fatura = '$nm', data_pagamento = '$dbaixa', quem_recebeu = '$quem_recebeu', n_recibo = '$n_recibo', valor_pago = '$valor' WHERE (id_cliente = '$id_cliente' AND mes = '$mes_verificar' AND ano = '$ano_verificar')")or die (mysql_error());

						$mes_verificar = getMesAbr($mes_verificar);

						$sql2 = mysql_query("UPDATE `mensalidades` SET ".$mes_verificar."='1' WHERE id_cliente = '$id_cliente' AND ano = '$ano_verificar'")or die (mysql_error());

					} else if ($mes_verificar > 24 && $mes_verificar <= 36){

						$mes_verificar = $mes_verificar - 24;
						$ano_verificar = $ano_verificar + 2;

						$sql1 = mysql_query("UPDATE `ref_mensalidade` SET situacao='1', n_fatura = '$nm', data_pagamento = '$dbaixa', quem_recebeu = '$quem_recebeu', n_recibo = '$n_recibo', valor_pago = '$valor' WHERE (id_cliente = '$id_cliente' AND mes = '$mes_verificar' AND ano = '$ano_verificar')")or die (mysql_error());

						$mes_verificar = getMesAbr($mes_verificar);

						$sql2 = mysql_query("UPDATE `mensalidades` SET ".$mes_verificar."='1' WHERE id_cliente = '$id_cliente' AND ano = '$ano_verificar'")or die (mysql_error());					

					} else if ($mes_verificar > 36 && $mes_verificar <= 48){
						$mes_verificar = $mes_verificar - 36;
						$ano_verificar = $ano_verificar + 3;

						$sql1 = mysql_query("UPDATE `ref_mensalidade` SET situacao='1', n_fatura = '$nm', data_pagamento = '$dbaixa', quem_recebeu = '$quem_recebeu', n_recibo = '$n_recibo', valor_pago = '$valor' WHERE (id_cliente = '$id_cliente' AND mes = '$mes_verificar' AND ano = '$ano_verificar')")or die (mysql_error());

						$mes_verificar = getMesAbr($mes_verificar);
						$sql2 = mysql_query("UPDATE `mensalidades` SET ".$mes_verificar."='1' WHERE id_cliente = '$id_cliente' AND ano = '$ano_verificar'")or die (mysql_error());					

					} else if ($mes_verificar > 48 && $mes_verificar <= 60){
						$mes_verificar = $mes_verificar - 48;
						$ano_verificar = $ano_verificar + 4;

						$sql1 = mysql_query("UPDATE `ref_mensalidade` SET situacao='1', n_fatura = '$nm', data_pagamento = '$dbaixa', quem_recebeu = '$quem_recebeu', n_recibo = '$n_recibo', valor_pago = '$valor' WHERE (id_cliente = '$id_cliente' AND mes = '$mes_verificar' AND ano = '$ano_verificar')")or die (mysql_error());

						$mes_verificar = getMesAbr($mes_verificar);
						$sql2 = mysql_query("UPDATE `mensalidades` SET ".$mes_verificar."='1' WHERE id_cliente = '$id_cliente' AND ano = '$ano_verificar'")or die (mysql_error());	

					} else if ($mes_verificar > 60 && $mes_verificar <= 72){
						$mes_verificar = $mes_verificar - 60;
						$ano_verificar = $ano_verificar + 5;

						$sql1 = mysql_query("UPDATE `ref_mensalidade` SET situacao='1', n_fatura = '$nm', data_pagamento = '$dbaixa', quem_recebeu = '$quem_recebeu', n_recibo = '$n_recibo', valor_pago = '$valor' WHERE (id_cliente = '$id_cliente' AND mes = '$mes_verificar' AND ano = '$ano_verificar')")or die (mysql_error());

						$mes_verificar = getMesAbr($mes_verificar);
						$sql2 = mysql_query("UPDATE `mensalidades` SET ".$mes_verificar."='1' WHERE id_cliente = '$id_cliente' AND ano = '$ano_verificar'")or die (mysql_error());	

					} else if ($mes_verificar > 72){
						$mes_verificar = $mes_verificar - 72;
						$ano_verificar = $ano_verificar + 6;

						$sql1 = mysql_query("UPDATE `ref_mensalidade` SET situacao='1', n_fatura = '$nm', data_pagamento = '$dbaixa', quem_recebeu = '$quem_recebeu', n_recibo = '$n_recibo', valor_pago = '$valor' WHERE (id_cliente = '$id_cliente' AND mes = '$mes_verificar' AND ano = '$ano_verificar')")or die (mysql_error());

						$mes_verificar = getMesAbr($mes_verificar);
						$sql2 = mysql_query("UPDATE `mensalidades` SET ".$mes_verificar."='1' WHERE id_cliente = '$id_cliente' AND ano = '$ano_verificar'")or die (mysql_error());

					} else {

						$sql1 = mysql_query("UPDATE `ref_mensalidade` SET situacao='1', n_fatura = '$nm', data_pagamento = '$dbaixa', quem_recebeu = '$quem_recebeu', n_recibo = '$n_recibo', valor_pago = '$valor' WHERE (id_cliente = '$id_cliente' AND mes = '$mes_verificar' AND ano = '$ano_verificar')")or die (mysql_error());

						$mes_verificar = getMesAbr($mes_verificar);

						$sql2 = mysql_query("UPDATE `mensalidades` SET ".$mes_verificar."='1' WHERE id_cliente = '$id_cliente' AND ano = '$ano_verificar'")or die (mysql_error());
					}
				}//fim do for

	if($edita_cliente == '1'){

		if($sql1 && $sql2){/// SE CADASTRADO, ENVIA MENSAGEM INFORMANDO

		$endereco = $_SERVER['REQUEST_URI'];

			print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=editacliente.php?id=$id_cliente&p=$p'>
			<script type=\"text/javascript\">
			</script>";
		} else { /// SE SIM ENVIA MENSAGEM E RETORNA PARA  A PÁGINA

			print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=?pg=editacliente&id=$id_cliente&p=$p'>
			<script type=\"text/javascript\">
			</script>";	
		}

	} else {	

		if($sql1 && $sql2){/// SE CADASTRADO, ENVIA MENSAGEM INFORMANDO

			print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=editacliente.php?id=$id_cliente&p=$p'>
			<script type=\"text/javascript\">
			</script>";
			print "<script type=\"text/javascript\"></script>";

		} else { /// SE SIM ENVIA MENSAGEM E RETORNA PARA  A PÁGINA

			print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=editacliente.php?id=$id_cliente&p=$p'>
			<script type=\"text/javascript\">
			</script>";	
		}
	}
}



//////////////////////////////////////PAGAR POR INTERVALO///////////////////////////////////////

if(isset($_POST['anistiar_intervalo'])){

	

	echo $id_cliente = $_POST['id1'];

	$mi = $_POST['mes_inicial']; $mf = $_POST['mes_final'];

	$ai = $_POST['ano_inicial']; $af = $_POST['ano_final'];

	$edita_cliente = $_POST['edita_cliente'];

	$p = $_POST['p'];

	$dbaixa = formataDatasBD($_POST['data_pagamento']);

	$nm = $_POST['n_fatura'];

	$valor = $_POST['valor_pago'];

	$n_recibo = $_POST['n_recibo'];

	$quem_recebeu = $_POST['quem_recebeu'];

	

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

						

						$sql1 = mysql_query("UPDATE `ref_mensalidade` SET situacao='5', n_fatura = '$nm', data_pagamento = '$dbaixa', quem_recebeu = '$quem_recebeu', n_recibo = '$n_recibo', valor_pago = '$valor' WHERE (id_cliente = '$id_cliente' AND mes = '$mes_verificar' AND ano = '$ano_verificar')")or die (mysql_error());

						$mes_verificar = getMesAbr($mes_verificar);

						$sql2 = mysql_query("UPDATE `mensalidades` SET ".$mes_verificar."='5' WHERE id_cliente = '$id_cliente' AND ano = '$ano_verificar'")or die (mysql_error());

											

					} else if ($mes_verificar > 24){

						$mes_verificar = $mes_verificar - 24;

						$ano_verificar = $ano_verificar + 2;

						

						$sql1 = mysql_query("UPDATE `ref_mensalidade` SET situacao='5', n_fatura = '$nm', data_pagamento = '$dbaixa', quem_recebeu = '$quem_recebeu', n_recibo = '$n_recibo', valor_pago = '$valor' WHERE (id_cliente = '$id_cliente' AND mes = '$mes_verificar' AND ano = '$ano_verificar')")or die (mysql_error());

						$mes_verificar = getMesAbr($mes_verificar);

						$sql2 = mysql_query("UPDATE `mensalidades` SET ".$mes_verificar."='5' WHERE id_cliente = '$id_cliente' AND ano = '$ano_verificar'")or die (mysql_error());					

						} else {

						$sql1 = mysql_query("UPDATE `ref_mensalidade` SET situacao='5', n_fatura = '$nm', data_pagamento = '$dbaixa', quem_recebeu = '$quem_recebeu', n_recibo = '$n_recibo', valor_pago = '$valor' WHERE (id_cliente = '$id_cliente' AND mes = '$mes_verificar' AND ano = '$ano_verificar')")or die (mysql_error());

						$mes_verificar = getMesAbr($mes_verificar);

						$sql2 = mysql_query("UPDATE `mensalidades` SET ".$mes_verificar."='5' WHERE id_cliente = '$id_cliente' AND ano = '$ano_verificar'")or die (mysql_error());

						}

				}//fim do for

	

	

	

	if($edita_cliente == '1'){

		if($sql1 && $sql2){/// SE CADASTRADO, ENVIA MENSAGEM INFORMANDO

		$endereco = $_SERVER['REQUEST_URI'];

			print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=editacliente.php?id=$id_cliente&p=$p'>

			<script type=\"text/javascript\">

			

			</script>";

				

		} else { /// SE SIM ENVIA MENSAGEM E RETORNA PARA  A PÁGINA

			print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=?pg=editacliente&id=$id_cliente&p=$p'>

			<script type=\"text/javascript\">

			

			</script>";	

		}

		

	} else {	

		if($sql1 && $sql2){/// SE CADASTRADO, ENVIA MENSAGEM INFORMANDO

			print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=editacliente.php?id=$id_cliente&p=$p'>

			<script type=\"text/javascript\">

			

			</script>";

			print "<script type=\"text/javascript\"></script>";

	

		} else { /// SE SIM ENVIA MENSAGEM E RETORNA PARA  A PÁGINA

			print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=editacliente.php?id=$id_cliente&p=$p'>

			<script type=\"text/javascript\">

			

			</script>";	

		}

	}

}



////////////////////////////     CODGIO PARA GERAR AS MENSALIDADES 

if(isset($_POST['anistiar'])){

	

	echo $id = $_POST['id1'];

	$mes = $_POST['mes'];

	$ano = $_POST['ano'];

	$edita_cliente = $_POST['edita_cliente'];

	$p = $_POST['p'];

	$data = formataDatasBD($_POST['data_pagamento']);

	$n_fatura = $_POST['n_fatura'];

	$valor_pago = $_POST['valor_pago'];

	$n_recibo = $_POST['n_recibo'];

	$quem_recebeu = $_POST['quem_recebeu'];

	

	$sql1 = mysql_query("UPDATE `ref_mensalidade` SET situacao='5', n_fatura = '$n_fatura', data_pagamento = '$data', valor_pago = '$valor_pago', n_recibo = '$n_recibo', quem_recebeu = '$quem_recebeu' WHERE (id_cliente = '$id' AND mes = '$mes' AND ano = '$ano')")or die (mysql_error());

	

	$mesa = getMesAbr($mes);

	echo $mesa;

	$sql2 = mysql_query("UPDATE `mensalidades` SET ".$mesa."='5' WHERE (id_cliente = '$id' AND ano = '$ano')")or die (mysql_error());

		

	if($edita_cliente == '1'){

		if($sql1 && $sql2){/// SE CADASTRADO, ENVIA MENSAGEM INFORMANDO

		$endereco = $_SERVER['REQUEST_URI'];

			print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=editacliente.php?id=$id&p=$p'>

			<script type=\"text/javascript\">

			

			</script>";

				

		} else { /// SE SIM ENVIA MENSAGEM E RETORNA PARA  A PÁGINA

			print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=?pg=editacliente&id=$id&p=$p'>

			<script type=\"text/javascript\">

			

			</script>";	

		}

		

	} else {	

		if($sql1 && $sql2){/// SE CADASTRADO, ENVIA MENSAGEM INFORMANDO

			print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=editacliente.php?id=$id&p=$p'>

			<script type=\"text/javascript\">

			

			</script>";

			print "<script type=\"text/javascript\"></script>";

	

		} else { /// SE SIM ENVIA MENSAGEM E RETORNA PARA  A PÁGINA

			print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=editacliente.php?id=$id&p=$p'>

			<script type=\"text/javascript\">

			

			</script>";	

		}

	}

}





/////////////////////////////////////////////////////////////////////////////////////////////////////

	$id = $_GET['id'];

	$mes = $_GET['m'];

	$ano = $_GET['a'];

	$edita_cliente = $_GET['c'];

	$p = $_GET['p'];//recebe a página no listar cliente

	

	$sql = mysql_query("SELECT * FROM cliente WHERE id_cliente='$id'")or die (mysql_error());

	$l = mysql_fetch_array($sql);

	

	?>



<body onunload="fechajanela(<?php echo $edita_cliente; ?>)">

<div id="conteudoform" style="padding:5px;background:#FFF;">



    <fieldset style="border:1px solid #666;"><legend><strong>Pagar Mensalidades</strong></legend>

    <span>Pagar a mensalidade do <span style="color:#F00"><strong><?php echo $l['matricula'].' - '.$l['dir_culto']; ?></strong></span>, referente ao mês de <?php echo getMes($mes); ?> do ano de <?php echo $ano;?>?</span><br /><br />

	<form action="" method="post" enctype="multipart/form-data" id="gerar_mensalidades" name="form" onSubmit="return validar_uni(this);">

		

        <input type="hidden" name="id1" value="<?php echo $id;?>">

        <input type="hidden" name="mes" value="<?php echo $mes;?>">

        <input type="hidden" name="ano" value="<?php echo $ano;?>">

        <input type="hidden" name="p" value="<?php echo $p;//Passa a página a ser retornada?>">

        <?php if ($edita_cliente == '1'){ ?>

		<input type="hidden" name="edita_cliente" value="<?php echo $edita_cliente; ?>">

		<?php	} ?>

    <div class="linha">

    	<div class="coluna" style="width:190px;">Número da Fatura:<br/>

        <input type="text" name="n_fatura" style="width:160px;" value="" placeholder="Digite o número da fatura ou forma de pagamento...">

		</div>

        <div class="coluna" style="width:130px;">

        <script type="text/javascript">		

			$(document).ready(function() {

      		  $("#valor_pago").maskMoney({decimal:".",thousands:""});

     			 });

		</script>

       Valor Pago:<br/>

        <input type="text" name="valor_pago" style="width:90px;" value="" id="valor_pago">

		</div>

        <div class="coluna" style="width:150px;">Número do Recibo:<br/>

        <input type="text" name="n_recibo" style="width:120px;" value="" placeholder="Digite o número do recibo...">

		</div>

        <div class="coluna" style="width:200px;">Quem recebeu?:<br/>

        <input type="text" name="quem_recebeu" value="" style="width:170px;" placeholder="Nome da pessoa que recebeu o valor" onkeyup="up(this)">

		</div>

        <div class="coluna" style="width:120px;">Data de Pagamento:<br/>

        <input type="text" name="data_pagamento" value="" style="width:100px;" placeholder="" id="data_pagamento">

		</div>

    </div>

    

    <div class="linha">

    <div class="coluna" style="width:300px;">

    <input name="check" type="checkbox" id="check" onClick="controlaCheck()"> Marque para registrar por intervalo

    </div>

    </div>

    

    <div class="linha" id="checkLinha" style="visibility:collapse">

    <div class="coluna" style="width:900px;">

   <select name="mes_inicial" style="width:100px;" id="mes_inicial">

    <option> --- </option>

    <?php echo geraOptionMeses();?>

    </select>

    /

    <select name="ano_inicial" style="width:100px;" id="ano_inicial">

    <option> --- </option>

    <?php for ($i=2015;$i<=2040;$i++){

			echo "<option value='$i'>$i</option>";

		  }?>

     </select> 

     a

     <select name="mes_final" style="width:100px;" id="mes_final">

    <option> --- </option>

    <?php echo geraOptionMeses();?>

    </select>

    /

    <select name="ano_final" style="width:100px;" id="ano_final">

    <option> --- </option>

    <?php for ($i=2015;$i<=2040;$i++){

			echo "<option value='$i'>$i</option>";

		  }?>

     </select> 



    </div>

    

     <div class="coluna" style="width:245px;">

    <input name="pagar_intervalo" type="submit" value="Pagar o intervalo" class="btn btn-success ewButton">

    </div>

    <div class="coluna" style="width:245px;">

    <input name="anistiar_intervalo" type="submit" value="Anistiar o intervalo" class="btn btn-primary ewButton">

    </div>

    </div>

       

 	<div class="linha" id="buttonLinha">

    <div class="coluna" style="width:160px;">

    <input name="pagar" type="submit" value="Pagar Mensalidades" class="btn btn-success ewButton">

    </div>

     <div class="coluna" style="width:160px;">

    <input name="anistiar" type="submit" value="Anistiar Mensalidade" class="btn btn-primary ewButton">

    </div>

     <div class="coluna" style="width:245px;">

    <input name="pagar_ano" type="submit" value="Pagar Mensalidades de Todo o Ano" class="btn btn-danger ewButton">

    </div>

    </div>



</form>

</fieldset>

</div>

</body>

</html>