<?php 

/// abre a sessao

session_start(); 

include "../classes/conexao.php";

/// pega o valor vindo do campo login

$login = $_POST['cpfcnpj']; 

/// pega o valor vindo do campo senha

$senha = $_POST['senha'];



if (strlen($login) < 14){

	$parte1 = substr($login, 0, 3);
	$parte2 = substr($login, 3, 3);
	$parte3 = substr($login, 6, 3);
	$parte4 = substr($login, 9, 2);

	$login = $parte1.'.'.$parte2.'.'.$parte3.'-'.$parte4;

} 

//seleciona a tabela

$sql = mysql_query("SELECT * FROM cliente WHERE cpfcnpj='$login' AND senha='$senha'");
$cont = mysql_num_rows($sql);

// confere se existe no banco
if($cont >= 1){

	// se existir registra a session com o login e senha e vai para a pagina_principal

	$_SESSION['cpfcnpj_session'] = $login;
	$_SESSION['senha_session'] = $senha;

	header("Location:inicio.php?pg=lista");

	// se nao existir destroi a sessao existente e manda a mensagen de erro para a pagina do form

}else{

	unset($_SESSION['cpfcnpj_session']);
	unset($_SESSION['senha_session']);
	header("location:index.php?login_errado=erro");

}
?>