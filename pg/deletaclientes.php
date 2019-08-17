<?php 
session_start();
//se nao existir volta para a pagina do form de login
if(!isset($_SESSION['login_session']) and !isset($_SESSION['senha_session'])){
	header("Location:../index.php");
	exit;		
}

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
	$campo = 'f.dbaixa';
	}
$part .= '&campo='.$campo;

?>
<div id="conteudoform">
<script type="text/javascript">

var basePath = 'inicio.php?pg=listaclientes';
window.onload = function(){
    document.getElementById('paginacao').onchange = function(){
        window.location = basePath + '&p=' + this.value;
    }
}


function trocaPagina (pagina){
	window.location = 'inicio.php?pg=listaclientes' + '&p=' + pagina;
	}

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
<script src="js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="js/jquery.mask-money.js"></script>
<script type="text/javascript" src="js/jquery.maskedinput.js"></script>
<script type="text/javascript">
    jQuery(function ($) {
           	$("#cpf").mask("999.999.999-99");
           	$("#cep").mask("99999-999");
			$("#cep_dir").mask("99999-999");
 
        });

</script>
<div id="entrada">
<div id="cabecalho"><h2><i class="icon-user iconmd"></i> Exclusão de Clientes </h2></div>

<div id="forms" style="display:table;padding-bottom:5px;">
  
  <div style="float:left; width:600px">
     <form action="inicio.php?pg=deletaclientes" method="post" enctype="multipart/form-data">
	    <span class="avisos">&nbsp;*Escolha o tipo de pesquisa e digite o valor a ser pesquisado ao lado</span><br/>
    	
        <select name="select_pesquisa" id="select_pesquisa">
        	<option value="matricula">Pela Matricula</option>
            <option value="diretor">Pelo Diretor Espiritual</option>
        	<option value="presidente">Pelo Presidente</option>            
        	<option value="centro">Pelo nome do Centro/Terreiro</option>
        	<option value="endenreco">Pelo Endereço/Logradouro</option>
        	<option value="bairro">Pelo Bairro</option>
            <option value="cidade">Pela Cidade</option>
        	<option value="cep">Pelo CEP</option>            
        	<option value="apelido">Pelo Digina/Como conhecido</option>            
        	<option value="cpf">Pelo CPF</option>
        	<option value="filiacao">Pela Filiacao</option>
        	<option value="corretor">Pelo Corretor</option>
        	<option value="telefone">Pelo Telefone/Celular</option>
            <option value="mensalidade">Pela Mensalidade</option>
        	<option value="anuidade">Pela Anuidade</option>           
        	<option value="email">Pelo E-mail</option>
        </select>
        &nbsp;&nbsp;&nbsp;
        
        <input name="input_pesquisa" type="text" style="width:190px;">
    	<button type="submit" class="btn ewButton" name="pesq1" id="btnsubmit" style="margin-top:-10px;"/>
    	<i class="icon-search  icon-white"></i></button>
    </form>
  </div>
    
</div>
<div id="forms">
<?php

