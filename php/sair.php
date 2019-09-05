<?php 
// desttroi a sessao
session_start();

///////////INCLUDES
include "../classes/conexao.php";
include "../classes/funcoes.class.php";
include "../php/config.php";
require '../vendor/autoload.php';

use Uucab\Model\Usuario;

$user = new Usuario();

$user->logout();

unset($_SESSION['login_session']);
unset($_SESSION['senha_session']);
header("location:../index.php");
?>
