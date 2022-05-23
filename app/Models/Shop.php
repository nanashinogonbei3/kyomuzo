<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    //ShopモデルからStockモデルへアクセスする。
    // 1対多 
	//Shopモデルから複数のtockモデルへアクセスする
	public function stock()
    {
		return $this->hasMany(Stock::class);
	}

    //ShopモデルのidとOrderモデルの外部キーshop_idとがリレーションします。
    public function order()
    {
        return $this->hasOne(Order::class);
    }

    // ブレードproduct/products.blade のセレクトボックスに表示させる、店舗名を全件取り出す
    public function getShopLists()
    {
        $shop = Shop::orderBy('id','asc')->pluck('shop_name', 'id');
        return $shop;
    }

    //StockのDBを検索するためのリスト
    public function getShopList()
    {
        //祇園・太秦
        $getShopNameList = Shop::orderBy('id','asc')->pluck('shop_name', 'id');

        return $getShopNameList;
    }
 
    
}
