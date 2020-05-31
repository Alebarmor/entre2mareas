<?php

function consultaEsAdmin($conexion, $dni) {
	try {
		$stmt = $conexion -> prepare("SELECT is_admin FROM encargado WHERE oid_dni=:dni");
		$stmt -> bindParam(":dni", $dni);
		$stmt -> execute();
		return $stmt;
	} catch(PDOException $e) {
		echo $e -> getMessage();
		return false;
	}
}

?>