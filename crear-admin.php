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
          <h1>Crear Administrador</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Crear Admin</h3>

      </div>
      <div class="card-body">

        <div class="container">
          <!-- Horizontal Form -->
          <div class="card card-dark">
            <div class="card-header">
              <h3 class="card-title">Llena el formulario para crear un adminsitrador</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal" name="guardar-registro" id="guardar-registro" method="post" action="modelo-admin.php">
              <div class="card-body">
                <div class="form-group row">
                  <label for="usuario" class="col-sm-2 col-form-label">Usuario:</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="nombre" class="col-sm-2 col-form-label">Nombre:</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Escribe tu nombre completo">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="nivel" class="col-sm-2 col-form-label">Permisos de acceso:</label>
                  <div class="col-sm-10">
                    <select class="form-control select2 select2-danger" id="nivel" name="nivel" data-dropdown-css-class="select2-danger" style="width: 100%;">
                      <option value="0">User</option>
                      <option value="1">Admin</option>
                    </select>
                  </div>
                  <!-- /.form-group -->
                </div>

                <div class="form-group row">
                  <label for="password" class="col-sm-2 col-form-label">Password:</label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password para iniciar sesion">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="password" class="col-sm-2 col-form-label">Repetir Password:</label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control" id="repetir_password" name="repetir_password" placeholder="Verificar Password">
                    <span id="resultado_password" class="help-block"></span>
                  </div>
                </div>

              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <input type="hidden" name="registro" value="nuevo">
                <button type="submit" class="btn btn-dark float-right" id="crear_registro_admin">Añadir</button>
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