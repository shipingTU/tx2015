$(document).ready(function(){
	//to check all the champs of the form have been completed correctly
	var completed;
	$( "#send" ).click(function() {
	  completed = 0;
	
	  //vérifier le titre est unique dans la BDD et son format n'est que des alphanumerique
	  if ( !$( "#inputTitre" ).val().match(/.+/) )
		completed = -3;
	  else if ( $('#inputTitre').val().length > 30 )
		completed = -6;
	  else if ($(document).find("title").text() == "ajouter un article" ) {
		var titre = $( "#inputTitre" ).val();
		$.ajax({
			type: 'POST',
			async: false,
			url: "fonctions/verifierTitreUnique.php",
			data: {titre:titre},
			success: function(data) {
				if( data != '' ){
					completed = -4;
				}
			},
			error: function () {
				completed = -4;
				alert("Erreur dans la BDD !");
			}
		});
	  }
	  
	  var fullDate = new Date();
	  //convert month and day to 2 digits
	  var twoDigitMonth = ((fullDate.getMonth().length+1) === 1)? (fullDate.getMonth()+1) : '0' + (fullDate.getMonth()+1);
	  var twoDigitDay = ((fullDate.getDate().length+1) === 1)? (fullDate.getDate()) : '0' + (fullDate.getDate());
	  var today = fullDate.getFullYear() + "-" + twoDigitMonth + "-" + twoDigitDay;

	  if ( $( "#inputFile" ).val() != '' && $('#inputFile')[0].files[0].size > 5242880 )
			completed = -7;	  
	  if ( $('#inputTag').val().length > 20 )
			completed = -6;
	  if ( $('#datepicker').val() <= today  )
			completed = -5;
	  if ( $(document).find("title").text() == "ajouter un article" && $( "#inputFile" ).val() == '' && $( "#inputArticle" ).val() == '' )
		completed = -2;
	  if ( $( "#assoc option:selected" ).val() == '' || $( "#datepicker" ).val() == '')
		completed = -1;
	  
		
		  
	  //test if all important info completed
	  if ( completed == -1 ){
		  alert( "Veuillez remplir tous les champs avec '*' !" );
	  }else if( completed == -2 ) {
		  alert( "Veuillez remplir le contenu du article ou upload un fichier !" );
	  }else if( completed == -3 ) {
		  alert( "Le titre contient des caractères invalides !" );
	  }else if( completed == -4 ) {
		  alert( "Le titre est déjà utilisé, veuilez changer le titre !" );
	  }else if( completed == -5 ) {
		  alert( "La valeur de la date n'est pas valide !" );
	  }else if( completed == -6 ) {
		  alert( "La taille du titre (<= 30).\n La taille du tag (<=20)!" );
	  }else if( completed == -7 ) {
		  alert( "La taille du fichier dépasse 5Mo !" );
	  }else{
		  //submit the form
		  $('#fileForm').submit();
	  }
	});
	
	//add existing tags when select "menuItem"
	$('#menuItem').on('change', function() {
		$('span.label-success').remove();
		if( $('#menuItem').val() != '' ){
				var menuItem = $('#menuItem').val();
				$.ajax({
					type: 'POST',
					url: "fonctions/prendreTags.php",
					data: {item:menuItem}
				})
				.fail(function() {
					alert( "erreur dans la BDD !" );
				})
				.done(function(data){
					var tags=$.parseJSON(data);
					for (i=0;i < tags.length;i++){
						$( "#tags" ).append( $('<span  style="cursor:pointer" onclick="addTag(\''+tags[i]+'\')" class="label label-success"></span>').text(tags[i]) );
						$( "#tags" ).append(' ');
					}
				});	 
		}
	});
});
	
function addTag (val){
	document.getElementById("inputTag").value = val;
}
