<?php
    session_start();
    include_once("gestionBD.php");
    if (!isset($_SESSION['alumno'])) {
        Header("Location:alumnos.php");
    }
    
    $alumno = $_SESSION['alumno'];
    // unset($_SESSION['alumno']);
    
    if (!isset($_SESSION['formMod'])) {
        $formMod['email'] = $alumno['EMAIL'];
        $formMod['telefono'] = $alumno['TELEFONO'];
        $_SESSION['formMod'] = $formMod;
    } else {
        $formMod = $_SESSION['formMod'];
    }
    $conexion = crearConexionBD();
?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Información Alumno</title>
        <script src="scripts/funcionesInformacionAlumno.js"></script>
        <link type="text/css" rel="stylesheet" href="css/cssBase.css" />
        <link type="text/css" rel="stylesheet" href="css/formulario.css" />

    </head>
    <body>
    	<?php include_once ("CabeceraGenerica.php");?>
        <h1>Panel de control</h1>
        <h3>Información sobre <?php echo $alumno['NOMBRE']; ?>:</h3>
        <div id="tabla_info">
            <table>
                <tr>
                    <th>DNI</th>
                    <th>Email</th>
                    <th>Fecha de nacimiento</th>
                    <th>Teléfono</th>
                    <th>Curso</th>
                    <th>Especialidad</th>
                </tr>
                <tr>
                    <td><?php echo $alumno['DNI']; ?></td>
                    <td><?php echo $alumno['EMAIL']; ?></td>
                    <td><?php echo $alumno['FECHA_NACIMIENTO']; ?></td>
                    <td><?php echo $alumno['TELEFONO']; ?></td>
                    <td><?php echo $alumno['CURSO']; ?></td>
                    <td><?php echo $alumno['ESPECIALIDAD']; ?></td>
                    <td> 
                    <button id="boton_modificar" onclick="mostrarCamposModificar()">Modificar</button>
                    </td>
                </tr>
            </table>
            <br />
        </div>
        <div id="erroresModificacion"></div>
        
        <!-- Inicialmente el formulario de modificación se oculta -->
        <div id="camposModificar" style="display: none">
            <form method="post" action="tratamientoInformacionAlumno.php" onsubmit="return validaMod()">
                <div id="div_email">
                    <label for="input_email" id="label_input_email"><b> Nuevo correo electrónico: </b> </label>
                    <input name="input_email" id="input_email" type="email" maxlength="50" value="<?php echo $formMod['email']; ?>" />
                </div>
                <div id="div_telefono">
                    <label for="input_telefono" id="label_input_telefono"><b> Nuevo teléfono: </b> </label>
                    <input name="input_telefono" id="input_telefono" type="text" maxlength="9" value="<?php echo $formMod['telefono']; ?>" />
                </div>
                <div id="div_submit">
                    <button id="input_submit" name="input_submit" type="submit">Subir cambios</button>
                    <button id="hide" name="hide" type="button" onclick="ocultarCamposModificar()">Descartar</button>
                </div>
            </form>
        </div>
        <div id="botones">
        </div>
        <?php include_once ("pie.php"); ?>
    </body>
</html>
<?php cerrarConexionBD($conexion); ?>