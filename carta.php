<?php
	session_start();

//Requires
	require_once("gestionBD.php");
	require_once("gestionarCarta.php");
	require_once("paginacionConsulta.php");
	
	if (isset($_SESSION["carta"])){
		$carta = $_SESSION["carta"];
		unset($_SESSION["carta"]);
	}

//Añadir la paginación
	if (isset($_SESSION["paginacion"])) $paginacion = $_SESSION["paginacion"]; 
	$pagina_seleccionada = isset($_GET["PAG_NUM"])? (int)$_GET["PAG_NUM"]:
		(isset($paginacion)? (int)$paginacion["PAG_NUM"]: 1);
	$pag_tam = isset($_GET["PAG_TAM"])? (int)$_GET["PAG_TAM"]:
		(isset($paginacion)? (int)$paginacion["PAG_TAM"]: 5);
	if ($pagina_seleccionada < 1) $pagina_seleccionada = 1;
	if ($pag_tam < 1) $pag_tam = 5;

	unset($_SESSION["paginacion"]);

//Se crea la conexión a la BBDD
	$conexion = crearConexionBD();

//Query que devuelve los productos, cuya cantidad disponible es mayor a 1
	$query = 'SELECT * FROM CARTA'
		. ' WHERE (CARTA.CANTIDAD_DISPONIBLE >= 1)'
		. ' ORDER BY OID_PRODUCTO, PRECIO';

	$total_registros = total_consulta($conexion,$query);
	$total_paginas = (int) ($total_registros / $pag_tam);
	if ($total_registros % $pag_tam > 0) $total_paginas++; 
	if ($pagina_seleccionada > $total_paginas) $pagina_seleccionada = $total_paginas;

	$paginacion["PAG_NUM"] = $pagina_seleccionada;
	$paginacion["PAG_TAM"] = $pag_tam;
	$_SESSION["paginacion"] = $paginacion;

	$filas = consulta_paginada($conexion,$query,$pagina_seleccionada,$pag_tam);

//Se cierra la conexión
	cerrarConexionBD($conexion);

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="css/biblio.css" />
  <title>Carta</title>
</head>

<body>

<?php
	include_once("cabecera.php");
?>

	<section class="main">
			
			</div>
			<div class="up">
 			<span class="icon icon-up-open"></span>
 			</div>
 			
<!--Paginación: seleccionar el número de productos por página-->
		<div class="wrapp">
			<div class="mensaje">
				<h1>CARTA</h1>
			</div>
			<div class="paginacion">
			<form method="get" action="carta.php">
				<div class="paginacion">
					<input id="PAG_NUM" name="PAG_NUM" type="hidden" value="<?php echo $pagina_seleccionada;?>"/>
						Mostrando 
					<input id="PAG_TAM" name="PAG_TAM" type="number" min="5" max="<?php echo $total_registros;?>" 
					value="<?php echo $pag_tam?>" autofocus="autofocus" /> 
						de <?php echo $total_registros?>
				</div>
			</form>

<!--Productos-->
		<main>
			<?php
				foreach($filas as $fila) {
			?>
		
			<article class="carta">
				<form method="post" action="controladorCarta.php">
					<div class="fila_producto">
						<div class="datos_producto">		
							<input id="OID_PRODUCTO" name="OID_PRODUCTO"
								 value="<?php echo $fila["OID_PRODUCTO"]; ?>"/>
							<input id="PRECIO" name="PRECIO"
								 value="<?php echo $fila["PRECIO"]; ?>"/>
							<input id="CANTIDAD_DISPONIBLE" name="CANTIDAD_DISPONIBLE"
								 value="<?php echo $fila["CANTIDAD_DISPONIBLE"]; ?>"/>											
					</div>
				</form>
				<?php } ?>
<!--Paginación: seleccionar la página-->
					  	<div class="paginacion">
							<?php	
								echo "Página";
								for( $pagina = 1; $pagina <= $total_paginas; $pagina++ ) 
									if ( $pagina == $pagina_seleccionada) { 	?>
										<span class="current"><?php echo $pagina_seleccionada; ?></span>
							<?php }	else { ?>			
										<a href="carta.php?PAG_NUM=<?php echo $pagina; ?>&PAG_TAM=<?php echo $pag_tam; ?>"><?php echo $pagina; ?></a>
							<?php } ?>			
						</div>
								
			</article>
		</section>
			
	</main>

<?php
	include_once("pie.php");
?>

</body>
</html>