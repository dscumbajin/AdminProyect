<?php
include_once('funciones/sesiones.php');
include_once('funciones/funciones.php');
include_once('templates/header.php');
$id = $_GET['id'];
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
        <h3 class="card-title">Presupuesto</h3>

      </div>
      <div class="card-body">

        <div class="container">
          <!-- Horizontal Form -->
          <div class="card card-dark">
            <div class="card-header">
              <h3 class="card-title">Llena el formulario asignar el presupuesto al proyecto</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal" name="guardar-registro" id="guardar-registro" method="post" action="modelo-cuenta.php">
              <div class="card-body">


                <!-- Select -->

                <div class="form-group row">
                  <label for="cuenta" class="col-sm-2 col-form-label">Proyecto:</label>
                  <div class="col-sm-10">

                    <?php
                    if (!isset($id)) {

                    ?>
                      <select name="cuenta" id="cuenta" class="form-control seleccionar" style="width: 100%;" required>
                        <option value="">- Seleccione -</option>
                        <?php
                        try {
                          $sql = 'SELECT * FROM proyectos';

                          $resultado = $conn->query($sql);
                          while ($proyecto = $resultado->fetch_assoc()) { ?>
                            <option value="<?php echo $proyecto['proyecto_id']; ?>"><?php echo $proyecto['detalle']; ?></option>
                        <?php }
                        } catch (Exception $e) {
                          echo "Error: " . $e->getMessage();
                        }
                        ?>
                      </select>


                    <?php  } else {
                      $sql = "SELECT * FROM proyectos WHERE proyecto_id = $id ";
                      $resultado = $conn->query($sql);
                      $proyecto = $resultado->fetch_assoc(); ?>
                      <select name="cuenta" id="cuenta" class="form-control seleccionar" style="width: 100%;" readonly="readonly">
                        <option value="0">- Seleccione -</option>
                        <?php
                        try {
                          $proyecto_actual = $proyecto['proyecto_id'];
                          $sql = 'SELECT proyecto_id, detalle FROM proyectos';
                          $resultado = $conn->query($sql);
                          while ($proyecto = $resultado->fetch_assoc()) {
                            if ($proyecto['proyecto_id'] == $proyecto_actual) {  ?>
                              <option value="<?php echo $proyecto['proyecto_id']; ?>" selected><?php echo $proyecto['detalle']  ?></option>
                            <?php } else { ?>
                              <option value="<?php echo $proyecto['proyecto_id']; ?>"><?php echo $proyecto['detalle']; ?></option>
                        <?php }
                          }
                        } catch (Exception $e) {
                          echo "Error: " . $e->getMessage();
                        }
                        ?>
                      </select>

                    <?php } ?>

                  </div>
                </div>

                <!-- Date -->
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Mes:</label>
                  <div class="col-sm-10 input-group date" id="fecha" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input" data-target="#fecha" name="anio" placeholder="Seleccionar fecha" required />
                    <div class="input-group-append" data-target="#fecha" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                </div>
                <!-- /.form group -->

                <div class="form-group row">
                  <label for="presupuesto" class="col-sm-2 col-form-label">Presupuesto:</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" id="presupuesto" name="presupuesto" placeholder="$ 0.0" required>
                  </div>
                </div>



              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <input type="hidden" name="registro" value="nuevo">

                <div class="row" style="justify-content: space-between;">
                  <h3><span class="badge badge-danger">Presupuesto: $ <?php
                                                                      $resultado = $conn->query(getPresupuesto($id));
                                                                      $registrados = $resultado->fetch_assoc();
                                                                      echo $registrados['presupuesto_inicial'];

                                                                      ?></span></h3>

                  <h3><span class="badge badge-danger">Inversion total: $ <?php
                                                                          $resultado = $conn->query(getTotalInversionProyecto_id($id));
                                                                          $registrados = $resultado->fetch_assoc();

                                                                          if ($registrados['total'] == null) {

                                                                            echo '0';
                                                                          } else {
                                                                            echo  $registrados['total'];
                                                                          }


                                                                          ?></span></h3>
                  <button type="submit" class="btn btn-dark float-right">Añadir</button>
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