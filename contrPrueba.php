<?php
	session_start();
	require_once("gestionBD.php");
	require_once("gestionarProducto.php");
	require_once("paginacion_consulta.php");
	$conexion = crearConexionBD();
	$oids=$_POST['oid'];
	$prcs=$_POST['prc'];
	$ctds=$_POST['ctd'];
	$car="____";
        foreach ($_POST['oid'] as $nom)
        { 
		
    	    //$prc = mysqli_real_escape_string($conexion, $_POST['prc'][$nom]);
   	    //$editCantidad = mysqli_real_escape_string($conexion, $_POST['ctd'][$nom]); 			 
            echo $nom;
	    echo $_POST['prc'][$nom];
            echo $_POST['ctd'][$nom];	
		echo $car;	 
        }
       // print_r($oids);
	//for($i = 0, $size = count($oids); $i < $size; ++$i) {
        //echo $oids[$i];
	//}
	cerrarConexionBD($conexion);
?>