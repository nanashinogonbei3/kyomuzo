@extends('layouts.product')

@section('content')
<h2 class="section-heading-lower">売上げ明細詳細</h2>

<!-- Navibar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/stock/stock') }}">製造商品登録</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            検索の絞込み
          </a>
        </li>
        <br>
        <li class="nav-item">
          <a href="/stock/stock_control">在庫</a>
        </li>
     
      </ul>
     
     
        <button type="submit" value="find" class="btn btn-outline-success" >
        <a href="{{ url('/stock/sales_history') }}">一覧</a></button>
        <br><br><br>
        <button type="button" class="btn btn-outline-warning" onClick="history.back()">戻る</button>
      
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
                  <th>注文No.</th>
                  <th>商品名</th>
                  <th>販売個数</th>
                  <th>小計</th>
                  <th>店舗</th>
                  <th>購入者</th>
                  <th>販売年月日</th>
                 
               </tr>
            </thead>

            <tbody>
            @foreach ($orders as $key => $v)
              <tr>
                  <td>{{ $v['id'] }}</td>
                  <td>{{ $v['product_name'] }}</td>
                  <td>{{ $v['order_quantity'] }}</td>
                  <td>￥{{ $v['price'] * $v['order_quantity'] }}</td>
                  <td>{{ $v['shop_name'] }}</td>
                  <td>{{ $v['last_name'] }}&nbsp;様</td>
                  <td>{{ $v['order_date'] }}</td>
                  
                 
              </tr>
            @endforeach
            </tbody>
        </table>


        <!-- 支払方法 -->
        <div class="card text-center">
          <div class="card-header">
            <ul class="nav nav-pills card-header-pills">     
              <li class="nav-item">
                <a class="nav-link" href="#"></a>
              </li>
              <li class="nav-item">
               <p class="card-title">お支払方法・商品のお渡し方法</p>
              </li>
              
            </ul>
          </div>
          <div class="card-body">
          @foreach ($orders as $key => $v)
            
            <p class="card-text">{{ $v['payment_method'] }}</p>
            <p class="card-text">{{ $v['receiving_method'] }}</p>
            <p class="card-text">合計金額：￥{{ $total }}</p>
            @break
          @endforeach
          </div>


        <!-- END card text-center -->
        </div>

        <!-- ***** -->
         <!-- 配送先 -->
          <!-- 支払方法 -->
        @foreach ($orders as $key => $v)
          @if ($v['receiving_method'] === "ご自宅配送") 
        <div class="card text-center">
          <div class="card-header">
            <ul class="nav nav-pills card-header-pills">
              <li class="nav-item">
                <a class="nav-link active" href="{{ url('/stock/sales_history') }}">一覧</a>
                <br>
                <button type="button" class="btn btn-outline-warning" onClick="history.back()">戻る</button>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#"></a>
              </li>
              <li class="nav-item">
               <p class="card-title">配送先住所/お名前</p>
              </li>
            </ul>
          </div>
          <div class="card-body">
          
          
           
            <p class="card-text">〒{{ $v['postal_code'] }}&nbsp;&nbsp;{{ $v['address1'] }}
              {{ $v['address2'] }}{{ $v['address3'] }}{{ $v['address4'] }}{{ $v['address5'] }}</p>
            <p class="card-text">{{ $v['last_name'] }}&nbsp;&nbsp;{{ $v['first_name'] }}&nbsp;様</p>

            <p>配送方法：クール宅急便</p>
          
          </div>

        <!-- END card text-center -->
        </div>
          @endif
           @break
        @endforeach

      </div>
</div>

@endsection
