
<div class="col-md-2">
    <div class="list-group col-md-8">
        <?php
            $categorias = consultarCategorias();
            for ($i=0; $i < count($categorias) ; $i++) { 
                echo "<a href='buscar_por_categoria.php?nombre=".$categorias[$i][0]."&pagina=' class='list-group-item'>".$categorias[$i][0]."</a>";
            }
            echo "<a href='mostrar_publicaciones.php?pagina' class='list-group-item' style='border-color: red; color: red'>Todas</a>";
        ?>
    </div>
</div>