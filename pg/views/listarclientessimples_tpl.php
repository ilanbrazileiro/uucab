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

var basePath = 'inicio.php?pg=listaclientessimples';
window.onload = function(){
    document.getElementById('paginacao').onchange = function(){
        window.location = basePath + '&p=' + this.value;
    }
}


function trocaPagina (pagina){
	window.location = 'inicio.php?pg=listaclientessimples' + '&p=' + pagina;
	}

function confirmar_cliente(query){
if (confirm ("Tem certeza que deseja excluir este usuário?")){   
 window.location="php/deleta_cliente.php" + query;  
 return true;
 }
 else  
 window.location="inicio.php?pg=listaclientessimples";
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



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-users"></i> Lista de Clientes
      <small>Lista de Clientes Simples</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="inicio.php?pg=inicio"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="inicio.php?pg=listaclientessimples"><i class="fa fa-users"></i> Clientes</a></li>
      <li class="active">Listagem Simples</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">







  	<div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Table With Full Features</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
              	<thead>
                <tr>
                  	<th>Matrícula</th>
    			    <th>Diretor (a) Espíritual</span></th>
				    <th>Presidente</th>
				    <th>Centro / Terreiro</th>
				    <th>Município do Centro</th>
				    <th>Situação</th>
				    <th>Grupo</th>
				    <th>Valor</th>
				    <th>Última Mensalidade Paga</th>
				    <th>Editar</th>
                </tr>
            </thead>

            <tbody>
                <tr>

                	<?php 
                	$sql_query = mysql_query("SELECT * FROM cliente ORDER BY matricula DESC");

// Cria um while para pegar as informações do BD
while($array = mysql_fetch_array($sql_query)) {
// Variável para capturar o campo "nome" no banco de dados
$idgrupo = $array['id_grupo'];
	
	if ($array['situacao'] == "I"){/////////Verifica se cliente ISENTO, senão verifica ultima mensalidade
		$ultima_mensalidade = 'ISENTO';
		$verifica_atraso = '2';
	} else {
		$ultima_mensalidade = ultimaMensalidade($array['id_cliente']);
		$verifica_atraso = verificaAtraso($ultima_mensalidade);	
	}
	
if (empty($array['dir_culto']) || empty($array['cpfcnpj']) || empty($array['naturalidade']) || empty($array['rg_pres']) || empty($array['estadocivil']) || empty($array['estadocivil_pres']) || empty($array['profissao']) || empty($array['endereco']) || empty($array['end_dir']) || empty($array['bairro_dir']) || empty($array['bairro']) || empty($array['profissao_pres']) || empty($array['senha']) ||  empty($array['cep_dir']) || empty($array['rg']) || empty($array['corretor']) || empty($array['nome']) || empty($array['inscricao']) || empty($array['cidade']) || empty($array['natural_pres']) || empty($array['uf']) || empty($array['nascimento']) || empty($array['uf_dir'])){
		echo "<tr style='color:red;'>";
    }
    {
	    if (empty($array['dir_culto']) || empty($array['cpfcnpj'])){ 
		    echo "<tr style='font-weight: bold; color:red;'>";
	    }	
}
		
        

?>
    <td align="center"><?php echo $array['matricula'] ?></td>
    <td align="left"><?php echo $array['dir_culto']; ?> <?php
    if ($array['subnick'] != ''){
                      echo "(". $array['subnick']. ")";
                    } ?></td>
    <td align="left"><?php echo $array['nome']; ?></td>
    <td align="left"><?php echo $array['centro']; ?><br><?php
    if ($array['cnpj'] != ''){
                      echo "CNPJ: ". $array['cnpj'];
                    } ?></td>
    <td align="left"><?php echo $array['cidade_dir']; ?>-<?php echo $array['uf_dir']; ?></td>
    <td align="center"><?php echo getSituacao($array['situacao']); ?></td>
    
    <?php 
		$dad = mysql_query("SELECT * FROM grupo WHERE id_grupo = '$idgrupo'");
		$dado = mysql_fetch_array($dad);
		if($dado['nomegrupo'] == ""){ $grupo = "AVULSO";
		} else { $grupo = $dado['nomegrupo']; }
	?>
    <td align="center"><?php echo $grupo; ?></td>
    <td align="center"><?php echo number_format($array['valor'],'2',',','.'); ?></td>
    <td align="center" <?php if ($verifica_atraso == '1'){ echo "style='color:red;font-weight:bold;'";} ?> ><?php echo $ultima_mensalidade ?></td>
    
    <td align="right">
                <div class="btn-group">
            <a href="pg/editacliente.php?id=<?php echo $array['id_cliente'] ?>&p=<?php echo $p ?>" style="text-decoration:none;" 
            class="btn btn-default" onclick="NovaJanela(this.href,'nomeJanela','1050','550','yes');return false" title="Editar">
            <i class="icon-edit"></i></a>
            
            <?php 
            /* DELETAR CLIENTE */
            /* <a class="btn btn-default"
            href="javascript:confirmar_cliente('?pg=listaclientes&deleta=cliente&id=<?php echo $array['id_cliente'] ?>&p=<?php echo $p ?>')"
             style="text-decoration:none;" title="Excluir cadastro"> 
           <i class="icon-trash"></i></a>
  */ ?>
            </div>
    </td>
    </tr>
<?php } ?> 


            
            </tbody>
                <tfoot>
                <tr>
                  <th>Matrícula</th>
    			    <th>Diretor (a) Espíritual</span></th>
				    <th>Presidente</th>
				    <th>Centro / Terreiro</th>
				    <th>Município do Centro</th>
				    <th>Situação</th>
				    <th>Grupo</th>
				    <th>Valor</th>
				    <th>Última Mensalidade Paga</th>
				    <th>Editar</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->




  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->








  <div id="conteudoform">	
<div id="entrada">
<div id="cabecalho"><h2><i class="icon-user iconmd"></i> Listagem dos Clientes </h2></div>
<div id="forms" style="display:table;padding-bottom:5px;">
  
  <div style="float:left; width:250px">
    <form action="inicio.php?pg=listaclientessimples" method="post" enctype="multipart/form-data"  style="display:inline;" style="width:220px;">
    <span class="avisos">&nbsp;*Pesquise pela MATRÍCULA</span><br/>
    <input name="pesquisa_mat" type="text" style="width:190px;">
    <button type="submit" class="btn ewButton" name="pesq1" id="btnsubmit" style="margin-top:-10px;"/>
    <i class="icon-search  icon-white"></i></button>
    </form>
  </div>
  
  <div style="float:left;width:250px">
    <form action="inicio.php?pg=listaclientessimples" method="post" enctype="multipart/form-data" style="display:inline;" style="width:220px;">
    <span class="avisos">&nbsp;*Pesquise pelo DIRETOR (A) ESPIRITUAL</span><br/>
    <input name="pesquisa_diretor" type="text" style="width:190px;">
    <button type="submit" class="btn ewButton" name="pesq" id="btnsubmit" style="margin-top:-10px;"/>
    <i class="icon-search  icon-white"></i></button>
    </form>
  </div>
  
  <div style="float:left;width:250px">
    <form action="inicio.php?pg=listaclientessimples" method="post" enctype="multipart/form-data"  style="display:inline;" style="width:220px;">
    <span class="avisos">&nbsp;*Pesquise pelo CPF  </span><br/>
    <input name="cpf" type="text" style="width:190px;" id="cpf">
    <button type="submit" class="btn ewButton" name="pesq1" id="btnsubmit" style="margin-top:-10px;"/>
    <i class="icon-search  icon-white"></i></button>
    </form>
    </div>
       

     
     
     
     
  
    
   
    
</div>
<div id="forms">
<?php
//////////////////////////////Definição das buscas
if(isset($_POST['pesquizar']) && $_POST['pesquizar'] != ""){
$pesquisar = $_POST['pesquizar'];
$filtro = "pesquizar:'".$_POST['pesquizar']."'";
$sql_1 = "SELECT * FROM cliente WHERE nome LIKE '%$pesquisar%' ORDER BY nome ASC";

} else if(isset($_POST['pesquisa_mat']) && $_POST['pesquisa_mat'] != ""){
	$pesquisar = $_POST['pesquisa_mat'];
	$filtro = "pesquisa_mat:'".$_POST['pesquisa_mat']."'";
	$sql_1 = "SELECT * FROM cliente WHERE matricula LIKE '%$pesquisar%' ORDER BY matricula ASC";

} else if(isset($_POST['pesquisa_diretor']) && $_POST['pesquisa_diretor'] != ""){
	$pesquisar = $_POST['pesquisa_diretor'];
	$filtro = "pesquisa_diretor:'".$_POST['pesquisa_diretor']."'";
	$sql_1 = "SELECT * FROM cliente WHERE dir_culto LIKE '%$pesquisar%' ORDER BY dir_culto ASC ";
	
	//Pesquisa pelo endereço do culto
} else if(isset($_POST['end']) && $_POST['end'] != ""){
	$pesquisar = $_POST['end'];
	$filtro = "end:'".$_POST['end']."'";
	$sql_1 = "SELECT * FROM cliente WHERE endereco LIKE '%$pesquisar%' OR end_dir LIKE '%$pesquisar%' ORDER BY dir_culto ASC";

} else if(isset($_POST['cpf']) && $_POST['cpf'] != ""){
	$pesquisar = $_POST['cpf'];
	$filtro = "cpf:'".$_POST['cpf']."'";
	$sql_1 = "SELECT * FROM cliente WHERE cpfcnpj LIKE '%$pesquisar%' OR cpf_pres LIKE '%$pesquisar%' ORDER BY dir_culto ASC";

} else if(isset($_POST['bairro']) && $_POST['bairro'] != ""){
	$pesquisar = $_POST['bairro'];
	$filtro = "bairro:'".$_POST['bairro']."'";
	$sql_1 = "SELECT * FROM cliente WHERE bairro LIKE '%$pesquisar%' OR bairro_dir LIKE '%$pesquisar%' ORDER BY dir_culto ASC";
	
} else if(isset($_POST['subnick']) && $_POST['subnick'] != ""){
	$pesquisar = $_POST['subnick'];
	$filtro = "subnick:'".$_POST['subnick']."'";
	$sql_1 = "SELECT * FROM cliente WHERE subnick LIKE '%$pesquisar%' ORDER BY dir_culto ASC";

} else if(isset($_POST['nome_centro']) && $_POST['nome_centro'] != ""){
	$pesquisar = $_POST['nome_centro'];
	$filtro = "nome_centro:'".$_POST['nome_centro']."'";
	$sql_1 = "SELECT * FROM cliente WHERE centro LIKE '%$pesquisar%' ORDER BY dir_culto ASC";
	
} else if(isset($_POST['senha']) && $_POST['senha'] != ""){
	$pesquisar = $_POST['senha'];
	$filtro = "senha:'".$_POST['senha']."'";
	$sql_1 = "SELECT * FROM cliente WHERE senha LIKE '%$pesquisar%' ORDER BY dir_culto ASC";
	
} else if(isset($_POST['cnpj']) && $_POST['cnpj'] != ""){
	$pesquisar = $_POST['cnpj'];
	$filtro = "cnpj:'".$_POST['cnpj']."'";
	$sql_1 = "SELECT * FROM cliente WHERE cnpj LIKE '%$pesquisar%' ORDER BY dir_culto ASC";

} else if(isset($_POST['cidade']) && $_POST['cidade'] != ""){
	$pesquisar = $_POST['cidade'];
	$filtro = "cidade:'".$_POST['cidade']."'";
	$sql_1 = "SELECT * FROM cliente WHERE cidade LIKE '%$pesquisar%' OR cidade_dir LIKE '%$pesquisar%' ORDER BY dir_culto ASC";

} else if(isset($_POST['filiacao']) && $_POST['filiacao'] != ""){
	$pesquisar = $_POST['filiacao'];
	$filtro = "filiacao:'".$_POST['filiacao']."'";
	$sql_1 = "SELECT * FROM cliente WHERE filiacaopai_pres LIKE '%$pesquisar%' OR filiacaomae_pres LIKE '%$pesquisar%' OR filiacao_pai LIKE '%$pesquisar%' OR filiacao_mae LIKE '%$pesquisar%' ORDER BY dir_culto ASC";

} else if(isset($_POST['cep']) && $_POST['cep'] != ""){
	$pesquisar = $_POST['cep'];
	$filtro = "cep:'".$_POST['cep']."'";
	$sql_1 = "SELECT * FROM cliente WHERE cep LIKE '%$pesquisar%' OR cep_dir LIKE '%$pesquisar%' ORDER BY dir_culto ASC";
	
} else if(isset($_POST['corretor']) && $_POST['corretor'] != ""){
	$pesquisar = $_POST['corretor'];
	$filtro = "corretor:'".$_POST['corretor']."'";
	$sql_1 = "SELECT * FROM cliente WHERE corretor LIKE '%$pesquisar%' ORDER BY dir_culto ASC";

} else if(isset($_POST['email']) && $_POST['email'] != ""){
	$pesquisar = $_POST['email'];
	$filtro = "email:'".$_POST['email']."'";
	$sql_1 = "SELECT * FROM cliente WHERE email LIKE '%$pesquisar%' OR email2 LIKE '%$pesquisar%' ORDER BY dir_culto ASC";
	
} else if(isset($_POST['mens']) && $_POST['mens'] != ""){
	$pesquisar = $_POST['mens'];
	$filtro = "mens:'".$_POST['mens']."'";
	$sql_1 = "SELECT * FROM cliente WHERE valor LIKE '%$pesquisar%' ORDER BY matricula ASC";
	
} else if(isset($_POST['situacao']) && $_POST['situacao'] != ""){
	$pesquisar = $_POST['situacao'];
	$filtro = "situacao:'".$_POST['situacao']."'";
	$sql_1 = "SELECT * FROM cliente WHERE situacao LIKE '%$pesquisar%' ORDER BY matricula DESC";
	
} else if(isset($_POST['anual']) && $_POST['anual'] != ""){
	$pesquisar = $_POST['anual'];
	$filtro = "anual:'".$_POST['anual']."'";
	$sql_1 = "SELECT * FROM cliente WHERE valor_anual LIKE '%$pesquisar%' ORDER BY matricula ASC";
	
} else if(isset($_POST['uf']) && $_POST['uf'] != ""){
	$pesquisar = $_POST['uf'];
	$filtro = "uf:'".$_POST['uf']."'";
	$sql_1 = "SELECT * FROM cliente WHERE uf LIKE '%$pesquisar%' OR uf_dir LIKE '%$pesquisar%' ORDER BY dir_culto ASC";
	
} else if(isset($_POST['tel']) && $_POST['tel'] != ""){
	$pesquisar = $_POST['tel'];
	$filtro = "tel:'".$_POST['tel']."'";
	$sql_1 = "SELECT * FROM cliente WHERE telefone LIKE '%$pesquisar%' ORDER BY dir_culto ASC";
	
} else if(isset($_POST['cel']) && $_POST['cel'] != ""){
	$pesquisar = $_POST['cel'];
	$filtro = "cel:'".$_POST['cel']."'";
	$sql_1 = "SELECT * FROM cliente WHERE celular LIKE '%$pesquisar%' OR celular2 LIKE '%$pesquisar%' ORDER BY dir_culto ASC";


} else if(isset($_POST['situacao1']) && $_POST['situacao1'] != ""){
	$situacao1 = $_POST['situacao1'];
	$corretor1 = $_POST['corretor1'];
	$filtro = "corretor1:'".$_POST['corretor1']."', situacao1:'".$_POST['situacao1']."'";
	$sql_1 = "SELECT * FROM cliente WHERE situacao = '$situacao1' AND corretor LIKE '%$corretor1%' ORDER BY matricula DESC";


} else if(isset($_POST['dir_culto1']) && $_POST['dir_culto1'] != ""){
	$dir_culto1 = $_POST['dir_culto1'];
	$corretor2 = $_POST['corretor2'];
	$filtro = "corretor2:'".$_POST['corretor2']."', dir_culto1:'".$_POST['dir_culto1']."'";
	$sql_1 = "SELECT * FROM cliente WHERE dir_culto LIKE '%$dir_culto1%' AND corretor LIKE '%$corretor2%' ORDER BY matricula DESC";
	
} else if(isset($_POST['cidade1']) && $_POST['cidade1'] != ""){
	$cidade1 = $_POST['cidade1'];
	$corretor3 = $_POST['corretor3'];
	$filtro = "corretor3:'".$_POST['corretor3']."', cidade1:'".$_POST['cidade1']."'";
	$sql_1 = "SELECT * FROM cliente WHERE cidade LIKE '%$cidade1%' AND corretor LIKE '%$corretor3%' ORDER BY matricula DESC";
	
/*
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
*/

} else {
	$sql_1 = "SELECT * FROM cliente ORDER BY matricula DESC";
}



// Pegar a página atual por GET
@$p = $_POST["p"];
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
echo "<a class=\"pag\" href=\"#\" onclick=\"sendPost('inicio.php?pg=listaclientessimples".$part."',{".$filtro."}, '1')\" target=\"_self\">&laquo;&laquo; Primeira</a> ";
}
?>
&nbsp;

