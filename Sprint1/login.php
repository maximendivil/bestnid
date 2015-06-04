<?php 

include("header.php") ;
include("modelo/login_valido.php");

if(isset($_SESSION['usuario'])){
    header("location: index.php");
}
?>
<div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true" style="position: relative">
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <a href="javascript:history.back()" style="text-decoration: none"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button></a>
          <h1 class="text-center">Iniciar sesion</h1>
      </div>
      <div class="modal-body">
          <form class="form col-md-12 center-block" action="" method="POST">
            <div class="form-group">
                <span class="advertencia"><?php echo $error; ?></span>
                <input type="email" class="form-control input-lg" placeholder="Usuario" name="usuario" value="<?php if (isset($_POST['usuario'])) echo $_POST['usuario']; ?>" required autofocus>
            </div>
            <div class="form-group">
              <input type="password" class="form-control input-lg" placeholder="Password" name="clave" required>
            </div>
            <div class="form-group">
              <button class="btn btn-primary btn-lg btn-block" type="submit" name="submit">Ingresar</button>
              <span class="pull-right"><a href="registrarse.php">Registrarse</a></span><span><a href="#">Necesitas ayuda?</a></span>
            </div>
          </form>
      </div>
      <div class="modal-footer">
          <div class="col-md-12">
          <a href="javascript:history.back()" style="text-decoration: none"><button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cancelar</button></a>
          </div>    
      </div>
  </div>
  </div>
</div>

    <!-- <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-md-offset-4">
                <h1 class="text-center login-title">Iniciar sesion</h1>
                <br>
                <div class="account-wall">
                    
                    <form class="form-signin" action="" method="POST">
					<span class="advertencia"><?php echo $error; ?></span>
                    <input type="email" class="form-control" placeholder="Usuario" name="usuario" value="<?php if (isset($_POST['usuario'])) echo $_POST['usuario']; ?>" required autofocus>
                    <input type="password" class="form-control" placeholder="Password" name="clave" required>
                    <br>
                    <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Ingresar</button>
					
                    </form>
                </div>
            </div>
        </div>
    </div> -->
</body>
</html>