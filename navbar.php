	<?php
		if (isset($title))
		{
	?>
	<div class="header">
	    <?php include("head.php");?>
	</div>

	<nav class="navbar navbar-default menu" style="padding:10px;background:rgba(209,211,212, .8)!important;">
	    <div class="container-fluid">
	        <!-- Brand and toggle get grouped for better mobile display -->
	        <div class="navbar-header">
	            <a href="pedidos.php">
	                <!-- LOGO -->
	                <div id="logo">
	                    <img src="img/logo-baterias.png" class="app-logo" alt="Logotipo" />
	                </div>

	                </header>
	            </a>
	            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
	                data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
	                <span class="sr-only">Toggle navigation</span>
	                <span class="icon-bar"></span>
	                <span class="icon-bar"></span>
	                <span class="icon-bar"></span>
	            </button>

	        </div>
	        <!-- Collect the nav links, forms, and other content for toggling -->
	        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	            <ul class="nav navbar-nav">
	            </ul>
	            <ul class="nav navbar-nav navbar-right">
	                <li><a href="pedidos.php"><span class="activarnav historico activarbarra"
	                            id="historico">Histórico</span> <span class="sr-only"
	                            style="display:none">(current)</span></a></li>
	                <li class="desaparecer"><a class="linea"><span>|</span></a></li>
	                <li><a href="#"><?php echo $_SESSION['user_email']; ?> <i style="margin-left:5px;"
	                            class="glyphicon glyphicon-user"></i></a></li>
	                <li><a href="login.php?logout"><i class='glyphicon glyphicon-log-out'></i> Salir</a></li>
	            </ul>
	        </div><!-- /.navbar-collapse -->
	    </div><!-- /.container-fluid -->
	</nav>
	<div class="wrapper"></div>
	<?php
		}
	?>