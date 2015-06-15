<?php 
    session_start();
    include("header.php");
    include("funciones.php");
    include("ver_categorias.php");
	
	if(isset($_GET['id'])){
		$rows = obtenerPublicacion($_GET['id']);
		if (count($rows)>0){
					$idPublicacion = $_GET['id'];
					$idImagen = buscarImagenPublicacion($_GET['id']);
					$titulo = $rows['titulo'];
					$descripcion = $rows['descripcion'];
					$fechaCreacion = $rows['fechaCreacion'];
					$fechaFinalizacion = $rows['fechaFinalizacion'];
					$usuario = $rows['usuario'];
		}
	}
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$comentario = $_POST['comentario'];
		$usuario = $_SESSION['usuario'];
		$publicacion = $_GET['id'];
		insertarComentario($publicacion,$usuario,$comentario);
	}
?>

<body>

<div class="container col-md-8">

        
<div class="col-md-12">
                <div class="thumbnail">
					<div id="carousel-example-generic" class="carousel slide">
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="item active">
                                    <img class="slide-image" src="imagen_mostrar.php?id=<?php echo $idImagen; ?>" alt="">
                                </div>
                                <div class="item">
                                    <img class="slide-image" src="subastas.jpg" alt="">
                                </div>
                                <div class="item">
                                    <img class="slide-image" src="tarjetas.jpg" alt="">
                                </div>
                            </div>
                            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                            </a>
                        </div>
                    <div class="caption-full">
                        <p class="pull-right">Finaliza en <?php echo diasRestantes($fechaFinalizacion); ?> dias</p>
                        <h3><?php echo $titulo; ?></h3>
                        <p><?php echo $descripcion; ?></p>
						<?php
							if(isset($_SESSION['usuario'])){
								if($_SESSION['usuario'] != $usuario){
									$rows = verificarOfertaRealizada($idPublicacion, $_SESSION['usuario']);
									if(count($rows) == 0){
										echo "<div class='text-center'><a class='btn btn-success' href='ofertar.php?idPublicacion=$idPublicacion'>OFERTAR!</a></div>";
									}else{
										echo "<div class='text-center'><div class='alert alert-info'><p style='color: grey ; text-align: center'>Ya ofertaste en esta publicacion... Mucha suerte!</div></div>";
									}
								}else{
									echo "<div class='text-center'><a class='btn btn-success' href='ofertar.php?idPublicacion=$idPublicacion' disabled>OFERTAR!</a></div>";
								}
							}else{
								echo "<div class='text-center'><div class='alert alert-info'><p style='color: grey ; text-align: center'>Queres realizar una oferta o pregunta? <a href='registrarse.php'>Registrate</a> o <a href='login.php'>Inicia sesion</a></p></div></div>";
							}
						?>
                    </div>
                </div>
				 <?php
			    	echo "<br>";
			    	echo $_SESSION["exito"];
			    	$_SESSION["exito"] = "";
			    ?>
                <div class="well">

                    <div class="text-right">
                        <a class="btn btn-success" <?php if(!isset($_SESSION['usuario'])){ echo 'disabled';} ?> data-toggle="popover" title="Realizar pregunta" data-placement="left" data-html="true" 
						data-content="<form class='form-inline' method='POST' action='<?php echo $_SERVER["PHP_SELF"]; echo '?id='.$_GET['id'].'';?>'><input type='text' name='comentario' style='width: 500px' placeholder='Escriba aqui su pregunta...' class='form-control'>
						<button class='btn btn-default' type='submit' style='margin-left:5px'>Preguntar!</button></form>">Hacer una pregunta</a>
                    </div>
					
					<script>
					$(document).ready(function(){
						$('[data-toggle="popover"]').popover();   
					});
					
					$("#doc-upload-btn").tooltip();
					</script>

                    <hr>
					
					<?php
						$rows = obtenerComentarios($_GET['id']);
						if(count($rows)>0){
							for ($i=0; $i < count($rows); $i++){								
								$idComentario = $rows[$i]['idComentario'];
								$dueñoPublicacion = usuarioCreadorPublicacion($idComentario);
								if($dueñoPublicacion == $rows[$i]["idRegistrado"]){
									echo "<div class='row'>";
									echo "<div class='col-md-6' style='float: right ; border: 1px solid green ; border-radius: 15px'>";
									echo $rows[$i]['idRegistrado'];
									echo "<span class='pull-right'>".$rows[$i]['fecha']."";
									if ( (isset($_SESSION['usuario'])) AND($_SESSION['tipouser'] == 1) ){
										echo " <a href='eliminar_comentario.php?id=$idComentario' data-toggle='tooltip' title='Eliminar comentario'><span class='glyphicon glyphicon-remove'></span></a>";
									}
									echo "</span>";
									echo "<p>".$rows[$i]['contenido']."</p>";
									echo "</div></div><hr>";
								}
								else {
									echo "<div class='row'>";
									echo "<div class='col-md-6' style='float: left ; border: 1px solid red ; border-radius: 15px'>";
									echo $rows[$i]['idRegistrado'];
									echo "<span class='pull-right'>".$rows[$i]['fecha']."";
									if ( (isset($_SESSION['usuario'])) AND($_SESSION['tipouser'] == 1) ){
										echo " <a href='eliminar_comentario.php?id=$idComentario' data-toggle='tooltip' title='Eliminar comentario'><span class='glyphicon glyphicon-remove'></span></a>";
									}
									echo "</span>";
									echo "<p>".$rows[$i]['contenido']."</p>";
									echo "</div></div><hr>";
								}
							}
						}else{
							echo "<div class='row'>";
								echo "<div class='col-md-12'>";
								if(!isset($_SESSION['usuario'])){
									echo "<div class='alert alert-info'><p style='color: grey ; text-align: center'>Queres hacer una pregunta? <a href='registrarse.php'>Registrate</a> o <a href='login.php'>Inicia sesion</a></p></div>";
								}
								echo "<div class='alert alert-info'><p style='color: grey ; text-align: center'>Todavia no hicieron ninguna pregunta!</p></div>";
								echo "</div></div><hr>";
						}
					?>
                   

                </div>

            </div></div>
            <div class="col-md-2">
            </div>
    <!-- /.container -->

    
    <?php
    	include("footer.php");
    ?>
    <!-- /.container -->

