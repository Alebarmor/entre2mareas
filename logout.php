<?php
//Esta página te logea fuera de la sesion
session_start();

//Si existe una sesión de login, se elimina
if (isset($_SESSION['DNI'])) {
	unset($_SESSION['DNI']);
	header("Location: home.php");
} else {
	header("Location: notLogin.php");
}

?>
