<?php
########## imagen_mostrar.php ##########
# debe recibir el id de la imagen a mostrar
# http://www.lawebdelprogramador.com
//
//session_start();
require("database.php");

$link = Database::connect();
 
# Buscamos la imagen a mostrar

$idImagen = $_GET["id"];

$result=mysqli_query($link,"SELECT * FROM imagen WHERE idImagen='$idImagen'")or die("Fallo");
if($result){
	$row=mysqli_fetch_array($result);
	header("Content-type:".$row["tipo"]);
	echo $row["contenido"];
}

 
# Mostramos la imagen

?>