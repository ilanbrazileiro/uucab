
<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src='{function="getUserimage()"}' class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{function="getUserlogin()"}</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

    


<ul class="sidebar-menu">
    <li class="header">MENU</li>
    
    <li><a href='inicio.php?pg=inicio'><i class="fa fa-home"></i> HOME</a></li>

   <!-- ######### CLIENTES ########### -->    
    <li><a href='inicio.php?pg=listaclientessimples'><i class="fa fa-users"></i> Clientes</a>
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

    <!-- ######### BOLETOS ########### -->  
    <li><a href='inicio.php?pg=fatpendente'><i class="fa fa-money"></i> Boletos</a>
     <ul>
         <li class='active'><a href='inicio.php?pg=lancafatura'><?php echo $config['lfatura'] ?></a></li>
         <li class='active'><a href='inicio.php?pg=fatpendente'><?php echo $config['pendentes'] ?></a></li>
         <li class='active'><a href='inicio.php?pg=fatvencida'><?php echo $config['vencidos'] ?></a></li>
         <li class='active'><a href='inicio.php?pg=fatbaixada'><?php echo $config['quitados'] ?></a></li>
         <!--<li class='active'><a href='inicio.php?pg=recarne'>FATURAS PERIODICAS</a></li> --> 
      </ul>
    </li>

    <!-- ######### IMPRESSÃO ########### -->  
    <li><a href='inicio.php?pg=impressao_lote'><i class="fa fa-print"></i>&nbsp;&nbsp;Impressão</a>
      <ul>
         <li class='active'><a href='inicio.php?pg=impressao_lote'>Impressão de faturas</a></li>
         <li class='active'><a href='inicio.php?pg=impressao_lote_pdf'>Impressão de faturas em PDF</a></li>
         <li class='active'><a href='inicio.php?pg=impressao_etiquetas'>Impressão de etiquetas</a></li>
      </ul>
    </li>


    <!-- ######### E-MAILS ########### --> 
    <li><a href='#'><i class="fa fa-send"></i>&nbsp;&nbsp;E-mails</a>
      <ul>
          <li class='active'><a href='inicio.php?pg=enviodeemails'>Enviar E-mails</a></li>
      </ul>
    </li>

    <!-- ######### CONFIGURAÇÕES ########### --> 
    <li><a href='#'><i class="fa fa-cog"></i>&nbsp;&nbsp;Configuracões</a>
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

    <!-- ######### MENSALIDADES ########### --> 
    <li><a href='#'><i class="fa fa-clock-o"></i>&nbsp;&nbsp;Mensalidades</a>
       <ul>
         <li class='active'><a href='inicio.php?pg=mensalidades'>mensalidades</a></li>
         <li class='active'><a href='inicio.php?pg=mensalidadesematraso'>mensalidades em atraso</a></li>
         <li class='active'><a href='inicio.php?pg=mensalidadespagas'>mensalidades pagas</a></li>
         <li class='active'><a href='inicio.php?pg=atualiza_valores'>Atualizar Valores</a></li>
      </ul>
    </li>

    <!-- ######### RELATÓRIOS ########### --> 
    <li><a href='#'><i class="fa fa-paperclip"></i>&nbsp;&nbsp; Relatorios</a>
      <ul>
          <li class='active'><a href='inicio.php?pg=relatorio'>Relatorios</a></li>
      </ul>
    </li>  
    
    <!-- ######### RETORNO ########### --> 
    <li><a href='#'><i class="fa fa-download"></i>&nbsp;&nbsp; Retorno</a>
      <ul>
          <li class='active'><a href='inicio.php?pg=baixa'>Processar retorno</a></li>
          <li class='active'><a href='inicio.php?pg=viewretorno'>Relatório dos retornos</a></li>
          <li class='active'><a href='inicio.php?pg=viewretorno_liquidacao'>Relatório retorno - Liquidação</a></li>
          <li class='active'><a href='inicio.php?pg=viewretorno_cancelada'>Relatório retorno - Cancelada</a></li>
      </ul>
    </li>

    <!-- ######### REMESSA ########### --> 
    <li><a href='#'><i class="fa fa-file-text"></i>&nbsp;&nbsp;Remessa</a>
      <ul>
         <li class='active'><a href='inicio.php?pg=remessa'>Gerar Remessa</a></li>
         <!-- <li class='active'><a href='inicio.php?pg=remessagrupo'>Remessa p/grupo</a></li>-->
         <li class='active'><a href='inicio.php?pg=listaremessa'>Listar remessa</a></li>
      </ul>
    </li>

    <!-- ######### AGENDAMENTOS ########### --> 
    <li class="treeview menu-open"><a href='#'><i class="fa fa-calendar"></i>&nbsp;&nbsp;Agendamentos</a>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
      <!-- Sub menu-->      
      <ul class="treeview-menu" style="">
         <li class='active'><a href='#'>Agendamento</a></li>
      </ul>
    </li>

    <!-- ######### USUARIOS ########### --> 
    <li><a href='#'><i class="fa fa-user"></i>&nbsp;&nbsp;Usuários</a>
      <ul>
         <li class='active'><a href='#'>Listar Usuários</a></li>
         <li class='active'><a href='#'>Cadastrar Usuário</a></li>
      </ul>
    </li>

   <!-- ######### SAIR ########### --> 
   <li><a href='php/sair.php'><i class="fa fa-power-off"></i>&nbsp;&nbsp;Sair</a></li>

        <!-- MENU INTERAÇÔES -->
        <li class="treeview menu-open">
          <a href="/admin/interacao">
            <i class="fa fa-link"></i> <span>Interações</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
            <ul class="treeview-menu" style="">
                <li><a href="/admin/interacao-woocommerce"><i class="fa fa-circle-o"></i>Woocommerce</a></li>
                <li><a href="/admin/interacao-mercadolivre">Mercado Livre</a></li>
            </ul>
        </li>

</ul>
<!-- /.sidebar-menu -->

</section>
    <!-- /.sidebar -->
</aside>