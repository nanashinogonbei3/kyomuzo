@extends('layouts.shop')


@section('content')



<main class="row mt-3 px-2">
<!-- top  -->
<div class="card mb-3 p-0">
<div class="card-body">
      <h5 class="card-title"></h5>
      <p class="wf-sawarabimincho">虚無蔵は創業161年。1859年、京都の太秦で初代の吉備太郎が第1店舗を開業しました。</p>
   </div>
<img src="../../../../assets/img/top3.png" class="card-img-top" alt="虚無蔵(くろあん）">
   
</div>

<!-- card （くろあん）-->
<div class="card mb-3 p-0">
<img src="../../../../assets/img/kuro.png" class="card-img-top" alt="虚無蔵(くろあん）">
   <div class="card-body">
    
      <p class="card-text"><a href="{{ url('shop/orders') }}"><button type="button" class="btn btn-outline-warning">取り扱い店舗</button></a></p>
      
   </div>
</div>
<!-- card （白あん）-->
<div class="card mb-3 p-0">
<img src="../../../../assets/img/shiro.png" class="card-img-top" alt="虚無蔵(白あん）">
   <div class="card-body">
    
   <p class="card-text"><a href="{{ url('shop/orders') }}"><button type="button" class="btn btn-outline-warning">取り扱い店舗</button></a></p>
   </div>
</div>   
<!-- card (オンライン・ショップ) -->
<div class="card mb-3 p-0">
<img src="../../../../assets/img/shirokuro.png" class="card-img-top" alt="虚無蔵(白あんくろあん）">
   <div class="card-body">
     
      <button type="button" class="btn btn-outline-success">【オンライン・ショップ】</button>
   </div>
</div>

</main>
@endsection