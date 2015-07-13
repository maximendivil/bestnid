<?php
	include("header.php");
	session_start();

	echo "<div class='alert alert-sucess'><p style='color: green ; text-align: center'>La publicacion se realizo correctamente!</p></div>";
    header("refresh: 3 ; url = index.php");
?>