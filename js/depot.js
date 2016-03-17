$(document).ready(function(){
	//to update the file to the depot
	$("#uploadWindows").modal("hide");
	$( "#upload" ).click(function() {
		$("#uploadWindows").modal("show");
	});
	
	$( "#uploadButton" ).click(function() {
		var completed = 0;
		if ( !$( "#inputNom" ).val().match(/^[0-9a-zA-Z\-\_éèàçùêûô\.]+$/) )
			completed = -1;
		else if ( $('#inputNom').val().length > 50 )
			completed = -2;
		else {
			var nom = $( "#inputNom" ).val();
			var domaine = $( "#inputDomaine" ).val();
			$.ajax({
				type: 'POST',
				async: false,
				url: "fonctions/verifierNomUnique.php",
				data: {nom:nom, domaine:domaine},
				success: function(data) {
					if( data != '' ){
						completed = -3;
					}
				},
				error: function () {
					completed = -3;
					alert("Erreur dans la BDD !");
				}
			});
		}
		
		if ($( "#uploadFile" ).val() == '')
			completed = -4;
		else if ( $('#uploadFile')[0].files[0].size > 5242880 )
			completed = -5;	
			
		if ( completed == -1 ){
		   alert( "Le nom du fichier contient des caractères invalides !" );
		}else if( completed == -2 ) {
		   alert( "La taille du nom doit être <= 50 !" );
		}else if( completed == -3 ) {
		   alert( "Le nom est utilisé. Veuillez changer le nom !" );
		}else if( completed == -4 ) {
		   alert( "Fichier à transférer est vide !" );
		}else if( completed == -5 ) {
		   alert( "La taille du fichier dépasse 5Mo !" );
		}else{
		   $('#uploadForm').submit();
		}
	});
});