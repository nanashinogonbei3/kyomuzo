<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'order_quantity',
        'member_id',
    ];

        // カートはMemberクラスに所属
        public function member()
    {
        return $this->belongTo(Member::class);
    }

    //（親）商品に所属する(子)カートとリレーションします。
    public function product()
    {
        return $this->belongsTo(Product::class);
    }



}
