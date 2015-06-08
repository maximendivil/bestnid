<?php
	session_start();
	include("funciones.php");

	$categoria = "";

	$existe = verificarCategoria($_POST["nombreCategoria"]);

	if (!$existe){	
		agregarCategoria($_POST["nombreCategoria"]);
		$_SESSION["exito"] = "<div class='alert alert-success'><p style='color: green ; text-align: center'>La categoria fue creada exitosamente!</p></div>";
		header("refresh: 0.1 ; url=agregar_categorias.php");
	}
	else {
		$_SESSION["exito"] = "<div class='alert alert-danger'><p style='color: red ; text-align: center'>La categoria ya existe!</p></div>";
		header("refresh: 0.1 ; url=agregar_categorias.php");
	}	

?>