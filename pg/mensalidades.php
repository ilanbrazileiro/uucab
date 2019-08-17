﻿<?php
session_start();
//se nao existir volta para a pagina do form de login
if(!isset($_SESSION['login_session']) and !isset($_SESSION['senha_session'])){
	header("Location:../index.php");
	exit;		
}

//////////// SELECIONAR O ANO
if (isset($_POST['selecionarano'])) {
	// Recupera os dados dos campos
	$selecionarano = $_POST['selecionarano'];

		$sql = mysql_query("UPDATE config SET ano_ref = '".$selecionarano."'");
		//if ($sql){$this->session->set_flashdata('success',"Exibindo mensalidades do ano $selecionarano");
		//redirect('mensalidades');
		//}
}
include "../classes/conexao.php";
include "../classes/funcoes.class.php";

/////////////////ORDENA AS PAGINAS
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
//////////////// CAMPO PARA ORDENAÇÃO
$campo = $_GET['campo'];
if (empty($campo)){
	$campo = 'c.matricula';
	}
$part .= '&campo='.$campo;

?>
<div id="conteudoform">
<script type="text/javascript">
function confirmar_cliente(query){
if (confirm ("Tem certeza que deseja excluir este usuário?")){   
 window.location="php/deleta_cliente.php" + query;  
 return true;
 }
 else  
 window.location="inicio.php?pg=listaclientes";
 return false;
 }
function NovaJanela(pagina,nome,w,h,scroll){
	LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
	TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
	settings = 'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
	win = window.open(pagina,nome,settings);
	}
window.name = "main";
</script>
<div id="entrada">
<div id="cabecalho"><h2><i class="icon-user iconmd"></i> Mensalidades</h2></div>

<?php /////Formulário de Pesquisas ?>
<div id="forms" style="display:table;padding-bottom:5px;">
  <div style="float:left;width:250px">
    <form action="inicio.php?pg=mensalidades" method="post" enctype="multipart/form-data" style="display:inline;" style="width:200px;">
    <span class="avisos">&nbsp;*Pesquise pelo DIRETOR do culto</span><br/>
    <input name="pesquisa_diretor" type="text" style="width:150px;">
    <button type="submit" class="btn ewButton" name="pesq" id="btnsubmit" style="margin-top:-10px;"/>
    <i class="icon-search  icon-white"></i></button>
    </form>
  </div>

  <div style="float:left; width:250px">
    <form action="inicio.php?pg=mensalidades" method="post" enctype="multipart/form-data"  style="display:inline;" style="width:200px;">
    <span class="avisos">&nbsp;*Pesquise pela MATRICULA do cliente</span><br/>
    <input name="pesquisa_mat" type="text" style="width:150px;">
    <button type="submit" class="btn ewButton" name="pesq1" id="btnsubmit" style="margin-top:-10px;"/>
    <i class="icon-search  icon-white"></i></button>
    </form>
  </div>
  
  <div style="float:right; width:500px">
  <form action="" method="post" enctype="multipart/form-data">
  <span class="avisos" style="float:right;"> Visualizando mensalidade do ano de </span><br />
			<select name="selecionarano" onchange="this.form.submit()" style="width: 80px;float: right;margin: 3px 5px 0 0;">
				<?php
					//Selecionar os cadastros de acordo com o ano
					$sqla = mysql_query("SELECT ano_ref FROM config WHERE id = '1'");
					$a = mysql_fetch_array($sqla);	
					$ano = $a['ano_ref'];/////SELECIONA O ANO
					
					?>
					<option><?php echo $ano; ?></option>
					<option disabled="">-------</option>
					<option>2017</option>
					<option>2018</option>
					<option>2019</option>
					<option>2020</option>
                    <option>2021</option>
                    <option>2022</option>
                    <option>2023</option>
                    <option>2024</option>
                    <option>2025</option>
			</select>
	</form> 
  </div>
  
</div>


<div id="forms">
<?php
//////////////////////////////Definição das buscas
if(isset($_POST['pesquizar']) && $_POST['pesquizar'] != ""){
$pesquisar = $_POST['pesquizar'];
$sql_1 = "SELECT * FROM cliente WHERE nome LIKE '%$pesquisar%'";

} else if(isset($_POST['pesquisa_mat']) && $_POST['pesquisa_mat'] != ""){
	$pesquisar = $_POST['pesquisa_mat'];
	$sql_1 = "SELECT * FROM cliente WHERE matricula LIKE '%$pesquisar%'";

} else {
	$sql_1 = "SELECT * FROM mensalidades WHERE ano ='$ano' ORDER BY matricula_cliente DESC";	
}

//Definições de configuração da página
// Pegar a página atual por GET
@$p = $_GET["p"];
// Verifica se a variável tá declarada, senão deixa na primeira página como padrão
if(isset($p)) {
$p = $p;
} else {
$p = 1;
}
// Defina aqui a quantidade máxima de registros por página.
$qnt = 100;
// O sistema calcula o início da seleção calculando: 
// (página atual * quantidade por página) - quantidade por página
$inicio = ($p*$qnt) - $qnt;
?>

