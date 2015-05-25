<?php
session_start();
$error='';

function verificarUsuario($email,$clave){
		$connection = mysql_connect("localhost", "root", "");
		$db = mysql_select_db("bestnid", $connection);
		$query = mysql_query("select * from usuario where password='$clave' AND email='$email'", $connection);
		$rows = mysql_num_rows($query);
		mysql_close($connection);
		return $rows;
}

function verificarAdministrador($email,$clave){
		$connection = mysql_connect("localhost", "root", "");
		$db = mysql_select_db("bestnid", $connection);
		$query = mysql_query("select * from administrador where password='$clave' AND email='$email'", $connection);
		$rows = mysql_num_rows($query);
		mysql_close($connection);
		return $rows;
}

if (isset($_POST['submit'])) {
	
	$usuario = $_POST['usuario'];
	$clave = $_POST['clave'];

	$rows = verificarUsuario($usuario,$clave);

	if ($rows == 1) {
		$_SESSION['usuario'] = $usuario;
		header("location: ../index.php");
	} 
	else {
		$rows = verificarAdministrador($usuario,$clave);
		if ($rows == 1){
			$_SESSION['administrador'] = $usuario;
			header("location: ../index.php");
		}
		else {
			$error =  "Usuario o contraseña invalida.";	
		}
		
	}	

}
?>