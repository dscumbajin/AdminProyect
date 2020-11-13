<?php
include_once('funciones/sesiones.php');
include_once('funciones/funciones.php');
include_once('funciones/utilitarios.php');
include_once('templates/header.php');
$id = $_GET['id'];

/* if (!filter_var($id, FILTER_VALIDATE_INT)) {
  header("Location: ./404.php");
} */
include_once('templates/barra.php');
include_once('templates/navegacion.php');

?>


<?php
$phptemp = (int)$_COOKIE["query"];
/*  if (!is_nan($phptemp))
    { 
      
    }  */
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">

          <?php $sql = " SELECT estado FROM estados WHERE estado_id= $id ";
          $resultado = $conn->query($sql);
          $estado = $resultado->fetch_assoc(); ?>
          <h1>Proyectos - <?php echo $estado['estado']; ?></h1>

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
              <h3 class="card-title">Administra los proyectos en esta sección</h3>
              <a id="lista" href="#" class="float-right"><i class="fas fa-hand-point-left"></i> Atrás</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="registros" class="table table-bordered table-striped">
                <thead>
                  <tr>

                    <th>Portafolio</th>
                    <th>Programa</th>
                    <th>Creado</th>
                    <th>Proyecto</th>
                    <th>Objetivo</th>
                    <th>Alcance</th>
                    <th>
                      <p style=" width: 50px; margin: 0 0;">Estado neural</p>
                    </th>
                    <th>Estado</th>
                    <th>Nº cuenta</th>
                    <th>Presupuesto</th>
                    <th>
                      <p style=" width: 55px; margin: 0 0;">Inversión total</p>
                    </th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  try {

                    $resultado = $conn->query(getTotalByEstadoId($id));
                  } catch (Exception $e) {
                    $error = $e->getMessage();
                    echo $error;
                  } ?>
                  <?php while ($proyecto = $resultado->fetch_assoc()) { ?>
                    <tr>

                      <td id= "margen"><?php echo $proyecto['area']; ?></td>
                      <td>
                        <p class="ellipsis"><?php echo $proyecto['descripcion']; ?></p>
                      </td>
                      <td><?php
                          $dt = new DateTime($proyecto['inicio']);
                          echo $dt->format('d/m/Y'); ?></td>
                      <td>
                        <?php echo $proyecto['detalle']; ?> -
                        <a class="float-rigth" href="detalle-proyecto.php?id=<?php echo $proyecto['proyecto_id']; ?>"> <span class="badge badge-primary" style="font-size: 13px"> Detalle</span> </a>
                      </td>

                      <td>
                        <p class="ellipsis"><?php echo $proyecto['objetivo_estrategico']; ?></p>
                      </td>
                      <td>
                        <p class="ellipsis"><?php echo $proyecto['alcance']; ?> </p>
                      </td>

                      <td><?php echo $proyecto['estado_neural']; ?></td>
                      <td><?php echo $proyecto['estado']; ?></td>
                      <td><?php 
                      $tamanoCuenta = $proyecto['cuenta'];
                      if (strlen($tamanoCuenta)<6) { 
                        echo ' <span class="badge badge-danger">Asignar cuenta</span>';
                           
                          } else {
                            echo $proyecto['cuenta'];
                          } ?></td>
                      <td><?php echo $proyecto['presupuesto_inicial']; ?></td>
                      <td><?php echo $proyecto['total']; ?></td>
                      <td>
                        <?php if ($_SESSION['nivel'] == 1) : ?>
                          <a style="margin: 0 0;" href="editar-proyecto.php?id=<?php echo $proyecto['proyecto_id']; ?>">
                            <i class="fas fa-pen editar"></i>
                          </a>
                          <a style="margin: 0 0;" href="#" data-id="<?php echo $proyecto['proyecto_id']; ?>" data-tipo="proyecto" class="borrar_registro">
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

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">

          <div class="card">
            <div class="card-header">

              <div class="col-sm-2 input-group date" id="Cabecera_1" data-target-input="nearest">
                <input type="text" class="form-control datetimepicker-input" data-target="#Cabecera_1" id="valor-query" name="valor-query" placeholder="Año" required />
                <div class="input-group-append" data-target="#Cabecera_1" data-toggle="datetimepicker">
                  <div id="chose" class="input-group-text"><i class="fas fa-calendar-alt eliminar"></i></div>
                </div>
              </div>

            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="registros1" class="table-responsive table table-bordered table-striped">
                <tr>
                  <th rowspan="2" style="text-align: center;">
                    <span class="badge badge-pill badge-dark" style="font-size: 15px;"><?php echo $phptemp ?></span>
                  </th>
                </tr>
                <tr id="Cabecera_2">
                  <th>Enero</th>
                  <th>Febrero</th>
                  <th>Marzo</th>
                  <th>Abril</th>
                  <th>Mayo</th>
                  <th>Jinio</th>
                  <th>Julio</th>
                  <th>Agosto</th>
                  <th>Septiembre</th>
                  <th>Octubre</th>
                  <th>Noviembre</th>
                  <th>Diciembre</th>
                </tr>
                <tr id="2017_Abril_Viernes_28">

                  <td>Total pagar mes</td>
                  <?php
                  $i = 1;
                  while ($i <= 12) : ?>

                    <td> <i class="fas fa-dollar-sign"></i>
                      <?php
                      $resultado = $conn->query(pagar($id, $i, $phptemp));
                      $registrados = $resultado->fetch_assoc();

                      if ($registrados['total'] == null) {

                        echo '0';
                      } else {
                        echo  $registrados['total'];
                      }
                      $i++;
                      ?>
                    </td>

                  <?php endwhile; ?>

                </tr>

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