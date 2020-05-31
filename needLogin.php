<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<title>Redirect</title>
	<link rel="stylesheet" href="css/estilos.css">
</head>
<body>	

<?php
	include_once("cabecera.php");
?>
	
	<section class="main">
		<h1>Necesitas estar logueado para acceder a este recurso</h1>
        <p>Pincha en este <a href="login.php">enlace</a> para ir a loguearte</p>
	</section>

<?php
	include_once("pie.php");
?>
</body>
</html>