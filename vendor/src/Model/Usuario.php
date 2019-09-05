<?php 

namespace Uucab\Model;

use \Uucab\DB\Sql;
use \Uucab\Model;
//use \Hcode\Mailer;

class Usuario extends Model {

	const SESSION = "Usuario";

	// Retorna verdadeiro se o usuário for o administrador 1 (Root)
	public function verificaAdm($id_usuario){

		if ($id_usuario == 1){
			return true;
		} else {
			return false;
		}

	}
	//Retorna todos os usuários, Sem excessões!
	function listarTodos(){

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM usuario");

		return (array)$results;

	}

	//Adiciona um usuário no banco
	//Retorna o ultimo adicionado se tudo ok, Senão retorna o erro!
	function adicionar($data){
		
		$sql = new Sql();

		//tratando os dados para inserir no banco
		$data['nome'] = addslashes($data['nome']);

		$data['senha'] = $this->getPasswordHash($data['senha']);

		//insere no banco
		$result = $sql->query("INSERT INTO `usuario` (
			`nome`,
			`login`,
			`senha`,
			`hash`,
			`sha1`,
			`imagem`,
			`funcao`,
			`situacao`,
			`email`
		) VALUES (
		'".$data['nome']."',
		'".$data['login']."', 
		'".$data['senha']."', 
		'".$data['senha']."', 
		'".$data['nome']."', 
		'".$data['imagem']."', 
		'".$data['funcao']."', 
		'".$data['situacao']."', 
		'".$data['email']."'
		)");

		if ($result){
			//busca o ultimo adicionado
			$novo_usuario = $sql->select("SELECT * FROM usuario WHERE id_usuario = LAST_INSERT_ID()");
			//retorna ultimo adicionado
			return (array)$novo_usuario;

		} else {
			return $result;
		}
	}

	//Retorna o Usuario pelo ID
	function get($id_usuario){
		
		$sql = new Sql();

		$results = $sql->select("SELECT * FROM usuario WHERE id_usuario = :id_usuario",[
			':id_usuario' => $id_usuario
		]);

		return (array)$results[0];
	}

	function editar($dados){

		//tratando os dados para inserir no banco
		$dados['nome'] = addslashes($dados['nome']);

		$sql = new Sql();

		$results = $sql->query("UPDATE `uucab_boletos`.`usuario`
				SET
				`nome` = :nome,
				`login` = :login,
				`imagem` = :imagem,
				`funcao` = :funcao,
				`situacao` = :situacao,
				`email` = :email				
				WHERE `id_usuario` = :id_usuario",
			[	
				':id_usuario' 	=> $dados['id_usuario'],
				':nome'			=> $dados['nome'],
				':login'		=> $dados['login'],
				':imagem'		=> $dados['imagem'],
				':funcao'		=> $dados['funcao'],
				':situacao'		=> $dados['situacao'],
				':email'		=> $dados['email']
			]);

		return $results;
	}

	function deletar($dados){

		$sql = new Sql();

		$results = $sql->query("DELETE FROM usuario WHERE id_usuario = '".$dados['id']."'");

		return $results;
		
	}

	public static function getPasswordHash($password)
	{

		return password_hash($password, PASSWORD_DEFAULT, [
			'cost'=>12
		]);
	}

