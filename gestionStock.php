<?php
//funciones necesarias para las paginas nuevoPedido, accionnuevopedido e insertarPedido
function consultarCartaStock($conexion) {
	try {
	$consulta = "SELECT oid_producto, precio FROM carta WHERE cantidad_disponible >0 order by oid_producto";
    $stmt=$conexion->prepare($consulta);
    $stmt->execute();
	return $stmt;
	
	} catch(PDOException $e) {
		return $rolf= error;
}
}

function cantidadMaxima($conexion, $producto) {
	try {
    $stmt=$conexion->prepare("SELECT cantidad_disponible FROM carta WHERE oid_producto=:producto");
	$stmt -> bindparam(":producto", $producto);
    $stmt->execute();
	return $stmt;
	
	} catch(PDOException $e) {
		return NULL;
}
}

function funcionPrecioTotal($conexion, $producto, $cantidad) {
	try {
	$stmt =$conexion->prepare("SELECT act_precio_x_cant(:producto,:cantidad) FROM dual");
	$stmt -> bindparam(":producto", $producto);
	$stmt -> bindparam(":cantidad", $cantidad);
    $stmt->execute();
	return $stmt;
	
	} catch(PDOException $e) {
		return NULL;
}
}
function anadirProducto($conexion, $envio) {
	try {
		$stmt = $conexion -> prepare("INSERT INTO pedidos (oid_pedidos, cliente_pedido, producto, cantidad, estado, precio, pagado, fecha, valoracion) VALUES (0, :cliente_pedido, :producto, :cantidad, 0, :precio, 0, :fecha, NULL)");
		$stmt -> bindParam(":producto", $envio["producto"]);
		$stmt -> bindParam(":cliente_pedido", $envio["mesa"]);
		$stmt -> bindParam(":precio", $envio["preciototal"]);
		$stmt -> bindParam(":fecha", date("Y-m-d"));
		$stmt -> execute();
		return true;
	} catch(PDOException $e) {
		echo $e -> getMessage();
		return false;
	}
}
	
?>