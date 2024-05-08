$(document).ready(function() {
	$("#titulo_nueva_Ok").hide();
	$("#titulo_nueva_Mal").hide();
	



	$("#titulo_nueva").change(function(){

		var url="check_titulo.php?titulo_nueva="+$("#titulo_nueva").val();
		$.get(url,peliculaExiste);
	  }
  );

	function peliculaExiste(data,status) {
		if(status== 'success'){
			
			if (data == 'existe') {
				$("#titulo_nueva").focus(); //Devuelvo el foco
				$("#titulo_nueva_Ok").hide();
				$("#titulo_nueva_Mal").show();
		    }
			
			else if (data == 'disponible') {
				$("#titulo_nueva_Ok").show();
			    $("#titulo_nueva_Mal").hide();
			}
		}
		else{
			alert("no se pudo conectar con el servidor");
		}
	}
})