<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Cadastrar Usuários
      <small>Cadastre um novo Usuários</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="inicio.php?pg=inicio"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="inicio.php?pg=listarusuarios"><i class="fa fa-user"></i> Usuários</a></li>
      <li class="active">Cadastrar Usuários</li>
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
              <h3 class="box-title">Cadastrar Usuário</h3>
            </div>
            <!-- /.box-header -->

            <div class="box-body">
              <form action="inicio.php?pg=cadastrarusuarios" role="form" method="POST" enctype="multipart/form-data" name="form" id="form" onsubmit=" return validar_senha(this);">
                
                <h3> Informações de Login</h3>
                <hr>
                <!-- Login input -->
                <div class="form-group">
                  <label>login do Usuário</label>
                  <input type="text" class="form-control" placeholder="Digite o login do Usuário..." name="login" id="login" required="required">
                </div>

                <!-- Senha input -->
                <div class="form-group">
                  <label>Senha do Usuário</label>
                  <input type="password" class="form-control" placeholder="Digite a senha do Usuário..." name="senha" id="senha" required="required" onchange="validar();">
                </div>

                <!-- Confirma Senha input -->
                <div class="form-group">
                  <label>Confirmação de senha do Usuário</label>
                  <input type="password" class="form-control" placeholder="Digite igual ao valor acima!" name="confirma" id="confirma" required="required" onkeyup="validar();">
                <span id="text-confirma" class="text-red" style="visibility: collapse;">As senhas não conferem!</span>

                </div>

                <hr>


                <h3>Outras informações do Usuário</h3>
                <hr>
                <!-- nome input -->
                <div class="form-group">
                  <label>Nome do Usuário</label>
                  <input type="text" class="form-control" placeholder="Digite o nome do Usuário..." name="nome" id="nome" required="required">
                </div>

                <!-- email input -->
                <div class="form-group">
                  <label>E-mail do Usuário</label>
                  <input type="email" class="form-control" placeholder="Digite o e-mail do Usuário..." name="email" id="email">
                </div>

                <!-- select -->
                <div class="form-group">
                  <label>Função do Usuário</label>
                  <select class="form-control" name="funcao" id="funcao">
                    <option value="Administrador">Administrador</option>
                    <option value="Operador" checked="checked">Operador do Sistema</option>
                    <option value="Agendador">Agendador de Espaços </option>
                  </select>
                </div>

                <!-- select -->
                <div class="form-group">
                  <label>Situação do Usuário</label>
                  <select class="form-control" name="situacao" id="situacao">
                    <option value="ativo" checked="checked">Ativo</option>
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

<script type="text/javascript">
  
function validar(){
  var senha = form.senha.value;
  var confirma = form.confirma.value;

  if (senha != confirma){
    document.getElementById('text-confirma').style.visibility = 'visible';
  } else {
    document.getElementById('text-confirma').style.visibility = 'collapse';
  }
  
}

function validar_senha(){
  var senha = form.senha.value;
  var confirma = form.confirma.value;

  if (senha != confirma){
    confirm('As senhas não conferem!');
    form.senha.focus();
    return false;
  } else {
    return true;
  }
  
}
                                   

</script>

</body>
</html>