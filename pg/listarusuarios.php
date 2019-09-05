<?php 
	
use Uucab\Model\Usuario;

$usuario = new Usuario();

if(isset($_GET['msgsucesso']) && $_GET['msgsucesso'] != ''){ $msgsucesso = $_GET['msgsucesso']; }


//////////////DELETAR Usuarios - Somente ADMINISTRADORES
if (isset($_GET['delete']) && $_GET['delete'] == 'ok'){

/////////////// Verificar se administrador
	$usuario = new Usuario();

	$resultado = $usuario->deletar($_GET);

	if ($resultado){
	
		$msgsucesso = "Cadastro apagado com sucesso!";    
	
	} else {

		$msgfalha = "Ops! A tentativa fracassou...";

	}
}

include "views/listarusuarios_tpl.php";
?>