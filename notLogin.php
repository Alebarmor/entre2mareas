<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<title>Something happens...</title>
	<link rel="stylesheet" href="css/estilos.css">
</head>
<body>	

<?php
	include_once("cabecera.php");
?>
	
	<section class="main">
		<h1>No estás logeado</h1>
        <a href="home.php">Volver</a>
	</section>

<?php
	include_once("pie.php");
?>
</body>
</html>