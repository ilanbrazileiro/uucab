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
	$campo = 'matricula';
	}
$part .= '&campo='.$campo;

$total_cadatros = mysql_query("SELECT COUNT(*) FROM cliente");
while($array = mysql_fetch_array($total_cadatros)) {
// Variável para capturar o campo "nome" no banco de dados
$tc = $array[0];
}

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
           	$("#cnpj").mask("99.999.999/9999-99");
           	$("#cep").mask("99999-999");
			$("#cep_dir").mask("99999-999");
			$("#tel").mask("(99) 9999-9999");
			$("#cel").mask("(99) 99999-9999");
 
        });

</script>
<div id="entrada">
<div id="cabecalho"><h2><i class="icon-user iconmd"></i> Listagem dos Clientes Completa </h2></div>
<div id="forms" style="display:table;padding-bottom:5px;">
  
  <div style="float:left; width:250px">
    <form action="inicio.php?pg=listaclientes" method="post" enctype="multipart/form-data"  style="display:inline;" style="width:220px;">
    <span class="avisos">&nbsp;*Pesquise pela MATRÍCULA</span><br/>
    <input name="pesquisa_mat" type="text" style="width:190px;">
    <button type="submit" class="btn ewButton" name="pesq1" id="btnsubmit" style="margin-top:-10px;"/>
    <i class="icon-search  icon-white"></i></button>
    </form>
  </div>
  
  <div style="float:left;width:250px">
    <form action="inicio.php?pg=listaclientes" method="post" enctype="multipart/form-data" style="display:inline;" style="width:220px;">
    <span class="avisos">&nbsp;*Pesquise pelo DIRETOR (A) ESPIRITUAL</span><br/>
    <input name="pesquisa_diretor" type="text" style="width:190px;">
    <button type="submit" class="btn ewButton" name="pesq" id="btnsubmit" style="margin-top:-10px;"/>
    <i class="icon-search  icon-white"></i></button>
    </form>
  </div>
  
  <div style="float:left;width:250px">
    <form action="inicio.php?pg=listaclientes" method="post" enctype="multipart/form-data"  style="display:inline;" style="width:220px;">
    <span class="avisos">&nbsp;*Pesquise pelo CPF  </span><br/>
    <input name="cpf" type="text" style="width:190px;" id="cpf">
    <button type="submit" class="btn ewButton" name="pesq1" id="btnsubmit" style="margin-top:-10px;"/>
    <i class="icon-search  icon-white"></i></button>
    </form>
    </div>
       
 <? /* 
    <div style="float:left; width:600px">
     <form action="inicio.php?pg=listaclientes" method="post" enctype="multipart/form-data">
	    <span class="avisos">&nbsp;*Escolha o tipo de pesquisa e digite o valor a ser pesquisado ao lado</span><br/>
    	
        <select name="select_pesquisa" id="select_pesquisa">
        	<option value="presidente">Pelo Presidente</option>            
        	<option value="centro">Pelo nome do Centro/Terreiro</option>
        	<option value="endenreco">Pelo Endereço/Logradouro</option>
        	<option value="bairro">Pelo Bairro</option>
            <option value="cidade">Pela Cidade</option>
        	<option value="cep">Pelo CEP</option>            
        	<option value="apelido">Pelo Digina/Como conhecido</option>
        	<option value="filiacao">Pela Filiacao</option>
        	<option value="corretor">Pelo Corretor</option>
        	<option value="telefone">Pelo Telefone</option>
        	<option value="celular">Pelo Celular</option>
            <option value="email">Pelo E-mail</option>
        </select>
        &nbsp;&nbsp;&nbsp;
        
        <input name="pesquizar" type="text" style="width:190px;">
    	<button type="submit" class="btn ewButton" name="pesq1" id="btnsubmit" style="margin-top:-10px;"/>
    	<i class="icon-search  icon-white"></i></button>
    </form>
  </div>
*/ ?>
  <div style="float:left;width:250px">
    <form action="inicio.php?pg=listaclientes" method="post" enctype="multipart/form-data"  style="display:inline;" style="width:220px;">
    <span class="avisos">&nbsp;*Pesquise pelo PRESIDENTE</span><br/>
    <input name="pesquizar" type="text" style="width:190px;">
    <button type="submit" class="btn ewButton" name="pesq1" id="btnsubmit" style="margin-top:-10px;"/>
    <i class="icon-search  icon-white"></i></button>
    </form>
    </div>
   
   <div style="float:left;width:250px">
    <form action="inicio.php?pg=listaclientes" method="post" enctype="multipart/form-data"  style="display:inline;" style="width:220px;">
    <span class="avisos">&nbsp;*Pesquise pelo NOME DO CENTRO</span><br/>
    <input name="nome_centro" type="text" style="width:190px;">
    <button type="submit" class="btn ewButton" name="pesq1" id="btnsubmit" style="margin-top:-10px;"/>
    <i class="icon-search  icon-white"></i></button>
    </form>
    </div>
    
    
     <div style="float:left;width:250px">
    <form action="inicio.php?pg=listaclientes" method="post" enctype="multipart/form-data"  style="display:inline;" style="width:220px;">
    <span class="avisos">&nbsp;*Pesquise pelo CNPJ </span><br/>
    <input name="cnpj" type="text" style="width:190px;" id="cnpj">
    <button type="submit" class="btn ewButton" name="pesq1" id="btnsubmit" style="margin-top:-10px;"/>
    <i class="icon-search  icon-white"></i></button>
    </form>
    </div>
    
    <div style="float:left;width:250px">
    <form action="inicio.php?pg=listaclientes" method="post" enctype="multipart/form-data"  style="display:inline;" style="width:220px;">
    <span class="avisos">&nbsp;*Pesquise pela LINHA DE TRABALHO</span><br/>
    <input name="linha" type="text" style="width:190px;">
    <button type="submit" class="btn ewButton" name="pesq1" id="btnsubmit" style="margin-top:-10px;"/>
    <i class="icon-search  icon-white"></i></button>
    </form>
    </div>
    
    <div style="float:left;width:250px">
    <form action="inicio.php?pg=listaclientes" method="post" enctype="multipart/form-data"  style="display:inline;" style="width:220px;">
    <span class="avisos">&nbsp;*Pesquise pela DIGINA</span><br/>
    <input name="subnick" type="text" style="width:190px;">
    <button type="submit" class="btn ewButton" name="pesq1" id="btnsubmit" style="margin-top:-10px;"/>
    <i class="icon-search  icon-white"></i></button>
    </form>
    </div>
    
    <div style="float:left;width:250px">
    <form action="inicio.php?pg=listaclientes" method="post" enctype="multipart/form-data"  style="display:inline;" style="width:220px;">
    <span class="avisos">&nbsp;*Pesquise pela IDENTIDADE</span><br/>
    <input name="identidade" type="text" style="width:190px;">
    <button type="submit" class="btn ewButton" name="pesq1" id="btnsubmit" style="margin-top:-10px;"/>
    <i class="icon-search  icon-white"></i></button>
    </form>
    </div>
    
    <div style="float:left;width:250px">
    <form action="inicio.php?pg=listaclientes" method="post" enctype="multipart/form-data"  style="display:inline;" style="width:220px;">
    <span class="avisos">&nbsp;*Pesquise pela PROFISSAO</span><br/>
    <input name="profissao" type="text" style="width:190px;">
    <button type="submit" class="btn ewButton" name="pesq1" id="btnsubmit" style="margin-top:-10px;"/>
    <i class="icon-search  icon-white"></i></button>
    </form>
    </div>
    
    <div style="float:left;width:250px">
    <form action="inicio.php?pg=listaclientes" method="post" enctype="multipart/form-data"  style="display:inline;" style="width:220px;">
    <span class="avisos">&nbsp;*Pesquise pela NATURALIDADE</span><br/>
    <input name="natural" type="text" style="width:190px;">
    <button type="submit" class="btn ewButton" name="pesq1" id="btnsubmit" style="margin-top:-10px;"/>
    <i class="icon-search  icon-white"></i></button>
    </form>
    </div>
    
    <div style="float:left;width:250px">
    <form action="inicio.php?pg=listaclientes" method="post" enctype="multipart/form-data"  style="display:inline;" style="width:220px;">
    <span class="avisos">&nbsp;*Pesquise pela FILIAÇÃO</span><br/>
    <input name="filiacao" type="text" style="width:190px;">
    <button type="submit" class="btn ewButton" name="pesq1" id="btnsubmit" style="margin-top:-10px;"/>
    <i class="icon-search  icon-white"></i></button>
    </form>
    </div>
    
    <div style="float:left;width:250px">
    <form action="inicio.php?pg=listaclientes" method="post" enctype="multipart/form-data"  style="display:inline;" style="width:220px;">
    <span class="avisos">&nbsp;*Pesquise pelo CEP </span><br/>
    <input name="cep" type="text" style="width:190px;" id="cep">
    <button type="submit" class="btn ewButton" name="pesq1" id="btnsubmit" style="margin-top:-10px;"/>
    <i class="icon-search  icon-white"></i></button>
    </form>
    </div>
    
    <div style="float:left;width:250px">
    <form action="inicio.php?pg=listaclientes" method="post" enctype="multipart/form-data"  style="display:inline;" style="width:220px;">
    <span class="avisos">&nbsp;*Pesquise pelo ENDEREÇO</span><br/>
    <input name="end" type="text" style="width:190px;">
    <button type="submit" class="btn ewButton" name="pesq1" id="btnsubmit" style="margin-top:-10px;"/>
    <i class="icon-search  icon-white"></i></button>
    </form>
    </div>
    
    <div style="float:left;width:250px">
    <form action="inicio.php?pg=listaclientes" method="post" enctype="multipart/form-data"  style="display:inline;" style="width:220px;">
    <span class="avisos">&nbsp;*Pesquise pelo BAIRRO</span><br/>
    <input name="bairro" type="text" style="width:190px;">
    <button type="submit" class="btn ewButton" name="pesq1" id="btnsubmit" style="margin-top:-10px;"/>
    <i class="icon-search  icon-white"></i></button>
    </form>
    </div>
    
     <div style="float:left;width:250px">
    <form action="inicio.php?pg=listaclientes" method="post" enctype="multipart/form-data"  style="display:inline;" style="width:220px;">
    <span class="avisos">&nbsp;*Pesquise pela CIDADE / MUNICÍPIO</span><br/>
    <input name="cidade" type="text" style="width:190px;">
    <button type="submit" class="btn ewButton" name="pesq1" id="btnsubmit" style="margin-top:-10px;"/>
    <i class="icon-search  icon-white"></i></button>
    </form>
    </div>
    
    <div style="float:left;width:250px">
    <form action="inicio.php?pg=listaclientes" method="post" enctype="multipart/form-data"  style="display:inline;" style="width:220px;">
    <span class="avisos">&nbsp;*Pesquise pelo ESTADO</span><br/>
    <select name="uf" style="width:205px">
        <option value=""></option>
        <option value="AC">ACRE </option>
        <option value="AL">ALAGOAS </option>
        <option value="AP">AMAPÁ </option>
        <option value="AM">AMAZONAS </option>
        <option value="BA">BAHIA </option>
        <option value="CE">CEARA </option>
        <option value="DF">DISTRITO FEDERAL </option>
        <option value="ES">ESPÍRITO SANTO </option>
        <option value="GO">GOIÁS </option>
        <option value="MA">MARANHÃO </option>
        <option value="MT">MATO GROSSO </option>
        <option value="MS">MATO GROSSO DO SUL </option>
        <option value="MG">MINAS GERAIS </option>
        <option value="PA">PARÁ </option>
        <option value="PB">PARAÍBA </option>
        <option value="PR">PARANÁ </option>
        <option value="PE">PERNAMBUCO </option>
        <option value="PI">PIAUÍ </option>
        <option value="RR">RORAIMA </option>
        <option value="RO">RONDONIA </option>
        <option value="RJ">RIO DE JANEIRO </option>
        <option value="RN">RIO GRANDE DO NORTE </option>
        <option value="RS">RIO GRANDE DO SUL </option>
        <option value="SC">SANTA CATARINA </option>
        <option value="SP">SÃO PAULO </option>
        <option value="SE">SERGIPE </option>
        <option value="TO">TOCANTINS </option>
    </select>  
    <button type="submit" class="btn ewButton" name="pesq1" id="btnsubmit" style="margin-top:-10px;"/>
    <i class="icon-search  icon-white"></i></button>
    </form>
    </div>
    
    <div style="float:left;width:250px">
    <form action="inicio.php?pg=listaclientes" method="post" enctype="multipart/form-data" style="display:inline;" style="width:220px;">
    <span class="avisos">&nbsp;*Pesquise pelo CORRETOR</span><br/>
    <input name="corretor" type="text" style="width:190px;">
    <button type="submit" class="btn ewButton" name="pesq" id="btnsubmit" style="margin-top:-10px;"/>
    <i class="icon-search  icon-white"></i></button>
    </form>
    </div>
    
    <div style="float:left;width:250px">
    <form action="inicio.php?pg=listaclientes" method="post" enctype="multipart/form-data"  style="display:inline;" style="width:220px;">
    <span class="avisos">&nbsp;*Pesquise pelo TELEFONE </span><br/>
    <input name="tel" type="text" style="width:190px;" id="tel">
    <button type="submit" class="btn ewButton" name="pesq1" id="btnsubmit" style="margin-top:-10px;"/>
    <i class="icon-search  icon-white"></i></button>
    </form>
    </div>
    
    <div style="float:left;width:250px">
    <form action="inicio.php?pg=listaclientes" method="post" enctype="multipart/form-data"  style="display:inline;" style="width:220px;">
    <span class="avisos">&nbsp;*Pesquise pelo CELULAR </span><br/>
    <input name="cel" type="text" style="width:190px;" id="cel">
    <button type="submit" class="btn ewButton" name="pesq1" id="btnsubmit" style="margin-top:-10px;"/>
    <i class="icon-search  icon-white"></i></button>
    </form>
    </div>
    
    <div style="float:left;width:250px">
    <form action="inicio.php?pg=listaclientes" method="post" enctype="multipart/form-data"  style="display:inline;" style="width:220px;">
    <span class="avisos">&nbsp;*Pesquise pela MENSALIDADE </span><br/>
   
    <input name="mens" type="text" style="width:190px;" id="mens">
    <button type="submit" class="btn ewButton" name="pesq1" id="btnsubmit" style="margin-top:-10px;"/>
    <i class="icon-search  icon-white"></i></button>
    </form>
    </div>
    
    <div style="float:left;width:250px">
    <form action="inicio.php?pg=listaclientes" method="post" enctype="multipart/form-data"  style="display:inline;" style="width:220px;">
    <span class="avisos">&nbsp;*Pesquise pela ANUIDADE </span><br/>
    <input name="anual" type="text" style="width:190px;" id="anual">
    <button type="submit" class="btn ewButton" name="pesq1" id="btnsubmit" style="margin-top:-10px;"/>
    <i class="icon-search  icon-white"></i></button>
    </form>
    </div>
    
    <div style="float:left;width:250px">
    <form action="inicio.php?pg=listaclientes" method="post" enctype="multipart/form-data"  style="display:inline;" style="width:220px;">
    <span class="avisos">&nbsp;*Pesquise pelo EMAIL</span><br/>
    <input name="email" type="text" style="width:190px;">
    <button type="submit" class="btn ewButton" name="pesq1" id="btnsubmit" style="margin-top:-10px;"/>
    <i class="icon-search  icon-white"></i></button>
    </form>
    </div>
    
    <div style="float:left;width:250px">
    <form action="inicio.php?pg=listaclientes" method="post" enctype="multipart/form-data"  style="display:inline;" style="width:220px;">
    <span class="avisos">&nbsp;*Pesquise pela SITUAÇÃO</span><br/>
    <select name="situacao" style="width:205px;">
       	<option value="V" selected>VIVO</option>
	    <option value="M">MORTO</option>
    	<option value="A">AGUARDAR</option>
	    <option value="I">ISENTO</option>
    </select>
    <button type="submit" class="btn ewButton" name="pesq1" id="btnsubmit" style="margin-top:-10px;"/>
    <i class="icon-search  icon-white"></i></button>
    </form>
    </div>
    
     <? /*
        <div style="float:left;width:500px"> <span class="avisos">* Escolha o CORRETOR e a SITUAÇÃO </span><br/>
    <form action="inicio.php?pg=listaclientes" method="post" enctype="multipart/form-data"  style="display:inline;" style="width:200px;">
       <input name="corretor1" type="text" style="width:220px;" >
      e
      <select name="situacao1" style="width:205px;">
       	<option value="V" selected>VIVO</option>
	    <option value="M">MORTO</option>
    	<option value="A">AGUARDAR</option>
	    <option value="I">ISENTO</option>
    </select>  
      
      <button type="submit" class="btn ewButton" name="pesq1" id="btnsubmit" style="margin-top:-10px;"/>
      <i class="icon-search  icon-white"></i>
      </button>
    </form>
  </div> 
     */ ?>
     
     
     
     
     <!-- Funcionar busca com grupo -->
    
     <div style="float:left;width:500px"> <span class="avisos">* Escolha o CORRETOR e a SITUAÇÃO </span><br/>
    <form action="inicio.php?pg=listaclientes" method="post" enctype="multipart/form-data"  style="display:inline;" style="width:200px;">
       <input name="corretor4" type="text" style="width:220px;" >
      e
      <select name="id_grupo" style="width:205px;">
       <?php 
		$confi = mysql_query("SELECT * FROM cliente WHERE id_cliente='$id'")or die (mysql_error());
		$confere = mysql_fetch_array($confi);
		$idss = $confere['id_grupo'];
		
		$sql1 = mysql_query("SELECT * FROM grupo WHERE id_grupo !='1' ORDER BY meses ASC")or die (mysql_error());
		while($ver = mysql_fetch_array($sql1)){
			$id_g= $ver['id_grupo'];
			$nomegrupo = $ver['nomegrupo'];
			
		?>
        <option value="<?php echo $ver['id_grupo'] ?>" <?php if(!(strcmp($id_g, $idss))) {echo "selected=\"selected\"";} ?>>
						<?php echo $nomegrupo;?></option>
        <?php } ?>
      </select>
      
      <button type="submit" class="btn ewButton" name="pesq1" id="btnsubmit" style="margin-top:-10px;"/>
      <i class="icon-search  icon-white"></i>
      </button>
    </form>
  </div>
    <!-- fim da instrução -->
    
    
    <div style="float:left;width:500px"> <span class="avisos">* Escolha o CORRETOR e o DIRETOR (A) ESPIRITUAL </span><br/>
    <form action="inicio.php?pg=listaclientes" method="post" enctype="multipart/form-data"  style="display:inline;" style="width:220px;">
       <input name="corretor2" type="text" style="width:210px;" >
      e
      <input name="dir_culto1" type="text" style="width:200px;" >  
      
      <button type="submit" class="btn ewButton" name="pesq1" id="btnsubmit" style="margin-top:-10px;"/>
      <i class="icon-search  icon-white"></i>
      </button>
    </form>
  </div> 
  
  <div style="float:left;width:500px"> <span class="avisos">* Escolha o CORRETOR e a CIDADE / MUNICÍPIO </span><br/>
    <form action="inicio.php?pg=listaclientes" method="post" enctype="multipart/form-data"  style="display:inline;" style="width:220px;">
       <input name="corretor3" type="text" style="width:210px;" >
      e
      <input name="cidade1" type="text" style="width:200px;" >  
      
      <button type="submit" class="btn ewButton" name="pesq1" id="btnsubmit" style="margin-top:-10px;"/>
      <i class="icon-search  icon-white"></i>
      </button>
    </form>
  </div> 
  
    
    
    
    <? /*
     <div style="float:left;width:250px">
    <form action="inicio.php?pg=listaclientes" method="post" enctype="multipart/form-data"  style="display:inline;" style="width:220px;">
    <span class="avisos">&nbsp;*Pesquise pelo SENHA</span><br/>
    <input name="senha" type="text" style="width:190px;">
    <button type="submit" class="btn ewButton" name="pesq1" id="btnsubmit" style="margin-top:-10px;"/>
    <i class="icon-search  icon-white"></i></button>
    </form>
    </div>
    */ ?>
    
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
	
} else if(isset($_POST['identidade']) && $_POST['identidade'] != ""){
	$pesquisar = $_POST['identidade'];
	$filtro = "identidade:'".$_POST['identidade']."'";
	$sql_1 = "SELECT * FROM cliente WHERE rg LIKE '%$pesquisar%' OR rg_pres LIKE '%$pesquisar%' ORDER BY dir_culto ASC";

} else if(isset($_POST['profissao']) && $_POST['profissao'] != ""){
	$pesquisar = $_POST['profissao'];
	$filtro = "profissao:'".$_POST['profissao']."'";
	$sql_1 = "SELECT * FROM cliente WHERE profissao LIKE '%$pesquisar%' OR profissao_pres LIKE '%$pesquisar%' ORDER BY dir_culto ASC";

} else if(isset($_POST['natural']) && $_POST['natural'] != ""){
	$pesquisar = $_POST['natural'];
	$filtro = "natural:'".$_POST['natural']."'";
	$sql_1 = "SELECT * FROM cliente WHERE natural_pres LIKE '%$pesquisar%' OR naturalidade LIKE '%$pesquisar%' ORDER BY dir_culto ASC";

} else if(isset($_POST['linha']) && $_POST['linha'] != ""){
	$pesquisar = $_POST['linha'];
	$filtro = "linha:'".$_POST['linha']."'";
	$sql_1 = "SELECT * FROM cliente WHERE linha_trab LIKE '%$pesquisar%' ORDER BY dir_culto ASC";

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
echo "<a class=\"pag\" href=\"#\" onclick=\"sendPost('inicio.php?pg=listaclientes".$part."',{".$filtro."}, '1')\" target=\"_self\">&laquo;&laquo; Primeira</a> ";
}
?>
&nbsp;

