<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Cadastrar Espaços
      <small>Cadastre um novo Espaço</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="inicio.php?pg=inicio"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="inicio.php?pg=inicio"><i class="fa fa-calendar"></i> Agendamentos</a></li>
      <li class="active">Cadastrar Espaços</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- ALERTA DE ERRO -->
    <?php if (isset($msgfalha)){ ?>
    <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4><i class="icon fa fa-ban"></i> Alerta!</h4>
          <?php echo $msgfalha; ?>      
    </div>
    <?php } ?>

    <div class="row">
      <!-- BOX DA TABELA -->
        <div class="col-md-6">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Cadastrar Espaço</h3>
            </div>
            <!-- /.box-header -->


            <div class="box-body">
              <form action="inicio.php?pg=cadastrarespacos" role="form" method="POST" enctype="multipart/form-data">
                <!-- nome input -->
                <div class="form-group">
                  <label>Nome do Espaço</label>
                  <input type="text" class="form-control" placeholder="Digite o nome do Espaço..." name="nome" id="nome" required="required">
                </div>

                <!-- select -->
                <div class="form-group">
                  <label>Situação do Espaço</label>
                  <select class="form-control" name="situacao" id="situacao">
                    <option value="ativo" checked="checked">Ativo</option>
                    <option value="manutencao">Em Manutenção</option>
                    <option value="inativo">Inativo</option>
                  </select>
                </div>

                <!-- nome input -->
                <div class="form-group">
                  <label>Valor Padrão do Espaço</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-dollar"></i></span>


                    
                    <input type="text" class="form-control" name="valor" id="valor" data-thousands="." data-decimal=",">
                  </div>
                </div>


                
           <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-info pull-right" name="cadastrar">Cadastrar</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
          <!-- /.box -->

      <!-- FIM DO LINHA DA TABELA-->
    </div><!-- FIM DA LINHA-->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include ("footer.php"); ?>

<!-- JAVA SCRIPTS NECESSARIOS A PÁGINA-->
<script src="res/admin/plugins/maskmoney/jquery.maskMoney.min.js"></script>
<script type="text/javascript">   
    $("#valor").maskMoney();
</script>

</body>
</html>