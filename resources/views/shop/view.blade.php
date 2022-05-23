<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>gmapsサンプル</title>
    <style>
        @charset "utf-8";
        #map {
            height: 400px;
        }
    </style>
    <!-- 自分のAPI keyを設定し、定義したファンクションiniMapを設定する -->
   <script async defer  
     src="https://maps.googleapis.com/maps/api/js?key=AIzaSyATJee6B3tUEUuIiqM85uVwGlpFmqxxe-w&callback">
    </script>
    <script src="//raw.githubusercontent.com/HPNeo/gmaps/master/gmaps.js"></script>
    <script>
        window.onload = function(){
            var map = new GMaps({
                div: "#map",
                lat: 35.710285,
                lng: 139.77714,
                zoom: 15,
            });
        };
    </script>
</head>
<body>
    <div id="map"></div>
</body>
</html>