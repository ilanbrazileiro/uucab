<?php 
session_start();
//se nao existir volta para a pagina do form de login
if(!isset($_SESSION['login_session']) and !isset($_SESSION['senha_session'])){
	header("Location:../index.php");
	exit;		
}


		$baixa = mysql_query("UPDATE faturas SET situacao = 'P' WHERE situacao != 'B' AND data_venci > DATE(NOW())");
		$sqlm = mysql_query("SELECT * FROM bancos WHERE situacao = '1'") or die(mysql_error());
$dados = mysql_fetch_array($sqlm);
$id_banco = $dados['id_banco'];
			
?>
<script src="js/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">

if(!window.sendPost){
            window.sendPost = function(url, obj, p){
                //Define o formulário
                var myForm = document.createElement("form");
                myForm.action = url;
                myForm.method = "post";
 
	        for(var key in obj) {
		     var input = document.createElement("input");
		     input.type = "text";
		     input.value = obj[key];
		     input.name = key;
		     myForm.appendChild(input);			
	        }
			if(p != ""){
				var input = document.createElement("input");
				input.type = "text";
				input.value = p;
				input.name = "p";
				myForm.appendChild(input);
				}
                //Adiciona o form ao corpo do documento
                document.body.appendChild(myForm);
                //Envia o formulário
                myForm.submit();
            }    
        }  
		
function marcardesmarcar(){
   if ($("#todos").attr("checked")){
      $('.marcar').each(
         function(){
            $(this).attr("checked", true);
         }
      );
   }else{
      $('.marcar').each(
         function(){
            $(this).attr("checked", false);
         }
      );
   }
}
function NovaJanela(pagina,nome,w,h,scroll){
	LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
	TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
	settings = 'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
	win = window.open(pagina,nome,settings);
	}
window.name = "main";

function validaCheckbox(v){ 
    todos = document.getElementsByTagName('input'); 
    for(x = 0; x < todos.length; x++) { 
        if (todos[x].checked){ 
            return true; 
        } 
    } 
    alert("Selecione pelo menos uma fatura!"); 
    return false; 
}

function validaImpressao (query){
if (confirm ('Tem certeza que deseja imprimir todas as faturas da pesquisa?')){
	window.location="boleto/boleto_itau.php";
	return true
	}
	else{
		window.location="inicio.php?pg=impressao_lote";
		return false;
		}
}

function excluir(query){
if (confirm ("Tem certeza que deseja excluir estes registros?")){   
 window.location="php/delfat.php";  
 return true;
 }
 else  
 window.location="inicio.php?pg=impressao_lote";
 return false;
 }

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
<link href="css/jquery-ui-1.10.4.custom.css" rel="stylesheet" type="text/css">
<script src="js/jquery-ui-1.10.4.custom.js"></script>
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


<?php /////////////////////// Incio da View///////////////?>


<div id="entrada">
<div id="cabecalho">
  <h2><i class="icon-print  iconmd"></i> Impressão em PDF de Boletos</h2>
</div>
<!-- Inicio das instruções para impressão dos boletos, depois poderá ser apagado -->
<div style="width:900px; margin-left:50px; border:red 1px solid;">
  <h4 style="padding:10px;">Instruções para Impressão em Lote</h4>
  <p style="font-style:italic; padding:10px;">- Para fazer a impressão em lote, faça uma consulta com um dos formulários abaixo e clique no botão "Imprimir todos os Boletos da Pesquisa".</p>
  <p style="font-style:italic; padding:10px;">- São exibidos apenas os boletos da conta ativa!</p>
  <p style="font-style:italic; padding:10px;color:#F00">OBS: Dependendo da quantidade de boletos, essa operação pode demorar um pouco a ser executada! Aguarde o carregamento total. <br />
    Para finalizar o carregamento antes do fim, aperte o botão de "Parar" no seu navegador.</p>
</div>
<br />
<br />
<!--FIM das instruções -->


