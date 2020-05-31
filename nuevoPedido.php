<?php
//En esta pagina se enseña la carta para seleccionar un pedido
session_start();

require_once("gestionBD.php");
require_once("gestionarStock.php");

if (!isset($_SESSION['DNI'])) {
   	 header('Location: needLogin.php');
}

$conexion = crearConexionBD();

$datosCarta = consultarCartaStock($conexion);

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
             <main>
         <p>
        	<a href="logout.php">Desconectar</a>
	</p>
          
              <h1>Nuevo Pedido</h1> 
	<form action="accionNuevoPedido.php" method="get" >
    <fieldset>  
	 <legend>Introduzca nuevo pedido</legend>
      <div>
<?php
 foreach ($datosCarta as $value) {
?>
          <label for="Carta"><?php echo $value["0"];?>.............<?php echo $value["1"];?>€</label> 
		  <a href="accionNuevoPedido.php? nombre=<?php echo $value["0"] ?> &precio=<?php echo $value["1"] ?>">Añadir al pedido</a> 
		  <br>
           
<?php } ?>
	</fieldset>
        
	<a href="mesa1.php">Terminar</a>
	
	</form> 
<footer>
<?php
		include_once ("pie.php");
		?>
</footer>

