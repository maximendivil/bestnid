<!DOCTYPE>
<html lang="en">
<head> 
<meta charset="utf-8">
<title>Bestnid</title>
<link rel="stylesheet" type="text/css" href="libs/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="styles.css">
<script src="libs/bootstrap.min.js" type="text/javascript"></script>
</head>

<body>

	<nav class="navbar navbar-default" role="navigation" style="background-color: #ec971f ; border: solid 2px black">
		<a style="padding-top:0em" class="navbar-brand" href="index.php"><img src="logo2.png" style="width: 100% ; height: 175% ; padding-left: 15%"></a>
		<div class="col-lg-6" style="padding-top:1em ; padding-bottom:1em">
		    <div class="input-group" style="padding-left:50%">
		      <div class="input-group-btn">
		        <button type="button" class="btn btn-default dropdown-toggle"
		                data-toggle="dropdown">Buscar por  <span class="caret"></span>
		        </button>	 
		        <ul class="dropdown-menu" role="menu">
		          <li><a href="#">Acción #1</a></li>
		          <li><a href="#">Acción #2</a></li>
		          <li><a href="#">Acción #3</a></li>		          
		          <li><a href="#">Acción #4</a></li>
		        </ul>
		      </div>	 
		      <input type="text" class="form-control">
		      	<span class="input-group-btn">
		      		<button class="btn btn-default" type="button">Buscar</button>
		    	</span>
		    </div>        	
  		</div>	
		<?php		
		if(isset($_SESSION['usuario'])){
			echo	"<ul class='nav navbar-nav navbar-right' style='padding-top:0.5em ; padding-right: 2em'>";
			echo 	"<li><a href='cpanel.php'><span style='color: black ; font-weight: bold'>Mi cuenta</a></li>";
			echo 	"<li><a href='logout.php'><span style='color: black ; font-weight: bold'>Cerrar sesion</a></li>";
			echo	"</ul>";
		}
		elseif (isset($_SESSION['administrador'])){
			echo	"<ul class='nav navbar-nav navbar-right' style='padding-top:0.5em ; padding-right: 2em'>";
			echo 	"<li><a href='cpanel.php'><span style='color: black ; font-weight: bold'>Mi cuenta</a></li>";
			echo 	"<li><a href='logout.php'><span style='color: black ; font-weight: bold'>Cerrar sesion</a></li>";
			echo	"</ul>";
		}
		else {	
			echo	"<ul class='nav navbar-nav navbar-right' style='padding-top:0.5em ; padding-right: 2em'>";
			echo	"<li><a href='registrarse.php'><span style='color: black ; font-weight: bold'> Registrarse</a></li>";
			echo	"<li><a href='login.php'><span style='color: black ; font-weight: bold'>Iniciar sesión</a></li>";
			echo	"</ul>";
		}
		?>
	</nav>