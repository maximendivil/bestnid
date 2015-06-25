<?php 
session_start();
include("header.php"); 
include("cpanel_menu.php");
include("funciones.php");

if(!isset($_SESSION['usuario'])){
    header("location: index.php");
}

?>

<div class="col-md-8">
	<form class="form-horizontal" style="padding-top: 1em" method="POST" action="<?php echo $_SERVER["PHP_SELF"];?>">
	<label class="col-md-1 control-label" for="nombre">Desde: </label>
	<div class="col-md-2"><input type="date" id="busqueda" name="fechaInicial" required class="form-control"></div>
	<label class="col-md-1 control-label" for="nombre">Hasta: </label>
	<div class="col-md-2"><input type="date" id="busqueda" name="fechaFinal" required class="form-control"></div>
	 <div class="col-sm-2"><span class="input-group-btn"><button class="btn btn-default" type="submit">Buscar</button></span></div>
</div>
  	<div class="col-sm-7">
  	<div class="row">
	<br><br>
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
      </tr>
    </thead>
    <tbody>
		<?php
			if ($_SERVER["REQUEST_METHOD"] == "POST") {

					$rows = buscarRegistradosEntreFechas($_POST["fechaInicial"],$_POST["fechaFinal"]);	

					if (count($rows)>0){
						for ($i=0; $i < count($rows); $i++) {
							echo "<tr>";
							echo "<td>".$rows[$i]["email"]."</td>";
							echo "<td>".$rows[$i]['dni']."</td>";
							echo "<td>".$rows[$i]['apellido']."</td>";
							echo "<td>".$rows[$i]['nombre']."</td>";
							echo "<td>".$rows[$i]['fechaAlta']."</td>";
							echo "<td>".$rows[$i]['fechaNacimiento']."</td>";
							echo "<td>".$rows[$i]['sexo']."</td>";
							echo "</tr>";
						}
					}
					else {
						echo "<p style='color: red'>No se han encontrado usuarios que cumplan con la busqueda. Por favor intente nuevamente</p>";
					}
			}
			
			else {

				$rows = obtenerUsuarios();

				if (count($rows)>0){
					for ($i=0; $i < count($rows); $i++) { 
						echo "<tr>";
						echo "<td>".$rows[$i]["email"]."</td>";
						echo "<td>".$rows[$i]['dni']."</td>";
						echo "<td>".$rows[$i]['apellido']."</td>";
						echo "<td>".$rows[$i]['nombre']."</td>";
						echo "<td>".$rows[$i]['fechaAlta']."</td>";
						echo "<td>".$rows[$i]['fechaNacimiento']."</td>";
						echo "<td>".$rows[$i]['sexo']."</td>";
						echo "</tr>";
					}
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