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

  <!-- Main content -->
  <section class="content">

    <div class="row">
      <div class="col-lg-3 col-6">
        <?php
        $sql = "SELECT COUNT(proyecto_id) AS proyecto FROM proyectos WHERE estado_id = 1 ";
        $resultado = $conn->query($sql);
        $registrados = $resultado->fetch_assoc();
        ?>
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3><?php echo $registrados['proyecto'] ?></h3>

            <p>Análisis</p>
          </div>
          <div class="icon">
            <i class="fas fa-chart-line"></i>
          </div>
          <a href="lista-proyecto-estado.php?id=1" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>


      <div class="col-lg-3 col-6">
        <?php
        $sql = "SELECT COUNT(proyecto_id) AS proyecto FROM proyectos WHERE estado_id = 2 ";
        $resultado = $conn->query($sql);
        $registrados = $resultado->fetch_assoc();
        ?>
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3><?php echo $registrados['proyecto'] ?></h3>

            <p>Aprobado</p>
          </div>
          <div class="icon">
            <i class="far fa-check-circle"></i>
          </div>
          <a  href="lista-proyecto-estado.php?id=2" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>


      <div class="col-lg-3 col-6">
        <?php
        $sql = "SELECT COUNT(proyecto_id) AS proyecto FROM proyectos WHERE estado_id = 3 ";
        $resultado = $conn->query($sql);
        $registrados = $resultado->fetch_assoc();
        ?>
        <!-- small box -->
        <div class="small-box bg-secondary">
          <div class="inner">
            <h3><?php echo $registrados['proyecto'] ?></h3>

            <p>Proceso</p>
          </div>
          <div class="icon">
            <i class="fas fa-tasks"></i>
          </div>
          <a  href="lista-proyecto-estado.php?id=3" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>


      <div class="col-lg-3 col-6">
        <?php
        $sql = "SELECT COUNT(proyecto_id) AS proyecto FROM proyectos WHERE estado_id = 4 ";
        $resultado = $conn->query($sql);
        $registrados = $resultado->fetch_assoc();
        ?>
        <!-- small box -->
        <div class="small-box bg-primary">
          <div class="inner">
            <h3><?php echo $registrados['proyecto'] ?></h3>

            <p>Entregado</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a  href="lista-proyecto-estado.php?id=4" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-6">
        <?php
        $sql = "SELECT COUNT(proyecto_id) AS proyecto FROM proyectos WHERE estado_id = 5 ";
        $resultado = $conn->query($sql);
        $registrados = $resultado->fetch_assoc();
        ?>
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h3><?php echo $registrados['proyecto'] ?></h3>

            <p>Cerrado</p>
          </div>
          <div class="icon">

            <i class="far fa-times-circle"></i>
          </div>
          <a  href="lista-proyecto-estado.php?id=5" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>


    </div>

  </section>
  <!-- /.content -->

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Resumen</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">


      <div class="col-lg-3 col-6">
        <?php
        $sql = "SELECT c.proyecto_id,COUNT(*) FROM Cuentas c left OUTER JOIN proyectos p ON c.proyecto_id =  p.proyecto_id AND c.proyecto_id = p.proyecto_id GROUP BY c.proyecto_id";

        $resultado = $conn->query($sql);

        ?>

        <?php

        while ($registrados = $resultado->fetch_assoc()) {
          $i++;
        }
        ?>

        <div class="small-box bg-info">
          <div class="inner">
            <h3><?php echo $i ?></h3>

            <p>Cuentas</p>
          </div>
          <div class="icon">
            <i class="fas fa-file-invoice-dollar"></i>
          </div>
          <a href="lista-cuenta.php" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>


      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <?php
        $sql = "SELECT COUNT(proyecto_id) AS proyecto FROM proyectos ";
        $resultado = $conn->query($sql);
        $registrados = $resultado->fetch_assoc();
        ?>
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3><?php echo $registrados['proyecto'] ?><sup style="font-size: 20px"></sup></h3>

            <p>Proyectos</p>
          </div>
          <div class="icon">
            <i class="fas fa-project-diagram"></i>
          </div>
          <a href="lista-proyecto.php" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->


      <div class="col-lg-3 col-6">

        <?php
        $sql = "SELECT COUNT(programa_id) AS programa FROM programas ";
        $resultado = $conn->query($sql);
        $registrados = $resultado->fetch_assoc();
        ?>
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3><?php echo $registrados['programa'] ?></h3>

            <p>Programas</p>
          </div>
          <div class="icon">
            <i class="fas fa-sitemap"></i>
          </div>
          <a href="lista-programa.php" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->


      <div class="col-lg-3 col-6">

        <?php
        $sql = "SELECT COUNT(portafolio_id) AS portafolio FROM portafolios ";
        $resultado = $conn->query($sql);
        $registrados = $resultado->fetch_assoc();
        ?>
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h3><?php echo $registrados['portafolio'] ?></h3>

            <p>Areas</p>
          </div>
          <div class="icon">
            <i class="far fa-building"></i>
          </div>
          <a href="lista-portafolio.php" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
    </div>
  </section>
  <!-- /.content-wrapper -->
</div>


<?php

include_once('templates/footer.php');
?>