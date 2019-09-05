<?php 

//se nao existir volta para a pagina do form de login
if(!isset($_SESSION['login_session']) and !isset($_SESSION['senha_session'])){
	header("Location:../index.php");
	exit;		
}

/////////BUSCAR NUMERO DE MATRICULA 
$proxima_matricula = getProximaMatricula();

?>
<style type="text/css">
.linha {
	width:1000px;
	display:table;
	margin-bottom:10px;
	}
.coluna {
	float:left;	
	}
</style>

<script type="text/javascript">
function validar_uni() { //VALIDAÇÂO DOS VALORES DO FORMULÁRIO
var data = new Date();
var ano4 = data.getFullYear();       // 4 dígitos
var dir_culto = form.dir_culto.value;
var cpfcnpj = form.cpfcnpj.value;
var nascimento = form.nascimento.value;
var rg = form.rg.value;
var nome = form.nome.value;
var cpf_pres = form.cpf_pres.value;
var nasc_pres = form.nasc_pres.value;
var rg_pres = form.rg_pres.value;
var endereco = form.endereco.value;
var bairro = form.bairro.value;
var cidade = form.cidade.value;
var uf = form.uf.value;
var cep = form.cep.value;
var end_dir = form.end_dir.value;
var bairro_dir = form.bairro_dir.value;
var cidade_dir = form.cidade_dir.value;
var uf_dir = form.uf_dir.value;
var cep_dir = form.cep_dir.value;
var valor = form.valor.value; 
var valor_anual = form.valor_anual.value; 
var id_grupo = form.id_grupo.value;
var email = form.email.value;

var nascimento_presidente = clientes.nasc_pres.value;

var np = nascimento_presidente.split("/");
var n = nascimento.split("/");

if (dir_culto == "") {	
alert('Digite o nome do Diretor(a) Espiritual.');
form.dir_culto.focus();
return false;
}

if (cpfcnpj == "") {	
alert('Digite o CPF do Diretor(a) Espiritual.');
form.cpfcnpj.focus();
return false;
}

if (nome == "") {	
alert('Digite o nome do Presidente.');
form.nome.focus();
return false;
}

if (cpf_pres == "") {	
alert('Digite o CPF do Presidente.');
form.cpf_pres.focus();
return false;
}

	if (nascimento == "") {	
		alert('Digite a data de nascimento.');
		form.nascimento.focus();
		return false;
	} else if (n[1] > "12") {	
		alert('A data de nascimento do diretor não corresponde a uma data válida');
		form.nascimento.focus();
		return false;
	} else if (n[0] > "31"){
		alert('A data de nascimento do diretor não corresponde a uma data válida');
		form.nascimento.focus();
		return false;
	} else if (n[2] > ano4){
		alert('A data de nascimento do diretor não corresponde a uma data válida');
		form.nascimento.focus();
		return false;
	}

if (rg == "") {	
alert('Digite numero do RG.');
form.rg.focus();
return false;
}

if (rg_pres == "") {	
alert('Digite numero do RG do Presidente.');
form.rg_pres.focus();
return false;
}

if (endereco == "") {	
alert('Digite o endereço de Correspondência.');
form.endereco.focus();
return false;
}

if (cep == "") {	
alert('Digite o CEP de Correspondência.');
form.cep.focus();
return false;
}

if (end_dir == "") {	
alert('Digite o endereço do Centro.');
form.end_dir.focus();
return false;
}

if (cep_dir == "") {	
alert('Digite o CEP  do Centro.');
form.cep_dir.focus();
return false;
}

if (valor == "") {
alert('Digite o valor da cobrança mensal');
form.valor.focus();
return false;
}

if (valor_anual == "") {
alert('Digite o valor da cobrança anual');
form.valor_anual.focus();
return false;
}

if (id_grupo == "0") {
alert('Selecione um grupo para o cliente.');
form.id_grupo.focus();
return false;
}

if (bairro == "") {	
alert('Digite o bairro de Correspondência.');
form.bairro.focus();
return false;
}

if (cidade == "") {	
alert('Digite a cidade de Correspondência.');
form.cidade.focus();
return false;
}

if (uf == "") {	
alert('Digite a UF de Correspondência.');
form.uf.focus();
return false;
}

if (bairro_dir == "") {	
alert('Digite o bairro  do Centro.');
form.bairro_dir.focus();
return false;
}

if (cidade_dir == "") {	
alert('Digite a cidade  do Centro.');
form.cidade_dir.focus();
return false;
}

if (uf_dir == "") {	
alert('Digite a UF  do Centro.');
form.uf_dir.focus();
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
/*
if (email == "") {
alert('Digite o email do cliente.');
form.email.focus();
return false;
}*/

} ////////////// FIM DA FUNCTION /////////////////////
</script>
<script src="js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="js/jquery.mask-money.js"></script>
<script type="text/javascript" src="js/jquery.maskedinput.js"></script>
<script type="text/javascript">
    jQuery(function ($) {
   $("#telefone").mask("(99) 9999-9999");
            $("#cpf-cnpj").mask("999.999.999-99");
            $("#cep").mask("99999-999");
			$("#cep_dir").mask("99999-999");
            $("#cnpj").mask("99.999.999/9999-99");
			$("#nascimento").mask("99/99/9999");
			$("#celular").mask("(99) 99999-9999");
			$("#celular2").mask("(99) 99999-9999");
			$("#inscricao").mask("99/99/9999");
			$("#cpf_pres").mask("999.999.999-99");
			$("#nasc_pres").mask("99/99/9999");
			$("#iniciado").mask("99/99/9999");
			$("#feitura").mask("99/99/9999");
			$("#data_doc").mask("99/99/9999");
        });	
		
function up(lstr){ // converte minusculas em maiusculas
var str=lstr.value; //obtem o valor
lstr.value=str.toUpperCase(); //converte as strings e retorna ao campo
}

function down(lstr){
var str=lstr.value;
lstr.value=str.toLowerCase();
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



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-users"></i> Cadastro de Clientes
      <small>clientes para o controle de mensalidades</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="inicio.php?pg=inicio"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="inicio.php?pg=listaclientessimples"><i class="fa fa-dashboard"></i> Clientes</a></li>
      <li class="active">Cadastro</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">





<div id="entrada">
<div id="cabecalho"><h2><i class="icon-user iconmd"></i> Cadastro de clientes</h2></div>
<div id="forms">

<form action="" method="post" enctype="multipart/form-data" id="gravacliente" name="form" onSubmit="return validar_uni(this);">
<input type="hidden" value="V" name="situacao" id="situacao" />

<div style="width:1100px;border:none;">
  	
    
     <div class="linha">
    <b>RESPONSÁVEL PELO BOLETO</b>&nbsp;&nbsp;&nbsp;
    <input name="responsavel" type="radio" id="responsavel" value="CPF" checked="checked" <?php if($l['responsavel']=='CPF'){echo "checked=\"checked\"";} ?>> CPF
    <input name="responsavel" type="radio" id="responsavel" value="CNPJ" <?php if($l['responsavel']=='CNPJ'){echo "checked=\"checked\"";} ?>> CNPJ
    
    
    </div>
    <div class="linha">
    
     <b>&nbsp;&nbsp;&nbsp;&nbsp;DADOS DO CENTRO / TERREIRO</b>
     <div class="linha"><hr /></div>
     <div class="coluna" style="width:85px;">Matrícula:<br/>
    <input name="matricula" onkeyup="up(this)" type="text" style="width:65px;" value="<?php echo $proxima_matricula?>">
    </div>
     <div class="coluna" style="width:715px;">Nome do Centro / Terreiro :<br/><input name="centro" onkeyup="up(this)" type="text" size="43" style="width:695px;"></div>
     <div class="coluna" style="width:200px;">Linha de Trabalho:<br/>
    		<input name="linha_trab" type="text" onkeyup="up(this)" maxlength="18" style="width:180px;" id="linha_trab">
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
    <input name="inscricao" type="text" style="width:140px" value="<?php echo date('d/m/Y'); ?>" id="inscricao">
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
    <input name="email" type="email" style="width:265px;" onkeyup="down(this)" value="<?php echo $l['email'] ?>">
    </div>
    <div class="coluna" style="width:285px;">E-mail Secundário:<br/>
    		<input name="email2" type="email" style="width:265px;" onkeyup="down(this)" value="<?php echo $l['email2'] ?>">
    </div>
    <div class="coluna" style="width:285px;">Corretor:<br/><input name="corretor" onkeyup="up(this)" type="text" style="width:265px;" value="<?php echo $l['corretor'] ?>">
    </div>
    <div class="coluna" style="width:140px;">Entrega pelo:<br/>
    <input name="entrega" type="radio" id="entrega" value="CORREIO" checked="checked" <?php if($l['entrega']=='CORREIO'){echo "checked=\"checked\"";} ?> > CORREIO
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
     <input name="valor_doc" type="text" id="valor_doc" style="text-align:right; width:110px;" value="<?php echo $l['valor_doc']; ?>" maxlength="10">
     </div>
     
     <div class="coluna" style="width:130px">Nº Recibo Pago:<br/>
     <input name="rec_doc" type="text" id="rec_doc" style="text-align:right; width:110px;" value="<?php echo $l['rec_doc']; ?>" maxlength="10">
     </div>
     <div class="coluna" style="width:130px">Data de Pagamento:<br/>
     <input name="data_doc" type="text" id="data_doc" style="text-align:left; width:110px;" value="<?php echo $l['data_doc']; ?>" maxlength="10">
     </div>
     
     <div class="coluna" style="width:220px">Pagou à quem:<br/>
     <input name="pago_doc" type="text" id="pago_doc" onkeyup="up(this)" style="text-align:left; width:200px;" value="<?php echo $l['pago_doc']; ?>">
     </div>
     
     
     
    <div class="linha"></div>
    
    
    <div class="linha"></div>
     <b>&nbsp;&nbsp;&nbsp;&nbsp;DADOS DO PRESIDENTE DO CENTRO / TERREIRO</b>
     <div class="linha"><hr /></div>
     <div class="coluna" style="width:600px;">Presidente do Centro / Terreiro:<br/>
     <input name="nome" onkeyup="up(this)" type="text" size="48" onkeyup="up(this)" style="width:580px;" value="<?php echo $l['nome'] ?>"></div>
    <div class="coluna" style="width:270px">Obs. para Presidente / 2º Diretor(a) Espirital:<br/>
    <input name="obs_pres" type="text" style="width:250px" value="<?php echo $l['obs_pres'] ?>" id="obs_pres" onkeyup="up(this)">
    </div>
    <div class="coluna" style="width:130px;"> Nascimento:
      <input name="nasc_pres"  type="text" id="nasc_pres" style="width:110px;"  value="<?php echo exibeData($l['nasc_pres']); ?>">
    </div>
    <div class="linha"></div>
 	<div class="coluna" style="width:190px;">CPF:<?php if (validaCPF($l['cpf_pres'])){ 
    	echo "<i class='icon-ok' style='color:green;width:40px;'></i>";
    	}else{echo "<i class='icon-remove' style='color:red;width:40px;'></i>
    <span class='avisos'>Este não é um CPF válido!</span>
    ";} ?>
    <input name="cpf_pres" type="text" maxlength="18" style="width:170px;" value="<?php echo $l['cpf_pres'] ?>" id="cpf_pres">
    </div>
    <div class="coluna" style="width:200px;">RG e Órgão Exp.:<br/>
    	<input name="rg_pres" type="text" style="width:180px;" value="<?php echo $l['rg_pres'] ?>" onkeyup="up(this)">
    </div>
    <div class="coluna" style="width:200px">Naturalidade:<br/>
    <input name="natural_pres" type="text" style="width:180px" value="<?php echo $l['natural_pres'] ?>" id="natural_pres" onkeyup="up(this)">
    </div>
    <div class="coluna" style="width:265px">Profissão:<br/>
    <input name="profissao_pres" type="text" style="width:245px" value="<?php echo $l['profissao_pres'] ?>" id="profissao_pres" onkeyup="up(this)">
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

    <div class="linha"></div>

    
    <div class="coluna" style="width:260px;">Foto do Presidente:<br/>

    	<input name="foto_pres" type="file" style="width:240px;" />

    </div>

    <div class="coluna" style="width:370px;">Pai:<br/><input name="filiacaopai_pres" onkeyup="up(this)" type="text" size="43" style="width:350px;" value="<?php echo $l['filiacaopai_pres'] ?>"></div>
	<div class="coluna" style="width:370px;">Mãe:<br/><input name="filiacaomae_pres" onkeyup="up(this)" type="text" size="43" style="width:350px;" value="<?php echo $l['filiacaomae_pres'] ?>"></div>
<div class="linha"></div>     
<div class="linha">
      <b>&nbsp;&nbsp;&nbsp;&nbsp;DADOS DO DIRETOR (A) DE ESPIRITUAL</b>
     <div class="linha"><hr /></div>
    
    <div class="coluna" style="width:600px;">Diretor(a) Espiritual do Centro / Terreiro:<br/>
    <input name="dir_culto" type="text" style="width:580px;" value="<?php echo $l['dir_culto']; ?>" onkeyup="up(this)">
    </div>
    <div class="coluna" style="width:270px;">Como conhecido? / Digina:<br/>
    <input name="subnick" type="text" style="width:250px;" value="<?php echo $l['subnick']; ?>" onkeyup="up(this)">
    </div>
    <div class="coluna" style="width:130px;"> Nascimento:
      <input name="nascimento"  type="text" id="nascimento" style="width:110px;"  value="<?php echo exibeData($l['nascimento']); ?>">
    </div>
 </div>
 <div class="linha">
     
 	<div class="coluna" style="width:190px;">CPF:<?php if (validaCPF($l['cpfcnpj'])){ 
    	echo "<i class='icon-ok' style='color:green;width:40px;'></i>";
    	}else{echo "<i class='icon-remove' style='color:red;width:40px;'></i>
    <span class='avisos'>Este não é um CPF válido!</span>
    ";} ?>
    <input name="cpfcnpj" type="text" maxlength="18" style="width:170px;" value="<?php echo $l['cpfcnpj'] ?>" id="cpf-cnpj">
    </div>
    <div class="coluna" style="width:200px;">RG e Órgão Exp.:<br/><input name="rg" type="text" style="width:180px;" value="<?php echo $l['rg'] ?>" onkeyup="up(this)">
    </div>
    <div class="coluna" style="width:200px">Naturalidade:<br/>
    <input name="naturalidade" type="text" style="width:180px" value="<?php echo $l['naturalidade'] ?>" id="naturalidade" onkeyup="up(this)">
    </div>
    <div class="coluna" style="width:265px">Profissão:<br/>
    <input name="profissao" type="text" style="width:245px" value="<?php echo $l['profissao'] ?>" id="profissao" onkeyup="up(this)">
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
    <div class="coluna" style="width:310px;">Complemento:<br/><input name="complemento" onkeyup="up(this)" type="text" style="width:290px;" value="<?php echo $l['complemento'] ?>" id="complemento"></div>
  </div>
  
    <div class="coluna" style="width:460px;">Bairro:<br/><input name="bairro" onkeyup="up(this)" type="text" size="43"style="width:440px;" value="<?php echo $l['bairro'] ?>" id="bairro" ></div>
    <div class="coluna" style="width:460px;">Cidade:<br/><input name="cidade" onkeyup="up(this)" type="text" style="width:440px;" value="<?php echo $l['cidade'] ?>" id="cidade"></div>
    <div class="coluna" style="width:65px;">UF:<br/><input name="uf" type="text" onkeyup="up(this)" size="2" maxlength="2" style="width:45px;" value="<?php echo $l['uf'] ?>" id='uf'></div>
    
    
  </div>
	    
  <b>&nbsp;&nbsp;&nbsp;&nbsp;OBSERVAÇÕES</b>
  <div class="linha"><hr /></div>
    <div class="coluna" style="width:990px;">
    <textarea name="texto" rows="3" style="width:100%;min-height:100px;" ><?php echo $l['obs']; ?></textarea>
    </div>
  </div>
  
  <input name="clientegr" type="hidden" value="clientegr">
  
  
    <div class="coluna" style="width:320px;">  <fieldset>
      <legend><strong>Senha padrão:</strong></legend>
      <span class="avisos">
        Todos seus clientes senha inicial padrão: "123"</span>
    </fieldset></div>
   </div>

  <div class="linha">
   <div class="control-groupa">
<div class="controlsa">
<br />
<button type="submit" class="btn btn-success ewButton" name="clientegr" id="btnsubmit" >
<i class="icon-thumbs-up icon-white"></i> Cadastrar cliente</button>
</div>
  </div>
</div>  

</form>
</div>
</div>




</section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->