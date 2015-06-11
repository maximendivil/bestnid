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

  	<div class="col-sm-6">
  	<div class="row">
	
	<table class="table table-hover">
    <thead>
      <tr>
        <th>Publicacion</th>
        <th>Fecha de publicacion</th>
        <th>Fecha de finalizacion</th>
		<th>Accion</th>	
      </tr>
    </thead>
    <tbody>
		<?php
			$rows = obtenerVentasFinalizadas($_SESSION['usuario']);
			if (count($rows)>0){
				for ($i=0; $i < count($rows); $i++) { 
					$idImagen = buscarImagenPublicacion($rows[$i]["numeroPublicacion"]);
					echo "<tr>";
					echo "<td><img src='imagen_mostrar.php?id=".$idImagen."' width='40' height='40'> ".$rows[$i]["titulo"]."</td>";
					echo "<td>".$rows[$i]['fechaCreacion']."</td>";
					echo "<td>".$rows[$i]['fechaFinalizacion']."</td>";
					echo "<td><a href='#' data-toggle='tooltip' title='Ver publicacion'><span class='glyphicon glyphicon-search'></span></a> <a href='republicar.php?idPublicacion=".$rows[$i]["numeroPublicacion"]."' data-toggle='tooltip' title='Republicar'><span class='glyphicon glyphicon-repeat'></span></a></td>";
					echo "</tr>";	
				}
		
			}
			else {
				echo "<div class='alert alert-danger'><p style='color: red ; text-align: center'>No hay publicaciones finalizadas!</p></div>";
			}
		?>
    </tbody>
  </table>
  </div>

</form>	
</div>
</body>
</html>