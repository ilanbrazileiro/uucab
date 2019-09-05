<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Listar Espaços
      <small>Para adicionar um novo espaço clique no botão verde</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="inicio.php?pg=inicio"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="inicio.php?pg=inicio"><i class="fa fa-calendar"></i> Agendamentos</a></li>
      <li class="active">Listar Espaços</li>
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
      
      <!-- BOX DA TABELA -->
      <div class="row">
        <div class="col-xs-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Espaços Cadastrados</h3>
              <a href="inicio.php?pg=cadastrarespacos" class="pull-right btn btn-success"><i class="fa fa-plus"></i> Cadastrar novo</a>
            </div>
            <!-- /.box-header -->

            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                      <th>Nº</th>
                      <th>Nome</th>
                      <th>Valor Padrão</th>
                      <th>Situação</th>
                      <th>Ação</th>
                  </tr>
                </thead>

                <tbody>
                 
                  <?php foreach ($espacos->listarTodos() as $key => $e) { ?>
                    <tr>
                      <td><?php echo $key+1 ?></td>
                      <td><?php echo $e['nome'] ?></td>
                      <td><?php echo 'R$ '.number_format($e['valor'], 2, ',', '.'); ?></td>
                      <td><?php echo $e['situacao'] ?></td>
                      <td>
                        <div class="btn-group">
                            <a href="inicio.php?pg=editarespaco&id=<?php echo $e['id_espaco'] ?>" class="btn btn-default"><i class="fa fa-edit"></i> Editar</a>

                          <?php if ($admin->verificaLogin()){ ?>
                            <a href="inicio.php?pg=listarespacos&id=<?php echo $e['id_espaco'] ?>&delete=ok" class="btn btn-danger" onclick="confirm('Tem certeza que deseja excluir o cadatro?');"><i class="fa fa-ban"></i> Excluir</a>
                          <?php } ?>

                        </div>
                      </td>
                    </tr>
                 <?php } ?>
                </tbody>

                <tfoot>
                    <tr>
                      <th>Nº</th>
                      <th>Nome</th>
                      <th>Valor Padrão</th>
                      <th>Situação</th>
                      <th>Ação</th>
                    </tr>
                </tfoot>
              </table>
            </div>
           <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      <!-- FIM DO LINHA DA TABELA-->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include ("footer.php"); ?>

<!-- DataTables -->
<script src="res/admin/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="res/admin/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="res/admin/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="res/admin/plugins/fastclick/fastclick.js"></script>
<!-- page script -->
<script>
  $(function () {
    $('#example2').DataTable(
        {
            "language":
             {
                "sEmptyTable": "Nenhum registro encontrado",
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                "sLengthMenu": "_MENU_ resultados por página",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...",
                "sZeroRecords": "Nenhum registro encontrado",
                "sSearch": "Pesquisar",
                "oPaginate": 
                  {
                    "sNext": "Próximo",
                    "sPrevious": "Anterior",
                    "sFirst": "Primeiro",
                    "sLast": "Último"
                  },
                "oAria": 
                  {
                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                  }
              }
        });
  });
</script>

</body>
</html>