<select name="pg" onchange="sendPost('inicio.php?pg=listaclientes<?php echo $part;?>',{<?php echo $filtro; ?>}, this.value );" style="width: 50px;">          
<option selected="selected"><?php echo $p; ?> </option>
<?php
// Cria um for() para exibir os 3 links antes da página atual
for($i = 1; $i <= $pags; $i++) {
	echo "<option value=\"$i\">$i</option>";
}
echo "</select>&nbsp;";
if ($pags>1){
// Exibe o link "última página"
echo "<a class=\"pag\" href=\"#\" onclick=\"sendPost('inicio.php?pg=listaclientes".$part."',{".$filtro."}, '".$pags."')\" target=\"_self\">Ultima &raquo;&raquo;</a> ";
}
?>

&nbsp;&nbsp;<a class="pag" href='inicio.php?pg=listaclientes'>«« Listar Todos »» </a>&nbsp;&nbsp;|&nbsp;&nbsp;Total de Clientes / Pesquisa: <?php echo $total_registros; ?>
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
echo "<a class=\"pag\" href=\"#\" onclick=\"sendPost('inicio.php?pg=listaclientes".$part."',{".$filtro."}, '1')\" target=\"_self\">&laquo;&laquo; Primeira</a> ";
}
?>
&nbsp;

<select name="pg" onchange="sendPost('inicio.php?pg=listaclientes<?php echo $part;?>',{<?php echo $filtro; ?>}, this.value );" style="width: 50px;">          
<option selected="selected"><?php echo $p; ?> </option>
<?php
// Cria um for() para exibir os 3 links antes da página atual
for($i = 1; $i <= $pags; $i++) {
	echo "<option value=\"$i\">$i</option>";
}
echo "</select>&nbsp;";
if ($pags>1){
// Exibe o link "última página"
echo "<a class=\"pag\" href=\"#\" onclick=\"sendPost('inicio.php?pg=listaclientes".$part."',{".$filtro."}, '".$pags."')\" target=\"_self\">Ultima &raquo;&raquo;</a> ";
}
?>