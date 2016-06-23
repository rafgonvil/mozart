<?php
session_start();
require_once ("gestionBD.php");
require_once ("gestionEntradasAlumnos.php");

$conexion = crearConexionBD();

$numero_pagina = isset($_GET['numero_pagina']) ? (int)$_GET['numero_pagina'] : 1;
$tam_pagina = isset($_GET['tam_pagina']) ? (int)$_GET['tam_pagina'] : 10;

if ($numero_pagina < 1)
	$numero_pagina = 1;
if ($tam_pagina < 1)
	$tam_pagina = 10;

$total = consultarTotalAlumnos($conexion);
$paginas_totales = (int)($total / $tam_pagina);

if ($total % $tam_pagina > 0)
	$paginas_totales++;

if ($numero_pagina > $paginas_totales)
	$numero_pagina = 1;
?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Gestión de centro: Alumnos</title>
        <link type="text/css" rel="stylesheet" href="css/cssBase.css" />
    </head>
    
    <body>
    	<?php
		include_once ("CabeceraGenerica.php");
	?>
        <div id="contenidos">
            <div id="alumnos">
                <div id="paginacion">
                    
                        <?php 
                            for($pag = 1; $pag <= $paginas_totales; $pag++) {
                                if ($pag == $numero_pagina) { 
                        ?>
                        <span class="actual"><?php echo $pag; ?></span>
                        <?php
						} else {
                        ?>
                        <a href="alumnos.php?numero_pagina=<?php echo $pag; ?>&tam_pagina=<?php echo $tam_pagina; ?>"><?php echo $pag; ?></a>
                        <?php
						}
						}
                        ?>
                        <form method="get" action="alumnos.php">
                        <input id="numero_pagina" name="numero_pagina" type="hidden" value="<?php echo $numero_pagina; ?>" />
                        Mostrando
                        <input id="tam_pagina" name="tam_pagina" type="number" min="1" max="<?php echo $total; ?>"
                         value="<?php echo $tam_pagina; ?>" autofocus="autofocus" />
                        entradas de <?php echo $total; ?>
                        <input type="submit" value="Cambiar" />
                    </form>
                </div>
                <div id="listado">
                    <table id="tabla_listado">
                        <tr>
                            <th>Nombre</th>
                            <th>DNI</th>
                            <th>Email</th>
                            <th>Fecha de nacimiento</th>
                            <th>Teléfono</th>
                            <th>Curso</th>
                            <th>Especialidad</th>
                        </tr>

                    <?php
                        $filas = consultarPaginaAlumnos($conexion, $numero_pagina, $tam_pagina, $total);
                        foreach($filas as $fila) {
                            $esp = consultarEspecialidadAlumno($conexion, $fila['OID_P']);
                    ?>
                    <form method="post" action="procesarAlumno.php">
                        <input id="OID_P" name="OID_P" type="hidden" value="<?php echo $fila['OID_P']; ?>" />
                        <input id="NOMBRE" name="NOMBRE" type="hidden" value="<?php echo $fila['NOMBRE']; ?>" />
                        <input id="DNI" name="DNI" type="hidden" value="<?php echo $fila['DNI']; ?>" />
                        <input id="EMAIL" name="EMAIL" type="hidden" value="<?php echo $fila['EMAIL']; ?>" />
                        <input id="FECHA_NACIMIENTO" name="FECHA_NACIMIENTO" type="hidden" value="<?php echo $fila['FECHA_NACIMIENTO']; ?>" />
                        <input id="TELEFONO" name="TELEFONO" type="hidden" value="<?php echo $fila['TELEFONO']; ?>" />
                        <input id="CURSO" name="CURSO" type="hidden" value="<?php echo $fila['CURSO']; ?>" />
                        <input id="ESPECIALIDAD" name="ESPECIALIDAD" type="hidden" value="<?php echo $esp; ?>" />
                        <tr class="alumno">
                            <td><?php echo $fila['NOMBRE']; ?></td>
                            <td><?php echo $fila['DNI']; ?></td>
                            <td><?php echo $fila['EMAIL']; ?></td>
                            <td><?php echo $fila['FECHA_NACIMIENTO']; ?></td>
                            <td><?php echo $fila['TELEFONO']; ?></td>
                            <td><?php echo $fila['CURSO']; ?></td>
                            <td><?php echo $esp; ?></td>
                            <td><button id="info" name="info" type="submit">Administrar</button></td>
                            <td><button id="asig" name="asig" type="submit">Asignaturas</button></td>
                        </tr>
                    </form>

                    <?php
					}
                    ?>
                    </table>
                </div>
            </div>
        </div>
        
        <?php
			include_once ("pie.php");
			cerrarConexionBD($conexion);
        ?>
    </body>
</html>