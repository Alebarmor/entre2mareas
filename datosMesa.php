<?php
	session_start();
	require_once("gestionBD.php");
	require_once("gestionarMesa.php");
	
	$conexion = crearConexionBD();
	$val=$_POST['val'];
	$pagado=$_POST['paga'];
	$numMesa=$_POST['numMesa'];

	$acts=actualizarValMesa($conexion,$val,$numMesa);
	if($pagado=="on"){$acts=MesaPagada($conexion,$numMesa);}

	
	cerrarConexionBD($conexion);
	header("Location: mesa$numMesa.php");
?>