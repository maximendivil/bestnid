<?php
	session_start();	
		$busquedaErr = "";
				switch ($_POST["criterio"]) {
					case '1':
						$_SESSION["titulo"] = $_POST["busqueda"];
						header("Location: buscar_por_titulo.php");
						break;
					case '2':
						$_SESSION["descripcion"] = $_POST["busqueda"];
						header("Location: buscar_por_descripcion.php");
						break;
					
					default:
						$_POST["busqueda"] = "Debe seleccionar un criterio de busqueda";
						break;
				}
			
		
?>