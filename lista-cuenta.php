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
          <h1>Presupuestos</h1>
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
              <h3 class="card-title">Presupuestos Asignados</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="registros" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Inversión</th>
                    <th>Año</th>
                    <th>Mes</th>
                    <th>Valor</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  try {

                    $sql = " SELECT proyectos.proyecto_id, registros.registros_id, proyectos.detalle, presupuesto, anio  FROM cuentas ";
                    $sql .= " INNER JOIN registros ON registros.registros_id = cuentas.registros_id ";
                    $sql .= " INNER JOIN proyectos ON proyectos.proyecto_id = cuentas.proyecto_id ";
                    $sql .= " WHERE cuentas.proyecto_id = proyectos.proyecto_id ";

                    $resultado = $conn->query($sql);
                  } catch (Exception $e) {
                    $error = $e->getMessage();
                    echo $error;
                  }

                  while ($cuenta = $resultado->fetch_assoc()) {
                    /* echo '<pre>';
                    var_dump($cuenta);
                    echo '</pre'; */
                  ?>
                    <tr>
                      <td>
                        <?php echo $cuenta['detalle']; ?></td>
                      <td>
                        <?php
                        $fechaComoEntero = strtotime($cuenta['anio']);
                        $anio = date("Y", $fechaComoEntero);
                        echo $anio;
                        ?>
                      </td>
                      <td>
                        <?php
                        $fechaComoEntero = strtotime($cuenta['anio']);
                        $anio = date("M", $fechaComoEntero);
                        echo $anio;
                        ?>
                      </td>
                      <td> <i class="fas fa-comment-dollar"></i> <?php echo $cuenta['presupuesto']; ?></td>
                      <td>
                        <?php if ($_SESSION['nivel'] == 1) : ?>
                          <a href="editar-cuenta.php?id=<?php echo $cuenta['registros_id'] ; ?>" >
                            <i class="fas fa-pen editar"></i>
                          </a>
                          <a href="#" data-id="<?php echo $cuenta['registros_id']; ?>" data-tipo="cuenta" class="borrar_registro">
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