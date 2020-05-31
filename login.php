<?php

session_start();

//Elimino la sesión de DNI en el caso de que exista

if (isset($_SESSION['errores'])) {
	$errores = $_SESSION['errores'];
}

if (isset($_SESSION['DNI'])) {
   	    header('Location: yetLogin.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<title>Login</title>
	<link rel="stylesheet" href="css/estilos.css">
</head>
<body>	

<?php
	include_once("cabecera.php");
?>

<div class="columnas">
	
	<section class="main">
		<div class="wrapp">
			
			<div class="col-2 col-tab-4">
			<div class="mensaje">
				<h1>ACCESO</h1>
			</div>
			</div>
			
			<div class="col-6 col-tab-6">
			<div class="articulo">
				<?php 
						//Se comprueba si existe en sesión algún error y en tal caso se mete en la variable $errores
						if (isset($_SESSION['errores'])) {
					?>
							<div class="errores">
									<ul>
						<?php		
									$errores = $_SESSION['errores'];
									unset($_SESSION['errores']);
									
									foreach ($errores as $error ) {
										echo "<li> $error </li>";
									}
						?>	
									</ul>
							</div>
					<?php	
						}
					?>
					<br />
					
				<form id='formulario' action='controladorLogin.php' method='POST'>
					
					<fieldset class='inicio'>
					<br>
						<label for="usuario">Usuario</label></br>
						<input <?php if(isset($errores) && empty($usuario)){ ?>class='userFallo'<?php }?> id='user' name='OID_DNI' type='text' value='<?php if (!empty($usuario)) { echo $usuario; }?>' /><br /></br>
						<label for="contraseña">Contraseña</label></br>
						<input <?php if(isset($errores) && empty($contrasenia)){ ?>class='passFallo'<?php }?> id='pass' name='PASS' onkeypress='isMayus(event);' type='password' value='<?php if (!empty($usuario)) { echo $contrasenia; }?>' /></br>
						<div class='mayus' style='display:none'>
							<p>El block mayus está activado</p>
						</div><br/>
						<input id='enviar' name='enviar' type='submit' value='Login'/>
						
					</fieldset>

				</form>
					
			</div>
			</div>
		</div>
	</section>
	
	<div class="col-2 col-tab-10">
	<footer>
		<div class="wrapp">
			<p>ENTRE2MAREAS.com</p>
		</div>
	</footer>
	</div>
<?php
	include_once("pie.php");
?>
</body>
</html>