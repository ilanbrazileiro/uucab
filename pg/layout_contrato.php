
<?php 
 /* 
 ############## DISPONIVEIS NA VARIAVEL CLIENTE #######################

  ["id_cliente"]
  ["id_grupo"]
  ["matricula"]
  ["nome"]
  ["filiacao_mae"]
  ["filiacao_pai"]
  ["nascimento"]
  ["cpfcnpj"]
  ["rg"]
  ["inscricao"]
  ["endereco"]
  ["numero"]
  ["complemento"]
  ["bairro"]
  ["cidade"]
  ["uf"]
  ["telefone"]
  ["cep"]
  ["email"]
  ["obs"]
  ["valor"]
  ["valor_anual"]
  ["bloqueado"]
  ["senha"]
  ["celular"]
  ["celular2"]
  ["entrega"]
  ["situacao"]
  ["naturalidade"]
  ["centro"]
  ["dir_culto"]
  ["end_dir"]
  ["bairro_dir"]
  ["cep_dir"]
  ["numero_dir"]
  ["complemento_dir"]
  ["cidade_dir"]
  ["uf_dir"]
  ["corretor"]
  ["subnick"]
  ["venc"]
  ["impresso"]
  ["cnpj"]
  ["valor_doc"]
  ["nasc_pres"]
  ["cpf_pres"]
  ["rg_pres"]
  ["natural_pres"]
  ["profissao"]
  ["profissao_pres"]
  ["filiacaomae_pres"]
  ["filiacaopai_pres"]
  ["estadocivil"]
  ["estadocivil_pres"]
  ["obs_pres"]
  ["email2"]
  ["responsavel"]
  ["rec_doc"]
  ["pago_doc"]
  ["data_doc"]
  ["linha_trab"]
  ["iniciado"]
  ["feitura"]
  ["nacao"]
  ["obrig_feita"]

  PARA APRESENTAR A VARIAVEL, BASTA DAR O ECHO SEGUIDO DA VARIAVEL E A COLUNA DESEJADA

  EX. APRESENTAR O NOME DO CENTRO

  <?php echo $cliente['centro'] ?>


  OBS2: CADA TR É UMA LINHA E CADA TD É UMA COLUNA



 ######################################################################


*/


 ?>


<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.0 Transitional//EN'>
<HTML>
<HEAD>
<TITLE><?php echo $cliente["matricula"]; ?> - <?php echo $cliente["dir_culto"]; ?></TITLE>

<meta charset="utf-8"/>
<meta name="Generator" content="UUCAB sistemas - Geração de boletos online" />
<style type=text/css>

