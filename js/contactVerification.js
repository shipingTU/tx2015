//a script to check all the champs of the form have been completed correctly
$(document).ready(function(){
	var completed;
	$( "#envoyer" ).click(function() {
	  completed = true;
	  if ( $( "#select option:selected" ).val() == '' )
		  completed = false;
	  if ( $( "#inputNom" ).val() == '' )
		  completed = false;
	  if ( $( "#inputPrenom" ).val() == '' )
		  completed = false;
	  if ( $( "#inputEmail" ).val() == '' )
		  completed = false;
	  if ( $( "#Contenu" ).val() == '' )
		  completed = false;
	  if ( !$("input[name='optionsRadios']:checked").val())
		  completed = false;
	  //test if all important info completed
	  if ( completed == false ){
		alert( "Veuillez remplir tous les champs obligatoires avec '*' !" );
	  }else if(!$( "#inputEmail" ).val().match(/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/)){
		alert( "Adresse mail non valide" );
	  }else if(!$( "#inputtel" ).val().match(/^[0][1-9][0-9]{8}$/)){
		 alert( "Numéro de téléphone non valide" );
	  }else{
		  //submit the form
		  $('#mailForm').submit();
	  }
	});
});