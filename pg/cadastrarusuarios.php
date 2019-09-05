<?php 
	
use Uucab\Model\Usuario;

///////////CADASTRAR
if (isset($_POST['cadastrar']) && $_POST['login'] != ''){
	
	$usuario = new Usuario();
	
	if ($usuario->adicionar($_POST) > 0){

		$mensagem = "Cadastrado com sucesso!";
		echo (" <script>
       				window.location.href='inicio.php?pg=listarusuarios&msgsucesso=$mensagem';
    		    </script>");
	} else {
		$msgfalha = "Falha no cadastro!";
	}

}

include "views/cadastrarusuarios_tpl.php";
?>