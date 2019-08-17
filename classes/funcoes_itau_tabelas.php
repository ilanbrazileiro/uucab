<?php

function nota20Tabela1_O03($cod){

	$codigo = substr($cod, 0, 2);

	if($codigo == '03') 
		return 'CEP sem atendimento de protesto no momento';
	else if($codigo == '04')  
		return 'Sigla do ESTADO inválida';
	else if($codigo == '05') 
		return 'Prazo da operação menor que prazo mínimo ou maior que o máximo';
	else if($codigo == '07')
		return 'Valor do título maior que 10.000.000,00';
	else if($codigo == '08')
		return 'Nome do Pagador não informado ou deslocado';
	else if($codigo == '09')
		return 'Agência Encerrada';
	else if($codigo == '10') 
		return 'Lougradouro não informado ou deslocado';
	else if($codigo == '11')
		return 'CEP não numérico ou CEP inválido';
	else if($codigo == '12')
		return 'Sacador/Avalista nome não informado ou deslocado';
	else if($codigo == '13')
		return 'CEP incompatível com a sigla do ESTADO';
	else if($codigo == '14')
		return 'Nosso Número já registrado no cadastro ou fora da faixa';
	else if($codigo == '15')
		return 'Nosso Número em duplicidade no mesmo movimento';
	else if($codigo == '18')
		return 'Data de entrada inválida para operar com essa Carteira';
	else if($codigo == '19')
		return 'Ocorrência inválida';
	else if($codigo == '21')
		return 'Ag. Cobradora - Carteira não aceita depositária correspondente<br>
				ESTADO da agência diferente do ESTADO do pagador<br>
				Ag. Cobradora não consta no cadastro ou encerrando';
	else if($codigo == '22')
		return 'Carteira não permitida (necessário cadastrar faixa livre)';
	else if($codigo == '26')
		return 'Agência/Conta não liberada para operar com cobrança';
	else if($codigo == '27')
		return 'CNPJ do beneficiário INAPTO<br>
				Devolução de tírulo em garantia';
	else if($codigo == '29')
		return 'Código empresa - categoria inválida';
	else if($codigo == '30')
		return 'Entradas bloqueadas, conta suspensa em cobrança';
	else if($codigo == '31')
		return 'Conta não tem permissão para protestar(contate seu gerente)';
	else if($codigo == '35')
		return 'IOF maior que 5%';
	else if($codigo == '36')
		return 'Quantidade de moeda incompatível com valor do título';
	else if($codigo == '37')
		return 'CNPFJ/CPF - não numérico ou igual a zeros';
	else if($codigo == '42')
		return 'Nosso Número fora da faixa';
	else if($codigo == '52')
		return 'AG. Cobradora - Empresa não aceita banco correspondente';
	else if($codigo == '53')
		return 'AG. Cobradora - Empresa não aceita banco correspondente - cobrança mensagem';
	else if($codigo == '54')
		return 'Data de Vencimento - Banco correspondente - titulo com Vencimento inferior a 15 dias';
	else if($codigo == '55')
		return 'CEP não pertence a depositária informada';
	else if($codigo == '56')
		return 'Vencimento superior a 180 dias da data de entrada';
	else if($codigo == '57')
		return 'CEP só depositária Banco do Brasil com Vencimento inferior a 8 dias';
	else if($codigo == '60')
		return 'Valor do abatimento inválido ';
	else if($codigo == '61')
		return 'Juros de mora maior que o permitido';
	else if($codigo == '62')
		return 'Valor do desconto maior que o valor do título';
	else if($codigo == '63')
		return 'Valor da importância por dia de desconto não permitido';
	else if($codigo == '64')
		return 'Data da emissão do título inválida';
	else if($codigo == '65')
		return 'Taxa inválida';
	else if($codigo == '66')
		return 'Data de Vencimento - Inválida/Fora do prazo de operação (mínimo ou máximo)';
	else if($codigo == '67')
		return 'Valor do título/Quantidade de moeda inválido';
	else if($codigo == '68')
		return 'Carteira inválida ou não cadastrada no intercâmbio da cobrança';
	else if($codigo == '69')
		return 'Carteira inválida para títulos com rateio de crédito';
	else if($codigo == '70')
		return 'Beneficiário não cadastrado para fazer rateio de crédito';
	else if($codigo == '78')
		return 'Duplicidade de agência/conta beneficiário do rateio de crédito';
	else if($codigo == '80')
		return 'Quantidade de contas beneficiárias do rateio maior do que o permitido (máximo de 30 contas por título)';
	else if($codigo == '81')
		return 'Conta para rateio de crédito inválida/não pertence ao Itaú';
	else if($codigo == '82')
		return 'Desconto/abatimento não permitido para títulos com rateio de crédito';
	else if($codigo == '83')
		return 'valor do título menor que a soma dos valores estipulados para rateio';
	else if($codigo == '84')
		return 'Agência/Conta beneficiária do rateio é a centralizadora de crédito do beneficiário';
	else if($codigo == '85')
		return 'Agência/Conta do beneficiário é contratual / rateio de crédito não permitido';
	else if($codigo == '86')
		return 'Código do tipo de valor inválido/não previsto para títulos com rateio de crédito';
	else if($codigo == '87')
		return 'Registro tipo 4 sem informação de agências/contas beneficiárias do rateio';
	else if($codigo == '90')
		return 'Cobrança mensagem - número de linha da mensagem inválido ou quantidade de linhas excedidas';
	else if($codigo == '97')
		return 'Cobrança mensagem sem mensagem (só de campos fixos), porém com registro do tipo 7 ou 8';
	else if($codigo == '98')
		return 'Registro mensagem sem FLASH cadastrado ou FLASH informado diferente do cadastrado';
	else if($codigo == '99')
		return 'Conta de cobrança com FLASH cadastrado e sem registro de mensagem correspondente';
	else
		return 'Código Inexistente para NOTA 20 - TABELA 1';
}

