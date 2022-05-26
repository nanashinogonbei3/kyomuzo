@extends('layouts.store')

@section('content1')
<body onload="initialize()">
  <div class="card mb-3">
    <p>京都太秦店</p>
    <div>
      <a class="nav-link" href="{{ url('/shop/root_result_uzumasa') }}"><h5><dt>アクセス</dt></h5></a>
    </div>
    <div id="map" style="width:720px; height: 500px"></div>
    <script>
    // js/storesLocation.jsで使用する定数に、controllerでDBから取り出した緯度を$latに格納し、js/storesLocation.jsに渡す
    const lat = "{{ $lat }}";
    // js/storesLocation.jsで使用する定数に、controllerでDBから取り出した経度を$lngに格納し、js/storesLocation.jsに渡す
    const lng = "{{ $lng }}";
    </script>   
    <!-- 自分のAPI keyを設定し、定義したファンクションiniMapを設定する -->
    <script async defer  
     src="https://maps.googleapis.com/maps/api/js?key=AIzaSyATJee6B3tUEUuIiqM85uVwGlpFmqxxe-w&callback">
    </script>
    <script src="{{ asset('/js/storesLocation.js') }}"></script> 
  </div>
</body> 
@endsection




