<?php
session_start();
//se nao existir volta para a pagina do form de login
if(!isset($_SESSION['login_session']) and !isset($_SESSION['senha_session'])){
	header("Location:../index.php");
	exit;		
}

$total_cadatros = mysql_query("SELECT COUNT(*) FROM cliente");
while($array = mysql_fetch_array($total_cadatros)) {
// Variável para capturar o campo "nome" no banco de dados
$tc = $array[0];
}


?>
<div id="conteudoform">

<script type="text/javascript">
function NovaJanela(pagina,nome,w,h,scroll){
	LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
	TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
	settings = 'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
	win = window.open(pagina,nome,settings);
	}
window.name = "main";
</script>

<div id="entrada">
<div id="cabecalho"><h2>RELATÓRIOS </h2></div>

<div id="forms" style="display:table;padding-bottom:5px;">
  
  <div style="width:600px">
    <form action="inicio.php?pg=relatorio" method="post" enctype="multipart/form-data"  style="display:inline;" style="width:220px;">
    *Clientes em atraso para o mês: &nbsp; 
     <select name="ref_mes" style="width:100px;" >
    <option> --- </option>
    <?php echo geraOptionMeses();?>
    </select>
    /
    <select name="ref_ano" style="width:100px;" >
    <option> --- </option>
    <?php for ($i=2017;$i<=2040;$i++){
			echo "<option value='$i'>$i</option>";
		  }?>
     </select> 
     <button type="submit" class="btn ewButton" name="pesq1" id="btnsubmit" style="margin-top:-10px;"/>
    <i class="icon-search  icon-white"></i></button>
    </form>
  </div>
  
  <div style="width:600px">
    <form action="inicio.php?pg=relatorio" method="post" enctype="multipart/form-data" style="display:inline;" style="width:220px;">
    *Clientes sem boleto para o mês: 
    <select name="ref_mes" style="width:100px;">
    <option> --- </option>
    <?php echo geraOptionMeses();?>
    </select>
    /
    <select name="ref_ano" style="width:100px;">
    <option> --- </option>
    <?php for ($i=2017;$i<=2040;$i++){
			echo "<option value='$i'>$i</option>";
		  }?>
     </select> 
    
    <button type="submit" class="btn ewButton" name="pesq2" id="btnsubmit" style="margin-top:-10px;"/>
    <i class="icon-search  icon-white"></i></button>
    </form>
  </div>
  
   <div style="width:600px">
    <form action="inicio.php?pg=relatorio" method="post" enctype="multipart/form-data" style="display:inline;" style="width:220px;">
    *Clientes com o campo vazio: 
    <select name="campo" style="width:100px;">
    <option> --- </option>
    <?php echo geraOptionCampoCliente ();?>
    </select>
    
    <button type="submit" class="btn ewButton" name="pesq3" id="btnsubmit" style="margin-top:-10px;"/>
    <i class="icon-search  icon-white"></i></button>
    </form>
  </div>
  
   <div style="width:600px">
    <form action="inicio.php?pg=relatorio" method="post" enctype="multipart/form-data" style="display:inline;" style="width:220px;">
    *Clientes com alguma mensalidade paga para o ano: 
    <select name="campo" style="width:100px;">
    <option> --- </option>
    <?php for ($i=2019;$i<=2040;$i++){
			echo "<option value='$i'>$i</option>";
		  }?>
    </select>
    
    <button type="submit" class="btn ewButton" name="pesq4" id="btnsubmit" style="margin-top:-10px;"/>
    <i class="icon-search  icon-white"></i></button>
    </form>
  </div>

  <div style="width:600px">
    <form action="inicio.php?pg=relatorio" method="post" enctype="multipart/form-data" style="display:inline;" style="width:220px;">
    *Clientes com CPF inválidos: 
    <select name="campo" style="width:100px;">
    <option> --- </option>
    <option value='V'>VIVOS</option>
    <option value='A'>AGUARDAR</option>
    <option value='M'>MORTOS</option>
    </select>
    
    <button type="submit" class="btn ewButton" name="pesq5" id="btnsubmit" style="margin-top:-10px;"/>
    <i class="icon-search  icon-white"></i></button>
    </form>
  </div>
     
</div>

<div id="forms">

