<?php 
session_start();
//se nao existir volta para a pagina do form de login
if(!isset($_SESSION['login_session']) and !isset($_SESSION['senha_session'])){
	header("Location:../index.php");
	exit;		
}

if (isset($_POST['id_venda'])){
$ids = $_POST['id_venda'];
}
if (isset($_GET['id_venda'])){
$id = $_GET['id_venda'];
}

if(isset($_POST['baixar'])){
	
	$ids = $_POST['ids'];
	$data = date("Y-m-d");
	$valor_recebido = $_POST['valor_recebido'];
	$banco_receb = "BAIXA MANUAL";
	$motivo = $_POST['motivo'];
	$ref = $_POST['ref'];
	
	if ($motivo == 2){//CANCELAR BOELTOS
	
		foreach ($ids as $id_venda){
			$SQL = mysql_query("UPDATE faturas SET dbaixa = '$data', valor_recebido = '$valor_recebido', situacao ='B', remessa = 0, motivo_baixa = 'Cancelamento do boleto', codigo_operacao = 2 WHERE id_venda = '$id_venda'") or die(mysql_error());
		}
		if ($SQL ==1){
				echo "<script type='text/javascript'>
							alert('Todos os boletos foram baixados com sucesso!');
							window.location='inicio.php?pg=fatbaixada';;
					  </script>";
		}
		
	}//FIM DO MOTIVO 2 (CANCLAR BOLETOS)
	 else if ($motivo == 1) {//PAGAR BOLETOS

			foreach ($ids as $id){
					//BAIXA NA FATURA
					$SQL = mysql_query("UPDATE faturas SET dbaixa = '$data', valor_recebido = '$valor_recebido', situacao ='B', remessa = 0, motivo_baixa = 'Pagamento direto', codigo_operacao = 34 WHERE id_venda = '$id'") or die(mysql_error());
					
					//BAIXA NAS MENSALIDADES
					if ($SQL == 1){
						$fatura = getFatura($id); //PEGA A FATURA
						
							if (isset($fatura['ref2']) && !empty($fatura['ref2'])){//SE A FATURA TIVER REFERENCIA
								
									//Preenchendo as variaveis
									$ref2	= $fatura['ref2'];
									$dbaixa	= $data;
									$nm 	= $fatura['id_venda'];
									$valor 	= $valor_recebido;
	 								$id_cliente	= $fatura["id_cliente"];
									if (strlen($ref2) >= 13){
										
											$partes = explode("_", $ref2);
											$i = explode("-", $partes[0]);
											$f = explode("-", $partes[1]);
											
											$mi = $i[0]; $ai = $i[1]; $mf = $f[0]; $af = $f[1];
										
											$qtd_mes = contaMeses ($mi,$ai,$mf,$af);
															
											for ($i=0;$i < $qtd_mes; $i++){
												$mes_verificar = $mi + $i;
												$ano_verificar = $ai;
												
												if ($mes_verificar > 12 && $mes_verificar <= 24){
													$mes_verificar = $mes_verificar - 12;
													$ano_verificar = $ano_verificar + 1;
													
													$sql1 = mysql_query("UPDATE `ref_mensalidade` SET situacao='1', n_fatura = '$nm', data_pagamento = '$dbaixa', quem_recebeu = 'EMPRESA', n_recibo = '$nm', valor_pago = '$valor' WHERE (id_cliente = '$id_cliente' AND mes = '$mes_verificar' AND ano = '$ano_verificar')")or die (mysql_error());
													$mes_verificar = getMesAbr($mes_verificar);
													$sql2 = mysql_query("UPDATE `mensalidades` SET ".$mes_verificar."='1' WHERE id_cliente = '$id_cliente' AND ano = '$ano_verificar'")or die (mysql_error());
																		
												} else if ($mes_verificar > 24){
													$mes_verificar = $mes_verificar - 24;
													$ano_verificar = $ano_verificar + 2;
													
													$sql1 = mysql_query("UPDATE `ref_mensalidade` SET situacao='1', n_fatura = '$nm', data_pagamento = '$dbaixa', quem_recebeu = 'EMPRESA', n_recibo = '$nm', valor_pago = '$valor' WHERE (id_cliente = '$id_cliente' AND mes = '$mes_verificar' AND ano = '$ano_verificar')")or die (mysql_error());
													$mes_verificar = getMesAbr($mes_verificar);
													$sql2 = mysql_query("UPDATE `mensalidades` SET ".$mes_verificar."='1' WHERE id_cliente = '$id_cliente' AND ano = '$ano_verificar'")or die (mysql_error());					
													} else {
													$sql1 = mysql_query("UPDATE `ref_mensalidade` SET situacao='1', n_fatura = '$nm', data_pagamento = '$dbaixa', quem_recebeu = 'EMPRESA', n_recibo = '$nm', valor_pago = '$valor' WHERE (id_cliente = '$id_cliente' AND mes = '$mes_verificar' AND ano = '$ano_verificar')")or die (mysql_error());
													$mes_verificar = getMesAbr($mes_verificar);
													$sql2 = mysql_query("UPDATE `mensalidades` SET ".$mes_verificar."='1' WHERE id_cliente = '$id_cliente' AND ano = '$ano_verificar'")or die (mysql_error());
													}
											}//FECHA FOR
								
										} else {//MENOR QUE 13
											  $id_cliente	= $fatura["id_cliente"];
			 								  $partes = explode("-", $ref2);
												$mes = $partes[0];
												$ano = $partes[1];
														
												$sql1 = mysql_query("UPDATE `ref_mensalidade` SET situacao='1', n_fatura = '$id', data_pagamento = '$dbaixa', quem_recebeu = 'EMPRESA', n_recibo = '$id', valor_pago = '$valor' WHERE (id_cliente = '$id_cliente' AND mes = '$mes' AND ano = '$ano')")or die (mysql_error());
												$mesa = getMesAbr($mes);
												$sql2 = mysql_query("UPDATE `mensalidades` SET ".$mesa."='1' WHERE (id_cliente = '$id_cliente' AND ano = '$ano')")or die (mysql_error());
										}//FIM DA BAIXA COM REFERENCIA
							}//FIM DO TESTE DA REFERENCIA
					}//FIM DO SQL == 1
			}//FIM DO FOREACH DOS IDS

			if ($SQL ==1){
				echo "<script type='text/javascript'>
							alert('Todos os boletos foram baixados com sucesso!');
							window.location='inicio.php?pg=fatbaixada';
					  </script>";
			}
			
	}//FIM MOTIVO 1 (PAGAMENTO DOS BOLETOS)
}//FIM DO BAIXAR
?>
<script src="js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="js/jquery.mask-money.js"></script>
<script type="text/javascript" src="js/jquery.maskedinput.js"></script>
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

