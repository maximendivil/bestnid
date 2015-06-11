<?php
require 'database.php';


function test_input($data) {
    
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    
    return $data;
}


function buscarPassword($usuario){
	$link = Database::connect();
	$query = mysqli_query($link, "select * from usuario where email='$usuario'");
	$rows = mysqli_num_rows($query);

	while ($rows = mysqli_fetch_assoc($query)) {
		$clave = $rows['password'];
	}
	Database::disconnect();

	return $clave;
}

function cambiarPassword($user, $clave){
	$link = Database::connect();

    mysqli_query($link,"UPDATE usuario SET password=$clave WHERE email='$user'") or die("Fallo la eliminacion de datos.");

    Database::disconnect();

}

function obtenerTarjeta($user){
	
	$link = Database::connect();

	$query = mysqli_query($link, "select * from tarjeta t INNER JOIN registrado r ON (t.numero = r.tarjeta) where email='$user'") or die("Fallo al obtener la informacion de la tarjeta");

	$rows = mysqli_fetch_assoc($query);

	Database::disconnect();

	return($rows);

}

function actualizarTarjeta($numTarjeta,$codSeg,$empresa,$banco,$vencimiento,$nombreTitular,$apellidoTitular,$user,$num){
    
    $link = Database::connect();

    $vencimiento = "01/".$vencimiento;
    $date = date("Y/m/d", strtotime($vencimiento));
    mysqli_query($link,"DELETE FROM tarjeta WHERE numero = '$num'");

    mysqli_query($link,"INSERT INTO tarjeta(numero,codSeguridad,empresa,banco,nombre,apellido,fechaVencimiento) VALUES ('$numTarjeta','$codSeg','$empresa','$banco','$nombreTitular','$apellidoTitular','$date')") or die("Falló al intentar registrar la tarjeta");

    mysqli_query($link,"UPDATE registrado SET tarjeta='$numTarjeta' WHERE email='$user'");
    
    Database::disconnect();
 }

 function verificarTarjeta($numTarjeta){

 	$link = Database::connect();

    $result = mysqli_query($link, "SELECT * FROM tarjeta WHERE numero='$numTarjeta'") or die('Falló la consulta');
    $total = mysqli_num_rows($result);
    
	Database::disconnect();

    return $total;
 }



function verificarEmail($email){
    
    $link = Database::connect();
    
    $result = mysqli_query($link,"SELECT * FROM usuario WHERE email='$email'") or die('Falló la consulta');
    $total = mysqli_num_rows($result);
    
    Database::disconnect();
    
    return $total;
}


 function datosUsuario($email){

 	$link = Database::connect();
	
	$query = mysqli_query($link,"select * from registrado where email='$email'");
	$rows = mysqli_fetch_assoc($query);

	Database::disconnect();

	return $rows;

}

function buscarUsuarioPorDni($busqueda){

	$link = Database::connect();

	$resultado = mysqli_query($link,"SELECT * from registrado r INNER JOIN usuario u ON (r.email = u.email) where dni=$busqueda AND u.tipo != -1") or die("Fallo");

	$array = array();
	while ($rows = mysqli_fetch_assoc($resultado)){
		array_push($array,$rows);
	}

	Database::disconnect();

	return $array;
		
}

function buscarUsuarioPorEmail($busqueda){

	$link = Database::connect();

	$resultado = mysqli_query($link,"SELECT * from registrado r INNER JOIN usuario u ON (r.email = u.email) where r.email LIKE '%".$busqueda."%' AND u.tipo != -1") or die("Fallo");

	$array = array();
	while ($rows = mysqli_fetch_assoc($resultado)){
		array_push($array,$rows);
	}

	Database::disconnect();

	return $array;
		
}

function buscarUsuarioPorApellido($busqueda){

	$link = Database::connect();

	$resultado = mysqli_query($link,"SELECT * from registrado r INNER JOIN usuario u ON (r.email = u.email) where apellido LIKE '%".$busqueda."%' AND u.tipo != -1") or die("Fallo");

	$array = array();
	while ($rows = mysqli_fetch_assoc($resultado)){
		array_push($array,$rows);
	}

	Database::disconnect();

	return $array;
		
}



