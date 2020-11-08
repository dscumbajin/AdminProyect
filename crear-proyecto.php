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
          <h1>Proyecto</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Crear nuevo proyecto</h3>

      </div>
      <div class="card-body">

        <div class="container">
          <!-- Horizontal Form -->
          <div class="card card-dark">
            <div class="card-header">
              <h3 class="card-title">Llena el formulario para crear un proyecto</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal" role="form" name="guardar-registro" id="guardar-registro-archivo" method="post" action="modelo-proyecto.php" enctype="multipart/form-data">

              <div class="card-body">

                <!-- Input detalle del proyecto-->

                <div class="form-group row">
                  <label for="detalle" class="col-sm-2 col-form-label">Proyecto</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="detalle" name="detalle" placeholder="Nombre del proyecto" required>
                  </div>
                </div>

                <!-- Input Objetivo estrategico-->

                <div class="form-group row">
                  <label for="objetivo_estrategico" class="col-sm-2 col-form-label">Objetivo estratégico</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="objetivo_estrategico" name="objetivo_estrategico" placeholder="Objetivo estratégico" required>
                  </div>
                </div>

                <!-- Input Objetivo Link de video-->

                <div class="form-group row">
                  <label for="url_video" class="col-sm-2 col-form-label">Link video</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="url_video" name="url_video" placeholder="Link video youtube - opcional">
                  </div>
                </div>
                <!-- Input presupuesto del proyecto-->

                <div class="form-group row">
                  <label for="presupuesto_inicial" class="col-sm-2 col-form-label">Presupuesto</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" id="presupuesto_inicial" name="presupuesto_inicial" placeholder="$0 " required >
                  </div>
                </div>


                <!-- Select -->

                <div class="form-group row">
                  <label for="area" class="col-sm-2 col-form-label">Portafolio:</label>
                  <div class="col-sm-10">
                    <select name="area" id="area" class="form-control seleccionar" style="width: 100%;" required>
                      <option value="">- Seleccione -</option>
                      <?php
                      try {
                        $sql = 'SELECT * FROM portafolios';

                        $resultado = $conn->query($sql);
                        while ($portafolio = $resultado->fetch_assoc()) { ?>
                          <option value="<?php echo $portafolio['portafolio_id']; ?>"><?php echo $portafolio['area']; ?></option>
                      <?php }
                      } catch (Exception $e) {
                        echo "Error: " . $e->getMessage();
                      }
                      ?>
                    </select>
                  </div>
                </div>

                <!-- Select -->
                <div class="form-group row">
                  <label for="descripcion" class="col-sm-2 col-form-label">Programa:</label>
                  <div class="col-sm-10">
                    <select name="descripcion" id="descripcion" class="form-control seleccionar" style="width: 100%;" required>
                      <option value="">- Seleccione -</option>
                      <?php
                      try {
                        $sql = 'SELECT * FROM programas';
                        $resultado = $conn->query($sql);
                        while ($programa = $resultado->fetch_assoc()) { ?>
                          <option value="<?php echo $programa['programa_id']; ?>"><?php echo $programa['descripcion']; ?></option>
                      <?php }
                      } catch (Exception $e) {
                        echo "Error: " . $e->getMessage();
                      }
                      ?>
                    </select>
                  </div>
                </div>



                <!-- Select estado neutal-->

                <div class="form-group row">
                  <label for="estado_neural" class="col-sm-2 col-form-label">Estado neural:</label>
                  <div class="col-sm-10">
                    <select class="form-control select2 select2-danger" id="estado_neural" name="estado_neural" data-dropdown-css-class="select2-danger" style="width: 100%;">
                      <option value="Activar">Activar</option>
                      <option value="Activo">Activo</option>
                      <option value="Cerrado">Cerrado</option>
                    </select>
                  </div>
                  <!-- /.form-group -->
                </div>

                <!-- Select estado-->
                <div class="form-group row">
                  <label for="estado" class="col-sm-2 col-form-label">Estado:</label>
                  <div class="col-sm-10">
                    <select name="estado" id="estado" class="form-control seleccionar" style="width: 100%;">
                      <?php
                      try {
                        $sql = 'SELECT * FROM estados';
                        $resultado = $conn->query($sql);
                        while ($estado = $resultado->fetch_assoc()) { ?>
                          <option value="<?php echo $estado['estado_id']; ?>"><?php echo $estado['estado']; ?></option>
                      <?php }
                      } catch (Exception $e) {
                        echo "Error: " . $e->getMessage();
                      }
                      ?>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label ">Archivos:</label>
                  <div class="col-sm-10">
                    <input type="file" class="form-control" id="archivo[]" name="archivo[]" multiple="">
                  </div>
                </div>

              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <input type="hidden" name="registro" value="nuevo">
                <button type="submit" class="btn btn-dark float-right" id="crear_registro">Añadir</button>
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