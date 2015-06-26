    <script language="javascript" charset="ISO-8859-1">     
            
            function obtener_provincias(code){
                var url = "consulta_provincias.php?code=" + code;
                var provincias = $.ajax({
                        url: url,
                        type: 'GET'
                    }).done(function(consulta){
                        $("#provincia").empty().append(consulta);
                    })

            }
    </script>
    

    <?php include("header.php") ;
        include("funciones.php");
        session_start();
        $formValid = 1; 
        $nameErr = $calleErr = $apellidoErr = $dniErr = $fechaNacErr = $paisErr = $pciaErr = $localidadErr = $departamentoErr = $emailErr = $passErr = $departamento = $nombre = $apellido = $calle = $pass = "";
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

            $email = test_input($_POST["email1"]);
            if (!(filter_var($email, FILTER_VALIDATE_EMAIL))){ 
                $formValid = 0;
                $emailErr = "El formato del email es invalido. Formato: miemail@correo.com";
            }

            if ($_POST['provincia'] == 0){
                $formValid = 0;
                $pciaErr = "Debes seleccionar una provincia";
            }
    

            $localidad = test_input($_POST["localidad"]);
            if (!preg_match("/^[a-zA-Z. ]*$/",$localidad)) {
                $formValid = 0;
                $localidadErr = "Solo se permiten letras y espacios"; 
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
                $registrado = verificarEmail($email); //Verifica si el usuario ya se encuentra registrado en el sitio
                if (!($registrado)){
                    $_SESSION["email"] = $_POST["email1"];
                    $_SESSION["email2"] = $_POST["email2"];
                    $_SESSION["password"] = $_POST["password1"];
                    $_SESSION["nombre"] = $_POST["nombre"];
                    $_SESSION["apellido"] = $_POST["apellido"];
                    $_SESSION["fechaNac"] = $_POST["fechaNac"];
                    $_SESSION["localidad"] = $_POST["localidad"];
                    $_SESSION["pais"] = $_POST["pais"];
                    $_SESSION["provincia"] = $_POST["provincia"];
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

    ?>
    <div class="container">
        <div class="row">
            <h1 class="text-center login-title">Registrarse</h1>
            <form class="form-horizontal" style="padding-top: 2em" method="POST" action="<?php echo $_SERVER["PHP_SELF"];?>">
                <fieldset>

                    <!-- Form Name -->
                    <legend>Datos personales</legend>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="nombre">Nombre *</label>  
                        <div class="col-md-5">
                            <input id="nombre" name="nombre" type="text" placeholder="Escribe tu nombre aqui..." class="form-control input-md" value="<?php if (isset($_POST['nombre'])) echo $_POST['nombre']; elseif(isset($_SESSION["nombre"])) echo $_SESSION["nombre"]; ?>" required autofocus>
                            <span class="advertencia"><?php echo $nameErr;?></span>
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="apellido">Apellido *</label>  
                        <div class="col-md-5">
                            <input id="apellido" name="apellido" type="text" placeholder="Escribe tu apellido aqui..." class="form-control input-md" value="<?php if (isset($_POST['apellido'])) echo $_POST['apellido']; elseif(isset($_SESSION["apellido"])) echo $_SESSION["apellido"];?>" required>
                            <span class="advertencia"><?php echo $apellidoErr;?></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="fechaNacimiento">Fecha de nacimiento *</label>
                        <div class="col-md-5">
                            <input id="fechaNac" name="fechaNac" type="date" placeholder="Formato: dd/mm/yy" class="form-control input-md" value="<?php if (isset($_POST['fechaNac'])) echo $_POST['fechaNac']; elseif(isset($_SESSION["fechaNac"])) echo $_SESSION["fechaNac"];?>" required>
                            <span class="advertencia"><?php echo $fechaNacErr;?></span>
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="dni">DNI *</label>  
                        <div class="col-md-5">
                            <input id="dni" name="dni" type="number" placeholder="Escribe tu DNI aqui sin utilizar puntos. Por ej: 12345678" class="form-control input-md" value="<?php if (isset($_POST['dni'])) echo $_POST['dni']; elseif(isset($_SESSION["dni"])) echo $_SESSION["dni"];?>" required>
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


                    <?php   // ----CONSULTA DE PAISES
                        $dbc = @mysql_connect('localhost','root','');
                        mysql_select_db('bestnid',$dbc);       
                        $query_pais = "select * from pais";
                        $result_query_pais = mysql_query($query_pais);       
                    ?>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="pais">País *</label>  
                        <div class="col-md-5">
                            <?php
                                echo "<select class='form-control'  id='pais' name='pais' required onchange='obtener_provincias(this.value)'>";
                                if(isset($_SESSION["pais"])){
                                    while($fila = mysql_fetch_array($result_query_pais)){
                                    if($fila['code'] == $_SESSION["pais"]){
                                        echo "<option value='".$fila['code']."' selected>".$fila['nombre']."</option>";
                                        $codep = $fila['code'];
                                    }
                                    else{
                                        echo "<option value='".$fila['code']."'>".$fila['nombre']."</option>";
                                        }
                                    }
                                }
                                else {
                                    echo "<option value='' selected='selected' > Elige uno</option>";
                                    while($fila = mysql_fetch_array($result_query_pais)){
                                        echo "<option value='".$fila['code']."'>".$fila['nombre']."</option>";
                                    }
                                }
                                echo "</select>";
                            ?>
                            <span class="advertencia"><?php echo $paisErr;?></span>
                        </div>
                    </div>

                    <?php   // ----CONSULTA DE PROVINCIAS
                        $dbc = @mysql_connect('localhost','root','');
                        mysql_select_db('bestnid',$dbc);       
                        $query_provincia = "select * from provincia where codep='".$codep."'";
                        $result_query_provincia = mysql_query($query_provincia);   
                    ?>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="pcia">Provincia *</label>  
                        <div class="col-md-5">
                            <?php
                                echo "<select class='form-control'  id='provincia' name='provincia' required>";
                                if (isset($_SESSION["provincia"])){
                                    while($fila = mysql_fetch_array($result_query_provincia)){
                                        if($fila['provincia_id'] == $_SESSION["provincia"]){
                                            echo "<option value='".$fila['provincia_id']."' selected>".$fila['nombre']."</option>";
                                        }else{
                                            echo "<option value='".$fila['provincia_id']."'>".$fila['nombre']."</option>";
                                        }
                                    }
                                }
                                else{
                                    echo"<option value='' selected='selected'> Elige uno</option>";
                                }                                
                                echo "</select>";
                            ?>
                            <span class="advertencia"><?php echo $pciaErr;?></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="localidad">Localidad *</label>  
                        <div class="col-md-5">
                            <input id="localidad" name="localidad" type="text" placeholder="Escribe tu localidad aqui. Por ej: La Plata" class="form-control input-md" value="<?php if (isset($_POST['localidad'])) echo $_POST['localidad']; elseif(isset($_SESSION["localidad"])) echo $_SESSION["localidad"]; ?>" required>
                            <span class="advertencia"><?php echo $localidadErr;?></span>
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="calle">Calle *</label>  
                        <div class="col-md-5">
                            <input id="calle" name="calle" type="text" placeholder="Escribe tu calle aqui..." class="form-control input-md" value="<?php if (isset($_POST['calle'])) echo $_POST['calle']; elseif(isset($_SESSION["calle"])) echo $_SESSION["calle"]; ?>" required>
                            <span class="advertencia"><?php echo $calleErr;?></span>
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="numCalle">Numero *</label>  
                        <div class="col-md-5">
                            <input id="numCalle" name="numCalle" type="number" placeholder="Escribe tu numero aqui..." class="form-control input-md" value="<?php if (isset($_POST['numCalle'])) echo $_POST['numCalle']; elseif(isset($_SESSION["numCalle"])) echo $_SESSION["numCalle"]; ?>" required>
    
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="dpto">Departamento</label>  
                        <div class="col-md-5">
                            <input id="dpto" name="dpto" type="text" placeholder="Escribe tu departamento aqui..." class="form-control input-md" value="<?php if (isset($_POST['dpto'])) echo $_POST['dpto']; elseif(isset($_SESSION["dpto"])) echo $_SESSION["dpto"]; ?>">
                            <span class="advertencia"><?php echo $departamentoErr;?></span>
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="piso">Piso</label>  
                        <div class="col-md-5">
                            <input id="piso" name="piso" type="number" placeholder="Escribe tu piso aqui..." class="form-control input-md" value="<?php if (isset($_POST['piso'])) echo $_POST['piso']; elseif(isset($_SESSION["piso"])) echo $_SESSION["piso"]; ?>" >
    
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="mail">Email *</label>  
                        <div class="col-md-5">
                            <input id="mail" name="email1" type="email" placeholder="Escribe tu e-mail aqui de la forma: miemail@correo.com" class="form-control input-md" value="<?php if (isset($_POST['email1'])) echo $_POST['email1']; elseif(isset($_SESSION["email"])) echo $_SESSION["email"]; ?>" required>
                            <span class="advertencia"><?php echo $emailErr;?></span>
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="email2">Repetir email *</label>  
                        <div class="col-md-5">
                            <input id="email2" name="email2" type="email" placeholder="Escribe de nuevo tu e-mail aqui..." class="form-control input-md" value="<?php if (isset($_POST['email2'])) echo $_POST['email2']; elseif(isset($_SESSION["email"])) echo $_SESSION["email"]; ?>" required>
    
                        </div>
                    </div>

                    <!-- Password input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="password1">Contraseña *</label>
                        <div class="col-md-5">
                            <input id="password1" name="password1" type="password" placeholder="Escribe tu contraseña, puedes utilizar letras y números" class="form-control input-md" value="<?php if (isset($_POST['password1'])) echo $_POST['password1']; elseif (isset($_SESSION["password"])) echo $_SESSION["password"]; ?>" required>
                            <span class="advertencia"><?php echo $passErr;?></span>
                        </div>
                    </div>

                    <!-- Password input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="password2">Repetir contraseña *</label>
                        <div class="col-md-5">
                            <input id="password2" name="password2" type="password" placeholder="Escribe de nuevo tu contraseña..." class="form-control input-md" value="<?php if (isset($_POST['password2'])) echo $_POST['password2']; elseif (isset($_SESSION["password"])) echo $_SESSION["password"]; ?>" required>    
                        </div>
                    </div>
                    <br>
                    <em>Los campos marcados con * son obligatorios</em>
                    <br>
                    <button class="btn btn-lg btn-primary center-block" style="padding-left: 15% ; padding-right: 15%" type="submit">Siguiente</button>                 
                </fieldset> 
            </form>
        </div>
    </div>
</body>
</html>