function nota20Tabela2_O17($cod){

	$codigo = substr($cod, 0, 2);

	if($codigo == '02') 
		return 'AGÊNCIA COBRADORA INVÁLIDA OU COM O MESMO CONTEÚDO';
	else if($codigo == '04')  
		return 'SIGLA DO ESTADO INVÁLIDA';
	else if($codigo == '05')  
		return 'DATA DE VENCIMENTO INVÁLIDA OU COM O MESMO CONTEÚDO';
	else if($codigo == '06')  
		return 'VALOR DO TÍTULO COM OUTRA ALTERAÇÃO SIMULTÂNEA';
	else if($codigo == '08')  
		return 'NOME DO PAGADOR COM O MESMO CONTEÚDO';
	else if($codigo == '09')  
		return 'AGÊNCIA/CONTA INCORRETA';
	else if($codigo == '11')  
		return 'CEP INVÁLIDO';
	else if($codigo == '12')  
		return 'NÚMERO INSCRIÇÃO INVÁLIDO DO SACADOR AVALISTA';
	else if($codigo == '13')  
		return 'SEU NÚMERO COM O MESMO CONTEÚDO';
	else if($codigo == '16')  
		return 'ABATIMENTO/ALTERAÇÃO DO VALOR DO TÍTULO OU SOLICITAÇÃO DE BAIXA BLOQUEADA';
	else if($codigo == '20')  
		return 'ESPÉCIE INVÁLIDA';
	else if($codigo == '21')  
		return 'AGÊNCIA COBRADORA NÃO CONSTA NO CADASTRO DE DEPOSITÁRIA OU EM ENCERRAMENTO';
	else if($codigo == '23')  
		return 'DATA DE EMISSÃO DO TÍTULO INVÁLIDA OU COM MESMO CONTEÚDO';
	else if($codigo == '41')  
		return 'CAMPO ACEITE INVÁLIDO OU COM MESMO CONTEÚDO';
	else if($codigo == '42')  
		return 'ALTERAÇÃO INVÁLIDA PARA TÍTULO VENCIDO';
	else if($codigo == '43')  
		return 'ALTERAÇÃO BLOQUEADA – VENCIMENTO JÁ ALTERADO';
	else if($codigo == '53')  
		return 'INSTRUÇÃO COM O MESMO CONTEÚDO';
	else if($codigo == '54')  
		return 'DATA VENCIMENTO PARA BANCOS CORRESPONDENTES INFERIOR AO ACEITO PELO BANCO';
	else if($codigo == '55')  
		return 'ALTERAÇÕES IGUAIS PARA O MESMO CONTROLE (AGÊNCIA/CONTA/CARTEIRA/NOSSO NÚMERO)';
	else if($codigo == '56')  
		return 'CNPJ/CPF INVÁLIDO NÃO NUMÉRICO OU ZERADO';
	else if($codigo == '57')  
		return 'PRAZO DE VENCIMENTO INFERIOR A 15 DIAS';
	else if($codigo == '60')  
		return 'VALOR DE IOF – ALTERAÇÃO NÃO PERMITIDA PARA CARTEIRAS DE N.S. – MOEDA VARIÁVEL';
	else if($codigo == '61')  
		return 'TÍTULO JÁ BAIXADO OU LIQUIDADO OU NÃO EXISTE TÍTULO CORRESPONDENTE NO SISTEMA';
	else if($codigo == '66')  
		return 'ALTERAÇÃO NÃO PERMITIDA PARA CARTEIRAS DE NOTAS DE SEGUROS – MOEDA VARIÁVEL';
	else if($codigo == '67')  
		return 'NOME INVÁLIDO DO SACADOR AVALISTA';
	else if($codigo == '72')  
		return 'ENDEREÇO INVÁLIDO – SACADOR AVALISTA';
	else if($codigo == '73')  
		return 'BAIRRO INVÁLIDO – SACADOR AVALISTA';
	else if($codigo == '74')  
		return 'CIDADE INVÁLIDA – SACADOR AVALISTA';
	else if($codigo == '75')  
		return 'SIGLA ESTADO INVÁLIDO – SACADOR AVALISTA';
	else if($codigo == '76')  
		return 'CEP INVÁLIDO – SACADOR AVALISTA';
	else if($codigo == '81')  
		return 'ALTERAÇÃO BLOQUEADA – TÍTULO COM NEGATIVAÇÃO EXPRESSA / PROTESTO';
	else if($codigo == '87')  
		return 'ALTERAÇÃO BLOQUEADA – TÍTULO COM RATEIO DE CRÉDITO';
	else
		return 'Código Inexistente para NOTA 20 - TABELA 2';
}

