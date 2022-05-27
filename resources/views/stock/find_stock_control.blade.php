@extends('layouts.product')

@section('content')
<h2 class="section-heading-lower">商品別在庫個数</h2>
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
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <!-- 商品検索のプルダウンリストメニュー -->
              @foreach($productName_List as $key => $v)
              <li><a href="/stock/find_stock_control/{{ $key }}">{{ $v }}</a></li>
              @endforeach
            <!-- ↓hr くぎり線 -->
              <li><hr class="dropdown-divider"></li>
              <!-- 店舗検索のプルダウンリストメニュー -->
              @foreach($shopName_List as $key =>$v)
              <li><a href="/stock/search_stock_control/{{ $key }}">{{ $v }}</a></li>
              @endforeach
          </ul>
        </li>
        <li class="nav-item">
          <a href="/stock/stock_control">在庫</a>
        </li>
      </ul>
      <form action="{{ route('random_search') }}" method="get" class="d-flex">
        @csrf
        <input type="text" name="input" value="{{$input}}" class="form-control me-2"  placeholder="Search" aria-label="Search">
        <button type="submit" value="find" class="btn btn-outline-success" >Search</button>
      </form>
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
                  <!-- Orders.ID -->
                  <!-- <th>在庫No</th> -->
                  <th>商品名</th> 
                  <th>店舗名</th>
                  <th>在庫個数</th>
                  <th>製造年月日</th>    
               </tr>
            </thead>
            <tbody>
            @foreach($orderQty as $key => $v)
              @foreach ($v as $key2 => $v2)          
              <tr>
               <!-- 商品名 -->           
               <td>{{ $v2->product_name }}</td>
                <!-- 店舗名 -->
                <td>{{ $v2->shop_name }}</td>
                <!-- 在庫数 -->
                <td>{{ $v2->total_stock }}個</td>
                <!-- 在庫管理の日付 1日～月の末日 -->
                <td>{{ $key }}</td>
              </tr>
              @endforeach
            @endforeach
            </tbody>
        </table>
      </div>
</div>
@endsection
