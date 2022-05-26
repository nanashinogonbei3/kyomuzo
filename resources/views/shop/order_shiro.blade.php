@extends('layouts.shop')

@section('content')
<main class="row mt-3 px-2">   
      <!-- card （黄みあん）-->
      <div class="card mb-3">
            <img src="../../../assets/img/gozasoro.png" class="card-img-top" alt="虚無蔵(白あん)">
            <div class="card-body">
                  <div class="card-body">
                        <h5 class="card-title">虚無蔵のくろあん</h5>
                        <p class="card-text">契約農家の北海道の十勝産のあずきを使い、創業当時と変わらぬ製法で造られたこだわりの白あんです。</p>
                  </div>
            </div>
      </div>
      <div class="card mb-3">
            <img src="../../../assets/img/gozasoro2.png" class="card-img-top" alt="虚無蔵(白あん)">
            <div class="card-body">
                  <div class="card-body">
                        <h5 class="card-title">虚無蔵の黄みあん</h5>
                        <p class="card-text">インゲン豆の一種である「絹てぼう」を使い、創業当時と変わらぬ製法で造られたこだわりの黄みあんです。</p>
                  </div>
            </div>
      </div>
      <!-- card END -->
      <div class="mb-3">
        <a href="{{ url('shop/orders') }}" class="btn btn-success">取り扱い店舗一覧</a>
      </div>
</main>
@endsection