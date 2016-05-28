function validaTut() {
	var res = true;
	document.getElementById("erroresTutor").innerHTML = "";

	if (compruebaVacio("nombreTutor") || compruebaVacio("apellidosTutor") || compruebaVacio("dniTutor") || compruebaVacio("letraTutor") || compruebaVacio("emailTutor") || compruebaVacio("fnacTutor") 
	|| compruebaVacio("telefonoTutor") || !compruebaDni1() || !compruebaDni2())
		res = false;

	if (compruebaVacio("nombreTutor")) {
		document.getElementById("label_nombreTutor").style.color = "red";
		document.getElementById("erroresTutor").innerHTML += 'El campo nombre no puede estar vacío <br/>';
	} else
		document.getElementById("label_nombreTutor").style.color = "black";

	if (compruebaVacio("apellidosTutor")) {
		document.getElementById("label_apellidosTutor").style.color = "red";
		document.getElementById("erroresTutor").innerHTML += 'El campo apellidos no puede estar vacío <br/>';
	} else
		document.getElementById("label_apellidosTutor").style.color = "black";

	if (compruebaVacio("dniTutor")) {
		document.getElementById("label_dniTutor").style.color = "red";
		document.getElementById("erroresTutor").innerHTML += 'El campo DNI no puede estar vacío <br/>';
	} else
		document.getElementById("label_dniTutor").style.color = "black";

	if (compruebaVacio("letraTutor")) {
		document.getElementById("label_letraTutor").style.color = "red";
		document.getElementById("erroresTutor").innerHTML += 'El campo DNI no puede estar vacío <br/>';
	} else
		document.getElementById("label_letraTutor").style.color = "black";

	if (!compruebaDni1()) {
		document.getElementById("label_dniTutor").style.color = "red";
		document.getElementById("label_letraTutor").style.color = "red";
		document.getElementById("erroresTutor").innerHTML += 'El campo DNI no es correcto <br/>';
	} else {
		document.getElementById("label_letraTutor").style.color = "black";
		document.getElementById("label_dniTutor").style.color = "black";
	}
	
	if (!compruebaDni2()) {
		document.getElementById("label_dniAlumno").style.color = "red";
		document.getElementById("label_letraAlumno").style.color = "red";
		document.getElementById("erroresTutor").innerHTML += 'El campo DNI no es correcto <br/>';
	} else {
		document.getElementById("label_letraAlumno").style.color = "black";
		document.getElementById("label_dniALumno").style.color = "black";
	}

	if (compruebaVacio("emailTutor")) {
		document.getElementById("label_emailTutor").style.color = "red";
		document.getElementById("erroresTutor").innerHTML += 'El campo correo eléctronico no puede estar vacío <br/>';
	} else
		document.getElementById("label_emailTutor").style.color = "black";

	if (compruebaVacio("fnacTutor")) {
		document.getElementById("label_fnacTutor").style.color = "red";
		document.getElementById("erroresTutor").innerHTML += 'El campo fecha de nacimiento no puede estar vacío <br/>';
	} else
		document.getElementById("label_fnacTutor").style.color = "black";

	if (compruebaVacio("telefonoTutor")) {
		document.getElementById("label_telefonoTutor").style.color = "red";
		document.getElementById("erroresTutor").innerHTML += 'El campo teléfono no puede estar vacío <br/>';
	} else
		document.getElementById("label_telefonoTutor").style.color = "black";

	document.close();
	return res;
}

function compruebaVacio(str) {
	var res = false;
	if (document.getElementById(str).value == "") {
		res = true;
	}

	return res;
}

function compruebaDni1() {
	var res = true;
	var dni = document.getElementById("dniTutor").value;
	if (dni.length < 8)
		res = false;
	else {
		var letra = document.getElementById("letraTutor").value;

		var tabla = ["T", "R", "W", "A", "G", "M", "Y", "F", "P", "D", "X", "B", "N", "J", "Z", "S", "Q", "V", "H", "L", "C", "K", "E"];

		var modulo = parseInt(dni) % 23;
		var letraCorrecta = tabla[modulo];
		if (letra != letraCorrecta)
			res = false;
	}

	return res;
}

function compruebaDni2() {
	var res = true;
	var dni = document.getElementById("dniAlumnoTutor").value;
	print(dni);
	if (dni.length < 8)
		res = false;
	else {
		var letra = document.getElementById("letraAlumnoTutor").value;

		var tabla = ["T", "R", "W", "A", "G", "M", "Y", "F", "P", "D", "X", "B", "N", "J", "Z", "S", "Q", "V", "H", "L", "C", "K", "E"];

		var modulo = parseInt(dni) % 23;
		var letraCorrecta = tabla[modulo];
		if (letra != letraCorrecta)
			res = false;
	}

	return res;
}

