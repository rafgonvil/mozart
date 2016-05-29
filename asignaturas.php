<?php
session_start();
include_once ("gestionBD.php");
include_once ("gestionEntradasAsignaturas.php");
include_once ("gestionEntradasAlumnos.php");

if (!isset($_SESSION['alumno'])) {
	Header("Location:alumnos.php");
}

$alumno = $_SESSION['alumno'];

$conexion = crearConexionBD();
		?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Información Alumno</title>
        <link type="text/css" rel="stylesheet" href="css/cssBase.css" />
        <link type="text/css" rel="stylesheet" href="css/formulario.css" />

    </head>
    <body>
    	<?php
		include_once ("CabeceraGenerica.php");
	?>
        <h1>Panel de control</h1>
        <h3>Asignaturas de  <?php echo $alumno['NOMBRE']; ?>:</h3>
        <div id="tabla_info">
				 <table id="tabla_listado">
                        <tr>
                            <th>Nombre</th>
                            <th>Profesor</th>
                            <th>Curso</th>
                            <th>Especialidad</th>
                            <th>Nota</th>
                        </tr>

                    <?php
                    	$asignaturas = consultarAsignaturasAlumno($conexion, $alumno['OID_P']);
                        foreach($asignaturas as $asignatura) {
                            $esp = consultarEspecialidadAsignatura($conexion, $asignatura['ESPECIALIDAD']);
                            $prof = consultarProfesorAsignatura($conexion, $asignatura['PROFESOR']);
							$curso = consultarCursoAsignatura($conexion, $asignatura['ALUMNO']);
							$nota = consultarNotaAsignatura($asignatura['OID_A'], $conexion);
                    ?>
                   	<form method="post" action="procesarAsignatura.php">
                   		<input id="ALUMNO" name="ALUMNO" type="hidden" value="<?php echo $alumno['OID_P']; ?>" />
                        <input id="OID_A" name="OID_A" type="hidden" value="<?php echo $asignatura['OID_A']; ?>" />
                        <input id="NOMBRE" name="NOMBRE" type="hidden" value="<?php echo $asignatura['NOMBRE']; ?>" />
                        <input id="PROFESOR" name="PROFESOR" type="hidden" value="<?php echo $prof; ?>" />
                        <input id="CURSO" name="CURSO" type="hidden" value="<?php echo $curso; ?>" />
                        <input id="ESPECIALIDAD" name="ESPECIALIDAD" type="hidden" value="<?php echo $esp; ?>" />
                        <input id="NOTA" name="NOTA" type="hidden" value="<?php echo $nota; ?>" />
                        <tr class="asignatura">
                            <td><?php echo $asignatura['NOMBRE']; ?></td>
                            <td><?php echo $prof; ?></td>
                            <td><?php echo $curso; ?></td>
                            <td><?php echo $esp; ?></td>
                            <td><?php echo $nota; ?></td>
                            <td><button id="punt" name="punt" type="submit">Puntuar</button></td>
                        </tr>
					</form>

                    <?php
					}
                    ?>
                    </table>
            <br />
        </div>

        <?php
		include_once ("pie.php");
 ?>
    </body>
</html>
<?php cerrarConexionBD($conexion); ?>