<select name="pg" onchange="sendPost('inicio.php?pg=listaclientessimples<?php echo $part;?>',{<?php echo $filtro; ?>}, this.value );" style="width: 50px;">          
<option selected="selected"><?php echo $p; ?> </option>
<?php
// Cria um for() para exibir os 3 links antes da página atual
for($i = 1; $i <= $pags; $i++) {
	echo "<option value=\"$i\">$i</option>";
}
echo "</select>&nbsp;";
if ($pags>1){
// Exibe o link "última página"
echo "<a class=\"pag\" href=\"#\" onclick=\"sendPost('inicio.php?pg=listaclientessimples".$part."',{".$filtro."}, '".$pags."')\" target=\"_self\">Ultima &raquo;&raquo;</a> ";
}
?>

&nbsp;&nbsp;<a class="pag" href='inicio.php?pg=listaclientessimples'>«« Listar Todos »» </a>&nbsp;&nbsp;|&nbsp;&nbsp;Total de Clientes / Pesquisa: <?php echo $total_registros; ?>
<div class="coluna" style="text-align:right; width:250px;"><i>Total de clientes CADASTRADOS:</i> <?php echo $tc; ?></div>
<div id="fundo-tabela">

<table width="100%" border="0" cellspacing="1" cellpadding="5" data-rowindex="1" data-rowtype="1">
<tbody>
  <tr>
    <td width="4%" bgcolor="#0490fc"><span class="fontebranca">Matrícula</span></td>
    
    <td width="21%" bgcolor="#0490fc"><span class="fontebranca">Diretor (a) Espíritual</span></td>
    <td width="21%" bgcolor="#0490fc"><span class="fontebranca">Presidente </span></td>
    <td width="21%" bgcolor="#0490fc"><span class="fontebranca">Centro / Terreiro</span></td>
    <td width="16%" bgcolor="#0490fc"><span class="fontebranca">Município do Centro</span></td>
    <td width="4%" align="center" bgcolor="#0490fc"><span class="fontebranca">Situação</span></td>
    <td width="4%" align="center" bgcolor="#0490fc"><span class="fontebranca">Grupo</span></td>
    <td width="3%" bgcolor="#0490fc"><span class="fontebranca">Valor</span></td>
    <td width="9%" align="center" bgcolor="#0490fc"><span class="fontebranca">Última Mensalidade Paga</span></td>
    <td width="5%" align="center" bgcolor="#0490fc"><span class="fontebranca">Editar</span></td>
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
		$ultima_mensalidade = 'ISENTO';
		$verifica_atraso = '2';
	} else {
		$ultima_mensalidade = ultimaMensalidade($array['id_cliente']);
		$verifica_atraso = verificaAtraso($ultima_mensalidade);	
	}
	
