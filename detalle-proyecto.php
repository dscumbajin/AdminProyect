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
          <h1>Proyecto: <?php echo $id ?> </h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <?php
    try {
      $sql = "SELECT proyecto_id, detalle,url_video, objetivo_estrategico, presupuesto_inicial, estado_neural, estado, area, descripcion , presupuesto ,anio ";
      $sql .= " FROM proyectos ";
      $sql .= " INNER JOIN portafolios ";
      $sql .= " ON proyectos.portafolio_id = portafolios.portafolio_id ";
      $sql .= " INNER JOIN programas ";
      $sql .= " ON proyectos.programa_id=programas.programa_id ";
      $sql .= " INNER JOIN registros ";
      $sql .= " ON proyectos.proyecto_id = registros.registros_id ";
      $sql .= " WHERE proyecto_id = $id ";
      $resultado = $conn->query($sql);
      $proyecto = $resultado->fetch_assoc();
    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
    }
    ?>
    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><?php echo $proyecto['detalle'] ?></h3>

      </div>
      <div class="card-body">

        <div class="row">

          <div class="youtube-player" data-id="VIDEO_ID"></div>
         
          <div class="col-12">
            <div class="info-box bg-light">
              <div class="info-box-content">
                <span class="info-box-text text-center text-muted">Objetivo</span>
                <span class="info-box-number text-center text-muted mb-0"> <?php echo $proyecto['objetivo_estrategico'] ?> </span>
              </div>
            </div>
          </div>

   

        </div>

        <div class="row">

          <div class="col-6 ">
            <div class="info-box bg-light">
              <div class="info-box-content">
                <span class="info-box-text text-center text-muted">Presupuesto Estimado</span>
                <span class="info-box-number text-center text-muted mb-0"> <i class="fas fa-dollar-sign"></i> <?php echo $proyecto['presupuesto_inicial'] ?> </span>
              </div>
            </div>
          </div>
          <div class="col-6">
            <?php
            $sql = " SELECT  SUM(presupuesto) AS total FROM cuentas ";
            $sql .= " INNER JOIN registros ON registros.registros_id = cuentas.registros_id ";
            $sql .= " WHERE proyecto_id = $id ";
            $resultado = $conn->query($sql);
            $registrados = $resultado->fetch_assoc();
            ?>
            <div class="info-box bg-light">
              <div class="info-box-content">
                <span class="info-box-text text-center text-muted">Presupuesto Total</span>
                <span class="info-box-number text-center text-muted mb-0"> <i class="fas fa-dollar-sign"></i> 
                
                <?php
                        if ($registrados['total']== null) {
                         
                            echo 'Sin asignar';

                        }else{
                          echo  $registrados['total'];
                        }
                        ?>
                
                </span>
              </div>
            </div>
          </div>

        </div>


        <div class="row">

          <div class="col-12 col-sm-3">
            <div class="info-box bg-light">
              <div class="info-box-content">
                <span class="info-box-text text-center text-muted">Portafolio</span>
                <span class="info-box-number text-center text-muted mb-0"> <?php echo $proyecto['area'] ?> </span>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-3">
            <div class="info-box bg-light">
              <div class="info-box-content">
                <span class="info-box-text text-center text-muted">Programa</span>
                <span class="info-box-number text-center text-muted mb-0"><?php echo $proyecto['descripcion'] ?></span>
              </div>
            </div>
          </div>

          <div class="col-12 col-sm-3">
            <div class="info-box bg-light">
              <div class="info-box-content">
                <span class="info-box-text text-center text-muted">Estado Neural</span>
                <span class="info-box-number text-center text-muted mb-0"> <?php echo $proyecto['estado_neural'] ?><span>
                  </span></span></div>
            </div>
          </div>


          <div class="col-12 col-sm-3">
            <div class="info-box bg-light">
              <div class="info-box-content">
                <span class="info-box-text text-center text-muted">Estado</span>
                <span class="info-box-number text-center text-muted mb-0"><?php echo $proyecto['estado'] ?> <span>
                  </span class = "info-box-number text-center text-muted mb-0">
                  <!-- Button trigger modal -->
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                          Comentario
                      </button>
                     <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">

                                <!-- Formulario del comentario-->
                                    <form name="guardar-registro" id="guardar-registro" action="modelo-comentario.php" method="post">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <input type="comentario" class="form-control" name="comentario" placeholder="Escribe un comentario">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="hidden" name="registro" value="nuevo">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                            <button type="submit" name="submitSave" class="btn btn-primary">Guardar cambios</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                  </span>
                      
                </div>
            </div>
          </div>
        </div>

      </div>
      <!-- /.card-body -->

    </div>
    <!-- /.card -->

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Presupuestos por año</h3>

      </div>

      <div class="card-body">

        <div class="row">
          <?php
          try {
            $sql = " SELECT  *  FROM cuentas ";
            $sql .= " INNER JOIN registros ON registros.registros_id = cuentas.registros_id ";
            $sql .= " WHERE proyecto_id = $id ";
            $resultado = $conn->query($sql);
          } catch (Exception $e) {
            $error = $e->getMessage();
            echo $error;
          }
          while ($registrados = $resultado->fetch_assoc()) { ?>
            <div class="col-12 col-sm-2">
              <div class="info-box bg-light">
                <div class="info-box-content">
                  <span class="info-box-text text-center text-muted">
                    <?php
                    $fechaComoEntero = strtotime($registrados['anio']);
                    $anio = date("Y", $fechaComoEntero);
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





  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
 
 document.addEventListener("DOMContentLoaded",
 function() {
 var div, n,
 v = document.getElementsByClassName("youtube-player");
 for (n = 0; n < v.length; n++) {
 div = document.createElement("div");
 div.setAttribute("data-id", v[n].dataset.id);
 div.innerHTML = labnolThumb(v[n].dataset.id);
 div.onclick = labnolIframe;
 v[n].appendChild(div);
 }
 });
 
 function labnolThumb(id) {
 var thumb = '<img src="https://i.ytimg.com/vi/ID/hqdefault.jpg">',
 play = '<div class="play"></div>';
 return thumb.replace("ID", id) + play;
 }
 

 function labnolIframe() {
 var iframe = document.createElement("iframe");
 var embed = "https://www.youtube.com/embed/cWLLPVNZtAw";
 iframe.setAttribute("src", embed.replace("ID", this.dataset.id));
 iframe.setAttribute("frameborder", "0");
 iframe.setAttribute("allowfullscreen", "1");
 this.parentNode.replaceChild(iframe, this);
 }
 
</script>


<?php

include_once('templates/footer.php');

?>