@extends('layouts.store2')

@section('content3')
<!-- この中に地図を表示します・太秦店 -->
<!-- <html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>Google Maps JavaScript API</title>
  
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
      crossorigin="anonymous">
  </head> -->
<div class="card mb-3"> 
  <div class="card mb-3">
   <p>京都祇園店</p>
   <!-- 地図を表示する -->
   <div id="map_canvas" style="width:720px; height: 500px"></div>
   <div id="route" style="width: 720px; height: 50px;"></div>  
   <!-- マーカーの表示・非表示ボタン -->
   <form>
      <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
          <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
          <label class="btn btn-outline-primary" for="btnradio1"><input type="button" id="open" value="マーカー表示" onclick="doOpen()" /></label>
          <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
          <label class="btn btn-outline-primary" for="btnradio2"><input type="button" id="close" value="削除" onclick="doClose()" /></label>
      </div>
    </form>
  </div>
    <script src="{{ asset('/js/map2.js') }}"></script> 
    <!-- 自分のAPI keyを設定し、定義したファンクションiniMapを設定する -->
    <script async defer  
     src="https://maps.googleapis.com/maps/api/js?key=AIzaSyATJee6B3tUEUuIiqM85uVwGlpFmqxxe-w&callback">
    </script>
</div>
@endsection




