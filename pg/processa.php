<?php 
session_start();
//se nao existir volta para a pagina do form de login
if(!isset($_SESSION['login_session']) and !isset($_SESSION['senha_session'])){
	header("Location:../index.php");
	exit;		
}
?>
<?php 
include "../classes/conexao.php";

include "../classes/funcoes.class.php";

$conecta = new recordset();

	


?>