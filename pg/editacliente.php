<?php 
include '../classes/conexao.php';
if(isset($_GET['mensalidade']) && $_GET['mensalidade'] != ''){

	$id = $_GET['mensalidade'];
	$sql = mysql_query("DELETE FROM mensalidades WHERE id_mensalidade='$id'")or die (mysql_error());
	
}

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Editar dados de clientes</title>
<style type="text/css">
body {
	background:#0099CC;
	font-family:Verdana, Geneva, sans-serif; font-size:12px;
}
fieldset{
-webkit-border-radius: 10px;
-moz-border-radius: 10px;
border-radius: 10px;
background:#FFFFFF;
overflow:hidden;
padding-top:30px;	
}
.linha {
	width:1000px;
	display:table;
	margin-bottom:10px;
	}
.coluna {
	float:left;	
	}
	
</style>
<link href="../css/jquery-uicss.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="../css/icons.css" />
<link href="../css/principal.css" rel="stylesheet" type="text/css">
<link href="../css/styles.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css" />
</head>
<script type="text/javascript" src="../tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
    selector: "textarea",
	height: 320,
	 plugins: [
         "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
         "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
         "save table contextmenu directionality emoticons template paste textcolor"
   ],

	paste_data_images: true,
	language : 'pt_BR',
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l  link image | print preview media fullpage | forecolor backcolor emoticons",

 });
</script>

<script language="javascript">
function fechajanela(p,pg) {
	if (p ==1){
window.open("../inicio.php?pg=listaclientesincompletos","main");	
	} else {
		url = "../inicio.php?pg=listaclientes&p=" + pg; 
window.open(url ,"main");
	}
}
</script>

<script type="text/javascript" src="../js/funcoes.js"></script>
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/jquery.maskedinput.js"></script>
<script type="text/javascript">

function confirmar_foto(query,id){
if (confirm ("Tem certeza que deseja excluir esta foto?")){   
 window.location="../php/deleta_foto.php" + query;  
 return true;
 }
 else  
 window.location="inicio.php?pg=editacliente&id=" + id;
 return false;
 }

    jQuery(function ($) {
            $("#telefone").mask("(99) 9999-9999");
            $("#cpf-cnpj").mask("999.999.999-99");
            $("#cep").mask("99999-999");
			$("#cep_dir").mask("99999-999");
			$("#cep_res").mask("99999-999");
            $("#cnpj").mask("99.999.999/9999-99");
			$("#nascimento").mask("99/99/9999");
			$("#celular").mask("(99) 99999-9999");
			$("#celular2").mask("(99) 99999-9999");
			$("#inscricao").mask("99/99/9999");
			$("#cpf_pres").mask("999.999.999-99");
			$("#nasc_pres").mask("99/99/9999");
			$("#data_doc").mask("99/99/9999");
			$("#iniciado").mask("99/99/9999");
			$("#feitura").mask("99/99/9999");
			
        });
		
function up(lstr){ // converte minusculas em maiusculas
var str=lstr.value; //obtem o valor
lstr.value=str.toUpperCase(); //converte as strings e retorna ao campo
}

function down(lstr){
var str=lstr.value;
lstr.value=str.toLowerCase();
}

function validar_nascimento() { //VALIDAÇÂO DOS VALORES DO FORMULÁRIO

var data = new Date();
var ano4 = data.getFullYear();       // 4 dígitos
var nascimento = clientes.nascimento.value;
var nascimento_presidente = clientes.nasc_pres.value;

var n = nascimento.split("/");
var np = nascimento_presidente.split("/");

	if (n[1] > "12") {	
		alert('A data de nascimento do diretor não corresponde a uma data válida');
		clientes.nascimento.focus();
		return false;
	} else if (n[0] > "31"){
		alert('A data de nascimento do diretor não corresponde a uma data válida');
		clientes.nascimento.focus();
		return false;
	} else if (n[2] > ano4){
		alert('A data de nascimento do diretor não corresponde a uma data válida');
		clientes.nascimento.focus();
		return false;
	}

	if (np[1] > "12") {	
		alert('A data de nascimento do presidente não corresponde a uma data válida');
		clientes.nasc_pres.focus();
		return false;
	} else if (np[0] > "31"){
		alert('A data de nascimento do presidente não corresponde a uma data válida');
		clientes.nasc_pres.focus();
		return false;
	} else if (np[2] > ano4){
		alert('A data de nascimento do presidente não corresponde a uma data válida');
		clientes.nasc_pres.focus();
		return false;
	}
}
</script>

<!-- Adicionando Javascript -->
    <script type="text/javascript" >
	
		$(document).ready(function() {

            function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#end_dir").val("");
                $("#bairro_dir").val("");
                $("#cidade_dir").val("");
                $("#uf_dir").val("");
                $("#ibge").val("");
            }
            
            //Quando o campo cep perde o foco.
            $("#cep_dir").blur(function() {

                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if(validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#end_dir").val("...");
                        $("#bairro_dir").val("...");
                        $("#cidade_dir").val("...");
                        $("#uf_dir").val("...");
                        $("#ibge").val("...");

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#end_dir").val(dados.logradouro.toUpperCase());
                                $("#bairro_dir").val(dados.bairro.toUpperCase());
                                $("#cidade_dir").val(dados.localidade.toUpperCase());
                                $("#uf_dir").val(dados.uf.toUpperCase());
                                $("#ibge").val(dados.ibge);
                            } //end if.
                            else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulário_cep();
                                alert("CEP não encontrado.");
                            }
                        });
                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulário_cep();
                        alert("Formato de CEP inválido.");
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep();
                }
            });
        });
		
		
		$(document).ready(function() {

            function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#endereco").val("");
                $("#bairro").val("");
                $("#cidade").val("");
                $("#uf").val("");
                $("#ibge").val("");
            }
            
            //Quando o campo cep perde o foco.
            $("#cep").blur(function() {

                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if(validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#endereco").val("...");
                        $("#bairro").val("...");
                        $("#cidade").val("...");
                        $("#uf").val("...");
                        $("#ibge").val("...");

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#endereco").val(dados.logradouro.toUpperCase());
                                $("#bairro").val(dados.bairro.toUpperCase());
                                $("#cidade").val(dados.localidade.toUpperCase());
                                $("#uf").val(dados.uf.toUpperCase());
                                $("#ibge").val(dados.ibge);
                            } //end if.
                            else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulário_cep();
                                alert("CEP não encontrado.");
                            }
                        });
                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulário_cep();
                        alert("Formato de CEP inválido.");
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep();
                }
            });
        });
		
		
	// a função principal de validação
