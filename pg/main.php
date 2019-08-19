<?php 

use \Uucab\Model\Clientes;
use \Uucab\Model\Faturas;


$cliente = new Clientes();
$faturas = new Faturas();

$tf = $faturas->totalFaturas();

$percentual_fp = round(($faturas->totalFaturasPagas() * 100)/$tf);

$percentual_fa = round(($faturas->totalFaturasAtraso() * 100)/$tf);

$percentual_faberto = round(($faturas->totalFaturasPendentes() * 100)/$tf);

$percentual_fc = round(($faturas->totalFaturasCanceladas() * 100)/$tf);


include "views/main_tpl.php";
?>