<?php 

include("header.php") ;
include("modelo/login_valido.php");

if(isset($_SESSION['usuario'])){
    header("location: index.php");
}
?>
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-md-offset-4">
                <h1 class="text-center login-title" style="color: #ec971f">Iniciar sesion</h1>
                <br>
                <div class="account-wall">
                    
                    <form class="form-signin" action="" method="POST">
					<span class="advertencia"><?php echo $error; ?></span>
                    <input type="email" class="form-control" placeholder="Usuario" name="usuario" value="<?php if (isset($_POST['usuario'])) echo $_POST['usuario']; ?>" required autofocus>
                    <input type="password" class="form-control" placeholder="Password" name="clave" required>
                    <br>
                    <button class="btn btn-lg btn-warning btn-block" type="submit" name="submit">Ingresar</button>
					
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>