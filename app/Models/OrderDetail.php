<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',//商品ID
        'order_quantity',//購入個数
        'order_id',//OrdersにインサートしたLastInsertID
    ];

    // この注文詳細を所有している注文の取得
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    //この注文が所有している商品の取得
    public function Product()
    {
        return $this->belongsTo(Product::class);
    }

    // 在庫があるか無いかを確認する関数
    public function getOrderData()
    {
        $order_detail = Order_detail::orderBy('id','desc')->pluck('product_id', 'order_quantity','order_id');
        return $order_detail;
    }

}
