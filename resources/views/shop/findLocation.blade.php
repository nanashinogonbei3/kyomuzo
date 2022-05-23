@extends('layouts.member')

@section('content')

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Document</title>
      </head>
	

     <!-- 入力した住所から緯度経度に変換します。 -->
    
    <input type="text" id="addressInput">
    <button id="searchGeo" class="btn btn-success">&nbsp;&nbsp;&nbsp;緯度経度変換</button>
    <pre></pre>
 <form action="{{ route('rootResult') }}" method="get">
    <div>
        緯度：<input type="text" name="lat" id="lat">
        経度：<input type="text" name="lng" id="lng">
        <input type="submit">
    </div>
 </form>




    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
	
    <script async defer  
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDmLccsmiUhpznw2Xsl2YoV7PCj86kwOKg" charset="utf-8">
    </script>

    <script src="{{ asset('/js/getLatLng.js') }}"></script>
  
    
    </body>
</html>



@endsection