if(isset($_POST["input_pesquisa"]) && $_POST["input_pesquisa"] != ""){

		$pesquisar = $_POST["input_pesquisa"];
		
     
	    	if ($_POST["select_pesquisa"] == "matricula"){
				$sql_1 .= "AND matricula LIKE '%$pesquisar%'";
			} else if ($_POST["select_pesquisa"] == "diretor"){
				$sql_1 .= "AND dir_culto LIKE '%$pesquisar%'";
			} else if ($_POST["select_pesquisa"] == "presidente"){
				$sql_1 .= "AND nome LIKE '%$pesquisar%'";
            } else if ($_POST["select_pesquisa"] == "centro"){
				$sql_1 .= "AND centro LIKE '%$pesquisar%'";
			} else if ($_POST["select_pesquisa"] == "endereco"){
				$sql_1 .= "AND endereco LIKE '%$pesquisar%' OR end_dir LIKE '%$pesquisar%'";
			} else if ($_POST["select_pesquisa"] == "bairro"){
				$sql_1 .= "AND bairro LIKE '%$pesquisar%' OR bairro_dir LIKE '%$pesquisar%'";
			} else if ($_POST["select_pesquisa"] == "cidade"){
				$sql_1 .= "AND cidade LIKE '%$pesquisar%' OR cidade_dir LIKE '%$pesquisar%'";
			} else if ($_POST["select_pesquisa"] == "cep"){
				$sql_1 .= "AND cep LIKE '%$pesquisar%' OR cep_dir LIKE '%$pesquisar%'";
			} else if ($_POST["select_pesquisa"] == "cpf"){
				$sql_1 .= "AND cpfcnpj LIKE '%$pesquisar%' OR cpf_pres LIKE '%$pesquisar%'";
			} else if ($_POST["select_pesquisa"] == "filiacao"){
				$sql_1 .= "AND filiacaopai_pres LIKE '%$pesquisar%' OR filiacaomae_pres LIKE '%$pesquisar%' OR filiacao_pai LIKE '%$pesquisar%' OR filiacao_mae LIKE '%$pesquisar%'";
			} else if ($_POST["select_pesquisa"] == "corretor"){
				$sql_1 .= "AND corretor LIKE '%$pesquisar%'";
			} else if ($_POST["select_pesquisa"] == "telefone"){
				$sql_1 .= "AND telefone LIKE '%$pesquisar%' OR celular LIKE '%$pesquisar%'";
			} else if ($_POST["select_pesquisa"] == "mensalidade"){
				$sql_1 .= "AND valor LIKE '%$pesquisar%'";
			} else if ($_POST["select_pesquisa"] == "anuidade"){
				$sql_1 .= "AND valor_anual LIKE '%$pesquisar%'";
			} else if ($_POST["select_pesquisa"] == "email"){
				$sql_1 .= "AND email LIKE '%$pesquisar%'";
			} else if ($_POST["select_pesquisa"] == "apelido"){
				$sql_1 .= "AND subnick LIKE '%$pesquisar%'";
			} else {
				echo "<span class='avisos'>Não encontrado! Experimente pesquisar na página de todos os Clientes!</span>";
			}
				$sql_1 .= " ORDER BY matricula DESC";
} else {
	$sql_1 = "SELECT * FROM cliente ORDER BY matricula DESC";
}

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
echo "<a class=\"pag\" href=\"inicio.php?pg=listaclientes&p=1\" target=\"_self\">&laquo;&laquo; Primeira</a> ";
}
?>
&nbsp;
<select id="paginacao" style="width:60px;">
<option selected="selected"><?php echo $p; ?> </option>
<?php
// Cria um for() para exibir os 3 links antes da página atual
for($i = 1; $i <= $pags; $i++) {
	//	echo "<option><a class=\"pag\" href=\"inicio.php?pg=listaclientesincompletos&p=".$i."\" target=\"_self\">".$i."</a></option> ";
	echo "<option value=\"$i\">$i</option>";
}
echo "</select>&nbsp;";
if ($pags>1){
// Exibe o link "última página"
echo "<a class=\"pag\" href=\"inicio.php?pg=listaclientes&p=".$pags."\" target=\"_self\">Ultima &raquo;&raquo;</a> ";
}
?>
&nbsp;&nbsp;|&nbsp;&nbsp;Total de Clientes: <?php echo $total_registros; ?>

<div id="fundo-tabela">

