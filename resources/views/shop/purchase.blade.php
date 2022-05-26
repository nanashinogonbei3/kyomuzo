@extends('layouts.shop')

@section('content')
<!-- px 横余白2 -->
<h3>ご注文</h3>
<main class="row mt-3 px-2">
   <!-- card （くろあん）-->
   <div class="card mr-5 mx-5 py-3" style="width: 18rem;">
      <img src="../../../../assets/img/gozasoro.png" class="card-img-top" alt="虚無蔵(つぶあん）">
      <div class="card-body">
         <h5 class="card-title">くろあん<dt>1個<span style="font-size: 16pt;font-family: verdana,arial,helvetica,sans-serif">95</span>円</h5>
         <div class="col-3">
            <label for="num_kuro" class="col-form-label">
               <form action="{{ route('confirm') }}" method="post">
               @csrf
               <div class="wrapper">
                  <!-- くろあん -->
                  <input type="hidden" name="product_id" value="1">
                  <!-- ＋ buttom -->
                  <input type="button" value="-" onclick="count_downA()">
                  {{--個数 order_quantity--}}
                  <input type="number" name="order_quantity" id="press-buttonA" value="0" class="input_number">
                  <!-- － buttom -->
                  <input type="button" value="+" onclick="count_upA()">&nbsp;&nbsp;&nbsp;
                  <input type="submit" class="btn btn-warning" value="カートに入れる">
               </div>
                  <br>
               </form>
               <!-- form END -->   
            </label>
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
         <label for="num_kuro" class="col-form-label">
               <!-- FORM -->
               <form action="{{ route('confirm') }}" method="post">
               @csrf
               <div class="wrapper">
                  <!-- 黄みあん -->
                  <input type="hidden" name="product_id" value="2">
                  <!-- ＋ buttom -->
                  <input type="button" value="-" onclick="count_downB()">
                  {{--個数 order_quantity--}}
                  <input type="number" name="order_quantity" id="press-buttonB" value="0" class="input_number">
                  <!-- － buttom -->
                  <input type="button" value="+" onclick="count_upB()">&nbsp;&nbsp;&nbsp;
                  <input type="submit" class="btn btn-warning" value="カートに入れる"> 
               </div>
                  <br>
               </form>
            </label>
         </div>
      </div>
   <!-- 注文を確定する -->
   <a href="{{ url('/shop/confirm') }}">注文を確定する</a>
   <!-- card END -->
   </div>
</main>
@endsection