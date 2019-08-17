<?php 

use Sql;
use Model;

class Mensalidade extends Model{

	public function testaClasse()
	{
		return 'Aqui funcionou!';
	}

	/////////// MÉTODOS
	
	//Seta todos os dados nos atributos
	public function setDados($dados){
			$this->setid_Mensalidade ($dados['id_mensalidade']);
			$this->setId_Cliente ($dados['id_cliente']);
			$this->setAno ($dados['ano']);
			$this->setMes ($dados['mes']);
			$this->setSituacao ($dados['situacao']);
			$this->setData_Pagamento ($dados['data_pagamento']);
			$this->setN_Fatura ($dados['n_fatura']);
			$this->setQuem_Recebeu ($dados['quem_recebeu']);
			$this->setN_Recibo ($dados['n_recibo']);
			$this->setValor_Pago ($dados['valor_pago']);
	}

	//Carrega mensalidade ESTATICO
	public static function selecionaMensalidade($id_cliente, $ano, $mes){

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM ref_mensalidade WHERE id_cliente = :ID AND ano = :ANO AND mes = :MES", array(
			":ID"=>$id_cliente,
			":ANO"=>$ano,
			":MES"=>$mes
		));

		if (count($results) > 0){
			return $results;
//			$this->setDados($results[0]);
		} else { return "retornou vazio";}
	}

	///// CARREGA UMA MENSALIDADE
	public function selecionaMensalidades($id_cliente, $ano, $mes){

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM ref_mensalidade WHERE id_cliente = :ID AND ano = :ANO AND mes = :MES", array(
			":ID"=>$id_cliente,
			":ANO"=>$ano,
			":MES"=>$mes
		));

		if (count($results) > 0){
			$this->setDados($results[0]);
		} else {

			throw new Exception("Não retornou nenhum registro!");
		}
	}
	///////// RETORNA A SITUACAO EM TEXTO
	public static function converteSituacao($situacao){
		
		if($situacao == '0')
			return 'Não Pago';
		else if($situacao =='1')
			return 'Pago';
		else if($situacao =='2')
			return 'Atraso';
		else if($situacao =='3')
			return 'Pré';
		else if($situacao =='4')
			return 'Isento';
		else if($situacao =='5')
			return 'Abonado';
		else
			return 'Não foi possível reconhecer a situação';
	}
	
	///////// RETORNA A SITUACAO EM NUMERO
	public static function converteSituacaoNumero($situacao){
		
		if($situacao == 'Não Pago')
			return '0';
		else if($situacao =='Pago')
			return '1';
		else if($situacao =='Atraso')
			return '2';
		else if($situacao =='Pré')
			return '3';
		else if($situacao =='Isento')
			return '4';
		else if($situacao =='Abonado')
			return '5';
		else
			return 'Não foi possível reconhecer a situação';
	}
	
	public static function ultimaMensalidade($id_cliente){
		
		return 'funcionou!';
	
	}
///////PAGA UMA MENSALIDADE
	public function pagarMensalidade(){
		
	}
	//////////ESTORNA UMA MENSALIDADE
	public function estornarMensalidade(){
	
	}
	/////  ESTORNAR MENSALIDADE POR INTERVALO / ANO
	public function estornarIntervaloMensalidade(){
		
	}
	
	//////////GERA UMA MENSALIDADE
	public function gerarMensalidade(){
	
	}
	///////// GERA MENSALIDADE POR INTERVALO
	public function gerarIntervaloMensalidade(){
	
	}
	///////  ATUALIZA UMA MENSALIDADE
	public function updateMensalidade(){
		
	}
	
	
	//Carregar usuario pelo login e senha
	public function loginUsuario($email, $senha){

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM usuarios WHERE email = :EMAIL AND senha = :SENHA", array(
			":EMAIL"=>$email,
			":SENHA"=>$senha
		));

		if (count($results) > 0){
			$this->setDados($results[0]);
		} else {

			throw new Exception("E-mail e/ou senha inválidos!");
		}
	}

	//carregar todos os usuarios
	public static function carregarTodos(){

		$sql = new Sql();

		return $sql->select("SELECT * FROM ref_mensalidade LIMIT 100");
	}

	//Carregar usuario pelo nome
	public static function carregarPeloNome($nome){

		$sql = new Sql();

		return $sql->select("SELECT * FROM usuarios WHERE nome LIKE :NOME ORDER BY id_usuario;", array(
			':NOME' => "%".$nome."%"	
		));
	}

	public function inserir(){

		$sql = new Sql();

		$results = $sql->query("INSERT INTO usuarios (nome, funcao, email, senha) VALUES (:NOME,:FUNCAO, :EMAIL, :SENHA)", array(
			':NOME'		=>$this->getNome(),
			':FUNCAO'	=>$this->getfuncao(),
			':EMAIL'	=>$this->getEmail(),
			':SENHA'	=>$this->getSenha()
		));

		
	}

	//retorna um json automaticamente
	public function __toString(){

		return json_encode(array(
			"id_mensalidade"	=>	$this->getid_Mensalidade,
			"id_cliente"		=>	$this->getId_Cliente,
			"ano"				=>	$this->getAno,
			"mes"				=>	$this->getMes,
			"situacao"			=>	$this->getSituacao,
			"data_pagamento"	=>	$this->getData_Pagamento,
			"n_fatura"			=>	$this->getN_Fatura,
			"quem_recebeu"		=>	$this->getQuem_Recebeu,
			"n_recibo"			=>	$this->getN_Recibo,
			"valor_pago"		=>	$this->getValor_Pago
			
		));
	}

}

 ?>