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
          <h1>Crear Portafolio</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Crear Portafolio</h3>
        <a id="lista" href="#" class="float-right"><i class="fas fa-hand-point-left"></i> Atrás</a>
      </div>
      <div class="card-body">

        <div class="container">
          <!-- Horizontal Form -->
          <div class="card card-dark">
            <div class="card-header">
              <h3 class="card-title">Llena el formulario</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal" name="guardar-registro" id="guardar-registro" method="post" action="modelo-portafolio.php">
              <div class="card-body">
                <div class="form-group row">
                  <label for="area" class="col-sm-2 col-form-label">Área:</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="area" name="area" placeholder="Área de trabajo" required>
                  </div>
                </div>

              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <input type="hidden" name="registro" value="nuevo">
                <button type="submit" class="btn btn-dark float-right">Añadir</button>
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