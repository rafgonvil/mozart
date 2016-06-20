<?php

function consultarEspecialidadAsignatura($conexion, $oid) {
	try {
		$consulta = "SELECT ESPECIALIDAD.NOMBRE FROM ESPECIALIDAD " . "WHERE ESPECIALIDAD.OID_E = :oid ";
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

function consultarProfesorAsignatura($conexion, $oid) {
	try {
		$consulta = "SELECT PERSONA.NOMBRE FROM PERSONA " . "WHERE PERSONA.OID_P = :oid";
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

function consultarCursoAsignatura($conexion, $oid) {
	try {
		$consulta = "SELECT MATRICULA.CURSO FROM MATRICULA " . "WHERE MATRICULA.ALUMNO = :oid";
		$stmt = $conexion -> prepare($consulta);
		$stmt -> bindParam(':oid', $oid);
		$stmt -> execute();
		$res = $stmt -> fetch();
		return $res['CURSO'];
	} catch (PDOException $e) {
		$_SESSION['excepcion'] = $e -> getMessage();
		Header("Location:error.php");
	}
}

function puntuarAsignatura($oid_p, $oid_a, $nota, $nombre, $conexion) {
	try {
		
		$consProf = "SELECT OID_P FROM PERSONA WHERE NOMBRE = :name";
		$stm = $conexion -> prepare($consProf);
		$stm -> bindParam(':name', $nombre);
		$stm -> execute();
		$oid_profesor = $stm -> fetch();
		
		
		$consulta = "SELECT * FROM NOTA WHERE NOTA.OID_A = :oid_a";
		$stm1 = $conexion -> prepare($consulta);
		$stm1 -> bindParam(':oid_a', $oid_a);
		$stm1-> execute();
		$res = $stm1 -> fetch();
			
		if (true) {
			$consulta2 = "CALL INSERTAR_NOTA(:oid_p, :oid_a, :valor, 'PRIMERA_CONVOCATORIA', :oid_pr)";
			$stmt = $conexion -> prepare($consulta2);
			$stmt -> bindParam(':oid_p', (int)$oid_p);
			$stmt -> bindParam(':oid_a', $oid_a);
			$stmt -> bindParam(':valor', $nota);
			$stmt -> bindParam(':oid_pr', (int) $oid_profesor);
			$stmt -> execute();
		} else {
			$consulta2 = "CALL ACTUALIZAR_NOTA(:valor, :oid_a)";
			$stmt = $conexion -> prepare($consulta2);
			$stmt -> bindParam(':oid_a', $oid_a);
			$stmt -> bindParam(':valor', $nota);
			$stmt -> execute();
		}

	} catch (PDOException $e) {
		$_SESSION['excepcion'] = $e -> getMessage();
		Header("Location:error.php");
	}
}

function consultarNotaAsignatura($oid_a, $conexion) {
	try {
		$consulta = "SELECT * FROM NOTA WHERE NOTA.OID_A = :oid";
		$stmt = $conexion -> prepare($consulta);
		$stmt -> bindParam(':oid', $oid_a);

		$stmt -> execute();
		$res = $stmt -> fetch();
		return $res['VALOR'];
	} catch (PDOException $e) {
		$_SESSION['excepcion'] = $e -> getMessage();
		Header("Location:error.php");
	}
}
?>