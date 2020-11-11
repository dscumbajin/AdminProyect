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

  <?php
    try {
      $sql = "SELECT proyecto_id,cuenta, detalle,url_video, url_documento, objetivo_estrategico, presupuesto_inicial, estado_neural, estados.estado_id, estado, area, descripcion ";
      $sql .= " FROM proyectos ";
      $sql .= " INNER JOIN portafolios ";
      $sql .= " ON proyectos.portafolio_id = portafolios.portafolio_id ";
      $sql .= " INNER JOIN programas ";
      $sql .= " ON proyectos.programa_id=programas.programa_id ";
      $sql .= " INNER JOIN estados ";
      $sql .= " ON proyectos.estado_id=estados.estado_id ";
      $sql .= " WHERE proyecto_id = $id ";

      $resultado = $conn->query($sql);

      $proyecto = $resultado->fetch_assoc();
      /* echo '<pre>';
      var_dump($proyecto);
      echo '</pre'; */
    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
    }
    ?>

  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Proyecto: <?php echo $proyecto['detalle'] ?> </h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    
    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">N° cuenta: <?php echo $proyecto['cuenta'] ?></h3>

      </div>
      <div class="card-body">
        <!--New Row-->
        <div class="row">
          <!--Mostar video-->
          <?php
          $video = "col-sm-2";
          $cartel = "col-sm-10";
          if ($proyecto['url_video'] !== "") {
            $video = "col-sm-2";
            $cartel = "col-sm-10"; ?>
            <!--Div video-->
            <div class=" col-12 <?php echo $video ?>">
              <div class="small-box bg-danger">
                <div class="inner">
                  <p>Video</p>
                </div>
                <div class="icon">
                  <i class="fab fa-youtube"></i>
                </div>
                <a href="<?php echo $proyecto['url_video'] ?>" class="small-box-footer">Ir <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>

          <?php } else {
            $cartel = "col-sm-12";
          }
          ?>
          <!--Div Objetivo-->
          <div class=" col-12 <?php echo $cartel ?>">
            <div class="info-box bg-light">
              <div class="info-box-content">
                <span class="info-box-text text-center text-muted">Objetivo</span>
                <span class="info-box-number text-center text-muted mb-0"> <?php echo $proyecto['objetivo_estrategico'] ?> </span>
              </div>
            </div>
          </div>

        </div>

        <!--New Row-->
        <div class="row">
          <!--Div Portafolio-->
          <div class="col-12 col-sm-3">
            <div class="info-box bg-light">
              <div class="info-box-content">
                <span class="info-box-text text-center text-muted">Portafolio</span>
                <span class="info-box-number text-center text-muted mb-0"> <?php echo $proyecto['area'] ?> </span>
              </div>
            </div>
          </div>
          <!--Div Programa-->
          <div class="col-12 col-sm-3">
            <div class="info-box bg-light">
              <div class="info-box-content">
                <span class="info-box-text text-center text-muted">Programa</span>
                <span class="info-box-number text-center text-muted mb-0"><?php echo $proyecto['descripcion'] ?></span>
              </div>
            </div>
          </div>
          <!--Div estado neural-->
          <div class="col-12 col-sm-3">
            <div class="info-box bg-light">
              <div class="info-box-content">
                <span class="info-box-text text-center text-muted">Estado Neural</span>
                <span class="info-box-number text-center text-muted mb-0"> <?php echo $proyecto['estado_neural'] ?><span>
                  </span></span></div>
            </div>
          </div>

          <!--Div estado-->
          <div class="col-12 col-sm-3">
            <div class="info-box bg-light">
              <div class="info-box-content">

                <div style="justify-content: space-between;">

                  <!-- Button trigger modal -->

                  <a type="button" data-toggle="modal" data-target="#exampleModal"> <i class="fas fa-comments" style="color: #007bff; font-size: 20px;"></i></a>

                  <!-- Modal -->
                  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">

                        <!-- Formulario del comentario-->
                        <form name="guardar-registro" id="guardar-registro" action="modelo-proyecto-estado.php" method="post">


                          <div class="modal-body">

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

                            <?php
                            try {
                              $sql = " SELECT * FROM proyecto_estado ";
                              $sql .= " WHERE proyecto_id= $id";
                              $resultado = $conn->query($sql);
                              $comentario = $resultado->fetch_assoc();
                              /* echo '<pre>';
                              var_dump($comentario);
                              echo '</pre'; */
                            } catch (Exception $e) {
                              echo "Error: " . $e->getMessage();
                            }
                            ?>

                            <div class="form-group">

                              <?php
                              if ($comentario['comentario'] !== " ") { ?>
                                <hr>
                                <span class=""><?php echo $comentario['comentario'] ?> <span>
                                    <hr>
                                  <?php } ?>

                                  <input type="text" class="form-control" name="comentario" placeholder="Escribe un comentario">


                            </div>
                          </div>
                          <div class="modal-footer">
                            <input type="hidden" name="registro" value="actualizar">
                            <input type="hidden" name="proyecto_id" id="proyecto_id" value="<?php echo $id ?>">
                            <input type="hidden" name="id_registro" value="<?php echo $comentario['id_pe'] ?>">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" name="submitSave" id="myBtn" class="btn btn-primary">Guardar cambios</button>

                          </div>
                        </form>
                      </div>
                    </div>
                  </div>

                </div>
                <span class="info-box-text text-center text-muted">Estado</span>

                <span id="detalle-cerrado" class="info-box-number text-center text-muted mb-0"><?php echo $proyecto['estado'] ?><span>

              </div>
            </div>
          </div>
        </div>

        <!--New Row-->
        <div class="row">
          <!--Div presupuesto total-->
          <div class="col-12 col-sm-6">
            <?php
            $resultado = $conn->query(getTotalInversionProyecto_id($id));
            $registrados = $resultado->fetch_assoc();
            /*  echo '<pre>';
            var_dump($registrados);
            echo '</pre'; */
            ?>
            <div class="info-box bg-light">
              <div class="info-box-content">
                <span class="info-box-text text-center text-muted">Inversión Total</span>
                <span class="info-box-number text-center text-muted mb-0" id="presupuesto_inversion"> <i class="fas fa-dollar-sign"></i>

                  <?php
                  if ($registrados['total'] == null) {

                    echo '0';
                  } else {
                    echo  $registrados['total'];
                  }
                  ?>

                </span>
                <!-- Button trigger modal -->



                <button id="boton01" type="button" class="btn btn-primary " >
                  <i class="fas fa-hand-holding-usd"></i> Invertir
                </button>


              </div>
            </div>
          </div>
          <!--Div presupuesto-->
          <div class="col-12 col-sm-6">
            <div class="info-box bg-light">
              <div class="info-box-content">
                <span class="info-box-text text-center text-muted">Presupuesto</span>
                <span class="info-box-number text-center text-muted mb-0" id="presupuesto_total"> <i class="fas fa-dollar-sign"></i> <?php echo $proyecto['presupuesto_inicial'] ?> </span>
              </div>
            </div>
          </div>



        </div>


      </div>
      <!-- /.card-body -->

    </div>
    <!-- /.card -->

    <!-- Default box -->

    <?php
    if ($registrados['total'] == null) {
    } else { ?>
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Inversión</h3>

        </div>

        <div class="card-body">

          <div class="row">
            <?php
            try {
              $sql = " SELECT  *  FROM cuentas ";
              $sql .= " INNER JOIN registros ON registros.registros_id = cuentas.registros_id ";
              $sql .= " WHERE proyecto_id = $id ";
              $resultado = $conn->query($sql);
              /* echo '<pre>';
            var_dump($resultado);
            echo '</pre'; */
            } catch (Exception $e) {
              $error = $e->getMessage();
              echo $error;
            }
            while ($registrados = $resultado->fetch_assoc()) { ?>
              <div class="col-12 col-sm-2">
                <div class="info-box bg-light">
                  <div class="info-box-content">
                    <span class="info-box-text text-center text-muted" style="text-transform: capitalize;">
                      <?php
                      setlocale(LC_TIME, "spanish");
                      $fechaComoEntero = strtotime($registrados['anio']);
                      $anio = strftime("%B - %Y", $fechaComoEntero);
                      echo $anio;
                      ?>
                    </span>
                    <span class="info-box-number text-center text-muted mb-0"> <i class="fas fa-dollar-sign"></i> <?php echo $registrados['presupuesto'] ?> </span>
                  </div>
                </div>
              </div>
            <?php } ?>

          </div>
        </div>

      </div>
    <?php }  ?>





    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Archivos </h3>

      </div>

      <div class="card-body">

        <div class="row">
          <?php
          if ($proyecto['url_documento'] == "") { ?>

            <div class="col-lg-3 col-6">
              <div class="small-box bg-ligt">
                <div class="inner">
                  <p>No existen documentos</p>
                </div>
                <div class="icon">
                  <i class="fas fa-book-dead" style="color: black;"></i>
                </div>
                <a href="lista-cuenta.php" class="small-box-footer" style="color: black;"> </a>
              </div>
            </div>

            <?php  } else {
            $array = explode(",", $proyecto['url_documento']);

            foreach ($array as $clave => $valor) { ?>

              <div class="col-lg-3 col-6">
                <div class="small-box bg-ligt">
                  <div class="inner">
                    <h6><?php echo $valor; ?></h6>
                    <p><?php echo $clave + 1 ?></p>
                  </div>
                  <div class="icon">
                    <i class="far fa-file-pdf" style="color: red;"></i>
                  </div>
                  <a href="docs/<?php echo $valor; ?>" class="small-box-footer" style="color: black;">Abri archivo <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
          <?php  }
          }

          ?>
        </div>

      </div>

    </div>

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php

include_once('templates/footer.php');

?>