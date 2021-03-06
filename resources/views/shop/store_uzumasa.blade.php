@extends('layouts.store')

@section('content1')
<!-- この中に地図を表示します・太秦店 -->
  <body onload="initialize()">
  <div class="card mb-3">
   <p>京都祇園店</p>
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
    <script src="{{ asset('/js/map.js') }}"></script>
    <!-- 自分のAPI keyを設定し、定義したファンクションiniMapを設定する -->
    <script async defer  
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyATJee6B3tUEUuIiqM85uVwGlpFmqxxe-w&callback">
    </script>
  </body>
</div>
@endsection



