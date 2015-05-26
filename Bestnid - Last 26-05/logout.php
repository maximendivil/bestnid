<?php
session_start();
if(session_destroy())
{
	echo "Usted se ha deslogueado.";
	header("refresh:1; url =  index.php");
}
?>