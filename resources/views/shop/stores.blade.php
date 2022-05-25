@extends('layouts.member')

@section('content')

<!-- 店舗地図のリンク -->
<div class="row">
      <div class="col-sm-6">
            <div class="card">
                  <div class="card-body">

         
                    <form action="{{ route('uzumasa') }}" method="post">
                    @csrf
                        <input type="hidden" name="id" value="1">
                     
                        <h5 class="card-title">京都太秦店</h5>
                        <p class="card-text">京都府京都市右京区太秦西蜂岡町９</p>
                        <p>10時～20時 TEL 075-862-5003</p>                   
               
                       <!-- buttom -->
                       <button type="submit" name="button-submit" class="btn btn-success">Google Map</button>
                   </form>
                  
                  </div>
            </div>
      </div>
      <div class="col-sm-6">
            <div class="card">
                  <div class="card-body">
                    <!-- このフォームからGoogleMapLocation()メソッドへ緯度経度を送ります。 -->
                    <form action="{{ route('gion') }}" method="post">
                    @csrf
                        <input type="hidden" name="id" value="2">
                        
                        <h5 class="card-title">京都祇園店</h5>
                        <p class="card-text">京都府京都市東山区祇園町北側</p>
                        <p>10時～19時 TEL 075-561-6155</p>
                        
                       <!-- buttom -->
                       <button type="submit" name="button-submit" class="btn btn-success">Google Map</button>
                    </form>

                  </div>
            </div>
      </div>
<!-- 店舗地図のリンクEND -->
</div>

@endsection