<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Document</title>
      </head>
	{!! Form::open(['route' => 'currentLocation','method' => 'get']) !!}
     {{--隠しフォームでresult.currentLocationに位置情報を渡す--}}
     {{--lat用--}}
     {!! Form::hidden('lat','lat',['class'=>'lat_input']) !!}
     {{--lng用--}}
     {!! Form::hidden('lng','lng',['class'=>'lng_input']) !!}
     {{--setlocation.jsを読み込んで、位置情報取得するまで押せないようにdisabledを付与し、非アクティブにする。--}}
     {{--その後、disableはfalseになるようにsetlocation.js内に記述した--}}
     {!! Form::submit("周辺を表示", ['class' => "btn btn-success btn-block",'disabled']) !!}
     {!! Form::close() !!}
     <!-- ボタン「周辺を表示」 -->
     </form>
     {{-- ここに追加 --}}
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script async defer  
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDmLccsmiUhpznw2Xsl2YoV7PCj86kwOKg" charset="utf-8">
    </script>
	<script src="{{ asset('/js/setLocation.js') }}"></script>
    </body>
</html>