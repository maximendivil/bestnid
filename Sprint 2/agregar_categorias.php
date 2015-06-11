<?php
	session_start();
	include("header.php");
	include("funciones.php");
	include("cpanel_menu.php");
	include("ver_categorias.php");

	$categoria = "";

?>

<div class="col-md-8">
	<form class="form-horizontal col-md-4" method="POST" action="crear_categoria.php">
		<div class="form-group">
			<label class="col-lg-2 control-label" for="nombre">Nombre: </label>
			<div class="col-lg-10">
				<input type="text" name="nombreCategoria" class="form-control" placeholder="Ingrese el nombre de la categoria">
			</div>
		</div>
		<br>
		<button type="submit" class="btn btn-md btn-primary center-block">Enviar</button>
		<?php
			echo "<br>";
			echo $_SESSION["exito"];	
			$_SESSION["exito"] = "";
		?>
	</form>
	
</div>