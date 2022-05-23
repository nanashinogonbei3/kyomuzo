var map;
var marker;


function initialize() {
  // 地図のだいたい中央の場所の公共施設の緯度経度を中心に設定する
  var latlng = new google.maps.LatLng(log(lat) ,log(lng));
  var opts = {
    zoom: 14,
    center: latlng,
    // 地図のタイプ
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };

  // 全体地図の表示場所を、div id="map_canvas" に表示する。
  map = new google.maps.Map(document.getElementById("map"), opts);

  // 東映太秦映画村の緯度経度にマーカーを置く
  // var m_latlng = new google.maps.LatLng(35.016664493725315, 135.70789474534644);
  var m_latlng = new google.maps.LatLng(log(lat), log(lng));
  marker = new google.maps.Marker({
    position: m_latlng
  });
  // GoogleMapper.addColorMarker(34.7, 135.5, "大阪", "FF0", "000", "虎");
}

var map;
function initMap() {
  // The map, centered on Central Park
  const center = {lat: log(lat), lng: log(lng)};
  const options = {zoom: 14, scaleControl: true, center: center};

  map = new google.maps.Map(
      document.getElementById('map'), options);
  // Locations of landmarks
  const eigamura = {lat: log(lat), lng: log(lng)};

}

// マーカーを表示する
function doOpen() {
  marker.setMap(map);
}
// マーカーを非表示にする
function doClose() {
  marker.setMap(null);
}