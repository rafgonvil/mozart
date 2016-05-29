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

function modificarAsignatura($oid_p, $oid_a, $oid_pr, $nota, $conexion) {
	try {
		$consulta = "CALL INSERTAR_NOTA(:oid_p,:oid_a,:nota,'PRIMERA_CONVOCATORIA', :oid_pr )";
		$stmt = $conexion -> prepare($consulta);
		$stmt -> bindParam(':oid_p', $oid_p);
		$stmt -> bindParam(':oid_a', $oid_a);
		$stmt -> bindParam(':oid_pr', $oid_pr);
		$stmt -> bindParam(':nota', $nota);
		$stmt -> execute();
		$res = $stmt -> fetch();
		return $res;
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