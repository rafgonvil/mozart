<?php
session_start();
/*
 * De momento no se realiza una conexión a la BD
 * pero puede ser necesaria en un futuro por lo
 * que se han comentado algunas líneas de código
 */
//include_once("gestionbd.php");
if (!isset($_SESSION['formulario'])) {
	$formulario['nombre'] = "";
	$formulario['apellidos'] = "";
	$formulario['dni'] = "";
	$formulario['email'] = "";
	$formulario['fnac'] = date("Y-m-d");
	$formulario['telefono'] = "";
	$formulario['curso'] = "";
	$formulario['letra'] = "";
	$formulario['alumno'];
	$_SESSION['formulario'] = $formulario;
} else {
	$formulario = $_SESSION['formulario'];
}

if (isset($_SESSION['errores'])) {
	$errores = $_SESSION['errores'];
}

//$conexion = crearConexionBD();
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Formulario Alumno</title>
		<link type="text/css" rel="stylesheet" href="css/cssBase.css">
		<link type="text/css" rel="stylesheet" href="css/formulario.css">
		<script src="scripts/validacionAlumno.js"></script>
	</head>

	<body>
		<?php
		include_once ("/CabeceraGenerica.php");
		?>

		<div id="errores"></div>

		<form action="tratamientoFormTutores.php" method="post" onsubmit="return validaAlm()">

			<div id="div_nombre">
				<label for="nombre" id="label_nombre">Nombre:</label>
				<input id="nombre" name="nombre" type="text" value="<?php echo $formulario['nombre']; ?>"/>
				</input>
			</div>

			<div id="div_apellidos">
				<label for="apellidos" id="label_apellidos">Apellidos:</label>
				<input id="apellidos" name="apellidos" type="text" value="<?php echo $formulario['apellidos']; ?>"/>
				</input>
			</div>

			<div id="div_dni">
				<label for="dni" id="label_dni">Número DNI:</label>
				<input id="dni" name="dni" type="text" maxlength="8" value="<?php echo $formulario['dni']; ?>"/>
				</input>
				<label for="letra" id="label_letra">Letra DNI:</label>
				<input id="letra" name="letra" type="text" maxlength="1" value="<?php echo $formulario['letra']; ?>"/>
				</input>
			</div>

			<div id="div_email">
				<label for="email" id="label_email">Correo electrónico:</label>
				<input id="email" name="email" type="email" value="<?php echo $formulario['email']; ?>"/>
			</div>

			<div id="div_fecha">
				<label for="fnac" id="label_fnac">Fecha de nacimiento:</label>
				<input id="fnac" type="date" name="fnac" step="1" min="1990-01-01" max="<?php echo date("Y-m-d") ?>">
			</div>

			<div id="div_telefono">
				<label for="telefono" id="label_telefono">Teléfono</label>
				<input id="telefono" name="telefono" type="text" maxlength="9" value="<?php echo $formulario['telefono']; ?>"/>
			</div>

			<div id="div_alumno">
				<label for="alumno" id="label_alumno">Nombre del alumno:</label>
				<input id="alumno" name="alumno" type="text" value="<?php echo $formulario['alumno']; ?>"/>
				</input>
			</div>

			<div id="div_submit">
				<input type="submit" value="Publicar"/>
			</div>
			<div id="div_reset">
				<input type="reset" value="Reset"/>
			</div>
		</form>
		<?php
		include_once ("Pie.php");
		?>
	</body>
</html>

<?php
//scerrarConexionBD($conexion);
?>