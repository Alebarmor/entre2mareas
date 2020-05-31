<?php
//Aqui se incluye la cantidad del producto del pedido
session_start();
require_once("gestionBD.php");
require_once("gestionarStock.php"); 

if (!isset($_SESSION['DNI'])) {
   	 header('Location: needLogin.php');
}
 
$conexion = crearConexionBD();

$pedido["producto"]=$_GET["nombre"];
$pedido["precio"]=$_GET["precio"];
$pedido["cantidadMax"]=cantidadMaxima($conexion, $_GET["nombre"]);

cerrarConexionBD($conexion);
?>

<!DOCTYPE html>
<html lang="es">
<head>
<?php
include_once ("cabecera.php");
?>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/proyect.css" />
	</head>
	<body>
	<h1>Elija la cantidad y la mesa destino</h1>
	
	<form action="insertarPedido.php" method="get">
  <label for="quantity"><?php echo $pedido["producto"]?>.........<?php echo $pedido["precio"]?>€</label>
  <input type="number" id="cantidad" name="cantidad" min="1" max="<?php echo $pedido["cantidadMax"]?>"> <br>
  <a>Mesa:</a> <input type="text" id="mesa" name="mesa" placeholder="Escriba número de mesa" required> 
  <input type="submit" value="Enviar" >
  <input type="hidden" id="producto" name="producto" value="<?php echo $pedido["producto"]?>">
  <input type="hidden" id="precio" name="precio" value="<?php echo $pedido["precio"]?>">
  </form>
  <br>
  <a href="nuevoPedido.php">Cancelar</a>
  <br>	
	<footer>
<?php
		include_once ("pie.php");
		?>
</footer>