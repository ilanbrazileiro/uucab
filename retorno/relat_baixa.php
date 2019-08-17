<?php include "../classes/conexao.php";
       include "../classes/funcoes.class.php";

	   $dt_geracao = $_GET['data'];

    $b = mysql_query("SELECT * FROM bancos WHERE situacao = '1'") or die(mysql_error());
		$banco = mysql_fetch_array($b);
?>

<!DOCTYPE HTML>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Relatório de faturas baixadas.</title>
<style type="text/css">
body {
        font-family: sans-serif; font-size:11px;
    }

.titulo{
	font-size: 18px;
	font-family:Verdana, Geneva, sans-serif;
	font-weight:bold;
}

th{background:#E6E6E6;}

table.bordasimples {border-collapse: collapse;}
table.bordasimples tr td {border:1px solid #CCC; font-size:10px;}

h2{text-align:center;}

</style>
</head>

<body>

Emitido em: <?php echo date("d/m/Y"); ?><br>

<h2> Relatório de Faturas Baixadas<br>

Extrato de Movimentação Bancária - Consulta Detalhada</h2>

<table width="100%" border="0" cellspacing="0" cellpadding="3" class="bordasimples">

  <tr>
    <th width="6%" align="left" ><strong>Matr</strong></th>
    <th width="35%" align="left" ><strong>Cliente</strong></th>
    <th width="6%" align="left" ><strong>Nº Doc</strong></th>
    <th width="35%" align="left" ><strong>Referência Boleto</strong></th>
    <th width="7%" align="left" ><strong>Agência e Conta</strong></th>
    <th width="7%" align="center" ><strong>Vencimento</strong></th>
    <th width="7%" align="center" ><strong>VLR Boleto</strong></th>
    <? php /*<th width="7%" align="center" ><strong>VLR Recebido</strong></th> */ ?>
    <th width="7%" align="center" ><strong>Data Pagamento</strong></th>
    <th width="7%" align="center" ><strong>Motivo</strong></th>
    <th width="7%" align="center" ><strong>Marcado?</strong></th>
  </tr>

	    <?php 
  $rel = mysql_query("SELECT * FROM financeiro WHERE c_ocorrencia = '06' OR c_ocorrencia = '6' ORDER BY nosso_numero ASC") or die(mysql_error());
  while($result = mysql_fetch_array($rel)){
	  $nosso = $result['nosso_numero'];
	  $pg = mysql_query("SELECT *,date_format(data_venci, '%d/%m/%Y') AS datav FROM faturas WHERE id_venda ='$nosso'");
	  $nomes = mysql_fetch_array($pg); 
	  $mat = getCliente($nomes['id_cliente']);
	  $baixa = getCliente($nomes['id_cliente']);
	  
	  if($nomes['nome'] != ""){
	  ?>

  <tr>

    <td align="left"><?php echo $mat['matricula']; ?></td>
    <td align="left"><?php if( $nomes['nome'] == ""){echo "Fatura inexistente.";}else{ echo $nomes['nome'];} ?></td>
    <td align="left"><?php echo $nomes['id_venda'];?></td>
    <td align="left"><?php echo $nomes['ref'];?></td>
    <td align="center"><?php echo $nomes['banco_receb']."<br>".

	$nomes['conta']."-".$nomes['dv_receb'];?>
    </td>

    <td align="center"><?php echo $nomes['datav'];?></td>
    <td align="right"><?php echo number_format($nomes['valor'],2,',','.');?></td>
   <?php /* <td align="right"><?php echo number_format($result['valor'],2,',','.');?></td> */ ?>
    <td align="center"><i><?php echo exibeData($nomes['dbaixa']);?></i></td>
    
    
    
    <td align="center"><?php echo $nomes['motivo_baixa']; ?></td>
    <td align="center"></td>
  </tr> 

  <?php $total += $result['valor']; ?>

  <?php  } }?>

</table>

Total Recebido: <?php echo number_format($total,2,',','.'); ?><br>

<br><br>

<input type="button" name="imprimir" value="Imprimir" onClick="window.print();">

<?php 

$limpa = mysql_query("TRUNCATE TABLE financeiro");

?>
</body>
</html>