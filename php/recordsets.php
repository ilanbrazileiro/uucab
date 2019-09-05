<?php 
include 'funcoes_itau.php';
require 'classes/class.phpmailer.php';

$mail = new PHPMailer();

function datas($dado){

	$data = explode("/", $dado);
		$dia = $data[0];
		$mes = $data[1];
		$ano = $data[2];
		$resultado = $ano."-".$mes."-".$dia;

	return $resultado;	
}

////////////// arredonda valores /////////////////////////////////

function ceil_dec($number,$precision,$separator)
{

    $numberpart=explode($separator,$number); 
	@$numberpart[1]=substr_replace($numberpart[1],$separator,$precision,0);

    if($numberpart[0]>=0)

	    {$numberpart[1]=ceil($numberpart[1]);}

    else

    	{$numberpart[1]=floor($numberpart[1]);}

	$ceil_number= array($numberpart[0],$numberpart[1]);

    return implode($separator,$ceil_number);
}

/////////////////////// conferir datas //////////////
function data2banco ($d2b) { 

	if(!empty($d2b)){

		$d2b_ano=substr($d2b,6,4);

		$d2b_mes=substr($d2b,3,2);

		$d2b_dia=substr($d2b,0,2);		

		$d2b="$d2b_ano-$d2b_mes-$d2b_dia";

	}

	return $d2b; 

}

