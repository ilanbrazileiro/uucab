<?php 
include '../classes/conexao.php';

$sqlm = mysql_query("SELECT * FROM bancos WHERE situacao = '1'") or die(mysql_error());
$dados = mysql_fetch_array($sqlm);
$id = $dados['id_banco'];
switch($id){
	case '1';
	include 'boleto_bb_m.php';
	break;
	
	case '2';
	include 'boleto_bradesco_m.php';
	break;
	
	case '3';
	include 'boleto_cef_sigcb_m.php';
	break;
	
	case '4';
	include 'boleto_itau_m.php';
	break;
	
	case '5';
	include 'santander_m.php';
	break;
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Lista de boletos/title>
</head>

<body>
</body>
</html>