<?php
  session_start();
  include("header.php");
  include("funciones.php");

  $formValid = 1;
  $tituloErr = $descripcionErr = $categoriaErr = $imagenErr = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $titulo = test_input($_POST["titulo"]);
    if (!preg_match("/^[a-zA-Z0-9! ]*$/",$titulo)) {
      $formValid = 0;
      $tituloErr = "Solo se permiten letras y espacios"; 
    }

    $descripcion = test_input($_POST["descripcion"]);
    if (!preg_match("/^[a-zA-Z0-9,.!() ]*$/",$descripcion)) {
      $formValid = 0;
      $descripcionErr = "Solo se permiten letras, numeros, espacios, y signos(!,.)"; 
    }

    if (($_FILES["imagen"]["size"] == 0)&($_FILES["imagen2"]["size"] == 0)&($_FILES["imagen3"]["size"]==0)){
      $formValid = 0;
      $imagenErr = "Debes seleccionar al menos una imagen para mostrar el producto";
    }

    if ($_FILES["imagen"]["size"] > 0){
        $info =getimagesize($_FILES["imagen"]["tmp_name"]);
        $ancho = $info[0];
        $alto = $info[1];
        if (!(($_FILES["imagen"]["type"] == "image/png")or($_FILES["imagen"]["type"] == "image/jpeg")or($_FILES["imagen"]["type"]=="gif"))){
          $formValid = 0;
          $imagenErr = "Formato invalido. Solo se permiten imagenes con extension: .png, .jpg o .gif";
        }
        elseif(($ancho > 1920)or($alto>1080)){
          $formValid = 0;
          $imagenErr = "La resolucion de la imagen excede el maximo. Resolucion maxima permitida: 1920x1080";
        }
    }
    
    if ($_FILES["imagen2"]["size"] > 0){
      $info =getimagesize($_FILES["imagen2"]["tmp_name"]);
      $ancho = $info[0];
      $alto = $info[1];
      if (!(($_FILES["imagen2"]["type"] == "image/png")or($_FILES["imagen2"]["type"] == "image/jpeg")or($_FILES["imagen2"]["type"]=="gif"))){
        $formValid = 0;
        $imagenErr = "Formato invalido. Solo se permiten imagenes con extension: .png, .jpg o .gif";
      }
      elseif(($ancho > 1920)or($alto>1080)){
          $formValid = 0;
          $imagenErr = "La resolucion de la imagen excede el maximo. Resolucion maxima permitida: 1920x1080";
      }
    }

    if ($_FILES["imagen3"]["size"] > 0) {
        $info =getimagesize($_FILES["imagen3"]["tmp_name"]);
        $ancho = $info[0];
        $alto = $info[1];
        if (!(($_FILES["imagen3"]["type"] == "image/png")or($_FILES["imagen3"]["type"] == "image/jpeg")or($_FILES["imagen3"]["type"]=="gif"))){
          $formValid = 0;
          $imagenErr = "Formato invalido. Solo se permiten imagenes con extension: .png, .jpg o .gif";
        }
        elseif(($ancho > 1920)or($alto>1080)){
          $formValid = 0;
          $imagenErr = "La resolucion de la imagen excede el maximo. Resolucion maxima permitida: 1920x1080";
        }
    }


    if($formValid){

      $nombreCategoria = $_POST["categoria"];
      $id_categoria = consultarCategoria($nombreCategoria);
      $user = $_SESSION["usuario"];
      $idPublicacion = cargarPublicacion($titulo,$descripcion,$id_categoria,$user);
      
      cargarImagenes($_FILES["imagen"],$_FILES["imagen2"],$_FILES["imagen3"],$idPublicacion);
      //echo "<script language='javascript'> alert('Su publicacion se ha realizado exitosamente!'); </script>";
      header("Location: publicacionExitosa.php");
      //header("refresh: 0.1 ; url = index.php");
    }
    

  }
?>

<div class="container">
  <div class="row">
    <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="<?php echo $_SERVER["PHP_SELF"];?>">
      <fieldset>
        <legend>Crear publicacion</legend>        
        <div class="form-group">
          <label for="titulo" class="col-lg-2 control-label">Titulo *</label>
          <div class="col-lg-10">
            <input type="text" class="form-control" name="titulo" placeholder="Ingrese un titulo"  value="<?php if (isset($_POST['titulo'])) echo $_POST['titulo']; ?>" required autofocus>
            <span class="advertencia"><?php echo $tituloErr;?></span>
          </div>
        </div>
        <div class="form-group">
          <label for="categoria" class="col-lg-2 control-label">Categoria</label>
          <div class="col-lg-10">
            <select class="form-control" name="categoria" required>
          <option value="" selected="selected">Elige una categoria</option>
          <?php
            $categorias = consultarCategorias();
                  for ($i=0; $i < count($categorias) ; $i++) { 
                      echo "<option value='".$categorias[$i][0]."'>".$categorias[$i][0]."</a>";
                  }
          ?>
          </select>
          </div>
        </div>
        <div class="form-group">          
          <label for="imagenes" class="col-lg-2 control-label">Imagenes</label>
          <div class="col-lg-10">
            <span class="advertencia"><?php echo $imagenErr;?></span>
            <input name="imagen" type="file">
            <input name="imagen2" type="file">
            <input name="imagen3" type="file">
            <span class="help-block">Resolucion maxima permitida: 1920x1080</span>
          </div>
        </div>
        <div class="form-group">
          <label for="descripcion" class="col-lg-2 control-label">Descripcion *</label>
          <div class="col-lg-10">
            <textarea class="form-control" rows="6" name="descripcion"><?php if (isset($_POST['descripcion'])) echo $_POST['descripcion']; ?></textarea>
            <span class="help-block">Ingrese una descripcion de acuerdo a las caracteristicas del producto</span>
            <span class="advertencia"><?php echo $descripcionErr;?></span>
          </div>
        </div>
        
        <div class="form-group">
          <div class="col-lg-10 col-lg-offset-2">
            <a href="javascript:history.back()" style="text-decoration: none"><button type="button" class="btn btn-default">Cancelar</button></a>
            <button type="submit" class="btn btn-primary">Enviar</button>
          </div>
        </div>
      </fieldset>
    </form>
  </div>
</div>