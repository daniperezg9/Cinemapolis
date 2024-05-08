$(document).ready(function() {
	$("#emailOk").hide();
	$("#emailMal").hide();
	
	$("#correo").change(function(){
		console.log("cambio de JS\n");
		const campo = $("#correo"); // referencia jquery al campo
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
		console.log('La url es ' + url);
		$.get(url,usuarioExiste);
	  }
  );

	
	function correoValidoUCM(correo) {
		// tu codigo aqui (devuelve true ó false)

		x1 = correo.split("@");
		//@ucm.es
		if(x1[1]==="ucm.es" || x1[1]==="gmail.com" ||x1[1]==="admin.com" ){
			return true;
		}
		
		return false;
	}

	function usuarioExiste(data,status) {
		//console.log('data es ' + data + ' status es ' + status);
		if(status== 'success'){
			
			if (data == 'existe') {
				$("#correo").focus(); //Devuelvo el foco
				$("#emailOk").hide();
				$("#emailMal").show();
			}
			else if (data == 'disponible') {
				$("#emailOk").show();
				$("#emailMal").hide();
			}
		}
		else{
			alert("no se pudo conectar con el servidor");
		}
	}
})