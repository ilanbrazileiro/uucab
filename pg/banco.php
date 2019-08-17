<?php 
session_start();
//se nao existir volta para a pagina do form de login
if(!isset($_SESSION['login_session']) and !isset($_SESSION['senha_session'])){
	header("Location:../index.php");
	exit;		
}
$sql = mysql_query("SELECT * FROM bancos WHERE situacao ='1'")or die (mysql_error());
$linhas = mysql_fetch_array($sql);
$bancoativo = $linhas['id_banco'];
?>
<div id="conteudoform">
<div id="entrada">
<div id="cabecalho">
<h2><i class="icon-file-text"></i> Dados Bancários:</h2>
</div>

<?php 
if($linhas['id_banco'] == '4' || $linhas['id_banco'] == '5'){ ?>
<div id="forms">
<strong>Banco Ativo</strong>
<div id="img-banco"><img src="img/<?php echo $linhas['img'] ?>" width="80" height="61"></div>

<form action="" method="post" name="form">
<br/>
<input name="id_banco" type="hidden" value="<?php echo $linhas['id_banco'] ?>">
Carteira:<br/>
<input name="carteira" type="text" value="<?php echo $linhas['carteira'] ?>" style="text-align:right; width:95px;"/>

<br/>
Agência:<br/>
<input name="agencia" type="text" size="10"  value="<?php echo $linhas['agencia'] ?>" style="text-align:right; width:95px;"/>
<input name="digito_ag" type="hidden" size="3" value="0"><br/>

Conta cedente - dígito:<br/>
<input name="conta" type="text" size="10" value="<?php echo $linhas['conta'] ?>" style="text-align:right; width:69px;" /> - 
<input name="digito_co" type="text" size="3" value="<?php echo $linhas['digito_co'] ?>" style="text-align:right; width:20px;"/>
<br/>

<div id="fatura">ESPECIE DE DOCUMENTO - (Se informe no banco qual usar)</div>

<table width="691" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="282" align="left"><input name="especie" type="radio" value="01" <?php if($linhas['especie'] == '01'){echo 'checked';}?>>
&nbsp;01 - DUPLICATA MERCANTIL </td>
    <td width="409" align="left"><input name="especie" type="radio" value="08" <?php if($linhas['especie'] == '08'){echo 'checked';}?>>
&nbsp;08 - DUPLICATA DE SERVIÇO </td>
  </tr>
  <tr>
    <td align="left"><input name="especie" type="radio" value="02" <?php if($linhas['especie'] == '02'){echo 'checked';}?>>
&nbsp;02 - NOTA PROMISSÓRIA </td>
    <td align="left"><input name="especie" type="radio" value="09" <?php if($linhas['especie'] == '09'){echo 'checked';}?>>
&nbsp;09 - LETRA DE CÂMBIO </td>
  </tr>
  <tr>
    <td align="left">
      <input name="especie" type="radio" value="03" <?php if($linhas['especie'] == '03'){echo 'checked';}?>>
&nbsp;03 - NOTA DE SEGURO </td>
    <td align="left"><input name="especie" type="radio" value="13" <?php if($linhas['especie'] == '13'){echo 'checked';}?>>
&nbsp;13 - NOTA DE DÉBITOS </td>
  </tr>
  <tr>
    <td align="left"><input name="especie" type="radio" value="04" <?php if($linhas['especie'] == '04'){echo 'checked';}?>>
&nbsp;04 - MENSALIDADE ESCOLAR </td>
    <td align="left"><input name="especie" type="radio" value="15" <?php if($linhas['especie'] == '15'){echo 'checked';}?>>
&nbsp;15 - DOCUMENTO DE DÍVIDA </td>
  </tr>
  <tr>
    <td align="left"><input name="especie" type="radio" value="05" <?php if($linhas['especie'] == '05'){echo 'checked';}?>>
&nbsp;05 - RECIBO </td>
    <td align="left"><input name="especie" type="radio" value="16" <?php if($linhas['especie'] == '16'){echo 'checked';}?>>
&nbsp;16 - ENCARGOS CONDOMINIAIS </td>
  </tr>
  <tr>
    <td align="left"><input name="especie" type="radio" value="06" <?php if($linhas['especie'] == '06'){echo 'checked';}?>>
&nbsp;06 - CONTRATO </td>
    <td align="left"><input name="especie" type="radio" value="17" <?php if($linhas['especie'] == '17'){echo 'checked';}?>>
&nbsp;17 - CONTA DE PRESTAÇÃO DE SERVIÇOS </td>
  </tr>
  <tr>
    <td align="left"><input name="especie" type="radio" value="07" <?php if($linhas['especie'] == '07'){echo 'checked';}?>>
&nbsp;07 - COSSEGUROS </td>
    <td align="left"><input name="especie" type="radio" value="99" <?php if($linhas['especie'] == '99'){echo 'checked';}?>>
&nbsp;99 - DIVERSOS </td>
  </tr>
  <tr>
    <td colspan="2" align="left"><br/>
    <div class="controlsa">
<button type="submit" class="btn btn-success ewButton" name="bancosgr" id="btnsubmit" >
<i class="icon-thumbs-up icon-white"></i> Atualizar dados bancários</button>
</div>
    </td>
    </tr>
</table>
</form>



</div></div></div>	
<?php }
elseif($linhas['id_banco'] == '1'){?>

<div id="forms">
<strong>Banco Ativo</strong>
<div id="img-banco"><img src="img/<?php echo $linhas['img'] ?>" width="80" height="61"></div>

<form action="" method="post" name="form">
<br/>
<input name="id_banco" type="hidden" value="<?php echo $linhas['id_banco'] ?>">
Carteira:<br/>
<input name="carteira" type="text" value="<?php echo $linhas['carteira'] ?>" style="text-align:right; width:95px;"/>

<br/>
Agência:<br/>
<input name="agencia" type="text" size="10"  value="<?php echo $linhas['agencia'] ?>" style="text-align:right; width:95px;"/>
<input name="digito_ag" type="hidden" size="3" value="0"><br/>
Conta(sem o digito):<br/>
<input name="conta" type="text" value="<?php echo $linhas['conta'] ?>" style="text-align:right; width:95px;"/><br/>

Convênio<br/>
<input name="convenio" type="text" size="10" value="<?php echo $linhas['convenio'] ?>" style="text-align:right; width:95px;" />
<br/>

<div id="fatura">ESPECIE DE DOCUMENTO - (Se informe no banco qual usar)</div>

<table width="691" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="282" align="left"><input name="especie" type="radio" value="01" <?php if($linhas['especie'] == '01'){echo 'checked';}?>>
&nbsp;01 - DUPLICATA MERCANTIL </td>
    <td width="409" align="left"><input name="especie" type="radio" value="12" <?php if($linhas['especie'] == '12'){echo 'checked';}?>>
&nbsp;12 - DUPLICATA DE SERVIÇOS</td>
  </tr>
  <tr>
    <td align="left"><input name="especie" type="radio" value="02" <?php if($linhas['especie'] == '02'){echo 'checked';}?>>
&nbsp;02 - NOTA PROMISSÓRIA </td>
    <td align="left"><input name="especie" type="radio" value="13" <?php if($linhas['especie'] == '13'){echo 'checked';}?>>
&nbsp;13 - NOTA DE DÉBITO</td>
  </tr>
  <tr>
    <td align="left">
      <input name="especie" type="radio" value="03" <?php if($linhas['especie'] == '03'){echo 'checked';}?>>
&nbsp;03 - NOTA DE SEGURO </td>
    <td align="left"><input name="especie" type="radio" value="15" <?php if($linhas['especie'] == '15'){echo 'checked';}?>>
&nbsp;15 - APÓLICE DE SEGURO</td>
  </tr>
  <tr>
    <td align="left"><input name="especie" type="radio" value="05" <?php if($linhas['especie'] == '05'){echo 'checked';}?>>
&nbsp;05 - RECIBO </td>
    <td align="left"><input name="especie" type="radio" value="25" <?php if($linhas['especie'] == '25'){echo 'checked';}?>>
&nbsp;25 - DÍVIDA ATIVA DA UNIÃO</td>
  </tr>
  <tr>
    <td align="left"><input name="especie" type="radio" value="08" <?php if($linhas['especie'] == '08'){echo 'checked';}?>>
&nbsp;08 - LETRA DE CÂMBIO</td>
    <td align="left"><input name="especie" type="radio" value="26" <?php if($linhas['especie'] == '26'){echo 'checked';}?>>
&nbsp;26 - DÍVIDA ATIVA DO ESTADO </td>
  </tr>
  <tr>
    <td align="left"><input name="especie" type="radio" value="09" <?php if($linhas['especie'] == '09'){echo 'checked';}?>>
&nbsp;09 - WARRANT</td>
    <td align="left"><input name="especie" type="radio" value="27" <?php if($linhas['especie'] == '27'){echo 'checked';}?>>
&nbsp;27 - DÍVIDA ATIVA DO MUNICÍPIO </td>
  </tr>
  <tr>
    <td align="left"><input type="radio" name="especie" id="radio" value="10" <?php if($linhas['especie'] == '10'){echo 'checked';}?>> 
      10 - CHEQUE</td>
    <td align="left">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="left"><br/>
    <div class="controlsa">
<button type="submit" class="btn btn-success ewButton" name="bancosgr" id="btnsubmit" >
<i class="icon-thumbs-up icon-white"></i> Atualizar dados bancários</button>
</div>
    </td>
    </tr>
</table>
</form>



</div></div></div>	















<?php
}else{
?>


<div id="forms">
<strong>Banco Ativo</strong>
<div id="img-banco"><img src="img/<?php echo $linhas['img'] ?>" width="80" height="61"></div>

<form action="" method="post" name="form">
<br/>
Carteira:<br/>
<input name="carteira" type="text" value="<?php echo $linhas['carteira'] ?>" style="text-align:right; width:95px;"/>

<br/>
Agência - dígito:<br/>
<input name="agencia" type="text" size="10"  value="<?php echo $linhas['agencia'] ?>" style="text-align:right; width:50px;"/> - 
<input name="digito_ag" type="text" size="3" value="<?php echo $linhas['digito_ag'] ?>" style="text-align:right; width:20px;"/><br/>

Conta cedente - dígito:<br/>
<input name="conta" type="text" size="10" value="<?php echo $linhas['conta'] ?>" style="text-align:right; width:69px;" /> - 
<input name="digito_co" type="text" size="3" value="<?php echo $linhas['digito_co'] ?>" style="text-align:right; width:20px;"/>
<br/>

<div id="fatura">Obs: Alguns bancos não utilizam os campos abaixo. Caso o banco não utilize o campo, deixar em branco.</div>
Tipo de Carteira:<br/>

<input name="tipo_carteira" type="text" size="5" value="<?php echo $linhas['tipo_carteira'] ?>"
style="text-align:right; width:60px;"/> 
ex: SR (Sem Registro) ou CR (Com Registro)<br/>

Convênio ou Código do Cedente:<br/>
<input name="convenio" type="text" size="10" value="<?php echo $linhas['convenio'] ?>" style="text-align:right; width:100px;"/><br/>

Contrato:<br/>
<input name="bancosgr" type="hidden" value="bancosgr">
<input name="id_banco" type="hidden" value="<?php echo $linhas['id_banco']; ?>">
<input name="contrato" type="text" size="10" value="<?php echo $linhas['contrato'] ?>" style="text-align:right; width:100px;"/><br/>

<div class="control-groupa">
<div class="controlsa">
<button type="submit" class="btn btn-success ewButton" name="bancosgr" id="btnsubmit" >
<i class="icon-thumbs-up icon-white"></i> Atualizar dados bancários</button>
</div></div>
</form>
</div></div></div>
<?php } ?>