<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [

        'product_name',
        'price',
        ];

    
    public function carts()
    {
        return $this->hasMany(carts::class);
    }
        

	// 商品に関連している複数の在庫の取得
	public function stock()
    { 
	    return $this->hasMany(stock::class);
    }

    //この商品に関連している注文詳細(Order_Detail)の取得
    public function order_detail()
    {
        return $this->hasOne(Order_detail::class);
    }

    // セレクトボックスに「くろあん・しろあん」をリスト表示します。
    public function getProductLists()
    {
        $product = Product::orderBy('id','asc')->pluck('product_name', 'id');
        return $product;
    }
    
    //StockのDBを検索するためのリスト
    public function getProductList()
    {
        //
        $getProductNameList = Product::orderBy('id','asc')->pluck('product_name', 'id');

        return $getProductNameList;
    }

}

 