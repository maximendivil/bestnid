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


<?php 
session_start();
include("header.php") ; 
include("cpanel_menu.php");
include("funciones.php");

if(!isset($_SESSION['usuario'])){
    header("location: index.php");
}

$nameErr = $calleErr = $apellidoErr = $dniErr = $fechaNacErr = $paisErr = $pciaErr = $localidadErr = $departamentoErr = $emailErr = $passErr = $departamento = $nombre = $apellido = $calle = $pass = "";
// OBTENGO LOS DATOS PERSONALES DEL USUARIO

$user = $_SESSION['usuario'];
$rows = datosUsuario($user);

$nombre = $rows['nombre'];
$apellido = $rows['apellido'];
$dni = $rows['dni'];
$fechaNacimiento = $rows['fechaNacimiento'];
$sexo = $rows['sexo'];
$calle = $rows['calle'];
$numCalle = $rows['numCalle'];
$departamento = $rows['departamento'];
$piso = $rows['piso'];
$localidad = $rows['localidad'];
$paisID = $rows['paisID'];
$provinciaID = $rows['provinciaID'];
$tarjeta = $rows['tarjeta'];

//---------------------------------//
	
$formValid = 1; 
       
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

            $localidad = test_input($_POST["localidad"]);
            if (!preg_match("/^[a-zA-Z ]*$/",$localidad)) {
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

            if ($formValid) {
                    $_SESSION["nombre"] = $_POST["nombre"];
                    $_SESSION["apellido"] = $_POST["apellido"];
                    $_SESSION["localidad"] = $_POST["localidad"];
                    $_SESSION["pais"] = $_POST["pais"];
                    $_SESSION["provincia"] = $_POST["provincia"];
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
                    header("location: modificar_datos.php");                    
            }
        }

 ?>
    <div class="container" style="margin-left: 10%">
        <div class="row">
            <form class="form-horizontal" style="padding-top: 2em ; margin-left: 25%" method="POST" action="<?php echo $_SERVER["PHP_SELF"];?>">
                <fieldset>

                    <!-- Form Name -->
                    <legend>Datos personales</legend>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="nombre">Nombre *</label>  
                        <div class="col-md-5">
                            <input id="nombre" name="nombre" type="text" class="form-control input-md" value="<?php echo $nombre; ?>" required autofocus>
                            <span class="advertencia"><?php echo $nameErr;?></span>
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="apellido">Apellido *</label>  
                        <div class="col-md-5">
                            <input id="apellido" name="apellido" type="text" placeholder="Escribe tu apellido aqui..." class="form-control input-md" value="<?php echo $apellido; ?>" required>
                            <span class="advertencia"><?php echo $apellidoErr;?></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="fechaNacimiento">Fecha de nacimiento *</label>
                        <div class="col-md-5">
                            <input id="fechaNac" name="fechaNac" type="date" placeholder="Formato: dd/mm/yy" class="form-control input-md" value="<?php echo $fechaNacimiento ?>" disabled>
                            <span class="advertencia"><?php echo $fechaNacErr;?></span>
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="dni">DNI *</label>  
                        <div class="col-md-5">
                            <input id="dni" name="dni" type="number" placeholder="Escribe tu DNI aqui sin utilizar puntos. Por ej: 12345678" class="form-control input-md" value="<?php echo $dni ?>" disabled>
                            <span class="advertencia"><?php echo $dniErr;?></span>
                        </div>
                    </div>

                    <!-- Multiple Radios -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="sexo">Sexo *</label>
                        <div class="col-md-4">
                            <div class="radio">
                                <label for="sexo-0">
                                    <?php 
                                        if ($sexo == "M") {
                                            echo "<input type='radio' name='sexo' id='sexo-0' value='1' checked='checked'>";
                                            echo "Masculino";
                                            echo "</label>";
                                            echo "</div> <div class='radio'> <label for='sexo-1'> <input type='radio' name='sexo' id='sexo-1' value='2'> Femenino </label>";
                                        }
                                        else {
                                            echo "<input type='radio' name='sexo' id='sexo-0' value='1'>";
                                            echo "Masculino";
                                            echo "</label>";
                                            echo "</div> <div class='radio'> <label for='sexo-1'> <input type='radio' name='sexo' id='sexo-1' value='2' checked='checked'> Femenino </label>";
                                        }
                                    ?>
                            </div>
                        </div>
                    </div>


                    <?php   // ----CONSULTA DE PAISES
                        $dbc = @mysql_connect('localhost','root','');
                        mysql_select_db('bestnid',$dbc);       
                        $query_pais = "select * from pais";
                        $result_query_pais = mysql_query($query_pais);      
						$codep = '';
                    ?>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="pais">País *</label>  
                        <div class="col-md-5">
                            <?php
                                echo "<select class='form-control'  id='pais' name='pais' required onchange='obtener_provincias(this.value)'>";
                                while($fila = mysql_fetch_array($result_query_pais)){
									if($fila['pais_id'] == $paisID){
										echo "<option value='".$fila['code']."' selected>".$fila['nombre']."</option>";
										$codep = $fila['code'];
									}else{
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
                                echo "<select class='form-control'  id='provincia' name='provincia'>";
								while($fila = mysql_fetch_array($result_query_provincia)){
									if($fila['provincia_id'] == $provinciaID){
										echo "<option value='".$fila['provincia_id']."' selected>".$fila['nombre']."</option>";
									}else{
										echo "<option value='".$fila['provincia_id']."'>".$fila['nombre']."</option>";
									}
								}
                                echo "</select>";
                            ?>
                            <span class="advertencia"><?php echo $pciaErr;?></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="localidad">Localidad *</label>  
                        <div class="col-md-5">
                            <input id="localidad" name="localidad" type="text" placeholder="Escribe tu localidad aqui. Por ej: La Plata" class="form-control input-md" value="<?php echo $localidad; ?>" required>
                            <span class="advertencia"><?php echo $localidadErr;?></span>
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="calle">Calle *</label>  
                        <div class="col-md-5">
                            <input id="calle" name="calle" type="text" placeholder="Escribe tu calle aqui..." class="form-control input-md" value="<?php echo $calle; ?>" required>
                            <span class="advertencia"><?php echo $calleErr;?></span>
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="numCalle">Numero *</label>  
                        <div class="col-md-5">
                            <input id="numCalle" name="numCalle" type="number" placeholder="Escribe tu numero aqui..." class="form-control input-md" value="<?php echo $numCalle; ?>" required>
    
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="dpto">Departamento</label>  
                        <div class="col-md-5">
                            <input id="dpto" name="dpto" type="text" placeholder="Escribe tu departamento aqui..." class="form-control input-md" value="<?php echo $departamento; ?>">
                            <span class="advertencia"><?php echo $departamentoErr;?></span>
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="piso">Piso</label>  
                        <div class="col-md-5">
                            <input id="piso" name="piso" type="number" placeholder="Escribe tu piso aqui..." class="form-control input-md" value="<?php echo $piso; ?>" >
    
                        </div>
                    </div>
                   
                    <br>
                    <em>Los campos marcados con * son obligatorios</em>
                    <br>
                    <br>
                    <button class="btn btn-lg btn-primary center-block" style="padding-left: 15% ; padding-right: 15%" type="submit">Modificar</button>                 
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