<?php
session_start();
			$email = $_SESSION["usuario"];
			$pass = $_SESSION['password'];
            $link = mysql_connect('localhost','root') or die('No se pudo conectar: '.mysql_error());
            mysql_select_db('bestnid',$link) or die('No se pudo seleccionar la base de datos');
            mysql_query("UPDATE usuario SET password=$pass WHERE email='$email'") or die("Fallo la eliminacion de datos.");
            mysql_close($link);
            echo "Contraseña cambiada exitosamente.";
            header("refresh: 1 ; url = indexPanel.php");

?>