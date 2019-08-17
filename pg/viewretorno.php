<?php 
session_start();
//se nao existir volta para a pagina do form de login
if(!isset($_SESSION['login_session']) and !isset($_SESSION['senha_session'])){
	header("Location:../index.php");
	exit;		
}
?>

<script src="js/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
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
<div id="cabecalho"><h2><i class="icon-external-link-sign  iconmd"></i> Relatório dos arquivos de Retorno</h2></div>

<div id="forms" style="display:table;padding-bottom:5px;">
  <div style="float:left;width:300px"">
	<form action="inicio.php?pg=viewretorno" method="post" enctype="multipart/form-data">
			<span class="avisos">&nbsp;*Pesquise pelo numero do documento</span><br/>
		<input name="pesquizar" type="text">
		<button type="submit" class="btn ewButton" name="pesq" id="btnsubmit" style="margin-top:-10px;"/>
		<i class="icon-search  icon-white"></i></button>
	</form>  	
  </div>
 
</div>



<div id="forms">
<?php
if(isset($_POST['pesquizar']) && $_POST['pesquizar'] != ""){
$pesquisar = $_POST['pesquizar'];
$sql_1 = "SELECT * FROM relatorio_retorno WHERE nosso_numero LIKE '%$pesquisar%' ORDER BY id DESC";

}else{
$sql_1 = "SELECT * FROM relatorio_retorno ORDER BY id DESC";	
}


///////// CONFIGURAÇÂO DAS QUANTIDADE DE PAGINAS/REGISTROS EXIBIDAS(OS)
@$p = $_GET["p"];
if(isset($p)) {
$p = $p;
} else {
$p = 1;
}
$qnt = 300;
$inicio = ($p*$qnt) - $qnt;
?>




<div id="fundo-tabela">
<table width="100%" border="0" cellspacing="1" cellpadding="5" data-rowindex="1" data-rowtype="1">
<tbody>
  <tr>
    <td width="20" bgcolor="#0490fc"><input type="checkbox" name="todos" id="todos" value="todos" onclick="marcardesmarcar();" /></td>
    <td width="50" bgcolor="#0490fc"><span class="fontebranca">Nosso Número</span></td>
    <td width="40" bgcolor="#0490fc"><span class="fontebranca">Matricula</span></td>
    <td width="60" align="center" bgcolor="#0490fc"><span class="fontebranca">Agência / Conta</span></td>
    <td width="55" align="center" bgcolor="#0490fc"><span class="fontebranca">Valor</span></td>
    <td width="155" align="center" bgcolor="#0490fc"><span class="fontebranca">Cod da Ocorrencia</span></td>
   
    <td width="60" align="center" bgcolor="#0490fc"><span class="fontebranca">Data da Ocorrencia</span></td>
    <td width="60" align="center" bgcolor="#0490fc"><span class="fontebranca">Data do credito</span></td>
    <td width="260" align="center" bgcolor="#0490fc"><span class="fontebranca">cod da liquidação</span></td>

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
$nm = $array['nosso_numero'];

$sql_fatura = mysql_query("SELECT * FROM faturas WHERE id_venda = $nm");
$fatura = mysql_fetch_array($sql_fatura);

$cliente = getCliente($fatura['id_cliente']);


?>
  <tr>
    <td><input type="checkbox" name="id_venda[]" class="marcar" value="<?php echo $array['id_venda'] ?>" id="marcar"></td>
    <td align="left"><?php echo $array['nosso_numero']; ?></td>
    <td align="center"><?php echo $cliente['matricula']; ?></td>
    <td align="center"><?php echo $array['ag_receb'].' </br> '.$array['conta_receb'].'-'.$array['dac']; ?></td>
    <td align="right"><?php echo number_format($array['valor'], 2, ',', '.'); ?></td>
    <td align="center"><?php echo getDescricaoCodigo($array['c_ocorrencia']); ?></td>
    
    <td align="center"><?php echo formataDataSimples($array['d_ocorrencia']); ?></td>
    <td align="center"><?php echo formataDataSimples($array['d_credito']); ?></td>
    <td align="center"><?php echo getDescricaoLiquidacao($array['c_liquidacao']); ?></td>
       
  </tr>
<?php } ?> 
	<tr>
    	<td colspan="12" bgcolor="#0490fc">
        <button type="submit" class="btn deleteboton ewButton" id="btnsubmit" onClick="return validaCheckbox(this);"/ >
        <i class="icon-trash icon-white"></i> Deletar Selecionados</button>

        <?php 
		$sql_select_all = "SELECT * FROM relatorio_retorno";
// Executa o query da seleção acimas
$sql_query_all = mysql_query($sql_select_all);
// Gera uma variável com o número total de registros no banco de dados
$total_registros = mysql_num_rows($sql_query_all);

		?>
        <div id="total-faturas"><strong>Valor total de registros: <?php echo $total_registros ?></strong> </div>
	</td></tr>
</table>
</form>
</div>

<?php
// Depois que selecionou todos os nome, pula uma linha para exibir os links(próxima, última...)
echo "<br />";

// Faz uma nova seleção no banco de dados, desta vez sem LIMIT, 
// O comando ceil() arredonda "para cima" o valor
$pags = ceil($total_registros/$qnt);
// Número máximos de botões de paginação
$max_links = 3;
// Exibe o primeiro link "primeira página", que não entra na contagem acima(3)
echo "<a class=\"pag\" href=\"inicio.php?pg=viewretorno&p=1\" target=\"_self\">&laquo;&laquo; Primeira</a> ";
// Cria um for() para exibir os 3 links antes da página atual
for($i = $p-$max_links; $i <= $p-1; $i++) {
// Se o número da página for menor ou igual a zero, não faz nada
// (afinal, não existe página 0, -1, -2..)
if($i <=0) {
//faz nada
// Se estiver tudo OK, cria o link para outra página
} else {
echo "<a class=\"pag\" href=\"inicio.php?pg=viewretorno&p=".$i."\" target=\"_self\">".$i."</a> ";
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
echo "<a class=\"pag\" href=\"inicio.php?pg=viewretorno&p=".$i."\" target=\"_self\">".$i."</a> ";
}
}
// Exibe o link "última página"
echo "<a class=\"pag\" href=\"inicio.php?pg=viewretorno&p=".$pags."\" target=\"_self\">Ultima &raquo;&raquo;</a> ";
?>
</div>


