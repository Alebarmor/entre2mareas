<?php	
	session_start();
	
	if (isset($_REQUEST["OID_PRODUCTO"])) {
		$carta["OID_PRODUCTO"] = $_REQUEST["OID_PRODUCTO"];
		$carta["PRECIO"] = $_REQUEST["PRECIO"];
		$carta["CANTIDAD_DISPONIBLE"] = $_REQUEST["CANTIDAD_DISPONIBLE"];
		
		$_SESSION["carta"] = $carta;
			
		Header("Location: menu.php");
	
?>
