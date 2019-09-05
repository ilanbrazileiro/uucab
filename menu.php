
<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

       


<ul class="sidebar-menu">

  <!-- Cabeçalho-->
    <li class="header">
      Clique para ativar
    

  <!-- Sidebar user panel -->
      <div class="user-panel">

        <div class="pull-left image">
          <?php 
            $b = $bancos->listarBancos();
            foreach ($b as $banco) {
          ?>  
            <a href="<?php echo $endereco ?>&id_banco=<?php echo $banco['id_banco'];?>&ativa=ok">
              <img src="res/img/<?php echo ($banco['situacao'] == 1 ? $banco['img'] : $banco['img2']) ?>" width="50" class="img-circle">
            </a>
            &nbsp;
          <?php } ?>
        </div>
        
      </div>

</li>
    
    
    <li class="treeview menu-open">
      <a href='inicio.php?pg=inicio'><i class="fa fa-home"></i> <span>HOME</span>
      </a></li>

   <!-- ######### CLIENTES ########### -->    
    <li class="treeview menu-open">
      <a href='inicio.php?pg=listaclientessimples'><i class="fa fa-users"></i> <span>Clientes</span>
        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
            <ul class="treeview-menu" style="">
               <li><a href='inicio.php?pg=cadclientes'>Cadastro de Clientes</a></li>
               <li><a href='inicio.php?pg=listaclientessimples'>Listar Clientes</a></li>
               <li><a href='inicio.php?pg=listaclientes'>Listar Clientes Completa</a></li>
               <li><a href='inicio.php?pg=listaclientesincompletos'>Cadastros Incompletos</a></li> 
            </ul>
    </li>

    <!-- ######### AGENDAMENTOS ########### --> 
    <li class="treeview menu-open">
      <a href='#'><i class="fa fa-calendar"></i> <span>Agendamentos</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
      </a>
          <!-- Sub menu-->      
          <ul class="treeview-menu" style="">
             <li><a href='inicio.php?pg=agendamento'>Agendamento</a></li>
             <li><a href='inicio.php?pg=listarespacos'>Listar Espaços</a></li>
          </ul>
    </li>

    <!-- ######### BOLETOS ########### -->  
    <li class="treeview menu-open">
      <a href='inicio.php?pg=fatpendente'><i class="fa fa-money"></i> <span>Boletos</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
      </a>
        <ul class="treeview-menu" style="">
            <li><a href='inicio.php?pg=lancafatura'>Lançar Faturas</a></li>
            <li><a href='inicio.php?pg=fatpendente'>Faturas Pendentes</a></li>
            <li><a href='inicio.php?pg=fatvencida'>Faturas Vencidas</a></li>
            <li><a href='inicio.php?pg=fatbaixada'>Faturas Baixadas</a></li>
        </ul>
    </li>

    <!-- ######### IMPRESSÃO ########### -->  
    <li class="treeview menu-open">
      <a href='inicio.php?pg=impressao_lote'><i class="fa fa-print"></i> <span>Impressão</span>
          <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
          </span>
      </a>
      <ul class="treeview-menu" style="">
         <li><a href='inicio.php?pg=impressao_lote'>Impressão de faturas</a></li>
         <li><a href='inicio.php?pg=impressao_lote_pdf'>Impressão de faturas em PDF</a></li>
         <li><a href='inicio.php?pg=impressao_etiquetas'>Impressão de etiquetas</a></li>
      </ul>
    </li>


    <!-- ######### E-MAILS ########### --> 
    <li class="treeview menu-open">
      <a href='#'><i class="fa fa-send"></i> <span>E-mails</span>
          <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
          </span>
      </a>
      <ul class="treeview-menu" style="">
          <li><a href='inicio.php?pg=enviodeemails'>Enviar E-mails</a></li>
      </ul>
    </li>

    <!-- ######### CONFIGURAÇÕES ########### --> 
    <li class="treeview menu-open">
      <a href='#'><i class="fa fa-cog"></i> <span>Configurações</span>
          <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
          </span>
      </a>
     <ul class="treeview-menu" style="">
         <li><a href='inicio.php?pg=configuracoes'>Meus Dados</a></li>
         <li><a href='inicio.php?pg=numero'>Nosso Número</a></li>
         <li><a href='inicio.php?pg=grupo'><?php echo $config['grupo'] ?></a></li>
         <li><a href='inicio.php?pg=banco'>Configurar bancos</a></li>
         <li><a href='inicio.php?pg=confboleto'>Configurar Boletos</a></li>
         <li><a href='inicio.php?pg=confmail'>Configurar Email</a></li>
         <li><a href='inicio.php?pg=listaclientesvivos'>Listar Clientes Vivos</a></li>
         <li><a href='inicio.php?pg=deletaclientes'>Deleta Clientes</a></li>
      </ul>
    </li>

    <!-- ######### MENSALIDADES ########### --> 
    <li class="treeview menu-open">
      <a href='#'><i class="fa fa-clock-o"></i> <span>Mensalidades</span>
          <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
          </span>
      </a>
       <ul class="treeview-menu" style="">
         <li><a href='inicio.php?pg=mensalidades'>Mensalidades</a></li>
         <li><a href='inicio.php?pg=mensalidadesematraso'>Mensalidades em atraso</a></li>
         <li><a href='inicio.php?pg=mensalidadespagas'>Mensalidades pagas</a></li>
         <li><a href='inicio.php?pg=atualiza_valores'>Atualizar Valores</a></li>
      </ul>
    </li>

    <!-- ######### RELATÓRIOS ########### --> 
    <li class="treeview menu-open">
      <a href='#'><i class="fa fa-paperclip"></i> <span>Relatórios</span>
          <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
          </span>
      </a>
      <ul class="treeview-menu" style="">
          <li><a href='inicio.php?pg=relatorio'>Relatórios</a></li>
      </ul>
    </li>  
    
    <!-- ######### RETORNO ########### --> 
    <li class="treeview menu-open">
      <a href='#'><i class="fa fa-download"></i> <span>Retorno</span>
          <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
          </span>
      </a>
      <ul class="treeview-menu" style="">
          <li><a href='inicio.php?pg=baixa'>Processar retorno</a></li>
          <li><a href='inicio.php?pg=viewretorno'>Relatório dos retornos</a></li>
          <li><a href='inicio.php?pg=viewretorno_liquidacao'>Relatório retorno - Liquidação</a></li>
          <li><a href='inicio.php?pg=viewretorno_cancelada'>Relatório retorno - Cancelada</a></li>
      </ul>
    </li>

    <!-- ######### REMESSA ########### --> 
    <li class="treeview menu-open">
      <a href='#'><i class="fa fa-file-text"></i> <span>Remessa</span>
          <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
          </span>
      </a>
      <ul class="treeview-menu" style="">
         <li><a href='inicio.php?pg=remessa'>Gerar Remessa</a></li>
         <li><a href='inicio.php?pg=listaremessa'>Listar Remessa</a></li>
      </ul>
    </li>
   
    <!-- ######### USUARIOS ########### --> 
    <li class="treeview menu-open">
      <a href='#'><i class="fa fa-user"></i> <span>Usuários</span>
          <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
          </span>
      </a>
      <ul class="treeview-menu" style="">
         <li><a href='inicio.php?pg=listarusuarios'>Listar Usuários</a></li>
         <li><a href='inicio.php?pg=cadastrarusuarios'>Cadastrar Usuário</a></li>
      </ul>
    </li>

   <!-- ######### SAIR ########### --> 
    <li class="treeview menu-open">
      <a href='php/sair.php'><i class="fa fa-power-off"></i><span>Sair</span>
      </a>
    </li>

</ul>
<!-- /.sidebar-menu -->

</section>
    <!-- /.sidebar -->
</aside>