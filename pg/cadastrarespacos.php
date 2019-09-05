<?php 
	
use Uucab\Model\Espacos;

///////////CADASTRAR
if (isset($_POST['cadastrar']) && $_POST['nome'] != ''){
	
	$_POST['valor'] = moedaParaBanco($_POST['valor']);
	$_POST['nome'] = addslashes($_POST['nome']);
	
	$espacos = new Espacos();
	
	if ($espacos->adicionar($_POST) > 0){

		$mensagem = "Cadastrado com sucesso!";
		echo (" <script>
       				window.location.href='inicio.php?pg=listarespacos&msgsucesso=$mensagem';
    		    </script>");
	} else {
		$msgfalha = "Falha no cadastro!";
	}
}

include "views/cadastrarespacos_tpl.php";
?>