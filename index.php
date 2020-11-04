<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Baterias Ecuador | Proyectos</title>
  <link rel="shortcut icon" type="image/x-icon" href="img/icon-baterias.ico" />

  <!--HOJA DE ESTILOS-->
  <link rel="stylesheet" type="text/css" href="css/styles.css" />

</head>

<body>

  <?php
  session_start();
  $cerrar_sesion = $_GET['cerrar_sesion'];
  if ($cerrar_sesion) {
    session_destroy();
  }
  include_once('funciones/funciones.php');
  include_once('templates/header.php');
  ?>
  <header id="header">
    <div class="center">
      <!-- LOGO -->
      <div id="logo">
        <img src="img/logo-baterias.png" class="app-logo" alt="Logotipo" />

      </div>

      <!-- MENU -->
      <nav id="menu">
        <ul>
          <li>
            
          <i class="fas fa-sign-in-alt" style="font-size: 20px; color: red;"></i> <a href="login.php">Iniciar sesión</a>
          </li>
        </ul>
      </nav>

      <!--LIMPIAR FLOTADOS-->
      <div class="clearfix"></div>
    </div>
  </header>


  <div class="center">
    <section id="content">
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


    </section>



    <div class="clearfix"></div>
  </div>

  <footer id="footer">
    <div class="center" style="text-align: center;">
      <p >
        &copy; Baterias<span>Ecuador</span> <strong> 1998-2020</strong> Todos los derechos reservados
      </p>
    </div>
  </footer>
</body>

</html>