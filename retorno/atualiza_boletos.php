<?php

ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

include "../classes/conexao.php";
include "../classes/funcoes.class.php";

	$ano = '2019';
	$sql = mysql_query("SELECT * FROM cliente WHERE situacao='V' ORDER BY id_cliente DESC")or die (mysql_error());

	$cont = 0;
while($l = mysql_fetch_array($sql)){
	$id = $l['id_cliente'];
	$matricula_cliente = $l['matricula'];
	
	$cont = $cont+1;

	//// TESTA SE AS MENSALIDADES JÁ FORAM INSERIDAS
	$sqla = mysql_query("SELECT * FROM mensalidades WHERE id_cliente='$id' AND ano='$ano'")or die (mysql_error());
	$l2 = mysql_fetch_array($sqla);
	$idc = $l2['id_cliente']; $anoc = $l2['ano'];
	
	if ($id != $l2['id_cliente'] && $ano != $l2['ano']){//SE NÃO INSERE
				
		$sql = mysql_query("INSERT INTO `mensalidades`(`id_mensalidade`, `id_cliente`, `matricula_cliente`, `ano`, `jan`, `fev`, `mar`, `abr`, `mai`, `jun`, `jul`, `ago`, `setembro`, `outubro`, `nov`, `dez`) VALUES ('','$id','$matricula_cliente','$ano','0','0','0','0','0','0','0','0','0','0','0','0')")or die (mysql_error());
		
		for ($i = 1; $i <= 12; $i++){
			$sqlm = mysql_query("INSERT INTO `ref_mensalidade`(`id`, `id_mensalidade`, `id_cliente`, `situacao`, `data_pagamento`, `n_fatura`, `mes`, `ano`) VALUES ('','','$id','0','','','$i','$ano')")or die (mysql_error()); 
			}
	}
		
	}
	echo $cont;  
?>