@extends('layouts.member')

@section('content')
<span class="section-heading-lower">ご登録の確認</span>

  <div class="container-md">
    <!-- mt-3 margin-top: 3 -->
    <div class="row mt-3">
      <!-- col-mdでページ全体をフォームに（12） -->
      <div class="col-md">
        <div class="card">
          <div class="card-header">
            &nbsp;&nbsp;&nbsp;
          </div>
          <div class="card-body">

            <form action="{{ route('member_store') }}" method="post">
            @csrf
              <!-- Emailアドレス -->
              <div class="row mb-3">
                <!-- 必須ボタンは、bootstrap https://getbootstrap.com/docs/5.1/components/badge/ -->
                <label for="inputEmail" class="col-sm-2 col-form-label">Emailアドレス</label>
                <div class="col-sm-10">
                  <dt>{{ $inputs['email'] }}</dt>
                </div>
              </div>
              <!-- パスワード -->
              <div class="row mb-3">
                <!-- ラベルのfor=""と、id=""属性名を一致させることで、ラベルとidがれんけいされ、"パスワード"文字をブラウザで選択するとフォーム枠が強調され選択表示される。 -->
                <label for="inputPassword" class="col-sm-2 col-form-label">パスワード</label>
                <div class="col-sm-10">
                  <dt>*******</dt>
                </div>
              </div>
              <!-- 電話番号 -->
              <div class="row mb-3">
                <!-- ラベルのfor=""と、id=""属性名を一致させることで、ラベルとidがれんけいされ、"パスワード"文字をブラウザで選択するとフォーム枠が強調され選択表示される。 -->
                <label for="phone_number" class="col-sm-2 col-form-label">電話番号</label>
                <div class="col-sm-10">
                  <dt>{{ $inputs['phone_number'] }}</dt>
                </div>
              </div>
              <!-- 氏名 -->
              <div class="row mb-3">
                <label for="inputLastName" class="col-sm-2 col-form-label">お名前</label>
                <div class="col-sm-10">
                  <dt>{{ $inputs['last_name'] }}</dt>
                </div>
              </div>
              <!-- お名前 -->
              <div class="row mb-3">
                <label for="inputFistName" class="col-sm-2 col-form-label">お名前</label>
                <div class="col-sm-10">
                  <dt>{{ $inputs['first_name'] }}</dt>
                </div>
              </div>
              <!-- 郵便番号 -->
              <div class="row mb-3">
                <label for="inputPostal" class="col-sm-2 col-form-label">郵便番号</label>
                <div class="col-sm-10">
                  <!-- 郵便番号検索 -->
                  <dt>{{ $inputs['postal_code'] }}</dt>
                  <!-- 郵便番号 End -->
                  <p id="error"></p>
                </div>
              </div>
              <!-- 都道府県 -->
              <div class="row mb-3">
                <label for="inputAddress1" class="col-sm-2 col-form-label">都道府県</label>
                <div class="col-sm-10">
                  <dt>{{ $inputs['address1'] }}</dt>
                </div>
              </div>
              <!-- 市区 -->
              <div class="row mb-3">
                <label for="inputAddress2" class="col-sm-2 col-form-label">市区町村</label>
                <div class="col-sm-10">
                  <dt>{{ $inputs['address2'] }}</dt>
                </div>
              </div>
              <!-- 町村 -->
              <div class="row mb-3">
                <label for="inputAddress3" class="col-sm-2 col-form-label">町村</label>
                <div class="col-sm-10">
                  <dt>{{ $inputs['address3'] }}</dt>
                </div>
              </div>
              <!-- 番地 -->
              <div class="row mb-3">
                <label for="inputAddress4" class="col-sm-2 col-form-label">番地</label>
                <div class="col-sm-10">
                  <dt>{{ $inputs['address4'] }}</dt>             
                </div>
              </div>

         
              <?php if (!empty($inputs['address5'] )) : ?>
              <!-- 建物名 -->
              <div class="row mb-3">
                <label for="inputAddress5" class="col-sm-2 col-form-label">建物名</label>
                <div class="col-sm-10">
                  <dt>{{ $inputs['address5'] }}</dt>
                </div>
              </div>
              <?php endif ?>

              <div class="mb-3">
                
                <button type="submit" class="btn btn-primary">登録</button>
                <br><br>  
                <!-- キャンセル -->
                <a href="{{ url('/shop/index') }}" class="btn btn-light">キャンセル</a>

              </div>

            </form>
            <!-- form END -->
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection