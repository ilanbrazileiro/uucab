<?php 
include "../classes/conexao.php";

function base64url_encode($data) {
			return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
			}

$str = $_SERVER['QUERY_STRING'];
$string = base64_decode($str);
$array = explode('&', $string);
foreach($array as $valores){
	$valores;
	$arrays = explode('=', $valores);
		foreach($arrays as $val){
		$dado[] = $val;
		}
}

$url = mysql_query("SELECT * FROM bancos WHERE situacao='1'");
$lista = mysql_fetch_array($url);
	$links = $lista['link'];
	$banco = $links."?".$dado[0]."=".$dado[1];

$u = $_SERVER["REQUEST_URI"];
$h = $_SERVER["HTTP_HOST"];

$destino = "http://". $_SERVER["HTTP_HOST"] . "/boletos/boleto/" . $banco;

?>
<script language= "JavaScript">
location.href="<?php echo $destino ?>"
</script>