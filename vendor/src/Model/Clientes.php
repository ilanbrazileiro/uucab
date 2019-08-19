<?php 

namespace Uucab\Model;

use \Uucab\DB\Sql;
use \Uucab\Model;

class Clientes extends Model {
	
	public function totalClientes()
	{
		$sql = new Sql();
		$result = $sql->select("SELECT COUNT(*) as total FROM cliente");
		return $result[0]['total'];
	}

	public function totalClientesVivos()
	{
		$sql = new Sql();
		$result = $sql->select("SELECT COUNT(*) as total FROM cliente WHERE situacao = 'V'");
		return $result[0]['total'];
	}

	public function totalClientesMortos()
	{
		$sql = new Sql();
		$result = $sql->select("SELECT COUNT(*) as total FROM cliente WHERE situacao = 'M'");
		return $result[0]['total'];
	}

	public function totalClientesIsentos()
	{
		$sql = new Sql();
		$result = $sql->select("SELECT COUNT(*) as total FROM cliente WHERE situacao = 'I'");
		return $result[0]['total'];
	}

	public function totalClientesAguardar()
	{
		$sql = new Sql();
		$result = $sql->select("SELECT COUNT(*) as total FROM cliente WHERE situacao = 'A'");
		return $result[0]['total'];
	}

}//FIM DA CLASSE
?>