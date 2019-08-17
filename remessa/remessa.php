<?php 
session_start();
//se nao existir volta para a pagina do form de login
if(!isset($_SESSION['login_session']) and !isset($_SESSION['senha_session'])){
	header("Location:../index.php");
	exit;		
}

if (isset($_GET["doc"]) && $_GET["doc"] != ''){
    $removeDaRemessa = mysql_query("UPDATE faturas SET remessa = 1 WHERE id_venda = ".$_GET["doc"]);
}
/* 	$data_h = date("Y-m-d");
	$muda = mysql_query("SELECT * FROM faturas") or die(mysql_error());
	while($conf = mysql_fetch_array($muda)){
		$data_v =  $conf['data_venci'];
		
		if(strtotime($data_v) > strtotime($data_h)){ */
			$baixa = mysql_query("UPDATE faturas SET situacao = 'V' WHERE situacao != 'B' AND data_venci < DATE(NOW())");	
/* 	}
	} */
	
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
<div id="entrada">
<div id="cabecalho"><h2><i class="icon-external-link-sign  iconmd"></i> Gerar arquivo de  Remessa</h2></div>

<div id="forms" style="display:table;padding-bottom:5px;">
  <div style="float:left;width:300px"">
	<form action="inicio.php?pg=remessa" method="post" enctype="multipart/form-data">
			<span class="avisos">&nbsp;*Pesquise pelo DIRETOR ou numero do documento</span><br/>
		<input name="pesquizar" type="text">
		<button type="submit" class="btn ewButton" name="pesq" id="btnsubmit" style="margin-top:-10px;"/>
		<i class="icon-search  icon-white"></i></button>
	</form>  	
  </div>
  <div style="float:left;width:300px">
	<span class="avisos">* Ou entre datas de vencimento</span><br/>
	<form action="inicio.php?pg=remessa" method="post" enctype="multipart/form-data" name="formu" id="formu" onSubmit="return datas(this);">
	<input name="datai" type="text" style="width:100px;" class="data"> e <input name="dataf" type="text" style="width:100px;" class="data">
	<button type="submit" class="btn ewButton" name="pesq" id="btnsubmit" style="margin-top:-10px;"/>
	<i class="icon-search  icon-white"></i></button>
	</form>
  </div>
  <div style="float:left;width:300px">
	<form action="inicio.php?pg=remessa" method="post" enctype="multipart/form-data">
		
		<span class="avisos">&nbsp;*Pesquise pela MATRÍCULA</span><br/>
		<input name="matric" type="text">
		<button type="submit" class="btn ewButton" name="pesq" id="btnsubmit" style="margin-top:-10px;"/>
		<i class="icon-search  icon-white"></i></button>
		</form>
  </div>
</div>

<div id="forms">
<?php 
$res = mysql_query("SELECT * FROM bancos WHERE situacao='1'");
$list = mysql_fetch_array($res);
$id_banco = $list['id_banco'];
/* if($list['id_banco'] != '4' && $list['id_banco'] != '1'){
	
echo '<h3>Este sistema gera remessa somente para os bancos ITAU ou BB. Por favor ative o banco para gerar o arquivo de remessa.</h3>';
exit;
} */
?>
<form name="form" action="remessa/gerar_remessa.php" method="post" enctype="multipart/form-data" onsubmit="return excluir(this);">
<input name="pg" type="hidden" value="<?php echo $_GET['pg'] ?>">
<?php
if(isset($_POST['pesquizar']) && $_POST['pesquizar'] != ""){
$pesquisar = $_POST['pesquizar'];
$sql_1 = "SELECT f.*, c.*, date_format(data_venci, '%d/%m/%Y') AS data, f.valor AS v FROM faturas AS f INNER JOIN cliente AS c ON f.id_cliente = c.id_cliente WHERE f.id_banco =".$id_banco." AND f.remessa ='0' AND (c.dir_culto LIKE '%$pesquisar%' OR f.nosso_numero LIKE '%$pesquisar%') ORDER BY ".$campo." ".$ordem;

} elseif(isset($_POST['matric']) && $_POST['matric'] != ""){
$pesquisar = $_POST['matric'];
$sql_1 = "SELECT f.*, c.*, date_format(data_venci, '%d/%m/%Y') AS data, f.valor AS v FROM faturas AS f INNER JOIN cliente AS c ON f.id_cliente = c.id_cliente WHERE f.id_banco = ".$id_banco." AND f.remessa ='0' AND (c.matricula LIKE '%$pesquisar%') ORDER BY ".$campo." ".$ordem;

} elseif(isset($_POST['datai']) && $_POST['datai'] and $_POST['dataf'] != ""){	
$datai = implode("-",array_reverse(explode("/",$_POST['datai'])));
$dataf = implode("-",array_reverse(explode("/",$_POST['dataf'])));			
$sql_1 = "SELECT f.*, c.*, date_format(data_venci, '%d/%m/%Y') AS data, f.valor AS v FROM faturas AS f INNER JOIN cliente AS c ON f.id_cliente = c.id_cliente WHERE f.id_banco = ".$id_banco." AND f.remessa ='0' AND f.data_venci BETWEEN ('$datai') AND ('$dataf') ORDER BY ".$campo." ".$ordem;	

}else{
$sql_1 = "SELECT f.*, c.*, date_format(data_venci, '%d/%m/%Y') AS data, f.valor AS v FROM faturas AS f INNER JOIN cliente AS c ON f.id_cliente = c.id_cliente WHERE f.id_banco =".$id_banco." AND f.remessa ='0' ORDER BY ".$campo." ".$ordem;		
}

