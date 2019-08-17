<?php 
session_start();
//se nao existir volta para a pagina do form de login
if(!isset($_SESSION['login_session']) and !isset($_SESSION['senha_session'])){
	header("Location:../index.php");
	exit;		
}
?>
<div id="conteudoform">
<script type="text/javascript">

var basePath = 'inicio.php?pg=listaclientesbanco';
window.onload = function(){
    document.getElementById('paginacao').onchange = function(){
        window.location = basePath + '&p=' + this.value;
    }
}

function trocaPagina (pagina){
	window.location = 'inicio.php?pg=listaclientesbanco' + '&p=' + pagina;
	}

function filtro (v,pagina){
	
	if (v == '1'){
	window.location = 'inicio.php?pg=listaclientesbanco&s=V' + '&p=' + pagina;
	return true;
	} else if (v =='2'){
		window.location = 'inicio.php?pg=listaclientesbanco&s=M' + '&p=' + pagina;
	return true;
		} else if (v =='3'){
			window.location = 'inicio.php?pg=listaclientesbanco&s=A' + '&p=' + pagina;
	return true;
			}
	}	

function confirmar_cliente(query){
if (confirm ("Tem certeza que deseja excluir este usuário?")){   
 window.location="php/deleta_cliente.php" + query;  
 return true;
 }
 else  
 window.location="inicio.php?pg=listaclientesbanco";
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
<div id="cabecalho"><h2><i class="icon-user iconmd"></i><span style="color:red;">*Clientes com cadastros incompletos para o Banco!</span></h2></div>
<div id="forms" style="display:table;padding-bottom:5px;margin-left:0;">
<?php

@$s = $_GET["s"];
// Verifica se a variável tá declarada, senão deixa na primeira página como padrão
if(isset($s)) {
$sql_1 = "SELECT * FROM cliente WHERE situacao ='$s' AND (matricula ='' OR dir_culto ='' OR cpfcnpj ='' OR endereco ='' OR numero ='' OR bairro ='' OR cep ='' OR cidade ='' OR uf ='' ) ORDER BY matricula DESC";	
} else {
$sql_1 = "SELECT * FROM cliente WHERE situacao !='V' AND (matricula ='' OR dir_culto ='' OR cpfcnpj ='' OR endereco ='' OR numero ='' OR bairro ='' OR cep ='' OR cidade ='' OR uf ='' ) ORDER BY matricula DESC";
}

///////////////////////// PAGINAÇÃO//////////////////////////////////////////
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
$sql_2 = $sql_1;// Executa o Query
$sql_query1 = mysql_query($sql_2);
//$total_registros = $sql_query1[0];
$total_registros = mysql_num_rows($sql_query1);
// Gera outra variável, desta vez com o número de páginas que será precisa. 
// O comando ceil() arredonda "para cima" o valor
$pags = ceil($total_registros/$qnt);
// Exibe o primeiro link "primeira página", que não entra na contagem acima(3)
if ($pags>1){
echo "<a class=\"pag\" href=\"inicio.php?pg=listaclientesbanco&p=1\" target=\"_self\">&laquo;&laquo; Primeira</a> ";
}
?>
&nbsp;
<select id="paginacao" style="width:50px;">
<option selected="selected"><?php echo $p; ?> </option>
<?php
// Cria um for() para exibir os 3 links antes da página atual
for($i = 1; $i <= $pags; $i++) {
	echo "<option value=\"$i\">$i</option>";
}
echo "</select>&nbsp;";
if ($pags>1){
// Exibe o link "última página"
echo "<a class=\"pag\" href=\"inicio.php?pg=listaclientesbanco&p=".$pags."\" target=\"_self\">Ultima &raquo;&raquo;</a> ";
}
?>
&nbsp;&nbsp;|&nbsp;&nbsp;Total de Registros INCOMPLETOS: <?php echo $total_registros; ?>
<div style="float:right;">
<input type="radio" name="filtro" value="1" onclick="filtro('1','<?php echo $p ?>')" id="filtro" />Vivos &nbsp;|&nbsp;
<input type="radio" name="filtro" value="2" onclick="filtro('2','<?php echo $p ?>')" id="filtro" />Mortos &nbsp;|&nbsp;
<input type="radio" name="filtro" value="3" onclick="filtro('3','<?php echo $p ?>')" id="filtro" />Aguardando 
</div>
<div id="fundo-tabela" style="margin-left:0px;margin-right:5px;">
<table width="100%" border="0" cellspacing="1" cellpadding="5" data-rowindex="1" data-rowtype="1">
<tbody>
  <tr>
    <td width="4%" bgcolor="#0490fc"><span class="fontebranca">Matrícula</span></td>
    <td width="20%" bgcolor="#0490fc"><span class="fontebranca">Diretor do Culto</span></td>
    <td width="10%" bgcolor="#0490fc"><span class="fontebranca">CPF/CNPJ</span></td>
    <td width="20%" bgcolor="#0490fc"><span class="fontebranca">Endereço</span></td>
    <td width="15%" bgcolor="#0490fc"><span class="fontebranca">Bairro</span></td>
    <td width="7%" align="center" bgcolor="#0490fc"><span class="fontebranca">Cidade</span></td>
    <td width="3%" align="center" bgcolor="#0490fc"><span class="fontebranca">UF</span></td>
    <td width="8%" align="center" bgcolor="#0490fc"><span class="fontebranca">Situação</span></td>
    <td width="9%" align="center" bgcolor="#0490fc"><span class="fontebranca">Ação</span></td>
    </tr>
</tbody>
<?php
// Seleciona no banco de dados com o LIMIT indicado pelos números acima
$sql_select = $sql_1." LIMIT $inicio, $qnt";
// Executa o Query
$sql_query = mysql_query($sql_select);
// Cria um while para pegar as informações do BD

if (mysql_num_rows($sql_query) >0){
	
	} else {
		echo "<tr><td align='center' colspan='9' style='min-width: 700px;'>Não foram encontrados registros incompletos para este filtro!</td></tr>";
		}
while($array = mysql_fetch_array($sql_query)) {
// Variável para capturar o campo "nome" no banco de dados
$idgrupo = $array['id_grupo'];
		
?>
<tr style='color:red;'>
    <td align="center"><?php echo $array['matricula'] ?></td>
    <td align="left"><?php echo $array['dir_culto']; ?></td>
    <td align="left"><?php echo $array['cpfcnpj']; ?></td>
    <td align="left"><?php echo $array['end_dir']; ?></td>
    <td align="left"><?php echo $array['bairro_dir']; ?></td>
    <td align="left"><?php echo $array['cidade']; ?></td>
    <td align="left"><?php echo $array['uf']; ?></td>
    <?php if ($array['situacao'] == 'V'){
		 $situacao = "Vivo";
		} else if ($array['situacao'] == 'M'){
		 $situacao = "Morto";
		} else if ($array['situacao'] == 'A'){
		 $situacao = "Aguardando";
		} 		
		?>
    <td align="left"><?php echo $situacao; ?></td>

    <td align="right">
         <div class="btn-group">
            <a href="pg/editacliente.php?id=<?php echo $array['id_cliente'] ?>&p=<?php echo $p ?>&i=1" style="text-decoration:none;" 
            class="btn btn-default" onclick="NovaJanela(this.href,'nomeJanela','1100','800','yes');return false" title="Editar">
            <i class="icon-edit"></i></a>
            <a class="btn btn-default"
            href="javascript:confirmar_cliente('?pg=listaclientes&deleta=cliente&id=<?php echo $array['id_cliente'] ?>&p=<?php echo $p ?>')"
             style="text-decoration:none;" title="Excluir cadastro"> 
           <i class="icon-trash"></i></a>
           
           <a href="pg/gerar_mensalidade.php?id=<?php echo $array['id_cliente'] ?>&p=<?php echo $p ?>" style="text-decoration:none;" 
            class="btn btn-default" onclick="NovaJanela(this.href,'nomeJanela','800','600','yes');return false" title="Gerar Mensalidades">
            <i class="icon-check"></i></a>
          </div>
    </td>
 </tr>
	
    <?php } ?><tr>
    	<td colspan="6" bgcolor="#0490fc">
         <div id="total-faturas">UUCAB - Total de Registros INCOMPLETOS: <?php echo $total_registros; ?></div>
        </td>
    </tr>
</table>
</form>
</div>
<br />
<?php
// Gera outra variável, desta vez com o número de páginas que será precisa. 
// O comando ceil() arredonda "para cima" o valor
$pags = ceil($total_registros/$qnt);
// Exibe o primeiro link "primeira página", que não entra na contagem acima(3)
if ($pags>1){
echo "<a class=\"pag\" href=\"inicio.php?pg=listaclientesbanco&p=1\" target=\"_self\">&laquo;&laquo; Primeira</a> ";
}
?>
&nbsp;
<select id="paginacao" style="width:50px;" onchange="trocaPagina (this.value)">
<option selected="selected"><?php echo $p; ?> </option>
<?php
// Cria um for() para exibir os 3 links antes da página atual
for($i = 1; $i <= $pags; $i++) {
	echo "<option value=\"$i\">$i</option>";
}
echo "</select>&nbsp;";
if ($pags>1){
// Exibe o link "última página"
echo "<a class=\"pag\" href=\"inicio.php?pg=listaclientesbanco&p=".$pags."\" target=\"_self\">Ultima &raquo;&raquo;</a> ";
}
?>