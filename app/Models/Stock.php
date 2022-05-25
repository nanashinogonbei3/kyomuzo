<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [

        'product_id',
        'shop_id',
        'stock_quantity',
        'sales_date',
        'production_date',
        'member_id',
        ];

    //バリデーションルール
    public static $rules = array(

        // 商品id
        'product_id' => 'required',
        // 店舗ID 店舗1か店舗2か用意したセレクトボックスから選択する。
        'shop_id' => 'required',

        // 販売個数
        // 'sales_quantity' => 'required', // デフォルト:0
        // 販売日
        // 'sales_day', // Null許可

        // 製造個数
        'production_value' => 'required', // デフォルト:0
        // 製造年月日
        'production_date', // Null許可
        // 登録する管理者のmember_id 
        // 'member_id' => 'required',// Auth->user->id();で現在ログインメンバーidを取得のでバリデーションは不要項目。
    );


    //StockからProductモデルにアクセスできるようにするStockモデルの関係を定義しましょう
    // belongsToメソッドを使用してhasMany関係の逆を定義できます。
    public function product()
    {
        return $this->belongsTo(Product::class);
    }


    //逆の関係の定義
    //ShopモデルからStockモデルへのアクセスができるようになりました。
    //次に、在庫の所有者である店舗へアクセスできるようにする、Stockモデルの
    //関係を定義しましょう。belongsToメソッドを使用してhasOne関係の逆を定義できます。
    //StockモデルからShopモデルへアクセスすす。
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
