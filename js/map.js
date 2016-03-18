$(document).ready(function(){
  var map = GMaps({
	  div: '#map',
	  lat: 49.4948825,
	  lng: 2.7771265,
	  zoom : 12
  });
  map.addMarker({
  lat: 49.4948825,
  lng: 2.7771265,
  title: 'Vignemont',
  });
});