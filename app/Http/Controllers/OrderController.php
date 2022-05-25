<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; //追加
use App\Models\Member; //追加
use App\Models\Product; //追加
use App\Models\Order; //追加
use App\Models\Cart; //追加
use App\Models\Shop; //追加
use Illuminate\Support\Facades\DB; //追加



class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        
    }

    public function shop(Request $shop_id)
    {
        //選択店舗「〇〇店から購入する」の店舗idの値をordersテーブルへ
        
        $input = $shop_id->all(); //挿入する準備をする＜1=太秦店、2=祇園店＞
        unset($input['_token']);

        
        $shop_id->session()->put('input', $input); //shop/orderで画面で選択した店舗IDをセッションに保存する
    

        
        return view('shop/purchase'); //店舗idをセッションinputに保存したら、次の画面にリダイレクトする
      
    }


    public function cart(Request $request)
    {

        
        ini_set("max_execution_time", 0);  // タイムアウトしない
        
        ini_set("max_input_time", 0); // パース時間を設定しない

        //・誰が member_id
        //・何を product_id
        //・いくつ order_quantity
        //注文したかをcartクラスに保存する
        //のちにordersテーブルに保存するために、セッションformに格納しておきます

        //カートの中に、product_id=1 もしくはproduct_id=2のいずれかがあれば、updateCart.bladeへ遷移する。
        //同じproduct_idで重複してレコードが挿入されないように更新画面に遷移させる機能をつくる

        $cart = new Cart();

    if (empty(Auth::user()->id)) {
        return redirect('shop/login');
    } else {
        $cart->member_id = Auth::user()->id;  //現在ログインしているメンバーのIDの取得して、Cartクラスのmember_idに代入する
        
        $form = $request->all(); //注文商品ID、注文個数//purchase.bladeから送信されたproduct_ID、order_quantityを受取ります。
        unset($form['_token']); //tokenを削除
    
        
        $form['member_id'] = $cart->member_id; //誰が? 現在ログイン中のメンバーidを$formの連想配列に加えます。


        $cart->fill($form)->save(); //Cartクラスでfillableに設定した、cartテーブルのカラムに挿入します。
     
        
        $cart = DB::table('carts')
        ->select('product_id')
        ->where('member_id', '=', $form['member_id'])
        ->orderBy('carts.id','asc')->get();

        if (!empty($cart)) { //カートにproduct_idに値が一つでもあれば、purchase.blade.には戻らず、
            
            
            return redirect('shop/updateCart'); //updateCart.blade.の注文個数更新に遷移します。

        } else { //カートが空でカートに入れるが押されたら同じ画面にまた戻ります。
        
        
        return redirect('shop/purchase'); //再度、purchase.bladeに戻り、２種類商品が注文できるように同じ画面にリダイレクト/「注文を確定」でようやくconfirmへ

        }
     } // END IF

    }


    
    public function updateCart()
    {
        //purchas.blade「戻る」ボタンからupdateCart.bladeへ遷移。更新処理を行います。
        //cartsテーブルに、どちらか1つでもカートに入っているとき「カートに入れる」が押下されたら更新画面updateCart.bladeへ遷移されます。

        $member_id = Auth::user()->id;  //現在ログインしているメンバーのIDの取得してmember_idに代入する
        $cart = DB::table('carts')
            ->select('id', 'product_id', 'order_quantity')
            ->where('member_id', '=', $member_id)
            ->orderBy('id','asc')->get();
    

        $cartData = json_decode(json_encode($cart), true); //php 多次元配列になったstdClassをArrayにキャストする。stdClassのコレクションを配列に変換します。

        
        return view('shop/updateCart', ['cartData'=> $cartData]); //カートの情報一覧画面を表示 updateCart.blade画面を表示する
    }

    
    public function cartfix(Request $request)
    {
        // updateCart.bladeの、カートの注文個数を追加・更新を担当するメソッドです。
        $cart = new Cart();

        $member_id = Auth::user()->id;  //現在ログインしているメンバーのIDの取得してmember_idに代入する
        $cart = DB::table('carts')
            ->select('id', 'product_id', 'order_quantity')
            ->where('member_id', '=', $member_id)
            ->orderBy('id','asc')->get();

        $carts = json_decode(json_encode($cart), true); //php 多次元配列になったコレクションstdClassをArrayにキャストする

        foreach ($carts as $key =>$v) {
            $productId[] = $v['product_id'];
        }
       

        $cart->member_id = Auth::user()->id;  //現在ログインしているメンバーのIDの取得して、Cartクラスのmember_idに代入する

        $form = $request->all();//updateCart.bladeから送信されたproduct_ID、order_quantityを受取る。
        unset($form['_token']); //tokenを削除
    
        $form['member_id'] = $cart->member_id; //現在ログイン中のメンバーidを$formの連想配列に加える。

        foreach ($carts as $key => $v) { 
            
            if (empty($request->id)) { // リクエストに$request->idが無い場合は、新規レコードをインサートします。
                $today = date("Y-m-d H:i:s"); // 現在日時を取得
                DB::table('carts')->insert([ // Ordersテーブルにインサートします。
                    'product_id' => $form['product_id'],
                    'order_quantity' => $form['order_quantity'],
                    'member_id' => $form['member_id'],
                    'created_at' => $today,
                    'updated_at' => $today,
                ]);
              } // END IF
             
             if ($v['product_id'] == $request->product_id) { //リクエストされた$request_product_idがDBのproduct_idと一致したら更新処理をします。
                DB::table('carts')
                    ->where('id' , $request->id)
                    ->update(
                        ['product_id' => $form['product_id'], 'order_quantity' => $form['order_quantity'],
                         'member_id' => $form['member_id']
                        ]);
              } // END IF
        } //END FOREACH 

        
        return redirect('shop/updateCart'); //カートの更新情報一覧画面を表示 変更したカートの注文個数を再読み込みして同じ画面を表示する。
    }


    
    public function ses_get(Request $request)
    {

        //cartに入れた商品金額 95円ｘ〇〇個=〇〇〇円合計金額 を、confirmブレードに表示します。 
    
       if (empty(Auth::user()->id)) {
            return redirect('shop/login'); 
       } else {
        $memberId = Auth::user()->id; // 現在ログイン中のメンバーのIDを取得します。

        $product = new Product();
        
        $items = DB::table('carts') // 商品テーブルの'price'の95円の値からお会計金額を出したいのでリレーションする。
            ->join('products', 'products.id', '=', 'carts.product_id')
            ->select('products.id', 'product_name', 'price', 'carts.id', 'carts.order_quantity')
            ->where('member_id', '=', $memberId)
            ->orderBy('carts.id','asc')->get();

        $orders = json_decode(json_encode($items), true); //php 多次元配列になったコレクションstdClassをArrayにキャストする


            $total = 0;
            foreach ($orders as $key => $v) {
            
            // 自己代入 $x = $x + 1 => $x += 1 => 0 + 1 = 1 ,$x = 1, $x = $x + 1 => 1+1 = 2 -->   
            $total += ($v['price'] * $v['order_quantity']); 

            } 

        
        return view('shop.confirm', compact('items','total')); // 取得した情報一覧を表示します。
       }
    }

    

  
  
    public function receiving(Request $request)
    {

        //ordersテーブルに挿入する値をまとめる。このメソッドで1～3をセッションに格納します。
        //1・member_id 誰が
        //2・order_date いつ
        //3・shop_id どこで
        //4・payment_method
        //5・receiving_method

        $today = date("Y-m-d");
        // $d = now(); //・いつ 現在の年月日//"2022年04月30日" 
        // $today = $d->addDay()->format('Y-m-d');
        // $today = date("Y-m-d H:i:s")->format('y-m-d');
     if (empty(Auth::user()->id)) {
            return redirect('shop/login');//もしログインIDが空ならログイン画面にリダイレクトします。
     } else {
        $memberId = Auth::user()->id; //・誰が メンバーid  現在ログイン中のメンバーのIDを受け取ります。
    
        $shop = $request->session()->get('input'); //・どこで // セッション$inputに保存した店舗IDを取得して受取ります。  
        $shopId = $shop['shop_id'];  //連想配列$datasからshop_idだけを取り出します。
  
    
        $ordersValues = [   //いつ、誰が、どこで。この３つの項目をordersのために連想配列に入れておきます。
            "member_id" => $memberId,
            "order_date" => $today,
            "shop_id" => $shopId
        ];
        $request->session()->put('ordersValues', $ordersValues); //$ordersValuesをセッションに保存しておきます。


        return redirect('shop/receiving'); //もう一度OrderControllerに戻ります。
        // return view('shop/receiving');
       }
    }

    
    public function ses_receiving(Request $request)
    {
        //商品の受取方法をpay.bladeに送る画面です。

        
        $datas = $request->session()->get('ordersValues'); //receivingメソッドで保存したセッションを取り出す。
    
        
        $shopId = $datas['shop_id']; //店舗名 //連想配列$datasからshop_idキーを取得します。
        
        
        $shop = Shop::find($shopId); //店舗idから、メンバーが選択した店舗情報を取り出す。//shop_name=>京都太秦店,phone_number=>"08012548874"・・・。
    
        
        $memberId = $datas['member_id']; //自宅住所  //連想配列$datasからmember_idキーを取得。
        
        
        $member = Member::find($memberId); //メンバーidから、メンバーの個人情報を絞込み検索します。//first_name=>光男, last_name=>内村,phpne_number=>"080・・・" 

        
        return view('shop/receiving', compact('shop','member')); //リダイレクト先/shop/receiving //受取方法
    }


    public function pay(Request $request)
    {
        //shop/receiving画面からpost送信された[受取方法]を受取ります。
    
        $receiv = $request->all(); //受取方法のリクエストを取得します。
       
        
        $receivingMethod = $receiv['receiving_method']; //連想配列$receivからreceiving_methodだけを取り出す。
    
        
        $orders = $request->session()->get('ordersValues'); //receivingメソッドで保存したordersテーブルの値の「支払方法」を除く全てを取得する。     
    
        $member_id = $orders['member_id']; //誰が? 購入者の氏名
        $member = Member::find($member_id);
        $firstName = $member['first_name'];
        $lastName = $member['last_name'];
    
        $orderDate = $orders['order_date']; //いつ 購入年月日
        
    
        $shop_id = $orders['shop_id']; //どこで 購入店舗
        $shop = Shop::find($shop_id);
        $shopName = $shop['shop_name']; //店舗名
    
        $shop_id = $orders['shop_id']; 
        
        $shop = Shop::find($shop_id);   //shop_idから、店舗情報の全てが入った$shopの連想配列を取得します。
        $shopName = $shop['shop_name']; 
    
        $ordersData = [   //ordersテーブルに挿入するためのses_getPayメソッドに必要な情報をarrayにまとめます。
            "member_id" => $member_id,
            "order_date" => $orderDate,
            "shop_id" => $shop_id,
            "receiving_method" => $receivingMethod,    
            
            "first_name" => $firstName, //注文者氏名なまえ //thanks画面のために追加保存
            "last_name" => $lastName,
            
            "shop_name" => $shopName,   //店舗名   
        ];
        
        $request->session()->put('ordersData', $ordersData); //$orderDataをセッションに保存しておきます。
  
        
        return redirect('shop/pay'); //リダイレクト先//もう一度OrderControllerに戻ります。
    }


    public function ses_getPay(Request $request)
    {
        //ここではshop/payブレードを表示するためのメソッドです。
        return view('shop/pay');
    }

    public function payConfirm(Request $request)
    {
        //ordersテーブルにインサートします。
        $payment = $request->all(); //postされた支払方法を受取ります。
    
                                                 
        $paymentMethod = $payment['payment_method']; //支払方法 //連想配列$paymentからpayment_methodだけを取り出します。

        
        $data = $request->session()->get('ordersData');  //payメソッドでセッションに入れた値を取得する。
        
        $data['payment_method'] = $paymentMethod; //連想配列$dataに$paymentMethodも$payment_methodキーとして連想配列に加える。
    
        
        $order = new Order();  //Orderクラスのインスタンス。
        
        $order->fill($data)->save();  //Orderクラスでfillableに設定した、ordersテーブルのカラムに挿入する。
        
        $last_Orderinsert_id = $order->id;  //Orderに最後にインサートしたLastInsertIDを取得する

        $orders= \App\Models\Order::find($last_Orderinsert_id); //cartsにある全レコードを取得する。

    
        $paymentMethod = $orders['payment_method']; //支払方法
        
        $receivingMethod = $orders['receiving_method']; //受取方法

        
        $request->session()->put('last_insert_id', $last_Orderinsert_id); //この後Order_detailテーブルへのインサートために、Ordersに最後にインサートしたLastIdをセッションに保存しておきます。
   
        //このpayブレードからpay_confirmブレードに支払方法をpost送信します。       
        return view('shop/pay_confirm',compact('paymentMethod', 'receivingMethod'));
    }



    public function thanks(Request $request)
    {
        //・注文日、商品名、注文個数、支払方法、受取方法、購入店舗、ご請求金額を表示します。
        //・ordersテーブルにインサートします。


        $lastInsertId = $request->session()->get('last_insert_id'); //最後にorders最後にインサートされたIDを取得する。
      
        
        $cartMemberId = Auth::user()->id;  //現在ログインしているメンバーのIDの取得
        
        $carts = DB::table('carts') //order_detailに挿入に必要なカラム.'product_id', 'order_quantity'
                ->select('product_id', 'order_quantity')
                ->where('member_id','=', $cartMemberId)
                ->get();
        
        


            $today = date("Y-m-d H:i:s"); // 現在日時 2022-05-07-03:00 を取得

            foreach ($carts as $key => $v) { //2種類しろあん・くろあん両方の注文を想定してcartsテーブルの多次元配列を取得します。
                DB::table('order_details')->insert([ // Ordersテーブルにインサートします。
                    'product_id' => $v->product_id,
                    'order_quantity' => $v->order_quantity,
                    'order_id' => $lastInsertId,
                    'created_at' => $today, // テーブルのインサート日時
                    'updated_at' => $today
                ]);
            }


 
        
        $order = DB::table('orders') //・注文日、支払方法、受取方法、購入店舗、ご請求金額を表示するために複数テーブルをリレーションします。
                ->join('order_details', 'order_details.order_id', '=', 'orders.id')
                ->join('shops', 'shops.id', '=', 'orders.shop_id')
                ->join('products', 'products.id', '=', 'order_details.product_id') // 後でstocksにインサートする必要なカラムもセレクトしておく。
                ->select('orders.id','orders.shop_id', 'orders.order_date','orders.member_id','product_id', 'product_name', 'order_quantity', 'order_date','payment_method',
                'receiving_method','shop_name','price')
                ->where('orders.id','=', $lastInsertId)
                ->get();

        $request->session()->put('order', $order); // のちにstocksにインサートする為に必要な情報を保存しておきます。  
        
        //stocksテーブルにインサートします。

        //1.・ordersテーブルに最後にインサートした、販売店舗ID、販売年月日、メンバーIDを取得します。
        //1.・ordersテーブルとリレーションしたorder_detailsテーブルから、商品ID、販売個数を取得します。
        //2・stocksに、１.で取得した販売店舗ID、販売日、メンバーID、商品ID、販売個数をインサートします。
        //3・cartsテーブルを空にする
        //4・セッションを削除する。
        
        //Ordersに最後にインサートしたLastIDを取得します。
        $lastInsertId = $request->session()->get('last_insert_id'); //最後にorders最後にインサートされたIDを取得する。

        $data = $request->session()->get('order'); // stockへのインサートに必要な情報を取り出します。

        $today = date("Y-m-d H:i:s"); // 現在日時 2022-05-07-03:00 を取得

        //今日の在庫から販売個数を引いていきます 
  

        // stocks.stock_quantity 在庫数から売れた数を差し引くので注文個数にｘ-1を乗算します 


        foreach ($data as $key => $v) {
            DB::table('stocks')->insert([ // Ordersテーブルにインサートします。
                'product_id' => $v->product_id,
                'shop_id' => $v->shop_id,
                // stocks.stock_quantity 在庫数から売れた数を差し引くので注文個数にｘ-1を乗算します
                'stock_quantity' => (-1)*$v->order_quantity, // 販売個数
                'sales_date' => $v->order_date, // 販売日
                'created_at' => $today, // テーブルのインサート日時
                'updated_at' => $today, // テーブルのインサート日時
            ]);
        }


                Cart::query()->delete(); // Eloquentでレコードを全件削除する
  
                                    
                session()->forget('input'); // 特定のセッションを削除方法です。
                session()->forget('lastInsert_id');
                session()->forget('ordersValues');
                session()->forget('ordersData');
                session()->forget('last_insert_id');
                
                session()->flush(); //こちらで全てのセッションの削除できます。   



        return view('shop.thanks', ['order' => $order ] ); //ordersテーブルから取得した購入情報をブレードに渡します。
    }


    
        public function currentLocation(Request $request)
        {

            //現在地の緯度経度を取得する

            //1.welecom.bladeからsetLocation.jsで受取った現在地の緯度経度をこのメソッドでリクエストを受け取ります。
            //2.受取った緯度経度を$lat, $lng に渡し、次の画面で地図に表示します。
           
            $lat = $request->lat;
           
            $lng = $request->lng;
        
            // currentLocationで表示
            return view('shop/currentLocation', 
                // 現在地緯度latをbladeへ渡す
                [
                    // 現在地緯度latをbladeへ渡す
                    'lat' => $lat,
                    // 現在地経度lngをbladeへ渡す
                    'lng' => $lng,
                ]);
        }




        //店舗の緯度経度を取得後、shop/stores.bladeで緯度経度をhiddenでフォーム送信します。
        public function shopLocation()
        {

            return view('shop.stores'); //太秦店、祇園店のGooglemap
           
        }

        public function GoogleMapLocation(Request $request)
        {
            //受取ったrequest->id が店舗のIDで、どちらの店舗を表示するか切り分けます。
            //店舗のIDによってDBの緯度経度を切り分けて取得します。

        if ($request->id == 1) {//$request->idが1なら太秦店の地図を表示させる処理を実行します。   

          if (!empty($request->id)) {
            if ($request->id == 1) {//太秦店の緯度経度をDBから取得します。
                $shop1_latlng = DB::table('shops') //店舗ID=1 の緯度経度を取出します。
                ->select('shops.latitude', 'shops.longitude')
                ->where('shops.id','=', $request->id)
                ->get(); 
            } 

            $shop1LatLng = $shop1_latlng->toArray();

            foreach ($shop1LatLng as $v) {
                        $lat = $v->latitude;
                        $lng = $v->longitude;
            }
  
            return view('shop/store_uzumasa_1', //太秦店の緯度経度から地図を表示します。
               
                [         
                    'lat' => $lat,// 緯度latをbladeへ渡す
                    
                    'lng' => $lng,// 経度lngをbladeへ渡す
                ]);

            } else {
                return redirect('/shop/stores');// $request->idがなく、いきなりshop/store_uzumasa_1に遷移した時は指定のページへリダイレクトさせます。
            }

        } elseif ($request->id == 2) {//$request->idが2なら太秦店の地図を表示させる処理を実行します。

            if (!empty($request->id)) {
                if ($request->id == 2) {//祇園店の緯度経度をDBから取得します。
                    $shop2_latlng = DB::table('shops') //店舗ID=1 の緯度経度を取出します。
                    ->select('shops.latitude', 'shops.longitude')
                    ->where('shops.id','=', $request->id)
                    ->get(); 
                } 
   
                $shop2LatLng = $shop2_latlng->toArray();
    
                foreach ($shop2LatLng as $v) {
                            $lat = $v->latitude;
                            $lng = $v->longitude;
                }
      
                return view('shop/store_gion_1',//祇園店の緯度経度から地図を表示します。
                    
                    [
                        
                        'lat' => $lat,// 緯度latをbladeへ渡す
                        
                        'lng' => $lng,// 経度lngをbladeへ渡す
                    ]);
    
                } else {
                    return redirect('/shop/stores');// $request->idがなく、いきなりshop/store_uzumasa_1に遷移した時は指定のページへリダイレクトさせます。
                }
        }    

        }




        public function rootResult(Request $request)
        {
            //虚無蔵 京都祇園店までのルート検索をします。

            //住所を入力してスタート地点の緯度経度を取得する。
            //取得した緯度経度をjsに渡して、スタート地点の変数に格納し、
            //ルートを地図上に表示します。
   
            $lat = $request->lat;
        
            $lng = $request->lng;
        
            return view('shop/root_result', 
                // 現在地緯度latをbladeへ渡す
                [
                    // 現在地緯度latをbladeへ渡す
                    'lat' => $lat,
                    // 現在地経度lngをbladeへ渡す
                    'lng' => $lng,
                ]);
        } 

        public function rootResult2(Request $request)
        {
            //虚無蔵 太秦店までのルート検索をします。

            //住所を入力してスタート地点の緯度経度を取得する。
            //取得した緯度経度をjsに渡して、スタート地点の変数に格納し、
            //ルートを地図上に表示します。
   
            $lat = $request->lat;
        
            $lng = $request->lng;
        
            return view('shop/root_result_uzumasa', 
                // 現在地緯度latをbladeへ渡す
                [
                    // 現在地緯度latをbladeへ渡す
                    'lat' => $lat,
                    // 現在地経度lngをbladeへ渡す
                    'lng' => $lng,
                ]);
        } 
       



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
