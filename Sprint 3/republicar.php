<?php
	session_start();
	include("funciones.php");

	$idPublicacion = $_GET["idPublicacion"];

	//republicar($idPublicacion);
	$publicacion = datosPublicacion($idPublicacion);
	$imagenes = buscarImagenesPublicacion($idPublicacion);

	$id = republicar($publicacion[0]["categoria"],$publicacion[0]["titulo"],$publicacion[0]["descripcion"],$publicacion[0]["usuario"]);

	for ($i=0; $i<count($imagenes);$i++){
		cargarImagen($id,$imagenes[$i][0]);
	}


	$_SESSION["exito"] = "<div class='alert alert-success'><p style='color: green ; text-align: center'>La publicacion se encuentra activa nuevamente!</p></div>";

	//Falta mostrar este mensaje en ventas_finalizadas.php

	header("refresh: 0.1 ; url=ventas_finalizadas.php");
?>