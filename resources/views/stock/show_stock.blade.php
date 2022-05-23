@extends('layouts.product')

@section('content')
<h2 class="section-heading-lower">製造商品管理画面</h2>

<!-- Navibar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/product/products') }}">製造商品登録</a>
        </li>


      </ul>
      <a href="{{ url('/shop/login') }}" >ログアウト</a>
    </div>
  </div>
</nav>

<!-- Navibar END -->

<div class="container-md">
        <!-- mt-3 margin-top: 3; -->
      <div class="row mt-3">
         <table class="table table-success table-striped">  
            <thead>
               <tr>
                  <th>在庫ID</th>
                  <th>商品名</th>
                  <th>店舗ID</th>
                  <th>数量</th>
                  <th>製造年月日</th>
               </tr>
            </thead>
            <tbody>
              <tr>
      
            <tbody>
              <tr>      
                  <td>{{ $stocks['id'] }}</td> 
                  <td>{{ $stocks['product_name'] }}</td>
                  <td>{{ $stocks['shop_name'] }}</td>
                  <td>{{ $stocks['stock_quantity'] }}個</td>
                  <td>{{ $stocks['production_date'] }}</td>  
              </tr>
            </tbody>
            
           
        </table>
          <div><a href="{{ url('/stock/stock_list') }}" class="btn btn-light">戻る</a></div>
      </div>
</div>

@endsection
