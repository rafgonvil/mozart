<?php
session_start();
/*
 * De momento no se realiza una conexión a la BD
 * pero puede ser necesaria en un futuro por lo
 * que se han comentado algunas líneas de código
 */
//include_once("gestionbd.php");
if (!isset($_SESSION['formularioAlumno'])) {
	$formulario['nombreAlumno'] = "";
	$formulario['apellidosAlumno'] = "";
	$formulario['dniAlumno'] = "";
	$formulario['emailAlumno'] = "";
	$formulario['fnacAlumno'] = date("Y-m-d");
	$formulario['telefonoAlumno'] = "";
	$formulario['cursoAlumno'] = "";
	$formulario['especialidadAlumno'] = "";
	$formulario['letraAlumno'] = "";
	$_SESSION['formularioAlumno'] = $formulario;
} else {
	$formulario = $_SESSION['formularioAlumno'];
}

if (isset($_SESSION['erroresAlumno'])) {
	$errores = $_SESSION['erroresAlumno'];
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
		include_once ("CabeceraGenerica.php");
	?>    
        
        <div id="erroresAlumno"></div>
        
        <form action="tratamientoFormAlumnos.php" method="post" onsubmit="return validaAlm()">
        
            <div id="div_nombre">
                <label for="nombreAlumno" id="label_nombre">Nombre:</label>
                <input id="nombreAlumno" name="nombreAlumno" type="text" value="<?php echo $formulario['nombreAlumno']; ?>"/></input>
            </div>
            
            <div id="div_apellidos">
                <label for="apellidosAlumno" id="label_apellidos">Apellidos:</label>
                <input id="apellidosAlumno" name="apellidosAlumno" type="text" value="<?php echo $formulario['apellidosAlumno']; ?>"/></input>
            </div>
            
            <div id="div_dni">
                <label for="dniAlumno" id="label_dni">Número DNI:</label>
                <input id="dniAlumno" name="dniAlumno" type="text" maxlength="8" value="<?php echo $formulario['dniAlumno']; ?>"/></input>
                <label for="letraAlumno" id="label_letra">Letra:</label>
                <input id="letraAlumno" name="letraAlumno" type="text" maxlength="1" value="<?php echo $formulario['letraAlumno']; ?>"/></input>
            </div>
            
            <div id="div_email">
                <label for="emailAlumno" id="label_email">Correo electrónico:</label>
                <input id="emailAlumno" name="emailAlumno" type="email" value="<?php echo $formulario['emailAlumno']; ?>"/>
            </div>

            <div id="div_fecha">
                <label for="fnacAlumno" id="label_fnac">Fecha de nacimiento:</label>
                <input id="fnacAlumno" type="dateAlumno" name="fnac" step="1" min="1990-01-01" max="<?php echo date("Y-m-d") ?>">
            </div>
            
            <div id="div_telefono">
                <label for="telefonoAlumno" id="label_telefono">Teléfono</label>
                <input id="telefonoAlumno" name="telefonoAlumno" type="text" maxlength="9" value="<?php echo $formulario['telefonoAlumno']; ?>"/>
            </div>
            
            <div id="div_curso">
                <label for="cursoAlumno" id="label_curso">Curso:</label>
                <select id="cursoAlumno" name="cursoAlumno" size="1">
                    <option selected="selected"><?php echo $formulario['cursoAlumno']; ?></option>
                    <option>MÚSICA Y MOVIMIENTO 1</option>
                    <option>MÚSICA Y MOVIMIENTO 2</option>
                    <option>MÚSICA Y MOVIMIENTO 3</option>
                    <option>PREPARATORIO 1</option>
                    <option>PREPARATORIO 2</option>
                    <option>PRIMERO ELEMENTAL</option>
                    <option>SEGUNDO ELEMENTAL</option>
                    <option>TERCERO ELEMENTAL</option>
                    <option>CUARTO ELEMENTAL</option>
                    <option>ADULTOS</option>
                    <option>SOLO INSTRUMENTO</option>
                </select>
            </div>

            <div id="div_especialidad">
                <label for="especialidadAlumno" id="label_especialidad">Especialidad</label>
                <input id="especialidadAlumno" name="especialidadAlumno" type="text" value="<?php echo $formulario['especialidadAlumno']; ?>" />
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