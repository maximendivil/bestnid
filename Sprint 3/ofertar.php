<?php
	session_start();
	include("funciones.php");
	include("header.php");
	include("ver_categorias.php");

	$idPublicacion = $_GET["idPublicacion"];
	$usuario = $_SESSION["usuario"];

	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		agregarOferta($idPublicacion,$usuario,$_POST["monto"],$_POST["motivo"]);
		$_SESSION["exito"] = "<div class='alert alert-success'><p style='color: green ; text-align: center'>La oferta se realizo exitosamente!</p></div>";
		header("refresh: 0.1 ; url=publicacion.php?id=".$idPublicacion."");
	}
?>

<div class="container col-md-10">
	<div class="row">
		<div class="col-md-2">
		</div>
		<form class="form-horizontal col-md-10" method="POST" action="<?php echo $_SERVER["PHP_SELF"];echo '?idPublicacion='.$_GET['idPublicacion'].'';?>">
			<div class="form-group">
				<label class="col-lg-1 control-label">Monto :</label>
				<div class="col-md-6">				
					<input class="form-control" name="monto" type="number" required>
					<span class="help-block">Ingrese un monto por el cual está dispuesto a pagar el producto en el caso de que su motivo sea el ganador!</span>
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-1 control-label">Motivo :</label>
				<div class="col-md-6">
					<textarea class="form-control" rows="6" name="motivo" required></textarea>
					<span class="help-block">Ingrese el motivo por el cual desea obtener el producto!</span>
				</div>
			</div>

			<div class="form-group">
	          <div class="col-lg-10 col-lg-offset-3">
	            <a href="javascript:history.back()" style="text-decoration: none"><button type="button" class="btn btn-default">Cancelar</button></a>
	            <button type="submit" class="btn btn-primary">Enviar</button>	            
	          </div>
	        </div>

	    </form>
	    
	</div>
</div>