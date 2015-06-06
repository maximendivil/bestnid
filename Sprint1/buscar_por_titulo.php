<?php
	include("header.php");
	include("funciones.php");
?>
<div class="col-md-2">
</div>

<div class="container col-md-8">

        <div class="row">

        	<div class="row">

<?php

	$resultado = buscarPorTitulo("ueba");
	if (count($resultado)>0){
		for ($i=0; $i < count($resultado); $i+=7) { 			
		
			echo "<div class='col-sm-4 col-lg-4 col-md-4'>";
            echo "<div class='thumbnail'>";
            //echo "<img src='' alt=''>";
            echo "<div class='caption'>";
            echo "<h4><a href='#'>".$resultado["titulo"]."</a></h4>";
            echo "<p>".$resultado["descripcion"]."</p>";
            echo "</div>";
            echo "<div class='ratings'>";
	        echo "<p><a href='#' type='button' class='btn btn-primary center-block' style='margin-left: 100px; margin-right: 100px; margin-top: -25px'>Ver publicacion</a></p>";
	        echo "</div>";
            echo "</div>";
            echo "</div>";
		}
	}
	else {
		echo "No se han encontrado publicaciones que contengan ese título. Por favor intente realizando otra busqueda";
	}
?>

			</div>
		</div>
</div>

<div class="col-md-2">
</div>