@extends('layouts.member')

@section('content')
<span class="section-heading-lower">商品の受け取り方法</span>
     @extends('layouts.member')

@section('content')
<span class="section-heading-lower">商品のお支払方法</span>
<!-- FORM -->
<form action="{{ route('pay_confirm') }}" method="post">
@csrf
<div class="card" style="width: 18rem;">
  <div class="card-header">
    支払方法
  </div>

  <ul class="list-group list-group-flush">
    <li class="list-group-item"><input type="radio" name="payment_method" value="クレジット">カード支払い</li>
    <li class="list-group-item"><input type="radio" name="payment_method" value="代引き">代引き</li>
    <li class="list-group-item"><input type="radio" name="payment_method" value="paypay">paypay払い</li>
    <li class="list-group-item"><input type="radio" name="payment_method" value="銀行振込">銀行振込</li>
  </ul>
  
</div>
<br>
<input type="submit" class="btn btn-warning" value="注文を確定する">
<!-- <a href="{{ url('/shop/pay_confirm') }}" class="btn btn-warning">(テスト)注文を確定する</a> -->
&nbsp;&nbsp; 
<!-- リセットボタン -->
<input type="reset" value="リセット"> 
</form>
<!-- END FORM --> 

<a href="{{ url('/shop/index') }}" class="btn btn-light">キャンセル</a>

@endsection