<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
// 追記

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
 
            [
             'product_name' => '虚無蔵くろあん',
             'price' => '95',
            ],
 
            [
             'product_name' => '虚無蔵しろあん',
             'price' => '95',
            ],
 
        ]);

    }
}
