<?php
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

//se nao existir volta para a pagina do form de login
if(!isset($_SESSION['login_session']) and !isset($_SESSION['senha_session'])){
	header("Location:../index.php");
	exit;		
}

?>
<script src="js/jquery-1.10.2.js"></script>
<script src="js/jquery-ui-1.10.4.custom.js"></script>
<script type="text/javascript" src="js/jquery.mask-money.js"></script>
    <script type="text/javascript">     
$(document).ready(function() {
        $("#valor").maskMoney({decimal:".",thousands:""});
        $("#novo_valor").maskMoney({decimal:".",thousands:""});
        $("#valor_anual").maskMoney({decimal:".",thousands:""});
        $("#novo_valor_anual").maskMoney({decimal:".",thousands:""});
        
      });
</script>

<div id="conteudoform">

<div id="entrada">
<div id="cabecalho"><h2>ATUALIZAR VALORES DAS MENSALIDADES </h2></div>

<div id="forms" style="display:table;padding-bottom:5px;">
  
  <div style="width:900px">
    <form action="inicio.php?pg=atualiza_valores" method="post" enctype="multipart/form-data"  style="display:inline;" style="width:220px;">
   MENSAL - * Atualizar Valores dos Clientes para: &nbsp;
    <input name="novo_valor" type="text" size="10" id="novo_valor" style="text-align:right; width:60px;">
    Quando situação for:
    <select name="situacao" style="width:100px;">
    <option> --- </option>
    <option value='V'>VIVOS</option>
    <option value='A'>AGUARDAR</option>
    <option value='M'>MORTOS</option>
    </select>
    e quando o valor for:
    <select name="condicao" style="width:100px;" >
    <option> --- </option>
    <option value='igual'>Igual a </option>
    <option value='maior'>Maior que</option>
    <option value='menor'>Menor que</option>   
    </select> 
    <input name="valor" type="text" size="10" id="valor" style="text-align:right; width:60px;">

     <button type="submit" class="btn ewButton" name="pesq1" id="btnsubmit" style="margin-top:-10px;"/>
    <i class="icon-search  icon-white"></i></button>
    </form>
  </div>

  <div style="width:900px">
    <form action="inicio.php?pg=atualiza_valores" method="post" enctype="multipart/form-data"  style="display:inline;" style="width:220px;">
    ANUAL - * Atualizar Valores dos Clientes para: &nbsp;
    <input name="novo_valor_anual" type="text" size="10" id="novo_valor_anual" style="text-align:right; width:60px;">
    Quando situação for:
    <select name="situacao" style="width:100px;">
    <option> --- </option>
    <option value='V'>VIVOS</option>
    <option value='A'>AGUARDAR</option>
    <option value='M'>MORTOS</option>
    </select>
    e quando o valor for:
    <select name="condicao" style="width:100px;" >
    <option> --- </option>
    <option value='igual'>Igual a </option>
    <option value='maior'>Maior que</option>
    <option value='menor'>Menor que</option>   
    </select> 
    <input name="valor_anual" type="text" size="10" id="valor_anual" style="text-align:right; width:60px;">

     <button type="submit" class="btn ewButton" name="pesq2" id="btnsubmit" style="margin-top:-10px;"/>
    <i class="icon-search  icon-white"></i></button>
    </form>
  </div>
     
</div>

<div id="forms">

<?php
//////////////////////////////Definição das buscas
if(isset($_POST['pesq1'])){
    
    if ($_POST['condicao'] == 'igual'){
        $condicao = '=';
    } else if ($_POST['condicao'] == 'maior'){
        $condicao = '>';
    } else if ($_POST['condicao'] == 'menor'){
        $condicao = '<';
    }

    $query = "UPDATE cliente SET valor = ".$_POST['novo_valor']." WHERE ";
    $query .= "situacao = '".$_POST['situacao']."'";
    $query .= " AND ";
    $query .= "valor ".$condicao." ".$_POST['valor'];

	$sql = mysql_query($query);
    if ($sql == 1){
        echo 'MENSALIDADES ATUALIZADAS!';
    }
	
} else if (isset($_POST['pesq2'])){
    
    if ($_POST['condicao'] == 'igual'){
        $condicao = '=';
    } else if ($_POST['condicao'] == 'maior'){
        $condicao = '>';
    } else if ($_POST['condicao'] == 'menor'){
        $condicao = '<';
    }

    $query = "UPDATE cliente SET valor_anual = ".$_POST['novo_valor_anual']." WHERE ";
    $query .= "situacao = '".$_POST['situacao']."'";
    $query .= " AND ";
    $query .= "valor_anual ".$condicao." ".$_POST['valor_anual'];

    $sql = mysql_query($query);
    if ($sql == 1){
        echo 'MENSALIDADES ATUALIZADAS!';
    }
    
}  


?>

</div>