<?php 
session_start();
include("header.php") ; 
include("cpanel_menu.php");

if(!isset($_SESSION['usuario'])){
    header("location: index.php");
}
?>

<div>
    
    <div class="container">
    	<div class="row">
		    <h3 style="align-text: center">¿Estás seguro que deseas eliminar tu cuenta?</h3>
		    <a href="eliminar_registrado_db.php" style="text-decoration: none"><button class="btn btn-lg btn-warning center-block" style="padding-left: 5% ; padding-right: 5% ; float: left ; margin-right: 20px">Eliminar</button></a>
		    <a href="javascript:history.back()" style="text-decoration: none"> <button class="btn btn-lg btn-warning center-block" style="padding-left: 5% ; padding-right: 5% ; float: left">Volver</button></a>
		</div>
    </div>
    
</div>

<div class="clearfix visible-lg"></div>
	
</div>
</div>
</body>
</html>