<?php
session_start();
include("funciones.php");
	$email = $_GET['email'];
	if( (($_SESSION['tipouser'] == 0) && ($email == $_SESSION['usuario'])) || ($_SESSION['tipouser'] == 1) ){
            eliminarUsuario($email);
            echo '<script language="javascript">alert("La cuenta fue dada de baja exitosamente");</script>';
         
		 if($_SESSION['usuario'] == $email){
			  header("refresh: 1 ; url = logout.php");
		 }else if($_SESSION['tipouser'] == 1){
			header("refresh: 1 ; url = indexPanel.php"); 
		 }
	}else{
		header("Location: index.php");
	}
	

?>