<br/>
<ul> 
   <li><a href='inicio.php?pg=inicio' class="iconfont inicio">home</a></li>
      <li class='last'><a href='#' class="iconfont clientes">clientes</a>
       <ul>
       	 <li class='active'><a href='inicio.php?pg=cadclientes'><?php echo $config['cadclientes'] ?></a></li>
         <li class='active'><a href='inicio.php?pg=listaclientessimples'>Listar Clientes</a></li>
         <li class='active'><a href='inicio.php?pg=listaclientes'>Listar Clientes Completa</a></li>
         <!-- <li class='active'><a href='inicio.php?pg=listaclientesbanco'>Cadastros incompletos para envio banco</a></li>
         <li class='active'><a href='inicio.php?pg=listaclientes'><?php // echo $config['listaclientes'] ?></a></li>
         -->
         <li class='active'><a href='inicio.php?pg=listaclientesincompletos'>cadastros incompletos</a></li> 
         
      </ul>

   </li>
   
   <li class='last'><a href='#' class="iconfont fatura">boletos</a>
	   <ul>
       	 <li class='active'><a href='inicio.php?pg=lancafatura'><?php echo $config['lfatura'] ?></a></li>
         <li class='active'><a href='inicio.php?pg=fatpendente'><?php echo $config['pendentes'] ?></a></li>
         <li class='active'><a href='inicio.php?pg=fatvencida'><?php echo $config['vencidos'] ?></a></li>
         <li class='active'><a href='inicio.php?pg=fatbaixada'><?php echo $config['quitados'] ?></a></li>
         <!--<li class='active'><a href='inicio.php?pg=recarne'>FATURAS PERIODICAS</a></li> --> 
      </ul>
   </li>
   <li class='last'><a href='#'><i class="icon-file-text"></i>&nbsp;&nbsp; Impressão</a>
   		<ul>
		 <li class='active'><a href='inicio.php?pg=impressao_lote'>Impressão de faturas</a></li>
   		 <li class='active'><a href='inicio.php?pg=impressao_lote_pdf'>Impressão de faturas em PDF</a></li>
         <li class='active'><a href='inicio.php?pg=impressao_etiquetas'>Impressão de etiquetas</a></li>
		</ul>
   </li>
   <li class='last'><a href='#' class="iconfont clientes">E-mail</a>
   		<ul>
        	<li class='active'><a href='inicio.php?pg=enviodeemails'>Enviar E-mails</a></li>
        </ul>
   </li>
   <li><a href='#' class="iconfont config">configuracões</a>
     <ul>
         <li class='active'><a href='inicio.php?pg=configuracoes'>meus dados</a></li>
         <li class='active'><a href='inicio.php?pg=numero'>nosso numero</a></li>
          <li class='active'><a href='inicio.php?pg=grupo'><?php echo $config['grupo'] ?></a></li>
         <li class='active'><a href='inicio.php?pg=banco'>Configurar bancos</a></li>
         <!-- <li class='active'><a href='inicio.php?pg=modulos'>PayPal</a></li> -->  
         <li class='active'><a href='inicio.php?pg=confboleto'>configurar Boletos</a></li>
         <li class='active'><a href='inicio.php?pg=confmail'>Configurar Email</a></li>
         <li class='active'><a href='inicio.php?pg=listaclientesvivos'>Listar Clientes Vivos</a></li>
         <li class='active'><a href='inicio.php?pg=deletaclientes'>Deleta Clientes</a></li>
         
      </ul>
   </li>
   <li class='last'><a href='#' class="iconfont clientes">mensalidades</a>
       <ul>
       	 <li class='active'><a href='inicio.php?pg=mensalidades'>mensalidades</a></li>
         <li class='active'><a href='inicio.php?pg=mensalidadesematraso'>mensalidades em atraso</a></li>
         <li class='active'><a href='inicio.php?pg=mensalidadespagas'>mensalidades pagas</a></li>
         <li class='active'><a href='inicio.php?pg=atualiza_valores'>Atualizar Valores</a></li>
      </ul>

   </li>
   <li class='last'><a href='#'><i class="icon-file-text"></i>&nbsp;&nbsp; Relatorios</a>
<ul>
   <li class='active'><a href='inicio.php?pg=relatorio'>Relatorios</a></li></ul>
  <!--<li class='active'><a href='inicio.php?pg=fluxo' class="iconfont fluxo"><i class="icon-list-alt"></i>&nbsp;&nbsp;&nbsp;fluxo de caixa</a></li>-->
  	<li class='last'><a href='#' class="iconfont baixar">Retorno</a>
	    <ul>
            <li class='active'><a href='inicio.php?pg=baixa'>Processar retorno</a></li>
   		   	<li class='active'><a href='inicio.php?pg=viewretorno'>Relatório dos retornos</a></li>
            <li class='active'><a href='inicio.php?pg=viewretorno_liquidacao'>Relatório retorno - Liquidação</a></li>
            <li class='active'><a href='inicio.php?pg=viewretorno_cancelada'>Relatório retorno - Cancelada</a></li>
        </ul>
    </li>

      <li class='last'><a href='#'><i class="icon-file-text"></i>&nbsp;&nbsp; Remessa</a>
	   <ul>
       	 <li class='active'><a href='inicio.php?pg=remessa'>Gerar Remessa</a></li>
         <!-- <li class='active'><a href='inicio.php?pg=remessagrupo'>Remessa p/grupo</a></li>-->
         <li class='active'><a href='inicio.php?pg=listaremessa'>Listar remessa</a></li>
      </ul>
   </li>

   <li class='last'><a href='php/sair.php' class="iconfont sair">sair</a></li>
   
  
</ul>

