<?php
session_start();
	$email = $_GET['email'];
	if( (($_SESSION['tipouser'] == 0) && ($email == $_SESSION['usuario'])) || ($_SESSION['tipouser'] == 1) ){
            $link = mysql_connect('localhost','root') or die('No se pudo conectar: '.mysql_error());
            mysql_select_db('bestnid',$link) or die('No se pudo seleccionar la base de datos');
            mysql_query("UPDATE usuario SET tipo=-1 WHERE email='$email'") or die("Fallo la eliminacion de datos.");
            mysql_close($link);
            echo '<script language="javascript">alert("Tu cuenta fue dada de baja exitosamente");</script>';
         
		 if($_SESSION['usuario'] == $email){
			  header("refresh: 1 ; url = logout.php");
		 }else if($_SESSION['tipouser'] == 1){
			header("refresh: 2 ; url = indexPanel.php"); 
		 }
	}else{
		header("Location: index.php");
	}
	

?>