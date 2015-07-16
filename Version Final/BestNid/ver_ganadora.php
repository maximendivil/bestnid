<?php
		//session_start();
	//include("header.php");
	//include("funciones.php");
	include("cpanel_menu.php");
	//include("ver_categorias.php");

	$rows= obtenerDatosGanador($_GET["id"]);
	
	if (count($rows)>0){

		echo '<div class="col-md-10">';
		echo '<div class="col-md-2"></div>';

		echo '<div class="col-md-6">';
		echo '<div class="panel panel-danger">';
		echo '<div class="panel-heading">Publicacion: '.$rows[0]["titulo"].'</div>';
		echo '<div class="panel-body">';
		echo '<p><label>Usuario ganador: '.$rows[0]["idRegistrado"].'</label></p>';
		echo '<p><label>Motivo: '.$rows[0]["motivo"].'</label></p>';
		echo '<p><label>Monto a cobrar: $ '.$rows[0]["monto"].'</label></p>';
		echo '</div>';
		echo '</div>';
		echo '</div>';

		echo '<div class="col-md-2"></div>';
		echo '</div>';

	}

	else {
		echo "<div class='col-md-10'>";
		echo "<div class='col-md-2'></div>";
		echo "<div class='col-md-6'><div class='alert alert-danger'><p style='text-align:center'>La publicación finalizó sin ofertas!</p></div></div>";
		echo "</div>";	
	}


	

?>

<div class="col-md-12">
	<a href="indexPanel.php" style="text-decoration:none"><button class="btn btn-primary center-block">Volver</button></a>
</div>