<?php 
session_start();
//se nao existir volta para a pagina do form de login
if(!isset($_SESSION['login_session']) and !isset($_SESSION['senha_session'])){
	header("Location:../index.php");
	exit;		
}

include "../classes/conexao.php";
include "../classes/funcoes.class.php";
?>
<script type="text/javascript">		
function validar_uni() {
var id_cliente = formu.id_cliente.value;
var num_doc = formu.num_doc.value; 
var ref = formu.ref.value;
var valor = formu.valor.value;
var data_venci = formu.data_venci.value;
var mi = formu.mes_inicial.value;
var ai = formu.ano_inicial.value;
var mf = formu.mes_final.value;
var af = formu.ano_final.value;

var di = new Date(ai, mi, '01').getTime(); //Formato mm/dd/aaaa
var df = new Date(af, mf, '01').getTime(); //Formato mm/dd/aaaa

if (di > df){
alert('A data inicial não pode ser maior que a data final, no intervalo!');
formu.mes_inicial.focus();
return false
} else if (di == df){
alert('As datas do intervalo são iguais! Por favor utilize a opção 1');
formu.mes_inicial.focus();
return false
} 

if (id_cliente == "0") {
alert('Selecione um cliente.');
formu.id_cliente.focus();
return false;
}
if (num_doc == "") {
alert('Digite o numero do documento ou use o sugerido');
formu.num_doc.focus();
return false;
}
if (ref == "") {
alert('Digite a descrição da fatura.');
formu.ref.focus();
return false;
}
if (data_venci == "") {
alert('Selecione a data de vencimento.');
formu.data_venci.focus();
return false;
}

} ////////////// FIM DA FUNCTION /////////////////////

