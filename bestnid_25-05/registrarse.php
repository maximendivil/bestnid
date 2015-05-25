
    <?php include("header.php") ;
        session_start();
        $formValid = 1; 
        $nameErr = $calleErr = $apellidoErr = $dniErr = $fechaNacErr = $departamentoErr = $emailErr = $passErr = $departamento = $nombre = $apellido = $calle = $pass = "";
        // define variables and set to empty values
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nombre = test_input($_POST["nombre"]);
            if (!preg_match("/^[a-zA-Z ]*$/",$nombre)) {
                $formValid = 0;
                $nameErr = "Solo se permiten letras y espacios"; 
            }
            $apellido = test_input($_POST["apellido"]);
            if (!preg_match("/^[a-zA-Z ]*$/",$apellido)) {
                $formValid = 0;
                $apellidoErr = "Solo se permiten letras y espacios"; 
            }
            if (strlen($_POST["dni"]) > 8){
                $formValid = 0;
                $dniErr = "Excede el maximo de digitos";
            }

            $fechaNac = test_input($_POST["fechaNac"]);
            if (!preg_match("/^[0-9\/]*$/",$fechaNac)) {
                $formValid = 0;
                $fechaNacErr = "Solo se permiten fechas con el formato: dd/mm/aaaa"; 
            }

            $calle = test_input($_POST["calle"]);
            if (!preg_match("/^[a-zA-Z0-9\/ ]*$/",$calle)) {
                $formValid = 0;
                $calleErr = "Solo se permiten letras, números y espacios"; 
            }
            $departamento = test_input($_POST["dpto"]);
            if (!preg_match("/^[a-zA-Z0-9\/ ]*$/",$departamento)) {
                $formValid = 0;
                $departamentoErr = "Solo se permiten letras, números y espacios"; 
            }

            if(!($_POST["email1"] == $_POST["email2"])){
                    $formValid = 0;
                    $emailErr = "Los emails no coinciden, por favor ingresarlos nuevamente";
                }

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

            if ($formValid) {
                $email = test_input($_POST["email1"]);
                $registrado = verificar($email); //Verifica si el usuario ya se encuentra registrado en el sitio
                if (!($registrado)){
                    $_SESSION["email"] = $_POST["email1"];
                    $_SESSION["password"] = $_POST["password1"];
                    $_SESSION["nombre"] = $_POST["nombre"];
                    $_SESSION["apellido"] = $_POST["apellido"];
                    $_SESSION["fechaNac"] = $_POST["fechaNac"];
                    $_SESSION["dni"] = $_POST["dni"];
                    if ($_POST["sexo"] == 1){
                        $_SESSION["sexo"] = 'M';    
                    }
                    else {
                        $_SESSION["sexo"] = 'F';
                    }
                    $_SESSION["calle"] = $_POST["calle"];
                    $_SESSION["numCalle"] = $_POST["numCalle"];
                    $_SESSION["dpto"] = $_POST["dpto"];
                    $_SESSION["piso"] = $_POST["piso"];
                    header("location: tarjeta.php");                    
                }
                else{
                    $emailErr = "El email ingresado ya existe, ingrese otro";
                }
            }
        }

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        function verificar($email){
            $link = mysql_connect('localhost','root') or die('No se pudo conectar: '.mysql_error());
            mysql_select_db('bestnid',$link) or die('No se pudo seleccionar la base de datos');
            $result = mysql_query("SELECT * FROM usuario WHERE email='$email'") or die('Falló la consulta');
            $total = mysql_num_rows($result);
            mysql_close($link);
            return $total;
        }

    ?>
    <div class="container">
        <div class="row">
            <h1 class="text-center login-title" style="color: #ec971f">Registrarse</h1>
            <form class="form-horizontal" style="padding-top: 2em" method="POST" action="<?php echo $_SERVER["PHP_SELF"];?>">
                <fieldset>

                    <!-- Form Name -->
                    <legend>Datos personales</legend>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="nombre">Nombre *</label>  
                        <div class="col-md-5">
                            <input id="nombre" name="nombre" type="text" placeholder="Escribe tu nombre aqui..." class="form-control input-md" value="<?php if (isset($_POST['nombre'])) echo $_POST['nombre']; ?>" required autofocus>
                            <span class="advertencia"><?php echo $nameErr;?></span>
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="apellido">Apellido *</label>  
                        <div class="col-md-5">
                            <input id="apellido" name="apellido" type="text" placeholder="Escribe tu apellido aqui..." class="form-control input-md" value="<?php if (isset($_POST['apellido'])) echo $_POST['apellido']; ?>" required>
                            <span class="advertencia"><?php echo $apellidoErr;?></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="fechaNacimiento">Fecha de nacimiento *</label>
                        <div class="col-md-5">
                            <input id="fechaNac" name="fechaNac" type="date" placeholder="Formato: dd/mm/yy" class="form-control input-md" value="<?php if (isset($_POST['fechaNac'])) echo $_POST['fechaNac']; ?>" required>
                            <span class="advertencia"><?php echo $fechaNacErr;?></span>
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="dni">DNI *</label>  
                        <div class="col-md-5">
                            <input id="dni" name="dni" type="number" placeholder="Escribe tu DNI aqui sin utilizar puntos. Por ej: 12345678" class="form-control input-md" value="<?php if (isset($_POST['dni'])) echo $_POST['dni']; ?>" required>
                            <span class="advertencia"><?php echo $dniErr;?></span>
                        </div>
                    </div>

                    <!-- Multiple Radios -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="sexo">Sexo *</label>
                        <div class="col-md-4">
                            <div class="radio">
                                <label for="sexo-0">
                                    <input type="radio" name="sexo" id="sexo-0" value="1" checked="checked">
                                    Masculino
                                </label>
                            </div>
                            <div class="radio">
                                <label for="sexo-1">
                                    <input type="radio" name="sexo" id="sexo-1" value="2">
                                    Femenino
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="calle">Calle *</label>  
                        <div class="col-md-5">
                            <input id="calle" name="calle" type="text" placeholder="Escribe tu calle aqui..." class="form-control input-md" value="<?php if (isset($_POST['calle'])) echo $_POST['calle']; ?>" required>
                            <span class="advertencia"><?php echo $calleErr;?></span>
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="numCalle">Numero *</label>  
                        <div class="col-md-5">
                            <input id="numCalle" name="numCalle" type="number" placeholder="Escribe tu numero aqui..." class="form-control input-md" value="<?php if (isset($_POST['numCalle'])) echo $_POST['numCalle']; ?>" required>
    
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="dpto">Departamento</label>  
                        <div class="col-md-5">
                            <input id="dpto" name="dpto" type="text" placeholder="Escribe tu departamento aqui..." class="form-control input-md" value="<?php if (isset($_POST['dpto'])) echo $_POST['dpto']; ?>">
                            <span class="advertencia"><?php echo $departamentoErr;?></span>
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="piso">Piso</label>  
                        <div class="col-md-5">
                            <input id="piso" name="piso" type="number" placeholder="Escribe tu piso aqui..." class="form-control input-md" value="<?php if (isset($_POST['piso'])) echo $_POST['piso']; ?>" >
    
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="mail">Email *</label>  
                        <div class="col-md-5">
                            <input id="mail" name="email1" type="email" placeholder="Escribe tu e-mail aqui de la forma: miemail@correo.com" class="form-control input-md" value="<?php if (isset($_POST['email1'])) echo $_POST['email1']; ?>" required>
                            <span class="advertencia"><?php echo $emailErr;?></span>
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="email2">Repetir email *</label>  
                        <div class="col-md-5">
                            <input id="email2" name="email2" type="email" placeholder="Escribe de nuevo tu e-mail aqui..." class="form-control input-md" value="<?php if (isset($_POST['email2'])) echo $_POST['email2']; ?>" required>
    
                        </div>
                    </div>

                    <!-- Password input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="password1">Contraseña *</label>
                        <div class="col-md-5">
                            <input id="password1" name="password1" type="password" placeholder="Escribe tu contraseña, puedes utilizar letras y números" class="form-control input-md" value="<?php if (isset($_POST['password1'])) echo $_POST['password1']; ?>" required>
                            <span class="advertencia"><?php echo $passErr;?></span>
                        </div>
                    </div>

                    <!-- Password input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="password2">Repetir contraseña *</label>
                        <div class="col-md-5">
                            <input id="password2" name="password2" type="password" placeholder="Escribe de nuevo tu contraseña..." class="form-control input-md" value="<?php if (isset($_POST['password2'])) echo $_POST['password2']; ?>" required>    
                        </div>
                    </div>
                    <br>
                    <em>Los campos marcados con * son obligatorios</em>
                    <br>
                    <button class="btn btn-lg btn-warning center-block" style="padding-left: 15% ; padding-right: 15%" type="submit">Siguiente</button>                 
                </fieldset> 
            </form>
        </div>
    </div>
</body>
</html>