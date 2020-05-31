<?php
  /*
     * #===========================================================#
     * #	Este fichero contiene las funciones de gestión
     * #	de usuarios de la capa de acceso a datos
     * #==========================================================#
     */

// APARTADO 3.1
 function alta_usuario($conexion,$usuario) {
 	// RECUERDA QUE EL FORMATO DE FECHA PARA ORACLE ES "d/m/Y"
 	$fechaNacimiento = date('d/m/Y', strtotime($usuario["fechaNacimiento"]));
	// BUSCA LA OPERACIÓN ALMACENADA "INSERTAR_USUARIO" EN SQL
	// 			PARA SABER CUÁLES SON SUS PARÁMETROS.
	// RECUERDA QUE SE INVOCA MEDIANTE 'CALL' EN PL/SQL
	// UTILIZA EL MÉTODO "PREPARE" DEL OBJETO PDO
	// RECUERDA EL TRY/CATCH
	try {
		$consulta = "CALL INSERTAR_USUARIO(:nif, :nombre, :apellidos, :fecha, :email, :pass, :perfil)";
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':nif',$usuario["nif"]);
		$stmt->bindParam(':nombre',$usuario["nombre"]);
		$stmt->bindParam(':apellidos',$usuario["apellidos"]);
		$stmt->bindParam(':fecha',$fechaNacimiento);
		$stmt->bindParam(':email',$usuario["email"]);
		$stmt->bindParam(':pass',$usuario["pass"]);
		$stmt->bindParam(':perfil',$usuario["perfil"]);
		
		$stmt->execute();
		
		return true;
		
	}catch(PDOException $e){
		return false;
	}
	
}

function consultarUsuario($conexion,$email,$pass) {
 	$consulta = "SELECT COUNT(*) AS TOTAL FROM USUARIOS WHERE EMAIL=:email AND PASS=:pass";
	$stmt = $conexion->prepare($consulta);
	$stmt->bindParam(':email',$email);
	$stmt->bindParam(':pass',$pass);
	$stmt->execute();
	return $stmt->fetchColumn();
	
}


