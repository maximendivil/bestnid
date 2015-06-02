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

	$query = mysqli_query($link,"SELECT * from registrado r INNER JOIN usuario u ON (r.email = u.email) where dni=$busqueda AND u.tipo != -1") or die("Fallo");

	$rows = mysqli_fetch_assoc($query);

	Database::disconnect();

	return $rows;
		
}

function buscarUsuarioPorEmail($busqueda){

	$link = Database::connect();

	$query = mysqli_query($link,"SELECT * from registrado r INNER JOIN usuario u ON (r.email = u.email) where r.email='$busqueda' AND u.tipo != -1") or die("Fallo");

	$rows = mysqli_fetch_assoc($query);

	Database::disconnect();

	return $rows;
		
}

function buscarUsuarioPorApellido($busqueda){

	$link = Database::connect();

	$query = mysqli_query($link,"SELECT * from registrado r INNER JOIN usuario u ON (r.email = u.email) where apellido='$busqueda' AND u.tipo != -1") or die("Fallo");

	$rows = mysqli_fetch_assoc($query);

	Database::disconnect();

	return $rows;
		
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
    
    $vencimiento = "01/".$vencimiento;
    $date = date("Y/m/d", strtotime($vencimiento));
    mysqli_query($link,"INSERT INTO tarjeta(numero,codSeguridad,empresa,banco,nombre,apellido,fechaVencimiento) VALUES ('$numTarjeta','$codSeg','$empresa','$banco','$nombreTitular','$apellidoTitular','$date')") or die("Falló al intentar registrar la tarjeta");
    
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

	$id_categoria = mysqli_query($link, "SELECT idCategoria FROM categoria WHERE nombre='$nombre'");

	Database::disconnect();

	return $id_categoria;
}

function cargarPublicacion($titulo,$descripcion,$categoria,$user){

	$link = Database::connect();

	$creacion = date('y/m/d');
	$finalizacion = date('y/m/d', strtotime('+1 month'));
	mysqli_query($link, "INSERT INTO publicacion(titulo,descripcion,categoria,fechaCreacion,fechaFinalizacion,usuario) VALUES('$titulo','$descripcion','$categoria','$creacion','$finalizacion','$user')") or die("Fallo la publicacion");

	Database::disconnect();

}


?>
