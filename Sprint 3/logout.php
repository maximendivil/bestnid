<?php
session_start();
if(session_destroy())
{
	//echo '<script language="javascript">alert("Usted se ha deslogueado");</script>';
	header("refresh: 0.1; url =  index.php");
}
?>