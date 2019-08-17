<?php 
include "config_conexao.php";

class Sql extends PDO {

		private $conn;

		public function __construct(){

			try {

				$this->conn = new PDO ("mysql:host=localhost;dbname=uucab_boletos", 'uucab_boletos', 'Uniao#2013');
				//Parametros para conexão com o banco de dados
				//Host = local do banco / dbname = Nome do banco
				//Primeira aspas = Usuario / segunda aspas = Senha
				 $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch(PDOException $e) {
    			echo 'ERROR: ' . $e->getMessage();
			}
		
		}

		private function setParams($statment,$parameters = array()){

			foreach ($parameters as $key => $value) {
				
				$this->setParam($statment, $key, $value);
			}

		}

		private function setParam($statment, $key, $value){

			$statment->bindParam($key, $value);

		}

		public function query($rawQuery, $params = array()){

			$stmt = $this->conn->prepare($rawQuery);

			$this->setParams($stmt, $params);

			$stmt->execute();

			return $stmt;

		}

		public function select($rawQuery,$params = array()){

			$stmt = $this->query($rawQuery, $params);

			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}

 }

 ?>
