<?php
session_start();
/*
 * De momento no se realiza una conexión a la BD
 * pero puede ser necesaria en un futuro por lo
 * que se han comentado algunas líneas de código
 */
//include_once("gestionbd.php");
if (!isset($_SESSION['formularioTutor'])) {
	$formulario['nombreTutor'] = "";
	$formulario['apellidosTutor'] = "";
	$formulario['dniTutor'] = "";
	$formulario['letraTutor'] = "";
	$formulario['emailTutor'] = "";
	$formulario['fnacTutor'] = date("Y-m-d");
	$formulario['telefonoTutor'] = "";
	$formulario['dniAlumnoTutor'] = "";
	$formulario['letraAlumnoTutor'] = "";
	$_SESSION['formularioTutor'] = $formulario;
} else {
	$formulario = $_SESSION['formularioTutor'];
}

if (isset($_SESSION['erroresTutor'])) {
	$errores = $_SESSION['erroresTutor'];
}

//$conexion = crearConexionBD();
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Formulario Tutor</title>
		<link type="text/css" rel="stylesheet" href="css/cssBase.css">
		<link type="text/css" rel="stylesheet" href="css/formulario.css">
		<script src="scripts/validacionTutor.js"></script>
	</head>

	<body>
		<?php
		include_once ("CabeceraGenerica.php");
		?>

		<div id="erroresTutor"></div>

		<form action="tratamientoFormTutores.php" method="post" onsubmit="return validaTut()">

			<div id="div_nombre">
				<label for="nombreTutor" id="label_nombreTutor">Nombre:</label>
				<input id="nombreTutor" name="nombreTutor" type="text" value="<?php echo $formulario['nombreTutor']; ?>"/>
				</input>
			</div>

			<div id="div_apellidos">
				<label for="apellidosTutor" id="label_apellidosTutor">Apellidos:</label>
				<input id="apellidosTutor" name="apellidosTutor" type="text" value="<?php echo $formulario['apellidosTutor']; ?>"/>
				</input>
			</div>

			<div id="div_dni">
				<label for="dniTutor" id="label_dniTutor">Número DNI:</label>
				<input id="dniTutor" name="dniTutor" type="text" maxlength="8" value="<?php echo $formulario['dniTutor']; ?>"/>
				</input>
				<label for="letraTutor" id="label_letraTutor">Letra:</label>
				<input id="letraTutor" name="letraTutor" type="text" maxlength="1" value="<?php echo $formulario['letraTutor']; ?>"/>
				</input>
			</div>

			<div id="div_email">
				<label for="emailTutor" id="label_emailTutor">Correo electrónico:</label>
				<input id="emailTutor" name="emailTutor" type="email" value="<?php echo $formulario['emailTutor']; ?>"/>
			</div>

			<div id="div_fecha">
				<label for="fnacTutor" id="label_fnacTutor">Fecha de nacimiento:</label>
				<input id="fnacTutor" type="date" name="fnacTutor" step="1" min="1920-01-01" max="<?php echo date("Y-m-d") ?>"/>
			</div>

			<div id="div_telefono">
				<label for="telefonoTutor" id="label_telefonoTutor">Teléfono</label>
				<input id="telefonoTutor" name="telefonoTutor" type="text" maxlength="9" value="<?php echo $formulario['telefonoTutor']; ?>"/>
			</div>

			<div id="div_dni_alumno">
				<label for="dniAlumnoTutor" id="label_dniAlumno">Número DNI Alumno:</label>
				<input id="dniAlumnoTutor" name="dniAlumnoTutor" type="text" maxlength="8" value="<?php echo $formulario['dniAlumnoTutor']; ?>"/>
				</input>
				<label for="letraAlumnoTutor" id="label_letraAlumno">Letra:</label>
				<input id="letraAlumnoTutor" name="letraAlumnoTutor" type="text" maxlength="1" value="<?php echo $formulario['letraAlumnoTutor']; ?>"/>
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