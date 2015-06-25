<?php
	include("header.php");
	session_start();
	include("funciones.php");
?>

<div class="col-md-3">
</div>
<div class="col-md-6">
<?php
	$email = $_GET['email'];
	if( (($_SESSION['tipouser'] == 0) && ($email == $_SESSION['usuario'])) || ($_SESSION['tipouser'] == 1) ){
            $tienePublicaciones = cantidadPublicacionesRegistrado($email);
            if ($tienePublicaciones){
            	echo "<div class='alert alert-danger'><p style='color: red ; text-align: center'>La cuenta no puede ser eliminada porque posee publicaciones activas!</p></div>";
            	header("refresh: 3 ; url = eliminar_cuenta.php");
            }
            else {
            	eliminarUsuario($email);
            	echo "<div class='alert alert-success'><p style='color: green ; text-align: center'>La cuenta ha sido eliminada exitosamente!</p></div>";
            	if($_SESSION['usuario'] == $email){
					 header("refresh: 3 ; url = logout.php");
				}
				else if($_SESSION['tipouser'] == 1){
					header("refresh: 0.1 ; url = indexPanel.php"); 
				}
				else{
					header("Location: index.php");
				}
            }           
         
		 
	}
	

?>
</div>
<div class="col-md-3">
</div>