$(document).ready(function() {
	$("#titulo_mod_Ok").hide();
	$("#titulo_mod_Mal").hide();
	



	$("#titulo_mod").change(function(){

		var url="check_titulo_mod.php?titulo_peli_mod="+$("#titulo_mod").val()+"&titulo_peli_pre="+$("#tituloprem").val();
		$.get(url,peliculaExiste);
	  }
  );

	function peliculaExiste(data,status) {
		if(status== 'success'){
			if (data == 'existe') {
                alert("Titulo ya usado por otra pelicula");
				$("#titulo_mod").focus(); //Devuelvo el foco
				$("#titulo_mod_Ok").hide();
				$("#titulo_mod_Mal").show();
		    }
			
			else if (data == 'disponible') {
				$("#titulo_mod_Ok").show();
			    $("#titulo_mod_Mal").hide();
			}
		}
		else{
			alert("no se pudo conectar con el servidor");
		}
	}
})