<div id="fundo-tabela">

<table width="100%" border="0" cellspacing="1" cellpadding="5" data-rowindex="1" data-rowtype="1">
<tbody>
  <tr>
    <td width="5%" bgcolor="#0490fc"><span class="fontebranca">Matrícula</span></td>
    <td width="25%" bgcolor="#0490fc"><span class="fontebranca">Diretor do Culto</span></td>
    <td width="5%" bgcolor="#0490fc"><span class="fontebranca">Jan</span></td>
    <td width="5%" bgcolor="#0490fc"><span class="fontebranca">Fev</span></td>
    <td width="5%" bgcolor="#0490fc"><span class="fontebranca">Mar</span></td>
    <td width="5%" bgcolor="#0490fc"><span class="fontebranca">Abr</span></td>
    <td width="5%" bgcolor="#0490fc"><span class="fontebranca">Mai</span></td>
    <td width="5%" bgcolor="#0490fc"><span class="fontebranca">Jun</span></td>
    <td width="5%" bgcolor="#0490fc"><span class="fontebranca">Jul</span></td>
    <td width="5%" bgcolor="#0490fc"><span class="fontebranca">Ago</span></td>
    <td width="5%" bgcolor="#0490fc"><span class="fontebranca">Set</span></td>
    <td width="5%" bgcolor="#0490fc"><span class="fontebranca">Out</span></td>
    <td width="5%" bgcolor="#0490fc"><span class="fontebranca">Nov</span></td>
    <td width="5%" bgcolor="#0490fc"><span class="fontebranca">Dez</span></td>
    
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
$id_cliente = $array['id_cliente'];
$cliente = mysql_query("SELECT * FROM cliente WHERE id_cliente = '$id_cliente'");

	while($clientes = mysql_fetch_array($cliente)) {
// Variável para capturar o campo "nome" no banco de dados
		$diretor = $clientes['dir_culto'];
	}
?>
  <tr>
    <td align="center"><?php echo $array['matricula_cliente']; ?></td>
    <td align="left"><?php echo $diretor; ?></td>
    <td align="center"><?php echo getSituacaoMensalidade($array['jan'],1,$ano, $id_cliente); ?></td>
    <td align="center"><?php echo getSituacaoMensalidade($array['fev'],2,$ano, $id_cliente); ?></td>
    <td align="center"><?php echo getSituacaoMensalidade($array['mar'],3,$ano, $id_cliente); ?></td>
    <td align="center"><?php echo getSituacaoMensalidade($array['abr'],4,$ano, $id_cliente); ?></td>
    <td align="center"><?php echo getSituacaoMensalidade($array['mai'],5,$ano, $id_cliente); ?></td>
    <td align="center"><?php echo getSituacaoMensalidade($array['jun'],6,$ano, $id_cliente); ?></td>
    <td align="center"><?php echo getSituacaoMensalidade($array['jul'],7,$ano, $id_cliente); ?></td>
    <td align="center"><?php echo getSituacaoMensalidade($array['ago'],8,$ano, $id_cliente); ?></td>
    <td align="center"><?php echo getSituacaoMensalidade($array['setembro'],9,$ano, $id_cliente); ?></td>
    <td align="center"><?php echo getSituacaoMensalidade($array['outubro'],10,$ano, $id_cliente); ?></td>
    <td align="center"><?php echo getSituacaoMensalidade($array['nov'],11,$ano, $id_cliente); ?></td>
    <td align="center"><?php echo getSituacaoMensalidade($array['dez'],12,$ano, $id_cliente); ?></td>
  </tr>
<?php } ?> 
	<tr>
    	<td colspan="6" bgcolor="#0490fc">
         <div id="total-faturas">UUCAB</div>
        </td>
    </tr>

</table>
</form>
</div>

<?php
// Depois que selecionou todos os nome, pula uma linha para exibir os links(próxima, última...)
echo "<br />";

// Faz uma nova seleção no banco de dados, desta vez sem LIMIT, 
// para pegarmos o número total de registros
$sql_select_all = "SELECT * FROM cliente";
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
echo "<a class=\"pag\" href=\"inicio.php?pg=mensalidades&p=1\" target=\"_self\">&laquo;&laquo; Primeira</a> ";
// Cria um for() para exibir os 3 links antes da página atual
for($i = $p-$max_links; $i <= $p-1; $i++) {
// Se o número da página for menor ou igual a zero, não faz nada
// (afinal, não existe página 0, -1, -2..)
if($i <=0) {
//faz nada
// Se estiver tudo OK, cria o link para outra página
} else {
echo "<a class=\"pag\" href=\"inicio.php?pg=mensalidades&p=".$i."\" target=\"_self\">".$i."</a> ";
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
echo "<a class=\"pag\" href=\"inicio.php?pg=mensalidades&p=".$i."\" target=\"_self\">".$i."</a> ";
}
}
// Exibe o link "última página"
echo "<a class=\"pag\" href=\"inicio.php?pg=mensalidades&p=".$pags."\" target=\"_self\">Ultima &raquo;&raquo;</a> ";
?>
