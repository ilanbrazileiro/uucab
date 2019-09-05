<?php 
	
use Uucab\Model\Usuario;

///////////Buscar Usuário
if (isset($_GET['id']) && $_GET['id'] != ''){
	
	$usuarios = new Usuario();

	$usuario = $usuarios->get($_GET['id']);

} else {

	$msgfalha = "Espaço não encontrado!";
}
//////////////EDITAR
if (isset($_POST['editar']) && $_POST['id_usuario'] != ''){

	$usuario_editar = new Usuario();

	$resultado = $usuario_editar->editar($_POST);

	if ($resultado){
		$msgsucesso = "Alterado com sucesso!";

		echo (" <script>
       				window.location.href='inicio.php?pg=listarusuarios&msgsucesso=$mensagem';
    		    </script>");
	}

}


include "views/editarusuario_tpl.php";
?>