var map;
var marker2;

function initialize() {
  // 地図のだいたい中央の場所の公共施設の緯度経度を中心に設定する
  var latlng = new google.maps.LatLng(35.003831624746006, 135.7785104890609);
  
  var opts = {
    zoom: 14,
    center: latlng,
    // 地図のタイプ
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };

  // 全体地図の表示場所を、div id="map_canvas" に表示する。
  map = new google.maps.Map(document.getElementById("map_canvas"), opts);


  // 八坂神社の緯度経度にマーカーを置く
  var m_latlng2 = new google.maps.LatLng(35.003831624746006, 135.7785104890609);
  marker2 = new google.maps.Marker({
    position: m_latlng2
  });
}

var map;
function initMap() {
  // The map, centered on Central Park
  const center = {lat: 35.003831624746006, lng: 135.7785104890609};
  const options = {zoom: 14, scaleControl: true, center: center};
  map = new google.maps.Map(
      document.getElementById('map_canvas'), options);
  // The markers for The kyoto-gosyo and The yasaka-jinjya
  const yasaka = {lat: 35.003831624746006, lng: 135.7785104890609};
  

}

// マーカーを表示する
function doOpen() {
  // marker1.setMap(map);
  marker2.setMap(map);
}
// マーカーを非表示にする
function doClose() {
  // marker1.setMap(null);
  marker2.setMap(null);
}