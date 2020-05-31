<?php
	session_start();

	require_once("gestionBD.php");
	require_once("gestionarMenu.php");
	require_once("paginacion_consulta.php");
	
	if (isset($_SESSION["carta"])){
		$carta = $_SESSION["carta"];
		unset($_SESSION["carta"]);
	}

	if (isset($_SESSION["paginacion"])) $paginacion = $_SESSION["paginacion"]; 
	$pagina_seleccionada = isset($_GET["PAG_NUM"])? (int)$_GET["PAG_NUM"]:
												(isset($paginacion)? (int)$paginacion["PAG_NUM"]: 1);
	$pag_tam = isset($_GET["PAG_TAM"])? (int)$_GET["PAG_TAM"]:
										(isset($paginacion)? (int)$paginacion["PAG_TAM"]: 5);
	if ($pagina_seleccionada < 1) $pagina_seleccionada = 1;
	if ($pag_tam < 1) $pag_tam = 5;

	unset($_SESSION["paginacion"]);


	$conexion = crearConexionBD();

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

//$filas = consultarComidasDisponibles($conexion);

	$filas = consulta_paginada($conexion,$query,$pagina_seleccionada,$pag_tam);

	cerrarConexionBD($conexion);

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="css/biblio.css" />
  <title>Entre Dos Mareas: Menu</title>
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
 			
		<div class="wrapp">
			<div class="mensaje">
				<h1>MENU</h1>
			</div>
			<div class="paginacion">
			<form method="get" action="menu.php">
				<div class="paginacion">
									<input id="PAG_NUM" name="PAG_NUM" type="hidden" value="<?php echo $pagina_seleccionada;?>"/>
									Mostrando 
									<input id="PAG_TAM" name="PAG_TAM" type="number" min="5" max="<?php echo $total_registros;?>" 
									value="<?php echo $pag_tam?>" autofocus="autofocus" /> 
									de <?php echo $total_registros?>
								
					</div>
			</form>

		<main>
					
			<?php
				foreach($filas as $fila) {
			?>
		
			<article class="menu">
				<form method="post" action="controlador_menu.php">
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
				
					  	<div class="paginacion">
								
									<?php	
										echo "Página";
										for( $pagina = 1; $pagina <= $total_paginas; $pagina++ ) 
											if ( $pagina == $pagina_seleccionada) { 	?>
												<span class="current"><?php echo $pagina_seleccionada; ?></span>
									<?php }	else { ?>			
												<a href="menu.php?PAG_NUM=<?php echo $pagina; ?>&PAG_TAM=<?php echo $pag_tam; ?>"><?php echo $pagina; ?></a>
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