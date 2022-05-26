@extends('layouts.shop')

@section('content')
<h3>ご注文の確認</h3>
<!-- px 横余白2 -->
<main class="row mt-3 px-2">
   <!-- card （つぶあん）-->
   <div class="card mr-5 mx-5 py-3" style="width: 18rem;">
      <img src="../../../../assets/img/gozasoro.png" class="card-img-top" alt="虚無蔵(つぶあん）">
      <div class="card-body">
         <h5 class="card-title">くろあん/黄みあん</h5>
         <p class="card-text"></p>
         <dt>1個<span style="font-size: 16pt;font-family: verdana,arial,helvetica,sans-serif">95</span>円</dt>
      </div>
   </div>
   <!-- card （こしあん）-->
   <div class="card py-3" style="width: 21rem;">
      <p>こちらの注文内容でよろしければ「注文を確定する」を押してください。</p>
      <div class="col-10">
      <!-- FORM -->
      <!-- 受取方法・選択画面へ値を送る。 -->
      <form action="{{ route('receiving') }}" method="post">
      @csrf

      @foreach ($items as $key => $v)
         @if ( $v-> order_quantity !== 0 ) 
         <p class="dot_hidden">{{ $v -> product_name }}
            購入個数 {{ $v -> order_quantity }}個</p> 
        
         <!-- 注文個数が0なら表示しません。 -->
           <p>小計金額{{ $v -> price * $v-> order_quantity }}円</p>
           @endif
      @endforeach
         <dt>合計金額{{ $total }} 円</dt>
         <br>
         <a href="{{ url('/shop/updateCart') }}" class="btn btn-light">修正</a>
         <input type="submit" class="btn btn-warning" value="注文を確定する"> 
      </form>
      <!-- END FORM -->
      </div>
      <br>
      <pre></pre>
      <br>  
   </div>
   <!-- card END -->
</main>
@endsection