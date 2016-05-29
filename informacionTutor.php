<?php
    session_start();
    include_once("gestionBD.php");
    
    if (!isset($_SESSION['tutor'])) {
        Header("Location:tutores.php");
    }
    
    $tutor = $_SESSION['tutor'];
    
    if (!isset($_SESSION['formMod'])) {
        $formMod['email'] = $tutor['EMAIL'];
        $formMod['telefono'] = $tutor['TELEFONO'];
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
        <title>Información Tutor</title>
        <script src="scripts/funcionesInformacion.js"></script>
    </head>
    <body>
        <h1>Panel de control</h1>
        <h3>Información sobre <?php echo $tutor['NOMBRE']; ?>:</h3>
        <div id="tabla_info">
            <table>
                <tr>
                    <th>DNI</th>
                    <th>Email</th>
                    <th>Fecha de nacimiento</th>
                    <th>Teléfono</th>
                    <th>Alumno</th>
                </tr>
                <tr>
                    <td><?php echo $tutor['DNI']; ?></td>
                    <td><?php echo $tutor['EMAIL']; ?></td>
                    <td><?php echo $tutor['FECHA_NACIMIENTO']; ?></td>
                    <td><?php echo $tutor['TELEFONO']; ?></td>
                    <td><?php echo $tutor['ALUMNO']; ?></td>
                </tr>
            </table>
        </div>
        <div id="erroresModificacion"></div>
        <!-- Inicialmente el formulario de modificación se oculta -->
        <!-- El parámetro de style debería estar definido en el css de esta página -->
        <div id="camposModificar" style="display: none">
            <form method="post" action="tratamientoInformacionTutor.php" onsubmit="return validaMod()">
                <div id="div_email">
                    <label for="input_email" id="label_input_email">Nuevo correo electrónico:</label>
                    <input name="input_email" id="input_email" type="email" maxlength="50" value="<?php echo $formMod['email']; ?>" />
                </div>
                <div id="div_telefono">
                    <label for="input_telefono" id="label_input_telefono">Nuevo teléfono:</label>
                    <input name="input_telefono" id="input_telefono" type="text" maxlength="9" value="<?php echo $formMod['telefono']; ?>" />
                </div>
                <div id="div_submit">
                    <button id="input_submit" name="input_submit" type="submit">Subir cambios</button>
                    <button id="hide" name="hide" type="button" onclick="ocultarCamposModificar()">Descartar</button>
                </div>
            </form>
        </div>
        <div id="botones">
            <button id="boton_modificar" onclick="mostrarCamposModificar()">Modificar</button>
        </div>
    </body>
</html>
<?php cerrarConexionBD($conexion); ?>