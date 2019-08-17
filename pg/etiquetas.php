<?php
include "../classes/conexao.php";
include "../classes/funcoes.class.php";
require_once('pdf/mpdf.php');

if(isset($_POST['grupo'])){ //PESQUISA POR GRUPO
	$id_grupo = $_POST['id_grupo'];
	
	$sql_cliente = mysql_query("SELECT * FROM cliente WHERE bloqueado = 'N' AND id_grupo = '$id_grupo'");
	while($select_cliente = mysql_fetch_array($sql_cliente)){
			
		$nome   	= $select_cliente['dir_culto'];
		$matricula  = $select_cliente['matricula'];
		$end 		= $select_cliente['endereco'];
		$numero		= $select_cliente['numero'];
		$bairro		= $select_cliente['bairro'];
		$complemento= $select_cliente['complemento']; 
		$cidade		= $select_cliente['cidade'];
		$uf			= $select_cliente['uf'];
		$cep		= $select_cliente['cep'];
		
		$html .= "<div class='etiqueta'>
		$matricula - $nome<br>
		$end, $numero $complemento $bairro - $cidade/$uf - $cep
		</div>";
	}
	include('layout_etiquetas.php');
		
} else if(isset($_POST['cliente'])){//PESQUISA POR CLIENTE
	$id_cliente = $_POST['id_cliente'];
	
	$sql_cliente = mysql_query("SELECT * FROM cliente WHERE bloqueado = 'N' AND id_cliente = '$id_cliente'");
	while($select_cliente = mysql_fetch_array($sql_cliente)){
			
		$nome   	= $select_cliente['dir_culto'];
		$matricula  = $select_cliente['matricula'];
		$end 		= $select_cliente['endereco'];
		$numero		= $select_cliente['numero'];
		$bairro		= $select_cliente['bairro'];
		$complemento= $select_cliente['complemento']; 
		$cidade		= $select_cliente['cidade'];
		$uf			= $select_cliente['uf'];
		$cep		= $select_cliente['cep'];
		
		$html .= "<div class='etiqueta'>
		$matricula - $nome<br>
		$end, $numero $complemento<br>$bairro - 
		$cidade/$uf - $cep
		</div>";
	}
	
			
} else if(isset($_POST['intervalo'])){//PESQUISA POR CLIENTE
	$m_inicial 	= $_POST['m_inicial'];
	$m_final	= $_POST['m_final'];
	$c = 1;	
	$sql_cliente = mysql_query("SELECT * FROM cliente WHERE bloqueado = 'N' AND matricula BETWEEN '$m_inicial' AND '$m_final'");
	while($select_cliente = mysql_fetch_array($sql_cliente)){
		
		$nome   	= $select_cliente['dir_culto'];
		$matricula  = $select_cliente['matricula'];
		$end 		= $select_cliente['endereco'];
		$numero		= $select_cliente['numero'];
		$bairro		= $select_cliente['bairro'];
		$complemento= $select_cliente['complemento']; 
		$cidade		= $select_cliente['cidade'];
		$uf			= $select_cliente['uf'];
		$cep		= $select_cliente['cep'];
		
		$html .=  "<div class='etiqueta'>
		$matricula - $nome<br>
		$end, $numero $complemento $bairro <br>$cidade/$uf - CEP: $cep
		</div>";
		
		if (($c % 2) == 0) $html.= "<div class='linhainvisivel'></div>";	
		$c++;
	}
	
	require_once('pdf/mpdf.php');
	ob_start();
include('layout_etiquetas.php');
	$html = ob_get_clean();
	$mpdf = new mPDF('en-GB','A4',12,'arial');
	
	$css = file_get_contents('etiqueta.css');
	$mpdf->WriteHTML($css,1);



	$mpdf->WriteHTML($html);
		 
	$mpdf->Output('etiquetas.pdf','D');//I - Inline / D - Forçar Download
	exit;
	

		
} else if(isset($_POST['situacao'])){//PESQUISA POR CLIENTE
	$situacao = $_POST['situacao_cliente'];
	
	$sql_cliente = mysql_query("SELECT * FROM cliente WHERE situacao = '$situacao'");
	while($select_cliente = mysql_fetch_array($sql_cliente)){
			
		$nome   	= $select_cliente['dir_culto'];
		$matricula  = $select_cliente['matricula'];
		$end 		= $select_cliente['endereco'];
		$numero		= $select_cliente['numero'];
		$bairro		= $select_cliente['bairro'];
		$complemento= $select_cliente['complemento']; 
		$cidade		= $select_cliente['cidade'];
		$uf			= $select_cliente['uf'];
		$cep		= $select_cliente['cep'];
		
		$html .= "<div class='etiqueta'>
		$matricula - $nome<br>
		$end, $numero $complemento<br>$bairro - 
		$cidade/$uf - $cep
		</div>";
	}
	include('layout_etiquetas.php');
		
}

?>