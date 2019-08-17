<?php 
session_start();
//se nao existir volta para a pagina do form de login
if(!isset($_SESSION['login_session']) and !isset($_SESSION['senha_session'])){
	header("Location:../index.php");
	exit;		
}
?>
<?php 
//////////    ATUALIZA A SITUAÇÃO DAS FATURAS 
	$baixa = mysql_query("UPDATE faturas SET situacao = 'V' WHERE situacao != 'B' AND data_venci < DATE(NOW())");	
	
//configurando a ordem das colunas

$o = $_GET["o"];

	if (isset($o) && $o == 0){
	$ordem = 'DESC';
	$o = 1; $part = '&o=0';
	} else if ($o == 1) {
	$ordem = 'ASC';
	$o = 0;$part = '&o=1';
	} else {
	$ordem = 'DESC';
	$o = 1;$part = '&o=0';
	}

$campo = $_GET['campo'];
if (empty($campo)){
	$campo = 'f.id_venda';
	}
$part .= '&campo='.$campo;

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


/* Função para marcar todas as linhas da tabela*/
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

function baixaVarios(){
	
	document.form.action = "inicio.php?pg=baixamanual_lote";
	retorno = validaCheckbox();
	if (retorno){
		document.form.submit();
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

function excluir(query){
if (confirm ("Tem certeza que deseja excluir estes registros?")){   
 window.location="php/delfat.php";  
 return true;
 }
 else  
 window.location="inicio.php?pg=fatpendente";
 return false;
 }
function baixar(query){
if (confirm ("Tem certeza que esta fatura foi paga?")){   
 window.location="php/baixa.php" + query;  
 return true;
 }
 else  
 window.location="inicio.php?pg=fatpendente";
 return false;
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
    
    
<div id="entrada">
<div id="cabecalho"><h2><i class="icon-external-link-sign  iconmd"></i> Faturas Pendentes </h2></div>

<div id="forms" style="display:table;padding-bottom:5px;">
  <div style="float:left;width:300px"">
	<form action="inicio.php?pg=fatpendente<?php echo $pags.$part; ?>" method="post" enctype="multipart/form-data">
			<span class="avisos">&nbsp;*Pesquise pelo DIRETOR ou numero do documento</span><br/>
		<input name="pesquizar" type="text">
		<button type="submit" class="btn ewButton" name="pesq" id="btnsubmit" style="margin-top:-10px;"/>
		<i class="icon-search  icon-white"></i></button>
	</form>  	
  </div>
  <div style="float:left;width:300px">
	<span class="avisos">* Ou entre datas de vencimento</span><br/>
	<form action="inicio.php?pg=fatpendente<?php echo $pags.$part; ?>" method="post" enctype="multipart/form-data" name="formu" id="formu" onSubmit="return datas(this);">
	<input name="datai" type="text" style="width:100px;" class="data"> e <input name="dataf" type="text" style="width:100px;" class="data">
	<button type="submit" class="btn ewButton" name="pesq" id="btnsubmit" style="margin-top:-10px;"/>
	<i class="icon-search  icon-white"></i></button>
	</form>
  </div>
  <div style="float:left;width:300px">
	<form action="inicio.php?pg=fatpendente<?php echo $pags.$part; ?>" method="post" enctype="multipart/form-data">
		
		<span class="avisos">&nbsp;*Pesquise pela MATRÍCULA</span><br/>
		<input name="matric" type="text">
		<button type="submit" class="btn ewButton" name="pesq" id="btnsubmit" style="margin-top:-10px;"/>
		<i class="icon-search  icon-white"></i></button>
		</form>
  </div>
</div>

<div id="forms">
<form name="form" action="php/delfat.php" method="post" enctype="multipart/form-data" onsubmit="return excluir(this);">
<input name="pg" type="hidden" value="<?php echo $_GET['pg'] ?>">
<?php
if(isset($_POST['pesquizar']) && $_POST['pesquizar'] != ""){
$pesquisar = $_POST['pesquizar'];
$filtro = "pesquizar:'".$_POST['pesquizar']."'";
$sql_1 = "SELECT f.*, c.*, date_format(data_venci, '%d/%m/%Y') AS datav, f.valor AS v FROM faturas AS f INNER JOIN cliente AS c ON f.id_cliente = c.id_cliente WHERE f.situacao ='P' AND (c.dir_culto LIKE '%$pesquisar%' OR f.id_venda LIKE '%$pesquisar%') ORDER BY ".$campo." ".$ordem;

} elseif(isset($_POST['matric']) && $_POST['matric'] != ""){
$pesquisar = $_POST['matric'];
$filtro = "matric:'".$_POST['matric']."'";
$sql_1 = "SELECT f.*, c.*, date_format(data_venci, '%d/%m/%Y') AS datav, f.valor AS v FROM faturas AS f INNER JOIN cliente AS c ON f.id_cliente = c.id_cliente WHERE f.situacao ='P' AND c.matricula LIKE '%$pesquisar%'  ORDER BY matricula ASC";

} elseif(isset($_POST['datai']) && $_POST['datai'] and $_POST['dataf'] != ""){
	$filtro = "datai:'".$_POST['datai']."', dataf:'".$_POST['dataf']."'";
$datai = implode("-",array_reverse(explode("/",$_POST['datai'])));
$dataf = implode("-",array_reverse(explode("/",$_POST['dataf'])));		
$sql_1 = "SELECT f.*, c.*, date_format(data_venci, '%d/%m/%Y') AS datav, f.valor AS v FROM faturas AS f INNER JOIN cliente AS c ON f.id_cliente = c.id_cliente WHERE f.situacao ='P' AND f.data_venci BETWEEN ('$datai') AND ('$dataf') ORDER BY ".$campo." ".$ordem;

} else {
$sql_1 = "SELECT f.*, c.*, date_format(data_venci, '%d/%m/%Y') AS datav, f.valor AS v FROM faturas AS f INNER JOIN cliente AS c ON f.id_cliente = c.id_cliente WHERE f.situacao ='P' ORDER BY ".$campo." ".$ordem;	
}

@$p = $_POST["p"];
if(isset($p)) {
$p = $p;
} else {
$p = 1;
}
$qnt = 100;
$inicio = ($p*$qnt) - $qnt;
$sql_2 = $sql_1;
// Executa o Query
$sql_query1 = mysql_query($sql_2);
//$total_registros = $sql_query1[0];
$total_registros = mysql_num_rows($sql_query1);
// Gera outra variável, desta vez com o número de páginas que será precisa. 
// O comando ceil() arredonda "para cima" o valor
$pags = ceil($total_registros/$qnt);
// Exibe o primeiro link "primeira página", que não entra na contagem acima(3)

if ($pags>1){
echo "<a class=\"pag\" href=\"#\" onclick=\"sendPost('inicio.php?pg=fatpendente".$part."',{".$filtro."}, '1')\" target=\"_self\">&laquo;&laquo; Primeira</a> ";
}
?>
&nbsp;

<select name="p" onchange="sendPost('inicio.php?pg=fatpendente<?php echo $part;?>',{<?php echo $filtro; ?>}, this.value );" style="width: 50px;">          
<option selected="selected"><?php echo $p; ?> </option>
<?php
// Cria um for() para exibir os 3 links antes da página atual
for($i = 1; $i <= $pags; $i++) {
	echo "<option value=\"$i\">$i</option>";
}
echo "</select>&nbsp;";
if ($pags>1){
// Exibe o link "última página"
echo "<a class=\"pag\" href=\"#\" onclick=\"sendPost('inicio.php?pg=fatpendente".$part."',{".$filtro."}, '".$pags."')\" target=\"_self\">Ultima &raquo;&raquo;</a> ";
}
?>
&nbsp;&nbsp;|&nbsp;&nbsp;Total de Faturas: <?php echo $total_registros; ?>

<div id="fundo-tabela">
<table width="100%" border="0" cellspacing="1" cellpadding="5" data-rowindex="1" data-rowtype="1">
<tbody>
  <tr>
    <td width="20" bgcolor="#0490fc"><input type="checkbox" name="todos" id="todos" value="todos" onclick="marcardesmarcar();" /></td>
    
    <td width="40" bgcolor="#0490fc"><span class="fontebranca"><a style="color:#fff; text-decoration:none;" href="#" onclick="sendPost('inicio.php?pg=fatpendente&o=<?php echo $o;?>&campo=c.matricula',{<?php echo $filtro; ?>}, '1')" target="_self">Matr&nbsp;<i class="icon-arrow-down"></i></a></span></td>
    
    <td width="210" bgcolor="#0490fc"><span class="fontebranca"><a style="color:#fff; text-decoration:none;" href="#" onclick="sendPost('inicio.php?pg=fatpendente&o=<?php echo $o;?>&campo=c.dir_culto',{<?php echo $filtro; ?>}, '1')" target="_self">Diretor do Culto&nbsp;<i class="icon-arrow-down"></i></a></span></td>
    
    <td width="210" bgcolor="#0490fc"><span class="fontebranca">Centro / Terreiro</span></td>
    
    <td width="215" bgcolor="#0490fc"><span class="fontebranca">Descrição</span></td>
    
    <td width="40" align="center" bgcolor="#0490fc"><span class="fontebranca"><a style="color:#fff; text-decoration:none;" href="#" onclick="sendPost('inicio.php?pg=fatpendente&o=<?php echo $o;?>&campo=f.id_venda',{<?php echo $filtro; ?>}, '1')" target="_self">Nº Doc&nbsp;<i class="icon-arrow-down"></i></a></span></td>
    
    <td width="55" align="center" bgcolor="#0490fc"><span class="fontebranca"><a style="color:#fff; text-decoration:none;" href="#" onclick="sendPost('inicio.php?pg=fatpendente&o=<?php echo $o;?>&campo=data_venci',{<?php echo $filtro; ?>}, '1')" target="_self">Venc.&nbsp;<i class="icon-arrow-down"></i></span></td>
    
    <td width="55" align="center" bgcolor="#0490fc"><span class="fontebranca">Confecção</span></td>
    
    <td width="45" align="center" bgcolor="#0490fc"><span class="fontebranca">Valor</span></td>
    
    <td width="85" align="center" bgcolor="#0490fc"><span class="fontebranca">Agência e Conta</span></td>
    
    <td width="20" align="center" bgcolor="#0490fc"><span class="fontebranca">Impr.</span></td>
    
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

$id_cliente = $array['id_cliente'];
$cliente = mysql_query("SELECT * FROM cliente WHERE id_cliente = '$id_cliente'");

	while($clientes = mysql_fetch_array($cliente)) {
// Variável para capturar o campo "nome" no banco de dados
		$mat = $clientes['matricula'];
		$diretor = $clientes['dir_culto'];

		$nome = $array["nome"];
		$nm = $array['nosso_numero'];

		$banco = $array['id_banco'];
	
	
	
	if (empty($clientes['dir_culto']) || empty($clientes['cpfcnpj']) || empty($clientes['end_dir'])){
		 echo "<tr style='color:red;'>";
		
		} else {
			echo '<tr>';
		}
?>
    <td><input type="checkbox" name="id_venda[]" class="marcar" value="<?php echo $array['id_venda'] ?>" id="marcar"></td>
    <td align="left"><?php echo $mat; ?></td>
    <td align="left"><?php echo $diretor; ?></td>
    <td align="left"><?php echo $array['centro']; ?></td>
    <td align="left"><?php echo $array['ref']; ?></td>
    <td align="left"><?php echo $array['id_venda']; ?></td>
    <td align="center"><?php echo $array['datav']; ?></td>
    <td align="center"><?php echo exibeData($array['data']); ?></td>    
    <td align="right"><?php echo number_format($array['v'], 2, ',', '.'); ?></td>
    <td align="center"><?php echo $array['banco_receb'].' / '.$array['conta'].'-'.$array['dv_receb']; ?></td>
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
   
   <td align="center" valign="middle">
    
    <?php if(empty($array['pedido'])){ ?>
    <div class="btn-group">
    <a class="btn btn-default" href="php/reenviarmail.php?id_venda=<?php echo $array['id_venda'] ?>&idcliente=<?php echo $array['id_cliente'] ?><?php echo $vari ?>" title="Reenviar fatura por e-mail" style="color:#F60">
    <i class="icon-envelope"></i></a>
    <?php }else{?>
		CARNE   
    <?php } ?>

<a class="btn btn-default" href="pg/editafatura.php?id_venda=<?php echo $array['id_venda'] ?>" class="editar" title="Editar fatura"  
onclick="NovaJanela(this.href,'nomeJanela','650','450','yes');return false" style="color:#069"><i class="icon-edit"></i></a></span>

<?php if ($banco == 5){	?> 
<a class="btn btn-default" href="<?php echo "boleto/boleto_itau.php?id_venda=".$array['id_venda']; ?>" target="_blank" class="editar" style="color:#333" title="Imprimir fatura"><i class="icon-print"></i></a>

<?php } else if ($banco == 4){?>
<a class="btn btn-default" href="<?php echo "boleto/boleto_itau.php?id_venda=".$array['id_venda']; ?>" target="_blank" class="editar" style="color:#333" title="Imprimir fatura"><i class="icon-print"></i></a>

<?php } else {?>
<a class="btn btn-default" href="<?php echo "boleto/".$link."?id_venda=".$array['id_venda']; ?>" target="_blank" class="editar" style="color:#333" title="Imprimir fatura"><i class="icon-print"></i></a>

<?php }?>

      <?php if(isset($_GET['p'])){ 
$pg = $_GET['p']; ?>
      <a class="btn btn-default" href="pg/baixamanual.php?id_venda=<?php echo $array['id_venda']; ?>" class="editar" title="Dar Baixa no título (Receber)" onclick="NovaJanela(this.href,'nomeJanela','650','450','yes');return false" style="color:#390"><i class="icon-circle-arrow-down"></i></a>
      <?php }else{ ?>
      <a class="btn btn-default" href="pg/baixamanual.php?id_venda=<?php echo $array['id_venda']; ?>&pagina=fatpendente" class="editar" title="Dar Baixa no título (Receber)" onclick="NovaJanela(this.href,'nomeJanela','900','500','yes');return false" style="color:#390"><i class="icon-circle-arrow-down"></i></a> </span>
      <?php } ?>
    </div></td>
  </tr>
<?php } } ?> 
	<tr>
    	<td colspan="12" bgcolor="#0490fc">
        <button type="submit" class="btn deleteboton ewButton" id="btnsubmit" onClick="return validaCheckbox(this);"/ >
        <i class="icon-trash icon-white"></i> Deletar Selecionados</button>
        
      	<input class="btn btn-success ewButton" name="Cancelar" onclick="return baixaVarios();" value="Baixar Vários" style="width:80px;">
        <?php 
		$sqlsoma = mysql_query("SELECT count(*) AS val FROM faturas WHERE situacao ='P'");
		$c = mysql_fetch_array($sqlsoma);
			$total = $c['val'];	

		?>
        <div id="total-faturas"><strong>Total: <?php echo number_format($total, 0, ',', '.') ?>&nbsp;registros</strong> </div>
        
</table>
</form>
</div>

<?php
// Depois que selecionou todos os nome, pula uma linha para exibir os links(próxima, última...)
echo "<br />";
// Gera outra variável, desta vez com o número de páginas que será precisa. 
// O comando ceil() arredonda "para cima" o valor
$pags = ceil($total_registros/$qnt);
// Exibe o primeiro link "primeira página", que não entra na contagem acima(3)
if ($pags>1){
echo "<a class=\"pag\" href=\"#\" onclick=\"sendPost('inicio.php?pg=fatpendente".$part."',{".$filtro."}, '1')\" target=\"_self\">&laquo;&laquo; Primeira</a> ";
}
?>
&nbsp;

<select name="p" onchange="sendPost('inicio.php?pg=fatpendente<?php echo $part;?>',{<?php echo $filtro; ?>}, this.value );" style="width: 50px;">          
<option selected="selected"><?php echo $p; ?> </option>
<?php
// Cria um for() para exibir os 3 links antes da página atual
for($i = 1; $i <= $pags; $i++) {
	echo "<option value=\"$i\">$i</option>";
}
echo "</select>&nbsp;";
if ($pags>1){
// Exibe o link "última página"
echo "<a class=\"pag\" href=\"#\" onclick=\"sendPost('inicio.php?pg=fatpendente".$part."',{".$filtro."}, '".$pags."')\" target=\"_self\">Ultima &raquo;&raquo;</a> ";
}
?>
&nbsp;&nbsp;|&nbsp;&nbsp;Total de Faturas: <?php echo $total_registros; ?>