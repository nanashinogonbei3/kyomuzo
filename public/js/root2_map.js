let directionsService = new google.maps.DirectionsService();
let directionsRenderer = new google.maps.DirectionsRenderer();
directionsRenderer.setMap(map); // Existing map object displays directions
// Create route from existing points used for markers
const route = {
    origin: dakota,
    destination: frick,
    travelMode: 'DRIVING'
}

directionsService.route(route,
  function(response, status) { // anonymous function to capture directions
    if (status !== 'OK') {
      window.alert('Directions request failed due to ' + status);
      return;
    } else {
      directionsRenderer.setDirections(response); // Add route to the map
      var directionsData = response.routes[0].legs[0]; 
    // Get data about the mapped route
      if (!directionsData) {
        window.alert('Directions request failed');
        return;
      }
      else {
        document.getElementById('msg').innerHTML += 
    " Driving distance is " + directionsData.distance.text + 
    " (" + directionsData.duration.text + ").";
      }
    }
  });