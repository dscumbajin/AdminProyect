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
          <h1>Portafolios</h1>
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
              <h3 class="card-title">Administra los portafolios de los proyectos en esta sección </h3>
              <a id="lista" href="#" class="float-right"><i class="fas fa-hand-point-left"></i> Atrás</a>

            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="registros" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Area</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  try {
                    $sql = "SELECT * FROM portafolios";
                    $resultado = $conn->query($sql);
                  } catch (Exception $e) {
                    $error = $e->getMessage();
                    echo $error;
                  }

                  while ($portafolio = $resultado->fetch_assoc()) {
                    /* echo '<pre>';
                    var_dump($portafolio);
                    echo '</pre'; */
                  ?>
                    <tr>
                      <td><?php echo $portafolio['area']; ?></td>
                      <td>
                      <?php if ($_SESSION['nivel'] == 1) : ?>
                        <a href="editar-portafolio.php?id=<?php echo $portafolio['portafolio_id']; ?>" >
                          <i class="fas fa-pen editar"></i>
                        </a>
                        <a href="#" data-id="<?php echo $portafolio['portafolio_id']; ?>" data-tipo="portafolio" class="borrar_registro">
                          <i class="far fa-trash-alt eliminar"></i>
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