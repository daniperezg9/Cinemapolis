$(document).ready(function() {

	$("#emailMal").hide();
	$("#userMal").hide();
	$("#emailOK").hide();
	$("#userOK").hide();

	$("#campoEmail").change(function(){
		const campo = $("#campoEmail"); // referencia jquery al campo
		campo[0].setCustomValidity(""); // limpia validaciones previas

		// validación html5, porque el campo es <input type="email" ...>
		const esCorreoValido = campo[0].checkValidity();
		if (esCorreoValido && correoValidoUCM(campo.val())) {
			// el correo es válido y acaba por @ucm.es: marcamos y limpiamos quejas
		
			// tu código aquí: coloca la marca correcta
			campo[0].setCustomValidity("");
			$("#emailMal").hide();
			$("#emailOK").show();

		} else {			
			// correo invalido: ponemos una marca y nos quejamos

			// tu código aquí: coloca la marca correcta
			campo[0].setCustomValidity(
				"El correo debe ser válido y acabar por @ucm.es");
				$("#emailMal").show();
				$("#emailOK").hide();
		}
	});

	
	$("#campoUser").change(function(){
		var url = "comprobarUsuario.php?user=" + $("#campoUser").val();
		$.get(url,usuarioExiste);
  	});


	function correoValidoUCM(correo) {
		correoCom = correo.split("@");
		if(correoCom[1]==="ucm.es"){
			return true;
		}
		return false;
	}

	function usuarioExiste(data,status) {
		if(status== 'success'){  
			if (data == 'existe'){
				$("#userMal").show();
				$("#userOK").hide();
				$("#campoUser").focus(); //Devuelvo el foco
				alert("El usuario ya existe, escoge otro");
			} else if (data == 'disponible') {
				$("#userOK").show();
				$("#userMal").hide();
			}
		}
		else {
			alert("no se pudo conectar con el server");
		}
	}
})
	