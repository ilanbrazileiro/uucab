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
	function validar() {

	var id_grupo = form.id_grupo.value;
	var ref = form.ref.value;
	var valor = form.valor.value;
	var data_venci = form.data_venci.value;
	var mi = form.mes_inicial.value;
	var ai = form.ano_inicial.value;
	var mf = form.mes_final.value;
	var af = form.ano_final.value;
	var di = new Date(ai, mi, '01').getTime(); //Formato mm/dd/aaaa
	var df = new Date(af, mf, '01').getTime(); //Formato mm/dd/aaaa

	if (di > df){

		alert('A data inicial não pode ser maior que a data final, no intervalo!');
		form.mes_inicial.focus();
		return false

	} else if (di == df){

		alert('As datas do intervalo são iguais! Por favor utilize a opção 1');
		form.mes_inicial.focus();
		return false
	} 

	if (id_grupo == "0") {

		alert('Selecione um grupo de clientes.');
		form.id_grupo.focus();
		return false;
	}

	if (ref == "") {

	alert('Digite a descrição da fatura.');

	form.ref.focus();

	return false;

	}



	if (data_venci == "") {

	alert('Selecione a data de vencimento.');

	form.data_venci.focus();

	return false;

	}

	} ////////////// FIM DA FUNCTION /////////////////////



function controleFormulario(n) {

	

	if (n == 1){

	document.form.ref_mes.disabled=false;

	document.form.ref_ano.disabled=false;	

	document.form.texto.disabled=true;

	document.form.mes_inicial.disabled=true;

	document.form.mes_final.disabled=true;

	document.form.ano_inicial.disabled=true;

	document.form.ano_final.disabled=true;

	document.form.anual_ano.disabled=true;

	} else if (n ==2){

	document.form.ref_mes.disabled=true;

	document.form.ref_ano.disabled=true;	

	document.form.texto.disabled=false;

	document.form.mes_inicial.disabled=true;

	document.form.mes_final.disabled=true;

	document.form.ano_inicial.disabled=true;

	document.form.ano_final.disabled=true;

	document.form.anual_ano.disabled=true;

	} else if (n == 4){

	document.form.ref_mes.disabled=true;

	document.form.ref_ano.disabled=true;	

	document.form.texto.disabled=true;

	document.form.mes_inicial.disabled=true;

	document.form.mes_final.disabled=true;

	document.form.ano_inicial.disabled=true;

	document.form.ano_final.disabled=true;

	document.form.anual_ano.disabled=false;

	} else {

	document.form.ref_mes.disabled=true;

	document.form.ref_ano.disabled=true;	

	document.form.texto.disabled=true;

	document.form.mes_inicial.disabled=false;

	document.form.mes_final.disabled=false;

	document.form.ano_inicial.disabled=false;

	document.form.ano_final.disabled=false;

	document.form.anual_ano.disabled=true;

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

    </ul>



</div>

<div style="clear:both;"></div>

<br/>

<div id="entrada">

<?php 

$fat = mysql_query("SELECT * FROM faturas") or die(mysql_error());

$cont = mysql_num_rows($fat);

?>

<div id="cabecalho">

  <h2><i class="icon-money iconmd"></i> Fatura para <span style="color:#F00;">grupo</span></h2></div>

<div id="forms">

	<form action="" method="post" name="form" id="form" enctype="multipart/form-data" onSubmit="return validar(this);">

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

  </select><br/>



    <input name="num_doc" type="hidden" value="<?php echo $cont+1;?>" onkeypress="return SomenteNumero(event)" style="width:100px;">

	

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

    2 - Descrição das faturas:<br/>

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

    Lançar valor mensal para todos do grupo?<br/>

    <div id="sim"><input name="define" type="radio" value="s" checked="CHECKED" onclick="document.form.valor.disabled=true">Sim</div>
    <div id="sim"><input name="define" type="radio" value="n" onclick="document.form.valor.disabled=false">Não</div>
    <div id="sim" style="width:80px;"><input name="define" type="radio" value="a" onclick="document.form.valor.disabled=true">Valor Anual</div>
    <br/><br/>
    <br />

    Valor:<br/>

    <div class="input-prepend">
    <span class="add-on"><i class="icon-money"></i></span>
    <input name="valor" type="text" size="10" id="valor" style="text-align:right; width:60px;" disabled="disabled">
    <span class="avisos" style="margin-left:10px;"> *Preencher somente se quiser alterar o valor cadastrado para os clientes do grupo.</span>
    <br/>
    </div><br/>

    <div class="control-groupa">
    <div class="controlsa">

    <input name="lancafatperiodica" type="hidden" value="lancafatperiodica">

    <button type="submit" class="btn btn-success ewButton" name="lancafatperiodica">

    <i class="icon-thumbs-up icon-white"></i> Lançar Fatura</button>
    </div></div>
    </form>
</div>