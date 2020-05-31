<?php
	session_start();

	require_once("gestionBD.php");
	require_once("gestionarProducto.php");
	require_once("paginacionConsulta.php");
	require_once("gestionarAdministrador.php");

//Verificación de logeo
    if (!isset($_SESSION['DNI'])) {
   	    header('Location: needLogin.php');
    } else { $dni = $_SESSION['DNI'];
    }
         
    $conexion = crearConexionBD();

//Comprobar si el encargado es administrador
    $permiso= consultaEsAdmin($conexion,$dni);

    if ($permiso!=1){
        header('Location: accesoDenegado.php');
    }
	
	if (isset($_SESSION["carta"])){
		$carta = $_SESSION["carta"];
		unset($_SESSION["carta"]);
	}

//Paginación

	if (isset($_SESSION["paginacion"])) $paginacion = $_SESSION["paginacion"]; 
	$pagina_seleccionada = isset($_GET["PAG_NUM"])? (int)$_GET["PAG_NUM"]:
												(isset($paginacion)? (int)$paginacion["PAG_NUM"]: 1);
	$pag_tam = isset($_GET["PAG_TAM"])? (int)$_GET["PAG_TAM"]:
										(isset($paginacion)? (int)$paginacion["PAG_TAM"]: 5);
	if ($pagina_seleccionada < 1) $pagina_seleccionada = 1;
	if ($pag_tam < 1) $pag_tam = 5;

	unset($_SESSION["paginacion"]);


	$conexion = crearConexionBD();

	$query = 'SELECT * FROM CARTA ORDER BY OID_PRODUCTO, PRECIO';

	$total_registros = total_consulta($conexion,$query);
	$total_paginas = (int) ($total_registros / $pag_tam);
	if ($total_registros % $pag_tam > 0) $total_paginas++; 
	if ($pagina_seleccionada > $total_paginas) $pagina_seleccionada = $total_paginas;

	$paginacion["PAG_NUM"] = $pagina_seleccionada;
	$paginacion["PAG_TAM"] = $pag_tam;
	$_SESSION["paginacion"] = $paginacion;

	$filas = consulta_paginada($conexion,$query,$pagina_seleccionada,$pag_tam);
	cerrarConexionBD($conexion);

?>

<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css"  href="css/estilo.css" />
  <title>Editar carta</title>
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
        <td><input id="OID_PRODUCTO" name="oid['.$fila['OID_PRODUCTO'].']" placeholder="'.$fila["OID_PRODUCTO"].'" value="'.$fila["OID_PRODUCTO"].'" required/>
        </td>
        <td><input name="prc['.$fila['OID_PRODUCTO'].'] min="0" id="PRECIO" placeholder="'.$fila["PRECIO"].'" value="'.$fila["PRECIO"].'" required/>
        </td>
        <td><input type="number" name="ctd['.$fila['OID_PRODUCTO'].'] min="0" id="CANTIDAD_DISPONIBLE"  placeholder="'.$fila["CANTIDAD_DISPONIBLE"].'" value="'.$fila["CANTIDAD_DISPONIBLE"].'" required/>
        </td>
        <td><input type="checkbox" name="elim['.$fila['OID_PRODUCTO'].']" placeholder="-">
        </td>
    </tr>';
	
 	} ?>
</table>
	<br>

	<input type="submit" name="actualizar" value="Actualizar">

</form> 
<?php

if(isset($_POST['actualizar'])){
    if(isset($_POST['elim'])){    
        $elims=$_POST['elim'];
    }
        foreach ($_POST['oid'] as $nom)
        {        
            actualizarPrecioCantidad($conexion,$nom,$_POST['prc'][$nom],$_POST['ctd'][$nom]);
    if(isset($elims)){
         if(array_key_exists($nom,$elims)){
            eliminarCarta($conexion,$nom);
		}}
        }
	header("Location:editarCarta.php");
   }
?>


<br><br>

			<div class="paginacion">
				<?php	
					echo "Página";
					for( $pagina = 1; $pagina <= $total_paginas; $pagina++ ) 
						if ( $pagina == $pagina_seleccionada) { 	?>
							<span class="current"><?php echo $pagina_seleccionada; ?></span>
				<?php }	else { ?>			
							<a href="editarCarta.php?PAG_NUM=<?php echo $pagina; ?>&PAG_TAM=<?php echo $pag_tam; ?>"><?php echo $pagina; ?></a>
				<?php } ?>			
			</div>


<br><br>
   
      	<input type="button" id="btnAñadir" value="¿Añadir elemento a carta?" />
	<div name"add element">
	<fieldset>
	<table>
	<form method="post" >
	<table >
		<td><input id="nuevo producto" name="n_prod" placeholder="Escribe aqui el nombre del producto" value="" required/>
		</td>
		<td><input id="nueva precio" name="n_precio" placeholder="aqui su precio" value="" required/>
		</td>
		<td><input type=number id="nueva cantidad" name="n_cant" placeholder="aqui su cantidad" value="" required/>	
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
        if (!headers_sent()) {
        header("Location:editarCarta.php");
    }
    }
?>

	</fieldset>
	</div>

<br><br>

	<form action="carta.php">

		<input type="submit" value="Volver a la carta">

	</form>


	</body>

	<?php	include_once("pie.php");
	?>
        
</html>
