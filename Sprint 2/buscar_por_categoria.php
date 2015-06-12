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
				$categoria = $_GET["nombre"];
				$idCategoria = consultarCategoria($categoria);
				$resultado = buscarPorCategoria($idCategoria);

				if (count($resultado)>0){
					for ($i=0; $i < count($resultado); $i++) { 			
						$idPublicacion = $resultado[$i]["numeroPublicacion"];
						echo "<div class='col-sm-8 col-lg-4 col-md-4'>";
			            echo "<div class='thumbnail'>";
			            $idImagen = buscarImagenPublicacion($idPublicacion);
			            echo "<a href='publicacion.php?id=$idPublicacion'><img src='imagen_mostrar.php?id=".$idImagen."' width='320' height='150'></a>";
			            echo "<div class='caption'>";
			            echo "<h4><a href='publicacion.php?id=$idPublicacion'>".$resultado[$i]["titulo"]."</a></h4>";
			            echo "<p>".$resultado[$i]["descripcion"]."</p>";
			            echo "</div>";
			            echo "<div class='ratings'>";
				        echo "<p><a href='publicacion.php?id=$idPublicacion' type='button' class='btn btn-primary center-block' style='margin-left: 100px; margin-right: 100px; margin-top: -25px'>Ver publicacion</a></p>";
				        echo "</div>";
			            echo "</div>";
			            echo "</div>";
					}
				}
				else {
					echo "<div class='alert alert-danger'><p style='text-align: center'>No se han encontrado publicaciones dentro de la categoria. Por favor intente realizando otra busqueda</p></div>";
				}

			?>