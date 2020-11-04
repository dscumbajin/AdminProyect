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
          <h1>Proyectos según estado: </h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <?include_once('templates/content.php');?>
  
</div>


<?php

include_once('templates/footer.php');
?>