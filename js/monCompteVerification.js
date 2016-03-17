//a script to check all the champs of the form have been completed correctly
$(document).ready(function(){
	var completed;
	$( "#butChnagerMpd" ).click(function() {
	  completed = true;
	  if ( $( "#motDePasseActuel" ).val() == '' )
		  completed = false;
	  if ( $( "#motDePasse" ).val() == '' )
		  completed = false;
	  if ( $( "#motDePasse2" ).val() == '' )
		  completed = false;
	  if ( completed == false )
		  alert( "Veuillez remplir tous les champs !" );
	  else if ( $( "#motDePasse" ).val() != $( "#motDePasse2" ).val() )
		  alert( "Les 2 mots de passe ne sont pas identiques" );
	  else
		  //submit the form
		  $('#formChangerMdp').submit();
	});
});