/////////// ATIVA DESATIVA BANCOS ///////////////////////////
if(isset($_GET["ativa"]) && $_GET["ativa"] == "ok"){

	$id_banco 	= $_GET['id_banco'];	

	$res = mysql_query("SELECT * FROM bancos WHERE id_banco='$id_banco'");

	$list = mysql_fetch_array($res);

		$link = $list['link'];
		$banco 	= $list['nome_banco'];	
		$tabela = "bancos";
		$valor 	= "1";
		$string = "id_banco = $id_banco";
		$dados 	= array(
					'id_banco' => $_GET['id_banco'],
					'situacao' => $valor
					);

	$zera = mysql_query("UPDATE bancos SET situacao='0'");

		$conecta->alterar($tabela,$dados,$string);
		$endereco = $_SERVER['REQUEST_URI'];
			$link = explode("&",$endereco);
			$reader = $link[0];

	unset($_GET['ativa']);		

	print "
			<META HTTP-EQUIV=REFRESH CONTENT='0; URL=$reader'>
			<script type=\"text/javascript\">
				alert(\"Banco $banco ativado com sucesso.\");
			</script>";
}

///////////////////////////// CONFIGURAÇÕES ///////////////////////////
if(isset($_POST['alterar'])){

	$tabela = "config";

	$string = "id = 1";

	$dados = array(
				'nome'		=>addslashes($_POST['nome']),
				'email'		=>$_POST['email'],
				'cpf'		=>$_POST['cpf'],
				'endereco'  =>$_POST['endereco'],
				'numero'	=>$_POST['numero'],
				'bairro'	=>$_POST['bairro'],
				'cidade'	=>$_POST['cidade'],
				'cep'		=>$_POST['cep'],
				'uf'		=>$_POST['uf']			
				);			

	$conecta->alterar($tabela,$dados,$string);

	print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=?pg=configuracoes'>
		  <script type=\"text/javascript\">
			  alert(\"DADOS ALTERADOS COM SUCESSO!\");
		  </script>";	
}

/////////////////////////////// DADOS INICIAIS ///////////////////////////////////////
$mes_atual = date("m");

$pendATUAL = mysql_query("SELECT * FROM faturas WHERE MONTH(data_venci) = '$mes_atual'")or die (mysql_error());

$data_hoje = date("Y-m-d");

$diar = mysql_query("SELECT COUNT(*) AS registros,SUM(valor) AS total FROM faturas WHERE data_venci ='$data_hoje'")or die (mysql_error());
$valordia = mysql_fetch_array($diar);

$totalhoje = $valordia['total'];
$reg = $valordia['registros'];

$sitp = mysql_query("SELECT * FROM faturas WHERE situacao = 'P'")or die (mysql_error());
$contp = mysql_num_rows($sitp);

$sitv = mysql_query("SELECT * FROM faturas WHERE situacao = 'V'")or die (mysql_error());
$contv = mysql_num_rows($sitv);

$sitb = mysql_query("SELECT * FROM faturas WHERE situacao = 'B' AND motivo_baixa = 'PAGA'")or die (mysql_error());
$contb = mysql_num_rows($sitb);

$sitc = mysql_query("SELECT * FROM faturas WHERE situacao = 'B' AND (motivo_baixa = 'CANCELADA' OR motivo_baixa = 'Cancelamento do boleto')")or die (mysql_error());
$contc = mysql_num_rows($sitc);

///// total do mes ////////////
$resmes = mysql_query("SELECT *,SUM(valor) AS valorm FROM faturas WHERE MONTH(dbaixa) = '$mes_atual'")or die (mysql_error());
$rm = mysql_fetch_array($resmes);

$valorm = $rm['valorm'];

///// baixadas no mes ///////////	
$vrec = mysql_query("SELECT *,SUM(valor_recebido) AS valorr FROM faturas WHERE MONTH(dbaixa) = '$mes_atual' AND situacao = 'B'")or die (mysql_error());
$vr = mysql_fetch_array($vrec);
	$valorr = $vr['valorr'];

//////////// valor vencido do mes ////////////////	
$vv = mysql_query("SELECT *,SUM(valor) AS valorv FROM faturas WHERE situacao = 'V'")or die (mysql_error());
$vrv = mysql_fetch_array($vv);
	$valorv = $vrv['valorv'];

//////////// valor pendente do mes ////////////////	
$vp = mysql_query("SELECT *,SUM(valor) AS valorp FROM faturas WHERE  MONTH(data_venci) = '$mes_atual' AND situacao = 'P'")or die (mysql_error());
$vrp = mysql_fetch_array($vp);
	$valorp = $vrp['valorp'];

//////////////////////////////////// CONFIGURA BANCOS ////////////////////////////////////////////////////////
if(isset($_POST['bancosgr'])){
				   $id_banco 		= $_POST['id_banco'];
				   $carteira		= $_POST['carteira'];
				   $agencia			= $_POST['agencia'];
				   $digito_ag		= $_POST['digito_ag'];
				   $conta			= $_POST['conta'];
				   $digito_co		= $_POST['digito_co'];
				   $especie	        = $_POST['especie'];
				   $convenio		= $_POST['convenio'];
				   $contrato		= $_POST['contrato'];
				   $conta 			= $_POST['conta'];
				   $digito_co		= $_POST['digito_co'];
				   $tipo_carteira	= $_POST['tipo_carteira'];

$conecta = mysql_query("UPDATE bancos 

						SET carteira='$carteira', agencia='$agencia', conta='$conta', digito_co='$digito_co', especie='$especie', convenio='$convenio', contrato='$contrato', conta = '$conta', digito_co='$digito_co' ,tipo_carteira='$tipo_carteira' WHERE id_banco='$id_banco'")or die (mysql_error());

	if($conecta == 1){

	  print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=?pg=banco'>
			<script type=\"text/javascript\">
				alert(\"DADOS ALTERADOS COM SUCESSO!\");
			</script>";	
	}
}

			
/////////////////////////// CONFIGURA BOLETOS /////////////////////////////

if(isset($_POST['confgoleto'])){

	$tabela = "config";

	$string = "id = 1";

	$dados = array(

			'dias'			=> $_POST['dias'],

			'receber'		=> $_POST['receber'],

			'multa_atrazo'	=> $_POST['multa_atrazo'],

			'juro'			=> $_POST['juros'],

			'demo1'			=> $_POST['demo1'],

			'demo2'			=> $_POST['demo2'],

			'demo3'			=> $_POST['demo3'],

			'demo4'			=> $_POST['demo4'],
			
			'demo5'			=> $_POST['demo5'],
			
			'texto_boleto'			=> $_POST['texto_boleto'],
			
			'texto_boleto1'			=> $_POST['texto_boleto1']

	        );



$conecta->alterar($tabela,$dados,$string);

if($conecta){

  print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=?pg=confboleto'>

		<script type=\"text/javascript\">

		alert(\"DADOS ALTERADOS COM SUCESSO!\");

		</script>";	

}

}

$d_boleto = mysql_query("SELECT * FROM config")or die (mysql_error());

$linhas = mysql_fetch_array($d_boleto);



///////////////////////// CONFIGURA SERVIDOR DE EMAIL ////////////////////////



if(isset($_POST['emailgr'])){

			$tabela = "maile";

			$string = "id = 1";

			$dados = array(

					'empresa'		=> $_POST['empresa'],

					'url'			=> $_POST['url'],

					'porta'			=> $_POST['porta'],

					'endereco'		=> $_POST['endereco'],

					'limitemail'	=> $_POST['limitemail'],

					'email'			=> $_POST['email'],

					'senha'			=> $_POST['senha'],

			);



$conecta->alterar($tabela,$dados,$string);

  print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=?pg=confmail'>

		<script type=\"text/javascript\">

		alert(\"DADOS ALTERADOS COM SUCESSO!\");

		</script>";	

}



///////////////////////// CONFIGURA AVISO DE FATURA ////////////////////////



if(isset($_POST['aviso'])){

			$tabela = "maile";

			$string = "id = 1";

			$dados = array(

					'aviso'		=> $_POST['aviso'],

					'text1'		=> $_POST['editor1']

			);

					



$conecta->alterar($tabela,$dados,$string);

print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=?pg=confmail#page=page-2'>

		<script type=\"text/javascript\">

		alert(\"DADOS ALTERADOS COM SUCESSO!\");

		</script>";	

}



/////////////////// FATURA EM ABERTO /////////////////////////

if(isset($_POST['avisofataberto'])){

			$tabela = "maile";

			$string = "id = 1";

			$dados = array(

					'avisofataberto' => $_POST['tata'],

					'text2'			 => $_POST['editor1']

			);



$conecta->alterar($tabela,$dados,$string);



print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=?pg=confmail#page=page-3'>

		<script type=\"text/javascript\">

		alert(\"DADOS ALTERADOS COM SUCESSO!\");

		</script>";	

}

/////////////////// ANIVERSÁRIO /////////////////////////

if(isset($_POST['aniversario'])){

			$tabela = "maile";

			$string = "id = 1";

			$dados = array(

					'avisoaniversario' => $_POST['avisoaniversario'],

					'text4'			 => $_POST['text4']

			);



$conecta->alterar($tabela,$dados,$string);



print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=?pg=confmail#page=page-4'>

		<script type=\"text/javascript\">

		alert(\"DADOS ALTERADOS COM SUCESSO!\");

		</script>";	

}





/////////////////// EMAIL DADOS ACESSO CLIENTE /////////////////////////

if(isset($_POST['dadosacesso'])){

			$tabela = "maile";

			$string = "id = 1";

			$dados = array(

					'dadosacesso'	=> $_POST['enviadados'],

					'text3'			=> $_POST['editor1']

			);



$conecta->alterar($tabela,$dados,$string);

print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=?pg=confmail#page=page-4'>

		<script type=\"text/javascript\">

		alert(\"DADOS ALTERADOS COM SUCESSO!\");

		</script>";	



}



$g_mail = mysql_query("SELECT * FROM maile")or die (mysql_error());

$linhamail = mysql_fetch_array($g_mail);



/////////////////////// ALTERA DADOS DE ACESSO ////////////////////////////

if(isset($_POST['user'])){

			

			$tabela = "usuario";

			$string = "id_usuario = '1'";

			$dados = array(

					'login'		=> $_POST['login'],

					'senha'		=> $_POST['senha'],

					'hash'		=> hash('sha512', $_POST['senha'])

					);	

$conecta->alterar($tabela,$dados,$string);



  print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=?pg=configuracoes'>

		<script type=\"text/javascript\">

		alert(\"DADOS ALTERADOS COM SUCESSO!\");

		</script>";	

}

$g_user = mysql_query("SELECT * FROM usuario")or die (mysql_error());

$linhauser = mysql_fetch_array($g_user);



//////////////////////////// CADASTRO PLANO DE CONTAS //////////////////////////



if(isset($_POST['cadastar_plano'])){

	$tabela = "flux_planos";

	$dados 	= array(

				'descricao'			=> $_POST['descricao']

				);



		$sql = $conecta->inserir($tabela,$dados);	

 		print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=?pg=fluxo#tabs-2'>";

}



//////////////////////////// CADASTRO CONTAS //////////////////////////



if(isset($_POST['adicionar_conta'])){

	$tabela = "flux_entrada";

	$dados 	= array(

				'data'			=> datas($_POST['data']),

				'tipo'			=> $_POST['tipo'],

				'id_plano'		=> $_POST['id_plano'],

				'descricao'		=> $_POST['descricao'],

				'valor'			=> tiraMoeda($_POST['valor'])

				);



		$sql = $conecta->inserir($tabela,$dados);	

 		print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=?pg=fluxo'>"; 

}

//////////////////////////// EDITAR CONTAS LANÇADAS ////////////////////////

if(isset($_POST['atualizalancamento'])){

			

			$tabela = "flux_entrada";

			$id_entrada = $_POST['id_entrada'];

			$string = "id_entrada = '$id_entrada'";

			$teste = tiraMoeda($_POST['valor']);

			$dados = array(

				'data'			=> datas($_POST['data']),

				'tipo'			=> $_POST['tipo'],

				'id_plano'		=> $_POST['id_plano'],

				'descricao'		=> $_POST['descricao'],

				'valor'			=> tiraMoeda($_POST['valor'])

					);	

$conecta->alterar($tabela,$dados,$string);	

}

//////////////////////////// CADASTRO DESPESAS FIXAS //////////////////////////



if(isset($_POST['grava_despesa_fixa'])){

	$tabela = "flux_fixas";

	$dados 	= array(

				'dia_vencimento'		=> $_POST['dia_vencimento'],

				'descricao_fixa'		=> $_POST['descricao_fixa'],

				'valor_fixa'			=> tiraMoeda($_POST['valor_fixa'])

				);



		$sql = $conecta->inserir($tabela,$dados);	

 		print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=?pg=fluxo'>"; 

}

//////////////////////////// CADASTRO DE CLIENTES //////////////////////////



if(isset($_POST['clientegr'])){

	$tabela = "cliente";
	$bloqueado = "N";

	unset($_POST['clientegr']);

	$_POST['obs'] = addslashes($_POST['texto']);

	unset($_POST['texto']);



	$_POST['centro']            = addslashes($_POST['centro']);
	$_POST['dir_culto']         = addslashes($_POST['dir_culto']);
	$_POST['nome']              = addslashes($_POST['nome']);
	$_POST['filiacao_pai']		= addslashes($_POST['filiacao_pai']);
	$_POST['filiacao_mae']		= addslashes($_POST['filiacao_mae']);
	$_POST['nasc_pres']			= datas($_POST['nasc_pres']);
	$_POST['filiacaopai_pres']	= addslashes($_POST['filiacaopai_pres']);
	$_POST['filiacaomae_pres']	= addslashes($_POST['filiacaomae_pres']);
    $_POST['obs_pres']			= addslashes($_POST['obs_pres']);
	$_POST['linha_trab']		= addslashes($_POST['linha_trab']);
	$_POST['nacao']				= addslashes($_POST['nacao']);
	$_POST['obrig_feita']		= addslashes($_POST['obrig_feita']);

	$_POST['nascimento']        = datas($_POST['nascimento']);
	$_POST['inscricao']         = datas($_POST['inscricao']);

	$_POST['senha'] = '123';

	//////////INSERIR IMAGENS/////////////

		// verifica se foi enviado um arquivo
if ( isset( $_FILES["foto_pres"]["name"] ) && $_FILES[ 'foto_pres' ][ 'error' ] == 0 ) {
   
    $arquivo_tmp = $_FILES[ 'foto_pres' ][ 'tmp_name' ];
    $nome = $_FILES[ 'foto_pres' ][ 'name' ];
 
    // Pega a extensão
    $extensao = pathinfo ( $nome, PATHINFO_EXTENSION );
 
    // Converte a extensão para minúsculo
    $extensao = strtolower ( $extensao );
 
    // Somente imagens, .jpg;.jpeg;.gif;.png
    // Aqui eu enfileiro as extensões permitidas e separo por ';'
    // Isso serve apenas para eu poder pesquisar dentro desta String
    if ( strstr ( '.jpg;.jpeg;.gif;.png', $extensao ) ) {
        // Cria um nome único para esta imagem
        // Evita que duplique as imagens no servidor.
        // Evita nomes com acentos, espaços e caracteres não alfanuméricos
        $novoNome = uniqid ( time () ) . '.' . $extensao;
 
        // Concatena a pasta com o nome
        $destino = '../img/' . $novoNome;
 
        // tenta mover o arquivo para o destino
        if ( @move_uploaded_file ( $arquivo_tmp, $destino ) ) {
            $_POST['foto_pres'] = $destino;
        } 
        
    }
    else {
    	print"	<script type=\"text/javascript\">
					alert(\"Imagem do Presidente não registrada (Não é um arquivo *.jpg;*.jpeg;*.gif;*.png)! \");
				</script>";
    }
}

if ( isset( $_FILES["foto_dir"]["name"] ) && $_FILES[ 'foto_dir' ][ 'error' ] == 0 ) {
   
    $arquivo_tmp = $_FILES[ 'foto_dir' ][ 'tmp_name' ];
    $nome = $_FILES[ 'foto_dir' ][ 'name' ];
 
    // Pega a extensão
    $extensao = pathinfo ( $nome, PATHINFO_EXTENSION );
 
    // Converte a extensão para minúsculo
    $extensao = strtolower ( $extensao );
 
    // Somente imagens, .jpg;.jpeg;.gif;.png
    // Aqui eu enfileiro as extensões permitidas e separo por ';'
    // Isso serve apenas para eu poder pesquisar dentro desta String
    if ( strstr ( '.jpg;.jpeg;.gif;.png', $extensao ) ) {
        // Cria um nome único para esta imagem
        // Evita que duplique as imagens no servidor.
        // Evita nomes com acentos, espaços e caracteres não alfanuméricos
        $novoNome = uniqid ( time () ) . '.' . $extensao;
 
        // Concatena a pasta com o nome
        $destino = '../img/' . $novoNome;
 
        // tenta mover o arquivo para o destino
        if ( @move_uploaded_file ( $arquivo_tmp, $destino ) ) {
            $_POST['foto_dir'] = $destino;
        }
    }
    else {
        print"	<script type=\"text/javascript\">
					alert(\"Imagem do Diretor Espiritual não registrada (Não é um arquivo *.jpg;*.jpeg;*.gif;*.png)! \");
				</script>";
    }
}
	

if ( isset( $_FILES["assinatura"]["name"] ) && $_FILES[ 'assinatura' ][ 'error' ] == 0 ) {
   
    $arquivo_tmp = $_FILES[ 'assinatura' ][ 'tmp_name' ];
    $nome = $_FILES[ 'assinatura' ][ 'name' ];
 
    // Pega a extensão
    $extensao = pathinfo ( $nome, PATHINFO_EXTENSION );
 
    // Converte a extensão para minúsculo
    $extensao = strtolower ( $extensao );
 
    // Somente imagens, .jpg;.jpeg;.gif;.png
    // Aqui eu enfileiro as extensões permitidas e separo por ';'
    // Isso serve apenas para eu poder pesquisar dentro desta String
    if ( strstr ( '.jpg;.jpeg;.gif;.png', $extensao ) ) {
        // Cria um nome único para esta imagem
        // Evita que duplique as imagens no servidor.
        // Evita nomes com acentos, espaços e caracteres não alfanuméricos
        $novoNome = uniqid ( time () ) . '.' . $extensao;
 
        // Concatena a pasta com o nome
        $destino = '../img/' . $novoNome;
 
        // tenta mover o arquivo para o destino
        if ( @move_uploaded_file ( $arquivo_tmp, $destino ) ) {
            $_POST['assinatura'] = $destino;
        } 
        
    }
    else {
    	print"	<script type=\"text/javascript\">
					alert(\"Imagem da Assinatura não registrada (Não é um arquivo *.jpg;*.jpeg;*.gif;*.png)! \");
				</script>";
    }
}


	$dados = $_POST;

		$sql = $conecta->inserir($tabela,$dados);


		if (empty($sql)){

			$consulta = mysql_query("SELECT * FROM cliente ORDER BY id_cliente DESC Limit 1")or die (mysql_error());
			$cliente = mysql_fetch_array($consulta);
			$resultado = gerarMensalidadeCadastro($cliente['id_cliente']);

			if($resultado){



				print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=?pg=cadclientes'>
				<script type=\"text/javascript\">
					alert(\"CLIENTE CADASTRADO COM SUCESSO E GERADO MENSALIDADES PARA O ANO! \");
				</script>";

			} else {

				print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=?pg=cadclientes'>
				<script type=\"text/javascript\">
					alert(\"CLIENTE CADASTRADO COM SUCESSO, MAS NÃO FORAM GERADAS AS MENSALIDADES!\");
				</script>";	

			}

		} else {

			print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=?pg=cadclientes'>

		<script type=\"text/javascript\">

		alert(\"ALGO ERRADO, CLIENTE NÃO CADASTRADO, $sql\");

		</script>";

		}

}

///////////////////////////// CADASTRO DE GRUPOS //////////////////////



if(isset($_POST['cadgrupocli'])){

	$tabela = "grupo";

	$dados = array(

	 		'nomegrupo' => $_POST['nomegrupo'],

			'meses'		=> $_POST['meses'],

			'dia'		=> $_POST['dia'],

			'valor'		=> $_POST['valor']

			);	

$sql = $conecta->inserir($tabela,$dados);

	print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=?pg=grupo'>

			<script type=\"text/javascript\">

			alert(\"GRUPO CADASTRADO COM SUCESSO!\");

			</script>";	

				}	

$gr = mysql_query("SELECT * FROM grupo WHERE id_grupo !='1'");

///////////////////// DELETA GRUPOS ///////////////////////

if(isset($_GET['del']) && $_GET['del'] == "del"){

	$idGrupo = $_GET['id_grupo'];

	$del = mysql_query("DELETE FROM grupo WHERE id_grupo='$idGrupo'")or die(mysql_error());

	print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=?pg=grupo'>

			<script type=\"text/javascript\">

			alert(\"GRUPO DELETADO COM SUCESSO!\");

			</script>";	

}

/////////////////////// EDITA CLIENTES //////////////////////////

$consulta = mysql_query("SELECT * FROM cliente ORDER BY nome ASC")or die (mysql_error());

////////////////////////////////////// LANÇA FATURA UNICA  ///////////////////////

if(isset($_POST['lancafatunica']) && $_POST['id_cliente'] != "0"){

	$id_cliente 	= $_POST['id_cliente'];
	$data_venc 		= $_POST['data_venci'];
	$ref 			= $_POST['ref'];
	$define 		= $_POST['define'];//Define qual valor Utilizar
	$valor_postado	= $_POST['valor'];

	$cliente = getCliente($id_cliente);

if (validaCPF($cliente['cpfcnpj'])){

	if ($ref == 1){//GERA BOLETO COM REFERENCIA EM TEXTO (NÃO EXISTE O REF2)

		  	$referencia = $_POST['texto'];

			$qtd_mes = 1;
			
			$dados = gerarBoletoTexto ($id_cliente, $data_venc, $define, $referencia, $valor_postado, $qtd_mes);

			$sql_mail = $conecta->inserir('faturas',$dados);//INSERE OS DADOS NO BD

			$id_res = mysql_insert_id();//BUSCA O ULTIMO ID INSERIDO NO BD
			include 'boleto_itau.php';//CHAMA O BOLETO
			include "mail_fat_unica.php";		

	} else if ($ref == 2) {//GERA BOLETO DE MENSALIDADE UNICA - REF2NO FORMATO "MES/ANO"

			$mes = $_POST['ref_mes'];
			$ano = $_POST['ref_ano'];

			$dados = gerarBoletoUnicoMes ($id_cliente, $data_venc, $define, $valor_postado, $mes, $ano);

			if ($dados == 1){//MENSAGEM SE MENSALIDADE JÁ PAGA
					print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=inicio.php?pg=lancafatura'>
					<script type=\"text/javascript\">	
						alert(\"Mensalidade consta como paga no sistema!\");	
					</script>";	

			} else if ($dados == 2){//MENSAGEM SE BOLETO EXISTE
					print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=inicio.php?pg=lancafatura'>
					<script type=\"text/javascript\">	
						alert(\"Já existe boleto para esta referência!\");	
					</script>";

			} else {
					$sql_mail = $conecta->inserir('faturas',$dados);//INSERE OS DADOS NO BD		
					verificaGerarMensalidade($id_cliente, $ano);
					$id_res = mysql_insert_id();//BUSCA O ULTIMO ID INSERIDO NO BD
					include 'boleto_itau.php';//CHAMA O BOLETO
					include "mail_fat_unica.php";
			}

	} else if ($ref == 3){///GERA BOLETO POR INTERVALO DE MESES

			$mes_inicial 	= $_POST['mes_inicial'];
			$mes_final 		= $_POST['mes_final'];
			$ano_inicial 	= $_POST['ano_inicial'];
			$ano_final 		= $_POST['ano_final'];

			$dados = gerarBoletoPorIntervalo($id_cliente, $data_venc, $define, $valor_postado, $mes_inicial, $mes_final, $ano_inicial, $ano_final);

			if ($dados == 2){//MENSAGEM SE BOLETO EXISTE
					print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=inicio.php?pg=lancafatura'>
					<script type=\"text/javascript\">	
						alert(\"Já existe boleto para esta referência!\");	
					</script>";
			} else {
					$sql_mail = $conecta->inserir('faturas',$dados);//INSERE OS DADOS NO BD

						while ($ano_final >= $ano_inicial){
							verificaGerarMensalidade($id_cliente, $ano_inicial);
							$ano_inicial++;
						}

					$id_res = mysql_insert_id();//BUSCA O ULTIMO ID INSERIDO NO BD
					include 'boleto_itau.php';//CHAMA O BOLETO
					include "mail_fat_unica.php";
			}

	} else if ($ref == 4){// GERA BOLETOS PARA ANUIDADE

			$ano = $_POST['anual_ano'];

			$dados = gerarBoletoAnual ($id_cliente, $data_venc, $define, $valor_postado, $ano);

			if ($dados == 2){//MENSAGEM SE BOLETO EXISTE
					print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=inicio.php?pg=lancafatura'>
					<script type=\"text/javascript\">	
						alert(\"Já existe boleto para esta referência!\");	
					</script>";
			} else {
					$sql_mail = $conecta->inserir('faturas',$dados);//INSERE OS DADOS NO BD		
					verificaGerarMensalidade($id_cliente, $ano);
					$id_res = mysql_insert_id();//BUSCA O ULTIMO ID INSERIDO NO BD
					include 'boleto_itau.php';//CHAMA O BOLETO
					include "mail_fat_unica.php";
			}
	}
} else { 
		print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=inicio.php?pg=lancafatura'>
				<script type=\"text/javascript\">	
					alert(\"Cliente com CPF inválido, por favor atualize o cadastro!\");	
				</script>";	
	}
}///////FIM DO CADASTRO DE FATURA UNICA



//////////////////////// encodifica url //////////////////////////////////////

function base64url_encode($data) {

			return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');

			}



////////////////////////// LANÇA FATURA POR GRUPOS ////////////////////////////



if(isset($_POST['lancafatperiodica']) && $_POST['situacao'] != "0"){

	$situacao	 	= $_POST['situacao'];
	$data_venc 		= $_POST['data_venci'];
	$ref 			= $_POST['ref'];
	$define 		= $_POST['define'];//Define qual valor Utilizar
	$valor_postado	= $_POST['valor'];

if ($ref == 1){//GERA BOLETO COM REFERENCIA EM TEXTO (NÃO EXISTE O REF2)

		$referencia = $_POST['texto'];
		$qtd_mes = 1;

	
		################ PEGA O CLIENTE ##############
		$sql_cliente = mysql_query("SELECT * FROM cliente WHERE situacao = '$situacao'");
		$contador = 0;

		while($select_cliente = mysql_fetch_array($sql_cliente)){	

				if ($select_cliente['responsavel'] == "CPF"){

					if (validaCPF($select_cliente['cpfcnpj'])){

						$id_cliente = $select_cliente['id_cliente'];

						$dados = gerarBoletoTexto ($id_cliente, $data_venc, $define, $referencia, $valor_postado, $qtd_mes);

						$sql_mail = $conecta->inserir('faturas',$dados);//INSERE OS DADOS NO BD

						if (!empty($sql_mail)){

						$contador++;

						}

					}
				} else {

					$id_cliente = $select_cliente['id_cliente'];

						$dados = gerarBoletoTexto ($id_cliente, $data_venc, $define, $referencia, $valor_postado, $qtd_mes);

						$sql_mail = $conecta->inserir('faturas',$dados);//INSERE OS DADOS NO BD

						if (!empty($sql_mail)){

						$contador++;

						}

				}	

		}

		$id_res = @implode("','", $id_inseridos);

		include 'boleto_itau_grupo.php';

		if ($contador > 0){

			print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=inicio.php?pg=periodica'>

				<script type=\"text/javascript\">	

				alert(\"ATENÇÃO!!! Algumas faturas podem não ter sido geradas!\");	

				</script>";

		} else {

			print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=inicio.php?pg=periodica'>

				<script type=\"text/javascript\">	

				alert(\"Todas as faturas geradas com sucesso!\");	

				</script>";

		

		}



} else if($ref == 2){

	

		$mes = $_POST['ref_mes'];

		$ano = $_POST['ref_ano'];

		

		$sql_cliente = mysql_query("SELECT * FROM cliente WHERE situacao = '$situacao'");

		$contador = 0;

		while($select_cliente = mysql_fetch_array($sql_cliente)){	

			if ($select_cliente['responsavel'] == "CPF"){

					if (validaCPF($select_cliente['cpfcnpj'])){	

						$id_cliente = $select_cliente['id_cliente'];
						$dados = gerarBoletoUnicoMes ($id_cliente, $data_venc, $define, $valor_postado, $mes, $ano);

						if ($dados == 1){//MENSAGEM SE MENSALIDADE JÁ PAGA
								$ids_mensalidades_pagas[] = $id_cliente;	
						} else if ($dados == 2){//MENSAGEM SE BOLETO EXISTE
								$ids_boletos_existentes[] = $id_cliente;
						} else {
								$sql_mail = $conecta->inserir('faturas',$dados);//INSERE OS DADOS NO BD
								$id_gerado_sucesso[] = $id_cliente;
								verificaGerarMensalidade($id_cliente, $ano);
						}
					}
			} else {

				$id_cliente = $select_cliente['id_cliente'];
						$dados = gerarBoletoUnicoMes ($id_cliente, $data_venc, $define, $valor_postado, $mes, $ano);

						if ($dados == 1){//MENSAGEM SE MENSALIDADE JÁ PAGA
								$ids_mensalidades_pagas[] = $id_cliente;	
						} else if ($dados == 2){//MENSAGEM SE BOLETO EXISTE
								$ids_boletos_existentes[] = $id_cliente;
						} else {
								$sql_mail = $conecta->inserir('faturas',$dados);//INSERE OS DADOS NO BD
								$id_gerado_sucesso[] = $id_cliente;
								verificaGerarMensalidade($id_cliente, $ano);
						}

			}

		}////FECHA WHILE

		$id_res = @implode("','", $id_inseridos);

		include 'boleto_itau_grupo.php';

		/////////////////// DESENVOLVER AQUI O RELATORIO

		/////////////// PASSAR POR get OS 3 ARRAYS ACIMA E GERAR O RELATORIO

		



} else if($ref == 3){



		$mes_inicial 	= $_POST['mes_inicial'];

		$mes_final 		= $_POST['mes_final'];

		$ano_inicial 	= $_POST['ano_inicial'];

		$ano_final 		= $_POST['ano_final'];

		

		$sql_cliente = mysql_query("SELECT * FROM cliente WHERE situacao = '$situacao'");

		$contador = 0;

		while($select_cliente = mysql_fetch_array($sql_cliente)){	
			if ($select_cliente['responsavel'] == "CPF"){

					if (validaCPF($select_cliente['cpfcnpj'])){	
						$id_cliente = $select_cliente['id_cliente'];
						$dados = gerarBoletoPorIntervalo($id_cliente, $data_venc, $define, $valor_postado, $mes_inicial, $mes_final, $ano_inicial, $ano_final);

						if ($dados == 2){//MENSAGEM SE BOLETO EXISTE
								$contador++;
						} else {
								$sql_mail = $conecta->inserir('faturas',$dados);//INSERE OS DADOS NO BD	

							while ($ano_final >= $ano_inicial){
								verificaGerarMensalidade($id_cliente, $ano_inicial);
								$ano_inicial++;
							}
						}
					}
			} else {

				$id_cliente = $select_cliente['id_cliente'];
				$dados = gerarBoletoPorIntervalo($id_cliente, $data_venc, $define, $valor_postado, $mes_inicial, $mes_final, $ano_inicial, $ano_final);

				if ($dados == 2){//MENSAGEM SE BOLETO EXISTE
					$contador++;
				} else {
					$sql_mail = $conecta->inserir('faturas',$dados);//INSERE OS DADOS NO BD	
					while ($ano_final >= $ano_inicial){
						verificaGerarMensalidade($id_cliente, $ano_inicial);
						$ano_inicial++;
					}
				}

			}	

		}

		$id_res = @implode("','", $id_inseridos);

		include 'boleto_itau_grupo.php';

		if ($contador > 0){

			print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=inicio.php?pg=periodica'>

				<script type=\"text/javascript\">	

				alert(\"ATENÇÃO!!! Algumas faturas não foram geradas por já existirem!\");	

				</script>";

		} else {

			print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=inicio.php?pg=periodica'>

				<script type=\"text/javascript\">	

				alert(\"Todas as faturas geradas com sucesso!\");	

				</script>";

		

		}



} else if($ref == 4){



		$ano = $_POST['anual_ano'];

		

		$sql_cliente = mysql_query("SELECT * FROM cliente WHERE situacao = '$situacao'");

		$contador = 0;

		while($select_cliente = mysql_fetch_array($sql_cliente)){	

			if ($select_cliente['responsavel'] == "CPF"){

					if (validaCPF($select_cliente['cpfcnpj'])){	

						$id_cliente = $select_cliente['id_cliente'];
						$dados = gerarBoletoAnual ($id_cliente, $data_venc, $define, $valor_postado, $ano);

						if ($dados == 2){//MENSAGEM SE BOLETO EXISTE
								$contador++;
						} else if ($dados == 3){ 
								$conta[] = $id_cliente;
						} else {
								$sql_mail = $conecta->inserir('faturas',$dados);//INSERE OS DADOS NO BD	
								verificaGerarMensalidade($id_cliente, $ano);	
						}
					}
			} else {

				$id_cliente = $select_cliente['id_cliente'];
				$dados = gerarBoletoAnual ($id_cliente, $data_venc, $define, $valor_postado, $ano);

				if ($dados == 2){//MENSAGEM SE BOLETO EXISTE
					$contador++;
				} else if ($dados == 3){ 
					$conta[] = $id_cliente;
				} else {
					$sql_mail = $conecta->inserir('faturas',$dados);//INSERE OS DADOS NO BD	
					verificaGerarMensalidade($id_cliente, $ano);	
				}

			}	
		}///////////FECHA WHILE

		$id_res = @implode("','", $id_inseridos);

		include 'boleto_itau_grupo.php';

		if ($contador > 0){

			print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=inicio.php?pg=periodica'>

				<script type=\"text/javascript\">	

				alert(\"ATENÇÃO!!! Algumas faturas não foram geradas por já existirem!\");	

				</script>";

		} else {

			print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=inicio.php?pg=periodica'>

				<script type=\"text/javascript\">	

				alert(\"Todas as faturas geradas com sucesso!\");	

				</script>";

		}

}

	

}

	

	///////////////////////// gera link fatura //////////////////

$url = mysql_query("SELECT * FROM bancos WHERE situacao='1'");

$lista = mysql_fetch_array($url);

	$link = $lista['link'];	

	

?>