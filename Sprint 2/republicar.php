<?php
	session_start();
	include("funciones.php");

	$idPublicacion = $_GET["idPublicacion"];

	republicar($idPublicacion);

	$_SESSION["exito"] = "<div class='alert alert-success'><p style='color: green ; text-align: center'>La publicacion se encuentra activa nuevamente!</p></div>";

	//Falta mostrar este mensaje en ventas_finalizadas.php

	header("refresh: 0.1 ; url=ventas_finalizadas.php");	
?>