<div id="forms" style="display:table;padding-bottom:5px;">
    
   <?php /*
   <div style="float:left;width:600px"> <span class="avisos">* Escolha o intervalo e a referência do mês </span><br/>
    <form action="inicio.php?pg=impressao_lote_pdf<?php echo $pags.$part; ?>" method="post" enctype="multipart/form-data">
       <input name="di" type="text" style="width:100px;" >
      e
      <input name="df" type="text" style="width:100px;" >
      -
       <select name="ref_mes" style="width:100px;">
    <option> --- </option>
    <?php echo geraOptionMeses();?>
    </select>
    /
    <select name="ref_ano" style="width:100px;">
    <option> --- </option>
    <?php for ($i=2010;$i<=2040;$i++){
			echo "<option value='$i'>$i</option>";
		  }?>
     </select> 
      <button type="submit" class="btn ewButton" name="pesq" id="btnsubmit" style="margin-top:-10px;"/>
      <i class="icon-search  icon-white"></i>
      </button>
    </form>
  </div> 
  
    <div style="float:left;width:300px"> <span class="avisos">* Ou entre datas de vencimento</span><br/>
    <form action="inicio.php?pg=impressao_lote_pdf<?php echo $pags.$part; ?>" method="post" enctype="multipart/form-data" name="formu" id="formu" onSubmit="return datas(this);">
      <input name="datai" type="text" style="width:100px;" class="data">
      e
      <input name="dataf" type="text" style="width:100px;" class="data">
      <button type="submit" class="btn ewButton" name="pesq" id="btnsubmit" style="margin-top:-10px;"/>
      <i class="icon-search  icon-white"></i>
      </button>
    </form>
  </div>*/ ?>
  
  <div style="float:left;width:520px"> <span class="avisos">* Escolha o intervalo da matricula e a referência do mês </span><br/>
    <form action="inicio.php?pg=impressao_lote_pdf<?php echo $pags.$part; ?>" method="post" enctype="multipart/form-data">
       <input name="mi" type="text" style="width:100px;" >
      e
      <input name="mf" type="text" style="width:100px;" >
      -
       <select name="ref_mes_m" style="width:100px;">
    <option> --- </option>
    <?php echo geraOptionMeses();?>
    </select>
    /
    <select name="ref_ano_m" style="width:100px;">
    <option> --- </option>
    <?php for ($i=2018;$i<=2040;$i++){
			echo "<option value='$i'>$i</option>";
		  }?>
     </select> 
      <button type="submit" class="btn ewButton" name="pesq" id="btnsubmit" style="margin-top:-10px;"/>
      <i class="icon-search  icon-white"></i>
      </button>
    </form>
  </div>  
  
 
  <div style="float:left;width:380px"">
    <form action="inicio.php?pg=impressao_lote_pdf<?php echo $pags.$part; ?>" method="post" enctype="multipart/form-data">
      <span class="avisos">&nbsp;*Pesquise pelo DIRETOR ou numero do documento</span><br/>
      <input name="pesquizar" type="text" style="width:320px;">
      <button type="submit" class="btn ewButton" name="pesq" id="btnsubmit" style="margin-top:-10px;"/>
      <i class="icon-search  icon-white"></i>
      </button>
    </form>
  </div>
  
  
  <div style="float:left;width:400px"> <span class="avisos">* Escolha o intervalo da matricula e a referência do ANUAL </span><br/>
    <form action="inicio.php?pg=impressao_lote_pdf<?php echo $pags.$part; ?>" method="post" enctype="multipart/form-data">
       <input name="mi" type="text" style="width:100px;" >
      e
      <input name="mf" type="text" style="width:100px;" >
      -
       <select name="ref_anual" style="width:100px;">
        <option> --- </option>
    <?php for ($i=2019;$i<=2040;$i++){
			echo "<option value='$i'>$i</option>";
		  }?>
     </select> 
      <button type="submit" class="btn ewButton" name="pesq" id="btnsubmit" style="margin-top:-10px;"/>
      <i class="icon-search  icon-white"></i>
      </button>
    </form>
  </div>
  
  <div style="float:left;width:270px"> <span class="avisos">* Ou no intervalo de numeros de documentos</span><br/>
    <form action="inicio.php?pg=impressao_lote_pdf<?php echo $pags.$part; ?>" method="post" enctype="multipart/form-data">
      <input name="di" type="text" style="width:90px;" >
      e
      <input name="df" type="text" style="width:90px;" >
      <button type="submit" class="btn ewButton" name="pesq" id="btnsubmit" style="margin-top:-10px;"/>
      <i class="icon-search  icon-white"></i>
      </button>
    </form>
  </div>
  
  
  <div style="float:left;width:300px">
    <form action="inicio.php?pg=impressao_lote_pdf<?php echo $pags.$part; ?>" method="post" enctype="multipart/form-data">
      <span class="avisos">&nbsp;*Pesquise pela MATRÍCULA</span><br/>
      <input name="matric" type="text" style="width:170px;">
      <button type="submit" class="btn ewButton" name="pesq" id="btnsubmit" style="margin-top:-10px;"/>
      <i class="icon-search  icon-white"></i>
      </button>
    </form>
  </div>
  
