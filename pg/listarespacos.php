<?php 
	
use Uucab\Model\Espacos;
use Uucab\Model\Usuario;

$espacos = new Espacos();
$admin = new Usuario();

 if(isset($_GET['msgsucesso']) && $_GET['msgsucesso'] != ''){ $msgsucesso = $_GET['msgsucesso']; }



 //////////////DELETAR ESPAÇOS - Somente ADMINISTRADORES
if (isset($_GET['delete']) && $_GET['delete'] == 'ok'){

/////////////// Verificar se administrador
	$espaco = new Espacos();

	$resultado = $espaco->deletar($_GET);



	if ($resultado){
	
		$msgsucesso = "Cadastro apagado com sucesso!";    
	
	} else {

		$msgfalha = "Ops! A tentativa fracassou...";

	}


}

include "views/listarespacos_tpl.php";
?>