@$p = $_GET["p"];
if(isset($p)) {
$p = $p;
} else {
$p = 1;
}
$qnt = 4000;
$inicio = ($p*$qnt) - $qnt;
?>
<div id="fundo-tabela">
<table width="100%" border="0" cellspacing="1" cellpadding="5" data-rowindex="1" data-rowtype="1">
<tbody>
  <tr>
  	<td bgcolor="#0490fc"> <span class="fontebranca">N</span> </td>
    <td width="32" bgcolor="#0490fc"><input type="checkbox" name="todos" id="todos" value="todos" onclick="marcardesmarcar();" /></td>
     <td width="60" bgcolor="#0490fc"><span class="fontebranca"><a style="color:#fff; text-decoration:none;" href="inicio.php?pg=remessa&o=<?php echo $o;?>&campo=c.matricula" target="_self">Matr&nbsp;<i class="icon-arrow-down"></i></a></span></td>
     
    <td width="300" bgcolor="#0490fc"><span class="fontebranca"><a style="color:#fff; text-decoration:none;" href="inicio.php?pg=remessa&o=<?php echo $o;?>&campo=c.dir_culto" target="_self">Diretor do Culto&nbsp;<i class="icon-arrow-down"></i></a></span></td>
    
    <td width="350" bgcolor="#0490fc"><span class="fontebranca">Descrição</span></td>
    
    <td width="65" bgcolor="#0490fc"><span class="fontebranca"><a style="color:#fff; text-decoration:none;" href="inicio.php?pg=remessa&o=<?php echo $o;?>&campo=f.id_venda" target="_self">Nº Doc&nbsp;<i class="icon-arrow-down"></i></a></span></td>
    
    <td width="88" align="center" bgcolor="#0490fc"><span class="fontebranca"><a style="color:#fff; text-decoration:none;" href="inicio.php?pg=remessa&o=<?php echo $o;?>&campo=data_venci" target="_self">Venc.&nbsp;<i class="icon-arrow-down"></i></span></td>
    
    <td width="63" align="center" bgcolor="#0490fc"><span class="fontebranca">Valor</span></td>
    
    <td width="115" align="center" bgcolor="#0490fc"><span class="fontebranca">Status</span></td>
    <td width="55" align="center" bgcolor="#0490fc"><span class="fontebranca">Op</span></td>
    <td width="55" align="center" bgcolor="#0490fc"><span class="fontebranca">Ação</span></td>

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
$cliente = mysql_query("SELECT * FROM cliente WHERE id_cliente = '$id_cliente'");//BUSCA O CLIENTE

