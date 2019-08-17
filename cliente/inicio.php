<?php 
ob_start();
session_start();
if(!isset($_SESSION['cpfcnpj_session'])){
	header("Location:index.php");	
}

include "../classes/conexao.php";
include "../classes/funcoes.class.php";
$conecta = new recordset();

?>
<!DOCTYPE HTML>
<html>
<head>
<?php 
$sqld = mysql_query("SELECT * FROM config") or die(mysql_error());
$d = mysql_fetch_array($sqld);
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>.: <?php echo $d['nome']; ?> -  GERENCIADOR DE BOLETOS :.</title>
<link href="css/log.css" rel="stylesheet" type="text/css">
<link href="css/jquery-uicss.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="../css/icons.css" />
<link href="css/principal.css" rel="stylesheet" type="text/css">
<link href="css/styles.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css" />
<script type="text/javascript">
function NovaJanela(pagina,nome,w,h,scroll){
	LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
	TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
	settings = 'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
	win = window.open(pagina,nome,settings);
	}
window.name = "main";


function datas() {
var datai = formu.datai.value;
var dataf = formu.dataf.value; 

if (datai == "") {
alert('Escolha uma data inicial.');
formu.datai.focus();
return false;
}
if (dataf == "") {
alert('Escolha uma data final.');
formu.dataf.focus();
return false;
}
}
</script>
<script src="../js/jquery.min.js" type="text/javascript"></script>
<link href="../css/jquery-ui-1.10.4.custom.css" rel="stylesheet" type="text/css">
<script src="../js/jquery-ui-1.10.4.custom.js"></script>
<script>
    $(document).ready(function () {
        $(".data").datepicker({
            dateFormat: 'dd/mm/yy',
            dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
            dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
            dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
            monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
            monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
            nextText: 'Proximo',
            prevText: 'Anterior'
        });
      });
    </script>
<!--[if gte IE 9]>
  <style type="text/css">
    .gradient {
       filter: none;
    }
  </style>
<![endif]-->
</head>

<body>
<?php 
$empresa = $_SESSION['cpfcnpj_session'];
$sql = mysql_query("SELECT * FROM cliente WHERE cpfcnpj = '$empresa'") or die(mysql_error());
$dad = mysql_fetch_array($sql);

$log = mysql_query("SELECT * FROM config");
$linha = mysql_fetch_array($log);
?>
<div id="topo"></div>
<div id="capamenu">
<div id="logoc"><img src="../cliente/img/griff.png" height="40" style="margin-top:15px;float:left;">
<div style="font-size:30px; line-height:50px;color:#FFF; font-style:italic;float:left;margin-top:10px"><strong>UUCAB</strong></div>
</div>
	<div id="menu">
    	<ul>
 			<li>Bem vindo: <?php echo $dad['dir_culto']; ?></li>       
        	<li><a href="?pag=lancafatura" class="btn-link" style="text-decoration:none;">MEUS DADOS</a></li>
        	<li><a href="?pg=lista" class="btn-link" style="text-decoration:none;">MEUS BOLETOS</a></li>
        	<li><a href="http://www.uucab.com.br/beneficios.php" target="_blank" class="btn-link" style="text-decoration:none;">BENEFÍCIOS</a></li>
      		<li style="border:none;"><a href="sair.php" class="btn-link" style="text-decoration:none;">SAIR</a></li>
        </ul>
    </div>
</div>
<div style=" clear:both"></div>
<div id="conteudo">
<?php 
if(isset($_GET['pg']) == 'lista'){
	include "lista.php";	
}
elseif(isset($_GET['pag']) == 'lancafatura'){
	include "lancafatura.php";	
}
else{
	include "lancafatura.php";	
}

?>

</div>
<div id="rodape" style="margin-top:50px;"><span style="font-size:14px;">União Umb dos Cultos Afro Brasileiros</span><br />
Sede: Avenida Ministro Edgard Romero, 81, Sala 340 - Shopping São Luiz - Madureira. Cep 21350-301. Rio de Janeiro. RJ. Telefone: (21)3390-2305<br />
Parque Ecológico dos Orixás: Avenida Automóvel Clube, 2322 - Raiz da Serra/Inhomirim. Magé. RJ Telefone: (24)2235-0890</div>


</body>
</html>