<?php
//////////////////////////////Definição das buscas
if(isset($_POST['pesq1'])){
    $sql_1 = "SELECT * FROM cliente WHERE situacao = 'V'";
	
	$mes = $_POST['ref_mes']; $ano = $_POST['ref_ano'];
	
	$clientes = clientesAtrasoMes(getMesAbr($mes), $ano);
	$pesquisado = "Clientes em atraso para a referência: ".$mes."/".$ano;

} else if(isset($_POST['pesq2'])){
    $sql_1 = "SELECT * FROM cliente WHERE situacao = 'V'";
	$mes = $_POST['ref_mes']; $ano = $_POST['ref_ano'];

	$clientes = clientesSemBoletoMes($mes, $ano);
	$pesquisado = "Clientes sem boleto encontrado para a referência: ".$mes."/".$ano;

} else if(isset($_POST['pesq3'])){
	
	$campo = $_POST['campo'];

	$clientes = campoVazio($campo);
	$pesquisado = "Clientes com campos vazios";
	
} else if(isset($_POST['pesq4'])){
	
	$campo = $_POST['campo'];

	$clientes = mensalidadePagaParaAno($campo);
	$pesquisado = "Clientes com alguma mensaliade paga para o ano";

} else if(isset($_POST['pesq5'])){
    
    $campo = $_POST['campo'];

    $clientes = clientesComCPFinvalido($campo);
    $pesquisado = " Clientes com CPF invalido";
} 


?>

<h3>PESQUISA: <?php echo $pesquisado; ?></h3>
<div id="fundo-tabela">

<table width="100%" border="0" cellspacing="1" cellpadding="5" data-rowindex="1" data-rowtype="1">
<tbody>
  <tr>
    <td width="5%" bgcolor="#0490fc"><span class="fontebranca">Matr</span></td>
    <td width="21%" bgcolor="#0490fc"><span class="fontebranca">Diretor (a) Espíritual</span></td>
    <td width="21%" bgcolor="#0490fc"><span class="fontebranca">Presidente </span></td>
    <td width="17%" bgcolor="#0490fc"><span class="fontebranca">Centro / Terreiro</span></td>
    <td width="14%" bgcolor="#0490fc"><span class="fontebranca">Município do Centro</span></td>
    <td width="5%" bgcolor="#0490fc"><span class="fontebranca">Situação</span></td>
    <td width="4%" align="center" bgcolor="#0490fc"><span class="fontebranca">Valor</span></td>
    <td width="4%" align="center" bgcolor="#0490fc"><span class="fontebranca">Grupo</span></td>
    <td width="9%" align="center" bgcolor="#0490fc"><span class="fontebranca">Última Mensalidade Paga</span></td>
     <td width="5%" align="center" bgcolor="#0490fc"><span class="fontebranca">Ação</span></td>
   
    </tr>
</tbody>

<?php
	foreach($clientes as $id){
		
		$array = getCliente($id);
			
// Variável para capturar o campo "nome" no banco de dados
$idgrupo = $array['id_grupo'];
	
	if ($array['situacao'] == "I"){/////////Verifica se cliente ISENTO, senão verifica ultima mensalidade
		$ultima_mensalidade = 'ISENTO';
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
    <td align="left"><?php echo $array['centro']; ?><br><?php echo $array['cnpj']; ?></td>
    <td align="left"><?php echo $array['cidade_dir']; ?>-<?php echo $array['uf_dir']; ?></td>
    <td align="center"><?php echo getSituacao($array['situacao']); ?></td>
    <td align="center"><?php echo number_format($array['valor'],'2',',','.'); ?></td>
    <?php 
		$dad = mysql_query("SELECT * FROM grupo WHERE  id_grupo = '$idgrupo'");
		$dado = mysql_fetch_array($dad);
		if($dado['nomegrupo'] == ""){ $grupo = "AVULSO";
		} else { $grupo = $dado['nomegrupo']; }
	?>
    <td align="left"><?php echo $grupo; ?></td>
    
    <td align="center" <?php if ($verifica_atraso == '1'){ echo "style='color:red;font-weight:bold;'";} ?> ><?php echo $ultima_mensalidade ?></td>
    
  		 <td align="right">
                <div class="btn-group">
            <a href="pg/editacliente.php?id=<?php echo $array['id_cliente'] ?>&p=<?php echo $p ?>" style="text-decoration:none;" 
            class="btn btn-default" onclick="NovaJanela(this.href,'nomeJanela','1050','550','yes');return false" title="Editar">
            <i class="icon-edit"></i></a>
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
</div>