<?php 

include '../classes/conexao.php';
include "../classes/funcoes.class.php";


if (isset($_GET['id'])){

	$cliente = getCliente($_GET['id']);

	include ("layout_contrato.php");


} else {

	print"
			<script type=\"text/javascript\">
			alert(\"NÃO FOI POSSÍVEL ENCONTRAR O CLIENTE!\");
			</script>";
}





 ?>