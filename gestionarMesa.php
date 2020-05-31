<?php

function consultarProductosMesa($conexion,$num) {
	$consulta = "SELECT * FROM pedidos WHERE (pedidos.numMesa ='$num') AND (pedidos.pagado=1)";
	$stmt = $conexion->prepare($consulta);
	$stmt->execute();
	return $stmt;
}

function actualizarValMesa($conexion,$val,$num) {
	$consulta = "Update Pedidos Set valoracion='$val' WHERE (pedidos.numMesa ='$num') AND (pedidos.pagado=1)";
	$stmt = $conexion->prepare($consulta);
	$stmt->execute();
	return $stmt;
}

function MesaPagada($conexion,$num) {
	$consulta = "Update Pedidos Set pagado=2 WHERE (pedidos.numMesa ='$num') AND (pedidos.pagado=1)";
	$stmt = $conexion->prepare($consulta);
	$stmt->execute();
	return $stmt;
}

?>