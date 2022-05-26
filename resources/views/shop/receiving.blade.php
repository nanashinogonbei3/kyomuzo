@extends('layouts.member')

@section('content')
<span class="section-heading-lower">商品の受け取り方法</span>
      <div class="container-md">
            <div class="row mt-3">
                  <div class="md-4">
                        <div class="card">
                        <!-- FORM -->
                        <form action="{{ route('pay') }}" method="post"> 
                        @csrf
                              <!-- 自宅配送 -->
                              <div class="card-body">            
                                 <div class="card">
                                    <h5 class="card-header">ご自宅配送</h5>
                                    <div class="card-body">                                    
                                  <p class="card-text"><input type="checkbox" name="receiving_method" value="ご自宅配送">&nbsp;{{ $member['postal_code'] }} 
                                      {{ $member['address1'] }}{{ $member['address2'] }}{{ $member['address3'] }} 
                                      {{ $member['address4'] }} 
                                    <!-- もし建物名があればaddress5を表示させる -->
                                    @if (!empty($member['address5'])) 
                                        {{ $member['address5'] }} 
                                    @endif
                                    &nbsp;
                                        {{ $member['last_name'] }}{{ $member['first_name'] }} 様</p>                  
                                    </div>
                                 </div>
                                 <br>
                                 <div class="card">      
                                    <!-- 店舗受け取り -->
                                    <div class="card-body">
                                    <h5 class="card-header">店舗受け取り</h5>
                                          <p class="card-text">&nbsp;</p>
                                        <input type="checkbox" name="receiving_method" value="{{ $shop['shop_name'] }}受取り" checked>&nbsp;{{ $shop['shop_name'] }} で受け取ります。
                                          <br><br>
                                          <button type="submit" class="btn btn-primary">登録</button>
                                          <!-- リセットボタン -->
                                          <input type="reset" value="リセット">
                                    </div>
                                 <!-- div.card END -->
                                 </div>
                              <!-- div.card-body END -->
                              </div> 
                        <!-- END FORM -->
                        </form>
                        <!-- div.card END -->
                        </div>
                  <!-- div.md-4 END -->
                  </div>
                  <!-- ****************************************************************************************** -->
            <!-- div.row mt-3 END -->
            </div>
            <br><br>
            <!-- 店舗地図のリンク -->
            <div class="row">
                  <div class="col-sm-6">
                        <div class="card">
                              <div class="card-body">
                                    <h5 class="card-title">京都太秦店</h5>
                                    <p class="card-text">京都府京都市右京区太秦西蜂岡町９</p>
                                    <p>10時～20時 TEL 075-862-5003</p>
                                    <a href="{{ url('/shop/store_uzumasa') }}" class="btn btn-success">Google Map</a>
                              </div>
                        </div>
                  </div>
                  <div class="col-sm-6">
                        <div class="card">
                              <div class="card-body">
                                    <h5 class="card-title">京都祇園店</h5>
                                    <p class="card-text">京都府京都市東山区祇園町北側</p>
                                    <p>10時～19時 TEL 075-561-6155</p>
                                    <a href="{{ url('/shop/store_gion') }}" class="btn btn-success">Google Map</a>
                              </div>
                        </div>
                  </div>
            <!-- 店舗地図のリンクEND -->
            </div>
      <!-- div.container-md END -->
      </div>

@endsection