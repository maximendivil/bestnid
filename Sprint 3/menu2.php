<?php
	include("header.php");
	include("funciones.php");
?>
<div class="col-md-2">
		<ul class="nav nav-pills nav-stacked">
			<!--<li role="presentation" class="active" style="text-align:center"><a href="#">Productos</a></li>-->

			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">Productos <span class="caret"></span></a>
				<ul class="dropdown-menu">
            		<li role="presentation" style="text-align:center"><a href="agregarProducto.php">Agregar producto</a></li>
           			<li role="presentation" style="text-align:center"><a href="verProductos.php">Ver productos</a></li>
					<li role="presentation" style="text-align:center"><a href="compra.php">Agregar compra</a></li>
					<li role="presentation" style="text-align:center"><a href="verCompras.php">Compras</a></li>                        
				</ul>
       		</li>

       		<li class="dropdown">
       			<a class="dropdown-toggle" data-toggle="dropdown" href="#">Categorias <span class="caret"></span></a>
       			<ul class="dropdown-menu">
       				<li role="presentation"><a href="agregarCategoria.php">Agregar categoria</a></li>
					<li role="presentation"><a href="agregarTam.php">Agregar tamaño</a></li>
       			</ul>
       		</li>

       		<li class="dropdown">
       		<a class="dropdown-toggle" data-toggle="dropdown" href="#">Vendedores <span class="caret"></span></a>
       			<ul class="dropdown-menu">
       				<li role="presentation"><a href="agregarVendedora.php">Agregar vendedor</a></li>
  					<li role="presentation"><a href="verVendedores.php">Vendedores</a></li>
  					<li role="presentation"><a href="verEntregas.php">Entregas</a></li>
  					<li role="presentation"><a href="verRecepciones.php">Recepciones</a></li>
       			</ul>
       		</li>
  			
		</ul>
</div>