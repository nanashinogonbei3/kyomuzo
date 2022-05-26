@extends('layouts.shop')

@section('content')
<!-- px 横余白2 -->
<h3>ご注文</h3>
<main class="row mt-3 px-2">
   <?php 
   $productId1_flag = false;
   $productId2_flag = false;
      foreach ($cartData as $key => $v) {
            if (!empty($v['product_id'] ==1)) { //product_id＝1がcartsのレコードにある場合
                  $productId1_flag = true;
            } 
            if (!empty($v['product_id'] ==2)) { //product_id＝2がcartsのレコードにある場合
                  $productId2_flag = true;
            }
      }
   ?>
   <!-- card （くろあん）-->
   <div class="card mr-5 mx-5 py-3" style="width: 18rem;">
      <img src="../../../../assets/img/gozasoro.png" class="card-img-top" alt="虚無蔵(つぶあん）">
      <div class="card-body">
         <h5 class="card-title">くろあん<dt>1個<span style="font-size: 16pt;font-family: verdana,arial,helvetica,sans-serif">95</span>円</h5>
         <div class="col-3">
            <!-- $productId1のレコード（product_id=1)がcartsテーブルにある時は、下記コードを表示します。（無い時は -->
            @if ($productId1_flag == true) 
            <label for="num_kuro" class="col-form-label">
             @foreach ($cartData as $v)
               @if ($v['product_id'] == 1 || $v['product_id'] == 1 AND $v['order_quantity'] >= 0 ) 
               <!-- FORM -->
               <form action="{{ route('cartfix') }}" method="post">
               @csrf
               <div class="wrapper">
                  <input type="hidden" name="id" value="{{ $v['id'] }}">
                  <!-- くろあん -->
                  <input type="hidden" name="product_id" value="1">
                  <!-- ＋ buttom -->
                  <input type="button" value="-" onclick="count_downA()">
                  {{--個数 order_quantity--}}
                  <input type="number" name="order_quantity" id="press-buttonA" value="{{ $v['order_quantity'] }}" class="input_number">
                  <!-- － buttom -->
                  <input type="button" value="+" onclick="count_upA()">&nbsp;&nbsp;&nbsp;
                  <input type="submit" class="btn btn-warning" value="カートに入れる">
               </div>
                  <br>
               </form>
               <!-- form END -->
               @endif
              @endforeach
              </label>
            <!-- $productId1のレコードがcartsテーブルにない時は、value="$v['id']" は存在しないので要らないです。＜72行目＞ -->
            @else 
            <label for="num_kuro" class="col-form-label">
               <!-- FORM -->
               <form action="{{ route('cartfix') }}" method="post">
               @csrf
               <div class="wrapper">
                  <!-- <input type="hidden" name="id" value="$v['id']は無いので不要です"> -->
                  <!-- くろあん -->
                  <input type="hidden" name="product_id" value="1">
                  <!-- ＋ buttom -->
                  <input type="button" value="-" onclick="count_downA()">
                  {{--個数 order_quantityはゼロなのでvalue="0"です。 --}}
                  <input type="number" name="order_quantity" id="press-buttonA" value="0" class="input_number">
                  <!-- － buttom -->
                  <input type="button" value="+" onclick="count_upA()">&nbsp;&nbsp;&nbsp;
                  <input type="submit" class="btn btn-warning" value="カートに入れる">
               </div>
                  <br>
               </form>
               <!-- form END -->
            @endif 
         </div>  
      </div>
   <!-- 注文を確定する -->
   <a href="{{ url('/shop/confirm') }}">注文を確定する</a>   
   </div>
   <!-- card （黄みあん）-->
   <div class="card py-3" style="width: 18rem;">
      <img src="../../../../assets/img/gozasoro2.png" class="card-img-top" alt="虚無蔵(つぶあん）">
      <div class="card-body">
         <h5 class="card-title">黄みあん<dt>1個<span style="font-size: 16pt;font-family: verdana,arial,helvetica,sans-serif">95</span>円</h5>
         <div class="col-3">
         <!-- $productId2のレコード（product_id=2)がcartsテーブルにある時は、下記コードを表示します。（無い時は -->
         @if ($productId2_flag == true)
         <label for="num_kuro" class="col-form-label">
            @foreach ($cartData as $v)
               @if ($v['product_id'] == 2 || $v['product_id'] == 2 AND $v['order_quantity'] >= 0 ) 
               <!-- FORM -->
               <form action="{{ route('cartfix') }}" method="post">
               @csrf
               <div class="wrapper">
                  <input type="hidden" name="id" value="{{ $v['id'] }}">
                  <!-- 黄みあん -->
                  <input type="hidden" name="product_id" value="2">
                  <!-- ＋ buttom -->
                  <input type="button" value="-" onclick="count_downB()">
                  {{--個数 order_quantity--}}
                  <input type="number" name="order_quantity" id="press-buttonB" value="{{ $v['order_quantity'] }}" class="input_number">
                  <!-- － buttom -->
                  <input type="button" value="+" onclick="count_upB()">&nbsp;&nbsp;&nbsp;
                  <input type="submit" class="btn btn-warning" value="カートに入れる"> 
               </div>
                  <br> 
               </form>
               @endif
            @endforeach
            </label>
         </div>
         <!-- $productId2のレコードがcartsテーブルにない時は、value="$v['id']" は存在しないので要らないです。 ＜142行目＞ -->
         @else 
            <label for="num_kuro" class="col-form-label">
               <!-- FORM -->
               <form action="{{ route('cartfix') }}" method="post">
               @csrf
               <div class="wrapper">
                  <!-- <input type="hidden" name="id" value="$v['id']は無いので不要です"> -->
                  <!-- くろあん -->
                  <input type="hidden" name="product_id" value="2">
                  <!-- ＋ buttom -->
                  <input type="button" value="-" onclick="count_downB()">
                  {{--個数 order_quantityはゼロなのでvalue="0"です。 --}}
                  <input type="number" name="order_quantity" id="press-buttonB" value="0" class="input_number">
                  <!-- － buttom -->
                  <input type="button" value="+" onclick="count_upB()">&nbsp;&nbsp;&nbsp;
                  <input type="submit" class="btn btn-warning" value="カートに入れる">
               </div>
                  <br>
               </form>
               <!-- form END -->
            @endif 
         </div>
      <!-- 注文を確定する -->
   <a href="{{ url('/shop/confirm') }}">注文を確定する</a> 
      </div> 
</main>
@endsection