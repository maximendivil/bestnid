<?php
  session_start();
  include("header.php");
  include("funciones.php");

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $titulo = $_POST["titulo"];
    $descripcion = $_POST["descripcion"];
    //$categoria = $_POST["categoria"];
    //$id_categoria = consultarCategoria($categoria);
    $user = $_SESSION["usuario"];
    cargarPublicacion($titulo,$descripcion,1,$user);
    echo "<script language='javascript'> alert('Su publicacion se ha realizado exitosamente!'); </script>";
    header("refresh: 0.1 ; url = index.php");

  }
?>

<div class="container">
  <div class="row">
    <form class="form-horizontal" method="POST" action="<?php echo $_SERVER["PHP_SELF"];?>">
      <fieldset>
        <legend>Crear publicacion</legend>        
        <div class="form-group">
          <label for="titulo" class="col-lg-2 control-label">Titulo *</label>
          <div class="col-lg-10">
            <input type="text" class="form-control" name="titulo" placeholder="Ingrese un titulo" required autofocus>
          </div>
        </div>
        <div class="form-group">
          <label for="categoria" class="col-lg-2 control-label">Categoria</label>
          <div class="col-lg-10">
            <select class="form-control" name="categoria">
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
            </select>
          </div>
        </div>
        <div class="form-group">          
          <label for="imagenes" class="col-lg-2 control-label">Imagenes</label>
          <div class="col-lg-10">
            <input name="imagen" type="file" multiple="true" class="file">
              <script>$("#imagen").fileinput({
                initialPreview: [
                  "<img src='fondo.jpg' class='file-preview-image' alt='The Earth' title='The Earth'>",
                ],
                language: "es";
                overwriteInitial: false,
                maxFileSize: 1024,
                allowedFileExtensions: ["jpg", "png", "gif"]
              });
              </script>
          </div>
        </div>
        <div class="form-group">
          <label for="descripcion" class="col-lg-2 control-label">Descripcion *</label>
          <div class="col-lg-10">
            <textarea class="form-control" rows="6" name="descripcion"></textarea>
            <span class="help-block">Ingrese una descripcion de acuerdo a las caracteristicas del producto ingresado</span>
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