﻿<?php
//Inicio de sesiones
	session_start();

//Requires
	require_once("gestionBD.php");
	require_once("gestionarProducto.php");
	require_once("paginacion_consulta.php");
	
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

//Query que devuelve los productos
	$query = 'SELECT * FROM CARTA ORDER BY OID_PRODUCTO, PRECIO';

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

<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css"  href="css/estilo.css" />
  <title>Editar Carta</title>
</head>
<style>
table {
  border-collapse: collapse;
}

tr:first-child {
 	border-bottom: solid;
	border-width: 1px 0;
}

</style>

<body>

	<?php
		include_once("cabecera.php");
	?>

	<h2>Editar Carta</h2>
	<form method="post" >
	<table style="width:45%">
	<tr>
			<th align="left">Producto</th>
			<th align="left">Precio</th>
			<th align="left">Cantidad</th>
		<th align="left"></th>
	</tr>

	<?php
		foreach($filas as $fila) {
	echo'<tr>
		<td><input id="OID_PRODUCTO" name="oid['.$fila['OID_PRODUCTO'].']" placeholder="$fila["OID_PRODUCTO"]" value="'.$fila["OID_PRODUCTO"].'" required/>
		</td>
		<td><input name="prc['.$fila['OID_PRODUCTO'].'] min="0" step=".01" id="PRECIO" placeholder="'.$fila["PRECIO"].'" value="'.$fila["PRECIO"].'" required/>
		</td>
		<td><input name="ctd['.$fila['OID_PRODUCTO'].'] min="0" id="CANTIDAD_DISPONIBLE"  placeholder="'.$fila["CANTIDAD_DISPONIBLE"].'" value="'.$fila["CANTIDAD_DISPONIBLE"].'" required/>
		</td>
		<td><input type="checkbox" name="">
		</td>
	</tr>';
	} ?>

	</table>
		<br>
		<input type="submit" name="actualizar" value="Actualizar carta">
	</form> 
<?php

	if(isset($_POST['actualizar']))
	{
		foreach ($_POST['oid'] as $nom)
		{
			actualizarPrecioCantidad($conexion,$nom,$_POST['prc'][$nom],$_POST['ctd'][$nom]);
		}

		if(actualizar==true)
		{
			header("Location: menu.php");
		}

		else
		{
			echo "NO FUNCIONA!";
		}
	}
?>

<br><br>
   
      	<input type="button" id="btnAñadir" value="¿Añadir elemento a carta?" />
	<div name"add element">
		<fieldset>
		<table>
	<form method="post" >
		<table >
			<td><input id="nuevo producto" name="n_prod" placeholder="Nombre" value="" required/>
			</td>
			<td><input id="nueva precio" name="n_precio" placeholder="Precio" value="" required/>
			</td>
			<td><input type=number id="nueva cantidad" name="n_cant" placeholder="Cantidad Disponible" value="" required/>	
			</td>
		</table>
		<input type="submit" name="sbm" value="Añadir Nuevo Pedido">
	</form>
<?php

	if(isset($_POST['sbm']))
    {
		$nom=$_POST['n_prod'];
		$prc=$_POST['n_precio'];
		$ctd=$_POST['n_cant'];
	insertarCarta($conexion,$nom,$prc,$ctd);

		if(sbm==true)
		{
			header("Location: editar_carta.php");
		}

		else
		{
			echo "NO FUNCIONA!";
		}
    }
?>

		</fieldset>
	</div>
</body>

	<?php	include_once("pie.php");
	?>
        
</html>
