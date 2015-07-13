<?php
require 'database.php';
date_default_timezone_set("America/Buenos_Aires");

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

function obtenerOfertasRealizadas($email){

	$link = Database::connect();

	$resultado = mysqli_query($link,"SELECT * FROM oferta o INNER JOIN publicacion p on (o.idPublicacion = p.numeroPublicacion) WHERE idRegistrado = '$email' ORDER BY fechaRealizacion DESC") or die("Fallo al buscar ofertas realizadas por un usuario");

	$array = array();
	while ($rows = mysqli_fetch_assoc($resultado)){
		array_push($array,$rows);
	}

	Database::disconnect();

	return $array;
}

function posiblesGanadoras($idPublicacion){

	$link = Database::connect();

	$resultado = mysqli_query($link,"SELECT COUNT(idOferta) FROM oferta WHERE idPublicacion = '$idPublicacion' and posibleGanadora=1")or die("Fallo al buscar posibles ofertas ganadoras");

	$cant = mysqli_fetch_row($resultado);

	Database::disconnect();

	return $cant[0];
}

function obtenerPosiblesGanadoras($idPublicacion){

	$link = Database::connect();

	$resultado = mysqli_query($link,"SELECT * FROM oferta WHERE idPublicacion = '$idPublicacion' and posibleGanadora=1");

	$array = array();
	while ($rows = mysqli_fetch_assoc($resultado)){
		array_push($array,$rows);
	}

	Database::disconnect();

	return $array;
}

function obtenerDatosPublicacion($idOferta){

	$link = Database::connect();

	$resultado = mysqli_query($link,"SELECT * FROM oferta o INNER JOIN publicacion p on (o.idPublicacion = p.numeroPublicacion) WHERE idOferta = '$idOferta'");

	$array = array();
	while ($rows = mysqli_fetch_assoc($resultado)){
		array_push($array,$rows);
	}

	Database::disconnect();

	return $array;
}

function datosPublicacion($idPublicacion){

	$link = Database::connect();

	$resultado = mysqli_query($link,"SELECT * FROM publicacion WHERE numeroPublicacion = '$idPublicacion'");

	$array = array();
	while ($rows = mysqli_fetch_assoc($resultado)){
		array_push($array,$rows);
	}

	Database::disconnect();

	return $array;
}

function elegirOfertaGanadora($idOferta){

	$link = Database::connect();

	mysqli_query($link,"UPDATE oferta set ganadora=1 WHERE idOferta='$idOferta'");

	Database::disconnect();
}

