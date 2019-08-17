<?php 
include "classes/FuncoesBanco.class.php";

spl_autoload_register(function ($class_name) {

	$caminho1 = 'classes/'.$class_name.'.php';
	$caminho2 = 'classes/Model/'.$class_name.'.php';
	
	if (file_exists($caminho1))	{
        require_once $caminho1;
    } else {
    	require_once $caminho2;
    }

});

?>