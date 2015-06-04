<?php 
session_start();
include("header.php") ; 
include("cpanel_menu.php");

if(!isset($_SESSION['usuario'])){
    header("location: index.php");
}
?>

<div>
    <p></p>
</div>

<div class="clearfix visible-lg"></div>
	
</div>
</div>
</body>
</html>