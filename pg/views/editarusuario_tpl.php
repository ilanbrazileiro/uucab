<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Editar Usuário
      <small>Alterações de cadastro do Usuário</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="inicio.php?pg=inicio"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="inicio.php?pg=listarusuarios"><i class="fa fa-user"></i> Usuários</a></li>
      <li class="active">Editar Usuários</li>
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
              <h3 class="box-title">Editar Usuário</h3>
            </div>
            <!-- /.box-header -->

           <div class="box-body">
              <form action="inicio.php?pg=editarusuario" role="form" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id_usuario" value="<?php echo $usuario['id_usuario']; ?>">
               
               <h3> Informações de Login</h3>
                <hr>
                <!-- Login input -->
                <div class="form-group">
                  <label>login do Usuário</label>
                  <input type="text" class="form-control" placeholder="Digite o login do Usuário..." name="login" id="login" required="required" value="<?php echo $usuario['login']; ?>">
                </div>

                <hr>

                <h3>Outras informações do Usuário</h3>
                <hr>
                <!-- nome input -->
                <div class="form-group">
                  <label>Nome do Usuário</label>
                  <input type="text" class="form-control" placeholder="Digite o nome do Usuário..." name="nome" id="nome" required="required" value="<?php echo $usuario['nome']; ?>">
                </div>

                <!-- email input -->
                <div class="form-group">
                  <label>E-mail do Usuário</label>
                  <input type="email" class="form-control" placeholder="Digite o e-mail do Usuário..." name="email" id="email" value="<?php echo $usuario['email']; ?>">
                </div>

                <!-- select -->
                <div class="form-group">
                  <label>Função do Usuário</label>
                  <select class="form-control" name="funcao" id="funcao">
                    <option value="<?php echo $usuario['funcao']; ?>" checked><?php echo $usuario['funcao']; ?></option>
                    <option value="Administrador">Administrador</option>
                    <option value="Operador" checked="checked">Operador do Sistema</option>
                    <option value="Agendador">Agendador de Espaços </option>
                  </select>
                </div>

                <!-- select -->
                <div class="form-group">
                  <label>Situação do Usuário</label>
                  <select class="form-control" name="situacao" id="situacao">
                    <option value="<?php echo $usuario['situacao']; ?>"><?php echo $usuario['situacao']; ?></option>
                    <option value="ativo">Ativo</option>
                    <option value="inativo">Inativo</option>
                  </select>
                </div>

                <!-- Imagem do Usuário -->
                <div class="form-group">
                  <label>Imagem do Usuário</label>
                  <input type="file" class="form-control" name="imagem" id="imagem">
                    
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