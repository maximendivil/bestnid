<?php 
session_start();
include("header.php"); 
include("cpanel_menu.php");
include("funciones.php");

if(!isset($_SESSION['usuario'])){
    header("location: index.php");
}

if(isset($_GET['id'])){
	$idPublicacion = $_GET['id'];
}
?>

  	<div class="col-sm-6">
  	<div class="row">
	
	<div class="text-center"><h3>Ofertas de <?php echo obtenerPublicacion($idPublicacion)['titulo']; ?>!</h3></div>
	<table class="table table-hover">
    <thead>
      <tr>
        <th>Motivo</th>
        <th>Fecha</th>
		<th>Accion</th>	
      </tr>
    </thead>
    <tbody>
		<?php
			$rows = obtenerOfertasDePublicacion($idPublicacion);
			if (count($rows)>0){
				for ($i=0; $i < count($rows); $i++) { 
					$idOferta = $rows[$i]['idOferta'];
					$posibleGanadora = $rows[$i]['posibleGanadora'];
					echo "<tr>";
					echo "<td>".$rows[$i]['motivo']."</td>";
					echo "<td>".$rows[$i]['fechaRealizacion']."</td>";
					echo "<td>";
					if($posibleGanadora == 0){
						echo "<a href='calificar_oferta.php?id=$idOferta&calif=1' data-toggle='tooltip' title='Elegir como posible oferta ganadora!'><span class='glyphicon glyphicon-thumbs-up' style='color:grey'></span></a> ";
						echo " <a href='calificar_oferta.php?id=$idOferta&calif=-1' data-toggle='tooltip' title='Rechazar oferta'><span class='glyphicon glyphicon-thumbs-down' style='color:grey'></span></a>";
					}else if($posibleGanadora == 1){
						echo "<span data-toggle='tooltip' title='Posible ganadora!' class='glyphicon glyphicon-thumbs-up' style='color:green'></span>";
						echo " <a href='calificar_oferta.php?id=$idOferta&calif=0' data-toggle='tooltip' title='Volver a calificar'><span class='glyphicon glyphicon-repeat' style='color:grey'></span></a>";
					}else{
						echo "<span data-toggle='tooltip' title='Oferta rechazada!' class='glyphicon glyphicon-thumbs-down' style='color:red'></span>";
						echo " <a href='calificar_oferta.php?id=$idOferta&calif=0' data-toggle='tooltip' title='Volver a calificar'><span class='glyphicon glyphicon-repeat' style='color:grey'></span></a>";
					}
					echo "</td>";
					echo "</tr>";	
				}	
			}else {
				echo "<tr><td colspan=100%><div class='alert alert-danger'><p style='color: red ; text-align: center'>No hay ofertas realizadas para esta publicacion!</p></div><td></tr>";
			}
		?>
    </tbody>
  </table>
  <div class="text-center"><a href="ventas_activas.php" style="text-decoration: none"><button type="button" class="btn btn-default">Volver</button></a></div>
  </div>

</form>	
</div>
</body>
</html>