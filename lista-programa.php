<?php
include_once('funciones/sesiones.php');
include_once('funciones/funciones.php');
include_once('templates/header.php');
include_once('templates/barra.php');
include_once('templates/navegacion.php');

?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Programa</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Administra el programa del proyecto </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="registros" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Descripción</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  try {
                    $sql = "SELECT * FROM programas";
                    $resultado = $conn->query($sql);
                  } catch (Exception $e) {
                    $error = $e->getMessage();
                    echo $error;
                  }

                  while ($programa = $resultado->fetch_assoc()) {
                    /* echo '<pre>';
                    var_dump($programa);
                    echo '</pre'; */
                  ?>
                    <tr>
                      <td><?php echo $programa['descripcion']; ?></td>
                      <td>
                      <?php if ($_SESSION['nivel'] == 1) : ?>
                        <a href="editar-programa.php?id=<?php echo $programa['programa_id']; ?>" class="btn bg-success btn-flat margin">
                          <i class="fas fa-pen"></i>
                        </a>
                        <a href="#" data-id="<?php echo $programa['programa_id']; ?>" data-tipo="programa" class="btn bg-danger btn-flat margin borrar_registro">
                          <i class="far fa-trash-alt"></i>
                        </a>
                        <?php endif; ?>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
                
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->


</div>
<!-- /.content-wrapper -->

<?php

include_once('templates/footer.php');
?>