function nota20Tabela3_O16($cod){

	$codigo = substr($cod, 0, 2);

	if($codigo == '01') 
		return 'INSTRUÇÃO/OCORRÊNCIA NÃO EXISTENTE';
	else if($codigo == '03')  
		return 'CONTA NÃO TEM PERMISSÃO PARA PROTESTAR (CONTATE SEU GERENTE)';
	else if($codigo == '06')  
		return 'NOSSO NÚMERO IGUAL A ZEROS';
	else if($codigo == '09')  
		return 'CNPJ/CPF DO SACADOR/AVALISTA INVÁLIDO';
	else if($codigo == '10')  
		return 'VALOR DO ABATIMENTO IGUAL OU MAIOR QUE O VALOR DO TÍTULO';
	else if($codigo == '11')  
		return 'SEGUNDA INSTRUÇÃO/OCORRÊNCIA NÃO EXISTENTE';
	else if($codigo == '14')  
		return 'REGISTRO EM DUPLICIDADE';
	else if($codigo == '15')  
		return 'CNPJ/CPF INFORMADO SEM NOME DO SACADOR/AVALISTA';
	else if($codigo == '19')  
		return 'VALOR DO ABATIMENTO MAIOR QUE 90% DO VALOR DO TÍTULO';
	else if($codigo == '20')  
		return 'EXISTE SUSTACAO DE PROTESTO PENDENTE PARA O TITULO';
	else if($codigo == '21')  
		return 'TÍTULO NÃO REGISTRADO NO SISTEMA';
	else if($codigo == '22')  
		return 'TÍTULO BAIXADO OU LIQUIDADO';
	else if($codigo == '23')  
		return 'INSTRUÇÃO NÃO ACEITA';
	else if($codigo == '24')  
		return 'INSTRUÇÃO INCOMPATÍVEL – EXISTE INSTRUÇÃO DE PROTESTO PARA O TÍTULO';
	else if($codigo == '25')  
		return 'INSTRUÇÃO INCOMPATÍVEL – NÃO EXISTE INSTRUÇÃO DE PROTESTO PARA O TÍTULO';
	else if($codigo == '26')  
		return 'INSTRUÇÃO NÃO ACEITA POR JÁ TER SIDO EMITIDA A ORDEM DE PROTESTO AO CARTÓRIO';
	else if($codigo == '27')  
		return 'INSTRUÇÃO NÃO ACEITA POR NÃO TER SIDO EMITIDA A ORDEM DE PROTESTO AO CARTÓRIO';
	else if($codigo == '28')  
		return 'JÁ EXISTE UMA MESMA INSTRUÇÃO CADASTRADA ANTERIORMENTE PARA O TÍTULO';
	else if($codigo == '29')  
		return 'VALOR LÍQUIDO + VALOR DO ABATIMENTO DIFERENTE DO VALOR DO TÍTULO REGISTRADO';
	else if($codigo == '30')  
		return 'EXISTE UMA INSTRUÇÃO DE NÃO PROTESTAR ATIVA PARA O TÍTULO';
	else if($codigo == '31')  
		return 'EXISTE UMA OCORRÊNCIA DO PAGADOR QUE BLOQUEIA A INSTRUÇÃO';
	else if($codigo == '32')  
		return 'DEPOSITÁRIA DO TÍTULO = 9999 OU CARTEIRA NÃO ACEITA PROTESTO';
	else if($codigo == '33')  
		return 'ALTERAÇÃO DE VENCIMENTO IGUAL À REGISTRADA NO SISTEMA OU QUE TORNA O TÍTULO VENCIDO';
	else if($codigo == '34')  
		return 'INSTRUÇÃO DE EMISSÃO DE AVISO DE COBRANÇA PARA TÍTULO VENCIDO ANTES DO VENCIMENTO';
	else if($codigo == '35')  
		return 'SOLICITAÇÃO DE CANCELAMENTO DE INSTRUÇÃO INEXISTENTE';
	else if($codigo == '36')  
		return 'TÍTULO SOFRENDO ALTERAÇÃO DE CONTROLE (AGÊNCIA/CONTA/CARTEIRA/NOSSO NÚMERO)';
	else if($codigo == '37')  
		return 'INSTRUÇÃO NÃO PERMITIDA PARA A CARTEIRA';
	else if($codigo == '38')  
		return 'INSTRUÇÃO NÃO PERMITIDA PARA TÍTULO COM RATEIO DE CRÉDITO';
	else if($codigo == '40')  
		return 'INSTRUÇÃO INCOMPATÍVEL – NÃO EXISTE INSTRUÇÃO DE NEGATIVAÇÃO EXPRESSA PARA O TÍTULO';
	else if($codigo == '41')  
		return 'INSTRUÇÃO NÃO PERMITIDA – TÍTULO COM ENTRADA EM NEGATIVAÇÃO EXPRESSA';
	else if($codigo == '42')  
		return 'INSTRUÇÃO NÃO PERMITIDA – TÍTULO COM NEGATIVAÇÃO EXPRESSA CONCLUÍDA';
	else if($codigo == '43')  
		return 'PRAZO INVÁLIDO PARA NEGATIVAÇÃO EXPRESSA – MÍNIMO: 02 DIAS CORRIDOS APÓS O VENCIMENTO';
	else if($codigo == '45')  
		return 'INSTRUÇÃO INCOMPATÍVEL PARA O MESMO TÍTULO NESTA DATA';
	else if($codigo == '47')  
		return 'INSTRUÇÃO NÃO PERMITIDA – ESPÉCIE INVÁLIDA';
	else if($codigo == '48')  
		return 'DADOS DO PAGADOR INVÁLIDOS ( CPF / CNPJ / NOME )';
	else if($codigo == '49')  
		return 'DADOS DO ENDEREÇO DO PAGADOR INVÁLIDOS';
	else if($codigo == '50')  
		return 'DATA DE EMISSÃO DO TÍTULO INVÁLIDA';
	else if($codigo == '51')  
		return 'INSTRUÇÃO NÃO PERMITIDA – TÍTULO COM NEGATIVAÇÃO EXPRESSA AGENDADA';
	else
		return 'Código Inexistente para NOTA 20 - TABELA 3';
}

 function nota20Tabela4_O15($cod){

	$codigo = substr($cod, 0, 2);

	if($codigo == '01') 
		return 'Carteira/ nº número não é numerico';
	else if($codigo == '04')  
		return 'Nosso Número em duplicidade no mesmo movimento';
	else if($codigo == '05') 
		return 'Solicitação de BAIXA para título já baixado ou liquidado';
	else if($codigo == '06') 
		return 'Solicitação de BAIXA para título não registrado no sistema';
	else if($codigo == '07') 
		return 'Cobrança prazo curto - Solicitaçãode BAIXA p/ titulo não registrado no sistema';
	else if($codigo == '08') 
		return 'Solicitação de BAIXA para título em FLOATING';
	else if($codigo == '10') 
		return 'Valor do título faz parte de garantia de empréstimo';
	else if($codigo == '11')
		return 'Pago através do SISPAG por crédito em C/C e não baixado';
	else
		return 'Código Inexistente para NOTA 20 - TABELA 4';
}

