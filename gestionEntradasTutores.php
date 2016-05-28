<?php
function insertarTutor($nombre, $apellidos, $numDni, $letraDni, $email, $fnac, $telefono, $conexion, $numAlumno, $letraAlumno) {
	try {
		$fnacFormateada = DateTime::createFromFormat('Y-m-d', $fnac) -> format('d-m-Y');
		$dniFinal = $numDni . $letraDni;
		$dniAlumno = $numAlumno . $letraAlumno;
		$nombreFinal = $nombre . " " . $apellidos;
		$stmt = $conexion -> prepare('CALL INSERTAR_TUTOR(:dni,:nombre,
                                       :fecha,:telefono,:email)');
		$stmt -> bindParam(':dni', $dniFinal);
		$stmt -> bindParam(':nombre', $nombreFinal);
		$stmt -> bindParam(':fecha', $fnacFormateada);
		$stmt -> bindParam(':telefono', $telefono);
		$stmt -> bindParam(':email', $email);
		$stmt -> execute();
		
		$consulta = $conexion -> prepare('SELECT * FROM ALUMNO WHERE ALUMNO.DNI = :dni');
		$consulta -> bindParam(':dni', $dniAlumno);
		$consulta -> execute();
		$alumno = $consulta -> fetch();
		$oid_alumno = $alumno['OID_A'];
		
		$insertar = $conexion -> prepare('CALL INSERTAR_SE_RESPONSABILIZA_D(SEC_TUTOR.CURRVAL,:oid_a');
		$insertar -> bindParam(':oid_a', $oid_alumno);
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