@extends('layouts.product')

@section('content')
<span class="section-heading-lower">製造商品登録</span>
  <div class="container-md">
    <!-- mt-3 margin-top: 3; -->
    <div class="row mt-3">
      <!-- col-mdでページ全体をフォームに（12） -->
      <div class="md-4">
        <div class="card">
          <div class="card-header">
            &nbsp;&nbsp;&nbsp;
          </div>
          <div class="card-body">
            <form action="{{ route('stock_update', $stocks) }}" method="post">
              @csrf
              <!-- 商品ID(商品名) -->
              <div class="row mb-3">
                <!-- 必須ボタンは、bootstrap https://getbootstrap.com/docs/5.1/components/badge/ -->
                <label for="inputProductId" class="col-sm-2 col-form-label">商品ID&nbsp;<span class="badge bg-danger">必須</span></label>
                  <div class="col-sm-3">
                        @if ($errors->has('product_id'))
                        @foreach($errors->get('product_id') as $message)
                        <span class="text-danger">{{ $message }}</span>
                        <br>
                        @endforeach
                        @endif
                        <!-- 今現在DB登録している商品名 -->
                        {{ $stocks['product_name'] }}
                        <!-- 商品ID(商品名)選択 -->
                        <select id="inputProductId" name="product_id" class="form-control @error('product_id') is-invalid @enderror" value="{{ old('product_id') }}">
                        @foreach($product_list as $id => $product_name)
                        <option value="{{ $id }}">{{ $product_name }}</option>
                        @endforeach
                        </select>
                        <!-- product_id(product_name) END -->
                  </div>
              </div>
              <!-- 店舗ID -->
              <div class="row mb-3">
                <label for="inputShop" class="col-sm-2 col-form-label">店舗名&nbsp;<span class="badge bg-danger">必須</span></label>
                  <div class="col-sm-4">
                        @if ($errors->has('shop_id'))
                        @foreach($errors->get('shop_id') as $message)
                        <span class="text-danger">{{ $message }}</span>
                        @endforeach
                        @endif
                        <!-- 今現在DB登録している店舗名 -->
                        {{ $stocks['shop_name'] }}
                        <!-- 店舗選択 -->
                        <select id="inputShop" name="shop_id" class="form-control @error('shop_id') is-invalid @enderror" value="{{ old('shop_id') }}">
                        @foreach($shop_list as $id => $shop_name)
                        <option value="{{ $id }}">{{ $shop_name }}</option>
                        @endforeach
                        </select>
                        <!-- shop END -->
                  </div>
              </div>
               <!-- 数量 -->
               <div class="row mb-3">
                  <label for="inputStockQty" class="col-sm-2 col-form-label">数量&nbsp;<span class="badge bg-danger">必須</span></label>
                  <div class="col-sm-2">
                        <!-- 今現在のDB登録している在庫個数 -->
                        {{ $stocks['stock_quantity'] }}
                        <input type="text" name="stock_quantity" id="inputStockQty" class="form-control 
                                          @error('stock_quantity') is-invalid @enderror " value="{{ old('stock_quantity') }}" aria-describedby="validateExpirationDate">
                        @error('stock_quantity')
                        <div id="validateExpirationDate" class="invalid-feedback">
                        {{ $message }}
                        </div>
                        @enderror
                  </div>
              </div>
              <!-- 製造年月日 -->
              <div class="row mb-3">
                <label for="inputProductionDate" class="col-sm-2 col-form-label">製造年月日&nbsp;<span class="badge bg-danger">必須</span></label>
                <div class="col-sm-3">
                        <!-- 今現在のDB登録している製造年月日 -->
                        {{ $stocks['production_date'] }}
                        @if ($errors->has('production_date'))
                          @foreach($errors->get('production_date') as $message)
                          <span class="text-danger">{{ $message }}</span>
                          <br>
                          @endforeach
                        @endif
                  <input type="date" name="production_date" id="inputProductionDate" class="form-control
                  @error('production_date') is-invalid @enderror " value="{{ old('production_date') }}" aria-describedby="validateExpirationDate">
                </div>
              </div>
              <a href="{{ url('/stock/stock_list') }}" class="btn btn-light">戻る</a>
              <button type="submit" class="btn btn-primary">登録</button>
            </form>
          <!-- div.card-body END -->
          </div>
        </div>
       <!-- div.md-4 END -->
      </div>
    </div>
  </div>
@endsection