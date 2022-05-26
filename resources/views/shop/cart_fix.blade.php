@extends('layouts.shop')

@section('content')
<h3>ご注文</h3>
<!-- px 横余白2 -->
<main class="row mt-3 px-2">  
<div class="card">
  <div class="card-header">    
      <div class="card-body">
            <!-- FORM -->
            <form action="{{ route('confirm') }}" method="post">
            @csrf
            <div class="wrapper">
               <table class="table">
                  <thead>
                  <tr>
                        <th scope="col">ID</th>
                        <th scope="col">商品ID</th>
                        <th scope="col">商品名</th>
                        <th scope="col">注文個数</th>
                  </tr>
                  </thead>
                  @foreach ($cartData as $v)
                  <tbody>
                        <td>{{ $v->id }}</td>
                        <td>{{ $v->product_id }}</td>
                        <td></td>
                        <td>{{ $v->order_quantity }}</td>
                        <td>
                        <a href="{{ route('cart_fix', $stocks ) }}" class="btn btn-primary">修正</a>
                        <a href="{{ route('cart_del', $stocks ) }}" class="btn btn-primary">削除</a>
                  </td>
                  </tbody>
                  @endforeach
                  </table>         
            </div>
                  <br>
            <input type="submit" class="btn btn-warning" value="カートに入れる"> 
            </form>
      </div>
  </div>
</div>
<!-- card END -->
  
</main>
@endsection