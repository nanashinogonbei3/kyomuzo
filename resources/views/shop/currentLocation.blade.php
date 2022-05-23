<!DOCTYPE html>

</script>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Document</title>
      </head>
    <body>

    <div id="map" style="height:500px"></div>

	
<script>

    // currentLocation.jsで使用する定数latに、controllerで定義した$latをいれて、currentLocation.jsに渡す
    const lat = "{{ $lat }}";
    // currentLocation.jsで使用する定数lngに、controllerで定義した$lngをいれて、currentLocation.jsに渡す
    const lng = "{{ $lng }}";
 
</script>

  
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
	
    <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDmLccsmiUhpznw2Xsl2YoV7PCj86kwOKg&callback=initMap" async defer></script> -->
    <script async defer  
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyClnXQEBcqHu2AWUOmWeNyK2a1ObmFfhtg" charset="utf-8">
    </script>

<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDmLccsmiUhpznw2Xsl2YoV7PCj86kwOKg"></script> -->
<script src="{{ asset('/js/currentLocation.js') }}"></script>
<script src="{{ asset('/js/setLocation.js') }}"></script>

    </body>
</html>