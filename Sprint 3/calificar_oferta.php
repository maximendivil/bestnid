<?php
  session_start();
  include("funciones.php");
	
	if( (isset($_GET['id'])) AND (isset($_GET['calif'])) ){
		if($_GET['calif'] == 1){
			posibleGanadora($_GET['id']);
		}else if($_GET['calif'] == -1){
			rechazarOferta($_GET['id']);
		}else{
			recalificarOferta($_GET['id']);
		}
		header("refresh: 0.1; url =  ".$_SERVER['HTTP_REFERER']."");
	}