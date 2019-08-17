<?php
set_time_limit(60);

include "../classes/conexao.php";
include "../classes/funcoes.class.php";
include "../classes/class.phpmailer.php";

function backup_bd($tabelas = '*')
{
 ################ CRIANDO O ARQUIVO DE BACKUP DO BANCO DE DADOS (.SQL)
 
    //$link = mysql_connect($host,$utilizador,$password);
    //mysql_select_db($nome,$link);
 
    //obter todas as tabelas
    if($tabelas == '*')
    {
        $tabelas = array();
        $resultado = mysql_query('SHOW TABLES');
        while($coluna = mysql_fetch_row($resultado))
        {
            $tabelas[] = $coluna[0];
        }
    }
    else
    {
        $tabelas = is_array($tabelas) ? $tabelas: explode(',',$tabelas);
    }
 
    foreach($tabelas as $tabelas)
    {
        $resultado = mysql_query('SELECT * FROM '.$tabelas);
        $num_campos = mysql_num_fields($resultado);
 
        $return.= 'DROP TABLE '.$tabelas.';';
        $coluna2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$tabelas));
        $return.= "\n\n".$coluna2[1].";\n\n";
 
        for ($i = 0; $i < $num_campos; $i++)
        {
            while($coluna = mysql_fetch_row($resultado))
            {
                $return.= 'INSERT INTO '.$tabelas.' VALUES(';
                for($j=0; $j<$num_campos; $j++)
                {
                    $coluna[$j] = addslashes($coluna[$j]);
                    $coluna[$j] = str_replace("\n","\\n",$coluna[$j]);
                    if (isset($coluna[$j])) { $return.= '"'.$coluna[$j].'"' ; } else { $return.= '""'; }
                    if ($j<($num_campos-1)) { $return.= ','; }
                }
                $return.= ");\n";
            }
        }
        $return.="\n\n\n";
    }
 
    //guarda ficheiro
	 date_default_timezone_set('America/Sao_Paulo');
	$data = date('d-m-Y--H.i.s');

	//$data = date("d-m-Y - H.i.s");
    $ficheiro = fopen('backup-'.$data.'.sql','w+');
    fwrite($ficheiro,$return);
	 
////////	converter em zip e enviar por email
////////	deletar o arquivo
	fclose($ficheiro);
	######### FIM DA CRIAÇÃO DO ARQUIVO DE BACKUP
	
	
	######### CONVERTENDO O ARQUIVO EM ZIP	
	$files = array('backup-'.$data.'.sql');
	$zipname = 'backup-'.$data.'.zip';
	$zip = new ZipArchive;
	$zip->open($zipname, ZipArchive::CREATE);
	foreach ($files as $file) {
	  $zip->addFile($file);
	}
	$zip->close();
	######### FIM DA CONVERSÃO EM ZIP
	
	######## ENVIANDO POR E-MAIL
	$sql = mysql_query("SELECT * FROM maile")or die (mysql_error());
	$linha = mysql_fetch_array($sql);
	$email = $linha['email'];
	
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->isHTML( true );
	$mail->Charset = 'UTF-8';
	$mail->SMTPAuth = true;
	//$mail->SMTPDebug = true;
	$mail->SMTPSecure = 'SSL';
	$mail->Host = $linha['url'];
	$mail->Port = $linha['porta'];
	$mail->Username = $linha['email'];
	$mail->Password = $linha['senha'];
	$mail->From = $linha['email'];
	$mail->FromName = utf8_decode($linha['empresa']);
	$mail->Subject = utf8_decode('Backup diário '.date("d-m-Y"));
	$mail->Body = 'Segue em anexo o Backup diário';
	$mail->AddAddress('uucab@hotmail.com');
	$mail->AddBCC('ilanbrazileiro@gmail.com'); // Cópia Oculta
	$mail->addAttachment('backup-'.$data.'.zip');

	$enviado = $mail->Send();
	######## FIM DO ENVIO POR E-MAIL
	
	######## DELETANDO OS ARQUIVOS
	unlink('backup-'.$data.'.zip');
	unlink('backup-'.$data.'.sql');
	######## FIM DA DELEÇÃO DOS ARQUIVOS
}

backup_bd ();

?>