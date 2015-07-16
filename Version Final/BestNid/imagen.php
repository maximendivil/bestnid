<html>
<body>
<h2>Listado de las imagenes añadidas a la base de datos</h2>
<div class="listadoImagenes">
    <?php
    require("database.php");

    $link = Database::connect();
    $result=mysqli_query($link,"SELECT * FROM imagen");
    if($result)
    {
        while($row=mysqli_fetch_array($result))
        {
            echo "<img src='imagen_mostrar.php?id=".$row["idImagen"]."' width='".$row["ancho"]."' height='".$row["alto"]."'>";
        }
    }
    ?>
</div>
</body>
</html>

