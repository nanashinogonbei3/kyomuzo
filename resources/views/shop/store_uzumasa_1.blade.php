@extends('layouts.store')




@section('content1')
<!-- この中に地図を表示します・太秦店 -->
<div class="card mb-3">

<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>Google Maps JavaScript API</title>
    <!-- CSS only -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
      crossorigin="anonymous">

  </head>
  <body onload="initialize()">
   <p>京都太秦店</p>
   <div>
     <a class="nav-link" href="{{ url('/shop/root_result_uzumasa') }}">アクセス</a>
   </div>
   <div id="map" style="width:720px; height: 500px"></div>

<script>

// currentLocation.jsで使用する定数latに、controllerで定義した$latをいれて、currentLocation.jsに渡す
const lat = "{{ $lat }}";
// currentLocation.jsで使用する定数lngに、controllerで定義した$lngをいれて、currentLocation.jsに渡す
const lng = "{{ $lng }}";

</script>
    
  <!-- 自分のAPI keyを設定し、定義したファンクションiniMapを設定する -->
  <script async defer  
     src="https://maps.googleapis.com/maps/api/js?key=AIzaSyATJee6B3tUEUuIiqM85uVwGlpFmqxxe-w&callback">
    </script>
  
   <script src="{{ asset('/js/storesLocation.js') }}"></script>
    
  

 
</div>
@endsection




