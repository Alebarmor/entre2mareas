<?php
//Aqui se inserta el pedido en la base de datos y se redirige a nuevoPedido si es exito y sino a error
session_start();
require_once("gestionBD.php");
require_once("gestionStock.php"); 
$conexion = crearConexionBD();
$envio["producto"]=$_GET["producto"];
$precio=$_GET["precio"];
$envio["cantidad"]=$_GET["cantidad"];
$envio["mesa"]=$_GET["mesa"];
$preciotot= funcionPrecioTotal($conexion, $envio["producto"], $precio);

foreach($preciotot as $value){
$envio["preciototal"]=$value["0"];}

//Actualmente esta puesto tal que el nº de mesa se trate del cliente
$res= anadirProducto($conexion, $envio);

if ($res=true){
	header('Location: nuevoPedido.php');
}else{
	header('Location: error.php');
}	
cerrarConexionBD($conexion);



?>