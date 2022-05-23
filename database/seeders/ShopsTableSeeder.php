<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShopsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shops')->insert([
 
            [
             'shop_name' => '京都太秦店',
             'phone_number' => '08012548874',
             'latitude' => '35.016338069995676',
             'longitude' => '135.70791712366616',
             'postal_code' => '616-7716',
             'address1' => '京都府',
             'address2' => '京都市右京区',
             'address3' => '太秦東峰岡町',
             'address4' => '10',
            ],
 
            [
             'shop_name' => '京都祇園店',
             'phone_number' => '08056789012',
             'latitude' => '35.00358701410708',
             'longitude' => '135.780528298857',
             'postal_code' => '605-0073',
             'address1' => '京都府',
             'address2' => '京都市東山区',
             'address3' => '祇園町北側',
             'address4' => '625',
            ],

        ]);
    }
}
