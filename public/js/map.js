var map;
var marker;

function initialize() {
  // 地図のだいたい中央の場所の公共施設の緯度経度を中心に設定する
  var latlng = new google.maps.LatLng(35.016664493725315 ,135.70789474534644);
  var opts = {
    zoom: 14,
    center: latlng,
    // 地図のタイプ
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };

  // 全体地図の表示場所を、div id="map_canvas" に表示する。
  map = new google.maps.Map(document.getElementById("map_canvas"), opts);

  // 東映太秦映画村の緯度経度にマーカーを置く
  var m_latlng = new google.maps.LatLng(35.016664493725315, 135.70789474534644);
  marker = new google.maps.Marker({
    position: m_latlng,
    map: map, //マーカーを立てる地図を指定
    title: '虚無蔵祇祇園店',// アイコンにマウスホバーすると出てくる文言
    icon: {
        url: '../assets/img/marker.png',// 画像のパスを指定
        scaledSize: new google.maps.Size(105, 95) //
      }   
  });
}

var map;
function initMap() {
  // The map, centered on Central Park
  const center = {lat: 35.016664493725315, lng: 135.70789474534644};
  const options = {zoom: 14, scaleControl: true, center: center};

  map = new google.maps.Map(
      document.getElementById('map_canvas'), options);
  // Locations of landmarks
  const eigamura = {lat: 35.016008400452456, lng: 135.7039430668044};

}
// マーカーを表示する
function doOpen() {
  marker.setMap(map);
}
// マーカーを非表示にする
function doClose() {
  marker.setMap(null);
}