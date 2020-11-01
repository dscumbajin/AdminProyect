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
          <h1>Proyectos</h1>
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
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="registros" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    
                    <th>Item</th>
                    <th>Proyecto</th>
                    <th>Objetivo Estrategico</th>
                    <th>Presupuesto Inicial</th>
                    <th>Portafolio</th>
                    <th>Programa</th>                  
                    <th>Estado neural</th>
                    <th>Estado</th>
                    <th>Presupuesto Asignado</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  try {
                    $sql = "SELECT proyecto_id, detalle, objetivo_estrategico, presupuesto_inicial, estado_neural, estado, area, descripcion ";
                    $sql .= " FROM proyectos ";
                    $sql .= " INNER JOIN portafolios ";
                    $sql .= " ON proyectos.portafolio_id = portafolios.portafolio_id ";
                    $sql .= " INNER JOIN programas ";
                    $sql .= " ON proyectos.programa_id=programas.programa_id ";
                    $sql .= " INNER JOIN estados ";
                    $sql .= " ON proyectos.estado_id=estados.estado_id ";
                    $sql .= " ORDER BY proyecto_id DESC ";
                    $resultado = $conn->query($sql);
                  } catch (Exception $e) {
                    $error = $e->getMessage();
                    echo $error;
                  }
                  while ($proyecto = $resultado->fetch_assoc()) { ?>
                    <tr>
                      <td><?php echo $proyecto['proyecto_id']; ?></td>
                      <td><a href="detalle-proyecto.php?id=<?php echo $proyecto['proyecto_id']; ?>"><?php echo $proyecto['detalle']; ?></a></td>
                      <td><?php echo $proyecto['objetivo_estrategico']; ?></td>
                      <td><?php echo $proyecto['presupuesto_inicial']; ?></td>
                      <td><?php echo $proyecto['area']; ?></td>
                      <td><?php echo $proyecto['descripcion']; ?></td>
                      <td><?php echo $proyecto['estado_neural']; ?></td>
                      <td><?php echo $proyecto['estado']; ?></td>       
                      <td><a href="detalle-proyecto.php?id=<?php echo $proyecto['proyecto_id']; ?>"> Detalle </a></td>
                      
                      <td>
                      <?php if ($_SESSION['nivel'] == 1) : ?>
                        <a href="editar-proyecto.php?id=<?php echo $proyecto['proyecto_id']; ?>" class="btn bg-success btn-flat margin">
                          <i class="fas fa-pen"></i>
                        </a>
                        <a href="#" data-id="<?php echo $proyecto['proyecto_id']; ?>" data-tipo="proyecto" class="btn bg-danger btn-flat margin borrar_registro">
                          <i class="far fa-trash-alt"></i>
                        </a>
                        <?php endif; ?>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
                <tfoot>
                  <tr>
                    
                    <th>Item</th>
                    <th>Proyecto</th>
                    <th>Objetivo Estrategico</th>
                    <th>Presupuesto Inicial</th>
                    <th>Portafolio</th>
                    <th>Programa</th>
                    <th>Estado neural</th>
                    <th>Estado</th>
                    <th>Presupuesto Asignado</th>
                    <th>Acciones</th>
                  </tr>
                </tfoot>
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