function controleFormulario(n) {
	
	if (n == 1){
	document.formu.ref_mes.disabled=false;
	document.formu.ref_ano.disabled=false;	
	document.formu.texto.disabled=true;
	document.formu.mes_inicial.disabled=true;
	document.formu.mes_final.disabled=true;
	document.formu.ano_inicial.disabled=true;
	document.formu.ano_final.disabled=true;
	document.formu.anual_ano.disabled=true;
	} else if (n ==2){
	document.formu.ref_mes.disabled=true;
	document.formu.ref_ano.disabled=true;	
	document.formu.texto.disabled=false;
	document.formu.mes_inicial.disabled=true;
	document.formu.mes_final.disabled=true;
	document.formu.ano_inicial.disabled=true;
	document.formu.ano_final.disabled=true;
	document.formu.anual_ano.disabled=true;
	} else if (n == 4){
	document.formu.ref_mes.disabled=true;
	document.formu.ref_ano.disabled=true;	
	document.formu.texto.disabled=true;
	document.formu.mes_inicial.disabled=true;
	document.formu.mes_final.disabled=true;
	document.formu.ano_inicial.disabled=true;
	document.formu.ano_final.disabled=true;
	document.formu.anual_ano.disabled=false;
	} else {
	document.formu.ref_mes.disabled=true;
	document.formu.ref_ano.disabled=true;	
	document.formu.texto.disabled=true;
	document.formu.mes_inicial.disabled=false;
	document.formu.mes_final.disabled=false;
	document.formu.ano_inicial.disabled=false;
	document.formu.ano_final.disabled=false;
	document.formu.anual_ano.disabled=true;
	}
	
}
</script>
<link href="css/jquery-ui-1.10.4.custom.css" rel="stylesheet" type="text/css">
<script src="js/jquery-1.10.2.js"></script>
<script src="js/jquery-ui-1.10.4.custom.js"></script>
<script>
    $(document).ready(function () {
        $(".data_venci").datepicker({
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
<script type="text/javascript" src="js/jquery.mask-money.js"></script>
    <script type="text/javascript">		
$(document).ready(function() {
        $("#valor").maskMoney({decimal:",",thousands:""});
      });

function SomenteNumero(e){

  var tecla=(window.event)?event.keyCode:e.which;   
  if((tecla>47 && tecla<58)){
      return true;
  }else{
      if(tecla==8 || tecla==0){
         return true;
      }else{
         return false;
      }
  }
}
</script>
    <div id="menufatura">
	<ul>
    	<li>
        <div class="control-group">
        <div class="controls">
        <div class="btn ewButton" name="user" id="btnsubmit"/ >
        <a href="inicio.php?pg=lancafatura" style=" text-decoration:none; color:#000;">
        <i class="icon-refresh"></i> Fatura unica</a></div>
      </li>
      <li>
        <div class="control-group">
        <div class="controls">
        <div class="btn ewButton" name="user" id="btnsubmit"/ >
        <a href="inicio.php?pg=periodica" style=" text-decoration:none; color:#000;">
        <i class="icon-refresh"></i> Fatura para grupo de clientes</a></div>
      </li>
       <li>
        <div class="control-group">
        <div class="controls">
        <div class="btn ewButton" name="user" id="btnsubmit"/ >
        <a href="inicio.php?pg=fataluguel.php" style=" text-decoration:none; color:#000;">
        <i class="icon-refresh"></i> Fatura para Aluguel</a></div>
      </li>
  </ul>

</div>
<div style="clear:both;"></div>
<br/>
<div id="entrada">
<div id="cabecalho"><h2><i class="icon-money iconmd"></i> Fatura unica</h2></div>
<div id="forms" style="display:table;padding-bottom:5px;">
  
  <form action="" method="post" name="formu" id="formu" enctype="multipart/formu-data" onSubmit="return validar_uni(this);">
    Cliente:<br/>
    <select name="id_cliente">
    	<option value="0">Selecione um cliente...</option>
     <?php
     $sql = mysql_query("SELECT * FROM cliente WHERE situacao ='AL' ORDER BY matricula DESC")or die (mysql_error());
	while($linha = mysql_fetch_array($sql)){
	?>
    <option value="<?php echo $linha['id_cliente'] ?>">
	<?php echo $linha['matricula'].' - '.$linha['dir_culto']; ?></option>
    <?php } ?>
  </select><br/>

    <input name="num_doc" type="hidden" value="<?php echo $cont['num_doc']+1;?>" style="width:100px;">
    
<div style="float:left;width:450px">
   <fieldset style="border:1px solid #666;width:400px;"><legend>Escolha qual o tipo da descrição das faturas</legend>
    
    <input name="ref" type="radio" value="2" onclick="controleFormulario(1);" />
    1 - MENSALIDADE DE&nbsp;
    <select name="ref_mes" style="width:100px;" disabled="disabled">
    <option> --- </option>
    <?php echo geraOptionMeses();?>
    </select>
    /
    <select name="ref_ano" style="width:100px;" disabled="disabled">
    <option> --- </option>
    <?php for ($i=2017;$i<=2040;$i++){
			echo "<option value='$i'>$i</option>";
		  }?>
     </select> 
    
          <br />
    
     <input name="ref" type="radio" value="1"  onclick="controleFormulario(2); " checked="CHECKED" />
    2 - DESCRIÇÃO DA FATURA:<br/>
    <input type="text" style="width:300px;" name="texto">
    
    <br/>
    
    <input name="ref" type="radio" value="3" onclick="controleFormulario(3);" />
    3 - MENSALIDADE DE&nbsp;
    <select name="mes_inicial" style="width:100px;" disabled="disabled">
    <option> --- </option>
    <?php echo geraOptionMeses();?>
    </select>
    /
    <select name="ano_inicial" style="width:100px;" disabled="disabled">
    <option> --- </option>
    <?php for ($i=2017;$i<=2040;$i++){
			echo "<option value='$i'>$i</option>";
		  }?>
     </select> 
     a
     <select name="mes_final" style="width:100px;" disabled="disabled">
    <option> --- </option>
    <?php echo geraOptionMeses();?>
    </select>
    /
    <select name="ano_final" style="width:100px;" disabled="disabled">
    <option> --- </option>
    <?php for ($i=2017;$i<=2040;$i++){
			echo "<option value='$i'>$i</option>";
		  }?>
     </select> 
     <br />
     
     <input name="ref" type="radio" value="4" onclick="controleFormulario(4);" />
    4 - ANUIDADE: JANEIRO A DEZEMBRO &nbsp;
     <select name="anual_ano" style="width:100px;" disabled="disabled">
    <option> --- </option>
    <?php for ($i=2017;$i<=2040;$i++){
			echo "<option value='$i'>$i</option>";
		  }?>
     </select>        
     </fieldset>
</div>
<div style="float:left;width:450px">     
     <fieldset style="float:left; border: 1px solid #F00; width:400px;">
     <h4>Breve explicação sobre o lançamento de faturas</h4><br />
     <p style="text-align:justify;">- Escolha a opção 1 ao lado para que o sistema consiga processar o arquivo de RETORNO e atualizar sozinho as mensalidades pagas.</p>
     <p style="text-align:justify;">- O sistema gera automaticamente as mensalidades do ano de referencia ao escolher a opção 1 ou opção 3. </p>
     <p style="text-align:justify;">- Para faturas anuais ou para quantidade de meses maior que 1, utilize a opção 3. </p>
     <p style="font-style:italic; color:#F00; text-align:justify;">Obs: Infelizmente o sistema não conseguirá buscar as referências dos boletos mistos, boletos com mais de uma referência em seu conteúdo.</p>
     
     </fieldset>
</div>
<div style="clear:both"></div>
    <br />
    Vencimento:<br/>
    <div class="input-prepend">
    <span class="add-on"><i class="icon-calendar"></i></span>
    <input type="text" name="data_venci" class="data_venci" style="width:100px;" />
    </div><br/>
    
<div style="float:left;width:450px">  
     Lançar valor mensal? (este valor será multiplicado pela quantidade de meses)<br/>
    <div id="sim"><input name="define" type="radio" value="s" checked="CHECKED" onclick="document.formu.valor.disabled=true">Sim</div>
    <div id="sim"><input name="define" type="radio" value="n" onclick="document.formu.valor.disabled=false">Não</div>
    <div id="sim" style="width:80px;"><input name="define" type="radio" value="a" onclick="document.formu.valor.disabled=true">Valor Anual</div>
   <br/><br/>
</div>

<div style="float:left;width:550px">
 <fieldset style="float:left; border: 1px solid #F00; width:500px;">
   <p style="text-align:justify;">Escolha "Sim" para valor mensal do cadastro do cliente ou "Não" para digitar um novo valor.</p></fieldset>
</div>     
   
<div style="clear:both"></div>
    <br />
    Valor:<br/>
    <div class="input-prepend">
    <span class="add-on"><i class="icon-money"></i></span>
    <input name="valor" type="text" size="10" id="valor" style="text-align:right; width:60px;" disabled="disabled">
    <span class="avisos" style="margin-left:10px;"> *Preencher somente se quiser alterar o valor mensal cadastrado para o cliente.</span>
    <br/>
    </div><br/>
 
    <div class="control-groupa">
    <div class="controlsa">
    
    <input name="lancafatunica" type="hidden" value="lancafatunica">
    
    <button type="submit" class="btn btn-success ewButton" name="lancafatunica">
    <i class="icon-thumbs-up icon-white"></i> Lançar Fatura</button>
    </div></div>
    </form>
</div>