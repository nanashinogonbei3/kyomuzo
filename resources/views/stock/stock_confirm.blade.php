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
                    <form action="{{ route('stock_store') }}" method="post">
                    @csrf
                            <!-- 商品名 -->
                            <div class="row mb-3">
                              <!-- 必須ボタンは、bootstrap https://getbootstrap.com/docs/5.1/components/badge/ -->
                              <label for="product_name" class="col-sm-2 col-form-label">商品名&nbsp;</label>
                    
                              <div class="col-sm-3">
                               <dt>{{ $inputs['product_name'] }}</dt>
                              </div>
                            </div>

                            <!-- 店舗名 -->
                            <div class="row mb-3">
                              
                              <label for="shop_name" class="col-sm-2 col-form-label">店舗名&nbsp;</label>
                         
                              <div class="col-sm-3">
                               <dt>{{ $inputs['shop_name'] }}</dt>
                              </div>
                            </div>

                            <!-- 製造個数 -->
                            <div class="row mb-3">
                             
                              <label for="stock_quantity" class="col-sm-2 col-form-label">製造個数&nbsp;</label>
                          
                              <div class="col-sm-2">
                               <dt>{{ $inputs['stock_quantity'] }}個</dt>
                              </div>
                            </div>

                            <!-- 製造日 -->
                            <div class="row mb-3">
                              
                              <label for="production_date" class="col-sm-2 col-form-label">製造年月日&nbsp;</label>
                         
                              <div class="col-sm-3">
                               <dt>{{ $inputs['production_date'] }}</dt>
                              </div>
                            </div>
                            
                            <button type="submit" class="btn btn-warning">登録する</button>
                            

                            <!-- 修正する -->
                              <a href="{{ url('/stock/stock') }}" class="btn btn-info">修正</a>
                          </form>
                    </div>
                  </div>
            </div>
        </div>
    </div>

@endsection
