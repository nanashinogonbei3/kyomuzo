@extends('layouts.member')

@section('content')
<span class="section-heading-lower">新規会員登録</span>
  <div class="container-md">
    <!-- mt-3 margin-top: 3; -->
    <div class="row mt-3">
      <!-- col-mdでページ全体をフォームに（12） -->
      <div class="col-md">
        <div class="card">
          <div class="card-header">
            &nbsp;&nbsp;&nbsp;
          </div>
          <div class="card-body">
            <form action="{{ route('join_confirm') }}" method="post">   
            @csrf
              <!-- 氏名 -->
              <div class="row mb-3">
              <label for="inputLastName" class="col-sm-2 col-form-label">お名前<br>
                <span class="badge bg-danger">必須</span></label>
                <div class="col-sm-10">
                  <input type="text" name="last_name" id="inputLastName" class="form-control
                            @error('last_name') is-invalid @enderror " value="{{ old('last_name') }}" aria-describedby="validateExpirationDate">
                            @error('last_name')
                            <div id="validateExpirationDate" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                </div>
              </div>
               <!-- お名前 -->
               <div class="row mb-3">
                <label for="inputFirstName" class="col-sm-2 col-form-label">お名前<br>
                  <span class="badge bg-danger">必須</span></label>
                  <div class="col-sm-10">
                    <input type="text" name="first_name" id="inputFirstName" class="form-control
                            @error('first_name') is-invalid @enderror " value="{{ old('first_name') }}" aria-describedby="validateExpirationDate">
                            @error('first_name')
                            <div id="validateExpirationDate" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                  </div>
              </div>
              <!-- Emailアドレス -->
              <div class="row mb-3">
                <!-- 必須ボタンは、bootstrap https://getbootstrap.com/docs/5.1/components/badge/ -->
                <label for="inputEmail3" class="col-sm-2 col-form-label">Emailアドレス<span class="badge bg-danger">必須</span></label>
                <div class="col-sm-10">
                  <input type="email" name="email" id="inputEmail3" class="form-control
                            @error('email') is-invalid @enderror " value="{{ old('email') }}" aria-describedby="validateExpirationDate">
                            @error('email')
                            <div id="validateExpirationDate" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                </div>
              </div>
              <!-- パスワード -->
              <div class="row mb-3">
                <!-- ラベルのfor=""と、id=""属性名を一致させることで、ラベルとidがれんけいされ、"パスワード"文字をブラウザで選択するとフォーム枠が強調され選択表示される。 -->
                <label for="password" class="col-sm-2 col-form-label">パスワード<span class="badge bg-danger">必須</span></label>
                <div class="col-sm-10">
                  <input type="password" name="password" id="password" class="form-control
                            @error('password') is-invalid @enderror "  aria-describedby="validateExpirationDate">
                            @error('password')
                            <div id="validateExpirationDate" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                </div>
              </div>

              <!-- 電話番号 -->
              <div class="row mb-3">
              <!-- ラベルのfor=""と、id=""属性名を一致させることで、ラベルとidがれんけいされ、"パスワード"文字をブラウザで選択するとフォーム枠が強調され選択表示される。 -->
              <label for="phone_number" class="col-sm-2 col-form-label">電話番号<span class="badge bg-danger">必須</span></label>
                <div class="col-sm-10">
                  <input type="phone_number" name="phone_number" id="pnone_no" class="form-control
                            @error('phone_number') is-invalid @enderror "  aria-describedby="validateExpirationDate">
                            @error('phone_number')
                            <div id="validateExpirationDate" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                </div>
              </div>
              <!-- placeholder="(例) 8120012 -->
              <!-- 郵便番号 -->
              <div class="row mb-3">
                <label for="input" class="col-sm-2 col-form-label">郵便番号</label>
                <div class="col-sm-10">
                  <!-- 郵便番号検索 -->
                  <input id="input" name="postal_code" id="input" class="form-control 
                  @error('postal_code') is-invalid @enderror " value="{{ old('postal_code') }}" aria-describedby="validateExpirationDate">
                            @error('postal_code')
                            <div id="validateExpirationDate" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                </div>
                <div>
                  <!-- 郵便局API検索リンク -->
                  <button id="search" type="button" class="btn btn-success">住所検索</button>
                  <a href="{{ url('https://www.post.japanpost.jp/zipcode/') }}" target="_blank" class="btn btn-info">郵便番号検索</a>

                  <!-- 郵便番号 End -->
                  <p id="error"></p>
                </div>
              </div>
              <!-- 都道府県 -->
              <div class="row mb-3">
                <label for="address1" class="col-sm-2 col-form-label">都道府県</label>
                <div class="col-sm-10">
                  <input id="address1" name="address1" class="form-control 
                  " value="{{ old('address1') }}" aria-describedby="validateExpirationDate">     
                </div>
              </div>
              <!-- 市区 -->
              <div class="row mb-3">
                <label for="address2" class="col-sm-2 col-form-label">市区町村</label>
                <div class="col-sm-10">
                  <input id="address2" name="address2" class="form-control 
                   " value="{{ old('address2') }}" aria-describedby="validateExpirationDate">
                </div>
              </div>
              <!-- 町村 -->
              <div class="row mb-3">
                <label for="address3" class="col-sm-2 col-form-label">町村</label>
                <div class="col-sm-10">
                  <input id="address3" name="address3" class="form-control 
                   " value="{{ old('address3') }}" aria-describedby="validateExpirationDate">     
                  </div>
              </div>
              <!-- 番地 -->
              <div class="row mb-3">
                <label for="address4" class="col-sm-2 col-form-label">番地</label>
                <div class="col-sm-10">
                  <input id="address4" name="address4" id="address4" class="form-control 
                  @error('address4') is-invalid @enderror " value="{{ old('address4') }}" aria-describedby="validateExpirationDate">
                            @error('address4')
                            <div id="validateExpirationDate" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                </div>
              </div>
              <!-- 建物名 -->
              <div class="row mb-3">
                <label for="address5" class="col-sm-2 col-form-label">建物名</label>
                <div class="col-sm-10">
                  <input id="address5" name="address5" class="form-control">
                </div>
              </div>
              <div class="mb-3">
                <!-- リセットボタン -->
                <input type="reset" value="リセット">
                <button type="submit" class="btn btn-primary">登録</button>
                <!-- リンク確認の仮設ボタン-後で削除する！ -->
                <!-- <a href="{{ url('/shop/join_confirm') }}" class="btn btn-warning">(仮設)登録</a> -->
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection