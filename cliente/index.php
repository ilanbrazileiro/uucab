
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php 
require ("../classes/conexao.php");
$sqld = mysql_query("SELECT * FROM config") or die(mysql_error());
$d = mysql_fetch_array($sqld);
?>
<title>.: <?php echo $d['nome']; ?> -  GERENCIADOR DE BOLETOS :.</title>
<link href="css/log.css" rel="stylesheet" type="text/css">
<script src="../js/jquery.js" type="text/javascript"></script>
<script type="text/javascript" src="../js/jquery.maskedinput.js"></script>
<script type="text/javascript">
    jQuery(function () {
            $("#cnpj").mask("999.999.999-99");
        });	
		
function up(lstr){ // converte minusculas em maiusculas
var str=lstr.value; //obtem o valor
lstr.value=str.toUpperCase(); //converte as strings e retorna ao campo
}

///////////////////////// validacao campo cpf/cnpj //////////////////.
function aplica_mascara_cpfcnpj(campo,tammax,teclapres) {
	var tecla = teclapres.keyCode;

	if ((tecla < 48 || tecla > 57) && (tecla < 96 || tecla > 105) && tecla != 46 && tecla != 8) {
		return false;
	}

	var vr = campo.value;
	vr = vr.replace( /\//g, "" );
	vr = vr.replace( /-/g, "" );
	vr = vr.replace( /\./g, "" );
	var tam = vr.length;

	if ( tam <= 2 ) {
		campo.value = vr;
	}
	if ( (tam > 2) && (tam <= 5) ) {
		campo.value = vr.substr( 0, tam - 2 ) + '-' + vr.substr( tam - 2, tam );
	}
	if ( (tam >= 6) && (tam <= 8) ) {
		campo.value = vr.substr( 0, tam - 5 ) + '.' + vr.substr( tam - 5, 3 ) + '-' + vr.substr( tam - 2, tam );
	}
	if ( (tam >= 9) && (tam <= 11) ) {
		campo.value = vr.substr( 0, tam - 8 ) + '.' + vr.substr( tam - 8, 3 ) + '.' + vr.substr( tam - 5, 3 ) + '-' + vr.substr( tam - 2, tam );
	}
	if ( (tam == 12) ) {
		campo.value = vr.substr( tam - 12, 3 ) + '.' + vr.substr( tam - 9, 3 ) + '/' + vr.substr( tam - 6, 4 ) + '-' + vr.substr( tam - 2, tam );
	}
	if ( (tam > 12) && (tam <= 14) ) {
		campo.value = vr.substr( 0, tam - 12 ) + '.' + vr.substr( tam - 12, 3 ) + '.' + vr.substr( tam - 9, 3 ) + '/' + vr.substr( tam - 6, 4 ) + '-' + vr.substr( tam - 2, tam );
	}
}

//Verifica se CPF ou CGC e encaminha para a devida função, no caso do cpf/cgc estar digitado sem mascara
function verifica_cpf_cnpj(cpf_cnpj) {
	if (cpf_cnpj.length == 11) {
		return(verifica_cpf(cpf_cnpj));
	} else if (cpf_cnpj.length == 14) {
		return(verifica_cnpj(cpf_cnpj));
	} else { 
		return false;
	}
	return true;
}



function NovaJanela(pagina,nome,w,h,scroll){
	LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
	TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
	settings = 'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
	win = window.open(pagina,nome,settings);
	}
window.name = "main";

 </script>
</head>

<body>
<div id="topo"></div>
<div id="entrada">
<div id="top">UUCAB - Area do cliente</div>
<div id="form">
<form action="login.php" method="post" enctype="multipart/form-data">
	<span class="texto">CPF - Diretor(a) Espiritual:</span><BR/>
  	<input name="cpfcnpj" type="text" class="imput" id="cpf-cnpj" onkeydown="javascript:return aplica_mascara_cpfcnpj(this,18,event)" onkeyup="javascript:return aplica_mascara_cpfcnpj(this,18,event)" size="20" maxlength="18"><br/>
    <span class="texto">Sua Senha:</span><br/>
    <input name="senha" type="password" class="imput" id="senha"><br/>
    <input name="logar" type="submit" value="Entrar" id="logar"> &nbsp;&nbsp;&nbsp;&nbsp;<a href="enviarsenha.php" onclick="NovaJanela(this.href,'nomeJanela','350','350','yes');return false" title="Editar" class="esqueci">Esqueci minha senha</a> 

</form>
<?php 
if(isset($_GET['login_errado']) == "erro"){
	echo "<div id='erro'>*Dados não conferem. Tente novamente!</div>";	
}
?>
</div>
<div id="logo"><img src="img/griff.png" width="200" height="130">
</div>
</div>


</body>
</html>