<?php 
	
use Uucab\Model\Espacos;

///////////CADASTRAR
if (isset($_GET['id']) && $_GET['id'] != ''){
	
	$espacos = new Espacos();

	$espaco = $espacos->get($_GET['id']);

} else {

	$msgfalha = "Espaço não encontrado!";
}
//////////////EDITAR
if (isset($_POST['editar']) && $_POST['id_espaco'] != ''){

	$espaco = new Espacos();

	$_POST['valor'] = moedaParaBanco($_POST['valor']);

	$resultado = $espaco->editar($_POST);

	echo (" <script>
       				window.location.href='inicio.php?pg=listarespacos&msgsucesso=$mensagem';
    		    </script>");
	
}


include "views/editarespaco_tpl.php";
?>