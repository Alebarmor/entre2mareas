<?php

function consultarComidasDisponibles($conexion) {
	$consulta = "SELECT * FROM CARTA";
    return $conexion->query($consulta);
}

?>