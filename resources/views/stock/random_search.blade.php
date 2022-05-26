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
          <a class="nav-link" href="{{ url('/stock/stock') }}">製造商品登録</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            検索の絞込み
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            @foreach($productName_List as $key => $v)
               <li><a href="/stock/find_stock/{{ $key }}">{{ $v }}</a></li>
            @endforeach
            <!-- ↓くぎり線 -->
            <li><hr class="dropdown-divider"></li>
            @foreach($shopName_List as $key =>$v)
            <li><a href="/stock/search_stock/{{ $key }}">{{ $v }}</a></li>
            @endforeach
          </ul>
        </li>
        <br>
        <li class="nav-item">
          <a class="nav-link disabled">ログアウト</a>
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
                  <th>在庫id</th>
                  <th>店舗</th>
                  <th>商品名</th>    
                  <th>製造個数</th>
                  <th>製造年月日</th>
                  <th>登録者名</th>
                  <th></th>
               </tr>
            </thead>
            <tbody>
              <tr> 
            <tbody>
                  @foreach($items as $key => $v)
              <tr>
                  <td>{{ $v->id }}</td>
                  <td>{{ $v->shop_name }}</td>
                  <td>{{ $v->product_name }}</td>
                  <td>{{ $v->stock_quantity }}</td>
                  <td>{{ $v->production_date }}</td>
                  <td>{{ $v->last_name }}</td>
                  <td>
                    <a href="{{ route('stock_show', $v->id ) }}" class="btn btn-primary">詳細</a>
                    <a href="{{ route('stock_edit', $v->id ) }}" class="btn btn-primary">修正</a>
                  </td>
              </tr>
                  @endforeach
            </tbody>       
        </table>
        {{ $items->links() }}
      </div>
</div>

@endsection
