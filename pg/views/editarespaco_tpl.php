<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Editar Espaço
      <small>Alterações de cadastro dos Espaços</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="inicio.php?pg=inicio"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="inicio.php?pg=inicio"><i class="fa fa-calendar"></i> Agendamentos</a></li>
      <li class="active">Editar Espaços</li>
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
              <h3 class="box-title">Editar Espaço</h3>
            </div>
            <!-- /.box-header -->

           <div class="box-body">
              <form action="inicio.php?pg=editarespaco" role="form" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id_espaco" value="<?php echo $espaco['id_espaco']; ?>">
                <!-- nome input -->
                <div class="form-group">
                  <label>Nome do Espaço</label>
                  <input type="text" class="form-control" name="nome" id="nome" required="required" value="<?php echo $espaco['nome']; ?>">
                </div>

                <!-- select -->
                <div class="form-group">
                  <label>Situação do Espaço</label>
                  <select class="form-control" name="situacao" id="situacao">
                    <option value="<?php echo $espaco['situacao']; ?>"><?php echo $espaco['situacao']; ?></option>
                    <option value="ativo">Ativo</option>
                    <option value="manutencao">Em Manutenção</option>
                    <option value="inativo">Inativo</option>
                  </select>
                </div>

                <!-- nome input -->
                <div class="form-group">
                  <label>Valor Padrão do Espaço</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-dollar"></i></span>


                    
                    <input type="text" class="form-control" name="valor" id="valor" data-thousands="." data-decimal="," value="<?php echo $espaco['valor']; ?>">
                  </div>
                </div>


                
           <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-info pull-right" name="editar">Editar</button>
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