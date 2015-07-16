<?php
	/*session_start();
	include("header.php");*/
	include("cpanel_menu.php");
	//include("funciones.php");
	

	$rows = obtenerOfertasRealizadas($_SESSION["usuario"]);
?>

<div class="col-md-8">
	<table class="table table-hover">
		<thead>
	    	<tr>
	    		<th class="col-sm-4">Publicacion</th>
		        <th class="col-sm-6">Motivo</th>
		        <th class="col-sm-1">Fecha</th>
				<th class="col-sm-1">Accion</th>	
	      	</tr>
    	</thead>
    	<tbody>	
    		<?php	
    			if (count($rows)>0){

    				for($i=0; $i < count($rows); $i++){
    					echo "<tr>";
    					echo "<td>".$rows[$i]["titulo"]."</td>";
    					echo "<td>".$rows[$i]["motivo"]."</td>";
    					echo "<td>".$rows[$i]["fechaRealizacion"]."</td>";
                        if ($rows[$i]["ganadora"]==1){
                            echo "<td><p style='color: red'>GANADORA</p></td>";
                            verOferta($rows[$i]["idOferta"]);
                        }
                        else {
                            echo "<td><a href='publicacion.php?id=".$rows[$i]["numeroPublicacion"]."' title='Ver publicacion'><span class='glyphicon glyphicon-search'></span></a></td>";
                        }    					
    					echo "</tr>";
    				}
    				echo "</table>";
    			}
    			else{
    				echo "</table>";
    				echo "<div class='alert alert-danger'><p style='text-align:center'>No realizaste ninguna oferta</p></div>";
    			}
    		?>
</div>


<div class="col-md-2">
</div>

