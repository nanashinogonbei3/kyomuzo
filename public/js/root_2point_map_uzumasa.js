// findLocation.bladeからformで受け取った緯度経度を変数に代入します。
var latVer = lat;
var lngVer = lng;
console.log(latVer);

// 地図初期化
var map = new google.maps.Map(document.getElementById("map"), {
    zoom : 16,
    center: new google.maps.LatLng(35.0165064434711, 135.70786209216388),//東映太秦映画村
    mayTypeId: google.maps.MapTypeId.ROADMAP
});

var directionsService = new google.maps.DirectionsService;
var directionsRenderer = new google.maps.DirectionsRenderer;

// ルート検索を実行
directionsService.route({
    origin: new google.maps.LatLng(latVer, lngVer),//出発始点A
    destination: new google.maps.LatLng(35.0165064434711, 135.70786209216388),//到達点B"東映映画村"
    travelMode: google.maps.DirectionsTravelMode.WALKING
    // google.maps.DirectionsTravelMode.TRANSIT//公共機関を使用したルート
    // google.maps.TravelMode.DRIVING//DRIVING//移動手段：車
    // google.maps.DirectionsTravelMode.BICYCLING//自転車でのルート
    
}, function(response, status) {
    console.log(response);//これによって地図が表示される
    if (status === google.maps.DirectionsStatus.OK) {
        // ルート検索の結果を地図上に描画
        directionsRenderer.setMap(map);
        directionsRenderer.setDirections(response); 
    }
});

    // マーカーを設定
    marker = new google.maps.Marker({
        position: new google.maps.LatLng(35.0165064434711, 135.70786209216388),//到達点B"東映太秦映画村" //マーカーを立てる地図を指定 
        map: map, //マーカーを立てる地図を指定
        title: '虚無蔵太秦園店',// アイコンにマウスホバーすると出てくる文言
        icon: {
            url: '../assets/img/marker.png',// 画像のパスを指定
            scaledSize: new google.maps.Size(105, 95) //
          }   
    });

    /*情報ウィンドウを作成。*/
    var infoContent2 = '<h5>虚無蔵太秦店</h5><p>10～19時まで営業<br>京都府京都市右京区太秦東峰岡町10<br>tel 075-862-5003</p>';

    var infowindow = new google.maps.InfoWindow({
	content: infoContent2
    });

    //*情報ウィンドウを表示します。 *
    google.maps.event.addListener(marker, 'click', function() {
            infowindow.open(map,marker);
    });