	public static function login($login, $password)//Loga Usuario na sessão
	{

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM usuario WHERE email = :EMAIL OR login = :LOGIN", array(
			":EMAIL"=>$login,
			":LOGIN"=>$login
		)); 

		if (count($results) === 0)//Se existe o usuário
		{
			return false;
			//throw new \Exception("Usuário inexistente.");
		} else {
			
			$data = $results[0]; //Pega o resultado do select

			if (password_verify($password, $data["senha"]) === true)	//Se senha Igual a digitada
			{
				$user = new Usuario();

				$user->setData($data);

				$_SESSION[Usuario::SESSION] = $user->getValues();

				return true;
			} else {
				return false;
			}//FIM SENHA IGUAL

		}//FIM SE EXISTE USUARIO

	}//FIM DA FUNÇÃO

	public static function logout()//Desloga do admin
	{

		$_SESSION[Usuario::SESSION] = NULL;
		unset($_SESSION['login_session']);
		unset($_SESSION['senha_session']);

	}

	public function getUserImage(){//pega a imagem do usuário pelo login

		$login = $_SESSION['login_session'];

		$sql = new Sql();

		$result = $sql->select("SELECT * FROM usuario WHERE login = :login OR email = :login",
		[
			":login"=>$login
		]);

		if ($result[0]['imagem'] != ''){

			$imagem = $result[0]['imagem'];

		} else {

			$imagem = 'res/img/usuario.jpg';
		}

		return $imagem;

	}

	public function getUserLogin(){//retorna o login de quem está logado

		$login = $_SESSION['login_session'];

		return $login;

	}

	public static function verificaLogin(){//Verifica se o usuário é administrador do sistema

		$login = $_SESSION['login_session'];

		$sql = new Sql();

		$result = $sql->select("SELECT * FROM usuario WHERE login = :login OR email = :login",
		[
			":login"=>$login
		]);

		if ($result[0]['funcao'] == 'Administrador'){
			
			return true;

		} else {

			return false;

		}//FIM DO IF

	}//FIM DA FUNÇÃO

	/*  ################ ARQUIVO ORIGINAL DO USUARIO ####################
	const SESSION = "Usuario";
	const SECRET = "HcodePhp7_Secret";
	const ERROR = "UsuarioError";
	const ERROR_REGISTER = "UsuarioErrorRegister";
	const SUCCESS = "UsuarioSucesss";

	public static function checkLogin()//retorna falso se usuario não logado, senão retorna true
	{

		if (
			!isset($_SESSION[Usuario::SESSION])
			||
			!$_SESSION[Usuario::SESSION]
			||
			!(int)$_SESSION[Usuario::SESSION]["id_usuario"] > 0
		) {
			//Não está logado
			return false;

		} else {

			return true;

		} 
	}
	
	public static function getFromSession()//Retorna o usuario pela SESSÃO
	{

		$user = new Usuario();

		if (isset($_SESSION[Usuario::SESSION]) && (int)$_SESSION[Usuario::SESSION]['id_usuario'] > 0) {

			$user->setData($_SESSION[Usuario::SESSION]);

		}

		return $user;

	}

	public static function login($login, $password)//Loga Usuario na sessão
	{

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM usuario WHERE email = :EMAIL", array(
			":EMAIL"=>$login
		)); 

		if (count($results) === 0)
		{
			throw new \Exception("Usuário inexistente.");
		}

		$data = $results[0];

		if (password_verify($password, $data["senha"]) === true)
		{

			$user = new Usuario();

			$user->setData($data);

			$_SESSION[Usuario::SESSION] = $user->getValues();

			return $user;

		} else {
			throw new \Exception("Senha inválida.");
		}

	}

	public static function verifyLogin($inadmin = true)//Verifica se Usuario é Administrador (Descontinuado...)
	{

		if (!Usuario::checkLogin($inadmin)) {

			if ($inadmin) {
				header("Location: /admin/login");
			} else {
				header("Location: /login");
			}
			exit;

		}

	}

	public static function logout()//Desloga do admin
	{

		$_SESSION[Usuario::SESSION] = NULL;

	}
	
	public static function listAll()//retorna um objeto com todos os usuarios
	{

		$sql = new Sql();

		return $sql->select("SELECT * FROM usuario ORDER BY matricula");

	}
	
	public static function getPasswordHash($password)
	{

		return password_hash($password, PASSWORD_DEFAULT, [
			'cost'=>12
		]);
	}
	
	public function save()//Cadastra o usuario e retorna o usuario
	{

		$sql = new Sql();

		$results = $sql->select("CALL salvar_usuario(:nome, :login, :senha, :email, :telefone, :funcao, :situacao, :matricula)", array(
			":nome"=>utf8_decode($this->getnome()),
			":login"=>$this->getlogin(),
			":senha"=>Usuario::getPasswordHash($this->getsenha()),
			":email"=>$this->getemail(),
			":telefone"=>$this->gettelefone(), 
			":funcao"=>$this->getfuncao(),
			":situacao"=>$this->getsituacao(),
			":matricula"=>$this->getmatricula()
		));

		$this->setData($results[0]);

	}

	public function get($iduser)//Seta o usuario pelo ID
	{

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM usuario WHERE id_usuario = :id_usuario", array(
			":id_usuario"=>$iduser
		));

		$data = $results[0];

		$this->setData($data);

	}

	public function update()
	{

		$sql = new Sql();

		$results = $sql->select("CALL update_usuario(:id_usuario, :nome, :login, :email, :telefone, :funcao, :situacao)", array(
			":id_usuario"=>(int)$this->getid_usuario(),
			":nome"=>utf8_decode($this->getnome()),
			":login"=>$this->getlogin(),
			":email"=>$this->getemail(),
			":telefone"=>$this->gettelefone(),
			":funcao"=>$this->getfuncao(),
			":situacao"=>$this->getsituacao()
		));

		$this->setData($results[0]);
	}


	public function delete()//deleta o usuario
	{

		$sql = new Sql();

		$sql->query("CALL deletar_usuario(:iduser)", array(
			":iduser"=>$this->getid_usuario()
		));

	}
	
	public static function getForgot($email, $inadmin = true)
	{

		$sql = new Sql();

		$results = $sql->select("
			SELECT *
			FROM tb_persons a
			INNER JOIN tb_users b USING(idperson)
			WHERE a.desemail = :email;
		", array(
			":email"=>$email
		));

		if (count($results) === 0)
		{
			throw new \Exception("Não foi possível recuperar a senha.");
			
		}
		else
		{

			$data = $results[0];

			$results2 = $sql->select("CALL sp_userspasswordsrecoveries_create(:iduser, :desip)", array(
				":iduser"=>$data["iduser"],
				":desip"=>$_SERVER["REMOTE_ADDR"]
			));

			if (count($results2) === 0)
			{

				throw new \Exception("Não foi possível recuperar a senha");

			}
			else
			{

				$dataRecovery = $results2[0];

				$code = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, Usuario::SECRET, $dataRecovery["idrecovery"], MCRYPT_MODE_ECB));

				if ($inadmin === true) {
					
					$link = "http://www.hcodecommerce.com.br/admin/forgot/reset?code=$code";

				} else {

					$link = "http://www.hcodecommerce.com.br/forgot/reset?code=$code";

				}


				$mailer = new Mailer($data["desemail"], $data["desperson"], "Redefinir Senha da Hcode Store", "forgot", array(
					"name"=>$data["desperson"],
					"link"=>$link
				));

				$mailer->send();

				return $data;

			}


		}

	}

	public static function validForgotDecrypt($code)
	{

		$idrecovery = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, Usuario::SECRET, base64_decode($code), MCRYPT_MODE_ECB);

		$sql = new Sql();

		$results = $sql->select("
			SELECT * 
			FROM tb_userspasswordsrecoveries a
			INNER JOIN tb_users b USING(iduser)
			INNER JOIN tb_persons c USING(idperson)
			WHERE 
				a.idrecovery = :idrecovery
			    AND
			    a.dtrecovery IS NULL
			    AND
			    DATE_ADD(a.dtregister, INTERVAL 1 HOUR) >= NOW();
		", array(
			":idrecovery"=>$idrecovery
		));

		if (count($results) === 0)
		{
			throw new \Exception("Não foi possível recuperar a senha.");
		}
		else
		{

			return $results[0];

		}

	}

	public static function setFogotUsed($idrecovery)
	{

		$sql = new Sql();

		$sql->query("UPDATE tb_userspasswordsrecoveries SET dtrecovery = NOW() WHERE idrecovery = :idrecovery", array(
			":idrecovery"=>$idrecovery
		));

	}

	public function setPassword($password)
	{

		$sql = new Sql();

		$sql->query("UPDATE usuario SET senha = :password WHERE id_usuario = :iduser", array(
			":password"=>$password,
			":iduser"=>$this->getid_usuario()
		));

	}

	public static function setError($msg)
	{

		$_SESSION[Usuario::ERROR] = $msg;

	}

	public static function getError()
	{

		$msg = (isset($_SESSION[Usuario::ERROR]) && $_SESSION[Usuario::ERROR]) ? $_SESSION[Usuario::ERROR] : '';

		Usuario::clearError();

		return $msg;

	}

	public static function clearError()
	{

		$_SESSION[Usuario::ERROR] = NULL;

	}

	public static function setSuccess($msg)
	{

		$_SESSION[Usuario::SUCCESS] = $msg;

	}

	public static function getSuccess()
	{

		$msg = (isset($_SESSION[Usuario::SUCCESS]) && $_SESSION[Usuario::SUCCESS]) ? $_SESSION[Usuario::SUCCESS] : '';

		Usuario::clearSuccess();

		return $msg;

	}

	public static function clearSuccess()
	{

		$_SESSION[Usuario::SUCCESS] = NULL;

	}

	public static function setErrorRegister($msg)
	{

		$_SESSION[Usuario::ERROR_REGISTER] = $msg;

	}

	public static function getErrorRegister()
	{

		$msg = (isset($_SESSION[Usuario::ERROR_REGISTER]) && $_SESSION[Usuario::ERROR_REGISTER]) ? $_SESSION[Usuario::ERROR_REGISTER] : '';

		Usuario::clearErrorRegister();

		return $msg;

	}

	public static function clearErrorRegister()
	{

		$_SESSION[Usuario::ERROR_REGISTER] = NULL;

	}

	public static function checkLoginExist($login)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM usuario WHERE login = :deslogin", [
			':deslogin'=>$login
		]);

		return (count($results) > 0);

	}

	public static function getPage($page = 1, $itemsPerPage = 10)
	{

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
			FROM usuario 
			ORDER BY matricula
			LIMIT $start, $itemsPerPage;
		");

		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

		return [
			'data'=>$results,
			'total'=>(int)$resultTotal[0]["nrtotal"],
			'pages'=>ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
		];

	}

	public static function getPageSearch($search, $page = 1, $itemsPerPage = 10)
	{

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
			FROM usuario
			WHERE email LIKE :search OR login = :search OR matricula = :search
			ORDER BY matricula
			LIMIT $start, $itemsPerPage;
		", [
			':search'=>'%'.$search.'%'
		]);

		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

		return [
			'data'=>$results,
			'total'=>(int)$resultTotal[0]["nrtotal"],
			'pages'=>ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
		];
	}
	
	public static function getProximaMatricula()// RETORNA UMA SUGESTÃO DE PROXIMA MATRICULA PARA O USUARIO
	{
		$sql = new Sql();
		$result = $sql->select("SELECT id_usuario FROM usuario ORDER BY id_usuario DESC LIMIT 1");
		$matricula = 'LV';
		$matricula .= ($result[0]['id_usuario'] + 1);
		return $matricula;
	}

	####### FUNÇÔES DA FOTO #######
	public function checkPhoto()
	{
		if (file_exists(
			$_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 
			"res" . DIRECTORY_SEPARATOR . 
			"admin" . DIRECTORY_SEPARATOR . 
			"img" . DIRECTORY_SEPARATOR . 
			"usuarios" . DIRECTORY_SEPARATOR . 
			$this->getid_usuario() . ".jpg"
			)) {
			$url = "/res/admin/img/usuarios/" . $this->getid_usuario() . ".jpg";
		} else {
			$url = "/res/site/img/usuario.jpg";
		}
		return $this->setimagem($url);
	}
	public function getValues()
	{
		$this->checkPhoto();
		$values = parent::getValues();
		return $values;
	}
	public function setPhoto($file)
	{
		$extension = explode('.', $file['name']);
		$extension = end($extension);
		switch ($extension) {
			case "jpg":
			case "jpeg":
			$image = imagecreatefromjpeg($file["tmp_name"]);
			break;
			case "gif":
			$image = imagecreatefromgif($file["tmp_name"]);
			break;
			case "png":
			$image = imagecreatefrompng($file["tmp_name"]);
			break;
		}
		$dist = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 
			"res" . DIRECTORY_SEPARATOR . 
			"admin" . DIRECTORY_SEPARATOR . 
			"img" . DIRECTORY_SEPARATOR . 
			"usuarios" . DIRECTORY_SEPARATOR . 
			$this->getid_usuario() . ".jpg";
		imagejpeg($image, $dist);
		imagedestroy($image);
		$this->checkPhoto();
	}

	######## FIM DAS FUNÇÕES DA FOTO ##########




	*/

}

?>