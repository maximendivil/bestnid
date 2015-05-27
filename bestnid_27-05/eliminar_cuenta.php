<?php 
session_start();
include("header.php") ; 
include("cpanel_menu.php");

if(!isset($_SESSION['usuario'])){
    header("location: index.php");
}
?>

<div>
    
    <div class="container" style="margin-left: 15%">
    	<div class="row">
		    <h4 style="align-text: center ; margin-left: 50%">¿Estás seguro que deseas eliminar tu cuenta?</h4>
		    <br>
		    <a href="eliminar_registrado_db.php?email=<?php echo $_SESSION['usuario'];?>" style="text-decoration: none"><button class="btn btn-lg btn-warning center-block" style="padding-left: 5% ; padding-right: 4% ; margin-left: 58%">Eliminar</button></a>		    
		    <br>
		    <a href="javascript:history.back()" style="text-decoration: none"> <button class="btn btn-lg btn-warning center-block" style="padding-left: 5% ; padding-right: 5% ; margin-left: 58%">Volver</button></a>
		</div>
    </div>
    
</div>

<div class="clearfix visible-lg"></div>
	
</div>
</div>
</body>
</html>