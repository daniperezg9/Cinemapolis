$(document).ready(function() {
	$("#foroOk").hide();
	$("#foroMal").hide();
	
	$("#id_foro").change(function(){
		var url="check_foro.php?foro="+$("#id_foro").val();
		$.get(url,foroExiste);
	  }
  );

	function foroExiste(data,status) {
		if(status== 'success'){
			if (data == 'existe') {
                console.log("adios");
				$("#id_foro").focus(); //Devuelvo el foco
				$("#foroOk").hide();
				$("#foroMal").show();
		    }
			
			else if (data == 'disponible') {
                console.log("hola");
				$("#foroOk").show();
			    $("#foroMal").hide();
			}
            console.log(data);
		}
		else{
			alert("no se pudo conectar con el servidor");
		}
	}
})