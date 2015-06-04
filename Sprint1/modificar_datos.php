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

            actualizarDatosUsuario($email,$nombre,$apellido,$pais,$provincia,$localidad,$sexo,$calle,$numCalle,$dpto,$piso);

            echo "<script language='javascript'> alert('Los datos personale han sido modificados exitosamente!'); </script>";
            header("refresh: 0.1 ; url = datos.php");

?>