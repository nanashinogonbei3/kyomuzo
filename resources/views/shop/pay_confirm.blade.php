@extends('layouts.member')

@section('content')
<span class="section-heading-lower">ご注文の確認</span>
<div class="container-md">

      <div class="row mt-3">

            <div class="md-4">
                  <div class="card">

                        <div class="card-body">
                              <form action="{{ route('thanks') }}" method="post">
                                    @csrf

                                    <ul>
                                          <dt>商品の受取方法</dt>
                                          <li class="dot_hidden">{{ $receivingMethod }}</li>
                                    </ul>

                                    <ul>
                                          <dt>お支払方法</dt>

                                          <li class="dot_hidden">{{ $paymentMethod }}</li>

                                    </ul>

                                    <input type="submit" class="btn btn-primary">
                                    <a href="{{ url('/shop/pay') }}" class="btn btn-light">支払方法を変更する</a>
                                    <!-- リンク確認の仮設ボタン-後で削除する！ -->

                              </form>
                        </div>
                  </div>
            </div>
      </div>
</div>
@endsection