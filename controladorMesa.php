<?php	
	session_start();
	
	if (isset($_REQUEST["PRODUCTO"])) {
		$pedido["PRODUCTO"] = $_REQUEST["PRODUCTO"];
		$pedido["PRECIO"] = $_REQUEST["PRECIO"];
		$pedido["CANTIDAD"] = $_REQUEST["CANTIDAD"];
		$_SESSION["pedido"] = $pedido;
			
		Header("Location: mesa1.php");
	
?>