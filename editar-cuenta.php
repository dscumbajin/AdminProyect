<?php
include_once('funciones/sesiones.php');
include_once('funciones/funciones.php');
include_once('templates/header.php');
$id = $_GET['id'];
if (!filter_var($id, FILTER_VALIDATE_INT)) {
  header("Location: ./404.php");
}
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
          <h1>Presupuesto</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Editar presupuesto</h3>
        <a id="back" href="#" class="float-right"><i class="fas fa-hand-point-left"></i> Atrás</a>
      </div>
      <div class="card-body">

        <div class="container">
          <!-- Horizontal Form -->
          <div class="card card-dark">
            <div class="card-header">
              <h3 class="card-title">Llena el formulario para editar el presupuesto mensual del proyecto</h3>
            </div>
            <!-- /.card-header -->
            <?php
            $sql = "SELECT cuentas.proyecto_id, presupuesto, anio FROM cuentas INNER JOIN registros ON registros.registros_id=cuentas.registros_id WHERE registros.registros_id = $id ";
            $resultado = $conn->query($sql);
            $resultado = $conn->query($sql);
            $cuenta = $resultado->fetch_assoc();
            $valor = $cuenta['proyecto_id'];
            /* echo '<pre>';
            var_dump($cuenta);
            echo '</pre'; */

            ?>
            <!-- form start -->
            <form class="form-horizontal" name="guardar-registro" id="guardar-registro" method="post" action="modelo-cuenta.php">
              <div class="card-body">


                <div class="form-group row">
                  <label for="cuenta" class="col-sm-2 col-form-label">Proyecto:</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="cuenta" name="cuenta" placeholder="Número de cuenta" required value="
                    <?php

                    $sql = " SELECT detalle FROM proyectos WHERE proyecto_id= $valor ";

                    $resultado = $conn->query($sql);
                    $detalle = $resultado->fetch_assoc();
                    /* echo '<pre>';
                    var_dump($detalle);
                    echo '</pre'; */
                    echo $detalle['detalle'];
                    ?>" readonly="readonly">
                  </div>
                </div>

                <!-- Date -->
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Mes:</label>
                  <?php
                  $anio = $cuenta['anio'];
                  $anio_formateada = date('m/d/Y', strtotime($anio));
                  ?>
                  <div class="col-sm-10 input-group date" id="fecha" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input" data-target="#fecha" name="anio" placeholder="Seleccionar fecha" required value="<?php echo $anio_formateada ?>" />
                    <div class="input-group-append" data-target="#fecha" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                </div>
                <!-- /.form group -->

                <div class="form-group row">
                  <label for="presupuesto" class="col-sm-2 col-form-label">Presupuesto mensual:</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" id="presupuesto-edit" name="presupuesto" placeholder="$ 0.0" required value="<?php echo $cuenta['presupuesto'] ?>">
                    <span id="resultado_resto" class="help-block"></span>
                  </div>
                </div>


              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <input type="hidden" name="registro" value="actualizar">
                <input type="hidden" name="id_registro" value="<?php echo $id ?>">
                <div class="row" style="justify-content: space-between;">

                  <h3><span class="badge badge-danger">Presupuesto total: $</span> <span id="presu" class="badge badge-danger">
                      <?php
                      $resultado = $conn->query(getPresupuesto($valor));
                      $registrados = $resultado->fetch_assoc();
                      echo $registrados['presupuesto_inicial'];
                      ?></span></h3>

                  <h3><span class="badge badge-danger">Presupuesto mensual: $</span> <span id="presuTotal" class="badge badge-danger">
                      <?php
                      $resultado = $conn->query(getTotalInversionProyecto_id($valor));
                      $registrados = $resultado->fetch_assoc();

                      if ($registrados['total'] == null) {

                        echo '0';
                      } else {
                        echo  $registrados['total'];
                      }
                      ?></span></h3>
                  <button type="submit" class="btn btn-dark float-right" id= "guardar-presu-edit">Guardar</button>
                </div>

              </div>
              <!-- /.card-footer -->
            </form>
          </div>
          <!-- /.card -->
        </div>

      </div>
      <!-- /.card-body -->

    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php

include_once('templates/footer.php');
?>