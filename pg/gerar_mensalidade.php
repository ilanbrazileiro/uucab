<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Editar dados de clientes</title>
<style type="text/css">
body {
	background:#ebebeb;
	font-family:Verdana, Geneva, sans-serif; font-size:12px;
}
fieldset{
-webkit-border-radius: 10px;
-moz-border-radius: 10px;
border-radius: 10px;
background:#FFFFFF;
overflow:hidden;	
}
.linha {
	width:700px;
	display:table;
	margin-bottom:10px;
	}
.coluna {
	float:left;	
	}
	
</style>
</head>
<script language="javascript">
//function fechajanela() {
//window.open("../inicio.php?pg=listaclientes","main");
//}
</script>

<body onunload="fechajanela()">
<div id="conteudoform">
<?php 

include "../classes/conexao.php";
////////////////////////////     CODGIO PARA GERAR AS MENSALIDADES 
if(isset($_POST['gerar'])){
	$id 			= $_GET['id'];//ID DO CLIENTE
	$ano			= $_POST['ano'];// ANO ESCOLHIDO PARA GERAR AS MENSALIDADES
	$r				= $_POST['r'];
	
	$sql = mysql_query("SELECT * FROM cliente WHERE id_cliente='$id'")or die (mysql_error());//GET CLIENTE
	$l = mysql_fetch_array($sql);
	$matricula_cliente = $l['matricula'];
	
	//// TESTA SE AS MENSALIDADES JÁ FORAM INSERIDAS
	$sqla = mysql_query("SELECT * FROM mensalidades WHERE id_cliente='$id' AND ano='$ano'")or die (mysql_error());
	$l2 = mysql_fetch_array($sqla);
	$idc = $l2['id_cliente']; $anoc = $l2['ano'];
	
	if ($id != $l2['id_cliente'] && $ano != $l2['ano']){//SE NÃO INSERE
				
		$sql = mysql_query("INSERT INTO `mensalidades`(`id_mensalidade`, `id_cliente`, `matricula_cliente`, `ano`, `jan`, `fev`, `mar`, `abr`, `mai`, `jun`, `jul`, `ago`, `setembro`, `outubro`, `nov`, `dez`) VALUES ('','$id','$matricula_cliente','$ano','0','0','0','0','0','0','0','0','0','0','0','0')")or die (mysql_error());
		
		for ($i = 1; $i <= 12; $i++){
			$sqlm = mysql_query("INSERT INTO `ref_mensalidade`(`id`, `id_mensalidade`, `id_cliente`, `situacao`, `data_pagamento`, `n_fatura`, `mes`, `ano`) VALUES ('','','$id','0','','','$i','$ano')")or die (mysql_error()); 
			}
	
		if($sql == 1){/// SE CADASTRADO, ENVIA MENSAGEM INFORMANDO
			if ($r == 1){
				print "
				<script type=\"text/javascript\">
					alert(\"CADASTRADOS COM SUCESSO\");
				</script>";
						
			print "<script type=\"text/javascript\">javascript:window.history.go(-1);</script>";
			} else {
			print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=editacliente.php?id=$id&p=1'>
			<script type=\"text/javascript\">
			alert(\"CADASTRADOS COM SUCESSO\");
			</script>";
						
			print "<script type=\"text/javascript\"></script>";
			}
		}	
	
	} else { /// SE SIM ENVIA MENSAGEM E RETORNA PARA  A PÁGINA
		print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=editacliente.php?id=$id&p=1'>
			<script type=\"text/javascript\">
			alert(\"MENSALIDADES JÁ EXISTENTES\");
			</script>";	
		}
	
}

if(isset($_POST['cancelar'])){/// volta a pagina para caso seja cancelado

$id = $_GET['id'];///id do cliente
	$mes = $_GET['m'];
	$ano = $_GET['a'];
	$edita_cliente = $_GET['c'];
	if ($edita_cliente == '1'){
	print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=editacliente.php?id=$id&p=1'>";
	} else {
	print "<script type=\"text/javascript\"></script>";
		}
}

/////////////////////////////////////////////////////////////////////////////////////////////////////
	$id = $_GET['id'];
	$r = $_GET['r'];
	$sql = mysql_query("SELECT * FROM cliente WHERE id_cliente='$id'")or die (mysql_error());
	$l = mysql_fetch_array($sql);
?>
<fieldset style="border:1px solid #666;"><legend><strong>Gerar Mensalidades</strong></legend>

<form action="" method="post" enctype="multipart/form-data" id="gerar_mensalidades">
<input type="hidden" name="id" value="<?php $id;?>">
<input type="hidden" name="r" value="<?php echo $r;?>">

<div style="width:700px;border:none;">


<div class="linha">
<div class="coluna" style="width:250px;">Cliente:<?php echo ' '.$l['matricula'].' - '.$l['dir_culto'] ?><br/></div>
   
  </div>   

  <div class="linha">
    <div class="coluna" style="width:85px;">Ano:<br/>
    <select name="ano">
    <option value="2018">2018</option>
    <option value="2019">2019</option>
    <option value="2020">2020</option>
    <option value="2021">2021</option>
    <option value="2022">2022</option>
    <option value="2023">2023</option>
    <option value="2024">2024</option>
    <option value="2025">2025</option>
    <option value="2026">2026</option>
    <option value="2027">2027</option>
    <option value="2028">2028</option>
    <option value="2029">2029</option>
    <option value="2030">2030</option>
    </select>
    </div>
  </div>  
  <div class="linha">
    <div class="coluna" style="width:150px;">
    <input name="gerar" type="submit" value="Gerar Mensalidades" class="button">
    </div>
    
    <div class="coluna" style="width:150px;">
    <input name="cancelar" type="submit" value="Cancelar" class="btn btn-default ewButton">
    </div>
        
  </div>
</div>
</form>
</fieldset>
</div>
</body>
</html>