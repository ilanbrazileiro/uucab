<?php 
ob_start();
include '../classes/conexao.php';
	$id = $_GET['id'];
	$foto = $_GET['deleta'];

	if ($foto == 'foto_pres'){
		$sql = mysql_query("UPDATE cliente SET foto_pres = '' WHERE id_cliente='$id'")or die (mysql_error());
	} else if ($foto == 'foto_dir') {
		$sql = mysql_query("UPDATE cliente SET foto_dir = '' WHERE id_cliente='$id'")or die (mysql_error());
	} else if ($foto == 'assinatura') {
		$sql = mysql_query("UPDATE cliente SET assinatura = '' WHERE id_cliente='$id'")or die (mysql_error());
	}
header("Location:../pg/editacliente.php?id=".$id);
?>