function validar(obj) { // recebe um objeto
	var s = (obj.value).replace(/\D/g,'');
	var tam=(s).length; // removendo os caracteres não numéricos
	if (!(tam==11 || tam==14)){ // validando o tamanho
		document.getElementById('ok').style.visibility = 'collapse';
			document.getElementById('remove').style.visibility = 'visible';
		//alert("'"+s+"' Não é um CPF ou um CNPJ válido!" ); // tamanho inválido
		return false;
	}
	
// se for CPF
	if (tam==11 ){
		if (!validaCPF(s)){ // chama a função que valida o CPF
			document.getElementById('ok').style.visibility = 'collapse';
			document.getElementById('remove').style.visibility = 'visible';
			//alert("'"+s+"' Não é um CPF válido!" ); // se quiser mostrar o erro
			//obj.select();  // se quiser selecionar o campo em questão
			return false;
		}
		document.getElementById('ok').style.visibility = 'visible';
		document.getElementById('remove').style.visibility = 'collapse';
		//alert("'"+s+"' É um CPF válido!" ); // se quiser mostrar que validou		
		obj.value=maskCPF(s);	// se validou o CPF mascaramos corretamente
		return true;
	}
	
// se for CNPJ			
	if (tam==14){
		if(!validaCNPJ(s)){ // chama a função que valida o CNPJ
			document.getElementById('ok').style.visibility = 'collapse';
			document.getElementById('remove').style.visibility = 'visible';
			//alert("'"+s+"' Não é um CNPJ válido!" ); // se quiser mostrar o erro
			//obj.select();	// se quiser selecionar o campo enviado
			return false;			
		}
		document.getElementById('ok').style.visibility = 'visible';
		document.getElementById('remove').style.visibility = 'collapse';
		//alert("'"+s+"' É um CNPJ válido!" ); // se quiser mostrar que validou				
		obj.value=maskCNPJ(s);	// se validou o CNPJ mascaramos corretamente
		return true;
	}
}
// fim da funcao validar()

// função que valida CPF
// O algorítimo de validação de CPF é baseado em cálculos
// para o dígito verificador (os dois últimos)
// Não entrarei em detalhes de como funciona
function validaCPF(s) {
	var c = s.substr(0,9);
	var dv = s.substr(9,2);
	var d1 = 0;
	for (var i=0; i<9; i++) {
		d1 += c.charAt(i)*(10-i);
 	}
	if (d1 == 0) return false;
	d1 = 11 - (d1 % 11);
	if (d1 > 9) d1 = 0;
	if (dv.charAt(0) != d1){
		return false;
	}
	d1 *= 2;
	for (var i = 0; i < 9; i++)	{
 		d1 += c.charAt(i)*(11-i);
	}
	d1 = 11 - (d1 % 11);
	if (d1 > 9) d1 = 0;
	if (dv.charAt(1) != d1){
		return false;
	}
    return true;
}

// Função que valida CNPJ
// O algorítimo de validação de CNPJ é baseado em cálculos
// para o dígito verificador (os dois últimos)
// Não entrarei em detalhes de como funciona
function validaCNPJ(CNPJ) {
	var a = new Array();
	var b = new Number;
	var c = [6,5,4,3,2,9,8,7,6,5,4,3,2];
	for (i=0; i<12; i++){
		a[i] = CNPJ.charAt(i);
		b += a[i] * c[i+1];
	}
	if ((x = b % 11) < 2) { a[12] = 0 } else { a[12] = 11-x }
	b = 0;
	for (y=0; y<13; y++) {
		b += (a[y] * c[y]);
	}
	if ((x = b % 11) < 2) { a[13] = 0; } else { a[13] = 11-x; }
	if ((CNPJ.charAt(12) != a[12]) || (CNPJ.charAt(13) != a[13])){
		return false;
	}
	return true;
}


	// Função que permite apenas teclas numéricas
	// Deve ser chamada no evento onKeyPress desta forma
	// return (soNums(event));
function soNums(e)
{
	if (document.all){var evt=event.keyCode;}
	else{var evt = e.charCode;}
	if (evt <20 || (evt >47 && evt<58)){return true;}
	return false;
}

//	função que mascara o CPF
function maskCPF(CPF){
	return CPF.substring(0,3)+"."+CPF.substring(3,6)+"."+CPF.substring(6,9)+"-"+CPF.substring(9,11);
}

//	função que mascara o CNPJ
function maskCNPJ(CNPJ){
	return CNPJ.substring(0,2)+"."+CNPJ.substring(2,5)+"."+CNPJ.substring(5,8)+"/"+CNPJ.substring(8,12)+"-"+CNPJ.substring(12,14);	
}	

    </script>

<?php 

	function datas($dado){
		$data = explode("/", $dado);
		$dia = $data[0];
		$mes = $data[1];
		$ano = $data[2];
		
		$resultado = $ano."-".$mes."-".$dia;
		return $resultado;	
	}
	
	
include "../classes/conexao.php";
include "../classes/funcoes.class.php";

