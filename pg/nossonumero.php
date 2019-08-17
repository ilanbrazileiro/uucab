<?php 
session_start();
//se nao existir volta para a pagina do form de login
if(!isset($_SESSION['login_session']) and !isset($_SESSION['senha_session'])){
	header("Location:../index.php");
	exit;		
}

if(isset($_POST['increment'])){
	$numero = $_POST['numero'];
	$sql = mysql_query("ALTER TABLE faturas AUTO_INCREMENT =$numero") or die(mysql_error());
	
	$sqla = mysql_query("UPDATE bancos SET increment = '$numero'") or die(mysql_error());
	
	print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=?pg=numero'>
		  <script type=\"text/javascript\">
		  alert(\"Inicio do nosso numero alterado com sucesso.\");
		  </script>";	
	
}


$sqlbanco = $conecta->seleciona("SELECT * FROM faturas ORDER BY id_venda DESC")or die (mysql_error());
$linhas = mysql_fetch_array($sqlbanco);

$banco = $conecta->seleciona("SELECT * FROM bancos")or die (mysql_error());
$lin = mysql_fetch_array($banco);

?>
<div id="conteudoform">
<div id="entrada">
<div id="cabecalho">
<h2><i class="icon-file-text"></i> Configurar inicio do nosso numero</h2>
</div>
<div id="forms">
<strong>Obs: Após começar a gerar boletos não utilize mais este recurso.</strong>
<hr><br/><br/>
<form action="" method="post" enctype="multipart/form-data">
Nosso numero inicia em:<br/>
<input name="numero" type="text" value="<?php echo $lin['increment'] ?>"><br/>
<input name="increment" type="submit" value="Gravar" id="increment" class="btn btn-success">

</form>


</div></div></div>