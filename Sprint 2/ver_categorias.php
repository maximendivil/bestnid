<div class="col-md-2">
    <div class="list-group col-md-8">
        <?php
            $categorias = consultarCategorias();
            for ($i=0; $i < count($categorias) ; $i++) { 
                echo "<a href='buscar_por_categoria.php?nombre=".$categorias[$i][0]."' class='list-group-item'>".$categorias[$i][0]."</a>";
            }
        ?>
    </div>
</div>