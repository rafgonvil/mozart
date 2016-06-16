<?php
function insertarTutor($nombre, $apellidos, $numDni, $letraDni, $email, $fnac, $telefono, $numAlumno, $letraAlumno, $conexion) {
	try {
		$fnacFormateada = DateTime::createFromFormat('Y-m-d', $fnac) -> format('d-m-Y');
		$dniTutor = $numDni . $letraDni;
		$dniAlumno = $numAlumno . $letraAlumno;
		$nombreFinal = $nombre . " " . $apellidos;
		$stmt = $conexion -> prepare('CALL INSERTAR_TUTOR(:dni,:nombre,
                                       :fecha,:telefono,:email)');
		$stmt -> bindParam(':dni', $dniTutor);
		$stmt -> bindParam(':nombre', $nombreFinal);
		$stmt -> bindParam(':fecha', $fnacFormateada);
		$stmt -> bindParam(':telefono', $telefono);
		$stmt -> bindParam(':email', $email);
		$stmt -> execute();

		$consulta = $conexion -> prepare('SELECT OID_P FROM PERSONA WHERE PERSONA.DNI = :dni');
		$consulta -> bindParam(':dni', $dniAlumno);
		$consulta -> execute();
		foreach ($consulta as $fila) {
			$oid_alumno = $fila['OID_P'];
		}

		$consulta1 = $conexion -> prepare('SELECT OID_P FROM PERSONA WHERE PERSONA.DNI = :dni');
		$consulta1 -> bindParam(':dni', $dniTutor);
		$consulta1 -> execute();
		foreach ($consulta1 as $fila) {
			$oid_tutor = $fila['OID_P'];
		}

		$insertar = $conexion -> prepare('CALL INSERTAR_SE_RESPONSABILIZA_DE(:oid_t, :oid_a)');
		$insertar -> bindParam(':oid_a', $oid_alumno);
		$insertar -> bindParam(':oid_t', $oid_tutor);
		$insertar -> execute();

	} catch (PDOException $e) {
		$_SESSION['excepcion'] = $e -> getMessage();
		Header("Location:error.php");
	}
	return $insertar;
}

function consultarTotalTutores($conexion) {
	try {
		$consulta = "SELECT COUNT(*) AS TOTAL FROM TUTOR";
		$stmt = $conexion -> query($consulta);
		$res = $stmt -> fetch();
		$total = $res['TOTAL'];
		return (int)$total;
	} catch (PDOException $e) {
		$_SESSION['excepcion'] = $e -> getMessage();
		Header("Location:error.php");
	}
}

function consultarPaginaTutores($conexion, $pagina_seleccionada, $intervalo, $total)
{
    try {
        $first = ($pagina_seleccionada - 1) * $intervalo + 1;
        $last = $pagina_seleccionada * $intervalo;
        if ($last > $total) {
            $last = $total;
        }
        
        $paged_query = "SELECT * FROM(" . "SELECT ROWNUM RNUM, AUX.* FROM(" .
                        "SELECT * FROM PERSONA, SE_RESPONSABILIZA_DE " .
                        "WHERE (PERSONA.OID_P = SE_RESPONSABILIZA_DE.TUTOR) " .
                        "ORDER BY PERSONA.NOMBRE) AUX " .
                        "WHERE ROWNUM <= :last) WHERE RNUM >=:first";
        $stmt = $conexion->prepare($paged_query);
        $stmt->bindParam(':first',$first);
        $stmt -> bindParam(':last', $last);
        $stmt -> execute();
        return $stmt;
    } catch (PDOException $e) {
        $_SESSION['excepcion'] = $e->getMessage();
        Header("Location:error.php");
    }
}

function consultarAlumnoTutor($conexion, $oida) {
	try {
		$consulta = "SELECT NOMBRE FROM SE_RESPONSABILIZA_DE, PERSONA ".
		            "WHERE (SE_RESPONSABILIZA_DE.ALUMNO = :oida ".
                    "AND SE_RESPONSABILIZA_DE.ALUMNO = PERSONA.OID_P)";
		$stmt = $conexion -> prepare($consulta);
		$stmt -> bindParam(':oida', $oida);
		$stmt -> execute();
		$res = $stmt -> fetch();
		return $res['NOMBRE'];
	} catch (PDOException $e) {
		$_SESSION['excepcion'] = $e -> getMessage();
		Header("Location:error.php");
	}
}

function modificarTutor($email, $telefono, $oid, $conexion)
    {
        try {
            $stmt = $conexion->prepare('CALL ACTUALIZAR_TUTOR(:telefono, :email, :oid)');
            $stmt->bindParam(':telefono', $telefono);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':oid', $oid);
            $stmt->execute();
        } catch (PDOException $e) {
            $_SESSION['excepcion'] = $e->getMessage();
            /* Mejorar error.php para poder ir a alumnos.php? */
            Header("Location:error.php");
        }
    }
    
function eliminarTutor($conexion, $oid)
	{
		try {
			$stmt = $conexion -> prepare('CALL ELIMINA_TUTOR(:oid)');
			$stmt -> bindParam(':oid', $oid);
			$stmt -> execute();
		} catch (PDOException $e) {
			$_SESSION['excepcion'] = $e->getMessage();
            Header("Location:error.php");
		}
	} 
	
?>