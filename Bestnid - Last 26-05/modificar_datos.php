<?php
session_start();

			$email = $_SESSION["usuario"];
                  $nombre = $_SESSION["nombre"];
                    $apellido = $_SESSION["apellido"];
                    $fechaNac = $_SESSION["fechaNac"];
                    $dni = $_SESSION["dni"];
                    $pais = $_SESSION["pais"];
                    $provincia = $_SESSION["provincia"];
                    $localidad = $_SESSION["localidad"];
                    $sexo = $_SESSION["sexo"];
                    $calle = $_SESSION["calle"];
                    $numCalle = $_SESSION["numCalle"];
                    $dpto = $_SESSION["dpto"];
                    $piso = $_SESSION["piso"];
            $link = mysql_connect('localhost','root') or die('No se pudo conectar: '.mysql_error());
            mysql_select_db('bestnid',$link) or die('No se pudo seleccionar la base de datos');
            $alta = date("y/m/d");
            $result = mysql_query("SELECT pais_id FROM pais WHERE code='$pais'");
            $fila = mysql_fetch_row($result);
            $pais_id = $fila[0];
            mysql_free_result($result);
            mysql_query("UPDATE registrado SET nombre='$nombre', apellido='$apellido', paisID='$pais_id', provinciaID = '$provincia', localidad='$localidad' , fechaNacimiento ='$fechaNac',sexo='$sexo', calle='$calle', numCalle='$numCalle', departamento='$dpto', piso='$piso' WHERE email='$email'") or die("Fallo la modificacion de datos.");
            mysql_close($link);
            echo "Todo re careta ahora amigo";
            header("refresh: 1 ; url = datos.php");

?>