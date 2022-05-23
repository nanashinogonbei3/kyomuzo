<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');






// ****** */ MemberProductController **********************************************


// 顧客リスト
Route::get('/product/member', 'App\Http\Controllers\MemberController@index');


// トップ画面を表示します。
Route::get('/shop/index', 'App\Http\Controllers\MemberController@index')->name('index');
// 会員登録して、ログイン後のリダイレクト先
Route::post('/shop/index', 'App\Http\Controllers\MemberController@index')->name('index');
// メンバーの新規登録するフォーム入力画面表示
Route::get('shop/registration', 'App\Http\Controllers\MemberController@create')->name('registration');
// メンバー新規登録（passwordのHash暗号化）pwhash
Route::post('shop/pwhash', 'App\Http\Controllers\MemberController@pwhash')->name('pwhash');
// メンバーの登録確認画面
Route::post('shop/join_confirm', 'App\Http\Controllers\MemberController@confirm')->name('join_confirm');
// メンバーの登録
Route::post('shop/store', 'App\Http\Controllers\MemberController@store')->name('member_store');
// メンバー登録後の遷移先。ログイン画面を表示する
Route::get('shop/login', 'App\Http\Controllers\MemberController@getAuth')->name('login'); 
// ログイン入力したインプットした値を送る
Route::post('shop/login', 'App\Http\Controllers\MemberController@postAuth')->name('login');

// テスト表示用（後で削除予定）
Route::post('shop/confirm', 'App\Http\Controllers\MemberController@orderconfirm')->name('orderconfirm');

// ****** */ StockController *************************************************************

// 商品を製造登録する入力フォーム画面を表示します。
Route::get('stock/stock', 'App\Http\Controllers\StockController@create')->name('stock_form');
// 商品の製造登録した入力内容の確認画面を表示します。
Route::post('stock/stock_confirm', 'App\Http\Controllers\StockController@confirm')->name('stock_confirm');
// 商品の登録をする
Route::post('stock/store', 'App\Http\Controllers\StockController@store')->name('stock_store');
// 商品を一覧画面にアクセスして製造商品リストを表示させます。
Route::get('stock/stock_list', 'App\Http\Controllers\StockController@index')->name('stock_list');
// POst送信して登録した商品を、製造商品一覧画面に表示します。
Route::post('stock/stock_list', 'App\Http\Controllers\StockController@index')->name('stock_list');
// 商品の個別の詳細表示画面
Route::get('stock/show_stock/{id}', 'App\Http\Controllers\StockController@show')->name('stock_show');
// 商品の製造登録を編集する画面を表示する
Route::get('stock/edit_stock/{id}', 'App\Http\Controllers\StockController@edit')->name('stock_edit');
// 商品の更新処理 updateメソッドへPOST送信する
Route::post('stock/update/{id}', 'App\Http\Controllers\StockController@update')->name('stock_update');
// 検索 「しろあん・くろあん」から検索
Route::get('stock/find_stock/{id}', 'App\Http\Controllers\StockController@findProduct');
// 検索 「太秦店・祇園店」から検索
Route::get('stock/search_stock/{id}', 'App\Http\Controllers\StockController@findShop');
// あいまい検索
Route::get('stock/random_search', 'App\Http\Controllers\StockController@randomSerch')->name('random_search');
// 在庫管理 stock_control.blade 画面を表示します。
Route::get('stock/stock_control', 'App\Http\Controllers\StockController@stockControl')->name('stock_control');
Route::post('stock/stock_control', 'App\Http\Controllers\StockController@stockControl')->name('stock_control');
// 在庫管理から、商品で検索した結果を画面に表示します。
Route::get('stock/find_stock_control/{id}', 'App\Http\Controllers\StockController@findstockControl');
// 在庫管理から、店舗で検索した結果を画面に表示します。
Route::get('stock/search_stock_control/{id}', 'App\Http\Controllers\StockController@searchstockControl');
// 販売履歴 stock/sales_history 独自ページネーションで画面に一覧表示します。
Route::get('stock/sales_history', 'App\Http\Controllers\StockController@page');
// オーダー詳細 sales_show 注文の詳細を表示します。合計請求金額・配送先・支払方法 を表示します。
Route::get('stock/sales_show/{id}', 'App\Http\controllers\StockController@salesShow')->name('sales_show');
// 販売履歴 店舗ID検索結果を画面に表示します。
Route::get('stock/sales_shopSearch/{id}', 'App\Http\controllers\StockController@sales_shopSearch');
// 販売履歴 商品ID検索結果を画面に表示します。
Route::get('stock/sales_productSearch/{id}', 'App\Http\controllers\StockController@sales_productSearch');
// 販売履歴 ランダムに入力フォームで店舗名、商品名、顧客名、などで検索した結果を表示します。
Route::get('stock/sales_randomSerch', 'App\Http\controllers\StockController@sales_randomSerch')->name('sales_randomSerch');


