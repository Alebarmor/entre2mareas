<?php
//Inicio de sesiones
session_start();

//Includes
include_once ('gestionBD.php');
include_once ('gestionarEncargados.php');
include_once ('paginacion_consulta.php');

//Se insertan los datos obtenidos del formulario en la variable $usuario
$usuario['usuario'] = $_REQUEST['OID_DNI'];
$usuario['contrasenia'] = $_REQUEST['PASS'];

//Se crea una conexión a la base de datos
$conexion = crearConexionBD();

//Se validan los datos anteriores llamando a la función "validacionLogin" de manera que podermos obtener los errores si los hay
$errores = validacionLogin($conexion, $usuario);

//Se cierra la conexión a la base de datos
cerrarConexionBD($conexion);

//En el caso de que haya errores, se redirige a la página de login y se muestran los errores, en caso contrario se redirige a la página de inicio con los datos del usuario
if (count($errores) > 0) {
	$_SESSION['errores'] = $errores;
	header('Location: login.php');
} else {
	unset($_SESSION['errores']);
	$_SESSION['DNI'] = $usuario['usuario'];
	header('Location: mesa2.php');
}

function validacionLogin($conexion, $usuario) {
	$errores = array();
	$info = getInfoUsuario($conexion, $usuario['usuario']);
	if (empty($usuario['usuario'])) {
		$errores[] = 'El usuario está vacío.';
		unset($_SESSION['user']);
	} else if (empty($info['OID_DNI'])) {
		$errores[] = 'El usuario no se encuentra registrado.';
	} else {
		$_SESSION['user'] = $usuario['usuario'];
	}
	if (empty($usuario['contrasenia'])) {
		$errores[] = 'La contraseña esta vacía.';
		unset($_SESSION['contrasenia']);
	} else if ($usuario['contrasenia'] != $info['PASS']) {
		$errores[] = 'La contraseña es incorrecta.';
	} else {
		$_SESSION['contrasenia'] = $usuario['contrasenia'];
	}
	return $errores;
}
function getInfoUsuario($conexion, $OID_DNI) {
	try {
		$stmt = $conexion -> prepare("SELECT OID_DNI, Pass FROM Encargado WHERE OID_DNI = :OID_DNI");
		$stmt -> bindParam(":OID_DNI", $OID_DNI);
		$stmt -> execute();
		return $stmt -> fetch();
	} catch(PDOException $e) {
		$_SESSION["excepcion"] = $e -> GetMessage();
		header("Location: excepcion.php");
	}
	
}
?>