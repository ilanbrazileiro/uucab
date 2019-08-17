<?php
session_start();
//se nao existir volta para a pagina do form de login
if(!isset($_SESSION['login_session']) and !isset($_SESSION['senha_session'])){
	header("Location:../index.php");
	exit;		
}

////ATUALIZAR MENSALIDADES
/* as mansalidades são atualizadas pelo CRON JOBS, arquivo = atualiza_mensalidades.php*/

/////VERIFICAR A DATA ATUAL
$mes = date ('m');
$ano_atual = date ('Y');

//////////// SELECIONAR O ANO
if (isset($_POST['selecionarano'])) {
	// Recupera os dados dos campos
	$selecionarano = $_POST['selecionarano'];
		$sql = mysql_query("UPDATE config SET ano_ref = '".$selecionarano."'");
}
include "../classes/conexao.php";
include "../classes/funcoes.class.php";

if(isset($_GET['estornar'])){
	 $id = $_GET['id'];
	 $mes = $_GET['m'];
	 $ano = $_GET['a'];
	
	$sql1 = mysql_query("UPDATE `ref_mensalidade` SET situacao='0', n_fatura = '0', data_pagamento = '0' WHERE (id_cliente = '$id' AND mes = '$mes' AND ano = '$ano')")or die (mysql_error());
	$link = 'http://uucab.com.br/boletos1/inicio.php?pg=mensalidades';
	$mesa = getMesAbr($mes);
	$sql2 = mysql_query("UPDATE `mensalidades` SET ".$mesa."='0' WHERE (id_cliente = '$id' AND ano = '$ano')")or die (mysql_error());
		
	if($sql1 && $sql2){/// SE CADASTRADO, ENVIA MENSAGEM INFORMANDO
			print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=$link'>
			<script type=\"text/javascript\">
			alert(\"MENSALIDADE ESTORNADA COM SUCESSO!\");
			</script>";
	} else { /// SE SIM ENVIA MENSAGEM E RETORNA PARA  A PÁGINA
		print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=?pg=listaclientes&id=$id&m=$sqla'>
			<script type=\"text/javascript\">
			alert(\"NÃO FOI POSSÍVEL ESTORNAR A MENSALIDADE!\");
			</script>";	
		}
}

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
function NovaJanela(pagina,nome,w,h,scroll){
	LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
	TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
	settings = 'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
	win = window.open(pagina,nome,settings);
	}
window.name = "main";
</script>
<div id="entrada">
<div id="cabecalho"><h2><i class="icon-user iconmd"></i> Mensalidades em Atraso</h2></div>

<?php /////Formulário de Pesquisas ?>
<div id="forms" style="display:table;padding-bottom:5px;">
   <div style="float:left; width:500px">
    <form action="inicio.php?pg=mensalidadesematraso" method="post" enctype="multipart/form-data"  style="display:inline;" style="width:200px;">
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
if(isset($_POST['pesquisa_mat']) && $_POST['pesquisa_mat'] != ""){
	$pesquisar = $_POST['pesquisa_mat'];
	$sql_1 = "SELECT * FROM mensalidades WHERE matricula_cliente LIKE '%$pesquisar%' ";
} else {
	$sql_1 = "SELECT * FROM mensalidades WHERE ano ='$ano' AND jan = '2' OR fev = '2' OR mar = '2' OR abr = '2' OR mai = '2' OR jun = '2' OR jul = '2' OR ago = '2' OR setembro = '2' OR outubro = '2' OR nov = '2' OR dez = '2' ORDER BY matricula_cliente DESC";	
}

//Definições de configuração da página
// Pegar a página atual por GET
@$p = $_POST["p"];
if(isset($p)) {
$p = $p;
} else {
$p = 1;
}
$qnt = 100;
$inicio = ($p*$qnt) - $qnt;
?>

<div id="fundo-tabela">

<table width="100%" border="0" cellspacing="1" cellpadding="5" data-rowindex="1" data-rowtype="1">
<tbody>
  <tr>
 	<td width="5%" bgcolor="#0490fc"><span class="fontebranca">Ano</span></td> 
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
  	<td align="center"><?php echo $array['ano']; ?></td>
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

<select name="p" onchange="sendPost('inicio.php?pg=mensalidadesematraso<?php echo $part;?>',{<?php echo $filtro; ?>}, this.value );" style="width: 50px;">          
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