</div>
<?php
if(isset($_POST['pesquizar']) && $_POST['pesquizar'] != ""){
$pesquisar = $_POST['pesquizar'];
$filtro = "pesquizar:'".$_POST['pesquizar']."'";
$sql_1 = "SELECT f.*, c.*, date_format(data_venci, '%d/%m/%Y') AS data, f.valor AS v FROM faturas AS f INNER JOIN cliente AS c ON f.id_cliente = c.id_cliente WHERE f.situacao !='B' AND c.dir_culto LIKE '%$pesquisar%' OR f.id_venda LIKE '%$pesquisar%' ORDER BY c.matricula ASC";

} elseif(isset($_POST['matric']) && $_POST['matric'] != ""){
$pesquisar = $_POST['matric'];
$filtro = "matric:'".$_POST['matric']."'";
$sql_1 = "SELECT f.*, c.*, date_format(data_venci, '%d/%m/%Y') AS data, f.valor AS v FROM faturas AS f INNER JOIN cliente AS c ON f.id_cliente = c.id_cliente WHERE f.situacao !='B' AND c.matricula LIKE '%$pesquisar%' ORDER BY c.matricula ASC";

} elseif(isset($_POST['datai']) && $_POST['datai'] and $_POST['dataf'] != ""){	
$filtro = "datai:'".$_POST['datai']."', dataf:'".$_POST['dataf']."'";
$datai = implode("-",array_reverse(explode("/",$_POST['datai'])));
$dataf = implode("-",array_reverse(explode("/",$_POST['dataf'])));			
$sql_1 = "SELECT f.*, c.*, date_format(data_venci, '%d/%m/%Y') AS data, f.valor AS v FROM faturas AS f INNER JOIN cliente AS c ON f.id_cliente = c.id_cliente WHERE f.situacao !='B' AND f.data_venci BETWEEN ('$datai') AND ('$dataf') ORDER BY c.matricula ASC";

} elseif(isset($_POST['di']) && $_POST['di'] and $_POST['df'] != ""){	
$filtro = "di:'".$_POST['di']."', df:'".$_POST['df']."'";
$di = $_POST['di'];
$df = $_POST['df'];			
$sql_1 = "SELECT f.*, c.*, date_format(data_venci, '%d/%m/%Y') AS data, f.valor AS v FROM faturas AS f INNER JOIN cliente AS c ON f.id_cliente = c.id_cliente WHERE f.situacao !='B' AND f.id_venda BETWEEN ('$di') AND ('$df') ORDER BY c.matricula ASC";

} elseif(isset($_POST['ref_mes']) && $_POST['ref_ano'] and $_POST['ref_ano'] != ""){	
$filtro = "ref_mes:'".$_POST['ref_mes']."', ref_ano:'".$_POST['ref_ano']."'di:'".$_POST['di']."', df:'".$_POST['df']."'";
$ref_mes = $_POST['ref_mes'];
$ref_ano = $_POST['ref_ano'];
$di = $_POST['di'];
$df = $_POST['df'];				
$sql_1 = "SELECT f.*, c.*, date_format(data_venci, '%d/%m/%Y') AS data, f.valor AS v FROM faturas AS f INNER JOIN cliente AS c ON f.id_cliente = c.id_cliente WHERE f.situacao !='B' AND f.ref2 = '".$ref_mes."-".$ref_ano."' ";
if(!empty($di) || !empty($df)){
$sql_1 .=	"AND f.id_venda BETWEEN ('$di') AND ('$df') ";
	}
$sql_1 .="ORDER BY c.matricula ASC";

} elseif(isset($_POST['ref_mes_m']) && $_POST['ref_ano_m'] and $_POST['ref_ano_m'] != ""){	
$filtro = "ref_mes_m:'".$_POST['ref_mes_m']."', ref_ano_m:'".$_POST['ref_ano_m']."'mi:'".$_POST['mi']."', mf:'".$_POST['mf']."'";
$ref_mes_m = $_POST['ref_mes_m'];
$ref_ano_m = $_POST['ref_ano_m'];
$mi = $_POST['mi'];
$mf = $_POST['mf'];				
$sql_1 = "SELECT f.*, c.*, date_format(data_venci, '%d/%m/%Y') AS data, f.valor AS v FROM faturas AS f INNER JOIN cliente AS c ON f.id_cliente = c.id_cliente WHERE f.situacao !='B' AND f.ref2 = '".$ref_mes_m."-".$ref_ano_m."' ";
if(!empty($mi) || !empty($mf)){
$sql_1 .=	"AND c.matricula BETWEEN ('$mi') AND ('$mf') ";
	}
$sql_1 .="ORDER BY c.matricula ASC";

} elseif(isset($_POST['ref_anual'])){	
$filtro = "ref_anual:'".$_POST['ref_anual']."'mi:'".$_POST['mi']."', mf:'".$_POST['mf']."'";
$ref_anual = $_POST['ref_anual'];
$ref2 = '1-'.$ref_anual.'_12-'.$ref_anual;
$mi = $_POST['mi'];
$mf = $_POST['mf'];				
$sql_1 = "SELECT f.*, c.*, date_format(data_venci, '%d/%m/%Y') AS data, f.valor AS v FROM faturas AS f INNER JOIN cliente AS c ON f.id_cliente = c.id_cliente WHERE f.situacao !='B' AND f.ref2 = '".$ref2."' ";
if(!empty($mi) || !empty($mf)){
$sql_1 .=	"AND c.matricula BETWEEN ('$mi') AND ('$mf') ";
	}
$sql_1 .="ORDER BY c.matricula ASC";
}


