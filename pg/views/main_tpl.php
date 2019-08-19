
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Painel
      <small>Painel inicial</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="inicio.php?pg=inicio"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Painel inicial</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

     
      <!-- ########### BOX - CLIENTES #################-->
  <div class="row">
        <div class="col-lg-2 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $cliente->totalClientes(); ?></h3>

              <p>Total de clientes</p>
            </div>
            
            <a href="inicio.php?pg=listaclientes" class="small-box-footer">Listar clientes <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-2 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $cliente->totalClientesVivos(); ?></h3>

              <p>Total de clientes vivos</p>
            </div>
            
            <a href="inicio.php?pg=listaclientes" class="small-box-footer">Listar clientes <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-2 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $cliente->totalClientesIsentos(); ?></h3>

              <p>Total de clientes isentos</p>
            </div>
            
            <a href="inicio.php?pg=listaclientes" class="small-box-footer">Listar clientes <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-2 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo $cliente->totalClientesMortos(); ?></h3>

              <p>Total de clientes mortos</p>
            </div>
            
            <a href="inicio.php?pg=listaclientes" class="small-box-footer">Listar clientes <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-2 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3><?php echo $cliente->totalClientesAguardar(); ?></h3>

              <p>Total de clientes aguardar</p>
            </div>
            
            <a href="inicio.php?pg=listaclientes" class="small-box-footer">Listar clientes <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
  </div>
<!-- ###################### LINHA DAS ESTATÍSTICAS ########################## -->
    <div class="row">
        <div class="col-md-6">
                <div class="box box-solid">
                  <div class="box-header with-border">
                    <h3 class="box-title">Histórico de Movimentação</h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    Recebidos - <?php echo $percentual_fp; ?>%
                    <div class="progress">
                        <div class="progress-bar progress-bar-green" role="progressbar" aria-valuenow="<?php echo $percentual_fp; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $percentual_fp; ?>%">
                        <span class="sr-only"><?php echo $percentual_fp; ?>% Complete (success)</span>
                        <?php echo $faturas->totalFaturasPagas(); ?>
                      </div>
                    </div>
                    Em atraso - <?php echo $percentual_fa; ?>%
                    <div class="progress">
                      <div class="progress-bar progress-bar-aqua" role="progressbar" aria-valuenow="<?php echo $percentual_fa; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $percentual_fa; ?>%">
                        <span class="sr-only"><?php echo $percentual_fa; ?>% Complete</span>
                        <?php echo $faturas->totalFaturasAtraso(); ?>
                      </div>
                    </div>
                      Em aberto - <?php echo $percentual_faberto; ?>%
                    <div class="progress">
                      <div class="progress-bar progress-bar-yellow" role="progressbar" aria-valuenow="<?php echo $percentual_faberto; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $percentual_faberto; ?>%">
                        <span class="sr-only"><?php echo $percentual_faberto; ?>% Complete (warning)</span>
                        <?php echo $faturas->totalFaturasPendentes(); ?>
                      </div>
                    </div>
                      Cancelados - <?php echo $percentual_fc; ?>%
                    <div class="progress">
                      <div class="progress-bar progress-bar-red" role="progressbar" aria-valuenow="<?php echo $percentual_fc; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $percentual_fc; ?>%">
                        <span class="sr-only"><?php echo $percentual_fc; ?>% Complete</span>
                        <?php echo $faturas->totalFaturasCanceladas(); ?>
                      </div>
                    </div>
                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
              </div>
    </div> <!-- /.FIM DA LINHA ESTATISTICA-->

</section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->