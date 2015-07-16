<?php
  session_start();
  include("funciones.php");
	
	if( (isset($_GET['id'])) AND ($_SESSION['tipouser'] == 1) ){
		eliminarComentario($_GET['id']);
		header("refresh: 0.1; url =  ".$_SERVER['HTTP_REFERER']."");
	}