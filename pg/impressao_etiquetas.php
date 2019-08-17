<?php 
session_start();
//se nao existir volta para a pagina do form de login
if(!isset($_SESSION['login_session']) and !isset($_SESSION['senha_session'])){
	header("Location:../index.php");
	exit;		
}
		
?>
<script type="text/javascript">	
function controleFormulario(n) {
	
	if (n == 1){
	document.g_clientes.id_grupo.disabled=false;
	document.s_clientes.id_cliente.disabled=true;	
	document.i_clientes.m_inicial.disabled=true;
	document.i_clientes.m_final.disabled=true;
	document.sit_clientes.situacao_cliente.disabled=true;
	document.i_clientes.ref.checked=false;
	document.s_clientes.ref.checked=false;
	document.sit_clientes.ref.checked=false;
	
	} else if (n ==2){
	document.g_clientes.id_grupo.disabled=true;
	document.s_clientes.id_cliente.disabled=false;	
	document.i_clientes.m_inicial.disabled=true;
	document.i_clientes.m_final.disabled=true;
	document.sit_clientes.situacao_cliente.disabled=true;
	document.g_clientes.ref.checked=false;
	document.i_clientes.ref.checked=false;
	document.sit_clientes.ref.checked=false;
	} else if (n ==3){
	document.g_clientes.id_grupo.disabled=true;
	document.s_clientes.id_cliente.disabled=true;	
	document.i_clientes.m_inicial.disabled=true;
	document.i_clientes.m_final.disabled=true;
	document.sit_clientes.situacao_cliente.disabled=false;
	document.g_clientes.ref.checked=false;
	document.s_clientes.ref.checked=false;
	document.i_clientes.ref.checked=false;
	} else {
	document.g_clientes.id_grupo.disabled=true;
	document.s_clientes.id_cliente.disabled=true;	
	document.i_clientes.m_inicial.disabled=false;
	document.i_clientes.m_final.disabled=false;
	document.sit_clientes.situacao_cliente.disabled=true;
	document.g_clientes.ref.checked=false;
	document.s_clientes.ref.checked=false;
	document.sit_clientes.ref.checked=false;
	}
}
</script>
<div id="entrada">
<div id="cabecalho">
  <h2><i class="icon-print  iconmd"></i> Impressão de Etiquetas</h2>
</div>

<div id="forms" style="display:table;padding-bottom:5px;">
  <div style="width:400px">
    <form action="pg/etiquetas.php" method="post" enctype="multipart/form-data" target="_blank" name="g_clientes">
    <input name="ref" type="radio" value="1" onclick="controleFormulario(1);" />
      Grupo de Clientes:<br/>
    <select name="id_grupo">
    	<option value="0">Selecione um grupo...</option>
     <?php
     $sql = mysql_query("SELECT * FROM grupo WHERE id_grupo != '1' ORDER BY id_grupo ASC")or die (mysql_error());
	while($linha = mysql_fetch_array($sql)){
	?>
    <option value="<?php echo $linha['id_grupo'] ?> ">
	<?php echo $linha['nomegrupo']; ?></option>
    <?php } ?>
  </select>
      <button type="submit" class="btn ewButton" name="grupo" id="btnsubmit" style="margin-top:-10px;"/>
      <i class="icon-search  icon-white"></i>
      </button>
    </form>
  </div>
  
  <div style="width:400px">
    <form action="pg/etiquetas.php" method="post" enctype="multipart/form-data" target="_blank" name="s_clientes">
    <input name="ref" type="radio" value="2" onclick="controleFormulario(2);" />
         Cliente:<br/>
    <select name="id_cliente">
    	<option value="0">Selecione um cliente...</option>
     <?php
     $sql = mysql_query("SELECT * FROM cliente WHERE bloqueado ='N' AND situacao = 'V' ORDER BY matricula DESC")or die (mysql_error());
	while($linha = mysql_fetch_array($sql)){
	?>
    <option value="<?php echo $linha['id_cliente'] ?>">
	<?php echo $linha['matricula'].' - '.$linha['dir_culto']; ?></option>
    <?php } ?>
  </select>
      <button type="submit" class="btn ewButton" name="cliente" id="btnsubmit" style="margin-top:-10px;"/>
      <i class="icon-search  icon-white"></i>
      </button>
    </form>
  </div>
  
   <div style="width:400px">
    <form action="pg/etiquetas.php" method="post" enctype="multipart/form-data" target="_blank" name="sit_clientes">
    <input name="ref" type="radio" value="3" onclick="controleFormulario(3);" />
         Situação do Cliente:<br/>
   		    <select name="situacao_cliente">
    			<option value="0">Selecione uma Situação...</option>
        		<option value="V"> VIVO
    			<option value="M"> MORTO
    			<option value="A"> AGUARDAR
       		</select>
      <button type="submit" class="btn ewButton" name="situacao" id="btnsubmit" style="margin-top:0px;margin-left:3px;"/>
 	     <i class="icon-search  icon-white"></i>
      </button>
    </form>
  </div>
  
  <div style="width:400px">
    <form action="pg/etiquetas.php" method="post" enctype="multipart/form-data" target="_blank" name="i_clientes">
    <input name="ref" type="radio" value="4" onclick="controleFormulario(4);" />
        Intervalo de Clientes:<br/>
   		<input type="text" name="m_inicial" placeholder="Matricula Inicial" style="float:left;width:93px;"/>
   		<input type="text" name="m_final" placeholder="Matricula Final" style="float:left;width:93px;margin-left:5px;"/>
        
      <button type="submit" class="btn ewButton" name="intervalo" id="btnsubmit" style="margin-top:0px;margin-left:3px;"/>
      <i class="icon-search  icon-white"></i>
      </button>
    </form>
  </div>

</div>