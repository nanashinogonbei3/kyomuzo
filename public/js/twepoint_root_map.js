var map, begin, end;
var directionsDisplay;
var directionsService;
 
begin = '東京駅';
end = '東京スカイツリー';

 
$(function() {
      $('#searchButton').click(function(e) {
          e.preventDefault();         // hrefが無効になり、画面遷移が行わない
   
          begin = $('#inputBegin').val();
          end   = $('#inputEnd').val();
   
          // ルート説明をクリア
          $('#directionsPanel').text(' ');
   
          google.maps.event.addDomListener(window, 'load', initialize(begin, end));
          google.maps.event.addDomListener(window, 'load', calcRoute(begin, end));
      });
  });

 
 
  function initialize(begin, end) {
      // インスタンス[geocoder]作成
      var geocoder = new google.maps.Geocoder();
   
      geocoder.geocode({
          // 起点のキーワード
          'address': begin
   
      }, function(result, status) {
          if (status == google.maps.GeocoderStatus.OK) {
              // 中心点を指定
              var latlng = result[0].geometry.location;
   
              // オプション
              var myOptions = {
                  zoom: 14,
                  center: latlng,
                  scrollwheel: false,     // ホイールでの拡大・縮小
                  mapTypeId: google.maps.MapTypeId.ROADMAP,
              };
   
              // #map_canvasを取得し、[mapOptions]の内容の、地図のインスタンス([map])を作成する
              map = new google.maps.Map(document.getElementById('map_canvas'), myOptions);
   
              // 経路を取得
              directionsDisplay = new google.maps.DirectionsRenderer();
              directionsDisplay.setMap(map);
              directionsDisplay.setPanel(document.getElementById('directionsPanel'));     // 経路詳細
   
              // 場所
              $('#begin').text(begin);
              $('#end').text(end);
   
          } else {
              alert('取得できませんでした…');
          }
      });
  }
   
  // ルート取得
  function calcRoute(begin, end) {
   
      var request = {
          origin: begin,         // 開始地点
          destination: end,      // 終了地点
          travelMode: google.maps.TravelMode.DRIVING,     // [自動車]でのルート
          avoidHighways: true,        // 高速道路利用フラグ
      };
   
      // インスタンス作成
      directionsService = new google.maps.DirectionsService();
   
      directionsService.route(request, function(response, status) {
          if (status == google.maps.DirectionsStatus.OK) {
              directionsDisplay.setDirections(response);
          } else {
              alert('ルートが見つかりませんでした…');
          }
      });
  }
   
  // キック
  google.maps.event.addDomListener(window, 'load', function() {
      initialize(begin, end);
      calcRoute(begin, end);
  });