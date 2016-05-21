/**
 * @author Robert
 */
function validaAlm()
{
	var res = true;
	document.getElementById("errores").innerHTML = "";
	
	if (compruebaVacio("nombre") || compruebaVacio("apellidos") ||
		compruebaVacio("dni") || compruebaVacio("letra") || compruebaVacio("email") ||
		compruebaVacio("fnac") || compruebaVacio("telefono") ||
		compruebaVacio("curso") || compruebaVacio("especialidad") ||
		!compruebaDni())
			res = false;
	
	if (compruebaVacio("nombre")) {
		document.getElementById("label_nombre").style.color = "red";
		document.getElementById("errores").innerHTML += 'El campo nombre no puede estar vacío <br/>';
	} else 
		document.getElementById("label_nombre").style.color = "black";
		
	if (compruebaVacio("apellidos")) {
		document.getElementById("label_apellidos").style.color = "red";
		document.getElementById("errores").innerHTML += 'El campo apellidos no puede estar vacío <br/>';
	} else 
		document.getElementById("label_apellidos").style.color = "black";
	
	if (compruebaVacio("dni")) {
		document.getElementById("label_dni").style.color = "red";
		document.getElementById("errores").innerHTML += 'El campo DNI no puede estar vacío <br/>';
	} else 
		document.getElementById("label_dni").style.color = "black";
		
	if (compruebaVacio("letra")) {
		document.getElementById("label_letra").style.color = "red";
		document.getElementById("errores").innerHTML += 'El campo DNI no puede estar vacío <br/>';
	} else
		document.getElementById("label_letra").style.color = "black";
		
	if (!compruebaDni()) {
		document.getElementById("label_dni").style.color = "red";
		document.getElementById("label_letra").style.color = "red";
		document.getElementById("errores").innerHTML += 'El campo DNI no es correcto <br/>';
	} else {
		document.getElementById("label_letra").style.color = "black";
		document.getElementById("label_dni").style.color = "black";
	}

	if (compruebaVacio("email")) {
		document.getElementById("label_email").style.color = "red";
		document.getElementById("errores").innerHTML += 'El campo correo eléctronico no puede estar vacío <br/>';
	} else 
		document.getElementById("label_email").style.color = "black";
	
	if (compruebaVacio("fnac")) {
		document.getElementById("label_fnac").style.color = "red";
		document.getElementById("errores").innerHTML += 'El campo fecha de nacimiento no puede estar vacío <br/>';
	} else 
		document.getElementById("label_fnac").style.color = "black";
		
	if (compruebaVacio("telefono")) {
		document.getElementById("label_telefono").style.color = "red";
		document.getElementById("errores").innerHTML += 'El campo teléfono no puede estar vacío <br/>';
	} else 
		document.getElementById("label_telefono").style.color = "black";
		
	if (compruebaVacio("curso")) {
		document.getElementById("label_curso").style.color = "red";
		document.getElementById("errores").innerHTML += 'El campo curso no puede estar vacío <br/>';
	} else 
		document.getElementById("label_curso").style.color = "black";
	
	if (compruebaVacio("especialidad")) {
		document.getElementById("label_especialidad").style.color = "red";
		document.getElementById("errores").innerHTML += 'El campo especialidad no puede estar vacío <br/>';
	} else 
		document.getElementById("label_especialidad").style.color = "black";
	
	document.close();
	return res;
}

function compruebaVacio(str)
{
	var res = false;
	if (document.getElementById(str).value == "") {
		res = true;
	}
	
	return res;
}

function compruebaDni()
{
	var res = true;
	var dni = document.getElementById("dni").value;
	if (dni.length < 8)
		res = false;
	else {
		var letra = document.getElementById("letra").value;

		var tabla = ["T","R","W","A","G","M","Y","F","P","D",
                	 "X","B","N","J","Z","S","Q","V","H","L",
                 	 "C","K","E"];
				 
    	var modulo = parseInt(dni)%23;
    	var letraCorrecta = tabla[modulo];
		if (letra != letraCorrecta)
			res = false;
	}
	
	return res;
}
