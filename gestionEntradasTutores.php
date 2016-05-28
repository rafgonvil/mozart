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

function consultarAlumnoTutor($conexion, $oid) {
	try {
		$consulta = "SELECT ALUMNO.NOMBRE FROM SE_RESPONSABILIZA_DE NATURAL JOIN TUTOR " . "WHERE SE_RESPONSABILIZA_DE.TUTOR = :oid";
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
?>