<?php

function consultarComidasDisponibles($conexion) {
	$consulta = "SELECT * FROM CARTA WHERE CANTIDAD_DISPONIBLE >= 1";
    return $conexion->query($consulta);
}

?>