<?php

	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }
	
	$active_usuarios="";	
	$title="Presupuestos | Home";


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("head.php");?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>

<body>

    <?php include("navbar.php");?>


    <div class="container col-2">
        <div class="panel panel-info">



        </div>

    </div>

    <?php include("footer.php");?>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>



</body>

</html>