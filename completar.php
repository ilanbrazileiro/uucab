<?
include "classes/conexao.php";

$q=strtolower ($_GET["q"]);

$sql = "SELECT * FROM cliente WHERE email like '%" . $q . "%' OR dir_culto like '%" . $q . "%' ";

$query = mysql_query($sql);// or die ("Erro". mysql_query());

while($reg=mysql_fetch_array($query)){

	//if (srtpos(strtolower($reg['nom_lista']),$q !== false){
		echo $reg["dir_culto"]."(".$reg["email"].")\n";
//	}
}
?>