function nota20Tabela5_O18($cod){

	$codigo = substr($cod, 0, 2);

	if($codigo == '16') 
		return 'ABATIMENTO/ALTERAÇÃO DO VALOR DO TÍTULO OU SOLICITAÇÃO DE BAIXA BLOQUEADOS';
	else if($codigo == '40')  
		return 'NÃO APROVADA DEVIDO AO IMPACTO NA ELEGIBILIDADE DE GARANTIAS';
	else if($codigo == '41') 
		return 'AUTOMATICAMENTE REJEITADA';
	else if($codigo == '42') 
		return 'CONFIRMA RECEBIMENTO DE INSTRUÇÃO – PENDENTE DE ANÁLISE';
	else
		return 'Código Inexistente para NOTA 20 - TABELA 5';
}

function nota20Tabela6_O25($cod){

	$codigo = substr($cod, 0, 4);

	if($codigo == '1313') 
		return 'SOLICITA A PRORROGAÇÃO DO VENCIMENTO PARA:';
	else if($codigo == '1321')  
		return 'SOLICITA A DISPENSA DOS JUROS DE MORA';
	else if($codigo == '1339') 
		return 'NÃO RECEBEU A MERCADORIA';
	else if($codigo == '1347') 
		return 'A MERCADORIA CHEGOU ATRASADA';
	else if($codigo == '1354') 
		return 'A MERCADORIA CHEGOU AVARIADA';
	else if($codigo == '1362') 
		return 'A MERCADORIA CHEGOU INCOMPLETA';
	else if($codigo == '1370') 
		return 'A MERCADORIA NÃO CONFERE COM O PEDIDO';
	else if($codigo == '1388') 
		return 'A MERCADORIA ESTÁ À DISPOSIÇÃO';
	else if($codigo == '1396') 
		return 'DEVOLVEU A MERCADORIA';
	else if($codigo == '1404') 
		return 'NÃO RECEBEU A FATURA';
	else if($codigo == '1412') 
		return 'A FATURA ESTÁ EM DESACORDO COM A NOTA FISCAL';
	else if($codigo == '1420') 
		return 'O PEDIDO DE COMPRA FOI CANCELADO';
	else if($codigo == '1438') 
		return 'A DUPLICATA FOI CANCELADA';
	else if($codigo == '1446') 
		return 'QUE NADA DEVE OU COMPROU';
	else if($codigo == '1453') 
		return 'QUE MANTÉM ENTENDIMENTOS COM O SACADOR';
	else if($codigo == '1461') 
		return 'QUE PAGARÁ O TÍTULO EM:';
	else if($codigo == '1479') 
		return 'QUE PAGOU O TÍTULO DIRETAMENTE AO BENEFICIÁRIO EM:';
	else if($codigo == '1487') 
		return 'QUE PAGARÁ O TÍTULO DIRETAMENTE AO BENEFICIÁRIO EM:';
	else if($codigo == '1495') 
		return 'QUE O VENCIMENTO CORRETO É:';
	else if($codigo == '1503') 
		return 'VALOR QUE TEM DESCONTO OU ABATIMENTO DE:';
	else if($codigo == '1719') 
		return 'PAGADOR NÃO FOI LOCALIZADO; CONFIRMAR ENDEREÇO';
	else if($codigo == '1727') 
		return 'PAGADOR ESTÁ EM REGIME DE CONCORDATA';
	else if($codigo == '1735') 
		return 'PAGADOR ESTÁ EM REGIME DE FALÊNCIA';
	else if($codigo == '1750') 
		return 'PAGADOR SE RECUSA A PAGAR JUROS BANCÁRIOS';
	else if($codigo == '1768') 
		return 'PAGADOR SE RECUSA A PAGAR COMISSÃO DE PERMANÊNCIA';
	else if($codigo == '1776') 
		return 'NÃO FOI POSSÍVEL A ENTREGA DO BOLETO AO PAGADOR';
	else if($codigo == '1784') 
		return 'BOLETO NÃO ENTREGUE, MUDOU-SE / DESCONHECIDO';
	else if($codigo == '1792') 
		return 'BOLETO NÃO ENTREGUE, CEP ERRADO / INCOMPLETO';
	else if($codigo == '1800') 
		return 'BOLETO NÃO ENTREGUE, NÚMERO NÃO EXISTE/ENDEREÇO INCOMPLETO';
	else if($codigo == '1818') 
		return 'BOLETO NÃO RETIRADO PELO PAGADOR. REENVIADO PELO CORREIO PARA CARTEIRAS COM EMISSÃO PELO
BANCO';
	else if($codigo == '1826') 
		return 'ENDEREÇO DE E-MAIL INVÁLIDO/COBRANÇA MENSAGEM. BOLETO ENVIADO PELO CORREIO';
	else if($codigo == '1834') 
		return 'BOLETO DDA, DIVIDA RECONHECIDA PELO PAGADOR';
	else if($codigo == '1842') 
		return 'BOLETO DDA, DIVIDA NÃO RECONHECIDA PELO PAGADOR';
	else if($codigo == '') 
		return '';
	else if($codigo == '') 
		return '';
	else if($codigo == '') 
		return '';
	else
		return 'Código Inexistente para NOTA 20 - TABELA 6';
}

