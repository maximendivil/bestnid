<!DOCTYPE>
<html lang="en">
<head> 
	<meta charset="utf-8">
	<title>Bestnid</title>
	<link rel="stylesheet" type="text/css" href="libs/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="styles.css">
	<link rel="stylesheet" type="text/css" href="libs/shop-homepage.css">
	<link rel="icon" type="image/png" href="logo2.png" />
	<script src="js/jquery-2.1.4.min.js" type="text/javascript"></script>	
	<script src="libs/bootstrap.min.js" type="text/javascript"></script>
	<script src="js/fileinput.min.js" type="text/javascript"></script>
	<script src="js/fileinput_locale_es.js" type="text/javascript"></script>

	
</head>

<body>
	
	<nav class="navbar navbar-default" role="navigation" >
		<div class="col-lg-4">
			<a style="padding-top:0em" class="navbar-brand" href="index.php"><img src="logo3.png" style="width: 100% ; height: 175% ; padding-left: 15%"></a>
		</div>
		<div class="col-lg-4" style="padding-top:1em ; padding-bottom:1em">			
		    <div class="input-group">
		      <div class="input-group-btn">
		      	<form class="form-inline" method="POST" action="buscar_articulo.php">
					<select class="btn btn-default" name="criterio">
			        	<option value="titulo">Titulo</option>
			        	<option value="descripcion">Descripcion</option>
			        </select>
				
		      </div>	 
		      		<input type="text" name="busqueda" placeholder="Ingrese aqui su busqueda..." class="form-control">
		      		<span class="input-group-btn">
		      			<button class="btn btn-default" type="submit" style="padding-top: 11px ; padding-bottom: 11px"><span class="glyphicon glyphicon-search"></span></button>
		    		</span>
		    	</form>		    	
		    </div>        	
  		</div>
  		<div class="col-lg-4">	
		<?php		
		if(isset($_SESSION['usuario'])){
			echo	"<ul class='nav navbar-nav navbar-right' style='padding-top:0.5em ; padding-right: 2em'>";
			echo 	"<li><a href='indexPanel.php'>Mi cuenta</a></li>";
			echo 	"<li><a href='publicar.php'>Publicar</a></li>";
			echo 	"<li><a href='logout.php'>Cerrar sesion</a></li>";
			echo	"</ul>";
		}
		else {	
			echo	"<ul class='nav navbar-nav navbar-right' style='padding-top:0.5em ; padding-right: 2em'>";
			echo	"<li><a href='registrarse.php'>Registrarse</a></li>";
			echo	"<li><a href='login.php'>Iniciar sesión</a></li>";
			echo	"</ul>";
		}
		?>
		</div>
	</nav>