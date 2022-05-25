<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop; //追加
use App\Models\Product; //追加
use App\Models\Stock; //追加
use App\Models\Order; //追加
use Illuminate\Support\Facades\Auth; //追加
use Illuminate\Support\Facades\DB; //追加
use DateTime; //追加 DateTim formatに必須です。
use DateInterval; // 追加 DateInterval を使う時は必須です。
use DateTimeZone; // 追加 DateTimeZone を使うときは必須です。
use Illuminate\Pagination\LengthAwarePaginator; // LengthAwarePaginatorのページネーションに必須です。
use Illuminate\Pagination\Paginator;//ページネーションのレイアウトが崩れる問題・矢印の巨大化を解消します。

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
    
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Stock $stocks, Request $request)
    {
    
      //製造商品の一覧表示 
        Paginator::useBootstrap();//ページネーションのデザインが崩れる互換性の問題を解消します。
      
        //stocksのDBから、商品ID、商品名、在庫ID、店舗ID、製造個数、製造年月日、登録メンバーIDを取得します。
        $stocks = DB::table('stocks')
            ->join('products', 'products.id', '=', 'stocks.product_id')
            ->join('shops', 'shops.id', '=', 'stocks.shop_id')
            ->join('members', 'members.id', '=', 'stocks.member_id')
            ->select('product_name', 'stocks.id', 'stocks.shop_id',
            'shop_name','stocks.stock_quantity', 
            'stocks.production_date', 'members.last_name')
            ->groupBy('product_name',
            'shop_name',
            'stocks.production_date',
            'members.last_name'
            )->orderBy('stocks.id','desc')->get();

            $stockPaginate = new LengthAwarePaginator(// LengthAwarePaginatorの作成
                $stocks->forPage($request->page, 11), // 現在のページのsliceした情報(現在のページ, 1ページあたりの件数)
                $stocks->count(), // 総件数
                11,
                null, // 現在のページ(ページャーの色がActiveになる)
                ['path' => $request->url()] // ページャーのリンクをOptionのpathで指定
            );
    

        // 黄みあん・くろあん 検索商品リスト表示
        $getProductNameList = new Product;
        $productName_List = $getProductNameList->getProductList();

        // 店舗リスト 検索店舗リスト表示
        $getShopNameList = New Shop;
        $shopName_List = $getShopNameList->getShopList();

        //あいまい検索 random_search.bladeへの検索結果を入力するテキスト入力フォームのname属性="input"。
        $input = '';

        $param = ['input' => $request->query('input'), 'stocks' => $stockPaginate, 'productName_List' => $productName_List, 'input' => $input,
        'shopName_List' => $shopName_List]; //ブレードに送るため、inputのリクエスト、$itemの配列、商品リスト、店舗リストを$paramにまとめます。

        return view('stock.stock_list', $param);
        

    }


    public function stockControl(Request $request)
    {
     
        //月間の在庫数を、カレンダーの日付順に並べて一覧表示します。※日付の順です。降順にはなりません。
 
//太秦店、祇園店の商品の注文個数/製造個数を、日付ごとに集計しています。
    //・order_dateがあれば、該当の日付があれば、配列に入れる 
    //・なければ、Join(innerJoin/内部結合）のため、nullなら何も表示されない。
    //・+1日 5/1+1=5/2 $dateTime->add(new DateInterval("P1D"));
        
    //・1日の日付を作成する。$dateTime->sub(new DateInterval('P' . ($d - 1) . 'D'));
    //・月に何日あるか計算する。$monthDays = $dateTime->format('t');
    // 今日の日付のDateTimeクラスのインスタンスを生成します。$dateTime = new DateTime();
    // https://www.php.net/manual/ja/datetime.construct.php
    $dateTime = new DateTime();
   
    $dateTime->setTimezone(new DateTimeZone('Asia/Tokyo')); //タイムゾーンを設定します。
    // $order1 には、求めたい値、今回は”何日ごとに、何個販売したか？”を求めたいので、
    // 配列は、->select('order_quantity')だけ指定します。
    $d = $dateTime->format('d');//今日の日付だけ取得します。今日が5/10なら、"10"を取得します       
    // for (5/1～5/31まで1日づつ足していく。)//5月なら31日分を、for文で反復する。
    //t	指定した月の日数。28 から 31 
    $dateTime->sub(new DateInterval('P' . ($d - 1) . 'D')); //今月の〇/1を取得。今日5/11-(11-1)=11-(10)=5-1今日の日付から(今日の日付 - 1)を引き、DateTimeクラスのインスタンスを今月の1日の日付に設定します。
    $date = 1; // カレンダーに記述する日付のカウンタ。
    $monthDays = $dateTime->format('t'); //当月に何日あるかの日数を求めます。その日が5月なら5月の日数31日。
    for ($date = 0; $date < $monthDays; $date++) { //月の日数分反復します。今日が5月なら31日間です。
        // $order['2022-5-11'] = $order1; // 配列$order1 をfor文で回して、新規キー['2022-5-11']を作成し代入します。
        $order = DB::table('stocks') //〇月1日～〇月31日までをfor文の中で繰り返します。
            ->whereDate('stocks.created_at', '=', $dateTime->format('Y-m-d') ) //注文日〇月〇日を今日の日付でDateTimiフォーマットとイコールにします。
            ->join('products', 'products.id', '=', 'stocks.product_id')  
            ->join('shops', 'shops.id', '=', 'stocks.shop_id')
            ->select(DB::raw('SUM(stock_quantity) as total_stock'),
            'product_name',
            'shop_name', 'stocks.shop_id',
            'stocks.product_id',
            'stocks.stock_quantity','sales_date',
            'stocks.production_date', 
            )->groupBy(
                'product_name',
                'shop_name', 
            )->get();        
      
        $orderQty[$dateTime->format('Y-m-d')] = $order;  //$order1を配列を、[キー名：2022-05-01]keyを1行づつ日付ごとに作成していきます。 5/1 = order1の配列に5/1があれば、キー$order[2022-05-1]にorder_quantityの販売個数を代入します。
        //キー：$order[2022-05-10] => 31個（'order_quantity')//こういう配列のキー、値になります// for文で繰り返し、5月の日数分繰り返して配列を作ります。         
        $dateTime->add(new DateInterval("P1D"));//+1日,P1D 1日足します。Pはピリオド、’間隔’、Dは’日’を表す。’P1D’は’1日間隔’PHP公式マニュアル☞https://www.php.net/manual/ja/dateinterval.construct.php
    }
    
        
        $getProductNameList = new Product; // しろあん・くろあん
        $productName_List = $getProductNameList->getProductList();//商品検索 プルダウンの商品リストです。

        $getShopNameList = New Shop; // 店舗リスト
        $shopName_List = $getShopNameList->getShopList();//店舗検索 プルダウンの店舗リストです。

        $input = ''; //あいまい検索 random_search.bladeへの検索結果を入力するテキスト入力フォームのname属性="input"。
        
        return view('stock.stock_control', compact('orderQty','productName_List','shopName_List','input'));//stock_controlで店舗・商品別に在庫数を表示します。

    }

    public function findstockControl(Request $productId)//productIdでRequestを受け取るようにします。
    {
      //ここでは、stockControlの在庫個数リストからさらに
      //商品で、在庫個数を検索することができる機能になります。

      if (isset($productId->id)) {
        $parameter = ['id' => $productId->id]; //shop_id をidとして登録します。

        //ここからは、日付ごとに検索した商品の検索結果を表示するためのリスト作成です。
        $dateTime = new DateTime(); 
    
        $dateTime->setTimezone(new DateTimeZone('Asia/Tokyo')); 
    
        $d = $dateTime->format('d');//今日の日付だけ取得します。       
        
        $dateTime->sub(new DateInterval('P' . ($d - 1) . 'D')); //今月の〇/1を取得。今日5/11-(11-1)=11-(10)=5-1今日の日付から(今日の日付 - 1)を引き、DateTimeクラスのインスタンスを今月の1日の日付に設定します。
        $date = 1; 
        $monthDays = $dateTime->format('t'); //当月に何日あるかの日数を求めます。
        for ($date = 0; $date < $monthDays; $date++) { //月の日数分反復します。
            // $order['2022-5-11'] = $order1;  配列$order1 をfor文で回して、新規キー['2022-5-11']を作成し代入します。
            $order = DB::table('stocks') //〇月1日～〇月31日までをfor文の中で繰り返します。
            ->whereDate('stocks.created_at', '=', $dateTime->format('Y-m-d') ) //登録日:〇月〇日を今日の日付でフォーマットとイコールにします。
            ->join('products', 'products.id', '=', 'stocks.product_id')  
            ->join('shops', 'shops.id', '=', 'stocks.shop_id')
            ->select(DB::raw('SUM(stock_quantity) as total_stock'),
                    'product_name', 
                    'shop_name', 
                    'stocks.product_id', 'stocks.shop_id', 
                    'stocks.stock_quantity','sales_date',
                    'stocks.production_date',                   
                )->groupBy(
                    'product_name',
                    'shop_name',
                )->orderBy('stocks.created_at', 'desc')->where('stocks.product_id', '=', $productId->id) 
                ->get();
        
            $orderQty[$dateTime->format('Y-m-d')] = $order; //$order1を配列を、[キー名：2022-05-01]keyを1行づつ日付ごとに作成していきます。 5/1 = order1の配列に5/1があれば、キー$order[2022-05-1]にorder_quantityの販売個数を代入します。
        
            $dateTime->add(new DateInterval("P1D"));//+1日,P1D 1日を足します。Pはピリオド、’間隔’、Dは’日’を表す。’P1D’は’1日間隔’PHP公式マニュアル☞https://www.php.net/manual/ja/dateinterval.construct.php
        }
        
   
        $getProductNameList = new Product; // しろあん・くろあん
        $productName_List = $getProductNameList->getProductList();//商品検索 プルダウンの商品リストです。

        $getShopNameList = New Shop; // 店舗リスト
        $shopName_List = $getShopNameList->getShopList();//店舗検索 プルダウンの店舗リストです。

        $input = ''; //あいまい検索 random_search.bladeへの検索結果を入力するテキスト入力フォームのname属性="input"。
       
    
        return view('stock.find_stock_control', compact('orderQty', 'shopName_List', 'productName_List', 'input'));
        }
    }

    
    public function searchstockControl(Request $shopId)//shopIdでRequestを受け取るようにします。
    {

        //ここでは、stockControlの在庫個数リストからさらに
        //店舗ごとの在庫個数を検索することができる機能になります。

        if (isset($shopId->id)) {
            $parameter = ['id' => $shopId->id]; //shop_id をidとして登録します。

        //ここから、検索するリスト一覧のデータを取得します。

        //***
        //ここからは、日付ごとに検索した商品の検索結果を表示するためのリスト作成です。
        $dateTime = new DateTime(); 
    
        $dateTime->setTimezone(new DateTimeZone('Asia/Tokyo')); 
    
        $d = $dateTime->format('d');//今日の日付だけ取得します。       
        
        $dateTime->sub(new DateInterval('P' . ($d - 1) . 'D')); //今月の〇/1を取得。今日5/11-(11-1)=11-(10)=5-1今日の日付から(今日の日付 - 1)を引き、DateTimeクラスのインスタンスを今月の1日の日付に設定します。
        $date = 1; 
        $monthDays = $dateTime->format('t'); //当月に何日あるかの日数を求めます。
        for ($date = 0; $date < $monthDays; $date++) { //月の日数分反復します。
            // $order['2022-5-11'] = $order1;  配列$order1 をfor文で回して、新規キー['2022-5-11']を作成し代入します。
            $order = DB::table('stocks') //〇月1日～〇月31日までをfor文の中で繰り返します。
            ->whereDate('stocks.created_at', '=', $dateTime->format('Y-m-d') ) //登録日:〇月〇日を今日の日付でフォーマットとイコールにします。
            ->join('products', 'products.id', '=', 'stocks.product_id')  
            ->join('shops', 'shops.id', '=', 'stocks.shop_id')
            ->select(DB::raw('SUM(stock_quantity) as total_stock'),
                'product_name', 
                'shop_name', 
                'stocks.product_id', 'stocks.shop_id', 
                'stocks.stock_quantity','sales_date',
                'stocks.production_date',              
                )->groupBy(
                    'product_name',
                    'shop_name',
                )->orderBy('stocks.created_at', 'desc')->where('stocks.shop_id','=',$shopId->id)
                ->get();
        
            $orderQty[$dateTime->format('Y-m-d')] = $order; //$order1を配列を、[キー名：2022-05-01]keyを1行づつ日付ごとに作成していきます。 5/1 = order1の配列に5/1があれば、キー$order[2022-05-1]にorder_quantityの販売個数を代入します。
        
            $dateTime->add(new DateInterval("P1D"));//+1日,P1D 1日を足します。Pはピリオド、’間隔’、Dは’日’を表す。’P1D’は’1日間隔’PHP公式マニュアル☞https://www.php.net/manual/ja/dateinterval.construct.php
        }
        
   
        $input = ''; //あいまい検索 random_search.bladeへの検索結果を入力するテキスト入力フォームのname属性="input"。

        $getProductNameList = new Product; // しろあん・くろあんの商品のプルダウンリストから商品の在庫を絞り込みます。
        $productName_List = $getProductNameList->getProductList();

        
        $getShopNameList = New Shop; // 店舗のプルダウンリストから商品の在庫を絞り込みます。
        $shopName_List = $getShopNameList->getShopList();

        $param = ['input' => $shopId->query('input'), 'orderQty' => $orderQty, 'productName_List' => $productName_List, 'input' => $input,
        'shopName_List' => $shopName_List]; //ブレードに送るため、inputのリクエスト、$itemの配列、商品リスト、店舗リストを$paramにまとめます。


        return view('stock.search_stock_control', $param);

      } else {
          return redirect('stock/stock_list'); //$request->idを取得できず、直接.search_stock_control画面に訪問した時リダイレクトします。
      }
    }
    

    public function Page(Request $request) // Requestを受け取るようにする//sales_history.bladeを表示します。
    {   
        //販売履歴を一覧表示します。
        //購入合計個数と売上合計数をそれぞれ表示します。
        //独自のページネーションを作成します。

        Paginator::useBootstrap();//ページネーションのデザインが崩れる互換性の問題を解消します。
   
        $items = //注文テーブル
                DB::table('orders')
                ->select(DB::raw('count(order_details.product_id) as count_product'))//可能であれば、order_detailテーブルからproduct_idをカウントしてくろあんだけか、黄みあんと2種類の購入なのかチェックしたかったがうまくいきませんでした。
                ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                ->join('products', 'products.id', '=', 'order_details.product_id')
                ->join('shops', 'shops.id', '=', 'orders.shop_id')
                ->join('members', 'members.id', '=', 'orders.member_id')
                ->select(DB::raw('SUM(order_quantity) as total_quantity'),//注文を個別に（くろあん、黄みあんの）注文数の合計数をSUM集計します。
                'orders.id','product_name','price','order_quantity', 'orders.order_date',
                'shop_name','last_name'
                )->orderBy('order_date', 'desc')
                ->groupBy(
                   'orders.id',//注文No.ごとにグループ化します。くろあん、黄みあんの複数注文をに1つにまとめます。
                )->get();

        $orderPaginate = new LengthAwarePaginator(// LengthAwarePaginatorの作成
            $items->forPage($request->page, 11), // 現在のページのsliceした情報(現在のページ, 1ページあたりの件数)
            $items->count(), // 総件数
            11,
            null, // 現在のページ(ページャーの色がActiveになる)
            ['path' => $request->url()] // ページャーのリンクをOptionのpathで指定
        );


        //検索
        $input = ''; //あいまい検索 random_search.bladeへの検索結果を入力するテキスト入力フォームのname属性="input"。
        
        $getProductNameList = new Product; // しろあん・
        $productName_List = $getProductNameList->getProductList();

        
        $getShopNameList = New Shop; // 店舗リスト
        $shopName_List = $getShopNameList->getShopList();
       


        $param = ['input' => $request->query('input'), 'items' => $orderPaginate, 'productName_List' => $productName_List,
        'shopName_List' => $shopName_List]; //ブレードに送るため、inputのリクエスト、$itemの配列、商品リスト、店舗リストを$paramにまとめます。


        return view('stock/sales_history', $param);

    }

    public function sales_shopsearch(Request $request)
    {
        //sales_history.bladeから店舗IDで検索した店舗別の販売履歴の結果を表示します。
        Paginator::useBootstrap();//ページネーションのデザインが崩れる互換性の問題を解消します。
 
        $items = //注文テーブル
                DB::table('orders')
                ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                ->join('products', 'products.id', '=', 'order_details.product_id')
                ->join('shops', 'shops.id', '=', 'orders.shop_id')
                ->join('members', 'members.id', '=', 'orders.member_id')
                ->select(DB::raw('SUM(order_quantity) as total_quantity'),//注文を個別に（くろあん、黄みあんの）注文数の合計個数をSUM集計します。
                'orders.id','product_name','price','order_quantity', 'orders.order_date',
                'shop_name','last_name'
                )
                ->orderBy('order_date', 'desc')->where('orders.shop_id', '=', $request->id) //リクエストで受取った店舗IDで情報を取得します。
                ->groupBy(
                   'orders.id',//注文No.ごとにグループ化します。くろあん、黄みあんの複数注文をに1つにまとめます。
                )->get();

        $orderPaginate = new LengthAwarePaginator(// LengthAwarePaginatorの作成
                $items->forPage($request->page, 6), // 現在のページのsliceした情報(現在のページ, 1ページあたりの件数)
                $items->count(), // 総件数
                6,
                null, // 現在のページ(ページャーの色がActiveになる)
                ['path' => $request->url()] // ページャーのリンクをOptionのpathで指定
            );


                //検索
                $input = ''; //あいまい検索 random_search.bladeへの検索結果を入力するテキスト入力フォームのname属性="input"。
                
                $getProductNameList = new Product; // しろあん・
                $productName_List = $getProductNameList->getProductList();

                
                $getShopNameList = New Shop; // 店舗リスト
                $shopName_List = $getShopNameList->getShopList();
       


                $param = ['input' => $request->query('input'), 'items' => $orderPaginate, 'productName_List' => $productName_List,
                'shopName_List' => $shopName_List]; //ブレードに送るため、inputのリクエスト、$itemの配列、商品リスト、店舗リストを$paramにまとめます。



        return view('stock/sales_shopSearch', $param);
    }


    public function sales_productSearch(Request $request)
    {
        //sales_history.bladeから商品IDで検索された販売履歴の結果を表示します。
        //商品IDの検索
        Paginator::useBootstrap();//ページネーションのデザインが崩れる互換性の問題を解消します。
 
        $items = //注文テーブル
                DB::table('orders')
                ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                ->join('products', 'products.id', '=', 'order_details.product_id')
                ->join('shops', 'shops.id', '=', 'orders.shop_id')
                ->join('members', 'members.id', '=', 'orders.member_id')
                ->select(DB::raw('SUM(order_quantity) as total_quantity'),//注文を個別に（くろあん、黄みあんの）注文の合計個数をSUM集計します。
                'orders.id','product_name','price','order_quantity', 'orders.order_date',
                'shop_name','last_name'
                )
                ->orderBy('order_date', 'desc')->where('order_details.product_id', '=', $request->id) //リクエストで受取った商品IDで情報を取得します。
                ->groupBy(
                   'orders.id',//注文No.ごとにグループ化します。くろあん、黄みあんの複数注文をに1つにまとめます。
                )->get();

        $orderPaginate = new LengthAwarePaginator(// LengthAwarePaginatorの作成
                $items->forPage($request->page, 6), // 現在のページのsliceした情報(現在のページ, 1ページあたりの件数)
                $items->count(), // 総件数
                6,
                null, // 現在のページ(ページャーの色がActiveになる)
                ['path' => $request->url()] // ページャーのリンクをOptionのpathで指定
            );


                //検索
                $input = ''; //あいまい検索 random_search.bladeへの検索結果を入力するテキスト入力フォームのname属性="input"。
                
                $getProductNameList = new Product; // しろあん・
                $productName_List = $getProductNameList->getProductList();

                
                $getShopNameList = New Shop; // 店舗リスト
                $shopName_List = $getShopNameList->getShopList();
       


                $param = ['input' => $request->query('input'), 'items' => $orderPaginate, 'productName_List' => $productName_List,
                'shopName_List' => $shopName_List]; //ブレードに送るため、inputのリクエスト、$itemの配列、商品リスト、店舗リストを$paramにまとめます。


        return view('stock/sales_productSearch',$param);
    }

    public function sales_randomSerch(Request $request)
    {
        //検索
        //入力フォーム：店舗名から検索・製造個数から検索・製造日から検索・管理者名から検索
        Paginator::useBootstrap();//ページネーションのデザインが崩れる互換性の問題を解消します。

        $item = Order::where('product_name', 'LIKE', '%' . $request->query('input') . '%') //注文テーブル
            ->orWhere('shop_name', 'LIKE', '%' . $request->query('input') . '%')
            ->orWhere('order_quantity', 'LiKE', '%' . $request->query('input') . '%')
            ->orWhere('order_date', 'LiKE', '%' . $request->query('input') . '%')
            ->orWhere('last_name', 'LiKE', '%' . $request->query('input') . '%')
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->join('products', 'products.id', '=', 'order_details.product_id')
            ->join('shops', 'shops.id', '=', 'orders.shop_id')
            ->join('members', 'members.id', '=', 'orders.member_id')
            ->select(
                'orders.id','product_name','price','order_quantity', 'orders.order_date',
                'shop_name','last_name'
            )
            ->groupBy(
                'orders.id',//注文No.ごとにグループ化します。くろあん、黄みあんの複数注文をに1つにまとめます。
            )->orderBy('order_date', 'desc')->paginate(5);
            
        
        $getProductNameList = new Product; // しろあん・くろあん
        $productName_List = $getProductNameList->getProductList();

        
        $getShopNameList = New Shop; // 店舗リスト
        $shopName_List = $getShopNameList->getShopList();

        $param = ['input' => $request->query('input'), 'items' => $item, 'productName_List' => $productName_List,
        'shopName_List' => $shopName_List]; //ブレードに送るため、inputのリクエスト、$itemの配列、商品リスト、店舗リストを$paramにまとめます。

        unset($request['_token']);
       

        return view('stock/sales_randomSerch', $param);
    }




    public function salesShow($id)
    {
        //販売履歴から、詳細を表示します。
        // ・合計請求金額95*10 950円 ・合計の販売個数 ・販売年月日 /
        // ・受取方法、お支払方法・配送なら、配送先住所/氏名


        $items = //注文テーブル
                DB::table('orders')
                ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                ->join('products', 'products.id', '=', 'order_details.product_id')
                ->join('shops', 'shops.id', '=', 'orders.shop_id')
                ->join('members', 'members.id', '=', 'orders.member_id')
                ->select(
                'orders.id','product_name','price','order_quantity', 'orders.order_date',
                'shop_name', 'last_name', 'price',
                'payment_method', 'receiving_method',
                'members.postal_code','members.address1','members.address2','members.address3',
                'members.address4','members.address5',
                'last_name','first_name',
                )
                ->where('orders.id', '=', $id)
                ->get();

            $orders = json_decode(json_encode($items), true); //php 多次元配列になったコレクションstdClassをArrayにキャストする


            $total = 0;
            foreach ($orders as $key => $v) {
            

            // 自己代入 $x = $x + 1 => $x += 1 => 0 + 1 = 1 ,$x = 1, $x = $x + 1 => 1+1 = 2 -->   
            $total += ($v['price'] * $v['order_quantity']); 

            } 
              

        // orders テーブルと、order_detailsテーブルをリレーションして表示します。
        return view('stock/sales_show', compact('orders', 'total'));
    }


    
    public function findProduct(Request $productId) 
    {
      // 検索 + 検索結果
        // 製造商品リストからの検索 stock/find_stockの検索フォーム
        // 検索・検索結果、2つを同時に表示

        Paginator::useBootstrap();//ページネーションのデザインが崩れる互換性の問題を解消します。

        if (isset($productId->id)) {
            $param = ['id' => $productId->id];

        
        $getProductNameList = new Product; // しろあん・くろあん
        $productName_List = $getProductNameList->getProductList();

        
        $getShopNameList = New Shop; // 店舗リスト
        $shopName_List = $getShopNameList->getShopList();
   
        
        $stocks = DB::table('stocks') //stocksのDBから、商品ID、商品名、在庫ID、店舗ID、製造個数、製造年月日、登録メンバーIDを取得します。
            
            ->join('products', 'products.id', '=', 'stocks.product_id')
            ->join('shops', 'shops.id', '=', 'stocks.shop_id')
            ->join('members', 'members.id', '=', 'stocks.member_id')
            ->select(
            'stocks.id','product_name','stocks.stock_quantity',
            'shop_name','stocks.stock_quantity',
            'stocks.production_date', 'members.last_name')

            ->where('stocks.product_id', '=', $productId->id)   
            ->orderBy('stocks.id','desc')->paginate(5);

        //  dd($stocks);   
            $input = ''; //あいまい検索 random_search.bladeへの検索結果を入力するテキスト入力フォームのname属性="input"。


        return view('stock.find_stock', compact('param', 'stocks', 'productName_List', 'shopName_List', 'input'));

        }
    }



    public function findShop(Request $shopId)
    {

        // 検索 + 検索結果
        // 店舗名からの検索 stock/find_stockの検索フォーム
        // 検索・検索結果、2つを同時に表示

        Paginator::useBootstrap();//ページネーションのデザインが崩れる互換性の問題を解消します。

        if (isset($shopId->id)) {
            $parameter = ['id' => $shopId->id]; //shop_id をidとして登録します。
        
        $getProductNameList = new Product; // しろあん・くろあん
        $productName_List = $getProductNameList->getProductList();
      
        $getShopNameList = New Shop; // 店舗リスト
        $shopName_List = $getShopNameList->getShopList();
   
        $stocks = DB::table('stocks') //stocksのDBから、商品ID、商品名、在庫ID、店舗ID、製造個数、製造年月日、登録メンバーIDを取得します。
            ->join('products', 'products.id', '=', 'stocks.product_id')
            ->join('shops', 'shops.id', '=', 'stocks.shop_id')
            ->join('members', 'members.id', '=', 'stocks.member_id')
            ->select('product_name', 'stocks.id', 'stocks.shop_id',
            'shop_name','stocks.stock_quantity',
            'stocks.production_date', 'members.last_name')->where('stocks.shop_id', '=', $shopId->id)
            ->orderBy('stocks.id','desc')->paginate(5);

        
        $input = ''; //あいまい検索 random_search.bladeへの検索結果を入力するテキスト入力フォームのname属性="input"。


        return view('stock.search_stock', compact('parameter', 'stocks', 'productName_List', 'shopName_List', 'input'));

        } else {
          return redirect('stock/stock_list'); //$request->idを取得できず、直接.search_stock_control画面に訪問した時リダイレクトします。
        }
    }

    public function randomSerch(Request $request)
    {
        //検索
        //入力フォーム：店舗名から検索・製造個数から検索・製造日から検索・管理者名から検索
        Paginator::useBootstrap();//ページネーションのデザインが崩れる互換性の問題を解消します。

        $item = Stock::where('product_name', 'LIKE', '%' . $request->query('input') . '%')
            ->orWhere('shop_name', 'LIKE', '%' . $request->query('input') . '%')
            ->orWhere('stock_quantity', 'LiKE', '%' . $request->query('input') . '%')
            ->orWhere('production_date', 'LiKE', '%' . $request->query('input') . '%')
            ->orWhere('last_name', 'LiKE', '%' . $request->query('input') . '%')
            ->join('products', 'products.id', '=', 'stocks.product_id')
            ->join('shops', 'shops.id', '=', 'stocks.shop_id')
            ->join('members', 'members.id', '=', 'stocks.member_id')
            ->select('product_name', 'stocks.id', 'stocks.shop_id',
            'shop_name','stocks.stock_quantity',
            'stocks.production_date', 'members.last_name')
            ->orderBy('stocks.id','desc')->paginate(5);

        
        $getProductNameList = new Product; // しろあん・くろあん
        $productName_List = $getProductNameList->getProductList();

        
        $getShopNameList = New Shop; // 店舗リスト
        $shopName_List = $getShopNameList->getShopList();

        $param = ['input' => $request->query('input'), 'items' => $item, 'productName_List' => $productName_List,
        'shopName_List' => $shopName_List]; //ブレードに送るため、inputのリクエスト、$itemの配列、商品リスト、店舗リストを$paramにまとめます。

        unset($request['_token']);
       

        return view('stock.random_search', $param);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //製造商品の新規登録の入力フォーム画面を表示します。

        $shop = New Shop; // 店舗名とshop_id をShop モデルから受け取ります。 
        
        
        $shop_list = $shop->getShopLists()->prepend('店舗選択', ''); // モデルShop.phpで定義した関数getShopListsを呼び出します。// セレクトボックスの最初に「'店舗選択'」を表示します。

        
        $product = New Product; // 商品名とproduct_idを、Product モデルから受け取ります。
        
        
        $product_list = $product->getProductLists()->prepend('商品選択', ''); // モデルProductで定義した関数getProductListsを呼び出す// セレクトボックスの最初に「'商品選択'」を表示します。
        
        
        return view('stock/stock', compact('shop_list', 'product_list')); //製造商品登録の入力フォーム画面を表示する
    }

    public function confirm(Request $request)
    {
        //製造商品登録の入力確認
      
         $request->validate( [ // バリデーションを実行（結果に問題があれば処理を中断してエラーを返します。

            
            'product_id' => 'required', // 商品id
            
            'shop_id' => 'required', // 店舗ID 店舗1か店舗2か用意したセレクトボックスから選択する。

            // 販売個数
            // 'sales_quantity' => 'required', // デフォルト:0
            // 販売日
            // 'sales_day', // Null許可

            
            'stock_quantity' => 'required', // 製造個数デフォルト:0
            
            'production_date', // // 製造年月日Null許可
            // 登録する管理者のmember_id 
            // 'member_id' => 'required',// ログインメンバーidを取得
            
            
        ],

        [
            
            'product_id.required' => '商品名を選択してください。', // 商品id
            
            'shop_id.required' => '店舗名を選択してください。', // 店舗ID 店舗1か店舗2か用意したセレクトボックスから選択する。
            // 販売個数
            // 'sales_quantity' => 'required', // デフォルト:0
            // 販売日
            // 'sales_day', // Null許可
            
            'stock_quantity.required' => '製造個数を入力してください。', // 製造個数デフォルト:0
            
            'production_date.required' => '製造年月日を選択してください。', // // 製造年月日Null許可
            // 登録する管理者のmember_id 
            // 'member_id' => 'ログインidを入力してください。',
            
        ]);

            $stock = new Stock();
              

            if (empty(Auth::user()->id)) { //ログインIDが空ならログイン画面にリダイレクトします。

                return redirect()->route('login'); 

            } elseif (Auth::user()->id ==1 || Auth::user()->id ==2) {//$member_idが太秦店の管理者もしくは、祇園店の管理者だった場合は以下の処理を実行します。
           

            $stock->member_id = Auth::user()->id; //Stockクラスのmember_idに代入し、以下の処理を実行します。 
              
            
            $input = $request->all(); //「商品製造」画面からpost送信した入力値を全て受け取る。
            unset($input['_token']);
    

            $input['member_id'] = $stock->member_id; //配列$inputに新規キー[member_id]を追加作成し、$stock->member_id(現在ログインid)を代入します。

        
            
            $shop = Shop::find($input['shop_id']); 
            $shop_name = $shop['shop_name']; 
            $input['shop_name'] = $shop_name; //店舗名を配列$inputに、新規キーshop_nameを登録します。


            $product = Product::find($input['product_id']);
            $product_name = $product['product_name']; 
            $input['product_name'] = $product_name; //商品名を配列$inputに、新規キーproduct_nameを登録します。

            
            $request->session()->put('input', $input); //次の確認画面に表示させる配列$inputの値をセッションに保存します。

            return view('stock/stock_confirm', [
                'inputs' => $input,
            ]);

        } else { //もしもログインIDが1でも2でもなければログイン画面にリダイレクトします。

            return redirect()->route('login'); 
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, order $order)
    {
        // 製造商品の登録実行

        ini_set("max_execution_time", 0);  // タイムアウトしない
        
        ini_set("max_input_time", 0); // パース時間を設定しない

        $stock = new Stock();

        $stock->fill($request->session()->get('input')); //stocksテーブルへセッションinputの値を保存します。
    
        $stock->save();
       

        
        return redirect()->route('stock_list'); // 製造商品管理画面にリダイレクト 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    
    public function show(Stock $stock, $id)//リクエスト$idを受取ります。
    {
        // 詳細画面で個別に製造商品の登録情報を表示

        $stock = Stock::find($id);

        $product = Product::find($stock['product_id']);//商品IDから
        $product_name = $product['product_name'];//商品名をproductクラスから取得します。 
        $stock['product_name'] = $product_name;//$stock配列にキー名'product_name'を作成し、取得した商品名を入れます。

        $shop = New Shop;//Shopクラスのインスタンを呼び込んで
        $shop = Shop::find($stock['shop_id']);//$stock配列のshop_idからShopの配列を取得します。
        $shop_name = $shop['shop_name'];
        $stock['shop_name'] = $shop_name;//$stock配列にキー名'shop_name'を作成し、取得した店舗名を入れます。

        $stocks = json_decode(json_encode($stock), true);//jsonのdecodeでコレクションの配列を変換して、すっきりした配列にします。
 

        return view('stock/show_stock', [
            'stocks' => $stocks,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    
    public function edit(Request $request, Stock $stock, $id)
    {
        // 編集画面から製造商品の登録情報を編集

        $stock = Stock::find($request->id);


        $shop = New Shop; // 店舗名 をShop モデルから受け取る。 
            
        $shop_list = $shop->getShopLists()->prepend('店舗選択', ''); // モデルShop.phpで定義した関数getShopListsを呼び出す。// セレクトボックスの最初に「'店舗選択'」を表示する

        $product = New Product; // 商品名product_idを、Product モデルから受け取る。
         
        $product_list = $product->getProductLists()->prepend('商品選択', ''); // モデルProductで定義した関数getProductListsを呼び出す // セレクトボックスの最初に「'商品選択'」を表示します。

        //現在の値をブレードに表示
        $product = Product::find($stock['product_id']);
        $product_name = $product['product_name'];
        $stock['product_name'] = $product_name;//$stock配列にキー名'product_name'を作成し、取得した商品名を入れます。

    
        $shop = Shop::find($stock['shop_id']);
        $shop_name = $shop['shop_name'];
        $stock['shop_name'] = $shop_name;//$stock配列にキー名'shop_name'を作成し、取得した店舗名を入れます。

        $stocks = json_decode(json_encode($stock), true);//jsonのdecodeでコレクションの配列を変換して、すっきりした配列にします。
 


        return view('stock/edit_stock', compact('stocks','product_list','shop_list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    
    public function update(Request $request, Stock $stock)
    {
        // 編集した製造商品の登録情報を更新

        // バリデーション
        $request->validate( [ // バリデーションを実行（結果に問題があれば処理を中断してエラーを返します。
            'product_id' => 'required',      
            'shop_id' => 'required',         
            'stock_quantity' => 'required',        
            'production_date', 
        ],
        [    
            'product_id.required' => '商品名を選択してください。', 
            'shop_id.required' => '店舗名を選択してください。', 
            'stock_quantity.required' => '製造個数を入力してください。',   
            'production_date.required' => '製造年月日を選択してください。', 
        ]);


        if (empty(Auth::user()->id)) {
            return redirect('shop/login'); 
        } else {
        $stock->member_id = Auth::user()->id; // 現在ログインidをstock.member_idに代入
        $stock = stock::find($request->id); // editブレードからPOST送信されたリクエスト$idを受取る    

        $form = $request->all();
        unset($form['_token']);

       
        //stockクラスに$formの値を挿入する。
        $stock->fill($form)->save();

        // 今stocksに登録したレコードを取得します。リレーションして店舗名、商品名も取得します。
        $stocks = DB::table('stocks')
        ->join('order_details', 'order_details.product_id', '=', 'products.id')
        ->join('orders', 'orders.id', '=', 'order_details.order_id')
        ->join('products', 'products.id','=','stocks.product_id')
        ->join('shops', 'shops.id', '=', 'stocks.shop_id')
        ->SELECT('product_id', 'product_name', 'shop_id', 'shop_name', 'stock_quantity', 
        'production_date')
        ->where('stocks.id', '=', $request->id)
        ->get();


        return redirect()->route('stock_list', ['stocks' => $stocks]);
        }
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
