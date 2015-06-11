<?php
	session_start();
	include("header.php");
	include("funciones.php");
	include("ver_categorias.php");
?>

<div class="container col-md-8">

        <div class="row">

        	<div class="row">

<?php

	$criterio = $_POST["criterio"];
	$data = $_POST["busqueda"];
	$resultado = buscarPor($criterio,$data);
	if (count($resultado)>0){
		for ($i=0; $i < count($resultado); $i++) { 			
		
			echo "<div class='col-sm-8 col-lg-4 col-md-4'>";
            echo "<div class='thumbnail'>";
            $idImagen = buscarImagenPublicacion($resultado[$i]["numeroPublicacion"]);
			echo "<img src='imagen_mostrar.php?id=".$idImagen."' width='320' height='150'>";
            echo "<div class='caption'>";
            echo "<h4><a href='#'>".$resultado[$i]["titulo"]."</a></h4>";
            echo "<p>".$resultado[$i]["descripcion"]."</p>";
            echo "</div>";
            echo "<div class='ratings'>";
	        echo "<p><a href='#' type='button' class='btn btn-primary center-block' style='margin-left: 100px; margin-right: 100px; margin-top: -25px'>Ver publicacion</a></p>";
	        echo "</div>";
            echo "</div>";
            echo "</div>";
		}
	}
	else {
		echo "<div class='alert alert-danger'><p style='text-align: center'>No se han encontrado publicaciones que contengan esa descripcion. Por favor intente realizando otra busqueda</p></div>";
	}
?>

			</div>
		</div>
</div>

<div class="col-md-2">
</div>