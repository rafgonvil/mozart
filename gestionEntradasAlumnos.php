<?php
function insertarAlumno($nombre, $apellidos, $numDni, $letraDni, $email, $fnac, $telefono, $conexion) {
	try {
		$fnacFormateada = DateTime::createFromFormat('Y-m-d', $fnac) -> format('d-m-Y');
		$dniFinal = $numDni . $letraDni;
		$nombreFinal = $nombre . " " . $apellidos;
		$stmt = $conexion -> prepare('CALL INSERTAR_ALUMNO(:dni,:nombre,
                                       :fecha,:telefono,:email)');
		$stmt -> bindParam(':dni', $dniFinal);
		$stmt -> bindParam(':nombre', $nombreFinal);
		$stmt -> bindParam(':fecha', $fnacFormateada);
		$stmt -> bindParam(':telefono', $telefono);
		$stmt -> bindParam(':email', $email);
		$stmt -> execute();
	} catch (PDOException $e) {
		$_SESSION['excepcion'] = $e -> getMessage();
		Header("Location:error.php");
	}
	return $stmt;
}

function insertarMatricula($curso, $especialidad, $numDni, $letraDni, $conexion) {
	try {
		$oid;
		$dniFinal = $numDni . $letraDni;
		$anyo = (int)date('Y');
		$stmt = $conexion -> prepare('SELECT OID_P FROM PERSONA WHERE DNI = :dni');
		$stmt -> bindParam(':dni', $dniFinal);
		$stmt -> execute();
		foreach ($stmt as $fila) {
			$oid = $fila['OID_P'];
		}

<<<<<<< HEAD
        } catch (PDOException $e) {
            $_SESSION['excepcion'] = $e->getMessage();
            Header("Location:error.php");
        }
    }
    
    function consultarTotalAlumnos($conexion)
    {
        try {
            $consulta = "SELECT COUNT(*) AS TOTAL FROM ALUMNO";
            $stmt = $conexion -> query($consulta);
            $res = $stmt->fetch();
            $total = $res['TOTAL'];
            return (int)$total;            
        } catch (PDOException $e) {
            $_SESSION['excepcion'] = $e->getMessage();
            Header("Location:error.php");
        }
    }
    
    function consultarEspecialidadAlumno($conexion, $oid)
    {
        try {
            $consulta = "SELECT ESPECIALIDAD.NOMBRE FROM TIENE, ESPECIALIDAD ".
                       "WHERE (TIENE.ALUMNO = :oid ".
                       "AND TIENE.ESPECIALIDAD = ESPECIALIDAD.OID_E)";
            $stmt = $conexion->prepare($consulta);
            $stmt->bindParam(':oid', $oid);
            $stmt->execute();
            $res = $stmt->fetch();
            return $res['NOMBRE'];          
        } catch (PDOException $e) {
            $_SESSION['excepcion'] = $e->getMessage();
            Header("Location:error.php");
        }
    }
    
=======
		$stmt = $conexion -> prepare('CALL INSERTAR_MATRICULA(:anyo,:curso,:alm,:espec)');
		$stmt -> bindParam(':anyo', $anyo);
		$stmt -> bindParam(':curso', $curso);
		$stmt -> bindParam(':alm', $oid);
		$stmt -> bindParam(':espec', $especialidad);
		$stmt -> execute();
	} catch (PDOException $e) {
		$_SESSION['excepcion'] = $e -> getMessage();
		Header("Location:error.php");
	}
	return $stmt;
}

function modificarAlumno($email, $telefono, $oid, $conexion) {
	try {
		$stmt = $conexion -> prepare('CALL ACTUALIZAR_ALUMNO(:telefono, :email, :oid)');
		$stmt -> bindParam(':telefono', $telefono);
		$stmt -> bindParam(':email', $email);
		$stmt -> bindParam(':oid', $oid);
		$stmt -> execute();
	} catch (PDOException $e) {
		$_SESSION['excepcion'] = $e -> getMessage();
		/* Mejorar error.php para poder ir a alumnos.php? */
		Header("Location:error.php");
	}
}

function consultarPaginaAlumnos($conexion, $pagina_seleccionada, $intervalo, $total) {
	// Código para devolver una consulta paginada
	try {
		$first = ($pagina_seleccionada - 1) * $intervalo + 1;
		$last = $pagina_seleccionada * $intervalo;
		if ($last > $total) {
			$last = $total;
		}
		$paged_query = "SELECT * FROM(" . "SELECT ROWNUM RNUM, AUX.* FROM(" . "SELECT * FROM PERSONA, MATRICULA " . "WHERE (PERSONA.OID_P = MATRICULA.ALUMNO) " . "ORDER BY PERSONA.NOMBRE) AUX " . "WHERE ROWNUM <= :last) WHERE RNUM >=:first";
		$stmt = $conexion -> prepare($paged_query);
		$stmt -> bindParam(':first', $first);
		$stmt -> bindParam(':last', $last);
		$stmt -> execute();
		return $stmt;

	} catch (PDOException $e) {
		$_SESSION['excepcion'] = $e -> getMessage();
		Header("Location:error.php");
	}
}

function consultarTotalAlumnos($conexion) {
	try {
		$consulta = "SELECT COUNT(*) AS TOTAL FROM ALUMNO";
		$stmt = $conexion -> query($consulta);
		$res = $stmt -> fetch();
		$total = $res['TOTAL'];
		return (int)$total;
	} catch (PDOException $e) {
		$_SESSION['excepcion'] = $e -> getMessage();
		Header("Location:error.php");
	}
}

function consultarEspecialidadAlumno($conexion, $oid) {
	try {
		$consulta = "SELECT ESPECIALIDAD.NOMBRE FROM TIENE NATURAL JOIN ESPECIALIDAD WHERE 
		(TIENE.ALUMNO = :oid AND ESPECIALIDAD.OID_E = TIENE.ESPECIALIDAD)";
		$stmt = $conexion -> prepare($consulta);
		$stmt -> bindParam(':oid', $oid);
		$stmt -> execute();
		$res = $stmt -> fetch();
		return $res['NOMBRE'];
	} catch (PDOException $e) {
		$_SESSION['excepcion'] = $e -> getMessage();
		Header("Location:error.php");
	}
}

function consultarAsignaturasAlumno($conexion, $oid) {
	try {
		$consulta = "SELECT * FROM ASIGNATURA NATURAL JOIN REALIZA WHERE (REALIZA.ALUMNO = :oid AND REALIZA.ASIGNATURA = ASIGNATURA.OID_A)";
		// Header("Location:alumnos.php");
		$stmt = $conexion -> prepare($consulta);
		$stmt -> bindParam(':oid', $oid);
		$stmt -> execute();
		return $stmt;
	} catch (PDOException $e) {
		$_SESSION['excepcion'] = $e -> getMessage();
		Header("Location:error.php");
	}
}

>>>>>>> origin/roberto
?>