<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>虚無蔵トップページ</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">

</head>

<body>
    <header>
        <!-- Navibar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ url('/product/products') }}">ホーム</a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/product/product_list') }}">製造商品リスト</a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
        <!-- Navibar END -->
        <h1 class="site-heading text-center text-faded d-none d-lg-block">
            <!-- <span class="site-heading-upper text-primary mb-3">Which taste do you like?</span> -->

        </h1>
    </header>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark py-lg-4" id="mainNav">
        <div class="container">
            <a class="navbar-brand text-uppercase fw-bold d-lg-none" href="index.html">Kyomuzo's shopping</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <span style="font-size: 31pt;color:white;font-family: verdana,arial,helvetica,sans-serif">
                    <a href="{{ url('/shop/index') }}" class="wf-sawarabimincho">
                        虚無蔵</a></span>
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="{{ url('/product/product_list') }}">製造商品リスト</a></li>
                    <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="{{ url('/product/order') }}">注文履歴</a></li>
                    <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="{{ url('/shop/login') }}">ログイン</a></li>
                    <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="{{ url('/shop/registration') }}">ログアウト</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <section class="page-section cta">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <!-- <div class="cta-inner bg-faded text-center rounded"> -->
                        @yield('content')
                        <h2 class="section-heading mb-5">
                    <!-- </div> -->
                </div>
            </div>
        </div>
    </section>

    </section>
    <footer class="footer text-faded text-center py-5">
        <div class="container">
            <p class="m-0 small">Copyright &copy; kyomuzo 2022</p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="{{ asset('js/scripts.js') }}" defer></script>
    <!-- 郵便局の郵便番号検索API -->
    <script src="{{ asset('js/japan_post_num.js') }}" defer></script>

    <!-- 郵便局JSONP URL -->
    <!-- https://into-the-program.com/javascript-get-address-zipcode-search-api/ -->
    <!-- 上記のライブラリを読み込んでJSONPが使用できるようにしておきます。 -->
    <script src="https://cdn.jsdelivr.net/npm/fetch-jsonp@1.1.3/build/fetch-jsonp.min.js"></script>
</body>

</html>