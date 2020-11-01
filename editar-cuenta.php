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
          <h1>Editar Cuenta</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Editar Cuenta</h3>

      </div>
      <div class="card-body">

        <div class="container">
          <!-- Horizontal Form -->
          <div class="card card-dark">
            <div class="card-header">
              <h3 class="card-title">Llena el formulario para editar la cuenta</h3>
            </div>
            <!-- /.card-header -->
            <?php
            $sql = "SELECT * FROM registros WHERE registros_id = $id ";
            $resultado = $conn->query($sql);
            $resultado = $conn->query($sql);
            $cuenta = $resultado->fetch_assoc();

            ?>
            <!-- form start -->
            <form class="form-horizontal" name="guardar-registro" id="guardar-registro" method="post" action="modelo-cuenta.php">
              <div class="card-body">


              <div class="form-group row">
                  <label for="cuenta" class="col-sm-2 col-form-label">Proyecto:</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="cuenta" name="cuenta" placeholder="Número de cuenta" required value="
                    <?php

                    $sql = " SELECT *  FROM proyectos ";
                    $sql .= " INNER JOIN cuentas ON cuentas.proyecto_id = proyectos.proyecto_id ";
                    $sql .= " WHERE cuentas.registros_id = 2 ";
                    $resultado = $conn->query($sql);
                    $detalle = $resultado->fetch_assoc();
                    echo $detalle['detalle']
                    ?>" readonly="readonly">
                  </div>
                </div>

                <!-- Date -->
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Año:</label>
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
                  <label for="presupuesto" class="col-sm-2 col-form-label">Presupuesto:</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="presupuesto" name="presupuesto" placeholder="$ 0.0" required value="<?php echo $cuenta['presupuesto'] ?>">
                  </div>
                </div>


              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <input type="hidden" name="registro" value="actualizar">
                <input type="hidden" name="id_registro" value="<?php echo $id ?>">
                <button type="submit" class="btn btn-dark float-right">Guardar</button>
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