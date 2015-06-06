<?php include("header.php") ;
    include("funciones.php");
        session_start();
        $formValid = 1; 
        $codSegErr = $numTarjetaErr = $nombreTitularErr = $apellidoTitularErr = $vencimientoErr = "";
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $numTarjeta = test_input($_POST["numTarjeta"]);
            if (($_POST['empresa'] == 1)or(($_POST['empresa'] == 2))){
                if ((!preg_match("/^[0-9]*$/",$numTarjeta))or(strlen($numTarjeta)!=16)){
                    $formValid = 0;
                    $numTarjetaErr = "Solo se permiten números de 16 cifras"; 
                }
                $codSeg = test_input($_POST["codSeg"]);
                if ((!preg_match("/^[0-9]*$/",$codSeg))or(strlen($codSeg)!=3)) {
                    $formValid = 0;
                    $codSegErr = "Solo se permiten números de tres cifras"; 
                }
            }
            else {
                if ((!preg_match("/^[0-9]*$/",$numTarjeta))or(strlen($numTarjeta)!=15)){
                    $formValid = 0;
                    $numTarjetaErr = "Solo se permiten números de 15 cifras"; 
                }
                $codSeg = test_input($_POST["codSeg"]);
                if ((!preg_match("/^[0-9]*$/",$codSeg))or(strlen($codSeg)!=4)) {
                    $formValid = 0;
                    $codSegErr = "Solo se permiten números de cuatro cifras"; 
                }
            }
            
            $vencimiento = $_POST["vencimiento"];
            $año = substr($vencimiento,3,4);
            $mes = substr($vencimiento,0,2);
            $mesActual = date("m");
            $añoActual = date("Y");
            if ((($año == $añoActual)and($mes < $mesActual))or($año < $añoActual)){
                $formValid = 0;
                $vencimientoErr = "La tarjeta se encuentra vencida. Por favor contactarse con la empresa expendedora de tarjetas";
            }


            $nombreTitular = test_input($_POST["nombreTitular"]);
            if (!preg_match("/^[a-zA-Z ]*$/",$nombreTitular)) {
                $formValid = 0;
                $nombreTitularErr = "Solo se permiten letras y espacios"; 
            }

            $apellidoTitular = test_input($_POST["apellidoTitular"]);
            if (!preg_match("/^[a-zA-Z ]*$/",$apellidoTitular)) {
                $formValid = 0;
                $apellidoTitularErr = "Solo se permiten letras y espacios"; 
            }

            $vencimiento = test_input($_POST["vencimiento"]);
            if ((!preg_match("/^[0-9\/]*$/",$vencimiento)) or (strlen($vencimiento)!=7)){
                $formValid = 0;
                $vencimientoErr = "Solo se permiten fechas con el formato: mm/yyyy"; 
            }

            if ($formValid) {
                $tarjetaRegistrada = verificarTarjeta($numTarjeta);
                if (!$tarjetaRegistrada){
                    $email = $_SESSION["email"];
                    $password = $_SESSION["password"];
                    $nombre = $_SESSION["nombre"];
                    $apellido = $_SESSION["apellido"];
                    $fechaNac = $_SESSION["fechaNac"];
                    $dni = $_SESSION["dni"];
                    $pais = $_SESSION["pais"];
                    $provincia = $_SESSION["provincia"];
                    $localidad = $_SESSION["localidad"];
                    $sexo = $_SESSION["sexo"];
                    $calle = $_SESSION["calle"];
                    $numCalle = $_SESSION["numCalle"];
                    $dpto = $_SESSION["dpto"];
                    $piso = $_SESSION["piso"];                
                    if ($_POST["empresa"] == 1){
                        $empresa = "VISA";
                    }
                    elseif ($_POST["empresa"] == 2) {
                        $empresa = "Master Card";
                    }
                    else {
                        $empresa = "American Express";
                    }
                    switch ($_POST["banco"]) {
                        case 1:
                            $banco = "Santander Río";
                            break;
                        case 2:
                            $banco = "Banco Nación";
                            break;
                        case 3:
                            $banco = "Banco Provincia";
                            break;
                        case 4:
                            $banco = "Banco Patagonia";
                            break;
                        case 5:
                            $banco = "Banco Francés";
                            break;
                        case 6:
                            $banco = "Banco HSBC";
                            break;
                        case 7:
                            $banco = "Banco CREDICOOP";
                            break;    
                        default:
                            # code...
                            break;
                    }              
                    registrarUsuario($email,$password);
                    registrarTarjeta($numTarjeta,$codSeg,$empresa,$banco,$vencimiento,$nombreTitular,$apellidoTitular);
                    registrar($email,$nombre,$apellido,$fechaNac,$dni,$sexo,$calle,$numCalle,$dpto,$piso,$numTarjeta,$pais,$provincia,$localidad);

                    echo '<script language="javascript">alert("Usted se ha registrado correctamente");</script>';
                    header("refresh:0.1; url =  index.php");
                }
                else {
                    $numTarjetaErr = "El número de tarjeta ya se encuenta registrada";
                }                
            }
        }
        

    ?>