function nota20Tabela7_O24($cod){

	$codigo = substr($cod, 0, 4);

	if($codigo == '1610') 
		return 'DOCUMENTAÇÃO SOLICITADA AO BENEFICIÁRIO';
	else if($codigo == '3103')  
		return 'INSUFICIENCIA DE DADOS NO MODELO 4006';
	else if($codigo == '3111')  
		return 'SUSTAÇÃO SOLICITADA AG. BENEFICIÁRIO';
	else if($codigo == '3129')  
		return 'TITULO NAO ENVIADO A CARTORIO';
	else if($codigo == '3137')  
		return 'AGUARDAR UM DIA UTIL APOS O VENCTO PARA PROTESTAR';
	else if($codigo == '3145')  
		return 'DM/DMI SEM COMPROVANTE AUTENTICADO OU DECLARACAO';
	else if($codigo == '3152')  
		return 'FALTA CONTRATO DE SERV(AG.CED:ENVIAR)';
	else if($codigo == '3160')  
		return 'NOME DO PAGADOR INCOMPLETO/INCORRETO';
	else if($codigo == '3178')  
		return 'NOME DO BENEFICIÁRIO INCOMPLETO/INCORRETO';
	else if($codigo == '3186')  
		return 'NOME DO SACADOR INCOMPLETO/INCORRETO';
	else if($codigo == '3194')  
		return 'TIT ACEITO: IDENTIF ASSINANTE DO CHEQ';
	else if($codigo == '3202')  
		return 'TIT ACEITO: RASURADO OU RASGADO';
	else if($codigo == '3210')  
		return 'TIT ACEITO: FALTA TIT.(AG.CED:ENVIAR)';
	else if($codigo == '3228')  
		return 'ATOS DA CORREGEDORIA ESTADUAL';
	else if($codigo == '3236')  
		return 'NAO FOI POSSIVEL EFETUAR O PROTESTO';
	else if($codigo == '3244')  
		return 'PROTESTO SUSTADO / BENEFICIÁRIO NÃO ENTREGOU A DOCUMENTAÇÃO';
	else if($codigo == '3251')  
		return 'DOCUMENTACAO IRREGULAR';
	else if($codigo == '3269')  
		return 'DATA DE EMISSÃO DO TÍTULO INVÁLIDA / IRREGULAR';
	else if($codigo == '3277')  
		return 'ESPECIE INVALIDA PARA PROTESTO';
	else if($codigo == '3285')  
		return 'PRAÇA NÃO ATENDIDA PELA REDE BANCÁRIA';
	else if($codigo == '3293')  
		return 'CENTRALIZADORA DE PROTESTO NAO RECEBEU A DOCUMENTACAO';
	else if($codigo == '3301')  
		return 'CNPJ/CPF DO PAGADOR INVÁLIDO / INCORRETO';
	else if($codigo == '3319')  
		return 'SACADOR/AVALISTA E PESSOA FÍSICA';
	else if($codigo == '3327')  
		return 'CEP DO PAGADOR INCORRETO';
	else if($codigo == '3335')  
		return 'DEPOSITÁRIA INCOMPATÍVEL COM CEP DO PAGADOR';
	else if($codigo == '3343')  
		return 'CNPJ/CPF SACADOR INVALIDO / INCORRETO';
	else if($codigo == '3350')  
		return 'ENDEREÇO DO PAGADOR INSUFICIENTE';
	else if($codigo == '3368')  
		return 'PRAÇA PAGTO INCOMPATÍVEL COM ENDEREÇO';
	else if($codigo == '3376')  
		return 'FALTA NÚMERO/ESPÉCIE DO TÍTULO';
	else if($codigo == '3384')  
		return 'TÍTULO ACEITO S/ ASSINATURA DO SACADOR';
	else if($codigo == '3392')  
		return 'TÍTULO ACEITO S/ ENDOSSO BENEFICIÁRIO OU IRREGULAR';
	else if($codigo == '3400')  
		return 'TÍTULO SEM LOCAL OU DATA DE EMISSÃO';
	else if($codigo == '3418')  
		return 'TÍTULO ACEITO COM VALOR EXTENSO DIFERENTE DO NUMÉRICO';
	else if($codigo == '3426')  
		return 'TÍTULO ACEITO DEFINIR ESPÉCIE DA DUPLICATA';
	else if($codigo == '3434')  
		return 'DATA EMISSÃO POSTERIOR AO VENCIMENTO';
	else if($codigo == '3442')  
		return 'TÍTULO ACEITO DOCUMENTO NÃO PROTESTÁVEL';
	else if($codigo == '3459')  
		return 'TÍTULO ACEITO EXTENSO VENCIMENTO IRREGULAR';
	else if($codigo == '3467')  
		return 'TÍTULO ACEITO FALTA NOME FAVORECIDO';
	else if($codigo == '3475')  
		return 'ÍTULO ACEITO FALTA PRAÇA DE PAGAMENTO';
	else if($codigo == '3483')  
		return 'TÍTULO ACEITO FALTA CPF ASSINANTE CHEQUE';
	else if($codigo == '3491')  
		return 'FALTA NÚMERO DO TÍTULO (SEU NÚMERO)';
	else if($codigo == '3509')  
		return 'CARTÓRIO DA PRAÇA COM ATIVIDADE SUSPENSA';
	else if($codigo == '3517')  
		return 'DATA APRESENTACAO MENOR QUE A DATA VENCIMENTO';
	else if($codigo == '3525')  
		return 'FALTA COMPROVANTE DA PRESTACAO DE SERVICO';
	else if($codigo == '3533')  
		return 'CNPJ/CPF PAGADOR INCOMPATIVEL C/ TIPO DE DOCUMENTO';
	else if($codigo == '3541')  
		return 'CNPJ/CPF SACADOR INCOMPATIVEL C/ ESPECIE';
	else if($codigo == '3558')  
		return 'TIT ACEITO: S/ ASSINATURA DO PAGADOR';
	else if($codigo == '3566')  
		return 'FALTA DATA DE EMISSAO DO TITULO';
	else if($codigo == '3574')  
		return 'SALDO MAIOR QUE O VALOR DO TITULO';
	else if($codigo == '3582')  
		return 'TIPO DE ENDOSSO INVALIDO';
	else if($codigo == '3590')  
		return 'DEVOLVIDO POR ORDEM JUDICIAL';
	else if($codigo == '3608')  
		return 'DADOS DO TITULO NAO CONFEREM COM DISQUETE';
	else if($codigo == '3616')  
		return 'PAGADOR E SACADOR AVALISTA SÃO A MESMA PESSOA';
	else if($codigo == '3624')  
		return 'COMPROVANTE ILEGIVEL PARA CONFERENCIA E MICROFILMAGEM';
	else if($codigo == '3632')  
		return 'CONFIRMAR SE SAO DOIS EMITENTES';
	else if($codigo == '3640')  
		return 'ENDERECO DO PAGADOR IGUAL AO DO SACADOR OU DO PORTADOR';
	else if($codigo == '3657')  
		return 'ENDERECO DO BENEFICIÁRIO INCOMPLETO OU NAO INFORMADO';
	else if($codigo == '3665')  
		return 'ENDERECO DO EMITENTE NO CHEQUE IGUAL AO DO BANCO PAGADOR';
	else if($codigo == '3673')  
		return 'FALTA MOTIVO DA DEVOLUCAO NO CHEQUE OU ILEGIVEL';
	else if($codigo == '3681')  
		return 'TITULO COM DIREITO DE REGRESSO VENCIDO';
	else if($codigo == '3699')  
		return 'TITULO APRESENTADO EM DUPLICIDADE';
	else if($codigo == '3707')  
		return 'LC EMITIDA MANUALMENTE (TITULO DO BANCO/CA)';
	else if($codigo == '3715')  
		return 'NAO PROTESTAR LC (TITULO DO BANCO/CA)';
	else if($codigo == '3723')  
		return 'ELIMINAR O PROTESTO DA LC (TITULO DO BANCO/CA)';
	else if($codigo == '3731')  
		return 'TITULO JA PROTESTADO';
	else if($codigo == '3749')  
		return 'TITULO – FALTA TRADUCAO POR TRADUTOR PUBLICO';
	else if($codigo == '3756')  
		return 'FALTA DECLARACAO DE SALDO ASSINADA NO TITULO';
	else if($codigo == '3764')  
		return 'CONTRATO DE CAMBIO – FALTA CONTA GRAFICA';
	else if($codigo == '3772')  
		return 'PAGADOR FALECIDO';
	else if($codigo == '3780')  
		return 'ESPECIE DE TITULO QUE O BANCO NAO PROTESTA';
	else if($codigo == '3798')  
		return 'AUSENCIA DO DOCUMENTO FISICO ';
	else if($codigo == '3806')  
		return 'ORDEM DE PROTESTO SUSTADA, MOTIVO';
	else if($codigo == '3814')  
		return 'PAGADOR APRESENTOU QUITAÇÃO DO TÍTULO';
	else if($codigo == '3822')  
		return 'PAGADOR IRÁ NEGOCIAR COM BENEFICIÁRIO';
	else if($codigo == '3830')  
		return 'CPF INCOMPATÍVEL COM A ESPÉCIE DO TÍTULO';
	else if($codigo == '3848')  
		return 'TÍTULO DE OUTRA JURISDIÇÃO TERRITORIAL';
	else if($codigo == '3855')  
		return 'TÍTULO COM EMISSÃO ANTERIOR A CONCORDATA DO PAGADOR';
	else if($codigo == '3863')  
		return 'PAGADOR CONSTA NA LISTA DE FALÊNCIA';
	else if($codigo == '3871')  
		return 'APRESENTANTE NÃO ACEITA PUBLICAÇÃO DE EDITAL';
	else if($codigo == '3889')  
		return 'CARTÓRIO COM PROBLEMAS OPERACIONAIS';
	else if($codigo == '3897')  
		return 'ENVIO DE TITULOS PARA PROTESTO TEMPORARIAMENTE PARALISADO';
	else if($codigo == '3905')  
		return 'BENEFICIÁRIO COM CONTA EM COBRANCA SUSPENSA';
	else if($codigo == '3913')  
		return 'CEP DO PAGADOR E UMA CAIXA POSTAL';
	else if($codigo == '3921')  
		return 'ESPÉCIE NÃO PROTESTÁVEL NO ESTADO';
	else if($codigo == '3939')  
		return 'FALTA ENDEREÇO OU DOCUMENTO DO SACADOR AVALISTA';
	else if($codigo == '3947')  
		return 'CORRIGIR A ESPECIE DO TITULO';
	else if($codigo == '3954')  
		return 'ERRO DE PREENCHIMENTO DO TITULO';
	else if($codigo == '3962')  
		return 'VALOR DIVERGENTE ENTRE TITULO E COMPROVANTE';
	else if($codigo == '3970')  
		return 'CONDOMINIO NAO PODE SER PROTESTADO P/ FINS FALIMENTARES';
	else if($codigo == '3988')  
		return 'VEDADA INTIMACAO POR EDITAL PARA PROTESTO FALIMENTAR';
	else
		return 'Código Inexistente para NOTA 20 - TABELA 7';
}