function actualizarDatosUsuario($email,$nombre,$apellido,$pais,$provincia,$localidad,$sexo,$calle,$numCalle,$dpto,$piso){

	$link = Database::connect();
    $alta = date("y/m/d");
    $result = mysqli_query($link,"SELECT pais_id FROM pais WHERE code='$pais'");
    $fila = mysqli_fetch_row($result);
    $pais_id = $fila[0];
    mysqli_free_result($result);
    mysqli_query($link,"UPDATE registrado SET nombre='$nombre', apellido='$apellido', paisID='$pais_id', provinciaID = '$provincia', localidad='$localidad' , sexo='$sexo', calle='$calle', numCalle='$numCalle', departamento='$dpto', piso='$piso' WHERE email='$email'") or die("Fallo la modificacion de datos.");
    
    Database::disconnect();
}

function eliminarUsuario($email){

	$link = Database::connect();
    
    mysqli_query($link,"UPDATE usuario SET tipo=-1 WHERE email='$email'") or die("Fallo la eliminacion de datos.");
    
    Database::disconnect();
}

function registrarUsuario($email,$password){
    
    $link = Database::connect();            
    
    mysqli_query($link,"INSERT INTO usuario(email,password) VALUES ('$email','$password')") or die("Falló al intentar registrar el usuario");
    
    Database::disconnect();
}

function registrarTarjeta($numTarjeta,$codSeg,$empresa,$banco,$vencimiento,$nombreTitular,$apellidoTitular){
    
    $link = Database::connect(); 
    
    /*$vencimiento = "01/".$vencimiento;
    $date = date("Y/m/d", strtotime($vencimiento));*/
    mysqli_query($link,"INSERT INTO tarjeta(numero,codSeguridad,empresa,banco,nombre,apellido,fechaVencimiento) VALUES ('$numTarjeta','$codSeg','$empresa','$banco','$nombreTitular','$apellidoTitular','$vencimiento')") or die("Falló al intentar registrar la tarjeta");
    
    Database::disconnect();
}

function registrar($email,$nombre,$apellido,$fechaNac,$dni,$sexo,$calle,$numCalle,$dpto,$piso,$numTarjeta,$pais,$provincia,$localidad){
    
    $link = Database::connect();
    $alta = date("y/m/d");
    $result = mysqli_query($link,"SELECT pais_id FROM pais WHERE code='$pais'");
    $fila = mysqli_fetch_row($result);
    $pais_id = $fila[0];
    mysqli_query($link,"INSERT INTO registrado(email,nombre,apellido,dni,fechaNacimiento,fechaAlta,sexo,calle,numCalle,departamento,piso,tarjeta,paisID,provinciaID,localidad) VALUES ('$email','$nombre','$apellido','$dni','$fechaNac','$alta','$sexo','$calle','$numCalle','$dpto','$piso','$numTarjeta','$pais_id','$provincia','$localidad')") or die("Falló al registrar");
    
    Database::disconnect();
}

function consultarCategoria($nombre){

	$link = Database::connect();

	$resultado = mysqli_query($link, "SELECT idCategoria FROM categoria WHERE nombre='$nombre'");
	$row = mysqli_fetch_row($resultado);

	Database::disconnect();

	return $row[0];
}

function cargarPublicacion($titulo,$descripcion,$categoria,$user){

	$link = Database::connect();

	$creacion = date('y/m/d');
	$finalizacion = date('y/m/d', strtotime('+1 month'));
	mysqli_query($link, "INSERT INTO publicacion(titulo,descripcion,categoria,fechaCreacion,fechaFinalizacion,usuario) VALUES('$titulo','$descripcion','$categoria','$creacion','$finalizacion','$user')") or die("Fallo la publicacion");
	$id = mysqli_insert_id($link);

	Database::disconnect();

	return $id;
}