.cp {  font: bold 12px Arial; color: black; padding: 5px;}
.ti {  font: 9px Arial, Helvetica, sans-serif}
.ld { font: bold 15px Arial; color: #000000}
.ct { FONT: 9px "Arial Narrow"; COLOR: #000033}
.cn { FONT: 9px Arial; COLOR: black }
.bc { font: bold 20px Arial; color: #000000 }
.ld2 { font: bold 12px Arial; color: #000000 }
.par{text-align: justify; padding-left: 3px; padding-right: 3px;}


@media print {

    #fichaboleto { 

        page-break-after: always;
        
    }
    @page { margin: 0; }
}


</style>

<script type="text/javascript">
  window.onload=function(){window.print();}
</script>  

</head>
<div id="fichaboleto">

<body text=#000000 bgColor=#ffffff topMargin=40 leftMargin=40 onload="window.print();">

<table width=700 cellspacing=0 cellpadding=0 border=1>

  <tr style="height: 50px;">
    <td valign=top class=cp ><!--OBSERVE QUE AQUI TEM UMA CLASSE E UM ESTILO ATUANDO, por isso fica diferente! -->
       <div class="coluna" style="float: left; width:500px;"><img src="http://uucab.com.br/boletos/img/logoGRIFF.png" height="45" style="float: left;">
      CONTRATO DE PRESTAÇÃO DE SERVIÇOS EM 2 (DUAS) VIAS <br>
      Pelo presente contrato particular de prestação de serviços assistenciais,
      <br>firmam de um lado o:</div>
      <div style="float: right;font-size: 28px">
          nº. <?php echo $cliente['matricula']?>
      </div>
    </td>
  </tr>

  <tr>
    <td valign=top class=cp><!--OBSERVE QUE AQUI TEM UMA CLASSE E UM ESTILO ATUANDO, por isso fica diferente! -->
      <i>Centro:</i> 
      <?php 
      if ($cliente['centro'] == ''){
        echo "NÃO INFORMADO O NOME DO CENTRO";
      } else {
         echo $cliente['centro'];
      }
      if ($cliente['cnpj'] != ''){
        echo " - CNPJ: ". $cliente['cnpj'];
        }?> 
    </td>
  </tr>


<tr>
    <td valign=top class=cp ><!--OBSERVE QUE AQUI TEM UMA CLASSE E UM ESTILO ATUANDO, por isso fica diferente! -->
      <i>Endereço do Centro:</i> 
      <?php 
      if (($cliente['numero_dir'] != '') and ($cliente['numero_dir'] != '0')){
        echo $cliente['end_dir'].', Nº '.$cliente['numero_dir'].' '.$cliente['complemento_dir'];
      } else {
         echo $cliente['end_dir'].', S/Nº '.$cliente['complemento_dir'];
      }  
      ?>
      
    </td>
  </tr>

  <tr>
    <td valign=top class=cp ><!--OBSERVE QUE AQUI TEM UMA CLASSE E UM ESTILO ATUANDO, por isso fica diferente! -->
      <i>Bairro:</i> <?php echo $cliente['bairro_dir'] ?> - <i>Município:</i> <?php echo $cliente['cidade_dir']?>-<?php echo $cliente['uf_dir']?>
    </td>
  </tr>
  

  <tr>
    <td valign=top class=cp ><!--OBSERVE QUE AQUI TEM UMA CLASSE E UM ESTILO ATUANDO, por isso fica diferente! -->
      <i>CEP nº:</i> <?php echo $cliente['cep_dir'] ?> - <i>Linha de Trabalho:</i> <?php
      if ($cliente['linha_trab'] == ''){
        echo "Não informada";
      } else {
         echo $cliente['linha_trab'];
      }?> - 
      <i>Telefones:</i> <?php echo $cliente['telefone'];
                    if ($cliente['celular'] != ''){
                      echo " / ". $cliente['celular'];
                    }

                    if ($cliente['celular2'] != ''){
                      echo " / ". $cliente['celular2'];
                    }
                  ?>
    </td>
  </tr>

  <tr>
    <td valign=top class=cp ><!--OBSERVE QUE AQUI TEM UMA CLASSE E UM ESTILO ATUANDO, por isso fica diferente! -->
      <u><i>PRESIDENTE:</i></u> <?php echo $cliente['nome'] ?> 
      <div style="float: right;">
         <i>Nascimento:</i> <?php echo exibeData($cliente['nasc_pres'])?>
      </div>
    </td>
  </tr>

  <tr>
    <td valign=top class=cp ><!--OBSERVE QUE AQUI TEM UMA CLASSE E UM ESTILO ATUANDO, por isso fica diferente! -->
      <i>Filiação (pai):</i> <?php 
      if ($cliente['filiacaopai_pres'] == ''){
        echo "XXXXXXXXXXXXX";
      } else {
         echo $cliente['filiacaopai_pres'];
      }?> 
    </td>
  </tr>

  <tr>
    <td valign=top class=cp ><!--OBSERVE QUE AQUI TEM UMA CLASSE E UM ESTILO ATUANDO, por isso fica diferente! -->
      <i>Filiação (mãe):</i> <?php 
      if ($cliente['filiacaomae_pres'] == ''){
        echo "XXXXXXXXXXXXX";
      } else {
         echo $cliente['filiacaomae_pres'];
      }?> 
    </td>
  </tr>

  <tr>
    <td valign=top class=cp ><!--OBSERVE QUE AQUI TEM UMA CLASSE E UM ESTILO ATUANDO, por isso fica diferente! -->
      <i>Identidade nº e Órgão Exp.:</i> <?php echo $cliente['rg_pres'] ?> - <i>Natural de:</i> <?php echo $cliente["natural_pres"]?>
    </td>
  </tr>

  <tr>
    <td valign=top class=cp ><!--OBSERVE QUE AQUI TEM UMA CLASSE E UM ESTILO ATUANDO, por isso fica diferente! -->
      <i>CPF nº:</i> <?php echo $cliente['cpf_pres'] ?> - <i>Estado Civil:</i> <?php echo $cliente["estadocivil_pres"]?> - <i>Profissão:</i> <?php echo $cliente["profissao_pres"]?>
    </td>
  </tr>



  <tr>
    <td valign=top class=cp ><!--OBSERVE QUE AQUI TEM UMA CLASSE E UM ESTILO ATUANDO, por isso fica diferente! -->
      <u><i>ZELADOR(A) ESPIRITUAL:</i></u> <?php echo $cliente['dir_culto'] ?> 
      <div style="float: right;">
         <i>Nascimento:</i> <?php echo exibeData($cliente['nascimento'])?>
      </div>
    </td>
  </tr>

  <tr>
    <td valign=top class=cp ><!--OBSERVE QUE AQUI TEM UMA CLASSE E UM ESTILO ATUANDO, por isso fica diferente! -->
      <i>Filiação (pai):</i> <?php 
      if ($cliente['filiacao_pai'] == ''){
        echo "XXXXXXXXXXXXX";
      } else {
         echo $cliente['filiacao_pai'];
      }?> 
    </td>
  </tr>

  <tr>
    <td valign=top class=cp ><!--OBSERVE QUE AQUI TEM UMA CLASSE E UM ESTILO ATUANDO, por isso fica diferente! -->
      <i>Filiação (mãe):</i> <?php 
      if ($cliente['filiacao_mae'] == ''){
        echo "XXXXXXXXXXXXX";
      } else {
         echo $cliente['filiacao_mae'];
      } ?> 
    </td>
  </tr>

  <tr>
    <td valign=top class=cp ><!--OBSERVE QUE AQUI TEM UMA CLASSE E UM ESTILO ATUANDO, por isso fica diferente! -->
      <i>Identidade nº e Órgão Exp.:</i> <?php echo $cliente['rg'] ?> - <i>Natural de:</i> <?php echo $cliente["naturalidade"]?>
    </td>
  </tr>

  <tr>
    <td valign=top class=cp ><!--OBSERVE QUE AQUI TEM UMA CLASSE E UM ESTILO ATUANDO, por isso fica diferente! -->
      <i>CPF nº:</i> <?php echo $cliente['cpfcnpj'] ?> - <i>Estado Civil:</i> <?php echo $cliente["estadocivil"]?> - <i>Profissão:</i> <?php echo $cliente["profissao"]?>
    </td>
  </tr>

  <tr>
    <td valign=top class=cp ><!--OBSERVE QUE AQUI TEM UMA CLASSE E UM ESTILO ATUANDO, por isso fica diferente! -->
      <i>Iniciado em:</i> <?php 
      if ($cliente['iniciado'] == ''){
        echo "Sem Data";
      } else {
         echo $cliente['iniciado'];
      }
      ?> - <i>Feitura em:</i> <?php 
      if ($cliente['feitura'] == ''){
        echo "Sem Data";
      } else {
         echo $cliente['feitura'];
      }?> - <i>Na Nação de:</i> <?php 
      if ($cliente['nacao'] == ''){
        echo "Não informada";
      } else {
         echo $cliente['nacao'];
      }?> - <i>Obrigações Feitas:</i> <?php 
      if ($cliente['obrig_feita'] == ''){
        echo "Não informada";
      } else {
         echo $cliente['obrig_feita'];
      }?>
    </td>
  </tr>


  <tr>
    <td valign=top class=cp ><!--OBSERVE QUE AQUI TEM UMA CLASSE E UM ESTILO ATUANDO, por isso fica diferente! -->
      <i>Endereço de Correspondência:</i> 
      <?php 
      if (($cliente['numero'] != '') and ($cliente['numero'] != '0')){
        echo $cliente['endereco'].', Nº '.$cliente['numero'].' '.$cliente['complemento'];
      } else {
         echo $cliente['endereco'].', S/Nº '.$cliente['complemento'];
      }  
      ?>
    </td>
  </tr>

  <tr>
    <td valign=top class=cp ><!--OBSERVE QUE AQUI TEM UMA CLASSE E UM ESTILO ATUANDO, por isso fica diferente! -->
      <i>Bairro:</i> <?php echo $cliente['bairro'] ?> - <i>Município:</i> <?php echo $cliente['cidade']?>-<?php echo $cliente['uf']?>
    </td>
  </tr>

  <tr>
    <td valign=top class=cp ><!--OBSERVE QUE AQUI TEM UMA CLASSE E UM ESTILO ATUANDO, por isso fica diferente! -->
      <i>CEP nº:</i> <?php echo $cliente['cep'] ?> - <i>E-Mail:</i> 
      <?php if ($cliente['email'] == ''){
        echo "nao@informado.com";
      } else {
         echo $cliente['email'];
      }
       if ($cliente['email2'] != ''){
        echo " / ". $cliente['email2'];
      }?>
    </td>
  </tr>

  <tr border=1 >
    <td valign=top class=cp style="text-align: justify;">
      E de outro lado, União Ucab Assessoria Administrativa LTDA, tendo como nome fantasia, União Umbandista dos Cultos Afro Brasileiro, registrado no cartório de Pessoas Jurídicas nº 4617 Fls 18 livro A-5 protocolo A2M, pág. 700, CNPJ 31.987.175/0001-68 com sede na Av. Min. Edgar Romero nº 81 Lj 340 - Madureira / RJ, tendo como objetivo, "Prestação de Serviços, através de credenciamento para a comunidade espírita e assessoria administrativa", sendo o tempo de duração por prazo indeterminado. O centro pagará uma taxa (luva) de documentos que são necessários para seu registro e para sua filiação com a União; E uma mensalidade para consultas e manutenção do documento, valor este estipulado pelas partes. E por estarem de acordo, justos e contratados, assina na presença de duas testemunhas a que tudo presenciaram.<?php echo $linha['texto_boleto1']; ?>
      </br>
           
      MENSALIDADE PARA ASSISTÊNCIAS E DIREITOS:
      </br>
      
      <u>GRÁTIS:</u> Consultas médicas em todas as especialidades, em clínicas conveniadas; Anúncio no classificado do nosso site <u>www.uucab.com.br.</u>
      
      
      <u>COM DESCONTOS:</u> Consulta e serviços jurídicos; Consulta a serviços ótico; Consultas e serviços contábeis; Consultas e serviços dentários; <u>Obs:</u> CARTEIRA MÉDICA EM GRUPO DE 6 (seis) PESSOAS POR CARTEIRA.
      
      
      <u>PAGAR:</u> PARQUE ECOLÓGICO DOS ORIXÁS: Taxa para manutenção e limpeza do Parque pelo grupo de pessoas taxa única, valor R$ 50,00 (cinquenta reais) para espaço descoberto, trabalhos e oferendas.
      </br>
      <u>OBS¹:</u> Relação de benefícios sujeita a alteração sem aviso prévio, com inclusão de novos benefícios e exclusão dos mesmos. <u>OBS²:</u> Mensalidade contratada sujeita a reajuste anual, sem aviso prévio.
      
    </td>
  </tr>

   <tr>
    <td valign=top class=cp style="text-align: center;" ><!--OBSERVE QUE AQUI TEM UMA CLASSE E UM ESTILO ATUANDO, por isso fica diferente! -->
      
      Rio de Janeiro, ______ de ______________________ de ___________.
    </td>
  </tr>

  <tr style="height: 35px;">
    <td valign=bottom class=cp st><!--OBSERVE QUE AQUI TEM UMA CLASSE E UM ESTILO ATUANDO, por isso fica diferente! -->
     
      Documentos de Filiação:
    </td>
  </tr>

  <tr>
    <td valign=top class=cp><!--OBSERVE QUE AQUI TEM UMA CLASSE E UM ESTILO ATUANDO, por isso fica diferente! -->
     <br>
      Valor Cobrado: <u>R$</u>___________________________________  Valor Mensalidade: <u>R$</u>_______________________________
    </td>
  </tr>
</table>

<table width=700 cellspacing=0 cellpadding=0 border=1>
<tr style="height: 80px">
  <td valign=bottom class=cp style="text-align: center;width: 50%">
    Zelador(a) Espiritual
  </td>

  <td valign=bottom class=cp style="text-align: center;">
    P/ UUCAB - União Espírita
  </td>

</tr>

<tr style="height: 95px">
  <td valign=bottom class=cp style="width: 50%">
    <div align="center">Testemunha</div>
    Nome:<br>
    Identidade:<br>
    CPF:
  </td>

  <td valign=bottom class=cp >
   <div align="center">Testemunha</div>
    Nome:<br>
    Identidade:<br>
    CPF:
  </td>

</tr>
</table>


</BODY>
</div>
</HTML>