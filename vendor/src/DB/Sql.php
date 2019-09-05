<?php 

namespace Uucab\DB;

class Sql {

	##### CONFIGURAÇÕES DE ACESSO AO BANCO DE DADOS - LOCAL ####
	const HOSTNAME = "localhost";//Servidor do Banco
	const USERNAME = "root"; //Nome de Usuário
	const PASSWORD = ""; //Senha do Usuário
	const DBNAME = "uucab_boletos"; //nome do Banco de Dados

	##### CONFIGURAÇÕES DE ACESSO AO BANCO DE DADOS - WEB ####
	/*
	const HOSTNAME = "localhost";//Servidor do Banco
	const USERNAME = "immtec91_imm"; //Nome de Usuário
	const PASSWORD = "246135"; //Senha do Usuário
	const DBNAME = "immtec91_buraco"; //nome do Banco de Dados
	*/

	private $conn;

	public function __construct()
	{

		$this->conn = new \PDO(
			"mysql:dbname=".Sql::DBNAME.";host=".Sql::HOSTNAME, 
			Sql::USERNAME,
			Sql::PASSWORD
		);
	}



	private function setParams($statement, $parameters = array())
	{

		foreach ($parameters as $key => $value) {
			$this->bindParam($statement, $key, $value);
		}



	}



	private function bindParam($statement, $key, $value)

	{



		$statement->bindParam($key, $value);



	}



	public function query($rawQuery, $params = array())
	{

		$stmt = $this->conn->prepare($rawQuery);

		$this->setParams($stmt, $params);

		$stmt->execute();

		if ($stmt->rowCount() > 0) {

			return true;

		} else {

			return $stmt->errorInfo();
		}
	}

	//public function select($rawQuery, $params = array()):array
	public function select($rawQuery, $params = array())
	{



		$stmt = $this->conn->prepare($rawQuery);



		$this->setParams($stmt, $params);



		if($stmt->execute()){

 		   	return $stmt->fetchAll(\PDO::FETCH_ASSOC);
 		   	
		}else{

    		return $stmt->errorInfo();

		}


	}



}



 ?>