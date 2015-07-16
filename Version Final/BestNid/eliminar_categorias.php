<?php
		//session_start();
	//include("header.php");
	//include("funciones.php");
	include("cpanel_menu.php");
	//include("ver_categorias.php");

?>
<div class="col-md-2">
</div>
<div class="col-md-8">
	<form class="form-horizontal col-md-4" method="POST" action="borrar_categoria.php">
		<div class="form-group">
			<label class="col-lg-3 control-label" for="nombre">Categorias: </label>
			<div class="col-lg-9">
				<select class="form-control" name="categoria">
					<option value="vacio" selected>Elige una categoria</option>
					<?php
						$categorias = consultarCategorias();
			            for ($i=0; $i < count($categorias) ; $i++) { 
			                echo "<option value='".$categorias[$i][0]."'>".$categorias[$i][0]."</a>";
			            }
					?>
				</select>				
			</div>
		</div>
		<br>
		<button type="submit" class="btn btn-md btn-primary center-block">Eliminar</button>
		<?php
			echo "<br>";
			echo $_SESSION["exito"];	
			$_SESSION["exito"] = "";
		?>
	</form>
	
</div>