if(isset($_POST['update'])){

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
            $foto_pres = ", foto_pres = '".$destino."'";
        } 
        else {
                
            echo 'Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita.<br />';
        }
    }
    else {
        echo 'Você poderá enviar apenas arquivos "*.jpg;*.jpeg;*.gif;*.png"<br />';
    }
}
else {
    $foto_pres = '';
}
	

	// verifica se foi enviado um arquivo
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
            $foto_dir = ", foto_dir = '".$destino."'";
        } 
        else {        
            echo 'Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita.<br />';
        }
    }
    else {
        echo 'Você poderá enviar apenas arquivos "*.jpg;*.jpeg;*.gif;*.png"<br />';
    }
} else {
    $foto_dir = '';
}


	// verifica se foi enviado um arquivo
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
            $assinatura = ", assinatura = '".$destino."'";
        } 
        else {        
            echo 'Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita.<br />';
        }
    }
    else {
        echo 'Você poderá enviar apenas arquivos "*.jpg;*.jpeg;*.gif;*.png"<br />';
    }
} else {
    $assinatura = '';
}
	
	$id 			= $_GET['id'];
	$id_grupo		= $_POST['id_grupo'];
	$nome 			= addslashes($_POST['nome']);
	$cpfcnpj 		= $_POST['cpfcnpj'];
	$nascimento		= datas($_POST['nascimento']);
	$valor			= $_POST['valor'];
	$rg				= $_POST['rg'];
	$inscricao		= formataDataInscricao($_POST['inscricao']);
	$endereco		= $_POST['endereco'];
	$nome 			= $_POST['nome'];
	$numero 		= $_POST['numero'];
	$complemento    = $_POST['complemento'];
	$bairro 		= $_POST['bairro'];
	$cidade 		= $_POST['cidade'];
	$uf				= $_POST['uf'];
	$telefone 		= $_POST['telefone'];
	$cep			= $_POST['cep'];
	$uf				= $_POST['uf'];
	$email			= $_POST['emails'];
	$obs			= addslashes($_POST['texto']);
	$bloqueado		= $_POST['bloqueado'];
	$matricula		= $_POST['matricula'];
	$celular		= $_POST['celular'];
	$entrega		= $_POST['entrega'];
	$situacao		= $_POST['situacao'];
	$centro 		= addslashes($_POST['centro']);
	$dir_culto		= addslashes($_POST['dir_culto']);
	$end_dir		= $_POST['end_dir'];
	$bairro_dir		= $_POST['bairro_dir'];
	$cep_dir		= $_POST['cep_dir'];
	$numero_dir		= $_POST['numero_dir'];
	$complemento_dir = $_POST['complemento_dir'];
	$uf_dir			= $_POST['uf_dir'];
	$cidade_dir		= $_POST['cidade_dir'];
	$corretor		= $_POST['corretor'];
	$venc  			= $_POST['venc'];
	$impresso		= $_POST['impresso'];
	$valor_anual    = $_POST['valor_anual'];
	$cnpj   		= $_POST['cnpj'];
	$valor_doc		= $_POST['valor_doc'];
	$filiacao_pai	= addslashes($_POST['filiacao_pai']);
	$filiacao_mae	= addslashes($_POST['filiacao_mae']);
	$naturalidade	= $_POST['naturalidade'];
    $celular2		= $_POST['celular2'];
    $cpf_pres       = $_POST['cpf_pres'];
	$rg_pres   		= $_POST['rg_pres'];
	$nasc_pres		= datas($_POST['nasc_pres']);
	$filiacaopai_pres	= addslashes($_POST['filiacaopai_pres']);
	$filiacaomae_pres	= addslashes($_POST['filiacaomae_pres']);
	$natural_pres	= $_POST['natural_pres'];
	$estadocivil	= $_POST['estadocivil'];
    $estadocivil_pres	= $_POST['estadocivil_pres'];
    $profissao	    = $_POST['profissao'];
    $profissao_pres	= $_POST['profissao_pres'];
    $subnick		= $_POST['subnick'];
    $senha			= $_POST['senha'];
    $obs_pres		= addslashes($_POST['obs_pres']);
	$email2			= $_POST['email2'];
	$rec_doc			= $_POST['rec_doc'];
	$pago_doc			= $_POST['pago_doc'];
	$data_doc			= $_POST['data_doc'];
	$linha_trab			= addslashes($_POST['linha_trab']);
	$iniciado			= $_POST['iniciado'];
	$feitura			= $_POST['feitura'];
	$nacao			= addslashes($_POST['nacao']);
	$obrig_feita			= addslashes($_POST['obrig_feita']);
		
	$responsavel	= $_POST['responsavel'];
  
$sql = mysql_query("UPDATE cliente SET id_grupo='$id_grupo', nome='$nome', cpfcnpj='$cpfcnpj', nascimento = '$nascimento', valor = '$valor',inscricao='$inscricao', valor_anual='$valor_anual', rg='$rg', endereco='$endereco', numero='$numero', complemento='$complemento', bairro='$bairro', cidade='$cidade', uf='$uf', telefone='$telefone', cep='$cep', email='$email', obs='$obs', bloqueado='$bloqueado', matricula='$matricula', celular='$celular', celular2='$celular2', entrega='$entrega', situacao='$situacao', centro='$centro', dir_culto='$dir_culto', end_dir='$end_dir', bairro_dir='$bairro_dir', cep_dir='$cep_dir', numero_dir='$numero_dir', complemento_dir='$complemento_dir', cidade_dir='$cidade_dir', uf_dir='$uf_dir', corretor='$corretor', venc='$venc', impresso='$impresso', cnpj='$cnpj', valor_doc='$valor_doc', filiacao_pai='$filiacao_pai', filiacao_mae='$filiacao_mae', naturalidade='$naturalidade', filiacaopai_pres ='$filiacaopai_pres', filiacaomae_pres ='$filiacaomae_pres', natural_pres='$natural_pres', cpf_pres ='$cpf_pres', rg_pres ='$rg_pres', nasc_pres ='$nasc_pres', natural_pres='$natural_pres', estadocivil_pres='$estadocivil_pres', estadocivil='$estadocivil', profissao ='$profissao', subnick ='$subnick', senha ='$senha', obs_pres ='$obs_pres', profissao_pres ='$profissao_pres', email2='$email2', rec_doc='$rec_doc', data_doc='$data_doc', pago_doc='$pago_doc', linha_trab='$linha_trab', iniciado='$iniciado', feitura='$feitura', nacao='$nacao', obrig_feita='$obrig_feita', 

responsavel = '$responsavel'
"
.$foto_pres.$foto_dir.$assinatura.

"
 WHERE id_cliente='$id'") or die (mysql_error());

	/*if($sql == 1){
		print "<script type=\"text/javascript\">javascript:window.close()</script>";		
	}
	*/
}