/*else{
$sql_1 = "SELECT f.*, c.*, date_format(data_venci, '%d/%m/%Y') AS data, f.valor AS v FROM faturas AS f INNER JOIN cliente AS c ON f.id_cliente = c.id_cliente WHERE f.situacao !='B' AND f.id_banco = $id_banco ";	
}*/


?>
<form name="form" action="boleto/boleto_itau_pdf.php" method="post" enctype="multipart/form-data" target="_blank" >
  <?php
////PEGA TODOS OS IDS E GRAVA EM UM ARRAY

$sql_todos_id = $sql_1;
$sql_ids = mysql_query($sql_todos_id);
while($fatura = mysql_fetch_array($sql_ids)) {
	echo '<input type="hidden" name="ids[]" value="'.  $fatura['id_venda'] .'" />';
}
?>
  <div style="width:900px;text-align:center;">
    <button type="submit" class="btn deleteboton ewButton" id="btnimprimir" onclick="return confirm ('Tem certeza que deseja imprimir todas as faturas da pesquisa?')" style="font-size:14px; width:280px; height:50px;" / >
    <i class="icon-print icon-white"></i> Imprimir todos os Boletos da Pesquisa?
    </button>
    <br />
  </div>
</form>
<div id="forms">
<?php

// Pegar a página atual por GET
@$p = $_POST["p"];
if(isset($p)) {
$p = $p;
} else {
$p = 1;
}
// Defina aqui a quantidade máxima de registros por página.
$qnt = 1000;
$inicio = ($p*$qnt) - $qnt;
$sql_2 = $sql_1;
// Executa o Query
$sql_query1 = mysql_query($sql_2);
//$total_registros = $sql_query1[0];
$total_registros = mysql_num_rows($sql_query1);
?>
Total de Faturas: <?php echo $total_registros; ?>
<div id="fundo-tabela">
  <table width="100%" border="0" cellspacing="1" cellpadding="5" data-rowindex="1" data-rowtype="1">
    <tbody>
      <tr>
        <td width="50" bgcolor="#0490fc"><span class="fontebranca"><a style="color:#fff; text-decoration:none;" href="#" onclick="sendPost('inicio.php?pg=impressao_lote&o=<?php echo $o;?>&campo=c.matricula',{<?php echo $filtro; ?>}, '1')" target="_self">Matr&nbsp;<i class="icon-arrow-down"></i></a></span></td>
        <td width="239" bgcolor="#0490fc"><span class="fontebranca"><a style="color:#fff; text-decoration:none;" href="#" onclick="sendPost('inicio.php?pg=impressao_lote&o=<?php echo $o;?>&campo=c.dir_culto',{<?php echo $filtro; ?>}, '1')" target="_self">Diretor do Culto&nbsp;<i class="icon-arrow-down"></i></a></span></td>
        <td width="222" bgcolor="#0490fc"><span class="fontebranca">Descrição</span></td>
        <td width="40" align="center" bgcolor="#0490fc"><span class="fontebranca"><a style="color:#fff; text-decoration:none;" href="#" onclick="sendPost('inicio.php?pg=impressao_lote&o=<?php echo $o;?>&campo=f.id_venda',{<?php echo $filtro; ?>}, '1')" target="_self">Nº Doc&nbsp;<i class="icon-arrow-down"></i></a></span></td>
        <td width="55" align="center" bgcolor="#0490fc"><span class="fontebranca"><a style="color:#fff; text-decoration:none;" href="#" onclick="sendPost('inicio.php?pg=impressao_lote&o=<?php echo $o;?>&campo=data_venci',{<?php echo $filtro; ?>}, '1')" target="_self">Venc.&nbsp;<i class="icon-arrow-down"></i></span></td>
        <td width="55" align="center" bgcolor="#0490fc"><span class="fontebranca">Valor</span></td>
        <td width="55" align="center" bgcolor="#0490fc"><span class="fontebranca">Conta</span></td>
        <td width="37" align="center" bgcolor="#0490fc"><span class="fontebranca">Impr.</span></td>
        <td width="60" align="center" bgcolor="#0490fc"><span class="fontebranca">Ações</span></td>
      </tr>
    </tbody>
    <?php

