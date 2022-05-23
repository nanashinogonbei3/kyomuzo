@extends('layouts.shop')


@section('content')


<h3>取扱い店舗一覧</h3>
<!-- card  -->
<img src="../../../../assets/img/kyomuzo.png" class="card-img-top" alt="...">

<div class="card mb-3">
<br><br>
  <div class="card-body">
  <!-- form  -->
  <form action="{{ route('purchase') }}" method="post">
  @csrf
    <h5 class="card-text">京都太秦店
      <button type="submit" class="btn btn-warning">太秦店から購入する</button>
    </h5>
    <input type="hidden" name="shop_id" value="1">
  </form>
  <!-- form END -->
   <br>
   <p>〒6167716 京都府京都市右京区太秦東峰岡町10番地<br>
   Tel:080-1254-8874 </p>
   <hr>
   <br>
  <!-- form -->
  <form action="{{ route('purchase') }}" method="post">
  @csrf
    <h5 class="card-text">京都祇園店
     <button type="submit" class="btn btn-success">祇園店から購入する</button>
    </h5>
   <input type="hidden" name="shop_id" value="2">
  </form>
  <!-- form END -->
   <br>
   <p>〒6050073 京都府京都市東山区祇園町北側625番地<br>
   Tel:080-5678-9012</p>
   <hr>
   <br>
   </div>
</div>
<!-- card END -->

@endsection