<?php
session_start();
include("funciones.php");
$email = $_SESSION["usuario"];
$pass = $_SESSION['password'];

cambiarPassword($email,$pass);
$_SESSION["exito"] = "<div class='alert alert-success'><p style='color: green ; text-align: center'>La contraseña ha sido modificada exitosamente!</p></div>";
//echo "<script language='javascript'> alert('La contraseña fue cambiada exitosamente!'); </script>";
header("refresh: 0.1 ; url = cambiar_password.php");

?>