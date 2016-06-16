/**
 * @author Robert
 */
function validaAlm() {
	var res = true;
	document.getElementById("erroresAlumno").innerHTML = "";

	if (compruebaVacio("nombreAlumno") || compruebaVacio("apellidosAlumno") || compruebaVacio("dniAlumno") || compruebaVacio("letraAlumno") || compruebaVacio("emailAlumno") || compruebaVacio("fnacAlumno") || compruebaVacio("telefonoAlumno") || compruebaVacio("cursoAlumno") || compruebaVacio("especialidadAlumno") || !compruebaDni())
		res = false;

	if (compruebaVacio("nombreAlumno")) {
		document.getElementById("label_nombre").style.color = "red";
		document.getElementById("erroresAlumno").innerHTML += 'El campo nombre no puede estar vacío <br/>';
	} else
		document.getElementById("label_nombre").style.color = "black";

	if (compruebaVacio("apellidosAlumno")) {
		document.getElementById("label_apellidos").style.color = "red";
		document.getElementById("erroresAlumno").innerHTML += 'El campo apellidos no puede estar vacío <br/>';
	} else
		document.getElementById("label_apellidos").style.color = "black";

	if (compruebaVacio("dniAlumno")) {
		document.getElementById("label_dni").style.color = "red";
		document.getElementById("erroresAlumno").innerHTML += 'El campo DNI no puede estar vacío <br/>';
	} else
		document.getElementById("label_dni").style.color = "black";

	if (compruebaVacio("letraAlumno")) {
		document.getElementById("label_letra").style.color = "red";
		document.getElementById("erroresAlumno").innerHTML += 'El campo DNI no puede estar vacío <br/>';
	} else
		document.getElementById("label_letra").style.color = "black";

	if (!compruebaDni()) {
		document.getElementById("label_dni").style.color = "red";
		document.getElementById("label_letra").style.color = "red";
		document.getElementById("erroresAlumno").innerHTML += 'El campo DNI no es correcto <br/>';
	} else {
		document.getElementById("label_letra").style.color = "black";
		document.getElementById("label_dni").style.color = "black";
	}

	if (compruebaVacio("emailAlumno")) {
		document.getElementById("label_email").style.color = "red";
		document.getElementById("erroresAlumno").innerHTML += 'El campo correo eléctronico no puede estar vacío <br/>';
	} else
		document.getElementById("label_email").style.color = "black";

	if (compruebaVacio("fnacAlumno")) {
		document.getElementById("label_fnac").style.color = "red";
		document.getElementById("erroresAlumno").innerHTML += 'El campo fecha de nacimiento no puede estar vacío <br/>';
	} else
		document.getElementById("label_fnac").style.color = "black";

	if (compruebaVacio("telefonoAlumno")) {
		document.getElementById("label_telefono").style.color = "red";
		document.getElementById("erroresAlumno").innerHTML += 'El campo teléfono no puede estar vacío <br/>';
	} else
		document.getElementById("label_telefono").style.color = "black";

	if (!compruebaTelefono()) {
		document.getElementById("label_telefono").style.color = "red";
		document.getElementById("erroresAlumno").innerHTML += 'El campo teléfono no es correcto<br/>';
	} else
		document.getElementById("label_telefonoTutor").style.color = "black";

	if (compruebaVacio("cursoAlumno")) {
		document.getElementById("label_curso").style.color = "red";
		document.getElementById("erroresAlumno").innerHTML += 'El campo curso no puede estar vacío <br/>';
	} else
		document.getElementById("label_curso").style.color = "black";

	if (compruebaVacio("especialidadAlumno")) {
		document.getElementById("label_especialidad").style.color = "red";
		document.getElementById("erroresAlumno").innerHTML += 'El campo especialidad no puede estar vacío <br/>';
	} else
		document.getElementById("label_especialidad").style.color = "black";

	document.close();
	return res;
}

function compruebaVacio(str) {
	var res = true;
	if (/([^\s])/.test(document.getElementById(str).value)) 
		res = false;

	return res;
}

function compruebaDni() {
	var res = true;
	var dni = document.getElementById("dniAlumno").value;
	if (!/^.{8}$/.test(dni))
		res = false;
	else {
		var letra = document.getElementById("letraAlumno").value;

		var tabla = ["T", "R", "W", "A", "G", "M", "Y", "F", "P", "D", "X", "B", "N", "J", "Z", "S", "Q", "V", "H", "L", "C", "K", "E"];

		var modulo = parseInt(dni) % 23;
		var letraCorrecta = tabla[modulo];
		if (letra != letraCorrecta)
			res = false;
	}

	return res;
}

function compruebaTelefono() {
	var res = true;
	var tel = document.getElementById("telefonoAlumno").value;
	if (!/^.{9}$/.test(tel))
		res = false;

	return res;
}
