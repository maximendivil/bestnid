<?php
	session_start();
	include("header.php");
	include("cpanel_menu.php");
	include("funciones.php");

	$rows= obtenerDatosPublicacion($_GET["id"]);
	elegirOfertaGanadora($_GET["id"]);
	finalizarPublicacion($rows[0]["idPublicacion"]);
?>

<div class="col-md-10">
	<div class="col-md-2"></div>

	<div class="col-md-6">
		<div class="panel panel-danger">
			<div class="panel-heading">Publicacion : <?php echo $rows[0]["titulo"]; ?></div>
			<div class="panel-body">
				<p><label>Usuario ganador: <?php echo $rows[0]["idRegistrado"]; ?></label></p>
				<p><label>Motivo: <?php echo $rows[0]["motivo"]; ?></label></p>
				<p><label>Monto a cobrar: $ <?php echo $rows[0]["monto"]; ?></label></p>
			</div>
		</div>

	</div>

	<div class="col-md-2"></div>
</div>


<div class="col-md-12">
	<a href="indexPanel.php" style="text-decoration:none"><button class="btn btn-primary center-block">Volver</button></a>
</div>
	