// Seleciona no banco de dados com o LIMIT indicado pelos números acima
$sql_select = $sql_1." LIMIT $inicio, $qnt";
// Executa o Query
$sql_query = mysql_query($sql_select);
// Cria um while para pegar as informações do BD
while($array = mysql_fetch_array($sql_query)) {
// Variável para capturar o campo "nome" no banco de dados
$nome = $array["nome"];
$nm = $array['nosso_numero'];

$banco = $array['id_banco'];
// Exibe o nome que está no BD e pula uma linha
$id_cliente = $array['id_cliente'];
$cliente = mysql_query("SELECT * FROM cliente WHERE id_cliente = '$id_cliente'");

while($clientes = mysql_fetch_array($cliente)) {
$mat = $clientes['matricula'];
$diretor = $clientes['dir_culto'];
$nome_pres = $clientes['nome'];
}
?>
    <tr>
      <td align="left"><?php echo $mat; ?></td>
      <td align="left"><?php echo $diretor; ?></td>
      <td align="left"><?php echo $array['ref']; ?></td>
      <td align="left"><?php echo $array['id_venda']; ?></td>
      <td align="center"><?php echo $array['data']; ?></td>
      <td align="right"><?php echo number_format($array['v'], 2, ',', '.'); ?></td>
      <td align="center"><?php echo $array['banco_receb'].' / '.$array['conta'].' - '.$array['dv_receb']; ?></td>
      <td align="center"><?php 
		if($nm != "0"){
			echo "SIM";
		}else{
			echo "NÃO";	
		}
		if($array['nosso_numero'] == 0){
			$var = "";	
		}else{
			$var = $array['nosso_numero'];	
		}
	?></td>
      <td align="center" valign="middle"><?php if(empty($array['pedido'])){ ?>
        <div class="btn-group"> <a class="btn btn-default" href="php/reenviarmailatrazo.php?id_venda=<?php echo $array['id_venda'] ?>&idcliente=<?php echo $array['id_cliente'] ?><?php echo $vari ?>" title="Reenviar fatura por e-mail" style="color:#F60"> <i class="icon-envelope"></i></a>
          <?php }else{?>
          CARNE
          <?php } ?>
          <a class="btn btn-default" href="pg/editafatura.php?id_venda=<?php echo $array['id_venda'].'&s=vencida' ?>" class="editar" title="Editar fatura"  
onclick="NovaJanela(this.href,'nomeJanela','650','450','yes');return false" style="color:#069"><i class="icon-edit"></i></a></span>
          <?php if ($banco == 5){	?>
          <a class="btn btn-default" href="<?php echo "boleto/boleto_itau2.php?id_venda=".$array['id_venda']; ?>" target="_blank" class="editar" style="color:#333" title="Imprimir fatura"><i class="icon-print"></i></a>
          <?php } else if ($banco == 4){?>
          <a class="btn btn-default" href="<?php echo "boleto/boleto_itau.php?id_venda=".$array['id_venda']; ?>" target="_blank" class="editar" style="color:#333" title="Imprimir fatura"><i class="icon-print"></i></a>
          <?php } else {?>
          <a class="btn btn-default" href="<?php echo "boleto/".$link."?id_venda=".$array['id_venda']; ?>" target="_blank" class="editar" style="color:#333" title="Imprimir fatura"><i class="icon-print"></i></a>
          <?php }?>
          <?php if(isset($_GET['p'])){ 

$pg = $_GET['p']; ?>
          <a class="btn btn-default" href="pg/baixamanual.php?id_venda=<?php echo $array['id_venda']; ?>" class="editar" title="Dar Baixa no título (Receber)" onclick="NovaJanela(this.href,'nomeJanela','650','450','yes');return false" style="color:#390"><i class="icon-circle-arrow-down"></i></a>
          <?php }else{ ?>
          <a class="btn btn-default" href="pg/baixamanual.php?id_venda=<?php echo $array['id_venda']; ?>&pagina=fatvencida" class="editar" title="Dar Baixa no título (Receber)" onclick="NovaJanela(this.href,'nomeJanela','650','450','yes');return false" style="color:#390"><i class="icon-circle-arrow-down"></i></a> </span>
          <?php } ?>
        </div></td>
    </tr>
    <?php } ?>
    <tr>
      <td colspan="12" bgcolor="#0490fc"><div id="total-faturas"><strong>UUCAB</strong> </div>
  </table>
  </form>
</div>