<div id="entrada">
<div id="cabecalho">
  <h2><i class="icon-cloud-download iconmd"></i> Baixar faturas</h2></div>
<div id="forms" style="display:table;padding-bottom:5px;">
	<form action="" method="post" name="form" id="form" enctype="multipart/form-data">
   <?php
    foreach($ids as $key => $id_venda){	
		$fatura = getFatura($id_venda);
		
	?>
    <input type="hidden" name="ids[]" value="<?php echo $fatura['id_venda'] ?>" />
    <div style="float:left;width:360px;margin:10px;">
        <ul>
            <li><strong>Cliente:</strong> <?php echo $fatura['nome']; ?></li>
            <li><strong>Documento:</strong> <?php echo $fatura['id_venda']; ?></li>
            <li><strong>Vencimento:</strong> <?php echo exibeData($fatura['data_venci']); ?></li>
            <li><strong>Valor da fatura:</strong> <?php echo $fatura['valor']; ?></li>
            <li><strong>Referência::</strong> <?php echo $fatura['ref']; ?></li>
       </ul>
   </div>
   <?php } ?>
</div>   
    <br/>
    <hr>
<div id="forms">   
    <div class="coluna" style="width:300px;"><strong>Motivo da Baixa:</strong><br/>
    <input name="motivo" type="radio" value="1"> Pagamento &nbsp;|&nbsp;
    <input name="motivo" type="radio" value="2"> Cancelar Boleto
    </div>
    <br/><br/>
    <strong>Valor recebido:</strong><br/>
    <div class="input-prepend">
    <span class="add-on"><i class="icon-money"></i></span>
    <input name="valor_recebido" type="text" id="valor" style="text-align:right; width:60px;">
    <br/>
    </div><br/>
<br/>
    <div class="control-groupa">
    <div class="controlsa">
    
    <input name="baixar" type="hidden" value="baixar">
    
    <button type="submit" class="btn btn-success ewButton" name="editar">
    <i class="icon-thumbs-up icon-white"></i> Baixar</button>
    <input class="btn btn-danger ewButton" name="Cancelar" onclick="javascript:history.back()" value="Voltar" style="width:60px;">
    <br>
    <span style="color:#F00; font-style:italic;">Tenha paciência,isso pode levar alguns segundos!</span>
  </div></div>
    </form>
</div>
</div>
