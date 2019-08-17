<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>.: UUCAB - Boletos :.</title>
</head>
<body>
<?php
//Inclui a conexão com o banco de dados
require ("../classes/conexao.php");

//recupera a página atual
if(isset($_GET['p']) && !empty($_GET['p'])){
$p = $_GET['p'];
}else{
$p = 1;	
}

//pega o id do cliente e da venda
$idCli = $_GET['idcliente'];
$idvenda = $_GET['id_venda'];

//retorna todos os clientes
$sql2 = mysql_query("SELECT * FROM cliente WHERE id_cliente='$idCli'")or die (mysql_error());
$l = mysql_fetch_array($sql2);

$cliente = $l['dir_culto'];//nome do diretor
$emailcliente = $l['email'];//email do cliente
$alternativo = $l['email2'];



//pega as configurações de envio de email
$sql = mysql_query("SELECT * FROM maile")or die (mysql_error());
$linha = mysql_fetch_array($sql);

$host = $linha['url'];

$empresa = $linha['empresa'];

$endereco = $linha['endereco'];

$email = $linha['email'];

$html = $linha['text1'];



function base64url_encode($data) {

			return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');

			}

//Inclui a classe phpmailer

require ("../classes/class.phpmailer.php");



//					require_once ("../boleto/boleto_itau_pdf.php");



$mail = new PHPMailer();//instancia a classe



$mail->IsSMTP();// define que será usado SMTP

$mail->isHTML( true );// envia email em HTML

$mail->Charset = 'UTF-8';// codificação UTF-8, a codificação mais usada recentemente

$mail->SMTPAuth = true;// Configurações do SMTP

//$mail->SMTPDebug = true;

$mail->SMTPSecure = 'SSL';

$mail->Host = $linha['url'];

$mail->Port = $linha['porta'];

$mail->Username = $linha['email'];

$mail->Password = $linha['senha'];



// E-Mail do remetente (deve ser o mesmo de quem fez a autenticação
// nesse caso seu_login@gmail.com)
$mail->From = $linha['email'];
$mail->FromName = utf8_decode($linha['empresa']);// Nome do rementente
$mail->Subject = utf8_decode($linha['aviso']);// assunto da mensagem
//						$mail->AddAttachment($anexo);
// corpo da mensagem

$sqlss = mysql_query("SELECT *,date_format(data_venci, '%d/%m/%Y') AS data FROM faturas WHERE id_venda = '$idvenda'") or die(mysql_error());
$row = mysql_fetch_array($sqlss);
	$idfatura = $row['id_venda'];
	$idcliente = $row['id_cliente'];
	$nomecliente = $row['nome'];
	$valorfatura = $row['valor'];
	$datavenc = $row['data'];
	$num_doc = $row['num_doc'];
	$referente = $row['ref'];

$dado = 'id_venda='.$idfatura;

$pagina = base64url_encode($dado);

$link = $endereco.'boleto/boleto.php?'.$pagina;

$dado = $html;
$search = array('[NomedoCliente]', '[valor]','[vencimento]','[numeroFatura]','[Descricaodafatura]','[link]'); // pega oa variaveis do html vindo do banco;
$replace = array($nomecliente, number_format($valorfatura,2,',','.'),$datavenc,$num_doc,$referente,$link); //  variavis que substiruem os valores
$subject = $dado;
$texto = str_replace($search, $replace, $subject);
$mail->Body = utf8_decode($texto);
$mail->AddAddress($emailcliente);

if (!empty($alternativo)){ $mail->AddAddress($alternativo); }

// verifica se enviou corretamente
if ( $mail->Send() ) {

	 print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=../inicio.php?pg=fatpendente&p=".$p."'>
			<script type=\"text/javascript\">
				alert(\"FATURA REENVIADA COM SUCESSO!\");
			</script>";
}else {
	 print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=../inicio.php?pg=fatpendente&p=".$p."'>
			<script type=\"text/javascript\">
				alert(\" ERRO: O email não foi enviado. Por favor revise os dados na configuração do email.  \");
			</script>";
}

?>
</body>
</html>