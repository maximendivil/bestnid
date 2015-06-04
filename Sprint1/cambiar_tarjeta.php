<?php

session_start();
include("header.php") ; 
include("cpanel_menu.php");
include("funciones.php");

if(!isset($_SESSION['usuario'])){
    header("location: index.php");
}

// OBTENGO LOS DATOS DE LA TARJETA

$user = $_SESSION['usuario'];

// Se obtiene un arreglo asociativo con la informacion de la tarjeta
$rows = obtenerTarjeta($user);
$numero = $rows['numero'];
$_SESSION['tarjeta'] = $numero;
$codSeguridad = $rows['codSeguridad'];
$empresa = $rows['empresa'];
$banco = $rows['banco'];
$nombre = $rows['nombre'];
$apellido = $rows['apellido'];
$fechaVencimiento = $rows['fechaVencimiento'];


        $formValid = 1; 
        $codSegErr = $numTarjetaErr = $nombreTitularErr = $apellidoTitularErr = $vencimientoErr = "";
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $numTarjeta = test_input($_POST["numTarjeta"]);
            if ((!preg_match("/^[0-9]*$/",$numTarjeta))or(strlen($numTarjeta)!=16)){
                $formValid = 0;
                $numTarjetaErr = "Solo se permiten números de 16 cifras"; 
            }
            
            $codSeg = test_input($_POST["codSeg"]);
            if ((!preg_match("/^[0-9]*$/",$codSeg))or(strlen($codSeg)!=4)) {
                $formValid = 0;
                $codSegErr = "Solo se permiten números de cuatro cifras"; 
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
                $numTarjeta = $_POST['numTarjeta'];
                $codSeg = $_POST['codSeg'];
                $nombreTitular = $_POST['nombreTitular'];
                $apellidoTitular = $_POST['apellidoTitular'];
                $empresa = $_POST['empresa'];
                $banco = $_POST['banco'];
                $vencimiento = $_POST['vencimiento'];

                $tarjetaRegistrada = verificarTarjeta($numTarjeta);
                if (!$tarjetaRegistrada){
                             
                    if ($_POST["empresa"] == 1){
                        $empresa = "VISA";
                    }
                    else {
                        $empresa = "Master Card";
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
                    $num = $_SESSION['tarjeta'];
                    $user = $_SESSION['usuario'];              
                    actualizarTarjeta($numTarjeta,$codSeg,$empresa,$banco,$vencimiento,$nombreTitular,$apellidoTitular,$user,$num);
                    echo "<script language='javascript'> alert('La informacion de la tarjeta se actualizo correctamente');</script>";
                    header("refresh: 0.1 ; url = cambiar_tarjeta.php");
                }
                else {
                    $numTarjetaErr = "El número de tarjeta ya se encuenta registrada";
                }                
            }
        }

    ?>
<div class="container" style="margin-left: 10%">
        <div class="row">
            <form class="form-horizontal" style="padding-top: 2em ; margin-left: 25%" method="POST" action="<?php echo $_SERVER["PHP_SELF"];?>">
                <fieldset>

                    <!-- Form Name -->
                    <legend>Información de la tarjeta</legend>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="numero">Número *</label>  
                        <div class="col-md-5">
                            <input id="numTarjeta" name="numTarjeta" type="number" placeholder="Escribe aqui el numero de tu tarjeta. Por ej: 0000111122223333" class="form-control input-md" value="<?php echo $numero; ?>" required autofocus>
                            <span class="advertencia"><?php echo $numTarjetaErr;?></span>
                        </div>
                    </div>

            
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="cod">Código de seguridad *</label>  
                        <div class="col-md-5">
                            <input id="codSeg" name="codSeg" type="password" placeholder="Escribe aquí tu código de seguridad. Por ej: 1234" class="form-control input-md" value="<?php echo $codSeguridad; ?>" required>
                            <span class="advertencia"><?php echo $codSegErr;?></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="nombreTitular">Nombre del titular *</label>
                        <div class="col-md-5">
                            <input id="nombreTitular" name="nombreTitular" type="text" placeholder="Escribe el nombre del titular de la tarjeta. Por ej: Pedro Antonio" class="form-control input-md" value="<?php echo $nombre; ?>" required>
                            <span class="advertencia"><?php echo $nombreTitularErr;?></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="apellidoTitular">Apellido del titular *</label>
                        <div class="col-md-5">
                            <input id="apellidoTitular" name="apellidoTitular" type="text" placeholder="Escribe el apellido del titular de la tarjeta. Por ej: Messi" class="form-control input-md" value="<?php echo $apellido; ?>" required>
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
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="mes">Fecha de vencimiento *</label>  
                        <div class="col-md-5">
                            <input id="vencimiento" name="vencimiento" type="text" placeholder="Formato: mm/yyyy. Por ej: 01/2016" class="form-control input-md" value="<?php echo $fechaVencimiento; ?>" required>
                            <span class="advertencia"><?php echo $vencimientoErr;?></span>
                        </div>
                    </div>

                    <br>
                    <em>Los campos marcados con * son obligatorios</em>
                    <br>
                    <br>
                    <button class="btn btn-lg btn-primary center-block" style="padding-left: 13% ; padding-right: 13%" type="submit">Enviar</button>
                    <br>
                    <a href="javascript:history.back()" style="text-decoration: none"><button style="padding-left: 10% ; padding-right: 10%" class="btn btn-lg btn-default center-block" type="button">Volver</button></a>                         
                </fieldset> 
            </form>
            
        </div>
    </div>