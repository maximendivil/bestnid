<?php
session_start();
include("funciones.php");

		$email = $_SESSION["usuario"];
            $nombre = $_SESSION["nombre"];
            $apellido = $_SESSION["apellido"];
            $pais = $_SESSION["pais"];
            $provincia = $_SESSION["provincia"];
            $localidad = $_SESSION["localidad"];
            $sexo = $_SESSION["sexo"];
            $calle = $_SESSION["calle"];
            $numCalle = $_SESSION["numCalle"];
            $dpto = $_SESSION["dpto"];
            $piso = $_SESSION["piso"];
            $dni = $_SESSION["dni"];
            $fechaNac = $_SESSION["fechaNac"];

            actualizarDatosUsuario($email,$nombre,$apellido,$pais,$provincia,$localidad,$sexo,$calle,$numCalle,$dpto,$piso,$dni,$fechaNac);
            $_SESSION["exito"] = "<div class='alert alert-success'><p style='color: green ; text-align: center'>Los datos han sido modificados exitosamente!</p></div>";
            //echo "<script language='javascript'> alert('Los datos personale han sido modificados exitosamente!'); </script>";
            header("refresh: 0.1 ; url = datos.php");

?>