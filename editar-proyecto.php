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
          <h1>Proyectos</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Editar Proyecto</h3>

      </div>
      <div class="card-body">

        <div class="container">
          <!-- Horizontal Form -->
          <div class="card card-dark">
            <div class="card-header">
              <h3 class="card-title">Llena el formulario para editar un proyecto</h3>
            </div>
            <!-- /.card-header -->
            <?php
            $sql = "SELECT * FROM proyectos WHERE proyecto_id = $id ";
            $resultado = $conn->query($sql);
            $proyecto = $resultado->fetch_assoc();
           /*  echo '<pre>';
            var_dump($proyecto);
            echo '</pre'; */

            ?>
            <!-- form start -->
            <form class="form-horizontal" name="guardar-registro" id="guardar-registro" method="post" action="modelo-proyecto.php">
              <div class="card-body">

                <!-- Input detalle del proyecto-->
                <div class="form-group row">
                  <label for="detalle" class="col-sm-2 col-form-label">Proyecto</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="detalle" name="detalle" placeholder="Nombre del proyecto" required value="<?php echo $proyecto['detalle'] ?>">
                  </div>
                </div>


                <!-- Input Objetivo estrategico-->

                <div class="form-group row">
                  <label for="objetivo_estrategico" class="col-sm-2 col-form-label">Objetivo estratégico</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="objetivo_estrategico" name="objetivo_estrategico" placeholder="Objetivo estratégico" required value="<?php echo $proyecto['objetivo_estrategico'] ?>">
                  </div>
                </div>

                <!-- Input Objetivo Link de video-->

                <div class="form-group row">
                  <label for="url_video" class="col-sm-2 col-form-label">Link video</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="url_video" name="url_video" placeholder="Link video youtube - opcional" value="<?php echo $proyecto['url_video '] ?>">
                  </div>
                </div>

                <!-- Input presupuesto del proyecto-->

                <div class="form-group row">
                  <label for="presupuesto_inicial" class="col-sm-2 col-form-label">Presupuesto inicial</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="presupuesto_inicial" name="presupuesto_inicial" placeholder="Presupuesto Inicial" required value="<?php echo $proyecto['presupuesto_inicial'] ?>">
                  </div>
                </div>




                <!--Select Portafolio-->

                <div class="form-group row">
                  <label for="area" class="col-sm-2 col-form-label">Portafolio:</label>
                  <div class="col-sm-10">
                    <select name="area" id="area" class="form-control seleccionar" style="width: 100%;">
                      <option value="0">- Seleccione -</option>
                      <?php
                      try {
                        $portafolio_actual = $proyecto['portafolio_id'];
                        $sql = 'SELECT portafolio_id, area FROM portafolios';
                        $resultado = $conn->query($sql);
                        while ($portafolio = $resultado->fetch_assoc()) {
                          if ($portafolio['portafolio_id'] == $portafolio_actual) { ?>
                            <option value="<?php echo $portafolio['portafolio_id']; ?>" selected><?php echo $portafolio['area']  ?></option>
                          <?php } else { ?>
                            <option value="<?php echo $portafolio['portafolio_id']; ?>"><?php echo $portafolio['area']; ?></option>
                      <?php }
                        }
                      } catch (Exception $e) {
                        echo "Error: " . $e->getMessage();
                      }
                      ?>
                    </select>
                  </div>
                </div>

                <!--Select Programa-->

                <div class="form-group row">
                  <label for="descripcion" class="col-sm-2 col-form-label">Programa:</label>
                  <div class="col-sm-10">
                    <select name="descripcion" id="descripcion" class="form-control seleccionar" style="width: 100%;">
                      <option value="0">- Seleccione -</option>
                      <?php
                      try {
                        $programa_actual = $proyecto['programa_id'];
                        $sql = 'SELECT programa_id, descripcion FROM programas';
                        $resultado = $conn->query($sql);
                        while ($programa = $resultado->fetch_assoc()) {
                          if ($programa['programa_id'] == $programa_actual) { ?>
                            <option value="<?php echo $programa['programa_id']; ?>" selected><?php echo $programa['descripcion']  ?></option>
                          <?php } else { ?>
                            <option value="<?php echo $programa['programa_id']; ?>"><?php echo $programa['descripcion']; ?></option>
                      <?php }
                        }
                      } catch (Exception $e) {
                        echo "Error: " . $e->getMessage();
                      }
                      ?>
                    </select>
                  </div>
                </div>


                <!--Select estado neural-->

                <div class="form-group row">
                  <label for="estado_neural" class="col-sm-2 col-form-label">Estado neural</label>
                  <div class="col-sm-10">
                    <select class="form-control select2 select2-danger" id="estado_neural" name="estado_neural" data-dropdown-css-class="select2-danger" style="width: 100%;">
                      <?php
                      if ($proyecto['estado_neural'] == 'activar') { ?>
                        <option value="activar" selected>Activar</option>
                        <option value="activo">Activo</option>
                        <option value="cerrado">Cerrado</option>

                      <?php } else if ($proyecto['estado_neural'] == 'activo') { ?>
                        <option value="activar">Activar</option>
                        <option value="activo" selected>Activo</option>
                        <option value="cerrado">Cerrado</option>
                      <?php
                      } else { ?>
                        <option value="activar">Activar</option>
                        <option value="activo">Activo</option>
                        <option value="cerrado" selected>Cerrado</option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                  <!-- /.form-group -->
                </div>

                <!--Select estado-->
                <div class="form-group row">
                  <label for="estado" class="col-sm-2 col-form-label">Estado:</label>
                  <div class="col-sm-10">
                    <select name="estado" id="estado" class="form-control seleccionar" style="width: 100%;">
                      <option value="0">- Seleccione -</option>
                      <?php
                      try {
                        $estado_actual = $proyecto['estado_id'];
                        $sql = " SELECT * FROM estados ";
                        $resultado = $conn->query($sql);

                        while ($estado = $resultado->fetch_assoc()) {
                          
                          if ($estado['estado_id'] == $estado_actual) { ?>
                            <option value="<?php echo $estado['estado_id']; ?>" selected><?php echo $estado['estado']; ?>
                            </option>
                          <?php } else { ?>
                            <option value="<?php echo $estado['estado_id']; ?>">
                              <?php echo $estado['estado']; ?>
                            </option>
                      <?php }
                        }
                      } catch (Exception $e) {
                        echo "Error: " . $e->getMessage();
                      }
                      ?>
                    </select>
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