@extends('layouts.member')

@section('content')
<span class="section-heading-lower">ログイン</span>
<form action="{{ route('login') }}" method="post">
@csrf
<div class="container-md">
        <!-- mt-3 margin-top: 3; -->
        <div class="row mt-3">
            <!-- col-mdでページ全体をフォームに（12） --> 
            <div class="md-4">
                <div class="card">
                      <div class="card-header">
                         <!-- ログイン時に成功したメッセージを表示します -->
                        <?php if (!empty($message)) { 
                          echo $message;
                        } ?>
                        &nbsp;&nbsp;&nbsp;
                      </div>
                    <div class="card-body">
                        <form>
                            <!-- Emailアドレス -->
                            <div class="row mb-3">
                              <!-- 必須ボタンは、bootstrap https://getbootstrap.com/docs/5.1/components/badge/ -->
                              <label for="inputEmail3" class="col-sm-2 col-form-label">Emailアドレス</label>
                              <div class="col-sm-10">
                                <input type="email" name="email" class="form-control" id="inputEmail3">
                              </div>
                            </div>
                            <!-- パスワード -->
                            <div class="row mb-3">
                              <!-- ラベルのfor=""と、id=""属性名を一致させることで、ラベルとidがれんけいされ、"パスワード"文字をブラウザで選択するとフォーム枠が強調され選択表示される。 -->
                              <label for="inputPassword3" class="col-sm-2 col-form-label">パスワード</label>
                              <div class="col-sm-10">
                                <input type="password" name="password" class="form-control" id="inputPassword3">
                              </div>
                            </div>
                            <button type="submit" class="btn btn-primary">ログイン</button>
                          </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