function obtenerDatosGanador($idPublicacion){

	$link = Database::connect();

	$resultado = mysqli_query($link,"SELECT * FROM oferta o INNER JOIN publicacion p on (o.idPublicacion = p.numeroPublicacion) WHERE o.idPublicacion = '$idPublicacion' and ganadora=1") or die("Fallo al obtener los datos del ganador");

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



function actualizarDatosUsuario($email,$nombre,$apellido,$pais,$provincia,$localidad,$sexo,$calle,$numCalle,$dpto,$piso,$dni,$fechaNac){

	$link = Database::connect();
    $alta = date("y/m/d");
    $result = mysqli_query($link,"SELECT pais_id FROM pais WHERE code='$pais'");
    $fila = mysqli_fetch_row($result);
    $pais_id = $fila[0];
    mysqli_free_result($result);
    mysqli_query($link,"UPDATE registrado SET nombre='$nombre', apellido='$apellido', paisID='$pais_id', provinciaID = '$provincia', localidad='$localidad' , sexo='$sexo', calle='$calle', numCalle='$numCalle', departamento='$dpto', piso='$piso', dni='$dni', fechaNacimiento='$fechaNac' WHERE email='$email'") or die("Fallo la modificacion de datos.");
    
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

function republicar($categoria,$titulo,$descripcion,$usuario){

	$link = Database::connect();

	$creacion = date('y/m/d');
	$finalizacion = date('y/m/d', strtotime('+1 month'));
	mysqli_query($link, "INSERT INTO publicacion(titulo,descripcion,categoria,fechaCreacion,fechaFinalizacion,usuario) VALUES('$titulo','$descripcion','$categoria','$creacion','$finalizacion','$usuario')") or die("Fallo la publicacion");
	$id = mysqli_insert_id($link);

	Database::disconnect();

	return $id;
}

function cargarImagen($idPublicacion,$idImagen){

	$link = Database::connect();

	mysqli_query($link,"INSERT INTO imagenpublicacion(idPublicacion,idImagen) VALUES('$idPublicacion','$idImagen')") or die("Fallo al crear imagen");

	Database::disconnect();
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

	$resultado = mysqli_query($link,"SELECT nombre FROM categoria WHERE borrado=0 ORDER BY nombre ASC") or die("Fallo al obtener las categorias");
	$array = array();
	while ($rows = mysqli_fetch_row($resultado)){
		array_push($array, $rows);
	}

	Database::disconnect();

	return $array;
}

function buscarPorCategoria($idCategoria){

	$link = Database::connect();
	
	$fechaActual = date('Y-m-d');
	
	$resultado = mysqli_query($link,"SELECT * FROM publicacion WHERE categoria=$idCategoria ORDER BY titulo ASC")or die("Fallo la busqueda de publicaciones por categoria");
	$array = array();
	while ($rows = mysqli_fetch_assoc($resultado)){
		if( ($rows['finalizada'] == 0) AND ($fechaActual < $rows['fechaFinalizacion']) ) array_push($array,$rows);
	}

	Database::disconnect();

	return $array;
}

function publicacionesPaginadasPorCategoria($idCategoria,$inicio,$tam){

	$link = Database::connect();
	
	$fechaActual = date('Y-m-d');
	
	$resultado = mysqli_query($link,"SELECT * FROM publicacion WHERE categoria=$idCategoria ORDER BY titulo ASC LIMIT ".$inicio.", ".$tam)or die("Fallo la busqueda de publicaciones por categoria");
	$array = array();
	while ($rows = mysqli_fetch_assoc($resultado)){
		if( ($rows['finalizada'] == 0) AND ($fechaActual < $rows['fechaFinalizacion']) ) array_push($array,$rows);
	}

	Database::disconnect();

	return $array;
}


function buscarPublicaciones(){

	$link = Database::connect();
	
	$fechaActual = date('Y-m-d');
	
	$resultado = mysqli_query($link,"SELECT * FROM publicacion ORDER BY titulo ASC")or die("Fallo la busqueda de publicaciones por categoria");
	$array = array();
	while ($rows = mysqli_fetch_assoc($resultado)){
		if( ($rows['finalizada'] == 0) AND ($fechaActual < $rows['fechaFinalizacion']) ) array_push($array,$rows);
	}

	Database::disconnect();

	return $array;
}

function publicacionesPaginadas($inicio,$tam){

	$link = Database::connect();
	
	$fechaActual = date('Y-m-d');
	
	$resultado = mysqli_query($link,"SELECT * FROM publicacion WHERE finalizada=0 ORDER BY titulo ASC LIMIT ".$inicio.", ".$tam)or die("Fallo la busqueda de publicaciones paginadas");
	$array = array();
	while ($rows = mysqli_fetch_assoc($resultado)){
		array_push($array,$rows);
	}

	Database::disconnect();

	return $array;
}

function obtenerUsuarios(){

	$link = Database::connect();

	$resultado = mysqli_query($link,"SELECT * FROM registrado r INNER JOIN usuario u on (r.email=u.email) WHERE tipo != -1")or die("Fallo al obtener los usuarios del sitio");
	$array = array();
	while ($rows = mysqli_fetch_assoc($resultado)){
		array_push($array,$rows);
	}

	Database::disconnect();

	return $array;
}

function darAltaAdministrador($email){

	$link = Database::connect();

	mysqli_query($link,"UPDATE usuario SET tipo=1 WHERE email='$email'")or die("Fallo al dar de alta a un usuario como administrador");

	Database::disconnect();
}

function darBajaAdministrador($email){

	$link = Database::connect();

	mysqli_query($link,"UPDATE usuario SET tipo=0 WHERE email='$email'")or die("Fallo al dar de alta a un usuario como administrador");

	Database::disconnect();
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

function cantidadPublicacionesCategoria($nombre){

	$link = Database::connect();

	$resultado = mysqli_query($link,"SELECT COUNT(numeroPublicacion) FROM categoria c INNER JOIN publicacion p on (c.idCategoria = p.categoria) WHERE nombre='$nombre' and p.finalizada=0")or die("Fallo al buscar publicaciones de la categoria");
	$cantidad = mysqli_fetch_row($resultado);

	Database::disconnect();

	return $cantidad[0];

}

function cantidadPublicacionesRegistrado($email){

	$link = Database::connect();

	$resultado = mysqli_query($link,"SELECT COUNT(numeroPublicacion) FROM usuario u INNER JOIN publicacion p on (u.email = p.usuario) WHERE email='$email' and p.finalizada=0")or die("Fallo al buscar publicaciones del usuario");
	$cantidad = mysqli_fetch_row($resultado);

	Database::disconnect();

	return $cantidad[0];
}

function buscarImagenPublicacion($idPublicacion){

	$link = Database::connect();

	$resultado = mysqli_query($link,"SELECT idImagen FROM imagen WHERE idPublicacion=$idPublicacion LIMIT 1")or die("Fallo al buscar imagen");

	$idImagen = mysqli_fetch_row($resultado);

	Database::disconnect();

	return $idImagen[0];
}

function buscarImagenesPublicacion($idPublicacion){

	$link = Database::connect();

	$resultado = mysqli_query($link,"SELECT idImagen FROM imagen WHERE idPublicacion=$idPublicacion")or die("Fallo al buscar imagen");

	$array = array();
	while ($rows = mysqli_fetch_row($resultado)){
		array_push($array,$rows);
	}

	Database::disconnect();

	return $array;
}

function obtenerImagenesPublicacion($idPublicacion){

	$link = Database::connect();

	$resultado = mysqli_query($link,"SELECT * FROM imagen WHERE idPublicacion=$idPublicacion")or die("Fallo al buscar imagen");

	$array = array();
	while ($rows = mysqli_fetch_assoc($resultado)){
		array_push($array,$rows);
	}

	Database::disconnect();

	return $array;

}

function obtenerVentasActivas($usuario){

	$link = Database::connect();
	
	$fechaActual = date('Y-m-d');

	$resultado = mysqli_query($link,"SELECT * FROM publicacion WHERE usuario='$usuario' ORDER BY fechaCreacion ASC")or die("Fallo la busqueda de ventas");
	$array = array();
	while ($rows = mysqli_fetch_assoc($resultado)){
		if( ($rows['finalizada'] == 0) AND ($fechaActual < $rows['fechaFinalizacion']) ) array_push($array,$rows);
	}

	Database::disconnect();

	return $array;
}

function obtenerVentasFinalizadas($usuario){

	$link = Database::connect();
	
	$fechaActual = date('Y-m-d');

	$resultado = mysqli_query($link,"SELECT * FROM publicacion WHERE usuario='$usuario' ORDER BY fechaCreacion ASC")or die("Fallo la busqueda de ventas");
	$array = array();
	while ($rows = mysqli_fetch_assoc($resultado)){
		if( ($rows['finalizada'] == 1) OR ($fechaActual > $rows['fechaFinalizacion']) ) array_push($array,$rows);
	}

	Database::disconnect();

	return $array;
}

function finalizarPublicacion($idPublicacion){
	
	$link = Database::connect();
	
	$fechaActual = date('Y-m-d');
	mysqli_query($link,"UPDATE publicacion SET finalizada=1, fechaFinalizacion='$fechaActual' WHERE numeroPublicacion=$idPublicacion")or die("Fallo al buscar imagen");

	Database::disconnect();
}

function buscarRegistradosEntreFechas($fechaInicial,$fechaFinal){

	$link = Database::connect();

	$resultado = mysqli_query($link,"SELECT * FROM registrado r INNER JOIN usuario u on (r.email = u.email) WHERE u.tipo=0 and '$fechaInicial' <= fechaAlta and fechaAlta <= '$fechaFinal' ORDER BY fechaAlta DESC")or die("Fallo al buscar usuarios registrados entre dos fechas");
	$array = array();
	while ($rows = mysqli_fetch_assoc($resultado)){
		array_push($array,$rows);
	}

	Database::disconnect();

	return $array;

}

function buscarPublicacionesEntreFechas($fechaInicial,$fechaFinal){

	$link = Database::connect();

	$resultado = mysqli_query($link,"SELECT * FROM publicacion WHERE '$fechaInicial' <= fechaCreacion and fechaCreacion <= '$fechaFinal' ORDER BY fechaCreacion DESC")or die("Fallo al buscar publicaciones entre dos fechas");
	$array = array();
	while ($rows = mysqli_fetch_assoc($resultado)){
		array_push($array,$rows);
	}

	Database::disconnect();

	return $array;
}

function buscarTodasLasPublicaciones(){

	$link = Database::connect();

	$resultado = mysqli_query($link,"SELECT * FROM publicacion ORDER BY fechaCreacion DESC")or die("Fallo al buscar publicaciones");
	$array = array();
	while ($rows = mysqli_fetch_assoc($resultado)){
		array_push($array,$rows);
	}

	Database::disconnect();

	return $array;
}

function cantidadRegistrados(){

	$link = Database::connect();

	$resultado = mysqli_query($link,"SELECT COUNT(dni) from registrado r INNER JOIN usuario u on(r.email=u.email) WHERE tipo =0 ") or die("Fallo al obtener la cantidad de usuarios registrados");
	$cant = mysqli_fetch_row($resultado);

	Database::disconnect();

	return $cant[0];
}

/*function republicar($idPublicacion){

	$link = Database::connect();

	$creacion = date('y/m/d');
	$finalizacion = date('y/m/d', strtotime('+1 month'));
	mysqli_query($link,"UPDATE publicacion SET finalizada=0,fechaCreacion='$creacion',fechaFinalizacion='$finalizacion' WHERE numeroPublicacion=$idPublicacion") or die("Fallo al republicar");

	Database::disconnect();
}*/

function obtenerPublicacion($idPublicacion){
	
	$link = Database::connect();

	$resultado = mysqli_query($link,"SELECT * FROM publicacion WHERE numeroPublicacion=$idPublicacion")or die("Fallo la busqueda de publicacion");
	$rows = mysqli_fetch_assoc($resultado);

	Database::disconnect();

	return $rows;
}

function obtenerComentarios($idPublicacion){
	
	$link = Database::connect();
	
	$resultado = mysqli_query($link,"SELECT * FROM comentario WHERE idPublicacion='$idPublicacion' ORDER BY fecha ASC")or die("Fallo la busqueda de comentarios");
	$array = array();
	while ($rows = mysqli_fetch_assoc($resultado)){
		if($rows['borrado'] == 0) array_push($array,$rows);
	}

	Database::disconnect();

	return $array;
}


function insertarComentario($publicacion,$usuario,$comentario){

	$link = Database::connect();
	
	$fechayhora = date('Y-m-d H:i:s');
	mysqli_query($link,"INSERT INTO comentario(idPublicacion,idRegistrado,contenido,fecha) VALUES('$publicacion','$usuario','$comentario','$fechayhora')")or die("Fallo al insertar comentario");

	Database::disconnect();

}

function eliminarComentario($idComentario){

	$link = Database::connect();

	mysqli_query($link,"UPDATE comentario SET borrado=1 WHERE idComentario=$idComentario") or die("Fallo al eliminar comentario");

	Database::disconnect();
}

function usuarioCreadorPublicacion($idComentario){

	$link = Database::connect();

	$resultado = mysqli_query($link,"SELECT p.usuario FROM comentario c INNER JOIN publicacion p on (c.idPublicacion = p.numeroPublicacion)")or die("Fallo al buscar el creador de la publicacion");
	$usuario = mysqli_fetch_row($resultado);

	Database::disconnect();

	return $usuario[0];
}

function creadorPublicacion($numeroPublicacion){

	$link = Database::connect();

	$resultado = mysqli_query($link,"SELECT p.usuario FROM registrado r INNER JOIN publicacion p on (r.email = p.usuario) WHERE p.numeroPublicacion = '$numeroPublicacion'")or die("Fallo al buscar el creador de la publicacion");
	$usuario = mysqli_fetch_row($resultado);

	Database::disconnect();

	return $usuario[0];
}

function agregarOferta($idPublicacion,$usuario,$monto,$motivo){

	$link = Database::connect();

	$creacion = date('y/m/d');

	mysqli_query($link,"INSERT INTO oferta(motivo,monto,fechaRealizacion,idPublicacion,idRegistrado) VALUES('$motivo',$monto,'$creacion','$idPublicacion','$usuario')")or die("Fallo al crear una oferta");

	Database::disconnect();
}

function verificarOfertaRealizada($idPublicacion,$usuario){
	
	$link = Database::connect();

	$resultado = mysqli_query($link,"SELECT * FROM oferta WHERE idPublicacion=$idPublicacion AND idRegistrado='$usuario'")or die("Fallo en verificar ofertas realizadas");
	$rows = mysqli_fetch_assoc($resultado);

	Database::disconnect();

	return $rows;
}

function diasRestantes($fecha_final) {
	$fecha_actual = date("Y-m-d");
	$s = strtotime($fecha_final)-strtotime($fecha_actual);
	$d = intval($s/86400);
	$diferencia = $d;
	return $diferencia;
}

function cantidadDeOfertas($idPublicacion){
	
	$link = Database::connect();

	$resultado = mysqli_query($link,"SELECT count(idOferta) FROM oferta WHERE idPublicacion=$idPublicacion")or die("Fallo en verificar ofertas realizadas");
	$cant = mysqli_fetch_row($resultado);

	Database::disconnect();

	return $cant[0];
}

function obtenerOfertasDePublicacion($idPublicacion){
	
	$link = Database::connect();

	$resultado = mysqli_query($link,"SELECT * FROM oferta WHERE idPublicacion=$idPublicacion")or die("Fallo al obtener ofertas");
	$array = array();
	while ($rows = mysqli_fetch_assoc($resultado)){
		array_push($array,$rows);
	}

	Database::disconnect();

	return $array;
}

function obtenerComentariosDePublicacion($idPublicacion){

	$link = Database::connect();

	$resultado = mysqli_query($link,"SELECT * FROM comentario WHERE idPublicacion=$idPublicacion and borrado=0 ORDER BY fecha DESC")or die("Fallo al obtener comentarios");
	$array = array();
	while ($rows = mysqli_fetch_assoc($resultado)){
		array_push($array,$rows);
	}

	Database::disconnect();

	return $array;
}

function posibleGanadora($idOferta){

	$link = Database::connect();

	mysqli_query($link,"UPDATE oferta SET posibleGanadora=1 WHERE idOferta=$idOferta") or die("Fallo al actualizar oferta");

	Database::disconnect();
}

function rechazarOferta($idOferta){

	$link = Database::connect();

	mysqli_query($link,"UPDATE oferta SET posibleGanadora=-1 WHERE idOferta=$idOferta") or die("Fallo al actualizar oferta");

	Database::disconnect();
}

function recalificarOferta($idOferta){

	$link = Database::connect();

	mysqli_query($link,"UPDATE oferta SET posibleGanadora=0 WHERE idOferta=$idOferta") or die("Fallo al actualizar oferta");

	Database::disconnect();
}

function publicacionesIndex(){

	$link = Database::connect();

	$publicaciones = mysqli_query($link,"SELECT * FROM publicacion WHERE finalizada=0 ORDER BY fechaCreacion DESC LIMIT 6")or die("Fallo al obtener ultimas publicaciones");

	$array = array();
	while ($rows = mysqli_fetch_assoc($publicaciones)){
		array_push($array,$rows);
	}

	Database::disconnect();

	return $array;
}


?>
