<?php 
    session_start();
    include("header.php");
    include("funciones.php");
    include("ver_categorias.php")
?>

<body>

<div class="container col-md-8">

        <div class="row">
                <div class="row carousel-holder">

                    <div class="col-md-12">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="item active">
                                    <img class="slide-image" src="carrito.jpg" alt="">
                                    <div class="carousel-caption">
                                    	<h1>Bestnid</h1>
                                    	<p>El sitio donde el corazon le gana al dinero</p>
                                    </div>
                                </div>
                                <div class="item">
                                    <img class="slide-image" src="subastas.jpg" alt="">
                                    <div class="carousel-caption">
                                        <h1>Oferta sin miedos, podes ganar</h1>
                                        <p>El dinero no es importante, queremos saber tu necesidad. Puede bastar para ser la ganadora</p>
                                    </div>
                                </div>
                                <div class="item">
                                    <img class="slide-image" src="tarjetas.jpg" alt="">
                                    <div class="carousel-caption">
                                        <h1>Es fácil, pagas desde tu casa</h1>
                                        <p>Si tu motivo es suficiente, nosotros nos ponemos en contacto con tu proveedor de tarjetas</p>
                                    </div>
                                </div>
                            </div>
                            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                            </a>
                        </div>
                    </div>

                </div>
                <div class="row">
                <?php
                    $resultado = publicacionesIndex();

                    if (count($resultado)>0){
                        for ($i=0; $i < count($resultado); $i++) {          
                            $idPublicacion = $resultado[$i]["numeroPublicacion"];
                            echo "<div class='col-sm-8 col-lg-4 col-md-4'>";
                            echo "<div class='thumbnail'>";
                            $idImagen = buscarImagenPublicacion($idPublicacion);
                            echo "<a href='publicacion.php?id=$idPublicacion'><img src='imagen_mostrar.php?id=".$idImagen."' style='width:250 ; height:250'/></a>";
                            echo "<div class='caption'>";
                            echo "<h4><a href='publicacion.php?id=$idPublicacion'>".$resultado[$i]["titulo"]."</a></h4>";
                            echo "<p>".$resultado[$i]["descripcion"]."</p>";
                            echo "</div>";
                            echo "<div class='ratings'>";
                            echo "<p><a href='publicacion.php?id=$idPublicacion' type='button' class='btn btn-primary center-block' style='margin-left: 100px; margin-right: 100px; margin-top: -25px'>Ver publicacion</a></p>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                        }
                    }
                    else {
                        echo "<div class='alert alert-danger'><p style='text-align: center'>No se han encontrado publicaciones. </p></div>";
                    }
                ?>
                </div>

                <!--
                

                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <img src="http://placehold.it/320x150" alt="">
                            <div class="caption">
                                <h4><a href="#">Titulo</a></h4>
                                <p>Aqui aparecera la descripcion de cada producto</p>
                            </div>
                            <div class="ratings">
	                            <p>
	                                <a href="#" type="button" class="btn btn-primary center-block" style="margin-left: 100px; margin-right: 100px; margin-top: -25px">Ver publicacion</a>                                
	                            </p>
	                        </div>
                        </div>
                    </div>

                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <img src="http://placehold.it/320x150" alt="">
                            <div class="caption">
                                <h4><a href="#">Titulo</a></h4>
                                <p>Aqui aparecera la descripcion de cada producto</p>
                            </div>
                            <div class="ratings">
	                            <p>
	                                <a href="#" type="button" class="btn btn-primary center-block" style="margin-left: 100px; margin-right: 100px; margin-top: -25px">Ver publicacion</a>                                
	                            </p>
	                        </div>
                        </div>
                    </div>

                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <img src="http://placehold.it/320x150" alt="">
                            <div class="caption">
                                <h4><a href="#">Titulo</a></h4>
                                <p>Aqui aparecera la descripcion de cada producto</p>
                            </div>
                            <div class="ratings">
	                            <p>
	                                <a href="#" type="button" class="btn btn-primary center-block" style="margin-left: 100px; margin-right: 100px; margin-top: -25px">Ver publicacion</a>                                
	                            </p>
	                        </div>
                        </div>
                    </div>

                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <img src="http://placehold.it/320x150" alt="">
                            <div class="caption">
                                <h4><a href="#">Titulo</a></h4>
                                <p>Aqui aparecera la descripcion de cada producto</p>
                            </div>
                            <div class="ratings">
	                            <p>
	                                <a href="#" type="button" class="btn btn-primary center-block" style="margin-left: 100px; margin-right: 100px; margin-top: -25px">Ver publicacion</a>                                
	                            </p>
	                        </div>
                        </div>
                    </div>

                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <img src="http://placehold.it/320x150" alt="">
                            <div class="caption">
                                <h4><a href="#">Titulo</a></h4>
                                <p>Aqui aparecera la descripcion de cada producto</p>
                            </div>
                            <div class="ratings">
	                            <p>
	                                <a href="#" type="button" class="btn btn-primary center-block" style="margin-left: 100px; margin-right: 100px; margin-top: -25px">Ver publicacion</a>                                
	                            </p>
	                        </div>
                        </div>
                    </div>

                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <img src="http://placehold.it/320x150" alt="">
                            <div class="caption">
                                <h4><a href="#">Titulo</a></h4>
                                <p>Aqui aparecera la descripcion de cada producto</p>
                            </div>
                            <div class="ratings">
	                            <p>
	                                <a href="#" type="button" class="btn btn-primary center-block" style="margin-left: 100px; margin-right: 100px; margin-top: -25px">Ver publicacion</a>                                
	                            </p>
	                        </div>
                        </div>
                    </div>

                    -->

                    <!-- <div class="col-sm-4 col-lg-4 col-md-4">
                        <h4><a href="#">Like this template?</a>
                        </h4>
                        <p>If you like this template, then check out <a target="_blank" href="http://maxoffsky.com/code-blog/laravel-shop-tutorial-1-building-a-review-system/">this tutorial</a> on how to build a working review system for your online store!</p>
                        <a class="btn btn-primary" target="_blank" href="http://maxoffsky.com/code-blog/laravel-shop-tutorial-1-building-a-review-system/">View Tutorial</a>
                    </div> -->

                </div>

            </div>

        </div>

    </div>
    <!-- /.container -->

    
    <?php
    	include("footer.php");
    ?>
    <!-- /.container -->

