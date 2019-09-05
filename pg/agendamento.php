<?php 
	
use Uucab\Model\Espacos;

$espacos = new Espacos();

$lista = $espacos->listarTodos();




include "views/agendamento_tpl.php";
?>