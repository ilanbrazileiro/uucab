<?php 
$filename = 'classes/conexao.php';
if (!file_exists($filename)) {
	header("Location:setup/instalar.php");
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

if(isset($_POST['reenviar'])){
	$emailbank = $d['email'];  
	$email = $_POST['email'];
	
	if($emailbank == $email){
		
require "classes/class.phpmailer.php";

$sql = mysql_query("SELECT * FROM maile")or die (mysql_error());
$linha = mysql_fetch_array($sql);

$us = mysql_query("SELECT * FROM usuario") or die(mysql_error());
$user = mysql_fetch_array($us);
$login = $user['login'];
$senha = $user['senha'];
$mailer = $d['email'];


$mail = new PHPMailer();
// define que será usado SMTP
$mail->IsSMTP();
 
// envia email HTML
$mail->isHTML( true );
 
// codificação UTF-8, a codificação mais usada recentemente
$mail->Charset = 'UTF-8';
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'SSL';
$mail->Host = $linha['url'];
$mail->Port = $linha['porta'];
$mail->Username = $linha['email'];
$mail->Password = $linha['senha'];
 
// E-Mail do remetente (deve ser o mesmo de quem fez a autenticação
// nesse caso seu_login@gmail.com)
$mail->From = $linha['email'];
 
// Nome do rementente
$mail->FromName = $linha['empresa'];
 
// assunto da mensagem
$mail->Subject = utf8_decode("Recuperação de senha UUCAB - boletos");
// corpo da mensagem
$texto = utf8_decode("
	Está mensagem é referente ao seu pedido de recuperação de senha:<br/>
	<p>Seu login: $login</p>
	<p>Sua senha: $senha</p>
	<p></p>
	<p>Se você acha que não deveria ter recebido este e-mail, por favor ignore!</p>
");

$mail->Body = $texto;
$mail->AddAddress($mailer);

 
// verifica se enviou corretamente
if ( $mail->Send() )
{
	 print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=index.php'>
			<script type=\"text/javascript\">
			alert(\"SEUS DADOS DE ACESSO FORAM ENVIADOS PARA SEU EMAIL.!\");
			</script>";
}
else
{
			 print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=recoverpass.php'>
			<script type=\"text/javascript\">
			alert(\" ERRO: O email não foi enviado. Por favor revise os dados na configuração do email.\");
			</script>";
}

		
		
		
		
	}else{
			print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=recoverpass.php'>
			<script type=\"text/javascript\">
			alert(\" ERRO: O email digitado não confere.\");
			</script>";	
	}
	
}

?>

<title>.: <?php echo $d['nome']; ?> -  GERENCIADOR DE BOLETOS :.</title>
<link href="css/log.css" rel="stylesheet" type="text/css">
<style type="text/css">
#rec{ margin-left:30px; margin-top:-75px; margin-left:150px;}
a.rec:link, a.rec:active, a.rec:visited{text-decoration:none; color:#00F; font-size:12px;}
a.rec:hover{color:#F90;}
</style>
</head>

<body>
<div id="topo"></div>
<div id="entrada">
<div id="top">Versão 2.1.2 - Recuperar senha</div>
<div id="form">
<form action="" method="post" enctype="multipart/form-data">
	<span class="texto">E-mail Cadastrado nas configurações</span><BR/>
  	<input name="email" type="text" class="imput"><br/>
    <input name="reenviar" type="submit" value="Reenviar senha" id="reenviar" class="botao"> 
   <!-- <span class="senha"><a href="#">Esqueci minha senha</a></span>-->
</form>
<?php 
if(isset($_GET['login_errado']) == "erro"){
	echo "<div id='erro'>*Dados não conferem. Tente novamente!</div>";	
}
?>
</div>
<div id="logo"><br/><br/><img src="img/griff.png" width="200" height="130">
</div>
</div>


</body>
</html>