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
        <th>Fecha de finalizacion estimada</th>
		<th>Ofertas</th>
		<th>Accion</th>	
      </tr>
    </thead>
    <tbody>
		<?php
			$rows = obtenerVentasActivas($_SESSION['usuario']);
			if (count($rows)>0){
				for ($i=0; $i < count($rows); $i++) { 
					$idPublicacion = $rows[$i]["numeroPublicacion"];
					$idImagen = buscarImagenPublicacion($idPublicacion);
					$cantOfertas = cantidadDeOfertas($idPublicacion);
					echo "<tr>";
					echo "<td><img src='imagen_mostrar.php?id=".$idImagen."' width='40' height='40'> ".$rows[$i]["titulo"]."</td>";
					echo "<td>".$rows[$i]['fechaCreacion']."</td>";
					echo "<td>".$rows[$i]['fechaFinalizacion']."</td>";
					echo "<td>$cantOfertas</td>";
					echo "<td><a href='ofertas_realizadas.php?id=$idPublicacion' data-toggle='tooltip' title='Ver ofertas'><span class='glyphicon glyphicon-heart'></span></a> <a href='publicacion.php?id=$idPublicacion' data-toggle='tooltip' title='Ver publicacion'><span class='glyphicon glyphicon-search'></span></a> <a href='#' data-toggle='tooltip' title='Editar publicacion'><span class='glyphicon glyphicon-edit'></span></a> <a href='?finalizar=".$rows[$i]['numeroPublicacion']."' data-toggle='tooltip' title='Finalizar publicacion'><span class='glyphicon glyphicon-remove'></span></a></td>";
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