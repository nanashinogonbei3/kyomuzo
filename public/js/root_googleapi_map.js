function initMap() {
 
var DS = new google.maps.DirectionsService();
var DR = new google.maps.DirectionsRenderer();
var map = new google.maps.Map(document.getElementById('map'), {
center: {lat: 35.170981, lng: 136.881556} ,
zoom: 15,
mapTypeId: google.maps.MapTypeId.ROADMAP
});
/* map を DirectionsRendererオブジェクトのsetMap()を使って関連付け */
DR.setMap(map);
document.getElementById("btn").onclick = function() {
/* 開始地点と目的地点、ルーティングの種類を設定 */
var from = document.getElementById('from').value;
var to = document.getElementById('to').value;
 
var request = {
origin: from,
destination: to,
travelMode: google.maps.TravelMode.WALKING
};
DS.route(request, function(result, status) {
DR.setDirections(result);
});
}
}