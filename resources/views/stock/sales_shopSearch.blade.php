@extends('layouts.product')

@section('content')
<h2 class="section-heading-lower">店舗販売履歴</h2>
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
            @foreach($productName_List as $key => $v)
            <li><a href="/stock/sales_productSearch/{{ $key }}">{{ $v }}</a></li>
            @endforeach
            <!-- ↓hr くぎり線 -->
            <li><hr class="dropdown-divider"></li>
            @foreach($shopName_List as $key =>$v)
            <li><a href="/stock/sales_shopSearch/{{ $key }}">{{ $v }}</a></li>
            @endforeach
          </ul>
        </li>
        <form action="{{ route('sales_randomSerch') }}" method="get" class="d-flex">
        @csrf
          <input type="text" name="input" value="{{$input}}" class="form-control me-2"  placeholder="Search" aria-label="Search">
          <button type="submit" value="find" class="btn btn-outline-success" >Search</button>
        </form>
      </ul>
    </div>
  </div>
<!-- END Navibar -->
</nav>
<div class="container-md">
      <div class="row mt-3">
         <table class="table table-success table-striped">  
            <thead>
               <tr>
                  <th>注文No.</th>
                  <th>商品名</th>
                  <th>売上金額</th>
                  <th>店舗</th>
                  <th>購入者</th>
                  <th>販売年月日</th>
                  <!-- 明細 ・売上金額95*個数=合計の販売個数 購入者 氏名 配送先住所・支払方法・受取方法  -->
                  <th></th>
               </tr>
            </thead>
            <tbody>
            @foreach ($items as $key => $v)
              <tr>
                  <td>{{ $v->id }}</td>
                  <td>{{ $v->product_name }}他</td>
                  <!-- 合計お支払金額 -->
                  <td>￥{{ $v->price * $v->total_quantity }}</td>
                  <td>{{ $v->shop_name }}</td>
                  <td>{{ $v->last_name }}&nbsp;様</td>
                  <td>{{ $v->order_date }}</td>
                  <td>
                      <a href="{{ route('sales_show', $v->id ) }}" class="btn btn-primary">詳細</a>    
                  </td>
              </tr>
            @endforeach
            </tbody>
        </table>
        {{ $items->links(); }}
      </div>
</div>

@endsection
