<?php 
session_start();
include("header.php"); 
include("cpanel_menu.php");
include("funciones.php");

if(!isset($_SESSION['usuario'])){
    header("location: index.php");
}
$error = "";
$formValid = 1;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	$criterio = $_POST['criterio'];
	$busqueda = $_POST['busqueda'];

	//VALIDACION DE LA BUSQUEDA DEPENDE EL CRITERIO
	switch($criterio){
		case 0: {
			if (strlen($busqueda) > 8){
                $formValid = 0;
                $error = "El DNI excede los 8 digitos";
			}
			if(!is_numeric($busqueda)){
				$formValid = 0;
				$error = "El DNI debe ser numerico";
			}
			break;
		}
		case 1: {
			if (!(filter_var($busqueda, FILTER_VALIDATE_EMAIL))){ 
				$formValid = 0;
				$error = "El formato del email es invalido";
			}
			break;
		}
		case 2: {
			if (!preg_match("/^[a-zA-Z ]*$/",$busqueda)) {
                $formValid = 0;
                $error = "Solo se permiten letras y espacios"; 
            }
			break;
		}
	}
	// ----------------------------- //
	
	
	
}
?>

<div class="col-md-8">
	<form class="form-horizontal" style="padding-top: 1em" method="POST" action="<?php echo $_SERVER["PHP_SELF"];?>">

	<div class="col-sm-1"><h5>Buscar por:</h5></div>
	<div class="col-md-2">
	<select class="form-control" id="criterio" name="criterio">
        <option value='0' selected='selected'>DNI</option>
        <option value='1'>E-Mail</option>
        <option value='2'>Apellido</option>
    </select>
	</div>
	<div class="col-sm-5"><input type="text" id="busqueda" name="busqueda" required class="form-control" placeholder="Escribe la busqueda aqui..."></div>
	 <div class="col-sm-2"><span class="input-group-btn"><button class="btn btn-default" type="submit">Buscar</button></span></div>
	  <span class="advertencia"><?php echo $error;?></span>
  </div>
  	<div class="col-sm-7">
  	<div class="row">
	
	<table class="table table-hover">
    <thead>
      <tr>
        <th>Email</th>
        <th>DNI</th>
        <th>Apellido</th>
		<th>Nombre</th>
		<th style="width: 50px">Alta</th>
		<th>F. Nacimiento</th>
		<th>Sexo</th>
		<th>Accion</th>		
      </tr>
    </thead>
    <tbody>
		<?php
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				if($formValid){
					switch ($criterio) {
						case 0:
							$rows = buscarUsuarioPorDni($busqueda);
							break;
						case 1:
							$rows = buscarUsuarioPorEmail($busqueda);
							break;
						
						case 2:
							$rows = buscarUsuarioPorApellido($busqueda);
							break;
					}
					$email = $rows['email'];
					echo "<tr>";
					echo "<td>".$email."</td>";
					echo "<td>".$rows['dni']."</td>";
					echo "<td>".$rows['apellido']."</td>";
					echo "<td>".$rows['nombre']."</td>";
					echo "<td>".$rows['fechaAlta']."</td>";
					echo "<td>".$rows['fechaNacimiento']."</td>";
					echo "<td>".$rows['sexo']."</td>";
					echo "<td><a href='eliminar_registrado_db.php?email=$email'><span class='glyphicon glyphicon-remove'></span></a></td>";
					echo "</tr>";
				}
			}
		?>
    </tbody>
  </table>
  </div>

</form>	
</div>
</body>
</html>