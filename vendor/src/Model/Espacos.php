<?php 

namespace Uucab\Model;

use \Uucab\DB\Sql;
use \Uucab\Model;

class Espacos extends Model {
	
	function adicionar($data){
		
		$sql = new Sql();
		//insere no banco
		$sql->query("INSERT INTO `espacos` (
			`nome`, 
			`valor`, 
			`situacao`
		) VALUES (
		'".$data['nome']."', 
		'".$data['valor']."', 
		'".$data['situacao']."'
		)");
		//busca o ultimo adicionado
		$results = $sql->select("SELECT * FROM espacos WHERE id_espaco = LAST_INSERT_ID()");
		//retorna ultimo adicionado
		return (array)$results;
	}

	function editar($dados){

		$sql = new Sql();

		$results = $sql->select("UPDATE `uucab_boletos`.`espacos` SET
								`nome` = :nome,
								`valor` = :valor,
								`situacao` = :situacao
								WHERE `id_espaco` = :id_espaco;",
		[
			':id_espaco' => $dados['id_espaco'],
			':nome' => $dados['nome'],
			':valor' => $dados['valor'],
			':situacao' => $dados['situacao']
		]);

		return $results;
	}

	function listarTodos(){

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM espacos");

		return (array)$results;

	}

	function get($id_espaco){
		
		$sql = new Sql();

		$results = $sql->select("SELECT * FROM espacos WHERE id_espaco = :id_espaco",[
			':id_espaco' => $id_espaco
		]);

		return (array)$results[0];
	}

	function deletar($dados){

		$sql = new Sql();

		$results = $sql->query("DELETE FROM espacos WHERE id_espaco = '".$dados['id']."'");

		return $results;
		
	}
	
	

}

?>