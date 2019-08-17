<?php
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

include "../classes/conexao.php";
include "../classes/funcoes.class.php";


/*
	$ano = 2017;// ANO ESCOLHIDO PARA GERAR AS MENSALIDADES
	
	$sql = mysql_query("SELECT * FROM cliente")or die (mysql_error());//GET CLIENTE
while($l = mysql_fetch_array($sql)){
	$matricula_cliente = $l['matricula'];
	$id_cliente = $l['id_cliente'];

	
				
		$sql1 = mysql_query("INSERT INTO `mensalidades`(`id_mensalidade`, `id_cliente`, `matricula_cliente`, `ano`, `jan`, `fev`, `mar`, `abr`, `mai`, `jun`, `jul`, `ago`, `setembro`, `outubro`, `nov`, `dez`) VALUES ('','$id_cliente','$matricula_cliente','$ano','0','0','0','0','0','0','0','0','0','0','0','0')")or die (mysql_error());
		
		for ($i = 1; $i <= 12; $i++){
			$sqlm = mysql_query("INSERT INTO `ref_mensalidade`(`id`, `id_mensalidade`, `id_cliente`, `situacao`, `data_pagamento`, `n_fatura`, `mes`, `ano`) VALUES ('','','$id_cliente','0','','','$i','$ano')")or die (mysql_error()); 
			}
	
		if($sql1 == 1){/// SE CADASTRADO, ENVIA MENSAGEM INFORMANDO
			echo 'cadastrado';
		} else { /// SE SIM ENVIA MENSAGEM E RETORNA PARA  A PÁGINA
		echo 'não cadastrado';
		}
		}
*/
?>