<table width="100%" border="0" cellspacing="1" cellpadding="5" data-rowindex="1" data-rowtype="1">
<tbody>
  <tr>
    <td width="5%" bgcolor="#0490fc"><span class="fontebranca"><a style="color:#fff; text-decoration:none;" href="#" onclick="sendPost('inicio.php?pg=listaclientes=<?php echo $o;?>&campo=c.matricula',{<?php echo $filtro; ?>}, '1')" target="_self">Matr&nbsp;<i class="icon-arrow-down"></i></a></span></td>
    <td width="20%" bgcolor="#0490fc"><span class="fontebranca">Diretor (a) Espíritual</span></td>
    <td width="20%" bgcolor="#0490fc"><span class="fontebranca">Presidente </span></td>
    <td width="16%" bgcolor="#0490fc"><span class="fontebranca">Centro / Terreiro</span></td>
    <td width="11%" bgcolor="#0490fc"><span class="fontebranca">Município do Centro</span></td>
    <td width="5%" bgcolor="#0490fc"><span class="fontebranca">Situação</span></td>
    <td width="4%" align="center" bgcolor="#0490fc"><span class="fontebranca">Valor</span></td>
    <td width="9%" align="center" bgcolor="#0490fc"><span class="fontebranca">Grupo</span></td>
    <td width="9%" align="center" bgcolor="#0490fc"><span class="fontebranca">Última Mensalidade Paga</span></td>
    <td width="5%" align="center" bgcolor="#0490fc"><span class="fontebranca">Ação</span></td>
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
$idgrupo = $array['id_grupo'];
	
	if ($array['situacao'] == "I"){/////////Verifica se cliente ISENTO, senão verifica ultima mensalidade
		$ultima_mensalidade = 'Isento';
		$verifica_atraso = '2';
	} else {
		$ultima_mensalidade = ultimaMensalidade($array['id_cliente']);
		$verifica_atraso = verificaAtraso($ultima_mensalidade);	
	}
	
if (empty($array['dir_culto']) || empty($array['cpfcnpj']) || empty($array['end_dir']) || empty($array['bairro_dir']) || empty($array['cep_dir']) || empty($array['rg']) || empty($array['cpfcnpj']) || empty($array['rg']) || empty($array['cidade']) || empty($array['uf'])){ 
		 echo "<tr style='color:red;'>";
		} else {
			echo '<tr>';
		}

?>
    <td align="center"><?php echo $array['matricula'] ?></td>
    <td align="left"><?php echo $array['dir_culto']; ?></td>
    <td align="left"><?php echo $array['nome']; ?></td>
    <td align="left"><?php echo $array['centro']; ?></td>
    <td align="left"><?php echo $array['cidade_dir']; ?></td>
    <td align="center"><?php echo getSituacao($array['situacao']); ?></td>
    <td align="center"><?php echo number_format($array['valor'],'2',',','.'); ?></td>
    <?php 
		$dad = mysql_query("SELECT * FROM grupo WHERE id_grupo = '$idgrupo'");
		$dado = mysql_fetch_array($dad);
		if($dado['nomegrupo'] == ""){ $grupo = "AVULSO";
		} else { $grupo = $dado['nomegrupo']; }
	?>
    <td align="left"><?php echo $grupo; ?></td>
    
    <td align="center" <?php if ($verifica_atraso == '1'){ echo "style='color:red;font-weight:bold;'";} ?> ><?php echo $ultima_mensalidade ?></td>
    
    <td align="right">
                <div class="btn-group">
            
            <a class="btn btn-default"
            href="javascript:confirmar_cliente('?pg=listaclientes&deleta=cliente&id=<?php echo $array['id_cliente'] ?>&p=<?php echo $p ?>')"
             style="text-decoration:none;" title="Excluir cadastro"> 
           <i class="icon-trash"></i></a>
  
            </div>
    </td>
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

// Gera outra variável, desta vez com o número de páginas que será precisa. 
// O comando ceil() arredonda "para cima" o valor
$pags = ceil($total_registros/$qnt);
// Exibe o primeiro link "primeira página", que não entra na contagem acima(3)
if ($pags>1){
echo "<a class=\"pag\" href=\"inicio.php?pg=listaclientes&p=1\" target=\"_self\">&laquo;&laquo; Primeira</a> ";
}
?>
&nbsp;
<select id="paginacao" style="width:60px;" onchange="trocaPagina (this.value)">
<option selected="selected"><?php echo $p; ?> </option>
<?php
// Cria um for() para exibir os 3 links antes da página atual
for($i = 1; $i <= $pags; $i++) {
	//	echo "<option><a class=\"pag\" href=\"inicio.php?pg=listaclientesincompletos&p=".$i."\" target=\"_self\">".$i."</a></option> ";
	echo "<option value=\"$i\">$i</option>";
}
echo "</select>&nbsp;";
if ($pags>1){
// Exibe o link "última página"
echo "<a class=\"pag\" href=\"inicio.php?pg=listaclientesincompletos&p=".$pags."\" target=\"_self\">Ultima &raquo;&raquo;</a> ";
}
?>