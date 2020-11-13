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
              <a id="lista" href="#" class="float-right"><i class="fas fa-hand-point-left"></i> Atrás</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="registros" class="table table-bordered table-striped">
                <thead>
                  <tr>
                  
                    <th>Portafolio</th>
                    <th>Programa</th>
                    <th>Creado</th>
                    <th>Proyecto</th>
                    <th>Objetivo</th>
                    <th>Alcance</th>
                    <th>
                      <p style=" width: 50px; margin: 0 0;">Estado neural</p>
                    </th>
                    <th>Estado</th>
                    <th>Nº cuenta </th>
                    <th>Presupuesto</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  try {
                    $sql = "SELECT proyecto_id,inicio,cuenta, detalle, objetivo_estrategico, alcance, presupuesto_inicial, estado_neural, estado, area, descripcion ";
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
                    
                      <td id= "margen"><?php echo $proyecto['area']; ?></td>
                      <td><?php echo $proyecto['descripcion']; ?></td>
                      <td><?php
                          $dt = new DateTime($proyecto['inicio']);
                          echo $dt->format('d/m/Y'); ?></td>
                      <td>
                        <?php echo $proyecto['detalle']; ?> -
                        <a class="float-rigth" href="detalle-proyecto.php?id=<?php echo $proyecto['proyecto_id']; ?>"> <span class="badge badge-primary" style="font-size: 13px"> Detalle</span> </a>
                      </td>
                      <td>
                        <p style=" width: 130px; margin: 0 auto; text-align: justify"><?php echo $proyecto['objetivo_estrategico']; ?></p>
                      </td>
                      <td>
                        <p style=" width: 130px; margin: 0 auto; text-align: justify"><?php echo $proyecto['alcance']; ?> </p>
                      </td>
                      <td><?php echo $proyecto['estado_neural']; ?></td>
                      <td><?php echo $proyecto['estado']; ?></td>
                      <td><?php if ($proyecto['cuenta'] !== "0") {
                            echo $proyecto['cuenta'];
                          } else {
                            echo ' <span class="badge badge-danger">Asignar cuenta</span>';
                          } ?></td>
                      <td><?php echo $proyecto['presupuesto_inicial']; ?></td>
                      <td>
                        <?php if ($_SESSION['nivel'] == 1) : ?>
                          <a href="editar-proyecto.php?id=<?php echo $proyecto['proyecto_id']; ?>">
                            <i class="fas fa-pen editar"></i>
                          </a>
                          <a href="#" data-id="<?php echo $proyecto['proyecto_id']; ?>" data-tipo="proyecto" class="borrar_registro">
                            <i class="far fa-trash-alt eliminar"></i>
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