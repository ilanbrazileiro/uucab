<?php 
session_start();
if(isset($_SESSION['login_session']) and isset($_SESSION['senha_session'])){
	header("Location:inicio.php?pg=inicio");
	exit;	
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?php 
require ("classes/conexao.php");
$sqld = mysql_query("SELECT * FROM config") or die(mysql_error());
$d = mysql_fetch_array($sqld);

if(isset($_GET['acao']) == "senha"){
	print "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=recoverpass.php'>";	
	
}

?>

<title>.: <?php echo $d['nome']; ?> -  GERENCIADOR DE BOLETOS :.</title>
<link href="css/log.css" rel="stylesheet" type="text/css">
<style type="text/css">
#rec{ margin-left:30px; margin-top:-75px; margin-left:150px; position:absolute;}
a.rec:link, a.rec:active, a.rec:visited{text-decoration:none; color:#00F; font-size:12px;}
a.rec:hover{color:#F90;}
</style>
</head>

<body>
<div id="topo"></div>
<div id="entrada">
<div id="top">UNIÃO ESPÍRITA - CNPJ: 31.987.175/0001-68</div>
<div id="form">
<form action="php/login.php" method="post" enctype="multipart/form-data">
	<span class="texto">Usuário:</span><BR/>
  	<input name="login" type="text" class="imput"><br/>
  	<span class="texto">senha:</span><BR/>
    <input name="senha" type="password" class="imput"><br/>
    <input name="logar" type="submit" value="Entrar" id="logar" class="botao"> 
   <!-- <span class="senha"><a href="#">Esqueci minha senha</a></span>-->
</form>
<?php 
if(isset($_GET['login_errado']) == "erro"){
	echo "<div id='erross'>*Dados não conferem. Tente novamente!</div>";	
}
?>
</div>
<div id="logo"><img src="img/griff.png" width="200" height="150">
</div>
<div id="rec"><a href="?acao=senha" class="rec">[+] ESQUECI MINHA SENHA</a></div>
</div>


</body>
</html>