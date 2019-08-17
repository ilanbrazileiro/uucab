<?php 

//Este Arquivo Atualiza das mensalidades (Vencidas ou não)
//Ele deve ser configurado atraves do Cron para ser executado uma vez por dia

include "../classes/conexao.php";
require '../classes/class.phpmailer.php';

$mes_atual = date('n');
$ano_atual = date('Y');
$ano_anterior = $ano_atual - 1;

if ($mes_atual == 2){//FEVEREIRO
	$atualiza = mysql_query("UPDATE mensalidades SET jan = '2' WHERE jan = '0' AND ano = '$ano_atual'");
} else if ($mes_atual == 3){//MARÇO
	$atualiza = mysql_query("UPDATE mensalidades SET fev = '2' WHERE fev = '0' AND ano = '$ano_atual'");
} else if ($mes_atual == 4){//ABRIL
	$atualiza = mysql_query("UPDATE mensalidades SET mar = '2' WHERE mar = '0' AND ano = '$ano_atual'");
} else if ($mes_atual == 5){//MAIO
	$atualiza = mysql_query("UPDATE mensalidades SET abr = '2' WHERE abr = '0' AND ano = '$ano_atual'");
} else if ($mes_atual == 6){//JUNHO
	$atualiza = mysql_query("UPDATE mensalidades SET mai = '2' WHERE mai = '0' AND ano = '$ano_atual'");
} else if ($mes_atual == 7){//JULHO
	$atualiza = mysql_query("UPDATE mensalidades SET jun = '2' WHERE jun = '0' AND ano = '$ano_atual'");
} else if ($mes_atual == 8){//AGOSTO
	$atualiza = mysql_query("UPDATE mensalidades SET jul = '2' WHERE jul = '0' AND ano = '$ano_atual'");
} else if ($mes_atual == 9){//SETEMBRO
	$atualiza = mysql_query("UPDATE mensalidades SET ago = '2' WHERE ago = '0' AND ano = '$ano_atual'");
} else if ($mes_atual == 10){//OUTUBRO
	$atualiza = mysql_query("UPDATE mensalidades SET setembro = '2' WHERE setembro = '0' AND ano = '$ano_atual'");
} else if ($mes_atual == 11){//NOVEMBRO
	$atualiza = mysql_query("UPDATE mensalidades SET outubro = '2' WHERE outubro = '0' AND ano = '$ano_atual'");
} else if ($mes_atual == 12){//DEZEMBRO
	$atualiza = mysql_query("UPDATE mensalidades SET nov = '2' WHERE nov = '0' AND ano = '$ano_atual'");
} else if ($mes_atual == 1){//JANEIRO
	$atualiza = mysql_query("UPDATE mensalidades SET dez = '2' WHERE dez = '0' AND ano = '$ano_anterior'");////// A T EN Ç Ã O - TRATAR CMO EZCESSÃO!!!!!!!!!!!!!!!!!!!!
}

?>