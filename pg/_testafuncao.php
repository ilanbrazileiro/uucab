<?php

set_time_limit(60);
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

include "../classes/conexao.php";
include "../classes/funcoes.class.php";
include "../classes/class.phpmailer.php";

//include "../php/config.php";
//include "../php/recordsets.php";

//atualizaPreMensalidades();

$ano = date("Y");

	$partes = explode("-", "2019-07-03");

	$mes = $partes[1];

	if ($mes == '12'){

		$mes = '1';

		$ano++;

	} else {

		$mes++;

	}

	echo $mes;
	echo "<br>";


?>