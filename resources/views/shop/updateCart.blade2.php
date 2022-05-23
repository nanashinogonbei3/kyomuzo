@extends('layouts.shop')


@section('content')
<!-- px 横余白2 -->
<h3>ご注文</h3>

<main class="row mt-3 px-2">
   
<div class="card">
  <div class="card-header">    
      <div class="card-body">
            <!-- FORM -->
            <form action="{{ route('cartfix') }}" method="post">
            @csrf
            <div class="wrapper">

               <table class="table">
                  <thead>
                  <tr>
                        <th scope="col">ID</th>
                        <th scope="col">商品ID</th>
                        <th scope="col">商品名</th>
                        <th scope="col">注文個数</th>
                        <th scope="col">修正個数</th>
                  </tr>
                  </thead>
                  @foreach ($cartData as $v)
                  <tbody>
                        <input type="hidden" name="id" value="{{ $v->id }}">
                        <input type="hidden" name="product_id" value="{{ $v->product_id }}">
                        <input type="hidden" name="order_quantity" value="{{ $v->order_quantity }}">
                        <td>{{ $v->id }}</td>
                        <td>{{ $v->product_id }}</td>
                        <td></td>
                        <td>{{ $v->order_quantity }}個</td>
                        <td><input type="number" name="order_quantity" value="">個</td>

                        <td>
                        <input type="submit" class="btn btn-warning" value="修正"> 
                    {{--    <a href="{{ route('cart_del', $cartData ) }}" class="btn btn-primary">削除</a> --}}
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