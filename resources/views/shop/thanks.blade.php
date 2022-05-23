@extends('layouts.shop')


@section('content')
<!-- px 横余白2 -->
<h3>ご注文ありがとうございました。</h3>

<div class="card">
  <div class="card-body">   
      @foreach ($order as $key => $v) 
      <h3>注文No:{{ $v-> id }}</h3>    
        <ol>
          <li>ご注文日：{{ $v-> order_date }}</li>
          <li>購入店：{{ $v-> shop_name }}</li>
          <li>お受取り方法：{{ $v-> receiving_method }}</li>
          <li>商品名：{{ $v-> product_name }}</li>
          <li>購入個数：{{ $v-> order_quantity }}</li>
          <li>お支払方法：{{ $v-> payment_method }}</li>
          <li>ご請求金額：{{ $v-> price * $v-> order_quantity }}円</li>
        </ol>
      @endforeach
  </div>
</div>
@endsection