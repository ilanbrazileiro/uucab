<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Agendamentos de Espaço
      <small>Selecione o dia para agendar um espaço</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="inicio.php?pg=inicio"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="inicio.php?pg=listarusuarios"><i class="fa fa-calendar"></i> Agendamentos</a></li>
      <li class="active">Agendamentos</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- ALERTA DE ERRO -->
    <?php if (isset($msgfalha)){ ?>
    <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <i class="icon fa fa-ban"></i> Alerta! -  <?php echo $msgfalha; ?>
    </div>
    <?php } ?>

    <!-- ALERTA DE SUCESSO -->
    <?php if (isset($msgsucesso)){ ?>
    <div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <i class="icon fa fa-check"></i> <?php echo $msgsucesso; ?>
                
    </div>
    <?php } ?>
      
     <section class="col-lg-5 connectedSortable"> 
        
        <!-- CALENDÁRIO -->

          <!-- Calendar -->
          <div class="box box-solid bg-green-gradient">
            <div class="box-header">
              <i class="fa fa-calendar"></i>

              <h3 class="box-title">Calendar</h3>
              
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <!--The calendar -->
              <div id="calendar" style="width: 100%;"></div>
            </div>
            <!-- /.box-body -->
            
          </div>
          <!-- /.box -->

        <!-- /CALENDARIO-->

    </section>

    <section class="col-lg-7 connectedSortable">

        <!-- LISTAR ESPAÇOS DISPONIVEIS -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Espaços Disponíveis</h3>
            </div>
            <!-- /.box-header -->

            <div class="box-body">
              <?php var_dump($lista); ?>
            </div>
           <!-- /.box-body -->

          </div>
          <!-- /.box -->
        <!-- /LISTAR-->

    </section>    

      

     

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include ("footer.php"); ?>

<!-- SlimScroll -->
<script src="res/admin/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="res/admin/plugins/fastclick/fastclick.js"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="res/admin/plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="res/admin/plugins/datepicker/bootstrap-datepicker.js"></script>


<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>


<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="res/admin/plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="res/admin/plugins/datepicker/bootstrap-datepicker.js"></script>


<script type="text/javascript">
$("#calendar").datepicker({
    dateFormat: 'dd/mm/yy',
    dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
    dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
    dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
    monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
    monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
    nextText: 'Próximo',
    prevText: 'Anterior'
});
</script>



</body>
</html>