<?php 

namespace Uucab\Model;

use \Uucab\DB\Sql;
use \Uucab\Model;

class Banco extends Model {
	
	function listarBancos(){

		$sql = new Sql();

		$bancos = $sql->select("SELECT * FROM bancos WHERE id_banco > '3' AND id_banco < '6'");

		return $bancos;


	}
	
	

}

?>