if (empty($array['dir_culto']) || empty($array['cpfcnpj']) || empty($array['naturalidade']) || empty($array['rg_pres']) || empty($array['estadocivil']) || empty($array['estadocivil_pres']) || empty($array['profissao']) || empty($array['endereco']) || empty($array['end_dir']) || empty($array['bairro_dir']) || empty($array['bairro']) || empty($array['profissao_pres']) || empty($array['senha']) ||  empty($array['cep_dir']) || empty($array['rg']) || empty($array['corretor']) || empty($array['nome']) || empty($array['inscricao']) || empty($array['cidade']) || empty($array['natural_pres']) || empty($array['uf']) || empty($array['nascimento']) || empty($array['uf_dir'])){
		echo "<tr style='color:red;'>";
    }
    {
	    if (empty($array['dir_culto']) || empty($array['cpfcnpj'])){ 
		    echo "<tr style='font-weight: bold; color:red;'>";
	    }	
}
		
        

?>
    <td align="center"><?php echo $array['matricula'] ?></td>
    <td align="left"><?php echo $array['dir_culto']; ?> <?php
    if ($array['subnick'] != ''){
                      echo "(". $array['subnick']. ")";
                    } ?></td>
    <td align="left"><?php echo $array['nome']; ?></td>
    <td align="left"><?php echo $array['centro']; ?><br><?php
    if ($array['cnpj'] != ''){
                      echo "CNPJ: ". $array['cnpj'];
                    } ?></td>
    <td align="left"><?php echo $array['cidade_dir']; ?>-<?php echo $array['uf_dir']; ?></td>
    <td align="center"><?php echo getSituacao($array['situacao']); ?></td>
    
    <?php 
		$dad = mysql_query("SELECT * FROM grupo WHERE id_grupo = '$idgrupo'");
		$dado = mysql_fetch_array($dad);
		if($dado['nomegrupo'] == ""){ $grupo = "AVULSO";
		} else { $grupo = $dado['nomegrupo']; }
	?>
    <td align="center"><?php echo $grupo; ?></td>
    <td align="center"><?php echo number_format($array['valor'],'2',',','.'); ?></td>
    <td align="center" <?php if ($verifica_atraso == '1'){ echo "style='color:red;font-weight:bold;'";} ?> ><?php echo $ultima_mensalidade ?></td>
    
    <td align="right">
                <div class="btn-group">
            <a href="pg/editacliente.php?id=<?php echo $array['id_cliente'] ?>&p=<?php echo $p ?>" style="text-decoration:none;" 
            class="btn btn-default" onclick="NovaJanela(this.href,'nomeJanela','1050','550','yes');return false" title="Editar">
            <i class="icon-edit"></i></a>
            
            <?php 
            /* DELETAR CLIENTE */
            /* <a class="btn btn-default"
            href="javascript:confirmar_cliente('?pg=listaclientes&deleta=cliente&id=<?php echo $array['id_cliente'] ?>&p=<?php echo $p ?>')"
             style="text-decoration:none;" title="Excluir cadastro"> 
           <i class="icon-trash"></i></a>
  */ ?>
            </div>
    </td>
    </tr>
