<?php 
session_start();
include("header.php"); 
include("cpanel_menu.php");
include("funciones.php");

if(!isset($_SESSION['usuario'])){
    header("location: index.php");
}

if(isset($_GET['finalizar'])){
	finalizarPublicacion($_GET['finalizar']);
}

?>

<div class="col-sm-1">
</div>
<div class="col-md-9">
	<form class="form-horizontal" style="padding-top: 1em" method="POST" action="<?php echo $_SERVER["PHP_SELF"];?>">
	<label class="col-md-1 control-label" for="nombre">Desde: </label>
	<div class="col-md-2"><input type="date" id="busqueda" name="fechaInicial" required class="form-control"></div>
	<label class="col-md-1 control-label" for="nombre">Hasta: </label>
	<div class="col-md-2"><input type="date" id="busqueda" name="fechaFinal" required class="form-control"></div>
	 <div class="col-sm-2"><span class="input-group-btn"><button class="btn btn-default" type="submit">Buscar</button></span></div>
</div>
<div class="col-sm-1">
</div>
  	<div class="col-sm-7">
  	<div class="row">
	<br><br>
	<table class="table table-hover">
    <thead>
      <tr>
      	<th>Publicacion</th>
        <th>Email</th>
        <th>Fecha publicacion</th>
        <th>Fecha Finalizacion</th>
        <th>Estado</th>
        <th>Accion</th>
      </tr>
    </thead>
    <tbody>
		<?php
			if ($_SERVER["REQUEST_METHOD"] == "POST") {

					$rows = buscarPublicacionesEntreFechas($_POST["fechaInicial"],$_POST["fechaFinal"]);	

					if (count($rows)>0){
						for ($i=0; $i < count($rows); $i++) {
							echo "<tr>";
							$idPublicacion = $rows[$i]["numeroPublicacion"];
							$idImagen = buscarImagenPublicacion($idPublicacion);
							echo "<td><img src='imagen_mostrar.php?id=".$idImagen."' width='40' height='40'> ".$rows[$i]["titulo"]."</td>";
							echo "<td>".$rows[$i]["usuario"]."</td>";
							echo "<td>".$rows[$i]['fechaCreacion']."</td>";
							echo "<td>".$rows[$i]['fechaFinalizacion']."</td>";
							if ($rows[$i]['finalizada']){
								echo "<td>Finalizada</td>";
							}
							else {
								echo "<td>Activa</td>";
								echo "<td><a href='publicacion.php?id=$idPublicacion' data-toggle='tooltip' title='Ver publicacion'><span class='glyphicon glyphicon-search'></span></a><a href='?finalizar=".$rows[$i]['numeroPublicacion']."' data-toggle='tooltip' title='Finalizar publicacion'><span class='glyphicon glyphicon-remove'></span></a></td>";
							}
							
							echo "</tr>";
						}
					}
					else {
						echo "<p style='color: red'>No se han encontrado publicaciones que cumplan con la busqueda. Por favor intente nuevamente</p>";
					}
			}
			
			else {

				$rows = buscarTodasLasPublicaciones();

				if (count($rows)>0){
						for ($i=0; $i < count($rows); $i++) {
							echo "<tr>";
							$idPublicacion = $rows[$i]["numeroPublicacion"];
							$idImagen = buscarImagenPublicacion($idPublicacion);
							echo "<td><img src='imagen_mostrar.php?id=".$idImagen."' width='40' height='40'> ".$rows[$i]["titulo"]."</td>";
							echo "<td>".$rows[$i]["usuario"]."</td>";
							echo "<td>".$rows[$i]['fechaCreacion']."</td>";
							echo "<td>".$rows[$i]['fechaFinalizacion']."</td>";
							if ($rows[$i]['finalizada']){
								echo "<td>Finalizada</td>";
							}
							else {
								echo "<td>Activa</td>";
								echo "<td><a href='publicacion.php?id=$idPublicacion' data-toggle='tooltip' title='Ver publicacion'><span class='glyphicon glyphicon-search'></span></a><a href='?finalizar=".$rows[$i]['numeroPublicacion']."' data-toggle='tooltip' title='Finalizar publicacion'><span class='glyphicon glyphicon-remove'></span></a></td>";
							}							
							echo "</tr>";
						}
				}
				else {
						echo "<p style='color: red'>No se han encontrado publicaciones. Por favor intente nuevamente</p>";
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