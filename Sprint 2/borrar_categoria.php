<?php
	session_start();
	include("funciones.php");

	$nombre = $_POST["categoria"];

	if ($nombre == "vacio"){
		$_SESSION["exito"] = "<div class='alert alert-danger'><p style='color: red ; text-align: center'>Debe seleccionar una categoria</p></div>";
		header("refresh: 0.1 ; url=eliminar_categorias.php");
	}
	else {		
		eliminarCategoria($_POST["categoria"]);
		$_SESSION["exito"] = "<div class='alert alert-success'><p style='color: green ; text-align: center'>La categoria fue eliminada exitosamente!</p></div>";
		header("refresh: 0.1 ; url=eliminar_categorias.php");
	}
	

?>