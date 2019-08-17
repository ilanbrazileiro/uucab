<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>.: UUCAB - Boletos :.</title>
</head>
<body>
<?php
/////////////////////////////////////////////////////////////////////////////////////
//                 ATENÇÂO!!!
//
//
//       Esse arquivo não faz parte do sistema! Apenas para testes de emails
//
//
//
////////////////////////////////////////////////////////////////////////////////////


//Inclui a conexão com o banco de dados
require ("../classes/conexao.php");
//recupera a página atual
if(isset($_GET['p']) && !empty($_GET['p'])){
$p = $_GET['p'];
}else{
$p = 1;	
}

//Inclui a classe phpmailer
require ("../classes/class.phpmailer.php");

$mail = new phpmailer();
	//Tell PHPMailer to use SMTP
	$mail->isSMTP();
	$mail->CharSet = 'UTF-8';
	$mail->SMTPSecure = 'SSL'; // or ssl
	$mail->SMTPAuth = true;
	$mail->SMTPDebug = 2;
	$mail->Debugoutput = 'html';
	$mail->Host = "smtp.uucab.com.br";
	$mail->Port = 587;// 25, 465 for ssl or 587 for tls
	$mail->Username = 'boletos@uucab.com.br';
	$mail->Password = 'Uniao#2013';
	$mail->setFrom('boletos@uucab.com.br','UUCAB');
	//$mail->addReplyTo('my_email@example.com', 'example.com');
	$mail->addAddress('ilanbrazileiro@gmail.com',"ilan");
	$mail->Subject = 'Oi Ilan eu sou o UUCAB União';
	$mail->Body = 'Que sacrificio para fazer funcionar';
	$mail->AltBody = 'Não sei o que isso significa';
	
	//send the message, check for errors
	if (!$mail->send()) {
	    echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
	    echo "Message sent!";
	}

?>
</body>
</html>