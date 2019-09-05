<?php
include '../classes/conexao.php';
include '../classes/funcoes.class.php';

/*ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL); 
*/

function gerarNome($total_caracteres){

     $caracteres = 'ABCDEFGHIJKLMNOPQRSTUWXYZ';
     $caracteres .= 'abcdefghijklmnopqrstuwxyz';
     $caracteres .= '0123456789';

     $max = strlen($caracteres)-1;

     $senha = null;

     for($i=0; $i < $total_caracteres; $i++){
        $senha .= $caracteres{mt_rand(0, $max)};
    }
    return $senha;
 }

 $total_caracteres = 8;

 $nomeArquivo = gerarNome($total_caracteres);



$sql = mysql_query("SELECT * FROM config")or die(mysql_error());
$ver = mysql_fetch_array($sql);

$sql2 = mysql_query("SELECT * FROM bancos WHERE situacao='1'")or die(mysql_error());
$banco = mysql_fetch_array($sql2);

include 'vendor/autoload.php';

switch ($banco['id_banco']) {

	case 1:
		$codigo_banco = Cnab\Banco::BANCO_DO_BRASIL;
		$arquivo = new Cnab\Remessa\Cnab400\Arquivo($codigo_banco);	
		break;

	case 2:
		$codigo_banco = Cnab\Banco::BRADESCO;
		$arquivo = new Cnab\Remessa\Cnab400\Arquivo($codigo_banco);	
		break;

	case 3;	
		$codigo_banco = Cnab\Banco::CEF;	
		$arquivo = new Cnab\Remessa\Cnab240\Arquivo($codigo_banco);
		break;

	case 4;	
		$codigo_banco = Cnab\Banco::ITAU;
		$arquivo = new Cnab\Remessa\Cnab400\Arquivo($codigo_banco);
		break;

	case 5;	
		$codigo_banco = Cnab\Banco::ITAU;
		$arquivo = new Cnab\Remessa\Cnab400\Arquivo($codigo_banco);
		break;
}


$arquivo->configure(array(

    'data_geracao'  => new DateTime(),
    'data_gravacao' => new DateTime(), 
    'nome_fantasia' => $ver['nome'], 
    'razao_social'  => $ver['nome'],  
    'cnpj'          => preg_replace( '#[^0-9]#', '', $ver['cpf'] ), 
    'banco'         => $codigo_banco, 
    'logradouro'    => $ver['endereco'],
    'numero'        => $ver['numero'],
    'bairro'        => $ver['bairro'], 
    'cidade'        => $ver['cidade'],
    'uf'            => $ver['uf'],
    'cep'           => preg_replace( '#[^0-9]#', '', $ver['cep'] ),
    'agencia'       => $banco['agencia'], 
    'conta'         => $banco['conta'], 
    'conta_dac'     => $banco['digito_co']	
));

