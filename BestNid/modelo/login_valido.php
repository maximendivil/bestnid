<?php
session_start();
$error='';
if (isset($_POST['submit'])) {
	
$usuario=$_POST['usuario'];
$clave=$_POST['clave'];

$connection = mysql_connect("localhost", "root", "");
$db = mysql_select_db("bestnid", $connection);
$query = mysql_query("select * from usuario where password='$clave' AND email='$usuario'", $connection);
$rows = mysql_num_rows($query);

if ($rows == 1) {
$_SESSION['usuario']=$usuario;
header("location: ../index.php");
} else {
$error =  "Usuario o contraseña invalida.";
}
mysql_close($connection);

}
?>