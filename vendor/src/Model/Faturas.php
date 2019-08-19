<?php 

namespace Uucab\Model;

use \Uucab\DB\Sql;
use \Uucab\Model;
//use \Hcode\Mailer;

class Faturas extends Model {
	
	public function totalFaturasPagas(){
		$sql = new Sql();
		$result = $sql->select("SELECT COUNT(*) as total FROM faturas WHERE situacao = 'B' AND motivo_baixa = 'PAGA'");
		return $result[0]['total'];
	}

	public function totalFaturasAtraso(){
		$sql = new Sql();
		$result = $sql->select("SELECT COUNT(*) as total FROM faturas WHERE situacao = 'V'");
		return $result[0]['total'];
	}

	public function totalFaturasPendentes(){
		$sql = new Sql();
		$result = $sql->select("SELECT COUNT(*) as total FROM faturas WHERE situacao = 'P'");
		return $result[0]['total'];
	}

	public function totalFaturasCanceladas(){
		$sql = new Sql();
		$result = $sql->select("SELECT COUNT(*) as total FROM faturas WHERE situacao = 'B' AND (motivo_baixa = 'CANCELADA' OR motivo_baixa = 'Cancelamento do boleto')");
		return $result[0]['total'];
	}

	public function totalFaturas(){
		$sql = new Sql();
		$result = $sql->select("SELECT COUNT(*) as total FROM faturas");
		return $result[0]['total'];
	}


	public function testaclasse()
	{
		return "Agora funcionou e estamos com composer!";
	}




}
?>