foreach($_POST['id_venda'] as $key => $id_cliente){	

	$id_venda = isset($_POST['id_venda'][$key])? $_POST['id_venda'][$key] :null;

	$seleciona  = mysql_query("SELECT * FROM faturas WHERE id_venda = '$id_venda'") or die(mysql_error());

	$fatura = mysql_fetch_array($seleciona);

		$IdCliente = $fatura['id_cliente'];
		$sq = mysql_query("SELECT * FROM cliente WHERE id_cliente='$IdCliente'") or die(mysql_error());
		$cliente = mysql_fetch_array($sq);

	if($fatura['codigo_operacao'] == 2 || $fatura['codigo_operacao'] == 34){

		$codigo_operacao = 2;
		$tipo = "remessa";
	} else {

		$codigo_operacao = 1;
		$tipo = "remessa";
	}		

	

	if ($cliente['responsavel'] == 'CPF'){
			$nome_resp = $cliente['dir_culto'];
			$cpfcnpj = $cliente['cpfcnpj'];
			$documento = 'cpf';

	} else if($cliente['responsavel'] == 'CNPJ'){
			$nome_resp = $cliente['centro'];
			$cpfcnpj = $cliente['cnpj'];
			$documento = 'cnpj';
	}

$arquivo->insertDetalhe(array(

   'codigo_de_ocorrencia' => $fatura['codigo_operacao'], // 1 = Entrada de título, futuramente poderemos ter uma constante
   //'codigo_ocorrencia' => 1,
    'nosso_numero'      => $fatura['id_venda'],
    'numero_documento'  => $fatura['id_venda'],
    'carteira'          => $banco['carteira'],
    'especie'           => $banco['especie'], // Você pode consultar as especies Cnab\Especie
    'valor'             => $fatura['valor'], // Valor do boleto
    'instrucao1'        => '10', //10 - Não protestar 1 = Protestar com (Prazo) dias, 2 = Devolver após (Prazo) dias, futuramente poderemos ter uma constante
    'instrucao2'        => '57', // 57 - Somar valor do boleto ao valor da multa //47 - dispensa juros / preenchido com zeros
    'sacado_nome'       => $cliente['dir_culto'], // O Sacado é o cliente, preste atenção nos campos abaixo
	'sacado_razao_social' => $cliente['centro'],
    'sacado_tipo'       => $documento, //campo fixo, escreva 'cpf' (sim as letras cpf) se for pessoa fisica, cnpj se for pessoa juridica
    'sacado_cpf'        => $cliente['cpfcnpj'],
	'sacado_cnpj'		=> $cliente['cnpj'],
    'sacado_logradouro' => $cliente['endereco'].'n '.$cliente['numero'].', '.$cliente['complemento'],
    'sacado_bairro'     => $cliente['bairro'],
    'sacado_cep'        => preg_replace( '#[^0-9]#', '', $cliente['cep'] ), // sem hífem
    'sacado_cidade'     => $cliente['cidade'],
    'sacado_uf'         => $cliente['uf'],
    'data_vencimento'   => new DateTime($fatura['data_venci']),
    'data_cadastro'     => new DateTime($fatura['data']),

    'juros_de_um_dia'     => ($fatura['valor'] * $ver['juro'] / 100), // Valor do juros de 1 dia'
    'data_desconto'       => new DateTime($fatura['data_venci']),
    'valor_desconto'      => 0.0, // Valor do desconto
    'prazo'               => (int) $ver['dias'], // prazo de dias para o cliente pagar após o vencimento
    'taxa_de_permanencia' => '00', //00 = Acata Comissão por Dia (recomendável), 51 Acata Condições de Cadastramento na CAIXA
    'mensagem'            => '',
    'data_multa'          => new DateTime($fatura['data_venci']), // data da multa

    'valor_multa'         => ($fatura['valor'] * $ver['multa_atrazo'] / 100), // valor da multa
	'aceite' 			=> 'N'

),$tipo);

}

$arrnome = $nomeArquivo.'.REM';

// para salvar
$arquivo->save($arrnome);

if($arquivo){
	$sql2 = mysql_query("SELECT * FROM bancos WHERE situacao='1'")or die(mysql_error());
	$banco = mysql_fetch_array($sql2);
	$b = $banco['id_banco'];

foreach($_POST['id_venda'] as $key => $id_cliente){	
	$id_venda = isset($_POST['id_venda'][$key])? $_POST['id_venda'][$key] :null;
	$up = mysql_query("UPDATE faturas SET remessa = '1' WHERE id_venda = '$id_venda'");
}

	$dataNow = date("Y-m-d H:i:s");
	$grava = mysql_query("INSERT INTO remessas (data ,nome, grupo, id_banco)VALUES('$dataNow', '$arrnome', '0', '$b')") or die(mysql_error());

if($up == 1){
			print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=../inicio.php?pg=listaremessa'>
				  <script type=\"text/javascript\">
		  				alert(\"ARQUIVO DE REMESSA GERADO COM SUCESSO!\");
	  				</script>";
	}

} else {
	print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=../inicio.php?pg=listaremessa'>
	  <script type=\"text/javascript\">
  				alert(\"ARQUIVO DE REMESSA NÃO GERADO!\");
		</script>";
	}

mysql_free_result($bd);
mysql_close($bd);
?>