// ****** */ OrderController *************************************************************

// 注文画面 「取り扱い店舗一覧」表示画面
Route::get('/shop/orders', function() {
  return view('shop.orders');
});
// トップページ
Route::get('/shop/index', function () { return view('shop.index');  });
//orders.bladeからpurchase.bladeを表示する画面です。
Route::get('shop/purchase', 'App\Http\Controllers\OrderController@shop');
//Order.bladeからPOSTされた店舗IDを受け取るshopメソッドです。
Route::post('shop/purchase', 'App\Http\Controllers\OrderController@shop')->name('purchase');
//カートに入れる押下（Cartモデルに挿入）後に、リダイレクトする画面です。
Route::get('shop/confirm', 'App\Http\Controllers\OrderController@cart')->name('confirm');
Route::post('shop/confirm', 'App\Http\Controllers\OrderController@cart')->name('confirm');

//confirm画面で、各商品名、それらの注文個数、各合計金額を表示します。
Route::get('shop/confirm', 'App\Http\Controllers\OrderController@ses_get');
//purchas.bladeの「戻る」ボタンから、カートの注文個数一覧を表示します。
Route::get('shop/updateCart', 'App\Http\Controllers\OrderController@updateCart');
//updateCart.bladeの「修正」でカートの注文個数をPOST送信します。
Route::post('shop/cart_fix', 'App\Http\Controllers\OrderController@cartfix')->name('cartfix');
//注文個数を更新して修正された注文個数を元の画面に戻って再表示します。
Route::get('shop/cart_fix', 'App\Http\Controllers\OrderController@cartfix')->name('cartfix');
//受取方法を、配送にするか店舗で受け取るか選択する画面表示
Route::post('shop/receiving', 'App\Http\Controllers\OrderController@receiving')->name('receiving');
Route::get('shop/receiving', 'App\Http\Controllers\OrderController@ses_receiving');
//選択する画面を表示する
Route::post('shop/pay', 'App\Http\Controllers\OrderController@pay')->name('pay');
Route::get('shop/pay', 'App\Http\Controllers\OrderController@ses_getPay')->name('ses_getPay');
//postされた支払方法を受取る
Route::post('shop/pay_confirm', 'App\Http\Controllers\OrderController@payConfirm')->name('pay_confirm');
// Route::get('shop/pay_confirm', 'App\Http\Controllers\OrderController@getPayComfirm');
//pay_confirmから注文確定された内容をorder_detailに最後にインサートしてリダイレクト表示する画面
Route::post('shop/thanks', 'App\Http\Controllers\OrderController@thanks')->name('thanks');
Route::get('shop/thanks', 'App\Http\Controllers\OrderController@closeThanks');
// 店舗のGoogle Map API で地図を表示します。
Route::get('shop/stores', 'App\Http\Controllers\OrderController@shopLocation');
//店舗のリンクから、「京都太秦店」のボタンを選択すると、京都太秦店の地図を表示します。
Route::get('shop/store_uzumasa_1', 'App\Http\Controllers\OrderController@GoogleMapLocation1')->name('uzumasa');
//店舗のリンクから、「京都祇園店」のボタンを選択すると、京都祇園店の地図を表示します。
Route::get('shop/store_gion_1', 'App\Http\Controllers\OrderController@GoogleMapLocation2')->name('gion');
// 太秦店の地図を表示します。
Route::get('/shop/store_uzumasa', function () {
  return view('shop.stores');
});  
// 祇園店の地図を表示します。
Route::get('/shop/store_gion', function () {
  return view('shop.store_gion');
});
// *** Google Map フォーム  *******************************************************************
//welcom.bladeに表示する現在地の地図にマップ・マーキングを付けるためのメソッド/result.currentLocation現在位置の結果
Route::get('shop/currentLocation/', 'App\Http\Controllers\OrderController@currentLocation')->name('currentLocation');
//住所から緯度経度を取得して地図を表示します。
Route::get('shop/findLocation', function () {
  return view('shop.findLocation');
});
//緯度経度を取得して祇園店までのルート・マップを表示します。
Route::get('shop/root_result', 'App\Http\Controllers\OrderController@rootResult')->name('rootResult');
//緯度経度を取得して太秦店までのルート・マップを表示します。
Route::get('shop/root_result_uzumasa', 'App\Http\Controllers\OrderController@rootResult2')->name('rootResult2');


// **For Page custom テスト表示用 ************************************



// *****************************************************
     


// 営業時間 営業時間だけ掲示するページ
Route::get('/shop/opening_hours', function () {
  return view('shop.opening_hours');
});

// 注文画面(くろあん、黄みあんの商品紹介ページです。)
Route::get('/shop/order_shiro', function() {
  return view('shop.order_shiro');
});


// *******************************************
// ログアウト
	
Route::get('/logout', 'Auth\LoginController@logout');
    