<?php } ?> 
	<tr>
    	<td colspan="6" bgcolor="#0490fc">
         <div id="total-faturas">UUCAB - UNIÃO ESPÍRITA</div>
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
echo "<a class=\"pag\" href=\"#\" onclick=\"sendPost('inicio.php?pg=listaclientessimples".$part."',{".$filtro."}, '1')\" target=\"_self\">&laquo;&laquo; Primeira</a> ";
}
?>
&nbsp;

<select name="pg" onchange="sendPost('inicio.php?pg=listaclientessimples<?php echo $part;?>',{<?php echo $filtro; ?>}, this.value );" style="width: 50px;">          
<option selected="selected"><?php echo $p; ?> </option>
<?php
// Cria um for() para exibir os 3 links antes da página atual
for($i = 1; $i <= $pags; $i++) {
	echo "<option value=\"$i\">$i</option>";
}
echo "</select>&nbsp;";
if ($pags>1){
// Exibe o link "última página"
echo "<a class=\"pag\" href=\"#\" onclick=\"sendPost('inicio.php?pg=listaclientessimples".$part."',{".$filtro."}, '".$pags."')\" target=\"_self\">Ultima &raquo;&raquo;</a> ";
}
?>

<?php include ("footer.php"); ?>

<!-- DataTables -->
<script src="res/admin/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="res/admin/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="res/admin/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="res/admin/plugins/fastclick/fastclick.js"></script>
<!-- page script -->
<script>
  $(function () {
    $('#example2').DataTable(
        {
            "language":
             {
                "sEmptyTable": "Nenhum registro encontrado",
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                "sLengthMenu": "_MENU_ resultados por página",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...",
                "sZeroRecords": "Nenhum registro encontrado",
                "sSearch": "Pesquisar",
                "oPaginate": 
                  {
                    "sNext": "Próximo",
                    "sPrevious": "Anterior",
                    "sFirst": "Primeiro",
                    "sLast": "Último"
                  },
                "oAria": 
                  {
                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                  }
              }
        });
  });
</script>

</body>
</html>