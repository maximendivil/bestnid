<?php
	session_start();
	include("header.php");
	include("cpanel_menu.php");
	include("funciones.php");

	$cantOfertas = cantidadDeOfertas($_GET["id"]);
	if ($cantOfertas == 0){
		finalizarPublicacion($_GET["id"]);
		echo "<div class='col-md-10'><div class='alert alert-success'><p style='text-align:center'>La publicacion finalizó sin recibir ofertas</p></div></div>";
		header("refresh: 2 ; url=ventas_activas.php");
	}
	else{
		$titulo = obtenerPublicacion($_GET["id"]);		
		$posiblesGanadoras = posiblesGanadoras($_GET["id"]);

		echo "<div class='col-md-10'>";
		echo "<div class='text-center'><h3>Ofertas de ".$titulo['titulo']."</h3></div>";
		echo "<table class='table table-hover'>";
		echo "<thead>";
		echo "<tr>";
		echo "<th>Motivo</th>";
		echo "<th>Fecha</th>";
		echo "<th>Accion</th>";
		echo "</tr>";
		echo "</thead>";
		echo "<tbody>";
		if ($posiblesGanadoras == 0){
			$rows = obtenerOfertasDePublicacion($_GET["id"]);
			for($i=0; $i < count($rows); $i++){
				echo "<tr>";
				echo "<td>".$rows[$i]['motivo']."</td>";
				echo "<td>".$rows[$i]['fechaRealizacion']."</td>";
				echo "<td><a href='elegir_ganadora.php?id=".$rows[$i]["idOferta"]."' title='Elegir como ganadora'><span class='glyphicon glyphicon-ok'></span></a></td>";
				echo "</tr>";
			}
						
		}
		else {
			$rows = obtenerPosiblesGanadoras($_GET["id"]);
			for($i=0; $i < count($rows); $i++){
				echo "<tr>";
				echo "<td>".$rows[$i]['motivo']."</td>";
				echo "<td>".$rows[$i]['fechaRealizacion']."</td>";
				echo "<td><span data-toggle='tooltip' title='Posible ganadora!' class='glyphicon glyphicon-thumbs-up' style='color:green'></span> ";
				echo "<a href='elegir_ganadora.php?id=".$rows[$i]["idOferta"]."' title='Elegir como ganadora'><span class='glyphicon glyphicon-ok'></span></a></td>";
				echo "</tr>";
			}
		}
		echo "</tbody>";
		echo "</table>";
		echo "</div>";
	}
?>

