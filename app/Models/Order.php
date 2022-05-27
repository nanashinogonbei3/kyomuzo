<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',//メンバーID
        'order_date',//注文日
        'shop_id',//購入店舗
        'payment_method',//支払方法
        'receiving_method',//受取方法（配送or店舗)
    ];

    // リレーション   
    // memberメソッドを呼び出した時に、EloquentはOrderモデルのmember_idカラムと一致するidを持った
    // Memberモデルを見つけようとします。つまりEloquentはメソッド名memberの末尾に_idを付けることに外部キーを
    // 決定します。
    public function member()
    {
        // memberに所属する注文テーブル
        return $this->belongsTo(Member::class);
    }

    //規約により、Eloquentは親モデル（ここではOrderモデル）の「スネークケース」名に「_id」という接尾辞を
    // 付けます。この場合、Order_detailモデルは自動的にorder_id 外部キーを持っているとみなします。
    public function order_detail()
    {
        return $this->hasOne(Order_detail::class);
    }

    //注文テーブルOrdersの外部キー「shop_id」は自動的に親モデルShopのidに所属します。
    public function shop()
    {
        return $this->belongsTo(User::class);
    }

}
