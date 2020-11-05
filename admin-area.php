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
    $estado_id = 1;
    $sql = "SELECT COUNT(proyecto_id) AS proyecto FROM proyectos WHERE estado_id = $estado_id ";
    $resultado = $conn->query($sql);
    $registrados = $resultado->fetch_assoc();
    ?>
    <!-- small box -->
    <div class="small-box bg-info">
      <div class="inner">
       <h3><?php echo $registrados['proyecto'] ?></h3>
       <?php 
        $sql = " SELECT  SUM(presupuesto) AS total  FROM cuentas  ";
        $sql .= " INNER JOIN registros ON registros.registros_id = cuentas.registros_id ";
        $sql .= " INNER JOIN proyectos ON proyectos.proyecto_id = cuentas.proyecto_id ";
        $sql .= " WHERE proyectos.estado_id = $estado_id ";
        $resultado = $conn->query($sql);
        $registrados = $resultado->fetch_assoc();
        
        if ($registrados['total'] == null) {?>
        <p>Análisis   -   Iversión total: <spam style="font-weight: bold; font-size: 20px;"> $ 0 </spam> </p> 
          
       <?php } else { ?>
        <p>Análisis   -   Iversión total: <spam style="font-weight: bold; font-size: 20px;"> $ <?php echo $registrados['total']?> </spam> </p> 
       <?php } ?>
        
      </div>
      <div class="icon">
        <i class="fas fa-chart-line"></i>
      </div>
      <a href="lista-proyecto-estado.php?id=1" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>


  <div class="col-lg-3 col-6">
    <?php
    $estado_id = 2;
    $sql = "SELECT COUNT(proyecto_id) AS proyecto FROM proyectos WHERE estado_id = $estado_id ";
    $resultado = $conn->query($sql);
    $registrados = $resultado->fetch_assoc();
    ?>
    <!-- small box -->
    <div class="small-box bg-success">
      <div class="inner">
        <h3><?php echo $registrados['proyecto'] ?></h3>

        <?php 
        $sql = " SELECT  SUM(presupuesto) AS total  FROM cuentas  ";
        $sql .= " INNER JOIN registros ON registros.registros_id = cuentas.registros_id ";
        $sql .= " INNER JOIN proyectos ON proyectos.proyecto_id = cuentas.proyecto_id ";
        $sql .= " WHERE proyectos.estado_id = $estado_id ";
        $resultado = $conn->query($sql);
        $registrados = $resultado->fetch_assoc();
        
        if ($registrados['total'] == null) {?>
        <p>Aprobado   -   Iversión total: <spam style="font-weight: bold; font-size: 20px;"> $ 0 </spam> </p> 
          
       <?php } else { ?>
        <p>Aprobado   -   Iversión total: <spam style="font-weight: bold; font-size: 20px;"> $ <?php echo $registrados['total']?> </spam> </p> 
       <?php } ?>
      </div>
      <div class="icon">
        <i class="far fa-check-circle"></i>
      </div>
      <a  href="lista-proyecto-estado.php?id=2" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>


  <div class="col-lg-3 col-6">
    <?php
    $estado_id = 3;
    $sql = "SELECT COUNT(proyecto_id) AS proyecto FROM proyectos WHERE estado_id = $estado_id ";
    $resultado = $conn->query($sql);
    $registrados = $resultado->fetch_assoc();
    ?>
    <!-- small box -->
    <div class="small-box bg-secondary">
      <div class="inner">
        <h3><?php echo $registrados['proyecto'] ?></h3>

        <?php 
        $sql = " SELECT  SUM(presupuesto) AS total  FROM cuentas  ";
        $sql .= " INNER JOIN registros ON registros.registros_id = cuentas.registros_id ";
        $sql .= " INNER JOIN proyectos ON proyectos.proyecto_id = cuentas.proyecto_id ";
        $sql .= " WHERE proyectos.estado_id = $estado_id ";
        $resultado = $conn->query($sql);
        $registrados = $resultado->fetch_assoc();
        
        if ($registrados['total'] == null) {?>
        <p>Proceso   -   Iversión total: <spam style="font-weight: bold; font-size: 20px;"> $ 0 </spam> </p> 
          
       <?php } else { ?>
        <p>Proceso   -   Iversión total: <spam style="font-weight: bold; font-size: 20px;"> $ <?php echo $registrados['total']?> </spam> </p> 
       <?php } ?>
      </div>
      <div class="icon">
        <i class="fas fa-tasks"></i>
      </div>
      <a  href="lista-proyecto-estado.php?id=3" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>


  <div class="col-lg-3 col-6">
    <?php
    $estado_id = 4;
    $sql = "SELECT COUNT(proyecto_id) AS proyecto FROM proyectos WHERE estado_id = $estado_id ";
    $resultado = $conn->query($sql);
    $registrados = $resultado->fetch_assoc();
    ?>
    <!-- small box -->
    <div class="small-box bg-primary">
      <div class="inner">
        <h3><?php echo $registrados['proyecto'] ?></h3>

        <?php 
        $sql = " SELECT  SUM(presupuesto) AS total  FROM cuentas  ";
        $sql .= " INNER JOIN registros ON registros.registros_id = cuentas.registros_id ";
        $sql .= " INNER JOIN proyectos ON proyectos.proyecto_id = cuentas.proyecto_id ";
        $sql .= " WHERE proyectos.estado_id = $estado_id ";
        $resultado = $conn->query($sql);
        $registrados = $resultado->fetch_assoc();
        
        if ($registrados['total'] == null) {?>
        <p>Entregado   -   Iversión total:<spam style="font-weight: bold; font-size: 20px;"> $ 0 </spam> </p> 
          
       <?php } else { ?>
        <p>Entregado  -   Iversión total: <spam style="font-weight: bold; font-size: 20px;"> $ <?php echo $registrados['total']?> </spam> </p> 
       <?php } ?>
      </div>
      <div class="icon">
        <i class="ion ion-bag"></i>
      </div>
      <a  href="lista-proyecto-estado.php?id=4" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>

  <div class="col-lg-3 col-6">
    <?php
    $estado_id=5;
    $sql = "SELECT COUNT(proyecto_id) AS proyecto FROM proyectos WHERE estado_id = $estado_id ";
    $resultado = $conn->query($sql);
    $registrados = $resultado->fetch_assoc();
    ?>
    <!-- small box -->
    <div class="small-box bg-danger">
      <div class="inner">
        <h3><?php echo $registrados['proyecto'] ?></h3>

        <?php 
        $sql = " SELECT  SUM(presupuesto) AS total  FROM cuentas  ";
        $sql .= " INNER JOIN registros ON registros.registros_id = cuentas.registros_id ";
        $sql .= " INNER JOIN proyectos ON proyectos.proyecto_id = cuentas.proyecto_id ";
        $sql .= " WHERE proyectos.estado_id = $estado_id ";
        $resultado = $conn->query($sql);
        $registrados = $resultado->fetch_assoc();
        
        if ($registrados['total'] == null) {?>
        <p>Cerrado   -   Iversión total: <spam style="font-weight: bold; font-size: 20px;"> $ 0 </spam> </p> 
          
       <?php } else { ?>
        <p style= "">Cerrado  -   Iversión total: <spam style="font-weight: bold; font-size: 20px;"> $ <?php echo $registrados['total']?> </spam> </p> 
       <?php } ?>
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