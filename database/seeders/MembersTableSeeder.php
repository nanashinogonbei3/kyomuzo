<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class MembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('members')->insert([

            [
             'email' => 'kyomuzo_uzumasa@gmail.com',
             'password' => bcrypt('secret'),
             'first_name' => '黍太郎',
             'last_name' => '吉本',
             'phone_number' => '08012548874',
             'postal_code' => '6167716',
             'address1' => '京都府',
             'address2' => '京都市右京区',
             'address3' => '太秦東峰岡町',
             'address4' => '10',
             'address5' => '',
             
            ],
 
            [
             'email' => 'kyomuzo_gion@gmail.com',
             'password' => bcrypt('secret'),
             'first_name' => '桃太郎',
             'last_name' => '吉本',
             'phone_number' => '08056789012',
             'postal_code' => '6050073',
             'address1' => '京都府',
             'address2' => '京都市東山区',
             'address3' => '祇園町北側',
             'address4' => '625',
             'address5' => '',
        
            ],
 
            [
             'email' => 'kyomuzo_gion@gmail.com',
             'password' => bcrypt('secret'),
             'first_name' => '伴',
             'last_name' => '虚無蔵',
             'phone_number' => '08000001110',
             'postal_code' => '6020881',
             'address1' => '京都府',
             'address2' => '京都市上京区',
             'address3' => '京都御苑',
             'address4' => '3',
             'address5' => '伴株式会社',
         
            ],
 
         ]);
    }
}
