<?php

$codep= $_GET['code'];
	// ----CONSULTA DE PROVINCIA
$dbc = mysql_connect('localhost','root','');
mysql_select_db('bestnid',$dbc);
$query_provincia = "select * from provincia where codep ='$codep'";
$result_query_provincia = mysql_query($query_provincia);
$string = "<option value='0' selected='selected'> Elige uno</option>";
while($fila=mysql_fetch_array($result_query_provincia)){

			$string = $string."<option value='".$fila['provincia_id']."'>".$fila['nombre']."</option>";
			
}

echo utf8_encode($string);

?>