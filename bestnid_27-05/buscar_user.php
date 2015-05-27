<?php 
session_start();
include("header.php") ; 
include("cpanel_menu.php");

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
		case "dni": {
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
		case "email": {
			if (!ereg("^([a-zA-Z0-9._]+)@([a-zA-Z0-9.-]+).([a-zA-Z]{2,4})$",$busqueda)){ 
				$formValid = 0;
				$error = "El formato del email es invalido";
			}
			break;
		}
		case "apellido": {
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
<form class="form-horizontal" style="padding-top: 1em" method="POST" action="<?php echo $_SERVER["PHP_SELF"];?>">
<div class="col-md-7">
	<div class="col-sm-2"><h5>Buscar por:</h5></div>
	<div class="col-sm-3">
	<select class="form-control" id="criterio" name="criterio">
        <option value='dni' selected='selected'>DNI</option>
        <option value='email'>E-Mail</option>
        <option value='apellido'>Apellido</option>
    </select>
	</div>
	<div class="col-sm-5"><input type="text" id="busqueda" name="busqueda" required class="form-control" placeholder="Escribe la busqueda aqui..."></div>
	 <div class="col-sm-2"><span class="input-group-btn"><button class="btn btn-default" type="submit">Buscar</button></span></div>
	  <span class="advertencia"><?php echo $error;?></span>
  </div>
  	 <div class="row">
	<div class="col-sm-8">
	<table class="table table-hover">
    <thead>
      <tr>
        <th>Email</th>
        <th>DNI</th>
        <th>Apellido</th>
		<th>Nombre</th>
		<th>Alta</th>
		<th>F. Nacimiento</th>
		<th>Sexo</th>
		<th>Accion</th>		
      </tr>
    </thead>
    <tbody>
		<?php
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				if($formValid){
					$connection = mysql_connect("localhost", "root", "");
					$db = mysql_select_db("bestnid", $connection);
					$query = mysql_query("SELECT * from registrado r INNER JOIN usuario u ON (r.email = u.email) where $criterio='$busqueda' AND u.tipo != -1", $connection);

					while ($rows = mysql_fetch_assoc($query)) {
						$email = $rows['email'];
						echo "<tr>";
						echo "<td>".$email."</td>";
						echo "<td>".$rows['dni']."</td>";
						echo "<td>".$rows['apellido']."</td>";
						echo "<td>".$rows['nombre']."</td>";
						echo "<td>".$rows['fechaAlta']."</td>";
						echo "<td>".$rows['fechaNacimiento']."</td>";
						echo "<td>".$rows['sexo']."</td>";
						echo "<td><a href='eliminar_registrado_db.php?email=$email'>Eliminar</a></td>";
						echo "</tr>";
					}
		
					mysql_close($connection);
				}
			}
		?>
    </tbody>
  </table>
  </div>
</div>   
</form>		       
        

<div class="clearfix visible-lg"></div>
	
</div>
</div>
</body>
</html>