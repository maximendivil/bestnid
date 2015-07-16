<?php
	session_start();
	include("funciones.php");
	include("header.php");
	darAltaAdministrador($_GET["email"]);
	echo "<div class='alert alert-success'><p style='text-align: center'>El usuario ".$_GET["email"]." ha sido dado de alta como administrador</p></div>";
	header("refresh: 2; url =  buscar_user.php");
?>