function nota20Tabela8_O57($cod){

	$codigo = substr($cod, 0, 4);

	if($codigo == '1156') 
		return 'NÃO PROTESTAR';
	else if($codigo == '2261')  
		return 'DISPENSAR JUROS/COMISSÃO DE PERMANÊNCIA';
	else
		return 'Código Inexistente para NOTA 20 - TABELA 8';
}

function nota20Tabela9_O69($cod){

	$codigo = substr($cod, 0, 2);

	if($codigo == '11')
		return 'CHEQUE SEM FUNDOS – PRIMEIRA APRESENTAÇÃO';
	else if($codigo == '12') 
		return 'CHEQUE SEM FUNDOS – SEGUNDA APRESENTAÇÃO';
	else if($codigo == '13') 
		return 'CONTA ENCERRADA';
	else if($codigo == '14') 
		return 'PRÁTICA ESPÚRIA';
	else if($codigo == '20') 
		return 'FOLHA DE CHEQUE CANCELADA POR SOLICITAÇÃO DO CORRENTISTA';
	else if($codigo == '21') 
		return 'CONTRA-ORDEM (OU REVOGAÇÃO) OU OPOSIÇÃO (OU SUSTAÇÃO) AO PAGAMENTO PELO EMITENTE OU
PELO PORTADOR';
	else if($codigo == '22') 
		return 'DIVERGÊNCIA OU INSUFICIÊNCIA DE ASSINATURA';
	else if($codigo == '23') 
		return 'CHEQUES EMITIDOS POR ENTIDADES E ÓRGÃOS DA ADMINISTRAÇÃO PÚBLICA FEDERAL DIRETA E
INDIRETA, EM DESACORDO COM OS REQUISITOS CONSTANTES DO ARTIGO 74, § 2º, DO DECRETO-LEI Nº
200, DE 25.02.1967';
	else if($codigo == '24') 
		return 'BLOQUEIO JUDICIAL OU DETERMINAÇÃO DO BANCO CENTRAL DO BRASIL';
	else if($codigo == '25') 
		return 'CANCELAMENTO DE TALONÁRIO PELO BANCO PAGADO';
	else if($codigo == '28') 
		return 'CONTRA-ORDEM (OU REVOGAÇÃO) OU OPOSIÇÃO (OU SUSTAÇÃO) AO PAGAMENTO OCASIONADA POR
FURTO OU ROUBO';
	else if($codigo == '29') 
		return 'CHEQUE BLOQUEADO POR FALTA DE CONFIRMAÇÃO DO RECEBIMENTO DO TALONÁRIO PELO
CORRENTISTA';
	else if($codigo == '30') 
		return ' FURTO OU ROUBO DE MALOTE';
	else if($codigo == '31') 
		return 'ERRO FORMAL (SEM DATA DE EMISSÃO, COM O MÊS GRAFADO NUMERICAMENTE, AUSÊNCIA DE
ASSINATURA, NÃO-REGISTRO DO VALOR POR EXTENSO)';
	else if($codigo == '32') 
		return 'AUSÊNCIA OU IRREGULARIDADE NA APLICAÇÃO DO CARIMBO DE COMPENSAÇÃO';
	else if($codigo == '33') 
		return 'DIVERGÊNCIA DE ENDOSSO';
	else if($codigo == '34') 
		return 'CHEQUE APRESENTADO POR ESTABELECIMENTO BANCÁRIO QUE NÃO O INDICADO NO CRUZAMENTO EM