function cargarImagenes($img,$img2,$img3,$idPublicacion){

	$link = Database::connect();

	if ($img["size"] != 0){
		$info=getimagesize($img["tmp_name"]);
		$ancho = $info[0];
		$alto = $info[1];
		$tipo = $img["type"];
		$contenido = mysqli_real_escape_string($link, file_get_contents($img["tmp_name"]));
		mysqli_query($link,"INSERT INTO imagen(ancho,alto,tipo,contenido,idPublicacion) VALUES('$ancho','$alto','$tipo','$contenido','$idPublicacion')") or die("Fallo la creacion de la imagen");
		
	}	

	if ($img2["size"] != 0){
		$info =getimagesize($img2["tmp_name"]);
		$ancho = $info[0];
		$alto = $info[1];
		$tipo = $img2["type"];
		$contenido = mysqli_real_escape_string($link, file_get_contents($img2["tmp_name"]));
		mysqli_query($link,"INSERT INTO imagen(ancho,alto,tipo,contenido,idPublicacion) VALUES('$ancho','$alto','$tipo','$contenido','$idPublicacion')") or die("Fallo la creacion de la imagen");
		
	}

	if ($img3["size"] != 0){
		$info=getimagesize($img3["tmp_name"]);
		$ancho = $info[0];
		$alto = $info[1];
		$tipo = $img3["type"];
		$contenido = mysqli_real_escape_string($link, file_get_contents($img3["tmp_name"]));
		mysqli_query($link,"INSERT INTO imagen(ancho,alto,tipo,contenido,idPublicacion) VALUES('$ancho','$alto','$tipo','$contenido','$idPublicacion')") or die("Fallo la creacion de la imagen");
	}
	

	Database::disconnect();

}

function buscarPor($criterio,$data){

	$link = Database::connect();

	$resultado = mysqli_query($link,"SELECT * FROM publicacion WHERE $criterio like '%".$data."%'")or die("Fallo la busqueda de publicaciones por descripcion");
	$array = array();
	while ($rows = mysqli_fetch_assoc($resultado)){
		array_push($array, $rows);
	}

	Database::disconnect();

	return $array;
}

function consultarCategorias(){

	$link = Database::connect();

	$resultado = mysqli_query($link,"SELECT nombre FROM categoria WHERE borrado = 0 ORDER BY nombre ASC") or die("Fallo al obtener las categorias");
	$array = array();
	while ($rows = mysqli_fetch_row($resultado)){
		array_push($array, $rows);
	}

	Database::disconnect();

	return $array;
}

function buscarPorCategoria($idCategoria){

	$link = Database::connect();

	$resultado = mysqli_query($link,"SELECT * FROM publicacion WHERE categoria=$idCategoria ORDER BY titulo ASC")or die("Fallo la busqueda de publicaciones por categoria");
	$array = array();
	while ($rows = mysqli_fetch_assoc($resultado)){
		array_push($array,$rows);
	}

	Database::disconnect();

	return $array;
}

function buscarPublicaciones(){

	$link = Database::connect();

	$resultado = mysqli_query($link,"SELECT * FROM publicacion ORDER BY titulo ASC")or die("Fallo la busqueda de publicaciones por categoria");
	$array = array();
	while ($rows = mysqli_fetch_assoc($resultado)){
		array_push($array,$rows);
	}

	Database::disconnect();

	return $array;
}

function obtenerUsuarios(){

	$link = Database::connect();

	$resultado = mysqli_query($link,"SELECT * FROM registrado")or die("Fallo al obtener los usuarios del sitio");
	$array = array();
	while ($rows = mysqli_fetch_assoc($resultado)){
		array_push($array,$rows);
	}

	Database::disconnect();

	return $array;
}

function verificarCategoria($nombre){
    
    $link = Database::connect();
    
    $result = mysqli_query($link,"SELECT * FROM categoria WHERE nombre='$nombre'") or die('Falló la consulta de categoria');
    $total = mysqli_fetch_assoc($result);
    
    Database::disconnect();
    
    return $total;
}

function agregarCategoria($nombre){

	$link = Database::connect();

	mysqli_query($link,"INSERT INTO categoria(nombre) VALUES('$nombre')")or die("Fallo al crear categoria");

	Database::disconnect();

}

function agregarCategoriaBorrada($nombre){

	$link = Database::connect();

	mysqli_query($link,"UPDATE categoria SET borrado=0 WHERE nombre='$nombre'")or die("Fallo al crear categoria");

	Database::disconnect();

}

function eliminarCategoria($nombre){

	$link = Database::connect();

	mysqli_query($link,"UPDATE categoria SET borrado=1 WHERE nombre='$nombre'")or die("Fallo al eliminar categoria");

	Database::disconnect();

}

function buscarImagenPublicacion($idPublicacion){

	$link = Database::connect();

	$resultado = mysqli_query($link,"SELECT idImagen FROM imagen WHERE idPublicacion=$idPublicacion LIMIT 1")or die("Fallo al buscar imagen");

	$idImagen = mysqli_fetch_row($resultado);

	Database::disconnect();

	return $idImagen[0];
}

?>
