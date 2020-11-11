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
    $phptemp=( int)$_COOKIE[ "query"]; 
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
                    <th>Proyecto</th>
                    <th>Creado</th>
                    <th>Objetivo Estrategico</th>
                    <th>Portafolio</th>
                    <th>Programa</th>
                    <th>Estado neural</th>
                    <th>Estado</th>
                    <th>Presupuesto</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  try {
                    
                    $resultado = $conn->query(getProyectosByEstadoId($id));
                  } catch (Exception $e) {
                    $error = $e->getMessage();
                    echo $error;
                  } ?>
                  <?php while ($proyecto = $resultado->fetch_assoc()) { ?>
                    <tr>
                    <td>
                    <?php echo $proyecto['detalle']; ?> - 
                    <a class="float-rigth" href="detalle-proyecto.php?id=<?php echo $proyecto['proyecto_id']; ?>"> <span class="badge badge-primary" style = "font-size: 13px"> Detalle</span>  </a>
                    </td>
                      <td><?php
                          $dt = new DateTime($proyecto['inicio']);
                          echo $dt->format('d/m/Y'); ?></td>
                      <td><?php echo $proyecto['objetivo_estrategico']; ?></td>
                      <td><?php echo $proyecto['area']; ?></td>
                      <td><?php echo $proyecto['descripcion']; ?></td>
                      <td><?php echo $proyecto['estado_neural']; ?></td>
                      <td><?php echo $proyecto['estado']; ?></td>
                      <td><?php echo $proyecto['presupuesto_inicial']; ?></td>
                      <td>
                        <?php if ($_SESSION['nivel'] == 1) : ?>
                          <a href="editar-proyecto.php?id=<?php echo $proyecto['proyecto_id']; ?>" >
                            <i class="fas fa-pen editar" ></i>
                          </a>
                          <a href="#" data-id="<?php echo $proyecto['proyecto_id']; ?>" data-tipo="proyecto" class="borrar_registro">
                            <i class="far fa-trash-alt eliminar" ></i>
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