PRETO, SEM O ENDOSSO-MANDAT';
	else if($codigo == '35') 
		return 'CHEQUE FRAUDADO, EMITIDO SEM PRÉVIO CONTROLE OU RESPONSABILIDADE DO ESTABELECIMENTO
BANCÁRIO (“CHEQUE UNIVERSAL”), OU AINDA COM ADULTERAÇÃO DA PRAÇA SACADA';
	else if($codigo == '36') 
		return 'CHEQUE EMITIDO COM MAIS DE UM ENDOSSO';
	else if($codigo == '40') 
		return 'MOEDA INVÁLIDA';
	else if($codigo == '41') 
		return 'CHEQUE APRESENTADO A BANCO QUE NÃO O PAGADOR';
	else if($codigo == '42') 
		return 'CHEQUE NÃO-COMPENSÁVEL NA SESSÃO OU SISTEMA DE COMPENSAÇÃO EM QUE FOI APRESENTADO';
	else if($codigo == '43') 
		return 'CHEQUE, DEVOLVIDO ANTERIORMENTE PELOS MOTIVOS 21, 22, 23, 24, 31 OU 34, NÃO-PASSÍVEL DE
REAPRESENTAÇÃO EM VIRTUDE DE PERSISTIR O MOTIVO DA DEVOLUÇÃO.';
	else if($codigo == '44') 
		return ' CHEQUE PRESCRITO.';
	else if($codigo == '45') 
		return 'CHEQUE EMITIDO POR ENTIDADE OBRIGADA A REALIZAR MOVIMENTAÇÃO E UTILIZAÇÃO DE RECURSOS
FINANCEIROS DO TESOURO NACIONAL MEDIANTE ORDEM BANCÁRIA';
	else if($codigo == '48') 
		return 'CHEQUE DE VALOR SUPERIOR AO ESTABELECIDO, EMITIDO SEM A IDENTIFICAÇÃO DO BENEFICIÁRIO,
DEVENDO SER DEVOLVIDO A QUALQUER TEMPO';
	else if($codigo == '49') 
		return 'REMESSA NULA, CARACTERIZADA PELA REAPRESENTAÇÃO DE CHEQUE DEVOLVIDO PELOS MOTIVOS 12,
