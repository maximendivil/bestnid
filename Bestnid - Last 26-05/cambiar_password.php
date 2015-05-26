<?php 
session_start();
include("header.php") ; 
include("cpanel_menu.php");

if(!isset($_SESSION['usuario'])){
    header("location: index.php");
}

$passErr = $pass = "";
// OBTENGO LOS DATOS PERSONALES DEL USUARIO

$connection = mysql_connect("localhost", "root", "");
$db = mysql_select_db("bestnid", $connection);

$user = $_SESSION['usuario'];
$query = mysql_query("select * from usuario where email='$user'", $connection);
$rows = mysql_num_rows($query);

	
while ($rows = mysql_fetch_assoc($query)) {
	$pass_actual = $rows['password'];
}

mysql_close($connection);

//---------------------------------//
	
$formValid = 1; 
       
        // define variables and set to empty values
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if(!($_POST["password1"] == $_POST["password2"])){
                    $formValid = 0;
                    $passErr = "Las contraseñas no coinciden, por favor ingresarlas nuevamente";
                }
            else {
                $pass = test_input($_POST["password1"]);
                if (!preg_match("/^[a-zA-Z0-9]*$/",$pass)) {
                    $formValid = 0;
                    $passErr = "Solo se permiten letras y números";  
                }
            }


            if($_POST['password_actual'] != $pass_actual) {
                $formValid = 0;
                $passErr = "La contraseña actual es incorrecta.";
            } 
            if ($formValid) {
                    $_SESSION["password"] = $_POST["password1"];     
                    header("location: cambiar_password_db.php");                    
            }
        }

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

 ?>
    <div class="container">
        <div class="row">
            <form class="form-horizontal" style="padding-top: 2em" method="POST" action="<?php echo $_SERVER["PHP_SELF"];?>">
                <fieldset>

                    <!-- Form Name -->
                    <legend>Cambiar contraseña</legend>

                 <!-- Password input-->
                 <div class="form-group">
                    <label class="col-md-4 control-label" for="password_actual">Contraseña actual *</label>
                    <div class="col-md-5">
                        <input id="password_actual" name="password_actual" type="password" placeholder="Escribe tu contraseña, puedes utilizar letras y números" class="form-control input-md" required>
                    </div>
                </div>
                    <!-- Password input-->
                 <div class="form-group">
                        <label class="col-md-4 control-label" for="password1">Nueva Contraseña *</label>
                        <div class="col-md-5">
                            <input id="password1" name="password1" type="password" placeholder="Escribe tu contraseña, puedes utilizar letras y números" class="form-control input-md" required>
                        </div>
                    </div>

                    <!-- Password input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="password2">Repetir contraseña *</label>
                        <div class="col-md-5">
                            <input id="password2" name="password2" type="password" placeholder="Escribe de nuevo tu contraseña..." class="form-control input-md" required>  
                            <span class="advertencia"><?php echo $passErr;?></span>  
                        </div>
                    </div>
                   
                    <br>
                    <em>Los campos marcados con * son obligatorios</em>
                    <br>
                    <button class="btn btn-lg btn-warning center-block" style="padding-left: 15% ; padding-right: 15%" type="submit">Modificar</button>                 
                </fieldset> 
            </form>
        </div>
    </div>
</body>
</html>
</div>

<div class="clearfix visible-lg"></div>
	
</div>
</body>
</html>