while($clientes = mysql_fetch_array($cliente)) {

$mat = $clientes['matricula'];
$diretor = $clientes['dir_culto'];

// Variável para capturar o campo "nome" no banco de dados
$nome = $array["nome"];
$nm = $array['nosso_numero'];
// Exibe o nome que está no BD e pula uma linha

$banco = $array['id_banco'];
$contador++;
//TESTAR SE O CADASTRO ESTA COMPLETO COM OS DADOS MINIMOS
if (empty($array['dir_culto']) || empty($array['cpfcnpj']) || empty($array['endereco']) || empty($array['bairro']) || empty($array['cep']) || empty($array['rg']) || empty($array['cpfcnpj']) || empty($array['rg']) || empty($array['cidade']) || empty($array['uf']) || $array['cep'] == '-' || validaCpf($array['cpfcnpj']) === false){
	echo '<tr style="color:red;">';
	} else {
		echo '<tr>';
		}
?>
	<td><?php echo $contador ?></td>
    <td><input type="checkbox" name="id_venda[]" class="marcar" value="<?php echo $array['id_venda'] ?>" id="marcar"></td>
  	<td align="left"><?php echo $mat; ?></td>
    <td align="left"><?php echo $diretor; ?></td>
    <td align="left"><?php echo $array['ref']; ?></td>
    <td align="center"><?php echo $array['id_venda']; ?></td>
    <td align="center"><?php echo $array['data']; ?></td>
    <td align="right"><?php echo number_format($array['v'], 2, ',', '.'); ?></td>
    <td align="center">
    <?php 
	if($array['remessa'] == '0'){
		echo "Não gerado";	
	}else{
		echo "Gerado";	
	}
	?>
    </td>
    <td><?php 
	if($array['codigo_operacao'] == '2' || $array['codigo_operacao'] == '34'){
		echo "Baixa";	
	}else{
		echo "Inclusão";	
	}
	?></td>
    <td>
      <a class="btn btn-default"
            href="inicio.php?pg=remessa&doc=<?php echo $array['id_venda'] ?>"
             style="text-decoration:none;" title="Excluir  da remessa!"> 
           <i class="icon-trash"></i></a>
    </td>

    </tr>
<?php } } ?> 
	<tr>
    	<td colspan="7" bgcolor="#0490fc">
        <button type="submit" class="btn deleteboton ewButton" id="btnsubmit" onclick="return confirm('Gerar remessa para todos selecionados?')" style="width:200px;"/ >
        <i class="icon-text icon-white"></i> Gerar remessa dos Selecionados</button>
       
        <div id="total-faturas"><strong>Total: <?php echo number_format($contador, 0, ',', '.') ?>&nbsp;registros</strong> </div>

</table>
</form>
</div>

<?php
// Depois que selecionou todos os nome, pula uma linha para exibir os links(próxima, última...)
echo "<br />";

// Faz uma nova seleção no banco de dados, desta vez sem LIMIT, 
// para pegarmos o número total de registros
$sql_select_all = "SELECT * FROM faturas WHERE remessa='0'";
// Executa o query da seleção acimas
$sql_query_all = mysql_query($sql_select_all);
// Gera uma variável com o número total de registros no banco de dados
$total_registros = mysql_num_rows($sql_query_all);
// Gera outra variável, desta vez com o número de páginas que será precisa. 
// O comando ceil() arredonda "para cima" o valor
$pags = ceil($total_registros/$qnt);
// Número máximos de botões de paginação
$max_links = 3;
// Exibe o primeiro link "primeira página", que não entra na contagem acima(3)
echo "<a class=\"pag\" href=\"inicio.php?pg=remessa&p=1".$part."\" target=\"_self\">&laquo;&laquo; Primeira</a> ";
// Cria um for() para exibir os 3 links antes da página atual
for($i = $p-$max_links; $i <= $p-1; $i++) {
// Se o número da página for menor ou igual a zero, não faz nada
// (afinal, não existe página 0, -1, -2..)
if($i <=0) {
//faz nada
// Se estiver tudo OK, cria o link para outra página
} else {
echo "<a class=\"pag\" href=\"inicio.php?pg=remessa&p=".$i.$part."\" target=\"_self\">".$i."</a> ";
}
}
// Exibe a página atual, sem link, apenas o número
echo "<span class=\"pags\">".$p."&nbsp;</span> ";
// Cria outro for(), desta vez para exibir 3 links após a página atual
for($i = $p+1; $i <= $p+$max_links; $i++) {
// Verifica se a página atual é maior do que a última página. Se for, não faz nada.
if($i > $pags)
{
//faz nada
}
// Se tiver tudo Ok gera os links.
else
{
echo "<a class=\"pag\" href=\"inicio.php?pg=remessa&p=".$i.$part."\" target=\"_self\">".$i."</a> ";
}
}
// Exibe o link "última página"
echo "<a class=\"pag\" href=\"inicio.php?pg=remessa&p=".$pags.$part."\" target=\"_self\">Ultima &raquo;&raquo;</a> ";
?>
</div>