13, 14, 20, 25, 28, 30, 35, 43, 44 E 45, PODENDO A SUA DEVOLUÇÃO OCORRER A QUALQUER TEMPO';
	else
		return 'Código Inexistente para NOTA 20 - TABELA 9';
}

function nota20Tabela10_O02($cod){

	$codigo = substr($cod, 0, 2);

	if($codigo == '01') 
		return 'CEP sem atendimento de protesto no momento';
	else if($codigo == '02')  
		return 'Estado com determinação legal que impede a inscrição de inadimplentes';
	else if($codigo == '03') 
		return 'Boleto não liquidado no desconto de duplicatas e transferido para cobrança simples';
	else
		return '***';
}

function nota20Tabela11_O74($cod){

	$codigo = substr($cod, 0, 4);

	if($codigo == '6007') 
		return 'INCLUSÃO BLOQUEADA FACE A DETERMINAÇÃO JUDICIAL';
	else if($codigo == '6015')  
		return 'INCONSISTÊNCIAS NAS INFORMAÇÕES DE ENDEREÇO';
	else if($codigo == '6023') 
		return 'TÍTULO JÁ DECURSADO';
	else if($codigo == '6031') 
		return 'INCLUSÃO CONDICIONADA A APRESENTAÇÃO DE DOCUMENTO DE DÍVIDA';
	else if($codigo == '6163') 
		return 'EXCLUSÃO NÃO PERMITIDA, REGISTRO SUSPENSO';
	else if($codigo == '6171') 
		return 'EXCLUSÃO PARA REGISTRO INEXISTENTE';
	else if($codigo == '6379') 
		return 'REJEIÇÃO POR DADO(S) INCONSISTENTE(S)';
	else
		return 'Código Inexistente para NOTA 20 - TABELA 11';
}

function nota20Tabela12_O79($cod){

	$codigo = substr($cod, 0, 4);

	if($codigo == '6049') 
		return 'INFORMAÇÃO DOS CORREIOS – MUDOU-SE';
	else if($codigo == '6056')  
		return 'INFORMAÇÃO DOS CORREIOS – DEVOLVIDO POR INFORMAÇÃO PRESTADA PELO SINDICO OU PORTEIRO';
	else if($codigo == '6064')  
		return 'INFORMAÇÃO DOS CORREIOS – DEVOLVIDO POR INCONSISTÊNCIA NO ENDEREÇO';
	else if($codigo == '6072')  
		return 'INFORMAÇÃO DOS CORREIOS – DESCONHECIDO';
	else if($codigo == '6080')  
		return 'INFORMAÇÃO DOS CORREIOS – RECUSADO';
	else if($codigo == '6098')  
		return 'INFORMAÇÃO DOS CORREIOS – AUSENTE';
	else if($codigo == '6106')  
		return 'INFORMAÇÃO DOS CORREIOS – NÃO PROCURADO';
	else if($codigo == '6114')  
		return 'INFORMAÇÃO DOS CORREIOS – FALECIDO';
	else if($codigo == '6122')  
		return 'INFORMAÇÃO DOS CORREIOS – NÃO ESPECIFICADO';
	else if($codigo == '6130')  
		return 'INFORMAÇÃO DOS CORREIOS – CAIXA POSTAL INEXISTENTE';
	else if($codigo == '6148')  
		return 'INFORMAÇÃO DOS CORREIOS – DEVOLUÇÃO DO COMUNICADO DO CORREIO';
	else if($codigo == '6155')  
		return 'INFORMAÇÃO DOS CORREIOS – OUTROS MOTIVOS';
	else if($codigo == '6478')  
		return 'AR - ENTREGUE COM SUCESSO';
	else if($codigo == '6486')  
		return 'INCLUSAO PARA REGISTRO JA EXISTENTE/RECUSADO';
	else if($codigo == '6494')  
		return 'AR - CARTA EXTRAVIADA E NÃO ENTREGUE';
	else if($codigo == '6502')  
		return 'AR - CARTA ROUBADA E NÃO ENTREGUE';
	else if($codigo == '6510')  
		return 'AR - AUSENTE - ENCAMINHADO PARA ENTREGA INTERNA';
	else if($codigo == '6528')  
		return 'AR INUTILIZADO - NÃO RETIRADO NOS CORREIOS APÓS 3 TENTATIVAS';
	else if($codigo == '6536')  
		return 'AR - ENDERECO INCORRETO';
	else if($codigo == '6544')  
		return 'AR - NAO PROCURADO – DEVOLVIDO AO REMETENTE';
	else if($codigo == '6551')  
		return 'AR - NÃO ENTREGUE POR FALTA DE APRESENTAR DOCUMENTO COM FOTO';
	else if($codigo == '6569')  
		return 'AR - MUDOU-SE';
	else if($codigo == '6577')  
		return 'AR - DESCONHECIDO';
	else if($codigo == '6585')  
		return 'AR - RECUSADO';
	else if($codigo == '6593')  
		return 'AR - ENDERECO INSUFICIENTE';
	else if($codigo == '6601')  
		return 'AR - NAO EXISTE O NUMERO INDICADO';
	else if($codigo == '6618')  
		return 'AR – AUSENTE';
	else if($codigo == '6627')  
		return 'AR - CARTA NAO PROCURADA NA UNIDADE DOS CORREIOS';
	else if($codigo == '6635')  
		return 'AR – FALECIDO';
	else if($codigo == 'AR - DEVIDO A DEVOLUCAO DO COMUNICADO DO CORREIO ')  
		return '6643';
	else
		return 'Código Inexistente para NOTA 20 - TABELA 12';
}
  
?>