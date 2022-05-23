@extends('layouts.member')


@section('content')



<!DOCTYPE html>
<html lang="ja">
<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Google Map APi LaravelでGoogle Mapを表示する</title>
</head>
    <body>
        <div id="map" style="height:500px">
	</div>
	

<form action="{{ route('confirm_LatLng') }}" method="post">
  
     <!-- lat 緯度 -->
     <input type="text" name="{{ lat }}">
    
     <!-- lng用 経度  -->
     <input type="text" value="{{ lng }}">

     <!-- setlocation.jsを読み込んで、位置情報取得するまで押せないようにdisabledを付与し、非アクティブにする。
      その後、disableはfalseになるようにsetlocation.js内に記述した  -->
     <button type="submit" class="btn btn-primary">送信</button>
    
</form>
	
     {{-- JQuery を追加 --}}
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

	<script src="{{ asset('/js/setLocation.js') }}"></script>
        <script src="{{ asset('/js/result.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/jslanguage=ja&region=JP&key=AIzaSyDmLccsmiUhpznw2Xsl2YoV7PCj86kwOKg" async defer>
	</script>
    </body>
</html>

@endsection