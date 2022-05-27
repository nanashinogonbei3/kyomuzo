<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Member extends Authenticatable
{

    use HasFactory;

    // 「id」timestampsのカラム「create_at」
    // 「update_id」が標準で作成する仕組みなので、それ以外のフォームで登録・更新するカラムを設定する。
    protected $fillable = [
        'last_name',
        'first_name',
        'email',
        'password',
        'phone_number',
        'postal_code',
        'address1',
        'address2',
        'address3',
        'address4',
        'address5',
    ];

        // みせたくない
        protected $hidden = [
            'password',
        ];

        // リレーション
        public function orders()
        {
            // Eloquentは、親モデル名に基づき、リレーションの外部キーを決定します。この場合、Orderモデルは
            // 自動的にmember_id外部キーを持っているとみなします。
            return $this->hasOne('Order::class');
            // hasOneメソッドに渡される最初の引数は、関連するモデルクラスの名前です。関係を定義すると、
            // Eloquentの動的プロパティを使用して関連レコードを取得できます。
            // リレーションメソッドへアクセスできます。
            // $order = Member::find(1)->order;
        }

        // Cartモデルとの一対多のリレーション
        // Eloquentは親モデル（Memberモデル）の「スネークケース」名に「_id」という接尾辞を付けます。
        // したがって、この例では、EloquentoはCartモデルの外部キーカラムが「member_id」であると想定します。       
        public function carts()
        {
            return $this->hasMany(Cart::class);
        }           
}