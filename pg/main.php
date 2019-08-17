
<?php 
/////////////CALCULO DO TOTAL DE CADASTROS///////////

$total_cadatros = mysql_query("SELECT COUNT(*) FROM cliente");
while($array = mysql_fetch_array($total_cadatros)) {
// Variável para capturar o campo "nome" no banco de dados
$tc = $array[0];
}
$total_vivo = mysql_query("SELECT COUNT(*) FROM cliente WHERE situacao = 'V'");
while($array = mysql_fetch_array($total_vivo)) {
// Variável para capturar o campo "nome" no banco de dados
$tv = $array[0];
}
$total_morto = mysql_query("SELECT COUNT(*) FROM cliente WHERE situacao = 'M'");
while($array = mysql_fetch_array($total_morto)) {
// Variável para capturar o campo "nome" no banco de dados
$tm = $array[0];
}
$total_aguardar = mysql_query("SELECT COUNT(*) FROM cliente WHERE situacao = 'A'");
while($array = mysql_fetch_array($total_aguardar)) {
// Variável para capturar o campo "nome" no banco de dados
$ta = $array[0];
}
$total_isento = mysql_query("SELECT COUNT(*) FROM cliente WHERE situacao = 'I'");
while($array = mysql_fetch_array($total_isento)) {
// Variável para capturar o campo "nome" no banco de dados
$ti = $array[0];
}

?>

<div id="grafico">
<?php echo $config['recebm'] ?>
<table id="estatistica" width="30%" border="0">
  <tr>
    <td><?php echo $config['Recebidos'] ?></td>
    <td><?php echo $contb; ?></td>
  </tr>
  <tr>
    <td><?php echo $config['Ematrazo'] ?></td>
    <td><?php echo $contv;?></td>
  </tr>
  <tr>
    <td><?php echo $config['Emaberto'] ?></td>
    <td><?php echo $contp ?></td>
  </tr>
  <tr>
    <td><?php echo $config['Cancelada'] ?></td>
   <td><?php echo $contc ?></td>
  </tr>
</table>
<br/>
</div>
<div id="resumo" style="display:table;">
<strong>Resumo de Situação de Clientes:</strong><br/>
<hr><br/>


Total de clientes CADASTRADOS: <?php echo $tc; ?><br /><br>
Total de clientes VIVOS: <?php echo $tv; ?><br />
Total de clientes ISENTOS: <?php echo $ti; ?><br />
Total de clientes MORTOS: <?php echo $tm; ?><br />
Total de clientes AGUARDAR: <?php echo $ta; ?>


</div> 	    

<div style="clear:both"></div>