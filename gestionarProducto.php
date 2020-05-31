<?php

function actualizarPrecioCantidad($conexion,$oid_producto,$precio,$cantidad_disponible) {
 	$consulta = "UPDATE CARTA SET PRECIO = :precio, CANTIDAD_DISPONIBLE = :cantidad_disponible WHERE OID_PRODUCTO = :oid_producto";
	$stmt = $conexion->prepare($consulta);
	$stmt->bindParam(':oid_producto',$oid_producto);
	$stmt->bindParam(':precio',$precio);
	$stmt->bindParam(':cantidad_disponible',$cantidad_disponible);
	$stmt->execute();
	return $stmt;
	
}
function insertarCarta($conexion,$oid_producto,$precio,$cantidad_disponible) {
	$consulta = "INSERT INTO carta (oid_producto,precio,cantidad_disponible) VALUES (:oid_producto, :precio, :cantidad_disponible)";
	$stmt = $conexion->prepare($consulta);
	$stmt->bindParam(':oid_producto',$oid_producto);
	$stmt->bindParam(':precio',$precio);
	$stmt->bindParam(':cantidad_disponible',$cantidad_disponible);
	$stmt->execute();
	return $stmt;
	
}

?>