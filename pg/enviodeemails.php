<?php 
/*
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);
*/
include "classes/conexao.php";
$mail = new PHPMailer();

if(isset($_POST['envio'])){
	
	$html = $_POST['texto'];
	$emailcliente = $_POST['remetente'];
	
///Solução provisória

$emailcliente = explode("(", $emailcliente);

$nome_cliente = $emailcliente[0];
$email_cliente = $emailcliente[1];

$email_cliente = str_replace(")","",$email_cliente);

$sql = mysql_query("SELECT * FROM maile")or die (mysql_error());//Seleciona as configurações
$linha = mysql_fetch_array($sql);

$mail->IsSMTP();
$mail->isHTML( true );
$mail->Charset = 'UTF-8';
$mail->SMTPAuth = true;
//$mail->SMTPDebug = true;
$mail->SMTPSecure = 'SSL';
$mail->Host = $linha['url'];
$mail->Port = $linha['porta'];
$mail->Username = $linha['email'];
$mail->Password = $linha['senha'];
$mail->From = $linha['email'];
$mail->FromName = utf8_decode($linha['empresa']);
$mail->Subject = utf8_decode($_POST['assunto']);

	///// conta o tempo 
	$t = $linha['limitemail'] / 60;
	// zera o limite de tempo de execução do script
	set_time_limit(0);
	// eviar emails
	$cont = 0;

	$texto = $html;

	$mail->Body = $texto;
	$mail->AddAddress($email_cliente, $nome_cliente);

	$enviado = $mail->Send();

	$mail->ClearAllRecipients();
	$mail->ClearAttachments();

	if ($enviado) {
 	 echo "E-mail enviado com sucesso!";
	} else {
 	 echo "Não foi possível enviar o e-mail.";
 	 echo "<b>Informações do erro:</b> " . $mail->ErrorInfo;
	}	//fim do if					
}// fin do envio de emails


?>

<script type="text/javascript" src="jquery-autocomplete/lib/jquery.js"></script>
<script type="text/javascript" src="jquery-autocomplete/lib/jquery.bgiframe.min.js"></script>
<script type="text/javascript" src="jquery-autocomplete/lib/jquery.ajaxQueue.js"></script>
<script type="text/javascript" src="jquery-autocomplete/lib/thickbox-compressed.js"></script>
<script type="text/javascript" src="jquery-autocomplete/jquery.autocomplete.js"></script>
<!--css -->
<link rel="stylesheet" type="text/css" href="jquery-autocomplete/jquery.autocomplete.css"/>
<link rel="stylesheet" type="text/css" href="jquery-autocomplete/lib/thickbox.css"/>

 <script type="text/javascript">
 	$(document).ready(function(){
		$("#txtNome").autocomplete("completar.php", {
			width:310,
			selectFirst: false
		});
	});
 </script>

<div id="cabecalho"><h2><i class="icon-share "></i> Envio de E-mail</h2></div>


<form action="" method="post" enctype="multipart/form-data">

<strong>Remetente:</strong><br/>
<input name="remetente" type="text" value="" style="width:900px;" id="txtNome" class="input_forms"><br/>

<strong>Assunto do email:</strong><br/>
<input name="assunto" type="text" value="" style="width:900px;" placeholder="Digite o assunto do e-mail"><br/>

<strong>Texto do email:</strong><br/>
<textarea name="texto">

</textarea>

<br/>


<div class="control-groupa">
<div class="controlsa">
<button type="submit" class="btn btn-success ewButton" name="envio" id="btnsubmit" >
<i class="icon-thumbs-up icon-white"></i> Enviar E-mail</button>
</div>
</form>
</div>