///////////////////////////////////////ESTORNAR MENSALIDADE
if(isset($_GET['estornar'])){
	
	 $id = $_GET['id'];
	 $mes = $_GET['m'];
	 $ano = $_GET['a'];
	//$data = date('Y-m-d');
	//$n_fatura = $_POST['n_fatura'];
	
	$sql1 = mysql_query("UPDATE `ref_mensalidade` SET situacao='0', n_fatura = '0', data_pagamento = '0' WHERE (id_cliente = '$id' AND mes = '$mes' AND ano = '$ano')")or die (mysql_error());
	$mesa = getMesAbr($mes);
	$sql2 = mysql_query("UPDATE `mensalidades` SET ".$mesa."='0' WHERE (id_cliente = '$id' AND ano = '$ano')")or die (mysql_error());
		
		if($sql1 && $sql2){/// SE CADASTRADO, ENVIA MENSAGEM INFORMANDO
			print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=editacliente.php?id=$id&p=1'>
			<script type=\"text/javascript\">
			alert(\"MENSALIDADE ESTORNADA COM SUCESSO!\");
			</script>";
	} else { /// SE SIM ENVIA MENSAGEM E RETORNA PARA  A PÁGINA
		print"<META HTTP-EQUIV=REFRESH CONTENT='0; URL=?pg=listaclientes&id=$id&m=$sqla'>
			<script type=\"text/javascript\">
			alert(\"NÃO FOI POSSÍVEL ESTORNAR A MENSALIDADE!\");
			</script>";	
		}
	
}


/////////////////////////////////////////////////////////////////////////////////////////////////////
	$id = $_GET['id'];
	$incompleto = $_GET['i'];
	$pagina = $_GET['p'];
	$sql = mysql_query("SELECT * FROM cliente WHERE id_cliente='$id'")or die (mysql_error());
	$l = mysql_fetch_array($sql);
?>
<body onunload="fechajanela(<?php if ($incompleto == '1') echo 1?>, <?php echo $pagina ; ?>)">
<div id="conteudoform" style="padding:5px;background:#FFF;">
<fieldset style="border:1px solid #666;"><legend><strong>EDITAR CADASTRO DOS CLIENTES</strong></legend>

<form action="" method="POST" enctype="multipart/form-data" id="clientes" name="clientes" onSubmit="return validar_nascimento(this);">

<div style="width:1000px;border:none;">
	
   <div class="linha">
    <b>RESPONSÁVEL PELO BOLETO</b>&nbsp;&nbsp;&nbsp;
    <input name="responsavel" type="radio" id="responsavel" value="CPF" <?php if($l['responsavel']=='CPF'){echo "checked=\"checked\"";} ?>> CPF
    <input name="responsavel" type="radio" id="responsavel" value="CNPJ" <?php if($l['responsavel']=='CNPJ'){echo "checked=\"checked\"";} ?>> CNPJ
    

    <input name="update" type="submit" value="Atualizar" class="btn btn-success ewButton" style="float:right; margin-left:5px;">

    <a href="contrato.php?id=<?php echo $id ?>" style="text-decoration:none;float: right;" 
            class="btn btn-default" title="Contrato" target="_blank">Contrato
    </a>
    
   </div>
 
  
     <b>&nbsp;&nbsp;&nbsp;&nbsp;DADOS DO CENTRO / TERREIRO</b>
     <div class="linha"><hr /></div>
     <div class="coluna" style="width:85px;">Matrícula:<br/>
    <input name="matricula" onkeyup="up(this)" type="text" style="width:65px;" value="<?php echo $l['matricula'] ?>">
    </div>
     <div class="coluna" style="width:715px;">Nome do Centro / Terreiro :<br/><input name="centro" onkeyup="up(this)" type="text" size="43" style="width:695px;" value="<?php echo $l['centro'] ?>"></div>
     <div class="coluna" style="width:200px;">Linha de Trabalho:<br/>
    		<input name="linha_trab" type="text" onkeyup="up(this)" style="width:180px;" value="<?php echo $l['linha_trab'] ?>" id="linha_trab">
    </div>
     
    <div class="linha"></div>
    <div class="coluna" style="width:200px;">CNPJ:<br/>
    		<input name="cnpj" type="text" maxlength="18" style="width:180px;" value="<?php echo $l['cnpj'] ?>" id="cnpj">
    </div>
        <div class="coluna" style="width:240px">Grupo:<br/>
      <select name="id_grupo" style="width:230px;">
       <?php 
		$confi = mysql_query("SELECT * FROM cliente WHERE id_cliente='$id'")or die (mysql_error());
		$confere = mysql_fetch_array($confi);
		$idss = $confere['id_grupo'];
		
		$sql1 = mysql_query("SELECT * FROM grupo WHERE id_grupo !='1' ORDER BY meses ASC")or die (mysql_error());
		while($ver = mysql_fetch_array($sql1)){
			$id_g= $ver['id_grupo'];
			$nomegrupo = $ver['nomegrupo'];
			
		?>
        <option value="<?php echo $ver['id_grupo'] ?>" <?php if(!(strcmp($id_g, $idss))) {echo "selected=\"selected\"";} ?>>
						<?php echo $nomegrupo; echo " - Vencimento dia:".$ver['dia'];?></option>
        <?php } ?>
      </select>
    </div>
	<div class="coluna" style="width:90px;">
		  <script src="../js/jquery-1.10.2.js"></script>
 		 <script type="text/javascript" src="../js/jquery.mask-money.js"></script>
		  <script type="text/javascript">		
			$(document).ready(function() {
  		      $("#valor_doc").maskMoney({decimal:".",thousands:""});
  		    });
		</script>
     </div>
     <div class="coluna" style="width:160px">Admissão:<br/>
    <input name="inscricao" type="text" style="width:140px" value="<?php echo exibeDataInscricao($l['inscricao']); ?>" id="inscricao">
    </div>
    <div class="coluna" style="width:180px;">Situação:<br/>
    <select name="situacao" style="width:170px;">
     <option value="<?php echo $l['situacao'] ?>" selected><?php echo getSituacao($l['situacao']); ?></option>
    	<option value="V">VIVO</option>
	    <option value="M">MORTO</option>
    	<option value="A">AGUARDAR</option>
	    <option value="I">ISENTO</option>
    </select>
     </div>
    <div class="coluna" style="width:110px;">
 	 <script src="../js/jquery-1.10.2.js"></script>
  	  <script type="text/javascript" src="../js/jquery.mask-money.js"></script>
 		<script type="text/javascript">		
			$(document).ready(function() {
   			     $("#valor").maskMoney({decimal:".",thousands:""});
   			   });
		</script>
      Valor Mensal:<br/>
      <input name="valor" type="text" id="valor" style="text-align:right; width:90px;" value="<?php echo $l['valor']; ?>" maxlength="10">
     </div>
     <div class="coluna" style="width:110px;">
		  <script src="../js/jquery-1.10.2.js"></script>
 		 <script type="text/javascript" src="../js/jquery.mask-money.js"></script>
		  <script type="text/javascript">		
			$(document).ready(function() {
  		      $("#valor_anual").maskMoney({decimal:".",thousands:""});
  		    });
		</script>
      Valor Anual:<br/>
      <input name="valor_anual" type="text" id="valor_anual" style="text-align:right; width:90px;" value="<?php echo $l['valor_anual']; ?>" maxlength="10">
     </div>
     <div class="linha"></div>
     <div class="coluna" style="width:285px;">E-mail Principal:<br/>
    <input name="emails" type="email" style="width:265px;" onkeyup="down(this)" value="<?php echo $l['email'] ?>">
    </div>
    <div class="coluna" style="width:285px;">E-mail Secundário:<br/>
    		<input name="email2" type="email" style="width:265px;" onkeyup="down(this)" value="<?php echo $l['email2'] ?>">
    </div>
    <div class="coluna" style="width:285px;">Corretor:<br/><input name="corretor" onkeyup="up(this)" type="text" style="width:265px;" value="<?php echo $l['corretor'] ?>">
    </div>
    <div class="coluna" style="width:140px;">Entrega pelo:<br/>
    <input name="entrega" type="radio" id="entrega" value="CORREIO" <?php if($l['entrega']=='CORREIO'){echo "checked=\"checked\"";} ?> > CORREIO
    <input name="entrega" type="radio" id="entrega" value="EMAIL" <?php if($l['entrega']=='EMAIL'){echo "checked=\"checked\"";} ?> > E-MAIL
    </div>
     
        <div class="linha"></div>
    <div class="coluna" style="width:130px">Telefone:<br/>
   		 <input name="telefone" type="text" style="width:110px" id="telefone" value="<?php echo $l['telefone'] ?>">
    </div>
    <div class="coluna" style="width:130px">Celular 1:<br/>
  		  <input name="celular" type="text" style="width:110px" id="celular" value="<?php echo $l['celular'] ?>">
    </div>
    <div class="coluna" style="width:130px">Celular 2:<br/>
  		  <input name="celular2" type="text" style="width:110px" id="celular2" value="<?php echo $l['celular2'] ?>">
    </div>
    
     <div class="coluna" style="width:130px">Valor Documento:<br/>
     <input name="valor_doc" type="text" id="valor_doc" style="text-align:right; width:110px;" onkeyup="up(this)" value="<?php echo $l['valor_doc']; ?>" maxlength="10">
     </div>
     
     <div class="coluna" style="width:130px">Nº Recibo Pago:<br/>
     <input name="rec_doc" type="text" id="rec_doc" style="text-align:right; width:110px;" onkeyup="up(this)" value="<?php echo $l['rec_doc']; ?>">
     </div>
     <div class="coluna" style="width:130px">Data de Pagamento:<br/>
     <input name="data_doc" type="text" id="data_doc" style="text-align:left; width:110px;" onkeyup="up(this)" value="<?php echo $l['data_doc']; ?>" maxlength="10">
     </div>
     
     <div class="coluna" style="width:220px">Pagou à quem:<br/>
     <input name="pago_doc" type="text" id="pago_doc" onkeyup="up(this)" style="text-align:left; width:200px;" value="<?php echo $l['pago_doc']; ?>">
     </div>
     
     
     
    <div class="linha"></div>
    
    
    <div class="linha"></div>
     <b>&nbsp;&nbsp;&nbsp;&nbsp;DADOS DO PRESIDENTE DO CENTRO / TERREIRO</b>
    <div class="linha"><hr /></div>


    <div class="linha">
    	<div class="coluna" style="width:110px;">
    		<img src="<?php echo $l['foto_pres']; ?>" style="width:100px; height: 100px; border: 1px solid;">


            <a class="btn btn-default"
            href="javascript:confirmar_foto('?deleta=foto_pres&id=<?php echo $l['id_cliente'] ?>',<?php echo $l['id_cliente'] ?>)"
             style="text-decoration:none;" title="Excluir foto"> 
           <i class="icon-trash"></i></a>



    	</div>

    	 <div class="coluna" style="width:800px;">
    		<div class="linha">
    			<div class="coluna" style="width:480px;">Presidente do Centro / Terreiro:<br/>
			     	<input name="nome" onkeyup="up(this)" type="text" size="48" onkeyup="up(this)" style="width:460px;" value="<?php echo $l['nome'] ?>"></div>
			    <div class="coluna" style="width:270px">Obs. para Presidente / 2º Diretor(a) Espirital:<br/>
			    	<input name="obs_pres" type="text" style="width:250px" value="<?php echo $l['obs_pres'] ?>" id="obs_pres" onkeyup="up(this)">
			    </div>
			    <div class="coluna" style="width:130px;"> Nascimento:
			      	<input name="nasc_pres"  type="text" id="nasc_pres" style="width:110px;"  value="<?php echo exibeData($l['nasc_pres']); ?>">
			    </div>
    		</div>

    		<div class="linha">
    			
				 	<div class="coluna" style="width:120px;">CPF:<?php if (validaCPF($l['cpf_pres'])){ 
				    	echo "<i class='icon-ok' style='color:green;width:40px;'></i>";
				    	}else{echo "<i class='icon-remove' style='color:red;width:40px;'></i>
				    	<span class='avisos'>CPF inválido!</span>
				    	";} ?>
				    	<input name="cpf_pres" type="text" maxlength="18" style="width:100px;" value="<?php echo $l['cpf_pres'] ?>" id="cpf_pres">
				    </div>
				    <div class="coluna" style="width:170px;">RG e Órgão Exp.:<br/>
				    	<input name="rg_pres" type="text" style="width:150px;" value="<?php echo $l['rg_pres'] ?>" onkeyup="up(this)">
				    </div>
				    <div class="coluna" style="width:200px">Naturalidade:<br/>
				    	<input name="natural_pres" type="text" style="width:180px" value="<?php echo $l['natural_pres'] ?>" id="natural_pres" onkeyup="up(this)">
				    </div>
				    <div class="coluna" style="width:245px">Profissão:<br/>
				    	<input name="profissao_pres" type="text" style="width:225px" value="<?php echo $l['profissao_pres'] ?>" id="profissao_pres" onkeyup="up(this)">
				    </div>
				    <div class="coluna" style="width:145px">Estado Civil:<br/>
						<select name="estadocivil_pres" style="width:140px;" id="estadocivil_pres">
				            <option value="<?php echo $l['estadocivil_pres'] ?>" selected><?php echo getEstadoCivil($l['estadocivil_pres']); ?></option>
				            
				            <option value="SOLTEIRO">Solteiro (a)</option>
				            <option value="CASADO">Casado (a)</option>
				            <option value="VIUVO">Viúvo (a)</option>
				            <option value="DIVORCIADO">Divorciado (a)</option>
				            <option value="UNIAO">União Estável</option>
				            <option value="OUTROS">Outros</option>
				            <option value="NAO">Não Consta Informação</option>
				        </select>
				    </div>
				
    		</div>


    	</div>	
    </div>

    <div class="coluna" style="width:260px;">Foto do Presidente:<br/>

    	<input name="foto_pres" type="file" style="width:240px;" />

    </div>

    <div class="coluna" style="width:370px;">Pai:<br/><input name="filiacaopai_pres" onkeyup="up(this)" type="text" size="43" style="width:350px;" value="<?php echo $l['filiacaopai_pres'] ?>"></div>
	<div class="coluna" style="width:370px;">Mãe:<br/><input name="filiacaomae_pres" onkeyup="up(this)" type="text" size="43" style="width:350px;" value="<?php echo $l['filiacaomae_pres'] ?>"></div>
	
	<div class="linha"></div>     
	<div class="linha">
	     <b>&nbsp;&nbsp;&nbsp;&nbsp;DADOS DO DIRETOR (A) DE ESPIRITUAL</b>
	<div class="linha"><hr /></div>
    
<div class="linha">
        <div class="coluna" style="width:110px;">
            <img src="<?php echo $l['foto_dir']; ?>" style="width:100px; height: 100px; border: 1px solid;">
        

        <a class="btn btn-default"
            href="javascript:confirmar_foto('?deleta=foto_dir&id=<?php echo $l['id_cliente'] ?>',<?php echo $l['id_cliente'] ?>)"
             style="text-decoration:none;" title="Excluir foto"> 
           <i class="icon-trash"></i></a>
        </div>
	<div class="coluna" style="width:800px;">
    
		<div class="linha">	   
			    
			    <div class="coluna" style="width:480px;">Diretor(a) Espiritual do Centro / Terreiro:<br/>
			    	<input name="dir_culto" type="text" style="width:460px;" value="<?php echo $l['dir_culto']; ?>" onkeyup="up(this)">
			    </div>
			    <div class="coluna" style="width:270px;">Como conhecido? / Digina:<br/>
			    	<input name="subnick" type="text" style="width:250px;" value="<?php echo $l['subnick']; ?>" onkeyup="up(this)">
			    </div>
			    <div class="coluna" style="width:130px;"> Nascimento:
			      <input name="nascimento"  type="text" id="nascimento" style="width:110px;"  value="<?php echo exibeData($l['nascimento']); ?>">
			    </div>
		</div>
		<div class="linha">
			     
			<div class="coluna" style="width:120px;">CPF:<?php if (validaCPF($l['cpfcnpj'])){ 
			    	echo "<i class='icon-ok' style='color:green;width:40px;'></i>";
			    	}else{echo "<i class='icon-remove' style='color:red;width:40px;'></i>
			    <span class='avisos'>CPF inválido!</span>
			    ";} ?>
			    <input name="cpfcnpj" type="text" maxlength="18" style="width:100px;" value="<?php echo $l['cpfcnpj'] ?>" id="cpf-cnpj">
			</div>
			<div class="coluna" style="width:170px;">RG e Órgão Exp.:<br/><input name="rg" type="text" style="width:150px;" value="<?php echo $l['rg'] ?>" onkeyup="up(this)">
			</div>
			<div class="coluna" style="width:200px">Naturalidade:<br/>
			    <input name="naturalidade" type="text" style="width:180px" value="<?php echo $l['naturalidade'] ?>" id="naturalidade" onkeyup="up(this)">
			</div>
			<div class="coluna" style="width:245px">Profissão:<br/>
			    <input name="profissao" type="text" style="width:225px" value="<?php echo $l['profissao'] ?>" id="profissao" onkeyup="up(this)">
			</div>
			<div class="coluna" style="width:145px">Estado Civil:<br/>
				<select name="estadocivil" style="width:140px;" id="estadocivil">
			        <option value="<?php echo $l['estadocivil'] ?>" selected><?php echo getEstadoCivil($l['estadocivil']) ?></option>
			            
			        <option value="SOLTEIRO">Solteiro (a)</option>
			        <option value="CASADO">Casado (a)</option>
			        <option value="VIUVO">Viúvo (a)</option>
			        <option value="DIVORCIADO">Divorciado (a)</option>
			        <option value="UNIAO">União Estável</option>
			        <option value="OUTROS">Outros</option>
			        <option value="NAO">Não Consta Informação</option>
			        
			    </select>
			</div>
		</div>
	</div>		
    
    <div class="linha"></div>
    
    	<div class="coluna" style="width:260px;">Foto do Diretor Espiritual:<br/>

    		<input name="foto_dir" type="file" style="width:240px;" />

    	</div>

        <div class="coluna" style="width:370px;">Pai:<br/><input name="filiacao_pai" onkeyup="up(this)" type="text" size="43" style="width:350px;" value="<?php echo $l['filiacao_pai'] ?>"></div>
 	<div class="coluna" style="width:370px;">Mãe:<br/><input name="filiacao_mae" onkeyup="up(this)" type="text" size="43" style="width:350px;" value="<?php echo $l['filiacao_mae'] ?>"></div>
      </div>
     
     <div class="coluna" style="width:130px">Iniciado em:<br/>
    <input name="iniciado" type="text" style="width:110px" value="<?php echo $l['iniciado'] ?>" id="iniciado" onkeyup="up(this)">
    </div>
    <div class="coluna" style="width:130px">Feitura em:<br/>
    <input name="feitura" type="text" style="width:110px" value="<?php echo $l['feitura'] ?>" id="feitura" onkeyup="up(this)">
    </div>
    <div class="coluna" style="width:305px">Na Nação de:<br/>
    <input name="nacao" type="text" style="width:285px" value="<?php echo $l['nacao'] ?>" id="nacao" onkeyup="up(this)">
    </div>
    <div class="coluna" style="width:425px">Obrigações Feitas:<br/>
    <input name="obrig_feita" type="text" style="width:410px" value="<?php echo $l['obrig_feita'] ?>" id="obrig_feita" onkeyup="up(this)">
    </div>
  <div class="linha"></div>
   <b>&nbsp;&nbsp;&nbsp;&nbsp;ENDEREÇO DO CENTRO</b>
  <div class="linha"><hr /></div>
  <div class="linha">
    <div class="coluna" style="width:130px;">CEP do Centro:<br/>
    <input name="clientegr" type="hidden" value="clientegr">
    <input name="cep_dir" type="text" size="9" id="cep_dir" style="width:110px;" value="<?php echo $l['cep_dir'] ?>"></div>
    <div class="coluna" style="width:480px;">Endereço do Centro:<br/><input name="end_dir" type="text" onkeyup="up(this)" style="width:460px;" value="<?php echo $l['end_dir'] ?>" id="end_dir"></div>
    <div class="coluna" style="width:70px;">Número:<br/><input name="numero_dir" type="text" onkeyup="up(this)" size="10" maxlength="10" style="width:50px;" value="<?php echo $l['numero_dir'] ?>"></div>
    <div class="coluna" style="width:310px;">Complemento do Centro:<br/><input name="complemento_dir" onkeyup="up(this)" type="text" style="width:290px;" value="<?php echo $l['complemento_dir'] ?>" id="complemento_dir"></div>
  </div>
  <div class="linha">
    <div class="coluna" style="width:460px;">Bairro do Centro:<br/><input name="bairro_dir" onkeyup="up(this)" type="text" size="43"style="width:440px;" value="<?php echo $l['bairro_dir'] ?>" id="bairro_dir"></div>
    <div class="coluna" style="width:460px;">Cidade do Centro:<br/><input name="cidade_dir" onkeyup="up(this)" type="text" style="width:440px;" value="<?php echo $l['cidade_dir'] ?>" id="cidade_dir"></div>
    <div class="coluna" style="width:65px;">UF:<br/><input name="uf_dir" type="text" onkeyup="up(this)" size="2" maxlength="2" style="width:45px;" value="<?php echo $l['uf_dir'] ?>" id="uf_dir"></div>
    
    <div class="linha"></div>
    
    <b>&nbsp;&nbsp;&nbsp;&nbsp;ENDEREÇO DE CORRESPONDÊNCIA</b>
    <div class="linha"><hr /></div>
  <div class="linha">
  
   <div class="linha">
       <div class="coluna" style="width:130px;">CEP:<br/>
    <input name="clientegr" type="hidden" value="clientegr">
    <input name="cep" type="text" size="9" id="cep" style="width:110px;" value="<?php echo $l['cep'] ?>"></div>
    <div class="coluna" style="width:480px;">Endereço de Correspondência:<br/><input name="endereco" type="text" onkeyup="up(this)" style="width:460px;" value="<?php echo $l['endereco'] ?>" id="endereco"></div>
    <div class="coluna" style="width:70px;">Número:<br/><input name="numero" type="text" onkeyup="up(this)" size="10" maxlength="10" style="width:50px;"value="<?php echo $l['numero'] ?>"></div>
    <div class="coluna" style="width:310px;">Complemento:<br/><input name="complemento" onkeyup="up(this)" type="text" style="width:290px;" value="<?php echo $l['complemento'] ?>"></div>
  </div>
  
    <div class="coluna" style="width:460px;">Bairro:<br/><input name="bairro" onkeyup="up(this)" type="text" size="43"style="width:440px;" value="<?php echo $l['bairro'] ?>" id="bairro" ></div>
    <div class="coluna" style="width:460px;">Cidade:<br/><input name="cidade" onkeyup="up(this)" type="text" style="width:440px;" value="<?php echo $l['cidade'] ?>" id="cidade"></div>
    <div class="coluna" style="width:65px;">UF:<br/><input name="uf" type="text" onkeyup="up(this)" size="2" maxlength="2" style="width:45px;" value="<?php echo $l['uf'] ?>" id='uf'></div>
    
    
  </div>
	    
  <b>&nbsp;&nbsp;&nbsp;&nbsp;OBSERVAÇÕES</b>
  <div class="linha"><hr /></div>
    <div class="coluna" style="width:990px;">
    <textarea name="texto" rows="3" style="width:100%;" ><?php echo $l['obs']; ?></textarea>
    </div>
  </div>
  <div class="linha"></div>
  <div class="linha">
    <div class="coluna" style="width:350px;">
    <input name="update" type="submit" value="Atualizar" class="btn btn-success ewButton">
    </div>
  </div>
<div class="linha"></div>
  <b>&nbsp;&nbsp;&nbsp;&nbsp;SENHA ÁREA DO CLIENTE</b>
    <div class="linha"><hr /></div>
    <div class="coluna" style="width:250px;">Senha Cadastrada:<br/><input name="senha"  type="text" size="43"style="width:230px;" value="<?php echo $l['senha'] ?>"></div>
  
  <div class="coluna" style="width:500px;">  <fieldset>
      <legend><strong> Senha padrão inicial: "123"&nbsp;</strong></legend>
      <span class="avisos">
        <i>- ATENÇÃO!</i> NÃO MODIFICAR ESTA SENHA. <br>APENAS CONFERÊNCIA DO QUE CONSTA CADASTRADO PELO CLIENTE NO SITE.<br>
  Somente alterar quando o cliente esquecer a senha!</span>
    </fieldset></div>
 
 <div class="linha"></div>
   <b>&nbsp;&nbsp;&nbsp;&nbsp;ASSINATURAS</b>
   <div class="linha"><hr /></div>
     <div class="coluna" style="width:310px;">
            <img src="<?php echo $l['assinatura']; ?>" style="width:300px; height: 100px; border: 1px solid;">
        
    </div>
    <div class="coluna" style="width:50px;">
    <a class="btn btn-default"
            href="javascript:confirmar_foto('?deleta=assinatura&id=<?php echo $l['id_cliente'] ?>',<?php echo $l['id_cliente'] ?>)"
             style="text-decoration:none;" title="Excluir foto"> 
           <i class="icon-trash"></i></a>
     </div>
   <div class="coluna" style="width:280px;">Insira a Assinatura do Diretor(a) Espiritual:<br/>

    	<input name="assinatura" type="file" style="width:240px;" />

    </div>
    
   </div>
 
 
  
</div>
</form>
<div class="linha"><hr /></div>

    <div class="coluna" style="width:900px;"><strong><b>MENSALIDADES</b></strong></div>
  
  <div class="linha"></div>
		<div class="btn-group">
           <a href="gerar_mensalidade.php?id=<?php echo $id ?>&p=<?php echo $pagina ?>&c=1" style="text-decoration:none;" 
            class="btn btn-default" onclick="NovaJanela(this.href,'nomeJanela','800','600','yes');return false" title="Gerar Mensalidades">
            <i class="iconfont fatura"></i> Gerar Mensalidades</a>
  		</div>

<div id="fundo-tabela" style="margin-left:5px;">

<table width="100%" border="0" cellspacing="1" cellpadding="5" data-rowindex="1" data-rowtype="1">
<tbody>
  <tr>
    <td width="5%" bgcolor="#0490fc" align="center"><span class="fontebranca">Ano</span></td>
    <td width="5%" bgcolor="#0490fc" align="center"><span class="fontebranca">Jan</span></td>
    <td width="5%" bgcolor="#0490fc" align="center"><span class="fontebranca">Fev</span></td>
    <td width="5%" bgcolor="#0490fc" align="center"><span class="fontebranca">Mar</span></td>
    <td width="5%" bgcolor="#0490fc" align="center"><span class="fontebranca">Abr</span></td>
    <td width="5%" bgcolor="#0490fc" align="center"><span class="fontebranca">Mai</span></td>
    <td width="5%" bgcolor="#0490fc" align="center"><span class="fontebranca">Jun</span></td>
    <td width="5%" bgcolor="#0490fc" align="center"><span class="fontebranca">Jul</span></td>
    <td width="5%" bgcolor="#0490fc" align="center"><span class="fontebranca">Ago</span></td>
    <td width="5%" bgcolor="#0490fc" align="center"><span class="fontebranca">Set</span></td>
    <td width="5%" bgcolor="#0490fc" align="center"><span class="fontebranca">Out</span></td>
    <td width="5%" bgcolor="#0490fc" align="center"><span class="fontebranca">Nov</span></td>
    <td width="5%" bgcolor="#0490fc" align="center"><span class="fontebranca">Dez</span></td>
    <td width="1%" bgcolor="#0490fc" align="center"><span class="fontebranca"></span></td>
    
    </tr>
</tbody>
   <?php
    $sqlm = mysql_query("SELECT * FROM mensalidades WHERE id_cliente = '$id' ORDER BY ano DESC");
	while($array = mysql_fetch_array($sqlm)){
		$ano = $array['ano'];
		?>
  <tr>
    <td align="center"><?php echo $array['ano']; ?></td>
    <td align="center"><?php echo getSituacaoMensalidade1($array['jan'],1,$ano, $id); ?></td>
    <td align="center"><?php echo getSituacaoMensalidade1($array['fev'],2,$ano, $id); ?></td>
    <td align="center"><?php echo getSituacaoMensalidade1($array['mar'],3,$ano, $id); ?></td>
    <td align="center"><?php echo getSituacaoMensalidade1($array['abr'],4,$ano, $id); ?></td>
    <td align="center"><?php echo getSituacaoMensalidade1($array['mai'],5,$ano, $id); ?></td>
    <td align="center"><?php echo getSituacaoMensalidade1($array['jun'],6,$ano, $id); ?></td>
    <td align="center"><?php echo getSituacaoMensalidade1($array['jul'],7,$ano, $id); ?></td>
    <td align="center"><?php echo getSituacaoMensalidade1($array['ago'],8,$ano, $id); ?></td>
    <td align="center"><?php echo getSituacaoMensalidade1($array['setembro'],9,$ano, $id); ?></td>
    <td align="center"><?php echo getSituacaoMensalidade1($array['outubro'],10,$ano, $id); ?></td>
    <td align="center"><?php echo getSituacaoMensalidade1($array['nov'],11,$ano, $id); ?></td>
    <td align="center"><?php echo getSituacaoMensalidade1($array['dez'],12,$ano, $id); ?></td>
    
    <td align="center"><a href="javascript:deletaMensalidade(<?php echo $id ?>, <?php echo $array['id_mensalidade'] ?>);" title="Excluir">
      <i class="icon-trash icon-2x pull-left icon-border" style="color:#FF0000; text-decoration:none; font-size:12px; margin-left: 10px"></i></a></td>
  </tr>
<?php } ?> 	


</table>  
</div>
</fieldset>
</div>
<script type="text/javascript">

function deletaMensalidade(id, mensalidade){
if (confirm('Tem certeza que deseja excluir?')){
	window.location='editacliente.php?id='+id+'&p=1&mensalidade='+mensalidade;
	return true;
} else {
	window.location='editacliente.php?id='+id+'&p=1';
	return false;
}
}

</script>

</body>
</html>