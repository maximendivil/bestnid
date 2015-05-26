<body>

<div class="container">
  <div class="row">
	<div class="col-md-3">
      <ul class="nav nav-pills nav-stacked">
        <li class="active"><a href="#">Mi cuenta</a></li>
		<li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="#">Ventas<span class="caret"></span></a>
			<ul class="dropdown-menu">
            <li><a href="#">Activas</a></li>
            <li><a href="#">Finalizadas</a></li>
            <li><a href="#">Preguntas</a></li>                        
			</ul>
       </li>
	   <li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="#">Compras<span class="caret"></span></a>
			<ul class="dropdown-menu">
            <li><a href="#">Activas</a></li>
            <li><a href="#">Finalizadas</a></li>
            <li><a href="#">Preguntas realizadas</a></li>                        
			</ul>
        </li>
		<li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="#">Configuracion<span class="caret"></span></a>
			<ul class="dropdown-menu">
            <li><a href="datos.php">Datos personales</a></li>
			<li><a href="#">Cambiar contraseña</a></li>
            <li><a href="#">Tarjetas</a></li>
            <li><a href="#">Eliminar cuenta</a></li>                        
			</ul>
        </li>
      </ul>	
	
	  <?php
	  // MENU ADMINISTRADOR
	  if($_SESSION['tipouser'] == 1){
		echo "<ul class='nav nav-pills nav-stacked'>";
        echo "<li class='active'><a href='#'>Administrador</a></li>";
		echo "<li class='dropdown'>";
			echo "<a class='dropdown-toggle' data-toggle='dropdown' href='#'>Publicaciones<span class='caret'></span></a>";
			echo "<ul class='dropdown-menu'>";
			echo "<li><a href='#'>Agregar categoria</a></li>";
            echo "<li><a href='#'>Eliminar categoria</a></li>";
            echo "<li><a href='#'>Reporte de ventas</a></li>";                        
			echo "</ul>";
		echo "</li>";
		echo "<li class='dropdown'>";
			echo "<a class='dropdown-toggle' data-toggle='dropdown' href='#'>Usuarios<span class='caret'></span></a>";
			echo "<ul class='dropdown-menu'>";
            echo "<li><a href='#'>Buscar usuario</a></li>";
            echo "<li><a href='#'>Reporte de registros</a></li>";                     
			echo "</ul>";
		echo "</li>";
		echo "<li><a href='#'>Tutorial</a></li>";
		echo "</ul>";
	  }
	  ?>
	</div>
	
</html>