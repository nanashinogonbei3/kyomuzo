var latVer = lat;
var lngVer = lng;

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
        title: '虚無蔵太秦店',// アイコンにマウスホバーすると出てくる文言
        icon: {
            url: '../assets/img/marker.png',// 画像のパスを指定
            scaledSize: new google.maps.Size(105, 95) //
          }   
    });

    //マーカー作成
    const marker = new google.maps.Marker(marker);

