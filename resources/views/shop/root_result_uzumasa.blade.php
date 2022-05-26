@extends('layouts.shop_root_uzumasa')

@section('content')

<!-- この中に地図を表示します・太秦店 -->
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>Google Maps JavaScript API 2点間のルート案内</title>
    <!-- CSS only -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
      crossorigin="anonymous">
    <style>
    p {line-height:180%}
    .head-title {width:100%;background:#87ceeb;color:#fff;text-indent:8px;font-weight:700;line-height:180%}
    </style>
</head>
<body>
<div class="card mb-3"> 

<!-- 入力した住所から緯度経度に変換します。 -->
<div>   
出発地点：<input type="text" id="addressInput" placeholder="京都駅">

<button id="searchGeo" class="btn btn-success">&nbsp;緯度経度変換</button>
<a href="{{ url('shop/stores') }}"><button type="button" class="btn btn-outline-warning">戻る</button></a>

<pre></pre><pre></pre>
 <form action="{{ route('rootResult2') }}" method="get">
    <div>
        緯度：<input type="text" name="lat" id="lat">
        経度：<input type="text" name="lng" id="lng">
        <input type="submit">
    </div>
 </form>
</div>
<pre></pre>

<div class="head-title">Google Maps APIのルート案内</div>
  <!-- 地図が表示されるDIV -->
  <div id="map" style="width:100%;height:500px"></div>
  <!-- ルート検索の結果を地図上に描画表示するDIV -->
  <div id="response"></div>

  <!-- 入力した住所の緯度経度を変数に格納します。 -->
  <script>
    // root_2point_map_uzumasa.jsで使用する定数latに、controllerで定義した$latをいれて、root_2point_map_uzumasa.jsに渡す
    const lat = "{{ $lat }}";
    // root_2point_map_uzumasa.jsで使用する定数lngに、controllerで定義した$lngをいれて、root_2point_map_uzumasa.jsに渡す
    const lng = "{{ $lng }}";
  </script>
  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
  <script async defer  
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDmLccsmiUhpznw2Xsl2YoV7PCj86kwOKg" charset="utf-8">
  </script>
  <!-- ２点間距離からルートを表示します。 -->
  <script src="{{ asset('/js/root_2point_map_uzumasa.js') }}"></script>
  <!-- 入力した住所から緯度経度を出力します。 -->
  <script src="{{ asset('/js/getLatLng.js') }}"></script>
  </body>
</div>
</html>

@endsection