<div class="container">
        <div class="row">
            <form class="form-horizontal" style="padding-top: 2em" method="POST" action="<?php echo $_SERVER["PHP_SELF"];?>">
                <fieldset>

                    <!-- Form Name -->
                    <legend>Información de la tarjeta</legend>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="numero">Número *</label>  
                        <div class="col-md-5">
                            <input id="numTarjeta" name="numTarjeta" type="number" placeholder="Escribe aqui el numero de tu tarjeta. Por ej: 0000111122223333" class="form-control input-md" value="<?php if (isset($_POST['numTarjeta'])) echo $_POST['numTarjeta']; ?>" required autofocus>
                            <span class="advertencia"><?php echo $numTarjetaErr;?></span>
                        </div>
                    </div>

            
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="cod">Código de seguridad *</label>  
                        <div class="col-md-5">
                            <input id="codSeg" name="codSeg" type="password" placeholder="Escribe aquí tu código de seguridad. Por ej: 1234" class="form-control input-md" value="<?php if (isset($_POST['codSeg'])) echo $_POST['codSeg']; ?>" required>
                            <span class="advertencia"><?php echo $codSegErr;?></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="nombreTitular">Nombre del titular *</label>
                        <div class="col-md-5">
                            <input id="nombreTitular" name="nombreTitular" type="text" placeholder="Escribe el nombre del titular de la tarjeta. Por ej: Pedro Antonio" class="form-control input-md" value="<?php if (isset($_POST['nombreTitular'])) echo $_POST['nombreTitular']; ?>" required>
                            <span class="advertencia"><?php echo $nombreTitularErr;?></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="apellidoTitular">Apellido del titular *</label>
                        <div class="col-md-5">
                            <input id="apellidoTitular" name="apellidoTitular" type="text" placeholder="Escribe el apellido del titular de la tarjeta. Por ej: Messi" class="form-control input-md" value="<?php if (isset($_POST['apellidoTitular'])) echo $_POST['apellidoTitular']; ?>" required>
                            <span class="advertencia"><?php echo $apellidoTitularErr;?></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="banco">Banco *</label>
                        <div class="col-md-4">
                            <select class="form-control" name="banco">
                                <option value="1">Santander Río</option>
                                <option value="2">Banco Nación</option>
                                <option value="3">Banco Provincia</option>
                                <option value="4">Banco Patagonia</option>
                                <option value="5">Banco Francés</option>
                                <option value="6">Banco HSBC</option>
                                <option value="7">Banco CREDICOOP</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="empresa">Empresa *</label>
                        <div class="col-md-4">
                            <select class="form-control" name="empresa">
                                <option value="1">VISA</option>
                                <option value="2">Master Card</option>
                                <option value="3">American Express</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="mes">Fecha de vencimiento *</label>  
                        <div class="col-md-5">
                            <input id="vencimiento" name="vencimiento" type="text" placeholder="Formato: mm/yyyy. Por ej: 01/2016" class="form-control input-md" value="<?php if (isset($_POST['vencimiento'])) echo $_POST['vencimiento']; ?>" required>
                            <span class="advertencia"><?php echo $vencimientoErr;?></span>
                        </div>
                    </div>

                    <br>
                    <em>Los campos marcados con * son obligatorios</em>
                    <br>
                    <button class="btn btn-lg btn-primary center-block" style="padding-left: 15% ; padding-right: 15%" type="submit">Enviar</button>                    
                    <!-- <button class="btn btn-lg btn-warning center-block" style="padding-left: 15% ; padding-right: 15%" type="submit" href="registrarse.php">Volver</button> -->           
                </fieldset> 
            </form>
            <a href="registrarse.php" style="text-decoration: none"><button class="btn btn-default btn-lg center-block" style="padding-left: 15% ; padding-right: 15%">Volver</button></a>
        </div>
    </div>