<?php

function consultarEncargado($conexion,$oid_dni,$pass) {
 	$consulta = "SELECT COUNT(*) AS TOTAL FROM ENCARGADO WHERE OID_DNI=:oid_dni AND PASS=:pass";
	$stmt = $conexion->prepare($consulta);
	$stmt->bindParam(':oid_dni',$oid_dni);
	$stmt->bindParam(':pass',$pass);
	$stmt->execute();
	return $stmt->fetchColumn();
	
}

?>