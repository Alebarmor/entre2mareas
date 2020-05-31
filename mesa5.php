<?php
	session_start();

	require_once("gestionBD.php");
	require_once("gestionarMesa.php");
	
	//Se comprueba si no existe en sesión ningún DNI y en tal caso se redirige a la página de login, en caso contrario se mete la sesión del DNI en la variable $dni
	if (!isset($_SESSION['DNI'])) {
   		 header('Location: login.php');
	} else {
    	$dni = $_SESSION['DNI'];
	}	

	
//Definimos variables 	
	$aux=0;//esta es para la representacion(si hay pedidos o no)
	$conexion = crearConexionBD();
	$Total=0; //esta es para el calculo del coste total de la mesa
	$numMesa=5; //numero de mesa

	$filas = consultarProductosMesa($conexion,$numMesa); //devuelve los pedidos de la mesa
	cerrarConexionBD($conexion);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Pedidos</title>
</style>
</head>
<body>	
	<?php
		include_once("cabecera.php");
	?>
<main>
	<table style="width:100%">
  		<td>
   			<nav><button onClick="window.location.href='mesa1.php'"> Mesa 1</button>
			<button onClick="window.location.href='mesa2.php'">Mesa 2</button>
			<button onClick="window.location.href='mesa3.php'">Mesa 3</button>
			<button onClick="window.location.href='mesa4.php'">Mesa 4</button>
			<button onClick="window.location.href='mesa5.php'">Mesa 5</button></nav>
  		</td>
 	 <tr>
  		  <td>
		<fieldset>
				<h2 >Productos Mesa <?php echo $numMesa?></h2>
				<?php
				foreach($filas as $fila) {
			?>
				<article class="menu">
				<form method="post" action="controlador_mesa.php">
					<div class="fila_producto">
						<div class="datos_producto">	
						<input id="OID_PRODUCTO" name="OID_PRODUCTO"	
						value="<?php echo $fila["PRODUCTO"];?>"/> 
  						
						<input id="CANTIDAD" name="CANTIDAD"
						value="<?php echo $fila["CANTIDAD"];?>"/>

						<input id="PRECIO" name="PRECIO"
						value="<?php echo $fila["PRECIO"];
						$aux=$aux+1;
						$Total=$Total+($fila["PRECIO"]*$fila["CANTIDAD"]); ?>€"/>								
					</div>			
				</form>
				<?php } ?>

				<?php if($aux==0) {?>
			
			<br><br><h3>No hay hecho ningún pedido</h3><br><br><br>

			<?php }else{  ?>

				<p>Coste Total = <?php echo $Total?>€</p>
				
  				</div>
 				<form action="datosMesa.php" method="post" >
				<label for="pagado"> Pagado:</label>
  				<input type="checkbox" id=pagado name="paga">
  				<br><br>
  				<label for="val"> Valoración:</label><select name="val" value="Valoracion">
					 <option value="1">1</option>
   					 <option value="2">2</option>
   					 <option value="3">3</option>
   					 <option value="4">4</option>
					 <option  value="5" selected>5</option>
					</select>
				<br><br>
				 <input type="hidden" name="numMesa" value="<?php echo $numMesa;?>"/>
  				<input type="submit" name="sbm" value="Terminar pedido"></form>
 				<?php } ?>
				</fieldset><br>
		   </td>
  	</tr>
	</table>
	
	<input type="button" value="Nuevo Pedido" onClick="window.location.href='nuevoPedido.php'">
</main>
	<?php
		include_once("pie.php");
	?>
</body>
</html>
<?php
	cerrarConexionBD($conexion);
?>