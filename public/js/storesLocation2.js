var latVer = lat;
var lngVer = lng;
console.log(latVer);

    // google map へ表示するための設定
    m_latlng = new google.maps.LatLng(latVer, lngVer);
    // map = document.getElementById("map");
    opt = {
        zoom: 16,
        center: m_latlng,
    };
    // google map 表示
    map = new google.maps.Map(document.getElementById("map"), opt);


    // マーカーを設定
    marker = new google.maps.Marker({
        position: m_latlng, //マーカーを立てる地図を指定
        map: map, //マーカーを立てる地図を指定
        title: '虚無蔵祇祇園店',// アイコンにマウスホバーすると出てくる文言
        icon: {
            url: '../assets/img/marker.png',// お好みの画像までのパスを指定
            scaledSize: new google.maps.Size(105, 95) //
          }   
    });

    //マーカー作成
    // const marker = new google.maps.Marker(marker);

     /*マーカーを表示*/
     marker.setMap(map);


    /*情報ウィンドウを作成。*/
    var infoContent2 = '<h5>虚無蔵祇園店</h5><p>10～19時まで営業<br>京都府京都市東山区祇園町北側625<br>tel 075-561-6155</p>';

    var infowindow = new google.maps.InfoWindow({
	content: infoContent2
    });

    //*情報ウィンドウを表示します。 */
    google.maps.event.addListener(marker, 'click', function() {
            infowindow.open(map,marker);
    });


    

