$(document).ready(function() {

	$("#userOk").hide();
	$("#userMal").hide();
	$("#emailOk").hide();
	$("#emailMal").hide();

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
			$("#emailOk").show();

		} else {			
			// correo invalido: ponemos una marca y nos quejamos

			// tu código aquí: coloca la marca correcta

			campo[0].setCustomValidity("El correo debe ser válido y acabar por @ucm.es, @gmail.com, @admin.com");
				$("#emailOk").hide();
				$("#emailMal").show();
		}
		
	});

	
	$("#correo").change(function(){
		var url="check_user.php?correo="+$("#correo").val();
		$.get(url,usuarioExiste);
  	}
  );


	function correoValidoUCM(correo) {
		// tu codigo aqui (devuelve true ó false)

		x1 = correo.split("@");
		//@ucm.es
		if(x1[1]==="ucm.es" ||x1[1]==="gmail.com" ||x1[1]==="admin.com" ){
			return true;
		}
		
		return false;
	}

	function usuarioExiste(data,status) {
		if(status== 'success'){
			
			if (data == 'existe') {
				$("#userMal").show();
				$("#userOk").hide();
				$("#correo").focus(); //Devuelvo el foco
				alert("Este correo ya tiene asociado una cuenta");
			}
			else if (data == 'disponible') {
				$("#userOk").show();
				$("#userMal").hide();
			}
		}
		else{
			alert("no se pudo conectar con el servidor");
		}
	}
})