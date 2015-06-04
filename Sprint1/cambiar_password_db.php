<?php
session_start();
include("funciones.php");
$email = $_SESSION["usuario"];
$pass = $_SESSION['password'];

cambiarPassword($email,$pass);

echo "<script language='javascript'> alert('La contraseña fue cambiada exitosamente!'); </script>";
header("refresh: 0.1 ; url = indexPanel.php");

?>